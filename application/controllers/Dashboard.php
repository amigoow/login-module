<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Dashboard class.
 * 
 * @extends CI_Controller
 */
class Dashboard extends CI_Controller {

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
			$data = new stdClass;
			$this->load->view('admin/header');
			$this->load->view('admin/dashboard', $data);
			$this->load->view('admin/footer');	
		}else{
			redirect('/');
		}	
		
	}

}