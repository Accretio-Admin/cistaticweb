<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bills_payment extends CI_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->model('Curl_model', 'curl');
		$this->load->model('Check_transaction', 'check_trans');
		$this->load->library('session');
		$this->user = $this->session->userdata('user');
		
		if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER))
		{
			$IP = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
			$IP = $IP[0];
		}
		else
		{
			$IP = $_SERVER['REMOTE_ADDR']; 
		}
		
	    $this->ip = $IP;
	    $this->load->model('Query_model');
	  	$this->load->model('Global_function','global_f');
	    $this->load->model('Sp_model');
	   
	   	if ($this->user['USER_KYC'] != 'APPROVED') 
		{ 
			$this->session->set_flashdata('kycapproved','Oops! an error occured. Your Transaction cannot be completed. To proceed, please complete your account profile.');
			redirect('Main');
  		}
	}

	public function index()
	{	
		if ($this->user['A_CTRL']['billspayment'] == 1) 
		{
			$url = url;

			$data = array('menu' => 4, 'parent'=> '');

			if ($this->user['S'] == 1 && $this->user['R'] != "")
			{
				$data['user'] = $this->user;

				if (substr($this->user['R'], 0, 3) == 'GWL') //For Wealthylifestyle
				{
					$data['billspayment_exceed'] = $this->check_trans->transCount($this->user['R'], 1)['S'];
					$data['beep_reload_exceed'] = $this->check_trans->transCount($this->user['R'], 156)['S'];
					$data['metro_turf_exceed'] = $this->check_trans->transCount($this->user['R'], 150)['S'];
					$data['v1_to_v3_exceed'] = $this->check_trans->transCount($this->user['R'], 174)['S'];

					$this->load->view('billspayment/gwl_index', $data);
				}
				else
				{
					$this->load->view('billspayment/index', $data);
				}	
			}
			else 
			{
				$this->session->sess_destroy();
				redirect('Login/');
			}
		}
		else 
		{
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

				if (false) {//ftp
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
				} else {//sftp
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
						CURLOPT_POSTFIELDS => array('file'=> new CURLFILE($localfile),'file_location' => 'cagelco','regcode' => $this->user['R'],'email' => '123','ext_name' => '.jpg'),
					));
					
					$response = curl_exec($curl); 
					curl_close($curl);
					$upload_response = json_decode($response,true);

					$filename = $upload_response['F'];

					if($error_no == 0){
						$result = array("S"=>1,'M'=>$filename);
					}else{
						$result = array("S"=>0,'M'=>$upload_response['S']);
					}
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
		// $ATTACHMENT = $this->input->post('attachment');
		$TYPE = $this->input->post('inputType');
		// $TRNO = $this->input->post('trno');
    	$DATETODAY =  date('d-m-Y-h-m-s');
    	$PREVATTACH = $this->input->post('prevattach');
    	$ID = md5($DATETODAY.'ID').'_ID';

    	$idupload = $this->upload($_FILES['uploadsoacagelco'],$ID);
    	$idupload2 = $this->upload($_FILES['inputimagecagelco2'],$ID);

    	$ATTACHMENTS ='ftp://frequest:frequest@'.ftp_server_radius.':800/CAGELCO/'.$idupload['M'];
    	$ATTACHMENTS2 ='ftp://frequest:frequest@'.ftp_server_radius.':800/CAGELCO/'.$idupload2['M'];

    	//$result = json_decode($idupload);
      	// echo json_encode($idupload);

      			if($idupload['S'] == 1){

					$data['user'] = $this->user;

					$parameter = array(
					'dev_id'     	 => $this->global_f->dev_id(),
					'actionId' 	 	 => 'ups_billspay_service/cagelco_checkaccount',
			        'regcode' 		 =>$this->user['R'],
			        'accountname'  	 =>$ACCTNAME,
			        'accountno'  	 =>trim($ACCTNO),
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

				}else{
			    	$result = array('S'=>0,'M'=>$idupload['M']);
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
          'accountno'  	 =>trim($ACCTNO),
          'billmonth'  	 =>$BILLMONTH,
          'ip_address'  	 => $this->ip,    
      $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
      );

      $result = $this->curl->call($parameter,url);
      $result = json_decode($result);
      echo json_encode($result);


  }

  public function trackingNo_fetch(){
    $url =  'https://pubsubnet.globalpinoyremittance.com/webportal?op=pa';
    $TRACKNO = $this->input->post('trackingNo');
    // $BILLMONTH = $this->input->post('billmonth');

    $parameter = array(
		  'dev_id'     	 	 => $this->global_f->dev_id(),
		  'actionId' 	 	 => 'ups_billspay_service/bayadcenter_demo',
          'regcode' 		 =>	$this->user['R'],
          'trackno'  	 	 =>	$TRACKNO,
          'ip_address'  	 => $this->ip,
		  'ip'    			 => $this->ip
      );

      $result = $this->curl->call($parameter,url);
      $result = json_decode($result);
      echo json_encode($result);


  }

  public function biller_validation(){
    $url =  url;
    $ACCTNO = $this->input->post('accountnumber');
    $BILLERCODE = $this->input->post('billercode');

    $parameter = array(
      'dev_id'     	 => $this->global_f->dev_id(),
      'actionId' 	 	 => 'ups_billspay_service/validate_biller',
      'regcode' 		 =>$this->user['R'],
      'accountno'  	 =>trim($ACCTNO),
      'billercode'  	 =>$BILLERCODE,
      'ip_address'  	 => $this->ip,    
      $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
      );

      $result = $this->curl->call($parameter,url);
      $result = json_decode($result);

      echo json_encode($result);


  }

  	/**
	 * 
	 *
	 * @param	string	$biller_group	Input string
	 * @return  redirect to a page
	 */

	public function biller_main($biller_group = "")
	{
		switch ($biller_group)
		{
			case 'electric':	$biller_header = 'ELECTRIC';
				$category = 'ELECTRIC';
				$valid_biller = true;
				break;
			case 'water':	$biller_header = 'WATER';
				$category = 'WATER';
				$valid_biller = true;
				break;
			case 'cabletv_internet':	$biller_header = 'CABLE TV / INTERNET';
				$category = 'CABLE TV INTERNET';
				$valid_biller = true;
				break;
			case 'telecomm':	$biller_header = 'TELECOMMUNICATIONS';
				$category = 'TELECOM';
				$valid_biller = true;
				break;
			case 'bank':	$biller_header = 'BANK';
				$category = 'BANKS';
				$valid_biller = true;
				break;
			case 'credit_card':	$biller_header = 'CREDIT CARD';
				$category = 'CREDIT CARDS';
				$valid_biller = true;
				break;
			case 'payment_gateway':	$biller_header = 'PAYMENT GATEWAY';
				$category = 'PAYMENT GATEWAY';
				$valid_biller = true;
				break;
			case 'top_up':	$biller_header = 'TOP UP';
				$category = 'TOP UP';
				$valid_biller = true;
				break;
			case 'airlines':	$biller_header = 'AIRLINES';
				$category = 'AIRLINES';
				$valid_biller = true;
				break;
			case 'government':	$biller_header = 'GOVERNMENT';
				$category = 'GOVERNMENT';
				$valid_biller = true;
				break;
			case 'schools':	$biller_header = 'SCHOOLS';
				$category = 'SCHOOLS';
				$valid_biller = true;
				break;
			case 'real_estate':	$biller_header = 'REAL ESTATE';
				$category = 'REAL ESTATE';
				$valid_biller = true;
				break;
			case 'financial_services':	$biller_header = 'FINANCIAL SERVICES';
				$category = 'FINANCIAL SERVICES';
				$valid_biller = true;
				break;
			case 'insurance':	$biller_header = 'INSURANCE';
				$category = 'INSURANCE';
				$valid_biller = true;
				break;
			case 'charity':	$biller_header = 'CHARITY';
				$category = 'CHARITY';
				$valid_biller = true;
				break;
			case 'memorial':	$biller_header = 'MEMORIAL';
				$category = 'MEMORIAL';
				$valid_biller = true;
				break;
			case 'utilities':	$biller_header = 'UTILITIES';
				$valid_biller = true;
				break;
			case 'others':	$biller_header = 'OTHERS';
				$category = 'OTHERS';
				$valid_biller = true;
				break;
			default:
				$valid_biller = false;
				break;
		}

		if ($this->user['A_CTRL']['billspayment'] == 1 && $valid_biller)
		{
			$data = array(
				'menu' => 4,
				'parent'=>'' 
			);			

			if ($this->user['S'] == 1 && $this->user['R'] != "")
			{
				$this->check_trans->gwlCheckTransLimit(1); //For Wealthylifestyle

				$data['user'] = $this->user;
				$url = url;

				if($this->user['R'] == '1234567')
				{
					$parameter = array(
						'dev_id'     	   => $this->global_f->dev_id(),
						'actionId' 	 	   => 'ups_billspay_service/fetch_biller_lists_bayadcenter',//temp only for web biller list `_fetch_biller_info`  _fetch_biller_info_web
						'regcode'          => $this->user['R'],
						'category'         => $category,
						'ip_address'       => $this->ip, 
						$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'])
					);
				}
				else
				{
					$parameter = array(
						'dev_id'     	   => $this->global_f->dev_id(),
						'actionId' 	 	   => FETCH_BILLER_INFO_WEB_BY_CATEGORY,//temp only for web biller list `_fetch_biller_info`  _fetch_biller_info_web
						'regcode'          => $this->user['R'],
						'category'         => $category,
						'ip_address'       => $this->ip, 
						$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'])
					);	
				}	

				$result = $this->curl->call($parameter,$url);

				$data['API'] = json_decode($result,true);

				$data['fetch'] = array(); 
				for ($i = 0; $i < count($data['API']['P_DATA']); $i++)
				{ 
					// if ($data['API']['P_DATA'][$i]['BG'] == strtoupper($biller_group))
					// {
					array_push($data['fetch'], $data['API']['P_DATA'][$i]);
					// }
				}

				$data['biller'] = array(); 

				$tmp = Array(); 

				foreach($data['fetch'] as $billerinfo)
				{
					$tmp[] = $billerinfo["BD"];					
				}
				array_multisort($tmp, $data['fetch']); 
				
				foreach($data['fetch'] as $billerinfo)
				{
					array_push($data['biller'],$billerinfo["BD"].'|'.$billerinfo["BC"].'|'.$billerinfo["FT"].'|'.$billerinfo["TF"]);	
				}

				$allowed_recode = ['F6708104','F6819290','F6829187','F6857702','F7107276','F7412421','F7496442','F7617021','F7778860','F7943404','F7972424','F8020213','1234567','F5597768','F7900325'];
				if ($biller_group == 'others' and in_array($this->user['R'],$allowed_recode))
				{
					// array_push($data['biller'],'GMA WATER DISTRICT'.'|'.'844'.'|'.'0'.'|'.'0.00');
					// array_push($data['biller'],'CAGAYAN ELECTRIC POWER AND LIGHT COMPANY'.'|'.'846'.'|'.'0'.'|'.'0.00');
					// array_push($data['biller'],'PENINSULA ELECTRIC COOPERATIVE'.'|'.'847'.'|'.'0'.'|'.'0.00');
					// array_push($data['biller'],'TAGUM CITY WATER DISTRICT'.'|'.'848'.'|'.'0'.'|'.'0.00');
					// array_push($data['biller'],'METRO PACIFIC ILOILO WATER'.'|'.'849'.'|'.'0'.'|'.'0.00');
					// array_push($data['biller'],'ISABELA I ELECTRIC COOPERATIVE'.'|'.'850'.'|'.'0'.'|'.'0.00');
					// array_push($data['biller'],'HOME CREDIT'.'|'.'1033'.'|'.'0'.'|'.'0.00');

					// array_push($data['biller'],'ASIALINK FINANCE CORPORATION'.'|'.'1062'.'|'.'0'.'|'.'0.00');
					array_push($data['biller'],'AVON COSMETICS, INC.'.'|'.'1063'.'|'.'0'.'|'.'0.00');
					// array_push($data['biller'],'ADAMSON UNIVERSITY'.'|'.'1082'.'|'.'0'.'|'.'0.00');
					// array_push($data['biller'],'CALAPAN WATERWORKS CORPORATION'.'|'.'1083'.'|'.'0'.'|'.'0.00');
					// array_push($data['biller'],'CENTRAL CATV, INC. AFFILIATES (SKY AFFILIATES)'.'|'.'1084'.'|'.'0'.'|'.'0.00');
					// array_push($data['biller'],'COCOLIFE'.'|'.'1085'.'|'.'0'.'|'.'0.00');
					// array_push($data['biller'],'HAPPY WELL MANAGEMENT & COLLECTION SERVICES, INC.'.'|'.'1086'.'|'.'0'.'|'.'0.00');
					// array_push($data['biller'],'INTELLIGENT E-PROCESSES TECHNOLOGIES CORP. (RFID)'.'|'.'1087'.'|'.'0'.'|'.'0.00');
					// array_push($data['biller'],'LEGAZPI WATER DISTRICT'.'|'.'1088'.'|'.'0'.'|'.'0.00');
					// array_push($data['biller'],'LEYTE II ELECTRIC COOPERATIVE, INC.'.'|'.'1089'.'|'.'0'.'|'.'0.00');
					// array_push($data['biller'],'STERLING BANK OF ASIA'.'|'.'1090'.'|'.'0'.'|'.'0.00');
					// array_push($data['biller'],'SUN LIFE FINANCIAL PLANS, INC. PRE-NEED'.'|'.'1091'.'|'.'0'.'|'.'0.00');
					// array_push($data['biller'],'SUN LIFE OF CANADA (PHILIPPINES), INC.'.'|'.'1092'.'|'.'0'.'|'.'0.00');
					// array_push($data['biller'],'SUNLIFE GREPA'.'|'.'1093'.'|'.'0'.'|'.'0.00');
				}

				$data['biller_group'] = $biller_group;
				$data['biller_header'] = $biller_header;

				if (isset($_POST['btnSubmit'])){
					$return_data = $this->biller_process($biller_group);
					$data = array_merge($data,$return_data);
				}

				$parameter = array(
					'dev_id'     	   => $this->global_f->dev_id(),
					'actionId' 	 	   => 'ups_billspay_service/bills_payment_transaction_list',
					'regcode'          => $this->user['R'],
					'ip_address'       => $this->ip
				);				
				$result = $this->curl->call($parameter,$url);

				$response = json_decode($result,true);
				$data['BCT_LISTS'] = $response['R'];

				
				
				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('billspayment/biller_main');
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');
			}
			else
			{
				$this->session->sess_destroy();
				redirect('Login/');
			}
		}
		else 
		{
			redirect('Main/');
		}
	}

	/**
	 * Encodes string for use in XML
	 *
	 * @param	string	$biller_group	Input string
	 * @return  array 	$data 			result in _post_biller
	 */
	public function biller_process($biller_group = "")
	{
		$url = url;
		$data = array();

		$biller_code = ($this->input->post('inputBillerCode') != FALSE) ? $this->input->post('inputBillerCode') : ' ';
		$account_no = ($this->input->post('inputAccountNumber') != FALSE) ? $this->input->post('inputAccountNumber') : ' ';
		
		$first_name = ($this->input->post('inputFirstName') != FALSE) ? $this->input->post('inputFirstName') : ' ';
		$middle_name = ($this->input->post('inputMiddleName') != FALSE) ? $this->input->post('inputMiddleName') : ' ';
		$last_name = ($this->input->post('inputLastName') != FALSE) ? $this->input->post('inputLastName') : ' ';

		$address = ($this->input->post('inputAddress') != FALSE) ? $this->input->post('inputAddress') : ' ';

		$amount = ($this->input->post('inputAmount') != FALSE) ? $this->input->post('inputAmount') : ' ';
		$trans_pword = ($this->input->post('inputTpass') != FALSE) ? $this->input->post('inputTpass') : ' ';

		if($this->input->post('inputAccountName') == FALSE)
		{
			$account_name = strtoupper($first_name) . " " . strtoupper($middle_name) . " " . strtoupper($last_name);
		}
		else
		{
			$account_name = $this->input->post('inputAccountName');
		}
		
		$contact_no = ($this->input->post('inputContactNo') != FALSE) ? $this->input->post('inputContactNo') : ' ';
		$email_add = ($this->input->post('inputEmail') != FALSE) ? $this->input->post('inputEmail') : ' ';

		$book_id = ' ';
		$billing_month = ' ';
		$school_year = ($this->input->post('inputSchoolYear') != FALSE) ? $this->input->post('inputSchoolYear') : ' ';
		$sem = ' ';
		$course = ' ';
		$grace_period = ' ';
		$campus = ' ';
		$leave_date = ' ';
		$type = ' ';
		$provider = ' ';

		$reference1 = ($this->input->post('inputReference1') != FALSE) ? $this->input->post('inputReference1') : ' ';
		$reference2 = ($this->input->post('inputReference2') != FALSE) ? $this->input->post('inputReference2') : ' ';
		$reference3 = ($this->input->post('inputReference3') != FALSE) ? $this->input->post('inputReference3') : ' ';

		$date1 = ($this->input->post('inputDate1') != FALSE) ? $this->input->post('inputDate1') : ' ';
		$date2 = ($this->input->post('inputDate2') != FALSE) ? $this->input->post('inputDate2') : ' ';
		$date3 = ($this->input->post('inputDate3') != FALSE) ? $this->input->post('inputDate3') : ' ';

		$selData1 = ($this->input->post('selData1') != FALSE) ? $this->input->post('selData1') : ' ';
		$selData2 = ($this->input->post('selData2') != FALSE) ? $this->input->post('selData2') : ' ';
		$selData3 = ($this->input->post('selData3') != FALSE) ? $this->input->post('selData3') : ' ';

		if($_FILES['inputFile']['size'] > 0){
            $idupload = $this->upload($_FILES['inputFile'], md5($DATETODAY.'ID').'_ID');
        
            if($idupload['S'] == 1){
                $idupload = "/v1-sftp/cagelco/".$idupload['M'];

                $TYPE = 1;

                $params = array(
                    'dev_id'			=> $this->global_f->dev_id(),
                    'actionId'			=> 'ups_billspay_service/cagelco_checkaccount',
                    'regcode'			=> $this->user['R'],
                    'accountname'       => $account_name,
                    'accountno'			=> trim($account_no),
                    'amount'            => $amount,
                    'billmonth'			=> $date1,
                    'mobile'            => $contact_no,
                    'discondate'		=> $date2,
                    'attachment'		=> $idupload,
                    'type'				=> $TYPE,
                    'ip_address'		=> $this->ip,    
                    $this->user['SKT'] 	=> md5($this->user['R'].$this->user['SKT'])
                );

                $apiResult = $this->curl->call($params,$url);
                $data['SOA'] = json_decode($apiResult,true);
                
                if($data['SOA']['S'] == 0){
                    $data['API']['S'] = $data['SOA']['S'];
                    $data['API']['M'] = $data['SOA']['M'];
                    return $data;
                }
            }else{
                $data['API']['S'] = 0;
                $data['API']['M'] = $idupload['M'];
                return $data;
            }
        }

		$input_provider = ($this->input->post('inputProvider') != FALSE) ? $this->input->post('inputProvider') : ' ';
		$payment_date = ($this->input->post('inputPaymentDate') != FALSE) ? $this->input->post('inputPaymentDate') : ' ';

		switch ($biller_code)
		{
			case 805:
			case 807:
			case 808:
			case 809:
			case 814:
			case 828:
			case 835:
			case 837:	$billing_month = $date1;
				break;
			case 749:	$billing_month = $date2;	
						$sem = $payment_date;
				break;				
			case 803:	$book_id = $reference1;
						$billing_month = $date1;
				break;
			case 844:	$billing_month = $date1;
						$sem = $address;
				break;
			case 152:	$book_id = $reference1;
						$billing_month = str_replace('-','',$date1);
				break;
			case 260:	$billing_month = str_replace('-','',$date1);
						$sem = $date2;
				break;
			case 831:	$sem = $selData1;
						$course = $selData2;
						$campus = $reference1;
						$billing_month = $date1;
						$leave_date = $date2;
				break;
			case 819:
			case 820:
			case 833:	$course = $selData1;
						$billing_month = $date1;
						$leave_date = $date2;
				break;
			case 829:	$sem = $selData1;
						$billing_month = $date1;
				break;
			case 157:
			case 677:
			case 839:
			case 849:	$sem = $reference1;
				break;
			case 830:
			case 841:	$sem = $selData1;
				break;
			case 813:	$billing_month = $date1;
						$school_year = $date2;
				break;
			case 604:
			case 846:
			case 848:	$billing_month = $date1;
						$sem = $reference1;
				break;
			case 241:	$billing_month = $date1;
						$sem = $date2;
				break;
			case 817:
			case 847:
			case 850:	$billing_month = $date1;
						$leave_date = $date2;
				break;	
			case 125:
			case 750:	$grace_period = $date1;
				break;
			case 851:	$account_name = trim($last_name).'|'.trim($first_name).'|'.trim($middle_name);
				break;
			case 206:	$grace_period = $date1;
					$billing_month = $date2;
				break;
			case 858:	
				switch ($selData1) 
				{
					case '-853':
						$biller_code = 853;
						$amount = 100;
						break;
					case '-854':
						$biller_code = 854;
						$amount = 200;
						break;
					case '-855':
						$biller_code = 855;
						$amount = 300;
						break;
					case '-856':
						$biller_code = 856;
						$amount = 500;
						break;
					case '-857':
						$biller_code = 857;
						$amount = 1000;
						break;
				}
				break;
			default:
				$sem = $reference1;
				break;
		}
		

		if ($input_provider == 'ECPAY ECBILLS') {
			$parameter = array(
				'dev_id'     	=> $this->global_f->dev_id(),
				'actionId' 	 	=> 'ups_ecash_ecpay/transact_billspay',
				'regcode' 		=> $this->user['R'],
				'ip_address'  	=> $this->ip,
				'transpass' 	=> $trans_pword,
				'biller_id' 	=> $biller_code,
				'service'  	 	=> $reference1,
				'first_field'  	=> trim($account_no),
				'second_field'  => trim($account_name),
				'amount' 		=> $amount,
				$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($trans_pword))
			);
		}else if($input_provider == 'ECPAY ECCASH'){
			$parameter = array(
				'dev_id'     	=> $this->global_f->dev_id(),
				'actionId' 	 	=> 'ups_ecash_ecpay/transact_eccash',
				'regcode' 		=> $this->user['R'],
				'ip_address'  	=> $this->ip,
				'transpass' 	=> $trans_pword,
				'biller_id' 	=> $biller_code,
				'service'  	 	=> $reference1,
				'first_field'  	=> trim($account_no),
				'second_field'  => trim($account_name),
				'amount' 		=> $amount,
				$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($trans_pword))
			); 
		} else {
			$parameter = array(
				'dev_id'     	 => $this->global_f->dev_id(),
				'actionId' 	 	 => _post_biller,
				'regcode' 		 => $this->user['R'],
				'billercode' 	 => $biller_code,
				'accountno'  	 => trim($account_no),
				'subscribername' => trim($account_name),
				'mobileno' 		 => $contact_no,
				'amount' 		 => $amount,
				'transpass' 	 => $trans_pword,
				'bookid' 		 => $book_id,
				'billingmonth'   => $billing_month,
				'schoolyear' 	 => $school_year,
				'sem' 			 => $sem,
				'lname' 		 => trim($last_name),
				'mname' 		 => trim($middle_name),
				'fname' 		 => trim($first_name),
				'course' 		 => $course,
				'yearlevel' 	 => $grace_period,
				'campus' 		 => $campus,
				'idno' 			 => " ",
				'email' 		 => $email_add,
				'leavedate' 	 => $leave_date,
				'returndate' 	 => " ",
				'route1' 		 => " ",
				'flightno1'      => " ",
				'etd1' 			 => " ",
				'route2' 		 => " ",
				'flightno2' 	 => " ",
				'etd2' 			 => " ",
				'ip_address'  	 => $this->ip,    
				'type' 			 => $type,
				'provider' 		 => $provider,
				'covered_from' 	 => " ",
				'covered_to'  	 => " ",
				$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($trans_pword))
			);
		}

		// var_dump($parameter);die;
		
		$result = $this->curl->call($parameter,$url);
		$data['API'] = json_decode($result,true);
		
		//var_dump($data['API']);die;

		if($data['API']['S'] == 1)
		{		
			$this->user['EC'] = $data['API']['EC'];
			$data['user'] = $this->global_f->get_user_session();
			$data['submitBtn'] = 1;
		}
		
		return $data;
	}

	/**
	 * Use to get biller fields
	 *
	 * @param	post	billerId
	 * @return  `gprs_biller_fields`
	 */
	public function get_biller_fields()
	{
		$url = url;
		$biller_id = $this->input->post('biller_id');
		$data['user'] = $this->user;

		$parameter = array(
			'dev_id'     	 	=> $this->global_f->dev_id(),
			'actionId' 	 	 	=> FETCH_BILLER_FIELDS,
			'regcode' 		 	=> $this->user['R'],
			'billerId'  	 	=> $biller_id,
			'ip_address'  	 	=> $this->ip,    
			$this->user['SKT'] 	=>  md5($this->user['R'].$this->user['SKT'])
		);

		$result = $this->curl->call($parameter,url);
		$result = json_decode($result);
		echo json_encode($result);
	}

	/**
	 * Use for validation of biller (BILLERCODE:241)
	 *
	 * @param	post	account_no,amount
	 * @return  redirect VALIDATION (if passed account details)
	 */
	public function batelec_validate()
	{
		$url = url;
		$account_no = $this->input->post('accountno');
		$amount = $this->input->post('amount');
		$data['user'] = $this->user;

		$parameter = array(
			'dev_id'     	 	=> $this->global_f->dev_id(),
			'actionId' 	 	 	=> 'ups_billspay_service/batelec1_validation',//_batelec_checkaccount
			'regcode' 		 	=> $this->user['R'],
			'accountno'  	 	=> trim($account_no),
			'amount'  	 	 	=> $amount,
			'ip_address'  	 	=> $this->ip,    
			$this->user['SKT'] 	=>  md5($this->user['R'].$this->user['SKT'])
		);

		$result = $this->curl->call($parameter,url);
		$result = json_decode($result);
		echo json_encode($result);
	}

	/**
	 * Use for validation of biller (BILLERCODE:260)
	 *
	 * @param	post	account_no
	 * @return  redirect VALIDATION (if passed account details)
	 */
	public function INEC_validate(){
		$url =  url;
		$account_no = $this->input->post('accountno');
		

		$parameter = array(
			'dev_id'     	 	=> $this->global_f->dev_id(),
			'actionId' 	 	 	=> 'ups_billspay_service/inec_validation',//'ups_billspay_service/inec_checkaccount' old end point
			'regcode' 			=> $this->user['R'],
			'accountno'  	 	=> trim($account_no),
			'ip_address'  	 	=> $this->ip,    
			$this->user['SKT'] 	=>  md5($this->user['R'].$this->user['SKT'])
		);

		$result = $this->curl->call($parameter,$url);
		$result = json_decode($result);
		echo json_encode($result);

	}

	/**
	 * Use for validation of biller (BILLERCODE:844)
	 *
	 * @param	post	accountno,amount
	 * @return  redirect VALIDATION (if passed account details)
	 */
	public function gmawd_validate(){
		$url =  url;

		$parameter = array(
			'dev_id'     	 	=> $this->global_f->dev_id(),
			'actionId' 	 	 	=> 'ups_billspay_service/gmawd_validation',
			'regcode' 			=> $this->user['R'],
			'ip_address'  	 	=> $this->ip,
			'accountno'  	 	=> $this->input->post('accountno'),
			'amount'  	 		=> $this->input->post('amount'),    
			$this->user['SKT'] 	=>  md5($this->user['R'].$this->user['SKT'])
		);

		$result = $this->curl->call($parameter,$url);
		$result = json_decode($result);
		echo json_encode($result);
	}


	public function utilities()
	{
		if ($this->user['A_CTRL']['billspayment'] == 1) {
		$data = array('menu' => 4,
					 'parent'=>'' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
					$data['user'] = $this->user;

					$url = url;

					$parameter =array(
								'dev_id'     	   => $this->global_f->dev_id(),
								'actionId' 	 	   => _fetch_biller_info_web,//temp only for web biller list `_fetch_biller_info`
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
	                
	                foreach($data['fetch'] as $billerinfo) {
						array_push($data['biller'],$billerinfo["BD"].'|'.$billerinfo["BC"].'|'.$billerinfo["FT"].'|'.$billerinfo["TF"]);	
					}

				if (isset($_POST['btnSubmit'])){
					$url = url;

					$PROVIDER = ' ';
					$SEM = ' ';
					$SCHOOLYEAR = ' ';
					$TYPE = ' ';

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
						$BILLMONTH = $this->input->post('inputBillingMonth');
					}

					if ($BILLER == 337 || $BILLER == 423 || $BILLER == 358 || $BILLER == 304 || $BILLER == 303 || $BILLER == 393 || $BILLER == 489 || $BILLER == 336 || $BILLER == 369) {

					if($this->input->post('inputAccount') == NULL) {$SEM = " ";} else{ $SEM = $this->input->post('inputAccount');}

					}


					if ( $BILLER == 636 ) {
						if($this->input->post('inputBillingMonth') == NULL) {$BILLMONTH = " ";} else{ $BILLMONTH = $this->input->post('inputBillingMonth');}
						if($this->input->post('inputDueDate') == NULL) {$SEM = " ";} else{ $SEM = $this->input->post('inputDueDate');}
					}

					if ( $BILLER == 260 || $BILLER == 749) {
						if($this->input->post('inputAccountNumber') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputAccountNumber');}
						if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
						if($this->input->post('inputMobile') == NULL) {$MOBILENO = " ";} else{ $MOBILENO = $this->input->post('inputMobile');}
						if($this->input->post('inputAmount') == NULL) {$AMNT = " ";} else{ $AMNT = $this->input->post('inputAmount');}

						if($this->input->post('inputBillingMonth') == NULL) {$BILLMONTH = " ";} else{ $BILLMONTH = $this->input->post('inputBillingMonth');}
					}

					if ( $BILLER == 750) {
						if($this->input->post('inputAccountNumber') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputAccountNumber');}
						if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
						if($this->input->post('inputDueDate') == NULL) {$GRACEPERIOD = " ";} else{ $GRACEPERIOD = $this->input->post('inputDueDate');}
						if($this->input->post('inputAmount') == NULL) {$AMNT = " ";} else{ $AMNT = $this->input->post('inputAmount');}
					}
					if ( $BILLER == 125) {
						if($this->input->post('inputAccountNumber') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputAccountNumber');}
						if($this->input->post('inputGracePeriod') == NULL) {$GRACEPERIOD = " ";} else{ $GRACEPERIOD = $this->input->post('inputGracePeriod');}
						if($this->input->post('inputFName') == NULL) {$fname = " ";} else{ $fname = $this->input->post('inputFName');}
						if($this->input->post('inputMName') == NULL) {$mname = " ";} else{ $mname = $this->input->post('inputMName');}
						if($this->input->post('inputLName') == NULL) {$lname = " ";} else{ $lname = $this->input->post('inputLName');}
						if($this->input->post('inputMobile') == NULL) {$MOBILENO = " ";} else{ $MOBILENO = $this->input->post('inputMobile');}
						if($this->input->post('inputAmount') == NULL) {$AMNT = " ";} else{ $AMNT = $this->input->post('inputAmount');}
						if($this->input->post('inputTpass') == NULL) {$TPASS = " ";} else{ $TPASS = $this->input->post('inputTpass');}
					}
					
					if ($BILLER == 803 || $BILLER == 807 || $BILLER == 814 || $BILLER == 817 || $BILLER == 816 || $BILLER == '819' || $BILLER == '820') {
						if($this->input->post('inputDueDate') == NULL) {$BILLMONTH = " ";} else{ $BILLMONTH = $this->input->post('inputDueDate');}
					}

					if ($BILLER == 813 || $BILLER == 818) {
						if($this->input->post('inputBillingMonth') == NULL) {$BILLMONTH = " ";} else{ $BILLMONTH = $this->input->post('inputBillingMonth');}
						if($this->input->post('inputDueDate') == NULL) {$SCHOOLYEAR = " ";} else{ $SCHOOLYEAR = $this->input->post('inputDueDate');}
					}

					if ($BILLER == 817 || $BILLER == 819 || $BILLER == 820) {
						if($this->input->post('inputDateFT28') == NULL) {$LEAVEDATE = " ";} else{ $LEAVEDATE = $this->input->post('inputDateFT28');}
					}

					if ($BILLER == 818) {
						if($this->input->post('inputType') == NULL) {$COURSE = " ";} else{ $COURSE = $this->input->post('inputType');}
						if($this->input->post('inputType2') == NULL) {$SEM = " ";} else{ $SEM = $this->input->post('inputType2');}
					}

					if ($BILLER == 819 || $BILLER == 820) {
						if($this->input->post('inputType') == NULL) {$COURSE = " ";} else{ $COURSE = $this->input->post('inputType');}
					}				

					$data['submitBtn'] = $this->input->post('btnSubmit');
					// $lname= " ";
					// $fname= " ";
					// $mname= " ";
					if ($BILLER == 152) {
						$BILLMONTH = $this->input->post('inputBillingMonth');
						$BILLMONTH = str_replace('-','',$BILLMONTH);
					}

					// This is test for Sta. Maria Water District
					// $sampleSMWD = array ( 
					// 	'TESTACC' => $ACCTNO,
					// 	'GRACEPERIOD' => $GRACEPERIOD,
					// 	'fname' => $fname,
					// 	'mname' => $mname,
					// 	'lname' => $lname,
					// 	'MOBILENO' => $MOBILENO,
					// 	'TPASS' => $TPASS
					// );
					// print_r($sampleSMWD);
					// die();
					
					$parameter = array(
								'dev_id'     	 => $this->global_f->dev_id(),
								'actionId' 	 	 => _post_biller,
						        'regcode' 		 =>$this->user['R'],
						        'billercode' 	 =>$BILLER,
						        'accountno'  	 =>trim($ACCTNO),
						        'subscribername' =>trim($SUBNAME),
						        'mobileno' 		 =>$MOBILENO,
						        'amount' 		 =>$AMNT,
						        'transpass' 	 =>$TPASS,
						        'bookid' 		 =>$BKID,
						        'billingmonth'   =>$BILLMONTH,
						        'schoolyear' 	 =>$SCHOOLYEAR,
						        'sem' 			 => $SEM,
						        'lname' 		 => trim($lname),
						        'mname' 		 => trim($mname),
						        'fname' 		 => trim($fname),
						        'course' 		 => $COURSE,
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
						        'type' 			 =>$TYPE,
						        'provider' 		 =>$PROVIDER,
						        'covered_from' 	 => " ",
						        'covered_to'  	 => " ",
								$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($TPASS))
								);
						
						// print_r($this->input->post());
						// print_r($parameter);exit();

						//var_dump($parameter);die;
						
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
				$this->load->view('billspayment/utilities'); //
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
					'actionId' 	 	   => _fetch_biller_info_web,//temp only for web biller list `_fetch_biller_info`
					'regcode'          => $this->user['R'],
					'ip_address'       => $this->ip, 
					$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'])
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
				foreach($data['fetch'] as $billerinfo){
					$tmp[] = $billerinfo["BD"]; 					
				}
				array_multisort($tmp, $data['fetch']); 

				foreach($data['fetch'] as $billerinfo) {
					array_push($data['biller'],$billerinfo["BD"].'|'.$billerinfo["BC"].'|'.$billerinfo["FT"].'|'.$billerinfo["TF"]);	
				}
				
				if (isset($_POST['btnSubmit'])){
					$url = url;

					if($this->input->post('inputSubscriberName') == NULL){
						if($this->input->post('inputFName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = strtoupper($this->input->post('inputFName'))." ".strtoupper($this->input->post('inputMName'))." ".strtoupper($this->input->post('inputLName'));}
					}else{
						if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
					}
					
					if($this->input->post('inputFName') == NULL) {$FNAME = " ";} else{ $FNAME = $this->input->post('inputFName');}
					if($this->input->post('inputMName') == NULL) {$MNAME = " ";} else{ $MNAME = $this->input->post('inputMName');}
					if($this->input->post('inputLName') == NULL) {$LNAME= " ";} else{ $LNAME = $this->input->post('inputLName');}
					
					if($this->input->post('inputBiller') == NULL) {$BILLER = " ";} else{ $BILLER = $this->input->post('inputBiller');}
					if($this->input->post('inputAccountNumber') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputAccountNumber');}
					//if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
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
						'accountno'  	 =>trim($ACCTNO),
						'subscribername' =>trim($SUBNAME),
						'mobileno' 		 =>$MOBILENO,
						'amount' 		 =>$AMNT,
						'transpass' 	 =>$TPASS,
						'bookid' 		 => " ",
						'billingmonth'   => " ",
						'schoolyear' 	 => " ",
						'sem' 			 =>$SEM,
						'lname' 		 =>trim($LNAME),
						'mname' 		 =>trim($MNAME),
						'fname' 		 =>trim($FNAME),
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

					//var_dump($parameter);die;
						
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
							'actionId' 	 	   => _fetch_biller_info_web,//temp only for web biller list `_fetch_biller_info`
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
		            foreach($data['fetch'] as $billerinfo){
		                $tmp[] = $billerinfo["BD"]; 
					}
		            array_multisort($tmp, $data['fetch']); 

		            foreach($data['fetch'] as $billerinfo) {
						array_push($data['biller'],$billerinfo["BD"].'|'.$billerinfo["BC"].'|'.$billerinfo["FT"].'|'.$billerinfo["TF"]);	
					}


				if (isset($_POST['btnSubmit'])){
					$url = url;

					if($this->input->post('inputBiller') == NULL) {$BILLER = " ";} else{ $BILLER = $this->input->post('inputBiller');}
					if($this->input->post('inputAccountNumber') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputAccountNumber');}
					if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
					if($this->input->post('inputMobile') == NULL) {$MOBILENO = " ";} else{ $MOBILENO = $this->input->post('inputMobile');}
					if($this->input->post('email') == NULL) {$EMAIL = " ";} else{ $EMAIL = $this->input->post('email');}
					if($this->input->post('inputAmount') == NULL) {$AMNT = " ";} else{ $AMNT = $this->input->post('inputAmount');}
					if($this->input->post('inputTpass') == NULL) {$TPASS = " ";} else{ $TPASS = $this->input->post('inputTpass');}
					if($this->input->post('inputGracePeriod') == NULL) {$GRACEPERIOD = " ";} else{ $GRACEPERIOD = $this->input->post('inputGracePeriod');}
					if($this->input->post('inputBillingMonth') == NULL) {$BILLMONTH = " ";} else{ $BILLMONTH = $this->input->post('inputBillingMonth');}

					if ($BILLER == 805) {
						if($this->input->post('inputDueDate') == NULL) {$BILLMONTH = " ";} else{ $BILLMONTH = $this->input->post('inputDueDate');}						
					}
					$data['submitBtn'] = $this->input->post('btnSubmit');
					
					$parameter = array(
								'dev_id'     	 => $this->global_f->dev_id(),
								'actionId' 	 	 => _post_biller,
						        'regcode' 		 =>$this->user['R'],
						        'billercode' 	 =>$BILLER,
						        'accountno'  	 =>trim($ACCTNO),
						        'subscribername' =>trim($SUBNAME),
						        'mobileno' 		 =>$MOBILENO,
						        'amount' 		 =>$AMNT,
						        'transpass' 	 =>$TPASS,
						        'bookid' 		 => " ",
						        'billingmonth'   =>$BILLMONTH,
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
						        'leavedate' 	 =>$GRACEPERIOD,
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
								//var_dump($parameter);die;
					
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
							'actionId' 	 	   => _fetch_biller_info_web,//temp only for web biller list `_fetch_biller_info`
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
		            foreach($data['fetch'] as $billerinfo){
		                $tmp[] = $billerinfo["BD"]; 
					} 
		            array_multisort($tmp, $data['fetch']); 
		            foreach($data['fetch'] as $billerinfo) {
						array_push($data['biller'],$billerinfo["BD"].'|'.$billerinfo["BC"].'|'.$billerinfo["FT"].'|'.$billerinfo["TF"]);	
					}

				if (isset($_POST['btnSubmit'])){
					$url = url;

					if($this->input->post('inputSubscriberName') == NULL){
						if($this->input->post('inputFirstName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = strtoupper($this->input->post('inputFirstName'))." ".strtoupper($this->input->post('inputMiddleName'))." ".strtoupper($this->input->post('inputLastName'));}
					}else{
						if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
					}
					
					if($this->input->post('inputFirstName') == NULL) {$FNAME = " ";} else{ $FNAME = $this->input->post('inputFirstName');}
					if($this->input->post('inputMiddleName') == NULL) {$MNAME = " ";} else{ $MNAME = $this->input->post('inputMiddleName');}
					if($this->input->post('inputLastName') == NULL) {$LNAME= " ";} else{ $LNAME = $this->input->post('inputLastName');}

					if($this->input->post('inputDueDate') == NULL) {$BILLMONTH = " ";} else{ $BILLMONTH = $this->input->post('inputDueDate');}

					if($this->input->post('inputBiller') == NULL) {$BILLER = " ";} else{ $BILLER = $this->input->post('inputBiller');}
					if($this->input->post('inputAccountNumber') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputAccountNumber');}
					//if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
					if($this->input->post('inputMobile') == NULL) {$MOBILENO = " ";} else{ $MOBILENO = $this->input->post('inputMobile');}
					if($this->input->post('inputAmount') == NULL) {$AMNT = " ";} else{ $AMNT = $this->input->post('inputAmount');}
					if($this->input->post('inputTpass') == NULL) {$TPASS = " ";} else{ $TPASS = $this->input->post('inputTpass');}
					$data['submitBtn'] = $this->input->post('btnSubmit');

					$parameter = array(
								'dev_id'     	 => $this->global_f->dev_id(),
								'actionId' 	 	 => _post_biller,
						        'regcode' 		 =>$this->user['R'],
						        'billercode' 	 =>$BILLER,
						        'accountno'  	 =>trim($ACCTNO),
						        'subscribername' =>trim($SUBNAME),
						        'mobileno' 		 =>$MOBILENO,
						        'amount' 		 =>$AMNT,
						        'transpass' 	 =>$TPASS,
						        'bookid' 		 => " ",
						        'billingmonth'   =>$BILLMONTH,
						        'schoolyear' 	 => " ",
						        'sem' 			 => " ",
						        'lname' 		 =>trim($LNAME),
						        'mname' 		 =>trim($MNAME),
						        'fname' 		 =>trim($FNAME),
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
					//var_dump($parameter);die;
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
							'actionId' 	 	   => _fetch_biller_info_web,//temp only for web biller list `_fetch_biller_info`
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

					if($this->input->post('inputSubscriberName') == NULL){
						if($this->input->post('inputFirstName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = strtoupper($this->input->post('inputFirstName'))." ".strtoupper($this->input->post('inputMiddleName'))." ".strtoupper($this->input->post('inputLastName'));}
					}else{
						if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
					}

					if($this->input->post('inputLastName') == NULL) {$LNAME = " ";} else{ $LNAME = $this->input->post('inputLastName');}
					if($this->input->post('inputFirstName') == NULL) {$FNAME = " ";} else{ $FNAME = $this->input->post('inputFirstName');}
					if($this->input->post('inputMiddleName') == NULL) {$MNAME = " ";} else{ $MNAME = $this->input->post('inputMiddleName');}

					if($this->input->post('inputBiller') == NULL) {$BILLER = " ";} else{ $BILLER = $this->input->post('inputBiller');}
					if($this->input->post('inputAccountNumber') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputAccountNumber');}
					//if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
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
						// if($this->input->post('inputCoveredFrom') == NULL) {$COVERED_FROM = " ";} else{ $COVERED_FROM = $this->input->post('inputCoveredFrom');}
						// if($this->input->post('inputCoveredTo') == NULL) {$COVERED_TO = " ";} else{ $COVERED_TO = $this->input->post('inputCoveredTo');}
						$SUBNAME = $LNAME.",".$FNAME."  ".$MNAME.".";
						$AMNT = 2400;
						$YEARLEVEL = $this->input->post('bdate')."|".$this->input->post('inputFrom')."|".$this->input->post("inputTo"); 

						
					}else if($BILLER == '831'){
						if($this->input->post('selSem') == NULL) {$SEM = " ";} else{ $SEM = $this->input->post('selSem');}
						if($this->input->post('selCourse') == NULL) {$FORMSERIES = " ";} else{ $FORMSERIES = $this->input->post('selCourse');}
						if($this->input->post('inputCampus') == NULL) {$TPBC = " ";} else{ $TPBC = $this->input->post('inputCampus');}
						if($this->input->post('inputDueDate') == NULL) {$LEAVE = " ";} else{ $LEAVE = $this->input->post('inputDueDate');}
						if($this->input->post('inputDateFT28') == NULL) {$RETURNPERIOD = " ";} else{ $RETURNPERIOD = $this->input->post('inputDateFT28');}
					}else if($BILLER == '833'){
						if($this->input->post('selCourse') == NULL) {$FORMSERIES = " ";} else{ $FORMSERIES = $this->input->post('selCourse');}
						if($this->input->post('inputDueDate') == NULL) {$LEAVE = " ";} else{ $LEAVE = $this->input->post('inputDueDate');}
						if($this->input->post('inputDateFT28') == NULL) {$RETURNPERIOD = " ";} else{ $RETURNPERIOD = $this->input->post('inputDateFT28');}
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
						'bookid' 		 =>$BOOKID,
						'billingmonth'   => $RETURNPERIOD,
						'schoolyear' 	 => $TAXTYPE,
						'sem' 			 =>$SEM,
						'lname' 		 =>$LNAME,
						'mname' 		 =>$MNAME,
						'fname' 		 =>$FNAME,
						'course' 		 => $FORMSERIES,
						'yearlevel' 	 => $YEARLEVEL,
						'campus' 		 => $TPBC,
						'idno' 			 => " ",
						'email' 		 => " ",
						'leavedate' 	 =>$LEAVE,
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

					//var_dump($parameter);die;

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
							'actionId' 	 	   => _fetch_biller_info_web,//temp only for web biller list `_fetch_biller_info`
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
		            foreach($data['fetch'] as $billerinfo) {
		                $tmp[] = $billerinfo["BD"]; 
					}
		            array_multisort($tmp, $data['fetch']); 

		            foreach($data['fetch'] as $billerinfo){
						array_push($data['biller'],$billerinfo["BD"].'|'.$billerinfo["BC"].'|'.$billerinfo["FT"].'|'.$billerinfo["TF"]);	
					}

				if (isset($_POST['btnSubmit'])){
					$url = url;

					if($this->input->post('inputBiller') == NULL) {$BILLER = " ";} else{ $BILLER = $this->input->post('inputBiller');}

					if($this->input->post('inputSubscriberName') == NULL){
						if($this->input->post('inputFirstName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = strtoupper($this->input->post('inputFirstName'))." ".strtoupper($this->input->post('inputMiddleName'))." ".strtoupper($this->input->post('inputLastName'));}
					}else{
						if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
					}

					if($this->input->post('inputFirstName') == NULL) {$FNAME = " ";} else{ $FNAME = $this->input->post('inputFirstName');}
					if($this->input->post('inputMiddleName') == NULL) {$MNAME = " ";} else{ $MNAME = $this->input->post('inputMiddleName');}
					if($this->input->post('inputLastName') == NULL) {$LNAME = " ";} else{ $LNAME = $this->input->post('inputLastName');}

					if($this->input->post('inputMobileNumber') == NULL) {$MOBILENO = " ";} else{ $MOBILENO = $this->input->post('inputMobileNumber');}

					if($this->input->post('inputBiller') == NULL) {$BILLER = " ";} else{ $BILLER = $this->input->post('inputBiller');}
					if($this->input->post('inputAccountNumber') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputAccountNumber');}
					//if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
					if($this->input->post('inputAmount') == NULL) {$AMNT = " ";} else{ $AMNT = $this->input->post('inputAmount');}
					if($this->input->post('inputTpass') == NULL) {$TPASS = " ";} else{ $TPASS = $this->input->post('inputTpass');}

					if ($BILLER == 752){
						if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
						if($this->input->post('inputRefNumber') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputRefNumber');}
						if($this->input->post('selectIdType') == NULL) {$IDTYPE = " ";} else{ $IDTYPE = $this->input->post('selectIdType');}
						if($this->input->post('inputValidIdNumber') == NULL) {$VALIDIDNO = " ";} else{ $VALIDIDNO = $this->input->post('inputValidIdNumber');}
						if($this->input->post('inputMobileNumber') == NULL) {$MOBILENO = " ";} else{ $MOBILENO = $this->input->post('inputMobileNumber');}
						if($this->input->post('inputPayorsName') == NULL) {$PAYORSNAME = " ";} else{ $PAYORSNAME = $this->input->post('inputPayorsName');}
						if($this->input->post('inputAmount') == NULL) {$AMNT = " ";} else{ $AMNT = $this->input->post('inputAmount');}
						if($this->input->post('inputTpass') == NULL) {$TPASS = " ";} else{ $TPASS = $this->input->post('inputTpass');}
					} else if ($BILLER == 808){
						if($this->input->post('inputAccountNumber') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputAccountNumber');}
						if($this->input->post('inputDueDate1') == NULL) {$BILLMONTH = " ";} else{ $BILLMONTH = $this->input->post('inputDueDate1');}
						if($this->input->post('inputAmount') == NULL) {$AMNT = " ";} else{ $AMNT = $this->input->post('inputAmount');}
					} else if ($BILLER == 809){
						if($this->input->post('inputAccountNumber') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputAccountNumber');}
						if($this->input->post('inputDueDate1') == NULL) {$BILLMONTH = " ";} else{ $BILLMONTH = $this->input->post('inputDueDate1');}
						if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
						if($this->input->post('inputAmount') == NULL) {$AMNT = " ";} else{ $AMNT = $this->input->post('inputAmount');}
					} else if ($BILLER == 810 || $BILLER == 811){
						if($this->input->post('inputAccountNumber1') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputAccountNumber1');}
						if($this->input->post('inputMobileNumber') == NULL) {$MOBILENO = " ";} else{ $MOBILENO = $this->input->post('inputMobileNumber');}
						if($this->input->post('inputAmount') == NULL) {$AMNT = " ";} else{ $AMNT = $this->input->post('inputAmount');}
						if($this->input->post('inputFirstName') == NULL) {$FNAME = " ";} else{ $FNAME = $this->input->post('inputFirstName');}
						if($this->input->post('inputMiddleName') == NULL) {$MNAME = " ";} else{ $MNAME = $this->input->post('inputMiddleName');}
						if($this->input->post('inputLastName') == NULL) {$LNAME = " ";} else{ $LNAME = $this->input->post('inputLastName');}
					} else if ($BILLER == 812) {
						if($this->input->post('inputAccountNumber') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputAccountNumber');}
						if($this->input->post('inputMobileNumber') == NULL) {$MOBILENO = " ";} else{ $MOBILENO = $this->input->post('inputMobileNumber');}
						if($this->input->post('inputAmount') == NULL) {$AMNT = " ";} else{ $AMNT = $this->input->post('inputAmount');}
						if($this->input->post('inputFirstName') == NULL) {$FNAME = " ";} else{ $FNAME = $this->input->post('inputFirstName');}
						if($this->input->post('inputMiddleName') == NULL) {$MNAME = " ";} else{ $MNAME = $this->input->post('inputMiddleName');}
						if($this->input->post('inputLastName') == NULL) {$LNAME = " ";} else{ $LNAME = $this->input->post('inputLastName');}
					}else if($BILLER == '828'){
						if($this->input->post('inputDueDate') == NULL) {$BILLMONTH = " ";} else{ $BILLMONTH = $this->input->post('inputDueDate');}
					}else if($BILLER == '829'){
						if($this->input->post('inputDueDate') == NULL) {$BILLMONTH = " ";} else{ $BILLMONTH = $this->input->post('inputDueDate');}
						if($this->input->post('selSem') == NULL) {$IDTYPE = " ";} else{ $IDTYPE = $this->input->post('selSem');}
					}
							$data['submitBtn'] = $this->input->post('btnSubmit');

					$parameter = array(
								'dev_id'         => $this->global_f->dev_id(),
								'actionId' 	 	 => _post_biller,
						        'regcode' 		 =>$this->user['R'],
						        'billercode' 	 =>$BILLER,
						        'accountno'  	 =>trim($ACCTNO),
						        'subscribername' =>trim($SUBNAME),
						        'mobileno' 		 =>$MOBILENO,
						        'amount' 		 =>$AMNT,
						        'transpass' 	 =>$TPASS,
						        'bookid' 		 => " ",
						        'billingmonth'   =>$BILLMONTH,
						        'schoolyear' 	 => " ",
						        'sem' 			 =>$IDTYPE,
						        'lname' 		 =>trim($LNAME),
						        'mname' 		 =>trim($MNAME),
						        'fname' 		 =>trim($FNAME),
						        'course' 		 =>$VALIDIDNO,
						        'yearlevel' 	 => " ",
						        'campus' 		 =>$PAYORSNAME,
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

								//var_dump($parameter);die;

								//  print_r($parameter);exit();
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
				$this->check_trans->gwlCheckTransLimit(1); //For Wealthylifestyle

					$data['user'] = $this->user;
					$url = url;

					$parameter =array(
							'dev_id'     	   => $this->global_f->dev_id(),
							'actionId' 	 	   => _fetch_biller_info_web,//temp only for web biller list `_fetch_biller_info`
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
		            					
					foreach($data['fetch'] as $billerinfo){
		                $tmp[] = $billerinfo["BD"]; 
					} 
		            array_multisort($tmp, $data['fetch']); 
		            foreach($data['fetch'] as $billerinfo) {
						array_push($data['biller'],$billerinfo["BD"].'|'.$billerinfo["BC"].'|'.$billerinfo["FT"].'|'.$billerinfo["TF"]);
					}

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

					if($this->input->post('inputSubscriberName') == NULL){
						if($this->input->post('inputFirstName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = strtoupper($this->input->post('inputFirstName'))." ".strtoupper($this->input->post('inputMiddleName'))." ".strtoupper($this->input->post('inputLastName'));}
					}else{
						if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
					}
					
					if($this->input->post('inputBiller') == NULL) {$BILLER = " ";} else{ $BILLER = $this->input->post('inputBiller');}
					if($this->input->post('inputAccountNumber') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputAccountNumber');}
					//if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
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
					if($this->input->post('inputDueDate') == NULL) {$BILLMONTH = " ";} else{ $BILLMONTH = $this->input->post('inputDueDate');}

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
						        'accountno'  	 =>trim($ACCTNO),
						        'subscribername' =>trim($SUBNAME),
						        'mobileno' 		 =>$MOBILENO,
						        'amount' 		 =>$AMNT,
						        'transpass' 	 =>$TPASS,
						        'bookid' 		 => " ",
						        'billingmonth'   =>$BILLMONTH,
						        'schoolyear' 	 =>$SY,
						        'sem' 			 =>$SEM,
						        'lname' 		 =>trim($LNAME),
						        'mname' 		 =>trim($MNAME),
						        'fname' 		 =>trim($FNAME),
						        'course' 		 =>trim($COURSE),
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
					//var_dump($parameter);die;

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
							'actionId' 	 	   => _fetch_biller_info_web,//temp only for web biller list `_fetch_biller_info`
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
		            foreach($data['fetch'] as $billerinfo){
		                $tmp[] = $billerinfo["BD"]; 
					} 
		            array_multisort($tmp, $data['fetch']); 

		            foreach($data['fetch'] as $billerinfo){
						array_push($data['biller'],$billerinfo["BD"].'|'.$billerinfo["BC"].'|'.$billerinfo["FT"].'|'.$billerinfo["TF"]);
					}

				if (isset($_POST['btnSubmit'])){
					$url = url;

					if($this->input->post('inputSubscriberName') == NULL){
						if($this->input->post('inputFName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = strtoupper($this->input->post('inputFName'))." ".strtoupper($this->input->post('inputMName'))." ".strtoupper($this->input->post('inputLName'));}
					}else{
						if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
					}

					if($this->input->post('inputFName') == NULL) {$FNAME = " ";} else{ $FNAME = $this->input->post('inputFName');}
					if($this->input->post('inputMName') == NULL) {$MNAME = " ";} else{ $MNAME = $this->input->post('inputMName');}
					if($this->input->post('inputLName') == NULL) {$LNAME = " ";} else{ $LNAME = $this->input->post('inputLName');}

					if($this->input->post('inputBiller') == NULL) {$BILLER = " ";} else{ $BILLER = $this->input->post('inputBiller'); }
					if($this->input->post('inputAccountNumber') == NULL) {$ACCTNO = " ";} else{ $ACCTNO = $this->input->post('inputAccountNumber');}
					//if($this->input->post('inputSubscriberName') == NULL) {$SUBNAME = " ";} else{ $SUBNAME = $this->input->post('inputSubscriberName');}
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


					//if($this->input->post('inputFName') == NULL) {$FNAME = " ";} else{ $FNAME = strtoupper($this->input->post('inputFName'));}
					//if($this->input->post('inputLName') == NULL) {$LNAME = " ";} else{ $LNAME = strtoupper($this->input->post('inputLName'));}

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
						        'accountno'  	 =>trim($ACCTNO),
						        'subscribername' =>trim($SUBNAME),
						        'mobileno' 		 =>$MOBILENO,
						        'amount' 		 =>$AMNT,
						        'transpass' 	 =>$TPASS,
						        'bookid' 		 => " ",
						        'billingmonth'   => " ",
						        'schoolyear' 	 =>$SY,
						        'sem' 			 =>$SEM,
						        'lname' 		 =>trim($LNAME),
						        'mname' 		 =>trim($MNAME),
						        'fname' 		 =>trim($FNAME),
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

					//var_dump($parameter);die;

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
				$this->check_trans->gwlCheckTransLimit(1); //For Wealthylifestyle

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
						        'accountno'  	 =>trim($ACCTNO),
						        'subscribername' =>trim($SUBNAME),
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
				$this->check_trans->gwlCheckTransLimit(1); //For Wealthylifestyle
				
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
						        'accountno'  	 =>	trim($ACCTNO),
						        'subscribername' =>	trim($SUBNAME),
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
				$this->check_trans->gwlCheckTransLimit(1);
				
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
				$this->check_trans->gwlCheckTransLimit(156); //For Wealthylifestyle
				
				$data['user'] = $this->user;
				$url = url;

				// ADDED 10-28-2019 BY JAMES
				$ACCOUNTTYPE = "DEALER";
				if($this->user['L'] == 7) {
					$ACCOUNTTYPE = "HUB";
				} elseif($this->user['L'] == 16) {
					$ACCOUNTTYPE = "ECASHPAY";
				} else {
					$ACCOUNTTYPE = "DEALER";
				}

				$ratesParameter = array(
								'dev_id'     	 	=> $this->global_f->dev_id(),
								'actionId' 	 	 	=> 'ups_beep_service/get_reload_beep_rates',
								'ip_address'        => $this->ip, 
						        'regcode' 		 	=> $this->user['R'],
								'type'  	 	 	=> $ACCOUNTTYPE,
								$this->user['SKT'] 	=> md5($this->user['R'].$this->user['SKT'])
							);


				

				$rates_result = $this->curl->call($ratesParameter,$url);
						// $arr = array('1234567','ITC0001');
						// if (in_array($this->user['R'], $arr)){
						// 	echo "<pre>";
						//	var_dump($ratesParameter); 
						//	var_dump($rates_result); 
						//	echo "</pre>";
			 			//	die;
						//}
				$data['RESULT'] = json_decode($rates_result,true);
				// ADDED 10-28-2019 BY JAMES

				if (isset($_POST['btnSubmit'])){

					$CARDNO = $this->input->post('inputCardno');
					$CONTACT 	= $this->input->post('inputContactno');
					$AMNT 	= $this->input->post('inputAmount');
					$TPASS 	= $this->input->post('inputTpass');

					$data['submitBtn'] = $this->input->post('btnSubmit');

					$parameter = array(
								'dev_id'     	 	=> $this->global_f->dev_id(),
								'actionId' 	 	 	=> 'ups_beep_service/reload_beep',
								'ip_address'        => $this->ip, 
						        'regcode' 		 	=> $this->user['R'],
								'cardno'  	 	 	=> $CARDNO,
								'mobile'  	 	 	=> $CONTACT,
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

				  		// unset($_POST);

				  		$array_msg = array('S'=>1, 'M'=>$data['API']['M'], 'TN'=>$data['API']['TN'], 'RF'=>$data['API']['RF']);
						$this->session->set_flashdata('msgsuccess',$array_msg);
						redirect($_SERVER['REQUEST_URI']);
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

	public function CheckRefUnified() {
		if ($this->user['A_CTRL']['billspayment'] == 1) {
			
			$data = array('menu' => 4,
						'parent'=>'');

			if ($this->user['S'] == 1 && $this->user['R'] !="") {

				$data['user'] = $this->user;
				$url = url; 
				$REFNO = $this->input->post('refno');
				$REFNO = trim($REFNO);

				$url = "https://api-ups-v3-mla.unified.ph/v1/transactions/top-ups/".$REFNO;
				// $url = "https://test-api.unified.ph/v1/transactions/top-ups/".$REFNO;
				$secretKey = "43f57a0f-a88b-43be-99cd-263bdd0926d9";
				// $secretKey = "0e60d890-7603-4cf2-b87f-6d717ab2afb5";
				
				$payload = json_encode($refno);
				$request_headers = array();
				$request_headers[] = 'x-us-token: '. $secretKey;
				$request_headers[] = 'Content-Type: application/json';
				
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
			//   curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				//   print_r($refno); 
				$datas = curl_exec($ch);
				$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

				if(curl_errno($ch)){
					print "Error: " . curl_error($ch);
				}
				else
				{
					$data["references"] = json_decode($datas, TRUE);
					curl_close($ch);
					print_r(json_encode(array(data=>$data["references"], status=>$httpcode)));
				}
			}
		}
	}

	//added by rene
	public function unified() {
		if ($this->user['A_CTRL']['billspayment'] == 1) {
			$data = array('menu' => 4,
						'parent'=>'');
						
			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$this->check_trans->gwlCheckTransLimit(174); //For Wealthylifestyle

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
				$this->load->view('billspayment/unified'); 
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');
			}else {
			$this->session->sess_destroy();
			redirect('Login/');
			}
		}else {
		redirect('Main/');
		}
	}
	//added by rene
	public function unifiedFundRequestAPI()
        {
                if ($this->user['A_CTRL']['billspayment'] == 1) {

                $data = array('menu' => 4,
                                     'parent'=>'');

                        if ($this->user['S'] == 1 && $this->user['R'] !=""){

                                $data['user'] = $this->user;
                                $url = url;

                                

                                        $AMOUNT = $this->input->post('amount');
                                        // $ORIGINALAMOUNT = $this->input->post('originalamount');
                                        $REFNO = $this->input->post('referencenos');

                                        $urls = "https://api-ups-v3-mla.unified.ph/v1/transactions/top-ups/".$REFNO."/".$this->user['R'];
                                        $secretKey = "43f57a0f-a88b-43be-99cd-263bdd0926d9";
																				
																				// $url = "https://test-api.unified.ph/v1/transactions/top-ups/".$REFNO."/".$this->user['R']; 
																				// $secretKey = "0e60d890-7603-4cf2-b87f-6d717ab2afb5";
                                      // append the header putting the secret key and hash

                                                $refno = array (
                                                                    'objectId' => $REFNO
                                                                  );
                                                        
                                                $payload = json_encode($refno);

                                          $request_headers = array();
                                          $request_headers[] = 'x-us-token: '. $secretKey;
                                          $request_headers[] = 'Content-Type: application/json';
                                      $ch = curl_init();
                                      curl_setopt($ch, CURLOPT_URL, $urls);
									  curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
									  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                                      curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
                                      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                                      $datas = curl_exec($ch);
									  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                                      if(curl_errno($ch)){
                                        print "Error: " . curl_error($ch);
                                      }
                                      else
                                      {

                                      $data["fundrequest"] = json_decode($datas, TRUE);

                                      // echo "<pre>";
                                      // print_r($data["routes"]);
                                      // echo "</pre>"; 
                                      curl_close($ch); 
                                      // echo json_encode($transaction);
                                      echo json_encode(array(data=>$data["fundrequest"], status=>$httpcode)); 
                                      }

                                }
                        }      
		}
//added by rene
	public function unifiedFundRequestAPITest() {
		if ($this->user['A_CTRL']['billspayment'] == 1) {
			$data = array('menu' => 4,
						  'parent'=>'');

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['user'] = $this->user;
				$url = url;
				$AMOUNT = $this->input->post('amount');
				$REFNO = $this->input->post('referencenos');
				$REFNO = trim($REFNO);

				$parameter = array(
					'dev_id'     	 	=> $this->global_f->dev_id(),
					'actionId' 	 	 	=> 'ups_shipping_service/unified_unifiedfundrequesttesting',
					'ip_address'        => $this->ip, 
					'regcode' 		 	=> $this->user['R'],
					'amount'  	 	 	=> $AMOUNT,
					'refno'  	 	 	=> $REFNO,
					$this->user['SKT'] 	=> md5($this->user['R'].$this->user['SKT'].md5($TPASS))
				);

				$result = $this->curl->call($parameter,$url);
				$data['APItopup'] = json_decode($result,true);
				echo json_encode($data['APItopup']);
			}
		}
	}

	//added by rene
	function unifiedDebitandInsert() { 
		$data['user'] = $this->user;
		$url = url; 
		$refno = $this->input->post("refno");
		$amount = $this->input->post("amount");
		$fname = $this->input->post("fname"); 
		$email = $this->input->post("email");
		$status = $this->input->post("status");
		$topUpregcode = $this->input->post("topUpregcode");
		$principalAmount = $this->input->post("principalAmount");
		$serviceFee = $this->input->post("serviceFee");

		$parameter = array(
			'dev_id'       => $this->global_f->dev_id(),
			'actionId'         => 'ups_billspay_service/unifiedDebitandInsert',
			'refno'    =>$refno,
			'amount'    =>$amount,
			'fname'    =>$fname,
			'status'    =>$status,
			// 'email'    =>$email,
			'topUpregcode' => $topUpregcode,
			'principalAmount' => $principalAmount,
			'serviceFee' => $serviceFee,
			'email'		=> $this->user['EA'],
			'company'		=> $this->user['CG'],
			'regcode'          =>$this->user['R'],
			'ip_address'       => $this->ip,    
			$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
		); 

		$result = $this->curl->call($parameter,url);
		$result = json_decode($result,true);

		if($result['S'] == 1){
			$this->user['EC'] = $result['EC'][0]['fund'];
		}
			echo json_encode($result); 
	}

//added by rene
	function transactionpasswordforUnified() {

		$data['user'] = $this->user;
		$url = url; 
		$transpassword = $this->input->post("transpassword");

		$parameter = array(
			'dev_id'       => $this->global_f->dev_id(),
			'actionId'         => 'ups_billspay_service/transactionpasswordforUnified',
			'transpassword'    =>$transpassword,
			'regcode'          =>$this->user['R'],
			'ip_address'       => $this->ip,    
			$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
		);

		$result = $this->curl->call($parameter,url);
		$result = json_decode($result,true);

		if($result['S'] == 1){
			$this->user['EC'] = $result['EC'][0]['fund'];
		} 
		echo json_encode($result); 
	}
	//added by rene
	public function gocabv1() {
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
				$this->load->view('billspayment/gocabv1'); 
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');
			}else {
				$this->session->sess_destroy();
				redirect('Login/');
			}
		}else {
			redirect('Main/');
		}
	}
	//added by rene
	public function CheckRef() {
		if ($this->user['A_CTRL']['billspayment'] == 1) {

			$data = array('menu' => 4,
						'parent'=>'');

			if ($this->user['S'] == 1 && $this->user['R'] !="") {

				$data['user'] = $this->user;
				$url = url;
				$REFNO = $this->input->post('refno');
				$REFNO = trim($REFNO);

				$url = "https://api.gocab.ph/v1/classes/TopUp";
				$secretKey = "e3af844bec24c1ad975700177b47993c";

				$refno = array (
					'where' => 
					array (
					'referenceNumber' => $REFNO,
					),
				);

				$payload = json_encode($refno);
				$request_headers = array();
				$request_headers[] = 'X-Parse-Application-Id: '. $secretKey;
				$request_headers[] = 'Content-Type: application/json';
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
				curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				$datas = curl_exec($ch);

				if(curl_errno($ch)) {
					print "Error: " . curl_error($ch);
				}
				else
				{
					$data["references"] = json_decode($datas, TRUE);
					curl_close($ch);
					echo json_encode($data["references"]);
				} 
			}
		} 
	}
	//added by rene
	public function gocabFundRequestAPI() {
		if ($this->user['A_CTRL']['billspayment'] == 1) {

			$data = array('menu' => 4,
			'parent'=>'');

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;
				$url = url; 
				$AMOUNT = $this->input->post('amount');
				$REFNO = trim($this->input->post('referencenos'));

				$urls = "https://api.gocab.ph/v1/functions/fundRequest";
				$secretKey = "e3af844bec24c1ad975700177b47993c";

				$refno = array (
					'objectId' => $REFNO
				);

				$payload = json_encode($refno);

				$request_headers = array();
				$request_headers[] = 'X-Parse-Application-Id: '. $secretKey;
				$request_headers[] = 'Content-Type: application/json';
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $urls);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				$datas = curl_exec($ch);
				if(curl_errno($ch)){
					print "Error: " . curl_error($ch);
				}
				else
				{
				$data["fundrequest"] = json_decode($datas, TRUE);
				curl_close($ch); 
				echo json_encode($data["fundrequest"]); 
				}
			}
		}
	}
	//for testing
	public function gocabFundRequestAPITest()
	{
		if ($this->user['A_CTRL']['billspayment'] == 1) {

			$data = array('menu' => 4,
			'parent'=>'');

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;
				$url = url;  
				$AMOUNT = $this->input->post('amount');
				$REFNO = $this->input->post('referencenos');
				$REFNO = trim($REFNO);

				$parameter = array(
					'dev_id'     	 	=> $this->global_f->dev_id(),
					'actionId' 	 	 	=> 'ups_shipping_service/gocab_gocabfundrequesttesting',
					'ip_address'        => $this->ip, 
					'regcode' 		 	=> $this->user['R'],
					'amount'  	 	 	=> $AMOUNT,
					'refno'  	 	 	=> $REFNO,
					$this->user['SKT'] 	=> md5($this->user['R'].$this->user['SKT'].md5($TPASS))
				); 
				$result = $this->curl->call($parameter,$url);
				$data['APItopup'] = json_decode($result,true); 
				echo json_encode($data['APItopup']); 
			}
		}
			
	}
	public function CheckRefTest() {
		if ($this->user['A_CTRL']['billspayment'] == 1) {

			$data = array('menu' => 4,
			'parent'=>'');

			if ($this->user['S'] == 1 && $this->user['R'] !="") {

				$data['user'] = $this->user;
				$url = url;  
				$REFNO = $this->input->post('refno');
				$REFNO = trim($REFNO);

				$parameter = array(
				'dev_id'     	 	=> $this->global_f->dev_id(),
				'actionId' 	 	 	=> 'ups_shipping_service/gocab_checkreftesting',
				'ip_address'        => $this->ip, 
				'regcode' 		 	=> $this->user['R'],
				'refno'  	 	 	=> $REFNO,
				$this->user['SKT'] 	=> md5($this->user['R'].$this->user['SKT'].md5($TPASS))
				); 

				$result = $this->curl->call($parameter,$url);
				$data['APIcreate'] = json_decode($result,true); 
				echo json_encode($data['APIcreate']); 
			}
		} 
	}
	// end for testing

	function gocabDebitandInsert() {

		$data['user'] = $this->user;
		$url = url; 
		$fname = $this->input->post("fname");
		$lname = $this->input->post("lname");
		$address = $this->input->post("address");
		$email = $this->input->post("email");
		$mobile = $this->input->post("mobile");
		$refno = $this->input->post("refno");
		$originalamount = $this->input->post("originalamount");
		$amount = $this->input->post("amount");
		
		$parameter = array(
		'dev_id'       => $this->global_f->dev_id(),
			'actionId'         => 'ups_billspay_service/gocabDebitandInsert',
			'fname'    =>$fname,
			'lname'    =>$lname,
			'address'    =>$address,
			// 'email'    =>$email,
			'mobile'    =>$mobile,
			'refno'    =>$refno,
			'amount'    =>$amount,
			'email'		=> $this->user['EA'],
			'company'		=> $this->user['CG'],
			'originalamount'    =>$originalamount,
			'regcode'          =>$this->user['R'],
			'ip_address'       => $this->ip,    
			$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
		); 
	$result = $this->curl->call($parameter,url);
	$result = json_decode($result,true);

	if($result['S'] == 1){
		$this->user['EC'] = $result['EC'][0]['fund'];
	} 
	echo json_encode($result); 
	}
	//added by rene
	function transactionpasswordforGoCab() {

		$data['user'] = $this->user;
		$url = url;

		$transpassword = $this->input->post("transpassword");
		$parameter = array(
			'dev_id'       => $this->global_f->dev_id(),
			'actionId'         => 'ups_billspay_service/transactionpasswordforGoCab',
			'transpassword'    =>$transpassword,
			'regcode'          =>$this->user['R'],
			'ip_address'       => $this->ip,    
			$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
		); 
	
	$result = $this->curl->call($parameter,url);
	$result = json_decode($result,true);

	if($result['S'] == 1){
				$this->user['EC'] = $result['EC'][0]['fund'];
	} 
	echo json_encode($result);  
	} 

	//v1 to v3 topup process
	public function unifiedCheckReferenceNo() {
		$referenceNo = trim($this->input->post('refno'));
		if (substr($this->ip,0,8) == '10.9.10.' or $this->ip == '103.16.170.114') {			
			$parameter = array(
				'dev_id'        => $this->global_f->dev_id(),
				'actionId'      => 'ups_billspay_service/check_v1tov3_refno',
				'regcode'       => $this->user['R'],
				'refno'    		=> $referenceNo,
				'ip_address'	=> $this->ip
			);		
			$result = $this->curl->call($parameter,url);

			$result = json_decode($result,true);
		} else {
			$result = array('S'=>0, 'M'=>'Access denied.');
		}
		
		echo json_encode($result);
	}
	
	public function unifiedDebitReferenceTransaction() {
		$parameter = array(
			'dev_id'        => $this->global_f->dev_id(),
			'actionId'      => 'ups_billspay_service/v1v3_topup',
			'regcode'       => $this->user['R'],
			'refno'    		=> trim($this->input->post('refno')),
			'ip_address'	=> $this->ip,
			'mobile'		=> trim($this->input->post('mobile')),
			'company'		=> UNIFIED,
			'password'		=> trim($this->input->post('pword')),
		);		
		$result = $this->curl->call($parameter,url);
		$result = json_decode($result,true);
		
	
		if ($result['S'] == 1) {
			$resultData = $result['result'];

			if ($resultData['S'] == 1) {
				$parameter = array(
					'dev_id'        => $this->global_f->dev_id(),
					'actionId'      => 'ups_billspay_service/v1_process_v1tov3_refno',
					'regcode'       => $this->user['R'],
					'refno'    		=> trim($this->input->post('refno')),
					'ip_address'	=> $this->ip,
					'trackingno'	=> $resultData['TN'],
				);		
				$result1 = $this->curl->call($parameter,url);
				
				$parameter = array(
					'dev_id'        => $this->global_f->dev_id(),
					'actionId'      => 'ups_billspay_service/v1v3_topup_update',
					'regcode'       => $this->user['R'],
					'refno'    		=> trim($this->input->post('refno')),
					'ip_address'	=> $this->ip,
					'trackingno'	=> $resultData['TN'],
					'success'		=> $resultData['S'],
					'message'		=> $resultData['M'],
				);		
				$result2 = $this->curl->call($parameter,url);

				echo json_encode($result2);
			} else {
				echo json_encode($resultData);
			}
		} else {
			echo json_encode($result);
		}
				
	}
	//v1 to v3 topup process **end

	//GOCAB SHIPPER CASHIN
	public function gocab_shipper_cashin() {
		if ($this->user['A_CTRL']['billspayment'] == 1) {

			$data = array('menu' => 4,
			'parent'=>'');

			if ($this->user['S'] == 1 && $this->user['R'] !="") {

				$data['user'] = $this->user;

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('billspayment/gocabshippercashin'); 
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');
			}else {
				$this->session->sess_destroy();
				redirect('Login/');
			}
		}else {
			redirect('Main/');
		}
	}

	function check_gocab_ref_cashin()
	{
		if ($this->user['A_CTRL']['billspayment'] == 1) {

			$data = array('menu' => 4,
			'parent'=>'');

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$this->check_trans->gwlCheckTransLimit(1); //For Wealthylifestyle

				$data['user'] = $this->user;
				$REFNO = $this->input->post('referenceNo');

				$parameter = array(
					'dev_id'       => $this->global_f->dev_id(),
					'actionId'     => 'ups_gocab/check_ref_cashin',
					'regcode'      => $this->user['R'],
					'ip_address'   => $this->ip,
					'referenceID'  => $REFNO
				); 

				$result = $this->curl->call($parameter, url);
				$result = json_decode($result,true);

				$json_array = array(
					'DATA' => $result['DATA'],
					'MODAL' => $this->load->view('modal/gocab_shipper_modal', $result['DATA'], true)
				);

				echo json_encode($json_array);
			}
		}
	}

	function process_gocab_ref_cashin()
	{
		if ($this->user['A_CTRL']['billspayment'] == 1) {

			$data = array('menu' => 4,
			'parent'=>'');

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;

				$parameter = array(
					'dev_id'       => $this->global_f->dev_id(),
					'actionId'     => 'ups_gocab/process_gocab_cashin',
					'regcode'      => $this->user['R'],
					'referenceID'  => $this->input->post('refno'),
					'accname'  	   => $this->input->post('accname'),
					'mobile'  	   => $this->input->post('mobile'),
					'amount'  	   => $this->input->post('amount'),
					'charge'  	   => $this->input->post('charge'),
					'channelfee'   => $this->input->post('channelfee'),
					'transpass'    => $this->input->post('transpass'),
					'ip_address'   => $this->ip,
					'trackno'      => $this->input->post('transno'),
				); 

				$result = $this->curl->call($parameter, url);
				$result = json_decode($result,true);

				$json_array = array(
					'STATUS' 	 => $result['S'],
					'MESSAGE' 	 => $result['M'],
					'TRACKINGNO' => $result['T']
				);

				echo json_encode($json_array);
			}
		}
	}

	function confirm_gocab_ref_cashin()
	{
		if ($this->user['A_CTRL']['billspayment'] == 1) {

			$data = array('menu' => 4,
			'parent'=>'');

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;
				$REFNO = $this->input->post('referenceNo');
				$TRACKNO = $this->input->post('trackno');

				$parameter = array(
					'dev_id'       => $this->global_f->dev_id(),
					'actionId'     => 'ups_gocab/confirm_ref_cashin',
					'regcode'      => $this->user['R'],
					'ip_address'   => $this->ip,
					'referenceID'  => $REFNO,
					'trackno'  	   => $TRACKNO
				); 

				$result = $this->curl->call($parameter, url);
				$result = json_decode($result,true);

				$json_array = array(
					'STATUS' 	 => $result['S'],
					'MESSAGE' 	 => $result['M'],
					'TRACKINGNO' => $result['T']
				);

				echo json_encode($json_array);
			}
		}
	}
	//GOCAB SHIPPER CASHIN END

	
}


  