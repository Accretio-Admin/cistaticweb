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
                <h4>Gcash Payout</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel" style="padding-bottom: 0px;">
        <?php if ($result['S'] === 0): ?>
        <div class="alert alert-danger"><b><?php echo $result['M'] ?></b></div>
        <?php endif ?>
        <?php if ($result['S']== 1): ?>
       <div class="alert alert-success">
       <?php echo $result['M']; ?><br />
        <b>REFERENCE NUMBER : <?php echo $result['RF']; ?></b><br/>
        <b>TRACKING NUMBER : <?php echo $result['TN']; ?></b><br/>
        <a href="<?php echo $result['URL']; ?>" target="_blank"><small>Click transaction number to download reciept.</small></a>
       </div>
      <?php endif ?>
        <div class="row row-stat">
        <?php if ($process == 0): ?>
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
                      
                            // If Outside PH and regcode is Test account blocked Service
                           if ($result->country !== 'Philippines' && $user['R'] == 'F7897947'): ?> 

                            <h3>This service is only available in the Philippines</h3>
    
                              <!-- else if not equal to Test account, Can access Service  -->
                            <?php elseif ($user['R'] !== 'F7897947'): ?>
                    
<!-- Paste ContentPanel Here -->

                    <h5 style="font-weight: bold; color: #4169E1;">REFERENCE NUMBER:</h5>
                    </div>
                    <div class="panel-body">
                      <form name="frmBaremi" action="<?php echo BASE_URL() ?>ecash_payout/baremi_payout" method="post" class="frmclass" id="frmBaremi">
                           <div class="form-group">
                              <!-- <input type="text" class="form-control" name="inputTransactionNo" placeholder="TRACKING NUMBER" required/> -->
                              <input type="text" class="form-control" name="refno" id="refno" placeholder="REFERENCE NUMBER" required/>
                          </div>
                           <div class="form-group text-right">
                              <button type="submit" class="btn btn-primary"  name="btnBaremiCheck"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Submit</button>
                          </div>
                      </form>
                    </div>
                    <?php endif; ?>

<!-- End of Ifelse IP is not equal to PH -->

                   </div>
              </div>   
            </div>
            <?php endif ?>
            <?php if ($process == 1): ?>
              <?php if ($modal == 99): ?>
              <div id="myPayoutModal" class="modal fade" role="dialog" data-backdrop="static">
                  <form id="frmBaremiPayoutModal">
                    <div class="modal-dialog" style="padding-top: 5%;">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Do you want to proceed to payout?</h4>
                        </div>
                        <div class="modal-body" style="height: 10%;">
                          <div id="alertDynammic" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px;">
                          <b><?php echo $result['M'] ?></b>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <a href="<?php echo BASE_URL() ?>ecash_payout/baremi_payout" class="btn btn-default">Not Now</a>
                          <button type="submit" class="btn btn-warning" name="btnProceed"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Proceed to Payout</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <?php endif; ?>                                

                <div class="col-md-5" id="payoutFormDetails">
                  <div class="contentpanel" style="padding-top: 0px;"> 
                      <div class="panel panel-default">
                        <div class="panel-heading" style="padding-top: 0px; padding-bottom: 0px;">
                        <h5 style="font-weight: bold; color: #4169E1;">PAYOUT INFORMATION</h5>
                        </div>
                        <div class="panel-body">
                          <form name="frmBaremi" action="<?php echo BASE_URL() ?>ecash_payout/baremi_payout" method="post" class="frmclass" id="frmBaremi">
                                <div class="form-group">
                                    <div class="input-group">
                                      <span class="input-group-addon" id="basic-addon1" style="padding-right: 26px;">TRACKING NUMBER:</span>
                                      <input type="text" class="form-control" name="trackingno" value="<?php echo $row['TN']; ?>"  readonly="">
                                    </div>
                                </div>   
                                <div class="form-group">
                                    <div class="input-group">
                                      <span class="input-group-addon" id="basic-addon1">REFERENCE NUMBER:</span>
                                      <input type="text" class="form-control" name="referenceno" value="<?php echo $row['RF']; ?>"  readonly="">
                                    </div>
                                </div>                            
                                <div class="form-group">
                                    <div class="input-group">
                                      <span class="input-group-addon" id="basic-addon1" style="padding-right: 70px;">BENEFICIARY:</span>
                                      <input type="text" class="form-control" name="beneficiary" value="<?php echo $row['B']; ?>"  readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                      <span class="input-group-addon" id="basic-addon1" style="padding-right: 95px;">ADDRESS:</span>
                                      <input type="text" class="form-control" name="address" value="<?php echo $row['AD']; ?>"  readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                      <span class="input-group-addon" id="basic-addon1" style="padding-right: 105px;">AMOUNT:</span>
                                      <input type="text" class="form-control" name="amount" value="<?php echo $row['A']; ?>"  readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="inputTranspass" id="inputTranspass" placeholder="TRANSACTION PASSWORD" required/>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                          <a href="<?php echo BASE_URL() ?>ecash_payout/baremi_payout" class="btn btn-default">Not Now</a>
                                          <button type="submit" class="btn btn-primary" name="btnConfirmPayout"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Confirm Payout</button>
                                        </div>
                                    </div>
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

<script type="text/javascript">
$(document).ready(function() {
    $('#myPayoutModal').modal({show:true});
    $("#alertDynammic").css('display','block');
    $("#alertDynammic").addClass("col-md-12");
    if ($("#myPayoutModal").data('bs.modal') && $("#myPayoutModal").data('bs.modal').isShown){
        $(".alert").css('display','none');
    }
});  
</script>
<script src="<?php echo BASE_URL()?>assets/js/baremi.js"></script>