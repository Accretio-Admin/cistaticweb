<?php if( ! defined('BASEPATH')) exit('No direct script access allow');

class Unified extends CI_Controller {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->view('layout/simple_header');
		date_default_timezone_set('Asia/Manila');
		//require_once(BASEPATH.'libraries/getbrowser'.EXT);
	}
	
	function index() { //Home redirect for anonymous user
		/*
		$browser = new Browser(); 
 		$Cbrow = $browser->getBrowser(); 
 		if($Cbrow == 'Internet Explorer') {

 			echo "<h1>Unsupported Browser. Please upgrade or use google chrome and mozilla firefox.</h1>"; exit;
 		}*/
 		// echo "System is currently on maintainance";
		$this->load->view('anonymous/home');
		$this->load->view('layout/simple_footer');
	}

	function home2() { //Home redirect for anonymous user
		/*
		$browser = new Browser(); 
 		$Cbrow = $browser->getBrowser(); 
 		if($Cbrow == 'Internet Explorer') {

 			echo "<h1>Unsupported Browser. Please upgrade or use google chrome and mozilla firefox.</h1>"; exit;
 		}*/
 		// echo "System is currently on maintainance";
		$this->load->view('anonymous/home2');
		$this->load->view('layout/simple_footer');
	}
	
	function products() { //Product redirect for anonymous user

 		// 	$this->load->model('query/advisory_model');
		// $data['events'] = $this->advisory_model->getAdvisory();

		$this->load->view('anonymous/products',$data);
		$this->load->view('layout/simple_footer');
	}
	
	function services() { //Services redirect for anonymous user
	
 	// 	$this->load->model('query/advisory_model');
		// $data['events'] = $this->advisory_model->getAdvisory();

		$this->load->view('anonymous/services',$data);
		$this->load->view('layout/simple_footer');
	}

	function activities() { //Activities redirect for anonymous user
		/*
		$browser = new Browser(); // Constructor
 		$Cbrow = $browser->getBrowser(); 
 		if($Cbrow == 'Internet Explorer') {

 			echo "<h1>Unsupported Browser. Please upgrade or use google chrome and mozilla firefox.</h1>"; exit;
 		} */
 		$this->load->model('Activities_model','activities_model');
 		$data['ncr'] = $this->activities_model->getNCR();
 		$data['luzon'] = $this->activities_model->getLUZON();
 		$data['visayas'] = $this->activities_model->getVISAYAS();
 		$data['mindanao'] = $this->activities_model->getMINDANAO();
 		$data['intl'] = $this->activities_model->getINTERNATIONAL();
 		$data['intl_office'] = $this->activities_model->getintl_office();
 		$data['loc_office'] = $this->activities_model->getloc_office();

		$this->load->view('anonymous/activities',$data);
		$this->load->view('layout/simple_footer');
	}

	function about() {     //About redirect for anonymous user
		/*
		$browser = new Browser(); // Constructor
 		$Cbrow = $browser->getBrowser(); 
 		if($Cbrow == 'Internet Explorer') {

 			echo "<h1>Unsupported Browser. Please upgrade or use google chrome and mozilla firefox.</h1>"; exit;
 		} */

		$this->load->view('anonymous/about');
		$this->load->view('layout/simple_footer');
	}	
	function contact() { //Contact us
		if (isset($_POST['submit_contact_form'])) {

			$null_inputs = array();
			foreach ($this->input->post(NULL,TRUE) as $inputs => $value) {
				if ($value == NULL || empty(trim($value))) {
					array_push($null_inputs, $inputs);
				}
			}
			if (count($null_inputs) > 1) {
				$data['output'] = array(
						'S' => 2,
						'M' => 'ALL FIELDS ARE REQUIRED'
					);
				$data['process'] = 0;
				goto view;
			}

			/*var_dump($inputs);
			die();*/

	        $config = array(
	            'protocol' => 'smtp',
	            'smtp_host' => 'mail.mygprs.ph',
	            'smtp_port' => 587,
	            // 'smtp_user' => 'jorel.dizon@mygprs.ph',
	            // 'smtp_pass' => '1qaz45',
	            'smtp_user' => 'no-reply@mygprs.ph', // change it to yours
	            'smtp_pass' => 'gprs123!@#!!!', // change it to yours
	            'mailtype' => 'html',
	            'charset' => 'iso-8859-1',
	            'wordwrap' => TRUE
	        );
	        $message = 'Subject: '.$this->input->post('subject').'<br>From: '.$this->input->post('name').'<br>Message: '.$this->input->post('message').'<br>Email: '.$this->input->post('email').'<br>Mobile: '.$this->input->post('mobile');
	        $this->load->library('email', $config);
	        $this->email->set_newline("\r\n");
	        $this->email->from('no-reply@mygprs.ph');
	        $this->email->to('customercare@mygprs.ph');
	        $this->email->subject('UPS Inquiry');
	        $this->email->message($message);
	        if ($this->email->send()) {
	        	$data['output'] = array('S' => 1, 'M' => 'SUCCESSFULLY SENT');
	        }else{
	        	$data['output'] = array('S' => 2, 'M' => 'OOPPPSS SOMETHING WENT WRONG, PLEASE TRY AGAIN');
	        }
		}

		view:
		$this->load->view('anonymous/contact',$data);
		$this->load->view('layout/user_footer');
	}
	function terms() {     //About redirect for anonymous user
		/*
		$browser = new Browser(); // Constructor
 		$Cbrow = $browser->getBrowser(); 
 		if($Cbrow == 'Internet Explorer') {

 			echo "<h1>Unsupported Browser. Please upgrade or use google chrome and mozilla firefox.</h1>"; exit;
 		} */

		$this->load->view('anonymous/terms');
		$this->load->view('layout/simple_footer');
	}
	function privacy_policy() {     //About redirect for anonymous user
		/*
		$browser = new Browser(); // Constructor
 		$Cbrow = $browser->getBrowser(); 
 		if($Cbrow == 'Internet Explorer') {

 			echo "<h1>Unsupported Browser. Please upgrade or use google chrome and mozilla firefox.</h1>"; exit;
 		} */

		$this->load->view('anonymous/privacy_policy');
		$this->load->view('layout/simple_footer');
	}
	function mlmShopHelp() {     //About redirect for anonymous user
		/*
		$browser = new Browser(); // Constructor
 		$Cbrow = $browser->getBrowser(); 
 		if($Cbrow == 'Internet Explorer') {

 			echo "<h1>Unsupported Browser. Please upgrade or use google chrome and mozilla firefox.</h1>"; exit;
 		} */

		$this->load->view('anonymous/mlmShopHelp');
		$this->load->view('layout/simple_footer');
	}
	function faq() {     //Faq's for anonymous user
		/*
		$browser = new Browser(); // Constructor
 		$Cbrow = $browser->getBrowser(); 
 		if($Cbrow == 'Internet Explorer') {

 			echo "<h1>Unsupported Browser. Please upgrade or use google chrome and mozilla firefox.</h1>"; exit;
 		} */

		$this->load->view('anonymous/faq');
		$this->load->view('layout/simple_footer');
	}
	function login() {
		/*
		$browser = new Browser(); // Constructor
 		$Cbrow = $browser->getBrowser(); 
 		if($Cbrow == 'Internet Explorer') {

 			echo "<h1>Unsupported Browser. Please upgrade or use google chrome and mozilla firefox.</h1>"; exit;
 		}*/

		$this->load->view('anonymous/login');
		$this->load->view('layout/simple_footer');
	}
 	function pagenotfound() { //Error 404
		/*
		$browser = new Browser(); // Constructor
 		$Cbrow = $browser->getBrowser(); 
 		if($Cbrow == 'Internet Explorer') {

 			echo "<h1>Unsupported Browser. Please upgrade or use google chrome and mozilla firefox.</h1>"; exit;
 		}*/
 		
		$this->load->view('error/404');
		$this->load->view('layout/simple_footer');
	}
	function detectip(){
	$this->load->view('anonymous/login2ip');
	}
	
}