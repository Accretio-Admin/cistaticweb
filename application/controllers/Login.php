<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
class Login extends CI_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->user = $this->session->userdata('user');
	    $this->load->model('Global_function','global_f');
	    $this->load->model('Curl_model','curl');
	    // $this->ip = $this->input->ip_address();

	    

        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)){
            $IP = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
			$IP = $IP[0];
	   }else{
			$IP = $_SERVER['REMOTE_ADDR'];
		
		}
		
	    $this->ip = $IP;
	    $this->load->model('Query_model');
         
	}

// 	public function index()
// 	{	
	
// 		if($this->session->userdata('user')){
// 			redirect('/Main'); 
// 		}
// 		// if ($this->input->server('REMOTE_ADDR') == '122.54.71.220') {
// 		// 	echo "asd";
// 		// 	die();
// 		// }
// 		// $get_mac =explode('at',shell_exec("arp -a ".escapeshellarg($this->ip)));
// 		// $mac = explode("[ether]", $get_mac[1]);
// 		// $mac_address = str_replace(" ", "", $mac[0]);
// 		// var_dump(shell_exec("arp -a "));
		
		
// 		if (null !== $this->input->post('btnsignin')) {
			
			
			
// 			$username = $this->input->post('sign_username');
// 			$password = $this->input->post('sign_password');
// 			$url = url;
// 		    $parameter = array(
// 		    				'dev_id'     => $this->global_f->dev_id(),
// 		    				'ip_address' => $this->ip,
// 		    				'actionId' 	 => 'ups_login',
// 		    				'username'   => $username,
// 		    				'password'	 => $password,
// 		    				'platform'	 => PLATFORM,
// 		    				'appid' 	 => APPID,
// 		    				'appver'	 => APPVER,
// 		    				'flag'		 => FLAG
// 		    			); 

// 		    $result = $this->curl->call($parameter,$url);
// 		    $API = json_decode($result,true);
// 			if ($API) {
	
		
// 				if ($API['S'] == 1) {
// 					$this->session->set_userdata('user',$API);
// 							$this->user = $this->session->userdata('user');

// 							$this->session->set_flashdata('announcepopup', '1'); //Announcement Popup Modal
							
// 					redirect('/Main');
// 				}elseif ($API['S'] == 99) {
// //					 var_dump($API);
// //		 		 	die();
// 					$data['result'] = $API;
// 					// var_dump($data['result']['R'] );
// 					$data['process'] = 1;
// 				}else{
// 					$data['result'] = array(	
// 					  	'S' => 0,
// 					  	'M' =>$API['M']
// 					);
// 				}
// 			}else{
// 				$data['result'] = array(	
// 				  	'S' => 0,
// 				  	'M' => 'Login Failed..Please try again'
// 				);
// 			}
			
// 		}

// 		if (null !== $this->input->post('btnConfirmActivation')) {
// 			$regcode = $this->input->post('regcode');
// 			$verification_code = $this->input->post('verification_code');
// 			$dev_id = $this->input->post('device_id');
// 			$url = url_old.'/verify_device';
// 		    $parameters = array(
// 		    				'dev_id'     => $this->global_f->dev_id(),
// 		    				'ip_address' => $this->ip,
// 		    				'regcode' 	 => $regcode,
// 		    				'acode'   => $verification_code
// 		    			);
// 		    $result = $this->curl->call($parameters,$url);
// 		    $API = json_decode($result,true);

// 			if ($API) {
// 				$data['result'] = array(	
// 				  	'S' => $API['S'],
// 				  	'M' =>  $API['M']
// 				);

// 			}else{
// 				$data['process'] = 1;
// 				$data['result'] = array(	
// 				  	'S' => 0,
// 				  	'M' => 'Please try again'
// 				);

// 			}
// 		}

// 		if (null !== $this->input->post('btnResendCode')) {
// 			$regcode = $this->input->post('regcode');
// 			$verification_code = $this->input->post('verification_code');
// 			$dev_id = $this->input->post('device_id');
// 			$url = url_old.'/resend_email_code';
// 		    $parameters = array(
// 		    				'dev_id'     => $this->global_f->dev_id(),
// 		    				'ip_address' => $this->ip,
// 		    				'regcode' 	 => $regcode
// 		    			);
// 		    $result = $this->curl->call($parameters,$url);
// 		    $API = json_decode($result,true);
// 			if ($API) {
// 				if ($API['S'] == 1) {
// 				$data['result'] = array('R' => $regcode,'DI' => $dev_id,
// 							'S' => $API['S'],
// 					  		'M' =>$API['M']);
// 							$data['process'] = 1;
				
// 				}else{
// 					$data['result'] = array(	
// 					  	'S' => 0,
// 					  	'M' =>$API['M']
// 					);
// 				}

// 			}else{
// 				$data['result'] = array(	
// 				  	'S' => 0,
// 				  	'M' => 'Please try again'
// 				);
// 			}
// 		}


// 		$this->load->view('layout/header',$data);
// 		$this->load->view('login/index_09302021',$data);
// 		$this->load->view('layout/footer');
// 	}

	public function index()
	{	
	    
		if($this->session->userdata('user'))
		{
			redirect('/Main'); 
		}
		
		if (null !== $this->input->post('btnsignin')) 
		{
			
			$username = $this->input->post('sign_username');
			$password = $this->input->post('sign_password');
			$url = url;
		    $parameter = array(
				'dev_id'     => $this->global_f->dev_id(),
				'ip_address' => $this->ip,
				'actionId' 	 => 'ups_login',
				'username'   => $username,
				'password'	 => $password,
				'platform'	 => PLATFORM,
				'appid' 	 => APPID,
				'appver'	 => APPVER,
				'flag'		 => FLAG
			); 
			 
		    $result = $this->curl->call($parameter,$url);
		    $API = json_decode($result,true);
		
			if ($API) 
			{
				if ($API['S'] == 1) 
				{
					//added by rene for testing of location service
					if ($API['R'] == 'F5033230' || $API['R'] == 'F1526245'  || $API['R'] == 'F8152116' || $API['R'] == 'F9592952' || $API['R'] == 'F9687521' || $API['R'] == 'F1359252'  || $API['R'] == 'F8901916' || $API['R'] == 'F5597768' || $API['L'] == '1' || $API['L'] == '6' || $API['L'] == '7' || $API['L'] == '14' || $API['L'] == '15' || $API['L'] == '16') {
						$parameter = array(
							'dev_id'     => $this->global_f->dev_id(),
							'ip_address' => $this->ip,
							'actionId' 	 => 'ups_location_service/getUserLocationDetails/getUserProfile',
							'regcode'   => $API['R'], 
						); 
						$result = $this->curl->call($parameter,$url);
		    			$locationService = json_decode($result,true);   
						// print_r($result);exit();
						if ($locationService['S'] == 1) {
							$this->session->set_userdata("locationService",$locationService['M'][0]); 
							 
						} else {
							$this->session->set_userdata("locationService",$locationService); 
							$this->session->set_flashdata('updatelocationservice', '1'); 
						}
					}

					if ($API)
					{
						//Disabled for Testom02 and GWL Regcodes
						// if (substr($API['R'], 0, 3) == 'GWL')
						// {
						// 	$data['result'] = array(	
						// 		'S' => 0,
						// 		'M' => 'Login failed, Please try again.'
						// 	);
						// }
						// else if (substr($API['R'], 0, 3) == 'DWL')
						// {
						// 	$data['result'] = array(	
						// 		'S' => 0,
						// 		'M' => 'Login failed, Please try again.'
						// 	);
						// }
						// else 
						if (substr($API['R'], 0, 3) == 'GRM')
						{
							$data['result'] = array(	
								'S' => 0,
								'M' => 'Login failed, Please try again.'
							);
						}
						else 
						{
							
							$this->session->set_userdata('user',$API);
							$this->user = $this->session->userdata('user');
							$this->session->set_flashdata('announcepopup', '1');	
							redirect('/Main');
						}
					}
					else 
					{
						$data['result'] = array(	
							'S' => 0,
							'M' => 'Login failed, Please try again. 1st'
					  	);
					}
				}
				elseif ($API['S'] == 99) 
				{
					$data['result'] = $API;
					$data['process'] = 1;
					$data['username'] = $username;
				}
				else
				{
					$data['result'] = array(	
					  	'S' => 0,
					  	'M' => $API['M']
					);
				}
			}
			else
			{
				$data['result'] = array(	
				  	'S' => 0,
				  	'M' => 'Login failed, Please try again. 2nd'
				);
			}
			
		}

		if (null !== $this->input->post('btnConfirmActivation')) {
			$regcode = $this->input->post('regcode');
			$verification_code = $this->input->post('verification_code');
			$dev_id = $this->input->post('device_id');
			$url = url_old.'/verify_device';

		    $parameters = array(
				'dev_id'     => $this->global_f->dev_id(),
				'ip_address' => $this->ip,
				'regcode' 	 => $regcode,
				'acode'   => $verification_code
			);

		    $result = $this->curl->call($parameters,$url);
		    $API = json_decode($result,true);

			if ($API) {
				$data['result'] = array(	
				  	'S' => $API['S'],
				  	'M' =>  $API['M']
				);
			}
			else
			{
				$data['process'] = 1;
				$data['result'] = array(	
				  	'S' => 0,
				  	'M' => 'Please try again'
				);

			}
		}

		if (null !== $this->input->post('btnResendCode')) {
			$regcode = $this->input->post('regcode');
			$verification_code = $this->input->post('verification_code');
			$dev_id = $this->input->post('device_id');
			$url = url_old.'/resend_email_code';

		    $parameters = array(
				'dev_id'     => $this->global_f->dev_id(),
				'ip_address' => $this->ip,
				'regcode' 	 => $regcode
			);

		    $result = $this->curl->call($parameters,$url);
		    $API = json_decode($result,true);

			if ($API) 
			{
				if ($API['S'] == 1) 
				{
					$data['result'] = array(
						'R' => $regcode,'DI' => $dev_id,
						'S' => $API['S'],
						'M' =>$API['M']
					);

					$data['process'] = 1;
				}
				else
				{
					$data['result'] = array(	
					  	'S' => 0,
					  	'M' =>$API['M']
					);
				}

			}
			else
			{
				$data['result'] = array(	
				  	'S' => 0,
				  	'M' => 'Please try again'
				);
			}
		}


		$this->load->view('layout/header',$data);
		$this->load->view('login/index_09302021',$data);
		$this->load->view('layout/footer');
	}

	public function user_logout()
	{
		if ($this->user['S'] == 1 && $this->user['R'] != "")
		{
			$this->session->sess_destroy();

			// if (substr($this->user['R'], 0, 3) == 'GRM' || $this->user['R'] == 'F5880126' || $this->user['R'] == 'F9175006' || $this->user['R'] == 'G7979485' || $this->user['R'] == 'F1205575' || $this->user['R'] == 'F1145677' || $this->user['R'] == 'F1164754' || $this->user['R'] == 'F1198933' || $this->user['R'] == '1234567')
			if (substr($this->user['R'], 0, 3) == 'GRM')
			{	
				redirect('https://ricemart.ph/');
			} 
			else if (substr($this->user['R'], 0, 3) == 'GWL' || substr($this->user['R'], 0, 3) == 'DWL')
			{
				redirect('https://secure.unified.ph/');
			}
			else 
			{
				redirect('/Login');
			}
		}		
	}

	// function forgot_password(){
	// 	if (isset($_POST['btnForgot'])){

	// 	$url = url;

	// 	$parameter =array(
	// 				'dev_id'    	   => $this->global_f->dev_id(),
	// 				'actionId' 		   => _forgot,
	// 				'ip_address'       => $this->ip, 
	// 				'ip'			   => $this->ip, 
    // 				'username'         =>$this->input->post('username'),
    // 				'regcode'	       =>$this->input->post('regcode'),
    // 				'email_address'	   =>$this->input->post('email')
	// 		    	); 
	//     $result = $this->curl->call($parameter,$url);
	//     $data['API'] = json_decode($result,true);

	//     // print_r($data['API']);


	// 	$this->load->view('layout/header', $data);
	// 	$this->load->view('login/index_09302021', $data);
	// 	$this->load->view('layout/footer');
	// 	}
	// }

	//sms and email
	function Resend_code(){
		$username = $this->input->post('username');
		$regcode = $this->input->post('regcode');
		
			$url = 'https://mobileapi.unified.ph/ups_login_sms_sending/sms_sending';

			$parameter = array(
				'actionId' 	 	=> 'ups_login_sms_sending/sms_sending',
				'dev_id' 	 	=> $this->global_f->dev_id(),
				'regcode'	 	=> $regcode,
				'username'	 	=> $username,
				'ip_address' 	=> $this->ip
			);
		
		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}

	function verifyCode(){
		$vcode = $this->input->post('vcode');
		$username = $this->input->post('username');
		$regcode = $this->input->post('regcode');
		$ID = $this->input->post('vId');
		
			$url = 'https://mobileapi.unified.ph/ups_login_sms_sending/sms_verification';

			$parameter = array(
				'vcode'	 			=>	 $vcode,
				'id'				=>	 $ID,
				'username'	 		=>	 $username,
				'dev_id' 	 		=>	 $this->global_f->dev_id(),
				'ip' 				=>	 $this->ip,
				'regcode'	 		=>	 $regcode,
				'ip_address' 		=>	 $this->ip,
				'actionId' 	 		=>	 'ups_login_sms_sending/sms_verification'
			);
		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);

	}
	
	// For new password form
	function forgot_password () {
		if (isset($_POST['btnForgot'])) {
			$url = url;

			$parameter = array(
				'dev_id'    	   => $this->global_f->dev_id(),
				'actionId' 		   => _forgot,
				'ip_address'       => $this->ip, 
				'ip'			   => $this->ip, 
				'username'         =>$this->input->post('username'),
				'regcode'	       =>$this->input->post('regcode'),
				'email_address'	   =>$this->input->post('email')
			);

			$result = $this->curl->call($parameter, $url);
			$data['API'] = json_decode($result, true);

			if ($data['API']) 
			{
				if ($data['API']['S'] == 1) 
				{ 
					if ($data['API']['R'] != 'F5033230' || $data['API']['R'] != 'F5597768' || $data['API']['R'] != 'F1526245')
					{
						redirect('/Login');
					}
					else
					{
						$data['result'] = array(
							'S' => 0,
							'M' => 'Reset password failed, Please try again.'
						);
					}
				} 
				else 
				{
					$data['result'] = array(
						'S' => $data['API']['S'],
						'M' => $data['API']['M']
					);
				}
			}
		}

		$this->load->view('login/forgot_password',$data);
		// $this->load->view('hotels/hotelundermaintenance');
	}

	function test_otp () {
		$url = 'https://pubsubnet.globalpinoyremittance.com/webportal?op=pa';

		$parameter = array(
			'dev_id'    	   => $this->global_f->dev_id(),
			'actionId' 		   => 'ups_otp_verification/test_otp',
			'ip_address'       => $this->ip, 
			'regcode'	       =>$this->user['R']
		);

		$result = $this->curl->call($parameter, $url);
		// $data['API'] = json_decode($result, true);

		echo $result;
	}

	function wealthy_forgot_password () {
		if (isset($_POST['btnForgot'])) {
			$url = url;

			$parameter = array(
				'dev_id'    	   => $this->global_f->dev_id(),
				'actionId' 		   => _forgot,
				'ip_address'       => $this->ip, 
				'ip'			   => $this->ip, 
				'username'         =>$this->input->post('username'),
				'regcode'	       =>$this->input->post('regcode'),
				'email_address'	   =>$this->input->post('email')
			);

			$result = $this->curl->call($parameter, $url);
			$data['API'] = json_decode($result, true);

			if ($data['API']) 
			{
				if ($data['API']['S'] == 1) 
				{ 
					if ($data['API']['R'] != 'F5033230' || $data['API']['R'] != 'F5597768' || $data['API']['R'] != 'F1526245')
					{
						redirect('/Login');
					}
					else
					{
						$data['result'] = array(
							'S' => 0,
							'M' => 'Reset password failed, Please try again.'
						);
					}
				} 
				else 
				{
					$data['result'] = array(
						'S' => $data['API']['S'],
						'M' => $data['API']['M']
					);
				}
			}
		}

		$this->load->view('wealthyforgotpassword/index',$data);
		// $this->load->view('hotels/hotelundermaintenance');
	}

	function ricemart_forgot_password ()
	{
		if (isset($_POST['btnForgot'])) 
		{
			$url = url;

			$parameter = array(
				'dev_id'    	   => $this->global_f->dev_id(),
				'actionId' 		   => _forgot,
				'ip_address'       => $this->ip, 
				'ip'			   => $this->ip, 
				'username'         =>$this->input->post('username'),
				'regcode'	       =>$this->input->post('regcode'),
				'email_address'	   =>$this->input->post('email')
			);

			$result = $this->curl->call($parameter, $url);
			$data['API'] = json_decode($result, true);

			if ($data['API']) 
			{
				if ($data['API']['S'] == 1) 
				{ 
					if (substr($data['API']['R'],0,3) == 'GRM') 
					{
						header('Location: https://ricemart.ph/Login');
					} 
					else 
					{
						header('Location: https://ricemart.ph/Login/ricemart_error_forgot_pass?');
					}
				} 
				else 
				{
					header('Location: https://ricemart.ph/Login/ricemart_error_forgot_pass?');
				}
			}
		}
	}

	function ricemart()
	{
		$data = [];

		$username = $this->input->post('sign_username', TRUE);
		$password = $this->input->post('sign_password', TRUE);

		if ($username && $password)
		{
			$url = url;

		    $parameter = array(
				'dev_id' => $this->global_f->dev_id(),
				'ip_address' => $this->ip,
				'actionId' => 'ups_login',
				'username' => $username,
				'password' => $password,
				'platform' => PLATFORM,
				'appid' => APPID,
				'appver' => APPVER,
				'flag' => FLAG
			);

		    $result = $this->curl->call($parameter, $url);

		    $API = json_decode($result, true);

			if ($API) 
			{
				if ($API['S'] == 1)
				{
					if (substr($API['R'], 0, 3) == 'GRM' || $API['R'] == 'F9175006' || $API['R'] == 'F5880126' || $API['R'] == 'G7979485' || $API['R'] == 'F1205575' || $API['R'] == 'F1145677' || $API['R'] == 'F1164754' || $API['R'] == 'F1198933' || $API['R'] == '1234567' || $API['R'] == 'F3989172' || $API['R'] == 'F3989172' || $API['R'] == 'GRM6195296' || $API['R'] == 'GRM2828952') {
						$this->session->set_userdata('user', $API);
						$this->user = $this->session->userdata('user');
						$this->session->set_flashdata('announcepopup', '1');
						redirect('/Main'); 
					}
					else 
					{	
						header('Location: https://ricemart.ph/Login/ricemart_error_login?');
					}
				} 
				elseif ($API['S'] == 99)  
				{
					$data['result'] = $API;
					$data['process'] = 1;
				} 
				else 
				{
					header('Location: https://ricemart.ph/Login/ricemart_error_login?');
				}
			} 
			else 
			{
				header('Location:https://ricemart.ph/Login/ricemart_error_login?');
			}
		}

		if (null !== $this->input->post('btnConfirmActivation')) 
		{
			$regcode = $this->input->post('regcode');
			$verification_code = $this->input->post('verification_code');
			$dev_id = $this->input->post('device_id');
			$url = url_old.'/verify_device';

		    $parameters = array(
				'dev_id'     => $this->global_f->dev_id(),
				'ip_address' => $this->ip,
				'regcode' 	 => $regcode,
				'acode'   => $verification_code
			);

		    $result = $this->curl->call($parameters,$url);
		    $API = json_decode($result,true);

			if ($API) {
				$data['result'] = array(	
				  	'S' => $API['S'],
				  	'M' =>  $API['M']
				);
			}
			else
			{
				$data['process'] = 1;
				$data['result'] = array(	
				  	'S' => 0,
				  	'M' => 'Please try again'
				);

			}
		}

		if (null !== $this->input->post('btnResendCode')) 
		{
			$regcode = $this->input->post('regcode');
			$verification_code = $this->input->post('verification_code');
			$dev_id = $this->input->post('device_id');
			$url = url_old.'/resend_email_code';

		    $parameters = array(
				'dev_id'     => $this->global_f->dev_id(),
				'ip_address' => $this->ip,
				'regcode' 	 => $regcode
			);

		    $result = $this->curl->call($parameters,$url);
		    $API = json_decode($result,true);

			if ($API) 
			{
				if ($API['S'] == 1) 
				{
					$data['result'] = array(
						'R' => $regcode,'DI' => $dev_id,
						'S' => $API['S'],
						'M' =>$API['M']
					);

					$data['process'] = 1;
				}
				else
				{
					$data['result'] = array(	
					  	'S' => 0,
					  	'M' =>$API['M']
					);
				}

			}
			else
			{
				$data['result'] = array(	
				  	'S' => 0,
				  	'M' => 'Please try again'
				);
			}
		}

		$this->load->view('layout/header', $data);
		$this->load->view('login/index', $data);
		$this->load->view('layout/footer');
	}

	function wealthyLifeStyle () 
	{ 
		$data = [];

		if (null !== $this->input->post('btnLogin'))  
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$url = url;

		    $parameter = array(
				'dev_id'     => $this->global_f->dev_id(),
				'ip_address' => $this->ip,
				'actionId' 	 => 'ups_login',
				'username'   => $username,
				'password'	 => $password,
				'platform'	 => PLATFORM,
				'appid' 	 => APPID,
				'appver'	 => APPVER,
				'flag'		 => FLAG
			);

		    $result = $this->curl->call($parameter, $url);

		    $API = json_decode($result, true);

			if ($API) 
			{
				if ($API['S'] == 1) 
				{
					if (substr($API['R'], 0, 3) == 'GWL' || substr($API['R'], 0, 3) == 'DWL' || $API['R'] == 'F5597768') {
						$this->session->set_userdata('user', $API);
						$this->user = $this->session->userdata('user');
						$this->session->set_flashdata('announcepopup', '1');
						redirect('/Main'); 
					}
					else 
					{	
						header('Location: https://wealthylifestyle.com.ph/Login/error');
					}
				} 
				elseif ($API['S'] == 99)  
				{
					$data['result'] = $API;
					$data['process'] = 1;
				} 
				else 
				{
					header('Location: https://wealthylifestyle.com.ph/Login/error');
				}
			} 
			else 
			{
				header('Location: https://wealthylifestyle.com.ph/Login/error');
			}
		}

		if (null !== $this->input->post('btnConfirmActivation')) 
		{
			$regcode = $this->input->post('regcode');
			$verification_code = $this->input->post('verification_code');
			$dev_id = $this->input->post('device_id');
			$url = url_old.'/verify_device';

		    $parameters = array(
				'dev_id'     => $this->global_f->dev_id(),
				'ip_address' => $this->ip,
				'regcode' 	 => $regcode,
				'acode'   => $verification_code
			);

		    $result = $this->curl->call($parameters,$url);
		    $API = json_decode($result,true);

			if ($API) 
			{
				$data['result'] = array(	
				  	'S' => $API['S'],
				  	'M' =>  $API['M']
				);
			}
			else
			{
				$data['process'] = 1;
				$data['result'] = array(	
				  	'S' => 0,
				  	'M' => 'Please try again'
				);

			}
		}

		if (null !== $this->input->post('btnResendCode')) {
			$regcode = $this->input->post('regcode');
			$verification_code = $this->input->post('verification_code');
			$dev_id = $this->input->post('device_id');
			$url = url_old.'/resend_email_code';

		    $parameters = array(
				'dev_id'     => $this->global_f->dev_id(),
				'ip_address' => $this->ip,
				'regcode' 	 => $regcode
			);

		    $result = $this->curl->call($parameters,$url);
		    $API = json_decode($result,true);

			if ($API) 
			{
				if ($API['S'] == 1) 
				{
					$data['result'] = array(
						'R' => $regcode,'DI' => $dev_id,
						'S' => $API['S'],
						'M' =>$API['M']
					);

					$data['process'] = 1;
				}
				else
				{
					$data['result'] = array(	
					  	'S' => 0,
					  	'M' =>$API['M']
					);
				}

			}
			else
			{
				$data['result'] = array(	
				  	'S' => 0,
				  	'M' => 'Please try again'
				);
			}
		}

		$this->load->view('layout/header', $data);
		$this->load->view('login/index', $data);
		$this->load->view('layout/footer');
	}
}
		
