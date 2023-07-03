<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-home"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>E-INSURANCE</li>
                </ul>
                <h4>FEDERAL INSURANCE</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
<script>


</script>
    
    <div class="contentpanel">
        <div class="row row-stat">
            <div class="col-sm-12 col-md-12">
                <div class="tab-content nopadding noborder">
                    <div class="tab-pane active" id="activities">
                        <div class="follower-list">  
                            <div class="col-sm-12">
                                <div class="row">

                                    <div class="col-xs-8 col-md-9">
                                    <?php if ($vresult['S'] === 0 || $vresult['S'] === '0' ): ?>
                                        <div class="alert alert-danger"><?php echo $vresult['M'] ?></div>
                                    <?php endif ?>
                                    <?php if ($result['S'] === 0 || $result['S'] === '0' ): ?>
                                        <div class="alert alert-danger"><?php echo $result['M'] ?></div>
                                    <?php elseif ($result['S'] === 1 || $result['S'] === '1' ): ?>
                                        <!-- <div class="alert alert-success"><b><?php echo $result['M'] ?> <a href="#" onclick="getCert('<?php echo $result['TN']; ?>')"><?php echo " Transaction no: ".$result['TN']; ?></a></div> -->
                                        <div class="alert alert-success">
                                        <b><?php echo $result['M'] ?> Reference No: <u><?php echo $result['TN'] ?></u></b><br/>
                                        <a href="#" onclick="getCert('<?php echo $result['TN']; ?>')"><u>Click here to download copy of receipt.</u></a>
                                        </div>
                                        <script>
                                           // window.open("https://mobilereports.globalpinoyremittance.com/portal/federal_receipt/"+<?php echo  $result['TN']; ?>);
                                        </script>
                                    <?php endif ?>
                                        <div  class="row">
                                                <?php if (is_null($process)): ?>

                                                    <form method="post" action="<?php echo base_url('/Einsurance/federal_insurance') ?>" class="transaction_form" id="frmFederal">
                                                    <div class="col-xs-6 col-md-5">
                                                        <input type="hidden" class="form-control" name="fpgOption" id="fpgOption" />
                                                        <input type="hidden" class="form-control" name="fpgVoucher" id="fpgVoucher" value="<?php echo $vresult['vcodeon']; ?>"/>
                                                        <input type="hidden" class="form-control" name="voucher_code" id="voucher_code" value="<?php echo $vresult['voucher_code']; ?>"/>
                                                        <?php if($vresult['vcodeon'] == 1): ?>
                                                        <div class="form-group">
                                                          <select class="form-control" id="option_id" name="option_id" readonly>
                                                          <option value="<?php echo $option_result['option_id']; ?>" selected><?php echo $option_result['option_name']; ?></option>
                                                          </select> 
                                                        </div>
                                                        <div class="form-group">
                                                          <select class="form-control" id="coverage" name="coverage" readonly>
                                                          <option value="<?php echo $option_result['coverage_details']['coverage'].'|'.$option_result['coverage_details']['coverage_name'].'|'.$option_result['coverage_details']['amount']; ?>" selected><?php echo $option_result['coverage_details']['coverage_name']; ?></option>
                                                          </select> 
                                                        </div>
                                                        <div class="form-group">
                                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true" style="color: #64a8ce;"></span> <span style="color: #64a8ce;">Voucher Applied: "<?php echo $vresult['voucher_code']; ?>"</span>&nbsp; &nbsp;<a href='#' data-toggle="tooltip" title="Remove voucher" class="removeVoucherFPG"><span class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red"></span></a>
                                                        </div>
                                                        <?php else: ?>
                                                        <div class="form-group">
                                                          <select class="form-control" id="selInsuranceFederal" name="selInsuranceFederal" required>
                                                          <option value="" disabled selected>Please Choose your PA option</option>
                                                          </select> 
                                                        </div>
                                                        <div class="form-group">
                                                          <select class="form-control" id="inputCoverage" name="inputCoverage" disabled required>
                                                          <option value="" disabled selected>Choose Coverage</option>
                                                          </select> 
                                                        </div>
                                                        <div class="form-group text-right">
                                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true" style="color: #64a8ce;"></span><a href="#" data-toggle="modal" data-target="#myVoucherModal"> Have voucher code?</a>      
                                                        </div>
                                                        <?php endif; ?>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control inputNameValidator2" name="inputFname" value="<?php echo $inputdata['inputFname']; ?>" placeholder="FirstName" id="inputFnameEnsurance" required disabled />
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control inputNameValidator2" name="inputMname" id="" value="<?php echo $inputdata['inputMname']; ?>" placeholder="MiddleName" required  disabled />
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control inputNameValidator2" name="inputLname" id="inputLnameEnsurance" value="<?php echo $inputdata['inputLname']; ?>" placeholder="LastName" required disabled />
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control bday" id="datetimepicker" name="inputBdate" onblur="validateDate();" value="<?php echo $inputdata['inputBdate']; ?>" placeholder="Insured Birthdate" required readonly disabled />
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="inputOccup" id="inputOccup" placeholder="Insured Occupation" value="<?php echo $inputdata['inputOccup']; ?>"  required disabled />
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="email" class="form-control" name="inputEmail" id=""  pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" value="<?php echo $inputdata['inputEmail']; ?>" placeholder="Insured Email Address" required disabled />
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="inputAddress" id="inputAddress"  value="<?php echo $inputdata['inputAddress']; ?>" placeholder="Insured Address" required disabled />
                                                        </div>
                                                        <hr />
                                                        <div class="form-group">
                                                            <input type="text" class="form-control inputNameValidator2" name="inputbFname" id="inputBFnameEnsurance" value="<?php echo $inputdata['inputbFname']; ?>" placeholder="Beneficiary FirstName"  required disabled />
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control inputNameValidator2" name="inputbMname" id="" value="<?php echo $inputdata['inputbMname']; ?>" placeholder="Beneficiary MiddleName" required  disabled />
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control inputNameValidator2" name="inputbLname" id="inputBLnameEnsurance" value="<?php echo $inputdata['inputbLname']; ?>" placeholder="Beneficiary LastName"  required  disabled />
                                                        </div>
                                                        <hr />
                                                        <div class="form-group text-right">
                                                            <button name="btn_submit_federal" type="submit" class="btn btn-primary" id="" onclick="return validateDate();" >Continue <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span></button>
                                                        </div>
                                                      
                                                    </div>

                                                    <div id="myModal" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">
                                                          <!-- Modal content-->
                                                          <div class="modal-content">
                                                            <div class="modal-body">
                                                              <h4>Are you sure you want to proceed ?</h4>
                                                            </div>
                                                            <div class="modal-footer">
                                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                              <button type="submit" class="btn btn-primary" name="btn_submit_federal">Proceed</button>
                                                            </div>
                                                          </div>

                                                        </div>
                                                      </div>
                                                    </form>


                                                <?php elseif ($process == 1): ?>
                                                    <div class="col-xs-6 col-md-7">
                                                    <form method="post" action="<?php echo base_url('/Einsurance/federal_insurance') ?>" id="frmMalayan">
                                                        
                                                        <input type="hidden" class="form-control" name="optionId" id="optionId" value="<?php echo $info['optionId'] ?>" readonly />
                                                        <input type="hidden" class="form-control" name="coverage" id="coverage" value="<?php echo $info['coverage'] ?>" readonly  />
                                                        
                                                        <?php if($info['vcodeon'] == 1): ?>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1" style="padding-right: 88px;">Voucher Code Applied: &nbsp;</span>
                                                                <input type="text" class="form-control" name="inputVcode" value="<?php echo $info['voucher_code'] ?>" readonly />
                                                            </div>
                                                        </div>
                                                        <?php endif; ?>

                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1" style="padding-right: 88px;">FirstName: &nbsp;</span>
                                                                <input type="text" class="form-control" name="inputFname" value="<?php echo $info['fname'] ?>" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1" style="padding-right: 74px;">MiddleName: &nbsp;</span>
                                                                <input type="text" class="form-control" name="inputMname" value="<?php echo $info['mname'] ?>" readonly  />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1" style="padding-right: 89px;">LastName: &nbsp;</span>
                                                                <input type="text" class="form-control" name="inputLname" value="<?php echo $info['lname'] ?>" readonly  />
                                                            </div>
                                                        </div>
                                                        <hr />
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1" style="padding-right: 14px;">Beneficiary FirstName: &nbsp;</span>
                                                                <input type="text" class="form-control" name="inputbFname" value="<?php echo $info['bfname'] ?>" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1" style="padding-right: 0px;">Beneficiary MiddleName: &nbsp;</span>
                                                                <input type="text" class="form-control" name="inputbMname" value="<?php echo $info['bmname'] ?>" readonly  />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1" style="padding-right: 15px;">Beneficiary LastName: &nbsp;</span>
                                                                <input type="text" class="form-control" name="inputbLname" value="<?php echo $info['blname'] ?>" readonly  />
                                                            </div>
                                                        </div>
                                                        <hr />
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1" style="padding-right: 97px;">Birthdate: &nbsp;</span>
                                                                <input type="text" class="form-control" name="inputBdate" value="<?php echo $info['birthdate'] ?>" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1" style="padding-right: 82px;">Occupation: &nbsp;</span>
                                                                <input type="text" class="form-control" name="inputOccup" value="<?php echo $info['occupation'] ?>" readonly  />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1" style="padding-right: 63px;">Email Address: &nbsp;</span>
                                                                <input type="email" class="form-control" name="inputEmail" value="<?php echo $info['email'] ?>" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1" style="padding-right: 102px;">Address: &nbsp;</span>
                                                                <input type="text" class="form-control" name="inputAddress" value="<?php echo $info['address'] ?>" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1" style="padding-right: 13px;">Transaction Password: &nbsp;</span>
                                                                <input type="password" class="form-control" name="inputTpass" placeholder="Transaction Password" required  />
                                                            </div>
                                                        </div>
                                                        <div class="form-group text-right">
                                                            <button type="submit" class="btn btn-primary" name="btn_confirm_federal">Submit</button>
                                                        </div>
                                                    </form>
                                                    </div>
                                                <?php endif ?>

                                                <?php if (is_null($process)): ?>
                                                <div class="col-xs-6 col-md-7" id="federalNote" style="display: none;">
                                                <?php elseif ($process == 1): ?>
                                                    <div class="col-xs-6 col-md-5" id="federalNoteConfirm" style="display: none;">
                                                    <?php endif ?>
                                                        <div class="form-group">
                                                            <p style="margin: 0px; font-weight: bold;">NOTE:</p>
                                                            <p style="margin: 0px;">Please check the details before you confirm.</p>
                                                            <p>Once confirmed it will not be amended.</p>
                                                            <table class='table table-stripped'>
                                                                <thead>
                                                                    <th>Coverage</th>
                                                                    <th>Limits</th>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                    <td>Accidental Death & Disablement</td>
                                                                    <td id="note10"></td>
                                                                    </tr>

                                                                    <tr>
                                                                    <td>Motorcycling</td>
                                                                    <td id="note20"></td>
                                                                    </tr>

                                                                    <tr>
                                                                    <td>Accidental Burial Benefit </td>
                                                                    <td id="note30"></td>
                                                                    </tr>

                                                                    <tr>
                                                                    <td>Fire Cash Assistance</td>
                                                                    <td id="note40"></td>
                                                                    </tr>

                                                                    <tr>
                                                                    <td>Selling Price</td>
                                                                    <td id="note60" nowrap></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table> 
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="myVoucherModal" class="modal fade" data-backdrop="static"  role="dialog">
                                                <form method="post" action="<?php echo base_url('/Einsurance/federal_insurance') ?>" class="transaction_form" id="frmFederalVoucher">
                                                    <div class="modal-dialog" style="padding-top: 4%;">
                                                        <div class="modal-content" style="width: 500px; margin: auto;">
                                                        <div class="modal-header">
                                                        <h4><b> Please enter voucher code</b><button type="button" class="close removeVoucherFPG" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                              <div class="col-md-12">
                                                                <div class="input-group">
                                                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 39px;">Voucher Code:</span>
                                                                  <input type="text" class="form-control" name="vcode" id="vcode" placeholder="Voucher Code" aria-describedby="basic-addon1">
                                                                </div>
                                                              </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                          <button type="submit" class="btn btn-primary" name="btn_voucher">Apply</button>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </form>
                                                </div>

                                        </div>
                                        <div class="col-xs-4 col-md-3 text-right">
                                            <img class="company-logo"  src="<?php echo BASE_URL()?>assets/images/FPG New Logo with Member 2015.png" alt="">
                                        </div>

                                    </div><!--ROW-->

                                </div>  
                             </div>      
                        </div><!-- activity-list -->

                    </div><!-- tab-pane -->

                </div>
            </div><!-- col-md-8 -->
        </div><!-- row -->

    </div><!-- contentpanel -->
    
</div><!-- mainpanel -->    


<script>

    function getCert(tn){

        window.open('https://mobilereports.globalpinoyremittance.com/portal/federal_receipt/'+(tn)+'','', 'width=800,height=600');
    
    }


    function validateDate(dateInput){
        
       var bDay = new Date($('.bday').val());
      // alert(bDay.getFullYear());
       var todayDate = new Date();
      //todayDate= todayDate.getFullYear()+"-"+todayDate.getMonth()+"-"+todayDate.getDate()
       if((todayDate.getFullYear() - bDay.getFullYear())<18){
            alert("Age should be 18-65 years old");

            $('.bday').val();
             return false;
       }
       if((todayDate.getFullYear() - bDay.getFullYear())>65){
            alert("Age should be 18-65 years old");
            $('.bday').val();
             return false;
       }
       
    }

</script>    


