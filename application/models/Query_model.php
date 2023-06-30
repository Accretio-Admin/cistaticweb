<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Query_model extends CI_Model {


	function getoptions() {

		$option = array(
						"campus" => array(
										  "Gensan",
										  "Marbel",
										  ), 
						"course" => array(
										  "Associate in Computer Technology",
										  "Associate in Office Administration",
										  "Bachelor in Elementary Education",
										  "Bachelor of Arts",
										  "Bachelor of Early Childhood Education",
										  "Bachelor in Physical Education"
										   ),
						"schoolyear" => array(
										  "2014-2015",
										  "2015-2016",
										  "2016-2017",
										  "2017-2018",
										  "2018-2019",
										  "2019-2020"
										     ),
						"semester" => array(
										  "First",
										  "Second",
										  "Third",
										  "Summer"
										    ),
						"yearlevel" => array(
										  "2014-2015",
										  "2015-2016",
										  "2016-2017",
										  "2017-2018",
										  "2018-2019",
										  "2019-2020"
										 )
						);

		return $option;
	}

		function getbank() {

		$bank = array(
					"1"	  => "Allied Bank",
					"2"	  => "Allied Savings Bank",
					"3"	  => "Asia United Bank",
					"4"	  => "Banco Filipino",
					"5"	  => "Banco San Juan",
					"6"	  => "Bank of Commerce",
					"7"	  => "CARD Bank Inc.",
					"8"	  => "Centennial Savings Bank",
					"9"	  => "ChinaBank",
					"10"  => "China Bank Savings",
					"11"  => "Chinatrust Bank",
					"12"  => "CitiBank",
					"13"  => "Citibank Savings",
					"14"  => "City Savings Bank",
					"15"  => "Citystate Bank",
					"16"  => "Development Bank of the Philippines",
					"17"  => "East West Bank",
					"18"  => "Equicom Savings Bank",
					"19"  => "Green Bank",
					"20"  => "HSBC",
					"21"  => "HSBC SAVINGS",
					"22"  => "Malayan Bank",
					"23"  => "Maybank Philippines",
					"24"  => "MetroBank",
					"25"  => "Opportunity Microfinance",
					"26"  => "PBCom",
					"27"  => "Philippine Business Bank",
					"28"  => "Philippine National Bank",
					"29"  => "Philippine Veterans Bank",
					"30"  => "Philippine Veterans Card Corp",
					"31"  => "Philtrust Bank",
					"32"  => "Postal Bank",
					"33"  => "Premiere Development Bank",
					"34"  => "Producers Bank",
					"35"  => "Philippine Savings Bank",
					"36"  => "Quezon Capital Rural Bank",
					"37"  => "RCBC",
					"38"  => "RCBC Savings Bank",
					"39"  => "Real Bank",
					"40"  => "Robinsons Bank",
					"41"  => "Security Bank",
					"42"  => "Standard Chartered Bank",
					"43"  => "Sterling Bank of Asia",
					"44"  => "Tong Yang Bank",
					"45"  => "Wealth Bank",
					"46"  => "World Partners Bank",
					"47"  => "Asia Trust Bank",
					"48"  => "BDO",
					"49"  => "mass specc",
					"50"  => "microfinance maximum savings bank",
					"51"  => "Pacific Ace Savings Bank",
					"52"  => "Queen City Development Bank",
					"53"  => "UCPB",
					"54"  => "Union Bank",
					"55"  => "BPI",
					"56"  => "BPI Family Savings",
					"57"  => "Citystate Savings Bank",
					"58"  => "Exportbank",
					"59"  => "Landbank of the Philippines",
					"60"  => "Malayan Savings Bank",
					"61"  => "Nationlink",
					"62"  => "OK Bank"
					);

		return $bank;
	}

	// function course() {

	// return $this->db->query('SELECT * FROM course WHERE STATUS = 1 ORDER BY course_desc ASC')->result();

	// }

	// function semester() {

	// return $this->db->query('SELECT * FROM semester  ORDER BY sem_id ASC')->result();

	// }

	// function schoolyear() {

	// return $this->db->query('SELECT * FROM school_year  ORDER BY sy_desc ASC')->result();

	// }

	// function yearlevel() {

	// return $this->db->query('SELECT * FROM year_level  ORDER BY yrlevel_desc ASC')->result();

	// }

	// function campus() {

	// return $this->db->query('SELECT * FROM campus  ORDER BY campus_desc ASC')->result();

	// }

	// function announcement(){
	// 	$sql =  "SELECT * FROM announcements WHERE user_view = 1 AND company_group = 'UPS'  ORDER BY id DESC";
	// 	$result  = $this->db->query($sql);
	// 	return $result->result();
	// }
	
	// function annoucement_count(){
	// 	$sql =  "SELECT count(*) FROM announcements WHERE user_view = 1 AND company_group = 'UPS'";
	// 	$result  = $this->db->query($sql);
	// 	return $result->result();
	// }
} 