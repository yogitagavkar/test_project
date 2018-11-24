<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model 
{

	public function login($record)
	{
		// echo "<pre>";print_r($record);exit;
		$this->db->select('users.*,roles.role_name');
		$this->db->from('users');
		$this->db->join('roles',"roles.id=users.role_id");

		$this->db->where('users.email', $record['username']);
		$this->db->where('users.password', $record['password']);
		$this->db->where('users.status', '1');

		$user = $this->db->get()->row_array();
		//print_r($user);
		//exit;


		if(isset($user['id']))
		{
			$user_data = array(
				'login_id' 	=> $user['id'],
				'role_id' 	=> $user['role_id'],
				'is_master'	=> $user['is_master'],
				'role_name'	=> $user['role_name']
				
				);

			$this->set_user_login_session($user_data);
			//$this->get_details_by_id();

			$response['rc'] = TRUE;         
			$response['msg'] = 'Successful login';
		}
		else
		{
			$response['rc'] = FALSE;         
			$response['msg'] = 'Invalid username and password';
		}

		return $response;
	}
		public function select_count_approve()
	{
		$this->db->select('count(*) as appcnt');
		$this->db->from('bid_super_master');
		//$this->db->join("bid_super_master","bid_super_master.questionnaire_master_main_id=questionnaire_super_master_main.bd_super_id");



		$this->db->where('bid_super_master.outcome', 4);
		//$this->db->where('password', $password);


		return $user = $this->db->get()->row_array();
	}
	public function select_count_total_bids()
	{
	    $this->db->select('count(*) as totalcount');
		$this->db->from('bid_super_master');
		$this->db->where("status",1);
		
		return $user = $this->db->get()->row_array();
	}


	public function select_count_reject()
	{
		$this->db->select('count(*) as appcnt');
		$this->db->from('bid_super_master');
		$this->db->where("outcome",2);
		//$this->db->where('password', $password);


		return $user = $this->db->get()->row_array();
	}

	public function select_count_pending()
	{
		$this->db->select('count(*) as appcnt');
		$this->db->from('bid_super_master');
		$this->db->where('outcome', 3);
		//$this->db->where('password', $password);


		return $user = $this->db->get()->row_array();
	}
	public function select_vertical_data()
	{
        $vertical_data=array();
		$this->db->select('*');
		$this->db->from('vertical');
		$this->db->where('status',1);
		$verticaldata = $this->db->get()->result_array();
		foreach($verticaldata as $val)
		{
			$this->db->select('count(*) as won_cnt');
			$this->db->from('bid_super_master');
			//$this->db->join('vertical',"vertical.id=questionnaire_super_master_main.vertical_id");
			$this->db->where('outcome', 4);
			$this->db->where('vertical_id', $val['id']);
			$this->db->group_by('vertical_id');
		    $resultapp=$this->db->get()->row_array();
		    $won_cnt=$resultapp['won_cnt'];

		    $this->db->select('count(*) as lost_cnt');
			$this->db->from('bid_super_master');
			$this->db->where("outcome",2);
			$this->db->where('vertical_id', $val['id']);
			$this->db->group_by('vertical_id');
			$resultapp1=$this->db->get()->row_array();
			$lost_cnt=$resultapp1['lost_cnt'];

			$this->db->select('count(*) as hold_cnt');
			$this->db->from('bid_super_master');
			$this->db->where('outcome', 3);
			$this->db->where('vertical_id', $val['id']);
			$this->db->group_by('vertical_id');
			$resultapp2=$this->db->get()->row_array();
			$hold_cnt=$resultapp2['hold_cnt'];


			$finalresult[]=$val['name']."#".$won_cnt."#".$lost_cnt."#".$hold_cnt;
		
		}
		return $finalresult;

		//return $vertical_data;

/*		$this->db->select('vertical.name as vert_name');
		$this->db->from('questionnaire_super_master_main');
		$this->db->join('vertical',"questionnaire_super_master_main.vertical_id=vertical.id","left");
		$this->db->where('questionnaire_super_master_main.outcome!=0');
		$this->db->group_by('questionnaire_super_master_main.vertical_id');*/

		//$this->db->where('password', $password);


	
	}

	public function fetch_bd_data_logical()
	{
		$this->db->select('bid_super_master.*,vertical.name,customer.name as customer_name,users.firstname,questionnaire_super_master_main.questionset_id,questionnaire_super_master_main.*');
		$this->db->from('bid_super_master');
		$this->db->join("customer","bid_super_master.customer_id=customer.id");
		$this->db->join("vertical","bid_super_master.vertical_id=vertical.id");
	
		$this->db->join("sd_questionnaire_sub","bid_super_master.bid_super_master_id=sd_questionnaire_sub.bid_super_master_id");
	   $this->db->join("questionnaire_super_master_main","sd_questionnaire_sub.questionnaire_master_main_id=questionnaire_super_master_main.bd_super_id");
	   	$this->db->join("users","questionnaire_super_master_main.bd_created_by=users.id");

		//$this->db->where("bid_super_master.bid_logical_version_id!=''");
  //   $this->db->where("bid_super_master.bid_modified_version_id!=''");
	//	$this->db->where("bid_super_master.created_by",$this->session->userdata('login_id'));
		//$this->db->where("bid_super_master.proposal_status='0' or bid_super_master.proposal_status='3'");
		$this->db->group_by("sd_questionnaire_sub.bid_super_master_id");
		
		$user = $this->db->get()->result_array();
		return $user;
	}
	public function fetch_bd_data_logical_super_data()
	{
		$this->db->select('bid_super_master.*,vertical.name,customer.name as customer_name,users.firstname,questionnaire_super_master_main.questionset_id,questionnaire_super_master_main.*');
		$this->db->from('bid_super_master');
		$this->db->join("customer","bid_super_master.customer_id=customer.id");
		$this->db->join("vertical","bid_super_master.vertical_id=vertical.id");
	
		//$this->db->join("sd_questionnaire_sub","bid_super_master.bid_super_master_id=sd_questionnaire_sub.bid_super_master_id");
	   $this->db->join("questionnaire_super_master_main","questionnaire_super_master_main.bd_super_id=bid_super_master.questionnaire_master_main_id");
	   	$this->db->join("users","questionnaire_super_master_main.bd_created_by=users.id");
	    $this->db->where("bid_super_master.bid_logical_version_id!=''");

		//$this->db->where("bid_super_master.bid_logical_version_id!=''");
  //   $this->db->where("bid_super_master.bid_modified_version_id!=''");
	//	$this->db->where("bid_super_master.created_by",$this->session->userdata('login_id'));
		//$this->db->where("bid_super_master.proposal_status='0' or bid_super_master.proposal_status='3'");
		//$this->db->group_by("sd_questionnaire_sub.bid_super_master_id");
		
		$user = $this->db->get()->result_array();
		return $user;
	}
	public function fetch_bd_data_logical_super()
	{
		$this->db->select('bid_super_master.*,vertical.name,customer.name as customer_name,users.firstname,questionnaire_super_master_main.ptarget_date,questionnaire_super_master_main.target_date,DATEDIFF(questionnaire_super_master_main.ptarget_date, now()) as date_age');
		$this->db->from('bid_super_master');
		$this->db->join("customer","bid_super_master.customer_id=customer.id");
		$this->db->join("vertical","bid_super_master.vertical_id=vertical.id");
	
		//$this->db->join("sd_questionnaire_sub","bid_super_master.bid_super_master_id=sd_questionnaire_sub.bid_super_master_id");
	   $this->db->join("questionnaire_super_master_main","questionnaire_super_master_main.bd_super_id=bid_super_master.questionnaire_master_main_id","left");
	   	$this->db->join("users","bid_super_master.created_by=users.id");
      $this->db->where("bid_super_master.bid_logical_version_id!='' or bid_super_master.bid_modified_version_id!=''");
		//$this->db->where("bid_super_master.bid_logical_version_id!=''");
  //   $this->db->where("bid_super_master.bid_modified_version_id!=''");
	//	$this->db->where("bid_super_master.created_by",$this->session->userdata('login_id'));
		//$this->db->where("bid_super_master.proposal_status='0' or bid_super_master.proposal_status='3'");
		//$this->db->group_by("sd_questionnaire_sub.bid_super_master_id");
		
		$user = $this->db->get()->result_array();
		return $user;
	}
	public function select_count_approve_industry()
	{
		$this->db->select('count(*) as appcnt,vertical.name as vert_name');
		$this->db->from('questionnaire_super_master_main');
		$this->db->join('vertical',"vertical.id=questionnaire_super_master_main.vertical_id");


		$this->db->where('outcome', 4);
		$this->db->group_by('vertical_id');

		//$this->db->where('password', $password);


		return $user = $this->db->get()->row_array();
	}


	public function select_count_reject_industry()
	{
		$this->db->select('count(*) as appcnt,vertical_id');
		$this->db->from('questionnaire_super_master_main');
		$this->db->where("outcome",2);
		$this->db->group_by('vertical_id');
		//$this->db->where('password', $password);


		return $user = $this->db->get()->row_array();
	}

	public function select_count_pending_industry()
	{
		$this->db->select('count(*) as appcnt,vertical_id');
		$this->db->from('questionnaire_super_master_main');
		$this->db->where('outcome', 3);
		$this->db->group_by('vertical_id');

		//$this->db->where('password', $password);


		return $user = $this->db->get()->row_array();
	}





	public function select_emplopyee_data()
	{
		$this->db->select('users.*,roles.role_name');
		$this->db->from('users');
		$this->db->join("roles","roles.id=users.role_id");
		//$this->db->join("vertical","questionnaire_super_master_main.vertical_id=vertical.id");
		//$this->db->join("customer","questionnaire_super_master_main.customer_id=customer.id");
		$this->db->where("roles.slug not in ('superadmin','admin')");
	   $this->db->where("users.status='1'");


		$user = $this->db->get()->result_array();
		return $user;
	}
	public function employee_bid_details($role_slug,$uid)
	{
	  //echo $uid;
	 // exit;
		if($role_slug=="bd-team-member")
		{

	    $this->db->select('bid_super_master.*,vertical.name,customer.name as customer_name,users.firstname,questionnaire_super_master_main.*');
		$this->db->from('bid_super_master');
		$this->db->join("customer","bid_super_master.customer_id=customer.id");
		$this->db->join("vertical","bid_super_master.vertical_id=vertical.id");
		$this->db->join("users","bid_super_master.created_by=users.id");
	   	$this->db->join("questionnaire_super_master_main","bid_super_master.questionnaire_master_main_id=questionnaire_super_master_main.bd_super_id");
	   $this->db->where("questionnaire_super_master_main.bd_created_by",$uid);
	   $this->db->where("questionnaire_super_master_main.bd_created_by!=",1);

	//   $this->db->where("users.is_master!=",1);
 
	


		}
		else if($role_slug=="bd-head-member")
		{
	         $this->db->select('bid_super_master.*,vertical.name,customer.name as customer_name,users.firstname,questionnaire_super_master_main.*');
			$this->db->from('bid_super_master');
			$this->db->join("customer","bid_super_master.customer_id=customer.id");
			$this->db->join("vertical","bid_super_master.vertical_id=vertical.id");
			$this->db->join("users","bid_super_master.created_by=users.id");
		   	$this->db->join("questionnaire_super_master_main","bid_super_master.questionnaire_master_main_id=questionnaire_super_master_main.bd_super_id");
		   $this->db->where("questionnaire_super_master_main.bd_approved_by='".$uid."' or questionnaire_super_master_main.bd_reject_by='".$uid."'");
		 //  $this->db->where("questionnaire_super_master_main.bd_approved_by!=",1);

		}
		else if($role_slug=="sd-head-member")
		{
            $this->db->select('bid_super_master.*,vertical.name,customer.name as customer_name,users.firstname,questionnaire_super_master_main.*');
			$this->db->from('bid_super_master');
			$this->db->join("customer","bid_super_master.customer_id=customer.id");
			$this->db->join("vertical","bid_super_master.vertical_id=vertical.id");
			$this->db->join("users","bid_super_master.created_by=users.id");
		   	$this->db->join("questionnaire_super_master_main","bid_super_master.questionnaire_master_main_id=questionnaire_super_master_main.bd_super_id");
		   $this->db->where("questionnaire_super_master_main.sd_assigned_by='".$uid."' or questionnaire_super_master_main.sd_reject_by='".$uid."'");
		  // $this->db->where("questionnaire_super_master_main.sd_assigned_by!=",1);
		  //$this->db->where("questionnaire_super_master_main.sd_assigned_by!=",1);



	
		}
		else if($role_slug=="sd-team-member")
		{
           $this->db->select('bid_super_master.*,vertical.name,customer.name as customer_name,users.firstname,questionnaire_super_master_main.*');
			$this->db->from('bid_super_master');
			$this->db->join("customer","bid_super_master.customer_id=customer.id");
			$this->db->join("vertical","bid_super_master.vertical_id=vertical.id");
			$this->db->join("users","bid_super_master.created_by=users.id");
		   	$this->db->join("questionnaire_super_master_main","bid_super_master.questionnaire_master_main_id=questionnaire_super_master_main.bd_super_id");
		   $this->db->where("questionnaire_super_master_main.sd_assigned_to='".$uid."' ");
		 //  $this->db->where("users.is_master!=",1);		

		}


      $user = $this->db->get()->result_array();
    // echo $this->db->last_query();
     // exit;

	return $user;
       
	}
	public function fetch_names($id)
  	{
    	$this->db->select('firstname');
    	$this->db->from('users');
    	$this->db->where("id",$id);
    	$user = $this->db->get()->result_array();

    	return $user;
  	}
	public function select_slug($id)
	{
		$this->db->select('roles.slug');
		$this->db->from('users');
		$this->db->join("roles","roles.id=users.role_id");
		//$this->db->join("vertical","questionnaire_super_master_main.vertical_id=vertical.id");
		//$this->db->join("customer","questionnaire_super_master_main.customer_id=customer.id");
		$this->db->where("users.id",$id);

		$user = $this->db->get()->result_array();
		return $user;
	}
	public function create_user($data)
	{
		$this->db->select('count(*)');
		$this->db->from('users');
		$this->db->where('email', $data['email']);
		$this->db->where('password', $data['password']);
		//$this->db->where('status', '1');


		$user = $this->db->get()->row_array();
		
		// var_dump(isset($user['id']));
		// echo "<pre>";print_r($user);exit;


		if($user['count(*)']==1)
		{

			//$this->get_details_by_id();
			$response['rc'] = FALSE;         
			$response['msg'] = 'User already exists';

			
		}
		else
		{

			$result=$this->db->insert('users', $data);
			//echo $this->db->last_query();
			//exit;

			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('email', $data['email']);
			$this->db->where('password', $data['password']);
			//$this->db->where('status', '1');


			$userdatafinal = $this->db->get()->row_array();

			if($result=='1')
			{

				$user_data = array(
					'login_id' 	=> $userdatafinal['id'],
					'role_id' 	=> $userdatafinal['role_id'],
					'is_master'	=> $userdatafinal['is_master']
					);

				$this->set_user_login_session($user_data);

				$response['rc'] = TRUE;         
				$response['msg'] = 'User added successfully';
			}


		}

		return $response;
	}
	public function update_user($data,$id)
	{

		$this->db->where('id', $id);
		$result = $this->db->update('users', $data);
            //$result=$this->db->insert('users', $data);
		/*$this->db->select('*');
		$this->db->from('users');
		$this->db->where('email', $data['email']);
		$this->db->where('password', $data['password']);*/
			//$this->db->where('status', '1');


		// $userdatafinal = $this->db->get()->row_array();

		if($result=='1')
		{

			/*$user_data = array(
				'login_id' 	=> $userdatafinal['id'],
				'role_id' 	=> $userdatafinal['role_id'],
				'is_master'	=> $userdatafinal['is_master']
				);

			$this->set_user_login_session($user_data);*/

			$response['rc'] = TRUE;         
			$response['msg'] = 'User updated successfully';
		}


		

		return $response;
	}

	public function set_user_login_session($user_data)
	{
		foreach($user_data as $key=>$data)
		{
			$this->session->set_userdata($key,$data);
		}

	}
	public function getroleid($id)
	{
		$this->db->select('id');
		$this->db->from('roles');
		$this->db->where("slug","superadmin");
		$this->db->where("id",$id);


		return $user = $this->db->get()->row_array();
	}

	public function fetch_roles()
	{
		$this->db->select('*');
		$this->db->from('roles');
		$this->db->where('status', '1');
	//	$this->db->where('encodedpassword', $encrypted);
		//$this->db->where('status', '1');


		$user = $this->db->get()->result_array();
		//echo $this->db->last_query();
		//print_r($user);
		//exit;

		

		return $user;
	}

	public function fetch_data()
	{
		$this->db->select('users.id,users.firstname,roles.role_name');
		$this->db->from('users');
		$this->db->join("roles","roles.id=users.role_id");
		$this->db->where('users.status', '1');

		$user = $this->db->get()->result_array();
		
		return $user;
	}

	public function fetch_data_user($id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('users.id', $id);

		$user = $this->db->get()->result_array();
		return $user;
	}
	
	public function delete_user($id)
	{
		$this->db->where('id', $id);
		$result = $this->db->delete('users');
		if($result==1)
		{
			$response['msg'] = 'User Deleted Successfully';
		}
		return $response;
	}

}

/* End of file User_model.php */
/* Location: ./application/models/users/User_model.php */ ?>