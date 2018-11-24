<?php

class Order extends CI_Controller{
    function __construct()
    {
        parent::__construct();
       $this->load->model('Order_model');

        
    } 

    public function fetchorders()
    {
     
          $result=$this->Order_model->fetchorders();
        
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


}
