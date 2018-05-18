<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_m extends CI_Model {
	
	public function verify($data)
	{
		$usernamedb = $this->db->escape($data['username']);
		$passworddb =$this->db->escape(md5($data['password']));
		
		#check if username & password have in database
		$sql = "SELECT *, DATE_FORMAT(last_log, '%d %b %Y %r') AS last_logged FROM `user` WHERE `username` = " . $usernamedb . " AND `password` = " . $passworddb . " LIMIT 1";
		$query = $this->db->query($sql);
			// ad($query->row()); exit;
		
		if ($query->num_rows() > 0 AND !empty($usernamedb) AND !empty($passworddb))
		{
			$row = $query->row(); 
			
			
			$session_data = array(
				'user_id' => $row->id,
				'username' => $row->username,
				'email' => $row->email,
				'logged_in' => TRUE, 
				'last_logged' => $row->last_logged,
				'user_type' => $row->user_type,
				'image' => $row->image
			);
			$this->session->set_userdata($session_data);
			
			#update last_log
			$last_log = "UPDATE `user` set `last_log` = NOW() WHERE `id` = " .$row->id;
			$query2 = $this->db->query($last_log);
			return true;
		}
		else 
		{
			set_message("Incorrect username and password.", "danger");
			return false;
		}
	}
	
}
