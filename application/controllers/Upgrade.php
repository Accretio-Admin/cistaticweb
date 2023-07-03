<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upgrade extends CI_Controller {

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
	   
	   	// if($this->user['USER_KYC'] != 'APPROVED') {
		// 	redirect('Main');
		// }
	}
	
	public function index()
	{
		$data = array('menu' => 5,
					'parent'=>'MLM_UPGRADE' );
		
		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['mlm_user'] = $this->session->userdata('MLM_user');
			$data['user'] = $this->user;

			$testaccount = substr($data['user']['R'],0,2);
			if($testaccount == 'UF'){
				$data['retailer'] = 1;
			}

			$url = url;
			$parameter =array(
				'dev_id'     	=> $this->global_f->dev_id(),
				'regcode' 		=> $this->user['R'],
				'actionId' 		=> _upgrade_check_accountType,
				'ip_address' 	=> $this->ip,
				$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
			); 
			$result = $this->curl->call($parameter,$url);

			$API = json_decode($result,true);
			$data['ACCOUNT_TYPE'] = $API['D'][0]['account_type'];
			$data['ACCOUNT_FREE'] = $API['D'][0]['free'];

			if($data['ACCOUNT_TYPE'])
			{
				$params = array(
					'dev_id'     	=> $this->global_f->dev_id(),
					'regcode'		=> $this->user['R'],
					'account_type'	=> $data['ACCOUNT_TYPE'],
					'actionId' 		=> _upgrade_fetch_upgradeDetails,
					'ip_address' 	=> $this->ip,
					$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
				); 
				$response = $this->curl->call($params,$url);
				$API_RESPONSE = json_decode($response,true);
				$data['ACCOUNT_PRODUCTS'] = $API_RESPONSE;
			}
			
			if (null !==$this->input->post('btnSubmit'))
			{
				
				$INPUT_POST = $this->input->post(null,true);

			
				$captcha = $this->session->userdata('captcha');
				$total=$captcha['code1'] + $captcha['code2'];
				$sign_captcha = $this->input->post('inputCaptcha');
				
				$captcha_result = $this->global_f->captcha_validate($sign_captcha,$total);
				$this->session->unset_userdata('captcha');

				if ($captcha_result === 1 ) {
	
					$selCode = $this->input->post('selPackage');
					$account_free = $this->input->post('upgradeFee');
					$inputTpass = $this->input->post('inputTpass');

					$url = url;
					$params = array(
						'dev_id'     	=> $this->global_f->dev_id(),
						'actionId' 		=> _transact_upgrade,
						'regcode' 		=> $this->user['R'],
						'free'			=> 0,
						'upgrade_to'	=> $selCode,
						'transpass'		=> $inputTpass,
						'ip_address' 	=> $this->ip,
						$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
					); 
					
					$result1 = $this->curl->call($params,$url);
					$data['result_transact'] = json_decode($result1,true);

					$data['captcha'] = $this->global_f->captcha_code();
					if ($data['result']['PB']  != "") {
						$this->user['PB'] = $data['result']['PB'];
						$data['user'] = $this->global_f->get_user_session();
						} 

				}else{
					
						$data['captcha'] = $this->global_f->captcha_code();
						$data['result'] = array(	
											'S' => 0,
											'M' =>"Wrong Security Code!!"
											);
					}
			}else {
				$data['result'] = array(	
											'S' =>"",
											'M' =>""
											);
				$data['captcha'] = $this->global_f->captcha_code();

			}
				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('upgrade/upgrade'); 
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');	
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}

	}

	public function get_packagePrice()
	{

		$url = url;
		$selCode = $this->input->post('package_code');

		$parameter =array(
			'dev_id'     	=> $this->global_f->dev_id(),
			'regcode' 		=> $this->user['R'],
			'actionId' 		=> _upgrade_check_accountType,
			'ip_address' 	=> $this->ip,
			$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
		); 
		$result = $this->curl->call($parameter,$url);

		$API = json_decode($result,true);
		$data['ACCOUNT_TYPE'] = $API['D'][0]['account_type'];

		if($data['ACCOUNT_TYPE']){
			$params = array(
				'dev_id'     	=> $this->global_f->dev_id(),
				'regcode' 		=> $this->user['R'],
				'account_type'	=> $data['ACCOUNT_TYPE'],
				'package_code'	=> $selCode,
				'actionId' 		=> _upgrade_fetch_upgradePrice,
				'ip_address' 	=> $this->ip,
				$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
			); 
			$response = $this->curl->call($params,$url);
	
			$API_RESPONSE = json_decode($response,true);
			$data['PACKAGE_PRICE'] = $API_RESPONSE;

			echo json_encode($data['PACKAGE_PRICE']);
		}
	}

}