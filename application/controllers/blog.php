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
<<<<<<< HEAD
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
=======
				$otions = array('http' =>
					array(
						'method'  => 'GET'
					)
				);
				$context  = stream_context_create($otions);
				$response = file_get_contents('http://blog.beyondlocal.dev/post?slug='.$slug, false, $context);

				$data['post'] = json_decode($response);
				$data['title'] = $data['post'][0]->title;

				// Load the Views
				$this->load->view('header', $data);
				$this->load->view('article', $data);
				$this->load->view('footer', $data);
>>>>>>> origin/master
			}
		}

		function saveComment(){
			if($this->input->post()){
				$url = "http://blog.beyondlocal.dev/saveComment";
				// use key 'http' even if you send the request to https://...
				$options = array(
					'http' => array(
						'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
						'method'  => 'POST',
						'content' => http_build_query($this->input->post())
					),
				);
				$context  = stream_context_create($options);
				$result = json_decode(file_get_contents($url, false, $context));
				if ($result->status == 'Success') {
					$this->session->set_flashdata('success', 1);
					$this->session->set_flashdata('msg', $result->msg);
					redirect('/blog/posts/'.$this->input->post('slug'), 'refresh');
				} else {
					$this->session->set_flashdata('success', 0);
					$this->session->set_flashdata('msg', $result->msg);
					redirect('/blog/posts/'.$this->input->post('slug'), 'refresh');
				}
			} else {
				$this->session->set_flashdata('success', 0);
				$this->session->set_flashdata('msg', 'Invalid parameters');
				redirect('/blog/posts', 'refresh');
			}
		}

		function get_http_response_code($url) {
			$headers = get_headers($url);
			return substr($headers[0], 9, 3);
		}

	}

?>