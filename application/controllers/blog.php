<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Blog extends CI_Controller {

		function __construct() {
			parent::__construct();
		}

		function posts($slug = NULL) {
			$response = json_decode(file_get_contents('http://blog.beyondlocal.dev/posts'));
			if ($slug == NULL) {
				$data['title'] = "Blog Posts";
				$data['blogPosts'] = json_decode($response);
				$this->load->view('blog', $data);	
			} else {
			}
		}

		function get_http_response_code($url) {
			$headers = get_headers($url);
			return substr($headers[0], 9, 3);
		}

	}

?>