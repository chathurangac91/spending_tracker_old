<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model{

	function check_login($db_params){

		$this->db->select('id,first_name,last_name,email,goal,currencry_code,is_active,pw_changed,type');
		$this->db->from('users');
		$this->db->where(array('email' => $db_params['email'], 'password' => $db_params['password']));
		$query = $this->db->get();
		
		return $query->result();
	}
}
