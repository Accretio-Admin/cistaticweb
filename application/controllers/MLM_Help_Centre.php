<?php if( ! defined('BASEPATH')) exit('No direct script access allow');

class MLM_Help_Centre extends CI_Controller {
	
	public function __construct() {
		
		parent::__construct();
		date_default_timezone_set('Asia/Manila');
		//require_once(BASEPATH.'libraries/getbrowser'.EXT);
	}
	
	function index() { //Home redirect for anonymous user
		/*
		$browser = new Browser(); 
 		$Cbrow = $browser->getBrowser(); 
 		if($Cbrow == 'Internet Explorer') {

 			echo "<h1>Unsupported Browser. Please upgrade or use google chrome and mozilla firefox.</h1>"; exit;
 		}*/
 		// echo "System is currently on maintainance";
         $this->load->view('layout/mlmHelpHeader');
         $this->load->view('anonymous/mlmShopHelp');
	}


	
}