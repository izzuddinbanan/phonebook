<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
		parent::__construct();
		user_validate();
		
		require(APPPATH .'third_party/html2pdf/html2pdf.class.php');

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
		$query_hobby = $this->db->query("SELECT * FROM `user_hobby` WHERE `user_id` = ". $this->db->escape($this->session->userdata('user_id')));
		if($query_hobby->num_rows() > 0){
			$data['hobby'] = $query_hobby->result();
		}
		
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
	
	
	public function generate_pdf(){
		$result = $this->user_m->generate_pdf();
		$html2pdf = new HTML2PDF('P', 'A4', 'en', true, 'UTF-8');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		// ad(base_url(). "upload/Naruto_newshot13.png"); exit;
		// $content = '<img src="http://localhost/phonebook/upload/Naruto_newshot13.png" height="100" width="100">';
		$content = '<img src="upload/Naruto_newshot13.png" height="100" width="100"> 
					<H3> User List of My PhoneBook </h3>
					<hr style="height: .3mm; background: #000; "><br><br><br>';
		$content .= '
				<table border="1px" style="width: 100%; ">
					<tr> 
						<td style="text-align: center;width=33%;"><b>Name</b></td>
						<td style="text-align: center;width=33%;"><b>Email</b></td>
						<td style="text-align: center;width=33%;"><b>User Type</b></td>
					</tr>';
		foreach($result as $row_result){
		$content .= '
					<tr>
						<td>';
		$content .= $row_result->username;
		$content .= '	</td>
						<td>';
		$content .= $row_result->email != '' ? $row_result->email : 'N/A'; 				
		$content .= '	</td>
						<td> ';
		$content .= $row_result->user_type != '' ? $row_result->user_type : 'N/A';
		$content .= '	</td>
					</tr>';
			
		}
		$content .= '
				</table>
		';
		
		
		$html2pdf->WriteHTML($content);
		// $html2pdf->Output('test.pdf','D'); // force download pdf
		$html2pdf->Output('test.pdf'); // display only
	}
}
