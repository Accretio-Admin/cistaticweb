<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merged_intl_flights_new extends CI_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->model('Curl_model','curl');
		$this->load->model('International_ticketing_model');
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
	    $this->load->model('Query_model');
	  	$this->load->model('Global_function','global_f');
	  	$this->load->model('Sp_model');
//update by nhez 03/21/2017
	  	// $ACC_CONTROL = $this->Sp_model->userprivilege(); 
	   // 	$this->user['A_CTRL'] = $ACC_CONTROL['A_CTRL'];
	   // 	$this->session->set_userdata('user',$this->user);
	}

	public function index()
	{
		if ($this->user['A_CTRL']['online_booking'] == 1){
			$data = array('menu' => 9,
						  'parent'=>'DOMESTIC_FLIGHTS' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['user'] = $this->user;
			
				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('onlinebooking/merged_intl_flights');
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

	function fetch_airlines(){

		if (isset($_POST['selCountry'])){
			$URL = url_mobilereports.'/intl_airports3/?country='.urlencode($_POST['selCountry']);
			$result = json_decode($this->curl->call('',$URL),true);
			echo json_encode($result);

		}else{
			$result = array('S' => 0, 'M' => 'Invalid input');
		}

	}
	
	public function book_international_flights()
	{
		if ($this->user['A_CTRL']['online_booking'] == 1){
			$data = array('menu' => 9,
						  'parent'=>'DOMESTIC_FLIGHTS' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['user'] = $this->user;
				$INPUT_POST = $this->input->post(null,true);
				$flighttype = $this->input->post('flighttype');
				$data['process'] = 0;

				if (isset($_POST['btnSearchBooking'])) {
					$data['process'] = 1;

					if ($flighttype == 2) {
						$datereturn = 0;
						$INPUT_POST['datereturn'] = 0;
					}

						$origin = explode("|", $INPUT_POST['origin2']);
						$destination = explode("|", $INPUT_POST['destination2']);

						$url = url;
						$parameters = array(	
									'dev_id'     			=> $this->global_f->dev_id(),
				    				'regcode'               =>$this->user['R'],
				    				'actionId'				=>'merged_ticketing_service2/search_flights_international',
				    				'ip_address'			=>$this->ip,
				    				'origin'                =>$origin[0],
				    				'destination'           =>$destination[0],
				    				'airline'               =>$INPUT_POST['airlines'],
				    				'leavedate'				=>$INPUT_POST['dateleave'],
				    				'returndate'			=>$INPUT_POST['datereturn'],
				    				'seatclass'				=>$INPUT_POST['class'],
				    				'adult'					=>$INPUT_POST['adult'],
				    				'children'				=>$INPUT_POST['children'],
				    				'infant'				=>$INPUT_POST['infant'],
				    				'SKT'				    =>$this->user['SKT'],
				    				 $this->user['SKT']	    => md5($this->user['R'].$this->user['SKT'])
				    			);
						
						// echo '<pre>';
						// 	print_r($parameters);
						// echo '</pre>';

					    $results = json_decode($this->curl->call($parameters,$url),true);
					    
						// echo '<pre>';
						// 	print_r($results);
						// echo '</pre>';

					    	if ($results) {
					    		if ($results['S'] == 1) {

					    			$data['result'] = $results['result'];
					    			$data['flighttype'] = $flighttype;

									$adult = 0;
									$children = 0;
									$infant = 0;

									for ($i=0; $i < count($results['Passenger']); $i++) { 
										if ($results['Passenger'][$i]['Type'] == 'A' || $results['Passenger'][$i]['Type'] == 'S') {
											$adult = $adult + 1;
										}elseif ($results['Passenger'][$i]['Type'] == 'C') {
											$children = $children + 1;
										}elseif ($results['Passenger'][$i]['Type'] == 'I') {
											$infant = $infant + 1;	
										}
									}

									$data['Passengers'] = array('Adult' => $adult, 'Children' => $children, 'Infant' => $infant, 'senior' => 0);

									$data['flight_details'] = json_encode(array(
										'rqid'           => $results['RQID'],
										'byaheko_RQID' 	 => $results['byaheko_RQID'],
										'passenger'      => $results['Passenger']
									));

									$data['visaStatus'] = $results['visaStatus'];
									$data['process'] = 1;
									$data['collection'] = $data;
					    		}else{
					    			$data['process'] = 0;
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
				}

				if (isset($_POST['btnSelectFlight'])) {
					
					$flight_details = json_decode($this->input->post('flight_details'),true);
					$flight_no = json_decode($this->input->post('choose_flights'),true);
					$visaStatus = json_decode($this->input->post('visaStatus'),true);

					// echo '<pre>';
					// 	print_r($flight_no);
					// echo '</pre>';

					$onward = $this->International_ticketing_model->get_parsed_Newdata($flight_no[0]['pricing']['provider'],$flight_no[0]['onward'],$flight_no[0]['connecting_onward'],$flight_no[0]['connecting_onward2'],1);

					if ($flight_no[0]['return']!=""){ 
						$return = $this->International_ticketing_model->get_parsed_Newdata($flight_no[0]['pricing']['provider'],$flight_no[0]['return'],$flight_no[0]['connecting_return'],$flight_no[0]['connecting_return2'],1);
					}
					
					$pricing = $this->International_ticketing_model->get_parsed_Newdata($flight_no[0]['pricing']['provider'],$flight_no[0]['pricing'],2);
					// echo '<pre>';
					// 		print_r($pricing);
					// 	echo '</pre>';
					$passengers = $this->International_ticketing_model->get_passengers_count($flight_details['passenger']);

					if($flight_no[0]['pricing']['provider']=='byaheko'){
						$requestid = $flight_details['byaheko_RQID'];

					} else {
						$requestid = $flight_details['rqid'];
					}

					$url = url;
					$parameters = array(	
								'dev_id'     			=> $this->global_f->dev_id(),
			    				'regcode'               =>$this->user['R'],
			    				'actionId'				=>'merged_ticketing_service2/intlpricing_rates_request',
			    				'ip_address'			=>$this->ip,
			    				'requestid'				=>$requestid,
			    				'onward'				=>$onward,		
			    				'return'				=>$return,
			    				'onwardPricing'			=>$pricing,
			    				'flighttype'			=>1,
			    				'adult'					=>$passengers['adult'],
			    				'children'				=>$passengers['children'],
			    				'infant'				=>$passengers['infant'],
			    				'senior'				=>$passengers['senior'],
			    				'flightid'				=> $flight_no[0]['pricing']['identifier'],
			    				'provider' 				=> $flight_no[0]['pricing']['provider'],
			    				'visaStatus'		 	=> $visaStatus,
			    				'SKT'					=> $this->user['SKT'],
			    				 $this->user['SKT']	    => md5($this->user['R'].$this->user['SKT'])
			    						);
					// echo '<pre>';
					// 		print_r($parameters);
					// 	echo '</pre>';
				    $baggages = json_decode($this->curl->call($parameters,$url),true);
				 //    echo '<pre>';
					// 	print_r($baggages);
					// echo '</pre>';

					 	if ($baggages) {

						 	if ($baggages['S'] == 1){

						 		$this->session->set_userdata('baggages',$baggages);

						 		$this->session->set_userdata('flight_onward',json_decode(json_encode($flight_no[0]['onward']), true));
							 	$this->session->set_userdata('flight_return',json_decode(json_encode($flight_no[0]['return']), true));

			 				 	$data['flight_details'] = $this->input->post('flight_details');
						 		$data['onwardbaggages'] = $baggages['OB'];
						 		$data['returnbaggages'] = $baggages['RB'];
						 		$this->session->set_userdata('choose_flights',$flight_no);
						 		$data['choose_flights']	= $this->session->userdata('choose_flights');
						 		$data['totalfee'] 		= $flight_no[0]['pricing']['currency'].' '.number_format($flight_no[0]['pricing']['TotalFee'],2);
						 		$data['passengers'] 	= $flight_details['passenger'];
						 		$data['provider'] 		= $flight_no[0]['pricing']['provider'];
							 	$data['process'] 		= 2;
							 	$data['collection2'] 	= json_decode($this->input->post('collection'),true);

							 	$data['flight_onward'] = $this->session->userdata('flight_onward');
								$data['flight_return'] = $this->session->userdata('flight_return');

								$data['visaStatus'] = $this->input->post('visaStatus');
								$data['country'] = $baggages['country'];

								// var_dump($data['country']);

						 	}else {

								$data = json_decode($this->input->post('collection'),true);
								$data['collection'] = $data;

								$back = $this->input->post('back');
								if($back == 2) {

								} else {
				    				$data['output'] = array(

				    				'S' => 0,
				    				'M' => $baggages['M']
				    					
				    				);	
				    			}

						 	}

					 	}else{
			    			$data['process'] = 0;
			    			$data['output'] = array(

			    				'S' => 0,
			    				'M' => 'Transaction Failed'
			    				
			    			);	
					 	}
				}

				if (isset($_POST['btnBookFlights'])) {

						$form_data = $this->input->post(null,true);
						$chosen = json_decode($form_data['choose_flights']);
						// echo '<pre>';
						// 	print_r($form_data);
						// echo '</pre>';
						//$others = array($form_data['contactno'],$form_data['street'],$form_data['city'],$form_data['zipcode'],$form_data['transpass'],$form_data['flight_details']);
						$others = array($form_data['contactno'],$form_data['street'],$form_data['city'],$form_data['zipcode'],$form_data['flight_details']);
						// echo '<pre>';
						// 	print_r($others);
						// echo '</pre>';
						//unset($form_data['contactno'],$form_data['street'],$form_data['city'],$form_data['zipcode'],$form_data['transpass'],$form_data['TERMS'],$form_data['btnBookFlights'],$form_data['flight_details']);
						unset($form_data['contactno'],$form_data['street'],$form_data['city'],$form_data['zipcode'],$form_data['btnBookFlights'],$form_data['flight_details']);
						// $parsed_passengers = $this->International_ticketing_model->get_parsed_passengers($form_data);
						if($form_data['provider'] == 'byaheko') {
							$parsed_passengers = $this->International_ticketing_model->get_parsed_passengersByaheko($form_data);
							$requestid = json_decode($others[4],true)['byaheko_RQID'];

						} else if($form_data['provider'] == 'amadeus') {
							$parsed_passengers = $this->International_ticketing_model->get_parsed_passengersAmadeus($form_data);
							$requestid = json_decode($others[4],true)['rqid'];
							
						} else {
							$parsed_passengers = $this->International_ticketing_model->get_parsed_passengers($form_data);
							$requestid = json_decode($others[4],true)['rqid'];
						}

						$parsed_passportupload = $this->International_ticketing_model->get_parsed_passportuploads($form_data);
						$parsed_visaupload = $this->International_ticketing_model->get_parsed_visauploads($form_data);

						$parameters = array(
							'dev_id'        => $this->global_f->dev_id(),
							'regcode' 		=> $this->user['R'],
							'requestid'	    => $requestid,
							//'transpass' 	=> $others[4],
							'passenger' 	=> $parsed_passengers,
							'street' 		=> $others[1],
							'city' 			=> $others[2],
							'zipcode' 		=> $others[3],
							'phone' 		=> $others[0],
							'flightid'		=> $chosen[0]->pricing->identifier,
							'provider' 		=> $form_data['provider'],
							'visaStatus'    => $form_data['visaStatus'],
							'passportImg'   => $parsed_passportupload,
							'visaImg'    	=> $parsed_visaupload,
							'SKT'			=> $this->user['SKT'],
							$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'])
						);

						// echo '<pre>';
						// 	print_r($parameters);
						// echo '</pre>';

						$this->session->set_userdata('last_parameters',$parameters);
						// $data['ui_passengers_details'] = $this->International_ticketing_model->ui_passengers_details($form_data,$this->session->userdata('baggages'));
						if($form_data['provider'] == 'byaheko') {
							$data['ui_passengers_details'] = $this->International_ticketing_model->ui_passengers_detailsByaheko($form_data,$this->session->userdata('baggages'));

						} else if($form_data['provider'] == 'amadeus') {
							$data['ui_passengers_details'] = $this->International_ticketing_model->ui_passengers_detailsAmadeus($form_data,$this->session->userdata('baggages'));

						} else {
							$data['ui_passengers_details'] = $this->International_ticketing_model->ui_passengers_details($form_data,$this->session->userdata('baggages'));
						}
						$data['contact_info'] = 
											array(
												'street' => $others[1],
												'city' => $others[2],
												'zipcode' => $others[3],
												'phone' => $others[0],
											);

						$data['payment_details'] = $this->session->userdata('baggages');	
						$data['flight_details'] = $this->input->post('flight_details');	
						$data['visaStatus'] = $this->input->post('visaStatus');		

						$this->session->set_userdata('flight_onward',json_decode(json_encode($chosen[0]->onward), true));
						$this->session->set_userdata('flight_onwardCon',json_decode(json_encode($chosen[0]->connecting_onward), true));
						$this->session->set_userdata('flight_onwardCon2',json_decode(json_encode($chosen[0]->connecting_onward2), true));
						$this->session->set_userdata('flight_return',json_decode(json_encode($chosen[0]->return), true));
						$this->session->set_userdata('flight_returnCon',json_decode(json_encode($chosen[0]->connecting_return), true));
						$this->session->set_userdata('flight_returnCon2',json_decode(json_encode($chosen[0]->connecting_return2), true));

						$this->session->set_userdata('choose_flights',json_decode(json_encode($chosen), true));
						$data['choose_flights'] = $this->session->userdata('choose_flights');

						$data['flight_onward'] = $this->session->userdata('flight_onward');
						$data['flight_onwardCon'] = $this->session->userdata('flight_onwardCon');
						$data['flight_onwardCon2'] = $this->session->userdata('flight_onwardCon2');
						$data['flight_return'] = $this->session->userdata('flight_return');
						$data['flight_returnCon'] = $this->session->userdata('flight_returnCon');
						$data['flight_returnCon2'] = $this->session->userdata('flight_returnCon2');
						$data['provider'] = $form_data['provider'];	
						$data['collection'] = $data;
						$data['process'] = 3;

						// echo '<pre>';
						// 	print_r($data['choose_flights']);
						// echo '</pre>';

				}

				if (isset($_POST['btnConfirm'])) {
					$information = $this->session->userdata('last_parameters');

					$url = url;
				 	$parameters = array(
				 		'dev_id'     		=> $this->global_f->dev_id(),
						'regcode' 	 		=> $this->user['R'],
						'actionId'	 		=> 'merged_ticketing_service2/international_booking_request',
						'ip_address' 		=> $this->ip,
						'requestid'  		=> $information['requestid'],
						'transpass'  		=> $this->input->post('transpass'),
						'passenger'  		=> $information['passenger'],
						'street' 	 		=> $information['street'],
						'city'		 		=> $information['city'],
						'zipcode' 			=> $information['zipcode'],
						'phone' 	 		=> $information['phone'],
						'identifier' 	 	=> $information['flightid'],
						'provider' 			=> $information['provider'],
						'visaStatus'		=> $information['visaStatus'],
						'passportImg'		=> $information['passportImg'],
						'visaImg'			=> $information['visaImg'],
						'SKT'				=> $this->user['SKT'],
						$this->user['SKT'] 	=> md5($this->user['R'].$this->user['SKT'].md5($this->input->post('transpass')))
				 	);

				 	// echo '<pre>';
						// 	print_r($parameters);
						// echo '</pre>';
				 $data['confirm'] = json_decode($this->curl->call($parameters,$url),true);				 
				// echo '<pre>';
				// 			print_r($data['confirm']);
				// 		echo '</pre>';
				 if ($data['confirm']['S'] == 0) {
				 	$m = $data['confirm']['M'];
					$data = json_decode($this->input->post('collection'),true);
					$data['collection'] = $data;
				 	$data['process'] = 3;
	    			$data['output'] = array(
	    				'S' => 0,
	    				'M' => $m
	    			);
				 }elseif ($data['confirm']['S']==1) {
				 	$data['process'] = 0;
	    			$data['output'] = array(
	    				'S' => 1,
	    				'M' => $data['confirm']['M'],
	    				'URL'=> "http://mobilereports.globalpinoyremittance.com/portal/ticketing_international_receipt/",
	    				'TN' => $data['confirm']['TN']
	    			);
				 	$this->user['EC'] = $data['confirm']['EC'];
					$data['user'] = $this->global_f->get_user_session();

					$this->session->unset_userdata('last_parameters');
				 	$this->session->unset_userdata('flight_onward');
				 	$this->session->unset_userdata('flight_onwardCon');
				 	$this->session->unset_userdata('flight_onwardCon2');
				 	$this->session->unset_userdata('flight_return');
				 	$this->session->unset_userdata('flight_returnCon');
				 	$this->session->unset_userdata('flight_returnCon2');
				 	$this->session->unset_userdata('choose_flights');
				 }elseif ($data['confirm']['S']== 2) {
				 	$data['process'] = 0;
	    			$data['output'] = array(
	    				'S' => $data['confirm']['S'],
	    				'M' => $data['confirm']['M']
	    			);
	    			$this->user['EC'] = $data['confirm']['EC'];
					$data['user'] = $this->global_f->get_user_session();

	    			$this->session->unset_userdata('last_parameters');
				 	$this->session->unset_userdata('flight_onward');
				 	$this->session->unset_userdata('flight_onwardCon');
				 	$this->session->unset_userdata('flight_onwardCon2');
				 	$this->session->unset_userdata('flight_return');
				 	$this->session->unset_userdata('flight_returnCon');
				 	$this->session->unset_userdata('flight_returnCon2');
				 	$this->session->unset_userdata('choose_flights');
				 }
				 
				}	

				//$data['airports'] = $this->International_ticketing_model->get_airports();
				//$data['airlines'] = $this->International_ticketing_model->get_iairlines();
				$data['airports'] = json_decode($this->curl->call('',url_mobilereports.'/intl_airports2'),true);
				$data['airlines'] = json_decode($this->curl->call('',url_mobilereports.'/intl_airlines'),true);

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('onlinebooking/book_intl_flights_new'); 
				$this->load->view('onlinebooking/intl_scripts'); 
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');	

			}else {
				$this->session->unset_userdata('user');
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
			//$this->session->unset_userdata('user');
			//$this->session->sess_destroy();
			redirect('Main/');
		}		

	}
	
	public function markup_international()
	{
		if ($this->user['A_CTRL']['online_booking'] == 1){
			$data = array('menu' => 9,
						  'parent'=>'DOMESTIC_FLIGHTS' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['user'] = $this->user;

				if (isset($_POST['btnUpdateMarkup'])) {
					$url = url;
					$parameters = array(
						'dev_id'      => $this->global_f->dev_id(),
						'regcode' 	  => $this->user['R'],
						'actionId' 	  =>_update_mark_up,
						'ip_address'  =>$this->ip,
						'markup_type' => 1,
						'markup' 	  => $this->input->post('markup'),
						'transpass'   => $this->input->post('transpass'),
						$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'].$others[4])
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
					'actionId' 	  =>_fetch_mark_up,
					'ip_address'  =>$this->ip,
					'regcode' 	  => $this->user['R'],
					'markup_type' => 1
			 	);
			 	$data['mark_up'] = json_decode($this->curl->call($parameters,$url),true)['MU'];

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('onlinebooking/markup_international'); 
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');	
			}else {
				$this->session->unset_userdata('user');
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
			//$this->session->unset_userdata('user');
			//$this->session->sess_destroy();
			redirect('Main/');
		}	
	}

	public function eticketing_international($provider, $tn)
	{
		if ($this->user['A_CTRL']['online_booking'] == 1){
			$data = array('menu' => 9,
						  'parent'=>'DOMESTIC_FLIGHTS' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				if ($tn){
						// provider -> 1=via, 2=byaheko

						if($provider == '2') {
							$actionId = 'ups_byaheko_service/intl_update_transaction';
						} else {
							$actionId = _international_update_transaction;
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
						
						// var_dump($parameters);
						// var_dump($data['API']);die;

					}

				$data['user'] = $this->user;
				$url = url;
				$parameters = array(
					'dev_id'     => $this->global_f->dev_id(),
					'regcode' 	 => $this->user['R'],
					'actionId' 	 =>_international_booking_transactions,
					'ip_address' =>$this->ip,
					$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'])
				);

				$data['result'] = json_decode($this->curl->call($parameters,$url),true);

				// var_dump($data['result']);die;

				$data['field'] = array('Status','Transaction #','PNR #','Passenger','Onward(Flight Number)','Source','Destination','Departure','Arrival','Class','Markup Fee','Total Fee','Baggage Fee');

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('onlinebooking/eticketing_international'); 
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');	
			}else {
				$this->session->unset_userdata('user');
				$this->session->sess_destroy();
				redirect('Login/');
			}
		}else {
			//$this->session->unset_userdata('user');
			//$this->session->sess_destroy();
			redirect('Main/');
		}	
	}

	public function compress_image($source_url, $destination_url, $quality)
	{

		ini_set("memory_limit", "512M");  

		$info = getimagesize($source_url); 

		if ($info['mime'] == 'image/jpeg') 
		$image = imagecreatefromjpeg($source_url); 

		elseif ($info['mime'] == 'image/gif') 
		$image = imagecreatefromgif($source_url);

		elseif ($info['mime'] == 'image/png')
		$image = imagecreatefrompng($source_url); 

		imagejpeg($image, $destination_url, $quality);

	 	return $destination_url; 

	} 

	public function add_newid_payout()
	{

		$TYPE = $this->input->post('type');

		$datetoday = date("Y-m-d");


		if ($_FILES['file']['error'] == 0){

			if($_FILES['file']['size'] < 2*MB) {

				$url = $_FILES["file"]["tmp_name"];


				if($_FILES['file']['size'] > 1*MB)
				{
					$old_size = $_FILES['file']['size'];
		    		$urltmp = sys_get_temp_dir().'/tmp.jpg';
					$filename = $this->compress_image($_FILES["file"]["tmp_name"], $urltmp, 75);
					$new_size = filesize($urltmp);
					
					if($new_size < $old_size)
					{
						$url = $urltmp;
					}
				}

				if (false) {//ftp
					$curtime=time();
					if ($TYPE == 'VISA') {
						$image_id = md5($this->user['R'].$curtime) . '_visa_web.jpg';
						$URL = 'ftp://'.ftp_server_radius.':800/ticketing/visa/';
						$attachment = 'ftp://frequest:frequest@'.ftp_server_radius.':800/ticketing/visa/'.$image_id;
					} else {
						$image_id = md5($this->user['R'].$curtime) . '_pass_web.jpg';
						$URL = 'ftp://'.ftp_server_radius.':800/ticketing/passport/';
						$attachment = 'ftp://frequest:frequest@'.ftp_server_radius.':800/ticketing/passport/'.$image_id;
					}
	
					$ch = curl_init();
					$localfile = $url;
					$fp = fopen($localfile, 'r');
					curl_setopt($ch, CURLOPT_URL, $URL.$image_id);
					curl_setopt($ch, CURLOPT_USERPWD, "argel:argel_argel!!!");
					curl_setopt($ch, CURLOPT_UPLOAD, 1);
					curl_setopt($ch, CURLOPT_INFILE, $fp);
					curl_setopt($ch, CURLOPT_INFILESIZE, filesize($localfile));
					curl_exec ($ch);
					$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
					$error_no = curl_errno($ch);
					curl_close ($ch);

					// $attachment = 'ftp://frequest:frequest@210.213.236.42:800/ticketing/passport/'.$image_id;
					// print_r($_POST);
					// print_r($_FILES);

					// check upload status
					if ($error_no == 0)
					{ 
						//if success 				
						$result = array('success'=>1,'M'=>'Upload Successful!','A'=>$attachment);
						echo json_encode($result);
					} 
					else 
					{
						//if failed
						$result = array("S"=>0,'M'=>"Upload Incomplete! Please try again and upload");
						echo json_encode($result);
					}
				} else {//sftp
					$file_location = ($TYPE == 'VISA')? 'ticketing/visa':'ticketing/passport';

					$curl = curl_init();
					$localfile = $url;

					curl_setopt_array($curl, array(
						CURLOPT_URL => 'https://unified.ph/kyc-upload',
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_ENCODING => '',
						CURLOPT_MAXREDIRS => 10,
						CURLOPT_TIMEOUT => 0,
						CURLOPT_FOLLOWLOCATION => true,
						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						CURLOPT_CUSTOMREQUEST => 'POST',
						CURLOPT_POSTFIELDS => array('file'=> new CURLFILE($localfile),'file_location' => $file_location,'regcode' => $this->user['R'],'email' => '123','ext_name' => '.jpg'),
					));
					
					$response = curl_exec($curl); 
					curl_close($curl);
					$upload_response = json_decode($response,true);
					
					if ($upload_response['S'] == 1)
					{
						$filename = $upload_response['F'];
						$download_link = base_url().'remittance_payout/downloadSftpFile/'.$file_location.'/'.$filename;
						$result = array('success'=>1,'M'=>'Upload Successful!','A'=>$download_link);
						echo json_encode($result);
					}
					else //upload failed
					{
						echo json_encode($upload_response);
					}
				}
		   	}
		   	else
		   	{
				$result = array("S"=>0,'M'=>"Invalid Image Size, Should be less than 2MB");
				echo json_encode($result);
		   	}
	   }
	   else
	   {
			$result = array("S"=>0,'M'=>"Invalid Image Size, Should be less than 2MB");
			echo json_encode($result);
	   }
	}


}