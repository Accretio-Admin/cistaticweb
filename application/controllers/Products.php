<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

   	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Curl_model','curl');
		$this->load->library('session');
		$this->user = $this->session->userdata('user');
		$this->load->dbutil();
	    // $this->ip = $this->input->ip_address();
	    if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)){
            $IP = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
			$IP = $IP[0];
	   }else{
			$IP = $_SERVER['REMOTE_ADDR'];
		
		}

        $this->ip = $IP;
	    $this->load->model('Query_model','q');
	  	$this->load->model('Global_function','global_f');
	  	$this->load->model('Report_model','r');
	  	$this->load->model('Sp_model');
//update by nhez 03/21/2017
	  	// $ACC_CONTROL = $this->Sp_model->userprivilege(); 
	   // 	$this->user['A_CTRL'] = $ACC_CONTROL['A_CTRL'];
	   // 	$this->session->set_userdata('user',$this->user);

	  	if ($this->user['RET'] == 1) {
	    	redirect('Main/');
	    }
	}


	public function index()
	{

		$data = array('menu' => 19,
					 'parent'=>'' );
		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;

			$parameter = array(
		    				 'dev_id'     		=>$this->global_f->dev_id(),
		    				 'ip_address' 		=>$this->ip,
		    				 'ip' 				=>$this->ip,
		    				 'actionId' 	 	=> _validate_mlm_user, 
		    				 'regcode'          =>$this->user['R'],
		    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
								);
			$result = $this->curl->call($parameter,url);
			// print_r($result);
		    $API = json_decode($result,true);
		    // print_r($API);
		    $data['result'] = $API;
			$MLM = $API['MLM_CTRL'];

				if($MLM['status'] == 1){

					$data['mlm_user'] = $MLM;
					$this->session->set_userdata('MLM_user',$MLM);
				}

			$this->load->view('layout/short_header',$data);
			$this->load->view('products/main_panel',$data);
			$this->load->view('layout/short_footer',$data);

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');

		}

	}
//neslie

	public function ups_tangible_products() {

		$data = array('menu' => 19,
					 'parent'=>'' );
		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;
			$data['mlm_user'] = $this->session->userdata('MLM_user');
			$data['imageLimit'] = 6;

			$parameter = array(
		    				 'dev_id'     		=>$this->global_f->dev_id(),
		    				 'ip_address' 		=>$this->ip,
		    				 'ip' 				=>$this->ip,
		    				 'actionId' 	 	=> _fetch_product_list, 
		    				 'regcode'          =>$this->user['R'],
		    				 'product_code'		=>'', //NULL OR '' - SEARCH PRODUCT NAME
		    				 'product_type'		=>2,
		    				 'product_category'	=>'',
		    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
								);
			$result = $this->curl->call($parameter,url);
		    $data['products'] = json_decode($result,true);

			// $parameter = array(
		 //    				 'dev_id'     		=>$this->global_f->dev_id(),
		 //    				 'ip_address' 		=>$this->ip,
		 //    				 'ip' 				=>$this->ip,
		 //    				 'actionId' 	 	=> _fetch_product_list, 
		 //    				 'regcode'          =>$this->user['R'],
		 //    				 'product_code'		=>'', //NULL OR '' - SEARCH PRODUCT NAME
		 //    				 'product_type'		=>1,
		 //    				 'product_category'	=>'',
		 //    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
			// 					);
			// $result = $this->curl->call($parameter,url);
		 //    $data['packages'] = json_decode($result,true);

			$this->load->view('layout/short_header',$data);
			$this->load->view('products/ups_tangible_products',$data);
			$this->load->view('layout/short_footer',$data);

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');

		}

	}

	public function hub_products() {

		$data = array('menu' => 19,
					 'parent'=>'' );
		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;
			$data['mlm_user'] = $this->session->userdata('MLM_user');
			$data['imageLimit'] = 6;

			$parameter = array(
		    				 'dev_id'     		=>$this->global_f->dev_id(),
		    				 'ip_address' 		=>$this->ip,
		    				 'ip' 				=>$this->ip,
		    				 'actionId' 	 	=> _hub_inventory_list, 
		    				 'regcode'          =>$this->user['R'],
		    				 'product_code'		=>'', //NULL OR '' - SEARCH PRODUCT NAME
		    				 'product_type'		=>'2',
		    				 'product_category'	=>'',
		    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
								);
			$result = $this->curl->call($parameter,url);
		    $data['products'] = json_decode($result,true);

			$parameter = array(
		    				 'dev_id'     		=>$this->global_f->dev_id(),
		    				 'ip_address' 		=>$this->ip,
		    				 'ip' 				=>$this->ip,
		    				 'actionId' 	 	=> _hub_inventory_list, 
		    				 'regcode'          =>$this->user['R'],
		    				 'product_code'		=>'', //NULL OR '' - SEARCH PRODUCT NAME
		    				 'product_type'		=>'1',
		    				 'product_category'	=>'',
		    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
								);
			$result = $this->curl->call($parameter,url);
		    $data['packages'] = json_decode($result,true);

			$this->load->view('layout/short_header',$data);
			$this->load->view('products/hub_tangible_products',$data);
			$this->load->view('layout/short_footer',$data);

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');

		}

	}
	

	function validate_tangible()
	{
		//$cart = 'COF|1,CHO|1';
		//$purchase_regcode = '1246812';
		$cart = $this->input->post('getall');
		$purchase_regcode = $this->input->post('regcode');

		if($cart)
		{

			$parameter = array(
		    				 'dev_id'     		=>$this->global_f->dev_id(),
		    				 'ip_address' 		=>$this->ip,
		    				 'ip' 				=>$this->ip,
		    				 'actionId' 	 	=> _regcode_validate, 
		    				 'regcode'          =>$this->user['R'],
		    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
								);
			$result = $this->curl->call($parameter,url);
			// print_r($result); exit();
		    $API = json_decode($result,true);


		    if($API['S'] == 1){

		    	if($API['A'] == 1){

		    		if($purchase_regcode){

						$parameter = array(
					    				 'dev_id'     		=>$this->global_f->dev_id(),
					    				 'ip_address' 		=>$this->ip,
					    				 'ip' 				=>$this->ip,
					    				 'actionId' 	 	=> _cart_inventory_validate, 
					    				 'regcode'          =>$this->user['R'],
					    				 'cart'          	=>$cart,
					    				 'purchase_regcode' =>$purchase_regcode,
					    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
											);
						// print_r($result);
						$result = $this->curl->call($parameter,url);
						// print_r($result); die();
					    $validate_cart = json_decode($result,true);

						if($validate_cart['DATA']['sc'] == 1) {

							$message = array(
									'S'=>$validate_cart['DATA']['sc'],
									'RC'=>$purchase_regcode,
									'TP' => $validate_cart['DATA']['total_price'],
									'PN' => $validate_cart['DATA']['purchaser_name'],
									'cart' => $validate_cart['CART'],
									'UT' => 1,
									'TI' =>$validate_cart['DATA']['totalitems'],
									'CA' =>$validate_cart['DATA']['category'],
									'DC' =>$validate_cart['DATA']['discount']
									);

						}else{

							$message = array('S' => 0, 'M' => $validate_cart['DATA']['error_message']);

						}

		    		}else{
						$message = array('S' => 0, 'M' => 'Enter purchaser Regcode');
					}


		    	} else{

						$parameter = array(
					    				 'dev_id'     		=>$this->global_f->dev_id(),
					    				 'ip_address' 		=>$this->ip,
					    				 'ip' 				=>$this->ip,
					    				 'actionId' 	 	=> _cart_validate, 
					    				 'regcode'          =>$this->user['R'],
					    				 'cart'          	=>$cart,
					    				 'purchase_regcode' =>$purchase_regcode,
					    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
											);
						// print_r($result);
						$result = $this->curl->call($parameter,url);
						// print_r($result); die();
					    $validate_cart = json_decode($result,true);

						if($validate_cart['DATA']['sc'] == 1) {

						    $message = array(
							    	'S'	   =>$validate_cart['DATA']['sc'],
							    	'RC'   =>$purchase_regcode,
							    	'TP'   => $validate_cart['DATA']['totalprice'],
							    	'PN'   => $validate_cart['DATA']['purchaser_name'],
							    	'TPV'  => $validate_cart['DATA']['totalpv'],
							    	'TD'   => $validate_cart['DATA']['totaldiscount'],
							    	'AD'   => $validate_cart['DATA']['amountdue'],
							    	'cart' => $validate_cart['CART'],
							    	'UT' => 7,
							    	'TI' =>$validate_cart['DATA']['totalitems']
						    	);

						}elseif($validate_cart['S'] == 0){

							$message = array('S' => 0, 'M' => $validate_cart['M']);

						}else{

							$message = array('S' => 0, 'M' => $validate_cart['DATA']['error_message']);
						}	
		    	}

		    }else{

				redirect('/Products');      
			}

		}else{
			$message = array('S' => 0, 'M' => 'Cart is empty');
		}

		echo json_encode($message);
		
	}


	function confirm_tangible()
	{
		// $cart = 'COF|1,CHO|1';
		// $purchase_regcode = '1234567';
		$cart = $this->input->post('cart');
		$purchase_regcode = $this->input->post('regcode');
		$payment_type = $this->input->post('payment_type');

		if($cart)
		{

			$parameter = array(
		    				 'dev_id'     		=>$this->global_f->dev_id(),
		    				 'ip_address' 		=>$this->ip,
		    				 'ip' 				=>$this->ip,
		    				 'actionId' 	 	=> _regcode_validate, 
		    				 'regcode'          =>$this->user['R'],
		    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
								);
			// print_r($parameter);
			$result = $this->curl->call($parameter,url);
			// print_r($result); //die();
		    $API = json_decode($result,true);

		    if($API['S'] == 1){

		    	if($API['A'] == 1){

		    		if($purchase_regcode){

		    			$actionid = _cart_inventory_confirm;

		    		}else{

		    			$message = array('S' => 0, 'M' => 'Enter purchaser Regcode');
		    		}	

		    	} else{

						$actionid = _cart_confirm;
		    	}

						$parameter = array(
					    				 'dev_id'     		=>$this->global_f->dev_id(),
					    				 'ip_address' 		=>$this->ip,
					    				 'ip' 				=>$this->ip,
					    				 'actionId' 	 	=>$actionid, 
					    				 'regcode'          =>$this->user['R'],
					    				 'cart'          	=>$cart,
					    				 'purchase_regcode' =>$purchase_regcode,
					    				 'payment_type' 	=>$payment_type,
					    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
											);
						// print_r($parameter);
		    			$result = $this->curl->call($parameter,url);
		    			// print_r($result); die();
					    $cart_confirm = json_decode($result,true);
		    
						if($cart_confirm['DATA']['sc'] == 1){

							if($API['A'] == 1){$msg = 'Successfully Distributed';} else{ $msg = $cart_confirm['DATA']['error_message']; }

							$message = array(
								'S' => $cart_confirm['DATA']['sc'], 
								'M' => $msg, 
								'TN' => $cart_confirm['DATA']['trackno'],
								'PN' =>$cart_confirm['DATA']['purchaser_name'],
								'PM' =>$cart_confirm['DATA']['payment_type'],
								'receiptURL' =>'https://mobilereports.globalpinoyremittance.com/portal/product_purchased_receipt/'.$API['A'].'/'.$cart_confirm['DATA']['trackno']
								);

						}else{
						
							$message = array('S' => 0, 'M' => $cart_confirm['DATA']['error_message']);
						}

		    }else{

				redirect('/Products');      
			}

		}else{
			$message = array('S' => 0, 'M' => 'Cart is empty');
		}

		echo json_encode($message);

	}


//Added by Sonmer
	public function mlm_ups_reports()
	{

		$data = array('menu' => 19,
					 'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;

			if (isset($_POST['btnSearch'])){
				$INPUT_POST = $this->input->post(null,true);
				
				$data['user'] = $this->user;

				$parameter =array(
							'dev_id'     		=> $this->global_f->dev_id(),
							'actionId'          => _mlm_ups_report, 
							'ip_address'		=> $this->ip, 
		    				'regcode'           => $this->user['R'],
		    				'startdate'			=> $INPUT_POST['inputStart'],
		    				'enddate'			=> $INPUT_POST['inputEnd']
					    	); 
				// print_r($parameter);exit();
			    $result = $this->curl->call($parameter,url);
			    // print_r($result);exit();
			   	$API = json_decode($result,true);

			   	// print_r($API);exit();
			   	if ($API['S'] == 1) {
		   			$data['process'] = array('P'=>1,
											 'S'=>1);
			   	}
			   		$data['API'] = $API;
			   		$date = array('startdate'=>$INPUT_POST['inputStart'],
			   					   'enddate'=>$INPUT_POST['inputEnd']);
			   		$this->session->set_userdata('inputdate',$date);

			} else {

				$parameter =array(
					'dev_id'     		=> $this->global_f->dev_id(),
					'actionId'         	=> _mlm_ups_last10_report, 
					'ip_address'		=> $this->ip, 
    				'regcode'           => $this->user['R']
			    	); 
				// print_r($parameter);exit();
			    $result = $this->curl->call($parameter,url);
			   	$API = json_decode($result,true);
			   
				if ($API['S'] === 0) {
						$data['process'] = array ('P'=>1,
											  'S'=>0,
											  'M'=>$API['M']);	
				}else {
						$data['process'] = array ('P'=>1,
											  'S'=>1,
											  'M'=>$API['M']);
				}
				$data['API'] = $API;

			}

			$this->load->view('layout/short_header',$data);
			$this->load->view('products/mlm_ups_reports',$data);
			$this->load->view('layout/short_footer',$data);

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}

	public function mlm_hub_reports()
	{
		$data = array('menu' => 19,
					 'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;

			if (isset($_POST['btnSearch'])){
				$INPUT_POST = $this->input->post(null,true);
				
				$data['user'] = $this->user;

				$parameter =array(
							'dev_id'     		=> $this->global_f->dev_id(),
							'actionId'          => _mlm_hub_report, 
							'ip_address'		=> $this->ip, 
		    				'regcode'           => $this->user['R'],
		    				'startdate'			=> $INPUT_POST['inputStart'],
		    				'enddate'			=> $INPUT_POST['inputEnd']
					    	); 
				// print_r($parameter);exit();
			    $result = $this->curl->call($parameter,url);
			    // print_r($result);exit();
			   	$API = json_decode($result,true);

			   	// print_r($API);exit();
			   	if ($API['S'] == 1) {
		   			$data['process'] = array('P'=>1,
											 'S'=>1);
			   	}
			   		$data['API'] = $API;
			   		$date = array('startdate'=>$INPUT_POST['inputStart'],
			   					   'enddate'=>$INPUT_POST['inputEnd']);
			   		$this->session->set_userdata('inputdate',$date);

			} else {

				$parameter =array(
					'dev_id'     		=> $this->global_f->dev_id(),
					'actionId'         	=> _mlm_hub_last10_report, 
					'ip_address'		=> $this->ip, 
    				'regcode'           => $this->user['R']
			    	); 

			    $result = $this->curl->call($parameter,url);
			    // print_r($result);exit();
			   	$API = json_decode($result,true);
			   	// print_r($API);exit();
			   	
				if ($API['S'] === 0) {
						$data['process'] = array ('P'=>1,
											  'S'=>0,
											  'M'=>$API['M']);	
				}else {
						$data['process'] = array ('P'=>1,
											  'S'=>1,
											  'M'=>$API['M']);
				}
				$data['API'] = $API;

			}

			

			$this->load->view('layout/short_header',$data);
			$this->load->view('products/mlm_hub_reports',$data);
			$this->load->view('layout/short_footer',$data);

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}

	}

	function export($get){

		if ($get == md5('mlm_ups_reports')) {

			$this->r->export_mlm_ups_report();

		}elseif($get == md5('mlm_hub_reports')){

			$this->r->export_mlm_hub_report();

		}else {

			echo "The Requested URL ". BASE_URL() ."export/". $get ."<br />"."was not found on this server";
			

		}
	}
//Added by Sonmer


	public function inventory_report()
	{

		$data = array('menu' => 19,
					 'parent'=>'' );
		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;
			$data['mlm_user'] = $this->session->userdata('MLM_user');
		
			$INPUT_POST = $this->input->post();		
	

			if($INPUT_POST['inputStart'] == ''){$start_date = '';} else {$start_date = $INPUT_POST['inputStart'];}	
			if($INPUT_POST['inputEnd'] == ''){$end_date = '';} else {$end_date = $INPUT_POST['inputEnd'];}
			if($INPUT_POST['prodcode'] == ''){$prodcode = '';} else {$prodcode = $INPUT_POST['prodcode'];}	

			if (isset($_POST['btnSearchReport'])) {
						$parameter = array(
						    				'dev_id'     		=>$this->global_f->dev_id(),
						    				'ip_address' 		=>$this->ip,
						    				'actionId' 	 		=>'ups_mlm_test/hub_inventory_report', 
						    				'regcode'          	=>$this->user['R'],
						    				'start_date'		=>$start_date,
						    				'end_date'			=>$end_date,
						    				'prodcode'			=>$prodcode,
						    				$this->user['SKT'] 	=>  md5($this->user['R'].$this->user['SKT'])
										);		

						$result = $this->curl->call($parameter,url);		
						// print_r($result); //die();												
					    $results = json_decode($result,true);
					    $data['mlm_inventory_report']  = $results;
					    // print_r($data['mlm_inventory_report']);
						$this->session->set_userdata('report_details',array(
													'access_type' => $data['mlm_user']['user_type'],
													'start_date' => $start_date,
													'end_date' => $end_date,
													'prodcode' =>$prodcode,
													));
			} else {

						$parameter = array(
			    				'dev_id'     		=>$this->global_f->dev_id(),
			    				'ip_address' 		=>$this->ip,
			    				'actionId' 	 		=>'ups_mlm_test/hub_inventory_report', 
			    				'regcode'          	=>$this->user['R'],
			    				'start_date'		=>date('Y-m-d'),
			    				'end_date'			=>date('Y-m-d'),
			    				'prodcode'			=>'',
			    				$this->user['SKT'] 	=>  md5($this->user['R'].$this->user['SKT'])
							);		

						$result = $this->curl->call($parameter,url);		
						// print_r($result); //die();												
					    $results = json_decode($result,true);
					    $data['mlm_inventory_report']  = $results;

					    $this->session->set_userdata('report_details',array(
													'access_type' => $data['mlm_user']['user_type'],
													'start_date' => date('Y-m-d'),
													'end_date' => date('Y-m-d'),
													'prodcode' =>'',
													));
			}

			$parameter = array(
				 'dev_id'     		=>$this->global_f->dev_id(),
				 'ip_address' 		=>$this->ip,
				 'actionId' 	 	=> _fetch_product_list, 
				 'regcode'          =>$this->user['R'],
				 'product_code'		=>'', //NULL OR '' - SEARCH PRODUCT NAME
				 'product_type'		=>'',
				 'product_category'	=>'',
				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
					);
			$result = $this->curl->call($parameter,url);
		    $data['products'] = json_decode($result,true);
		    // print_r($data['products']);

			$this->load->view('layout/short_header',$data);
			$this->load->view('products/inventory_report',$data);
			$this->load->view('layout/short_footer',$data);
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');

		}

	}

	public function csv_inventory_report()
	{

		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;
			$data['mlm_user'] = $this->session->userdata('MLM_user');

			$report_parameters = $this->session->userdata('report_details');
			// print_r($report_parameters['start_date']);exit();
					$parameter = array(
					    				'dev_id'     		=>$this->global_f->dev_id(),
					    				'ip_address' 		=>$this->ip,
					    				'actionId' 	 		=>'ups_mlm_test/hub_inventory_report', 
					    				'regcode'          	=>$this->user['R'],
					    				'start_date'		=>$report_parameters['start_date'],
					    				'end_date'			=>$report_parameters['end_date'],
					    				'prodcode'			=>$report_parameters['prodcode'],
					    				$this->user['SKT'] 	=>  md5($this->user['R'].$this->user['SKT'])
									);														
					$result = $this->curl->call($parameter,url);														
		    		$results = json_decode($result,true);

			$column = array('Regcode', 'Product Code', 'Transtype', 'Inventory Added', 'Inventory Before', 'Inventory After','DateTime','Trackno');
			
			$date = date('Y-m-d');
			header('Content-type: text/csv');
			header('Content-Disposition: attachment; filename="Inventory Report-'.$date.'.csv"');
			 
			// do not cache the file
			header('Pragma: no-cache');
			header('Expires: 0');
			 
			// create a file pointer connected to the output stream
			$file = fopen('php://output', 'w');
			 
			// send the column headers
			fputcsv($file, $column);
			 
			// output each row of the data
			foreach ($results as $row)
			{
				$row_details = array($row['reference_regcode'], $row['product_code'], $row['transtype'], $row['inventory_amount'],$row['inventory_before'],$row['inventory_after'],$row['datetime'], "'".$row['trackno'] ); 

			    fputcsv($file, $row_details);
			}

			exit();

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');

		}  

	}



}