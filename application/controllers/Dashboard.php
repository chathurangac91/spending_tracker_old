<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
		
		if ($this->common->userinfo()->logged_in){
        	$this->load->model('db_model');
        }
        else{
        	redirect(base_url('login'));
        }
		
	}

	public function index(){

		$data = (object)NULL;
		$data->js = array(
			base_url('assets/js/hoverintent.js'),
			base_url('assets/js/waves.js'),
			base_url('assets/js/switchery.js'),
			base_url('assets/js/jquery.loadmask.js'),
			base_url('assets/js/select2.js'),
			base_url('assets/js/icheck.js'),
			base_url('assets/js/bootstrap-filestyle.js'),
			base_url('assets/js/bootbox.js'),
			base_url('assets/js/animation.js'),
			base_url('assets/js/colorpicker.js'),
			base_url('assets/js/bootstrap-datepicker.js'),
			base_url('assets/js/sweetalert.js'),
			base_url('assets/js/moment.js'),
			base_url('assets/js/calendar/fullcalendar.js'),
			base_url('assets/js/chart/sparkline/jquery.sparkline.js'),
			base_url('assets/js/chart/easypie/jquery.easypiechart.min.js'),
			base_url('assets/js/chart/flot/excanvas.min.js'),
			base_url('assets/js/chart/flot/jquery.flot.min.js'),
			base_url('assets/js/chart/flot/jquery.flot.time.min.js'),
			base_url('assets/js/chart/flot/jquery.flot.stack.min.js'),
			base_url('assets/js/chart/flot/jquery.flot.axislabels.js'),
			base_url('assets/js/chart/flot/jquery.flot.resize.min.js'),
			base_url('assets/js/chart/flot/jquery.flot.tooltip.min.js'),
			base_url('assets/js/chart/flot/jquery.flot.spline.js'),
			base_url('assets/js/chart/flot/jquery.flot.pie.min.js'),
			base_url('assets/js/chart.init.js'),
			base_url('assets/js/matmix.init.js'),
			base_url('assets/js/retina.min.js'),
			base_url('assets/js/flipclock.min.js'),
			base_url('assets/js/custom/dashboard.js'),
		);

		$data->css = array(base_url('assets/css/flipclock.css'));
		$data->title = "Dashboard";

		$get_income = $this->db_model->get_where('transactions', 'amount', array('user_id' => $this->common->userinfo()->user_id,'type' => 1, 'date >=' => date('Y-m-1'), 'date <=' => date('Y-m-d')));
		$get_today_income = $this->db_model->get_where('transactions', 'amount', array('user_id' => $this->common->userinfo()->user_id,'type' => 1, 'date' => date('Y-m-d')));
		$get_expense = $this->db_model->get_where('transactions', 'amount', array('user_id' => $this->common->userinfo()->user_id,'type' => 2, 'date >=' => date('Y-m-1'), 'date <=' => date('Y-m-d')));

		$income = 0;
		$today_income = 0;
		$expense = 0;

		if($get_income){
			for ($i=0; $i < count($get_income); $i++) { 
				$income += $get_income[$i]['amount'];
			}
		}
		if($get_today_income){
			for ($i=0; $i < count($get_today_income); $i++) { 
				$today_income += $get_today_income[$i]['amount'];
			}
		}
		if($get_expense){
			for ($i=0; $i < count($get_expense); $i++) { 
				$expense += $get_expense[$i]['amount'];
			}
		}
		
		$data->income = $income;
		$data->today_income = $today_income;
		$data->expense = $expense;
		$data->balance = $income - $expense;
		$this->common->view('dashboard', $data); 
	}
}
