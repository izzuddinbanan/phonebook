<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		user_validate();
		
		// Load model
		$this->load->model('Contacts');
	}
	
	public function homepage() 
	{ 
		$data['query_list'] = $this->Contacts->view();
		// ad($this->session->all_userdata()); exit;
		$this->load->view('template/header');
		$this->load->view('home', $data);
		$this->load->view('template/footer');
	}
	
	
}
