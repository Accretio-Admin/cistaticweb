<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ecash_send_original extends CI_Controller {

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

	  	if($this->user['USER_KYC'] != 'APPROVED') {
		  	redirect('Main');
		}

		// if ($this->user['RET'] == 1) {
	 //    	redirect('Main/');
	 //    }
	}

	public function index()
	{	
		if ($this->user['A_CTRL']['remittance'] == 1 && $this->user['R'] != 'G5457340'){

		$data = array('menu' => 2,
					'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;

				$this->load->view('remittance/ecash_send/index',$data);
			}else {
				//$this->session->unset_userdata('user');
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
			//$this->session->unset_userdata('user');
			redirect('Main/');
		}
		
	}


	public function loadfund()
	{
		if ($this->user['A_CTRL']['remittance'] == 1 && $this->user['A_CTRL']['remittance_eclf_send'] == 1){

		$data = array('menu' => 2,
					  'parent'=>'REMITTANCE' );
		
		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;

				if (isset($_POST['btnSubmit'])) {
					$url = url;

					$parameter =array(
								'dev_id'    	   => $this->global_f->dev_id(),
								'actionId' 		   => _loadfund,
			    				'regcode'          =>$this->user['R'],
			    				'transpass'	       =>$this->input->post('inputTpass'),
			    				'amount'	       =>$this->input->post('inputAmountTransaction'),
			    				'ip_address'       =>$this->ip,
			    				$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
						    	); 
				    $result = $this->curl->call($parameter,$url);
				    $data['API'] = json_decode($result,true);
				    
				    // print_r($data['API']);

					if ($data['API']['S']  == 1) {
					 	$this->user['PB'] = $data['API']['PB'];
					 	$this->user['EC'] = $data['API']['EC'];
					 	$this->user['SB'] = $data['API']['SB'];
						$data['user'] = $this->global_f->get_user_session();
					 } 
				    
				 
				}
			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('remittance/ecash_send/ecash_to_loadfund');
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



		public function sgdfund()
	{
		if ($this->user['A_CTRL']['remittance'] == 1 && $this->user['A_CTRL']['remittance_ecsg_send'] == 1){

		$data = array('menu' => 2,
					  'parent'=>'REMITTANCE' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;

			if (isset($_POST['btnSubmit'])) {
					$url = url;
					
					$parameter =array(
								'dev_id'     => $this->global_f->dev_id(),
								'actionId' 	 => _sgdfund,
			    				'regcode'    =>$this->user['R'],
			    				'transpass'	 =>$this->input->post('inputTpass'),
			    				'amount'	 =>$this->input->post('inputAmountTransaction'),
			    				'ip_address' =>$this->ip,
			    				$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
						    	); 
				    $result = $this->curl->call($parameter,$url);
				    $data['API'] = json_decode($result,true);


				    if ($data['API']['S']  == 1) {
					 	
					 	$this->user['SB'] = $data['API']['SB'];
						$data['user'] = $this->global_f->get_user_session();
					 } 
				 
				}
				
			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('remittance/ecash_send/ecash_to_sgdfund');
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

	public function ecashtoforex()
	{
		if ($this->user['A_CTRL']['remittance'] == 1){

		$data = array('menu' => 2,
					  'parent'=>'REMITTANCE' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;

				// $parameter =array(
				// 		'dev_id'     		=> $this->global_f->dev_id(),
				// 		'actionId'         	=> _get_foreign_exchange_rate, 
				// 		'ip_address'		=> $this->ip, 
	   //  				'regcode'           => $this->user['R'],
	   //  				$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
				//     	); 

			 //    $result = $this->curl->call($parameter,url);
			 //   	$API = json_decode($result,true);

			 //   	// print_r($API);
			 //   	if ($API['S'] === 0)
			 //   	{
				// 	$data['process'] = array ('P'=>1,
				// 							  'S'=>0,
				// 							  'M'=>$API['M']);
			 //   	}
			 //   	else
			 //   	{
				// 	$data['process'] = array ('P'=>1,
				// 							  'S'=>1,
				// 							  'M'=>$API['M']);
				// 	$data['API'] = $API;
			 //   	}

			if (isset($_POST['btnSubmit'])) {
					$url = url;
					
					$parameter =array(
								'dev_id'     => $this->global_f->dev_id(),
								'actionId' 	 => _ecash_to_forextrade_confirm_new,
			    				'regcode'    =>$this->user['R'],
			    				'transpass'	 =>$this->input->post('inputTpass'),
			    				'amount'	 =>$this->input->post('inputAmountTransaction'),
			    				'currency'	 =>$this->input->post('currtype'),
			    				'ip_address' =>$this->ip,
			    				$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
						    	); 
				    $result = $this->curl->call($parameter,$url);
				    $data['API'] = json_decode($result,true);

				    if ($data['API']['S']  == 1) {
					 	
					 	if($data['API']['C'] == 'SGD')
					 	{
					 		$this->user['SB'] = $data['API']['FA'];
					 	}
					 	elseif($data['API']['C'] == 'AED')
					 	{
					 		$this->user['AB'] = $data['API']['FA'];
					 	}
					 	elseif($data['API']['C'] == 'HKD')
					 	{
					 		$this->user['HKD'] = $data['API']['FA'];
					 	}
				 		else
				 		{
				 			$this->user['QB'] = $data['API']['FA'];
				 		}
					 	
					 	$this->user['EC'] = $data['API']['EC'];

						$data['user'] = $this->global_f->get_user_session();
					 } 
				 
				}


			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('remittance/ecash_send/ecash_to_forex');
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

		public function forexrate()
	{
		if ($this->user['A_CTRL']['remittance'] == 1){

		$data = array('menu' => 2,
					  'parent'=>'REMITTANCE' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;

				$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId'         	=> _get_foreign_exchange_rate, 
						'ip_address'		=> $this->ip, 
	    				'regcode'           => $this->user['R'],
	    				$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
				    	); 

			    $result = $this->curl->call($parameter,url);
			   	$API = json_decode($result,true);

			   	
			   	if ($API['S'] === 0)
			   	{
					$data['process'] = array ('P'=>1,
											  'S'=>0,
											  'M'=>$API['M']);
			   	}
			   	else
			   	{
					$data['process'] = array ('P'=>1,
											  'S'=>1,
											  'M'=>$API['M']);
					$data['API'] = $API;
			   	}


			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('remittance/ecash_send/forex_rate');
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


		public function fetch_currencies(){

				$data['user'] = $this->user;


				$parameter =array(
				'dev_id'     		=> $this->global_f->dev_id(),
				'actionId'         	=> _get_foreign_exchange_rate, 
				'ip_address'		=> $this->ip, 
				'regcode'           => $this->user['R'],
				$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
		    	); 

			    $result = $this->curl->call($parameter,url);
			   	$result = json_decode($result);
			   	echo json_encode($result);
	}

		public function check_balanceafter(){



				$CURRTYPE = $this->input->post('currtype');
				$AMOUNT = $this->input->post('inputAmountTransaction');
				
				$data['user'] = $this->user;

				$parameter =array(
				'dev_id'     		=> $this->global_f->dev_id(),
				'actionId'         	=> _ecash_to_forextrade, 
				'ip_address'		=> $this->ip, 
				'regcode'           => $this->user['R'],
				'amount'           => $AMOUNT,
				'currency'           => $CURRTYPE,
				$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
		    	); 

			    $result = $this->curl->call($parameter,url);
			   	$result = json_decode($result);
			   	echo json_encode($result);
	}

	public function check_balanceafter_new(){
		$CURRTYPE = $this->input->post('currtype');
		$AMOUNT = $this->input->post('inputAmountTransaction');
		
		$data['user'] = $this->user;

		$parameter =array(
		'dev_id'     		=> $this->global_f->dev_id(),
		'actionId'         	=> _ecash_to_forextrade_new, 
		'ip_address'		=> $this->ip, 
		'regcode'           => $this->user['R'],
		'amount'           => $AMOUNT,
		'currency'           => $CURRTYPE,
		$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
    	); 

	    $result = $this->curl->call($parameter,url);
	   	$result = json_decode($result);
	   	echo json_encode($result);
	}

		public function ecashtoecash()
	{
	
		if ($this->user['A_CTRL']['remittance'] == 1 && $this->user['A_CTRL']['remittance_ecash_send'] == 1){

		$data = array('menu' => 2,
					  'parent'=>'REMITTANCE' );
			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;

				if (isset($_POST['btnSubmit'])) {
						$url = url;
						$parameter =array(
									'dev_id'   		    => $this->global_f->dev_id(),
									'actionId' 	 		=> _ecashtoecash,
				    				'regcode'   	 	=>$this->user['R'],
				    				'client_regcode' 	=>$this->input->post('inputDealersRegcode'),
				    				'transpass'	 	 	=>$this->input->post('inputTpass'),
				    				'amount'	 		=>$this->input->post('inputAmountTransaction'),
				    				'ip_address'    	=>$this->ip,
				    				$this->user['SKT']  => md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
							    	); 

					    $result = $this->curl->call($parameter,$url);
					    $data['API'] = json_decode($result,true);
					   
						if ($data['API']['S']  == 1) {
						
						 	$this->user['EC'] = $data['API']['EC'];
						 
							$data['user'] = $this->global_f->get_user_session();
						 } 
					 
				}
			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('remittance/ecash_send/ecash_to_ecash');
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


	public function smartmoney_index()
	{	
		if ($this->user['A_CTRL']['remittance'] == 1 && $this->user['R'] != 'G5457340'){

		$data = array('menu' => 2,
					'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;

			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('remittance/ecash_send/smartmoney_main_panel');
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');	

			}else {
				//$this->session->unset_userdata('user');
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
			//$this->session->unset_userdata('user');
			redirect('Main/');
		}
		
	}

	public function smartmoney_checkref()
	{
		if ($this->user['A_CTRL']['remittance'] == 1){

		$data = array('menu' => 2,
					  'parent'=>'REMITTANCE' );
		
		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;
			$data['process'] = 0; 

				if (isset($_POST['btnSubmit'])) {
					$url = url;
					$parameter =array(
								'dev_id'    	   => $this->global_f->dev_id(),
								'actionId' 		   => _remittance_send_smartmoney_checkref,
			    				'regcode'          =>$this->user['R'],
			    				'trackingno'	   =>$this->input->post('inputTransactionNo'),
			    				'ip_address'       =>$this->ip
						    	); 
				    $result = $this->curl->call($parameter,$url);
				    $data['result'] = json_decode($result,true);	

				    if ($data['result']['S'] == 25){  
			    		$data['result'] = array(
			    				'S'  => 25,
			    				'M'  => $data['result']['M'],
			    				'TN' => $this->input->post('inputTransactionNo')
			    			);
						$data['process'] = 1; 
				    }elseif ($data['result']['S'] == 1) {
			    		$data['result'] = array(
			    				'S'  => 1,
			    				'M'  => $data['result']['M'],
			    				'RF' => $data['result']['RF'],
			    				'URL' => $data['result']['URL']
			    			);
				    }else{
			    		$data['result'] = array(
			    				'S'  => 0,
			    				'M'  => $data['result']['M']
			    			);
				    }

				}elseif (isset($_POST['btnConfirmActivation'])) {
	 				$INPUT_POST = $this->input->post(null,true);
	 				$url = url;
					$parameter =array(
									'dev_id'    	    => $this->global_f->dev_id(),
									'actionId' 	 		=> _remittance_send_smartmoney_confirm_activation,
									'ip_address'	    =>$this->ip,
				    				'regcode'   		=>$this->user['R'],
				    				'trackno'			=>$INPUT_POST['transactionno'],
				    				'vericode'			=>$INPUT_POST['verification_code'],
				    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'])
			    				    );
					 	$result = $this->curl->call($parameter,$url);
						$data['result'] = json_decode($result,true);

					if ($data['result']['S'] == 1) {
							$this->user['EC'] = $data['result']['EC'];						 
							$data['user'] = $this->global_f->get_user_session();
							$data['result'] = array(
							    				'S'  => 1,
							    				'M'  => $data['result']['M'],
							    				'TN' => $data['result']['TN'],
							    				'RF' => $data['result']['RF'],
							    				'URL' => $data['result']['URL']
				    							);
					}elseif ($data['result']['S'] == 2) {
							$data['result'] = array(
							    				'S'  => 2,
							    				'M'  => $data['result']['M'],
							    				'TN' => $data['result']['TN']
				    							);
					}else {
				    		$data['result'] = array(
							    				'S'  => 0,
							    				'M'  => $data['result']['M'],
							    				'TN' => $INPUT_POST['transactionno']
			    								);
				    		$data['process'] = 1;
				   	}
 			}

			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('remittance/ecash_send/smartmoney_checkref');
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

	function otp_smartmoney_resend()
	{
		if (isset($_POST['trackno'])){
			$url = url;
			$parameter = array( 'dev_id'     		=>$this->global_f->dev_id(),
		    				 	'ip_address' 		=>$this->ip,
		    					 'actionId' 	 	=> _smartmoney_otp_resend,
    							 'regcode'   	 	=>$this->user['R'],
		    					 'trackno'    		=>$_POST['trackno'],
		    					 $this->user['SKT']	 =>md5($this->user['R'].$this->user['SKT'])
			    				  );
		    $result = $this->curl->call($parameter,$url);
		    $API = json_decode($result,true);
			$result = array(
							'S' => $API['S'],
							'M' => $API['M']
							);
			
		 }else{
			$result = array('S' => 0, 'M' => 'Invalid input');
		}

		echo json_encode($result);
	}


		public function ecashtosmartmoney()
	{
		if ($this->user['A_CTRL']['remittance'] == 1 && $this->user['A_CTRL']['remittance_smartmoney_send'] == 1){

		$data = array('menu' => 2,
					  'parent'=>'REMITTANCE' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;
			
			$url = url;
			$parameter =array(
				'dev_id'     	=> $this->global_f->dev_id(),
				'regcode' 		=> $this->user['R'],
				'actionId' 		=> _fetch_smartmoney_status,
				'ip_address' 	=> $this->ip,
				 $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
	    	); 
		    $result = $this->curl->call($parameter,$url);
		   	$API = json_decode($result,true);
		    $data['API'] = $API['P_DATA'];

		    // print_r($data['API']);

			if (isset($_POST['btnSsearch'])) //Search Sender
			{
 				$search = $this->input->post('inputSearch');
 				$url = url;
				$parameter =array(
							'dev_id'    	    => $this->global_f->dev_id(),
							'actionId' 	 		=> _remittance_search,
							'ip_address'	    =>$this->ip,
		    				'search_key'   	 	=>$search,
		    				'regcode' 			=>$this->user['R']
		    				); 

			    $result = $this->curl->call($parameter,$url);
				$data['row'] = json_decode($result,true);

				if ($data['row']['S']==1) {
					$data['type'] = array('typeid'=>1,
										 'typedesc'=>'Sender');
				}
				
 			}
 			elseif (isset($_POST['btnBsearch']))  //Search Beneficiary
 			{
 				$search = $this->input->post('inputSearch');
 				$url = url;
				$parameter =array(
							'dev_id'     		=> $this->global_f->dev_id(),
							'actionId' 	 		=> _remittance_search,
							'ip_address'	    =>$this->ip,
		    				'search_key'   	 	=>$search,
		    				'regcode' 			=>$this->user['R']
		    				); 

			    $result = $this->curl->call($parameter,$url);
				$data['row'] = json_decode($result,true);

				$senderinfo = explode("|", $this->input->post('inputSenderHide'));

			
				$data['type'] = array('typeid'=>2,
									  'typedesc'=>'Beneficiary',
									  'inputSenderName' =>$senderinfo[1],
									   'inputSender'    => $this->input->post('inputSenderHide'));	
				
 			}elseif(isset($_POST['btnSubmit'])) // Process the SMARTMONEY
 			{
 				$INPUT_POST =$this->input->post(null,true);
 				// $T_VALUE =md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));
 				$url = url;
				$parameter =array(
								'dev_id'     		=> $this->global_f->dev_id(),
								'actionId' 	 		=> _ecashtosmartmoney,
								'ip_address'	    =>$this->ip,
			    				'regcode'   		=>$this->user['R'],
			    				'transpass' 		=>$INPUT_POST['inputTpass'],
			    				'smartmoneyno'		=>$INPUT_POST['inputSnumber'],
			    				'bene_name'			=>$INPUT_POST['inputBeneficiary'],
			    				'amount'			=>$INPUT_POST['inputAmount'],	
			    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
		    				    ); 

			    $result = $this->curl->call($parameter,$url);
				$data['API'] = json_decode($result,true);
				

 				$id = explode("|", $INPUT_POST['inputId']);
				$data['row'] = array ('smartmoneyno'     =>$INPUT_POST['inputSnumber'],
									  'inputAmount'      =>$INPUT_POST['inputAmount'],
									  'sender_mobileno'      =>$INPUT_POST['inputSenderMobile'],
									  'bene_mobileno'      =>$INPUT_POST['inputBeneMobile'],
									  'inputBeneficiary' =>$INPUT_POST['inputBeneficiary'],
									  'senderid'     	 =>$id[0],
									  'beneficiaryid'    =>$id[3],
									  'idtype'			 =>$INPUT_POST['inputidType'],
									  'idNo'		     =>$INPUT_POST['inputIdnumber'],
									  'transpass'        =>$INPUT_POST['inputTpass'],
									   'charge'          =>$data['API']['C']
										);

 				$this->session->set_userdata('details',$data['row']);
	
 			}elseif(isset($_POST['btnAddDetails']))// add sender and benificiary
 			{
 				$INPUT_POST =$this->input->post(null,true);

 				
 				$url = url;
				$parameter =array(
								'dev_id'    		=> $this->global_f->dev_id(),
								'actionId' 	 		=> _remittance_add_user,
								'ip_address'	    =>$this->ip,
			    				'regcode'   		=>$this->user['R'],
			    				'transpass' 		=>$INPUT_POST['inputTpass'],
			    				'firstname'			=>$INPUT_POST['inputFname'],
			    				'middlename'		=>$INPUT_POST['inputMname'],
			    				'lastname'			=>$INPUT_POST['inputLname'],
			    				'mobileno'			=>$INPUT_POST['inputMobile'],	
			    				'gender'			=>$INPUT_POST['selGender'],
			    				'email'				=>$INPUT_POST['inputEmail'],
			    				'address'			=>$INPUT_POST['inputAddr'],
			    				'country'			=>$INPUT_POST['selCountry'],
			    				'birthday'			=>$INPUT_POST['inputBdate'],
			    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
		    				    );
				 	$result = $this->curl->call($parameter,$url);				 	
					$data['result'] = json_decode($result,true);
	
 			}elseif (isset($_POST['btnsmartmoneyconfirm'])) 
 			{
 			
 				$INPUT_POST = $this->input->post(null,true);
 				
 				$url = url;
				$parameter =array(
								'dev_id'    	    => $this->global_f->dev_id(),
								'actionId' 	 		=> _remittance_send_smartmoney_confirm,
								'ip_address'	    =>$this->ip,
								'ip'	    		=>$this->ip,
			    				'regcode'   		=>$this->user['R'],
			    				'transpass' 		=>$INPUT_POST['inputTpass'],
			    				'smartmoneyno'		=>$INPUT_POST['inputSmartmoney'],
			    				'sender_id'			=>$INPUT_POST['inputSenderid'],
			    				'bene_id'			=>$INPUT_POST['inputBeneficiaryId'],
			    				'idnumber'			=>$INPUT_POST['inputIdnumber'],	
			    				'idtype'			=>$INPUT_POST['inputIdtype'],
			    				'amount'			=>$INPUT_POST['inputAmount'],
			    				'sender_mobileno'   =>$INPUT_POST['inputSenderMobile'],
							  	'bene_mobileno'     =>$INPUT_POST['inputBeneMobile'],
			    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
		    				    );
				 	$result = $this->curl->call($parameter,$url);
					$data['result'] = json_decode($result,true);

 
					if ($data['result']['S'] == 25){
							$data['API']['S'] = 1; 
				    		$data['result'] = array(
				    				'S'  => 25,
				    				'M'  => $data['result']['M'],
				    				'TN' => $data['result']['TN']
				    			);
							$data['process'] = 1; 
							$this->session->set_userdata('API_25',$data['result']);

					}elseif ($data['result']['S'] == 1){
							$data['API']['S']  = "";
							$data['result'] = array(
							    				'S' => 1,
							    				'M' => $data['result']['M'],
							    				'TN' => $data['result']['TN'],
							    				'RF' => $data['result']['RF'],
							    				'URL' => $data['result']['URL']
				    							);
					}elseif ($data['result']['S'] == 2){
							$data['API']['S']  = "";
							$data['result'] = array(
							    				'S' => 2,
							    				'M' => $data['result']['M'],
							    				'TN' => $data['result']['TN']
				    							);
					}else {
							$data['row'] = $this->session->userdata('details');
							$data['API']['S'] = 1;
				    		$data['result'] = array(
				    				'S' => 0,
				    				'M' => $data['result']['M']

				    			);
				    		$data['process'] = 0;
					} 

					
 			}elseif (isset($_POST['btnConfirmActivation'])) 
 			{
 				$INPUT_POST = $this->input->post(null,true);
 				$url = url;
				$parameter =array(
								'dev_id'    	    => $this->global_f->dev_id(),
								'actionId' 	 		=> _remittance_send_smartmoney_confirm_activation,
								'ip_address'	    =>$this->ip,
			    				'regcode'   		=>$this->user['R'],
			    				'trackno'			=>$INPUT_POST['transactionno'],
			    				'vericode'			=>$INPUT_POST['verification_code'],
			    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'])
		    				    );
				 	$result = $this->curl->call($parameter,$url);
					$data['result'] = json_decode($result,true);


					if ($data['result']['S'] == 1) {
							$this->user['EC'] = $data['result']['EC'];						 
							$data['user'] = $this->global_f->get_user_session();
							$data['API']['S']  = "";
							$data['result'] = array(
							    				'S'  => 1,
							    				'M'  => $data['result']['M'],
							    				'TN' => $data['result']['TN'],
							    				'RF' => $data['result']['RF'],
							    				'URL' => $data['result']['URL']
				    							);
					}elseif ($data['result']['S'] == 2) {
							$data['API']['S']  = "";
							$data['result'] = array(
							    				'S'  => 2,
							    				'M'  => $data['result']['M'],
							    				'TN' => $data['result']['TN']
				    							);
					}else {
							$API_25 = $this->session->userdata('API_25');
							$data['API']['S'] = "1";
				    		$data['result'] = array(
								    				'S'  => 0,
								    				'M'  => $data['result']['M'],
								    				'TN' => $API_25['TN']
				    								);
				    		$data['process'] = 1;
				   	}
 			}

			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('remittance/ecash_send/ecash_to_smartmoney');
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

	public function baremi_index()
	{	
		if ($this->user['A_CTRL']['remittance'] == 1 && $this->user['A_CTRL']['remittance_baremi_send'] == 1 && $this->user['R'] != 'G5457340'){

		$data = array('menu' => 2,
					'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;

			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('remittance/ecash_send/baremi_main_panel');
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');	

			}else {
				//$this->session->unset_userdata('user');
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
			//$this->session->unset_userdata('user');
			redirect('Main/');
		}
		
	}


	public function baremi_checkref()
	{
		if ($this->user['A_CTRL']['remittance'] == 1){

		$data = array('menu' => 2,
					  'parent'=>'REMITTANCE' );
		
			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;
				$data['process'] = 0; 

					if (isset($_POST['btnSubmit'])) {

						$url = url;
						$parameter =array(
									'dev_id'    	   => $this->global_f->dev_id(),
									'actionId' 		   => _baremi_check_ref,
				    				'regcode'          =>$this->user['R'],
				    				'referenceno'	   =>$this->input->post('refno'),
				    				'ip_address'       =>$this->ip
							    	); 
					    $result = $this->curl->call($parameter,$url);
					    $data['result'] = json_decode($result,true);	

					    if ($data['result']['S'] == 25){  
				    		$data['result'] = array(
				    				'S'  => 25,
				    				'M'  => $data['result']['M'],
				    				'RF' => $this->input->post('refno'),
				    				'TN'  => $data['result']['TN']
				    			);
							$data['process'] = 1; 
					    }elseif ($data['result']['S'] == 1) {
				    		$data['result'] = array(
				    				'S'  => 1,
				    				'M'  => $data['result']['M'],
				    				'RF' => $data['result']['RF'],
				    				'TN' => $data['result']['TN'],
				    				'URL' => $data['result']['URL']
				    			);
					    }else{
				    		$data['result'] = array(
				    				'S'  => 0,
				    				'M'  => $data['result']['M']
				    			);
					    }

					}elseif (isset($_POST['btnConfirmActivation'])) {
		 				$INPUT_POST = $this->input->post(null,true);
		 				$url = url;
						$parameter =array(
										'dev_id'    	    => $this->global_f->dev_id(),
										'actionId' 	 		=> _baremi_confirm_activation,
										'ip_address'	    =>$this->ip,
					    				'regcode'   		=>$this->user['R'],
					    				'trackno'			=>$INPUT_POST['transactionno'],
					    				'vericode'			=>$INPUT_POST['verification_code'],
					    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'])
				    				    );
						 	$result = $this->curl->call($parameter,$url);
							$data['result'] = json_decode($result,true);

						if ($data['result']['S'] == 1) {
								$this->user['EC'] = $data['result']['EC'];						 
								$data['user'] = $this->global_f->get_user_session();
								$data['result'] = array(
								    				'S'  => 1,
								    				'M'  => $data['result']['M'],
								    				'TN' => $data['result']['TN'],
								    				'RF' => $data['result']['RF'],
								    				'URL' => $data['result']['URL']
					    							);
						}elseif ($data['result']['S'] == 2) {
								$data['result'] = array(
								    				'S'  => 2,
								    				'M'  => $data['result']['M'],
								    				'TN' => $data['result']['TN']
					    							);
						}else {
					    		$data['result'] = array(
								    				'S'  => 0,
								    				'M'  => $data['result']['M'],
								    				'TN' => $INPUT_POST['transactionno']
				    								);
					    		$data['process'] = 1;
					   	}
	 			}

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_send/baremi_checkref');
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

	public function baremi_cancel()
	{
		if ($this->user['A_CTRL']['remittance'] == 1){

		$data = array('menu' => 2,
					 'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;
				$data['process'] = 0; 
					
					if (isset($_POST['btnSubmit'])) {
						$url = url;
						$parameter =array(
									'dev_id'    	   => $this->global_f->dev_id(),
									'actionId' 		   => _baremi_check_ref,
				    				'regcode'          =>$this->user['R'],
				    				'referenceno'	   =>$this->input->post('refno'),
				    				'ip_address'       =>$this->ip
							    	); 
					    $result = $this->curl->call($parameter,$url);
					    $data['result'] = json_decode($result,true);	

					    if ($data['result']['S'] == 1){  
				    		$data['result'] = array(
				    				'S'  => 1,
				    				'M'  => 'Transaction was found',
				    				'RF' => $data['result']['RF'],
				    				'TN' => $data['result']['TN']
				    			);
							$data['process'] = 1; 
							$this->session->set_userdata('details',$data['result']);
					    }else{
				    		$data['result'] = array(
				    				'S'  => 0,
				    				'M'  => 'Transaction is not valid for cancellation'
				    			);
					    }

					}elseif (isset($_POST['btnBaremiCancel'])){

		 				$url = url;
						$parameter =array(
									'dev_id'     		=> $this->global_f->dev_id(),
									'actionId' 	 		=> _baremi_cancel,
				    				'regcode'   		=>$this->user['R'],
				    				'transpass' 		=>$this->input->post('inputTranspass'),
				    				'trackingno'	    =>$this->input->post('inputTransactionNo'),
				    				'ip_address'		=>$this->ip,
				    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].$this->input->post('inputTranspass'))
			    				    );
					 	$result = $this->curl->call($parameter,$url);
						$data['result'] = json_decode($result,true);

						$row = $this->session->userdata('details');

					    if ($data['result']['S'] == 1){  
				    		$data['result'] = array(
				    				'S'  => 1,
				    				'M'  => $data['result']['M']
				    			); 
				    		$data['process'] = 0;
					    }else{
				    		$data['result'] = array(
				    				'S'  => 0,
				    				'M'  => $data['result']['M'],
				    				'TN' => $row['TN'],
				    				'RF' => $row['RF']
				    			);
				    		$data['process'] = 1;
					    }
	 				}

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_send/baremi_cancel');
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

	public function ecashtobaremi()
	{
		if ($this->user['A_CTRL']['remittance'] == 1 && $this->user['A_CTRL']['remittance_baremi_send'] == 1){

		$data = array('menu' => 2,
					  'parent'=>'REMITTANCE' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;
			
			if (isset($_POST['btnSsearch'])) //Search Sender
			{
 				$search = $this->input->post('inputSearch');
 				$url = url;
				$parameter =array(
							'dev_id'    	    => $this->global_f->dev_id(),
							'actionId' 	 		=> _remittance_search,
							'ip_address'	    =>$this->ip,
		    				'search_key'   	 	=>$search,
		    				'regcode' 			=>$this->user['R']
		    				); 

			    $result = $this->curl->call($parameter,$url);
				$data['row'] = json_decode($result,true);

				if ($data['row']['S']==1) {
					$data['type'] = array('typeid'=>1,
										 'typedesc'=>'Sender');
				}
				
 			}
 			elseif (isset($_POST['btnBsearch']))  //Search Beneficiary
 			{
 				$search = $this->input->post('inputSearch');
 				$url = url;
				$parameter =array(
							'dev_id'     		=> $this->global_f->dev_id(),
							'actionId' 	 		=> _remittance_search,
							'ip_address'	    =>$this->ip,
		    				'search_key'   	 	=>$search,
		    				'regcode' 			=>$this->user['R']
		    				); 

			    $result = $this->curl->call($parameter,$url);
				$data['row'] = json_decode($result,true);

				$senderinfo = explode("|", $this->input->post('inputSenderHide'));
				$data['type'] = array('typeid'=>2,
									  'typedesc'=>'Beneficiary',
									  'inputSenderName' =>$senderinfo[1],
									  'inputSender'    => $this->input->post('inputSenderHide'));	

 			}
 			elseif(isset($_POST['btnSubmit']))
 			{
 				$INPUT_POST =$this->input->post(null,true);
 				$url = url;
				$parameter =array(
								'dev_id'     		=> $this->global_f->dev_id(),
								'actionId' 	 		=> _baremi_check_remittance_charge,
								'ip_address'	    =>$this->ip,
			    				'regcode'   		=>$this->user['R'],
			    				'amount'			=>$INPUT_POST['inputAmount'],	
			    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'])
		    				    ); 

			    $result = $this->curl->call($parameter,$url);
				$data['API'] = json_decode($result,true);

 				$id = explode("|", $INPUT_POST['inputId']);
				$data['row'] = array ('inputAmount'      =>$INPUT_POST['inputAmount'],
									  'inputBeneficiary' =>$INPUT_POST['inputBeneficiary'],
									  'inputSender' 	 =>$id[1],
									  'senderid'     	 =>$id[0],
									  'beneficiaryid'    =>$id[3],
									  'charge'           =>$data['API']['C'],
									  'sender_message'   =>$INPUT_POST['inputMessage']
										);

 				$this->session->set_userdata('details',$data['row']);
 			}
 			elseif(isset($_POST['btnAddDetails']))// add sender and benificiary
 			{
 				$INPUT_POST =$this->input->post(null,true);
 				$url = url;
				$parameter =array(
								'dev_id'    		=> $this->global_f->dev_id(),
								'actionId' 	 		=> _remittance_add_user,
								'ip_address'	    =>$this->ip,
			    				'regcode'   		=>$this->user['R'],
			    				'transpass' 		=>$INPUT_POST['inputTpass'],
			    				'firstname'			=>$INPUT_POST['inputFname'],
			    				'middlename'		=>$INPUT_POST['inputMname'],
			    				'lastname'			=>$INPUT_POST['inputLname'],
			    				'mobileno'			=>$INPUT_POST['inputMobile'],	
			    				'gender'			=>$INPUT_POST['selGender'],
			    				'email'				=>$INPUT_POST['inputEmail'],
			    				'address'			=>$INPUT_POST['inputAddr'],
			    				'country'			=>$INPUT_POST['selCountry'],
			    				'birthday'			=>$INPUT_POST['inputBdate'],
			    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
		    				    );
				 	$result = $this->curl->call($parameter,$url);
					$data['result'] = json_decode($result,true);

 			}
 			elseif(isset($_POST['btnbaremiconfirm']))
 			{
 				$INPUT_POST = $this->input->post(null,true);			
 				$url = url;
				$parameter =array(
								'dev_id'    	    => $this->global_f->dev_id(),
								'actionId' 	 		=> _baremi_send_remittance,
								'ip_address'	    =>$this->ip,
			    				'regcode'   		=>$this->user['R'],
			    				'transpass' 		=>$INPUT_POST['inputTpass'],
			    				'sender'			=>$INPUT_POST['inputSenderid'],
			    				'beneficiary'		=>$INPUT_POST['inputBeneficiaryId'],
			    				'message'			=>$INPUT_POST['inputMessage'],	
			    				'amount'			=>$INPUT_POST['inputAmount'],
			    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
		    				    );
				 	$result = $this->curl->call($parameter,$url);
					$data['result'] = json_decode($result,true);

					if ($data['result']['S'] == 25){
							$data['API']['S'] = 1; 
				    		$data['result'] = array(
				    				'S'  => 25,
				    				'M'  => $data['result']['M'],
				    				'TN' => $data['result']['TN']
				    			);
							$data['process'] = 1; 
							$this->session->set_userdata('API_25',$data['result']);

					}elseif ($data['result']['S'] == 1){
							$data['API']['S']  = "";
							$data['result'] = array(
							    				'S' => 1,
							    				'M' => 'Successful '.$data['result']['M'],
							    				'TN' => $data['result']['TN'],
							    				'RF' => $data['result']['RF'],
							    				'URL' => $data['result']['URL']
				    							);
					}elseif ($data['result']['S'] == 2){
							$data['API']['S']  = "";
							$data['result'] = array(
							    				'S' => 2,
							    				'M' => $data['result']['M'],
							    				'TN' => $data['result']['TN']
				    							);
					}else {
							$data['row'] = $this->session->userdata('details');
							$data['API']['S'] = 1;
				    		$data['result'] = array(
				    				'S' => 0,
				    				'M' => $data['result']['M']

				    			);
				    		$data['process'] = 0;
					} 
 			}elseif (isset($_POST['btnConfirmActivation'])) 
 			{
 				$INPUT_POST = $this->input->post(null,true);
 				$url = url;
				$parameter =array(
								'dev_id'    	    => $this->global_f->dev_id(),
								'actionId' 	 		=> _baremi_confirm_activation,
								'ip_address'	    =>$this->ip,
			    				'regcode'   		=>$this->user['R'],
			    				'trackno'			=>$INPUT_POST['transactionno'],
			    				'vericode'			=>$INPUT_POST['verification_code'],
			    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'])
		    				    );
				 	$result = $this->curl->call($parameter,$url);
					$data['result'] = json_decode($result,true);


					if ($data['result']['S'] == 1) {
							$this->user['EC'] = $data['result']['EC'];						 
							$data['user'] = $this->global_f->get_user_session();
							$data['API']['S']  = "";
							$data['result'] = array(
							    				'S'  => 1,
							    				'M'  => $data['result']['M'],
							    				'TN' => $data['result']['TN'],
							    				'RF' => $data['result']['RF'],
							    				'URL' => $data['result']['URL']
				    							);
					}elseif ($data['result']['S'] == 2) {
							$data['API']['S']  = "";
							$data['result'] = array(
							    				'S'  => 2,
							    				'M'  => $data['result']['M'],
							    				'TN' => $data['result']['TN']
				    							);
					}else {
							$API_25 = $this->session->userdata('API_25');
							$data['API']['S'] = "1";
				    		$data['result'] = array(
								    				'S'  => 0,
								    				'M'  => $data['result']['M'],
								    				'TN' => $API_25['TN']
				    								);
				    		$data['process'] = 1;
				   	}
 			}

			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('remittance/ecash_send/ecash_to_baremi');
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

	function otp_baremi_resend()
	{
		if (isset($_POST['trackno'])){
			$url = url;
			$parameter = array( 'dev_id'     		=>$this->global_f->dev_id(),
		    				 	'ip_address' 		=>$this->ip,
		    					 'actionId' 	 	=> _baremi_otp_resend,
    							 'regcode'   	 	=>$this->user['R'],
		    					 'trackno'    		=>$_POST['trackno'],
		    					 $this->user['SKT']	 =>md5($this->user['R'].$this->user['SKT'])
			    				  );
		    $result = $this->curl->call($parameter,$url);
		    $API = json_decode($result,true);
			$result = array(
							'S' => $API['S'],
							'M' => $API['M']
							);
			
		 }else{
			$result = array('S' => 0, 'M' => 'Invalid input');
		}

		echo json_encode($result);
	}
	
		public function ecashpadala()
	{
		if ($this->user['A_CTRL']['remittance'] == 1 && $this->user['A_CTRL']['remittance_gprs_send'] == 1){

		$data = array('menu' => 2,
					  'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;

				$data['process'] = 0;
				if (isset($_POST['btnSsearch'])) //Search Sender
				{
	 				$search = $this->input->post('inputSearch');
	 				$url = url;
					$parameter =array(
								'dev_id'     		=> $this->global_f->dev_id(),
								'actionId' 	 		=> _remittance_search,
			    				'search_key'   	 	=>$search,
			    				'regcode' 			=>$this->user['R'],
			    				'ip_address'		=>$this->ip
			    				); 

				    $result = $this->curl->call($parameter,$url);
					$data['row'] = json_decode($result,true);

					if ($data['row']['S']==1) {
						$data['type'] = array('typeid'=>1,
											 'typedesc'=>'Sender');
					}
					
				 
	 			}
	 			elseif (isset($_POST['btnBsearch']))  //Search Benificiary
	 			{
	 				$search = $this->input->post('inputSearch');
	 				$url = url;
					$parameter =array(
								'dev_id'     		=> $this->global_f->dev_id(),
								'actionId' 	 		=> _remittance_search,
			    				'search_key'   	 	=>$search,
			    				'regcode' 			=>$this->user['R'],
			    				'ip_address'		=>$this->ip
			    				); 

				    $result = $this->curl->call($parameter,$url);
					$data['row'] = json_decode($result,true);

					$senderinfo = explode("|", $this->input->post('inputSenderHide'));
					
				
					$data['type'] = array('typeid'=>2,
										  'typedesc'=>'Benificiary',
										  'inputSenderName' =>$senderinfo[1],
										   'inputSender'    => $this->input->post('inputSenderHide'));	
				
	 			}elseif(isset($_POST['btnSubmit'])) // Process the SMARTMONEY
	 			{
	 				
	 				$INPUT_POST =$this->input->post(null,true);
	 				
	 				if($INPUT_POST['inputAmount'] >= 1 && $INPUT_POST['inputAmount'] <= 50000)
	 				{
	 					// echo 'ok';
		 				$url = url;
						$parameter =array(
										'dev_id'    	    => $this->global_f->dev_id(),
										'ip_address'		=>$this->ip,
										'actionId' 	 		=> _remittance_send_ecash_padala,
					    				'regcode'   		=>$this->user['R'],
					    				'transpass' 		=>$INPUT_POST['inputTpass'],
					    				'amount'			=>$INPUT_POST['inputAmount'],
					    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
				    				    ); 

						
					    $result = $this->curl->call($parameter,$url);
						$data['API'] = json_decode($result,true);
						if ($data['API']['S']  == 1) {
							$explode = explode("|", $INPUT_POST['inputId']);
							$data['details'] = array('process'=>1,
		 							  'sender_id'=>$explode[0],
		 							  'sender_name'=>$explode[1],
		 							  'bene_id'=>$explode[3],
		 							  'bene_name'=>$explode[4],
		 							  'mobile'=>$explode[2],
		 							  'amount'=>$INPUT_POST['inputAmount'],
		 							  'tpass'=>$INPUT_POST['inputTpass'],
		 							  'charge'=>$data['API']['C'],
		 							  'sender_mobileno'  =>$INPUT_POST['inputSenderMobile'],
									  'bene_mobileno'    =>$INPUT_POST['inputBeneMobile']	
		 							   );	
		 							   	
								 //	$this->user['PB'] = $data['API']['PB'];
								 //	$this->user['EC'] = $data['API']['EC'];
								 //	$this->user['SB'] = $data['API']['SB'];
									//$data['user'] = $this->global_f->get_user_session();
								 } 

		 			//$explode = explode("|", $INPUT_POST['inputId']);
	 				} else {
	 					//echo 'Please enter the amount between 1 to 50,000 only';
	 					$data['API']['S']  = 0;
	 					$data['API']['M']  = 'Please enter the amount between 1 to 50,000 only.';
	 				}

				
	 			}elseif(isset($_POST['btnAddDetails']))// add sender and benificiary
	 			{
	 				$INPUT_POST =$this->input->post(null,true);

	 				$T_VALUE =md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));
	 				$url = url;
					$parameter =array(
									'dev_id'    	    => $this->global_f->dev_id(),
									'ip_address'		=>$this->ip,
									'actionId' 	 		=> _remittance_add_user,
				    				'regcode'   		=>$this->user['R'],
				    				'transpass' 		=>$INPUT_POST['inputTpass'],
				    				'firstname'			=>$INPUT_POST['inputFname'],
				    				'middlename'		=>$INPUT_POST['inputMname'],
				    				'lastname'			=>$INPUT_POST['inputLname'],
				    				'mobileno'			=>$INPUT_POST['inputMobile'],	
				    				'gender'			=>$INPUT_POST['selGender'],
				    				'email'				=>$INPUT_POST['inputEmail'],
				    				'address'			=>$INPUT_POST['inputAddr'],
				    				'country'			=>$INPUT_POST['selCountry'],
				    				'birthday'			=>$INPUT_POST['inputBdate'],
				    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
			    				    );
					 	$result = $this->curl->call($parameter,$url);
						$data['API'] = json_decode($result,true);
						
	 			}elseif(isset($_POST['btnConfirm'])){
	 					$INPUT_POST =$this->input->post(null,true);
	 					$url = url;
						$parameter =array(
									'dev_id'    	    => $this->global_f->dev_id(),
									'actionId' 	 		=> _remittance_send_ecash_padala_confirm,
									'regcode'    	    => $this->user['R'],
									'transpass'		    =>$INPUT_POST['tpass'],
									'amount' 	 		=> $INPUT_POST['amount'],
				    				'ip_address'   		=>$this->ip,
				    				'sender_id'			=>$INPUT_POST['sender_id'],
				    				'sender_mobile' 	=>$INPUT_POST['sender_mobile'],
				    				'bene_id'			=>$INPUT_POST['bene_id'],
				    				'bene_name'			=>$INPUT_POST['bene_name'],
				    				
				    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($INPUT_POST['tpass']))
			    				    ); 
				
				    $result = $this->curl->call($parameter,$url);
					$data['API'] = json_decode($result,true);
				
					if ($data['API']['S']  == 1) {	
							$data['process'] = 0;
							$data['TN'] = $data['API']['TN'];
						 	$this->user['PB'] = $data['API']['PB'];
						 	$this->user['EC'] = $data['API']['EC'];
						 	$this->user['SB'] = $data['API']['SB'];
							$data['user'] = $this->global_f->get_user_session();
						} 
						$data['process'] = 0;
	 			}	
				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_send/ecash_padala');
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

	// Updated by Harry 5/22/2019

	public function ecashcredittobank() {
			
		if ($this->user['A_CTRL']['remittance'] == 1 && $this->user['A_CTRL']['remittance_creditbank_send'] == 1){

			$data = array('menu' => 2,
					  'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;
				$url = url;
				$parameter =array(
							'dev_id'     		=> $this->global_f->dev_id(),
							'actionId' 	 		=> _get_active_banks,
							// 'actionId' 	 		=> "ups_ecash_service/get_active_bank_web_new",
		    				'search_key'   	 	=>$search,
		    				'regcode' 			=>$this->user['R'],
		    				'ip_address'		=>$this->ip
		    				); 

			    $result = $this->curl->call($parameter,$url);
				$bankresult = json_decode($result,true);


				$data['banks'] = array();
			    foreach ($bankresult['B_DATA'] as $key => $value){
			    	
			        // $data['banks'][$key] = $value['BANK_ID'].'*'.$value['BANK_DESCRIPTION'];
					 $data['banks'][$key] = $value['BANK_ID'].'*'.$value['BANK_DESCRIPTION'].'*'.$value['group'];
			    }

				if (isset($_POST['btnSsearch'])){ //Search Sender

	 				$search = $this->input->post('inputSearch');

	 				$url = url;
					$parameter =array(
								'dev_id'     		=> $this->global_f->dev_id(),
								'actionId' 	 		=> _remittance_search,
			    				'search_key'   	 	=>$search,
			    				'regcode' 			=>$this->user['R'],
			    				'ip_address'		=>$this->ip
			    				); 

				    $result = $this->curl->call($parameter,$url);
					$data['row'] = json_decode($result,true);

					if ($data['row']['S']==1) {
						$data['type'] = array('typeid'=>1,
											 'typedesc'=>'Sender');
					}
					
				 
	 			}elseif (isset($_POST['btnBsearch'])){ //Search Benificiary
 				
 				$search = $this->input->post('inputSearch');
 				$url = url;
				$parameter =array(
							'dev_id'     		=> $this->global_f->dev_id(),
							'actionId' 	 		=> _remittance_search,
		    				'search_key'   	 	=>$search,
		    				'regcode' 			=>$this->user['R'],
		    				'ip_address'		=>$this->ip
		    				); 

			    $result = $this->curl->call($parameter,$url);
				$data['row'] = json_decode($result,true);

				$senderinfo = explode("|", $this->input->post('inputSenderHide'));

				$data['type'] = array('typeid'=>2,
									  'typedesc'=>'Benificiary',
									  'inputSenderName' =>$senderinfo[1],
									   'inputSender'    => $this->input->post('inputSenderHide'));	


 				}elseif(isset($_POST['btnSubmit'])){ // Process the ecashcredittobank
 				
 				$INPUT_POST =$this->input->post(null,true);
 				$otherinfo = explode("|", $this->input->post('inputId'));
 				$this->session->set_userdata('info',$otherinfo);
				$bankdetails = explode("*", $this->input->post('selBankID'));
				$this->session->set_userdata('bank',$bankdetails);

				// print_r($bankdetails);

 				$T_VALUE =md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));
 				$url = url;
				$parameter =array(
								'dev_id'    		=> $this->global_f->dev_id(),
								'ip_address'		=>$this->ip,
								'ip'				=>$this->ip,
								'actionId' 	 		=> _remittance_send_credit_bank,
			    				'regcode'   		=>$this->user['R'],
			    				'transpass' 		=>$INPUT_POST['inputTpass'],
			    				'accountno'			=>$INPUT_POST['inputAccountno'],
			    				'bene_name'			=>$INPUT_POST['inputBeneficiary'],
			    				'amount'			=>str_replace(',', '', $INPUT_POST['inputAmount']),
			    				'bank_id'			=>$bankdetails[0],
			    				'bank_type'			=>$bankdetails[1],
			    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
		    				    );
			    $API = $this->curl->call($parameter,$url);
				$data['results'] = json_decode($API,true);

				// print_r($data['results']);

				// if ($data['API']['S']  == 1) {
				// 		 	$this->user['PB'] = $data['API']['PB'];
				// 		 	$this->user['EC'] = $data['API']['EC'];
				// 		 	$this->user['SB'] = $data['API']['SB'];
				// 			$data['user'] = $this->global_f->get_user_session();
				// 		 } 
 				// 	$data['row'] = explode("||", $INPUT_POST['inputId']);


					if ($data['results']['S']  == 1) {

						$data['result'] =  array(
											'process' 		   => 1,
											'inputAccountno'   => $INPUT_POST['inputAccountno'],
											'inputBank'        => $bankdetails[1],
											'inputSender'      => $otherinfo[1],
											'inputBeneficiary' => $INPUT_POST['inputBeneficiary'],
											'inputAmount'      => str_replace(',', '', $INPUT_POST['inputAmount']),
											'inputCharge'      => $data['results']['C'],
											'inputTotal'       => (str_replace(',', '', $INPUT_POST['inputAmount']) + $data['results']['C']),
											'M'				   => $data['results']['M'],
											'TN'			   => $data['results']['TN'],
											'inputTpass'	   => $INPUT_POST['inputTpass']
											);

					}else{
						$data['result'] = array('process'  => 0,
												'M'		   => $data['results']['M']);

					}
				
 				}
         elseif(isset($_POST['btnConfirm'])){

          $INPUT_POST =$this->input->post(null,true);
          $info = $this->session->userdata('info');
          $bank = $this->session->userdata('bank');
 
          $url = url;
         $parameter =array(
                 'dev_id'     		=> $this->global_f->dev_id(),
                 'ip_address'		=>$this->ip,
                 'actionId' 	 		=> _remittance_send_credit_bank_confirm_new,
                   'regcode'   		=>$this->user['R'],
                   'transno'			=>$INPUT_POST['inputTN'],
                   'bene_id'			=>$info[3],
                   'sender_id'			=>$info[0],
                   'bank_id'			=>$bank[0],
                   'bene_name'			=>$INPUT_POST['inputBeneficiary'],
                   'amount'			=>str_replace(',', '', $INPUT_POST['inputAmount']),
                   'accountno'			=>$INPUT_POST['inputAccountno'],
                   'transpass' 		=>$INPUT_POST['inputTpass'],
                   $this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
                   );
         $result = $this->curl->call($parameter,$url);
         //print_r($result);die();
         $data['API'] = json_decode($result,true);
           if ($data['API']['S'] == 1) {
             $this->user['EC'] = $data['API']['EC'];
             $data['user'] = $this->global_f->get_user_session();
           } else {
             $data['result'] = array('S' => 0, 'M' => $data['API']['M']);
           }
          }
 				elseif(isset($_POST['btnAddDetails'])){ // add sender and benificiary

 				$INPUT_POST =$this->input->post(null,true);

 				$T_VALUE =md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));
 				$url = url;
				$parameter =array(
								'dev_id'     		=> $this->global_f->dev_id(),
								'ip_address'		=>$this->ip,
								'actionId' 	 		=> _remittance_add_user,
			    				'regcode'   		=>$this->user['R'],
			    				'transpass' 		=>$INPUT_POST['inputTpass'],
			    				'firstname'			=>$INPUT_POST['inputFname'],
			    				'middlename'		=>$INPUT_POST['inputMname'],
			    				'lastname'			=>$INPUT_POST['inputLname'],
			    				'mobileno'			=>$INPUT_POST['inputMobile'],	
			    				'gender'			=>$INPUT_POST['selGender'],
			    				'email'				=>$INPUT_POST['inputEmail'],
			    				'address'			=>$INPUT_POST['inputAddr'],
			    				'country'			=>$INPUT_POST['selCountry'],
			    				'birthday'			=>$INPUT_POST['inputBdate'],
			    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
		    				    );
				 	$API = $this->curl->call($parameter,$url);
					$data['result'] = json_decode($API,true);
					
 				}



	     //   	$data['get'] = $this->Query_model->getbank();

	    	// $data['bank'] = array(); 
		    // for ($i=0; $i < count($data['get']); $i++) { 
		   	// 	if ($data['get'][$i]) {
		   	// 		array_push($data['bank'], $data['get'][$i]);
		   	// 	}
		    // }

			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('remittance/ecash_send/ecash_credit_to_bank');
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


		public function ecashtocashcard()
	{
		if ($this->user['A_CTRL']['remittance'] == 1 && $this->user['A_CTRL']['remittance_ecad_send'] == 1){

		$data = array('menu' => 2,
					  'parent'=>'REMITTANCE' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;
			$url = url;

			if (isset($_POST['btnBsearch'])) {
				$search = $this->input->post('inputSearch');
				$parameter =array(
							'dev_id'    	    => $this->global_f->dev_id(),
							'actionId' 	 		=> _remittance_search_cashcard_user,
		    				'search_key'   	 	=>$search,
		    				'regcode' 			=>$this->user['R'],
		    				'ip_address'		=>$this->ip
		    				); 

			    $result = $this->curl->call($parameter,$url);
				$data['row'] = json_decode($result,true);
			
						
			}elseif (isset($_POST['btnSubmit']))
			{
				$INPUT_POST=$this->input->post(null,true);
				$inputRData = json_decode(json_encode(json_decode($INPUT_POST['inputRData'])),true);				 
				$receipient = explode(",", $INPUT_POST['inputData']);
				$parameter =array(
							'dev_id'     		 => $this->global_f->dev_id(),
							'actionId' 	 		 => _remittance_cashcard_confirm,
		    				'regcode'   	 	 =>$this->user['R'],
		    				'acctno' 			 =>$receipient[1],
		    				'receipient_f'		 =>$receipient[2],
		    				'receipient_m'		 =>$receipient[3],
		    				'receipient_l'		 =>$receipient[4],
		    				'transpass'			 =>$INPUT_POST['inputTpass'],
		    				'amount'			 =>$INPUT_POST['inputAmount'],
		    				'ip_address'    	 =>$this->ip,
		    				$this->user['SKT']	 =>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
		    				); 
			    $result = $this->curl->call($parameter,$url);
				$data['result'] = json_decode($result,true);

				if ($data['result']['S']  == 1) {
					$data['result'] = array(
										'S' => 1,
										'M' => $result['M'],
										'EC' => $result['EC'],
										'TN' => $result['TN'],
										'URL' => $result['URL']
										);
					$this->user['EC'] = $data['result']['EC'];
					$data['user'] = $this->global_f->get_user_session();

				} elseif ($data['result']['S'] == 2) {
					$data['row'] = $inputRData;
					$data['receipientAccno'] = $receipient[1];
					$data['receipientName'] = $receipient[0];
					$data['topupAmount'] = $INPUT_POST['inputAmount'];
					$data['OTPdata'] = array(
										'S' => $data['result']['S'],
										'M' => $data['result']['M'],
										'TN' => $data['result']['TN']
											);
					$data['process_otp'] = 1;
				} else{
					$data['row'] = $inputRData;
				}

			}

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_send/ecash_to_cashcard');
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
  
  /* Harry Cardless 09/16/2019 */

  public function getCardlessAccountNo(){
    $url = url;
    $search = $this->input->post('inputSearch');
    $parameter = array(
      'dev_id'    	    => $this->global_f->dev_id(),
      'actionId' 	 		=> _remittance_search_cashcard_user,
        'search_key'   	 	=>$search,
        'regcode' 			=>$this->user['R'],
        'ip_address'		=>$this->ip
        ); 

    $result = $this->curl->call($parameter,$url);
    $response= json_decode($result,true);	
    echo json_encode($response);
  }

  public function ecashcardlesspadala()
	{
		// if ($this->user['A_CTRL']['remittance'] == 1 && $this->user['A_CTRL']['remittance_ecad_send'] == 1){
    if (1){

		$data = array('menu' => 2,
					  'parent'=>'REMITTANCE' );

      if ($this->user['S'] == 1 && $this->user['R'] !=""){
          $url = url;
          $data['user'] = $this->user;
          $data['session'] = $this->global_f->get_user_session();

          $this->load->view('layout/header',$data);
          $this->load->view('element/top_header');
          $this->load->view('element/wrapper_header');
          $this->load->view('element/left_panel');
          $this->load->view('remittance/ecash_send/ecash_cardless_padala');
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

  public function ecashcardlesspadala_confirm(){
    // $url = "http://35.185.184.154/ups_cardless_service/createEGC_confirm";
	$url = "https://mobileapi.unified.ph/ups_cardless_service/createEGC_confirm";
    $INPUT_POST=$this->input->post(null,true);
  
    $parameter =array(
          'dev_id'     		 => $this->global_f->dev_id(),
          // 'actionId' 	 		 => _remittance_cashcard_confirm,
          'actionId'=>'ups_cardless_service/createEGC_confirm',
            's_fname'=>$INPUT_POST['s_fname'],
            's_mname'=> $INPUT_POST['s_mname'],
            's_lname'=> $INPUT_POST['s_lname'],
            's_bdate'=> $INPUT_POST['s_bdate'],
            's_mobile'=> $INPUT_POST['s_mobile'],
            's_email'=> $INPUT_POST['s_email'],
            's_address'=> $INPUT_POST['s_address'],
            's_id'=> $INPUT_POST['s_id'],
            's_idno'=> $INPUT_POST['s_idno'],
            'b_fname'=> $INPUT_POST['b_fname'],
            'b_mname'=> $INPUT_POST['b_mname'],
            'b_lname'=> $INPUT_POST['b_lname'],
            'b_bdate'=> $INPUT_POST['b_bdate'],
            'b_mobile'=> $INPUT_POST['b_mobile'],
            'b_email'=> $INPUT_POST['b_email'],
            'b_address'=> $INPUT_POST['b_address'],
            'amount'=> $INPUT_POST['amount'],
            'purpose'=> $INPUT_POST['purpose'],
            'transpass'=> $INPUT_POST['transpass'],

            'regcode' 			=>$this->user['R'],
            'ip'    	 =>$this->ip,
            $this->user['SKT']	 =>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('transpass')))
            ); 
      // print_r($parameter);
      $result = $this->curl->call($parameter,$url);
      $response= json_decode($result,true);	
      echo json_encode($response);
  }

  public function unholdCardlessPadala(){
    // $url = "http://35.185.184.154/ups_cardless_service/createEGC_confirm_unhold";
	$url = "https://mobileapi.unified.ph/ups_cardless_service/createEGC_confirm_unhold";
    $INPUT_POST=$this->input->post(null,true);
  
    $parameter =array(
          'dev_id'     		 => $this->global_f->dev_id(),
          // 'actionId' 	 		 => _remittance_cashcard_confirm,
          'actionId'=>'ups_cardless_service/createEGC_confirm_unhold',

            'trackno' => $INPUT_POST['trackno'],
            'vcode' => $INPUT_POST['vcode'],

            'regcode' 			=>$this->user['R'],
            'ip'    	 =>$this->ip,
            $this->user['SKT']	 => md5($this->user['R'].$this->user['SKT'])
            ); 
      // print_r($parameter);
      $result = $this->curl->call($parameter,$url);
      $response= json_decode($result,true);	
      echo json_encode($response);
  }


  /* End Harry Cardless 09/16/2019 */



  /* Harry CashCard 0/10/2019 */

  // View
  
  public function ecashtocashcard_new()
	{
		// if ($this->user['A_CTRL']['remittance'] == 1 && $this->user['A_CTRL']['remittance_ecad_send'] == 1){
    if (1){

		$data = array('menu' => 2,
					  'parent'=>'REMITTANCE' );

      if ($this->user['S'] == 1 && $this->user['R'] !=""){
          $url = url;
          $data['user'] = $this->user;
          $data['session'] = $this->global_f->get_user_session();

          $this->load->view('layout/header',$data);
          $this->load->view('element/top_header');
          $this->load->view('element/wrapper_header');
          $this->load->view('element/left_panel');
          $this->load->view('remittance/ecash_send/ecash_to_cashcard_new');
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


  // get sender 
  public function cashcard_get_sender(){
    $search = $this->input->post('inputSearch');

    $url = url;
        $parameter =array(
              'dev_id'     		=> $this->global_f->dev_id(),
              'actionId' 	 		=> _remittance_search,
                'search_key'   	 	=>$search,
                'regcode' 			=>$this->user['R'],
                'ip_address'		=>$this->ip
                ); 

        $result = $this->curl->call($parameter,$url);
        $response= json_decode($result,true);	
        echo json_encode($response);
  }

  // add sender
  public function cashcard_new_sender(){
      $INPUT_POST = $this->input->post(null, true);

      $T_VALUE = md5(date('m/d/Y') . md5('GPRSKEY@)!$w3'));
      $url = url;
      $parameter = array(
          'dev_id' => $this->global_f->dev_id(),
          'ip_address' => $this->ip,
          'actionId' => _remittance_add_user,
          'regcode' => $this->user['R'],
          'transpass' => $INPUT_POST['inputTpass'],
          'firstname' => $INPUT_POST['inputFname'],
          'middlename' => $INPUT_POST['inputMname'],
          'lastname' => $INPUT_POST['inputLname'],
          'mobileno' => $INPUT_POST['inputMobile'],
          'gender' => $INPUT_POST['selGender'],
          'email' => $INPUT_POST['inputEmail'],
          'address' => $INPUT_POST['inputAddr'],
          'country' => $INPUT_POST['selCountry'],
          'birthday' => $INPUT_POST['inputBdate'],
          $this->user['SKT'] => md5($this->user['R'] . $this->user['SKT'] . md5($this->input->post('inputTpass'))),
      );
      $result = $this->curl->call($parameter, $url);
      $response = json_decode($result, true);
      echo json_encode($response);

    }

 
    // OTP Verification
    public function cashcard_otp_verify() {

		if (isset($_POST['otptrackno'])){
		$url = url;
		$parameter =array(
					'dev_id'     		 => $this->global_f->dev_id(),
					'actionId' 	 		 => _remittance_cashcard_otp,
    				'regcode'   	 	 =>$this->user['R'],
    				'trackno'			 =>$_POST['otptrackno'],
    				'vcode'			 	 =>$_POST['vcode'],
    				'ip_address'    	 =>$this->ip,
    				$this->user['SKT']	 =>md5($this->user['R'].$this->user['SKT'])
    				); 
		$result = $this->curl->call($parameter,$url);
		$API = json_decode($result,true);
		$result = array(
						'S' => $API['S'],
						'M' => $API['M'],
						'EC' => $API['EC'],
						'TN' => $API['TN'],
						'URL' => $API['URL']
						);

		}else{
			$result = array('S' => 0, 'M' => 'Invalid input');
		}

		echo json_encode($result);
	}

  // OTP Resend
	public function cashcard_otp_resend() {
		if (isset($_POST['trackno'])){
			$url = url;
			$parameter = array( 'dev_id'     		=>$this->global_f->dev_id(),
		    				 	'ip_address' 		=>$this->ip,
		    					 'actionId' 	 	=> _remittance_cashcard_otp_resend,
    							 'regcode'   	 	=>$this->user['R'],
		    					 'trackno'    		=>$_POST['trackno'],
		    					 $this->user['SKT']	 =>md5($this->user['R'].$this->user['SKT'])
			    				  );
		    $result = $this->curl->call($parameter,$url);
		    $API = json_decode($result,true);
			$result = array(
							'S' => $API['S'],
							'M' => $API['M']
							);
			
		 }else{
			$result = array('S' => 0, 'M' => 'Invalid input');
		}

		echo json_encode($result);
	}
  
  // get beneficiary
  public function getCashCardAccountNo(){
    $search = $this->input->post('inputSearch');
    $url = url;
    $parameter =array(
          'dev_id'    	    => $this->global_f->dev_id(),
          'actionId' 	 		=> _remittance_search_cashcard_user,
            'search_key'   	 	=>$search,
            'regcode' 			=>$this->user['R'],
            'ip_address'		=>$this->ip
            ); 
    $result = $this->curl->call($parameter,$url);
    $response= json_decode($result,true);	
    echo json_encode($response);
  }


  // cashcard transaction
  public function cashcard_confirm_new(){
    // $url = "http://35.185.184.154/ups_ecash_service/cashcard_confirm_new";
	$url = "https://mobileapi.unified.ph/ups_ecash_service/cashcard_confirm_new";
    $INPUT_POST=$this->input->post(null,true);
  
    $parameter =array(
          'dev_id'     		 => $this->global_f->dev_id(),
          // 'actionId' 	 		 => _remittance_cashcard_confirm,
          'actionId'=>'ups_ecash_service/cashcard_confirm_new',
            'accntNo'=>$INPUT_POST['accntNo'],
            'amount'=> $INPUT_POST['amount'],
            'senderFirstName'=> $INPUT_POST['senderFirstName'],
            'senderMidName'=> $INPUT_POST['senderMidName'],
            'senderLastName'=> $INPUT_POST['senderLastName'],
            'senderAddressLine1'=> $INPUT_POST['senderAddressLine1'],
            'senderBirthdate'=> $INPUT_POST['senderBirthdate'],
            'senderContactDetails'=> $INPUT_POST['senderContactDetails'],
            'senderSourceOfFunds'=> $INPUT_POST['senderSourceOfFunds'],
            'senderNationality'=> $INPUT_POST['senderNationality'],
            'senderBirthPlace'=> $INPUT_POST['senderBirthPlace'],
            'senderNatureOfWork'=> $INPUT_POST['senderNatureOfWork'],
            'primaryIDType'=> $INPUT_POST['primaryIDType'],
            'primaryIDNo'=> $INPUT_POST['primaryIDNo'],
            'recipientFirstName'=> $INPUT_POST['recipientFirstName'],
            'recipientMidName'=> $INPUT_POST['recipientMidName'],
            'recipientLastName'=> $INPUT_POST['recipientLastName'],
            'transpass'=> $INPUT_POST['transpass'],
            'regcode' 			=>$this->user['R'],
            'ip_address'    	 =>$this->ip,
            $this->user['SKT']	 =>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('transpass')))
            ); 
      // print_r($parameter);
      $result = $this->curl->call($parameter,$url);
      $response= json_decode($result,true);	
      echo json_encode($response);
  }

  public function cashcard_unhold_new(){
    // $url = "http://35.185.184.154/ups_ecash_service/unhold_cashcard_service_new";
	$url = "https://mobileapi.unified.ph/ups_ecash_service/unhold_cashcard_service_new";
    $INPUT_POST=$this->input->post(null,true);
  
    $parameter =array(
          'dev_id'     		 => $this->global_f->dev_id(),
          // 'actionId' 	 		 => _remittance_cashcard_confirm,
          'actionId'=>'ups_ecash_service/unhold_cashcard_service_new',
            'regcode'   	 	 =>$this->user['R'],
            'trackno'			 =>$INPUT_POST['otptrackno'],
            'vcode'			 	 =>$INPUT_POST['vcode'],
            'accntNo'=>$INPUT_POST['accntNo'],
            'amount'=> $INPUT_POST['amount'],
            'senderFirstName'=> $INPUT_POST['senderFirstName'],
            'senderMidName'=> $INPUT_POST['senderMidName'],
            'senderLastName'=> $INPUT_POST['senderLastName'],
            'senderAddressLine1'=> $INPUT_POST['senderAddressLine1'],
            'senderBirthdate'=> $INPUT_POST['senderBirthdate'],
            'senderContactDetails'=> $INPUT_POST['senderContactDetails'],
            'senderSourceOfFunds'=> $INPUT_POST['senderSourceOfFunds'],
            'senderNationality'=> $INPUT_POST['senderNationality'],
            'senderBirthPlace'=> $INPUT_POST['senderBirthPlace'],
            'senderNatureOfWork'=> $INPUT_POST['senderNatureOfWork'],
            'primaryIDType'=> $INPUT_POST['primaryIDType'],
            'primaryIDNo'=> $INPUT_POST['primaryIDNo'],
            'recipientFirstName'=> $INPUT_POST['recipientFirstName'],
            'recipientMidName'=> $INPUT_POST['recipientMidName'],
            'recipientLastName'=> $INPUT_POST['recipientLastName'],
            'transpass'=> $INPUT_POST['transpass'],
            'regcode' 			=>$this->user['R'],
            'ip_address'    	 =>$this->ip,
            $this->user['SKT']	 =>md5($this->user['R'].$this->user['SKT'])
            ); 
      // print_r($parameter);
      $result = $this->curl->call($parameter,$url);
      $response= json_decode($result,true);	
      echo json_encode($response);
  }

   /* End Harry CashCard 0/10/2019 */



	function otp_verify()
	{

		if (isset($_POST['otptrackno'])){
		$url = url;
		$parameter =array(
					'dev_id'     		 => $this->global_f->dev_id(),
					'actionId' 	 		 => _remittance_cashcard_otp,
    				'regcode'   	 	 =>$this->user['R'],
    				'trackno'			 =>$_POST['otptrackno'],
    				'vcode'			 	 =>$_POST['vcode'],
    				'ip_address'    	 =>$this->ip,
    				$this->user['SKT']	 =>md5($this->user['R'].$this->user['SKT'])
    				); 
		$result = $this->curl->call($parameter,$url);
		$API = json_decode($result,true);
		$result = array(
						'S' => $API['S'],
						'M' => $API['M'],
						'EC' => $API['EC'],
						'TN' => $API['TN'],
						'URL' => $API['URL']
						);

		}else{
			$result = array('S' => 0, 'M' => 'Invalid input');
		}

		echo json_encode($result);
	}


	function otp_resend()
	{
		if (isset($_POST['trackno'])){
			$url = url;
			$parameter = array( 'dev_id'     		=>$this->global_f->dev_id(),
		    				 	'ip_address' 		=>$this->ip,
		    					 'actionId' 	 	=> _remittance_cashcard_otp_resend,
    							 'regcode'   	 	=>$this->user['R'],
		    					 'trackno'    		=>$_POST['trackno'],
		    					 $this->user['SKT']	 =>md5($this->user['R'].$this->user['SKT'])
			    				  );
		    $result = $this->curl->call($parameter,$url);
		    $API = json_decode($result,true);
			$result = array(
							'S' => $API['S'],
							'M' => $API['M']
							);
			
		 }else{
			$result = array('S' => 0, 'M' => 'Invalid input');
		}

		echo json_encode($result);
	}


	public function paymaya()
	{
		if ($this->user['A_CTRL']['remittance'] == 1){

		$data = array('menu' => 2,
					  'parent'=>'REMITTANCE' );
		
		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			if($this->user['R'] == '1234567' || $this->user['R'] == '1234504'){

				$data['user'] = $this->user;

					if (isset($_POST['btnSubmit'])) {

						$url = url;

						$parameter =array(
									'dev_id'    	   => $this->global_f->dev_id(),
									'actionId' 		   => _ecashtopaymaya,
				    				'regcode'          =>$this->user['R'],
				    				'transpass'	       =>$this->input->post('inputTpass'),
				    				'accountno'	       =>$this->input->post('inputAccountNumber'),
				    				'amount'	       =>$this->input->post('inputAmountTransaction'),
				    				'ip_address'       =>$this->ip,
				    				$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].$this->input->post('inputTpass'))
							    	); 				
					    $result = $this->curl->call($parameter,$url);
					    $data['API'] = json_decode($result,true);			    
					}

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_send/ecash_to_paymaya');
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');	

			} else{
				redirect('Main/');
			}

		}else {
			$this->session->sess_destroy();
			redirect('Login/');
		}

	}else {
			//$this->session->unset_userdata('user');
			//$this->session->sess_destroy();
			redirect('Main/');
		}

	}


	public function gcash_view()
	{	
		if ($this->user['A_CTRL']['remittance'] == 1 && $this->user['R'] != 'G5457340'){

		$data = array('menu' => 2,
					'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_send/gcash_view',$data);
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');
			}else {
				//$this->session->unset_userdata('user');
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
			//$this->session->unset_userdata('user');
			redirect('Main/');
		}
		
	}

	public function gcashcashin()
	{
		if ($this->user['A_CTRL']['remittance'] == 1){

		$data = array('menu' => 2,
					  'parent'=>'REMITTANCE' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;
			
			if (isset($_POST['btnSsearch'])) //Search Sender
			{
 				$search = $this->input->post('inputSearch');
 				$url = url;
				$parameter =array(
							'dev_id'    	    => $this->global_f->dev_id(),
							'actionId' 	 		=> _remittance_search,
							'ip_address'	    =>$this->ip,
		    				'search_key'   	 	=>$search,
		    				'regcode' 			=>$this->user['R']
		    				); 

			    $result = $this->curl->call($parameter,$url);
				$data['row'] = json_decode($result,true);

				if ($data['row']['S']==1) {
					$data['type'] = array('typeid'=>1,
										 'typedesc'=>'Sender');
				}
				
 			}
 			elseif (isset($_POST['btnBsearch']))  //Search Beneficiary
 			{
 				$search = $this->input->post('inputSearch');
 				$url = url;
				$parameter =array(
							'dev_id'     		=> $this->global_f->dev_id(),
							'actionId' 	 		=> _remittance_search,
							'ip_address'	    =>$this->ip,
		    				'search_key'   	 	=>$search,
		    				'regcode' 			=>$this->user['R']
		    				); 

			    $result = $this->curl->call($parameter,$url);
				$data['row'] = json_decode($result,true);

				$senderinfo = explode("|", $this->input->post('inputSenderHide'));

			
				$data['type'] = array('typeid' 				=>2,
									  'typedesc'			=>'Beneficiary',
									  'inputSenderName' 	=>$senderinfo[1],
									  'inputSender'      	=> $this->input->post('inputSenderHide'),
									  'inputSenderFname'    => $this->input->post('inputSenderHideFname'),
									  'inputSenderMname'    => $this->input->post('inputSenderHideMname'),
									  'inputSenderLname'    => $this->input->post('inputSenderHideLname'),
									  'inputSenderAddress'  => $this->input->post('inputSenderHideAddress'),
									  'inputSenderMobile'   => $this->input->post('inputSenderHideMobile'),
									  'inputBenefFname'    	=> $this->input->post('inputBenefHideFname'),
									  'inputBenefMname'    	=> $this->input->post('inputBenefHideMname'),
									  'inputBenefLname'    	=> $this->input->post('inputBenefHideLname'),
									  'inputBenefAddress'  	=> $this->input->post('inputBenefHideAddress'),
									  'inputBenefMobile'   	=> $this->input->post('inputBenefHideMobile')
									 );	
				
 			}elseif(isset($_POST['btnSubmit'])) // Process the SMARTMONEY
 			{
 				$INPUT_POST =$this->input->post(null,true);
 				// $T_VALUE =md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));
 				$url = url;
				$parameter =array(
								'dev_id'     		=> $this->global_f->dev_id(),
								'actionId' 	 		=> _remittance_send_gcash_cashin,
								'ip_address'	    =>$this->ip,
			    				'regcode'   		=>$this->user['R'],
			    				'transpass' 		=>$INPUT_POST['inputTpass'],
			    				'gcashAccnt'		=>$INPUT_POST['inputSnumber'],
			    				'senderFirstname'	=>$INPUT_POST['inputSenderFname'],
                                'senderLastname'	=>$INPUT_POST['inputSenderLname'],
                                'senderAddress'	    =>$INPUT_POST['inputSenderAddress'],
                                'senderMobile'	    =>$INPUT_POST['inputSenderMobile'],
                                'senderID'	        =>$INPUT_POST['inputidType'],
                                'senderMessage'	    =>$INPUT_POST['message'],
			    				'amount'			=>$INPUT_POST['inputAmount'],	
			    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
		    				    );
//                print_r($parameter);exit;
			    $result = $this->curl->call($parameter,$url);
//                print_r($result);exit;
				$data['API'] = json_decode($result,true);
				

 				$id = explode("|", $INPUT_POST['inputId']);
				
				$data['row'] = array (
							  'gcashAccnt'		 =>$INPUT_POST['inputSnumber'],
							  'senderFirstname'	 =>$INPUT_POST['inputSenderFname'],
							  'senderMidname'	 =>$INPUT_POST['inputSenderMname'],
							  'senderLastname'	 =>$INPUT_POST['inputSenderLname'],
							  'senderAddress'    =>$INPUT_POST['inputSenderAddress'],
							  'senderMobile'  	 =>$INPUT_POST['inputSenderMobile'],
							  'senderMessage'	 =>$INPUT_POST['message'],
							  'amount'			 =>$INPUT_POST['inputAmount'],
							  'inputBeneficiary' =>$INPUT_POST['inputBeneficiary'],
							  'benefFirstname'	 =>$INPUT_POST['inputBenefFname'],
							  'benefMidname'	 =>$INPUT_POST['inputBenefMname'],
							  'benefLastname'	 =>$INPUT_POST['inputBenefLname'],
							  'benefAddress'     =>$INPUT_POST['inputBenefAddress'],
							  'benefMobile'  	 =>$INPUT_POST['inputBenefMobile'],
							  'senderid'     	 =>$id[0],
							  'benefeciaryid'    =>$id[3],
							  'idtype'			 =>$INPUT_POST['inputidType'],
							  'idNo'		     =>$INPUT_POST['inputIdnumber'],
							  'transpass'        =>$INPUT_POST['inputTpass'],
							  'charge'           =>$data['API']['C'],
							  'TN'               =>$data['API']['TN'],
							  'SID'              =>$data['API']['SID']
							);
 			}elseif(isset($_POST['btnAddDetails']))// add sender and benificiary
 			{
 				$INPUT_POST =$this->input->post(null,true);

 				$url = url;
				$parameter =array(
					'dev_id'    		=> $this->global_f->dev_id(),
					'actionId' 	 		=> _remittance_add_user,
					'ip_address'	    =>$this->ip,
					'regcode'   		=>$this->user['R'],
					'transpass' 		=>$INPUT_POST['inputTpass'],
					'firstname'			=>$INPUT_POST['inputFname'],
					'middlename'		=>$INPUT_POST['inputMname'],
					'lastname'			=>$INPUT_POST['inputLname'],
					'mobileno'			=>$INPUT_POST['inputMobile'],
					'gender'			=>$INPUT_POST['selGender'],
					'email'				=>$INPUT_POST['inputEmail'],
					'address'			=>$INPUT_POST['inputAddr'],
					'country'			=>$INPUT_POST['selCountry'],
					'birthday'			=>$INPUT_POST['inputBdate'],
					$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
				);
				$result = $this->curl->call($parameter,$url);
				$data['result'] = json_decode($result,true);
	
 			}elseif (isset($_POST['btngcashcashinconfirm']))
 			{
 			
 				$INPUT_POST = $this->input->post(null,true);
 				
 				$url = url;
				$parameter =array(
					'dev_id'    	    => $this->global_f->dev_id(),
					'actionId' 	 		=> _remittance_send_gcash_cashin_confirm,
					'ip_address'	    =>$this->ip,
					'regcode'   		=>$this->user['R'],
					'transpass' 		=>$INPUT_POST['inputTpass'],
					'gcashno'			=>$INPUT_POST['inputgcashcashin'],
					'sender_id'			=>$INPUT_POST['inputSenderID'],
					'sender_firstname'	=>$INPUT_POST['inputSenderFname'],
					'sender_middlename'	=>$INPUT_POST['inputSenderMname'],
					'sender_lastname'	=>$INPUT_POST['inputSenderLname'],
					'sender_address'	=>$INPUT_POST['inputSenderAddress'],
					'sender_message'	=>$INPUT_POST['inputMessage'],
					'sender_mobile'		=>$INPUT_POST['inputSenderMobile'],
					'bene_id'			=>$INPUT_POST['inputBeneficiaryID'],
					'idnumber'			=>$INPUT_POST['inputIdnumber'],
					'idtype'			=>$INPUT_POST['inputIdtype'],
					'amount'			=>$INPUT_POST['inputAmount'],
					$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
				);

				$result = $this->curl->call($parameter,$url);

				$data['result'] = json_decode($result,true);

				if ($data['result']['S'] == 25){
					$data['API']['S'] = 1;
					$data['process'] = 1;

				}elseif ($data['result']['S'] == 1){

					$data['API']['S']  = "";
					$data['result'] = array( 'S' => 0, 'M' => $data['result']['M'] );
				}else {
					$data['API']['S'] = "";
					$data['result'] = array( 'S' => 0, 'M' => "Transaction failed. Please try again later" );
				}
					
 			}elseif (isset($_POST['btnConfirmActivation'])) 
 			{
 				$INPUT_POST = $this->input->post(null,true);
 				$url = url;
				$parameter =array(
					'dev_id'    	    => $this->global_f->dev_id(),
					'actionId' 	 		=> _remittance_send_gcash_cashin_confirm_activation,
					'ip_address'	    =>$this->ip,
					'regcode'   		=>$this->user['R'],
					'trackno'			=>$INPUT_POST['transactionno'],
					'vericode'			=>$INPUT_POST['verification_code'],
					$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'])
				);

				$result = $this->curl->call($parameter,$url);
				$data['result'] = json_decode($result,true);
				print_r($result);exit;

				if ($data['result']['S'] == 1) {

					$data['API']['S']  = "";
					$data['result'] = array( 'S'  => 1, 'M'  => $data['result']['M'], 'TN' => $data['result']['TN'] );
					$this->user['EC'] = $data['result']['EC'];
					$data['user'] = $this->global_f->get_user_session();

				}else {
					$data['API']['S'] = "";
					$data['result'] = array('S' => 0, 'M' => "Activation code failed. Please try again later" );
				}
 			}

			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('remittance/ecash_send/ecash_to_gcash_cashin');
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


	public function gcashcashin_checkref()
	{	
		if ($this->user['A_CTRL']['remittance'] == 1 && $this->user['R'] != 'G5457340'){

		$data = array('menu' => 2,
					'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;


				if (isset($_POST['btnGcashCashInCheck'])){

					$url = url;
					$parameter =array(
						'dev_id'     	   => $this->global_f->dev_id(),
						'actionId' 	 	   => ___,
						'ip_address'	   => $this->ip,
						'regcode'          =>$this->user['R'],
						'reference_no'	   =>$this->input->post('inputTrackno'),
						$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
					);

					$result = $this->curl->call($parameter,$url);
					$data['API'] = json_decode($result,true);
					//var_dump($data['API']);exit;
					$data['row'] = array(
						'inputReferenceNo'	   =>$this->input->post('inputTrackno')
					);

				}elseif (isset($_POST['btnGcashCashInConfirm'])){

				}

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_send/ecash_to_gcashcashin_checkref',$data);
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');
			}else {
				//$this->session->unset_userdata('user');
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
			//$this->session->unset_userdata('user');
			redirect('Main/');
		}
		
	}


//cebuana added 01/23/2018

	
	public function cebuana_index()
	{	
		if ($this->user['A_CTRL']['remittance'] == 1 && $this->user['A_CTRL']['remittance_cebuana'] == 1){

		$data = array('menu' => 2,
					'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_send/cebuana_main_panel');
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');	

			}else {
				//$this->session->unset_userdata('user');
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
			//$this->session->unset_userdata('user');
			redirect('Main/');
		}
		
	}

	public function cebuana_checkref()
	{

		if ($this->user['A_CTRL']['remittance'] == 1 && $this->user['A_CTRL']['remittance_cebuana'] == 1){

			$data = array('menu' => 2,
						  'parent'=>'REMITTANCE' );
			
			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['user'] = $this->user;
				
	 			if(isset($_POST['btnConfirmActivation'])){

	 				$url = url;
					$parameter =array(
									'dev_id'    	    => $this->global_f->dev_id(),
									'actionId' 	 		=> _unhold_cebuana_send,
									'ip_address'	    =>$this->ip,
				    				'regcode'   		=>$this->user['R'],
				    				'trackno'			=>$this->input->post('transactionno'),
				    				'vcode'				=>$this->input->post('verification_code'),
				    				'ip'				=>$this->ip,
				    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'])
			    				    );
					 	$result = $this->curl->call($parameter,$url);
						$results = json_decode($result,true);

						if ($results['S'] == 1) {
							$data['results'] = array(
							    				'S'  => 1,
							    				'M'  => $results['M'],
							    				'TN' => $results['TN'],
							    				'RF' => $results['RF']
				    							);
						}elseif ($results['S'] == 2) {
							$data['results'] = array(
							    				'S'  => 4,
							    				'M'  => $results['M']
				    							);
						}else {
				    		$data['results'] = array(
								    				'S'  => 0,
								    				'M'  => $results['M']
				    								);
					   	}

	 			}

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_send/cebuana_checkref');
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');

			}else {
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
				redirect('Main/');
		}

	}

	public function get_beneficiary(){
		$senderid = $this->uri->segment(3);

		$url = url;
		$parameter =array(
			'dev_id'     	   => $this->global_f->dev_id(),
			'actionId' 	 	   => _search_beneficiary,
			'ip_address'	   => $this->ip,
			'regcode'          =>$this->user['R'],
			'sender_id'	   	   =>$senderid
		);
		$result = $this->curl->call($parameter,$url);
		$response= json_decode($result,true);

		echo json_encode($response);
	}

	public function get_currency(){

		$url = url;
		$parameter =array(
			'dev_id'     	   => $this->global_f->dev_id(),
			'actionId' 	 	   => _fetch_currency,
			'ip_address'	   => $this->ip,
			'regcode'          =>$this->user['R']
		);
		$result = $this->curl->call($parameter,$url);
		$response= json_decode($result,true);

		echo json_encode($response);
	}

	public function get_domestic_rates(){
		$currencyid = $this->uri->segment(3);
		$amount = $this->uri->segment(4);

		$url = url;
		$parameter =array(
			'dev_id'     	   => $this->global_f->dev_id(),
			'actionId' 	 	   => _get_domestic_rates,
			'ip_address'	   => $this->ip,
			'regcode'          =>$this->user['R'],
			'currency_id'      =>$currencyid,
			'amount'      	   =>$amount
		);
		$result = $this->curl->call($parameter,$url);
		$response= json_decode($result,true);

		echo json_encode($response);
	}

	public function ecashtocebuana()
	{
		// ini_set('display_errors', 1);
		// ini_set('display_startup_errors', 1);
		// error_reporting(E_ALL);
		if ($this->user['A_CTRL']['remittance'] == 1 && $this->user['A_CTRL']['remittance_cebuana'] == 1){

			$data = array('menu' => 2,
						  'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;

				if (isset($_POST['btnSsearch'])) //Search Sender
				{
	 				$url = url;
					$parameter =array(
								'dev_id'    	    => $this->global_f->dev_id(),
								'actionId' 	 		=> _search_sender,
								'ip_address'	    =>$this->ip,
			    				'fname'   	 		=>$this->input->post('senderFname'),
			    				'lname'   	 		=>$this->input->post('senderLname'),
			    				'client_no'   	 	=>$this->input->post('senderClientNo'),
			    				'regcode' 			=>$this->user['R']
			    				); 

				    $result = $this->curl->call($parameter,$url);
					$data['fetchdata'] = json_decode($result,true);

					if ($data['fetchdata']['S']==1) {
						$data['type'] = array('typeid'=>1,
											 'typedesc'=>'Sender');
					}

	 			}
	 			elseif(isset($_POST['btnSubmit'])){

	 				$sender = explode("|", $this->input->post('hiddenSenderDetails'));
	 				$beneficiary = explode("|", $this->input->post('hiddenBeneDetails'));

	 				$url = url;
					$parameter =array(
								'dev_id'    	    => $this->global_f->dev_id(),
								'actionId' 	 		=> _cebuana_send,
								'ip_address'	    =>$this->ip,
			    				'sender_fname'   	=>$sender[2],
			    				'sender_lname'   	=>$sender[4],
			    				'sender_mname'   	=>$sender[3],
			    				'beneficiary_id'   	=>$beneficiary[0],
			    				'beneficiary_fname' =>$beneficiary[1],
			    				'beneficiary_lname' =>$beneficiary[3],
			    				'beneficiary_mname' =>$beneficiary[2],
			    				'regcode' 			=>$this->user['R'],
			    				'currency_id' 		=>$this->input->post('currency_id'),
			    				'amount' 			=>$this->input->post('iamount'),
			    				'transpass' 		=>$this->input->post('tpass'),
			    				'ip'	    		=>$this->ip,
				    			$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('tpass')))
			    				); 
				    $result = $this->curl->call($parameter,$url);
					$results = json_decode($result,true);
					// print_r($result); exit();

				    if ($results['S'] == 1){  
						$this->user['EC'] = $results['EC'];						 
						$data['user'] = $this->global_f->get_user_session();
			    		$data['results'] = array(
			    				'S'  => 1,
			    				'M'  => $results['M'],
			    				'TN' => $results['TN'],
			    				'RF' => $results['RF'],
			    				'URL' => url_mobilereports.'/cebuana_remittance/domestic_sending_receipt/'
			    			);
				    }elseif ($results['S'] == 2) { //OTP
			    		$data['results'] = array(
			    				'S'  => 2,
			    				'M'  => $results['M'],
			    				'TN' => $results['TN']
			    			);
			    		$data['process'] = 1;
				    }elseif ($results['S'] == 4) { 
			    		$data['results'] = array(
			    				'S'  => 4,
			    				'M'  => $results['M']
			    			);	
				    }else{
			    		$data['results'] = array(
			    				'S'  => 0,
			    				'M'  => $results['M']
			    			);
				    }

	 			}
	 			elseif(isset($_POST['btnConfirmActivation'])){

	 				$url = url;
					$parameter =array(
									'dev_id'    	    => $this->global_f->dev_id(),
									'actionId' 	 		=> _unhold_cebuana_send,
									'ip_address'	    =>$this->ip,
				    				'regcode'   		=>$this->user['R'],
				    				'trackno'			=>$this->input->post('transactionno'),
				    				'vcode'				=>$this->input->post('verification_code'),
				    				'ip'				=>$this->ip,
				    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'])
			    				    );
					 	$result = $this->curl->call($parameter,$url);
						$results = json_decode($result,true);
						// var_dump($results,$result);exit();

						if ($results['S'] == 1) {
							$data['results'] = array(
							    				'S'  => 1,
							    				'M'  => $results['M'],
							    				'TN' => $results['TN'],
							    				'RF' => $results['RF']
				    							);
						}elseif ($results['S'] == 2) {
							$data['results'] = array(
							    				'S'  => 4,
							    				'M'  => $results['M']
				    							);
						}else {
				    		$data['results'] = array(
								    				'S'  => 0,
								    				'M'  => $results['M']
				    								);
					   	}

	 			}
	 			elseif(isset($_POST['btnAddDetails'])){

					if($this->input->post('refSenderID') == 1){ 
						$actionId = _register_sender; 
						$regtype = 'Sender';
					} else{
					 	$actionId = _register_beneficiary; 
					 	$regtype = 'Beneficiary';
					}

	 				$url = url;
					$parameter =array(
									'dev_id'    	    => $this->global_f->dev_id(),
									'actionId' 	 		=> $actionId,
									'ip_address'	    =>$this->ip,
				    				'regcode'   		=>$this->user['R'],
				    				'sender_id'			=>$this->input->post('refSenderID'),
				    				'fname'				=>$this->input->post('inputFname'),
				    				'lname'				=>$this->input->post('inputLname'),
				    				'mname'				=>$this->input->post('inputMname'),
				    				'birthdate'			=>$this->input->post('inputBdate'),
				    				'mobile'			=>$this->input->post('inputMobile'),
				    				'transpass'			=>$this->input->post('inputTpass'),
				    				'ip'				=>$this->ip,
				    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
			    				    );

						// var_dump($parameter); die;

					 	$result = $this->curl->call($parameter,$url);
						$results = json_decode($result,true);

						if ($results['S'] == 1) {
				    		$data['results'] = array(
								    				'S'  => 1,
								    				'M'  => $regtype.' registration is successful.',
								    				'R'  => 1
				    								);
				    	}else{
				    		$data['results'] = array(
								    				'S'  => 0,
								    				'M'  => $results['M']
				    								);
				    	}
	 			}
				//  print_r($data['results']);
				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_send/ecash_to_cebuana');
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

	function otp_cebuana_resend()
	{
		if (isset($_POST['trackno'])){
			$url = url;
			$parameter = array( 'dev_id'     		=>$this->global_f->dev_id(),
		    				 	'ip_address' 		=>$this->ip,
		    					 'actionId' 	 	=> _otp_cebuana_resend,
    							 'regcode'   	 	=>$this->user['R'],
		    					 'trackno'    		=>$_POST['trackno'],
		    					 'ip'    			=>$this->ip,
		    					 $this->user['SKT']	 =>md5($this->user['R'].$this->user['SKT'])
			    				  );
		    $result = $this->curl->call($parameter,$url);
		    $API = json_decode($result,true);
			$result = array(
							'S' => $API['S'],
							'M' => $API['M']
							);
			
		 }else{
			$result = array('S' => 0, 'M' => 'Invalid input');
		}

		echo json_encode($result);
	}

	public function cebuana_cancel()
	{
		if ($this->user['A_CTRL']['remittance'] == 1){

		$data = array('menu' => 2,
					 'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;
					
					if (isset($_POST['btnCebuanaCheck'])){
						$url = url;
						$parameter = array(
									'dev_id'    	   => $this->global_f->dev_id(),
									'actionId' 	 	   => _cebuana_checkref,
									'ip_address'	   =>$this->ip,
									'regcode'          =>$this->user['R'],
									'ctrl_no'		   =>$this->input->post('inputReferenceNo'),
									'mode_mp'	       =>'payout',
									'type'			   =>'cancel',
									$this->user['SKT'] =>md5($this->user['R'].$this->user['SKT'].$this->input->post('inputReferenceNo'))
									);
					    $result = $this->curl->call($parameter,$url);
					    $data['API'] = json_decode($result,true);
					    $data['details'] = $data['API']['T_DATA'];

		    			$data['ctrlnumber'] = $this->input->post('inputReferenceNo');
					    

					}elseif (isset($_POST['btnCebuanaCancel'])){
	 			
		 				$url = url;
						$parameter =array(
									'dev_id'     		=> $this->global_f->dev_id(),
									'actionId' 	 		=> _cebuana_cancel,
				    				'regcode'   		=>$this->user['R'],
				    				'transpass' 		=>$this->input->post('inputTranspass'),
				    				'ctrl_no'	    	=>$this->input->post('controlnumber'),
				    				'ip_address'		=>$this->ip,
				    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTranspass')))
			    				    );
					 	$result = $this->curl->call($parameter,$url);
						$data['result'] = json_decode($result,true);

						if ($data['result']['EC']  != "") {
						 	$this->user['EC'] = $data['result']['EC'];
							$data['user'] = $this->global_f->get_user_session();
						 } 

	 				}elseif (isset($_POST['btnCebuanaRefund'])){

		 				$url = url;
						$parameter =array(
									'dev_id'     		=> $this->global_f->dev_id(),
									'actionId' 	 		=> _cebuana_refund,
				    				'regcode'   		=>$this->user['R'],
				    				'transpass' 		=>$this->input->post('inputTranspass'),
				    				'ctrl_no'	    	=>$this->input->post('controlnumber'),
				    				'ip_address'		=>$this->ip,
				    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTranspass')))
			    				    );
					 	$result = $this->curl->call($parameter,$url);
						$data['result'] = json_decode($result,true);

						if ($data['result']['EC']  != "") {
						 	$this->user['EC'] = $data['result']['EC'];
							$data['user'] = $this->global_f->get_user_session();
						 } 

	 				}


				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_send/cebuana_cancel');
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

	function get_amendment_fee(){

		$url = url;
		$parameter =array(
			'dev_id'     	   => $this->global_f->dev_id(),
			'actionId' 	 	   => _cebuana_amend_fee,
			'ip_address'	   => $this->ip,
			'amount'		   => $this->input->post('amount'),
			'cur_id'		   => $this->input->post('curid'),
			'regcode'          => $this->user['R']
		);
		$result = $this->curl->call($parameter,$url);
		$response= json_decode($result,true);

		echo json_encode($response);
	}


	function add_beneficiary()
	{
		$url = url;
		$parameter =array(
						'dev_id'    	    => $this->global_f->dev_id(),
						'actionId' 	 		=> _register_beneficiary,
						'ip_address'	    =>$this->ip,
	    				'regcode'   		=>$this->user['R'],
	    				'sender_id'			=>$this->input->post('refSenderID'),
	    				'fname'				=>$this->input->post('inputFname'),
	    				'lname'				=>$this->input->post('inputLname'),
	    				'mname'				=>$this->input->post('inputMname'),
	    				'birthdate'			=>$this->input->post('inputBdate'),
	    				'mobile'			=>substr($this->input->post('inputMobile'), 1),
	    				'transpass'			=>$this->input->post('inputTpass'),
	    				'ip'				=>$this->ip,
	    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
    				    );

		 	$result = $this->curl->call($parameter,$url);
			$results = json_decode($result,true);

			if ($results['S'] == 1) {
	    		$response = array(
			    				'S'  => 1,
			    				'M'  => 'Beneficiary registration is successful.',
	    						);
	    	}else{
	    		$response = array(
				    			'S'  => 0,
				    			'M'  => $results['M']
    							);
	    	}

	    	echo json_encode($response);

	}

	public function cebuana_amend()
	{
		if ($this->user['A_CTRL']['remittance'] == 1){

		$data = array('menu' => 2,
					 'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;
					
					if (isset($_POST['btnCebuanaCheck'])){
						$url = url;
						$parameter = array(
									'dev_id'    	   => $this->global_f->dev_id(),
									'actionId' 	 	   => _cebuana_checkref,
									'ip_address'	   =>$this->ip,
									'regcode'          =>$this->user['R'],
									'ctrl_no'		   =>$this->input->post('inputReferenceNo'),
									'mode_mp'	       =>'payout',
									'type'		       =>'amend',
									$this->user['SKT'] =>md5($this->user['R'].$this->user['SKT'].$this->input->post('inputReferenceNo'))
									);
					    $result = $this->curl->call($parameter,$url);
					    $data['API'] = json_decode($result,true);
					    $data['details'] = $data['API']['T_DATA'];

		    			$data['ctrlnumber'] = $this->input->post('inputReferenceNo');   

					}elseif (isset($_POST['btnCebuanaAmmendConfirm'])){
	 					$beneinfo = explode("|", $this->input->post('inputAmmendDetails'));

		 				$url = url;
						$parameter =array(
									'dev_id'     		=> $this->global_f->dev_id(),
									'actionId' 	 		=> _cebuana_amend,
				    				'regcode'   		=>$this->user['R'],
				    				'transpass' 		=>$this->input->post('inputTranspass'),
				    				'ctrl_no'	    	=>$beneinfo[4],
				    				'bene_id'	    	=>$beneinfo[0],
				    				'bene_f'	    	=>$beneinfo[1],
				    				'bene_m'	    	=>$beneinfo[2],
				    				'bene_l'	    	=>$beneinfo[3],
				    				'ip_address'		=>$this->ip,
				    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTranspass')))
			    				    );
					 	$result = $this->curl->call($parameter,$url);
						$data['result'] = json_decode($result,true);

	 				}


				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_send/cebuana_amend');
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

	
	public function ecashtowestern()
	{
		// if($user['R'] == "1234567"){
			if ($this->user['A_CTRL']['remittance'] == 1 && $this->user['A_CTRL']['remittance_westernunion_send'] == 1){

			$data = array('menu' => 2,
						'parent'=>'REMITTANCE' );

				if ($this->user['S'] == 1 && $this->user['R'] !=""){

					$data['user'] = $this->user;
					$url = url;
					$data['process'] = 0;

					$parameter =array(
							'dev_id'     		=> $this->global_f->dev_id(),
							'actionId' 	 		=> _fetch_countries_iso,
							'regcode' 			=>$this->user['R'],
							'ip_address'		=>$this->ip
							); 

					$result = $this->curl->call($parameter,$url);
					$results = json_decode($result,true);
					$data['country'] = $results['T_DATA'];
					$data['currency'] = $results['F_DATA'];

					if (isset($_POST['btnSsearch'])) //Search Sender
					{
						$search = $this->input->post('inputSearch');
						$parameter =array(
									'dev_id'     		=> $this->global_f->dev_id(),
									'actionId' 	 		=> _remittance_search,
									'search_key'   	 	=>$search,
									'regcode' 			=>$this->user['R'],
									'ip_address'		=>$this->ip
									); 

						$result = $this->curl->call($parameter,$url);
						$data['row'] = json_decode($result,true);

						if ($data['row']['S']==1) {
							$data['type'] = array('typeid'=>1,
												'typedesc'=>'Sender');
						}
						
					
					}elseif (isset($_POST['btnBsearch']))  //Search Benificiary
					{
						$search = $this->input->post('inputSearch');
						$parameter =array(
									'dev_id'     		=> $this->global_f->dev_id(),
									'actionId' 	 		=> _remittance_search,
									'search_key'   	 	=>$search,
									'regcode' 			=>$this->user['R'],
									'ip_address'		=>$this->ip
									); 

						$result = $this->curl->call($parameter,$url);
						$data['row'] = json_decode($result,true);

						$senderinfo = explode("|", $this->input->post('inputSenderHide'));
						
					
						$data['type'] = array('typeid'=>2,
											'typedesc'=>'Benificiary',
											'inputSenderName' =>$senderinfo[1],
											'inputSender'    => $this->input->post('inputSenderHide'));	
					
					}elseif(isset($_POST['btnAddDetails']))// add sender and benificiary
					{
						$INPUT_POST =$this->input->post(null,true);

						$T_VALUE =md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));
						$parameter =array(
										'dev_id'    	    => $this->global_f->dev_id(),
										'ip_address'		=>$this->ip,
										'actionId' 	 		=> _remittance_add_user,
										'regcode'   		=>$this->user['R'],
										'transpass' 		=>$INPUT_POST['inputTpass'],
										'firstname'			=>$INPUT_POST['inputFname'],
										'middlename'		=>$INPUT_POST['inputMname'],
										'lastname'			=>$INPUT_POST['inputLname'],
										'mobileno'			=>$INPUT_POST['inputMobile'],	
										'gender'			=>$INPUT_POST['selGender'],
										'email'				=>$INPUT_POST['inputEmail'],
										'address'			=>$INPUT_POST['inputAddr'],
										'country'			=>$INPUT_POST['selCountry'],
										'birthday'			=>$INPUT_POST['inputBdate'],
										$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
										);
							$result = $this->curl->call($parameter,$url);
							$data['API'] = json_decode($result,true);
							
					}


					$this->load->view('layout/header',$data);
					$this->load->view('element/top_header');
					$this->load->view('element/wrapper_header');
					$this->load->view('element/left_panel');
					$this->load->view('remittance/ecash_send/ecash_to_western');
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
			
		// }else {
		// 		//$this->session->unset_userdata('user');
		// 		//$this->session->sess_destroy();
		// 		redirect('Main/');
		// 	}

	}

	function get_country_charge(){
		$url = url;
		$parameter =array(
			'dev_id'     	   => $this->global_f->dev_id(),
			'actionId' 	 	   => _fetch_country_charge,
			'ip_address'	   => $this->ip,
			'regcode'          =>$this->user['R'],
			'country'	   	   =>$this->input->post('country'),
			'amount'	   	   =>$this->input->post('amount'),
			'currency'	   	   =>$this->input->post('currency')
		);
		$result = $this->curl->call($parameter,$url);
		$response= json_decode($result,true);

		echo json_encode($response);
	}

	function ecash_to_western_send(){
		$url = url;
		$parameter =array(
			'dev_id'    	    => $this->global_f->dev_id(),
			'ip_address'		=>$this->ip,
			'actionId' 	 		=> _ecash_to_western,
			'regcode'   		=>$this->user['R'],
			'transpass' 		=>$this->input->post('transpass'),
			'sender_id'			=>$this->input->post('sender_id'),
			'beneficiary_id'	=>$this->input->post('beneficiary_id'),
			'amount'			=>$this->input->post('amount'),
			'currency'			=>$this->input->post('currency'),
			'primaryId'			=>$this->input->post('primaryId'),
			'secondaryId'		=>$this->input->post('secondaryId'),
			'tertiaryId'		=>$this->input->post('tertiaryId'),
			'country'			=>$this->input->post('country'),
			'occupation'		=>$this->input->post('occupation'),
			'relationbene'		=>$this->input->post('relationbene'),
			'empname'			=>$this->input->post('empname'),
			'fundsrc'			=>$this->input->post('fundsrc'),
			'countrybirth'		=>$this->input->post('countrybirth'),
			'nationality'		=>$this->input->post('nationality'),
			$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('transpass')))
		    );
		$result = $this->curl->call($parameter,$url);
		$response= json_decode($result,true);

		echo json_encode($response);
	}

	public function logs_ecashtowestern($tn)
	{
		if ($this->user['A_CTRL']['remittance'] == 1){

		$data = array('menu' => 2,
					  'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;
				$url = url;

				if ($tn){

						$parameters = array(
							'dev_id'     => $this->global_f->dev_id(),
							'regcode' 	 => $this->user['R'],
							'actionId' 	 =>_get_status_pending_western,
							'ip_address' =>$this->ip,
							'trackno'    =>$tn
						);
						$data['API'] = json_decode($this->curl->call($parameters,$url),true);
				}

 				$parameter =array(
						'dev_id'     	=> $this->global_f->dev_id(),
						'actionId' 	 	=> _fetch_pending_western,
	    				'regcode' 		=>$this->user['R'],
	    				'ip_address'	=>$this->ip
	    				); 

			    $result = $this->curl->call($parameter,$url);
				$data['results'] = json_decode($result,true);

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_send/ecashtowesternlogs');
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

	public function done_ecashtowestern()
	{
		if ($this->user['A_CTRL']['remittance'] == 1){

		$data = array('menu' => 2,
					  'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;
				$url = url;

 				$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId' 	 		=> _fetch_donecancelled_western,
	    				'regcode' 			=>$this->user['R'],
	    				'ip_address'		=>$this->ip
	    				); 

			    $result = $this->curl->call($parameter,$url);
				$data['results'] = json_decode($result,true);

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_send/ecashtowesterndonecancelled');
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


	// public function forextoecash()
	// {
	// 	if ($this->user['A_CTRL']['remittance'] == 1){

	// 	$data = array('menu' => 2,
	// 				  'parent'=>'REMITTANCE' );

	// 	if ($this->user['S'] == 1 && $this->user['R'] !=""){

	// 		$data['user'] = $this->user;

	// 		if (isset($_POST['btnSubmit'])) {
	// 				$url = url;
					
	// 				$parameter =array(
	// 							'dev_id'     		=> $this->global_f->dev_id(),
	// 							'actionId' 		 	=> _forextransfer_to_ecash_confirm,
	// 		    				'regcode'    		=> $this->user['R'],
	// 		    				'clientregcode'    	=> $this->input->post('inputDealersRegcode'),
	// 		    				'currency'	 		=> $this->input->post('forexcurrtype'),
	// 		    				'amount'	 		=> $this->input->post('inputAmountTransaction'),
	// 		    				'transpass'	 		=> $this->input->post('inputTpass'),
	// 		    				'ip_address' 		=> $this->ip,
	// 		    				$this->user['SKT'] 	=> md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
	// 					    	); 

	// 				 echo '<pre>';
	// 						print_r($parameter);
	// 					echo '</pre>';
	// 					// die;

	// 			    $result = $this->curl->call($parameter,$url);
	// 			    $data['API'] = json_decode($result,true);

	// 			    echo '<pre>';
	// 						print_r( $data['API'] );
	// 					echo '</pre>';

	// 			    if ($data['API']['S']  == 1) {
					 	
	// 				 	if($data['API']['C'] == 'SGD')
	// 				 	{
	// 				 		$this->user['SB'] = $data['API']['FA'];
	// 				 	}
	// 				 	elseif($data['API']['C'] == 'AED')
	// 				 	{
	// 				 		$this->user['AB'] = $data['API']['FA'];
	// 				 	}
	// 				 	elseif($data['API']['C'] == 'HKD')
	// 				 	{
	// 				 		$this->user['HKD'] = $data['API']['FA'];
	// 				 	}
	// 			 		else
	// 			 		{
	// 			 			$this->user['QB'] = $data['API']['FA'];
	// 			 		}
					 	
	// 				 	$this->user['EC'] = $data['API']['EC'];

	// 					$data['user'] = $this->global_f->get_user_session();
	// 				 } 
				 
	// 			}


	// 		$this->load->view('layout/header',$data);
	// 		$this->load->view('element/top_header');
	// 		$this->load->view('element/wrapper_header');
	// 		$this->load->view('element/left_panel');
	// 		$this->load->view('remittance/ecash_send/forex_to_ecash');
	// 		$this->load->view('element/wrapper_footer');
	// 		$this->load->view('layout/footer');	

	// 	}else {
	// 		//$this->session->unset_userdata('user');
	// 		$this->session->sess_destroy();
	// 		redirect('Login/');
	// 	}

	// }else {
	// 		//$this->session->unset_userdata('user');
	// 		//$this->session->sess_destroy();
	// 		redirect('Main/');
	// 	}	

	// }


	public function ecashtopaymaya()
	{
		if ($this->user['A_CTRL']['remittance'] == 1){

		$data = array('menu' => 2,
					  'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;
				$url = url;
				$data['process'] = 0;

				if (isset($_POST['btnSsearch'])) //Search Sender
				{
	 				$search = $this->input->post('inputSearch');
					$parameter =array(
								'dev_id'     		=> $this->global_f->dev_id(),
								'actionId' 	 		=> 'ups_paymaya_service_rev2/search_sender',
			    				'searchkey'   	 	=> $search,
			    				'regcode' 			=> $this->user['R'],
			    				'ip_address'		=> $this->ip
			    				); 

				    $result = $this->curl->call($parameter,$url);
					$data['row'] = json_decode($result,true);

					// echo '<pre>';
					// var_dump($data['row']); 
					// echo '</pre>';
					// die;

					if ($data['row']['S']==1) {
						$data['type'] = array('typeid'=>1,
											 'typedesc'=>'Sender');
					}
					
				 
	 			}elseif (isset($_POST['btnBsearch']))  //Search Benificiary
	 			{
	 				$search = $this->input->post('inputSearch');
					$parameter =array(
								'dev_id'     		=> $this->global_f->dev_id(),
								'actionId' 	 		=> 'ups_paymaya_service_rev2/search_beneficiary',
			    				'searchkey'   	 	=> $search,
			    				'regcode' 			=> $this->user['R'],
			    				'ip_address'		=> $this->ip
			    				); 

				    $result = $this->curl->call($parameter,$url);
					$data['row'] = json_decode($result,true);

					// echo '<pre>';
					// var_dump($data['row']); 
					// echo '</pre>';
					// die;
					
					$senderinfo = explode("|", $this->input->post('inputSenderHide'));
					
				
					$data['type'] = array('typeid'=>2,
										  'typedesc'=>'Benificiary',
										  'inputSenderName' =>$senderinfo[1],
										  'inputSender'    => $this->input->post('inputSenderHide'));	
				
	 			}elseif(isset($_POST['btnAddDetails']))// add sender
	 			{
	 				$INPUT_POST =$this->input->post(null,true);

					$parameter =array(
									'dev_id'    	    => $this->global_f->dev_id(),
									'ip_address'		=> $this->ip,
									'actionId' 	 		=> 'ups_paymaya_service_rev2/add_sender',
				    				'regcode'   		=> $this->user['R'],
				    				'transpass' 		=> $INPUT_POST['inputTpass'],
				    				'firstName'			=> $INPUT_POST['inputFname'],
				    				'middleName'		=> $INPUT_POST['inputMname'],
				    				'lastName'			=> $INPUT_POST['inputLname'],
				    				'mobileNumber'		=> '639'.$INPUT_POST['inputMobile'],	
				    				'nationality'		=> $INPUT_POST['inputNationality'],
				    				'birthDate'			=> $INPUT_POST['inputBdate'],
				    				'placeOfBirth'		=> $INPUT_POST['inputPlaceOfBirth'],
				    				'sourceOfIncome'	=> $INPUT_POST['inputSourceOfIncome'],
				    				'occupation'		=> $INPUT_POST['inputOccupation'],
				    				
				    				'prhouseNumber'		=> $INPUT_POST['inputprhouseNumber'],
				    				'prstreet'			=> $INPUT_POST['inputprstreet'],
				    				'prbarangay'		=> $INPUT_POST['inputprbarangay'],
				    				'prcity'			=> $INPUT_POST['inputprcity'],
				    				'prprovince'		=> $INPUT_POST['inputprprovince'],
				    				'przipCode'			=> $INPUT_POST['inputprzipCode'],
				    				'prcountry'			=> $INPUT_POST['inputprcountry'],
				    				
				    				'pmhouseNumber'		=> $INPUT_POST['inputpmhouseNumber'],
				    				'pmstreet'			=> $INPUT_POST['inputpmstreet'],
				    				'pmbarangay'		=> $INPUT_POST['inputpmbarangay'],
				    				'pmcity'			=> $INPUT_POST['inputpmcity'],
				    				'pmprovince'		=> $INPUT_POST['inputpmprovince'],
				    				'pmzipCode'			=> $INPUT_POST['inputpmzipCode'],
				    				'pmcountry'			=> $INPUT_POST['inputpmcountry'],
				    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].$this->input->post('inputTpass'))
			    				    );


					// echo '<pre>';
					// var_dump($parameter); 
					// echo '</pre>';
					// die;
					 	$result = $this->curl->call($parameter,$url);
						$data['API'] = json_decode($result,true);
						
					// 	echo '<pre>';
					// var_dump($data['API']); 
					// echo '</pre>';

					if ($data['API']['S']  == 1) { 
								
						unset($INPUT_POST);

						$array_msg = array('S'=>1,'M'=>$data['API']['M']);
						$this->session->set_flashdata('msgAdd',$array_msg);
						
						redirect($_SERVER['REQUEST_URI']);
					}

	 			}elseif(isset($_POST['btnAddBenefDetails']))// add benificiary
	 			{
	 				$INPUT_POST =$this->input->post(null,true);

	 				// $T_VALUE =md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));

					$parameter =array(
									'dev_id'    	    => $this->global_f->dev_id(),
									'ip_address'		=> $this->ip,
									'actionId' 	 		=> 'ups_paymaya_service_rev2/add_beneficiary',
				    				'regcode'   		=> $this->user['R'],
				    				'transpass' 		=> $INPUT_POST['inputTpass'],
				    				'firstName'			=> $INPUT_POST['inputFname'],
				    				'middleName'		=> $INPUT_POST['inputMname'],
				    				'lastName'			=> $INPUT_POST['inputLname'],
				    				'houseNumber'		=> $INPUT_POST['inputprhouseNumber'],	
				    				'street'			=> $INPUT_POST['inputprstreet'],
				    				'barangay'			=> $INPUT_POST['inputprbarangay'],
				    				'city'				=> $INPUT_POST['inputprcity'],
				    				'province'			=> $INPUT_POST['inputprprovince'],
				    				'zipCode'			=> $INPUT_POST['inputprzipCode'],
				    				'country'			=> $INPUT_POST['inputprcountry'],
				    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].$this->input->post('inputTpass'))
			    				    );


					// echo '<pre>';
					// var_dump($parameter); 
					// echo '</pre>';
					// die;
					 	$result = $this->curl->call($parameter,$url);
						$data['API'] = json_decode($result,true);
						
					// 	echo '<pre>';
					// var_dump($data['API']); 
					// echo '</pre>';

					if ($data['API']['S']  == 1) { 
								
						unset($INPUT_POST);

						$array_msg = array('S'=>1,'M'=>$data['API']['M']);
						$this->session->set_flashdata('msgAdd',$array_msg);
						
						redirect($_SERVER['REQUEST_URI']);
					}
	 			}
	 			elseif (isset($_POST['btnPaymayaUnhold']))// unhold
	 			{
	 				$INPUT_POST =$this->input->post(null,true);

	 				// $T_VALUE =md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));

					$parameter =array(
									'dev_id'    	    => $this->global_f->dev_id(),
									'ip_address'		=> $this->ip,
									'actionId' 	 		=> 'ups_paymaya_service_rev2/ecash_to_paymaya_unhold',
				    				'regcode'   		=> $this->user['R'],
				    				'transpass' 		=> $INPUT_POST['inputTpass'],
				    				'trackno'			=> $INPUT_POST['inputReferenceNo'],
				    				'vericode'			=> $INPUT_POST['inputVericode'],
				    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].$this->input->post('inputTpass'))
			    				    );


					// echo '<pre>';
					// var_dump($parameter); 
					// echo '</pre>';
					// die;
					 	$result = $this->curl->call($parameter,$url);
						$data['API'] = json_decode($result,true);
						
					// 	echo '<pre>';
					// var_dump($data['API']); 
					// echo '</pre>';

					if ($data['API']['S']  == 1) { 
								
						unset($INPUT_POST);

						$array_msg = array('S'=>1,'M'=>$data['API']['M'],'TN'=>$data['API']['TN'],'URL'=>$data['API']['URL']);
						$this->session->set_flashdata('msg',$array_msg);
						
						redirect($_SERVER['REQUEST_URI']);

					} elseif ($data['API']['S']  == 2) { 
								
						unset($INPUT_POST);

						$array_msg = array('S'=>2,'M'=>$data['API']['M']);
						$this->session->set_flashdata('msg',$array_msg);
						
						redirect($_SERVER['REQUEST_URI']);
					} else {
						$data['process'] = 2;
					}
	 			}

	 			$data['airports'] = json_decode($this->curl->call('',url_mobilereports.'/intl_airports2'),true);

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_send/ecash_to_paymaya_topup');
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
   
	function ecash_to_paymaya_send(){
		$url = url;
		$parameter =array(
			'dev_id'    	    => $this->global_f->dev_id(),
			'ip_address'		=>$this->ip,
			'actionId' 	 		=> 'ups_paymaya_service_rev2/ecash_to_paymaya',
			'regcode'   		=>$this->user['R'],
			'transpass' 		=>$this->input->post('transpass'),
			'accountno'			=>$this->input->post('accountno'),
			'amount'			=>$this->input->post('amount'),
			'sender_id'			=>$this->input->post('sender_id'),
			'channel'			=>$this->input->post('channel'),
			'sender'			=>$this->input->post('sender'),
			'beneficiary'		=>$this->input->post('beneficiary'),
			$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].$this->input->post('transpass'))
		    );

			// var_dump($parameter); 
		
		$result = $this->curl->call($parameter,$url);
		$response= json_decode($result,true);		
		
			// var_dump($response); 

		echo json_encode($response);
	}


	public function paymaya_checkrefno()
	{
		if ($this->user['A_CTRL']['remittance'] == 1){

		$data = array('menu' => 2,
					  'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;
				$url = url;
				$data['process'] = 0;

				if(isset($_POST['btnPaymayaCheck']))// submit
	 			{
	 				$INPUT_POST =$this->input->post(null,true);

	 				// $T_VALUE =md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));

					$parameter =array(
									'dev_id'    	    => $this->global_f->dev_id(),
									'ip_address'		=> $this->ip,
									'actionId' 	 		=> 'ups_paymaya_service_rev2/ecash_to_paymaya_check_ref',
				    				'regcode'   		=> $this->user['R'],
				    				'transpass' 		=> $INPUT_POST['inputTpass'],
				    				'trackingno'		=> $INPUT_POST['inputReferenceNo'],
				    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].$this->input->post('inputTpass'))
			    				    );


					// echo '<pre>';
					// var_dump($parameter); 
					// echo '</pre>';
					// die;
					 	$result = $this->curl->call($parameter,$url);
						$data['API'] = json_decode($result,true);
						
					// 	echo '<pre>';
					// var_dump($data['API']); 
					// echo '</pre>';

					if ($data['API']['S']  == 1) { 
								
						unset($INPUT_POST);

						$array_msg = array('S'=>1,'M'=>$data['API']['M'],'TN'=>$data['API']['TN'],'URL'=>$data['API']['URL']);
						$this->session->set_flashdata('msg',$array_msg);
						
						redirect($_SERVER['REQUEST_URI']);

					} elseif ($data['API']['S']  == 3) {
						$data['process'] = 2;

					}

	 			}
	 			elseif (isset($_POST['btnPaymayaUnhold']))// unhold
	 			{
	 				$INPUT_POST =$this->input->post(null,true);

	 				// $T_VALUE =md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));

					$parameter =array(
									'dev_id'    	    => $this->global_f->dev_id(),
									'ip_address'		=> $this->ip,
									'actionId' 	 		=> 'ups_paymaya_service_rev2/ecash_to_paymaya_unhold',
				    				'regcode'   		=> $this->user['R'],
				    				'transpass' 		=> $INPUT_POST['inputTpass'],
				    				'trackno'			=> $INPUT_POST['inputReferenceNo'],
				    				'vericode'			=> $INPUT_POST['inputVericode'],
				    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].$this->input->post('inputTpass'))
			    				    );


					// echo '<pre>';
					// var_dump($parameter); 
					// echo '</pre>';
					// die;
					 	$result = $this->curl->call($parameter,$url);
						$data['API'] = json_decode($result,true);
						
					// 	echo '<pre>';
					// var_dump($data['API']); 
					// echo '</pre>';

					if ($data['API']['S']  == 1) { 
								
						unset($INPUT_POST);

						$array_msg = array('S'=>1,'M'=>$data['API']['M'],'TN'=>$data['API']['TN'],'URL'=>$data['API']['URL']);
						$this->session->set_flashdata('msg',$array_msg);
						
						redirect($_SERVER['REQUEST_URI']);

					} elseif ($data['API']['S']  == 2) { 
								
						unset($INPUT_POST);

						$array_msg = array('S'=>2,'M'=>$data['API']['M']);
						$this->session->set_flashdata('msg',$array_msg);
						
						redirect($_SERVER['REQUEST_URI']);
					} else {
						$data['process'] = 2;
					}
	 			}

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_send/ecash_to_paymaya_checkrefno');
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

	public function paymaya_otp_resend()
	{
		if ($this->user['A_CTRL']['remittance'] == 1){

		$data = array('menu' => 2,
					  'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;
				$url = url;
				$data['process'] = 0;

				if(isset($_POST['btnPaymaya']))// submit
	 			{
	 				$INPUT_POST =$this->input->post(null,true);

	 				// $T_VALUE =md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));

					$parameter =array(
									'dev_id'    	    => $this->global_f->dev_id(),
									'ip_address'		=> $this->ip,
									'actionId' 	 		=> 'ups_paymaya_service_rev2/ecash_to_paymaya_otp_resend',
				    				'regcode'   		=> $this->user['R'],
				    				'transpass' 		=> $INPUT_POST['inputTpass'],
				    				'trackno'			=> $INPUT_POST['inputReferenceNo'],
				    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].$this->input->post('inputTpass'))
			    				    );


					echo '<pre>';
					var_dump($parameter); 
					echo '</pre>';
					// die;
					 	$result = $this->curl->call($parameter,$url);
						$data['API'] = json_decode($result,true);
						
						echo '<pre>';
					var_dump($data['API']); 
					echo '</pre>';

					if ($data['API']['S']  == 1) { 
								
						unset($INPUT_POST);

						$array_msg = array('S'=>1,'M'=>$data['API']['M']);
						$this->session->set_flashdata('msg',$array_msg);
						
						redirect($_SERVER['REQUEST_URI']);
					}

	 			}

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_send/ecash_to_paymaya_otp_resend');
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

	function ecash_to_paymaya_otp_resend(){
		$url = url;
		$parameter =array(
			'dev_id'    	    => $this->global_f->dev_id(),
			'ip_address'		=> $this->ip,
			'actionId' 	 		=> 'ups_paymaya_service_rev2/ecash_to_paymaya_otp_resend',
			'regcode'   		=> $this->user['R'],
			// 'transpass' 		=> $INPUT_POST['inputTpass'],
			'trackno'			=> $this->input->post('trackno'),
			$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'])
		    );

			// var_dump($parameter); 
		
		$result = $this->curl->call($parameter,$url);
		$response= json_decode($result,true);		
		
		// var_dump($response); 

		echo json_encode($response);
	}

	public function paymaya_unhold()
	{
		if ($this->user['A_CTRL']['remittance'] == 1){

		$data = array('menu' => 2,
					  'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;
				$url = url;
				$data['process'] = 0;

				if(isset($_POST['btnPaymaya']))// submit
	 			{
	 				$INPUT_POST =$this->input->post(null,true);

	 				// $T_VALUE =md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));

					$parameter =array(
									'dev_id'    	    => $this->global_f->dev_id(),
									'ip_address'		=> $this->ip,
									'actionId' 	 		=> 'ups_paymaya_service_rev2/ecash_to_paymaya_unhold',
				    				'regcode'   		=> $this->user['R'],
				    				'transpass' 		=> $INPUT_POST['inputTpass'],
				    				'trackno'			=> $INPUT_POST['inputReferenceNo'],
				    				'vericode'			=> $INPUT_POST['inputVericode'],
				    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].$this->input->post('inputTpass'))
			    				    );


					echo '<pre>';
					var_dump($parameter); 
					echo '</pre>';
					// die;
					 	$result = $this->curl->call($parameter,$url);
						$data['API'] = json_decode($result,true);
						
						echo '<pre>';
					var_dump($data['API']); 
					echo '</pre>';

					if ($data['API']['S']  == 1) { 
								
						unset($INPUT_POST);

						$array_msg = array('S'=>1,'M'=>$data['API']['M']);
						$this->session->set_flashdata('msg',$array_msg);
						
						redirect($_SERVER['REQUEST_URI']);

					} elseif ($data['API']['S']  == 2) { 
								
						unset($INPUT_POST);

						$array_msg = array('S'=>2,'M'=>$data['API']['M']);
						$this->session->set_flashdata('msg',$array_msg);
						
						redirect($_SERVER['REQUEST_URI']);
					}

	 			}

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_send/ecash_to_paymaya_unhold');
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

	public function add_newid_payout(){
		/* */
		$BENEFNAME = $this->input->post('benefname');
		$BENEMNAME = $this->input->post('benemname');
		$BENELNAME = $this->input->post('benelname');
		$BENEBDATE = $this->input->post('benebdate');
		
		$NEWIDTYPE = $this->input->post('newidtype');
		$NEWIDNUMBER = $this->input->post('newidnumber');
		$NEWEXPIRYDATE = $this->input->post('newexpirydate');

		$CREATE_NEW = $this->input->post('create_new');

		$SELVALIDID1 = $this->input->post('selvalidID1');
		$SELVALIDID2 = $this->input->post('selvalidID2');
		$SELVALIDID3 = $this->input->post('selvalidID3');

		$TRANSTYPE = $this->input->post('transtype');


		$datetoday = date("Y-m-d");
		
		if($NEWEXPIRYDATE > $datetoday || $NEWEXPIRYDATE == 'NO EXPIRY')
		{

			if($NEWEXPIRYDATE == 'NO EXPIRY')$NEWEXPIRYDATE = '2100-01-01';
			if ($_FILES['file']['error'] == 0){

				if($_FILES['file']['size'] < 2*MB) {
					$url = $_FILES["file"]["tmp_name"];
					if($_FILES['file']['size'] > 1*MB){
						$old_size = $_FILES['file']['size'];
						$urltmp = sys_get_temp_dir().'/tmp.jpg';
						$filename = $this->compress_image($_FILES["file"]["tmp_name"], $urltmp, 75);
						$new_size = filesize($urltmp);
						if($new_size < $old_size)$url = $urltmp;
					
					}
					$image_id = md5($this->user['R'].$BENEFNAME.$BENEMNAME.$BENELNAME.$BENEBDATE.$NEWIDTYPE.$NEWIDNUMBER.$NEWEXPIRYDATE) . '_web.jpg';

					$ch = curl_init();
					$localfile = $url;
					$fp = fopen($localfile, 'r');
					curl_setopt($ch, CURLOPT_URL, 'ftp://'.ftp_server_radius.':800/Remittance/'.$image_id);
					curl_setopt($ch, CURLOPT_USERPWD, "argel:argel_argel!!!");
					curl_setopt($ch, CURLOPT_UPLOAD, 1);
					curl_setopt($ch, CURLOPT_INFILE, $fp);
					curl_setopt($ch, CURLOPT_INFILESIZE, filesize($localfile));
					curl_exec ($ch);
					$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
					$error_no = curl_errno($ch);
					curl_close ($ch);

					$attachment = 'ftp://frequest:frequest@'.ftp_server_radius.':800/Remittance/'.$image_id;
					// print_r($_POST);
					// print_r($_FILES);

					
					$data['user'] = $this->user;

					if($CREATE_NEW == 1)
					{
						$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId'         	=> _update_remitpayout_id, 
						'ip_address'		=> $this->ip,
						'fname'				=> $BENEFNAME, 
						'mname'				=> $BENEMNAME,
						'lname'				=> $BENELNAME,
						'birthdate'			=> $BENEBDATE,
						'idnumber'			=> $NEWIDNUMBER,
						'idtype'			=> $NEWIDTYPE,
						'expiry'			=> $NEWEXPIRYDATE,
						'attachment'		=> $attachment,
						'regcode'           => $this->user['R'],
						'ftp_server'         => ftp_server_radius,
						'ftp_port'           => 800,
						'ftp_user'           => 'argel',
						'ftp_pass'           => 'argel_argel!!!',
						'ftp_path'           => '/Remittance/',
						'ftp_filename'       => $image_id,
						'id'				=> 	$SELVALIDID1,
						'transtype'         => $TRANSTYPE,
						$this->user['SKT']  => md5($this->user['R'].$this->user['SKT'])
						); 
					}
					elseif($CREATE_NEW == 2)
					{
						$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId'         	=> _update_remitpayout_id, 
						'ip_address'		=> $this->ip,
						'fname'				=> $BENEFNAME, 
						'mname'				=> $BENEMNAME,
						'lname'				=> $BENELNAME,
						'birthdate'			=> $BENEBDATE,
						'idnumber'			=> $NEWIDNUMBER,
						'idtype'			=> $NEWIDTYPE,
						'expiry'			=> $NEWEXPIRYDATE,
						'attachment'		=> $attachment,
						'regcode'           => $this->user['R'],
						'ftp_server'        => ftp_server_radius,
						'ftp_port'          => 800,
						'ftp_user'          => 'argel',
						'ftp_pass'          => 'argel_argel!!!',
						'ftp_path'          => '/Remittance/',
						'ftp_filename'      => $image_id,
						'id'				=> $SELVALIDID2,
						'transtype'         => $TRANSTYPE,
						$this->user['SKT']  => md5($this->user['R'].$this->user['SKT'])
						); 
					}
					elseif($CREATE_NEW == 3)
					{
						$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId'         	=> _update_remitpayout_id, 
						'ip_address'		=> $this->ip,
						'fname'				=> $BENEFNAME, 
						'mname'				=> $BENEMNAME,
						'lname'				=> $BENELNAME,
						'birthdate'			=> $BENEBDATE,
						'idnumber'			=> $NEWIDNUMBER,
						'idtype'			=> $NEWIDTYPE,
						'expiry'			=> $NEWEXPIRYDATE,
						'attachment'		=> $attachment,
						'regcode'           => $this->user['R'],
						'ftp_server'        => ftp_server_radius,
						'ftp_port'          => 800,
						'ftp_user'          => 'argel',
						'ftp_pass'          => 'argel_argel!!!',
						'ftp_path'          => '/Remittance/',
						'ftp_filename'      => $image_id,
						'id'				=> $SELVALIDID3,
						'transtype'         => $TRANSTYPE,
						$this->user['SKT']  => md5($this->user['R'].$this->user['SKT'])
						); 
					}
					else
					{
						$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId'         	=> _create_remitpayout_id, 
						'ip_address'		=> $this->ip,
						'fname'				=> $BENEFNAME, 
						'mname'				=> $BENEMNAME,
						'lname'				=> $BENELNAME,
						'birthdate'			=> $BENEBDATE,
						'idnumber'			=> $NEWIDNUMBER,
						'idtype'			=> $NEWIDTYPE,
						'expiry'			=> $NEWEXPIRYDATE,
						'attachment'		=> $attachment,
						'regcode'           => $this->user['R'],
						'ftp_server'        => ftp_server_radius,
						'ftp_port'          => 800,
						'ftp_user'          => 'argel',
						'ftp_pass'          => 'argel_argel!!!',
						'ftp_path'          => '/Remittance/',
						'ftp_filename'      => $image_id,
						'transtype'         => $TRANSTYPE,
						$this->user['SKT']  => md5($this->user['R'].$this->user['SKT'])
						); 
					}
					
					$result = $this->curl->call($parameter,url);
					$result = json_decode($result);
					echo json_encode($result);
					
					$result = array("S"=>0,'M'=>"Successfully Upload but there an API Error, Please try again later");
					echo json_encode($result);
				}
				else{
					$result = array("S"=>0,'M'=>"Invalid Image Size, Should be less than 2MB");
					echo json_encode($result);
				}
	   		}
		}
		else
		{
			$result = array("S"=>0,'M'=>"Encoded date is already expired");
			echo json_encode($result);
		}
		/* */
		// $result = array("S"=>0,'M'=>"Adding new ID is temporary not available");
		// echo json_encode($result);
  	}
  
  /******************************************** Credit To Bank ***************************************/

  public function remittance_search_sec_bank(){
 
    // $url = "http://35.185.184.154/ups_ecash_service/remittance_search_sec_bank";
	$url = "https://mobileapi.unified.ph/ups_ecash_service/remittance_search_sec_bank";
		$parameter =array(
			'dev_id'    	    => $this->global_f->dev_id(),
      'ip_address'		=> $this->ip,
      'lbeneficiary' => $this->input->post('lbeneficiary'),
      'lsender' => $this->input->post('lsender'),
			'actionId' 	 		=> 'ups_ecash_service/remittance_search_sec_bank',
			'regcode'   		=> $this->user['R'],
			'trackno'			=> $this->input->post('trackno'),
			$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'])
		    );

			// var_dump($response); exit();
		$result = $this->curl->call($parameter,$url);
		$response= json_decode($result,true);		
		
		 

		echo json_encode($response);
  }

  public function fetch_available_ids_post(){
      $FIRSTNAME = $this->input->post('fname');
      $LASTNAME = $this->input->post('lname');
      $MIDDLENAME = $this->input->post('mname');
      $BIRTHDATE = $this->input->post('birthdate');

    // $url = "http://resourceapi.globalpinoyremittance.com:8092/ups_ecash_service/fetch_available_ids";
	$url = "https://mobileapi.unified.ph:8092/ups_ecash_service/fetch_available_ids";
		$parameter =array(
			'dev_id'    	    => $this->global_f->dev_id(),
      'ip_address'		=> $this->ip,
      'fname' => $FIRSTNAME,
      'lname' => $LASTNAME,
      'mname' => $MIDDLENAME,
      'birthdate' => $BIRTHDATE,
			'actionId' 	 		=> 'ups_ecash_service/remittance_search_sec_bank',
			'regcode'   		=> $this->user['R'],
			'trackno'			=> $this->input->post('trackno'),
			$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'])
		    );

		
		$result = $this->curl->call($parameter,$url);
		$response= json_decode($result,true);		
		
		// var_dump($response); 

    echo json_encode($response);
    
  }

  public function remittance_send_sec_bank(){

    $TRANSPASS = $this->input->post('transpass');
    $ACCTNO = $this->input->post('accountno');
    $IP = $this->input->post('ip');
    $BANKID = $this->input->post('code');
    $BANKTYPE = $this->input->post('bank');
    $BENEFICIARY_NAME = $this->input->post('bene_name');
    $AMOUNT = $this->input->post('amount');

    $url = url;
		$parameter =array(
			'dev_id'    	    => $this->global_f->dev_id(),
      'ip_address'		=> $this->ip,
      'transpass' => $TRANSPASS,
      'accountno' => $ACCTNO,
      'bank_id' => $BANKID,
      'bank_type' => $BANKTYPE,
      'bene_name' => $BENEFICIARY_NAME,
      'amount' => $AMOUNT,
			'actionId' 	 		=> 'ups_ecash_service/remittance_send_sec_bank',
			'regcode'   		=> $this->user['R'],
			$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($TRANSPASS))
		    );

		
		$result = $this->curl->call($parameter,$url);
		$response= json_decode($result,true);		
		
		// var_dump($response); 

    echo json_encode($response);

  }

  public function fetch_secbank_id_types(){

    $url = url;
		$parameter =array(
			'dev_id'    	    => $this->global_f->dev_id(),
      'ip_address'		=> $this->ip,
			'actionId' 	 		=> 'ups_ecash_service/fetch_secbank_id_types',
			'regcode'   		=> $this->user['R'],
			$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'])
		    );

		
		$result = $this->curl->call($parameter,$url);
    $response= json_decode($result,true);	
    echo json_encode($response);
    
  }

  public function add_newid_secbank(){

		$SENDERFNAME = $this->input->post('senderfname');
		$SENDERMNAME = $this->input->post('sendermname');
		$SENDERLNAME = $this->input->post('senderlname');
		$SENDERBDATE = $this->input->post('senderbdate');
		
		$NEWIDTYPE = $this->input->post('newidtype');
		$NEWIDNUMBER = $this->input->post('newidnumber');
		$NEWEXPIRYDATE = $this->input->post('newexpirydate');

		$CREATE_NEW = $this->input->post('create_new');

		$SELVALIDID1 = $this->input->post('selvalidID1');
    $TYPE = $this->input->post('type') ? $this->input->post('type') : "BANK";


		$datetoday = date("Y-m-d");

		if($NEWEXPIRYDATE > $datetoday || $NEWEXPIRYDATE == 'NO EXPIRY')
		{

			if($NEWEXPIRYDATE == 'NO EXPIRY')
			{
				$NEWEXPIRYDATE = '2100-01-01';
			}

			if ($_FILES['file']['error'] == 0){

			if($_FILES['file']['size'] < 2*MB) {

			$url = $_FILES["file"]["tmp_name"];


			if($_FILES['file']['size'] > 1*MB)
			{
				$old_size = $_FILES['file']['size'];
		    		$urltmp = sys_get_temp_dir().'/tmp.jpg';
					$filename = $this->compress_image($_FILES["file"]["tmp_name"], $urltmp, 75);
					$new_size = filesize($urltmp);
					
					if($new_size < $old_size)
					{
						$url = $urltmp;
					}
			}

		$image_id = md5($this->user['R'].$SENDERFNAME.$SENDERMNAME.$SENDERLNAME.$SENDERBDATE.$NEWIDTYPE.$NEWIDNUMBER.$NEWEXPIRYDATE) . '_web.jpg';

    	$ch = curl_init();
		$localfile = $url;
		$fp = fopen($localfile, 'r');
		curl_setopt($ch, CURLOPT_URL, 'ftp://'.ftp_server_radius.':800/CreditToBank/'.$image_id);
		curl_setopt($ch, CURLOPT_USERPWD, "argel:argel_argel!!!");
		curl_setopt($ch, CURLOPT_UPLOAD, 1);
		curl_setopt($ch, CURLOPT_INFILE, $fp);
		curl_setopt($ch, CURLOPT_INFILESIZE, filesize($localfile));
		curl_exec ($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$error_no = curl_errno($ch);
		curl_close ($ch);

		$attachment = 'ftp://frequest:frequest@'.ftp_server_radius.':800/CreditToBank/'.$image_id;
		// print_r($_POST);
		// print_r($_FILES);


		$data['user'] = $this->user;

			if($CREATE_NEW == 'ADD')
			{
				$parameter =array(
				'dev_id'     		=> $this->global_f->dev_id(),
				'actionId'         	=> 'ups_ecash_service/create_remitpayout_id2', 
				'ip_address'		=> $this->ip,
				'fname'				=> $SENDERFNAME, 
				'mname'				=> $SENDERMNAME,
				'lname'				=> $SENDERLNAME,
				'birthdate'			=> $SENDERBDATE,
				'idnumber'			=> $NEWIDNUMBER,
				'idtype'			=> $NEWIDTYPE,
				'expiry'			=> $NEWEXPIRYDATE,
				'attachment'		=> $attachment,
				'regcode'           => $this->user['R'],
				'ftp_server'         => ftp_server_radius,
				'ftp_port'           => 800,
				'ftp_user'           => 'argel',
				'ftp_pass'           => 'argel_argel!!!',
				'ftp_path'           => '/CreditToBank/',
				'ftp_filename'       => $image_id,
				'transtype'         => $TYPE,
				$this->user['SKT']  => md5($this->user['R'].$this->user['SKT'])
		    	); 
			} else {
				 $parameter =array(
				'dev_id'     		=> $this->global_f->dev_id(),
				'actionId'         	=> 'ups_ecash_service/update_remitpayout_id', 
				'ip_address'		=> $this->ip,
				'fname'				=> $SENDERFNAME, 
				'mname'				=> $SENDERMNAME,
				'lname'				=> $SENDERLNAME,
				'birthdate'			=> $SENDERBDATE,
				'idnumber'			=> $NEWIDNUMBER,
				'idtype'			=> $NEWIDTYPE,
				'expiry'			=> $NEWEXPIRYDATE,
				'attachment'		=> $attachment,
				'regcode'           => $this->user['R'],
				'ftp_server'        => ftp_server_radius,
				'ftp_port'          => 800,
				'ftp_user'          => 'argel',
				'ftp_pass'          => 'argel_argel!!!',
				'ftp_path'          => '/CreditToBank/',
        'ftp_filename'      => $image_id,
        'id'				=> 	$SELVALIDID1,
				'transtype'         => $TYPE,
				$this->user['SKT']  => md5($this->user['R'].$this->user['SKT'])
		    	); 
			}



		    $result = $this->curl->call($parameter,url);
		   	$result = json_decode($result);
		   	echo json_encode($result);
		   	}
		   	else
		   	{
		   	$result = array("S"=>0,'M'=>"Invalid Image Size, Should be less than 2MB");
		   	echo json_encode($result);
		   	}
	   }
	   else
	   {
	   	$result = array("S"=>0,'M'=>"Invalid Image Size, Should be less than 2MB");
	   	echo json_encode($result);
	   }
	}
	else
	{
   		$result = array("S"=>0,'M'=>"Encoded date is already expired");
	   	echo json_encode($result);
	}

  }
  
  public function remittance_send_sec_bank_confirm(){

      $TRANSPASS = $this->input->post('trPass');
      $ACCTNO = $this->input->post('secbankAccntNo');
      $TN = $this->input->post('TN');
      $BANKID = $this->input->post('bank_id');
      $BENEFICIARY_NAME = $this->input->post('benesName');
      $AMOUNT = $this->input->post('amount');
      $TRANSNO = $this->input->post('transno');
      $SENDER_ID = $this->input->post('scard');
      $SENDER_NAME = explode("|",$this->input->post('sbname'));
      $SENDER_FNAME = $SENDER_NAME[1];
      $SENDER_MNAME = $SENDER_NAME[2];
      $SENDER_LNAME = $SENDER_NAME[3];
      $SENDER_BDAY = $this->input->post('senderBday');

      $SENDER_ID = $this->input->post('scard');
      $SENDER_ADDRESS = $this->input->post('senderAddress');
      $SENDER_NUMBER = $this->input->post('senderNumber');
      $SENDER_BPLACE = $this->input->post('senderBplace');
      $SENDER_NATIONALITY = $this->input->post('senderNationality');
      $SENDER_WORK = $this->input->post('senderNow');
      $SENDERNUMBER = $this->input->post('senderNumber');
      $SOURCEOFFUND = $this->input->post('senderSof');

      $BENEFICIARY_ID = $this->input->post('bcard');
      $BENE_NAME = explode("|",$this->input->post('bbname'));
      $BENE_FNAME = $BENE_NAME[1];
      $BENE_MNAME = $BENE_NAME[2];
      $BENE_LNAME = $BENE_NAME[3];
      $BENE_BDAY = $this->input->post('beneBday');

      $ID1 = $this->input->post('id_detailnumber1');
      $ID2 = $this->input->post('id_detailnumber2');
      $IDTYPE1 = $this->input->post('id_secbank_type');
      $IDTYPE2 = $this->input->post('id_secbank_type2');
      $idCategory = $this->input->post('id_detail');
      $COUNTRY = $this->input->post('country');

    $url = url;
    
		$parameter = array(
			'dev_id'    	    => $this->global_f->dev_id(),
      'ip_address'		  => $this->ip,
      'transpass'       => $TRANSPASS,
      'accountno'       => $ACCTNO,
      'bank_id'         => $BANKID,
      'bene_name'       => $BENEFICIARY_NAME,
      'amount'          => $AMOUNT,
      'transno'         => $TN,
      'sender_id'       => $SENDER_ID,
      'senderfname'     => $SENDER_FNAME,
      'sendermname'     => $SENDER_MNAME,
      'senderlname'     => $SENDER_LNAME,
      'senderBirthdate' => $SENDER_BDAY,
      'sender_id'       => $SENDER_ID,
      'sender_address'  => $SENDER_ADDRESS,
      'senderContactDetails' => $SENDER_NUMBER,
      'sender_birthplace' => $SENDER_BPLACE,
      'sender_nationality' => $SENDER_NATIONALITY,
      'sender_work'     => $SENDER_WORK,
      'senderContactDetails'  => $SENDERNUMBER,
      'SourceofFund'    => $SOURCEOFFUND,
      'bene_id'         => $BENEFICIARY_ID,
      'benefname'       => $BENE_FNAME,
      'benemname'       => $BENE_MNAME,
      'benelname'       => $BENE_LNAME,
      'beneBirthdate'   => $BENE_BDAY,
      'id1'             => $ID1,
      'id2'             => $ID2,
      'idtype1'         => $IDTYPE1,
      'idtype2'         => $IDTYPE2,
      'idCategory'      => $idCategory,
      'country'         =>   $COUNTRY,                                   
			'actionId' 	 		  => 'ups_ecash_service/remittance_send_sec_bank_confirm',
			'regcode'   		  => $this->user['R'],
			$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($TRANSPASS))
		    );

		
		$result = $this->curl->call($parameter,$url);
    $response= json_decode($result,true);	
    echo json_encode($response);
    
  }


}