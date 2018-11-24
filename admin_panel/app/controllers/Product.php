<?php

class Product extends CI_Controller{
    function __construct()
    {
        parent::__construct();
       $this->load->model('Product_model');

        
    } 

    public function fetchcategories()
    {
     
          $result=$this->Product_model->fetchcategories();
        
          if($result['rc']==true || $result['rc']==1)
          {
             $response['rc']=true;
             $response['data']=$result['data'];
          }
          else
          {
             $response['rc']=false;
          }
          echo json_encode($response);
       
    }

     public function fetchproducts()
    {
     
          $result=$this->Product_model->fetchproducts();
        
          if($result['rc']==true || $result['rc']==1)
          {
             $response['rc']=true;
             $response['data']=$result['data'];
          }
          else
          {
             $response['rc']=false;
          }
          echo json_encode($response);
       
    }

    public function fetchcartproduct()
    {

   
       $result=$this->Product_model->fetchcartproduct($_POST);
        
          if($result['rc']==true || $result['rc']==1)
          {
             $response['rc']=true;
             $response['data']=$result['data'];
          }
          else
          {
             $response['rc']=false;
          }
          echo json_encode($response);
    }

     public function add_product()
    {

        if(!empty($_POST))
        {
          $result=$this->Product_model->add_product($_POST,$_FILES);
        
          if($result['rc']==true || $result['rc']==1)
          {
             $response['rc']=true;
             $response['msg']="Product Added Successfully";
          }
          else
          {
             $response['rc']=false;
             $response['msg']="Unsuccessful";
          }
          echo json_encode($response);
        }
    }

    public function addtocart()
    {
       if(!empty($_POST))
        {
          $result=$this->Product_model->addtocart($_POST);
        
          if($result['rc']==true || $result['rc']==1)
          {
             $response['rc']=true;
             $response['msg']="Product Added Into Cart Successfully";
          }
          else
          {
             $response['rc']=false;
             $response['msg']="Unsuccessful";
          }
          echo json_encode($response);
        }
    }

    public function order_completed()
    {
       if(!empty($_POST))
        {
          $result=$this->Product_model->order_completed($_POST);
        
          if($result['rc']==true || $result['rc']==1)
          {
             $response['rc']=true;
             $response['msg']="Order Completed Successfully";
          }
          else
          {
             $response['rc']=false;
             $response['msg']="Unsuccessful";
          }
          echo json_encode($response);
        }
    }

    public function remove_product()
    {
       if(!empty($_POST))
        {
          $result=$this->Product_model->remove_product($_POST);
        
          if($result['rc']==true || $result['rc']==1)
          {
             $response['rc']=true;
             $response['msg']="Product Remove From Cart Successfully";
          }
          else
          {
             $response['rc']=false;
             $response['msg']="Unsuccessful";
          }
          echo json_encode($response);
        }
    }

}
