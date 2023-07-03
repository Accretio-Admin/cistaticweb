<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emergencyfunds extends CI_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->model('curl_model','curl');
		$this->load->library('session');
		$this->user = $this->session->userdata('user');
        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)){
            $IP = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
			$IP = $IP[0];
        }else{
            $IP = $_SERVER['REMOTE_ADDR'];
        }
	    $this->ip = $IP;
	    $this->load->model('Query_model','q');
	  	$this->load->model('Report_model','r');
	  	$this->load->model('Global_function','global_f');
        $this->load->model('Sp_model');
        date_default_timezone_set('Asia/Manila');
        ini_set('max_execution_time', 300); //300 seconds = 5 minutes
	}


	public function index()
	{	
    }

    public function ecashLoanBal(){
        $url = url;
        $parameter =array(
            'dev_id'=> $this->global_f->dev_id(),
            'actionId'=> 'ups_ecash_loan_service/check_ecashLoanBal',
            'regcode'=>$this->user['R'],
            'loanid'=>$this->user['QLS']['LID'],
            'ip_address'=>$this->ip,
            $this->user['SKT'] => md5($this->user['R'].$this->user['SKT'])
        );
        // print_r($this->user['QLS']);
        $result = $this->curl->call($parameter,$url);
        print_r($result);
        $result = json_decode($result);
        if($result->S==1) {
            $this->user['QLS']['S'] = 1;
            $keys = array_keys( (array) $result->ACCESS);
            $access = (array) $result->ACCESS;
            foreach($keys as $key) {
                $this->user['A_CTRL'][$key]=$access[$key];
            }
        } else {
            $this->user['QLS']['S'] = 2;
            $keys = array_keys( (array) $result->ACCESS);
            $access = (array) $result->ACCESS;
            foreach($keys as $key) {
                $this->user['A_CTRL'][$key]=$access[$key];
            }
        }
        $this->user['QLS']['M'] = $result->M;
        $data['user'] = $this->global_f->get_user_session();
    }
    
    public function submit_loan(){
            $url = url;
            $parameter =array(
                'dev_id'=> $this->global_f->dev_id(),
                'actionId'=> 'ups_ecash_loan_service',
                'regcode'=>$this->user['R'],
                'amount'=>$_POST['ef_hsv_templv'],
                'ip_address'=>$this->ip,
                'transpass'=>$_POST['p'],
                $this->user['SKT'] => md5($this->user['R'].$this->user['SKT'].$_POST['p'])
            );
            $result = $this->curl->call($parameter,$url);
            $result = json_decode($result);
            $ec = '';
            $result_s = null;
            $lid = numfmt_get_locale;
            if(is_object($result)) {
                if ($result->S == 1) {
                    $ec = $result->EC;
                    $result_s = $result->S;
                    $lid = $result->LID;
                }
            } else {
                if ($result['S'] == 1) {
                    $ec = $result['EC'];
                    $result_s = $result['S'];
                    $lid = $result['LID'];
                }
            } 
            if($result_s==1) {
                $this->user['EC'] = $ec;
                $this->user['QLS']['LID'] = $result->LID;
                $this->user['QLS']['S'] = 2;
                // $this->user['A_CTRL']['remittance_eclf_send'] = 0;
                $this->user['A_CTRL']['remittance_ecsg_send'] = 0;
                $this->user['A_CTRL']['remittance_ecash_send'] = 0;
                $this->user['A_CTRL']['remittance_smartmoney_send'] = 0;
                $this->user['A_CTRL']['remittance_gprs_send'] = 0;
                $this->user['A_CTRL']['remittance_creditbank_send'] = 0;
                $this->user['A_CTRL']['remittance_ecad_send'] = 0;
                $this->user['A_CTRL']['remittance_baremi_send'] = 0;
                $this->user['A_CTRL']['remittance_westernunion_send'] = 0;
                $this->user['A_CTRL']['remittance_cebuana'] = 0;
                $this->user['A_CTRL']['remittance_egive_send'] = 0;
                // $this->user['A_CTRL']['remittance_ecash_forexconversion'] = 0;

                $data['user'] = $this->global_f->get_user_session();
            }
            echo json_encode($result);        
    }

}

// *regcode
// *amount
// *ip

// Array ( [a] => 10000 [r] => 1234567 [ef_hsv_templv] => 5000 [svc_fee] => 150 [total] => 5150 ) 192.168.64.1