<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SocialRegistration extends CI_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->user = $this->session->userdata('user');
	    $this->load->model('Global_function','global_f');
	    $this->load->model('Curl_model','curl');

	    $IP = $_SERVER['REMOTE_ADDR'];

        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
            $IP = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
        }

        $this->ip = $IP;
	  	$this->load->model('Query_model');
	}


	public function index()
	{	

		$data['socialinfo'] = $this->session->userdata('socialinfo');	
		if(null !== $data['socialinfo']){

			if($data['socialinfo']['requestSite'] == 'https://www.upsexpress.com.ph/'){$requestType = 1;} else{$requestType = 2;}

					$data['result'] = array(	
					  	'S' => 1,
					  	'M' => 'Thanks for logging in to Facebook, '.str_replace('%20',' ',$data['socialinfo']['fbname']).'.<br>Kindly fill-up all of the details below for registration.'
					);

			$INPUT_POST =$this->input->post(null,true);
			if (null !== $this->input->post('btnFBReg')){

				$url = url;
			    $parameter = array(
			    				'dev_id'      => $this->global_f->dev_id(),
			    				'ip_address'  => $this->ip,
			    				'actionId' 	  => _social_registration,
			    				'uni_id'   	  => $INPUT_POST['fbid'],
			    				'name'	 	  => $INPUT_POST['fbname'],
			    				'requestType' => $requestType, //1 UPS, 2 GPRS
			    				'email'       => $INPUT_POST['inputEmail'], 
			    				'mobileno'    => $INPUT_POST['inputMobileNo'],
			    				'transpass'   => $INPUT_POST['inputTpass'],
			    				'm_code'      => $INPUT_POST['inputPinmobile'],
			    				'e_code'      => $INPUT_POST['inputPinemail'],
			    				'c_code'      => $INPUT_POST['country'],
			    				'ip' 		  => $this->ip,
			    				'platform'	  => PLATFORM,
			    				'appid' 	  => APPID,
			    				'appver'	  => APPVER,
			    				'flag'		  => FLAG
			    			); 
			    $result = $this->curl->call($parameter,$url);
			    $API = json_decode($result,true);
				if ($API) {
					if ($API['S'] == 1) {

						$this->session->set_userdata('user',$API);
						redirect('/main2');

					}elseif ($API['S'] == 99) {

						$data['result'] = $API;
						$data['process'] = 1;

					}else{

						$data['result'] = array(	
						  	'S' => 0,
						  	'M' =>$API['M']
						);
					}
				}else{

					$data['result'] = array(	
					  	'S' => 0,
					  	'M' => 'Login Failed..Please try again'
					);
				}
			}


			if (null !== $this->input->post('btnBack')){

				$this->session->sess_destroy();
				redirect('login2abcdef123/');
			}

			$this->load->view('layout/header',$data);
			$this->load->view('Socialregistration/index',$data);
			$this->load->view('layout/footer');

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');

		}

	}


	public function fbconnect($fbname, $fbid){

			$url = url;
		    $parameter = array(
		    				'dev_id'     => $this->global_f->dev_id(),
		    				'ip_address' => $this->ip,
		    				'actionId' 	 => _social_login,
		    				'uni_id'   	 => $fbid,
		    				'name'	 	 => $fbname,
		    				'ip' 		 => $this->ip,
		    				'platform'	 => PLATFORM,
		    				'appid' 	 => APPID,
		    				'appver'	 => APPVER,
		    				'flag'		 => FLAG
		    			); 

		    $result = $this->curl->call($parameter,$url);
		    $API = json_decode($result,true);
		    if ($API) {		
				if ($API['S'] == 1) {

					$this->session->set_userdata('user',$API);
					redirect('/main2');

					}elseif ($API['S'] == 98) {

					$social_details = array(
									'fbid' => $fbid,
									'fbname' => $fbname, 
									'process' => 98,
									'requestSite' => BASE_URL()
									);
					$this->session->set_userdata('socialinfo',$social_details);
					redirect(BASE_URL().'SocialRegistration/');

					}elseif ($API['S'] == 99) {

						$data['result'] = $API;
						$data['process'] = 1;

					}else{

						$data['result'] = array(	
						  	'S' => 0,
						  	'M' =>$API['M']
						);
					}
			}else{

				$data['result'] = array(	
				  	'S' => 0,
				  	'M' => 'Login Failed..Please try again'
				);
			}

			
		$this->load->view('layout/header',$data);
		$this->load->view('Socialregistration/index',$data);
		$this->load->view('layout/footer');
	}


	function check_mobile()
	{

		if (isset($_POST['regMob'])){
			$mobileno = $_POST['regMob'];
			$url = url;
			$parameter = array ( 'dev_id'     		=>$this->global_f->dev_id(),
		    				 	'ip_address' 		=>$this->ip,
		    					 'actionId' 	 	=> _check_mobile_number,
		    					 'mobile_number'    =>$mobileno
			    				  );
		    $result = $this->curl->call($parameter,$url);
		    $API = json_decode($result,true);
			$return = $API['S']."|".$API['M'];
		 	echo $return;
		 
			
				
		}elseif(isset($_POST['regMobpin'])){
			$mobileno = $_POST['regMobforpin'];
			$vcode = $_POST['regMobpin'];
			$url = url;
			$parameter = array ( 'dev_id'     		=>$this->global_f->dev_id(),
		    				 	'ip_address' 		=>$this->ip,
		    					 'actionId' 	 	=> _verify_mobile_number,
		    					 'mobile_number'    =>$mobileno,
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