<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mlm extends CI_Controller {

   	public function __construct()
	{
		parent::__construct();
		//test
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
				
		$data = array('menu' => 18,
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
		    $API = json_decode($result,true);
		    $data['result'] = $API;
			$MLM = $API['MLM_CTRL'];

				if($MLM['user_type'] != 0){

					$data['mlm_user'] = $MLM;
					$this->session->set_userdata('MLM_user',$MLM);
				}

			$this->load->view('layout/short_header',$data);
			$this->load->view('mlm/main_panel',$data);
			$this->load->view('layout/short_footer',$data);

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');

		}
	}
//nes

	public function products()
	{
				
		$data = array('menu' => 18,
					 'parent'=>'' );
		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;
			$data['mlm_user'] = $this->session->userdata('MLM_user');

			$INPUT_POST = $this->input->post();

			if (isset($_POST['btn_add_prod'])) {

				$url = url;
				$parameter = array(
			    				 'dev_id'     		=>$this->global_f->dev_id(),
			    				 'ip_address' 		=>$this->ip,
			    				 'ip' 				=>$this->ip,
			    				 'actionId' 	 	=> _add_product, 
			    				 'regcode'          =>$this->user['R'],
			    				 'product_code'		=>trim($INPUT_POST['prod_code']),
			    				 'product_name'		=>trim($INPUT_POST['prod_name']),
			    				 'product_desc'		=>trim($INPUT_POST['prod_desc']),
			    				 'price'			=>$INPUT_POST['prod_price'],
			    				 'dealer_price'		=>$INPUT_POST['prod_dealerprice'],
			    				 'ecc_price'		=>$INPUT_POST['prod_eccprice'],
			    				 'hub_price'		=>$INPUT_POST['prod_hubprice'],
			    				 'd_price'			=>'',
			    				 'pv'				=>$INPUT_POST['prod_pv'],
			    				 // 'inventory'		=>$INPUT_POST['prod_stock'],
			    				 'type'				=>$INPUT_POST['prod_type'],
			    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
									);
				// print_r($parameter);
				$result = $this->curl->call($parameter,$url);
			    $API = json_decode($result,true);

				if($API['S'] == 1){
					$data['result'] = array(
										'S' => 1,
										'M' => 'Successfully Added'
									);
				}else{
					$data['result'] = array(
										'S' => 2,
										'M' => $API['M']
									);
				}

			}

			if (isset($_POST['btn_edit_prod'])) {

				$parameter = array(
			    				 'dev_id'     		=>$this->global_f->dev_id(),
			    				 'ip_address' 		=>$this->ip,
			    				 'ip' 				=>$this->ip,
			    				 'actionId' 	 	=> _edit_product, 
			    				 'regcode'          =>$this->user['R'],
			    				 'product_id'		=>$INPUT_POST['btn_edit_prod'],
			    				 'product_code'		=>trim($INPUT_POST['prod_code']),
			    				 'product_name'		=>trim($INPUT_POST['prod_name']),
			    				 'product_desc'		=>trim($INPUT_POST['prod_desc']),
			    				 'price'			=>$INPUT_POST['prod_price'],
			    				 'dealer_price'			=>$INPUT_POST['prod_dealerprice'],
			    				 'ecc_price'			=>$INPUT_POST['prod_eccprice'],
			    				 'hub_price'			=>$INPUT_POST['prod_hubprice'],
			    				 'd_price'			=>'',
			    				 'pv'				=>$INPUT_POST['prod_pv'],
			    				 // 'inventory'		=>$INPUT_POST['prod_stock'],
			    				 'type'				=>$INPUT_POST['prod_type'],
			    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
									);
				//print_r($parameter);
				$result = $this->curl->call($parameter,url);
				//print_r($result);
			    $API = json_decode($result,true);

				if($API['S'] == 1){
					$data['result'] = array(
										'S' => 1,
										'M' => 'Successfully Updated'
									);
				}else{
					$data['result'] = array(
										'S' => 2,
										'M' => $API['M']
									);
				}

			}

			if($INPUT_POST['product_code'] != ''){$product_code = $INPUT_POST['product_code'];} else{$product_code = NULL;}

			$parameter = array(
		    				 'dev_id'     		=>$this->global_f->dev_id(),
		    				 'ip_address' 		=>$this->ip,
		    				 'ip' 				=>$this->ip,
		    				 'actionId' 	 	=> _fetch_product_list, 
		    				 'regcode'          =>$this->user['R'],
		    				 'product_code'		=>$product_code, //NULL OR '' - SEARCH PRODUCT NAME
							 'product_type'		=>'',
							 'product_category'	=>'',
		    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
								);
			$result = $this->curl->call($parameter,url);
		    $data['products'] = json_decode($result,true);
		    
			$this->load->view('layout/short_header',$data);
			$this->load->view('mlm/products',$data);
			$this->load->view('layout/short_footer',$data);

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');

		}
	}


	public function addProd_inventory()
	{
				
		$data = array('menu' => 18,
					 'parent'=>'' );
		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;
			$data['mlm_user'] = $this->session->userdata('MLM_user');

			$INPUT_POST = $this->input->post();

			if (isset($_POST['btn_add_inv'])) {

				$url = url;
				$parameter = array(
			    				 'dev_id'     			=>$this->global_f->dev_id(),
			    				 'ip_address' 			=>$this->ip,
			    				 'actionId' 	 		=>'ups_mlm_test/add_product_inventory', 
			    				 'regcode'          	=>$this->user['R'],
			    				 'product_code'			=>$INPUT_POST['prod_code'],
			    				 'add_inv'				=>$INPUT_POST['prod_addToINV'],
			    				 'exp_date'				=>$INPUT_POST['prod_expdate'],
			    				  $this->user['SKT'] 	=>  md5($this->user['R'].$this->user['SKT'])
									);
				// print_r($parameter);
				$result = $this->curl->call($parameter,$url);
			    $API = json_decode($result,true);

				if($API['S'] == 1){
					$data['result'] = array(
										'S' => 1,
										'M' => 'Successfully Added'
									);
				}else{
					$data['result'] = array(
										'S' => 2,
										'M' => $API['M']
									);
				}

			}

			if($INPUT_POST['product_code'] != ''){$product_code = $INPUT_POST['product_code'];} else{$product_code = NULL;}

			$parameter = array(
		    				 'dev_id'     		=>$this->global_f->dev_id(),
		    				 'ip_address' 		=>$this->ip,
		    				 'actionId' 	 	=>'ups_mlm_test/fetch_inventory_product_list', 
		    				 'regcode'          =>$this->user['R'],
		    				 'product_code'		=>$product_code, //NULL OR '' - SEARCH PRODUCT NAME
							 'product_type'		=>'',
							 'product_category'	=>'',
		    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
								);
			// print_r($parameter);
			$result = $this->curl->call($parameter,url);
			// print_r($result);exit();
		    $data['products'] = json_decode($result,true);
		    
			$this->load->view('layout/short_header',$data);
			$this->load->view('mlm/addProd_inventory',$data);
			$this->load->view('layout/short_footer',$data);

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');

		}
	}


		public function hub_products()
	{
				
		$data = array('menu' => 18,
					 'parent'=>'' );
		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;
			$data['mlm_user'] = $this->session->userdata('MLM_user');

			$INPUT_POST = $this->input->post();

			if($INPUT_POST['product_code'] != ''){$product_code = $INPUT_POST['product_code'];} else{$product_code = NULL;}

			$parameter = array(
		    				 'dev_id'     		=>$this->global_f->dev_id(),
		    				 'ip_address' 		=>$this->ip,
		    				 'ip' 				=>$this->ip,
		    				 'actionId' 	 	=> _hub_inventory_list, 
		    				 'regcode'          =>$this->user['R'],
		    				 'product_code'		=>$product_code, //NULL OR '' - SEARCH PRODUCT NAME
		    				 'product_type'		=>'',
		    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
								);
			$result = $this->curl->call($parameter,url);
		    $data['products'] = json_decode($result,true);

			$this->load->view('layout/short_header',$data);
			$this->load->view('mlm/hub_products',$data);
			$this->load->view('layout/short_footer',$data);

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');

		}
	}

	public function highlighted_prod()
	{
		$rating = $this->uri->segment(3);
		$product_code = $this->uri->segment(4);

		$data = array('menu' => 18,
					 'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;
			$data['mlm_user'] = $this->session->userdata('MLM_user');

			$parameter = array(
		    				 'dev_id'     		=>$this->global_f->dev_id(),
		    				 'ip_address' 		=>$this->ip,
		    				 'ip' 				=>$this->ip,
		    				 'actionId' 	 	=> _rating_update, 
		    				 'regcode'          =>$this->user['R'],
		    				 'product_code'		=>$product_code,
							 'rating'			=>$rating,
		    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
								);
			$result = $this->curl->call($parameter,url);
		    $results = json_decode($result,true);
			redirect('Mlm/products');

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');

		}

			$this->load->view('layout/short_header',$data);
			$this->load->view('mlm/products',$data);
			$this->load->view('layout/short_footer',$data); 

	}


	public function csv_products()
	{

		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;
			$data['mlm_user'] = $this->session->userdata('MLM_user');

			if($data['mlm_user']['user_type'] == 1){

				$parameter = array(
			    				 'dev_id'     		=>$this->global_f->dev_id(),
			    				 'ip_address' 		=>$this->ip,
			    				 'ip' 				=>$this->ip,
			    				 'actionId' 	 	=> _fetch_product_list, 
			    				 'regcode'          =>$this->user['R'],
			    				 'product_name'		=>'', //NULL OR '' - SEARCH PRODUCT NAME
								 'product_type'		=>'',
								 'product_category'	=>'',
			    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
									);
				$result = $this->curl->call($parameter,url);
			    $results = json_decode($result,true);

			}else{

				$parameter = array(
			    				 'dev_id'     		=>$this->global_f->dev_id(),
			    				 'ip_address' 		=>$this->ip,
			    				 'ip' 				=>$this->ip,
			    				 'actionId' 	 	=> _hub_inventory_list, 
			    				 'regcode'          =>$this->user['R'],
			    				 'product_name'		=>'', //NULL OR '' - SEARCH PRODUCT NAME
			    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
									);
				$result = $this->curl->call($parameter,url);
			    $results1 = json_decode($result,true);
			    $results = $results1['DATA_LIST'];

			}

			header('Content-type: text/csv');
			header('Content-Disposition: attachment; filename="UPS Tangible Products.csv"');
			 
			// do not cache the file
			header('Pragma: no-cache');
			header('Expires: 0');
			 
			// create a file pointer connected to the output stream
			$file = fopen('php://output', 'w');
			 
			// send the column headers
			fputcsv($file, array('Product Code', 'Product Name', 'Price (SRP)', 'Discounted Price', 'Distributor Price','Point Value', 'Qty','Product Category'));
			 
			// output each row of the data
			foreach ($results as $row)
			{
				if($row['type'] == 1){$type = 'Package';} else{$type = 'Product';}

				$row_deatils = array($row['product_code'],$row['product_name'],$row['price'],$row['hub_price'],$row['distributor_price'],$row['pv'],$row['inventory'],$type); 
			    fputcsv($file, $row_deatils);
			}

			exit();

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');

		}  

	}

	function delete_products()
	{
		$product_code = $this->input->post('del_code');

			$parameter = array(
		    				 'dev_id'     		=>$this->global_f->dev_id(),
		    				 'ip_address' 		=>$this->ip,
		    				 'ip' 				=>$this->ip,
		    				 'actionId' 	 	=> _del_product, 
		    				 'regcode'          =>$this->user['R'],
		    				 'product_code'		=>$product_code,
		    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
								);
			$results = $this->curl->call($parameter,url);
		    $API = json_decode($results,true);

			if($API['S'] == 1){
				$message = array(
									'S' => 1,
									'M' => 'Successfully Deleted'
								);
			}else{
				$message = array(
									'S' => 2,
									'M' => $API['M']
								);
			}

			 echo json_encode($message);

	}

	public function quota()
	{
				
		$data = array('menu' => 18,
					 'parent'=>'' );
		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;
			$data['mlm_user'] = $this->session->userdata('MLM_user');

			$INPUT_POST = $this->input->post();

			if (isset($_POST['btn_edit_quota'])) {

			$parameter = array(
		    				 'dev_id'     		=>$this->global_f->dev_id(),
		    				 'ip_address' 		=>$this->ip,
		    				 'ip' 				=>$this->ip,
		    				 'actionId' 	 	=> _edit_quota, 
		    				 'regcode'          =>$this->user['R'],
		    				 'rank_code'        =>$INPUT_POST['btn_edit_quota'],
		    				 'maintain_pv'      =>$INPUT_POST['maintain_pv'],
		    				 'group_sales'      =>$INPUT_POST['group_sales'],
		    				 'rates'          	=>$INPUT_POST['rates']/100,
		    				 'qualify_pv'		=>$INPUT_POST['qualify_pv'],
		    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
								);
			$result = $this->curl->call($parameter,url);
		    $API = json_decode($result,true);

				if($API['S'] == 1){
					$data['result'] = array(
										'S' => 1,
										'M' => 'Successfully Updated'
									);
				}else{
					$data['result'] = array(
										'S' => 2,
										'M' => $API['M']
									);
				}

			}

			$parameter = array(
		    				 'dev_id'     		=>$this->global_f->dev_id(),
		    				 'ip_address' 		=>$this->ip,
		    				 'ip' 				=>$this->ip,
		    				 'actionId' 	 	=> _fetch_quota, 
		    				 'regcode'          =>$this->user['R'],
		    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
								);
			$result = $this->curl->call($parameter,url);
		    $data['quota'] = json_decode($result,true);

			$this->load->view('layout/short_header',$data);
			$this->load->view('mlm/quota',$data);
			$this->load->view('layout/short_footer',$data);
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');

		}
	}


	public function package()
	{
				
		$data = array('menu' => 18,
					 'parent'=>'' );
		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;
			$data['mlm_user'] = $this->session->userdata('MLM_user');

			$INPUT_POST = $this->input->post();

		if (isset($_POST['btn_edit_package_currency'])) {

			$parameter = array(
		    				 'dev_id'     		=>$this->global_f->dev_id(),
		    				 'ip_address' 		=>$this->ip,
		    				 'ip' 				=>$this->ip,
		    				 'actionId' 	 	=> _edit_package_currency, 
		    				 'regcode'          =>$this->user['R'],
		    				 'currency'         =>$INPUT_POST['i_currency'],
		    				 'currency_value'   =>$INPUT_POST['i_rate'],
		    				 'globalprice'      =>$INPUT_POST['i_gprice'],
		    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
								);
			$result = $this->curl->call($parameter,url);
		    $API = json_decode($result,true);

				if($API['S'] == 1){
					$data['result'] = array(
										'S' => 1,
										'M' => 'Successfully Updated'
									);
				}else{
					$data['result'] = array(
										'S' => 2,
										'M' => $API['M']
									);
				}
		}

			$parameter = array(
		    				 'dev_id'     		=>$this->global_f->dev_id(),
		    				 'ip_address' 		=>$this->ip,
		    				 'ip' 				=>$this->ip,
		    				 'actionId' 	 	=> _fetch_package_currency, 
		    				 'regcode'          =>$this->user['R'],
		    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
								);
			$result = $this->curl->call($parameter,url);
		    $data['countries'] = json_decode($result,true);

			$this->load->view('layout/short_header',$data);
			$this->load->view('mlm/package',$data);
			$this->load->view('layout/short_footer',$data);
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');

		}
	}

	public function gc()
	{
				
		$data = array('menu' => 18,
					 'parent'=>'' );
		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;
			$data['mlm_user'] = $this->session->userdata('MLM_user');

			$INPUT_POST = $this->input->post();

		if (isset($_POST['btn_search_by_status'])) {

			$data['csv_btn_on'] = 1;

			if ($INPUT_POST['gc_status'] == 0) {

				$data['generate_btn_on'] = 1;
				$data['csv_btn_on'] = 0;

			}

			$parameter = array(
		    				 'dev_id'     		=>$this->global_f->dev_id(),
		    				 'ip_address' 		=>$this->ip,
		    				 'ip' 				=>$this->ip,
		    				 'actionId' 	 	=> _search_gc, 
		    				 'regcode'          =>$this->user['R'],
		    				 'status'           =>$INPUT_POST['gc_status'],
		    				 'start_date'       =>$INPUT_POST['start_date'],
		    				 'end_date'         =>$INPUT_POST['end_date'],
		    				 'trackno'          =>$INPUT_POST['trackno'],
		    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
								);
			$result = $this->curl->call($parameter,url);
		    $API = json_decode($result,true);

			$this->session->set_userdata('gc_details',array(
											'status' => $INPUT_POST['gc_status'],
											'start_date' => $INPUT_POST['start_date'],
											'end_date' => $INPUT_POST['end_date'],
											'trackno' => $INPUT_POST['trackno'])
										);

				if($API['S'] == 1){
					$data['gc_details'] = $API['TDATA'];
				}else{
					$data['gc_details'] = '';
				}
		}

		if (isset($_POST['btn_generate_gc'])) {

			$parameter = array(
		    				 'dev_id'     		=>$this->global_f->dev_id(),
		    				 'ip_address' 		=>$this->ip,
		    				 'ip' 				=>$this->ip,
		    				 'actionId' 	 	=> _generate_gc, 
		    				 'regcode'          =>$this->user['R'],
		    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
								);
			$result = $this->curl->call($parameter,url);
		    $API = json_decode($result,true);

				if($API['S'] == 1){
					$data['result'] = array(
										'S' => 1,
										'M' => 'Successfully Generated'
									);
				}else{
					$data['result'] = array(
										'S' => 2,
										'M' => $API['M']
									);
				}
		}


		if (!isset($_POST['btn_search_by_status'])) {

			$parameter = array(
		    				 'dev_id'     		=>$this->global_f->dev_id(),
		    				 'ip_address' 		=>$this->ip,
		    				 'ip' 				=>$this->ip,
		    				 'actionId' 	 	=> _fetch_gc, 
		    				 'regcode'          =>$this->user['R'],
		    				 'limit'          	=>'20',
		    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
								);
			$result = $this->curl->call($parameter,url);
		    $data['gc_details'] = json_decode($result,true);
		}
		

			$this->load->view('layout/short_header',$data);
			$this->load->view('mlm/gc',$data);
			$this->load->view('layout/short_footer',$data);
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');

		}
	}

	public function csv_gc()
	{

		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;
			$data['mlm_user'] = $this->session->userdata('MLM_user');

			$sp_parameters = $this->session->userdata('gc_details');

			$parameter = array(
		    				 'dev_id'     		=>$this->global_f->dev_id(),
		    				 'ip_address' 		=>$this->ip,
		    				 'ip' 				=>$this->ip,
		    				 'actionId' 	 	=> _search_gc, 
		    				 'regcode'          =>$this->user['R'],
		    				 'status'           =>$sp_parameters['status'],
		    				 'start_date'       =>$sp_parameters['start_date'],
		    				 'end_date'         =>$sp_parameters['end_date'],
		    				 'trackno'          =>$sp_parameters['trackno'],
		    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
								);
			$result = $this->curl->call($parameter,url);
		    $results = json_decode($result,true);


			header('Content-type: text/csv');
			header('Content-Disposition: attachment; filename="Generate GC.csv"');
			 
			// do not cache the file
			header('Pragma: no-cache');
			header('Expires: 0');
			 
			// create a file pointer connected to the output stream
			$file = fopen('php://output', 'w');
			 
			// send the column headers
			fputcsv($file, array('Regcode', 'Claimant', 'Gift Cheque', 'Tracking Number', 'Date Generated','Status'));
			 
			// output each row of the data
			foreach ($results["TDATA"] as $row)
			{
				$row_deatils = array($row['regcode'],$row['claimant'],$row['gc'],$row['trackno'],$row['dategenerated'],$row['remarks']); 
			    fputcsv($file, $row_deatils);
			}

			exit();

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');

		}  

	}


	public function inventory_report()
	{

		$data = array('menu' => 18,
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
						    				'actionId' 	 		=>'ups_mlm_test/fetch_inventory_report', 
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
			    				'actionId' 	 		=>'ups_mlm_test/fetch_inventory_report', 
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
			$this->load->view('mlm/inventory_report',$data);
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
					    				'actionId' 	 		=>'ups_mlm_test/fetch_inventory_report', 
					    				'regcode'          	=>$this->user['R'],
					    				'start_date'		=>$report_parameters['start_date'],
					    				'end_date'			=>$report_parameters['end_date'],
					    				'prodcode'			=>$report_parameters['prodcode'],
					    				$this->user['SKT'] 	=>  md5($this->user['R'].$this->user['SKT'])
									);														
					$result = $this->curl->call($parameter,url);														
		    		$results = json_decode($result,true);

			$column = array('Regcode', 'Product Code', 'Transtype', 'Inventory Added', 'Inventory Before', 'Inventory After','Expiry Date','DateTime','Trackno');
			
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
				$row_details = array($row['regcode'], $row['prodcode'], $row['transtype'], $row['inventory_added'],$row['inventory_before'],$row['inventory_after'],$row['exp_date'],$row['datetime'], "'".$row['trackno'] ); 

			    fputcsv($file, $row_details);
			}

			exit();

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');

		}  

	}



	public function mlm_report()
	{

		$data = array('menu' => 18,
					 'parent'=>'' );
		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;
			$data['mlm_user'] = $this->session->userdata('MLM_user');
		
			$INPUT_POST = $this->input->post();		
	
			$x = explode('|', $INPUT_POST['selMLMReport']);
			$data['type'] = $x[0];
			$data['title'] = $x[1];

			if($data['mlm_user']['user_type'] == 1){

			$data['r_title'] = array(
							array('id' => '1','desc' => 'PRODUCT DISTRIBUTED'),
							array('id' => '2','desc' => 'PRODUCT INVENTORY SUMMARY')
							);

			} else{

			$data['r_title'] = array(
							array('id' => '1','desc' => 'PRODUCT SOLD'),
							array('id' => '2','desc' => 'PRODUCT INVENTORY SUMMARY')
							);
			}

			if($INPUT_POST['inputStart'] == ''){$start_date = '';} else {$start_date = $INPUT_POST['inputStart'];}	
			if($INPUT_POST['inputEnd'] == ''){$end_date = '';} else {$end_date = $INPUT_POST['inputEnd'];}
			if($INPUT_POST['selCategory'] == ''){$selCategory = '';} else {$selCategory = $INPUT_POST['selCategory'];}	

		if (isset($_POST['btnSearch'])) {
			$this->session->set_userdata('reporttype',$data['type']);

				if($data['type'] == 1){

					$parameter = array(
				    				 'dev_id'     		=>$this->global_f->dev_id(),
				    				 'ip_address' 		=>$this->ip,
				    				 'actionId' 	 	=> _fetch_mlm_report, 
				    				 'regcode'          =>$this->user['R'],
				    				 'type'          	=>$data['type'],
				    				 'access_type'		=>$data['mlm_user']['user_type'],
				    				 'start_date'		=>'',
				    				 'end_date'			=>'',
				    				 'selCategory'      =>'',
				    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
										);					
					$result = $this->curl->call($parameter,url);									
				    $results = json_decode($result,true);
				    $data['mlm_report']  = $results;

					$this->session->set_userdata('report_details',array(
												'type' => $data['type'],
												'access_type' => $data['mlm_user']['user_type'],
												'start_date' => '',
												'end_date' => '',
												'selCategory' => '')
												);

				}else{
					$data['mlm_report']  = NULL;
				}

		}

		if (isset($_POST['btnSearchReport'])) {
			$reporttype = $this->session->userdata('reporttype');

					$parameter = array(
				    				 'dev_id'     		=>$this->global_f->dev_id(),
				    				 'ip_address' 		=>$this->ip,
				    				 'actionId' 	 	=> _fetch_mlm_report, 
				    				 'regcode'          =>$this->user['R'],
				    				 'type'          	=>$reporttype,
				    				 'access_type'		=>$data['mlm_user']['user_type'],
				    				 'start_date'		=>$start_date,
				    				 'end_date'			=>$end_date,
				    				 'selCategory'      =>$selCategory,
				    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
										);														
					$result = $this->curl->call($parameter,url);														
				    $results = json_decode($result,true);
				    $data['mlm_report']  = $results;

					$this->session->set_userdata('report_details',array(
												'type' => $reporttype,
												'access_type' => $data['mlm_user']['user_type'],
												'start_date' => $start_date,
												'end_date' => $end_date,
												'selCategory' => $selCategory)
												);
		}

			$this->load->view('layout/short_header',$data);
			$this->load->view('mlm/mlm_report',$data);
			$this->load->view('layout/short_footer',$data);
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');

		}

	}


	public function csv_report_gen()
	{

		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;
			$data['mlm_user'] = $this->session->userdata('MLM_user');

			$report_parameters = $this->session->userdata('report_details');

					$parameter = array(
				    				 'dev_id'     		=>$this->global_f->dev_id(),
				    				 'ip_address' 		=>$this->ip,
				    				 'actionId' 	 	=> _fetch_mlm_report, 
				    				 'regcode'          =>$this->user['R'],
				    				 'type'          	=>$report_parameters['type'],
				    				 'access_type'		=>$report_parameters['access_type'],
				    				 'start_date'		=>$report_parameters['start_date'],
				    				 'end_date'			=>$report_parameters['end_date'],
				    				 'selCategory'      =>$report_parameters['selCategory'],
				    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
										);														
					$result = $this->curl->call($parameter,url);														
		    		$results = json_decode($result,true);

			if($report_parameters['access_type'] == 1){
				$column = array('Regcode', 'Distributed to', 'Product Code', 'Product Name','Total Quantity','Price (SRP)','Total PV','Total Amount','Product Category','Transaction Date');
			}else{
				$column = array('Regcode', 'Sold to', 'Product Code', 'Product Name','Total Quantity','Price (SRP)','Total PV','Total Discount','Total Amount','Product Category','Mode of Payment','Transaction Date');
			}

			header('Content-type: text/csv');
			header('Content-Disposition: attachment; filename="Cart Purchased Report.csv"');
			 
			// do not cache the file
			header('Pragma: no-cache');
			header('Expires: 0');
			 
			// create a file pointer connected to the output stream
			$file = fopen('php://output', 'w');
			 
			// send the column headers
			fputcsv($file, $column);
			 
			// output each row of the data
			foreach ($results['T_DATA'] as $row)
			{
				if($report_parameters['access_type'] == 1){
					$row_details = array($row['regcode'],$row['purchasing_regcode'],$row['prod_code'],$row['prod_name'],$row['quantity'],$row['SRP'],$row['pv'],$row['price'],$row['type']==1?'Package':'Product',$row['date_purchased']); 
				} else{
					$row_details = array($row['regcode'],$row['purchasing_regcode'],$row['prod_code'],$row['prod_name'],$row['quantity'],$row['SRP'],$row['pv'],$row['discount'],$row['price'],$row['type']==1?'Package':'Product',$row['payment_type'],$row['date_purchased']); 
				}

			    fputcsv($file, $row_details);
			}

			exit();

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');

		}  

	}



	public function hub_inventory()
	{

		$data = array('menu' => 18,
					 'parent'=>'' );
		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;
			$data['mlm_user'] = $this->session->userdata('MLM_user');
		
			$INPUT_POST = $this->input->post();		
			
			if($INPUT_POST['regcode'] == ''){$ref_regcode = '';} else {$ref_regcode = $INPUT_POST['regcode'];}	

			if (isset($_POST['btnSearchReport'])) {
						$parameter = array(
						    				'dev_id'     		=>$this->global_f->dev_id(),
						    				'ip_address' 		=>$this->ip,
						    				'actionId' 	 		=>'ups_mlm_test/fetch_hub_inventory', 
						    				'regcode'          	=>$this->user['R'],
						    				'ref_regcode'        =>$ref_regcode,
						    				$this->user['SKT'] 	=>  md5($this->user['R'].$this->user['SKT'])
										);		

						$result = $this->curl->call($parameter,url);		
						// print_r($result); //die();												
					    $results = json_decode($result,true);
					    $data['mlm_inventory_report']  = $results;
					    // print_r($data['mlm_inventory_report']);
						$this->session->set_userdata('report_details',array(
													'access_type' => $data['mlm_user']['user_type'],
													'ref_regcode' =>$ref_regcode,
													));
			} else {

						$parameter = array(
			    				'dev_id'     		=>$this->global_f->dev_id(),
			    				'ip_address' 		=>$this->ip,
			    				'actionId' 	 		=>'ups_mlm_test/fetch_hub_inventory', 
			    				'regcode'          	=>$this->user['R'],
			    				'ref_regcode'        =>$ref_regcode,
			    				$this->user['SKT'] 	=>  md5($this->user['R'].$this->user['SKT'])
							);		

						$result = $this->curl->call($parameter,url);		
						// print_r($result); //die();												
					    $results = json_decode($result,true);
					    $data['mlm_inventory_report']  = $results;

					    $this->session->set_userdata('report_details',array(
													'access_type' => $data['mlm_user']['user_type'],
													'ref_regcode' =>$ref_regcode,
													));
			}

			$this->load->view('layout/short_header',$data);
			$this->load->view('mlm/hub_inventory',$data);
			$this->load->view('layout/short_footer',$data);
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');

		}

	}

	public function csv_hub_inventory()
	{

		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;
			$data['mlm_user'] = $this->session->userdata('MLM_user');

			$report_parameters = $this->session->userdata('report_details');
			// print_r($report_parameters['start_date']);exit();
					$parameter = array(
					    				'dev_id'     		=>$this->global_f->dev_id(),
					    				'ip_address' 		=>$this->ip,
					    				'actionId' 	 		=>'ups_mlm_test/fetch_hub_inventory', 
					    				'regcode'          	=>$this->user['R'],
					    				'ref_regcode'		=>$report_parameters['ref_regcode'],
					    				$this->user['SKT'] 	=>  md5($this->user['R'].$this->user['SKT'])
									);														
					$result = $this->curl->call($parameter,url);														
		    		$results = json_decode($result,true);

			$column = array('Regcode', 'Product Code', 'Product Name', 'Total Stocks', 'Sold', 'Available Stocks');
	
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
				$row_details = array($row['regcode'], $row['product_code'], $row['product_name'], $row['stock_total_prod'],$row['total_sold'],$row['stock_avail_prod']); 

			    fputcsv($file, $row_details);
			}

			exit();

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');

		}  

	}



	public function hub_account()
	{
				
		$data = array('menu' => 18,
					 'parent'=>'' );
		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;
			$data['mlm_user'] = $this->session->userdata('MLM_user');

			$INPUT_POST = $this->input->post();

			if (isset($_POST['btn_add_MLMuser'])) {

				$url = url;
				$parameter = array(
			    				 'dev_id'     		=>$this->global_f->dev_id(),
			    				 'ip_address' 		=>$this->ip,
			    				 'actionId' 	 	=> 'ups_mlm_test/add_mlm_User', 
			    				 'regcode'          =>$this->user['R'],
			    				 'user_regcode'		=>trim($INPUT_POST['user_regcode']),
			    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
									);
				// print_r($parameter);
				$result = $this->curl->call($parameter,$url);
			    $API = json_decode($result,true);

				if($API['S'] == 1){
					$data['result'] = array(
										'S' => 1,
										'M' => 'Successfully Added'
									);
				}else{
					$data['result'] = array(
										'S' => 2,
										'M' => $API['M']
									);
				}

			}

			if (isset($_POST['btn_edit_discount'])) {

				$parameter = array(
			    				 'dev_id'     		 =>$this->global_f->dev_id(),
			    				 'ip_address' 		 =>$this->ip,
			    				 'actionId' 	 	 =>'ups_mlm_test/edit_mlmUser_discount', 
			    				 'regcode'           =>$this->user['R'],
			    				 'product_regcode'	 =>trim($INPUT_POST['regcode']),
			    				 'product_discount'	 =>$INPUT_POST['discount'],
			    				  $this->user['SKT'] =>md5($this->user['R'].$this->user['SKT'])
								);
				//print_r($parameter);
				$result = $this->curl->call($parameter,url);
				//print_r($result);
			    $API = json_decode($result,true);

				if($API['S'] == 1){
					$data['result'] = array(
										'S' => 1,
										'M' => $API['M']
									);
				}else{
					$data['result'] = array(
										'S' => 2,
										'M' => $API['M']
									);
				}

			}

			if($INPUT_POST['acct_regcode'] != ''){$regcode = $INPUT_POST['acct_regcode'];} else{$regcode = NULL;}

			$parameter = array(
		    				 'dev_id'     		=>$this->global_f->dev_id(),
		    				 'ip_address' 		=>$this->ip,
		    				 'actionId' 	 	=>'ups_mlm_test/fetch_mlmuser_list', 
		    				 'regcode'          =>$this->user['R'],
		    				 'product_regcode'	=>$regcode, //NULL OR '' - SEARCH PRODUCT NAME
		    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
							);
			$result = $this->curl->call($parameter,url);
			// print_r($result);
		    $data['hub_user'] = json_decode($result,true);
		    
			$this->load->view('layout/short_header',$data);
			$this->load->view('mlm/hub_account',$data);
			$this->load->view('layout/short_footer',$data);

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');

		}
	}



}