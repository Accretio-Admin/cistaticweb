<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Check_transaction extends CI_Model {

    public function __construct() 
    {
     	parent::__construct();
        $this->load->model('curl_model', 'curl');
        $this->load->model('Global_function', 'global_f');
    }

	public function transCount($regcode, $transtype)
    {
	    $parameter = array(
            'dev_id' => $this->global_f->dev_id(),
            'actionId' => 'ups_user/getGwlTransaction',
            'regcode' => $regcode,
            'transtype' => $transtype,
            'ip_address' => $this->ip,
        ); 

	    $result = $this->curl->call($parameter, url);
	    $results = json_decode($result, true);
        
	  	return $results;
	}

    public function gwlCheckTransLimit($transacType)
	{
        $user = $this->session->userdata('user');

		if (substr($user['R'], 0, 3) == 'GWL') //For Wealthylifestyle
		{
			$status = $this->transCount($user['R'], $transacType)['S'];

			if ($status == 0)
			{
				redirect('/Main');
			}
		}
	}
} 