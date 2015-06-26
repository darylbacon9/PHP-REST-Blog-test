<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Categories extends CI_Controller {

		function __construct() {
			parent::__construct();
		}

		function index() {
			if ($this->session->logged_in) { // Check if the user is logged in
				$sessionData = $this->session->logged_in; // Load session data into a variable
				$data['username'] = $sessionData['username'];
				
				$url = 'http://blog.beyondlocal.dev/getCategories';
				$response = file_get_contents($url);
				$data['categories'] = json_decode($response);

				// Load the views
				$this->load->view('/admin/adminHeader', $data);
				$this->load->view('/admin/categories', $data);
				$this->load->view('/admin/adminFooter', $data);
			} else {
				// If user is not logged in redirect to the home page
				// If no session, redirect to login page
				redirect('admin/login', 'refresh');
			}
		}

		function edit($uuid = NULL) {
			if ($this->session->logged_in) { // Check if the user is logged in
				$sessionData = $this->session->logged_in; // Load session data into a variable
				$data['username'] = $sessionData['username'];
				$this->load->helper('form');

				$data['formAction'] = '/admin/categories/saveCategory';
				$data['formAttributes'] = array(
					'class' => 'form-horizontal',
					'id' => 'addEditCategoryForm'
				);

				// Load the views
				$this->load->view('/admin/adminHeader', $data);
				$this->load->view('/admin/categoryEdit', $data);
				$this->load->view('/admin/adminFooter', $data);
			} else { // If user is not logged in redirect to the home page
				// If no session, redirect to login page
				redirect('admin/login', 'refresh');
			}
		}

		function saveCategory(){
			if ($this->session->logged_in) { // Check if the user is logged in
				$url = "http://blog.beyondlocal.dev/saveCategory";
				$postData = array(
					'title'=>$this->input->post('title'),
					'slug'=>$this->input->post('slug'),
					"token" => $this->session->logged_in['token'],
					"uuidUser" => $this->session->logged_in['uuidUser']
				);
				// use key 'http' even if you send the request to https://...
				$options = array(
					'http' => array(
						'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
						'method'  => 'POST',
						'content' => http_build_query($postData)
					),
				);
				$context  = stream_context_create($options);
				$result = json_decode(file_get_contents($url, false, $context));
				if ($result->status == 'Success') {
					$this->session->set_flashdata('success', 1);
					$this->session->set_flashdata('msg', $result->msg);
					redirect('/admin/categories/', 'refresh');
				} else {
					$this->session->set_flashdata('success', 0);
					$this->session->set_flashdata('msg', $result->msg);
					redirect('/blog/categories/', 'refresh');
				}
			} else { // If user is not logged in redirect to the home page
				// If no session, redirect to login page
				redirect('admin/login', 'refresh');
			}
		}

	}

?>