<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		user_validate();
		
		// Load model
		$this->load->model('contacts_m');
	}
	
	public function index()
	{
		redirect('dashboard/homepage');
	}
	
	public function homepage() 
	{ 
		$this->load->view('template/header');
		$this->load->view('index_v');
		$this->load->view('template/footer');
	}	
}
