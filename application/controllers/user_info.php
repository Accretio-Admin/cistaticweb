<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_info extends CI_Controller {

   	public function __construct()
	{
        parent::__construct();
		$this->load->model('curl_model','curl');
		$this->load->library('session');
		$this->user = $this->session->userdata('user');
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
    }

    public function index(){
        $data = array('parent'=>'ADDRESS' );

		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;

			$params =array(
				'dev_id'     		=> $this->global_f->dev_id(),
				'actionId'         	=> 'ups_report_service/get_UserAddressInfo', 
				'ip_address'		=> $this->ip,
				'regcode'           => $this->user['R'],
				$this->user['SKT']  =>  md5($this->user['R'].$this->user['SKT'])
			); 
			$result = $this->curl->call($params,url);
			$data['result'] = json_decode($result);
			// print_r($data['result']);die;
			
			if($this->user['L'] != 7) {
				if($data['result']->S == 1) {		
			  		$this->user['USER_COUNT'] = 1;
					$this->user['C_FLAG'] = $data['result']->DATA->presentCountry;
					$data['user'] = $this->global_f->get_user_session();
					
		  		} else {
		  			$this->user['USER_COUNT'] = 0;
					$this->user['C_FLAG'] = '';
					$data['user'] = $this->global_f->get_user_session();
		  		}
			}
	  	
		      $params1 =array(
						'dev_id'     		=> $this->global_f->dev_id(),
						'actionId'         	=> 'ups_kyc_registry/checkKYC', 
						'ip_address'		=> $this->ip,
						'regcode'           => $this->user['R'],
						$this->user['SKT']  =>  md5($this->user['R'].$this->user['SKT'])
					); 
		      $result1 = $this->curl->call($params1,url);
		      $data['kyc'] = json_decode($result1);
	
      //  print_r($data);
      //  die;
			
			if (isset($_POST['btnSubmit'])){
				$parameter =array(
					'dev_id'     		=> $this->global_f->dev_id(),
					'actionId'         	=> 'ups_report_service/userUpdateAddress', 
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

				$result = $this->curl->call($parameter,url);
				$data['API'] = json_decode($result,true);

				if($data['API']['S'] == 1){		
			  		$this->user['C_FLAG'] = $this->input->post('country');		  	
			  		$data['user'] = $this->global_f->get_user_session();

			  		unset($_POST);

					$array_msg = array('S'=>1,'M'=>$data['API']['M']);
					$this->session->set_flashdata('msg',$array_msg);
					// redirect('controller/method');
					redirect($_SERVER['REQUEST_URI']);
		  		}

			}

			$this->load->view('address/index',$data);
		}else {

			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}
	

}