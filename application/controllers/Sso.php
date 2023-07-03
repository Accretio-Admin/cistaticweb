<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sso extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->user = $this->session->userdata('user');
        $this->load->model('Global_function','global_f');
        $this->load->model('Curl_model','curl');
        // $this->ip = $this->input->ip_address();



        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)){
            $IP = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $IP = $IP[0];
        }else{
            $IP = $_SERVER['REMOTE_ADDR'];

        }

        $this->ip = $IP;
        $this->load->model('Query_model');

    }

    public function login()
    {
        $query = http_build_query([
            'client_id' => sso_client_id,
            'redirect_uri' => base_url() . 'sso/callback',
            'response_type' => 'code',
            'scope' => 'place-orders email-address public-profile'
        ]);

        if(!isset($this->user['R'])){
            redirect(sso_url . '/oauth/authorize?'.$query);
        }
        else{
            $this->user = $this->session->userdata('user');
//            print_r($this->session->userdata('user'));exit;
            redirect('/Main');
        }
    }

    public function callback()
    {
        $url = sso_url . '/oauth/token';

        $parameter =array(
            'grant_type'       => 'authorization_code',
            'client_id'	       => sso_client_id,
            'client_secret'	   => sso_client_secret,
            'redirect_uri'     => base_url() . 'sso/callback',
            'code'             => $this->input->get('code')
        );
        $result = $this->curl->call($parameter,$url);
        $dataAccess = json_decode($result,true);

        if(!isset($dataAccess['error'])){
            $result = $this->curl->call_with_header_get(null, sso_url . '/api/user', $dataAccess['access_token']);
            //print_r($result);exit;
            $data = json_decode($result,true);

            if($data['CG'] != 'ONL'){


                $data['access_token'] = $dataAccess['access_token'];

                $this->session->set_userdata('user',$data);
                $this->user = $this->session->userdata('user');

                redirect('/Main');
            }

            unset($data);
            $data = ['S'=>false, 'M'=>'User not found!.'];
            var_dump($data);exit;
        }

        redirect('/Login');

    }
}