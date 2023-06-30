<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_model extends CI_Model {
	
	public function dev_id()
	{
		$IP = $_SERVER['REMOTE_ADDR'];

        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
            $IP = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
        }

        $this->ip = $IP;
		$devid = substr(sha1($this->input->server('HTTP_USER_AGENT').$this->ip), 1,8)."-".'1317'."-".substr(sha1($this->input->server('HTTP_USER_AGENT').$this->ip),22,29);
		return $devid;
	}


	//GENERATE REPORT//

	function export_general_report(){
		
			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$inputdate=$this->session->userdata('inputdate');
				if ($inputdate['startdate'] == "" || $inputdate['enddate'] == "") {
					echo "Invalid Date";
					die();
				}
				$this->load->library('excel');
				//activate worksheet number 1
				$this->excel->setActiveSheetIndex(0);
				//name the worksheet
				$this->excel->getActiveSheet()->setTitle('GENERAL REPORT');
				//set cell A1 content with some text
				$this->excel->getActiveSheet()->setCellValue('A1', 'Sequence No');
				$this->excel->getActiveSheet()->setCellValue('B1', 'Transaction  No');
				$this->excel->getActiveSheet()->setCellValue('C1', 'Transaction Type');
				$this->excel->getActiveSheet()->setCellValue('D1', 'Amount');
				$this->excel->getActiveSheet()->setCellValue('E1', 'Charge');
				$this->excel->getActiveSheet()->setCellValue('F1', 'Income');
				$this->excel->getActiveSheet()->setCellValue('G1', 'Balance Before');
				$this->excel->getActiveSheet()->setCellValue('H1', 'Balance After');
				$this->excel->getActiveSheet()->setCellValue('I1', 'Date');

				//make the font become bold
				$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
				//merge cell A1 until D1
				//$this->excel->getActiveSheet()->mergeCells('A1:D1');
				//set aligment to center for that merged cell (A1 to D1)
				//$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				//CALL API
					$parameter =array(
								'dev_id'			=> $this->dev_id(),
								'actionId'          => _general_report, 
								'ip_address'		=> $this->ip, 
			    				'regcode'           => $this->user['R'],
			    				'startdate'			=> $inputdate['startdate'],
			    				'enddate'			=> $inputdate['enddate']
						    	); 

				    $result = $this->curl->call($parameter,url);
				   	$API = json_decode($result,true);
				   	$count = 2;
				   	 foreach ($API['TDATA'] as $A ){
	                   	 	$this->excel->getActiveSheet()->setCellValue('A'.$count, $A['SN']);
							$this->excel->getActiveSheet()->setCellValue('B'.$count, $A['TN']);
							$this->excel->getActiveSheet()->setCellValue('C'.$count, $A['TP']);
							$this->excel->getActiveSheet()->setCellValue('D'.$count, $A['A']);
							$this->excel->getActiveSheet()->setCellValue('E'.$count, $A['C']);
							$this->excel->getActiveSheet()->setCellValue('F'.$count, $A['IC']);
							$this->excel->getActiveSheet()->setCellValue('G'.$count, $A['BB']);
							$this->excel->getActiveSheet()->setCellValue('H'.$count, $A['BA']);
							$this->excel->getActiveSheet()->setCellValue('I'.$count, $A['D']); 	
							$count++;                                             
	               	 }
				//CALL API
				$filename='general_report'.date('ymd').'.xls'; //save our workbook as this file name
				header('Content-Type: application/vnd.ms-excel'); //mime type
				header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
				header('Cache-Control: max-age=0'); //no cache
				            
				//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
				//if you want to save it as .XLSX Excel 2007 format
				$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
				//force user to download the Excel file without writing it to server's HD
				$objWriter->save('php://output');
			
			}else {
				//$this->session->unset_userdata('user');
				$this->session->sess_destroy();
				redirect('Login/');
			}

		
	}
	function export_ecash_report(){
								
			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$concaturl = $this->session->userdata('concaturl');
				$this->load->library('excel');
				//activate worksheet number 1
				$this->excel->setActiveSheetIndex(0);
				//name the worksheet
				$this->excel->getActiveSheet()->setTitle('REMITTANCE SEND REPORT');
				if (is_null($concaturl)) {
				
				$this->excel->getActiveSheet()->setCellValue('A1', 'Tracking No');
				$this->excel->getActiveSheet()->setCellValue('B1', 'Regcode');
				$this->excel->getActiveSheet()->setCellValue('C1', 'Sender Name');
				$this->excel->getActiveSheet()->setCellValue('D1', 'Sender Card No');
				$this->excel->getActiveSheet()->setCellValue('E1', 'Sender Address');
				$this->excel->getActiveSheet()->setCellValue('F1', 'Sender Email');
				$this->excel->getActiveSheet()->setCellValue('G1', 'Sender Mobile');
				$this->excel->getActiveSheet()->setCellValue('H1', 'Benificiary Name');
				$this->excel->getActiveSheet()->setCellValue('I1', 'Benificiary Card No');
				$this->excel->getActiveSheet()->setCellValue('J1', 'Benificiary Address');
				$this->excel->getActiveSheet()->setCellValue('K1', 'Benificiary Email');
				$this->excel->getActiveSheet()->setCellValue('L1', 'Benificiary Mobile');
				$this->excel->getActiveSheet()->setCellValue('M1', 'Amount');
				$this->excel->getActiveSheet()->setCellValue('N1', 'Date');


				//make the font become bold
				$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
				//merge cell A1 until D1
				//$this->excel->getActiveSheet()->mergeCells('A1:D1');
				//set aligment to center for that merged cell (A1 to D1)
				//$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				//CALL API
					
					$parameter =array(
								'dev_id'			=> $this->dev_id(),
								'actionId'         	=> _ecash_padala_report, 
								'ip_address'		=> $this->ip, 
			    				'regcode'           => $this->user['R']
						    	); 
					$result = $this->curl->call($parameter,url);
				   	$API = json_decode($result,true);
				   	$count = 2;
				   	 foreach ($API['TDATA'] as $A ){
	                   	 	$this->excel->getActiveSheet()->setCellValue('A'.$count, $A['trackingno']);
							$this->excel->getActiveSheet()->setCellValue('B'.$count, $A['regcode']);
							$this->excel->getActiveSheet()->setCellValue('C'.$count, $A['sender_name']);
							$this->excel->getActiveSheet()->setCellValue('D'.$count, $A['sender_id']);
							$this->excel->getActiveSheet()->setCellValue('E'.$count, $A['sender_address']);
							$this->excel->getActiveSheet()->setCellValue('F'.$count, $A['sender_email']);
							$this->excel->getActiveSheet()->setCellValue('G'.$count, $A['sender_mobile']);
							$this->excel->getActiveSheet()->setCellValue('H'.$count, $A['bene_name']);
							$this->excel->getActiveSheet()->setCellValue('I'.$count, $A['bene_id']);
							$this->excel->getActiveSheet()->setCellValue('J'.$count, $A['bene_address']);
							$this->excel->getActiveSheet()->setCellValue('K'.$count, $A['bene_email']);
							$this->excel->getActiveSheet()->setCellValue('L'.$count, $A['bene_mobile']);
							$this->excel->getActiveSheet()->setCellValue('M'.$count, $A['total']);
							$this->excel->getActiveSheet()->setCellValue('N'.$count, $A['datecreated']);
							$count++;                                             
	               	 }
	               	 	$filename="ecash_gprs_outlet".date('ymd').'.xls'; //save our workbook as this file name
		
				 } elseif($concaturl == '/ecash_cashcard'){

				$this->excel->getActiveSheet()->setCellValue('A1', 'Tracking No');
				$this->excel->getActiveSheet()->setCellValue('B1', 'Regcode');
				$this->excel->getActiveSheet()->setCellValue('C1', 'Reference No');
				$this->excel->getActiveSheet()->setCellValue('D1', 'Sender');
				$this->excel->getActiveSheet()->setCellValue('E1', 'Receipient');
				$this->excel->getActiveSheet()->setCellValue('F1', 'Amount');
				$this->excel->getActiveSheet()->setCellValue('G1', 'Charge');
				$this->excel->getActiveSheet()->setCellValue('H1', 'Date/Time');

				//make the font become bold
				$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);

					$parameter =array(
							'dev_id'     		=> $this->global_f->dev_id(),
							'actionId'         	=> _ecash_cashcard, 
							'ip_address'		=> $this->ip, 
		    				'regcode'           => $this->user['R']
					    	);

					$result = $this->curl->call($parameter,url);
				   	$API = json_decode($result,true);
				   	$count = 2;

				   	 foreach ($API['TDATA'] as $B ){
	                   	 	$this->excel->getActiveSheet()->setCellValue('A'.$count, $B['trackno']);
							$this->excel->getActiveSheet()->setCellValue('B'.$count, $B['regcode']);
							$this->excel->getActiveSheet()->setCellValue('C'.$count, $B['referenceno']);
							$this->excel->getActiveSheet()->setCellValue('D'.$count, $B['sender']);
							$this->excel->getActiveSheet()->setCellValue('E'.$count, $B['receipient']);
							$this->excel->getActiveSheet()->setCellValue('F'.$count, $B['amount']);
							$this->excel->getActiveSheet()->setCellValue('G'.$count, $B['charge']);
							$this->excel->getActiveSheet()->setCellValue('H'.$count, $B['date']);
							$count++;                                             
	               	 }
	               	 	$filename="ecash_to_cashcard".date('ymd').'.xls'; //save our workbook as this file name

				} else {//set cell A1 content with some text
				$this->excel->getActiveSheet()->setCellValue('A1', 'Tracking No');
				$this->excel->getActiveSheet()->setCellValue('B1', 'Account Name');
				$this->excel->getActiveSheet()->setCellValue('C1', 'Transaction Type');
				$this->excel->getActiveSheet()->setCellValue('D1', 'Amount');
				$this->excel->getActiveSheet()->setCellValue('E1', 'Charge');
				$this->excel->getActiveSheet()->setCellValue('F1', 'Total');
				$this->excel->getActiveSheet()->setCellValue('G1', 'Date/Time');

				//make the font become bold
				$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);

				//merge cell A1 until D1
				//$this->excel->getActiveSheet()->mergeCells('A1:D1');
				//set aligment to center for that merged cell (A1 to D1)
				//$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				//CALL API
					
					$parameter =array(
								'dev_id'			=> $this->dev_id(),
								'actionId'         	=> _ecash_remittance_report.$concaturl, 
								'ip_address'		=> $this->ip, 
			    				'regcode'           => $this->user['R']
						    	); 
					$result = $this->curl->call($parameter,url);
				   	$API = json_decode($result,true);
				   	$count = 2;
				   	 foreach ($API['TDATA'] as $A ){
	                   	 	$this->excel->getActiveSheet()->setCellValue('A'.$count, $A['trackingno']);
							$this->excel->getActiveSheet()->setCellValue('B'.$count, $A['accountname']);
							$this->excel->getActiveSheet()->setCellValue('C'.$count, $A['transtype']);
							$this->excel->getActiveSheet()->setCellValue('D'.$count, $A['amount']);
							$this->excel->getActiveSheet()->setCellValue('E'.$count, $A['charge']);
							$this->excel->getActiveSheet()->setCellValue('F'.$count, $A['totalamount']);
							$this->excel->getActiveSheet()->setCellValue('G'.$count, $A['postingdate']);
							$count++;                                             
	               	 }
	               	 	$filename=str_replace("/", "", $concaturl).date('ymd').'.xls'; //save our workbook as this file name

				}
				   
				//CALL API
			
				header('Content-Type: application/vnd.ms-excel'); //mime type
				header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
				header('Cache-Control: max-age=0'); //no cache
				            
				//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
				//if you want to save it as .XLSX Excel 2007 format
				$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
				//force user to download the Excel file without writing it to server's HD
				$objWriter->save('php://output');
			
			}else {
				//$this->session->unset_userdata('user');
				$this->session->sess_destroy();
				redirect('Login/');
			}

		
	}

	function export_payout_report(){

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$concaturl = $this->session->userdata('concaturl');

			$this->load->library('excel');
			//activate worksheet number 1
			$this->excel->setActiveSheetIndex(0);
			//name the worksheet
			$this->excel->getActiveSheet()->setTitle('REMITTANCE PAYOUT REPORT');


			if (is_null($concaturl)) {

				$this->excel->getActiveSheet()->setCellValue('A1', 'Tracking No');
				$this->excel->getActiveSheet()->setCellValue('B1', 'Regcode');
				$this->excel->getActiveSheet()->setCellValue('C1', 'Sender Name');
				$this->excel->getActiveSheet()->setCellValue('D1', 'Sender Card No');
				$this->excel->getActiveSheet()->setCellValue('E1', 'Sender Address');
				$this->excel->getActiveSheet()->setCellValue('F1', 'Sender Email');
				$this->excel->getActiveSheet()->setCellValue('G1', 'Sender Mobile');
				$this->excel->getActiveSheet()->setCellValue('H1', 'Benificiary Name');
				$this->excel->getActiveSheet()->setCellValue('I1', 'Benificiary Card No');
				$this->excel->getActiveSheet()->setCellValue('J1', 'Benificiary Address');
				$this->excel->getActiveSheet()->setCellValue('K1', 'Benificiary Email');
				$this->excel->getActiveSheet()->setCellValue('L1', 'Benificiary Mobile');
				$this->excel->getActiveSheet()->setCellValue('M1', 'Amount');
				$this->excel->getActiveSheet()->setCellValue('N1', 'Date');

				//make the font become bold
				$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);

					$parameter =array(
						'dev_id'			=> $this->dev_id(),
						'actionId'         	=> _ecash_padala_report, 
						'ip_address'		=> $this->ip, 
	    				'regcode'           => $this->user['R']
				    	); 

					$result = $this->curl->call($parameter,url);
				   	$API = json_decode($result,true);
				   	$count = 2;

				   	 foreach ($API['TDATA'] as $A ){
	                   	 	$this->excel->getActiveSheet()->setCellValue('A'.$count, $A['trackingno']);
							$this->excel->getActiveSheet()->setCellValue('B'.$count, $A['regcode']);
							$this->excel->getActiveSheet()->setCellValue('C'.$count, $A['sender_name']);
							$this->excel->getActiveSheet()->setCellValue('D'.$count, $A['sender_id']);
							$this->excel->getActiveSheet()->setCellValue('E'.$count, $A['sender_address']);
							$this->excel->getActiveSheet()->setCellValue('F'.$count, $A['sender_email']);
							$this->excel->getActiveSheet()->setCellValue('G'.$count, $A['sender_mobile']);
							$this->excel->getActiveSheet()->setCellValue('H'.$count, $A['bene_name']);
							$this->excel->getActiveSheet()->setCellValue('I'.$count, $A['bene_id']);
							$this->excel->getActiveSheet()->setCellValue('J'.$count, $A['bene_address']);
							$this->excel->getActiveSheet()->setCellValue('K'.$count, $A['bene_email']);
							$this->excel->getActiveSheet()->setCellValue('L'.$count, $A['bene_mobile']);
							$this->excel->getActiveSheet()->setCellValue('M'.$count, $A['total']);
							$this->excel->getActiveSheet()->setCellValue('N'.$count, $A['datecreated']);
							$count++;                                             
	               	 }
	               	 	$filename="ecash_payout_padala".date('ymd').'.xls'; //save our workbook as this file name


			}elseif($concaturl == '/ecash_to_smartmoney_payout' || $concaturl == '/i_remit_payout'){

				$this->excel->getActiveSheet()->setCellValue('A1', 'Tracking No');
				$this->excel->getActiveSheet()->setCellValue('B1', 'Regcode');
				$this->excel->getActiveSheet()->setCellValue('C1', 'Account Name');
				$this->excel->getActiveSheet()->setCellValue('D1', 'Type');
				$this->excel->getActiveSheet()->setCellValue('E1', 'Amount');
				$this->excel->getActiveSheet()->setCellValue('F1', 'Charge');
				$this->excel->getActiveSheet()->setCellValue('G1', 'Total');
				$this->excel->getActiveSheet()->setCellValue('H1', 'Date/Time');

				//make the font become bold
				$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);

					$parameter =array(
						'dev_id'			=> $this->input->server('HTTP_USER_AGENT'),
						'actionId'         	=> _ecash_remittance_report.$concaturl, 
						'ip_address'		=> $this->ip, 
	    				'regcode'           => $this->user['R']
				    	); 

					$result = $this->curl->call($parameter,url);
				   	$API = json_decode($result,true);
				   	$count = 2;

				   	 foreach ($API['TDATA'] as $A ){
	                   	 	$this->excel->getActiveSheet()->setCellValue('A'.$count, $A['trackingno']);
							$this->excel->getActiveSheet()->setCellValue('B'.$count, $A['regcode']);
							$this->excel->getActiveSheet()->setCellValue('C'.$count, $A['accountname']);
							$this->excel->getActiveSheet()->setCellValue('D'.$count, $A['transtype']);
							$this->excel->getActiveSheet()->setCellValue('E'.$count, $A['amount']);
							$this->excel->getActiveSheet()->setCellValue('F'.$count, $A['charge']);
							$this->excel->getActiveSheet()->setCellValue('G'.$count, $A['totalamount']);
							$this->excel->getActiveSheet()->setCellValue('H'.$count, $A['postingdate']);
							$count++;                                             
	               	 }
	               	 	$filename=str_replace("/", "", $concaturl).date('ymd').'.xls'; //save our workbook as this file name

			}elseif($concaturl == '/moneygram_payout'){


				$this->excel->getActiveSheet()->setCellValue('A1', 'RefNo');
				$this->excel->getActiveSheet()->setCellValue('B1', 'Tracking No');
				$this->excel->getActiveSheet()->setCellValue('C1', 'Receipt No');
				$this->excel->getActiveSheet()->setCellValue('D1', 'Currency');
				$this->excel->getActiveSheet()->setCellValue('E1', 'Amount');
				$this->excel->getActiveSheet()->setCellValue('F1', 'Charge');
				$this->excel->getActiveSheet()->setCellValue('G1', 'Beneficiary Name');
				$this->excel->getActiveSheet()->setCellValue('H1', 'Beneficiary Mobile');
				$this->excel->getActiveSheet()->setCellValue('I1', 'ID Type');
				$this->excel->getActiveSheet()->setCellValue('J1', 'ID No');
				$this->excel->getActiveSheet()->setCellValue('K1', 'Payout Amount');
				$this->excel->getActiveSheet()->setCellValue('L1', 'Date/Time');

				//make the font become bold
				$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);


					$parameter =array(
						'dev_id'			=> $this->dev_id(),
						'actionId'         	=> _ecash_payout_report.$concaturl, 
						'ip_address'		=> $this->ip, 
	    				'regcode'           => $this->user['R']
				    	); 

					$result = $this->curl->call($parameter,url);
				   	$API = json_decode($result,true);
				   	$count = 2;

				   	 foreach ($API['TDATA'] as $A ){
	                   	 	$this->excel->getActiveSheet()->setCellValue('A'.$count, $A['refno']);
							$this->excel->getActiveSheet()->setCellValue('B'.$count, $A['trackingno']);
							$this->excel->getActiveSheet()->setCellValue('C'.$count, $A['receiptNo']);
							$this->excel->getActiveSheet()->setCellValue('D'.$count, $A['currency']);
							$this->excel->getActiveSheet()->setCellValue('E'.$count, $A['amount']);
							$this->excel->getActiveSheet()->setCellValue('F'.$count, $A['charge']);
							$this->excel->getActiveSheet()->setCellValue('G'.$count, $A['benefName']);
							$this->excel->getActiveSheet()->setCellValue('H'.$count, $A['benefTelno']);
							$this->excel->getActiveSheet()->setCellValue('I'.$count, $A['valid_id']);
							$this->excel->getActiveSheet()->setCellValue('J'.$count, $A['id_no']);
							$this->excel->getActiveSheet()->setCellValue('K'.$count, $A['payoutAmount']);
							$this->excel->getActiveSheet()->setCellValue('L'.$count, $A['postingdate']);
							$count++;                                             
	               	 }
	               	 	$filename=str_replace("/", "", $concaturl).date('ymd').'.xls'; //save our workbook as this file name

			}else{

				$this->excel->getActiveSheet()->setCellValue('A1', 'Tracking No');
				$this->excel->getActiveSheet()->setCellValue('B1', 'Regcode');
				$this->excel->getActiveSheet()->setCellValue('C1', 'RefNo');
				$this->excel->getActiveSheet()->setCellValue('D1', 'Beneficiary Name');
				$this->excel->getActiveSheet()->setCellValue('E1', 'Beneficiary Contact');
				$this->excel->getActiveSheet()->setCellValue('F1', 'Type');
				$this->excel->getActiveSheet()->setCellValue('G1', 'Amount');
				$this->excel->getActiveSheet()->setCellValue('H1', 'Date/Time');

				//make the font become bold
				$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);


					$concaturl = $this->r->sendRequestPayout($INPUT_POST['selEcashPayout']);
					$this->session->set_userdata('concaturl',$concaturl);
					$parameter =array(
						'dev_id'			=> $this->dev_id(),
						'actionId'         	=> _ecash_payout_report.$concaturl, 
						'ip_address'		=> $this->ip, 
	    				'regcode'           => $this->user['R']
				    	); 

				   	 foreach ($API['TDATA'] as $A ){
	                   	 	$this->excel->getActiveSheet()->setCellValue('A'.$count, $A['trackingno']);
							$this->excel->getActiveSheet()->setCellValue('B'.$count, $A['regcode']);
							$this->excel->getActiveSheet()->setCellValue('C'.$count, $A['refno']);
							$this->excel->getActiveSheet()->setCellValue('D'.$count, $A['benefName']);
							$this->excel->getActiveSheet()->setCellValue('E'.$count, $A['benefTelno']);
							$this->excel->getActiveSheet()->setCellValue('F'.$count, $A['valid_id']);
							$this->excel->getActiveSheet()->setCellValue('G'.$count, $A['amount']);
							$this->excel->getActiveSheet()->setCellValue('H'.$count, $A['postingdate']);
							$count++;                                             
	               	 }
	               	 	$filename=str_replace("/", "", $concaturl).date('ymd').'.xls'; //save our workbook as this file name


			}

				//CALL API
			
				header('Content-Type: application/vnd.ms-excel'); //mime type
				header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
				header('Cache-Control: max-age=0'); //no cache
				            
				//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
				//if you want to save it as .XLSX Excel 2007 format
				$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
				//force user to download the Excel file without writing it to server's HD
				$objWriter->save('php://output');


		}else {
			$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}


	}


	function export_billspayment_report(){
		
			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				
				
				$this->load->library('excel');
				//activate worksheet number 1
				$this->excel->setActiveSheetIndex(0);
				//name the worksheet
				$this->excel->getActiveSheet()->setTitle('BILLSPAYMENT REPORT');
				//set cell A1 content with some text
									
				$this->excel->getActiveSheet()->setCellValue('A1', 'Tracking #');
				$this->excel->getActiveSheet()->setCellValue('B1', 'Regcode');
				$this->excel->getActiveSheet()->setCellValue('C1', 'Institution	');
				$this->excel->getActiveSheet()->setCellValue('D1', 'Biller');
				$this->excel->getActiveSheet()->setCellValue('E1', 'Account #');
				$this->excel->getActiveSheet()->setCellValue('F1', 'Account Name');
				$this->excel->getActiveSheet()->setCellValue('G1', 'Amount');
				$this->excel->getActiveSheet()->setCellValue('H1', 'Date/Time');

				//make the font become bold
				$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);

				//merge cell A1 until D1
				//$this->excel->getActiveSheet()->mergeCells('A1:D1');
				//set aligment to center for that merged cell (A1 to D1)
				//$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				//CALL API
					$parameter =array(
								'dev_id'			=> $this->dev_id(),
								'actionId'          => _billspayment_report, 
								'ip_address'		=> $this->ip, 
			    				'regcode'           => $this->user['R']
	
						    	); 

				    $result = $this->curl->call($parameter,url);
				   	$API = json_decode($result,true);
				   	$count = 2;
				   	 foreach ($API['TDATA'] as $A ){
	                   	 	$this->excel->getActiveSheet()->setCellValue('A'.$count, $A['TN']);
							$this->excel->getActiveSheet()->setCellValue('B'.$count, $A['R']);
							$this->excel->getActiveSheet()->setCellValue('C'.$count, $A['IC']);
							$this->excel->getActiveSheet()->setCellValue('D'.$count, $A['BN']);
							$this->excel->getActiveSheet()->setCellValue('E'.$count, $A['ACNO']);
							$this->excel->getActiveSheet()->setCellValue('F'.$count, $A['ACNM']);
							$this->excel->getActiveSheet()->setCellValue('G'.$count, $A['A']);
							$this->excel->getActiveSheet()->setCellValue('H'.$count, $A['D']);
				
							$count++;                                             
	               	 }
				//CALL API
				$filename='billspayment'.date('ymd').'.xls'; //save our workbook as this file name
				header('Content-Type: application/vnd.ms-excel'); //mime type
				header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
				header('Cache-Control: max-age=0'); //no cache
				            
				//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
				//if you want to save it as .XLSX Excel 2007 format
				$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
				//force user to download the Excel file without writing it to server's HD
				$objWriter->save('php://output');
			
			}else {
				//$this->session->unset_userdata('user');
				$this->session->sess_destroy();
				redirect('Login/');
			}

		
	}
		function export_loading_report(){
		
			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				
				$arr = $this->session->userdata('arr');
				if ($arr['startdate'] == "" || $arr['enddate'] == "") {
					echo "Invalid Date";
					die();
				}
				if ($arr['url'] == "") {
					echo "invalid URL";
					die();
				}
				$this->load->library('excel');
				//activate worksheet number 1
				$this->excel->setActiveSheetIndex(0);
				//name the worksheet
				$this->excel->getActiveSheet()->setTitle('LOADING REPORT');
				//set cell A1 content with some text
				$count = count($arr['field']) - 1;
				$x = 0;
				// var_dump($arr);
				// die();
				foreach(range('A','Z') as $i) {
						if ($x<=$count){
							$this->excel->getActiveSheet()->setCellValue($i. 1, $arr['field'][$x]);
	
						}
						$x++;
				}					

				
						$parameter =array(
								'dev_id'			=> $this->dev_id(),
								'actionId'          => $arr['url'], 
								'ip_address'		=> $this->ip, 
								'regcode'           => $this->user['R'],
								'startdate'			=> $arr['startdate'],
								'enddate'			=> $arr['enddate']
						    	); 
				    $result = $this->curl->call($parameter,url);
				   	$API = json_decode($result,true);
				   	$count = 2;
				  
				   	if ($arr['TBODY'] == 1) {
				   		foreach ($API['TDATA'] as $l ){
						   $this->excel->getActiveSheet()->setCellValue('A'.$count,$l['TN']);
						   $this->excel->getActiveSheet()->setCellValue('B'.$count,$l['MN']);
						   $this->excel->getActiveSheet()->setCellValue('C'.$count,$l['RG']);
						   $this->excel->getActiveSheet()->setCellValue('D'.$count,$l['PL']);
						   $this->excel->getActiveSheet()->setCellValue('E'.$count,$l['PD']);
						   $this->excel->getActiveSheet()->setCellValue('F'.$count,$l['TD']);
						   $count++;                                             
	               	 	}
				   	}elseif ($arr['TBODY'] == 2) {
				   		foreach ($API['TDATA'] as $l ){
						   $this->excel->getActiveSheet()->setCellValue('A'.$count,$l['TR']);
						   $this->excel->getActiveSheet()->setCellValue('B'.$count,$l['RG']);
						   $this->excel->getActiveSheet()->setCellValue('C'.$count,$l['MN']);
						   $this->excel->getActiveSheet()->setCellValue('D'.$count,$l['TT']);
						   $this->excel->getActiveSheet()->setCellValue('E'.$count,$l['ST']);
						   $this->excel->getActiveSheet()->setCellValue('F'.$count,$l['TN']);
						   $this->excel->getActiveSheet()->setCellValue('G'.$count,$l['AM']);
						   $this->excel->getActiveSheet()->setCellValue('H'.$count,$l['DT']);
						   $this->excel->getActiveSheet()->setCellValue('I'.$count,$l['PT']);
						   $this->excel->getActiveSheet()->setCellValue('J'.$count,$l['CT']);
						   $this->excel->getActiveSheet()->setCellValue('K'.$count,$l['ST']);
						   $this->excel->getActiveSheet()->setCellValue('L'.$count,$l['BL']);
						   $this->excel->getActiveSheet()->setCellValue('M'.$count,$l['PS']);
						   $count++; 
					                                          
	               	 	}
				   	}elseif ($arr['TBODY'] == 3 || $arr['TBODY'] == 4){
				   		foreach ($API['TDATA'] as $l ){
						   $this->excel->getActiveSheet()->setCellValue('A'.$count,$l['TR']);
						   $this->excel->getActiveSheet()->setCellValue('B'.$count,$l['RG']);
						   $this->excel->getActiveSheet()->setCellValue('C'.$count,$l['MN']);
						   $this->excel->getActiveSheet()->setCellValue('D'.$count,$l['TT']);
						   $this->excel->getActiveSheet()->setCellValue('E'.$count,$l['ST']);
						   $this->excel->getActiveSheet()->setCellValue('F'.$count,$l['TN']);
						   $this->excel->getActiveSheet()->setCellValue('G'.$count,$l['RN']);
						   $this->excel->getActiveSheet()->setCellValue('H'.$count,$l['AM']);
						   $this->excel->getActiveSheet()->setCellValue('I'.$count,$l['PL']);
						   $this->excel->getActiveSheet()->setCellValue('J'.$count,$l['RE']);
						   $this->excel->getActiveSheet()->setCellValue('K'.$count,$l['DT']);
						   $this->excel->getActiveSheet()->setCellValue('L'.$count,$l['PT']);
						   $this->excel->getActiveSheet()->setCellValue('M'.$count,$l['CT']);
						   $this->excel->getActiveSheet()->setCellValue('N'.$count,$l['BL']);
						   $this->excel->getActiveSheet()->setCellValue('O'.$count,$l['PS']);
						   $count++; 
					      }                         
	               	 	}elseif ($arr['TBODY'] == 5 || $arr['TBODY'] == 6) {
	               	 		foreach ($API['TDATA'] as $l ){
			               	 		$this->excel->getActiveSheet()->setCellValue('A'.$count,$l['TN']);
								   $this->excel->getActiveSheet()->setCellValue('B'.$count,$l['R']);
								   $this->excel->getActiveSheet()->setCellValue('C'.$count,$l['PL']);
								   $this->excel->getActiveSheet()->setCellValue('D'.$count,$l['MN']);
								   $this->excel->getActiveSheet()->setCellValue('E'.$count,$l['TT']);
								   $this->excel->getActiveSheet()->setCellValue('F'.$count,$l['TL']);
								   $this->excel->getActiveSheet()->setCellValue('G'.$count,$l['RN']);
								   $this->excel->getActiveSheet()->setCellValue('H'.$count,$l['ST']);
								   $this->excel->getActiveSheet()->setCellValue('I'.$count,$l['PO']);
								   $this->excel->getActiveSheet()->setCellValue('J'.$count,$l['PR']);
	       					  $count++;

	               	 	}
				   	}
				   

				//CALL API
				$filename='loading'.date('ymd').'.xls'; //save our workbook as this file name
				header('Content-Type: application/vnd.ms-excel'); //mime type
				header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
				header('Cache-Control: max-age=0'); //no cache
				            
				//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
				//if you want to save it as .XLSX Excel 2007 format
				$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
				//force user to download the Excel file without writing it to server's HD
				$objWriter->save('php://output');
			
			}else {
				//$this->session->unset_userdata('user');
				$this->session->sess_destroy();
				redirect('Login/');
			}

		
	}
	


			function sendRequest($int)
		{
			$url = "";
			switch ($int) {
				case 1:
					$url="/ecash_to_ecash";
					break;
				case 2:
					$url="/ecash_to_smartmoney";
					break;
				case 3:
					$url="/ecash_credit_bank";
					break;	
				case 4:
					$url="/ecash_cashcard";
					break;
				default:
					$url="Invalid SendRequest";
					break;
			}
			return $url;
		}


			function sendRequestPayout($int)
		{
			$url = "";
			switch ($int) {
				case 1:
					$url="/transfast_payout";
					break;
				case 2:
					$url="/abscbn_remit_payout";
					break;
				case 3:
					$url="/newyork_bay_payout";
					break;	
				case 4:
					$url="/moneygram_payout";
					break;	
				case 5:
					$url="/ecash_to_smartmoney_payout";
					break;
				case 6:
					$url="/i_remit_payout";
					break;
				default:
					$url="Invalid SendRequest";
					break;
			}
			return $url;
		}
}