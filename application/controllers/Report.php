<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

   	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Curl_model','curl');
		$this->load->library('session');
		$this->user = $this->session->userdata('user');
	    // $this->ip = $this->input->ip_address();
		
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
//update by nhez 03/21/2017
	  /*	$ACC_CONTROL = $this->Sp_model->userprivilege(); 
	   	$this->user['A_CTRL'] = $ACC_CONTROL['A_CTRL'];
		   $this->session->set_userdata('user',$this->user);*/
	}

	public function index()
	{
		$data = array('menu' => 14,
					 'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;
			$testaccount = substr($data['user']['R'],0,2);

			if($testaccount == 'UF'){
				$data['retailer'] = 1;

			}
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
		$data = array('menu' => 14,
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

			   	// echo "<pre>";
			   	// 	print_r($API["TDATA"]);
			   	// echo "</pre>";

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

		}elseif($get == md5('einsurance_report')){

			$this->r->export_einsurance_report();

		}elseif($get == md5('aed_fund_report')){

			$this->r->export_aed_fund_report();

		}elseif($get == md5('qatar_fund_report')){

			$this->r->export_qatar_fund_report();

		}elseif($get == md5('hkd_fund_report')){

			$this->r->export_hkd_fund_report();
			
		}elseif($get == md5('sgd_fund_report')){

			$this->r->export_sgd_fund_report();
			
		}elseif($get == md5('forexecash_transfer_report')){

			$this->r->export_forexecash_report();

		}elseif($get == md5('myr_fund_report')){

			$this->r->export_myr_fund_report();
		
		}elseif($get == md5('hotel_report')){

			$this->r->export_hotel_report();
		
		}
		// elseif($get == md5('hotel_booking_report')){

		// 	$this->r->export_hotel_booking_report();
		
		// }
		elseif($get == md5('mcwd_report')){

			$this->r->export_mcwd_report();

		}elseif($get == md5('metroturf_report')){

			$this->r->export_metroturf_report();

		}elseif($get == md5('ctpl_report')){

			$this->r->export_ctpl_report();

		}else {

			echo "The Requested URL ". BASE_URL() ."export/". $get ."<br />"."was not found on this server";
			

		}
	}



	function ecash()
	{
		$data = array('menu' => 14,
					 'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;

			if (isset($_POST['btnSearch'])){
				$INPUT_POST =$this->input->post(null,true);
				$this->session->unset_userdata('concaturl');
				if ($INPUT_POST['selEcash'] == 0) 
				{
					$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId'         	=> _ecash_padala_report, 
						'ip_address'		=> $this->ip, 
						'regcode'           => $this->user['R']
						);
					
					$data['TBODY'] = 1;
				}
				elseif($INPUT_POST['selEcash'] == 4) 
				{
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
				elseif($INPUT_POST['selEcash'] == 5) 
				{
					$concaturl = $this->r->sendRequest($INPUT_POST['selEcash']);
					$this->session->set_userdata('concaturl',$concaturl);

					$parameter =array(
							'dev_id'     		=> $this->global_f->dev_id(),
							'actionId'         	=> _cebuana_report_v2, 
							'ip_address'		=> $this->ip, 
		    				'regcode'           => $this->user['R'],
		    				'method'           => 'ecash_to_cebuana_send'
					    	);

					$data['TBODY'] = 5;
				}
				elseif($INPUT_POST['selEcash'] == 6) 
				{
					$concaturl = $this->r->sendRequest($INPUT_POST['selEcash']);
					$this->session->set_userdata('concaturl',$concaturl);

					$parameter =array(
							'dev_id'     		=> $this->global_f->dev_id(),
							'actionId'         	=> 'ups_report_service/smartmoney_report', 
							'ip_address'		=> $this->ip, 
		    				'regcode'           => $this->user['R'],
					    	);

					$data['TBODY'] = 6;
				}
				elseif($INPUT_POST['selEcash'] == 3) 
				{
					$concaturl = $this->r->sendRequest($INPUT_POST['selEcash']);
					$this->session->set_userdata('concaturl',$concaturl);
					$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId'         	=> _ecash_remittance_report.$concaturl, 
						'ip_address'		=> $this->ip, 
						'regcode'           => $this->user['R']
						); 
					$data['TBODY'] = 33;
        		}         
				elseif($INPUT_POST['selEcash'] == 7) // Harry Ecash Cardless Padala 11/25/2019
				{
					$concaturl = $this->r->sendRequest($INPUT_POST['selEcash']);
					$this->session->set_userdata('concaturl',$concaturl);
					$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId'         	=> _ecash_cardless_report, 
						'ip_address'		=> $this->ip, 
						'regcode'           => $this->user['R']
						); 
					$data['TBODY'] = 7;
				}
				elseif($INPUT_POST['selEcash'] == 8) 
				{					
					$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId'         	=> _western_union_report, 
						'ip_address'		=> $this->ip, 
						'regcode'           => $this->user['R'],
						'method'           => 'ecash_to_western_union_send'
					);

					$data['TBODY'] = 8;
				}
				elseif($INPUT_POST['selEcash'] == 9) 
				{					
					$parameter =array(
						'dev_id'	=> $this->global_f->dev_id(),
						'actionId'	=> 'ups_report_service/ecpay_report', 
						'ip_address'=> $this->ip, 
						'regcode'	=> $this->user['R'], 
						'service'	=> 'GCASH'
					);

					$data['TBODY'] = 9;
				}
				elseif($INPUT_POST['selEcash'] == 10) 
				{					
					$parameter =array(
						'dev_id'	=> $this->global_f->dev_id(),
						'actionId'	=> 'ups_report_service/ecpay_report', 
						'ip_address'=> $this->ip, 
						'regcode'	=> $this->user['R'],
						'service'	=> 'PAYMAYA'
					);

					$data['TBODY'] = 10;
				}
				else 
				{ 
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

				if ($API['S'] === 0)
				{
					$data['process'] = array ('P'=>1,'S'=>0,'M'=>$API['M']);
				}
				else 
				{
					if ($INPUT_POST['selEcash'] == 1 || $INPUT_POST['selEcash'] == 2) 
					{
						$data['field'] = array('Tracking No','Account Name','Type','Amount','Charge','Total','Date/Time');
					}
					elseif ($INPUT_POST['selEcash'] == 3)
					{
						$data['field'] = array('Tracking No','Account Name','Type','Amount','Charge','Total','Date/Time','Status');
					}
					elseif ($INPUT_POST['selEcash'] == 4)
					{
						$data['field'] = array('Tracking No','Regcode','Reference No','Sender','Receipient','Amount','Charge','Date/Time');
					}
					elseif ($INPUT_POST['selEcash'] == 5)
					{
						$data['field'] = array('Tracking No','Regcode','Reference No','Sender','Beneficiary','Amount','Charge','Date/Time', 'Status');
					}
					elseif ($INPUT_POST['selEcash'] == 6)
					{
						$data['field'] = array("Tracking No", "Regcode",  "Sender Name",  "Beneficiary",  "Amount",  "Charge",  "Total",  "Status",  "Balance Before",  "Balance After",  "Date/Time");
					}
					elseif ($INPUT_POST['selEcash'] == 7)
					{
						$data['field'] = array("Tracking No", "Regcode",  "Sender Name",  "Beneficiary",  "Amount",  "Charge",  "Total",  "Reference Number",  "Balance Before",  "Balance After",  "Date/Time");
					}
					elseif ($INPUT_POST['selEcash'] == 8)
					{
						$data['field'] = array("MTCN", "Tracking No", "Sender Name", "Type", "Amount", "Charge", "Total", "Status", "Date/Time");
					}
					elseif ($INPUT_POST['selEcash'] == 9)
					{
						$data['field'] = array("Tracking No", "Mobile No", "Customer Name", "Amount", "Charge", "Total", "Status", "Reference No", "Date/Time");
					}
					elseif ($INPUT_POST['selEcash'] == 10)
					{
						$data['field'] = array("Tracking No", "Money Code", "Mobile No", "Amount", "Charge", "Total", "Status", "Reference No", "Date/Time");
					}
					else 
					{
						$data['field'] = array('Tracking No','Regcode','Sender Name','Sender Card No','Sender Address','Sender Email','Sender Mobile','Benificiary Name','Benificiary Card No','Benificiary Address','Benificiary Email','Benificiary Mobile','Amount','Date');						
					}

					$data['process'] = array ('P'=>1,'S'=>1,'M'=>$API['M']);
					$data['API'] = $API;

				}
			}
			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('report/ecash2'); 
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
		$data = array('menu' => 14,
					  'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;

			if (isset($_POST['btnSearch'])){
				$INPUT_POST =$this->input->post(null,true);
				$this->session->unset_userdata('concaturl');

				 if ($INPUT_POST['selEcashPayout'] == 0) {

					$parameter =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId'         	=> _ecash_padala_payout_report, 
						'ip_address'		=> $this->ip, 
	    				'regcode'           => $this->user['R']
				    	); 

				}elseif($INPUT_POST['selEcashPayout'] == 8){

					$concaturl = $this->r->sendRequestPayout($INPUT_POST['selEcashPayout']);
					$this->session->set_userdata('concaturl',$concaturl);

					$parameter =array(
							'dev_id'     		=> $this->global_f->dev_id(),
							'actionId'         	=> _cebuana_report_v2, 
							'ip_address'		=> $this->ip, 
		    				'regcode'           => $this->user['R'],
		    				'method'           => 'ecash_to_cebuana_payout'
					    	);

				}elseif($INPUT_POST['selEcashPayout'] == 5 || $INPUT_POST['selEcashPayout'] == 6 || $INPUT_POST['selEcashPayout'] == 7){

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

						$data['field'] = array('Tracking No','Regcode','Payout Regcode','Sender Name','Sender Card No','Sender Address','Sender Email','Sender Mobile','Benificiary Name','Benificiary Card No','Benificiary Address','Benificiary Email','Benificiary Mobile','Amount','Date');
						$data['TBODY'] = 0;

					}elseif ($INPUT_POST['selEcashPayout'] == 4) {

						$data['field'] = array('RefNo','Tracking No','Receipt No','Currency','Amount','Charge','Beneficiary Name','Beneficiary Mobile','ID Type','ID No','Payout Amount','Date/Time');
						$data['TBODY'] = 1;

					}elseif ($INPUT_POST['selEcashPayout'] == 7) {

						$data['field'] = array('Tracking Number','Regcode','Sender Name','Sender Mobile No.','Beneficiary Name','Beneficiary Mobile No.','Amount','Date/Time');
						$data['TBODY'] = 7;	
						
					}elseif ($INPUT_POST['selEcashPayout'] == 8) {

						$data['field'] = array('Tracking No','Regcode','Reference No','Sender','Beneficiary','Amount','Charge','Date/Time');
						$data['TBODY'] = 8;	
						
					}elseif ($INPUT_POST['selEcashPayout'] == 5 || $INPUT_POST['selEcashPayout'] == 6) {

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
		$data = array('menu' => 14,
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

	function loading()
	{
		$data = array('menu' => 14, 'parent' => '' );

		if ($this->user['S'] == 1 && $this->user['R'] != "")
		{
			$data['user'] = $this->user;

			$testaccount = substr($data['user']['R'], 0, 2);

			if ($testaccount == 'UF')
			{
				$data['retailer'] = 1;
			}
			
			if (isset($_POST['btnSearch'])) 
			{
				$INPUT_POST = $this->input->post(null, true);

				if ($INPUT_POST['selLoad'] == 1) //CARD
				{ 
					$data['field'] = array('Trans #','Mobile #','Regcode','Plancode','Card Details','Date');
					$url = _view_cards;
					$data['TBODY'] = 1;
				}
				elseif ($INPUT_POST['selLoad'] == 2) //UNIVERSAL
				{ 
					$data['field'] = array(
						"TRACKING", 
						"REGCODE", 
						"MOBILE", 
						"TRANSACTION TYPE,", 
						"STATUS", 
						"TRANS NO",
						"AMOUNT",
						"DEBIT", 
						"PROFIT",
						"CREDIT",
						"BALANCE",
						"DATE"
					);

					$url = _universal;
					$data['TBODY'] = 2;
				}
				elseif ($INPUT_POST['selLoad'] == 3) //CURRENT TRANSACTION
				{ 
					$data['field'] = array(
						"TRACKING",
						"REGCODE", 
						"MOBILE NO",
						"TRANSACTION TYPE", 
						"STATUS",
						"TRANS NO", 
						"REFERENCE NO",
						"AMOUNT", 
						"PLANCODE",
						"RETAIL",
						"DEBIT",
						"PROFIT",
						"CREDIT",
						"BALANCE",
						"POSTING DATE/PROCESS TIME"
					);

					$url = _airtime_transaction_current;
					$data['TBODY'] = 3;	
				}
				elseif ($INPUT_POST['selLoad'] == 4)
				{
					$data['field'] = array(
						"TRACKING",
						"REGCODE", 
						"MOBILE NO",
						"TRANSACTION TYPE", 
						"STATUS", 
						"TRANS NO", 
						"REFERENCE NO",
						"AMOUNT", 
						"PLANCODE",
						"RETAIL",
						"DEBIT",
						"PROFIT",
						"CREDIT",
						"BALANCE",
						"POSTING DATE/PROCESS TIME",
					);

					$url = _airtime_transaction_old;
					$data['TBODY'] = 4;	
				}
				elseif ($INPUT_POST['selLoad'] == 5) // CURRENT AIRTIME REPORT
				{ 
					$data['field'] = array(
						"TRANS NO", 
						"REGCODE",
						"PLANCODE",
						"MOBILE",
						"TRANS TYPE",
						"TELCO",
						"REFERENCE NO",
						"STATUS",
						"POSTING TIME", 
						"PROCESS TIME"
					);

					$url = _airtime_current;
					$data['TBODY'] = 5;	
				} 
				elseif ($INPUT_POST['selLoad'] == 6) // CURRENT AIRTIME REPORT
				{ 
					$data['field'] = array(
						"TRANS NO", 
						"REGCODE",
						"PLANCODE",
						"MOBILE",
						"TRANS TYPE",
						"TELCO",
						"REFERENCE NO",
						"STATUS",
						"POSTING TIME", 
						"PROCESS TIME"
					);

					$url = _airtime_old;
					$data['TBODY'] = 6;	
				}
				elseif ($INPUT_POST['selLoad'] == 7) // CURRENT ETISALAT REPORT
				{ 
					$data['field'] = array(
						"TRACK NO", 
						"REGCODE",
						"PLANCODE",
						"MOBILE",
						"TRANS TYPE",
						"TELCO",
						"REFERENCE NO",
						"STATUS",
						"POSTING TIME", 
						"PROCESS TIME"
					);

					$url = 'ups_report_service/AED_genreport';
					$data['TBODY'] = 7;
				}
				elseif ($INPUT_POST['selLoad'] == 8) // CURRENT UAE PAYTHEM REPORT
				{ 
					$data['field'] = array(
						"AR Receipt", 
						"Cust E-Voucher", 
						"TRACK NO", 
						"REGCODE",
						"PLANCODE",
						"MOBILE",
						"TRANS TYPE",
						"TELCO",
						"REFERENCE NO",
						"STATUS",
						"POSTING TIME", 
						"PROCESS TIME"
					);

					$url = 'ups_report_service/paythem_genreport';
					$data['TBODY'] = 8;
				}
				elseif ($INPUT_POST['selLoad'] == 9) // CURRENT QATAR PAYTHEM REPORT
				{ 
					$data['field'] = array(
						"AR Receipt", 
						"Cust E-Voucher", 
						"TRACK NO", 
						"REGCODE",
						"PLANCODE",
						"MOBILE",
						"TRANS TYPE",
						"TELCO",
						"REFERENCE NO",
						"STATUS",
						"POSTING TIME", 
						"PROCESS TIME"
					);

					$url = 'ups_report_service/paythemQATAR_genreport';
					$data['TBODY'] = 9;
				}
				elseif ($INPUT_POST['selLoad'] == 10) // CURRENT SGD PAYTHEM REPORT
				{ 
					$data['field'] = array(
						"TRACK NO", 
						"REGCODE",
						"PLANCODE",
						"MOBILE",
						"TRANS TYPE",
						"TELCO",
						"REFERENCE NO",
						"STATUS",
						"POSTING TIME", 
						"PROCESS TIME"
					);

					$url = 'ups_report_service/SGD_genreport';
					$data['TBODY'] = 10;
				}
				elseif ($INPUT_POST['selLoad'] == 11) // CURRENT SGD PAYTHEM REPORT
				{ 
					$data['field'] = array(
						"AR Receipt", 
						"TRACK NO",
						"REGCODE",
						"PLANCODE",
						"MOBILE",
						"TRANS TYPE",
						"TELCO",
						"REFERENCE NO",
						"STATUS",
						"POSTING TIME", 
						"PROCESS TIME"
					);

					$url = 'ups_report_service/HKD_genreport';
					$data['TBODY'] = 11;	
				}
				else if ($INPUT_POST['selLoad'] == 12)
				{
					$data['field'] = array(
						"DATE & TIME", 
						"TYPE",
						"TRACK NO",
						"REFERENCE NO",
						"REGCODE",
						"OPERATOR",
						"PLANCODE",
						"LOAD AMOUNT",
						"CONVERTED AMOUNT",
						"WALLET CURRENCY",
						"DEBITED AMOUNT",
						"STATUS",
						"MOBILE"
					);

					$url = 'ups_report_service/buyload_report';
					$data['TBODY'] = 12;	
				}
				else
				{
					$url = "";
				}

				if ($url == "") 
				{
					$data['process'] = array ('P' => 1, 'S' => 0, 'M' => "No URL found!");
				}
				else 
				{
					$arr = array(
						'field' => $data['field'],
						'url' => $url,
						'TBODY' => $data['TBODY'],
						'startdate' => $INPUT_POST['inputStart'],
						'enddate' => $INPUT_POST['inputEnds']
					);

					$this->session->set_userdata('arr', $arr);

					$parameter = array(
						'dev_id' => $this->global_f->dev_id(),
						'actionId' => $url, 
						'ip_address' => $this->ip, 
						'regcode' => $this->user['R'],
						'startdate' => $INPUT_POST['inputStart'],
						'enddate' => $INPUT_POST['inputEnds']
					);

					$result = $this->curl->call($parameter, url);

					$API = json_decode($result, true);

					$data['API'] = $API;
						
					if ($API['S'] === 0) 
					{
						$data['process'] = array ('P' => 1, 'S' => 0, 'M'=> $API['M']);
					}
					else 
					{
						$data['process'] = array ('P' => 1, 'S' => 1, 'M' => $API['M']);
					}

					$date = array('startdate' => date('Y-m-d', strtotime($INPUT_POST['inputStart'])), 'enddate' => date('Y-m-d',strtotime($INPUT_POST['inputEnds'])));

					$this->session->set_userdata('inputdate', $date);
		    	}
				
			}
		
			$this->load->view('layout/header', $data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('report/loading'); 
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');	
		}
		else
		{
			$this->session->sess_destroy();
			redirect('Login/');
		}	
	}

	function ticketing()
	{
		$data = array('menu' => 14,
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
		$data = array('menu' => 14,
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

	function einsurance_report()
	{
		$data = array('menu' => 14,
					 'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;

				$data['user'] = $this->user;
				$result = null;

				// if ($this->input->post('selEinsurance') == 1) {
				
				// 	$parameter =array(
				// 			'dev_id'     		=> $this->global_f->dev_id(),
				// 			'actionId'          => _malayan_report, 
				// 			'ip_address'		=> $this->ip, 
		    	// 			'regcode'           => $this->user['R']
				// 	    	); 
 				// 	$result = $this->curl->call($parameter,url);
				// }elseif($this->input->post('selEinsurance') == 2){

				// 	$parameter =array(
				// 			'dev_id'     		=> $this->global_f->dev_id(),
				// 			'actionId'          => 'ups_report_service/federal_report', 
				// 			'ip_address'		=> $this->ip, 
		    	// 			'regcode'           => $this->user['R']
				// 	    	); 
				// 	 $result = $this->curl->call($parameter,url);
				// }

				// $data['selected'] = $this->input->post('selEinsurance');
			   
			   	// $API = json_decode($result,true);

				// if ($API['S'] === 0) {
				// 		$data['process'] = array ('P'=>1,
				// 							  'S'=>0,
				// 							  'M'=>$API['M']);	
				// }else {
				// 		$data['process'] = array ('P'=>1,
				// 							  'S'=>1,
				// 							  'M'=>$API['M']);
				// }
				// 	$data['API'] = $API;

			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('report/einsurance_report'); 
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');	

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}

	function ajax_malayan_report()
	{
		$page = $this->input->post('page');
		$limit = $this->input->post('limit');
		$offset = ($page - 1) * $limit;

		$parameter =array(
			'dev_id'     		=> $this->global_f->dev_id(),
			'actionId'          => 'ups_report_service/mlyn_report', 
			'ip_address'		=> $this->ip, 
			'regcode'           => $this->user['R'],
			'offset'           => $offset,
			'limit'           => $limit
			);

		$result = $this->curl->call($parameter,url);

		$API = json_decode($result,true);
		$data['API'] = $API;
		$data["offset"] = $offset;

		$num_rows = $API['COUNT'];
		$lastpage = ceil($num_rows / $limit);

		$json_array = array(
			'table'			=> $this->load->view('report/insurance/malayan_report_table', $data, true),
			'currentpage' 	=> $page,
			'lastpage' 		=> $lastpage,
			'rowcount'		=> $num_rows
		);
		echo json_encode($json_array);
	}

	function ajax_fpg_report()
	{
		$page = $this->input->post('page');
		$limit = $this->input->post('limit');
		$offset = ($page - 1) * $limit;

		$parameter =array(
			'dev_id'     		=> $this->global_f->dev_id(),
			// 'actionId'          => 'ups_report_service/federal_report', 
			'actionId'          => 'ups_report_service/fpg_report', 
			'ip_address'		=> $this->ip, 
			'regcode'           => $this->user['R'],
			'offset'           => $offset,
			'limit'           => $limit
		);

		$result = $this->curl->call($parameter,url);

		$parameter2 =array(
			'dev_id'     		=> $this->global_f->dev_id(),
			'actionId'          => 'ups_report_service/federal_report', 
			'ip_address'		=> $this->ip, 
			'regcode'           => $this->user['R']
			); 
	 	$result2 = $this->curl->call($parameter2,url);

		$API = json_decode($result,true);
		$API2 = json_decode($result2,true);
		$data['API'] = $API;
		$data['API2'] = $API2;
		$data["offset"] = $offset;

		$num_rows = $API['COUNT'];
		$lastpage = ceil($num_rows / $limit);

		$json_array = array(
			'table'			=> $this->load->view('report/insurance/fpg_report_table', $data, true),
			'currentpage' 	=> $page,
			'lastpage' 		=> $lastpage,
			'rowcount'		=> $num_rows
		);
		echo json_encode($json_array);
	}


	function ctpl_report()
	{
		$data = array('menu' => 14,
					 'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;

				$data['user'] = $this->user;
				$result = null;

				if ($this->input->post('selEinsurance') == 1) {
				
					$parameter =array(
							'dev_id'     		=> $this->global_f->dev_id(),
							'actionId'          => _cptl_report, 
							'ip_address'		=> $this->ip, 
		    				'regcode'           => $this->user['R'],
		    				$this->user['SKT']  =>md5($this->user['R'].$this->user['SKT'])
					    	); 
 					$result = $this->curl->call($parameter,url);
				}
				$data['selected'] = $this->input->post('selEinsurance');
			   
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
			$this->load->view('report/ctpl_report'); 
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');	

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}

	function federal_insurance_report()
	{
		$data = array('menu' => 14,
					 'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;

				$data['user'] = $this->user;

				$parameter =array(
							'dev_id'     		=> $this->global_f->dev_id(),
							'actionId'          => 'ups_report_service/federal_report', 
							'ip_address'		=> $this->ip, 
		    				'regcode'           => $this->user['R']
					    	); 

			    $result = $this->curl->call($parameter,url);
			   	$API = json_decode($result,true);
			   //echo $API['URL'];die;
			   	//var_dump($API);die;
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
			$this->load->view('report/federal_insurance_report'); 
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');	

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}

	function aed_fund(){
		$data = array('menu' => 14,
				'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;

			if (isset($_POST['btnSearch'])) {
					$INPUT_POST = $this->input->post(null,true);
					$data['field'] = array('Control #','Mobile #','Plancode','Transtype','Ref #', 'Tracking #', 'Amount', 'Forex', 'Retail', 'Debit', 'Profit', 'Credit', 'Balance', 'Date');
//					$url = _aed_fund_reports;
					$url = 'ups_report_service/aed_fund_reports';
					$data['TBODY'] = 1;

				if ($url == "") {
					$data['process'] = array ('P'=>1,
							'S'=>0,
							'M'=>"No URL found!");
				}else {
					$arr = array('field'  =>$data['field'],
							'url'  		  =>$url,
							'TBODY' 	  =>$data['TBODY'],
							'startdate'	  => $INPUT_POST['inputStart'],
							'enddate'	  => $INPUT_POST['inputEnds']);
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
							'enddate'=>date('Y-m-d',strtotime($INPUT_POST['inputEnds'])));
//					print_r($date);
					$this->session->set_userdata('inputdate',$date);
				}

			}

			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('report/aed_fund');
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}


	function qatar_fund(){
		$data = array('menu' => 14,
				'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;

			if (isset($_POST['btnSearch'])) {
					$INPUT_POST = $this->input->post(null,true);
					$data['field'] = array('Control #','Mobile #','Plancode','Transtype','Ref #', 'Tracking #', 'Amount', 'Forex', 'Retail', 'Debit', 'Profit', 'Credit', 'Balance', 'Date');

					$url = 'ups_report_service/qatar_fund_reports';
					$data['TBODY'] = 1;

				if ($url == "") {
					$data['process'] = array ('P'=>1,
							'S'=>0,
							'M'=>"No URL found!");
				}else {
					$arr = array('field'  =>$data['field'],
							'url'  		  =>$url,
							'TBODY' 	  =>$data['TBODY'],
							'startdate'	  => $INPUT_POST['inputStart'],
							'enddate'	  => $INPUT_POST['inputEnds']);
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
							'enddate'=>date('Y-m-d',strtotime($INPUT_POST['inputEnds'])));
//					print_r($date);
					$this->session->set_userdata('inputdate',$date);
				}

			}

			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('report/qatar_fund');
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}


	function hkd_fund(){
		$data = array('menu' => 14,
				'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;

			if (isset($_POST['btnSearch'])) {
					$INPUT_POST = $this->input->post(null,true);
					$data['field'] = array('Control #','Designation','Plancode','Transtype','Ref #', 'Tracking #', 'Amount', 'Forex', 'Retail', 'Debit', 'Profit', 'Credit', 'Balance', 'Date');

					$url = 'ups_report_service/hkd_fund_reports';
					$data['TBODY'] = 1;

				if ($url == "") {
					$data['process'] = array ('P'=>1,
							'S'=>0,
							'M'=>"No URL found!");
				}else {
					$arr = array('field'  =>$data['field'],
							'url'  		  =>$url,
							'TBODY' 	  =>$data['TBODY'],
							'startdate'	  => $INPUT_POST['inputStart'],
							'enddate'	  => $INPUT_POST['inputEnds']);
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
							'enddate'=>date('Y-m-d',strtotime($INPUT_POST['inputEnds'])));

					$this->session->set_userdata('inputdate',$date);
				}

			}

			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('report/hkd_fund');
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}

	function metroturf(){
		$data = array('menu' => 14,
				'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;

			if (isset($_POST['btnSearch'])) {
					$INPUT_POST = $this->input->post(null,true);
					$data['field'] = array('Tracking #','Account #','Account Name','Amount','Transaction Date', 'Approved By', 'Approved Date');

					$url = 'ups_report_service/metroturf_report';
					$data['TBODY'] = 1;

				if ($url == "") {
					$data['process'] = array ('P'=>1,
							'S'=>0,
							'M'=>"No URL found!");
				}else {
					$arr = array('field'  =>$data['field'],
							'url'  		  =>$url,
							'TBODY' 	  =>$data['TBODY'],
							'startdate'	  => $INPUT_POST['inputStart'],
							'enddate'	  => $INPUT_POST['inputEnds']);
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
							'enddate'=>date('Y-m-d',strtotime($INPUT_POST['inputEnds'])));

					$this->session->set_userdata('inputdate',$date);
				}

			}

			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('report/metroturf');
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}

	function sgd_fund(){
		$data = array('menu' => 14,
				'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;

			if (isset($_POST['btnSearch'])) {
					$INPUT_POST = $this->input->post(null,true);
					$data['field'] = array('Control #','Designation','Plancode','Transtype','Ref #', 'Tracking #', 'Amount', 'Forex', 'Retail', 'Debit', 'Profit', 'Credit', 'Balance', 'Date');

					$url = 'ups_report_service/sgd_fund_reports';
					$data['TBODY'] = 1;

				if ($url == "") {
					$data['process'] = array ('P'=>1,
							'S'=>0,
							'M'=>"No URL found!");
				}else {
					$arr = array('field'  =>$data['field'],
							'url'  		  =>$url,
							'TBODY' 	  =>$data['TBODY'],
							'startdate'	  => $INPUT_POST['inputStart'],
							'enddate'	  => $INPUT_POST['inputEnds']);
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
							'enddate'=>date('Y-m-d',strtotime($INPUT_POST['inputEnds'])));

					$this->session->set_userdata('inputdate',$date);
				}

			}

			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('report/sgd_fund');
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}
	
	function mcwd(){
		$data = array('menu' => 14,
				'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;

			if (isset($_POST['btnSearch'])) {
					$INPUT_POST = $this->input->post(null,true);
					$data['field'] = array('Tracking #','Reference #','Account #','Account Name','Amount','Transaction Date', 'Remarks', 'Processed By', 'Processed Date');

					$url = 'ups_report_service/mcwd_report';
					$data['TBODY'] = 1;

				if ($url == "") {
					$data['process'] = array ('P'=>1,
							'S'=>0,
							'M'=>"No URL found!");
				}else {
					$arr = array('field'  =>$data['field'],
							'url'  		  =>$url,
							'TBODY' 	  =>$data['TBODY'],
							'startdate'	  => $INPUT_POST['inputStart'],
							'enddate'	  => $INPUT_POST['inputEnds']);
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
							'enddate'=>date('Y-m-d',strtotime($INPUT_POST['inputEnds'])));

					$this->session->set_userdata('inputdate',$date);
				}

			}

			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('report/mcwd');
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}


	function forexecash_transfer(){
		$data = array('menu' => 14,
				'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;

			if (isset($_POST['btnSearch'])) {
					$INPUT_POST = $this->input->post(null,true);
					$data['field'] = array('Control #','TrackingNo','TxnType','Transtype','DestinationAcct','TransferAmt','ForExRate', 'ConvertedAmt', 'SystemFee', 'RemittanceFee', 'TotalAmt', 'Balance', 'TxnDate');

					$url = 'ups_report_service/forexecash_transfer_reports';
					$data['TBODY'] = 1;

				if ($url == "") {
					$data['process'] = array ('P'=>1,
							'S'=>0,
							'M'=>"No URL found!");
				}else {
					$arr = array('field'  =>$data['field'],
							'url'  		  =>$url,
							'TBODY' 	  =>$data['TBODY'],
							'startdate'	  => $INPUT_POST['inputStart'],
							'enddate'	  => $INPUT_POST['inputEnds']);
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
							'enddate'=>date('Y-m-d',strtotime($INPUT_POST['inputEnds'])));

					$this->session->set_userdata('inputdate',$date);
				}

			}

			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('report/forexecash_transfer');
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}

		function hotel(){
		$data = array('menu' => 14,
				'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;

			if (isset($_POST['btnSearch'])) {
					$INPUT_POST = $this->input->post(null,true);
					$data['field'] = array('Control #','TrackingNo','TxnType','Transtype','DestinationAcct','TransferAmt','ForExRate', 'ConvertedAmt', 'SystemFee', 'RemittanceFee', 'TotalAmt', 'Balance', 'TxnDate');

					$url = 'ups_report_service/forexecash_transfer_reports';
					$data['TBODY'] = 1;

				if ($url == "") {
					$data['process'] = array ('P'=>1,
							'S'=>0,
							'M'=>"No URL found!");
				}else {
					$arr = array('field'  =>$data['field'],
							'url'  		  =>$url,
							'TBODY' 	  =>$data['TBODY'],
							'startdate'	  => $INPUT_POST['inputStart'],
							'enddate'	  => $INPUT_POST['inputEnds']);
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


					// $urls = "http://10.10.1.127:8000/graphql";
        
			  //       // $parameters = [
			  //       //     "query" => $query,
			  //       //     "variables" => $variables,
			  //       //     "operationName" => $operationName
			  //       // ];

			  //       $results = $this->curl->call_custom("", $urls, "POST");

					$search = $this->input->get('args');
			        $query = "query Destinations { destinations(options: {where: {destination: \"" . $search . "\"},},limit: 5, offset: 0, order: [[ name, asc ]]){ rows{id, name, country{ id, name } }}, zones(limit: 5, offset: 0, order: [[name, asc]], options: { where: { name: \"" . $search . "\"}, },){rows{zoneCode, name, destination{id, name}}}, hotels(limit: 5, offset: 0, order: [[ name, asc]], options: {where: { name: \"" . $search . "\", isDatabase: true, }, }, ){ rows{ id, name destinationId }}}";

			        $results = $this->getgraphQLAPI($query, null, "Destinations");

					echo "<pre>";
					var_dump($results);
					echo "</pre>";

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
							'enddate'=>date('Y-m-d',strtotime($INPUT_POST['inputEnds'])));

					$this->session->set_userdata('inputdate',$date);
				}

			}

			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('report/hotel');
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}

	function getgraphQLAPI($query, $variables, $operationName)
    {
       $url = "http://10.10.1.119:8000/graphql";
       // $url = "http://10.10.1.127:8000/graphql";
        
        $parameters = [
            "query" => $query,
            "variables" => $variables,
            "operationName" => $operationName
        ];

        $results = $this->curl->call_custom($parameters, $url, "POST");
    
        return $results; 
    }

	function hotel_booking()
	{
			

		if ($this->user['S'] == 1 && $this->user['R'] !="") {
			// echo "<pre>";
			$search = $this->input->post();
			// var_dump($search);
			$url = "http://35.200.241.130/graphql";
			$parameters['variables'] = null;
			$parameters['operationName'] = "FindAllHotelReservations";
			$query = "query FindAllHotelReservations {  hotelReservations( action: COUNT options:{ limit:20, offset: 0, where:{";

			if (!isset($search['btnSearch'])) { 
	
				$query .= " regcode:\"". $this->user['R'] ."\" ";

			} 

			else {
				

		        if (trim($this->input->post("txtTrackingNumber")) != null) {
		            $query .= " trackingNumber: \"".$this->input->post("txtTrackingNumber")."\" ";
		        } 
		        
		        if (trim($this->input->post("inputStart")) != null) {
		            $query .= " startDate:\"".$this->input->post("inputStart")."\"";
		        }

		        if (trim($this->input->post("inputEnd")) != null) {
		            $query .= " endDate:\"".$this->input->post("inputEnd")."\"";
		        }

		  //       $INPUT_POST = $this->input->post(null,true);

				// $data = array('startdate'=>$INPUT_POST['inputStart'],
			 //   			'enddate'=>$INPUT_POST['inputEnd'],
			 //   			'transnumber'=>$INPUT_POST['txtTrackingNumber']
			 //   			);
			 //   		$this->session->set_userdata('inputdata',$data);

				$information['searchData'] = $search;
			}

			$data['user'] = $this->user;
			
			$query .= " } } ) { rows { 
                id, checkIn, checkOut, regcode, trackingNumber, referenceNumber, totalAmount, markup, room, adult, child, createdAt, status,
                customer { 
                    firstName, lastName, emailAddress, mobileNumber } 
                hotel { id, name } 
                guests {
                    id, firstName, lastName, birthdate }
            }  count  }}";

            

			$parameters['query'] = $query;
			$results = json_decode($this->curl->call_custom($parameters, $url, "POST"), true);
			// print_r($parameters);

			// echo "<pre>";
			// print_r($results);
			// echo "</pre>";

			// exit();



			if (isset($search['hdnToPrint'])) {
				$this->generateHotelReport($results);
			} else {

				$information['results'] = $results['data']['hotelReservations']['rows'];


				// print_r($information);

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('report/hotel/hotel_report', $information);
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');
			}
			// echo "</pre>";
		} 


		else {
			$this->session->sess_destroy();
			redirect('Login/');
		}
		
	}

	function hotel_reports()
	{
		if ($this->user['S'] == 1 && $this->user['R'] !="") {
			// echo "<pre>";
			$search = $this->input->post();
			// var_dump($search);
			$url = "http://35.200.241.130/graphql";
			$parameters['variables'] = null;
			$parameters['operationName'] = "FindAllHotelReservations";
			$query = "query FindAllHotelReservations {  hotelReservations( action: COUNT options:{ limit:20, offset: 0, where:{";

			if (!isset($search['btnSearch'])) { 
	
				$query .= " regcode:\"". $this->user['R'] ."\" ";

			} else {

		        // if (trim($this->input->post("txtTrackingNumber")) != null) {
		        //     $query .= " trackingNumber: \"".$this->input->post("txtTrackingNumber")."\" ";
		        // } 
		        
		        if (trim($this->input->post("inputStart")) != null) {
		            $query .= "startDate:\"".$this->input->post("inputStart")."\"";
		        }

		        if (trim($this->input->post("inputEnd")) != null) {
		            $query .= " endDate:\"".$this->input->post("inputEnd")."\"";
		        }

				$information['searchData'] = $search;
			}

			$data['user'] = $this->user;
			
			$query .= " } } ) { rows { 
                id, checkIn, checkOut, regcode, trackingNumber, referenceNumber, totalAmount, markup, room, adult, child, createdAt, status, balanceBefore, balanceAfter,
                customer { 
                    firstName, lastName, emailAddress, mobileNumber } 
                hotel { id, name } 
                guests {
                    id, firstName, lastName, birthdate }
            }  count  }}";

			$parameters['query'] = $query;
			$results = json_decode($this->curl->call_custom($parameters, $url, "POST"), true);
			// print_r($parameters);
			// print_r($results);
			// exit();

			if (isset($search['hdnToPrint'])) {
				$this->generateHotelReport($results);
			} else {

				$information['results'] = $results['data']['hotelReservations']['rows'];

				// print_r($information);

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('report/hotel/hotel_reports', $information);
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');
			}
			// echo "</pre>";
		} else {
			$this->session->sess_destroy();
			redirect('Login/');
		}
		
	}

	function generateHotelReport($results)
	{
		$this->load->library('excel');
				//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
				//name the worksheet
		$this->excel->getActiveSheet()->setTitle('GENERAL REPORT');
				//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Reference Number');
		$this->excel->getActiveSheet()->setCellValue('B1', 'Tracking Number');
		$this->excel->getActiveSheet()->setCellValue('C1', 'Total Amount');
		$this->excel->getActiveSheet()->setCellValue('D1', 'Mark Up');
		$this->excel->getActiveSheet()->setCellValue('E1', 'Room(s)');
		$this->excel->getActiveSheet()->setCellValue('F1', 'Adult');
		$this->excel->getActiveSheet()->setCellValue('G1', 'Child');
		$this->excel->getActiveSheet()->setCellValue('H1', 'Customer Name');
		$this->excel->getActiveSheet()->setCellValue('I1', 'Hotel Name');

				//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);

		$count = 2;
		foreach ($results as $result ){
			$this->excel->getActiveSheet()->setCellValue('A'.$count, $result['trackingNumber']);
			$this->excel->getActiveSheet()->setCellValue('B'.$count, $result['referenceNumber']);
			$this->excel->getActiveSheet()->setCellValue('C'.$count, number_format($result['totalAmount'], 2));
			$this->excel->getActiveSheet()->setCellValue('D'.$count, $result['markup']);
			$this->excel->getActiveSheet()->setCellValue('E'.$count, $result['room']);
			$this->excel->getActiveSheet()->setCellValue('F'.$count, $result['adult']);
			$this->excel->getActiveSheet()->setCellValue('G'.$count, $$result['child']);
			$this->excel->getActiveSheet()->setCellValue('H'.$count, $result['customer']['firstName'] . " " . $result['customer']['lastName']);
			$this->excel->getActiveSheet()->setCellValue('I'.$count, $result['hotel']['name']); 	
			$count++;                                             
		}
				//CALL API
				$filename='hotel_voucher_report'.date('ymd').'.xls'; //save our workbook as this file name
				header('Content-Type: application/vnd.ms-excel'); //mime type
				header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
				header('Cache-Control: max-age=0'); //no cache

				//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
				//if you want to save it as .XLSX Excel 2007 format
				$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
				//force user to download the Excel file without writing it to server's HD
				$objWriter->save('php://output');
	}


	function myr_fund(){
		$data = array('menu' => 14,
				'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;

			if (isset($_POST['btnSearch'])) {
					$INPUT_POST = $this->input->post(null,true);
					$data['field'] = array('Control #','Designation','Plancode','Transtype','Ref #', 'Tracking #', 'Amount', 'Forex', 'Retail', 'Debit', 'Profit', 'Credit', 'Balance', 'Date');

					$url = 'ups_report_service/myr_fund_reports';
					$data['TBODY'] = 1;

				if ($url == "") {
					$data['process'] = array ('P'=>1,
							'S'=>0,
							'M'=>"No URL found!");
				}else {
					$arr = array('field'  =>$data['field'],
							'url'  		  =>$url,
							'TBODY' 	  =>$data['TBODY'],
							'startdate'	  => $INPUT_POST['inputStart'],
							'enddate'	  => $INPUT_POST['inputEnds']);
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
							'enddate'=>date('Y-m-d',strtotime($INPUT_POST['inputEnds'])));

					$this->session->set_userdata('inputdate',$date);
				}

			}

			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('report/myr_fund');
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}

	
	function unified() { 
		if ($this->user['A_CTRL']['billspayment'] == 1) { 
			$data = array('menu' => 4,
								 'parent'=>''); 
					if ($this->user['S'] == 1 && $this->user['R'] !=""){ 
							$data['user'] = $this->user;
							$url = url; 
									$parameter = array(
															'dev_id'                      => $this->global_f->dev_id(),
															'actionId'                           => 'ups_billspay_service/fetchdataforUnified',
															'ip_address'        => $this->ip, 
													'regcode'                          => $this->user['R'],
															$this->user['SKT']         => md5($this->user['R'].$this->user['SKT'].md5($TPASS))
															);
				
									$result = $this->curl->call($parameter,$url);
									$data['API'] = json_decode($result,true);
								
							$this->load->view('layout/header',$data);
							$this->load->view('element/top_header');
							$this->load->view('element/wrapper_header');
							$this->load->view('element/left_panel');
							$this->load->view('report/unified'); 
							$this->load->view('element/wrapper_footer');
							$this->load->view('layout/footer');
					}else {
							//$this->session->unset_userdata('user');
							$this->session->sess_destroy();
							redirect('Login/');
					}
			}else {
					//$this->session->unset_userdata('user');
					//$this->session->sess_destroy();
					redirect('Main/');
			}
	}


	
	//added by rene
	function gocabv1() {
		if ($this->user['A_CTRL']['billspayment'] == 1) { 
			$data = array('menu' => 4,
			'parent'=>''); 
			if ($this->user['S'] == 1 && $this->user['R'] !="") { 
				$data['user'] = $this->user;
				$url = url; 
				$parameter = array(
				'dev_id'                      => $this->global_f->dev_id(),
				'actionId'                           => 'ups_billspay_service/fetchdataforGoCab',
				'ip_address'        => $this->ip, 
				'regcode'                          => $this->user['R'],
				$this->user['SKT']         => md5($this->user['R'].$this->user['SKT'].md5($TPASS))
				); 
				$result = $this->curl->call($parameter,$url);
				$data['API'] = json_decode($result,true);  
				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('report/gocab'); 
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');
			} else { 
				$this->session->sess_destroy();
				redirect('Login/');
			}
		} else { 
			redirect('Main/');
		}
	}  
}