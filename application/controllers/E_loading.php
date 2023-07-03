<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class E_loading extends CI_Controller {

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
	   
	   	if($this->user['USER_KYC'] != 'APPROVED') {
			redirect('Main');
		}
	}

	public function index()
	{
		if ($this->user['A_CTRL']['airtime_loading'] == 1){

			$data = array('menu' => 5,
						 'parent'=>'LOADING' );

			$SKT = $this->input->post($T_VALUE);
			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['mlm_user'] = $this->session->userdata('MLM_user');
				$data['user'] = $this->user;
				
				$testaccount = substr($data['user']['R'],0,2);
				if($testaccount == 'UF'){
					$data['retailer'] = 1;
				}

				$this->load->view('loading/e_loading/index',$data);
			}else {
				//$this->session->unset_userdata('user');
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
			//$this->session->unset_userdata('user');
			//$this->session->sess_destroy();
			redirect('Main/');
		}
		
	}
	
	public function regular_load()
	{
		if ($this->user['A_CTRL']['airtime_loading'] == 1){

		$data = array('menu' => 5,
					 'parent'=>'LOADING' );
		
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
					'actionId' 		=> _fetch_loading_status,
					'ip_address' 	=> $this->ip,
					 $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
		    	); 
			    $result = $this->curl->call($parameter,$url);
			   	$API = json_decode($result,true);
			    $data['API'] = $API['P_DATA'];
				if (null !==$this->input->post('btnSubmit'))
				{
					
					$INPUT_POST = $this->input->post(null,true);

				
					$captcha = $this->session->userdata('captcha');
					$total=$captcha['code1'] + $captcha['code2'];
					$sign_captcha = $this->input->post('inputCaptcha');
					
					$captcha_result = $this->global_f->captcha_validate($sign_captcha,$total);
					$this->session->unset_userdata('captcha');

					if ($captcha_result === 1 ) {
		
						$url = url;
						$parameter =array(
									'dev_id'     			=> $this->global_f->dev_id(),
									'actionId'				=> _rsloading,
				    				'regcode'               => $this->user['R'],
				    				'mobile'                => $INPUT_POST['inputRMobile'],
				    				'plancode'              => $INPUT_POST['inputAmount'],
				    				'transpass'             => $INPUT_POST['inputTpass'],
				    				'ip_address'           	=> $this->ip,
				    				'telco'           		=> $INPUT_POST['selNetwork'],
				    				 $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($INPUT_POST['inputTpass']))
							    	); 
					
					    $result = $this->curl->call($parameter,$url);
					   	$data['result'] = json_decode($result,true);
					   	
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
					$this->load->view('loading/e_loading/regular_load'); 
					$this->load->view('element/wrapper_footer');
					$this->load->view('layout/footer');	
			}else {
				//$this->session->unset_userdata('user');
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
			//$this->session->unset_userdata('user');
			//$this->session->sess_destroy();
			redirect('Main/');
		}

	}

	public function smart_load()
	{
		$data = array('menu' => 5, 'parent'=>'LOADING' );
		
		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			
			$data['user'] = $this->user;

			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('loading/e_loading/smart_load'); 
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');	

		} else {
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}

	public function smartList(){
		$data['user'] = $this->user;

		$parameter =array(	
			'dev_id'    		    => $this->global_f->dev_id(),
			'actionId'				=> _getSmartList,
			'ip_address'           	=> $this->ip,
			'regcode'    			=> $this->user['R'],
			$this->user['SKT']	    =>  md5($this->user['R'].$this->user['SKT'])
		); 
		
		$result = $this->curl->call($parameter,url);
		$result = json_decode($result,true);
		echo json_encode($result);

	}

	public function smartListandImages(){
		$data['user'] = $this->user;

		$parameter =array(	
			'dev_id'    		    => $this->global_f->dev_id(),
			'actionId'				=> _createSmartListandImages,
			'ip_address'           	=> $this->ip,
			'regcode'    			=> $this->user['R'],
			$this->user['SKT']	    =>  md5($this->user['R'].$this->user['SKT'])
		); 
		
		$result = $this->curl->call($parameter,url);
		$result = json_decode($result,true);
		echo json_encode($result);

	}

	public function smartInsert(){

        $SKU = $this->input->post('sku');
        $DENOM = $this->input->post('denom');
        $RNAME = $this->input->post('recipientName');
        $REMAIL = $this->input->post('recipientEmail');
        $RMOBILE = $this->input->post('recipientMobile');
		$TPASS = $this->input->post('tpass');
		
		$data['user'] = $this->user;
		$parameter =array(	
			'dev_id'    		    => $this->global_f->dev_id(),
			'actionId'				=> _createSmartList,
			'ip_address'           	=> $this->ip,
			'regcode'    			=> $this->user['R'],
			'sku'					=> $SKU,
			'denom'					=> $DENOM,
			'recipientName'			=> $RNAME,
			'recipientEmail'		=> $REMAIL,
			'recipientMobile'		=> $RMOBILE,
			'transpass'				=> md5($TPASS),
			$this->user['SKT']	    => md5($this->user['R'].$this->user['SKT'])
		); 

		$result = $this->curl->call($parameter,url);
		$result = json_decode($result,true);
		echo json_encode($result);
	}

	public function special_load()
	{
		if ($this->user['A_CTRL']['airtime_loading'] == 1){

		$data = array('menu' => 5,
					 'parent'=>'LOADING' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['mlm_user'] = $this->session->userdata('MLM_user');
				$data['user'] = $this->user;

				$testaccount = substr($data['user']['R'],0,2);
				if($testaccount == 'UF'){
					$data['retailer'] = 1;
				}

				$url = url;
				$parameter =array(
					'dev_id'     => $this->global_f->dev_id(),
					'regcode' 	 => $this->user['R'],
					'actionId' 	 => _fetch_loading_status,
					'ip_address' => $this->ip,
					 $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
		    	); 
			    $result = $this->curl->call($parameter,$url);

			   	$API = json_decode($result,true);
			    $data['API'] = $API['P_DATA'];


			    $url = url;
				$parameter =array(
							'dev_id'     => $this->global_f->dev_id(),
							'actionId'   => _fetch_special_plancodes,
							'ip_address' => $this->ip,
		    				'regcode'    => $this->user['R'],
		    				 $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
					    	); 
			    $result = $this->curl->call($parameter,$url);
			   	$API = json_decode($result,true);
			   	$data['smart'] = array(); 
			   	$data['globe'] = array(); 
			   	$data['sun'] = array(); 
				$data['dito'] = array(); 
				$data['pldt'] = array(); 
				    for ($i=0; $i < count($API['P_DATA']); $i++) { 
				   		if ($API['P_DATA'][$i]['telco'] == 1) {
				   			array_push($data['smart'], $API['P_DATA'][$i]);
				   		}elseif ($API['P_DATA'][$i]['telco'] == 2) {
				   			array_push($data['globe'], $API['P_DATA'][$i]);
				   		}
				   		elseif ($API['P_DATA'][$i]['telco'] == 3) {
				   			array_push($data['sun'], $API['P_DATA'][$i]);
				   		}
						elseif ($API['P_DATA'][$i]['telco'] == 4) {
				   			array_push($data['pldt'], $API['P_DATA'][$i]);
				   		}
						elseif ($API['P_DATA'][$i]['telco'] == 5) {
				   			array_push($data['dito'], $API['P_DATA'][$i]);
				   		}
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
						$url = url;
						$parameter =array(	
									'dev_id'    		    => $this->global_f->dev_id(),
									'actionId'				=> _rsloading,
									'ip_address'           	=> $this->ip,
				    				'regcode'               => $this->user['R'],
				    				'mobile'                => $INPUT_POST['inputRMobile'],
				    				'plancode'              => $INPUT_POST['selDenomination'],
				    				'transpass'             => $INPUT_POST['inputTpass'],
				    				'telco'           		=> $INPUT_POST['selNetwork'],
				    				 $this->user['SKT']	    =>  md5($this->user['R'].$this->user['SKT'].md5($INPUT_POST['inputTpass']))
					    	); 
					
					    $result = $this->curl->call($parameter,$url);
					   	$data['result'] = json_decode($result,true);
					   	
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
					$this->load->view('loading/e_loading/special_load'); 
					$this->load->view('element/wrapper_footer');
					$this->load->view('layout/footer');	
			}else {
				//$this->session->unset_userdata('user');
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
			//$this->session->unset_userdata('user');
			//$this->session->sess_destroy();
			redirect('Main/');
		}
	}

	public function prepaid_card()
	{
		if ($this->user['A_CTRL']['airtime_loading'] == 1){
		$data = array('menu' => 5,
					 'parent'=>'LOADING' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['mlm_user'] = $this->session->userdata('MLM_user');
				$data['user'] = $this->user;

				$testaccount = substr($data['user']['R'],0,2);
				if($testaccount == 'UF'){
					$data['retailer'] = 1;
				}
				
				$url = url;
				$parameter =array(
							'dev_id'     		=> $this->global_f->dev_id(),
							'actionId' 			=> _fetch_prepaid_card,
							'ip_address' 		=> $this->ip,
		    				'regcode'           =>	$this->user['R'],
		    				 $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
					    	); 
			    $result = $this->curl->call($parameter,$url);
			   	$API = json_decode($result,true);
			  	$data['gamecard'] = array(); 
			   	$data['callcard'] = array(); 
			   	$data['other'] = array(); 
				    for ($i=0; $i < count($API['P_DATA']); $i++) { 
				   		if ($API['P_DATA'][$i]['category'] == 3) {
				   			array_push($data['gamecard'], $API['P_DATA'][$i]);
				   		}elseif ($API['P_DATA'][$i]['category'] == 4) {
				   			array_push($data['callcard'], $API['P_DATA'][$i]);
				   		}
				   		elseif ($API['P_DATA'][$i]['category'] == 5) {
				   			array_push($data['other'], $API['P_DATA'][$i]);
				   		}

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
						$url = url;
						$parameter =array(	
									'dev_id'    		    => $this->global_f->dev_id(),
									'actionId'				=> _lccard_loading,
									'ip_address'           	=> $this->ip,
				    				'regcode'               =>$this->user['R'],
				    				'mobile'                =>$INPUT_POST['inputRMobile'],
				    				'syscode'               =>$INPUT_POST['selDenomination'],
				    				'transpass'             =>$INPUT_POST['inputTpass'],
				    				 $this->user['SKT']	    =>  md5($this->user['R'].$this->user['SKT'].md5($INPUT_POST['inputTpass']))
							    	); 
					
					    $result = $this->curl->call($parameter,$url);
					   	$data['result'] = json_decode($result,true);
					   
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
				$this->load->view('loading/e_loading/prepaid_card'); 
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');	
			}else {
				//$this->session->unset_userdata('user');
				$this->session->sess_destroy();
				redirect('Login/');
			}
		}else {
			//$this->session->unset_userdata('user');
			//$this->session->sess_destroy();
			redirect('Main/');
		}
	}


}