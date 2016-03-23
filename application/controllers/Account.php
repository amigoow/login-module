<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Dashboard class.
 * 
 * @extends CI_Controller
 */
class Account extends CI_Controller {

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

		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			
		}else{
			redirect('/');
		}
	}
	
	public function index() {
		
	}

	public function add_account() {
		$data = new stdClass;
		$this->load->view('admin/header');
		$this->load->view('admin/add_account.php', $data);
		$this->load->view('admin/footer');		
	}
	
}