<?php

class OutstandingModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    // get data sections - Web site
    public function get_outstanding()
    {   
        $sql= "SELECT * FROM outstanding";
        return $this->db->query($sql)->result_array();

    }

   /* 
    // cpanel get data for sections ( example : about_hidratec)
    public function get_sections($data)
    {   
        $sql= "SELECT * FROM sections WHERE section = ?";
        return $this->db->query($sql,array($data['section']))->result_array();

    }*/


    // update not images items
    public function update_not_image($data)

    {   
        // id , title , description , desc_state
       $section = array();
        if( $data['desc_boolean']){
            $section = array( 
                "title" => $data["title"] , 
                "description" => $data["description"], 
                );
           
        }else{

            $section = array( 
                "title" => $data["title"] , 
                );

        }
        
        try {
            $this->db->where("id", $data['id']);
           return $this->db->update("outstanding", $section);
          
        
         
        } catch (Exception $e) {
            $s = array(
                "id" => null,
                "status" => "fail"
            );
            return $s;
        }
    }






   

    public function update_outstanding($data)

    {   
        $section = array( 
        "date_expiration" => $data["date_expiration"] , 
        );
   

        try {
            $this->db->where("id", $data['id']);
           return $this->db->update("outstanding", $section);
          
        
         
        } catch (Exception $e) {
            $s = array(
                "id" => null,
                "status" => "fail"
            );
            return $s;
        }
    }


    public function up_image($id_image, $url)
    {  


        $data = array( 'url' => $url, );
    
        try {
            
            $this->db->where("id", $id_image);
            $this->db->update("outstanding", $data);
            return "success";
        } catch (Exception $e) {
            return "fail";
        }
    }



    


}