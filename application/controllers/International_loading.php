<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class International_loading extends CI_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->model('Global_function','global_f');
		$this->load->model('Curl_model','curl');
		$this->load->library('session');
		$this->user = $this->session->userdata('user');
	    $IP = $_SERVER['REMOTE_ADDR'];

        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) 
		{
            $IP = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
        }

        $this->ip = $IP;
	  	$this->load->model('Query_model');
	  	$this->load->model('Sp_model');
	  	
	  	if ($this->user['RET'] == 1) 
		{
	    	redirect('Main/');
		}

		if($this->user['USER_KYC'] != 'APPROVED') 
		{
			redirect('Main');
  		}
	}

	public function index()
	{
		if ($this->user['A_CTRL']['airtime_loading'] == 1)
		{
			$data = array('menu' => 6, 'parent'=>'LOADING' );
		
			if ($this->user['S'] == 1 && $this->user['R'] !="")
			{
				$data['user'] = $this->user;
				$testaccount = substr($data['user']['R'],0,2);

				if ($testaccount == 'UF')
				{
					$data['retailer'] = 1;

				}
				$this->load->view('loading/international/index',$data);
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
	
	// public function Sgd_loading()
	// {
	// 	if ($this->user['A_CTRL']['airtime_loading'] == 1){
	// 		$data = array('menu' => 6,
	// 					 'parent'=>'LOADING' );

	// 		if ($this->user['S'] == 1 && $this->user['R'] !=""){
	// 			$data['user'] = $this->user;
	// 			$testaccount = substr($data['user']['R'],0,2);
	// 			if($testaccount == 'UF'){
	// 				$data['retailer'] = 1;
	// 			}

	// 			if (null !==$this->input->post('btnSubmit'))
	// 			{
	// 				$INPUT_POST = $this->input->post(null,true);
					
	// 				$captcha = $this->session->userdata('captcha');
	// 				$total=$captcha['code1'] + $captcha['code2'];	
	// 				$sign_captcha = $this->input->post('inputCaptcha');
					
	// 				$captcha_result = $this->global_f->captcha_validate($sign_captcha,$total);
	// 				$this->session->unset_userdata('captcha');
				
	// 				if ($captcha_result === 1 ) {
	// 					$url = api_url._singtel_loading;
	// 					$parameter =array(	
	// 								'dev_id'    		 	=> $this->global_f->dev_id(),
	// 			    				'regcode'               =>$this->user['R'],
	// 			    				'mobile'                =>$INPUT_POST['inputRMobile'],
	// 			    				'plancode'              =>$INPUT_POST['inputAmount'],
	// 			    				'transpass'             =>$INPUT_POST['inputTpass'],
	// 			    				'ip'					=>$this->ip,
	// 			    				'telco'					=>$INPUT_POST['selNetwork'],
	// 			    				 $this->user['SKT']	    =>md5($this->user['R'].$this->user['SKT'].md5($INPUT_POST['inputTpass']))
	// 						    	); 
					
	// 				    $result = $this->curl->call($parameter,$url);
	// 				   	$data['result'] = json_decode($result,true);
	// 				   	var_dump($data['result']);
					   	
	// 				 	if ($data['result']['SB']  != "") {
	// 					 	$this->user['SB'] = $data['result']['SB'];
	// 						$data['user'] = $this->global_f->get_user_session();
	// 					 } 

	// 				  	$data['captcha'] = $this->global_f->captcha_code();
	// 				}else{
	// 						$data['captcha'] = $this->global_f->captcha_code();
	// 						$data['result'] = array(	
	// 											  'S' => 0,
	// 											  'M' =>"Wrong Security Code!!"
	// 										  );
	// 					}
	// 			}else {
	// 						$data['result'] = array(	
	// 											  'S' =>"",
	// 											  'M' =>""
	// 											  );
	// 				$data['captcha'] = $this->global_f->captcha_code();

	// 			}
	// 			$this->load->view('layout/header',$data);
	// 			$this->load->view('element/top_header');
	// 			$this->load->view('element/wrapper_header');
	// 			$this->load->view('element/left_panel');
	// 			$this->load->view('loading/international/sgd_loading'); 
	// 			$this->load->view('element/wrapper_footer');
	// 			$this->load->view('layout/footer');	
	// 		}else {
	// 			//$this->session->unset_userdata('user');
	// 			$this->session->sess_destroy();
	// 			redirect('Login/');
	// 		}
	// 	}else {
	// 		//$this->session->unset_userdata('user');
	// 		//$this->session->sess_destroy();
	// 		redirect('Main/');
	// 	}
	// }

	public function etisalat()
	{
		if ($this->user['A_CTRL']['airtime_loading'] == 1)
		{ 
			$data = array('menu' => 6, 'parent'=>'LOADING' );

			if ($this->user['S'] == 1 && $this->user['R'] !="")
			{
				$data['user'] = $this->user;
				$testaccount = substr($data['user']['R'],0,2);
				if($testaccount == 'UF')	$data['retailer'] = 1;
				
				$INPUT_POST=$this->input->post(null,true);	
			
				$urlBrand = url;

				$parameterBrand =array(	
					'dev_id' => $this->global_f->dev_id(),
					'actionId' => "ups_airtime_loading/etisalat_products_live",
					'regcode' => $this->user['R'],
					'ip_address' => $this->ip,
					$this->user['SKT'] => md5($this->user['R'].$this->user['SKT']),
				);

				$resultBrand = $this->curl->call($parameterBrand,$urlBrand);

				$data['Brand'] = json_decode($resultBrand,true);
				$data['BrandList'] =$data['Brand']['T'];
				$data['ProductList'] =$data['Brand']['P'];
				$data['Product'] = null;

		   		if (null !== $this->input->post('btnSubmit')) {
					$captcha = $this->session->userdata('captcha');
					$total=$captcha['code1'] + $captcha['code2'];	
					$sign_captcha = $this->input->post('inputCaptcha');
					$captcha_result = $this->global_f->captcha_validate($sign_captcha,$total);
					$this->session->unset_userdata('captcha');
				
					if ($captcha_result === 1 ) 
					{
						$url = url;
						$parameter = array(	
							'dev_id' => $this->global_f->dev_id(),
							'regcode' => $this->user['R'],
							'mobile' => $_POST['inputRMobile'],
							'plancode' => $_POST['inputProductCode'],
							'transpass' => $_POST['inputTpass'],
							'mobile' => $_POST['inputRMobile'],
							'email' => $_POST['inputEmail'],
							'email2' => $_POST['inputEmail2'],
							'actionId' => _newEtisalat_loading_confirmation,
							'ip_address' => $this->ip,
							$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'])
						); 
		
						$result = $this->curl->call($parameter,$url);
					
						$data['result'] = json_decode($result,true);
						
						$data['captcha'] = $this->global_f->captcha_code();

						if ($data['result']['AB'] != "") 
						{
							$this->user['AB'] = $data['result']['AB'];
							$data['user'] = $this->global_f->get_user_session();
							$data['result']['EA']=$_POST['inputEmail'];
						} 
						else
						{
							$data['result'] = array('S' => 0, 'M' =>$data['result']['M']);
						}
					}
					else
					{
					
						$data['captcha'] = $this->global_f->captcha_code();
						$data['result'] = array('S' => 0, 'M' =>"Wrong Security Question!");
					}
				}
				else 
				{
					$data['result'] = array('S' => "", 'M' => "");
					$data['captcha'] = $this->global_f->captcha_code();
				}

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('loading/international/etisalat_loading'); 
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


	public function Sgd_loading_new()
	{

		if ($this->user['A_CTRL']['airtime_loading'] == 1){
			
			$data = array('menu' => 6, 'parent'=>'LOADING' );
			
			if ($this->user['S'] == 1 && $this->user['R'] !="")
			{
				$data['user'] = $this->user;
				$testaccount = substr($data['user']['R'],0,2);

				if ($testaccount == 'UF')
				{
					$data['retailer'] = 1;
				}
				
				$INPUT_POST=$this->input->post(null,true);	
			
				$urlBrand = url;

				$parameterBrand =array(	
					'dev_id' => $this->global_f->dev_id(),
					'actionId' => "ups_airtime_loading/sgd_products_live",
					'regcode' => $this->user['R'],
					'ip_address' => $this->ip,
					$this->user['SKT'] => md5($this->user['R'].$this->user['SKT']),
				); 
			
				$resultBrand = $this->curl->call($parameterBrand,$urlBrand);
				$data['Brand'] = json_decode($resultBrand,true);
				$data['BrandList'] =$data['Brand']['T'];
				$data['ProductList'] =$data['Brand']['P'];
				$data['Product'] = null;

		   		if (null !==$this->input->post('btnSubmit')) 
				{
		   		
					$captcha = $this->session->userdata('captcha');
					
					$total=$captcha['code1'] + $captcha['code2'];	
					$sign_captcha = $this->input->post('inputCaptcha');
					
					$captcha_result = $this->global_f->captcha_validate($sign_captcha,$total);
					$this->session->unset_userdata('captcha');
					
					if ($captcha_result === 1 ) 
					{
						
						$url = url;
						$parameter =array(	
							'dev_id' => $this->global_f->dev_id(),
							'regcode' => $this->user['R'],
							'mobile' => $_POST['inputRMobile'],
							'plancode' => $_POST['inputProductCode'],
							'transpass' => $_POST['inputTpass'],
							'email' => $_POST['inputEmail'],
							'actionId' => _sgd_loading_confirmation,
							'ip_address' => $this->ip,
							$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'])
						); 
		
						$result = $this->curl->call($parameter,$url);

						$data['result'] = json_decode($result,true);

						
						$data['captcha'] = $this->global_f->captcha_code();

						if ($data['result']['SB'] != "") 
						{
							$this->user['SB'] = $data['result']['SB'];
							$data['user'] = $this->global_f->get_user_session();
							$data['result']['EA']=$_POST['inputEmail'];
						} 
						else
						{
							$data['result'] = array('S' => 0, 'M' =>$data['result']['M']);
						}
					}
					else
					{
						
						$data['captcha'] = $this->global_f->captcha_code();
						$data['result'] = array('S' => 0, 'M' =>"Wrong Security Question!");
					}
		   		}
				else 
				{
					$data['result'] = array('S' => "", 'M' => "");
					$data['captcha'] = $this->global_f->captcha_code();
				}

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				// $this->load->view('loading/international/sgd_loading_new',$data); 
				$this->load->view('hotels/hotelundermaintenance',$data); 
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
			$this->session->sess_destroy();
			redirect('Login/');
		}
		
	}

	function hkd_loading_validation() 
	{
		$captcha = $this->session->userdata('captcha');
		$total=$captcha['code1'] + $captcha['code2'];

		$captcha_result = $this->global_f->captcha_validate($_POST['sign_captcha'],$total);

		$this->session->unset_userdata('captcha');

		if ($captcha_result === 1 ) 
		{
			
			$parameter = array(	
				'dev_id' => $this->global_f->dev_id(),
				'regcode' => $this->user['R'],
				'mobile' => $_POST['mobile'],
				'email' => $_POST['email'],
				'plancode' => $_POST['plancode'],
				'ip_address' => $this->ip,
				'actionId' => _hkd_loading_validation,
				$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'])
			); 				
	
		    $result = $this->curl->call($parameter,url);
		   	$API = json_decode($result,true);

			if($API['S'] == 1)
			{
				$message = array('S' => "1", 'M' =>'Item has stock.');
				$captcha = $this->global_f->captcha_code();
			} 
			else
			{
				$message = array('S' => "0", 'M' => $API['M']);
			}
		}
		else
		{
			
			$captcha = $this->global_f->captcha_code();
			$message = array('S' =>"0", 'M' =>"Wrong Security Code!!");
		}

		echo json_encode($message);
	}

	function hkd_loading_confirmation() 
	{
		if(isset($_POST['btnConfirm'])) 
		{

			$INPUT_POST = $this->input->post(null,true);
			$url = url;
			$parameter =array(	
				'dev_id' => $this->global_f->dev_id(),
				'regcode' => $this->user['R'],
				'mobile' => $_POST['mobile'],
				'plancode' => $_POST['plancode'],
				'transpass' => $_POST['transpass'],
				'email' => $_POST['email'],
				'actionId' =>_hkd_loading_confirmation,
				'ip_address' => $this->ip,
				$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'])
			); 

			$result = $this->curl->call($parameter,$url);
			$results = json_decode($result,true);

			if($results['S'] == 1)
			{
				$message = array(	
					'S' => 1,
					'M' => $results['M'],
					'TN' => $results['TN'],
					'URL' => $results['URL']
				);
			} 
			else
			{
				$message = array(	
					'S' => 0,
					'M' => $results['M']
				);
			}

			if ($results['HKD']  != "") 
			{
				$this->user['HKD'] = $results['HKD'];
				$this->global_f->get_user_session();
			} 
				
		} 
		else 
		{
			$message = array(	
				'S' => "0",
				'M' => "Invalid input. Please try again."
			);
		}

		echo json_encode($message);
	}

	public function hkd_loading()
	{
		if ($this->user['A_CTRL']['airtime_loading'] == 1)
		{ 
			$data = array('menu' => 6, 'parent'=> 'LOADING');

			if ($this->user['S'] == 1 && $this->user['R'] != "")
			{
				$data['user'] = $this->user;
				$testaccount = substr($data['user']['R'], 0, 2);

				if($testaccount == 'UF')
				{
					$data['retailer'] = 1;
				}

				$url = url;

				$parameter =array(
					'dev_id' => $this->global_f->dev_id(),
					'regcode' => $this->user['R'],
					'actionId' => _fetch_hkd_denom,
					'ip_address' => $this->ip,
					$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
		    	); 

			    $result = $this->curl->call($parameter,$url);
			   	$API = json_decode($result,true);
			    $data['denom'] = $API['P_DATA'];

			    $data['captcha'] = $this->global_f->captcha_code();

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('loading/international/hkd_loading'); 
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
}