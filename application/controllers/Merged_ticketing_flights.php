<?php
defined('BASEPATH') OR exit('No direct script access allowed');
set_time_limit(0);
class Merged_ticketing_flights extends CI_Controller {

   	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Manila');
		$this->load->model('Curl_model','curl');
		// $this->load->model('Domestic_ticketing_model');
		// $this->load->model('Abacus_ticketing_model');
		$this->load->library('session');
		$this->user = $this->session->userdata('user');
		
	    if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)){
            $IP = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
			$IP = $IP[0];
	   }else{
			$IP = $_SERVER['REMOTE_ADDR'];
		}
		
	    $this->ip = $IP;
	    $this->load->model('Query_model');
	  	$this->load->model('Global_function','global_f');
	  	$this->load->model('Encryption_model');
	  	$this->load->model('Sp_model');
/*	  	$ACC_CONTROL = $this->Sp_model->userprivilege(); 
 	   	$this->user['A_CTRL'] = $ACC_CONTROL['A_CTRL'];
 	   	$this->session->set_userdata('user',$this->user);*/

 	   	if ($this->user['RET'] == 1) {
	    	redirect('Main/');
	    }
	}

	public function index()
	{


		$data = array('menu' => 'dom',
					 'parent'=>'ABACUS' );
		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;
			$this->load->view('merged_flights/index',$data);
		}else {
			$this->session->sess_destroy();
			redirect('Login/');
		}

	}


	public function search_flights()
	{

		$data = array('menu' => 'dom',
				'parent' => 'ABACUS');

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
		// if ($this->user['S'] == 1 && ( ($this->user['R'] == "1234567") || ($this->user['R'] == "RM852123") || ($this->user['R'] == "1234504") || ($this->user['R'] == "F5880126") )) {
			$data['user'] = $this->user;

			//SEARCH RESULTS
			if(isset($_POST['btn_search'])){
				$this->searchResults($data);
			//CHOOSE FLIGHTS
			}else if (isset($_POST['btn_chooseflight'])) {
				$this->enterPassengerDetails($data);
			}else if(isset($_POST['btn_submitpassengerdetails'])){
				$this->summaryPage($data);
			//SEARCH INDEX
			}else if(isset($_POST['btn_proceed'])) {
				$this->finalPage($data);

			}else if(isset($_POST['btn_proceed_cc'])) {
				$this->finalPageCC($data);

			}else{
				//$tempip = '146.88.66.254';//'211.220.194.17';//'66.249.69.245';//
				//$location = json_decode($this->curl->call(null,'http://ip-api.com/json/'.$tempip),true);
				//LOAD AIRPORTS, AIRLINES DATA
				//$airports = json_decode($this->curl->call(null,url_mobilereports.'/abacus_getairportfrom/'.'PH'/*$location['countryCode']*/),true);
				// $airports = json_decode('{"S":1,"M":"Successfuly fetched (42) records","T_DATA":[{"airportname":"Bacolod","airportcode":"BCD"},{"airportname":"Baguio","airportcode":"BAG"},{"airportname":"Basco","airportcode":"BSO"},{"airportname":"Busuanga","airportcode":"USU"},{"airportname":"Butuan","airportcode":"BXU"},{"airportname":"Cagayan De Oro","airportcode":"CGY"},{"airportname":"Camiguin (Mambajao)","airportcode":"CGM"},{"airportname":"Caticlan Malay","airportcode":"MPH"},{"airportname":"Cauayan","airportcode":"CYZ"},{"airportname":"Clark, Pampanga","airportcode":"CRK"},{"airportname":"Cebu","airportcode":"CEB"},{"airportname":"Coron","airportcode":"USU"},{"airportname":"Cotabato","airportcode":"CBO"},{"airportname":"Cuyo","airportcode":"CYU"},{"airportname":"Davao","airportcode":"DVO"},{"airportname":"Dipolog","airportcode":"DPL"},{"airportname":"Dumaguete","airportcode":"DGT"},{"airportname":"El Nido","airportcode":"ENI"},{"airportname":"General Santos","airportcode":"GES"},{"airportname":"Iloilo","airportcode":"ILO"},{"airportname":"Kalibo","airportcode":"KLO"},{"airportname":"Laoag","airportcode":"LAO"},{"airportname":"Legaspi","airportcode":"LGP"},{"airportname":"Manila","airportcode":"MNL"},{"airportname":"Marinduque","airportcode":"MRQ"},{"airportname":"Masbate","airportcode":"MBT"},{"airportname":"Naga","airportcode":"WNP"},{"airportname":"Ormoc","airportcode":"OMC"},{"airportname":"Ozamis","airportcode":"OZC"},{"airportname":"Pagadian","airportcode":"PAG"},{"airportname":"Puerto Princesa","airportcode":"PPS"},{"airportname":"Roxas City","airportcode":"RXS"},{"airportname":"Samar, Calbayog","airportcode":"CYP"},{"airportname":"Samar, Catarman","airportcode":"CRM"},{"airportname":"San Jose Mcguire Fd","airportcode":"SJI"},{"airportname":"Surigao","airportcode":"SUG"},{"airportname":"Tablas","airportcode":"TBH"},{"airportname":"Tacloban","airportcode":"TAC"},{"airportname":"Tagbilaran","airportcode":"TAG"},{"airportname":"Tuguegarao","airportcode":"TUG"},{"airportname":"Virac","airportcode":"VRC"},{"airportname":"Zamboanga","airportcode":"ZAM"}]}',true);
				// //$airlines = json_decode($this->curl->call(null,url_mobilereports.'/abacus_getallairline/'.'PH'/*$location['countryCode']*/),true);
				// $airlines = json_decode('{"S":1,"M":"Successfuly fetched (3) records","T_DATA":[{"airlinename":"AirAsia Philippines","airlinecode":"Z2"},{"airlinename":"CEBU Pacific Air","airlinecode":"5J"},{"airlinename":"Philippine Airlines","airlinecode":"PR"}]}',true);

				// $data['airlines'] = $airlines['T_DATA'];
				// $data['airports'] = $airports['T_DATA'];
				// echo '<pre>';
				// 	print_r($data['airports']);
				// echo '</pre>';
				

				$airports = json_decode($this->curl->call('',url_mobilereports.'/domestic_airports'),true);
				$airlines = json_decode($this->curl->call('',url_mobilereports.'/domestic_airlines'),true);

				$data['airlines'] = $airlines['T_DATA'];
				$data['airports'] = $airports['T_DATA'];

				// echo '<pre>';
				// 	print_r($data['airports']);
				// echo '</pre>';

				$this->loadPage(
						'merged_flights/search/v2/abacus/header_index',
						'merged_flights/search/v2/abacus/content_index',
						'merged_flights/search/v2/abacus/footer_index',
						$data
				);

				//$this->load->view('layout/footer');
			}
		} else {
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}






	private function getFlightsSTR($provider,$flights){
		if($provider=='via'){
			$str = '';
			foreach($flights['Flights'] as $i => $f){
				$str .= $f['CarrierID'] .'|^@^|'. $f['FlightNumber'] .'|^@^|'. $f['Source'] .'|^@^|'. $f['Destination'] .'|^@^|'. $f['DepartureTimeStamp'] .'|^@^|'. $f['ArrivalTimeStamp'] .'|^@^|'. $f['Class']. '|^@^|'. $f['FareBasis'] ;
				if(count($flights['Flights'])>1 && $i<count($flights['Flights'])){
					$str .= '|*|';
				}
			}

			if(substr($str, strlen($str) - 3) == '|*|'){
				$str = substr($str, 0, strlen($str)-3);
			}

		}else if($provider=='abacus'){
			$str = '';
			foreach($flights['Flights'] as $i => $f){
				$str .= $f['CarrierID'] .'|^@^|'. $f['FlightNumber'] .'|^@^|'. $f['Source'] .'|^@^|'. $f['Destination'] .'|^@^|'. $f['DepartureTimeStamp'] .'|^@^|'. $f['ArrivalTimeStamp'] .'|^@^|'. $f['Class']. '|^@^|'. $f['FareBasis'] . '|^@^|'. $f['ResBookDesigCode'] . '|^@^|'. $f['MarketingAirline'] . '|^@^|'. $f['OperatingAirline'];
				if(count($flights['Flights'])>1 && $i<count($flights['Flights'])){
					$str .= '|*|';
				}
			}

			if(substr($str, strlen($str) - 3) == '|*|'){
				$str = substr($str, 0, strlen($str)-3);
			}
			
		} else if($provider=='byaheko'){
			$str = '';
			foreach($flights['Flights'] as $i => $f){
				$str .= $f['CarrierID'] .'|^@^|'. $f['FlightNumber'] .'|^@^|'. $f['Source'] .'|^@^|'. $f['Destination'] .'|^@^|'. $f['DepartureTimeStamp'] .'|^@^|'. $f['ArrivalTimeStamp'] .'|^@^|'. $f['Class']. '|^@^|'. $f['FareBasis'] . '|^@^|'. $f['ResBookDesigCode'] . '|^@^|'. $f['MarketingAirline'] . '|^@^|'. $f['OperatingAirline'];
				if(count($flights['Flights'])>1 && $i<count($flights['Flights'])){
					$str .= '|*|';
				}
			}

			if(substr($str, strlen($str) - 3) == '|*|'){
				$str = substr($str, 0, strlen($str)-3);
			}
			
		}

		return $str;
	}

	private function getFlightPricingSTR($provider,$flights){

		//$str = '';
		//if($provider=='via'){
			$p = $flights['Pricing'];
			$str = 'currency:'.$p['currency'].',BaseFareFee:'.$p['BaseFareFee'].',TaxFee:'.$p['TaxFee'].',SystemFee:'.$p['SystemFee'].',TotalFee:'.$p['TotalFee'];
		//}
		return $str;

	}

	private function getFlightPricingSTR2wayAbacus($flights_onward,$flights_return){

		//$str = '';
		$p = $flights_onward['Pricing'];
		$p2 = $flights_return['Pricing'];
		$str = 'currency:'.$p['currency'].',BaseFareFee:'.($p['BaseFareFee']+$p2['BaseFareFee']).',TaxFee:'.($p['TaxFee']+$p2['TaxFee']).',SystemFee:'.($p['SystemFee']+$p2['SystemFee']).',TotalFee:'.($p['TotalFee']+$p2['TotalFee']);

		return $str;

	}

	private function loadPage($customheader,$custompage,$customfooter,$data){
		$this->load->view('merged_flights/header_open',			$data);
		$this->load->view($customheader,				$data);
		$this->load->view('merged_flights/header_close',		$data);

		$this->load->view('element/top_header',			$data);
		$this->load->view('element/wrapper_header');
		$this->load->view('element/left_panel');
		$this->load->view($custompage,					$data);


		$this->load->view('element/wrapper_footer');
		$this->load->view('merged_flights/footer_open');
		if($customfooter){
			$this->load->view($customfooter);
		}	
		$this->load->view('merged_flights/footer_close');

	}

	private function searchResults($data){

		$_data = json_decode($this->input->post('data'),true);

		if($_data){
			goto skip_searchAPI;
		}
		//INPUTS
		$journey 			= $this->input->post('journey');
		$origin 			= $this->input->post('origin');
		$destination 		= $this->input->post('destination');
		$airlines 			= $this->input->post('airline');
		$dateleave 			= $this->input->post('leavedate');
		$datereturn 		= $this->input->post('returndate');
		$class 				= $this->input->post('seatclass');
		$adult 				= $this->input->post('adult');
		$child 				= $this->input->post('child');
		$infant 			= $this->input->post('infant');
		$senior 			= $this->input->post('senior');

		if ($journey == 'OW') {
			$datereturn = 0;
		}

		//LOAD VIA RESULT & ABACUS RESULT
		//$url = 'http://172.16.16.10:8002/webportal';

		$parameters = array(
				'dev_id'     			=> $this->global_f->dev_id(),
				'regcode'               =>$this->user['R'],
				// 'actionId'				=>'merged_ticketing_service3/search_flights_domestic',
				'actionId'				=>'merged_ticketing_service_cc/search_flights_domestic', // for SABRE ONLY
				'ip_address'			=>$this->ip,
				'origin'                =>$origin,
				'destination'           =>$destination,
				'airline'               =>$airlines,
				'leavedate'				=>$dateleave,
				'returndate'			=>$datereturn,
				'seatclass'				=>$class,
				'adult'					=>$adult,
				'children'				=>$child,
				'infant'				=>$infant,
				'senior'				=>$senior,
				'SKT'				    =>$this->user['SKT'],
				$this->user['SKT']	    => md5($this->user['R'].$this->user['SKT'])
		);

		// echo '<pre>';
		// 	print_r($parameters);
		// echo '</pre>';
		
		$results 	= json_decode($this->curl->call($parameters,url),true);

		// echo '<pre>';
		// 	print_r($results);
		// 	// exit();
		// echo '</pre>';


		if ($results) {
			if ($results['S']==1) {

				$adult 	    = 0;
				$children 	= 0;
				$infant 	= 0;
				$senior		= 0;

				$passengers = $results['Passenger'];

				//COMMENT BY MERSON
				foreach($passengers as $p){
					$adult 		= ($p['Type']=='A')? $adult+1: $adult;
					$children 	= ($p['Type']=='C')? $children+1: $children;
					$infant 	= ($p['Type']=='I')? $infant+1: $infant;
					$senior 	= ($p['Type']=='S')? $senior+1: $senior;
				}
				//COMMENT BY MERSON
			
				// $_data['rqid'] = array('RQID' => $results['RQID']);
				$_data['rqid'] = array('RQID' => $results['RQID'], 'byaheko_RQID' => $results['byaheko_RQID']);

				$_data['Passengers'] = array('Adult' => $adult, 'Children' => $children, 'Infant' => $infant, 'Senior' => $senior);

				$_data['results_onward'] = array('result' => $results['result'][0]['onward']);
				
				if($results['result'][1]['return']){
					$_data['results_return'] = array('result' => $results['result'][1]['return']);
				}

				skip_searchAPI:
				$data['data'] = $_data;

			}else{
				$data['output'] = array(
						'S' => 0,
						'M' => $results['M']
				);
			}
		}else{
			$data['process'] = 0;
			$data['output'] = array(

					'S' => 0,
					'M' => 'Searching Failed'

			);
		}


		$this->loadPage(
				'merged_flights/search/v2/abacus/header_searchresults',
				'merged_flights/search/v2/abacus/content_searchresults',
				'merged_flights/search/v2/abacus/footer_searchresults',
				$data
		);
	}

	private function chooseFlights($provider,$onward_index,$return_index,$_data,$data){

		if($provider=='via'){
			$url = url;
			
			$onward = $this->getFlightsSTR($provider,$_data['results_onward']['result'][$onward_index]);
			$onwardPricingSTR = $this->getFlightPricingSTR($provider,$_data['results_onward']['result'][$onward_index]);
			$onward_flightid = '';
			$return_flightid = '';

			if($return_index>=0){
				$return = $this->getFlightsSTR($provider,$_data['results_return']['result'][$return_index]);
				$returnPricingSTR = $this->getFlightPricingSTR($provider,$_data['results_return']['result'][$return_index]);
			}else{
				$return = '';
				$returnPricingSTR = 'currency:,BaseFareFee:,TaxFee:,SystemFee:,TotalFee:';
			}
			
			$passengers = $_data['Passengers'];
			$requestid = $_data['rqid']['RQID'];

			if($passengers['Senior'] > 0) {
				$passengers['Adult'] = $passengers['Senior'];
				$passengers['Senior'] = 1;
			} 

		}else if($provider=='abacus'){

			$passengers = $_data['Passengers'];
			$requestid = $_data['rqid']['RQID'];

			$onward = $this->getFlightsSTR($provider,$_data['results_onward']['result'][$onward_index]);
			$onwardPricingSTR = $this->getFlightPricingSTR($provider,$_data['results_onward']['result'][$onward_index]);
			$onward_flightid = '';
			$return_flightid = '';
				
			if($return_index>=0){
				
				$return = $this->getFlightsSTR($provider,$_data['results_return']['result'][$return_index]);
				$returnPricingSTR = $this->getFlightPricingSTR($provider,$_data['results_return']['result'][$return_index]);

			}else{
				$return = '';
				$returnPricingSTR = 'currency:,BaseFareFee:,TaxFee:,SystemFee:,TotalFee:';
			}

			$url = url;

		} else if($provider=='byaheko'){

			$passengers = $_data['Passengers'];
			$requestid = $_data['rqid']['byaheko_RQID'];

			$onward = '';
			$onwardPricingSTR = $this->getFlightPricingSTR($provider,$_data['results_onward']['result'][$onward_index]);
			$onward_flightid = $_data['results_onward']['result'][$onward_index]['identifier'];
				
			if($return_index>=0){
				
				$return = '';
				$returnPricingSTR = $this->getFlightPricingSTR($provider,$_data['results_return']['result'][$return_index]);
				$return_flightid = $_data['results_return']['result'][$return_index]['identifier'];

			}else{
				$return = '';
				$returnPricingSTR = 'currency:,BaseFareFee:,TaxFee:,SystemFee:,TotalFee:';
				$return_flightid = '';
			}

			$url = url;
		}

		$parameters = array(
				'dev_id' 			=> $this->global_f->dev_id(),
				'regcode' 			=> $this->user['R'],
				// 'actionId'			=> 'merged_ticketing_service3/pricing_rates_request',
				'actionId'			=> 'merged_ticketing_service_cc/pricing_rates_request', // for SABRE ONLY
				'ip_address' 		=> $this->ip,
				'requestid' 		=> $requestid,
				'onward' 			=> $onward,
				'return' 			=> $return,
				'onwardPricing' 	=> $onwardPricingSTR,
				'returnPricing' 	=> $returnPricingSTR,
				'onward_flightid' 	=> $onward_flightid,
				'return_flightid' 	=> $return_flightid,
				'flighttype' 		=> 2,
				'adult' 			=> $passengers['Adult'],
				'children' 			=> $passengers['Children'],
				'infant' 			=> $passengers['Infant'],
				'senior' 			=> $passengers['Senior'],
				'provider' 			=> $provider,
				'SKT'				=> $this->user['SKT'],
				$this->user['SKT'] 	=> md5($this->user['R'] . $this->user['SKT'])
		);

		// echo '<pre>';
		// 	print_r($parameters);
		// echo '</pre>';

		$results = json_decode($this->curl->call($parameters, $url), true);

		// echo '<pre>';
		// 	print_r($results);
		// 	// exit();
		// echo '</pre>';

		return $results;


	}

	private function enterPassengerDetails($data){

		$_data 			= json_decode($this->input->post('data'),true);
		$chosen_onward 	= json_decode($this->input->post('chosen_onward'),true);
		$chosen_return	= json_decode($this->input->post('chosen_return'),true);

		$passengers 	= json_decode($this->input->post('passengers'),true);
		$contacts 		= json_decode($this->input->post('contacts'),true);
		$onward_baggage = json_decode($this->input->post('onward_baggage'),true);
		$return_baggage = json_decode($this->input->post('return_baggage'),true);
		

		if($passengers&&$contacts){
			$data['passengers'] = $passengers;
			$data['contacts'] = $contacts;
		}

		if($onward_baggage){
			$data['onwardbaggages'] = $onward_baggage;
		}
		if($return_baggage){
			$data['returnbaggages'] = $return_baggage;
		}


		//ROUNDTRIP
		if($chosen_return['index']>=0){
		
			if($chosen_onward['provider']==$chosen_return['provider']){
				//SAME PROVIDER

				if($chosen_onward['provider']=='via'){
//				echo 'via provider';
					if(!$onward_baggage){
						$baggages = $this->chooseFlights($chosen_onward['provider'],$chosen_onward['index'],$chosen_return['index'],$_data,$data);
						if($baggages['S']==1){
							$data['onwardbaggages'] = $baggages['OB'];
							$data['returnbaggages'] = $baggages['RB'];
							$data['res_pricing'] 	= $baggages['P'];
						}else{
							$data['output'] = array('M'=> $baggages['M']);
						}
					}

					$data['data'] = $_data;
					$data['chosen_onward'] = $chosen_onward;
					$data['chosen_return'] = $chosen_return;
					$data['totalfee'] = 'PHP '.($_data['results_onward']['via'][$chosen_onward['index']]['Pricing']['TotalFee'] + $_data['results_return']['via'][$chosen_return['index']]['Pricing']['TotalFee']);

					$this->loadPage(
							'merged_flights/search/v2/abacus/header_index',
							'merged_flights/search/v2/abacus/content_passengerdetails',
							'merged_flights/search/v2/abacus/footer_passengerdetails',
							$data
					);

				}else if($chosen_onward['provider']=='abacus'){
//					echo 'abacus provider';
					$result = $this->chooseFlights('abacus',$chosen_onward['index'],$chosen_return['index'],$_data,$data);

					if($result['S']==1){
						//$data['onwardbaggages'] = $result['OB'];
						//$data['returnbaggages'] = $result['RB'];
						$data['res_pricing'] = $result['P'];
					}else{
						$data['output'] = array('M'=> $result['M']);
					}

					//ABACUS
					//echo '2 way abacus';
					$data['data'] = $_data;
					$data['chosen_onward'] = $chosen_onward;
					$data['chosen_return'] = $chosen_return;
					$data['totalfee'] = 'PHP '.($_data['results_onward']['abacus'][$chosen_onward['index']]['Pricing']['TotalFee'] + $_data['results_return']['abacus'][$chosen_return['index']]['Pricing']['TotalFee']);

					$this->loadPage(
							'merged_flights/search/v2/abacus/header_index',
							'merged_flights/search/v2/abacus/content_passengerdetails',
							'merged_flights/search/v2/abacus/footer_passengerdetails',
							$data
					);

				} else if($chosen_onward['provider']=='byaheko'){
//					echo 'byaheko provider';
					$result = $this->chooseFlights('byaheko',$chosen_onward['index'],$chosen_return['index'],$_data,$data);

					if($result['S']==1){
						$data['onwardbaggages'] = $result['OB'];
						$data['returnbaggages'] = $result['RB'];
						$data['res_pricing'] = $result['P'];

						// echo '<pre>';
						// 	print_r($result);
						// echo '</pre>';

					}else{
						$data['output'] = array('M'=> $result['M']);
					}

					//ABACUS
					//echo '2 way abacus';
					$data['data'] = $_data;
					$data['chosen_onward'] = $chosen_onward;
					$data['chosen_return'] = $chosen_return;
					$data['totalfee'] = 'PHP '.($_data['results_onward']['byaheko'][$chosen_onward['index']]['Pricing']['TotalFee'] + $_data['results_return']['byaheko'][$chosen_return['index']]['Pricing']['TotalFee']);

					$this->loadPage(
							'merged_flights/search/v2/abacus/header_index',
							'merged_flights/search/v2/abacus/content_passengerdetails',
							'merged_flights/search/v2/abacus/footer_passengerdetails',
							$data
					);
				}

			}else{

				//MULTI PROVIDER

				if(!$onward_baggage){
					$baggages = $this->chooseFlights($chosen_onward['provider'],$chosen_onward['index'],-1,$_data,$data);
					if($baggages['S']==1){
						if($chosen_onward['provider']=='via'){
							$data['onwardbaggages'] = $baggages['OB'];
							$data['returnbaggages'] = $baggages['RB'];
						}
					}else{
						$data['output'] = array('M'=> $baggages['M']);
					}
				}

				if(!$return_baggage){
					$baggages = $this->chooseFlights($chosen_return['provider'],$chosen_return['index'],-1,$_data,$data);
					if($baggages['S']==1){
						if($chosen_return['provider']=='via'){
							$data['onwardbaggages'] = $baggages['OB'];
							$data['returnbaggages'] = $baggages['RB'];
						}
					}else{
						$data['output'] = array('M'=> $baggages['M']);
					}
				}


				$data['data'] = $_data;
				$data['chosen_onward'] = $chosen_onward;
				$data['chosen_return'] = $chosen_return;
				$data['totalfee'] = 'PHP '.($_data['results_onward']['abacus'][$chosen_onward['index']]['Pricing']['TotalFee'] + $_data['results_return']['abacus'][$chosen_return['index']]['Pricing']['TotalFee']);

				$this->loadPage(
						'merged_flights/search/v2/abacus/header_index',
						'merged_flights/search/v2/abacus/content_passengerdetails',
						'merged_flights/search/v2/abacus/footer_passengerdetails',
						$data
				);

				//echo 'multi provider not yet done';
			}

		}else{
			//ONE WAY
			if($chosen_onward['provider']=='via'){
				//VIA
				//echo 'one way via';

				if(!$onward_baggage){
					$baggages = $this->chooseFlights($chosen_onward['provider'],$chosen_onward['index'],$chosen_return['index'],$_data,$data);
					if($baggages['S']==1){
							$data['onwardbaggages'] = $baggages['OB'];
							$data['returnbaggages'] = $baggages['RB'];
							$data['res_pricing'] 	= $baggages['P'];
					}else{
						$data['output'] = array('M'=> $baggages['M']);
					}
				}
//				print_r($_data);
					$data['data'] = $_data;
					$data['chosen_onward'] = $chosen_onward;
					$data['chosen_return'] = $chosen_return;
					$data['totalfee'] = 'PHP '.($_data['results_onward']['via'][$chosen_onward['index']]['Pricing']['TotalFee']);

					$this->loadPage(
							'merged_flights/search/v2/abacus/header_index',
							'merged_flights/search/v2/abacus/content_passengerdetails',
							'merged_flights/search/v2/abacus/footer_passengerdetails',
							$data
					);

			} else if($chosen_onward['provider']=='abacus'){
				if(!$onward_baggage){
					$baggages = $this->chooseFlights('abacus',$chosen_onward['index'],-1,$_data,$data);
					if($baggages['S']==1){
						$data['res_pricing'] = $baggages['P'];
					}else{
						$data['output'] = array('M'=> $baggages['M']);
					}
				}
				//ABACUS
				//echo 'one way abacus';
//				print_r($_data);
				$data['data'] = $_data;
				$data['chosen_onward'] = $chosen_onward;
				$data['chosen_return'] = $chosen_return;
				$data['totalfee'] = 'PHP '.($_data['results_onward']['abacus'][$chosen_onward['index']]['Pricing']['TotalFee'] + $_data['results_return']['abacus'][$chosen_return['index']]['Pricing']['TotalFee']);

				$this->loadPage(
						'merged_flights/search/v2/abacus/header_index',
						'merged_flights/search/v2/abacus/content_passengerdetails',
						'merged_flights/search/v2/abacus/footer_passengerdetails',
						$data
				);

			} else if($chosen_onward['provider']=='byaheko'){
				if(!$onward_baggage){
					$baggages = $this->chooseFlights('byaheko',$chosen_onward['index'],-1,$_data,$data);
					if($baggages['S']==1){
						$data['onwardbaggages'] = $baggages['OB'];
						$data['returnbaggages'] = $baggages['RB'];
						$data['res_pricing'] 	= $baggages['P'];
					}else{
						$data['output'] = array('M'=> $baggages['M']);
					}
				}
				//ABACUS
				//echo 'one way byaheko';
//				print_r($_data);
				$data['data'] = $_data;
				$data['chosen_onward'] = $chosen_onward;
				$data['chosen_return'] = $chosen_return;
				$data['totalfee'] = 'PHP '.($_data['results_onward']['byaheko'][$chosen_onward['index']]['Pricing']['TotalFee'] + $_data['results_return']['byaheko'][$chosen_return['index']]['Pricing']['TotalFee']);

				$this->loadPage(
						'merged_flights/search/v2/abacus/header_index',
						'merged_flights/search/v2/abacus/content_passengerdetails',
						'merged_flights/search/v2/abacus/footer_passengerdetails',
						$data
				);
			}
		}


	}


	private function summaryPage($data){

		$_data 			= json_decode($this->input->post('data'),true);
		$chosen_onward 	= json_decode($this->input->post('chosen_onward'),true);
		$chosen_return	= json_decode($this->input->post('chosen_return'),true);

		$passengers 	= json_decode($this->input->post('passengers'),true);
		$contacts 		= json_decode($this->input->post('contacts'),true);

		$onward_baggage = json_decode($this->input->post('onward_baggage'),true);
		$return_baggage = json_decode($this->input->post('return_baggage'),true);

		$res_pricing = json_decode($this->input->post('res_pricing'),true);
		
		$data['data'] 			= $_data;
		$data['chosen_onward'] 	= $chosen_onward;
		$data['chosen_return'] 	= $chosen_return;
		$data['passengers'] 	= $passengers;
		$data['contacts'] 		= $contacts;
		$data['onward_baggage'] = $onward_baggage;
		$data['return_baggage'] = $return_baggage;
		$data['res_pricing'] 	= $res_pricing;

		$this->loadPage(
				'merged_flights/search/v2/abacus/header_summary',
				'merged_flights/search/v2/abacus/content_summary',
				'merged_flights/search/v2/abacus/footer_passengerdetails',
				$data
		);

	}


	private function finalPage($data){

		$_data 			= json_decode($this->input->post('data'),true);
		$chosen_onward 	= json_decode($this->input->post('chosen_onward'),true);
		$chosen_return	= json_decode($this->input->post('chosen_return'),true);

		$success = false;

			if($chosen_onward['provider']=='byaheko'){
				$rqid = $_data['rqid']['byaheko_RQID'];
			} else {
				$rqid = $_data['rqid']['RQID'];
			}

			$provider 		= (string)$chosen_onward['provider'];
			$rqid 			= (string)$rqid;
			$passengerSTR 	= (string)$this->input->post('passengersSTR');
			$street 		= (string)$this->input->post('street');
			$city			= (string)$this->input->post('city');
			$zipcode 		= (string)$this->input->post('zipcode');
			$phone 			= (string)$this->input->post('phone');
			$email 			= (string)$this->input->post('email');
			$passengers 	= json_decode($this->input->post('passengers'),true);
			$contacts 		= json_decode($this->input->post('contacts'),true);
			$transpass 		= (string)$this->input->post('transpass');

			$url = url;
		 	$parameters = array(
		 		'dev_id'     		=> $this->global_f->dev_id(),
				'regcode' 	 		=> $this->user['R'],
				'actionId'	 		=> 'merged_ticketing_service/domestic_booking_request',
				'ip_address' 		=> $this->ip,
				'requestid'  		=> $rqid,
				'transpass' 		=> $transpass,
				'passenger'  		=> $passengerSTR,
				'street' 	 		=> $street ,
				'city'		 		=> $city,
				'zipcode' 	 		=> $zipcode,
				'phone' 	 		=> $phone,
				'email' 	 		=> $email,
				'provider' 	 		=> $provider,
				'SKT'				=> $this->user['SKT'],
				$this->user['SKT'] 	=> md5($this->user['R'].$this->user['SKT'].md5($transpass))
		 	);

		 // 	echo '<pre>';
			// 	print_r($parameters);
			// echo '</pre>';

		if($chosen_onward['provider']!=''){
			//two way
			if($chosen_return['index']>=0){
				if($chosen_onward['provider']==$chosen_return['provider']){
					if($chosen_onward['provider']=='via'){
					//VIA DOMESTIC BOOKING

						$provider 		= 'via';

						$data['confirm'] = json_decode($this->curl->call($parameters,$url),true);
//$data['confirm'] = json_decode('{"S":2,"M":"Your booking has been successfully posted but not yet confirmed. Please go to your Domestic Booking Transactions to check the status of your booking. This process may take up to 10 minutes. Thank you very much."}',true);

						 if ($data['confirm']['S'] === 0) {
						 	$m = $data['confirm']['M'];
							//$data = json_decode($this->input->post('collection'),true);
							//$data['collection'] = $data;
							//$data['process'] = 3;
			    			$data['output'] = array(
			    				'S' => 0,
			    				'M' => $m
			    			);
			    			goto display;
						 }elseif ($data['confirm']['S']=== 1) {
						 	//$data['process'] = 0;
			    			$data['output'] = array(
			    				'S' => 1,
			    				'M' => $data['confirm']['M'],
			    				'URL'=> "https://mobilereports.globalpinoyremittance.com/ticketing/domestic/receipt.php?tn=",
			    				'TN' => $data['confirm']['TN']
			    			);
			    			$success = true;
			    			$this->user['EC'] = $data['confirm']['EC'];
			    			$data['user'] = $this->global_f->get_user_session();
						 }elseif ($data['confirm']['S']=== 2) {
						 	//$this->session->unset_userdata('last_parameters');
						 	//$data['process'] = 0;
			    			$data['output'] = array(
			    				'S' => $data['confirm']['S'],
			    				'M' => $data['confirm']['M']
			    			);
			    			$success = true;
			    			$this->user['EC'] = $data['confirm']['EC'];
			    			$data['user'] = $this->global_f->get_user_session();
			    			goto display;
						 }


					} else if($chosen_onward['provider']=='abacus'){
					//ABACUS DOMESTIC BOOKING
						$provider 		= 'abacus';
						
						$result = json_decode($this->curl->call($parameters,url),true);
						// print_r($result);
//						exit();
						//$result = json_decode('{"S":"1","M":"SUCCESSFULLY RESERVED","TN":"GPRSD217ePf16w0","D":"3881.00","EC":"440.00"}',true);

						if($result['S']==1){
							$success = true;
							$this->user['EC'] = $result['EC'];
							$data['user'] = $this->global_f->get_user_session();
						} else {
							goto display;
						}
					} else if($chosen_onward['provider']=='byaheko'){
						//byaheko DOMESTIC BOOKING

						$provider 		= 'byaheko';

						$data['confirm'] = json_decode($this->curl->call($parameters,$url),true);
//$data['confirm'] = json_decode('{"S":2,"M":"Your booking has been successfully posted but not yet confirmed. Please go to your Domestic Booking Transactions to check the status of your booking. This process may take up to 10 minutes. Thank you very much."}',true);

						 if ($data['confirm']['S'] === 0) {
						 	$m = $data['confirm']['M'];
							//$data = json_decode($this->input->post('collection'),true);
							//$data['collection'] = $data;
							//$data['process'] = 3;
			    			$data['output'] = array(
			    				'S' => 0,
			    				'M' => $m
			    			);
			    			goto display;
						 }elseif ($data['confirm']['S']=== 1) {
						 	//$data['process'] = 0;
			    			$data['output'] = array(
			    				'S' => 1,
			    				'M' => $data['confirm']['M'],
			    				'URL'=> "https://mobilereports.globalpinoyremittance.com/ticketing/domestic/receipt.php?tn=",
			    				'TN' => $data['confirm']['TN']
			    			);
			    			$success = true;
			    			$this->user['EC'] = $data['confirm']['EC'];
			    			$data['user'] = $this->global_f->get_user_session();
						 }elseif ($data['confirm']['S']=== 2) {
						 	//$this->session->unset_userdata('last_parameters');
						 	//$data['process'] = 0;
			    			$data['output'] = array(
			    				'S' => $data['confirm']['S'],
			    				'M' => $data['confirm']['M']
			    			);
			    			$success = true;
			    			$this->user['EC'] = $data['confirm']['EC'];
			    			$data['user'] = $this->global_f->get_user_session();
			    			goto display;
						 }


					}


				}else{

					echo '2way provider disabled as it is not yet tested you may enable it at mobile resource';
					die();
					//2way multi provider
					$provider = 'mix';
//					$rqid 			= (string)$_data['rqid']['via'];
				//onward
					if($chosen_onward['provider']=='via') {
						$rqid 			= (string)$_data['rqid']['via'];
					}else if($chosen_onward['provider']=='abacus') {
						$rqid 			= (string)$_data['rqid']['abacus'];
					}

					$passengerSTR 	= (string)$this->input->post('passengersSTR');
					$street 		= (string)$this->input->post('street');
					$city			= (string)$this->input->post('city');
					$zipcode 		= (string)$this->input->post('zipcode');
					$phone 			= (string)$this->input->post('phone');

					$passengers 	= json_decode($this->input->post('passengers'),true);
					$contacts 		= json_decode($this->input->post('contacts'),true);

					$transpass 		= (string)$this->input->post('transpass');

					$url = url;
				 	$parameters = array(
				 		'dev_id'     => $this->global_f->dev_id(),
						'regcode' 	 => $this->user['R'],
						'ip_address' =>	$this->ip,
						'requestid'  => $rqid,
						'transpass'  => $transpass,
						'passenger'  => $passengerSTR,
						'street' 	 => $street ,
						'city'		 => $city,
						'zipcode' 	 => $zipcode,
						'phone' 	 => $phone,
						 $this->user['SKT'] => md5($this->user['R'].$this->user['SKT'].md5($transpass))
				 	);

					//onward
					if($chosen_onward['provider']=='via'){

						//$parameters['actionId'] = _domestic_booking_request;

						$data['confirm'] = json_decode($this->curl->call($parameters,$url),true);

						if ($data['confirm']['S'] === 0) {
						 	$m = $data['confirm']['M'];
							//$data = json_decode($this->input->post('collection'),true);
							//$data['collection'] = $data;
							//$data['process'] = 3;
			    			$data['output'] = array(
			    				'S' => 0,
			    				'M' => $m
			    			);
			    			goto display;
						}elseif ($data['confirm']['S']=== 1) {
						 	//$data['process'] = 0;
			    			$data['output'] = array(
			    				'S' => 1,
			    				'M' => $data['confirm']['M'],
			    				'URL'=> "https://mobilereports.globalpinoyremittance.com/ticketing/domestic/receipt.php?tn=",
			    				'TN' => $data['confirm']['TN']
			    			);
			    			$success = true;
						}elseif ($data['confirm']['S']=== 2) {
						 	//$this->session->unset_userdata('last_parameters');
						 	//$data['process'] = 0;
			    			$data['output'] = array(
			    				'S' => $data['confirm']['S'],
			    				'M' => $data['confirm']['M']
			    			);
			    			goto display;
						}
					}else if($chosen_onward['provider']=='abacus'){

						//$parameters['actionId'] = abacus_domestic_booking_request;
						$result = json_decode($this->curl->call($parameters,url),true);


						if($result['S']==0){
							goto display;
						}

						$PNR = (string)$result['PNR'];
						$BOOKINGRQID = $result['TN'];

						$parameters = array(
								'dev_id'      	=> $this->global_f->dev_id(),
								//'actionId' 	  	=> abacus_issue_ticket_domestic,
								'ip_address'  	=> $this->ip,
								'regcode' 	  	=> $this->user['R'],
								'pnr'			=> $PNR,
								'bookingrqid' 	=> $BOOKINGRQID,
						);

						$result = json_decode($this->curl->call($parameters,url),true);
						if($result['S']==1){
							$success = true;
						}

					}

					//return
					if($chosen_return['provider']=='via'){

						$parameters['requestid'] = (string)$_data['rqid']['via'];
						//$parameters['actionId'] = _domestic_booking_request;

						$data['confirm'] = json_decode($this->curl->call($parameters,$url),true);

						if ($data['confirm']['S'] === 0) {
						 	$m = $data['confirm']['M'];
							//$data = json_decode($this->input->post('collection'),true);
							//$data['collection'] = $data;
							//$data['process'] = 3;
			    			$data['output'] = array(
			    				'S' => 0,
			    				'M' => $m
			    			);
			    			goto display;
						}elseif ($data['confirm']['S']=== 1) {
						 	//$data['process'] = 0;
			    			$data['output'] = array(
			    				'S' => 1,
			    				'M' => $data['confirm']['M'],
			    				'URL'=> "https://mobilereports.globalpinoyremittance.com/ticketing/domestic/receipt.php?tn=",
			    				'TN' => $data['confirm']['TN']
			    			);
			    			$success = true;
						}elseif ($data['confirm']['S']=== 2) {
						 	//$this->session->unset_userdata('last_parameters');
						 	//$data['process'] = 0;
			    			$data['output'] = array(
			    				'S' => $data['confirm']['S'],
			    				'M' => $data['confirm']['M']
			    			);
			    			goto display;
						}

					}else if($chosen_return['provider']=='abacus'){
						$parameters['requestid'] = (string)$_data['rqid']['abacus'];
						//$parameters['actionId'] = abacus_domestic_booking_request;
						$result = json_decode($this->curl->call($parameters,url),true);


						if($result['S']==0){
							goto display;
						}

						$PNR = (string)$result['PNR'];
						$BOOKINGRQID = $result['TN'];

						$parameters = array(
								'dev_id'      	=> $this->global_f->dev_id(),
								//'actionId' 	  	=> abacus_issue_ticket_domestic,
								'ip_address'  	=> $this->ip,
								'regcode' 	  	=> $this->user['R'],
								'pnr'			=> $PNR,
								'bookingrqid' 	=> $BOOKINGRQID,
						);

						$result = json_decode($this->curl->call($parameters,url),true);
						if($result['S']==1){
							$success = true;
						}
					}

				}
			//oneway
			}else{
				
				if($chosen_onward['provider']=='via'){

					$provider 		= 'via';
					
					$data['confirm'] = json_decode($this->curl->call($parameters,$url),true);

					 if ($data['confirm']['S'] === 0) {
					 	$m = $data['confirm']['M'];
						//$data = json_decode($this->input->post('collection'),true);
						//$data['collection'] = $data;
						//$data['process'] = 3;
		    			$data['output'] = array(
		    				'S' => 0,
		    				'M' => $m
		    			);
		    			goto display;
					 }elseif ($data['confirm']['S']=== 1) {
					 	//$data['process'] = 0;
		    			$data['output'] = array(
		    				'S' => 1,
		    				'M' => $data['confirm']['M'],
		    				'URL'=> "https://mobilereports.globalpinoyremittance.com/ticketing/domestic/receipt.php?tn=",
		    				'TN' => $data['confirm']['TN']
		    			);
		    			$success = true;
		    			$this->user['EC'] = $data['confirm']['EC'];
		    			$data['user'] = $this->global_f->get_user_session();
					 }elseif ($data['confirm']['S']=== 2) {
					 	//$this->session->unset_userdata('last_parameters');
					 	//$data['process'] = 0;
		    			$data['output'] = array(
		    				'S' => $data['confirm']['S'],
		    				'M' => $data['confirm']['M']
		    			);
		    			$success = true;
		    			$this->user['EC'] = $data['confirm']['EC'];
		    			$data['user'] = $this->global_f->get_user_session();
					 }

				}else if($chosen_onward['provider']=='abacus'){
					$provider 		= 'abacus';

					$result = json_decode($this->curl->call($parameters,url),true);

					if($result['S']==1){
						$success = true;
						$this->user['EC'] = $result['EC'];
						$data['user'] = $this->global_f->get_user_session();
					} else {
						goto display;
					}

				} else if($chosen_onward['provider']=='byaheko'){

					$provider 		= 'byaheko';

					$data['confirm'] = json_decode($this->curl->call($parameters,$url),true);

					// echo '<pre>';
					// 	print_r($data['confirm']);
					// echo '</pre>';

					if ($data['confirm']['S'] === 0) {
					 	$m = $data['confirm']['M'];
						//$data = json_decode($this->input->post('collection'),true);
						//$data['collection'] = $data;
						//$data['process'] = 3;
		    			$data['output'] = array(
		    				'S' => 0,
		    				'M' => $m
		    			);
		    			goto display;
					 }elseif ($data['confirm']['S']=== 1) {
					 	//$data['process'] = 0;
		    			$data['output'] = array(
		    				'S' => 1,
		    				'M' => $data['confirm']['M'],
		    				'URL'=> "https://mobilereports.globalpinoyremittance.com/ticketing/domestic/receipt.php?tn=",
		    				'TN' => $data['confirm']['TN']
		    			);
		    			$success = true;
		    			$this->user['EC'] = $data['confirm']['EC'];
		    			$data['user'] = $this->global_f->get_user_session();
					 }elseif ($data['confirm']['S']=== 2) {
					 	//$this->session->unset_userdata('last_parameters');
					 	//$data['process'] = 0;
		    			$data['output'] = array(
		    				'S' => $data['confirm']['S'],
		    				'M' => $data['confirm']['M']
		    			);
		    			$success = true;
		    			$this->user['EC'] = $data['confirm']['EC'];
		    			$data['user'] = $this->global_f->get_user_session();
					 }

				}

			}


		}else{
			// echo 'mm';
			$data['output'] = array('S'=>0, 'M' => 'Onward Provider Unavailable');
		}


		display:

		$data['provider'] = $provider;

		if(!$success){
			if($provider=='abacus'){
				$data['output'] = array('S'=>0,'M'=>$result['M']);
			}
		
			$this->summaryPage($data);
		}else{

			if($provider=='abacus'){
				$data['output'] = $result;
			}
			// print_r($data);
			// die($provider);
			
			unset($_POST);
			$_POST = array();
			
			$this->loadPage(
					'merged_flights/search/v2/abacus/header_index',
					'merged_flights/search/v2/abacus/content_finalpage',
					null,
					$data
			);

		}

	}



	private function finalPageCC($data){

		$_data 			= json_decode($this->input->post('data'),true);
		$chosen_onward 	= json_decode($this->input->post('chosen_onward'),true);
		$chosen_return	= json_decode($this->input->post('chosen_return'),true);

		$passengers 	= json_decode($this->input->post('passengers'),true);
		$contacts 		= json_decode($this->input->post('contacts'),true);

		$onward_baggage = json_decode($this->input->post('onward_baggage'),true);
		$return_baggage = json_decode($this->input->post('return_baggage'),true);

		$res_pricing = json_decode($this->input->post('res_pricing'),true);
		
		$data['data'] 			= $_data;
		$data['chosen_onward'] 	= $chosen_onward;
		$data['chosen_return'] 	= $chosen_return;
		$data['passengers'] 	= $passengers;
		$data['contacts'] 		= $contacts;
		$data['onward_baggage'] = $onward_baggage;
		$data['return_baggage'] = $return_baggage;
		$data['res_pricing'] 	= $res_pricing;
		$data['process'] = 0;

		$success = false;

		if($chosen_onward['provider']=='byaheko'){
			$rqid = $_data['rqid']['byaheko_RQID'];
		} else {
			$rqid = $_data['rqid']['RQID'];
		}

		$provider 		= (string)$chosen_onward['provider'];
		$rqid 			= (string)$rqid;
		$passengerSTR 	= (string)$this->input->post('passengersSTR');
		$street 		= (string)$this->input->post('street');
		$city			= (string)$this->input->post('city');
		$zipcode 		= (string)$this->input->post('zipcode');
		$phone 			= (string)$this->input->post('phone');
		$email 			= (string)$this->input->post('email');
		$passengers 	= json_decode($this->input->post('passengers'),true);
		$contacts 		= json_decode($this->input->post('contacts'),true);
		$transpass 		= (string)$this->input->post('transpass');

		
		$AMOUNT = $this->input->post('inputCCTOAmount');
        $RATE = 0.055;
        $TOTAL_AMOUNT = round($AMOUNT + ($AMOUNT * $RATE),2);
          // var_dump($TOTAL_AMOUNT);die();
        $CHARGE = $TOTAL_AMOUNT - $AMOUNT;

        $AMOUNT_MODIFY = explode('.', $TOTAL_AMOUNT);

        $parameters = array(
		 		'dev_id'     		=> $this->global_f->dev_id(),
				'regcode' 	 		=> $this->user['R'],
				'actionId'	 		=> 'merged_ticketing_service_cc/ticketing_creditcard_request',
				'ip_address' 		=> $this->ip,
				'requestid'  		=> $rqid,
				'transpass' 		=> $transpass,
				'passenger'  		=> $passengerSTR,
				'street' 	 		=> $street ,
				'city'		 		=> $city,
				'zipcode' 	 		=> $zipcode,
				'phone' 	 		=> $phone,
				'email' 	 		=> $email,
				'provider' 	 		=> $provider,
				'amount'			=> $TOTAL_AMOUNT,
				'charge'			=> $CHARGE,
				'SKT'				=> $this->user['SKT'],
				$this->user['SKT'] 	=> md5($this->user['R'].$this->user['SKT'].md5($transpass))
		 	);

		 // 	echo '<pre>';
			// 	print_r($parameters); die;
			// echo '</pre>';

		$data['confirm'] = json_decode($this->curl->call($parameters,url),true);

			// echo '<pre>';
			// 	print_r($data['confirm']); die;
			// echo '</pre>';


		if ($data['confirm']['S'] === 1) {

			$parameters2 = array(
		 		'dev_id'     		=> $this->global_f->dev_id(),
				'regcode' 	 		=> $this->user['R'],
				'actionId'	 		=> 'merged_ticketing_service_cc/domestic_booking_request_cc',
				'ip_address' 		=> $this->ip,
				'requestid'  		=> $rqid,
				'transpass' 		=> $transpass,
				'passenger'  		=> $passengerSTR,
				'street' 	 		=> $street ,
				'city'		 		=> $city,
				'zipcode' 	 		=> $zipcode,
				'phone' 	 		=> $phone,
				'email' 	 		=> $email,
				'provider' 	 		=> $provider,
				'amount'			=> $TOTAL_AMOUNT,
				'charge'			=> $CHARGE,
				'SKT'				=> $this->user['SKT'],
				$this->user['SKT'] 	=> md5($this->user['R'].$this->user['SKT'].md5($transpass))
		 	);

		 // 	echo '<pre>';
			// 	print_r($parameters2); die;
			// echo '</pre>';

			$data['confirm2'] = json_decode($this->curl->call($parameters2,url),true);

			if ($data['confirm2']['S'] === 1) {

		        if(strlen($AMOUNT_MODIFY[1]) == 1){
		          $AMOUNT_MODIFY[1] = $AMOUNT_MODIFY[1].'0';
		        }

		        $parameter = array(
		          'dev_id'        =>$this->global_f->dev_id(),
		          'ip_address'    =>$this->ip,
		          'ip'        =>$this->ip,
		          'actionId'      => _generate_tracking_reload,
		          'regcode'           =>$this->user['R'],
		          'amount'      =>$AMOUNT,
		          'totalamount'   =>$TOTAL_AMOUNT,
		          $this->user['SKT']  =>  md5($this->user['R'].$this->user['SKT'])
		          );

		        $api_result = $this->curl->call($parameter,url);
		        $API = json_decode($api_result,true);

		        // var_dump($API);die();

		        if ($API['S'] == 1) {
		          $TRACKNO = $API['TN'];
		        }else{
		          $TRACKNO = '';
		        }

		        // $RAW_DATA = 'amount='.$AMOUNT.'&charge='.$CHARGE.'&reloadtype='.$this->input->post('inputCTTOFundtype').'&rqid='.$rqid;
		        $inputCTTOFundtype = 'ECASH';
		        $RAW_DATA = 'amount='.$AMOUNT.'&charge='.$CHARGE.'&reloadtype='.$inputCTTOFundtype.'&rqid='.$rqid;
		        
		        $RAW_DATA = urlencode($this->Encryption_model->encrypt_value($RAW_DATA));

		        // var_dump($RAW_DATA);die();

		        $vpcURL = 'https://migs.mastercard.com.au/vpcpay';
		        $SECURE_SECRET = "4E668324C795C99B6D2BBA57E4DDA215";

		        require APPPATH.'/libraries/vpclib/VPCPaymentConnection.php';
		        $conn = new VPCPaymentConnection();

		          // $this->load->model('credit_card_model');
		        $conn->setSecureSecret($SECURE_SECRET);
		          // echo "string";die();
		        $BDO_PARAMS = array(
		          'vpc_AccessCode' => '04C8BEAF',
		          'vpc_Amount' => round($AMOUNT_MODIFY[0]).($AMOUNT_MODIFY[1] ? sprintf('%02s', $AMOUNT_MODIFY[1]) : '00'),
		          'vpc_Command' => 'pay',
		          'vpc_Locale' => 'en',
		          'vpc_MerchTxnRef' => $TRACKNO,
		          'vpc_Merchant' => 'BD9180551889',
		          'vpc_OrderInfo' => $TRACKNO,
		          'vpc_ReturnURL' => base_url().'Merged_ticketing_flights/payment_landing?data='.$RAW_DATA,
		          'vpc_Version' => '1'
		          );

		        ksort($BDO_PARAMS);

		        foreach($BDO_PARAMS as $key => $value) {
		          if (strlen($value) > 0) {
		            $conn->addDigitalOrderField($key, $value);
		          }
		        }

		        $secureHash = $conn->hashAllFields();
		        $conn->addDigitalOrderField("vpc_SecureHash", $secureHash);
		        $conn->addDigitalOrderField("vpc_SecureHashType", "SHA256");

		        $vpcURL = $conn->getDigitalOrder($vpcURL);
		          // echo $vpcURL;die();

		        $data['bdoURL'] = $vpcURL;
		        $data['process'] = 1;
		        $data['amount'] = $AMOUNT;

	    	} else {
		    	$data['output'] = array('S'=>0, 'M' => $data['confirm2']['M']);
		    }

	    } else {
	    	$data['output'] = array('S'=>0, 'M' => 'Invalid adding value in ticketing thru credit card!');
	    }

			
		$this->loadPage(
				'merged_flights/search/v2/abacus/header_summary',
				'merged_flights/search/v2/abacus/content_summary',
				'merged_flights/search/v2/abacus/footer_passengerdetails',
				$data
		);

	}


	public function payment_landing(){

    if ($this->user['S'] == 1 && $this->user['R'] !=""){

      $data = array('menu' => 15,
        'parent'=>'' );

      $data['user'] = $this->user;

      $TRANSDATA = $this->input->get('data');
      
      if($TRANSDATA){

        $DECRYPTED = $this->Encryption_model->decrypt_value($TRANSDATA);
        $data = explode('&', $DECRYPTED);

        // var_dump($data);

        if(count($data) == 4){
          for($i=0;$i<count($data);$i++){
            $val_check = explode('=', $data[$i]);

            if($i == 0){
              if($val_check[0] != 'amount'){
                redirect('ErrorPage/');
              }else{
                $AMOUNT = $val_check[1];
              }
            }else if($i == 1){
              if($val_check[0] != 'charge'){
                redirect('ErrorPage/');
              }else{
                $SERVICE_CHARGE = $val_check[1];
              }
            }else if($i == 2){
              if($val_check[0] != 'reloadtype'){
                redirect('ErrorPage/');
              }else{
                $RELOAD_TYPE = $val_check[1];
              }
            }
            else if($i == 3){
              if($val_check[0] != 'rqid'){
                redirect('ErrorPage/');
              }else{
                $rqid = $val_check[1];
              }
            }

          }

          if($this->input->get('vpc_TxnResponseCode') == '0'){

            $getDecimal = substr($this->input->get('vpc_Amount'), -2);
            $BDO_AMOUNT = explode($getDecimal, $this->input->get('vpc_Amount'));

            	$parameter = array(
	              	'dev_id'        =>$this->global_f->dev_id(),
	              	'ip_address'    =>$this->ip,
	              	'ip'        	=>$this->ip,
	              	'actionId'    	=> _request_reload_purchase,
	              	'regcode'       =>$this->user['R'],
	              	'cardno'        =>$this->input->get('vpc_CardNum'),
	              	'amount'      	=>$AMOUNT,
                 	'paid_amount'   =>$BDO_AMOUNT[0].'.'.($getDecimal ? $getDecimal : '00'), //substr_replace($BDO_AMOUNT[0], "", -2).'.'.($BDO_AMOUNT[1] ? $BDO_AMOUNT[1] : '00')
                 	'referenceno'   =>$this->input->get('vpc_ReceiptNo'),
                 	'trackno'       =>$this->input->get('vpc_MerchTxnRef'),
                 	'charge'       	=>$SERVICE_CHARGE,
                 	'reload_type'   =>$RELOAD_TYPE
                );

            $result = $this->curl->call($parameter,url);
            $API = json_decode($result,true);

            if ($API['S'] == 1) {

            	$cc_parameters = array(
			 		'dev_id'     		=> $this->global_f->dev_id(),
					'regcode' 	 		=> $this->user['R'],
					'actionId'	 		=> 'merged_ticketing_service_cc/ticketing_creditcard_update_booking',
					'ip_address' 		=> $this->ip,
					'requestid'  		=> $rqid,
					'status' 			=> 1,
					'SKT'				=> $this->user['SKT'],
					$this->user['SKT'] 	=> md5($this->user['R'].$this->user['SKT'].md5($transpass))
			 	);

				$res_cc = json_decode($this->curl->call($cc_parameters,url),true);

				if($res_cc['S']) {
	              	$data['result'] = array(  
		                'S'  => 1,
		                'H'  => 'Successful',
		                'M'  => 'Booking transaction has been successfully posted. Payment : '.$API['M'],
		                'TN' =>$API['TN']
	                );

	            } else {
	            	$data['result'] = array(  
		                'S'  => 1,
		                'H'  => 'Successful',
		                'M'  =>$res_cc['M'].' '.$API['M'],
		                'TN' =>$API['TN']
	                );
	            }

            }else {

            	$cc_parameters = array(
			 		'dev_id'     		=> $this->global_f->dev_id(),
					'regcode' 	 		=> $this->user['R'],
					'actionId'	 		=> 'merged_ticketing_service_cc/ticketing_creditcard_update_booking',
					'ip_address' 		=> $this->ip,
					'requestid'  		=> $rqid,
					'status' 			=> 0,
					'SKT'				=> $this->user['SKT'],
					$this->user['SKT'] 	=> md5($this->user['R'].$this->user['SKT'].md5($transpass))
			 	);

				$res_cc = json_decode($this->curl->call($cc_parameters,url),true);

				if($res_cc['S']) {
	              	$data['result'] = array(  
		                'S' => 0,
		                'H' => 'Transaction failed',
		                'M' =>$API['M']
	                );

		        } else {
	            	$data['result'] = array(  
		                'S'  => 0,
		                'H'  => 'Transaction failed',
		                'M'  =>$res_cc['M'].' '.$API['M'],
	                );
	            }

            }

          }else{

          		$cc_parameters = array(
			 		'dev_id'     		=> $this->global_f->dev_id(),
					'regcode' 	 		=> $this->user['R'],
					'actionId'	 		=> 'merged_ticketing_service_cc/ticketing_creditcard_update_booking',
					'ip_address' 		=> $this->ip,
					'requestid'  		=> $rqid,
					'status' 			=> 0,
					'SKT'				=> $this->user['SKT'],
					$this->user['SKT'] 	=> md5($this->user['R'].$this->user['SKT'].md5($transpass))
			 	);

				$res_cc = json_decode($this->curl->call($cc_parameters,url),true);


				if($res_cc['S']) {
            		$data['result'] = array(
		              	'S' =>  0,
		              	'H' =>  'Transaction failed',
		              	'M' => str_replace('+', ' ', $this->input->get('vpc_Message'))
	              	);

            	} else {
	            	$data['result'] = array(  
		                'S'  => 0,
		                'H'  => 'Transaction failed',
		                'M'  =>$res_cc['M'].' '.str_replace('+', ' ', $this->input->get('vpc_Message')),
	                );
	            }
          }

         	  $this->load->view('layout/header'); 
	          $this->load->view('merged_flights/bdo_message',$data);
	          $this->load->view('layout/footer'); 

        }else{
          redirect('ErrorPage/');
        }
      }else{
        redirect('ErrorPage/');
      }

    }else {
      //$this->session->unset_userdata('user');
      $this->session->sess_destroy();
      redirect('Login/');
    }

  }

  	public function redirect_flights(){ 
  		redirect('Merged_ticketing_flights/search_flights');
  	}




	public function search_flights2(){ 

		$data = array('menu' => 'dom',
				'parent'=>'ABACUS' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;

			//DISREGARD
			if(isset($_POST['btn_backfrompassengerdetails'])){
				$data['data1'] = json_decode($this->input->post('data1'),true);
				$data['RQID'] = (string)$this->input->post('rqid');
				if($data['data1']){
					goto backfrompassengerdetailspage;
				}else{
					goto searchPage;
				}
			}else if(isset($_POST['btn_backfromsummary'])){
				/*$data['pricing'] 		= $results['P'];
				$data['adultcount'] 	= $parameters['adult'];
				$data['childrencount'] 	= $parameters['children'];
				$data['infantcount'] 	= $parameters['infant'];
				$data['seniorcount'] 	= $parameters['senior'];
				$data['rqid'] 			= $parameters['requestid'];
				$data['data1'] = json_decode($this->input->post('data1'),true);*/

				goto backfrompassengerdetailspage;
			}
			//DISREGARD


			//START
			if(isset($_POST['btn_search'])){
				//VIA
				$journey = $this->input->post('journey');

				$url = 'http://172.16.16.10:8002/webportal';
				$parameters = array(
						'dev_id'     			=> $this->global_f->dev_id(),
						'regcode'               =>$this->user['R'],
						'actionId'				=>_search_domestic_flights,
						'ip_address'			=>$this->ip,
						'origin'                =>$this->input->post('origin'),
						'destination'           =>$this->input->post('destination'),
						'airline'               =>$this->input->post('airline'),
						'leavedate'				=>$this->input->post('leavedate'),
						'returndate'			=>$journey == 'RT' ? $this->input->post('returndate'):'',
						'seatclass'				=>$this->input->post('seatclass'),
						'adult'					=>$this->input->post('adult'),
						'children'				=>$this->input->post('child'),
						'infant'				=>$this->input->post('infant'),
						'senior'				=>$this->input->post('senior'),
						$this->user['SKT']	    => md5($this->user['R'].$this->user['SKT'])
				);

				//$viaresults = json_decode($this->curl->call($parameters,$url),true);
				$viaresults = json_decode('{"S":1,"M":"53 results found","RQID":"1234568486828","Passenger":[{"Type":"A"}],"result":[{"onward":[{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"1869","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T2245","ArrivalTimeStamp":"2016-11-30T2355","Class":"T","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CEB_1869_139_22:45__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"1418.00","TaxFee":"420.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"1888.00","is_available":1}},{"Flights":[{"Carrier":"Air Asia Zest","CarrierID":"Z2","FlightNumber":"767","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1825","ArrivalTimeStamp":"2016-11-30T1950","Class":"Z","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$38_MNL_CEB_767_158_18:25__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"1630.00","TaxFee":"444.60","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"2124.60","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"557","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1925","ArrivalTimeStamp":"2016-11-30T2045","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_CEB_557_151_19:25__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"1539.00","TaxFee":"657.68","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"2246.68","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"561","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0045","ArrivalTimeStamp":"2016-11-30T0200","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_CEB_561_151_00:45__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"1539.00","TaxFee":"657.68","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"2246.68","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"571","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1750","ArrivalTimeStamp":"2016-11-30T1910","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_CEB_571_151_17:50__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"1539.00","TaxFee":"657.68","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"2246.68","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"583","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T2100","ArrivalTimeStamp":"2016-11-30T2220","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_CEB_583_151_21:00__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"1539.00","TaxFee":"657.68","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"2246.68","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"589","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T2345","ArrivalTimeStamp":"2016-12-01T0105","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_CEB_589_151_23:45__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"1539.00","TaxFee":"657.68","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"2246.68","is_available":0}},{"Flights":[{"Carrier":"Air Asia Zest","CarrierID":"Z2","FlightNumber":"771","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1930","ArrivalTimeStamp":"2016-11-30T2055","Class":"I","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$38_MNL_CEB_771_158_19:30__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"1880.00","TaxFee":"474.60","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"2404.60","is_available":0}},{"Flights":[{"Carrier":"Air Asia Zest","CarrierID":"Z2","FlightNumber":"775","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1040","ArrivalTimeStamp":"2016-11-30T1205","Class":"I","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$38_MNL_CEB_775_158_10:40__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"1880.00","TaxFee":"474.60","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"2404.60","is_available":0}},{"Flights":[{"Carrier":"Air Asia Zest","CarrierID":"Z2","FlightNumber":"781","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0835","ArrivalTimeStamp":"2016-11-30T1000","Class":"I","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$38_MNL_CEB_781_158_08:35__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"1880.00","TaxFee":"474.60","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"2404.60","is_available":0}},{"Flights":[{"Carrier":"Air Asia Zest","CarrierID":"Z2","FlightNumber":"783","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1240","ArrivalTimeStamp":"2016-11-30T1410","Class":"I","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$38_MNL_CEB_783_158_12:40__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"1880.00","TaxFee":"474.60","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"2404.60","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"553","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1005","ArrivalTimeStamp":"2016-11-30T1120","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_CEB_553_151_10:05__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"1789.00","TaxFee":"687.68","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"2526.68","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"565","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1215","ArrivalTimeStamp":"2016-11-30T1340","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_CEB_565_151_12:15__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"1789.00","TaxFee":"687.68","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"2526.68","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"569","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1620","ArrivalTimeStamp":"2016-11-30T1740","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_CEB_569_151_16:20__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"1789.00","TaxFee":"687.68","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"2526.68","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"581","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1340","ArrivalTimeStamp":"2016-11-30T1455","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_CEB_581_151_13:40__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"1789.00","TaxFee":"687.68","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"2526.68","is_available":0}},{"Flights":[{"Carrier":"Air Asia Zest","CarrierID":"Z2","FlightNumber":"763","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0600","ArrivalTimeStamp":"2016-11-30T0725","Class":"A","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$38_MNL_CEB_763_158_06:00__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"2130.00","TaxFee":"504.60","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"2684.60","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"1843","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0555","ArrivalTimeStamp":"2016-11-30T0710","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CEB_1843_139_05:55__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"2138.00","TaxFee":"506.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"2694.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2841","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0500","ArrivalTimeStamp":"2016-11-30T0615","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CEB_2841_139_05:00__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"2138.00","TaxFee":"506.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"2694.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2861","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1600","ArrivalTimeStamp":"2016-11-30T1715","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CEB_2861_139_16:00__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"2138.00","TaxFee":"506.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"2694.00","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"555","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0850","ArrivalTimeStamp":"2016-11-30T1005","Class":"C","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_CEB_555_151_08:50__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"2069.00","TaxFee":"721.28","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"2840.28","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"563","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0415","ArrivalTimeStamp":"2016-11-30T0530","Class":"C","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_CEB_563_151_04:15__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"2069.00","TaxFee":"721.28","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"2840.28","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2835","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0400","ArrivalTimeStamp":"2016-11-30T0510","Class":"X","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CEB_2835_139_04:00__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"2428.00","TaxFee":"541.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"3019.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2863","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1745","ArrivalTimeStamp":"2016-11-30T1900","Class":"X","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CEB_2863_139_17:45__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"2428.00","TaxFee":"541.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"3019.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2867","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T2000","ArrivalTimeStamp":"2016-11-30T2115","Class":"X","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CEB_2867_139_20:00__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"2428.00","TaxFee":"541.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"3019.00","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"567","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0835","ArrivalTimeStamp":"2016-11-30T1000","Class":"V","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_CEB_567_151_08:35__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"2349.00","TaxFee":"754.88","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"3153.88","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2845","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0715","ArrivalTimeStamp":"2016-11-30T0815","Class":"B","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CEB_2845_139_07:15__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"2728.00","TaxFee":"577.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"3355.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2859","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1430","ArrivalTimeStamp":"2016-11-30T1545","Class":"B","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CEB_2859_139_14:30__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"2728.00","TaxFee":"577.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"3355.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2129","Source":"MNL","Destination":"BCD","DepartureTimeStamp":"2016-11-30T0415","ArrivalTimeStamp":"2016-11-30T0530","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_BCD_2129_139_04:15_$22_BCD_CEB_2286_139_07:05__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2286","Source":"BCD","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0705","ArrivalTimeStamp":"2016-11-30T0750","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_BCD_2129_139_04:15_$22_BCD_CEB_2286_139_07:05__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"2976.00","TaxFee":"671.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"3697.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2969","Source":"MNL","Destination":"KLO","DepartureTimeStamp":"2016-11-30T0810","ArrivalTimeStamp":"2016-11-30T0915","Class":"X","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_KLO_2969_139_08:10_$22_KLO_CEB_242_139_12:15__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"242","Source":"KLO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1215","ArrivalTimeStamp":"2016-11-30T1315","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_KLO_2969_139_08:10_$22_KLO_CEB_242_139_12:15__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"3286.00","TaxFee":"708.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"4044.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2139","Source":"MNL","Destination":"ILO","DepartureTimeStamp":"2016-11-30T0430","ArrivalTimeStamp":"2016-11-30T0540","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_ILO_2139_139_04:30_$22_ILO_CEB_2381_139_06:50__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2381","Source":"ILO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0650","ArrivalTimeStamp":"2016-11-30T0740","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_ILO_2139_139_04:30_$22_ILO_CEB_2381_139_06:50__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"3336.00","TaxFee":"714.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"4100.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2849","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0855","ArrivalTimeStamp":"2016-11-30T1010","Class":"Q","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CEB_2849_139_08:55__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"3458.00","TaxFee":"664.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"4172.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2131","Source":"MNL","Destination":"BCD","DepartureTimeStamp":"2016-11-30T0755","ArrivalTimeStamp":"2016-11-30T0910","Class":"B","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_BCD_2131_139_07:55_$22_BCD_CEB_2288_139_11:40__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2288","Source":"BCD","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1140","ArrivalTimeStamp":"2016-11-30T1230","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_BCD_2131_139_07:55_$22_BCD_CEB_2288_139_11:40__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"3566.00","TaxFee":"741.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"4357.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2141","Source":"MNL","Destination":"ILO","DepartureTimeStamp":"2016-11-30T0815","ArrivalTimeStamp":"2016-11-30T0930","Class":"B","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_ILO_2141_139_08:15_$22_ILO_CEB_2385_139_13:45__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2385","Source":"ILO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1345","ArrivalTimeStamp":"2016-11-30T1430","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_ILO_2141_139_08:15_$22_ILO_CEB_2385_139_13:45__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"3936.00","TaxFee":"786.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"4772.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2519","Source":"MNL","Destination":"CGY","DepartureTimeStamp":"2016-11-30T0410","ArrivalTimeStamp":"2016-11-30T0545","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CGY_2519_139_04:10_$22_CGY_CEB_2296_139_07:15__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2296","Source":"CGY","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0715","ArrivalTimeStamp":"2016-11-30T0800","Class":"T","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CGY_2519_139_04:10_$22_CGY_CEB_2296_139_07:15__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"4226.00","TaxFee":"821.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"5097.00","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"961","Source":"MNL","Destination":"DVO","DepartureTimeStamp":"2016-11-30T0345","ArrivalTimeStamp":"2016-11-30T0535","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_961_151_03:45_$39_DVO_CEB_594_151_06:35__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"},{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"594","Source":"DVO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0635","ArrivalTimeStamp":"2016-11-30T0735","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_961_151_03:45_$39_DVO_CEB_594_151_06:35__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"4098.00","TaxFee":"1327.36","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"5475.36","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"963","Source":"MNL","Destination":"DVO","DepartureTimeStamp":"2016-11-30T0700","ArrivalTimeStamp":"2016-11-30T0855","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_963_151_07:00_$39_DVO_CEB_598_151_16:55__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"},{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"598","Source":"DVO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1655","ArrivalTimeStamp":"2016-11-30T1800","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_963_151_07:00_$39_DVO_CEB_598_151_16:55__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"4098.00","TaxFee":"1327.36","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"5475.36","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2967","Source":"MNL","Destination":"BXU","DepartureTimeStamp":"2016-11-30T0510","ArrivalTimeStamp":"2016-11-30T0635","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_BXU_2967_139_05:10_$22_BXU_CEB_2362_139_10:05__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2362","Source":"BXU","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1005","ArrivalTimeStamp":"2016-11-30T1050","Class":"N","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_BXU_2967_139_05:10_$22_BXU_CEB_2362_139_10:05__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"4676.00","TaxFee":"875.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"5601.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"1809","Source":"MNL","Destination":"DVO","DepartureTimeStamp":"2016-11-30T0400","ArrivalTimeStamp":"2016-11-30T0550","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_DVO_1809_139_04:00_$22_DVO_CEB_2364_139_10:30__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2364","Source":"DVO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1030","ArrivalTimeStamp":"2016-11-30T1140","Class":"T","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_DVO_1809_139_04:00_$22_DVO_CEB_2364_139_10:30__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"4686.00","TaxFee":"876.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"5612.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2525","Source":"MNL","Destination":"CGY","DepartureTimeStamp":"2016-11-30T1420","ArrivalTimeStamp":"2016-11-30T1555","Class":"B","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CGY_2525_139_14:20_$22_CGY_CEB_2298_139_19:30__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2298","Source":"CGY","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1930","ArrivalTimeStamp":"2016-11-30T2015","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CGY_2525_139_14:20_$22_CGY_CEB_2298_139_19:30__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"4736.00","TaxFee":"882.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"5668.00","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"977","Source":"MNL","Destination":"DVO","DepartureTimeStamp":"2016-11-30T1525","ArrivalTimeStamp":"2016-11-30T1720","Class":"C","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_977_151_15:25_$39_DVO_CEB_596_151_19:30__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"},{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"596","Source":"DVO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1930","ArrivalTimeStamp":"2016-11-30T2030","Class":"TA","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_977_151_15:25_$39_DVO_CEB_596_151_19:30__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"4287.00","TaxFee":"1350.04","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"5687.04","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"959","Source":"MNL","Destination":"DVO","DepartureTimeStamp":"2016-11-30T0435","ArrivalTimeStamp":"2016-11-30T0625","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_959_151_04:35_$39_DVO_CEB_600_151_10:20__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"},{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"600","Source":"DVO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1020","ArrivalTimeStamp":"2016-11-30T1120","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_959_151_04:35_$39_DVO_CEB_600_151_10:20__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"4398.00","TaxFee":"1363.36","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"5811.36","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"961","Source":"MNL","Destination":"DVO","DepartureTimeStamp":"2016-11-30T0345","ArrivalTimeStamp":"2016-11-30T0535","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_961_151_03:45_$39_DVO_CEB_600_151_10:20__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"},{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"600","Source":"DVO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1020","ArrivalTimeStamp":"2016-11-30T1120","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_961_151_03:45_$39_DVO_CEB_600_151_10:20__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"4398.00","TaxFee":"1363.36","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"5811.36","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"963","Source":"MNL","Destination":"DVO","DepartureTimeStamp":"2016-11-30T0700","ArrivalTimeStamp":"2016-11-30T0855","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_963_151_07:00_$39_DVO_CEB_600_151_10:20__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"},{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"600","Source":"DVO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1020","ArrivalTimeStamp":"2016-11-30T1120","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_963_151_07:00_$39_DVO_CEB_600_151_10:20__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"4398.00","TaxFee":"1363.36","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"5811.36","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"975","Source":"MNL","Destination":"DVO","DepartureTimeStamp":"2016-11-30T0930","ArrivalTimeStamp":"2016-11-30T1120","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_975_151_09:30_$39_DVO_CEB_598_151_16:55__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"},{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"598","Source":"DVO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1655","ArrivalTimeStamp":"2016-11-30T1800","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_975_151_09:30_$39_DVO_CEB_598_151_16:55__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"4398.00","TaxFee":"1363.36","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"5811.36","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2521","Source":"MNL","Destination":"CGY","DepartureTimeStamp":"2016-11-30T0900","ArrivalTimeStamp":"2016-11-30T1035","Class":"X","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CGY_2521_139_09:00_$22_CGY_CEB_2294_139_13:00__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2294","Source":"CGY","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1300","ArrivalTimeStamp":"2016-11-30T1345","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CGY_2521_139_09:00_$22_CGY_CEB_2294_139_13:00__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"4906.00","TaxFee":"902.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"5858.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2143","Source":"MNL","Destination":"ILO","DepartureTimeStamp":"2016-11-30T1205","ArrivalTimeStamp":"2016-11-30T1320","Class":"H","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_ILO_2143_139_12:05_$22_ILO_CEB_2387_139_16:30__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2387","Source":"ILO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1630","ArrivalTimeStamp":"2016-11-30T1720","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_ILO_2143_139_12:05_$22_ILO_CEB_2387_139_16:30__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"5056.00","TaxFee":"920.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"6026.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2981","Source":"MNL","Destination":"TAC","DepartureTimeStamp":"2016-11-30T0445","ArrivalTimeStamp":"2016-11-30T0600","Class":"X","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_TAC_2981_139_04:45_$22_TAC_CEB_2237_139_09:05__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2237","Source":"TAC","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0905","ArrivalTimeStamp":"2016-11-30T0950","Class":"V","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_TAC_2981_139_04:45_$22_TAC_CEB_2237_139_09:05__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"5176.00","TaxFee":"935.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"6161.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"1811","Source":"MNL","Destination":"DVO","DepartureTimeStamp":"2016-11-30T0640","ArrivalTimeStamp":"2016-11-30T0830","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_DVO_1811_139_06:40_$22_DVO_CEB_2364_139_10:30__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2364","Source":"DVO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1030","ArrivalTimeStamp":"2016-11-30T1140","Class":"T","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_DVO_1811_139_06:40_$22_DVO_CEB_2364_139_10:30__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"5216.00","TaxFee":"939.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"6205.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"1853","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1055","ArrivalTimeStamp":"2016-11-30T1210","Class":"S","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CEB_1853_139_10:55__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"5468.00","TaxFee":"906.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"6424.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2133","Source":"MNL","Destination":"BCD","DepartureTimeStamp":"2016-11-30T1230","ArrivalTimeStamp":"2016-11-30T1345","Class":"M","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_BCD_2133_139_12:30_$22_BCD_CEB_2290_139_16:35__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2290","Source":"BCD","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1635","ArrivalTimeStamp":"2016-11-30T1720","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_BCD_2133_139_12:30_$22_BCD_CEB_2290_139_16:35__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"5796.00","TaxFee":"1009.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"6855.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"1815","Source":"MNL","Destination":"DVO","DepartureTimeStamp":"2016-11-30T1200","ArrivalTimeStamp":"2016-11-30T1350","Class":"B","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_DVO_1815_139_12:00_$22_DVO_CEB_2366_139_16:15__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2366","Source":"DVO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1615","ArrivalTimeStamp":"2016-11-30T1725","Class":"T","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_DVO_1815_139_12:00_$22_DVO_CEB_2366_139_16:15__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"5816.00","TaxFee":"1011.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"6877.00","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"951","Source":"MNL","Destination":"DVO","DepartureTimeStamp":"2016-11-30T1205","ArrivalTimeStamp":"2016-11-30T1355","Class":"Y","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_951_151_12:05_$39_DVO_CEB_596_151_19:30__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"},{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"596","Source":"DVO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1930","ArrivalTimeStamp":"2016-11-30T2030","Class":"TA","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_951_151_12:05_$39_DVO_CEB_596_151_19:30__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"9687.00","TaxFee":"1998.04","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"11735.04","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"951","Source":"MNL","Destination":"DVO","DepartureTimeStamp":"2016-11-30T1205","ArrivalTimeStamp":"2016-11-30T1355","Class":"Y","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_951_151_12:05_$39_DVO_CEB_598_151_16:55__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"},{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"598","Source":"DVO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1655","ArrivalTimeStamp":"2016-11-30T1800","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_951_151_12:05_$39_DVO_CEB_598_151_16:55__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"10098.00","TaxFee":"2047.36","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"12195.36","is_available":0}}]},{"return":[{"Flights":[{"Carrier":"Air Asia Zest","CarrierID":"Z2","FlightNumber":"764","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T0750","ArrivalTimeStamp":"2016-12-07T0915","Class":"O","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$38_CEB_MNL_764_158_07:50__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"793.75","TaxFee":"459.25","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"1303.00","is_available":1}},{"Flights":[{"Carrier":"Air Asia Zest","CarrierID":"Z2","FlightNumber":"772","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T2120","ArrivalTimeStamp":"2016-12-07T2245","Class":"O","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$38_CEB_MNL_772_158_21:20__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"793.75","TaxFee":"459.25","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"1303.00","is_available":1}},{"Flights":[{"Carrier":"Air Asia Zest","CarrierID":"Z2","FlightNumber":"776","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1230","ArrivalTimeStamp":"2016-12-07T1355","Class":"O","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$38_CEB_MNL_776_158_12:30__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"793.75","TaxFee":"459.25","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"1303.00","is_available":1}},{"Flights":[{"Carrier":"Air Asia Zest","CarrierID":"Z2","FlightNumber":"780","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T0645","ArrivalTimeStamp":"2016-12-07T0810","Class":"O","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$38_CEB_MNL_780_158_06:45__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"793.75","TaxFee":"459.25","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"1303.00","is_available":1}},{"Flights":[{"Carrier":"Air Asia Zest","CarrierID":"Z2","FlightNumber":"782","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1030","ArrivalTimeStamp":"2016-12-07T1200","Class":"O","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$38_CEB_MNL_782_158_10:30__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"793.75","TaxFee":"459.25","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"1303.00","is_available":1}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"556","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T2145","ArrivalTimeStamp":"2016-12-07T2310","Class":"TC","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_MNL_556_151_21:45__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"988.00","TaxFee":"706.56","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"1744.56","is_available":1}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"564","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T0600","ArrivalTimeStamp":"2016-12-07T0720","Class":"TC","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_MNL_564_151_06:00__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"988.00","TaxFee":"706.56","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"1744.56","is_available":1}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"568","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1035","ArrivalTimeStamp":"2016-12-07T1200","Class":"TC","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_MNL_568_151_10:35__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"988.00","TaxFee":"706.56","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"1744.56","is_available":1}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"586","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T0415","ArrivalTimeStamp":"2016-12-07T0540","Class":"TC","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_MNL_586_151_04:15__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"988.00","TaxFee":"706.56","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"1744.56","is_available":1}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"588","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T2255","ArrivalTimeStamp":"2016-12-08T0015","Class":"TC","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_MNL_588_151_22:55__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"988.00","TaxFee":"706.56","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"1744.56","is_available":1}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"554","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T0435","ArrivalTimeStamp":"2016-12-07T0550","Class":"TA","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_MNL_554_151_04:35__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"1188.00","TaxFee":"730.56","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"1968.56","is_available":1}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"578","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1035","ArrivalTimeStamp":"2016-12-07T1150","Class":"TA","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_MNL_578_151_10:35__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"1188.00","TaxFee":"730.56","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"1968.56","is_available":1}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"1836","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T0450","ArrivalTimeStamp":"2016-12-07T0600","Class":"T","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_MNL_1836_139_04:50__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"1418.00","TaxFee":"535.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"2003.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2868","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T2200","ArrivalTimeStamp":"2016-12-07T2315","Class":"T","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_MNL_2868_139_22:00__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"1418.00","TaxFee":"535.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"2003.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2880","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1905","ArrivalTimeStamp":"2016-12-07T2040","Class":"T","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_MNL_2880_139_19:05__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"1418.00","TaxFee":"535.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"2003.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2864","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T2030","ArrivalTimeStamp":"2016-12-07T2145","Class":"T","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_MNL_2864_139_20:30__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"1648.00","TaxFee":"562.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"2260.00","is_available":0}},{"Flights":[{"Carrier":"Air Asia Zest","CarrierID":"Z2","FlightNumber":"768","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T2020","ArrivalTimeStamp":"2016-12-07T2145","Class":"Z","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$38_CEB_MNL_768_158_20:20__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"1778.00","TaxFee":"577.36","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"2405.36","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"562","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T0810","ArrivalTimeStamp":"2016-12-07T0930","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_MNL_562_151_08:10__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"1789.00","TaxFee":"802.68","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"2641.68","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"566","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1410","ArrivalTimeStamp":"2016-12-07T1535","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_MNL_566_151_14:10__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"1789.00","TaxFee":"802.68","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"2641.68","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"570","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1810","ArrivalTimeStamp":"2016-12-07T1930","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_MNL_570_151_18:10__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"1789.00","TaxFee":"802.68","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"2641.68","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"572","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1555","ArrivalTimeStamp":"2016-12-07T1715","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_MNL_572_151_15:55__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"1789.00","TaxFee":"802.68","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"2641.68","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"580","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1150","ArrivalTimeStamp":"2016-12-07T1305","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_MNL_580_151_11:50__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"1789.00","TaxFee":"802.68","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"2641.68","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"1854","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1325","ArrivalTimeStamp":"2016-12-07T1440","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_MNL_1854_139_13:25__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"2138.00","TaxFee":"621.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"2809.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2842","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T0640","ArrivalTimeStamp":"2016-12-07T0755","Class":"X","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_MNL_2842_139_06:40__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"2428.00","TaxFee":"656.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"3134.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2862","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1755","ArrivalTimeStamp":"2016-12-07T1910","Class":"X","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_MNL_2862_139_17:55__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"2428.00","TaxFee":"656.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"3134.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"249","Source":"CEB","Destination":"KLO","DepartureTimeStamp":"2016-12-07T1705","ArrivalTimeStamp":"2016-12-07T1820","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_KLO_249_139_17:05_$22_KLO_MNL_2972_139_20:00__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2972","Source":"KLO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T2000","ArrivalTimeStamp":"2016-12-07T2100","Class":"T","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_KLO_249_139_17:05_$22_KLO_MNL_2972_139_20:00__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"2406.00","TaxFee":"717.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"3173.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2846","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T0855","ArrivalTimeStamp":"2016-12-07T1010","Class":"B","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_MNL_2846_139_08:55__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"2728.00","TaxFee":"692.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"3470.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2850","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1100","ArrivalTimeStamp":"2016-12-07T1215","Class":"B","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_MNL_2850_139_11:00__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"2728.00","TaxFee":"692.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"3470.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2860","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1625","ArrivalTimeStamp":"2016-12-07T1740","Class":"B","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_MNL_2860_139_16:25__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"2728.00","TaxFee":"692.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"3470.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2289","Source":"CEB","Destination":"BCD","DepartureTimeStamp":"2016-12-07T1510","ArrivalTimeStamp":"2016-12-07T1555","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_BCD_2289_139_15:10_$22_BCD_MNL_2136_139_17:50__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2136","Source":"BCD","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1750","ArrivalTimeStamp":"2016-12-07T1905","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_BCD_2289_139_15:10_$22_BCD_MNL_2136_139_17:50__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"2716.00","TaxFee":"754.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"3520.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2285","Source":"CEB","Destination":"BCD","DepartureTimeStamp":"2016-12-07T0540","ArrivalTimeStamp":"2016-12-07T0625","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_BCD_2285_139_05:40_$22_BCD_MNL_2132_139_10:15__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2132","Source":"BCD","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1015","ArrivalTimeStamp":"2016-12-07T1130","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_BCD_2285_139_05:40_$22_BCD_MNL_2132_139_10:15__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"2976.00","TaxFee":"786.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"3812.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2287","Source":"CEB","Destination":"BCD","DepartureTimeStamp":"2016-12-07T1030","ArrivalTimeStamp":"2016-12-07T1120","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_BCD_2287_139_10:30_$22_BCD_MNL_2134_139_15:15__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2134","Source":"BCD","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1515","ArrivalTimeStamp":"2016-12-07T1630","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_BCD_2287_139_10:30_$22_BCD_MNL_2134_139_15:15__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"2976.00","TaxFee":"786.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"3812.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2386","Source":"CEB","Destination":"ILO","DepartureTimeStamp":"2016-12-07T1520","ArrivalTimeStamp":"2016-12-07T1610","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_ILO_2386_139_15:20_$22_ILO_MNL_2146_139_18:40__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2146","Source":"ILO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1840","ArrivalTimeStamp":"2016-12-07T1955","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_ILO_2386_139_15:20_$22_ILO_MNL_2146_139_18:40__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"2996.00","TaxFee":"788.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"3834.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2386","Source":"CEB","Destination":"ILO","DepartureTimeStamp":"2016-12-07T1520","ArrivalTimeStamp":"2016-12-07T1610","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_ILO_2386_139_15:20_$22_ILO_MNL_2148_139_20:35__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2148","Source":"ILO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T2035","ArrivalTimeStamp":"2016-12-07T2145","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_ILO_2386_139_15:20_$22_ILO_MNL_2148_139_20:35__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"2996.00","TaxFee":"788.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"3834.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2238","Source":"CEB","Destination":"TAC","DepartureTimeStamp":"2016-12-07T1300","ArrivalTimeStamp":"2016-12-07T1345","Class":"T","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_TAC_2238_139_13:00_$22_TAC_MNL_2988_139_18:25__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2988","Source":"TAC","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1825","ArrivalTimeStamp":"2016-12-07T1940","Class":"T","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_TAC_2238_139_13:00_$22_TAC_MNL_2988_139_18:25__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"3036.00","TaxFee":"793.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"3879.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2380","Source":"CEB","Destination":"ILO","DepartureTimeStamp":"2016-12-07T0540","ArrivalTimeStamp":"2016-12-07T0630","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_ILO_2380_139_05:40_$22_ILO_MNL_2142_139_10:15__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2142","Source":"ILO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1015","ArrivalTimeStamp":"2016-12-07T1130","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_ILO_2380_139_05:40_$22_ILO_MNL_2142_139_10:15__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"3336.00","TaxFee":"829.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"4215.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2384","Source":"CEB","Destination":"ILO","DepartureTimeStamp":"2016-12-07T1220","ArrivalTimeStamp":"2016-12-07T1305","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_ILO_2384_139_12:20_$22_ILO_MNL_2144_139_14:00__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2144","Source":"ILO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1400","ArrivalTimeStamp":"2016-12-07T1515","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_ILO_2384_139_12:20_$22_ILO_MNL_2144_139_14:00__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"3336.00","TaxFee":"829.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"4215.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"828","Source":"CEB","Destination":"DVO","DepartureTimeStamp":"2016-12-07T2040","ArrivalTimeStamp":"2016-12-07T2140","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_DVO_828_139_20:40_$22_DVO_MNL_2824_139_22:15__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2824","Source":"DVO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T2215","ArrivalTimeStamp":"2016-12-08T0005","Class":"T","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_DVO_828_139_20:40_$22_DVO_MNL_2824_139_22:15__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"3536.00","TaxFee":"853.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"4439.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2297","Source":"CEB","Destination":"CGY","DepartureTimeStamp":"2016-12-07T1805","ArrivalTimeStamp":"2016-12-07T1850","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_CGY_2297_139_18:05_$22_CGY_MNL_2530_139_21:55__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2530","Source":"CGY","Destination":"MNL","DepartureTimeStamp":"2016-12-07T2155","ArrivalTimeStamp":"2016-12-07T2325","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_CGY_2297_139_18:05_$22_CGY_MNL_2530_139_21:55__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"3606.00","TaxFee":"861.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"4517.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2238","Source":"CEB","Destination":"TAC","DepartureTimeStamp":"2016-12-07T1300","ArrivalTimeStamp":"2016-12-07T1345","Class":"T","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_TAC_2238_139_13:00_$22_TAC_MNL_2986_139_14:55__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2986","Source":"TAC","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1455","ArrivalTimeStamp":"2016-12-07T1615","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_TAC_2238_139_13:00_$22_TAC_MNL_2986_139_14:55__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"3616.00","TaxFee":"862.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"4528.00","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"599","Source":"CEB","Destination":"DVO","DepartureTimeStamp":"2016-12-07T1150","ArrivalTimeStamp":"2016-12-07T1250","Class":"TA","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_599_151_11:50_$39_DVO_MNL_956_151_16:25__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"},{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"956","Source":"DVO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1625","ArrivalTimeStamp":"2016-12-07T1825","Class":"Z","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_599_151_11:50_$39_DVO_MNL_956_151_16:25__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"3387.00","TaxFee":"1357.04","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"4794.04","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2293","Source":"CEB","Destination":"CGY","DepartureTimeStamp":"2016-12-07T1130","ArrivalTimeStamp":"2016-12-07T1215","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_CGY_2293_139_11:30_$22_CGY_MNL_2526_139_16:35__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2526","Source":"CGY","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1635","ArrivalTimeStamp":"2016-12-07T1805","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_CGY_2293_139_11:30_$22_CGY_MNL_2526_139_16:35__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"3906.00","TaxFee":"897.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"4853.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2295","Source":"CEB","Destination":"CGY","DepartureTimeStamp":"2016-12-07T0550","ArrivalTimeStamp":"2016-12-07T0635","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_CGY_2295_139_05:50_$22_CGY_MNL_2522_139_11:10__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2522","Source":"CGY","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1110","ArrivalTimeStamp":"2016-12-07T1240","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_CGY_2295_139_05:50_$22_CGY_MNL_2522_139_11:10__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"3906.00","TaxFee":"897.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"4853.00","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"595","Source":"CEB","Destination":"DVO","DepartureTimeStamp":"2016-12-07T1755","ArrivalTimeStamp":"2016-12-07T1900","Class":"TA","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_595_151_17:55_$39_DVO_MNL_982_151_23:30__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"},{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"982","Source":"DVO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T2330","ArrivalTimeStamp":"2016-12-08T0120","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_595_151_17:55_$39_DVO_MNL_982_151_23:30__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"3687.00","TaxFee":"1393.04","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"5130.04","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"597","Source":"CEB","Destination":"DVO","DepartureTimeStamp":"2016-12-07T1520","ArrivalTimeStamp":"2016-12-07T1625","Class":"TA","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_597_151_15:20_$39_DVO_MNL_978_151_17:50__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"},{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"978","Source":"DVO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1750","ArrivalTimeStamp":"2016-12-07T1945","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_597_151_15:20_$39_DVO_MNL_978_151_17:50__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"3687.00","TaxFee":"1393.04","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"5130.04","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"599","Source":"CEB","Destination":"DVO","DepartureTimeStamp":"2016-12-07T1150","ArrivalTimeStamp":"2016-12-07T1250","Class":"TA","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_599_151_11:50_$39_DVO_MNL_978_151_17:50__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"},{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"978","Source":"DVO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1750","ArrivalTimeStamp":"2016-12-07T1945","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_599_151_11:50_$39_DVO_MNL_978_151_17:50__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"3687.00","TaxFee":"1393.04","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"5130.04","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2365","Source":"CEB","Destination":"DVO","DepartureTimeStamp":"2016-12-07T1425","ArrivalTimeStamp":"2016-12-07T1535","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_DVO_2365_139_14:25_$22_DVO_MNL_2818_139_17:45__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2818","Source":"DVO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1745","ArrivalTimeStamp":"2016-12-07T1935","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_DVO_2365_139_14:25_$22_DVO_MNL_2818_139_17:45__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"4226.00","TaxFee":"936.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"5212.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2365","Source":"CEB","Destination":"DVO","DepartureTimeStamp":"2016-12-07T1425","ArrivalTimeStamp":"2016-12-07T1535","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_DVO_2365_139_14:25_$22_DVO_MNL_2820_139_19:40__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2820","Source":"DVO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1940","ArrivalTimeStamp":"2016-12-07T2130","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_DVO_2365_139_14:25_$22_DVO_MNL_2820_139_19:40__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"4226.00","TaxFee":"936.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"5212.00","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"595","Source":"CEB","Destination":"DVO","DepartureTimeStamp":"2016-12-07T1755","ArrivalTimeStamp":"2016-12-07T1900","Class":"TA","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_595_151_17:55_$39_DVO_MNL_972_151_21:35__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"},{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"972","Source":"DVO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T2135","ArrivalTimeStamp":"2016-12-07T2325","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_595_151_17:55_$39_DVO_MNL_972_151_21:35__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"3987.00","TaxFee":"1429.04","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"5466.04","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"595","Source":"CEB","Destination":"DVO","DepartureTimeStamp":"2016-12-07T1755","ArrivalTimeStamp":"2016-12-07T1900","Class":"TA","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_595_151_17:55_$39_DVO_MNL_974_151_21:00__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"},{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"974","Source":"DVO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T2100","ArrivalTimeStamp":"2016-12-07T2300","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_595_151_17:55_$39_DVO_MNL_974_151_21:00__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"3987.00","TaxFee":"1429.04","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"5466.04","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"597","Source":"CEB","Destination":"DVO","DepartureTimeStamp":"2016-12-07T1520","ArrivalTimeStamp":"2016-12-07T1625","Class":"TA","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_597_151_15:20_$39_DVO_MNL_970_151_19:15__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"},{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"970","Source":"DVO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1915","ArrivalTimeStamp":"2016-12-07T2110","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_597_151_15:20_$39_DVO_MNL_970_151_19:15__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"3987.00","TaxFee":"1429.04","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"5466.04","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"597","Source":"CEB","Destination":"DVO","DepartureTimeStamp":"2016-12-07T1520","ArrivalTimeStamp":"2016-12-07T1625","Class":"TA","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_597_151_15:20_$39_DVO_MNL_972_151_21:35__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"},{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"972","Source":"DVO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T2135","ArrivalTimeStamp":"2016-12-07T2325","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_597_151_15:20_$39_DVO_MNL_972_151_21:35__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"3987.00","TaxFee":"1429.04","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"5466.04","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"597","Source":"CEB","Destination":"DVO","DepartureTimeStamp":"2016-12-07T1520","ArrivalTimeStamp":"2016-12-07T1625","Class":"TA","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_597_151_15:20_$39_DVO_MNL_974_151_21:00__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"},{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"974","Source":"DVO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T2100","ArrivalTimeStamp":"2016-12-07T2300","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_597_151_15:20_$39_DVO_MNL_974_151_21:00__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"3987.00","TaxFee":"1429.04","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"5466.04","is_available":0}},{"Flights":[{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"599","Source":"CEB","Destination":"DVO","DepartureTimeStamp":"2016-12-07T1150","ArrivalTimeStamp":"2016-12-07T1250","Class":"TA","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_599_151_11:50_$39_DVO_MNL_952_151_14:25__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"},{"Carrier":"Cebu Pacific","CarrierID":"5J","FlightNumber":"952","Source":"DVO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1425","ArrivalTimeStamp":"2016-12-07T1620","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_599_151_11:50_$39_DVO_MNL_952_151_14:25__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"3987.00","TaxFee":"1429.04","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"5466.04","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2363","Source":"CEB","Destination":"DVO","DepartureTimeStamp":"2016-12-07T0840","ArrivalTimeStamp":"2016-12-07T0950","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_DVO_2363_139_08:40_$22_DVO_MNL_2814_139_11:40__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2814","Source":"DVO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1140","ArrivalTimeStamp":"2016-12-07T1330","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_DVO_2363_139_08:40_$22_DVO_MNL_2814_139_11:40__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"4756.00","TaxFee":"999.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"5805.00","is_available":0}},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2363","Source":"CEB","Destination":"DVO","DepartureTimeStamp":"2016-12-07T0840","ArrivalTimeStamp":"2016-12-07T0950","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_DVO_2363_139_08:40_$22_DVO_MNL_2816_139_14:20__A1_0_0","WarningText":"","TicketType":"E"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2816","Source":"DVO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1420","ArrivalTimeStamp":"2016-12-07T1555","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_DVO_2363_139_08:40_$22_DVO_MNL_2816_139_14:20__A1_0_0","WarningText":"","TicketType":"E"}],"Pricing":{"currency":"PHP","BaseFareFee":"4756.00","TaxFee":"999.00","SystemFee":"50.00","MarkupFee":"0.00","TotalFee":"5805.00","is_available":0}}]}],"out":{"@attributes":{"RequestTime":"22-11-2016 15:50:27","ResponseTime":"22-11-2016 15:50:29"},"RequestId":"1234568486828","PricedItineraries":{"OnwardPricedItinerary":[{"Flights":{"Flight":{"Carrier":"Philippine Airlines","FlightNumber":"1869","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T2245","ArrivalTimeStamp":"2016-11-30T2355","OperatingCarrier":"PR","Class":"T","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CEB_1869_139_22:45__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"1418.00","SingleAdultVat":"371.00","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"1838.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Air Asia Zest","FlightNumber":"767","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1825","ArrivalTimeStamp":"2016-11-30T1950","OperatingCarrier":"Z2","Class":"Z","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$38_MNL_CEB_767_158_18:25__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"AK"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"1630.00","SingleAdultVat":"395.60","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"2074.60","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Cebu Pacific","FlightNumber":"557","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1925","ArrivalTimeStamp":"2016-11-30T2045","OperatingCarrier":"5J","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_CEB_557_151_19:25__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"1539.00","SingleAdultVat":"608.68","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"2196.68","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Cebu Pacific","FlightNumber":"561","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0045","ArrivalTimeStamp":"2016-11-30T0200","OperatingCarrier":"5J","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_CEB_561_151_00:45__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"1539.00","SingleAdultVat":"608.68","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"2196.68","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Cebu Pacific","FlightNumber":"571","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1750","ArrivalTimeStamp":"2016-11-30T1910","OperatingCarrier":"5J","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_CEB_571_151_17:50__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"1539.00","SingleAdultVat":"608.68","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"2196.68","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Cebu Pacific","FlightNumber":"583","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T2100","ArrivalTimeStamp":"2016-11-30T2220","OperatingCarrier":"5J","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_CEB_583_151_21:00__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"1539.00","SingleAdultVat":"608.68","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"2196.68","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Cebu Pacific","FlightNumber":"589","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T2345","ArrivalTimeStamp":"2016-12-01T0105","OperatingCarrier":"5J","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_CEB_589_151_23:45__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"1539.00","SingleAdultVat":"608.68","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"2196.68","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Air Asia Zest","FlightNumber":"771","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1930","ArrivalTimeStamp":"2016-11-30T2055","OperatingCarrier":"Z2","Class":"I","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$38_MNL_CEB_771_158_19:30__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"AK"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"1880.00","SingleAdultVat":"425.60","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"2354.60","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Air Asia Zest","FlightNumber":"775","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1040","ArrivalTimeStamp":"2016-11-30T1205","OperatingCarrier":"Z2","Class":"I","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$38_MNL_CEB_775_158_10:40__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"AK"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"1880.00","SingleAdultVat":"425.60","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"2354.60","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Air Asia Zest","FlightNumber":"781","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0835","ArrivalTimeStamp":"2016-11-30T1000","OperatingCarrier":"Z2","Class":"I","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$38_MNL_CEB_781_158_08:35__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"AK"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"1880.00","SingleAdultVat":"425.60","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"2354.60","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Air Asia Zest","FlightNumber":"783","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1240","ArrivalTimeStamp":"2016-11-30T1410","OperatingCarrier":"Z2","Class":"I","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$38_MNL_CEB_783_158_12:40__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"AK"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"1880.00","SingleAdultVat":"425.60","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"2354.60","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Cebu Pacific","FlightNumber":"553","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1005","ArrivalTimeStamp":"2016-11-30T1120","OperatingCarrier":"5J","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_CEB_553_151_10:05__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"1789.00","SingleAdultVat":"638.68","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"2476.68","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Cebu Pacific","FlightNumber":"565","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1215","ArrivalTimeStamp":"2016-11-30T1340","OperatingCarrier":"5J","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_CEB_565_151_12:15__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"1789.00","SingleAdultVat":"638.68","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"2476.68","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Cebu Pacific","FlightNumber":"569","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1620","ArrivalTimeStamp":"2016-11-30T1740","OperatingCarrier":"5J","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_CEB_569_151_16:20__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"1789.00","SingleAdultVat":"638.68","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"2476.68","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Cebu Pacific","FlightNumber":"581","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1340","ArrivalTimeStamp":"2016-11-30T1455","OperatingCarrier":"5J","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_CEB_581_151_13:40__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"1789.00","SingleAdultVat":"638.68","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"2476.68","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Air Asia Zest","FlightNumber":"763","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0600","ArrivalTimeStamp":"2016-11-30T0725","OperatingCarrier":"Z2","Class":"A","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$38_MNL_CEB_763_158_06:00__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"AK"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"2130.00","SingleAdultVat":"455.60","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"2634.60","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Philippine Airlines","FlightNumber":"1843","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0555","ArrivalTimeStamp":"2016-11-30T0710","OperatingCarrier":"PR","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CEB_1843_139_05:55__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"2138.00","SingleAdultVat":"457.00","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"2644.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Philippine Airlines","FlightNumber":"2841","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0500","ArrivalTimeStamp":"2016-11-30T0615","OperatingCarrier":"PR","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CEB_2841_139_05:00__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"2138.00","SingleAdultVat":"457.00","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"2644.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Philippine Airlines","FlightNumber":"2861","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1600","ArrivalTimeStamp":"2016-11-30T1715","OperatingCarrier":"PR","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CEB_2861_139_16:00__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"2138.00","SingleAdultVat":"457.00","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"2644.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Cebu Pacific","FlightNumber":"555","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0850","ArrivalTimeStamp":"2016-11-30T1005","OperatingCarrier":"5J","Class":"C","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_CEB_555_151_08:50__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"2069.00","SingleAdultVat":"672.28","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"2790.28","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Cebu Pacific","FlightNumber":"563","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0415","ArrivalTimeStamp":"2016-11-30T0530","OperatingCarrier":"5J","Class":"C","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_CEB_563_151_04:15__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"2069.00","SingleAdultVat":"672.28","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"2790.28","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Philippine Airlines","FlightNumber":"2835","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0400","ArrivalTimeStamp":"2016-11-30T0510","OperatingCarrier":"PR","Class":"X","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CEB_2835_139_04:00__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"2428.00","SingleAdultVat":"492.00","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"2969.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Philippine Airlines","FlightNumber":"2863","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1745","ArrivalTimeStamp":"2016-11-30T1900","OperatingCarrier":"PR","Class":"X","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CEB_2863_139_17:45__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"2428.00","SingleAdultVat":"492.00","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"2969.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Philippine Airlines","FlightNumber":"2867","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T2000","ArrivalTimeStamp":"2016-11-30T2115","OperatingCarrier":"PR","Class":"X","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CEB_2867_139_20:00__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"2428.00","SingleAdultVat":"492.00","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"2969.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Cebu Pacific","FlightNumber":"567","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0835","ArrivalTimeStamp":"2016-11-30T1000","OperatingCarrier":"5J","Class":"V","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_CEB_567_151_08:35__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"2349.00","SingleAdultVat":"705.88","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"3103.88","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Philippine Airlines","FlightNumber":"2845","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0715","ArrivalTimeStamp":"2016-11-30T0815","OperatingCarrier":"PR","Class":"B","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CEB_2845_139_07:15__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"2728.00","SingleAdultVat":"528.00","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"3305.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Philippine Airlines","FlightNumber":"2859","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1430","ArrivalTimeStamp":"2016-11-30T1545","OperatingCarrier":"PR","Class":"B","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CEB_2859_139_14:30__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"2728.00","SingleAdultVat":"528.00","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"3305.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"2129","Source":"MNL","Destination":"BCD","DepartureTimeStamp":"2016-11-30T0415","ArrivalTimeStamp":"2016-11-30T0530","OperatingCarrier":"PR","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_BCD_2129_139_04:15_$22_BCD_CEB_2286_139_07:05__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2286","Source":"BCD","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0705","ArrivalTimeStamp":"2016-11-30T0750","OperatingCarrier":"PR","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_BCD_2129_139_04:15_$22_BCD_CEB_2286_139_07:05__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"2976.00","SingleAdultVat":"573.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"3647.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"2969","Source":"MNL","Destination":"KLO","DepartureTimeStamp":"2016-11-30T0810","ArrivalTimeStamp":"2016-11-30T0915","OperatingCarrier":"PR","Class":"X","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_KLO_2969_139_08:10_$22_KLO_CEB_242_139_12:15__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"242","Source":"KLO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1215","ArrivalTimeStamp":"2016-11-30T1315","OperatingCarrier":"PR","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_KLO_2969_139_08:10_$22_KLO_CEB_242_139_12:15__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"3286.00","SingleAdultVat":"610.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"3994.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"2139","Source":"MNL","Destination":"ILO","DepartureTimeStamp":"2016-11-30T0430","ArrivalTimeStamp":"2016-11-30T0540","OperatingCarrier":"PR","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_ILO_2139_139_04:30_$22_ILO_CEB_2381_139_06:50__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2381","Source":"ILO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0650","ArrivalTimeStamp":"2016-11-30T0740","OperatingCarrier":"PR","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_ILO_2139_139_04:30_$22_ILO_CEB_2381_139_06:50__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"3336.00","SingleAdultVat":"616.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"4050.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Philippine Airlines","FlightNumber":"2849","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0855","ArrivalTimeStamp":"2016-11-30T1010","OperatingCarrier":"PR","Class":"Q","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CEB_2849_139_08:55__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"3458.00","SingleAdultVat":"615.00","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"4122.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"2131","Source":"MNL","Destination":"BCD","DepartureTimeStamp":"2016-11-30T0755","ArrivalTimeStamp":"2016-11-30T0910","OperatingCarrier":"PR","Class":"B","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_BCD_2131_139_07:55_$22_BCD_CEB_2288_139_11:40__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2288","Source":"BCD","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1140","ArrivalTimeStamp":"2016-11-30T1230","OperatingCarrier":"PR","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_BCD_2131_139_07:55_$22_BCD_CEB_2288_139_11:40__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"3566.00","SingleAdultVat":"643.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"4307.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"2141","Source":"MNL","Destination":"ILO","DepartureTimeStamp":"2016-11-30T0815","ArrivalTimeStamp":"2016-11-30T0930","OperatingCarrier":"PR","Class":"B","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_ILO_2141_139_08:15_$22_ILO_CEB_2385_139_13:45__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2385","Source":"ILO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1345","ArrivalTimeStamp":"2016-11-30T1430","OperatingCarrier":"PR","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_ILO_2141_139_08:15_$22_ILO_CEB_2385_139_13:45__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"3936.00","SingleAdultVat":"688.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"4722.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"2519","Source":"MNL","Destination":"CGY","DepartureTimeStamp":"2016-11-30T0410","ArrivalTimeStamp":"2016-11-30T0545","OperatingCarrier":"PR","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CGY_2519_139_04:10_$22_CGY_CEB_2296_139_07:15__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2296","Source":"CGY","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0715","ArrivalTimeStamp":"2016-11-30T0800","OperatingCarrier":"PR","Class":"T","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CGY_2519_139_04:10_$22_CGY_CEB_2296_139_07:15__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"4226.00","SingleAdultVat":"723.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"5047.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Cebu Pacific","FlightNumber":"961","Source":"MNL","Destination":"DVO","DepartureTimeStamp":"2016-11-30T0345","ArrivalTimeStamp":"2016-11-30T0535","OperatingCarrier":"5J","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_961_151_03:45_$39_DVO_CEB_594_151_06:35__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"},{"Carrier":"Cebu Pacific","FlightNumber":"594","Source":"DVO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0635","ArrivalTimeStamp":"2016-11-30T0735","OperatingCarrier":"5J","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_961_151_03:45_$39_DVO_CEB_594_151_06:35__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"4098.00","SingleAdultVat":"1229.36","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"5425.36","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Cebu Pacific","FlightNumber":"963","Source":"MNL","Destination":"DVO","DepartureTimeStamp":"2016-11-30T0700","ArrivalTimeStamp":"2016-11-30T0855","OperatingCarrier":"5J","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_963_151_07:00_$39_DVO_CEB_598_151_16:55__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"},{"Carrier":"Cebu Pacific","FlightNumber":"598","Source":"DVO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1655","ArrivalTimeStamp":"2016-11-30T1800","OperatingCarrier":"5J","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_963_151_07:00_$39_DVO_CEB_598_151_16:55__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"4098.00","SingleAdultVat":"1229.36","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"5425.36","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"2967","Source":"MNL","Destination":"BXU","DepartureTimeStamp":"2016-11-30T0510","ArrivalTimeStamp":"2016-11-30T0635","OperatingCarrier":"PR","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_BXU_2967_139_05:10_$22_BXU_CEB_2362_139_10:05__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2362","Source":"BXU","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1005","ArrivalTimeStamp":"2016-11-30T1050","OperatingCarrier":"PR","Class":"N","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_BXU_2967_139_05:10_$22_BXU_CEB_2362_139_10:05__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"4676.00","SingleAdultVat":"777.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"5551.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"1809","Source":"MNL","Destination":"DVO","DepartureTimeStamp":"2016-11-30T0400","ArrivalTimeStamp":"2016-11-30T0550","OperatingCarrier":"PR","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_DVO_1809_139_04:00_$22_DVO_CEB_2364_139_10:30__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2364","Source":"DVO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1030","ArrivalTimeStamp":"2016-11-30T1140","OperatingCarrier":"PR","Class":"T","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_DVO_1809_139_04:00_$22_DVO_CEB_2364_139_10:30__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"4686.00","SingleAdultVat":"778.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"5562.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"2525","Source":"MNL","Destination":"CGY","DepartureTimeStamp":"2016-11-30T1420","ArrivalTimeStamp":"2016-11-30T1555","OperatingCarrier":"PR","Class":"B","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CGY_2525_139_14:20_$22_CGY_CEB_2298_139_19:30__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2298","Source":"CGY","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1930","ArrivalTimeStamp":"2016-11-30T2015","OperatingCarrier":"PR","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CGY_2525_139_14:20_$22_CGY_CEB_2298_139_19:30__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"4736.00","SingleAdultVat":"784.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"5618.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Cebu Pacific","FlightNumber":"977","Source":"MNL","Destination":"DVO","DepartureTimeStamp":"2016-11-30T1525","ArrivalTimeStamp":"2016-11-30T1720","OperatingCarrier":"5J","Class":"C","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_977_151_15:25_$39_DVO_CEB_596_151_19:30__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"},{"Carrier":"Cebu Pacific","FlightNumber":"596","Source":"DVO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1930","ArrivalTimeStamp":"2016-11-30T2030","OperatingCarrier":"5J","Class":"TA","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_977_151_15:25_$39_DVO_CEB_596_151_19:30__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"4287.00","SingleAdultVat":"1252.04","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"5637.04","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Cebu Pacific","FlightNumber":"959","Source":"MNL","Destination":"DVO","DepartureTimeStamp":"2016-11-30T0435","ArrivalTimeStamp":"2016-11-30T0625","OperatingCarrier":"5J","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_959_151_04:35_$39_DVO_CEB_600_151_10:20__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"},{"Carrier":"Cebu Pacific","FlightNumber":"600","Source":"DVO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1020","ArrivalTimeStamp":"2016-11-30T1120","OperatingCarrier":"5J","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_959_151_04:35_$39_DVO_CEB_600_151_10:20__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"4398.00","SingleAdultVat":"1265.36","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"5761.36","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Cebu Pacific","FlightNumber":"961","Source":"MNL","Destination":"DVO","DepartureTimeStamp":"2016-11-30T0345","ArrivalTimeStamp":"2016-11-30T0535","OperatingCarrier":"5J","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_961_151_03:45_$39_DVO_CEB_600_151_10:20__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"},{"Carrier":"Cebu Pacific","FlightNumber":"600","Source":"DVO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1020","ArrivalTimeStamp":"2016-11-30T1120","OperatingCarrier":"5J","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_961_151_03:45_$39_DVO_CEB_600_151_10:20__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"4398.00","SingleAdultVat":"1265.36","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"5761.36","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Cebu Pacific","FlightNumber":"963","Source":"MNL","Destination":"DVO","DepartureTimeStamp":"2016-11-30T0700","ArrivalTimeStamp":"2016-11-30T0855","OperatingCarrier":"5J","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_963_151_07:00_$39_DVO_CEB_600_151_10:20__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"},{"Carrier":"Cebu Pacific","FlightNumber":"600","Source":"DVO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1020","ArrivalTimeStamp":"2016-11-30T1120","OperatingCarrier":"5J","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_963_151_07:00_$39_DVO_CEB_600_151_10:20__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"4398.00","SingleAdultVat":"1265.36","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"5761.36","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Cebu Pacific","FlightNumber":"975","Source":"MNL","Destination":"DVO","DepartureTimeStamp":"2016-11-30T0930","ArrivalTimeStamp":"2016-11-30T1120","OperatingCarrier":"5J","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_975_151_09:30_$39_DVO_CEB_598_151_16:55__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"},{"Carrier":"Cebu Pacific","FlightNumber":"598","Source":"DVO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1655","ArrivalTimeStamp":"2016-11-30T1800","OperatingCarrier":"5J","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_975_151_09:30_$39_DVO_CEB_598_151_16:55__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"4398.00","SingleAdultVat":"1265.36","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"5761.36","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"2521","Source":"MNL","Destination":"CGY","DepartureTimeStamp":"2016-11-30T0900","ArrivalTimeStamp":"2016-11-30T1035","OperatingCarrier":"PR","Class":"X","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CGY_2521_139_09:00_$22_CGY_CEB_2294_139_13:00__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2294","Source":"CGY","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1300","ArrivalTimeStamp":"2016-11-30T1345","OperatingCarrier":"PR","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CGY_2521_139_09:00_$22_CGY_CEB_2294_139_13:00__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"4906.00","SingleAdultVat":"804.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"5808.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"2143","Source":"MNL","Destination":"ILO","DepartureTimeStamp":"2016-11-30T1205","ArrivalTimeStamp":"2016-11-30T1320","OperatingCarrier":"PR","Class":"H","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_ILO_2143_139_12:05_$22_ILO_CEB_2387_139_16:30__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2387","Source":"ILO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1630","ArrivalTimeStamp":"2016-11-30T1720","OperatingCarrier":"PR","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_ILO_2143_139_12:05_$22_ILO_CEB_2387_139_16:30__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"5056.00","SingleAdultVat":"822.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"5976.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"2981","Source":"MNL","Destination":"TAC","DepartureTimeStamp":"2016-11-30T0445","ArrivalTimeStamp":"2016-11-30T0600","OperatingCarrier":"PR","Class":"X","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_TAC_2981_139_04:45_$22_TAC_CEB_2237_139_09:05__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2237","Source":"TAC","Destination":"CEB","DepartureTimeStamp":"2016-11-30T0905","ArrivalTimeStamp":"2016-11-30T0950","OperatingCarrier":"PR","Class":"V","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_TAC_2981_139_04:45_$22_TAC_CEB_2237_139_09:05__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"5176.00","SingleAdultVat":"837.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"6111.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"1811","Source":"MNL","Destination":"DVO","DepartureTimeStamp":"2016-11-30T0640","ArrivalTimeStamp":"2016-11-30T0830","OperatingCarrier":"PR","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_DVO_1811_139_06:40_$22_DVO_CEB_2364_139_10:30__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2364","Source":"DVO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1030","ArrivalTimeStamp":"2016-11-30T1140","OperatingCarrier":"PR","Class":"T","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_DVO_1811_139_06:40_$22_DVO_CEB_2364_139_10:30__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"5216.00","SingleAdultVat":"841.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"6155.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Philippine Airlines","FlightNumber":"1853","Source":"MNL","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1055","ArrivalTimeStamp":"2016-11-30T1210","OperatingCarrier":"PR","Class":"S","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_CEB_1853_139_10:55__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"5468.00","SingleAdultVat":"857.00","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"6374.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"2133","Source":"MNL","Destination":"BCD","DepartureTimeStamp":"2016-11-30T1230","ArrivalTimeStamp":"2016-11-30T1345","OperatingCarrier":"PR","Class":"M","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_BCD_2133_139_12:30_$22_BCD_CEB_2290_139_16:35__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2290","Source":"BCD","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1635","ArrivalTimeStamp":"2016-11-30T1720","OperatingCarrier":"PR","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_BCD_2133_139_12:30_$22_BCD_CEB_2290_139_16:35__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"5796.00","SingleAdultVat":"911.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"6805.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"1815","Source":"MNL","Destination":"DVO","DepartureTimeStamp":"2016-11-30T1200","ArrivalTimeStamp":"2016-11-30T1350","OperatingCarrier":"PR","Class":"B","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_DVO_1815_139_12:00_$22_DVO_CEB_2366_139_16:15__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2366","Source":"DVO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1615","ArrivalTimeStamp":"2016-11-30T1725","OperatingCarrier":"PR","Class":"T","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$22_MNL_DVO_1815_139_12:00_$22_DVO_CEB_2366_139_16:15__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"5816.00","SingleAdultVat":"913.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"6827.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Cebu Pacific","FlightNumber":"951","Source":"MNL","Destination":"DVO","DepartureTimeStamp":"2016-11-30T1205","ArrivalTimeStamp":"2016-11-30T1355","OperatingCarrier":"5J","Class":"Y","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_951_151_12:05_$39_DVO_CEB_596_151_19:30__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"},{"Carrier":"Cebu Pacific","FlightNumber":"596","Source":"DVO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1930","ArrivalTimeStamp":"2016-11-30T2030","OperatingCarrier":"5J","Class":"TA","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_951_151_12:05_$39_DVO_CEB_596_151_19:30__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"9687.00","SingleAdultVat":"1900.04","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"11685.04","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Cebu Pacific","FlightNumber":"951","Source":"MNL","Destination":"DVO","DepartureTimeStamp":"2016-11-30T1205","ArrivalTimeStamp":"2016-11-30T1355","OperatingCarrier":"5J","Class":"Y","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_951_151_12:05_$39_DVO_CEB_598_151_16:55__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"},{"Carrier":"Cebu Pacific","FlightNumber":"598","Source":"DVO","Destination":"CEB","DepartureTimeStamp":"2016-11-30T1655","ArrivalTimeStamp":"2016-11-30T1800","OperatingCarrier":"5J","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@O_$39_MNL_DVO_951_151_12:05_$39_DVO_CEB_598_151_16:55__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"10098.00","SingleAdultVat":"1949.36","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"12145.36","SingleAdultCreditCardCharges":"0.00"}}],"ReturnPricedItinerary":[{"Flights":{"Flight":{"Carrier":"Air Asia Zest","FlightNumber":"764","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T0750","ArrivalTimeStamp":"2016-12-07T0915","OperatingCarrier":"Z2","Class":"O","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$38_CEB_MNL_764_158_07:50__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"AK"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"793.75","SingleAdultVat":"410.25","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"1253.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Air Asia Zest","FlightNumber":"772","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T2120","ArrivalTimeStamp":"2016-12-07T2245","OperatingCarrier":"Z2","Class":"O","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$38_CEB_MNL_772_158_21:20__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"AK"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"793.75","SingleAdultVat":"410.25","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"1253.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Air Asia Zest","FlightNumber":"776","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1230","ArrivalTimeStamp":"2016-12-07T1355","OperatingCarrier":"Z2","Class":"O","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$38_CEB_MNL_776_158_12:30__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"AK"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"793.75","SingleAdultVat":"410.25","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"1253.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Air Asia Zest","FlightNumber":"780","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T0645","ArrivalTimeStamp":"2016-12-07T0810","OperatingCarrier":"Z2","Class":"O","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$38_CEB_MNL_780_158_06:45__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"AK"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"793.75","SingleAdultVat":"410.25","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"1253.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Air Asia Zest","FlightNumber":"782","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1030","ArrivalTimeStamp":"2016-12-07T1200","OperatingCarrier":"Z2","Class":"O","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$38_CEB_MNL_782_158_10:30__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"AK"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"793.75","SingleAdultVat":"410.25","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"1253.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Cebu Pacific","FlightNumber":"556","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T2145","ArrivalTimeStamp":"2016-12-07T2310","OperatingCarrier":"5J","Class":"TC","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_MNL_556_151_21:45__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"988.00","SingleAdultVat":"657.56","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"1694.56","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Cebu Pacific","FlightNumber":"564","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T0600","ArrivalTimeStamp":"2016-12-07T0720","OperatingCarrier":"5J","Class":"TC","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_MNL_564_151_06:00__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"988.00","SingleAdultVat":"657.56","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"1694.56","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Cebu Pacific","FlightNumber":"568","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1035","ArrivalTimeStamp":"2016-12-07T1200","OperatingCarrier":"5J","Class":"TC","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_MNL_568_151_10:35__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"988.00","SingleAdultVat":"657.56","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"1694.56","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Cebu Pacific","FlightNumber":"586","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T0415","ArrivalTimeStamp":"2016-12-07T0540","OperatingCarrier":"5J","Class":"TC","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_MNL_586_151_04:15__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"988.00","SingleAdultVat":"657.56","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"1694.56","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Cebu Pacific","FlightNumber":"588","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T2255","ArrivalTimeStamp":"2016-12-08T0015","OperatingCarrier":"5J","Class":"TC","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_MNL_588_151_22:55__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"988.00","SingleAdultVat":"657.56","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"1694.56","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Cebu Pacific","FlightNumber":"554","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T0435","ArrivalTimeStamp":"2016-12-07T0550","OperatingCarrier":"5J","Class":"TA","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_MNL_554_151_04:35__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"1188.00","SingleAdultVat":"681.56","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"1918.56","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Cebu Pacific","FlightNumber":"578","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1035","ArrivalTimeStamp":"2016-12-07T1150","OperatingCarrier":"5J","Class":"TA","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_MNL_578_151_10:35__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"1188.00","SingleAdultVat":"681.56","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"1918.56","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Philippine Airlines","FlightNumber":"1836","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T0450","ArrivalTimeStamp":"2016-12-07T0600","OperatingCarrier":"PR","Class":"T","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_MNL_1836_139_04:50__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"1418.00","SingleAdultVat":"486.00","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"1953.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Philippine Airlines","FlightNumber":"2868","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T2200","ArrivalTimeStamp":"2016-12-07T2315","OperatingCarrier":"PR","Class":"T","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_MNL_2868_139_22:00__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"1418.00","SingleAdultVat":"486.00","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"1953.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Philippine Airlines","FlightNumber":"2880","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1905","ArrivalTimeStamp":"2016-12-07T2040","OperatingCarrier":"PR","Class":"T","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_MNL_2880_139_19:05__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"1418.00","SingleAdultVat":"486.00","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"1953.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Philippine Airlines","FlightNumber":"2864","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T2030","ArrivalTimeStamp":"2016-12-07T2145","OperatingCarrier":"PR","Class":"T","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_MNL_2864_139_20:30__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"1648.00","SingleAdultVat":"513.00","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"2210.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Air Asia Zest","FlightNumber":"768","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T2020","ArrivalTimeStamp":"2016-12-07T2145","OperatingCarrier":"Z2","Class":"Z","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$38_CEB_MNL_768_158_20:20__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"AK"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"1778.00","SingleAdultVat":"528.36","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"2355.36","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Cebu Pacific","FlightNumber":"562","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T0810","ArrivalTimeStamp":"2016-12-07T0930","OperatingCarrier":"5J","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_MNL_562_151_08:10__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"1789.00","SingleAdultVat":"753.68","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"2591.68","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Cebu Pacific","FlightNumber":"566","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1410","ArrivalTimeStamp":"2016-12-07T1535","OperatingCarrier":"5J","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_MNL_566_151_14:10__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"1789.00","SingleAdultVat":"753.68","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"2591.68","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Cebu Pacific","FlightNumber":"570","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1810","ArrivalTimeStamp":"2016-12-07T1930","OperatingCarrier":"5J","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_MNL_570_151_18:10__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"1789.00","SingleAdultVat":"753.68","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"2591.68","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Cebu Pacific","FlightNumber":"572","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1555","ArrivalTimeStamp":"2016-12-07T1715","OperatingCarrier":"5J","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_MNL_572_151_15:55__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"1789.00","SingleAdultVat":"753.68","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"2591.68","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Cebu Pacific","FlightNumber":"580","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1150","ArrivalTimeStamp":"2016-12-07T1305","OperatingCarrier":"5J","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_MNL_580_151_11:50__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"1789.00","SingleAdultVat":"753.68","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"2591.68","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Philippine Airlines","FlightNumber":"1854","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1325","ArrivalTimeStamp":"2016-12-07T1440","OperatingCarrier":"PR","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_MNL_1854_139_13:25__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"2138.00","SingleAdultVat":"572.00","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"2759.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Philippine Airlines","FlightNumber":"2842","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T0640","ArrivalTimeStamp":"2016-12-07T0755","OperatingCarrier":"PR","Class":"X","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_MNL_2842_139_06:40__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"2428.00","SingleAdultVat":"607.00","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"3084.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Philippine Airlines","FlightNumber":"2862","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1755","ArrivalTimeStamp":"2016-12-07T1910","OperatingCarrier":"PR","Class":"X","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_MNL_2862_139_17:55__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"2428.00","SingleAdultVat":"607.00","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"3084.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"249","Source":"CEB","Destination":"KLO","DepartureTimeStamp":"2016-12-07T1705","ArrivalTimeStamp":"2016-12-07T1820","OperatingCarrier":"PR","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_KLO_249_139_17:05_$22_KLO_MNL_2972_139_20:00__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2972","Source":"KLO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T2000","ArrivalTimeStamp":"2016-12-07T2100","OperatingCarrier":"PR","Class":"T","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_KLO_249_139_17:05_$22_KLO_MNL_2972_139_20:00__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"2406.00","SingleAdultVat":"619.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"3123.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Philippine Airlines","FlightNumber":"2846","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T0855","ArrivalTimeStamp":"2016-12-07T1010","OperatingCarrier":"PR","Class":"B","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_MNL_2846_139_08:55__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"2728.00","SingleAdultVat":"643.00","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"3420.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Philippine Airlines","FlightNumber":"2850","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1100","ArrivalTimeStamp":"2016-12-07T1215","OperatingCarrier":"PR","Class":"B","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_MNL_2850_139_11:00__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"2728.00","SingleAdultVat":"643.00","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"3420.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":{"Carrier":"Philippine Airlines","FlightNumber":"2860","Source":"CEB","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1625","ArrivalTimeStamp":"2016-12-07T1740","OperatingCarrier":"PR","Class":"B","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_MNL_2860_139_16:25__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"2728.00","SingleAdultVat":"643.00","SingleAdultTransactionFee":"49.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"3420.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"2289","Source":"CEB","Destination":"BCD","DepartureTimeStamp":"2016-12-07T1510","ArrivalTimeStamp":"2016-12-07T1555","OperatingCarrier":"PR","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_BCD_2289_139_15:10_$22_BCD_MNL_2136_139_17:50__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2136","Source":"BCD","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1750","ArrivalTimeStamp":"2016-12-07T1905","OperatingCarrier":"PR","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_BCD_2289_139_15:10_$22_BCD_MNL_2136_139_17:50__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"2716.00","SingleAdultVat":"656.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"3470.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"2285","Source":"CEB","Destination":"BCD","DepartureTimeStamp":"2016-12-07T0540","ArrivalTimeStamp":"2016-12-07T0625","OperatingCarrier":"PR","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_BCD_2285_139_05:40_$22_BCD_MNL_2132_139_10:15__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2132","Source":"BCD","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1015","ArrivalTimeStamp":"2016-12-07T1130","OperatingCarrier":"PR","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_BCD_2285_139_05:40_$22_BCD_MNL_2132_139_10:15__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"2976.00","SingleAdultVat":"688.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"3762.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"2287","Source":"CEB","Destination":"BCD","DepartureTimeStamp":"2016-12-07T1030","ArrivalTimeStamp":"2016-12-07T1120","OperatingCarrier":"PR","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_BCD_2287_139_10:30_$22_BCD_MNL_2134_139_15:15__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2134","Source":"BCD","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1515","ArrivalTimeStamp":"2016-12-07T1630","OperatingCarrier":"PR","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_BCD_2287_139_10:30_$22_BCD_MNL_2134_139_15:15__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"2976.00","SingleAdultVat":"688.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"3762.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"2386","Source":"CEB","Destination":"ILO","DepartureTimeStamp":"2016-12-07T1520","ArrivalTimeStamp":"2016-12-07T1610","OperatingCarrier":"PR","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_ILO_2386_139_15:20_$22_ILO_MNL_2146_139_18:40__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2146","Source":"ILO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1840","ArrivalTimeStamp":"2016-12-07T1955","OperatingCarrier":"PR","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_ILO_2386_139_15:20_$22_ILO_MNL_2146_139_18:40__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"2996.00","SingleAdultVat":"690.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"3784.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"2386","Source":"CEB","Destination":"ILO","DepartureTimeStamp":"2016-12-07T1520","ArrivalTimeStamp":"2016-12-07T1610","OperatingCarrier":"PR","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_ILO_2386_139_15:20_$22_ILO_MNL_2148_139_20:35__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2148","Source":"ILO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T2035","ArrivalTimeStamp":"2016-12-07T2145","OperatingCarrier":"PR","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_ILO_2386_139_15:20_$22_ILO_MNL_2148_139_20:35__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"2996.00","SingleAdultVat":"690.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"3784.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"2238","Source":"CEB","Destination":"TAC","DepartureTimeStamp":"2016-12-07T1300","ArrivalTimeStamp":"2016-12-07T1345","OperatingCarrier":"PR","Class":"T","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_TAC_2238_139_13:00_$22_TAC_MNL_2988_139_18:25__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2988","Source":"TAC","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1825","ArrivalTimeStamp":"2016-12-07T1940","OperatingCarrier":"PR","Class":"T","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_TAC_2238_139_13:00_$22_TAC_MNL_2988_139_18:25__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"3036.00","SingleAdultVat":"695.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"3829.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"2380","Source":"CEB","Destination":"ILO","DepartureTimeStamp":"2016-12-07T0540","ArrivalTimeStamp":"2016-12-07T0630","OperatingCarrier":"PR","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_ILO_2380_139_05:40_$22_ILO_MNL_2142_139_10:15__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2142","Source":"ILO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1015","ArrivalTimeStamp":"2016-12-07T1130","OperatingCarrier":"PR","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_ILO_2380_139_05:40_$22_ILO_MNL_2142_139_10:15__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"3336.00","SingleAdultVat":"731.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"4165.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"2384","Source":"CEB","Destination":"ILO","DepartureTimeStamp":"2016-12-07T1220","ArrivalTimeStamp":"2016-12-07T1305","OperatingCarrier":"PR","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_ILO_2384_139_12:20_$22_ILO_MNL_2144_139_14:00__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2144","Source":"ILO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1400","ArrivalTimeStamp":"2016-12-07T1515","OperatingCarrier":"PR","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_ILO_2384_139_12:20_$22_ILO_MNL_2144_139_14:00__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"3336.00","SingleAdultVat":"731.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"4165.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"828","Source":"CEB","Destination":"DVO","DepartureTimeStamp":"2016-12-07T2040","ArrivalTimeStamp":"2016-12-07T2140","OperatingCarrier":"PR","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_DVO_828_139_20:40_$22_DVO_MNL_2824_139_22:15__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2824","Source":"DVO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T2215","ArrivalTimeStamp":"2016-12-08T0005","OperatingCarrier":"PR","Class":"T","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_DVO_828_139_20:40_$22_DVO_MNL_2824_139_22:15__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"3536.00","SingleAdultVat":"755.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"4389.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"2297","Source":"CEB","Destination":"CGY","DepartureTimeStamp":"2016-12-07T1805","ArrivalTimeStamp":"2016-12-07T1850","OperatingCarrier":"PR","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_CGY_2297_139_18:05_$22_CGY_MNL_2530_139_21:55__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2530","Source":"CGY","Destination":"MNL","DepartureTimeStamp":"2016-12-07T2155","ArrivalTimeStamp":"2016-12-07T2325","OperatingCarrier":"PR","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_CGY_2297_139_18:05_$22_CGY_MNL_2530_139_21:55__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"3606.00","SingleAdultVat":"763.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"4467.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"2238","Source":"CEB","Destination":"TAC","DepartureTimeStamp":"2016-12-07T1300","ArrivalTimeStamp":"2016-12-07T1345","OperatingCarrier":"PR","Class":"T","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_TAC_2238_139_13:00_$22_TAC_MNL_2986_139_14:55__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2986","Source":"TAC","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1455","ArrivalTimeStamp":"2016-12-07T1615","OperatingCarrier":"PR","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_TAC_2238_139_13:00_$22_TAC_MNL_2986_139_14:55__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"3616.00","SingleAdultVat":"764.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"4478.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Cebu Pacific","FlightNumber":"599","Source":"CEB","Destination":"DVO","DepartureTimeStamp":"2016-12-07T1150","ArrivalTimeStamp":"2016-12-07T1250","OperatingCarrier":"5J","Class":"TA","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_599_151_11:50_$39_DVO_MNL_956_151_16:25__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"},{"Carrier":"Cebu Pacific","FlightNumber":"956","Source":"DVO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1625","ArrivalTimeStamp":"2016-12-07T1825","OperatingCarrier":"5J","Class":"Z","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_599_151_11:50_$39_DVO_MNL_956_151_16:25__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"3387.00","SingleAdultVat":"1259.04","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"4744.04","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"2293","Source":"CEB","Destination":"CGY","DepartureTimeStamp":"2016-12-07T1130","ArrivalTimeStamp":"2016-12-07T1215","OperatingCarrier":"PR","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_CGY_2293_139_11:30_$22_CGY_MNL_2526_139_16:35__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2526","Source":"CGY","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1635","ArrivalTimeStamp":"2016-12-07T1805","OperatingCarrier":"PR","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_CGY_2293_139_11:30_$22_CGY_MNL_2526_139_16:35__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"3906.00","SingleAdultVat":"799.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"4803.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"2295","Source":"CEB","Destination":"CGY","DepartureTimeStamp":"2016-12-07T0550","ArrivalTimeStamp":"2016-12-07T0635","OperatingCarrier":"PR","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_CGY_2295_139_05:50_$22_CGY_MNL_2522_139_11:10__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2522","Source":"CGY","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1110","ArrivalTimeStamp":"2016-12-07T1240","OperatingCarrier":"PR","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_CGY_2295_139_05:50_$22_CGY_MNL_2522_139_11:10__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"3906.00","SingleAdultVat":"799.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"4803.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Cebu Pacific","FlightNumber":"595","Source":"CEB","Destination":"DVO","DepartureTimeStamp":"2016-12-07T1755","ArrivalTimeStamp":"2016-12-07T1900","OperatingCarrier":"5J","Class":"TA","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_595_151_17:55_$39_DVO_MNL_982_151_23:30__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"},{"Carrier":"Cebu Pacific","FlightNumber":"982","Source":"DVO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T2330","ArrivalTimeStamp":"2016-12-08T0120","OperatingCarrier":"5J","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_595_151_17:55_$39_DVO_MNL_982_151_23:30__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"3687.00","SingleAdultVat":"1295.04","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"5080.04","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Cebu Pacific","FlightNumber":"597","Source":"CEB","Destination":"DVO","DepartureTimeStamp":"2016-12-07T1520","ArrivalTimeStamp":"2016-12-07T1625","OperatingCarrier":"5J","Class":"TA","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_597_151_15:20_$39_DVO_MNL_978_151_17:50__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"},{"Carrier":"Cebu Pacific","FlightNumber":"978","Source":"DVO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1750","ArrivalTimeStamp":"2016-12-07T1945","OperatingCarrier":"5J","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_597_151_15:20_$39_DVO_MNL_978_151_17:50__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"3687.00","SingleAdultVat":"1295.04","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"5080.04","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Cebu Pacific","FlightNumber":"599","Source":"CEB","Destination":"DVO","DepartureTimeStamp":"2016-12-07T1150","ArrivalTimeStamp":"2016-12-07T1250","OperatingCarrier":"5J","Class":"TA","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_599_151_11:50_$39_DVO_MNL_978_151_17:50__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"},{"Carrier":"Cebu Pacific","FlightNumber":"978","Source":"DVO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1750","ArrivalTimeStamp":"2016-12-07T1945","OperatingCarrier":"5J","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_599_151_11:50_$39_DVO_MNL_978_151_17:50__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"3687.00","SingleAdultVat":"1295.04","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"5080.04","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"2365","Source":"CEB","Destination":"DVO","DepartureTimeStamp":"2016-12-07T1425","ArrivalTimeStamp":"2016-12-07T1535","OperatingCarrier":"PR","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_DVO_2365_139_14:25_$22_DVO_MNL_2818_139_17:45__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2818","Source":"DVO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1745","ArrivalTimeStamp":"2016-12-07T1935","OperatingCarrier":"PR","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_DVO_2365_139_14:25_$22_DVO_MNL_2818_139_17:45__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"4226.00","SingleAdultVat":"838.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"5162.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"2365","Source":"CEB","Destination":"DVO","DepartureTimeStamp":"2016-12-07T1425","ArrivalTimeStamp":"2016-12-07T1535","OperatingCarrier":"PR","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_DVO_2365_139_14:25_$22_DVO_MNL_2820_139_19:40__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2820","Source":"DVO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1940","ArrivalTimeStamp":"2016-12-07T2130","OperatingCarrier":"PR","Class":"E","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_DVO_2365_139_14:25_$22_DVO_MNL_2820_139_19:40__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"4226.00","SingleAdultVat":"838.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"5162.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Cebu Pacific","FlightNumber":"595","Source":"CEB","Destination":"DVO","DepartureTimeStamp":"2016-12-07T1755","ArrivalTimeStamp":"2016-12-07T1900","OperatingCarrier":"5J","Class":"TA","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_595_151_17:55_$39_DVO_MNL_972_151_21:35__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"},{"Carrier":"Cebu Pacific","FlightNumber":"972","Source":"DVO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T2135","ArrivalTimeStamp":"2016-12-07T2325","OperatingCarrier":"5J","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_595_151_17:55_$39_DVO_MNL_972_151_21:35__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"3987.00","SingleAdultVat":"1331.04","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"5416.04","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Cebu Pacific","FlightNumber":"595","Source":"CEB","Destination":"DVO","DepartureTimeStamp":"2016-12-07T1755","ArrivalTimeStamp":"2016-12-07T1900","OperatingCarrier":"5J","Class":"TA","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_595_151_17:55_$39_DVO_MNL_974_151_21:00__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"},{"Carrier":"Cebu Pacific","FlightNumber":"974","Source":"DVO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T2100","ArrivalTimeStamp":"2016-12-07T2300","OperatingCarrier":"5J","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_595_151_17:55_$39_DVO_MNL_974_151_21:00__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"3987.00","SingleAdultVat":"1331.04","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"5416.04","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Cebu Pacific","FlightNumber":"597","Source":"CEB","Destination":"DVO","DepartureTimeStamp":"2016-12-07T1520","ArrivalTimeStamp":"2016-12-07T1625","OperatingCarrier":"5J","Class":"TA","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_597_151_15:20_$39_DVO_MNL_970_151_19:15__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"},{"Carrier":"Cebu Pacific","FlightNumber":"970","Source":"DVO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1915","ArrivalTimeStamp":"2016-12-07T2110","OperatingCarrier":"5J","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_597_151_15:20_$39_DVO_MNL_970_151_19:15__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"3987.00","SingleAdultVat":"1331.04","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"5416.04","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Cebu Pacific","FlightNumber":"597","Source":"CEB","Destination":"DVO","DepartureTimeStamp":"2016-12-07T1520","ArrivalTimeStamp":"2016-12-07T1625","OperatingCarrier":"5J","Class":"TA","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_597_151_15:20_$39_DVO_MNL_972_151_21:35__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"},{"Carrier":"Cebu Pacific","FlightNumber":"972","Source":"DVO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T2135","ArrivalTimeStamp":"2016-12-07T2325","OperatingCarrier":"5J","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_597_151_15:20_$39_DVO_MNL_972_151_21:35__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"3987.00","SingleAdultVat":"1331.04","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"5416.04","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Cebu Pacific","FlightNumber":"597","Source":"CEB","Destination":"DVO","DepartureTimeStamp":"2016-12-07T1520","ArrivalTimeStamp":"2016-12-07T1625","OperatingCarrier":"5J","Class":"TA","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_597_151_15:20_$39_DVO_MNL_974_151_21:00__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"},{"Carrier":"Cebu Pacific","FlightNumber":"974","Source":"DVO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T2100","ArrivalTimeStamp":"2016-12-07T2300","OperatingCarrier":"5J","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_597_151_15:20_$39_DVO_MNL_974_151_21:00__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"3987.00","SingleAdultVat":"1331.04","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"5416.04","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Cebu Pacific","FlightNumber":"599","Source":"CEB","Destination":"DVO","DepartureTimeStamp":"2016-12-07T1150","ArrivalTimeStamp":"2016-12-07T1250","OperatingCarrier":"5J","Class":"TA","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_599_151_11:50_$39_DVO_MNL_952_151_14:25__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"},{"Carrier":"Cebu Pacific","FlightNumber":"952","Source":"DVO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1425","ArrivalTimeStamp":"2016-12-07T1620","OperatingCarrier":"5J","Class":"D","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$39_CEB_DVO_599_151_11:50_$39_DVO_MNL_952_151_14:25__A1_0_0","WarningText":"Fare is non-refundable.","TicketType":"E","PlatingCarrier":"5J"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"3987.00","SingleAdultVat":"1331.04","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"5416.04","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"2363","Source":"CEB","Destination":"DVO","DepartureTimeStamp":"2016-12-07T0840","ArrivalTimeStamp":"2016-12-07T0950","OperatingCarrier":"PR","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_DVO_2363_139_08:40_$22_DVO_MNL_2814_139_11:40__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2814","Source":"DVO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1140","ArrivalTimeStamp":"2016-12-07T1330","OperatingCarrier":"PR","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_DVO_2363_139_08:40_$22_DVO_MNL_2814_139_11:40__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"4756.00","SingleAdultVat":"901.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"5755.00","SingleAdultCreditCardCharges":"0.00"}},{"Flights":{"Flight":[{"Carrier":"Philippine Airlines","FlightNumber":"2363","Source":"CEB","Destination":"DVO","DepartureTimeStamp":"2016-12-07T0840","ArrivalTimeStamp":"2016-12-07T0950","OperatingCarrier":"PR","Class":"U","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_DVO_2363_139_08:40_$22_DVO_MNL_2816_139_14:20__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"},{"Carrier":"Philippine Airlines","FlightNumber":"2816","Source":"DVO","Destination":"MNL","DepartureTimeStamp":"2016-12-07T1420","ArrivalTimeStamp":"2016-12-07T1555","OperatingCarrier":"PR","Class":"K","NumberOfStops":"0","FareBasis":"22155027789561522655492@@R_$22_CEB_DVO_2363_139_08:40_$22_DVO_MNL_2816_139_14:20__A1_0_0","WarningText":{},"TicketType":"E","PlatingCarrier":"PR"}]},"Pricing":{"@attributes":{"currency":"PHP"},"SingleAdultBaseFare":"4756.00","SingleAdultVat":"901.00","SingleAdultTransactionFee":"98.00","SingleAdultAviationFee":"0.00","SingleAdultTotalAmount":"5755.00","SingleAdultCreditCardCharges":"0.00"}}]}}}',true);

				//ABACUS
				$parameters = array(
						'dev_id'     			=> $this->global_f->dev_id(),
						'regcode'               =>$this->user['R'],
						'actionId'				=>'abacus_ticketing_service/search_flights_domestic_temp',
						'ip_address'			=>$this->ip,
						'origin'                =>$this->input->post('origin'),
						'destination'           =>$this->input->post('destination'),
						'airline'               =>$this->input->post('airline'),
						'leavedate'				=>$this->input->post('leavedate'),
						'returndate'			=>$journey == 'RT' ? $this->input->post('returndate'):'',
						'seatclass'				=>$this->input->post('seatclass'),
						'adult'					=>$this->input->post('adult'),
						'children'				=>$this->input->post('child'),
						'infant'				=>$this->input->post('infant'),
						'senior'				=>$this->input->post('senior'),
						$this->user['SKT']	    => md5($this->user['R'].$this->user['SKT'])
				);

				//GET FLIGHTS
				//$abacusresults = json_decode($this->curl->call($parameters,url),true);
				$abacusresults = json_decode('{"S":1,"M":"26 flights found","RQID":"1234568641504","Passenger":[{"Type":"A"}],"result":[{"onward":[{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"1843","SourceDesc":"Manila","DestinationDesc":"Cebu","Source":"MNL","S_Terminal":"","Destination":"CEB","D_Terminal":"","DepartureTimeStamp":"2016-11-30T0555","ArrivalTimeStamp":"2016-11-30T0710","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"3875","TaxFee":"200","SystemFee":50,"MarkupFee":100,"TotalFee":4225,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":3875,"CurrencyCode":"PHP"},"Taxes":{"Amount":200,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":350,"CurrencyCode":"PHP"},"TotalFare":{"Amount":4225,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"1869","SourceDesc":"Manila","DestinationDesc":"Cebu","Source":"MNL","S_Terminal":"","Destination":"CEB","D_Terminal":"","DepartureTimeStamp":"2016-11-30T2245","ArrivalTimeStamp":"2016-11-30T2355","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"3875","TaxFee":"200","SystemFee":50,"MarkupFee":100,"TotalFee":4225,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":3875,"CurrencyCode":"PHP"},"Taxes":{"Amount":200,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":350,"CurrencyCode":"PHP"},"TotalFare":{"Amount":4225,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2841","SourceDesc":"Manila","DestinationDesc":"Cebu","Source":"MNL","S_Terminal":"","Destination":"CEB","D_Terminal":"","DepartureTimeStamp":"2016-11-30T0500","ArrivalTimeStamp":"2016-11-30T0615","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"3875","TaxFee":"200","SystemFee":50,"MarkupFee":100,"TotalFee":4225,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":3875,"CurrencyCode":"PHP"},"Taxes":{"Amount":200,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":350,"CurrencyCode":"PHP"},"TotalFare":{"Amount":4225,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2861","SourceDesc":"Manila","DestinationDesc":"Cebu","Source":"MNL","S_Terminal":"","Destination":"CEB","D_Terminal":"","DepartureTimeStamp":"2016-11-30T1600","ArrivalTimeStamp":"2016-11-30T1715","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"3875","TaxFee":"200","SystemFee":50,"MarkupFee":100,"TotalFee":4225,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":3875,"CurrencyCode":"PHP"},"Taxes":{"Amount":200,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":350,"CurrencyCode":"PHP"},"TotalFare":{"Amount":4225,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2867","SourceDesc":"Manila","DestinationDesc":"Cebu","Source":"MNL","S_Terminal":"","Destination":"CEB","D_Terminal":"","DepartureTimeStamp":"2016-11-30T2000","ArrivalTimeStamp":"2016-11-30T2115","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"X","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"4173","TaxFee":"200","SystemFee":50,"MarkupFee":100,"TotalFee":4523,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":4173,"CurrencyCode":"PHP"},"Taxes":{"Amount":200,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":350,"CurrencyCode":"PHP"},"TotalFare":{"Amount":4523,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"X","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2863","SourceDesc":"Manila","DestinationDesc":"Cebu","Source":"MNL","S_Terminal":"","Destination":"CEB","D_Terminal":"","DepartureTimeStamp":"2016-11-30T1745","ArrivalTimeStamp":"2016-11-30T1900","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"X","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"4173","TaxFee":"200","SystemFee":50,"MarkupFee":100,"TotalFee":4523,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":4173,"CurrencyCode":"PHP"},"Taxes":{"Amount":200,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":350,"CurrencyCode":"PHP"},"TotalFare":{"Amount":4523,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"X","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2835","SourceDesc":"Manila","DestinationDesc":"Cebu","Source":"MNL","S_Terminal":"","Destination":"CEB","D_Terminal":"","DepartureTimeStamp":"2016-11-30T0400","ArrivalTimeStamp":"2016-11-30T0510","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"X","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"4173","TaxFee":"200","SystemFee":50,"MarkupFee":100,"TotalFee":4523,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":4173,"CurrencyCode":"PHP"},"Taxes":{"Amount":200,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":350,"CurrencyCode":"PHP"},"TotalFare":{"Amount":4523,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"X","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2859","SourceDesc":"Manila","DestinationDesc":"Cebu","Source":"MNL","S_Terminal":"","Destination":"CEB","D_Terminal":"","DepartureTimeStamp":"2016-11-30T1430","ArrivalTimeStamp":"2016-11-30T1545","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"B","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"4520","TaxFee":"200","SystemFee":50,"MarkupFee":100,"TotalFee":4870,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":4520,"CurrencyCode":"PHP"},"Taxes":{"Amount":200,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":350,"CurrencyCode":"PHP"},"TotalFare":{"Amount":4870,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"B","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2845","SourceDesc":"Manila","DestinationDesc":"Cebu","Source":"MNL","S_Terminal":"","Destination":"CEB","D_Terminal":"","DepartureTimeStamp":"2016-11-30T0715","ArrivalTimeStamp":"2016-11-30T0815","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"B","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"4520","TaxFee":"200","SystemFee":50,"MarkupFee":100,"TotalFee":4870,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":4520,"CurrencyCode":"PHP"},"Taxes":{"Amount":200,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":350,"CurrencyCode":"PHP"},"TotalFare":{"Amount":4870,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"B","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2849","SourceDesc":"Manila","DestinationDesc":"Cebu","Source":"MNL","S_Terminal":"","Destination":"CEB","D_Terminal":"","DepartureTimeStamp":"2016-11-30T0855","ArrivalTimeStamp":"2016-11-30T1010","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"Q","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"5365","TaxFee":"200","SystemFee":50,"MarkupFee":100,"TotalFee":5715,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":5365,"CurrencyCode":"PHP"},"Taxes":{"Amount":200,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":350,"CurrencyCode":"PHP"},"TotalFare":{"Amount":5715,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"20","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"Q","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2129","SourceDesc":"Manila","DestinationDesc":"Bacolod","Source":"MNL","S_Terminal":"","Destination":"BCD","D_Terminal":"","DepartureTimeStamp":"2016-11-30T0415","ArrivalTimeStamp":"2016-11-30T0530","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2286","SourceDesc":"Bacolod","DestinationDesc":"Cebu","Source":"BCD","S_Terminal":"","Destination":"CEB","D_Terminal":"","DepartureTimeStamp":"2016-11-30T0705","ArrivalTimeStamp":"2016-11-30T0750","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"6756","TaxFee":"200","SystemFee":50,"MarkupFee":100,"TotalFee":7106,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":6756,"CurrencyCode":"PHP"},"Taxes":{"Amount":200,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":350,"CurrencyCode":"PHP"},"TotalFare":{"Amount":7106,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":"S"},{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2139","SourceDesc":"Manila","DestinationDesc":"Iloilo","Source":"MNL","S_Terminal":"","Destination":"ILO","D_Terminal":"","DepartureTimeStamp":"2016-11-30T0430","ArrivalTimeStamp":"2016-11-30T0540","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2381","SourceDesc":"Iloilo","DestinationDesc":"Cebu","Source":"ILO","S_Terminal":"","Destination":"CEB","D_Terminal":"","DepartureTimeStamp":"2016-11-30T0650","ArrivalTimeStamp":"2016-11-30T0740","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"7203","TaxFee":"200","SystemFee":50,"MarkupFee":100,"TotalFee":7553,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":7203,"CurrencyCode":"PHP"},"Taxes":{"Amount":200,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":350,"CurrencyCode":"PHP"},"TotalFare":{"Amount":7553,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":"S"},{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2969","SourceDesc":"Manila","DestinationDesc":"Kalibo","Source":"MNL","S_Terminal":"","Destination":"KLO","D_Terminal":"","DepartureTimeStamp":"2016-11-30T0810","ArrivalTimeStamp":"2016-11-30T0915","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"X","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"242","SourceDesc":"Kalibo","DestinationDesc":"Cebu","Source":"KLO","S_Terminal":"","Destination":"CEB","D_Terminal":"","DepartureTimeStamp":"2016-11-30T1215","ArrivalTimeStamp":"2016-11-30T1315","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"7401","TaxFee":"200","SystemFee":50,"MarkupFee":100,"TotalFee":7751,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":7401,"CurrencyCode":"PHP"},"Taxes":{"Amount":200,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":350,"CurrencyCode":"PHP"},"TotalFare":{"Amount":7751,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"X","Cabin":"Y","Meal":"S"},{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2131","SourceDesc":"Manila","DestinationDesc":"Bacolod","Source":"MNL","S_Terminal":"","Destination":"BCD","D_Terminal":"","DepartureTimeStamp":"2016-11-30T0755","ArrivalTimeStamp":"2016-11-30T0910","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"B","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2288","SourceDesc":"Bacolod","DestinationDesc":"Cebu","Source":"BCD","S_Terminal":"","Destination":"CEB","D_Terminal":"","DepartureTimeStamp":"2016-11-30T1140","ArrivalTimeStamp":"2016-11-30T1230","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"7401","TaxFee":"200","SystemFee":50,"MarkupFee":100,"TotalFee":7751,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":7401,"CurrencyCode":"PHP"},"Taxes":{"Amount":200,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":350,"CurrencyCode":"PHP"},"TotalFare":{"Amount":7751,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"B","Cabin":"Y","Meal":"S"},{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"1853","SourceDesc":"Manila","DestinationDesc":"Cebu","Source":"MNL","S_Terminal":"","Destination":"CEB","D_Terminal":"","DepartureTimeStamp":"2016-11-30T1055","ArrivalTimeStamp":"2016-11-30T1210","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"S","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"7600","TaxFee":"200","SystemFee":50,"MarkupFee":100,"TotalFee":7950,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":7600,"CurrencyCode":"PHP"},"Taxes":{"Amount":200,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":350,"CurrencyCode":"PHP"},"TotalFare":{"Amount":7950,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"20","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"S","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2141","SourceDesc":"Manila","DestinationDesc":"Iloilo","Source":"MNL","S_Terminal":"","Destination":"ILO","D_Terminal":"","DepartureTimeStamp":"2016-11-30T0815","ArrivalTimeStamp":"2016-11-30T0930","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"B","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2385","SourceDesc":"Iloilo","DestinationDesc":"Cebu","Source":"ILO","S_Terminal":"","Destination":"CEB","D_Terminal":"","DepartureTimeStamp":"2016-11-30T1345","ArrivalTimeStamp":"2016-11-30T1430","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"7898","TaxFee":"200","SystemFee":50,"MarkupFee":100,"TotalFee":8248,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":7898,"CurrencyCode":"PHP"},"Taxes":{"Amount":200,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":350,"CurrencyCode":"PHP"},"TotalFare":{"Amount":8248,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"B","Cabin":"Y","Meal":"S"},{"FareReference":"K","Cabin":"Y","Meal":null}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2519","SourceDesc":"Manila","DestinationDesc":"Cagayan De Oro","Source":"MNL","S_Terminal":"","Destination":"CGY","D_Terminal":"","DepartureTimeStamp":"2016-11-30T0410","ArrivalTimeStamp":"2016-11-30T0545","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2296","SourceDesc":"Cagayan De Oro","DestinationDesc":"Cebu","Source":"CGY","S_Terminal":"","Destination":"CEB","D_Terminal":"","DepartureTimeStamp":"2016-11-30T0715","ArrivalTimeStamp":"2016-11-30T0800","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"7948","TaxFee":"200","SystemFee":50,"MarkupFee":100,"TotalFee":8298,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":7948,"CurrencyCode":"PHP"},"Taxes":{"Amount":200,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":350,"CurrencyCode":"PHP"},"TotalFare":{"Amount":8298,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":"S"},{"FareReference":"K","Cabin":"Y","Meal":null}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2967","SourceDesc":"Manila","DestinationDesc":"Butuan","Source":"MNL","S_Terminal":"","Destination":"BXU","D_Terminal":"","DepartureTimeStamp":"2016-11-30T0510","ArrivalTimeStamp":"2016-11-30T0635","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2362","SourceDesc":"Butuan","DestinationDesc":"Cebu","Source":"BXU","S_Terminal":"","Destination":"CEB","D_Terminal":"","DepartureTimeStamp":"2016-11-30T1005","ArrivalTimeStamp":"2016-11-30T1050","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"X","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"7948","TaxFee":"200","SystemFee":50,"MarkupFee":100,"TotalFee":8298,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":7948,"CurrencyCode":"PHP"},"Taxes":{"Amount":200,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":350,"CurrencyCode":"PHP"},"TotalFare":{"Amount":8298,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":"S"},{"FareReference":"X","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2981","SourceDesc":"Manila","DestinationDesc":"Tacloban","Source":"MNL","S_Terminal":"","Destination":"TAC","D_Terminal":"","DepartureTimeStamp":"2016-11-30T0445","ArrivalTimeStamp":"2016-11-30T0600","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"X","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2237","SourceDesc":"Tacloban","DestinationDesc":"Cebu","Source":"TAC","S_Terminal":"","Destination":"CEB","D_Terminal":"","DepartureTimeStamp":"2016-11-30T0905","ArrivalTimeStamp":"2016-11-30T0950","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"V","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"8295","TaxFee":"200","SystemFee":50,"MarkupFee":100,"TotalFee":8645,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":8295,"CurrencyCode":"PHP"},"Taxes":{"Amount":200,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":350,"CurrencyCode":"PHP"},"TotalFare":{"Amount":8645,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"X","Cabin":"Y","Meal":"S"},{"FareReference":"V","Cabin":"Y","Meal":null}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2521","SourceDesc":"Manila","DestinationDesc":"Cagayan De Oro","Source":"MNL","S_Terminal":"","Destination":"CGY","D_Terminal":"","DepartureTimeStamp":"2016-11-30T0900","ArrivalTimeStamp":"2016-11-30T1035","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"X","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2294","SourceDesc":"Cagayan De Oro","DestinationDesc":"Cebu","Source":"CGY","S_Terminal":"","Destination":"CEB","D_Terminal":"","DepartureTimeStamp":"2016-11-30T1300","ArrivalTimeStamp":"2016-11-30T1345","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"8395","TaxFee":"200","SystemFee":50,"MarkupFee":100,"TotalFee":8745,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":8395,"CurrencyCode":"PHP"},"Taxes":{"Amount":200,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":350,"CurrencyCode":"PHP"},"TotalFare":{"Amount":8745,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"X","Cabin":"Y","Meal":"S"},{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2525","SourceDesc":"Manila","DestinationDesc":"Cagayan De Oro","Source":"MNL","S_Terminal":"","Destination":"CGY","D_Terminal":"","DepartureTimeStamp":"2016-11-30T1420","ArrivalTimeStamp":"2016-11-30T1555","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"B","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2298","SourceDesc":"Cagayan De Oro","DestinationDesc":"Cebu","Source":"CGY","S_Terminal":"","Destination":"CEB","D_Terminal":"","DepartureTimeStamp":"2016-11-30T1930","ArrivalTimeStamp":"2016-11-30T2015","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"8891","TaxFee":"200","SystemFee":50,"MarkupFee":100,"TotalFee":9241,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":8891,"CurrencyCode":"PHP"},"Taxes":{"Amount":200,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":350,"CurrencyCode":"PHP"},"TotalFare":{"Amount":9241,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"B","Cabin":"Y","Meal":"S"},{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"1809","SourceDesc":"Manila","DestinationDesc":"Davao","Source":"MNL","S_Terminal":"","Destination":"DVO","D_Terminal":"","DepartureTimeStamp":"2016-11-30T0400","ArrivalTimeStamp":"2016-11-30T0550","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2364","SourceDesc":"Davao","DestinationDesc":"Cebu","Source":"DVO","S_Terminal":"","Destination":"CEB","D_Terminal":"","DepartureTimeStamp":"2016-11-30T1030","ArrivalTimeStamp":"2016-11-30T1140","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"9040","TaxFee":"200","SystemFee":50,"MarkupFee":100,"TotalFee":9390,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":9040,"CurrencyCode":"PHP"},"Taxes":{"Amount":200,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":350,"CurrencyCode":"PHP"},"TotalFare":{"Amount":9390,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":"S"},{"FareReference":"K","Cabin":"Y","Meal":null}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"1811","SourceDesc":"Manila","DestinationDesc":"Davao","Source":"MNL","S_Terminal":"","Destination":"DVO","D_Terminal":"","DepartureTimeStamp":"2016-11-30T0640","ArrivalTimeStamp":"2016-11-30T0830","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2364","SourceDesc":"Davao","DestinationDesc":"Cebu","Source":"DVO","S_Terminal":"","Destination":"CEB","D_Terminal":"","DepartureTimeStamp":"2016-11-30T1030","ArrivalTimeStamp":"2016-11-30T1140","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"9040","TaxFee":"200","SystemFee":50,"MarkupFee":100,"TotalFee":9390,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":9040,"CurrencyCode":"PHP"},"Taxes":{"Amount":200,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":350,"CurrencyCode":"PHP"},"TotalFare":{"Amount":9390,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":"S"},{"FareReference":"K","Cabin":"Y","Meal":null}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2143","SourceDesc":"Manila","DestinationDesc":"Iloilo","Source":"MNL","S_Terminal":"","Destination":"ILO","D_Terminal":"","DepartureTimeStamp":"2016-11-30T1205","ArrivalTimeStamp":"2016-11-30T1320","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"H","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2387","SourceDesc":"Iloilo","DestinationDesc":"Cebu","Source":"ILO","S_Terminal":"","Destination":"CEB","D_Terminal":"","DepartureTimeStamp":"2016-11-30T1630","ArrivalTimeStamp":"2016-11-30T1720","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"9140","TaxFee":"200","SystemFee":50,"MarkupFee":100,"TotalFee":9490,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":9140,"CurrencyCode":"PHP"},"Taxes":{"Amount":200,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":350,"CurrencyCode":"PHP"},"TotalFare":{"Amount":9490,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"20","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"H","Cabin":"Y","Meal":"S"},{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"1815","SourceDesc":"Manila","DestinationDesc":"Davao","Source":"MNL","S_Terminal":"","Destination":"DVO","D_Terminal":"","DepartureTimeStamp":"2016-11-30T1200","ArrivalTimeStamp":"2016-11-30T1350","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"B","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2366","SourceDesc":"Davao","DestinationDesc":"Cebu","Source":"DVO","S_Terminal":"","Destination":"CEB","D_Terminal":"","DepartureTimeStamp":"2016-11-30T1615","ArrivalTimeStamp":"2016-11-30T1725","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"9686","TaxFee":"200","SystemFee":50,"MarkupFee":100,"TotalFee":10036,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":9686,"CurrencyCode":"PHP"},"Taxes":{"Amount":200,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":350,"CurrencyCode":"PHP"},"TotalFare":{"Amount":10036,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"B","Cabin":"Y","Meal":"S"},{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2133","SourceDesc":"Manila","DestinationDesc":"Bacolod","Source":"MNL","S_Terminal":"","Destination":"BCD","D_Terminal":"","DepartureTimeStamp":"2016-11-30T1230","ArrivalTimeStamp":"2016-11-30T1345","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"M","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2290","SourceDesc":"Bacolod","DestinationDesc":"Cebu","Source":"BCD","S_Terminal":"","Destination":"CEB","D_Terminal":"","DepartureTimeStamp":"2016-11-30T1635","ArrivalTimeStamp":"2016-11-30T1720","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"9934","TaxFee":"200","SystemFee":50,"MarkupFee":100,"TotalFee":10284,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":9934,"CurrencyCode":"PHP"},"Taxes":{"Amount":200,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":350,"CurrencyCode":"PHP"},"TotalFare":{"Amount":10284,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"20","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"M","Cabin":"Y","Meal":"S"},{"FareReference":"K","Cabin":"Y","Meal":null}]}]}],"return":[{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"1854","SourceDesc":"Cebu","DestinationDesc":"Manila","Source":"CEB","S_Terminal":"","Destination":"MNL","D_Terminal":"","DepartureTimeStamp":"2016-12-07T1325","ArrivalTimeStamp":"2016-12-07T1440","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"3875","TaxFee":"300","SystemFee":50,"MarkupFee":100,"TotalFee":4325,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":3875,"CurrencyCode":"PHP"},"Taxes":{"Amount":300,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":450,"CurrencyCode":"PHP"},"TotalFare":{"Amount":4325,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"1836","SourceDesc":"Cebu","DestinationDesc":"Manila","Source":"CEB","S_Terminal":"","Destination":"MNL","D_Terminal":"","DepartureTimeStamp":"2016-12-07T0450","ArrivalTimeStamp":"2016-12-07T0600","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"3875","TaxFee":"300","SystemFee":50,"MarkupFee":100,"TotalFee":4325,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":3875,"CurrencyCode":"PHP"},"Taxes":{"Amount":300,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":450,"CurrencyCode":"PHP"},"TotalFare":{"Amount":4325,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2864","SourceDesc":"Cebu","DestinationDesc":"Manila","Source":"CEB","S_Terminal":"","Destination":"MNL","D_Terminal":"","DepartureTimeStamp":"2016-12-07T2030","ArrivalTimeStamp":"2016-12-07T2145","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"3875","TaxFee":"300","SystemFee":50,"MarkupFee":100,"TotalFee":4325,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":3875,"CurrencyCode":"PHP"},"Taxes":{"Amount":300,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":450,"CurrencyCode":"PHP"},"TotalFare":{"Amount":4325,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2868","SourceDesc":"Cebu","DestinationDesc":"Manila","Source":"CEB","S_Terminal":"","Destination":"MNL","D_Terminal":"","DepartureTimeStamp":"2016-12-07T2200","ArrivalTimeStamp":"2016-12-07T2315","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"3875","TaxFee":"300","SystemFee":50,"MarkupFee":100,"TotalFee":4325,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":3875,"CurrencyCode":"PHP"},"Taxes":{"Amount":300,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":450,"CurrencyCode":"PHP"},"TotalFare":{"Amount":4325,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2880","SourceDesc":"Cebu","DestinationDesc":"Manila","Source":"CEB","S_Terminal":"","Destination":"MNL","D_Terminal":"","DepartureTimeStamp":"2016-12-07T1905","ArrivalTimeStamp":"2016-12-07T2040","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"3875","TaxFee":"300","SystemFee":50,"MarkupFee":100,"TotalFee":4325,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":3875,"CurrencyCode":"PHP"},"Taxes":{"Amount":300,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":450,"CurrencyCode":"PHP"},"TotalFare":{"Amount":4325,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2862","SourceDesc":"Cebu","DestinationDesc":"Manila","Source":"CEB","S_Terminal":"","Destination":"MNL","D_Terminal":"","DepartureTimeStamp":"2016-12-07T1755","ArrivalTimeStamp":"2016-12-07T1910","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"X","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"4173","TaxFee":"300","SystemFee":50,"MarkupFee":100,"TotalFee":4623,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":4173,"CurrencyCode":"PHP"},"Taxes":{"Amount":300,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":450,"CurrencyCode":"PHP"},"TotalFare":{"Amount":4623,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"X","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2842","SourceDesc":"Cebu","DestinationDesc":"Manila","Source":"CEB","S_Terminal":"","Destination":"MNL","D_Terminal":"","DepartureTimeStamp":"2016-12-07T0640","ArrivalTimeStamp":"2016-12-07T0755","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"X","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"4173","TaxFee":"300","SystemFee":50,"MarkupFee":100,"TotalFee":4623,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":4173,"CurrencyCode":"PHP"},"Taxes":{"Amount":300,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":450,"CurrencyCode":"PHP"},"TotalFare":{"Amount":4623,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"X","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2860","SourceDesc":"Cebu","DestinationDesc":"Manila","Source":"CEB","S_Terminal":"","Destination":"MNL","D_Terminal":"","DepartureTimeStamp":"2016-12-07T1625","ArrivalTimeStamp":"2016-12-07T1740","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"B","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"4520","TaxFee":"300","SystemFee":50,"MarkupFee":100,"TotalFee":4970,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":4520,"CurrencyCode":"PHP"},"Taxes":{"Amount":300,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":450,"CurrencyCode":"PHP"},"TotalFare":{"Amount":4970,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"B","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2850","SourceDesc":"Cebu","DestinationDesc":"Manila","Source":"CEB","S_Terminal":"","Destination":"MNL","D_Terminal":"","DepartureTimeStamp":"2016-12-07T1100","ArrivalTimeStamp":"2016-12-07T1215","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"B","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"4520","TaxFee":"300","SystemFee":50,"MarkupFee":100,"TotalFee":4970,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":4520,"CurrencyCode":"PHP"},"Taxes":{"Amount":300,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":450,"CurrencyCode":"PHP"},"TotalFare":{"Amount":4970,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"B","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2846","SourceDesc":"Cebu","DestinationDesc":"Manila","Source":"CEB","S_Terminal":"","Destination":"MNL","D_Terminal":"","DepartureTimeStamp":"2016-12-07T0855","ArrivalTimeStamp":"2016-12-07T1010","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"B","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"4520","TaxFee":"300","SystemFee":50,"MarkupFee":100,"TotalFee":4970,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":4520,"CurrencyCode":"PHP"},"Taxes":{"Amount":300,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":450,"CurrencyCode":"PHP"},"TotalFare":{"Amount":4970,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"B","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2287","SourceDesc":"Cebu","DestinationDesc":"Bacolod","Source":"CEB","S_Terminal":"","Destination":"BCD","D_Terminal":"","DepartureTimeStamp":"2016-12-07T1030","ArrivalTimeStamp":"2016-12-07T1120","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2134","SourceDesc":"Bacolod","DestinationDesc":"Manila","Source":"BCD","S_Terminal":"","Destination":"MNL","D_Terminal":"","DepartureTimeStamp":"2016-12-07T1515","ArrivalTimeStamp":"2016-12-07T1630","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"6756","TaxFee":"300","SystemFee":50,"MarkupFee":100,"TotalFee":7206,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":6756,"CurrencyCode":"PHP"},"Taxes":{"Amount":300,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":450,"CurrencyCode":"PHP"},"TotalFare":{"Amount":7206,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":"S"},{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2289","SourceDesc":"Cebu","DestinationDesc":"Bacolod","Source":"CEB","S_Terminal":"","Destination":"BCD","D_Terminal":"","DepartureTimeStamp":"2016-12-07T1510","ArrivalTimeStamp":"2016-12-07T1555","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2136","SourceDesc":"Bacolod","DestinationDesc":"Manila","Source":"BCD","S_Terminal":"","Destination":"MNL","D_Terminal":"","DepartureTimeStamp":"2016-12-07T1750","ArrivalTimeStamp":"2016-12-07T1905","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"6756","TaxFee":"300","SystemFee":50,"MarkupFee":100,"TotalFee":7206,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":6756,"CurrencyCode":"PHP"},"Taxes":{"Amount":300,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":450,"CurrencyCode":"PHP"},"TotalFare":{"Amount":7206,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":null},{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2285","SourceDesc":"Cebu","DestinationDesc":"Bacolod","Source":"CEB","S_Terminal":"","Destination":"BCD","D_Terminal":"","DepartureTimeStamp":"2016-12-07T0540","ArrivalTimeStamp":"2016-12-07T0625","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2132","SourceDesc":"Bacolod","DestinationDesc":"Manila","Source":"BCD","S_Terminal":"","Destination":"MNL","D_Terminal":"","DepartureTimeStamp":"2016-12-07T1015","ArrivalTimeStamp":"2016-12-07T1130","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"6756","TaxFee":"300","SystemFee":50,"MarkupFee":100,"TotalFee":7206,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":6756,"CurrencyCode":"PHP"},"Taxes":{"Amount":300,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":450,"CurrencyCode":"PHP"},"TotalFare":{"Amount":7206,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":"S"},{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"249","SourceDesc":"Cebu","DestinationDesc":"Kalibo","Source":"CEB","S_Terminal":"","Destination":"KLO","D_Terminal":"","DepartureTimeStamp":"2016-12-07T1705","ArrivalTimeStamp":"2016-12-07T1820","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2972","SourceDesc":"Kalibo","DestinationDesc":"Manila","Source":"KLO","S_Terminal":"","Destination":"MNL","D_Terminal":"","DepartureTimeStamp":"2016-12-07T2000","ArrivalTimeStamp":"2016-12-07T2100","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"7103","TaxFee":"300","SystemFee":50,"MarkupFee":100,"TotalFee":7553,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":7103,"CurrencyCode":"PHP"},"Taxes":{"Amount":300,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":450,"CurrencyCode":"PHP"},"TotalFare":{"Amount":7553,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":"S"},{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2238","SourceDesc":"Cebu","DestinationDesc":"Tacloban","Source":"CEB","S_Terminal":"","Destination":"TAC","D_Terminal":"","DepartureTimeStamp":"2016-12-07T1300","ArrivalTimeStamp":"2016-12-07T1345","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2988","SourceDesc":"Tacloban","DestinationDesc":"Manila","Source":"TAC","S_Terminal":"","Destination":"MNL","D_Terminal":"","DepartureTimeStamp":"2016-12-07T1825","ArrivalTimeStamp":"2016-12-07T1940","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"7153","TaxFee":"300","SystemFee":50,"MarkupFee":100,"TotalFee":7603,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":7153,"CurrencyCode":"PHP"},"Taxes":{"Amount":300,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":450,"CurrencyCode":"PHP"},"TotalFare":{"Amount":7603,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":"S"},{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2238","SourceDesc":"Cebu","DestinationDesc":"Tacloban","Source":"CEB","S_Terminal":"","Destination":"TAC","D_Terminal":"","DepartureTimeStamp":"2016-12-07T1300","ArrivalTimeStamp":"2016-12-07T1345","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2986","SourceDesc":"Tacloban","DestinationDesc":"Manila","Source":"TAC","S_Terminal":"","Destination":"MNL","D_Terminal":"","DepartureTimeStamp":"2016-12-07T1455","ArrivalTimeStamp":"2016-12-07T1615","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"7153","TaxFee":"300","SystemFee":50,"MarkupFee":100,"TotalFee":7603,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":7153,"CurrencyCode":"PHP"},"Taxes":{"Amount":300,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":450,"CurrencyCode":"PHP"},"TotalFare":{"Amount":7603,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":"S"},{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2380","SourceDesc":"Cebu","DestinationDesc":"Iloilo","Source":"CEB","S_Terminal":"","Destination":"ILO","D_Terminal":"","DepartureTimeStamp":"2016-12-07T0540","ArrivalTimeStamp":"2016-12-07T0630","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2142","SourceDesc":"Iloilo","DestinationDesc":"Manila","Source":"ILO","S_Terminal":"","Destination":"MNL","D_Terminal":"","DepartureTimeStamp":"2016-12-07T1015","ArrivalTimeStamp":"2016-12-07T1130","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"7203","TaxFee":"300","SystemFee":50,"MarkupFee":100,"TotalFee":7653,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":7203,"CurrencyCode":"PHP"},"Taxes":{"Amount":300,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":450,"CurrencyCode":"PHP"},"TotalFare":{"Amount":7653,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":"S"},{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2386","SourceDesc":"Cebu","DestinationDesc":"Iloilo","Source":"CEB","S_Terminal":"","Destination":"ILO","D_Terminal":"","DepartureTimeStamp":"2016-12-07T1520","ArrivalTimeStamp":"2016-12-07T1610","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2148","SourceDesc":"Iloilo","DestinationDesc":"Manila","Source":"ILO","S_Terminal":"","Destination":"MNL","D_Terminal":"","DepartureTimeStamp":"2016-12-07T2035","ArrivalTimeStamp":"2016-12-07T2145","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"7203","TaxFee":"300","SystemFee":50,"MarkupFee":100,"TotalFee":7653,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":7203,"CurrencyCode":"PHP"},"Taxes":{"Amount":300,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":450,"CurrencyCode":"PHP"},"TotalFare":{"Amount":7653,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":"S"},{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2386","SourceDesc":"Cebu","DestinationDesc":"Iloilo","Source":"CEB","S_Terminal":"","Destination":"ILO","D_Terminal":"","DepartureTimeStamp":"2016-12-07T1520","ArrivalTimeStamp":"2016-12-07T1610","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2146","SourceDesc":"Iloilo","DestinationDesc":"Manila","Source":"ILO","S_Terminal":"","Destination":"MNL","D_Terminal":"","DepartureTimeStamp":"2016-12-07T1840","ArrivalTimeStamp":"2016-12-07T1955","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"7203","TaxFee":"300","SystemFee":50,"MarkupFee":100,"TotalFee":7653,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":7203,"CurrencyCode":"PHP"},"Taxes":{"Amount":300,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":450,"CurrencyCode":"PHP"},"TotalFare":{"Amount":7653,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":"S"},{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2384","SourceDesc":"Cebu","DestinationDesc":"Iloilo","Source":"CEB","S_Terminal":"","Destination":"ILO","D_Terminal":"","DepartureTimeStamp":"2016-12-07T1220","ArrivalTimeStamp":"2016-12-07T1305","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2144","SourceDesc":"Iloilo","DestinationDesc":"Manila","Source":"ILO","S_Terminal":"","Destination":"MNL","D_Terminal":"","DepartureTimeStamp":"2016-12-07T1400","ArrivalTimeStamp":"2016-12-07T1515","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"7203","TaxFee":"300","SystemFee":50,"MarkupFee":100,"TotalFee":7653,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":7203,"CurrencyCode":"PHP"},"Taxes":{"Amount":300,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":450,"CurrencyCode":"PHP"},"TotalFare":{"Amount":7653,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":null},{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2297","SourceDesc":"Cebu","DestinationDesc":"Cagayan De Oro","Source":"CEB","S_Terminal":"","Destination":"CGY","D_Terminal":"","DepartureTimeStamp":"2016-12-07T1805","ArrivalTimeStamp":"2016-12-07T1850","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2530","SourceDesc":"Cagayan De Oro","DestinationDesc":"Manila","Source":"CGY","S_Terminal":"","Destination":"MNL","D_Terminal":"","DepartureTimeStamp":"2016-12-07T2155","ArrivalTimeStamp":"2016-12-07T2325","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"7948","TaxFee":"300","SystemFee":50,"MarkupFee":100,"TotalFee":8398,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":7948,"CurrencyCode":"PHP"},"Taxes":{"Amount":300,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":450,"CurrencyCode":"PHP"},"TotalFare":{"Amount":8398,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":"S"},{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2295","SourceDesc":"Cebu","DestinationDesc":"Cagayan De Oro","Source":"CEB","S_Terminal":"","Destination":"CGY","D_Terminal":"","DepartureTimeStamp":"2016-12-07T0550","ArrivalTimeStamp":"2016-12-07T0635","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2522","SourceDesc":"Cagayan De Oro","DestinationDesc":"Manila","Source":"CGY","S_Terminal":"","Destination":"MNL","D_Terminal":"","DepartureTimeStamp":"2016-12-07T1110","ArrivalTimeStamp":"2016-12-07T1240","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"7948","TaxFee":"300","SystemFee":50,"MarkupFee":100,"TotalFee":8398,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":7948,"CurrencyCode":"PHP"},"Taxes":{"Amount":300,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":450,"CurrencyCode":"PHP"},"TotalFare":{"Amount":8398,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":null},{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2293","SourceDesc":"Cebu","DestinationDesc":"Cagayan De Oro","Source":"CEB","S_Terminal":"","Destination":"CGY","D_Terminal":"","DepartureTimeStamp":"2016-12-07T1130","ArrivalTimeStamp":"2016-12-07T1215","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2526","SourceDesc":"Cagayan De Oro","DestinationDesc":"Manila","Source":"CGY","S_Terminal":"","Destination":"MNL","D_Terminal":"","DepartureTimeStamp":"2016-12-07T1635","ArrivalTimeStamp":"2016-12-07T1805","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"7948","TaxFee":"300","SystemFee":50,"MarkupFee":100,"TotalFee":8398,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":7948,"CurrencyCode":"PHP"},"Taxes":{"Amount":300,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":450,"CurrencyCode":"PHP"},"TotalFare":{"Amount":8398,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":"S"},{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2365","SourceDesc":"Cebu","DestinationDesc":"Davao","Source":"CEB","S_Terminal":"","Destination":"DVO","D_Terminal":"","DepartureTimeStamp":"2016-12-07T1425","ArrivalTimeStamp":"2016-12-07T1535","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2820","SourceDesc":"Davao","DestinationDesc":"Manila","Source":"DVO","S_Terminal":"","Destination":"MNL","D_Terminal":"","DepartureTimeStamp":"2016-12-07T1940","ArrivalTimeStamp":"2016-12-07T2130","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"9040","TaxFee":"300","SystemFee":50,"MarkupFee":100,"TotalFee":9490,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":9040,"CurrencyCode":"PHP"},"Taxes":{"Amount":300,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":450,"CurrencyCode":"PHP"},"TotalFare":{"Amount":9490,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":"S"},{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2365","SourceDesc":"Cebu","DestinationDesc":"Davao","Source":"CEB","S_Terminal":"","Destination":"DVO","D_Terminal":"","DepartureTimeStamp":"2016-12-07T1425","ArrivalTimeStamp":"2016-12-07T1535","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2818","SourceDesc":"Davao","DestinationDesc":"Manila","Source":"DVO","S_Terminal":"","Destination":"MNL","D_Terminal":"","DepartureTimeStamp":"2016-12-07T1745","ArrivalTimeStamp":"2016-12-07T1935","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"9040","TaxFee":"300","SystemFee":50,"MarkupFee":100,"TotalFee":9490,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":9040,"CurrencyCode":"PHP"},"Taxes":{"Amount":300,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":450,"CurrencyCode":"PHP"},"TotalFare":{"Amount":9490,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":"S"},{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2363","SourceDesc":"Cebu","DestinationDesc":"Davao","Source":"CEB","S_Terminal":"","Destination":"DVO","D_Terminal":"","DepartureTimeStamp":"2016-12-07T0840","ArrivalTimeStamp":"2016-12-07T0950","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2816","SourceDesc":"Davao","DestinationDesc":"Manila","Source":"DVO","S_Terminal":"","Destination":"MNL","D_Terminal":"","DepartureTimeStamp":"2016-12-07T1420","ArrivalTimeStamp":"2016-12-07T1555","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"9040","TaxFee":"300","SystemFee":50,"MarkupFee":100,"TotalFee":9490,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":9040,"CurrencyCode":"PHP"},"Taxes":{"Amount":300,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":450,"CurrencyCode":"PHP"},"TotalFare":{"Amount":9490,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":null},{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2363","SourceDesc":"Cebu","DestinationDesc":"Davao","Source":"CEB","S_Terminal":"","Destination":"DVO","D_Terminal":"","DepartureTimeStamp":"2016-12-07T0840","ArrivalTimeStamp":"2016-12-07T0950","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2814","SourceDesc":"Davao","DestinationDesc":"Manila","Source":"DVO","S_Terminal":"","Destination":"MNL","D_Terminal":"","DepartureTimeStamp":"2016-12-07T1140","ArrivalTimeStamp":"2016-12-07T1330","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"9040","TaxFee":"300","SystemFee":50,"MarkupFee":100,"TotalFee":9490,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":9040,"CurrencyCode":"PHP"},"Taxes":{"Amount":300,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":450,"CurrencyCode":"PHP"},"TotalFare":{"Amount":9490,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":null},{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]},{"Flights":[{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"828","SourceDesc":"Cebu","DestinationDesc":"Davao","Source":"CEB","S_Terminal":"","Destination":"DVO","D_Terminal":"","DepartureTimeStamp":"2016-12-07T2040","ArrivalTimeStamp":"2016-12-07T2140","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"},{"Carrier":"Philippine Airlines","CarrierID":"PR","FlightNumber":"2824","SourceDesc":"Davao","DestinationDesc":"Manila","Source":"DVO","S_Terminal":"","Destination":"MNL","D_Terminal":"","DepartureTimeStamp":"2016-12-07T2215","ArrivalTimeStamp":"2016-12-08T0005","Class":"Y","NumberOfStops":"0","FareBasis":"","WarningText":"","TicketType":"eTicket","ResBookDesigCode":"K","MarketingAirline":"PR","OperatingAirline":"PR"}],"Pricing":{"currency":"PHP","BaseFareFee":"9040","TaxFee":"300","SystemFee":50,"MarkupFee":100,"TotalFee":9490,"is_available":0},"Breakdown":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":"1"},"PassengerFare":{"BaseFare":{"Amount":9040,"CurrencyCode":"PHP"},"Taxes":{"Amount":300,"CurrencyCode":"PHP"},"TaxesnFees":{"Amount":450,"CurrencyCode":"PHP"},"TotalFare":{"Amount":9490,"CurrencyCode":"PHP"},"BaggageInformation":[{"SegmentId":"0","Allowance":{"Weight":"10","Unit":"kg"}}]},"Endorsements":{"NonRefundableIndicator":"false"},"FareInfos":[{"FareReference":"K","Cabin":"Y","Meal":"S"},{"FareReference":"K","Cabin":"Y","Meal":"S"}]}]}]}]}',true);
				//$abacusresults = null;
				//ADD FLIGHTS INTO ARRAY FOR SORTING
				$arr = array();
				foreach($abacusresults['result'] as $row){
					$arr[$row[0]['onward'][0]['CarrierID']][] = $row;
				}
				//SORT FLIGHTS PR FLIGHTS COMES FIRST
				$arr2 = array();
				foreach($arr as $k => $v){
					if($k=='PR'){
						$arr2 = array_merge($v,$arr2);
					}else{
						$arr2 = array_merge($arr2,$v);
					}
				}

				if ($viaresults || $abacusresults) {
					if($viaresults['S']==1||$abacusresults['S']==1){
						$data['data1']['journey'] = $journey;
						$data['data1']['viarqid'] = $viaresults['RQID'];
						$data['data1']['abacusrqid'] = $abacusresults['RQID'];
						$data['data1']['viaflights'] = $viaresults['result'];
						$data['data1']['abacusflights'] = $arr2;
						$data['data1']['viapassengers'] = $viaresults['Passenger'];
						$data['data1']['abacuspassengers'] = $abacusresults['Passenger'];
					}else{
						goto negative;
					}
				}else{
					negative:
					$data['output'] = array(
							'S' => 0,

					);
					if($viaresults!=null)
						$data['output']['M'] = $viaresults!=null ?'Searching Failed : '.$viaresults['M']:'Searching Failed!';
					else if($abacusresults!=null)
						$data['output']['M'] = $abacusresults!=null ?'Searching Failed : '.$abacusresults['M']:'Searching Failed!';
					goto searchPage;
				}

				//print_r($data['data1']);

				backfrompassengerdetailspage:

				$this->load->view('merged_flights/header_open',$data);
				$this->load->view('merged_flights/search/v2/results_header',$data);
				$this->load->view('merged_flights/header_close',$data);

				$this->load->view('element/top_header',$data);
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('merged_flights/search/v2/results',$data);

				$this->load->view('element/wrapper_footer');
				$this->load->view('merged_flights/footer');
				$this->load->view('merged_flights/search/v2/results_footer');


			}else if (isset($_POST['btn_chooseflight'])) {
				//for back button data preservation
				$data1 			= json_decode($this->input->post('data1'),true);
				$provider 		= (int)$this->input->post('provider');	//0 - abacus, 1 - via
				$chosen_onward 	= (int)$this->input->post('chosen_onward');
				$chosen_return 	= (int)$this->input->post('chosen_return');


				//if from back get this
				//$passengers 	= json_decode($this->input->post('passengers'),true);
				//$contacts 		= json_decode($this->input->post('contacts'),true);


				if($provider==0/*'Abacus'*/){
					$onwardSTR = $this->getOnwardSTR($chosen_onward,$data1['abacusflights']);
					$returnSTR = $this->getReturnSTR($chosen_return,$data1['abacusflights']);
					$pricingSTR = $this->getPricingSTR($chosen_onward,$chosen_return,$data1['abacusflights']);
					$passengercount = $this->getPassengerCount($data1['abacuspassengers']);
				}else{
					//$onwardSTR = $this->getOnwardSTR($chosen_onward,$data1['abacusflights']);
					//$returnSTR = $this->getReturnSTR($chosen_return,$data1['abacusflights']);
					//$pricingSTR = $this->getPricingSTR($chosen_onward,$chosen_return,$data1['abacusflights']);
					//$passengercount = $this->getPassengerCount($data1['abacuspassengers']);
					//neslie here
				}

				$url = url;
				$parameters = array(
						'dev_id' 		=> $this->global_f->dev_id(),
						'regcode' 		=> $this->user['R'],
						'actionId' 		=> abacus_choose_domestic_flights,
						'ip_address' 	=> $this->ip,
						'requestid' 			=> $data1['abacusrqid'],
						'onward' 				=> $onwardSTR,
						'return' 				=> $returnSTR,
						'pricing' 				=> $pricingSTR,
						'flighttype' 	=> 2,
						'adult' 				=> $passengercount['A'],
						'children' 				=> $passengercount['C'],
						'infant' 				=> $passengercount['I'],
						'senior' 				=> $passengercount['S'],
						$this->user['SKT'] => md5($this->user['R'] . $this->user['SKT'])
				);

				$results = json_decode($this->curl->call($parameters, $url), true);

				if ($results) {
					if ($results['S'] == 1) {
						$data['data1'] 				= json_decode($this->input->post('data1'),true);
						$data['provider']			= $provider;
						$data['chosen_onward']		= $chosen_onward;
						$data['chosen_return']		= $chosen_return;
						/*if($passengers&&$contacts){
                            $data['passengers'] = $passengers;
                            $data['contacts'] = $contacts;
                        }*/
					} else {
						$data['output'] = array(
								'S' => 0,
								'M' => $results['M']
						);
					}
				} else {
					$data['output'] = array(
							'S' => 0,
							'M' => 'Transaction Failed'
					);
				}



				$this->load->view('merged_flights/header_open', $data);
				$this->load->view('merged_flights/search/header_index', $data);
				$this->load->view('merged_flights/header_close', $data);

				$this->load->view('element/top_header', $data);
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('merged_flights/search/v2/passengerdetails', $data);

				$this->load->view('element/wrapper_footer');
				$this->load->view('merged_flights/footer');
				$this->load->view('merged_flights/search/footer_passengerdetails');

			}else if(isset($_POST['btn_submitpassengerdetails'])){
				gotosummary:

				$data1 			= json_decode($this->input->post('data1'),true);
				$provider			= $this->input->post('provider');
				$chosen_onward 	= $this->input->post('chosen_onward');
				$chosen_return	= $this->input->post('chosen_return');
				$passengers 	= json_decode($this->input->post('passengers'),true);
				$contacts 		= json_decode($this->input->post('contacts'),true);

				$data['data1'] 			= $data1;
				$data['provider']		= $provider;
				$data['passengers']		= $passengers;
				$data['contacts'] 		= $contacts;
				$data['chosen_onward']	= $chosen_onward;
				$data['chosen_return']	= $chosen_return;

				$this->load->view('merged_flights/header_open', $data);
				$this->load->view('merged_flights/search/header_summary', $data);
				$this->load->view('merged_flights/header_close', $data);

				$this->load->view('element/top_header', $data);
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('merged_flights/search/v2/summary', $data);

				$this->load->view('element/wrapper_footer');
				$this->load->view('merged_flights/footer');
				$this->load->view('merged_flights/search/footer_passengerdetails');

			}else if(isset($_POST['btn_proceed'])){

				$url = url;
				$transpass = (string)$this->input->post('transpass');

				$parameters = array(
						'dev_id'     	=> $this->global_f->dev_id(),
						'regcode' 	 	=> $this->user['R'],
						'actionId'   	=> abacus_domestic_booking_request,
						'ip_address' 	=> $this->ip,
						'requestid'  			=> (string)$this->input->post('rqid'),
						'transpass'  			=> $transpass,
						'passenger'  			=> (string)$this->input->post('passengersSTR'),
						'street' 				=> (string)$this->input->post('street'),
						'city' 					=> (string)$this->input->post('city'),
						'zipcode' 				=> (string)$this->input->post('zipcode'),
						'phone' 				=> (string)$this->input->post('phone'),
						$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'].md5($transpass))
				);

				$result = json_decode($this->curl->call($parameters,$url),true);
				//$result = json_decode('{"S":"1","M":"SUCCESSFULLY RESERVED","TN":"GPRSDb361167011","D":"1889.00","EC":"105232.75"}',true);
				//echo json_encode($result,true);
				$data['output'] = $result;
				if($result['S']==0){
					goto gotosummary;
				}

				$this->load->view('merged_flights/header_open', $data);
				$this->load->view('merged_flights/search/header_index');
				$this->load->view('merged_flights/header_close', $data);

				$this->load->view('element/top_header', $data);
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('merged_flights/search/finalpage', $data);

				$this->load->view('element/wrapper_footer');
				$this->load->view('merged_flights/footer');


			}else {
				searchPage:
				$tempip = '146.88.66.254';//'211.220.194.17';//'66.249.69.245';//
				//$location = json_decode($this->curl->call(null,'http://ip-api.com/json/'.$tempip),true);

				$airports = json_decode($this->curl->call(null,url_mobilereports.'/abacus_getairportfrom/'.'PH'/*$location['countryCode']*/),true);
				$airlines = json_decode($this->curl->call(null,url_mobilereports.'/abacus_getallairline/'.'PH'/*$location['countryCode']*/),true);

				$data['airlines'] = $airlines['T_DATA'];
				$data['airports'] = $airports['T_DATA'];



				$this->load->view('merged_flights/header_open',$data);
				$this->load->view('merged_flights/search/header_index',$data);
				$this->load->view('merged_flights/header_close',$data);

				$this->load->view('element/top_header',$data);
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');

				$this->load->view('merged_flights/search/v2/index',$data);

				$this->load->view('element/wrapper_footer');
				$this->load->view('merged_flights/footer');
				$this->load->view('merged_flights/search/footer_index');
				//$this->load->view('layout/footer');
			}



		}else{
			$this->session->sess_destroy();
			redirect('Login/');
		}


	}





	public function markup()
	{
		$data = array('menu' => 'dom',
					 'parent'=>'ABACUS' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			
			if (isset($_POST['btnUpdateMarkup'])) {
				$url = url;
				$parameters = array(
					'dev_id'      => $this->global_f->dev_id(),
					'regcode' 	  => $this->user['R'],
					'actionId' 	  => abacus_updatemarkup,
					'ip_address'  => $this->ip,
					'markup_type' => 2,
					'markup' 	  => $this->input->post('markup'),
					'transpass'   => $this->input->post('transpass'),
					$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'])
				);
				$result = json_decode($this->curl->call($parameters,$url),true);
				if ($result) {
					if ($result['S'] == 1) {
						$data['output'] = array(
								'S' => 1,
								'M' => $result['M']
							);
					}else{
						$data['output'] = array(
								'S' => 0,
								'M' => $result['M']
							);
					}
				}else{
					$data['output'] = array(
							'S' => 0,
							'M' => 'Transaction Failed, Please Try again.'
						);
				}
			}
			$data['user'] = $this->user;
			$url = url;
		 	$parameters = array(
					'dev_id'      => $this->global_f->dev_id(),
					'actionId' 	  => abacus_getmarkup,
					'ip_address'  => $this->ip,
					'regcode' 	  => $this->user['R'],
					'markup_type' => 2
		 	);
		 	$result = json_decode($this->curl->call($parameters,$url),true);

			if($result){
				if($result['S']==1){
					$data['mark_up'] = $result['MU'];
				}else{
					$data['output'] = array(
						'S' => 0,
						'M' => $result['M']
					);
				}
			}else{
				$data['output'] = array(
					'S' => 0,
					'M' => 'Failed to get response from the server.'
				);
			}

			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('merged_flights/markup/markup',$data);
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');	
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}

	}

	public function eticketing2($tn)
	{
		$data = array('menu' => 8,
				     'parent'=>'DOMESTIC_FLIGHTS' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			if ($tn){
					$url = url;

					$parameters = array(
						'dev_id'     => $this->global_f->dev_id(),
						'regcode' 	 => $this->user['R'],
						'requestid'  =>$tn,
						'actionId' 	 =>"ups_ticketing_service/domestic_update_transaction",
						'ip_address' =>$this->ip,
						$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'])
					);
					$data['API'] = json_decode($this->curl->call($parameters,$url),true);
					

				}

			$data['user'] = $this->user;
			$url = url;
			$parameters = array(
				'dev_id'     => $this->global_f->dev_id(),
				'regcode' 	 => $this->user['R'],
				'actionId' 	 =>_domestic_booking_transactions,
				'ip_address' =>$this->ip,
				$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'])
			);

			$data['result'] = json_decode($this->curl->call($parameters,$url),true);
			// var_dump($result);
			// die();
			$data['field'] = array('Transaction #','PNR #','Passenger','Onward(Flight Number)','Source','Destination','Departure','Arrival','Class','Markup Fee','Total Fee','Baggage Fee');

			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('onlinebooking/eticket_logs'); 
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');	
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}

	public function eticketing($provider, $tn)
	{
		$data = array('menu' => 'dom',
				'parent'=>'ABACUS' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			if ($tn){

				// provider -> 1=via, 2=byaheko
				if($provider == '2') {
					$actionId = 'ups_byaheko_service/domestic_update_transaction';
				} else {
					$actionId = 'ups_ticketing_service/domestic_update_transaction';
				}

				$url = url;

				$parameters = array(
						'dev_id'     => $this->global_f->dev_id(),
						'regcode' 	 => $this->user['R'],
						'requestid'  =>$tn,
						'actionId' 	 =>$actionId,
						'ip_address' =>$this->ip,
						$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'])
				);
				$data['API'] = json_decode($this->curl->call($parameters,$url),true);

			}

			$trackno 			= $this->input->post('trackno');
			$adjustmentfee 		= $this->input->post('adjustmentfee');

			if (isset($_POST['btnSubmitTxn'])){ 
				// echo '<pre>';
				// 	print_r($this->user['R']);
				// echo '</pre>';
				// echo '<pre>';
				// 	print_r($trackno);
				// echo '</pre>';
				// echo '<pre>';
				// 	print_r($adjustmentfee);
				// echo '</pre>';
				// var_dump($this->input->post('btnSubmitTxn'));die;

				// $url = 'ups_byaheko_service/domestic_update_transaction';

				$parameters = array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'regcode' 	 		=> $this->user['R'],
						'trackingNumber'  	=> $trackno,
						'actionId' 	 		=> 'ups_byaheko_service/price_change_agree',
						'ip_address' 		=> $this->ip,
						$this->user['SKT'] 	=> md5($this->user['R'].$this->user['SKT'])
				);

				// echo '<pre>';
				// 	print_r($parameters);
				// echo '</pre>';
		
				$data['API'] = json_decode($this->curl->call($parameters,url),true);

				// var_dump($data['API']);die;

			} elseif (isset($_POST['btnCancelTxn'])) {
				// echo '<pre>';
				// 	print_r($this->user['R']);
				// echo '</pre>';
				// echo '<pre>';
				// 	print_r($trackno);
				// echo '</pre>';
				// echo '<pre>';
				// 	print_r($adjustmentfee);
				// echo '</pre>';
				// var_dump($this->input->post('btnCancelTxn'));die;

				$parameters = array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'regcode' 	 		=> $this->user['R'],
						'trackingNumber'  	=> $trackno,
						'actionId' 	 		=> 'ups_byaheko_service/price_change_disagree',
						'ip_address' 		=> $this->ip,
						$this->user['SKT'] 	=> md5($this->user['R'].$this->user['SKT'])
				);
				
				$data['API'] = json_decode($this->curl->call($parameters,url),true);
			}

			$data['user'] = $this->user;
			$url = url;
			$parameters = array(
					'dev_id'     => $this->global_f->dev_id(),
					'regcode' 	 => $this->user['R'],
					'actionId' 	 =>_domestic_booking_transactions,
					'ip_address' =>$this->ip,
					$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'])
			);

			$data['result'] = json_decode($this->curl->call($parameters,$url),true);
			// var_dump($result);
			// die();
//			$data['field'] = array('Transaction #','PNR #','Passenger','Onward(Flight Number)','Source','Destination','Departure','Arrival','Class','Markup Fee','Total Fee','Baggage Fee');
			$data['field'] = array('Status','Transaction #','PNR #','Passenger','Onward (Flight Number)','Source','Destination','Departure','Arrival','Class','Markup Fee','Total Fee','Baggage Fee');


			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('merged_flights/issueticket/eticket_logs',$data);
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}

	public function issue_ticket(){
		$data = array('menu' => 'dom',
				'parent'=>'ABACUS' );


		if ($this->user['S'] == 1 && $this->user['R'] !=""){


			if(isset($_POST['btnViewDetails'])){

				if(isset($_POST['transno'])){
					$PNR = (string)$this->curl->call(null,url_mobilereports.'/abacus_getpnrfrom/'.$_POST['transno']);
				}else{
					$PNR = $this->input->post('pnr');
				}

				$parameters = array(
						'dev_id'      	=> $this->global_f->dev_id(),
						'actionId' 	  	=> abacus_fetch_pnr_details,
						'ip_address'  	=> $this->ip,
						'regcode' 	  	=> $this->user['R'],
						'pnr'			=> $PNR,
						'flighttype'	=> 'D'
				);

				$c_result = json_decode($this->curl->call($parameters,url),true);
				//$c_result = json_decode('{"S":1,"M":"fetch success","result":{"CustomerInfo":[{"WithInfant":"false","PassengerType":"ADT","GivenName":"NESLIE","Surname":"NAMAYAN"},{"WithInfant":"false","PassengerType":"ADT","GivenName":"EMIE ROSE","Surname":"TURALBA"}],"FlightInfo":[{"Departure":"2016-11-15T05:00","Arrival":"11-15T06:15","FlightNumber":"2841","Status":"HK","OriginLocation":"MNL","DestinationLocation":"CEB","MarketingAirline":{"Code":"PR","FlightNumber":"2841"},"OperatingAirline":{"Code":"PR","FlightNumber":"2841"},"MealCode":"S"},{"Departure":"2016-11-30T11:00","Arrival":"11-30T12:15","FlightNumber":"2850","Status":"HK","OriginLocation":"CEB","DestinationLocation":"MNL","MarketingAirline":{"Code":"PR","FlightNumber":"2850"},"OperatingAirline":{"Code":"PR","FlightNumber":"2850"},"MealCode":"S"}],"PriceInfo":{"PriceQuotes":[{"PassengerTypeQuantity":{"Code":"ADT","Quantity":2},"Totals":{"BaseFare":"8552","Taxes":"2058","TotalFare":"10610"},"TotalFare":{"Markup":0,"SysFee":100,"Amount":5405,"CurrencyCode":"PHP"}}],"PriceQuoteTotals":{"BaseFare":8552,"Tax":2058,"Markup":0,"SysFee":100,"TotalFare":5405}},"baggages":{"1":[{"CommercialName":"UPTO33LB 15KG BAGGAGE","RficSubcode":"0C1","OwningCarrierCode":"PR","BoardPoint":"MNL","OffPoint":"CEB","TTLPrice":{"Price":"750","Currency":"PHP"}},{"CommercialName":"UPTO44LB 20KG BAGGAGE","RficSubcode":"0C2","OwningCarrierCode":"PR","BoardPoint":"MNL","OffPoint":"CEB","TTLPrice":{"Price":"999","Currency":"PHP"}},{"CommercialName":"UPTO55LB 25KG BAGGAGE","RficSubcode":"0C4","OwningCarrierCode":"PR","BoardPoint":"MNL","OffPoint":"CEB","TTLPrice":{"Price":"1250","Currency":"PHP"}},{"CommercialName":"UPTO66LB 30KG BAGGAGE","RficSubcode":"0C5","OwningCarrierCode":"PR","BoardPoint":"MNL","OffPoint":"CEB","TTLPrice":{"Price":"1500","Currency":"PHP"}},{"CommercialName":"UPTO35KG BAGGAGE","RficSubcode":"0C7","OwningCarrierCode":"PR","BoardPoint":"MNL","OffPoint":"CEB","TTLPrice":{"Price":"1750","Currency":"PHP"}},{"CommercialName":"UPTO88LB40KG BAGGAGE","RficSubcode":"0C8","OwningCarrierCode":"PR","BoardPoint":"MNL","OffPoint":"CEB","TTLPrice":{"Price":"2000","Currency":"PHP"}},{"CommercialName":"UPTO11LB 5KG BAGGAGE","RficSubcode":"0CW","OwningCarrierCode":"PR","BoardPoint":"MNL","OffPoint":"CEB","TTLPrice":{"Price":"250","Currency":"PHP"}},{"CommercialName":"UPTO22LB 10KG BAGGAGE","RficSubcode":"0CZ","OwningCarrierCode":"PR","BoardPoint":"MNL","OffPoint":"CEB","TTLPrice":{"Price":"500","Currency":"PHP"}},{"CommercialName":"GOLF EQUIPMENT UP TO 15 KG","RficSubcode":"0D4","OwningCarrierCode":"PR","BoardPoint":"MNL","OffPoint":"CEB","TTLPrice":{"Price":"1120","Currency":"PHP"}},{"CommercialName":"SCUBA EQUIPMENT UP TO 15 KG","RficSubcode":"0F6","OwningCarrierCode":"PR","BoardPoint":"MNL","OffPoint":"CEB","TTLPrice":{"Price":"1120","Currency":"PHP"}},{"CommercialName":"BICYCLE UP TO 33LB 15 KG","RficSubcode":"0FP","OwningCarrierCode":"PR","BoardPoint":"MNL","OffPoint":"CEB","TTLPrice":{"Price":"1120","Currency":"PHP"}},{"CommercialName":"FISHING EQUIPMENT UP TO 15 KG","RficSubcode":"0FW","OwningCarrierCode":"PR","BoardPoint":"MNL","OffPoint":"CEB","TTLPrice":{"Price":"1120","Currency":"PHP"}},{"CommercialName":"BOWLING EQUIP UP TO 15KG","RficSubcode":"0PY","OwningCarrierCode":"PR","BoardPoint":"MNL","OffPoint":"CEB","TTLPrice":{"Price":"1120","Currency":"PHP"}}],"2":[{"CommercialName":"UPTO33LB 15KG BAGGAGE","RficSubcode":"0C1","OwningCarrierCode":"PR","BoardPoint":"CEB","OffPoint":"MNL","TTLPrice":{"Price":"750","Currency":"PHP"}},{"CommercialName":"UPTO44LB 20KG BAGGAGE","RficSubcode":"0C2","OwningCarrierCode":"PR","BoardPoint":"CEB","OffPoint":"MNL","TTLPrice":{"Price":"999","Currency":"PHP"}},{"CommercialName":"UPTO55LB 25KG BAGGAGE","RficSubcode":"0C4","OwningCarrierCode":"PR","BoardPoint":"CEB","OffPoint":"MNL","TTLPrice":{"Price":"1250","Currency":"PHP"}},{"CommercialName":"UPTO66LB 30KG BAGGAGE","RficSubcode":"0C5","OwningCarrierCode":"PR","BoardPoint":"CEB","OffPoint":"MNL","TTLPrice":{"Price":"1500","Currency":"PHP"}},{"CommercialName":"UPTO35KG BAGGAGE","RficSubcode":"0C7","OwningCarrierCode":"PR","BoardPoint":"CEB","OffPoint":"MNL","TTLPrice":{"Price":"1750","Currency":"PHP"}},{"CommercialName":"UPTO88LB40KG BAGGAGE","RficSubcode":"0C8","OwningCarrierCode":"PR","BoardPoint":"CEB","OffPoint":"MNL","TTLPrice":{"Price":"2000","Currency":"PHP"}},{"CommercialName":"UPTO11LB 5KG BAGGAGE","RficSubcode":"0CW","OwningCarrierCode":"PR","BoardPoint":"CEB","OffPoint":"MNL","TTLPrice":{"Price":"250","Currency":"PHP"}},{"CommercialName":"UPTO22LB 10KG BAGGAGE","RficSubcode":"0CZ","OwningCarrierCode":"PR","BoardPoint":"CEB","OffPoint":"MNL","TTLPrice":{"Price":"500","Currency":"PHP"}},{"CommercialName":"GOLF EQUIPMENT UP TO 15 KG","RficSubcode":"0D4","OwningCarrierCode":"PR","BoardPoint":"CEB","OffPoint":"MNL","TTLPrice":{"Price":"1120","Currency":"PHP"}},{"CommercialName":"SCUBA EQUIPMENT UP TO 15 KG","RficSubcode":"0F6","OwningCarrierCode":"PR","BoardPoint":"CEB","OffPoint":"MNL","TTLPrice":{"Price":"1120","Currency":"PHP"}},{"CommercialName":"BICYCLE UP TO 33LB 15 KG","RficSubcode":"0FP","OwningCarrierCode":"PR","BoardPoint":"CEB","OffPoint":"MNL","TTLPrice":{"Price":"1120","Currency":"PHP"}},{"CommercialName":"FISHING EQUIPMENT UP TO 15 KG","RficSubcode":"0FW","OwningCarrierCode":"PR","BoardPoint":"CEB","OffPoint":"MNL","TTLPrice":{"Price":"1120","Currency":"PHP"}},{"CommercialName":"BOWLING EQUIP UP TO 15KG","RficSubcode":"0PY","OwningCarrierCode":"PR","BoardPoint":"CEB","OffPoint":"MNL","TTLPrice":{"Price":"1120","Currency":"PHP"}}]}},"token":""}',true);
				$data['user'] = $this->user;

				if($c_result['S']==0){
					$data['output'] = $c_result;
				}else{
					$data['result'] = $c_result['result'];
					$data['pnr'] = $PNR;
					$data['regcode'] = $this->user['R'];
					$data['bookingrqid'] = $this->input->post('bookingrqid');
				}

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('merged_flights/issueticket/viewpnr',$data);
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');

			}else if(isset($_POST['btnIssue'])){
				$PNR = $this->input->post('pnr');
				$BOOKINGRQID = $this->input->post('bookingrqid');

				$parameters = array(
						'dev_id'      	=> $this->global_f->dev_id(),
						'actionId' 	  	=> abacus_issue_ticket_domestic,
						'ip_address'  	=> $this->ip,
						'regcode' 	  	=> $this->user['R'],
						'pnr'			=> $PNR,
						'bookingrqid' 	=> $BOOKINGRQID,
				);
				$data['user'] = $this->user;
				$result = json_decode($this->curl->call($parameters,url),true);
				//$result = json_decode('{"S":1,"M":"Success","TKT":["TE 0792315970402-1Y LEE/J U30D*AMP 1607/09NOV*D","TE 0792315970403-1Y LEE/J U30D*AMP 1612/09NOV*D","TV 0792315970403-1Y  *VOID* U30D*ADB 1749/09NOV*E"]}',true);

				$data['output'] = $result;
				/*if($result['S']==0){
					goto gotosummary;
				}*/
				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('merged_flights/issueticket/summarypage',$data);
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');

			}else{
				$parameters = array(
						'dev_id'      => $this->global_f->dev_id(),
						'actionId' 	  => abacus_fetch_reserved_flights,
						'ip_address'  => $this->ip,
						'regcode' 	  => $this->user['R'],
						'flighttype'  => 'D',
						'datefrom'	  => '2016/01/01',
						'dateto' 	  => '2016/12/10'
				);
				$c_result = json_decode($this->curl->call($parameters,url),true);

				$data['user'] = $this->user;

				if($c_result['S']==0){
					$data['output'] = $c_result;
				}else{
					$data['result'] = $c_result['result'];
				}

				$this->load->view('layout/header',$data);
				$this->load->view('merged_flights/issueticket/header_index');
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('merged_flights/issueticket/index',$data);
				$this->load->view('element/wrapper_footer');
				$this->load->view('merged_flights/footer',$data);
				$this->load->view('merged_flights/issueticket/footer_index',$data);
			}


		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}

	}


	private function passengerSTRtoOBJ($PASSENGER_STR){
		$PASSENGER_OBJECT = array();
		foreach(explode('|*|',$PASSENGER_STR) as $passenger){
			$data = explode('|^@^|',$passenger);
			if(count($data)!=8){
				return false;
			}
			$P = array();
			foreach($data as $i_d => $d){
				$d = explode(':',$d);

				switch($i_d){
					case 0:
						$d[0] = str_replace('T','code',$d[0]);
						$P['infant'] = 'false';
						switch($d[1]){
							case 'A':
								$d[1] = 'ADT';
								break;
							case 'S':
								$d[1] = 'SRC';
								break;
							case 'C':
								$d[1] = 'CNN';
								$P['SSR'] = 'CHLD';
								break;
							case 'I':
								$d[1] = 'INF';
								$P['SSR'] = 'INFT';
								$P['infant'] = 'true';
								break;
						}
						break;
					case 1:
						$d[0] = str_replace('TL','gender',$d[0]);
						$d[1] = str_replace('1','M',$d[1]);     //MR
						$d[1] = str_replace('2','F',$d[1]);     //MRS
						$d[1] = str_replace('3','F',$d[1]);     //MISS
						$d[1] = str_replace('4','M',$d[1]);     //MASTER
						if($P['code']=='INF'){
							$d[1] .='I';
						}
						break;
					case 2:
						$d[0] = str_replace('FN','fname',$d[0]);
						break;
					case 3:
						$d[0] = str_replace('LN','lname',$d[0]);
						break;
					case 4:
						$d[0] = str_replace('DOB','dateofbirth',$d[0]);
						$d[1] = DateTime::createFromFormat("d-m-Y",str_replace('/','-',$d[1]));
						$P['age'] = $d[1]->diff(new DateTime())->y;

						$temp = 0;
						if($P['age']==1){
							$P['age'] -=1;
							$temp +=1;
						}
						if($P['age']==0){
							$P['age'] = (int)$d[1]->diff(new DateTime())->m+($temp*12);
						}
						break;
					case 5:
						$d[0] = str_replace('R','remarks',$d[0]);
						break;
				}

				$P[$d[0]] = $d[1];
			}
			$PASSENGER_OBJECT[] = $P;
		}
		return $PASSENGER_OBJECT;
	}

	private function contactSTRtoARR($CONTACT_STR){
		$ARR = explode('|^@^|',$CONTACT_STR);
		return $ARR;
	}

	private function getOnwardSTR($index,$collection){
		$f = $collection[0]['onward'][$index];
		$onward_str = '';
		foreach ($f['Flights'] as $_i => $o){
			$onward_str .= $o['CarrierID'] . '|^@^|' . $o['FlightNumber'] . '|^@^|' . $o['Source'] . '|^@^|' . $o['Destination'] . '|^@^|' . $o['DepartureTimeStamp'] . '|^@^|' . $o['ArrivalTimeStamp'] . '|^@^|' . $o['Class'] . '|^@^|' . ''/*resbookdesigcode*/ . '|^@^|' . $o['ResBookDesigCode'] . '|^@^|' . $o['MarketingAirline'] . '|^@^|' . $o['OperatingAirline'] . $_str=($_i < (count($f[0]['onward']) - 1) ? '|*|' : '');
		}
		return $onward_str;
	}

	private function getReturnSTR($index,$collection){
		$f = $collection[0]['return'][$index];
		if(count($collection[0]) == 2){
			$return_str = '';
			foreach ($f['Flights'] as $_i => $r){
				$return_str .= $r['CarrierID'] . '|^@^|' . $r['FlightNumber'] . '|^@^|' . $r['Source'] . '|^@^|' . $r['Destination'] . '|^@^|' . $r['DepartureTimeStamp'] . '|^@^|' . $r['ArrivalTimeStamp'] . '|^@^|' . $r['Class'] . '|^@^|' . ''/*resbookdesigcode*/ . '|^@^|' . $r['ResBookDesigCode'] . '|^@^|' . $r['MarketingAirline'] . '|^@^|' . $r['OperatingAirline'] . $_str=($_i < (count($f_return) - 1) ? '|*|' : '');
			}
			return $return_str;
		}else{
			return '';
		}
	}

	private function getPricingSTR($index1,$index2,$collection){
		$f1 = $collection[0]['onward'][$index1];
		$f2 = $collection[0]['return'][$index2];

		$pricing = $f1['Pricing'];
		$pricing_str = 'currency:' . $pricing['currency'] . ',BaseFareFee:' . $pricing['BaseFareFee'] . ',TaxFee:' . $pricing['TaxFee'] . ',SystemFee:' . $pricing['SystemFee'] . ',TotalFee:' . $pricing['TotalFee'];
		if(count($collection[0])==2 && $collection[0]['return']){
			$pricing = $f2['Pricing'];
			$pricing_str .= ';'.'currency:' . $pricing['currency'] . ',BaseFareFee:' . $pricing['BaseFareFee'] . ',TaxFee:' . $pricing['TaxFee'] . ',SystemFee:' . $pricing['SystemFee'] . ',TotalFee:' . $pricing['TotalFee'];
		}
		return $pricing_str;
	}

	private function getPassengerCount($collection){



		$adultcount 	= 0;
		$childrencount 	= 0;
		$infantcount 	= 0;
		$seniorcount 	= 0;


		foreach ($collection as $passenger){
			switch ($passenger['Type']) {
				case 'A':
					$adultcount++;
					break;
				case 'C':
					$childrencount++;
					break;
				case 'I':
					$infantcount++;
					break;
				case 'S':
					$seniorcount++;
					break;
			}
		}

		return array(
			'A' => $adultcount,
			'C' => $childrencount,
			'I' => $infantcount,
			'S' => $seniorcount
		);
	}





}