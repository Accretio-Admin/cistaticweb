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
        <h4>Smart Padala Check Reference Number</h4>
      </div>
    </div><!-- media -->
  </div><!-- pageheader -->

    <div class="contentpanel" style="padding-bottom: 0px;">
          
        <div class="row row-stat">         
          <div class="col-md-12"> 
             <div class="col-md-5"> 
              <div style="display:none; text-align: center;" id="alertDynammic"></div>
              <div style="display:none;" class="alert " id="iMessage">
               
              </div> 

              <?php $msg = $this->session->flashdata('msg'); ?>
              <div style="display:<?php echo (count($msg) > 0 || isset($API)) ? "block":"none"; ?>;" class="alert " id="dvSessionMessaeg">
                <?php if ($API['S']===0): ?>
                      <div class="alert alert-danger"><b> <i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo $API['M']?></b></div>
                <?php endif ?>
                <?php if ($API['S']==1): ?>
                      <div class="alert alert-success"><b> <i class="fa fa-check-circle" aria-hidden="true"></i> <b> SUCCESSFUL.</b> <br> <?php echo $API['M']?></b></div>
                <?php endif ?>
                <?php if ($API['S']==3): ?>
                      <div class="alert alert-warning"><b> <i class="fa fa-check" aria-hidden="true"></i> <?php echo $API['M']?></b></div>
                <?php endif;  
                  
                  if ($msg['S']==1): ?>
                    <!-- <div class="alert alert-success" style="text-align:center">&nbsp;&nbsp;<b><i class="fa fa-check-circle" aria-hidden="true"></i> <b> SUCCESSFUL.</b> <br>.</b> Tracking Number: <a href="<?php echo $msg['URL']; ?>" target="_blank"><?php echo $msg['TN'];  ?></a><br>
                      &nbsp;&nbsp;<small>Click <a href="<?php echo $msg['URL']; ?>" target="_blank">here</a> to download copy of the Acknowledgement Receipt.</small>
                    </div> -->
                    <div class="alert alert-success"><b> <i class="fa fa-check-circle" aria-hidden="true"></i> <b> Please wait for the approval from our technical support. </b> <br> <?php echo $API['M']?></b></div>
                <?php endif ?>

                <?php 
                  $msg = $this->session->flashdata('msg');
                  if ($msg['S']==2 || $msg['S']==3 || $msg['S'] == "REMITAGAIN"): ?>
                    <div class="alert alert-warning">
                        <i class="fa fa-check" aria-hidden="true"></i> <?php echo $msg['M']; ?></b>
                    </div>
                <?php endif ?>
              </div>

            </div>
          </div>
        </div>

        <div class="row row-stat">
           <div class="col-md-5">
              <div class="contentpanel" style="padding-top: 0px;"> 
                <div class="panel panel-default">
                  <div class="panel-heading" style="padding-top: 5px; padding-bottom: 0px;">
                  <h5 style="font-weight: bold; color: #4169E1;">Check Transaction Status <a href="<?php echo BASE_URL() ?>ecash_send/ecash_to_paymaya" class="text-danger pull-right"> <i class="fa fa-arrow-left"></i> Back</a></h5>
                  </div>
                  <div class="panel-body">
                    <!-- <form name="frmpaymaya" action="<?php echo BASE_URL() ?>ecash_send/paymaya_checkrefno" method="post" class="frmclass" id="frmPaymaya"> -->
                    <div id="mainForn" style="display:<?php echo (isset($mess['S']) && ($msg['S'] == "REMITAGAIN" || $msg['S'] == "OTP") ? "none":"block") ?>">
                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-4 control-label" style="padding-right:3px;">Tracking Number:</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control inputReferenceNo" name="inputReferenceNo" id="inputReferenceNo" placeholder="Enter Tracking Number" required="">
                          <span id="spnErrorRefnum" class="text-error"></span>
                        </div>
                      </div>

                      <div class="form-group text-right">
                        <div class="col-sm-12">
                          <button class="btn btn-primary" name="btnPaymayaCheck" id="btnPaymayaCheck">Submit</button>
                        </div>
                      </div>
                    </div>
                    <div id="confirmForm" style="display:<?php echo (isset($mess['S']) && ($msg['S'] == "REMITAGAIN" || $msg['S'] == "OTP") ? "block":"none") ?>">
                      <p id="otpMessage" style="display: none;"></p>

                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label" style="padding-right:3px;">Tracking Number:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control inputReferenceNo" name="inputReferenceNo" id="inputReferenceNoUnhold" placeholder="Enter Tracking Number" required="" value="<?php echo ((isset($mess['S']) && isset($mess['TN'])) && ($msg['S'] == "REMITAGAIN" || $msg['S'] == "OTP") ? $mess['TN']:"")?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputVerification" class="col-sm-3 control-label" style="padding-right:3px;">Verification Code:</label>
                        <div class="col-sm-9">
                          <div class="input-group">
                          <input type="text" class="form-control" name="inputVericode" id="inputVericode" placeholder="Enter Verification Code" required="">
                          <span class="input-group-btn">
                            <button id="btnOTPPaymayaResend" class="btn btn-danger btnOTPPaymayaResend" type="button" tabindex="-1" style="height:34px;!important; width: 100px;">Resend</button>
                          </span>
                          </div>
                        </div>
                        <small class="resendingPaymayaOTPcode text-danger" style="float:right;display:none;">Verification code sending..</small>
                      </div>

                      <hr>

                      <div class="form-group">
                          <div class="col-md-12">
                          <button type="submit" class="btn btn-primary pull-right" name="btnPaymayaUnhold" id="btnPaymayaUnhold" style="margin-left: 20px; width: 100px;">Verify</button>
                          </div>
                      </div>
                      </div>
                    <!-- </form> -->
                  </div>
                 </div>
              </div>   
            </div>
        </div>
    </div>
</div>

<script src="<?php echo BASE_URL()?>assets/script/ecash_paymaya.js"></script>
<script >
$(document).ready(function(){
  $("#btnPaymayaUnhold").click(function(e){
    waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'primary' });
    e.preventDefault();
    var parameter = {
      trackingNumber: $("#inputReferenceNoUnhold").val(),
      verificationCode:$("#inputVericode").val()
    };

    $("#alertDynammic").empty();
    $("#iMessage").empty();
    $("#iMessage").removeClass('alert-warning');
    $("#iMessage").removeClass('alert-success');

    $.ajax({
      url: "/Ecash_send/ajaxUnholdRemittance",
      type: "POST",
      data: parameter,
      dataType: "json",
      cache: false,
      success: function (response) {
          // console.log(response);
        if (response.S === 1) {
          $("#iMessage").hide();
          $("#iMessage").show();
          // var message = '&nbsp;&nbsp;<b><i class="fa fa-check-circle" aria-hidden="true">' +
          //   '</i>VERIFICATION SUCCESSFULs.</b> Tracking Number: <a href="https://mobilereports.globalpinoyremittance.com/portal/ecash_to_paymaya_receipt/' + parameter.trackingNumber +
          //   '" target="_blank" >'+parameter.trackingNumber+'</a><br>' +
          //   '&nbsp;&nbsp;<small>Click <a href="https://mobilereports.globalpinoyremittance.com/portal/ecash_to_paymaya_receipt/'+parameter.trackingNumber+'"' +
          //   ' target="_blank">here</a> to download copy of the Acknowledgement Receipt.</small>';

          var message = '&nbsp;&nbsp;<b><i class="fa fa-check-circle" aria-hidden="true">' +
            '</i>VERIFICATION SUCCESSFUL. TRANSACTION IS FOR APPROVAL OF TSR.</b>  <br>';
          $("#iMessage").addClass("alert-success");
          $("#iMessage").append(message);
        } else {
           var message = '<b> <i class="fa fa-exclamation-circle" aria-hidden="true"></i> ' + response.M + '</b>';
          $("#iMessage").addClass("alert-danger");
          $("#iMessage").append(message);
          $("#mainForn").show();
          $("#confirmForm").hide();
        }

        $("#iMessage").show(); 
        waitingDialog.hide();
      }
    });
  });

  function resetsRemittanceForms() {
    
  }
});
</script>
