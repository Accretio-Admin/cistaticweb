<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Network extends CI_Controller {

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
	    $this->load->model('Query_model');
	  	$this->load->model('Global_function','global_f');
	  	$this->load->model('Sp_model');
//update by nhez 03/21/2017
	  	// $ACC_CONTROL = $this->Sp_model->userprivilege(); 
	   // 	$this->user['A_CTRL'] = $ACC_CONTROL['A_CTRL'];
	   // 	$this->session->set_userdata('user',$this->user);

	  	if ($this->user['RET'] == 1) {
	    	redirect('Main/');
		}
		//if($this->user['USER_KYC'] != 'APPROVED') {
		//	redirect('Main');
  		//}
	}

	public function index()
	{
		if ($this->user['A_CTRL']['networking'] == 1){
			$data = array('menu' => 13,
						 'parent'=>'' );
			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['user'] = $this->user;	
				$this->load->view('network/index',$data);
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

	public function genealogy($regcode=null)
	{

		if ($this->user['A_CTRL']['networking'] == 1){
			$data = array('menu' => 13,
						 'parent'=>'' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['user'] = $this->user;
				if ($regcode != "") {

					$url = url;
					$parameter =array(
						'dev_id'     => $this->global_f->dev_id(),
						'regcode'    => $this->user['R'],
						't_regcode'  => $regcode,
						'actionId'   => _get_network_genealogy,
						'ip_address' => $this->ip
			    	);
				}else {
					$url = url;
					$parameter =array(
						'dev_id'     => $this->global_f->dev_id(),
						'regcode'    => $this->user['R'],
						't_regcode'  => $this->user['R'],
						'actionId'   => _get_network_genealogy,
						'ip_address' => $this->ip
			    	);
					}
		    	$genealogy = json_decode($this->curl->call($parameter,$url),true);
		    	$arr = array();
			    	for ($i=0;$i<15;$i++) {
			    		if($genealogy['genealogy'][$i]['lvl']==1){
			    			$arr[$i]=$genealogy['genealogy'][$i];

			    		}elseif($genealogy['genealogy'][$i]['lvl']==2){
			    			if ($genealogy['genealogy'][$i]['pos'] =="L") {
			    				$arr[1] = $genealogy['genealogy'][$i];
			    				$lvll2 = $genealogy['genealogy'][$i]['reg_code'];
			    			}elseif($genealogy['genealogy'][$i]['pos'] =="R"){
								$arr[2] = $genealogy['genealogy'][$i];
								$lvlr2 = $genealogy['genealogy'][$i]['reg_code'];
			    			}
			    			
			    		}elseif($genealogy['genealogy'][$i]['lvl']==3){
			    				if ($genealogy['genealogy'][$i]['upline_reg_code']==$lvll2) {
			    					if ($genealogy['genealogy'][$i]['pos'] =="L") {
				    					$arr[3] = $genealogy['genealogy'][$i];
				    					$lvl3_L = $genealogy['genealogy'][$i]['reg_code'];
					    			}elseif($genealogy['genealogy'][$i]['pos'] =="R"){
										$arr[4] = $genealogy['genealogy'][$i];
										$lvl3_R = $genealogy['genealogy'][$i]['reg_code'];
					    			}
			    				}elseif($genealogy['genealogy'][$i]['upline_reg_code']==$lvlr2) {
			    					if ($genealogy['genealogy'][$i]['pos'] =="L") {
				    					$arr[5] = $genealogy['genealogy'][$i];
				    					$lvl4_L = $genealogy['genealogy'][$i]['reg_code'];
					    			}elseif($genealogy['genealogy'][$i]['pos'] =="R"){
										$arr[6] = $genealogy['genealogy'][$i];
										$lvl4_R = $genealogy['genealogy'][$i]['reg_code'];
					    			}
			    				}

			    		}elseif($genealogy['genealogy'][$i]['lvl']==4){
			    				if ($genealogy['genealogy'][$i]['upline_reg_code']==$lvl3_L) {
			    						if ($genealogy['genealogy'][$i]['pos'] =="L") {
					    					$arr[7] = $genealogy['genealogy'][$i];
					    					
						    			}elseif($genealogy['genealogy'][$i]['pos'] =="R"){
											$arr[8] = $genealogy['genealogy'][$i];
											
						    			}
			    				}elseif ($genealogy['genealogy'][$i]['upline_reg_code']==$lvl3_R) {
			    						if ($genealogy['genealogy'][$i]['pos'] =="L") {
					    					$arr[9] = $genealogy['genealogy'][$i];
					    					
						    			}elseif($genealogy['genealogy'][$i]['pos'] =="R"){
											$arr[10] = $genealogy['genealogy'][$i];
											
						    			}
			    				}elseif ($genealogy['genealogy'][$i]['upline_reg_code']==$lvl4_L) {
			    						if ($genealogy['genealogy'][$i]['pos'] =="L") {
					    					$arr[11] = $genealogy['genealogy'][$i];
					    					
						    			}elseif($genealogy['genealogy'][$i]['pos'] =="R"){
											$arr[12] = $genealogy['genealogy'][$i];
											
						    			}
			    				}elseif ($genealogy['genealogy'][$i]['upline_reg_code']==$lvl4_R) {
			    						if ($genealogy['genealogy'][$i]['pos'] =="L") {
					    					$arr[13] = $genealogy['genealogy'][$i];
					    					
						    			}elseif($genealogy['genealogy'][$i]['pos'] =="R"){
											$arr[14] = $genealogy['genealogy'][$i];
											
						    			}
			    				}
			    		}
			    	}
			    	$data['genealogy'] = $arr;
			    	
				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('network/genealogy'); 
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
	
	public function mydirectreferrals()
	{
		if ($this->user['A_CTRL']['networking'] == 1){
			$data = array('menu' => 13,
						  'parent'=>'' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['user'] = $this->user;

				$url = url;
				$parameter =array(
					'dev_id'     => $this->global_f->dev_id(),
					'regcode' 	 => $this->user['R'],
					'actionId' 	 => _get_direct_referral,
					'ip_address' => $this->ip
		    	);
		    	$data['direct_referrals'] = json_decode($this->curl->call($parameter,$url),true);

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('network/my_direct_referrals'); 
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');	
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
public function high5reports()
	{
		if ($this->user['A_CTRL']['networking'] == 1){
			$data = array('menu' => 13,
						  'parent'=>'' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['user'] = $this->user;

				$url = url;
				$parameter =array(
					'dev_id'     => $this->global_f->dev_id(),
					'regcode' 	 => $this->user['R'],
					'actionId' 	 => _get_high5_report,
					'ip_address' => $this->ip
		    	);
		    	$data['direct_referrals'] = json_decode($this->curl->call($parameter,$url),true);

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('network/my_high_five'); 
				$this->load->view('element/wrapper_footer');
				$this->load->view('layout/footer');	
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



	public function myindirectreferrals()
	{
		if ($this->user['A_CTRL']['networking'] == 1){
			$data = array('menu' => 13,
						 'parent'=>'' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['user'] = $this->user;

				$url = url;
				$parameter =array(
					'dev_id'     => $this->global_f->dev_id(),
					'regcode'	 => $this->user['R'],
					'actionId'   => _get_direct_referral,
					'ip_address' => $this->ip
		    	);
		    	$data['indirect_referrals'] = json_decode($this->curl->call($parameter,$url),true);
		    	// var_dump($data['indirect_referrals'] );
		    	// die();
				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('network/my_indirect_referrals'); 
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

	public function mypoints()
	{
		if ($this->user['A_CTRL']['networking'] == 1){
			$data = array('menu' => 13,
						 'parent'=>'' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['user'] = $this->user;

				$url = url;
				$parameter =array(
					'dev_id'     => $this->global_f->dev_id(),
					'regcode' 	 => $this->user['R'],
					'actionId' 	 => _get_network_summary,
					'ip_address' => $this->ip
		    	);

		    	$data['summary'] = json_decode($this->curl->call($parameter,$url),true)['summary'];


				$url = url;
				$parameter =array(
					'dev_id'     => $this->global_f->dev_id(),
					'regcode' 	 => $this->user['R'],
					'actionId'   => _get_weekly_payout,
					'ip_address' => $this->ip
		    	);

		    	$data['weekly_payout'] = json_decode($this->curl->call($parameter,$url),true)['weeklypayout'];
		    	//var_dump($data['weekly_payout'][0]);

				$url = url;
				$parameter =array(
					'dev_id'     => $this->global_f->dev_id(),
					'regcode' 	 => $this->user['R'],
					'actionId'   => _get_payout_history,
					'ip_address' => $this->ip
		    	);

		    	$data['payout_history'] = json_decode($this->curl->call($parameter,$url),true)['payouthistory'];

				$url = url;
				$parameter =array(
					'dev_id'     => $this->global_f->dev_id(),
					'regcode' 	 => $this->user['R'],
					'actionId'   => _get_right_downlines,
					'ip_address' => $this->ip
		    	);

		    	$data['right_downlines'] = json_decode($this->curl->call($parameter,$url),true)['rightdownlines'];

				$url = url;
				$parameter =array(
					'dev_id'     => $this->global_f->dev_id(),
					'regcode'    => $this->user['R'],
					'actionId'   => _get_left_downlines,
					'ip_address' => $this->ip
		    	);

		    	$data['left_downlines'] = json_decode($this->curl->call($parameter,$url),true)['leftdownlines'];
		    	//var_dump($data['left_downlines']);


				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('network/my_points'); 
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


	public function networkincome()
	{
		if ($this->user['A_CTRL']['networking'] == 1){
			$data = array('menu' => 13,
						 'parent'=>'' );
			
			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['user'] = $this->user;

				$url = url;
				$parameter =array(
					'dev_id'     => $this->global_f->dev_id(),
					'regcode' 	 => $this->user['R'],
					'actionId'   => _get_network_income,
					'ip_address' => $this->ip
		    	);

		    	$data['network_income'] = json_decode($this->curl->call($parameter,$url),true);

		    	$parameter['actionId'] = _get_network_MLM_income;
		    	// print_r($parameter['actionId']);
		    	$data['mlm_income'] = json_decode($this->curl->call($parameter,$url),true);
		    	// print_r($data['mlm_income']);

		    	if (null !== $this->input->post('btnConfrimEcash')) {
		    		$INPUT_POST = $this->input->post(null,true);
					$parameter =array(
						'dev_id'           => $this->global_f->dev_id(),
						'regcode' 	       => $this->user['R'],
						'actionId'         => _get_network_income_convert,
						'ip_address'       => $this->ip,
						'transpass'        => $INPUT_POST['inputTpass'],
						'amount'           => $INPUT_POST['inputTransferAmountecash'],
						'claimant'         => "",
						'payout_type'      => 1,
						$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'].md5($INPUT_POST['inputTpass']))
			    	);
			    	$data['results'] = json_decode($this->curl->call($parameter,$url),true);
		    	}

		    	if (null !== $this->input->post('btnConfrimCheque')) {
		    		$INPUT_POST = $this->input->post(null,true);
					$parameter =array(
						'dev_id'           => $this->global_f->dev_id(),
						'regcode' 	       => $this->user['R'],
						'actionId'         => _get_network_income_convert,
						'ip_address'       => $this->ip,
						'transpass'        => $INPUT_POST['inputTpass'],
						'amount'           => $INPUT_POST['inputTransferAmountcheque'],
						'claimant'         => "",
						'payout_type'      => 2,
						$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'].md5($INPUT_POST['inputTpass']))
			    	);
			    	$data['results'] = json_decode($this->curl->call($parameter,$url),true);
		    	}

		    	if (null !== $this->input->post('btnConfrimGC')) {
		    		$INPUT_POST = $this->input->post(null,true);
					$parameter =array(
						'dev_id'           => $this->global_f->dev_id(),
						'regcode' 	       => $this->user['R'],
						'actionId'         => _get_network_income_convert,
						'ip_address'       => $this->ip,
						'transpass'        => $INPUT_POST['inputTpass'],
						'amount'           => $INPUT_POST['inputGcToClaim'],
						'claimant'         => $INPUT_POST['inputName'],
						'payout_type'      => 3,
						$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'].md5($INPUT_POST['inputTpass']))
			    	);
			    	$data['results'] = json_decode($this->curl->call($parameter,$url),true);
		    	}

		    	if (null !== $this->input->post('btnMLMConfrimCheque')) {
		    		$INPUT_POST = $this->input->post(null,true);
					$parameter =array(
						'dev_id'           => $this->global_f->dev_id(),
						'regcode' 	       => $this->user['R'],
						'actionId'         => _get_network_MLMincome_convert,
						'ip_address'       => $this->ip,
						'transpass'        => $INPUT_POST['inputTpass'],
						'amount'           => $INPUT_POST['inputTransferAmountMLMcheque'],
						$this->user['SKT'] => md5($this->user['R'].$this->user['SKT'].md5($INPUT_POST['inputTpass']))
			    	);
			    	$data['results'] = json_decode($this->curl->call($parameter,$url),true);
		    	}

		    	//die();

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('network/network_income'); 
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


//MLM INCOME
	public function mlmincome()
	{
		if ($this->user['A_CTRL']['networking'] == 1){
			$data = array('menu' => 13,
						 'parent'=>'' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['user'] = $this->user;

				$url = url;
				$parameter =array(
					'dev_id'     => $this->global_f->dev_id(),
					'regcode' 	 => $this->user['R'],
					'actionId' 	 => _get_mlmincome_summary,
					'ip_address' => $this->ip
		    	);

		    	$result = $this->curl->call($parameter,url);
			    // print_r($result);
			   	$API = json_decode($result,true);
			   	// print_r($API);exit();
			   	
				if ($API['S'] === 0) {
						$data['process'] = array ('P'=>1,
											  'S'=>0,
											  'M'=>$API['M']);	
				}else {
						$data['process'] = array ('P'=>1,
											  'S'=>1,
											  'M'=>$API['M']);
				}
				$data['API'] = $API;

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('network/mlmincome'); 
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


	public function mlmincome_rebates()
	{
		if ($this->user['A_CTRL']['networking'] == 1){
			$data = array('menu' => 13,
						 'parent'=>'' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['user'] = $this->user;


				if (isset($_POST['btnSearch'])){
					$INPUT_POST = $this->input->post(null,true);
					
					$data['user'] = $this->user;

					$parameter =array(
								'dev_id'     		=> $this->global_f->dev_id(),
								'actionId'          => _mlm_rebates_report, 
								'ip_address'		=> $this->ip, 
			    				'regcode'           => $this->user['R'],
			    				'startdate'			=> $INPUT_POST['inputStart'],
			    				'enddate'			=> $INPUT_POST['inputEnd']
						    	); 
					// print_r($parameter);exit();
				    $result = $this->curl->call($parameter,url);
				    // print_r($result);
				   	$API = json_decode($result,true);

				   	// print_r($API);exit();
				   	if ($API['S'] == 1) {
			   			$data['process'] = array('P'=>1,
												 'S'=>1);
				   	}
				   		$data['API'] = $API;
				   		$date = array('startdate'=>$INPUT_POST['inputStart'],
				   					   'enddate'=>$INPUT_POST['inputEnd']);
				   		$this->session->set_userdata('inputdate',$date);

				} else {

					/* $url = url;
					$parameter =array(
						'dev_id'     => $this->global_f->dev_id(),
						'regcode' 	 => $this->user['R'],
						'actionId'   => _get_mlmincome_rebates,
						'ip_address' => $this->ip
			    	);

			    	$result = $this->curl->call($parameter,url);
				    // print_r($result);
				   	$API = json_decode($result,true);
				   	// print_r($API);exit();
				   	
					if ($API['S'] === 0) {
							$data['process'] = array ('P'=>1,
												  'S'=>0,
												  'M'=>$API['M']);	
					}else {
							$data['process'] = array ('P'=>1,
												  'S'=>1,
												  'M'=>$API['M']);
					}
					$data['API'] = $API; */
			    }

				$this->load->view('layout/short_header',$data);
				$this->load->view('network/mlmincome_rebates',$data);
				$this->load->view('layout/short_footer',$data);
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


	public function mlmincome_Leadership()
	{
		if ($this->user['A_CTRL']['networking'] == 1){
			$data = array('menu' => 13,
						 'parent'=>'' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['user'] = $this->user;


				if (isset($_POST['btnSearch'])){
					$INPUT_POST = $this->input->post(null,true);
					
					$data['user'] = $this->user;

					$parameter =array(
								'dev_id'     		=> $this->global_f->dev_id(),
								'actionId'          => _mlm_leadership_bonus_report, 
								'ip_address'		=> $this->ip, 
			    				'regcode'           => $this->user['R'],
			    				'startdate'			=> $INPUT_POST['inputStart'],
			    				'enddate'			=> $INPUT_POST['inputEnd']
						    	); 
					// print_r($parameter);exit();
				    $result = $this->curl->call($parameter,url);
				    // print_r($result);
				   	$API = json_decode($result,true);

				   	// print_r($API);exit();
				   	if ($API['S'] == 1) {
			   			$data['process'] = array('P'=>1,
												 'S'=>1);
				   	}
				   		$data['API'] = $API;
				   		$date = array('startdate'=>$INPUT_POST['inputStart'],
				   					   'enddate'=>$INPUT_POST['inputEnd']);
				   		$this->session->set_userdata('inputdate',$date);

				} else {

					$url = url;
					$parameter =array(
						'dev_id'     => $this->global_f->dev_id(),
						'regcode' 	 => $this->user['R'],
						'actionId'   => _get_mlmincome_leadership,
						'ip_address' => $this->ip
			    	);

			    	$result = $this->curl->call($parameter,url);
				    // print_r($result);
				   	$API = json_decode($result,true);
				   	// print_r($API);exit();
				   	
					if ($API['S'] === 0) {
							$data['process'] = array ('P'=>1,
												  'S'=>0,
												  'M'=>$API['M']);	
					}else {
							$data['process'] = array ('P'=>1,
												  'S'=>1,
												  'M'=>$API['M']);
					}
					$data['API'] = $API;
			    }

				$this->load->view('layout/short_header',$data);
				$this->load->view('network/mlmincome_Leadership',$data);
				$this->load->view('layout/short_footer',$data);
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


	public function mlmincome_points()
	{
		if ($this->user['A_CTRL']['networking'] == 1){
			$data = array('menu' => 13,
						 'parent'=>'' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['user'] = $this->user;


				if (isset($_POST['btnSearch'])){
					$INPUT_POST = $this->input->post(null,true);
					
					$data['user'] = $this->user;

					$parameter =array(
								'dev_id'     		=> $this->global_f->dev_id(),
								'actionId'          => _mlm_points_report, 
								'ip_address'		=> $this->ip, 
			    				'regcode'           => $this->user['R'],
			    				'startdate'			=> $INPUT_POST['inputStart'],
			    				'enddate'			=> $INPUT_POST['inputEnd'],
			    				'type'				=> $INPUT_POST['type']
						    	); 
					// print_r($parameter);exit();
				    $result = $this->curl->call($parameter,url);
				    // print_r($result);
				   	$API = json_decode($result,true);

				   	// print_r($API);exit();
				   	if ($API['S'] == 1) {
			   			$data['process'] = array('P'=>1,
												 'S'=>1);
				   	}
				   		$data['API'] = $API;
				   		$date = array('startdate'=>$INPUT_POST['inputStart'],
				   					   'enddate'=>$INPUT_POST['inputEnd']);
				   		$this->session->set_userdata('inputdate',$date);

				} else {

					/* $url = url;
					$parameter =array(
						'dev_id'     => $this->global_f->dev_id(),
						'regcode' 	 => $this->user['R'],
						'actionId'   => _get_mlmincome_points,
						'ip_address' => $this->ip
			    	);

					// print_r($parameter);
			    	$result = $this->curl->call($parameter,url);
				    // print_r($result);
				   	$API = json_decode($result,true);
				   	// print_r($API);exit();
				   	
					if ($API['S'] === 0) {
							$data['process'] = array ('P'=>1,
												  'S'=>0,
												  'M'=>$API['M']);	
					}else {
							$data['process'] = array ('P'=>1,
												  'S'=>1,
												  'M'=>$API['M']);
					}
					$data['API'] = $API; */
			    }	

				$this->load->view('layout/short_header',$data);
				$this->load->view('network/mlmincome_points',$data);
				$this->load->view('layout/short_footer',$data);
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

	public function mlmincome_personal_sales()
	{
		if ($this->user['A_CTRL']['networking'] == 1){
			$data = array('menu' => 13,
						 'parent'=>'' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['user'] = $this->user;

				if (isset($_POST['btnSearch'])){
					$INPUT_POST = $this->input->post(null,true);
					
					$data['user'] = $this->user;

					$parameter =array(
								'dev_id'     		=> $this->global_f->dev_id(),
								'actionId'          => _mlm_personal_sales_report, 
								'ip_address'		=> $this->ip, 
			    				'regcode'           => $this->user['R'],
			    				'startdate'			=> $INPUT_POST['inputStart'],
			    				'enddate'			=> $INPUT_POST['inputEnd'],
			    				'type'				=> $INPUT_POST['type']
						    	); 
					// print_r($parameter);exit();
				    $result = $this->curl->call($parameter,url);
				    // print_r($result);
				   	$API = json_decode($result,true);

				   	// print_r($API);exit();
				   	if ($API['S'] == 1) {
			   			$data['process'] = array('P'=>1,
												 'S'=>1);
				   	}
				   		$data['API'] = $API;
				   		$date = array('startdate'=>$INPUT_POST['inputStart'],
				   					   'enddate'=>$INPUT_POST['inputEnd']);
				   		$this->session->set_userdata('inputdate',$date);

				} else {

					/* $url = url;
					$parameter =array(
						'dev_id'     => $this->global_f->dev_id(),
						'regcode' 	 => $this->user['R'],
						'actionId'   => _get_mlmincome_personal_sales,
						'ip_address' => $this->ip
			    	);

					// print_r($parameter);
			    	$result = $this->curl->call($parameter,url);
				    // print_r($result);
				   	$API = json_decode($result,true);
				   	// print_r($API);exit();
				   	
					if ($API['S'] === 0) {
							$data['process'] = array ('P'=>1,
												  'S'=>0,
												  'M'=>$API['M']);	
					}else {
							$data['process'] = array ('P'=>1,
												  'S'=>1,
												  'M'=>$API['M']);
					}
					$data['API'] = $API; */
			    }

				$this->load->view('layout/short_header',$data);
				$this->load->view('network/mlmincome_personal_sales',$data);
				$this->load->view('layout/short_footer',$data);
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

	public function quota_report()
	{
		if ($this->user['A_CTRL']['networking'] == 1){
			$data = array('menu' => 13,
						 'parent'=>'' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['user'] = $this->user;

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('network/quota_report');
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

	public function load_quota_report_content()
	{
		if ($this->user['A_CTRL']['networking'] == 1){
			$data = array('menu' => 13,
						 'parent'=>'' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$data['user'] = $this->user;

				$orderby = $this->input->post('orderby');
				$date = $this->input->post('date');

				$url = url;
				$parameter =array(
					'dev_id'     => $this->global_f->dev_id(),
					'regcode'	 => $this->user['R'],
					'actionId'   => 'ups_network_service/quota_report',
					'ip_address' => $this->ip,
					'orderby'	 => $orderby,
					'date'	 	 => $date,
		    	);
		    	$data['quota_report'] = json_decode($this->curl->call($parameter,$url),true);

				// echo '<pre>';
				// print_r($data['quota_report']);
				// echo '<pre>';

				$json_res = array(
					'table_content' => $this->load->view('network/quota_report_content', $data['quota_report'],true)
				);

				echo json_encode($json_res);
			}else {
				$this->session->sess_destroy();
				redirect('Login/');
			}	
		}else {
			redirect('Main/');
		}	
	}

	public function dashBoard(){
		if ($this->user['A_CTRL']['networking'] == 1){
				$data = array('menu' => 13,
							'parent'=>'' );
					if ($this->user['S'] == 1 && $this->user['R'] !=""){
						$data['user'] = $this->user;

						$url = url;
						$parameter =array(
							'dev_id'     => $this->global_f->dev_id(),
							'regcode'	 => $this->user['R'],
							'actionId'   => 'ups_network_dashboard/fetch_network_dashboard',
							'ip_address' => $this->ip,
							'action' 	 => 'network_dashboard'
						);

						// print_r($parameter);exit();
						$result = $this->curl->call($parameter,$url);
						// print_r($result);die();
						$API = json_decode($result,true);
						$data['API'] = $API;
						// $data['API']['S'];
						// print_r($data['API']);die();
						// if($data['API']['S'] == 0){
						// 	redirect('Network/');	
						// }else{
							$this->load->view('layout/header',$data);
							$this->load->view('element/top_header');
							$this->load->view('element/wrapper_header');
							$this->load->view('element/left_panel');
							$this->load->view('network/dashboard');
							$this->load->view('element/wrapper_footer');
							$this->load->view('layout/footer');
						// }
					}else {
						$this->session->sess_destroy();
						redirect('Login/');	
						}
		}else {
			redirect('Main/');
		}	

	}

	public function fetching_Earnings() {
		$action = $this->input->post('action');
		
			$url = 'https://mobileapi.unified.ph/ups_network_dashboard/fetch_network_dashboard';

			$parameter = array(
				'actionId' 	 	=> 'ups_network_dashboard/fetch_network_dashboard',
				// 'dev_id' 	 	=> $this->global_f->dev_id(),
				'regcode'	 	=> $this->user['R'],
				'action'	 	=> $action
			);
		
		$result = $this->curl->call($parameter, $url);
		$response = json_decode($result, true);
		echo json_encode($response);
		
	}
}