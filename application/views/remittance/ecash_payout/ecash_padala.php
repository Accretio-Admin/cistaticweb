


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
                <h4>E-CASH PADALA</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel" style="padding-bottom: 0px;">
        <?php if ($API['S'] === 0): ?>
        <div class="alert alert-danger"><b><?php echo $API['M'] ?></b></div>
        <?php endif ?>
        <?php if ($API['S']== 1): ?>
        <div class="alert alert-success">
          <b><?php echo $API['M']; ?></b>
        </div>
        <?php endif ?>
        <?php if ($result['S'] === 0): ?>
        <div class="alert alert-danger"><b><?php echo $result['M'] ?></b></div>
        <?php endif ?>
        <?php if ($result['S']== 1): ?>
        <div class="alert alert-success">
          <b><?php echo $result['M'] ?>
           <?php if($result['URL'] != ''):?>
            </br><a href="<?php echo $result['URL']; ?>" target="_blank">View Receipt</a>
           <?php endif ?>
        </b>
        </div>
        <?php endif ?>
         <div class="alert alert-danger" style="display:none; text-align: center;" id="agreementfailed"><b></b></div>
         <div class="alert alert-success" style="display:none; text-align: center;" id="agreementsuccess"><b></b></div>
        <div class="row row-stat">
        <?php if ($API['S'] != "1"): ?>
            <div class="col-md-5">
              <div class="contentpanel" style="padding-top: 0px;"> 
                  <div class="panel panel-default">
                    <div class="panel-heading" style="padding-top: 15px; padding-bottom: 0px;">

<!-- Start of IF ip is equal to PH then proceed -->

                        <?php 

                        $ch=curl_init();
                        curl_setopt($ch,CURLOPT_URL, "http://ip-api.com/json/103.16.170.114");
                        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                        
                        $result=curl_exec($ch);
                        $result=json_decode($result);

                        // echo "<pre>";
                        // print_r($result);

                        // If Outside PH and regcode is Test account blocked Service
                        if ($result->country !== 'Philippines' && $user['R'] == 'F7897947'): ?> 

                        <h3>This service is only available in the Philippines</h3>

                        <!-- else if not equal to Test account, Can access Service  -->
                        <?php elseif ($user['R'] !== 'F7897947'): ?>

                        <!-- Paste ContentPanel Here -->

                    <h5 style="font-weight: bold; color: #4169E1;">E-CASH PADALA</h5>
                    </div>
                    <div class="panel-body">
                      <form name="frmecashpadala" action="<?php echo BASE_URL() ?>Ecash_payout/ecashpadala" method="post" class="frmclass" id="frmEcashPadala">
                           <div class="form-group">
                              <input type="text" class="form-control" name="inputReferenceNo" placeholder="REFERENCE NO." required/>
                          </div>
                          <div class="form-group">
                             <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required/>
                          </div>
                           <div class="form-group text-right">
                              <button type="submit" class="btn btn-primary"  name="btnEcashPadalaCheck">Submit</button>
                          </div>
                      </form>
                    </div>
                   </div>
              </div>   
            </div>
            <?php endif; ?>

<!-- End of Ifelse IP is not equal to PH -->

            <?php endif ?>
            <?php if ($API['S'] == "1"): ?>
            <div class="col-md-6">
              <div class="contentpanel" style="padding-top: 0px;"> 
                  <div class="panel panel-default">
                    <div class="panel-heading" style="padding-top: 0px; padding-bottom: 0px;">
                    <h5 style="font-weight: bold; color: #4169E1;">E-CASH PADALA</h5>
                    </div>
                    <div class="panel-body">
                      <form name="frmecashpadala" action="<?php echo BASE_URL() ?>Ecash_payout/ecashpadala" method="post" class="frmclass" id="frmEcashPadala">
                      <h4>SENDER</h4>
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 14px;">FULL NAME:</span>
                                  <input type="text" class="form-control" name="inputSenderName" value="<?php echo $API['sender']; ?>"  readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 25px;">ADDRESS:</span>
                                  <input type="text" class="form-control" name="inputSenderAddress" value="<?php echo $API['address']; ?>"  readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                              <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right: 11px;">MOBILE NO.:</span>
                                <input type="text" class="form-control" name="inputMobileNo" value="<?php echo $API['SMOB']; ?>"  readonly="">
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right: 20px;">EMAIL ADDRESS:</span>
                                <input type="text" class="form-control" name="inputSenderEmail" value="<?php echo $API['email']; ?>"  readonly="">
                              </div>
                            </div>
                            <h4>BENEFICIARY</h4>
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 21px;">FIRST NAME:</span>
                                  <input type="text" class="form-control" name="inputBeneficiaryFName" id="benefname" value="<?php echo $API['bene_fname']; ?>"  readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 8px;">MIDDLE NAME:</span>
                                  <input type="text" class="form-control" name="inputBeneficiaryMName" id="benemname" value="<?php echo $API['bene_mname']; ?>"  readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 26px;">LAST NAME:</span>
                                  <input type="text" class="form-control" name="inputBeneficiaryLName" id="benelname" value="<?php echo $API['bene_lname']; ?>"  readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 38px;">ADDRESS:</span>
                                  <input type="text" class="form-control" name="inputBeneficiaryAddress" value="<?php echo $API['bene_address']; ?>"  readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 24px;">MOBILE NO.:</span>
                                  <input type="text" class="form-control" name="inputBeneficiaryMobile" value="<?php echo $API['mobile']; ?>"  readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 20px;">EMAIL ADDRESS:</span>
                                  <input type="text" class="form-control" name="inputBeneficiaryEmail" value="<?php echo $API['bene_email']; ?>"  readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                  <span style="font-size:18px; padding-right: 180px;">IDENTIFICATION</span>
                                  <button type="button" class="btn btn-success" id="refresh" onclick="RefreshList();">Refresh ID List</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 5px;">BENEFICIARY BIRTHDATE:</span>
                                  <input type="text" class="form-control" name="inputBeneficiaryBdate"
                                  id="benefbdate" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right: 5px;">ID #1:</span>
                                <select class="form-control preferenceSelect" name="selvalidID1" id="selvalidID1" disabled required>
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

                            
                             
                            <div class="form-group" id="selvalidID2DIV" style = 'display:none;';>
                                <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right: 5px;">ID #2:</span>
                                <select class="form-control preferenceSelect" name="selvalidID2" id="selvalidID2" disabled required>
                                    <?php if($process == 2):?>
                                     <option value="" disabled selected>--CHOOSE VALID ID--</option>  
                                   <?php else: ?>
                                     <option value=" " selected></option>
                                    <?php endif?>
                                </select>
                                
                                </div>
                            </div>
                           
                          

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


                            <h4>TRANSACTION DETAILS</h4>
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 57px;">TRACKING NO.:</span>
                                  <input type="text" class="form-control" name="inputTN" id="trackno" value="<?php echo $API['TN']; ?>"  readonly="">
                                  <input type="text" class="form-control" name="inputTranstype" id="transtype" value="ECASH PADALA PAYOUT"  readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 8px;">REFERENCE NUMBER:</span>
                                  <input type="text" class="form-control" name="inputReferenceNo" value="<?php echo $row['inputReferenceNo']; ?>"  readonly="">
                                </div>
                            </div>
                             <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 23px;">PRINCIPAL AMOUNT:</span>
                                  <input type="text" class="form-control" name="inputPRINAmount" id="principalamount" value="<?php echo $API['principal_amount']; ?>"  readonly="">
                                </div>
                            </div>
							               <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 34px;">SERVICE CHARGE:</span>
                                  <input type="text" class="form-control" name="inputSCAmount" value="<?php echo $API['payout_charge']; ?>"  readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 53px;">TOTAL AMOUNT:</span>
                                  <input type="text" class="form-control" name="inputTotalAmount" value="<?php echo $API['Amount']; ?>"  readonly="">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                      <a id="btnCancel" class="btn btn-warning"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Cancel</a>
                                      <button name="btnEcashPadalaConfirm" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Confirm</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="inputSenderID" value="<?php echo $API['sender_id']; ?>"/>
                                <input type="hidden" class="form-control" name="inputBeneficiaryID" value="<?php echo $API['bene_id']; ?>"/>
                                <input type="hidden" class="form-control" name="inputTpass" value="<?php echo $row['inputTpass']; ?>" />
                            </div>
                      </form>
                    </div>
                   </div>
              </div>   
            </div>
            <?php endif ?>
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
             <button type="submit" class="btn btn-primary" id="submit" >Submit</button>

            <a href="#" class="btn btn-warning" data-dismiss="modal">Close</a>
          </fieldset>
          </form>
          </div>
        </div>
      </div>
    </div>
   

    <?php if($process == 999):?>
  <div class="modal fade" id="modalTermsandConditions" data-backdrop="static" role="dialog" style="margin-top: 3%;">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="frmAgreeTermsnCondition">
        <div class="modal-header">
          <p><strong><h4 style="font-family: Times New Roman, times-roman, georgia, serif">TERMS AND CONDITION</h4></strong></p>
        </div>
        <div class="modal-body" style="font-family: Times  New Roman; overflow-y: scroll; width: 100%; height: 450px; padding: 0px 5px 5px 5px;">
          <iframe width="100%" height="400px" src="" name="Agreementiframe" id="Agreementiframe"></iframe>
          <textarea rows="5" cols="50" id="inputAgreeURL" style="display:none;"><?php echo $content; ?></textarea>
          <br>
          <center><button type="submit" class="btn btn-warning btn-lg" name="btnAgree" id="btnAgree" style="width: 150px;">I Agree</button></center>
        </div>
        <input type="hidden" class="form-control" name="regcode" value="<?php echo $regcode; ?>" />
        </form>
      </div>
    </div>
  </div>
<?php endif ?>

<script type="text/javascript">
$(window).load(function(){
    if ($("#modalTermsandConditions").data('bs.modal') && $("#modalTermsandConditions").data('bs.modal').isShown){
      var myFrame = $("#Agreementiframe").contents().find('body');
        var textareaValue = $("textarea").val();
      myFrame.html(textareaValue);
    }
});
</script>
