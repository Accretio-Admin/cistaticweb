<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activities_model extends CI_Model {


	function getncr() {

		$ncr = array(
		        "Parañaque Hub - Atlas Remittance  Center" => "Parañaque 10A Presidents Avenue, Bf Homes, Teoville, Paranaque City District Iv"
		);

		return $ncr;

	}


	function getluzon() {

		$luzon = array(
		              "Santiago Hub - A Synergy Business Hub" => "Fourlanes Street, Brgy. Villasis, Santiago City.",
		              "Gonzaga Hub - CFPJ Remittance And Ticketing Center" => "1st Floor Garma Bldg., Adduru St., Paradise, Gonzaga Cagayan, 3513",
		              "Angeles Hub - Econpay  Remittance Services" => "Unit-O Pedana Plaza Lot 516 Burgos,St. Agapito Del Rosario Angeles City Pampanga",
		              "Dasmariñas Hub - Viajedor Remittance" => "Blk 6 L01 San Lorenzo Ruiz, Dbbe Cavite, Dasma",
		              "Naga Hub - FKA Exchange & Remittance Services" => "34-D De Castro Bldg. Barlin St. 4400 Naga City",
		              "Palawan Hub - Lucky Peacock Travel And Tours" => "#44 Baltan St. Brgy San Miguel Puerto Princesa Palawan 5300"
				);

		return $luzon;

	}


	function getvisayas(){

		$visayas = array(
		              "Bacolod Hub - Rhadz Bills Payments & Remittance  Center" => "Yulo- Quezon Sts Brgy 36 Bacolod City",
		              "La Carlota Hub" => "La Carlota Yunque St. Agora Market, La Carlota City, Negros Occ.",
		              "Ilo-Ilo Hub - Pronto! Retail  Remittance And Service Co." => "Corner Fuentes De Leon Street, Brgy. Gloria, Ilo-Ilo City",
		              "Tagbilaran 2 Hub - Rabbit Foot  Travel  &  Tours" => "0156 Gallares St., Pob Ii, Tasgb. City",
		              "Tacloban Hub -  Adora Business Center" => "Door 1 Ocañada Bldg. Kalipayan Road, Brgy. 62-B Tacloban City",
		              "Kabankalan Hub - Jrb Remittance Center" => "Bry. 1 Tan Lorenzo St. Kabankalan City -In Front Of Gaisano City Kabankalan",
		              "Kasibu Nueva Vizcaya - Saint Patrick Parish M Ulti Purpose Coop" => "Parish Compound Poblacion Kasibu Nueva Vizcaya",
		              "La Trinidad Benguet Hub - Majen Remittance Services" => "Fa-146 Pineshill Business Center I, Balili",
		              "Ormoc Leyte Hub" => "Ormoc Leyte",
		              "Talisay Hub - GS Ticketing & Remittance Services" => "Talisay, Cebu Region 7 (Central Visayas)",
		              "Tuguegarao Hub" => "Tuguegarao"
				);

		return $visayas;

	}

	function getmindanao(){

		$mindanao = array(
					"Zamboanga Hub - C J Rivero Enterprises" => "138 San Jose, Gusu, Zamboanga City",
					"Cagayan De Oro Hub - Voyagers Business Hub" => "Voyager's Arcade, Tiano Brother's St., Cagayan De Oro",
					"Bayugan Hub - Svb Sanbar Trading, Inc." => "Esperanza Road, Bayugan, Agusan Del Sur",
					"Cotabato Hub - Soul Remittance & Bills Services" => "#036 Bishop Gerald M Ongeau Avenue , Coatabato City"
				);

		return $mindanao;

	}

	function getinternational(){

		$intl = array(
				"Doha Qatar - Vital Enterprises Wll (International)" => "Po Box 2000237 4th Floor Dar As Salam Building., Top Of Al- Zaman Exchange Beside Al Fardan Complex, Alashat Street Old Al-Ghanem, Doha, Qatar"
			);

		return $intl;
	}


	function getintl_office(){

			$intl_office = array(
							"Hong Kong" => "15/F Chang Pao Ching Building, #427-429 Hennessy Road, Causeway Bay, Hong Kong Trunkline: (852) 21533535"
						);

		return $intl_office;
	}

	function getloc_office(){

		$loc_office = array(
					"Quezon Avenue Office" => "Jr Bldg Mezzanin Floor, Brgy. South Triangle, Quezon Ave., Quezon City",
					"Cebu Office" => "Ground Floor Rafael Yu Bldg. Gen. Maxilom Avenue, Cebu City",
					"Davao Office" => "Hrtv Corp. Building, Bolton St., Brgy. 3, Davao City"
				);

		return $loc_office;
	}


}
