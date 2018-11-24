<?php

class Manufacturer extends CI_Controller{
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

     public function fetchmodel()
    {
     
          $result=$this->Manufacturer_model->fetchmodel();
        
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

    public function delete_model()
    {

      if(!empty($_POST['manufacturer_id']))
      {
      
            $result=$this->Manufacturer_model->delete_model($_POST);
        
          if($result['rc']==true || $result['rc']==1)
          {
             $response['rc']=true;
             $response['msg']="Model Sold Out Successfully";
          }
          else
          {
             $response['rc']=false;
             $response['msg']="Unsuccessful";
          }
        
      }
    
        echo json_encode($response);
    }

    public function view_details()
    {



       if(!empty($_POST['model_ids']))
      {


      
            $result=$this->Manufacturer_model->view_details($_POST);
        
          if($result['rc']==true || $result['rc']==1)
          {
             $response['rc']=true;
             $response['data']=$result['data'];
          }
          else
          {
             $response['rc']=false;
             $response['msg']="Unsuccessful";
          }
        
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

     function reArrayFiles(&$file_post) {

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}

    public function add_model()
    {

       $this->form_validation->set_rules("manufacturer_id","Manufacturer Name","required|trim");
       $this->form_validation->set_rules("model_name","Model Name","required|trim");
       $this->form_validation->set_rules("color","color","required|trim");
       $this->form_validation->set_rules("manufacturing_year","manufacturing year","required|trim");
       $this->form_validation->set_rules("registration_no","registration no","required|trim");
       $this->form_validation->set_rules("note","Note","required|trim");
     // $this->form_validation->set_rules("image[]","Image","required|trim");
       
      if($this->form_validation->run())
      {
            $file_ary = $this->reArrayFiles($_FILES['image']);
            $result=$this->Manufacturer_model->add_model($_POST,$file_ary);
        
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
         // $response['msg']="Manufacturer Name Require";
      }
        echo json_encode($response);
       
    }



}
