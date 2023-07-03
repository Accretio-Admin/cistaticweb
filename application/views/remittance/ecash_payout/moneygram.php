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
                <h4>MONEYGRAM</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel" style="padding-bottom: 0px;">
        <?php if ($results['S'] === 0): ?>
        <div class="alert alert-danger"><b><?php echo $results['M'] ?></b></div>
        <?php endif ?>
        <?php if ($results['S']== 1): ?>
        <div class="alert alert-success"><b><?php echo $results['M'] ?></b></div>
        <?php endif ?>

                <div class="alert alert-danger" style="display:none; text-align: center;" id="agreementfailed"><b></b></div>
         <div class="alert alert-success" style="display:none; text-align: center;" id="agreementsuccess"><b></b></div>
         
        <div class="row row-stat">
        <?php if ($process == "" && $results['S'] != "1" || $result == 1): ?>
            <div class="col-md-5">
              <div class="contentpanel" style="padding-top: 0px;"> 
                <div class="panel panel-default">
                  <div class="panel-heading" style="padding-top: 15px; padding-bottom: 0px;">

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

                  <h5 style="font-weight: bold; color: #4169E1;">MONEYGRAM</h5>
                  </div>
                  <div class="panel-body">
                    <form name="frmmoneygram" action="<?php echo BASE_URL() ?>ecash_payout/moneygram" method="post" class="frmclass" id="frmIremit">
                        <div class="form-group">
                          <input type="text" class="form-control" name="inputReferenceNo" maxlength="8" placeholder="REFERENCE NO." required/>
                        </div>
                        <div class="form-group text-right">
                          <button type="submit" class="btn btn-primary" name="btnMoneygramCheck">Check Status</button>
                        </div>
                    </form>
                  </div>
                 </div>
              </div>   
            </div>
            <?php endif; ?>

<!-- End of Ifelse IP is not equal to PH -->


        <?php endif ?>

        <?php if ($process == 1): ?>
          <div class="col-md-12">
              <div class="contentpanel" style="padding-top: 0px;"> 
                <!-- <div class="panel panel-default"> -->
                  <!-- <div class="panel-heading" style="padding-top: 0px; padding-bottom: 0px;"> -->
                  <!-- <h5 style="font-weight: bold; color: #4169E1;">MONEYGRAM</h5> -->
                  <!-- <div class="panel-body" style="padding-top: 0px;"> -->
                    <form name="frmmoneygram" action="<?php echo BASE_URL() ?>ecash_payout/moneygram" method="post" class="frmclass" id="frmIremit">
                    <table class='table table-responsive' style="max-width: 50%;">
                        <tbody>
                            <tr>
                              <td style="width:200px; font-weight:bold;" nowrap="">REFERENCE NUMBER: </td><td><input type="text" style="border: 0px;" name="inputReferenceNo" value="<?php echo $info['RF'] ?>" readonly=""></td>
                            </tr>
                            <tr>
                              <td style="width:200px; font-weight:bold;" nowrap="">REMARKS:</td><td><input type="text" style="border: 0px;" name="inputRemarks" value="<?php echo $info['M'] ?>"  readonly=""></td>
                            </tr>
                            <tr>
                              <td style="width:200px; font-weight:bold;" nowrap="">TRANSACTION DATE: </td><td><input type="text" style="border: 0px;" name="inputTransactionDate" value="<?php echo $info['TD'] ?>" readonly=""></td>
                            </tr>

                            <tr>
                              <td style="width:200px; font-weight:bold;">CURRENCY: </td><td><input type="text" style="border: 0px;" name="inputCurrency" value="<?php echo $info['CY']; ?>" readonly=""></td>
                            </tr>
                            <tr>
                              <td style="width:200px; font-weight:bold;">AMOUNT: </td><td><input type="text" style="border: 0px;" name="inputAmount" value="<?php echo $info['A']; ?>" readonly=""></td>
                            </tr>
                            <tr>
                              <td style="width:200px; font-weight:bold;">CHARGE: </td><td><input type="text" style="border: 0px;" name="inputCharge" value="<?php echo $info['C']; ?>" readonly=""></td>
                            </tr>

                            <tr>
                              <td style="width:200px; font-weight:bold;">PAYOUT AMOUNT: </td><td><input type="text" style="border: 0px;" name="inputPA" value="<?php echo $info['PA']; ?>" readonly=""></td>
                            </tr>
                            <tr>
                              <td style="width:200px; font-weight:bold;" nowrap="">ORIGIN ADDRESS: </td><td><input type="text" style="border: 0px;" name="inputOriginAddress" value="<?php echo $info['AD']; ?>" readonly=""></td>
                            </tr>

                            <tr>
                              <td style="width:200px; font-weight:bold;">SENDER NAME: </td><td><input type="text" style="border: 0px;" name="inputSN" value="<?php echo $info['SN']; ?>" readonly=""></td>
                            </tr>

                            <tr>
                              <td style="width:200px; font-weight:bold;">BENEFICIARY NAME: </td><td><input type="text" style="border: 0px;" name="inputBN" value="<?php echo $info['BN']; ?>" readonly=""></td>
                            </tr>      

                        </tbody>
                    </table> 
                    <div class="col-sm-6 col-md-6" style="padding-left: initial;">
                      <div class="form-group">
                        <input type="hidden" class="form-control" name="inputBeneficiaryFName" value="<?php echo $info['BNF']; ?>" />
                        <input type="hidden" class="form-control" name="inputBeneficiaryMName" value="<?php echo $info['BNM']; ?>" />
                        <input type="hidden" class="form-control" name="inputBeneficiaryLName" value="<?php echo $info['BNL']; ?>" />
                      </div>
                    <h5 style="font-weight: bold; padding-left: 5px;">KINDLY FILL IN ALL REQUIRED FIELDS:</h5>
                      <div class="form-group">
                      <?php if(is_null($info['selvalidID'])): ?>
                          <select class="form-control" name="selvalidID" id="selvalidID" required >
                             <option value="" disabled selected>--CHOOSE VALID ID--</option>  
                             <option value="SSS">SSS</option>
                             <option value="PhilHealth">PhilHealth</option>
                             <option value="Company">Company</option>
                             <option value="Others">Others</option>
                          </select>
                      <?php else: ?>
                      <input type="text" class="form-control" value="<?php echo $info['selvalidID']; ?>" name="selvalidID" placeholder="VALID ID" required/>
                    <?php endif; ?>
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" name="inputIDNo" value="<?php echo $info['inputIDNo']; ?>" placeholder="ID NUMBER" required/>
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control inputNumberValidator" value="<?php echo $info['inputMobileNo']; ?>" name="inputMobileNo" placeholder="CONTACT NO." required/>
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control inputAlphaNumericValidator" maxlenght="35" value="<?php echo $info['inputAddress']; ?>" name="inputAddress" placeholder="ADDRESS" required/>
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control inputLatinNameValidator" value="<?php echo $info['inputCity']; ?>" name="inputCity" placeholder="CITY" required/>
                      </div>
                      <div class="form-group">
                      <?php if(is_null($info['selCountry'])): ?>
                          <select class="form-control" value="<?php echo $info['selCountry']; ?>" name="selCountry" id="selCountry" required >
                             <option value="" disabled selected>--CHOOSE COUNTRY--</option>  
                              <?php 
                              foreach ($countries as $row): ?>
                              <option value="<?php echo $row ?>"><?php echo $row?></option>  
                              <?php endforeach; ?> 
                          </select>
                      <?php else: ?>
                      <input type="text" class="form-control inputLatinNameValidator" value="<?php echo $info['selCountry']; ?>" name="selCountry" placeholder="COUNTRY" required/>
                    <?php endif; ?>
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control inputNumberValidator" value="<?php echo $info['inputZipCode']; ?>" name="inputZipCode" placeholder="ZIP CODE" required/>
                      </div>
                      <div class="form-group">
                      <?php if(is_null($info['inputBday'])): ?>
                        <input type="text" class="form-control" id="datetimepicker" name="inputBday" placeholder="BIRTH DATE" required readonly/>
                      <?php else: ?>
                        <input type="text" class="form-control" name="inputBday" value="<?php echo $info['inputBday']; ?>" placeholder="BIRTH DATE" required readonly/>
                      <?php endif; ?>
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" name="inputBPlace" value="<?php echo $info['inputBPlace']; ?>" placeholder="BIRTH PLACE" required />
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control inputNameValidator" value="<?php echo $info['inputNationality']; ?>" name="inputNationality" placeholder="NATIONALITY" required/>
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control inputNameValidator" value="<?php echo $info['inputOccupation']; ?>" name="inputOccupation" placeholder="OCCUPATION" required/>
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" value="<?php echo $info['inputSourceFund']; ?>" name="inputSourceFund" placeholder="SOURCE OF FUND" required/>
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" value="<?php echo $info['inputRelationship']; ?>" name="inputRelationship" placeholder="RELATIONSHIP TO SENDER" required/>
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required/>
                      </div>
                      <div class="form-group">
                          <div class="row">
                              <div class="col-md-12 text-right">
                                  <a href="#" class="btn btn-warning"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Cancel</a>
                                  <button name="btnMoneygramConfirm" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Confirm</button>
                              </div>
                          </div>
                      </div>
                    </div>
<!--                     <div class="col-sm-6 col-md-7">
                    </div> -->
                    </form>
                  <!-- </div> -->
                 <!-- </div> -->
               </div>
              </div>   
            </div>
            <?php endif ?>

	        <?php if ($process == 2): ?>
	            <div class="col-md-5">
	              <div class="contentpanel" style="padding-top: 0px;"> 
	                <div class="panel panel-default">
	                  <div class="panel-heading" style="padding-top: 15px; padding-bottom: 0px;">
	                  <h5 style="font-weight: bold; color: #4169E1;">MONEYGRAM - CONFIRMATION</h5>
	                  </div>
	                  <div class="panel-body">
	                    <form name="frmmoneygram" action="<?php echo BASE_URL() ?>ecash_payout/moneygram" method="post" class="frmclass" id="frmIremit">
	                        <div class="form-group">
	                          <input type="text" class="form-control" name="inputReferenceNo" value="<?php echo $info['RF']; ?>"  readonly="" />
	                        </div>
	                        <div class="form-group text-right">
	                          <button type="submit" class="btn btn-warning" name="btnMoneygramGenerateTN">Generate Transaction No.</button>
	                        </div>
	                        <div class="form-group">
                          <textarea name="inputDetails" id="inputDetails" style="display: none;"><?php echo json_encode($info); ?></textarea>
<!-- 	                          <input type="hidden" class="form-control" name="inputTpass" value="<?php echo $row['inputTpass']; ?>"  readonly="" />
	                          <input type="hidden" class="form-control" name="selvalidID" value="<?php echo $row['selvalidID']; ?>"  readonly="" />
	                          <input type="hidden" class="form-control" name="inputIDNo" value="<?php echo $row['inputIDNo']; ?>"  readonly="" />
	                          <input type="hidden" class="form-control" name="inputMobileNo" value="<?php echo $row['inputMobileNo']; ?>"  readonly="" />
	                          <input type="hidden" class="form-control" name="inputAddress" value="<?php echo $row['inputAddress']; ?>"  readonly="" />
	                          <input type="hidden" class="form-control" name="inputBeneficiaryFName" value="<?php echo $row['inputBeneficiaryFName']; ?>"  readonly="" />
	                          <input type="hidden" class="form-control" name="inputBeneficiaryMName" value="<?php echo $row['inputBeneficiaryMName']; ?>"  readonly="" />
            							  <input type="hidden" class="form-control" name="inputBeneficiaryLName" value="<?php echo $row['inputBeneficiaryLName']; ?>"  readonly="" />
            							  <input type="hidden" class="form-control" name="inputAmount" value="<?php echo $row['inputAmount']; ?>"  readonly="" />
            							  <input type="hidden" class="form-control" name="inputCharge" value="<?php echo $row['inputCharge']; ?>"  readonly="" />
            							  <input type="hidden" class="form-control" name="inputCurrency" value="<?php echo $row['inputCurrency']; ?>"  readonly="" />
                            <input type="hidden" class="form-control" name="selCountry" value="<?php echo $row['selCountry']; ?>"  readonly="" /> 
                            <input type="hidden" class="form-control" name="inputCity" value="<?php echo $row['inputCity']; ?>"  readonly="" />
                            <input type="hidden" class="form-control" name="inputZipCode" value="<?php echo $row['inputZipCode']; ?>"  readonly="" />
                            <input type="hidden" class="form-control" name="inputBday" value="<?php echo $row['inputBday']; ?>"  readonly="" />
                            <input type="hidden" class="form-control" name="inputBPlace" value="<?php echo $row['inputBPlace']; ?>"  readonly="" />   
                            <input type="hidden" class="form-control" name="inputNationality" value="<?php echo $row['inputNationality']; ?>"  readonly="" /> 
                            <input type="hidden" class="form-control" name="inputOccupation" value="<?php echo $row['inputOccupation']; ?>"  readonly="" />  
                            <input type="hidden" class="form-control" name="inputSourceFund" value="<?php echo $row['inputSourceFund']; ?>"  readonly="" />
                            <input type="hidden" class="form-control" name="inputRelationship" value="<?php echo $row['inputRelationship']; ?>"  readonly="" />   -->                          
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