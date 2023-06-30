<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curl_model extends CI_Model {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function call($parameters,$url)
	{
		// $postfields = array('field1'=>'value1', 'field2'=>'value2');
		$AUTH = array(
				    "authorization: Basic UGxlYXNld2FpdGZvcmNvbm5lY3Rpb25zdGF0dXM6cGxlYXNlKD48KXdhIXQ=",
				    "cache-control: no-cache",
				    "postman-token: b9654f9f-e353-7591-68d8-3d2854085c43"
				  );
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_HTTPHEADER,$AUTH);
		// Edit: prior variable $postFields should be $postfields;
		curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // On dev server only!
		curl_setopt($ch, CURLOPT_USERAGENT,'unLiT3cHSolstiOnsWEB');
		
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		$result = curl_exec($ch);
		
		
		return $result;
	}

	public function call2($parameters,$url)
	{
		 // $postfields = array('field1'=>'value1', 'field2'=>'value2');
		$AUTH = array(
				    "authorization: Basic UGxlYXNld2FpdGZvcmNvbm5lY3Rpb25zdGF0dXM6cGxlYXNlKD48KXdhIXQ=",
				    "cache-control: no-cache",
				    "postman-token: 7cb19cb3-de53-7fb0-487f-b5e8286c81bb"
				  );
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_HTTPHEADER,$AUTH);
		// Edit: prior variable $postFields should be $postfields;
		curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // On dev server only!
		curl_setopt($ch, CURLOPT_USERAGENT,'unLiT3cHSolstiOnsWEB');
		$result = curl_exec($ch);
		
		return $result;
	}

	public function call_with_header_get($parameters, $url, $accesstoken)
	{
		// $postfields = array('field1'=>'value1', 'field2'=>'value2');
		$headr = array();
		$headr[] = 'Content-length: 0';
		$headr[] = 'Content-type: application/json';
		$headr[] = "Authorization: Bearer $accesstoken";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
		$result = curl_exec($ch);
		if ($result === false)
		{
			// throw new Exception('Curl error: ' . curl_error($crl));
			return ('Curl error: ' . curl_error($ch));
		}
		return $result;
	}

	/*
	 * Custom curl - feel free to cusomize
	 *
	 * @author JRLValdez
	 * @date 08/23/2018
	 *
	 * @param array $parameters
	 * @param string $curl
	 *
	*/
	public function call_custom($parameters, $url, $customRequest)
	{
		$ch = curl_init();
		curl_setopt_array($ch, [
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_CUSTOMREQUEST => $customRequest,
			CURLOPT_HTTPHEADER => array ( 
				'auth: e2dcc87abb6d6e803026cda8c5ceb6cf',
				"accept: application/json",
				"cache-control: no-cache",
				"content-type: application/json",
			),
			CURLOPT_POSTFIELDS => json_encode($parameters),
			CURLOPT_SSL_VERIFYPEER => false,
		]);

		try {
			$result = curl_exec($ch);
			$err = curl_error($ch);
			$info2 = curl_getinfo($ch);
			// print_r($err);
			// print_r($info2);
			return $result;
		} catch (Exception $error) {
			// echo "errors -? ";
			// print_r($error);
			return [
				"errors" => [
					["message" => "an error connecting with the hotel occur. Please try again"]
				]
			];
		}
		

		//  echo "<pre>";
		//  var_dump($info2);
		// var_dump($result);
		
	}

	//FUNDING
		// public function get_fund($regcode,$ip,$skt){
		// 	$url = url;
	 //       	$parameter = array('regcode'	 => $regcode
	 //       						'dev_id'     => $this->input->server('HTTP_USER_AGENT'),
		// 	    				'ip_address' => $ip,
		// 	    				'actionId' 	 => _fetch_user_funding,
		// 	    				 $this->user['SKT'] => md5($regcode.$skt) );

	 //      	$data['result'] = $this->call($parameter,$url);
	 //      	$API = json_decode($data['result'],true);
	 //      	return $API;
		// }
	//FUNDING
}
