<div class="mainpanel">
  <div class="pageheader">
      <div class="media">
          <div class="pageicon pull-left">
              <i class="fa fa-money"></i>
          </div>
          <div class="media-body">
              <ul class="breadcrumb">
                  <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                  <li>BILLS PAYMENT</li>
              </ul>
              <h4>INSURANCE</h4>
          </div>
      </div><!-- media -->
  </div><!-- pageheader -->          
  <div class="contentpanel">
    <div class="row">
      <div class="col-xs-12 col-md-5">
        <?php if ($API['S'] === 0): ?>
          <div class="alert alert-danger"><b><?php echo $API['M'] ?></b></div>
        <?php endif ?>
        <?php if ($API['S']== 1 && $submitBtn == 1): ?>
          <div class="alert alert-success">&nbsp;&nbsp;<b><?php echo $API['M'] ?> </b><br /><a href="https://mobilereports.globalpinoyremittance.com/portal/billspayment_receipt/<?php echo $API['TN'];  ?>" target="_blank"><?php echo $API['TN'];  ?></a>
          &nbsp;&nbsp;<small>Click transaction number to download receipt.</small>
          </div>
          </div>
        <?php endif ?>
        <div class="form-group">
          <select class="form-control" name="selBiller" id="selBiller">
            <option value="" disabled selected>CHOOSE INSURANCE BILLER</option>  
            <?php 
              foreach ($biller as $key): 
                $pieces = explode("|", $key);
                $BD = strtoupper($pieces[0]);
                $BC = strtoupper($pieces[1]);
                $FT = strtoupper($pieces[2]);
                $TF = strtoupper($pieces[3]);
            ?>
              <option value="<?php echo $BC ?>" data-name ="<?php echo $BD ?>" data-type ="<?php echo $FT ?>" data-desc = "<?php echo $user['CG'].'|'.$user['L'].'|'.$TF ?>" ><?php echo $BD ?></option>  
            <?php endforeach ?>
          </select>
        </div>

        <div class="utilities28" style="display: none;"> 
          <form name="frmUtilitiesLoading" action="<?php echo BASE_URL() ?>Bills_payment/insurance" method="post" id="frmUtilitiesLoading">
            <div class="form-group" id="divBiller28"></div>
            <div class="form-group">
                <input type="text" class="form-control" name="inputAccountNumber" placeholder="ACCOUNT NUMBER" required/>
            </div>
            <div id="divDyanamicAccountNo28"></div>
            <div class="form-group">
              <input type="text" class="form-control datetimepicker readonly" name="inputDueDate" id="inputDueDate" autocomplete="off" placeholder="DUE DATE" required/>
            </div>
            <div class="form-group">
              <input type="text" class="form-control datetimepicker readonly" name="inputDateFT28" id="inputDateFT28" autocomplete="off" required/>
            </div>
            <div class="form-group">
                <input type="text" class="form-control"  name="inputAmount" placeholder="AMOUNT"  onkeypress="return isNumberKey(event)" required />
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
            </div>                    
            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">SUBMIT</button>
            </div>
          </form>
        </div>

        <!-- data type == 1 -->  
        <div class="utilities1" style="display: none;" id="datatype1"> 
          <form name="frmUtilitiesLoading" action="<?php echo BASE_URL() ?>Bills_payment/insurance" method="post" id="frmUtilitiesLoading">
              <div class="form-group" id="divBiller1"> </div>   
              <div id="divDynamicBiller"> </div>
              <div class="form-group">
                  <input type="text" class="form-control" name="inputSubscriberName" id="inputSubscriberName" placeholder="SUBSCRIBER NAME" required/>
              </div>
              <div class="form-group" style="display: none;" id="inputDueDateDisplay">
                <input type="text" class="form-control inputDueDate1 datetimepicker" name="inputDueDate1" id="inputDueDate1"  placeholder="DUE DATE" oncopy = "return false" onpaste="return false" oncut="return false" readonly required/>
              </div>
              <div class="form-group" style="display: none;" id="inputMobileDisplay">
                <input type="text" class="form-control inputNumberValidator inputMobileNumber" name="inputMobileNumber" id="inputMobileNumber" maxlength="11" placeholder="MOBILE NUMBER" required />
              </div>
              <div class="form-group">
                  <input type="text" class="form-control inputNumberValidator inputAmount" name="inputAmount" id="inputAmount" placeholder="AMOUNT" required/>
              </div>
              <div class="form-group text-right">
                  <button type="button" class="btn btn-primary btn-lg btn_ModalSubmit" data-toggle="modal" id="btnSubmit" data-target="#myModal1">Submit</button>
              </div>

              <!-- Modal -->
              <div id="myModal1" class="modal fade" role="dialog" id="datatypemodal1">
                <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Transaction Summary</h4>
                    </div>
                    <div class="modal-body">
                      <div class="alert alert-info"><b>Please check your details and click "confirm button" to proceed transaction.</b></div>
                      <div class="form-group" id="mdBiller">
                          <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1" style="padding-right:17px;">BILLER NAME. :</span>
                            <span class="form-control" id="basic-addon2" style=""><label id="idBiller" class="idBiller"></label></span>
                          </div>
                      </div>
                      <div class="form-group" id="mAcctNo">
                          <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1" style="padding-right:17px;">ACCOUNT / REFERENCE NUMBER. :</span>
                            <span class="form-control" id="basic-addon2" style=""><label id="idAcctNo" class="idAcctNo"></label></span>
                          </div>
                      </div>
                      <div class="form-group" style="display: none;" id="mPolicyNo">
                          <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1" style="padding-right:17px;">POLICY NUMBER. :</span>
                            <span class="form-control" id="basic-addon2" style=""><label id="idPolicyNo" class="idPolicyNo"></label></span>
                          </div>
                      </div>
                      <div class="form-group" style="display: none;" id="mPromiNo">
                          <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1" style="padding-right:17px;">PROMISSORY NOTE NUMBER. :</span>
                            <span class="form-control" id="basic-addon2" style=""><label id="idPromiNo" class="idPromiNo"></label></span>
                          </div>
                      </div>
                      <div class="form-group" style="display: none;" id="mAcctName">
                          <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1" style="padding-right:17px;">ACCOUNT NAME. :</span>
                            <span class="form-control" id="basic-addon2" style=""><label id="idAcctName" class="idAcctName"></label></span>
                          </div>
                      </div>
                      <div class="form-group" style="display: none;" id="mPolicyName">
                          <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1" style="padding-right:17px;">POLICY NAME. :</span>
                            <span class="form-control" id="basic-addon2" style=""><label id="idPolicyName" class="idPolicyName"></label></span>
                          </div>
                      </div>
                      <div class="form-group" style="display: none;" id="mBillName">
                          <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1" style="padding-right:17px;">BILLING NAME. :</span>
                            <span class="form-control" id="basic-addon2" style=""><label id="idBillName" class="idBillName"></label></span>
                          </div>
                      </div>
                      <div class="form-group" style="display: none;" id="mBorrowName">
                          <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1" style="padding-right:17px;">BORROWER'S NAME. :</span>
                            <span class="form-control" id="basic-addon2" style=""><label id="idBorrowName" class="idBorrowName"></label></span>
                          </div>
                      </div>
                      <div class="form-group" style="display: none;" id="mDueDate">
                          <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1" style="padding-right:17px;">DUE DATE. :</span>
                            <span class="form-control" id="basic-addon2" style=""><label id="idDuedate" class="idDuedate"></label></span>
                          </div>
                      </div>
                      <div class="form-group" style="display: none;" id="mMobileNo">
                          <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1" style="padding-right:17px;">MOBILE NO. :</span>
                            <span class="form-control" id="basic-addon2" style=""><label id="idMobileNo" class="idMobileNo"></label></span>
                          </div>
                      </div>
                      <div class="form-group" style="display: none;" id="mTelNo">
                          <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1" style="padding-right:17px;">TELEPHONE NO. :</span>
                            <span class="form-control" id="basic-addon2" style=""><label id="idTelNo" class="idTelNo"></label></span>
                          </div>
                      </div>
                      <div class="form-group" style="display: none;" id="mAmount">
                          <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1" style="padding-right:17px;">AMOUNT. :</span>
                            <span class="form-control" id="basic-addon2" style=""><label id="idAmount" class="idAmount"></label></span>
                          </div>
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">Confirm</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
          </form>
        </div>

        <!-- data type == 11 -->  
        <div class="utilities11" style="display: none;">
          <form name="frmInsuranceLoading" action="<?php echo BASE_URL() ?>Bills_payment/insurance" method="post" id="frmInsuranceLoading">
            <div class="form-group" id="divBiller11"> </div>   
            <div class="form-group">
                <input type="text" class="form-control" name="inputAccountNumber" placeholder="POLICY ACCOUNT NUMBER" required />
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="inputSubscriberName" placeholder="SUBSCRIBER NAME" required/>
            </div>
            <div class="form-group">
                <input type="text" class="form-control inputAmount"  name="inputAmount" id="inputAmount" placeholder="AMOUNT" required />
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">SUBMIT</button>
            </div>
          </form>
        </div>
        <!-- data type == 11 --> 

        <!-- data type == 25-->  
        <div class="utilities25" style="display: none;" id="datatype25"> 
          <form name="frmUtilitiesLoading" action="<?php echo BASE_URL() ?>Bills_payment/insurance" method="post" class="frmUtilitiesLoading" id="frmUtilitiesLoading">
            <div class="form-group" id="divBiller25"> </div>   
            <div class="form-group" id="divDynamicBiller25"> </div>
            <!--<div class="form-group">
                <input type="text" class="form-control" name="inputAccountNumber" placeholder="ACCOUNT NUMBER" required />
            </div> -->
            <div class="form-group">
                <input type="text" class="form-control inputNameValidator inputSubscriberName" name="inputSubscriberName" id="inputSubscriberName" placeholder="ACCOUNT NAME" required/>
            </div>
            <div class="form-group" id="DynamicBillerNumber25" style="display: none;"> </div>
            <div class="form-group" id="DynamicDueDate25" style="display: none;"> 
              <input type="text" class="form-control inputDueDate datetimepicker" name="inputDueDate" id="inputDueDate" placeholder="DUE DATE (mmddyyyy)" required />
            </div>
            <div class="form-group"> 
                <input type="tel" class="inputNumberValidator form-control inputMobile" name="inputMobile" id="inputMobile" placeholder="MOBILE NUMBER (11-Digits)" minlength="11" maxlength="11" required />
            </div>
            <div class="form-group">
                <input type="number" class="form-control inputAmount" name="inputAmount" id="inputAmount" step=".01" placeholder="AMOUNT" required />
            </div>
            <!-- <div class="form-group">
                <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
            </div> -->
            <div class="form-group text-right">
              <!-- <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">SUBMIT</button> -->
              <button type="button" class="btn btn-primary btn-lg btn_Modal25Submit" data-toggle="modal" id="btnSubmit" data-target="#myModal25">Submit</button>
            </div>

            <!-- Modal -->
            <div id="myModal25" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Transaction Summary</h4>
                  </div>
                  <div class="modal-body">
                  <!-- <div class="form-group">
                    <p>Please check your details and click "confirm button" to proceed transaction.</p>
                    <p>
                      <span> Biller Name : </span> <label id="idBiller" class="idBiller"></label>
                    </p>
                    <p> 
                      <span> Account/ Reference Number : </span> <label id="idAcctNo" class="idAcctNo"></label>
                    </p>
                    <p>
                      <span> Account Name : </span> <label id="idAcctName" class="idAcctName"></label>
                    </p>
                    <p class="idDueDate" style="display: none;"> 
                      <span> Due Date/ Bill Month : </span> <label id="idDueDate"></label>
                    </p>
                    <p class="idBillNo" style="display: none;"> 
                      <span> ATM Reference No./ Bill No. : </span> <label id="idBillNo"></label>
                    </p>
                    <p> 
                      <span> Mobile No. : </span> <label id="idMobNo" class="idMobNo"></label>
                    </p>
                    <p>
                      <span> Amount : </span> <label id="idAmount" class="idAmount"></label>
                    </p>
                  </div>
                  
                  <div class="form-group">
                    <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                  </div> -->
                    <div class="alert alert-info"><b>Please check your details and click "confirm button" to proceed transaction.</b></div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right:85px;">Biller Name :</span>
                          <span class="form-control" id="basic-addon2" style=""><label id="idBiller" class="idBiller"></label></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right:7px;">Account/ Reference No. :</span>
                          <span class="form-control" id="basic-addon2" style=""><label id="idAcctNo" class="idAcctNo"></label></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right:65px;">Account Name :</span>
                          <span class="form-control" id="basic-addon2" style=""><label id="idAcctName" class="idAcctName"></label></span>
                        </div>
                    </div>
                    <div class="form-group idDueDate" style="display: none;">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right:28px;">Due Date/ Bill Month :</span>
                          <span class="form-control" id="basic-addon2" style=""><label id="idDueDate" class="idDueDate"></label></span>
                        </div>
                    </div>
                    <div class="form-group idBillNo" style="display: none;">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right:25px;">ATM Ref No./ Bill No. :</span>
                          <span class="form-control" id="basic-addon2" style=""><label id="idBillNo" class="idBillNo"></label></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right:90px;">Mobile No. :</span>
                          <span class="form-control" id="basic-addon2" style=""><label id="idMobNo" class="idMobNo"></label></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right:109px;">Amount :</span>
                          <span class="form-control" id="basic-addon2" style=""><label id="idAmount" class="idAmount"></label></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right:17px;">Transaction Password :</span>
                          <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                        </div>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">Confirm</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- data type == 25 --> 

        <!-- data type == 26 -->  
        <div class="utilities26" style="display: none;" id = "datatype26"> 
          <form name="frmInsuranceLoading" action="<?php echo BASE_URL() ?>Bills_payment/insurance" method="post" id="frmInsuranceLoading">
            <div class="form-group" id="divBiller26"> </div>   
            <div class="form-group">
              <input type="text" class="form-control inputNameValidator inputSubscriberName" name="inputSubscriberName" placeholder="NAME OF POLICY HOLDER" oncopy="return false" oncut="return false" onpaste="return false" autocomplete="off" required/>
            </div>
            <div class="form-group">
              <input type="text" class="form-control inputNumberValidator" name="inputRefNumber" id="inputRefNumber" placeholder = "POLICY / REFERENCE NUMBER" oncopy="return false" oncut="return false" onpaste="return false" autocomplete="off" required />
            </div>
            <div class="form-group">
              <select class = "form-control selectIdType" id = "selectIdType" name = "selectIdType" required>
                <option value = "">Select ID Type</option>
              </select>
            </div>
            <div class="form-group">
              <input type="text" class="form-control inputValidIdNumber"  name="inputValidIdNumber" id="inputValidIdNumber" placeholder="VALID ID NUMBER" oncopy="return false" oncut="return false" onpaste="return false" autocomplete="off" required />
            </div>
            <div class="form-group">
              <input type="text" class="form-control inputNumberValidator inputMobileNumber"  name="inputMobileNumber" id="inputMobileNumber" maxlength = "11" minlength = "11" placeholder="MOBILE NO." oncopy="return false" oncut="return false" onpaste="return false" autocomplete="off" required />
            </div>
            <div class="form-group">
              <input type="text" class="form-control inputNameValidator" id = "inputPayorsName" name="inputPayorsName" placeholder="PAYOR'S NAME" oncopy="return false" oncut="return false" onpaste="return false" autocomplete="off" required/>
            </div>
            <div class="form-group">
              <input type="text" class="form-control inputAmount"  name="inputAmount" id="inputAmount" placeholder="AMOUNT" required />
            </div>
            <!-- <div class="form-group">
                <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
            </div> -->
            <div class="form-group text-right">
                <!-- <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">SUBMIT</button> -->
                  <button type="button" class="btn btn-primary btn-lg btn_Modal26Submit" data-toggle="modal" id="btnSubmit" data-target="#myModal26">Submit</button>
            </div>
                
            <!-- Modal -->
            <div id="myModal26" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Transaction Summary</h4>
                  </div>
                  <div class="modal-body">
                    <!-- <div class="form-group">
                      <p>Please check your details and click "confirm button" to proceed transaction.</p>
                      <p>
                        <span> Biller Name : </span> <label id="idBiller" class="idBiller"></label>
                      </p>
                      <p> 
                        <span> Account/ Reference Number : </span> <label id="idAcctNo" class="idAcctNo"></label>
                      </p>
                      <p>
                        <span> Account Name : </span> <label id="idAcctName" class="idAcctName"></label>
                      </p>
                      <p class="idDueDate" style="display: none;"> 
                        <span> Due Date/ Bill Month : </span> <label id="idDueDate"></label>
                      </p>
                      <p class="idBillNo" style="display: none;"> 
                        <span> ATM Reference No./ Bill No. : </span> <label id="idBillNo"></label>
                      </p>
                      <p> 
                        <span> Mobile No. : </span> <label id="idMobNo" class="idMobNo"></label>
                      </p>
                      <p>
                        <span> Amount : </span> <label id="idAmount" class="idAmount"></label>
                      </p>
                    </div>
                    
                    <div class="form-group">
                      <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                    </div> -->

                    <div class="alert alert-info"><b>Please check your details and click "confirm button" to proceed transaction.</b></div>

                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right:85px;">Biller Name :</span>
                          <span class="form-control" id="basic-addon2" style=""><label id="idBiller" class="idBiller"></label></span>
                        </div>
                    </div>
                        <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right:20px;">Name of Policy Holder :</span>
                          <span class="form-control" id="basic-addon2" style=""><label id="idAcctName" class="idAcctName"></label></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right:17px;">Policy / Reference No. :</span>
                          <span class="form-control" id="basic-addon2" style=""><label id="idAcctNo" class="idAcctNo"></label></span>
                        </div>
                    </div>
                  
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right:110px;">ID Type :</span>
                          <span class="form-control" id="basic-addon2" style=""><label id="idType" class="idType"></label></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right:83px;">Valid ID No. :</span>
                          <span class="form-control" id="basic-addon2" style=""><label id="idValid" class="idValid"></label></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right:90px;">Mobile No. :</span>
                          <span class="form-control" id="basic-addon2" style=""><label id="idMobNo" class="idMobNo"></label></span>
                        </div>
                    </div>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right:70px;">Payor's Name :</span>
                          <span class="form-control" id="basic-addon2" style=""><label id="idpayor" class="idpayor"></label></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right:109px;">Amount :</span>
                          <span class="form-control" id="basic-addon2" style=""><label id="idAmount" class="idAmount"></label></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right:17px;">Transaction Password :</span>
                          <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                        </div>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">Confirm</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- data type == 26 --> 
      </div>

      <div class="col-xs-12 col-md-7">
        <div class="row">
          <div class="col-xs-12 col-md-11">
            <div class="form-group">
              <div class="alert alert-info alert-biller-default" style="display:none;word-wrap:break-word;"></div>
              <div class="alert alert-info alert-biller" style="display:none;word-wrap:break-word;"></div>
            </div>
          </div>
          <div class="col-xs-12 col-md-11">
            <div class="panel panel-default1 alert-biller-reminder">
              <div class="panel-body" style="border: 1px solid #d3d3d3; border-radius:10px; padding: none;"><!--style="background-color: #FF9933;"-->
                <h4 class="text-info" style="font-weight: bold;"><i class="fa fa-bell" aria-hidden="true"></i> IMPORTANT REMINDERS</h4>
                <p> <b><span class="text-info1">1.</span></b> Customer needs to present their <b>Statement of Account (SOA)</b> over-the-counter. </p>
                <p> <b><span class="text-info1">2.</span></b> Inform the customers of the <b>Three (3) days</b> posting of bills payment transaction.  </p>
                <p> <b><span class="text-info1">3.</span></b> Accept Cash payments from customers or subscribers if a Statement of Account/Billing from specific biller institution is presented provided such payment is in <b>Full (No partial), Exact amount (No rounding off), Not overdue and Without any arrears such as with Disconnection notice and/or Unpaid previous bill</b>. </p>
                <p> <b><span class="text-info1">4.</span></b> After every transaction, <b>download and print Acknowledgement Receipt</b>. Original copy of the acknowledgement receipt will be issued to the customer as proof of payment. </p>

                <h4>
                  <b><span class="text-danger">Note:</span></b> <br> 
                  <div class="col-xs-12 col-md-12">
                    <b> <span class="text-danger">*</span> Collections received after the clearing <i class="text-danger">Cut-off time of 3:45PM</i> shall be treated as transactions for the next banking day. </b>
                  </div>
                </h4>
              </div>
            </div>   
          </div><!-- col-md-9 -->
        </div>
      </div>
    </div><!-- row -->
  </div><!-- contentpanel -->  
</div><!-- mainpanel -->            

<script>
  window.onload = populateSelect();
  function populateSelect(){
    var idObj = [{
          "name": "Passport",
          "value": "Passport"
        },
        {
          "name": "Driver’s License",
          "value": "Driver’s License"
        },
        {
          "name": "Professional Regulation Commission ID",
          "value": "PRC ID"
        },
        {
          "name": "National Bureau of Investigation Clearance",
          "value": "NBI Clearance"
        },
        {
          "name": "Police Clearance",
          "value": "Police Clearance"
        },
        {
          "name": "Postal ID",
          "value": "Postal ID"
        },
        {
          "name": "Voter’s ID",
          "value": "Voter’s ID"
        },
        {
          "name": "Barangay Certification",
          "value": "Barangay ID"
        },
        {
          "name": "Government Service Insurance System e-Card",
          "value": "GSIS E-card"
        },
        {
          "name": "Social Security System Card",
          "value": "SSS Card"
        },
        {
          "name": "Overseas Workers Welfare Administration ID",
          "value": "OWWA ID"
        },
        {
          "name": "Overseas Filipino Worker ID",
          "value": "OFW ID"
        },
        {
          "name": "Seaman’s Book",
          "value": "Seaman’s Book"
        },
        {
          "name": "Alien Certification of Registration/Immigrant Certificate of Registration",
          "value": "Alien and Immigrant Certificate of Registration"
        },
        {
          "name": "Government Office ID",
          "value": "Government Office ID"
        },
        {
          "name": "Certification from the National Council for the Welfare of Disabled Persons ",
          "value": "NCWDP"
        },
        {
          "name": "Department of Social Welfare and Development Certification",
          "value": "DSWD Certificate"
        },
        {
          "name": "INTEGRATED BAR OF THE PHILIPPINES ID",
          "value": "IBP ID"
        },
        {
          "name": "Company ID",
          "value": "Company ID"
        },
        {
          "name": "School ID",
          "value": "School ID"
        }
      ];

    var ele = document.getElementById('selectIdType');
    for (var i = 0; i < idObj.length; i++) {
        // POPULATE SELECT ELEMENT WITH JSON.
        ele.innerHTML = ele.innerHTML + '<option value="' + idObj[i]['value'] + '">' + idObj[i]['name'] + '</option>';
    }
  }
</script>
<script src="<?php echo BASE_URL()?>assets/js/jquery-2.1.4.min.js">
</script>
<script>
  $(document).ready(function(){
    $(".readonly").on('keydown paste focus mousedown', function(e){
        if(e.keyCode != 9) // ignore tab
            e.preventDefault();
    });
    
    $("#selBiller").change(function() {
      $("#inputAccountNumber").val('');
      $("#inputSubscriberName").val('');
      $("#inputAmount").val('');
      $("#inputMobile").val('');
      $(".inputAccountNumber").val('');
      $(".inputSubscriberName").val('');
      $(".inputAmount").val('');
      $(".inputMobile").val('');
      $(".inputDueDate").val('');
      $(".inputBillerNo").val('');
      $(".inputCampus").val('');
    });

    $('.btn_Modal25Submit').click(function() {
      var biller = $('#selBiller option:selected').data('name');
      var billerNo = $('#selBiller option:selected').val();
      var acctNo = $("#inputAccountNumber").val();
      var acctName = $(".inputSubscriberName").val();
      var amount = $("#datatype25 .inputAmount").val();
      var mobNo = $(".inputMobile").val();
      var refno = $("#inputBillerNo").val();
      var duedate = $("#inputDueDate").val();

      // alert(refno);
      if(refno != '' && refno != undefined){
        // alert(refno);
        $('.idBillNo').show();
        $('#myModal25 #idBillNo').html(refno); 
      }

      if(duedate != '' && duedate != undefined){
        // alert(duedate);
        $('.idDueDate').show();
        $('#myModal25 #idDueDate').html(duedate); 
      }
      
      $('#myModal25 .idBiller').html(biller);
      $('#myModal25 .idAcctNo').html(acctNo);
      $('#myModal25 .idAcctName').html(acctName);
      $('#myModal25 .idAmount').html(amount);
      $('#myModal25 .idMobNo').html(mobNo);       
    });

    $('.btn_Modal26Submit').click(function() {
      var biller = $('#selBiller option:selected').data('name');
      var billerNo = $('#selBiller option:selected').val();
      var acctNo = $("#inputRefNumber").val();
      var acctName = $("#datatype26 .inputSubscriberName").val();
      var idType = $(".selectIdType").val();
      var validId = $(".inputValidIdNumber").val();
      var mobNo = $(".inputMobileNumber").val();
      var payor = $("#inputPayorsName").val();
      var amount = $("#datatype26 .inputAmount").val();
     
      $('#myModal26 .idBiller').html(biller);
      $('#myModal26 .idAcctName').html(acctName);
      $('#myModal26 .idAcctNo').html(acctNo);
      $('#myModal26 .idType').html(idType);
      $('#myModal26 .idValid').html(validId);
      $('#myModal26 .idMobNo').html(mobNo);   
      $('#myModal26 .idpayor').html(payor); 
      $('#myModal26 .idAmount').html(amount);
      
    });

    $('.btn_ModalSubmit').click(function() {
      var biller = $('#selBiller option:selected').data('name');
      var billerNo = $('#selBiller option:selected').val();
      var acctNo = $("#inputAccountNumber").val();
      var acctName = $(".utilities1 #inputSubscriberName").val();
      var amount = $("#inputAmount").val();
      var due = $("#inputDueDate1").val();
      var phone = $("#inputMobileNumber").val();
      var fname = $("#inputFirstName").val();
      var mname = $("#inputMiddleName").val();
      var lname = $("#inputLastName").val();
      var acctNo1 = $("#inputAccountNumber1").val();

      if(billerNo == '808'){
        $("#mAcctNo").show();
        $("#mPolicyNo").hide();
        $("#mAcctName").hide();
        $("#mBillName").hide();
        $("#mPolicyName").hide();
        $("#mAmount").show();
        $("#mDueDate").show();
        $("#mMobileNo").hide();
        $("#mPromiNo").hide();
        $("#mBorrowName").hide();
        $("#mTelNo").hide();
        $('#myModal1 #idBiller').html(biller);
        $('#myModal1 #idAcctNo').html(acctNo);
        $('#myModal1 #idAmount').html(amount);
        $('#myModal1 #idDuedate').html(due);
      }else if(billerNo == '809'){
        $("#mAcctNo").show();
        $("#mPolicyNo").hide();
        $("#mAcctName").hide();
        $("#mBillName").show();
        $("#mPolicyName").hide();
        $("#mAmount").show();
        $("#mDueDate").show();
        $("#mMobileNo").hide();
        $("#mPromiNo").hide();
        $("#mBorrowName").hide();
        $("#mTelNo").hide();
        $('#myModal1 #idBiller').html(biller);
        $('#myModal1 #idAcctNo').html(acctNo);
        $('#myModal1 #idAmount').html(amount);
        $('#myModal1 #idBillName').html(acctName);
        $('#myModal1 #idDuedate').html(due);
      }else if(billerNo == '810' || billerNo == '811'){
        $("#mAcctNo").hide();
        $("#mPolicyNo").show();
        $("#mAcctName").hide();
        $("#mBillName").hide();
        $("#mPolicyName").show();
        $("#mAmount").show();
        $("#mDueDate").hide();
        $("#mMobileNo").show();
        $("#mPromiNo").hide();
        $("#mBorrowName").hide();
        $("#mTelNo").hide();
        $('#myModal1 #idBiller').html(biller);
        $('#myModal1 #idPolicyNo').html(acctNo1);
        $('#myModal1 #idAmount').html(amount);
        $('#myModal1 #idMobileNo').html(phone);
        $('#myModal1 #idPolicyName').html(fname + ' ' + mname + ' ' + lname);
      }else if(billerNo == '812'){
        $("#mAcctNo").show();
        $("#mPolicyNo").hide();
        $("#mAcctName").hide();
        $("#mBillName").hide();
        $("#mPolicyName").show();
        $("#mAmount").show();
        $("#mDueDate").hide();
        $("#mMobileNo").show();
        $("#mPromiNo").hide();
        $("#mBorrowName").hide();
        $("#mTelNo").hide();
        $('#myModal1 #idBiller').html(biller);
        $('#myModal1 #idAcctNo').html(acctNo);
        $('#myModal1 #idAmount').html(amount);
        $('#myModal1 #idMobileNo').html(phone);
        $('#myModal1 #idPolicyName').html(fname + ' ' + mname + ' ' + lname);
      }else if(billerNo == 'CHANGE TO BILLERNO OF - MAXICARE'){
        $("#mAcctNo").show();
        $("#mPolicyNo").hide();
        $("#mAcctName").show();
        $("#mBillName").hide();
        $("#mPolicyName").hide();
        $("#mAmount").show();
        $("#mDueDate").show();
        $("#mMobileNo").hide();
        $("#mPromiNo").hide();
        $("#mBorrowName").hide();
        $("#mTelNo").show();
        $('#myModal1 #idBiller').html(biller);
        $('#myModal1 #idAcctNo').html(acctNo);
        $('#myModal1 #idAcctName').html(fname + ' ' + mname + ' ' + lname);
        $('#myModal1 #idDuedate').html(due);
        $('#myModal1 #idAmount').html(amount);
        $('#myModal1 #idTelNo').html(phone);
      }else if(billerNo == 'CHANGE TO BILLERNO OF - ETERNAL PLANS'){
        $("#mAcctNo").hide();
        $("#mPolicyNo").hide();
        $("#mAcctName").hide();
        $("#mBillName").hide();
        $("#mPolicyName").hide();
        $("#mAmount").show();
        $("#mDueDate").hide();
        $("#mMobileNo").show();
        $("#mPromiNo").show();
        $("#mBorrowName").show();
        $("#mTelNo").hide();
        $('#myModal1 #idBiller').html(biller);
        $('#myModal1 #idPromiNo').html(acctNo);
        $('#myModal1 #idAmount').html(amount);
        $('#myModal1 #idMobileNo').html(phone);
        $('#myModal1 #idBorrowName').html(fname + ' ' + mname + ' ' + lname);
      }
    });

    $('.frmUtilitiesLoading').on('submit', function(){
       waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
    });

    $('#datatype25 .inputAmount').on('change', function(){
      var amount = $("#datatype25 .inputAmount").val();
      if(amount <= 0 || amount == "")
      {
          alert('Invalid Amount');
          $('#datatype25 .inputAmount').val('');
      }
      else
      {
          $(this).val(parseFloat($(this).val()).toFixed(2));
      }
    });

    $('#datatype26 .inputAmount').on('change', function(){
      var amount = $("#datatype26 .inputAmount").val();
      if(amount <= 0 || amount == "")
      {
          alert('Invalid Amount');
          $('#datatype25 .inputAmount').val('');
      }
      else
      {
          $(this).val(parseFloat($(this).val()).toFixed(2));
      }
    });

    $('#datatype1 .inputAmount').on('change', function(){
      var amount = $("#datatype1 .inputAmount").val();
      if(amount <= 0 || amount == "")
      {
          $('#datatype1 .inputAmount').val('');
      }
      else
      {
          $(this).val(parseFloat($(this).val()).toFixed(2));
      }
    });
  });
</script>    