<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class Account_model extends CI_Model {

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
	public function new_account($username, $accname, $acclink, $acctype, $imgpath) {
		
		$res = array(
				"status" => 200,
				"msg" => "success",
				"data" => $username
			);

		$userid = $this->get_userid_from_username($username);
		if(!$userid){
			$res["msg"] = "userid not found";
			$res["status"] = "fail";
		}else{
			$data = array(
			
				'account_name' => $accname,
				'user_id'   => $userid,
				'url'   => $acclink,
				'acc_type' => $acctype,
				'img_path' => $imgpath
			);
			
			$this->db->insert('accounts', $data);	
		}
		
		return json_encode($res);
		
	}
	public function delete_account($uid, $aid) {

		$res = array(
			"status" => 200,
			"msg" => "success",
			"data" => $uid
		);

		$this->db->update('accounts', array("is_active" => 0), array('account_id' => $aid, "user_id" => $uid ) );
		if($this->db->affected_rows() != 1){
			$res["msg"] = "Some error!";
			$res["status"] = "500";
		}
		return json_encode($res);
	}

	public function get_account($acc_id, $username){
		$userid = $this->get_userid_from_username($username);

		$this->db->where('user_id', $userid);
		$this->db->where('account_id', $acc_id);
		$this->db->where('is_active', 1);
		
		$query = $this->db->get('accounts');
	
		return $query->num_rows() != 0  ? json_encode($query->result_array()) : FALSE;
	}

	public function my_account_model($username){
		$userid = $this->get_userid_from_username($username);
		$this->db->where('user_id', $userid);
		$this->db->where('is_active', 1);
		
		$query = $this->db->get('accounts');
	
		return $query->num_rows() != 0  ? json_encode($query->result_array()) : FALSE;
	}


	public function get_userid_from_username($username){
		$this->db->select('id');
		$this->db->where('username', $username);

		$query = $this->db->get('users');
	
		return $query->num_rows() == 1  ? $query->row()->id : FALSE;
	}

	

}