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

				// get the categories for the form
				$url = 'http://blog.beyondlocal.dev/getCategories';
				$response = file_get_contents($url);
				$data['categories'] = json_decode($response);
				// var_dump($data['categories']);exit();

				// Get statuses for the form
				$url = 'http://blog.beyondlocal.dev/getStatuses';
				$response = file_get_contents($url);
				$data['statuses'] = json_decode($response);

				if ($uuid == NULL) { // If there is no uuid then it is an add
					$data['title'] = 'Add a new blog post';
					$data['formAction'] = '/admin/posts/savePost';
					$data['formAttributes'] = array(
						'class' => 'form-horizontal',
						'id' => 'addEditPostForm'
					);
				} else { // If the uuid is present then it is an edit

				}

				// Load the views
				$this->load->view('/admin/adminHeader', $data);
				$this->load->view('/admin/postEdit', $data);
				$this->load->view('/admin/adminFooter', $data);
			} else { // If user is not logged in redirect to the home page
				// If no session, redirect to login page
				redirect('admin/login', 'refresh');
			}
		}

	}

?>