<?php 
class Manufacturer_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

  

     public function fetchmanufacturer()
    {
      
       $this->db->select('*');
       $this->db->from('manufacturer');
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

    public function view_details($data)
    {
       $ids=explode(",",trim($data['model_ids']));
        if(count($ids) > 1)
        {


          foreach($ids as $val)
          {
           // echo $val;
             $this->db->select('model.*,manufacturer.manufacturer_name');
             $this->db->from('model');
             $this->db->join("manufacturer","manufacturer.manufacturer_id=model.manufacturer_id","left");
             $this->db->where("model.model_id",$val);
             $result[] = $this->db->get()->row_array();
          }
        }
        else
        {
         
           $this->db->select('model.*,manufacturer.manufacturer_name');
           $this->db->from('model');
           $this->db->join("manufacturer","manufacturer.manufacturer_id=model.manufacturer_id","left");
           $this->db->where("model.model_id",trim($data['model_ids']));
           $result = $this->db->get()->result_array();
        }

      

         $response['rc']=true;
         $response['data']=$result;

         return $response;


    }

    public function fetchmodel()
    {
       $this->db->select('group_concat(model.model_name) as models,manufacturer.manufacturer_name,count(model.model_id) as count,model.manufacturer_id,group_concat(model.model_id) as models_id');
       $this->db->from('model');
       $this->db->join("manufacturer","manufacturer.manufacturer_id=model.manufacturer_id","left");
      // $this->db->where("model.status='1'")
       $this->db->group_by("model.manufacturer_id");
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

    public function add_manufacturer($data)
    {
      $postdata=array("manufacturer_name"=>$data['manufacturer_name'],"status"=>1);
      $result=$this->db->insert("manufacturer",$postdata);

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


    public function add_model($data,$files)
    {


      $postdata=array("manufacturer_id"=>$data['manufacturer_id'],"status"=>1,"model_name"=>$data['model_name'],"color"=>$data['color'],"manufacturing_year"=>$data['manufacturing_year'],"registration_no"=>$data['registration_no'],"note"=>$data['note']);
       $result=$this->db->insert("model",$postdata);
       $modelid=$this->db->insert_id();
       if(!empty($modelid))
       {
         if(!empty($files))
         {

           foreach($files as $val)
           {
          
               if( isset($val['name']) && $val['error']=='0')
              {

              //echo $val['name'];
               
                $dir = FCPATH . "model_image/";

                if(is_dir($dir))
                {  
                  chmod($dir, 0777);
                }


                  if($val['type']== "image/jpg" || $val['type'] == "image/png" || $val['type'] == "image/jpeg" || $val['type'] == "image/gif" || $val['type'] == "application/pdf")
                  {



                    $type = explode('/', $val['type']);
             
                    $hash  = md5(rand(1, 1000000).time()).'.'.$type[1];
                    if( ! is_dir($dir) )
                    {  
                      @mkdir($dir, 0777,TRUE);
                    }

                    if(move_uploaded_file($val['tmp_name'], $dir.$hash))
                    {


                      $image_details = array(
                        "model_id"=>$modelid,
                        "image" => $hash,
                        
                        );

                        $result12=$this->db->insert("model_images",$image_details);

                       

                      
                      
                    }
                  }
                

               
                
              }
           }

             if($result12==1)
               {
                  $response['rc']=true;
                
               }
               else
               {
                   $response['rc']=false;
                 
               }
         }
       }
       else
       {
         $response['rc']=false;
       }
     
      return $response;

    }

    public function delete_model($data)
    {
       $array=array("status"=>0);
        $this->db->where("manufacturer_id",$data['manufacturer_id']);
        $result=$this->db->delete("model");
        if($result)
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
