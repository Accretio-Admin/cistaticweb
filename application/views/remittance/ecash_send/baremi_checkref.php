  <div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-money"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>ECASH</li>
                </ul>
                <h4>Gcash Check Reference</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
    <div class="contentpanel" style="padding-top: 10px; padding-bottom: 0px;">
      <?php if ($result['S'] === 0): ?>
       <div class="alert alert-danger"><?php echo $result['M']; ?></div>
      <?php elseif ($result['S'] === 1): ?>
       <div class="alert alert-success">
       <?php echo $result['M']; ?><br />
        <b>REFERENCE NUMBER : <?php echo $result['RF']; ?></b><br/>
        <p><a href="<?php echo $result['URL']; ?>" target="_blank">Click here to download receipt.</a></p>
       </div>
      <?php elseif ($result['S'] === 25): ?>
       <div class="alert alert-warning">
       <?php echo $result['M']; ?><br />
       </div>
      <?php elseif ($result['S']===2): ?>
            <div class="alert alert-warning"><b><?php echo $result['M']?></b><br />
            <b>TRACKING NUMBER : <?php echo $result['TN']; ?></b><br />
            </div>
      <?php endif ?>
    </div><!-- contentpanel -->    

    <div class="contentpanel" style="padding-top: 0px;"> 
        <div class="panel1 panel-default1" style="border: 0px solid;">
            <div class="col-xs-12  col-md-12">
              <?php if ($process === 0): ?>
              <div class="row">
                  <div class='col-xs-12 col-md-4'>
                      <form name="frmecashtosgdfund" action="<?php echo BASE_URL() ?>ecash_send/baremi_checkref" method="post" id="frmecashsend">
                          <h5 style="font-weight: bold; color: #4169E1;">REFERENCE NUMBER:</h5>
                          <div class="form-group">
                             <input type="text" class="form-control" name="refno" id="refno" placeholder="REFERENCE NUMBER" required/>
                          </div>
                          <div class="form-group pull-right">
                             <button type="submit" class="btn btn-primary" name="btnSubmit">Submit</button> 
                          </div>
                      </form>
                  </div> <!-- col-xs-8 col-md-8-->
              </div> <!-- row -->
              <?php endif ?>
              <?php if ($process === 1): ?>
              <div class='col-md-7 col-md-offset-1 centered'>
                <form class="form-horizontal" method="post" action="<?php echo BASE_URL() ?>ecash_send/baremi_checkref" id="frmProceedSmartmoney">
                    <p id="otpMessage" style="display: none;"></p>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label" style="padding-right:3px;">Reference Number:</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="refno" id="refno" placeholder="Reference Number" value="<?php echo $result['RF'] ?>" readonly>
                        <input type="hidden" class="form-control" name="transactionno" id="transactionno" placeholder="Transaction Number" value="<?php echo $result['TN'] ?>">
                    </div>
                    </div>
                    <div class="form-group">
                      <label for="inputVerification" class="col-sm-3 control-label" style="padding-right:3px;">Verification Code:</label>
                      <div class="col-sm-9">
                        <div class="input-group">
                        <input type="text" class="form-control" name="verification_code" id="verification_code" placeholder="Enter Verification Code">
                        <span class="input-group-btn">
                          <button id="btnOTPBaremiResend" class="btn btn-danger" type="button" tabindex="-1" style="height:34px;!important; width: 100px;">Resend</button>
                        </span>
                        </div>
                      </div>
                      <small class="resendingBaremiOTPcode" style="float:right;display:none;">Verification code sending..</small>
                    </div>
                    <div class="form-group">
                          <div class="col-md-6"></div>
                          <div class="col-md-6">
                            <button type="submit" class="btn btn-primary pull-right" name="btnConfirmActivation" id="btnConfirmActivation" style="margin-left: 20px; width: 100px;">Verify</button>
                            <button type="cancel" class="btn btn-default pull-right" name="cancel" id="cancel" style="margin-left: 20px; width: 100px;">Cancel</button>
                        </div>
                    </div>
                </form>
              </div>
              <?php endif ?>
            </div> <!--col-xs-6 col-md-6-->
          </div>
        </div>           
   </div><!-- mainpanel -->            