<?php 
class Product_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

  

     public function fetchcategories()
    {
      
       $this->db->select('*');
       $this->db->from('categories');
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

    public function fetchproducts()
    {
       $this->db->select('products.*,categories.*');
       $this->db->from('products');
       $this->db->join('categories','categories.category_id=products.category_id');
     
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

    public function fetchcartproduct($data)
    {
       $this->db->select('products.*,categories.*,cart.*');
       $this->db->from('cart');
       $this->db->join('products','products.product_id=cart.product_id',"left");
       $this->db->join('categories','categories.category_id=products.category_id',"left");
       $this->db->where('cart.user_id',$data['user_id']);
       $this->db->where('cart.order_status!="completed"');
     
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

    public function add_product($data,$files)
    {

       if( isset($files['image']['name']) && $files['image']['error']=='0'  && isset($data))
              {
               
                $dir = FCPATH . "product_image/";

                if(is_dir($dir))
                {  
                  chmod($dir, 0777);
                }


                  if($files['image']['type']== "image/jpg" || $files['image']['type'] == "image/png" || $files['image']['type'] == "image/jpeg" || $files['image']['type'] == "image/gif" || $files['image']['type'] == "application/pdf")
                  {



                    $type = explode('/', $files['image']['type']);
             
                    $hash  = md5(rand(1, 1000000).time()).'.'.$type[1];
                    if( ! is_dir($dir) )
                    {  
                      @mkdir($dir, 0777,TRUE);
                    }

                    if(move_uploaded_file($files['image']['tmp_name'], $dir.$hash))
                    {


                      $image_details = array(
                        "product_name"=>$data['product_name'],
                        "image" => $hash,
                        "category_id"=>$data['category_id'],
                        "description"=>$data['description'],
                        "price"=>$data['price'],
                 
                        );

                        $result=$this->db->insert("products",$image_details);

                         if($result==1)
                         {
                            $response['rc']=true;
                          
                         }
                         else
                         {
                             $response['rc']=false;
                           
                         }

                      
                      
                    }
                  }
                

               
                
              }
              else
              {
                 $response['rc']=false;
              }
      
     
      return $response;

    }

    public function addtocart($data)
    {
              $result=$this->db->insert("cart",$data);
              $id=$this->db->insert_id();

                         if($result==1)
                         {
                            $response['rc']=true;
                            $response['data']=$id;
                          
                         }
                         else
                         {
                             $response['rc']=false;
                           
                         }

       return $response;
    }

      public function remove_product($data)
    {
           $this->db->where("cart_id",$data['cart_id']);
           $result=$this->db->delete("cart");

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

    public function order_completed($data)
    {
      $checkdata=array("user_id"=>$data['user_id'],
        "order_type"=>'cash on delivery',
        "order_status"=>"completed"
      );
      $result=$this->db->insert("orders",$checkdata);
      $id=$this->db->insert_id();
       foreach($data['cart_data'] as $val)
       {
           $cartdata=array("order_id"=>$id,
            "order_status"=>"completed"
             );
           $this->db->where("cart_id",$val);
           $this->db->update("cart",$cartdata);
       }

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
