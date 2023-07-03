<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Remittance_transactions extends CI_Controller {

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

	  	// if ($this->user['USER_KYC'] != 'APPROVED') 
		// {
		//   	redirect('Main');
		// }
	}

	public function index()
	{	
		if ($this->user['A_CTRL']['remittance'] == 1 && $this->user['R'] != 'G5457340')
		{
			$data = array('menu' => 'remittance_transactions', 'parent'=>'REMITTANCE');

			if ($this->user['S'] == 1 && $this->user['R'] !="")
			{
				$data['user'] 		= $this->user;
				$data['level'] 		= $this->user['L'];
				$data['userR'] 		= $this->user['R'];
				
				$this->load->view('remittance/remittance_transactions/index', $data);
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

	public function fetch_transaction(){
		$url = url;
				
		$parameter =array(
			'dev_id'     	=> $this->global_f->dev_id(),
			'regcode' 		=> $this->user['R'],
			'actionId' 		=> 'ups_kyc_remittance/fetch_transaction',
			'ip_address' 	=> $this->ip,
			$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
		); 
		$response = json_decode($this->curl->call($parameter, url), true);

		echo json_encode($response);
		exit;
	}

	public function remittanceTransaction()
	{
		$url = url;
		$trackno = $this->input->post('trackno');

		$parameter = array(
			'dev_id'     	=> $this->global_f->dev_id(),
			'regcode' 		=> $this->user['R'],
			'trackno'		=> $trackno,
			'actionId' 		=> 'ups_kyc_remittance/fetch_remittanceTransaction',
			'ip_address' 	=> $this->ip,
			$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
		);
		$response = json_decode($this->curl->call($parameter, url), true);

		echo json_encode($response);
		exit;
	}

	public function ecash_to_ecash(){
		$url = url;
		$client_regcode = $this->input->post('client_regcode');
		$transpass 		= $this->input->post('svpass');
		$amount 		= $this->input->post('amount');
		$trackingNo 	= $this->input->post('trackingNo');
		
		$parameter = array(
			'dev_id'     	=> $this->global_f->dev_id(),
			'regcode' 		=> $this->user['R'],
			'actionId' 		=> 'ups_ecash_service/ecash_to_ecash_test',
			'client_regcode'=> $client_regcode,
			'svpass'		=> $transpass,
			'amount'		=> $amount,
			'trackingNo'	=> $trackingNo,
			'ip_address' 	=> $this->ip,
			$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
		);
		$response = json_decode($this->curl->call($parameter, $url), true);

		echo json_encode($response);
		exit;
	}

	public function ecash_to_ecash_dealer(){
		$url = url;
		$s_regcode 		= $this->input->post('s_regcode');
		$client_regcode = $this->input->post('client_regcode');
		$transpass 		= $this->input->post('svpass');
		$amount 		= $this->input->post('amount');
		$trackingNo 	= $this->input->post('trackingNo');
		
		$parameter = array(
			'dev_id'    	 => $this->global_f->dev_id(),
			'regcode' 		 => $this->user['R'],
			's_regcode' 	 => $s_regcode,
			'actionId' 		 => 'ups_ecash_service/ecash_to_ecash_test_dealer',
			'client_regcode' => $client_regcode,
			'transpass'		 => $transpass,
			'amount'		 => $amount,
			'trackingNo'	 => $trackingNo,
			'ip'	 		 => $this->ip,
			'ip_address'	 => $this->ip,
			$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
		);
		$response = json_decode($this->curl->call($parameter, $url), true);

		echo json_encode($response);
		exit;
	}

	public function ecash_padala(){
		$url = url;

		$regcode 	= $this->input->post('client_regcode');
		$transpass 	= $this->input->post('svpass');
		$amount 	= $this->input->post('amount');
		
		$sender_id 	= $this->input->post('sender_id');
		$sender_mobile 	= $this->input->post('sender_mobile');
		
		$bene_id 	= $this->input->post('bene_id');
		$bene_name 	= $this->input->post('bene_name');
		
		$parameter = array(
			'dev_id'     	=> $this->global_f->dev_id(),
			'regcode' 		=> $this->user['R'],
			'actionId' 		=> "/ups_ecash_service/remittance_send_ecash_padala_test",
			'transpass'		=> $transpass,
			'amount'		=> $amount,
			'ip_address' 	=> $this->ip,
			'sender_id'		=> $sender_id,
			'sender_mobile' => $sender_mobile,
			'bene_id'		=> $bene_id,
			'bene_name'		=> $bene_name,
			$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
		);
		$response = json_decode($this->curl->call($parameter, $url), true);

		echo json_encode($response);
		exit;
	}

	public function transaction_deny(){
		$url = url;

		$trackno 	= $this->input->post('trackno');
		$transpass 	= $this->input->post('transpass');
		
		$parameter = array(
			'dev_id'     	=> $this->global_f->dev_id(),
			'regcode' 		=> $this->user['R'],
			'actionId' 		=> 'ups_kyc_remittance/deny_transaction',
			'trackno'		=> $trackno,
			'transpass'		=> $transpass,
			'ip_address' 	=> $this->ip,
			$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
		);
		$response = json_decode($this->curl->call($parameter, $url), true);

		echo json_encode($response);
		exit;

	}

	public function transaction_deny_sv(){
		$url = url;

		$trackno 	= $this->input->post('trackno');
		$transpass 	= $this->input->post('transpass');
		
		$parameter = array(
			'dev_id'     	=> $this->global_f->dev_id(),
			'regcode' 		=> $this->user['R'],
			'actionId' 		=> 'ups_kyc_remittance/deny_transaction_sv',
			'trackno'		=> $trackno,
			'transpass'		=> $transpass,
			'ip_address' 	=> $this->ip,
			$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
		);
		$response = json_decode($this->curl->call($parameter, $url), true);

		echo json_encode($response);
		exit;

	}

	public function downloadSftpFile($filename) {
        $remoteDir = '/v1-sftp/kyc-remittance/';

        if (!function_exists("ssh2_connect"))
            die('Function ssh2_connect not found, you cannot use ssh2 here');

        if (!$connection = ssh2_connect(SFTP_HOST, SFTP_PORT))
            die('Unable to connect');

        if (!ssh2_auth_password($connection, SFTP_UN, SFTP_PW))
            die('Unable to authenticate.');

        if (!$stream = ssh2_sftp($connection))
            die('Unable to create a stream.');

        $credentials = intval($stream);

        $stream_path = "ssh2.sftp://{$credentials}{$remoteDir}{$filename}";

        header('Content-Type: image/png');

        header("Content-Disposition:attachment;filename=\"$filename\"");

        header("Content-length: " . filesize($stream_path) . "\n\n");

        echo file_get_contents($stream_path);        

        return;
    }

}