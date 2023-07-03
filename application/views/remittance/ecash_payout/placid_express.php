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
                <h4>PLACID EXPRESS</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel" style="padding-bottom: 0px;">
        <div class="row row-stat">
            <div class="col-md-5">
                <?php if ($API['S'] == "" && !isset($API['RN'])): ?>

                    <?php if ($API['S'] === 0): ?>
                        <div class="alert alert-danger "><b><?php echo $API['M'] ?></b></div>
                    <?php endif ?>
                    <?php if ($API['S']== '1'): ?>
                        <div class="alert alert-success"><b><?php echo $API['M'] ?></b></div>
                    <?php endif ?>
                    <?php if ($result['S'] === 0): ?>
                        <div class="alert alert-danger"><b><?php echo $result['M'] ?></b></div>
                    <?php endif ?>
                    <?php if ($result['S']== 1): ?>
                        <div class="alert alert-success"><b><?php echo $result['M'] ?></b></div>
                    <?php endif ?>
                    <div class="contentpanel" style="padding-top: 0px;">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="padding-top: 15px; padding-bottom: 0px;">
                                <h5 style="font-weight: bold; color: #4169E1;">PLACID EXPRESS</h5>
                            </div>
                            <div class="panel-body">
                                <form name="frmplacidexpress" action="<?php echo BASE_URL() ?>ecash_payout/placidexpress" method="post" class="frmclass" id="frmPlacidExpress">
                                    <div class="form-group">
                                        <input type="text" class="inputNumberValidator form-control" name="inputReferenceNo" placeholder="REFERENCE NO.(12-DIGITS)" minlength="12" maxlength="12" required value="<?php echo isset($row['inputReferenceNo'])?$row['inputReferenceNo']:''?>"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required/>
                                    </div>
                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-primary"  name="btnPlacidCheck">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
                <?php if ($API['S'] == 1 && isset($API['RF'])): ?>

                    <div class="alert alert-success" style="width:auto;">&nbsp;&nbsp;<b>Transaction Successful!</b> Reference Number: <a href="https://mobilereports.globalpinoyremittance.com/portal/placid_ar_receipt/<?php echo $API['TN']; ?>" target="_blank"><?php echo $API['TN']; ?></a><br>
                        &nbsp;&nbsp;<small>Click <a href="https://mobilereports.globalpinoyremittance.com/portal/placid_ar_receipt/<?php echo $API['TN']; ?>" target="_blank">here</a> to download copy of the Acknowledgement Receipt.</small><br>
                    </div>

                    <div class="contentpanel" style="padding-top: 0px;">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="padding-top: 15px; padding-bottom: 0px;">
                                <h5 style="font-weight: bold; color: #4169E1;">PLACID EXPRESS</h5>
                            </div>
                            <div class="panel-body">
                                <form name="frmplacidexpress" action="<?php echo BASE_URL() ?>ecash_payout/placidexpress" method="post" class="frmclass" id="frmPlacidExpress">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="inputReferenceNo" placeholder="REFERENCE NO." required value="<?php echo isset($row['inputReferenceNo'])?$row['inputReferenceNo']:''?>"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required/>
                                    </div>
                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-primary"  name="btnPlacidCheck">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif ?>

                <?php if ($API['S'] == "1" && !isset($API['RF']) || ($result['S'] == 0 && isset($API['RN'])) ): ?>
                    <?php //var_dump($API)?>
                    <?php if ($API['S'] === 0): ?>
                        <div class="alert alert-danger "><b><?php echo $API['M'] ?></b></div>
                    <?php endif ?>
                    <?php if ($API['S']== '1'): ?>
                        <div class="alert alert-success"><b><?php echo $API['M'] ?></b></div>
                    <?php endif ?>
                    <?php if ($result['S'] === 0): ?>
                        <div class="alert alert-danger"><b><?php echo $result['M'] ?></b></div>
                    <?php endif ?>
                    <?php if ($result['S']== 1): ?>
                        <div class="alert alert-success"><b><?php echo $result['M'] ?></b></div>
                    <?php endif ?>
                <div class="contentpanel" style="padding-top: 0px;">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="padding-top: 0px; padding-bottom: 0px;">
                            <h5 style="font-weight: bold; color: #4169E1;">PLACID EXPRESS</h5>
                        </div>
                        <div class="panel-body" style="padding-top: 0px;">
                            <form name="frmplacidexpress" action="<?php echo BASE_URL() ?>ecash_payout/placidexpress" method="post" class="frmclass" id="frmPlacidExpress">
                                <!-- <hr /> -->

                                <h4>TRANSACTION DETAILS</h4>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1" style="padding-right: 35px;">Reference Number:</span>
                                        <input type="text" class="form-control" name="inputReferenceNo" value="<?php echo $row['inputReferenceNo']; ?>"  readonly="">
                                        <input type="hidden" class="form-control" name="Token" value="<?php echo $API['TK']; ?>"  readonly="">
                                        <input type="hidden" class="form-control" name="RN" value="<?php echo $API['RN']; ?>"  readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1" style="padding-right: 107px;">Amount:</span>
                                        <input type="text" class="form-control" name="PayoutAmount" value="<?php echo $API['D']['PayoutAmount']; ?>"  readonly="">
                                        <input type="hidden" class="form-control" name="ExchangeRate" value="<?php echo $API['D']['ExchangeRate']; ?>"  readonly="">
                                        <input type="hidden" class="form-control" name="OrgCurrency" value="<?php echo $API['D']['OrgCurrency']; ?>"  readonly="">
                                        <input type="hidden" class="form-control" name="OrgAmount" value="<?php echo $API['D']['OrgAmount']; ?>"  readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1" style="padding-right: 98px;">Currency:</span>
                                        <input type="text" class="form-control" name="PayoutCurrency" value="<?php echo $API['D']['PayoutCurrency']; ?>"  readonly="">
                                    </div>
                                </div>
                                
                                <h4>SENDER INFORMATION</h4>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1" style="padding-right: 68px;">Sender Name:</span>
                                        <input type="text" class="form-control" name="SenderName" value="<?php echo $API['D']['Sender']['SenderName']?>"  readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1" style="padding-right: 38px;">Sender Mobile No.:</span>
                                        <input type="text" class="form-control" name="SenderPhone" value="<?php echo $API['D']['Sender']['SenderPhone']; ?>"  readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1" style="padding-right: 54px;">Sender Address:</span>
                                        <input type="text" class="form-control" name="SenderAddress" value="<?php echo $API['D']['Sender']['SenderAddress'].' '.$API['D']['Sender']['SenderCity']; ?>"  readonly="">
                                    </div>
                                </div>

                                <h4>BENEFICIARY INFORMATION</h4>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1" style="padding-right: 44px;">Beneficiary Name:</span>
                                        <input type="text" class="form-control" name="ReceiverName" value="<?php echo $API['D']['Receiver']['ReceiverName'] ?>"  readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1" style="padding-right: 14px;">Beneficiary Mobile No.:</span>
                                        <input type="text" class="form-control" name="ReceiverMobile" value="<?php echo $API['D']['Receiver']['ReceiverMobile']; ?>"  readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1" style="padding-right: 30px;">Beneficiary Address:</span>
                                        <input type="text" class="form-control" name="ReceiverAddress" value="<?php echo $API['D']['Receiver']['ReceiverAddress'].' '.$API['D']['Receiver']['ReceiverCity'].' '.$API['D']['Receiver']['ReceiverCountry']; ?>"  readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1" style="padding-right: 77px;">Date of Birth:</span>
                                        <input type="text" class="form-control" id="datetimepicker" name="inputBdate" value="<?php echo $API['inputBdate']; ?>" placeholder="Birth Date" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1" style="padding-right: 90px;">Nationality:</span>
                                        <input type="text" class="form-control" name="Nationality" value="<?php echo $API['Nationality']; ?>" placeholder="Nationality" required/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1" style="padding-right: 84px;">Occupation:</span>
                                        <input type="text" class="form-control" name="Occupation" value="<?php echo $API['Occupation']; ?>" placeholder="Occupation" required/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1" style="padding-right: 12px;">Relationship to Sender:</span>
                                        <input type="text" class="form-control" name="RelSender" value="<?php echo $API['RelSender']; ?>" placeholder="Relationship to Sender" required/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1" style="padding-right: 108px;">Valid ID:</span>
                                        <select class="form-control" name="idtype" id="selvalidID" required>
                                            <option value="" disabled selected>--CHOOSE VALID ID--</option>
                                            <option value="Passport" <?php if($_POST['idtype'] == 'Passport') { echo 'selected'; } ?>>Passport</option>
                                            <option value="SSS" <?php if($_POST['idtype'] == 'SSS') { echo 'selected'; } ?>>SSS</option>
                                            <option value="GSIS" <?php if($_POST['idtype'] == 'GSIS') { echo 'selected'; } ?>>GSIS</option>
                                            <option value="Drivers License" <?php if($_POST['idtype'] == 'Drivers License') { echo 'selected'; } ?>>Driver's License</option>
                                            <option value="PhilHealth" <?php if($_POST['idtype'] == 'PhilHealth') { echo 'selected'; } ?>>PhilHealth</option>
                                            <option value="Company ID" <?php if($_POST['idtype'] == 'Company ID') { echo 'selected'; } ?>>Company ID</option>
                                            <option value="Others" <?php if($_POST['idtype'] == 'Others') { echo 'selected'; } ?>>Others</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1" style="padding-right: 87px;">ID Number:</span>
                                        <input type="text" class="form-control" name="idnumber" value="<?php echo $API['idnumber']; ?>" placeholder="ID Number" required/>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required/>
                                </div> -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <!-- <a href="#" class="btn btn-warning"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Cancel</a> -->
                                            <a href="<?php echo BASE_URL() ?>ecash_payout/placidexpress" name="btnPlacidBack" class="btn btn-warning"><span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Back</a>
                                            <!-- <button name="btnPlacidConfirm" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Confirm</button> -->
                                            <button type="button" class="btn btn-primary btn_ModalSubmit" data-toggle="modal" id="btnSubmit" data-target="#"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Process</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- <input type="hidden" class="form-control" name="inputTpass" value="<?php echo $row['inputTpass']; ?>" /> -->
                                    <input type="hidden" class="form-control" name="inputSessionID" value="<?php echo $API['sessionId']; ?>" />
                                    <input type="hidden" class="form-control" name="inputTransType" value="1" />
                                </div>

                                <!-- Modal -->
                                    <div id="myModal" class="modal fade" role="dialog">
                                      <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Transaction Summary</h4>
                                              </div>
                                              <div class="modal-body">
                                                
                                                <h4>TRANSACTION DETAILS</h4>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span style="padding-right: 41px;">Reference Number:</span>
                                                        <label><?php echo $row['inputReferenceNo']; ?></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span style="padding-right: 113px;">Amount:</span>
                                                        <label><?php echo $API['D']['PayoutAmount']; ?></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span style="padding-right: 104px;">Currency:</span>
                                                        <label><?php echo $API['D']['PayoutCurrency']; ?></label>
                                                    </div>
                                                </div>
                                                
                                                <h4>SENDER INFORMATION</h4>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span style="padding-right: 72px;">Sender Name:</span>
                                                        <label><?php echo $API['D']['Sender']['SenderName']?></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span style="padding-right: 43px;">Sender Mobile No.:</span>
                                                        <label><?php echo $API['D']['Sender']['SenderPhone']; ?></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span style="padding-right: 58px;">Sender Address:</span>
                                                        <label><?php echo $API['D']['Sender']['SenderAddress'].' '.$API['D']['Sender']['SenderCity']; ?></label>
                                                    </div>
                                                </div>

                                                <h4>BENEFICIARY INFORMATION</h4>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span style="padding-right: 47px;">Beneficiary Name:</span>
                                                        <label><?php echo $API['D']['Receiver']['ReceiverName'] ?></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span style="padding-right: 17px;">Beneficiary Mobile No.:</span>
                                                        <label><?php echo $API['D']['Receiver']['ReceiverMobile']; ?></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span style="padding-right: 35px;">Beneficiary Address:</span>
                                                        <label><?php echo $API['D']['Receiver']['ReceiverAddress'].' '.$API['D']['Receiver']['ReceiverCity'].' '.$API['D']['Receiver']['ReceiverCountry']; ?></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span style="padding-right: 81px;">Date of Birth:</span>
                                                        <label id="idBdate"><?php echo $API['inputBdate']; ?></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span style="padding-right: 95px;">Nationality:</span>
                                                        <label id="idNationality"><?php echo $API['Nationality']; ?></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span style="padding-right: 88px;">Occupation:</span>
                                                        <label id="idRelSender"><?php echo $API['RelSender']; ?></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span style="padding-right: 112px;">Valid ID:</span>
                                                        <label id="idType"><?php echo $API['idtype']; ?></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span style="padding-right: 90px;">ID Number:</span>
                                                        <label id="idNo"><?php echo $API['idnumber']; ?></label>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                  <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required/>
                                                </div>
                                              </div>
                                              <div class="modal-footer">
                                                <!-- <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">Confirm</button> -->
                                                <button name="btnPlacidConfirm" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Confirm</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- Modal -->

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif ?>
        </div>
    </div>
</div>
<script>
    var keepaliveTimeout = setTimeout("confirmLogout();", 900000)
    function resetSessionTimeout() {
        keepaliveTimeout = setTimeout("confirmLogout();", 900000)
    }
    function confirmLogout() {
        var date = new Date();
        window.location.href = window.location.pathname.substring( 0, window.location.pathname.lastIndexOf( '/' , window.location.pathname.lastIndexOf( '/')) + 1 ) + 'placidexpress';

    }

</script>

<script src="<?php echo BASE_URL()?>assets/js/jquery-2.1.4.min.js"></script>

<script>
  
  $(document).ready(function(){

    $('.btn_ModalSubmit').click(function() {
      var bday        = $("input[name=inputBdate]").val();
      var Nationality = $("input[name=Nationality]").val();
      var Occupation  = $("input[name=Occupation]").val();
      var RelSender   = $("input[name=RelSender]").val();
      var ValidID     = $('#selvalidID option:selected').val();
      var idnumber    = $("input[name=idnumber]").val();
      
      // alert(bday);

      if( bday == "" || Nationality == "" || Occupation == "" || RelSender == "" || ValidID == "" || idnumber == ""){
        alert('Please fill up all required fields.');
        $('#myModal').modal('hide');
        if(bday == ""){
          $('input[name=inputBdate]').css('border','1px solid red');
        } else if (Nationality == "") {
          $('input[name=Nationality]').css('border','1px solid red');
        } else if (Occupation == "") {
          $('input[name=Occupation]').css('border','1px solid red');
        } else if (RelSender == "") {
          $('input[name=RelSender]').css('border','1px solid red');
        } else if (ValidID == "") {
          $('#selvalidID').css('border','1px solid red');
        } else if (idnumber == "") {
          $('input[name=idnumber]').css('border','1px solid red');
        }
        
      } else {
        $('#myModal').modal('show');
        $('#selBrandPaythemId').css('border','1px solid #ccc');
        $('#selProdPaythemId').css('border','1px solid #ccc');
        $('#emailId').css('border','1px solid #ccc');
        $('#capchaId').css('border','1px solid #ccc');
      }

      $('#idBdate').html(bday);
      $('#idNationality').html(Nationality);
      $('#idOccupation').html(Occupation);
      $('#idRelSender').html(RelSender);
      $('#idType').html(ValidID);
      $('#idNo').html(idnumber);
    });


    $("input[name=inputBdate]").on("input", function() {
      var bday = $("input[name=inputBdate]").val();
      if(bday != undefined || bday != null || bday != "") {
        $('input[name=inputBdate]').css('border','1px solid #ccc');
      }
    });
    $("#datetimepicker").on("click",function(){
      var bday = $("input[name=inputBdate]").val();
      if(bday != undefined || bday != null || bday != "") {
        $('input[name=inputBdate]').css('border','1px solid #ccc');
      }
    });
    $("input[name=Nationality]").on("input", function() {
      var Nationality = $("input[name=Nationality]").val();
      if(Nationality != undefined || Nationality != null || Nationality != "") {
        $('input[name=Nationality]').css('border','1px solid #ccc');
      }
    });
    $("input[name=Occupation]").on("input", function() {
      var Occupation = $("input[name=Occupation]").val();
      if(Occupation != undefined || Occupation != null || Occupation != "") {
        $('input[name=Occupation]').css('border','1px solid #ccc');
      }
    });
    $("input[name=RelSender]").on("input", function() {
      var RelSender = $("input[name=RelSender]").val();
      if(RelSender != undefined || RelSender != null || RelSender != "") {
        $('input[name=RelSender]').css('border','1px solid #ccc');
      }
    });
    $( "#selvalidID" ).change(function() {
      var ValidID = $('#selvalidID option:selected').val();
      if(ValidID != undefined || ValidID != null || ValidID != ""){
        $('#selvalidID').css('border','1px solid #ccc');
      }
    });
    $("input[name=idnumber]").on("input", function() {
      var idnumber = $("input[name=idnumber]").val();
      if(idnumber != undefined || idnumber != null || idnumber != "") {
        $('input[name=idnumber]').css('border','1px solid #ccc');
      }
    });


  });

</script>

