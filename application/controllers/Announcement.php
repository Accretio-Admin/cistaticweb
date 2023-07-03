<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Announcement extends CI_Controller {

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
        $data = array('parent'=>'ANNOUNCEMENT' );

			if ($this->user['S'] == 1 && $this->user['R'] !=""){

				$data['user'] = $this->user;

				$this->load->view('announcement/index',$data);
			}else {
				//$this->session->unset_userdata('user');
				$this->session->sess_destroy();
				redirect('Login/');
			}
	}
	public function coporate_list(){
		if ($this->user['S'] == 1 && $this->user['R'] !=""){

			$data['user'] = $this->user;

			$this->load->view('announcement/corporate_list',$data);
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}
}