<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL ^ E_WARNING);
class RetailerV2 extends CI_Controller {

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
		$data['result'] = array(	
			'S' => 1,
			'M' => 'Kindly fill-up all of the details below for registration.'
		);

        
		$referralCode = $this->input->get('referral');
        if($referralCode){
            $data['referralCode'] = $referralCode;

            $url = 'https://mobileapi.unified.ph/ups_login/validateReferral';

            $parameter = array(
                'dev_id'      => $this->global_f->dev_id(),
                'ip_address'  => $this->ip,
                'ip' 		  => $this->ip,
                'referral'    => $referralCode
            ); 
    
            $result = $this->curl->call($parameter,$url);
            $data = json_decode($result,true);
            if($data['S'] == 1) {
                $data['referralCode'] = $referralCode;

                $this->load->view('layout/header', $data);
                $this->load->view('retailerV2/index', $data);
                //retailer registration-ADDED BY Sophia for testing of new UI
                // $this->load->view('retailerV2/retailer_registrationV2',$data);
                $this->load->view('layout/footer');
            } else {
                $this->load->view('layout/header', $data);
                $this->load->view('retailerV2/invalidReferral', $data);
                $this->load->view('layout/footer');
            }
        }else{
            $this->session->sess_destroy();
            redirect('Login/');
        }
	}


    function retailer_register()
    {
        $referral = $this->input->post('referralCode');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $mobile = $this->input->post('mobile');
        $email = $this->input->post('email');
        $tpass = $this->input->post('tpass');
        $pmob = $this->input->post('pmob');
        $pcountry = $this->input->post('pcountry');
		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$mname = $this->input->post('mname');

        $parameter = array(
            'dev_id'      => $this->global_f->dev_id(),
            'ip_address'  => $this->ip,
            'actionId' 	  => _retail_registration,
            'username'    => $username,
            'password'	  => $password,
            'email'       => $email, 
            'mobileno'    => '0'.$mobile,
            'transpass'   => $tpass,
            'm_code'      => $pmob,
            'c_code'      => $pcountry,
            'regcode'     => 'RETAILERREGISTRATION',
            'ip' 		  => $this->ip,
            'appid' 	  => APPID,
            'appver'	  => APPVER,
			'fname'       => $fname,
			'mname'       => $mname,
			'lname'       => $lname,
            'referral'    => $referral
        ); 

        $result = $this->curl->call($parameter,url);
		$data = json_decode($result,true);
		echo json_encode($data);
    }

	function check_mobile()
	{
		if (isset($_POST['regMob'])){
			$mobileno = $_POST['regMob'];
			$url = 'https://mobileapi.unified.ph/ups_registration_service/check_mobile_number_smsgateway';
			$parameter = array ( 'dev_id'     		=>$this->global_f->dev_id(),
		    				 	'ip_address' 		=>$this->ip,
		    					 'actionId' 	 	=> _check_mobile_number,
		    					 'mobile_number'    =>$mobileno
			    				  );
		    $result = $this->curl->call($parameter,$url);
		    $API = json_decode($result,true);
			// print_r($parameter);
			// die();
			$return = $API['S']."|".$API['M']."|".$API['M2'];
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
		}elseif(isset($_POST['regMobpin_newr'])){ //LATEST REGISTRATION OTP
			$mobileno = "0" . $_POST['regMobforpin'];
			$vcode = $_POST['regMobpin_newr'];
			$url = 'https://mobileapi.unified.ph/ups_registration_service/verify_mobile_number_smsgateway';
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
		}
		else{
			$this->session->sess_destroy();
			redirect('login/');
		}
	}

}