<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Transbank\Webpay\WebpayPlus\Transaction;
if (file_exists(APPPATH . 'vendor/autoload.php')) {
    require_once(APPPATH . 'vendor/autoload.php');
} elseif (file_exists(APPPATH . '../vendor/autoload.php')) {
    require_once(APPPATH . '../vendor/autoload.php');
} 


class ShoppingCart extends CI_Controller {

    public function __construct(){
		parent:: __construct(); 
        $this->load->library(array('phpmailer_lib'));
        session_start();
	}

    public function adminPurchase () { 
        $data['products'] = $this->session->userdata('products');
    /*  var_dump($data['products']);  */
        $this->load->view('header');
        $this->load->view('adminPurchase', $data);
        $this->load->view('footer');
    }

    public function getProducts () { 
        $products = $this->session->userdata('products');
        $this->response->sendJSONResponse(array('products' => $products));
    }


    public function newTransaction()
    {    
        
        /* Save data from form */
        $data_purchase = $this->input->post('data'); 
        $arraydata = array(
            'data_purchase'  => $data_purchase,
        );
        $this->session->set_userdata($arraydata);

        /* Create new transaction */
        $transaction = new Transaction();
        $buy_order = '000000012763';
        $session_id = "dasdsadas";
        $amount = $data_purchase['amount'];
        $return_url = "http://www.localhost/site_hidratec/api/newTransaction/result";
        $response = $transaction->create($buy_order, $session_id, $amount, $return_url);
        $response->getUrl();
        $response->getToken();
        $redirectUrl = $response->getUrl().'?token_ws='.$response->getToken();
        $this->response->sendJSONResponse(array('url' => $redirectUrl)); 
    }


    public function test()
    {    
        
        /* Create new transaction */
        $transaction = new Transaction();
        $buy_order = '000000012763';
        $session_id = "dasdsadas";
        $amount = '1500';
        $return_url = "http://www.localhost/site_hidratec/api/newTransaction/result";
        $response = $transaction->create($buy_order, $session_id, $amount, $return_url);
        $response->getUrl();
        $response->getToken();
        $redirectUrl = $response->getUrl().'?token_ws='.$response->getToken();
        $this->response->sendJSONResponse(array('url' => $redirectUrl)); 
    }

    public function mail(){
        /* $this->load->view('header'); */
        $this->load->view('admin/voucher_client');
    /*  $this->load->view('footer'); */
    }




    public function resultTrans(){
        $transaction = new Transaction();
        if ($this->userAbortedOnWebpayForm()) {
            $this->cancelOrder();
            exit('Has cancelado la transacción en el formulario de pago. Intenta nuevamente');
        }
        if ($this->anErrorOcurredOnWebpayForm()) {
            $this->cancelOrder();
            exit('Al parecer ocurrió un error en el formulario de pago. Intenta nuevamente');
        }
        if ($this->theUserWasRedirectedBecauseWasIdleFor10MinutesOnWebapayForm()) {
            $this->cancelOrder();
            exit('Superaste el tiempo máximo que puedes estar en el formulario de pago (10 minutos). La transacción fue cancelada por Webpay. ');
        }
        //Por último, verificamos que solo tengamos un token_ws. Si no es así, es porque algo extraño ocurre.
        if (!$this->isANormalPaymentFlow()) { // Notar que dice ! al principio.
            $this->cancelOrder();
            exit('En este punto, si NO es un flujo de pago normal es porque hay algo extraño y es mejor abortar. Quizás alguien intenta llamar a esta URL directamente o algo así...');
        }

        // Acá ya estamos seguros de que tenemos un flujo de pago normal. Si no, habría "muerto" en los checks anteriores.
        $token = $_GET['token_ws'] ?? $_POST['token_ws'] ?? null; // Obtener el token de un flujo normal
        $response = $transaction->commit($token);

        if ($response->isApproved()) {
            //Si el pago está aprobado (responseCode == 0 && status === 'AUTHORIZED') entonces aprobamos nuestra compra
            // Código para aprobar compra acá
            $this->approveOrder($token, $response);
        } else {
            $this->cancelOrder();
        }

        return;
    }

    private function cancelOrder($response = null)
    {
        // Acá has lo que tangas que hacer para marcar la orden como fallida o cancelada
        $keys = array('data_purchase');
        $this->session->unset_userdata($keys);
        $products = $this->session->userdata('data_purchase');
        $this->load->view('header');
        $this->load->view('PaymentUnsuccessfull');
        $this->load->view('footer');
    }

    private function approveOrder($token, $response)
    {
        /* Data Products Purchase */
        $products = $this->session->userdata('products');

        /* Data Purchase User Details */
        $purchase_Details = $this->session->userdata('data_purchase');

        /* Data from Api Transbank */
        $response_transbank = array(
            'data_transaction'  => array(
                'vci' => $response->vci,
                'status' => $response->status,
                'responseCod' => $response->statusCode,
                'amount' => $response->amount,
                'authorizationCode' => $response->authorizationCode,
                'paymentTypeCode' => $response->paymentTypeCode,
                'accountingDate' => $response->accountingDate,
                'installmentsNumber' => $response->installmentsNumber,
                'installmentsAmount' => $response->installmentsAmount,
                'sessionId' => $response->sessionId,
                'buyOrder' => $response->buyOrder,
                'cardNumber' => $response->cardNumber,
                'transactionDate' => $response->transactionDate,
                'balance' => $response->balance,
                'cardDetail' => $response->cardDetail,
            ),
        );

        //Save data in bdd

        
        //Send email
        $this->phpmailer_lib->send_mail_client($response->buyOrder, $products, $purchase_Details);
        $this->phpmailer_lib->send_mail_seller($response->buyOrder, $products, $purchase_Details);

        //Clean session vars    
        $keys = array('cant_products', 'products');
        $this->session->unset_userdata($keys);


        //Redirect to: view approved -> with response details from transbank,
        $data['email'] = $purchase_Details['email'];
        $this->load->view('header');
        $this->load->view('PaymentSuccessfull', $data);
        $this->load->view('footer');
        
    }

    private function userAbortedOnWebpayForm()
    {
        $tokenWs = $_GET['token_ws'] ?? $_POST['token_ws'] ?? null;
        $tbkToken = $_GET['TBK_TOKEN'] ?? $_POST['TBK_TOKEN'] ?? null;
        $ordenCompra = $_GET['TBK_ORDEN_COMPRA'] ?? $_POST['TBK_ORDEN_COMPRA'] ?? null;
        $idSesion = $_GET['TBK_ID_SESION'] ?? $_POST['TBK_ID_SESION'] ?? null;
    
        // Si viene TBK_TOKEN, TBK_ORDEN_COMPRA y TBK_ID_SESION es porque el usuario abortó el pago
        return $tbkToken && $ordenCompra && $idSesion && !$tokenWs;
    }

    private function anErrorOcurredOnWebpayForm()
    {
        $tokenWs = $_GET['token_ws'] ?? $_POST['token_ws'] ?? null;
        $tbkToken = $_GET['TBK_TOKEN'] ?? $_POST['TBK_TOKEN'] ?? null;
        $ordenCompra = $_GET['TBK_ORDEN_COMPRA'] ?? $_POST['TBK_ORDEN_COMPRA'] ?? null;
        $idSesion = $_GET['TBK_ID_SESION'] ?? $_POST['TBK_ID_SESION'] ?? null;

        // Si viene token_ws, TBK_TOKEN, TBK_ORDEN_COMPRA y TBK_ID_SESION es porque ocurrió un error en el formulario de pago
        return $tokenWs && $ordenCompra && $idSesion && $tbkToken;
    }

    private function theUserWasRedirectedBecauseWasIdleFor10MinutesOnWebapayForm()
    {
        $tokenWs = $_GET['token_ws'] ?? $_POST['token_ws'] ?? null;
        $tbkToken = $_GET['TBK_TOKEN'] ?? $_POST['TBK_TOKEN'] ?? null;
        $ordenCompra = $_GET['TBK_ORDEN_COMPRA'] ?? $_POST['TBK_ORDEN_COMPRA'] ?? null;
        $idSesion = $_GET['TBK_ID_SESION'] ?? $_POST['TBK_ID_SESION'] ?? null;

        // Si viene solo TBK_ORDEN_COMPRA y TBK_ID_SESION es porque el usuario estuvo 10 minutos sin hacer nada en el
        // formulario de pago y se canceló la transacción automáticamente (por timeout)
        return $ordenCompra && $idSesion && !$tokenWs && !$tbkToken;
    }

    private function isANormalPaymentFlow()
    {
      $tokenWs = $_GET['token_ws'] ?? $_POST['token_ws'] ?? null;
      $tbkToken = $_GET['TBK_TOKEN'] ?? $_POST['TBK_TOKEN'] ?? null;
      $ordenCompra = $_GET['TBK_ORDEN_COMPRA'] ?? $_POST['TBK_ORDEN_COMPRA'] ?? null;
      $idSesion = $_GET['TBK_ID_SESION'] ?? $_POST['TBK_ID_SESION'] ?? null;

      // Si viene solo token_ws es porque es un flujo de pago normal
      return $tokenWs && !$ordenCompra && !$idSesion && !$tbkToken;
    }

    public function getQuantity(){
        if($this->session->userdata('cant_products')){
            $cant = $this->session->userdata('cant_products');
            $this->response->sendJSONResponse(array('newNumber' => $cant ));
        }else{
            $this->session->set_userdata('cant_products', '0');
            $this->response->sendJSONResponse(array('newNumber' => "0" ,));
        }

        /* Reinicio de variables */
      /*   $this->session->sess_destroy(); */

    }


    public function addProduct(){
        $data = $this->input->post('product');

        /* Se verifica que la variable de sesion ya esta creada*/
        if($this->session->userdata('products')){
            $products = $this->session->userdata('products');


            /* Tengo que verificar si ya tengo agregado el mismo producto en el carro */
            if($products['product'.$data['id']]){
                /* Si ya esta se le agrega una cantidad +1*/
                $quantity = ((int)($products['product'.$data['id']]['cantidad']))+1;
                $products['product'.$data['id']]['cantidad']=$quantity;
                $this->session->set_userdata('products' , $products);


            }else{
                /* Si no esta se incorpora y se le inicializa una cantidad de 1 producto */
                $cantidad = array('cantidad' => '1');
                $resultado = array_merge($data['description'], $cantidad);

                $arraydata = array(
                    'product'.$data['id'] => $resultado,
                );

                $products = array_merge($products, $arraydata);
                $this->session->set_userdata('products' , $products);
            }

            /* Actualizo la variable: Cantidad productos en el carro de compra */
            $a = (string)(((int) $this->session->userdata('cant_products'))+1); 
            $this->session->set_userdata('cant_products', $a); 
            $this->response->sendJSONResponse(array('newNumber' => $a,'msg'=>'producto ingresado correctamente')); 

        }else{
            /* Se crea variable de sesion agregandole el producto seleccionado*/
            $cantidad = array('cantidad' => '1');
            $resultado = array_merge($data['description'], $cantidad);

            $arraydata = array(
                'products'  => array(
                    'product'.$data['id'] => $resultado 
                ),
            );

            $this->session->set_userdata($arraydata);
            $a = (string)(((int) $this->session->userdata('cant_products'))+1); 
            $this->session->set_userdata('cant_products', $a); 

            $this->response->sendJSONResponse(array(
                'newNumber' => $a,
                'msg'=>'producto ingresado correctamente',
            )); 

        } 
    }

    /* Add quantity:1 of product by ID */
    public function plusProduct($id){
        try {   
            $products = $this->session->userdata('products');
            $quantity = ((int)($products['product'.$id]['cantidad']))+1;
            $products['product'.$id]['cantidad']=$quantity;
            $this->session->set_userdata('products' , $products);
            $this->quantity();
            $this->response->sendJSONResponse(array('msg'=>'producto agregado correctamente',)); 
        } catch (Exception $e) {
            $this->response->sendJSONResponse(array('msg' =>  $e->getMessage()), 400);
        }
    }

    /* Delete quantity:1 of product by ID */
    public function minusProduct($id){
        try {   
            $products = $this->session->userdata('products');
            $quantity = ((int)($products['product'.$id]['cantidad']));

            if($quantity == 1){
                $this->deleteProduct($id);
            }else{
                $products['product'.$id]['cantidad']=$quantity-1;
                $this->session->set_userdata('products' , $products);
                $this->quantity();
                $this->response->sendJSONResponse(array('msg'=>'producto eliminado correctamente',)); 
            }

        } catch (Exception $e) {
            $this->response->sendJSONResponse(array('msg' =>  $e->getMessage()), 400);
        }
    }

    public function addMultipleProduct(){
        $data = $this->input->post('product');
        $id = $data['id'];
        $cant = $data['quantity'];

        try {   
            if($cant == 0){
                $this->deleteProduct($id);
            }else{
                $products = $this->session->userdata('products');
                $quantity = $cant;
                $products['product'.$id]['cantidad']=$quantity;
                $this->session->set_userdata('products' , $products);
                $this->quantity();
                $this->response->sendJSONResponse(array('msg'=>'producto agregado correctamente',)); 
            }
        } catch (Exception $e) {
            $this->response->sendJSONResponse(array('msg' =>  $e->getMessage()), 400);
        }

    }

    public function addMultipleProductDetail(){
        $data = $this->input->post('product');
        $id = $data['id'];
        $quantity = (int)$data['quantity'];

        $products = $this->session->userdata('products');
        
        if(!$products){
            $arraydata = array(
                'products'  => array(),
            );
            $this->session->set_userdata($arraydata);
        }


        if($products['product'.$id]){
            try {   
                if($quantity  == 0){
                    $this->deleteProduct($id);
                }else{
                    $cant = (int)($products['product'.$id]['cantidad']);
                    $products['product'.$id]['cantidad']= $cant + $quantity;
                    $this->session->set_userdata('products' , $products);
                    $this->quantity();
                    $this->response->sendJSONResponse(array('msg'=>'producto agregado correctamente',)); 
                }
            } catch (Exception $e) {
                $this->response->sendJSONResponse(array('msg' =>  $e->getMessage()), 400);
            }
        }else{
            /* Si no esta se incorpora y se le inicializa la cantidad ingresada */
            $products = $this->session->userdata('products');
            $arraydata = array(
                'product'.$data['id'] =>$data['description'],
            );

            $products = array_merge($products, $arraydata);
            $this->session->set_userdata('products' , $products);
            $this->quantity();
            $this->response->sendJSONResponse(array('msg'=>'producto agregado correctamente',));
        }
    }

    /* Delete product by ID */
    public function deleteProduct($id){
        try {     
            /* Se elimina la variable de sesion asociada al producto*/
            $products = $this->session->userdata('products');
            unset($products['product'.$id]);
            $this->session->set_userdata('products' , $products);
            $this->quantity();
            $this->response->sendJSONResponse(array('msg'=>'producto eliminado correctamente',)); 
        } catch (Exception $e) {
            $this->response->sendJSONResponse(array('msg' =>  $e->getMessage()), 400);
        }
    }

    /*Reload quantity of products in shopping cart*/
    public function quantity(){
        $products = $this->session->userdata('products');
        $cant= 0;
        foreach ($products as &$item) {
            $cant += $item['cantidad'];
        }
        $this->session->set_userdata('cant_products', $cant);
    }

}
