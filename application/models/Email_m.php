<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_m extends CI_Model {
	
	public function email_validate($post = "")
	{
		#Validate Form
		if($post['msg'] == ""){
			set_message("Please Enter Message", "danger");
			return false;
		}
		
		if($post['email'] == ""){
			set_message("Please Enter Email", "danger");
			return false;
		}
		else if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
			set_message("Please Enter Email Correctly", "danger");
			return false;
		}
		
		return true;
	}
}
