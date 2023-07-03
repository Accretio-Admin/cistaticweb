<?php
defined('BASEPATH') OR exit('No direct script access allowed');
set_time_limit(0);
class International_loading_paythem extends CI_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->model('Global_function','global_f');
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
		$this->load->model('Sp_model');

		// $ACC_CONTROL = $this->Sp_model->userprivilege();
		// $this->user['A_CTRL'] = $ACC_CONTROL['A_CTRL'];

		// $this->session->set_userdata('user',$this->user);
	}

	public function index()
	{
		// ini_set('max_execution_time', 2000);
		

		if ($this->user['A_CTRL']['airtime_loading'] == 1){
			
			$data = array('menu' => 6,
						  'parent'=>'LOADING' );
			
			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['user'] = $this->user;
				$testaccount = substr($data['user']['R'],0,2);

				if($testaccount == 'UF'){
					$data['retailer'] = 1;

				}

			$INPUT_POST=$this->input->post(null,true);	
			
			if($this->input->get('country')=="uae"){
				$country = "uae";
				$code = "UAE";
			}elseif($this->input->get('country')=="qatar"){
				$country = "qatar";
				$code = "QAR";
			}	
			
			$urlBrand = url;
			$parameterBrand =array(	
						'dev_id'    		    =>$this->global_f->dev_id(),
						'actionId' 	 	 		=>"ups_paythem/products",
	    				'regcode'               =>$this->user['R'],
	    				'ip_address'			=>$this->ip,
	    				 $this->user['SKT']   	=>md5($this->user['R'].$this->user['SKT']),
	    				 'country'				=> $country
				    	); 
			
		    $resultBrand = $this->curl->call($parameterBrand,$urlBrand);
		    // var_dump($resultBrand);
		   	$data['Brand'] = json_decode($resultBrand,true);
		   	$data['BrandList'] =$data['Brand']['B'];
		   	$data['ProductList'] =$data['Brand']['P'];
				
			$data['Product'] = null;

		   	if($data['Brand']['S']=="1sasas"){

		   		$urlProduct = url;
				$parameterProduct =array(	
							'dev_id'    		    =>$this->global_f->dev_id(),
							'actionId' 	 	 		=>"ups_paythem/getProductList",
		    				'regcode'               =>$this->user['R'],
		    				'ip_address'			=>$this->ip,
		    				$this->user['SKT']   	=>md5($this->user['R'].$this->user['SKT'])
					    	); 
			
			    $resultProduct = $this->curl->call($parameterProduct,$urlProduct);
			   	$data['Product'] = json_decode($resultProduct,true);
			   	$data['ProductList'] =$data['Product']['R'];
			   //	var_dump($data['Product']);die;
		   	}


		   	if(null !==$this->input->post('btnSubmit')){
		   		
		   		$captcha = $this->session->userdata('captcha');
		   		
				$total=$captcha['code1'] + $captcha['code2'];	
				$sign_captcha = $this->input->post('inputCaptcha');
				
				$captcha_result = $this->global_f->captcha_validate($sign_captcha,$total);
				$this->session->unset_userdata('captcha');
				
				if ($captcha_result === 1 ) {
					
					$urlVoucher = url;

					$url = $country == "uae" ? 'getVouchers' : 'getVouchers_qatar';

					$parameterVou =array(	
						'dev_id'    		    =>$this->global_f->dev_id(),
	    				'regcode'               =>$this->user['R'],
	    				'actionId' 	 	 		=>"ups_paythem/$url",
	    				'mobile'                =>$INPUT_POST['inputRMobile'],
	    				'product_id'			=>$INPUT_POST['selProdPaythem'],
	    				'quantity'				=>1,
	    				'email'					=>$INPUT_POST['inputEmail'],
	    				'ip_address'			=>$this->ip,
	    				'transpass'				=>$INPUT_POST['transpass'],
	    				 $this->user['SKT']   	=>md5($this->user['R'].$this->user['SKT'].$INPUT_POST['transpass'])
					); 
					// var_dump($parameterVou);
				    $resultVou = $this->curl->call($parameterVou,$urlVoucher);
				    // var_dump($resultVou);
				   	$data['API'] = json_decode($resultVou,true);
					
				  	$data['captcha'] = $this->global_f->captcha_code();

				  	if($data['API']['S'] == 1){	

				  		if($data['API']['AB']){ // AED
					  		$this->user['AB'] = $data['API']['AB'];		  	
					  		unset($_SESSION['user']['AB']);
							$_SESSION['user']['AB'] = $data['API']['AB'];

						} elseif($data['API']['QB']){ // QAR
					  		$this->user['QB'] = $data['API']['QB'];		  	
					  		unset($_SESSION['user']['QB']);
							$_SESSION['user']['QB'] = $data['API']['QB'];
						}

						$data['user'] = $this->global_f->get_user_session();

						
				  	}else{
				  		$data['result'] = array(	
										  'S' => 0,
										  'M' =>$data['API']['M']
										  );
				  	}
				  	
				}else{
					
						$data['captcha'] = $this->global_f->captcha_code();
						$data['result'] = array(	
										  'S' => 0,
										  'M' =>"Wrong Security Code!"
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
			
			if($this->input->get('country')=="uae"){
				$this->load->view('loading/international/paythem_uae'); 
			}elseif($this->input->get('country')=="qatar"){
				$this->load->view('loading/international/paythem'); 
			}

			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');	

			}else {
				//$this->session->unset_userdata('user');
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
		
	}


	
	
}