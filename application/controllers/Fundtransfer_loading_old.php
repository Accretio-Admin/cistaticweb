<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fundtransfer_loading extends CI_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->model('curl_model','curl');
		$this->load->library('session');
		$this->user = $this->session->userdata('user');
		// $this->ip = $this->input->ip_address();
		$IP = $_SERVER['REMOTE_ADDR'];

        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
            $IP = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
        }

        $this->ip = $IP;
	  	$this->load->model('Query_model');
	  	$this->load->model('Global_function','global_f');
	}

	public function index()
	{
		$data = array('menu' => 7,
					 'parent'=>'LOADING' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;
			$this->load->view('loading/fundtransfer/index',$data);

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}	
	}
	public function load_wallet() 
	{
		if ($this->user['A_CTRL']['airtime_loading'] == 1){
		$data = array('menu' => 7,
					 'parent'=>'LOADING' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;

			if (null !==$this->input->post('btnSubmit')) //SEARCH FOR REGCODE
			{
				$INPUT_POST = $this->input->post(null,true);

					$url = url;
					$parameter =array(
								'dev_id'     			=> $this->global_f->dev_id(),
								'actionId'				=> _fetch_user_info,
								'ip_address' 			=> $this->ip,
			    				'regcode'               =>$this->user['R'],
			    				'receiver'              =>$INPUT_POST['inputRegcode'],
			    				 $this->user['SKT'] =>  md5($this->user['R'].$INPUT_POST['inputRegcode'].$this->user['SKT'])
						    	); 
				
				    $result = $this->curl->call($parameter,$url);
				   	$data['result'] = json_decode($result,true);
				   	
					if ($data['result']['S'] == 1) {
						$data['process'] = array(
									  'P' =>1,
									  'M' =>'SECOND'
									  );
						$data['input'] = array('regcode'	=>$INPUT_POST['inputRegcode'],
												'amount'	=>$INPUT_POST['inputAmount'],
												'tpass'		=>$INPUT_POST['inputTpass']
												);
					}else {
						$data['process'] = array(
									  'P' =>0,
									  'M' =>'FAILED'
								);
					}
					
			}else {
				$data['process'] = array(
	   									  'P' =>0,
	   									  'M' =>'FIRST'
										);

			}
			if (isset($_POST['btnConfirm'])) {  //SUBMIT IF SUCCESS 
				$INPUT_POST = $this->input->post(null,true);
				$url = url;
				$parameter =array(	
								'dev_id'    			=> $this->global_f->dev_id(),
								'actionId'				=> _universal_loading,
								'ip_address' 			=> $this->ip,
			    				'regcode'               =>$this->user['R'],
			    				'receiver'              =>$INPUT_POST['inputRegcode'],
			    				'amount'              	=>$INPUT_POST['inputAmount'],
			    				'transpass'             =>$INPUT_POST['inputTpass'],
			    				'ip'					=>$this->ip,
			    				 $this->user['SKT']	    =>  md5($this->user['R'].$this->user['SKT'].md5($INPUT_POST['inputTpass']))
						    	); 
	
			    $result = $this->curl->call($parameter,$url);
			   	$data['result'] = json_decode($result,true);
				
			 	   if ($data['result']['S']  == 1) {
					 	$this->user['PB'] = $data['result']['PB'];
						$data['user'] = $this->global_f->get_user_session();
					 } 

			}


			
			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('loading/fundtransfer/universal_load_wallet'); 
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');

		}
	}

	public function fund_transfer()
	{
		if ($this->user['A_CTRL']['airtime_loading'] == 1){
		$data = array('menu' => 7,
				     'parent'=>'LOADING' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;

			if (null !==$this->input->post('btnSubmit')) //SEARCH FOR REGCODE
			{
				$INPUT_POST = $this->input->post(null,true);
		
				$url = url;
				$parameter =array(
							'dev_id'     			=> $this->global_f->dev_id(),
							'actionId'				=> _fund_request,
							'ip_address' 			=> $this->ip,
		    				'regcode'               =>$this->user['R'],
		    				'mobileno'              =>$INPUT_POST['inputMobile'],
		    				'fundtype'              =>$INPUT_POST['selFund'],
		    				'deposittype'           =>$INPUT_POST['selDeposit'],
		    				'institution'           =>$INPUT_POST['inputBank'],
		    				'branchname'            =>$INPUT_POST['inputBranchName'],
		    				'amount'                =>$INPUT_POST['inputAmount'],
		    				'refno'              	=>$INPUT_POST['inputRef'],
		    				'datetime'              =>$INPUT_POST['inputDate'],
		    				'transpass'             =>$INPUT_POST['inputTpass'],
		    				 $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($INPUT_POST['inputTpass']))
					    	); 
			
			    $result = $this->curl->call($parameter,$url);
			   	$data['result'] = json_decode($result,true);
			

			   	
			}else {
				$data['process'] = array(
	   									  'process' =>0,
	   									  'M' =>'FIRST'
										);

			}
			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('loading/fundtransfer/fund_transfer'); 
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');		

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');

		}}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');

		}	
	}		

}