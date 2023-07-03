<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

   	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('curl_model','curl');
		$this->load->library('session');
		$this->user = $this->session->userdata('user');
	    // $this->ip = $this->input->ip_address();
	    $IP = $_SERVER['REMOTE_ADDR'];

        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
            $IP = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
        }

        $this->ip = $IP;
        
	    $this->load->model('Query_model','q');
	  	$this->load->model('Report_model','r');
	  	$this->load->model('Global_function','global_f');

	}

	public function index()
	{
		$data = array('menu' => 12,
					 'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;
			$this->load->view('report/index',$data);
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
		
	}
	//GENERAL REPORT

	function general_report()
	{
		$data = array('menu' => 12,
					 'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;

			if (isset($_POST['btnSearch'])){
				$INPUT_POST = $this->input->post(null,true);
				
				$data['user'] = $this->user;

				$parameter =array(
							'dev_id'     		=> $this->global_f->dev_id(),
							'actionId'          => _general_report, 
							'ip_address'		=> $this->ip, 
		    				'regcode'           => $this->user['R'],
		    				'startdate'			=> $INPUT_POST['inputStart'],
		    				'enddate'			=> $INPUT_POST['inputEnd']
					    	); 
			    $result = $this->curl->call($parameter,url);
			   	$API = json_decode($result,true);

			   	if ($API['S'] == 1) {
		   			$data['process'] = array('P'=>1,
											 'S'=>1);
			   	}
			   		$data['API'] = $API;
			   		$date = array('startdate'=>$INPUT_POST['inputStart'],
			   					   'enddate'=>$INPUT_POST['inputEnd']);
			   		$this->session->set_userdata('inputdate',$date);

			}
			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('report/general_report'); 
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');	

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}


	function export($get){

		if ($get == md5('general_report')) {

			$this->r->export_general_report();

		}elseif($get == md5('ecash')){

			$this->r->export_ecash_report();

		}elseif($get == md5('payout')){
			
			$this->r->export_payout_report();

		}elseif($get == md5('billspayment')){

			$this->r->export_billspayment_report();

		}elseif($get == md5('loading')){

			$this->r->export_loading_report();
			
		}else {

			echo "The Requested URL ". BASE_URL() ."export/". $get ."<br />"."was not found on this server";
			

		}
	}



	function ecash()
	{
		$data = array('menu' => 12,
					 'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;

			if (isset($_POST['btnSearch'])){
				$INPUT_POST =$this->input->post(null,true);
				$this->session->unset_userdata('concaturl');
				if ($INPUT_POST['selEcash'] == 0) {
						$parameter =array(
							'dev_id'     		=> $this->global_f->dev_id(),
							'actionId'         	=> _ecash_padala_report, 
							'ip_address'		=> $this->ip, 
		    				'regcode'           => $this->user['R']
					    	);
						
						$data['TBODY'] = 1;

				}
				elseif($INPUT_POST['selEcash'] == 4) {
					$concaturl = $this->r->sendRequest($INPUT_POST['selEcash']);
					$this->session->set_userdata('concaturl',$concaturl);

					$parameter =array(
							'dev_id'     		=> $this->global_f->dev_id(),
							'actionId'         	=> _ecash_cashcard, 
							'ip_address'		=> $this->ip, 
		    				'regcode'           => $this->user['R']
					    	);

					$data['TBODY'] = 3;

				}
				else { 
						$concaturl = $this->r->sendRequest($INPUT_POST['selEcash']);
						$this->session->set_userdata('concaturl',$concaturl);
						$parameter =array(
							'dev_id'     		=> $this->global_f->dev_id(),
							'actionId'         	=> _ecash_remittance_report.$concaturl, 
							'ip_address'		=> $this->ip, 
		    				'regcode'           => $this->user['R']
					    	); 
						$data['TBODY'] = 2;
				}
				
			    $result = $this->curl->call($parameter,url);
			   	$API = json_decode($result,true);
			 	
				if ($API['S'] === 0) {
					$data['process'] = array ('P'=>1,
											  'S'=>0,
											  'M'=>$API['M']);
				}else {
					if ($INPUT_POST['selEcash'] == 1 || $INPUT_POST['selEcash'] == 2 || $INPUT_POST['selEcash'] == 3) {
						$data['field'] = array('Tracking No','Account Name','Type','Amount','Charge','Total','Date/Time');

					}
					elseif ($INPUT_POST['selEcash'] == 4){
						$data['field'] = array('Tracking No','Regcode','Reference No','Sender','Receipient','Amount','Charge','Date/Time');

					}
					else {
						$data['field'] = array('Tracking No','Regcode','Sender Name','Sender Card No','Sender Address','Sender Email','Sender Mobile','Benificiary Name','Benificiary Card No','Benificiary Address','Benificiary Email','Benificiary Mobile','Amount','Date');
						
					}

					$data['process'] = array ('P'=>1,
											  'S'=>1,
											  'M'=>$API['M']);
					$data['API'] = $API;

				}
			}
			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('report/ecash'); 
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');				
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}

	}

	function ecash_payout()
	{
		$data = array('menu' => 12,
					  'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;

			if (isset($_POST['btnSearch'])){
				$INPUT_POST =$this->input->post(null,true);
				$this->session->unset_userdata('concaturl');

				 if ($INPUT_POST['selEcashPayout'] == 0) {

					$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId'         	=> _ecash_padala_report, 
						'ip_address'		=> $this->ip, 
	    				'regcode'           => $this->user['R']
				    	); 

				}elseif($INPUT_POST['selEcashPayout'] >= 5){

					$concaturl = $this->r->sendRequestPayout($INPUT_POST['selEcashPayout']);
					$this->session->set_userdata('concaturl',$concaturl);
					$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId'         	=> _ecash_remittance_report.$concaturl, 
						'ip_address'		=> $this->ip, 
	    				'regcode'           => $this->user['R']
				    	); 
				}else{

					$concaturl = $this->r->sendRequestPayout($INPUT_POST['selEcashPayout']);
					$this->session->set_userdata('concaturl',$concaturl);
					$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId'         	=> _ecash_payout_report.$concaturl, 
						'ip_address'		=> $this->ip, 
	    				'regcode'           => $this->user['R']
				    	); 
				}
				
			    $result = $this->curl->call($parameter,url);
			   	$API = json_decode($result,true); 

				if ($API['S'] === 0) {
					$data['process'] = array ('P'=>1,
											  'S'=>0,
											  'M'=>$API['M']);
				}else {
					if ($INPUT_POST['selEcashPayout'] == 0) {

						$data['field'] = array('Tracking No','Regcode','Sender Name','Sender Card No','Sender Address','Sender Email','Sender Mobile','Benificiary Name','Benificiary Card No','Benificiary Address','Benificiary Email','Benificiary Mobile','Amount','Date');
						$data['TBODY'] = 0;

					}elseif ($INPUT_POST['selEcashPayout'] == 4) {

						$data['field'] = array('RefNo','Tracking No','Receipt No','Currency','Amount','Charge','Beneficiary Name','Beneficiary Mobile','ID Type','ID No','Payout Amount','Date/Time');
						$data['TBODY'] = 1;

					}elseif ($INPUT_POST['selEcashPayout'] >= 5) {

						$data['field'] = array('Tracking No','Regcode','Account Name','Type','Amount','Charge','Total','Date/Time');
						$data['TBODY'] = 2;	

					}else {

						$data['field'] = array('Tracking No','Regcode','RefNo','Beneficiary Name','Beneficiary Contact','Type','Amount','Date/Time');
						$data['TBODY'] = 3;
					}

					$data['process'] = array ('P'=>1,
											  'S'=>1,
											  'M'=>$API['M']);
					$data['API'] = $API;

				}

			}
			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('report/ecash_payout'); 
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');		
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}

	}

	function bills_payment()
	{
		$data = array('menu' => 12,
					  'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;

			
				$parameter =array(
					'dev_id'     		=> $this->global_f->dev_id(),
					'actionId'         	=> _billspayment_report, 
					'ip_address'		=> $this->ip, 
    				'regcode'           => $this->user['R']
			    	); 
			
				
				
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

			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('report/bills_payment'); 
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');	
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}

	function loading(){
		$data = array('menu' => 12,
					  'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;
			if (isset($_POST['btnSearch'])) {
				$INPUT_POST = $this->input->post(null,true);
				if ($INPUT_POST['selLoad'] == 1) { //CARD
					$data['field'] = array('Trans #','Mobile #','Regcode','Plancode','Card Details','Date');
					$url = _view_cards;
					$data['TBODY'] = 1;
				}elseif ($INPUT_POST['selLoad']==2) { //UNIVERSAL
					$data['field'] = array("TRACKING","REGCODE","MOBILE", "TRANSACTION TYPE,","STATUS",
											"TRANS NO","AMOUNT","DEBIT", "PROFIT","CREDIT","BALANCE","DATE");
					$url = _universal;

					$data['TBODY'] = 2;	
				
				}elseif ($INPUT_POST['selLoad']==3) { //CURRENT TRANSACTION
					$data['field'] = array("TRACKING","REGCODE", "MOBILE NO","TRANSACTION TYPE", 
											"STATUS", "TRANS NO", "REFERENCE NO","AMOUNT", "PLANCODE",
											"RETAIL","DEBIT","PROFIT","CREDIT","BALANCE","POSTING DATE/PROCESS TIME");
					$url = _airtime_transaction_current;
					$data['TBODY'] = 3;	

				}elseif($INPUT_POST['selLoad']==4){
					$data['field'] = array("TRACKING","REGCODE", "MOBILE NO","TRANSACTION TYPE", 
											"STATUS", "TRANS NO", "REFERENCE NO","AMOUNT", "PLANCODE",
											"RETAIL","DEBIT","PROFIT","CREDIT","BALANCE","POSTING DATE/PROCESS TIME",
											 );
					$url = _airtime_transaction_old;
					$data['TBODY'] = 4;	
					

				}elseif ($INPUT_POST['selLoad']==5) { // CURRENT AIRTIME REPORT
					$data['field'] = array("TRANS NO", "REGCODE","PLANCODE","MOBILE","TRANS TYPE","TELCO",
												"REFERENCE NO","STATUS","POSTING TIME", "PROCESS TIME");
					$url = _airtime_current;
					$data['TBODY'] = 5;	
				
				}elseif ($INPUT_POST['selLoad']==6) { // CURRENT AIRTIME REPORT
					$data['field'] = array("TRANS NO", "REGCODE","PLANCODE","MOBILE","TRANS TYPE","TELCO",
												"REFERENCE NO","STATUS","POSTING TIME", "PROCESS TIME");
					$url = _airtime_old;
					$data['TBODY'] = 6;	
				
				}else{
					$url = "";
				}
				if ($url == "") {
						$data['process'] = array ('P'=>1,
													'S'=>0,
												   'M'=>"No URL found!");
				}else {
						$arr = array('field'		=>$data['field'],
									 'url'  		=>$url,
									 'TBODY' 		=>$data['TBODY'],
									 'startdate'	 => $INPUT_POST['inputStart'],
									 'enddate'		 => $INPUT_POST['inputEnds']);
						$this->session->set_userdata('arr',$arr);

						$parameter =array(
								'dev_id'     		=> $this->global_f->dev_id(),
								'actionId'          => $url, 
								'ip_address'		=> $this->ip, 
								'regcode'           => $this->user['R'],
								'startdate'			=> $INPUT_POST['inputStart'],
								'enddate'			=> $INPUT_POST['inputEnds']
				    	); 
				    	$result = $this->curl->call($parameter,url);
						$API = json_decode($result,true);
						$data['API'] = $API;
						

						if ($API['S'] === 0) {
							$data['process'] = array ('P'=>1,
													  'S'=>0,
													  'M'=>$API['M']);
						}else {
							$data['process'] = array ('P'=>1,
													  'S'=>1,
													  'M'=>$API['M']);
						}
						$date = array('startdate'=>date('Y-m-d',strtotime($INPUT_POST['inputStart'])),
					   					   'enddate'=>date('Y-m-d',strtotime($INPUT_POST['inputEnd'])));
					   	$this->session->set_userdata('inputdate',$date);
		    	}
				
			}
		
			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('report/loading'); 
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');	
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}	
	}
	function ticketing()
	{
		$data = array('menu' => 12,
					  'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;

			if (isset($_POST['btnSearch'])){
				$INPUT_POST =$this->input->post(null,true);
				$data['process'] = array('P'=>1,
										 'M'=>"No Record Found!",
										 'S'=>1);
			}
			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('report/ticketing'); 
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');	
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}

	function online_purchase()
	{
		$data = array('menu' => 12,
					 'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;

			if (isset($_POST['btnSearch'])){
				$INPUT_POST =$this->input->post(null,true);
				$data['process'] = array('P'=>1,
										 'M'=>"No Record Found!",
										 'S'=>1);
			}
			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('report/online_purchase'); 
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');	
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}

	//function 


	
}