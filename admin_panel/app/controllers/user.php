<?php

class User extends CI_Controller{
    function __construct()
    {
        parent::__construct();
       $this->load->model('Users_model');

        
    } 


     public function register()
    {


        if(!empty($_POST))
        {

          $result=$this->Users_model->register($_POST);
        
          if($result['rc']==true || $result['rc']==1)
          {
             $response['rc']=true;
             $response['msg']="User Register Successfully";
             $response['user_id']=$result['user_id'];
             $response['is_admin']=$result['is_admin'];
          }
          else
          {
             $response['rc']=false;
             if($result['msg']!="")
             {
                $response['msg']=$result['msg'];
             }
             else
             {
                $response['msg']="Unsuccessful";
             }
            
          }
          echo json_encode($response);
        }
    }

     public function login()
    {
     
       $result=$this->Users_model->login($_POST);
        
          if($result['rc']==true || $result['rc']==1)
          {
             $response['rc']=true;
             $response['user_id']=$result['user_id'];
             $response['is_admin']=$result['is_admin'];
          }
          else
          {
             $response['rc']=false;
             $response['msg']="Invalid Login Details";
          }
          echo json_encode($response);
    }

   

}
