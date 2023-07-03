<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Online_shop2 extends CI_Controller {

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
       
	    $this->load->model('Query_model','q');
	  	$this->load->model('Report_model','r');
	  	$this->load->model('Global_function','global_f');
		$this->load->model('encryption_model');

	}

	public function payment_landing(){

		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data = array('menu' => 15,
						 'parent'=>'' );

			$data['user'] = $this->user;

			$TRANSDATA = $this->input->get('data');

				if($TRANSDATA){

					$DECRYPTED = $this->encryption_model->decrypt_value($TRANSDATA);
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
	 					$this->load->view('onlineshop2/bdo_message',$data);
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

	public function index()
	{
		$data = array('menu' => 15,
					 'parent'=>'' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$data['user'] = $this->user;	
			$TRANSDATA = $this->input->get('data');
			$testaccount = substr($data['user']['R'],0,2);

			if($testaccount == 'UF'){
				$data['retailer'] = 1;

			}
			
			if($TRANSDATA){
				$this->session->unset_userdata('agreetermsinfo');
				redirect('Online_shop2/');
			}else{
				$agreetermsinfo = $this->session->userdata('agreetermsinfo');
				if(isset($agreetermsinfo)){
					goto aaa;
				}
			}

			if($this->input->post('package_select')){
				$urldata = json_decode(urldecode($this->input->post('package_select')));
				$data['location'] = $urldata[0];
				$data['package_value'] = $urldata[1];

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

				$this->session->set_userdata('packageselect',$urldata);
				$this->load->view('onlineshop2/select_package_index',$data);
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
			   	$this->load->view('onlineshop2/index',$data);
			}

			if (isset($_POST['btnsubmit'])) {

 				$INPUT_POST=$this->input->post(null,true);
 				$data['packageselect'] = $this->session->userdata('packageselect');	
				$data['location'] = $data['packageselect'][0];
				$data['package_value'] = $data['packageselect'][1];
				$data['package_info'] = array(
								'client_country'   =>$INPUT_POST['inputCountry'],
			    				'client_name'	   =>$INPUT_POST['inputClient'],
			    				'client_email'	   =>$INPUT_POST['inputClientemail'],
			    				'client_mobile'	   =>$INPUT_POST['inputMobno'],
			    				'payment_type'	   =>$INPUT_POST['selpaymenttype']
										);


 				if($INPUT_POST['selpaymenttype'] == 2){

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
			        	$data['terms'] = array(
								'btnsubmit'   		=>$INPUT_POST['btnsubmit'],
			    				'selpaymenttype'	=>$INPUT_POST['selpaymenttype']);
			        	$data['process'] = 999;
			        	$data['content'] = $check_agreement['Content'];
			        	$this->session->set_userdata('termsinfo',$data);
			        }else{
			        	goto bbb;

			        	aaa:
						$data = $this->session->userdata('agreetermsinfo');

						bbb:
		 				$data['process'] = 1;

		 				$vpcURL = 'https://migs.mastercard.com.au/vpcpay';
		 				$SECURE_SECRET = "4E668324C795C99B6D2BBA57E4DDA215";

		 				require APPPATH.'/libraries/vpclib/VPCPaymentConnection.php';
		 				$conn = new VPCPaymentConnection();
		 				$conn->setSecureSecret($SECURE_SECRET);

		 				$service_charge = ($data['packageselect'][1]->NetPrice * 0.055);

		 				$ADDITIONAL_CHARGE = $data['packageselect'][1]->NetPrice + $service_charge;

		 				$ADDITIONAL_CHARGE = round($ADDITIONAL_CHARGE,2);
		 				$AMOUNT_MODIFY = explode('.', $ADDITIONAL_CHARGE);

						if(strlen($AMOUNT_MODIFY[1]) == 1){
							$AMOUNT_MODIFY[1] = $AMOUNT_MODIFY[1].'0';
						}
		 				//$AMOUNT_MODIFY[0] = 1;

		 				$RAW_DATA = 'loc='.$data['location'].'&id='.$data['package_value']->Package_ID.'&name='.$INPUT_POST['inputClient'].'&email='.$INPUT_POST['inputClientemail'].'&mobile='.$INPUT_POST['inputMobno'].'&charge='.$service_charge;
		 				$RAW_DATA = urlencode($this->encryption_model->encrypt_value($RAW_DATA));

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
						base_url().'Online_shop2/payment_landing?data='.$RAW_DATA.'<br>';
						strlen(base_url().'Online_shop2/payment_landing?data='.$RAW_DATA); //die();
		 				$BDO_PARAMS = array(
		 						'vpc_AccessCode' => '04C8BEAF',
		 						'vpc_Amount' => round($AMOUNT_MODIFY[0]).($AMOUNT_MODIFY[1] ? sprintf('%02s', $AMOUNT_MODIFY[1]) : '00'), //round($AMOUNT_MODIFY[0]).($AMOUNT_MODIFY[1] ? '00.'.$AMOUNT_MODIFY[1] : '00')
								'vpc_Command' => 'pay',
								'vpc_Locale' => 'en',
								'vpc_MerchTxnRef' => $TRACKNO,
								'vpc_Merchant' => 'BD9180551889',
								'vpc_OrderInfo' => $TRACKNO,
								'vpc_ReturnURL' => base_url().'Online_shop2/payment_landing?data='.$RAW_DATA,
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

					}	
						$this->load->view('onlineshop2/select_package_index',$data);
 				}else{

				$parameter = array(
			    				 'dev_id'     		=>$this->global_f->dev_id(),
			    				 'ip_address' 		=>$this->ip,
			    				 'ip' 				=>$this->ip,
			    				 'actionId' 	 	=> _confirm_buycodes,
			    				 'regcode'          =>$this->user['R'],
			    				 'client_country'   =>$INPUT_POST['inputCountry'],
			    				 'client_name'		=>$INPUT_POST['inputClient'],
			    				 'client_email'		=>$INPUT_POST['inputClientemail'],
			    				 'client_mobile'	=>$INPUT_POST['inputMobno'],
			    				 'package_type'		=>$INPUT_POST['inputPackageType'],
			    				 'transpass'		=>$INPUT_POST['inputTpass'],
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
					$this->load->view('onlineshop2/select_package_index',$data);	
 				}


			}

		}else {
			//$this->session->unset_userdata('agreetermsinfo');
			$this->session->sess_destroy();
			redirect('Login/');
		}
		
	}	

	public function terms_redir(){
		$content_data = $this->input->get('d');

		echo "<form action='/online_shop2/termsncondition' method='post' name='frm'>";
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
					<form action="<?php echo BASE_URL()?>online_shop2/confirmAgreement" method="post" id="frmAgreeTermsnCondition">
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
		echo '<script type="text/javascript">';
		echo 'parent.closeIframeBuycodes()';
		echo '</script>';
		$confirm_data = $this->input->post('btnAgree');
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
					$termsinfo = $this->session->userdata('termsinfo');	
					$this->session->set_userdata('agreetermsinfo',$termsinfo);
				}
				else{
					$message = array('S' => 0, 'M' => $API['M']);
				}
				$this->load->view('onlineshop2/select_package_index',$data);	
		}else{
			redirect('ErrorPage/');
		}
	}

	public function buy_products() {

		$data = array('menu' => 19,
					 'parent'=>'' );
		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$category = $this->uri->segment(3);
			//var_dump(urldecode($rating));

			$data['user'] = $this->user;
			$data['mlm_user'] = $this->session->userdata('MLM_user');
			$data['imageLimit'] = 6;


			$parameter = array(
		    				 'dev_id'     		=>$this->global_f->dev_id(),
		    				 'ip_address' 		=>$this->ip,
		    				 'ip' 				=>$this->ip,
		    				 'actionId' 	 	=> _fetch_top_products, 
		    				 'regcode'          =>$this->user['R'],
		    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
								);
			$result = $this->curl->call($parameter,url);
		    $data['tp'] = json_decode($result,true);


			$parameter = array(
		    				 'dev_id'     		=>$this->global_f->dev_id(),
		    				 'ip_address' 		=>$this->ip,
		    				 'ip' 				=>$this->ip,
		    				 'actionId' 	 	=> _fetch_product_list, 
		    				 'regcode'          =>$this->user['R'],
		    				 'product_name'		=>$product_name, //NULL OR '' - SEARCH PRODUCT NAME
		    				 'product_type'		=>2,
		    				 'product_category'	=>'Unified Beauty',
		    				  $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
								);
			$result = $this->curl->call($parameter,url);
		    $data['products'] = json_decode($result,true);


			$this->load->view('layout/short_header',$data);
			$this->load->view('onlineshop2/buy_products',$data);
			$this->load->view('layout/short_footer',$data);

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');

		}

	}








}