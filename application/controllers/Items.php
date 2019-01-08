<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends CI_Controller {

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
		$crud->set_subject('Item')
				->set_theme('flexigrid')
				->set_table('items')
				->where('user_id', $this->common->userinfo()->user_id)

				->columns('name','type')
				->add_fields('user_id','name','type','main')
				->edit_fields('user_id','name','type','main')

				->display_as('user_id','User')
				->field_type('type','dropdown',array('1' => 'Income', '2' => 'Expense'))
				->field_type('main','dropdown',array('1' => 'Yes', '2' => 'No'))
				->field_type('user_id','hidden',$this->common->userinfo()->user_id)
				->required_fields('user_id','name','type','main')
				// ->unique_fields(array('name'))

				->unset_clone()
				->unset_jquery();

		// Set type in read view
		$crud->callback_read_field('type', function ($value, $primary_key) {

			$type = array('1' => 'Income', '2' => 'Expense');
			return $type[$value];
		});

		// Set Main in read view
		$crud->callback_read_field('main', function ($value, $primary_key) {

			$main = array('1' => 'Yes', '2' => 'No');
			return $main[$value];
		});

		$data = $crud->render();
		$data->js = array();
		$data->css = array(base_url('assets/grocery_crud/css/ui/simple/jquery-ui-1.10.1.custom.min.css'));

		$data->js_files = $this->common->rem_keys_from_array($data->js_files);
		$data->css_files = $this->common->rem_keys_from_array($data->css_files);
		
		$data->js = array_merge((array) $data->js_files, (array)$data->js);
		$data->css = array_merge((array) $data->css_files, (array)$data->css);

		$data->title = "Manage Items";

		// Load view
		$this->common->view('common/crud', $data); 
	}
}
