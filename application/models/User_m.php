<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model {
	
	public function listing($search = "")
	{
		$where = "";
		$sort = " ORDER BY `id` DESC ";
		if(!empty($search)){
			
			$search_data = unserialize(base64url_decode($search));
			
			if(is_array($search_data) && sizeof($search_data) > 0){
				#Searching
				if(isset($search_data['search']) && trim($search_data['search']) != ""){
					$where = "WHERE `username` LIKE " .$this->db->escape("%" . $search_data['search'] . "%" );
				}
				
				#Sorting
				if(isset($search_data['sort_column']) && trim($search_data['sort_column']) != "" && isset($search_data['sort_type']) && trim($search_data['sort_type']) != ""){
					$sort = " ORDER BY `" . $search_data['sort_column'] . "` " . $search_data['sort_type'];
				}
			}
			
			
		}
		else {
			$search_data = base64url_encode(serialize(array()));
			redirect('user/listing/' .$search_data);
		}
		
		$total_row = $this->db->query("SELECT COUNT(*) AS total_row FROM `user` " .$where)->row()->total_row;
		
		$config['base_url'] = base_url().'user/listing/' .$this->uri->segment(3);
		$config['per_page'] = 3; 
		$config['total_rows'] = $total_row;
		$config['uri_segment'] = 4;
		$config['num_links'] = 3;
		
		$this->pagination->initialize($config);
		
		$limit = "LIMIT " .$config['per_page'];
		$start = $this->uri->segment($config['uri_segment']);
		
		if(is_numeric($start) && $start > 0){
			$limit = "LIMIT " .$start. " , " .$config['per_page'] ;
		}
		
		$search = $this->db->query("SELECT * FROM `user` " .$where ." " . $sort . " " .$limit);
		
		return $search;
	}
	
	public function create_user($data)
	{
		date_default_timezone_set("Asia/Kuala_Lumpur");
		$now = date("Y-m-d h:i:s");
		
		$form_create = array(
			'username' => trim($data['username']),
			'password' => trim(md5($data['password'])),
			'user_type' => trim($data['type']),
			'email' => trim($data['email']),
			'create_date' => $now,
			'create_by' => trim($this->session->userdata('user_id'))
		);
		
		$check = $this->db->query("SELECT * FROM `user` WHERE `username` = " . $this->db->escape($form_create['username']) . " AND `password` = " . $this->db->escape($form_create['password']));
		// echo $check->row()->email; exit;
		if($check->num_rows() > 0 ) { 
			set_message('Username and password already exist','danger');
			return false;
		}
		
		if($form_create['username'] == "") {
			set_message('Please insert username','danger');
			return false;
		}
		
		if($form_create['password'] == "") {
			set_message('Please insert password','danger');
			return false;
		}
		
		if($form_create['email'] == "") {
			set_message('Please insert email','danger');
			return false;
		}
		else if(!filter_var($form_create['email'], FILTER_VALIDATE_EMAIL)) {
			set_message('invalid email format','danger');
			return false;
		}
		
		$this->db->insert('user', $form_create);
		set_message('success.','success');
		return true;
	
	}
	
	public function edit($id)
	{
		$retrieve = $this->db->query("SELECT * FROM `user` WHERE `id` = ".$id)->row();
		return $retrieve;
	}
	
	public function edit_process($data)
	{
		$update = $this->db->query("UPDATE `user` SET `email` = " . $this->db->escape($data['email']) . " WHERE `id` = ".$this->db->escape($data['id']));
		return true;
	}
	
	public function remove_process($id)
	{
		$remove = $this->db->query("DELETE FROM `user` WHERE `id` = " .$id);
		return true;
	}
	
	public function get_user_details(){
		$row_user = $this->db->query("SELECT * FROM `user` WHERE `username` = " .$this->db->escape($this->session->userdata['username']). "AND `id` = " .$this->session->userdata('user_id'))->row();
		return $row_user;
	}
	
	public function profile($data = array(), $file_data = array()){
		
		$db_user = array(
			'username' => trim($data['username']),
			'email' => trim($data['email'])
		);
		
		#Validate Form
		if($db_user['username'] == ""){
			set_message("Please Enter Name", "danger");
			return false;
		}
		
		if($db_user['email'] == ""){
			set_message("Please Enter Email", "danger");
			return false;
		}
		else if(!filter_var($db_user['email'], FILTER_VALIDATE_EMAIL)){
			set_message("Please Enter Email Correctly", "danger");
			return false;
		}
		
		if(isset($file_data['userfile']['size']) && $file_data['userfile']['size'] > 0){
			#Prepare Upload Settings
			$config['upload_path'] = './upload/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->upload->initialize($config);
			
			#Begin To Upload
			if(!$this->upload->do_upload('userfile')){
				#Failed
				set_message($this->upload->display_errors('', ''), "danger");
				return false;
			}
			else{
				#Success
				$uploaded_data = $this->upload->data();
				$db_user['image'] = $uploaded_data['file_name'];
			}
		}
		
		$hobby = array(
			user_id => $this->session->userdata(),
			user_id => $this->input->post,
		);
		
		
		$this->db->where('id', $this->session->userdata('user_id'));
		$this->db->update('user', $db_user);
		
		set_message("Profile has been updated", "success");
		return true;
	}
	
	public function generate_pdf(){
		$query_user = $this->db->query("SELECT * FROM `user`");
		if($query_user->num_rows() > 0){
			return $query_user->result();
		}
	}
}
