<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Blog extends CI_Controller {

		function __construct() {
			parent::__construct();
		}

		function posts($slug = NULL) {
			$url = 'http://blog.beyondlocal.dev/posts';
			$httpResponse = $this->get_http_response_code($url);
			if ($httpResponse != '200') {
				$this->session->set_flashdata('success', 0);
				$this->session->set_flashdata('msg', 'The page you are trying to access does not exist.');
				redirect('/', 'refresh');
			} else {
				if ($slug == NULL) {
					$response = file_get_contents($url);
					$data['title'] = "Blog Posts";
					$data['blogPosts'] = json_decode($response);

					// Load the Views
					$this->load->view('header', $data);
					$this->load->view('blog', $data);
					$this->load->view('footer', $data);
				} else {
					$otions = array('http' =>
						array(
							'method'  => 'GET'
						)
					);
					$context  = stream_context_create($otions);
					$response = file_get_contents('http://blog.beyondlocal.dev/post?slug='.$slug, false, $context);

					$data['post'] = json_decode($response);
					$data['title'] = $data['post']->title;

					// Load the Views
					$this->load->view('header', $data);
					$this->load->view('article', $data);
					$this->load->view('footer', $data);
				}
			}
		}

		function get_http_response_code($url) {
			$headers = get_headers($url);
			return substr($headers[0], 9, 3);
		}

	}

?>