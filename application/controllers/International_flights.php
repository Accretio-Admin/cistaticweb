<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class International_flights extends CI_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->model('curl_model','curl');
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
				$this->load->view('onlinebooking/international_flights');
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

					if ($flighttype == 0) {
						$datereturn = 0;
					}

						$origin = explode("|", $INPUT_POST['origin2']);
						$destination = explode("|", $INPUT_POST['destination2']);

						$url = url;
						$parameters = array(	
									'dev_id'     			=> $this->global_f->dev_id(),
				    				'regcode'               =>$this->user['R'],
				    				'actionId'				=>_search_international_flights,
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
				    				 $this->user['SKT']	    => md5($this->user['R'].$this->user['SKT'])
				    						);

					    $results = json_decode($this->curl->call($parameters,$url),true);

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
										'passenger'      => $results['Passenger']
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
					$flight_no = json_decode($this->input->post('choose_flights'),true);
					$onward = $this->International_ticketing_model->get_parsed_data($flight_no[0]['onward'],1);

					if ($flight_no[0]['return']!=""){ 
						$return = $this->International_ticketing_model->get_parsed_data($flight_no[0]['return'],1);
					}
					
					$pricing = $this->International_ticketing_model->get_parsed_data($flight_no[0]['pricing'],2);
					$passengers = $this->International_ticketing_model->get_passengers_count($flight_details['passenger']);

					$url = url;
					$parameters = array(	
								'dev_id'     			=> $this->global_f->dev_id(),
			    				'regcode'               =>$this->user['R'],
			    				'actionId'				=>_choose_international_flights,
			    				'ip_address'			=>$this->ip,
			    				'requestid'				=>$flight_details['rqid'],
			    				'onward'				=>$onward,		
			    				'return'				=>$return,
			    				'onwardPricing'			=>$pricing,
			    				'flighttype'			=>1,
			    				'adult'					=>$passengers['adult'],
			    				'children'				=>$passengers['children'],
			    				'infant'				=>$passengers['infant'],
			    				'senior'				=>$passengers['senior'],
			    				 $this->user['SKT']	    => md5($this->user['R'].$this->user['SKT'])
			    						);
				    $baggages = json_decode($this->curl->call($parameters,$url),true);

					 	if ($baggages) {

						 	if ($baggages['S'] == 1){

						 		$this->session->set_userdata('baggages',$baggages);

			 				 	$data['flight_details'] = $this->input->post('flight_details');
						 		$data['onwardbaggages'] = $baggages['OB'];
						 		$data['returnbaggages'] = $baggages['RB'];
						 		$data['totalfee'] = $flight_no[0]['pricing']['currency'].' '.number_format($flight_no[0]['pricing']['TotalFee'],2);
						 		$data['passengers'] = $flight_details['passenger'];
							 	$data['process'] = 2;

						 	}else {

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

						$parsed_passengers = $this->International_ticketing_model->get_parsed_passengers($form_data);
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
						$data['ui_passengers_details'] = $this->International_ticketing_model->ui_passengers_details($form_data,$this->session->userdata('baggages'));
						$data['contact_info'] = 
											array(
												'street' => $others[1],
												'city' => $others[2],
												'zipcode' => $others[3],
												'phone' => $others[0],
											);
						$data['payment_details'] = $this->session->userdata('baggages');					
						$data['collection'] = $data;
						$data['process'] = 3;

				}

				if (isset($_POST['btnConfirm'])) {
					$information = $this->session->userdata('last_parameters');
					$url = url;
				 	$parameters = array(
				 		'dev_id'     => $this->global_f->dev_id(),
						'regcode' 	 => $this->user['R'],
						'actionId'   =>_international_booking_request,
						'ip_address' =>$this->ip,
						'requestid'  => $information['requestid'],
						'transpass'  => $this->input->post('transpass'),
						'passenger'  => $information['passenger'],
						'street' 	 => $information['street'],
						'city'		 => $information['city'],
						'zipcode' 	 => $information['zipcode'],
						'phone' 	 => $information['phone'],
						 $this->user['SKT'] => md5($this->user['R'].$this->user['SKT'].md5($this->input->post('transpass')))
				 	);
				 $data['confirm'] = json_decode($this->curl->call($parameters,$url),true);				 

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
		    				'URL'=> "https://mobilereports.globalpinoyremittance.com/ticketing/domestic/receipt.php?tn=",
		    				'TN' => $data['confirm']['TN']
		    			);
					 	$this->user['EC'] = $data['confirm']['EC'];
						$data['user'] = $this->global_f->get_user_session();
				 }elseif ($data['confirm']['S']== 2) {
				 	$this->session->unset_userdata('last_parameters');
				 	$data['process'] = 0;
	    			$data['output'] = array(
	    				'S' => $data['confirm']['S'],
	    				'M' => $data['confirm']['M']
	    			);
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
				$this->load->view('onlinebooking/book_international_flights'); 
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

	public function eticketing_international($tn)
	{
		if ($this->user['A_CTRL']['online_booking'] == 1){
			$data = array('menu' => 9,
						  'parent'=>'DOMESTIC_FLIGHTS' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				if ($tn){
						$url = url;

						$parameters = array(
							'dev_id'     => $this->global_f->dev_id(),
							'regcode' 	 => $this->user['R'],
							'requestid'  =>$tn,
							'actionId' 	 =>_international_update_transaction,
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
					'actionId' 	 =>_international_booking_transactions,
					'ip_address' =>$this->ip,
					$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'])
				);

				$data['result'] = json_decode($this->curl->call($parameters,$url),true);
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

}