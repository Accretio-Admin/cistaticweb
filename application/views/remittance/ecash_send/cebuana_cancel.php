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
                <h4>Cebuana Cancellation</h4>
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
        <?php if ($result['S']== 1): ?>
        <div class="alert alert-success"><b><?php echo $result['M'] ?></b></div>
        <?php endif ?>
        <div class="row row-stat">
        <?php if ($API['S'] == ""): ?>
            <div class="col-md-5">
              <div class="contentpanel" style="padding-top: 0px;"> 
                  <div class="panel panel-default">
                    <div class="panel-heading" style="padding-top: 15px; padding-bottom: 0px;">
                    <h5 style="font-weight: bold; color: #4169E1;">CEBUANA</h5>
                    </div>
                    <div class="panel-body">
                      <form name="frmCebuana" action="<?php echo BASE_URL() ?>ecash_send/cebuana_cancel" method="post" class="frmclass" id="frmEcashPadala">
                           <div class="form-group">
                              <input type="text" class="form-control" name="inputReferenceNo" placeholder="ENTER CONTROL NUMBER" required/>
                          </div>
                           <div class="form-group text-right">
                              <button type="submit" class="btn btn-primary"  name="btnCebuanaCheck"><span class="glyphicon glyphicon-search"></span>&nbsp;Search</button>
                          </div>
                      </form>
                    </div>
                   </div>
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
                      <form name="frmCebuanaConfirm" action="<?php echo BASE_URL() ?>ecash_send/cebuana_cancel" method="post" class="frmclass" id="frmEcashPadala">
                            <p><?php echo '*Sent via '.str_replace("T"," ",$details['F']); ?></p>
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
                                  <input type="text" class="form-control" name="inputBeneficiaryFName" value="<?php echo $details['Beneficiary']['B_FN']; ?>"  readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 63px;">MIDDLE NAME:</span>
                                  <input type="text" class="form-control" name="inputBeneficiaryMName" value="<?php echo $details['Beneficiary']['B_MN']; ?>"  readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 81px;">LAST NAME:</span>
                                  <input type="text" class="form-control" name="inputBeneficiaryLName" value="<?php echo $details['Beneficiary']['B_LN']; ?>"  readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 92px;">BIRTHDAY:</span>
                                  <input type="text" class="form-control" name="inputBeneficiaryBdate" value="<?php $bene_bday = explode("T", $details['Beneficiary']['B_BD']); echo $bene_bday[0]; ?>"  readonly="">
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
                                  <input type="text" class="form-control" name="inputAmount" value="<?php echo $details['Rates']['PA']; ?>"  readonly="">
                                </div>
                            </div>
                             <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 101px;">CHARGE:</span>
                                  <input type="text" class="form-control" name="inputAmount" value="<?php echo $details['Rates']['SF']; ?>"  readonly="">
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group">
                               <input type="password" class="form-control" name="inputTranspass" placeholder="TRANSACTION PASSWORD" required/>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="#" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back</a>
                                        <button name="btnCebuanaCancel" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Cancel</button>
                                        <button name="btnCebuanaRefund" class="btn btn-warning"><span class="glyphicon glyphicon-minus-sign"></span>&nbsp;Refund</button>
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
</div>