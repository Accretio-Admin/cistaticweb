<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Einsurance extends CI_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->model('Curl_model','curl');
		$this->load->library('session');
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
	    $this->load->model('Query_model','q');
	  	$this->load->model('Global_function','global_f');
	  	$this->load->model('Sp_model');

	  	// if ($this->user['RET'] == 1) 
		// {
	    // 	redirect('Main/');
		// }
		if( $this->user['USER_KYC'] != 'APPROVED') 
		{
			redirect('Main');
  		}
	}

	public function index()
	{
		if ($this->user['A_CTRL']['insurance'] == 1)
		{
			$data = array('menu' => 12, 'parent' => 'E-INSURANCE');

			if ($this->user['S'] == 1 && $this->user['R'] != "")
			{
				$data['user'] = $this->user;
				$data['instype'] = $this->input->get('type'); 
				$this->load->view('einsurance/index',$data); 
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


	public function malayan_insurance() 
	{
		if ($this->user['A_CTRL']['insurance'] == 1)
		{
			$data = array('menu' => 12, 'parent'=>'E-INSURANCE' );
			$INPUT_POST=$this->input->post(null,true);		

			if ($this->user['S'] == 1 && $this->user['R'] !="")
			{
				if (null !== $this->input->post('btn_submit_malayan')) 
				{

					if ($INPUT_POST['policynum'] == 1) 
					{
						$ADD = '100,000';
						$BA  = '10,000';
						$PRE = '80.00';
						$PC  = '1 (Year)';
					}
					elseif ($INPUT_POST['policynum'] == 2) 
					{
						$ADD = '60,000';
						$BA  = '6,000';
						$PRE = '55.00';
						$PC  = '1 (Year)';
					}
					elseif ($INPUT_POST['policynum'] == 3) 
					{
						$ADD = '40,000';
						$BA  = '4,000';
						$PRE = '45.00';
						$PC  = '1 (Year)';
					}
					elseif ($INPUT_POST['policynum'] == 4) 
					{
						$ADD = '100,000';
						$BA  = '10,000';
						$PRE = '50.00';
						$PC  = '6 (Months)';
					}

					$data['policy'] = array('ADD' => $ADD,'BA'  => $BA,'PRE' => $PRE, 'PC' => $PC);

					$data['info'] = array(
						'policy' => $INPUT_POST['policynum'],
						'fname' => $INPUT_POST['inputFname'],
						'mname' => $INPUT_POST['inputMname'],
						'lname' => $INPUT_POST['inputLname'],
						'bfname' => $INPUT_POST['inputbFname'],
						'bmname' => $INPUT_POST['inputbMname'],
						'blname' => $INPUT_POST['inputbLname'],
						'birthdate' => $INPUT_POST['inputBdate'],
						'occupation' => $INPUT_POST['inputOccup'],
						'email' => $INPUT_POST['inputEmail']
					);

					$this->session->set_userdata('info',$data['info']);
					$data['process'] = 1;
				}

				if (null !== $this->input->post('btn_confirm_malayan')) 
				{

					$data['i'] = $this->session->userdata('info');
						

					$url = url;
					$parameter = array(
						'dev_id' => $this->global_f->dev_id(),
						'ip_address' => $this->ip,
						'actionId'  => _insurance_test,
						'transpass' => $INPUT_POST['inputTpass'],
						'regcode' => $this->user['R'],
						'policy' => $data['i']['policy'],
						'assured_fname'  => $data['i']['fname'],
						'assured_mi' => $data['i']['mname'],
						'assured_lname' => $data['i']['lname'],
						'bene_fname' => $data['i']['bfname'],
						'bene_mi' => $data['i']['bmname'],
						'bene_lname' => $data['i']['blname'],
						'assured_dob' => $data['i']['birthdate'],
						'assured_occu' =>$data['i']['occupation'],
						'email' => $data['i']['email'],
						$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].$INPUT_POST['inputTpass']),
						'ip' =>$this->ip
					);  
				    $result = $this->curl->call($parameter,$url);
				    $API = json_decode($result,true);
				    
				    
					if ($API) 
					{
						if ($API['S'] == 1) 
						{
							$data['result'] = array(	
							  	'S'	 => 1,
							  	'M'  => $API['M'],
							  	'TN' => $API['TN'],
							  	'RL' => $API['RL']
							);
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

				$data['user'] = $this->user;
				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('einsurance/malayan_insurance');
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
	
	
	public function federal_insurance() 
	{
		if ($this->user['A_CTRL']['insurance'] == 1){
			$data = array('menu' => 15, 'parent' => 'E-INSURANCE' );

			$INPUT_POST=$this->input->post(null, true);		

			if ($this->user['S'] == 1 && $this->user['R'] != "")
			{
				$url = url;

				$parameter = array(
					'dev_id' => $this->global_f->dev_id(),
					'ip_address' => $this->ip,
					'actionId' => _fetch_fpg_options,
					'regcode' => $this->user['R']
				);  

			    $result = $this->curl->call($parameter,$url);
			    $API = json_decode($result,true);
			    $data['result2'] = $API['T_DATA'];

				if (null !== $this->input->post('btn_voucher'))
				{

					$parameter = array(
						'dev_id' => $this->global_f->dev_id(),
						'ip_address' => $this->ip,
						'actionId' => _fetch_voucher_validate,
						'regcode' => $this->user['R'],
						'vc_code' => $INPUT_POST['vcode'],
						$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'])
					);

				    $result = $this->curl->call($parameter,$url);
				    $API = json_decode($result,true);

					$option_array = $data['result2'][$API['P_NO']-1];
					$option_array['coverage_details'] = $option_array['coverage_details'][$API['C_NO']-1];

					$data['option_result'] = $option_array;
					$voucher_code = explode(" is",explode("#", $API['M'])[1]);

				    if ($API['S'] == 1)
					{
				    	$data['vresult'] = array(
							'vcodeon' => 1,
							'voucher_code' => $voucher_code[0],
						);
				    }
					else
					{
				    	$data['vresult'] = array('S' => 0, 'M' => $API['M']);
				    }
				}

				if (null !== $this->input->post('btn_submit_federal')) 
				{
					$data['info'] = array(
						'fname'  => $INPUT_POST['inputFname'],
						'mname' => $INPUT_POST['inputMname'],
						'lname' => $INPUT_POST['inputLname'],
						'bfname' => $INPUT_POST['inputbFname'],
						'bmname' => $INPUT_POST['inputbMname'],
						'blname' => $INPUT_POST['inputbLname'],
						'birthdate' => $INPUT_POST['inputBdate'],
						'occupation' => $INPUT_POST['inputOccup'],
						'email' => $INPUT_POST['inputEmail'],
						'optionId' => $INPUT_POST['fpgOption'],
						'coverage' => $INPUT_POST['fpgVoucher']==1?$INPUT_POST['coverage']:$INPUT_POST['inputCoverage'],
						'address' => $INPUT_POST['inputAddress'],
						'vcodeon' => $INPUT_POST['fpgVoucher'],
						'voucher_code' => $INPUT_POST['voucher_code']
					);
					$this->session->set_userdata('info',$data['info']);
					$data['process'] = 1;
				}

				if (null !== $this->input->post('btn_confirm_federal'))
				{
					$data['i'] = $this->session->userdata('info');
					$coverage = explode("|", $data['i']['coverage']);
					$cusId=null;
					$addCus_url = url;

					$addCus_parameter = array(
						'dev_id' => $this->global_f->dev_id(),
						'ip_address' => $this->ip,
						'actionId' => "coc_mobile/addCustomer",
						'regcode' => $this->user['R'],
						'key' => "25e336ac6c9423d946ba02d19c6a2652",
						'customerDOB' => $data['i']['birthdate'],
						'customerEmail'	=> $data['i']['email'],
						'customerFirstname' => $data['i']['fname'],
						'customerLastname' => $data['i']['lname'],
						'customerMI' => $data['i']['mname'],
						'customerOccupation'=> $data['i']['occupation'],
						'transpass' => $INPUT_POST['inputTpass'],
						'customerAddress' => $data['i']['address'],
						'coverage' => $coverage[0],
						'optionId' => $data['i']['optionId'],
						'Beneficiary' => $data['i']['bfname']." ".$data['i']['bmname']." ".$data['i']['blname'],
						'voucher_code' => $data['i']['voucher_code']
					);

				    $addCus_result = $this->curl->call2($addCus_parameter,$addCus_url);
				  	$addCus_result = json_decode($addCus_result,true);
				  	$API = $addCus_result;
				  	
					if ($API['isHasError'] == "NONE") 
					{
						$data['result'] = array(	
						  	'S' => 1,
						  	'M' => "Successful",
						  	'TN' => $API['TN'],
						  	'RL' => $API['RL']
						);
					}
					else
					{
						$data['result'] = array(	
							'S' => 0,
							'M' =>$API['M']
						);
					}
				}

				$data['user'] = $this->user;
				$data1 = "0";
				if($data1 == "0")
				{
					$this->load->view('layout/header',$data);
					$this->load->view('element/top_header');
					$this->load->view('element/wrapper_header');
					$this->load->view('element/left_panel');
					$this->load->view('hotels/hotelundermaintenance'); 
					$this->load->view('element/wrapper_footer');
					$this->load->view('layout/footer');	
				}
				else
				{
					$this->load->view('layout/header',$data);
					$this->load->view('element/top_header');
					$this->load->view('element/wrapper_header');
					$this->load->view('element/left_panel');
					$this->load->view('einsurance/federal_insurance'); 
					$this->load->view('element/wrapper_footer');
					$this->load->view('layout/footer');	
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

	public function federal_insurance_v2() 
	{
		if ($this->user['A_CTRL']['insurance'] == 1){
			$data = array('menu' => 15, 'parent'=>'E-INSURANCE' );

			$INPUT_POST=$this->input->post(null,true);

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$url =url;

				$parameter = array(
					'dev_id' => $this->global_f->dev_id(),
					'ip_address' => $this->ip,
					'actionId' => _fetch_fpg_options,
					'regcode' => $this->user['R']
				);

			    $result = $this->curl->call($parameter,$url);
			    $API = json_decode($result,true);
			    $data['result2'] = $API['T_DATA'];

				if (null !== $this->input->post('btn_voucher')) 
				{

					$parameter = array(
						'dev_id' => $this->global_f->dev_id(),
						'ip_address' => $this->ip,
						'actionId' => _fetch_voucher_validate,
						'regcode' => $this->user['R'],
						'vc_code' => $INPUT_POST['vcode'],
						$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'])
					); 
					
				    $result = $this->curl->call($parameter,$url);
				    $API = json_decode($result,true);

					$option_array = $data['result2'][$API['P_NO']-1];
					$option_array['coverage_details'] = $option_array['coverage_details'][$API['C_NO']-1];

					$data['option_result'] = $option_array;
					$voucher_code = explode(" is",explode("#", $API[' '])[1]);

				    if($API['S'] == 1)
					{
				    	$data['vresult'] = array(
							'vcodeon' 		=> 1,
							'voucher_code' 	=> $voucher_code[0],
						);
				    }
					else
					{
				    	$data['vresult'] = array(
							'S' => 0,
							'M' => $API['M']
						);
				    }
				}

				if (null !== $this->input->post('btn_continue')) 
				{
					$data['info'] = array(
						'fname' => $INPUT_POST['inputFname'],
						'mname' => $INPUT_POST['inputMname'],
						'lname' => $INPUT_POST['inputLname'],
						'bfname' => $INPUT_POST['inputbFname'],
						'bmname' => $INPUT_POST['inputbMname'],
						'blname' => $INPUT_POST['inputbLname'],
						'birthdate' => $INPUT_POST['inputBdate'],
						'occupation' => $INPUT_POST['inputOccup'],
						'email' => $INPUT_POST['inputEmail'],
						'optionId' => $INPUT_POST['fpgOption'],
						'coverage' => $INPUT_POST['fpgVoucher'] == 1 ? $INPUT_POST['coverage'] : $INPUT_POST['inputCoverage'],
						'address' => $INPUT_POST['inputAddress'],
						'vcodeon' => $INPUT_POST['fpgVoucher'],
						'voucher_code' => $INPUT_POST['voucher_code']
					);

					$this->session->set_userdata('info',$data['info']);
					$data['process'] = 1;
				}

				if (null !== $this->input->post('btn_confirm_federal'))
				{
					$data['i'] = $this->session->userdata('info');
					$coverage = explode("|", $data['i']['coverage']);
					$parameter = array(
						'dev_id' => $this->global_f->dev_id(),
						'ip_address'  => $this->ip,
						'actionId' => _fetch_create_coc,
						'key' => "25e336ac6c9423d946ba02d19c6a2652",
						'regcode' => $this->user['R'],
						'coverage' => $coverage[0],
						'optionId' => $data['i']['optionId'],
						'customerFirstname' => $data['i']['fname'],
						'customerMI' => $data['i']['mname'],
						'customerLastname' => $data['i']['lname'],
						'Beneficiary' => $data['i']['bfname']." ".$data['i']['bmname']." ".$data['i']['blname'],
						'customerDOB' => $data['i']['birthdate'],
						'customerOccupation'=> $data['i']['occupation'],
						'customerEmail' => $data['i']['email'],
						'transpass'	=> $INPUT_POST['inputTpass']
					);

				    $addCus_result = $this->curl->call($parameter, url);

				  	$addCus_result = json_decode($addCus_result,true);

				  	$API = $addCus_result;
				  	
				
					if ($API['isHasError'] == "NONE") 
					{
						$data['result'] = array(	
							'S' => 1,
							'M' => "Successful",
							'TN' => $API['TN'],
							'RL' => $API['RL']
						);
					}
					else
					{
						$data['result'] = array(	
							'S' => 0,
							'M' =>$API['M']
						);
					}
				}

				$data['user'] = $this->user;
				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('einsurance/modal_federal');
				$this->load->view('einsurance/federal_insurance_v2'); 
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

	function ajax_federal_coverage()
	{
		$url = url;
		$parameter = array(
			'dev_id' => $this->global_f->dev_id(),
			'ip_address' => $this->ip,
			'actionId' => _fetch_fpg_rate,
			'regcode' => $this->user['R'],
			'optionid' => $this->input->post('option')
		);  

		$result = $this->curl->call($parameter,$url);
		$result = json_decode($result,true);
		echo json_encode($result['T_DATA']);
	}

	function ajax_validate_voucher()
	{
		$url = url;
		$parameter = array(
			'dev_id' => $this->global_f->dev_id(),
			'ip_address' => $this->ip,
			'actionId' => 'coc_mobile/validate_voucher2',
			'regcode' => $this->user['R'],
			'vcode' => $this->input->post('vcode')
		);

		$result = $this->curl->call($parameter,$url);
		$result = json_decode($result,true);
		echo json_encode($result);
	}

	function ajax_confirm_fpg()
	{
		$option = $this->input->post('option');
		$coverage = $this->input->post('coverage');
		$fname = $this->input->post('fname');
		$mname = $this->input->post('mname');
		$lname = $this->input->post('lname');
		$bday = $this->input->post('bday');
		$occu = $this->input->post('occu');
		$email = $this->input->post('email');
		$number = $this->input->post('number');
		$add = $this->input->post('add');
		$paymenttype = $this->input->post('paymentType');
		$bfname = $this->input->post('bfname');
		$bmname = $this->input->post('bmname');
		$blname = $this->input->post('blname');
		$pass = $this->input->post('pass');
		$voucher_code = $this->input->post('voucher_code');

		$parameter = array(
			'dev_id' => $this->global_f->dev_id(),
			'ip_address' => $this->ip,
			'actionId' => _fetch_create_coc,
			'key' => "25e336ac6c9423d946ba02d19c6a2652",
			'regcode' => $this->user['R'],
			'coverage' => $coverage,
			'optionId' => $option,
			'customerFirstname' => $fname,
			'customerMI' => $mname,
			'customerLastname' => $lname,
			'Beneficiary' => $bfname." ".$bmname." ".$blname,
			'customerDOB' => $bday,
			'customerOccupation' => $occu,
			'customerEmail' => $email,
			'customerNumber' => $number,
			'customerAddress' => $add,
			'paymentType' => $paymenttype,
			'transpass'	=> $pass,
			'voucher_code'	=> $voucher_code
		);

		$result = $this->curl->call($parameter, url);
		echo $result;
	}

	public function ctpl_insurance() 
	{
		if ($this->user['A_CTRL']['insurance'] == 1)
		{
			$data = array('menu' => 16, 'parent' => 'E-INSURANCE' );
			$data['date'] = date('Y-m-d H:i:s');
		
			if ($this->user['S'] == 1 && $this->user['R'] !="")
			{
				$data['user'] = $this->user;
				$INPUT_POST=$this->input->post(null,true);	
				$url = url;

				$parameter = array(
					'dev_id' => $this->global_f->dev_id(),
					'ip_address' => $this->ip,
					'actionId' => _federal_ctpl_mvlist,
					'regcode' => $this->user['R'],
	            	$this->user['SKT']  => md5($this->user['R'].$this->user['SKT']) 
				);  

			    $api_result = $this->curl->call($parameter,$url);
			  	$result = json_decode($api_result,true);
			  	$data['result2'] = $result['T_DATA'];

			  	$data['currentyear'] = $result['Current_Year'];
				$data['month'] = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

				if (null !== $this->input->post('btn_submit_federal'))
				{
					$inception = explode(' ', $INPUT_POST['input_inceptiondate']);
					$imonth = date('m', strtotime($inception[0]));
					$idate = strtotime($imonth.'/01/'.$inception[1]);
					$inceptDate = date('Y/m/d', $idate);

					if($INPUT_POST['rdItem']== '1'){ $inceptiondate = $INPUT_POST['input_year'].'/'.sprintf('%02s', $INPUT_POST['input_month']).'/01';} else{ $inceptiondate = $inceptDate; }
					$mv = explode('|', $INPUT_POST['selMVtypeCTPL']);
					$vehicle = explode('|', $INPUT_POST['selTenureCTPL']);

					$data['desc'] = array(	
					  	'vehicleDesc'  =>$vehicle[1],
					  	'mvDesc' =>$mv[1]
					);

					$expiry = explode(' ', $INPUT_POST['input_expirydate']);
					$month = date('m', strtotime($expiry[0]));
					$date = strtotime($month.'/01/'.$expiry[1]);
					$expirydate = date('Y/m/d', $date);

					$parameter = array(
	    				'dev_id' => $this->global_f->dev_id(),
	    				'ip_address' => $this->ip,
	    				'actionId' => _federal_ctpl_validate,
	    				'regcode' => $this->user['R'],						 
	                    'regtype' => $INPUT_POST['rdItem']=="1"?"N":"R",
	                    'plateno' => $INPUT_POST['input_plateno']!=""?$INPUT_POST['input_plateno']:"",
	                    'mvfileno' => $INPUT_POST['input_mvfileno']!=""?str_replace("-", "",$INPUT_POST['input_mvfileno']):"",
	                    'engineno' => $INPUT_POST['input_engineno']!=""?$INPUT_POST['input_engineno']:"",
	                    'chassisno'	=> $INPUT_POST['input_chassisno']!=""?$INPUT_POST['input_chassisno']:"",
	                    'inceptiondate'	=> $inceptiondate,                    
	                    'expirydate' => $expirydate,
	                    'mvtype' => $vehicle[0],
	                    'mvpremtype' => $mv[0],
	                    'assuredname' => $INPUT_POST['input_assuredname'],
	                    'assuredtin' => $INPUT_POST['input_assuredtin']=="000-000-000-000"?"999-999-999-999":$INPUT_POST['input_assuredtin'],
	                    'assuredemail' => $INPUT_POST['input_assuredemail'],
						'yearmodel' => $INPUT_POST['input_yrmodel'],
						'company' => $INPUT_POST['input_company'],
						'bodytype' => $INPUT_POST['input_bodytype'],
						'bodymake' => $INPUT_POST['input_bodymake'],
						'bodycolor'	=> $INPUT_POST['input_bodycolor'],
						'authcap' => $INPUT_POST['input_capacity'],
						'unladenweight' => $INPUT_POST['input_weight'],
						'assuredaddress' => $INPUT_POST['input_assuredaddress'],
	                    $this->user['SKT'] => md5($this->user['R'].$this->user['SKT'])
					); 

				    $api_result = $this->curl->call($parameter,$url);
				  	$array = json_decode(json_encode($api_result), true);
				  	$result = json_decode($array,true);

					if ($result['S'] == 1) {
						$data['results'] = array(	
						  	'S'  => 1,
						  	'M'  =>$result['M']
						);

						$data['pricing'] = array(	
						  	'FPG_PREMIUM' => $result['FPG_PREMIUM'],
						  	'NET_PRICE' => $result['NET_PRICE'],
						  	'L' => $result['L'],
						  	'D' => $result['D']

						);

						$data['process'] = '1';
					  	$data['result'] = $parameter;

					}
					else 
					{
						$data['result'] = array(	
						  	'S' => 0,
						  	'M' =>$result['M']
						);

					}

				}

				if (null !== $this->input->post('btn_confirm_federal'))
				{

					$formData = json_decode($INPUT_POST['inputDetails'],true);
					$pricing = json_decode($INPUT_POST['inputpricing'],true);
					$data['desc'] = json_decode($INPUT_POST['inputDetails2'],true);

					$parameter = array(
	    				'dev_id' => $this->global_f->dev_id(),
	    				'ip_address' => $this->ip,
	    				'actionId' => _federal_ctpl_register,
	    				'regcode' => $this->user['R'],						 
	                    'regtype' => $formData['regtype'],
	                    'plateno' => $formData['plateno'],
	                    'mvfileno' => $formData['mvfileno'],
	                    'engineno' => $formData['engineno'],
	                    'chassisno'	=> $formData['chassisno'],
	                    'inceptiondate'	=> $formData['inceptiondate'],                    
	                    'expirydate' => $formData['expirydate'],
	                    'mvtype' => $formData['mvtype'],
	                    'mvpremtype' => $formData['mvpremtype'],
	                    'assuredname' => $formData['assuredname'],
	                    'assuredtin' => $formData['assuredtin'],
	                    'assuredemail' => $formData['assuredemail'],
						'yearmodel' => $formData['yearmodel'],
						'company' => $formData['company'],
						'bodytype' => $formData['bodytype'],
						'bodymake' => $formData['bodymake'],
						'bodycolor'	=> $formData['bodycolor'],
						'authcap' => $formData['authcap'],
						'unladenweight' => $formData['unladenweight'],
						'assuredaddress' => $formData['assuredaddress'],
	                    'transpass' => $INPUT_POST['inputTpass'],
	                    $this->user['SKT'] => md5($this->user['R'].$this->user['SKT'].md5($INPUT_POST['inputTpass']))
					);

				    $api_result = $this->curl->call($parameter,$url);
				  	$API = json_decode(json_encode($api_result), true);
				  	$result= json_decode($API,true);

					if ($result['S'] == 1) 
					{
						$data['result'] = array(	
							'S' => 1,
							'M' => $result['M'],
							'TN' => $result['TN'],
							'AR_URL' => $result['AR_URL'],
							'COC_URL' => $result['COC_URL']
						);
					}
					else 
					{

						$data['results'] = array(	
							'S' => 0,
							'M' =>$result['M']
						);

						$data['process'] = '1';
						$data['result'] = $formData;
						$data['pricing'] = array(	
							'FPG_PREMIUM' => $pricing['FPG_PREMIUM'],
							'NET_PRICE' => $pricing['NET_PRICE'],
							'L' => $pricing['L'],
							'D' => $pricing['D']
						);
						
					}
				}

				$data1 = "0";
				if ($data1 == "0") 
				{
					$this->load->view('layout/header',$data);
					$this->load->view('element/top_header');
					$this->load->view('element/wrapper_header');
					$this->load->view('element/left_panel');
					$this->load->view('hotels/hotelundermaintenance'); 
					$this->load->view('element/wrapper_footer');
					$this->load->view('layout/footer');	
				}
				else
				{
					$this->load->view('layout/header',$data);
					$this->load->view('element/top_header');
					$this->load->view('element/wrapper_header');
					$this->load->view('element/left_panel');
					$this->load->view('einsurance/federal_ctpl'); 
					$this->load->view('element/wrapper_footer');
					$this->load->view('layout/footer',$data);
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

	public function maxicare_insurance()
	{
		if ($this->user['A_CTRL']['insurance'] == 1)
		{
			$data = array('menu' => 16, 'parent' => 'E-INSURANCE' );
			$data['date'] = date('Y-m-d H:i:s');
		
			if ($this->user['S'] == 1 && $this->user['R'] !="")
			{
				$data['user'] = $this->user;
				$url = url;

				$parameter = array(
					'dev_id' => $this->global_f->dev_id(),
					'actionId' => 'ups_maxicare_api/get_products',
					'regcode' => $this->user['R'],
					'ip_address' => $this->ip
				);  

			    $response = $this->curl->call($parameter, $url);
			  	$data['products'] = json_decode($response, true)['D'];

				$this->load->view('layout/header', $data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('einsurance/maxicare_insurance'); 
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer', $data);	
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

	public function maxicare_prod_details()
	{
		$url = url;

		$parameter = array(
			'dev_id' => $this->global_f->dev_id(),
			'actionId' => 'ups_maxicare_api/product_details',
			'id' => $this->input->post('id'),
			'regcode' => $this->user['R'],
			'ip_address' => $this->ip
		);  

		$response = $this->curl->call($parameter, $url);
		echo json_encode(json_decode($response, true));
	}

	public function maxicare_transac()
	{
		$url = url;

		$parameter = array(
			'dev_id' => $this->global_f->dev_id(),
			'actionId' => 'ups_maxicare_api/transac',
			'regcode' => $this->user['R'],
			'product_code' => $this->input->post('product_code'),
			'plan_code' => $this->input->post('plan_code'),
			'service' => $this->input->post('service'),
			'ip_address' => $this->ip,
			'product_name' => $this->input->post('product_name'),
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'birth_date' => $this->input->post('birth_date'),
			'occupation' => $this->input->post('occupation'),
			'contact_number' => $this->input->post('contact_number'),
			'email' => $this->input->post('email'),
			'address' => $this->input->post('address'),
			'amount' => $this->input->post('amount'),
			'trans_pass' => $this->input->post('trans_pass'),
			$this->user['SKT']	=> md5($this->user['R'] . $this->user['SKT'] . md5($this->input->post('trans_pass')))
		);  

		$response = $this->curl->call($parameter, $url);
		echo json_encode(json_decode($response, true));
	}

	public function maxicare_v2()
	{
		if ($this->user['A_CTRL']['insurance'] == 1)
		{
			$data = array('menu' => 16, 'parent' => 'E-INSURANCE' );
			$data['date'] = date('Y-m-d H:i:s');
		
			if ($this->user['S'] == 1 && $this->user['R'] !="")
			{
				$data['user'] = $this->user;
				$url = url;

				$parameter = array(
					'dev_id' => $this->global_f->dev_id(),
					'actionId' => 'ups_maxicare_api/get_products',
					'regcode' => $this->user['R'],
					'ip_address' => $this->ip
				);  

			    $response = $this->curl->call($parameter, $url);
			  	$data['products'] = json_decode($response, true)['D'];

				$this->load->view('layout/header', $data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('einsurance/maxicare_v2/maxicare'); 
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer', $data);	
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