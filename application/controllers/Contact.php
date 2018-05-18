<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function __construct() {
		parent::__construct();
		user_validate();
		
		// Load model
		$this->load->model('contacts_m');
	}
	
	public function index()
	{
		redirect('contact/contactpage');
	}
	
	public function contactpage($search = "") 
	{ 
		if($this->input->post())
		{
			#if sorting
			if($this->input->post('sort-column')){
				$search_array = unserialize( base64url_decode($search));
				$search_array = array_merge($search_array,$this->input->post());

				$search = base64url_encode(serialize($search_array));

				redirect('contact/contactpage/' .$search . '/' . $this->input->post('sort-page'));
			}
			$search = base64url_encode(serialize($this->input->post()));
			redirect('contact/contactpage/' .$search);
		}
		
		$data['query_list'] = $this->contacts_m->view($search);
		$data['query_search'] = unserialize(base64url_decode($search));
		$data['pagination'] = $this->pagination->create_links();
		
		$this->load->view('contact/contact_v', $data);
	}
	
	public function form_add()
	{
		$data = array();
		
		#Check for post data
		if($this->input->post()){
			if($this->contacts_m->add_process($this->input->post())){
				redirect('contact/contactpage');
			}
			else{
				$data['post_data'] = (object)$this->input->post(); 
			}
		}
		
		$this->load->view('template/header');
		$this->load->view('contact/add_v', $data);
		$this->load->view('template/footer');
	}
	
	#show current data to update form
	public function edit($id = NULL)
	{
		$data['fetch'] = $this->contacts_m->edit($id);
		
		$this->load->view('template/header');
		$this->load->view('contact/update_v',$data);
		$this->load->view('template/footer');
	}
	
	public function update_process()
	{
		$data = array(
			'id' =>  $this->input->post('id'),
			'phone' => $this->input->post('phone'),
			'address' => $this->input->post('address')
			);
			
		if($this->contacts_m->edit_process($data)){
			redirect('contact/contactpage');
		}
		
	}
	
	public function remove($id)
	{
		if($this->contacts_m->remove_process($id)){
			redirect('contact/contactpage');
		}
	}
	
	public function change_pwd()
	{
		if($this->input->post())
		{
			$data = array(
				'old' => $this->input->post('old'),
				'new' => $this->input->post('new'),
				'confirm' => $this->input->post('confirm')
			);
			
			$result = $this->contacts_m->change_pwd($data);
			$this->load->view('template/header');
			$this->load->view('contact/change_v', $result);
			$this->load->view('template/footer');
		}
		else {
			$this->load->view('template/header');
			$this->load->view('contact/change_v');
			$this->load->view('template/footer');
		}
	}
}
