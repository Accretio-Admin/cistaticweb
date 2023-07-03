<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Onlineshop extends CI_Controller {

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
       // $this->ip = '103.16.170.114';
       
	    $this->load->model('Query_model','q');
	  	$this->load->model('Report_model','r');
	  	$this->load->model('Global_function','global_f');
		$this->load->model('Encryption_model');
	  	$this->load->model('Sp_model');
//update by nhez 03/21/2017
	  	// $ACC_CONTROL = $this->Sp_model->userprivilege(); 
	   // 	$this->user['A_CTRL'] = $ACC_CONTROL['A_CTRL'];
	   // 	$this->session->set_userdata('user',$this->user);

	  	//if ($this->user['RET'] == 1) {
	    	//redirect('Main/');
	   // }
	   	if($this->user['USER_KYC'] != 'APPROVED') {
			redirect('Main');
		}
	}

	public function index()
	{
		if ($this->user['A_CTRL']['online_shop'] == 1){
			$data = array('menu' => 11,
						 'parent'=>'' );
			
			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['user'] = $this->user;

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('onlineshopping/index'); 
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

	public function buycodes()
	{
		if ($this->user['A_CTRL']['online_shop'] == 1){
			$data = array('menu' => 15,
						 'parent'=>'' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['user'] = $this->user;	
				$testaccount = substr($data['user']['R'],0,2);

				if($testaccount == 'UF'){
					$data['retailer'] = 1;
				}

					// $binfo_parameter = array(
					// 	 'dev_id'     		=>$this->global_f->dev_id(),
					// 	 'ip_address' 		=>$this->ip,
					// 	 'ip' 				=>$this->ip,
					// 	 'actionId' 	 	=> _buycodes_gettransactions,
					// 	 'regcode'          =>$this->user['R'],
					// 	  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
					// 		);

					// $b_api_result = $this->curl->call($binfo_parameter,url);
					// // echo json_encode($b_api_result);die();
				    // $B_API = json_decode($b_api_result,true);

				    // if($B_API['S'] == 1){
				    // 	$data['binfo_set'] = true;

				    // 	$data['transdata'] = $B_API['T_DATA'];
				    // }else{
				    // 	$data['binfo_set'] = false;
				    // }

				if($this->input->post('package_select')){
					$urldata = json_decode(urldecode($this->input->post('package_select')));
					$data['location'] = $urldata[0];
					$data['package_value'] = $urldata[1];

					$binfo_parameter = array(
						'dev_id'     		=>$this->global_f->dev_id(),
						'ip_address' 		=>$this->ip,
						'ip' 				=>$this->ip,
						'actionId' 	 		=> _buycodes_gettransactions,
						'regcode'          	=>$this->user['R'],
						'packagetype'		=>$data['package_value']->Package_ID,
						 $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
						   );

					$b_api_result = $this->curl->call($binfo_parameter,url);
					$B_API = json_decode($b_api_result,true);

					if($B_API['S'] == 1){
						$data['binfo_set'] = true;

						$data['transdata'] = $B_API['T_DATA'];
					}else{
						$data['binfo_set'] = false;
					}

					$data['hid_package_info'] = json_encode(json_decode(json_encode($data['package_value']), true));
					$data['items']['P_DATA'][1]['pdesc'] = "<p><center><b>Global Dealer Package</b></center><br />
																- Webtool account (for internet loading and inventory system) <br />
                                                                - Local and International Remittance <br />
                                                                - Bills Payment Facility <br />
                                                                - Domestic and International Online Ticketing <br />
                                                                - Insurance <br />
                                                                     &nbsp &nbsp * One year coverage <br />
                                                                     &nbsp &nbsp * Accidental death, dismemberment &/or disablement for Php60k <br />
                                                                     &nbsp &nbsp * Burial assistance (following accidental death) Php6k <br />
                                                                - Online Shopping (included but to follow) <br />
                                                                - Hotel And Resorts Booking (included but to follow) <br />
                                                                - Tarpaulin (1) <br />
                                                                - Flyers (10pcs)</p>";
                    $data['items']['P_DATA'][2]['pdesc'] = "<p><center><b>Pinoy Dealer Package</b></center><br />
																- Loading <br />
                                                                - Bills Payment (Maximum of 10 Transactions per day) <br/>
                                                                - E-Cash (Local and International) <br/>
                                                                - Hotel Accommodation (Included but to follow) <br/>
                                                                - Insurance <br/>
                                                                          &nbsp &nbsp * One year coverage <br/>
                                                                          &nbsp &nbsp * Accidental Death, Dismemberment &/or Disablement for Php 60k <br/>
                                                                          &nbsp &nbsp * Burial Assistance (following accidental death) Php 6k <br/>
                                                                - 5 pcs. Three-fold Leaflets ( UPS Brochure) <br/>
                                                                - Tarpaulin (1)</p>	<br /><br /><br /><br />";

					$data['items']['P_DATA'][6]['pdesc'] = "<p><center><b>Ricemart Package</b></center><br />
															-	Webtool account (For internet loading and inventory system)<br/>
															-	Local and International Remittance<br/>
															-	Bills Payment Facility<br/>
															-	Insurance<br/>
																<span style='padding-left: 20px'>*One-year coverage<span><br/>
																<span style='padding-left: 20px'>*Accidental death, dismemberment &/or disablement for Php60k</span><br/>
																<span style='padding-left: 20px'>*Burial Assistance (following accidental death) Php6k</span><br/>
															-	 Online Shopping<br/>
															-	Hotel and Resorts Booking<br/>
															-	3 sacks of rice<br/>
															-	Wellness products worth Php10,000<br/>
															-	Ricemart Tarpaulin<br/>
															-	Rice Scooper<br/><br/>
															<b>Note:</b> <br/>
															(1)	Rice variants may vary, depending on supply/availability<br/>
														</p><br />";
					$data['items']['P_DATA'][9]['pdesc'] = "<p><center><b>Wealthy Lifestyle</b></center></p>
															<p><center>ALL 4 SETS INCLUDES THE FOLLOWING:</center></p>
															<p>-	Airline Ticketing(Local/International)<br/>
															-	Universal Loading(All Network)<br/>
															-	Personal Accident Insurance<br/>
															-   Wealthy Lifestyle System<br/>
															-   DTC (Distributor Tracking Center)<br/>
															-   Wealthy Lifestyle Business Kit<span style='font-size: 10px'> (Eco Bag,Application Form, Flyers)</span><br/>
															-   MLM Online Shop and Marketplace<br/>
															-   Free Trainings<br/><br/>
															<center>WAYS TO EARN:</center></p>
															<p>-   Direct Referral Bonus (P500cash+)<br/>
															-   Sales Matched Bonus P1,500 (60Pairs A Day)<br/>
															-   Residual Income (2ND to 10TH Level)
															</p><br />";
					$data['items']['P_DATA'][10]['pdesc'] = "<p><center><b>Unified Insurance Package</b></center><br />
															-	44 Personal Insurance Insurance Policies<br/>
															-	Unified System
															</p><br />";
					$data['items']['P_DATA'][11]['pdesc'] = "<p><center><b>Unified Wearable Package</b></center><br />
															-	5 Unified Bracelets<br/>
															-	Unified System
															</p><br />";
					$this->load->view('onlineshopping/select_package_index',$data);

				}elseif($this->input->post('inputPackageType') == null){

					$PARAMS =array(
						'dev_id'     => $this->global_f->dev_id(),
						'regcode'    => $this->user['R'],
						$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT']),
						'actionId'   => _fetch_buycodes_rate,
						'ip_address' => $this->ip
			    	);

			    	$result = $this->curl->call($PARAMS,url);
				   	$API = json_decode($result,true);
				   	$data['items'] = $API;
														
				   $this->load->view('onlineshopping/pageindex',$data);

				}

				if (isset($_POST['btnsubmit'])) {

					if($_POST['selpaymenttype'] == 1){
							//var_dump('ecash');
							$formdata = json_encode($this->input->post());

							$packagetype = $this->input->post();
							if($packagetype['inputPackageType'] == 7 || $packagetype['inputPackageType'] == 8 || $packagetype['inputPackageType'] == 9 ){
								echo "<form action='/Onlineshop/ecashpaymentpackage' method='post' name='frm'>";
								echo "<input type='hidden' name='ecashpaymentdata' value='".$formdata."'>";
								echo "<input type='hidden' name='paymentform' value='ECASH'>";
								echo "</form>";
								echo "<script type='text/javascript'>";
								echo "document.frm.submit();";
								echo "</script>";
							}else{
								echo "<form action='/Onlineshop/ecashpayment' method='post' name='frm'>";
								echo "<input type='hidden' name='ecashpaymentdata' value='".$formdata."'>";
								echo "<input type='hidden' name='paymentform' value='ECASH'>";
								echo "</form>";
								echo "<script type='text/javascript'>";
								echo "document.frm.submit();";
								echo "</script>";
							}

					} else{
							//var_dump('creditcard');
		  					$INPUT_POST = $this->input->post(null,true);
						 	$data['package_info'] = $INPUT_POST;
						 	$data['package_value'] = json_decode($INPUT_POST['inputPackageInfo']);
							$data['location'] = $INPUT_POST['inputCountry'];
							$data['hid_package_info'] = json_encode(json_decode(json_encode($data['package_value']), true));
				
							$parameter = array(
					                 'dev_id'         =>$this->global_f->dev_id(),
					                 'ip_address'     =>$this->ip,
					                 'ip'         	  =>$this->ip,
					                 'actionId'       => _buycodes_check_user_agreement,
					                 'regcode'        =>$this->user['R'],
					                  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
					                  );
					        $result = $this->curl->call($parameter,url);
					        $check_agreement = json_decode($result,true);

					        if($check_agreement['S'] == 2){
					        	$data['process'] = 999;
					        	$data['content'] = $check_agreement['Content'];
					        	$this->load->view('onlineshopping/select_package_index',$data);   
					        }else{
					        	//var_dump('directbdocreditcard');
								echo "<form action='/Onlineshop/creditcardpayment' method='post' name='frm'>";
								echo "<textarea name='creditcardpaymentdata' id='creditcardpaymentdata' style='display:none;'>".json_encode($data['package_info'])."</textarea>";
								echo "<textarea name='inputPackageValue' id='inputPackageValue' style='display:none;'>".json_encode($data['package_value'])."</textarea>";
								echo "<input type='hidden' name='paymentform' value='BDOCREDITCARD' />";
								echo "</form>";
								echo "<script type='text/javascript'>";
						    	echo "document.frm.submit();";
								echo "</script>";
								$this->load->view('onlineshopping/select_package_index',$data); 
					        }

					}

				}

		
			}else {
				$this->session->sess_destroy();
				redirect('Login/');
			}

		}else {
			//$this->session->unset_userdata('user');
			//$this->session->sess_destroy();
			redirect('Main/');
		}
		
	}
	public function ecashpaymentpackage(){
		$data = array('menu' => 15,
					 'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){

		$data['user'] = $this->user;	
	  	$INPUT_POST = $this->input->post(null,true);
	  	$data['package_info'] = json_decode($INPUT_POST['ecashpaymentdata'],true);
	  	$data['package_value'] = json_decode($data['package_info']['inputPackageInfo']);
		$data['location'] = $data['package_info']['inputCountry'];
		$data['hid_package_info'] = json_encode(json_decode(json_encode($data['package_value']), true));
				$binfo_parameter = array(
					 'dev_id'     		=>$this->global_f->dev_id(),
					 'ip_address' 		=>$this->ip,
					 'ip' 				=>$this->ip,
					 'actionId' 	 	=> _buycodes_gettransactions,
					 'regcode'          =>$this->user['R'],
					 'packagetype'		=>$data['package_info']['inputPackageType'],
					  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
						);

				$b_api_result = $this->curl->call($binfo_parameter,url);
				// echo json_encode($b_api_result);die();
			    $B_API = json_decode($b_api_result,true);

			    if($B_API['S'] == 1){
			    	$data['binfo_set'] = true;

			    	$data['transdata'] = $B_API['T_DATA'];
			    }else{
			    	$data['binfo_set'] = false;
			    }

			if($INPUT_POST['paymentform'] == 'ECASH'){
				$parameter = array(
			    				 'dev_id'     		=>$this->global_f->dev_id(),
			    				 'ip_address' 		=>$this->ip,
			    				 'ip' 				=>$this->ip,
			    				 'actionId' 	 	=> _confirm_buycodes,
			    				 'regcode'          =>$this->user['R'],
			    				 'client_country'   =>$data['package_info']['inputCountry'],
			    				 'client_name'		=>$data['package_info']['inputClient'],
			    				 'client_email'		=>$data['package_info']['inputClientemail'],
			    				 'client_mobile'	=>$data['package_info']['inputMobno'],
			    				 'package_type'		=>$data['package_info']['inputPackageType'],
			    				 'transpass'		=>$data['package_info']['inputTpass'],
								 'package'          =>$data['package_info']['packaged'],
			    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
									);
				$result = $this->curl->call($parameter,url);
			    $API = json_decode($result,true);

					if ($API['S'] == 1) {

						$data['result'] = array(	
						  	'S' => 1,
						  	'M' =>$API['M']
						);
					}else {

						$data['result'] = array(	
						  	'S' => 0,
						  	'M' =>$API['M']
						);
						
					}

			}else{
					$data['result'] = array(	
					  	'S' => 0,
					  	'M' =>'Invalid Payment Method'
					);

			}
	
			$this->load->view('onlineshopping/select_package_index',$data);	

		}else {
			$this->session->sess_destroy();
			redirect('Login/');
		}	
	}
	public function ecashpayment(){

		$data = array('menu' => 15,
					 'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){

		$data['user'] = $this->user;	
	  	$INPUT_POST = $this->input->post(null,true);
	  	$data['package_info'] = json_decode($INPUT_POST['ecashpaymentdata'],true);
	  	$data['package_value'] = json_decode($data['package_info']['inputPackageInfo']);
		$data['location'] = $data['package_info']['inputCountry'];
		$data['hid_package_info'] = json_encode(json_decode(json_encode($data['package_value']), true));

				$binfo_parameter = array(
					 'dev_id'     		=>$this->global_f->dev_id(),
					 'ip_address' 		=>$this->ip,
					 'ip' 				=>$this->ip,
					 'actionId' 	 	=> _buycodes_gettransactions,
					 'regcode'          =>$this->user['R'],
					  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
						);

				$b_api_result = $this->curl->call($binfo_parameter,url);
				// echo json_encode($b_api_result);die();
			    $B_API = json_decode($b_api_result,true);

			    if($B_API['S'] == 1){
			    	$data['binfo_set'] = true;

			    	$data['transdata'] = $B_API['T_DATA'];
			    }else{
			    	$data['binfo_set'] = false;
			    }

			if($INPUT_POST['paymentform'] == 'ECASH'){

				$parameter = array(
			    				 'dev_id'     		=>$this->global_f->dev_id(),
			    				 'ip_address' 		=>$this->ip,
			    				 'ip' 				=>$this->ip,
			    				 'actionId' 	 	=> _confirm_buycodes,
			    				 'regcode'          =>$this->user['R'],
			    				 'client_country'   =>$data['package_info']['inputCountry'],
			    				 'client_name'		=>$data['package_info']['inputClient'],
			    				 'client_email'		=>$data['package_info']['inputClientemail'],
			    				 'client_mobile'	=>$data['package_info']['inputMobno'],
			    				 'package_type'		=>$data['package_info']['inputPackageType'],
			    				 'transpass'		=>$data['package_info']['inputTpass'],
								 'discounts'        =>$data['package_info']['discounts'],
			    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
									);
				$result = $this->curl->call($parameter,url);
			    $API = json_decode($result,true);

					if ($API['S'] == 1) {

						$data['result'] = array(	
						  	'S' => 1,
						  	'M' =>$API['M']
						);
					}else {

						$data['result'] = array(	
						  	'S' => 0,
						  	'M' =>$API['M']
						);
						
					}

			}else{
					$data['result'] = array(	
					  	'S' => 0,
					  	'M' =>'Invalid Payment Method'
					);

			}
	
			$this->load->view('onlineshopping/select_package_index',$data);	

		}else {
			$this->session->sess_destroy();
			redirect('Login/');
		}	

	} 

	public function terms_redir(){
		$content_data = $this->input->get('d');	

		echo "<form action='/Onlineshop/termsncondition' method='post' name='frm'>";
		echo "<input type='hidden' name='content' value='".$content_data."'>";
		echo "</form>";
		echo "<script type='text/javascript'>";
    	echo "document.frm.submit();";
		echo "</script>";
	}

	public function termsncondition(){
	  	$content = $this->input->post('content');

		  	if($content){
		  		echo urldecode($content);
		  		?>
					<form action="<?php echo BASE_URL()?>Onlineshop/confirmAgreement" method="post" id="frmAgreeTermsnCondition">
						</br>
						<center><button type="submit" class="btn btn-warning btn-lg" name="btnAgree" id="btnAgree" style="width: 150px;">I Agree</button></center>
					</form>
					<script>
					function closeIframeBuycodes() {
					var iframe = document.getElementById('modalBuycodesAgreementframe');
					iframe.parentNode.removeChild(iframe);
					}
					</script>
		    	<?php
		  	}else{
		  		redirect('ErrorPage/');
		  	}
	}


	public function confirmAgreement() {

		$INPUT_POST = $this->input->post(null,true);
		$confirm_data = $INPUT_POST['btnAgree'];
		//var_dump($INPUT_POST);

		if(isset($confirm_data)){

		        $parameter = array(
		                 'dev_id'         =>$this->global_f->dev_id(),
		                 'ip_address'     =>$this->ip,
		                 'ip'         	  =>$this->ip,
		                 'actionId'       => _buycodes_agree_user_agreement,
		                 'regcode'        =>$this->user['R'],
		                  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
		                  );
		        $result = $this->curl->call($parameter,url);
		        $API = json_decode($result,true);

				if($API['S'] == 1){
					$message = array('S' => 1, 'M' => $API['M']);
					echo "<script type='text/javascript'>";
			    	echo 'parent.closeIframeBuycodes()';
					echo "</script>";
				}
				else{
					$message = array('S' => 0, 'M' => $API['M']);
				}

				$this->load->view('onlineshopping/select_package_index',$data);	
		}else{
			redirect('ErrorPage/');
		}
	}


	public function creditcardpayment(){

		$data = array('menu' => 15,
					 'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){

		$data['user'] = $this->user;	
		$INPUT_POST = $this->input->post(null,true);
		$paymentform = $INPUT_POST['paymentform'];
		$data['package_info'] = json_decode(json_encode(json_decode($INPUT_POST['creditcardpaymentdata'])), true);
		$data['package_value2'] = json_decode(json_encode(json_decode($INPUT_POST['inputPackageValue'])), true);
		$data['package_value'] = json_decode($INPUT_POST['inputPackageValue']);
		$data['location'] = $data['package_info']['inputCountry'];
		$data['hid_package_info'] = json_encode($data['package_value2'],true);

				$binfo_parameter = array(
					 'dev_id'     		=>$this->global_f->dev_id(),
					 'ip_address' 		=>$this->ip,
					 'ip' 				=>$this->ip,
					 'actionId' 	 	=> _buycodes_gettransactions,
					 'regcode'          =>$this->user['R'],
					  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
						);

				$b_api_result = $this->curl->call($binfo_parameter,url);
				// echo json_encode($b_api_result);die();
			    $B_API = json_decode($b_api_result,true);

			    if($B_API['S'] == 1){
			    	$data['binfo_set'] = true;

			    	$data['transdata'] = $B_API['T_DATA'];
			    }else{
			    	$data['binfo_set'] = false;
			    }


		if($paymentform == 'BDOCREDITCARD') {

			$data['process'] = 1;

			$vpcURL = 'https://migs.mastercard.com.au/vpcpay';
			$SECURE_SECRET = "4E668324C795C99B6D2BBA57E4DDA215";

			require APPPATH.'/libraries/vpclib/VPCPaymentConnection.php';
			$conn = new VPCPaymentConnection();
			$conn->setSecureSecret($SECURE_SECRET);

			$service_charge = ($data['package_value2']['NetPrice'] * 0.055);

			$ADDITIONAL_CHARGE = $data['package_value2']['NetPrice'] + $service_charge;

			$ADDITIONAL_CHARGE = round($ADDITIONAL_CHARGE,2);
			$AMOUNT_MODIFY = explode('.', $ADDITIONAL_CHARGE);

			if(strlen($AMOUNT_MODIFY[1]) == 1){
				$AMOUNT_MODIFY[1] = $AMOUNT_MODIFY[1].'0';
			}
			//$AMOUNT_MODIFY[0] = 1;

			$RAW_DATA = 'loc='.$data['location'].'&id='.$data['package_value2']['Package_ID'].'&name='.$data['package_info']['inputClient'].'&email='.$data['package_info']['inputClientemail'].'&mobile='.$data['package_info']['inputMobno'].'&charge='.$service_charge;	
			$RAW_DATA = urlencode($this->Encryption_model->encrypt_value($RAW_DATA));

				$parameter = array(
		    				 'dev_id'     		=>$this->global_f->dev_id(),
		    				 'ip_address' 		=>$this->ip,
		    				 'ip' 				=>$this->ip,
		    				 'actionId' 	 	=> _generate_tracking_buycodes,
		    				 'regcode'          =>$this->user['R'],
		    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
								);
				
				$api_result = $this->curl->call($parameter,url);
			    $API = json_decode($api_result,true);

				if ($API['S'] == 1) {
					$TRACKNO = $API['TN'];
				}else{
					$TRACKNO = '';
				}
				base_url().'Onlineshop/payment_landing?data='.$RAW_DATA.'<br>';
				strlen(base_url().'Onlineshop/payment_landing?data='.$RAW_DATA); //die();
					$BDO_PARAMS = array(
							'vpc_AccessCode' => '04C8BEAF',
							'vpc_Amount' => round($AMOUNT_MODIFY[0]).($AMOUNT_MODIFY[1] ? sprintf('%02s', $AMOUNT_MODIFY[1]) : '00'), //round($AMOUNT_MODIFY[0]).($AMOUNT_MODIFY[1] ? '00.'.$AMOUNT_MODIFY[1] : '00')
							'vpc_Command' => 'pay',
							'vpc_Locale' => 'en',
							'vpc_MerchTxnRef' => $TRACKNO,
							'vpc_Merchant' => 'BD9180551889',
							'vpc_OrderInfo' => $TRACKNO,
							'vpc_ReturnURL' => base_url().'Onlineshop/payment_landing?data='.$RAW_DATA,
							'vpc_Version' => '1'
						);

					ksort($BDO_PARAMS);

					foreach($BDO_PARAMS as $key => $value) {
					if (strlen($value) > 0) {
						$conn->addDigitalOrderField($key, $value);
					}
				}

				$secureHash = $conn->hashAllFields();
				$conn->addDigitalOrderField("vpc_SecureHash", $secureHash);
				$conn->addDigitalOrderField("vpc_SecureHashType", "SHA256");

				$vpcURL = $conn->getDigitalOrder($vpcURL);
				$data['bdoURL'] = $vpcURL;

		}else{
				$data['result'] = array(	
				  	'S' => 0,
				  	'M' =>'Invalid Payment Method'
				);

		}
				$this->load->view('onlineshopping/select_package_index',$data);

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}	

	}


	public function payment_landing(){

		$data = array('menu' => 15,
					 'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;

			$TRANSDATA = $this->input->get('data');

				if($TRANSDATA){

					$DECRYPTED = $this->Encryption_model->decrypt_value($TRANSDATA);
					$data = explode('&', $DECRYPTED);

					if(count($data) == 6){
		 				for($i=0;$i<count($data);$i++){
		 					$val_check = explode('=', $data[$i]);

		 					if($i == 0){
		 						if($val_check[0] != 'loc'){
		 							redirect('ErrorPage/');
		 						}else{
		 							$LOCATION = $val_check[1];
		 						}
		 					}else if($i == 1){
		 						if($val_check[0] != 'id'){
		 							redirect('ErrorPage/');
		 						}else{
		 							$PACKAGEID = $val_check[1];
		 						}
		 					}else if($i == 2){
		 						if($val_check[0] != 'name'){
		 							redirect('ErrorPage/');
		 						}else{
		 							$CLIENTNAME = $val_check[1];
		 						}
		 					}else if($i == 3){
		 						if($val_check[0] != 'email'){
		 							redirect('ErrorPage/');
		 						}else{
		 							$CLIENTEMAIL = $val_check[1];
		 						}
		 					}else if($i == 4){
		 						if($val_check[0] != 'mobile'){
		 							redirect('ErrorPage/');
		 						}else{
		 							$CLIENTMOBILE = $val_check[1];
		 						}
		 					}else if($i == 5){
		 						if($val_check[0] != 'charge'){
		 							redirect('ErrorPage/');
		 						}else{
		 							$SERVICE_CHARGE = $val_check[1];
		 						}
		 					}
		 				}

		 				// foreach ($_GET as $key => $value) {
		 				// 	if($key != 'data'){
		 				// 		// echo $key.'='.$value.'<br>';
		 				// 	}
		 				// }

		 				if($this->input->get('vpc_TxnResponseCode') == '0'){

							$getDecimal = substr($this->input->get('vpc_Amount'), -2);
							$BDO_AMOUNT = explode($getDecimal, $this->input->get('vpc_Amount'));

							$parameter = array(
						    				 'dev_id'     		=>$this->global_f->dev_id(),
						    				 'ip_address' 		=>$this->ip,
						    				 'ip' 				=>$this->ip,
						    				 'actionId' 	 	=> _request_buycodes_purchase,
						    				 'regcode'          =>$this->user['R'],
						    				 'package_id'       =>$PACKAGEID,
						    				 'cardno'       	=>$this->input->get('vpc_CardNum'),
						    				 'amount'       	=>$BDO_AMOUNT[0].'.'.($getDecimal ? $getDecimal : '00'), //substr_replace($BDO_AMOUNT[0], "", -2).'.'.($BDO_AMOUNT[1] ? $BDO_AMOUNT[1] : '00')
						    				 'referenceno'      =>$this->input->get('vpc_ReceiptNo'),
						    				 'trackno'       	=>$this->input->get('vpc_MerchTxnRef'),
						    				 'client_country'   =>$LOCATION,
						    				 'client_name'		=>$CLIENTNAME,
						    				 'client_email'		=>$CLIENTEMAIL,
						    				 'client_mobile'	=>$CLIENTMOBILE,
						    				 'charge' 			=>$SERVICE_CHARGE
												);
							$result = $this->curl->call($parameter,url);
						    $API = json_decode($result,true);

							if ($API['S'] == 1) {

								$data['result'] = array(	
								  	'S'  => 1,
								  	'H'  => 'Successful',
								  	'M'  =>$API['M'],
								  	'TN' =>$API['TN']
								);
							}else {

								$data['result'] = array(	
								  	'S' => 0,
								  	'H' => 'Transaction failed',
								  	'M' =>$API['M']
								);
							}

		 				}else{

		 					$data['result'] = array(
		 										'S' =>  0,
						 						'H' =>  'Transaction failed',
						 						'M' => str_replace('+', ' ', $this->input->get('vpc_Message'))
		 										);
		 				}

	 					$this->load->view('layout/header');	
	 					$this->load->view('onlineshopping/bdo_message',$data);
	 					$this->load->view('layout/footer');	

					}else{
						redirect('ErrorPage/');
					}
				}else{
					redirect('ErrorPage/');
				}

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}

	}


	public function upgrade_account($type=null)
	{
		if ($this->user['A_CTRL']['online_shop'] == 1){
			$data = array('menu' => 11,
						 'parent'=>'' );
			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['user'] = $this->user;

				if(isset($type)){
					$url = url;
					$parameter = array(
				    				 'dev_id'     		=>$this->global_f->dev_id(),
				    				 'ip_address' 		=>$this->ip,
				    				 'actionId' 	 	=> _get_upgrade_price,
				    				 'regcode'          =>$this->user['R'],
									 'd_type'    		=>strtoupper($type),
									
									 $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
										);  
				    $result = $this->curl->call($parameter,$url);
				    $API = json_decode($result,true);
				    $data['type'] = strtoupper($type);
				    $data['result'] = $API;

				    


				  //   $parametert = array(
				  //   				 'dev_id'     		=>$this->global_f->dev_id(),
				  //   				 'ip_address' 		=>$this->ip,
				  //   				 'actionId' 	 	=> 'ups_account_service/check_accounttype',
				  //   				 'regcode'          =>$this->user['R'],
						// 			 $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
						// 			);  	
					 // $resultt = $this->curl->call($parametert,$url);
				  //    $APIt = json_decode($resultt,true);
				  //    $data['checkaccounttype'] = $APIt;

				     // print_r($data['checkaccounttypes']);
				    // echo "<script>alert('PABLO');</script>";
				    // print_r($data['result']);


				}else if(!isset($type)){
					$url = url;
				$parametert = array(
				    				 'dev_id'     		=>$this->global_f->dev_id(),
				    				 'ip_address' 		=>$this->ip,
				    				 'actionId' 	 	=> 'ups_account_service/check_accounttype',
				    				 'regcode'          =>$this->user['R'],
									 $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
									);  	
					 $resultt = $this->curl->call($parametert,$url);
				     $APIt = json_decode($resultt,true);
				     $data['checkaccounttype'] = $APIt;
				     $data['type'] = $type;
				}


				if (isset($_POST['btnSubmit'])){
					$url = url;
					$parameter = array(
				    				 'dev_id'     		=>$this->global_f->dev_id(),
				    				 'ip_address' 		=>$this->ip,
				    				 'actionId' 	 	=> _upgrade_account,
				    				 'regcode'          =>$this->user['R'],
									 'd_type'    		=>$this->input->post('dtype'),
									 'transpass'   		=>$this->input->post('tpass'),
									 $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
									);  	
					 $result = $this->curl->call($parameter,$url);
				     $API = json_decode($result,true);
				     $data['process'] = $API;

				  
				}

				
				     

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('onlineshop/upgrade_account'); 
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

//|------------------------------------------------------| MLM Shop |----------------------------------------------|//
	public function MLMShop($name='') {
		if ($this->user['A_CTRL']['online_shop'] == 1){
			$data = array('menu' => 11,'parent'=>'' );
			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$INPUT_POST =$this->input->post(null,true);
				$param=$this->input->post();
				$param=array_map(function($val){return urldecode($val);},$param);
				if($param){
					// print_r('dsdada');
					$parameter['dev_id']=$this->global_f->dev_id();
					$parameter['ip_address']=$this->ip;
					$parameter['regcode']=$this->user['R'];
					$parameter['trackingno']=$param['tracking_no'];
					$parameter['date_from']=$param['date_from'];
					$parameter['date_to']=$param['date_to'];
					$parameter['actionId']=_get_MLMShop;
					$parameter[$this->user['SKT']]=md5($this->user['R'].$this->user['SKT']);
					// payment method
					// print_r($param['Task']);
					// die();
					$parameter['task']=$param['Task'];	
					switch($param['Task']){
						case 'PayOut':
							if(	$parameter['regcode'] == '1234567'||
								$parameter['regcode'] == 'F7897947'||
								$parameter['regcode'] == 'F5385420'||
								$parameter['regcode'] == 'F5860588'||
								$parameter['regcode'] == 'F5950087'||
								$parameter['regcode'] == 'F5950891'||
								$parameter['regcode'] == 'F6077643'||
								$parameter['regcode'] == 'F6238825'||
								$parameter['regcode'] == 'F6429926'||
								$parameter['regcode'] == 'F6522385'||
								$parameter['regcode'] == 'F6618590'||
								$parameter['regcode'] == 'F6657731'||
								$parameter['regcode'] == 'F6708104'||
								$parameter['regcode'] == 'F6829187'||
								$parameter['regcode'] == 'F6857702'||
								$parameter['regcode'] == 'F6819290'||
								$parameter['regcode'] == 'F9130379'||
								$parameter['regcode'] == 'F6696243') {
								$parameter['actionId']=_payout_MLMShop_test;
							}else{
								$parameter['actionId']=_payout_MLMShop;
							}	
							$parameter['cart']=$param['Cart'];
							$parameter['outlet']=$param['Outlet'];
							// if($param['remarks']=='For Deliver')$parameter['outlet']='REG123';//original code for deliver
							if(	$parameter['regcode'] == '1234567'||
								$parameter['regcode'] == 'F7897947'||
								$parameter['regcode'] == 'F5385420'||
								$parameter['regcode'] == 'F5860588'||
								$parameter['regcode'] == 'F5950087'||
								$parameter['regcode'] == 'F5950891'||
								$parameter['regcode'] == 'F6077643'||
								$parameter['regcode'] == 'F6238825'||
								$parameter['regcode'] == 'F6429926'||
								$parameter['regcode'] == 'F6522385'||
								$parameter['regcode'] == 'F6618590'||
								$parameter['regcode'] == 'F6657731'||
								$parameter['regcode'] == 'F6708104'||
								$parameter['regcode'] == 'F6829187'||
								$parameter['regcode'] == 'F6857702'||
								$parameter['regcode'] == 'F6819290'||
								$parameter['regcode'] == 'F6696243') {
								if($param['remarks']=='For Deliver') {
									if(	$parameter['location_id'] == '1'||
										$parameter['location_id'] == '2'||
										$parameter['location_id'] == '5') {
										$parameter['outlet']='REG123';
									} else if ($parameter['location_id'] == '3') {
										$parameter['outlet']='13979797';
									} else {
										$parameter['outlet']='FH000016';
									}
								};
							} else {
								if($param['remarks']=='For Deliver')$parameter['outlet']='REG123';
							}
							$parameter['shippingrates']=$param['ShippingRates'];
							$parameter['shippinglocation']=$param['shipping_location'];
							$parameter['payment']=$param['PaymentType'];
							$parameter['delivery_address']=$param['DeliveryAddress'];
							$parameter['contact_person']=$param['ContactPerson'];
							$parameter['contact_no']=$param['ContactNo'];
						break;
						case 'Cancelled':	$parameter['task']=$param['Task'];
						case 'Claimed': 	$parameter['trackingno']=$param['Track'];
						break;
					}
					
				
					$result = $this->curl->call($parameter,url);//				var_dump($result);
					echo $result.$custom;	 
					
					if($param['Task']=='GetWallet'){
						$result = json_decode($result);
						$this->user['EC'] = ($result->Data[0]->ECash-$result->Data[0]->MLMECash);
						$data['user'] = $this->global_f->get_user_session();
					}
					// print_r($parameter);
					// die();
				}
				else{
					$data['user'] = $this->user;
					$data['mlm_user'] = $this->session->userdata('MLM_user');
					$data['imageLimit'] = 9;

					$parameter = array(
									'dev_id'     		=>$this->global_f->dev_id(),
									'ip_address' 		=>$this->ip,
									'ip' 				=>$this->ip,
									'actionId' 	 		=> _hub_inventory_list, 
									'regcode'           =>$this->user['R'],
									'product_code'		=>'', //NULL OR '' - SEARCH PRODUCT NAME
									'product_type'		=>'2',
									'product_category'	=>'',
									$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
										);
					$result = $this->curl->call($parameter,url);//				var_dump($result);
					$data['API']=$result;
					$data['products'] = json_decode($result,true);
					//echo count($data['products']['DATA_LIST']);						
					// print_r($result);
					// die();
					$parameter = array(
									'dev_id'     		=>$this->global_f->dev_id(),
									'ip_address' 		=>$this->ip,
									'ip' 				=>$this->ip,
									'actionId' 	 		=> _hub_inventory_list, 
									'regcode'           =>$this->user['R'],
									'product_code'		=>'', //NULL OR '' - SEARCH PRODUCT NAME
									'product_type'		=>'1',
									'product_category'	=>'',
									$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
										);
					$result = $this->curl->call($parameter,url);
					$data['packages'] = json_decode($result,true);
					$name=urldecode($name);
					
					if($name!=''){
						$data['products']['DATA_LIST']=array_filter($data['products']['DATA_LIST'],function($elem) use ($name){
							if(trim(strpos(strtoupper($elem['product_name']),strtoupper($name)))!='' ) return $elem;	
						});
					}
					//print_r($this->user);
					// $data['Search']=$name;

					// $this->load->view('layout/short_header',$data);
					// $this->load->view('onlineshopping/MLMShop',$data);
					// $this->load->view('layout/short_footer',$data);

                    

					$data['Search']=$name;
					
					$this->load->view('layout/short_header',$data);
						
					if ($this->user['R'] == 'F6284771' || $this->user['R'] == '1234567' || $this->user['R'] == 'F9175006' || $this->user['R'] == 'F5033230') { 
						$this->load->view('onlineshopping_test/MLMShop_Test',$data); 	
					} else if ($this->user['R'] == 'F9130379') {
						$this->load->view('onlineshopping_test/MLMShop_Test',$data); 	
					} else if (substr($this->user['R'],0,3) == 'GRM' || $API['R'] == 'F5880126' || $this->user['R'] == 'G7979485' || $this->user['R'] == 'F1205575' || $this->user['R'] == 'F1145677' || $this->user['R'] == 'F1164754' || $this->user['R'] == 'F1198933' || $user['R'] == 'F5597768' || $user['R'] == '1234567'){
						$this->load->view('onlineshopping/MLMShopRicemart.php');
					} else {
						$this->load->view('onlineshopping/MLMShop',$data);
					}

					$this->load->view('layout/short_footer',$data);

				}
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
//|----------------------------------------------------------------------------------------------------------------|//
	function MLMProvince() {
		$parameter = array(
				'actionId'	=> _mlm_province,
				'dev_id'	=>$this->global_f->dev_id(),
				'ip_address'=>$this->ip,
				'regcode'	=>$this->user['R'],
				'location_id'=>$this->input->post('location_id')
			);	

			$result = $this->curl->call($parameter,url);
			$data['province'] = json_decode($result,true);
			$response = array('option' => $this->load->view('onlineshopping/sampleProvince', $data, true));
			echo json_encode($response);
	}

	function MLMProvince_MLM() {
		$parameter = array(
				'actionId'	=> _mlm_province,
				'dev_id'	=>$this->global_f->dev_id(),
				'ip_address'=>$this->ip,
				'regcode'	=>$this->user['R'],
				'location_id'=>$this->input->post('location_id')
			);	

			$result = $this->curl->call($parameter,url);
			$data['province'] = json_decode($result,true);
			$response = array('option' => $this->load->view('onlineshopping/sampleProvince', $data, true));
			echo json_encode($response);
	}
	
	function MLMCity(){
		$parameter = array(
				'actionId'	=> _mlm_city,
				'dev_id'	=>$this->global_f->dev_id(),
				'ip_address'=>$this->ip,
				'regcode'	=>$this->user['R'],
				'province_id'=>$this->input->post('province_id')
			);

			$result = $this->curl->call($parameter,url);
			$data['city'] = json_decode($result,true);
			$response = array('option' => $this->load->view('onlineshopping/sampleCity', $data, true));
			echo json_encode($response);
	}

	function MLMCity_MLM(){
		$parameter = array(
				'actionId'	=> _mlm_city,
				'dev_id'	=>$this->global_f->dev_id(),
				'ip_address'=>$this->ip,
				'regcode'	=>$this->user['R'],
				'province_id'=>$this->input->post('province_id')
			);

			$result = $this->curl->call($parameter,url);
			$data['city'] = json_decode($result,true);
			$response = array('option' => $this->load->view('onlineshopping/sampleCity', $data, true));
			echo json_encode($response);
	}

	function ShippingRate(){
		$parameter = array(
			'actionId'	=> _mlm_shipping,
			'dev_id'	=>$this->global_f->dev_id(),
			'ip_address'=>$this->ip,
			'regcode'	=>$this->user['R'],
			'weight_from_KG'=>$this->input->post('weight_from_KG')
		);

		$result = $this->curl->call($parameter,url);
		$data['ShippingRate'] = json_decode($result,true);
		// $response = $this->load->view('onlineshopping/ShippingRate', $data, true);
		echo json_encode($data['ShippingRate']);
	}

	function getPurchase()
	{
		$INPUT_POST =$this->input->post(null,true);
		
		$parameter = array(
			'actionId'	 => _get_MLMShop,
			'dev_id'	 => $this->global_f->dev_id(),
			'regcode'	 => $this->user['R'],
			'trackingno' => $INPUT_POST['tacking_no'],
			'task' 		 => $INPUT_POST['task'],
			'ip_address' => $this->ip,
			'date_from'	 => $INPUT_POST['date_from'],
			'date_to'	 => $INPUT_POST['date_to']
		);

		$result = $this->curl->call($parameter, url);
		$data['getOrder'] = json_decode($result, true);

		echo json_encode($data['getOrder']);
	}

} 