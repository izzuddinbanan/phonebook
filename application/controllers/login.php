<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		if($this->uri->segment(2) == 'logout'){
			user_validate();
		}
		else{
			user_invalidate();
		}
		
		// Load model
		$this->load->model('login_m');
	}
	
	public function index()
	{
		$this->load->view('login/login_v');
	}
	
	public function verify() 
	{
		$data = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password')
		);
		
		$result = $this->login_m->verify($data);
		
		if($result == TRUE) 
		{
			if($this->session->userdata('username') !== NULL)
			{
				// if($this->session->userdata('user_type') == 'admin'){
					redirect('dashboard');
				// }
				// else {
					// redirect('user');
				// }
			}
			else 
			{
				redirect('login');
			}
		}
		else 
		{
			redirect('login');
		}
	}
	
	public function logout()
	{
		$this->session->unset_userdata(array(
					'user_id' ,
					'username' ,
					'email',
					'logged_in',
					'last_logged'
			));
		
		redirect('login');
	}
}
