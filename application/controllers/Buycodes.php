<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buycodes extends CI_Controller {

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
		$this->load->model('encryption_model');
	  	$this->load->model('Sp_model');

	   	if($this->user['USER_KYC'] != 'APPROVED') {
			redirect('Main');
		}
	}

	public function buycodes()
	{
		if ($this->user['A_CTRL']['online_shop'] == 1){
			$data = array('menu' => 15,
						  'parent' => '');

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['user'] = $this->user;	
				$testaccount = substr($data['user']['R'],0,2);
				if($testaccount == 'UF'){
					$data['retailer'] = 1;
				}

				$parameters = array(
					 'dev_id'     		=>$this->global_f->dev_id(),
					 'ip_address' 		=>$this->ip,
					 'actionId' 	 	=> _new_buycodes_get_transaction,
					 'regcode'          =>$this->user['R'],
					  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
				);

				$transact_result = $this->curl->call($parameters,url);
				$Tresult = json_decode($transact_result,true);

				if($Tresult['S'] == 1){
					$data['binfo_set'] = true;

					$data['transdata'] = $Tresult['T_DATA'];
				}else{
					$data['binfo_set'] = false;
				}

				if($this->input->post('package_select')){
					$urldata = json_decode(urldecode($this->input->post('package_select')));
					$data['package_value'] = $urldata[0];
					$data['location'] = 'Philippines';

					$Parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'regcode'    		=> $this->user['R'],
						$this->user['SKT'] 	=>  md5($this->user['R'].$this->user['SKT']),
						'actionId'  		=> _new_buycodes_fetch_packages_variants,
						'ip_address' 		=> $this->ip, 
						'variant' 			=> $data['package_value']->package_code
			    	);

					$result = $this->curl->call($Parameter,url);
					$API = json_decode($result,true);
					$data['items'] = $API;

					if($data['package_value']->id == 3){
						$type='7';
					}else if($data['package_value']->id == 4){
						$type='8';
					}else if($data['package_value']->id == 7){
						$type='9';
					}else{
						$type='0';
					}

					$binfo_parameter = array(
						'dev_id'     		=>$this->global_f->dev_id(),
						'ip_address' 		=>$this->ip,
						'ip' 				=>$this->ip,
						'actionId' 	 		=> _buycodes_gettransactions,
						'regcode'          	=>$this->user['R'],
						'packagetype'		=>$type,
						 $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
						   );

					$b_api_result = $this->curl->call($binfo_parameter,url);
					$B_API = json_decode($b_api_result,true);

					if($B_API['S'] == 1){
						$data['binfo_set_old'] = true;

						$data['transdata_old'] = $B_API['T_DATA'];
					}else{
						$data['binfo_set_old'] = false;
					}
					
					$this->load->view('onlineshopping/new_buycodesSelectPackageIndex',$data);

				}elseif($this->input->post('inputPackageCode') == null){

					$Parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'regcode'    		=> $this->user['R'],
						$this->user['SKT'] 	=>  md5($this->user['R'].$this->user['SKT']),
						'actionId'   		=> _new_buycodes_fetch_packages,
						'ip_address' 		=> $this->ip, 
						'country' 			=> 'PH' 
			    	);

			    	$result = $this->curl->call($Parameter,url);
				   	$API = json_decode($result,true);
				   	$data['items'] = $API;
				   	$this->load->view('onlineshopping/new_buycodesPageIndex',$data);
				}
			}else {
				$this->session->sess_destroy();
				redirect('Login/');
			}
		}else {
			redirect('Main/');
		}
	}

	public function Buycodes_validate(){
		$clientname = $this->input->post('clientname');
		$clientemail = $this->input->post('clientemail');
		$clientmob = $this->input->post('clientmobile');
		$upline = $this->input->post('clientupline');
		$quantity = $this->input->post('clientquantity');
		$discounts = $this->input->post('discounts');
		$payments = $this->input->post('clientpayment');
		$package = $this->input->post('clientpackage');
		$variant = $this->input->post('clientvariant');
		
		if($payments == 1){
			$payment = 'ECASH';
		}else{
			$payment = 'CREDITCARD';
		}

		$parameter =array(
			'dev_id'     			=> $this->global_f->dev_id(),
			$this->user['SKT']		=>  md5($this->user['R'].$this->user['SKT']),
			'actionId'   			=> _new_buycodes_validate_transaction,
			'regcode'    			=> $this->user['R'],
			'ip_address' 			=> $this->ip,
			'country' 				=> 'PH',
			'client_name' 			=> $clientname,
			'client_email' 			=> $clientemail,
			'client_mobile'			=> $clientmob,
			'payment_type'			=> $payment,
			'package_code'			=> $package,
			'variant'				=> $variant,
			'quantity'				=> $quantity,
			'upline'				=> $upline,
			'discount'				=> $discounts
		);
		$result = $this->curl->call($parameter,url);
		$result = json_decode($result,true);
		echo json_encode($result);
	}

	public function Buycodes_transaction(){
		$clientname = $this->input->post('cname');
		$clientemail = $this->input->post('cemail');
		$clientmob = $this->input->post('cmobole');
		$upline = $this->input->post('cupline');
		$quantity = $this->input->post('cquantity');
		$discounts = $this->input->post('cdiscounts');
		$payment = $this->input->post('cpayment');
		$package = $this->input->post('cpackage');
		$variant = $this->input->post('cvariant');
		$tpass = $this->input->post('iTpass');

		$parameter =array(
			'dev_id'     			=> $this->global_f->dev_id(),
			$this->user['SKT']		=>  md5($this->user['R'].$this->user['SKT']),
			'actionId'   			=> _new_buycodes_transaction,
			'regcode'    			=> $this->user['R'],
			'ip_address' 			=> $this->ip,
			'country' 				=> 'PH',
			'client_name' 			=> $clientname,
			'client_email' 			=> $clientemail,
			'client_mobile'			=> $clientmob,
			'payment_type'			=> $payment,
			'package_code'			=> $package,
			'variant'				=> $variant,
			'quantity'				=> $quantity,
			'upline'				=> $upline,
			'discount'				=> $discounts,
			'transpass'				=> $tpass
		);
		$result = $this->curl->call($parameter,url);
		$result = json_decode($result,true);
		echo json_encode($result);
	}

    public function Buycodes_listing(){
		if ($this->user['A_CTRL']['online_shop'] == 1){
			$data = array('menu' => 15,
						  'parent' => '');

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['user'] = $this->user;	
				$testaccount = substr($data['user']['R'],0,2);
				if($testaccount == 'UF'){
					$data['retailer'] = 1;
				}

				$parameters = array(
					 'dev_id'     		=>$this->global_f->dev_id(),
					 'ip_address' 		=>$this->ip,
					 'actionId' 	 	=> _new_buycodes_get_transaction,
					 'regcode'          =>$this->user['R'],
					  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
				);

				$transact_result = $this->curl->call($parameters,url);
				$Tresult = json_decode($transact_result,true);

				if($Tresult['S'] == 1){
					$data['binfo_set'] = true;

					$data['transdata'] = $Tresult['T_DATA'];
				}else{
					$data['binfo_set'] = false;
				}

				$this->load->view('onlineshop/buy_codes_listing_index',$data);
			}else {
				$this->session->sess_destroy();
				redirect('Login/');
			}
		}else {
			redirect('Main/');
		}
	}

	public function buycodes_regcode_listing_search(){
		$trackingnumber = $this->input->post('trackingnumber');
		$data['user'] = $this->user;

		$parameter =array(
			'dev_id'     			=> $this->global_f->dev_id(),
			$this->user['SKT']		=> md5($this->user['R'].$this->user['SKT']),
			'ip_address' 			=> $this->ip,
			'actionId'   			=> _new_buycodes_get_regcode_listing,
			'regcode'    			=> $this->user['R'],
			'trackno' 				=> $trackingnumber	
		);

		$result = $this->curl->call($parameter,url);
		$result = json_decode($result,true);
		
		if($result['S'] == 1){
			$data['infos'] = $result['M'];
			$this->load->view('onlineshop/buy_codes_listing_index', $data);	
		}else{
			$data['error'] = $result;
			$this->load->view('onlineshop/buy_codes_listing_index', $data);
		}
	}

	public function share_email(){
		$trackingnumber = $this->input->post('trackingnumber');
		$email = $this->input->post('email');
		$reg = $this->input->post('reg');

		$data['user'] = $this->user;

		$parameter =array(
			'dev_id'     			=> $this->global_f->dev_id(),
			$this->user['SKT']		=> md5($this->user['R'].$this->user['SKT']),
			'ip_address' 			=> $this->ip,
			'actionId'   			=> _new_shared_email,
			'regcode'    			=> $this->user['R'],
			'trackno' 				=> $trackingnumber,
			'email'					=> $email,
			'retailerRegcode'		=> $reg
		);

		$result = $this->curl->call($parameter,url);
		$result = json_decode($result,true);
		echo json_encode($result);
	}
} 