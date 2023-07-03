<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
class Shipping extends CI_Controller {

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

	function fetch_shipping_location()
	{
        $TODAY = date("Y-m-d");
        $SELSHIPPING = $this->input->post('selShipping');

        $parameter = array(
      'dev_id'       => $this->global_f->dev_id(),
      'actionId'         => 'ups_shipping_service/fetch_shipping_datashiplocation',
      'today'          =>$TODAY,
        'selship'          =>$SELSHIPPING,
        'regcode'          =>$this->user['R'],
        'ip_address'       => $this->ip,    
      $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
      );

      $result = $this->curl->call($parameter,url);
      $result = json_decode($result);
      echo json_encode($result);
        
	}

  function fetch_shipping_route()
  {

        $TODAY = date("Y-m-d");
        $ROUTE = $this->input->post('selLocation');
        $SHIP = $this->input->post('selShipping');

        $parameter = array(
      'dev_id'       => $this->global_f->dev_id(),
      'actionId'         => 'ups_shipping_service/fetch_shipping_datashiproute',
      'today'          =>$TODAY,
        'route'          =>$ROUTE,
        'ship'          =>$SHIP,
        'regcode'          =>$this->user['R'],
        'ip_address'       => $this->ip,    
      $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
      );

      $result = $this->curl->call($parameter,url);
      $result = json_decode($result);
      echo json_encode($result);
        
  }

  function getFastCatComputation()
  {

        $TODAY = date("Y-m-d");
        $LOCATION = $this->input->post('selLocation');
        $SEAT = $this->input->post('selSeat');

        $parameter = array(
      'dev_id'       => $this->global_f->dev_id(),
      'actionId'         => 'ups_shipping_service/checkFastCat_rates',
      'today'          =>$TODAY,
        'locationid'          =>$LOCATION,
        'seatid'          =>$SEAT,
        'regcode'          =>$this->user['R'],
        'ip_address'       => $this->ip,    
      $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
      );

      $result = $this->curl->call($parameter,url);
      $result = json_decode($result);
      echo json_encode($result);
        
  }

  // function gettransAsiaComputation()
  // {

  //       $TODAY = date("Y-m-d");
  //       $LOCATION = $this->input->post('selLocation');
  //       $SEAT = $this->input->post('selSeat');
  //       $MINOR = $this->input->post('minorrange');
  //       $REGULAR = $this->input->post('regularrange');
  //       $INFANT = $this->input->post('infantrange');
  //       $STUDENT = $this->input->post('studentrange');
  //       $SENIOR = $this->input->post('seniorrange');

  //       $parameter = array(
  //     'dev_id'       => $this->global_f->dev_id(),
  //     'actionId'         => 'ups_shipping_service/checktransAsia_rates',
  //     'today'          =>$TODAY,
  //       'locationid'          =>$LOCATION,
  //       'seatid'          =>$SEAT,
  //       'minorid'          =>$MINOR,
  //       'regularid'          =>$REGULAR,
  //       'infantid'          =>$INFANT,
  //       'studentid'          =>$STUDENT,
  //       'seniorid'          =>$SENIOR,
  //       'regcode'          =>$this->user['R'],
  //       'ip_address'       => $this->ip,    
  //     $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
  //     );

  //     $result = $this->curl->call($parameter,url);
  //     $result = json_decode($result);
  //     echo json_encode($result);
        
  // }



        public function index()
    {
        
        $data = ['menu' => 29, 'parent'=>'' ];
        $this->checkUser();
    
        $data['user'] = $this->user;
        $url = url;

                     $parameter = array(
                      'dev_id'       => $this->global_f->dev_id(),
                      'actionId'         => 'ups_shipping_service/fetch_shipping',
                      'regcode'          =>$this->user['R'],
                      'ip_address'       => $this->ip,    
                      $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
                      );

                      $result = $this->curl->call($parameter,url);
                      $data["results"] = json_decode($result,true);

              

            $this->load->view('layout/header',$data);
            $this->load->view('element/top_header');
            $this->load->view('element/wrapper_header');
            $this->load->view('element/left_panel');
            $this->load->view('shipping/home'); 
            // $this->load->view('shipping/css/shippingcss'); 
            $this->load->view('element/wrapper_footer');
            $this->load->view('layout/footer');
          
    }
    
    function shipping_home()
    {
        $data = ['menu' => 29, 'parent'=>'' ];
        $this->checkUser();
		
        $data['user'] = $this->user;
        $url = url;

                     $parameter = array(
                      'dev_id'       => $this->global_f->dev_id(),
                      'actionId'         => 'ups_shipping_service/fetch_shipping',
                      'regcode'          =>$this->user['R'],
                      'ip_address'       => $this->ip,    
                      $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
                      );

                      $result = $this->curl->call($parameter,url);
                      $data["results"] = json_decode($result,true);

                      // echo json_encode($data["results"]);

                      // echo json_encode($data["results"]);
                    // echo "<pre>";
                    //   print_r($data["results"]);
                    //   echo "</pre>";

            $this->load->view('layout/header',$data);
            $this->load->view('element/top_header');
            $this->load->view('element/wrapper_header');
            $this->load->view('element/left_panel');
            $this->load->view('shipping/index', []); 
            // $this->load->view('shipping/css/shippingcss'); 
            $this->load->view('element/wrapper_footer');
            $this->load->view('layout/footer');	
        
    }

    function shipping_ticket()
    {
        $data = ['menu' => 29, 'parent'=>'' ];
        $this->checkUser();
    
        $data['user'] = $this->user;
        $url = url;

                     $parameter = array(
                      'dev_id'       => $this->global_f->dev_id(),
                      'actionId'         => 'ups_shipping_service/fetch_shippingTable',
                      'regcode'          =>$this->user['R'],
                      'ip_address'       => $this->ip,    
                      $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
                      );

                      $result = $this->curl->call($parameter,url);
                      $data["results"] = json_decode($result,true);

                      // echo "<pre>";
                      // print_r($data["results"]);
                      // echo "</pre>";

 

            $this->load->view('layout/header',$data);
            $this->load->view('element/top_header');
            $this->load->view('element/wrapper_header');
            $this->load->view('element/left_panel');
            $this->load->view('shipping/eticket'); 
            // $this->load->view('shipping/css/shippingcss'); 
            $this->load->view('element/wrapper_footer');
            $this->load->view('layout/footer'); 
        
    }

    function shipping_shipidticket()
    {
        $data = ['menu' => 29, 'parent'=>'' ];
        $this->checkUser();
    
        $data['user'] = $this->user;
        $url = url;

        $shipid = $this->input->post("shipid");

                     $parameter = array(
                      'dev_id'       => $this->global_f->dev_id(),
                      'actionId'         => 'ups_shipping_service/fetch_shipidticket',
                      'regcode'          =>$this->user['R'],
                      'shipid'          =>$shipid,
                      'ip_address'       => $this->ip,    
                      $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
                      );

                      $result = $this->curl->call($parameter,url);
                      $results = json_decode($result,true);

                      echo json_encode($results);

                      // echo "<pre>";
                      // print_r($data["results"]);
                      // echo "</pre>";

 

            // $this->load->view('layout/header',$data);
            // $this->load->view('element/top_header');
            // $this->load->view('element/wrapper_header');
            // $this->load->view('element/left_panel');
            // $this->load->view('shipping/eticket'); 
            // // $this->load->view('shipping/css/shippingcss'); 
            // $this->load->view('element/wrapper_footer');
            // $this->load->view('layout/footer'); 
        
    }

    function checkFastCat_rates()
    {
        $data = ['menu' => 29, 'parent'=>'' ];
        $this->checkUser();
    
        $data['user'] = $this->user;
        $url = url;

        $seatid = $this->input->post("seatid");
        $locationid = $this->input->post("locationid");

                     $parameter = array(
                      'dev_id'       => $this->global_f->dev_id(),
                      'actionId'         => 'ups_shipping_service/checkFastCat_rates',
                      'regcode'          =>$this->user['R'],
                      'seatid'          =>$seatid,
                      'locationid'          =>$locationid,
                      'ip_address'       => $this->ip,    
                      $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
                      );

                      $result = $this->curl->call($parameter,url);
                      $results = json_decode($result,true);

                      echo json_encode($results);

                      // echo "<pre>";
                      // print_r($data["results"]);
                      // echo "</pre>";

 

            // $this->load->view('layout/header',$data);
            // $this->load->view('element/top_header');
            // $this->load->view('element/wrapper_header');
            // $this->load->view('element/left_panel');
            // $this->load->view('shipping/eticket'); 
            // // $this->load->view('shipping/css/shippingcss'); 
            // $this->load->view('element/wrapper_footer');
            // $this->load->view('layout/footer'); 
        
    }

    function Shipping_firststep()
    {
    
        $data['user'] = $this->user;
        $url = url;

        $ship = json_encode($this->input->post());

        $parameter = array(
        'dev_id'       => $this->global_f->dev_id(),
        'actionId'         => 'ups_shipping_service/testss',
        'ship'          =>$ship,
        'regcode'          =>$this->user['R'],
        'ip_address'       => $this->ip,    
      $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
      );

      $result = $this->curl->call($parameter,url);
      $result = json_decode($result);

      echo json_encode($result);

        
    }

    function viewPassengers()
    {
    
        $data['user'] = $this->user;
        $url = url;

        $trackno = $this->input->post("trackno");

        $parameter = array(
        'dev_id'       => $this->global_f->dev_id(),
        'actionId'         => 'ups_shipping_service/viewPassengers',
        'trackno'          =>$trackno,
        'regcode'          =>$this->user['R'],
        'ip_address'       => $this->ip,    
      $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
      );

      $result = $this->curl->call($parameter,url);
      $result = json_decode($result);

      echo json_encode($result);

      // $this->load->view('layout/header',$data);
      // $this->load->view('element/top_header');
      // $this->load->view('element/wrapper_header');
      // $this->load->view('element/left_panel');
      // $this->load->view('shipping/eticket',$result); 
      // // $this->load->view('shipping/css/shippingcss'); 
      // $this->load->view('element/wrapper_footer');
      // $this->load->view('layout/footer'); 

        
    }

    function shippingActivationFee()
    {
    
        $data['user'] = $this->user;
        $url = url;

        $ship = $this->input->post("shipid");

        $parameter = array(
        'dev_id'       => $this->global_f->dev_id(),
        'actionId'         => 'ups_shipping_service/shippingActivationFee',
        'ship'          =>$ship,
        'regcode'          =>$this->user['R'],
        'ip_address'       => $this->ip,    
      $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
      );

      $result = $this->curl->call($parameter,url);
      $result = json_decode($result);

      echo json_encode($result);

        
    }

    function transactionpasswordforShipping()
    {
    
        $data['user'] = $this->user;
        $url = url;

        $transpassword = $this->input->post("transpassword");
        $shipid = $this->input->post("shipid");

        $parameter = array(
        'dev_id'       => $this->global_f->dev_id(),
        'actionId'         => 'ups_shipping_service/transactionpasswordforShipping',
        'ship'         => $shipid,
        'transpassword'    =>$transpassword,
        'regcode'          =>$this->user['R'],
        'ip_address'       => $this->ip,    
      $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
      );

      $result = $this->curl->call($parameter,url);
      $result = json_decode($result);

      echo json_encode($result);

        
    }

    function checkTransactionPassword()
    {
    
        $data['user'] = $this->user;
        $url = url;

        $transpass = $this->input->post("transactionPassword");
        

        $parameter = array(
        'dev_id'       => $this->global_f->dev_id(),
        'actionId'         => 'ups_shipping_service/checkTransactionPassword',
        'transpass'          =>$transpass,
        'regcode'          =>$this->user['R'],
        'ip_address'       => $this->ip,    
      $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
      );

      $result = $this->curl->call($parameter,url);
      $results = json_decode($result);

      echo json_encode($results);

        
    }

    function Shipping_checkTrackno()
    {
    
        $data['user'] = $this->user;
        $url = url;

        $trackno = $this->input->post("tracknos");
        

        $parameter = array(
        'dev_id'       => $this->global_f->dev_id(),
        'actionId'         => 'ups_shipping_service/checkTrackingNumber',
        'trackno'          =>$trackno,
        'regcode'          =>$this->user['R'],
        'ip_address'       => $this->ip,    
      $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
      );

      $result = $this->curl->call($parameter,url);
      $results = json_decode($result);

      echo json_encode($results);

        
    }

    function ShippingGenerated()
    {
    
        $data['user'] = $this->user;
        $url = url;

        $ticket = $this->input->post("ticket");
        

        $parameter = array(
        'dev_id'       => $this->global_f->dev_id(),
        'actionId'         => 'ups_shipping_service/ShippingGenerated',
        'ticket'          =>$ticket,
        'regcode'          =>$this->user['R'],
        'ip_address'       => $this->ip,    
      $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
      );

      $result = $this->curl->call($parameter,url);
      $results = json_decode($result);

      echo json_encode($results);

        
    }

   
    
}
