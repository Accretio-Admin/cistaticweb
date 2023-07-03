<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_Settlement extends CI_Controller {

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
	    $this->load->model('Query_model','q');
	  	$this->load->model('Report_model','r');
	  	$this->load->model('Global_function','global_f');
	  	$this->load->model('Sp_model');

	  	$ACC_CONTROL = $this->Sp_model->userprivilege(); 
	   	$this->user['A_CTRL'] = $ACC_CONTROL['A_CTRL'];
	   	$this->session->set_userdata('user',$this->user);

	   	if ($this->user['RET'] == 1) {
	    	redirect('Main/');
		}
		if($this->user['USER_KYC'] != 'APPROVED') {
			redirect('Main');
  		}
	}

	public function index()
	{
		
		$data = array('menu' => 20,
					 'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;
			$testaccount = substr($data['user']['R'],0,2);
			if($testaccount == 'UF'){
				$data['retailer'] = 1;
			}

			if (isset($_POST['btnAccountSettlement'])) {
				$amount = explode(" ", $this->input->post('as_amount'));

				$parameter =array(
							'dev_id'     		=> $this->global_f->dev_id(),
							'actionId'          => _confirm_unsettled_account, 
		    				'regcode'           => $this->user['R'],
		    				'trackno'           => $this->input->post('as_trackno'),
		    				'amount'         	=> $amount[1],
		    				'transpass'         => $this->input->post('as_transpass'),
							'ip_address'		=> $this->ip, 
	                $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($this->input->post('as_transpass')))
					    	); 

			    $result = $this->curl->call($parameter,url);
			   	$data['API'] = json_decode($result,true);
			}

			$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId'          => _account_settlement, 
	    				'regcode'           => $this->user['R'],
						'ip_address'		=> $this->ip, 
                $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
				    	); 
		    $result = $this->curl->call($parameter,url);
		   	$API = json_decode($result,true);

		   	if ($API['S'] == 1) {
		   		$data['URL_receipt'] = 'https://mobilereports.globalpinoyremittance.com/portal/insurance_voucher/';
	   			$data['results'] = $API;
		   	}

			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('myaccount/account_settlement'); 
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');	

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}

	}


	public function voucherlist()
	{
		$data = array('menu' => 20,
					 'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;
			$testaccount = substr($data['user']['R'],0,2);
			if($testaccount == 'UF'){
				$data['retailer'] = 1;
			}

				$parameter =array(
							'dev_id'     		=> $this->global_f->dev_id(),
							'actionId'          => _fetch_voucher_list, 
		    				'regcode'           => $this->user['R'],
							'ip_address'		=> $this->ip, 
	                $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
					    	); 
			    $result = $this->curl->call($parameter,url);
			   	$API = json_decode($result,true);

			   	if ($API['S'] == 1) {
		   			$data['results'] = $API;
			   	}

			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('myaccount/voucherlist'); 
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');	

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}

	}

}