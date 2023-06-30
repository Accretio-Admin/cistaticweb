<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sp_model extends CI_Model {

    public function __construct() {
     	parent::__construct();
	$this->load->model('curl_model','curl');
	$this->load->library('session');
  	$this->load->model('Global_function','global_f');
	$this->user = $this->session->userdata('user');
    }

//update by nhez 03/21/2017
	public function userprivilege() {

	    $parameter =array(
	                'dev_id'           => $this->global_f->dev_id(),
	                'actionId'         => _account_user_priv,
	                'regcode'          =>$this->user['R'],
	                'ip_address'       =>$this->ip,
	                $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
	                ); 
	    $result = $this->curl->call($parameter,url);
	    $results = json_decode($result,true);
	  	return $results;
	}

	public function userfunds() {

	    $parameter =array(
	                'dev_id'           => $this->global_f->dev_id(),
	                'actionId'         => _fetch_userfunds,
	                'regcode'          =>$this->user['R'],
	                'ip_address'       =>$this->ip,
	                $this->user['SKT'] =>  md5($this->user['R'].$this->user['SKT'])
	                ); 
	    $result = $this->curl->call($parameter,url);
	    $results = json_decode($result,true);
	  	return $results;
	}

} 