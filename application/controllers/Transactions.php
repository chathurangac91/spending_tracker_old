<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct(){
		parent::__construct();
		
		if ($this->common->userinfo()->logged_in && $this->common->authorized('row')){
        	$this->load->library('Grocery_CRUD');
        	$this->load->model('db_model');
        }
        else{
        	redirect(base_url());
        }
		
	}

	public function index(){

		$crud = new grocery_CRUD();
		$crud->set_subject('Transaction')
				->set_theme('flexigrid')
				->set_table('transactions')
				->where('user_id', $this->common->userinfo()->user_id)

				->columns('item_id','amount')
				->order_by('id','desc')
				->add_fields('user_id','type','item_id','item','amount','date','note')
				->edit_fields('user_id','type','item_id','item','amount','date','note')
				->set_read_fields('user_id','type','item_id','item','amount','date','note')

				->display_as('user_id','User')
				->display_as('item_id','Category')
				->display_as('amount','Amount ( '.$this->common->userinfo()->currencry_code.' )')
				->field_type('type','dropdown',array('1' => 'Income', '2' => 'Expense'))
				->field_type('user_id','hidden',$this->common->userinfo()->user_id)
				->field_type('item_id','hidden')
				->required_fields('type','item','amount','date')

				->callback_column('item_id',array($this,'set_item'))
				->callback_before_insert(array($this,'insert_item'))
				->callback_before_update(array($this,'insert_item'))

				->unset_texteditor('note')
				->unset_clone()
				->unset_jquery();

		// Item field disable
		$crud->callback_add_field('item', function () {
			return '<input id="field-item" class="form-control initial-disabled" name="item" type="text" value="" disabled autocomplete="off">';
		});

		// Set item name in edit form
		$crud->callback_edit_field('item', function ($value, $primary_key) {

			$get_item_id =  $this->db_model->get_where('transactions', 'item_id', array('id' => $primary_key));
			$get_item =  $this->db_model->get_where('items', 'name', array('id' => $get_item_id[0]['item_id']));
			return '<input id="field-item" class="form-control initial-disabled" name="item" type="text" value="'.$get_item[0]['name'].'" autocomplete="off">';
		});

		// Set item name in read view
		$crud->callback_read_field('item', function ($value, $primary_key) {

			$get_item_id =  $this->db_model->get_where('transactions', 'item_id', array('id' => $primary_key));
			$get_item =  $this->db_model->get_where('items', 'name', array('id' => $get_item_id[0]['item_id']));
			return $get_item[0]['name'];
		});

		// Set type in read view
		$crud->callback_read_field('type', function ($value, $primary_key) {

			$type = array('1' => 'Income', '2' => 'Expense');
			return $type[$value];
		});

		$data = $crud->render();
		$data->js = array(base_url('assets/js/typehead/bootstrap3-typeahead.min.js'), base_url('assets/js/custom/transactions.js?v=1.2'));
		$data->css = array(base_url('assets/grocery_crud/css/ui/simple/jquery-ui-1.10.1.custom.min.css'));

		$data->js_files = $this->common->rem_keys_from_array($data->js_files);
		$data->css_files = $this->common->rem_keys_from_array($data->css_files);
		
		$data->js = array_merge((array) $data->js_files, (array)$data->js);
		$data->css = array_merge((array) $data->css_files, (array)$data->css);

		$data->title = "Manage Transactions";

		// Load view
		$this->common->view('common/crud', $data); 
	}

	/**
	 * Gets the item.
	 */
	public function get_item(){
		
		$name = $this->input->get('name');
		$type = $this->input->get('type');

		$data = $this->db_model->get_items($name, $type);

		echo json_encode($data);
	}

	/**
	 * Callback Insert Item
	 *
	 * @param      Array  $post_array   The post array
	 * @param      Int  $primary_key  The primary key
	 */
	public function insert_item($post_array, $primary_key = null){

		if($post_array['item_id'] == ""){
			$check_item = $this->db_model->get_where('items', 'id', array(
																		'user_id' => $this->common->userinfo()->user_id,
																		'type' => $post_array['type'],
																		'name' => $post_array['item']
																	));

			if($check_item){
				$post_array['item_id'] = $check_item[0]['id'];
			}else{
				$insert_id = $this->db_model->insert('items', array(
																'user_id' => $this->common->userinfo()->user_id,
																'name' => $post_array['item'],
																'type' => $post_array['type'],
																'main' => 1,
															));

				if($insert_id){
					$post_array['item_id'] = $insert_id;
				}else{
					return false;
				}
			}
		}

		unset($post_array['item']);
		return $post_array;
	}

	/**
	 * Sets the item name in list view
	 *
	 * @param      string  $value  The value
	 *
	 * @return     sting  Item Name
	 */
	public function set_item($value=''){
		$get_item = $this->db_model->get_where('items', 'name', array('id' => $value));
		return $get_item[0]['name'];
	}
}
