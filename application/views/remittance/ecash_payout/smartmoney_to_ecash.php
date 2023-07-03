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
                <h4>SMARTMONEY TO E-CASH</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    



    <div class="contentpanel" style="padding-bottom: 0px;">
        <?php if ($API['S'] === 0): ?>
        <div class="alert alert-danger"><b><?php echo $API['M'] ?></b></div>
        <?php endif ?>
        <?php if ($API['S']== 1): ?>
        <div class="alert alert-success"><b><?php echo $API['M']?></b></div>
        <?php endif ?>
        <?php if ($result['S'] == 1 && $result['TN'] != NULL):?>
        <div class="alert alert-success"><b><?php echo $result['M'].' TRANSACTION NO: '.$result['TN'] ?></b></div>
        <?php endif ?>
        <div class="alert alert-danger" style="display:none; text-align: center;" id="agreementfailed"><b></b></div>
         <div class="alert alert-success" style="display:none; text-align: center;" id="agreementsuccess"><b></b></div>
            <div class="row row-stat">
              <?php if ($API['S'] == ""): ?>
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

                        <h5 style="font-weight: bold; color: #4169E1;">SMARTMONEY TO E-CASH</h5>
                        </div>
                        <div class="panel-body">
                            <form id="fromsmartmoneycheck" action="<?php echo BASE_URL() ?>ecash_payout/smartmoneytoecash" method="post" class="frmclass" id="frmSmartmoneyEcash">
                                <div class="form-group">
                                   <input type="text" class="form-control" name="inputReferenceNo" placeholder="REFERENCE NO." required/>
                                </div>
                                <div class="form-group">
                                   <input type="text" class="form-control" name="inputAmount" placeholder="AMOUNT" required/>
                                </div>
                                <div class="form-group">
                                   <input type="text" class="form-control" name="inputSmartMoneyNo" placeholder="SMARTMONEY NO." required/>
                                </div>
                                <div class="form-group">
                                   <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required/>
                                </div>
                                 <div class="form-group text-right">
                                    <button type="submit" class="btn btn-primary" name="btnSmartmoneyCheck">Submit</button>
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
                <div class="col-md-5">
                  <div class="contentpanel" style="padding-top: 0px;"> 
                      <div class="panel panel-default">
                        <div class="panel-heading" style="padding-top: 15px; padding-bottom: 0px;">
                        <h5 style="font-weight: bold; color: #4169E1;">SMARTMONEY TO E-CASH</h5>
                        </div>
                        <div class="panel-body">
                            <form id="fromsmartmoneycheck" action="<?php echo BASE_URL() ?>ecash_payout/smartmoneytoecash" method="post" class="frmclass" id="frmSmartmoneyEcash">
                                <div class="form-group">
                                    <div class="input-group">
                                      <span class="input-group-addon" id="basic-addon1" style="padding-right: 45px;">SMARTMONEY NO:</span>
                                      <input type="text" class="form-control" name="inputSmartMoneyNo" value="<?php echo $row['inputSmartMoneyNo']; ?>"  readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                      <span class="input-group-addon" id="basic-addon1" style="padding-right:107px;">AMOUNT:</span>
                                      <input type="text" class="form-control" name="inputAmount" value="<?php echo $API['A']; ?>"  readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                      <span class="input-group-addon" id="basic-addon1" style="padding-right:107px;">CHARGE:</span>
                                      <input type="text" class="form-control" name="inputCharge" value="<?php echo $API['C']; ?>"  readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="selvalidID" id="selvalidID">
                                       <option value="" disabled selected>--CHOOSE VALID ID--</option>  
                                       <option value="SSS">SSS</option>
                                       <option value="PhilHealth">PhilHealth</option>
                                       <option value="Company">Company</option>
                                       <option value="Others">Others</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                   <input type="text" class="form-control" name="inputIDNo" placeholder="ID Number" required/>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <a id="btnCancel" class="btn btn-warning"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Cancel</a>
                                            <button name="btnSmartmoneyConfirm" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Confirm</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                   <input type="hidden" class="form-control" name="inputTpass" value="<?php echo $row['inputTpass']; ?>" />
                                   <input type="hidden" class="form-control" name="inputReferenceNo" value="<?php echo $row['inputReferenceNo']; ?>" />
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

