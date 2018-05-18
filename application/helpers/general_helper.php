<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* To check user has session or not.
* To prevent user going to Login page when there is session
*/
if(!function_exists('user_invalidate')){
	function user_invalidate(){
		$CI =& get_instance();
		if($CI->session->userdata('username') !== NULL){
			redirect('contact/contactpage');
		}
	}
}

/**
* To check user has session or not.
* To prevent user going to the page that need session
*/
if(!function_exists('user_validate')){
	function user_validate(){
		$CI =& get_instance();
		$sql = $CI->db->query("SELECT * FROM `user` WHERE `id` = " . $CI->db->escape($CI->session->userdata('user_id')) . " AND `user_type` = " . $CI->db->escape($CI->session->userdata('user_type')) . " LIMIT 1")->row();
		
		if($CI->session->userdata('username') === NULL){
			redirect('login');
		}
		else if($CI->session->userdata('username') !== $sql->username || $CI->session->userdata('image') !== $sql->image ){
			$session_data = array(
				'username' => $sql->username,
				'image' => $sql->image,
				'email' => $sql->email
			);
			
			$CI->session->set_userdata($session_data);
			// ad($CI->session->all_userdata()); exit;
		}
	}
}

/**
* Debugging variable
* ad = Array Debug
*/
if(!function_exists('ad')){
	function ad($data = array()){
		echo "<pre>";
		echo print_r($data, true);
		echo "</pre>";
	}
}

if(!function_exists('set_message')){
	function set_message($message = "", $type = "danger"){
		$CI =& get_instance();
		if($message != ""){
			$CI->session->set_userdata('error-message', $message);
			$CI->session->set_userdata('error-type', $type);
			return true;
		}
		
		return false;
	}
}

if(!function_exists('get_message')){
	function get_message(){
		$CI =& get_instance();
		if($CI->session->has_userdata('error-message')){
			echo '<div class="alert alert-' . $CI->session->userdata('error-type') . ' alert-dismissible" role="alert">' .
				'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . 
				$CI->session->userdata('error-message') . 
			'</div>';
			
			$CI->session->unset_userdata('error-message');
			$CI->session->unset_userdata('error-type');
		}
	}
}

if(!function_exists('base64url_encode')){
	function base64url_encode($data){
	  return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
	}
}

if(!function_exists('base64url_decode')){
	function base64url_decode($data) { 
	  return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
	} 
}
?>