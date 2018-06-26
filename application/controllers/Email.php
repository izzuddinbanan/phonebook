<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {

	public function __construct() {
		parent::__construct();
		user_validate();
		
		$this->load->model('email_m');
		require_once(APPPATH."third_party/phpmailer/PHPMailerAutoload.php");
	}
	
	public function index()
	{
		redirect('email/sendmail');
	}
	
	public function sendmail() 
	{ 
		if($this->input->post()){
			if($_FILES['files']){
				$errors= array();
				$file_name = $_FILES['files']['name'];
				$file_size = $_FILES['files']['size'];
				$file_tmp = $_FILES['files']['tmp_name'];

				$expensions= array("jpeg","jpg","png", "pdf", "doc");
				
				#kalau nak save kat server dulu
				// if(in_array($file_ext,$expensions)=== false){
					// $errors[]="extension not allowed, please choose a JPEG or PNG file.";
				// }

				// if($file_size > 2097152) {
					// $errors[]='File size must be exactly 2 MB';
				// }

				// if(empty($errors)==true) {
					// move_uploaded_file($file_tmp,base_url() ."upload/".$file_name);
					// echo "Success";
				// }
				// else{
					// print_r($errors);
				// }
				
				$data['input'] = $this->email_m->email_validate($this->input->post());
				$mail = new PHPMailer();
				$mail->protocol = "Mail";
				$mail->IsSMTP(); // we are going to use SMTP
				$mail->SMTPAuth = true; // enabled SMTP authentication
				$mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
				$mail->Host = "smtp.gmail.com";      // setting GMail as our SMTP server
				$mail->Port = 465;                   // SMTP port to connect to GMail
				// $mail->SMTPDebug = 2;
				$mail->Username = "izzuddintesting1995@gmail.com";  // user email address
				$mail->Password = "izzuddin1995";            // password in GMail
				$mail->SetFrom($this->session->userdata('email'), 'Test_Sender');  //Who is sending the email
				$mail->Subject = "testing email";
				$mail->Body = $this->input->post('msg');
				//If SMTP requires TLS encryption then set it
				$mail->SMTPSecure = "tls";                           
				//Set TCP port to connect to 
				$mail->Port = 587;  
				$receiver = $this->input->post('email'); // Who is addressed the email to
				$mail->AddAddress($receiver, "Test_Receiver");
				
				#attachment file uploaded
				$mail->AddAttachment($file_tmp, $file_name);
		 
				if(!$mail->Send()) {
					$data["message"] = "Error: " . $mail->ErrorInfo;
				} else {
					$data["message"] = "Message sent correctly!";
					set_message('Email has been sent successfully', 'success');
				}
				
				$this->load->view('user/send_email_v',$data);	
			}
			
		}
		else{
			$this->load->view('user/send_email_v');
		}
		
	}
}
