<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts_m extends CI_Model {
	
	public function view($search = "")
	{
		$where = "";
		$order = " ORDER BY id DESC ";
		if($search != "")
		{
			#decrypt search input
			$post_data = unserialize(base64url_decode($search));
			
			#check if post data is array and count size of array
			if(is_array($post_data) && sizeof($post_data) > 0)
			{
				#searching
				if(isset($post_data['search']) && trim($post_data['search']) != "")
				{
					$where = "WHERE `name` LIKE " . $this->db->escape("%" . $post_data['search'] . "%") .
							 " OR `phone` LIKE " . $this->db->escape("%" . $post_data['search'] . "%"); 
				}
				
				#sorting
				if(isset($post_data['sort-column']) && trim($post_data['sort-column']) != "" && isset($post_data['sort-type']) && trim($post_data['sort-type']) != "")
				{
					$order = " ORDER BY `" .$post_data['sort-column']. "` " .$post_data['sort-type'];
				}
			}
		}
		else
		{
			$search = base64url_encode(serialize(array()));
			redirect('contact/contactpage/' . $search);
		}
		
		#SQL get total rows
		$total_row = $this->db->query("SELECT COUNT(*) AS `total` FROM `contact`" . $where)->row()->total;
		
		$config['base_url'] = base_url() .'contact/contactpage/'. $this->uri->segment(3);
		$config['uri_segment'] = 4;
		$config['per_page'] = 10;
		$config['total_rows'] = $total_row;
		$config['num_links'] = 3;
		$this->pagination->initialize($config);
		
		#set limit 
		$limit = " LIMIT " . $config['per_page'];
		$start = $this->uri->segment($config['uri_segment']);
		
		if(is_numeric($start) && $start > 0) {
			$limit = " LIMIT " . $start ." , " .$config['per_page'];
		}
		else {
			$limit = " LIMIT 0 , " .$config['per_page'] ;
		}
		
		$query = $this->db->query("SELECT * FROM `contact` " . $where . " " . $order . " " . $limit);
		return $query;
	}
	
	public function add_process($data = array())
	{
		#collect data from from
		$form_data = array(
			'name' => trim($data['name']),
			'phone' => trim($data['phone']),
			'address' => trim($data['address'])
		); 
		
		#form validation
		if($form_data['name'] ==  ""){
			set_message("Please enter Name.", "danger");
			return false;
		}
		
		if($form_data['phone'] == ""){
			set_message("Please enter Phone Number.", "danger");
			return false;
		}
		else if((!is_numeric($form_data['phone'])) || ($form_data['phone'] < 1)){
			set_message("Please enter phone number correctly", "danger");
			return false;
		}
		
		if($form_data['address'] ==  ""){
			set_message("Please enter address.", "danger");
			return false;
		}
		
		#insert all to database
		$this->db->insert('contact', $form_data);
		
		set_message('you have successfully add','success');
		return true;
	}
	
	#show current data to form
	public function edit($id)
	{
		$retrieve = $this->db->query("SELECT * FROM `contact` WHERE `id` = ".$id)->row();
		// ad($retrieve); exit();
		return $retrieve;
	}
	
	public function edit_process($data)
	{
		$update = $this->db->query("UPDATE `contact` SET `phone` = " . $this->db->escape($data['phone']) . " , `address` = " . $this->db->escape($data['address']) . "WHERE `id` = ".$this->db->escape($data['id']));
		return true;
	}
	
	public function remove_process($id)
	{
		$remove = $this->db->query("DELETE FROM `contact` WHERE `id` = " .$id);
		return true;
	}
	
	public function change_pwd($data)
	{
		$old = $this->db->escape(md5($data['old']));
		$new = $this->db->escape(md5($data['new']));
		$confirm = $this->db->escape(md5($data['confirm']));
		$username =  $this->db->escape($this->session->userdata('username'));
		
		$check = $this->db->query("SELECT * FROM `user` WHERE `username` = " . $username . " AND `password` = " . $old);
		
		
		if($check->num_rows() > 0) 
		{
			if($confirm == $new) 
			{
				$update = $this->db->query("UPDATE `user` SET `password` = " . $new); 
				set_message('successfully update', 'success');
				return true;
			}
			else 
			{
				set_message('Confirm password must be same as new password', 'danger');
				return false;
			}
		}
		else 
		{
			set_message('your old password does not match','danger');
			return false;
		}
	}
}
