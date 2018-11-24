<?php 
class Category_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

  

       public function add_category($data)
    {
      
       $result=$this->db->insert("categories",$data);

       if($result==1)
       {
          $response['rc']=true;
        
       }
       else
       {
           $response['rc']=false;
         
       }

      return $response;

    }
   
}
