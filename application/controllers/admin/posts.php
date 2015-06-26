<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Posts extends CI_Controller {

		function __construct() {
			parent::__construct();
		}

		function index() {
			// show all posts
		}

		function edit($uuid = NULL) {

		}

		function get_http_response_code($url) {
			$headers = get_headers($url);
			return substr($headers[0], 9, 3);
		}

	}

?>