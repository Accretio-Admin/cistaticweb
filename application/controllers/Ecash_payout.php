<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ecash_payout extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Curl_model','curl');
		$this->load->model('Check_transaction', 'check_trans');
		
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
	    $this->load->model('Query_model');
	  	$this->load->model('Global_function','global_f');
	  	$this->load->model('Sp_model');


	  	if ($this->user['USER_KYC'] != 'APPROVED' && $this->user['RET'] != 1) 
		{
		  	redirect('Main');
		}
	}

	public function index()
	{
		if (($this->user['A_CTRL']['remittance'] == 1 && $this->user['R'] != 'G5457340') || $this->user['RET'] == 1)
		{

			$data = array('menu' => 3, 'parent'=>'REMITTANCE' );

			 if ($this->user['S'] == 1 && $this->user['R'] != "")
			 {

				$data['user'] = $this->user;

				$parameter = array(
					'dev_id' => $this->global_f->dev_id(),
					'actionId' => _fetch_pending_remitpayout_ids, 
					'ip_address' => $this->ip, 
					'regcode' => $this->user['R'],
					$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
				); 

			    $result = $this->curl->call($parameter,url);
			   	$API = json_decode($result,true);

			   	if ($API['S'] === 0)
			   	{
					$data['process'] = array ('P' => 1, 'S' => 0, 'M' => $API['M']);
			   	}
			   	else
			   	{
					$data['process'] = array ('P' => 1, 'S' => 1, 'M' =>$API['M']);
					$data['API'] = $API;
			   	}
			   	
				if (substr($this->user['R'], 0, 3) == 'GWL') //For Wealthylifestyle
				{
					$data['exceed_ec_padala'] = $this->check_trans->transCount($this->user['R'], 61)['S'];
					$data['exceed_iremit'] = $this->check_trans->transCount($this->user['R'], 38)['S'];
					$data['exceed_cebuana'] = $this->check_trans->transCount($this->user['R'], 82)['S'];
					$data['exceed_wu'] = $this->check_trans->transCount($this->user['R'], 154)['S'];
					$data['exceed_sm_to_ec'] = $this->check_trans->transCount($this->user['R'], 3)['S'];
					$data['exceed_transfast'] = $this->check_trans->transCount($this->user['R'], 39)['S'];
					$data['exceed_moneygram'] = $this->check_trans->transCount($this->user['R'], 33)['S'];
					$data['exceed_gcash'] = $this->check_trans->transCount($this->user['R'], 14)['S'];
					
					$this->load->view('remittance/ecash_payout/gwl_index', $data);
				}
				else
				{
					$this->load->view('remittance/ecash_payout/index', $data);
				}	
			}
			else 
			{
			 	$this->session->sess_destroy();
			 	redirect('Login/');
			}

		}else {
			//$this->session->unset_userdata('user');
			//$this->session->sess_destroy();
			redirect('Main/');
		}
		
	}

		public function approved_id()
	{
		if ($this->user['A_CTRL']['remittance'] == 1 && $this->user['R'] != 'G5457340'){

		$data = array('menu' => 3,
				     'parent'=>'REMITTANCE' );

			 if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;

					$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId'         	=> _fetch_approved_remitpayout_ids, 
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
				$this->load->view('remittance/ecash_payout/index_approved',$data);
				
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

		public function revoked_id()
	{
		if ($this->user['A_CTRL']['remittance'] == 1 && $this->user['R'] != 'G5457340'){

		$data = array('menu' => 3,
				     'parent'=>'REMITTANCE' );

			 if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;

					$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId'         	=> _fetch_revoked_remitpayout_ids, 
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
				$this->load->view('remittance/ecash_payout/index_revoked',$data);
				
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

		public function agree_user_agreement_post(){

				$regcode = $this->input->post('regcode');

				$data['user'] = $this->user;

				$parameter =array(
					'dev_id'     		=> $this->global_f->dev_id(),
					'actionId'         	=> _payout_agree_user_agreement, 
					'ip_address'		=> $this->ip,
    				'regcode'           => $this->user['R'],
    				$this->user['SKT']  =>  md5($this->user['R'].$this->user['SKT'])
			    	); 

			    $result = $this->curl->call($parameter,url);
			   	$result = json_decode($result);
			   	echo json_encode($result);
	}

		public function smartmoneytoecash()
	{
		if ($this->user['A_CTRL']['remittance'] == 1){

		$data = array('menu' => 3,
					 'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$this->check_trans->gwlCheckTransLimit(3); //FOR WEALTHY LIFESTYLE

				$data['user'] = $this->user;

				$parameter = array(
					'dev_id'         =>$this->global_f->dev_id(),
					'ip_address'     =>$this->ip,
					'ip'         	 =>$this->ip,
					'actionId'       => _payout_check_user_agreement,
					'regcode'        =>$this->user['R'],
					$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
					);
				$result = $this->curl->call($parameter,url);
				$check_agreement = json_decode($result,true);

				

				if($check_agreement['S'] == 2){
					$data['process'] = 999;
					$data['content'] = $check_agreement['Content'];
					$data['regcode'] = $this->user['R'];
				}
					
					if (isset($_POST['btnSmartmoneyCheck'])){
						$url = url;

						$parameter = array(
									'dev_id'    	   => $this->global_f->dev_id(),
									'actionId' 	 	   => _payout_smartmoney_check,
									'ip_address'	   =>$this->ip,
									'regcode'          =>$this->user['R'],
									'transpass'		   =>$this->input->post('inputTpass'),
									'reference_no'	   =>$this->input->post('inputReferenceNo'),
									'amount'	       =>$this->input->post('inputAmount'),
									'smartmoney_no'	   =>$this->input->post('inputSmartMoneyNo'),
									$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
						);
					    $result = $this->curl->call($parameter,$url);
					    $data['API'] = json_decode($result,true);
					    

					
						$data['row'] = array(
									'inputTpass'		   =>$this->input->post('inputTpass'),
									'inputReferenceNo'	   =>$this->input->post('inputReferenceNo'),
									'inputSmartMoneyNo'	   =>$this->input->post('inputSmartMoneyNo')
										);


					}elseif (isset($_POST['btnSmartmoneyConfirm'])){
	 			
		 				$url = url;
						$parameter =array(
									'dev_id'     		=> $this->global_f->dev_id(),
									'actionId' 	 		=> _payout_smartmoney_confirm,
				    				'regcode'   		=>$this->user['R'],
				    				'transpass' 		=>$this->input->post('inputTpass'),
				    				'reference_no'	    =>$this->input->post('inputReferenceNo'),
				    				'smartmoneyno'		=>$this->input->post('inputSmartMoneyNo'),
				    				'idnumber'			=>$this->input->post('inputIDNo'),	
				    				'idtype'			=>$this->input->post('selvalidID'),
				    				'ip_address'		=>$this->ip,
				    				'Amount'			=>$this->input->post('inputAmount'),
				    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
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
				$this->load->view('remittance/ecash_payout/smartmoney_to_ecash');
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
   	###################### POD #########################################
  	public function add_new_pod(){
		$BENENAME =   $this->input->post('inputbene');
		$SENDERNAME = $this->input->post('inputsender');
		$TRACKNO =    $this->input->post('inputtrno1');
		$CEBID =    $this->input->post('ceb_id');
		$IDREGISTRY =    $this->input->post('id_detail_id3');
		$TRACKNO =    $this->input->post('inputtrno1');
		$DATETODAY =  date('d-m-Y-h-m-s');

		if ($_FILES['inputpod']['error'] == 0){
			if($_FILES['inputpod']['size'] < 2*MB) {
				$url = $_FILES["inputpod"]["tmp_name"];

				if($_FILES['inputpod']['size'] > 1*MB)
				{
					$old_size = $_FILES['inputpod']['size'];
					$urltmp = sys_get_temp_dir().'/tmp.jpg';
					$filename = $this->compress_image($_FILES["inputpod"]["tmp_name"], $urltmp, 75);
					$new_size = filesize($urltmp);
				
					if($new_size < $old_size)
					{
						$url = $urltmp;
					}
				}

				$image_id = md5($this->user['R'].$BENENAME.$SENDERNAME.$TRACKNO.$DATETODAY) . '_web.jpg';

				if (false) { //ftp
					$ch = curl_init();
					$localfile = $url;
					$fp = fopen($localfile, 'r');
					curl_setopt($ch, CURLOPT_URL, 'ftp://'.ftp_server_radius.':800/Disbursement/'.$image_id);
					curl_setopt($ch, CURLOPT_USERPWD, "argel:argel_argel!!!");
					curl_setopt($ch, CURLOPT_UPLOAD, 1);
					curl_setopt($ch, CURLOPT_INFILE, $fp);
					curl_setopt($ch, CURLOPT_INFILESIZE, filesize($localfile));
					curl_exec ($ch);
					$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
					$error_no = curl_errno($ch);
					curl_close ($ch);

					$attachment = 'ftp://frequest:frequest@'.ftp_server_radius.':800/Disbursement/'.$image_id;

					//$data['user'] = $this->user;

					//$url = 'http://10.10.1.201/mobile_api/index.php/cebuana/add_new_pod';
					// $url = 'http://resourceapi.globalpinoyremittance.com:8092/ups_cebuana_service/add_new_pod';
					$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId'         	=> 'ups_cebuana_service/add_new_pod', 
						'regcode'		    => $this->user['R'],
						'ip_address'		=> $this->ip,
						'benename'			=> $BENENAME, 
						'sendername'		=> $SENDERNAME,
						'trackno'			=> $TRACKNO,
						'idregistry'		=> $IDREGISTRY,
						'cubuanaid'		    => $CEBID,
						'attachment'		=> $attachment,
						$this->user['SKT']  => md5($this->user['R'].$this->user['SKT'])
					); 

					$result = $this->curl->call($parameter,url); 
					$result = json_decode($result);
					echo json_encode($result);
				} else { //sftp
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
						CURLOPT_POSTFIELDS => array('file'=> new CURLFILE($localfile),'file_location' => 'disbursement','regcode' => $this->user['R'],'email' => '123','ext_name' => '.jpg'),
					));
					
					$response = curl_exec($curl); 
					curl_close($curl);
					$upload_response = json_decode($response,true);

					if ($upload_response['S'] == 1) {
						$filename = $upload_response['F'];
						$sftp_dir = '/v1-sftp/remittance/'.$filename;
						//$data['user'] = $this->user;
						//$url = 'http://10.10.1.201/mobile_api/index.php/cebuana/add_new_pod';
						// $url = 'http://resourceapi.globalpinoyremittance.com:8092/ups_cebuana_service/add_new_pod';
						$parameter =array(
							'dev_id'     	=> $this->global_f->dev_id(),
							'actionId'      => 'ups_cebuana_service/add_new_pod2', 
							'regcode'		=> $this->user['R'],
							'ip_address'	=> $this->ip,
							'benename'		=> $BENENAME, 
							'sendername'	=> $SENDERNAME,
							'trackno'		=> $TRACKNO,
							'idregistry'	=> $IDREGISTRY,
							'cubuanaid'		=> $CEBID,
							'sftp_dir'		=> $sftp_dir,
							$this->user['SKT']  => md5($this->user['R'].$this->user['SKT'])
						); 

						$result = $this->curl->call($parameter,url); 
						$result = json_decode($result);
						echo json_encode($result);

					} else {//unable to upload
						echo json_encode($upload_response);
					}
				}
			}else{
				$result = array("S"=>0,'M'=>"Invalid Image Size, Should be less than 2MB");
				echo json_encode($result);
			}
		}else{
			$result = array("S"=>0,'M'=>"Invalid Image Size, Should be less than 2MB");
			echo json_encode($result);
		}
    
    //echo json_encode(array('S'=>1,'M'=>'Hello'));


  	}


   public function gettrackingno(){

    //$url = 'http://10.10.1.201/mobile_api/index.php/cebuana/gettrno';
    // $url = 'http://resourceapi.globalpinoyremittance.com:8092/ups_cebuana_service/gettrno';
    $parameter =array(
          	'dev_id'     		=> 	$this->global_f->dev_id(),
          	'actionId' 	 		=> 'ups_cebuana_service/gettrno',
            'regcode'   		=>	$this->user['R'],
            'trackno' 			=>	$this->input->post('inputtrno'),
            'ip_address'     	=>	$this->ip
            // 'ip'         	 	=>	$this->ip
        );
     $result = $this->curl->call($parameter,url);
     //$data = array('S'=>1,"M"=>'Hello');
     echo $result;

   }


   public function fetch_table(){
    //$url = 'http://10.10.1.201/mobile_api/index.php/cebuana/fetch_pod';
    // $url = 'http://resourceapi.globalpinoyremittance.com:8092/ups_cebuana_service/fetch_pod';
    $parameter =array(
          	'dev_id'     		=> 	$this->global_f->dev_id(),
          	'actionId' 	 		=> 	'ups_cebuana_service/fetch_pod',
          	'regcode'   		=>	$this->user['R'],
          	'status'   			=>	$this->input->post('category'),
          	'trackno' 			=>	$this->input->post('searchpod'),
          	'ip_address'     	=>	$this->ip
			// 'ip'         	 	=>	$this->ip
        );
     $result = $this->curl->call($parameter,url);

     //$data = array('S'=>1,"M"=>'Hello');
     echo $result;
   }

   ###################### END OF POD ##################################
   ########################## Activation #############################

   public function fetch_cebuana_activation(){
    $this->load->model('Global_function','global_f');
    $url = url;
    $parameters = array(
        'dev_id' => $this->global_f->dev_id(),
        'actionId' => 'ups_ecash_payout/check_payout_activation', 
        'regcode' => $this->user['R'],
        'ip_address' => $this->ip,
        $this->user['SKT'] => md5($this->user['R'].$this->user['SKT'])
    ); 
    if($this->user['L'] == 1 || $this->user['L'] == 6){
      $results = $this->curl->call($parameters, $url);
    }else{
      $results = json_encode(array('S'=>1,'U'=>$this->user['L'] ));
    }
    // print_r($results);die();
    // echo json_encode($results);
    echo $results;
   }

   public function activate_cebuana_service() {
    $results['S'] = 2;
    $this->load->model('Global_function','global_f');
    $postVal = $this->input->post('transactionPassword');
    $url = url;
    $parameters = [
        'dev_id' => $this->global_f->dev_id(),
        'actionId' => 'ups_ecash_payout/cebuana_payout_activation', 
        'regcode' => $this->user['R'],
        'ip_address' => $this->ip,
        'transactionPassword' => $postVal,
        $this->user['SKT'] => md5($this->user['R'].$this->user['SKT']),
    ];
    $results = $this->curl->call($parameters, $url);

    $results2 = json_decode($results, true);
    	// print_r($results2);die();

    // print_r($results2);
    if ($results2['S'] == 1) {
        $this->user['EC'] = $results2['EC'];
        $this->session->set_userdata('user', $this->user);
    }
    
    echo $results;
}

#################### END OF ACTIVATION ######################
		public function ecashpadala()
	{
		if ($this->user['A_CTRL']['remittance'] == 1 || $this->user['RET'] == 1){

		$data = array('menu' => 3,
					  'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$this->check_trans->gwlCheckTransLimit(61); //FOR WEALTHY LIFESTYLE

				$data['user'] = $this->user;	

				$parameter = array(
					'dev_id'         =>$this->global_f->dev_id(),
					'ip_address'     =>$this->ip,
					'ip'         	 =>$this->ip,
					'actionId'       => _payout_check_user_agreement,
					'regcode'        =>$this->user['R'],
					$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
					);
				$result = $this->curl->call($parameter,url);
				$check_agreement = json_decode($result,true);

				

				if($check_agreement['S'] == 2){
					$data['process'] = 999;
					$data['content'] = $check_agreement['Content'];
					$data['regcode'] = $this->user['R'];
				}


					if (isset($_POST['btnEcashPadalaCheck'])){
						$url = url;

						$parameter = array(
									'dev_id'     	   => $this->global_f->dev_id(),
									'ip_address'	   =>$this->ip,
									'actionId' 	 	   => _payout_ecashpadala_check,
									'regcode'          =>$this->user['R'],
									'transpass'		   =>$this->input->post('inputTpass'),
									'reference_no'	   =>$this->input->post('inputReferenceNo'),
									$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
						);
					   	$result = $this->curl->call($parameter,$url);
					    $data['API'] = json_decode($result,true);

					    // print_r($data['API']);die;

					    if($data['API']['principal_amount'] > 5000)
					    {
					    	$data['process'] = 2;
					    }

						$data['row'] = array(
									'inputTpass'		   =>$this->input->post('inputTpass'),
									'inputReferenceNo'	   =>$this->input->post('inputReferenceNo')
									);

					}elseif (isset($_POST['btnEcashPadalaConfirm'])){
		 				$url = url;
						
		 				// print_r($_POST);die;

						if($this->input->post('selvalidID1'))
						{
							$parameter =array(
									'dev_id'    	    => $this->global_f->dev_id(),
									'actionId' 	 	    => _payout_ecashpadala_confirm2,
				    				'regcode'   		=>$this->user['R'],
				    				'transpass' 		=>$this->input->post('inputTpass'),
				    				'reference_no'	    =>$this->input->post('inputReferenceNo'),
				    				'trackingno'		=>$this->input->post('inputTN'),
				    				'amount'			=>$this->input->post('inputAmount'),
				    				'sender_name'		=>$this->input->post('inputSenderName'),
				    				'sender_address'	=>$this->input->post('inputSenderAddress'),
				    				'sender_mobile'		=>$this->input->post('inputMobileNo'),
				    				'sender_email'		=>$this->input->post('inputSenderEmail'),
				    				'bene_name'			=>$this->input->post('inputBeneficiaryName'),
				    				'bene_address'		=>$this->input->post('inputBeneficiaryAddress'),
				    				'bene_mobile'		=>$this->input->post('inputBeneficiaryMobile'),
				    				'bene_email'		=>$this->input->post('inputBeneficiaryEmail'),
				    				'sender_id'			=>$this->input->post('inputSenderID'),
				    				'bene_id'			=>$this->input->post('inputBeneficiaryID'),	
				    				'ip_address'		=>$this->ip,
				    				'idone'				=>$this->input->post('selvalidID1'),
				    				'idtwo'				=>$this->input->post('selvalidID2'),
				    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
			    				    );
						 	$result = $this->curl->call($parameter,$url);
							$data['result'] = json_decode($result,true);
						 	$this->user['EC'] = $data['result']['EC'];
							$data['user'] = $this->global_f->get_user_session();
						}
						else
						{
							$data['result'] = array (
											  'S'=>0,
											  'M'=>'Selected IDs should be different and is required.');
						}

					}

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_payout/ecash_padala');
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


		public function iremit()
	{
		if ($this->user['A_CTRL']['remittance'] == 1){

		$data = array('menu' => 3,
					  'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$this->check_trans->gwlCheckTransLimit(38); //FOR WEALTHY LIFESTYLE

				$data['user'] = $this->user;

				$parameter = array(
					'dev_id'         =>$this->global_f->dev_id(),
					'ip_address'     =>$this->ip,
					'ip'         	 =>$this->ip,
					'actionId'       => _payout_check_user_agreement,
					'regcode'        =>$this->user['R'],
					$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
					);
				$result = $this->curl->call($parameter,url);
				$check_agreement = json_decode($result,true);

				

				if($check_agreement['S'] == 2){
					$data['process'] = 999;
					$data['content'] = $check_agreement['Content'];
					$data['regcode'] = $this->user['R'];
				}

					if (isset($_POST['btnRemitCheck'])){
						$url = url;

						$endpoint = "";
						$deployOwnPayout = 1;
						//set ownpayout
						if ($deployOwnPayout == 1) {
								$endpoint = _payout_iremit_check_own_payout;
						} else {
							$endpoint = _payout_iremit_check;
						}

						$parameter =array(
									'dev_id'     	   => $this->global_f->dev_id(),
									'ip_address'	   =>$this->ip,
									'actionId' 	 	   =>  $endpoint,
									'regcode'          =>$this->user['R'],
									'transpass'		   =>$this->input->post('inputTpass'),
									'reference_no'	   =>$this->input->post('inputReferenceNo'),
									$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
						);
					    $result = $this->curl->call($parameter,$url);

					    $data['API'] = json_decode($result,true);
					    $bene = explode(',', $data['API']['Beneficiary']);
					    // print_r($data['API']);
					    $benelname = trim($bene[0]);
					    $benefname = trim($bene[1]);

				    	if($data['API']['Amount'] > 5000)
					    {
					    	$data['process'] = 2;
					    }

						$data['row'] = array(
									'inputTpass'		   =>$this->input->post('inputTpass'),
									'inputReferenceNo'	   =>$this->input->post('inputReferenceNo'),
									'benefname'	   		   =>$benefname,
									'benelname'	  		   =>$benelname
									);

					}elseif (isset($_POST['btnRemitConfirm'])){
		 				$url = url;

		 				if($this->input->post('selvalidID1'))
		 				{
							$parameter =array(
										'dev_id'    	    => $this->global_f->dev_id(),
										'actionId' 	 	    => _payout_iremit_confirm2,
					    				'regcode'   		=>$this->user['R'],
					    				'transpass' 		=>$this->input->post('inputTpass'),
					    				'reference_no'	    =>$this->input->post('inputReferenceNo'),
					    				'bene_name'	   		=>$this->input->post('inputBeneficiaryName'),
					    				'amount'	    	=>$this->input->post('inputAmount'),
					    				'ip'				=>$this->ip,
					    				'ip_address'		=>$this->ip,
				    					'idone'				=>$this->input->post('selvalidID1'),
					    				'idtwo'				=>$this->input->post('selvalidID2'),
					    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
				    				    );
						 	$result = $this->curl->call($parameter,$url);
							$data['result'] = json_decode($result,true);
		 				}
						else
						{
							$data['result'] = array (
											  'S'=>0,
											  'M'=>'Selected IDs should be different and is required.');
						}

	 				}

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_payout/iremit');
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

		public function fetch_transfast_valid_id(){

			$data['user'] = $this->user;
			
				$parameter =array(
					'dev_id'     		=> $this->global_f->dev_id(),
					'actionId'         	=> _url_payout_transfast_fetch_ids, 
					'ip_address'		=> $this->ip,
    				'regcode'           => $this->user['R'],
    				$this->user['SKT']  =>  md5($this->user['R'].$this->user['SKT'])
			    	); 

			    $result = $this->curl->call($parameter,url);
			   	$result = json_decode($result);
			   	echo json_encode($result);
		}

		public function fetch_transfast_countries(){

			$CCODE = $this->input->post('countrycode');
			$data['user'] = $this->user;
			
				$parameter =array(
					'dev_id'     		=> $this->global_f->dev_id(),
					'actionId'         	=> _url_payout_transfast_fetch_country, 
					'ip_address'		=> $this->ip,
					'country_code'		=> $CCODE, 
    				'regcode'           => $this->user['R'],
    				$this->user['SKT']  =>  md5($this->user['R'].$this->user['SKT'])
			    	); 

			    $result = $this->curl->call($parameter,url);
			   	$result = json_decode($result);
			   	echo json_encode($result);
		}

		public function fetch_transfast_states(){

			$CCODE = $this->input->post('countrycode');
			$data['user'] = $this->user;
			
				$parameter =array(
					'dev_id'     		=> $this->global_f->dev_id(),
					'actionId'         	=> _url_payout_transfast_fetch_states, 
					'ip_address'		=> $this->ip,
					'country_code'		=> $CCODE, 
    				'regcode'           => $this->user['R'],
    				$this->user['SKT']  =>  md5($this->user['R'].$this->user['SKT'])
			    	); 

			    $result = $this->curl->call($parameter,url);
			   	$result = json_decode($result);
			   	echo json_encode($result);
		}
		
		public function fetch_transfast_cities(){

			$CCODE = $this->input->post('countrycode');
			$data['user'] = $this->user;
			
				$parameter =array(
					'dev_id'     		=> $this->global_f->dev_id(),
					'actionId'         	=> _url_payout_transfast_fetch_cities, 
					'ip_address'		=> $this->ip,
					'country_code'		=> $CCODE, 
    				'regcode'           => $this->user['R'],
    				$this->user['SKT']  =>  md5($this->user['R'].$this->user['SKT'])
			    	); 

			    $result = $this->curl->call($parameter,url);
			   	$result = json_decode($result);
			   	echo json_encode($result);
		}
		public function fetch_transfast_occupation(){

			$NAME = $this->input->post('benename');
			$data['user'] = $this->user;
			
				$parameter =array(
					'dev_id'     		=> $this->global_f->dev_id(),
					'actionId'         	=> _url_payout_transfast_fetch_occupation, 
					'ip_address'		=> $this->ip,
					'bene_name'			=> $NAME, 
    				'regcode'           => $this->user['R'],
    				$this->user['SKT']  =>  md5($this->user['R'].$this->user['SKT'])
			    	); 

			    $result = $this->curl->call($parameter,url);
			   	$result = json_decode($result);
			   	echo json_encode($result);
		}

		public function fetch_transfast_remitPurpose(){

			$cc = $this->input->post('countrycode');
			$data['user'] = $this->user;
			
				$parameter =array(
					'dev_id'     		=> $this->global_f->dev_id(),
					'actionId'         	=> _url_payout_transfast_fetch_remitPurpose, 
					'ip_address'		=> $this->ip,
					'country_code'		=> $cc, 
    				'regcode'           => $this->user['R'],
    				$this->user['SKT']  =>  md5($this->user['R'].$this->user['SKT'])
			    	); 

			    $result = $this->curl->call($parameter,url);
			   	$result = json_decode($result);
			   	echo json_encode($result);
		}


		public function fetch_secondary_ids(){

			$data['user'] = $this->user;

			
				$parameter =array(
					'dev_id'     		=> $this->global_f->dev_id(),
					'actionId'         	=> _fetch_remitpayout_secondary_ids, 
					'ip_address'		=> $this->ip,
    				'regcode'           => $this->user['R'],
    				$this->user['SKT']  =>  md5($this->user['R'].$this->user['SKT'])
			    	); 

			    $result = $this->curl->call($parameter,url);
			   	$result = json_decode($result);
			   	echo json_encode($result);
		}

	


		public function transfast()
	{
		// ini_set('display_errors', 1);
		// ini_set('display_startup_errors', 1);
		// error_reporting(E_ALL);
		if ($this->user['A_CTRL']['remittance'] == 1){

		$data = array('menu' => 3,
					  'parent'=>'REMITTANCE' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$this->check_trans->gwlCheckTransLimit(39); //FOR WEALTHY LIFESTYLE

			$data['user'] = $this->user;

				$parameter = array(
					'dev_id'         =>$this->global_f->dev_id(),
					'ip_address'     =>$this->ip,
					'ip'         	 =>$this->ip,
					'actionId'       => _payout_check_user_agreement,
					'regcode'        =>$this->user['R'],
					$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
					);
				$result = $this->curl->call($parameter,url);
				$check_agreement = json_decode($result,true);

				

				if($check_agreement['S'] == 2){
					$data['process'] = 999;
					$data['content'] = $check_agreement['Content'];
					$data['regcode'] = $this->user['R'];
				}

					if (isset($_POST['btnTransfastCheck'])){
						$url = url;

						$endpoint = "";
						$deployOwnPayout = 1;
						//set deployOwnPayout = 1 to deploy ownpayout
						if ($deployOwnPayout == 1) {
								$endpoint = _payout_transfast_nyb_check_own_payout;
						} else {
							$endpoint = _url_payout_transfast_nyb_check_new;
						}

						$parameter =array(
									'dev_id'     	   => $this->global_f->dev_id(),
									'actionId' 	 	   => $endpoint,
									'ip_address'	   => $this->ip,
									'regcode'          =>$this->user['R'],
									'transpass'		   =>$this->input->post('inputTpass'),
									'reference_no'	   =>$this->input->post('inputReferenceNo'),
									'sender_name'      =>$this->input->post('inputSenderName'),
									'bene_name'        =>$this->input->post('inputBeneName'),
									'amount'     	   =>$this->input->post('inputAmount'),		
									$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
						);
						// print_r($parameter);exit();
						$result = $this->curl->call($parameter, $url);
						$data['API'] = json_decode($result,true);

				    	// if($data['API']['Amount'] > 5000)
					    // {
					    // 	$data['process'] = 2;
					    // }

						$data['row'] = array(
									'inputTpass'		   =>$this->input->post('inputTpass'),
									'inputReferenceNo'	   =>$this->input->post('inputReferenceNo')
									);

					}elseif(isset($_POST['btnConfirmTf'])){
						$url = url;

			 				if($this->input->post('inputBeneaddress') == NULL) {$beneAddress = " ";} else{ $beneAddress = $this->input->post('inputBeneaddress');}
			 				if($this->input->post('inputIdno') == NULL) {$idNo = " ";} else{ $idNo = $this->input->post('inputIdno');}
							if($this->input->post('inputIdType') == NULL) {$idType = " ";} else{ $idType = $this->input->post('inputIdType');}
							if($this->input->post('inputExpDate') == NULL) {$idExpDate = " ";} else{ $idExpDate = $this->input->post('inputExpDate');}
							if($this->input->post('inputCountry') == NULL) {$country = " ";} else{ $country = $this->input->post('inputCountry');}
							if($this->input->post('inputCountryB') == NULL) {$countryb = " ";} else{ $countryb = $this->input->post('inputCountryB');}
							if($this->input->post('inputCities') == NULL) {$city = " ";} else{ $city = $this->input->post('inputCities');}
							if($this->input->post('inputStates') == NULL) {$state = " ";} else{ $state = $this->input->post('inputStates');}
							if($this->input->post('inputMobileNo') == NULL) {$mobno = " ";} else{ $mobno = $this->input->post('inputMobileNo');}
							if($this->input->post('inputDob') == NULL) {$dob = " ";} else{ $dob = $this->input->post('inputDob');}
							if($this->input->post('inputGender') == NULL) {$gender = " ";} else{ $gender = $this->input->post('inputGender');}
							if($this->input->post('inputNational') == NULL) {$nationality = " ";} else{ $nationality = $this->input->post('inputNational');}
							if($this->input->post('inputRel2Sender') == NULL) {$relSender = " ";} else{ $relSender = $this->input->post('inputRel2Sender');}
							if($this->input->post('inputOccup') == NULL) {$occupation = " ";} else{ $occupation = $this->input->post('inputOccup');}
							if($this->input->post('inputRemitPur') == NULL) {$remitPurpose = " ";} else{ $remitPurpose = $this->input->post('inputRemitPur');}
							if($this->input->post('inputTransType') == NULL) {$transType = " ";} else{ $transType = $this->input->post('inputTransType');}

							$parameter =array(
										'dev_id'    	    => $this->global_f->dev_id(),
										'actionId' 	 	    => _url_payout_transfast_nyb_payinvoice_new,
										'ip_address'		=>$this->ip,
										'regcode'   		=>$this->user['R'],
										'transpass'			=>$this->input->post('inputTpassTf'),
										'refno'	   			=>$this->input->post('inputReferenceNo'),
										'TN'				=>$this->input->post('inputTN'), 
										'amount'			=>$this->input->post('inputAmount'),
										'currency'			=>$this->input->post('inputCurrency'),
										'benename'			=>$this->input->post('beneFullName'),
					    				'idnumber'	   		=>$idNo,
					    				'idtype'	    	=>$idType,
					    				'idexpdate'	    	=>$idExpDate,
					    				'beneaddress'	   	=>$beneAddress,
					    				'occupation_id'	   	=>$occupation,
					    				'remit_reason'	   	=>$remitPurpose,
					    				'countrycode'	   	=>$country,
					    				'countrycodeb'	   	=>$countryb,
					    				'state_id'	   		=>$state,
					    				'city_id'	    	=>$city,
										'mobileno'			=>$mobno,
										'dob'				=>$dob,
			    						'nationality'		=>$nationality,
										'gender'			=>$gender,
										'relationToSender'  =>$relSender,
										'type'				=>$transType,
					    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpassTf')))
										);
										
										// echo '<pre>';
										// var_dump($parameter);
										// echo '</pre>';
										// exit();

										$result = $this->curl->call($parameter,$url);
										$data['result'] = json_decode($result,true);
										$this->user['EC'] = $data['result']['EC'];
										$data['user'] = $this->global_f->get_user_session();
										// print_r($data['API']);exit();



						
					}
					
					// elseif (isset($_POST['btnTransfastConfirm'])){
		 			// 	$url = url;

		 			// 	if($this->input->post('selvalidID1'))
		 			// 	{
		 			// 		if($this->input->post('inputBenetelno') == NULL) {$Benetelno = " ";} 
			 		// 		elseif($this->input->post('inputBenetelno') == 0) {$Benetelno = " ";}
			 		// 		else{ $Benetelno = $this->input->post('inputBenetelno');}

			 		// 		if($this->input->post('inputSessionID') == NULL) {$sessionId = " ";} else{ $sessionId = $this->input->post('inputSessionID');}
			 		// 		if($this->input->post('inputCurrency') == NULL) {$currency = " ";} else{ $currency = $this->input->post('inputCurrency');}
			 		// 		if($this->input->post('inputBeneficiaryName') == NULL) {$beneName = " ";} else{ $beneName = $this->input->post('inputBeneficiaryName');}
			 		// 		if($this->input->post('inputBeneaddress') == NULL) {$beneAddress = " ";} else{ $beneAddress = $this->input->post('inputBeneaddress');}
			 		// 		if($this->input->post('inputIDType') == NULL) {$idType = " ";} else{ $idType = $this->input->post('inputIDType');}
			 		// 		if($this->input->post('inputIDNo') == NULL) {$idNo = " ";} else{ $idNo = $this->input->post('inputIDNo');}
			 		// 		if($this->input->post('inputTransType') == NULL) {$transType = " ";} else{ $transType = $this->input->post('inputTransType');}
					// 		$parameter =array(
					// 					'dev_id'    	    => $this->global_f->dev_id(),
					// 					'actionId' 	 	    => _payout_transfast_nyb_confirm,
					//     				'regcode'   		=>$this->user['R'],
					//     				'transpass' 		=>$this->input->post('inputTpass'),
					//     				'reference_no'	    =>$this->input->post('inputReferenceNo'),
					//     				'TN'	   		    =>$this->input->post('inputTN'),
					//     				'sessionId'	    	=>$sessionId,
					//     				'Currency'	    	=>$currency,
					//     				'bene_name'	   		=>$beneName,
					//     				'Benetelno'	   		=>$Benetelno,
					//     				'Beneaddress'	   	=>$beneAddress,
					//     				'idtype'	   		=>$idType,
					//     				'idnumber'	   		=>$idNo,
					//     				'type'	   			=>$transType,
					//     				'Amount'	    	=>$this->input->post('inputAmount'),
					//     				'ip_address'		=>$this->ip,
			    	// 					'idone'				=>$this->input->post('selvalidID1'),
					//     				'idtwo'				=>$this->input->post('selvalidID2'),
					//     				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
				    // 				    );
					// 	 	$result = $this->curl->call($parameter,$url);
					// 		$data['result'] = json_decode($result,true);
					// 	 	$this->user['EC'] = $data['result']['EC'];
					// 		$data['user'] = $this->global_f->get_user_session();
		 			// 	}
		 			// 	else
		 			// 	{
					// 		$data['result'] = array (
					// 						  'S'=>0,
					// 						  'M'=>'Selected IDs should be different and is required.');
		 			// 	}

	 				// }

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_payout/transfast');
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


		public function newyorkbay()
	{
		if ($this->user['A_CTRL']['remittance'] == 1){

		$data = array('menu' => 3,
					  'parent'=>'REMITTANCE' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;

				$parameter = array(
					'dev_id'         =>$this->global_f->dev_id(),
					'ip_address'     =>$this->ip,
					'ip'         	 =>$this->ip,
					'actionId'       => _payout_check_user_agreement,
					'regcode'        =>$this->user['R'],
					$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
					);
				$result = $this->curl->call($parameter,url);
				$check_agreement = json_decode($result,true);

				

				if($check_agreement['S'] == 2){
					$data['process'] = 999;
					$data['content'] = $check_agreement['Content'];
					$data['regcode'] = $this->user['R'];
				}

					if (isset($_POST['btnNYBCheck'])){
						$url = url;

						$endpoint = "";
						$deployOwnPayout = 1;
						//set deployOwnPayout = 1 to deploy ownpayout
						if ($deployOwnPayout == 1) {
								$endpoint = _payout_transfast_nyb_check_own_payout;
						} else {
							$endpoint = _payout_transfast_nyb_check;
						}

						$parameter =array(
									'dev_id'     	   => $this->global_f->dev_id(),
									'ip_address'	   =>$this->ip,
									'actionId' 	 	   => $endpoint,
									'regcode'          =>$this->user['R'],
									'transpass'		   =>$this->input->post('inputTpass'),
									'reference_no'	   =>$this->input->post('inputReferenceNo'),
									$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
						);
					    $result = $this->curl->call($parameter,$url);
					    $data['API'] = json_decode($result,true);

				    	if($data['API']['Amount'] > 5000)
					    {
					    	$data['process'] = 2;
					    }


						$data['row'] = array(
									'inputTpass'		   =>$this->input->post('inputTpass'),
									'inputReferenceNo'	   =>$this->input->post('inputReferenceNo')
									);

					}elseif (isset($_POST['btnNYBConfirm'])){
		 				$url = url;

		 				if($this->input->post('selvalidID1'))
		 				{
				 				if($this->input->post('inputBenetelno') == NULL) {$Benetelno = " ";} 
				 				elseif($this->input->post('inputBenetelno') == 0) {$Benetelno = " ";}
				 				else{ $Benetelno = $this->input->post('inputBenetelno');}

								$parameter =array(
											'dev_id'     		=> $this->global_f->dev_id(),
											'actionId' 	 	    => _payout_transfast_nyb_confirm,
						    				'regcode'   		=>$this->user['R'],
						    				'transpass' 		=>$this->input->post('inputTpass'),
						    				'reference_no'	    =>$this->input->post('inputReferenceNo'),
						    				'TN'	   		    =>$this->input->post('inputTN'),
						    				'sessionId'	    	=>$this->input->post('inputSessionID'),
						    				'Currency'	    	=>$this->input->post('inputCurrency'),
						    				'bene_name'	   		=>$this->input->post('inputBeneficiaryName'),
						    				'Benetelno'	   		=>$Benetelno,
						    				'Beneaddress'	   	=>$this->input->post('inputBeneaddress'),
						    				'idtype'			=>$this->input->post('selvalidID'),
						    				'idnumber'	   		=>$this->input->post('inputIDNo'),
						    				'type'	   			=>$this->input->post('inputTransType'),
						    				'Amount'	    	=>$this->input->post('inputAmount'),
						    				'ip_address'		=>$this->ip,
			    							'idone'				=>$this->input->post('selvalidID1'),
						    				'idtwo'				=>$this->input->post('selvalidID2'),
						    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
					    				    );
							 	$result = $this->curl->call($parameter,$url);
								$data['result'] = json_decode($result,true);
							 	$this->user['EC'] = $data['result']['EC'];
								$data['user'] = $this->global_f->get_user_session();
		 				}
		 				else
		 				{
							$data['result'] = array (
											  'S'=>0,
											  'M'=>'Selected IDs should be different and is required.');
		 				}



	 				}

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				// $this->load->view('remittance/ecash_payout/newyorkbay');
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


		public function moneygram()
	{
		if ($this->user['A_CTRL']['remittance'] == 1){

		$data = array('menu' => 3,
					  'parent'=>'REMITTANCE' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$this->check_trans->gwlCheckTransLimit(33); //FOR WEALTHY LIFESTYLE

			$data['user'] = $this->user;

				$parameter = array(
					'dev_id'         =>$this->global_f->dev_id(),
					'ip_address'     =>$this->ip,
					'ip'         	 =>$this->ip,
					'actionId'       => _payout_check_user_agreement,
					'regcode'        =>$this->user['R'],
					$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
					);
				$result = $this->curl->call($parameter,url);
				$check_agreement = json_decode($result,true);

				

				if($check_agreement['S'] == 2){
					$data['process'] = 999;
					$data['content'] = $check_agreement['Content'];
					$data['regcode'] = $this->user['R'];
				}
					if (isset($_POST['btnMoneygramCheck'])){
						$url = url;

						$parameter =array(
									'dev_id'     		=> $this->global_f->dev_id(),
									'actionId' 	 	    => _payout_moneygram_check,
									'regcode'           =>$this->user['R'],
									'reference_no'	    =>$this->input->post('inputReferenceNo'),
									'ip_address'    	=>$this->ip,
									$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'])
						);
					    $result = $this->curl->call($parameter,$url);
					    $data['results'] = json_decode($result,true);

					    if($data['results']['S'] == 1){
					    	$data['info'] = $data['results'];
					    	$data['process'] = 1;
					    }

						$param =array(
									'dev_id'     		=> $this->global_f->dev_id(),
									'actionId' 	 	    => _fetch_countries,
									'regcode'           =>$this->user['R'],
									'ip_address'    	=>$this->ip
						);
					    $results = $this->curl->call($param,$url);
					    $co = json_decode($results,true);
					    $data['countries'] = $co['C_DATA'];

					}elseif (isset($_POST['btnMoneygramConfirm'])){
		 				$url = url;

						$parameter =array(
									'dev_id'    	    => $this->global_f->dev_id(),
									'actionId' 	 	    => _payout_moneygram_confirm,
				    				'regcode'   		=>$this->user['R'],
				    				'transpass' 		=>$this->input->post('inputTpass'),
				    				'reference_no'	    =>$this->input->post('inputReferenceNo'),
				    				'currency'	    	=>$this->input->post('inputCurrency'),
				    				'amount'	    	=>$this->input->post('inputAmount'),
				    				'charge'	    	=>$this->input->post('inputCharge'),
				    				'payoutamount'	    =>$this->input->post('inputPA'),
				    				'sender_name'	    =>$this->input->post('inputSN'),
				    				'beneficiary_name'	=>$this->input->post('inputBN'),
				    				'origin_address'	=>$this->input->post('inputOriginAddress'),
				    				'transactiondate'	=>$this->input->post('inputTransactionDate'),
				    				'beneficiary_fname'	=>$this->input->post('inputBeneficiaryFName'),
				    				'beneficiary_mname'	=>$this->input->post('inputBeneficiaryMName'),
				    				'beneficiary_lname'	=>$this->input->post('inputBeneficiaryLName'),
				    				'idtype'			=>$this->input->post('selvalidID'),
				    				'idnumber'	   		=>$this->input->post('inputIDNo'),
				    				'mobile'	   		=>$this->input->post('inputMobileNo'),
				    				'address'	   		=>$this->input->post('inputAddress'),
				    				'country'			=>$this->input->post('selCountry'),
									'city'				=>$this->input->post('inputCity'),
									'zipcode'			=>$this->input->post('inputZipCode'),
									'birthdate'			=>$this->input->post('inputBday'),
									'birthplace'		=>$this->input->post('inputBPlace'),
									'nationality'		=>$this->input->post('inputNationality'),
									'occupation'		=>$this->input->post('inputOccupation'),
									'fundsource'		=>$this->input->post('inputSourceFund'),
									'relationship'		=>$this->input->post('inputRelationship'),
				    				'ip_address'		=>$this->ip,
				    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
			    				    );

					 	$result = $this->curl->call($parameter,$url);
						$data['results'] = json_decode($result,true);
						$this->user['EC'] = $data['results']['EC'];
						$data['user'] = $this->global_f->get_user_session();

							$data['info'] = array(
										'regcode'   			=>$this->user['R'],
										'inputTpass'			=>$this->input->post('inputTpass'),
										'RF'					=>$this->input->post('inputReferenceNo'),
										'M'						=>$this->input->post('inputRemarks'),
										'TD'					=>$this->input->post('inputTransactionDate'),
										'A'						=>$this->input->post('inputAmount'),
										'C'						=>$this->input->post('inputCharge'),
										'CY'					=>$this->input->post('inputCurrency'),
										'PA'					=>$this->input->post('inputPA'),
										'AD'					=>$this->input->post('inputOriginAddress'),
										'SN' 					=>$this->input->post('inputSN'),
										'BN' 					=>$this->input->post('inputBN'),
										'BNF'					=>$this->input->post('inputBeneficiaryFName'),
										'BNM'					=>$this->input->post('inputBeneficiaryMName'),
										'BNL'					=>$this->input->post('inputBeneficiaryLName'),
										'selvalidID'			=>$this->input->post('selvalidID'),
										'inputIDNo'				=>$this->input->post('inputIDNo'),
										'inputMobileNo'			=>$this->input->post('inputMobileNo'),
										'inputAddress'			=>$this->input->post('inputAddress'),
					    				'selCountry'			=>$this->input->post('selCountry'),
										'inputCity'				=>$this->input->post('inputCity'),
										'inputZipCode'			=>$this->input->post('inputZipCode'),
										'inputBday'				=>$this->input->post('inputBday'),
										'inputBPlace'			=>$this->input->post('inputBPlace'),
										'inputNationality'		=>$this->input->post('inputNationality'),
										'inputOccupation'		=>$this->input->post('inputOccupation'),
										'inputSourceFund'		=>$this->input->post('inputSourceFund'),
										'inputRelationship'		=>$this->input->post('inputRelationship'),
										);

						if($data['results']['S'] == 2){
							$data['info'] = $data['info'];
							$data['process'] = 2;
						}else{
					    	$data['info'] = $data['info'];
					    	$data['process'] = 1;						
						}

					}elseif (isset($_POST['btnMoneygramGenerateTN'])){
		 				$url = url;
		 				$INPUT_POST = json_decode($this->input->post('inputDetails'),true);

						$parameter =array(
									'dev_id'     		=> $this->global_f->dev_id(),
									'actionId' 	 	    => _payout_moneygram_confirm,
				    				'regcode'   		=>$this->user['R'],
				    				'transpass' 		=>$INPUT_POST['inputTpass'],
				    				'reference_no'	    =>$INPUT_POST['RF'],
				    				'currency'	    	=>$INPUT_POST['CY'],
				    				'amount'	    	=>$INPUT_POST['A'],
				    				'charge'	    	=>$INPUT_POST['C'],
				    				'payoutamount'	    =>$INPUT_POST['PA'],
				    				'sender_name'	    =>$INPUT_POST['SN'],
				    				'beneficiary_name'	=>$INPUT_POST['BN'],
				    				'origin_address'	=>$INPUT_POST['AD'],
				    				'transactiondate'	=>$INPUT_POST['TD'],
				    				'beneficiary_fname'	=>$INPUT_POST['BNF'],
				    				'beneficiary_mname'	=>$INPUT_POST['BNM'],
				    				'beneficiary_lname'	=>$INPUT_POST['BNL'],
				    				'idtype'			=>$INPUT_POST['selvalidID'],
				    				'idnumber'	   		=>$INPUT_POST['inputIDNo'],
				    				'mobile'	   		=>$INPUT_POST['inputMobileNo'],
				    				'address'	   		=>$INPUT_POST['inputAddress'],
				    				'country'			=>$INPUT_POST['selCountry'],
									'city'				=>$INPUT_POST['inputCity'],
									'zipcode'			=>$INPUT_POST['inputZipCode'],
									'birthdate'			=>$INPUT_POST['inputBday'],
									'birthplace'		=>$INPUT_POST['inputBPlace'],
									'nationality'		=>$INPUT_POST['inputNationality'],
									'occupation'		=>$INPUT_POST['inputOccupation'],
									'fundsource'		=>$INPUT_POST['inputSourceFund'],
									'relationship'		=>$INPUT_POST['inputRelationship'],
				    				'ip_address'		=>$this->ip,
				    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($INPUT_POST['inputTpass']))
			    				    );
					 	$result = $this->curl->call($parameter,$url);
						$data['results'] = json_decode($result,true);

						if($data['results']['S'] == 1){
							$data['result'] = 1;

						}else{
					    	$data['info'] = $INPUT_POST;
					    	$data['process'] = 2;						
						}
						
					}

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				// $this->load->view('remittance/ecash_payout/moneygram');
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


	// 	public function ecashpayoutcenter()
	// {
	// 		$data = array('menu' => 3,
	// 				  'parent'=>'REMITTANCE' );
					  
	// 	if ($this->user['S'] == 1 && $this->user['R'] !=""){

	// 		$data['user'] = $this->user;

	// 		$this->load->view('layout/header',$data);
	// 		$this->load->view('element/top_header');
	// 		$this->load->view('element/wrapper_header');
	// 		$this->load->view('element/left_panel');
	// 		$this->load->view('remittance/ecash_payout/ecash_payout_center');
	// 		$this->load->view('element/wrapper_footer');
	// 		$this->load->view('layout/footer');	
	// 	}else {
	// 		//$this->session->unset_userdata('user');
	// 		$this->session->sess_destroy();
	// 		redirect('Login/');
	// 	}

	// }

	public function get_ecashpaycenter(){
		$cgkeyword = $this->uri->segment(3);

		$url = url;
		$parameter =array(
			'dev_id'     	   => $this->global_f->dev_id(),
			'actionId' 	 	   => _fetch_ecashpaycenter,
			'ip_address'	   => $this->ip,
			'regcode'          =>$this->user['R'],
			'cgkeyword'	   	   =>$cgkeyword
		);
		$result = $this->curl->call($parameter,$url);
		$response= json_decode($result,true);

		echo json_encode($response);
	}

	public function placidexpress()
	{
		if ($this->user['A_CTRL']['remittance'] == 1){

			$data = array('menu' => 3,
				'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;


				if (isset($_POST['btnPlacidCheck'])){

					$url = url;
					$parameter =array(
						'dev_id'     	   => $this->global_f->dev_id(),
						'actionId' 	 	   => _payout_placid_check,
						'ip_address'	   => $this->ip,
						'regcode'          =>$this->user['R'],
						'transpass'		   =>$this->input->post('inputTpass'),
						'reference_no'	   =>$this->input->post('inputReferenceNo'),
						$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
					);

					$result = $this->curl->call($parameter,$url);
					$data['API'] = json_decode($result,true);
					//var_dump($data['API']);exit;
					$data['row'] = array(
						'inputTpass'		   =>$this->input->post('inputTpass'),
						'inputReferenceNo'	   =>$this->input->post('inputReferenceNo')
					);

				}elseif (isset($_POST['btnPlacidConfirm'])){
					$url = url;
					$parameter =array(
						'dev_id'     	    => $this->global_f->dev_id(),
						'actionId' 	 	    => _payout_placid_confirm,
						'ip_address'	    => $this->ip,
						'regcode'           =>$this->user['R'],
						'transpass'		    =>$this->input->post('inputTpass'),
						'inputReferenceNo'	=>$this->input->post('inputReferenceNo'),
						'PayoutAmount'	    =>$this->input->post('PayoutAmount'),
						'ExchangeRate'	    =>$this->input->post('ExchangeRate'),
						'PayoutCurrency'	=>$this->input->post('PayoutCurrency'),
						'OrgCurrency'	    =>$this->input->post('OrgCurrency'),
						'OrgAmount'	  		=>$this->input->post('OrgAmount'),
						'SenderName'	    =>$this->input->post('SenderName'),
						'SenderPhone'	    =>$this->input->post('SenderPhone'),
						'SenderAddress'	    =>$this->input->post('SenderAddress'),
						'ReceiverName'	    =>$this->input->post('ReceiverName'),
						'ReceiverMobile'	=>$this->input->post('ReceiverMobile'),
						'ReceiverAddress'	=>$this->input->post('ReceiverAddress'),
						'inputBdate'	  	=>$this->input->post('inputBdate'),
						'Nationality'	   	=>$this->input->post('Nationality'),
						'Occupation'	   	=>$this->input->post('Occupation'),
						'RelSender'	   		=>$this->input->post('RelSender'),
						'idtype'	  		=>$this->input->post('idtype'),
						'idnumber'	   		=>$this->input->post('idnumber'),
						'Token'	   			=>$this->input->post('Token'),
						'RN'	   			=>$this->input->post('RN'),
						$this->user['SKT']  =>  md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
					);

					$result = $this->curl->call($parameter,$url);
					// print_r($result);
					$data['API'] = json_decode($result,true);
					// print_r($data['API']);
						
					if($data['API']['S']==1) {
						$this->user['EC'] = $data['API']['EC'];
						unset($_SESSION['user']['EC']);
						$_SESSION['user']['EC'] = $data['API']['EC'];
						$data['user'] = $this->global_f->get_user_session();

						$data['row'] = array(
							'inputTpass'		   =>$this->input->post('inputTpass'),
							'inputReferenceNo'	   =>$this->input->post('inputReferenceNo')
						);

					} else {
						$data['row'] = array(
							'inputTpass'		   =>$this->input->post('inputTpass'),
							'inputReferenceNo'	   =>$this->input->post('inputReferenceNo')
						);
						$data['API'] = array('S'=>0,'M'=>$data['API']['M'],
										'inputBdate'	  	=>$this->input->post('inputBdate'),
										'Nationality'	   	=>$this->input->post('Nationality'),
										'Occupation'	   	=>$this->input->post('Occupation'),
										'RelSender'	   		=>$this->input->post('RelSender'),
										'idtype'	  		=>$this->input->post('idtype'),
										'idnumber'	   		=>$this->input->post('idnumber'),
										'TK'	   			=>$this->input->post('Token'),
										'RN'	   			=>$this->input->post('RN'),
										'D' => array(
												'inputReferenceNo'	=>$data['row']['inputReferenceNo'],
												'PayoutAmount'	    =>$this->input->post('PayoutAmount'),
												'ExchangeRate'	    =>$this->input->post('ExchangeRate'),
												'PayoutCurrency'	=>$this->input->post('PayoutCurrency'),
												'OrgCurrency'	    =>$this->input->post('OrgCurrency'),
												'OrgAmount'	  		=>$this->input->post('OrgAmount'),

												'Sender' => array(
														'SenderName'	    =>$this->input->post('SenderName'),
														'SenderPhone'	    =>$this->input->post('SenderPhone'),
														'SenderAddress'	    =>$this->input->post('SenderAddress')
													),
												'Receiver' => array(
														'ReceiverName'	    =>$this->input->post('ReceiverName'),
														'ReceiverMobile'	=>$this->input->post('ReceiverMobile'),
														'ReceiverAddress'	=>$this->input->post('ReceiverAddress')
													)
											),
										
									);
						
						// print_r($data['API']);
						// print_r($this->input->post());
					}
				}

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_payout/placid_express');
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

		public function gcashcashout()
	{
		if ($this->user['A_CTRL']['remittance'] == 1){

		$data = array('menu' => 3,
					 'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$this->check_trans->gwlCheckTransLimit(14); //FOR WEALTHY LIFESTYLE

				$data['user'] = $this->user;
					
					if (isset($_POST['btnGcashCheck'])){
						$url = url;

						$parameter = array(
									'dev_id'    	   => $this->global_f->dev_id(),
									'actionId' 	 	   => _payout_smartmoney_check,
									'ip_address'	   =>$this->ip,
									'regcode'          =>$this->user['R'],
									'transpass'		   =>$this->input->post('inputTpass'),
									'reference_no'	   =>$this->input->post('inputReferenceNo'),
									'amount'	       =>$this->input->post('inputAmount'),
									'smarymoney_no'	   =>$this->input->post('inputSmartMoneyNo'),
									$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
						);
					    $result = $this->curl->call($parameter,$url);
					    $data['API'] = json_decode($result,true);
					    

					
						$data['row'] = array(
									'inputTpass'		   =>$this->input->post('inputTpass'),
									'inputReferenceNo'	   =>$this->input->post('inputReferenceNo'),
									'inputSmartMoneyNo'	   =>$this->input->post('inputSmartMoneyNo')
										);


					}elseif (isset($_POST['btnGcashConfirm'])){
	 			
		 				$url = url;
						$parameter =array(
									'dev_id'     		=> $this->global_f->dev_id(),
									'actionId' 	 		=> _payout_smartmoney_confirm,
				    				'regcode'   		=>$this->user['R'],
				    				'transpass' 		=>$this->input->post('inputTpass'),
				    				'reference_no'	    =>$this->input->post('inputReferenceNo'),
				    				'smartmoneyno'		=>$this->input->post('inputSmartMoneyNo'),
				    				'idnumber'			=>$this->input->post('inputIDNo'),	
				    				'idtype'			=>$this->input->post('selvalidID'),
				    				'ip_address'		=>$this->ip,
				    				'Amount'			=>$this->input->post('inputAmount'),
				    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
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
				$this->load->view('remittance/ecash_payout/gcash_cashout');
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


		public function baremi_payout()
	{
		if ($this->user['A_CTRL']['remittance'] == 1){

		$data = array('menu' => 3,
					 'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;
					
					if (isset($_POST['btnBaremiCheck'])){
						$url = url;
						$parameter = array(
									'dev_id'    	   => $this->global_f->dev_id(),
									'actionId' 	 	   => _baremi_payout_checkref,
									'ip_address'	   =>$this->ip,
									'regcode'          =>$this->user['R'],
									'trackingno'	   =>$this->input->post('inputTransactionNo'),
									$this->user['SKT'] =>md5($this->user['R'].$this->user['SKT'])
									);
					    $result = $this->curl->call($parameter,$url);
					    $data['result'] = json_decode($result,true); 

					    if($data['result']['S'] == 1){ 
					    	$data['process'] = 1; 
					    	$data['modal'] = 99; 
					    	$data['row'] = $data['result'];
					    	$this->session->set_userdata('payout_check_details',$data['result']);
					    }

					}elseif (isset($_POST['btnConfirmPayout'])){

						$url = url;
						$parameter = array(
									'dev_id'    	   => $this->global_f->dev_id(),
									'actionId' 	 	   => _baremi_payout,
									'ip_address'	   =>$this->ip,
									'regcode'          =>$this->user['R'],
									'refno'		   	   =>$this->input->post('referenceno'),
									'amount'		   =>$this->input->post('amount'),
									'transpass'		   =>$this->input->post('inputTranspass'),
									$this->user['SKT'] =>md5($this->user['R'].$this->user['SKT'].$this->input->post('inputTranspass'))
									);
					    $result = $this->curl->call($parameter,$url);
					    $data['result'] = json_decode($result,true);

					    if ($data['result']['S'] == 1) {
				    		$data['result'] = array(
				    				'S'  => 1,
				    				'M'  => $data['result']['M'],
				    				'RF' => $data['result']['RF'],
				    				'TN' => $data['result']['TN'],
				    				'URL'=> $data['result']['URL']
				    			);
					    }else{
				    		$data['result'] = array(
				    				'S'  => 0,
				    				'M'  => $data['result']['M']
				    			);
				    		$data['process'] = 1;
				    		$data['row'] = $this->session->userdata('payout_check_details');
					    }
					    
					}

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_payout/baremi_payout');
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

	function cebuanaconfirmAgreement() {

		$parameter = array(
			'dev_id'         =>$this->global_f->dev_id(),
			'ip_address'     =>$this->ip,
			'ip'         	  =>$this->ip,
			'actionId'       => _cebuana_payout_agree_user_agreement,
			'regcode'        =>$this->user['R'],
			$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
			);
		$result = $this->curl->call($parameter,url);
		$API = json_decode($result,true);
		if($API['S'] == 1){
			$message = array('S' => 1, 'M' => $API['M']);
		}
		else{
			$message = array('S' => 0, 'M' => $API['M']);
		}
		echo json_encode($message);
	}


	public function cebuana_payout()
	{
		if ($this->user['A_CTRL']['remittance'] == 1){

		$data = array('menu' => 3,
					 'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$this->check_trans->gwlCheckTransLimit(82); //FOR WEALTHY LIFESTYLE

				$data['user'] = $this->user;

				$parameter = array(
					'dev_id'         	=>	$this->global_f->dev_id(),
					'ip_address'     	=>	$this->ip,
					'ip'         	 	=>	$this->ip,
					'actionId'       	=> 	_cebuana_payout_check_user_agreement,
					'regcode'        	=>	$this->user['R'],
					$this->user['SKT'] 	=>  md5($this->user['R'].$this->user['SKT'])
					);

				$result = $this->curl->call($parameter,url);
				$check_agreement = json_decode($result,true);

				if($check_agreement['S'] == 2){
					$data['process'] = 999;
					$data['content'] = $check_agreement['Content'];
				}

				if (isset($_POST['btnCebuanaCheck'])){
					$url = url;

					$endpoint = "";
					$deployOwnPayout = 1;
					//set deployOwnPayout = 1 to deploy ownpayout
					if ($deployOwnPayout == 1) {
							$endpoint = _cebuana_checkref_new_latest_own_payout;
					} else {
						$endpoint = _cebuana_checkref_new_latest;
					}

					$parameter = array(
								'dev_id'    	   	=> 	$this->global_f->dev_id(),
								// 'actionId' 	 		=> _cebuana_checkref,
								'actionId' 	 	   	=> 	$endpoint, // for pod process
								'ip_address'	   	=>	$this->ip,
								'regcode'          	=>	$this->user['R'],
								'ctrl_no'		   	=>	$this->input->post('inputReferenceNo'),
								'mode_mp'	       	=>	'payout',
								'type'				=>	'payout',
								$this->user['SKT'] 	=>	md5($this->user['R'].$this->user['SKT'].$this->input->post('inputReferenceNo'))
								);
					// md5($REGCODE.$T_VALUE.$C_NO)
				    $result = $this->curl->call($parameter,$url);
				    $data['API'] = json_decode($result,true);
				    $data['details'] = $data['API']['T_DATA'];

	    			$data['ctrlnumber'] = $this->input->post('inputReferenceNo');

	    			// print_r($data['details']['Rates']['PA']);die;

	    			if($data['details']['Rates']['PA'] > 5000)
				    {
				    	$data['process'] = 2;
				    }

					$idparameter = array(
								'dev_id'    	   => $this->global_f->dev_id(),
								'actionId' 	 	   => _cebuana_id_list,
								'ip_address'	   =>$this->ip,
								'regcode'          =>$this->user['R']
								);
				    $idresult = $this->curl->call($idparameter,$url);
				    $data['id_list'] = json_decode($idresult,true);
				    

				}elseif (isset($_POST['btnCebuanaConfirm'])){
 			
	 				$url = url;
					$parameter =array(
								'dev_id'     		=> $this->global_f->dev_id(),
								// 'actionId' 	 		=> _cebuana_payout_confirm,
								'actionId' 	 		=> _cebuana_payout_confirm_new_latest, //for POD process
			    				'regcode'   		=>$this->user['R'],
			    				'transpass' 		=>$this->input->post('inputTranspass'),
			    				'ctrl_no'	    	=>$this->input->post('controlnumber'),
			    				// 'id_type'			=>$this->input->post('selvalidID'),
			    				// 'id_no'				=>$this->input->post('inputIDNo'),	
			    				'idone'				=>$this->input->post('selvalidID1'),
			    				'idtwo'				=>$this->input->post('selvalidID2'),
			    				'ip_address'		=>$this->ip,
			    				'ip'				=>$this->ip,
			    				$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTranspass')))
		    				    );

					// var_dump($parameter);

				 	$result = $this->curl->call($parameter,$url);
					$data['result'] = json_decode($result,true);

					// var_dump($data['result']); //die;

					if ($data['result']['EC']  != "") {
					 	$this->user['EC'] = $data['result']['EC'];
						$data['user'] = $this->global_f->get_user_session();
					 } 
 				}

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_payout/cebuana');
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');	
			} else {
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


	public function fetch_payout_id(){
		$BENEFNAME = $this->input->post('benefname');
		$BENEMNAME = $this->input->post('benemname');
		$BENELNAME = $this->input->post('benelname');
		$BENEBDATE = $this->input->post('benebdate');

				$data['user'] = $this->user;

				$parameter =array(
					'dev_id'     		=> $this->global_f->dev_id(),
					'actionId'         	=> _fetch_available_remitpayout_ids, 
					'ip_address'		=> $this->ip,
					'fname'				=> $BENEFNAME, 
					'mname'				=> $BENEMNAME,
					'lname'				=> $BENELNAME,
					'birthdate'			=> $BENEBDATE,
    				'regcode'           => $this->user['R'],
    				$this->user['SKT']  =>  md5($this->user['R'].$this->user['SKT'])
			    	); 

			    $result = $this->curl->call($parameter,url);
			   	$result = json_decode($result);
			   	echo json_encode($result);
	}



	public function add_newid_payout(){

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

					$image_id = md5($this->user['R'].$BENEFNAME.$BENEMNAME.$BENELNAME.$BENEBDATE.$NEWIDTYPE.$NEWIDNUMBER.$NEWEXPIRYDATE) . '_web.jpg';

					if (FALSE && $this->user['R'] != '1234567') {
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
							'ftp_server'         => ftp_server_radius,
							'ftp_port'           => 800,
							'ftp_user'           => 'argel',
							'ftp_pass'           => 'argel_argel!!!',
							'ftp_path'           => '/Remittance/',
							'ftp_filename'       => $image_id,
							'id'				=> 	$SELVALIDID1,
							'transtype'         => $TRANSTYPE == 'cebuana_payout' ? 'CEBUANA' : 'WESTERN UNION',
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
							'transtype'         => $TRANSTYPE == 'cebuana_payout' ? 'CEBUANA' : 'WESTERN UNION',
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
							'transtype'         => $TRANSTYPE == 'cebuana_payout' ? 'CEBUANA' : 'WESTERN UNION',
							$this->user['SKT']  => md5($this->user['R'].$this->user['SKT'])
							); 
						}
						else
						{
							if ($TRANSTYPE == 'TRANSFAST PAYOUT'){
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
							else {
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
								'transtype'         => $TRANSTYPE == 'cebuana_payout' ? 'CEBUANA' : 'WESTERN UNION',
								$this->user['SKT']  => md5($this->user['R'].$this->user['SKT'])
								); 
							}
								
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
								'id'				=> 	$SELVALIDID,
								'transtype'         => $TRANSTYPE == 'cebuana_payout' ? 'CEBUANA' : 'WESTERN UNION',
								$this->user['SKT']  => md5($this->user['R'].$this->user['SKT'])
							); 
						} else {
							switch ($TRANSTYPE) {
								case 'TRANSFAST PAYOUT': $TRANSTYPE = 'TRANSFAST PAYOUT';
									break;
								case 'cebuana_payout': $TRANSTYPE = 'CEBUANA';
									break;
								default: $TRANSTYPE = 'WESTERN UNION';
									break;
							}

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
						
					if ($upload_response['S'] == 1) {
						$result = $this->curl->call($parameter, url);
						$result = json_decode($result);

						echo json_encode($result);
					} else {
						$message = ['S'=>0,'M'=>'Upload failed.'];
						echo json_encode($message);
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


	public function add_newid_payout_moneygram(){

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

		$TRANSTYPE = "MONEYGRAM";

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

					if (false) {//ftp
						$image_id = md5($this->user['R'].$BENEFNAME.$BENEMNAME.$BENELNAME.$BENEBDATE.$NEWIDTYPE.$NEWIDNUMBER.$NEWEXPIRYDATE) . '_web.jpg';

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
							'ftp_server'         => ftp_server_radius,
							'ftp_port'           => 800,
							'ftp_user'           => 'argel',
							'ftp_pass'           => 'argel_argel!!!',
							'ftp_path'           => '/Remittance/',
							'ftp_filename'       => $image_id,
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

						if ($upload_response['S'] == 1) {
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

							$result = $this->curl->call($parameter,url);
							$result = json_decode($result);
							echo json_encode($result);
						} else {// upload failed
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

	public function fetch_remitpayout_id_types(){
		$BENEFNAME = $this->input->post('benefname');
		$BENEMNAME = $this->input->post('benemname');
		$BENELNAME = $this->input->post('benelname');
		$BENEBDATE = $this->input->post('benebdate');

				$data['user'] = $this->user;

				$parameter =array(
					'dev_id'     		=> $this->global_f->dev_id(),
					'actionId'         	=> _fetch_remitpayout_id_types, 
					'ip_address'		=> $this->ip,
    				'regcode'           => $this->user['R'],
    				$this->user['SKT']  =>  md5($this->user['R'].$this->user['SKT'])
			    	); 

			    $result = $this->curl->call($parameter,url);
			   	$result = json_decode($result);
			   	echo json_encode($result);
	}


	public function terms_redir(){
		$content_data = $this->input->get('d');

		echo "<input type='hidden' name='content' value='".$content_data."'>";
	}


	public function ecashtowestern_createrequest()
	{
		$reg_codes = array(
			'1234567',
			'F5033230',
			'F5385420',
			'F5950087',
			'F6238825',
			'F6429926',
			'F6522385',
			'F6618590',
			'F6657731',
			'F6696243'
		);
		
		if ($this->user['A_CTRL']['remittance'] == 1 || false) {

			$data = array('menu' => 3,'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !="") {

				$data['user'] = $this->user;
				$url = url;

				$parameter = array(
					'dev_id'         =>$this->global_f->dev_id(),
					'ip_address'     =>$this->ip,
					'ip'         	 =>$this->ip,
					'actionId'       => _payout_check_user_agreement,
					'regcode'        =>$this->user['R'],
					$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
					);
				$result = $this->curl->call($parameter,url);
				$check_agreement = json_decode($result,true);

				if($check_agreement['S'] == 2){
					$data['process'] = 999;
					$data['content'] = $check_agreement['Content'];
					$data['regcode'] = $this->user['R'];
				} else {
					$data['process'] = 0;
				}

				$parameter =array(
					'dev_id'     		=> $this->global_f->dev_id(),
					'actionId' 	 		=> _fetch_countries_iso,
					'regcode' 			=>$this->user['R'],
					'ip_address'		=>$this->ip
				); 
				$result = $this->curl->call($parameter,$url);
				$results = json_decode($result,true);
				$data['country'] = $results['T_DATA'];
				$data['currency'] = $results['F_DATA'];

				$parameter =array(
					'dev_id'     		=> $this->global_f->dev_id(),
					'actionId' 	 		=> _fetch_primary_ids,
					'regcode' 			=>$this->user['R'],
					'ip_address'		=>$this->ip
				); 
				$result = $this->curl->call($parameter,$url);
				$results = json_decode($result,true);
				$data['list_ids'] = $results['T_IDS'];

				if (in_array($this->user['R'], $reg_codes)) {
					//NEW PAYOUT
					if (isset($_POST['btnSsearch'])) //Search Sender
					{
						$search = $this->input->post('inputSearchMtcnNo');
						$parameter =array(
							'dev_id'     		=> $this->global_f->dev_id(),
							'actionId' 	 		=> 'western_api/remittanceSearch', //remittanceSearchDb
							'mtcn'				=> $search,
							'regcode' 			=> $this->user['R'],
							'ip_address'		=> $this->ip							
						); 

						$result = $this->curl->call($parameter,$url);

						//var_dump($result,$parameter);die;

						$data['row'] = json_decode($result,true);

						if ($data['row']['S']==1) {
							$data['type'] = array('typeid'=>1,
												'typedesc'=>'Sender');
							$data['transac_det'] = $data['row']['D'];
							// var_dump($data['transac_det']);
							// die();
						}
					}
				} else { 
					// OLD PAYOUT
					if (isset($_POST['btnSsearch'])) //Search Sender
					{
						$search = $this->input->post('inputSearch');
						$parameter =array(
										'dev_id'     		=> $this->global_f->dev_id(),
										'actionId' 	 		=> _remittance_search,
										'search_key'		=> $search,
										'regcode' 			=> $this->user['R'],
										'ip_address'		=> $this->ip
										
									); 

						$result = $this->curl->call($parameter,$url);
						$data['row'] = json_decode($result,true);

						if ($data['row']['S']==1) {
							$data['type'] = array('typeid'=>1,
												'typedesc'=>'Sender');
						}
					} elseif (isset($_POST['btnBsearch']))  //Search Benificiary
					{
						$search = $this->input->post('inputSearch');
						$parameter =array(
									'dev_id'     		=> $this->global_f->dev_id(),
									'actionId' 	 		=> _remittance_search,
									'search_key'   	=>$search,
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
					
					} elseif(isset($_POST['btnAddDetails']))// add sender and benificiary
					{
						$INPUT_POST =$this->input->post(null,true);

						$T_VALUE =md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));
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
							
					}
				}
				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				// if (in_array($this->user['R'], $reg_codes)) {
				// 	$this->load->view('remittance/ecash_payout/ecashtowesternpayout_createrequest_new');
				// } else {
				// 	$this->load->view('remittance/ecash_payout/ecashtowesternpayout_createrequest');
				// }
				
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');
			
			} else {
				//$this->session->unset_userdata('user');
				$this->session->sess_destroy();
				redirect('Login/');
			}

		} else {
			//$this->session->unset_userdata('user');
			//$this->session->sess_destroy();
			redirect('Main/');
		}

	}

	
		public function ecashtomoneygram_createrequest()
	{
		if ($this->user['A_CTRL']['remittance'] == 1){

		$data = array('menu' => 3,
					  'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;
				$url = url;

				$parameter = array(
					'dev_id'         =>$this->global_f->dev_id(),
					'ip_address'     =>$this->ip,
					'ip'         	 =>$this->ip,
					'actionId'       => _payout_check_user_agreement,
					'regcode'        =>$this->user['R'],
					$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
					);
				$result = $this->curl->call($parameter,url);
				$check_agreement = json_decode($result,true);

				if($check_agreement['S'] == 2){
					$data['process'] = 999;
					$data['content'] = $check_agreement['Content'];
					$data['regcode'] = $this->user['R'];

				} else {

				$data['process'] = 0;

				}

 				$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId' 	 		=> _fetch_countries_iso,
	    				'regcode' 			=>$this->user['R'],
	    				'ip_address'		=>$this->ip
	    				); 

			    $result = $this->curl->call($parameter,$url);
				$results = json_decode($result,true);
				$data['country'] = $results['T_DATA'];
				$data['currency'] = $results['F_DATA'];					
				




				if (isset($_POST['btnSsearch'])) //Search Sender
				{
	 				$search = $this->input->post('inputSearch');
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
					
				 
	 			}elseif (isset($_POST['btnBsearch']))  //Search Benificiary
	 			{
	 				$search = $this->input->post('inputSearch');
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
				
	 			}elseif(isset($_POST['btnAddDetails']))// add sender and benificiary
	 			{
	 				$INPUT_POST =$this->input->post(null,true);

	 				$T_VALUE =md5(date('m/d/Y').md5('GPRSKEY@)!$w3'));
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
						
	 			}

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				// $this->load->view('remittance/ecash_payout/ecashtomoneygram_createrequest');
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


	function ecash_to_western_payout_request(){
		$url = url;
		$parameter =array(
			'dev_id'    	    => $this->global_f->dev_id(),
			'ip_address'		=>$this->ip,
			'actionId' 	 		=> _western_create_request,
			'regcode'   		=>$this->user['R'],
			'refno'				=>$this->input->post('refno'),
			'sender_id'			=>$this->input->post('sender_id'),
			'beneficiary_id'	=>$this->input->post('beneficiary_id'),
			'amount'			=>$this->input->post('amount'),
			'currency'			=>$this->input->post('currency'),
			'primaryId'			=>$this->input->post('primaryId'),
			'secondaryId'		=>$this->input->post('secondaryId'),
			'tertiaryId'		=>$this->input->post('tertiaryId'),
			'country'			=>$this->input->post('country'),
			'transpass'			=>$this->input->post('transpass'),
			'occupation'		=>$this->input->post('occupation'),
			'relationbene'		=>$this->input->post('relationbene'),
			'empname'			=>$this->input->post('empname'),
			'fundsrc'			=>$this->input->post('fundsrc'),
			'countrybirth'		=>$this->input->post('countrybirth'),
			'nationality'		=>$this->input->post('nationality'),
			'branch_location'	=>$this->input->post('branch_location'),

			$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('transpass')))
		    );
		//print_r ($parameter);
		$result = $this->curl->call($parameter,$url);
		$response= json_decode($result,true);
		

		/*if ($response['S'] == 1) {
			$parameter = array(
				'dev_id'     		=> $this->global_f->dev_id(),
				'actionId' 	 		=> 'western_api/remittanceReceivePay',
				'mtcn'				=> $this->input->post('refno'),
				'regcode' 			=> $this->user['R'],
				'ip'		=> $this->ip
			); 
			$resultApi = $this->curl->call($parameter,$url);
			$responseApi = json_decode($resultApi,true);
		}*/

		echo json_encode($response);
	}

	function ecash_to_western_payout_add_sender_beneficiary_request(){
		$url = url;
		$parameter =array(
			'dev_id'    	    => $this->global_f->dev_id(),
			'ip_address'		=>$this->ip,
			'actionId' 	 		=> _western_create_sender_benificiary_request,
			'regcode'   		=>$this->user['R'],
			'mtcn'				=>$this->input->post('mtcn'),
			'transpass'			=>$this->input->post('transpass'),
			'fnameSs'			=>$this->input->post('fnameSs'),
			'mnameSs'			=>$this->input->post('mnameSs'),
			'lnameSs'			=>$this->input->post('lnameSs'),
			'emailSs'			=>$this->input->post('emailSs'),
			'mobileSs'			=>$this->input->post('mobileSs'),
			'genderSs'			=>$this->input->post('genderSs'),
			'addrSs'			=>$this->input->post('addrSs'),
			'bdateSs'			=>$this->input->post('bdateSs'),
			'countrySs'			=>$this->input->post('countrySs'),
			'fnameBb'			=>$this->input->post('fnameBb'),
			'mnameBb'			=>$this->input->post('mnameBb'),
			'lnameBb'			=>$this->input->post('lnameBb'),
			'emailBb'			=>$this->input->post('emailBb'),
			'mobileBb'			=>$this->input->post('mobileBb'),
			'genderBb'			=>$this->input->post('genderBb'),
			'addrBb'			=>$this->input->post('addrBb'),
			'bdateBb'			=>$this->input->post('bdateBb'),
			'countryBb'			=>$this->input->post('countryBb'),
			$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('transpass')))
		    );
			
		$result = $this->curl->call($parameter,$url);
		$response= json_decode($result,true);

		echo json_encode($response);
	}

	function ecash_to_moneygram_payout_request(){
		$url = url;
		$parameter =array(
			'dev_id'    	    => $this->global_f->dev_id(),
			'ip_address'		=>$this->ip,
			'actionId' 	 		=> _moneygram_create_request,
			'regcode'   		=>$this->user['R'],
			'refno'				=>$this->input->post('refno'),
			'sender_id'			=>$this->input->post('sender_id'),
			'beneficiary_id'	=>$this->input->post('beneficiary_id'),
			'amount'			=>$this->input->post('amount'),
			'currency'			=>$this->input->post('currency'),
			'primaryId'			=>$this->input->post('primaryId'),
			'secondaryId'		=>$this->input->post('secondaryId'),
			'tertiaryId'		=>$this->input->post('tertiaryId'),
			'country'			=>$this->input->post('country'),
			'transpass'			=>$this->input->post('transpass'),
			'occupation'		=>$this->input->post('occupation'),
			'relationbene'		=>$this->input->post('relationbene'),
			'empname'			=>$this->input->post('empname'),
			'fundsrc'			=>$this->input->post('fundsrc'),
			'countrybirth'		=>$this->input->post('countrybirth'),
			'nationality'		=>$this->input->post('nationality'),
			$this->user['SKT']	=>md5($this->user['R'].$this->user['SKT'].md5($this->input->post('transpass')))
		    );
		$result = $this->curl->call($parameter,$url);
		$response= json_decode($result,true);

		echo json_encode($response);
	}


	public function ecashtowestern_payoutlist($tn)
	{
		if ($this->user['A_CTRL']['remittance'] == 1){

		$data = array('menu' => 3,
					  'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;
				$url = url;

				if ($tn){
					$parameters = array(
						'dev_id'     => $this->global_f->dev_id(),
						'regcode' 	 => $this->user['R'],
						'actionId' 	 =>_get_status_payout_western,
						'ip_address' =>$this->ip,
						'trackno'    =>$tn
					);
					$data['API'] = json_decode($this->curl->call($parameters,$url),true);
					//print_r($data['API']);
				}

 				$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId' 	 		=> _fetch_pending_western_payout,
	    				'regcode' 			=>$this->user['R'],
	    				'ip_address'		=>$this->ip
	    				); 

			    $result = $this->curl->call($parameter,$url);
				$data['results'] = json_decode($result,true);

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_payout/ecashtowestern_payoutlist');
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

	public function ecashtomoneygram_payoutlist($tn)
	{
		if ($this->user['A_CTRL']['remittance'] == 1){

		$data = array('menu' => 3,
					  'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;
				$url = url;

				if ($tn){
					$parameters = array(
						'dev_id'     => $this->global_f->dev_id(),
						'regcode' 	 => $this->user['R'],
						'actionId' 	 =>_get_status_payout_moneygram,
						'ip_address' =>$this->ip,
						'trackno'    =>$tn
					);
					$data['API'] = json_decode($this->curl->call($parameters,$url),true);
					//print_r($data['API']);
				}

 				$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId' 	 		=> _fetch_pending_moneygram_payout,
	    				'regcode' 			=>$this->user['R'],
	    				'ip_address'		=>$this->ip
	    				); 

			    $result = $this->curl->call($parameter,$url);
				$data['results'] = json_decode($result,true);

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_payout/ecashtomoneygram_payoutlist');
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

	public function ecashtowestern_payoutdone()
	{
		if ($this->user['A_CTRL']['remittance'] == 1){

		$data = array('menu' => 3,
					  'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$this->check_trans->gwlCheckTransLimit(154); //FOR WEALTHY LIFESTYLE

				$data['user'] = $this->user;
				$url = url;

 				$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId' 	 		=> _fetch_donecancelled_western_payout,
	    				'regcode' 			=>$this->user['R'],
	    				'ip_address'		=>$this->ip
	    				); 

			    $result = $this->curl->call($parameter,$url);
				$data['results'] = json_decode($result,true);

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_payout/ecashtowestern_payoutdonecancelled');
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

	public function ecashtomoneygram_payoutdone()
	{
		if ($this->user['A_CTRL']['remittance'] == 1){

		$data = array('menu' => 3,
					  'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;
				$url = url;

 				$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId' 	 		=> _fetch_donecancelled_moneygram_payout,
	    				'regcode' 			=>$this->user['R'],
	    				'ip_address'		=>$this->ip
	    				); 

			    $result = $this->curl->call($parameter,$url);
				$data['results'] = json_decode($result,true);

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_payout/ecashtomoneygram_payoutdonecancelled');
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

	// added by rene for paymaya
	public function validID(){
		$parameter =array(
			'dev_id'     		=> $this->global_f->dev_id(),
			'actionId'         	=> _fetch_available_ids, 
			'ip_address'		=> $this->ip, 
			'regcode'           => $this->user['R'],
			$this->user['SKT']  =>  md5($this->user['R'].$this->user['SKT'])
			); 

		$result = $this->curl->call($parameter,url);
		   $result = json_decode($result);
		   echo json_encode($result->T_DATA);
	}

	//GOCAB SHIPPER CASHOUT

	public function gocab_cashout()
	{
		if ($this->user['A_CTRL']['remittance'] == 1){

		$data = array('menu' => 3,
					  'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_payout/gocab_cashout');
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

	function check_gocab_ref_cashout()
	{
		if ($this->user['A_CTRL']['remittance'] == 1) {

			$data = array('menu' => 3,
					  'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;
				$REFNO = $this->input->post('referenceNo');

				$parameter = array(
					'dev_id'       => $this->global_f->dev_id(),
					'actionId'     => 'ups_gocab/check_ref_cashout',
					'regcode'      => $this->user['R'],
					'ip_address'   => $this->ip,
					'referenceID'  => $REFNO
				); 

				$result = $this->curl->call($parameter, url);
				$result = json_decode($result,true);

				$json_array = array(
					'DATA' => $result['DATA'],
					'KYC' => $this->load->view('remittance/ecash_payout/gocab_kyc', $result['DATA'], true),
					'MODAL' => $this->load->view('modal/gocab_cashout_modal', $result['DATA'], true)
				);

				echo json_encode($json_array);
			}
		}
	}

	function process_gocab_ref_cashout()
	{
		if ($this->user['A_CTRL']['remittance'] == 1) {

			$data = array('menu' => 3,
					  'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;

				$parameter = array(
					'dev_id'       => $this->global_f->dev_id(),
					'actionId'     => 'ups_gocab/process_gocab_cashout',
					'regcode'      => $this->user['R'],
					'client_email'  => $this->input->post('client_email'),
					'client_mobile'  => $this->input->post('client_mobile'),
					'client_fname'  => $this->input->post('client_fname'),
					'client_mname'  => $this->input->post('client_mname'),
					'client_lname'  => $this->input->post('client_lname'),
					'referenceID'  => $this->input->post('refno'),
					'accname'  	   => $this->input->post('accname'),
					'mobile'  	   => $this->input->post('mobile'),
					'amount'  	   => $this->input->post('amount'),
					'charge'  	   => $this->input->post('charge'),
					'channelfee'   => $this->input->post('channelfee'),
					'transpass'    => $this->input->post('transpass'),
					'trackno'      => $this->input->post('transno'),
					'ip_address'   => $this->ip
				); 

				$result = $this->curl->call($parameter, url);
				$result = json_decode($result,true);

				$json_array = array(
					'STATUS' 	 => $result['S'],
					'MESSAGE' 	 => $result['M'],
					'TRACKINGNO' => $result['T']
				);

				echo json_encode($json_array);
			}
		}
	}

	function confirm_gocab_ref_cashout()
	{
		if ($this->user['A_CTRL']['remittance'] == 1) {

			$data = array('menu' => 3,
					  'parent'=>'REMITTANCE' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;
				$REFNO = $this->input->post('referenceNo');
				$TRACKNO = $this->input->post('trackno');

				$parameter = array(
					'dev_id'       => $this->global_f->dev_id(),
					'actionId'     => 'ups_gocab/confirm_ref_cashout',
					'regcode'      => $this->user['R'],
					'ip_address'   => $this->ip,
					'referenceID'  => $REFNO,
					'trackno'  	   => $TRACKNO
				); 

				$result = $this->curl->call($parameter, url);
				$result = json_decode($result,true);

				$json_array = array(
					'STATUS' 	 => $result['S'],
					'MESSAGE' 	 => $result['M'],
					'TRACKINGNO' => $result['T']
				);

				echo json_encode($json_array);
			}
		}
	}

	function upload_gocab_id(){

		if ($_FILES['fileToUpload']['error'] == 0){
			if($_FILES['fileToUpload']['size'] < 2*MB) {
				$curl = curl_init();
				$localfile =$_FILES["fileToUpload"]["tmp_name"];
				
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

				$parameter =array(
					'dev_id'     		=> $this->global_f->dev_id(),
					'actionId'         	=> 'ups_gocab/upload_id', 
					'ip_address'		=> $this->ip,
					'regcode'           => $this->user['R'],
					'fname'				=> $this->input->post('fname'), 
					'mname'				=> $this->input->post('mname'),
					'lname'				=> $this->input->post('lname'),
					'bdate'				=> $this->input->post('bdate'),
					'gender'			=> $this->input->post('gender'),
					'mobile'			=> $this->input->post('mobile'),
					'email'				=> $this->input->post('email'),
					'address'			=> $this->input->post('address'),
					'country'			=> $this->input->post('country'),
					'countryBirth'		=> $this->input->post('countryBirth'),
					'nationality'		=> $this->input->post('nationality'),
					'relationship'		=> $this->input->post('relationship'),
					'sourceFund'		=> $this->input->post('sourceFund'),
					'idType'			=> $this->input->post('idType'),
					'idExpiration'		=> $this->input->post('idExpiration'),
					'idNumber'			=> $this->input->post('idNumber'),
					'occupation'		=> $this->input->post('occupation'),
					'company'			=> $this->input->post('company'),
					'jobtitle'			=> $this->input->post('jobtitle'),
					'businessName'		=> $this->input->post('businessName'),
					'registrationDate'	=> $this->input->post('registrationDate'),
					'natureBusiness'	=> $this->input->post('natureBusiness'),
					'yearsInOperation'	=> $this->input->post('yearsInOperation'),
					'unemployed'		=> $this->input->post('unemployed'),
					'sftp_path'         => '/v1-sftp/remittance/'.$filename,
					'transtype'         => 'GOCAB CASH OUT'
				); 

				if ($upload_response['S'] == 1) {
					$result = $this->curl->call($parameter, url);
					$result = json_decode($result);
					echo json_encode($result);
				} else {
					$message = ['S'=>0,'M'=>'Upload failed.'];
					echo json_encode($message);
				}
			}else{
				$result = array("S"=>0,'M'=>"Invalid Image Size, Should be less than 2MB");
				echo json_encode($result);
			}
		}else{
			$result = array("S"=>0,'M'=>"Please Upload Image to proceed.");
			echo json_encode($result);
		}
	}

	function get_gocab_account_details(){
		$parameter =array(
			'dev_id'     		=> $this->global_f->dev_id(),
			'actionId'         	=> 'ups_gocab/gocab_account_details',
			'ip_address'		=> $this->ip,
			'regcode'           => $this->user['R'],
			'idID'				=> $this->input->post('id')
		);

		$result = $this->curl->call($parameter, url);
		$result = json_decode($result,true);

		$json_array = array(
			'MODAL' => $this->load->view('modal/gocab_account_details_modal', $result, true),
		);

		echo json_encode($json_array);
	}

	function get_id_details(){
		$parameter =array(
			'dev_id'     		=> $this->global_f->dev_id(),
			'actionId'         	=> 'ups_gocab/gocab_id_details',
			'ip_address'		=> $this->ip,
			'regcode'           => $this->user['R'],
			'search'			=> $this->input->post('search')
		);

		$result = $this->curl->call($parameter, url);
		$result = json_decode($result,true);


		// print_r($result);

		$json_array = array(
			'TABLE' => $this->load->view('remittance/ecash_payout/gocab_account_details', $result, true),
		);

		echo json_encode($json_array);
	}

	// function get_pending_id_details(){
	// 	$parameter =array(
	// 		'dev_id'     		=> $this->global_f->dev_id(),
	// 		'actionId'         	=> 'ups_gocab/gocab_pending_id_details',
	// 		'ip_address'		=> $this->ip,
	// 		'regcode'           => $this->user['R']
	// 	);

	// 	$result = $this->curl->call($parameter, url);
	// 	$result = json_decode($result,true);


	// 	// print_r($result);

	// 	$json_array = array(
	// 		'TABLE' => $this->load->view('remittance/ecash_payout/gocab_account_details', $result, true),
	// 	);

	// 	echo json_encode($json_array);
	// }

	//GOCAB SHIPPER CASHOUT END

	private function sftp_upload_file($filename,$localfile) {
		$host = '210.213.236.42';
        $port = '3333';
        $username = 'v1-sftp';
        $password = '0yNiXW\(';
        $remoteDir = '/v1-sftp/remittance/';

        if (!function_exists("ssh2_connect"))
            die('Function ssh2_connect not found, you cannot use ssh2 here');

        if (!$connection = ssh2_connect($host, $port))
            die('Unable to connect');

        if (!ssh2_auth_password($connection, $username, $password))
            die('Unable to authenticate.');

        if (!$stream = ssh2_sftp($connection))
            die('Unable to create a stream.');

        $credentials = intval($stream);

        $stream_path = "ssh2.sftp://{$credentials}{$remoteDir}{$filename}";

		$resFile = fopen("ssh2.sftp://{$resSFTP}{$remoteDir}{$filename}", 'w');
		$srcFile = fopen($localfile, 'r');
		$writtenBytes = stream_copy_to_stream($srcFile, $resFile);
		fclose($resFile);
		fclose($srcFile);

        //echo file_get_contents($stream_path); 
		
		return;
	}
}