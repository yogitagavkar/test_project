<?php

class Category extends CI_Controller{
    function __construct()
    {
        parent::__construct();
       $this->load->model('Category_model');

        
    } 

    public function add_category()
    {
        if(!empty($_POST))
        {
          $result=$this->Category_model->add_category($_POST);
        
          if($result['rc']==true || $result['rc']==1)
          {
             $response['rc']=true;
             $response['msg']="Category Added Successfully";
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
