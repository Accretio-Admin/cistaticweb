<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->user = $this->session->userdata('user');
	    $this->load->model('Global_function','global_f');
	    $this->load->model('Curl_model','curl');

	   if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)){
            $IP = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
			$IP = $IP[0];
	   }else{
			$IP = $_SERVER['REMOTE_ADDR'];
		
		}
		
	    $this->ip = $IP;
	  	$this->load->model('Sp_model');
//update by nhez 03/21/2017
	  	// $ACC_CONTROL = $this->Sp_model->userprivilege(); 
	   // 	$this->user['A_CTRL'] = $ACC_CONTROL['A_CTRL'];
	   // 	$this->session->set_userdata('user',$this->user);
	}


	public function index()
	{	
		if ($this->user['S'] == 1 && $this->user['R'] !=""){
		$data['user'] = $this->user;

		$this->load->view('layout/header',$data);
		$this->load->view('element/top_header');
		$this->load->view('element/wrapper_header');
		$this->load->view('element/left_panel');
		$this->load->view('faq/index'); 
		$this->load->view('element/wrapper_footer');
		$this->load->view('layout/footer');

		}else {
			$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}

	}

}