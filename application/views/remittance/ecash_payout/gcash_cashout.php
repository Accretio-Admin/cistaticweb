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
                <h4>GCASH CASHOUT</h4>
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
            <div class="row row-stat">
              <?php if ($API['S'] == ""): ?>
                <div class="col-md-5">
                  <div class="contentpanel" style="padding-top: 0px;"> 
                      <div class="panel panel-default">
                        <div class="panel-heading" style="padding-top: 15px; padding-bottom: 0px;">
                        <h5 style="font-weight: bold; color: #4169E1;">GCASH CASHOUT</h5>
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
                                    <button type="submit" class="btn btn-primary" name="btnGcashCheck">Submit</button>
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
                                            <a href="#" class="btn btn-warning"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Cancel</a>
                                            <button name="btnGcashConfirm" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Confirm</button>
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