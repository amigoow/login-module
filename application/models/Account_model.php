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
	public function new_basics($username, $feedback_title, $feedback_subtitle, $feedback_1_5, $feedback_2_5, $feedback_3_5, $feedback_4_5, $feedback_5_5) {
		$userid = $this->get_userid_from_username($username);
		$data = array(
			
				'title' => $feedback_title,
				'subtitle'   => $feedback_subtitle,
				'feedback_1_5'   => $feedback_1_5,
				'feedback_2_5'   => $feedback_2_5,
				'feedback_3_5'   => $feedback_3_5,
				'feedback_4_5'   => $feedback_4_5,
				'feedback_5_5'   => $feedback_5_5,
				'userid' => $userid
			);
		
		$res = array(
				"status" => 200,
				"msg" => "success",
				"data" => $data
			);

		
		if(!$userid){
			$res["msg"] = "userid not found";
			$res["status"] = "fail";
		}else{
			

			$sql = 'INSERT INTO basics (title, subtitle, feedback_1_5, feedback_2_5, feedback_3_5, feedback_4_5, feedback_5_5, userid)
			        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
			        ON DUPLICATE KEY UPDATE 
			            title=VALUES(title), 
			            subtitle=VALUES(subtitle), 
			            feedback_1_5=VALUES(feedback_1_5),
			            feedback_2_5=VALUES(feedback_2_5),
			            feedback_3_5=VALUES(feedback_3_5),
			            feedback_4_5=VALUES(feedback_4_5),
			            feedback_5_5=VALUES(feedback_5_5)
			            ';

			$query = $this->db->query($sql, array(  $feedback_title,
													$feedback_subtitle,
													$feedback_1_5,
													$feedback_2_5,
													$feedback_3_5,
													$feedback_4_5,
													$feedback_5_5,
													$userid
			                                      )
									);


			// $this->db->insert('basics', $data);	
		}
		
		return json_encode($res);
		
	}
	public function get_basic_info($username){
		$userid = $this->get_userid_from_username($username);
		
		$this->db->where('userid', $userid);
		$query = $this->db->get('basics');
		
		return $query->num_rows() != 0  ? json_encode($query->result_array()) : FALSE;
	}
	public function update_account($uid, $account, $accname, $acclink, $acctype, $imgpath) {
		
		$res = array(
			"status" => 200,
			"msg" => "success",
			"data" => array(
				"user_id" => $uid,
				"account" => $account,
				"accname" => $accname,
				"acclink" => $acclink,
				"acctype" => $acctype,
				"imgpath" => $imgpath
					
			)
		);


		$this->db->update('accounts', array("account_name" => $accname, "url" => $acclink, "acc_type" => $acctype, "img_path" => $imgpath ), array('account_id' => $account, "user_id" => $uid ) );
		if($this->db->affected_rows() != 1){
			$res["msg"] = $this->db;
			$res["status"] = "500";
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