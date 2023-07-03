<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Ecashloan extends CI_Controller {

   	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	    $this->load->model('Curl_model','curl');
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
		
        $data = array('menu' => 2,
        'parent'=>'ECASHLOAN' );
		// if ($this->user['A_CTRL']['emergency_ecash_loan'] == 1 && $this->user['QLS']['S'] != '0' && ($this->user['L']!='13' && $this->user['L']!='5')){
			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['user'] = $this->user;
				$this->load->view('ecashloan/index',$data);
			}else {
				$this->session->sess_destroy();
				redirect('Login/');
			}

		// }else {
		// 	redirect('Main/');
		// }
	}
	
	public function termsAndConditions(){
		$this->load->view('ecashloan/termsandconditions');
	}
    
    public function avail() {
		 
        $data = array('menu' => 2,
        'parent'=>'ECASHLOAN' );
		// if ($this->user['A_CTRL']['emergency_ecash_loan'] == 1 && $this->user['QLS']['S'] == '1' && ($this->user['L']!='13' && $this->user['L']!='5')){
			if ($this->user['S'] == 1 && $this->user['R'] !=""){
                $data['user'] = $this->user;
                if(isset($_POST['loanAmount']) && isset($_POST['transpass'])) {
                    $url = url;
                    $parameter =array(
                        'dev_id'=> $this->global_f->dev_id(),
                        'actionId'=> 'ups_ecash_loan_service',
                        'regcode'=>$this->user['R'],
                        'amount'=>$_POST['loanAmount'],
                        'transpass'=>$_POST['transpass'],
                        'ip_address'=>$this->ip,
                        $this->user['SKT'] => md5($this->user['R'].$this->user['SKT'].$_POST['transpass'])
                    );
                    $result = $this->curl->call($parameter,$url);
                    $result = json_decode($result);
					$ec = '';
					$result_s = null;
					$lid = null;
					// print_r($result);
                    if(is_object($result)) {
                        if ($result->S == 1) {
							$ec = $result->EC;
							$result_s=$result->S;
							$lid=$result->LID;
                        }
                    } else {
                        if ($result['S'] == 1) {
							$ec = $result['EC'];
							$result_s=$result->S;
							$lid=$result['LID'];
                        }
					} 
					if($result_s==1) {
						$this->user['EC'] = $ec;
						$this->user['QLS']['S'] = 2;
						$this->user['QLS']['LID'] = $lid;
						// $this->user['QLS']['AA'] = 0;
						// $this->user['A_CTRL']['remittance_eclf_send'] = 0;
						$this->user['A_CTRL']['remittance_ecsg_send'] = 0;
						$this->user['A_CTRL']['remittance_ecash_send'] = 0;
						$this->user['A_CTRL']['remittance_smartmoney_send'] = 0;
						$this->user['A_CTRL']['remittance_gprs_send'] = 0;
						$this->user['A_CTRL']['remittance_creditbank_send'] = 0;
						$this->user['A_CTRL']['remittance_ecad_send'] = 0;
						$this->user['A_CTRL']['remittance_baremi_send'] = 0;
						$this->user['A_CTRL']['remittance_westernunion_send'] = 0;
						$this->user['A_CTRL']['remittance_cebuana'] = 0;
						$this->user['A_CTRL']['remittance_egive_send'] = 0;
						// $this->user['A_CTRL']['remittance_ecash_forexconversion'] = 0;
						$data['user'] = $this->global_f->get_user_session();
					}
					$data['msg']=$result;     
                }
				$this->load->view('ecashloan/avail/index',$data);
			}else {
				$this->session->sess_destroy();
				redirect('Login/');
			}
		// }else {
		// 	redirect('Main/');
		// }
    }

    public function report(){
		// if ($this->user['A_CTRL']['emergency_ecash_loan'] == 1 && $this->user['QLS']['S'] != '0' && ($this->user['L']!='13' && $this->user['L']!='5')){
            $data['user'] = $this->user;
            
            $loanids = $this->curl->call(array(
                'dev_id'     		=> $this->global_f->dev_id(),
                'actionId'          => 'ups_report_service/ecashLoanID_types',
                'ip_address'		=> $this->ip,
                'regcode'           => $this->user['R'],
            ),url);
            $data['loanids'] = json_decode($loanids,true);
			if (isset($_POST['btnSearch'])) {
					$INPUT_POST = $this->input->post(null,true);
					// $data['field'] = array('loan_ID','Tracking #','Amount','type', 'dr_cr','Remaining ecash loan', 'date', 'time');
					$data['field'] = array('Fund_ID','Tracking #','Type','Description','Dr Cr','Amount','Emergency Fund Balance','Date');

					$url = 'ups_report_service/ecashLoan_report';
					$data['TBODY'] = 1;

				if ($url == "") {
					$data['process'] = array ('P'=>1,
							'S'=>0,
							'M'=>"No URL found!");
				}else {
                    $parameter = array(
                        'dev_id'     		=> $this->global_f->dev_id(),
                        'actionId'          => 'ups_report_service/ecashLoanID_details',
                        'ip_address'		=> $this->ip,
                        'regcode'           => $this->user['R'],
                        'loanid'            => $INPUT_POST['loanid']
                    );
					$result = $this->curl->call($parameter,url);
					$API = json_decode($result,true);
					// print_r($API);
					$data['API'] = $API;
					if ($API['S'] === 0) {
						$data['process'] = array ('P'=>1,
								'S'=>0,
								'M'=>$API['M']);
					}else {
						$data['process'] = array ('P'=>1,
								'S'=>1,
								'M'=>$API['M']);
					}
				}

            }
            
            // ups_report_service/ecashLoanID_types_post

            // parameter:
            // regcode
			// print_r($data['loanids']);

			$this->load->view('layout/header',$data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('ecashloan/reports/index');
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');
		// }else {
		// 	//$this->session->unset_userdata('user');
		// 	// print_r($this->user['QLS']);
		// 	redirect('Main/');
		// }
    }
}