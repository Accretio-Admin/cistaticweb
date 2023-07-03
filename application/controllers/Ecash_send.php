<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL ^ E_WARNING);
class Ecash_send extends CI_Controller {

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

	  	if ($this->user['USER_KYC'] != 'APPROVED') 
		{
		  	redirect('Main');
		}
	}

	public function index()
	{	
		if ($this->user['A_CTRL']['remittance'] == 1 && $this->user['R'] != 'G5457340')
		{
			$data = array('menu' => 2, 'parent'=>'REMITTANCE');

			if ($this->user['S'] == 1 && $this->user['R'] !="")
			{
				$data['user'] = $this->user;

				if (substr($this->user['R'], 0, 3) == 'GWL') //For Wealthylifestyle
				{
					$data['exceed_wu'] = $this->check_trans->transCount($this->user['R'], 152)['S'];
					$data['exceed_sm'] = $this->check_trans->transCount($this->user['R'], 7)['S'];
					$data['exceed_ec_to_ec'] = $this->check_trans->transCount($this->user['R'], 22)['S'];
					$data['exceed_ec_padala'] = $this->check_trans->transCount($this->user['R'], 60)['S'];
					$data['exceed_cd_to_bank'] = $this->check_trans->transCount($this->user['R'], 32)['S'];
					$data['exceed_ec_to_cebuana'] = $this->check_trans->transCount($this->user['R'], 81)['S'];
					$data['exceed_ec_to_cashcard'] = $this->check_trans->transCount($this->user['R'], 80)['S'];
					
					$this->load->view('remittance/ecash_send/gwl_index', $data);
				}
				else
				{
					$url = url;
					
					$parameter = array(
						'dev_id'	=>$this->global_f->dev_id(),
						'actionId'	=>'ups_user/regcode_filter',
						'regcode'	=>$this->user['R'],
						'ip_address' =>$this->ip,
						'filter_in'	=>'ecpay'
					); 
					$result = $this->curl->call($parameter,$url);
					$results = json_decode($result,true);
					$data['filter_ecpay'] = $results['R'];

					$this->load->view('remittance/ecash_send/index', $data);
				}	
			}
			else 
			{
				$this->session->sess_destroy();
				redirect('Login/');
			}
		}
		else 
		{
			redirect('Main/');
		}
	}

	public function testBSP(){
		// TESTING BSP
		if($this->user['R'] == '1234567' ||
			$this->user['R'] == 'F7997947' ||
			$this->user['R'] == 'F3034264' ||
			$this->user['R'] == 'F2705239' ||
			$this->user['R'] == 'F8506908' ||
			$this->user['R'] == 'F3053198' ||
			$this->user['R'] == 'F8745532')
		{
			$data['testing'] = "BSP";
		}
		return $data;
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
					 	elseif($data['API']['C'] == 'MYR')
					 	{
					 		$this->user['MYR'] = $data['API']['FA'];
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

	public function ecashtoecash_old()
	{
	
		if ($this->user['A_CTRL']['remittance'] == 1 && $this->user['A_CTRL']['remittance_ecash_send'] == 1){

		$this->check_trans->gwlCheckTransLimit(22); //For Wealthylifestyle

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

	public function ecashtoecash()
	{
		if ($this->user['A_CTRL']['remittance'] == 1 && $this->user['A_CTRL']['remittance_ecash_send'] == 1){

			$this->check_trans->gwlCheckTransLimit(22); //For Wealthylifestyle

			$data = array('menu' => 2,
					'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_send/ecash_to_ecash');
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');	

			}else {
				$this->session->sess_destroy();
				redirect('Login/');
			}

		} else {
			redirect('Main/');
		}
	}

	public function ecash_to_ecash_transaction () 
	{
		$dregcode = $this->input->post('dealerRegcode');
		$atransaction = $this->input->post('amountTransaction');
		$itpass = $this->input->post('inputTpass');

		$url = url;
		$parameter =array(
			'dev_id'   		    => $this->global_f->dev_id(),
			'actionId' 	 		=> _ecashtoecash,
			'regcode'   	 	=>$this->user['R'],
			'client_regcode' 	=>$dregcode,
			'transpass'	 	 	=>$itpass,
			'amount'	 		=>$atransaction,
			'ip_address'    	=>$this->ip,
			$this->user['SKT']  => md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
		); 

		$results = $this->curl->call($parameter,$url);
		$result = json_decode($results,true);
		echo json_encode($result);

		if ($result['S']  == 1) {
						
			$this->user['EC'] = $result['EC'];
		
		   $result['user'] = $this->global_f->get_user_session();
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

		$this->check_trans->gwlCheckTransLimit(7); //FOR WEALTHY LIFESTYLE

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

		$this->check_trans->gwlCheckTransLimit(60); //FOR WEALTHY LIFESTYLE

		$data = array('menu' => 2,
					  'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;

				$data['process'] = 0;
				
                $data['level'] = $this->user['L'];
				$testing = $this->testBSP();
				if(($data['level'] != 7) && ($data['level'] != 16)){                    
					$data['DEALER']['M'] = "DEALER";

					$searchFname = $this->user['FIRSTNAME'];
					$searchLname = $this->user['LASTNAME'];

					$url = url;
					$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId' 	 		=> _remittance_search_bsp,
						'fname'  			=> $searchFname,
						'lname'  			=> $searchLname,
						'regcode' 			=> $this->user['R'],
						'ip_address'		=> $this->ip
					); 

					$result = $this->curl->call($parameter,$url);
					$data['rowD'] = json_decode($result,true);

				   	if ($data['rowD']['S']==1) {
						$data['dealerSenderID'] = $data['rowD']['result'][0]['id'];

						$parameter = array(
							'dev_id'     		=> $this->global_f->dev_id(),
							'actionId' 	 		=> 'ups_ecash_service/remittance_check_sender_details',
							'fname'  			=> $searchFname,
							'lname'  			=> $searchLname,
							'regcode' 			=> $this->user['R'],
							'ip_address'		=> $this->ip
						); 

						$result = $this->curl->call($parameter,$url);
						$data['checkSender'] = json_decode($result,true);

						if($data['checkSender']['result'][0]['permanentAddress'] == "" || $data['checkSender']['result'][0]['permanentAddress'] == null){
							$data['missingSD']['permanentAddress'] = '';
						}

						if($data['checkSender']['result'][0]['placeOfBirth'] == "" || $data['checkSender']['result'][0]['placeOfBirth'] == null){
							$data['missingSD']['placeOfBirth'] = '';
						}

						if($data['checkSender']['result'][0]['sourceOfFund'] == "" || $data['checkSender']['result'][0]['sourceOfFund'] == null){
							$data['missingSD']['sourceOfFund'] = '';
						}

						if($data['checkSender']['id'] == "" || $data['checkSender']['id'] == null) {
							$data['missingSD']['id'] = '';
						}

						$CHECK_MISSING_DATA = 0;
						foreach($data['missingSD'] as $i){
							if(empty($i)){
								$CHECK_MISSING_DATA = 1;
							}
						}
						
						$senderID = $data['rowD']['result'][0]['id'];
						$fname = $data['rowD']['result'][0]['fname'];
						$lname = $data['rowD']['result'][0]['lname'];

						$param1 =array(
							'actionId' 	 => 'ups_ecash_service/remittance_search_bene_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'sender_id'  => $senderID,
							'ip_address' => $this->ip
						); 

						$result = $this->curl->call($param1,$url);
						$data['row'] = json_decode($result,true);
						
						if($data['row']['S']===0){
							$data['rowMessage'] = "NO BENEFICIARY FOUND";

							$param1 =array(
								'dev_id'     		=> $this->global_f->dev_id(),
								'actionId' 	 		=> _remittance_search_bsp,
								'fname'  			=> $fname,
								'lname'  			=> $lname,
								'regcode' 			=> $this->user['R'],
								'ip_address'		=> $this->ip
							); 

							$resultAPI = $this->curl->call($param1, $url);
							$data['row'] = json_decode($resultAPI, true);
							
							if ($data['row']['S']==1) {
								$data['type'] = array('typeid'=>1,
														'typedesc'=>'Sender');
							}
						}else{
							$param2 =array(
								'actionId' 	 => 'ups_ecash_service/remittance_selected_sender_bsp',
								'dev_id' 	 => $this->global_f->dev_id(),
								'regcode'	 => $this->user['R'],
								'rowid' 	 => $senderID,
								'ip_address' => $this->ip
							); 
		
							$resultSelected = $this->curl->call($param2 ,$url);
							$data['selectedSender'] = json_decode($resultSelected,true);
							
							$senderinfo = explode("|", $this->input->post('inputSenderHide'));
					
							$data['type'] = array('typeid'=>2,
												'typedesc'=>'Beneficiary',
												'inputSenderName' => $senderinfo[1],
												'inputSender'    	=> $this->input->post('inputSenderHide'));	
						}
					}
					if($data['rowD']['M'] == "NO MATCH FOUND"){
						$data['DEALER']['M'] = "NEW";
					}
				}

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
					
				 
	 			}elseif (isset($_POST['btnSearchSenderBSP'])) //Search Sender BSP ECASH PADALA
				{
					$searchFname = $this->input->post('inputSearchFname');
					$searchLname = $this->input->post('inputSearchLname');

					$url = url;
					$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId' 	 		=> _remittance_search_bsp,
						'fname'  			=> $searchFname,
						'lname'  			=> $searchLname,
						'regcode' 			=> $this->user['R'],
						'ip_address'		=> $this->ip
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
				
	 			}elseif (isset($_POST['btnSearchBeneBSP']))  //Search Benificiary BSP ECASH PADALA
	 			{
					$senderID = $this->input->post('selectedSenderID');
					$fname = $this->input->post('selectedSenderFname');
					$lname = $this->input->post('selectedSenderLname');

					$url = url;
			
					$parameter =array(
						'actionId' 	 => 'ups_ecash_service/remittance_search_bene_bsp',
						'dev_id' 	 => $this->global_f->dev_id(),
						'regcode'	 => $this->user['R'],
						'sender_id'  => $senderID,
						'ip_address' => $this->ip
					); 

				    $result = $this->curl->call($parameter,$url);
					$data['row'] = json_decode($result,true);
					
					if($data['row']['S']===0){
						$data['rowMessage'] = "NO BENEFICIARY FOUND";

						$param1 =array(
							'dev_id' 	 => $this->global_f->dev_id(),
							'actionId' 	 => _remittance_search_bsp,
							'fname' 	 => $fname,
							'lname' 	 => $lname,
							'regcode' 	 => $this->user['R'],
							'ip_address' => $this->ip
						); 

						$resultAPI = $this->curl->call($param1, $url);
						$data['row'] = json_decode($resultAPI, true);
						
						if ($data['row']['S']==1) {
							$data['type'] = array('typeid'=>1,
													'typedesc'=>'Sender');
						}
					}else{
						$param2 =array(
							'actionId' 	 => 'ups_ecash_service/remittance_selected_sender_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'rowid' 	 => $senderID,
							'ip_address' => $this->ip
						); 
	
						$resultSelected = $this->curl->call($param2 ,$url);
						$data['selectedSender'] = json_decode($resultSelected,true);
						
						$senderinfo = explode("|", $this->input->post('inputSenderHide'));
				
						$data['type'] = array('typeid'=>2,
											  'typedesc'=>'Beneficiary',
											  'inputSenderName' => $senderinfo[1],
											  'inputSender'    	=> $this->input->post('inputSenderHide'));	
					}

				
	 			}elseif(isset($_POST['btnAddDetails']))
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
						
	 			}elseif(isset($_POST['btnAddDetailsBene'])) //Add benificiary BSP ECASH PADALA
	 			{
	 				$INPUT_POST =$this->input->post(null,true);
	 				$T_VALUE =md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));
	 				$url = url;
					$parameter =array(
						'dev_id'    	    => $this->global_f->dev_id(),
						'ip_address'		=> $this->ip,
						'actionId' 	 		=> _remittance_add_bene_bsp,
						'regcode'   		=> $this->user['R'],
						'transpass' 		=> $INPUT_POST['inputTpass'],
						'sender_id'			=> $INPUT_POST['senderID'],
						'fname' 			=> $INPUT_POST['inputFnameBene'],
						'mname' 			=> $INPUT_POST['inputMnameBene'],
						'lname' 			=> $INPUT_POST['inputLnameBene'],
						'suffix' 			=> $INPUT_POST['inpuSuffixBene'],
						'birthdate' 		=> $INPUT_POST['inputBdateBene'],
						'address_details' 	=> $INPUT_POST['inputStreetBene'] .", ". $INPUT_POST['inputBarangayBene'] .", ". $INPUT_POST['inputCityBene'] .", ". $INPUT_POST['inputProvinceBene'] .", ". $INPUT_POST['inputCountryBene'] .", ". $INPUT_POST['inputPostalBene'],
						'country' 			=> $INPUT_POST['inputCountryBene'],
						'mobile'			=> $INPUT_POST['inputMobileBene'],
						'email' 			=> $INPUT_POST['inputEmailBene'],

						$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
					);

					$result = $this->curl->call($parameter,$url);
					$data['AddBene'] = json_decode($result,true);

					if($data['AddBene']['S']==1){
						$parameter =array(
							'dev_id'     => $this->global_f->dev_id(),
							'ip_address' => $this->ip,
							'actionId' 	 => _remittance_search_bene_bsp,
							'regcode'    => $this->user['R'],
							'fname' 	 => $INPUT_POST['inputFnameBene'],
							'lname' 	 => $INPUT_POST['inputLnameBene'],
							'birthdate'  => $INPUT_POST['inputBdateBene'],
							'senderID'	 => $INPUT_POST['senderID'],
						);
						$result = $this->curl->call($parameter,$url);
						$data['beneDetails'] = json_decode($result,true);

						$param1 =array(
							'actionId' 	 => 'ups_ecash_service/remittance_selected_sender_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'rowid' 	 => $data['beneDetails']['result'][0]['sender_id'],
							'ip_address' => $this->ip
						); 
	
						$result1 = $this->curl->call($param1, $url);
	
						$param2 =array(
							'actionId' 	 => 'ups_ecash_service/remittance_selected_beneficiaryID_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'rowid'	 	 => $data['beneDetails']['result'][0]['id'],
							'ip_address' => $this->ip
						); 
	
						$result2 = $this->curl->call($param2, $url);
	
						$data['selectedID1'] = json_decode($result1, true);
						$data['selectedID2'] = json_decode($result2, true);
					}else{
						$senderID = $INPUT_POST['senderID'];
	
						$url = url;
				
						$parameter =array(
							'actionId' 	 => 'ups_ecash_service/remittance_search_bene_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'sender_id'  => $senderID,
							'ip_address' => $this->ip
						); 
	
						$result = $this->curl->call($parameter,$url);
						$data['row'] = json_decode($result,true);
						
						$fname = $data['row']['result'][0]['fname'];
						$lname = $data['row']['result'][0]['lname'];
						
						if($data['row']['S']===0){
							$data['rowMessage'] = "NO BENEFICIARY FOUND";
	
							$param1 =array(
								'dev_id'     		=> $this->global_f->dev_id(),
								'actionId' 	 		=> _remittance_search_bsp,
								'fname'  			=> $fname,
								'lname'  			=> $lname,
								'regcode' 			=> $this->user['R'],
								'ip_address'		=> $this->ip
							); 
	
							$resultAPI = $this->curl->call($param1, $url);
							$data['row'] = json_decode($resultAPI, true);
							
							if ($data['row']['S']==1) {
								$data['type'] = array('typeid'=>1,
														'typedesc'=>'Sender');
							}
						}else{
							$param2 =array(
								'actionId' 	 => 'ups_ecash_service/remittance_selected_sender_bsp',
								'dev_id' 	 => $this->global_f->dev_id(),
								'regcode'	 => $this->user['R'],
								'rowid' 	 => $senderID,
								'ip_address' => $this->ip
							); 
		
							$resultSelected = $this->curl->call($param2 ,$url);
							$data['selectedSender'] = json_decode($resultSelected,true);
							
							$senderinfo = explode("|", $this->input->post('inputSenderHide'));
					
							$data['type'] = array('typeid'=>2,
												  'typedesc'=>'Beneficiary',
												  'inputSenderName' => $senderinfo[1],
												  'inputSender'    	=> $this->input->post('inputSenderHide'));	
						}
					}
						
	 			}elseif(isset($_POST['btnAddSenderBSP'])){ //Add Sender BSP ECASH PADALA
	 				$INPUT_POST =$this->input->post(null,true);
	 				$T_VALUE =md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));
	 				$url = url;

					for($i = 1; $i <= 2; $i++){
						${'file'.$i} 			= $_FILES['file'.$i];
						${'file'.$i.'Name'} 	= ${'file'.$i}['name'];
						${'file'.$i.'Size'}		= ${'file'.$i}['size'];
						${'file'.$i.'Temp'}		= ${'file'.$i}['tmp_name'];
						${'file'.$i.'Error'} 	= ${'file'.$i}['error'];
					}

					if($file1Size < 2*MB || $file2Size < 2*MB) {
			
						for($a = 1; $a <= 2; $a++){
			
							${'url'.$a} = ${'file'.$a.'Temp'};
							if(${'file'.$a.'Size'} > 1*MB)
							{
								${'old_size'.$a} = ${'file'.$a.'Size'};
								${'urltmp'.$a}	 = sys_get_temp_dir().'/tmp.jpg';
								
								${'filename'.$a} = $this->compress_image(${'file'.$a.'Size'}, ${'urltmp'.$a}, 75);
								${'new_size'.$a} = filesize(${'urltmp'.$a});
							
								if(${'new_size'.$a} < ${'old_size'.$a})
								{
									${'url'.$a} = ${'urltmp'.$a};
								}
							}
							
							${'curl'.$a} = curl_init();
							${'localfile'.$a} = ${'url'.$a};
						}
			
						for($i = 1; $i <= 2; $i++){
							curl_setopt_array(${'curl'.$i}, array(
								CURLOPT_URL => 'https://unified.ph/kyc-upload',
								CURLOPT_RETURNTRANSFER => true,
								CURLOPT_ENCODING => '',
								CURLOPT_MAXREDIRS => 10,
								CURLOPT_TIMEOUT => 0,
								CURLOPT_FOLLOWLOCATION => true,
								CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
								CURLOPT_CUSTOMREQUEST => 'POST',
								CURLOPT_POSTFIELDS => array('file'=> new CURLFILE(${'localfile'.$i}),'file_location' => 'kyc-remittance','regcode' => $this->user['R'],'email' => '123','ext_name' => '.jpg'),
							));
							
							${'response'.$i} = curl_exec(${'curl'.$i}); 
							curl_close(${'curl'.$i});
							${'upload_response'.$i} = json_decode(${'response'.$i},true);
						}
						
						$id1 = $upload_response1['F'];
						$id2 = $upload_response2['F'];

						if($id1){
							$id1 = "/v1-sftp/kyc-remittance/".$upload_response1['F'];
						}
						if($id2){
							$id2 = "/v1-sftp/kyc-remittance/".$upload_response2['F'];
						}

					}else{
						$data['AddSender']['S'] = 0;
						$data['AddSender']['M'] = "FILE SIZE TOO BIG MUST BE LESS THAN 2MB";
					}

					if($id1){
						$parameter =array(
							'dev_id'    	   	=> $this->global_f->dev_id(),
							'ip_address'		=> $this->ip,
							'actionId' 	 		=> _remittance_add_user_bsp,
							'regcode'   		=> $this->user['R'],
							'transpass' 		=> $INPUT_POST['inputTpass'],
							'fname'				=> $INPUT_POST['inputFname'],
							'mname'				=> $INPUT_POST['inputMname'],
							'lname'				=> $INPUT_POST['inputLname'],
							'suffix'			=> $INPUT_POST['inpuSuffix'],
							'birthdate'			=> $INPUT_POST['inputBdate'],
							'birthplace'		=> $INPUT_POST['inputBirthplace'],
							'address_details'	=> $INPUT_POST['inputStreet'],
							'brgy'				=> $INPUT_POST['inputBarangay'],
							'city'				=> $INPUT_POST['inputCity'],
							'province'			=> $INPUT_POST['inputProvince'],
							'zip'				=> $INPUT_POST['inputPostal'],
							'country'			=> $INPUT_POST['inputCountry'],
							'permanent_address'	=> $INPUT_POST['inputStreet2'] . ", " . $INPUT_POST['inputBarangay2'] . ", " . $INPUT_POST['inputCity2'] . ", " . $INPUT_POST['inputProvince2'] . ", " . $INPUT_POST['inputCountry2'] . ", " . $INPUT_POST['inputPostal2'],
							'mobile'			=> $INPUT_POST['inputMobile'],
							'email'				=> $INPUT_POST['inputEmail'],
							'occupation'		=> $INPUT_POST['inputOccupation'],
							'sourcefund'		=> $INPUT_POST['inutSourceoffund'],
							'nationality'		=> $INPUT_POST['inputNationality'],
							'idtype1'			=> $INPUT_POST['newidtype'],
							'idno1'				=> $INPUT_POST['newidnumber'],
							'idexpiration1'		=> $INPUT_POST['newexpirydate1'],
							'idlink1'			=> $id1,
							'idtype2'			=> $INPUT_POST['newidtype2'],
							'idno2'				=> $INPUT_POST['newidnumber2'],
							'idexpiration2'		=> $INPUT_POST['newexpirydate12'],
							'idlink2'			=> $id2,
							$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
						);
	
						$result = $this->curl->call($parameter,$url);
						$data['AddSender'] = json_decode($result,true);
						
					}else{
						$data['AddSender']['S'] = 0;
						$data['AddSender']['M'] = "UPLOADING IMAGE FAILED";
					}
						
				}elseif(isset($_POST['btnAddSenderBSPDealer'])) //Add Dealer BSP ECASH PADALA --REMOVED--
				{
					$INPUT_POST = $this->input->post(null,true);
					$T_VALUE = md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));
					$url = url;
					
					for($i = 1; $i <= 2; $i++){
						${'file'.$i} 			= $_FILES['fileDealer'.$i];
						${'file'.$i.'Name'} 	= ${'file'.$i}['name'];
						${'file'.$i.'Size'}		= ${'file'.$i}['size'];
						${'file'.$i.'Temp'}		= ${'file'.$i}['tmp_name'];
						${'file'.$i.'Error'} 	= ${'file'.$i}['error'];
					}

					if($file1Size < 2*MB || $file2Size < 2*MB) {

						for($a = 1; $a <= 2; $a++){

							${'url'.$a} = ${'file'.$a.'Temp'};
							if(${'file'.$a.'Size'} > 1*MB)
							{
								${'old_size'.$a} = ${'file'.$a.'Size'};
								${'urltmp'.$a}	 = sys_get_temp_dir().'/tmp.jpg';
								
								${'filename'.$a} = $this->compress_image(${'file'.$a.'Size'}, ${'urltmp'.$a}, 75);
								${'new_size'.$a} = filesize(${'urltmp'.$a});
							
								if(${'new_size'.$a} < ${'old_size'.$a})
								{
									${'url'.$a} = ${'urltmp'.$a};
								}
							}
							
							${'curl'.$a} = curl_init();
							${'localfile'.$a} = ${'url'.$a};
						}

						for($i = 1; $i <= 2; $i++){
							curl_setopt_array(${'curl'.$i}, array(
								CURLOPT_URL => 'https://unified.ph/kyc-upload',
								CURLOPT_RETURNTRANSFER => true,
								CURLOPT_ENCODING => '',
								CURLOPT_MAXREDIRS => 10,
								CURLOPT_TIMEOUT => 0,
								CURLOPT_FOLLOWLOCATION => true,
								CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
								CURLOPT_CUSTOMREQUEST => 'POST',
								CURLOPT_POSTFIELDS => array('file'=> new CURLFILE(${'localfile'.$i}),'file_location' => 'kyc-remittance','regcode' => $this->user['R'],'email' => '123','ext_name' => '.jpg'),
							));
							
							${'response'.$i} = curl_exec(${'curl'.$i}); 
							curl_close(${'curl'.$i});
							${'upload_response'.$i} = json_decode(${'response'.$i},true);
						}
						
						$id1 = $upload_response1['F'];
						$id2 = $upload_response2['F'];

						if($id1){
							$id1 = "/v1-sftp/kyc-remittance/".$upload_response1['F'];
						}
						if($id2){
							$id2 = "/v1-sftp/kyc-remittance/".$upload_response2['F'];
						}

					}else{
						$data['AddSender']['S'] = 0;
						$data['AddSender']['M'] = "FILE SIZE TOO BIG MUST BE LESS THAN 2MB";
					}

					if($id1){
						$parameter =array(
							'dev_id'    	   	=> $this->global_f->dev_id(),
							'ip_address'		=> $this->ip,
							'actionId' 	 		=> _remittance_add_user_bsp,
							'regcode'   		=> $this->user['R'],
							'transpass' 		=> $INPUT_POST['inputTpass'],
							'fname'				=> $INPUT_POST['inputFnameDealer'],
							'mname'				=> $INPUT_POST['inputMnameDealer'],
							'lname'				=> $INPUT_POST['inputLnameDealer'],
							'suffix'			=> $INPUT_POST['inpuSuffixDealer'],
							'birthdate'			=> $INPUT_POST['inputBdateDealer'],
							'birthplace'		=> $INPUT_POST['inputBirthplaceDealer'],
							'address_details'	=> $INPUT_POST['inputStreetDealer'],
							'brgy'				=> $INPUT_POST['inputBarangayDealer'],
							'city'				=> $INPUT_POST['inputCityDealer'],
							'province'			=> $INPUT_POST['inputProvinceDealer'],
							'zip'				=> $INPUT_POST['inputPostalDealer'],
							'country'			=> $INPUT_POST['inputCountryDealer'],
							'permanent_address'	=> $INPUT_POST['inputStreet2Dealer'] . ", " . $INPUT_POST['inputBarangay2Dealer'] . ", " . $INPUT_POST['inputCity2Dealer'] . ", " . $INPUT_POST['inputProvince2Dealer'] . ", " . $INPUT_POST['inputCountry2Dealer'] . ", " . $INPUT_POST['inputPostal2Dealer'],
							'mobile'			=> $INPUT_POST['inputMobileDealer'],
							'email'				=> $INPUT_POST['inputEmailDealer'],
							'occupation'		=> $INPUT_POST['inputOccupationDealer'],
							'sourcefund'		=> $INPUT_POST['inutSourceoffundDealer'],
							'nationality'		=> $INPUT_POST['inputNationalityDealer'],
							'idtype1'			=> $INPUT_POST['newidtypeDealer'],
							'idno1'				=> $INPUT_POST['newidnumberDealer'],
							'idexpiration1'		=> $INPUT_POST['newexpirydate1Dealer'],
							'idlink1'			=> $id1,
							'idtype2'			=> $INPUT_POST['newidtype2Dealer'],
							'idno2'				=> $INPUT_POST['newidnumber2Dealer'],
							'idexpiration2'		=> $INPUT_POST['newexpirydate12Dealer'],
							'idlink2'			=> $id2,
							$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
						);

						$result = $this->curl->call($parameter,$url);
						$data['AddSender'] = json_decode($result,true);
						
					}else{
						$data['AddSender']['S'] = 0;
						$data['AddSender']['M'] = "UPLOADING IMAGE FAILED";
					}
				}elseif(isset($_POST['proceedTransac'])) // Process the ECASHPADALA BSP form 
	 			{
	 				$INPUT_POST =$this->input->post(null,true);
					 $url = url;

					$param1 =array(
						'actionId' 	 => 'ups_ecash_service/remittance_selected_sender_bsp',
						'dev_id' 	 => $this->global_f->dev_id(),
						'regcode'	 => $this->user['R'],
						'rowid' 	 => $INPUT_POST['transactSenderID'],
						'ip_address' => $this->ip
					); 

					$result1 = $this->curl->call($param1, $url);

					$param2 =array(
						'actionId' 	 => 'ups_ecash_service/remittance_selected_beneficiaryID_bsp',
						'dev_id' 	 => $this->global_f->dev_id(),
						'regcode'	 => $this->user['R'],
						'rowid' 	 => $INPUT_POST['transactBeneID'],
						'ip_address' => $this->ip
					); 

					$result2 = $this->curl->call($param2, $url);

					$data['selectedID1'] = json_decode($result1, true);
					$data['selectedID2'] = json_decode($result2, true);

					if($data['selectedID1']['result'][0]['fname'] == $data['selectedID2']['result'][0]['fname'] &&
						$data['selectedID1']['result'][0]['lname'] == $data['selectedID2']['result'][0]['lname'] &&
						$data['selectedID1']['result'][0]['birthDate'] == $data['selectedID2']['result'][0]['birthdate']){

						$senderID = $INPUT_POST['transactSenderID'];
						$fname = $data['selectedID1']['result'][0]['fname'];
						$lname = $data['selectedID1']['result'][0]['lname'];

						$url = url;
				
						$parameter =array(
							'actionId' 	 => 'ups_ecash_service/remittance_search_bene_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'sender_id'  => $senderID,
							'ip_address' => $this->ip
						); 

						$result = $this->curl->call($parameter,$url);
						$data['row'] = json_decode($result,true);
						
						if($data['row']['S']===0){
							$data['rowMessage'] = "NO BENEFICIARY FOUND";

							$param1 =array(
								'dev_id'     		=> $this->global_f->dev_id(),
								'actionId' 	 		=> _remittance_search_bsp,
								'fname'  			=> $fname,
								'lname'  			=> $lname,
								'regcode' 			=> $this->user['R'],
								'ip_address'		=> $this->ip
							); 

							$resultAPI = $this->curl->call($param1, $url);
							$data['row'] = json_decode($resultAPI, true);
							
							if ($data['row']['S']==1) {
								$data['type'] = array('typeid'=>1,
														'typedesc'=>'Sender');
							}
						}else{
							$data['rowMessage'] = "CANNOT PROCEED, SENDER AND BENEFICIARY DETAILS ARE THE SAME";
							$param2 =array(
								'actionId' 	 => 'ups_ecash_service/remittance_selected_sender_bsp',
								'dev_id' 	 => $this->global_f->dev_id(),
								'regcode'	 => $this->user['R'],
								'rowid' 	 => $senderID,
								'ip_address' => $this->ip
							); 
		
							$resultSelected = $this->curl->call($param2 ,$url);
							$data['selectedSender'] = json_decode($resultSelected,true);
							
							$senderinfo = explode("|", $this->input->post('inputSenderHide'));
					
							$data['type'] = array('typeid'=>2,
												'typedesc'=>'Beneficiary',
												'inputSenderName' => $senderinfo[1],
												'inputSender'    	=> $this->input->post('inputSenderHide'));	
						}
					}else{
						$data['okTransac']['S'] = 1;
					}
				
	 			}elseif(isset($_POST['submitOTP'])) // Process submit OTP BSP ECASH PADALA
	 			{
	 				$INPUT_POST =$this->input->post(null,true);
					$url = url;

					$parameter =array(
						'actionId' 	 => 'ups_ecash_service/otpValidate',
						'dev_id' 	 => $this->global_f->dev_id(),
						'regcode'	 => $this->user['R'],
						'traceno' 	 => $INPUT_POST['traceno'],
						'otp' 	 	 => $INPUT_POST['otpCode'],
						'ip_address' => $this->ip
					); 

					$result = $this->curl->call($parameter, $url);

					$data['otpResult'] = json_decode($result, true);
					
					if($data['otpResult']['S'] == 1){
						for($i = 1; $i <= 2; $i++){
							${'file'.$i} 			= $_FILES['fileHigh'.$i];
							${'file'.$i.'Name'} 	= ${'file'.$i}['name'];
							${'file'.$i.'Size'}		= ${'file'.$i}['size'];
							${'file'.$i.'Temp'}		= ${'file'.$i}['tmp_name'];
							${'file'.$i.'Error'} 	= ${'file'.$i}['error'];
						}
	
						if($file1Size < 2*MB) {
				
							for($a = 1; $a <= 1; $a++){
				
								${'url'.$a} = ${'file'.$a.'Temp'};
								if(${'file'.$a.'Size'} > 1*MB)
								{
									${'old_size'.$a} = ${'file'.$a.'Size'};
									${'urltmp'.$a}	 = sys_get_temp_dir().'/tmp.jpg';
									
									${'filename'.$a} = $this->compress_image(${'file'.$a.'Size'}, ${'urltmp'.$a}, 75);
									${'new_size'.$a} = filesize(${'urltmp'.$a});
								
									if(${'new_size'.$a} < ${'old_size'.$a})
									{
										${'url'.$a} = ${'urltmp'.$a};
									}
								}
								
								${'curl'.$a} = curl_init();
								${'localfile'.$a} = ${'url'.$a};
							}
				
							for($i = 1; $i <= 2; $i++){
								curl_setopt_array(${'curl'.$i}, array(
									CURLOPT_URL => 'https://unified.ph/kyc-upload',
									CURLOPT_RETURNTRANSFER => true,
									CURLOPT_ENCODING => '',
									CURLOPT_MAXREDIRS => 10,
									CURLOPT_TIMEOUT => 0,
									CURLOPT_FOLLOWLOCATION => true,
									CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
									CURLOPT_CUSTOMREQUEST => 'POST',
									CURLOPT_POSTFIELDS => array('file'=> new CURLFILE(${'localfile'.$i}),'file_location' => 'kyc-remittance','regcode' => $this->user['R'],'email' => '123','ext_name' => '.jpg'),
								));
								
								${'response'.$i} = curl_exec(${'curl'.$i}); 
								curl_close(${'curl'.$i});
								${'upload_response'.$i} = json_decode(${'response'.$i},true);
							}
							
							$id1 = $upload_response1['F'];
	
							if($id1){
								$id1 = "/v1-sftp/kyc-remittance/OTP_".$upload_response1['F'];
							}
	
						}

						if($id1){
							$param =array(
								'actionId' 	 => 'ups_ecash_service/remittance_send_ecash_padala_bsp_confirm',
								'dev_id' 	 => $this->global_f->dev_id(),
								'regcode'	 => $this->user['R'],
								'traceno' 	 => $INPUT_POST['traceno'],
								'action' 	 => 'APPROVED',
								'item_type'	 => 'PHOTO',
								'photolink'  => $id1,
								'ip_address' => $this->ip
							); 
	
							$resultAPI = $this->curl->call($param, $url);
	
							$data['transactConfirm'] = json_decode($resultAPI, true);
						}else{
							$data['transactConfirm']['S'] = 0;
							$data['transactConfirm']['M'] = "UPLOADING IMAGE FAILED";
						}

					}

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

				
	 			}elseif(isset($_POST['btnSubmitBSP'])) // submit Tranasction BSP ECASH PADALA API
	 			{
	 				
	 				$INPUT_POST =$this->input->post(null,true);
					$url = url;
					$parameter =array(
						'actionId' 	  => 'ups_ecash_service/remittance_send_ecash_padala_bsp',
						'dev_id' 	  => $this->global_f->dev_id(),
						'regcode'	  => $this->user['R'],
						'transpass'	  => $INPUT_POST['inputTpass'],
						'sender_id'   => $INPUT_POST['transacSenderID'],
						'receiver_id' => $INPUT_POST['transacBeneID'],
						'relation' 	  => $INPUT_POST['inputRelation'],
						'purpose' 	  => $INPUT_POST['inputPurpose'],
						'service' 	  => $INPUT_POST['service'],
						'currency' 	  => $INPUT_POST['inputCurrency'],
						'principal'	  => $INPUT_POST['inputAmount'],
						'ip_address'  => $this->ip
					);

				    $result = $this->curl->call($parameter,$url);
					$data['transactStatus'] = json_decode($result,true);
					$data['receiptCharge'] = $INPUT_POST['inputCharge'];

					if($data['transactStatus']['S'] == 1){
						
						$data['level'] = $this->user['L'];
						if(($data['level'] != 7) && ($data['level'] != 16)){  
							$traceno = $data['transactStatus']['TN'];
	
							$data['receiptResult'] = "APPROVED";

							$paramLowDetails =array(
								'actionId' 	 => 'ups_ecash_service/fetch_traceno_details',
								'dev_id' 	 => $this->global_f->dev_id(),
								'regcode'	 => $this->user['R'],
								'traceno'	 => $traceno,
								'ip_address' => $this->ip
							);
							
							$fetchLowDetails = $this->curl->call($paramLowDetails, $url);
							$data['tracenoDetails'] = json_decode($fetchLowDetails,true);

							$data['receiptResult'] = "PENDING";
							$data['transactDealer']['S'] = 1;
						}
						elseif($data['transactStatus']['RISK'] == "LOW"){
							$param =array(
								'actionId' 	 => 'ups_ecash_service/remittance_send_ecash_padala_bsp_confirm',
								'dev_id' 	 => $this->global_f->dev_id(),
								'regcode'	 => $this->user['R'],
								'traceno' 	 => $data['transactStatus']['TN'],
								'action' 	 => 'APPROVED',
								'ip_address' => $this->ip
							); 	
	
							$resultAPI = $this->curl->call($param, $url);
							$data['transactConfirmLow'] = json_decode($resultAPI,true);
	
							if($data['transactConfirmLow']['S'] == 1){
								$traceno = $data['transactStatus']['TN'];
	
								$data['receiptResult'] = "APPROVED";
	
								$paramLowDetails =array(
									'actionId' 	 => 'ups_ecash_service/fetch_traceno_details',
									'dev_id' 	 => $this->global_f->dev_id(),
									'regcode'	 => $this->user['R'],
									'traceno'	 => $traceno,
									'ip_address' => $this->ip
								);
								
								$fetchLowDetails = $this->curl->call($paramLowDetails, $url);
								$data['tracenoDetails'] = json_decode($fetchLowDetails,true);
								
								$paramLow =array(
									'actionId' 	 => 'ups_ecash_service/remittance_send_ecash_padala_bsp_transac',
									'dev_id' 	 => $this->global_f->dev_id(),
									'regcode'	 => $this->user['R'],
									'traceno'	 => $traceno,
									'ip_address' => $this->ip,
									'ip' => $this->ip
								);
	
								$resultLowAPI = $this->curl->call($paramLow, $url);
								$data['transactBSPLow'] = json_decode($resultLowAPI,true);
	
								// NOTIFY APPROVED BSP TRANSACTION
								$refno = $data['transactBSPLow']['TN'];
								
								$notifLow =array(
									'actionId' 	 => 'ups_ecash_service/notifySenderReceiver',
									'dev_id' 	 => $this->global_f->dev_id(),
									'regcode'	 => $this->user['R'],
									'traceno'	 => $traceno,
									'refno'	  	 => $refno,
									'type'	  	 => "APPROVE",
									'ip_address' => $this->ip
								);
	
								$resultLowNotif = $this->curl->call($notifLow, $url);
								$data['notifLow'] = json_decode($resultLowNotif,true);
							}
						}
						elseif($data['transactStatus']['RISK'] == "NORMAL" || $data['transactStatus']['RISK'] == "HIGH"){
							$param1 =array(
								'actionId' 	  => 'ups_ecash_service/risk_profiling',
								'dev_id' 	  => $this->global_f->dev_id(),
								'regcode'	  => $this->user['R'],
								'traceno'	  => $data['transactStatus']['TN'],
								'ip_address'  => $this->ip
							);
		
							$resultAPI1 = $this->curl->call($param1,$url);
							$data['RISK_DESCRIPTION'] = json_decode($resultAPI1,true);
							
							$param2 =array(
								'actionId' 	  => 'ups_ecash_service/checkRiskProfile',
								'dev_id' 	  => $this->global_f->dev_id(),
								'regcode'	  => $this->user['R'],
								'traceno'	  => $data['transactStatus']['TN'],
								'ip_address'  => $this->ip
							);
		
							$resultAPI2 = $this->curl->call($param2, $url);
							$data['OTP'] = json_decode($resultAPI2,true);
							
	
							$param3 =array(
								'actionId' 	  => 'ups_ecash_service/fetch_traceno_details',
								'dev_id' 	  => $this->global_f->dev_id(),
								'regcode'	  => $this->user['R'],
								'traceno'	  => $data['transactStatus']['TN'],
								'ip_address'  => $this->ip
							);
		
							$resultAPI3 = $this->curl->call($param3, $url);
							$data['tracenoDetails'] = json_decode($resultAPI3,true);
							
	
						}
					}else{
						$param1 =array(
							'actionId' 	 => 'ups_ecash_service/remittance_selected_sender_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'rowid'		 => $INPUT_POST['transacSenderID'],
							'ip_address' => $this->ip
						); 
	
						$result1 = $this->curl->call($param1, $url);
	
						$param2 =array(
							'actionId' 	 => 'ups_ecash_service/remittance_selected_beneficiaryID_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'rowid'		 => $INPUT_POST['transacBeneID'],
							'ip_address' => $this->ip
						); 
	
						$result2 = $this->curl->call($param2, $url);
	
						$data['selectedID1'] = json_decode($result1, true);
						$data['selectedID2'] = json_decode($result2, true);

						$data['inputRelation'] = $INPUT_POST['inputRelation'];
						$data['inputPurpose']  = $INPUT_POST['inputPurpose'];
						$data['inputAmount']   = $INPUT_POST['inputAmount'];
						
					}
					
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

				end:

				if($CHECK_MISSING_DATA == 1) {
					$this->load->view('layout/header',$data);
					$this->load->view('element/top_header');
					$this->load->view('element/wrapper_header');
					$this->load->view('element/left_panel');
					$this->load->view('remittance/ecash_send/updateDealer'); //UPDATE DEALER SENDER DETAILS
					$this->load->view('element/wrapper_footer');
					$this->load->view('layout/footer');
				}else{
					$this->load->view('layout/header',$data);
					$this->load->view('element/top_header');
					$this->load->view('element/wrapper_header');
					$this->load->view('element/left_panel');
					$this->load->view('remittance/ecash_send/ecash_padala_bsp'); //NEW ECASH PADALA UI BSP
					// 	$this->load->view('remittance/ecash_send/ecash_padala'); //OLD ECASH PADALA UI
					$this->load->view('element/wrapper_footer');
					$this->load->view('layout/footer');
				}
			}else {
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
			redirect('Main/');
		}

	}

	// START OF WALLET TOPUP
	public function ecash_topup_wallet()  
	{
		if ($this->user['A_CTRL']['remittance'] == 1 && $this->user['A_CTRL']['remittance_gprs_send'] == 1){

		$data = array('menu' => 2,
					  'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;

				$data['process'] = 0;

				$data['level'] = $this->user['L'];
				$testing = $this->testBSP();
				if(($data['level'] != 7) && ($data['level'] != 16)){                    
					$data['DEALER']['M'] = "DEALER";

					$searchFname = $this->user['FIRSTNAME'];
					$searchLname = $this->user['LASTNAME'];

					$url = url;
					$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId' 	 		=> _remittance_search_bsp,
						'fname'  			=> $searchFname,
						'lname'  			=> $searchLname,
						'regcode' 			=> $this->user['R'],
						'ip_address'		=> $this->ip
					); 

					$result = $this->curl->call($parameter,$url);
					$data['rowD'] = json_decode($result,true);

				   	if ($data['rowD']['S']==1) {
						$data['dealerSenderID'] = $data['rowD']['result'][0]['id'];

						$parameter = array(
							'dev_id'     		=> $this->global_f->dev_id(),
							'actionId' 	 		=> 'ups_ecash_service/remittance_check_sender_details',
							'fname'  			=> $searchFname,
							'lname'  			=> $searchLname,
							'regcode' 			=> $this->user['R'],
							'ip_address'		=> $this->ip
						); 

						$result = $this->curl->call($parameter,$url);
						$data['checkSender'] = json_decode($result,true);

						if($data['checkSender']['result'][0]['permanentAddress'] == "" || $data['checkSender']['result'][0]['permanentAddress'] == null){
							$data['missingSD']['permanentAddress'] = '';
						}

						if($data['checkSender']['result'][0]['placeOfBirth'] == "" || $data['checkSender']['result'][0]['placeOfBirth'] == null){
							$data['missingSD']['placeOfBirth'] = '';
						}

						if($data['checkSender']['result'][0]['sourceOfFund'] == "" || $data['checkSender']['result'][0]['sourceOfFund'] == null){
							$data['missingSD']['sourceOfFund'] = '';
						}

						if($data['checkSender']['id'] == "" || $data['checkSender']['id'] == null) {
							$data['missingSD']['id'] = '';
						}

						$CHECK_MISSING_DATA = 0;
						foreach($data['missingSD'] as $i){
							if(empty($i)){
								$CHECK_MISSING_DATA = 1;
							}
						}
						
						$senderID = $data['rowD']['result'][0]['id'];
						$fname = $data['rowD']['result'][0]['fname'];
						$lname = $data['rowD']['result'][0]['lname'];

						$param1 =array(
							'actionId' 	 => 'ups_ecash_service/remittance_search_bene_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'sender_id'  => $senderID,
							'ip_address' => $this->ip
						); 

						$result = $this->curl->call($param1,$url);
						$data['row'] = json_decode($result,true);
						
						if($data['row']['S']===0){
							$data['rowMessage'] = "NO BENEFICIARY FOUND";

							$param1 =array(
								'dev_id'     		=> $this->global_f->dev_id(),
								'actionId' 	 		=> _remittance_search_bsp,
								'fname'  			=> $fname,
								'lname'  			=> $lname,
								'regcode' 			=> $this->user['R'],
								'ip_address'		=> $this->ip
							); 

							$resultAPI = $this->curl->call($param1, $url);
							$data['row'] = json_decode($resultAPI, true);
							
							if ($data['row']['S']==1) {
								$data['type'] = array('typeid'=>1,
														'typedesc'=>'Sender');
							}
						}else{
							$param2 =array(
								'actionId' 	 => 'ups_ecash_service/remittance_selected_sender_bsp',
								'dev_id' 	 => $this->global_f->dev_id(),
								'regcode'	 => $this->user['R'],
								'rowid' 	 => $senderID,
								'ip_address' => $this->ip
							); 
		
							$resultSelected = $this->curl->call($param2 ,$url);
							$data['selectedSender'] = json_decode($resultSelected,true);
							
							$senderinfo = explode("|", $this->input->post('inputSenderHide'));
					
							$data['type'] = array('typeid'=>2,
												'typedesc'=>'Beneficiary',
												'inputSenderName' => $senderinfo[1],
												'inputSender'    	=> $this->input->post('inputSenderHide'));	
						}
					}
					if($data['rowD']['M'] == "NO MATCH FOUND"){
						$data['DEALER']['M'] = "NEW";
					}
				}

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
					
				 
	 			}elseif (isset($_POST['btnSearchSenderBSP'])) //Search Sender BSP WALLET TOPUP
				{

					$searchFname = $this->input->post('inputSearchFname');
					$searchLname = $this->input->post('inputSearchLname');

					$url = url;
					$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId' 	 		=> _remittance_search_bsp,
						'fname'  			=> $searchFname,
						'lname'  			=> $searchLname,
						'regcode' 			=> $this->user['R'],
						'ip_address'		=> $this->ip
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
				
	 			}elseif (isset($_POST['btnSearchBeneBSP'])) //Search Benificiary BSP WALLET TOPUP
	 			{
					$senderID = $this->input->post('selectedSenderID');
					$fname = $this->input->post('selectedSenderFname');
					$lname = $this->input->post('selectedSenderLname');

					$url = url;
			
					$parameter =array(
						'actionId' 	 => 'ups_ecash_service/remittance_search_bene_bsp',
						'dev_id' 	 => $this->global_f->dev_id(),
						'regcode'	 => $this->user['R'],
						'sender_id'  => $senderID,
						'ip_address' => $this->ip
					); 

				    $result = $this->curl->call($parameter,$url);
					$data['row'] = json_decode($result,true);
					
					if($data['row']['S']===0){
						$data['rowMessage'] = "NO BENEFICIARY FOUND";

						$param1 =array(
							'dev_id' 	 => $this->global_f->dev_id(),
							'actionId' 	 => _remittance_search_bsp,
							'fname' 	 => $fname,
							'lname' 	 => $lname,
							'regcode' 	 => $this->user['R'],
							'ip_address' => $this->ip
						); 

						$resultAPI = $this->curl->call($param1, $url);
						$data['row'] = json_decode($resultAPI, true);
						
						if ($data['row']['S']==1) {
							$data['type'] = array('typeid'=>1,
													'typedesc'=>'Sender');
						}
					}else{
						$param2 =array(
							'actionId' 	 => 'ups_ecash_service/remittance_selected_sender_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'rowid' 	 => $senderID,
							'ip_address' => $this->ip
						); 
	
						$resultSelected = $this->curl->call($param2 ,$url);
						$data['selectedSender'] = json_decode($resultSelected,true);
						
						$senderinfo = explode("|", $this->input->post('inputSenderHide'));
				
						$data['type'] = array('typeid'=>2,
											  'typedesc'=>'Beneficiary',
											  'inputSenderName' => $senderinfo[1],
											  'inputSender'    	=> $this->input->post('inputSenderHide'));	
					}

				
	 			}elseif(isset($_POST['btnAddDetails'])) //Add sender
	 			{
	 				$INPUT_POST =$this->input->post(null,true);

	 				$T_VALUE =md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));
	 				$url = url;
					$parameter =array(
									'dev_id'    	    => $this->global_f->dev_id(),
									'ip_address'		=>$this->ip,
									'actionId' 	 		=> _remittance_add_user,
				    				'regcode'   		=>$this->user['R'],
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
						
	 			}elseif(isset($_POST['btnAddDetailsBene'])) //Add benificiary BSP WALLET TOPUP
	 			{
	 				$INPUT_POST =$this->input->post(null,true);
	 				$T_VALUE =md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));
	 				$url = url;
					$parameter =array(
						'dev_id'    	    => $this->global_f->dev_id(),
						'ip_address'		=> $this->ip,
						'actionId' 	 		=> _remittance_add_bene_bsp,
						'regcode'   		=> $this->user['R'],
						'transpass' 		=> $INPUT_POST['inputTpass'],
						'sender_id'			=> $INPUT_POST['senderID'],
						'fname' 			=> $INPUT_POST['inputFnameBene'],
						'mname' 			=> $INPUT_POST['inputMnameBene'],
						'lname' 			=> $INPUT_POST['inputLnameBene'],
						'suffix' 			=> $INPUT_POST['inpuSuffixBene'],
						'birthdate' 		=> $INPUT_POST['inputBdateBene'],
						'address_details' 	=> $INPUT_POST['inputStreetBene'] .", ". $INPUT_POST['inputBarangayBene'] .", ". $INPUT_POST['inputCityBene'] .", ". $INPUT_POST['inputProvinceBene'] .", ". $INPUT_POST['inputCountryBene'] .", ". $INPUT_POST['inputPostalBene'],
						'country' 			=> $INPUT_POST['inputCountryBene'],
						'mobile'			=> $INPUT_POST['inputMobileBene'],
						'email' 			=> $INPUT_POST['inputEmailBene'],

						$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
					);

					$result = $this->curl->call($parameter,$url);
					$data['AddBene'] = json_decode($result,true);

					if($data['AddBene']['S']==1){
						$parameter =array(
							'dev_id'     => $this->global_f->dev_id(),
							'ip_address' => $this->ip,
							'actionId' 	 => _remittance_search_bene_bsp,
							'regcode'    => $this->user['R'],
							'fname' 	 => $INPUT_POST['inputFnameBene'],
							'lname' 	 => $INPUT_POST['inputLnameBene'],
							'birthdate'  => $INPUT_POST['inputBdateBene'],
							'senderID'	 => $INPUT_POST['senderID'],
						);
						$result = $this->curl->call($parameter,$url);
						$data['beneDetails'] = json_decode($result,true);

						$param1 =array(
							'actionId' 	 => 'ups_ecash_service/remittance_selected_sender_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'rowid' 	 => $data['beneDetails']['result'][0]['sender_id'],
							'ip_address' => $this->ip
						); 
	
						$result1 = $this->curl->call($param1, $url);
	
						$param2 =array(
							'actionId' 	 => 'ups_ecash_service/remittance_selected_beneficiaryID_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'rowid'	 	 => $data['beneDetails']['result'][0]['id'],
							'ip_address' => $this->ip
						); 
	
						$result2 = $this->curl->call($param2, $url);
	
						$data['selectedID1'] = json_decode($result1, true);
						$data['selectedID2'] = json_decode($result2, true);
					}else{
						$senderID = $INPUT_POST['senderID'];
	
						$url = url;
				
						$parameter =array(
							'actionId' 	 => 'ups_ecash_service/remittance_search_bene_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'sender_id'  => $senderID,
							'ip_address' => $this->ip
						); 
	
						$result = $this->curl->call($parameter,$url);
						$data['row'] = json_decode($result,true);
						
						$fname = $data['row']['result'][0]['fname'];
						$lname = $data['row']['result'][0]['lname'];
						
						if($data['row']['S']===0){
							$data['rowMessage'] = "NO BENEFICIARY FOUND";
	
							$param1 =array(
								'dev_id'     		=> $this->global_f->dev_id(),
								'actionId' 	 		=> _remittance_search_bsp,
								'fname'  			=> $fname,
								'lname'  			=> $lname,
								'regcode' 			=> $this->user['R'],
								'ip_address'		=> $this->ip
							); 
	
							$resultAPI = $this->curl->call($param1, $url);
							$data['row'] = json_decode($resultAPI, true);
							
							if ($data['row']['S']==1) {
								$data['type'] = array('typeid'=>1,
														'typedesc'=>'Sender');
							}
						}else{
							$param2 =array(
								'actionId' 	 => 'ups_ecash_service/remittance_selected_sender_bsp',
								'dev_id' 	 => $this->global_f->dev_id(),
								'regcode'	 => $this->user['R'],
								'rowid' 	 => $senderID,
								'ip_address' => $this->ip
							); 
		
							$resultSelected = $this->curl->call($param2 ,$url);
							$data['selectedSender'] = json_decode($resultSelected,true);
							
							$senderinfo = explode("|", $this->input->post('inputSenderHide'));
					
							$data['type'] = array('typeid'=>2,
												  'typedesc'=>'Beneficiary',
												  'inputSenderName' => $senderinfo[1],
												  'inputSender'    	=> $this->input->post('inputSenderHide'));	
						}
					}
						
	 			}elseif(isset($_POST['btnAddSenderBSP'])){ //Add Sender BSP WALLET TOPUP
	 				$INPUT_POST =$this->input->post(null,true);
	 				$T_VALUE =md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));
	 				$url = url;

					for($i = 1; $i <= 2; $i++){
						${'file'.$i} 			= $_FILES['file'.$i];
						${'file'.$i.'Name'} 	= ${'file'.$i}['name'];
						${'file'.$i.'Size'}		= ${'file'.$i}['size'];
						${'file'.$i.'Temp'}		= ${'file'.$i}['tmp_name'];
						${'file'.$i.'Error'} 	= ${'file'.$i}['error'];
					}

					if($file1Size < 2*MB || $file2Size < 2*MB) {
			
						for($a = 1; $a <= 2; $a++){
			
							${'url'.$a} = ${'file'.$a.'Temp'};
							if(${'file'.$a.'Size'} > 1*MB)
							{
								${'old_size'.$a} = ${'file'.$a.'Size'};
								${'urltmp'.$a}	 = sys_get_temp_dir().'/tmp.jpg';
								
								${'filename'.$a} = $this->compress_image(${'file'.$a.'Size'}, ${'urltmp'.$a}, 75);
								${'new_size'.$a} = filesize(${'urltmp'.$a});
							
								if(${'new_size'.$a} < ${'old_size'.$a})
								{
									${'url'.$a} = ${'urltmp'.$a};
								}
							}
							
							${'curl'.$a} = curl_init();
							${'localfile'.$a} = ${'url'.$a};
						}
			
						for($i = 1; $i <= 2; $i++){
							curl_setopt_array(${'curl'.$i}, array(
								CURLOPT_URL => 'https://unified.ph/kyc-upload',
								CURLOPT_RETURNTRANSFER => true,
								CURLOPT_ENCODING => '',
								CURLOPT_MAXREDIRS => 10,
								CURLOPT_TIMEOUT => 0,
								CURLOPT_FOLLOWLOCATION => true,
								CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
								CURLOPT_CUSTOMREQUEST => 'POST',
								CURLOPT_POSTFIELDS => array('file'=> new CURLFILE(${'localfile'.$i}),'file_location' => 'kyc-remittance','regcode' => $this->user['R'],'email' => '123','ext_name' => '.jpg'),
							));
							
							${'response'.$i} = curl_exec(${'curl'.$i}); 
							curl_close(${'curl'.$i});
							${'upload_response'.$i} = json_decode(${'response'.$i},true);
						}
						
						$id1 = $upload_response1['F'];
						$id2 = $upload_response2['F'];

						if($id1){
							$id1 = "/v1-sftp/kyc-remittance/".$upload_response1['F'];
						}
						if($id2){
							$id2 = "/v1-sftp/kyc-remittance/".$upload_response2['F'];
						}

					}else{
						$data['AddSender']['S'] = 0;
						$data['AddSender']['M'] = "FILE SIZE TOO BIG MUST BE LESS THAN 2MB";
					}

					if($id1){
						$parameter =array(
							'dev_id'    	   	=> $this->global_f->dev_id(),
							'ip_address'		=> $this->ip,
							'actionId' 	 		=> _remittance_add_user_bsp,
							'regcode'   		=> $this->user['R'],
							'transpass' 		=> $INPUT_POST['inputTpass'],
							'fname'				=> $INPUT_POST['inputFname'],
							'mname'				=> $INPUT_POST['inputMname'],
							'lname'				=> $INPUT_POST['inputLname'],
							'suffix'			=> $INPUT_POST['inpuSuffix'],
							'birthdate'			=> $INPUT_POST['inputBdate'],
							'birthplace'		=> $INPUT_POST['inputBirthplace'],
							'address_details'	=> $INPUT_POST['inputStreet'],
							'brgy'				=> $INPUT_POST['inputBarangay'],
							'city'				=> $INPUT_POST['inputCity'],
							'province'			=> $INPUT_POST['inputProvince'],
							'zip'				=> $INPUT_POST['inputPostal'],
							'country'			=> $INPUT_POST['inputCountry'],
							'permanent_address'	=> $INPUT_POST['inputStreet2'] . ", " . $INPUT_POST['inputBarangay2'] . ", " . $INPUT_POST['inputCity2'] . ", " . $INPUT_POST['inputProvince2'] . ", " . $INPUT_POST['inputCountry2'] . ", " . $INPUT_POST['inputPostal2'],
							'mobile'			=> $INPUT_POST['inputMobile'],
							'email'				=> $INPUT_POST['inputEmail'],
							'occupation'		=> $INPUT_POST['inputOccupation'],
							'sourcefund'		=> $INPUT_POST['inutSourceoffund'],
							'nationality'		=> $INPUT_POST['inputNationality'],
							'idtype1'			=> $INPUT_POST['newidtype'],
							'idno1'				=> $INPUT_POST['newidnumber'],
							'idexpiration1'		=> $INPUT_POST['newexpirydate1'],
							'idlink1'			=> $id1,
							'idtype2'			=> $INPUT_POST['newidtype2'],
							'idno2'				=> $INPUT_POST['newidnumber2'],
							'idexpiration2'		=> $INPUT_POST['newexpirydate12'],
							'idlink2'			=> $id2,
							$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
						);
	
						$result = $this->curl->call($parameter,$url);
						$data['AddSender'] = json_decode($result,true);
						
					}else{
						$data['AddSender']['S'] = 0;
						$data['AddSender']['M'] = "UPLOADING IMAGE FAILED";
					}
						
				}elseif(isset($_POST['btnAddSenderBSPDealer'])) //Add Dealer BSP WALLET TOPUP --REMOVED--
				{
					$INPUT_POST = $this->input->post(null,true);
					$T_VALUE = md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));
					$url = url;
					
					for($i = 1; $i <= 2; $i++){
						${'file'.$i} 			= $_FILES['fileDealer'.$i];
						${'file'.$i.'Name'} 	= ${'file'.$i}['name'];
						${'file'.$i.'Size'}		= ${'file'.$i}['size'];
						${'file'.$i.'Temp'}		= ${'file'.$i}['tmp_name'];
						${'file'.$i.'Error'} 	= ${'file'.$i}['error'];
					}

					if($file1Size < 2*MB || $file2Size < 2*MB) {

						for($a = 1; $a <= 2; $a++){

							${'url'.$a} = ${'file'.$a.'Temp'};
							if(${'file'.$a.'Size'} > 1*MB)
							{
								${'old_size'.$a} = ${'file'.$a.'Size'};
								${'urltmp'.$a}	 = sys_get_temp_dir().'/tmp.jpg';
								
								${'filename'.$a} = $this->compress_image(${'file'.$a.'Size'}, ${'urltmp'.$a}, 75);
								${'new_size'.$a} = filesize(${'urltmp'.$a});
							
								if(${'new_size'.$a} < ${'old_size'.$a})
								{
									${'url'.$a} = ${'urltmp'.$a};
								}
							}
							
							${'curl'.$a} = curl_init();
							${'localfile'.$a} = ${'url'.$a};
						}

						for($i = 1; $i <= 2; $i++){
							curl_setopt_array(${'curl'.$i}, array(
								CURLOPT_URL => 'https://unified.ph/kyc-upload',
								CURLOPT_RETURNTRANSFER => true,
								CURLOPT_ENCODING => '',
								CURLOPT_MAXREDIRS => 10,
								CURLOPT_TIMEOUT => 0,
								CURLOPT_FOLLOWLOCATION => true,
								CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
								CURLOPT_CUSTOMREQUEST => 'POST',
								CURLOPT_POSTFIELDS => array('file'=> new CURLFILE(${'localfile'.$i}),'file_location' => 'kyc-remittance','regcode' => $this->user['R'],'email' => '123','ext_name' => '.jpg'),
							));
							
							${'response'.$i} = curl_exec(${'curl'.$i}); 
							curl_close(${'curl'.$i});
							${'upload_response'.$i} = json_decode(${'response'.$i},true);
						}
						
						$id1 = $upload_response1['F'];
						$id2 = $upload_response2['F'];

						if($id1){
							$id1 = "/v1-sftp/kyc-remittance/".$upload_response1['F'];
						}
						if($id2){
							$id2 = "/v1-sftp/kyc-remittance/".$upload_response2['F'];
						}

					}else{
						$data['AddSender']['S'] = 0;
						$data['AddSender']['M'] = "FILE SIZE TOO BIG MUST BE LESS THAN 2MB";
					}

					if($id1){
						$parameter =array(
							'dev_id'    	   	=> $this->global_f->dev_id(),
							'ip_address'		=> $this->ip,
							'actionId' 	 		=> _remittance_add_user_bsp,
							'regcode'   		=> $this->user['R'],
							'transpass' 		=> $INPUT_POST['inputTpass'],
							'fname'				=> $INPUT_POST['inputFnameDealer'],
							'mname'				=> $INPUT_POST['inputMnameDealer'],
							'lname'				=> $INPUT_POST['inputLnameDealer'],
							'suffix'			=> $INPUT_POST['inpuSuffixDealer'],
							'birthdate'			=> $INPUT_POST['inputBdateDealer'],
							'birthplace'		=> $INPUT_POST['inputBirthplaceDealer'],
							'address_details'	=> $INPUT_POST['inputStreetDealer'],
							'brgy'				=> $INPUT_POST['inputBarangayDealer'],
							'city'				=> $INPUT_POST['inputCityDealer'],
							'province'			=> $INPUT_POST['inputProvinceDealer'],
							'zip'				=> $INPUT_POST['inputPostalDealer'],
							'country'			=> $INPUT_POST['inputCountryDealer'],
							'permanent_address'	=> $INPUT_POST['inputStreet2Dealer'] . ", " . $INPUT_POST['inputBarangay2Dealer'] . ", " . $INPUT_POST['inputCity2Dealer'] . ", " . $INPUT_POST['inputProvince2Dealer'] . ", " . $INPUT_POST['inputCountry2Dealer'] . ", " . $INPUT_POST['inputPostal2Dealer'],
							'mobile'			=> $INPUT_POST['inputMobileDealer'],
							'email'				=> $INPUT_POST['inputEmailDealer'],
							'occupation'		=> $INPUT_POST['inputOccupationDealer'],
							'sourcefund'		=> $INPUT_POST['inutSourceoffundDealer'],
							'nationality'		=> $INPUT_POST['inputNationalityDealer'],
							'idtype1'			=> $INPUT_POST['newidtypeDealer'],
							'idno1'				=> $INPUT_POST['newidnumberDealer'],
							'idexpiration1'		=> $INPUT_POST['newexpirydate1Dealer'],
							'idlink1'			=> $id1,
							'idtype2'			=> $INPUT_POST['newidtype2Dealer'],
							'idno2'				=> $INPUT_POST['newidnumber2Dealer'],
							'idexpiration2'		=> $INPUT_POST['newexpirydate12Dealer'],
							'idlink2'			=> $id2,
							$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
						);

						$result = $this->curl->call($parameter,$url);
						$data['AddSender'] = json_decode($result,true);
						
					}else{
						$data['AddSender']['S'] = 0;
						$data['AddSender']['M'] = "UPLOADING IMAGE FAILED";
					}
				}elseif(isset($_POST['proceedTransac'])) // Process the ECCASH WALLET BSP form 
	 			{
	 				$INPUT_POST =$this->input->post(null,true);
					 $url = url;

					$param1 =array(
						'actionId' 	 => 'ups_ecash_service/remittance_selected_sender_bsp',
						'dev_id' 	 => $this->global_f->dev_id(),
						'regcode'	 => $this->user['R'],
						'rowid' 	 => $INPUT_POST['transactSenderID'],
						'ip_address' => $this->ip
					); 

					$result1 = $this->curl->call($param1, $url);

					$param2 =array(
						'actionId' 	 => 'ups_ecash_service/remittance_selected_beneficiaryID_bsp',
						'dev_id' 	 => $this->global_f->dev_id(),
						'regcode'	 => $this->user['R'],
						'rowid' 	 => $INPUT_POST['transactBeneID'],
						'ip_address' => $this->ip
					); 

					$result2 = $this->curl->call($param2, $url);
					
					$data['selectedID1'] = json_decode($result1, true);
					$data['selectedID2'] = json_decode($result2, true);
					
					if($data['selectedID1']['result'][0]['fname'] == $data['selectedID2']['result'][0]['fname'] &&
						$data['selectedID1']['result'][0]['lname'] == $data['selectedID2']['result'][0]['lname'] &&
						$data['selectedID1']['result'][0]['birthDate'] == $data['selectedID2']['result'][0]['birthdate']){

						$senderID = $INPUT_POST['transactSenderID'];
						$fname = $data['selectedID1']['result'][0]['fname'];
						$lname = $data['selectedID1']['result'][0]['lname'];

						$url = url;
				
						$parameter =array(
							'actionId' 	 => 'ups_ecash_service/remittance_search_bene_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'sender_id'  => $senderID,
							'ip_address' => $this->ip
						); 

						$result = $this->curl->call($parameter,$url);
						$data['row'] = json_decode($result,true);
						
						if($data['row']['S']===0){
							$data['rowMessage'] = "NO BENEFICIARY FOUND";

							$param1 =array(
								'dev_id'     		=> $this->global_f->dev_id(),
								'actionId' 	 		=> _remittance_search_bsp,
								'fname'  			=> $fname,
								'lname'  			=> $lname,
								'regcode' 			=> $this->user['R'],
								'ip_address'		=> $this->ip
							); 

							$resultAPI = $this->curl->call($param1, $url);
							$data['row'] = json_decode($resultAPI, true);
							
							if ($data['row']['S']==1) {
								$data['type'] = array('typeid'=>1,
														'typedesc'=>'Sender');
							}
						}else{
							$data['rowMessage'] = "CANNOT PROCEED, SENDER AND BENEFICIARY DETAILS ARE THE SAME";
							$param2 =array(
								'actionId' 	 => 'ups_ecash_service/remittance_selected_sender_bsp',
								'dev_id' 	 => $this->global_f->dev_id(),
								'regcode'	 => $this->user['R'],
								'rowid' 	 => $senderID,
								'ip_address' => $this->ip
							); 
		
							$resultSelected = $this->curl->call($param2 ,$url);
							$data['selectedSender'] = json_decode($resultSelected,true);
							
							$senderinfo = explode("|", $this->input->post('inputSenderHide'));
					
							$data['type'] = array('typeid'=>2,
												'typedesc'=>'Beneficiary',
												'inputSenderName' => $senderinfo[1],
												'inputSender'    	=> $this->input->post('inputSenderHide'));	
						}
					}else{
						$data['okTransac']['S'] = 1;
					}
				
	 			}elseif(isset($_POST['submitOTP'])) // Process submit OTP BSP WALLET TOPUP
	 			{
	 				$INPUT_POST =$this->input->post(null,true);
					$url = url;

					$parameter =array(
						'actionId' 	 => 'ups_ecash_service/otpValidate',
						'dev_id' 	 => $this->global_f->dev_id(),
						'regcode'	 => $this->user['R'],
						'traceno' 	 => $INPUT_POST['traceno'],
						'otp' 	 	 => $INPUT_POST['otpCode'],
						'ip_address' => $this->ip
					); 

					$result = $this->curl->call($parameter, $url);

					$data['otpResult'] = json_decode($result, true);
					
					if($data['otpResult']['S'] == 1){
						for($i = 1; $i <= 2; $i++){
							${'file'.$i} 			= $_FILES['fileHigh'.$i];
							${'file'.$i.'Name'} 	= ${'file'.$i}['name'];
							${'file'.$i.'Size'}		= ${'file'.$i}['size'];
							${'file'.$i.'Temp'}		= ${'file'.$i}['tmp_name'];
							${'file'.$i.'Error'} 	= ${'file'.$i}['error'];
						}
	
						if($file1Size < 2*MB) {
				
							for($a = 1; $a <= 1; $a++){
				
								${'url'.$a} = ${'file'.$a.'Temp'};
								if(${'file'.$a.'Size'} > 1*MB)
								{
									${'old_size'.$a} = ${'file'.$a.'Size'};
									${'urltmp'.$a}	 = sys_get_temp_dir().'/tmp.jpg';
									
									${'filename'.$a} = $this->compress_image(${'file'.$a.'Size'}, ${'urltmp'.$a}, 75);
									${'new_size'.$a} = filesize(${'urltmp'.$a});
								
									if(${'new_size'.$a} < ${'old_size'.$a})
									{
										${'url'.$a} = ${'urltmp'.$a};
									}
								}
								
								${'curl'.$a} = curl_init();
								${'localfile'.$a} = ${'url'.$a};
							}
				
							for($i = 1; $i <= 2; $i++){
								curl_setopt_array(${'curl'.$i}, array(
									CURLOPT_URL => 'https://unified.ph/kyc-upload',
									CURLOPT_RETURNTRANSFER => true,
									CURLOPT_ENCODING => '',
									CURLOPT_MAXREDIRS => 10,
									CURLOPT_TIMEOUT => 0,
									CURLOPT_FOLLOWLOCATION => true,
									CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
									CURLOPT_CUSTOMREQUEST => 'POST',
									CURLOPT_POSTFIELDS => array('file'=> new CURLFILE(${'localfile'.$i}),'file_location' => 'kyc-remittance','regcode' => $this->user['R'],'email' => '123','ext_name' => '.jpg'),
								));
								
								${'response'.$i} = curl_exec(${'curl'.$i}); 
								curl_close(${'curl'.$i});
								${'upload_response'.$i} = json_decode(${'response'.$i},true);
							}
							
							$id1 = $upload_response1['F'];
	
							if($id1){
								$id1 = "/v1-sftp/kyc-remittance/OTP_".$upload_response1['F'];
							}
	
						}

						if($id1){
							$param =array(
								'actionId' 	 => 'ups_ecash_service/remittance_wallet_topup_bsp_confirm',
								'dev_id' 	 => $this->global_f->dev_id(),
								'regcode'	 => $this->user['R'],
								'traceno' 	 => $INPUT_POST['traceno'],
								'action' 	 => 'APPROVED',
								'item_type'	 => 'PHOTO',
								'photolink'  => $id1,
								'ip_address' => $this->ip
							); 
	
							$resultAPI = $this->curl->call($param, $url);
	
							$data['transactConfirm'] = json_decode($resultAPI, true);
						}else{
							$data['transactConfirm']['S'] = 0;
							$data['transactConfirm']['M'] = "UPLOADING IMAGE FAILED";
						}

					}

	 			}elseif(isset($_POST['btnSubmitBSP'])) // submit Tranasction BSP WALLET TOPUP API 
	 			{
	 				
	 				$INPUT_POST =$this->input->post(null,true);
					$url = url;
		
					$parameter =array(
						'actionId' 	  => 'ups_ecash_service/remittance_send_credit_bank_bsp', //WALLET TOPUP USES SIMILAR API WITH CREDITTOBANK
						'dev_id' 	  => $this->global_f->dev_id(),
						'regcode'	  => $this->user['R'],
						'transpass'	  => $INPUT_POST['inputTpass'],
						'sender_id'   => $INPUT_POST['transacSenderID'],
						'receiver_id' => $INPUT_POST['transacBeneID'],
						'relation' 	  => $INPUT_POST['inputRelation'],
						'purpose' 	  => $INPUT_POST['inputPurpose'],
						'service'     => $INPUT_POST['inputService'],
						'service_type'=> $INPUT_POST['serviceType'],
						'firstfield'  => $INPUT_POST['firstField'],
						'secondfield' => $INPUT_POST['secondField'],
						'currency' 	  => $INPUT_POST['inputCurrency'],
						'principal'	  => $INPUT_POST['inputAmount'],
						'ip_address'  => $this->ip
					);

				    $result = $this->curl->call($parameter,$url);
					$data['transactStatus'] = json_decode($result,true);
					$data['receiptCharge'] = $INPUT_POST['inputCharge'];
					
					if($data['transactStatus']['S'] == 1){
						
						$data['level'] = $this->user['L'];
						if(($data['level'] != 7) && ($data['level'] != 16)){  
							$traceno = $data['transactStatus']['TN'];
	
							$data['receiptResult'] = "APPROVED";

							$paramLowDetails =array(
								'actionId' 	 => 'ups_ecash_service/fetch_traceno_details',
								'dev_id' 	 => $this->global_f->dev_id(),
								'regcode'	 => $this->user['R'],
								'traceno'	 => $traceno,
								'ip_address' => $this->ip
							);
							
							$fetchLowDetails = $this->curl->call($paramLowDetails, $url);
							$data['tracenoDetails'] = json_decode($fetchLowDetails,true);

							$data['receiptResult'] = "PENDING";
							$data['transactDealer']['S'] = 1;
						}
						elseif($data['transactStatus']['RISK'] == "LOW"){
							$param =array(
								'actionId' 	 => 'ups_ecash_service/remittance_wallet_topup_bsp_confirm',
								'dev_id' 	 => $this->global_f->dev_id(),
								'regcode'	 => $this->user['R'],
								'traceno' 	 => $data['transactStatus']['TN'],
								'action' 	 => 'APPROVED',
								'ip_address' => $this->ip
							); 	
	
							$resultAPI = $this->curl->call($param, $url);
							$data['transactConfirmLow'] = json_decode($resultAPI,true);
	
							if($data['transactConfirmLow']['S'] == 1){
								$traceno = $data['transactStatus']['TN'];
	
								$data['receiptResult'] = "APPROVED";
	
								$paramLowDetails =array(
									'actionId' 	 => 'ups_ecash_service/fetch_traceno_details',
									'dev_id' 	 => $this->global_f->dev_id(),
									'regcode'	 => $this->user['R'],
									'traceno'	 => $traceno,
									'ip_address' => $this->ip
								);
								
								$fetchLowDetails = $this->curl->call($paramLowDetails, $url);
								$data['tracenoDetails'] = json_decode($fetchLowDetails,true);
								
								$paramLow =array(
									'actionId' 	 => 'ups_ecash_service/remittance_wallet_topup_bsp_transac',
									'dev_id' 	 => $this->global_f->dev_id(),
									'regcode'	 => $this->user['R'],
									'traceno'	 => $traceno,
									'ip_address' => $this->ip,
									'ip' => $this->ip
								);
	
								$resultLowAPI = $this->curl->call($paramLow, $url);
								$data['transactBSPLow'] = json_decode($resultLowAPI,true);
	
								// NOTIFY APPROVED BSP TRANSACTION
								$refno = $data['transactBSPLow']['TN'];
								
								$notifLow =array(
									'actionId' 	 => 'ups_ecash_service/notifySenderReceiver',
									'dev_id' 	 => $this->global_f->dev_id(),
									'regcode'	 => $this->user['R'],
									'traceno'	 => $traceno,
									'refno'	  	 => $refno,
									'type'	  	 => "APPROVE",
									'ip_address' => $this->ip
								);
	
								$resultLowNotif = $this->curl->call($notifLow, $url);
								$data['notifLow'] = json_decode($resultLowNotif,true);
							}
						}
						elseif($data['transactStatus']['RISK'] == "NORMAL" || $data['transactStatus']['RISK'] == "HIGH"){
							$param1 =array(
								'actionId' 	  => 'ups_ecash_service/risk_profiling',
								'dev_id' 	  => $this->global_f->dev_id(),
								'regcode'	  => $this->user['R'],
								'traceno'	  => $data['transactStatus']['TN'],
								'ip_address'  => $this->ip
							);
		
							$resultAPI1 = $this->curl->call($param1,$url);
							$data['RISK_DESCRIPTION'] = json_decode($resultAPI1,true);
							
							$param2 =array(
								'actionId' 	  => 'ups_ecash_service/checkRiskProfile',
								'dev_id' 	  => $this->global_f->dev_id(),
								'regcode'	  => $this->user['R'],
								'traceno'	  => $data['transactStatus']['TN'],
								'ip_address'  => $this->ip
							);
		
							$resultAPI2 = $this->curl->call($param2, $url);
							$data['OTP'] = json_decode($resultAPI2,true);
							
	
							$param3 =array(
								'actionId' 	  => 'ups_ecash_service/fetch_traceno_details',
								'dev_id' 	  => $this->global_f->dev_id(),
								'regcode'	  => $this->user['R'],
								'traceno'	  => $data['transactStatus']['TN'],
								'ip_address'  => $this->ip
							);
		
							$resultAPI3 = $this->curl->call($param3, $url);
							$data['tracenoDetails'] = json_decode($resultAPI3,true);
							
	
						}
					}else{
						$param1 =array(
							'actionId' 	 => 'ups_ecash_service/remittance_selected_sender_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'rowid'		 => $INPUT_POST['transacSenderID'],
							'ip_address' => $this->ip
						); 
	
						$result1 = $this->curl->call($param1, $url);
	
						$param2 =array(
							'actionId' 	 => 'ups_ecash_service/remittance_selected_beneficiaryID_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'rowid'		 => $INPUT_POST['transacBeneID'],
							'ip_address' => $this->ip
						); 
	
						$result2 = $this->curl->call($param2, $url);
	
						$data['selectedID1'] = json_decode($result1, true);
						$data['selectedID2'] = json_decode($result2, true);
					}
					
	 			}
				if($CHECK_MISSING_DATA == 1) {
					$this->load->view('layout/header',$data);
					$this->load->view('element/top_header');
					$this->load->view('element/wrapper_header');
					$this->load->view('element/left_panel');
					$this->load->view('remittance/ecash_send/updateDealer'); //UPDATE DEALER SENDER DETAILS
					$this->load->view('element/wrapper_footer');
					$this->load->view('layout/footer');
				}else{
					$this->load->view('layout/header',$data);
					$this->load->view('element/top_header');
					$this->load->view('element/wrapper_header');
					$this->load->view('element/left_panel');
					$this->load->view('remittance/ecash_send/ecash_topup_wallet'); // WALLET TOPUP UI BSP
					$this->load->view('element/wrapper_footer');
					$this->load->view('layout/footer');
				}
			}else {
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
			redirect('Main/');
		}

	}
	//END OF WALLET TOPUP

	// Updated by Harry 5/22/2019

	public function ecashcredittobank() 
	{
		if ($this->user['A_CTRL']['remittance'] == 1 && $this->user['A_CTRL']['remittance_creditbank_send'] == 1){

			$data = array('menu' => 2,
					  'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$this->check_trans->gwlCheckTransLimit(32); //FOR WEALTHY LIFESTYLE

				$data['user'] = $this->user;
				$url = url;
				$parameter =array(
							'dev_id'	 => $this->global_f->dev_id(),
							'actionId'	 => _get_active_banks,
		    				'search_key' => $search,
		    				'regcode' 	 => $this->user['R'],
		    				'ip_address' => $this->ip
		    				); 

			    $result = $this->curl->call($parameter,$url);
				$bankresult = json_decode($result,true);


				$data['banks'] = array();
			    foreach ($bankresult['B_DATA'] as $key => $value){
					$data['banks'][$key] = $value['BANK_ID'].'*'.$value['BANK_DESCRIPTION'].'*'.$value['group'].'*'.$value['BANK_MNEMONIC'];
			    }

				$data['level'] = $this->user['L'];
				$testing = $this->testBSP();
				if(($data['level'] != 7) && ($data['level'] != 16)){                    
					$data['DEALER']['M'] = "DEALER";

					$searchFname = $this->user['FIRSTNAME'];
					$searchLname = $this->user['LASTNAME'];

					$url = url;
					$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId' 	 		=> _remittance_search_bsp,
						'fname'  			=> $searchFname,
						'lname'  			=> $searchLname,
						'regcode' 			=> $this->user['R'],
						'ip_address'		=> $this->ip
					); 

					$result = $this->curl->call($parameter,$url);
					$data['rowD'] = json_decode($result,true);

				   	if ($data['rowD']['S']==1) {
						$data['dealerSenderID'] = $data['rowD']['result'][0]['id'];

						$parameter = array(
							'dev_id'     		=> $this->global_f->dev_id(),
							'actionId' 	 		=> 'ups_ecash_service/remittance_check_sender_details',
							'fname'  			=> $searchFname,
							'lname'  			=> $searchLname,
							'regcode' 			=> $this->user['R'],
							'ip_address'		=> $this->ip
						); 

						$result = $this->curl->call($parameter,$url);
						$data['checkSender'] = json_decode($result,true);

						if($data['checkSender']['result'][0]['permanentAddress'] == "" || $data['checkSender']['result'][0]['permanentAddress'] == null){
							$data['missingSD']['permanentAddress'] = '';
						}

						if($data['checkSender']['result'][0]['placeOfBirth'] == "" || $data['checkSender']['result'][0]['placeOfBirth'] == null){
							$data['missingSD']['placeOfBirth'] = '';
						}

						if($data['checkSender']['result'][0]['sourceOfFund'] == "" || $data['checkSender']['result'][0]['sourceOfFund'] == null){
							$data['missingSD']['sourceOfFund'] = '';
						}

						if($data['checkSender']['id'] == "" || $data['checkSender']['id'] == null) {
							$data['missingSD']['id'] = '';
						}

						$CHECK_MISSING_DATA = 0;
						foreach($data['missingSD'] as $i){
							if(empty($i)){
								$CHECK_MISSING_DATA = 1;
							}
						}
						
						$senderID = $data['rowD']['result'][0]['id'];
						$fname = $data['rowD']['result'][0]['fname'];
						$lname = $data['rowD']['result'][0]['lname'];

						$param1 =array(
							'actionId' 	 => 'ups_ecash_service/remittance_search_bene_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'sender_id'  => $senderID,
							'ip_address' => $this->ip
						); 

						$result = $this->curl->call($param1,$url);
						$data['row'] = json_decode($result,true);
						
						if($data['row']['S']===0){
							$data['rowMessage'] = "NO BENEFICIARY FOUND";

							$param1 =array(
								'dev_id'     		=> $this->global_f->dev_id(),
								'actionId' 	 		=> _remittance_search_bsp,
								'fname'  			=> $fname,
								'lname'  			=> $lname,
								'regcode' 			=> $this->user['R'],
								'ip_address'		=> $this->ip
							); 

							$resultAPI = $this->curl->call($param1, $url);
							$data['row'] = json_decode($resultAPI, true);
							
							if ($data['row']['S']==1) {
								$data['type'] = array('typeid'=>1,
														'typedesc'=>'Sender');
							}
						}else{
							$param2 =array(
								'actionId' 	 => 'ups_ecash_service/remittance_selected_sender_bsp',
								'dev_id' 	 => $this->global_f->dev_id(),
								'regcode'	 => $this->user['R'],
								'rowid' 	 => $senderID,
								'ip_address' => $this->ip
							); 
		
							$resultSelected = $this->curl->call($param2 ,$url);
							$data['selectedSender'] = json_decode($resultSelected,true);
							
							$senderinfo = explode("|", $this->input->post('inputSenderHide'));
					
							$data['type'] = array('typeid'=>2,
												'typedesc'=>'Beneficiary',
												'inputSenderName' => $senderinfo[1],
												'inputSender'    	=> $this->input->post('inputSenderHide'));	
						}
					}
					if($data['rowD']['M'] == "NO MATCH FOUND"){
						$data['DEALER']['M'] = "NEW";
					}
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
					
				 
	 			}elseif (isset($_POST['btnSearchSenderBSP'])) //Search Sender BSP CTB
				{
 
					$searchFname = $this->input->post('inputSearchFname');
					$searchLname = $this->input->post('inputSearchLname');

					$url = url;
					$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId' 	 		=> _remittance_search_bsp,
						'fname'  			=> $searchFname,
						'lname'  			=> $searchLname,
						'regcode' 			=> $this->user['R'],
						'ip_address'		=> $this->ip
					); 
 
					$result = $this->curl->call($parameter,$url);
					$data['row'] = json_decode($result,true);
 
					if ($data['row']['S']==1) {
						$data['type'] = array('typeid'=>1,
											 'typedesc'=>'Sender');
					}
					
				}elseif (isset($_POST['btnSearchBeneBSP'])) //Search Benificiary BSP CTB
				{
					$senderID = $this->input->post('selectedSenderID');
					$fname = $this->input->post('selectedSenderFname');
					$lname = $this->input->post('selectedSenderLname');

					$url = url;
			
					$parameter =array(
						'actionId' 	 => 'ups_ecash_service/remittance_search_bene_bsp',
						'dev_id' 	 => $this->global_f->dev_id(),
						'regcode'	 => $this->user['R'],
						'sender_id'  => $senderID,
						'ip_address' => $this->ip
					); 

				    $result = $this->curl->call($parameter,$url);
					$data['row'] = json_decode($result,true);
					
					if($data['row']['S']===0){
						$data['rowMessage'] = "NO BENEFICIARY FOUND";

						$param1 =array(
							'dev_id' 	 => $this->global_f->dev_id(),
							'actionId' 	 => _remittance_search_bsp,
							'fname' 	 => $fname,
							'lname' 	 => $lname,
							'regcode' 	 => $this->user['R'],
							'ip_address' => $this->ip
						); 

						$resultAPI = $this->curl->call($param1, $url);
						$data['row'] = json_decode($resultAPI, true);
						
						if ($data['row']['S']==1) {
							$data['type'] = array('typeid'=>1,
													'typedesc'=>'Sender');
						}
					}else{
						$param2 =array(
							'actionId' 	 => 'ups_ecash_service/remittance_selected_sender_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'rowid' 	 => $senderID,
							'ip_address' => $this->ip
						); 
	
						$resultSelected = $this->curl->call($param2 ,$url);
						$data['selectedSender'] = json_decode($resultSelected,true);
						
						$senderinfo = explode("|", $this->input->post('inputSenderHide'));
				
						$data['type'] = array('typeid'=>2,
											  'typedesc'=>'Beneficiary',
											  'inputSenderName' => $senderinfo[1],
											  'inputSender'    	=> $this->input->post('inputSenderHide'));	
					}

	 			}elseif(isset($_POST['btnAddSenderBSP'])){ //Add Sender BSP CTB
					$INPUT_POST =$this->input->post(null,true);
					$T_VALUE =md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));
					$url = url;

					for($i = 1; $i <= 2; $i++){
						${'file'.$i} 			= $_FILES['file'.$i];
						${'file'.$i.'Name'} 	= ${'file'.$i}['name'];
						${'file'.$i.'Size'}		= ${'file'.$i}['size'];
						${'file'.$i.'Temp'}		= ${'file'.$i}['tmp_name'];
						${'file'.$i.'Error'} 	= ${'file'.$i}['error'];
					}

				   	if($file1Size < 2*MB || $file2Size < 2*MB) {
		   
					   for($a = 1; $a <= 2; $a++){
		   
							${'url'.$a} = ${'file'.$a.'Temp'};
							if(${'file'.$a.'Size'} > 1*MB)
							{
								${'old_size'.$a} = ${'file'.$a.'Size'};
								${'urltmp'.$a}	 = sys_get_temp_dir().'/tmp.jpg';
								
								${'filename'.$a} = $this->compress_image(${'file'.$a.'Size'}, ${'urltmp'.$a}, 75);
								${'new_size'.$a} = filesize(${'urltmp'.$a});
							
								if(${'new_size'.$a} < ${'old_size'.$a})
								{
									${'url'.$a} = ${'urltmp'.$a};
								}
							}
						   
						   ${'curl'.$a} = curl_init();
						   ${'localfile'.$a} = ${'url'.$a};
					   }
		   
					   for($i = 1; $i <= 2; $i++){
							curl_setopt_array(${'curl'.$i}, array(
								CURLOPT_URL => 'https://unified.ph/kyc-upload',
								CURLOPT_RETURNTRANSFER => true,
								CURLOPT_ENCODING => '',
								CURLOPT_MAXREDIRS => 10,
								CURLOPT_TIMEOUT => 0,
								CURLOPT_FOLLOWLOCATION => true,
								CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
								CURLOPT_CUSTOMREQUEST => 'POST',
								CURLOPT_POSTFIELDS => array('file'=> new CURLFILE(${'localfile'.$i}),'file_location' => 'kyc-remittance','regcode' => $this->user['R'],'email' => '123','ext_name' => '.jpg'),
							));
						   
						   ${'response'.$i} = curl_exec(${'curl'.$i}); 
						   curl_close(${'curl'.$i});
						   ${'upload_response'.$i} = json_decode(${'response'.$i},true);
					   }
					   
					   $id1 = $upload_response1['F'];
					   $id2 = $upload_response2['F'];

						if($id1){
							$id1 = "/v1-sftp/kyc-remittance/".$upload_response1['F'];
						}
						if($id2){
							$id2 = "/v1-sftp/kyc-remittance/".$upload_response2['F'];
						}

					}else{
						$data['AddSender']['S'] = 0;
						$data['AddSender']['M'] = "FILE SIZE TOO BIG MUST BE LESS THAN 2MB";
					}

					if($id1){
						$parameter =array(
							'dev_id'			=> $this->global_f->dev_id(),
							'ip_address'		=> $this->ip,
							'actionId'			=> _remittance_add_user_bsp,
							'regcode'			=> $this->user['R'],
							'transpass'			=> $INPUT_POST['inputTpass'],
							'fname'				=> $INPUT_POST['inputFname'],
							'mname'				=> $INPUT_POST['inputMname'],
							'lname'				=> $INPUT_POST['inputLname'],
							'suffix'			=> $INPUT_POST['inpuSuffix'],
							'birthdate'			=> $INPUT_POST['inputBdate'],
							'birthplace'		=> $INPUT_POST['inputBirthplace'],
							'address_details'	=> $INPUT_POST['inputStreet'],
							'brgy'				=> $INPUT_POST['inputBarangay'],
							'city'				=> $INPUT_POST['inputCity'],
							'province'			=> $INPUT_POST['inputProvince'],
							'zip'				=> $INPUT_POST['inputPostal'],
							'country'			=> $INPUT_POST['inputCountry'],
							'permanent_address'	=> $INPUT_POST['inputStreet2'] . ", " . $INPUT_POST['inputBarangay2'] . ", " . $INPUT_POST['inputCity2'] . ", " . $INPUT_POST['inputProvince2'] . ", " . $INPUT_POST['inputCountry2'] . ", " . $INPUT_POST['inputPostal2'],
							'mobile'			=> $INPUT_POST['inputMobile'],
							'email'				=> $INPUT_POST['inputEmail'],
							'occupation'		=> $INPUT_POST['inputOccupation'],
							'sourcefund'		=> $INPUT_POST['inutSourceoffund'],
							'nationality'		=> $INPUT_POST['inputNationality'],
							'idtype1'			=> $INPUT_POST['newidtype'],
							'idno1'				=> $INPUT_POST['newidnumber'],
							'idexpiration1'		=> $INPUT_POST['newexpirydate1'],
							'idlink1'			=> $id1,
							'idtype2'			=> $INPUT_POST['newidtype2'],
							'idno2'				=> $INPUT_POST['newidnumber2'],
							'idexpiration2'		=> $INPUT_POST['newexpirydate12'],
							'idlink2'			=> $id2,
							$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
						);
	
						$result = $this->curl->call($parameter,$url);
						$data['AddSender'] = json_decode($result,true);
						
					}else{
						$data['AddSender']['S'] = 0;
						$data['AddSender']['M'] = "UPLOADING IMAGE FAILED";
					}
					   
				}elseif(isset($_POST['btnAddDetailsBene'])) //Add benificiary BSP CTB
	 			{
	 				$INPUT_POST =$this->input->post(null,true);
	 				$T_VALUE =md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));
	 				$url = url;
					$parameter =array(
						'dev_id'    	    => $this->global_f->dev_id(),
						'ip_address'		=> $this->ip,
						'actionId' 	 		=> _remittance_add_bene_bsp,
						'regcode'   		=> $this->user['R'],
						'transpass' 		=> $INPUT_POST['inputTpass'],
						'sender_id'			=> $INPUT_POST['senderID'],
						'fname' 			=> $INPUT_POST['inputFnameBene'],
						'mname' 			=> $INPUT_POST['inputMnameBene'],
						'lname' 			=> $INPUT_POST['inputLnameBene'],
						'suffix' 			=> $INPUT_POST['inpuSuffixBene'],
						'birthdate' 		=> $INPUT_POST['inputBdateBene'],
						'address_details' 	=> $INPUT_POST['inputStreetBene'] .", ". $INPUT_POST['inputBarangayBene'] .", ". $INPUT_POST['inputCityBene'] .", ". $INPUT_POST['inputProvinceBene'] .", ". $INPUT_POST['inputCountryBene'] .", ". $INPUT_POST['inputPostalBene'],
						'country' 			=> $INPUT_POST['inputCountryBene'],
						'mobile'			=> $INPUT_POST['inputMobileBene'],
						'email' 			=> $INPUT_POST['inputEmailBene'],
						$this->user['SKT']	=> md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
					);

					$result = $this->curl->call($parameter,$url);
					$data['AddBene'] = json_decode($result,true);

					if($data['AddBene']['S']==1){
						$parameter =array(
							'dev_id'     => $this->global_f->dev_id(),
							'ip_address' => $this->ip,
							'actionId' 	 => _remittance_search_bene_bsp,
							'regcode'    => $this->user['R'],
							'fname' 	 => $INPUT_POST['inputFnameBene'],
							'lname' 	 => $INPUT_POST['inputLnameBene'],
							'birthdate'  => $INPUT_POST['inputBdateBene'],
							'senderID'	 => $INPUT_POST['senderID'],
						);
						$result = $this->curl->call($parameter,$url);
						$data['beneDetails'] = json_decode($result,true);

						$param1 =array(
							'actionId' 	 => 'ups_ecash_service/remittance_selected_sender_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'rowid' 	 => $data['beneDetails']['result'][0]['sender_id'],
							'ip_address' => $this->ip
						); 
	
						$result1 = $this->curl->call($param1, $url);
	
						$param2 =array(
							'actionId' 	 => 'ups_ecash_service/remittance_selected_beneficiaryID_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'rowid'	 	 => $data['beneDetails']['result'][0]['id'],
							'ip_address' => $this->ip
						); 
	
						$result2 = $this->curl->call($param2, $url);
	
						$data['selectedID1'] = json_decode($result1, true);
						$data['selectedID2'] = json_decode($result2, true);
					}else{
						$senderID = $INPUT_POST['senderID'];
	
						$url = url;
				
						$parameter =array(
							'actionId' 	 => 'ups_ecash_service/remittance_search_bene_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'sender_id'  => $senderID,
							'ip_address' => $this->ip
						); 
	
						$result = $this->curl->call($parameter,$url);
						$data['row'] = json_decode($result,true);
						
						$fname = $data['row']['result'][0]['fname'];
						$lname = $data['row']['result'][0]['lname'];
						
						if($data['row']['S']===0){
							$data['rowMessage'] = "NO BENEFICIARY FOUND";
	
							$param1 =array(
								'dev_id'     		=> $this->global_f->dev_id(),
								'actionId' 	 		=> _remittance_search_bsp,
								'fname'  			=> $fname,
								'lname'  			=> $lname,
								'regcode' 			=> $this->user['R'],
								'ip_address'		=> $this->ip
							); 
	
							$resultAPI = $this->curl->call($param1, $url);
							$data['row'] = json_decode($resultAPI, true);
							
							if ($data['row']['S']==1) {
								$data['type'] = array('typeid'=>1,
														'typedesc'=>'Sender');
							}
						}else{
							$param2 =array(
								'actionId' 	 => 'ups_ecash_service/remittance_selected_sender_bsp',
								'dev_id' 	 => $this->global_f->dev_id(),
								'regcode'	 => $this->user['R'],
								'rowid' 	 => $senderID,
								'ip_address' => $this->ip
							); 
		
							$resultSelected = $this->curl->call($param2 ,$url);
							$data['selectedSender'] = json_decode($resultSelected,true);
							
							$senderinfo = explode("|", $this->input->post('inputSenderHide'));
					
							$data['type'] = array('typeid'=>2,
												  'typedesc'=>'Beneficiary',
												  'inputSenderName' => $senderinfo[1],
												  'inputSender'    	=> $this->input->post('inputSenderHide'));	
						}
					}
						
	 			}elseif(isset($_POST['proceedTransac'])) // Process the CreditToBank form 
	 			{
					$INPUT_POST =$this->input->post(null,true);
					$url = url;

					$param1 =array(
						'actionId'	 => 'ups_ecash_service/remittance_selected_sender_bsp',
						'dev_id'	 => $this->global_f->dev_id(),
						'regcode'	 => $this->user['R'],
						'rowid'		 => $INPUT_POST['transactSenderID'],
						'ip_address' => $this->ip
					); 

				   $result1 = $this->curl->call($param1, $url);

					$param2 =array(
						'actionId'	 => 'ups_ecash_service/remittance_selected_beneficiaryID_bsp',
						'dev_id'	 => $this->global_f->dev_id(),
						'regcode'	 => $this->user['R'],
						'rowid'		 => $INPUT_POST['transactBeneID'],
						'ip_address' => $this->ip
					); 

					$result2 = $this->curl->call($param2, $url);

					$data['selectedID1'] = json_decode($result1, true);
					$data['selectedID2'] = json_decode($result2, true);
					
					if($data['selectedID1']['result'][0]['fname'] == $data['selectedID2']['result'][0]['fname'] &&
						$data['selectedID1']['result'][0]['lname'] == $data['selectedID2']['result'][0]['lname'] &&
						$data['selectedID1']['result'][0]['birthDate'] == $data['selectedID2']['result'][0]['birthdate']){

						$senderID = $INPUT_POST['transactSenderID'];
						$fname = $data['selectedID1']['result'][0]['fname'];
						$lname = $data['selectedID1']['result'][0]['lname'];

						$url = url;
				
						$parameter =array(
							'actionId' 	 => 'ups_ecash_service/remittance_search_bene_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'sender_id'  => $senderID,
							'ip_address' => $this->ip
						); 

						$result = $this->curl->call($parameter,$url);
						$data['row'] = json_decode($result,true);
						
						if($data['row']['S']===0){
							$data['rowMessage'] = "NO BENEFICIARY FOUND";

							$param1 =array(
								'dev_id'     		=> $this->global_f->dev_id(),
								'actionId' 	 		=> _remittance_search_bsp,
								'fname'  			=> $fname,
								'lname'  			=> $lname,
								'regcode' 			=> $this->user['R'],
								'ip_address'		=> $this->ip
							); 

							$resultAPI = $this->curl->call($param1, $url);
							$data['row'] = json_decode($resultAPI, true);
							
							if ($data['row']['S']==1) {
								$data['type'] = array('typeid'=>1,
														'typedesc'=>'Sender');
							}
						}else{
							$data['rowMessage'] = "CANNOT PROCEED, SENDER AND BENEFICIARY DETAILS ARE THE SAME";
							$param2 =array(
								'actionId' 	 => 'ups_ecash_service/remittance_selected_sender_bsp',
								'dev_id' 	 => $this->global_f->dev_id(),
								'regcode'	 => $this->user['R'],
								'rowid' 	 => $senderID,
								'ip_address' => $this->ip
							); 
		
							$resultSelected = $this->curl->call($param2 ,$url);
							$data['selectedSender'] = json_decode($resultSelected,true);
							
							$senderinfo = explode("|", $this->input->post('inputSenderHide'));
					
							$data['type'] = array('typeid'=>2,
												'typedesc'=>'Beneficiary',
												'inputSenderName' => $senderinfo[1],
												'inputSender'    	=> $this->input->post('inputSenderHide'));	
						}
					}else{
						$data['okTransac']['S'] = 1;
					}

	 			}elseif(isset($_POST['submitOTP'])) // Process submit OTP BSP CTB
	 			{
	 				$INPUT_POST =$this->input->post(null,true);
					$url = url;

					$parameter =array(
						'actionId' 	 => 'ups_ecash_service/otpValidate',
						'dev_id' 	 => $this->global_f->dev_id(),
						'regcode'	 => $this->user['R'],
						'traceno' 	 => $INPUT_POST['traceno'],
						'otp' 	 	 => $INPUT_POST['otpCode'],
						'ip_address' => $this->ip
					); 

					$result = $this->curl->call($parameter, $url);

					$data['otpResult'] = json_decode($result, true);
					
					if($data['otpResult']['S'] == 1){
						for($i = 1; $i <= 2; $i++){
							${'file'.$i} 			= $_FILES['fileHigh'.$i];
							${'file'.$i.'Name'} 	= ${'file'.$i}['name'];
							${'file'.$i.'Size'}		= ${'file'.$i}['size'];
							${'file'.$i.'Temp'}		= ${'file'.$i}['tmp_name'];
							${'file'.$i.'Error'} 	= ${'file'.$i}['error'];
						}
	
						if($file1Size < 2*MB) {
				
							for($a = 1; $a <= 1; $a++){
				
								${'url'.$a} = ${'file'.$a.'Temp'};
								if(${'file'.$a.'Size'} > 1*MB)
								{
									${'old_size'.$a} = ${'file'.$a.'Size'};
									${'urltmp'.$a}	 = sys_get_temp_dir().'/tmp.jpg';
									
									${'filename'.$a} = $this->compress_image(${'file'.$a.'Size'}, ${'urltmp'.$a}, 75);
									${'new_size'.$a} = filesize(${'urltmp'.$a});
								
									if(${'new_size'.$a} < ${'old_size'.$a})
									{
										${'url'.$a} = ${'urltmp'.$a};
									}
								}
								
								${'curl'.$a} = curl_init();
								${'localfile'.$a} = ${'url'.$a};
							}
				
							for($i = 1; $i <= 2; $i++){
								curl_setopt_array(${'curl'.$i}, array(
									CURLOPT_URL => 'https://unified.ph/kyc-upload',
									CURLOPT_RETURNTRANSFER => true,
									CURLOPT_ENCODING => '',
									CURLOPT_MAXREDIRS => 10,
									CURLOPT_TIMEOUT => 0,
									CURLOPT_FOLLOWLOCATION => true,
									CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
									CURLOPT_CUSTOMREQUEST => 'POST',
									CURLOPT_POSTFIELDS => array('file'=> new CURLFILE(${'localfile'.$i}),'file_location' => 'kyc-remittance','regcode' => $this->user['R'],'email' => '123','ext_name' => '.jpg'),
								));
								
								${'response'.$i} = curl_exec(${'curl'.$i}); 
								curl_close(${'curl'.$i});
								${'upload_response'.$i} = json_decode(${'response'.$i},true);
							}
							
							$id1 = $upload_response1['F'];
	
							if($id1){
								$id1 = "/v1-sftp/kyc-remittance/OTP_".$upload_response1['F'];
							}
	
						}

						if($id1){
							$param =array(
								'actionId' 	 => 'ups_ecash_service/remittance_send_ecash_padala_bsp_confirm',
								'dev_id' 	 => $this->global_f->dev_id(),
								'regcode'	 => $this->user['R'],
								'traceno' 	 => $INPUT_POST['traceno'],
								'action' 	 => 'APPROVED',
								'item_type'	 => 'PHOTO',
								'photolink'  => $id1,
								'ip_address' => $this->ip
							); 
	
							$resultAPI = $this->curl->call($param, $url);
	
							$data['transactConfirm'] = json_decode($resultAPI, true);
						}else{
							$data['transactConfirm']['S'] = 0;
							$data['transactConfirm']['M'] = "UPLOADING IMAGE FAILED";
						}

					}

	 			}elseif(isset($_POST['btnSubmitBSP'])) // submit Tranasction BSP CTB API
	 			{
	 				
	 				$INPUT_POST =$this->input->post(null,true);
					$url = url;
					$bankdetails = explode("*", $this->input->post('selBankID'));
				    $this->session->set_userdata('bank',$bankdetails);
		
					$parameter =array(
						'actionId' 	   => 'ups_ecash_service/remittance_send_credit_bank_bsp',
						'dev_id' 	   => $this->global_f->dev_id(),
						'regcode'	   => $this->user['R'],
						'transpass'	   => $INPUT_POST['inputTpass'],
						'sender_id'    => $INPUT_POST['transacSenderID'],
						'receiver_id'  => $INPUT_POST['transacBeneID'],
						'relation' 	   => $INPUT_POST['inputRelation'],
						'purpose' 	   => $INPUT_POST['inputPurpose'],
						'service' 	   => $INPUT_POST['service'],
						'bank_id'      => $bankdetails[0],
						'service_type' => $bankdetails[3],
						'firstfield'   => $INPUT_POST['inputAccountNo'],
						'secondfield'  => $INPUT_POST['inputAccountName'],
						'currency' 	   => $INPUT_POST['inputCurrency'],
						'principal'	   => $INPUT_POST['inputAmount'],
						'ip_address'   => $this->ip
					);
					
				    $result = $this->curl->call($parameter,$url);
					$data['transactStatus'] = json_decode($result,true);
					$data['receiptCharge'] = $INPUT_POST['inputCharge'];

					$data['bankID'] = $bankdetails[0];

					if($data['transactStatus']['S'] == 1){

						$data['level'] = $this->user['L'];
						if(($data['level'] != 7) && ($data['level'] != 16)){  
							$traceno = $data['transactStatus']['TN'];
	
							$data['receiptResult'] = "APPROVED";

							$paramLowDetails =array(
								'actionId' 	 => 'ups_ecash_service/fetch_traceno_details',
								'dev_id' 	 => $this->global_f->dev_id(),
								'regcode'	 => $this->user['R'],
								'traceno'	 => $traceno,
								'ip_address' => $this->ip
							);
							
							$fetchLowDetails = $this->curl->call($paramLowDetails, $url);
							$data['tracenoDetails'] = json_decode($fetchLowDetails,true);

							$data['receiptResult'] = "PENDING";
							$data['transactDealer']['S'] = 1;
						}
						elseif($data['transactStatus']['RISK'] == "LOW"){
							$param =array(
								'actionId' 	 => 'ups_ecash_service/remittance_send_credit_bank_bsp_confirm',
								'dev_id' 	 => $this->global_f->dev_id(),
								'regcode'	 => $this->user['R'],
								'traceno' 	 => $data['transactStatus']['TN'],
								'action' 	 => 'APPROVED',
								'ip_address' => $this->ip
							); 	
	
							$resultAPI = $this->curl->call($param, $url);
							$data['transactConfirmLow'] = json_decode($resultAPI,true);
	
							if($data['transactConfirmLow']['S'] == 1){
								$traceno = $data['transactStatus']['TN'];
	
								$data['receiptResult'] = "APPROVED";
	
								$paramLowDetails =array(
									'actionId' 	 => 'ups_ecash_service/fetch_traceno_details',
									'dev_id' 	 => $this->global_f->dev_id(),
									'regcode'	 => $this->user['R'],
									'traceno'	 => $traceno,
									'ip_address' => $this->ip
								);
								
								$fetchLowDetails = $this->curl->call($paramLowDetails, $url);
								$data['tracenoDetails'] = json_decode($fetchLowDetails,true);
								
								$paramLow =array(
									'actionId' 	 => 'ups_ecash_service/remittance_send_credit_bank_bsp_transac',
									'dev_id' 	 => $this->global_f->dev_id(),
									'regcode'	 => $this->user['R'],
									'traceno'	 => $traceno,
									'ip_address' => $this->ip,
									'ip' => $this->ip
								);
	
								$resultLowAPI = $this->curl->call($paramLow, $url);
								$data['transactBSPLow'] = json_decode($resultLowAPI,true);
	
								// NOTIFY APPROVED BSP TRANSACTION
								$refno = $data['transactBSPLow']['TN'];
								
								$notifLow =array(
									'actionId' 	 => 'ups_ecash_service/notifySenderReceiver',
									'dev_id' 	 => $this->global_f->dev_id(),
									'regcode'	 => $this->user['R'],
									'traceno'	 => $traceno,
									'refno'	  	 => $refno,
									'type'	  	 => "APPROVE",
									'ip_address' => $this->ip
								);
	
								$resultLowNotif = $this->curl->call($notifLow, $url);
								$data['notifLow'] = json_decode($resultLowNotif,true);
							}
						}
						elseif($data['transactStatus']['RISK'] == "NORMAL" || $data['transactStatus']['RISK'] == "HIGH"){
							$param1 =array(
								'actionId' 	  => 'ups_ecash_service/risk_profiling',
								'dev_id' 	  => $this->global_f->dev_id(),
								'regcode'	  => $this->user['R'],
								'traceno'	  => $data['transactStatus']['TN'],
								'ip_address'  => $this->ip
							);
		
							$resultAPI1 = $this->curl->call($param1,$url);
							$data['RISK_DESCRIPTION'] = json_decode($resultAPI1,true);
							
							$param2 =array(
								'actionId' 	  => 'ups_ecash_service/checkRiskProfile',
								'dev_id' 	  => $this->global_f->dev_id(),
								'regcode'	  => $this->user['R'],
								'traceno'	  => $data['transactStatus']['TN'],
								'ip_address'  => $this->ip
							);
		
							$resultAPI2 = $this->curl->call($param2, $url);
							$data['OTP'] = json_decode($resultAPI2,true);
							
	
							$param3 =array(
								'actionId' 	  => 'ups_ecash_service/fetch_traceno_details',
								'dev_id' 	  => $this->global_f->dev_id(),
								'regcode'	  => $this->user['R'],
								'traceno'	  => $data['transactStatus']['TN'],
								'ip_address'  => $this->ip
							);
		
							$resultAPI3 = $this->curl->call($param3, $url);
							$data['tracenoDetails'] = json_decode($resultAPI3,true);
						}
					}else{
						$param1 =array(
							'actionId' 	 => 'ups_ecash_service/remittance_selected_sender_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'rowid'		 => $INPUT_POST['transacSenderID'],
							'ip_address' => $this->ip
						); 
	
						$result1 = $this->curl->call($param1, $url);
	
						$param2 =array(
							'actionId' 	 => 'ups_ecash_service/remittance_selected_beneficiaryID_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'rowid'		 => $INPUT_POST['transacBeneID'],
							'ip_address' => $this->ip
						); 
	
						$result2 = $this->curl->call($param2, $url);
	
						$data['selectedID1'] = json_decode($result1, true);
						$data['selectedID2'] = json_decode($result2, true);
					}
					
	 			}
				elseif (isset($_POST['btnBsearch'])){ //Search Benificiary
 				
					$search = $this->input->post('inputSearch');
					$url = url;
					$parameter =array(
								'dev_id'	 => $this->global_f->dev_id(),
								'actionId'	 => _remittance_search,
								'search_key' => $search,
								'regcode'	 => $this->user['R'],
								'ip_address' => $this->ip
								); 

					$result = $this->curl->call($parameter,$url);
					$data['row'] = json_decode($result,true);

					$senderinfo = explode("|", $this->input->post('inputSenderHide'));

					$data['type'] = array('typeid'=>2,
										'typedesc'=>'Benificiary',
										'inputSenderName' =>$senderinfo[1],
										'inputSender'    => $this->input->post('inputSenderHide'));	


 				}
				elseif(isset($_POST['btnSubmit'])){ // Process the ecashcredittobank
 				
					$INPUT_POST =$this->input->post(null,true);
					$otherinfo = explode("|", $this->input->post('inputId'));
					$this->session->set_userdata('info',$otherinfo);
					$bankdetails = explode("*", $this->input->post('selBankID'));
					$this->session->set_userdata('bank',$bankdetails);


					$T_VALUE =md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));
					$url = url;
					$parameter =array(
									'dev_id'    		=> $this->global_f->dev_id(),
									'ip_address'		=> $this->ip,
									'ip'				=> $this->ip,
									'actionId' 	 		=> _remittance_send_credit_bank,
									'regcode'   		=> $this->user['R'],
									'transpass' 		=> $INPUT_POST['inputTpass'],
									'accountno'			=> $INPUT_POST['inputAccountno'],
									'bene_name'			=> $INPUT_POST['inputBeneficiary'],
									'amount'			=> str_replace(',', '', $INPUT_POST['inputAmount']),
									'bank_id'			=> $bankdetails[0],
									'bank_type'			=> $bankdetails[1],
									$this->user['SKT']	=> md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
									);
					$API = $this->curl->call($parameter,$url);
					$data['results'] = json_decode($API,true);

					if ($data['results']['S']  == 1) {

						$data['result'] = array(
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
				
			}elseif(isset($_POST['btnConfirm'])){

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

				$data['API'] = json_decode($result,true);
				if ($data['API']['S'] == 1) {
					$this->user['EC'] = $data['API']['EC'];
					$data['user'] = $this->global_f->get_user_session();
				} else {
					$data['result'] = array('S' => 0, 'M' => $data['API']['M']);
				}

			}elseif(isset($_POST['btnAddDetails'])){ // add sender and benificiary
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
			if($CHECK_MISSING_DATA == 1) {
				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_send/updateDealer'); //UPDATE DEALER SENDER DETAILS
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');
			}else{
				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_send/ecash_credit_to_bank_bsp'); //NEW CREDIT TO BANK UI BSP
				// 	$this->load->view('remittance/ecash_send/ecash_credit_to_bank'); //OLD CREDIT TO BANK UI
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');
			}

			}else {
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
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
								'search_key'   	 	=> $search,
								'regcode' 			=> $this->user['R'],
								'ip_address'		=> $this->ip
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
								'regcode'   	 	 => $this->user['R'],
								'acctno' 			 => $receipient[1],
								'receipient_f'		 => $receipient[2],
								'receipient_m'		 => $receipient[3],
								'receipient_l'		 => $receipient[4],
								'transpass'			 => $INPUT_POST['inputTpass'],
								'amount'			 => $INPUT_POST['inputAmount'],
								'ip_address'    	 => $this->ip,
								$this->user['SKT']	 => md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
								); 
					$result = $this->curl->call($parameter,$url);
					$data['result'] = json_decode($result,true);

					if ($data['result']['S']  == 1) {
						$data['result'] = array(
											'S'   => 1,
											'M'	  => $result['M'],
											'EC'  => $result['EC'],
											'TN'  => $result['TN'],
											'URL' => $result['URL']
											);
						$this->user['EC'] = $data['result']['EC'];
						$data['user'] = $this->global_f->get_user_session();

					} elseif ($data['result']['S'] == 2) {
						$data['row'] = $inputRData;
						$data['receipientAccno'] = $receipient[1];
						$data['receipientName']  = $receipient[0];
						$data['topupAmount']	 = $INPUT_POST['inputAmount'];
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
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
			redirect('Main/');
		}

  	}
  
  /* Harry Cardless 09/16/2019 */

	public function getCardlessAccountNo(){
		$url = url;
		$search = $this->input->post('inputSearch');
		$parameter = array(
			'dev_id'		=> $this->global_f->dev_id(),
			'actionId'		=> _remittance_search_cashcard_user,
			'search_key'	=> $search,
			'regcode'		=> $this->user['R'],
			'ip_address'	=> $this->ip
		); 

		$result = $this->curl->call($parameter,$url);
		$response= json_decode($result,true);	
		echo json_encode($response);
	}

	public function ecashcardlesspadala()
	{
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
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
			redirect('Main/');
		}
	}

	public function ecashcardlesspadala_confirm()
	{
		$url = "https://mobileapi.unified.ph/ups_cardless_service/createEGC_confirm";
		$INPUT_POST=$this->input->post(null,true);
	
		$parameter =array(
			'dev_id'	=> $this->global_f->dev_id(),
			'actionId'	=>'ups_cardless_service/createEGC_confirm',
			's_fname'	=> $INPUT_POST['s_fname'],
			's_mname'	=> $INPUT_POST['s_mname'],
			's_lname'	=> $INPUT_POST['s_lname'],
			's_bdate'	=> $INPUT_POST['s_bdate'],
			's_mobile'	=> $INPUT_POST['s_mobile'],
			's_email'	=> $INPUT_POST['s_email'],
			's_address'	=> $INPUT_POST['s_address'],
			's_id'		=> $INPUT_POST['s_id'],
			's_idno'	=> $INPUT_POST['s_idno'],
			'b_fname'	=> $INPUT_POST['b_fname'],
			'b_mname'	=> $INPUT_POST['b_mname'],
			'b_lname'	=> $INPUT_POST['b_lname'],
			'b_bdate'	=> $INPUT_POST['b_bdate'],
			'b_mobile'	=> $INPUT_POST['b_mobile'],
			'b_email'	=> $INPUT_POST['b_email'],
			'b_address'	=> $INPUT_POST['b_address'],
			'amount'	=> $INPUT_POST['amount'],
			'purpose'	=> $INPUT_POST['purpose'],
			'transpass'	=> $INPUT_POST['transpass'],
			'regcode'	=> $this->user['R'],
			'ip'		=> $this->ip,
			$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'].md5($this->input->post('transpass')))
		); 

		$result = $this->curl->call($parameter,$url);
		$response= json_decode($result,true);	
		echo json_encode($response);
	}

	public function unholdCardlessPadala()
	{
		$url = "https://mobileapi.unified.ph/ups_cardless_service/createEGC_confirm_unhold";
		$INPUT_POST = $this->input->post(null,true);
	
		$parameter =array(
			'dev_id'	=> $this->global_f->dev_id(),
			'actionId'	=>'ups_cardless_service/createEGC_confirm_unhold',
			'trackno' 	=> $INPUT_POST['trackno'],
			'vcode' 	=> $INPUT_POST['vcode'],
			'regcode'	=> $this->user['R'],
			'ip'		=> $this->ip,
			$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'])
		); 

		$result = $this->curl->call($parameter,$url);
		$response= json_decode($result,true);	
		echo json_encode($response);
	}


  /* End Harry Cardless 09/16/2019 */



  /* Harry CashCard 0/10/2019 */

  // View
  
	public function ecashtocashcard_new()
	{
		if (1){
			$data = array('menu' => 2,
						'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['exceed_ec_to_cashcard'] = $this->check_trans->transCount($this->user['R'], 80)['S'];

				$url = url;
				$data['user'] = $this->user;
				$data['session'] = $this->global_f->get_user_session();

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				//   $this->load->view('remittance/ecash_send/ecash_to_cashcard_new');
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


  	// get sender 
	public function cashcard_get_sender()
	{
		$search = $this->input->post('inputSearch');

		$url = url;
			$parameter =array(
				'dev_id'	 => $this->global_f->dev_id(),
				'actionId'	 => _remittance_search,
				'search_key' => $search,
				'regcode'	 => $this->user['R'],
				'ip_address' => $this->ip
			); 

			$result = $this->curl->call($parameter,$url);
			$response= json_decode($result,true);	
			echo json_encode($response);
	}

  	// add sender
	public function cashcard_new_sender()
	{
		$INPUT_POST = $this->input->post(null, true);

		$T_VALUE = md5(date('m/d/Y') . md5('GPRSKEY@)!$w3'));
		$url = url;
		$parameter = array(
			'dev_id'	 => $this->global_f->dev_id(),
			'ip_address' => $this->ip,
			'actionId'	 => _remittance_add_user,
			'regcode'	 => $this->user['R'],
			'transpass'	 => $INPUT_POST['inputTpass'],
			'firstname'	 => $INPUT_POST['inputFname'],
			'middlename' => $INPUT_POST['inputMname'],
			'lastname'	 => $INPUT_POST['inputLname'],
			'mobileno'	 => $INPUT_POST['inputMobile'],
			'gender'	 => $INPUT_POST['selGender'],
			'email'		 => $INPUT_POST['inputEmail'],
			'address'	 => $INPUT_POST['inputAddr'],
			'country'	 => $INPUT_POST['selCountry'],
			'birthday'	 => $INPUT_POST['inputBdate'],
			$this->user['SKT'] => md5($this->user['R'] . $this->user['SKT'] . md5($this->input->post('inputTpass'))),
		);

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}

 
    // OTP Verification
    public function cashcard_otp_verify()
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
							'S'	  => $API['S'],
							'M'   => $API['M'],
							'EC'  => $API['EC'],
							'TN'  => $API['TN'],
							'URL' => $API['URL']
							);
		}else{
			$result = array('S' => 0, 'M' => 'Invalid input');
		}

		echo json_encode($result);
	}

  // OTP Resend
	public function cashcard_otp_resend()
	{
		if (isset($_POST['trackno'])){
			$url = url;
			$parameter = array('dev_id'		 => $this->global_f->dev_id(),
		    				 	'ip_address' => $this->ip,
		    					'actionId'	 => _remittance_cashcard_otp_resend,
    							'regcode'	 => $this->user['R'],
		    					'trackno'	 => $_POST['trackno'],
		    					$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'])
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
	public function getCashCardAccountNo()
	{
		$search = $this->input->post('inputSearch');
		$url = url;
		$parameter =array(
				'dev_id'	 => $this->global_f->dev_id(),
				'actionId'	 => _remittance_search_cashcard_user,
				'search_key' => $search,
				'regcode'	 => $this->user['R'],
				'ip_address' => $this->ip
				); 

		$result = $this->curl->call($parameter,$url);
		$response= json_decode($result,true);	
		echo json_encode($response);
	}


  	// cashcard transaction
	public function cashcard_confirm_new()
	{
		$url = "https://mobileapi.unified.ph/ups_ecash_service/cashcard_confirm_new";
		$INPUT_POST=$this->input->post(null,true);
	
		$parameter =array(
			'dev_id'	=> $this->global_f->dev_id(),
			'actionId'	=> 'ups_ecash_service/cashcard_confirm_new',
			'accntNo'	=> $INPUT_POST['accntNo'],
			'amount'	=> $INPUT_POST['amount'],
			'senderFirstName'	 	=> $INPUT_POST['senderFirstName'],
			'senderMidName'	 	 	=> $INPUT_POST['senderMidName'],
			'senderLastName'	 	=> $INPUT_POST['senderLastName'],
			'senderAddressLine1' 	=> $INPUT_POST['senderAddressLine1'],
			'senderBirthdate'	 	=> $INPUT_POST['senderBirthdate'],
			'senderContactDetails'  => $INPUT_POST['senderContactDetails'],
			'senderSourceOfFunds'   => $INPUT_POST['senderSourceOfFunds'],
			'senderNationality' 	=> $INPUT_POST['senderNationality'],
			'senderBirthPlace'		=> $INPUT_POST['senderBirthPlace'],
			'senderNatureOfWork'	=> $INPUT_POST['senderNatureOfWork'],
			'primaryIDType'			=> $INPUT_POST['primaryIDType'],
			'primaryIDNo'			=> $INPUT_POST['primaryIDNo'],
			'recipientFirstName'	=> $INPUT_POST['recipientFirstName'],
			'recipientMidName'		=> $INPUT_POST['recipientMidName'],
			'recipientLastName'		=> $INPUT_POST['recipientLastName'],
			'transpass'				=> $INPUT_POST['transpass'],
			'regcode' 				=> $this->user['R'],
			'ip_address'    	 	=> $this->ip,
			$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'].md5($this->input->post('transpass')))
		); 

		$result = $this->curl->call($parameter,$url);
		$response= json_decode($result,true);	
		echo json_encode($response);
	}

	public function cashcard_unhold_new()
	{
		$url = "https://mobileapi.unified.ph/ups_ecash_service/unhold_cashcard_service_new";
		$INPUT_POST=$this->input->post(null,true);
	
		$parameter =array(
			'dev_id'	=> $this->global_f->dev_id(),
			'actionId'	=>'ups_ecash_service/unhold_cashcard_service_new',
			'regcode'	=>$this->user['R'],
			'trackno'	=>$INPUT_POST['otptrackno'],
			'vcode'		=>$INPUT_POST['vcode'],
			'accntNo'	=>$INPUT_POST['accntNo'],
			'amount'	=> $INPUT_POST['amount'],
			'senderFirstName'		=> $INPUT_POST['senderFirstName'],
			'senderMidName'			=> $INPUT_POST['senderMidName'],
			'senderLastName'		=> $INPUT_POST['senderLastName'],
			'senderAddressLine1'	=> $INPUT_POST['senderAddressLine1'],
			'senderBirthdate'		=> $INPUT_POST['senderBirthdate'],
			'senderContactDetails'	=> $INPUT_POST['senderContactDetails'],
			'senderSourceOfFunds'	=> $INPUT_POST['senderSourceOfFunds'],
			'senderNationality'		=> $INPUT_POST['senderNationality'],
			'senderBirthPlace'		=> $INPUT_POST['senderBirthPlace'],
			'senderNatureOfWork'	=> $INPUT_POST['senderNatureOfWork'],
			'primaryIDType'			=> $INPUT_POST['primaryIDType'],
			'primaryIDNo'			=> $INPUT_POST['primaryIDNo'],
			'recipientFirstName'	=> $INPUT_POST['recipientFirstName'],
			'recipientMidName'		=> $INPUT_POST['recipientMidName'],
			'recipientLastName'		=> $INPUT_POST['recipientLastName'],
			'transpass'				=> $INPUT_POST['transpass'],
			'regcode' 				=> $this->user['R'],
			'ip_address'			=> $this->ip,
			$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'])
		); 

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
						'regcode'   	 	 => $this->user['R'],
						'trackno'			 => $_POST['otptrackno'],
						'vcode'			 	 => $_POST['vcode'],
						'ip_address'    	 => $this->ip,
						$this->user['SKT']	 => md5($this->user['R'].$this->user['SKT'])
						); 
			$result = $this->curl->call($parameter,$url);
			$API = json_decode($result,true);
			$result = array(
							'S'   => $API['S'],
							'M'   => $API['M'],
							'EC'  => $API['EC'],
							'TN'  => $API['TN'],
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
			$parameter = array( 'dev_id'     		=> $this->global_f->dev_id(),
		    				 	'ip_address' 		=> $this->ip,
		    					 'actionId' 	 	=> _remittance_cashcard_otp_resend,
    							 'regcode'   	 	=> $this->user['R'],
		    					 'trackno'    		=> $_POST['trackno'],
		    					 $this->user['SKT'] => md5($this->user['R'].$this->user['SKT'])
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

				}else{
					redirect('Main/');
				}

			}else{
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
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
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
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
								'dev_id'	 => $this->global_f->dev_id(),
								'actionId'	 => _remittance_search,
								'ip_address' => $this->ip,
								'search_key' => $search,
								'regcode'	 => $this->user['R']
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
								'dev_id'	 => $this->global_f->dev_id(),
								'actionId'	 => _remittance_search,
								'ip_address' => $this->ip,
								'search_key' => $search,
								'regcode'	 => $this->user['R']
								); 

					$result = $this->curl->call($parameter,$url);
					$data['row'] = json_decode($result,true);

					$senderinfo = explode("|", $this->input->post('inputSenderHide'));

				
					$data['type'] = array('typeid' 				=> 2,
										'typedesc'				=> 'Beneficiary',
										'inputSenderName'		=> $senderinfo[1],
										'inputSender'			=> $this->input->post('inputSenderHide'),
										'inputSenderFname'		=> $this->input->post('inputSenderHideFname'),
										'inputSenderMname'		=> $this->input->post('inputSenderHideMname'),
										'inputSenderLname'		=> $this->input->post('inputSenderHideLname'),
										'inputSenderAddress'	=> $this->input->post('inputSenderHideAddress'),
										'inputSenderMobile'		=> $this->input->post('inputSenderHideMobile'),
										'inputBenefFname'		=> $this->input->post('inputBenefHideFname'),
										'inputBenefMname'		=> $this->input->post('inputBenefHideMname'),
										'inputBenefLname'		=> $this->input->post('inputBenefHideLname'),
										'inputBenefAddress'		=> $this->input->post('inputBenefHideAddress'),
										'inputBenefMobile'		=> $this->input->post('inputBenefHideMobile')
										);	
					
				}elseif(isset($_POST['btnSubmit'])) // Process the SMARTMONEY
				{
					$INPUT_POST =$this->input->post(null,true);

					$url = url;
					$parameter =array(
									'dev_id'     		=> $this->global_f->dev_id(),
									'actionId' 	 		=> _remittance_send_gcash_cashin,
									'ip_address'	    => $this->ip,
									'regcode'   		=> $this->user['R'],
									'transpass' 		=> $INPUT_POST['inputTpass'],
									'gcashAccnt'		=> $INPUT_POST['inputSnumber'],
									'senderFirstname'	=> $INPUT_POST['inputSenderFname'],
									'senderLastname'	=> $INPUT_POST['inputSenderLname'],
									'senderAddress'	    => $INPUT_POST['inputSenderAddress'],
									'senderMobile'	    => $INPUT_POST['inputSenderMobile'],
									'senderID'	        => $INPUT_POST['inputidType'],
									'senderMessage'	    => $INPUT_POST['message'],
									'amount'			=> $INPUT_POST['inputAmount'],	
									$this->user['SKT']	=> md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
									);

					$result = $this->curl->call($parameter,$url);

					$data['API'] = json_decode($result,true);
					

					$id = explode("|", $INPUT_POST['inputId']);
					
					$data['row'] = array (
								'gcashAccnt'		=> $INPUT_POST['inputSnumber'],
								'senderFirstname'	=> $INPUT_POST['inputSenderFname'],
								'senderMidname'		=> $INPUT_POST['inputSenderMname'],
								'senderLastname'	=> $INPUT_POST['inputSenderLname'],
								'senderAddress'		=> $INPUT_POST['inputSenderAddress'],
								'senderMobile'		=> $INPUT_POST['inputSenderMobile'],
								'senderMessage'		=> $INPUT_POST['message'],
								'amount'			=> $INPUT_POST['inputAmount'],
								'inputBeneficiary'	=> $INPUT_POST['inputBeneficiary'],
								'benefFirstname'	=> $INPUT_POST['inputBenefFname'],
								'benefMidname'		=> $INPUT_POST['inputBenefMname'],
								'benefLastname'		=> $INPUT_POST['inputBenefLname'],
								'benefAddress'		=> $INPUT_POST['inputBenefAddress'],
								'benefMobile'		=> $INPUT_POST['inputBenefMobile'],
								'senderid'			=> $id[0],
								'benefeciaryid'		=> $id[3],
								'idtype'			=> $INPUT_POST['inputidType'],
								'idNo'				=> $INPUT_POST['inputIdnumber'],
								'transpass'        	=> $INPUT_POST['inputTpass'],
								'charge'           	=> $data['API']['C'],
								'TN'               	=> $data['API']['TN'],
								'SID'              	=> $data['API']['SID']
								);
				}elseif(isset($_POST['btnAddDetails']))// add sender and benificiary
				{
					$INPUT_POST =$this->input->post(null,true);

					$url = url;
					$parameter =array(
						'dev_id'    		=> $this->global_f->dev_id(),
						'actionId' 	 		=> _remittance_add_user,
						'ip_address'	    => $this->ip,
						'regcode'   		=> $this->user['R'],
						'transpass' 		=> $INPUT_POST['inputTpass'],
						'firstname'			=> $INPUT_POST['inputFname'],
						'middlename'		=> $INPUT_POST['inputMname'],
						'lastname'			=> $INPUT_POST['inputLname'],
						'mobileno'			=> $INPUT_POST['inputMobile'],
						'gender'			=> $INPUT_POST['selGender'],
						'email'				=> $INPUT_POST['inputEmail'],
						'address'			=> $INPUT_POST['inputAddr'],
						'country'			=> $INPUT_POST['selCountry'],
						'birthday'			=> $INPUT_POST['inputBdate'],
						$this->user['SKT']	=> md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
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
						'ip_address'	    => $this->ip,
						'regcode'   		=> $this->user['R'],
						'transpass' 		=> $INPUT_POST['inputTpass'],
						'gcashno'			=> $INPUT_POST['inputgcashcashin'],
						'sender_id'			=> $INPUT_POST['inputSenderID'],
						'sender_firstname'	=> $INPUT_POST['inputSenderFname'],
						'sender_middlename'	=> $INPUT_POST['inputSenderMname'],
						'sender_lastname'	=> $INPUT_POST['inputSenderLname'],
						'sender_address'	=> $INPUT_POST['inputSenderAddress'],
						'sender_message'	=> $INPUT_POST['inputMessage'],
						'sender_mobile'		=> $INPUT_POST['inputSenderMobile'],
						'bene_id'			=> $INPUT_POST['inputBeneficiaryID'],
						'idnumber'			=> $INPUT_POST['inputIdnumber'],
						'idtype'			=> $INPUT_POST['inputIdtype'],
						'amount'			=> $INPUT_POST['inputAmount'],
						$this->user['SKT']	=> md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
					);

					$result = $this->curl->call($parameter,$url);

					$data['result'] = json_decode($result,true);

					if ($data['result']['S'] == 25){
						$data['API']['S'] = 1;
						$data['process'] = 1;

					}elseif ($data['result']['S'] == 1){

						$data['API']['S']  = "";
						$data['result'] = array('S'=>0, 'M'=>$data['result']['M']);
					}else{
						$data['API']['S'] = "";
						$data['result'] = array('S'=>0, 'M'=>"Transaction failed. Please try again later");
					}
						
				}elseif (isset($_POST['btnConfirmActivation'])) 
				{
					$INPUT_POST = $this->input->post(null,true);
					$url = url;
					$parameter =array(
						'dev_id'    	    => $this->global_f->dev_id(),
						'actionId' 	 		=> _remittance_send_gcash_cashin_confirm_activation,
						'ip_address'	    => $this->ip,
						'regcode'   		=> $this->user['R'],
						'trackno'			=> $INPUT_POST['transactionno'],
						'vericode'			=> $INPUT_POST['verification_code'],
						$this->user['SKT']	=> md5($this->user['R'].$this->user['SKT'])
					);

					$result = $this->curl->call($parameter,$url);
					$data['result'] = json_decode($result,true);
					print_r($result);exit;

					if ($data['result']['S'] == 1) {

						$data['API']['S']	= "";
						$data['result']		= array( 'S'  => 1, 'M'  => $data['result']['M'], 'TN' => $data['result']['TN'] );
						$this->user['EC']	= $data['result']['EC'];
						$data['user']		= $this->global_f->get_user_session();

					}else {
						$data['API']['S']	= "";
						$data['result']		= array('S' => 0, 'M' => "Activation code failed. Please try again later" );
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
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
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
						'regcode'          => $this->user['R'],
						'reference_no'	   => $this->input->post('inputTrackno'),
						$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
					);

					$result = $this->curl->call($parameter,$url);
					$data['API'] = json_decode($result,true);

					$data['row'] = array(
						'inputReferenceNo' => $this->input->post('inputTrackno')
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
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
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
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
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
									'dev_id'	 => $this->global_f->dev_id(),
									'actionId'	 => _unhold_cebuana_send,
									'ip_address' => $this->ip,
				    				'regcode'	 => $this->user['R'],
				    				'trackno'	 => $this->input->post('transactionno'),
				    				'vcode'	 	 => $this->input->post('verification_code'),
				    				'ip'	 	 => $this->ip,
				    				$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'])
			    				    );
					$result = $this->curl->call($parameter,$url);
					$results = json_decode($result,true);

					if ($results['S'] == 1){
						$data['results'] = array(
											'S'  => 1,
											'M'  => $results['M'],
											'TN' => $results['TN'],
											'RF' => $results['RF']
											);
					}elseif ($results['S'] == 2){
						$data['results'] = array(
											'S' => 4,
											'M' => $results['M']
											);
					}else{
						$data['results'] = array(
												'S' => 0,
												'M' => $results['M']
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
			'dev_id'	 => $this->global_f->dev_id(),
			'actionId'	 => _search_beneficiary,
			'ip_address' => $this->ip,
			'regcode'	 => $this->user['R'],
			'sender_id'	 => $senderid
		);

		$result = $this->curl->call($parameter,$url);
		$response = json_decode($result,true);
		echo json_encode($response);
	}

	public function get_currency(){

		$url = url;
		$parameter =array(
			'dev_id'	 => $this->global_f->dev_id(),
			'actionId'	 => _fetch_currency,
			'ip_address' => $this->ip,
			'regcode'	 => $this->user['R']
		);

		$result = $this->curl->call($parameter,$url);
		$response = json_decode($result,true);
		echo json_encode($response);
	}

	public function get_domestic_rates(){
		$currencyid = $this->uri->segment(3);
		$amount = $this->uri->segment(4);

		$url = url;
		$parameter =array(
			'dev_id'	  => $this->global_f->dev_id(),
			'actionId'	  => _get_domestic_rates,
			'ip_address'  => $this->ip,
			'regcode'	  => $this->user['R'],
			'currency_id' => $currencyid,
			'amount'	  => $amount
		);
		$result = $this->curl->call($parameter,$url);
		$response = json_decode($result,true);

		echo json_encode($response);
	}


	public function ecashtocebuana()
	{
		if ($this->user['A_CTRL']['remittance'] == 1 && $this->user['A_CTRL']['remittance_cebuana'] == 1){

			$data = array('menu' => 2,
						  'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$this->check_trans->gwlCheckTransLimit(81); //FOR WEALTHY LIFESTYLE

				$data['user'] = $this->user;
				
                $data['level'] = $this->user['L'];
				$testing = $this->testBSP();
				if(($data['level'] != 7) && ($data['level'] != 16)){                    
					$data['DEALER']['M'] = "DEALER";

					$searchFname = $this->user['FIRSTNAME'];
					$searchLname = $this->user['LASTNAME'];

					$url = url;
					$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId' 	 		=> _remittance_search_bsp,
						'fname'  			=> $searchFname,
						'lname'  			=> $searchLname,
						'regcode' 			=> $this->user['R'],
						'ip_address'		=> $this->ip
					); 

					$result = $this->curl->call($parameter,$url);
					$data['rowD'] = json_decode($result,true);

				   	if ($data['rowD']['S']==1) {
						$data['dealerSenderID'] = $data['rowD']['result'][0]['id'];

						$parameter = array(
							'dev_id'     		=> $this->global_f->dev_id(),
							'actionId' 	 		=> 'ups_ecash_service/remittance_check_sender_details',
							'fname'  			=> $searchFname,
							'lname'  			=> $searchLname,
							'regcode' 			=> $this->user['R'],
							'ip_address'		=> $this->ip
						); 

						$result = $this->curl->call($parameter,$url);
						$data['checkSender'] = json_decode($result,true);

						if($data['checkSender']['result'][0]['permanentAddress'] == "" || $data['checkSender']['result'][0]['permanentAddress'] == null){
							$data['missingSD']['permanentAddress'] = '';
						}

						if($data['checkSender']['result'][0]['placeOfBirth'] == "" || $data['checkSender']['result'][0]['placeOfBirth'] == null){
							$data['missingSD']['placeOfBirth'] = '';
						}

						if($data['checkSender']['result'][0]['sourceOfFund'] == "" || $data['checkSender']['result'][0]['sourceOfFund'] == null){
							$data['missingSD']['sourceOfFund'] = '';
						}

						if($data['checkSender']['id'] == "" || $data['checkSender']['id'] == null) {
							$data['missingSD']['id'] = '';
						}

						$CHECK_MISSING_DATA = 0;
						foreach($data['missingSD'] as $i){
							if(empty($i)){
								$CHECK_MISSING_DATA = 1;
							}
						}
						
						$senderID = $data['rowD']['result'][0]['id'];
						$fname = $data['rowD']['result'][0]['fname'];
						$lname = $data['rowD']['result'][0]['lname'];

						$param1 =array(
							'actionId' 	 => 'ups_ecash_service/remittance_search_bene_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'sender_id'  => $senderID,
							'ip_address' => $this->ip
						); 

						$result = $this->curl->call($param1,$url);
						$data['row'] = json_decode($result,true);
						
						if($data['row']['S']===0){
							$data['rowMessage'] = "NO BENEFICIARY FOUND";

							$param1 =array(
								'dev_id'	 => $this->global_f->dev_id(),
								'actionId'	 => _remittance_search_bsp,
								'fname'	 	 => $fname,
								'lname'	 	 => $lname,
								'regcode'	 => $this->user['R'],
								'ip_address' => $this->ip
							); 

							$resultAPI = $this->curl->call($param1, $url);
							$data['row'] = json_decode($resultAPI, true);
							
							if ($data['row']['S']==1) {
								$data['type'] = array('typeid'=>1,
														'typedesc'=>'Sender');
							}
						}else{
							$param2 =array(
								'actionId' 	 => 'ups_ecash_service/remittance_selected_sender_bsp',
								'dev_id' 	 => $this->global_f->dev_id(),
								'regcode'	 => $this->user['R'],
								'rowid' 	 => $senderID,
								'ip_address' => $this->ip
							); 
		
							$resultSelected = $this->curl->call($param2 ,$url);
							$data['selectedSender'] = json_decode($resultSelected,true);
							
							$senderinfo = explode("|", $this->input->post('inputSenderHide'));
					
							$data['type'] = array('typeid' => 2,
												'typedesc' => 'Beneficiary',
												'inputSenderName' => $senderinfo[1],
												'inputSender'	  => $this->input->post('inputSenderHide'));	
						}
					}
					if($data['rowD']['M'] == "NO MATCH FOUND"){
						$data['DEALER']['M'] = "NEW";
					}
				}

				if (isset($_POST['btnSsearch'])) //Search Sender
				{
	 				$url = url;
					$parameter =array(
								'dev_id' 	 => $this->global_f->dev_id(),
								'actionId' 	 => _search_sender,
								'ip_address' => $this->ip,
			    				'fname' 	 => $this->input->post('senderFname'),
			    				'lname' 	 => $this->input->post('senderLname'),
			    				'client_no'  => $this->input->post('senderClientNo'),
			    				'regcode' 	 => $this->user['R']
			    				); 

				    $result = $this->curl->call($parameter,$url);
					$data['fetchdata'] = json_decode($result,true);

					if ($data['fetchdata']['S']==1) {
						$data['type'] = array('typeid'=>1,
											 'typedesc'=>'Sender');
					}

				}elseif (isset($_POST['btnSearchSenderBSP'])) //Search Sender BSP CEBUANA
				{
					$searchFname = $this->input->post('inputSearchFname');
					$searchLname = $this->input->post('inputSearchLname');

					$url = url;
					$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId' 	 		=> _remittance_search_bsp,
						'fname'  			=> $searchFname,
						'lname'  			=> $searchLname,
						'regcode' 			=> $this->user['R'],
						'ip_address'		=> $this->ip
					); 

					$result = $this->curl->call($parameter,$url);
					$data['row'] = json_decode($result,true);

					if ($data['row']['S']==1) {
						$data['type'] = array('typeid'=>1,
												'typedesc'=>'Sender');
					}

				}elseif (isset($_POST['btnSearchBeneBSP'])) //Search Benificiary BSP CEBUANA
				{
					$senderID = $this->input->post('selectedSenderID');
					$fname = $this->input->post('selectedSenderFname');
					$lname = $this->input->post('selectedSenderLname');

					$url = url;
			
					$parameter =array(
						'actionId' 	 => 'ups_ecash_service/remittance_search_bene_bsp',
						'dev_id' 	 => $this->global_f->dev_id(),
						'regcode'	 => $this->user['R'],
						'sender_id'  => $senderID,
						'ip_address' => $this->ip
					); 

					$result = $this->curl->call($parameter,$url);
					$data['row'] = json_decode($result,true);
				
					if($data['row']['S']===0){
						$data['rowMessage'] = "NO BENEFICIARY FOUND";

						$param1 =array(
							'dev_id'	 => $this->global_f->dev_id(),
							'actionId'	 => _remittance_search_bsp,
							'fname'	 	 => $fname,
							'lname'	 	 => $lname,
							'regcode'	 => $this->user['R'],
							'ip_address' => $this->ip
						); 

						$resultAPI = $this->curl->call($param1, $url);
						$data['row'] = json_decode($resultAPI, true);
					
						if ($data['row']['S']==1) {
							$data['type'] = array('typeid'=>1,
													'typedesc'=>'Sender');
						}
					}
					
					else
					{
						$param2 =array(
							'actionId' 	 => 'ups_ecash_service/remittance_selected_sender_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'rowid' 	 => $senderID,
							'ip_address' => $this->ip
						); 

						$resultSelected = $this->curl->call($param2 ,$url);
						$data['selectedSender'] = json_decode($resultSelected,true);
						
						$senderinfo = explode("|", $this->input->post('inputSenderHide'));
				
						$data['type'] = array('typeid'=>2,
												'typedesc'=>'Beneficiary',
												'inputSenderName' => $senderinfo[1],
												'inputSender'    	=> $this->input->post('inputSenderHide'));	
					}
				}
				elseif(isset($_POST['btnAddDetailsBene'])) //Add benificiary BSP CEBUANA
	 			{
	 				$INPUT_POST =$this->input->post(null,true);
	 				$T_VALUE =md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));
	 				$url = url;
					$parameter =array(
						'dev_id'    	    => $this->global_f->dev_id(),
						'ip_address'		=> $this->ip,
						'actionId' 	 		=> _remittance_add_bene_bsp,
						'regcode'   		=> $this->user['R'],
						'transpass' 		=> $INPUT_POST['inputTpass'],
						'sender_id'			=> $INPUT_POST['senderID'],
						'fname' 			=> $INPUT_POST['inputFnameBene'],
						'mname' 			=> $INPUT_POST['inputMnameBene'],
						'lname' 			=> $INPUT_POST['inputLnameBene'],
						'suffix' 			=> $INPUT_POST['inpuSuffixBene'],
						'birthdate' 		=> $INPUT_POST['inputBdateBene'],
						'address_details' 	=> $INPUT_POST['inputStreetBene'] .", ". $INPUT_POST['inputBarangayBene'] .", ". $INPUT_POST['inputCityBene'] .", ". $INPUT_POST['inputProvinceBene'] .", ". $INPUT_POST['inputCountryBene'] .", ". $INPUT_POST['inputPostalBene'],
						'country' 			=> $INPUT_POST['inputCountryBene'],
						'mobile'			=> $INPUT_POST['inputMobileBene'],
						'email' 			=> $INPUT_POST['inputEmailBene'],

						$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
					);

					$result = $this->curl->call($parameter,$url);
					$data['AddBene'] = json_decode($result,true);
					if($data['AddBene']['S']==1){
						$parameter =array(
							'dev_id'     => $this->global_f->dev_id(),
							'ip_address' => $this->ip,
							'actionId' 	 => _remittance_search_bene_bsp,
							'regcode'    => $this->user['R'],
							'fname' 	 => $INPUT_POST['inputFnameBene'],
							'lname' 	 => $INPUT_POST['inputLnameBene'],
							'birthdate'  => $INPUT_POST['inputBdateBene'],
							'senderID'	 => $INPUT_POST['senderID'],
						);
						$result = $this->curl->call($parameter,$url);
						$data['beneDetails'] = json_decode($result,true);

						$param1 =array(
							'actionId' 	 => 'ups_ecash_service/remittance_selected_sender_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'rowid' 	 => $data['beneDetails']['result'][0]['sender_id'],
							'ip_address' => $this->ip
						); 
	
						$result1 = $this->curl->call($param1, $url);
	
						$param2 =array(
							'actionId' 	 => 'ups_ecash_service/remittance_selected_beneficiaryID_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'rowid'	 	 => $data['beneDetails']['result'][0]['id'],
							'ip_address' => $this->ip
						); 
	
						$result2 = $this->curl->call($param2, $url);
	
						$data['selectedID1'] = json_decode($result1, true);
						$data['selectedID2'] = json_decode($result2, true);
					}else{
						$senderID = $INPUT_POST['senderID'];
	
						$url = url;
				
						$parameter =array(
							'actionId' 	 => 'ups_ecash_service/remittance_search_bene_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'sender_id'  => $senderID,
							'ip_address' => $this->ip
						); 
	
						$result = $this->curl->call($parameter,$url);
						$data['row'] = json_decode($result,true);
						
						$fname = $data['row']['result'][0]['fname'];
						$lname = $data['row']['result'][0]['lname'];
						
						if($data['row']['S']===0){
							$data['rowMessage'] = "NO BENEFICIARY FOUND";
	
							$param1 =array(
								'dev_id'     		=> $this->global_f->dev_id(),
								'actionId' 	 		=> _remittance_search_bsp,
								'fname'  			=> $fname,
								'lname'  			=> $lname,
								'regcode' 			=> $this->user['R'],
								'ip_address'		=> $this->ip
							); 
	
							$resultAPI = $this->curl->call($param1, $url);
							$data['row'] = json_decode($resultAPI, true);
							
							if ($data['row']['S']==1) {
								$data['type'] = array('typeid'=>1,
														'typedesc'=>'Sender');
							}
						}else{
							$param2 =array(
								'actionId' 	 => 'ups_ecash_service/remittance_selected_sender_bsp',
								'dev_id' 	 => $this->global_f->dev_id(),
								'regcode'	 => $this->user['R'],
								'rowid' 	 => $senderID,
								'ip_address' => $this->ip
							); 
		
							$resultSelected = $this->curl->call($param2 ,$url);
							$data['selectedSender'] = json_decode($resultSelected,true);
							
							$senderinfo = explode("|", $this->input->post('inputSenderHide'));
					
							$data['type'] = array('typeid'=>2,
												  'typedesc'=>'Beneficiary',
												  'inputSenderName' => $senderinfo[1],
												  'inputSender'    	=> $this->input->post('inputSenderHide'));	
						}
					}
						
	 			}
				elseif(isset($_POST['btnAddSenderBSP'])){
	 				$INPUT_POST =$this->input->post(null,true);
	 				$T_VALUE =md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));
	 				$url = url;

					for($i = 1; $i <= 2; $i++){
						${'file'.$i} 			= $_FILES['file'.$i];
						${'file'.$i.'Name'} 	= ${'file'.$i}['name'];
						${'file'.$i.'Size'}		= ${'file'.$i}['size'];
						${'file'.$i.'Temp'}		= ${'file'.$i}['tmp_name'];
						${'file'.$i.'Error'} 	= ${'file'.$i}['error'];
					}

					if($file1Size < 2*MB || $file2Size < 2*MB) {
			
						for($a = 1; $a <= 2; $a++){
			
							${'url'.$a} = ${'file'.$a.'Temp'};
							if(${'file'.$a.'Size'} > 1*MB)
							{
								${'old_size'.$a} = ${'file'.$a.'Size'};
								${'urltmp'.$a}	 = sys_get_temp_dir().'/tmp.jpg';
								
								${'filename'.$a} = $this->compress_image(${'file'.$a.'Size'}, ${'urltmp'.$a}, 75);
								${'new_size'.$a} = filesize(${'urltmp'.$a});
							
								if(${'new_size'.$a} < ${'old_size'.$a})
								{
									${'url'.$a} = ${'urltmp'.$a};
								}
							}
							
							${'curl'.$a} = curl_init();
							${'localfile'.$a} = ${'url'.$a};
						}
			
						for($i = 1; $i <= 2; $i++){
							curl_setopt_array(${'curl'.$i}, array(
								CURLOPT_URL => 'https://unified.ph/kyc-upload',
								CURLOPT_RETURNTRANSFER => true,
								CURLOPT_ENCODING => '',
								CURLOPT_MAXREDIRS => 10,
								CURLOPT_TIMEOUT => 0,
								CURLOPT_FOLLOWLOCATION => true,
								CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
								CURLOPT_CUSTOMREQUEST => 'POST',
								CURLOPT_POSTFIELDS => array('file'=> new CURLFILE(${'localfile'.$i}),'file_location' => 'kyc-remittance','regcode' => $this->user['R'],'email' => '123','ext_name' => '.jpg'),
							));
							
							${'response'.$i} = curl_exec(${'curl'.$i}); 
							curl_close(${'curl'.$i});
							${'upload_response'.$i} = json_decode(${'response'.$i},true);
						}
						
						$id1 = $upload_response1['F'];
						$id2 = $upload_response2['F'];

						if($id1){
							$id1 = "/v1-sftp/kyc-remittance/".$upload_response1['F'];
						}
						if($id2){
							$id2 = "/v1-sftp/kyc-remittance/".$upload_response2['F'];
						}

					}else{
						$data['AddSender']['S'] = 0;
						$data['AddSender']['M'] = "FILE SIZE TOO BIG MUST BE LESS THAN 2MB";
					}

					if($id1){
						$parameter =array(
							'dev_id'    	   	=> $this->global_f->dev_id(),
							'ip_address'		=> $this->ip,
							'actionId' 	 		=> _remittance_add_user_bsp,
							'regcode'   		=> $this->user['R'],
							'transpass' 		=> $INPUT_POST['inputTpass'],
							'fname'				=> $INPUT_POST['inputFname'],
							'mname'				=> $INPUT_POST['inputMname'],
							'lname'				=> $INPUT_POST['inputLname'],
							'suffix'			=> $INPUT_POST['inpuSuffix'],
							'birthdate'			=> $INPUT_POST['inputBdate'],
							'birthplace'		=> $INPUT_POST['inputBirthplace'],
							'address_details'	=> $INPUT_POST['inputStreet'],
							'brgy'				=> $INPUT_POST['inputBarangay'],
							'city'				=> $INPUT_POST['inputCity'],
							'province'			=> $INPUT_POST['inputProvince'],
							'zip'				=> $INPUT_POST['inputPostal'],
							'country'			=> $INPUT_POST['inputCountry'],
							'permanent_address'	=> $INPUT_POST['inputStreet2'] . ", " . $INPUT_POST['inputBarangay2'] . ", " . $INPUT_POST['inputCity2'] . ", " . $INPUT_POST['inputProvince2'] . ", " . $INPUT_POST['inputCountry2'] . ", " . $INPUT_POST['inputPostal2'],
							'mobile'			=> $INPUT_POST['inputMobile'],
							'email'				=> $INPUT_POST['inputEmail'],
							'occupation'		=> $INPUT_POST['inputOccupation'],
							'sourcefund'		=> $INPUT_POST['inutSourceoffund'],
							'nationality'		=> $INPUT_POST['inputNationality'],
							'idtype1'			=> $INPUT_POST['newidtype'],
							'idno1'				=> $INPUT_POST['newidnumber'],
							'idexpiration1'		=> $INPUT_POST['newexpirydate1'],
							'idlink1'			=> $id1,
							'idtype2'			=> $INPUT_POST['newidtype2'],
							'idno2'				=> $INPUT_POST['newidnumber2'],
							'idexpiration2'		=> $INPUT_POST['newexpirydate12'],
							'idlink2'			=> $id2,
							$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
						);
	
						$result = $this->curl->call($parameter,$url);
						$data['AddSender'] = json_decode($result,true);
						
					}else{
						$data['AddSender']['S'] = 0;
						$data['AddSender']['M'] = "UPLOADING IMAGE FAILED";
					}
				}elseif(isset($_POST['proceedTransac'])) // Process the ECASHCEBUANA BSP form 
				{
					$INPUT_POST =$this->input->post(null,true);
					$url = url;

				   $param1 =array(
					   'actionId' 	 => 'ups_ecash_service/remittance_selected_sender_bsp',
					   'dev_id' 	 => $this->global_f->dev_id(),
					   'regcode'	 => $this->user['R'],
					   'rowid' 	 	 => $INPUT_POST['transactSenderID'],
					   'ip_address'  => $this->ip
				   ); 

				   $result1 = $this->curl->call($param1, $url);

				   $param2 =array(
					   'actionId' 	 => 'ups_ecash_service/remittance_selected_beneficiaryID_bsp',
					   'dev_id' 	 => $this->global_f->dev_id(),
					   'regcode'	 => $this->user['R'],
					   'rowid' 	 	 => $INPUT_POST['transactBeneID'],
					   'ip_address'  => $this->ip
				   ); 

				   $result2 = $this->curl->call($param2, $url);

				   	$param3 =array(
						'actionId' 	 => 'ups_cebuana_service_jorel/fetch_available_currency',
						'dev_id' 	 => $this->global_f->dev_id(),
						'regcode'	 => $this->user['R'],
						'ip_address' => $this->ip
					); 

					$result3 = $this->curl->call($param3, $url);
					
					$data['selectedID1'] = json_decode($result1, true);
					$data['selectedID2'] = json_decode($result2, true);

					if($data['selectedID1']['result'][0]['fname'] == $data['selectedID2']['result'][0]['fname'] &&
						$data['selectedID1']['result'][0]['lname'] == $data['selectedID2']['result'][0]['lname'] &&
						$data['selectedID1']['result'][0]['birthDate'] == $data['selectedID2']['result'][0]['birthdate']){

						$senderID = $INPUT_POST['transactSenderID'];
						$fname = $data['selectedID1']['result'][0]['fname'];
						$lname = $data['selectedID1']['result'][0]['lname'];

						$url = url;
				
						$parameter =array(
							'actionId' 	 => 'ups_ecash_service/remittance_search_bene_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'sender_id'  => $senderID,
							'ip_address' => $this->ip
						); 

						$result = $this->curl->call($parameter,$url);
						$data['row'] = json_decode($result,true);
						
						if($data['row']['S']===0){
							$data['rowMessage'] = "NO BENEFICIARY FOUND";

							$param1 =array(
								'dev_id'     		=> $this->global_f->dev_id(),
								'actionId' 	 		=> _remittance_search_bsp,
								'fname'  			=> $fname,
								'lname'  			=> $lname,
								'regcode' 			=> $this->user['R'],
								'ip_address'		=> $this->ip
							); 

							$resultAPI = $this->curl->call($param1, $url);
							$data['row'] = json_decode($resultAPI, true);
							
							if ($data['row']['S']==1) {
								$data['type'] = array('typeid'=>1,
														'typedesc'=>'Sender');
							}
						}else{
							$data['rowMessage'] = "CANNOT PROCEED, SENDER AND BENEFICIARY DETAILS ARE THE SAME";
							$param2 =array(
								'actionId' 	 => 'ups_ecash_service/remittance_selected_sender_bsp',
								'dev_id' 	 => $this->global_f->dev_id(),
								'regcode'	 => $this->user['R'],
								'rowid' 	 => $senderID,
								'ip_address' => $this->ip
							); 
		
							$resultSelected = $this->curl->call($param2 ,$url);
							$data['selectedSender'] = json_decode($resultSelected,true);
							
							$senderinfo = explode("|", $this->input->post('inputSenderHide'));
					
							$data['type'] = array('typeid'=>2,
												'typedesc'=>'Beneficiary',
												'inputSenderName' => $senderinfo[1],
												'inputSender'    	=> $this->input->post('inputSenderHide'));	
						}
					}else{
						$data['currency'] = json_decode($result3, true);
						$data['okTransac']['S'] = 1;
					}
				   
			   
				}elseif(isset($_POST['submitOTP'])) // Process submit OTP
				{
					$INPUT_POST =$this->input->post(null,true);
				   $url = url;

				   $parameter =array(
					   'actionId' 	 => 'ups_ecash_service/otpValidate',
					   'dev_id' 	 => $this->global_f->dev_id(),
					   'regcode'	 => $this->user['R'],
					   'traceno' 	 => $INPUT_POST['traceno'],
					   'otp' 	 	 => $INPUT_POST['otpCode'],
					   'ip_address' => $this->ip
				   ); 

				   $result = $this->curl->call($parameter, $url);

				   $data['otpResult'] = json_decode($result, true);
				   
				   if($data['otpResult']['S'] == 1){
					   for($i = 1; $i <= 2; $i++){
						   ${'file'.$i} 			= $_FILES['fileHigh'.$i];
						   ${'file'.$i.'Name'} 	= ${'file'.$i}['name'];
						   ${'file'.$i.'Size'}		= ${'file'.$i}['size'];
						   ${'file'.$i.'Temp'}		= ${'file'.$i}['tmp_name'];
						   ${'file'.$i.'Error'} 	= ${'file'.$i}['error'];
					   }
   
					   if($file1Size < 2*MB) {
			   
						   for($a = 1; $a <= 1; $a++){
			   
							   ${'url'.$a} = ${'file'.$a.'Temp'};
							   if(${'file'.$a.'Size'} > 1*MB)
							   {
								   ${'old_size'.$a} = ${'file'.$a.'Size'};
								   ${'urltmp'.$a}	 = sys_get_temp_dir().'/tmp.jpg';
								   
								   ${'filename'.$a} = $this->compress_image(${'file'.$a.'Size'}, ${'urltmp'.$a}, 75);
								   ${'new_size'.$a} = filesize(${'urltmp'.$a});
							   
								   if(${'new_size'.$a} < ${'old_size'.$a})
								   {
									   ${'url'.$a} = ${'urltmp'.$a};
								   }
							   }
							   
							   ${'curl'.$a} = curl_init();
							   ${'localfile'.$a} = ${'url'.$a};
						   }
			   
						   for($i = 1; $i <= 2; $i++){
							   curl_setopt_array(${'curl'.$i}, array(
								   CURLOPT_URL => 'https://unified.ph/kyc-upload',
								   CURLOPT_RETURNTRANSFER => true,
								   CURLOPT_ENCODING => '',
								   CURLOPT_MAXREDIRS => 10,
								   CURLOPT_TIMEOUT => 0,
								   CURLOPT_FOLLOWLOCATION => true,
								   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
								   CURLOPT_CUSTOMREQUEST => 'POST',
								   CURLOPT_POSTFIELDS => array('file'=> new CURLFILE(${'localfile'.$i}),'file_location' => 'kyc-remittance','regcode' => $this->user['R'],'email' => '123','ext_name' => '.jpg'),
							   ));
							   
							   ${'response'.$i} = curl_exec(${'curl'.$i}); 
							   curl_close(${'curl'.$i});
							   ${'upload_response'.$i} = json_decode(${'response'.$i},true);
						   }
						   
						   $id1 = $upload_response1['F'];
   
						   if($id1){
							   $id1 = "/v1-sftp/kyc-remittance/OTP_".$upload_response1['F'];
						   }
   
					   }

					   if($id1){
						   $param =array(
							   'actionId' 	 => 'ups_ecash_service/remittance_send_ecash_padala_bsp_confirm',
							   'dev_id' 	 => $this->global_f->dev_id(),
							   'regcode'	 => $this->user['R'],
							   'traceno' 	 => $INPUT_POST['traceno'],
							   'action' 	 => 'APPROVED',
							   'item_type'	 => 'PHOTO',
							   'photolink'  => $id1,
							   'ip_address' => $this->ip
						   ); 
   
						   $resultAPI = $this->curl->call($param, $url);
   
						   $data['transactConfirm'] = json_decode($resultAPI, true);
					   }else{
						   $data['transactConfirm']['S'] = 0;
						   $data['transactConfirm']['M'] = "UPLOADING IMAGE FAILED";
					   }

				   }

				}elseif(isset($_POST['btnSubmitBSP'])) // submit Tranasction BSP CEBUANA API
				{
					
					$INPUT_POST =$this->input->post(null,true);
					$url = url;
					$parameter =array(
						'actionId' 	  => 'ups_ecash_service/remittance_send_ecash_padala_bsp',
						'dev_id' 	  => $this->global_f->dev_id(),
						'regcode'	  => $this->user['R'],
						'transpass'	  => $INPUT_POST['inputTpass'],
						'sender_id'   => $INPUT_POST['transacSenderID'],
						'receiver_id' => $INPUT_POST['transacBeneID'],
						'relation' 	  => $INPUT_POST['inputRelation'],
						'purpose' 	  => $INPUT_POST['inputPurpose'],
						'service' 	  => $INPUT_POST['service'],
						'currency' 	  => $INPUT_POST['inputCurrency'],
						'principal'	  => $INPUT_POST['inputAmount'],
						'ip_address'  => $this->ip
					);

					$result = $this->curl->call($parameter,$url);
					$data['transactStatus'] = json_decode($result,true);
					$data['receiptCharge'] = $INPUT_POST['inputCharge'];

					if($data['transactStatus']['S'] == 1){
						
						$data['level'] = $this->user['L'];
						if(($data['level'] != 7) && ($data['level'] != 16)){  
							$traceno = $data['transactStatus']['TN'];
	
							$data['receiptResult'] = "APPROVED";

							$paramLowDetails =array(
								'actionId' 	 => 'ups_ecash_service/fetch_traceno_details',
								'dev_id' 	 => $this->global_f->dev_id(),
								'regcode'	 => $this->user['R'],
								'traceno'	 => $traceno,
								'ip_address' => $this->ip
							);
							
							$fetchLowDetails = $this->curl->call($paramLowDetails, $url);
							$data['tracenoDetails'] = json_decode($fetchLowDetails,true);

							$data['receiptResult'] = "PENDING";
							$data['transactDealer']['S'] = 1;
						}
						elseif($data['transactStatus']['RISK'] == "LOW"){
							$param =array(
								'actionId' 	 => 'ups_ecash_service/remittance_send_ecash_padala_bsp_confirm',
								'dev_id' 	 => $this->global_f->dev_id(),
								'regcode'	 => $this->user['R'],
								'traceno' 	 => $data['transactStatus']['TN'],
								'action' 	 => 'APPROVED',
								'ip_address' => $this->ip
							); 	
	
							$resultAPI = $this->curl->call($param, $url);
							$data['transactConfirmLow'] = json_decode($resultAPI,true);
	
							if($data['transactConfirmLow']['S'] == 1){
								$traceno = $data['transactStatus']['TN'];
	
								$data['receiptResult'] = "APPROVED";
	
								$paramLowDetails =array(
									'actionId' 	 => 'ups_ecash_service/fetch_traceno_details',
									'dev_id' 	 => $this->global_f->dev_id(),
									'regcode'	 => $this->user['R'],
									'traceno'	 => $traceno,
									'ip_address' => $this->ip
								);
								
								$fetchLowDetails = $this->curl->call($paramLowDetails, $url);
								$data['tracenoDetails'] = json_decode($fetchLowDetails,true);
								
								$paramLow =array(
									'actionId' 	 => 'ups_cebuana_service_jorel/send_cebuana_remittance',
									'dev_id' 	 => $this->global_f->dev_id(),
									'regcode'	 => $this->user['R'],
									'traceno'	 => $traceno,
									'ip_address' => $this->ip,
									'ip' => $this->ip
								);
	
								$resultLowAPI = $this->curl->call($paramLow, $url);
								$data['transactBSPLow'] = json_decode($resultLowAPI,true);
	
								// NOTIFY APPROVED BSP TRANSACTION
								$refno = $data['transactBSPLow']['TN'];
								
								$notifLow =array(
									'actionId' 	 => 'ups_ecash_service/notifySenderReceiver',
									'dev_id' 	 => $this->global_f->dev_id(),
									'regcode'	 => $this->user['R'],
									'traceno'	 => $traceno,
									'refno'	  	 => $refno,
									'type'	  	 => "APPROVE",
									'ip_address' => $this->ip
								);
	
								$resultLowNotif = $this->curl->call($notifLow, $url);
								$data['notifLow'] = json_decode($resultLowNotif,true);
							}
						}
						elseif($data['transactStatus']['RISK'] == "NORMAL" || $data['transactStatus']['RISK'] == "HIGH"){
							$param1 =array(
								'actionId' 	  => 'ups_ecash_service/risk_profiling',
								'dev_id' 	  => $this->global_f->dev_id(),
								'regcode'	  => $this->user['R'],
								'traceno'	  => $data['transactStatus']['TN'],
								'ip_address'  => $this->ip
							);
		
							$resultAPI1 = $this->curl->call($param1,$url);
							$data['RISK_DESCRIPTION'] = json_decode($resultAPI1,true);
							
							$param2 =array(
								'actionId' 	  => 'ups_ecash_service/checkRiskProfile',
								'dev_id' 	  => $this->global_f->dev_id(),
								'regcode'	  => $this->user['R'],
								'traceno'	  => $data['transactStatus']['TN'],
								'ip_address'  => $this->ip
							);
		
							$resultAPI2 = $this->curl->call($param2, $url);
							$data['OTP'] = json_decode($resultAPI2,true);
							
	
							$param3 =array(
								'actionId' 	  => 'ups_ecash_service/fetch_traceno_details',
								'dev_id' 	  => $this->global_f->dev_id(),
								'regcode'	  => $this->user['R'],
								'traceno'	  => $data['transactStatus']['TN'],
								'ip_address'  => $this->ip
							);
		
							$resultAPI3 = $this->curl->call($param3, $url);
							$data['tracenoDetails'] = json_decode($resultAPI3,true);
							
	
						}
					}else{
						$param1 =array(
							'actionId' 	 => 'ups_ecash_service/remittance_selected_sender_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'rowid'		 => $INPUT_POST['transacSenderID'],
							'ip_address' => $this->ip
						); 
	
						$result1 = $this->curl->call($param1, $url);
	
						$param2 =array(
							'actionId' 	 => 'ups_ecash_service/remittance_selected_beneficiaryID_bsp',
							'dev_id' 	 => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'rowid'		 => $INPUT_POST['transacBeneID'],
							'ip_address' => $this->ip
						); 
	
						$result2 = $this->curl->call($param2, $url);
	
						$data['selectedID1'] = json_decode($result1, true);
						$data['selectedID2'] = json_decode($result2, true);

						$data['inputRelation'] = $INPUT_POST['inputRelation'];
						$data['inputPurpose']  = $INPUT_POST['inputPurpose'];
						
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
									'ip_address'	    => $this->ip,
				    				'regcode'   		=> $this->user['R'],
				    				'sender_id'			=> $this->input->post('refSenderID'),
				    				'fname'				=> $this->input->post('inputFname'),
				    				'lname'				=> $this->input->post('inputLname'),
				    				'mname'				=> $this->input->post('inputMname'),
				    				'birthdate'			=> $this->input->post('inputBdate'),
				    				'mobile'			=> $this->input->post('inputMobile'),
				    				'transpass'			=> $this->input->post('inputTpass'),
				    				'ip'				=> $this->ip,
				    				$this->user['SKT']	=> md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
			    				    );

					 	$result = $this->curl->call($parameter,$url);
						$results = json_decode($result,true);

						if ($results['S'] == 1) {
				    		$data['results'] = array(
								    				'S' => 1,
								    				'M' => $regtype.' registration is successful.',
								    				'R' => 1
				    								);
				    	}else{
				    		$data['results'] = array(
								    				'S' => 0,
								    				'M' => $results['M']
				    								);
				    	}
	 			}
				
				if($CHECK_MISSING_DATA == 1) {	
					$this->load->view('layout/header',$data);
					$this->load->view('element/top_header');
					$this->load->view('element/wrapper_header');
					$this->load->view('element/left_panel');
					$this->load->view('remittance/ecash_send/updateDealer'); //UPDATE DEALER SENDER DETAILS
					$this->load->view('element/wrapper_footer');
					$this->load->view('layout/footer');
				}else{
					$this->load->view('layout/header',$data);
					$this->load->view('element/top_header');
					$this->load->view('element/wrapper_header');
					$this->load->view('element/left_panel');
					$this->load->view('remittance/ecash_send/ecash_to_cebuana_bsp'); //NEW ECASH TO CEBUANA UI BSP
					// 	$this->load->view('remittance/ecash_send/ecash_to_cebuana'); //OLD ECASH TO CEBUANA UI
					$this->load->view('element/wrapper_footer');
					$this->load->view('layout/footer');
				}
			}else {
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
			redirect('Main/');
		}

	}

	function otp_cebuana_resend()
	{
		if (isset($_POST['trackno'])){
			$url = url;
			$parameter = array( 'dev_id'     		=> $this->global_f->dev_id(),
		    				 	'ip_address' 		=> $this->ip,
		    					 'actionId' 	 	=> _otp_cebuana_resend,
    							 'regcode'   	 	=> $this->user['R'],
		    					 'trackno'    		=> $_POST['trackno'],
		    					 'ip'    			=> $this->ip,
		    					 $this->user['SKT'] => md5($this->user['R'].$this->user['SKT'])
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
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
			redirect('Main/');
		}

	}

	function get_amendment_fee()
	{
		$url = url;
		$parameter =array(
			'dev_id' 	 => $this->global_f->dev_id(),
			'actionId' 	 => _cebuana_amend_fee,
			'ip_address' => $this->ip,
			'amount' 	 => $this->input->post('amount'),
			'cur_id' 	 => $this->input->post('curid'),
			'regcode' 	 => $this->user['R']
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
						'ip_address'	    => $this->ip,
	    				'regcode'   		=> $this->user['R'],
	    				'sender_id'			=> $this->input->post('refSenderID'),
	    				'fname'				=> $this->input->post('inputFname'),
	    				'lname'				=> $this->input->post('inputLname'),
	    				'mname'				=> $this->input->post('inputMname'),
	    				'birthdate'			=> $this->input->post('inputBdate'),
	    				'mobile'			=> substr($this->input->post('inputMobile'), 1),
	    				'transpass'			=> $this->input->post('inputTpass'),
	    				'ip'				=> $this->ip,
	    				$this->user['SKT']	=> md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
    				    );

		 	$result = $this->curl->call($parameter,$url);
			$results = json_decode($result,true);

			if ($results['S'] == 1) {
	    		$response = array(
			    				'S' => 1,
			    				'M' => 'Beneficiary registration is successful.',
	    						);
	    	}else{
	    		$response = array(
				    			'S' => 0,
				    			'M' => $results['M']
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
									'ip_address'	   => $this->ip,
									'regcode'          => $this->user['R'],
									'ctrl_no'		   => $this->input->post('inputReferenceNo'),
									'mode_mp'	       => 'payout',
									'type'		       => 'amend',
									$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'].$this->input->post('inputReferenceNo'))
									);
					    $result = $this->curl->call($parameter,$url);
					    $data['API'] = json_decode($result,true);
					    $data['details'] = $data['API']['T_DATA'];

		    			$data['ctrlnumber'] = $this->input->post('inputReferenceNo');   

					}elseif (isset($_POST['btnCebuanaAmmendConfirm'])){
	 					$beneinfo = explode("|", $this->input->post('inputAmmendDetails'));

		 				$url = url;
						$parameter =array(
									'dev_id'     	   => $this->global_f->dev_id(),
									'actionId' 	 	   => _cebuana_amend,
				    				'regcode'   	   => $this->user['R'],
				    				'transpass' 	   => $this->input->post('inputTranspass'),
				    				'ctrl_no'	       => $beneinfo[4],
				    				'bene_id'	       => $beneinfo[0],
				    				'bene_f'	       => $beneinfo[1],
				    				'bene_m'	       => $beneinfo[2],
				    				'bene_l'	       => $beneinfo[3],
				    				'ip_address'	   => $this->ip,
				    				$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTranspass')))
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
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
			redirect('Main/');
		}

	}

	
	public function ecashtowestern()
	{
		if ($this->user['A_CTRL']['remittance'] == 1 && $this->user['A_CTRL']['remittance_westernunion_send'] == 1 || false)
		{
			$this->check_trans->gwlCheckTransLimit(152); //FOR WEALTHY LIFESTYLE

			$data = array('menu' => 2, 'parent' => 'REMITTANCE' );

			/*$reg_codes = array(
				'1234567',
				'F5033230',
				'F5385420',
				'F5950087',
				'F6238825',
				'F6429926',
				'F6522385',
				'F6618590',
				'F6657731',
				'F6696243',
				'F8745532'
			);*/

			if ($this->user['S'] == 1 && $this->user['R'] !="")
			{
				$data['user'] = $this->user;
				$url = url;

				$data['process'] = 0;

				//Country & Currency
				$parameter = array(
					'dev_id' => $this->global_f->dev_id(),
					'actionId' => _fetch_countries_iso,
					'regcode' => $this->user['R'],
					'ip_address' =>$this->ip
				);

				$result = $this->curl->call($parameter,$url);
				$results = json_decode($result,true);

				$data['country'] = $results['T_DATA'];
				$data['currency'] = $results['F_DATA'];

				//Branch Locations
				$parameter = array(
					'dev_id' => $this->global_f->dev_id(),
					'actionId' => 'western_api/getBranchLocation',
					'regcode' => $this->user['R'],
					'ip_address' => $this->ip
				); 
				
				$result = $this->curl->call($parameter,$url);
				$results = json_decode($result,true);
				$branchLocations = json_decode($results['R'],true);

				foreach ($branchLocations as $branchLocation) {
					$data['branch_locations'][$branchLocation['branchName']] = $branchLocation['branchName'];
				}

				asort($data['branch_locations']);

				//Provinces
				$parameter = array(
					'dev_id' => $this->global_f->dev_id(),
					'actionId' => 'ups_ecash_service_nes/get_western_union_provinces',
					'regcode' => $this->user['R'],
					'ip_address' => $this->ip
				);

				$result = $this->curl->call($parameter, $url);
				$results = json_decode($result, true);
				$data['provinces'] = $results['T_DATA'];


				//Occupations
				$parameter = array(
					'dev_id' => $this->global_f->dev_id(),
					'actionId' => 'ups_ecash_service_nes/get_western_union_occupation',
					'regcode' => $this->user['R'],
					'ip_address' => $this->ip
				);

				$result = $this->curl->call($parameter, $url);
				$results = json_decode($result, true);
				$data['occupations'] = $results['T_DATA'];

				//Currency Codes
				$parameter = array(
					'dev_id' => $this->global_f->dev_id(),
					'actionId' => 'ups_ecash_service_nes/get_western_union_countries_currency_code',
					'regcode' => $this->user['R'],
					'ip_address' => $this->ip
				);

				$result = $this->curl->call($parameter, $url);
				$results = json_decode($result, true);
				$data['currency_codes'] = $results['T_DATA'];
				
				//Search Sender
				if (isset($_POST['btnSsearch'])) 
				{
					$search = $this->input->post('inputSearch');

					$parameter = array(
						'dev_id' => $this->global_f->dev_id(),
						'actionId' => 'ups_ecash_service/remittance_western_union_search_user',
						'search_key' => $search,
						'regcode' => $this->user['R'],
						'ip_address' => $this->ip,
						'client' => 'sender'
					);

					$result = $this->curl->call($parameter,$url);

					$data['row'] = json_decode($result, true);

					if ($data['row']['S'] == 1 ) {
						$data['type'] = array('typeid' => 1, 'typedesc' => 'Sender');
					}
				}

				//Search Benificiary
				elseif (isset($_POST['btnBsearch'])) 
				{
					$search = $this->input->post('inputSearch');

					// $client = (in_array($this->user['R'],$reg_codes))?'beneficiary':'sender';

					$client = 'beneficiary';

					$parameter = array(
						'dev_id' => $this->global_f->dev_id(),
						'actionId' => 'ups_ecash_service/remittance_western_union_search_user',
						'search_key' => $search,
						'regcode' => $this->user['R'],
						'ip_address' => $this->ip,
						'client' => $client // change to benificiary, to open international transaction
					);

					$result = $this->curl->call($parameter,$url);

					$data['row'] = json_decode($result,true);

					$senderinfo = explode("|", $this->input->post('inputSenderHide'));
					
					$data['type'] = array('typeid'=> 2, 'typedesc'=> 'Benificiary', 'inputSenderName' => $senderinfo[1], 'inputSender' => $this->input->post('inputSenderHide'));
				}

				// add sender and benificiary
				elseif (isset($_POST['btnAddDetails']))
				{
					$INPUT_POST = $this->input->post(null,true);

					$T_VALUE = md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));

					$parameter = array(
						'dev_id'	 => $this->global_f->dev_id(),
						'ip_address' => $this->ip,
						'actionId'	 => _remittance_add_user,
						'regcode'	 => $this->user['R'],
						'transpass'	 => $INPUT_POST['inputTpass'],
						'firstname'	 => $INPUT_POST['inputFname'],
						'middlename' => $INPUT_POST['inputMname'],
						'lastname'	 => $INPUT_POST['inputLname'],
						'mobileno'	 => $INPUT_POST['inputMobile'],	
						'gender'	 => $INPUT_POST['selGender'],
						'email'		 => $INPUT_POST['inputEmail'],
						'address'	 => $INPUT_POST['inputAddr'] != '' ? $INPUT_POST['inputAddr'] : $INPUT_POST['modInputAddr1'] . ' ' . $INPUT_POST['modInputAddr2'] . ' ' . $INPUT_POST['modInputCity'] . ' ' . $INPUT_POST['modInputProvince'] . ' ' . $INPUT_POST['modInputPostal'],
						'address1'	 => $INPUT_POST['modInputAddr1'],
						'address2'	 => $INPUT_POST['modInputAddr2'],
						'city'	 	 => $INPUT_POST['modInputCity'],
						'province'	 => ($INPUT_POST['selCountry'] == 'Philippines' || $INPUT_POST['selCountry'] == 'PHILIPPINES') ? $INPUT_POST['modSelectProvince'] : $INPUT_POST['modInputProvince'],
						'postal'	 => $INPUT_POST['modInputPostal'],
						'country'	 => $INPUT_POST['selCountry'],
						'birthday'	 => $INPUT_POST['inputBdate'],
						$this->user['SKT'] => md5($this->user['R'] . $this->user['SKT'] . md5($this->input->post('inputTpass')))
					);

					$result = $this->curl->call($parameter,$url);
					$data['API'] = json_decode($result,true);
				}

				// update details
				elseif (isset($_POST['btnUpdateDetails']))
				{
					$parameter = array (
						'dev_id'	 => $this->global_f->dev_id(),
						'ip_address' => $this->ip,
						'actionId'	 => 'ups_ecash_service/remittance_western_union_update_user',
						'regcode'	 => $this->user['R'],
						'transpass'	 => $this->input->post('updateInputTransPass'),
						'client_id'	 => $this->input->post('updateInputClientId'),
						'address'	 => $this->input->post('updateInputAddr1') . ' ' . $this->input->post('updateInputAddr2') . ' ' . $this->input->post('updateInputCity') . ' ' . $this->input->post('updateInputProvince') . ' ' . $this->input->post('updateInputPostal'),
						'address1'	 => $this->input->post('updateInputAddr1'),
						'address2'	 => $this->input->post('updateInputAddr2'),
						'city'	 	 => $this->input->post('updateInputCity'),
						'province'	 => ($this->input->post('updateInputCountry') == 'Philippines' || $this->input->post('updateInputCountry') == 'Philippines') ? $this->input->post('updateSelectProvince') : $this->input->post('updateInputProvince'),
						'postal'	 => $this->input->post('updateInputPostal'),
						$this->user['SKT']	=> md5($this->user['R']. $this->user['SKT'] . md5($this->input->post('updateInputTransPass')))
					);

					$result = $this->curl->call($parameter, $url);
					$data['API'] = json_decode($result, true);
				}

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');

				// $this->load->view(in_array($this->user['R'], $reg_codes) ? 'remittance/ecash_send/ecash_to_western_11172021' : 'remittance/ecash_send/ecash_to_western');
				
				$this->load->view('remittance/ecash_send/ecash_to_western_11172021');

				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');
			}
			else 
			{
				$this->session->sess_destroy();
				redirect('Login/');
			}
		}
		else 
		{
			redirect('Main/');
		}
	}

	function landbank_send()
	{
		if ($this->user['A_CTRL']['remittance'] == 1)
		{
			$this->check_trans->gwlCheckTransLimit(152); //FOR WEALTHY LIFESTYLE

			$data = array('menu' => 2, 'parent' => 'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !="")
			{
				$data['user'] = $this->user;
				$url = url;
				$data['process'] = 0;

				//Country & Currency
				$parameter = array(
					'dev_id'	 => $this->global_f->dev_id(),
					'actionId'	 => _fetch_countries_iso,
					'regcode'	 => $this->user['R'],
					'ip_address' =>$this->ip
				);

				$result = $this->curl->call($parameter,$url);
				$results = json_decode($result,true);
				$data['country'] = $results['T_DATA'];
				$data['currency'] = $results['F_DATA'];

				//Provinces
				$parameter = array(
					'dev_id'	 => $this->global_f->dev_id(),
					'actionId'	 => 'ups_ecash_service_nes/get_western_union_provinces',
					'regcode'	 => $this->user['R'],
					'ip_address' => $this->ip
				);

				$result = $this->curl->call($parameter, $url);
				$results = json_decode($result, true);
				$data['provinces'] = $results['T_DATA'];

				//Occupations
				$parameter = array(
					'dev_id'	 => $this->global_f->dev_id(),
					'actionId'	 => 'ups_ecash_service_nes/get_western_union_occupation',
					'regcode'	 => $this->user['R'],
					'ip_address' => $this->ip
				);

				$result = $this->curl->call($parameter, $url);
				$results = json_decode($result, true);
				$data['occupations'] = $results['T_DATA'];

				//Search Sender
				if (isset($_POST['btnSsearch'])) 
				{
					$search = $this->input->post('inputSearch');

					$parameter = array(
						'dev_id'	 => $this->global_f->dev_id(),
						'actionId'	 => 'ups_land_bank/search_customer',
						'search'	 => $search,
						'regcode'	 => $this->user['R'],
						'ip_address' => $this->ip
					);

					$result = $this->curl->call($parameter,$url);

					$data['row'] = json_decode($result, true);

					if ($data['row']['S'] == 1 ) {
						$data['type'] = array('typeid' => 1, 'typedesc' => 'Sender');
					}
				}

				//Search Benificiary
				elseif (isset($_POST['btnBsearch'])) 
				{
					$search = $this->input->post('inputSearch');

					// $client = (in_array($this->user['R'],$reg_codes))?'beneficiary':'sender';

					$client = 'beneficiary';

					$parameter = array(
						'dev_id' => $this->global_f->dev_id(),
						'actionId' => 'ups_land_bank/search_customer',
						'search' => $search,
						'regcode' => $this->user['R'],
						'ip_address' => $this->ip
					);

					$result = $this->curl->call($parameter,$url);

					$data['row'] = json_decode($result,true);

					$senderinfo = explode("|", $this->input->post('inputSenderHide'));
					
					$data['type'] = array('typeid'=> 2, 'typedesc'=> 'Benificiary', 'inputSenderName' => $senderinfo[1], 'inputSender' => $this->input->post('inputSenderHide'));
				}
				
				//views
				$this->load->view('layout/header', $data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_send/landbank_send.php');
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');

			} else {
				$this->session->sess_destroy();
				redirect('Login/');
			}

		} else {
			redirect('Main/');
		}
	}

	function landbank_sender_add()
    {
		$url = url;
		$INPUT_POST = $this->input->post(null,true);
		$T_VALUE = md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));
		
		$parameter = array(
			'dev_id'	   	=> $this->global_f->dev_id(),
			'ip_address'   	=> $this->ip,
			'actionId'	   	=> 'ups_land_bank/customer_insert',
			'regcode'	   	=> $this->user['R'],
			'first_name'   	=> $this->input->post('first_name'),
			'middle_name'  	=> $this->input->post('middle_name'),
			'last_name'	   	=> $this->input->post('last_name'),
			'house_st'	   	=> $this->input->post('house_st'),
			'brgy'	 	   	=> $this->input->post('brgy'),
			'city'	 	   	=> $this->input->post('city'),
			'province'	   	=> $this->input->post('province'),
			'country'	   	=> $this->input->post('country'),
			'zip_code'	   	=> $this->input->post('zip_code'),
			'area_code'	   	=> $this->input->post('area_code'),
			'nationality'  	=> $this->input->post('nationality'),
			'gender'	   	=> $this->input->post('gender'),
			'profession'   	=> $this->input->post('profession'),
			'phone_no'	   	=> $this->input->post('phone_no'),
			'mobile_no'	   	=> $this->input->post('mobile_no'),	
			'office_no'	   	=> $this->input->post('office_no'),	
			'birth_date'   	=> $this->input->post('birth_date'),
			'civil_status' 	=> $this->input->post('civil_status'),
			'email_add'	   	=> $this->input->post('email_add'),
			'transpass'	 	=> $this->input->post('transpass'),
			$this->user['SKT'] => md5($this->user['R'] . $this->user['SKT'] . md5($this->input->post('transpass')))
		);

		$result = $this->curl->call($parameter,$url);
		$response= json_decode($result,true);
		echo json_encode($response);
    }

	function landbank_sender_add_transaction()
    {
		$url = url;
		$INPUT_POST = $this->input->post(null,true);
		$T_VALUE = md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));
		
		$parameter = array(
			'dev_id' 			=> $this->global_f->dev_id(),
			'ip_address' 		=> $this->ip,
			'actionId' 			=> 'ups_land_bank/send_transact',
			'regcode' 			=> $this->user['R'],
			'sender_id' 		=> $this->input->post('sender_id'),
			's_country_birth' 	=> $this->input->post('s_country_birth'),
			's_nationality' 	=> $this->input->post('s_nationality'),
			's_relationship_to_beneficiary' => $this->input->post('s_relationship_to_beneficiary'),
			's_occupation' 		=> $this->input->post('s_occupation'),
			's_employer' 		=> $this->input->post('s_employer'),
			's_source_of_fund' 	=> $this->input->post('s_source_of_fund'),

			'beneficiary_id' 	=> $this->input->post('beneficiary_id'),
			'b_country_birth' 	=> $this->input->post('b_country_birth'),
			'b_nationality' 	=> $this->input->post('b_nationality'),
			'b_relationship_to_sender' => $this->input->post('b_relationship_to_sender'),
			'b_occupation' 		=> $this->input->post('b_occupation'),
			'b_employer' 		=> $this->input->post('b_employer'),
			'b_source_of_fund' 	=> $this->input->post('b_source_of_fund'),

			'amount' 	 => $this->input->post('amount'),	
			'account_no' => $this->input->post('account_no'),	
			'primary_id' =>$this->input->post('primary_id'),
			'transpass'  => $this->input->post('transpass'),
			$this->user['SKT'] => md5($this->user['R'] . $this->user['SKT'] . md5($this->input->post('transpass')))
		);

		$result = $this->curl->call($parameter,$url);
		$response= json_decode($result,true);
		echo json_encode($response);
    }

	function get_country_charge(){
		$url = url;
		$parameter =array(
			'dev_id'	 => $this->global_f->dev_id(),
			'actionId'	 => _fetch_country_charge,
			'ip_address' => $this->ip,
			'regcode'	 => $this->user['R'],
			'country'	 => $this->input->post('country'),
			'amount'	 => $this->input->post('amount'),
			'currency'	 => $this->input->post('currency'),
			'bb_country' => $this->input->post('bb_country')
		);

		$result = $this->curl->call($parameter,$url);
		$response= json_decode($result,true);
		echo json_encode($response);
	}

	function ecash_to_western_send(){
		$url = url;
		$parameter =array(
			'dev_id'    	    => $this->global_f->dev_id(),
			'ip_address'		=> $this->ip,
			'actionId' 	 		=> _ecash_to_western,
			'regcode'   		=> $this->user['R'],
			'transpass' 		=> $this->input->post('transpass'),
			'sender_id'			=> $this->input->post('sender_id'),
			'beneficiary_id'	=> $this->input->post('beneficiary_id'),
			'amount'			=> $this->input->post('amount'),
			'currency'			=> $this->input->post('currency'),
			'primaryId'			=> $this->input->post('primaryId'),
			'secondaryId'		=> $this->input->post('secondaryId'),
			'tertiaryId'		=> $this->input->post('tertiaryId'),
			'country'			=> $this->input->post('country'),
			'occupation'		=> $this->input->post('occupation'),
			'relationbene'		=> $this->input->post('relationbene'),
			'empname'			=> $this->input->post('empname'),
			'fundsrc'			=> $this->input->post('fundsrc'),
			'countrybirth'		=> $this->input->post('countrybirth'),
			'nationality'		=> $this->input->post('nationality'),
			'branch_location' 	=> $this->input->post('branch_location'),
			'city' 				=> $this->input->post('city'),
			'province' 			=> $this->input->post('province'),
			'postal_code' 		=> $this->input->post('postal_code'),
			'position_level' 	=> $this->input->post('position_level'),
			'transaction_reason'=> $this->input->post('transaction_reason'),
			'id_country_issued' => $this->input->post('id_country_issued'),
			'issue_date' 		=> $this->input->post('issue_date'),
			'destination_country_code' 	=> $this->input->post('destination_country_code'),
			'destination_currency_code' => $this->input->post('destination_currency_code'),
			'state_code' 		=> $this->input->post('state_code'),
			$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('transpass')))
		);
		$result = $this->curl->call($parameter,$url);
		$response= json_decode($result,true);

		echo json_encode($response);
	}

	function ecash_to_western_send_details () {
		// $reg_codes = array(
		// 	'1234567',
		// 	'F5033230',
		// 	'F5385420',
		// 	'F5950087',
		// 	'F6238825',
		// 	'F6429926',
		// 	'F6522385',
		// 	'F6618590',
		// 	'F6657731',
		// 	'F6696243',
		// 	'F8745532'
		// );

		// if (in_array($this->user['R'], $reg_codes)) {
			$url = url;

			$parameter =array(
				'dev_id' 	 	  	 => $this->global_f->dev_id(),
				'actionId' 	 	  	 => _ecash_to_western_details,
				'regcode' 	 	  	 => $this->user['R'],
				'ip_address' 	  	 => $this->ip,
				'tracking_number' 	 => $this->input->post('tracking_number'),
				'branch_location' 	 => $this->input->post('branch_location'),
				'city' 			  	 => $this->input->post('city'),
				'province' 		  	 => $this->input->post('province'),
				'postal_code' 	  	 => $this->input->post('postal_code'),
				'position_level'  	 => $this->input->post('position_level'),
				'transaction_reason' => $this->input->post('transaction_reason'),
				'id_country_issued'  => $this->input->post('id_country_issued'),
				'issue_date' 	  	 => $this->input->post('issue_date'),
				'destination_country_code'  => $this->input->post('destination_country_code'),
				'destination_currency_code' => $this->input->post('destination_currency_code'),
				'state_code' => $this->input->post('state_code')
			); 
	
			$result = $this->curl->call($parameter, $url);
	
			$response = json_decode($result, true);
	
			echo json_encode($response);
		// }
	}

	function ecash_to_western_state_codes() 
	{
		$url = url;

		$parameter = array(
			'dev_id' 		=> $this->global_f->dev_id(),
			'actionId' 		=> 'western_api/getStateList',
			'regcode' 		=> $this->user['R'],
			'ip_address' 	=> $this->ip,
			'country_code' 	=> $this->input->post('country_code')
		);

		$result = $this->curl->call($parameter, $url);

		$response = json_decode($result);

		echo json_encode($response);
	}

	function ecash_to_western_send_approved () {
		$user = $this->Sp_model->userValidate($this->user['R'],md5($this->input->post('tpass')));

		if ($user['userlevel'] == 7) {
			$tracknoapprove = $this->input->post('tracking_number');
			$res_ref = json_decode($this->getSendRefNo($tracknoapprove), true);
			
			if ($res_ref['S'] == 1) {
				$mtcn = $res_ref['MTCN'];

				$url = url;

				$parameter =array(
					'dev_id' 			=> $this->global_f->dev_id(),
					'actionId' 			=> 'ups_ecash_service_nes/ecash_to_western_sender_approved',
					'regcode' 			=> $this->user['R'],
					'ip_address' 		=> $this->ip,
					'tracking_number' 	=> $tracknoapprove,
					'mtcn' => $mtcn
				); 	
				$result = $this->curl->call($parameter, $url);	
				$response = json_decode($result, true);
		
				echo json_encode($response);
			}
		}
		
	}

	public function getSendRefNo ($trackingNo) {
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://mobileapi.unified.ph/western_api/sendWestern',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => array('username' => 'system_generated','trackingNo' => $trackingNo),
		));
	
		$response = curl_exec($curl); 

		curl_close($curl);

		return $response;
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
							'actionId' 	 => _get_status_pending_western,
							'ip_address' => $this->ip,
							'trackno'    => $tn
						);
						$data['API'] = json_decode($this->curl->call($parameters,$url),true);
				}

 				$parameter =array(
						'dev_id'     	=> $this->global_f->dev_id(),
						'actionId' 	 	=> _fetch_pending_western,
	    				'regcode' 		=> $this->user['R'],
	    				'ip_address'	=> $this->ip
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
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
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
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
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
 // COmment by rene original ecash_to_paymaya_send
	// function ecash_to_paymaya_send(){
	// 	$url = url;
	// 	$parameter =array(
	// 		'dev_id'    	    => $this->global_f->dev_id(),
	// 		'ip_address'		=>$this->ip,
	// 		'actionId' 	 		=> 'ups_paymaya_service_rev2/ecash_to_paymaya',
	// 		'regcode'   		=>$this->user['R'],
	// 		'transpass' 		=>$this->input->post('transpass'),
	// 		'accountno'			=>$this->input->post('accountno'),
	// 		'amount'			=>$this->input->post('amount'),
	// 		'sender_id'			=>$this->input->post('sender_id'),
	// 		'channel'			=>$this->input->post('channel'),
	// 		'sender'			=>$this->input->post('sender'),
	// 		'beneficiary'		=>$this->input->post('beneficiary'),
	// 		$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].$this->input->post('transpass'))
	// 	    );

	// 		// var_dump($parameter); 
		
	// 	$result = $this->curl->call($parameter,$url);
	// 	$response= json_decode($result,true);		
		
	// 		// var_dump($response); 

	// 	echo json_encode($response);
	// }


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
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
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
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
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
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
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

					if (false) {
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
							'ftp_server'        => ftp_server_radius,
							'ftp_port'          => 800,
							'ftp_user'          => 'argel',
							'ftp_pass'          => 'argel_argel!!!',
							'ftp_path'          => '/Remittance/',
							'ftp_filename'      => $image_id,
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

					} else {//sftp
						$curl = curl_init();
						$localfile = $url;

						curl_setopt_array($curl, array(
							CURLOPT_URL => 'https://unified.ph/kyc-upload',
							CURLOPT_RETURNTRANSFER => true,
							CURLOPT_ENCODING => '',
							CURLOPT_MAXREDIRS => 10,
							CURLOPT_TIMEOUT => 0,
							CURLOPT_FOLLOWLOCATION => true,
							CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							CURLOPT_CUSTOMREQUEST => 'POST',
							CURLOPT_POSTFIELDS => array('file'=> new CURLFILE($localfile),'file_location' => 'remittance','regcode' => $this->user['R'],'email' => '123','ext_name' => '.jpg'),
						));
						
						$response = curl_exec($curl); 
						curl_close($curl);
						$upload_response = json_decode($response,true);
						
						$filename = $upload_response['F'];
						
						$data['user'] = $this->user;

						$SELVALIDID = '';
						if ($CREATE_NEW == 1 || $CREATE_NEW == 2 || $CREATE_NEW == 3) {
							switch ($CREATE_NEW) {
								case 1:	$SELVALIDID = $SELVALIDID1;
									break;
								case 2:	$SELVALIDID = $SELVALIDID2;
									break;
								case 3:	$SELVALIDID = $SELVALIDID3;
									break;
							}
							$parameter =array(
								'dev_id'     		=> $this->global_f->dev_id(),
								'actionId'         	=> 'ups_ecash_payout/update_remitpayout_id3', 
								'ip_address'		=> $this->ip,
								'fname'				=> $BENEFNAME, 
								'mname'				=> $BENEMNAME,
								'lname'				=> $BENELNAME,
								'birthdate'			=> $BENEBDATE,
								'idnumber'			=> $NEWIDNUMBER,
								'idtype'			=> $NEWIDTYPE,
								'expiry'			=> $NEWEXPIRYDATE,
								'regcode'           => $this->user['R'],
								'sftp_path'         => '/v1-sftp/remittance/'.$filename,
								'id'				=> $SELVALIDID,
								'transtype'         => $TRANSTYPE,
								$this->user['SKT']  => md5($this->user['R'].$this->user['SKT'])
							); 
						} else {
							$parameter = array (
								'dev_id'     		=> $this->global_f->dev_id(),
								'actionId'         	=> 'ups_ecash_payout/create_remitpayout_id3',
								'ip_address'		=> $this->ip,
								'fname'				=> $BENEFNAME, 
								'mname'				=> $BENEMNAME,
								'lname'				=> $BENELNAME,
								'birthdate'			=> $BENEBDATE,
								'idnumber'			=> $NEWIDNUMBER,
								'idtype'			=> $NEWIDTYPE,
								'expiry'			=> $NEWEXPIRYDATE,
								'sftp_path'         => '/v1-sftp/remittance/'.$filename,
								'regcode'           => $this->user['R'],
								'transtype'         => $TRANSTYPE,
								$this->user['SKT']  => md5($this->user['R'].$this->user['SKT'])
							); 
						}
					}

					
					
					$result = $this->curl->call($parameter,url);
					$result = json_decode($result);
					echo json_encode($result);
					
					// $result = array("S"=>0,'M'=>"Successfully Upload but there an API Error, Please try again later");
					// echo json_encode($result);
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

	public function remittance_search_sec_bank()
	{
		$url = "https://mobileapi.unified.ph/ups_ecash_service/remittance_search_sec_bank";
		$parameter =array(
			'dev_id'    	    => $this->global_f->dev_id(),
			'ip_address'		=> $this->ip,
			'lbeneficiary' 		=> $this->input->post('lbeneficiary'),
			'lsender' 			=> $this->input->post('lsender'),
			'actionId' 	 		=> 'ups_ecash_service/remittance_search_sec_bank',
			'regcode'   		=> $this->user['R'],
			'trackno'			=> $this->input->post('trackno'),
			$this->user['SKT']	=> md5($this->user['R'].$this->user['SKT'])
		);

		$result = $this->curl->call($parameter,$url);
		$response= json_decode($result,true);		
		echo json_encode($response);
	}

	public function fetch_available_ids_post()
	{
		$FIRSTNAME	= $this->input->post('fname');
		$LASTNAME 	= $this->input->post('lname');
		$MIDDLENAME = $this->input->post('mname');
		$BIRTHDATE 	= $this->input->post('birthdate');

		$url = "https://mobileapi.unified.ph/ups_ecash_service/fetch_available_ids";

		$parameter =array(
			'dev_id'    	    => $this->global_f->dev_id(),
			'ip_address'		=> $this->ip,
			'fname' 			=> $FIRSTNAME,
			'lname' 			=> $LASTNAME,
			'mname' 			=> $MIDDLENAME,
			'birthdate' 		=> $BIRTHDATE,
			'actionId' 	 		=> 'ups_ecash_service/remittance_search_sec_bank',
			'regcode'   		=> $this->user['R'],
			'trackno'			=> $this->input->post('trackno'),
			$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'])
		);

		$result = $this->curl->call($parameter,$url);
		$response = json_decode($result,true);
		echo json_encode($response);
	}

	public function remittance_send_sec_bank()
	{
		$TRANSPASS = $this->input->post('transpass');
		$ACCTNO = $this->input->post('accountno');
		$IP = $this->input->post('ip');
		$BANKID = $this->input->post('code');
		$BANKTYPE = $this->input->post('bank');
		$BENEFICIARY_NAME = $this->input->post('bene_name');
		$AMOUNT = $this->input->post('amount');

		$url = url;
		$parameter =array(
			'dev_id'	 => $this->global_f->dev_id(),
			'ip_address' => $this->ip,
			'transpass'  => $TRANSPASS,
			'accountno'  => $ACCTNO,
			'bank_id' 	 => $BANKID,
			'bank_type'  => $BANKTYPE,
			'bene_name'  => $BENEFICIARY_NAME,
			'amount' 	 => $AMOUNT,
			'actionId'	 => 'ups_ecash_service/remittance_send_sec_bank',
			'regcode'	 => $this->user['R'],
			$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'].md5($TRANSPASS))
		);

			
		$result = $this->curl->call($parameter,$url);
		$response = json_decode($result,true);
		echo json_encode($response);
	}

	public function fetch_secbank_id_types()
	{
		$url = url;
		$parameter = array(
			'dev_id'    	    => $this->global_f->dev_id(),
			'ip_address'		=> $this->ip,
			'actionId' 	 		=> 'ups_ecash_service/fetch_secbank_id_types',
			'regcode'   		=> $this->user['R'],
			$this->user['SKT']	=> md5($this->user['R'].$this->user['SKT'])
		);

		$result = $this->curl->call($parameter,$url);
		$response = json_decode($result,true);	
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

					if (false) {
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

					} else {//sftp
						$curl = curl_init();
						$localfile = $url;

						curl_setopt_array($curl, array(
							CURLOPT_URL => 'https://unified.ph/kyc-upload',
							CURLOPT_RETURNTRANSFER => true,
							CURLOPT_ENCODING => '',
							CURLOPT_MAXREDIRS => 10,
							CURLOPT_TIMEOUT => 0,
							CURLOPT_FOLLOWLOCATION => true,
							CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							CURLOPT_CUSTOMREQUEST => 'POST',
							CURLOPT_POSTFIELDS => array('file'=> new CURLFILE($localfile),'file_location' => 'remittance','regcode' => $this->user['R'],'email' => '123','ext_name' => '.jpg'),
						));
						
						$response = curl_exec($curl); 
						curl_close($curl);
						$upload_response = json_decode($response,true);
						
						$filename = $upload_response['F'];

						$data['user'] = $this->user;

						$sftp_dir = '/v1-sftp/remittance/'.$filename;

						if ($upload_response['S'] == 1) {
							if($CREATE_NEW == 'ADD')
							{
								$parameter =array(
									'dev_id'     		=> $this->global_f->dev_id(),
									'actionId'         	=> 'ups_ecash_service/create_remitpayout_id3', 
									'ip_address'		=> $this->ip,
									'fname'				=> $SENDERFNAME, 
									'mname'				=> $SENDERMNAME,
									'lname'				=> $SENDERLNAME,
									'birthdate'			=> $SENDERBDATE,
									'idnumber'			=> $NEWIDNUMBER,
									'idtype'			=> $NEWIDTYPE,
									'expiry'			=> $NEWEXPIRYDATE,
									'sftp_dir'			=> $sftp_dir,
									'regcode'           => $this->user['R'],
									'transtype'         => $TYPE,
									$this->user['SKT']  => md5($this->user['R'].$this->user['SKT'])
								); 
							} else {
								$parameter =array(
									'dev_id'     		=> $this->global_f->dev_id(),
									'actionId'         	=> 'ups_ecash_service/update_remitpayout_id2', 
									'ip_address'		=> $this->ip,
									'fname'				=> $SENDERFNAME, 
									'mname'				=> $SENDERMNAME,
									'lname'				=> $SENDERLNAME,
									'birthdate'			=> $SENDERBDATE,
									'idnumber'			=> $NEWIDNUMBER,
									'idtype'			=> $NEWIDTYPE,
									'expiry'			=> $NEWEXPIRYDATE,
									'sftp_dir'			=> $sftp_dir,
									'regcode'           => $this->user['R'],
									'id'				=> $SELVALIDID1,
									'transtype'         => $TYPE,
									$this->user['SKT']  => md5($this->user['R'].$this->user['SKT'])
								); 
							}

							$result = $this->curl->call($parameter,url);
							$result = json_decode($result);
							echo json_encode($result);

						} else {// unsuccessful upload 
							echo json_encode($upload_response);
						}
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
  
  public function remittance_send_sec_bank_confirm()
  {
		$TRANSPASS		  = $this->input->post('trPass');
		$ACCTNO			  = $this->input->post('secbankAccntNo');
		$TN				  = $this->input->post('TN');
		$BANKID			  = $this->input->post('bank_id');
		$BENEFICIARY_NAME = $this->input->post('benesName');
		$AMOUNT			  = $this->input->post('amount');
		$TRANSNO		  = $this->input->post('transno');
		$SENDER_ID		  = $this->input->post('scard');
		$SENDER_NAME	  = explode("|",$this->input->post('sbname'));
		$SENDER_FNAME	  = $SENDER_NAME[1];
		$SENDER_MNAME	  = $SENDER_NAME[2];
		$SENDER_LNAME	  = $SENDER_NAME[3];
		$SENDER_BDAY	  = $this->input->post('senderBday');

		$SENDER_ID		    = $this->input->post('scard');
		$SENDER_ADDRESS	    = $this->input->post('senderAddress');
		$SENDER_NUMBER	    = $this->input->post('senderNumber');
		$SENDER_BPLACE	    = $this->input->post('senderBplace');
		$SENDER_NATIONALITY = $this->input->post('senderNationality');
		$SENDER_WORK		= $this->input->post('senderNow');
		$SENDERNUMBER		= $this->input->post('senderNumber');
		$SOURCEOFFUND		= $this->input->post('senderSof');

		$BENEFICIARY_ID = $this->input->post('bcard');
		$BENE_NAME	  	= explode("|",$this->input->post('bbname'));
		$BENE_FNAME	  	= $BENE_NAME[1];
		$BENE_MNAME	  	= $BENE_NAME[2];
		$BENE_LNAME	  	= $BENE_NAME[3];
		$BENE_BDAY	  	= $this->input->post('beneBday');

		$ID1		= $this->input->post('id_detailnumber1');
		$ID2		= $this->input->post('id_detailnumber2');
		$IDTYPE1	= $this->input->post('id_secbank_type');
		$IDTYPE2	= $this->input->post('id_secbank_type2');
		$idCategory = $this->input->post('id_detail');
		$COUNTRY	= $this->input->post('country');

		$url = url;
		
		$parameter = array(
			'dev_id'		  => $this->global_f->dev_id(),
			'ip_address'	  => $this->ip,
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
			'senderContactDetails'  => $SENDER_NUMBER,
			'sender_birthplace' 	=> $SENDER_BPLACE,
			'sender_nationality' 	=> $SENDER_NATIONALITY,
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
			'actionId'		  => 'ups_ecash_service/remittance_send_sec_bank_confirm',
			'regcode'		  => $this->user['R'],
			$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'].md5($TRANSPASS))
		);

			
		$result = $this->curl->call($parameter,$url);
		$response= json_decode($result,true);	
		echo json_encode($response);
	}

	// added by rene For Paymaya
	public function ecash_to_paymaya()
	{
		$this->load->library('form_validation'); 
		$this->form_validation->set_rules("inputPaymayaSenderName","Sender", 'trim|required|valid_email|text'); 
		$this->form_validation->set_rules("inputPaymayaBeneficiaryName","Beneficiary", 'trim|required|valid_email|text'); 
		if ($this->user['A_CTRL']['remittance'] == 1) {

			$data['menu'] = 2;
			$data['parent'] = 'REMITTANCE';
			
			if ($this->user['S'] == 1 && $this->user['R'] !="") {
				$data['test'] = $this->testBSP();
				$data['user'] = $this->user;
				$data['details']['process'] = 0;
				$regcode = $this->user['R'];
				$data['result'] = 3;
				$data['row'] = [];
				$data['message'] = "";
				
				if (isset($_POST['btnSsearch']) || isset($_POST['btnBsearch'])) {
				
					//Search Sender || Beneficiary
					$data['type']['typeid'] = 1;
					$data['type']['typedesc'] = "Sender";
					$data['result'] = 1;
					$option = isset($_POST['btnSsearch']) ? 1:0;
					$search = $this->input->post('inputSearch');
					$results = $this->searchPaymaya($search, $regcode, $option);
					
					if ($results['result']) {
						$data['row'] = $results['data'];
						$data['result'] = 1;
					} else {
						$data['message'] = "No ";
					}

					if (isset($_POST['btnBsearch'])) {
						$senderinfo = explode("|", $this->input->post('inputSenderHide'));
						$data['type']['typeid'] = 2;
						$data['type']['typedesc'] = "Benificiary";
						$data['type']['inputSenderName'] = $senderinfo[1];
						$data['type']['inputSender'] =  $this->input->post('inputSenderHide');
					}

				} elseif(isset($_POST['btnAddDetails']) || isset($_POST['btnAddBenefDetails'])) {
					// Add Sender || Beneficiary
					
					$details = $this->input->post(null, true);
					if (isset($_POST['btnAddDetails'])) {
						
						$results = $this->createPaymayaSender($details);
						
					} else {
						$results = $this->createPaymayaBeneficiary($details);
					}

					$array_msg = array('S'=>$results['S'],'M'=>$results['M']);

					$this->session->set_flashdata('msgAdd', $array_msg);

					redirect($_SERVER['REQUEST_URI']);	
					
				} elseif (isset($_POST['btnPaymayaUnhold'])) {
					ini_set('max_execution_time', 300); //300 seconds = 5 minutes
					// unhold
					$arrMessage['S'] = 0;
					$arrMessage['M'] = "";
					$arrMessage['TN'] = "";
					$arrMessage['URL'] = "";

					$details =$this->input->post(null, true);
					$unholdResponse = $this->unHoldRemittance($details['inputReferenceNo'], $details['inputVericode']);
					$arrMessage['response'] = $unholdResponse;
				//   print_r($unholdResponse);exit();
					if ($unholdResponse) { 
						$arrMessage['S'] = 0;
						$arrMessage['M'] = "";
						$arrMessage['TN'] = $details['inputReferenceNo'];

						if (trim($unholdResponse['status']) == "APPROVED") {
							$arrMessage['S'] = 1;
							$arrMessage['URL'] = 'https://mobilereports.globalpinoyremittance.com/portal/ecash_to_paymaya_receipt/'.$details['inputReferenceNo'];
						} elseif($unholdResponse['status'] == "REMITAGAIN" || $unholdResponse['status'] == "RECREATE") {
							$arrMessage['S'] = 3;
							$arrMessage['M'] = $unholdResponse['M'];
						} else {
							if ($unholdResponse['status'] == "FAILED") {
								$arrMessage['status'] = 0;
								if ($unholdResponse['remarks'] == "Generic catch all error") {
									$arrMessage['message'] = "Failed. Error on remittance occur.";
								}
							}
							$arrMessage['M'] = $unholdResponse['M'];
						}

						$this->session->set_flashdata('msg', $arrMessage);
						redirect("/ecash_send/paymaya_checkrefno");
						// exit;
					} else {
						$arrMessage['M'] = $unholdResponse['remarks'];
						$data['details']['process'] = 2;
					}

					$this->session->set_flashdata('msg', $arrMessage);
					// redirect($_SERVER['REQUEST_URI']);
				}
				
				$data['airports'] = json_decode($this->curl->call('',url_mobilereports.'/intl_airports2'),true);
				$this->load->view('layout/header', $data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');

				if($data['test']['testing'] == 'BSP'){
					$this->load->view('remittance/ecash_send/ecash_to_paymaya_topup');
				}else{
					$this->load->view('hotels/hotelundermaintenance');
				}
				
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');
			}else {
				$this->session->sess_destroy();
				redirect('Login/');
			}
		} else {
			redirect('Main/');
		}
	}

	function graphQLAPI($query, $variables, $operationName)
	{ 
		$url = "http://10.148.0.13:8005/graphql";
		// $url = "http://35.213.128.128:8005/graphql";
		// $url = "http://10.9.10.18:8005/graphql";
		$parameters["query"] = $query;
		$parameters["variables"] = $variables;
		$parameters["operationName"] = $operationName;
		$results = $this->curl->call_custom($parameters, $url, "POST");
		
		return $results; 
	}

	function ajaxSearchPaymaya()
	{
		$return['status'] = 0;
		$return['message'] = "An error has occur. Please try again.";

		$input =$this->input->post(null,true);
		$response = $this->searchPaymaya($input['search'], $this->user['R'], $input['option']);
			
		if ($input['option'] == 2) {
			if (isset($response["data"])) {
				$data = $response['data'];
				$return['message'] = $data['remarks'];
				if ($data['status'] == "FAILED") {
					$return['status'] = 5;
					if ($data['remarks'] == "Generic catch all error") {
						$return['message'] = "Failed. Error on remittance occur.";
					}
				} elseif ($data['status'] == "OTP") {
					$return['status'] = 2;
					$return['message'] = "Transaction on hold. Please enter verification code to proceed this transaction";
				} elseif ($data['status'] == "APPROVED") {
					$return['status'] = 1;
				}elseif($data['status'] == "FAILED (M)") {
						$return['status'] = 3;
				}elseif($data['status'] == "SUCCESSFUL (M)") {
						$return['status'] = 1;
				}elseif($data['status'] == "ERROR") {
					$return['status'] = 3;
				}elseif($data['status'] == "PENDING") {
						$return['status'] = 3;
						$return['message'] = $data['remarks'];
					}elseif($data['status'] == '0') { 
						$return['status'] = 3;
						$return['message'] =  $data['remarks'];
					}elseif($data['status'] == 'FRAUD') {
						$return['status'] = 9;
						$return['message'] =  $data['remarks'];
					} else { 
					$return['status'] = 0;
					$return['message'] = "Internal server error. Please try again!";
				}
			}
		} 

		if (count($response['data']) == 0) {
			$return['status'] = 3;
			$return['message'] = "Transaction not found!";
		}
		echo json_encode($return);
	}

	function ajaxUnholdRemittance()
  	{
		$return['S'] = 0;
		$return['M'] = "An error has occur. Please try again.";

		$input =$this->input->post(null,true);
		$response = $this->unHoldRemittance($input['trackingNumber'], $input['verificationCode']);
		
		$return['M'] = $response['M'];
		$return['response'] = $response;
		
		if ($response['status']) {
			if (trim($response['status']) == "APPROVED") {
				$return['S'] = 1;	
				$return['TN'] = $input['trackingNumber'];
			}
		}   
		echo json_encode($return);
	}
	function createPaymayaSender($param)
  	{
		$return['S'] = 0;
		$return['M'] = "Error occur on creating Sender. Please try again";
		$senderDetails = [];
		$data = [];

		if ($data[0]->exist > 0) {
			$return['S'] = 0;
			$return['M'] = "Sender Already Registered"; 
		} else { 
			unset($param['btnAddDetails']);
			$senderDetails = $param;
			
			if ($param['checkPA']) {
				$senderDetails['senderAddress']['presentAddress'] = $senderDetails['senderAddress']['permanentAddress'];
			}
			
			$senderDetails['regcode'] = $this->user['R'];
			$query = "mutation createSmartpaymayaCustomerSender {
				smartpaymayaCustomerSender (
					values: ".preg_replace('/"([a-zA-Z_]+[a-zA-Z0-9_]*)":/','$1:', json_encode($senderDetails))."
				) {
					customerId
					registeredBy
					firstName
					middleName
					lastName
					mobileNumber
					birthDate
					nationality
					placeOfBirth
					sourceOfIncome
					occupation
					presentAddressId
					permanentAddressId
					createdAt
					updatedAt
				}
			}";
			
			$operationName = "createSmartpaymayaCustomerSender";
			$response = json_decode($this->graphQLAPI($query, null, $operationName), true);
			// echo "<pre>";
			// print_r($response);
	
			if (isset($response["errors"])) {
				$return['S'] = 0;
			} elseif(isset($response['data'])) {
				$response = $response['data']['smartpaymayaCustomerSender'];
				if ($response['customerId'] != null) {
					$return['S'] = 1;
					$return['M'] = "Successfully register customer information!";
				}
			}
		}
			

		return $return;
	}
	
	function createPaymayaBeneficiary($param)
	{
		$return['S'] = 0;
		$return['M'] = "Error occur on creating Beneficiary. Please try again";
		$data = [];

		if ($data[0]->exist > 0) {
			$return['S'] = 0;
			$return['M'] = "Beneficiary Already Registered"; 
		} else {
			$beneficiaryDetails = [];

			unset($param['btnAddBenefDetails']);
			$beneficiaryDetails = $param;
			$beneficiaryDetails['regcode'] = $this->user['R'];
			
			$query = "mutation createBeneficiary {
				smartpaymayaCustomerBeneficiary (
					values: ".preg_replace('/"([a-zA-Z_]+[a-zA-Z0-9_]*)":/','$1:', json_encode($beneficiaryDetails))."
				) {
					beneficiaryId
					firstName
					middleName
					lastName
					mobileNo
				}
			}";
	
			$operationName = "createBeneficiary";
			$response = json_decode($this->graphQLAPI($query, null, $operationName), true);

			if (isset($response["errors"])) {
				$return['S'] = 0;
			} elseif(isset($response['data'])) {
				$response = $response['data']['smartpaymayaCustomerBeneficiary'];
				if ($response['beneficiaryId'] != null) {
					$return['S'] = 1;
					$return['M'] = "Successfully register customer information!";
				}
			}
		}
	
		return $return;
	}

	function searchPaymaya($search, $regcode, $option)
  	{
		ini_set('max_execution_time', 300); //300 seconds = 5 minutes
		$query = "";
		$return['result'] = true;
		$return['data'] = [];

		$where = "";
		$row = "";
		$operationName = "searchSmartpaymaya";
		$table = "smartpaymaya";

		if ($option == 0 || $option == 1) {
			$where = "where:{ regcode:\"".$regcode."\", name:\"".$search."\" }";
			$row = "rows{firstName,middleName,lastName";
		}

		// BENEFICIARY
		if ($option == 0) {
			$operationName .= "Beneficiary";
			$table .= "CustomerBeneficiaries";	
			$row .= ",beneficiaryId";
		} elseif($option == 1) {
			// SENDER
			$operationName .= "Sender";
			$table .= "CustomerSenders";	
			$row .= ",birthDate,mobileNumber,occupation, customerId";
		} elseif ($option == 2) {
			// PAYMAYA
			$where = "where:{process:\"search\",trackingNumber:".$search.", regcode:\"".$regcode."\"}";
			$operationName .= "Log";
			$table .= "Log";	
			$row .= "status, remarks, trackingNumber";
		}
		
		if ($option <= 1) {
			$row .= "}}";
		} else {
			$row .="}";
		}

		$query = 'query '.$operationName.'{'.$table.'(options:{'.$where.'}){'.$row.'}';
			
		$response = json_decode($this->graphQLAPI($query, null, $operationName), true);
		
		if ($response['S']) {
			$return['result'] = false;
		}
		if (isset($response['errors'])) {
			$return['result'] = false;
		} else{	
			// if (count($response['data'][$table]['rows']) && ($option == 0 || $option == 1)) {
			if (($option == 0 || $option == 1)) {
				$return['data'] = $response['data'][$table]['rows'];
			} else {
				$return['data'] = $response['data'][$table];
			}
		} 
		
		// print_r($return);
		return $return;	
	}

	function unHoldRemittance($trackingNumber, $verificationCode = null)
	{
		$return['results'] = 1;
		$return['M'] = "";
		$return['TN'] = $trackingNumber;
		$return['url'] = "";

		$operationName = "smartPaymayaUnHold";
		$query = "query ".$operationName." {";
		$query .= "smartpaymayaLog(";
		$query .= "options:{";
		$query .= "where:{";
		$query .= "regcode:\"{$this->user['R']}\", ";
		// $query .= "process:\"unhold\", ";
		$query .= "process:\"verify_otp\", "; 
		$query .= "trackingNumber:\"{$trackingNumber}\", ";
		$query .= $verificationCode == null ? "":"verificationCode:\"".trim($verificationCode)."\", ";
		$query .= "ipAddress:\"{$this->ip}\"";
		$query .= "}}){status,remarks}}";

		$response = json_decode($this->graphQLAPI($query, null, $operationName), true);
		
		$return['status'] = trim($response['data']['smartpaymayaLog']['status']);
		$return['M'] = $response['data']['smartpaymayaLog']['remarks'];
		$return['response'] = $response;

			
		if (trim($response['data']['smartpaymayaLog']['status']) == "APPROVED") {
			$return['url'] = "http://www.mobilereports.io/portal/ecash_to_paymaya_receipt/{$trackingNumber}";
		}else {
			$return['S'] = 0;
		} 

		return $return;
	}

	function ecash_to_paymaya_send() 
	{
		//   ini_set('max_execution_time', 500); //500 seconds = 5 minutes
		$return['S'] = 0;
		$return['M'] = "";
		$return['TN'] = "";
		
		$postData = $this->input->post(null, true);

		$query = " mutation createRemittance{$postData['channel']} ";
		$query .= '{ smartpaymayaLog ( values: {';
		$query .= 'sender:"'.$postData['sender'].'",';
		$query .= 'beneficiary:"'.$postData['beneficiary'].'",';
		$query .= 'senderId:'.preg_replace('/"([a-zA-Z_]+[a-zA-Z0-9_]*)":/','$1:',json_encode($postData['senderId'])).',';
		$query .= 'regcode:"'.$this->user['R'].'",';
		$query .= 'accountNumber:"'.$postData['accountNo'].'",';
		$query .= 'channel:"'.$postData['channel'].'",';
		$query .= 'totalAmount:"'.$postData['amount'].'",';
		// $query .= 'charge:"'.$postData['charge'].'",';
		$query .= 'transactionPassword:"'.$postData['transpass'].'",';
		$query .= 'ipAddress:"'.$this->ip.'"';
		$query .= '}) {status,remarks,referenceNumber, trackingNumber}}';
		
		$operationName = "createRemittance{$postData['channel']}";
		$response = json_decode($this->graphQLAPI($query, null, $operationName), true);
		
		console.log("RESPONSE FROM CREATE REMITTANCE");
		$return['response'] = $response;
		if (isset($response['errors'])) {
			$return['S'] = 0;
			$return['M'] = "Error occurr please try again later";
		} elseif (isset($response["data"]["smartpaymayaLog"]["status"])){
			$response = $response["data"]["smartpaymayaLog"];
			if ($response['status'] == "POSTED") {
				$return['S'] = 1;
				$return['M'] = $response['remarks'];
				$return['TN'] = $response['trackingNumber'];
			} elseif($response['status'] == "OTP"){
				if ($response['trackingNumber'] == '') {
					$return['S'] = 5;
					$return['M'] = $response['remarks'];
					$return['TN'] = '';
				} else { 
					$return['S'] = 3;
					$return['M'] = $response['remarks'];
					$return['TN'] = $response['trackingNumber'];
				}
			} elseif($response['status'] == "APPROVED") {
				$return['S'] = 1;
				$return['M'] = $response['remarks'];
				// $return['TN'] = $response['trackingNumber'];
			} elseif ($response['status'] == "REMITAGAIN") {
				$return['S'] = 2;
				$return['M'] = "An error occur. Please try again";
				$return['TN'] = $response['trackingNumber'];
			} elseif($response['status'] == 0 && $response['status'] != "FAILED") {
				$return['M'] = $response['remarks'];
			} elseif($response['status'] == 5) {
				$return['S'] = 5;
				$return['M'] = $response['remarks'];
			} elseif($response['status'] == "FAILED"){
				$return['S'] = 5;
				$return['M'] = $response['remarks'];
			}else{
				$return['M'] = $response['remarks']; 
			}
		}
			
		echo json_encode($return);
	}
	
	function ecash_topup_ecpay($services='') //TEST
	{
		if ($this->user['A_CTRL']['remittance'] == 1)
		{
			if ($this->user['S'] == 1 && $this->user['R'] !="")
			{
				$data = array('menu' => 2, 'parent'=> 'REMITTANCE');
				$data['user'] = $this->user;
				$data['eccash_service'] = $services;
	
				$this->load->view('layout/header', $data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_send/ecash_topup_ecpay');
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');
			}
			else
			{
				$this->session->sess_destroy();
				redirect('Login/');
			}
		}
		else
		{
			redirect('Main/');
		}
	}

	

	function ecpay_transac()
	{
		$url = url;

		$parameter = array(
			'actionId'	 	=> 'ups_ecash_ecpay/transact_eccash',
			'dev_id'	 	=> $this->global_f->dev_id(),
			'regcode'	 	=> $this->user['R'],
			'ip_address'	=> $this->ip,
			'transpass'	 	=> $this->input->post('trans_pass'),
			'service'	 	=> $this->input->post('service'),
			'first_field'  	=> $this->input->post('first_field'),
			'second_field' 	=> $this->input->post('second_field'),
			'amount'	   	=> $this->input->post('amount'),
			$this->user['SKT'] => md5($this->user['R'] . $this->user['SKT'] . md5($this->input->post('trans_pass')))
		); 

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}

	function ecpay_transacNew()
	{
		$url = url;

		$parameter =array(
			'actionId' 		=> 'ups_ecash_ecpay/transact_eccashNew',
			'dev_id' 		=> $this->global_f->dev_id(),
			'regcode' 		=> $this->user['R'],
			'ip_address' 	=> $this->ip,
			'transpass' 	=> $this->input->post('trans_pass'),
			'service' 		=> $this->input->post('service'),
			'first_field' 	=> $this->input->post('first_field'),
			'second_field' 	=> $this->input->post('second_field'),
			'amount'		=> $this->input->post('amount'),
			$this->user['SKT'] => md5($this->user['R'] . $this->user['SKT'] . md5($this->input->post('trans_pass')))
		); 

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}
	

	function ecpay_eccash_get_charges()
	{
		$url = url;

		$parameter = array(
			'actionId' 	 => 'ups_ecash_ecpay/eccash_get_charges',
			'dev_id' 	 => $this->global_f->dev_id(),
			'regcode' 	 => $this->user['R'],
			'ip_address' => $this->ip,
			'service' 	 => $this->input->post('service'),
			'amount'	 => $this->input->post('amount')
		); 

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}

	function cashin_topup()
	{
		if ($this->user['A_CTRL']['remittance'] == 1)
		{
			if ($this->user['S'] == 1 && $this->user['R'] !="")
			{
				$data = array('menu' => 2, 'parent'=> 'REMITTANCE');
				$data['user'] = $this->user;
				$data['eccash_service'] = $services;
	
				$this->load->view('layout/header', $data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_send/cashin_topup.php');
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');
			}
			else
			{
				$this->session->sess_destroy();
				redirect('Login/');
			}
		}
		else
		{
			redirect('Main/');
		}
	}

	
	function fetch_walletServices(){
		
		$url = url;

		$parameter =array(
			'actionId' 	 => 'ups_ecash_service/fetchEccashservices',
			'dev_id' 	 => $this->global_f->dev_id(),
			'regcode' 	 => $this->user['R'],
			'ip_address' => $this->ip
		); 

		$result = $this->curl->call($parameter, $url);
		
		$response = json_decode($result, true);
		echo json_encode($response);
	}

	function fetch_IDs(){
		
		$url = url;

		$parameter =array(
			'actionId' => _fetch_available_ids,
			'dev_id' => $this->global_f->dev_id(),
			'regcode' => $this->user['R'],
			'ip_address' => $this->ip
		); 

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}

	function selected_sender(){
		$senderID = $this->input->post('senderID');

		$url = url;

		$parameter =array(
			'actionId' 	 => 'ups_ecash_service/remittance_selected_sender_bsp',
			'dev_id' 	 => $this->global_f->dev_id(),
			'regcode'	 => $this->user['R'],
			'rowid' 	 => $senderID,
			'ip_address' => $this->ip
		); 

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}

	function search_benefeciary(){
		$senderID = $this->input->post('senderID');

		$url = url;

		$parameter =array(
			'actionId' 	 => 'ups_ecash_service/remittance_search_bene_bsp',
			'dev_id' 	 => $this->global_f->dev_id(),
			'regcode'	 => $this->user['R'],
			'sender_id'  => $senderID,
			'ip_address' => $this->ip
		); 
		
		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}
	
	function sendOTP(){
		$traceno = $this->input->post('traceno');

		$url = url;

		$parameter =array(
			'actionId' 	  => 'ups_ecash_service/checkRiskProfile',
			'dev_id' 	  => $this->global_f->dev_id(),
			'regcode'	  => $this->user['R'],
			'traceno'	  => $traceno,
			'ip_address'  => $this->ip
		);

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}

	function validateOTP(){
		$traceno = $this->input->post('traceno');
		$otp = $this->input->post('otp');

		$url = url;

		$parameter =array(
			'actionId' 	  => 'ups_ecash_service/otpValidate',
			'dev_id' 	  => $this->global_f->dev_id(),
			'regcode'	  => $this->user['R'],
			'traceno'	  => $traceno,
			'otp'	  	  => $otp,
			'ip_address'  => $this->ip
		);

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}
	
	function confirmTransaction(){
		$traceno = $this->input->post('traceno');
		$action = $this->input->post('action');
		$item_type = $this->input->post('item_type');
		$risklevel = $this->input->post('risklevel');
		$comment = $this->input->post('comment');
		
		$url = url;
			if($risklevel == "HIGH"){
				for($i = 1; $i <= 1; $i++){
					${'file'.$i} 			= $_FILES['fileHigh'.$i];
					${'file'.$i.'Name'} 	= ${'file'.$i}['name'];
					${'file'.$i.'Size'}		= ${'file'.$i}['size'];
					${'file'.$i.'Temp'}		= ${'file'.$i}['tmp_name'];
					${'file'.$i.'Error'} 	= ${'file'.$i}['error'];
				}
		
				if($file1Size < 2*MB) {
		
					for($a = 1; $a <= 1; $a++){
		
						${'url'.$a} = ${'file'.$a.'Temp'};
						if(${'file'.$a.'Size'} > 1*MB)
						{
							${'old_size'.$a} = ${'file'.$a.'Size'};
							${'urltmp'.$a}	 = sys_get_temp_dir().'/tmp.jpg';
							
							${'filename'.$a} = $this->compress_image(${'file'.$a.'Size'}, ${'urltmp'.$a}, 75);
							${'new_size'.$a} = filesize(${'urltmp'.$a});
						
							if(${'new_size'.$a} < ${'old_size'.$a})
							{
								${'url'.$a} = ${'urltmp'.$a};
							}
						}
						
						${'curl'.$a} = curl_init();
						${'localfile'.$a} = ${'url'.$a};
					}
		
					for($i = 1; $i <= 1; $i++){
						curl_setopt_array(${'curl'.$i}, array(
							CURLOPT_URL => 'https://unified.ph/kyc-upload',
							CURLOPT_RETURNTRANSFER => true,
							CURLOPT_ENCODING => '',
							CURLOPT_MAXREDIRS => 10,
							CURLOPT_TIMEOUT => 0,
							CURLOPT_FOLLOWLOCATION => true,
							CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							CURLOPT_CUSTOMREQUEST => 'POST',
							CURLOPT_POSTFIELDS => array('file'=> new CURLFILE(${'localfile'.$i}),'file_location' => 'kyc-remittance','regcode' => $this->user['R'],'email' => '123','ext_name' => '.jpg'),
						));
						
						${'response'.$i} = curl_exec(${'curl'.$i}); 
						curl_close(${'curl'.$i});
						${'upload_response'.$i} = json_decode(${'response'.$i},true);
					}
					
					$id1 = $upload_response1['F'];
		
					if($id1){
						$id1 = "/v1-sftp/kyc-remittance/OTP_".$upload_response1['F'];
					}else{
						echo "UPLOADING IMAGE FAILED"; die();
					}
		
				}else{
					echo "FILE SIZE TOO BIG MUST BE LESS THAN 2MB"; die();
				}
			}
			
			
			$parameter =array(
				'actionId' 	 => 'ups_ecash_service/remittance_send_ecash_padala_bsp_confirm',
				'dev_id' 	 => $this->global_f->dev_id(),
				'regcode'	 => $this->user['R'],
				'traceno' 	 => $traceno,
				'action' 	 => $action,
				'item_type'	 => $item_type,
				'photolink'  => $id1,
				'comment'  	 => $comment,
				'ip_address' => $this->ip
			); 
	
			$result = $this->curl->call($parameter, $url);
			$response = json_decode($result, true);
			echo json_encode($response);
		
		
	}
	function confirmTransactionCTB(){
		$traceno = $this->input->post('traceno');
		$action = $this->input->post('action');
		$item_type = $this->input->post('item_type');
		$risklevel = $this->input->post('risklevel');
		$comment = $this->input->post('comment');
		
		$url = url;
			if($risklevel == "HIGH"){
				for($i = 1; $i <= 1; $i++){
					${'file'.$i} 			= $_FILES['fileHigh'.$i];
					${'file'.$i.'Name'} 	= ${'file'.$i}['name'];
					${'file'.$i.'Size'}		= ${'file'.$i}['size'];
					${'file'.$i.'Temp'}		= ${'file'.$i}['tmp_name'];
					${'file'.$i.'Error'} 	= ${'file'.$i}['error'];
				}
		
				if($file1Size < 2*MB) {
		
					for($a = 1; $a <= 1; $a++){
		
						${'url'.$a} = ${'file'.$a.'Temp'};
						if(${'file'.$a.'Size'} > 1*MB)
						{
							${'old_size'.$a} = ${'file'.$a.'Size'};
							${'urltmp'.$a}	 = sys_get_temp_dir().'/tmp.jpg';
							
							${'filename'.$a} = $this->compress_image(${'file'.$a.'Size'}, ${'urltmp'.$a}, 75);
							${'new_size'.$a} = filesize(${'urltmp'.$a});
						
							if(${'new_size'.$a} < ${'old_size'.$a})
							{
								${'url'.$a} = ${'urltmp'.$a};
							}
						}
						
						${'curl'.$a} = curl_init();
						${'localfile'.$a} = ${'url'.$a};
					}
		
					for($i = 1; $i <= 1; $i++){
						curl_setopt_array(${'curl'.$i}, array(
							CURLOPT_URL => 'https://unified.ph/kyc-upload',
							CURLOPT_RETURNTRANSFER => true,
							CURLOPT_ENCODING => '',
							CURLOPT_MAXREDIRS => 10,
							CURLOPT_TIMEOUT => 0,
							CURLOPT_FOLLOWLOCATION => true,
							CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							CURLOPT_CUSTOMREQUEST => 'POST',
							CURLOPT_POSTFIELDS => array('file'=> new CURLFILE(${'localfile'.$i}),'file_location' => 'kyc-remittance','regcode' => $this->user['R'],'email' => '123','ext_name' => '.jpg'),
						));
						
						${'response'.$i} = curl_exec(${'curl'.$i}); 
						curl_close(${'curl'.$i});
						${'upload_response'.$i} = json_decode(${'response'.$i},true);
					}
					
					$id1 = $upload_response1['F'];
		
					if($id1){
						$id1 = "/v1-sftp/kyc-remittance/OTP_".$upload_response1['F'];
					}else{
						echo "UPLOADING IMAGE FAILED"; die();
					}
		
				}else{
					echo "FILE SIZE TOO BIG MUST BE LESS THAN 2MB"; die();
				}
			}
			
			
			$parameter =array(
				'actionId' 	 => 'ups_ecash_service/remittance_send_credit_bank_bsp_confirm',
				'dev_id' 	 => $this->global_f->dev_id(),
				'regcode'	 => $this->user['R'],
				'traceno' 	 => $traceno,
				'action' 	 => $action,
				'item_type'	 => $item_type,
				'photolink'  => $id1,
				'comment'  	 => $comment,
				'ip_address' => $this->ip
			); 
	
			$result = $this->curl->call($parameter, $url);
			$response = json_decode($result, true);
			echo json_encode($response);
		
		
	}

	function confirmTransactionwallettopup(){
		$traceno = $this->input->post('traceno');
		$action = $this->input->post('action');
		$item_type = $this->input->post('item_type');
		$risklevel = $this->input->post('risklevel');
		$comment = $this->input->post('comment');
		
		$url = url;
			if($risklevel == "HIGH"){
				for($i = 1; $i <= 1; $i++){
					${'file'.$i} 			= $_FILES['fileHigh'.$i];
					${'file'.$i.'Name'} 	= ${'file'.$i}['name'];
					${'file'.$i.'Size'}		= ${'file'.$i}['size'];
					${'file'.$i.'Temp'}		= ${'file'.$i}['tmp_name'];
					${'file'.$i.'Error'} 	= ${'file'.$i}['error'];
				}
		
				if($file1Size < 2*MB) {
		
					for($a = 1; $a <= 1; $a++){
		
						${'url'.$a} = ${'file'.$a.'Temp'};
						if(${'file'.$a.'Size'} > 1*MB)
						{
							${'old_size'.$a} = ${'file'.$a.'Size'};
							${'urltmp'.$a}	 = sys_get_temp_dir().'/tmp.jpg';
							
							${'filename'.$a} = $this->compress_image(${'file'.$a.'Size'}, ${'urltmp'.$a}, 75);
							${'new_size'.$a} = filesize(${'urltmp'.$a});
						
							if(${'new_size'.$a} < ${'old_size'.$a})
							{
								${'url'.$a} = ${'urltmp'.$a};
							}
						}
						
						${'curl'.$a} = curl_init();
						${'localfile'.$a} = ${'url'.$a};
					}
		
					for($i = 1; $i <= 1; $i++){
						curl_setopt_array(${'curl'.$i}, array(
							CURLOPT_URL => 'https://unified.ph/kyc-upload',
							CURLOPT_RETURNTRANSFER => true,
							CURLOPT_ENCODING => '',
							CURLOPT_MAXREDIRS => 10,
							CURLOPT_TIMEOUT => 0,
							CURLOPT_FOLLOWLOCATION => true,
							CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							CURLOPT_CUSTOMREQUEST => 'POST',
							CURLOPT_POSTFIELDS => array('file'=> new CURLFILE(${'localfile'.$i}),'file_location' => 'kyc-remittance','regcode' => $this->user['R'],'email' => '123','ext_name' => '.jpg'),
						));
						
						${'response'.$i} = curl_exec(${'curl'.$i}); 
						curl_close(${'curl'.$i});
						${'upload_response'.$i} = json_decode(${'response'.$i},true);
					}
					
					$id1 = $upload_response1['F'];
		
					if($id1){
						$id1 = "/v1-sftp/kyc-remittance/OTP_".$upload_response1['F'];
					}else{
						echo "UPLOADING IMAGE FAILED"; die();
					}
		
				}else{
					echo "FILE SIZE TOO BIG MUST BE LESS THAN 2MB"; die();
				}
			}
			
			
			$parameter =array(
				'actionId' 	 => 'ups_ecash_service/remittance_send_credit_bank_bsp_confirm',
				'dev_id' 	 => $this->global_f->dev_id(),
				'regcode'	 => $this->user['R'],
				'traceno' 	 => $traceno,
				'action' 	 => $action,
				'item_type'	 => $item_type,
				'photolink'  => $id1,
				'comment'  	 => $comment,
				'ip_address' => $this->ip
			); 
	
			$result = $this->curl->call($parameter, $url);
			$response = json_decode($result, true);
			echo json_encode($response);
		
		
	}

	function rejectTransaction(){
		$traceno = $this->input->post('traceno');
		$action = $this->input->post('action');
		$item_type = $this->input->post('item_type');
		$photolink = $this->input->post('photolink');
		$comment = $this->input->post('comment');

		$url = url;

		$parameter =array(
			'actionId' 	 => 'ups_ecash_service/remittance_send_ecash_padala_bsp_confirm',
			'dev_id' 	 => $this->global_f->dev_id(),
			'regcode'	 => $this->user['R'],
			'traceno' 	 => $traceno,
			'action' 	 => $action,
			'item_type'	 => $item_type,
			'photolink'  => $photolink,
			'comment'  	 => $comment,
			'ip_address' => $this->ip
		); 

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}

	function ecashpadalaTransacBSP(){
		$traceno = $this->input->post('traceno');

		$url = url;

		$parameter =array(
			'actionId' 	 => 'ups_ecash_service/remittance_send_ecash_padala_bsp_transac',
			'dev_id' 	 => $this->global_f->dev_id(),
			'regcode'	 => $this->user['R'],
			'traceno' 	 => $traceno,
			'ip_address' => $this->ip,
			'ip' => $this->ip
		); 

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}

	function ecashwallettopupTransacBSP(){
		$traceno = $this->input->post('traceno');

		$url = url;

		$parameter =array(
			'actionId' 	 => 'ups_ecash_service/remittance_wallet_topup_bsp_transac',
			'dev_id' 	 => $this->global_f->dev_id(),
			'regcode'	 => $this->user['R'],
			'traceno' 	 => $traceno,
			'ip_address' => $this->ip,
			'ip' => $this->ip
		); 

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}

	function ecashtocebuanaTransacBSP(){
		$traceno = $this->input->post('traceno');

		$url = url;

		$parameter =array(
			'actionId' 	 => 'ups_cebuana_service_jorel/send_cebuana_remittance',
			'dev_id' 	 => $this->global_f->dev_id(),
			'regcode'	 => $this->user['R'],
			'traceno' 	 => $traceno,
			'ip_address' => $this->ip,
			'ip' => $this->ip
		); 

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}

	function rejectCTBTransactionBSP(){
		$traceno = $this->input->post('traceno');
		$action = $this->input->post('action');
		$item_type = $this->input->post('item_type');
		$photolink = $this->input->post('photolink');
		$comment = $this->input->post('comment');

		$url = url;

		$parameter =array(
			'actionId' 	 => 'ups_ecash_service/remittance_send_credit_bank_bsp_confirm',
			'dev_id' 	 => $this->global_f->dev_id(),
			'regcode'	 => $this->user['R'],
			'traceno' 	 => $traceno,
			'action' 	 => $action,
			'item_type'	 => $item_type,
			'photolink'  => $photolink,
			'comment'  	 => $comment,
			'ip_address' => $this->ip
		); 

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}

	function rejectwallettopupBSP(){
		$traceno = $this->input->post('traceno');
		$action = $this->input->post('action');
		$item_type = $this->input->post('item_type');
		$photolink = $this->input->post('photolink');
		$comment = $this->input->post('comment');

		$url = url;

		$parameter =array(
			'actionId' 	 => 'ups_ecash_service/remittance_wallet_topup_bsp_confirm',
			'dev_id' 	 => $this->global_f->dev_id(),
			'regcode'	 => $this->user['R'],
			'traceno' 	 => $traceno,
			'action' 	 => $action,
			'item_type'	 => $item_type,
			'photolink'  => $photolink,
			'comment'  	 => $comment,
			'ip_address' => $this->ip
		); 

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}

	function credittobankTransacBSP(){
		$traceno = $this->input->post('traceno');

		$url = url;

		$parameter =array(
			'actionId' 	 => 'ups_ecash_service/remittance_send_credit_bank_bsp_transac',
			'dev_id' 	 => $this->global_f->dev_id(),
			'regcode'	 => $this->user['R'],
			'traceno' 	 => $traceno,
			'ip_address' => $this->ip,
			'ip' => $this->ip
		); 

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}

	function fetch_transactionDetails(){
		$traceno = $this->input->post('traceno');
		
		$url = url;
		
		$parameter =array(
			'actionId' 	 => 'ups_ecash_service/fetch_traceno_details',
			'dev_id' 	 => $this->global_f->dev_id(),
			'regcode'	 => $this->user['R'],
			'traceno'	 => $traceno,
			'ip_address' => $this->ip
		);

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}

	function notify_sender_receiver(){
		$traceno = $this->input->post('traceno');
		$refno = $this->input->post('refno');
		$type = $this->input->post('type');
		
		$url = url;
		
		$parameter =array(
			'actionId' 	 => 'ups_ecash_service/notifySenderReceiver',
			'dev_id' 	 => $this->global_f->dev_id(),
			'regcode'	 => $this->user['R'],
			'traceno'	 => $traceno,
			'refno'	  	 => $refno,
			'type'	  	 => $type,
			'ip_address' => $this->ip
		);

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}

	function addSenderHub() {
		$INPUT_POST =$this->input->post(null,true);

		$T_VALUE =md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));
		$url = url;

		for($i = 1; $i <= 2; $i++){
			${'file'.$i} 			= $_FILES['file'.$i];
			${'file'.$i.'Name'} 	= ${'file'.$i}['name'];
			${'file'.$i.'Size'}		= ${'file'.$i}['size'];
			${'file'.$i.'Temp'}		= ${'file'.$i}['tmp_name'];
			${'file'.$i.'Error'} 	= ${'file'.$i}['error'];
		}

		if($file1Size < 2*MB || $file2Size < 2*MB) {

			for($a = 1; $a <= 2; $a++){

				${'url'.$a} = ${'file'.$a.'Temp'};
				if(${'file'.$a.'Size'} > 1*MB)
				{
					${'old_size'.$a} = ${'file'.$a.'Size'};
					${'urltmp'.$a}	 = sys_get_temp_dir().'/tmp.jpg';
					
					${'filename'.$a} = $this->compress_image(${'file'.$a.'Size'}, ${'urltmp'.$a}, 75);
					${'new_size'.$a} = filesize(${'urltmp'.$a});
				
					if(${'new_size'.$a} < ${'old_size'.$a})
					{
						${'url'.$a} = ${'urltmp'.$a};
					}
				}
				
				${'curl'.$a} = curl_init();
				${'localfile'.$a} = ${'url'.$a};
			}

			for($i = 1; $i <= 2; $i++){
				curl_setopt_array(${'curl'.$i}, array(
					CURLOPT_URL => 'https://unified.ph/kyc-upload',
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'POST',
					CURLOPT_POSTFIELDS => array('file'=> new CURLFILE(${'localfile'.$i}),'file_location' => 'kyc-remittance','regcode' => $this->user['R'],'email' => '123','ext_name' => '.jpg'),
				));
				
				${'response'.$i} = curl_exec(${'curl'.$i}); 
				curl_close(${'curl'.$i});
				${'upload_response'.$i} = json_decode(${'response'.$i},true);
			}
			
			$id1 = $upload_response1['F'];
			$id2 = $upload_response2['F'];

			if($id1){
				$id1 = "/v1-sftp/kyc-remittance/".$upload_response1['F'];
			}
			if($id2){
				$id2 = "/v1-sftp/kyc-remittance/".$upload_response2['F'];
			}

		}else{
			$data['AddSender']['S'] = 0;
			$data['AddSender']['M'] = "FILE SIZE TOO BIG MUST BE LESS THAN 2MB";
		}

		if($id1){
			$parameter =array(
				'dev_id'    	   	=> $this->global_f->dev_id(),
				'ip_address'		=> $this->ip,
				'actionId' 	 		=> _remittance_add_user_bsp,
				'regcode'   		=> $this->user['R'],
				'fname'				=> $INPUT_POST['inputFname'],
				'mname'				=> $INPUT_POST['inputMname'],
				'lname'				=> $INPUT_POST['inputLname'],
				'suffix'			=> $INPUT_POST['inpuSuffix'],
				'birthdate'			=> $INPUT_POST['inputBdate'],
				'birthplace'		=> $INPUT_POST['inputBirthplace'],
				'address_details'	=> $INPUT_POST['inputStreet'],
				'brgy'				=> $INPUT_POST['inputBarangay'],
				'city'				=> $INPUT_POST['inputCity'],
				'province'			=> $INPUT_POST['inputProvince'],
				'zip'				=> $INPUT_POST['inputPostal'],
				'country'			=> $INPUT_POST['inputCountry'],
				'permanent_address'	=> $INPUT_POST['inputStreet2'] . ", " . $INPUT_POST['inputBarangay2'] . ", " . $INPUT_POST['inputCity2'] . ", " . $INPUT_POST['inputProvince2'] . ", " . $INPUT_POST['inputCountry2'] . ", " . $INPUT_POST['inputPostal2'],
				'mobile'			=> $INPUT_POST['inputMobile'],
				'email'				=> $INPUT_POST['inputEmail'],
				'occupation'		=> $INPUT_POST['inputOccupation'],
				'sourcefund'		=> $INPUT_POST['inputSourceoffund'],
				'nationality'		=> $INPUT_POST['inputNationality'],
				'idtype1'			=> $INPUT_POST['newidtype'],
				'idno1'				=> $INPUT_POST['newidnumber'],
				'idexpiration1'		=> $INPUT_POST['newexpirydate1'],
				'idlink1'			=> $id1,
				'idtype2'			=> $INPUT_POST['newidtype2'],
				'idno2'				=> $INPUT_POST['newidnumber2'],
				'idexpiration2'		=> $INPUT_POST['newexpirydate12'],
				'idlink2'			=> $id2,
				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
			);

			$result = $this->curl->call($parameter,$url);
			$data['AddSender'] = json_decode($result,true);
			echo json_encode($data['AddSender']);
		}else{
			$data['AddSender']['S'] = 0;
			$data['AddSender']['M'] = "UPLOADING IMAGE FAILED";
			echo json_encode($data['AddSender']);
		}
	}

	function addSenderDealer() {
		$INPUT_POST = $this->input->post(null,true);
		$T_VALUE = md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));
		$url = url;
		
		for($i = 1; $i <= 2; $i++){
			${'file'.$i} 			= $_FILES['fileDealer'.$i];
			${'file'.$i.'Name'} 	= ${'file'.$i}['name'];
			${'file'.$i.'Size'}		= ${'file'.$i}['size'];
			${'file'.$i.'Temp'}		= ${'file'.$i}['tmp_name'];
			${'file'.$i.'Error'} 	= ${'file'.$i}['error'];
		}

		if($file1Size < 2*MB || $file2Size < 2*MB) {

			for($a = 1; $a <= 2; $a++){

				${'url'.$a} = ${'file'.$a.'Temp'};
				if(${'file'.$a.'Size'} > 1*MB)
				{
					${'old_size'.$a} = ${'file'.$a.'Size'};
					${'urltmp'.$a}	 = sys_get_temp_dir().'/tmp.jpg';
					
					${'filename'.$a} = $this->compress_image(${'file'.$a.'Size'}, ${'urltmp'.$a}, 75);
					${'new_size'.$a} = filesize(${'urltmp'.$a});
				
					if(${'new_size'.$a} < ${'old_size'.$a})
					{
						${'url'.$a} = ${'urltmp'.$a};
					}
				}
				
				${'curl'.$a} = curl_init();
				${'localfile'.$a} = ${'url'.$a};
			}

			for($i = 1; $i <= 2; $i++){
				curl_setopt_array(${'curl'.$i}, array(
					CURLOPT_URL => 'https://unified.ph/kyc-upload',
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'POST',
					CURLOPT_POSTFIELDS => array('file'=> new CURLFILE(${'localfile'.$i}),'file_location' => 'kyc-remittance','regcode' => $this->user['R'],'email' => '123','ext_name' => '.jpg'),
				));
				
				${'response'.$i} = curl_exec(${'curl'.$i}); 
				curl_close(${'curl'.$i});
				${'upload_response'.$i} = json_decode(${'response'.$i},true);
			}
			
			$id1 = $upload_response1['F'];
			$id2 = $upload_response2['F'];

			if($id1){
				$id1 = "/v1-sftp/kyc-remittance/".$upload_response1['F'];
			}
			if($id2){
				$id2 = "/v1-sftp/kyc-remittance/".$upload_response2['F'];
			}

		}else{
			$data['AddSender']['S'] = 0;
			$data['AddSender']['M'] = "FILE SIZE TOO BIG MUST BE LESS THAN 2MB";
		}

		if($id1){
			$parameter =array(
				'dev_id'    	   	=> $this->global_f->dev_id(),
				'ip_address'		=> $this->ip,
				'actionId' 	 		=> _remittance_add_user_bsp,
				'regcode'   		=> $this->user['R'],
				'transpass' 		=> $INPUT_POST['inputTpass'],
				'fname'				=> $INPUT_POST['inputFnameDealer'],
				'mname'				=> $INPUT_POST['inputMnameDealer'],
				'lname'				=> $INPUT_POST['inputLnameDealer'],
				'suffix'			=> $INPUT_POST['inpuSuffixDealer'],
				'birthdate'			=> $INPUT_POST['inputBdateDealer'],
				'birthplace'		=> $INPUT_POST['inputBirthplaceDealer'],
				'address_details'	=> $INPUT_POST['inputStreetDealer'],
				'brgy'				=> $INPUT_POST['inputBarangayDealer'],
				'city'				=> $INPUT_POST['inputCityDealer'],
				'province'			=> $INPUT_POST['inputProvinceDealer'],
				'zip'				=> $INPUT_POST['inputPostalDealer'],
				'country'			=> $INPUT_POST['inputCountryDealer'],
				'permanent_address'	=> $INPUT_POST['inputStreet2Dealer'] . ", " . $INPUT_POST['inputBarangay2Dealer'] . ", " . $INPUT_POST['inputCity2Dealer'] . ", " . $INPUT_POST['inputProvince2Dealer'] . ", " . $INPUT_POST['inputCountry2Dealer'] . ", " . $INPUT_POST['inputPostal2Dealer'],
				'mobile'			=> $INPUT_POST['inputMobileDealer'],
				'email'				=> $INPUT_POST['inputEmailDealer'],
				'occupation'		=> $INPUT_POST['inputOccupationDealer'],
				'sourcefund'		=> $INPUT_POST['inutSourceoffundDealer'],
				'nationality'		=> $INPUT_POST['inputNationalityDealer'],
				'idtype1'			=> $INPUT_POST['newidtypeDealer'],
				'idno1'				=> $INPUT_POST['newidnumberDealer'],
				'idexpiration1'		=> $INPUT_POST['newexpirydate1Dealer'],
				'idlink1'			=> $id1,
				'idtype2'			=> $INPUT_POST['newidtype2Dealer'],
				'idno2'				=> $INPUT_POST['newidnumber2Dealer'],
				'idexpiration2'		=> $INPUT_POST['newexpirydate12Dealer'],
				'idlink2'			=> $id2,
				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
			);

			$result = $this->curl->call($parameter,$url);
			$data['AddSender'] = json_decode($result,true);
			echo json_encode($data['AddSender']);
			
		}else{
			$data['AddSender']['S'] = 0;
			$data['AddSender']['M'] = "UPLOADING IMAGE FAILED";
			echo json_encode($data['AddSender']);
		}
	}

	function updateSenderDealerID() {
		$INPUT_POST = $this->input->post(null,true);
		$T_VALUE = md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));
		$url = url;
		
		for($i = 1; $i <= 2; $i++){
			${'file'.$i} 			= $_FILES['file'.$i];
			${'file'.$i.'Name'} 	= ${'file'.$i}['name'];
			${'file'.$i.'Size'}		= ${'file'.$i}['size'];
			${'file'.$i.'Temp'}		= ${'file'.$i}['tmp_name'];
			${'file'.$i.'Error'} 	= ${'file'.$i}['error'];
		}

		if($file1Size < 5*MB || $file2Size < 5*MB) {

			for($a = 1; $a <= 2; $a++){

				${'url'.$a} = ${'file'.$a.'Temp'};
				${'curl'.$a} = curl_init();
				${'localfile'.$a} = ${'url'.$a};
			}

			for($i = 1; $i <= 2; $i++){
				curl_setopt_array(${'curl'.$i}, array(
					CURLOPT_URL => 'https://unified.ph/kyc-upload',
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'POST',
					CURLOPT_POSTFIELDS => array('file'=> new CURLFILE(${'localfile'.$i}),'file_location' => 'kyc-remittance','regcode' => $this->user['R'],'email' => '123','ext_name' => '.jpg'),
				));
				
				${'response'.$i} = curl_exec(${'curl'.$i}); 
				curl_close(${'curl'.$i});
				${'upload_response'.$i} = json_decode(${'response'.$i},true);
			}
			
			$id1 = $upload_response1['F'];
			$id2 = $upload_response2['F'];

			if($id1){
				$id1 = "/v1-sftp/kyc-remittance/".$upload_response1['F'];
			}
			if($id2){
				$id2 = "/v1-sftp/kyc-remittance/".$upload_response2['F'];
			}

		}else{
			$data['AddSender']['S'] = 0;
			$data['AddSender']['M'] = "FILE SIZE TOO BIG MUST BE LESS THAN 5MB";
		}

		if($id1){
			$permanentAddress = $INPUT_POST['inputStreet2'] . ", " . $INPUT_POST['inputBarangay2'] . ", " . $INPUT_POST['inputCity2'] . ", " . $INPUT_POST['inputProvince2'] . ", " . $INPUT_POST['inputCountry2'] . ", " . $INPUT_POST['inputPostal2'];
			if (strpos($permanentAddress, 'undefined') !== false) {
				$permanentAddress = NULL;
			}
	
			$birthplace = $INPUT_POST['inputBirthplace'];
			$occupation = $INPUT_POST['inputOccupation'];
			$sourcefund = $INPUT_POST['inputSourceoffund'];
	
			if(strpos($birthplace, 'undefined') !== false) {
				$birthplace = NULL;
			}
			if(strpos($occupation, 'undefined') !== false) {
				$occupation = NULL;
			}
			if(strpos($sourcefund, 'undefined') !== false) {
				$sourcefund = NULL;
			}
	
			$parameter =array(
				'dev_id'    	   	=> $this->global_f->dev_id(),
				'ip_address'		=> $this->ip,
				'actionId' 	 		=> 'ups_ecash_service/remittance_update_dealer_bsp',
				'regcode'   		=> $this->user['R'],
				'senderID'			=> $INPUT_POST['senderID'],
				'birthplace'		=> $birthplace,
				'permanent_address'	=> $permanentAddress,
				'occupation'		=> $occupation,
				'sourcefund'		=> $sourcefund,
				'idtype1'			=> $INPUT_POST['newidtype'],
				'idno1'				=> $INPUT_POST['newidnumber'],
				'idexpiration1'		=> $INPUT_POST['newexpirydate1'],
				'idlink1'			=> $id1,
				'idtype2'			=> $INPUT_POST['newidtype2'],
				'idno2'				=> $INPUT_POST['newidnumber2'],
				'idexpiration2'		=> $INPUT_POST['newexpirydate12'],
				'idlink2'			=> $id2,
				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
			);
			
			$result = $this->curl->call($parameter,$url);
			$data['AddSender'] = json_decode($result,true);
			echo json_encode($data['AddSender']);
			
		}else{
			$data['AddSender']['S'] = 0;
			$data['AddSender']['M'] = "UPLOADING IMAGE FAILED";
			echo json_encode($data['AddSender']);
		}
	}

	function updateSenderDealer() {
		$INPUT_POST = $this->input->post(null,true);
		$T_VALUE = md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));
		$url = url;

		$permanentAddress = $INPUT_POST['inputStreet2'] . ", " . $INPUT_POST['inputBarangay2'] . ", " . $INPUT_POST['inputCity2'] . ", " . $INPUT_POST['inputProvince2'] . ", " . $INPUT_POST['inputCountry2'] . ", " . $INPUT_POST['inputPostal2'];
		if (strpos($permanentAddress, 'undefined') !== false) {
			$permanentAddress = NULL;
		}

		$birthplace = $INPUT_POST['inputBirthplace'];
		$occupation = $INPUT_POST['inputOccupation'];
		$sourcefund = $INPUT_POST['inputSourceoffund'];

		if(strpos($birthplace, 'undefined') !== false) {
			$birthplace = NULL;
		}
		if(strpos($occupation, 'undefined') !== false) {
			$occupation = NULL;
		}
		if(strpos($sourcefund, 'undefined') !== false) {
			$sourcefund = NULL;
		}

		$parameter =array(
			'dev_id'    	   	=> $this->global_f->dev_id(),
			'ip_address'		=> $this->ip,
			'actionId' 	 		=> 'ups_ecash_service/remittance_update_dealer_bsp',
			'regcode'   		=> $this->user['R'],
			'senderID'			=> $INPUT_POST['senderID'],
			'birthplace'		=> $birthplace,
			'permanent_address'	=> $permanentAddress,
			'occupation'		=> $occupation,
			'sourcefund'		=> $sourcefund,
			'idtype1'			=> null,
			'idno1'				=> null,
			'idexpiration1'		=> null,
			'idlink1'			=> null,
			'idtype2'			=> null,
			'idno2'				=> null,
			'idexpiration2'		=> null,
			'idlink2'			=> null,
			$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
		);

		$result = $this->curl->call($parameter, $url);
		$data['AddSender'] = json_decode($result,true);
		echo json_encode($data['AddSender']);
	}
	function fetch_ecashpadala_rate(){
		$amount = $this->input->post('amount');
		
		$url = url;
		
		$parameter =array(
			'actionId' 	 => 'ups_ecash_service/ecashpadala_rates_bsp',
			'dev_id' 	 => $this->global_f->dev_id(),
			'regcode'	 => $this->user['R'],
			'amount'	 => $amount,
			'ip_address' => $this->ip
		);

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}

	function fetch_ecashcredittobank_rate(){
		$amount = $this->input->post('amount');
		$regcode = $this->input->post('regcode');
		
		$url = url;
		
		$parameter =array(
			'actionId' 	 => 'ups_ecash_service/ecashcredittobank_rates_bsp',
			'dev_id' 	 => $this->global_f->dev_id(),
			'regcode'	 => $this->user['R'],
			'amount'	 => $amount,
			'ip_address' => $this->ip
		);

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}

	function fetch_ecash_wallettopup_rate(){
		$amount = $this->input->post('amount');
		$service = $this->input->post('service');
		
		$url = url;
		
		$parameter =array(
			'actionId' 	 => 'ups_ecash_service/eccashwallettopup_rates_bsp',
			'dev_id' 	 => $this->global_f->dev_id(),
			'regcode'	 => $this->user['R'],
			'amount'	 => $amount,
			'service'    => $service,
			'ip_address' => $this->ip
		);

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}

	function fetch_ecashtocebuana_rate(){
		$currencyid = $this->input->post('currency_id');
		$amount = $this->input->post('amount');
		
		$url = url;
		
		$parameter =array(
			'dev_id'      => $this->global_f->dev_id(),
			'actionId' 	  => _get_domestic_rates,
			'ip_address'  => $this->ip,
			'regcode'     => $this->user['R'],
			'currency_id' => $currencyid,
			'amount'      => $amount
		);

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}
	
} //class controller end