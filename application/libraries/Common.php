<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Common {

	/**
	 * Reference to the CodeIgniter instance
	 *
	 * @var object
	 */
	protected $CI;

	function __construct(){
		
        $CI =& get_instance();
        $CI->load->model('db_model');
        $configs = $CI->db_model->get_all('system_config', '*');
        $CI->config->load('systemconfig', TRUE);
		
        foreach ($configs[0] as $key => $value) {
        	$CI->config->set_item($key, $value);
        }

        $time_zone  = (string) $CI->config->item('time_zone');
        date_default_timezone_set($time_zone);
    }

	/**
	 * Set Layout
	 *
	 * @param      string  $view_name       View name
	 * @param      array  $resources   Page title, CSS, JS
	 */
	public function view($view_name, $resources){
		
		$CI =& get_instance();
		$data = (object) NULL;
		$data->css = array(
			base_url('assets/css/font-awesome.css'),
			base_url('assets/css/bootstrap.css'),
			base_url('assets/css/animate.css'),
			base_url('assets/css/waves.css'),
			base_url('assets/css/layout.css'),
			base_url('assets/css/components.css'),
			base_url('assets/css/plugins.css'),
			base_url('assets/css/common-styles.css'),
			base_url('assets/css/pages.css'),
			base_url('assets/css/responsive.css'),
			base_url('assets/css/matmix-iconfont.css'),
			'http://fonts.googleapis.com/css?family=Roboto:400,300,400italic,500,500italic',
			'http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600',
			base_url('assets/css/custom.css?v=1.6')

		);
		$data->js = array(
			base_url('assets/js/jquery-1.11.2.min.js'),
			base_url('assets/js/jquery-migrate-1.2.1.min.js'),
			base_url('assets/js/bootstrap.min.js'),
			base_url('assets/js/jRespond.min.js'),
			base_url('assets/js/nav-accordion.js'),
			base_url('assets/js/smart-resize.js'),
			base_url('assets/js/layout.init.js'),
		);

		$resources->css = array_merge($data->css, $resources->css);
		$resources->js = array_merge($data->js, $resources->js);
		
		$CI->load->view('common/header', $resources);
		$CI->load->view($view_name, $resources);
		$CI->load->view('common/footer', $resources);
	}

	/**
	 * Remove key from array
	 *
	 * @param      array  $array  The array
	 *
	 * @return     array  array without key
	 */
	function rem_keys_from_array($array){

		$new_array = array();

		foreach ($array as $key => $value) {
			array_push($new_array, $value);
		}
		return $new_array;
	}

	/**
	 * Get current user info
	 *
	 * @return     boolean  User info
	 */
	public function userinfo(){

		$CI =& get_instance();
    	if ($CI->session->userdata('authentication')) {
	    	$user_data = $CI->session->userdata('authentication');
	    	$user_data = (string) $user_data;
	    	$user_data = $CI->encrypt->decode($user_data);
	    	$userdata =  json_decode($user_data);
	    	return $userdata;
    	}else{
    		return false;
    	}
    }

    /*-----------------------------------------------------------------------------------------------------*/
	//get config file information
	/*-----------------------------------------------------------------------------------------------------*/
	    
    public function config_info($key = null){

    	$CI =& get_instance();

        $CI->config->load('systemconfig', TRUE);
        $webpage_config = $CI->config->item('systemconfig');

        if ($key == null) 
        {
	        return $webpage_config;
        } 
        else 
        {
        	return (isset($webpage_config[$key]))? $webpage_config[$key] : false;
        }
    }

    /**
	 * Sends a mail.
	 *
	 * @param      string   $to       To email
	 * @param      string   $subject  The subject
	 * @param      string   $body     The body
	 * @param      boolean  $bcc      The bcc
	 *
	 */
	public function sendMail($to, $subject, $body, $bcc = false){

		$CI =& get_instance();

		$config = array(
		    'protocol' => 'smtp',
		    'smtp_host' => $CI->config->item('smtp_host'),
		    'smtp_port' => $CI->config->item('smtp_port'),
		    'smtp_user' => $CI->config->item('smtp_user'),
		    'smtp_pass' => $CI->config->item('smtp_pass'),
		    'mailtype'  => 'html', 
		    'charset'   => 'utf-8'
		);

		$CI->load->library('email');
		$CI->email->initialize($config);
		$CI->email->set_mailtype("html");
		$CI->email->set_newline("\r\n");

		$CI->email->from($CI->config->item('smtp_user'), $CI->config->item('company_name'));
		$CI->email->to($to);
		$CI->email->reply_to($CI->config->item('contact_email'), $CI->config->item('company_name'));

		$CI->email->subject($subject);
		$CI->email->message($body);
		
		try {
			return $CI->email->send();
		} catch (Exception $e) {
			return $e;
		}
	}


	/**
	 * Generate passwords
	 *
	 * @param      integer  $length  Password length
	 *
	 * @return     string   The generated password
	 */
	public function generate_password($length = 8){
		
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    
	    return $randomString;
	}

	/**
	 * Sets the border color
	 *
	 * @param      integer  $income   The income
	 * @param      integer  $expense  The expense
	 *
	 * @return     integer  Percentage
	 */
	public function set_border_color($income=0){
		
		$CI =& get_instance();
		$goal = $this->userinfo()->goal;
		return ( $income / $goal ) * 100;
	}

	/**
	 * Check Authorized modules
	 *
	 * @param      string   $type   Authorization type
	 * @param      string   $table  The table name
	 * @param      string   $key    The relational key
	 *
	 * @return     boolean  returns true if authorized
	 */
	public function authorized($type="", $table="", $key=""){
		
		switch ($type) {
			case 'row':
			
				$CI =& get_instance();
				$CI->load->model('db_model');
				$state = $CI->uri->segment(3);
				$primary_key = $CI->uri->segment(4);
				$table = $table != "" ? $table : $CI->uri->segment(1);
				$key = $key != "" ? $key : 'user_id';

				if($primary_key != '' && ($state == 'edit' || $state == 'delete' || $state == 'read')){
					
					$check_owner = $CI->db_model->get_where($table, $key, array('id' => $primary_key, $key => $this->userinfo()->user_id));
					
					if($key != "user_id"){
						if($check_owner && $primary_key == $this->userinfo()->user_id){
							return true;
						}
					}else{
						if($check_owner){
							return true;
						}
					}
					
				}else{
					return true;
				}
				break;
			
			case 'admin':
				if($this->userinfo()->user_type == 1){
					return true;
				}
				break;

			default:
				break;
		}

		return false;
	}
}