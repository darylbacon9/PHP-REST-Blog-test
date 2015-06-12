<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class VerifyLogin extends CI_Controller {

		function __construct() {
			parent::__construct();
		}

		function verifyLogin() {
			$url = "http://blog.beyondlocal.dev/login"; 
			$post_data = array( 
				"username" => $this->input->post('username'), 
				"password" => $this->input->post('password')
			);
			// use key 'http' even if you send the request to https://...
			$options = array(
				'http' => array(
					'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					'method'  => 'POST',
					'content' => http_build_query($post_data)
				),
			);
			$context  = stream_context_create($options);
			// get response of url
			$httpResponse = $this->get_http_response_code($url);

			if($httpResponse != "200"){
				$this->session->set_flashdata('success', 0);
				$this->session->set_flashdata('msg', 'The page you are trying to access does not exist.');
				redirect('admin/login', 'refresh');
			}else{
				$result = file_get_contents($url, false, $context);
				$result = json_decode($result);
				if(strlen($result->token) == 36) { // If the output has the token then proceed to login
					//Go to private area
					$this->session->set_userdata('logged_in', array('token' => $result->token, 'username' => $this->input->post('username')));
					redirect('admin/dashboard', 'refresh');
				} else { // If no token exists then redirect to the login page
					$data['formAttributes'] = array(
						'class' => 'form-horizontal'
					);
					$data['title'] = 'Login';
					$this->load->view('admin/login', $data);
				}
			}

		}

		function get_http_response_code($url) {
			$headers = get_headers($url);
			return substr($headers[0], 9, 3);
		}
	}

?>