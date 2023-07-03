<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Kyc_remittance extends CI_Controller {

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
		if ($this->user['A_CTRL']['remittance'] == 1){

		    $data = array('menu' => 'kyc_remittance',
					 'parent'=>'REMITTANCE' );
		
			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['mlm_user'] = $this->session->userdata('MLM_user');
				$data['user'] = $this->user;
				$data['level'] = $this->user['L'];
				$data['regcode'] = $this->user['R'];
                
                $this->load->view('remittance/remit_form/index', $data); 
            }else {
                $this->session->sess_destroy();
                redirect('Login/');
            }
        }else {
            redirect('Main/');
        }
    }

    
    public function trans_test(){
        $rowid                  = $this->input->post('rowid');
        $service                = $this->input->post('service');
        $s_relationToReceiver   = $this->input->post('s_relationToReceiver');
        $s_purpose              = $this->input->post('s_purpose');
        $amount                 = $this->input->post('amount');
        $r_refNo                = $this->input->post('r_refNo');
        $r_fname                = $this->input->post('r_fname');
        $r_mname                = $this->input->post('r_mname');
        $r_lname                = $this->input->post('r_lname');
        $r_address              = $this->input->post('r_address');
        $r_country              = $this->input->post('r_country');
        $r_birthDate            = $this->input->post('r_birthDate');
        $r_mobile               = $this->input->post('r_mobile');
        $r_email                = $this->input->post('r_email');
        $bank                   = $this->input->post('bank');
        $accountNo              = $this->input->post('accountNo');
        $ip                     = $this->input->post('ip_address');
        $TRACKNO                = '';
        $TRANSPASS              = $this->input->post('transpass');
        $url = url;
        $parameter =array(
            'dev_id'     	        => $this->global_f->dev_id(),
            'regcode' 		        => $this->user['R'],
            'userlevel' 		    => $this->user['L'],
            'actionId' 		        => 'ups_kyc_remittance/remittance_transact',
            'rowid'                 => $rowid,
            'service'               => $service,
            's_relationToReceiver'  => $s_relationToReceiver,
            's_purpose'             => $s_purpose,
            'amount'                => $amount,
            'r_refNo'               => $r_refNo,
            'r_fname'               => $r_fname,
            'r_mname'               => $r_mname,
            'r_lname'               => $r_lname,
            'r_address'             => $r_address,
            'r_country'             => $r_country,
            'r_birthDate'           => $r_birthDate,
            'r_mobile'              => $r_mobile,
            'r_email'               => $r_email, 
            'bank'                  => $bank, 
            'accountNo'             => $accountNo, 
            'transpass'             => $TRANSPASS, 
            'ip_address' 	        => $this->ip,

            $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
        ); 
		$response = json_decode($this->curl->call($parameter, url), true);

		echo json_encode($response);
        exit;
    }

    public function search_kyc(){
        $fname      = $this->input->post('fname');
        $lname      = $this->input->post('lname');

        $url = url;

        $parameter =array(
			'dev_id'    => $this->global_f->dev_id(),
			'regcode'   => $this->user['R'],
            'actionId'  => 'ups_kyc_remittance/fetch_approvedSender',
            'fname'     => $fname,
            'lname'     => $lname,
			'ip_address'=> $this->ip,
			$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
        ); 
		$response = json_decode($this->curl->call($parameter, $url), true);

		echo json_encode($response);
        exit;
    }

    public function fetch_senderDetails(){
        $url = url;
        $rowid = $this->input->post('rowid');

        $parameter = array(
            'dev_id'     	=> $this->global_f->dev_id(),
            'regcode'		=> $this->user['R'],
            'rowid'         => $rowid,
            'actionId' 		=> 'ups_kyc_remittance/fetch_senderDetails',
            'ip_address' 	=> $this->ip,
            $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
        ); 
        $response = json_decode($this->curl->call($parameter, $url), true);

		echo json_encode($response);
        exit;
    }

    public function fetch_banks(){
        $url = url;
        $parameter =array(
            'dev_id'     		=> $this->global_f->dev_id(),
            'actionId' 	 		=> _get_active_banks,
            'search_key'   	 	=>$search,
            'regcode' 			=>$this->user['R'],
            'ip_address'		=>$this->ip
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



?>