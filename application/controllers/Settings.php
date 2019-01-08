<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

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

		if ($this->common->userinfo()->logged_in && $this->common->authorized('admin')){
        	$this->load->library('Grocery_CRUD');
        	$this->load->model('db_model');
        }
        else{
        	redirect(base_url());
        }
	}

	public function index(){

		$crud = new grocery_CRUD();
		$crud->set_subject('System Settings')
				->set_theme('flexigrid')
				->set_table('system_config')

				->columns('company_name','contact_email','time_zone')
				->edit_fields('company_name','logo','logo_small','contact_email','time_zone','smtp_host','smtp_port','smtp_user','smtp_pass')

				->field_type('smtp_pass','password')
				->set_field_upload('logo','assets/uploads/images/logo')
				->set_field_upload('logo_small','assets/uploads/images/logo')
				->required_fields('company_name','contact_email','time_zone','smtp_host','smtp_port','smtp_user','smtp_pass')
				
				->unset_back_to_list()	
				->unset_add()
				->unset_delete()
				->unset_read()
				->unset_clone()
				->unset_jquery();

		// Set timezone list
		$crud->callback_edit_field('time_zone', function ($value, $primary_key) {

			$string = file_get_contents("assets/timezones.json");
			$json = json_decode($string, true);

			$html = '<select name="time_zone" class="chosen">';
			for ($i=0; $i < count($json); $i++) { 

				foreach ($json[$i]['utc'] as $timezones => $timezone) {
					$select = $timezone == $value ? 'selected' : '';
				    $html .= '<option value="'.$timezone.'" '.$select.'>'.$timezone.'</option>';
				}
			}

			$html .= '</select>';
			
			return $html;
		});

		$data = $crud->render();
		$data->js = array(base_url('assets/js/custom/chosen.jquery.js'), base_url('assets/js/custom/settings.js'));
		$data->css = array(base_url('assets/grocery_crud/css/ui/simple/jquery-ui-1.10.1.custom.min.css'), base_url('assets/css/chosen/bootstrap-chosen.css'));

		$data->js_files = $this->common->rem_keys_from_array($data->js_files);
		$data->css_files = $this->common->rem_keys_from_array($data->css_files);
		
		$data->js = array_merge((array) $data->js_files, (array)$data->js);
		$data->css = array_merge((array) $data->css_files, (array)$data->css);

		$data->title = "System Settings";

		// Load view
		$this->common->view('common/crud', $data); 
	}
}

