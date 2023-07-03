<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Investment extends CI_Controller {
   	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	    $this->load->model('Curl_model','curl');
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
	}

	public function index()
	{	
		$data = array('menu' => 22, 'parent' => '');

		if ($this->user['S'] == 1 && $this->user['R'] != "")
        {
			$data['user'] = $this->user;

            $this->load->view('investment/index', $data);
		}
        else 
        {
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}

    public function usave()
    {
        $data = array('menu' => 22, 'parent' => '');

		if ($this->user['S'] == 1 && $this->user['R'] != "")
		{	
			$data['user'] = $this->user;

			//Cash Ledger and Pay In
			$params = array(
				'dev_id' => $this->global_f->dev_id(),
				'actionId' => 'ups_usave/usave_payin_cash_ledger',
				'regcode' => $this->user['R'],
				'ip_address' =>$this->ip
			);

			$response = json_decode($this->curl->call($params, url), true);
			$data['payin_cash_ledger_list'] = $response['D'];


			$this->load->view('layout/header', $data);
			$this->load->view('element/top_header');
			$this->load->view('element/wrapper_header');
			$this->load->view('element/left_panel');
			$this->load->view('investment/usave');
			// $this->load->view('hotels/hotelundermaintenance');  
			$this->load->view('element/wrapper_footer');
			$this->load->view('layout/footer');	
		}
		else 
		{
			$this->session->sess_destroy();
			redirect('Login/');
		}	
    }

	public function usave_terms_condition()
	{
		$data = array('menu' => 22, 'parent' => '');

		if ($this->user['S'] == 1 && $this->user['R'] != "")
		{
			$data['user'] = $this->user;

			$this->load->view('investment/usave_terms_condition', $data); 
		}
		else
		{
			$this->session->sess_destroy();
			redirect('Login/');
		}
	}

    function usave_auto_compute()
    {
        $params = array(
            'dev_id' => $this->global_f->dev_id(),
            'actionId' => 'ups_usave/maturity_computation',
            'regcode' => $this->user['R'],
            'ip_address' => $this->ip,
            'amount' => $this->input->post('amount'),
            'maturity_type' => $this->input->post('maturity_type')
        );

        $response = json_decode($this->curl->call($params, url), true);
        
        echo json_encode($response);
    }

    function usave_transaction()
    {
        $params = array(
            'dev_id' => $this->global_f->dev_id(),
            'actionId' => 'ups_usave/payin_transaction',
            'regcode' => $this->user['R'],
            'ip_address' => $this->ip,
            'amount' => $this->input->post('amount'),
            'maturity_type' => $this->input->post('maturity_type'),
            'transpass' => $this->input->post('transpass'),
						'email' => $this->user['EA'],
						$this->user['SKT'] => md5($this->user['R'] . $this->user['SKT'] . md5($this->input->post('transpass')))
        );
        $response = json_decode($this->curl->call($params, url), true);
        
        echo json_encode($response);
    }

    function payout_transaction()
    {
        $params = array(
            'dev_id' => $this->global_f->dev_id(),
            'actionId' => 'ups_usave/payout_transaction',
            'regcode' => $this->user['R'],
            'ip_address' => $this->ip,
            'payin_id' => $this->input->post('payin_id'),
			'transpass' => $this->input->post('transpass'),
			$this->user['SKT'] => md5($this->user['R'] . $this->user['SKT'] . md5($this->input->post('transpass')))
        );

        $response = json_decode($this->curl->call($params, url), true);
        
        echo json_encode($response);
    }
}