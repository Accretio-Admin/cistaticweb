<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Courier extends CI_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	    $this->load->model('Curl_model','curl');
		$this->load->model('Check_transaction', 'check_trans');
		$this->user = $this->session->userdata('user');

	  	if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER))
		{
            $IP_wed = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
			$IP_wed = $IP[0];
	   	}
		else
		{
			$IP_wed = $_SERVER['REMOTE_ADDR'];
		}
		
	    $this->ip = $IP_wed;
	    $this->load->model('Query_model');
	  	$this->load->model('Global_function','global_f');
	  	$this->load->model('Sp_model');
	}

	public function index(){
		$this->load->view('courier/index', $data); 
	}

	public function approve(){
		$trackNo = $this->input->get('trackNo');
		$ip      = $this->input->get('ip');

		$url1 = 'https://upsmobileapi.azurewebsites.net/Courier/approveCallback';

		$parameter1 = array(
			'trackNo' => $trackNo,
			'ip'      => $ip,
		); 
		
		$result = $this->curl->call($parameter1, $url1);
		$data['response1'] = json_decode($result, true);

		if($data['response1']['S'] == 1){
			$url2 = 'https://upsmobileapi.azurewebsites.net/Courier/fetchTracknoDetails';

			$parameter2 = array(
				'trackNo' => $trackNo,
			); 

			$result = $this->curl->call($parameter2, $url2);
			$data['response2'] = json_decode($result, true);

			if($data['response2']['S'] == 1){
				$tmp_data = $data['response2']['M'];
				$data['trackno'] = $tmp_data['trackNo'];
				$data['regcode'] = $tmp_data['regcode'];
				$data['amount']  = $tmp_data['amount'];
				$data['from']    = $tmp_data['from'];
				$data['to']      = $tmp_data['to'];
				$data['status']  = $tmp_data['status'];
                    
                // TESTING DATA
                
				// $data['trackno'] = 'CR1234567QAEDRF';
				// $data['regcode'] = '1234567';
				// $data['amount']  = '1000.00';
				// $data['from']    = '229 Roosevelt Avenue, San Francisco del Monte, Quezon City, Metro Manila, Philippines';
				// $data['to']      = '229 Roosevelt Avenue, San Francisco del Monte, Quezon City, Metro Manila, Philippines';
				// $data['status']  = 'APPROVED';
			}

			$this->load->view('courier/index', $data); 
		}else{
			$this->load->view('courier/index', $data); 
		}
	}

	public function deny(){
		$trackNo = $this->input->get('trackNo');
		$ip      = $this->input->get('ip');

		$url1 = 'https://upsmobileapi.azurewebsites.net/Courier/denyCallback';

		$parameter1 =array(
			'trackNo' => $trackNo,
			'ip'      => $ip,
		); 
		
		$result = $this->curl->call($parameter1, $url1);
		$data['response1'] = json_decode($result, true);

		if($data['response1']['S'] == 1){
			$url2 = 'https://upsmobileapi.azurewebsites.net/Courier/fetchTracknoDetails';

			$parameter2 = array(
				'trackNo' => $trackNo,
			); 

			$result = $this->curl->call($parameter2, $url2);
			$data['response2'] = json_decode($result, true);

			if($data['response2']['S'] == 1){
				$tmp_data = $data['response2']['M'];
				$data['trackno'] = $tmp_data['trackNo'];
				$data['regcode'] = $tmp_data['regcode'];
				$data['amount']  = $tmp_data['amount'];
				$data['from']    = $tmp_data['from'];
				$data['to']      = $tmp_data['to'];
				$data['status']  = $tmp_data['status'];

                // TESTING DATA
                
				// $data['trackno'] = 'CR1234567QAEDRF';
				// $data['regcode'] = '1234567';
				// $data['amount']  = '1000.00';
				// $data['from']    = '229 Roosevelt Avenue, San Francisco del Monte, Quezon City, Metro Manila, Philippines';
				// $data['to']      = '229 Roosevelt Avenue, San Francisco del Monte, Quezon City, Metro Manila, Philippines';
				// $data['status']  = 'DENIED';
			}

			$this->load->view('courier/index', $data); 
		}else{
			$this->load->view('courier/index', $data); 
		}
	}


}

?>