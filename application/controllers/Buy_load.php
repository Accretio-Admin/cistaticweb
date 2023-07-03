<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buy_load extends CI_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->model('Global_function','global_f');
		$this->load->model('Curl_model','curl');
		$this->load->library('session');
		$this->user = $this->session->userdata('user');
	    $IP = $_SERVER['REMOTE_ADDR'];

        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) 
		{
            $IP = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
        }

        $this->ip = $IP;
	  	$this->load->model('Query_model');
	  	$this->load->model('Sp_model');
	  	
	  	if ($this->user['RET'] == 1) 
		{
	    	redirect('Main/');
		}

		if($this->user['USER_KYC'] != 'APPROVED') 
		{
			redirect('Main');
  		}
	}

	public function index()
	{
		//For UAT
		// $filter = array(
		// 	'1234567', 
		// 	'F8152116', 
		// 	'F8426085', 
		// 	'F8489167', 
		// 	'F8972330', 
		// 	'F9037865', 
		// 	'F9562078', 
		// 	'F9592952', 
		// 	'F9687521', 
		// 	'F1526245', 
		// 	'F1359252', 
		// 	'F8901916'
		// );

        $data = array('menu' => 'buy_load', 'parent' => 'LOADING', 'filter' => $filter);
		
        if ($this->user['S'] == 1 && $this->user['R'] != "")
        {
            $data['user'] = $this->user;
            $testaccount = substr($data['user']['R'], 0, 2);

            if ($testaccount == 'UF')
            {
                $data['retailer'] = 1;

            }
            $this->load->view('loading/buy_load/index', $data);
        }
        else 
        {
            $this->session->sess_destroy();
            redirect('Login/');
        }
	}

    public function anypay() 
	{
		$data = array('menu' => 'buy_load', 'parent' => 'LOADING', 'type' => 'MYR');

		if ($this->user['S'] == 1 && $this->user['R'] != "")
		{	
			$data['user'] = $this->user;

			//Country & Codes
			$params = array(
				'dev_id' => $this->global_f->dev_id(),
				'actionId' => _fetch_countries_iso,
				'regcode' => $this->user['R'],
				'ip_address' =>$this->ip
			);

			$response = json_decode($this->curl->call($params, url), true);
			$data['countries'] = $response['T_DATA'];

			// print_r(array('SKT' => $this->user['SKT'], 'VALUE' => md5($this->user['R'] . $this->user['SKT'] . md5('af3703cfa8'))));
			// exit();

			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('loading/buy_load/anypay'); 
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');	
		}
		else 
		{
			$this->session->sess_destroy();
			redirect('Login/');
		}	
	}

	public function fetch_anypay_plan_codes()
	{
		$params = array(
			'dev_id' => $this->global_f->dev_id(),
			'actionId' => 'ups_buyload_api/anypay_fetch_products',
			'regcode' => $this->user['R'],
			'category' => $this->input->post('category'),
			'ip_address' => $this->ip
		);

		$response = json_decode($this->curl->call($params, url), true);
		echo json_encode($response);
	}

	public function transac_anypay()
	{
		$params = array(
			'dev_id' => $this->global_f->dev_id(),
			'actionId' => 'ups_buyload_api/anypay_send',
			'regcode' => $this->user['R'],
			'type' => 'ANYPAY',
			'category' => $this->input->post('category'),
			'operator' => $this->input->post('operator'),
			'plancode' => $this->input->post('plancode'),
			'skucode' => $this->input->post('skucode'),
			'wallet_currency' => $this->input->post('wallet_currency'),
			'load_amount' => $this->input->post('load_amount'),
			'converted_amount' => $this->input->post('converted_amount'),
			'discounted_amount' => $this->input->post('discounted_amount'),
			'debited_amount' => $this->input->post('debited_amount'),
			'mobile_no' => $this->input->post('mobile_number'),
			'ip_address' => $this->ip,
			'transpass' => $this->input->post('transpass'),
			$this->user['SKT'] => md5($this->user['R'] . $this->user['SKT'] . md5($this->input->post('transpass')))
		);
		

		$response = json_decode($this->curl->call($params, url), true);

		echo json_encode($response);
	}

	public function ding() 
	{
		$data = array('menu' => 'buy_load', 'parent' => 'LOADING', 'type' => 'INTERNATIONAL LOADING');

		if ($this->user['S'] == 1 && $this->user['R'] != "")
		{	
			$data['user'] = $this->user;

			$this->load->view('layout/header', $data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('loading/buy_load/dingconnect'); 
			// $this->load->view('loading/buy_load/ding'); 
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');	
		}
		else 
		{
			$this->session->sess_destroy();
			redirect('Login/');
		}	
	}

	public function fetch_ding_countries() 
	{
		$params = array(
			'dev_id' => $this->global_f->dev_id(),
			'actionId' => 'ups_buyload_api/ding_get_countries',
			'regcode' => $this->user['R'],
			'ip_address' => $this->ip
		);

		$response = json_decode($this->curl->call($params, url), true);
		echo json_encode($response);
		
	}

	public function fetch_ding_plan_codes() 
	{
		$topup = [];
		$data = [];
		$bundle = [];

		$params = array(
			'dev_id' => $this->global_f->dev_id(),
			'actionId' => 'ups_buyload_api/ding_get_plan_codes',
			'regcode' => $this->user['R'],
			'provider_code' => $this->input->post('provider_code'),
			'ip_address' => $this->ip
		);

		$response = json_decode($this->curl->call($params, url), true);
		$products = $response;

		foreach($products['D']['Items'] as $row)
		{
			if(array('Mobile','Minutes') === $row['Benefits'])
				array_push($topup, $row);
			if(array('Mobile','Data') === $row['Benefits'])
				array_push($data, $row);
			if(array('Mobile','Minutes','Data') === $row['Benefits'])
				array_push($bundle, $row);
		}

		$newproducts['Items'] = array(
			'Topup' => $topup,
			'Data' => $data,
			'Bundle' => $bundle
		);
		

		$html_response = $this->load->view('loading/buy_load/dingproduct', $newproducts['Items']);
		echo json_encode($html_response);
	}

	public function fetch_ding_providers() 
	{
		$params = array(
			'dev_id' => $this->global_f->dev_id(),
			'actionId' => 'ups_buyload_api/ding_get_providers',
			'regcode' => $this->user['R'],
			'countryiso' => $this->input->post('countryiso'),
			'ip_address' => $this->ip
		);

		$response = json_decode($this->curl->call($params, url), true);
		$providers = $response;

		$params2 = array(
			'dev_id' => $this->global_f->dev_id(),
			'actionId' => 'ups_buyload_api/ding_get_accountlookup',
			'regcode' => $this->user['R'],
			'account_number' => $this->input->post('phone_number'),  
			'ip_address' => $this->ip
		);

		$response2 = json_decode($this->curl->call($params2, url), true);
		$providers['D']['Lookup'] = $response2['D']['Items'];


		$html_response = $this->load->view('loading/buy_load/dingprovider', $providers['D']);

		echo json_encode($html_response);
	}

	public function fetch_ding_accountlookup() 
	{
		$params = array(
			'dev_id' => $this->global_f->dev_id(),
			'actionId' => 'ups_buyload_api/ding_get_accountlookup',
			'regcode' => $this->user['R'],
			'account_number' => $this->input->post('phone_number'),  
			'ip_address' => $this->ip
		);

		$response = json_decode($this->curl->call($params, url), true);

		echo json_encode($response['D']);
	}

	public function transac_ding()
	{
		$params = array(
			'dev_id' => $this->global_f->dev_id(),
			'actionId' => 'ups_buyload_api/ding_send',
			'regcode' => $this->user['R'],
			'type' => 'DING',
			'category' => $this->input->post('category'),
			'operator' => $this->input->post('operator'),
			'plancode' => $this->input->post('plancode'),
			'skucode' => $this->input->post('skucode'),
			'wallet_currency' => $this->input->post('wallet_currency'),
			'load_amount' => $this->input->post('load_amount'),
			'converted_amount' => $this->input->post('converted_amount'),
			'discounted_amount' => $this->input->post('discounted_amount'),
			'debited_amount' => $this->input->post('debited_amount'),
			'mobile_no' => $this->input->post('mobile_number'),
			'ip_address' => $this->ip,
			'transpass' => $this->input->post('transpass'),
			$this->user['SKT'] => md5($this->user['R'] . $this->user['SKT'] . md5($this->input->post('transpass')))
		);
		

		$response = json_decode($this->curl->call($params, url), true);

		echo json_encode($response);
	}

    public function npn() 
	{
		$data = array('menu' => 'buy_load', 'parent' => 'LOADING', 'type' => 'SGD');

		if ($this->user['S'] == 1 && $this->user['R'] != "")
		{	
			$data['user'] = $this->user;

			//Country & Codes
			$params = array(
				'dev_id' => $this->global_f->dev_id(),
				'actionId' => _fetch_countries_iso,
				'regcode' => $this->user['R'],
				'ip_address' =>$this->ip
			);

			$response = json_decode($this->curl->call($params, url), true);
			$data['countries'] = $response['T_DATA'];

			//Static Data for Product Code & Amount
			$data['plan_codes'] = array(
				array(
					'operator' => 'Operator 1',
					'product_code' => 'CODE123',
					'amount' => '100'
				),
		   
				array(
					'operator' => 'Operator 2',
					'product_code' => 'CODE212',
					'amount' => '100'
				),
		   );

			$this->load->view('layout/header', $data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			// $this->load->view('loading/buy_load/npn');
			$this->load->view('loading/buy_load/npnloading');
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');	
		}
		else 
		{
			$this->session->sess_destroy();
			redirect('Login/');
		}	
	}

	public function fetch_npn_plan_codes()
	{
		$params = array(
			'dev_id' => $this->global_f->dev_id(),
			'actionId' => 'ups_buyload_api/npn_fetch_products',
			'regcode' => $this->user['R'],
			'category' => $this->input->post('category'),
			'ip_address' => $this->ip
		);

		$response = json_decode($this->curl->call($params, url), true);
		echo json_encode($response);
	}


	public function npn_callback()
	{
		$params = array(
			'dev_id' => $this->global_f->dev_id(),
			'actionId' => 'ups_buyload_api/npn_callback_result',
			'regcode' => $this->user['R'],
			'ip_address' => $this->ip
		);
	}

	public function fetch_npn_products()
	{
		$params = array(
			'dev_id' => $this->global_f->dev_id(),
			'actionId' => 'ups_buyload_api/npn_fetch_product',
			'regcode' => $this->user['R'],
			'searchTerm' => $this->input->post('searchTerm'),
			'ip_address' => $this->ip
		);
		
		$response = json_decode($this->curl->call($params, url), true);

		echo json_encode($response);
	}

	public function fetch_npn_data()
	{
		$params = array(
			'dev_id' => $this->global_f->dev_id(),
			'actionId' => 'ups_buyload_api/npn_fetch_data',
			'regcode' => $this->user['R'],
			'selVal' => $this->input->post('selVal'),
			'ip_address' => $this->ip
		);

		$response = json_decode($this->curl->call($params, url), true);

		echo json_encode($response);
	}

	public function transac_npn()
	{
		$params = array(
			'dev_id' => $this->global_f->dev_id(),
			'actionId' => 'ups_buyload_api/npn_send',
			'regcode' => $this->user['R'],
			'productCategory' => $this->input->post('productCategory'),
			'operator' => $this->input->post('operator'),
			'plancode' => $this->input->post('plancode'),
			'action_id' => $this->input->post('action_id'),
			'cost' => $this->input->post('cost'),
			'debited_amount' => $this->input->post('amount'),
			'mobile_no' => $this->input->post('phoneNumber'),
			'menu_id' => $this->input->post('productCode'),
			'ip_address' => $this->ip,
			'transpass' => $this->input->post('transpass'),
			$this->user['SKT'] => md5($this->user['R'] . $this->user['SKT'] . md5($this->input->post('transpass')))
		);
		

		$response = json_decode($this->curl->call($params, url), true);
		echo json_encode($response);
	}
}