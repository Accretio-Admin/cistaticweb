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
                <h4>Cebuana Amendment</h4>
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
        <div id="alertDynammic" style="display:none"></div>
        <?php if ($API['S'] == ""): ?>
            <div class="col-md-5">
              <div class="contentpanel" style="padding-top: 0px;"> 
                  <div class="panel panel-default">
                    <div class="panel-heading" style="padding-top: 15px; padding-bottom: 0px;">
                    <h5 style="font-weight: bold; color: #4169E1;">CEBUANA</h5>
                    </div>
                    <div class="panel-body">
                      <form name="frmCebuana" action="<?php echo BASE_URL() ?>ecash_send/cebuana_amend" method="post" class="frmclass" id="frmEcashPadala">
                           <div class="form-group">
                              <input type="text" class="form-control" name="inputReferenceNo" placeholder="ENTER CONTROL NUMBER" required/>
                          </div>
                           <div class="form-group text-right">
                              <button type="submit" class="btn btn-primary" name="btnCebuanaCheck"><span class="glyphicon glyphicon-search"></span>&nbsp;Search</button>
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
                          <p><?php echo '*Sent via '.str_replace("T"," ",$details['F']); ?></p>
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 84px;">SENDER ID:</span>
                                  <input type="text" class="form-control" name="inputSenderID" id="inputSenderID" value="<?php echo $details['Sender']['C_ID']; ?>"  readonly="">
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

                            <div class="col-sm-offset-9">                            
                              <div class="form-group">                            
                                <div class="dropdown">
                                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown"><a href="#" class="text-right" style="color:#333;"><span class="glyphicon glyphicon-pencil" aria-hidden="true" style="color:#428bca;"></span> Beneficiary</a>
                                  <span class="caret"></span></button>
                                  <ul class="dropdown-menu">
                                    <li><a href="#" class="aChangeBeneficiary"><span class="glyphicon glyphicon-refresh" aria-hidden="true" style="color:#428bca;"></span> Change Beneficiary</li>
                                    <li><a href="#" id="btnAmendNewClient"><span class="glyphicon glyphicon-plus" aria-hidden="true" style="color:#428bca;"></span> Add Beneficiary</a></li>
                                  </ul>
                                </div>
                              </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 50px;">BENEFICIARY ID:</span>
                                  <input type="text" class="form-control" name="inputNewBeneficiaryID" id="inputNewBeneficiaryID" value="<?php echo $details['Beneficiary']['B_ID']; ?>"  readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 76px;">FIRST NAME:</span>
                                  <input type="text" class="form-control" name="inputNewBeneficiaryFName" id="inputNewBeneficiaryFName" value="<?php echo $details['Beneficiary']['B_FN']; ?>"  readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 63px;">MIDDLE NAME:</span>
                                  <input type="text" class="form-control" name="inputNewBeneficiaryMName" id="inputNewBeneficiaryMName" value="<?php echo $details['Beneficiary']['B_MN']; ?>"  readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 81px;">LAST NAME:</span>
                                  <input type="text" class="form-control" name="inputNewBeneficiaryLName" id="inputNewBeneficiaryLName" value="<?php echo $details['Beneficiary']['B_LN']; ?>"  readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 92px;">BIRTHDAY:</span>
                                  <input type="text" class="form-control" name="inputNewBeneficiaryBdate" id="inputNewBeneficiaryBdate" value="<?php $bene_bday = explode("T", $details['Beneficiary']['B_BD']); echo $bene_bday[0]; ?>"  readonly="">
                                </div>
                            </div>
                            <hr/>
                             <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 82px;">CURRENCY:</span>
                                  <input type="text" class="form-control" name="inputCurrency" value="<?php echo $details['Rates']['CUR_CODE']; ?>"  readonly="">
                                  <input type="hidden" class="form-control" name="inputCurrencyID" id="inputCurrencyID" value="<?php echo $details['Rates']['CUR_ID']; ?>"  readonly="">
                                </div>
                            </div>
                             <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 25px;">PRINCIPAL AMOUNT:</span>
                                  <input type="text" class="form-control" name="inputPAmount" id="inputPAmount" value="<?php echo $details['Rates']['PA']; ?>"  readonly="">
                                </div> 
                            </div>
                             <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 101px;">CHARGE:</span>
                                  <input type="text" class="form-control" name="inputCharge" id="inputCharge" value="<?php echo $details['Rates']['SF']; ?>"  readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="<?php echo BASE_URL() ?>ecash_send/cebuana_amend" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back</a>
                                        <button name="btnCebuanaAmmend" id="btnCebuanaAmmend" class="btn btn-warning" disabled=""><span class="glyphicon glyphicon-arrow-right"></span>&nbsp;Proceed</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="controlnumber" id="controlnumber" value="<?php echo $ctrlnumber; ?>"/>
                                <input type="hidden" class="form-control" name="newBeneID" id="newBeneID"/>
                            </div>
                    </div>
                   </div>
              </div>   
            </div>
            <?php endif ?>
          </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" data-backdrop="static" role="dialog" >
    <div class="modal-dialog">
      <div class="modal-content" style="width: max-content; margin-left: -15%; margin-top: 15%;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">LIST OF BENEFICIARY</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                  <h4 id="tableHeader"></h4>
                  <table id="changeBeneficiary"  class="table table-bordered" cellspacing="0" style="width:100%;">
                    <thead>
                      <tr>
                        <th>Client ID</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Birthday</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                  </table> 
                </div>
            </div>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="myAmmendmentModal" data-backdrop="static" role="dialog">
    <form name="frmAmmendConfirmation" action="<?php echo BASE_URL() ?>ecash_send/cebuana_amend" method="post" class="frmclass" id="frmAmmendConfirmation">
      <div class="modal-dialog">
        <div class="modal-content" style="width: 80%; margin-top: 15%;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">AMENDMENT FEE</h4>
          </div>
          <div class="modal-body">
            <p id="ammendMessage"></p>
             <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 82px;">SERVICE FEE:</span>
                  <input type="text" class="form-control" name="inputAmmendFee" id="inputAmmendFee" readonly="">
                </div>
            </div>
            <div class="form-group">
               <input type="password" class="form-control" name="inputTranspass" id="inputTranspass" placeholder="TRANSACTION PASSWORD" required/>
               <input type="text" class="form-control" name="inputAmmendDetails" id="inputAmmendDetails"/>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button name="btnCebuanaAmmendConfirm" id="btnCebuanaAmmendConfirm" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span>&nbsp;Confirm</button>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </form>
</div>


  <!---ADD NEW SENDER AND BENIFICIARY-->
  <div class="modal fade" id="addModalAmend" role="dialog" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content" style="margin-top: 15%;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="newClientModal">REGISTER NEW SENDER</h4>
          </div>
          <form id="frmAddCebuanaBene">
            <div class="modal-body">
              <div class="row">
                <div id="alertDynammicModal" style="display:none"></div>
                  <div class="col-md-12">
                      <div class="form-group" id="divRefSenderID" style="display: none;">
                          <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" required>SENDER ID:</span>
                            <input type="text" class="form-control" name="refSenderID" id="refSenderID" value="1" readonly/>
                          </div>
                      </div> 
                      <div class="form-group">
                          <input type="text" class="form-control inputLatinNameValidator" name="inputFname" id="inputFname" placeholder="FIRSTNAME" required/>
                      </div>  
                       <div class="form-group">
                          <input type="text" class="form-control inputLatinNameValidator" name="inputMname" id="inputMname" placeholder="MIDDLENAME" required/>
                      </div> 
                       <div class="form-group">
                          <input type="text" class="form-control inputLatinNameValidator" name="inputLname" id="inputLname"  placeholder="LASTNAME" required/>
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
                            <input type="text" class="form-control inputNumberValidator" name="inputMobile" id="inputMobile" pattern="[0]{1}[9]{1}[0-9]{9}" maxlength ="11" placeholder="MOBILE NUMBER" required/>
                        </div> 
                      </div>
                      <div class="form-group">
                          <input type="password" class="form-control" placeholder="TRANSACTION PASSWORD" name="inputTpass" id="inputTpass" required>
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



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo BASE_URL()?>assets/js/ecashtocebuana.js"></script>