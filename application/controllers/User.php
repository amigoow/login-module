<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class User extends CI_Controller {

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
		// create the data object
		
		$data['title'] = "Corporate Filter";
		// load the main site
		$this->load->view('header', $data);
		$this->load->view('master/master', $data);
		$this->load->view('footer');
		
		
	}
	

	/**
	 * admin function.
	 * 
	 * @access public
	 * @return void
	 */
	public function admin($validation_msg=null) {
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			//redirect to dashboard
			redirect(base_url('dashboard'));
			return;
		}

		$data = new stdClass();
		$data = $validation_msg;
		


		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters(null, null);
		// set validation rules
		$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == false) {
			
			// validation not ok, send validation errors to the view
			$this->load->view('header');
			$this->load->view('admin/login', $data);
			$this->load->view('footer');

			
		} else {
			
			// set variables from the form
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			if ($this->user_model->resolve_admin_login($username, $password)) {
				
				
				//creating session
				$_SESSION['logged_in']    = (bool)true;
				$_SESSION['is_admin']     = (bool)true;
				redirect(base_url('dahsboard'));
			} else {
				$data = new stdClass;
				// login failed
				$data->error = 'Wrong username or password.';
				
				// send error to the view
				$this->load->view('header');
				$this->load->view('admin/login', $data);
				$this->load->view('footer');

				
			}
			
		}//ends

	}

	/**
	 * register function.
	 * 
	 * @access public
	 * @return void
	 */
	public function register() {
		
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			//redirect to dashboard
			redirect(base_url('/dashboard'));
			return;
		}

		// create the data object
		$data = new stdClass();
		
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters(null, null);

		// set validation rules
		$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]|is_unique[users.username]', array('is_unique' => 'This username already exists. Please choose another one.'));
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
		
		if ($this->form_validation->run() === false) {
			
			// validation not ok, send validation errors to the view
			$this->load->view('header');
			$this->load->view('user/register/register', $data);
			$this->load->view('footer');
			
		} else {
			
			// set variables from the form
			$username = $this->input->post('username');
			$email    = $this->input->post('email');
			$password = $this->input->post('password');
			$confirm_code = substr(md5(uniqid(rand(), true)), 16, 16);
			$data = "successful! Please check your email.";
			if ($this->user_model->create_user($username, $email, $password, $confirm_code)) {
				
				// user creation ok send them an email
				$info = array(
						'confirm_code' => $confirm_code,
						'username' => $username,
						'email' => $email
					);
				$this->send_email($info);
				//redirecting 
				$this->load->view('header');
				$this->load->view('user/register/register_success', $info);
				$this->load->view('footer');
				
			} else {
				
				// user creation failed, this should never happen
				$data->error = 'There was a problem creating your new account. Please try again.';
				
				// send error to the view
				$this->load->view('header');
				$this->load->view('user/register/register', $data);
				$this->load->view('footer');
				
			}
			
		}
		
	}
		
	/**
	 * login function.
	 * 
	 * @access public
	 * @return void
	 */
	public function login() {
		
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			//redirect to dashboard
			redirect(base_url('/dashboard'));
			return;
		}
		
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters(null, null);
		// set validation rules
		$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == false) {
			
			// validation not ok, send validation errors to the view
			$this->load->view('header');
			$this->load->view('user/login/login');
			$this->load->view('footer');
			
		} else {
			
			// set variables from the form
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			if ($this->user_model->resolve_user_login($username, $password)) {
				
				//creating session
				$this->create_session($username);
				
				
			} else {
				$data = new stdClass;
				// login failed
				$data->error = 'Wrong username or password.';
				
				// send error to the view
				$this->load->view('header');
				$this->load->view('user/login/login', $data);
				$this->load->view('footer');
				
			}
			
		}
		
	}
	/**
	 * confirm function.
	 * 
	 * @access public
	 * @return void
	 */
	public function confirm() {
		$username = $this->uri->segment(2, FALSE);
		$confirm_code = $this->uri->segment(3, FALSE);
		
		if(isset($username) && $confirm_code != FALSE){
			
			$username_c = $this->user_model->confirm_user($username, $confirm_code);

			if($username_c){

				//email is confirmed now so let's create a session
				$this->create_session($username_c);	

			}else{
				show_error("An error occured during email confirmation");
			}
		}else{
			// redirect to root because user is messing with us ;)
			redirect('/');
		}

	}
	/**
	 * logout function.
	 * 
	 * @access public
	 * @return void
	 */
	public function logout() {
		
		// create the data object
		$data = new stdClass();
		
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			
			// remove session datas
			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
			}
			
			// user logout ok
			$this->load->view('header');
			$this->load->view('user/logout/logout_success', $data);
			$this->load->view('footer');
			
		} else {
			
			// there user was not logged in, we cannot logged him out,
			// redirect him to site root
			redirect('/');
			
		}
		
	}

	/**
	 * forgot password function.
	 * 
	 * @access public
	 * @param varchar $email
	 * @return void
	 *
	 */
	public function forgot_password(){
		//default array
		$response = array(
			"status" => "success",
			"code" => 200,
			"data" => null,
			"message" => "We have sent you an email with your password."
		);

		$info['forgot_email'] = $this->input->post('email');
		if($this->user_model->check_email_exist($info['forgot_email'])){
			$username = $this->user_model->get_username_give_email($info['forgot_email']);
			if($username){
				$info['username'] = $username;
				
				if( ! $this->send_email($info)){
					$response["message"] = "Problem occured in sending email!";
					$response["status"] = "fail";
					$response["code"] = 400;
				}

			}else{
				$response["message"] = "Username not found!";
				$response["status"] = "fail";
				$response["code"] = 400;
			}
			

		}else{
			$response["message"] = "Email doesn't exist in DB!";
			$response["status"] = "fail";
			$response["code"] = 400;
		}

		echo json_encode($response);
		
	}
	/**
	 * create session function.
	 * 
	 * @access private
	 * @param varchar $username
	 * @return void
	 */
	private function create_session($username){
		$user_id = $this->user_model->get_user_id_from_username($username);
		$user    = $this->user_model->get_user($user_id);
		
		$data = new stdClass;
		
		if($user->is_confirmed == 0){
			// user login ok but email not confirmed
			$data->email = $user->email;
			$this->load->view('header');
			$this->load->view('user/login/login_success_without_confirm_email', $data);
			$this->load->view('footer');
		}else{
			// set session user datas
			$_SESSION['user_id']      = (int)$user->id;
			$_SESSION['username']     = (string)$user->username;
			$_SESSION['logged_in']    = (bool)true;
			$_SESSION['is_confirmed'] = (bool)$user->is_confirmed;
			$_SESSION['is_admin']     = (bool)$user->is_admin;	
			redirect(base_url('dashboard'));
		}
	}
	/**
	 * logout function.
	 * 
	 * @access private
	 * @return bool
	 */
	private function send_email($info){
        
        $config = Array(
          'protocol' => 'smtp',
          'smtp_host' => 'ssl://smtp.googlemail.com',
          'smtp_port' => 465,
          'smtp_user' => 'devccnt@gmail.com', 
          'smtp_pass' => 'devccnt12345', 
          'mailtype' => 'html',
          'charset' => 'iso-8859-1',
          'wordwrap' => TRUE
        );
        $this->load->library('email', $config);
        if(isset($info['forgot_email'])) {
        	
        	// forgot password

        	$email = $info['forgot_email'];
        	$username = $info['username'];
        	
        	$password = substr(md5(uniqid()),6,6);
        	$login_link = base_url() . 'new_pass/' . $username;


        	$updated_info = array("password" => password_hash($password, PASSWORD_BCRYPT));
        	$this->user_model->update_user($updated_info, $email);

	        $message = '<h2 style="color:#737373;">Hi,</h2>';
	        $message .= '<p style="font-size: 1.4em;color: #737373;">We have received your request to recover your password. Your login details are as follows: </p><br/>';
	        $message .= '<div style="text-align:center;border: 1px solid black;padding: 20px;"><div style="font-weight:bolder;font-size:1.4"> Username: <span style="text-align:center;border-radius:10%;padding:0.5625em 1.875em;font-size:1em;background-color:#4d90fe;color:#fff">'.$username.'</span> & Password: <span style="text-align:center;border-radius:10%;padding:0.5625em 1.875em;font-size:1em;background-color:#4d90fe;color:#fff">'.$password.'</span></div></div><br/><a style="margin:0 auto; display: block;text-align: center;" href="'.$login_link.'" title="login url">COPY PASSWORD AND CLICK HERE TO NAVIGATE TO LOGIN PAGE</a>';
	        $message .= '<h5 style="text-align: center;">CORPORATE FIRM<br/><small>info@corporatefirm.com</small></h5>';
	        $message .= '<p>'.date("d-m-Y",time()).'</p>';
	        
			$this->email->subject('PASSWORD RECOVERY - CORPORATE FIRM');
        }else{
        
        	//confirm email

        	$username_c = md5($info['username']);
        	$confirm_c = $info['confirm_code'];
        	$link = base_url() . 'confirme/' . $username_c . '/' . $confirm_c;
        	$username = $info['username'];
        	$email = $info['email'];

        	$message = '<h2 style="color:#737373;">Hi, '.$username.'!</h2>';
        	$message .= '<p style="font-size: 1.4em;color: #737373;">We have received your registration, just one step left. Click on the button to get your account verified!</p><br/>';
        	$message .= '<div style="text-align: center;"><a style="text-align: center;font-weight: bolder;border-radius: 10%;padding: 0.5625em 1.875em;font-size: 1.4em;background-color: #7ab55c;color:#fff;" href="'.$link.'">Confirm Email</a></div><br/>';
        	$message .= '<h5 style="text-align: center;">CORPORATE FIRM<br/><small>info@corporatefirm.com</small></h5>';
        	$message .= '<p>'.date("d-m-Y",time()).'</p>';	

        	$this->email->subject('REGISTRATION CONFIRMATION - CORPORATE FIRM');
        }
        
        
		
		$this->email->set_newline("\r\n");
		$this->email->from('no-reply@corporatefirm.com'); // change it to yours
		$this->email->to($email);// change it to yours
		
		$this->email->message($message);

		return $this->email->send();
	
	}
	
}
