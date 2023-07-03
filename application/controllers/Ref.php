<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
class Ref extends CI_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	    $this->load->model('Curl_model','curl');
		$this->load->model('Check_transaction', 'check_trans');
		$this->user = $this->session->userdata('user');

	  	if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER))
		{
            $IP = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
			$IP = $IP[0];
	   	}
		else
		{
			$IP = $_SERVER['REMOTE_ADDR'];
		}
		
	    $this->ip = $IP;
	    $this->load->model('Query_model');
	  	$this->load->model('Global_function','global_f');
	  	$this->load->model('Sp_model');
	}

	public function index($referral=""){

        $data['referral'] = $referral;
        $this->load->view('layout/header');
		$this->load->view('anonymous/redirect', $data); 
        $this->load->view('layout/footer');
	}

}

?>