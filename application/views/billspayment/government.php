<style>
.datepicker_calendar {
    display: none;
    }
        .ui-datepicker-calendar {
        display: none;
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
                    <li>BILLS PAYMENT</li>
                </ul>
                <h4>GOVERNMENT </h4>
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
                        &nbsp;&nbsp;<small>Click transaction number to download reciept.</small>
                    </div>
                <?php endif ?>
                <div class="form-group">
                    <select class="form-control" name="selBiller" id="selBiller">
                        <option value="" disabled selected>CHOOSE GOVERNMENT BILLER</option>  
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
                  <form name="frmGovernmentLoading" action="<?php echo BASE_URL() ?>Bills_payment/government" method="post" id="frmGovernmentLoading">
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
                <div class="utilities1" style="display: none;"> 
                    <form name="frmGovernmentLoading" action="<?php echo BASE_URL() ?>Bills_payment/government" method="post" id="frmGovernmentLoading">
                        <div class="form-group" id="divBiller1"> </div>
                        <div class="form-group" id="divDynamicBiller"> </div>  
                        <!-- <div class="form-group">
                            <input type="text" class="form-control" name="inputAccountNumber" placeholder="ACCOUNT NUMBER" required />
                        </div> -->
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputSubscriberName" placeholder="SUBSCRIBER NAME" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control inputAmount" name="inputAmount" id="inputAmounts" placeholder="AMOUNT" required />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">SUBMIT</button>
                        </div>
                    </form>
                </div><!-- data type == 1 --> 

                <!-- data type == 15 -->  
                <div class="utilities15" style="display: none;"> 
                    <form name="frmGovernmentLoading" action="<?php echo BASE_URL() ?>Bills_payment/government" method="post" id="frmGovernmentLoading">
                        <div class="form-group" id="divBiller15"> </div>   
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputAccountNumber" placeholder="SSS MEMBER NUMBER" required />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputSubscriberName" placeholder="SUBSCRIBER NAME" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control inputAmount"  name="inputAmount" id="inputAmounts" placeholder="AMOUNT" required />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">SUBMIT</button>
                        </div>
                    </form>
                </div><!-- data type == 15 --> 
                    <!-- data type == Philhealth ID Number -->  
                <div class="utilities24" style="display:none"> 
                    <form name="frmGovernmentLoading" action="<?php echo BASE_URL() ?>Bills_payment/government" method="post" id="frmGovernmentLoading">
                        <div class="form-group" id="divBiller24"> </div>   
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputAccountNumber" placeholder="Philhealth ID Number" pattern="^\d{12}$" maxlength="12" title="12 numeric characters only" required />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputFirstName" placeholder="Firstname" maxlength="25" pattern="[a-zA-Z][a-zA-Z\s]*"  title="Invalid Character use letter's only" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputMiddleName" placeholder="Middlename" maxlength="25"  pattern="[a-zA-Z][a-zA-Z\s]*"  title="Invalid Character use letter's only" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputLastName" placeholder="Lastname" maxlength="25"  pattern="[a-zA-Z][a-zA-Z\s]*"  title="Invalid Character use letter's only" required/>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon3">Birthday</span>
                                <input type="date" class="form-control" name="bdate" placeholder="Birthday" required/>   
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Amount</span>
                                <input type="number" class="form-control inputAmount"  name="inputAmount" id="inputAmount" placeholder="Amount Paid" value='2500.00' required readonly />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Applicable Period From</span>
                                <input type="date" class="form-control"  id="periodFrom" name="inputFrom" placeholder="Applicable Period From" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Applicable Period To</span>
                                <input type="date" class="form-control"  name="inputTo" id="inputTo" placeholder="Applicable Period To" required readonly />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Years Covered</span>
                                <input type="text" class="form-control"  name="inputCovered" placeholder="Years Covered" value ='1 Year' required readonly />
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">SUBMIT</button>
                        </div>
                    </form>
                </div><!-- data type == Philhealth ID Number --> 

                <!-- data type == 25-->  
                <div class="utilities25" style="display: none;" id="datatype25"> 
                    <form name="frmUtilitiesLoading" action="<?php echo BASE_URL() ?>Bills_payment/government" method="post" class="frmUtilitiesLoading" id="frmUtilitiesLoading">
                        <div class="form-group" id="divBiller25"> </div>   
                        <div class="form-group" id="divDynamicBiller25"> </div>
                        <!-- <div class="form-group">
                            <input type="text" class="form-control" name="inputAccountNumber" placeholder="ACCOUNT NUMBER" required />
                        </div> -->
                        <div class="form-group divDynamicBillerDate25" id="divDynamicBillerDate25" style="display: none;">
                            <div class="input-group" id="periodcoveredfrom">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right:5px;">PERIOD COVERED FROM:</span>
                                <input type="text" class="form-control periodcovered" id="inputCoveredFrom" name="inputCoveredFrom" placeholder="YYYYMM" readonly required>
                            </div>
                            <div class="input-group" id="periodcoveredto">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right:27px;">PERIOD COVERED TO:</span>
                                <input type="text" class="form-control periodcovered" id="inputCoveredTo" name="inputCoveredTo" placeholder="YYYYMM" readonly required>
                            </div>
                        </div>
                        <div class="form-group divDynamicBillerBIR" id="divDynamicBillerBIR" >
                            <select class="form-control" name="formseries" id="formseries">
                                <option value="" disabled selected>-- SELECT FORM SERIES --</option>  
                                <option value="0600 (Payment Form)" >0600 (Payment Form)</option>  
                                <option value="1600 (Payment Form)" >1600 (Payment Form)</option>  
                                <option value="1700 (Income Tax Return)" >1700 (Income Tax Return)</option>  
                                <option value="1800 (Transfer Tax Return)" >1800 (Transfer Tax Return)</option>  
                                <option value="2000 (DST Return)" >2000 (DST Return)</option>  
                                <option value="2200 (Excise Tax Return)" >2200 (Excise Tax Return)</option>  
                                <option value="2500 (Percentage Tax and VAT)" >2500 (Percentage Tax and VAT)</option>  
                            </select>
                            <select class="form-control formtype" name="formtype" id="formtype" readonly>
                                <option value="" disabled selected>--SELECT FORM NUMBER--</option>
                            </select>
                            <select class="form-control taxtype" name="taxtype" id="taxtype" readonly>
                                <option value="" disabled selected>--SELECT TAX TYPE--</option>
                            </select>
                            <div class="input-group" id="inputReturnPeriod_1">
                                <span class="input-group-addon" id="basic-addon1"  style="padding-right:27px;">Return Period:</span>
                                <input type="text" class="form-control inputReturnPeriod" id="inputReturnPeriod1" name="inputReturnPeriod" placeholder="MMDDYY" readonly required>
                            </div>
                            <input type="text" class="form-control inputTPBC" name="inputTPBC" id="inputTPBC1" placeholder="ENTER TAX PAYER'S BRANCH CODE (5 digits)" minlength="5" maxlength="5" />
                        </div>
                        <div class="form-group formseries_1" id="formseries_1">
                            <!-- <input type="text" class="form-control datetimepicker" name="inputGracePeriod" placeholder="BILL PERIOD" /> -->
                            <div class = "form-inline">
                                <select class="form-control formseries" style="min-width: 223px;" name="formseries2" id="formseries1" required>
                                    <option value = "">Payment Entries</option>
                                    <option value="F1">Folio I</option>
                                    <option value="F2">Folio II</option>
                                    <option value="PEA">PEA</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group formseries_1" id="formseries_2">
                            <input type="text" class="form-control inputNameValidator formseries" name="formseries_1" id="paymentformseries" placeholder="PAYMENT ENTRIES" required/>
                        </div> 
                        <div class="form-group borrowersName_1" id="borrowersName_1">
                            <input type="text" class="form-control inputNameValidator borrowersName" name="inputSubscriberName_1" id="borrowersName" placeholder="BORROWERS NAME" required/>
                        </div>
                        <div class="form-group inputTPBC_1" id="inputTPBC_1">
                            <input type="text" class="form-control inputNameValidator inputTPBCs" name="inputTPBC_1" id="inputTPBCs" placeholder="PAYOR NAME" required/>
                        </div>
                        <div class="form-group" id="inputSubscriberName1">
                            <input type="text" class="form-control inputNameValidator inputSubscriberName" name="inputSubscriberName" id="inputSubscriberName1" placeholder="ACCOUNT NAME" required/>
                        </div>
                        <div class="form-group" id="DynamicBillerNumber25" style="display: none;"> </div>
                        <div class="form-group" id="DynamicDueDate25" style="display: none;"> 
                            <input type="text" class="form-control inputDueDate datetimepicker" name="inputDueDate" id="inputDueDate" placeholder="DUE DATE (mmddyyyy)" required />
                        </div>
                        <div class="form-group" id="DynamicBillDate25" style="display: none;"> 
                            <input type="text" class="form-control datetimepicker" name="inputBillDate" id="inputBillDate" placeholder="BILL DATE" required />
                        </div>
                        <div class="form-group" id="DynamicPeriodFrom25" style="display: none;"> 
                            <input type="text" class="form-control datetimepicker" name="inputPeriodFrom" id="inputPeriodFrom" placeholder="Period From" required />
                        </div>
                        <div class="form-group" id="DynamicPeriodTo25" style="display: none;"> 
                            <input type="text" class="form-control datetimepicker" name="inputPeriodTo" id="inputPeriodTo" placeholder="Period To" required />
                        </div>
                        <div class="form-group divDynamicAPECBiller25" id="divDynamicAPECBiller25">
                            <input type="text" class="form-control APECBiller formtype" id="formtype1" name="formtype_1" placeholder="INVOICE NUMBER (2-30 digits)" minlength="2" maxlength="30" required>
                            <div class="input-group" id="taxtype_1">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right:60px;">Bill Year:</span>
                                <input type="text" class="form-control APECBiller taxtype inputYear" id="taxtype1" name="taxtype_1" placeholder="BILL YEAR (yyyy)" readonly required>
                            </div>
                            <div class="input-group" id="billmonth_1">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right:49px;">Bill Month:</span>
                                <input type="text" class="form-control APECBiller formseries inputMonth" id="billmonth" name="formseries_2" placeholder="BILL MONTH (MM)" readonly required>
                            </div>
                            <div class="input-group" id="inputReturnPeriod_1">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right:27px;">Delivery Date:</span>
                                <input type="text" class="form-control APECBiller delivery_date" id="inputReturnPeriod" name="inputReturnPeriod" placeholder="DELIVERY DATE (yyyy-MM-dd)" readonly required>
                            </div>
                        </div>
                        <div class="form-group" id="inputMobile_1"> 
                            <input type="tel" class="inputNumberValidator form-control inputMobile" name="inputMobile" id="inputMobile" placeholder="MOBILE NUMBER (11-Digits)" minlength="11" maxlength="11" required />
                        </div>
                        <div class="form-group" id="inputAmount_1">
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
                                        <div class="form-group mainAcctNo">
                                            <div class="input-group">
                                                <span class="input-group-addon DynamicAccountNumber" id="basic-addon1" style="padding-right:7px;">Account/ Reference No. :</span>
                                                <span class="form-control" id="basic-addon2" style=""><label id="idAcctNo" class="idAcctNo"></label></span>
                                            </div>
                                        </div>
                                        <div class="form-group philAcctNo" style="display: none;">
                                            <div class="input-group">
                                                <span class="input-group-addon DynamicAccountNumber" id="basic-addon1" style="padding-right:7px;">Philhealth Identification Number</span>
                                                <span class="form-control" id="basic-addon2" style=""><label id="idAcctNo" class="idAcctNo"></label></span>
                                            </div>
                                        </div>
                                        <div class="form-group paymentModal">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1" style="padding-right:7px;">Payment Entries :</span>
                                                <span class="form-control" id="basic-addon2" style=""><label id="paymentModal_1" class="paymentModal_1"></label></span>
                                            </div>
                                        </div>
                                        <div class="form-group mainAcctName">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1" style="padding-right:65px;">Account Name :</span>
                                                <span class="form-control" id="basic-addon2" style=""><label id="idAcctName" class="idAcctName"></label></span>
                                            </div>
                                        </div>
                                        <div class="form-group paymentType_1" style="display: none;">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1" style="padding-right:7px;">Payment Type :</span>
                                                <span class="form-control" id="basic-addon2" style=""><label id="paymentType" class="paymentType"></label></span>
                                            </div>
                                        </div>
                                        <div class="form-group memberType_1" style="display: none;">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1" style="padding-right:7px;">Member Type :</span>
                                                <span class="form-control" id="basic-addon2" style=""><label id="memberType" class="memberType"></label></span>
                                            </div>
                                        </div>
                                        <div class="form-group spaNumber_1" style="display: none;">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1" style="padding-right:7px;">SPA Number :</span>
                                                <span class="form-control" id="basic-addon2" style=""><label id="spaNumber" class="spaNumber"></label></span>
                                            </div>
                                        </div>
                                        <div class="form-group paymentPayor">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1" style="padding-right:7px;">Payor Name :</span>
                                                <span class="form-control" id="basic-addon2" style=""><label id="paymentPayor_1" class="paymentPayor_1"></label></span>
                                            </div>
                                        </div>
                                        <div class="form-group idViolation" style="display: none;">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1" style="padding-right:66px;">Violation Code :</span>
                                                <span class="form-control" id="basic-addon2" style=""><label id="idViolation" class="idViolation"></label></span>
                                            </div>
                                        </div>
                                        <div class="form-group idClearance" style="display: none;">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1" style="padding-right:65px;">Clearance Fee :</span>
                                                <span class="form-control" id="basic-addon2" style=""><label id="idClearance" class="idClearance"></label></span>
                                            </div>
                                        </div>
                                        <div class="form-group idformseries" style="display: none;">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1" style="padding-right:80px;">Form Series :</span>
                                                <span class="form-control" id="basic-addon2" style=""><label id="idformseries" class="idformseries"></label></span>
                                            </div>
                                        </div>
                                        <div class="form-group idformtype" style="display: none;">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1" style="padding-right:90px;">Form Type :</span>
                                                <span class="form-control" id="basic-addon2" style=""><label id="idformtype" class="idformtype"></label></span>
                                            </div>
                                        </div>
                                        <div class="form-group idtaxtype" style="display: none;">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1" style="padding-right:101px;">Tax Type :</span>
                                                <span class="form-control" id="basic-addon2" style=""><label id="idtaxtype" class="idtaxtype"></label></span>
                                            </div>
                                        </div>
                                        <div class="form-group idbireturnperiod" style="display: none;">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1" style="padding-right:70px;">Return Period :</span>
                                                <span class="form-control" id="basic-addon2" style=""><label id="idbireturnperiod" class="idbireturnperiod"></label></span>
                                            </div>
                                        </div>
                                        <div class="form-group idbirtpbc" style="display: none;">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1" style="padding-right:2px;">Tax Payer's Branch Code :</span>
                                                <span class="form-control" id="basic-addon2" style=""><label id="idbirtpbc" class="idbirtpbc"></label></span>
                                            </div>
                                        </div>
                                        <div class="form-group idDueDate" style="display: none;">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1" style="padding-right:28px;">Due Date/ Bill Month :</span>
                                                <span class="form-control" id="basic-addon2" style=""><label id="idDueDate" class="idDueDate"></label></span>
                                            </div>
                                        </div>
                                        <div class="form-group idDue_1" style="display: none;">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1" style="padding-right:28px;">Due Date :</span>
                                                <span class="form-control" id="basic-addon2" style=""><label id="idDue" class="idDue"></label></span>
                                            </div>
                                        </div>
                                        <div class="form-group idBill_1" style="display: none;">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1" style="padding-right:28px;">Bill Date :</span>
                                                <span class="form-control" id="basic-addon2" style=""><label id="idBill" class="idBill"></label></span>
                                            </div>
                                        </div>
                                        <div class="form-group idCoveredFrom" style="display: none;">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1" style="padding-right:38px;">Period Cover From :</span>
                                                <span class="form-control" id="basic-addon2" style=""><label id="idCoveredFrom" class="idCoveredFrom"></label></span>
                                            </div>
                                        </div>
                                        <div class="form-group idCoveredTo" style="display: none;">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1" style="padding-right:56px;">Period Cover To :</span>
                                                <span class="form-control" id="basic-addon2" style=""><label id="idCoveredTo" class="idCoveredTo"></label></span>
                                            </div>
                                        </div>
                                        <div class="form-group idBillNo" style="display: none;">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1" style="padding-right:25px;">ATM Ref No./ Bill No. :</span>
                                                <span class="form-control" id="basic-addon2" style=""><label id="idBillNo" class="idBillNo"></label></span>
                                            </div>
                                        </div>
                                        <div class="form-group idSOA" style="display: none;">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1" style="padding-right:87px;">SOA CODE:</span>
                                                <span class="form-control" id="basic-addon2" style=""><label id="idSOA" class="idSOA"></label></span>
                                            </div>
                                        </div>
                                        <div class="form-group idInvoice" style="display: none;">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1" style="padding-right:63px;">Invoice Number:</span>
                                                <span class="form-control iv" id="basic-addon2" style=""><label id="idInvoice" class="idInvoice"></label></span>
                                            </div>
                                        </div>
                                        <div class="form-group idBillYear" style="display: none;">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1" style="padding-right:109px;">Bill Year:</span>
                                                <span class="form-control" id="basic-addon2" style=""><label id="idBillYear" class="idBillYear"></label></span>
                                            </div>
                                        </div>
                                        <div class="form-group idBillMonth" style="display: none;">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1" style="padding-right:98px;">Bill Month:</span>
                                                <span class="form-control" id="basic-addon2" style=""><label id="idBillMonth" class="idBillMonth"></label></span>
                                            </div>
                                        </div>
                                        <div class="form-group idDeliveryDate" style="display: none;">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1" style="padding-right:76px;">Delivery Date:</span>
                                                <span class="form-control" id="basic-addon2" style=""><label id="idDeliveryDate" class="idDeliveryDate"></label></span>
                                            </div>
                                        </div>
                                        <div class="form-group idPeriodFrom_1" style="display: none;">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1" style="padding-right:76px;">Period From:</span>
                                                <span class="form-control" id="basic-addon2" style=""><label id="idPeriodFrom" class="idPeriodFrom"></label></span>
                                            </div>
                                        </div>
                                        <div class="form-group idPeriodTo_1" style="display: none;">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1" style="padding-right:76px;">Period To:</span>
                                                <span class="form-control" id="basic-addon2" style=""><label id="idPeriodTo" class="idPeriodTo"></label></span>
                                            </div>
                                        </div>
                                        <div class="form-group idMobileNo">
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
                </div><!-- data type == 25 --> 
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

<script src="<?php echo BASE_URL()?>assets/js/jquery-2.1.4.min.js"></script>
<!-- <script src="<?php echo BASE_URL()?>assets/js/bootstrap-datepicker.js"></script>
<script src="<?php echo BASE_URL()?>assets/js/jquery.datetimepicker.full.js"></script> -->
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
        $(".inputCoveredFrom").val('');
        $(".inputCoveredTo").val('');
        $(".formseries").val('');
        $(".formtype").val('');
        $(".taxtype").val('');

        $('#myModal25 #idBillNo').html(''); 
        $('#myModal25 #idDueDate').html(''); 
        $('#myModal25 #idCoveredFrom').html(''); 
        $('#myModal25 #idCoveredTo').html(''); 
        $('#myModal25 .idBiller').html('');
        $('#myModal25 .idAcctNo').html('');
        $('#myModal25 .idAcctName').html('');
        $('#myModal25 .idAmount').html('');
        $('#myModal25 .idMobNo').html('');  

        $('.idCoveredFrom').hide();
        $('.idCoveredTo').hide();
        $('.idformseries').hide();
        $('.idformtype').hide();
        $('.idtaxtype').hide();
        $('.idbireturnperiod').hide();
        $('.idbirtpbc').hide();
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
        var coveredfrom = $("#inputCoveredFrom").val();
        var coveredto = $("#inputCoveredTo").val();
        var formseries = $("#formseries").val();
        var formtype = $("#formtype").val();
        var taxtype = $("#taxtype").val();
        var returnperiod = $("#inputReturnPeriod").val();
        var tpbc = $("#inputTPBC").val();
        var clearancefee = '';
        var billmonth = $("#frmUtilitiesLoading .formseries").val();
        var invoice = $("#frmUtilitiesLoading .formtype").val();
        var billyear = $("#frmUtilitiesLoading .taxtype").val();
        var delivery_date = $("#frmUtilitiesLoading .delivery_date").val();
        var SOA = $("#frmUtilitiesLoading #inputTPBC").val();
        var fname = $("#inputFirstName").val();
        var mname = $("#inputMiddleName").val();
        var lname = $("#inputLastName").val();
        var payType = $("#inputPaymentType").val();
        var periodFrom = $("#inputPeriodFrom").val();
        var periodTo = $("#inputPeriodTo").val();
        var billdate = $("#inputBillDate").val();
        var memType = $("#inputMemberType").val();
        var spaType = $("#inputSpaNum").val();

        $('.paymentModal').hide();
        $('.paymentPayor').hide();
        $('.mainAcctNo').show();
        $('.idViolation').hide();
        $('.idClearance').hide();
        // $('#inputTPBC').hide();
        // $('#formseries').hide();

        if(billerNo == '660'){
            var formseries = $(".formseries").val();
            var inputTPBCs = $("#inputTPBCs").val();
            var acctName = $(".borrowersName").val();
            $('.paymentModal').show();
            $('.paymentPayor').show();
            $('.paymentModal_1').html(formseries);
            $('.paymentPayor_1').html(inputTPBCs);
        }
        if(billerNo == '461')
        { 
            var tpbcs = $("#inputTPBC1").val();
            $(".DynamicAccountNumber").html('TIN Number:');
            // style="padding-right:7px;"
            $(".DynamicAccountNumber").attr('style','padding-right:85px;');
            $('.idformseries').show();
            $('.idformtype').show();
            $('.idtaxtype').show();
            $('.idbireturnperiod').show();
            $('.idbirtpbc').show();

            $('#myModal25 #idformseries').html(formseries);
            $('#myModal25 #idformtype').html(formtype);
            $('#myModal25 #idtaxtype').html(taxtype);
            $('#myModal25 #idbireturnperiod').html($("#inputReturnPeriod1").val());
            $('#myModal25 #idbirtpbc').html(tpbcs);
        }
        // $('.divDynamicAPECBiller25').hide();
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
        if(coveredfrom != '' && coveredfrom != undefined && coveredto != '' && coveredto != undefined){
            // alert(duedate);
            $('.idCoveredFrom').show();
            $('.idCoveredTo').show();
            $('#myModal25 #idCoveredFrom').html(coveredfrom); 
            $('#myModal25 #idCoveredTo').html(coveredto); 
        }
        else
        {
            $('.idCoveredFrom').hide();
            $('.idCoveredTo').hide();
            $("#idCoveredFrom").html('');
            $("#idCoveredTo").html('');
        }
        if(billerNo == '635')
        {
            $('.idViolation').show();
            $('.idClearance').show();
            $('#inputTPBC').show();
            $('#formseries').show();
                if(formseries == 0) {
                    clearancefee = 'for 30 pesos additional fee';
                } else {
                    clearancefee = 'no clearance fee';
                }
            $('#myModal25 #idViolation').html(acctNo); 
            $('#myModal25 #idClearance').html(clearancefee); 
        }

        if(billerNo == '613')
        {
            $('.divDynamicAPECBiller25').show();
            // $('#formseries').show();
            // $('#formtype').show();
            // $('#taxtype').show();
            $(".iv").html($("#formtype1").val());
            $('#inputReturnPeriod').show();
            $('#inputTPBC').show();
            $('.idSOA').show();
            $('.idInvoice').show();
            $('.idBillYear').show();
            $('.idDeliveryDate').show();
            $('.idBillMonth').show(); 
            $('#myModal25 #idSOA').html(SOA);
            $('#myModal25 #idInvoice').html(invoice);
            $('#myModal25 #idBillYear').html($("#taxtype1").val());
            $('#myModal25 #idDeliveryDate').html(delivery_date);
            $('#myModal25 #idBillMonth').html(billmonth);
        }
        
        $('#myModal25 .idBiller').html(biller);
        $('#myModal25 .idAcctNo').html(acctNo);
        $('#myModal25 .idAcctName').html(acctName);
        $('#myModal25 .idAmount').html(amount);
        $('#myModal25 .idMobNo').html(mobNo); 

        if(billerNo == 'CHANGE TO BILLERNO OF PHILIPPINE HEALTH'){
            $('.mainAcctNo').hide(); 
            $('.philAcctNo').show(); 
            $('.mainAcctName').show(); 
            $('.idMobileNo').hide(); 
            $('.idPeriodFrom_1').hide(); 
            $('.idPeriodTo_1').hide(); 
            $('.paymentType_1').show();
            $('.memberType_1').show();
            $('.idDue_1').show();
            $('.idBill_1').show();
            $('.spaNumber_1').show();
            $('.idDueDate').hide();
            $('#myModal25 .idAcctName').html(fname + ' ' + mname + ' ' + lname);
            $('#myModal25 .paymentType').html(payType);
            $('#myModal25 .idDue').html(duedate);
            $('#myModal25 .idBill').html(billdate);
            $('#myModal25 .memberType').html(memType);
            $('#myModal25 .spaNumber').html(spaType);
        }
        if(billerNo == 'CHANGE TO BILLERNO OF PHILIPPINE OVERSEAS'){
            $('.mainAcctNo').show(); 
            $('.philAcctNo').hide(); 
            $('.mainAcctName').show(); 
            $('.idMobileNo').show(); 
            $('.idPeriodFrom_1').hide(); 
            $('.idPeriodTo_1').hide(); 
            $('.paymentType_1').hide();
            $('.memberType_1').hide();
            $('.idDue_1').hide();
            $('.idBill_1').hide();
            $('.spaNumber_1').hide();
            $('.idDueDate').hide();
            $('#myModal25 .idAcctName').html(fname + ' ' + mname + ' ' + lname);
        }
        if(billerNo == 'CHANGE TO BILLERNO OF PAG-IBIG ( HMDF ) '){
            $('.mainAcctNo').show(); 
            $('.philAcctNo').hide(); 
            $('.mainAcctName').hide(); 
            $('.idMobileNo').show(); 
            $('.idPeriodFrom_1').show(); 
            $('.idPeriodTo_1').show(); 
            $('.paymentType_1').show();
            $('.memberType_1').hide();
            $('.idDue_1').hide();
            $('.idBill_1').hide();
            $('.spaNumber_1').hide();
            $('.idDueDate').hide();
            $('#myModal25 .paymentType').html(payType);
            $('#myModal25 .idPeriodFrom').html(periodFrom);
            $('#myModal25 .idPeriodTo').html(periodTo);
        }
        if(billerNo == 'CHANGE TO BILLERNO OF PILIPINAS TELESERVE'){
            $('.mainAcctNo').show(); 
            $('.philAcctNo').hide(); 
            $('.mainAcctName').show(); 
            $('.idMobileNo').hide(); 
            $('.idPeriodFrom_1').hide(); 
            $('.idPeriodTo_1').hide(); 
            $('.paymentType_1').hide();
            $('.memberType_1').hide();
            $('.idDue_1').hide();
            $('.idBill_1').hide();
            $('.spaNumber_1').hide();
            $('.idDueDate').hide();
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

    $("#formtype").click(function() {
        var formseries = $("#formseries").val();
        if(formseries == '' || formseries == null)
        {
            alert('Please select a form series first.');
        }
    });

    $("#taxtype").click(function() {
        var formseries = $("#formseries").val();
        var formtype = $("#formtype").val();

        if(formseries == '' || formseries == null)
        {
            alert('Please select a form series first.');
        }

        else if(formtype == '' || formtype == null)
        {
            alert('Please select a form number first.');
        }
        else
        {

        }
        
    });

    $("#formseries").change(function() {
    var formseries = $("#formseries").val();
    if(formseries == '0600 (Payment Form)')
    {
        $('#formtype').find('option').remove().end();
        $("#formtype").attr('readonly',false);
        $("#formtype").append('<option value="" disabled selected>--SELECT FORM NUMBER--</option><option value="0605">0605</option><option value="0605C1">0605C1</option><option value="0607">0607</option><option value="0608">0608</option><option value="0611">0611</option><option value="0611A">0611A</option><option value="0613">0613</option><option value="0614">0614</option><option value="0615">0615</option><option value="0616">0616</option><option value="0617">0617</option><option value="0618">0618</option>');
    }
    else if(formseries == '1600 (Payment Form)')
    {
        $('#formtype').find('option').remove().end();
        $("#formtype").attr('readonly',false);
        $("#formtype").append('<option value="" disabled selected>--SELECT FORM NUMBER--</option><option value="1600">1600</option><option value="1600WP">1600WP</option><option value="1601C">1601C</option><option value="1601E">1601E</option><option value="1601F">1601F</option><option value="1602">1602</option><option value="1603">1603</option><option value="1606">1606</option>');
    }
    else if(formseries == '1700 (Income Tax Return)')
    {
        $('#formtype').find('option').remove().end();
        $("#formtype").attr('readonly',false);
        $("#formtype").append('<option value="" disabled selected>--SELECT FORM NUMBER--</option><option value="1700">1700</option><option value="1701">1701</option><option value="1701Q">1701Q</option><option value="1702EX">1702EX</option><option value="1702MX">1702MX</option><option value="1702Q">1702Q</option><option value="1702RT">1702RT</option><option value="1703">1703</option><option value="1704">1704</option><option value="1706">1706</option><option value="1707">1707</option><option value="1707A">1707A</option>');
    }
    else if(formseries == '1800 (Transfer Tax Return)')
    {
        $('#formtype').find('option').remove().end();
        $("#formtype").attr('readonly',false);
        $("#formtype").append('<option value="" disabled selected>--SELECT FORM NUMBER--</option><option value="1800">1800</option><option value="1801">1801</option>');
    }
    else if(formseries == '2000 (DST Return)')
    {
        $('#formtype').find('option').remove().end();
        $("#formtype").attr('readonly',false);
        $("#formtype").append('<option value="" disabled selected>--SELECT FORM NUMBER--</option><option value="2000">2000</option><option value="2000OT">2000OT</option>');
    }
    else if(formseries == '2200 (Excise Tax Return)')
    {
        $('#formtype').find('option').remove().end();
        $("#formtype").attr('readonly',false);
        $("#formtype").append('<option value="" disabled selected>--SELECT FORM NUMBER--</option><option value="2200">2200</option><option value="2200A">2200A</option><option value="2200AN">2200AN</option><option value="2200M">2200M</option><option value="2200P">2200P</option><option value="2200T">2200T</option>');
    }
    else
    {
        $('#formtype').find('option').remove().end();
        $("#formtype").attr('readonly',false);
        $("#formtype").append('<option value="" disabled selected>--SELECT FORM NUMBER--</option><option value="2550M">2550M</option><option value="2550Q">2550Q</option><option value="2551M">2551M</option><option value="2551Q">2551Q</option><option value="2552">2552</option><option value="2553">2553</option>');
    }
    });

    $("#formtype").change(function() {
    var formtype = $("#formtype").val();
    if(formtype == '0605')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="AP">AP</option><option value="ET">ET</option><option value="FC">FC</option><option value="FP">FP</option><option value="MC">MC</option><option value="QP">QP</option><option value="RF">RF</option><option value="TR">TR</option>');
    }
    else if(formtype == '0605C1')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="AP">AP</option><option value="ET">ET</option><option value="FC">FC</option><option value="FP">FP</option><option value="MC">MC</option><option value="QP">QP</option><option value="RF">RF</option><option value="TR">TR</option>');
    }
    else if(formtype == '0607' || formtype == '0608')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="CG">CG</option><option value="CS">CS</option><option value="DN">DN</option><option value="DS">DS</option><option value="ES">ES</option><option value="ET">ET</option><option value="IT">IT</option><option value="MC">MC</option><option value="NT">NT</option><option value="PT">PT</option><option value="QP">QP</option><option value="RF">RF</option><option value="SL">SL</option><option value="SO">SO</option><option value="ST">ST</option><option value="TR">TR</option><option value="VT">VT</option><option value="WB">WB</option><option value="WC">WC</option><option value="WE">WE</option><option value="WF">WF</option><option value="WG">WG</option><option value="WO">WO</option> <option value="WR">WR</option>  <option value="WW">WW</option>  <option value="XA">XA</option>  <option value="XF">XF</option>  <option value="XG">XG</option>  <option value="XM">XM</option>  <option value="XP">XP</option>  <option value="XS">XS</option>  <option value="XT">XT</option>  <option value="XV">XV</option>');
    }
    else if(formtype == '0611' || formtype == '0611A')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="AP">AP</option> <option value="CG">CG</option>  <option value="CS">CS</option>  <option value="DN">DN</option>  <option value="DS">DS</option>  <option value="ES">ES</option>  <option value="IE">IE</option>  <option value="IT">IT</option>  <option value="PM">PM</option>  <option value="PT">PT</option>  <option value="SL">SL</option>  <option value="SO">SO</option>  <option value="ST">ST</option>  <option value="VT">VT</option>  <option value="WB">WB</option>  <option value="WC">WC</option>  <option value="WE">WE</option>  <option value="WF">WF</option>  <option value="WG">WG</option>  <option value="WO">WO</option>  <option value="WR">WR</option>  <option value="WW">WW</option>  <option value="XA">XA</option>  <option value="XF">XF</option>  <option value="XG">XG</option>  <option value="XM">XM</option>  <option value="XP">XP</option>  <option value="XS">XS</option>  <option value="XT">XT</option>  <option value="XV">XV</option>');
    }
    else if(formtype == '0613')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="FP">FP</option>');
    }
    else if(formtype == '0614' || formtype == '0615')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="AP">AP</option> <option value="CG">CG</option>  <option value="CS">CS</option>  <option value="DN">DN</option>  <option value="DO">DO</option>  <option value="DS">DS</option>  <option value="ES">ES</option>  <option value="IE">IE</option>  <option value="IT">IT</option>  <option value="PM">PM</option>  <option value="PT">PT</option>  <option value="SL">SL</option>  <option value="SO">SO</option>  <option value="ST">ST</option>  <option value="VT">VT</option>  <option value="WB">WB</option>  <option value="WC">WC</option>  <option value="WE">WE</option>  <option value="WF">WF</option>  <option value="WG">WG</option>  <option value="WO">WO</option>  <option value="WR">WR</option>  <option value="WW">WW</option>  <option value="XA">XA</option>  <option value="XF">XF</option>  <option value="XG">XG</option>  <option value="XM">XM</option>  <option value="XP">XP</option>  <option value="XT">XT</option>');
    }
    else if(formtype == '0616' || formtype == '0617')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="MC">MC</option>');
    }
    else if(formtype == '0618')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="AP">AP</option> <option value="CG">CG</option>  <option value="CS">CS</option>  <option value="DN">DN</option>  <option value="DO">DO</option>  <option value="DS">DS</option>  <option value="ES">ES</option>  <option value="IE">IE</option>  <option value="IT">IT</option>  <option value="MC">MC</option>  <option value="PM">PM</option>  <option value="PT">PT</option>  <option value="SL">SL</option>  <option value="SO">SO</option>  <option value="ST">ST</option>  <option value="VT">VT</option>  <option value="XA">XA</option>  <option value="XF">XF</option>  <option value="XG">XG</option>  <option value="XM">XM</option>  <option value="XP">XP</option>  <option value="XT">XT</option>');
    }
    else if(formtype == '1600')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="WG">WG</option>');
    }
    else if(formtype == '1600WP')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="WW">WW</option>');
    }
    else if(formtype == '1601C')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="WC">WC</option>');
    }
    else if(formtype == '1601E')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="WE">WE</option>');
    }
    else if(formtype == '1601F')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="WF">WF</option>');
    }
    else if(formtype == '1602')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="WB">WB</option>');
    }
    else if(formtype == '1603')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="WR">WR</option>');
    }
    else if(formtype == '1606')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="WO">WO</option>');
    }
    else if(formtype == '1700' || formtype == '1701' || formtype == '1701Q' || formtype == '1702EX' || formtype == '1702MX' || formtype == '1702Q' || formtype == '1702RT' || formtype == '1703')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="IT">IT</option>');
    }
    else if(formtype == '1704')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="IE">IE</option>');
    }
    else if(formtype == '1706')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="CG">CG</option>');
    }
    else if(formtype == '1707' || formtype == '1707A')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="CG">CG</option><option value="CS">CS</option>');
    }
    else if(formtype == '1800')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="DN">DN</option>');
    }
    else if(formtype == '1801')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="ES">ES</option>');
    }
    else if(formtype == '2000')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="DS">DS</option>');
    }
    else if(formtype == '2000OT')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="DO">DO</option>');
    }
    else if(formtype == '2200')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="XF">XF</option><option value="XS">XS</option><option value="XV">XV</option>');
    }
    else if(formtype == '2200A')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="XA">XA</option>');
    }
    else if(formtype == '2200AN')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="XG">XG</option>');
    }
    else if(formtype == '2200M')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="XM">XM</option>');
    }
    else if(formtype == '2200P')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="XP">XP</option>');
    }
    else if(formtype == '2200T')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="XT">XT</option>');
    }
    else if(formtype == '2550M' || formtype == '2550Q')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="VT">VT</option>');
    }
    else if(formtype == '2551Q')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="PT">PT</option>');
    }
    else if(formtype == '2552')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="SO">SO</option><option value="ST">ST</option>');
    }
    else if(formtype == '2553')
    {
        $('#taxtype').find('option').remove().end();
        $("#taxtype").attr('readonly',false);
        $("#taxtype").append('<option value="" disabled selected>--SELECT TAX TYPE--</option><option value="SL">SL</option>');
    }
    else
    {

    }

  });

});
</script>


