<style>
.tableFixHead    { overflow-y: auto; height: 100px; }
.tableFixHead th { position: sticky; top: 0; }

/* Just common table stuff. Really. */
table  { border-collapse: collapse; width: 100%; }
th, td { padding: 8px 16px; }
th     { background:#eee; }

.modal-body {
    max-height: calc(100vh - 210px);
    overflow-y: auto;
}
</style>
<div class="mainpanel">
		<div class="pageheader">
				<div class="media">
						<div class="pageicon pull-left">
								<i class="fa fa-home"></i>
						</div>
						<div class="media-body">
								<ul class="breadcrumb">
										<li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
										<li>ECASH</li>
								</ul>
								<h4>CEBUANA</h4>
						</div>
				</div><!-- media -->
		</div><!-- pageheader -->

		<div class="contentpanel" style="padding-bottom: 0px;">
				<?php if ($API['S'] === 0): ?>
				<div class="alert alert-danger"><b><?php echo $API['M'] ?></b></div>
				<?php endif ?>
				<?php if ($API['S']== 1): ?>
				<div class="alert alert-success"><b><?php echo $API['M'] ?></b></div>
				<?php endif ?>
				<?php if ($result['S'] === 0): ?>
				<div class="alert alert-danger"><b><?php echo $result['M'] ?></b></div>
				<?php endif ?>
				<?php if ($result['S']== 1 || $result['S']=== 1): ?>
				<div class="alert alert-success"><b><?php echo $result['M'] ?><br/>PLEASE CLICK THE TRACKING NUMBER : 
				<a href="https://mobilereports.globalpinoyremittance.com/portal/cebuana_remittance/domestic_payout_receipt/<?php echo $API['TN'];  ?>" target="_blank">

				<?php echo $result['TN']; ?> 

				</a>
				</b></div>
				<?php endif ?>
				<?php if ($result['S']== 2 || $result['S']=== 2): ?>
				<div class="alert alert-warning"><b><?php echo $result['M'] ?><br/>TRACKING NUMBER : <?php echo $result['TN']; ?></b></div>
				<?php endif ?>
				 <div style="display:none; text-align: center;" id="alertDynammic"></div>
				 <div class="alert alert-danger" style="display:none; text-align: center;" id="agreementfailed"><b></b></div>
				 <div class="alert alert-success" style="display:none; text-align: center;" id="agreementsuccess"><b></b></div>
				<div class="row row-stat">
				<?php if ($API['S'] == ""): ?>
						<div class="col-md-5">
							<div class="contentpanel" style="padding-top: 0px;"> 
									<div class="panel panel-default">
										<div class="panel-heading" style="padding-top: 15px; padding-bottom: 10px;">

<!-- Start of IF ip is equal to PH then proceed -->

										<?php 

										$ch=curl_init();
										curl_setopt($ch,CURLOPT_URL, "http://ip-api.com/json");
										curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

										$result=curl_exec($ch);
										$result=json_decode($result);

										// If Outside PH and regcode is Test account blocked Service
										if ($result->country !== 'Philippines' && $user['R'] == 'F7897947'): ?> 

										<h3>This service is only available in the Philippines</h3>
				
										<!-- else if not equal to Test account, Can access Service  -->
										<?php elseif ($user['R'] !== 'F7897947'): ?>

										<!-- Paste ContentPanel Here -->

											<div class="row">
												<div class="col-md-6 text-left">
													<h5 style="font-weight: bold; color: #4169E1;">CHECK REFERENCE</h5>
												</div>
												<div class="col-md-6 text-right">
													<?php if($this->user['L'] == 7 || $this->user['L'] == 16) { }else{?>
														<button class="btn btn-info" data-toggle="modal" data-target="#pod"><i class="glyphicon glyphicon-list"></i> POD</button>
													<?php } ?>
												</div>
											</div> 
										</div>
										<div class="panel-body">
											<div id="msg1" style="display:none"></div>
											<form name="frmCebuana" action="<?php echo BASE_URL() ?>ecash_payout/cebuana_payout" method="post" class="frmclass" id="frmEcashPadala">
													 <div class="form-group">
															<input type="text" class="form-control" name="inputReferenceNo" placeholder="REFERENCE NUMBER" required/>
													</div>
													<div class="alert alert-info">
													<b>*Remittance Transaction Reminders</b><br/>
													<p>
													All transaction subject to AMLA rules<br/>
													Perform KYC of customer<br/>
													Check valid ID of customer<br/>
													Verify transactions details before payout<br/>
													Verify signature of customer on ID and transaction receipt<br/>
													Refer to email sent for complete Terms and Conditions
													</p>
													</div>
													 <div class="form-group text-right">
															<button type="submit" class="btn btn-primary"  name="btnCebuanaCheck"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Submit</button>
													</div>
											</form>
										</div>
									 </div>
									 <?php endif; ?>

<!-- End of Ifelse IP is not equal to PH -->

							</div>   
						</div>
						<?php endif ?>
						<?php if ($API['S'] == "1"): ?>
						<div class="col-md-5">
							<div class="contentpanel" style="padding-top: 0px;"> 
									<div class="panel panel-default">
										<div class="panel-heading" style="padding-top: 0px; padding-bottom: 0px;">
										<h5 style="font-weight: bold; color: #4169E1;">REMITTANCE INFORMATION</h5>
										</div>
										<div class="panel-body">
											<form name="frmCebuanaConfirm" action="<?php echo BASE_URL() ?>ecash_payout/cebuana_payout" method="post" class="frmclass" id="frmEcashPadala">
														<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon" id="basic-addon1" style="padding-right: 84px;">SENDER ID:</span>
																	<input type="text" class="form-control" name="inputSenderID" value="<?php echo $details['Sender']['C_ID']; ?>"  readonly="">
																</div>
														</div>                            
														<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon" id="basic-addon1" style="padding-right: 76px;">FIRST NAME:</span>
																	<input type="text" class="form-control" name="inputSenderFName" value="<?php echo $details['Sender']['C_FN']; ?>"  readonly="">
																</div>
														</div>
														<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon" id="basic-addon1" style="padding-right: 63px;">MIDDLE NAME:</span>
																	<input type="text" class="form-control" name="inputSenderMName" value="<?php echo $details['Sender']['C_MN']; ?>"  readonly="">
																</div>
														</div>
														<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon" id="basic-addon1" style="padding-right: 81px;">LAST NAME:</span>
																	<input type="text" class="form-control" name="inputSenderLName" value="<?php echo $details['Sender']['C_LN']; ?>"  readonly="">
																</div>
														</div>
														<div class="form-group">
															<div class="input-group">
																<span class="input-group-addon" id="basic-addon1" style="padding-right: 92px;">BIRTHDAY:</span>
																<input type="text" class="form-control" name="inputSenderBdate" value="<?php $sender_bday = explode("T", $details['Sender']['C_BD']); echo $sender_bday[0]; ?>"  readonly="">
															</div>
														</div>
														<hr/>
														<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon" id="basic-addon1" style="padding-right: 50px;">BENEFICIARY ID:</span>
																	<input type="text" class="form-control" name="inputBeneficiaryID" value="<?php echo $details['Beneficiary']['B_ID']; ?>"  readonly="">
																</div>
														</div>
														<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon" id="basic-addon1" style="padding-right: 76px;">FIRST NAME:</span>
																	<input type="text" class="form-control" name="inputBeneficiaryFName" id="benefname" value="<?php echo $details['Beneficiary']['B_FN']; ?>"  readonly="">
																</div>
														</div>
														<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon" id="basic-addon1" style="padding-right: 63px;">MIDDLE NAME:</span>
																	<input type="text" class="form-control" name="inputBeneficiaryMName" id="benemname" value="<?php echo $details['Beneficiary']['B_MN']; ?>"  readonly="">
																</div>
														</div>
														<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon" id="basic-addon1" style="padding-right: 81px;">LAST NAME:</span>
																	<input type="text" class="form-control" name="inputBeneficiaryLName" id="benelname" value="<?php echo $details['Beneficiary']['B_LN']; ?>"  readonly="">
																</div>
														</div>
														<div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon" id="basic-addon1" style="padding-right: 92px;">BIRTHDAY:</span>
																	<input type="text" class="form-control" name="inputBeneficiaryBdate" value="<?php $bene_bday = explode("T", $details['Beneficiary']['B_BD']); echo $bene_bday[0]; ?>"  readonly="">
																	<input type="hidden" class="form-control benefbdate" id="benefbdate" value="<?php $bene_bday = explode("T", $details['Beneficiary']['B_BD']); echo $bene_bday[0]; ?>" readonly="">
																</div>
														</div>
														<hr/>
														 <div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon" id="basic-addon1" style="padding-right: 82px;">CURRENCY:</span>
																	<input type="text" class="form-control" name="inputCurrency" value="<?php echo $details['Rates']['CUR_CODE']; ?>"  readonly="">
																</div>
														</div>
														 <div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon" id="basic-addon1" style="padding-right: 25px;">PRINCIPAL AMOUNT:</span>
																	<input type="text" class="form-control" name="inputAmount" id="inputAmount" value="<?php echo $details['Rates']['PA']; ?>"  readonly="">
																</div>
														</div>
														 <div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon" id="basic-addon1" style="padding-right: 101px;">CHARGE:</span>
																	<input type="text" class="form-control" name="inputAmount" value="<?php echo $details['Rates']['SF']; ?>"  readonly="">
																</div>
														</div>
														<hr/>
														<p><?php echo '*Sent via '.str_replace("T"," ",$details['F']); ?></p>
														<!-- <div class="form-group">
																<select class="form-control" name="selvalidID" id="selvalidID" required="">
																	 <option value="" disabled selected>--TYPE OF ID PRESENTED--</option>  
																	 <?php foreach ($id_list['I_DATA'] as $row) { ?>
																	 <option value="<?php echo $row['I_ID']; ?>"><?php echo $row['I_DS']; ?></option>
																	 <?php } ?>
																</select>
														</div> -->
														<!-- <div class="form-group">
															 <input type="text" class="form-control" name="inputIDNo" placeholder="ID NUMBER" required/>
														</div> -->


														<div class="form-group">
																<div class="input-group">
																	<span style="font-size:18px; padding-right: 180px;">IDENTIFICATION</span>
																	<button type="button" class="btn btn-success" id="refresh" onclick="RefreshList();">Refresh ID List</button>
																	<small class="text-danger text-right">*Click button refresh ID list to show valid ID</small>
																</div>
														</div>
														<!-- <div class="form-group">
																<div class="input-group">
																	<span class="input-group-addon" id="basic-addon1" style="padding-right: 5px;">BENEFICIARY BIRTHDATE:</span>
																	<input type="text" class="form-control" name="inputBeneficiaryBdate"
																	id="benefbdate" autocomplete="off" required>
																</div>
														</div> -->
														<div class="form-group">
															<div class="input-group">
																<span class="input-group-addon" id="basic-addon1" style="padding-right: 5px;">ID #1:</span>
																<select class="form-control selvalidID1 preferenceSelect" name="selvalidID1" id="selvalidID1" disabled required>
																	 <option value="" disabled selected>--CHOOSE VALID ID--</option>   
																	 <!-- <option value="add_id">ADD ID</option>  -->
																</select>
															</div>
														</div>
														<div class="form-group" id="id_details1" style="border-top: 2px solid gray; border-bottom: 3px solid gray; background: #cccccc; text-align: center; display:none;"> 
															<h4>ID #1 DETAILS</h4>

															<div class="input-group">
																<span class="input-group-addon" id="id1_type" style="padding-right: 61px;">ID TYPE:</span>
																<input type="text" class="form-control" name="id_detailtype1" id="id_detailtype1" readonly="">
															</div>
															<div class="input-group">
																<span class="input-group-addon" id="id1_number" style="padding-right: 37px;">ID NUMBER:</span>
																<input type="text" class="form-control" name="id_detailnumber1" id="id_detailnumber1" readonly="">
															</div>
															<div class="input-group">
																<span class="input-group-addon" id="id1_expirydate" style="padding-right: 24px;">EXPIRY DATE:</span>
																<input type="text" class="form-control" name="id_detailexpiry1" id="id_detailexpiry1" readonly="">
															</div>
															<div class="input-group">
																<span class="input-group-addon" id="id1_createddate" style="padding-right: 10px;">CREATED DATE:</span>
																<input type="text" class="form-control" name="id_detailcreated1" id="id_detailcreated1" readonly="">
															</div>
															<div class="input-group">
															<span class="input-group-addon" id="basic-addon1" style="padding-right: 54px;">ID IMAGE:</span>
															<a class="form-control btn btn-info" id="id_attachment1" href="" target="_blank">View</a>
															</div>
														</div>

														<?php if($process == 2):?>
														<div class="form-group" id="selvalidID2DIV">
															<div class="input-group">
																<span class="input-group-addon" id="basic-addon1" style="padding-right: 5px;">ID #2:</span>
																<select class="form-control selvalidID2 preferenceSelect" name="selvalidID2" id="selvalidID2" disabled <?php echo $process==2 ? 'required' : '';?> >
																		<?php if($process == 2):?>
																			<option value="" disabled selected>--CHOOSE VALID ID--</option>  
																		<?php else: ?>
																			<option value="" selected></option>
																		<?php endif?>
																</select>
															</div>
														</div>
														<?php endif?>

														<div class="form-group" id="id_details2" style="border-top: 2px solid gray; border-bottom: 3px solid gray; background: #cccccc; text-align: center; display:none;"> 
														<h4>ID #2 DETAILS</h4>

																<div class="input-group">
																	<span class="input-group-addon" id="basic-addon1" style="padding-right: 61px;">ID TYPE:</span>
																	<input type="text" class="form-control" name="id_detailtype2" id="id_detailtype2" readonly="">
																</div>
																<div class="input-group">
																	<span class="input-group-addon" id="basic-addon1" style="padding-right: 37px;">ID NUMBER:</span>
																	<input type="text" class="form-control" name="id_detailnumber2" id="id_detailnumber2" readonly="">
																</div>
																<div class="input-group">
																	<span class="input-group-addon" id="basic-addon1" style="padding-right: 24px;">EXPIRY DATE:</span>
																	<input type="text" class="form-control" name="id_detailexpiry2" id="id_detailexpiry2" readonly="">
																</div>
																<div class="input-group">
																	<span class="input-group-addon" id="basic-addon1" style="padding-right: 10px;">CREATED DATE:</span>
																	<input type="text" class="form-control" name="id_detailcreated2" id="id_detailcreated2" readonly="">
																</div>
																<div class="input-group">
																<span class="input-group-addon" id="basic-addon1" style="padding-right: 54px;">ID IMAGE:</span>
																<a class="form-control btn btn-info" id="id_attachment2" href="" target="_blank">View</a>
																</div>
														</div>


														<div class="form-group">
															 <input type="password" class="form-control" name="inputTranspass" placeholder="TRANSACTION PASSWORD" required/>
														</div>
														<div class="form-group">
																<div class="row">
																		<div class="col-md-12 text-right">
																				<a href="#" class="btn btn-warning"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Cancel</a>
																				<button name="btnCebuanaConfirm" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Confirm Payout</button>
																		</div>
																</div>
														</div>
														<div class="form-group">
																<input type="hidden" class="form-control" name="controlnumber" value="<?php echo $ctrlnumber; ?>"/>
														</div>
											</form>
										</div>
									 </div>
							</div>   
						</div>
						<?php endif ?>
				</div>
		</div>
		

		<?php if($this->user['L'] == 7 || $this->user['L'] == 16){}else{ ?>
			<div class="col-md-8">
				<div class="col-md-8">
<!-- Start of IF ip is equal to PH then proceed -->

				<?php 

				$ch=curl_init();
				curl_setopt($ch,CURLOPT_URL, "http://ip-api.com/json");
				curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

				$result=curl_exec($ch);
				$result=json_decode($result);

				// If Outside PH and regcode is Test account blocked Service
				if ($result->country !== 'Philippines' && $user['R'] == 'F7897947'): ?> 

				<h3>This service is only available in the Philippines</h3>

				<!-- else if not equal to Test account, Can access Service  -->
				<?php elseif ($user['R'] !== 'F7897947'): ?>

				<!-- Paste ContentPanel Here -->
																	
					<form id="frmsearch" action="" method="post">
					<div class="row">
						<div class="col-md-6">
									<input type="text" class="form-control" id="searchpod" name="searchpod" placeholder="SEARCH TRACKING NO" />
							</div>
							<div class="col-md-4">
									<select name="category" class="form-control" id="selcat">
										<option value="" selected>ALL</option>
										<option value="APPROVED" >APPROVED</option>
										<option value="POSTED" >POSTED</option>
										<option value="REVOKED" >REVOKED</option>fsadfsdfsdfsd
									</select>
							</div>
							<div class="col-md-2 sender-search">
									<button type="submit" name= "btnSsearch" id="btnSender" class="btn btn-primary">
											<span id="spanSIcon" class="glyphicon glyphicon-search" aria-hidden="true"></span>
									</button>
							</div> 
					</div> 
				</form>
				</div>
				<br>


				<brdfsafsf				<div class="tableFixHead table-responsive" style="height:40vh">
				<table id="podtable" class="table table-striped table-hovered table-bordered">
					<thead>
							<th>POD</th>
							<th>ID</th>
							<th>Tracking #</th>
							<th>Beneficiary</th>
							<th>Sender</th>
							<th>Status</th>
							<th>Remarks</th>
					<thead>
					<tbody>
					</tbody>
				</table>
			</div>
			</div>
<!-- End of Ifelse IP is not equal to PH -->
<?php endif ?>
			<?php }?>
</div>

<?php if($process == 999):?>
	<div class="modal fade" id="modalCebuanaAgreementframe" data-backdrop="static" role="dialog" style="margin-top: 3%;">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="frmAgreeTermsnCondition">
				<div class="modal-header">
					<p><strong><h4 style="font-family: Times New Roman, times-roman, georgia, serif">TERMS AND CONDITION</h4></strong></p>
				</div>
				<div class="modal-body" style="font-family: Times  New Roman; overflow-y: scroll; width: 100%; height: 450px; padding: 0px 5px 5px 5px;">
					<iframe width="100%" height="400px" src="" name="CebuanaAgreementiframe" id="CebuanaAgreementiframe"></iframe>
					<textarea rows="5" cols="50" id="inputAgreeURL" style="display: none;"><?php echo $content; ?></textarea>
					<br>
					<center><button type="submit" class="btn btn-warning btn-lg" name="btnAgree" id="btnAgree" style="width: 150px;">I Agree</button></center>
				</div>
				</form>
			</div>
		</div>
	</div>
<?php endif ?>


<!-- POD -->
<div id="pod" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header" style="background-color:#fca600">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Proof of Disbursement</h4>
			</div>
			<div class="modal-body">
			 <div style="display:none;" id="msg" ></div>
			 <div id="gettrno" style="display:block">
				<form method="post" id="podform" action="">
          
					<div class="form-group" >
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1" style="padding-right: 10px; font-weight: bold;">TRACKING NUMBER:</span>
								<input type="text" class="form-control" required name="inputtrno" id="inputtrno">
							</div>
					</div>
				</form>
				</div>

				<div id="poddetails" style="display:none">
					<form method="post" id="detailsform" enctype="multipart/form-data" action="">
          <button class="btn btn-primary" id="refreshIDtype" type="button"><span class="glyphicon glyphicon-refresh"></span> REFRESH ID</button>
						<div class="form-group" >
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1" style="padding-right: 23px; font-weight: bold;">TRACKING NUMBER:</span>
									<input type="text" class="form-control" readonly required name="inputtrno1" id="inputtrno1">
									<input type="hidden" class="form-control" readonly required name="ceb_id" id="ceb_id">
								</div>
						</div>

						<div class="form-group" >
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1" style="padding-right: 27px; font-weight: bold;">CONTROL NUMBER:</span>
									<input type="text" class="form-control" readonly required name="inputctrlrno" id="inputctrlrno">
								</div>
						</div>

						<div class="form-group" >
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1" style="padding-right: 103px; font-weight: bold;">SENDER:</span>
									<input type="text" class="form-control" readonly required name="inputsender" id="inputsender">
								</div>
						</div>

						<div class="form-group" >
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1" style="padding-right: 69px; font-weight: bold;">BENEFICIARY:</span>
									<input type="text" class="form-control" readonly required name="inputbene" id="inputbene">
								</div>
						</div>

						<div class="form-group" >
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1" style="padding-right: 103px; font-weight: bold;">AMOUNT:</span>
									<input type="text" class="form-control" readonly required name="inputamount" id="inputamount">
								</div>
						</div>

						<div class="form-group" >
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1" style="padding-right: 149px; font-weight: bold;">ID:</span>
									<select class="form-control" id="selId">
									</select>
								</div>
						</div>

						<div class="form-group" id="id_details" style="border-top: 2px solid gray; border-bottom: 3px solid gray; background: #cccccc; text-align: center; display:none;">
											<h4>ID DETAILS</h4>
											<div class="input-group">
												<span class="input-group-addon" id="basic-addon1" style="padding-right: 61px;">ID TYPE:</span>
												<input type="text" class="form-control" name="id_detailtype3" id="id_detailtype3" readonly="">
												<input type="hidden" class="form-control" name="id_detail_id3" id="id_detail_id3" readonly="">
											</div>
											<div class="input-group">
												<span class="input-group-addon" id="basic-addon1" style="padding-right: 37px;">ID NUMBER:</span>
												<input type="text" class="form-control" name="id_detailnumber3" id="id_detailnumber3" readonly="">
											</div>
											<div class="input-group">
												<span class="input-group-addon" id="basic-addon1" style="padding-right: 24px;">EXPIRY DATE:</span>
												<input type="text" class="form-control" name="id_detailexpiry3" id="id_detailexpiry3" readonly="">
											</div>
											<div class="input-group">
												<span class="input-group-addon" id="basic-addon1" style="padding-right: 10px;">CREATED DATE:</span>
												<input type="text" class="form-control" name="id_detailcreated3" id="id_detailcreated3"
													readonly="">
											</div>
											<div class="input-group">
												<span class="input-group-addon" id="basic-addon1" style="padding-right: 54px;">ID IMAGE:</span>
												<a class="form-control btn btn-info" id="id_attachment3" href="" target="_blank">View</a>
											</div>
										</div>

						<div class="form-group" >
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1" style="padding-right: 11px; font-weight: bold;">Proof of Disbursement:</span>
									<input type="file" class="form-control" required name="inputpod" id="inputpod">
								</div>
						</div>

					</form>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" id="modalclose" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success" id="podsubmit">Submit</button>
				<button type="button" class="btn btn-success" id="detailssubmit">Submit</button>
			</div>
		</div>

	</div>
</div>

<!-- Modal -->
<div id="myModalpayout" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="newheading"></h4>
			</div>
			<form id="data" method="post" enctype="multipart/form-data">
				<fieldset>
					<div class="modal-body">
						<div class="alert alert-danger" style="display:none; text-align: center;" id="updateexpired"><b></b></div>
						<div class="alert alert-success" style="display:none; text-align: center;" id="addnewsuccess"><b></b></div>
							<div class="form-group">
								<div class="input-group">
								<span class="input-group-addon" style="padding-right: 34px;">ID TYPE:</span>
								<select class="form-control" name="newidtype" id="newidtype" required>
									 <option value="" disabled selected>--CHOOSE ID TYPE--</option>   
								</select>
								<input type="hidden" class="form-control" id="newidtype2" name="newidtype2">
								<input type="hidden" class="form-control" id="transtype" name="transtype" value="cebuana_payout">
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
								<span class="input-group-addon"  style="padding-right: 12px;">ID NUMBER:</span>
								<input type="text" class="form-control" id="newidnumber" name="newidnumber" required='required'>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
								<span class="input-group-addon"  style="padding-right: 34px;">EXPIRY DATE:</span>
								<input type="text" class="form-control clsDatePicker" name="newexpirydate" id="newexpirydate" required='required'>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
								<span class="input-group-addon"  style="padding-right: 45px;">ID PICTURE:</span>
								<input type="file" class="form-control" id="file" name="file" title="No File Found" onchange="ValidateSingleInput(this);" required='required' >
								</div>
							</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" id="submit" >Confirm</button>

						<a href="#" class="btn btn-warning" data-dismiss="modal">Close</a>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>


<!-- Modal -->
<div id="myModalPOD" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="newheadingPOD"></h4>
			</div>
			<form id="dataPOD" method="post" enctype="multipart/form-data">
				<fieldset>
					<div class="modal-body">
						<div class="alert alert-danger" style="display:none; text-align: center;" id="updateexpiredPOD"><b></b></div>
						<div class="alert alert-success" style="display:none; text-align: center;" id="addnewsuccessPOD"><b></b></div>
							<div class="form-group">
								<div class="input-group">
								<span class="input-group-addon" style="padding-right: 34px;">ID TYPE:</span>
								<select class="form-control" name="newidtype" id="newidtypePOD" required>
									 <option value="" disabled selected>--CHOOSE ID TYPE--</option>   
								</select>
								<input type="hidden" class="form-control" id="newidtypePOD2" name="newidtype2">
								<input type="hidden" class="form-control" id="transtypePOD" name="transtype" value="cebuana_payout">
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
								<span class="input-group-addon"  style="padding-right: 12px;">ID NUMBER:</span>
								<input type="text" class="form-control" id="newidnumberPOD" name="newidnumber" required='required'>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
								<span class="input-group-addon"  style="padding-right: 34px;">EXPIRY DATE:</span>
								<input type="text" class="form-control clsDatePicker" placeholder="YYYY-MM-DD" autocomplete="off" name="newexpirydate" id="newexpirydatePOD" required='required'>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
								<span class="input-group-addon"  style="padding-right: 45px;">ID PICTURE:</span>
								<input type="file" class="form-control" id="file" name="file" title="No File Found" onchange="ValidateSingleInput(this);" required='required' >
								</div>
							</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" id="submit" >Confirm</button>

						<a href="#" class="btn btn-warning" data-dismiss="modal">Close</a>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>

<script src="<?php echo BASE_URL()?>assets/js/payoutActivation.js"></script>
<script type="text/javascript">


$(window).load(function(){
		if ($("#modalCebuanaAgreementframe").data('bs.modal') && $("#modalCebuanaAgreementframe").data('bs.modal').isShown){
			var myFrame = $("#CebuanaAgreementiframe").contents().find('body');
				var textareaValue = $("textarea").val();
			myFrame.html(textareaValue);
		}
});
</script>

<script>
$(document).ready(function(){
  var fname;
  var mname;
  var lname;
  var bday;

	fetch_tables()

	$('#searchpod').change(function(){
		$('#frmsearch').submit()
	})

	$('#frmsearch').submit(function(){
		fetch_tables()
		return false;
	})

	function fetch_tables(){
		$('#podtable tbody').empty()
		var formData = $("#frmsearch")[0]
		var form_data = new FormData(formData);

		$.ajax({
					type: 'POST',
					url: "<?php echo BASE_URL() ?>ecash_payout/fetch_table",
					data: form_data,
					processData: false,
					contentType: false,
					success: function(data) {
							res = JSON.parse(data)
              console.log(res);
							if(res.S == 1){
								if(res.M.length != 0){
									res.M.forEach( function (arrayItems){
										

											$('#podtable tbody').append(`<tr ${arrayItems.status == "REVOKED" ? 'class="alert-danger"' : arrayItems.status == "APPROVED" ? 'class="alert-success"' : 'class="alert-warning"'}>\
																										<td><a class="form-control btn btn-info" id="id_attachment1" href="${arrayItems.POD}" target="_blank"><span class="glyphicon glyphicon-picture"></span> View</a></td>\
																										<td><a class="form-control btn btn-info" id="id_attachment1" href="${arrayItems.ID}" target="_blank"><span class="glyphicon glyphicon-picture"></span> View</a></td>\
																										<td>${arrayItems.trackno}</td>\
																										<td>${arrayItems.beneficiary}</td>\
																										<td>${arrayItems.sender}</td>\
																										<td>${arrayItems.status}</td>\
																										<td>${arrayItems.status == "REVOKED" ? arrayItems.remarks : arrayItems.status == "APPROVED" ? "TRANSACTION HAS BEEN APPROVED" : "TRANSACTION IS PENDING FOR APPROVAL"}</td>\
																									</tr>`
											)
										})
								}else{
									$('#podtable tbody').append('<tr><td colspan ="7" style="text-align:center">NO DATA</td></tr>')
								}

							}else{
								$('#podtable tbody').append('<tr><td colspan ="7" style="text-align:center">NO DATA</td></tr>')
							}
					},
					error:function(data) {
						fetch_tables()
					},
					timeout: 120000
			});
	}
	
	var filetype;
	var id_regisitry;
	$('#detailssubmit').hide()
	$('#podsubmit').click(function(){
		$('#podform').submit()
	})

	$('#podform').submit(function(){
		if($('#inputtrno').val() == ''){
			$('#msg').show();
			$('#msg').text('Tracking no. is required')
			$('#msg').addClass("alert alert-danger");
			$('#msg').fadeOut(5000);
		}else{
			waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'warning' });
			gettrno()
		}
		return false;
	})

	$('#pod').on('hidden.bs.modal', function(){
		$('#gettrno').show()
		$('#poddetails').hide()
		$('#podsubmit').show()
		 $('#detailssubmit').hide()
		 $('#inputtrno').val('')

		 $('#selId').empty()

			$('#id_detailtype3').val('')
			$('#id_detail_id3').val('')
			$('#id_detailnumber3').val('')
			$('#id_detailexpiry3').val('')
			$('#id_detailcreated3').val('')
			$('#id_attachment3').attr("href","");
			$('#id_details').hide()
	})

	function gettrno(){
		var formData = $("#podform")[0]
    var form_data = new FormData(formData);
    $('#selId').empty()
		$.ajax({
					type: 'POST',
					url: "<?php echo BASE_URL() ?>ecash_payout/gettrackingno",
					data: form_data,
					processData: false,
					contentType: false,
					success: function(data) {
							waitingDialog.hide();
							res = JSON.parse(data)
							if(res.S == 1){
								$('#gettrno').hide()
								$('#poddetails').fadeIn()
								$('#podsubmit').hide()
								$('#detailssubmit').show()
								$('#ceb_id').val(res.M.rowid)
								$('#inputtrno1').val(res.M.trackno)
								$('#inputctrlrno').val(res.M.refno)
								$('#inputsender').val(res.M.sender)
								$('#inputbene').val(res.M.beneficiary)
								$('#inputamount').val(res.M.amount)

								id_regisitry = res.ID

								$('#selId').append(`<option disabled selected value="">Choose ID</option>`)
                $('#selId').append(`<option value="0">--ADD NEW ID --</option>`)
								res.ID.forEach( function (arrayItem)
								{ 
									$('#selId').append(`<option value="${arrayItem.id}">${arrayItem.description}</option>`)
                })
                console.log("RES",res);
                fname = res.POD2.BFname
                mname = res.POD2.BMname
                lname = res.POD2.BLname
                bday = res.POD2.BDay

							}else if(res.S == 2){
								$('#msg').show();
								$('#msg').text(res.M)
								$('#msg').addClass("alert alert-danger");
								$('#msg').fadeOut(10000);
							}else if(res.S == 3){
								$('#msg').show();
								$('#msg').text(res.M)
								$('#msg').addClass("alert alert-success");
								$('#msg').fadeOut(10000);
							}
							else{
								$('#msg').show();
								$('#msg').text(res.M)
								$('#msg').addClass("alert alert-danger");
								$('#msg').fadeOut(10000);
							}
					},
					error:function(data) {
						gettrno()
					},
					timeout: 120000
			});
	}

	$("#selId").change(function () {
		var val = $("#selId").val()

    if(val == 0){
      get_id_types()
        $('#newheadingPOD').text('ADD NEW ID');
        $('#myModalPOD').modal('show');
        $('#dataPOD')[0].reset()
        $('#addnewsuccessPOD').hide()
        $('#updateexpiredPOD').hide()
        $("#selId").val('');
        $('#id_details').hide()
        $('#benebdate').val(bday) // Add Bene bday
    }else{
      id_regisitry.forEach( function (arrayItem)
		{ 
			if(val == arrayItem.id){
				$('#id_detailtype3').val(arrayItem.description)
				$('#id_detail_id3').val(arrayItem.id)
				$('#id_detailnumber3').val(arrayItem.number)
				$('#id_detailexpiry3').val(arrayItem.expiry)
				$('#id_detailcreated3').val(arrayItem.created)
				$('#id_attachment3').attr("href",arrayItem.attachment);
				$('#id_details').fadeIn()
			}
		})
    }

	})

	 $('#detailssubmit').click(function(){
		$('#detailsform').submit()
	})

	$('#detailsform').submit(function(){
		var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
		if($('#selId').val() == null){
			$('#msg').show();
			$('#msg').text('ID is Required')
			$('#msg').addClass("alert alert-danger");
			$('#msg').fadeOut(5000);
		}else if($('#inputpod').val() == ''){
			$('#msg').show();
			$('#msg').text('Proof of Disbursement is Required')
			$('#msg').addClass("alert alert-danger");
			$('#msg').fadeOut(5000);
		}else if ($.inArray($('#inputpod').val().split('.').pop().toLowerCase(), fileExtension) == -1) {
			$('#msg').show();
			$('#msg').text('Only formats are allowed : jpeg, jpg, png, gif, bmp')
			$('#msg').addClass("alert alert-danger");
			$('#msg').fadeOut(5000);
		}else{
			waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'warning' });
			submitpod()
		}
		return false;
  })
// Fixes
  function submitpod(){
		$('#modalclose').click()
		var formData = $("#detailsform")[0]
		var form_data = new FormData(formData);
		$.ajax({
					type: 'POST',
					url: "<?php echo BASE_URL() ?>ecash_payout/add_new_pod",
					data: form_data,
					processData: false,
					contentType: false,
					success: function(data) {
							waitingDialog.hide();
							res = JSON.parse(data)
							if(res.S == 1){
								$('#modalclose').click()
								$('#msg1').show();
								$('#msg1').text(res.M)
								$('#msg1').removeClass();
								$('#msg1').addClass("alert alert-success");
								$('#msg1').fadeOut(10000);
								fetch_tables();
							}else{
								$('#modalclose').click()
								$('#msg1').show();
								$('#msg1').text(res.M)
								$('#msg1').removeClass();
								$('#msg1').addClass("alert alert-danger");
								$('#msg1').fadeOut(10000);
							}
					},
					error:function(data) {
						gettrno()
					},
					timeout: 120000
			});
	}
  
  function get_id_types(){
    $.ajax({
            url: "fetch_remitpayout_id_types",
            type: "POST",
            
            success: function(data)
            {
              waitingDialog.hide();  
                var jsondata = JSON.parse(data);
                
                if(jsondata.S == 1)
                {
                  
                  if(countnew == 0)
                  {

                        for(var index in jsondata.T_DATA) {

                        var id = jsondata.T_DATA[index].id;
                        var desc = jsondata.T_DATA[index].description;
                        var rule = jsondata.T_DATA[index].rule;     
                        var expirable = jsondata.T_DATA[index].expirable;     

                            var select = document.getElementById("newidtypePOD");
                            //console.log(jsondata.T_DATA[index].secbank_idtype+' '+type)


                              var el = document.createElement("option");
                              el.textContent = desc;
                              el.value = id;
                              select.appendChild(el);


                        new_id_rule.push( { id:id, "rule":rule, "expirable":expirable } );

                            countnew++;
                        }
                    

                  }
                  

                  var dd = document.getElementById('newidtypePOD');

                  for (var i = 0; i < dd.options.length; i++) {

                          dd.selectedIndex = i;

                  }
                }


            }
        });
  }

$("#newidnumberPOD").change(function () {      

var newidtype = $("#newidtypePOD").val();
var newidnumber = $("#newidnumberPOD").val();
new_id_rule.forEach( function (arrayItem){
  var id = arrayItem.id;
    var rule = arrayItem.rule;
    
    var rule = rule.replace("/g", "");
    var rule = rule.replace("/", "");
    // var rule = rule.replace("^", "");

    var rules = new RegExp(rule, "g");

    if(newidtype == id)
    {

          if(rules.test(newidnumber))
          {
          $("#updateexpiredPOD").hide();
          }
          else
          {
          $("#updateexpiredPOD").html("Please match the format of the ID type chosen.");
          $("#updateexpiredPOD").show();

          }

      }
  })
     
});

$("#newidtypePOD").change(function () { 
var newidtype = $("#newidtypePOD").val();
new_id_rule.forEach( function (arrayItem){
  var id = arrayItem.id;
  var expirable = arrayItem.expirable;

    if(newidtype == id)
    {
      if(expirable == 'YES')
      {
        $("#newexpirydatePOD").prop("readonly", false); 
        document.getElementById("newexpirydatePOD").value = '';
      }
      else
      {
        $("#newexpirydatePOD").prop("readonly", true);
        document.getElementById("newexpirydatePOD").value = 'NO EXPIRY';
      }
    }
})
});

$('#refreshIDtype').click(function(){
  gettrno()
})


$('#dataPOD').submit((e) => {
	e.preventDefault();

    var formData = $('#dataPOD')[0]
    var form_data = new FormData(formData);
    form_data.append('benefname', fname);
    form_data.append('benemname', mname);
    form_data.append('benelname', lname);
    form_data.append('benebdate', bday.split('T')[0]);
    $('#addnewsuccessPOD').hide()
    $('#updateexpiredPOD').hide()
    $.ajax({
		type: 'POST',
		url: "<?php echo BASE_URL() ?>ecash_payout/add_newid_payout",
		data: form_data,
		processData: false,
		contentType: false,
		success: function(data) {
			waitingDialog.hide();
			res = JSON.parse(data)
			if(res.S == 1){
                $('#addnewsuccessPOD').show()
                $('#addnewsuccessPOD').text(res.M)
                setTimeout(() => {
                  $('#myModalPOD').modal('hide')
                }, 5000);
			}else{
                $('#updateexpiredPOD').show()
                $('#updateexpiredPOD').text(res.M)
			}
		},
		error:function(data) {
			gettrno()
		},
		timeout: 120000
	});
    console.log(form_data)
    return false;
})

})
</script>

<script src="<?php echo BASE_URL()?>assets/js/ecashtocebuana.js"></script>