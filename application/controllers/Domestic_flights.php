<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Domestic_flights extends CI_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->model('curl_model','curl');
		$this->load->model('Domestic_ticketing_model');
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
	  	$this->load->model('Sp_model');
//update by nhez 03/21/2017
	  	// $ACC_CONTROL = $this->Sp_model->userprivilege(); 
	   // 	$this->user['A_CTRL'] = $ACC_CONTROL['A_CTRL'];
	   // 	$this->session->set_userdata('user',$this->user);
	}

	public function index()
	{
		if ($this->user['A_CTRL']['online_booking'] == 1){
		$data = array('menu' => 8,
					 'parent'=>'DOMESTIC_FLIGHTS' );
		
			if ($this->user['S'] == 1 && $this->user['R'] !=""){
		
				$data['user'] = $this->user;
				$this->load->view('onlinebooking/index',$data);
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

	public function book_flights()
	{
		if ($this->user['A_CTRL']['online_booking'] == 1){
			$data = array('menu' => 8,
				    	 'parent'=>'DOMESTIC_FLIGHTS' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
					$data['user'] = $this->user;
					$data['process'] = 0;
				
						if (isset($_POST['btnSearchBooking'])) {

							$flighttype = $this->input->post('flighttype');
							$origin = $this->input->post('origin');
							$destination = $this->input->post('destination');
							$airlines = $this->input->post('airlines');
							$dateleave = $this->input->post('dateleave');
							$datereturn = $this->input->post('datereturn');
							$class = $this->input->post('class');
							$adult = $this->input->post('adult');
							$child = $this->input->post('children');
							$infant = $this->input->post('infant');
							$senior = $this->input->post('senior_mode');

							if ($flighttype == 0) {
								$datereturn = 0;
							}

							$url = url;
							$parameters = array(	
								'dev_id'     			=> $this->global_f->dev_id(),
			    				'regcode'               =>$this->user['R'],
			    				'actionId'				=>_search_domestic_flights,
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
			    				 $this->user['SKT']	    => md5($this->user['R'].$this->user['SKT'])
					    	);



						    $results = json_decode($this->curl->call($parameters,$url),true);

					    	if ($results) {
					    		if ($results['S'] == 1) {
					    			
					    			$data['results_onward'] = $results['result'][0]['onward'];
									$data['results_return'] = $results['result'][1]['return'];
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

									if ($senior == 1) {
										$data['Passengers'] = array('Adult' => $adult, 'senior' => 1);
									}else{
										$data['Passengers'] = array('Adult' => $adult, 'Children' => $children, 'Infant' => $infant, 'senior' => 0);
									}

									$data['flight_details'] = json_encode(array(
										'rqid' => $results['RQID'],
										'passenger' => $results['Passenger'],
										'onward_flights' => $data['results_onward'],
										'return_flights' => $data['results_return']
									));
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
						$onward = $this->Domestic_ticketing_model->get_parsed_data($flight_details['onward_flights'],$this->input->post('choose_onward_flight'),1);
						$onward_pricing = $this->Domestic_ticketing_model->get_parsed_data($flight_details['onward_flights'],$this->input->post('choose_onward_flight'),2);
						$return = $this->Domestic_ticketing_model->get_parsed_data($flight_details['return_flights'],$this->input->post('choose_return_flight'),1);
						$return_pricing = $this->Domestic_ticketing_model->get_parsed_data($flight_details['return_flights'],$this->input->post('choose_return_flight'),2);
						$passengers = $this->Domestic_ticketing_model->get_passengers_count($flight_details['passenger']);
					 	$url = url;
					 	$parameters = array(
					 		'dev_id'     	=> $this->global_f->dev_id(),
							'regcode' 	 	=> $this->user['R'],
							'actionId' 	 	=>_choose_domestic_flights,
							'ip_address' 	=>$this->ip,
							'requestid'  	=> $flight_details['rqid'],
							'onward'	 	=> $onward,
							'return'	    => $return,
							'onwardPricing' => $onward_pricing,
							'returnPricing' => $return_pricing,
							'flighttype' 	=> 2,
							'adult' 		=> $passengers['adult'],
							'children' 		=> $passengers['children'],
							'infant' 		=> $passengers['infant'],
							'senior' 		=> $passengers['senior'],
							$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'])
					 	);
				 		$onward = explode(":", explode(",", $parameters['onwardPricing'])[4])[1];
				 		$return = explode(":", explode(",", $parameters['returnPricing'])[4])[1];
				 		$total = $onward + $return;
					 	$baggages = json_decode($this->curl->call($parameters,$url),true);
			 
					 	if ($baggages) {

					 		if($baggages['S'] == 1) {

						 		$this->session->set_userdata('baggages',$baggages);

			 				 	$data['flight_details'] = $this->input->post('flight_details');
						 		$data['onwardbaggages'] = $baggages['OB'];
						 		$data['returnbaggages'] = $baggages['RB'];
						 		$data['totalfee'] = 'PHP '.$total;
						 		$data['passengers'] = $flight_details['passenger'];				 		
							 	$data['process'] = 2;

							}else{
								
								$data = json_decode($this->input->post('collection'),true);
								$data['collection'] = $data;
				    			$data['output'] = array(

				    				'S' => 0,
				    				'M' => $baggages['M']
				    				
				    			);
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

						//$others = array($form_data['contactno'],$form_data['street'],$form_data['city'],$form_data['zipcode'],$form_data['transpass'],$form_data['flight_details']);
						$others = array($form_data['contactno'],$form_data['street'],$form_data['city'],$form_data['zipcode'],$form_data['flight_details']);
				
						//unset($form_data['contactno'],$form_data['street'],$form_data['city'],$form_data['zipcode'],$form_data['transpass'],$form_data['TERMS'],$form_data['btnBookFlights'],$form_data['flight_details']);
						unset($form_data['contactno'],$form_data['street'],$form_data['city'],$form_data['zipcode'],$form_data['btnBookFlights'],$form_data['flight_details']);
						$parsed_passengers = $this->Domestic_ticketing_model->get_parsed_passengers($form_data);
						
						$parameters = array(
							'dev_id'        => $this->global_f->dev_id(),
							'regcode' 		=> $this->user['R'],
							'requestid'	    => json_decode($others[4],true)['rqid'],
							//'transpass' 	=> $others[4],
							'passenger' 	=> $parsed_passengers,
							'street' 		=> $others[1],
							'city' 			=> $others[2],
							'zipcode' 		=> $others[3],
							'phone' 		=> $others[0],
							$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'])
						);
								
						$this->session->set_userdata('last_parameters',$parameters);
						$data['ui_passengers_details'] = $this->Domestic_ticketing_model->ui_passengers_details($form_data,$this->session->userdata('baggages'));
						$data['contact_info'] = 
											array(
												'street' => $others[1],
												'city' => $others[2],
												'zipcode' => $others[3],
												'phone' => $others[0],
											);
						$data['payment_details'] = $this->session->userdata('baggages');					
						// foreach ($ui_passengers_details as $key) {
						//var_dump($data['ui_passengers_details'],$data['contact_info'],$this->session->userdata('baggages'));
						// }
						//die();
						$data['collection'] = $data;
						$data['process'] = 3;

					}
					if (isset($_POST['btnConfirm'])) {
						$data['information'] = $this->session->userdata('last_parameters');
						$url = url;
					 	$parameters = array(
					 		'dev_id'     => $this->global_f->dev_id(),
							'regcode' 	 => $this->user['R'],
							'actionId'   =>_domestic_booking_request,
							'ip_address' =>$this->ip,
							'requestid'  => $data['information']['requestid'],
							'transpass'  => $this->input->post('transpass'),
							'passenger'  => $data['information']['passenger'],
							'street' 	 => $data['information']['street'],
							'city'		 => $data['information']['city'],
							'zipcode' 	 => $data['information']['zipcode'],
							'phone' 	 => $data['information']['phone'],
							 $this->user['SKT'] => md5($this->user['R'].$this->user['SKT'].md5($this->input->post('transpass')))
					 	);
				 	
					 $data['confirm'] = json_decode($this->curl->call($parameters,$url),true);

					 if ($data['confirm']['S'] === 0) {
					 	$m = $data['confirm']['M'];
						$data = json_decode($this->input->post('collection'),true);
						$data['collection'] = $data;
						$data['process'] = 3;
		    			$data['output'] = array(
		    				'S' => 0,
		    				'M' => $m
		    			);
					 }elseif ($data['confirm']['S']=== 1) {
					 	$data['process'] = 0;
		    			$data['output'] = array(
		    				'S' => 1,
		    				'M' => $data['confirm']['M'],
		    				'URL'=> "https://mobilereports.globalpinoyremittance.com/ticketing/domestic/receipt.php?tn=",
		    				'TN' => $data['confirm']['TN']
		    			);
				  		$this->user['EC'] = $data['confirm']['EC'];		  	
				  		$data['user'] = $this->global_f->get_user_session();
				  		
					 }elseif ($data['confirm']['S']=== 2) {
					 	$this->session->unset_userdata('last_parameters');
					 	$data['process'] = 0;
		    			$data['output'] = array(
		    				'S' => $data['confirm']['S'],
		    				'M' => $data['confirm']['M']
		    			);
					 }

					 
					}	
					//$data['airports'] = $this->Domestic_ticketing_model->get_airports(); //old hardcoded db
					$data['airports'] = json_decode($this->curl->call('',url_mobilereports.'/domestic_airports'),true);
					$data['airlines'] = json_decode($this->curl->call('',url_mobilereports.'/domestic_airlines'),true);

					$this->load->view('layout/header',$data);
					$this->load->view('element/top_header');
					$this->load->view('element/wrapper_header');
					$this->load->view('element/left_panel');
					$this->load->view('onlinebooking/book_flights',$data); 
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

	public function markup()
	{
		if ($this->user['A_CTRL']['online_booking'] == 1){
			$data = array('menu' => 8,
						 'parent'=>'DOMESTIC_FLIGHTS' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				
				if (isset($_POST['btnUpdateMarkup'])) {
					$url = url;
					$parameters = array(
						'dev_id'      => $this->global_f->dev_id(),
						'regcode' 	  => $this->user['R'],
						'actionId' 	  =>_update_mark_up,
						'ip_address'  =>$this->ip,
						'markup_type' => 2,
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
						'markup_type' => 2
			 	);
			 	$data['mark_up'] = json_decode($this->curl->call($parameters,$url),true)['MU'];
				
				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('onlinebooking/markup',$data); 
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

	public function eticketing($tn)
	{
		if ($this->user['A_CTRL']['online_booking'] == 1){
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
				$data['field'] = array('Status','Transaction #','PNR #','Passenger','Onward (Flight Number)','Source','Destination','Departure','Arrival','Class','Markup Fee','Total Fee','Baggage Fee');

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

		}else {
			//$this->session->unset_userdata('user');
			//$this->session->sess_destroy();
			redirect('Main/');
		}
		
	}
 
}