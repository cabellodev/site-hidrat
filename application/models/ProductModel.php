<?php
class ProductModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_category()
    {   
        $sql= "SELECT * FROM category";
        return $this->db->query($sql)->result_array();
    }

// get subcategory from search selector
    public function get_subcategory($id_category){   

        $sql= "SELECT * FROM subcategory WHERE category_id= ?";
        return $this->db->query($sql,array($id_category))->result_array();

    }
// get subcategory (all subcategories)

public function get_supplier()
{   
    $sql= "SELECT * FROM supplier";
    return $this->db->query($sql)->result_array();
}


public function get_product()
{   
    $sql="SELECT p.id ,p.name name, p.description, p.model, p.code, p.price, p.stock, p.image_first ,sc.name subcategory, c.name category , s.name supplier
    FROM product p
    JOIN category c ON c.id = p.category_id
    JOIN supplier s ON s.id= p.supplier_id
    LEFT JOIN subcategory sc ON sc.id= p.subcategory_id
    LEFT JOIN subsubcategory ssc ON ssc.id= p.subsubcategory_id
    ";
    return $this->db->query($sql)->result_array();
}




   public function simple_search($data){

        if($data['supplier']!=0 && $data['name_product']!=""){
            $id=(int)$data['name_product'];
            if($id < 0){ //es una categoria 
                $id_category= ($id*-1);
               
                $query = "SELECT p.id ,p.name , c.name category , s.name supplier,p.image_first
                        FROM product p
                        LEFT JOIN supplier s ON s.id= p.supplier_id
                        LEFT JOIN category c ON c.id = p.category_id
                        WHERE p.category_id = ? and p.supplier_id =?"; 
                        return  $this->db->query($query,array($id_category,$data['supplier']))->result_array();
            }else { //es un nombre de producto
               
                $query = "SELECT p.id ,p.name , c.name category , s.name supplier,p.image_first
                        FROM product p
                        LEFT JOIN supplier s ON s.id= p.supplier_id
                        LEFT JOIN category c ON c.id = p.category_id
                        WHERE p.id=? and p.supplier_id =?"; 
                        return  $this->db->query($query,array($id,$data['supplier']))->result_array();  }
                    
        }else if($data['name_product']!=0 && ($data['supplier']==0 ||$data['supplier']=="" )){
            
            $id=(int)$data['name_product'];

            if($id < 0){
                $id_category= ($id*-1);
               
                $query = "SELECT p.id ,p.name , c.name category , s.name supplier,p.image_first
                        FROM product p
                        LEFT JOIN supplier s ON s.id= p.supplier_id
                        LEFT JOIN category c ON c.id = p.category_id
                        WHERE p.category_id = ? "; 
                        return  $this->db->query($query,array($id_category))->result_array();
            }else {
               
                $query = "SELECT p.id ,p.name , c.name category , s.name supplier,p.image_first
                        FROM product p
                        LEFT JOIN supplier s ON s.id= p.supplier_id
                        LEFT JOIN category c ON c.id = p.category_id
                        WHERE p.id=?"; 
                        return  $this->db->query($query,array($id))->result_array(); 
            }

        }else if ($data['supplier']!=0 && ($data['name_product']==0||$data['name_product']=="")){

                $query = "SELECT p.id ,p.name , c.name category , s.name supplier,p.image_first
                            FROM product p
                            LEFT JOIN supplier s ON s.id= p.supplier_id
                            LEFT JOIN category c ON c.id = p.category_id
                            WHERE p.supplier_id=?"; 
                            return  $this->db->query($query,array($data['supplier']))->result_array();
        }
   }

   /*
    public function get_products($data){ 

            $category=$data['category'];
            $supplier=$data['supplier'];
            $subcategory=$data['subcategory'];
            $subsubcategory= $data['subsubcategory'];
            $product_name = $data['name_product'];

    
           
            if($product_name ==""){

                    if($supplier !=0 && $category ==0 && $subcategory ==0 && $subsubcategory ==0){

                        $query = "SELECT p.id ,p.name ,sc.name subcategory, c.name category , s.name supplier,p.image_first
                        FROM product p
                        LEFT JOIN category c ON c.id = p.category_id
                        LEFT JOIN supplier s ON s.id= p.supplier_id
                        LEFT JOIN subcategory sc ON sc.id= p.subcategory_id
                        LEFT JOIN subsubcategory ssc ON ssc.id= p.subsubcategory_id
                        WHERE p.supplier_id=? 
                        "; 
                        return  $this->db->query($query,array($supplier))->result_array();

                    }else if ($supplier !=0 && $category !=0 && $subcategory ==0 && $subsubcategory ==0){
                        $query = "SELECT p.id ,p.name ,sc.name subcategory, c.name category , s.name supplier,p.image_first
                        FROM product p
                        LEFT JOIN category c ON c.id = p.category_id
                        LEFT JOIN supplier s ON s.id= p.supplier_id
                        LEFT JOIN subcategory sc ON sc.id= p.subcategory_id
                        LEFT JOIN subsubcategory ssc ON ssc.id= p.subsubcategory_id
                        WHERE p.supplier_id=? AND p.category_id =? 
                        "; 

                        return  $this->db->query($query,array($supplier,$category))->result_array();

                    }else if ($supplier !=0 && $category !=0 && $subcategory !=0 && $subsubcategory ==0){

                        $query = "SELECT p.id ,p.name ,sc.name subcategory, c.name category , s.name supplier,p.image_first
                        FROM product p
                        LEFT JOIN category c ON c.id = p.category_id
                        LEFT JOIN supplier s ON s.id= p.supplier_id
                        LEFT JOIN subcategory sc ON sc.id= p.subcategory_id
                        LEFT JOIN subsubcategory ssc ON ssc.id= p.subsubcategory_id
                        WHERE p.supplier_id=? AND p.category_id =? AND p.subcategory_id =? 
                        "; 

                        return  $this->db->query($query,array($supplier,$category,$subcategory))->result_array();

                    }else if ($supplier !=0 && $category !=0 && $subcategory !=0 && $subsubcategory !=0){

                        $query = "SELECT p.id ,p.name ,sc.name subcategory, c.name category , s.name supplier,p.image_first
                        FROM product p
                        LEFT JOIN category c ON c.id = p.category_id
                        LEFT JOIN supplier s ON s.id= p.supplier_id
                        LEFT JOIN subcategory sc ON sc.id= p.subcategory_id
                        LEFT JOIN subsubcategory ssc ON ssc.id= p.subsubcategory_id
                        WHERE p.supplier_id=? AND p.category_id =? AND p.subcategory_id =? AND p.subsubcategory_id =?
                        "; 

                        return  $this->db->query($query,array($supplier,$category,$subcategory,$subsubcategory))->result_array();
                    
                    }else if ($supplier ==0 && $category !=0 && $subcategory ==0 && $subsubcategory ==0){

                        $query = "SELECT p.id ,p.name ,sc.name subcategory, c.name category , s.name supplier,p.image_first
                        FROM product p
                        LEFT JOIN category c ON c.id = p.category_id
                        LEFT JOIN supplier s ON s.id= p.supplier_id
                        LEFT JOIN subcategory sc ON sc.id= p.subcategory_id
                        LEFT JOIN subsubcategory ssc ON ssc.id= p.subsubcategory_id
                        WHERE p.category_id =? 
                        "; 

                    return  $this->db->query($query,array($category))->result_array();
                    
                    }else if ($supplier ==0 && $category !=0 && $subcategory !=0 && $subsubcategory ==0){

                        $query = "SELECT p.id ,p.name ,sc.name subcategory, c.name category , s.name supplier,p.image_first
                        FROM product p
                        LEFT JOIN category c ON c.id = p.category_id
                        LEFT JOIN supplier s ON s.id= p.supplier_id
                        LEFT JOIN subcategory sc ON sc.id= p.subcategory_id
                        LEFT JOIN subsubcategory ssc ON ssc.id= p.subsubcategory_id
                        WHERE p.category_id =? AND p.subcategory_id = ?
                        "; 

                    return  $this->db->query($query,array($category,$subcategory))->result_array();
                    
                    }else if ($supplier ==0 && $category !=0 && $subcategory !=0 && $subsubcategory !=0){

                        $query = "SELECT p.id ,p.name ,sc.name subcategory, c.name category , s.name supplier,p.image_first
                        FROM product p
                        LEFT JOIN category c ON c.id = p.category_id
                        LEFT JOIN supplier s ON s.id= p.supplier_id
                        LEFT JOIN subcategory sc ON sc.id= p.subcategory_id
                        LEFT JOIN subsubcategory ssc ON ssc.id= p.subsubcategory_id
                        WHERE p.category_id =? AND p.subcategory_id = ? AND p.subsubcategory_id =?
                        "; 

                    return  $this->db->query($query,array($category,$subcategory,$subsubcategory))->result_array();
                    
                    }

        }else{

                    if($supplier !=0 && $category ==0 && $subcategory ==0 && $subsubcategory ==0){
                       
                        $query = "SELECT p.id ,p.name ,sc.name subcategory, c.name category , s.name supplier,p.image_first
                        FROM product p
                        LEFT JOIN category c ON c.id = p.category_id
                        LEFT JOIN supplier s ON s.id= p.supplier_id
                        LEFT JOIN subcategory sc ON sc.id= p.subcategory_id
                        LEFT JOIN subsubcategory ssc ON ssc.id= p.subsubcategory_id
                        WHERE p.supplier_id=? AND  p.name LIKE ?
                        "; 
                        return  $this->db->query($query,array($supplier,$product_name))->result_array();

                    }else if ($supplier !=0 && $category !=0 && $subcategory ==0 && $subsubcategory ==0){
                        $query = "SELECT p.id ,p.name ,sc.name subcategory, c.name category , s.name supplier,p.image_first
                        FROM product p
                        LEFT JOIN category c ON c.id = p.category_id
                        LEFT JOIN supplier s ON s.id= p.supplier_id
                        LEFT JOIN subcategory sc ON sc.id= p.subcategory_id
                        LEFT JOIN subsubcategory ssc ON ssc.id= p.subsubcategory_id
                        WHERE p.supplier_id=? AND p.category_id =? AND p.name LIKE ?
                        "; 
                         
                        return  $this->db->query($query,array($supplier,$category,$product_name))->result_array();

                    }else if ($supplier !=0 && $category !=0 && $subcategory !=0 && $subsubcategory ==0){

                        $query = "SELECT p.id ,p.name ,sc.name subcategory, c.name category , s.name supplier,p.image_first
                        FROM product p
                        LEFT JOIN category c ON c.id = p.category_id
                        LEFT JOIN supplier s ON s.id= p.supplier_id
                        LEFT JOIN subcategory sc ON sc.id= p.subcategory_id
                        LEFT JOIN subsubcategory ssc ON ssc.id= p.subsubcategory_id
                        WHERE p.supplier_id=? AND p.category_id =? AND p.subcategory_id =? AND p.name like ?
                        "; 

                        return  $this->db->query($query,array($supplier,$category,$subcategory,$product_name))->result_array();

                    }else if ($supplier !=0 && $category !=0 && $subcategory !=0 && $subsubcategory !=0){

                        $query = "SELECT p.id ,p.name ,sc.name subcategory, c.name category , s.name supplier,p.image_first
                        FROM product p
                        LEFT JOIN category c ON c.id = p.category_id
                        LEFT JOIN supplier s ON s.id= p.supplier_id
                        LEFT JOIN subcategory sc ON sc.id= p.subcategory_id
                        LEFT JOIN subsubcategory ssc ON ssc.id= p.subsubcategory_id
                        WHERE p.supplier_id=? AND p.category_id =? AND p.subcategory_id =? AND p.subsubcategory_id =? AND p.name LIKE ?
                        "; 

                    return  $this->db->query($query,array($supplier,$category,$subcategory,$subsubcategory,$product_name))->result_array();
                    
                    }else if ($supplier ==0 && $category !=0 && $subcategory ==0 && $subsubcategory ==0){

                        $query = "SELECT p.id ,p.name ,sc.name subcategory, c.name category , s.name supplier,p.image_first
                        FROM product p
                        LEFT JOIN category c ON c.id = p.category_id
                        LEFT JOIN supplier s ON s.id= p.supplier_id
                        LEFT JOIN subcategory sc ON sc.id= p.subcategory_id
                        LEFT JOIN subsubcategory ssc ON ssc.id= p.subsubcategory_id
                        WHERE p.category_id =? AND p.name LIKE ?
                        "; 

                    return  $this->db->query($query,array($category,$product_name))->result_array();
                    
                    }else if ($supplier ==0 && $category !=0 && $subcategory !=0 && $subsubcategory ==0){

                        $query = "SELECT p.id ,p.name ,sc.name subcategory, c.name category , s.name supplier,p.image_first
                        FROM product p
                        LEFT JOIN category c ON c.id = p.category_id
                        LEFT JOIN supplier s ON s.id= p.supplier_id
                        LEFT JOIN subcategory sc ON sc.id= p.subcategory_id
                        LEFT JOIN subsubcategory ssc ON ssc.id= p.subsubcategory_id
                        WHERE p.category_id =? AND p.subcategory_id = ? AND p.name LIKE ?
                        "; 

                    return  $this->db->query($query,array($category,$subcategory,$product_name))->result_array();
                    
                    }else if ($supplier ==0 && $category !=0 && $subcategory !=0 && $subsubcategory !=0){

                        $query = "SELECT p.id ,p.name ,sc.name subcategory, c.name category , s.name supplier,p.image_first
                        FROM product p
                        LEFT JOIN category c ON c.id = p.category_id
                        LEFT JOIN supplier s ON s.id= p.supplier_id
                        LEFT JOIN subcategory sc ON sc.id= p.subcategory_id
                        LEFT JOIN subsubcategory ssc ON ssc.id= p.subsubcategory_id
                        WHERE p.category_id =? AND p.subcategory_id = ? AND p.subsubcategory_id =? AND p.name LIKE ?
                        "; 

                    return  $this->db->query($query,array($category,$subcategory,$subsubcategory,$product_name))->result_array();
                    
                    }else if ($supplier ==0 && $category ==0 && $subcategory ==0 && $subsubcategory ==0){

                        $query = "SELECT p.id ,p.name ,sc.name subcategory, c.name category , s.name supplier,p.image_first
                        FROM product p
                        LEFT JOIN category c ON c.id = p.category_id
                        LEFT JOIN supplier s ON s.id= p.supplier_id
                        LEFT JOIN subcategory sc ON sc.id= p.subcategory_id
                        LEFT JOIN subsubcategory ssc ON ssc.id= p.subsubcategory_id
                        WHERE  p.name LIKE ?
                        "; 

                    return  $this->db->query($query,array($product_name))->result_array();}

        }
            /*
            if( $supplier=="0" && $category != "0" && $subcategory=="0" && $subsubcategory=="0"){

                $query = "SELECT p.id ,p.name ,sc.name subcategory, c.name category , s.name supplier,p.image_first
                FROM product p
                LEFT JOIN category c ON c.id = p.category_id
                LEFT JOIN supplier s ON s.id= p.supplier_id
                WHERE p.category_id = ? 
                "; 
                return  $this->db->query($query,array($category))->result_array();

            }else if($supplier=="0" && $category!="0" && $subcategory !="0" && $subsubcategory=="0"){

                $query = "SELECT p.id ,p.name ,sc.name subcategory, c.name category , s.name supplier,p.image_first
                FROM product p
                LEFT JOIN category c ON c.id = p.category_id
                LEFT JOIN supplier s ON s.id= p.supplier_id
                LEFT JOIN subcategory sc ON sc.id= p.subcategory_id
                WHERE p.category_id = ? AND p.subcategory_id = ? 
                "; 
                 return  $this->db->query($query,array($category,$subcategory))->result_array();

            }else if($supplier!="0" && $category!="0" && $subcategory !="0" && $subsubcategory=="0"){

                $query = "SELECT p.id ,p.name ,sc.name subcategory, c.name category , s.name supplier,p.image_first
                FROM product p
                LEFT JOIN category c ON c.id = p.category_id
                LEFT JOIN supplier s ON s.id= p.supplier_id
                LEFT JOIN subcategory sc ON sc.id= p.subcategory_id
                WHERE p.supplier_id =? AND p.category_id = ? AND p.subcategory_id = ? 
                "; 
                 return  $this->db->query($query,array($supplier,$category,$subcategory))->result_array();

            }else if($supplier==0 && $category!=0 && $subcategory !=0 && $subsubcategory!=0){

                $query = "SELECT p.id ,p.name ,sc.name subcategory, c.name category , s.name supplier,p.image_first
                FROM product p
                LEFT JOIN category c ON c.id = p.category_id
                LEFT JOIN supplier s ON s.id= p.supplier_id
                LEFT JOIN subcategory sc ON sc.id= p.subcategory_id
                LEFT JOIN subsubcategory ssc ON ssc.id= p.subsubcategory_id
                WHERE  p.category_id = ? AND p.subcategory_id = ? AND p.subsubcategory_id = ? 
                "; 
                 return  $this->db->query($query,array($category,$subcategory,$sub$subcategory))->result_array();

       
            }else if($supplier!=0 && $category!=0 && $subcategory !=0 && $subsubcategory!=0){

                $query = "SELECT p.id ,p.name ,sc.name subcategory, c.name category , s.name supplier,p.image_first
                FROM product p
                LEFT JOIN category c ON c.id = p.category_id
                LEFT JOIN supplier s ON s.id= p.supplier_id
                LEFT JOIN subcategory sc ON sc.id= p.subcategory_id
                LEFT JOIN subsubcategory ssc ON ssc.id= p.subsubcategory_id
                WHERE p.supplier_id=? AND p.category_id = ? AND p.subcategory_id = ? AND p.subsubcategory_id = ? 
                "; 
                 return  $this->db->query($query,array($supplier,$category,$subcategory,$sub$subcategory))->result_array();

            }else if($supplier!=0 && $category==0 && $subcategory ==0 && $subsubcategory==0){

                $query = "SELECT p.id ,p.name ,sc.name subcategory, c.name category , s.name supplier,p.image_first
                FROM product p
                LEFT JOIN category c ON c.id = p.category_id
                LEFT JOIN supplier s ON s.id= p.supplier_id
                WHERE p.supplier_id=?
                "; 
                 return  $this->db->query($query,array($supplier))->result_array();

            }
    
 
           
    

    }*/


// agregar esta funcion al proyecto 

   public function get_products_id($id){
    
    $query = "SELECT p.id ,p.name name , p.price, p.stock, p.description ,p.model , p.code ,sc.name subcategory, c.name category , s.name supplier,p.image_first, p.images 
    FROM product p
    JOIN category c ON c.id = p.category_id
    JOIN supplier s ON s.id= p.supplier_id
    LEFT JOIN subcategory sc ON sc.id= p.subcategory_id
    LEFT JOIN subsubcategory ssc ON ssc.id= p.subsubcategory_id
    WHERE  p.id = ?
    "; 
    
     return $this->db->query($query,array($id))->result_array();
  
   } 
}