<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

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
	public function __construct(){

        parent::__construct();
        $this->load->model('login_model');
    }

    /**
     * Admin login
     */
    public function index(){

		// xss_clean
		$cleaned_post_data = $this->security->xss_clean($this->input->post());

		// Set validation rules
		$this->form_validation->set_rules('inputEmail', 'Email Address', 'trim|required|max_length[45]|valid_email');
		$this->form_validation->set_rules('inputPassword', 'Password', 'trim|required|max_length[16]');

		$data = (object) NULL;

		if($this->form_validation->run() == FALSE){
			$this->load->view('login', $data);
		}
		else{

			$inputEmail = $_POST['inputEmail'];
			$inputPassword = sha1(md5($_POST['inputPassword']));

			// Check logins in DB
			$db_params = array(
				'email' 	=> $inputEmail,
				'password' 	=> $inputPassword
			);

			$check_login = $this->login_model->check_login($db_params);

			if ($check_login) {

				if ($check_login[0]->is_active == 1) {

					$user_data = array(
						'user_id' => $check_login[0]->id,
						'user_type' => $check_login[0]->type,
						'first_name' => $check_login[0]->first_name,
						'last_name' => $check_login[0]->last_name,
						'email' => $check_login[0]->email,
						'goal' => $check_login[0]->goal,
						'currencry_code' => $check_login[0]->currencry_code,
						'remember'	=> isset($_POST['remember']) ? TRUE : FALSE,
						'logged_in' => TRUE,
						'pw_changed' => $check_login[0]->pw_changed
					);

					//encode string
					$user_data = json_encode($user_data);

					//encript json string
					$user_data = $this->encrypt->encode($user_data);

					//change session id
					session_regenerate_id();

					//set session
					$this->session->set_userdata('authentication', $user_data);

					redirect(base_url());
				}
				else{
					$data->error = "Account is deactivated !";
					$this->load->view('login', $data);
				}
			}
			else{
				$data->error = "Invalid Email or Password";
				$this->load->view('login', $data);
			}
		}
    }

    /**
	 * Send reset password request
	 */
	public function forgot_password(){

		if ($this->input->post('reset_email')) {

			$this->form_validation->set_rules('reset_email', 'Email', 'trim|required|max_length[60]|valid_email');

			if($this->form_validation->run() == FALSE){
				
				$json_para = array(
					'error' 		=> true,
					'email_error' 	=> form_error('reset_email'),
				);
				echo json_encode($json_para);
			}
			else{

				// Check user
				$db_params = array(
					'select'	=> 'user_id',
					'table'		=> 'users',
					'where'		=> array('user_email' => $this->input->post('reset_email'))
				);
				$check_user = $this->login_model->select($db_params);

				if ($check_user) {

					$user = $check_user[0]->user_id;
					$email = $this->input->post('reset_email');
					$password = $this->common->generate_password();

					$db_params = array(
		                'table' 	=> 'users',
		                'keys' 		=> array('user_id' => $user),
		                'values'	=> array(
							'user_password' 	=> sha1(md5($password)),
							'pw_changed' 		=> 2,
							'modified_datetime'	=> date('Y-m-d H:i:s')
						)
		            );
					$update_user = $this->login_model->update($db_params);

					// Generate mail
					if ($update_user) {

						$data = (object) NULL;
						$data->company = $this->config->item('company_name');
						$data->user_name = $email;
						$data->password = $password;
						$body = $this->load->view('email_templates/temporary_pw', $data, true);

						$sent_email = $this->common->sendMail($email, $this->config->item('company_name').' Temporary Password', $body);
						
						if ($sent_email) {
							$json_para = array(
								'error'			=> false,
								'email_error' 	=> '',
							);
							echo json_encode($json_para);
						}
						else{
							$json_para = array(
								'error' 		=> true,
								'email_error' 	=> '<p>Something went wrong. Please try again !</p>',
							);
							echo json_encode($json_para);
						}
					}
					else{
						$json_para = array(
							'error' 		=> true,
							'email_error' 	=> '<p>Something went wrong. Please try again !</p>',
						);
						echo json_encode($json_para);
					}
				}
				else{
					$json_para = array(
						'error' 		=> true,
						'email_error' 	=> '<p>This email doesn\'t exist on our system !</p>',
					);
					echo json_encode($json_para);
				}
			}
		}
		else{
			$json_para = array(
				'error' 		=> true,
				'email_error' 	=> '<p>Something went wrong. Please try again !</p>',
			);
			echo json_encode($json_para);
		}
	}

	/**
	 * Logout
	 */
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}
