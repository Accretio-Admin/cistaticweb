<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Online_shop2 extends CI_Controller {

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
		$data = array('menu' => 11,
					 'parent'=>'' );
		
		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;
			$this->load->view('onlineshop2/index',$data);
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
		
	}
	
	// public function malayan_insurance() 
	// {
	// 	$data = array('menu' => 11,
	// 				  'parent'=>'' );
	// 	$INPUT_POST=$this->input->post(null,true);		
	// 	if ($this->user['S'] == 1 && $this->user['R'] !=""){

	// 		if (null !== $this->input->post('btn_submit_malayan')) {

	// 			if ($INPUT_POST['policynum'] == 1) {
	// 				$ADD = '100,000';
	// 				$BA  = '10,000';
	// 				$PRE = '75.00';
	// 				$PC  = '1 (Year)';
	// 			}elseif ($INPUT_POST['policynum'] == 2) {
	// 				$ADD = '60,000';
	// 				$BA  = '6,000';
	// 				$PRE = '55.00';
	// 				$PC  = '1 (Year)';
	// 			}elseif ($INPUT_POST['policynum'] == 3) {
	// 				$ADD = '40,000';
	// 				$BA  = '4,000';
	// 				$PRE = '45.00';
	// 				$PC  = '1 (Year)';
	// 			}elseif ($INPUT_POST['policynum'] == 4) {
	// 				$ADD = '100,000';
	// 				$BA  = '10,000';
	// 				$PRE = '50.00';
	// 				$PC  = '6 (Months)';
	// 			}

	// 			$data['policy'] = array('ADD' => $ADD,'BA'  => $BA,'PRE' => $PRE, 'PC' => $PC);

	// 			$data['info'] = array(
	// 								'policy' 	  => $INPUT_POST['policynum'],
	// 								'fname'  	  => $INPUT_POST['inputFname'],
	// 								'mname' 	  => $INPUT_POST['inputMname'],
	// 								'lname'  	  => $INPUT_POST['inputLname'],
	// 								'bfname'      => $INPUT_POST['inputbFname'],
	// 								'bmname'      => $INPUT_POST['inputbMname'],
	// 								'blname'  	  => $INPUT_POST['inputbLname'],
	// 								'birthdate'   => $INPUT_POST['inputBdate'],
	// 								'occupation'  => $INPUT_POST['inputOccup'],
	// 								'email'  	  => $INPUT_POST['inputEmail']
	// 								  );
	// 			$this->session->set_userdata('info',$data['info']);
	// 			$data['process'] = 1;

	// 		}

	// 		if (null !== $this->input->post('btn_confirm_malayan')) {

	// 			$data['i'] = $this->session->userdata('info');
					

	// 			$url = url;
	// 			$parameter = array(
	// 		    				 'dev_id'     		=>$this->global_f->dev_id(),
			    				 
	// 		    				 'ip_address' 		=>$this->ip,
	// 		    				 'actionId' 	 	=> _insurance,
	// 		    				 'transpass'		=>$INPUT_POST['inputTpass'],
	// 		    				 'regcode'          =>$this->user['R'],
	// 							 'policy'    		=>$data['i']['policy'],
	// 							 'assured_fname'    =>$data['i']['fname'],
	// 							 'assured_mi'    	=>$data['i']['mname'],
	// 							 'assured_lname'    =>$data['i']['lname'],
	// 							 'bene_fname'    	=>$data['i']['bfname'],
	// 							 'bene_mi'    		=>$data['i']['bmname'],
	// 							 'bene_lname'    	=>$data['i']['blname'],
	// 							 'assured_dob'    	=>$data['i']['birthdate'],
	// 							 'assured_occu'    	=>$data['i']['occupation'],
	// 							 'email'    		=>$data['i']['email'],
	// 							 $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($INPUT_POST['inputTpass']))
	// 								);  
	// 		    $result = $this->curl->call($parameter,$url);
	// 		    $API = json_decode($result,true);
			    		    
	// 			if ($API) {
	// 				if ($API['S'] == 1) {
	// 					$data['result'] = array(	
	// 					  	'S'	 => 1,
	// 					  	'M'  =>$API['M'],
	// 					  	'TN' =>$API['TN'],
	// 					  	'RL' =>$API['RL']
	// 					);
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

	// 		$data['user'] = $this->user;
	// 		$this->load->view('layout/header',$data);
	// 		$this->load->view('element/top_header');
	// 		$this->load->view('element/wrapper_header');
	// 		$this->load->view('element/left_panel');
	// 		$this->load->view('onlineshop/malayan_insurance'); 
	// 		$this->load->view('element/wrapper_footer');
	// 		$this->load->view('layout/footer');	
	// 	}else {
	// 		//$this->session->unset_userdata('user');
	// 		$this->session->sess_destroy();
	// 		redirect('Login/');
	// 	}
	// }

	public function buy_codes()
	{
		$data = array('menu' => 11,
					 'parent'=>'' );
		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;

				$url = url;
				$parameter = array(
			    				 'dev_id'     		=>$this->global_f->dev_id(),
			    				 'ip_address' 		=>$this->ip,
			    				 'ip' 				=>$this->ip,
			    				 'actionId' 	 	=> _fetch_buycodes_rate, 
			    				 'regcode'          =>$this->user['R'],
			    				 'package_type'		=> NULL, //NULL OR '' - IF FETCH ALL RATES, 1 - GLOBAL, 2 - PINOY, 3 - SUB DEALER, 4 - VISA RETAILER, ELSE RETAILER
			    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
									);

				$result = $this->curl->call($parameter,$url);
			    $data['result'] = json_decode($result,true);

			if (isset($_POST['btnsubmit'])) {
				$INPUT_POST=$this->input->post(null,true);

				$url = url;
				$parameter = array(
			    				 'dev_id'     		=>$this->global_f->dev_id(),
			    				 'ip_address' 		=>$this->ip,
			    				 'ip' 				=>$this->ip,
			    				 'actionId' 	 	=> _confirm_buycodes,
			    				 'regcode'          =>$this->user['R'],
			    				 'client_country'   =>$INPUT_POST['inputCountry'],
			    				 'client_name'		=>$INPUT_POST['inputClient'],
			    				 'client_email'		=>$INPUT_POST['inputClientemail'],
			    				 'client_mobile'	=>$INPUT_POST['inputMobno'],
			    				 'package_type'		=>$INPUT_POST['inputPackageType'],
			    				 'transpass'		=>$INPUT_POST['inputTpass'],
			    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
									);
				$result = $this->curl->call($parameter,$url);
			    $data['API'] = json_decode($result,true);

			}

			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('onlineshop2/buy_codes2'); 
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');	
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}

}
		