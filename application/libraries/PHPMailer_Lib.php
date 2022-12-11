<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class PHPMailer_Lib
{
    private $CI;

	public function __construct() {
		$this->CI =& get_instance();
        $this->CI->load->helper('email');
        log_message('Debug', 'PHPMailer class is loaded.');
	}

    public function load(){
        // Include PHPMailer library files
        require_once APPPATH.'third_party/PHPMailer/Exception.php';
        require_once APPPATH.'third_party/PHPMailer/PHPMailer.php';
        require_once APPPATH.'third_party/PHPMailer/SMTP.php';
        
        $mail = new PHPMailer;
        return $mail;
    }

    public function send($email_to,$title,$body){

        require_once APPPATH.'third_party/PHPMailer/Exception.php';
        require_once APPPATH.'third_party/PHPMailer/PHPMailer.php';
        require_once APPPATH.'third_party/PHPMailer/SMTP.php';

        $mail = new PHPMailer;
        
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'picamaderomuebles@gmail.com';
        $mail->Password = 'Zkb?Wx8.ihxi';
        $mail->SMTPSecure = 'tls';
        $mail->Port     = 587;
        
        $mail->setFrom('picamaderomuebles@gmail.com', 'Picamadero');
        $mail->addReplyTo('picamaderomuebles@gmail.com', 'Picamadero');
        
        // Add a recipient
        $mail->addAddress($email_to);

        // Email subject
        $mail->Subject =$title;
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        // Email body content
        $mail->Body = $body;
        
        // Send email
        if(!$mail->send()){
            return $mail->ErrorInfo;
        }else{
            return true;
        }
    }

    public function send_mail_client($order, $products, $data_purchase){

        require_once APPPATH.'third_party/PHPMailer/Exception.php';
        require_once APPPATH.'third_party/PHPMailer/PHPMailer.php';
        require_once APPPATH.'third_party/PHPMailer/SMTP.php';

        $template = file_get_contents("application/views/admin/voucher_client.php", true);
        $template = str_replace("{{order}}",  $order , $template);
        $template = str_replace("{{items}}",  $this->draw_email_client_body($products), $template);
        $template = str_replace("{{year}}", date('Y'), $template);

        if($data_purchase['type_delivery'] == '2'){
            $anexo = "Empresa encargada del delivery:".$data_purchase['enterprise'];
            $address = "<span class='resume-delivery-min'><strong>Dirección de envío: ".$data_purchase['address']." ".$data_purchase['number']." , ".$data_purchase['region']." , ".$data_purchase['comuna']." </strong>  </span>";           
            $template = str_replace("{{anexo_title}}",  $anexo,  $template);
            $template = str_replace("{{address}}",  $address,  $template);
        }
        else if($data_purchase['type_delivery'] == '3'){
            $anexo = "Empresa encargada del delivery:".$data_purchase['enterprise'];
            $address = "<span class='resume-delivery-min'><strong>Dirección de sucursal de retiro ".$data_purchase['enterprise']." : ".$data_purchase['address_office']." , ".$data_purchase['region_office']." , ".$data_purchase['comuna_office']." </strong>  </span>";
            $template = str_replace("{{anexo_title}}",  $anexo,  $template);
            $template = str_replace("{{address}}",  $address,  $template);
        }
        else if($data_purchase['type_delivery']  == '1'){
            $alt = "Su compra ha sido ingresada exitosamente. <strong style = 'font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;'> Retiro disponible desde el ".$data_purchase['date_delivery'].". Lugar de retiro: - Proyectada uno 1712 Galpón 4 barrio industrial Coquimbo, Coquimbo ";
            $template = str_replace("{{anexo_title}}",  "",  $template);
            $template = str_replace("{{descr}}",  $alt,  $template);
            $template = str_replace("{{address}}",  $alt,  $template);
        }

        /* $template = str_replace("{{base_url}}", "https://www.hidratec.cl/" , $template); */

        $mail = new PHPMailer;
        $mail->CharSet = "UTF-8";
        
        // SMTP configuration
       /*  $mail->SMTPDebug = SMTP::DEBUG_SERVER;   */ 
        $mail->isSMTP();
        $mail->Host = 'smtp.googlemail.com';  //gmail SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'baraippox21@gmail.com';   //username
        $mail->Password = 'zffxexawizeeujly';   //password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
        $mail->Port = 465; 
        
        $mail->setFrom('baraippox21@gmail.com', 'Estamos preparando tu compra 012562548');
        
        // Add a recipient
        $mail->addAddress($data_purchase['email']);

        // Email subject
        $mail->Subject ="Sistema de ventas - HIDRATEC";
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        // Email body content
        $mail->Body = $template;
        $env = 'no';
        $noenv = 'so';
        // Send email
        $mail->send();

        /* if(!$mail->send()){
            var_dump($mail->ErrorInfo);
            return $mail->ErrorInfo; 
        }else{
            return true;
        } */
    }


    public function send_mail_seller($order, $products, $data_purchase){

        require_once APPPATH.'third_party/PHPMailer/Exception.php';
        require_once APPPATH.'third_party/PHPMailer/PHPMailer.php';
        require_once APPPATH.'third_party/PHPMailer/SMTP.php';

        $today = date("d-m-Y");


        $template = file_get_contents("application/views/admin/voucher_seller.php", true);
        $template = str_replace("{{date}}",  $today , $template); 
        $template = str_replace("{{order}}",  $order , $template);
        $template = str_replace("{{year}}", date('Y'), $template);
        $template = str_replace("{{name_title}}",  $data_purchase['name'] , $template);
        $template = str_replace("{{name}}",  $data_purchase['name'] , $template);
        $template = str_replace("{{rut}}",  $data_purchase['rut'] , $template);
        $template = str_replace("{{phone}}",  $data_purchase['phone'] , $template);
        $template = str_replace("{{email}}",  $data_purchase['email'] , $template);
        $template = str_replace("{{region}}",  $data_purchase['region_contact'] , $template);
        $template = str_replace("{{comuna}}",  $data_purchase['comuna_contact'] , $template);
        $template = str_replace("{{email}}",  $data_purchase['email'] , $template);
        $template = str_replace("{{purchase_detail}}" , $this->draw_email_seller_body($products) , $template);


        if($data_purchase['type_delivery'] == '2'){
            $header = "<div class='card-title' style='text-align: left; margin-bottom: 15px; font-family: Lato, Tahoma, Sans-Serif;font-weight: 700;font-size: 1.3rem;color: #4A4A4A;'>Tipo De Compra: <strong>Delivery a Domicilio</strong></div><div class='card-body'>"; 
            $enterprise = "<div class='row' style='text-align:left;'><span class='resume-delivery-min'><strong>Empresa Delivery:</strong>".$data_purchase['enterprise']."</span></div>";
            $address = "<div class='row' style='text-align:left;'><span class='resume-delivery-min'><strong>Dirección de envío del pedido:</strong> ".$data_purchase['address']." ".$data_purchase['number']."</span></div>";
            $house = "<div class='row' style='text-align:left;'><span class='resume-delivery-min'><strong>Depto/Casa/Oficina: </strong> ".$data_purchase['dpto']."</span></div>";
            $region = "<div class='row' style='text-align:left;'><span class='resume-delivery-min'><strong>Región:</strong> ".$data_purchase['region']."</span></div>";
            $comuna = "<div class='row' style='text-align:left;'><span class='resume-delivery-min'><strong>Comuna:</strong> ".$data_purchase['comuna']."</span></div>";
            $comentary = "<div class='row' style='text-align:left;'><span class='resume-delivery-min'><strong>Comentarios:</strong> ".$data_purchase['comentary']."</span></div></div>";
            $template = str_replace("{{type_purchase}}",  $header.$enterprise.$address.$house.$region.$comuna.$comentary, $template);

        }else if($data_purchase['type_delivery'] == '3'){
            $header = "<div class='card-title' style='text-align: left; margin-bottom: 15px; font-family: Lato, Tahoma, Sans-Serif;font-weight: 700;font-size: 1.3rem;color: #4A4A4A;'>Tipo De Compra: <strong>Delivery a Sucursal de ".$data_purchase['enterprise']." </strong></div><div class='card-body'>"; 
            $enterprise = "<div class='row' style='text-align:left;'><span class='resume-delivery-min'><strong>Empresa Delivery: </strong>".$data_purchase['enterprise']."</span></div>";
            $address = "<div class='row' style='text-align:left;'><span class='resume-delivery-min'><strong>Dirección de sucursal: </strong> ".$data_purchase['address_office']."</span></div>";
            $region = "<div class='row' style='text-align:left;'><span class='resume-delivery-min'><strong>Región: </strong> ".$data_purchase['region_office']."</span></div>";
            $comuna = "<div class='row' style='text-align:left;'><span class='resume-delivery-min'><strong>Comuna: </strong> ".$data_purchase['comuna_office']."</span></div>";
            $comentary = "<div class='row' style='text-align:left;'><span class='resume-delivery-min'><strong>Comentarios:</strong> ".$data_purchase['comentary_office']."</span></div></div>";
            $template = str_replace("{{type_purchase}}",  $header.$enterprise.$address.$house.$region.$comuna.$comentary, $template);
        }
        else if($data_purchase['type_delivery']  == '1'){

            $header = "<div class='card-title' style='text-align: left; margin-bottom: 15px; font-family: Lato, Tahoma, Sans-Serif;font-weight: 700;font-size: 1.3rem;color: #4A4A4A;'>Tipo De Compra: <strong>Retiro en Casa Matriz Hidratec Coquimbo</strong></div>";
            $delivery ="<div class='card-body'><div class='row' style='text-align:left;'><span class='resume-delivery-min'><strong>Fecha disponible para retiro:</strong> Desde el ".$data_purchase['date_delivery']."</span></div></div>";
            $template = str_replace("{{type_purchase}}",  $header.$delivery,  $template);
        }
 

        /* $template = str_replace("{{base_url}}", "https://www.hidratec.cl/" , $template); */

        $mail = new PHPMailer;
        $mail->CharSet = "UTF-8";
        
        // SMTP configuration
       /*  $mail->SMTPDebug = SMTP::DEBUG_SERVER;   */ 
        $mail->isSMTP();
        $mail->Host = 'smtp.googlemail.com';  //gmail SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = '';   //username
        $mail->Password = '';   //password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
        $mail->Port = 465; 
        
        $mail->setFrom('baraippox21@gmail.com', 'Comprobante de compra Orden '.$order);
        
        // Add a recipient
        $mail->addAddress('');

        // Email subject
        $mail->Subject ="Sistema de ventas - HIDRATEC";
        
        // Set email format to HTML
        $mail->isHTML($isHtml = true);
        
        // Email body content
        $mail->Body = $template;
        $env = 'no';
        $noenv = 'so';
        
        // Send email
        $mail->send();

      /*   if(!$mail->send()){
            var_dump($mail->ErrorInfo);
            return $mail->ErrorInfo;
        }else{
            return true;
        } */
    }


    public function send_approve($email_info, $pdf, $emails){
        require_once APPPATH.'third_party/PHPMailer/Exception.php';
        require_once APPPATH.'third_party/PHPMailer/PHPMailer.php';
        require_once APPPATH.'third_party/PHPMailer/SMTP.php';

        $name = $_SESSION['full_name'];
        $email = $_SESSION['email'];

        $template = file_get_contents("application/views/client/approve_email.php", true);
        $template = str_replace("{{ot}}", $email_info[0]['number_ot'], $template);
        $template = str_replace("{{client}}", $name, $template);
        $template = str_replace("{{enterprise}}", $email_info[0]['enterprise'], $template);
        $template = str_replace("{{year}}", date('Y'), $template);
        $template = str_replace("{{operating_system}}", get_os(), $template);
        $template = str_replace("{{browser_name}}", get_brow(), $template);
        
        $mail = new PHPMailer(True);
        $mail->CharSet = "UTF-8";
        
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.googlemail.com';  //gmail SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'servicio@hidratec.cl';   //username
        $mail->Password = 'Ht687364';   //password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465; 
        
        $mail->setFrom('servicio@hidratec.cl', 'Sistema de notificación Hidratec');
        
        // Add a recipient
        for($i=0; $i< count($emails); $i++){
            $mail->addAddress($emails[$i]['email']);
        }
      
        // Email subject
        $mail->Subject ="Aprobación OT ".$email_info[0]['number_ot'];
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        //Email attachment
        $url = 'assets/upload/purshaseOrder/'.$pdf;
        $mail->addAttachment($url,'OrdenCompra'.$email_info[0]['number_ot'].'.pdf');

        // Email body content
        $mail->Body = $template;
        $env = 'no';
        $noenv = 'so';
        // Send email
        if(!$mail->send()){
            return $mail->ErrorInfo;
        }else{
            return true;
        }
    }
    private function draw_email_client_body($products){
     
        $body = '';
        foreach ($products as &$product) {
            $base = substr($product['price'], 1, null);
            $base_without_dot = preg_replace('/[\@\.\;\" "]+/', '', $base);
            $base_int = (int) $base_without_dot;
            $price_total_pr = $this->format_price($base_int * (int)($product['cantidad']));
            
            $header = "<div class='row'><div class='col-6 col-sm-6'>";
            $name = "<div class='col-12 col-sm-12' style='text-align:left;'><span class='resume-delivery-min'>Producto: ".$product['name']."</span></div>";
            $quantity = "<div class='col-12 col-sm-12' style='text-align:left;'><span class='resume-delivery-min'>Cantidad: ".$product['cantidad']." un.</span></div>";
            $price_un = "<div class='col-12 col-sm-12' style='text-align:left;'><span class='resume-delivery-text'>Precio Unitario: ".$product['price']."</span></div>";
            $price_total = "<div class='col-12 col-sm-12' style='text-align:left;'><span class='resume-delivery-text'>Precio Total: ".$price_total_pr."</span></div></div>";
            /*$img = "<div class='col-6 col-sm-6'><img style='width: 100px; height: 100px;' src='https://www.hidratec.cl/assets/images/products/image_first/".$product['image_first']." alt=''></div></div><hr>"; */
            $img = "<div class='col-6 col-sm-6'><img style='width: 100px; height: 100px;' src='https://www.hidratec.cl/assets/images/products/image_first/d8aed1ebd42a144c5ea69ce3473732b3.jpeg' alt=''></div></div><hr>";
            $body = $body.$header.$name.$quantity.$price_un.$price_total.$img;
        }
        return $body;
    }

    private function draw_email_seller_body($products){

        $body = '';
        foreach ($products as &$product) {
            $base = substr($product['price'], 1, null);
            $base_without_dot = preg_replace('/[\@\.\;\" "]+/', '', $base);
            $base_int = (int) $base_without_dot;
            $price_total_pr = $this->format_price($base_int * (int)($product['cantidad']));
            
            $header ="<tr><td>".$product['name']."</td><td>".$product['code']."</td><td>".$product['price']."</td><td>".$product['cantidad']."</td><td>".$price_total_pr."</td></tr>";
            $body = $body.$header;
        }
        return $body;
    }

    private function format_price($total){

        $numero = (string)$total;
        $puntos = floor((strlen($numero)-1)/3);
        $tmp = "";
        $pos = 1;
        for($i=strlen($numero)-1; $i>=0; $i--){
        $tmp = $tmp.substr($numero, $i, 1);
        if($pos%3==0 && $pos!=strlen($numero))
        $tmp = $tmp.".";
        $pos = $pos + 1;
        }
        $formateado = "$ ".strrev($tmp);
        return $formateado;
    }

}
