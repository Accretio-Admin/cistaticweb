<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Nextrip extends CI_Controller {

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
		$this->load->view('hotels/nextrip/index', $data); 
	}

	public function approve(){
		$trackNo = $this->input->get('trackNo');
		$ip      = $this->input->get('ip');

		$url1 = 'https://upsmobileapi.azurewebsites.net/Nextrip/approveCallback';

		$parameter1 = array(
			'trackNo' => $trackNo,
			'ip'      => $ip,
		); 
		
		$result = $this->curl->call($parameter1, $url1);
		$data['response1'] = json_decode($result, true);

		if($data['response1']['S'] == 1){
			$url2 = 'https://upsmobileapi.azurewebsites.net/Nextrip/fetchTracknoDetails';

			$parameter2 = array(
				'trackNo' => $trackNo,
			); 

			$result = $this->curl->call($parameter2, $url2);
			$data['response2'] = json_decode($result, true);

			if($data['response2']['S'] == 1){
				$tmp_data = $data['response2']['M'];
				$data["trackno"] = $tmp_data['transaction_no'];
				$data["regcode"] = $tmp_data['client_regcode'];
				$data["email"]   = $tmp_data['client_email'];
				$data["amount"]  = $tmp_data['price'];
				$data['status']  = $tmp_data['status'];
                    
                // TESTING DATA
				// $data["trackno"] = 'NEXTRIP1234567890';
				// $data["regcode"] = '1234567890';
				// $data["email"]   = 'test.email@email.com.ph';
				// $data["amount"]  = '20000.00';
				// $data['status']  = 'SUCCESS';
			}

			$this->load->view('hotels/nextrip/index', $data); 
		}else{
			$this->load->view('hotels/nextrip/index', $data); 
		}
	}

	public function deny(){
		$trackNo = $this->input->get('trackNo');
		$ip      = $this->input->get('ip');

		$url1 = 'https://upsmobileapi.azurewebsites.net/Nextrip/denyCallback';

		$parameter1 =array(
			'trackNo' => $trackNo,
			'ip'      => $ip,
		); 
		
		$result = $this->curl->call($parameter1, $url1);
		$data['response1'] = json_decode($result, true);

		if($data['response1']['S'] == 1){
			$url2 = 'https://upsmobileapi.azurewebsites.net/Nextrip/fetchTracknoDetails';

			$parameter2 = array(
				'trackNo' => $trackNo,
			); 

			$result = $this->curl->call($parameter2, $url2);
			$data['response2'] = json_decode($result, true);

			if($data['response2']['S'] == 1){
				$tmp_data = $data['response2']['M'];
				$data["trackno"] = $tmp_data['transaction_no'];
				$data["regcode"] = $tmp_data['client_regcode'];
				$data["email"]   = $tmp_data['client_email'];
				$data["amount"]  = $tmp_data['price'];
				$data['status']  = $tmp_data['status'];

                // TESTING DATA
				// $data["trackno"] = 'NEXTRIP1234567890';
				// $data["regcode"] = '1234567890';
				// $data["email"]   = 'test.email@email.com.ph';
				// $data["amount"]  = '20000.00';
				// $data['status']  = 'FAILED';
			}

			$this->load->view('hotels/nextrip/index', $data); 
		}else{
			$this->load->view('hotels/nextrip/index', $data); 
		}
	}


}

?>