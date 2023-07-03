<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bills_payment extends CI_Controller {

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
	  	$this->load->model('Query_model');
	  	$this->load->model('Global_function','global_f');
	}

	public function index()
	{
		if ($this->user['A_CTRL']['remittance'] == 1) {

			$data = array('menu' => 4,
						 'parent'=>'' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['user'] = $this->user;
				$this->load->view('billspayment/index',$data);
			}else {
				//$this->session->unset_userdata('user');
				$this->session->sess_destroy();
				redirect('Login/');
			}
		}else {
				//$this->session->unset_userdata('user');
				$this->session->sess_destroy();
				redirect('Login/');
			}
		
	}

	public function utilities()
	{
		if ($this->user['A_CTRL']['remittance'] == 1) {
		$data = array('menu' => 4,
					 'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;
				$url = url;

				$parameter =array(
							'dev_id'     	   => $this->global_f->dev_id(),
							'actionId' 	 	   => _fetch_biller_info,
							'regcode'          =>$this->user['R'],
							'ip_address'       => $this->ip, 
							$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
							);
			    $result = $this->curl->call($parameter,$url);
			    $data['API'] = json_decode($result,true);


			    $data['fetch'] = array(); 
			    for ($i=0; $i < count($data['API']['P_DATA']); $i++) { 
			   		if ($data['API']['P_DATA'][$i]['BG'] == 'UTILITIES') {
			   			array_push($data['fetch'], $data['API']['P_DATA'][$i]);
			   		}
			    }

			   	$data['biller'] = array(); 
                $tmp = Array(); 
                foreach($data['fetch'] as $billerinfo) 
                    $tmp[] = $billerinfo["BD"]; 
                array_multisort($tmp, $data['fetch']); 
                foreach($data['fetch'] as $billerinfo)
                array_push($data['biller'],$billerinfo["BD"].'|'.$billerinfo["BC"].'|'.$billerinfo["FT"]);	



			if (isset($_POST['btnSubmit'])){
				$url = url;

				if($this->input->post('inputBiller') == NULL) {$BILLER = " ";} else{ $BILLER = $this->input->post('inputBiller');}

				if($BILLER == 125){

				if($this->input->post('inputFName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = strtoupper($this->input->post('inputFName'))." ".strtoupper($this->input->post('inputMName'))." ".strtoupper($this->input->post('inputLName'));}
				if($this->input->post('inputFName') == NULL) {$fname = " ";} else{ $fname = $this->input->post('inputFName');}
				if($this->input->post('inputMName') == NULL) {$mname = " ";} else{ $mname = $this->input->post('inputMName');}
				if($this->input->post('inputLName') == NULL) {$lname= " ";} else{ $lname = $this->input->post('inputLName');}

				}else{

				if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
				}
				
				if($this->input->post('inputAccountNumber') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputAccountNumber');}
				if($this->input->post('inputMobile') == NULL) {$MOBILENO = " ";} else{ $MOBILENO = $this->input->post('inputMobile');}
				if($this->input->post('inputAmount') == NULL) {$AMNT = " ";} else{ $AMNT = $this->input->post('inputAmount');}
				if($this->input->post('inputTpass') == NULL) {$TPASS = " ";} else{ $TPASS = $this->input->post('inputTpass');}
				if($this->input->post('inputBookId') == NULL) {$BKID = " ";} else{ $BKID = $this->input->post('inputBookId');}
				if($this->input->post('inputBillingMonth') == NULL) {$BILLMONTH = " ";} else{ $BILLMONTH = $this->input->post('inputBillingMonth');}
				if($this->input->post('inputGracePeriod') == NULL) {$LEAVEDATE = " ";} else{ $LEAVEDATE = $this->input->post('inputGracePeriod');}
				if ( $BILLER == 206) {
					if($this->input->post('inputGracePeriod') == NULL) {$GRACEPERIOD = " ";} else{ $GRACEPERIOD = $this->input->post('inputGracePeriod');}
					if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
				}
				$data['submitBtn'] = $this->input->post('btnSubmit');
				$lname= " ";
				$fname= " ";
				$mname= " ";

				$parameter = array(
							'dev_id'     	 => $this->global_f->dev_id(),
							'actionId' 	 	 => _post_biller,
					        'regcode' 		 =>$this->user['R'],
					        'billercode' 	 =>$BILLER,
					        'accountno'  	 =>$ACCTNO,
					        'subscribername' =>$SUBNAME,
					        'mobileno' 		 =>$MOBILENO,
					        'amount' 		 =>$AMNT,
					        'transpass' 	 =>$TPASS,
					        'bookid' 		 =>$BKID,
					        'billingmonth'   =>$BILLMONTH,
					        'schoolyear' 	 => " ",
					        'sem' 			 => " ",
					        'lname' 		 => $lname,
					        'mname' 		 => $mname,
					        'fname' 		 => $fname,
					        'course' 		 => " ",
					        'yearlevel' 	 => $GRACEPERIOD,
					        'campus' 		 => " ",
					        'idno' 			 => " ",
					        'email' 		 => " ",
					        'leavedate' 	 =>$LEAVEDATE,
					        'returndate' 	 => " ",
					        'route1' 		 => " ",
					        'flightno1'      => " ",
					        'etd1' 			 => " ",
					        'route2' 		 => " ",
					        'flightno2' 	 => " ",
					        'etd2' 			 => " ",
					        'ip_address'  	 => $this->ip,    
					        'type' 			 => " ",
					        'provider' 		 => " ",
							$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($TPASS))
							);
				
					$result = $this->curl->call($parameter,$url);
					$data['API'] = json_decode($result,true);

			}
			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('billspayment/utilities'); 
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}

	}

	public function telecom()
	{
		if ($this->user['A_CTRL']['remittance'] == 1) {
		$data = array('menu' => 4,
					 'parent'=>'');

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['user'] = $this->user;
				$url = url;

				$parameter =array(
						'dev_id'    	   => $this->global_f->dev_id(),
						'actionId' 	 	   => _fetch_biller_info,
						'regcode'          =>$this->user['R'],
						'ip_address'       => $this->ip, 
						$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
						);
			    $result = $this->curl->call($parameter,$url);
			    $data['API'] = json_decode($result,true);

		    	$data['fetch'] = array(); 
			    for ($i=0; $i < count($data['API']['P_DATA']); $i++) { 
			   		if ($data['API']['P_DATA'][$i]['BG'] == 'TELECOMM') {
			   			array_push($data['fetch'], $data['API']['P_DATA'][$i]);
			   		}
			    }

			   	$data['biller'] = array(); 
	            $tmp = Array(); 
	            foreach($data['fetch'] as $billerinfo) 
	                $tmp[] = $billerinfo["BD"]; 
	            array_multisort($tmp, $data['fetch']); 
	            foreach($data['fetch'] as $billerinfo)
	            array_push($data['biller'],$billerinfo["BD"].'|'.$billerinfo["BC"].'|'.$billerinfo["FT"]);	


			if (isset($_POST['btnSubmit'])){
				$url = url;

				if($this->input->post('inputBiller') == NULL) {$BILLER = " ";} else{ $BILLER = $this->input->post('inputBiller');}
				if($this->input->post('inputAccountNumber') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputAccountNumber');}
				if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
				if($this->input->post('inputAmount') == NULL) {$AMNT = " ";} else{ $AMNT = $this->input->post('inputAmount');}
				if($this->input->post('inputTpass') == NULL) {$TPASS = " ";} else{ $TPASS = $this->input->post('inputTpass');}
				$data['submitBtn'] = $this->input->post('btnSubmit');

				$parameter = array(
							'dev_id'     	 => $this->global_f->dev_id(),
							'actionId' 	 	 => _post_biller,
					        'regcode' 		 =>$this->user['R'],
					        'billercode' 	 =>$BILLER,
					        'accountno'  	 =>$ACCTNO,
					        'subscribername' =>$SUBNAME,
					        'mobileno' 		 => " ",
					        'amount' 		 =>$AMNT,
					        'transpass' 	 =>$TPASS,
					        'bookid' 		 => " ",
					        'billingmonth'   => " ",
					        'schoolyear' 	 => " ",
					        'sem' 			 => " ",
					        'lname' 		 => " ",
					        'mname' 		 => " ",
					        'fname' 		 => " ",
					        'course' 		 => " ",
					        'yearlevel' 	 => " ",
					        'campus' 		 => " ",
					        'idno' 			 => " ",
					        'email' 		 => " ",
					        'leavedate' 	 => " ",
					        'returndate' 	 => " ", 
					        'route1' 		 => " ",
					        'flightno1'      => " ",
					        'etd1' 			 => " ",
					        'route2' 		 => " ",
					        'flightno2' 	 => " ",
					        'etd2' 			 => " ",
					        'ip_address'  	 => $this->ip,        
					        'type' 			 => " ",
					        'provider' 		 => " ",
							$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($TPASS))
							);
				$result = $this->curl->call($parameter,$url);
				$data['API'] = json_decode($result,true);

			}

			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('billspayment/telecom'); 
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');	
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}		
	}

	public function airlines()
	{
		if ($this->user['A_CTRL']['remittance'] == 1) {
		$data = array('menu' => 4,
					  'parent'=>'');

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['user'] = $this->user;
				$url = url;

				$parameter =array(
						'dev_id'     	   => $this->global_f->dev_id(),
						'actionId' 	 	   => _fetch_biller_info,
						'regcode'          =>$this->user['R'],
						'ip_address'       => $this->ip, 
						$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
						);
			    $result = $this->curl->call($parameter,$url);
			    $data['API'] = json_decode($result,true);

		    	$data['fetch'] = array(); 
			    for ($i=0; $i < count($data['API']['P_DATA']); $i++) { 
			   		if ($data['API']['P_DATA'][$i]['BG'] == 'AIRLINES') {
			   			array_push($data['fetch'], $data['API']['P_DATA'][$i]);
			   		}
			    }

			   	$data['biller'] = array(); 
	            $tmp = Array(); 
	            foreach($data['fetch'] as $billerinfo) 
	                $tmp[] = $billerinfo["BD"]; 
	            array_multisort($tmp, $data['fetch']); 
	            foreach($data['fetch'] as $billerinfo)
	            array_push($data['biller'],$billerinfo["BD"].'|'.$billerinfo["BC"].'|'.$billerinfo["FT"]);	


			if (isset($_POST['btnSubmit'])){
				$url = url;

				if($this->input->post('inputBiller') == NULL) {$BILLER = " ";} else{ $BILLER = $this->input->post('inputBiller');}
				if($this->input->post('inputAccountNumber') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputAccountNumber');}
				if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
				if($this->input->post('inputAmount') == NULL) {$AMNT = " ";} else{ $AMNT = $this->input->post('inputAmount');}
				if($this->input->post('inputTpass') == NULL) {$TPASS = " ";} else{ $TPASS = $this->input->post('inputTpass');}
				$data['submitBtn'] = $this->input->post('btnSubmit');

				$parameter = array(
							'dev_id'     	 => $this->global_f->dev_id(),
							'actionId' 	 	 => _post_biller,
					        'regcode' 		 =>$this->user['R'],
					        'billercode' 	 =>$BILLER,
					        'accountno'  	 =>$ACCTNO,
					        'subscribername' =>$SUBNAME,
					        'mobileno' 		 => " ",
					        'amount' 		 =>$AMNT,
					        'transpass' 	 =>$TPASS,
					        'bookid' 		 => " ",
					        'billingmonth'   => " ",
					        'schoolyear' 	 => " ",
					        'sem' 			 => " ",
					        'lname' 		 => " ",
					        'mname' 		 => " ",
					        'fname' 		 => " ",
					        'course' 		 => " ",
					        'yearlevel' 	 => " ",
					        'campus' 		 => " ",
					        'idno' 			 => " ",
					        'email' 		 => " ",
					        'leavedate' 	 => " ",
					        'returndate' 	 => " ", 
					        'route1' 		 => " ",
					        'flightno1'      => " ",
					        'etd1' 			 => " ",
					        'route2' 		 => " ",
					        'flightno2' 	 => " ",
					        'etd2' 			 => " ",
					        'ip_address'     => $this->ip,        
					        'type' 			 => " ",
					        'provider' 		 => " ",
							$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($TPASS))
							);
				$result = $this->curl->call($parameter,$url);
				$data['API'] = json_decode($result,true);

			}

			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('billspayment/airlines'); 
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');	
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}	
	}

	public function credit_card()
	{
		if ($this->user['A_CTRL']['remittance'] == 1) {
		$data = array('menu' => 4,
					 'parent'=>'');

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['user'] = $this->user;
				$url = url;

				$parameter =array(
						'dev_id'     	   => $this->global_f->dev_id(),
						'actionId' 	 	   => _fetch_biller_info,
						'regcode'          =>$this->user['R'],
						'ip_address'       => $this->ip, 
						$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
						);
			    $result = $this->curl->call($parameter,$url);
			    $data['API'] = json_decode($result,true);

		    	$data['fetch'] = array(); 
			    for ($i=0; $i < count($data['API']['P_DATA']); $i++) { 
			   		if ($data['API']['P_DATA'][$i]['BG'] == 'CREDIT_CARD') {
			   			array_push($data['fetch'], $data['API']['P_DATA'][$i]);
			   		}
			    }

			   	$data['biller'] = array(); 
	            $tmp = Array(); 
	            foreach($data['fetch'] as $billerinfo) 
	                $tmp[] = $billerinfo["BD"]; 
	            array_multisort($tmp, $data['fetch']); 
	            foreach($data['fetch'] as $billerinfo)
	            array_push($data['biller'],$billerinfo["BD"].'|'.$billerinfo["BC"].'|'.$billerinfo["FT"]);	


			if (isset($_POST['btnSubmit'])){
				$url = url;

				if($this->input->post('inputBiller') == NULL) {$BILLER = " ";} else{ $BILLER = $this->input->post('inputBiller');}
				if($this->input->post('inputAccountNumber') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputAccountNumber');}
				if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
				if($this->input->post('inputAmount') == NULL) {$AMNT = " ";} else{ $AMNT = $this->input->post('inputAmount');}
				if($this->input->post('inputTpass') == NULL) {$TPASS = " ";} else{ $TPASS = $this->input->post('inputTpass');}
				$data['submitBtn'] = $this->input->post('btnSubmit');

				$parameter = array(
							'dev_id'     	 => $this->global_f->dev_id(),
							'actionId' 	 	 => _post_biller,
					        'regcode' 		 =>$this->user['R'],
					        'billercode' 	 =>$BILLER,
					        'accountno'  	 =>$ACCTNO,
					        'subscribername' =>$SUBNAME,
					        'mobileno' 		 => " ",
					        'amount' 		 =>$AMNT,
					        'transpass' 	 =>$TPASS,
					        'bookid' 		 => " ",
					        'billingmonth'   => " ",
					        'schoolyear' 	 => " ",
					        'sem' 			 => " ",
					        'lname' 		 => " ",
					        'mname' 		 => " ",
					        'fname' 		 => " ",
					        'course' 		 => " ",
					        'yearlevel' 	 => " ",
					        'campus' 		 => " ",
					        'idno' 			 => " ",
					        'email' 		 => " ",
					        'leavedate' 	 => " ",
					        'returndate' 	 => " ", 
					        'route1' 		 => " ",
					        'flightno1'      => " ",
					        'etd1' 			 => " ",
					        'route2' 		 => " ",
					        'flightno2' 	 => " ",
					        'etd2' 			 => " ",
					        'ip_address'  	 => $this->ip,        
					        'type' 			 => " ",
					        'provider' 		 => " ",
							$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($TPASS))
							);
				$result = $this->curl->call($parameter,$url);
				$data['API'] = json_decode($result,true);

			}
			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('billspayment/credit_card'); 
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');	
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}

	public function government()
	{
		if ($this->user['A_CTRL']['remittance'] == 1) {
		$data = array('menu' => 4,
					 'parent'=>'');

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;
			$url = url;

				$parameter =array(
						'dev_id'    	   => $this->global_f->dev_id(),
						'actionId' 	 	   => _fetch_biller_info,
						'regcode'          =>$this->user['R'],
						'ip_address'       => $this->ip, 
						$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
						);
			    $result = $this->curl->call($parameter,$url);
			    $data['API'] = json_decode($result,true);

		    	$data['fetch'] = array(); 
			    for ($i=0; $i < count($data['API']['P_DATA']); $i++) { 
			   		if ($data['API']['P_DATA'][$i]['BG'] == 'GOVERNMENT') {
			   			array_push($data['fetch'], $data['API']['P_DATA'][$i]);
			   		}
			    }

			   	$data['biller'] = array(); 
	            $tmp = Array(); 
	            foreach($data['fetch'] as $billerinfo) 
	                $tmp[] = $billerinfo["BD"]; 
	            array_multisort($tmp, $data['fetch']); 
	            foreach($data['fetch'] as $billerinfo)
	            array_push($data['biller'],$billerinfo["BD"].'|'.$billerinfo["BC"].'|'.$billerinfo["FT"]);	


			if (isset($_POST['btnSubmit'])){
				$url = url;

				if($this->input->post('inputBiller') == NULL) {$BILLER = " ";} else{ $BILLER = $this->input->post('inputBiller');}
				if($this->input->post('inputAccountNumber') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputAccountNumber');}
				if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
				if($this->input->post('inputAmount') == NULL) {$AMNT = " ";} else{ $AMNT = $this->input->post('inputAmount');}
				if($this->input->post('inputTpass') == NULL) {$TPASS = " ";} else{ $TPASS = $this->input->post('inputTpass');}
				$data['submitBtn'] = $this->input->post('btnSubmit');

				$parameter = array(
							'dev_id'     	 => $this->global_f->dev_id(),
							'actionId' 	 	 => _post_biller,
					        'regcode' 		 =>$this->user['R'],
					        'billercode' 	 =>$BILLER,
					        'accountno'  	 =>$ACCTNO,
					        'subscribername' =>$SUBNAME,
					        'mobileno' 		 => " ",
					        'amount' 		 =>$AMNT,
					        'transpass' 	 =>$TPASS,
					        'bookid' 		 => " ",
					        'billingmonth'   => " ",
					        'schoolyear' 	 => " ",
					        'sem' 			 => " ",
					        'lname' 		 => " ",
					        'mname' 		 => " ",
					        'fname' 		 => " ",
					        'course' 		 => " ",
					        'yearlevel' 	 => " ",
					        'campus' 		 => " ",
					        'idno' 			 => " ",
					        'email' 		 => " ",
					        'leavedate' 	 => " ",
					        'returndate' 	 => " ", 
					        'route1' 		 => " ",
					        'flightno1'      => " ",
					        'etd1' 			 => " ",
					        'route2' 		 => " ",
					        'flightno2' 	 => " ",
					        'etd2' 			 => " ",
					        'ip_address'  	 => $this->ip,        
					        'type' 			 => " ",
					        'provider' 		 => " ",
							$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($TPASS))
							);
				$result = $this->curl->call($parameter,$url);
				$data['API'] = json_decode($result,true);

			}
			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('billspayment/government'); 
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');	
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}

	public function insurance()
	{
		if ($this->user['A_CTRL']['remittance'] == 1) {
		$data = array('menu' => 4,
					 'parent'=>'');

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;
			$url = url;

				$parameter =array(
						'dev_id'     	   => $this->global_f->dev_id(),
						'actionId' 	 	   => _fetch_biller_info,
						'regcode'          =>$this->user['R'],
						'ip_address'       => $this->ip, 
						$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
						);
			    $result = $this->curl->call($parameter,$url);
			    $data['API'] = json_decode($result,true);

		    	$data['fetch'] = array(); 
			    for ($i=0; $i < count($data['API']['P_DATA']); $i++) { 
			   		if ($data['API']['P_DATA'][$i]['BG'] == 'INSURANCE') {
			   			array_push($data['fetch'], $data['API']['P_DATA'][$i]);
			   		}
			    }

			   	$data['biller'] = array(); 
	            $tmp = Array(); 
	            foreach($data['fetch'] as $billerinfo) 
	                $tmp[] = $billerinfo["BD"]; 
	            array_multisort($tmp, $data['fetch']); 
	            foreach($data['fetch'] as $billerinfo)
	            array_push($data['biller'],$billerinfo["BD"].'|'.$billerinfo["BC"].'|'.$billerinfo["FT"]);	


			if (isset($_POST['btnSubmit'])){
				$url = url;

				if($this->input->post('inputBiller') == NULL) {$BILLER = " ";} else{ $BILLER = $this->input->post('inputBiller');}
				if($this->input->post('inputAccountNumber') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputAccountNumber');}
				if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
				if($this->input->post('inputAmount') == NULL) {$AMNT = " ";} else{ $AMNT = $this->input->post('inputAmount');}
				if($this->input->post('inputTpass') == NULL) {$TPASS = " ";} else{ $TPASS = $this->input->post('inputTpass');}
				$data['submitBtn'] = $this->input->post('btnSubmit');

				$parameter = array(
							'dev_id'         => $this->global_f->dev_id(),
							'actionId' 	 	 => _post_biller,
					        'regcode' 		 =>$this->user['R'],
					        'billercode' 	 =>$BILLER,
					        'accountno'  	 =>$ACCTNO,
					        'subscribername' =>$SUBNAME,
					        'mobileno' 		 => " ",
					        'amount' 		 =>$AMNT,
					        'transpass' 	 =>$TPASS,
					        'bookid' 		 => " ",
					        'billingmonth'   => " ",
					        'schoolyear' 	 => " ",
					        'sem' 			 => " ",
					        'lname' 		 => " ",
					        'mname' 		 => " ",
					        'fname' 		 => " ",
					        'course' 		 => " ",
					        'yearlevel' 	 => " ",
					        'campus' 		 => " ",
					        'idno' 			 => " ",
					        'email' 		 => " ",
					        'leavedate' 	 => " ",
					        'returndate' 	 => " ", 
					        'route1' 		 => " ",
					        'flightno1'      => " ",
					        'etd1' 			 => " ",
					        'route2' 		 => " ",
					        'flightno2' 	 => " ",
					        'etd2' 			 => " ",
					        'ip_address'  	 => $this->ip,        
					        'type' 			 => " ",
					        'provider' 		 => " ",
							$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($TPASS))
							);
				$result = $this->curl->call($parameter,$url);
				$data['API'] = json_decode($result,true);

			}
			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('billspayment/insurance'); 
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}

	public function schools()
	{
		if ($this->user['A_CTRL']['remittance'] == 1) {
		$data = array('menu' => 4,
					 'parent'=>'');

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['user'] = $this->user;
				$url = url;

				$parameter =array(
						'dev_id'     	   => $this->global_f->dev_id(),
						'actionId' 	 	   => _fetch_biller_info,
						'regcode'          => $this->user['R'],
						'ip_address'       => $this->ip, 
						$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
						);
			    $result = $this->curl->call($parameter,$url);
			    $data['API'] = json_decode($result,true);

		    	$data['fetch'] = array(); 
			    for ($i=0; $i < count($data['API']['P_DATA']); $i++) { 
			   		if ($data['API']['P_DATA'][$i]['BG'] == 'SCHOOLS') {
			   			array_push($data['fetch'], $data['API']['P_DATA'][$i]);
			   		}
			    }

			   	$data['biller'] = array(); 
	            $tmp = Array(); 
	            foreach($data['fetch'] as $billerinfo) 
	                $tmp[] = $billerinfo["BD"]; 
	            array_multisort($tmp, $data['fetch']); 
	            foreach($data['fetch'] as $billerinfo)
	            array_push($data['biller'],$billerinfo["BD"].'|'.$billerinfo["BC"].'|'.$billerinfo["FT"]);	

	       		// $data['course'] = $this->Query_model->course();
	       		// $data['sem'] = $this->Query_model->semester();
	       		// $data['sy'] = $this->Query_model->schoolyear();
	       		// $data['yrlevel'] = $this->Query_model->yearlevel();
	       		// $data['campus'] = $this->Query_model->campus();

	       		$data['get'] = $this->Query_model->getoptions();

		    	$data['course'] = array(); 
			    for ($i=0; $i < count($data['get']['course']); $i++) { 
			   		if ($data['get']['course'][$i]) {
			   			array_push($data['course'], $data['get']['course'][$i]);
			   		}
			    }

		    	$data['sem'] = array(); 
			    for ($i=0; $i < count($data['get']['semester']); $i++) { 
			   		if ($data['get']['semester'][$i]) {
			   			array_push($data['sem'], $data['get']['semester'][$i]);
			   		}
			    }

		    	$data['sy'] = array(); 
			    for ($i=0; $i < count($data['get']['schoolyear']); $i++) { 
			   		if ($data['get']['schoolyear'][$i]) {
			   			array_push($data['sy'], $data['get']['schoolyear'][$i]);
			   		}
			    }

		    	$data['yrlevel'] = array(); 
			    for ($i=0; $i < count($data['get']['yearlevel']); $i++) { 
			   		if ($data['get']['yearlevel'][$i]) {
			   			array_push($data['yrlevel'], $data['get']['yearlevel'][$i]);
			   		}
			    }

		    	$data['campus'] = array(); 
			    for ($i=0; $i < count($data['get']['campus']); $i++) { 
			   		if ($data['get']['campus'][$i]) {
			   			array_push($data['campus'], $data['get']['campus'][$i]);
			   		}
			    }


			if (isset($_POST['btnSubmit'])){
				$url = url;

				if($this->input->post('inputBiller') == NULL) {$BILLER = " ";} else{ $BILLER = $this->input->post('inputBiller');}
				if($this->input->post('inputAccountNumber') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputAccountNumber');}
				if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
				if($this->input->post('inputAmount') == NULL) {$AMNT = " ";} else{ $AMNT = $this->input->post('inputAmount');}
				if($this->input->post('inputTpass') == NULL) {$TPASS = " ";} else{ $TPASS = $this->input->post('inputTpass');}
				if($this->input->post('selSchoolYear') == NULL) {$SY = " ";} else{ $SY = $this->input->post('selSchoolYear');}
				if($this->input->post('selSem') == NULL) {$SEM = " ";} else{ $SEM = $this->input->post('selSem');}
				if($this->input->post('inputLastName') == NULL) {$LNAME = " ";} else{ $LNAME = $this->input->post('inputLastName');}
				if($this->input->post('inputFirstName') == NULL) {$FNAME = " ";} else{ $FNAME = $this->input->post('inputFirstName');}
				if($this->input->post('inputMiddleName') == NULL) {$MNAME = " ";} else{ $MNAME = $this->input->post('inputMiddleName');}
				if($this->input->post('selCourse') == NULL) {$COURSE = " ";} else{ $COURSE = $this->input->post('selCourse');}
				if($this->input->post('selYearLevel') == NULL) {$YRLEVEL = " ";} else{ $YRLEVEL = $this->input->post('selYearLevel');}
				if($this->input->post('selCampus') == NULL) {$CAMPUS = " ";} else{ $CAMPUS = $this->input->post('selCampus');}
				$data['submitBtn'] = $this->input->post('btnSubmit');

				$parameter = array(
							'dev_id'     	 => $this->global_f->dev_id(),
						 	'actionId' 	 	 => _post_biller,
					        'regcode' 		 =>$this->user['R'],
					        'billercode' 	 =>$BILLER,
					        'accountno'  	 =>$ACCTNO,
					        'subscribername' =>$SUBNAME,
					        'mobileno' 		 => " ",
					        'amount' 		 =>$AMNT,
					        'transpass' 	 =>$TPASS,
					        'bookid' 		 => " ",
					        'billingmonth'   => " ",
					        'schoolyear' 	 =>$SY,
					        'sem' 			 =>$SEM,
					        'lname' 		 =>$LNAME,
					        'mname' 		 =>$MNAME,
					        'fname' 		 =>$FNAME,
					        'course' 		 =>$COURSE,
					        'yearlevel' 	 =>$YRLEVEL,
					        'campus' 		 =>$CAMPUS,
					        'idno' 			 => " ",
					        'email' 		 => " ",
					        'leavedate' 	 => " ",
					        'returndate' 	 => " ", 
					        'route1' 		 => " ",
					        'flightno1'      => " ",
					        'etd1' 			 => " ",
					        'route2' 		 => " ",
					        'flightno2' 	 => " ",
					        'etd2' 			 => " ",
					        'ip_address'     =>$this->ip,        
					        'type' 			 => " ",
					        'provider' 		 => " ",
							$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($TPASS))
							);
				$result = $this->curl->call($parameter,$url);
				$data['API'] = json_decode($result,true);


			}
			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('billspayment/schools'); 
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}

	public function others()
	{
		if ($this->user['A_CTRL']['remittance'] == 1) {
		$data = array('menu' => 4,
				     'parent'=>'');

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;
			$url = url;

				$parameter =array(
						'dev_id'     	   => $this->global_f->dev_id(),
						'actionId' 	 	   => _fetch_biller_info,
						'regcode'          =>$this->user['R'],
						'ip_address'       => $this->ip, 
						$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
						);
			    $result = $this->curl->call($parameter,$url);
			    $data['API'] = json_decode($result,true);

		    	$data['fetch'] = array(); 
			    for ($i=0; $i < count($data['API']['P_DATA']); $i++) { 
			   		if ($data['API']['P_DATA'][$i]['BG'] == 'OTHERS') {
			   			array_push($data['fetch'], $data['API']['P_DATA'][$i]);
			   		}
			    }

			   	$data['biller'] = array(); 
	            $tmp = Array(); 
	            foreach($data['fetch'] as $billerinfo) 
	                $tmp[] = $billerinfo["BD"]; 
	            array_multisort($tmp, $data['fetch']); 
	            foreach($data['fetch'] as $billerinfo)
	            array_push($data['biller'],$billerinfo["BD"].'|'.$billerinfo["BC"].'|'.$billerinfo["FT"]);	


			if (isset($_POST['btnSubmit'])){
				$url = url;

				if($this->input->post('inputBiller') == NULL) {$BILLER = " ";} else{ $BILLER = $this->input->post('inputBiller');}
				if($this->input->post('inputAccountNumber') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputAccountNumber');}
				if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
				if($this->input->post('inputAmount') == NULL) {$AMNT = " ";} else{ $AMNT = $this->input->post('inputAmount');}
				if($this->input->post('inputTpass') == NULL) {$TPASS = " ";} else{ $TPASS = $this->input->post('inputTpass');}
				if($this->input->post('selSchoolYear') == NULL) {$SY = " ";} else{ $SY = $this->input->post('selSchoolYear');}
				if($this->input->post('selSem') == NULL) {$SEM = " ";} else{ $SY = $this->input->post('selSem');}
				if($this->input->post('selCourse') == NULL) {$COURSE = " ";} else{ $COURSE = $this->input->post('selCourse');}
				if($this->input->post('selYearLevel') == NULL) {$YRLEVEL = " ";} else{ $YRLEVEL = $this->input->post('selYearLevel');}
				$data['submitBtn'] = $this->input->post('btnSubmit');

				$parameter = array(
							'dev_id'     	 => $this->global_f->dev_id(),
							'actionId' 	 	 => _post_biller,
					        'regcode' 		 =>$this->user['R'],
					        'billercode' 	 =>$BILLER,
					        'accountno'  	 =>$ACCTNO,
					        'subscribername' =>$SUBNAME,
					        'mobileno' 		 => " ",
					        'amount' 		 =>$AMNT,
					        'transpass' 	 =>$TPASS,
					        'bookid' 		 => " ",
					        'billingmonth'   => " ",
					        'schoolyear' 	 =>$SY,
					        'sem' 			 =>$SEM,
					        'lname' 		 => " ",
					        'mname' 		 => " ",
					        'fname' 		 => " ",
					        'course' 		 =>$COURSE,
					        'yearlevel' 	 =>$YRLEVEL,
					        'campus' 		 => " ",
					        'idno' 			 => " ",
					        'email' 		 => " ",
					        'leavedate' 	 => " ",
					        'returndate' 	 => " ", 
					        'route1' 		 => " ",
					        'flightno1'      => " ",
					        'etd1' 			 => " ",
					        'route2' 		 => " ",
					        'flightno2' 	 => " ",
					        'etd2' 			 => " ",
					        'ip_address'  	 =>$this->ip,        
					        'type' 			 => " ",
					        'provider' 		 => " ",
							$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($TPASS))
							);
				$result = $this->curl->call($parameter,$url);
				$data['API'] = json_decode($result,true);

			}
			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('billspayment/others'); 
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}
}