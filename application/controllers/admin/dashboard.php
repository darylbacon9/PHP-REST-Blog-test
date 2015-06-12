<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	// session_start(); //we need to call PHP's session object to access it through CI
	class Dashboard extends CI_Controller {

		function __construct() {
			parent::__construct();
		}

		function index() {
			if($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$data['title'] = 'Dashboard';
				$data['username'] = $session_data['username'];
				$this->load->view('admin/adminHeader', $data);
				$this->load->view('admin/dashboard', $data);
				$this->load->view('admin/adminFooter', $data);
			} else {
				//If no session, redirect to login page
				redirect('admin/login', 'refresh');
			}
		}

		function logout() {
			$session_data = $this->session->userdata('logged_in');
			$url = "http://blog.beyondlocal.dev/logout"; 
			$post_data = array( 
				"username" => $session_data['username'],
				"token" => $session_data['token']
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
				if($result->status == 'Success') { // If the output has the token then proceed to login
					$this->session->unset_userdata('logged_in');
					session_destroy();
					redirect('admin/dashboard', 'refresh');
				} elseif ($result->status == 'Failed') {
					$data['loginInvalid'] = true;
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