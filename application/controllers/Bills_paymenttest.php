<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bills_paymenttest extends CI_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->model('curl_model','curl');
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
		if ($this->user['A_CTRL']['billspayment'] == 1) {

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
				//$this->session->sess_destroy();
				redirect('Main/');
			}
		
	}

	public function batelec_validate(){
		$url = url;
		$ACCTNO = $this->input->post('accountno');
		$AMOUNT = $this->input->post('amount');

				$data['user'] = $this->user;

				$parameter = array(
				'dev_id'     	 => $this->global_f->dev_id(),
				'actionId' 	 	 =>  _batelec_checkaccount,
		        'regcode' 		 =>$this->user['R'],
		        'accountno'  	 =>$ACCTNO,
		        'amount'  	 	 =>$AMOUNT,
		        'ip_address'  	 => $this->ip,    
				$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
				);


			    $result = $this->curl->call($parameter,url);
			   	$result = json_decode($result);
			   	echo json_encode($result);
	}

public function compress_image($source_url, $destination_url, $quality)
  {

  ini_set("memory_limit", "512M");  

  $info = getimagesize($source_url); 

  if ($info['mime'] == 'image/jpeg') 
  $image = imagecreatefromjpeg($source_url); 

  elseif ($info['mime'] == 'image/gif') 
  $image = imagecreatefromgif($source_url);

	elseif ($info['mime'] == 'image/jpg') 
  $image = imagecreatefromgif($source_url);

  elseif ($info['mime'] == 'image/png')
  $image = imagecreatefrompng($source_url); 

  imagejpeg($image, $destination_url, $quality);

  return $destination_url; 

  } 

  public function upload($file,$filename){

    if ($file['error'] == 0){

      if($file['size'] < 2*MB) {

        $url = $file["tmp_name"];

        if($file['size'] > 1*MB)
        {
          $old_size = $file['size'];
              $urltmp = sys_get_temp_dir().'/tmp.jpg';
            $filename = $this->compress_image($file["tmp_name"], $urltmp, 75);
            $new_size = filesize($urltmp);
            
            if($new_size < $old_size)
            {
              $url = $urltmp;
            }
        }

        $image_id = "{$filename}_web.jpg";

        $ch = curl_init();
        $localfile = $url;
        $fp = fopen($localfile, 'r');
        curl_setopt($ch, CURLOPT_URL, 'ftp://'.ftp_server_radius.':800/CAGELCO/'.$image_id);
        curl_setopt($ch, CURLOPT_USERPWD, "argel:argel_argel!!!");
        curl_setopt($ch, CURLOPT_UPLOAD, 1);
        curl_setopt($ch, CURLOPT_INFILE, $fp);
        curl_setopt($ch, CURLOPT_INFILESIZE, filesize($localfile));
        curl_exec ($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error_no = curl_errno($ch);
        curl_close ($ch);

        if($error_no == 0){
          $result = array("S"=>1,'M'=>$image_id);
        }else{
          $result = array("S"=>0,'M'=>"Unable to Upload Images Please Try Again {$httpCode}");
        }
       }else{
        $result = array("S"=>0,'M'=>"Invalid Image Size, Should be less than 2MB");
      }
    }else{
        $result = array("S"=>0,'M'=>"Invalid Image Size, Should be less than 2MB");
      }

      return $result;
    
  }

	public function cagelco_validate(){
		$url = url;
		$ACCTNAME = $this->input->post('inputSubscriberName');
		$ACCTNO = $this->input->post('inputAccountNumber');
		$AMOUNT = $this->input->post('inputAmount');
		$BILLMONTH = $this->input->post('inputGracePeriods');
		$MOBILE = $this->input->post('inputMobile');
		$DISCONDATE = $this->input->post('inputDisconnection');
		$ATTACHMENT = $this->input->post('attachment');
		$TYPE = $this->input->post('inputType');
		$TRNO = $this->input->post('trno');
    	$DATETODAY =  date('d-m-Y-h-m-s');
    	$PREVATTACH = $this->input->post('prevattach');
    	$ID = md5($DATETODAY.'ID').'_ID';

    	$idupload = $this->upload($_FILES['uploadsoacagelco'],$ID);
    	$idupload2 = $this->upload($_FILES['inputimagecagelco2'],$ID);

    	$ATTACHMENTS ='ftp://frequest:frequest@'.ftp_server_radius.':800/CAGELCO/'.$idupload['M'];
    	$ATTACHMENTS2 ='ftp://frequest:frequest@'.ftp_server_radius.':800/CAGELCO/'.$idupload2['M'];
      			
    	if($TRNO){

      			if($idupload['S'] == 1){

            

				$data['user'] = $this->user;

				$parameter = array(
				'dev_id'     	 => $this->global_f->dev_id(),
				'actionId' 	 	 => 'ups_billspay_service/cagelco_checkaccount',
		        'regcode' 		 =>$this->user['R'],
		        'accountname'  	 =>$ACCTNAME,
		        'accountno'  	 =>$ACCTNO,
		        'amount'  	 	 =>$AMOUNT,
		        'billmonth'  	 =>$BILLMONTH,
		        'mobile'  	 	 =>$MOBILE,
		        'discondate'  	 =>$DISCONDATE,
		        'attachment'  	 =>$ATTACHMENTS,
		        'type'  	 	 =>$TYPE,
		        'ip_address'  	 => $this->ip,    
				$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
				);

				}else{
			        $message = array('S'=>0,'M'=>$idupload['M']);
			      }

			      
			    $result = $this->curl->call($parameter,url);
			   	$result = json_decode($result);
			   	echo json_encode($result);
    	}else{
				$data['user'] = $this->user;

				$parameter = array(
				'dev_id'     	 => $this->global_f->dev_id(),
				'actionId' 	 	 => 'ups_billspay_service/cagelco_checkaccount',
		        'regcode' 		 =>$this->user['R'],
		        'accountname'  	 =>$ACCTNAME,
		        'accountno'  	 =>$ACCTNO,
		        'amount'  	 	 =>$AMOUNT,
		        'billmonth'  	 =>$BILLMONTH,
		        'mobile'  	 	 =>$MOBILE,
		        'discondate'  	 =>$DISCONDATE,
		        'attachment'  	 =>$ATTACHMENTS,
		        'type'  	 	 =>$TYPE,
		        'ip_address'  	 => $this->ip,    
				$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
				);
			      
			    $result = $this->curl->call($parameter,url);
			   	$result = json_decode($result);
			   	echo json_encode($result);
    	}



			

	}

	public function cagelco_checkStatus(){
    $url =  url;
    $ACCTNO = $this->input->post('accountno');
    $BILLMONTH = $this->input->post('billmonth');

    $parameter = array(
      'dev_id'     	 => $this->global_f->dev_id(),
      'actionId' 	 	 => 'ups_billspay_service/cagelco_checkStatus',
          'regcode' 		 =>$this->user['R'],
          'accountno'  	 =>$ACCTNO,
          'billmonth'  	 =>$BILLMONTH,
          'ip_address'  	 => $this->ip,    
      $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
      );

      $result = $this->curl->call($parameter,url);
      $result = json_decode($result);
      echo json_encode($result);


  }

  public function INEC_validate(){
    $url =  url;
    $ACCTNO = $this->input->post('accountno');

    $parameter = array(
      'dev_id'     	 => $this->global_f->dev_id(),
      'actionId' 	 	 => 'ups_billspay_service/inec_checkaccount',
          'regcode' 		 =>$this->user['R'],
          'accountno'  	 =>$ACCTNO,
          'ip_address'  	 => $this->ip,    
      		$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
      );

      $result = $this->curl->call($parameter,url);
      $result = json_decode($result);
      echo json_encode($result);


  }


	public function utilitiestest()
	{
		if ($this->user['A_CTRL']['billspayment'] == 1) {
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

				    // echo "<pre>";
				    // print_r($data['API']);
				    // echo "</pre>";

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
	                array_push($data['biller'],$billerinfo["BD"].'|'.$billerinfo["BC"].'|'.$billerinfo["FT"].'|'.$billerinfo["TF"]);	



				if (isset($_POST['btnSubmit'])){
					$url = url;

					if($this->input->post('inputBiller') == NULL) {$BILLER = " ";} else{ $BILLER = $this->input->post('inputBiller');}

					if($this->input->post('inputSubscriberName') == NULL){

						if($this->input->post('inputFName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = strtoupper($this->input->post('inputFName'))." ".strtoupper($this->input->post('inputMName'))." ".strtoupper($this->input->post('inputLName'));}
					}else{

						if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
					}
					
					if($this->input->post('inputFName') == NULL) {$fname = " ";} else{ $fname = $this->input->post('inputFName');}
					if($this->input->post('inputMName') == NULL) {$mname = " ";} else{ $mname = $this->input->post('inputMName');}
					if($this->input->post('inputLName') == NULL) {$lname= " ";} else{ $lname = $this->input->post('inputLName');}

					if($this->input->post('inputAccountNumber') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputAccountNumber');}
					if($this->input->post('inputMobile') == NULL) {$MOBILENO = " ";} else{ $MOBILENO = $this->input->post('inputMobile');}
					if($this->input->post('inputAmount') == NULL) {$AMNT = " ";} else{ $AMNT = $this->input->post('inputAmount');}
					if($this->input->post('inputTpass') == NULL) {$TPASS = " ";} else{ $TPASS = $this->input->post('inputTpass');}
					if($this->input->post('inputBookId') == NULL) {$BKID = " ";} else{ $BKID = $this->input->post('inputBookId');}
					if($this->input->post('inputBillingMonth') == NULL) {$BILLMONTH = " ";} else{ $BILLMONTH = $this->input->post('inputBillingMonth');}
					if($this->input->post('inputGracePeriod') == NULL) {$LEAVEDATE = " ";} else{ $LEAVEDATE = $this->input->post('inputGracePeriod');}
					if($this->input->post('inputGracePeriod') == NULL) {$GRACEPERIOD = " ";} else{ $GRACEPERIOD = $this->input->post('inputGracePeriod');}
					if ( $BILLER == 206) {
						if($this->input->post('inputGracePeriods') == NULL) {$GRACEPERIOD = " ";} else{ $GRACEPERIOD = $this->input->post('inputGracePeriods');}
						if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
						if($this->input->post('inputDisconnection') == NULL) {$BILLMONTH = " ";} else{ $BILLMONTH = $this->input->post('inputDisconnection');}
					}


					if($this->input->post('selSem') == NULL) {$SEM = " ";} else{ $SEM = $this->input->post('selSem');}

					// if ( $BILLER == 238 || $BILLER == 304 || $BILLER == 336 || $BILLER == 337 || $BILLER == 338 || $BILLER == 339 || $BILLER == 340 || $BILLER == 341 || $BILLER == 349 || $BILLER == 357 ) {
					if($this->input->post('selSem') == NULL) {
						if($this->input->post('inputBillerNo') == NULL) {$SEM = " ";} else{ $SEM = $this->input->post('inputBillerNo');}
					}
					// } else {
					// 	$SEM = " ";
					// }

					// if ( $BILLER == 335 ) {
					if($this->input->post('inputBillingMonth') == NULL) {
						$BILLMONTH = " ";
					}else{
						if($this->input->post('inputDueDate') == NULL) {$BILLMONTH = " ";} else{ $BILLMONTH = $this->input->post('inputDueDate');}
					}
					// } else {
					// 	$BILLMONTH = " ";
					// }

					if ( $BILLER == 241 ) {
						if($this->input->post('inputDueDateBatelec') == NULL) {$SEM = " ";} else{ $SEM = $this->input->post('inputDueDateBatelec');}
					}

					if ($BILLER == 337 || $BILLER == 423 || $BILLER == 358 || $BILLER == 304 || $BILLER == 303 || $BILLER == 393 || $BILLER == 489 || $BILLER == 336 || $BILLER == 369) {

					if($this->input->post('inputAccount') == NULL) {$SEM = " ";} else{ $SEM = $this->input->post('inputAccount');}

					}


					if ( $BILLER == 636 ) {
						if($this->input->post('inputBillingMonth') == NULL) {$BILLMONTH = " ";} else{ $BILLMONTH = $this->input->post('inputBillingMonth');}
						if($this->input->post('inputDueDate') == NULL) {$SEM = " ";} else{ $SEM = $this->input->post('inputDueDate');}
					}

					if ( $BILLER == 260) {
						if($this->input->post('inputAccountNumber') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputAccountNumber');}
						if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
						if($this->input->post('inputMobile') == NULL) {$MOBILENO = " ";} else{ $MOBILENO = $this->input->post('inputMobile');}
						if($this->input->post('inputAmount') == NULL) {$AMNT = " ";} else{ $AMNT = $this->input->post('inputAmount');}

						if($this->input->post('inputBillingMonth') == NULL) {$BILLMONTH = " ";} else{ $BILLMONTH = $this->input->post('inputBillingMonth');}
					}


					$data['submitBtn'] = $this->input->post('btnSubmit');
					// $lname= " ";
					// $fname= " ";
					// $mname= " ";

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
						        'sem' 			 => $SEM,
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
						        'covered_from' 	 => " ",
						        'covered_to'  	 => " ",
								$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($TPASS))
								);
						
						// print_r($this->input->post());
						// print_r($parameter);exit();

						$result = $this->curl->call($parameter,$url);
						$data['API'] = json_decode($result,true);

						// print_r($data['API']);exit();

						if($data['API']['S'] == 1){		
					  		$this->user['EC'] = $data['API']['EC'];		  	
					  		$data['user'] = $this->global_f->get_user_session();
					  		$data['submitBtn'] = 1;
				  		}

				}
				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('billspayment/utilitiestest'); //
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

	public function telecom()
	{
		if ($this->user['A_CTRL']['billspayment'] == 1) {
		$data = array('menu' => 4,
					 'parent'=>'');

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

					$data['user'] = $this->user;
					$url = url;

					$parameter =array(
							'dev_id'    	   => $this->global_f->dev_id(),
							'actionId' 	 	   => _fetch_biller_infos,
							'regcode'          =>$this->user['R'],
							'ip_address'       => $this->ip, 
							$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
							);
				    $result = $this->curl->call($parameter,$url);
				    $data['API'] = json_decode($result,true);

				    echo "<pre>";
				   	print_r($data['API']);
				    echo "</pre>";
				    //

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
		            array_push($data['biller'],$billerinfo["BD"].'|'.$billerinfo["BC"].'|'.$billerinfo["FT"].'|'.$billerinfo["TF"]);	


				if (isset($_POST['btnSubmit'])){
					$url = url;

					if($this->input->post('inputBiller') == NULL) {$BILLER = " ";} else{ $BILLER = $this->input->post('inputBiller');}
					if($this->input->post('inputAccountNumber') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputAccountNumber');}
					if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
					if($this->input->post('inputAmount') == NULL) {$AMNT = " ";} else{ $AMNT = $this->input->post('inputAmount');}
					if($this->input->post('inputTpass') == NULL) {$TPASS = " ";} else{ $TPASS = $this->input->post('inputTpass');}
					if($this->input->post('inputMobile') == NULL) {$MOBILENO = " ";} else{ $MOBILENO = $this->input->post('inputMobile');}

					// if ( $BILLER == 343 ) {
					if($this->input->post('inputBillerNo') == NULL) {$SEM = " ";} else{ $SEM = $this->input->post('inputBillerNo');}
					// } else {
					// 	$SEM = " ";
					// }

					if ( $BILLER == 426 || $BILLER == 541 || $BILLER == 503) {
						if($this->input->post('inputAccount') == NULL) {$SEM = " ";} else{ $SEM = $this->input->post('inputAccount');}
					}

					if ( $BILLER == 427) {
						if($this->input->post('inputAccount') == NULL) {$MOBILENO = " ";} else{ $MOBILENO = $this->input->post('inputAccount');}
					} 

					$data['submitBtn'] = $this->input->post('btnSubmit');

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
						        'bookid' 		 => " ",
						        'billingmonth'   => " ",
						        'schoolyear' 	 => " ",
						        'sem' 			 => $SEM,
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
						        'covered_from' 	 => " ",
						        'covered_to'  	 => " ",
								$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($TPASS))
								);
					$result = $this->curl->call($parameter,$url);
					$data['API'] = json_decode($result,true);

					if($data['API']['S'] == 1){		
				  		$this->user['EC'] = $data['API']['EC'];		  	
				  		$data['user'] = $this->global_f->get_user_session();
				  		$data['submitBtn'] = 1;
			  		}

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
			}
		}else {
			//$this->session->unset_userdata('user');
			//$this->session->sess_destroy();
			redirect('Main/');
		}		
	}

	public function airlines()
	{
		if ($this->user['A_CTRL']['billspayment'] == 1) {

		$data = array('menu' => 4,
					  'parent'=>'');

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

					$data['user'] = $this->user;
					$url = url;

					$parameter =array(
							'dev_id'     	   => $this->global_f->dev_id(),
							'actionId' 	 	   => _fetch_biller_infos,
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
		            array_push($data['biller'],$billerinfo["BD"].'|'.$billerinfo["BC"].'|'.$billerinfo["FT"].'|'.$billerinfo["TF"]);	


				if (isset($_POST['btnSubmit'])){
					$url = url;

					if($this->input->post('inputBiller') == NULL) {$BILLER = " ";} else{ $BILLER = $this->input->post('inputBiller');}
					if($this->input->post('inputAccountNumber') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputAccountNumber');}
					if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
					if($this->input->post('inputMobile') == NULL) {$MOBILENO = " ";} else{ $MOBILENO = $this->input->post('inputMobile');}
					if($this->input->post('email') == NULL) {$EMAIL = " ";} else{ $EMAIL = $this->input->post('email');}
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
						        'mobileno' 		 =>$MOBILENO,
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
						        'email' 		 =>$EMAIL,
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
						        'covered_from' 	 => " ",
						        'covered_to'  	 => " ",
								$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($TPASS))
								);
					$result = $this->curl->call($parameter,$url);
					$data['API'] = json_decode($result,true);

					if($data['API']['S'] == 1){		
				  		$this->user['EC'] = $data['API']['EC'];		  	
				  		$data['user'] = $this->global_f->get_user_session();
				  		$data['submitBtn'] = 1;
			  		}

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
			}
		}else {
			//$this->session->unset_userdata('user');
			//$this->session->sess_destroy();
			redirect('Main/');
		}	
	}

	public function credit_card()
	{
		if ($this->user['A_CTRL']['billspayment'] == 1) {

		$data = array('menu' => 4,
					 'parent'=>'');

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

					$data['user'] = $this->user;
					$url = url;

					$parameter =array(
							'dev_id'     	   => $this->global_f->dev_id(),
							'actionId' 	 	   => _fetch_biller_infos,
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
		            array_push($data['biller'],$billerinfo["BD"].'|'.$billerinfo["BC"].'|'.$billerinfo["FT"].'|'.$billerinfo["TF"]);	


				if (isset($_POST['btnSubmit'])){
					$url = url;

					if($this->input->post('inputBiller') == NULL) {$BILLER = " ";} else{ $BILLER = $this->input->post('inputBiller');}
					if($this->input->post('inputAccountNumber') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputAccountNumber');}
					if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
					if($this->input->post('inputMobile') == NULL) {$MOBILENO = " ";} else{ $MOBILENO = $this->input->post('inputMobile');}
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
						        'mobileno' 		 =>$MOBILENO,
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
						        'covered_from' 	 => " ",
						        'covered_to'  	 => " ",
								$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($TPASS))
								);
					$result = $this->curl->call($parameter,$url);
					$data['API'] = json_decode($result,true);

					// var_dump($data['API']);
					if($data['API']['S'] == 1){		
				  		$this->user['EC'] = $data['API']['EC'];		  	
				  		$data['user'] = $this->global_f->get_user_session();
				  		$data['submitBtn'] = 1;
			  		}

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

			}
		}else {
			//$this->session->unset_userdata('user');
			//$this->session->sess_destroy();
			redirect('Main/');
		}
	}

	public function government()
	{
		if ($this->user['A_CTRL']['billspayment'] == 1) {


		$data = array('menu' => 4,
					 'parent'=>'');

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;
				$url = url;

					$parameter =array(
							'dev_id'    	   => $this->global_f->dev_id(),
							'actionId' 	 	   => _fetch_biller_infos,
							'regcode'          =>$this->user['R'],
							'ip_address'       => $this->ip, 
							$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
							);
				    $result = $this->curl->call($parameter,$url);
				    $data['API'] = json_decode($result,true);

				    // echo "<pre>";
				    // print_r($result);
				    // echo "</pre>";

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

		            if($this->user['R'] == 'GPTTM001'){
		            	foreach($data['fetch'] as $billerinfo)
			            	if($billerinfo["BC"] == 103) {
								array_push($data['biller'],$billerinfo["BD"].'|'.$billerinfo["BC"].'|'.$billerinfo["FT"].'|'.$billerinfo["TF"]);	
			            	}
		            } else{
		            	foreach($data['fetch'] as $billerinfo)
		            	array_push($data['biller'],$billerinfo["BD"].'|'.$billerinfo["BC"].'|'.$billerinfo["FT"].'|'.$billerinfo["TF"]);
		            }

		            // echo "<pre>";
		            // print_r($data['API']);
		            // echo "</pre>";


				if (isset($_POST['btnSubmit'])){
					$url = url;

					if($this->input->post('inputBiller') == NULL) {$BILLER = " ";} else{ $BILLER = $this->input->post('inputBiller');}
					if($this->input->post('inputAccountNumber') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputAccountNumber');}
					if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
					if($this->input->post('inputAmount') == NULL) {$AMNT = " ";} else{ $AMNT = $this->input->post('inputAmount');}
					if($this->input->post('inputTpass') == NULL) {$TPASS = " ";} else{ $TPASS = $this->input->post('inputTpass');}
					if($this->input->post('inputMobile') == NULL) {$MOBILENO = " ";} else{ $MOBILENO = $this->input->post('inputMobile');}

					if($this->input->post('inputCoveredFrom') == NULL) {$COVERED_FROM = " ";} else{ $COVERED_FROM = $this->input->post('inputCoveredFrom');}
					if($this->input->post('inputCoveredTo') == NULL) {$COVERED_TO = " ";} else{ $COVERED_TO = $this->input->post('inputCoveredTo');}

					if($this->input->post('formseries') == NULL) {$FORMSERIES = " ";} else{ $FORMSERIES = $this->input->post('formseries');}
					if($this->input->post('formtype') == NULL) {$YEARLEVEL = " ";} else{ $YEARLEVEL = $this->input->post('formtype');}
					if($this->input->post('taxtype') == NULL) {$TAXTYPE = " ";} else{ $TAXTYPE = $this->input->post('taxtype');}
					if($this->input->post('inputReturnPeriod') == NULL) {$RETURNPERIOD = " ";} else{ $RETURNPERIOD = $this->input->post('inputReturnPeriod');}
					if($this->input->post('inputTPBC') == NULL) {$TPBC = " ";} else{ $TPBC = $this->input->post('inputTPBC');}


					if ($BILLER == 207){
						$YEARLEVEL = " ";

						if($this->input->post('inputLastName') == NULL) {$LNAME = " ";} else{ $LNAME = $this->input->post('inputLastName');}
						if($this->input->post('inputFirstName') == NULL) {$FNAME = " ";} else{ $FNAME = $this->input->post('inputFirstName');}
						if($this->input->post('inputMiddleName') == NULL) {$MNAME = " ";} else{ $MNAME = $this->input->post('inputMiddleName');}

						// if($this->input->post('inputCoveredFrom') == NULL) {$COVERED_FROM = " ";} else{ $COVERED_FROM = $this->input->post('inputCoveredFrom');}
						// if($this->input->post('inputCoveredTo') == NULL) {$COVERED_TO = " ";} else{ $COVERED_TO = $this->input->post('inputCoveredTo');}
						$SUBNAME = $LNAME.",".$FNAME."  ".$MNAME.".";
						$AMNT = 2400;
						$YEARLEVEL = $this->input->post('bdate')."|".$this->input->post('inputFrom')."|".$this->input->post("inputTo"); 

						
					}



					
					$data['submitBtn'] = $this->input->post('btnSubmit');

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
						        'bookid' 		 => " ",
						        'billingmonth'   => $RETURNPERIOD,
						        'schoolyear' 	 => $TAXTYPE,
						        'sem' 			 => " ",
						        'lname' 		 => " ",
						        'mname' 		 => " ",
						        'fname' 		 => " ",
						        'course' 		 => $FORMSERIES,
						        'yearlevel' 	 => $YEARLEVEL,
						        'campus' 		 => $TPBC,
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
						        'covered_from' 	 => $COVERED_FROM,
						        'covered_to'  	 => $COVERED_TO,
								$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($TPASS))
								);
					$result = $this->curl->call($parameter,$url);
					$data['API'] = json_decode($result,true);

					// print_r($parameter);exit();

					if($data['API']['S'] == 1){		
				  		$this->user['EC'] = $data['API']['EC'];		  	
				  		$data['user'] = $this->global_f->get_user_session();
				  		$data['submitBtn'] = 1;
			  		}

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
			}
		}else {
			//$this->session->unset_userdata('user');
			//$this->session->sess_destroy();
			redirect('Main/');
		}
	}

	public function insurance()
	{
		if ($this->user['A_CTRL']['billspayment'] == 1) {
		$data = array('menu' => 4,
					 'parent'=>'');

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;
				$url = url;

					$parameter =array(
							'dev_id'     	   => $this->global_f->dev_id(),
							'actionId' 	 	   => _fetch_biller_infos,
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
		            array_push($data['biller'],$billerinfo["BD"].'|'.$billerinfo["BC"].'|'.$billerinfo["FT"].'|'.$billerinfo["TF"]);	


				if (isset($_POST['btnSubmit'])){
					$url = url;

					if($this->input->post('inputBiller') == NULL) {$BILLER = " ";} else{ $BILLER = $this->input->post('inputBiller');}
					if($this->input->post('inputAccountNumber') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputAccountNumber');}
					if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
					if($this->input->post('inputAmount') == NULL) {$AMNT = " ";} else{ $AMNT = $this->input->post('inputAmount');}
					if($this->input->post('inputTpass') == NULL) {$TPASS = " ";} else{ $TPASS = $this->input->post('inputTpass');}
					if($this->input->post('inputMobile') == NULL) {$MOBILENO = " ";} else{ $MOBILENO = $this->input->post('inputMobile');}
					$data['submitBtn'] = $this->input->post('btnSubmit');

					$parameter = array(
								'dev_id'         => $this->global_f->dev_id(),
								'actionId' 	 	 => _post_biller,
						        'regcode' 		 =>$this->user['R'],
						        'billercode' 	 =>$BILLER,
						        'accountno'  	 =>$ACCTNO,
						        'subscribername' =>$SUBNAME,
						        'mobileno' 		 =>$MOBILENO,
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
						        'covered_from' 	 => " ",
						        'covered_to'  	 => " ",
								$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($TPASS))
								);
					$result = $this->curl->call($parameter,$url);
					$data['API'] = json_decode($result,true);



					if($data['API']['S'] == 1){		
				  		$this->user['EC'] = $data['API']['EC'];		  	
				  		$data['user'] = $this->global_f->get_user_session();
				  		$data['submitBtn'] = 1;
			  		}

				}

					// 				echo "<pre>";
					// print_r($data['API']);
					// echo "</pre>";
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
			}
		}else {
			//$this->session->unset_userdata('user');
			//$this->session->sess_destroy();
			redirect('Main/');
		}
	}

	public function schools()
	{
		if ($this->user['A_CTRL']['billspayment'] == 1) {

		$data = array('menu' => 4,
					 'parent'=>'');

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

					$data['user'] = $this->user;
					$url = url;

					$parameter =array(
							'dev_id'     	   => $this->global_f->dev_id(),
							'actionId' 	 	   => _fetch_biller_infos,
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
		            array_push($data['biller'],$billerinfo["BD"].'|'.$billerinfo["BC"].'|'.$billerinfo["FT"].'|'.$billerinfo["TF"]);	

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
				    // echo "<pre>";
				    // print_r($data['API']);
				    // echo "</pre>";

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
					if($this->input->post('inputMobile') == NULL) {$MOBILENO = " ";} else{ $MOBILENO = $this->input->post('inputMobile');}

					// if ( $BILLER == 356 ) {
						if($this->input->post('selSem') == NULL) {
							if($this->input->post('inputBillerNo') == NULL) {$SEM = " ";} else{ $SEM = $this->input->post('inputBillerNo');}
						}
					// } else {
					// 	$SEM = " ";
					// }

					if ( $BILLER == 614 ) {
						if($this->input->post('inputBday') == NULL) {$YRLEVEL = " ";} else{ $YRLEVEL = $this->input->post('inputBday');}	
					}
					if ( $BILLER == 678 ) {
						if($this->input->post('inputAccountNumber') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputAccountNumber');}
						if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
						if($this->input->post('inputMobile') == NULL) {$MOBILENO = " ";} else{ $MOBILENO = $this->input->post('inputMobile');}
						if($this->input->post('selSem') == NULL) {$SEM = " ";} else{ $SEM = $this->input->post('selSem');}
						if($this->input->post('inputAmount') == NULL) {$AMNT = " ";} else{ $AMNT = $this->input->post('inputAmount');}
					}
					
					$data['submitBtn'] = $this->input->post('btnSubmit');

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
						        'covered_from' 	 => " ",
						        'covered_to'  	 => " ",
								$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($TPASS))
								);
					// print_r($parameter); exit();
					$result = $this->curl->call($parameter,$url);
					$data['API'] = json_decode($result,true);

					// echo "<pre>";
					// echo $data['API'];
					// echo "</pre>";

					if($data['API']['S'] == 1){		
				  		$this->user['EC'] = $data['API']['EC'];		  	
				  		$data['user'] = $this->global_f->get_user_session();
				  		$data['submitBtn'] = 1;
			  		}

			  		// $data['lname'] = $LNAME;
			  		// $data['mname'] = $MNAME;
			  		// $data['fname'] = $FNAME;

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
			}
		}else {
			//$this->session->unset_userdata('user');
			//$this->session->sess_destroy();
			redirect('Main/');
		}
	}

	public function others()
	{
		if ($this->user['A_CTRL']['billspayment'] == 1) {

		$data = array('menu' => 4,
				     'parent'=>'');

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;
				$url = url;

					$parameter =array(
							'dev_id'     	   => $this->global_f->dev_id(),
							'actionId' 	 	   => _fetch_biller_infos,
							'regcode'          =>$this->user['R'],
							'ip_address'       => $this->ip, 
							$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
							);
				    $result = $this->curl->call($parameter,$url);
				    $data['API'] = json_decode($result,true);

				    // echo "<pre>";
				    // print_r($data['API']);
				    // echo "</pre>";

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
		            array_push($data['biller'],$billerinfo["BD"].'|'.$billerinfo["BC"].'|'.$billerinfo["FT"].'|'.$billerinfo["TF"]);	


				if (isset($_POST['btnSubmit'])){
					$url = url;

					if($this->input->post('inputBiller') == NULL) {$BILLER = " ";} else{ $BILLER = $this->input->post('inputBiller'); }
					if($this->input->post('inputAccountNumber') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputAccountNumber');}
					if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
					if($this->input->post('inputAmount') == NULL) {$AMNT = " ";} else{ $AMNT = $this->input->post('inputAmount');}
					if($this->input->post('inputTpass') == NULL) {$TPASS = " ";} else{ $TPASS = $this->input->post('inputTpass');}
					if($this->input->post('selSchoolYear') == NULL) {$SY = " ";} else{ $SY = $this->input->post('selSchoolYear');}
					if($this->input->post('selSem') == NULL) {$SEM = " ";} else{ $SEM = $this->input->post('selSem');}
					if($this->input->post('selCourse') == NULL) {$COURSE = " ";} else{ $COURSE = $this->input->post('selCourse');}
					if($this->input->post('selYearLevel') == NULL) {$YRLEVEL = " ";} else{ $YRLEVEL = $this->input->post('selYearLevel');}
					if($this->input->post('inputMobile') == NULL) {$MOBILENO = " ";} else{ $MOBILENO = $this->input->post('inputMobile');}
					if($this->input->post('inputType') == NULL) {$TYPE = " ";} else{ $TYPE = $this->input->post('inputType');}


					// if ( $BILLER == 352 || $BILLER == 354 ) {
						if($this->input->post('selSem') == NULL) {
							if($this->input->post('inputBillerNo') == NULL) {$SEM = " ";} else{ $SEM = $this->input->post('inputBillerNo');}
						}
					// } else {
					// 	$SEM = " ";
					// }


					if($this->input->post('inputFName') == NULL) {$FNAME = " ";} else{ $FNAME = strtoupper($this->input->post('inputFName'));}
					if($this->input->post('inputLName') == NULL) {$LNAME = " ";} else{ $LNAME = strtoupper($this->input->post('inputLName'));}

					if ( $BILLER == 351 ) {
						if($this->input->post('inputCampus') == NULL) {$CAMPUS = " ";} else{ $CAMPUS = $this->input->post('inputCampus');}
					} else {
						$CAMPUS = " ";
					}

					if ( $BILLER == 422 ) {
						if($this->input->post('LoanReference') == NULL) {$COURSE = " ";} else{ $COURSE = $this->input->post('LoanReference');}
					}


					if ($BILLER == 356 || $BILLER == 352 || $BILLER == 499 || $BILLER == 501 || $BILLER == 525 || $BILLER == 527 || $BILLER == 528 || $BILLER == 529 ) 
					{

					if($this->input->post('inputAccount') == NULL) {$SEM = " ";} else{ $SEM = $this->input->post('inputAccount');}

					}

					$data['submitBtn'] = $this->input->post('btnSubmit');

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
						        'bookid' 		 => " ",
						        'billingmonth'   => " ",
						        'schoolyear' 	 =>$SY,
						        'sem' 			 =>$SEM,
						        'lname' 		 =>$LNAME,
						        'mname' 		 => " ",
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
						        'ip_address'  	 =>$this->ip,        
						        'type' 			 =>$TYPE,
						        'provider' 		 => " ",
						        'covered_from' 	 => " ",
						        'covered_to'  	 => " ",
								$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($TPASS))
								);
					// echo "<pre>";
					// print_r($parameter); 
					// echo "</pre>";
					// die;

					$result = $this->curl->call($parameter,$url);
					$data['API'] = json_decode($result,true);

					if($data['API']['S'] == 1){		
				  		$this->user['EC'] = $data['API']['EC'];		  	
				  		$data['user'] = $this->global_f->get_user_session();
				  		$data['submitBtn'] = 1;
			  		}

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
			}
		}else {
			//$this->session->unset_userdata('user');
			//$this->session->sess_destroy();
			redirect('Main/');
		}
	}


	public function ecashtopup()
	{
		if ($this->user['A_CTRL']['billspayment'] == 1) {

		$data = array('menu' => 4,
				     'parent'=>'');

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;
				$url = url;

					$parameter =array(
							'dev_id'     	   => $this->global_f->dev_id(),
							'actionId' 	 	   => _fetch_biller_infos,
							'regcode'          =>$this->user['R'],
							'ip_address'       => $this->ip, 
							$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
							);
				    $result = $this->curl->call($parameter,$url);
				    $data['API'] = json_decode($result,true);

			    	$data['fetch'] = array(); 
				    for ($i=0; $i < count($data['API']['P_DATA']); $i++) { 
				   		if ($data['API']['P_DATA'][$i]['BG'] == 'E-CASH TOP UP') {
				   			array_push($data['fetch'], $data['API']['P_DATA'][$i]);
				   		}
				    }

				   	$data['biller'] = array(); 
		            $tmp = Array(); 
		            foreach($data['fetch'] as $billerinfo) 
		                $tmp[] = $billerinfo["BD"]; 
		            array_multisort($tmp, $data['fetch']); 
		            foreach($data['fetch'] as $billerinfo)
		            array_push($data['biller'],$billerinfo["BD"].'|'.$billerinfo["BC"].'|'.$billerinfo["FT"].'|'.$billerinfo["TF"]);	


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
					if($this->input->post('inputMobile') == NULL) {$MOBILENO = " ";} else{ $MOBILENO = $this->input->post('inputMobile');}
					$data['submitBtn'] = $this->input->post('btnSubmit');

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
						        'covered_from' 	 => " ",
						        'covered_to'  	 => " ",
								$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($TPASS))
								);
					$result = $this->curl->call($parameter,$url);
					$data['API'] = json_decode($result,true);

					if($data['API']['S'] == 1){		
				  		$this->user['EC'] = $data['API']['EC'];		  	
				  		$data['user'] = $this->global_f->get_user_session();
				  		$data['submitBtn'] = 1;
			  		}

				}
				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('billspayment/ecashtopup'); 
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


	public function mcwd()
	{
		if ($this->user['A_CTRL']['billspayment'] == 1) {

		$data = array('menu' => 4,
				     'parent'=>'');

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;
				$url = url;

				$data['process'] = 1; 

				if (isset($_POST['btnCheckStatus'])){
					$url = url;

					$parameter = array(
								'dev_id'     	 => $this->global_f->dev_id(),
								'actionId' 	 	 => 'ups_billspay_service/verify_mcwd_txnStatus',
						        'regcode' 		 => $this->user['R'],
						        'trackno' 		 => $this->input->post('inputReferenceNo'),
						        'ip_address'  	 => $this->ip,   
								$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
								);

					// var_dump($parameter); 

					$result = $this->curl->call($parameter,$url);
					$data['API'] = json_decode($result,true);

					// var_dump($data['API']); 

					if($data['API']['S'] == 1){		
				  		$data['submitBtn'] = 1;
			  		}
				}

				if (isset($_POST['btnValidate'])){
					$url = url;

					$parameter = array(
								'dev_id'     	 => $this->global_f->dev_id(),
								'actionId' 	 	 => 'ups_billspay_service/verify_mcwd_client',
								// 'actionId' 	 	 => 'ups_billspay_service/verify_mcwd_alltxns',
						        'regcode' 		 => $this->user['R'],
						        'fname' 		 => $this->input->post('inputFName'),
						        'lname' 		 => $this->input->post('inputLName'),
						        'address' 		 => $this->input->post('ClientAddress'),
						        'ip_address'  	 => $this->ip,   
								$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
								);

					// var_dump($parameter); 

					$result = $this->curl->call($parameter,$url);
					$data['API'] = json_decode($result,true);

					// var_dump($data['API'] ); 

					if($data['API']['S'] == 1){		
				  		$data['process'] = 2;
			  		}else{
			  			$data['process'] = 1; 	
			  		}
				}

				if (isset($_POST['btnSubmit'])){

					$url = url;

					if($this->input->post('consumer_code') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('consumer_code');}

					if($this->input->post('inputFName') == NULL) {$FNAME = " ";} else{ $FNAME = $this->input->post('inputFName');}
					if($this->input->post('inputLName') == NULL) {$LNAME = " ";} else{ $LNAME = $this->input->post('inputLName');}

					$SUBNAME = TRIM($FNAME).' '.TRIM($LNAME);

					if($this->input->post('ClientAddress') == NULL) {$SEM = " ";} else{ $SEM = $this->input->post('ClientAddress');}
					if($this->input->post('inputMobile') == NULL) {$MOBNO = " ";} else{ $MOBNO = $this->input->post('inputMobile');}
					if($this->input->post('selBalance') == NULL) {$AMNT = " ";} else{ $AMNT = $this->input->post('selBalance');}
					if($this->input->post('inputTpass') == NULL) {$TPASS = " ";} else{ $TPASS = $this->input->post('inputTpass');}
					
					$parameter = array(
								'dev_id'     	 => $this->global_f->dev_id(),
								'actionId' 	 	 => _post_biller,
						        'regcode' 		 =>	$this->user['R'],
						        'billercode' 	 =>	'129',
						        'accountno'  	 =>	$ACCTNO,
						        'subscribername' =>	$SUBNAME,
						        'mobileno' 		 => $MOBNO,
						        'amount' 		 =>	str_replace(",","",$AMNT),
						        'transpass' 	 =>	$TPASS,
						        'bookid' 		 =>	" ",
						        'billingmonth'   =>	" ",
						        'schoolyear' 	 =>	" ",
						        'sem' 			 =>	$SEM,
						        'lname' 		 => " ",
						        'mname' 		 => " ",
						        'fname' 		 => " ",
						        'course' 		 =>	" ",
						        'yearlevel' 	 =>	" ",
						        'campus' 		 => " ",
						        'idno' 			 =>	" ",
						        'email' 		 => " ",
						        'leavedate' 	 => " ",
						        'returndate' 	 => " ", 
						        'route1' 		 => " ",
						        'flightno1'      => " ",
						        'etd1' 			 => " ",
						        'route2' 		 => " ",
						        'flightno2' 	 => " ",
						        'etd2' 			 => " ",
						        'ip_address'  	 =>	$this->ip,        
						        'type' 			 => " ",
						        'provider' 		 => " ",
								$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($TPASS))
								);

					$result = $this->curl->call($parameter,$url);

					// var_dump($parameter); 

					$data['API'] = json_decode($result,true);

					// var_dump($data['API'] ); 

					if($data['API']['S'] == 1){		
				  		$this->user['EC'] = $data['API']['EC'];		  	
				  		$data['user'] = $this->global_f->get_user_session();
				  		$data['process'] = 1; 
				  		// $data['submitBtn'] = 1;
				  		$array_msg = array('S'=>1,'M'=>'Transaction completed. Pending Approval. Please wait for the status notification.','TN'=>$data['API']['TN']);
						$this->session->set_flashdata('msgsuccess',$array_msg);
						redirect($_SERVER['REQUEST_URI']);
			  		}else{
			  			$data['process'] = 2; 
			  			
			  		}

				}

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('billspayment/mcwd'); 
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


	public function metroturf()
	{
		if ($this->user['A_CTRL']['billspayment'] == 1) {

		$data = array('menu' => 4,
				     'parent'=>'');

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;
				$url = url;

				if (isset($_POST['btnSubmit'])){
					$url = url;

					$this->session->set_userdata('info',$this->input->post());

					$parameter = array(
								'dev_id'     	 => $this->global_f->dev_id(),
								'actionId' 	 	 => _post_biller,
						        'regcode' 		 =>$this->user['R'],
						        'billercode' 	 =>'551',
						        'accountno'  	 =>$this->input->post('accountno'),
						        'subscribername' =>$this->input->post('inputFName').', '.$this->input->post('inputLName'),
						        'mobileno' 		 => " ",
						        'amount' 		 =>str_replace(",","",$this->input->post('inputAmount')),
						        'transpass' 	 =>$this->input->post('inputTpass'),
						        'bookid' 		 =>" ",
						        'billingmonth'   =>" ",
						        'schoolyear' 	 =>" ",
						        'sem' 			 =>" ",
						        'lname' 		 => " ",
						        'mname' 		 => " ",
						        'fname' 		 => " ",
						        'course' 		 =>" ",
						        'yearlevel' 	 =>" ",
						        'campus' 		 => " ",
						        'idno' 			 =>" ",
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
								$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
								);

					$result = $this->curl->call($parameter,$url);
					$results = json_decode($result,true);

					if($results['S'] == 1){		
				  		$this->user['EC'] = $results['EC'];		  	
				  		$data['user'] = $this->global_f->get_user_session();
				  		$data['API'] = array(
				  			  'S' => 1, 
				  			  'M' => $results['M'],
				  			  'TN'=> $results['TN']
				  			  );
			  		}else{
			  			$data['infos'] = $this->session->userdata('info');	
				  		$data['API'] = array(
				  			  'S' => 0, 
				  			  'M' => $results['M']
				  			  );	
			  		}

				}
				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('billspayment/metroturf'); 
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

 	function checkdigit11() {

 		if($_POST['biller'] == 552) { 
 			$actionId = _norkis_checkdigit; 
 			$biller = '';
 		} else{ 
 			$actionId = _checkdigit_modulus11;
 			$biller = $_POST['biller'];
 		}
 		
		if (isset($_POST['accountno'])){
			if($_POST['biller'] == 556) { 

				// if (preg_match('/^(GD)/', $_POST['accountno'])){
				// 	$results = array('S' => 1, 'M' => 'Valid Account Number');
				// } else{
				// 	$results = array('S' => 0, 'M' => 'Invalid Account Number Format');
				// }

				$rest = substr($_POST['accountno'], -15, 1); // returns "d"

				// $results = array('S' => 0, 'M' => $rest);
				if ($rest == 7){
				 	$results = array('S' => 1, 'M' => 'Valid Account Number');
				} else{
					$results = array('S' => 0, 'M' => 'Invalid Account Number Format');
				}

			} else{
				$parameter =array(
						'dev_id'     	   => $this->global_f->dev_id(),
						'actionId' 	 	   => $actionId,
						'regcode'          => $this->user['R'],
						'accountno'        => $_POST['accountno'],
						'biller'           => $biller,
						'ip_address'       => $this->ip, 
						$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
						);
			    $result = $this->curl->call($parameter,url);
			    $results = json_decode($result,true);
			}

		}else{
			$results = array('S' => 0, 'M' => 'Invalid input biller');
		}

		echo json_encode($results);

	}


 	function register_mobileno() {

		if (isset($_POST['mobileno'])){

			$parameter =array(
					'dev_id'     	   => $this->global_f->dev_id(),
					'actionId' 	 	   => _register_mobileno,
					'regcode'          => $this->user['R'],
					'mobileno'         => $_POST['mobileno'],
					'ip_address'       => $this->ip, 
					$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
					);
		    $result = $this->curl->call($parameter,url);
		    $results = json_decode($result,true);

		}else{
			$results = array('S' => 0, 'M' => 'Invalid mobile number');
		}

		echo json_encode($results);

	}


 	function verify_register_mobileno() {

		if (isset($_POST['mobileno']) && isset($_POST['code'])){

			$parameter =array(
					'dev_id'     	   => $this->global_f->dev_id(),
					'actionId' 	 	   => _verify_mobileno,
					'regcode'          => $this->user['R'],
					'mobileno'         => $_POST['mobileno'],
					'code'         	   => $_POST['code'],
					'ip_address'       => $this->ip, 
					$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
					);
		    $result = $this->curl->call($parameter,url);
		    $results = json_decode($result,true);

		}else{
			$results = array('S' => 0, 'M' => 'Incomplete details');
		}

		echo json_encode($results);

	}



	public function beepcard()
	{
		if ($this->user['A_CTRL']['billspayment'] == 1) {

		$data = array('menu' => 4,
				     'parent'=>'');

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;
				$url = url;

				if (isset($_POST['btnSubmit'])){

					$CARDNO = $this->input->post('inputCardno');
					$AMNT 	= $this->input->post('inputAmount');
					$TPASS 	= $this->input->post('inputTpass');

					$data['submitBtn'] = $this->input->post('btnSubmit');

					$parameter = array(
								'dev_id'     	 	=> $this->global_f->dev_id(),
								'actionId' 	 	 	=> 'ups_beep_service/reload_beep',
								'ip_address'        => $this->ip, 
						        'regcode' 		 	=> $this->user['R'],
						        'cardno'  	 	 	=> $CARDNO,
						        'amount' 		 	=> str_replace(",","",$AMNT),
						        'transpass' 	 	=> $TPASS,
								$this->user['SKT'] 	=> md5($this->user['R'].$this->user['SKT'].md5($TPASS))
								);

					// echo "<pre>";
					// var_dump($parameter); 
					// echo "</pre>";
					// // die;

					$result = $this->curl->call($parameter,$url);
					$data['API'] = json_decode($result,true);

					// echo "<pre>";
					// var_dump($data['API']); 
					// echo "</pre>";
					// // die;

					if($data['API']['S'] == 1){		
				  		$this->user['EC'] = $data['API']['EC'];		  	
				  		$data['user'] = $this->global_f->get_user_session();

				  		unset($_POST);
			  		}
			  		
				}
				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('billspayment/beepcard'); 
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