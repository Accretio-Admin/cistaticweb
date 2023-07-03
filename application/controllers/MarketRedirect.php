<?php defined('BASEPATH') OR exit('No direct script access allowed');
// <?php defined('BASEPATH') OR exit('No direct script access allowed');

class MarketRedirect extends CI_Controller {
	public function index()
	{
		// header("Location: https://marketplace.unified.ph");
		redirect('https://secure1.unified.ph');
	}	
}
		
