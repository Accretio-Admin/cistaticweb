<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Kyc_upload extends CI_Controller {

   	public function __construct()
	{
        parent::__construct(); 
		$this->load->library('session'); 
        $this->load->model('curl_model','curl');
	    
    }

    public function index() {
        $this->load->view('kyc_upload/main');
    }

    public function upload() {
        try{     
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://unified.ph/kyc-upload',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => array('file'=> new CURLFILE('C:/Users/Public/Pictures/a.jpg'),'file_location' => 'remittance','regcode' => '1234567','email' => '','ext_name'=>''),
            ));
            
            $response = curl_exec($curl); 
            curl_close($curl);
            echo $response;

        }catch(Exception  $error) {
            print_r($error);
        }
    }
}