<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Socialregistration extends CI_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->user = $this->session->userdata('user');
	    $this->session->userdata('socialinfo');
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
		
		    $social = $this->session->userdata('socialinfo');
			$error = $this->session->userdata('error');

			$INPUT_POST =$this->input->post(null,true);
			$data['social'] = $social;
		  
			if($social['fbcheck'] == 'user is existing'){
				$url = 'https://mobileapi.unified.ph/ups_social_login/social_registration';
				
				$parameter = array(
					'device_id'   => $this->global_f->dev_id(),
					'ip'          =>$this->ip,
					'actionId' 	  => 'ups_social_login/social_registration',
					'userid'   	  => $social['fbid'],
					'companyGroup'=> 'UPS',
					'platform'	  => PLATFORM,
				);

	
				$result = $this->curl->call($parameter,$url);
				$API = json_decode($result,true);
				
				
                if ($API) {
					if($API['S'] == 2){

                        $this->session->set_userdata('userfb',$API['D']);
						$user = $this->session->userdata('userfb');

						$url2 = 'https://mobileapi.unified.ph/ups_social_login';
					
						
						$parameter2 = array(
							'device_id'   => $this->global_f->dev_id(),
							'ip'          => $this->ip,
							'username'    => $user['USERNAME'],
							'password'    => $user['PASSWORD'],
							'actionId' 	  => 'ups_social_login',
							'appid' 	  => APPID,
							'appver'	  => APPVER,
							'platform'	  => PLATFORM,
							'flag'		  => FLAG
						);
                        
						
						$result2 = $this->curl->call($parameter2,$url2);
				        $API2 = json_decode($result2,true);
						
						if($API2){
                           if($API2['S'] == 1){
							 
								$this->session->set_userdata('user',$API2);
								$this->user = $this->session->userdata('user');
								$this->session->set_flashdata('announcepopup', '1');	
								redirect('/Main');
						   }
						   else{
								$data['result2'] = array(
									'S' => 0,
									'M' =>$API['M']
								);
                                echo "<script>alert(".$result2['M'].")</script>";
						   }
						}

						else{
							$data['result2'] = array(
								'S' => 0,
								'M' => 'No Data'
							);
							echo "<script>alert(".$result2['M'].")</script>";
						}
				
						
					}
					else{
						$data['result'] = array(	
							'S' => 0,
							'M' =>$API['M']
						);
						echo "<script>alert(".$result['M'].")</script>";
					}
					
			    }
				else{
					$data['result'] = array(	
						'S' => 0,
						'M' => 'No Data'
					);
					echo "<script>alert(".$result['M'].")</script>";
				}
				
				
			}
		
			else if(null !== $this->input->post('btnFBReg')){
				$url = 'https://mobileapi.unified.ph/ups_social_login/social_registration';
				
				$parameter = array(
					'device_id'     => $this->global_f->dev_id(),
					'ip' => $this->ip,
					'actionId' 	  => 'ups_social_login/social_registration',
					'userid'   	  => $INPUT_POST['fbid'],
					'username'    => $INPUT_POST['inputUsername'],
					'password'    => $INPUT_POST['inputPassword'],
					'companyGroup'=> 'UPS',
					'firstName'   => $INPUT_POST['inputFirstname'],
					'lastName'    => $INPUT_POST['inputLastname'],
					'middleName'  => $INPUT_POST['inputMiddlename'],
					'platform'	  => PLATFORM,
					'mobileNumber'=> $INPUT_POST['inputMobileNo'],
					'emailAddress'=> $INPUT_POST['inputEmail'], 
					'Transpass'   => $INPUT_POST['inputTranspass']
				); 

		
				$result = $this->curl->call($parameter,$url);
				$API = json_decode($result,true);
			   
				// print_r($parameter);
				// die();
				if ($API) {
					if ($API['S'] == 1) {
						$data['result'] = array(	
							'S' => 1,
							'M' =>$API['M']
						);

						$this->session->set_userdata('userfb',$API['D']);
						$user = $this->session->userdata('userfb');

						$url2 = 'https://mobileapi.unified.ph/ups_social_login';
					    
						
						$parameter2 = array(
							'device_id'   => $this->global_f->dev_id(),
							'ip'          => $this->ip,
							'username'    => $user['USERNAME'],
							'password'    => $user['PASSWORD'],
							'actionId' 	  => 'ups_social_login',
							'appid' 	  => APPID,
							'appver'	  => APPVER,
							'platform'	  => PLATFORM,
							'flag'		  => FLAG
						);
            	
						$result2 = $this->curl->call($parameter2,$url2);
				        $API2 = json_decode($result2,true);

						if($API2){
                           if($API2['S'] == 1){
							
								$this->session->set_userdata('user',$API2);
								$this->user = $this->session->userdata('user');
								redirect('/Main');
						   }
						}
						else{
							$data['result2'] = array(
								'S' => 0,
						        'M' =>$API2['M']
							);
							$resmsg = $API2['M'];
							echo "<script>alert($resmsg);</script>";
							redirect(BASE_URL().'Socialregistration/'.'fbconnect/'.$parameter['userid']);
						}
						
					}
					
					else{
						$data['result'] = array(	
							'S' => 0,
							'M' =>$API['M']
						);
						$resmsg = $API2['M'];
						echo "<script>alert($resmsg)</script>";
						redirect(BASE_URL().'Socialregistration/'.'fbconnect/'.$parameter['userid']);
					}
				    

					
			    }
				else{
					$data['result'] = array(	
						'S' => 0,
						'M' => 'Failed loading...'
					);
					
					echo "<script>alert($resmsg)</script>";
					
				}
	     	}
			 $this->load->view('layout/header',$data);
			 $this->load->view('socialregistration/retailer_socialregister',$data);
			 $this->load->view('layout/footer');

			
	}

	public function fbconnect($fbid)
	{
		if(null !== $fbid){
			$url = 'https://mobileapi.unified.ph/ups_social_login/check_fbid';
			// $url = url;
			$parameter = array(
				'device_id'     => $this->global_f->dev_id(),
				'actionId' 	 => 'ups_social_login/check_fbid',
				'ip_address' => $this->ip,
				'userid'   	 => $fbid
			); 

			$result = $this->curl->call($parameter,$url);
			$API = json_decode($result,true);
    
			if ($API) {		
				if ($API['M'] === 'User ID already exists') {
				 
					$data['result'] = array(
						'S' => 1,
						'M' =>$API['M']
					);
					$data['fbcheck'] = 'user is existing';
					$data['fbid'] = $fbid;

                    // $this->load->view('layout/header',$data);
					// $this->load->view('socialregistration/retailer_socialregister',$data);
					// $this->load->view('layout/footer');
					$this->session->set_userdata('socialinfo',$data);
					redirect(BASE_URL().'Socialregistration');
				
				}
				else if($API['M'] == 'Proceed registration'){
					$data['result'] = array(
						'S' => 1,
						'M' =>$API['M']
					);
					
					$data['fbid'] = $fbid;
					$this->session->set_userdata('socialinfo',$data);
					redirect(BASE_URL().'Socialregistration');
					// $this->load->view('layout/header',$data);
					// $this->load->view('socialregistration/retailer_socialregister',$data);
					// $this->load->view('layout/footer');
				}
				else{
					$data['result'] = array(	
						'S' => 0,
						'M' =>$API['M']
					);
				}

			}
			else{
				$data['result'] = array(	
					'S' => 0,
					'M' => 'Login Failed..Please try again'
				);
			}
			// $this->load->view('layout/header',$data);
			// $this->load->view('socialregistration/retailer_socialregister',$data);
			// $this->load->view('layout/footer');
		}
		
		// else {
		// 	$this->session->unset_userdata('socialinfo');
		// 	$this->session->sess_destroy();
		// 	redirect('Login/');
		// }
	}
  
}