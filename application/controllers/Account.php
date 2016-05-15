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
		$this->load->model('account_model');

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
	public function new_account() {

		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			$username = $this->input->post('user');
			$accname = $this->input->post('name');
			$acclink = $this->input->post('link');
			$acctype = $this->input->post('type');
			$imgpath = $this->input->post('imgpath');
			$imgtype = $this->input->post('imgtype');
			
			
			echo $this->account_model->new_account($username, $accname, $acclink, $acctype, $imgpath);	
		}else{
			redirect('/');
		}

		

	}

	public function delete_account() {

		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			$uid = (int)$this->input->post('user_id');
			$aid = (int)$this->input->post('acc_id');
			
			//security check
			if($_SESSION["user_id"] == $uid){
				//let's call the model
				echo $this->account_model->delete_account($uid, $aid);
			}
			
			
			
		}else{
			redirect('/');
		}

		

	}
	public function my_accounts() {

		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			echo $this->account_model->my_account_model($_SESSION['username']);	
		}else{
			redirect('/');
		}
		
		
		

	}
	public function get_account($acc_id) {
		
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			echo $this->account_model->get_account($acc_id, $_SESSION['username']);	
		}else{
			redirect('/');
		}
	}

	public function upload_file(){
		$valid_file=true;
	 	$message;
	 	$status;

	 	//if they DID upload a file...
	 	if($_FILES['uploaded_file']['name'])
	 	{
	 		//if no errors...
	 		if(!$_FILES['uploaded_file']['error'])
	 		{
	 			//now is the time to modify the future file name and validate the file
	 			$new_file_name = strtolower($_FILES['uploaded_file']['name']); //rename file
	 			if($_FILES['uploaded_file']['size'] > (20024000)) //can't be larger than 20 MB
	 			{
	 				$valid_file = false;
	 				$message = 'Oops!  Your file\'s size is to large.';
	 			}
	 			
	 			//if the file has passed the test
	 			if($valid_file)
	 			{
	 				$file_path = 'assets/uploads/'.$new_file_name;
	 				move_uploaded_file($_FILES['uploaded_file']['tmp_name'], FCPATH . $file_path);
	 				$message = 'Congratulations!  Your file was accepted.';
	 				$status = 200;
	 			}
	 		}
	 		//if there is an error...
	 		else
	 		{
	 			//set that to be the returned message
	 			$message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['uploaded_file']['error'];
	 		}
	 	}
	 	$save_path = base_url().$file_path;

	 	$name = $_FILES['uploaded_file']['name'];
	 	$size = $_FILES['uploaded_file']['size'];
	 	$type = $_FILES['uploaded_file']['type'];


	 	$data = array(
	 		"message" => $message,
	 		"save" => $save_path,
	 		"name" => $name,
	 		"size" => $size,
	 		"type" => $type,
	 		"status" => $status
	 	);
	 	echo json_encode($data);
	}
	
	
}