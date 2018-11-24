<?php 
class Order_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

  

     public function fetchorders()
    {
      
       $this->db->select('orders.*,products.*,categories.*,users.*,cart.*');
       $this->db->from('orders');
       $this->db->join('cart','cart.order_id=orders.order_id',"left");
       $this->db->join('products','products.product_id=cart.product_id',"left");
       $this->db->join('categories','categories.category_id=products.category_id',"left");
       $this->db->join('users','users.user_id=orders.user_id',"left");
       
       $this->db->order_by('orders.order_id',"desc");
       $result = $this->db->get()->result_array();

       if(!empty($result))
       {
          $response['rc']=true;
          $response['data']=$result;
        
       }
       else
       {
           $response['rc']=false;
         
       }

      return $response;

    }

}