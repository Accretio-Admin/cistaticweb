<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity_logs extends CI_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->model('Curl_model','curl');
		$this->load->library('session');
		$this->user = $this->session->userdata('user');
	    // $this->ip = $this->input->ip_address();
	     if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)){
            $IP = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
			$IP = $IP[0];
	   }else{
			$IP = $_SERVER['REMOTE_ADDR'];
		
		}
		
	    $this->ip = $IP;
	  	$this->load->model('Query_model');
	  	$this->load->model('Global_function','global_f');
	  	$this->load->model('Sp_model');
//update by nhez 03/21/2017	  	
	  	// $ACC_CONTROL = $this->Sp_model->userprivilege(); 
	   // 	$this->user['A_CTRL'] = $ACC_CONTROL['A_CTRL'];
	   // 	$this->session->set_userdata('user',$this->user);

	  	if ($this->user['RET'] == 1) {
	    	redirect('Main/');
	    }
	}

	public function index()
	{

		$data = array('menu' => 1,
					 'parent'=>'' );

		$url = url;
		$parameters = array(	
			'dev_id'    		    => $this->global_f->dev_id(),
			'regcode'               =>$this->user['R'],
			'actionId'				=>'new_login/get_history',
			'ip_address'			=>$this->ip,
			'username'					=>$this->user['U'],
			$this->user['SKT']	    => md5($this->user['R'].$this->user['SKT'])
    	);

		
		$data['results'] = json_decode($this->curl->call($parameters,$url),true);

		//var_dump($data['results']);die;
		//echo $data['results']['TDATA']['LP'];die;
		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;
			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('activitylogs/activity_logs'); 
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');	
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');

		}


	}
}