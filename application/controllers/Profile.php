<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Dashboard class.
 * 
 * @extends CI_Controller
 */
class Profile extends CI_Controller {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
		$this->load->model('user_model');
		
	}
	public function index() {
	
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			$data['title'] = "Corporate Filter";
			$data['user'] = $_SESSION["username"];
			
			$this->load->view('header.php', $data);
			$this->load->view('master/master', $data);
			$this->load->view('footer.php');
		}
		
	
		
	}
	public function user($username) {
	
		
			$data['title'] = "Corporate Filter";
			$data['user'] = $username;
			$this->load->view('header.php', $data);
			$this->load->view('master/master', $data);
			$this->load->view('footer.php');
		
		
	
		
	}

}