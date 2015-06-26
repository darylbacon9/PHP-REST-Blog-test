<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Posts extends CI_Controller {

		function __construct() {
			parent::__construct();
		}

		function index() {
			if ($this->session->logged_in) {
				$sessionData = $this->session->logged_in; // Load session data into a variable
				$data['username'] = $sessionData['username'];
				$url = 'http://blog.beyondlocal.dev/posts';
				$response = file_get_contents($url);
				$data['title'] = "Blog Posts";
				$data['blogPost'] = json_decode($response);
				var_dump($data['blogPost']);exit;

				// Load the views
				$this->load->view('/admin/adminHeader', $data);
				$this->load->view('/admin/viewPosts', $data);
				$this->load->view('/admin/adminFooter', $data);
			} else {
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

		function savePost($uuid = NULL) {
			// Save blog post
			if ($this->session->logged_in) {
				$sessionData = $this->session->logged_in;
				if ($uuid == NULL) { // If there is no uuid then send add data to the api
					var_dump($this->input->post()); exit;
					// var_dump($sessionData);
					$url = "http://blog.beyondlocal.dev/savePost"; 
					$post_data = array( 
						"slug" => $this->input->post('slug'), 
						"title" => $this->input->post('title'),
						"category" => $this->input->post('category'),
						"status" => $this->input->post('status'),
						"allowComments" => $this->input->post('allowComments'),
						"body" => $this->input->post('body'),
						"token" => $this->session->logged_in('token'),
						"uuidUser" => $this->session->logged_in['uuidUser']
					);
					// var_dump($post_data);
					// logged_in key 'http' even if you send the request to https://...
					$options = array(
						'http' => array(
							'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
							'method'  => 'POST',
							'content' => http_build_query($post_data)
						),
					);
					$context  = stream_context_create($options);
					// get response of url
					// $httpResponse = $this->get_http_response_code($url);
					$result = file_get_contents($url, false, $context);
					$result = json_decode($result);
					if ($result->status == 'Success') {
						$this->session->set_flashdata('success', 1);
						$this->session->set_flashdata('msg', 'Post Added!');
						redirect('admin/posts', 'refresh');
					}
				} else { // If the uuid is present, send update data to the api
					#
				}
			} else {
				// If no session, redirect to login page
				redirect('admin/login', 'refresh');
			}
		}

		function get_http_response_code($url) {
			$headers = get_headers($url);
			return substr($headers[0], 9, 3);
		}

	}

?>