<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Report_model extends CI_Model {
	
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

   	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('curl_model','curl');
		$this->load->library('session');
		$this->user = $this->session->userdata('user');
	    // $this->ip = $this->input->ip_address();
	    $IP = $_SERVER['REMOTE_ADDR'];

        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
            $IP = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
        }

        $this->ip = $IP;
        
	    $this->load->model('Query_model','q');
	  	$this->load->model('Report_model','r');
	  	$this->load->model('Global_function','global_f');

	}


	//GENERATE REPORT//


	function export_sgd_fund_report()
	{
		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$inputdate=$this->session->userdata('inputdate');
			if ($inputdate['startdate'] == "" || $inputdate['enddate'] == "") {
				echo "Invalid Date";
				die();
			}
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			//activate worksheet number 1
			$spreadsheet->setActiveSheetIndex(0);
			//name the worksheet
			$sheet->setTitle('SGD FUND REPORT');
			
			//set cell A1 content with some text
			$sheet->setCellValue('A1', 'Control No');
			$sheet->setCellValue('B1', 'Designation');
			$sheet->setCellValue('C1', 'Plancode');
			$sheet->setCellValue('D1', 'Transtype');
			$sheet->setCellValue('E1', 'Ref No');
			$sheet->setCellValue('F1', 'Tracking No');
			$sheet->setCellValue('G1', 'Amount');
			$sheet->setCellValue('H1', 'Retail');
			$sheet->setCellValue('I1', 'Debit');
			$sheet->setCellValue('J1', 'Profit');
			$sheet->setCellValue('K1', 'Credit');
			$sheet->setCellValue('L1', 'Balance');
			$sheet->setCellValue('M1', 'Date');

			//make the font become bold
			$sheet->getStyle('A1')->getFont()->setBold(true);
			$sheet->getStyle('B1')->getFont()->setBold(true);
			$sheet->getStyle('C1')->getFont()->setBold(true);
			$sheet->getStyle('D1')->getFont()->setBold(true);
			$sheet->getStyle('E1')->getFont()->setBold(true);
			$sheet->getStyle('F1')->getFont()->setBold(true);
			$sheet->getStyle('G1')->getFont()->setBold(true);
			$sheet->getStyle('H1')->getFont()->setBold(true);
			$sheet->getStyle('I1')->getFont()->setBold(true);
			$sheet->getStyle('J1')->getFont()->setBold(true);
			$sheet->getStyle('K1')->getFont()->setBold(true);
			$sheet->getStyle('L1')->getFont()->setBold(true);
			$sheet->getStyle('M1')->getFont()->setBold(true);

			//CALL API
			
			$url = 'ups_report_service/sgd_fund_reports';
			$parameter =array(
					'dev_id'			=> $this->global_f->dev_id(),
					'actionId'          => $url,
					'ip_address'		=> $this->ip,
					'regcode'           => $this->user['R'],
					'startdate'			=> $inputdate['startdate'],
					'enddate'			=> $inputdate['enddate']
			);

			$result = $this->curl->call($parameter,url);
			$API = json_decode($result,true);

			$count = 2;
			foreach ($API['TDATA'] as $A ){
				$sheet->setCellValueExplicit('A'.$count, $A['controlno'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValueExplicit('B'.$count, $A['mobileno'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValueExplicit('C'.$count, $A['plancode'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValue('D'.$count, $A['transtype']);
				$sheet->setCellValueExplicit('E'.$count, $A['refno'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValueExplicit('F'.$count, $A['trackingno'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValue('G'.$count, $A['amount']);
				$sheet->setCellValue('H'.$count, $A['retail']);
				$sheet->setCellValue('I'.$count, $A['debit']);
				$sheet->setCellValue('J'.$count, $A['profit']);
				$sheet->setCellValue('K'.$count, $A['credit']);
				$sheet->setCellValue('L'.$count, $A['balance']);
				$sheet->setCellValue('M'.$count, $A['transDate']);
				$count++;
			}
			$cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(true);
			foreach ($cellIterator as $cell) {
				$sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
			}
			//CALL API
			$filename='sgd_fund_report'.date('ymd').'.xlsx'; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache

			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}

	}

	function export_general_report(){
		
			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$inputdate=$this->session->userdata('inputdate');
				if ($inputdate['startdate'] == "" || $inputdate['enddate'] == "") {
					echo "Invalid Date";
					die();
				}
				$spreadsheet = new Spreadsheet();
				$sheet = $spreadsheet->getActiveSheet();
				//activate worksheet number 1
				$spreadsheet->setActiveSheetIndex(0);
				//name the worksheet
				$sheet->setTitle('GENERAL REPORT');
				
				//set cell A1 content with some text
				$sheet->setCellValue('A1', 'Sequence No');
				$sheet->setCellValue('B1', 'Transaction No');
				$sheet->setCellValue('C1', 'Transaction Type');
				$sheet->setCellValue('D1', 'Amount');
				$sheet->setCellValue('E1', 'Charge');
				$sheet->setCellValue('F1', 'Income');
				$sheet->setCellValue('G1', 'Balance Before');
				$sheet->setCellValue('H1', 'Balance After');
				$sheet->setCellValue('I1', 'Date');

				//make the font become bold
				$sheet->getStyle('A1')->getFont()->setBold(true);
				$sheet->getStyle('B1')->getFont()->setBold(true);
				$sheet->getStyle('C1')->getFont()->setBold(true);
				$sheet->getStyle('D1')->getFont()->setBold(true);
				$sheet->getStyle('E1')->getFont()->setBold(true);
				$sheet->getStyle('F1')->getFont()->setBold(true);
				$sheet->getStyle('G1')->getFont()->setBold(true);
				$sheet->getStyle('H1')->getFont()->setBold(true);
				$sheet->getStyle('I1')->getFont()->setBold(true);
				//merge cell A1 until D1
				//$sheet->mergeCells('A1:D1');
				//set aligment to center for that merged cell (A1 to D1)
				//$sheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				//CALL API
					$parameter =array(
								'dev_id'			=> $this->global_f->dev_id(),
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
	                   	 	$sheet->setCellValue('A'.$count, $A['SN']);
							$sheet->setCellValueExplicit('B'.$count, $A['TN'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
							$sheet->setCellValue('C'.$count, $A['TP']);
							$sheet->setCellValue('D'.$count, $A['A']);
							$sheet->setCellValue('E'.$count, $A['C']);
							$sheet->setCellValue('F'.$count, $A['IC']);
							$sheet->setCellValue('G'.$count, $A['BB']);
							$sheet->setCellValue('H'.$count, $A['BA']);
							$sheet->setCellValue('I'.$count, $A['D']);	
							$count++;
	               	 }
					$cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
					$cellIterator->setIterateOnlyExistingCells(true);
					foreach ($cellIterator as $cell) {
						$sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
					}
				//CALL API
				$filename='general_report'.date('ymd').'.xlsx'; //save our workbook as this file name
				header('Content-Type: application/vnd.ms-excel'); //mime type
				header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
				header('Cache-Control: max-age=0'); //no cache
				            
				//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
				//if you want to save it as .XLSX Excel 2007 format
				$objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
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
				$spreadsheet = new Spreadsheet();
				//activate worksheet number 1
				$spreadsheet->setActiveSheetIndex(0);
				//name the worksheet
				$sheet->setTitle('REMITTANCE SEND REPORT');

				if (is_null($concaturl)) {
				
				$sheet->setCellValue('A1', 'Tracking No');
				$sheet->setCellValue('B1', 'Regcode');
				$sheet->setCellValue('C1', 'Sender Name');
				$sheet->setCellValue('D1', 'Sender Card No');
				$sheet->setCellValue('E1', 'Sender Address');
				$sheet->setCellValue('F1', 'Sender Email');
				$sheet->setCellValue('G1', 'Sender Mobile');
				$sheet->setCellValue('H1', 'Benificiary Name');
				$sheet->setCellValue('I1', 'Benificiary Card No');
				$sheet->setCellValue('J1', 'Benificiary Address');
				$sheet->setCellValue('K1', 'Benificiary Email');
				$sheet->setCellValue('L1', 'Benificiary Mobile');
				$sheet->setCellValue('M1', 'Amount');
				$sheet->setCellValue('N1', 'Date');


				//make the font become bold
				$sheet->getStyle('A1')->getFont()->setBold(true);
				$sheet->getStyle('B1')->getFont()->setBold(true);
				$sheet->getStyle('C1')->getFont()->setBold(true);
				$sheet->getStyle('D1')->getFont()->setBold(true);
				$sheet->getStyle('E1')->getFont()->setBold(true);
				$sheet->getStyle('F1')->getFont()->setBold(true);
				$sheet->getStyle('G1')->getFont()->setBold(true);
				$sheet->getStyle('H1')->getFont()->setBold(true);
				$sheet->getStyle('I1')->getFont()->setBold(true);
				$sheet->getStyle('J1')->getFont()->setBold(true);
				$sheet->getStyle('K1')->getFont()->setBold(true);
				$sheet->getStyle('L1')->getFont()->setBold(true);
				$sheet->getStyle('M1')->getFont()->setBold(true);
				$sheet->getStyle('N1')->getFont()->setBold(true);
				//merge cell A1 until D1
				//$sheet->mergeCells('A1:D1');
				//set aligment to center for that merged cell (A1 to D1)
				//$sheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				//CALL API
					
					$parameter =array(
								'dev_id'			=> $this->global_f->dev_id(),
								'actionId'         	=> _ecash_padala_report, 
								'ip_address'		=> $this->ip, 
			    				'regcode'           => $this->user['R']
						    	);
					$result = $this->curl->call($parameter,url);
				   	$API = json_decode($result,true);
				   	$count = 2;
				   	 foreach ($API['TDATA'] as $A ){
	                   	 	$sheet->setCellValue('A'.$count, $A['trackingno']);
							$sheet->setCellValue('B'.$count, $A['regcode']);
							$sheet->setCellValue('C'.$count, $A['sender_name']);
							$sheet->setCellValue('D'.$count, $A['sender_id']);
							$sheet->setCellValue('E'.$count, $A['sender_address']);
							$sheet->setCellValue('F'.$count, $A['sender_email']);
							$sheet->setCellValue('G'.$count, $A['sender_mobile']);
							$sheet->setCellValue('H'.$count, $A['bene_name']);
							$sheet->setCellValue('I'.$count, $A['bene_id']);
							$sheet->setCellValue('J'.$count, $A['bene_address']);
							$sheet->setCellValue('K'.$count, $A['bene_email']);
							$sheet->setCellValue('L'.$count, $A['bene_mobile']);
							$sheet->setCellValue('M'.$count, $A['total']);
							$sheet->setCellValue('N'.$count, $A['datecreated']);
							$count++;
	               	 }
	               	 	$filename="ecash_gprs_outlet".date('Ymd').'.xlsx'; //save our workbook as this file name
		
				 } elseif($concaturl == '/ecash_cashcard'){

				$sheet->setCellValue('A1', 'Tracking No');
				$sheet->setCellValue('B1', 'Regcode');
				$sheet->setCellValue('C1', 'Reference No');
				$sheet->setCellValue('D1', 'Sender');
				$sheet->setCellValue('E1', 'Receipient');
				$sheet->setCellValue('F1', 'Amount');
				$sheet->setCellValue('G1', 'Charge');
				$sheet->setCellValue('H1', 'Date/Time');

				//make the font become bold
				$sheet->getStyle('A1')->getFont()->setBold(true);
				$sheet->getStyle('B1')->getFont()->setBold(true);
				$sheet->getStyle('C1')->getFont()->setBold(true);
				$sheet->getStyle('D1')->getFont()->setBold(true);
				$sheet->getStyle('E1')->getFont()->setBold(true);
				$sheet->getStyle('F1')->getFont()->setBold(true);
				$sheet->getStyle('G1')->getFont()->setBold(true);
				$sheet->getStyle('H1')->getFont()->setBold(true);

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
	                   	 	$sheet->setCellValue('A'.$count, $B['trackno']);
							$sheet->setCellValue('B'.$count, $B['regcode']);
							$sheet->setCellValue('C'.$count, $B['referenceno']);
							$sheet->setCellValue('D'.$count, $B['sender']);
							$sheet->setCellValue('E'.$count, $B['receipient']);
							$sheet->setCellValue('F'.$count, $B['amount']);
							$sheet->setCellValue('G'.$count, $B['charge']);
							$sheet->setCellValue('H'.$count, $B['date']);
							$count++;
	               	 }
	               	 	$filename="ecash_to_cashcard".date('Ymd').'.xlsx'; //save our workbook as this file name

	            } elseif($concaturl == '/ecash_to_paymaya'){

				$sheet->setCellValue('A1', 'Tracking No');
				$sheet->setCellValue('B1', 'Regcode');
				$sheet->setCellValue('C1', 'Reference No');
				$sheet->setCellValue('D1', 'Sender');
				$sheet->setCellValue('E1', 'Beneficiary');
				$sheet->setCellValue('F1', 'Amount');
				$sheet->setCellValue('G1', 'Charge');
				$sheet->setCellValue('H1', 'Date/Time');

				//make the font become bold
				$sheet->getStyle('A1')->getFont()->setBold(true);
				$sheet->getStyle('B1')->getFont()->setBold(true);
				$sheet->getStyle('C1')->getFont()->setBold(true);
				$sheet->getStyle('D1')->getFont()->setBold(true);
				$sheet->getStyle('E1')->getFont()->setBold(true);
				$sheet->getStyle('F1')->getFont()->setBold(true);
				$sheet->getStyle('G1')->getFont()->setBold(true);
				$sheet->getStyle('H1')->getFont()->setBold(true);

					$parameter =array(
							'dev_id'     		=> $this->global_f->dev_id(),
							// 'actionId'         	=> "ups_paymaya_service_rev2/get_transaction_report", 
							'actionId'         	=> "ups_report_service/smartmoney_report", 
							'ip_address'		=> $this->ip, 
		    				'regcode'           => $this->user['R']
					    	);

					$result = $this->curl->call($parameter,url);
				   	$API = json_decode($result,true);
				   	$count = 2;

				   	 foreach ($API['TDATA'] as $B ){
	                   	 	$sheet->setCellValue('A'.$count, $B['trackingNumber']);
							$sheet->setCellValue('B'.$count, $B['regcode']);
							$sheet->setCellValue('C'.$count, $B['referenceNumber']);
							$sheet->setCellValue('D'.$count, $B['senderDetails.firstName']. " " .$B['senderDetails.middleName']. " " .$B['senderDetails.lastName']);
							$sheet->setCellValue('E'.$count, $B['beneficiaryDetails.firstName']. " " .$B['beneficiaryDetails.middleName']. " " .$B['beneficiaryDetails.lastName']);
							$sheet->setCellValue('F'.$count, $B['amount']);
							$sheet->setCellValue('G'.$count, $B['charge']);
							$sheet->setCellValue('H'.$count, $B['createdAt']);
							$count++;
	               	 }
	               	 	$filename="ecash_to_paymaya".date('Ymd').'.xlsx'; //save our workbook as this file name


				} ////






				else {//set cell A1 content with some text
				$sheet->setCellValue('A1', 'Tracking No');
				$sheet->setCellValue('B1', 'Account Name');
				$sheet->setCellValue('C1', 'Transaction Type');
				$sheet->setCellValue('D1', 'Amount');
				$sheet->setCellValue('E1', 'Charge');
				$sheet->setCellValue('F1', 'Total');
				$sheet->setCellValue('G1', 'Date/Time');

				//make the font become bold
				$sheet->getStyle('A1')->getFont()->setBold(true);
				$sheet->getStyle('B1')->getFont()->setBold(true);
				$sheet->getStyle('C1')->getFont()->setBold(true);
				$sheet->getStyle('D1')->getFont()->setBold(true);
				$sheet->getStyle('E1')->getFont()->setBold(true);
				$sheet->getStyle('F1')->getFont()->setBold(true);
				$sheet->getStyle('G1')->getFont()->setBold(true);

				//merge cell A1 until D1
				//$sheet->mergeCells('A1:D1');
				//set aligment to center for that merged cell (A1 to D1)
				//$sheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				//CALL API
					
					$parameter =array(
								'dev_id'			=> $this->global_f->dev_id(),
								'actionId'         	=> _ecash_remittance_report.$concaturl, 
								'ip_address'		=> $this->ip, 
			    				'regcode'           => $this->user['R']
						    	);
					$result = $this->curl->call($parameter,url);
				   	$API = json_decode($result,true);
				   	$count = 2;
				   	 foreach ($API['TDATA'] as $A ){
	                   	 	$sheet->setCellValue('A'.$count, $A['trackingno']);
							$sheet->setCellValue('B'.$count, $A['accountname']);
							$sheet->setCellValue('C'.$count, $A['transtype']);
							$sheet->setCellValue('D'.$count, $A['amount']);
							$sheet->setCellValue('E'.$count, $A['charge']);
							$sheet->setCellValue('F'.$count, $A['totalamount']);
							$sheet->setCellValue('G'.$count, $A['postingdate']);
							$count++;
	               	 }
	               	 	$filename=str_replace("/", "", $concaturl).date('Ymd').'.xlsx'; //save our workbook as this file name

				}
				//CALL API
				$cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
				$cellIterator->setIterateOnlyExistingCells(true);
				foreach ($cellIterator as $cell) {
					$sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
				}
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="'.$filename.'"');
				header('Cache-Control: max-age=0');

				$objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
				$objWriter->save('php://output');
			
				//header('Content-Type: application/vnd.ms-excel'); //mime type
				//header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
				//header('Cache-Control: max-age=0'); //no cache
				            
				//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
				//if you want to save it as .XLSX Excel 2007 format
				//$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
				//force user to download the Excel file without writing it to server's HD
				//$objWriter->save('php://output');
			
			}else {
				//$this->session->unset_userdata('user');
				$this->session->sess_destroy();
				redirect('Login/');
			}

		
	}

	function export_payout_report(){

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$concaturl = $this->session->userdata('concaturl');

			$spreadsheet = new Spreadsheet();
			$spreadsheet->setActiveSheetIndex(0);
			//activate worksheet number 1
			$sheet->setActiveSheetIndex(0);
			//name the worksheet
			$sheet->setTitle('REMITTANCE PAYOUT REPORT');


			if (is_null($concaturl)) {

				$sheet->setCellValue('A1', 'Tracking No');
				$sheet->setCellValue('B1', 'Regcode');
				$sheet->setCellValue('C1', 'Payout Regcode');
				$sheet->setCellValue('D1', 'Sender Name');
				$sheet->setCellValue('E1', 'Sender Card No');
				$sheet->setCellValue('F1', 'Sender Address');
				$sheet->setCellValue('G1', 'Sender Email');
				$sheet->setCellValue('H1', 'Sender Mobile');
				$sheet->setCellValue('I1', 'Benificiary Name');
				$sheet->setCellValue('J1', 'Benificiary Card No');
				$sheet->setCellValue('K1', 'Benificiary Address');
				$sheet->setCellValue('L1', 'Benificiary Email');
				$sheet->setCellValue('M1', 'Benificiary Mobile');
				$sheet->setCellValue('N1', 'Amount');
				$sheet->setCellValue('O1', 'Date');

				//make the font become bold
				$sheet->getStyle('A1')->getFont()->setBold(true);
				$sheet->getStyle('B1')->getFont()->setBold(true);
				$sheet->getStyle('C1')->getFont()->setBold(true);
				$sheet->getStyle('D1')->getFont()->setBold(true);
				$sheet->getStyle('E1')->getFont()->setBold(true);
				$sheet->getStyle('F1')->getFont()->setBold(true);
				$sheet->getStyle('G1')->getFont()->setBold(true);
				$sheet->getStyle('H1')->getFont()->setBold(true);
				$sheet->getStyle('I1')->getFont()->setBold(true);
				$sheet->getStyle('J1')->getFont()->setBold(true);
				$sheet->getStyle('K1')->getFont()->setBold(true);
				$sheet->getStyle('L1')->getFont()->setBold(true);
				$sheet->getStyle('M1')->getFont()->setBold(true);
				$sheet->getStyle('N1')->getFont()->setBold(true);
				$sheet->getStyle('O1')->getFont()->setBold(true);

					$parameter =array(
						'dev_id'			=> $this->global_f->dev_id(),
						'actionId'         	=> _ecash_padala_payout_report, 
						'ip_address'		=> $this->ip, 
	    				'regcode'           => $this->user['R']
				    	);

					$result = $this->curl->call($parameter,url);
				   	$API = json_decode($result,true);
				   	$count = 2;

				   	 foreach ($API['TDATA'] as $A ){
	                   	 	$sheet->setCellValue('A'.$count, $A['trackingno']);
							$sheet->setCellValue('B'.$count, $A['regcode']);
							$sheet->setCellValue('C'.$count, $A['payoutregcode']);
							$sheet->setCellValue('D'.$count, $A['sender_name']);
							$sheet->setCellValue('E'.$count, $A['sender_id']);
							$sheet->setCellValue('F'.$count, $A['sender_address']);
							$sheet->setCellValue('G'.$count, $A['sender_email']);
							$sheet->setCellValue('H'.$count, $A['sender_mobile']);
							$sheet->setCellValue('I'.$count, $A['bene_name']);
							$sheet->setCellValue('J'.$count, $A['bene_id']);
							$sheet->setCellValue('K'.$count, $A['bene_address']);
							$sheet->setCellValue('L'.$count, $A['bene_email']);
							$sheet->setCellValue('M'.$count, $A['bene_mobile']);
							$sheet->setCellValue('N'.$count, $A['total']);
							$sheet->setCellValue('O'.$count, $A['datecreated']);
							$count++;
	               	 }
	               	 	$filename="ecash_payout_padala".date('ymd').'.xlsx'; //save our workbook as this file name


			}elseif($concaturl == '/ecash_to_smartmoney_payout' || $concaturl == '/i_remit_payout'){

				$sheet->setCellValue('A1', 'Tracking No');
				$sheet->setCellValue('B1', 'Regcode');
				$sheet->setCellValue('C1', 'Account Name');
				$sheet->setCellValue('D1', 'Type');
				$sheet->setCellValue('E1', 'Amount');
				$sheet->setCellValue('F1', 'Charge');
				$sheet->setCellValue('G1', 'Total');
				$sheet->setCellValue('H1', 'Date/Time');

				//make the font become bold
				$sheet->getStyle('A1')->getFont()->setBold(true);
				$sheet->getStyle('B1')->getFont()->setBold(true);
				$sheet->getStyle('C1')->getFont()->setBold(true);
				$sheet->getStyle('D1')->getFont()->setBold(true);
				$sheet->getStyle('E1')->getFont()->setBold(true);
				$sheet->getStyle('F1')->getFont()->setBold(true);
				$sheet->getStyle('G1')->getFont()->setBold(true);
				$sheet->getStyle('H1')->getFont()->setBold(true);

					$parameter =array(
						//'dev_id'			=> $this->input->server('HTTP_USER_AGENT'),
						'dev_id'			=> $this->global_f->dev_id(),
						'actionId'         	=> _ecash_remittance_report.$concaturl, 
						'ip_address'		=> $this->ip, 
	    				'regcode'           => $this->user['R']
				    	);

					$result = $this->curl->call($parameter,url);
				   	$API = json_decode($result,true);
				   	$count = 2;

				   	 foreach ($API['TDATA'] as $A ){
	                   	 	$sheet->setCellValue('A'.$count, $A['trackingno']);
							$sheet->setCellValue('B'.$count, $A['regcode']);
							$sheet->setCellValue('C'.$count, $A['accountname']);
							$sheet->setCellValue('D'.$count, $A['transtype']);
							$sheet->setCellValue('E'.$count, $A['amount']);
							$sheet->setCellValue('F'.$count, $A['charge']);
							$sheet->setCellValue('G'.$count, $A['totalamount']);
							$sheet->setCellValue('H'.$count, $A['postingdate']);
							$count++;
	               	 }
	               	 	$filename=str_replace("/", "", $concaturl).date('ymd').'.xlsx'; //save our workbook as this file name

			}elseif($concaturl == '/moneygram_payout'){


				$sheet->setCellValue('A1', 'RefNo');
				$sheet->setCellValue('B1', 'Tracking No');
				$sheet->setCellValue('C1', 'Receipt No');
				$sheet->setCellValue('D1', 'Currency');
				$sheet->setCellValue('E1', 'Amount');
				$sheet->setCellValue('F1', 'Charge');
				$sheet->setCellValue('G1', 'Beneficiary Name');
				$sheet->setCellValue('H1', 'Beneficiary Mobile');
				$sheet->setCellValue('I1', 'ID Type');
				$sheet->setCellValue('J1', 'ID No');
				$sheet->setCellValue('K1', 'Payout Amount');
				$sheet->setCellValue('L1', 'Date/Time');

				//make the font become bold
				$sheet->getStyle('A1')->getFont()->setBold(true);
				$sheet->getStyle('B1')->getFont()->setBold(true);
				$sheet->getStyle('C1')->getFont()->setBold(true);
				$sheet->getStyle('D1')->getFont()->setBold(true);
				$sheet->getStyle('E1')->getFont()->setBold(true);
				$sheet->getStyle('F1')->getFont()->setBold(true);
				$sheet->getStyle('G1')->getFont()->setBold(true);
				$sheet->getStyle('H1')->getFont()->setBold(true);
				$sheet->getStyle('I1')->getFont()->setBold(true);
				$sheet->getStyle('J1')->getFont()->setBold(true);
				$sheet->getStyle('K1')->getFont()->setBold(true);
				$sheet->getStyle('L1')->getFont()->setBold(true);


					$parameter =array(
						'dev_id'			=> $this->global_f->dev_id(),
						'actionId'         	=> _ecash_payout_report.$concaturl, 
						'ip_address'		=> $this->ip, 
	    				'regcode'           => $this->user['R']
				    	);

					$result = $this->curl->call($parameter,url);
				   	$API = json_decode($result,true);
				   	$count = 2;

				   	 foreach ($API['TDATA'] as $A ){
	                   	 	$sheet->setCellValue('A'.$count, $A['refno']);
							$sheet->setCellValue('B'.$count, $A['trackingno']);
							$sheet->setCellValue('C'.$count, $A['receiptNo']);
							$sheet->setCellValue('D'.$count, $A['currency']);
							$sheet->setCellValue('E'.$count, $A['amount']);
							$sheet->setCellValue('F'.$count, $A['charge']);
							$sheet->setCellValue('G'.$count, $A['benefName']);
							$sheet->setCellValue('H'.$count, $A['benefTelno']);
							$sheet->setCellValue('I'.$count, $A['valid_id']);
							$sheet->setCellValue('J'.$count, $A['id_no']);
							$sheet->setCellValue('K'.$count, $A['payoutAmount']);
							$sheet->setCellValue('L'.$count, $A['postingdate']);
							$count++;
	               	 }
	               	 	$filename=str_replace("/", "", $concaturl).date('ymd').'.xlsx'; //save our workbook as this file name

	        }elseif($concaturl == '/placid_express_payout'){

				$sheet->setCellValue('A1', 'Tracking No');
				$sheet->setCellValue('B1', 'Regcode');
				$sheet->setCellValue('C1', 'Sender Name');
				$sheet->setCellValue('D1', 'Sender Mobile');
				$sheet->setCellValue('E1', 'Benificiary Name');
				$sheet->setCellValue('F1', 'Benificiary Mobile');
				$sheet->setCellValue('G1', 'Payout Amount');
				$sheet->setCellValue('H1', 'Date/Time');

				//make the font become bold
				$sheet->getStyle('A1')->getFont()->setBold(true);
				$sheet->getStyle('B1')->getFont()->setBold(true);
				$sheet->getStyle('C1')->getFont()->setBold(true);
				$sheet->getStyle('D1')->getFont()->setBold(true);
				$sheet->getStyle('E1')->getFont()->setBold(true);
				$sheet->getStyle('F1')->getFont()->setBold(true);
				$sheet->getStyle('G1')->getFont()->setBold(true);
				$sheet->getStyle('H1')->getFont()->setBold(true);

					$parameter =array(
						'dev_id'			=> $this->global_f->dev_id(),
						'actionId'         	=> _ecash_remittance_report.$concaturl, 
						'ip_address'		=> $this->ip, 
	    				'regcode'           => $this->user['R']
				    	);

					$result = $this->curl->call($parameter,url);
				   	$API = json_decode($result,true);
				   	$count = 2;

				   	 foreach ($API['TDATA'] as $A ){
	                   	 	$sheet->setCellValue('A'.$count, $A['trackingno']);
							$sheet->setCellValue('B'.$count, $A['regcode']);
							$sheet->setCellValue('C'.$count, $A['senderName']);
							$sheet->setCellValue('D'.$count, $A['senderMobile']);
							$sheet->setCellValue('E'.$count, $A['receiverName']);
							$sheet->setCellValue('F'.$count, $A['receiverMobile']);
							$sheet->setCellValue('G'.$count, $A['amount']);
							$sheet->setCellValue('H'.$count, $A['postingdate']);
							$count++;
	               	 }
	               	 	$filename=str_replace("/", "", $concaturl).date('ymd').'.xlsx'; //save our workbook as this file name

			}else{

				$sheet->setCellValue('A1', 'Tracking No');
				$sheet->setCellValue('B1', 'Regcode');
				$sheet->setCellValue('C1', 'RefNo');
				$sheet->setCellValue('D1', 'Beneficiary Name');
				$sheet->setCellValue('E1', 'Beneficiary Contact');
				$sheet->setCellValue('F1', 'Type');
				$sheet->setCellValue('G1', 'Amount');
				$sheet->setCellValue('H1', 'Date/Time');

				//make the font become bold
				$sheet->getStyle('A1')->getFont()->setBold(true);
				$sheet->getStyle('B1')->getFont()->setBold(true);
				$sheet->getStyle('C1')->getFont()->setBold(true);
				$sheet->getStyle('D1')->getFont()->setBold(true);
				$sheet->getStyle('E1')->getFont()->setBold(true);
				$sheet->getStyle('F1')->getFont()->setBold(true);
				$sheet->getStyle('G1')->getFont()->setBold(true);
				$sheet->getStyle('H1')->getFont()->setBold(true);


					$concaturl = $this->r->sendRequestPayout($INPUT_POST['selEcashPayout']);
					$this->session->set_userdata('concaturl',$concaturl);
					$parameter =array(
						'dev_id'			=> $this->global_f->dev_id(),
						'actionId'         	=> _ecash_payout_report.$concaturl, 
						'ip_address'		=> $this->ip, 
	    				'regcode'           => $this->user['R']
				    	);

				   	 foreach ($API['TDATA'] as $A ){
	                   	 	$sheet->setCellValue('A'.$count, $A['trackingno']);
							$sheet->setCellValue('B'.$count, $A['regcode']);
							$sheet->setCellValue('C'.$count, $A['refno']);
							$sheet->setCellValue('D'.$count, $A['benefName']);
							$sheet->setCellValue('E'.$count, $A['benefTelno']);
							$sheet->setCellValue('F'.$count, $A['valid_id']);
							$sheet->setCellValue('G'.$count, $A['amount']);
							$sheet->setCellValue('H'.$count, $A['postingdate']);
							$count++;
	               	 }
	               	 	$filename=str_replace("/", "", $concaturl).date('ymd').'.xlsx'; //save our workbook as this file name


			}
			$cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(true);
			foreach ($cellIterator as $cell) {
				$sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
			}
				//CALL API
			
				header('Content-Type: application/vnd.ms-excel'); //mime type
				header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
				header('Cache-Control: max-age=0'); //no cache
				            
				//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
				//if you want to save it as .XLSX Excel 2007 format
				$objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
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
				
				$spreadsheet = new Spreadsheet();
				$sheet = $spreadsheet->getActiveSheet();
				//activate worksheet number 1
				$spreadsheet->setActiveSheetIndex(0);
				//name the worksheet
				$sheet->setTitle('BILLSPAYMENT REPORT');

				//set cell A1 content with some text
				$sheet->setCellValue('A1', 'Tracking #');
				$sheet->setCellValue('B1', 'Regcode');
				$sheet->setCellValue('C1', 'Institution	');
				$sheet->setCellValue('D1', 'Biller');
				$sheet->setCellValue('E1', 'Account #');
				$sheet->setCellValue('F1', 'Account Name');
				$sheet->setCellValue('G1', 'Amount');
				$sheet->setCellValue('H1', 'Date/Time');

				//make the font become bold
				$sheet->getStyle('A1')->getFont()->setBold(true);
				$sheet->getStyle('B1')->getFont()->setBold(true);
				$sheet->getStyle('C1')->getFont()->setBold(true);
				$sheet->getStyle('D1')->getFont()->setBold(true);
				$sheet->getStyle('E1')->getFont()->setBold(true);
				$sheet->getStyle('F1')->getFont()->setBold(true);
				$sheet->getStyle('G1')->getFont()->setBold(true);
				$sheet->getStyle('H1')->getFont()->setBold(true);

				//merge cell A1 until D1
				//$sheet->mergeCells('A1:D1');
				//set aligment to center for that merged cell (A1 to D1)
				//$sheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				//CALL API
					$parameter =array(
								'dev_id'			=> $this->global_f->dev_id(),
								'actionId'          => _billspayment_report, 
								'ip_address'		=> $this->ip, 
			    				'regcode'           => $this->user['R']
	
						    	);

				    $result = $this->curl->call($parameter,url);
				   	$API = json_decode($result,true);
				   	$count = 2;
					foreach ($API['TDATA'] as $A ){
						$sheet->setCellValueExplicit('A'.$count, $A['TN'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
						$sheet->setCellValue('B'.$count, $A['R']);
						$sheet->setCellValue('C'.$count, $A['IC']);
						$sheet->setCellValue('D'.$count, $A['BN']);
						$sheet->setCellValueExplicit('E'.$count, $A['ACNO'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
						$sheet->setCellValue('F'.$count, $A['ACNM']);
						$sheet->setCellValue('G'.$count, $A['A']);
						$sheet->setCellValue('H'.$count, $A['D']);
			
						$count++;
					}
					$cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
					$cellIterator->setIterateOnlyExistingCells(true);
					foreach ($cellIterator as $cell) {
						$sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
					}
				//CALL API
				$filename='billspayment'.date('ymd').'.xlsx'; //save our workbook as this file name
				header('Content-Type: application/vnd.ms-excel'); //mime type
				header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
				header('Cache-Control: max-age=0'); //no cache
				            
				//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
				//if you want to save it as .XLSX Excel 2007 format
				$objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
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
				$spreadsheet = new Spreadsheet();
				$sheet = $spreadsheet->getActiveSheet();
				//activate worksheet number 1
				$spreadsheet->setActiveSheetIndex(0);
				//name the worksheet
				$sheet->setTitle('LOADING REPORT');

				//set cell A1 content with some text
				$count = count($arr['field']) - 1;
				$x = 0;
				// var_dump($arr);
				// die();
				foreach(range('A','Z') as $i) {
						if ($x<=$count){
							$sheet->setCellValue($i. 1, $arr['field'][$x]);
	
						}
						$x++;
				}					

				
						$parameter =array(
								'dev_id'			=> $this->global_f->dev_id(),
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
						   $sheet->setCellValueExplicit('A'.$count,$l['TN'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
						   $sheet->setCellValueExplicit('B'.$count,$l['MN'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
						   $sheet->setCellValue('C'.$count,$l['RG']);
						   $sheet->setCellValue('D'.$count,$l['PL']);
						   $sheet->setCellValue('E'.$count,$l['PD']);
						   $sheet->setCellValue('F'.$count,$l['TD']);
						   $count++;
	               	 	}
				   	}elseif ($arr['TBODY'] == 2) {
				   		foreach ($API['TDATA'] as $l ){
						   $sheet->setCellValueExplicit('A'.$count,$l['TR'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
						   $sheet->setCellValue('B'.$count,$l['RG']);
						   $sheet->setCellValueExplicit('C'.$count,$l['MN'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
						   $sheet->setCellValueExplicit('D'.$count,$l['TT'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
						   $sheet->setCellValueExplicit('E'.$count,$l['ST'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
						   $sheet->setCellValueExplicit('F'.$count,$l['TN'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
						   $sheet->setCellValue('G'.$count,$l['AM']);
						   $sheet->setCellValue('H'.$count,$l['DT']);
						   $sheet->setCellValue('I'.$count,$l['PT']);
						   $sheet->setCellValue('J'.$count,$l['CT']);
						   $sheet->setCellValue('K'.$count,$l['ST']);
						   $sheet->setCellValue('L'.$count,$l['BL']);
						   $sheet->setCellValue('M'.$count,$l['PS']);
						   $count++;
					                                          
	               	 	}
				   	}elseif ($arr['TBODY'] == 3 || $arr['TBODY'] == 4){
				   		foreach ($API['TDATA'] as $l ){
						   $sheet->setCellValueExplicit('A'.$count,$l['TR'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
						   $sheet->setCellValue('B'.$count,$l['RG']);
						   $sheet->setCellValueExplicit('C'.$count,$l['MN'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
						   $sheet->setCellValueExplicit('D'.$count,$l['TT'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
						   $sheet->setCellValueExplicit('E'.$count,$l['ST'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
						   $sheet->setCellValueExplicit('F'.$count,$l['TN'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
						   $sheet->setCellValueExplicit('G'.$count,$l['RN'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
						   $sheet->setCellValue('H'.$count,$l['AM']);
						   $sheet->setCellValueExplicit('I'.$count,$l['PL'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
						   $sheet->setCellValue('J'.$count,$l['RE']);
						   $sheet->setCellValue('K'.$count,$l['DT']);
						   $sheet->setCellValue('L'.$count,$l['PT']);
						   $sheet->setCellValue('M'.$count,$l['CT']);
						   $sheet->setCellValueExplicit('N'.$count,$l['BL'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
						   $sheet->setCellValueExplicit('O'.$count,$l['PS'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
						   $count++;
					      }                         
	               	}elseif ($arr['TBODY'] == 5 || $arr['TBODY'] == 6  || $arr['TBODY'] == 7 || $arr['TBODY'] == 10) { // 7 = CURRENT ETISALAT REPORT, 10 = SGD
	               	 		foreach ($API['TDATA'] as $l ){
			               	 	   // $sheet->setCellValue('A'.$count,$l['TN']);
			               	 	   $sheet->setCellValueExplicit('A'.$count, $l['TN'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
								   // $sheet->setCellValue('B'.$count,$l['R']);
								   $sheet->setCellValueExplicit('B'.$count, $l['R'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
								   $sheet->setCellValue('C'.$count,$l['PL']);
								   // $sheet->setCellValue('D'.$count,$l['MN']);
								   $sheet->setCellValueExplicit('D'.$count, $l['MN'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
								   $sheet->setCellValue('E'.$count,$l['TT']);
								   $sheet->setCellValue('F'.$count,$l['TL']);
								   // $sheet->setCellValue('G'.$count,$l['RN']);
								   $sheet->setCellValueExplicit('G'.$count, $l['RN'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
								   $sheet->setCellValue('H'.$count,$l['ST']);
								   $sheet->setCellValue('I'.$count,$l['PO']);
								   $sheet->setCellValue('J'.$count,$l['PR']);
	       					  $count++;

	               	 	}

				   	}elseif ($arr['TBODY'] == 8 || $arr['TBODY'] == 9) { // 8 = CURRENT UAE Paythem REPORT, 9 = CURRENT QATAR Paythem,
	               	 		foreach ($API['TDATA'] as $l ){

	               	 			if($arr['TBODY'] == 8){
	               	 			   $sheet->setCellValue('A'.$count,"https://mobilereports.globalpinoyremittance.com/portal/uae_ar_receipt/".$l['TN']);
	               	 			   $sheet->setCellValue('B'.$count,"https://mobilereports.globalpinoyremittance.com/portal/uae_customer_receipt/".$l['TN']);
	               	 			} elseif ($arr['TBODY'] == 9){
	               	 			   $sheet->setCellValue('A'.$count,"https://mobilereports.globalpinoyremittance.com/portal/qatar_ar_receipt/".$l['TN']);
	               	 			   $sheet->setCellValue('B'.$count,"https://mobilereports.globalpinoyremittance.com/portal/qatar_customer_receipt/".$l['TN']);
 								}
			               	 	   $sheet->setCellValueExplicit('C'.$count, $l['TN'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
								   $sheet->setCellValueExplicit('D'.$count, $l['R'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
								   $sheet->setCellValue('E'.$count,$l['PL']);
								   $sheet->setCellValueExplicit('F'.$count, $l['MN'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
								   $sheet->setCellValue('G'.$count,$l['TT']);
								   $sheet->setCellValue('H'.$count,$l['TL']);
								   $sheet->setCellValueExplicit('I'.$count, $l['RN'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
								   $sheet->setCellValue('J'.$count,$l['ST']);
								   $sheet->setCellValue('K'.$count,$l['PO']);
								   $sheet->setCellValue('L'.$count,$l['PR']);
	       					  $count++;

	       					}

				   	}elseif ($arr['TBODY'] == 11) { // 11 = Current HKD REPORT
	               	 		foreach ($API['TDATA'] as $l ){

	               	 			   $sheet->setCellValue('A'.$count,"https://mobilereports.globalpinoyremittance.com/portal/hkd_ar_receipt/".$l['TN']);
	               	 			   // $sheet->setCellValue('B'.$count,"https://mobilereports.globalpinoyremittance.com/portal/hkd_customer_receipt/".$l['TN']);

			               	 	   $sheet->setCellValueExplicit('B'.$count, $l['TN'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
								   $sheet->setCellValueExplicit('C'.$count, $l['R'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
								   $sheet->setCellValue('D'.$count,$l['PL']);
								   $sheet->setCellValueExplicit('E'.$count, $l['MN'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
								   $sheet->setCellValue('F'.$count,$l['TT']);
								   $sheet->setCellValue('G'.$count,$l['TL']);
								   $sheet->setCellValueExplicit('H'.$count, $l['RN'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
								   $sheet->setCellValue('I'.$count,$l['ST']);
								   $sheet->setCellValue('J'.$count,$l['PO']);
								   $sheet->setCellValue('K'.$count,$l['PR']);
	       					  $count++;

	               	 	}
				   	}
					else if ($arr['TBODY'] == 12)
					{
						foreach ($API['TDATA'] as $l)
						{

							$sheet->setCellValueExplicit('A'. $count, $l['timestamp'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
							$sheet->setCellValueExplicit('B'. $count, $l['transac_no'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
							$sheet->setCellValueExplicit('C'. $count, $l['ref_no'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
							$sheet->setCellValueExplicit('D'. $count, $l['regcode'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
							$sheet->setCellValueExplicit('E'. $count, $l['operator'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
							$sheet->setCellValueExplicit('F'. $count, $l['plancode'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
							$sheet->setCellValue('G' .$count, $l['load_amount']);
							$sheet->setCellValue('H' .$count, $l['converted_amount']);
							$sheet->setCellValueExplicit('I'. $count, $l['wallet_currency'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
							$sheet->setCellValue('J' .$count, $l['debited_amount']);
							$sheet->setCellValueExplicit('K'. $count, $l['status'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
							$sheet->setCellValueExplicit('L'. $count, $l['mobile_no'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);

							$count++;
						}
					}
				   
					$cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
					$cellIterator->setIterateOnlyExistingCells(true);
					foreach ($cellIterator as $cell) {
						$sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
					}
				//CALL API
				$filename='loading'.date('ymd').'.xlsx'; //save our workbook as this file name
				header('Content-Type: application/vnd.ms-excel'); //mime type
				header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
				header('Cache-Control: max-age=0'); //no cache
				            
				//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
				//if you want to save it as .XLSX Excel 2007 format
				$objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
				//force user to download the Excel file without writing it to server's HD
				$objWriter->save('php://output');
			
			}else {
				//$this->session->unset_userdata('user');
				$this->session->sess_destroy();
				redirect('Login/');
			}

		
	}

	function export_einsurance_report(){
		
			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				
				
				$spreadsheet = new Spreadsheet();
				$sheet = $spreadsheet->getActiveSheet();
				//activate worksheet number 1
				$spreadsheet->setActiveSheetIndex(0);
				//name the worksheet
				$sheet->setTitle('EINSURANCE REPORT');

				//set cell A1 content with some text				
				$sheet->setCellValue('A1', 'Transaction #');
				$sheet->setCellValue('B1', 'Policy');
				$sheet->setCellValue('C1', 'Insured	');
				$sheet->setCellValue('D1', 'Beneficiary');
				$sheet->setCellValue('E1', 'Birthday');
				$sheet->setCellValue('F1', 'Occupation');
				$sheet->setCellValue('G1', 'COC No.');
				$sheet->setCellValue('H1', 'Amount');
				$sheet->setCellValue('I1', 'Charge');
				$sheet->setCellValue('J1', 'Date/Time');

				//make the font become bold
				$sheet->getStyle('A1')->getFont()->setBold(true);
				$sheet->getStyle('B1')->getFont()->setBold(true);
				$sheet->getStyle('C1')->getFont()->setBold(true);
				$sheet->getStyle('D1')->getFont()->setBold(true);
				$sheet->getStyle('E1')->getFont()->setBold(true);
				$sheet->getStyle('F1')->getFont()->setBold(true);
				$sheet->getStyle('G1')->getFont()->setBold(true);
				$sheet->getStyle('H1')->getFont()->setBold(true);
				$sheet->getStyle('I1')->getFont()->setBold(true);
				$sheet->getStyle('J1')->getFont()->setBold(true);

				//merge cell A1 until D1
				//$sheet->mergeCells('A1:D1');
				//set aligment to center for that merged cell (A1 to D1)
				//$sheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				//CALL API
					$parameter =array(
								'dev_id'			=> $this->global_f->dev_id(),
								'actionId'          => _malayan_report, 
								'ip_address'		=> $this->ip, 
			    				'regcode'           => $this->user['R']
	
						    	);

				    $result = $this->curl->call($parameter,url);
				   	$API = json_decode($result,true);
				   	$count = 2;
				   	 foreach ($API['TDATA'] as $A ){
	                   	 	$sheet->setCellValue('A'.$count, $A['trackingno']);
							$sheet->setCellValue('B'.$count, $A['policy']);
							$sheet->setCellValue('C'.$count, $A['assured']);
							$sheet->setCellValue('D'.$count, $A['beneficiary']);
							$sheet->setCellValue('E'.$count, $A['occupation']);
							$sheet->setCellValue('F'.$count, $A['dob']);
							$sheet->setCellValue('G'.$count, $A['cocno']);
							$sheet->setCellValue('H'.$count, $A['amount']);
							$sheet->setCellValue('I'.$count, $A['markup']);
							$sheet->setCellValue('J'.$count, $A['datetime']);
							$count++;
	               	 }
				//CALL API
				$filename='einsurance'.date('ymd').'.xlsx'; //save our workbook as this file name
				header('Content-Type: application/vnd.ms-excel'); //mime type
				header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
				header('Cache-Control: max-age=0'); //no cache
				            
				//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
				//if you want to save it as .XLSX Excel 2007 format
				$objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
				//force user to download the Excel file without writing it to server's HD
				$objWriter->save('php://output');
			
			}else {
				//$this->session->unset_userdata('user');
				$this->session->sess_destroy();
				redirect('Login/');
			}

		
	}
	

//Added By Sonmer
	function export_mlm_ups_report(){
		
			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$inputdate=$this->session->userdata('inputdate');
				if ($inputdate['startdate'] == "" || $inputdate['enddate'] == "") {
					echo "Invalid Date";
					die();
				}
				$spreadsheet = new Spreadsheet();
				$sheet = $spreadsheet->getActiveSheet();
				//activate worksheet number 1
				$spreadsheet->setActiveSheetIndex(0);
				//name the worksheet
				$sheet->setTitle('MLM UPS REPORT');

				//set cell A1 content with some text
				$sheet->setCellValue('A1', 'Regcode');
				$sheet->setCellValue('B1', 'Tracking No');
				$sheet->setCellValue('C1', 'Purchasing Regcode');
				$sheet->setCellValue('D1', 'Total Product Quantity');
				$sheet->setCellValue('E1', 'Total Price');
				$sheet->setCellValue('F1', 'Date Purchased');

				//make the font become bold
				$sheet->getStyle('A1')->getFont()->setBold(true);
				$sheet->getStyle('B1')->getFont()->setBold(true);
				$sheet->getStyle('C1')->getFont()->setBold(true);
				$sheet->getStyle('D1')->getFont()->setBold(true);
				$sheet->getStyle('E1')->getFont()->setBold(true);
				$sheet->getStyle('F1')->getFont()->setBold(true);

				//CALL API
					$parameter =array(
								'dev_id'			=> $this->global_f->dev_id(),
								'actionId'          => _mlm_ups_report, 
								'ip_address'		=> $this->ip, 
			    				'regcode'           => $this->user['R'],
			    				'startdate'			=> $inputdate['startdate'],
			    				'enddate'			=> $inputdate['enddate']
						    	);

				    $result = $this->curl->call($parameter,url);
				   	$API = json_decode($result,true);
				   	$count = 2;
				   	 foreach ($API['TDATA'] as $A ){
	                   	 	$sheet->setCellValue('A'.$count, $A['regcode']);
							$sheet->setCellValue('B'.$count, $A['trackingno']);
							$sheet->setCellValue('C'.$count, $A['purchasing_regcode']);
							$sheet->setCellValue('D'.$count, $A['total_product_qty']);
							$sheet->setCellValue('E'.$count, $A['total_price']);
							$sheet->setCellValue('F'.$count, $A['date_purchased']);	
							$count++;
	               	 }
				//CALL API
				$filename='mlm_ups_report'.date('ymd').'.xlsx'; //save our workbook as this file name
				header('Content-Type: application/vnd.ms-excel'); //mime type
				header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
				header('Cache-Control: max-age=0'); //no cache
				            
				//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
				//if you want to save it as .XLSX Excel 2007 format
				$objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
				//force user to download the Excel file without writing it to server's HD
				$objWriter->save('php://output');
			
			}else {
				//$this->session->unset_userdata('user');
				$this->session->sess_destroy();
				redirect('Login/');
			}

		
	}


	function export_mlm_hub_report(){
		
			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				$inputdate=$this->session->userdata('inputdate');
				if ($inputdate['startdate'] == "" || $inputdate['enddate'] == "") {
					echo "Invalid Date";
					die();
				}
				$spreadsheet = new Spreadsheet();
				$sheet = $spreadsheet->getActiveSheet();
				//activate worksheet number 1
				$spreadsheet->setActiveSheetIndex(0);
				//name the worksheet
				$sheet->setTitle('MLM HUB REPORT');

				//set cell A1 content with some text
				$sheet->setCellValue('A1', 'Regcode');
				$sheet->setCellValue('B1', 'Tracking No');
				$sheet->setCellValue('C1', 'Price');
				$sheet->setCellValue('D1', 'Total Discount');
				$sheet->setCellValue('E1', 'Total Amount');
				$sheet->setCellValue('F1', 'Status');
				$sheet->setCellValue('G1', 'Date Purchased');
				$sheet->setCellValue('H1', 'Payment Type');

				//make the font become bold
				$sheet->getStyle('A1')->getFont()->setBold(true);
				$sheet->getStyle('B1')->getFont()->setBold(true);
				$sheet->getStyle('C1')->getFont()->setBold(true);
				$sheet->getStyle('D1')->getFont()->setBold(true);
				$sheet->getStyle('E1')->getFont()->setBold(true);
				$sheet->getStyle('F1')->getFont()->setBold(true);
				$sheet->getStyle('G1')->getFont()->setBold(true);
				$sheet->getStyle('H1')->getFont()->setBold(true);
				

				//CALL API
					$parameter =array(
								'dev_id'			=> $this->global_f->dev_id(),
								'actionId'          => _mlm_hub_report, 
								'ip_address'		=> $this->ip, 
			    				'regcode'           => $this->user['R'],
			    				'startdate'			=> $inputdate['startdate'],
			    				'enddate'			=> $inputdate['enddate']
						    	);

				    $result = $this->curl->call($parameter,url);
				   	$API = json_decode($result,true);
				   	$count = 2;
				   	 foreach ($API['TDATA'] as $A ){
	                   	 	$sheet->setCellValue('A'.$count, $A['regcode']);
							$sheet->setCellValue('B'.$count, $A['trackingno']);
							$sheet->setCellValue('C'.$count, $A['price']);
							$sheet->setCellValue('D'.$count, $A['total_discount']);
							$sheet->setCellValue('E'.$count, $A['total_amount']);
							$sheet->setCellValue('F'.$count, $A['STATUS']);
							$sheet->setCellValue('G'.$count, $A['date_purchased']);
							$sheet->setCellValue('H'.$count, $A['payment_type']);	

							$count++;
	               	 }
				//CALL API
				$filename='mlm_hub_report'.date('ymd').'.xlsx'; //save our workbook as this file name
				header('Content-Type: application/vnd.ms-excel'); //mime type
				header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
				header('Cache-Control: max-age=0'); //no cache
				            
				//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
				//if you want to save it as .XLSX Excel 2007 format
				$objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
				//force user to download the Excel file without writing it to server's HD
				$objWriter->save('php://output');
			
			}else {
				//$this->session->unset_userdata('user');
				$this->session->sess_destroy();
				redirect('Login/');
			}

		
	}

	function export_aed_fund_report(){

		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$inputdate=$this->session->userdata('inputdate');
			if ($inputdate['startdate'] == "" || $inputdate['enddate'] == "") {
				echo "Invalid Date";
				die();
			}
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			//activate worksheet number 1
			$spreadsheet->setActiveSheetIndex(0);
			//name the worksheet
			$sheet->setTitle('AED FUND REPORT');

			//set cell A1 content with some text
			$sheet->setCellValue('A1', 'Control No');
			$sheet->setCellValue('B1', 'Mobile No');
			$sheet->setCellValue('C1', 'Plancode');
			$sheet->setCellValue('D1', 'Transtype');
			$sheet->setCellValue('E1', 'Ref No');
			$sheet->setCellValue('F1', 'Tracking No');
			$sheet->setCellValue('G1', 'Amount');
			$sheet->setCellValue('H1', 'Retail');
			$sheet->setCellValue('I1', 'Debit');
			$sheet->setCellValue('J1', 'Profit');
			$sheet->setCellValue('K1', 'Credit');
			$sheet->setCellValue('L1', 'Balance');
			$sheet->setCellValue('M1', 'Date');

			//make the font become bold
			$sheet->getStyle('A1')->getFont()->setBold(true);
			$sheet->getStyle('B1')->getFont()->setBold(true);
			$sheet->getStyle('C1')->getFont()->setBold(true);
			$sheet->getStyle('D1')->getFont()->setBold(true);
			$sheet->getStyle('E1')->getFont()->setBold(true);
			$sheet->getStyle('F1')->getFont()->setBold(true);
			$sheet->getStyle('G1')->getFont()->setBold(true);
			$sheet->getStyle('H1')->getFont()->setBold(true);
			$sheet->getStyle('I1')->getFont()->setBold(true);
			$sheet->getStyle('J1')->getFont()->setBold(true);
			$sheet->getStyle('K1')->getFont()->setBold(true);
			$sheet->getStyle('L1')->getFont()->setBold(true);
			$sheet->getStyle('M1')->getFont()->setBold(true);

			//CALL API
			//$url = _aed_fund_reports;
			$url = 'ups_report_service/aed_fund_reports';
			$parameter =array(
					'dev_id'			=> $this->global_f->dev_id(),
					'actionId'          => $url,
					'ip_address'		=> $this->ip,
					'regcode'           => $this->user['R'],
					'startdate'			=> $inputdate['startdate'],
					'enddate'			=> $inputdate['enddate']
			);

//			print_r($parameter);

			$result = $this->curl->call($parameter,url);
			$API = json_decode($result,true);
//			print_r($API);
//			die();

			$count = 2;
			foreach ($API['TDATA'] as $A ){
				$sheet->setCellValueExplicit('A'.$count, $A['controlno'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValueExplicit('B'.$count, $A['mobileno'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValueExplicit('C'.$count, $A['plancode'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValue('D'.$count, $A['transtype']);
				$sheet->setCellValueExplicit('E'.$count, $A['refno'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValueExplicit('F'.$count, $A['trackingno'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValue('G'.$count, $A['amount']);
				$sheet->setCellValue('H'.$count, $A['retail']);
				$sheet->setCellValue('I'.$count, $A['debit']);
				$sheet->setCellValue('J'.$count, $A['profit']);
				$sheet->setCellValue('K'.$count, $A['credit']);
				$sheet->setCellValue('L'.$count, $A['balance']);
				$sheet->setCellValue('M'.$count, $A['transDate']);
				$count++;
			}
			$cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(true);
			foreach ($cellIterator as $cell) {
				$sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
			}
			//CALL API
			$filename='aed_fund_report'.date('ymd').'.xlsx'; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache

			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}

	}


	function export_qatar_fund_report()
	{
		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$inputdate=$this->session->userdata('inputdate');
			if ($inputdate['startdate'] == "" || $inputdate['enddate'] == "") {
				echo "Invalid Date";
				die();
			}
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			//activate worksheet number 1
			$spreadsheet->setActiveSheetIndex(0);
			//name the worksheet
			$sheet->setTitle('QATAR FUND REPORT');

			//set cell A1 content with some text
			$sheet->setCellValue('A1', 'Control No');
			$sheet->setCellValue('B1', 'Mobile No');
			$sheet->setCellValue('C1', 'Plancode');
			$sheet->setCellValue('D1', 'Transtype');
			$sheet->setCellValue('E1', 'Ref No');
			$sheet->setCellValue('F1', 'Tracking No');
			$sheet->setCellValue('G1', 'Amount');
			$sheet->setCellValue('H1', 'Retail');
			$sheet->setCellValue('I1', 'Debit');
			$sheet->setCellValue('J1', 'Profit');
			$sheet->setCellValue('K1', 'Credit');
			$sheet->setCellValue('L1', 'Balance');
			$sheet->setCellValue('M1', 'Date');

			//make the font become bold
			$sheet->getStyle('A1')->getFont()->setBold(true);
			$sheet->getStyle('B1')->getFont()->setBold(true);
			$sheet->getStyle('C1')->getFont()->setBold(true);
			$sheet->getStyle('D1')->getFont()->setBold(true);
			$sheet->getStyle('E1')->getFont()->setBold(true);
			$sheet->getStyle('F1')->getFont()->setBold(true);
			$sheet->getStyle('G1')->getFont()->setBold(true);
			$sheet->getStyle('H1')->getFont()->setBold(true);
			$sheet->getStyle('I1')->getFont()->setBold(true);
			$sheet->getStyle('J1')->getFont()->setBold(true);
			$sheet->getStyle('K1')->getFont()->setBold(true);
			$sheet->getStyle('L1')->getFont()->setBold(true);
			$sheet->getStyle('M1')->getFont()->setBold(true);

			//CALL API
			
			$url = 'ups_report_service/qatar_fund_reports';
			$parameter =array(
					'dev_id'			=> $this->global_f->dev_id(),
					'actionId'          => $url,
					'ip_address'		=> $this->ip,
					'regcode'           => $this->user['R'],
					'startdate'			=> $inputdate['startdate'],
					'enddate'			=> $inputdate['enddate']
			);

//			print_r($parameter);

			$result = $this->curl->call($parameter,url);
			$API = json_decode($result,true);
//			print_r($API);
//			die();

			$count = 2;
			foreach ($API['TDATA'] as $A ){
				$sheet->setCellValueExplicit('A'.$count, $A['controlno'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValueExplicit('B'.$count, $A['mobileno'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValue('C'.$count, $A['plancode']);
				$sheet->setCellValue('D'.$count, $A['transtype']);
				$sheet->setCellValueExplicit('E'.$count, $A['refno'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValueExplicit('F'.$count, $A['trackingno'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValue('G'.$count, $A['amount']);
				$sheet->setCellValue('H'.$count, $A['retail']);
				$sheet->setCellValue('I'.$count, $A['debit']);
				$sheet->setCellValue('J'.$count, $A['profit']);
				$sheet->setCellValue('K'.$count, $A['credit']);
				$sheet->setCellValue('L'.$count, $A['balance']);
				$sheet->setCellValue('M'.$count, $A['transDate']);
				$count++;
			}
			$cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(true);
			foreach ($cellIterator as $cell) {
				$sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
			}
			//CALL API
			$filename='qatar_fund_report'.date('ymd').'.xlsx'; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache

			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}

	}
//Added By Sonmer


	function export_ctpl_report(){
		
			if ($this->user['S'] == 1 && $this->user['R'] !=""){
				
				
				$spreadsheet = new Spreadsheet();
				$sheet = $spreadsheet->getActiveSheet();
				//activate worksheet number 1
				$spreadsheet->setActiveSheetIndex(0);
				//name the worksheet
				$sheet->setTitle('FPG CTPL REPORT');
				
				//set cell A1 content with some text				
				$sheet->setCellValue('A1', 'Transaction #');
				$sheet->setCellValue('B1', 'COC Number');
				$sheet->setCellValue('C1', 'Authno	');
				$sheet->setCellValue('D1', 'Status');
				$sheet->setCellValue('E1', 'Amount');
				$sheet->setCellValue('F1', 'Charge');
				$sheet->setCellValue('G1', 'Date/Time');

				//make the font become bold
				$sheet->getStyle('A1')->getFont()->setBold(true);
				$sheet->getStyle('B1')->getFont()->setBold(true);
				$sheet->getStyle('C1')->getFont()->setBold(true);
				$sheet->getStyle('D1')->getFont()->setBold(true);
				$sheet->getStyle('E1')->getFont()->setBold(true);
				$sheet->getStyle('F1')->getFont()->setBold(true);
				$sheet->getStyle('G1')->getFont()->setBold(true);

					$parameter =array(
								'dev_id'			=> $this->global_f->dev_id(),
								'actionId'          => _cptl_report, 
								'ip_address'		=> $this->ip, 
			    				'regcode'           => $this->user['R'],
		    					$this->user['SKT']  =>md5($this->user['R'].$this->user['SKT'])
						    	);

				    $result = $this->curl->call($parameter,url);
				   	$API = json_decode($result,true);
				   	$count = 2;
				   	 foreach ($API['TDATA'] as $A ){
	                   	 	$sheet->setCellValueExplicit('A'.$count, $A['trackno'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
							$sheet->setCellValueExplicit('B'.$count, $A['coc_number'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
							$sheet->setCellValueExplicit('C'.$count, $A['authno'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
							$sheet->setCellValue('D'.$count, $A['status']);
							$sheet->setCellValue('E'.$count, $A['amount']);
							$sheet->setCellValue('F'.$count, $A['charge']);
							$sheet->setCellValue('G'.$count, $A['transdate']);
							$count++;
	               	 }
					$cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
					$cellIterator->setIterateOnlyExistingCells(true);
					foreach ($cellIterator as $cell) {
						$sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
					}
				//CALL API
				$filename='fpgctpl'.date('ymd').'.xlsx'; //save our workbook as this file name
				header('Content-Type: application/vnd.ms-excel'); //mime type
				header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
				header('Cache-Control: max-age=0'); //no cache
				            
				//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
				//if you want to save it as .XLSX Excel 2007 format
				$objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
				//force user to download the Excel file without writing it to server's HD
				$objWriter->save('php://output');
			
			}else {
				//$this->session->unset_userdata('user');
				$this->session->sess_destroy();
				redirect('Login/');
			}

		
	}


	function export_hkd_fund_report()
	{
		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$inputdate=$this->session->userdata('inputdate');
			if ($inputdate['startdate'] == "" || $inputdate['enddate'] == "") {
				echo "Invalid Date";
				die();
			}
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			//activate worksheet number 1
			$spreadsheet->setActiveSheetIndex(0);
			//name the worksheet
			$sheet->setTitle('HKD FUND REPORT');

			//set cell A1 content with some text
			$sheet->setCellValue('A1', 'Control No');
			$sheet->setCellValue('B1', 'Designation');
			$sheet->setCellValue('C1', 'Plancode');
			$sheet->setCellValue('D1', 'Transtype');
			$sheet->setCellValue('E1', 'Ref No');
			$sheet->setCellValue('F1', 'Tracking No');
			$sheet->setCellValue('G1', 'Amount');
			$sheet->setCellValue('H1', 'Retail');
			$sheet->setCellValue('I1', 'Debit');
			$sheet->setCellValue('J1', 'Profit');
			$sheet->setCellValue('K1', 'Credit');
			$sheet->setCellValue('L1', 'Balance');
			$sheet->setCellValue('M1', 'Date');

			//make the font become bold
			$sheet->getStyle('A1')->getFont()->setBold(true);
			$sheet->getStyle('B1')->getFont()->setBold(true);
			$sheet->getStyle('C1')->getFont()->setBold(true);
			$sheet->getStyle('D1')->getFont()->setBold(true);
			$sheet->getStyle('E1')->getFont()->setBold(true);
			$sheet->getStyle('F1')->getFont()->setBold(true);
			$sheet->getStyle('G1')->getFont()->setBold(true);
			$sheet->getStyle('H1')->getFont()->setBold(true);
			$sheet->getStyle('I1')->getFont()->setBold(true);
			$sheet->getStyle('J1')->getFont()->setBold(true);
			$sheet->getStyle('K1')->getFont()->setBold(true);
			$sheet->getStyle('L1')->getFont()->setBold(true);
			$sheet->getStyle('M1')->getFont()->setBold(true);

			//CALL API
			
			$url = 'ups_report_service/hkd_fund_reports';
			$parameter =array(
					'dev_id'			=> $this->global_f->dev_id(),
					'actionId'          => $url,
					'ip_address'		=> $this->ip,
					'regcode'           => $this->user['R'],
					'startdate'			=> $inputdate['startdate'],
					'enddate'			=> $inputdate['enddate']
			);

			$result = $this->curl->call($parameter,url);
			$API = json_decode($result,true);

			$count = 2;
			foreach ($API['TDATA'] as $A ){
				$sheet->setCellValueExplicit('A'.$count, $A['controlno'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValueExplicit('B'.$count, $A['mobileno'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValueExplicit('C'.$count, $A['plancode'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValue('D'.$count, $A['transtype']);
				$sheet->setCellValueExplicit('E'.$count, $A['refno'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValueExplicit('F'.$count, $A['trackingno'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValue('G'.$count, $A['amount']);
				$sheet->setCellValue('H'.$count, $A['retail']);
				$sheet->setCellValue('I'.$count, $A['debit']);
				$sheet->setCellValue('J'.$count, $A['profit']);
				$sheet->setCellValue('K'.$count, $A['credit']);
				$sheet->setCellValue('L'.$count, $A['balance']);
				$sheet->setCellValue('M'.$count, $A['transDate']);
				$count++;
			}
			$cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(true);
			foreach ($cellIterator as $cell) {
				$sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
			}
			//CALL API
			$filename='hkd_fund_report'.date('ymd').'.xlsx'; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache

			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}

	}
//Added By Neslie

	function export_forexecash_report()
	{
		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$inputdate=$this->session->userdata('inputdate');
			if ($inputdate['startdate'] == "" || $inputdate['enddate'] == "") {
				echo "Invalid Date";
				die();
			}
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			//activate worksheet number 1
			$spreadsheet->setActiveSheetIndex(0);
			//name the worksheet
			$sheet->setTitle('FOREX ECASH TRANSFER REPORT');

			//set cell A1 content with some text
			$sheet->setCellValue('A1', 'Control No');
			$sheet->setCellValue('B1', 'TrackingNo');
			$sheet->setCellValue('C1', 'TxnType');
			$sheet->setCellValue('D1', 'Transtype');
			$sheet->setCellValue('E1', 'DestinationAcct');
			$sheet->setCellValue('F1', 'TransferAmt');
			$sheet->setCellValue('G1', 'ForExRate');
			$sheet->setCellValue('H1', 'ConvertedAmt');
			$sheet->setCellValue('I1', 'SystemFee');
			$sheet->setCellValue('J1', 'RemittanceFee');
			$sheet->setCellValue('K1', 'TotalAmt');
			$sheet->setCellValue('L1', 'Balance');
			$sheet->setCellValue('M1', 'TxnDate');

			//make the font become bold
			$sheet->getStyle('A1')->getFont()->setBold(true);
			$sheet->getStyle('B1')->getFont()->setBold(true);
			$sheet->getStyle('C1')->getFont()->setBold(true);
			$sheet->getStyle('D1')->getFont()->setBold(true);
			$sheet->getStyle('E1')->getFont()->setBold(true);
			$sheet->getStyle('F1')->getFont()->setBold(true);
			$sheet->getStyle('G1')->getFont()->setBold(true);
			$sheet->getStyle('H1')->getFont()->setBold(true);
			$sheet->getStyle('I1')->getFont()->setBold(true);
			$sheet->getStyle('J1')->getFont()->setBold(true);
			$sheet->getStyle('K1')->getFont()->setBold(true);
			$sheet->getStyle('L1')->getFont()->setBold(true);
			$sheet->getStyle('M1')->getFont()->setBold(true);

			//CALL API
			
			$url = 'ups_report_service/forexecash_transfer_reports';
			$parameter =array(
					'dev_id'			=> $this->global_f->dev_id(),
					'actionId'          => $url,
					'ip_address'		=> $this->ip,
					'regcode'           => $this->user['R'],
					'startdate'			=> $inputdate['startdate'],
					'enddate'			=> $inputdate['enddate']
			);

			$result = $this->curl->call($parameter,url);
			$API = json_decode($result,true);

			$count = 2;
			foreach ($API['TDATA'] as $A ){
				$sheet->setCellValueExplicit('A'.$count, $A['controlno'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValueExplicit('B'.$count, $A['trackingno'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValue('C'.$count, $A['txntype']);
				$sheet->setCellValue('D'.$count, $A['transtype']);
				$sheet->setCellValueExplicit('E'.$count, $A['mobileno'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValue('F'.$count, $A['currency'].' '.$A['amount']);
				$sheet->setCellValue('G'.$count, $A['forexrate']);
				$sheet->setCellValue('H'.$count, 'PHP '.$A['converted_amount']);
				$sheet->setCellValue('I'.$count, $A['currency'].' '.$A['systemfee']);
				$sheet->setCellValue('J'.$count, $A['currency'].' '.$A['remittancefee']);
				$sheet->setCellValue('K'.$count, $A['currency'].' '.sprintf('%0.4f', ($A['amount']+$A['systemfee']+$A['remittancefee'])));
				$sheet->setCellValue('L'.$count, $A['balance']);
				$sheet->setCellValue('M'.$count, $A['transDate']);
				$count++;
			}
			$cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(true);
			foreach ($cellIterator as $cell) {
				$sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
			}

			//CALL API
			$filename='forexecash_transfer_report'.date('ymd').'.xlsx'; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache

			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}

	}
//Added By Sonmer


	//added by Neslie 12/01/2017

	function export_mcwd_report()
	{
		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$inputdate=$this->session->userdata('inputdate');
			if ($inputdate['startdate'] == "" || $inputdate['enddate'] == "") {
				echo "Invalid Date";
				die();
			}
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			//activate worksheet number 1
			$spreadsheet->setActiveSheetIndex(0);
			//name the worksheet
			$sheet->setTitle('MCWD REPORT');

			//set cell A1 content with some text
			$sheet->setCellValue('A1', 'Tracking #');
			$sheet->setCellValue('B1', 'Reference #');
			$sheet->setCellValue('C1', 'Account #');
			$sheet->setCellValue('D1', 'Account Name');
			$sheet->setCellValue('E1', 'Amount');
			$sheet->setCellValue('F1', 'Transaction Date');
			$sheet->setCellValue('G1', 'Approved By');
			$sheet->setCellValue('H1', 'Approved Date');

			//make the font become bold
			$sheet->getStyle('A1')->getFont()->setBold(true);
			$sheet->getStyle('B1')->getFont()->setBold(true);
			$sheet->getStyle('C1')->getFont()->setBold(true);
			$sheet->getStyle('D1')->getFont()->setBold(true);
			$sheet->getStyle('E1')->getFont()->setBold(true);
			$sheet->getStyle('F1')->getFont()->setBold(true);
			$sheet->getStyle('G1')->getFont()->setBold(true);
			$sheet->getStyle('H1')->getFont()->setBold(true);

			//CALL API
			
			$url = 'ups_report_service/mcwd_report';
			$parameter =array(
					'dev_id'			=> $this->global_f->dev_id(),
					'actionId'          => $url,
					'ip_address'		=> $this->ip,
					'regcode'           => $this->user['R'],
					'startdate'			=> $inputdate['startdate'],
					'enddate'			=> $inputdate['enddate']
			);

			$result = $this->curl->call($parameter,url);
			$API = json_decode($result,true);

			$count = 2;
			foreach ($API['TDATA'] as $A ){
				$sheet->setCellValueExplicit('A'.$count, $A['trackno'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValueExplicit('B'.$count, $A['refNo'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValueExplicit('C'.$count, $A['acctNo'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValueExplicit('D'.$count, $A['acctName'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValue('E'.$count, $A['amount']);
				$sheet->setCellValue('F'.$count, $A['date']);
				$sheet->setCellValue('G'.$count, $A['approved_by']);
				$sheet->setCellValue('H'.$count, $A['approved_date']);
				$count++;
			}
			$cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(true);
			foreach ($cellIterator as $cell) {
				$sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
			}
			//CALL API
			$filename='mcwd_report'.date('ymd').'.xlsx'; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache

			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}

	}

	function export_ecashloan_report()
	{
		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$inputdate=$this->session->userdata('inputdate');
			if ($inputdate['startdate'] == "" || $inputdate['enddate'] == "") {
				echo "Invalid Date";
				die();
			}
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			//activate worksheet number 1
			$spreadsheet->setActiveSheetIndex(0);
			//name the worksheet
			$sheet->setTitle('ECASH LOAN REPORT');

			//set cell A1 content with some text
			$sheet->setCellValue('A1', 'Amount');
			$sheet->setCellValue('B1', 'Tracking #');
			$sheet->setCellValue('C1', 'Amount');
			$sheet->setCellValue('D1', 'Trans Type');
			$sheet->setCellValue('E1', 'Dr_Cr');
			$sheet->setCellValue('F1', 'Date');
			$sheet->setCellValue('G1', 'Time');
			
			//make the font become bold
			$sheet->getStyle('A1')->getFont()->setBold(true);
			$sheet->getStyle('B1')->getFont()->setBold(true);
			$sheet->getStyle('C1')->getFont()->setBold(true);
			$sheet->getStyle('D1')->getFont()->setBold(true);
			$sheet->getStyle('E1')->getFont()->setBold(true);
			$sheet->getStyle('F1')->getFont()->setBold(true);
			$sheet->getStyle('G1')->getFont()->setBold(true);
			
			//CALL API
			
			$url = 'ups_report_service/ecashLoan_report';
			$parameter =array(
				'dev_id'			=> $this->global_f->dev_id(),
				'actionId'          => $url,
				'ip_address'		=> $this->ip,
				'regcode'           => $this->user['R'],
				'startdate'			=> $inputdate['startdate'],
				'enddate'			=> $inputdate['enddate']
			);
			
			$result = $this->curl->call($parameter,url);
			$API = json_decode($result,true);
			
			$count = 2;
			foreach ($API['TDATA'] as $A ){
				$sheet->setCellValueExplicit('A'.$count, $A['loanID'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValueExplicit('B'.$count, $A['trackno'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValueExplicit('C'.$count, $A['amount'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValue('D'.$count, $A['transType']);
				$sheet->setCellValue('E'.$count, $A['DrCr']);
				$sheet->setCellValue('F'.$count, $A['date']);
				$sheet->setCellValue('G'.$count, $A['time']);
				$count++;
			}
			//CALL API
			$filename='ecashloan_report'.date('ymd').'.xlsx'; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename='.$filename);
			header('Cache-Control: max-age=0');
			$objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
			print_r($this->excel);
			$objWriter->save('php://output');
			exit;
			
		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}
		
	}

	//added by Neslie 01/12/2018
	function export_mcwd_processed_report()
	{
		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$inputdate=$this->session->userdata('inputdate');
			if ($inputdate['startdate'] == "" || $inputdate['enddate'] == "") {
				echo "Invalid Date";
				die();
			}
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			//activate worksheet number 1
			$spreadsheet->setActiveSheetIndex(0);
			//name the worksheet
			$sheet->setTitle('MCWD PROCESSED REPORT');

			//set cell A1 content with some text
			$sheet->setCellValue('A1', 'Tracking #');
			$sheet->setCellValue('B1', 'Account #');
			$sheet->setCellValue('C1', 'Account Name');
			$sheet->setCellValue('D1', 'Amount');
			$sheet->setCellValue('E1', 'Transaction Date');
			$sheet->setCellValue('F1', 'Status');
			$sheet->setCellValue('G1', 'Processed By');
			$sheet->setCellValue('H1', 'Processed Date');

			//make the font become bold
			$sheet->getStyle('A1')->getFont()->setBold(true);
			$sheet->getStyle('B1')->getFont()->setBold(true);
			$sheet->getStyle('C1')->getFont()->setBold(true);
			$sheet->getStyle('D1')->getFont()->setBold(true);
			$sheet->getStyle('E1')->getFont()->setBold(true);
			$sheet->getStyle('F1')->getFont()->setBold(true);
			$sheet->getStyle('G1')->getFont()->setBold(true);
			$sheet->getStyle('H1')->getFont()->setBold(true);

			//CALL API
			
			$url = 'ups_report_service/mcwd_processed_report';
			$parameter =array(
					'dev_id'			=> $this->global_f->dev_id(),
					'actionId'          => $url,
					'ip_address'		=> $this->ip,
					'regcode'           => $this->user['R'],
					'startdate'			=> $inputdate['startdate'],
					'enddate'			=> $inputdate['enddate']
			);

			$result = $this->curl->call($parameter,url);
			$API = json_decode($result,true);

			$count = 2;
			foreach ($API['TDATA'] as $A ){
				$sheet->setCellValueExplicit('A'.$count, $A['trackno'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValueExplicit('B'.$count, $A['acctNo'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValue('C'.$count, $A['acctName']);
				$sheet->setCellValue('D'.$count, $A['amount']);
				$sheet->setCellValue('E'.$count, $A['date']);
				$sheet->setCellValue('F'.$count, $A['remarks']);
				$sheet->setCellValue('G'.$count, $A['approved_by']);
				$sheet->setCellValue('H'.$count, $A['approved_date']);
				$count++;
			}
			//CALL API
			$filename='MCWD PROCESSED REPORT'.date('ymd').'.xlsx'; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache

			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}

	}

// added by Son 11/13/2018
	function export_metroturf_report()
	{
		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$inputdate=$this->session->userdata('inputdate');
			if ($inputdate['startdate'] == "" || $inputdate['enddate'] == "") {
				echo "Invalid Date";
				die();
			}
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			//activate worksheet number 1
			$spreadsheet->setActiveSheetIndex(0);
			//name the worksheet
			$sheet->setTitle('METRO TURF REPORT');

			//set cell A1 content with some text
			$sheet->setCellValue('A1', 'Tracking #');
			$sheet->setCellValue('B1', 'Account #');
			$sheet->setCellValue('C1', 'Account Name');
			$sheet->setCellValue('D1', 'Amount');
			$sheet->setCellValue('E1', 'Transaction Date');
			$sheet->setCellValue('F1', 'Approved By');
			$sheet->setCellValue('G1', 'Approved Date');

			//make the font become bold
			$sheet->getStyle('A1')->getFont()->setBold(true);
			$sheet->getStyle('B1')->getFont()->setBold(true);
			$sheet->getStyle('C1')->getFont()->setBold(true);
			$sheet->getStyle('D1')->getFont()->setBold(true);
			$sheet->getStyle('E1')->getFont()->setBold(true);
			$sheet->getStyle('F1')->getFont()->setBold(true);
			$sheet->getStyle('G1')->getFont()->setBold(true);

			//CALL API
			
			$url = 'ups_report_service/metroturf_report';
			$parameter =array(
					'dev_id'			=> $this->global_f->dev_id(),
					'actionId'          => $url,
					'ip_address'		=> $this->ip,
					'regcode'           => $this->user['R'],
					'startdate'			=> $inputdate['startdate'],
					'enddate'			=> $inputdate['enddate']
			);

			$result = $this->curl->call($parameter,url);
			$API = json_decode($result,true);

			$count = 2;
			foreach ($API['TDATA'] as $A ){
				$sheet->setCellValueExplicit('A'.$count, $A['trackno'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValueExplicit('B'.$count, $A['acctNo'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValueExplicit('C'.$count, $A['acctName'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValue('D'.$count, $A['amount']);
				$sheet->setCellValue('E'.$count, $A['date']);
				$sheet->setCellValue('F'.$count, $A['approved_by']);
				$sheet->setCellValue('G'.$count, $A['approved_date']);
				$count++;
			}
			$cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(true);
			foreach ($cellIterator as $cell) {
				$sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
			}

			//CALL API
			$filename='metrotruf_report'.date('ymd').'.xlsx'; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache

			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}

	}

//added by Son 11/13/2018
	function export_metroturf_processed_report()
	{
		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$inputdate=$this->session->userdata('inputdate');
			if ($inputdate['startdate'] == "" || $inputdate['enddate'] == "") {
				echo "Invalid Date";
				die();
			}
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			//activate worksheet number 1
			$spreadsheet->setActiveSheetIndex(0);
			//name the worksheet
			$sheet->setTitle('METRO TURF REPORT');

			//set cell A1 content with some text
			$sheet->setCellValue('A1', 'Tracking #');
			$sheet->setCellValue('B1', 'Account #');
			$sheet->setCellValue('C1', 'Account Name');
			$sheet->setCellValue('D1', 'Amount');
			$sheet->setCellValue('E1', 'Transaction Date');
			$sheet->setCellValue('F1', 'Approved By');
			$sheet->setCellValue('G1', 'Approved Date');

			//make the font become bold
			$sheet->getStyle('A1')->getFont()->setBold(true);
			$sheet->getStyle('B1')->getFont()->setBold(true);
			$sheet->getStyle('C1')->getFont()->setBold(true);
			$sheet->getStyle('D1')->getFont()->setBold(true);
			$sheet->getStyle('E1')->getFont()->setBold(true);
			$sheet->getStyle('F1')->getFont()->setBold(true);
			$sheet->getStyle('G1')->getFont()->setBold(true);

			//CALL API
			
			$url = 'ups_report_service/metroturf_processed_report';
			$parameter =array(
					'dev_id'			=> $this->global_f->dev_id(),
					'actionId'          => $url,
					'ip_address'		=> $this->ip,
					'regcode'           => $this->user['R'],
					'startdate'			=> $inputdate['startdate'],
					'enddate'			=> $inputdate['enddate']
			);

			$result = $this->curl->call($parameter,url);
			$API = json_decode($result,true);

			$count = 2;
			foreach ($API['TDATA'] as $A ){
				$sheet->setCellValueExplicit('A'.$count, $A['trackno'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValueExplicit('B'.$count, $A['acctNo'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValueExplicit('C'.$count, $A['acctName'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValue('D'.$count, $A['amount']);
				$sheet->setCellValue('E'.$count, $A['date']);
				$sheet->setCellValue('F'.$count, $A['approved_by']);
				$sheet->setCellValue('G'.$count, $A['approved_date']);
				$count++;
			}
			//CALL API
			$filename='METROTURF PROCESSED REPORT'.date('ymd').'.xlsx'; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache

			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}

	}

	//PORTAL - Added by Sonmer
		function getUPSmlmData($TRACKNO){
	    	$query = $this->db->query("SELECT prod_code, get_product_desc(prod_code) AS product, quantity_product, price 
	    		FROM `ups_cart_inventory_details` 
	    		WHERE trackingno = '".$TRACKNO."'
				ORDER BY rowid DESC");
	    	// print_r($query);exit();
			return $query->result_array();
	    }

	    function getHUBmlmData($TRACKNO){
	    	$query = $this->db->query("SELECT prod_code, get_product_desc(prod_code) AS product, quantity, price, pv, discount 
	    		FROM ups_cart_details 
				WHERE trackingno = '".$TRACKNO."'
				ORDER BY rowid DESC");
	    	
			return $query->result_array();
	    }
	//PORTAL - Added by Sonmer	

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
				case 6:
					$url="/ecash_to_paymaya";
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
				case 7:
					$url="/placid_express_payout";
					break;
				default:
					$url="Invalid SendRequest";
					break;
			}
			return $url;
		}


	function export_myr_fund_report()
	{
		if ($this->user['S'] == 1 && $this->user['R'] !=""){
			$inputdate=$this->session->userdata('inputdate');
			if ($inputdate['startdate'] == "" || $inputdate['enddate'] == "") {
				echo "Invalid Date";
				die();
			}
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			//activate worksheet number 1
			$spreadsheet->setActiveSheetIndex(0);
			//name the worksheet
			$sheet->setTitle('MYR FUND REPORT');
			
			//set cell A1 content with some text
			$sheet->setCellValue('A1', 'Control No');
			$sheet->setCellValue('B1', 'Designation');
			$sheet->setCellValue('C1', 'Plancode');
			$sheet->setCellValue('D1', 'Transtype');
			$sheet->setCellValue('E1', 'Ref No');
			$sheet->setCellValue('F1', 'Tracking No');
			$sheet->setCellValue('G1', 'Amount');
			$sheet->setCellValue('H1', 'Retail');
			$sheet->setCellValue('I1', 'Debit');
			$sheet->setCellValue('J1', 'Profit');
			$sheet->setCellValue('K1', 'Credit');
			$sheet->setCellValue('L1', 'Balance');
			$sheet->setCellValue('M1', 'Date');

			//make the font become bold
			$sheet->getStyle('A1')->getFont()->setBold(true);
			$sheet->getStyle('B1')->getFont()->setBold(true);
			$sheet->getStyle('C1')->getFont()->setBold(true);
			$sheet->getStyle('D1')->getFont()->setBold(true);
			$sheet->getStyle('E1')->getFont()->setBold(true);
			$sheet->getStyle('F1')->getFont()->setBold(true);
			$sheet->getStyle('G1')->getFont()->setBold(true);
			$sheet->getStyle('H1')->getFont()->setBold(true);
			$sheet->getStyle('I1')->getFont()->setBold(true);
			$sheet->getStyle('J1')->getFont()->setBold(true);
			$sheet->getStyle('K1')->getFont()->setBold(true);
			$sheet->getStyle('L1')->getFont()->setBold(true);
			$sheet->getStyle('M1')->getFont()->setBold(true);

			//CALL API
			
			$url = 'ups_report_service/myr_fund_reports';
			$parameter =array(
					'dev_id'			=> $this->global_f->dev_id(),
					'actionId'          => $url,
					'ip_address'		=> $this->ip,
					'regcode'           => $this->user['R'],
					'startdate'			=> $inputdate['startdate'],
					'enddate'			=> $inputdate['enddate']
			);

			$result = $this->curl->call($parameter,url);
			$API = json_decode($result,true);

			$count = 2;
			foreach ($API['TDATA'] as $A ){
				$sheet->setCellValueExplicit('A'.$count, $A['controlno'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValueExplicit('B'.$count, $A['mobileno'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValue('C'.$count, $A['plancode']);
				$sheet->setCellValue('D'.$count, $A['transtype']);
				$sheet->setCellValueExplicit('E'.$count, $A['refno'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValueExplicit('F'.$count, $A['trackingno'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValue('G'.$count, $A['amount']);
				$sheet->setCellValue('H'.$count, $A['retail']);
				$sheet->setCellValue('I'.$count, $A['debit']);
				$sheet->setCellValue('J'.$count, $A['profit']);
				$sheet->setCellValue('K'.$count, $A['credit']);
				$sheet->setCellValue('L'.$count, $A['balance']);
				$sheet->setCellValue('M'.$count, $A['transDate']);
				$count++;
			}
			$cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(true);
			foreach ($cellIterator as $cell) {
				$sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
			}

			//CALL API
			$filename='myr_fund_report'.date('ymd').'.xlsx'; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache

			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');

		}else {
			//$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			redirect('Login/');
		}

	}
	

}