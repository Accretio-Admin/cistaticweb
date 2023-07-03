<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Remit_form extends CI_Controller {

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
		if ($this->user['A_CTRL']['remittance'] == 1 && $this->user['R'] != 'G5457340')
		{
			$data = array('menu' => 2, 'parent'=>'REMITTANCE');

			if ($this->user['S'] == 1 && $this->user['R'] !="")
			{
				$data['user'] = $this->user;

				if (substr($this->user['R'], 0, 3) == 'GWL') //For Wealthylifestyle
				{
					$data['exceed_wu'] = $this->check_trans->transCount($this->user['R'], 152)['S'];
					$data['exceed_sm'] = $this->check_trans->transCount($this->user['R'], 7)['S'];
					$data['exceed_ec_to_ec'] = $this->check_trans->transCount($this->user['R'], 22)['S'];
					$data['exceed_ec_padala'] = $this->check_trans->transCount($this->user['R'], 60)['S'];
					$data['exceed_cd_to_bank'] = $this->check_trans->transCount($this->user['R'], 32)['S'];
					$data['exceed_ec_to_cebuana'] = $this->check_trans->transCount($this->user['R'], 81)['S'];
					$data['exceed_ec_to_cashcard'] = $this->check_trans->transCount($this->user['R'], 80)['S'];
					
					$this->load->view('remittance/ecash_send/gwl_index', $data);
				}
				else
				{
					$url = url;
					
					$parameter = array(
						'dev_id'	=>$this->global_f->dev_id(),
						'actionId'	=>'ups_user/regcode_filter',
						'regcode'	=>$this->user['R'],
						'ip_address' =>$this->ip,
						'filter_in'	=>'ecpay'
					); 
					$result = $this->curl->call($parameter,$url);
					$results = json_decode($result,true);
					$data['filter_ecpay'] = $results['R'];

					$this->load->view('remittance/remit_form/index', $data);
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

}
