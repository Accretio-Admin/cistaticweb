<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ecash_transactions extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	    $this->load->model('Curl_model','curl');
		$this->load->model('Check_transaction', 'check_trans');
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

	  	if ($this->user['USER_KYC'] != 'APPROVED') 
		{
		  	redirect('Main');
		}
	}

	public function index()
	{
		if (($this->user['A_CTRL']['remittance'] == 1 && $this->user['R'] != 'G5457340') || $this->user['RET'] == 1)
		{

			$data = array('menu' => 'ecash_transactions', 'parent'=>'REMITTANCE' );

			 if ($this->user['S'] == 1 && $this->user['R'] != "")
			 {
				$data['user'] = $this->user;
				$data['level'] = $this->user['L'];
				if(($data['level'] != 7) && ($data['level'] != 16)){                    
					$data['DEALER']['M'] = "DEALER";
				}else{
					$data['DEALER']['M'] = "";
				}

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('remittance/ecash_transactions/main_panel');
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');
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

	function fetchPENDING(){
		$url = url;
				
		$parameter = array(
			'dev_id' 	 => $this->global_f->dev_id(),
			'actionId' 	 => 'ups_ecash_service/fetch_pending_transaction', 
			'ip_address' => $this->ip, 
			'regcode'	 => $this->user['R'],
			$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
		); 

		$result = $this->curl->call($parameter,$url);
		$data['row'] = json_decode($result,true);
		
		echo json_encode($data['row']);
		// print_r($data['row']); die();
		if ($data['row']['S']==1) {
			$data['type'] = array('typeid'=>1,
									'typedesc'=>'Pending');
		}
	}

	function fetchAPPROVED(){
		$url = url;
				
		$parameter = array(
			'dev_id' 	 => $this->global_f->dev_id(),
			'actionId' 	 => 'ups_ecash_service/fetch_approved_transaction', 
			'ip_address' => $this->ip, 
			'regcode'	 => $this->user['R'],
			$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
		); 

		$result = $this->curl->call($parameter,$url);
		$data['row'] = json_decode($result,true);
		
		echo json_encode($data['row']);
		// print_r($data['row']); die();
		if ($data['row']['S']==1) {
			$data['type'] = array('typeid'=>1,
									'typedesc'=>'Approved');
		}
	}

	function fetchDENIED(){
		$url = url;
				
		$parameter = array(
			'dev_id' 	 => $this->global_f->dev_id(),
			'actionId' 	 => 'ups_ecash_service/fetch_denied_transaction', 
			'ip_address' => $this->ip, 
			'regcode'	 => $this->user['R'],
			$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
		); 

		$result = $this->curl->call($parameter,$url);
		$data['row'] = json_decode($result,true);
		
		echo json_encode($data['row']);
		// print_r($data['row']); die();
		if ($data['row']['S']==1) {
			$data['type'] = array('typeid'=>1,
									'typedesc'=>'Denied');
		}
	}
	
	function validateOTP(){
		$traceno = $this->input->post('traceno');
		$otp = $this->input->post('otp');
		$transpass = $this->input->post('transpass');

		$url = url;

		$parameter =array(
			'actionId' 	  => 'ups_ecash_service/otpValidate',
			'dev_id' 	  => $this->global_f->dev_id(),
			'regcode'	  => $this->user['R'],
			'traceno'	  => $traceno,
			'otp'	  	  => $otp,
			'transpass'	  => $transpass,
			'ip_address'  => $this->ip
		);

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}
	

	function confirmTransaction(){
		$transpass = $this->input->post('transpass');
		$traceno = $this->input->post('traceno');
		$action = $this->input->post('action');
		$item_type = $this->input->post('item_type');
		$photolink = $this->input->post('photolink');
		$risklevel = $this->input->post('risklevel');
		$comment = $this->input->post('comment');

		$url = url;

		if($risklevel == "HIGH" && $action == "APPROVED"){
			for($i = 1; $i <= 1; $i++){
				${'file'.$i} 			= $_FILES['file'.$i];
				${'file'.$i.'Name'} 	= ${'file'.$i}['name'];
				${'file'.$i.'Size'}		= ${'file'.$i}['size'];
				${'file'.$i.'Temp'}		= ${'file'.$i}['tmp_name'];
				${'file'.$i.'Error'} 	= ${'file'.$i}['error'];
			}
	
			// echo json_encode($file1); die();
			if($file1Size < 2*MB) {
	
				for($a = 1; $a <= 1; $a++){
	
					${'url'.$a} = ${'file'.$a.'Temp'};
					if(${'file'.$a.'Size'} > 1*MB)
					{
						${'old_size'.$a} = ${'file'.$a.'Size'};
						${'urltmp'.$a}	 = sys_get_temp_dir().'/tmp.jpg';
						
						${'filename'.$a} = $this->compress_image(${'file'.$a.'Size'}, ${'urltmp'.$a}, 75);
						${'new_size'.$a} = filesize(${'urltmp'.$a});
					
						if(${'new_size'.$a} < ${'old_size'.$a})
						{
							${'url'.$a} = ${'urltmp'.$a};
						}
					}
					
					${'curl'.$a} = curl_init();
					${'localfile'.$a} = ${'url'.$a};
				}
	
				for($i = 1; $i <= 1; $i++){
					curl_setopt_array(${'curl'.$i}, array(
						CURLOPT_URL => 'https://unified.ph/kyc-upload',
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_ENCODING => '',
						CURLOPT_MAXREDIRS => 10,
						CURLOPT_TIMEOUT => 0,
						CURLOPT_FOLLOWLOCATION => true,
						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						CURLOPT_CUSTOMREQUEST => 'POST',
						CURLOPT_POSTFIELDS => array('file'=> new CURLFILE(${'localfile'.$i}),'file_location' => 'kyc-remittance','regcode' => $this->user['R'],'email' => '123','ext_name' => '.jpg'),
					));
					
					${'response'.$i} = curl_exec(${'curl'.$i}); 
					curl_close(${'curl'.$i});
					${'upload_response'.$i} = json_decode(${'response'.$i},true);
				}
				
				$id1 = $upload_response1['F'];
	
				if($id1){
					$id1 = "/v1-sftp/kyc-remittance/OTP_".$upload_response1['F'];
				}else{
					echo "UPLOADING IMAGE FAILED"; die();
				}
	
				// echo json_encode($id1); die();
			}else{
				echo "FILE SIZE TOO BIG MUST BE LESS THAN 2MB"; die();
			}
		}
		
		
		$parameter =array(
			'actionId' 	 => 'ups_ecash_service/remittance_send_ecash_padala_bsp_confirm',
			'dev_id' 	 => $this->global_f->dev_id(),
			'regcode'	 => $this->user['R'],
			'transpass'  => $transpass,
			'traceno' 	 => $traceno,
			'action' 	 => $action,
			'item_type'	 => $item_type,
			'photolink'  => $id1,
			'comment'  	 => $comment,
			'ip_address' => $this->ip
		); 

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);

	}
	
	function ecashpadalaTransacBSP(){
		$traceno = $this->input->post('traceno');

		$url = url;

		$parameter =array(
			'actionId' 	 => 'ups_ecash_service/remittance_send_ecash_padala_bsp_transac',
			'dev_id' 	 => $this->global_f->dev_id(),
			'regcode'	 => $this->user['R'],
			'traceno' 	 => $traceno,
			'ip_address' => $this->ip,
			'ip' => $this->ip
		); 

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}

	function credittobankTransacBSP(){
		$traceno = $this->input->post('traceno');

		$url = url;

		$parameter =array(
			'actionId' 	 => 'ups_ecash_service/remittance_send_credit_bank_bsp_transac',
			'dev_id' 	 => $this->global_f->dev_id(),
			'regcode'	 => $this->user['R'],
			'traceno' 	 => $traceno,
			'ip_address' => $this->ip,
			'ip' => $this->ip
		); 

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}

	function ecashwallettopupTransacBSP(){
		$traceno = $this->input->post('traceno');

		$url = url;

		$parameter =array(
			'actionId' 	 => 'ups_ecash_service/remittance_wallet_topup_bsp_transac',
			'dev_id' 	 => $this->global_f->dev_id(),
			'regcode'	 => $this->user['R'],
			'traceno' 	 => $traceno,
			'ip_address' => $this->ip,
			'ip' => $this->ip
		); 

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}
	
	function ecashtocebuanaTransacBSP(){
		$traceno = $this->input->post('traceno');

		$url = url;

		$parameter =array(
			'actionId' 	 => 'ups_cebuana_service_jorel/send_cebuana_remittance',
			'dev_id' 	 => $this->global_f->dev_id(),
			'regcode'	 => $this->user['R'],
			'traceno' 	 => $traceno,
			'ip_address' => $this->ip,
			'ip' => $this->ip
		); 

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}

	function notify_sender_receiver(){
		$traceno = $this->input->post('traceno');
		$refno = $this->input->post('refno');
		$type = $this->input->post('type');
		
		$url = url;
		
		$parameter =array(
			'actionId' 	 => 'ups_ecash_service/notifySenderReceiver',
			'dev_id' 	 => $this->global_f->dev_id(),
			'regcode'	 => $this->user['R'],
			'traceno'	 => $traceno,
			'refno'	  	 => $refno,
			'type'	  	 => $type,
			'ip_address' => $this->ip
		);

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}

	function fetch_transactionDetails(){
		$traceno = $this->input->post('traceno');
		
		$url = url;
		
		$parameter =array(
			'actionId' 	 => 'ups_ecash_service/fetch_traceno_details',
			'dev_id' 	 => $this->global_f->dev_id(),
			'regcode'	 => $this->user['R'],
			'traceno'	 => $traceno,
			'ip_address' => $this->ip
		);

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}

	function riskProfiling(){
		$traceno = $this->input->post('traceno');
		
		$url = url;

		$parameter =array(
			'actionId' 	  => 'ups_ecash_service/risk_profiling',
			'dev_id' 	  => $this->global_f->dev_id(),
			'regcode'	  => $this->user['R'],
			'traceno'	  => $traceno,
			'ip_address'  => $this->ip
		);

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}

	function sendOTP(){
		$traceno = $this->input->post('traceno');
		
		$url = url;

		$parameter =array(
			'actionId' 	  => 'ups_ecash_service/checkRiskProfile',
			'dev_id' 	  => $this->global_f->dev_id(),
			'regcode'	  => $this->user['R'],
			'traceno'	  => $traceno,
			'ip_address'  => $this->ip
		);

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}

	function fetch_ecashpadala_rate(){
		$amount = $this->input->post('amount');
		
		$url = url;
		
		$parameter =array(
			'actionId' 	 => 'ups_ecash_service/ecashpadala_rates_bsp',
			'dev_id' 	 => $this->global_f->dev_id(),
			'regcode'	 => $this->user['R'],
			'amount'	 => $amount,
			'ip_address' => $this->ip
		);

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}

	function fetch_ecashcredittobank_rate(){
		$amount = $this->input->post('amount');
		
		$url = url;
		
		$parameter =array(
			'actionId' 	 => 'ups_ecash_service/ecashcredittobank_rates_bsp',
			'dev_id' 	 => $this->global_f->dev_id(),
			'regcode'	 => $this->user['R'],
			'amount'	 => $amount,
			'ip_address' => $this->ip
		);

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}

	function fetch_ecash_wallettopup_rate(){
		$amount = $this->input->post('amount');
		$service = $this->input->post('service');
		
		$url = url;
		
		$parameter =array(
			'actionId' 	 => 'ups_ecash_service/eccashwallettopup_rates_bsp',
			'dev_id' 	 => $this->global_f->dev_id(),
			'regcode'	 => $this->user['R'],
			'amount'	 => $amount,
			'service'    => $service,
			'ip_address' => $this->ip
		);

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}

	function fetch_ecashtocebuana_rate(){
		$currencyid = $this->input->post('currency_id');
		$amount = $this->input->post('amount');
		
		$url = url;
		
		$parameter =array(
			'dev_id'      => $this->global_f->dev_id(),
			'actionId' 	  => _get_domestic_rates,
			'ip_address'  => $this->ip,
			'regcode'     => $this->user['R'],
			'currency_id' => $currencyid,
			'amount'      => $amount
		);

		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
	}
}

?>