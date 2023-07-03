<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fundtransfer extends CI_Controller {

  public function __construct()
  {
    parent::__construct();

    $this->load->library('session');
    $this->user = $this->session->userdata('user');
    $this->load->dbutil();

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

    $this->load->model('Curl_model','curl');
    $this->load->model('Query_model');
    $this->load->model('Report_model');
    $this->load->model('Global_function','global_f');
    $this->load->model('Encryption_model');
    $this->load->model('Sp_model');
    $this->load->model('Check_transaction', 'check_trans');
  }

  public function index()
  {
      $data = array('menu' => 7, 'parent'=>'');

      if ($this->user['S'] == 1 && $this->user['R'] != "")
      {
        $data['user'] = $this->user;

        if (substr($this->user['R'], 0, 3) == 'GWL') //For Wealthylifestyle
				{
					$data['exceed_aed'] = $this->check_trans->transCount($this->user['R'], 144)['S'];
          $data['exceed_qar'] = $this->check_trans->transCount($this->user['R'], 145)['S'];
          $data['exceed_hkd'] = $this->check_trans->transCount($this->user['R'], 146)['S'];
          $data['exceed_forex'] = $this->check_trans->transCount($this->user['R'], 147)['S'];
          $data['exceed_sgd'] = $this->check_trans->transCount($this->user['R'], 42)['S'];
					
          $this->load->view('fundtransfer/gwl_index', $data);
				}
				else
				{
          $this->load->view('fundtransfer/index', $data);
				}	
      }
      else 
      {
        $this->session->sess_destroy();
        redirect('Login/');
      }
  }

  public function payment_landing(){

    if ($this->user['S'] == 1 && $this->user['R'] !=""){

      $data = array('menu' => 15,
        'parent'=>'' );

      $data['user'] = $this->user;

      $TRANSDATA = $this->input->get('data');
      
      if($TRANSDATA){

        $DECRYPTED = $this->Encryption_model->decrypt_value($TRANSDATA);
        $data = explode('&', $DECRYPTED);

        if(count($data) == 3){
          for($i=0;$i<count($data);$i++){
            $val_check = explode('=', $data[$i]);

            if($i == 0){
              if($val_check[0] != 'amount'){
                redirect('ErrorPage/');
              }else{
                $AMOUNT = $val_check[1];
              }
            }else if($i == 1){
              if($val_check[0] != 'charge'){
                redirect('ErrorPage/');
              }else{
                $SERVICE_CHARGE = $val_check[1];
              }
            }else if($i == 2){
              if($val_check[0] != 'reloadtype'){
                redirect('ErrorPage/');
              }else{
                $RELOAD_TYPE = $val_check[1];
              }
            }
          }

          if($this->input->get('vpc_TxnResponseCode') == '0'){

            $getDecimal = substr($this->input->get('vpc_Amount'), -2);
            $BDO_AMOUNT = explode($getDecimal, $this->input->get('vpc_Amount'));

            $parameter = array(
              'dev_id'        =>$this->global_f->dev_id(),
              'ip_address'    =>$this->ip,
              'ip'        =>$this->ip,
              'actionId'    => _request_reload_purchase,
              'regcode'          =>$this->user['R'],
              'cardno'        =>$this->input->get('vpc_CardNum'),
              'amount'      =>$AMOUNT,
                         'paid_amount'    =>$BDO_AMOUNT[0].'.'.($getDecimal ? $getDecimal : '00'), //substr_replace($BDO_AMOUNT[0], "", -2).'.'.($BDO_AMOUNT[1] ? $BDO_AMOUNT[1] : '00')
                         'referenceno'      =>$this->input->get('vpc_ReceiptNo'),
                         'trackno'        =>$this->input->get('vpc_MerchTxnRef'),
                         'charge'       =>$SERVICE_CHARGE,
                         'reload_type'    =>$RELOAD_TYPE
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

  public function creditcard_reapply(){
    $parameter = array(
      'dev_id'         =>$this->global_f->dev_id(),
      'ip_address'     =>$this->ip,
      'ip'            =>$this->ip,
      'actionId'       => _reapply_requirements,
      'regcode'        =>$this->user['R'],
      $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
      );
    $result = $this->curl->call($parameter,url);
    $reapply_result = json_decode($result,true);

    redirect('/fundtransfer/creditcard_topup');
  }


  public function creditcard_topup(){
    $parameter = array(
      'dev_id'         =>$this->global_f->dev_id(),
      'ip_address'     =>$this->ip,
      'ip'            =>$this->ip,
      'actionId'       => _check_user_agreement,
      'regcode'        =>$this->user['R'],
      $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
      );
    $result = $this->curl->call($parameter,url);
    $check_agreement = json_decode($result,true);

    if($check_agreement['S'] == 2){
      $data['process'] = 999;
      $data['content'] = $check_agreement['Content'];
    }

    if($check_agreement['S'] == 1){
      $parameter = array(
        'dev_id'         =>$this->global_f->dev_id(),
        'ip_address'     =>$this->ip,
        'ip'            =>$this->ip,
        'actionId'       => _check_cc_application,
        'regcode'        =>$this->user['R'],
        $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
        );
      $result = $this->curl->call($parameter,url);
      $API = json_decode($result,true);
      if($API['S'] != 1){
        $data['message'] = $API['M'];
        $data['process'] = 998;
        if($API['S'] == 2){
          $data['show_upload'] = 997;
        }
        if($API['S'] == 4){
          $data['reapply'] = 996;
        }
      }
    }

    if ($this->user['S'] == 1 && $this->user['R'] !=""){
      $data['user'] = $this->user;

      $is_submit = $this->input->post('inputCCTOsubmit');
      if(isset($is_submit) && $this->input->post('inputCCTOpaymenttype') == 1){
        $AMOUNT = $this->input->post('inputCCTOAmount');
        $RATE = 0.055;
        $TOTAL_AMOUNT = round($AMOUNT + ($AMOUNT * $RATE),2);
          // var_dump($TOTAL_AMOUNT);die();
        $CHARGE = $TOTAL_AMOUNT - $AMOUNT;

        $AMOUNT_MODIFY = explode('.', $TOTAL_AMOUNT);


        if(strlen($AMOUNT_MODIFY[1]) == 1){
          $AMOUNT_MODIFY[1] = $AMOUNT_MODIFY[1].'0';
        }
          // $AMOUNT_MODIFY[0] = 1;

        $parameter = array(
          'dev_id'        =>$this->global_f->dev_id(),
          'ip_address'    =>$this->ip,
          'ip'        =>$this->ip,
          'actionId'      => _generate_tracking_reload,
          'regcode'           =>$this->user['R'],
          'amount'      =>$AMOUNT,
          'totalamount'   =>$TOTAL_AMOUNT,
          $this->user['SKT']  =>  md5($this->user['R'].$this->user['SKT'])
          );
        $api_result = $this->curl->call($parameter,url);
        $API = json_decode($api_result,true);

        if ($API['S'] == 1) {
          $TRACKNO = $API['TN'];
        }else{
          $TRACKNO = '';
        }

        $RAW_DATA = 'amount='.$AMOUNT.'&charge='.$CHARGE.'&reloadtype='.$this->input->post('inputCTTOFundtype');
        $RAW_DATA = urlencode($this->Encryption_model->encrypt_value($RAW_DATA));



        $vpcURL = 'https://migs.mastercard.com.au/vpcpay';
        $SECURE_SECRET = "4E668324C795C99B6D2BBA57E4DDA215";

        require APPPATH.'/libraries/vpclib/VPCPaymentConnection.php';
        $conn = new VPCPaymentConnection();

          // $this->load->model('Credit_card_model');
        $conn->setSecureSecret($SECURE_SECRET);
          // echo "string";die();
        $BDO_PARAMS = array(
          'vpc_AccessCode' => '04C8BEAF',
          'vpc_Amount' => round($AMOUNT_MODIFY[0]).($AMOUNT_MODIFY[1] ? sprintf('%02s', $AMOUNT_MODIFY[1]) : '00'),
          'vpc_Command' => 'pay',
          'vpc_Locale' => 'en',
          'vpc_MerchTxnRef' => $TRACKNO,
          'vpc_Merchant' => 'BD9180551889',
          'vpc_OrderInfo' => $TRACKNO,
          'vpc_ReturnURL' => base_url().'fundtransfer/payment_landing?data='.$RAW_DATA,
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
          // echo $vpcURL;die();

        $data['bdoURL'] = $vpcURL;
        $data['process'] = 1;
        $data['amount'] = $AMOUNT;
      }

      $cinfo_parameter = array(
        'dev_id'        =>$this->global_f->dev_id(),
        'ip_address'    =>$this->ip,
        'ip'        =>$this->ip,
        'actionId'    => _fetch_creditcard_reload_transactions,
        'regcode'          =>$this->user['R'],
        $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
        );

      $c_api_result = $this->curl->call($cinfo_parameter,url);
      $C_API = json_decode($c_api_result,true);

      if($C_API['S'] == 1){
        $data['cinfo_set'] = true;

        $data['transdata'] = $C_API['T_DATA'];
      }else{
        $data['cinfo_set'] = false;
      }


      $this->load->view('layout/header',$data);
      $this->load->view('element/top_header');
      $this->load->view('element/wrapper_header');
      $this->load->view('element/left_panel');
      $this->load->view('fundtransfer/creditcard_topup',$data); 
      $this->load->view('element/wrapper_footer');
      $this->load->view('layout/footer'); 

    }else{
      $this->session->sess_destroy();
      redirect('Login/');
    }
  }

  public function creditcard_upload(){
    $authenticate = $this->input->post('authorization');

    if($authenticate == 'unifiedproductsandservices'){
      $file_array = array();
      $file_url = array();
      foreach ($_FILES as $key => $value) {
        array_push($file_array, $_FILES[$key]['tmp_name']);
      }

      require APPPATH.'/libraries/cloudinary/Cloudinary.php';
      require APPPATH.'/libraries/cloudinary/Uploader.php';
      
      for($i=0;$i<count($file_array);$i++){

        // \Cloudinary::config(array(
        //  "cloud_name" => "unifiedproductsandservices",
        //  "api_key" => "771772251668234",
        //  "api_secret" => "hFk5zXdh5ZPnggg2hqNi7dee6LQ"
        //  ));

        \Cloudinary::config(array(
          "cloud_name" => "du0f8e7uc",
          "api_key" => "444853572885472",
          "api_secret" => "d6oA6ELp_-j72TBFb_TwQqhB2Qk"
          ));

        $cloudUpload = \Cloudinary\Uploader::upload($file_array[$i]);

        array_push($file_url, $cloudUpload['secure_url']);
      }


      $URL = implode(',', $file_url);

      $parameter = array(
        'dev_id'         =>$this->global_f->dev_id(),
        'ip_address'     =>$this->ip,
        'ip'            =>$this->ip,
        'actionId'       => _requirements_reload_submit,
        'regcode'        =>$this->user['R'],
        'url_data'        =>$URL,
        $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
        );
      $result = $this->curl->call($parameter,url);
      $submit_requirements = json_decode($result,true);
      redirect('/fundtransfer/creditcard_topup');
    }else{
      redirect('/fundtransfer/creditcard_topup');
    }
  }

  public function terms_redir(){
    $content_data = $this->input->get('d');
    $content_data = filter_var($content_data, FILTER_SANITIZE_STRING);
    echo "<form action='/fundtransfer/termsncondition' method='post' name='frm'>";
    echo "<input type='hidden' name='content' value='".$content_data."'>";
    echo "</form>";
    echo "<script type='text/javascript'>";
    echo "document.frm.submit();";
    echo "</script>";
  }


  public function termsncondition(){
    $content = $this->input->post('content');
    if($content){
      // echo urldecode($content);
      ?>
      <form action="<?php echo BASE_URL()?>fundtransfer/confirmAgreement" method="post" id="frmAgreeTermsnCondition">
      </br>
      <center><button type="submit" class="btn btn-warning btn-lg" name="btnAgree" id="btnAgree" style="width: 150px;">I Agree</button></center>
    </form>
    <script>
      function closeIframe() {
        var iframe = document.getElementById('modalAgreementframe');
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
  echo 'parent.closeIframe()';
  echo '</script>';
  $confirm_data = $this->input->post('btnAgree');
  if(isset($confirm_data)){
    $parameter = array(
      'dev_id'         =>$this->global_f->dev_id(),
      'ip_address'     =>$this->ip,
      'ip'            =>$this->ip,
      'actionId'       => _agree_user_agreement,
      'regcode'        =>$this->user['R'],
      $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
      );
    $result = $this->curl->call($parameter,url);
    $API = json_decode($result,true);
    if($API['S'] == 1){
      $message = array('S' => 1, 'M' => $API['M']);
    }
    else{
      $message = array('S' => 0, 'M' => $API['M']);
    }
        //close frame reload page
  }else{
    redirect('ErrorPage/');
  }
}

public function load_wallet() 
{
  if ($this->user['A_CTRL']['fund_request'] == 1){
    $data = array('menu' => 7,
      'parent'=>'' );

    if ($this->user['S'] == 1 && $this->user['R'] !=""){
      $data['user'] = $this->user;

      if (null !==$this->input->post('btnSubmit')) //SEARCH FOR REGCODE
      {
        $INPUT_POST = $this->input->post(null,true);

        $url = url;
        $parameter =array(
          'dev_id'          => $this->global_f->dev_id(),
          'actionId'        => _fetch_user_info,
          'ip_address'      => $this->ip,
          'regcode'               =>$this->user['R'],
          'receiver'              =>$INPUT_POST['inputRegcode'],
          $this->user['SKT'] =>  md5($this->user['R'].$INPUT_POST['inputRegcode'].$this->user['SKT'])
          ); 
        
        $result = $this->curl->call($parameter,$url);
        $data['result'] = json_decode($result,true);

        if ($data['result']['S'] == 1) {
          $data['process'] = array(
            'P' =>1,
            'M' =>'SECOND'
            );
          $data['input'] = array('regcode'  =>$INPUT_POST['inputRegcode'],
            'amount'  =>$INPUT_POST['inputAmount'],
            'tpass'   =>$INPUT_POST['inputTpass']
            );
        }else {
          $data['process'] = array(
            'P' =>0,
            'M' =>'FAILED'
            );
        }

      }else {
        $data['process'] = array(
          'P' =>0,
          'M' =>'FIRST'
          );

      }
      if (isset($_POST['btnConfirm'])) {  //SUBMIT IF SUCCESS 
        $INPUT_POST = $this->input->post(null,true);
        $url = url;
        $parameter =array(  
          'dev_id'          => $this->global_f->dev_id(),
          'actionId'        => _universal_loading,
          'ip_address'      => $this->ip,
          'regcode'               =>$this->user['R'],
          'receiver'              =>$INPUT_POST['inputRegcode'],
          'amount'                =>$INPUT_POST['inputAmount'],
          'transpass'             =>$INPUT_POST['inputTpass'],
          'ip'          =>$this->ip,
          $this->user['SKT']      =>  md5($this->user['R'].$this->user['SKT'].md5($INPUT_POST['inputTpass']))
          ); 

        $result = $this->curl->call($parameter,$url);
        $data['result'] = json_decode($result,true);
        
        if ($data['result']['S']  == 1) {
          $this->user['PB'] = $data['result']['PB'];
          $data['user'] = $this->global_f->get_user_session();
        } 

      }


      
      $this->load->view('layout/header',$data);
      $this->load->view('element/top_header');
      $this->load->view('element/wrapper_header');
      $this->load->view('element/left_panel');
      $this->load->view('fundtransfer/universal_load_wallet'); 
      $this->load->view('element/wrapper_footer');
      $this->load->view('layout/footer');
    }else {
      //$this->session->unset_userdata('user');
      $this->session->sess_destroy();
      redirect('Login/');
    }}else {
      //$this->session->unset_userdata('user');
      $this->session->sess_destroy();
      redirect('Main/');

    }
  }
  
  public function delete_temp_image($tmp_id_old)
  { 

    ////FTP DELETE USING CURL

        $ch = curl_init();
      $fp = fopen($localfile, 'r');
      curl_setopt($ch, CURLOPT_URL, 'ftp://'.ftp_server_radius.':800');
      curl_setopt($ch, CURLOPT_USERPWD, "argel:argel_argel!!!");
      curl_setopt($ch, CURLOPT_QUOTE, array("DELE /Fund_Request/".$tmp_id_old)); 
      curl_exec ($ch);
      $error_no = curl_errno($ch);
      curl_close ($ch);


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





  public function check_upload()
  {
    if ($this->user['A_CTRL']['fund_request'] == 1 || $this->user['A_CTRL']['fundrequest'] == 1){
      $data = array('menu' => 7,'parent'=>'' );
      if ($this->user['S'] == 1 && $this->user['R'] !=""){
        $data['user'] = $this->user;
        
        if (null !==$this->input->post('btnReset')) //check if reset button
        {
          //delete from cloudinary
          $tmp_id_old = $this->session->userdata('image_pubid');
          $this->delete_temp_image($tmp_id_old);

          $data['result'] = array("S"=>1,'M'=>"Reset");
          $data['process'] = array('process' =>0,'M' =>'FIRST');

          //unset
          $this->session->unset_userdata('image_pubid');

          redirect('Fundtransfer/fund_transfer');
        }
        
        if (null !==$this->input->post('btnUpload')) //SEARCH FOR REGCODE
        {
          $data['upload'] = array("success"=>0);
          $img = $_FILES['file']['name'];
          $ext = explode(".", $_FILES['file']['name']);
          $extension = end($ext); 

          if (strtoupper($extension) == "JPG" || strtoupper($extension) == "JPEG" || strtoupper($extension) == "PNG"){
              
            if ($_FILES['file']['error'] == 0){

              if($_FILES['file']['size'] < 4*MB) {

                $url = $_FILES["file"]["tmp_name"];
                if($_FILES['file']['size'] > 2*MB)
                {
                  $old_size = $_FILES['file']['size'];
                        $urltmp = sys_get_temp_dir().'/tmp.jpg';
                      $filename = $this->compress_image($_FILES["file"]["tmp_name"], $urltmp, 75);
                      $new_size = filesize($urltmp);
                      
                      if($new_size < $old_size)
                      {
                        $url = $urltmp;
                      }
                }

                if($this->session->has_userdata('image_pubid'))
                {
                  $tmp_id = $this->session->userdata('image_pubid');
                }
                else
                {
                  $tmp_id = $this->user['R'] . '_web_tmp.jpg'; //create a temporary id first to upload
                }

                if (false) {//ftp
                  $ch = curl_init();
                  $localfile = $url;
                  $fp = fopen($localfile, 'r');
                  // curl_setopt($ch, CURLOPT_URL, 'ftp://210.213.236.42:800/Fund_Request/'.$tmp_id);
                  // curl_setopt($ch, CURLOPT_USERPWD, "argel:argel_argel!!!");
                  // curl_setopt($ch, CURLOPT_URL, 'ftp://frequest:frequest@210.213.236.42:800/Fund_Request/'.$tmp_id);
                  // curl_setopt($ch, CURLOPT_USERPWD, ftp_user_pass);
                  //curl_setopt($ch, CURLOPT_URL, 'ftp://35.186.159.201/'.$tmp_id);
                  //curl_setopt($ch, CURLOPT_USERPWD, "fundrequest:fundrequest!@#");
                  //curl_setopt($ch, CURLOPT_UPLOAD, 1);
                  //curl_setopt($ch, CURLOPT_INFILE, $fp);
                  //curl_setopt($ch, CURLOPT_INFILESIZE, filesize($localfile));
                  //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                  //curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                  //curl_setopt($ch, CURLOPT_TIMEOUT, 300);
                  //curl_setopt($ch, CURLOPT_POST, 1);
                  //curl_setopt($ch, CURLOPT_PORT, 800);
                  // curl_exec ($ch);
                  //$msg_error = curl_error($ch);
                  //$output = curl_exec($ch);
                  //$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                  //$error_no = curl_errno($ch);
                  //curl_close ($ch);
    
                  //curl_setopt($ch, CURLOPT_URL, 'ftp://35.186.159.201/'.$tmp_id);
                  //curl_setopt($ch, CURLOPT_USERPWD, "fundrequest:fundrequest!@#");
                  curl_setopt($ch, CURLOPT_URL, 'ftp://'.ftp_server.':800/Fund_Request/'.$tmp_id);
                  curl_setopt($ch, CURLOPT_USERPWD, "argel:argel_argel!!!");
                  curl_setopt($ch, CURLOPT_UPLOAD, 1);
                  curl_setopt($ch, CURLOPT_INFILE, $fp);
                  curl_setopt($ch, CURLOPT_INFILESIZE, filesize($localfile));
                  curl_exec ($ch);
                  $error_no = curl_errno($ch);
                  curl_close ($ch);
                    
                    // check upload status
                  if ($error_no == 0)
                  { 
                    ////if success 
                    $data['upload'] = array('success'=>1);
                    $array_msg2 = array('success'=>1,'M'=>'Upload Successful! Please proceed to STEP 2 below');
                    $this->session->set_flashdata('msgsuccess',$array_msg2);
                    $this->session->set_userdata('image_pubid', $tmp_id); //save session of temp id
                  } 
                  else 
                  {
                    $data['upload'] = array("success"=>0);
                    $data['result'] = array("S"=>0,'M'=>"Upload Incomplete! Please try again and upload ".$error_no);
                    $data['process'] = array('process' =>0,'M' =>'FIRST');
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
                    CURLOPT_POSTFIELDS => array('file'=> new CURLFILE($localfile),'file_location' => 'fundrequest','regcode' => $this->user['R'],'email' => '123','ext_name' => '.jpg'),
                  ));
                  
                  $response = curl_exec($curl); 
                  curl_close($curl);
                  $upload_response = json_decode($response,true);

                  if ($upload_response['S'] == 1)
                  { 
                    $filename = $upload_response['F'];
                    ////if success 
                    $data['upload'] = array('success'=>1);
                    $array_msg2 = array('success'=>1,'M'=>'Upload Successful! Please proceed to STEP 2 below');
                    $this->session->set_flashdata('msgsuccess',$array_msg2);
                    $this->session->set_userdata('image_pubid', $filename); //save session of temp id
                  } 
                  else //failed upload
                  {
                    $data['upload'] = array("success"=>0);
                    $data['result'] = array("S"=>0,'M'=>$upload_response['M']);
                    $data['process'] = array('process' =>0,'M' =>'FIRST');
                  }
                }
                
              }
              else
              {
                $data['result'] = array("S"=>0,'M'=>"Invalid Image Size, Should be less than 4MB");
                $data['process'] = array('process' =>0,'M' =>'FIRST');
              }

            }
            else
            {
              $data['result'] = array("S"=>0,'M'=>"Invalid Image Size, Should be less than 4MB");
              $data['process'] = array('process' =>0,'M' =>'FIRST');
            }
          }else {
            $data['result'] = array("S"=>0,'M'=>"Invalid Photo");
            $data['process'] = array('process' =>0,'M' =>'FIRST');
          }
        }else {
          $data['process'] = array('process' =>0,'M' =>'FIRST');
        }
      }else {

        $this->session->sess_destroy();
        redirect('Login/');

      }

      $this->load->view('layout/header',$data);
      $this->load->view('element/top_header');
      $this->load->view('element/wrapper_header');
      $this->load->view('element/left_panel');
      $this->load->view('fundtransfer/fund_transfer'); 
      $this->load->view('element/wrapper_footer');
      $this->load->view('layout/footer'); 
    } else {

      $this->session->sess_destroy();
      redirect('Login/');

    } 
  }
        
  public function check_uploadtest()
  {
    if ($this->user['A_CTRL']['fund_request'] == 1 || $this->user['A_CTRL']['fundrequest'] == 1){
      $data = array('menu' => 7,'parent'=>'' );
      if ($this->user['S'] == 1 && $this->user['R'] !=""){
        $data['user'] = $this->user;
        
        if (null !==$this->input->post('btnReset')) //check if reset button
        {
          //delete from cloudinary
          $tmp_id_old = $this->session->userdata('image_pubid');
          $this->delete_temp_image($tmp_id_old);

          $data['result'] = array("S"=>1,'M'=>"Reset");
          $data['process'] = array('process' =>0,'M' =>'FIRST');

          //unset
          $this->session->unset_userdata('image_pubid');

          redirect('Fundtransfer/fund_transfer');
        }

        if (null !==$this->input->post('btnUpload')) //SEARCH FOR REGCODE
        {

          $data['upload'] = array("success"=>0);
          $img = $_FILES['file']['name'];
          $ext = explode(".", $_FILES['file']['name']);
          $extension = end($ext); 


          if (strtoupper($extension) == "JPG" || strtoupper($extension) == "JPEG" || strtoupper($extension) == "PNG"){
  
              
            if ($_FILES['file']['error'] == 0){

              if($_FILES['file']['size'] < 4*MB) {

                $url = $_FILES["file"]["tmp_name"];
                if($_FILES['file']['size'] > 2*MB)
                {
                  $old_size = $_FILES['file']['size'];
                  $urltmp = sys_get_temp_dir().'/tmp.jpg';
                  $filename = $this->compress_image($_FILES["file"]["tmp_name"], $urltmp, 75);
                  $new_size = filesize($urltmp);
                  
                  if($new_size < $old_size)
                  {
                    $url = $urltmp;
                  }
                }

                if($this->session->has_userdata('image_pubid'))
                {
                  $tmp_id = $this->session->userdata('image_pubid');
                }
                else
                {
                  $tmp_id = $this->user['R'] . '_web_tmp.jpg'; //create a temporary id first to upload
                }

                if (FALSE && $this->user['R'] != '1234567') {
                  $ch = curl_init();
                  $localfile = $url;
                  $fp = fopen($localfile, 'r');
                  // curl_setopt($ch, CURLOPT_URL, 'ftp://210.213.236.42:800/Fund_Request/'.$tmp_id);
                  // curl_setopt($ch, CURLOPT_USERPWD, "argel:argel_argel!!!");
                  // curl_setopt($ch, CURLOPT_URL, 'ftp://frequest:frequest@210.213.236.42:800/Fund_Request/'.$tmp_id);
                  // curl_setopt($ch, CURLOPT_USERPWD, ftp_user_pass);
                  //curl_setopt($ch, CURLOPT_URL, 'ftp://35.186.159.201/'.$tmp_id);
                  //curl_setopt($ch, CURLOPT_USERPWD, "fundrequest:fundrequest!@#");
                  //curl_setopt($ch, CURLOPT_UPLOAD, 1);
                  //curl_setopt($ch, CURLOPT_INFILE, $fp);
                  //curl_setopt($ch, CURLOPT_INFILESIZE, filesize($localfile));
                  //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                  //curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                  //curl_setopt($ch, CURLOPT_TIMEOUT, 300);
                  //curl_setopt($ch, CURLOPT_POST, 1);
                  //curl_setopt($ch, CURLOPT_PORT, 800);
                  // curl_exec ($ch);
                  //$msg_error = curl_error($ch);
                  //$output = curl_exec($ch);
                  //$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                  //$error_no = curl_errno($ch);
                  //curl_close ($ch);
  
                  //curl_setopt($ch, CURLOPT_URL, 'ftp://35.186.159.201/'.$tmp_id);
                  //curl_setopt($ch, CURLOPT_USERPWD, "fundrequest:fundrequest!@#");
                  curl_setopt($ch, CURLOPT_URL, 'ftp://'.ftp_server_radius.':800/Fund_Request/'.$tmp_id);
                  curl_setopt($ch, CURLOPT_USERPWD, "argel:argel_argel!!!");
                  curl_setopt($ch, CURLOPT_UPLOAD, 1);
                  curl_setopt($ch, CURLOPT_INFILE, $fp);
                  curl_setopt($ch, CURLOPT_INFILESIZE, filesize($localfile));
                  curl_exec ($ch);
                  $error_no = curl_errno($ch);
                  curl_close ($ch);
                
                  // check upload status
                  if ($error_no == 0)
                  { 
                    ////if success 
                    $data['upload'] = array('success'=>1);
                    $array_msg2 = array('success'=>1,'M'=>'Upload Successful! Please proceed to STEP 2 below');
                    $this->session->set_flashdata('msgsuccess',$array_msg2);
                    $this->session->set_userdata('image_pubid', $tmp_id); //save session of temp id
  
                  } 
                  else 
                  {
  
                    $data['upload'] = array("success"=>0);
                    $data['result'] = array("S"=>0,'M'=>"Upload Incomplete! Please try again and upload ".$error_no);
                    $data['process'] = array('process' =>0,'M' =>'FIRST');
                  }
                } else { //sftp upload
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
                    CURLOPT_POSTFIELDS => array('file'=> new CURLFILE($localfile),'file_location' => 'fundrequest','regcode' => $this->user['R'],'email' => '123','ext_name' => '.jpg'),
                  ));
                  
                  $response = curl_exec($curl); 
                  curl_close($curl);
                  $upload_response = json_decode($response,true);
                  
                  $filename = $upload_response['F'];

                  if ($upload_response['S'] == 1){ 
                    $data['upload'] = ['success'=>1];
                    $message = ['success'=>1,'M'=>'Upload Successful! Please proceed to STEP 2 below'];
                    $this->session->set_flashdata('msgsuccess',$message);
                    $this->session->set_userdata('image_pubid', $filename);
  
                  } else {
                    $data['upload'] = ['success'=>0];
                    $data['result'] = ['S'=>0,'M'=>$upload_response['M']];
                    $data['process'] = ['process' =>0,'M' =>'FIRST'];
                  }
                }
                
              }
              else
              {
                $data['result'] = array("S"=>0,'M'=>"Invalid Image Size, Should be less than 4MB");
                $data['process'] = array('process' =>0,'M' =>'FIRST');
              }

            }
            else
            {
              $data['result'] = array("S"=>0,'M'=>"Invalid Image Size, Should be less than 4MB");
              $data['process'] = array('process' =>0,'M' =>'FIRST');
            }

          } else {
            $data['result'] = array("S"=>0,'M'=>"Invalid Photo");
            $data['process'] = array('process' =>0,'M' =>'FIRST');
          }
        } else {
          $data['process'] = array('process' =>0,'M' =>'FIRST');

        }


      } else {

        $this->session->sess_destroy();
        redirect('Login/');

      }

      $this->load->view('layout/header',$data);
      $this->load->view('element/top_header');
      $this->load->view('element/wrapper_header');
      $this->load->view('element/left_panel');
      $this->load->view('fundtransfer/fund_transfertest'); 
      $this->load->view('element/wrapper_footer');
      $this->load->view('layout/footer'); 
    } else {

      $this->session->sess_destroy();
      redirect('Login/');

    } 
  }

        //-============================================ ORIGINAL FUND TRANSFER ============================================-
    //     public function fund_transfer(){

    //       if ($this->user['A_CTRL']['fund_request'] == 1 && $this->user['A_CTRL']['fundrequest'] == 1){
    //         $data = array('menu' => 7,'parent'=>'' );
    //         if ($this->user['S'] == 1 && $this->user['R'] !=""){
    //           $data['user'] = $this->user;

    //       if (null !==$this->input->post('btnSubmit')) //SEARCH FOR REGCODE
    //       {


    //         $url = url;
    //         $INPUT_POST = $this->input->post(null,true);
    //         $parameter =array(
    //           'dev_id'          => $this->global_f->dev_id(),
    //           'actionId'        => _fund_request,
    //           'ip_address'      => $this->ip,
    //           'regcode'               =>$this->user['R'],
    //           'mobileno'              =>$INPUT_POST['inputMobile'],
    //           'fundtype'              =>$INPUT_POST['selFund'],
    //           'deposittype'           =>$INPUT_POST['selDeposit'],
    //           'institution'           =>$INPUT_POST['inputBank'],
    //           'branchname'            =>$INPUT_POST['inputBranchName'],
    //           'currency'              =>$INPUT_POST['currency'],
    //           'inputtedamount'      =>$INPUT_POST['inputtedAmount'],
    //           'amount'                =>$INPUT_POST['inputAmount'],
    //           'refno'               =>$INPUT_POST['inputRef'],
    //           'datetime'              =>$INPUT_POST['inputDate'],
    //           'transpass'             =>$INPUT_POST['inputTpass'],
    //           'image_URL'           =>_ftp_url,
    //           $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($INPUT_POST['inputTpass']))
    //           );

    //         $tmp_id = $INPUT_POST['image_public_id'];
            
    //         $result = $this->curl->call($parameter,$url);
    //         $result = json_decode($result,true);


    //         if ($result['S'] == 1) 
    //         {

    //               $ftp_server = ftp_server;
    //               $ftp_port = ftp_port;
    //               $ftp_user_name = ftp_user_name;
    //               $ftp_user_pass = ftp_user_pass;
                  

    //                   // set up basic connection
    //               $conn_id = ftp_connect($ftp_server,$ftp_port);

    //                   // login with username and password
    //               $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass); 

    //               // check connection
    //               if ((!$conn_id) || (!$login_result))
    //               { 

    //             $data['result'] = array("S"=>0,'M'=>"Cannot process rename, FTP connection has failed!");
    //             $data['process'] = array('process' =>0,'M' =>'FIRST');

    //               }

    //                   if (ftp_chdir($conn_id, "Fund_Request")) 
    //                   {
    //               //echo "Current directory is now: " . ftp_pwd($conn_id) . "\n";
    //           } else{ 
    //             $data['result'] = array("S"=>0,'M'=>"Cannot change directory, FTP directory is unavailable");
    //             $data['process'] = array('process' =>0,'M' =>'FIRST');
    //           }

    //               $new_id = $result['TN'].'.jpg';

    //               // try to rename $old_file to $new_file
    //           if (ftp_rename($conn_id, $tmp_id, $new_id)) 
    //           {
    //             //echo "successfully renamed $old_file to $new_file\n";
    //           } 
    //           else 
    //           {
    //             $data['result'] = array("S"=>0,'M'=>"Cannot process rename, FTP rename has failed!");
    //             $data['process'] = array('process' =>0,'M' =>'FIRST');
    //           }


    //               // close the FTP stream 
    //               ftp_close($conn_id);

    //           // $file_array = array();
    //           // $file_url = array();
    //           // foreach ($_FILES as $key => $value) 
    //           // {
    //           //  array_push($file_array, $_FILES[$key]['tmp_name']);
    //           // }
              
    //           // require APPPATH.'/libraries/cloudinary/Cloudinary.php';
    //           // require APPPATH.'/libraries/cloudinary/Uploader.php';



    //           // \Cloudinary::config(array(
    //           //  "cloud_name" => "unifiedproductsandservices",
    //           //  "api_key" => "771772251668234",
    //           //  "api_secret" => "hFk5zXdh5ZPnggg2hqNi7dee6LQ"
    //           //  ));


    //           //RENAME TMP_NAME IN CLOUDINARY

    //           // $cloudUpload = \Cloudinary\Uploader::upload($file_array[$i],array("public_id" => $result['TN']));
    //           // $cloudUpload = \Cloudinary\Uploader::rename($tmp_id, $result['TN']);

    //           // array_push($file_url, $cloudUpload['secure_url']);
              
    //           // $URL = implode(',', $file_url);
    //             // $data['result'] = array('S'=>1,'TN'=>$result['TN'],'M'=>'Your Request is currently in process Please wait');
              
    //           $array_msg = array('S'=>1,'TN'=>$result['TN'],'M'=>'Your Request is currently in process Please wait');
    //           $this->session->set_flashdata('msg',$array_msg);
              

    //             //unset the temp image public id
    //           $this->session->unset_userdata('image_pubid');

    //           unset($_POST);
    //           unset($_POST['inputMobile']);
    //           unset($_POST['selFund']);
    //           unset($_POST['selDeposit']);
    //           unset($_POST['inputBank']);
    //           unset($_POST['inputBranchName']);
    //           unset($_POST['inputAmount']);
    //           unset($_POST['inputRef']);
    //           unset($_POST['inputDate']);
    //           unset($_POST['inputTpass']);

    //           redirect('Fundtransfer/fund_transfer');

    //         }else {
    //           $data['result'] = array("S"=>0,'M'=>$result['M']);
    //           $data['process'] = array('process' =>0,'M' =>'FIRST');

    //         }
            
    //       }else {
    //         $data['process'] = array('process' =>0,'M' =>'FIRST');
    //       }
    //     }else {

    //       $this->session->sess_destroy();
    //       redirect('Login/');

    //     }
    //     $this->load->view('layout/header',$data);
    //     $this->load->view('element/top_header');
    //     $this->load->view('element/wrapper_header');
    //     $this->load->view('element/left_panel');
    //     $this->load->view('fundtransfer/fund_transfer'); 
    //     $this->load->view('element/wrapper_footer');
    //     $this->load->view('layout/footer'); 
    //   }else {

    //     $this->session->sess_destroy();
    //     redirect('Login/');

    //   } 
    // }
    //-============================================ ORIGINAL FUND TRANSFER ============================================-
    
    public function fund_transfer(){
        if ($this->user['A_CTRL']['fund_request'] == 1 && $this->user['A_CTRL']['fundrequest'] == 1 || $this->user['R'] == 'F1526245'){
            $data = array('menu' => 7,'parent'=>'' );
            if ($this->user['S'] == 1 && $this->user['R'] !=""){
              $data['user'] = $this->user;

          if (null !==$this->input->post('btnSubmit')) //SEARCH FOR REGCODE
          {

            $filename = $this->session->userdata('image_pubid');
            $url = url;
            $INPUT_POST = $this->input->post(null,true);
            $parameter =array(
              'dev_id'          => $this->global_f->dev_id(),
              'actionId'        => _fund_request,
              'ip_address'      => $this->ip,
              'regcode'         =>$this->user['R'],
              'mobileno'        =>$INPUT_POST['inputMobile'],
              'fundtype'        =>$INPUT_POST['selFund'],
              'deposittype'     =>$INPUT_POST['selDeposit'],
              'institution'     =>$INPUT_POST['inputBank'],
              'branchname'      =>$INPUT_POST['inputBranchName'],
              'currency'        =>$INPUT_POST['currency'],
              'inputtedamount'  =>$INPUT_POST['inputtedAmount'],
              'amount'          =>$INPUT_POST['inputAmount'],
              'refno'           =>$INPUT_POST['inputRef'],
              'datetime'        =>$INPUT_POST['inputDate'],
              'transpass'       =>$INPUT_POST['inputTpass'],
              'image_URL'       =>_ftp_url,
              'sftp_dir'        =>'/v1-sftp/fundrequest/'.$filename,
              $this->user['SKT']=>  md5($this->user['R'].$this->user['SKT'].md5($INPUT_POST['inputTpass']))
            );

            $tmp_id = $INPUT_POST['image_public_id'];
            
            $result = $this->curl->call($parameter,$url);
            $result = json_decode($result,true);


            if ($result['S'] == 1) 
            {

                  $ftp_server = ftp_server_radius;
                  $ftp_port = ftp_port;
                  $ftp_user_name = ftp_user_name;
                  $ftp_user_pass = ftp_user_pass;
                  

                      // set up basic connection
                  $conn_id = ftp_connect($ftp_server,$ftp_port);

                      // login with username and password
                  $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass); 

                  // check connection
                  if ((!$conn_id) || (!$login_result))
                  { 

                $data['result'] = array("S"=>0,'M'=>"Cannot process rename, FTP connection has failed!");
                $data['process'] = array('process' =>0,'M' =>'FIRST');

                  }

                      if (ftp_chdir($conn_id, "Fund_Request")) 
                      {
                  //echo "Current directory is now: " . ftp_pwd($conn_id) . "\n";
              } else{ 
                $data['result'] = array("S"=>0,'M'=>"Cannot change directory, FTP directory is unavailable");
                $data['process'] = array('process' =>0,'M' =>'FIRST');
              }

                  $new_id = $result['TN'].'.jpg';

                  // try to rename $old_file to $new_file
              if (ftp_rename($conn_id, $tmp_id, $new_id)) 
              {
                //echo "successfully renamed $old_file to $new_file\n";
              } 
              else 
              {
                $data['result'] = array("S"=>0,'M'=>"Cannot process rename, FTP rename has failed!");
                $data['process'] = array('process' =>0,'M' =>'FIRST');
              }


                  // close the FTP stream 
                  ftp_close($conn_id);

              // $file_array = array();
              // $file_url = array();
              // foreach ($_FILES as $key => $value) 
              // {
              //  array_push($file_array, $_FILES[$key]['tmp_name']);
              // }
              
              // require APPPATH.'/libraries/cloudinary/Cloudinary.php';
              // require APPPATH.'/libraries/cloudinary/Uploader.php';



              // \Cloudinary::config(array(
              //  "cloud_name" => "unifiedproductsandservices",
              //  "api_key" => "771772251668234",
              //  "api_secret" => "hFk5zXdh5ZPnggg2hqNi7dee6LQ"
              //  ));


              //RENAME TMP_NAME IN CLOUDINARY

              // $cloudUpload = \Cloudinary\Uploader::upload($file_array[$i],array("public_id" => $result['TN']));
              // $cloudUpload = \Cloudinary\Uploader::rename($tmp_id, $result['TN']);

              // array_push($file_url, $cloudUpload['secure_url']);
              
              // $URL = implode(',', $file_url);
                // $data['result'] = array('S'=>1,'TN'=>$result['TN'],'M'=>'Your Request is currently in process Please wait');
              
              $array_msg = array('S'=>1,'TN'=>$result['TN'],'M'=>'Your Request is currently in process Please wait');
              $this->session->set_flashdata('msg',$array_msg);
              

                //unset the temp image public id
              $this->session->unset_userdata('image_pubid');

              unset($_POST);
              unset($_POST['inputMobile']);
              unset($_POST['selFund']);
              unset($_POST['selDeposit']);
              unset($_POST['inputBank']);
              unset($_POST['inputBranchName']);
              unset($_POST['inputAmount']);
              unset($_POST['inputRef']);
              unset($_POST['inputDate']);
              unset($_POST['inputTpass']);

              redirect('Fundtransfer/fund_transfer');

            }else {
              $data['result'] = array("S"=>0,'M'=>$result['M']);
              $data['process'] = array('process' =>0,'M' =>'FIRST');

            }
            
          }else {
            $data['process'] = array('process' =>0,'M' =>'FIRST');
          }
        }else {

          $this->session->sess_destroy();
          redirect('Login/');

        }
        $this->load->view('layout/header',$data);
        $this->load->view('element/top_header');
        $this->load->view('element/wrapper_header');
        $this->load->view('element/left_panel');
        $this->load->view('fundtransfer/fund_transfertest'); 
        $this->load->view('element/wrapper_footer');
        $this->load->view('layout/footer'); 
      }else {

        $this->session->sess_destroy();
        redirect('Login/');

      } 
    }

    // ADDED BY PABLO OCAMPO
    function getUSDConversion()
      {
            $TODAY = date("Y-m-d");
            
            $parameter = array(
          'dev_id'       => $this->global_f->dev_id(),
          'actionId'         => 'ups_shipping_service/usdconversion',
            'regcode'          =>$this->user['R'],
            'currency'   => $this->input->post('currency'),
            'ip_address'       => $this->ip,    
          $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
          );

          $result = $this->curl->call($parameter,url);
          $result = json_decode($result);
          echo json_encode($result);
            
      }
 // ADDED BY PABLO OCAMPO
     

    public function aed_fund()
    {
      if ($this->user['A_CTRL']['fund_request_AED'] == 1){
        $data = array('menu' => 7,
          'parent'=>'' );

        if ($this->user['S'] == 1 && $this->user['R'] !=""){
          $this->check_trans->gwlCheckTransLimit(144); //For Wealthylifestyle

          $data['user'] = $this->user;

          if($this->user['A_CTRL']['fund_request_AED'] == 1){

            if (null !==$this->input->post('btnSubmit')){
              $INPUT_POST = $this->input->post(null,true);

              $url = url;

              $parameter =array(
                'dev_id'          => $this->global_f->dev_id(),
                'actionId'        => _aed_fund_request,
                'ip_address'      => $this->ip,
                'ip'              => $this->ip,
                'regcode'               =>$this->user['R'],
                'd_regcode'             =>$INPUT_POST['inputRegcode'],
                'amount'                =>$INPUT_POST['inputAmount'],
                'transpass'             =>$INPUT_POST['inputTpass'],
                $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($INPUT_POST['inputTpass']))
                );

              $result = $this->curl->call($parameter,$url);
              $data['result'] = json_decode($result,true);

              if ($data['result']['AED'] != "") {
                $this->user['AB'] = $data['result']['AED'];
                $data['user'] = $this->global_f->get_user_session();
              } 

            }


            $this->load->view('layout/header',$data);
            $this->load->view('element/top_header');
            $this->load->view('element/wrapper_header');
            $this->load->view('element/left_panel');
            $this->load->view('fundtransfer/aedfund'); 
            $this->load->view('element/wrapper_footer');
            $this->load->view('layout/footer'); 

          } else{
          //$this->session->unset_userdata('user');
            $this->session->sess_destroy();
            redirect('Main/');
          }

        }else {
        //$this->session->unset_userdata('user');
          $this->session->sess_destroy();
          redirect('Main/');
        } 

      }else {
      //$this->session->unset_userdata('user');
      //$this->session->sess_destroy();
        redirect('Main/');
      } 
    } 



// for manual process for QATAR international fund
    public function qatar_fund()
    {
      if ($this->user['A_CTRL']['fund_request_QAR'] == 1){
        $data = array('menu' => 7,
          'parent'=>'' );

        if ($this->user['S'] == 1 && $this->user['R'] !=""){
          $this->check_trans->gwlCheckTransLimit(145); //For Wealthylifestyle

          $data['user'] = $this->user;

          // if($this->user['R'] == 'FH4762228' || $this->user['R'] == '1234567' || $this->user['R'] == 'AED0001' || $this->user['R'] == 'AED0002'){

            if (null !==$this->input->post('btnSubmit')){
              $INPUT_POST = $this->input->post(null,true);

              $url = url;

              $parameter =array(
                'dev_id'          => $this->global_f->dev_id(),
                'actionId'        => 'ups_funding_service/qatar_fundrequest',
                'ip_address'      => $this->ip,
                'ip'              => $this->ip,
                'regcode'               => $this->user['R'],
                'd_regcode'             => $INPUT_POST['inputRegcode'],
                'amount'                => $INPUT_POST['inputAmount'],
                'transpass'             => $INPUT_POST['inputTpass'],
                $this->user['SKT']    => md5($this->user['R'].$this->user['SKT'].md5($INPUT_POST['inputTpass']))
                );
            // print_r($parameter);exit();
              $result = $this->curl->call($parameter,$url);
              $data['result'] = json_decode($result,true);
            // print_r($data['result']);
              if ($data['result']['QAR'] != "") {
                $this->user['QB'] = $data['result']['QAR'];
                $data['user'] = $this->global_f->get_user_session();
              } 

            }


            $this->load->view('layout/header',$data);
            $this->load->view('element/top_header');
            $this->load->view('element/wrapper_header');
            $this->load->view('element/left_panel');
            $this->load->view('fundtransfer/qatarfund'); 
            $this->load->view('element/wrapper_footer');
            $this->load->view('layout/footer'); 

          // } else{
          //$this->session->unset_userdata('user');
            // $this->session->sess_destroy();
            // redirect('Main/');
          // }

        }else {
        //$this->session->unset_userdata('user');
          $this->session->sess_destroy();
          redirect('Main/');
        } 

      }else {
      //$this->session->unset_userdata('user');
      //$this->session->sess_destroy();
        redirect('Main/');
      } 
    }

  public function dpreturn() { 
    $txnid = $_GET['txnid'];
    $refno = $_GET['refno'];
    $status = $_GET['status'];
    $message = $_GET['message'];
    $digest = $_GET['digest'];
    
    // print_r($_GET);

    
    // $strline = $txnid.":".$refno.":".$status.":".$message.":".'Hz8X^w@g$'; //added by rene for dragonpay new pass
    $strline = $txnid.":".$refno.":".$status.":".$message.":".'5TY2bL2BqLD5Rq5'; //added by rene for dragonpay new pass
    $digest2 = sha1($strline);

    // print_r($digest);
    // print_r('</br> Digest2:'.$digest2);
    if($digest == $digest2) {
      // $parameter = array(
      // 'dev_id'         =>$this->global_f->dev_id(),
      // 'ip_address'     =>$this->ip,
      // 'ip'         =>$this->ip,
      // 'actionId'       =>'ups_funding_service/DP_update_stat',
      // 'regcode'          =>'',
      // 'txnid'            =>$txnid,
      // 'refno'            =>$refno,
      // 'digest'         =>$digest,
      // 'status'         =>$status,
      // 'message'          =>$message,
      // 'd41d8cd98f00b204e9800998ecf8427e'   =>  md5($this->user['SKT'])
      // );

      $parameter = array(
        'dev_id'        =>$this->global_f->dev_id(),
        'ip_address'    =>'10.10.1.123',
        'ip'        =>'10.10.1.123',
        'actionId'      =>'ups_funding_service/DP_update_stat',
        'regcode'           =>'1234567',
        'txnid'           =>$txnid,
        'refno'           =>$refno,
        'digest'          =>$digest,
        'status'          =>$status,
        'message'         =>$message,
        'd41d8cd98f00b204e9800998ecf8427e' =>  'd41d8cd98f00b204e9800998ecf8427e'
        // $this->user['SKT']    => md5($this->user['R'].$this->user['SKT'].md5($INPUT_POST['inputTpass']))
      );

      $api_result = $this->curl->call($parameter,url);
      $API = json_decode($api_result,true);
      // print_r($parameter);
      // print_r($API);
      // $this->user

      if($API['S'] == 1){
        if($status == 'F') {
          echo "<center><div class='alert alert-danger' style='color:red'><h2>$message</br></br>Tracking Number: $API[TN]</br>Reference Number: $API[RN]</br></h2>
          <i><h3>Your Email address could possibly be flagged by DragonPay due to multiple transactions within a given time period.</br>
          Kindly wait for 3 to 5 days before you can purchase again. </h3></i></div></center>";
        } elseif($status == 'P') {
          echo "<center><div class='alert alert-success' style='color:green'><h2>Transaction Posted</br></h2></br><h3>Tracking Number: $txnid</br>Reference Number: $refno</h3></br></br><i>$status: $message</i></div></center>";
        } else {
          echo "<center><div class='alert alert-success'><h2>$API[M]</h2></br><h3>Tracking Number: $API[TN]</br>Reference Number: $API[RN]</h3></div></center>";
        }
      } else {
        if($status == 'P') {
          echo "<center><div class='alert alert-success' style='color:green'><h2>Transaction Posted</br></h2></br><h3>Tracking Number: $txnid</br>Reference Number: $refno</h3></br></br><i>$status: $message</i></div></center>";
        } else {
          echo "<center><div class='alert alert-danger' style='color:red'><h2></br></h2></br><h3>Tracking Number!: $txnid</br>Reference Number: $refno</h3></br></br><i>$status: $message</i></div></center>";
        }
        // echo "<center><div class='alert alert-danger' style='color:red'><h2>$message</br></br>Tracking Number: $txnid</br>Reference Number: $refno</br></h2>
        // <i><h3>Your Email address could possibly be flagged by DragonPay due to multiple transactions within a given time period.</br>
        // Kindly wait for 3 to 5 days before you can purchase again. </h3></i></div></center>";
      }
    } else {
      echo "<center><div style='color:red'><h2>Invalid Digest, Please contact our 24/7 Customer Service Representatives and send the screen copy of the above message</h2></div></center>";
    }

  }

 //  public function dppostback()
   //{

  //  $txnid    = $this->input->post('txnid');
   // $refno    = $this->input->post('refno');
  //  $status   = $this->input->post('status');
  //  $message  = $this->input->post('message');
   // $digest   = $this->input->post('digest');

    // print_r($_POST);

    //$strline = $txnid.":".$refno.":".$status.":".$message.":".'Hz8X^w@g$';
  //  $digest2 = sha1($strline);

    // print_r('digest2: '.$digest2);
    // print_r('</br>digest: '.$digest);

  //  if($digest == $digest2)
   // {

   //  $parameter = array(
   //  'dev_id'         => $this->global_f->dev_id(),
   //  'ip_address'     => $this->ip,
   //  'ip'             => $this->ip,
   //  'actionId'       =>  _DP_fund_request_upd,
   //  'regcode'        => '1234567',
   //  'txnid'          => $txnid,
   //  'refno'          => $refno,
  //   'digest'         => $digest,
   //  'status'         => $status,
   //  'message'        => $message,
    // 'amount'         => $amount,
    // 'ccy'            => 'PHP',
    // 'd41d8cd98f00b204e9800998ecf8427e'  =>  md5($this->user['R'].$this->user['SKT'])
    // );

    // $api_result = $this->curl->call($parameter,url);
    // $API = json_decode($api_result,true);

   //  if($API['S'] == 1)
    // {
   //    echo "result=OK";
    // }
    // else
    // {
    //   echo "result=".$API['M'];
    // }
      

    //}
   // else
   // {

    //   // echo "<br/>Invalid Digest<br/>";
    //    // echo $_POST['txnid'].":".$_POST['refno'].":".$_POST['status'].":".$_POST['message'].":".$passkey;
     //   // $message = array('S'=>0, 'M'=>'Invalid Digest');
    //    // echo json_encode($message);
    //    echo "result=FAIL_DIGEST_MISMATCH";
   // }
  // }
   


    public function dragonpay_topup()
    {
      if ($this->user['A_CTRL']['fund_request'] == 1 || $this->user['A_CTRL']['fundrequest'] == 1 && $this->user['A_CTRL']['fundrequest_DP'] == 1)
      {
          $data = array('menu' => 7,
            'parent'=>'' );

              $parameter = array(
        'dev_id'         =>$this->global_f->dev_id(),
        'ip_address'     =>$this->ip,
        'ip'            =>$this->ip,
        'actionId'       => _check_user_agreement,
        'regcode'        =>$this->user['R'],
        $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
        );
        $result = $this->curl->call($parameter,url);
        $check_agreement = json_decode($result,true);

      if($check_agreement['S'] == 2)
      {
        $data['process'] = 999;
        $data['content'] = $check_agreement['Content'];
      }

        if ($this->user['S'] == 1 && $this->user['R'] !="")
        {
            $data['user'] = $this->user;

            $is_submit = $this->input->post('inputdragonpaysubmit');

            if(isset($is_submit))
            {

              if($this->input->post('inputAmount') > 60 && $this->input->post('inputAmount') < 50000)
              {

            $parameter = array(
            'dev_id'        =>$this->global_f->dev_id(),
            'ip_address'    =>$this->ip,
            'ip'        =>$this->ip,
            'actionId'    => _generate_tracking_reload_DP,
            'regcode'          =>$this->user['R'],
            $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
            );

            $api_result = $this->curl->call($parameter,url);
            $API = json_decode($api_result,true);

            if ($API['S'] == 1) {
              $txnid = $API['TN'];
            }else{
              $txnid = '';
            }

            $email = $this->user['EA'];
            // $email = 'yajdc0000@gmail.com';

            $merchantid = merchantid_DP;
            $passkey = passkey_DP;

            $amount = $this->input->post('inputAmount');
            $transpass = $this->input->post('inputTranspass');
            // $charge = 25.00; //CHARGE
            
            // $total_amount = (number_format($amount, 2) + number_format($charge, 2) );
            // $total_amount = number_format($total_amount, 2);

            
            $ccy = 'PHP';
            $description = 'PAYMENT';

                    $strline = $merchantid.':'.$txnid.':'.$amount.':'.$ccy.':'.$description.':'.$email.':'.$passkey;
                    // echo $strline;
                    $digest = sha1($strline);
                    //echo $digest;

                    // echo 'TRACKING ID: '.$txnid;

            $dragonpayURL = 'https://secure.dragonpay.ph/Pay.aspx?merchantid='.$merchantid.'&txnid='.$txnid.'&amount='.$amount.'&ccy='.$ccy.'&description='.$description.'&email='.$email.'&digest='.$digest;

            $data['inputdragonpayURL'] = $dragonpayURL;

            $data['amount'] = $amount;
            $data['email'] = $email;
            $data['txnid'] = $txnid;


            $parameter_insert = array(
            'dev_id'        =>$this->global_f->dev_id(),
            'ip_address'    =>$this->ip,
            'ip'        =>$this->ip,
            'actionId'      =>_DP_fund_request,
            'regcode'           =>$this->user['R'],
            'email'           =>$this->user['EA'],
            'txnid'           =>$txnid,
            'ccy'             =>'PHP',
            'digest'          =>$digest,
            'amount'          =>$amount,
            'transpass'         =>$transpass,
            $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
            );

            $api_insert = $this->curl->call($parameter_insert,url);
            $API_insert = json_decode($api_insert,true);

        if($API_insert['S']==1){

          $data['process'] = 1;
           // echo "<center><div><h2>$API_insert[M]</br>Tracking Number: $API_insert[TN]</br>Reference Number: $API_insert[RN]</h2></div></center>";
          
        }
            else
            {
              // echo "<center><div style='color:red'><h2>$API_insert[M]</br></h2></div></center>";
              $data['result'] = array("S"=>0,'M'=>$API_insert['M']);

            }

              }
              else
              {
                $data['result'] = array("S"=>0,'M'=>'Invalid Amount, Amount must be greater than P60.00 and less than P50,000.00');
              }


                        
          }

          $this->load->view('layout/header',$data);
          $this->load->view('element/top_header');
          $this->load->view('element/wrapper_header');
          $this->load->view('element/left_panel');
          $this->load->view('fundtransfer/dragonpay_topup'); 
          $this->load->view('element/wrapper_footer');
          $this->load->view('layout/footer'); 

        }
        else
        {
          //$this->session->unset_userdata('user');
          $this->session->sess_destroy();
          redirect('Login/');
        }


      }
      else
      {
      //$this->session->unset_userdata('user');
      //$this->session->sess_destroy();
        redirect('Main/');

      }
    }

    function get_transaction_dp(){
      $dataCount = $this->input->post('dataCount');
      $pCount = $this->input->post('pCount');

      $param_fetch = array(
        'dev_id'      =>  $this->global_f->dev_id(),
        'ip_address'  =>  $this->ip,
        'ip'          =>  $this->ip,
        'dataCount'   =>  $dataCount,
        'pCount'      =>  $pCount,
        'actionId'    => 'ups_funding_service/fetchTransactions',
        'regcode'     =>  $this->user['R']
      );

      $api_fetch = $this->curl->call($param_fetch,url);
      $API_FETCH = json_decode($api_fetch,true);

      echo json_encode($API_FETCH);
    }


    public function hkd_fund()
    {
      if ($this->user['A_CTRL']['fund_request_HKD'] == 1){
        $data = array('menu' => 7,
          'parent'=>'' );

        if ($this->user['S'] == 1 && $this->user['R'] !=""){
          $this->check_trans->gwlCheckTransLimit(146); //For Wealthylifestyle

          $data['user'] = $this->user;

          if($this->user['A_CTRL']['fund_request_HKD'] == 1){

            if (null !==$this->input->post('btnSubmit')){
              $INPUT_POST = $this->input->post(null,true);

              $url = url;

              $parameter =array(
                'dev_id'          => $this->global_f->dev_id(),
                'actionId'        => _hkd_fund_request,
                'ip_address'      => $this->ip,
                'ip'              => $this->ip,
                'regcode'               =>$this->user['R'],
                'd_regcode'             =>$INPUT_POST['inputRegcode'],
                'amount'                =>$INPUT_POST['inputAmount'],
                'transpass'             =>$INPUT_POST['inputTpass'],
                $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($INPUT_POST['inputTpass']))
                );

              $result = $this->curl->call($parameter,$url);
              $data['result'] = json_decode($result,true);

              if ($data['result']['HKD'] != "") {
                $this->user['HKD'] = $data['result']['HKD'];
                $data['user'] = $this->global_f->get_user_session();
              } 

            }


            $this->load->view('layout/header',$data);
            $this->load->view('element/top_header');
            $this->load->view('element/wrapper_header');
            $this->load->view('element/left_panel');
            $this->load->view('fundtransfer/hkdfund'); 
            $this->load->view('element/wrapper_footer');
            $this->load->view('layout/footer'); 

          } else{
          //$this->session->unset_userdata('user');
            $this->session->sess_destroy();
            redirect('Main/');
          }

        }else {
        //$this->session->unset_userdata('user');
          $this->session->sess_destroy();
          redirect('Main/');
        } 

      }else {
      //$this->session->unset_userdata('user');
      //$this->session->sess_destroy();
        redirect('Main/');
      } 
    } 


    public function forextoecash_old()
    {
      if ($this->user['A_CTRL']['fund_request'] == 1 || $this->user['A_CTRL']['fundrequest'] == 1){
        $data = array('menu' => 7,
          'parent'=>'' );

      if ($this->user['S'] == 1 && $this->user['R'] !=""){

        $data['user'] = $this->user;

        if($this->user['A_CTRL']['fund_request_ForexEcash'] == 1){

          if (isset($_POST['btnSubmit'])) {
              $url = url;
              
              $parameter =array(
                    'dev_id'        => $this->global_f->dev_id(),
                    // 'actionId'       => _forextransfer_to_ecash_confirm,
                    'actionId'      => 'ups_ecash_service/forextransfer_to_ecash_confirm',
                      'regcode'       => $this->user['R'],
                      'clientregcode'     => $this->input->post('inputDealersRegcode'),
                      'currency'      => $this->input->post('forexcurrtype'),
                      'amount'      => $this->input->post('inputAmountTransaction'),
                      'transpass'     => $this->input->post('inputTpass'),
                      'ip_address'    => $this->ip,
                      $this->user['SKT']  => md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
                      ); 

               // echo '<pre>';
                //  print_r($parameter);
                // echo '</pre>';
                // // die;

                $result = $this->curl->call($parameter,$url);
                $data['API'] = json_decode($result,true);

              //   echo '<pre>';
                //  print_r( $data['API'] );
                // echo '</pre>';

                if ($data['API']['S']  == 1) {
                
                if($data['API']['C'] == 'SGD')
                {
                  $this->user['SB'] = $data['API']['FA'];
                }
                elseif($data['API']['C'] == 'AED')
                {
                  $this->user['AB'] = $data['API']['FA'];
                }
                elseif($data['API']['C'] == 'HKD')
                {
                  $this->user['HKD'] = $data['API']['FA'];
                }
                else
                {
                  $this->user['QB'] = $data['API']['FA'];
                }
                

                if($this->user['R'] == $this->input->post('inputDealersRegcode')) {
                  $this->user['EC'] = $data['API']['EC'];
                }
                

                $data['user'] = $this->global_f->get_user_session();

                unset($_POST);

                $array_msg = array('S'=>1,'TN'=>$data['API']['TN'],'M'=>$data['API']['M']);
                $this->session->set_flashdata('msg',$array_msg);
                // redirect('controller/method');
                redirect($_SERVER['REQUEST_URI']);
               } 
             
            }


          $this->load->view('layout/header',$data);
          $this->load->view('element/top_header');
          $this->load->view('element/wrapper_header');
          $this->load->view('element/left_panel');
          $this->load->view('fundtransfer/forex_to_ecash');
          $this->load->view('element/wrapper_footer');
          $this->load->view('layout/footer'); 
          
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

    }else {
        //$this->session->unset_userdata('user');
        //$this->session->sess_destroy();
        redirect('Main/');
      } 

    }


    public function check_balanceafter(){
      $CURRTYPE = $this->input->post('currtype');
      $AMOUNT = $this->input->post('inputAmountTransaction');
      
      $data['user'] = $this->user;

      $parameter =array(
      'dev_id'        => $this->global_f->dev_id(),
      'actionId'          => 'ups_ecash_service/forexecash_currencyrates', 
      'ip_address'    => $this->ip, 
      'regcode'           => $this->user['R'],
      'amount'            => $AMOUNT,
      'currency'          => $CURRTYPE,
      $this->user['SKT']  =>  md5($this->user['R'].$this->user['SKT'])
        ); 

        $result = $this->curl->call($parameter,url);
        $result = json_decode($result);
        echo json_encode($result);
    }


    public function forextoecash_new()
    {
      if ($this->user['A_CTRL']['fund_request_ForexEcash'] == 1){
        $data = array('menu' => 7,
          'parent'=>'' );

      if ($this->user['S'] == 1 && $this->user['R'] !=""){
        $this->check_trans->gwlCheckTransLimit(157); //For Wealthylifestyle

        $data['user'] = $this->user;

        if($this->user['A_CTRL']['fund_request_ForexEcash'] == 1){

          if (isset($_POST['btnSubmit'])) {
              $url = url;
              
              $parameter =array(
                    'dev_id'        => $this->global_f->dev_id(),
                    // 'actionId'       => _forextransfer_to_ecash_confirm,
                    // 'actionId'       => 'ups_ecash_service/forextransfer_to_ecash_confirm_new',
                    'actionId'      => 'ups_ecash_service/forextransfer_to_ecash_confirm_latest',
                      'regcode'       => $this->user['R'],
                      'clientregcode'     => $this->input->post('inputDealersRegcode'),
                      'sourcetype'    => $this->input->post('sourceType'),
                      'currency'      => $this->input->post('forexcurrtype'),
                      'amount'      => $this->input->post('inputAmountTransaction'),
                      'transpass'     => $this->input->post('inputTpass'),
                      'ip_address'    => $this->ip,
                      $this->user['SKT']  => md5($this->user['R'].$this->user['SKT'].md5($this->input->post('inputTpass')))
                      ); 

               // echo '<pre>';
                //  print_r($parameter);
                // echo '</pre>';
                // // die;

                $result = $this->curl->call($parameter,$url);
                $data['API'] = json_decode($result,true);

              //   echo '<pre>';
                //  print_r( $data['API'] );
                // echo '</pre>';

                if ($data['API']['S']  == 1) {
                
                if($data['API']['C'] == 'SGD')
                {
                  $this->user['SB'] = $data['API']['FA'];
                }
                elseif($data['API']['C'] == 'AED')
                {
                  $this->user['AB'] = $data['API']['FA'];
                }
                elseif($data['API']['C'] == 'HKD')
                {
                  $this->user['HKD'] = $data['API']['FA'];
                }
                elseif($data['API']['C'] == 'MYR')
                {
                  $this->user['MYR'] = $data['API']['FA'];
                }
                else
                {
                  $this->user['QB'] = $data['API']['FA'];
                }
                

                if($this->user['R'] == $this->input->post('inputDealersRegcode')) {
                  $this->user['EC'] = $data['API']['EC'];
                }
                

                $data['user'] = $this->global_f->get_user_session();

                unset($_POST);

                $array_msg = array('S'=>1,'TN'=>$data['API']['TN'],'M'=>$data['API']['M']);
                $this->session->set_flashdata('msg',$array_msg);
                // redirect('controller/method');
                redirect($_SERVER['REQUEST_URI']);
               } 
             
            }


          $this->load->view('layout/header',$data);
          $this->load->view('element/top_header');
          $this->load->view('element/wrapper_header');
          $this->load->view('element/left_panel');
          $this->load->view('fundtransfer/forex_to_ecash_new');
          $this->load->view('element/wrapper_footer');
          $this->load->view('layout/footer'); 
          
        }else {
          //$this->session->unset_userdata('user');
          $this->session->sess_destroy();
          redirect('Main/');
        }

      }else {
        //$this->session->unset_userdata('user');
        $this->session->sess_destroy();
        redirect('Main/');
      }

    }else {
        //$this->session->unset_userdata('user');
        //$this->session->sess_destroy();
        redirect('Main/');
      } 

    }

    public function check_forexecash_rates(){
      $CURRTYPE = $this->input->post('currtype');
      $AMOUNT = $this->input->post('inputAmountTransaction');
      
      $data['user'] = $this->user;

      $parameter =array(
      'dev_id'        => $this->global_f->dev_id(),
      'actionId'          => 'ups_ecash_service/forexecash_rates', 
      'ip_address'    => $this->ip, 
      'regcode'           => $this->user['R'],
      'amount'            => $AMOUNT,
      'currency'          => $CURRTYPE,
      $this->user['SKT']  =>  md5($this->user['R'].$this->user['SKT'])
        ); 

        $result = $this->curl->call($parameter,url);
        $result = json_decode($result);
        echo json_encode($result);
    }

    public function sgd_fund()
    {
      if ($this->user['A_CTRL']['fund_request_SGD'] == 1){
        $data = array('menu' => 7,
          'parent'=>'' );

        if ($this->user['S'] == 1 && $this->user['R'] !=""){
          $this->check_trans->gwlCheckTransLimit(42); //For Wealthylifestyle

          $data['user'] = $this->user;

          if($this->user['A_CTRL']['fund_request_SGD'] == 1){

            if (null !==$this->input->post('btnSubmit')){
              $INPUT_POST = $this->input->post(null,true);

              $url = url;

              $parameter =array(
                'dev_id'          => $this->global_f->dev_id(),
                'actionId'        => 'ups_funding_service/sgd_fundrequest',
                'ip_address'      => $this->ip,
                'ip'              => $this->ip,
                'regcode'               =>$this->user['R'],
                'd_regcode'             =>$INPUT_POST['inputRegcode'],
                'amount'                =>$INPUT_POST['inputAmount'],
                'transpass'             =>$INPUT_POST['inputTpass'],
                $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($INPUT_POST['inputTpass']))
                );

              $result = $this->curl->call($parameter,$url);
              $data['result'] = json_decode($result,true);

              //echo "<pre>";
              //var_dump($this->user);
              //echo "</pre>";

              if ($data['result']['SGD'] != "") {
                $this->user['SB'] = $data['result']['SGD'];
                $data['user'] = $this->global_f->get_user_session();
              } 

            }

            $this->load->view('layout/header',$data);
            $this->load->view('element/top_header');
            $this->load->view('element/wrapper_header');
            $this->load->view('element/left_panel');
            $this->load->view('fundtransfer/sgdfund'); 
            $this->load->view('element/wrapper_footer');
            $this->load->view('layout/footer'); 

          } else{
          //$this->session->unset_userdata('user');
            $this->session->sess_destroy();
            redirect('Main/');
          }

        }else {
        //$this->session->unset_userdata('user');
          $this->session->sess_destroy();
          redirect('Main/');
        } 

      }else {
      //$this->session->unset_userdata('user');
      //$this->session->sess_destroy();
        redirect('Main/');
      } 
    }


    public function ecashv1_fundtransfer_v3()
    {
      if ($this->user['A_CTRL']['fund_request'] == 1 || $this->user['A_CTRL']['fundrequest'] == 1 && $this->user['A_CTRL']['ecash_fundtransfer_v1v3'] == 1){
        $data = array('menu' => 7,
          'parent'=>'' );

        if ($this->user['S'] == 1 && $this->user['R'] !=""){
          $data['user'] = $this->user;

          if (null !==$this->input->post('btnSubmit')){
            $INPUT_POST = $this->input->post(null,true);

            $url = url;

            $parameter =array(
              'dev_id'          => $this->global_f->dev_id(),
              'actionId'        => 'ups_ecash_service/get_ecashV1toV3_status',
              'ip_address'      => $this->ip,
              'ip'              => $this->ip,
              'regcode'               => $this->user['R'],
              'amount'                => $INPUT_POST['inputAmount'],
              'transpass'             => $INPUT_POST['inputTpass'],
              $this->user['SKT']    =>  md5($this->user['R'].$this->user['SKT'].md5($INPUT_POST['inputTpass']))
              );

            $result = $this->curl->call($parameter,$url);
            $data['result'] = json_decode($result,true);

            // echo "<pre>";
            // var_dump($data['result']);
            // echo "</pre>";

            if ($data['result']['EC'] != "") {
              $this->user['EC'] = $data['result']['EC'];
              $data['user'] = $this->global_f->get_user_session();
            } 

          }

          $this->load->view('layout/header',$data);
          $this->load->view('element/top_header');
          $this->load->view('element/wrapper_header');
          $this->load->view('element/left_panel');
          $this->load->view('fundtransfer/ecashv1_fundtransfer_v3'); 
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


    public function myr_fund()
    {
      if ($this->user['A_CTRL']['fund_request_MYR'] == 1){
        $data = array('menu' => 7,
          'parent'=>'' );

        if ($this->user['S'] == 1 && $this->user['R'] !=""){
          $data['user'] = $this->user;

          if($this->user['A_CTRL']['fund_request_MYR'] == 1){

            if (null !==$this->input->post('btnSubmit')){
              $INPUT_POST = $this->input->post(null,true);

              $url = url;

              $parameter =array(
                'dev_id'          => $this->global_f->dev_id(),
                'actionId'        => 'ups_funding_service/myr_fundrequest',
                'ip_address'      => $this->ip,
                'ip'              => $this->ip,
                'regcode'               =>$this->user['R'],
                'd_regcode'             =>$INPUT_POST['inputRegcode'],
                'amount'                =>$INPUT_POST['inputAmount'],
                'transpass'             =>$INPUT_POST['inputTpass'],
                $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'].md5($INPUT_POST['inputTpass']))
                );

              $result = $this->curl->call($parameter,$url);
              $data['result'] = json_decode($result,true);

              if ($data['result']['MYR'] != "") {
                $this->user['MYR'] = $data['result']['MYR'];
                $data['user'] = $this->global_f->get_user_session();
              } 

            }


            $this->load->view('layout/header',$data);
            $this->load->view('element/top_header');
            $this->load->view('element/wrapper_header');
            $this->load->view('element/left_panel');
            $this->load->view('fundtransfer/myrfund'); 
            $this->load->view('element/wrapper_footer');
            $this->load->view('layout/footer'); 

          } else{
          //$this->session->unset_userdata('user');
            $this->session->sess_destroy();
            redirect('Main/');
          }

        }else {
        //$this->session->unset_userdata('user');
          $this->session->sess_destroy();
          redirect('Main/');
        } 

      }else {
      //$this->session->unset_userdata('user');
      //$this->session->sess_destroy();
        redirect('Main/');
      } 
    }

  
}