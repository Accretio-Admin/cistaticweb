<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Billspay_admin extends CI_Controller {

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
	    $this->load->model('Report_model','r');

	    if ($this->user['RET'] == 1) {
	    	redirect('Main/');
	    }
	}

	public function index()
	{
		if ($this->user['A_CTRL']['billspayment'] == 1 && $this->user['A_CTRL']['billspay_admin'] == 1) {

			$data = array('menu' => 25,
						 'parent'=>'' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;

				$this->load->view('billspay_admin/index',$data);
			}else {
				$this->session->sess_destroy();
				redirect('Login/');
			}
		}else {
				redirect('Main/');
			}
		
	}


 	function mmtci_confrim(){

		$parameter = array(
					'dev_id'     	   => $this->global_f->dev_id(),
					'actionId' 	 	   => _metroturf_approval,
			        'regcode' 		   =>$this->user['R'],
			        'trackno'  	 	   =>$this->input->post('trackno'),
			        'ip_address'  	   =>$this->ip,        
					$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
					);

		$result = $this->curl->call($parameter,url);
		$results = json_decode($result,true);

		if($results['S'] == 1){
			$message = array(	
								'S' =>"1",
								'M' =>$results['M']
								);
  		} else{
			$message = array(	
								'S' =>"0",
								'M' =>$results['M']
								);
  		}
		echo json_encode($message);
	}

	public function mmtci_approval()
	{

		if ($this->user['A_CTRL']['billspayment'] == 1 && $this->user['A_CTRL']['billspay_admin'] == 1) {

		$data = array('menu' => 25,
				     'parent'=>'');

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;

				if (isset($_POST['btn_search'])){ $refno =  $this->input->post('acct_regcode'); } else{ $refno = '';  }

					$parameter = array(
								'dev_id'     	   => $this->global_f->dev_id(),
								'actionId' 	 	   => _fetch_metroturf,
						        'regcode' 		   =>$this->user['R'],
						        'referenceno' 	   =>$refno,
						        'ip_address'  	   =>$this->ip,        
								$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
								);

					$result = $this->curl->call($parameter,url);
					$data['results'] = json_decode($result,true);


				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('billspay_admin/metroturf_pending'); 
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

	public function mmtci_processed()
	{
		if ($this->user['A_CTRL']['billspayment'] == 1 && $this->user['A_CTRL']['billspay_admin'] == 1) {

		$data = array('menu' => 25,
				     'parent'=>'');

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;

				$INPUT_POST = $this->input->post(null,true);

					$parameter = array(
								'dev_id'     	   => $this->global_f->dev_id(),
								'actionId' 	 	   => _fetch_metroturf_processed,
						        'regcode' 		   =>$this->user['R'],
								'startdate'		   => $INPUT_POST['inputStart'],
								'enddate'		   => $INPUT_POST['inputEnds'],
						        'ip_address'  	   =>$this->ip,        
								$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
								);

					$result = $this->curl->call($parameter,url);
					$data['results'] = json_decode($result,true);

					$date = array('startdate'=>date('Y-m-d',strtotime($INPUT_POST['inputStart'])),
							'enddate'=>date('Y-m-d',strtotime($INPUT_POST['inputEnds'])));

					$this->session->set_userdata('inputdate',$date);

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('billspay_admin/metroturf_processed'); 
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

 	function mcwd_confrim(){

		$parameter = array(
					'dev_id'     	   => $this->global_f->dev_id(),
					'actionId' 	 	   => _mcwd_approval,
			        'regcode' 		   =>$this->user['R'],
			        'trackno'  	 	   =>$this->input->post('trackno'),
			        'refno'  	 	   =>$this->input->post('refno'),
			        'ip_address'  	   =>$this->ip,        
					$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
					);

		$result = $this->curl->call($parameter,url);
		$results = json_decode($result,true);

		if($results['S'] == 1){
			$message = array(	
								'S' =>"1",
								'M' =>$results['M']
								);
  		} else{
			$message = array(	
								'S' =>"0",
								'M' =>$results['M']
								);
  		}
		echo json_encode($message);
	}

 	function mcwd_reject(){

		$parameter = array(
					'dev_id'     	   => $this->global_f->dev_id(),
					'actionId' 	 	   => _mcwd_reject,
			        'regcode' 		   =>$this->user['R'],
			        'trackno'  	 	   =>$this->input->post('trackno'),
			        'remarks'  	 	   =>$this->input->post('remarks'),
			        'ip_address'  	   =>$this->ip,        
					$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
					);

		$result = $this->curl->call($parameter,url);
		$results = json_decode($result,true);

		if($results['S'] == 1){
	  		$this->user['EC'] = $results['EC'];		  	
	  		$data['user'] = $this->global_f->get_user_session();

			$message = array(	
								'S' =>"1",
								'M' =>$results['M']
							);
  		} else{
			$message = array(	
								'S' =>"0",
								'M' =>$results['M']
							);
  		}
		echo json_encode($message);
	}

	public function mcwd_approval()
	{
		if ($this->user['A_CTRL']['billspayment'] == 1 && $this->user['A_CTRL']['billspay_admin'] == 1) {

		$data = array('menu' => 25,
				     'parent'=>'');

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;

				if (isset($_POST['btn_search'])){ $refno =  $this->input->post('acct_regcode'); } else{ $refno = '';  }

					$parameter = array(
								'dev_id'     	   => $this->global_f->dev_id(),
								'actionId' 	 	   => _fetch_mcwd_pending,
						        'regcode' 		   =>$this->user['R'],
						        'referenceno' 	   =>$refno,
						        'ip_address'  	   =>$this->ip,        
								$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
								);

					$result = $this->curl->call($parameter,url);
					$data['results'] = json_decode($result,true);

					// var_dump($data['results']);

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('billspay_admin/mcwd_pending'); 
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

	public function mcwd_processed()
	{
		if ($this->user['A_CTRL']['billspayment'] == 1 && $this->user['A_CTRL']['billspay_admin'] == 1) {

		$data = array('menu' => 25,
				     'parent'=>'');

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;

				$INPUT_POST = $this->input->post(null,true);

					$parameter = array(
								'dev_id'     	   => $this->global_f->dev_id(),
								'actionId' 	 	   => _fetch_mcwd_processed,
						        'regcode' 		   =>$this->user['R'],
								'startdate'		   => $INPUT_POST['inputStart'],
								'enddate'		   => $INPUT_POST['inputEnds'],
						        'ip_address'  	   =>$this->ip,        
								$this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
								);

					$result = $this->curl->call($parameter,url);
					$data['results'] = json_decode($result,true);

					$date = array('startdate'=>date('Y-m-d',strtotime($INPUT_POST['inputStart'])),
							'enddate'=>date('Y-m-d',strtotime($INPUT_POST['inputEnds'])));

					$this->session->set_userdata('inputdate',$date);

				$this->load->view('layout/header',$data);
				$this->load->view('element/top_header');
				$this->load->view('element/wrapper_header');
				$this->load->view('element/left_panel');
				$this->load->view('billspay_admin/mcwd_processed'); 
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


	function export($get){

		if ($get == "mcwd_processed_report") {

			$this->r->export_mcwd_processed_report();

		}else if($get == "mmtci_processed_report") {

			$this->r->export_metroturf_processed_report();
			
		}else {

			echo "The Requested URL ". BASE_URL() ."export/". $get ."<br />"."was not found on this server";

		}

	}


}