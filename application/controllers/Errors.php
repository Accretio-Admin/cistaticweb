<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
class Errors extends CI_Controller {

   	public function __construct()
	{
		parent::__construct();

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
	}

	public function index($referral=""){

        $this->load->view('layout/header');
		$this->load->view('anonymous/notfound', $data); 
        $this->load->view('layout/footer');
	}

}

?>