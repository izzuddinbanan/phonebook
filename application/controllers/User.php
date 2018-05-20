<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
		parent::__construct();
		user_validate();
		
		// Load model
		$this->load->model('user_m');
	}
	
	public function index()
	{
		redirect('User/listing');
	}
	
	public function listing($search = "")
	{
		if($this->input->post()){
			#When Sorting
			if($this->input->post('sort_column')){
				$search_array = unserialize(base64url_decode($search));           #Get Previous Search Data (if any)
				$search_array = array_merge($search_array, $this->input->post()); #Merge Previous Search with current sorting
				
				$search = base64url_encode(serialize($search_array)); #Re-Encode The Merged Data
				redirect('user/listing/' .$search . '/' . $this->input->post('sort_page')); #sort page nak make sure dia still kat pagination tu kalau sort
			}
			
			#When Searching
			$search = base64url_encode(serialize($this->input->post()));
			redirect('user/listing/' .$search);
		}
		
		$data['listing'] = $this->user_m->listing($search);
		$data['search'] = unserialize(base64url_decode($search));
		$data['pagination'] = $this->pagination->create_links(); 
		
		$this->load->view('user/listing_v', $data);
	}
	
	public function create_user()
	{
		if($this->input->post()){
			$data = array(
				'username' => $this->input->post('user'),
				'password' => $this->input->post('password'),
				'email' => $this->input->post('email'),
				'type' => $this->input->post('type'),
			);
			
			$result = $this->user_m->create_user($data);
			
			$this->load->view('template/header');
			$this->load->view('contact/create_v', $result);
			$this->load->view('template/footer');
		}
		else {
			$this->load->view('template/header');
			$this->load->view('contact/create_v');
			$this->load->view('template/footer');
		}
	}
	
	public function edit($id)
	{
		$data['fetch'] = $this->user_m->edit($id);
		
		$this->load->view('template/header');
		$this->load->view('user/ubah_v',$data);
		$this->load->view('template/footer');
	}
	
	public function update_process()
	{
		$data = array(
			'id' =>  $this->input->post('id'),
			'email' => $this->input->post('email')
			);
			
		if($this->user_m->edit_process($data)){
			redirect('user');
		}
		
	}
	
	public function remove($id)
	{
		if($this->user_m->remove_process($id)){
			redirect('user');
		}
	}
	
	public function profile()
	{
		$data['row_user'] = $this->user_m->get_user_details();
		#Check for post data
		if($this->input->post()){
			if($this->user_m->profile($this->input->post(), $_FILES)){
				redirect('user/profile');
			}
			else{
				$data['row_user'] = (object)$this->input->post();
			}
		}
			
		$this->load->view('profile_v', $data);
	}
	
	public function hobi(){
		$this->load->view('hobby_v');
	}
}
