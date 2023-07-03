<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
class Hotels extends CI_Controller {

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
	    $this->load->model('Query_model','q');
	  	$this->load->model('Report_model','r');
	  	$this->load->model('Global_function','global_f');
        $this->load->model('Sp_model');
        date_default_timezone_set('Asia/Manila');
        ini_set('max_execution_time', 300); //300 seconds = 5 minutes

        if ($this->user['RET'] == 1) {
            redirect('Main/');
        }
        if($this->user['USER_KYC'] != 'APPROVED') {
			redirect('Main');
  		}
	}

    /**
     * Check if user log in
     *
     * @author JRLValdez
     * @date 09/07/2018
     *
     * @return json_encode
    */
    function checkUser()
    {
        if ($this->user['S'] != 1 && $this->user['R'] == "") {
            
            $this->session->sess_destroy();
            redirect('Login/');
        } 
        
        // $regcode = array_flip(["1234567", "F5597768", "F1526245", "F8901916"]);
        // if (!isset($regcode[$this->user['R']])) {
        //     return redirect("Hotels/maintenance");
        // }
    }

	function index()
	{
        // echo CI_VERSION;
		$data = ['menu' => 22, 'parent'=>'' ];
        $this->checkUser();
		
        $data['user'] = $this->user;

        $data2 = '0';
		if($data2 == '0'){
            $this->load->view('layout/header',$data);
            $this->load->view('element/top_header');
            $this->load->view('element/wrapper_header');
            $this->load->view('element/left_panel');
            $this->load->view('hotels/hotelundermaintenance'); 
            $this->load->view('element/wrapper_footer');
            $this->load->view('layout/footer');	
        }else{
            if (null != $this->input->post('occupancies') ) {
                $this->searchHotel($this->input->post());
            } else {
                // echo "echeck!";
                // exit();
                $this->load->view('layout/header',$data);
                $this->load->view('element/top_header');
                $this->load->view('element/wrapper_header');
                $this->load->view('element/left_panel');
                $this->load->view('hotels/main', []); 
                $this->load->view('hotels/css/hotelcss'); 
                $this->load->view('element/wrapper_footer');
                $this->load->view('layout/footer');	
            }
        }
       
	}

    /**
     * AJAX search API for hotel, destination and zone
     *
     * @author JRLValdez
     * @date 08/22/2018
     *
     * @return json_encode
    */
    function graphQLAPI($query, $variables, $operationName)
    {
       // $url = "http://10.10.1.119:8000/graphql";
       // $url = "http://10.10.1.127:8000/graphql";
       // $url = "http://10.10.1.119:8089/graphql";
        //    $url = "http://103.16.170.114:9003/graphql";
        //    $url = "http://35.200.241.130/graphql";
        $url = "http://35.200.241.130/graphql";
        // $url = "http://10.10.1.106:809/graphql";
        $parameters = [
            "query" => $query,
            "variables" => $variables,
            "operationName" => $operationName
        ];

        // print_r(json_encode($parameters));return;

        $results = $this->curl->call_custom($parameters, $url, "POST");
        // print_r($results);
    
        return $results; 
    }

	/**
	 * AJAX search API for hotel, destination and zone
	 *
	 * @author JRLValdez
	 * @date 08/22/2018
	 *
	 * @return json_encode
	*/
	function search_api()
	{
        $search = $this->input->get('args');
        $query = "query Destinations { destinations(options: {where: {destination: \"" . $search . "\"},},limit: 5, offset: 0, order: [[ name, asc ]]){ rows{id, name, country{ id, name } }}, zones(limit: 5, offset: 0, order: [[name, asc]], options: { where: { name: \"" . $search . "\"}, },){rows{zoneCode, name, destination{id, name}}}, hotels(limit: 5, offset: 0, order: [[ name, asc]], options: {where: { name: \"" . $search . "\", isDatabase: true, }, }, ){ rows{ id, name destinationId }}}";
        $results = $this->graphQLAPI($query, null, "Destinations");
        echo json_encode(json_decode($results));
    }
    
    function search_hotels()
    {
        $data = ['menu' => 22, 'parent'=>'' ];
        $this->checkUser();
		
        $data['user'] = $this->user;
		
        if (null != $this->input->post('occupancies') ) {
            $this->searchHotel($this->input->post());
        } else {
            // echo "echeck!";
            // exit();
            $this->load->view('layout/header',$data);
            $this->load->view('element/top_header');
            $this->load->view('element/wrapper_header');
            $this->load->view('element/left_panel');
            $this->load->view('hotels/index', []); 
            $this->load->view('hotels/css/hotelcss'); 
            $this->load->view('element/wrapper_footer');
            $this->load->view('layout/footer');	
        }
    }

    function search() 
    {
        $this->checkUser();
        $data['user'] = $this->user;
        $data['menu'] = 22;
        $data['parent'] ='' ;

        $sessionName = $this->input->get('sessionName');
        $param = $this->session->get_userdata();

        $this->load->view('layout/header',$data);
        $this->load->view('element/top_header');
        $this->load->view('element/wrapper_header');
        $this->load->view('element/left_panel');
        
        $param = $param["'".$sessionName."'"];

        $request = $this->createQuerySearch($param['location'], $param['category'], $param['zone'], $param['checkIn'], $param['checkOut'], $param['occupancies']);

        $hotels =  $this->graphQLAPI($request['query'], null, $request['operationName']);//var_dump($hotels);exit;
        $hotels = json_decode($hotels, true);
        // echo "<pre>";
        // print_r($hotels);
        // echo "</pre>";
        // exit;
        
        if (isset($hotels['errors'])) {
            if ($hotels['errors'][0]["message"] == 'No result found.' || 
                $hotels['errors'][0]["message"] == 'No hotel content found' ||
                $hotels['errors'][0]["message"] == '[0002] No result found.' 
            ) {
                $this->load->view('hotels/index', ['error' => 'No results found. Please search again']);
            } else {
                $this->load->view('hotels/error', ['error' => $hotels['errors'][0]["message"] ]);
            }
        } else {    
            if (count($hotels['data']['hotels']['rows']) || count($hotels['data']['hotel'])) {
                
                if ($category != 3) { 
                    $hotels = $hotels['data']['hotels']['rows'];
                    $hotels = $this->sortHotelFilter($hotels, count($data['occupancies']));
                } else {
                    $hotels =  $hotels['data']['hotel'];
                    $hotels = $this->sortHotelFilter([$hotels], count($data['occupancies']), 1);
                }
            
                if (COUNT($hotels)) {
                    $numRooms = count($param['occupancies']) > 1 ? count($param['occupancies'])."X" : "";
                    $hotels['numRooms'] = $numRooms;
                    $this->load->view('hotels/search', ['hotels' => $hotels, 'sessionName' => $sessionName]);
                } else {
                    $this->load->view('hotels/error', ['error' => "No available hotel. Please search again." ]);
                }
            }
        }

        $this->load->view('hotels/css/hotelcss'); 
        $this->load->view('element/wrapper_footer');
        $this->load->view('layout/footer'); 
    }

	/**
	 * Search hotel
	 *
	 * @author JRLValdez
	 * @date 08/23/2018
	 *
	 * @return view
	*/
	function searchHotel($postData)
	{
        $passValidation = 1;
        $data['user'] = $this->user;
        $data['menu'] = 22;
        $data['parent'] ='' ;
        $this->load->view('layout/header',$data);
        $this->load->view('element/top_header');
        $this->load->view('element/wrapper_header');
        $this->load->view('element/left_panel');

        #   CHECK DATE
        $passValidation = $this->validateSearch($postData);
    
        if ($passValidation) {
        
            $sessionName = time();
            foreach ($postData['occupancies'] as $key => $arrOccupant) {
                $arrOccupancies[] =[
                   'rooms'=> 1,
                   'adults'=> $arrOccupant['adults'],
                   'children' => $arrOccupant['children']['count'],
                   'paxes' => $paxes = $this->buildPaxes($arrOccupant)
                ];
            }

           $location = ($postData['category'] == 3 ? "[" . $postData['location'] . "]":$postData['location']);
           $category = $postData['category'];
           $zone = $postData['zone'] == "" ? "1":$postData['zone'];
           $checkIn = $postData['checkin'];
           $checkOut = $postData['checkout'];

           $data['location'] = $location;  
           $data['zone'] = $zone;  
           $data['category'] = $category;  
           $data['checkIn'] = $checkIn;
           $data['checkOut'] = $checkOut;
           $data['occupancies'] = $arrOccupancies;

           $numRooms = count($data['occupancies']) > 1 ? count($data['occupancies'])."X" : "";
           $this->session->set_userdata("'".$sessionName."'", $data);

           $request = $this->createQuerySearch($location, $category, $zone, $checkIn, $checkOut, $arrOccupancies);

           $hotels =  $this->graphQLAPI($request['query'], null, $request['operationName']);
           $hotels = json_decode($hotels, true);

        //    echo "<pre>";
        //    print_r($request);
        //    print_r($hotels);
        //    echo "</pre>";

            if (isset($hotels['errors'])) {
                // echo $hotels['errors'][0]["message"];
                // exit;
                // if ($hotels['errors'][0]["message"] == 'No result found.' || 
                //     $hotels['errors'][0]["message"] == 'No hotel content found' ||
                //     $hotels['errors'][0]["message"] == '[0002] No result found.' ||
                //     (isset($hotels['data']['hotels']) && count($hotels['data']['hotels']['rows']) == 0)
                // ) {
                    $this->load->view('hotels/index', ['error' => 'No available rooms. Please search again']);
                // } else {
                //     $this->load->view('hotels/error', ['error' => $hotels['errors'][0]["message"] ]);
                // }
            } else {
                // echo "jump";
                // echo (count($hotels['data']['hotels']['rows']) || 
                // (!isset($hotels['data']['hotels']['rows']) && count($hotels['data']['hotel'])));

                if (count($hotels['data']['hotels']['rows']) || 
                (!isset($hotels['data']['hotels']['rows']) && count($hotels['data']['hotel']))) {
                    // echo "if";
                    if ($category != 3) { 
                        $hotels = $hotels['data']['hotels']['rows'];
                        $hotels = $this->sortHotelFilter($hotels, count($data['occupancies']));
                    } else {
                        $hotels =  $hotels['data']['hotel'];
                        $hotels = $this->sortHotelFilter([$hotels], count($data['occupancies']), 1);
                    }
                
                    if (COUNT($hotels)) {
                        $hotels['numRooms'] = $numRooms;
                        if ($category == 3) {
                            $hotels = $hotels[0];
                            $this->load->view('hotels/js/fotorama');
                            $this->load->view('hotels/js/filter');
                            $this->load->view('hotels/hoteldetails', ['hotel' => $hotels, 'sessionName' => $sessionName, 'isSearch' => 0]);
                        } else {
                            $this->load->view('hotels/search', ['hotels' => $hotels, 'sessionName' => $sessionName]);     
                        }     
                    } else {
                        $this->load->view('hotels/error', ['error' => "No available hotel. Please search again." ]);
                    }
                } else {
                    // echo "else";
                    $this->load->view('hotels/index', ['error' => "No available hotel. Please search again." ]);
                }
            }
        } 

        $this->load->view('hotels/css/hotelcss'); 
        $this->load->view('element/wrapper_footer');
        $this->load->view('layout/footer'); 
	}

    /**
     * Build Paxes for API request parameter
     *
     * @author JRLValdez
     * @date 08/24/2018
     *
     * @param code $hotelCode
     *
     * @return view
    */
    function details($sessionName, $hotelCode)
    {
        $this->checkUser();
        $data['user'] = $this->user;
        $data['menu'] = 22;
        $data['parent'] ='' ;

        $this->load->view('layout/header',$data);
        $this->load->view('element/top_header');
        $this->load->view('element/wrapper_header');
        $this->load->view('element/left_panel');

        $param = $this->session->get_userdata();
        $param = $param["'".$sessionName."'"];

        if (is_array($param) && count($param)) {
            $request = $this->createQuerySearch("[".intval($hotelCode)."]", 3, 1, $param['checkIn'], $param['checkOut'], $param['occupancies']);
            $hotels =  $this->graphQLAPI($request['query'], null, $request['operationName']);
            $hotels = json_decode($hotels, true);

            if (isset($hotels['errors'])) {
                $this->load->view('hotels/error', ['error' => $hotels['errors'][0]["message"] ]);
            } else {
                $hotels = $hotels['data']['hotel'];
                $hotels = $this->sortHotelFilter([$hotels], count($param['occupancies']), 1);
                $hotels = $hotels[0];
                $this->load->view('hotels/hoteldetails', ['hotel' => $hotels, 'sessionName' => $sessionName, 'isSearch' => 1]);
            }
        } else {
            $this->load->view('hotels/error', ['error' => "Hotel booking session expired. Please try booking again" ]);
        }

        $this->load->view('hotels/css/hotelcss'); 
        $this->load->view('element/wrapper_footer');
        $this->load->view('layout/footer'); 
    }

    /**
     * Build Paxes for API request parameter
     *
     * @author JRLValdez
     * @date 08/23/2018
     *
     * @param array $occupant
     *
     * @return view
    */
    function book_now($sessionName)
    {
        $this->checkUser();
        $details["maxDateForAdult"] = date('Y-m-d', strtotime(date('d') . "-" . date('m') . "-" . (date('Y') - 18)));

        $data['user'] = $this->user;
        $data['menu'] = 22;
        $data['parent'] ='' ;
        $this->load->view('layout/header', $data);
        $this->load->view('element/top_header');
        $this->load->view('element/wrapper_header');
        $this->load->view('element/left_panel');

        $hotels = [];
        $ttlAdult = 0;
        $ttlChild = 0;

        $hotelDetails = $this->input->post('hotel');
        $param = $this->session->get_userdata();
        $param = $param["'".$sessionName."'"];

        if (is_array($param) && count($param)) {
            $arrRateType = explode('|*|', $hotelDetails['rateType']);
            $arrRateKey = explode('|*|', $hotelDetails['rateKey']);
            $arrRateCheck = [];

            // if (strtolower($arrRateType[0]) == 'recheck') {
                foreach ($arrRateType as $key => $value) {
                    $arrRateCheck[] = [
                        'rateKey' => $arrRateKey[$key]
                    ];
                }

                $query = "query CheckRates {  
                    hotelReservation( 
                        options: { 
                            where: { 
                                regcode: \"".$this->user['R']."\", hotelCode:  ".$hotelDetails['id'].", 
                                roomCode: \"\", roomKeys: ".preg_replace('/"([a-zA-Z_]+[a-zA-Z0-9_]*)":/','$1:', json_encode($arrRateCheck))."
                            }
                        }
                    )
                    { 
                        checkOut, checkIn, totalAmount, markup, currency, 
                        hotel { 
                            id, name, categoryCode, description, address, 
                            city, postalCode, zoneId, countryId, 
                            destination { id, name} 
                            emailAddress, latitude, longitude, phoneNumber, website, 
                            facilities { id, name, order, indYesOrNo, indLogic, indFee } 
                            rooms {
                                id, name, 
                                rates { 
                                    rateComments, rateKey, rateClass, rateType, netAmount, 
                                    discountAmount, discountPercentage, sellingAmount, paymentType, boardCode, 
                                    boardName, cancellationPolicy, totalAmount, 
                                    dailyRates {dailySellingRate} }
                                } 
                                images {
                                    imageTypeCode, imageTypeName, path, order 
                                } 
                            } 
                        }
                    }";
                $hotels = $this->graphQLAPI($query, null, "CheckRates"); 
                $hotels = json_decode($hotels, true);

                if (isset($hotels['error'])) {
                    $this->load->view('hotels/error', ['error' => 'Session Rate keys Expires' ]);
                    return;
                } else {
                    $hotelDetails['rateComments'] = $hotels['data']['hotelReservation']['hotel']['rooms'][0]['rates'][0]['rateComments'];
                }
            // }

            if (!is_array($hotelDetails['dailyRates'])) {
                $hotelDetails['dailyRates'] = json_decode($hotelDetails['dailyRates'], true);
            }

            $date1 = new DateTime($param['checkIn']);
            $date2 = new DateTime($param['checkOut']);
            $diff = $date2->diff($date1)->format("%a");
            $param['dateDiff'] = $diff;

            foreach ($param['occupancies'] as $key => $value) {
                $ttlAdult += intval($value['adults']);
                $ttlChild += intval($value['children']);
            }

            $param['occupancies'] = $this->buildChildAgeFormulation($param['occupancies']);
            $param['ttlAdult'] = $ttlAdult;
            $param['ttlChild'] = $ttlChild;
            $param['ttlRooms'] = count($param['occupancies']);

            $details['hotelDetails'] = $hotelDetails;
            $details['sessionName'] = $sessionName;
            $details['hotels'] = $hotels;
            $details['parameter'] = $param;
            $details['star'] = $hotelDetails['star'];

            $parameter['datepicker'] =[];

            $this->load->view('hotels/bookhotel', $details);
        } else {
            $this->load->view('hotels/error', ['error' => "Hotel booking session expired. Please try booking again" ]);
        }
        
        $this->load->view('hotels/css/hotelcss'); 
        $this->load->view('element/wrapper_footer');
        $this->load->view('layout/footer');
        
    }

    /**
     * Book hotel on hotelbeds API
     *
     * @author JRLValdez
     * @date 08/28/2018
     *
     *
     * @return view
    */
    function book_hotel($sessionName)
    {
        $this->checkUser();

        $data['user'] = $this->user;
        $data['menu'] = 22;
        $data['parent'] ='' ;
        $post = $this->input->post();

        if (is_array($post) && count($post)) {
            $hotelDetails = $post['hotel'];
            $customer = $post['customer'];
            $guest = $post['guest'];
            $transpass = $post['transpass'];

            $param = $this->session->get_userdata();
            $param = $param["'".$sessionName."'"];
            $rooms = $this->buildPaxesDetails($guest, $hotelDetails['rateKey']);

            $query = "mutation CreateHotelReservation 
                        { hotelReservation( 
                            values: {
                                ipAddress: \"".$this->ip."\", transactionPassword:\"". $transpass ."\", 
                                totalAmount:".$hotelDetails['netAmount'].", currency:\"PHP\", 
                                checkIn:\"".$hotelDetails['checkIn']."\", checkOut:\"".$hotelDetails['checkOut']."\", 
                                hotelId:".$hotelDetails['id'].", 
                                room:".$hotelDetails['ttlRooms'].", adult:".$hotelDetails['ttlAdult'].", 
                                child:".$hotelDetails['ttlChild'].", 
                                regcode: \"".$this->user['R']."\",
                                dailyRates: [],
                                customer: {  
                                    firstName: \"".$customer['firstname']."\",  lastName: \"".$customer['lastname']."\",  
                                    emailAddress: \"".$customer['emailAddress']."\",  mobileNumber: \"".$customer['mobile']."\"},
                                rooms: ".$rooms."
                            } ){ referenceNumber, trackingNumber, status, totalAmount, currency, markup, checkIn, checkOut, hotel{id, name, categoryCode, rooms { id, name, rates {    rateClass, netAmount, discountAmount, discountPercentage, sellingAmount, paymentType, boardCode, boardName, cancellationPolicy, rateComments, totalAmount }} } customer { firstName, lastName, emailAddress, mobileNumber, }, guests { firstName, lastName, birthdate } }}";

            $results = $this->graphQLAPI($query, null, "CreateHotelReservation");
            $results = json_decode(json_decode(json_encode($results, true)), true);

            if (isset($results['data']['hotelReservation']['status']) && 
                $results['data']['hotelReservation']['status'] == 'CONFIRMED'
            ) {
                $query = "query userDetails{ user( options:{ where:{ regcode:\"".$this->user['R']."\", }}){ ecashWallet } }";
                $userDetails = $this->graphQLAPI($query, null, "userDetails");
                $userDetails = json_decode($userDetails, true);
                
                $response = $this->Sp_model->userfunds();
                if ($response['S'] == 1) {
                    $this->user['EC'] = $response['EC'];
                }

                $data['user'] = $this->user;

                $remaining = $this->getMinutesLaps(time() - $sessionName);
                $results = $results['data']['hotelReservation'];

                // $this->load->view('layout/header', $data);
                // $this->load->view('element/top_header');
                // $this->load->view('element/wrapper_header');
                // $this->load->view('element/left_panel');

                // $param = ['results' => $results, 'hotelDetails'=>$hotelDetails];
                // $this->load->view('hotels/success', ['results' => $results, 'hotelDetails'=>$hotelDetails]); 
                redirect("hotels/success_hotelbooking/{$results['trackingNumber']}");
            } elseif (isset($results['errors']) && isset($results['errors'][0]['stack']) &&
                $results['errors'][0]['stack'][0] == "BadRequest: Invalid Transaction Password!"
            ) {
                $this->load->view('layout/header', $data);
                $this->load->view('element/top_header');
                $this->load->view('element/wrapper_header');
                $this->load->view('element/left_panel');

                $details['error'] = 'Wrong transaction password input. Please input correct transaction Password';
                $details['hotelDetails'] = json_decode($this->input->post('hotelDetails'), true);
                $details['sessionName'] = $sessionName;

                $details['hotels'] = (array) json_decode($this->input->post('hotels'));
                $details['parameter'] = (array) json_decode($this->input->post('parameter'), true);
                $details['post'] = $post;
                
                $this->load->view('hotels/bookhotel', $details); 
                $view = 'hotels/bookhotel';
                $param = ['results' => $results, 'hotelDetails'=>$hotelDetails];

            } elseif (isset($results['errors']) && isset($results['errors'][0]['stack']) ) {
                $this->load->view('layout/header', $data);
                $this->load->view('element/top_header');
                $this->load->view('element/wrapper_header');
                $this->load->view('element/left_panel');
                $this->load->view('hotels/error', ['error'=>$results['errors'][0]['stack'][0] ]);
            }
        } else {
            $this->load->view('layout/header', $data);
            $this->load->view('element/top_header');
            $this->load->view('element/wrapper_header');
            $this->load->view('element/left_panel');
            $this->load->view('hotels/error', ['error' => "Hotel booking session expired. Please try booking again" ]);
        }

        $this->load->view('hotels/css/hotelcss'); 
        $this->load->view('element/wrapper_footer');
        $this->load->view('layout/footer');
    }

    /**
     * @author JRLValdez
     * 
     * @param String $referenceNumber
     * 
     * @date 03/05/2019
     * 
     * @return view
     */
    function success_hotelbooking($referenceNumber)
    {
        $data['user'] = $this->user;
        $this->load->view('layout/header', $data);
        $this->load->view('element/top_header');
        $this->load->view('element/wrapper_header');
        $this->load->view('element/left_panel');

        $query = "query FindOneHotelReservation {  
            hotelReservation( options:{ limit:300, offset: 0, where: { isDatabase: true, trackingNumber: \"{$referenceNumber}\" } } ) {
            trackingNumber, referenceNumber, totalAmount, createdAt, room checkIn, checkOut
            customer { firstName, lastName, emailAddress, mobileNumber }
            hotel { id, name, address, city, postalCode
                rooms { id, name
                    rates {
                        rateKey, rateClass, rateType, netAmount, discountAmount,
                        discountPercentage, sellingAmount, totalAmount, allotment,
                        paymentType, boardCode, boardName, cancellationPolicy, rateComments
                   }}}}}";

        $details = json_decode($this->graphQLAPI($query, null, "FindOneHotelReservation"), true);

        $results['trackingNumber'] = $details['data']['hotelReservation']['trackingNumber'];
        $results['referenceNumber'] = $details['data']['hotelReservation']['referenceNumber'];
        $results['hotel'] = $details['data']['hotelReservation']['hotel'];
        $results['checkIn'] = $details['data']['hotelReservation']['checkIn'];
        $results['checkOut'] = $details['data']['hotelReservation']['checkOut'];
        $results['totalAmount'] = $details['data']['hotelReservation']['totalAmount'];

        $this->load->view('hotels/success', ['results' => $results]); 
        $this->load->view('hotels/css/hotelcss'); 
        $this->load->view('element/wrapper_footer');
        $this->load->view('layout/footer');
    }

    function buildChildAgeFormulation($occupancies)
    {
        foreach ($occupancies as $key => $value) {
            if($value['children'] > 0) {
                foreach ($value['paxes'] as $pKey => $pax) {
                     if($pax['type'] == 'CH') {
                        $minDate = date('Y-m-d', strtotime( (date('d')+1) . "-" . date('m') . "-" . (date('Y') - ($pax['age']+1)) ));
                        $maxDate = date('Y-m-d', strtotime(date('d') . "-" . date('m') . "-" . (date('Y') - $pax['age'])));

                        $occupancies[$key]['paxes'][$pKey]['min'] = $minDate;
                        $occupancies[$key]['paxes'][$pKey]['max'] = $maxDate;
                     }

                     $minDate = null;
                     $maxDate = null;
                 } 
            }
        }

        return $occupancies;
    }   

    /**
     * Validate search variables
     *
     * @author JRLValdez
     * @date 08/31/2018
     *
     *
     * @return view
    */
    function validateSearch($hotelSearchDetails)
    {
        $isValid = 1;
        $error = [];
        $today_dt = new DateTime(date("Y-m-d"));
        $startDate = new DateTime($hotelSearchDetails['checkin']);
        // $startDate = new DateTime("2010-02-02");
        $endDate = new DateTime($hotelSearchDetails['checkout']);

        if ($startDate < $endDate) {
            if ($startDate < $today_dt or $endDate < $today_dt) {
                $isValid = 0;
                $error = ['error' => "Please check your check in and check out date" ];
            }
        } else {
            $isValid = 0;
            $error = ['error' => "Please check your check in and check out date" ];
        }

        if ($hotelSearchDetails['location'] == "") {
            $isValid = 0;
            $error = ['error' => "Location/Hotel to search missing. Please try search again" ];
        }

        if ($isValid == 0) {
            $this->load->view('hotels/error', $error);
        }

        return $isValid;
    }

    /**
     * Build Paxes for API request parameter
     *
     * @author JRLValdez
     * @date 09/04/2018
     *
     * @param string $location
     * @param int $category
     * @param int $zone
     * @param string $checkIn
     * @param string $checkOut
     * @param array $arrOccupancies
     *
     * @return view
    */
    function createQuerySearch($location, $category, $zone, $checkIn, $checkOut, $arrOccupancies) 
    {
        if ($category != 3 ) {
            $operationName = "SearchHotel";
            $query = "query SearchHotel { hotels( action: COUNT, options: { where: { regcode: ".$this->user['R'].", location: " . $location . ", category: " . $category . ", zone: ". $zone .", checkIn: \"".$checkIn."\", checkOut: \"".$checkOut."\", occupancies: ".preg_replace('/"([a-zA-Z_]+[a-zA-Z0-9_]*)":/','$1:',json_encode($arrOccupancies))." } }, limit: 20, offset: 0, order: [[name, asc]] ){ rows { id, name, categoryCode, description, address, city, postalCode, zoneId, countryId, destinationId, emailAddress, latitude, longitude, phoneNumber, rooms { id, name, rates { rateComments, rateKey, rateClass, rateType, netAmount, discountAmount, discountPercentage, sellingAmount, totalAmount, allotment, paymentType, boardCode, boardName, cancellationPolicy, currency, dailyRates{dailySellingRate} } } images { imageTypeCode, path,order }}, count}}";

        } else {
            $operationName = "FindOneHotel";
            $query = "query FindOneHotel {  hotel( options: { where: { regcode: ".$this->user['R'].", location: " . $location . ", category: " . $category . ", zone: ". $zone .", checkIn: \"".$checkIn."\", checkOut: \"".$checkOut."\", occupancies: ".preg_replace('/"([a-zA-Z_]+[a-zA-Z0-9_]*)":/','$1:',json_encode($arrOccupancies))." } }){id, name, categoryCode, description, address, city, postalCode, zone {id,name} countryId, destination{id, name} emailAddress, latitude, longitude, phoneNumber, website, rooms {id,name,rates { rateComments, rateKey, rateClass, rateType, netAmount, discountAmount, discountPercentage, sellingAmount, totalAmount, allotment, paymentType, boardCode, boardName, dailyRates { offset, dailySellingRate } cancellationPolicy }}images {imageTypeCode, imageTypeName, path, order } facilities{ id, facilityGroupCode, name, order, indFee, indLogic, indYesOrNo } interestPoints { id, group, order, name, distance}}}";
        }

        return [
            'query' => $query,
            'operationName' => $operationName
        ];
    }

    /**
     * hotel cancellation checker to string for multi cancellation policy
     * and with single or no cancellation policy
     *
     * @author JRLValdez
     * @date 08/28/2018
     *
     * @param string $cancellation
     *
     * @return string
    */
    function hotelCancellationDetails($cancellation)
    {
        $strCancellation = "";
        if ($cancellation != "" && $cancellation != null) {
            $arrCancellation = explode('|*|', $cancellation);
            
            if (count($arrCancellation) > 1) {
                foreach ($arrCancellation as $key => $value) {
                    $strCancellation .= $this->toTextCancellationPolicy($value);
                }
            } else {
                $strCancellation = $this->toTextCancellationPolicy($arrCancellation[0]);
            }
        }

        return $strCancellation;
    }

    /**
     * hotel cancellation checker to string for multi cancellation policy
     * and with single or no cancellation policy
     *
     * @author JRLValdez
     * @date 08/28/2018
     *
     * @param string $cancellation
     *
     * @return string
    */
    function toTextCancellationPolicy($cancellation)
    {
        $time = "";
        $arrCancellation = explode('|~|', $cancellation);
        $amount = $arrCancellation[0];
        if (isset($arrCancellation[1])) {
            $time = $this->hotelCancellationDateToString($arrCancellation[1]);
        }
    
        return $time . " , PHP" . $amount . ", ";
    }

    /**
     * convert hotel cancellation to string as date format Month day, YEAR Hour:Mins:Sec
     * Sample Sep 05, 2018 05:05:05
     *
     * @author JRLValdez
     * @date 08/28/2018
     *
     * @param string $time
     *
     * @return string
    */
    function hotelCancellationDateToString($time)
    {
        $return = "";
        $arrTime = explode('T', $time);
        $date = $arrTime[0];

        if (count($arrTime) > 1) {
            $arrHours = explode('+', $arrTime[1]);
            $return = date("M d, Y H:i:m", strtotime($date ." " .$arrHours[0]));
        } else {
            $xTime = explode(" ", $time);
            $return = date("M d, Y H:i:m", strtotime($xTime[0] . " " . $xTime[1]));
        }
        return $return;
    }

    /**
     * Build Paxes for API request parameter
     *
     * @author JRLValdez
     * @date 08/23/2018
     *
     * @param array $hotels
     * @param null|int $type
     *
     * @return array
    */
	function sortHotelFilter($hotels, $roomCount, $type = null)
	{        
        $hotels = (array) $hotels;
        $boardTypes = $this->hotelBoardTypes();
        $segmentBoardType = [];
        $availableBoardTypes = [];
        $min = 0;
        $max = 0;

        foreach ($hotels as $hKey => $hotel) {
            // echo "<pre>";
            // print_r($hotel);
            // exit;
            $hotelMin = 0;
       
            $hotels[$hKey]['accommodationType'] = $this->categoryAccomodationType($hotel['categoryCode']);
            $hotels[$hKey]['star'] = $this->getHotelStars($hotel['categoryCode'], "");
            $hasRoom = 0;
            foreach ($hotel['rooms'] as $rKey => $room) {
                if (count($room['rates']) == 0 || $room['rates'] == null) {
                    unset($hotels[$hKey]['rooms'][$rKey]);
                    continue;
                }

                $hasRoom++;

                foreach ($room['rates'] as $rtsKey => $rate) {
                    $rateCount = explode("|*|", $rate['rateKey']);

                    if (COUNT($rateCount) < $roomCount) {
                        unset($hotels[$hKey]['rooms'][$rKey]['rates'][$rtsKey]);
                        continue;
                    }

                    $hotels[$hKey]['rooms'][$rKey]['rates'][$rtsKey]['allotmentSingular'] = isset($rate['allotment']) && $rate['allotment'] > 1 ? "S":"";
                    $hotelMin = $this->filterNumber($hotelMin, '<', $rate['totalAmount']);
                    $min = $this->filterNumber($min, '<', $rate['totalAmount']);
                    $max = $this->filterNumber($max, '>', $rate['totalAmount']);

                    $hotels[$hKey]['rooms'][$rKey]['rates'][$rtsKey]['cancellationPolicy'] = 
                    $this->hotelCancellationDetails($rate['cancellationPolicy']);
                    $availableBoardTypes[] = $rate['boardCode'];
                }

                if (count($hotels[$hKey]['rooms'][$rKey]['rates']) == 0) {
                    unset($hotels[$hKey]['rooms'][$rKey]);
                    continue;
                }

                $hotels[$hKey]['rooms'][$rKey]['rates'][$rtsKey]['minRate'] = $hotelMin;
                $hotels[$hKey]['minRate'] = $hotelMin;
            }

            if(isset($hotel['images']) && count($hotel['images'])){
                foreach($hotel['images'] as $ikey=>$img){
                    if ($type == null) {
                        if($img['imageTypeCode'] == 'HAB'){
                            $hotels[$hKey]['images'] = str_replace('medium/', '', $img['path']);
                            break;
                        }else{
                            $hotels[$hKey]['images'] = str_replace('medium/', '', $img['path']);
                            continue;
                        }
                    } elseif ($type == 1) {
                        $hotels[$hKey]['images'][$ikey]['path'] = $this->removeHotelBedsLink($img['path']);
                    }
                }
            }

            if (isset($hotel['facilities'])) {
                $hotels[$hKey]['facilities'] = $this->buildFacilities($hotel['facilities']);
            }
            
            if ($type == null) {
                $hotels[$hKey]['description'] = (isset($hotels[$hKey]['description']) ? substr($hotels[$hKey]['description'],0,145):"N/A");    
            }

            $accommodations[] = $this->categoryAccomodationType($hotel['categoryCode']);

            $arrPOI = [];
            if (isset($hotel['interestPoints'])) {
                foreach ($hotel['interestPoints'] as $key => $poi) {
                    $arrPOI[] = [
                        'poiName' => $poi['name'],
                        'distance' => $poi['distance'],
                    ];
                }
            }

            $hotels[$hKey]['interestPoints'] = $arrPOI;

            if (count($hotels[$hKey]['rooms']) == 0) {
                unset($hotels[$hKey]);
            }

        }

        if (count($hotels)) {
            $segmentBoardType = $this->sortAvailableHotelFilter($boardTypes , array_values(array_unique($availableBoardTypes)));
            usort($hotels, function ($one, $two) {
                if ($one['minRate'] === $two['minRate']) {
                    return 0;
                }
                return $one['minRate'] > $two['minRate'] ? 1 : -1;
            });

            $hotels['boardType'] = $segmentBoardType;
            $hotels['accommodations'] = array_unique($accommodations);
            $hotels['range'] = [$min,$max];
        }
        
        return $hotels;
	}

    function makeFilter($filters, $option)
    {
        $result =[];
        if($option){
            $result = array_merge($result, ['111AAA'=>'All']);
        }
        
        foreach ($filters as $filter){
            if($option)
                $result = array_merge($result, [$filter=> $filter]);
            else
                $result[] = [$filter, $filter];
        }

        if($option){
            ksort($result);
        }

        return $result;
    }

    function sortAvailableHotelFilter($hotelSegment, $segmentHolder)
    {
        $arrRet = [];
        foreach ($hotelSegment as $key => $segments){
            for($i = 0; Count($segmentHolder) > $i; $i++){    
                if($segments['code'] == $segmentHolder[$i]){
                    $arrRet[] = [$segments['code'], $segments['content']];
                }
            }
        }
     
        return $arrRet;
    }


	/**
	 * Build Paxes for API request parameter
	 *
	 * @author JRLValdez
	 * @date 08/23/2018
	 *
	 * @param array $occupant
	 *
	 * @return array
	*/
	function buildPaxes($occupant)
	{
		$return = array();
		
		for($i=1; $i <= $occupant['adults']; $i++) {
		 	$return[] = [
				'type'=>'AD',
				'age' => 30
			];
		}

		if ($occupant['children']['count'] > 0) {
		 	unset($occupant['children']['count']);
			foreach ($occupant['children'] as $key => $value) {
				$return[] = [
				'type'=>'CH',
				'age' => $value
			];
			}
		}

		return $return;
	}

    /**
     * Get hotel star
     *
     * @author JRLValdez
     * @date 2017
     *
     * @param string $category
     * @param string    $categoryName
     *
     * @return string
    */
    function getHotelStars($category, $categoryName)
    {
        $star = 0;

        if (substr($category, 1) == "EST") {
            $star = substr($category, 0, 1);
        } elseif (substr($category, 0, 2) == "HS") {
            $star = substr($category, 2, 1);
        } elseif (substr($category, 0, 1) == "H") {
            $star = substr($category, 1, 1);
            $star += .5;
        } elseif (substr($category, 0, 3) == "HSR") {
            $star = substr($category, 3, 1);
        } elseif (substr($category, 0, 2) == "HR") {
            $star = substr($category, 2, 1);
        } elseif (substr($category, 0, 2) == "AT") {
            $star = substr($category, 2, 1);
        } elseif (substr($category, 1) == "LL") {
            $star = substr($category, 0, 1);
        } elseif (substr($category, 1) == "LUX") {
            $star = substr($category, 0, 1);
        } elseif (substr($category, 0, 4) == "APTH") {
            $star = substr($category, 4, 1);
        } elseif ($category == "SUP" && $categoryName != "") {
            $sup = explode(' ', $categoryName);
            $star = substr($sup[1], 0, 1);
        } 

        return $star;
    }

    /**
     * Filter number
     *
     * @author JRLValdez
     * @date 2017
     *
     * @param int|float $baseNumber
     * @param string    $condition
     * @param int|float $newNumber
     *
     * @return string
    */
    function filterNumber($baseNumber, $condition, $newNumber)
    {
        if ($baseNumber == "" || $baseNumber == 0){
            $baseNumber = $newNumber;
        } else {
            if ($condition == '>'){
                if($newNumber > $baseNumber){
                    $baseNumber = $newNumber;
                }
            } else {
                if ($newNumber < $baseNumber){
                    $baseNumber = $newNumber;
                }
            }
        }

        return $baseNumber;
    }

	/**
	 * Build Paxes for API request parameter
	 *
	 * @author JRLValdez
	 * @date 08/23/2018
	 *
	 * @param string $date
	 *
	 * @return string
	*/
	function convertTimeZone($date)
    {
        $explodeDate = explode('T',$date);
        $getTimeZoneIfPlus = explode('+', $explodeDate[1]);
        $getTimeZoneIfMinus = explode('-', $explodeDate[1]);
        $getTimeZoneIfZ = explode('Z', $explodeDate[1]);

        if(COUNT($getTimeZoneIfPlus) == 2){
            $timezone = "+".$getTimeZoneIfPlus[1];
            $time = $getTimeZoneIfMinus[0];
        }elseif(COUNT($getTimeZoneIfMinus) == 2){
            $timezone = "-".$getTimeZoneIfMinus[1];
            $time = $getTimeZoneIfMinus[0];
        }elseif(COUNT($getTimeZoneIfZ)){
            $timezone ="+00:00";
            $time = $getTimeZoneIfZ[0];
        }else{
            $timezone = "+08:00";
        }

        if($timezone == "+08:00")
            return $date;

        return $this->convertDate(date("Y-m-d H:i:s", strtotime($explodeDate[0].' '.$time)),$timezone);
    }

    /**
	 * convert date to +08:00 timezone
	 *
	 * @author JRLValdez
	 * @date 08/23/2018
	 *
	 * @param string $date
	 * @param string $timezone
	 *
	 * @return string
	*/
    function convertDate($date, $timezone)
    {
        $date = DB::select("SELECT CONVERT_TZ('".$date."','".$timezone."','+08:00') as convDate");
        return $date[0]->convDate;
    }

    /**
     * remove hotelbeds image links
     *
     * @author JRLValdez
     * @date 08/23/2018
     *
     * @param string $date
     * @param string $timezone
     *
     * @return string
    */
    function removeHotelBedsLink($path)
    {
        $path = str_replace('http://photos.hotelbeds.com/giata/', '', $path);
        $arrPath = explode('/', $path);
        unset($arrPath[0]);
        return implode('/', $arrPath);
    }

    /**
     * Build paxes details for booking api parameter
     *
     * @author JRLValdez
     * @date 08/30/2018
     *
     * @param array $paxes
     * @param array $rateKey
     *
     * @return string
    */
    function buildPaxesDetails($guest, $rateKey)
    {
        $return = [];
        $pax=[];
        
        $arrRateKey = explode('|*|', $rateKey);
        foreach ($guest as $gKey => $gst) {
            $details = $this->sortGetRateKey($arrRateKey, $gst);
            $arrRateKey = $details['arrRateKey'];
            $paxes = [];
            
            foreach ($gst["adult"] as $key => $value) {
                $pax['roomId'] = 1;
                $pax['type'] = "AD";
                $pax['firstName'] = $value['firstname'];
                $pax['lastName'] = $value['lastname'];
                $pax['birthdate'] = $value['birthdate'];

                $paxes[] = $pax;
                $pax = [];
            }

            if(isset($gst["child"])) {
                foreach ($gst["child"] as $key => $value) {
                    $pax['roomId'] = 1;
                    $pax['type'] = "CH";
                    $pax['firstName'] = $value['firstname'];
                    $pax['lastName'] = $value['lastname'];
                    $pax['birthdate'] = $value['birthdate'];

                    $paxes[] = $pax;
                    $pax = [];
                }
            }

            $return[] = [
                'rateKey' => $details['rateKey'],
                'paxes' => $paxes
            ];
        }

        return preg_replace('/"([a-zA-Z_]+[a-zA-Z0-9_]*)":/','$1:', json_encode($return));
    }

    /**
     * parse and sort to compare the ratekey to be use in
     * in the API request
     *
     * @author JRLValdez
     * @date 09/18/2018
     *
     * @param array $arrRateKey
     * @param array $guestDetails
     *
     * @return array
    */
    function sortGetRateKey($arrRateKey, $guestDetails)
    {
        $count['child'] = 0;
        $count['adult'] = count($guestDetails['adult']);
        if(isset($guestDetails['child'])) {
            $count['child'] = count($guestDetails['child']);
        }

        foreach ($arrRateKey as $key => $value) {
            $arrRT = explode("|", $value);
            $combination = explode('~', $arrRT[9]);
            if ($combination[1] == $count['adult'] && $combination[2] == $count['child']) {
                $ret = $arrRateKey[$key];
                unset($arrRateKey[$key]);
                return [
                    'rateKey' => $ret,
                    'arrRateKey' => $arrRateKey
                ];
            }
        }
    }

    /**
     * @param $time time() value
     *
     * @return string
     */
    function getMinutesLaps($time)
    {
        return [
            'y' => $time / 31556926 % 12,
            'w' => $time / 604800 % 52,
            'd' => $time / 86400 % 7,
            'h' => $time / 3600 % 24,
            'm' => $time / 60 % 60,
            's' => $time % 60
        ];
    }


    function buildFacilities($facilities)
    {
        $location = []; $hotelType =[]; $methodOfPayment = [];
        $distances = [];    $roomFacilties  =[];    $roomDistribution = [];
        $roomDistributionAlternative = [];  $arrFacility = [];  $catering = [];
        $business = []; $entertainment = [];    $health = [];
        $greenProgramWorldWide = [];    $greenProgramEurope = [];   $greenProgramAmericas = [];
        $greenProgramAsiaPacific = [];  $meals = [];    $TKM = [];
        $sports = [];   $POI = [];

        foreach($facilities as $key=>$facility){
            // print_r($facility);
            // exit;
            if($facility['facilityGroupCode'] == 10):
                $indYesOrNo = $this->checkIsSetNodeToken($facility, "indYesOrNo");
                $number = $this->checkIsSetNodeToken($facility, "number");
                $location[] = ["name" => $facility['name'], "indYesOrNo" => $indYesOrNo, "number" => $number];

            elseif($facility['facilityGroupCode'] == 20):
                $indLogic = $this->checkIsSetNodeToken($facility, "indLogic");
                $hotelType[] = ["name" => $facility['name'], "indLogic" => $indLogic];

            elseif($facility['facilityGroupCode'] == 30):
                $methodOfPayment[] = ["name" => $facility['name'], "indLogic" => $facility['indLogic']];

            elseif($facility['facilityGroupCode'] == 40):
                // $distances[] = ["name" => $facility['name'], "distance" => $facility['distance']];

            elseif($facility['facilityGroupCode'] == 60):
                $indFee = $this->checkIsSetNodeToken($facility, "indFee");
                $indYesOrNo = $this->checkIsSetNodeToken($facility, "indYesOrNo");
                $indLogic = $this->checkIsSetNodeToken($facility, "indLogic");
                $number = $this->checkIsSetNodeToken($facility, "number");
                $roomFacilties[] = ["name" => $facility['name'], "indFee" => $indFee, "indYesOrNo" => $indYesOrNo, "indLogic" => $indLogic, "number" => $number];

            elseif($facility['facilityGroupCode'] == 61):
                $indFee = $this->checkIsSetNodeToken($facility, "indFee");
                $indYesOrNo = $this->checkIsSetNodeToken($facility, "indYesOrNo");
                $indLogic = $this->checkIsSetNodeToken($facility, "indLogic");
                $roomDistribution[] = ["name"=>$facility['name'], "indFee"=>$indFee, "indYesOrNo"=>$indYesOrNo, "indLogic"=>$indLogic];

            elseif($facility['facilityGroupCode'] == 62):
                $indFee = $this->checkIsSetNodeToken($facility, "indFee");
                $indYesOrNo = $this->checkIsSetNodeToken($facility, "indYesOrNo");
                $indLogic = $this->checkIsSetNodeToken($facility, "indLogic");
                $roomDistributionAlternative[] = ["name"=>$facility['name'], "indFee"=>$indFee, "indYesOrNo"=>$indYesOrNo, "indLogic"=>$indLogic];

            elseif($facility['facilityGroupCode'] == 70):
                $indFee = $this->checkIsSetNodeToken($facility, "indFee");
                $indYesOrNo = $this->checkIsSetNodeToken($facility, "indYesOrNo");
                $indLogic = $this->checkIsSetNodeToken($facility, "indLogic");
                $timeFrom = $this->checkIsSetNodeToken($facility, "timeFrom");
                $timeTo = $this->checkIsSetNodeToken($facility, "timeTo");
                $arrFacility[] = ["name"=>$facility['name'], "indLogic"=>$indLogic,"indYesOrNo"=>$indYesOrNo, "indFee" => json_encode($indFee), "timeFrom" => $timeFrom, "timeTo" =>$timeTo];

            elseif($facility['facilityGroupCode'] == 71):
                $indFee = $this->checkIsSetNodeToken($facility, "indFee");
                $indLogic = $this->checkIsSetNodeToken($facility, "indLogic");
                $catering[] = ["name"=>$facility['name'], "indLogic"=>$indLogic, "indFee" => $indFee];

            elseif($facility['facilityGroupCode'] == 72):
                $indFee = $this->checkIsSetNodeToken($facility, "indFee");
                $indLogic = $this->checkIsSetNodeToken($facility, "indLogic");
                $business[] = ["name"=>$facility['name'], "indLogic"=>$indLogic, "indFee" => $indFee];

            elseif($facility['facilityGroupCode'] == 73):
                $indFee = $this->checkIsSetNodeToken($facility, "indFee");
                $indLogic = $this->checkIsSetNodeToken($facility, "indLogic");
                $number = $this->checkIsSetNodeToken($facility, "number");
                $entertainment[] = ["name"=>$facility['name'], "indLogic"=>$indLogic, "indFee" => $indFee, "number"=>$number];

            elseif($facility['facilityGroupCode'] == 74):
                $indFee = $this->checkIsSetNodeToken($facility, "indFee");
                $indLogic = $this->checkIsSetNodeToken($facility, "indLogic");
                $health[] = ["name"=>$facility['name'], "indLogic"=>$indLogic, "indFee" => $indFee];

            elseif($facility['facilityGroupCode'] == 75):
                $greenProgramWorldWide[] = ["name"=>$facility['name']];
            elseif($facility['facilityGroupCode'] == 76):
                $indLogic = $this->checkIsSetNodeToken($facility, "indLogic");
                $number = $this->checkIsSetNodeToken($facility, "number");
                $greenProgramEurope[] = ["name"=>$facility['name'], "indLogic"=>$indLogic, "number" => $number];

            elseif($facility['facilityGroupCode'] == 77):
                $indLogic = $this->checkIsSetNodeToken($facility, "indLogic");
                $number = $this->checkIsSetNodeToken($facility, "number");
                $greenProgramAmericas[] = ["name"=>$facility['name'], "indLogic"=>$indLogic, "number" => $number];

            elseif($facility['facilityGroupCode']  == 78):
                $indLogic = $this->checkIsSetNodeToken($facility, "indLogic");
                $number = $this->checkIsSetNodeToken($facility, "number");
                $greenProgramAsiaPacific[] = ["name"=>$facility['name'], "indLogic"=>$indLogic, "number" => $number];

            elseif($facility['facilityGroupCode'] == 79):
                $indLogic = $this->checkIsSetNodeToken($facility, "indLogic");
                $number = $this->checkIsSetNodeToken($facility, "number");
                $greenProgramAfrica[] = ["name"=>$facility['name'], "indLogic"=>$indLogic, "number" => $number];

            elseif($facility['facilityGroupCode'] == 80):
                $number = $this->checkIsSetNodeToken($facility, "number");
                $meals[] = ["name" => $facility['name'],"number"=>$number];

            elseif($facility['facilityGroupCode'] == 85):
                $TKM[] = ["name" => $facility['name']];

            elseif($facility['facilityGroupCode'] == 90):
                $indFee = $this->checkIsSetNodeToken($facility, "indFee");
                $indLogic = $this->checkIsSetNodeToken($facility, "indLogic");
                $sports[] = ["name"=>$facility['name'], "indLogic"=>$indLogic, "indFee" => $indFee];

            elseif($facility['facilityGroupCode'] == 100):
                $indFee = $this->checkIsSetNodeToken($facility, "indFee");
                $indLogic = $this->checkIsSetNodeToken($facility, "indLogic");
                $POI[] = ["name"=>$facility['name'], "indLogic"=>$indLogic, "indFee" => $indFee];

            endif;
        }
        return [
            "location"=> $location,
            "hotelType"=> $hotelType,
            "methodOfPayment"=> $methodOfPayment,
            "distances"=> $distances,
            "roomFacilties"=> $roomFacilties,
            "roomDistribution"=> $roomDistribution,
            "roomDistributionAlternative"=> $roomDistributionAlternative,
            "arrFacility"=> $arrFacility,
            "catering"=> $catering,
            "business"=> $business,
            "entertainment"=> $entertainment,
            "health"=> $health,
            "greenProgramWorldWide"=> $greenProgramWorldWide,
            "greenProgramEurope"=> $greenProgramEurope,
            "greenProgramAmericas"=> $greenProgramAmericas,
            "greenProgramAsiaPacific"=> $greenProgramAsiaPacific,
            "meals"=> $meals,
            "TKM"=> $TKM,
            "sports"=> $sports,
            "POI"=> $POI,
        ];
    }

    function checkIsSetNodeToken($node, $nodeName){
        return isset($node[$nodeName]) ? $node[$nodeName] : null;
    }

    /*Constants*/

    #   Author    : JRLVALDEZ
    #   Parameter : Accommodation
    #   Task      : get accomodation
    #   Return    : return accommodation detail
    function accommodation($acod)
    {
        $accomodation = [
            "APART"=>"Apartment","APTHOTEL"=>"Aparthotel","CAMPING"=>"Camping",
            "HOMES"=>"Villa","HOSTEL"=>"Hostel","HOTEL"=>"Hotel",
            "PENDING"=>"Pending Category","RESORT"=>"Resort","RURAL"=>"Rural"
        ];

        return $accomodation[$acod];
    }

    #   Author    : JRLVALDEZ
    #   Parameter : Category
    #   Task      : get category
    #   Return    : return category detail
    function categories($cat)
    {
        $category = [
            "1EST"=>"1 STAR", "1LL"=>"1 KEY", "2"=>"2 STARS",
            "2EST"=>"2 STARS","2LL"=>"2 KEYS","3"=>"3 STARS",
            "3EST"=>"3 STARS","3LL"=>"3 KEYS","4EST"=>"4 STARS",
            "4LL"=>"4 KEYS","4LUX"=>"4 STARS LUXURY","5EST"=>"5 STARS",
            "5LL"=>"5 KEYS","5LUX"=>"5 STARS LUXURY","AG"=>"RURAL HOUSE",
            "ALBER"=>"HOSTEL","APTH"=>"APARTHOTEL 1*","APTH2"=>"APARTHOTEL 2*",
            "APTH3"=>"APARTHOTEL 3*","APTH4"=>"APARTHOTEL 4*","APTH5"=>"APARTHOTEL 5*",
            "AT1"=>"APARTMENT 1ST CATEGORY","AT2"=>"APARTMENT 2ND CATEGORY","AT3"=>"APARTMENT 3RD CATEGORY",
            "BB"=>"BED AND BREAKFAST","BB3"=>"BED AND BREAKFAST 3*","BB4"=>"BED AND BREAKFAST 4*",
            "BB5"=>"BED AND BREAKFAST 5*","BOU"=>"BOUTIQUE","CAMP1"=>"1ST CAMPING",
            "CAMP2"=>"2ND CAMPING","CHUES"=>"GUEST HOUSE","H1_5"=>"1 STAR AND A HALF",
            "H2S"=>"SUPERIOR 2*","H2_5"=>"2 STARS AND A HALF","H3S"=>"SUPERIOR 3*",
            "H3_5"=>"3 STARS AND A HALF","H4_5"=>"4 STARS AND A HALF","H5_5"=>"5 STARS AND A HALF",
            "HIST"=>"HISTORICAL HOTEL LUXURIOUS","HR"=>"RURAL HOTEL","HR2"=>"RURAL HOTEL 2*",
            "HR3"=>"RURAL HOTEL 3*","HR4"=>"RURAL HOTEL 4*","HR5"=>"RURAL HOTEL 5*",
            "HRS"=>"RURAL HOTEL SUPERIOR CATEGORY","HS"=>"HOSTEL 1*","HS2"=>"HOSTEL 2*",
            "HS3"=>"HOSTEL 3*","HS4"=>"HOSTEL 4*","HS5"=>"HOSTEL 5*",
            "HSR1"=>"RURAL HOSTEL 1*","HSR2"=>"RURAL HOSTEL 2*","LODGE"=>"LODGE",
            "MINI"=>"MINI HOTEL","PENDI"=>"PENDING CATEGORY","PENSI"=>"BOARDING HOUSE",
            "POUSA"=>"POUSADA","RESID"=>"RESIDENCE","RSORT"=>"RESORT",
            "SPC"=>"WITHOUT OFFICIAL CATEGORY","STD"=>"STANDARD","SUP"=>"SUPERIOR 4*",
            "VILLA"=>"VILLA","VTV"=>"VACATIONALS TURISTICS HOUSES"
        ];

        return $category[$cat];
    }

    #   Author    : JRLVALDEZ
    #   Parameter :
    #   Task      :
    #   Return    :
    function hotelSegmentProfile()
    {
        return [
            ['code' => 29, 'content' => 'Romantic hotels'],
            ['code' => 31, 'content' => 'Design'],
            ['code' => 34, 'content' => 'Business hotels'],
            ['code' => 36, 'content' => 'Golf hotels'],
            ['code' => 37, 'content' => 'Beach hotels'],
            ['code' => 38, 'content' => 'City'],
            ['code' => 39, 'content' => 'Hotels with spa'],
            ['code' => 42, 'content' => 'Historical'],
            ['code' => 43, 'content' => 'Ski hotels'],
            ['code' => 44, 'content' => 'Rural hotels'],
            ['code' => 45, 'content' => 'Sport hotels'],
            ['code' => 81, 'content' => 'Family hotels'],
            ['code' => 100, 'content' => 'Hotels with charm'],
        ];
    }

    #   Author    : JRLVALDEZ
    #   Parameter :
    #   Task      :
    #   Return    :
    function hotelSegmentAmenities()
    {
        return [
            ['code' => 106, 'content' => 'Connecting Room'],
            ['code' => 101, 'content' => 'Swimming Pool'],
            ['code' => 83, 'content' => 'Internet'],
            ['code' => 84, 'content' => 'Wheelchair-friendly'],
            ['code' => 85, 'content' => 'Restaurant'],
            ['code' => 86, 'content' => 'Spa'],
            ['code' => 87, 'content' => 'Parking'],
            ['code' => 88, 'content' => 'TV'],
            ['code' => 89, 'content' => 'Gym'],
            ['code' => 90, 'content' => 'Air conditioned'],
            ['code' => 92, 'content' => 'Heating'],
        ];
    }

    #   Author    : JRLVALDEZ
    #   Parameter :
    #   Task      :
    #   Return    :
    function hotelBoardTypes()
    {
        return
            [
                [   'code' => "AB" , 'content' => "AMERICAN BREAKFAST"],
                [   'code' => "AI" , 'content' => "ALL INCLUSIVE"],
                [   'code' => "AS" , 'content' => "ALL INCLUSIVE SPECIAL"],
                [   'code' => "BB" , 'content' => "BED AND BREAKFAST"],
                [   'code' => "BH" , 'content' => "1 BED AND BREAKFAST + 1 HALF BOARD"],
                [   'code' => "CB" , 'content' => "CONTINENTAL BREAKFAST"],
                [   'code' => "DB" , 'content' => "BUFFET BREAKFAST"],
                [   'code' => "FB" , 'content' => "FULL BOARD"],
                [   'code' => "FD" , 'content' => "DISNEY FB HOTEL: LUNCH AT PARK/DINNER AT HOTEL"],
                [   'code' => "FH" , 'content' => "1 HALF BOARD + 1 FULL BOARD"],
                [   'code' => "FL" , 'content' => "DISNEY FB PLUS: + 15 RESTAURANTS"],
                [   'code' => "FR" , 'content' => "DISNEY FB PREMIUM: + 20 RESTAURANTS"],
                [   'code' => "FS" , 'content' => "DISNEY FB STANDARD: + 5 RESTAURANTS"],
                [   'code' => "GB" , 'content' => "ENGLISH BREAKFAST"],
                [   'code' => "HB" , 'content' => "HALF BOARD"],
                [   'code' => "HH" , 'content' => "DISNEY HB HOTEL: DINNER AT HOTEL"],
                [   'code' => "HL" , 'content' => "DISNEY HB PLUS: + 15 RESTAURANTS"],
                [   'code' => "HR" , 'content' => "DISNEY HB PREMIUM: + 20 RESTAURANTS"],
                [   'code' => "HS" , 'content' => "DISNEY HB STANDARD: + 5 RESTAURANTS"],
                [   'code' => "IB" , 'content' => "IRISH BREAKFAST"],
                [   'code' => "LB" , 'content' => "Light breakfast"],
                [   'code' => "MB" , 'content' => "HALF BOARD WITH BEVERAGES INCLUDED"],
                [   'code' => "PB" , 'content' => "FULL BOARD BEVERAGES INCLUDED"],
                [   'code' => "RO" , 'content' => "ROOM ONLY"],
                [   'code' => "SB" , 'content' => "SCOTTISH BREAKFAST"],
                [   'code' => "SC" , 'content' => "SELF CATERING"]
            ];
    }

    #   Author    : JRLVALDEZ
    #   Parameter :
    #   Task      :
    #   Return    :
    function categoryAccomodationType($cat)
    {
        $categories = [
            [
                "code"=> "1EST",
                "accommodationType"=> "HOTEL",
                "content"=> "Hotel"
            ],
            [
                "code"=> "1LL",
                "accommodationType"=> "APART",
                "content"=> "Apartment"
            ],
            [
                "code"=> "2EST",
                "accommodationType"=> "HOTEL",
                "content"=> "Hotel"
            ],
            [
                "code"=> "2LL",
                "accommodationType"=> "APART",
                "content"=> "Apartment"
            ],
            [
                "code"=> "3EST",
                "accommodationType"=> "HOTEL",
                "content"=> "Hotel"
            ],
            [
                "code"=> "3LL",
                "accommodationType"=> "APART",
                "content"=> "Apartment"
            ],
            [
                "code"=> "4EST",
                "accommodationType"=> "HOTEL",
                "content"=> "Hotel"
            ],
            [
                "code"=> "4LL",
                "accommodationType"=> "APART",
                "content"=> "Apartment"
            ],
            [
                "code"=> "4LUX",
                "accommodationType"=> "HOTEL",
                "content"=> "Hotel"
            ],
            [
                "code"=> "5EST",
                "accommodationType"=> "HOTEL",
                "content"=> "Hotel"
            ],
            [
                "code"=> "5LL",
                "accommodationType"=> "APART",
                "content"=> "Apartment"
            ],
            [
                "code"=> "5LUX",
                "accommodationType"=> "HOTEL",
                "content"=> "Hotel"
            ],
            [
                "code"=> "AG",
                "accommodationType"=> "RURAL",
                "content"=> "RURAL HOUSE"
            ],
            [
                "code"=> "ALBER",
                "accommodationType"=> "HOSTEL",
                "content"=> "Hostel"
            ],
            [
                "code"=> "APTH",
                "accommodationType"=> "APTHOTEL",
                "content"=> "Apartment hotel"
            ],
            [
                "code"=> "APTH2",
                "accommodationType"=> "APTHOTEL",
                "content"=> "Apartment hotel"
            ],
            [
                "code"=> "APTH3",
                "accommodationType"=> "APTHOTEL",
                "content"=> "Apartment hotel"
            ],
            [
                "code"=> "APTH4",
                "accommodationType"=> "APTHOTEL",
                "content"=> "Apartment hotel"
            ],
            [
                "code"=> "APTH5",
                "accommodationType"=> "APTHOTEL",
                "content"=> "Apartment hotel"
            ],
            [
                "code"=> "AT1",
                "accommodationType"=> "APART",
                "content"=> "Apartment"
            ],
            [
                "code"=> "AT2",
                "accommodationType"=> "APART",
                "content"=> "Apartment"
            ],
            [
                "code"=> "AT3",
                "accommodationType"=> "APART",
                "content"=> "Apartment"
            ],
            [
                "code"=> "BB",
                "accommodationType"=> "HOTEL",
                "content"=> "Bed and Breakfast"
            ],
            [
                "code"=> "BB3",
                "accommodationType"=> "HOTEL",
                "content"=> "Bed and Breakfast"
            ],
            [
                "code"=> "BB4",
                "accommodationType"=> "HOTEL",
                "content"=> "Bed and Breakfast"
            ],
            [
                "code"=> "BB5",
                "accommodationType"=> "HOTEL",
                "content"=> "Bed and Breakfast"
            ],
            [
                "code"=> "BOU",
                "accommodationType"=> "HOTEL",
                "content"=> "Boutique"
            ],
            [
                "code"=> "CAMP1",
                "accommodationType"=> "CAMPING",
                "content"=> "Camping"
            ],
            [
                "code"=> "CAMP2",
                "accommodationType"=> "CAMPING",
                "content"=> "Camping"
            ],
            [
                "code"=> "CHUES",
                "accommodationType"=> "HOSTEL",
                "content"=> "Guest House"
            ],
            [
                "code"=> "H1_5",
                "accommodationType"=> "HOTEL",
                "content"=> "Hotel"
            ],
            [
                "code"=> "H2S",
                "accommodationType"=> "HOTEL",
                "content"=> "Hotel Superior"
            ],
            [
                "code"=> "H2_5",
                "accommodationType"=> "HOTEL",
                "content"=> "Hotel"
            ],
            [
                "code"=> "H3S",
                "accommodationType"=> "HOTEL",
                "content"=> "Hotel Superior"
            ],
            [
                "code"=> "H3_5",
                "accommodationType"=> "HOTEL",
                "content"=> "Hotel"
            ],
            [
                "code"=> "H4_5",
                "accommodationType"=> "HOTEL",
                "content"=> "Hotel"
            ],
            [
                "code"=> "H5_5",
                "accommodationType"=> "HOTEL",
                "content"=> "Hotel"
            ],
            [
                "code"=> "HIST",
                "accommodationType"=> "HOTEL ",
                "content"=> "Historical Hotel Luxurious"
            ],
            [
                "code"=> "HR",
                "accommodationType"=> "RURAL",
                "content"=> "Rural Hotel"
            ],
            [
                "code"=> "HR2",
                "accommodationType"=> "RURAL",
                "content"=> "Rural Hotel"
            ],
            [
                "code"=> "HR3",
                "accommodationType"=> "RURAL",
                "content"=> "Rural Hotel"
            ],
            [
                "code"=> "HR4",
                "accommodationType"=> "RURAL",
                "content"=> "Rural Hotel"
            ],
            [
                "code"=> "HR5",
                "accommodationType"=> "RURAL",
                "content"=> "Rural Hotel"
            ],
            [
                "code"=> "HRS",
                "accommodationType"=> "RURAL",
                "content"=> "Rural Hotel"
            ],
            [
                "code"=> "HS",
                "accommodationType"=> "HOSTEL",
                "content"=> "Hostel"
            ],
            [
                "code"=> "HS2",
                "accommodationType"=> "HOSTEL",
                "content"=> "Hostel"
            ],
            [
                "code"=> "HS3",
                "accommodationType"=> "HOSTEL",
                "content"=> "Hostel"
            ],
            [
                "code"=> "HS4",
                "accommodationType"=> "HOSTEL",
                "content"=> "Hostel"
            ],
            [
                "code"=> "HS5",
                "accommodationType"=> "HOSTEL",
                "content"=> "Hostel"
            ],
            [
                "code"=> "HSR1",
                "accommodationType"=> "RURAL",
                "content"=> "Rural Hostel"
            ],
            [
                "code"=> "HSR2",
                "accommodationType"=> "RURAL",
                "content"=> "Rural Hostel"
            ],
            [
                "code"=> "LODGE",
                "accommodationType"=> "HOSTEL",
                "content"=> "Lodge"
            ],
            [
                "code"=> "MINI",
                "accommodationType"=> "HOTEL",
                "content"=> "Mini Hotel"
            ],
            [
                "code"=> "PENDI",
                "accommodationType"=> "PENDING",
                "content"=> "Pending category"
            ],
            [
                "code"=> "PENSI",
                "accommodationType"=> "HOSTEL",
                "content"=> "Boarding House"
            ],
            [
                "code"=> "POUSA",
                "accommodationType"=> "HOSTEL",
                "content"=> "Pousada"
            ],
            [
                "code"=> "RESID",
                "accommodationType"=> "HOSTEL",
                "content"=> "Residence"
            ],
            [
                "code"=> "RSORT",
                "accommodationType"=> "RESORT",
                "content"=> "Resort"
            ],
            [
                "code"=> "SPC",
                "accommodationType"=> "PENDING",
                "content"=> "Without official category"
            ],
            [
                "code"=> "STD",
                "accommodationType"=> "APART",
                "content"=> "Standard"
            ],
            [
                "code"=> "SUP",
                "accommodationType"=> "HOTEL",
                "content"=> "Hostel Superior"
            ],
            [
                "code"=> "VILLA",
                "accommodationType"=> "HOMES",
                "content"=> "Villa"
            ],
            [
                "code"=> "VTV",
                "accommodationType"=> "HOMES",
                "content"=> "Vacational turistics house"
            ]
        ];
        foreach($categories as $category){
            if($category['code'] == $cat){
                return $category['content'];
                break;
            }
        }
    }
    
    /**
     * @Author : JRLVALDEZ
     * 
     * @return json_encode|string
     */
    function getUserHotelServiceDetails()
    {
        $this->load->model('Global_function','global_f');
        // $postVal = $this->input->post(null,true);
        // $url = "http://10.10.1.106:8007/ups_hotel_service_payment/checkHotelService";
        $url = url;
        $parameters = array(
            'dev_id' => $this->global_f->dev_id(),
            'actionId' => 'ups_hotel_service_payment/checkHotelService', 
            'regcode' => $this->user['R'],
            'ip_address' => $this->ip,
            $this->user['SKT'] => md5($this->user['R'].$this->user['SKT'])
        ); 
        $results = $this->curl->call($parameters, $url);
        
        // echo json_encode($results);
        echo $results;
    }

    function activate_hotel_service()
    {
        $results['S'] = 0;
        $this->load->model('Global_function','global_f');
        $postVal = $this->input->post('transactionPassword');
        
        // $url = "http://10.10.1.106:8007/ups_hotel_service_payment/availHotelServices";
        $url = url;
        $parameters = [
            'dev_id' => $this->global_f->dev_id(),
            'actionId' => 'ups_hotel_service_payment/availHotelServices', 
            'regcode' => $this->user['R'],
            'ip_address' => $this->ip,
            'transactionPassword' => $postVal,
            $this->user['SKT'] => md5($this->user['R'].$this->user['SKT']),
        ];
        $results = $this->curl->call($parameters, $url);

        $results2 = json_decode($results, true);
        // print_r($results2);
        if ($results2['S'] == 1) {
            $this->user['hotel_reservation'] = 1;
            $this->user['EC'] = $results2['EC'];
            $this->session->set_userdata('user', $this->user);
        }
        
        echo $results;
    }

    function markup()
    {
        $data = ['menu' => 22, 'parent'=>'' ];
        $data['user'] = $this->user;
        $this->checkUser();

        $details =$this->input->post(null, true);
       
        if (isset($details['btnUpdateMarkup'])) {
            $action = "CreateHotelMarkup";
            $query = "mutation CreateHotelMarkup { 
                hotelMarkup( 
                    values: {
                        regcode: \"".$this->user['R']."\", 
                        amount:\"".$details["markup"]."\", 
                        transactionPassword:\"".$details["transpass"]."\"
                    }){
                        amount,
                    }}";
            $hotels = $this->graphQLAPI($query, null, $action);
            $hotels = json_decode($hotels, true);

            $data['output']['S'] = 0;
            if (isset($hotels['errors'])) {
                $data['output']['M'] = "Failed to get response from the server.";
                if (isset($hotels['errors'][0]['message']) && 
                $hotels['errors'][0]['message'] == "Invalid Transaction Password!") {
                    $data['output']['M'] = "Invalid Transaction Password!";
                }
            } elseif (isset($hotels['data']['hotelMarkup'])) {
                $data['output']['S'] = 1;
                $data['output']['M'] = "SUCCESSFUL";
            }
            
        }
        
        $action = "getMarkUp";
        $query = "query getMarkUp { hotelMarkup( options: {
            where: {
                regcode: \"".$this->user['R']."\"
                }
            })
            { amount }
        }";
        
        $hotels = $this->graphQLAPI($query, null, $action); 
        $hotels = json_decode($hotels, true);

        $data['mark_up'] = $hotels['data']['hotelMarkup']['amount'];
        $this->load->view('layout/header',$data);
        $this->load->view('element/top_header');
        $this->load->view('element/wrapper_header');
        $this->load->view('element/left_panel');
        $this->load->view('hotels/markup', $data); 
        $this->load->view('hotels/css/hotelcss'); 
        $this->load->view('element/wrapper_footer');
        $this->load->view('layout/footer');	
    }

    function maintenance()
    {
        $data['user'] = $this->user;
        $this->load->view('layout/header',$data);
        $this->load->view('element/top_header');
        $this->load->view('element/wrapper_header');
        $this->load->view('element/left_panel');
        $this->load->view('hotels/error', ['error'=>"This service is being updated.  Please transact again after 3 to 4 hours."]); 
        $this->load->view('hotels/css/hotelcss'); 
        $this->load->view('element/wrapper_footer');
        $this->load->view('layout/footer');	
    }
}
