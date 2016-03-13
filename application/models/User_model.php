<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class User_model extends CI_Model {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		
	}
	
	/**
	 * create_user function.
	 * 
	 * @access public
	 * @param mixed $username
	 * @param mixed $email
	 * @param mixed $password
	 * @return bool true on success, false on failure
	 */
	public function create_user($username, $email, $password, $confirm_code) {
		
		$data = array(
			'username'   => $username,
			'email'      => $email,
			'password'   => $this->hash_password($password),
			'confirm_code' => $confirm_code,
			'created_at' => date('Y-m-j H:i:s'),
		);
		
		return $this->db->insert('users', $data);
		
	}
	/**
	 * update_user function.
	 * 
	 * @access public
	 * @param mixed $email
	 * @return bool true on success, false on failure
	 */
	public function update_user($updated_info, $email) {
		
		$this->db->update('users', $updated_info, array('email' => $email ) );
		return $this->db->affected_rows() == 1 ? TRUE : FALSE;
		
	}
	/**
	 * resolve_user_login function.
	 * 
	 * @access public
	 * @param mixed $username
	 * @param mixed $password
	 * @return bool true on success, false on failure
	 */
	public function resolve_user_login($username, $password) {
		
		$this->db->select('password');
		$this->db->from('users');
		$this->db->where('username', $username);
		$hash = $this->db->get()->row('password');
		
		return $this->verify_password_hash($password, $hash);
		
	}
	
	/**
	 * get_user_id_from_username function.
	 * 
	 * @access public
	 * @param mixed $username
	 * @return int the user id
	 */
	public function get_user_id_from_username($username) {
		
		$this->db->select('id');
		$this->db->from('users');
		$this->db->where('username', $username);

		return $this->db->get()->row('id');
		
	}
	/**
	 * confirm_user function.
	 * 
	 * @access public
	 * @param mixed $username
	 * @param varchar $confirm_code
	 * @return bool
	 */
	public function confirm_user($u_hash, $confirm_code) { 
		
		$this->db->select('username');
		$this->db->from('users');
		$this->db->where('confirm_code', $confirm_code);
		$username = $this->db->get()->row('username');
		
		if ( ! $this->confirm_status($username)){ //do following if user has not yet confirmed
			if(md5($username) == $u_hash){
				
				$this->db->update('users', 
					array(
						"is_confirmed" => 1 //update this
					),
					array(
						'confirm_code' => $confirm_code, //where
						'username' => $username //and where
					)
				);

				return $this->db->affected_rows() == 1 ? $username : FALSE ;

				
			}else{
				//the provided username hash was not valid
				return FALSE;
			}	
		}else{
			$login = "<a href=".base_url()."login>Login</>";
			show_error("You have already verified your email! Please proceed to {$login}.", null, "Email already Confirmed!");
		}
		
	}

	/**
	 * get_user function.
	 * 
	 * @access public
	 * @param mixed $user_id
	 * @return object the user object
	 */
	public function get_user($user_id) {
		
		$this->db->from('users');
		$this->db->where('id', $user_id);
		return $this->db->get()->row();
		
	}
	/**
	 * get_user function.
	 * 
	 * @access public
	 * @param mixed $email
	 * @return object the user object
	 */
	public function get_user_from_email($email) {
		
		$this->db->from('users');
		$this->db->where('email', $email);
		return $this->db->get()->row();
		
	}
	/**
	 * check confirm_status function.
	 * 
	 * @access public
	 * @param mixed $user_id
	 * @return object the user object
	 */
	public function confirm_status($username) {
		
		$this->db->from('users');
		$this->db->where('username', $username);

		return $this->db->get()->row()->is_confirmed == 1  ? TRUE : FALSE;
		
	}
	/**
	 * check check_email_exist function.
	 * 
	 * @access public
	 * @param mixed $email
	 * @return object the user object
	 */
	public function check_email_exist($email) {
		
		$this->db->where('email', $email);

		$query = $this->db->get('users');
	
		return $query->num_rows() == 1  ? TRUE : FALSE;
		
	}

	/**
	 * check get_username_give_email function.
	 * 
	 * @access public
	 * @param mixed $email
	 * @return object the user object
	 */
	public function get_username_give_email($email) {
		
		$this->db->select('username');
		$this->db->where('email', $email);

		$query = $this->db->get('users');
	
		return $query->num_rows() == 1  ? $query->row()->username : FALSE;
		
	}

	
	
	
	/**
	 * hash_password function.
	 * 
	 * @access private
	 * @param mixed $password
	 * @return string|bool could be a string on success, or bool false on failure
	 */
	private function hash_password($password) {
		
		return password_hash($password, PASSWORD_BCRYPT);
		
	}
	
	/**
	 * verify_password_hash function.
	 * 
	 * @access private
	 * @param mixed $password
	 * @param mixed $hash
	 * @return bool
	 */
	private function verify_password_hash($password, $hash) {
		
		return password_verify($password, $hash);
		
	}
	
	
	
}
