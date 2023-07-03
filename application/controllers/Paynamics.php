<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Paynamics extends CI_Controller {

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

	}

    public function index()
	{
		$this->load->view('remittance/paynamics/index', $data); 
    }

	public function approve(){
		$regcode        = $this->input->get('regcode');
		$email          = implode("@", explode("%40", $this->input->get('email')));
		$amount         = $this->input->get('amount');
		$trackNo        = $this->input->get('trackNo');
		$ip             = $this->input->get('ip');
		$message        = implode(" ", explode("%20", $this->input->get('message')));
		$charge         = $this->input->get('charge');
		$income         = $this->input->get('income');
		$companyincome  = $this->input->get('companyincome');


		$url1 = 'https://mobileapi.unified.ph/ups_paynamics/approveCashin';

		$parameter1 =array(
			'actionId' 	=> 'ups_paynamics/approveCashin',
			'regcode'   => $regcode,
			'amount'    => $amount,
			'trackNo'   => $trackNo,
			'ip'        => $ip,
			'charge'    => $charge,
			'income'    => $income,
			'companyincome' => $companyincome,
		); 
		

		$result = $this->curl->call($parameter1, $url1);
		$data['response1'] = json_decode($result, true);

		if($data['response1']['S'] == 1){
			$trackNo = $this->input->get('trackNo');
			$charge  = $this->input->get('charge');

			$url2 = 'https://mobileapi.unified.ph/ups_paynamics/fetchTracknoDetails';

			$parameter2 =array(
				'actionId' 	=> 'ups_paynamics/fetchTracknoDetails',
				'trackNo'   => $trackNo,
				'charge'    => $charge,
				'income'    => $income,
				'companyincome' => $companyincome,
			); 

			$result = $this->curl->call($parameter2, $url2);
			$data['response2'] = json_decode($result, true);


			if($data['response2']['S'] == 1){
				$tmp_data = $data['response2']['M'];
				$data["trackno"]	= $tmp_data['trackno'];
				$data["message"]	= $tmp_data['message'];
				$data["charge"]		= $tmp_data['charge'];
				$data["regcode"]	= $tmp_data['regcode'];
				$data["email"]		= $tmp_data['email'];
				$data["amount"]		= $tmp_data['amount'];
				$data['status']		= $tmp_data['status'];
				$data['income']		= $tmp_data['income'];
				$data['companyincome'] = $tmp_data['companyincome'];
			}

			$this->load->view('remittance/paynamics/index', $data); 
		}else{
			$this->load->view('remittance/paynamics/index', $data); 
		}
	}

	public function deny(){
		$regcode        = $this->input->get('regcode');
		$email          = implode("@", explode("%40", $this->input->get('email')));
		$amount         = $this->input->get('amount');
		$trackNo        = $this->input->get('trackNo');
		$ip             = $this->input->get('ip');
		$message        = implode(" ", explode("%20", $this->input->get('message')));
		$charge         = $this->input->get('charge');
		$income         = $this->input->get('income');
		$companyincome  = $this->input->get('companyincome');


		$url1 = 'https://mobileapi.unified.ph/ups_paynamics/denyCashin';

		$parameter1 =array(
			'actionId' 	=> 'ups_paynamics/denyCashin',
			'regcode'   => $regcode,
			'amount'    => $amount,
			'trackNo'   => $trackNo,
			'ip'        => $ip,
			'charge'    => $charge,
			'income'    => $income,
			'companyincome' => $companyincome,
		); 
		

		$result = $this->curl->call($parameter1, $url1);
		$data['response1'] = json_decode($result, true);

		if($data['response1']['S'] == 1){
			$trackNo = $this->input->get('trackNo');
			$charge  = $this->input->get('charge');

			$url2 = 'https://mobileapi.unified.ph/ups_paynamics/fetchTracknoDetails';

			$parameter2 =array(
				'actionId' 	=> 'ups_paynamics/fetchTracknoDetails',
				'trackNo'   => $trackNo,
				'charge'    => $charge,
				'income'    => $income,
				'companyincome' => $companyincome,
			); 

			$result = $this->curl->call($parameter2, $url2);
			$data['response2'] = json_decode($result, true);


			if($data['response2']['S'] == 1){
				$tmp_data = $data['response2']['M'];
				$data["trackno"]	= $tmp_data['trackno'];
				$data["message"]	= $tmp_data['message'];
				$data["charge"]		= $tmp_data['charge'];
				$data["regcode"]	= $tmp_data['regcode'];
				$data["email"]		= $tmp_data['email'];
				$data["amount"]		= $tmp_data['amount'];
				$data['status']		= $tmp_data['status'];
				$data['income']		= $tmp_data['income'];
				$data['companyincome'] = $tmp_data['companyincome'];
			}

			$this->load->view('remittance/paynamics/index', $data); 
		}else{
			$this->load->view('remittance/paynamics/index', $data); 
		}
	}


}

?>