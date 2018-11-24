<?php 
class Users_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

  

    public function register($data)
    {
      
       $this->db->select('count(*)');
       $this->db->from('users');
       $this->db->where('email',$data['email']);
       $resultdata = $this->db->get()->row_array();

       if($resultdata['count(*)'] > 0)
       {
         
        
            $response['rc']=false;
            $response['msg']="User Already Exist";
                         
       }
       else
       {

         $registerdata=array("name"=>$data['username'],
          "password"=>md5($data['password']),
          "email"=>$data['email'],
          "address"=>$data['address'],
          "mobile"=>$data['mobile'],
          'is_admin'=>1);

                $result=$this->db->insert("users",$registerdata);
                $id=$this->db->insert_id();

                           if($result==1)
                           {
                              $response['rc']=true;
                              $response['user_id']=$id;
                              $response['is_admin']=0;
                            
                           }
                           else
                           {
                               $response['rc']=false;
                             
                           }
       }
     

       return $response;
    }

     public function login($data)
    {
        $this->db->select('*');
       $this->db->from('users');
       $this->db->where('email',$data['email']);
       $this->db->where('password',md5($data['password']));
       $result = $this->db->get()->row_array();

                         if($result['user_id']!='')
                         {
                            $response['rc']=true;
                            $response['user_id']=$result['user_id'];
                            $response['is_admin']=$result['is_admin'];
                          
                         }
                         else
                         {
                             $response['rc']=false;
                           
                         }

       return $response;
    }

    
   
}
