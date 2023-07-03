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
                <h4>OTHERS</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
    <div class="contentpanel">
        <div class="row">
            <div class="col-xs-12 col-md-5">
                <div style="display:none; text-align: center;" id="alertDynammic"></div>
                <?php if ($API['S'] === 0): ?>
                <div class="alert alert-danger"><b><?php echo $API['M'] ?></b></div>
                <?php endif ?>
                <?php if ($API['S']== 1 && $submitBtn == 1): ?>
                <div class="alert alert-success">&nbsp;&nbsp;<b><?php echo $API['M'] ?>.</b> Tracking Number: <a href="https://mobilereports.globalpinoyremittance.com/portal/billspayment_receipt/<?php echo $API['TN'];  ?>" target="_blank"><?php echo $API['TN'];  ?></a><br>
                   &nbsp;&nbsp;<small>Click <a href="https://mobilereports.globalpinoyremittance.com/portal/billspayment_receipt/<?php echo $API['TN']; ?>" target="_blank">here</a> to download copy of the Acknowledgement Receipt.</small>
                </div>
                <?php endif ?>
                <div class="form-group">
                    <select class="form-control" name="selBiller" id="selBiller">
                        <option value="" disabled selected>CHOOSE BILLER</option>  
                    <?php 
                    foreach ($biller as $key): 
                     $pieces = explode("|", $key);
                     $BD = strtoupper($pieces[0]);
                     $BC = strtoupper($pieces[1]); 
                     $FT = strtoupper($pieces[2]);
                     $TF = strtoupper($pieces[3]);
                     
                    ?>
                        <?php //if(!($BC<=1)&&!($BC>=240) || $BC>=371){ ?>
                        <option value="<?php echo $BC ?>" data-name ="<?php echo $BD ?>" data-type ="<?php echo $FT ?>" data-desc = "<?php echo $user['CG'].'|'.$user['L'].'|'.$TF ?>" ><?php echo $BD ?></option>
                        <?php //} ?>
                    <?php endforeach ?>
                    </select>
                </div>

                <div class="utilities28new" style="display: none;"> 
                  <form name="frmOthersLoading" action="<?php echo BASE_URL() ?>Bills_payment/others" method="post" id="frmOthersLoading">
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

                <!-- data type == 1 && 8 && 7-->  
                <div class="utilities1" style="display: none;"> 
                    <form name="frmOthersLoading" action="<?php echo BASE_URL() ?>Bills_payment/others" method="post" id="frmOthersLoading">
                       <div class="form-group" id="divBiller1"> </div>
                       <div class="form-group" id="divDynamicBiller"> </div>   
<!--                         <div class="form-group">
                            <input type="text" class="form-control" name="inputAccountNumber" placeholder="ACCOUNT NUMBER" required />
                        </div> -->
                        <div class="form-group">
                            <input type="text" class="inputNameValidator form-control" name="inputSubscriberName" id="inputSubscriberName" placeholder="ACCOUNT NAME" required/>
                        </div>
                        <div class="form-group" id="DynamicBillerMobNo" style="display: none;"> 
                            <input type="tel" class="inputNumberValidator form-control" name="inputMobile" id="inputMobile" placeholder="MOBILE NUMBER (11-Digits)" maxlength="11" required />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputAmount" id="inputAmount" placeholder="AMOUNT" required />
                        </div>
                        <!-- <div class="form-group">
                            <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                        </div> -->
                        <div class="form-group text-right">
                            <!-- <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">SUBMIT</button> -->
                            <button type="button" class="btn btn-primary btn-lg btn_ModalSubmit" data-toggle="modal" id="btnSubmit" data-target="#">Submit</button>
                        </div>

                        <!-- Modal -->
                        <div id="myModal1" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Transaction Summary</h4>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <p>Please check your details and click "confirm button" to proceed transaction.</p>
                                      <p>
                                        <span> Biller Name : </span> <label id="idBiller"></label>
                                      </p>
                                      <p> 
                                        <span> Account/ Reference Number : </span> <label id="idAcctNo"></label>
                                      </p>
                                      <p>
                                        <span> Account Name : </span> <label id="idAcctName"></label>
                                      </p>
                                      <p class="idMobileNo" style="display: none;"> 
                                        <span> Mobile No. : </span> <label id="idMobNo"></label>
                                      </p>
                                      <p>
                                        <span> Amount : </span> <label id="idAmount"></label>
                                      </p>
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
                </div><!-- data type == 1 --> 

                <!-- data type == 2-->  
                <div class="utilities2" style="display: none;"> 
                    <form name="frmOthersLoading" action="<?php echo BASE_URL() ?>Bills_payment/others" method="post" id="frmOthersLoading">
                       <div class="form-group" id="divBiller2"> </div>   
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputSubscriberName" placeholder="DONOR" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control"  name="inputAmount" placeholder="AMOUNT" required />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">SUBMIT</button>
                        </div>
                    </form>
                </div><!-- data type == 2 --> 

                <!-- data type == 4-->  
                <div class="utilities4" style="display: none;"> 
                    <form name="frmOthersLoading" action="<?php echo BASE_URL() ?>Bills_payment/others" method="post" id="frmOthersLoading">
                       <div class="form-group" id="divBiller4"> </div>   
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputAccountNumber" placeholder="PASSPORT NUMBER" required />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputSubscriberName" placeholder="FULLNAME" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control"  name="inputAmount" placeholder="AMOUNT" required />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">SUBMIT</button>
                        </div>
                    </form>
                </div><!-- data type == 4 -->  

                <!-- data type == 18-->  
                <div class="utilities18" style="display: none;"> 
                    <form name="frmOthersLoading" action="<?php echo BASE_URL() ?>Bills_payment/others" method="post" id="frmOthersLoading">
                       <div class="form-group" id="divBiller18"> </div>   
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputAccountNumber" placeholder="W PARTNER NUMBER" required />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputSubscriberName" placeholder="FULLNAME" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control"  name="inputAmount" placeholder="AMOUNT" required />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">SUBMIT</button>
                        </div>
                    </form>
                </div><!-- data type == 18 --> 

                <!-- data type == 21-->  
                <div class="utilities21" style="display: none;"> 
                    <form name="frmOthersLoading" action="<?php echo BASE_URL() ?>Bills_payment/others" method="post" id="frmOthersLoading">
                       <div class="form-group" id="divBiller21"> </div>   
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputAccountNumber" placeholder="REGCODE" required />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputSubscriberName" placeholder="SUBSCRIBER NAME" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control"  name="inputAmount" placeholder="AMOUNT" required />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">SUBMIT</button>
                        </div>
                    </form>
                </div><!-- data type == 21 --> 


                <!-- data type == 25-->  
                <div class="utilities25" style="display: none;" id="datatype25"> 
                    <form name="frmLoading" action="<?php echo BASE_URL() ?>Bills_payment/others" method="post" class="frmUtilitiesLoading" id="frmUtilitiesLoading">
                       <div class="form-group" id="divBiller25"> </div> 



                       <div class="form-group" id="divFullName">
                            <input type="text" class="form-control inputNameValidator inputFullName" name="inputSubscriberName" id="inputFullName" placeholder="FULL NAME" required/>
                        </div>
                       <div class="form-group" id="divDynamicBiller25"> </div>

                       <!-- <div class="form-group" style="display:none;" id="inputMobile1"> 
                            <input type="tel" class="inputNumberValidator form-control inputMobile11" id="inputMobile11" name="inputMobile" placeholder="CONTACT NUMBER"  required />
                        </div>  --> 
<!--                    <div class="form-group">
                            <input type="text" class="form-control" name="inputAccountNumber" placeholder="ACCOUNT NUMBER" required />
                        </div> -->
                        
                        <div class="form-group" id="divAcctName">
                            <input type="text" class="form-control inputNameValidator inputSubscriberName" name="inputSubscriberName" id="inputSubscriberName" placeholder="ACCOUNT / SUBSCRIBER NAME" required/>
                        </div>


                        <div class="form-group">
                        <input type="tel" class="inputNumberValidator form-control inputMobile11" id="inputMobile11" name="inputMobile" placeholder="CONTACT NUMBER (11-Digits)" minlength="11" maxlength="11" required/>
                        </div>

                        <div class="form-group" id="divDynamicBiller255"> </div>

                        <div class="form-group" id="DynamicBillerNumber25" style="display: none;"> </div>

                        <div class="form-group" id="DynamicDueDate25" style="display: none;"> 
                          <input type="text" class="form-control inputDueDate datetimepicker" name="inputDueDate" id="inputDueDate" placeholder="DUE DATE (mmddyyyy)" required />
                        </div>
                        <div class="form-group" id="DynamicCampus25" style="display: none;"> </div>

                        <div class="form-group" id="mobile"> 
                            <input type="tel" class="inputNumberValidator form-control inputMobile" name="inputMobile" id="inputMobile" placeholder="MOBILE NUMBER (11-Digits)" maxlength="11" minlength="11" required />
                        </div>
                        <div class="form-group" id="iamount">
                            <input type="text" class="form-control inputAmount" name="inputAmount" id="inputAmount" placeholder="AMOUNT" required />
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
                                      <p class="idAccountNo"> 
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
                                      <p class="idCampus" style="display: none;"> 
                                        <span> School Name : </span> <label id="idCampus"></label>
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

                                    <div class="form-group" id="idBiller_0">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:80px;">Biller Name :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idBiller" class="idBiller"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group" id="idAcctNo_0">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:9px;">Account/Reference No. :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idAcctNo" class="idAcctNo"></label></span>
                                        </div>
                                    </div>

                                    <div class="form-group idPaymentTypezz" id="idPaymentType_0" style="display: none;">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:9px;">Payment Type. :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idPaymentType" class="idPaymentType"></label></span>
                                        </div>
                                    </div>

                                    <div class="form-group" id="idAcctName_0">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:15px;">Account/Subscriber's Name :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idAcctName" class="idAcctName"></label></span>
                                        </div>
                                    </div>

                                    <div class="form-group idDueDate" style="display: none;" id="idDueDate_0">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:28px;">Due Date/ Bill Month :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idDueDate" class="idDueDate"></label></span>
                                        </div>
                                    </div>

                                    <div class="form-group idinputBranch" style="display: none;" id="idinputBranch_0">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:98px;">Branch :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idinputBranch" class="idinputBranch"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group idBillNo" style="display: none;" id="idBillNo_0">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:25px;">ATM Ref No./ Bill No. :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idBillNo" class="idBillNo"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group idCampus" style="display: none;" id="idCampus_0">
                                        <div class="input-group">
                                          <span class="input-group-addon DynamicCampus" id="basic-addon1" style="padding-right:73px;">School Name :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idCampus" class="idCampus"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group idloanref" style="display: none;" id="idloanref_0">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:98px;">Loan Reference :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idloanref" class="idloanref"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group" id="idMobNo_0">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:90px;">Mobile No. :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idMobNo" class="idMobNo"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group" id="Payor_0">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:75px;">Payor's Name:</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idPayor" class="idPayor"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group" id="idAmount_0">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:109px;">Amount:</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idAmount" class="idAmount"></label></span>
                                        </div>
                                    </div>

                                    <div class="form-group" id="inputTpass_0">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:20px;">Transaction Password :</span>
                                          <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                                        </div>
                                    </div>

                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btnSubmitutil" name="btnSubmit" value="1">Confirm</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                          </div>
                        </div>
                    </form>
                </div><!-- data type == 25 --> 


                <div class="utilities28" style="display: none;"> 
                    <form id="validateCheckdigit">
                       <div class="form-group" id="divBiller28"> </div>   
                       <div class="form-group" id="divDynamicBiller28"> </div>
                       <div class="form-group" id="divAccountNo28" style="display: none">
                       <input type="text" class="form-control inputNumberValidator" name="inputAccountxt1" id="inputAccountxt" value="ACCOUNT NUMBER (310 + 10-Digits)"  title="ACCOUNT NUMBER (310 + 10-Digits)" pattern="310[0-9]{10}" minlength="10" maxlength="10"/>
                       </div>
                       <div class="form-group" id="divDyanamicAccountNo28" style="display: none">
                          <input type="text" class="form-control inputNumberValidator" name="inputAccountxt2" id="inputAccountxt" placeholder="PN REFERENCE NUMBER (16-Digits)"  minlength="16" maxlength="16"/>
                       </div>
                        <div class="form-group" id="divAcctName28">
                            <input type="text" class="form-control inputNameValidator inputSubscriberName" name="inputSubscriberName" id="inputSubscriberName" placeholder="ACCOUNT/ SUBSCRIBER NAME" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control inputAmount" name="inputAmount" id="inputAmount" placeholder="AMOUNT" required />
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary btn-lg" id="btnValidate">Validate</button>
                        </div>
                    </form>

                    <form name="frmLoans" action="<?php echo BASE_URL() ?>Bills_payment/others" method="post" id="frmBuycodes">
                        <div id="myModal28" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Transaction Summary</h4>
                                  </div>
                                  <div class="modal-body">
                                    <div class="alert alert-info"><b>Please check your details and click "confirm button" to proceed transaction.</b></div>

                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:83px;">Biller Name :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idBiller" class="idBiller"></label>
                                            <input name="inputBiller" class="inputBiller" type="hidden"/>
                                          </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:7px;">Account/ Reference No. :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idAcctNo" class="idAcctNo"></label>
                                            <input name="inputAccountNumber" class="inputAccountNumber" type="hidden"/>
                                          </span>
                                        </div>
                                    </div>
                                    <div class="form-group" style="display:none;">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:9px;">Loan Payment :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idAcctNo" class="idAcctNo"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:65px;">Account Name :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idAcctName" class="idAcctName"></label>
                                            <input name="inputSubscriberName" class="inputSubscriberName" type="hidden"/>
                                          </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:79px;">Payor Name :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idPayor" class="idPayor"></label>
                                            <input name="selSem" class="selSem" type="hidden"/>
                                          </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:65px;">Payor Address :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idPayorAddress" class="idPayorAddress"></label>
                                            <input name="selCourse" class="selCourse" type="hidden"/>
                                          </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:90px;">Mobile No. :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idMobileNo" class="idMobileNo"></label>
                                            <input name="inputMobile" class="inputMobile" type="hidden"/>
                                          </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:109px;">Amount :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idAmount" class="idAmount"></label>
                                            <input name="inputAmount" class="inputAmount" type="hidden"/>
                                          </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:20px;">Transaction Password :</span>
                                          <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                                        </div>
                                    </div>

                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" name="btnSubmit">Confirm</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                          </div>
                        </div>
                    </form>
                </div>
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

                          </div>
                        </div>   
                    </div><!-- col-md-9 -->

                </div>
            </div>
        </div><!-- row -->
    </div><!-- contentpanel -->              
</div><!-- mainpanel -->            

<script src="<?php echo BASE_URL()?>assets/js/jquery-2.1.4.min.js"></script>
<script>
  $(document).ready(function(){
    $(".readonly").on('keydown paste focus mousedown', function(e){
        if(e.keyCode != 9) // ignore tab
            e.preventDefault();
    });
     
    $('.btn_ModalSubmit').click(function() {
        $('.idMobileNo').hide();
      var biller = $('#selBiller option:selected').data('name');
      var billerNo = $('#selBiller option:selected').val();
      var acctNo = $("#inputAccountNumber").val();
      var acctName = $("#inputSubscriberName").val();
      var amount = $("#inputAmount").val();
      var mobNo = $("#inputMobile").val();




    
      if(billerNo == 168 && amount<150){
        alert('Input Amount more than or equal to Php 150.00');
        $('#myModal1').modal('hide');
        $('#inputAmount').css('border','1px solid red');
      } else {
        $('#myModal1').modal('show');
        $('#inputAmount').css('border','1px solid #ccc');
      }

      if(mobNo != ''){
        $('.idMobileNo').show();
      }

      $('#myModal1 #idBiller').html(biller);
      $('#myModal1 #idAcctNo').html(acctNo);
      $('#myModal1 #idAcctName').html(acctName);
      $('#myModal1 #idAmount').html(amount);
      $('#myModal1 #idMobNo').html(mobNo);       
     
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
      $("#selSem").val('');
      $("#selCourse").val('');
      $("#inputMobile").val('');
      $("#inputFullName").val('');

    });

    $('.btn_Modal25Submit').click(function() {


      var biller = $('#selBiller option:selected').data('name');
      var billerNo = $('#selBiller option:selected').val();
      var acctNo = $("#inputAccountNumber").val();

if(billerNo == '414' || billerNo == '415' || billerNo == '416' || billerNo == '417'){var acctName = $("#inputFullName").val();}else{var acctName = $(".inputSubscriberName").val();}

      
      var amount = $(".inputAmount").val();
      var mobNo = $(".inputMobile").val();
      var refno = $("#inputBillerNo").val();
      var duedate = $("#inputDueDate").val();
      var inputCampus = $("#inputCampus").val();
      var inputBranch = $("#inputBranch").val();
      var inputType = $("#inputType option:selected").text();

      var LoanReference = $("#LoanReference").val();
      var inputAccount = $("#inputAccount").val();

      var inputFName = $("#inputFName").val();
      var inputLName = $("#inputLName").val();

      if(billerNo == '677'){
      $("#Payor_0").show();

      var acctName = $(".inputSubscriberName").val();
      var amount = $(".inputAmount").val();
      var mobNo = $(".inputMobile11").val();
      var payor = $("#inputPayorName").val();

      
      $('#myModal25 .idBiller').html(biller);
      $('#myModal25 .idAcctNo').html(acctNo);
      $('#myModal25 .idAcctName').html(acctName);
      $('#myModal25 .idAmount').html(amount);
      $('#myModal25 .idPayor').html(payor);
      $('#myModal25 .idMobNo').html(mobNo);   
      }else{
        $("#Payor_0").show();
      }



      if(((inputFName != '' || inputFName != null) && inputFName != undefined) && ((inputLName != '' || inputLName != null) && inputLName != undefined) && billerNo == 413)
      {
        acctName = inputFName.toUpperCase()+' '+inputLName.toUpperCase();
        $("#inputSubscriberName").val(acctName.toUpperCase());
      }

      if((inputFName != '' && inputFName != null && inputFName != undefined) && (inputLName != '' && inputLName != null && inputLName != undefined) && (billerNo == 415 || billerNo == 416 || billerNo == 417 || billerNo == 470 || billerNo == 499))
      {
        acctName = inputFName.toUpperCase()+', '+inputLName.toUpperCase();
        $("#inputSubscriberName").val(acctName.toUpperCase());
      }

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
      
      if(inputCampus != '' && inputCampus != undefined){
        // alert(inputCampus);
        $('.idCampus').show();
        $('#myModal25 #idCampus').html(inputCampus); 
      }

      if(inputCampus != '' && inputCampus != undefined && billerNo == 472){
        // alert(inputCampus);
        $('.idCampus').show();
        $('#myModal25 .DynamicCampus').html('TSPI Branch Code:'); 
        $('#myModal25 #idCampus').html(inputCampus); 
      }else{
                $('.idCampus').hide();
      }

      if(inputCampus != '' && inputCampus != undefined && billerNo == 422){
        // alert(inputCampus);
        $('.idCampus').show();
        $('#myModal25 .DynamicCampus').html('LOAN CODE:'); 
        $('#myModal25 #idCampus').html(inputCampus); 
        $("#myModal25 .DynamicCampus").attr('style','padding-right:79px;');
      }

    if(LoanReference != '' && LoanReference != undefined && billerNo == 422){
        // alert(inputCampus);
        $('.idloanref').show();
        $('#myModal25 #idloanref').html(LoanReference); 
      }

    if(inputBranch != '' && inputBranch != undefined){
        // alert(inputCampus);
        $('.idinputBranch').show();

        $('#myModal25 #idinputBranch').html(inputBranch); 
      }
      
      if(billerNo == '353') {
        $(".idAccountNo").css('display','none');
      }

      if(billerNo == '483') {

        $(".inputMobile").val(acctNo);
        $(".idMobNo").css('display','none');

      }

      if(billerNo == '649' || billerNo == '305') {

        $('#divFullName').remove();
        $('#inputFullName').remove();

        $(".inputMobile").val(acctNo);
        $(".idMobNo").html(mobNo);

      }

    if(billerNo == '470') {

        $('#inputSubscriberName').remove();

      }

      if(billerNo == '406' || billerNo =='404') {

        $(".idPaymentTypezz").show();

      }else{        $(".idPaymentTypezz").hide();}

      // if(billerNo == 371 && (amount<150 || amount=='.' || amount==',')){
      //   alert('Please input valid Amount more than or equal to Php 150.00');
      //   $('#myModal25').modal('hide');
      //   $('.inputAmount').css('border','1px solid red');
      // } else {
      //   $('#myModal25').modal('show');
      //   $('.inputAmount').css('border','1px solid #ccc');
      // }

      if(billerNo == 410)
      {
        $(".inputSubscriberName").val(inputAccount);
        acctName = inputAccount;
        
      }  

      if(billerNo == 356 || billerNo == 352 || billerNo == 501 || billerNo == 525 || billerNo == 527 || billerNo == 528 || billerNo == 529)
      {
        $('.idBillNo').show();
        $('#myModal25 .idBillNoDynamic').html('Account:'); 
        $(".idBillNoDynamic").attr('style','padding-right:110px;');
        $('#myModal25 #idBillNo').html(inputAccount); 
      }     

      if(billerNo == 646)
      {
      var acctName = $(".inputSubscriberName").val();
      var amount = $(".inputAmount").val();
      var mobNo = $(".inputMobile").val();
      
      
      $('#myModal25 .idBiller').html(biller);
      $('#myModal25 .idAcctNo').html(acctNo);
      $('#myModal25 .idAcctName').html(acctName);
      $('#myModal25 .idMobNo').html(mobNo);

      $('#myModal25 .idAmount').html(amount);
         
      }  


      
      $('#myModal25 .idBiller').html(biller);
      $('#myModal25 .idAcctNo').html(acctNo);
      $('#myModal25 .idAcctName').html(acctName);
      $('#myModal25 .idAmount').html(amount);
      $('#myModal25 .idMobNo').html(mobNo);   
      $('#myModal25 .idPaymentType').html(inputType);    
    });


    $('#selBiller').on('change', function() {   
        var billerNo = $('#selBiller option:selected').val();
        // alert(billerNo);
        if(billerNo == '353') {
            $("#divAcctName input").attr("placeholder", "RIDER NAME").val("").focus().blur();
        } 
    });

    $(".inputAmount").on("input", function() {
        var billerNo = $('#selBiller option:selected').val(); 
        var amount = this.value;
        // alert(billerNo);
        if(billerNo == 371 && amount>=150){
            // alert(amount);
            $('.inputAmount').css('border','1px solid #ccc');
        } 
        if(billerNo == 371 && amount<150){
            $('.inputAmount').css('border','1px solid red');
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



    $('#datatype25').on('keyup', '.TSPIinputAccountNumber', function(ev){

            var val = this.value.replace(/\D/g, '');
            var newVal = '';
            if (val.length > 3) {
              newVal += val.substr(0, 3) + '/';
              val = val.substr(3);
            }
            newVal += val;
            this.value = newVal;

    });

        $('#datatype25').on('keyup', '.inputAccountNumberPower', function(ev){

            var val = this.value.replace(/\D/g, '');
            var newVal = '';
            if (val.length > 8) {
              newVal += val.substr(0, 8) + '-';
              val = val.substr(8);
            }
            newVal += val;
            this.value = newVal;

    });
        

    
  });
</script>

<script src="<?php echo BASE_URL()?>assets/js/billspayment.js"></script>
<!-- <script type="text/javascript">
      window.onload = function() {
     MaskedInput({
        elm: document.getElementById('inputAccountxt'), // select only by id
        format: '310xxxxxxxxxx',
        separator: '310'
     });
  };          
</script> -->
<script>
  function setCursor(node,pos){

      var node = (typeof node == "string" || node instanceof String) ? document.getElementById(node) : node;

      if(!node){
          return false;
      }else if(node.createTextRange){
          var textRange = node.createTextRange();
          textRange.collapse(true);
          textRange.moveStart('character', pos);
          textRange.moveEnd('character', 0);
          textRange.select();

          return true;
      }else if(node.setSelectionRange){
          node.setSelectionRange(pos,pos);
          return true;
      }

      return false;
  }
    $(document).ready(function(){
        $("#inputAccountxt").focus(function(){
            if( this.value == this.defaultValue ) {
            $(this).val("310");

            var node = $(this).get(0);
            setCursor(node,node.value.length);
        }
        });
    });

</script> 