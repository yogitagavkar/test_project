<?php

class Model extends CI_Controller{
    function __construct()
    {
        parent::__construct();
       $this->load->model('Manufacturer_model');

        
    } 

    public function fetchmanufacturer()
    {
     
          $result=$this->Manufacturer_model->fetchmanufacturer();
        
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


    public function add_manufacturer()
    {

      // print_r($_POST);
      // exit;
      $this->form_validation->set_rules("manufacturer_name","Manufacturer Name","required|trim");
      if($this->form_validation->run())
      {
      
            $result=$this->Manufacturer_model->add_manufacturer($_POST);
        
          if($result['rc']==true || $result['rc']==1)
          {
             $response['rc']=true;
             $response['msg']="Manufacturer Added Successfully";
          }
          else
          {
             $response['rc']=false;
             $response['msg']="Unsuccessful";
          }
        
      }
      else
      {
          $response['rc']=false;
          $response['msg']="Manufacturer Name Require";
      }
        echo json_encode($response);
        
    }



}
