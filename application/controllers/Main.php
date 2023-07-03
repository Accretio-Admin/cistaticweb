<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

   	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Curl_model','curl');
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
	    $this->load->model('Query_model','q');
	  	$this->load->model('Global_function','global_f');
	  	$this->load->model('Sp_model'); //update by nhez 03/21/2017
	}

	public function index()
	{

		$data = array('menu' => 1,
					 'parent'=>'' );
         
		if ($this->user['S'] == 1 && $this->user['R'] !="" ){

			$data['user'] = $this->user;
			$testaccount = substr($data['user']['R'],0,2);

			// if($testaccount == 'UF' || $this->user['RET']){
			// 	$data['retailer'] = $this->user['RET'] == 1 ? 1 : 1;

			// }

			if($this->user['R'] == 'AIRLINE001'){
				$data['testaccount'] = 1;
			}

			$data['user'] = $this->user;
		
         
			// echo '<pre>';
			// print_r($data['user']);
			// echo '<pre>';


            if($this->user['R'] == 'HK0002xx' || $this->user['R'] == '12345657xx'){
		    echo '<pre>';
			print_r($data['user']);
			echo '<pre>';
			}
            
            if($this->user['R'] == 'AED0001xx' || $this->user['R'] == '1234567xx'){
			
			print_r($data['user']['A_CTRL']);
			
			}
			//added by son for get address
			// if($this->user['L'] != 7) {
			// 	$params =array(
			// 		'dev_id'     		=> $this->global_f->dev_id(),
			// 		'actionId'         	=> 'ups_report_service/get_AddressData', 
			// 		'ip_address'		=> $this->ip,
			// 		'regcode'           => $this->user['R'],
			// 		$this->user['SKT']  =>  md5($this->user['R'].$this->user['SKT'])
			// 	); 
			// 	$getresult = $this->curl->call($params,url);
			// 	$getresult = json_decode($getresult);
			// 	// var_dump($getresult->COUNTRY);

				
			// 		$this->user['USER_KYC'] = $getresult->KYC->status;
			// 		$this->user['USER_COUNT'] = $getresult->USER_COUNT;
			// 		$this->user['C_FLAG'] = $getresult->C_FLAG;
				

		 //        $newdata = array(
			// 	        'getCountryInfo'  	=> $getresult->COUNTRY,
			// 	        'getProvinceInfo'   => $getresult->PROVINCE,
			// 	        'getCityInfo'  		=> $getresult->CITY
			// 	);

			// 	$this->session->set_userdata($newdata);
			// }
			//added by son for get address

			$parameter =array(
				'dev_id'     		=> $this->global_f->dev_id(),
				'actionId'         	=> _get_MLMShop, 
				'ip_address'		=> $this->ip,
				'regcode'           => $this->user['R'],
				'task'           	=> 'GetWallet',
				$this->user['SKT']  =>  md5($this->user['R'].$this->user['SKT'])
			); 
		    $result = $this->curl->call($parameter,url);
			$result = json_decode($result);
			// print_r($result);
			//echo 'zz'.($result->Data[0]->ECash-$result->Data[0]->MLMECash) ;
			$this->user['EC'] = ($result->Data[0]->ECash-$result->Data[0]->MLMECash);
			$data['user'] = $this->global_f->get_user_session();

			if($data['user']['AD_count'] < 1)
			{
				$this->session->set_userdata('force_update_address', '1');
			}
			else
			{
				$this->session->set_userdata('force_update_address', '0');
			}
			
			$this->session->set_userdata('usersettingid', $data['user']['AQ_usersettings']['0']['id']);
			$this->session->set_userdata('quota_points', $data['user']['quota_points']);
			$this->session->set_userdata('has_package', $data['user']['has_package']['default_package_id']);

			
			
			$this->load->view('main/index',$data);
		}
		
		else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');

		}
	}

 ################################### KYC by Harry Reyes 11/21/2018 ############################################
 
  public function checkKYC(){
	if(!substr($this->user['R'], 0, 3) == 'GWL' || !substr($this->user['R'], 0, 3) == 'DWL'){
    // $url = 'http://10.10.1.201/mobile_api/index.php/kyc/checkKYC';
		$parameter =array(
			'dev_id'     		    => $this->global_f->dev_id(),
			'actionId'         		=> 'ups_kyc_registry/checkKYC', 
			'regcode'		      	=> $this->user['R'],
			'ip_address'		    => $this->ip,
			$this->user['SKT']  	=> md5($this->user['R'].$this->user['SKT'])
			); 

			$result = $this->curl->call($parameter,url);
			$message = json_decode($result);
			echo json_encode($message);
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

		if (false) { //ftp
			$ch = curl_init();
			$localfile = $url;
			$fp = fopen($localfile, 'r');
			curl_setopt($ch, CURLOPT_URL, 'ftp://'.ftp_server_radius.':800/KYC/'.$image_id);
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
		} else { //sftp
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
				CURLOPT_POSTFIELDS => array('file'=> new CURLFILE($localfile),'file_location' => 'kyc','regcode' => $this->user['R'],'email' => '123','ext_name' => '.jpg'),
			));
			
			$response = curl_exec($curl); 
			curl_close($curl);
			$upload_response = json_decode($response,true);

			if ($upload_response['S'] == 1) {
				$result = array("S"=>1,'M'=>$upload_response['F']);
			} else {
				$result = array("S"=>0,'M'=>$upload_response['M']);
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
  
  	public function kyc(){
		$RGC = $this->input->post('inputkycrgc');
		$DATETODAY =  date('d-m-Y-h-m-s');
		$ID = md5($RGC.$DATETODAY.'ID').'_ID';
		$SELFIE = md5($RGC.$DATETODAY.'SELFIE').'_SELFIE';

		$idupload = $this->upload($_FILES['inputkycid'],$ID);
      	if($idupload['S'] == 1){
          	$selfieupload = $this->upload($_FILES['inputkycselfie'],$SELFIE);
          	if($selfieupload['S'] == 1){

				$attachment1 ='ftp://frequest:frequest@'.ftp_server_radius.':800/KYC/'.$idupload['M'];
				$attachment2 = 'ftp://frequest:frequest@'.ftp_server_radius.':800/KYC/'.$selfieupload['M'];

				// $url = 'http://10.10.1.201/mobile_api/index.php/kyc/kyc';
				$parameter =array(
					'dev_id'     		=> $this->global_f->dev_id(),
					'actionId'         	=> '/ups_kyc_registry/kyc', 
					'ip_address'		=> $this->ip,
					'ip'				=> $this->ip,
					'regcode'           => $this->user['R'],
					'idname'           	=> '/v1-sftp/kyc/'.$idupload['M'],
					'selfiename'        => '/v1-sftp/kyc/'.$selfieupload['M'],
					$this->user['SKT']  => md5($this->user['R'].$this->user['SKT'])
				); 
    
				$result = $this->curl->call($parameter,url);
				$message = json_decode($result);
            
			}else{
				$message = array('S'=>0,'M'=>$selfieupload['M']);
			}
		}else{
			$message = array('S'=>0,'M'=>$idupload['M']);
		}

      	echo json_encode($message);
  	}

  ################################### END of KYC ############################################

	function user_insert_address_request(){
		$url = url;

		$parameter =array(
					'dev_id'     		=> $this->global_f->dev_id(),
					'actionId'         	=> 'ups_report_service/userInsertAddress', 
					'ip_address'		=> $this->ip,
					'regcode'           => $this->user['R'],
					'street'			=> $this->input->post('street'),
					'barangay'			=> $this->input->post('barangay'),
					'province'			=> $this->input->post('province'),
					'city'				=> $this->input->post('city'),
					'country'			=> $this->input->post('country'),
					'prstreet'			=> $this->input->post('prstreet'),
					'prbarangay'		=> $this->input->post('prbarangay'),
					'prprovince'		=> $this->input->post('prprovince'),
					'prcity'			=> $this->input->post('prcity'),
					'prcountry'			=> $this->input->post('prcountry'),
					$this->user['SKT']  => md5($this->user['R'].$this->user['SKT'])
				); 

		$result = $this->curl->call($parameter,$url);
		$response= json_decode($result,true);

		// alert($response);
		// console_log($response);
		if($response['S'] == 1) {
			$this->user['USER_COUNT'] = 1;
			$this->user['C_FLAG'] = $this->input->post('country');
			$data['user'] = $this->global_f->get_user_session();

			// $this->load->view('main/index',$data);
		}

		echo json_encode($response);
	}

	//MY PROFILE
	public function myaccount()
	{
		$data = array('menu' => 1,
					 'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;
			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('myaccount/myprofile'); 
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');	
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');

		}
	
	}

	public function change_email_verify(){
		$VCODE = $this->input->post('code');

				$data['user'] = $this->user;

				$parameter =array(
					'dev_id'     		=> $this->global_f->dev_id(),
					'actionId'         	=> _change_email_verify, 
					'ip_address'		=> $this->ip,
					'ip'				=> $this->ip,
    				'regcode'           => $this->user['R'],
    				'code'           	=> $VCODE,
    				$this->user['SKT']  =>  md5($this->user['R'].$this->user['SKT'])
			    	); 

			    $result = $this->curl->call($parameter,url);
			   	$result = json_decode($result);

			   	if ($result->S == 1) {
			   	$this->user['EA'] = $result->EA;
			   	$data['user'] = $this->global_f->get_user_session();
			   	}

			   	echo json_encode($result);
	}


	public function change_email_resend(){

				$data['user'] = $this->user;

				$parameter =array(
					'dev_id'     		=> $this->global_f->dev_id(),
					'actionId'         	=> _change_email_resend, 
					'ip_address'		=> $this->ip,
					'ip'				=> $this->ip,
    				'regcode'           => $this->user['R'],
    				'code'           	=> $VCODE,
    				$this->user['SKT']  =>  md5($this->user['R'].$this->user['SKT'])
			    	); 

			    $result = $this->curl->call($parameter,url);
			   	$result = json_decode($result);
			   	echo json_encode($result);
	}

	public function change_mobile_resend(){

				$data['user'] = $this->user;

				$parameter =array(
					'dev_id'     		=> $this->global_f->dev_id(),
					'actionId'         	=> _change_mobile_resend, 
					'ip_address'		=> $this->ip,
					'ip'				=> $this->ip,
    				'regcode'           => $this->user['R'],
    				'code'           	=> $VCODE,
    				$this->user['SKT']  =>  md5($this->user['R'].$this->user['SKT'])
			    	); 

			    $result = $this->curl->call($parameter,url);
			   	$result = json_decode($result);
			   	echo json_encode($result);
	}



	public function change_mobile_verify(){
		$VCODE = $this->input->post('code');

				$data['user'] = $this->user;

				$parameter =array(
					'dev_id'     		=> $this->global_f->dev_id(),
					'actionId'         	=> _change_mobile_verify, 
					'ip_address'		=> $this->ip,
					'ip'				=> $this->ip,
    				'regcode'           => $this->user['R'],
    				'code'           	=> $VCODE,
    				$this->user['SKT']  =>  md5($this->user['R'].$this->user['SKT'])
			    	); 

			    $result = $this->curl->call($parameter,url);
			   	$result = json_decode($result);

			   	if ($result->S == 1) {
			   	$this->user['MB'] = $result->MB;
			   	$data['user'] = $this->global_f->get_user_session();
			   	}

			   	
			   	echo json_encode($result);
	}


	public function account_setting()
	{
		$data = array('menu' => 1,
					 'parent'=>'' );

		$INPUT_POST=$this->input->post(null,true);
		if ($this->user['S'] == 1 && $this->user['R'] !="")
		{

			if ($this->user['R'] == "NORKIS001" || $this->user['CG'] !="NORKIS"){
				// print_r($INPUT_POST);die;

				$data['user'] = $this->user;
				$data['level'] = $data['user']['L'];

				if (null !== $this->input->post('btn_changeemail')) {
					$url = url;

					$parameter = array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'ip' 		 		=> $this->ip,
						'ip_address' 		=> $this->ip,
						'actionId' 	 		=> _change_email,
						'regcode'    		=> $this->user['R'],
						'cur_email'	 		=> $INPUT_POST['curr_email'],
						'new_email'	 		=> $INPUT_POST['new_email'],
						'new_email_confirm'	=> $INPUT_POST['con_email'],
						'transpass'	 		=> $INPUT_POST['inputTpass'],
						'ip'		 		=> $this->ip,
						$this->user['SKT'] 	=> md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
					);
					$result = $this->curl->call($parameter,$url);
					$data['API'] = json_decode($result,true);

					$data['process'] = array ('type'=>'EMAIL');
				}


				if (null !== $this->input->post('btn_changemobile')) {
					$url = url;

					$parameter = array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'ip' 		 		=> $this->ip,
						'ip_address' 		=> $this->ip,
						'actionId' 	 		=> _change_mobile,
						'regcode'    		=> $this->user['R'],
						'cur_mobile'	 	=> $INPUT_POST['curr_mobile'],
						'new_mobile'	 	=> $INPUT_POST['new_mobile'],
						'new_mobile_confirm'=> $INPUT_POST['con_mobile'],
						'transpass'	 		=> $INPUT_POST['inputTpass'],
						'ip'		 		=> $this->ip,
						$this->user['SKT'] 	=> md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
					);
					$result = $this->curl->call($parameter,$url);
					$data['API'] = json_decode($result,true);

					$data['process'] = array ('type'=>'MOBILE');
				}


				if (null !== $this->input->post('btn_changetranspass')) {
					$url = url;
					$parameter = array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'ip' 		 		=> $this->ip,
						'ip_address' 		=> $this->ip,
						'actionId' 	 		=> _change_trans_password,
						'regcode'    		=> $this->user['R'],
						'cur_pass'	 		=> $INPUT_POST['curr_pass'],
						'new_pass'	 		=> $INPUT_POST['new_pass'],
						'new_pass_confirm'	=> $INPUT_POST['con_pass'],
						'ip'		 		=> $this->ip,
						$this->user['SKT'] 	=> md5($this->user['R'].$INPUT_POST['curr_pass'].$INPUT_POST['con_pass'])
					);
					$result = $this->curl->call($parameter,$url);
					$data['API'] = json_decode($result,true);
				}


				if (null !== $this->input->post('btn_forgottranspas')) {
					$url = url;

					$parameter = array(
						'dev_id'     => $this->global_f->dev_id(),
						'ip' 		 => $this->ip,
						'ip_address' => $this->ip,
						'actionId' 	 => _forgot_trans_password,
						'regcode'    => $this->user['R'],
						'ip'		 => $this->ip,
						$this->user['SKT'] => md5($this->user['R'])
					);
					$result = $this->curl->call($parameter,$url);
					$data['API'] = json_decode($result,true);
				}


				if (null !== $this->input->post('btn_changeloginpass')) {
					$url = url;

					$parameter = array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'ip' 		 		=> $this->ip,
						'ip_address' 		=> $this->ip,
						'actionId' 	 		=> _change_login_password,
						'regcode'    		=> $this->user['R'],
						'cur_pass'	 		=> $INPUT_POST['curr_pass'],
						'new_pass'	 		=> $INPUT_POST['new_pass'],
						'new_pass_confirm'	=> $INPUT_POST['con_pass'],
						'ip'		 		=> $this->ip,
						$this->user['SKT'] 	=> md5($this->user['R'].$INPUT_POST['curr_pass'].$INPUT_POST['con_pass'])
					);

					$result = $this->curl->call($parameter,$url);
					$data['API'] = json_decode($result,true);
					
					// print_r($data['API']);die;
				}

				if (null !== $this->input->post('btn_createsvPass')) {
					$url = url;

					if($INPUT_POST['con_pass'] == $INPUT_POST['new_pass'] || $INPUT_POST['new_pass'] == $INPUT_POST['con_pass']){
						$parameter = array(
							'dev_id'     		=> $this->global_f->dev_id(),
							'regcode'    		=> $this->user['R'],
							'actionId' 	 		=> _create_supervisor_password,
							'supervisorpass'	=> $INPUT_POST['new_pass'],
							'ip_address' 		=> $this->ip,
							$this->user['SKT'] 	=> md5($this->user['R'].$this->user['SKT'])
						);

						$result = $this->curl->call($parameter,$url);
						$data['API'] = json_decode($result,true);
					} else {
						$data['API']['S'] = 0;
						$data['API']['M'] = "PASSWORD DOESN'T MATCH";
					}

				}

				if (null !== $this->input->post('btn_forgotsvpass')) {
					$url = url;
					
					$parameter = array(
						'dev_id'     => $this->global_f->dev_id(),
						'actionId' 	 => _forgot_supervisor_password,
						'regcode'    => $this->user['R'],
						'ip_address' => $this->ip,
						$this->user['SKT'] =>  md5($this->user['R'])
					);
					$result = $this->curl->call($parameter,$url);
					$data['API'] = json_decode($result,true);

					// print_r($data['API']);die;
				}


				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('myaccount/account_setting'); 
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');	

			}else {
				redirect('main/');
			}
			
			
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');

		}
	}
	//MY PROFILE

	public function faq()
	{	
		if ($this->user['S'] == 1 && $this->user['R'] !=""){
		$data['user'] = $this->user;

		$this->load->view('layout/header',$data);
		$this->load->view('element/top_header');
		$this->load->view('element/wrapper_header');
		$this->load->view('element/left_panel');
		$this->load->view('faq/index'); 
		$this->load->view('element/wrapper_footer');
		$this->load->view('layout/footer');

		}else {
			$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}

	}
	//|------------------------------------------------------| Auto Quota |--------------------------------------------|//
		public function AutoQuota(){
			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$param=$this->input->post();
				$param=array_map(function($val){return urldecode($val);},$param);
				if($param){
					unset($parameter);$custom='';
					$parameter['dev_id']=$this->global_f->dev_id();
					$parameter['ip_address']=$this->ip;
					$parameter['regcode']=$this->user['R'];
					$parameter['actionId']=_auto_quota;	
					$parameter[$this->user['SKT']]=md5($this->user['R'].$this->user['SKT']);
					switch($param['Task']){
						case 'Get':
							$parameter['task']=$param['Task'];		
						break;
						case 'Update':
							$parameter['task']=$param['Task'];
							$parameter['value']=$param['auto_quota'];
						break;
					}
					// $custom=var_dump($parameter);
					$result = $this->curl->call($parameter,url);//				var_dump($result);
					$result = json_decode($result);
					array_push($result,$this->user['R']);
					$result = json_encode($result);
					echo $result.$custom;	

					$this->user['auto_quota'] =$param['auto_quota'];
					$data['user'] = $this->global_f->get_user_session();
				}
			}else {
				//$this->session->unset_userdata('user');
				$this->session->sess_destroy();
				redirect('Login/');
			}
		}
        
        
        public function pabloDiamond()
	{	
		if ($this->user['S'] == 1 && $this->user['R'] !=""){
		$data['user'] = $this->user;

		$parameter = array(
      'dev_id'       => $this->global_f->dev_id(),
      'actionId'         => 'ups_login/pabloDiamond',
        'regcode'          =>$this->user['R'],
        'ip_address'       => $this->ip,    
      $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
      );

      $result = $this->curl->call($parameter,url);
      $result = json_decode($result);
      echo json_encode($result);

		}else {
			$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}

	}

	function load_auto_quota_setting()
	{
		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$rank_code['rank_code'] = $this->input->post('rank');

			$parameter = array(
				'dev_id'       => $this->global_f->dev_id(),
				'actionId'         => 'ups_login/auto_quota_settings',
				'regcode'		=>$this->user['R'],
				'ip_address'       => $this->ip
			);
			$result = $this->curl->call($parameter,url);
			$result = json_decode($result,true);
			// echo '<pre>';
			// print_r($result);
			// echo '</pre>';
			$merge = array_merge($result['DATA'], $rank_code);
			$packageid = array();
			

			foreach($merge['packages'] as $row)
			{
				if($row['rank_code'] == $rank_code['rank_code'])
				{
					array_push($packageid,$row['id']);
				}
				
			}
			
			$json_array = array(
				'success' => $result['S'],
				'message' => $result['M'],
				'package_id' => $packageid,
				'address' => $this->load->view('modal/autoquota_address', $merge, true),
				'modal' => $this->load->view('modal/autoquota_modal', $merge, true),
				'packages' => $this->load->view('modal/packages', $merge, true)
			);

			echo json_encode($json_array);
		}else {
			$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('/Login');
		}
	}

	function save_auto_quota_setting()
	{
		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$AQ_usersettings = $this->session->userdata('AQ_usersettings');

			$selected_package 		= $this->input->post('selected_package');
			$selected_claim_option 	= $this->input->post('selected_claim_option');
			$i_contact_name 		= $this->input->post('i_contact_name');
			$i_contact_no 			= $this->input->post('i_contact_no');
			$i_email 				= $this->input->post('i_email');
			$selected_option_val 	= $this->input->post('selected_option_val');

			$parameter = array(
				'dev_id'        		=> $this->global_f->dev_id(),
				'actionId'      		=> 'ups_login/auto_quota_save_settings',
				'selected_package'		=> $selected_package,
				'selected_claim_option'	=> $selected_claim_option,
				'i_contact_name'		=> $i_contact_name,
				'i_contact_no'			=> $i_contact_no,
				'i_email'				=> $i_email,
				'selected_option_val'	=> $selected_option_val,
				'regcode'				=> $this->user['R'],
				'ip_address'    		=> $this->ip
			);

			// echo '<pre>';
			// print_r($parameter);
			// echo '<pre>';

			// die();
			$result = $this->curl->call($parameter,url);
			$result = json_decode($result,true);

			
			
			$json_array = array(
				'success' => $result['S'],
				'message' => $result['M']
			);
			echo json_encode($json_array);
		}else {
			$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('/Login');
		}
	}

	function save_auto_quota_address_setting()
	{
		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$address_id 		= $this->input->post('address_id');
			$usersetting_id 	= $this->input->post('usersetting_id');
			$i_region 			= $this->input->post('i_region');
			$i_province 		= $this->input->post('i_province');
			$i_city 			= $this->input->post('i_city');
			$i_barangay 		= $this->input->post('i_barangay');
			$i_street 			= $this->input->post('i_street');
			$i_unit 			= $this->input->post('i_unit');
			$i_zipcode 			= $this->input->post('i_zipcode');

			$parameter = array(
				'dev_id'        		=> $this->global_f->dev_id(),
				'actionId'      		=> 'ups_login/auto_quota_save_address_settings',
				'address_id'			=> $address_id,
				'usersetting_id'		=> $usersetting_id,
				'i_region'				=> $i_region,
				'i_province'			=> $i_province,
				'i_city'				=> $i_city,
				'i_barangay'			=> $i_barangay,
				'i_street'				=> $i_street,
				'i_unit'				=> $i_unit,
				'i_zipcode'				=> $i_zipcode,
				'regcode'				=> $this->user['R'],
				'ip_address'    		=> $this->ip
			);
			$result = $this->curl->call($parameter,url);
			$result = json_decode($result,true);


		}else {
			$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('/Login');
		}
	}

	function remove_auto_quota_address()
	{
		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			
			$id = $this->input->post('id');

			$parameter = array(
				'dev_id'        		=> $this->global_f->dev_id(),
				'actionId'      		=> 'ups_login/auto_quota_remove_address',
				'address_id'			=> $id,
				'regcode'				=> $this->user['R'],
				'ip_address'    		=> $this->ip
			);
			$result = $this->curl->call($parameter,url);
			$result = json_decode($result,true);

			$json_array = array(
				'address' => $this->load->view('modal/autoquota_address', true)
			);

			echo json_encode($json_array);
		}else {
			$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('/Login');
		}

	}

	function get_auto_quota_address()
	{
		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			
			$id = $this->input->post('id');

			$parameter = array(
				'dev_id'        		=> $this->global_f->dev_id(),
				'actionId'      		=> 'ups_login/auto_quota_get_address',
				'address_id'			=> $id,
				'regcode'				=> $this->user['R'],
				'ip_address'    		=> $this->ip
			);
			$result = $this->curl->call($parameter,url);
			$result = json_decode($result,true);

			// echo '<pre>';
			// print_r($result['DATA']);
			// echo '<pre>';

			// die();

			$json_array = array(
				'data' => $result['DATA']
			);

			echo json_encode($json_array);
		}else {
			$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('/Login');
		}

	}
	//|----------------------------------------------------------------------------------------------------------------|//

	public function WealthyLifestyle ()
	{
		$data = array('menu' => 1,
					 'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !="") {
			if ($user['R'] != "F5033230" || $user['R'] != "1234567") {
				$data['user'] = $this->user;
				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('wealthy/index'); 
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');	
			} else {
				redirect('main/index');
			}
		} else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');

		}
	}

	public function getRanking ()
	{
		$url = url;

		$parameter = array(
			'dev_id'        		=> $this->global_f->dev_id(),
			'actionId'      		=> 'ups_gwl_api/get_rank_details',
			'regcode'				=> $this->user['R'],
			'ip_address'    		=> $this->ip
		);
		$result = $this->curl->call($parameter, $url);
		$result = json_decode($result, true);

		echo json_encode($result);
	}


	function marketplace_session()
	{
		// MarketPlace Session ========================================
		$parameter2 =array(
			'dev_id'     		=> $this->global_f->dev_id(),
			'actionId'         	=> 'ups_marketplace/get_token', 
			'ip_address'		=> $this->ip,
			'regcode'           => $this->user['R']
		);

		$result2 = $this->curl->call($parameter2,url);
		$result2 = json_decode($result2);

		$token = $result2->Token;

		$url = 'https://marketplace2.unified.ph/getsessionid';

		$parameter3 =array(
			'token' => $token
		);

		$result3 = $this->curl->call($parameter3,$url);
		$result3 = json_decode($result3);

		// $this->session->set_userdata('sessionid', $result3->result);

		redirect('https://marketplace.unified.ph/login/'.$result3->result);
	}
}