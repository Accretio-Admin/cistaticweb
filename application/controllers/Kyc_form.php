<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Kyc_form extends CI_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	    $this->load->model('Curl_model','curl');
		$this->load->model('Check_transaction', 'check_trans');
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

	  	// if ($this->user['USER_KYC'] != 'APPROVED') 
		// {
		//   	redirect('Main');
		// }
	}

	public function index()
	{
		if ($this->user['A_CTRL']['remittance'] == 1){
            $data = array('menu' => 'kyc_form', 'parent'=>'REMITTANCE');
            
            if ($this->user['S'] == 1 && $this->user['R'] !=""){
                $data['mlm_user'] 	= $this->session->userdata('MLM_user');
                $data['user'] 		= $this->user;
                $data['regcode']	= $this->user['R'];
                $data['level'] 		= $this->user['L'];


                $this->load->view('remittance/kyc_form/index',$data); 
            }else {
                $this->session->sess_destroy();
                redirect('Login/');
            }

        }else {
            redirect('Main/');
        }
    }

	public function kyc_register(){
        $userlevel        = $this->input->post('userlevel');
        $fname            = $this->input->post('fname');
		$mname            = $this->input->post('mname');
		$lname            = $this->input->post('lname');
		$country          = $this->input->post('country');
		$province         = $this->input->post('province');
		$addressStreet    = $this->input->post('addressStreet');
		$addressCity      = $this->input->post('addressCity');
		$addressBrgy      = $this->input->post('addressBrgy');
		$addressZip       = $this->input->post('addressZip');
		$permanentAddress = $this->input->post('permanentAddress');
		$emailAdd         = $this->input->post('emailAdd');
		$mobile           = $this->input->post('mobile');
		$birthDate        = $this->input->post('birthDate');
		$placeOfBirth     = $this->input->post('placeOfBirth');
		$occupation       = $this->input->post('occupation');
		$sourceOfFund     = $this->input->post('sourceOfFund');
		$nationality      = $this->input->post('nationality');

		$id_attachment1   = $this->input->post('id_attachment1');
		$idType1          = $this->input->post('idType1');
		$idNumber1        = $this->input->post('idNumber1');
		$dateIssued1      = $this->input->post('dateIssued1');

		$id_attachment2   = $this->input->post('id_attachment2');
		$idType2          = $this->input->post('idType2');
		$idNumber2        = $this->input->post('idNumber2');
		$dateIssued2      = $this->input->post('dateIssued2');
	
		$signature_attachment = $this->input->post('signature_attachment');
		
		$url = url;

        $parameter = array(
			'dev_id'     	        => $this->global_f->dev_id(),
			'regcode' 		        => $this->user['R'],
			'actionId' 		        => 'ups_kyc_remittance/kyc_remittance',
			'userlevel'             => $userlevel,
			'fname'                 => $fname,
			'mname'                 => $mname,
			'lname'                 => $lname,
			'country'               => $country,
			'province'              => $province,
			'addressStreet'         => $addressStreet,
			'addressCity'           => $addressCity,
			'addressBrgy'           => $addressBrgy,
			'addressZip'            => $addressZip,
			'permanentAddress'      => $permanentAddress,
			'emailAdd'              => $emailAdd,
			'mobile'                => $mobile,
			'birthDate'             => $birthDate,
			'placeOfBirth'          => $placeOfBirth,
			'occupation'            => $occupation,
			'sourceOfFund'          => $sourceOfFund,
			'nationality'           => $nationality,
			'id_attachment1'        => "id_attachment1",
			'idType1'               => $idType1,
			'idNumber1'             => $idNumber1,
			'dateIssued1'           => $dateIssued1,
			'id_attachment2'        => "id_attachment2",
			'idType2'               => $idType2,
			'idNumber2'             => $idNumber2,
			'dateIssued2'           => $dateIssued2,
			'signature_attachment'  => "signature_attachment",
			'ip_address'            => $this->ip,
			$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
		); 

		$response = json_decode($this->curl->call($parameter, url), true);

		if($response['M']['M'] == 'SUCCESSFULLY ADDED NEW KYC, WAITING FOR APPROVAL' || $response['M']['M'] == 'SUCCESSFULLY UPDATED, WAITING FOR APPROVAL' ||  $response['M']['M'] == 'SUCCESSFULLY UPDATED' || $response['M']['M'] == 'SUCCESSFULLY ADDED NEW KYC BY HUB'){
			for($i = 1; $i <= 3; $i++){
				${'file'.$i} 			= $_FILES['file_upload'.$i];
				${'file'.$i.'Name'} 	= ${'file'.$i}['name'];
				${'file'.$i.'Size'}		= ${'file'.$i}['size'];
				${'file'.$i.'Temp'}		= ${'file'.$i}['tmp_name'];
				${'file'.$i.'Error'} 	= ${'file'.$i}['error'];
			}
			
			if($file1Size < 2*MB && $file3Size < 2*MB) {
	
				for($a = 1; $a <= 3; $a++){
	
					${'url'.$a} = ${'file'.$a.'Temp'};
					if(${'file'.$a.'Size'} > 1*MB)
					{
						${'old_size'.$a} = ${'file'.$a.'Size'};
						${'urltmp'.$a}	 = sys_get_temp_dir().'/tmp.jpg';
						
						${'filename'.$a} = $this->compress_image(${'file'.$a.'Size'}, ${'urltmp'.$a}, 75);
						${'new_size'.$a} = filesize(${'urltmp'.$a});
					
						if(${'new_size'.$a} < ${'old_size'.$a})
						{
							${'url'.$a} = ${'urltmp'.$a};
						}
					}
					
					${'curl'.$a} = curl_init();
					${'localfile'.$a} = ${'url'.$a};
				}
	
				for($i = 1; $i <= 3; $i++){
					curl_setopt_array(${'curl'.$i}, array(
						CURLOPT_URL => 'https://unified.ph/kyc-upload',
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_ENCODING => '',
						CURLOPT_MAXREDIRS => 10,
						CURLOPT_TIMEOUT => 0,
						CURLOPT_FOLLOWLOCATION => true,
						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						CURLOPT_CUSTOMREQUEST => 'POST',
						CURLOPT_POSTFIELDS => array('file'=> new CURLFILE(${'localfile'.$i}),'file_location' => 'kyc-remittance','regcode' => $this->user['R'],'email' => '123','ext_name' => '.jpg'),
					));
					
					${'response'.$i} = curl_exec(${'curl'.$i}); 
					curl_close(${'curl'.$i});
					${'upload_response'.$i} = json_decode(${'response'.$i},true);
				}
				
				$id1		= $upload_response1['F'];
				$id2 		= $upload_response2['F'];
				$signature 	= $upload_response3['F'];
				
				$params =array(
					'dev_id'     	        => $this->global_f->dev_id(),
					'regcode' 		        => $this->user['R'],
					'actionId' 		        => 'ups_kyc_remittance/upload_kyc_id',
					'fname'                 => $fname,
					'mname'                 => $mname,
					'lname'                 => $lname,
					'birthDate'             => $birthDate,
					'id_attachment1'        => $id1,
					'id_attachment2'        => $id2,
					'signature_attachment'  => $signature,
					'ip_address'            => $this->ip,
					$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'])
				); 
				
				$API = $this->curl->call($params,$url);
				$data['KYC_UPLOAD'] = json_decode($API,true);
			}
		}

		echo json_encode($response);
		exit;
    }


}

?>