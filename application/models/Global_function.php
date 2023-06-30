<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Global_function extends CI_Model {

	public function captcha_code()
	{
		$captcha = array('code1' => rand(1,25),
						'code2' => rand(1,25)
						);

		$this->session->set_userdata('captcha',$captcha);
		return $captcha;
	}

	public function captcha_validate($sign_captcha,$total)
	{
		if ($sign_captcha != $total) 
		{
		
			
			return 0;
		}else {
			
			return 1;
		}
	}

	public function get_user_session()
	{	
		
		$this->session->set_userdata('user',$this->user);
		$this->user = $this->session->userdata('user');
		
		return  $this->user;;
	}

	public function MAC_ADDRESS(){
		$get_mac =explode('at',shell_exec("arp -a ".escapeshellarg($this->ip)));
		$mac = explode("[ether]", $get_mac[1]);
		$mac_address = str_replace(" ", "", $mac[0]);
		return strtoupper($mac_address);
	}
	// public function dev_id()
	// {
	// 	$IP = $_SERVER['REMOTE_ADDR'];

 //        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
 //            $IP = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
 //        }

 //        $this->ip = $IP;
	// 	$devid = substr(sha1($this->input->server('HTTP_USER_AGENT').$this->ip), 1,8)."-".'1317'."-".substr(sha1($this->input->server('HTTP_USER_AGENT').$this->ip),22,29);
	// 	return $devid;
	// }
	public function dev_id()
	{
		if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE)
		   $browser = 'Internet explorer';
		 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE) //For Supporting IE 11
		    $browser =  'Internet explorer';
		 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE)
		  $browser =  'Mozilla Firefox';
		 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE)
		   $browser =  'Google Chrome';
		 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== FALSE)
		   $browser =  "Opera Mini";
		 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== FALSE)
		   $browser =  "Opera";
		 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== FALSE)
		   $browser =  "Safari";
		 else
		   $browser =  'Something else';
		   
		 if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)){
            $IP = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
			$IP = $IP[0];
	   }else{
			$IP = $_SERVER['REMOTE_ADDR'];
		
		}
		
	    $this->ip = $IP;

		$devid = substr($this->ip,0,6)."|".$browser;
		return $devid;
	}

	
}