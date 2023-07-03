<style type="text/css">
  .input-group {
    padding-bottom: 1%;
  }
</style>
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
              <h4>E-Cash To Cebuana</h4>
          </div>
      </div><!-- media -->
  </div><!-- pageheader -->
  <div class="contentpanel" style="padding-bottom: 0px;">
       <div class="row row-stat">
          <div class="col-md-12">
              <?php if ($results['S']==1): ?>
                  <div class="alert alert-success">
                    <?php echo $results['M']; ?>
                        <?php if ($results['R']!=1): ?>
                          <br />
                          <b>TRACKING NUMBER : <?php echo $results['TN']; ?></b><br />
                          <b>REFERENCE NUMBER : <?php echo $results['RF']; ?></b>
                          <?php if ($results['URL']!=''): ?>
                          <br /><p><a href="<?php echo $results['URL'].$results['TN']; ?>" target="_blank">Click here to download receipt.</a></p>
                        <?php endif ?>
                      <?php endif ?>
                  </div>
              <?php endif ?>  

              <?php if ($results['S']==2): ?>
                  <div class="alert alert-warning">
                  <b><?php echo $results['M']?></b><br />
                  <?php if($results['S']==2): ?>
                  <b>TRACKING NUMBER : <?php echo $results['TN']; ?></b>
                  <?php endif ?> 
                  </div>
              <?php endif ?> 
              <?php if ($results['S']==4): ?>
                  <div class="alert alert-success">
                    <b><?php echo $results['M']?></b><br />
                  </div>
              <?php endif ?>    
              <?php if ($results['S']===0): ?>
                  <div class="alert alert-danger"><b><?php echo $results['M']; ?>!!</b></div>
              <?php endif ?>
              <?php if ($fetchdata['S']===0): ?>
                  <div class="alert alert-danger"><b><?php echo $fetchdata['M']; ?>!!</b></div>
              <?php endif ?>
              <div id="alertDynammic" style="display:none"></div>
              <div class="row">
              <?php if ($process != 1): ?>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addModal" id="btnNewClient"><span class="glyphicon glyphicon-plus"></span> &nbsp;Register New Sender</a> 
                      </div>
                      <div class="form-group">
                          <form name="frmCebuanaSearchSender" action="<?php echo BASE_URL() ?>ecash_send/ecashtocebuana" method="post" id="frmCebuanaSearchSender" >   
                            <div class="row" id="SenderRadioDiv">
                              <div class='col-xs-12 col-md-8'>
                                <div class="radio">
                                  <label class="col-md-6"><input type="radio" name="optradio" value="0" id="byNameSender" checked="checked">Search BY Name</label>
                                  <label class="col-md-6"><input type="radio" name="optradio" value="1" id="byClientSender">Search BY Client Number</label>
                                </div>
                              </div>
                            </div>
                            <div class="row" id="SendersearchNameDiv">
                              <div class='col-xs-12 col-md-12'>
                                <div class="input-group" style="width: inherit;">
                                  <span class="input-group-addon" id="basic-addon1" style="width: 32%; text-align: left;">SENDER NAME:</span>
                                  <input type="text" class="form-control" placeholder="FIRSTNAME" name="senderFname" id="senderFname" aria-describedby="basic-addon1" style="width: 35%" required>
                                  <input type="text" class="form-control" placeholder="LASTNAME" name="senderLname" id="senderLname" aria-describedby="basic-addon1" style="width: 35%" required>
                                  <input type="hidden" name="hiddenSenderInfo" id="hiddenSenderInfo">
                                  <button type="submit" name="btnSsearch" id="btnSender" class="btn btn-primary btnSender" style="width: 10%">
                                    <span id="spanSIcon" class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                  </button>
                                </div>
                              </div>
                            </div> 
                            <div class="row" id="SendersearchClientDiv">
                                <div class='col-xs-12 col-md-12'>
                                  <div class="input-group" style="width: inherit;">
                                    <span class="input-group-addon" id="basic-addon1" style="width: 29%; text-align: left;">SENDER CLIENT NO:</span>
                                    <input type="text" class="form-control" placeholder="CLIENT NUMBER" name="senderClientNo" id="senderClientNo" aria-describedby="basic-addon1" style="width: 70%" required>
                                    <button type="submit" name="btnSsearch" id="btnSender" class="btn btn-primary btnSender" style="width: 10%;">
                                      <span id="spanSIcon" class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                    </button>
                                  </div>
                                </div>
                            </div> 
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <div class="row" id="BenesearchNameDiv" style="display:none;">
                          <div class='col-xs-12 col-md-12'>
                            <div class="input-group" style="width: inherit;">
                              <span class="input-group-addon" id="basic-addon1" style="width: 29%; text-align: left;">BENEFICIARY NAME:</span>
                              <input type="text" class="form-control" placeholder="BENEFICIARY NAME" name="beneName" id="beneName" style="width: 70%;" aria-describedby="basic-addon1">
                              <input type="hidden" name="hiddenBeneInfo" id="hiddenBeneInfo">
                            </div>
                          </div>
                        </div> 
                        <form id="frmDomesticRates"> 
                        <div class="row" id="domesticRates" style="display:none;">
                          <div class='col-xs-12 col-md-12'>
                            <div class="input-group" style="width: inherit;">
                              <span class="input-group-addon" id="basic-addon1" style="width: 32.5%; text-align: left;">AMOUNT:</span>
                              <select name="sel_currency" id="sel_currency" class="form-control" style="width: 20%; font-size: x-small;" required></select>
                              <input type="text" class="form-control inputAmount" placeholder="0.00" name="amount" id="amount" style="width: 50%;" aria-describedby="basic-addon1" required>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6"></div>
                          <div class="col-md-6">
                          <button type="submit" class="btn btn-warning btnCebuanaRates" style="display: none;">Proceed &nbsp;<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></button>
                          </div>                    
                        </div>
                        </form>
                    </div>
                 </div>
               </div>
             </div>
            <?php else: ?>
                <div class="col-md-6 col-md-offset-1 centered">
                  <form class="form-horizontal" method="post" action="<?php echo BASE_URL() ?>ecash_send/ecashtocebuana" id="frmOTPCebuana">
                      <p id="otpMessage" style="display: none;"></p>
                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label" style="padding-right:3px;">Transaction Number:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="transactionno" id="transactionno" placeholder="Transaction Number" value="<?php echo $results['TN']; ?>" readonly>
                      </div>
                      </div>
                      <div class="form-group">
                        <label for="inputVerification" class="col-sm-3 control-label" style="padding-right:3px;">Verification Code:</label>
                        <div class="col-sm-9">
                          <div class="input-group">
                          <input type="text" class="form-control" name="verification_code" id="verification_code" placeholder="Enter Verification Code" required="">
                          <span class="input-group-btn">
                            <button id="btnOTPCebuanaResend" class="btn btn-danger" type="button" tabindex="-1" style="height:34px;!important; width: 100px;">Resend</button>
                          </span>
                          </div>
                        </div>
                        <small class="resendingCebuanaOTPcode" style="float:right;display:none;">Verification code sending..</small>
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
            <?php endif; ?>              
            </div>
          </div>
      </div>

       <div class="col-md-12">
        <?php if ($fetchdata['S']==1): ?>
          <hr/>
          <h4 id="tableHeader"><?php echo $type['typedesc']; ?> Result/s : <?php echo $fetchdata['M']; ?></h4>
          <table id="example"  class="table table-bordered" cellspacing="0" style="width:100%;">
            <thead>
              <tr>
                <th>Client ID</th>
                <th>Client Number</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Birthdate</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php  foreach ($fetchdata['C_DATA'] as $i): ?>
              <tr class="tr">
                  <td class="td"><?php echo $i['C_ID']; ?></td>
                  <td class="td"><?php echo $i['C_NO']; ?></td>
                  <td class="td"><?php echo $i['C_FN']; ?></td>
                  <td class="td"><?php echo $i['C_MN']?></td>
                  <td class="td"><?php echo $i['C_LN']; ?></td>
                  <td><?php echo str_replace('T00:00:00','',$i['C_BD']); ?></td>
                  <td><a id="aFindCebuanaClient" class="btn btn-danger aFindCebuanaClient" data-id="<?php echo $type['typeid']; ?>" href="#">Select</a></td>
              </tr>
              <?php endforeach ?>
            </tbody>
          </table> 
          <?php endif ?>
        </div>

  </div>   
</div>

  <div class="modal fade" id="myModal" role="dialog" >
      <div class="modal-dialog" style="padding-top: 5%; width: 35%;">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">REMITTANCE INFORMATION</h4>
          </div>
          <form id="frmRatesConfirmation">
            <div class="modal-body">
              <div class="row">
                <div class='col-xs-12 col-md-12'>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="text-align: left; padding-right: 69px;">CURRENCY:</span>
                    <input type="text" class="form-control" name="currency" id="currency" readonly="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class='col-xs-12 col-md-12'>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="text-align: left;">PRINCIPAL AMOUNT:</span>
                    <input type="text" class="form-control" name="p_amount" id="p_amount" readonly="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class='col-xs-12 col-md-12'>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="text-align: left; padding-right: 88px;">CHARGE:</span>
                    <input type="text" class="form-control" name="charge" id="charge" readonly="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class='col-xs-12 col-md-12'>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="text-align: left; padding-right: 104px;">TOTAL:</span>
                    <input type="text" class="form-control" name="total" id="total" readonly="">
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
              <div class="col-md-6"></div>
                <div class="col-md-6 text-right">
                  <button type="button" class="btn btn-default" id="btnCancel" name="btnCancel">Back</button>
                  <button type="button" class="btn btn-primary" id="btnConfirm" name="btnConfirm">Submit</button>
                </div>
              </div>
            </div>
            </form>
          </div>
        </div>
    </div>


  <div class="modal fade" id="remittanceSummaryModal" role="dialog" >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">SUMMARY TRANSACTION DETAILS</h4>
          </div>
          <form name="frmSummaryConfirmation" action="<?php echo BASE_URL() ?>ecash_send/ecashtocebuana" method="post" id="frmSummaryConfirmation" > 
            <div class="modal-body">
              <h5><strong>SENDER INFORMATION</strong></h5>
              <div class="row">
                <div class='col-xs-12 col-md-12'>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="text-align: left; padding-right: 120px;">SENDER ID:</span>
                    <input type="text" class="form-control" name="senderid" id="senderid" readonly="">
                    <input type="hidden" name="hiddenSenderDetails" id="hiddenSenderDetails">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class='col-xs-12 col-md-12'>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="text-align: left; padding-right: 94px;">SENDER NAME:</span>
                    <input type="text" class="form-control" name="sender_name" id="sender_name" readonly="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class='col-xs-12 col-md-12'>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="text-align: left; padding-right: 119px;">BIRTHDATE:</span>
                    <input type="text" class="form-control" name="sender_bdate" id="sender_bdate" readonly="">
                  </div>
                </div>
              </div>
              <h5><strong>BENEFICIARY INFORMATION</strong></h5>
              <div class="row">
                <div class='col-xs-12 col-md-12'>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="text-align: left; padding-right: 86px;">BENEFICIARY ID:</span>
                    <input type="text" class="form-control" name="beneid" id="beneid" readonly="">
                    <input type="hidden" name="hiddenBeneDetails" id="hiddenBeneDetails">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class='col-xs-12 col-md-12'>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="text-align: left; padding-right: 59px;">BENEFICIARY NAME:</span>
                    <input type="text" class="form-control" name="bene_name" id="bene_name" readonly="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class='col-xs-12 col-md-12'>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="text-align: left; padding-right: 119px;">BIRTHDATE:</span>
                    <input type="text" class="form-control" name="bene_bdate" id="bene_bdate" readonly="">
                  </div>
                </div>
              </div>
              <hr/>
              <h5><strong>REMITTANCE INFORMATION</strong></h5>
              <div class="row">
                <div class='col-xs-12 col-md-12'>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="text-align: left; padding-right: 118px;">CURRENCY:</span>
                    <input type="text" class="form-control" name="icurrency" id="icurrency" readonly="">
                    <input type="hidden" class="form-control" name="currency_id" id="currency_id">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class='col-xs-12 col-md-12'>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="text-align: left; padding-right: 61px;">PRINCIPAL AMOUNT:</span>
                    <input type="text" class="form-control" name="iamount" id="iamount" readonly="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class='col-xs-12 col-md-12'>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="text-align: left; padding-right: 137px;">CHARGE:</span>
                    <input type="text" class="form-control" name="icharge" id="icharge" readonly="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class='col-xs-12 col-md-12'>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="text-align: left; padding-right: 153px;">TOTAL:</span>
                    <input type="text" class="form-control" name="itotal" id="itotal" readonly="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class='col-xs-12 col-md-12'>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="text-align: left;">TRANSACTION PASSWORD:</span>
                    <input type="password" class="form-control" name="tpass" id="tpass" required="">
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
              <div class="col-md-6"></div>
                <div class="col-md-6 text-right">
                  <button type="cancel" class="btn btn-default" id="btnCancel" name="btnCancel">Back</button>
                  <button type="submit" class="btn btn-primary" id="btnSubmit" name="btnSubmit">Confirm</button>
                </div>
              </div>
            </div>
            </form>
          </div>
        </div>
    </div>

  <!---ADD NEW SENDER AND BENIFICIARY-->
  <div class="modal fade" id="addModal" role="dialog" data-backdrop="static">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content" style="margin-top: 15%;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="newClientModal">REGISTER NEW SENDER</h4>
          </div>
          <form action="<?php echo BASE_URL() ?>ecash_send/ecashtocebuana" method="post"  id="frmAddCebuana">
            <div class="modal-body">
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group" id="divRefSenderID" style="display: none;">
                          <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" required>SENDER ID:</span>
                            <input type="text" class="form-control" name="refSenderID" id="refSenderID" value="1" readonly/>
                          </div>
                      </div> 
                      <div class="form-group">
                          <input type="text" class="form-control inputLatinNameValidator" name="inputFname" placeholder="FIRSTNAME" required/>
                      </div>  
                       <div class="form-group">
                          <input type="text" class="form-control inputLatinNameValidator" name="inputMname" placeholder="MIDDLENAME" />
                      </div> 
                       <div class="form-group">
                          <input type="text" class="form-control inputLatinNameValidator" name="inputLname"  placeholder="LASTNAME" required/>
                      </div> 
                      <div class='col-md-6' style="padding-left:0px!important">
                         <div class="form-group" >
                             <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1" required>BIRTHDATE</span>
                              <input type="text" class="form-control" name="inputBdate" id="datetimepicker" placeholder="BIRTHDATE" readonly required />
                            </div>
                        </div> 
                      </div>
                       <div class='col-md-6' style="padding-right:0px!important">
                         <div class="form-group">
                            <input type="text" class="form-control inputNumberValidator" name="inputMobile" pattern="[9]{1}[0-9]{9}" maxlength ="10" placeholder="MOBILE NUMBER" required/>
                        </div> 
                      </div>
                      <div class="form-group">
                          <input type="password" class="form-control" placeholder="TRANSACTION PASSWORD" name="inputTpass" required>
                          <input type="hidden" class="form-control" name="newClientType" id="newClientType" value="1" readonly="">
                      </div>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                  <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary" id="btnAddDetails" name="btnAddDetails">Submit &nbsp;<span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
                  </div>
              </div>
              
            </form>
          </div>
        </div>
        
      </div>

<script src="<?php echo BASE_URL()?>assets/js/ecashtocebuana.js"></script>