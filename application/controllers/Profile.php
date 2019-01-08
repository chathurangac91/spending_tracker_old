<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

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

		if ($this->common->userinfo()->logged_in && $this->common->authorized('row', 'users', 'id')){
        	$this->load->library('Grocery_CRUD');
        	$this->load->model('db_model');
        }
        else{
        	redirect(base_url());
        }
		
	}

	public function index(){

		$crud = new grocery_CRUD();
		$crud->set_subject('Profile')
				->set_theme('flexigrid')
				->set_table('users')
				->where('id', $this->common->userinfo()->user_id)
				->columns('first_name','last_name','email','is_active')
				->edit_fields('first_name','last_name','email','goal','currencry_code','modified_datetime')

				->display_as('is_active','Status')
				->display_as('goal','Monthly goal ( '.$this->common->userinfo()->currencry_code.' )')
				->field_type('is_active','dropdown',array('1' => 'Active', '2' => 'Inactive'))
				->field_type('password','password')
				->field_type('confirm_password','password')
				->field_type('created_datetime', 'hidden')
				->field_type('modified_datetime', 'hidden')
				->required_fields('first_name','email','currencry_code')
				->unique_fields(array('email'))
				->set_rules('email','Email','required|max_length[60]|valid_email')
				->callback_before_update(array($this,'before_update_callback'))
				
				->unset_back_to_list()
				->unset_add()
				->unset_delete()
				->unset_read()
				->unset_clone()
				->unset_jquery();

		$data = $crud->render();
		$data->js = array();
		$data->css = array(base_url('assets/grocery_crud/css/ui/simple/jquery-ui-1.10.1.custom.min.css'));

		$data->js_files = $this->common->rem_keys_from_array($data->js_files);
		$data->css_files = $this->common->rem_keys_from_array($data->css_files);
		
		$data->js = array_merge((array) $data->js_files, (array)$data->js);
		$data->css = array_merge((array) $data->css_files, (array)$data->css);

		$data->title = "My Profile";

		// Load view
		$this->common->view('common/crud', $data); 
	}

	// Get updated date/time
	function before_update_callback($post_array, $primary_key = null){

	  $post_array['modified_datetime'] = date('Y-m-d H:i:s');

	  return $post_array;
	}

	/**
	 * Load change password view
	 */
	public function change_password(){
		
		$data = (object)NULL;
		$data->js = array();
		$data->css = array();

		$data->title = "Change password";

		$this->common->view('user/change_password', $data); 
	}

	/**
	 * Change user password
	 */
	public function update_password(){

		$this->load->library('form_validation');

		$this->form_validation->set_rules('password','Password','required|max_length[16]|min_length[8]');
		$this->form_validation->set_rules('confirm_password','Confirm Password','required|matches[password]');

		if($this->form_validation->run() === FALSE){

			$data = (object)NULL;
			$data->js = array();
			$data->css = array();

			$data->title = "Change password";

			$this->common->view('user/change_password', $data); 
		}else{

			$password = sha1(md5($this->input->post('password')));
			$this->db_model->update('users', 
							array('password' => $password), 
							array('id' => $this->common->userinfo()->user_id)
						);

			redirect('logout');
		}
	}
}
