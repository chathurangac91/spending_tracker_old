<?php defined('BASEPATH') or exit('No direct script access allowed');

class DB_model extends CI_Model{

	public function __construct(){
		$this->load->database();
	}

	/**
	 * Get records 
	 * @param      array   	$options	all db options
	 * 									[key] => query builder function name, [value] => values ( string or array)
	 * 									Available options:  distinct, where, having, order_by, group_by, limit
	 * 									
	 * @param      boolean  $json    	TRUE: return json encoded array
	 * @return     array 	json or php array or false if there is an error
	 */
	public function get($table, $fields, $options, $json=false){
		$this->db->select($fields);
		$this->db->from($table);
		foreach ($options as $key=> $value) {
			$this->db->$key($value);
		}
		$query = $this->db->get();

		return $json ? json_encode($query->result_array()) : $query->result_array();
	}

	public function get_all($table, $fields, $json=false){
		$this->db->select($fields);
		$this->db->from($table);
		$query = $this->db->get();

		return $json ? json_encode($query->result_array()) : $query->result_array();
	}

	public function get_distinct_all($table, $fields, $json=false){
		$this->db->distinct();
		$this->db->select($fields);
		$this->db->from($table);
		$query = $this->db->get();

		return $json ? json_encode($query->result_array()) : $query->result_array();
	}

	public function get_where($table, $fields, $where, $json=false){
		$this->db->select($fields);
		$this->db->from($table);
		$this->db->where($where);
		$query = $this->db->get();

		return $json ? json_encode($query->result_array()) : $query->result_array();
	}

	public function get_like($table, $fields, $like, $json=false){
		$this->db->select($fields);
		$this->db->from($table);
		$this->db->like($like);
		$query = $this->db->get();

		return $json ? json_encode($query->result_array()) : $query->result_array();
	}

	public function get_row($table,$fields, $where, $json=false){
		$this->db->select($fields);
		$this->db->from($table);
		$this->db->where($where);
		$query = $this->db->get();

		return $json ? json_encode($query->row_array()) : $query->row_array();
	}

	public function get_order_by($table, $fields, $order_by, $json=false){
		$this->db->select($fields);
		$this->db->from($table);
		$this->db->order_by($order_by);
		$query = $this->db->get();

		return $json ? json_encode($query->result_array()) : $query->result_array();
	}

	public function get_join($table, $fields, $joins, $options, $json=false){
		$this->db->distinct();
		$this->db->select($fields);
		$this->db->from($table);

		foreach ($joins as $join) {
			$type = array_key_exists(2, $join) ? $join[2] : 'INNER JOIN' ;
			$this->db->join( $join[0], $join[1], $type );
		}
		foreach ($options as $key => $value) {
			$this->db->$key($value);
		}
		$query = $this->db->get();
		
		return $json ? json_encode($query->result_array()) : $query->result_array();
	}

	public function count($table, $where = array()){

		$this->db->from($table);
		$this->db->where($where);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function is_exists($table, $where){
		$query = $this->db->get_where($table, $where, 1);
		return $query->num_rows() > 0;
	}

	public function insert( $table, $data ){
		$this->db->insert( $table, $data );
		return $this->db->insert_id();
	}

	public function insert_id(){
		return $this->db->insert_id();
	}

	public function update( $table, $data, $where ){
		$this->db->where($where);
		$this->db->update( $table, $data);
	}

	// Caching helpers

	public function start_cache(){
		$this->db->start_cache();
	}

	public function stop_cache(){
		$this->db->stop_cache();
	}

	public function flush_cache(){
		$this->db->flush_cache();
	}

	public function last(){
		return $this->db->last_query();
	}

	public function query($query){
		return $this->db->query($query);
	}

	public function delete($table, $where){
		
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function get_items($name, $type){

		$this->db->select('id,name');
		$this->db->from('items');
		$this->db->where('user_id', $this->common->userinfo()->user_id);
		$this->db->where('type', $type);
		$this->db->where('main', 1);
		$this->db->like('name', $name);
		// $this->db->group_by('trip');
		$query = $this->db->get();

		return $query->result_array();
	}
}
	
