<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {

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
	    $this->load->model('Query_model');
	}


	public function index()
	{	
		// print_r("sample");
		// exit();

		$INPUT_POST =$this->input->post(null,true);

		if (null !== $this->input->post('btnRegister')){

		   $url = url;
		   $parameter = array ( 
		    				    'dev_id'     	   =>$this->global_f->dev_id(),
		    				    'ip_address' 	   =>$this->ip,
		    				    'actionId' 	 	   => _registration,
		    				    'm_code'		   =>$INPUT_POST['inputPinmobile'],
		    				    'e_code'		   =>$INPUT_POST['inputPinemail'],
		   						'username'         =>$INPUT_POST['inputUsername'],
						  	    'loginpass'        =>$INPUT_POST['inputPassword'],
						  	    'transpass'	       =>$INPUT_POST['inputTpass'],
							    'lastname'    	   =>$INPUT_POST['inputLN'],
							    'firstname'   	   =>$INPUT_POST['inputFN'],
						   	    'middlename'  	   =>$INPUT_POST['inputMD'],
							    'birthdate'	  	   =>$INPUT_POST['inputBirthday'],
							    'mobileno'	  	   =>$INPUT_POST['inputMobileNo'],
							    'email'		  	   =>$INPUT_POST['inputEmail'],
							    'address'	  	   =>$INPUT_POST['inputAddress'],
							    'zipcode'	       =>$INPUT_POST['inputZipcode'],
								'directReferral'   =>$INPUT_POST['inputDirectReferralRC'],
						  		'placement'        =>$INPUT_POST['inputPlacement'],
						  		'position' 		   =>$INPUT_POST['inputPosition'],
							    'regcode'    	   =>$INPUT_POST['inputRegcode'],
						  		'pin'       	   =>$INPUT_POST['inputPIN'],
							    'trackno'  		   =>$INPUT_POST['inputTN'],
							    'scode'    		   =>$INPUT_POST['selSecurity'],
							    'answer'   		   =>$INPUT_POST['inputAnswer'],
							    'c_code'		   =>$INPUT_POST['country']
							);
		    $result = $this->curl->call($parameter,$url);
		    $API = json_decode($result,true);
			// print_r($parameter); 
			// print_r($API);
			// print_r($result);
			// print_r($API['S']);
			// print_r($API['M']);
			// die();
		    //var_dump($API);
			if ($API) {
				if ($API['S'] == 1) {
					// echo "<script>alert('REGISTRATION SUCCESSFUL!');</script>";
					$data['result'] = array(	
					  	'S' => 1,
					  	'M' =>$API['M']
					);
					$this->session->sess_destroy();
					//die("SUCCESS");
				}else{
					// echo "<script>alert('$result');</script>";
					$data['result'] = array(	
					  	'S' => 0,
					  	'M' =>$API['M']
					);
					//die("FAIL");
				}
			}else{
	
				$data['result'] = array(	
				  	'S' => 0,
				  	'M' => 'Please try again'
				);
				//die("RETRY REGISTRATION");
			}

		}

		$this->load->view('layout/header',$data);
		// $this->load->view('registration/index',$data);
		$this->load->view('registration/dealer_registration',$data);
		$this->load->view('layout/footer');
		
	}

	public function checkRegcode(){
		$INPUT_POST =$this->input->post(null,true);

		if (isset($_POST['regCode'])){
             $url = 'https://upsmobileapi.azurewebsites.net/Ups_registration_service/checkRegcode';
			 $parameter = array ( 
				'actionId' =>'ups_registration_service/checkRegcode',	
				'regcode'  =>$INPUT_POST['regCode']
			 );

			 $result = $this->curl->call($parameter,$url);
			 $API = json_decode($result,true);
			 
			 $return = $API['S']."|".$API['M'];
			 echo $return;
		}
	}

	function select_account_type(){
        $this->load->view('layout/header',$data);
		$this->load->view('registration/select_account_type');
		$this->load->view('layout/footer');
	}


	public function wealthylifestyle()
	{	
		// print_r("sample");
		// exit();

		$INPUT_POST =$this->input->post(null,true);

		if (null !== $this->input->post('btnRegister')){

		   $url = url;
		   $parameter = array ( 
		    				    'dev_id'     	   =>$this->global_f->dev_id(),
		    				    'ip_address' 	   =>$this->ip,
		    				    'actionId' 	 	   => _registration,
		    				    'm_code'		   =>$INPUT_POST['inputPinmobile'],
		    				    'e_code'		   =>$INPUT_POST['inputPinemail'],
		   						'username'         =>$INPUT_POST['inputUsername'],
						  	    'loginpass'        =>$INPUT_POST['inputPassword'],
						  	    'transpass'	       =>$INPUT_POST['inputTpass'],
							    'lastname'    	   =>$INPUT_POST['inputLN'],
							    'firstname'   	   =>$INPUT_POST['inputFN'],
						   	    'middlename'  	   =>$INPUT_POST['inputMD'],
							    'birthdate'	  	   =>$INPUT_POST['inputBirthday'],
							    'mobileno'	  	   =>$INPUT_POST['inputMobileNo'],
							    'email'		  	   =>$INPUT_POST['inputEmail'],
							    'address'	  	   =>$INPUT_POST['inputAddress'],
							    'zipcode'	       =>$INPUT_POST['inputZipcode'],
								'directReferral'   =>$INPUT_POST['inputDirectReferralRC'],
						  		'placement'        =>$INPUT_POST['inputPlacement'],
						  		'position' 		   =>$INPUT_POST['inputPosition'],
							    'regcode'    	   =>$INPUT_POST['inputRegcode'],
						  		'pin'       	   =>$INPUT_POST['inputPIN'],
							    'trackno'  		   =>$INPUT_POST['inputTN'],
							    'scode'    		   =>$INPUT_POST['selSecurity'],
							    'answer'   		   =>$INPUT_POST['inputAnswer'],
							    'c_code'		   =>$INPUT_POST['country']
							);

		    $result = $this->curl->call($parameter,$url);
		    $API = json_decode($result,true);
		    //var_dump($API);
			if ($API) {
				if ($API['S'] == 1) {
					$data['result'] = array(	
					  	'S' => 1,
					  	'M' =>$API['M']
					);
					$this->session->sess_destroy();
				}else{
					$data['result'] = array(	
					  	'S' => 0,
					  	'M' =>$API['M']
					);
				}

			}else{
				$data['result'] = array(	
				  	'S' => 0,
				  	'M' => 'Please try again'
				);
			}

		}

		$this->load->view('layout/header',$data);
		$this->load->view('wealthyreg/index',$data);
		$this->load->view('layout/footer');
	}

	function check_mobile()
	{

		if (isset($_POST['regMob'])){
			$mobileno = $_POST['regMob'];
			$url = 'https://upsmobileapi.azurewebsites.net/Ups_registration_service/check_mobile_number_smsgateway';
			$parameter = array ( 'dev_id'     		=>$this->global_f->dev_id(),
		    				 	 'ip_address' 		=>$this->ip,
		    				 	 'ip' 				=>$this->ip,
		    					 'actionId' 	 	=> _check_mobile_number,
		    					 'mobile_number'    =>$mobileno
			    				  );
								//   var_dump($parameter);
		    $result = $this->curl->call($parameter,$url);
		    $API = json_decode($result,true);
			$return = $API['S']."|".$API['M']."|".$API['M2'];
		 	echo $return;
		 
		}elseif(isset($_POST['regMobpin'])){ //OLD REGISTRATION OTP
			$mobileno = $_POST['regMobforpin'];
			$vcode = $_POST['regMobpin'];
			$url = url;
			$parameter = array ( 'dev_id'     		=>$this->global_f->dev_id(),
		    				 	'ip_address' 		=>$this->ip,
		    					 'actionId' 	 	=> _verify_mobile_number,
		    					 'mobile_number'    =>$mobileno,
		    					 'vcode'			=>$vcode
			    				  );
			// echo json_encode($parameter); die();
		    $result = $this->curl->call($parameter,$url);
		    $API = json_decode($result,true);
			$return = $API['S']."|".$API['M'];
		 	echo $return;

		}elseif(isset($_POST['regMobpin_new'])){ //LATEST REGISTRATION OTP
			$mobileno = "0" . $_POST['regMobforpin'];
			$vcode = $_POST['regMobpin_new'];
			$url = 'https://upsmobileapi.azurewebsites.net/Ups_registration_service/verify_mobile_number_smsgateway';
			$parameter = array ( 'dev_id'     		=>$this->global_f->dev_id(),
								 'ip_address' 		=>$this->ip,
								 'ip' 				=>$this->ip,
								 'actionId' 	 	=> _verify_mobile_number,
								 'mobile_number'    =>$mobileno,
								 'vcode'			=>$vcode
								);
			// echo json_encode($parameter); die();
			$result = $this->curl->call($parameter,$url);
			$API = json_decode($result,true);
			$return = $API['S']."|".$API['M'];
			echo $return;
		}else{
			$this->session->sess_destroy();
			redirect('login/');
		}
	}

	function check_email()
	{

		if (isset($_POST['regE'])){
			$email = $_POST['regE'];
			$url = url;
			$parameter = array ( 'dev_id'     		=>$this->global_f->dev_id(),
		    				 	'ip_address' 		=>$this->ip,
		    					 'actionId' 	 	=> _check_email,
		    					 'email_address'    =>$email
			    				  );
		    $result = $this->curl->call($parameter,$url);
		    $API = json_decode($result,true);
			$return = $API['S']."|".$API['M'];
		 	echo $return;
	
		}elseif(isset($_POST['regEpin'])){
			$email = $_POST['regEforpin'];
			$vcode = $_POST['regEpin'];
			$url = url;
			$parameter = array ( 'dev_id'     		=>$this->global_f->dev_id(),
		    				 	'ip_address' 		=>$this->ip,
		    					 'actionId' 	 	=> _verify_email,
		    					 'email_address'    =>$email,
		    					 'vcode'			=>$vcode
			    				  );
		    $result = $this->curl->call($parameter,$url);
		    $API = json_decode($result,true);
			$return = $API['S']."|".$API['M'];
		 	echo $return;	
		}else{
			$this->session->sess_destroy();
			redirect('login/');
		}

	}


}