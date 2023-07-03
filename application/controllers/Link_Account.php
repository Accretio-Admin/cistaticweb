<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Link_Account extends CI_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	    $this->load->model('Curl_model','curl');
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
		if($this->user['USER_KYC'] != 'APPROVED') {
			redirect('Main');
  		}
	}

	public function index()
	{	

		$data = array('menu' => 21,
					 'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;

				$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId'         	=> _get_account_link, 
						'ip_address'		=> $this->ip, 
	    				'regcode'           => $this->user['R'],
	    				$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
				    	); 

			    $result = $this->curl->call($parameter,url);
			   	$API = json_decode($result,true);
			   	// print_r($API);
			   	if ($API['S']) {
		   			$data['results'] = $API;
			   	}
			   	else
			   	{
			   		$data['process'] = array ('M'=>'Please request a code to link this account.');
			   	}


			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('myaccount/link_account');
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');	

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
		
	}

}