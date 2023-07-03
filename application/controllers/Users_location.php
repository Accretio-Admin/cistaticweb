<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users_Location extends CI_Controller {

   	public function __construct()
	{
        parent::__construct();
		$this->load->model('Curl_model','curl');
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
    }

    public function index(){
        $data = array('parent'=>'ADDRESS' );
		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			if($this->user["R"] == 'F5033230' || $this->user["R"] == 'F5597768'  || $this->user["R"] == 'F1526245' || $this->user["R"] == 'F8152116' || $this->user["R"] == 'F9592952' || $this->user["R"] == 'F9687521' || $this->user["R"] == 'F1359252' || $this->user["R"] == 'F8901916' || $this->user['L'] == '1' || $this->user['L'] == '6' || $this->user['L'] == '7' || $this->user['L'] == '14' || $this->user['L'] == '15' || $this->user['L'] == '16') { 
				$data['user'] = $this->user;
				$data['locationService'] = $this->session->userdata('locationService');   
				$this->session->set_userdata('newlocationService',$data['locationService']); 
				$this->load->view('user_location/index',$data);
			}
		}else { 
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}

	public function saveDetails() {
		$newlocationService = $this->session->userdata('newlocationService');   
		if($this->user["R"]) { 
			$parameter = array(
				'dev_id'     => $this->global_f->dev_id(),
				'ip_address' => $this->ip,
				'actionId' 	 => 'ups_location_service/locationService/UserLocation',
				'regcode'   		=>  $this->user['R'], 
				'name'				=>	$newlocationService['name'],
				'latlong'			=>	$newlocationService['latlong'],
				'country'			=>	$newlocationService['country'],
				'region'			=>	$newlocationService['region'],
				'province'			=>	$newlocationService['province'],
				'city'				=>	$newlocationService['city'],
				'brgy'				=>	$newlocationService['brgy'],
				'detailedAdd'		=>	$newlocationService['detailedAdd'],
				'storeOpeningDay'	=>	$newlocationService['storeOpeningDay'],
				'storeClosingDay'	=>	$newlocationService['storeClosingDay'],
				'storeOpeningHours'	=>	$newlocationService['storeOpeningHours'],
				'storeClosingHours'	=>	$newlocationService['storeClosingHours'],
				'storeEmail'		=>	$newlocationService['storeEmail'],
				'storeContact'		=>	$newlocationService['storeContact'],
				'ip' =>     $this->ip
			);   

			$result = $this->curl->call($parameter,url);
			$res = json_decode($result,true);  

			if ($res['M']['o_success'] == "1") {
				$this->session->set_userdata('locationService', $newlocationService);  
				echo json_encode(array(S=>1,M=>$res['M']['o_message']));
			} else {
				echo json_encode(array(S=>0,M=>"Failed!", D=>$res, P=>$parameter));
				
			}  
		}
	}

	public function ajaxcheckUpdate() {
		if($this->user["R"]) { 
			$name = $this->input->post('name');
			$latlong = $this->input->post('latlong');
			$country = $this->input->post('country');
			$region = $this->input->post('region');
			$province = $this->input->post('province');
			$city = $this->input->post('city');
			$brgy = $this->input->post('brgy');
			$detailedAdd = $this->input->post('detailedAdd');
			$storeOpeningDay = $this->input->post('storeOpeningDay');
			$storeClosingDay = $this->input->post('storeClosingDay'); 
			$storeOpeningHours = $this->input->post('storeOpeningHours'); 
			$storeClosingHours = $this->input->post('storeClosingHours'); 
			$storeEmail = $this->input->post('storeEmail'); 
			$storeContact = $this->input->post('storeContact'); 
	

			$locationService = $this->session->userdata('locationService');
			

			if($locationService['name'] ==  $name && 
			$locationService['latlong'] ==  $latlong && 
			$locationService['country'] ==  $country && 
			$locationService['region'] ==  $region && 
			$locationService['province'] ==  $province && 
			$locationService['city'] ==  $city && 
			$locationService['brgy'] ==  $brgy && 
			$locationService['detailedAdd'] ==  $detailedAdd && 
			$locationService['storeOpeningDay'] ==  $storeOpeningDay && 
			$locationService['storeClosingDay'] ==  $storeClosingDay &&
			$locationService['storeOpeningHours'] ==  $storeOpeningHours &&
			$locationService['storeClosingHours'] ==  $storeClosingHours &&
			$locationService['storeEmail'] ==  $storeEmail &&
			$locationService['storeContact'] ==  $storeContact
			) { 
				echo json_encode(array(S=>1, M=>"No changes"));
			} else { 
				$newlocationService = $this->session->userdata('newlocationService');
				$locationService['name'] =  $name;
				$locationService['latlong'] =$newlocationService['latlong'];
				$locationService['country'] = $newlocationService['country'];
				$locationService['region'] = $newlocationService['region'];
				$locationService['province'] = $newlocationService['province'];
				$locationService['city'] = $newlocationService['city'];
				$locationService['brgy'] = $newlocationService['brgy'];
				$locationService['detailedAdd'] = $newlocationService['detailedAdd'];
				$locationService['storeOpeningDay'] = $storeOpeningDay; 
				$locationService['storeClosingDay'] =  $storeClosingDay;
				$locationService['storeOpeningHours'] =  $storeOpeningHours;
				$locationService['storeClosingHours'] =  $storeClosingHours; 
				$locationService['storeEmail'] = $newlocationService['storeEmail'];
				$locationService['storeContact'] = $newlocationService['storeContact'];
				$locationService['visible'] = 0;
				$this->session->set_userdata('newlocationService', $locationService);  
				$newlocationService = $this->session->userdata('newlocationService');
				echo json_encode(array(S=>0, M=>"Changed",D=>$newlocationService)); 
			}
		}
	}

	public function sendVerification() {
		$type = $this->input->post('type');
		if($this->user["R"]) { 
			if ($type == "SMS") {
				$mobileno = $this->input->post('mobile');
				$url = url;
				$parameter = array ( 'dev_id'     		=>$this->global_f->dev_id(),
								'ip_address' 		=>$this->ip,
									'actionId' 	 	=> _check_mobile_number,
									'mobile_number'    =>$mobileno
									);
				$result = $this->curl->call($parameter,$url);
				$API = json_decode($result,true); 
				echo json_encode($API);
			} else if ($type == "EMAIL") {
				$email = $this->input->post('email');
				$url = url;
				$parameter = array ( 'dev_id'     		=>$this->global_f->dev_id(),
									'ip_address' 		=>$this->ip,
									'actionId' 	 	=> _check_email,
									'email_address'    =>$email
									);
				$result = $this->curl->call($parameter,$url);
				$API = json_decode($result,true);
				
				echo json_encode($API);
			}
		}
	}

	public function verifyPin() {
		$type = $this->input->post('type');
		if($this->user["R"]) { 
			if ($type == "SMS") {
				$mobileno = $this->input->post('mobile'); 
				$vcode = $this->input->post('vcode');  
				$url = url;
				$parameter = array ( 'dev_id'     		=>$this->global_f->dev_id(),
									'ip_address' 		=>$this->ip,
									'actionId' 	 	=> _verify_mobile_number,
									'mobile_number'    =>$mobileno,
									'vcode'			=>$vcode
									);
				$result = $this->curl->call($parameter,$url);
				$API = json_decode($result,true);
				 
				
				if ($API['S'] == 1) {
					$locationService = $this->session->userdata('locationService');
					$newlocationService = $this->session->userdata('newlocationService');
					 
					$locationService['name'] = $newlocationService['name'] ; 
					$locationService['storeOpeningDay'] = $newlocationService['storeOpeningDay']; 
					$locationService['storeClosingDay'] =  $newlocationService['storeClosingDay'];
					$locationService['storeOpeningHours'] = $newlocationService['storeOpeningHours'];
					$locationService['storeClosingHours'] =  $newlocationService['storeClosingHours']; 
					$locationService['storeEmail'] = $newlocationService['storeEmail'];
					$locationService['storeContact'] = $mobileno;
					$locationService['latlong'] =$newlocationService['latlong'];
					$locationService['country'] = $newlocationService['country'];
					$locationService['region'] =$newlocationService['region'];
					$locationService['province'] = $newlocationService['province'];
					$locationService['city'] = $newlocationService['city'];
					$locationService['brgy'] = $newlocationService['brgy'];
					$locationService['detailedAdd'] = $newlocationService['detailedAdd'];
					$this->session->set_userdata('newlocationService', $locationService);  
					echo json_encode($API); 
				} else {
					echo json_encode(array(S=>0, M => $API['M']));
				}
				
			} else if ($type == "EMAIL") {
				$email = $this->input->post('email');
				$vcode = $this->input->post('vcode'); 
				$url = url;
				$parameter = array ( 'dev_id'     		=>$this->global_f->dev_id(),
									'ip_address' 		=>$this->ip,
									'actionId' 	 	=> _verify_email,
									'email_address'    =>$email,
									'vcode'			=>$vcode
									);
				$result = $this->curl->call($parameter,$url);
				$API = json_decode($result,true);  
				if ($API['S'] == 1) {
					$locationService = $this->session->userdata('locationService');
					$newlocationService = $this->session->userdata('newlocationService');
					 
					$locationService['name'] = $newlocationService['name'] ; 
					$locationService['storeOpeningDay'] = $newlocationService['storeOpeningDay']; 
					$locationService['storeClosingDay'] =  $newlocationService['storeClosingDay'];
					$locationService['storeOpeningHours'] = $newlocationService['storeOpeningHours'];
					$locationService['storeClosingHours'] =  $newlocationService['storeClosingHours']; 
					$locationService['storeEmail'] = $email;
					$locationService['storeContact'] = $newlocationService['storeContact'];
					$locationService['latlong'] =$newlocationService['latlong'];
					$locationService['country'] = $newlocationService['country'];
					$locationService['region'] =$newlocationService['region'];
					$locationService['province'] = $newlocationService['province'];
					$locationService['city'] = $newlocationService['city'];
					$locationService['brgy'] = $newlocationService['brgy'];
					$locationService['detailedAdd'] = $newlocationService['detailedAdd'];
					$this->session->set_userdata('newlocationService', $locationService);  
					echo json_encode($API); 
				} else {
					echo json_encode(array(S=>0, M => $API['M']));
				} 
			}
		}
	}

	public function setNewSession(){
		if($this->user["R"]) { 
			$latlong = $this->input->post('latlong');
			$country = $this->input->post('country');
			$region = $this->input->post('region');
			$province = $this->input->post('province');
			$city = $this->input->post('city');
			$brgy = $this->input->post('brgy');
			$detailedAdd = $this->input->post('detailedAdd');

			if (!$latlong || !$country || !$region || !$province || !$city || !$brgy || !$detailedAdd) { 
				echo json_encode(array(S=>0, M=>"Empty Field Not Allowed"));
			} else { 
				$locationService = $this->session->userdata('locationService');
				$newlocationService = $this->session->userdata('newlocationService'); 
				$this->session->set_userdata('newlocationService', $locationService);  
				$locationService['name'] = $newlocationService['name'] ; 
				$locationService['storeOpeningDay'] = $newlocationService['storeOpeningDay']; 
				$locationService['storeClosingDay'] =  $newlocationService['storeClosingDay'];
				$locationService['storeOpeningHours'] = $newlocationService['storeOpeningHours'];
				$locationService['storeClosingHours'] =  $newlocationService['storeClosingHours']; 
				$locationService['storeEmail'] = $newlocationService['storeEmail'];
				$locationService['storeContact'] = $newlocationService['storeContact'];
				$locationService['latlong'] = str_replace('"',"",$latlong);
				$locationService['country'] = $country;
				$locationService['region'] = $region;
				$locationService['province'] = $province;
				$locationService['city'] = $city;
				$locationService['brgy'] = $brgy;
				$locationService['detailedAdd'] = $detailedAdd;
				$this->session->set_userdata('newlocationService', $locationService);  
				if ($this->session->userdata('newlocationService')) {
					echo json_encode(array(S=>1, M=>"UPDATED"));
				} else {
					echo json_encode(array(S=>0, M=>"ERROR UPDATING SESSION"));
				} 
			}
		}
	}

	public function mapFrame() {
		$data['user'] = $this->user;
		$data['locationService'] = $this->session->userdata('locationService');   
		$this->load->view('user_location/map',$data);
	}

	public function getOutletDetails() {
		$order = $this->input->post('order');
		$lat = $this->input->post('lat');
		$lng = $this->input->post('lng');
		$search = $this->input->post('search');
		$userlevel = $this->input->post('userlevel');
		$radius = $this->input->post('radius');
		$actionId = "";

		// if ($type == "order") {
			$actionId ='ups_location_service/getUserLocationDetails/getOutletDetailsOrder';
		// } else {
		// 	$actionId ='ups_location_service/getUserLocationDetails/getOutletDetails';
		// }

		$parameter =array(
			'dev_id'     		=> $this->global_f->dev_id(),
			'actionId'         	=> $actionId, 
			'ip_address'		=> $this->ip, 
			'regcode'           => $this->user['R'], 
			'userlevel'        => $userlevel,
			'order'           => $order, 
			'lat'           => $lat, 
			'lng'           => $lng, 
			'search' 		=> $search,
			'radius'		=> $radius
		); 
		// 
		$result = $this->curl->call($parameter,url);
		// print_r($result);exit();
		$outletList = json_decode($result,true);
		$city = array();
		$region = array();
		$country = array();
		
		for ($x = 0 ; $x < count($outletList['D']); $x++) {
			array_push($city, $outletList['D'][$x]['city']);
			array_push($region, $outletList['D'][$x]['region']);
			array_push($country, $outletList['D'][$x]['country']);
		}
		
		// $location['country'] = array_unique($country);
		// $location['region'] =  array_unique($region);
		// $location['city'] =  array_unique($city);
		// if ($outletList['S'] == 0 || $outletList['S'] == 0) {
			echo json_encode($outletList);
		// } else {
			// echo json_encode($outletList['D']);
		// } 
	}

	public function getOutletDetailsAddress() {
		$order = $this->input->post('order');
		$lat = $this->input->post('lat');
		$lng = $this->input->post('lng');
		$search = $this->input->post('search');
		$userlevel = $this->input->post('userlevel');
		$radius = $this->input->post('radius');
		$actionId = "";

		// if ($type == "order") {
			$actionId ='ups_location_service/getUserLocationDetails/getOutletDetails';
		// } else {
		// 	$actionId ='ups_location_service/getUserLocationDetails/getOutletDetails';
		// }

		$parameter =array(
			'dev_id'     		=> $this->global_f->dev_id(),
			'actionId'         	=> $actionId, 
			'ip_address'		=> $this->ip, 
			'regcode'           => $this->user['R'],   
		); 
		// 
		$result = $this->curl->call($parameter,url); 
		$outletList = json_decode($result,true);
		$city = array();
		$region = array();
		$country = array();
		
		for ($x = 0 ; $x < count($outletList['D']); $x++) {
			array_push($city, $outletList['D'][$x]['city']);
			array_push($region, $outletList['D'][$x]['region']);
			array_push($country, $outletList['D'][$x]['country']);
		} 
		echo json_encode($outletList); 
	}

	public function LocationVisibility() { 
		$actionId ='ups_location_service/setLocationVisibility/LocationVisibility'; 
		$parameter =array(
			'dev_id'     		=> $this->global_f->dev_id(),
			'actionId'         	=> $actionId, 
			'ip_address'		=> $this->ip, 
			'regcode'           => $this->user['R'],  
		); 
		// 
		$result = $this->curl->call($parameter,url);
		// print_r($result);exit();
		$outletList = json_decode($result,true); 
		$locationService = $this->session->userdata('locationService');
	 
		if ($outletList["S"] == 1) {
			if ($outletList["M"]["S"] == 1) { 
				$locationService['visible'] = 1;
			} else {
				$locationService['visible'] = 0;
			}
		} 
		$this->session->set_userdata('locationService', $locationService);  
		echo json_encode($outletList); 
	}


	public function nearbyOutlet() {
		$this->load->view('user_location/nearby_frame');
	}

	public function activateAllowlocation() {
		$this->session->set_userdata('activateAllowlocation', '1'); 
	}
}