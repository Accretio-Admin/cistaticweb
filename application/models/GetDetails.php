<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class GetDetails extends CI_Model {
function beneficiary($data){ 
    // print_r($data['beneficiary']);
        // $sql = "SELECT Count(registered_by)  AS exist FROM `smartpaymayacustomerbeneficiaries` WHERE firstname like '".$data['beneficiary']['firstName']."' AND middlename like '".$data['beneficiary']['middleName']."'  AND lastname like '".$data['beneficiary']['lastName']."' AND mobileNo = '".$data['beneficiary']['mobileNo']."'"; 
        // // print_r($sql);
        // $query = $this->db->query($sql);  
        // return  $query->result();
    }

    function sender($data) {
        try {
            // $sql = "SELECT Count(registered_by)  AS exist FROM `smartpaymayacustomersenders` WHERE firstname like '".$data['sender']['firstName']."' AND middlename like '".$data['sender']['middleName']."'  AND lastname  like '".$data['sender']['lastName']."'   AND birthDate  like '".$data['sender']['birthDate']."'  "; 
        
            // $query = $this->db->query($sql);  
            // // print_r($data['sender']);
            // // print_r($query->result()); exit();
            // return  $query->result();
        }
        catch (exception $e) {
            print_r($e);exit();
        }
        
    }
}