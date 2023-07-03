<!-- ADDED BY PABLO NOV. 7, 2018 --><!-- ADDED BY PABLO NOV. 7, 2018 --><!-- ADDED BY PABLO NOV. 7, 2018 --><!-- ADDED BY PABLO NOV. 7, 2018 -->
        <!--                 <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
                        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

                        <script src="https://cdn.rawgit.com/RobinHerbots/Inputmask/4.x/css/inputmask.css"></script>
                        <script src="https://daemonite.github.io/material/css/material.min.css"></script>
                        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
                        <script src="https://daemonite.github.io/material/js/material.min.js"></script> -->
                        <script src="https://cdn.rawgit.com/RobinHerbots/Inputmask/4.x/dist/min/jquery.inputmask.bundle.min.js"></script>
<!-- ADDED BY PABLO NOV. 7, 2018 --><!-- ADDED BY PABLO NOV. 7, 2018 --><!-- ADDED BY PABLO NOV. 7, 2018 --><!-- ADDED BY PABLO NOV. 7, 2018 -->


<!-- ADDED BY PABLO NOV. 13, 2018 --><!-- ADDED BY PABLO NOV. 13, 2018 --><!-- ADDED BY PABLO NOV. 13, 2018 -->
<SCRIPT language=Javascript>
       <!--
       function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }
       //-->
</SCRIPT>
<!-- ADDED BY PABLO NOV. 13, 2018 --><!-- ADDED BY PABLO NOV. 13, 2018 --><!-- ADDED BY PABLO NOV. 13, 2018 -->


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
                <h4>UTILITIES</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
    <div class="contentpanel">
        <div class="row">
            <div class="col-xs-12 col-md-5">
             <div class="alert alert-danger" style="display:none;" id="errorbatelec"><b></b></div>
             <div class="alert alert-danger" style="display:none;" id="errorcagelco"><b></b></div>
             <div class="alert alert-warning" style="display:none;" id="cagelcovalwarning"><b></b></div>


            <div class="alert alert-success" style="display:none;" id="cagelcovalinfo"><b></b></div>

            <div class="alert alert-success" id="approvedmessage" style="display: none;">&nbsp;&nbsp;
              <b>
              <?php echo $API['M'] ?>.</b> Tracking Number: 
              <a id="a" href="" target="_blank">
              <span id="b"></span>
              </a>
              <br>
               &nbsp;&nbsp;<small>Click <a id="c" href="" target="_blank">here</a> to download copy of the Acknowledgement Receipt.</small>
            </div>

            <div class="alert alert-danger" id="forINECMESSAGE" style="display: none;"><b></b></div>
            <?php if ($API['S'] === 0): ?>
            <div class="alert alert-danger" id="errormessage"><b><?php echo $API['M'] ?></b></div>
            <?php endif ?>
            <?php if ($API['S'] == 1 && $submitBtn == 1): ?>


              <!-- <div class="alert alert-success" id="successmessage">&nbsp;&nbsp;
              <b>
              <?php echo $API['M'] ?>.</b> Tracking Number: 
              <a href="https://mobilereports.globalpinoyremittance.com/portal/billspayment_receipt/<?php echo "<span id='a'></span>"  ?>" target="_blank"><span id="b"></span></a>
              <br>
               &nbsp;&nbsp;<small>Click <a href="https://mobilereports.globalpinoyremittance.com/portal/billspayment_receipt/<?php echo $API['TN']; ?>" target="_blank">here</a> to download copy of the Acknowledgement Receipt.</small>
              </div> -->

             <div class="alert alert-success" id="successmessage">&nbsp;&nbsp;<b><?php echo $API['M'] ?>.</b> Tracking Number: <a href="https://mobilereports.globalpinoyremittance.com/portal/billspayment_receipt/<?php echo $API['TN'];  ?>" target="_blank"><?php echo $API['TN'];  ?></a><br>
               &nbsp;&nbsp;<small>Click <a href="https://mobilereports.globalpinoyremittance.com/portal/billspayment_receipt/<?php echo $API['TN']; ?>" target="_blank">here</a> to download copy of the Acknowledgement Receipt.</small>
            </div> 


            <?php endif ?>
            <?php if ($API['S'] == 2 && $submitBtn == 1): ?>
              <div class="alert alert-warning" id="pendingmessage">&nbsp;&nbsp;<b><?php echo $API['M'] ?>.</b> Tracking Number: <?php echo $API['TN'];  ?></a>
            </div>

            <?php endif ?>
                <div class="form-group">

                    <select class="form-control" name="selBiller" id="selBiller">
                        <option value="" disabled selected>CHOOSE UTILITIES BILLER</option>  
                    <?php 
                    foreach ($biller as $key): 
                     $pieces = explode("|", $key);
                     $BD = strtoupper($pieces[0]);
                     $BC = strtoupper($pieces[1]);
                     $FT = strtoupper($pieces[2]);
                     $TF = strtoupper($pieces[3]);
                    ?>
                        <option value="<?php echo $BC ?>" 
                        data-name ="<?php echo $BD ?>" 
                        data-type ="<?php echo $FT ?>" 
                        data-desc = "<?php echo $user['CG'].'|'.$user['L'].'|'.$TF ?>" >
                        <?php echo $BD ?>
                        </option>  
                    <?php endforeach ?>
                    </select>
                    
                </div>

                 <!-- data type == 3 -->
                <div class="utilities3" style="display: none;">
                    <form name="frmUtilitiesLoading" action="<?php echo BASE_URL() ?>Bills_payment/utilities" method="post" id="frmUtilitiesLoading"> 
                        <div class="form-group" id="divBiller3"></div>                                                         
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputAccountNumber" placeholder="ACCOUNT NUMBER" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputSubscriberName" placeholder="SUBSCRIBER NAME" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputBookId" placeholder="BOOK ID" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputBillingMonth" placeholder="BILLING MONTH - MM/YYYY" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputMobile" placeholder="MOBILE NO" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control"  name="inputAmount" id="" placeholder="AMOUNT"/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" />
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary btnSubmitutil" name="btnSubmit" value="1">SUBMIT</button>
                        </div>
                     </form>
                </div><!-- data type == 3 --> 

                 <!-- data type == 20 -->
                <div class="utilities20" style="display: none;">
                    <form name="frmUtilitiesLoading" action="<?php echo BASE_URL() ?>Bills_payment/utilities" method="post" id="frmUtilitiesLoading"> 
                        <div class="form-group" id="divBiller20"></div>                                                         
                        <div class="form-group">
                            <input type="text" class="form-control"  id="stamariaidno" maxlength="12" name="inputAccountNumber" placeholder="ID. NUMBER" required/>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-3 col-md-3">
                              <label>GRACE PERIOD : </label>
                            </div>
                             <div class="col-xs-9 col-md-9">
                              <input type="text" class="form-control " id="todayAndUpdatepicker" name="inputGracePeriod" placeholder="yyyy/mm/dd" maxlength="10" readonly > 
                             </div>
                           
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputFName" placeholder="FIRST NAME" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputMName" placeholder="MIDDLE NAME" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputLName" placeholder="LAST NAME" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputMobile" maxlength="11" placeholder="MOBILE NO" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control inputAmount" name="inputAmount" id="inputAmount" placeholder="AMOUNT" required/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required/>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary btnSubmitutil" name="btnSubmit" value="1">SUBMIT</button>
                        </div>
                     </form>
                </div><!-- data type == 20 --> 

               <!-- data type == 24 -->
                <div class="utilities24" style="display: none;">
                    <form name="frmUtilitiesLoading" action="<?php echo BASE_URL() ?>Bills_payment/utilities" method="post" class="frmUtilitiesLoading" id="frmUtilitiesLoading"> 
                        <div class="form-group" id="divBiller24"></div>                                                         
                        <div class="form-group">
                            <input type="text" class="form-control"  id="batelecaccntno" maxlength="13" name="inputAccountNumberValidate" placeholder="ACCOUNT NUMBER" autocomplete="off" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputAmount" id="inputAmountbatelec" placeholder="AMOUNT" required />
                        </div>
<!--                         <div class="form-group">
                            <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" autocomplete="off" required/>
                        </div> -->
                        <div class="form-group text-right">
                            <!-- <button type="button" class="btn btn-primary btnBatelecVal" name="btnBatelecVal" id="btnBatelecVal" onclick="ValidateAccntNo();">VALIDATE</button> -->
                            <button type="button" class="btn btn-primary btnBatelecVal" name="btnBatelecVal" id="btnBatelecVal">VALIDATE</button>
                             <!-- <button type="button" class="btn btn-primary btn-lg btn_Modal25Submit" data-toggle="modal" id="btnSubmit" data-target="#myModal25">Submit</button> -->
                        </div>

              <!-- Modal -->
                  <div id="myModal24" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title" id="newheading"></h4>
                        </div>
                         <form id="data" method="post" enctype="multipart/form-data">
                        <fieldset>
                                  <div class="modal-body">
                                    <div class="alert alert-danger" style="display:none; text-align: center;" id="batelecvalerror"><b></b></div>
                                    <div class="alert alert-success" style="display:none; text-align: center;" id="batelecvalsuccess"><b></b></div>
                                    <div class="alert alert-info"><b>Please check your details and click "confirm button" to proceed transaction.</b></div>
                                      <div class="form-group">
                                      </div>
                                      <div class="form-group">
                                        <div class="input-group">
                                        <span class="input-group-addon"  style="padding-right: 12px;">ACCOUNT NUMBER:</span>
                                        <input type="text" class="form-control" id="inputAccountNumber" name="inputAccountNumber" readonly>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="input-group">
                                        <span class="input-group-addon"  style="padding-right: 32px;">ACCOUNT NAME:</span>
                                        <input type="text" class="form-control" id="inputSubscriberName" name="inputSubscriberName" readonly>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="input-group">
                                        <span class="input-group-addon"  style="padding-right: 34px;">BILLING PERIOD:</span>
                                        <input type="text" class="form-control" id="inputBillingMonth" name="inputBillingMonth" readonly>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="input-group">
                                        <span class="input-group-addon"  style="padding-right: 76px;">DUE DATE:</span>
                                        <input type="text" class="form-control" id="inputDueDateBatelec" name="inputDueDateBatelec" readonly>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="input-group">
                                        <span class="input-group-addon"  style="padding-right: 87px;">AMOUNT:</span>
                                        <input type="text" class="form-control inputAmountBatelec" id="inputAmount" name="inputAmount" readonly>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="input-group">
                                        <span class="input-group-addon"  style="padding-right: 5px;">TRANSACTION PASSWORD:</span>
                                       <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required/>
                                        </div>
                                      </div>
                                 </div>
                         <div class="modal-footer">
                           <button type="submit" class="btn btn-primary" id="submit" name="btnSubmit" value="1">Submit</button>

                          <a href="#" class="btn btn-warning" data-dismiss="modal">Close</a>
                        </fieldset>
                        </form>
                        </div>
                      </div>
                    </div>


                     </form>
                </div><!-- data type == 24 --> 

                <!-- data type == 1 && 8-->  
                <div class="utilities1" style="display: none;"> 
                    <form name="frmUtilitiesLoading" action="<?php echo BASE_URL() ?>Bills_payment/utilities" method="post" id="frmUtilitiesLoading">
                       <div class="form-group" id="divBiller1"> </div>   
                       <div class="form-group" id="divDynamicBiller"> </div>
<!--                         <div class="form-group">
                            <input type="text" class="form-control" name="inputAccountNumber" placeholder="ACCOUNT NUMBER" required />
                        </div> -->
                        <div class="form-group">
                            <input type="text" class="form-control inputNameValidator" name="inputSubscriberName" id="inputSubscriberName" placeholder="ACCOUNT NAME" required/>
                        </div>
                        <div class="form-group" id="DynamicBillerNumber" style="display: none;"> </div>
                        <div class="form-group" id="DynamicBillerMobNo" style="display: none;"> 
                            <input type="tel" class="inputNumberValidator form-control" name="inputMobile" id="inputMobile" placeholder="MOBILE NUMBER (11-Digits)" maxlength="11" required />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control inputAmountmyModal1" name="inputAmount" id="inputAmount" placeholder="AMOUNT" onkeypress="return isNumberKey(event)" required />
                        </div>
                        <!-- <div class="form-group">
                            <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                        </div> -->
                        <div class="form-group text-right">
                            <!-- <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">SUBMIT</button> -->
                            <button type="button" class="btn btn-primary btn-lg btn_ModalSubmit" data-toggle="modal" id="btnSubmit" data-target="#myModal1">Submit</button>
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
                                    <button type="submit" class="btn btn-primary btnSubmitutil" name="btnSubmit" value="1">Confirm</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                          </div>
                        </div>
                    </form>
                </div><!-- data type == 1 --> 

                <!-- data type == 25ss-->  



                <div class="utilities25" style="display: none;" id="datatype25"> 
                    <form name="frmUtilitiesLoading" action="<?php echo BASE_URL() ?>Bills_payment/utilities" method="post" class="frmUtilitiesLoading ifINEC incrt" id="frmUtilitiesLoadings">
                       <div class="form-group" id="divBiller25"> </div>   
                       <div class="form-group" id="divDynamicBiller25"> </div>
                        <div class="form-group" id="DynamicNumberInput25"> </div>

                        
<!--                         <div class="form-group">
                            <input type="text" class="form-control" name="inputAccountNumber" placeholder="ACCOUNT NUMBER" required />
                        </div> -->
                       
                        <!-- pattern="^(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}$" onchange="inputmaskAccountNos()" data-inputmask="'mask': '999-99-999'"-->

                        <div class="form-group maskAccountNo" style="display: none;">
                        <input type="text" class="form-control" name="inputAccountNumber" id="inputmaskAccountNo" oninput="handleInput(this)"  placeholder="ACCOUNT NUMBER (XXX-XX-XXX 10-Digits)" minlength="10" maxlength="10" required />
                        </div>

                        

                        <div class="form-group" id="DynamicAcctName25">
                            <input type="text" class="form-control inputNameValidator inputSubscriberName forINECNAME ss" name="inputSubscriberName" id="inputSubscriberName" placeholder="ACCOUNT NAME" required/>
                        </div>

                        <script>
                          $(".ss").keypress(function(event){
                              var inputValue = event.charCode;
                              if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)){
                                  event.preventDefault();
                              }
                          });
                        </script>

                        <div class="form-group grace" id="grace">
                            <!-- <input type="text" class="form-control datetimepicker" name="inputGracePeriod" placeholder="BILL PERIOD" /> -->

                            <div class = "form-inline">
                            <select class="form-control" style="min-width: 223px;" name="inputBillingMonth" id="inputB" required>
                            <option value = "">Select Month</option>
                            <option value="January">January</option>
                              <option value="February">February</option>
                              <option value="March">March</option>
                              <option value="April">April</option>
                              <option value="May">May</option>
                              <option value="June">June</option>
                              <option value="July">July</option>
                              <option value="August">August</option>
                              <option value="September">September</option>
                              <option value="October">October</option>
                              <option value="November">November</option>
                              <option value="December">December</option>
                            </select>
                            </div>

                        </div>

                        <div class="form-group" id="DynamicSubsName25">
                            <input type="text" class="form-control inputNameValidator inputSubscriberName1" name="inputSubscriberName" id="inputSubscriberName1" placeholder="SUBSCRIBER NAME" required/>
                        </div>

                        <div class="form-group" id="DynamicCustName25">
                            <input type="text" class="form-control inputNameValidator inputSubscriberName2" name="inputSubscriberName" id="inputSubscriberName2" placeholder="CUSTOMER NAME" required/>
                        </div>


                        <div class="form-group" style="display:none;" id="inputMobile2"> 
                            <input type="tel" class="inputNumberValidator form-control inputMobile22" name="inputMobile" placeholder="SUBSCRIBER NUMBER"  required />
                        </div>
<!-- 
                        <div class="form-group" id="selSems" style="display: none;"> 
                         
                        </div>


                        <div class="form-group" id="inputBillers" style="display: none;"> 
                         <input type="text" class="form-control inputReturnPeriod" id="inputBiller" name="inputBiller" placeholder="BILL MONTH (mm/yyyy)" readonly required>
                        </div> -->

                        <div class="form-group" id="divDynamicANTECOBiller25_0">

                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="padding-right:60px;">DUE DATE: (MM/DD/YYYY)</span>
                              <input type="text" class="form-control inputMDY selSemzz" id="selSemzz" name="selSem" placeholder="DUE DATE (mm/dd/yyyy)" readonly required>
                            </div>

                        </div>

                        <div class="form-group" id="divDynamicANTECOBiller25_2">

                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="padding-right:60px;">METER NUMBER</span>
                              <input type="number" class="form-control selSemzzz" id="selSemzzz" name="selSem" placeholder="15-Digits" maxlength="15" minlength="15" required>
                            </div>

                        </div>

                        <div class="form-group" style="display:none;" id="inputMobile1"> 
                            <input type="tel" class="inputNumberValidator form-control inputMobile11" id="inputMobile11" name="inputMobile" placeholder="CONTACT NUMBER"  required />
                        </div>

                        <div class="form-group">
                        <div class="input-group inputGracePeriods_0" id="inputGracePeriods_0">
                              <span class="input-group-addon" id="basic-addon1" style="padding-right:60px;">BILL NO.:</span>
                              <input type="text" class="form-control inputGracePeriods_1" id="inputGracePeriods_1" name="inputGracePeriods" placeholder="BILL NO." required>
                        </div>
                        </div>

                        <div class="form-group" id="divDynamicANTECOBiller25" style="display: none;">

                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="padding-right:60px;">DUE DATE: (MM/DD/YYYY)</span>
                              <input type="text" class="form-control inputMDY selSemz" id="selSemz" name="selSem" placeholder="DUE DATE (mm/dd/yyyy)" readonly required>
                            </div>

                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="padding-right:49px;">BILL MONTH: (MM/YYYY)</span>
                              <input type="text" class="form-control inputMontYear inputBillerz" id="inputBillerz" name="inputBillingMonth" placeholder="BILL MONTH (mm/yyyy)" readonly required>
                            </div>

                        </div>

                        <div class="form-group" id="divDynamicANTECOBiller25_1" style="display: none;">

                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="padding-right:60px;">DUE DATE: (MM/DD/YYYY)</span>
                              <input type="text" class="form-control inputMDY selSemz_1" id="selSemz_1" name="selSem" placeholder="DUE DATE (mm/dd/yyyy)" readonly required>
                            </div>

                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="padding-right:49px;">BEFORE DUE: (MM/YYYY)</span>
                              <input type="text" class="form-control inputMontYear inputBillerz_1" id="inputBillerz_1" name="inputBillingMonth" placeholder="BEFORE DUE (mm/yyyy)" readonly required>
                            </div>

                        </div>



                        <div class="form-group" id="DynamicBillerNumber25" style="display: none;"> </div>

                        <div class="form-group" id="DynamicDueDate25" style="display: none;"> 
                          <input type="text" class="form-control inputDueDate datetimepickermmddyyyy" name="inputDueDate" id="inputDueDate" placeholder="DUE DATE (mmddyyyy)" required />
                        </div>

                        <div class="form-group" id="DynamicDueDate25mdy" style="display: none;"> 
                          <input type="text" class="form-control inputDueDate inputMDY" name="inputDueDate" id="inputDueDate" placeholder="DUE DATE (mm/dd/yyyy)" required />
                        </div>

                        <div class="form-group" id="DynamicPayorName25" style="display: none;"> </div>
                        <div class="form-group" id="mobile"> 
                            <input type="tel" pattern=".{11,}" required title="Mobile number should have 11 digits" class="inputNumberValidator form-control inputMobile forINECMOBILE" name="inputMobile" id="inputMobile" placeholder="MOBILE NUMBER (11-Digits)" minlength="11" maxlength="11" required />
                        </div>


                        <div class="form-group">
                            <input type="text" class="form-control inputAmountmyModal25 forINECAMOUNT" name="inputAmount" id="inputAmount" placeholder="AMOUNT" onkeypress="return isNumberKey(event)" required />
                        </div>
                        <!-- <div class="form-group">
                            <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                        </div> -->
                        <div class="form-group text-right">
                            <!-- <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">SUBMIT</button> -->
                            <button type="button" class="btn btn-primary btn-lg btn_Modal25Submit" data-toggle="modal" id="btnSubmit" data-target="#myModal25">Submit</button>

                            <button type="button" class="btn btn-primary btn-md" id="btnValidate" style="display:none;">Validate</button>
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
                                    </div> -->

                                    <!-- ADDED BY PABLO 11/21/2018 -->

                                    <div class="form-group">
                                    <div class="alert alert-info"><b>Please check your details and click "confirm button" to proceed transaction.</b></div>
                                    <div id="warn" style="display:none;">
                                    <div class="alert alert-danger"><b>Account Number should have 10 digits including "-" special character.</b></div>
                                    </div>
                                    </div>

                                    <!-- ADDED BY PABLO 11/21/2018 -->

                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:85px;">Biller Name :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idBiller" class="idBiller"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group mainAcctName" id="mainAcctName">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:7px;">Account/ Reference No. :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idAcctNo" class="idAcctNo"></label></span>
                                        </div>
                                    </div>


                                    <div class="form-group AName" id="AName">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:65px;">Account Name :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idAcctName" class="idAcctName"></label></span>
                                        </div>
                                    </div>

                                    <div class="input-group iRP" id="iRP" style="display: none;">
                                            <span class="input-group-addon" id="basic-addon1" style="padding-right:27px;">Return Period:</span>
                                            <input type="text" class="form-control inputReturnPeriod" id="inputReturnPeriod" name="inputReturnPeriod" placeholder="MMDDYY" readonly required>
                                    </div>

<!--                                     <div class="form-group" id="selSemzz">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:65px;">Due Date :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="selSem" class="selSem"></label></span>
                                        </div>
                                    </div>

                                    <div class="form-group" id="inputBillerzz">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:65px;">Bill Month :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="inputBiller" class="inputBiller"></label></span>
                                        </div>
                                    </div> -->


                       <!--  <div class="input-group" id="DynamicDueDate25" style="display: none;"> 
                        <span class="input-group-addon" id="basic-addon1" style="padding-right:27px;">Due Date:</span>
                          <input type="text" class="form-control inputDueDate datetimepickermmddyyyy" name="inputDueDate" id="inputDueDate" placeholder="DUE DATE (mmddyyyy)" disabled />
                        </div> -->

                        <!-- <div class="form-group" id="DynamicDueDate25mdy" style="display: none;"> 
                          <input type="text" class="form-control inputDueDate inputMDY" name="inputDueDate" id="inputDueDate" placeholder="DUE DATE (mm/dd/yyyy)" disabled />
                        </div> -->

                                    <div class="form-group inputDueDate" id="Due" style="display: none;">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:63px;">Due Date :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="inputDueDate" class="inputDueDate"></label></span>
                                        </div>
                                    </div>

                                    <div class="form-group inputDueDate" id="Due_1" style="display: none;">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:63px;">Due Date :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="inputDueDate_1" class="inputDueDate_1"></label></span>
                                        </div>
                                    </div>


                                    <div class="form-group idBillInvoice" id="idBillInvoice_0" style="display: none;">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:63px;">Bill Invoice No. :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idBillInvoice" class="idBillInvoice"></label></span>
                                        </div>
                                    </div>

                                    <div class="form-group idLname" id="idLname_0" style="display: none;">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:88px;">Last Name :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idLname" class="idLname"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group idFname" id="idFname_0" style="display: none;">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:87px;">First Name :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idFname" class="idFname"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group idMname" id="idMname_0" style="display: none;">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:79px;">Middle Initial :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idMname" class="idMname"></label></span>
                                        </div>
                                    </div>

                                                    <div class="form-group idbireturnperiod" id="idbireturnperiod_0" style="display: none;">
                                                        <div class="input-group">
                                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:70px;">Return Period :</span>
                                                          <span class="form-control" id="basic-addon2" style=""><label id="idbireturnperiod" class="idbireturnperiod"></label></span>
                                                        </div>
                                                    </div>

                                    <div class="form-group idDueDate" id="idDueDate_0" style="display: none;">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:28px;">Due Date/ Bill Month :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idDueDate" class="idDueDate"></label></span>
                                        </div>
                                    </div>

                                    <div class="form-group idBillNo" id="idBillNo_0" style="display: none;">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:25px;">ATM Ref No./ Bill No. :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idBillNo" class="idBillNo"></label></span>
                                        </div>
                                    </div>

                                    <div class="form-group dueDates" id="dueDate">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:28px;">Due Date / Bill Month :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idDueDate_1" class="idDueDate_1"></label></span>
                                        </div>
                                    </div>

                                    <div class="form-group billNo" id="billNo">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:25px;">ATM Ref No./ Bill No. :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idBillNo_1" class="idBillNo_1"></label></span>
                                        </div>
                                    </div>

                                    <div class="form-group idPayorName" id="idPayorName_0" style="display: none;">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:79px;">Payor Name :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idPayorName" class="idPayorName"></label></span>
                                        </div>
                                    </div>


                                    <div class="form-group idMeterNumber" id="idMeterNumber_0">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:28px;">Meter Number :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="meter" class="meter"></label></span>
                                        </div>
                                    </div>

                                    <div class="form-group" id="mobilenumb">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:90px;">Mobile No. :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idMobNo" class="idMobNo"></label></span>
                                        </div>
                                    </div>

                                    <div class="form-group idDueDate" id="idDueDate_01" style="display: none;">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:28px;">Due Date / Bill Monthss :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idDueDate" class="idDueDate"></label></span>
                                        </div>
                                    </div>

                                    <div class="form-group" id="duedateforINEC" style="display: none;">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:100px;">Due Date:</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idduedateforINEC" class="idduedateforINEC"></label></span>
                                        </div>
                                    </div>

                                    <div class="form-group" id="billmonthforINEC" style="display: none;">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:100px;">Bill Month :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idbillmonthforINEC" class="idbillmonthforINEC"></label></span>
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
                                    <button type="submit" class="btn btn-primary btnSubmitutil bBtn" name="btnSubmit" value="1">Confirm</button>
                                    <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                          </div>
                        </div>
                    </form>
                </div><!-- data type == 25 --> 

                <!-- data type == 30-->  
                <div class="utilities30" style="display: none;" id="datatype30"> 
                    <form name="frmUtilitiesLoading" action="<?php echo BASE_URL() ?>Bills_payment/utilities" method="post" class="frmUtilitiesLoading" id="frmUtilitiesLoading">
                       <div class="form-group" id="divBiller30"> </div>   
                       <div class="form-group" id="divDynamicBiller30"> </div>
<!--                    <div class="form-group">
                            <input type="text" class="form-control" name="inputAccountNumber" placeholder="ACCOUNT NUMBER" required />
                        </div> -->
                        <div class="form-group" id="DynamicAcctName30">
                            <input type="text" class="form-control inputNameValidator inputSubscriberName" name="inputSubscriberName" id="inputSubscriberName" placeholder="ACCOUNT NAME" required/>
                        </div>

                        <div class="form-group"> 
                          <input type="number" class="form-control inputSem" name="inputBillerNo" id="inputSem" placeholder="METER NUMBER" required />
                        </div>

                        <div class="form-group" id="DynamicDueDate30"> 
                          <input type="text" class="form-control inputDueDate datetimepicker" name="inputDueDate" id="inputDueDate" placeholder="DUE DATE" required />
                        </div>

                        <div class="form-group">
                            <input type="number" class="form-control inputAmount" name="inputAmount" id="inputAmount"  placeholder="AMOUNT" step=".01" autocomplete="off" required />
                        </div>
                        <!-- <div class="form-group">
                            <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                        </div> -->
                        <div class="form-group text-right">
                            <!-- <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">SUBMIT</button> -->
                            <button type="button" class="btn btn-primary btn_Modal30Submit" data-toggle="modal" id="btnSubmit" data-target="#" href="#myModal30"> Submit</button>
                        </div>

                        <!-- Modal -->
                        <div id="myModal30" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Transaction Summary</h4>
                                  </div>
                                  <div class="modal-body">
                                    
                                    <div class="alert alert-info"><b>Please check your details and click "confirm button" to proceed transaction.</b></div>

                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:82px;">Biller Name :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idBiller" class="idBiller"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:47px;">Account Number. :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idAcctNo" class="idAcctNo"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:63px;">Account Name :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idAcctName" class="idAcctName"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:62px;">Meter Number. :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idBillNo" class="idBillNo"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:96px;">Due Date :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idDueDate" class="idDueDate"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:106px;">Amount :</span>
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
                                    <button type="submit" class="btn btn-primary btnSubmitutil" name="btnSubmit" value="1">Confirm</button>
                                    <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                          </div>
                        </div>
                    </form>
                </div><!-- data type == 30 --> 

                  <!-- data type == 23 -->
                <div class="utilities23" style="display:none;">
                    <form name="frmUtilitiesLoadingcagelco" action="<?php echo BASE_URL() ?>Bills_payment/utilities" method="post" id="cagelcoid"> 
                        <div class="form-group" id="divBiller23"></div>   

                         <div class="form-group">
                              <input  class="form-control" name="inputAccountNumber" id="inputAccountNumberxx" placeholder="10-DIGIT ACCOUNT NUMBER"  pattern="^\d{10}$" title="10  numeric characters only" maxlength ="10" required />

                              <input type="text" class="form-control" value="1" name="inputType" id="inputAccountType" />
                        </div>

                        <div class="form-group">
                            <!-- <input type="text" class="form-control datetimepicker" name="inputGracePeriod" placeholder="BILL PERIOD" /> -->

                            <div class = "form-inline">
                            <select class="form-control" style="min-width: 223px;" name="inputGracePeriods" id="inputGracePeriodsxx" required>
                            <option value = "">Select Month</option>
                            <option value="<?php echo date("Y"); ?>01">January</option>
                              <option value="<?php echo date("Y"); ?>02">February</option>
                              <option value="<?php echo date("Y"); ?>03">March</option>
                              <option value="<?php echo date("Y"); ?>04">April</option>
                              <option value="<?php echo date("Y"); ?>05">May</option>
                              <option value="<?php echo date("Y"); ?>06">June</option>
                              <option value="<?php echo date("Y"); ?>07">July</option>
                              <option value="<?php echo date("Y"); ?>08">August</option>
                              <option value="<?php echo date("Y"); ?>09">September</option>
                              <option value="<?php echo date("Y"); ?>10">October</option>
                              <option value="<?php echo date("Y"); ?>11">November</option>
                              <option value="<?php echo date("Y"); ?>12">December</option>
                            </select>
                             <input type="text" class="form-control" value = "<?php echo date("Y"); ?>" placeholder="BILL PERIOD" disabled />
                            </div>
  <!-- CAGELCO XD -->
                            <div class="alert alert-warning" style="margin-bottom: 5px;">
                              <span class="text-danger"><b>* Do not Accept Payments 2 Days before Due Date.</b></span><br>
                              <span class="text-danger"><b>* Do not Proccess Transactions with Unpaid Previous Bill and with Disconnection Notice.</b></span><br>
                              <b>Note: Only Current Bill is allowed</b>
                            </div>
                            
                        </div>

                        <div class="form-group text-right">
                            <button type="button" class="btn btn-primary" id="btnCheckStatus">VALIDATE</button> <!-- name="btnSubmit" -->
                        </div>

                        <div id="divcheckStatus" style="display:none">
                        <div class="form-group">
                            <input type="text" pattern="[a-zA-Z][a-zA-Z\s]*"  maxlength="65" class="form-control" id="inputSubscriberNamexx" name="inputSubscriberName" placeholder="SUBSCRIBER NAME" title="Letters only" maxlength="25" required/>
                        </div>

                        <div class="form-group">
                            <input class="form-control" name="inputMobile" id="inputMobilexx" placeholder="11-DIGIT MOBILE NUMBER" pattern="^\d{11}$" required  maxlength = "11" title="11  digit only(eg: 09XXXXXXXXX)"/>
                        </div>

                        <div class="form-group">
                            <input class="form-control inputAmount" name="inputAmount" id="inputAmountxx" placeholder="TOTAL BILL AMOUNT" required pattern="[0-9]+([\.,][0-9]+)?" step="0.01" title="Number's only" />
                            <div class="alert alert-warning" style="margin-bottom: 5px;">
                              <span class="text-danger"><b>* Do not Accept Partial Payment.</b></span><br>
                              <span class="text-danger"><b>* Do not Round off.</b></span><br>
                              <b>Note: Enter Full and Exact Bill Amount</b>
                            </div>
                        </div>

                        <div class="form-group">
                        <input type="text" class="form-control inputMDY" name="inputDisconnection" id="inputDisconnectionxx" placeholder="DISCONNECTION DATE" />
                         </div>
 
                      <!--    <div class="form-group">
                          <input type="file" class="form-control" required name="inputimagecagelco" id="inputimagecagelco">
                          <input type="hidden" class="form-control" required name="inputimagecagelco2" id="inputimagecagelco2">
                          <em class="text-danger" id="noteCagelco" style="display: none;">Note</em>
                         </div> -->

                         <div id="divimgcagelco" class="input-group">
                             <input type="file" id="inputimagecagelco" name="uploadsoacagelco" class="form-control"/>
                              <span class="input-group-addon" id="basic-addon1" style="padding-right: 10px; font-weight: bold;"><a href="" id="inputimagecagelco2" target="_blank" >Previous Upload</a></span>
                          </div>

                          <div id="linkimgcagelco" style="display:none" class="form-group">
                            <a class="form-control" id="linkcagelcoimg" target="_blank" href="">VIEW ATTACHMENT</a>
                          </div>
                           
                         <!-- <div class="form-group">
                            <input type="password" maxlength="25" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required/>
                        </div> -->
                        <div class="row">

                        <div class="col-sm-2 col-md-2 col-lg-2">
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2">
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2">
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2">
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2">

                        <div class="form-group" style="text-align: right">
                            <button type="button" class="btn btn-success" id="btnRefresh">
                            <span class="glyphicon glyphicon-refresh"></span>
                            RESET
                            </button> <!-- name="btnSubmit" -->
                        </div>

                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2">
                        
                        <div class="form-group">
                            <button type="button" class="btn btn-primary" id="btnSubmitcagelco">SUBMIT</button> <!-- name="btnSubmit" -->
                        </div>

                        </div>
                        </div>
                        
                        </div>
                        

                        <!-- NEW MODAL FOR CAGELCO ADDED 06122018 -->
                         
                         <!-- NEW MODAL FOR CAGELCO ADDED 06122018 -->
 
                         <div id="myModal23" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Transaction Summary</h4>
                                  </div>
                                  <div class="modal-body">
                                    
                                    <div class="alert alert-info"><b>Please check your details and click "confirm button" to proceed transaction.</b></div>

                                    <div class="alert alert-danger" style="display:none; text-align: center;" id="cagelcovalerror"><b></b></div>
                                    <div class="alert alert-success" style="display:none; text-align: center;" id="cagelcovalsuccess"><b></b></div>

                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:82px;">Biller Name :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idBiller" class="idBiller"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:47px;">Account Number. :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idAcctNo" class="idAcctNo"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:75px;">Billing Month :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idMonth" class="idMonth"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:47px;">Subscriber Name :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idName" class="idName"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:60px;">Mobile Number :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idMobno" class="idMobno"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:50px;">Total Bill Amount :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idAmount" class="idAmount"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:33px;">Disconnection Date :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idDisconnection" class="idDisconnection"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1" style="padding-right: 67px; font-weight: bold;">ATTACHMENT</span>
                                          <a class="form-control" id="imglink" href="" target="_blank">VIEW ATTACHMENT</a>
                                          <input type="hidden" class="form-control" name="attachment" id="attachment" placeholder="ATTACHMENT" required/>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" maxlength="25" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required/>
                                    </div>

                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btnSubmitutil" name="btnSubmit" value="1">Confirm</button>
                                    <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                          </div>
                        </div>
                     </form>
                     
                </div><!-- data type == 23 --> 
            </div><!-- row --> 

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
            
        </div>
    </div><!-- contentpanel -->             
</div><!-- mainpanel -->            

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script> -->

<!-- <script>
$(document).ready(function(){
var billerNo = $('#selBiller option:selected').val();

if(billerNo == "675"){
  alert("HAHA");

$(":input").inputmask();

$("#inputAccountNumber").inputmask({"mask": "999-99-999"});

}
}
</script> -->

<!-- ADDED BY PABLO 11/21/2018 -->

<script>
function handleInput(textfield)
{
    var val=textfield.value;

    val=val.replace(/[^\d]/g, ''); // remove all non-digits

    if(val.length>10) // crop surplus characters
    {
        val=val.substring(0,10);
    }

    if(val.length>2) // first dash
    {
        val=val.replace(val.substring(0,3), val.substring(0,3)+'-');
    }

    if(val.length>6) // second dash
    {
        val=val.replace(val.substring(3,6), val.substring(3,6)+'-');
    }

    textfield.value=val;

   

}
</script>

<script>
$(".ifINEC").submit(function(e){
  var billerNo = $('#selBiller option:selected').val();

  if(billerNo == 260){
    // alert($('#myModal25 .idduedateforINEC').text());
    // alert($('#myModal25 .idbillmonthforINEC').text());

  if($('#myModal25 .idduedateforINEC').text() != "" && $('#myModal25 .idbillmonthforINEC').text() != ""){
    return true;
    waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
  }else{
    alert("It seems like we're not going to process your request due to some of the fields are empty, please try to reload the page and choose INEC first as your transaction.");
    return false;
  }

  }

  
});
</script>

<!-- ADDED BY PABLO 11/21/2018 -->

<script src="<?php echo BASE_URL()?>assets/js/jquery-2.1.4.min.js"></script>
<script>
  $(document).ready(function(){
     
    $('.btn_ModalSubmit').click(function() {
        $('.idMobileNo').hide();
      var biller = $('#selBiller option:selected').data('name');
      var billerNo = $('#selBiller option:selected').val();
      var acctNo = $("#inputAccountNumber").val();
      var acctName = $(".utilities1 #inputSubscriberName").val();
      var amount = $(".inputAmountmyModal1").val();
      var mobNo = $("#inputMobile").val();

      // console.log('amount is '+ amount);

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

      var billerNo = $('#selBiller option:selected').val();


      $("#inputAccountNumber").val('');
      $("#inputSubscriberName1").val('');
      $("#inputSubscriberName2").val('');
      $("#inputSubscriberName").val('');
      $("#inputAmount").val('');
      $("#inputMobile").val('');
      $(".inputAccountNumber").val('');
      $(".inputSubscriberName").val('');
      $(".inputAmount").val('');
      $(".inputMobile").val('');
      $(".inputDueDate").val('');
      $("#DynamicDueDate25 #inputDueDate").val('');
      $("#DynamicDueDate25mdy #inputDueDate").val('');
      $(".inputBillerNo").val('');
      $(".inputCampus").val('');
      $(".selSemzzz").val('');
      $(".inputMobile11").val('');
      $("#inputmaskAccountNo").val('');
      $("#inputmaskAccountNo").attr("placeholder","ACCOUNT NUMBER (XXX-XX-XXX 10-Digits)");

      if(billerNo == '260'){
        
        // alert("HAHA");
        $('.btn_Modal25Submit').hide();

       $('#btnValidate').show();

       // $('#divDynamicANTECOBiller25_1').hide();
       
       $('.forINECNAME').css("display","none");
        
        $('.forINECNAME').hide();
        $('.forINECAMOUNT').hide();
        $('.forINECMOBILE').hide();
      }


    });

    $('#btnValidate').click(function(e) {
      e.preventDefault();
      var acctNo = $("#inputAccountNumber").val();
      
      if(acctNo == ""){
        $('#forINECMESSAGE').removeClass('alert-success');
        $('#forINECMESSAGE').addClass('alert-danger');
        
        $("#forINECMESSAGE").show();
        $("#forINECMESSAGE").html("Empty Fields.");
      }else{
        waitingDialog.show();
        $.ajax({
            url: "/Bills_payment/INEC_validate",
            type: 'POST',
            data : {accountno:acctNo},
            datatype:'json',
            // data: formData,
            // async: false,
            cache: false,
            // contentType: false,
            // processData: false,
            
            success: function (data) {
                
                waitingDialog.hide();
                
                
                var jsondata = JSON.parse(data);

                if(jsondata.S == 1){

                  $("#inputAccountNumber").attr('readonly', true);
                  $('#selSemz_1').attr('readonly', true);
                  $('#inputBillerz_1').attr('readonly', true);
                  $('#forINECMESSAGE').removeClass('alert-danger');
                  $('#forINECMESSAGE').addClass('alert-success');
                  
                  $("#forINECMESSAGE").show();
                  $('#divDynamicANTECOBiller25_1').css("display","block");
                  $("#forINECMESSAGE").html(jsondata.M);

                  $('.forINECNAME').show();
                  $('.forINECAMOUNT').show();
                  $('.forINECMOBILE').show();
                  // alert("HAHA");

                  $('.btn_Modal25Submit').show();

                  $('#btnValidate').hide();

                  $(".forINECNAME").attr('readonly', true);
                  $(".forINECAMOUNT").attr('readonly', true);

                  $(".forINECNAME").val(jsondata.NAME);
                  $(".forINECMOBILE").show();
                  $(".forINECAMOUNT").val(jsondata.AMT);
                  $("#selSemz_1").val(jsondata.DATE);
                  $("#inputBillerz_1").val(jsondata.DATE1);

                  

                }else{

                  $('#forINECMESSAGE').removeClass('alert-success');
                  $('#forINECMESSAGE').addClass('alert-danger');

                  $("#forINECMESSAGE").show();
                  $("#forINECMESSAGE").html(jsondata.M);

                  $('.forINECNAME').hide();
                  $('.forINECAMOUNT').hide();
                  $('.forINECMOBILE').hide();
                }
                // console.log(jsondata);
               
            }

          });

      }

      
    });




    $('.btn_Modal25Submit').click(function() {

      $("#inputTpass").val('');

      var biller = $('#selBiller option:selected').data('name');
      var billerNo = $('#selBiller option:selected').val();



      var acctNo = $("#inputAccountNumber").val();
      var amount = $(".inputAmountmyModal25").val();

      var refno = $("#inputBillerNo").val();
      var duedate = $("#inputDueDate").val();

      var duedate1 = $("#DynamicDueDate25mdy .inputDueDate").val();

      if(billerNo == '260'){
      var acctNo = $("#inputAccountNumber").val();
      var acctName = $("#datatype25 #inputSubscriberName").val();
      var mobNo = $("#datatype25 #inputMobile").val();
      var amount = $("#datatype25 #inputAmount").val();

      
      $('#duedateforINEC').css("display","block");
      $('#billmonthforINEC').css("display","block");

      

      $('#myModal25 .idAcctNo').html(acctNo);
      $('#myModal25 .idAcctName').html(acctName);
      $('#myModal25 .idAmount').html(amount);
      $('#myModal25 .idMobNo').html(mobNo);
      $('#myModal25 .idduedateforINEC').html($("#selSemz_1").val());
      $('#myModal25 .idbillmonthforINEC').html($("#inputBillerz_1").val());



      // $('#myModal25 #dueDate').hide();  
      
      }

if(billerNo == '675'){

//ADDED BY PABLO 11/21/2018

  var acctNo = $("#inputmaskAccountNo").val();
   
  if(acctNo.length != 10){
    alert("Account/Reference Number field should have 10 digits");
    $(".btn_Modal25Submit").removeAttr("data-toggle");
    $(".btn_Modal25Submit").removeAttr("data-target");
    $('.bBtn').prop('disabled', true);
    $('#warn').show();
  }else{
    $(".btn_Modal25Submit").attr("data-toggle", "modal");
    $(".btn_Modal25Submit").attr("data-target", "#myModal25");
    $('.bBtn').prop('disabled', false);
    $('#warn').hide();
  }

  if(acctNo.length == 0){
    $('#warn').hide();
    $('.bBtn').prop('disabled', false);
  }

//---ADDED BY PABLO 11/21/2018  




$('#myModal25 .idAcctNo').html(acctNo);


//$('#mainAcctName').remove(); //Account/ Reference No. : //class-> idAcctNo
//$('#AName').remove(); //Account Name : //class-> idAcctName
$('#iRP').remove(); //Return Period: //class-> inputReturnPeriod
$('#Due').remove(); //Due Date : //class-> inputDueDate
//$('#Due_1').remove(); //Due Date : //class-> inputDueDate_1
$('#idBillInvoice_0').remove(); //Bill Invoice No. : //class-> idBillInvoice
$('#idLname_0').remove(); //Last Name : //class-> idLname
$('#idFname_0').remove(); //First Name : //class-> idFname
$('#idMname_0').remove(); //Middle Initial : //class-> idMname
$('#idbireturnperiod_0').remove(); //Return Period : //class-> idbireturnperiod
$('#idDueDate_0').remove(); //Due Date/ Bill Month : //class-> idDueDate
$('#idBillNo_0').remove(); //ATM Ref No./ Bill No. : //class-> idBillNo
$('#dueDate').remove(); //Due Date/ Bill Month : //class-> idDueDate_1
$('#billNo').remove(); //ATM Ref No./ Bill No. : //class-> idBillNo_1
$('#idPayorName_0').remove(); //Pay or Name : //class-> idPayorName
$('#idMeterNumber_0').remove(); //Meter Number : //class-> meter
//$('#mobilenumb').remove(); //Mobile No. ://class-> idMobNo
$('#idDueDate_01').remove(); //Due Date / Bill Month ://class-> idDueDate
//$('#idAmount').remove(); //Amount//class-> idAmount

}
  
      if(billerNo == '509'){

      var acctName = $(".inputSubscriberName").val();

      //$('#mainAcctName').remove(); //Account/ Reference No. : //class-> idAcctNo
//$('#AName').remove(); //Account Name : //class-> idAcctName
$('#iRP').remove(); //Return Period: //class-> inputReturnPeriod
$('#Due').remove(); //Due Date : //class-> inputDueDate
//$('#Due_1').remove(); //Due Date : //class-> inputDueDate_1
$('#idBillInvoice_0').remove(); //Bill Invoice No. : //class-> idBillInvoice
$('#idLname_0').remove(); //Last Name : //class-> idLname
$('#idFname_0').remove(); //First Name : //class-> idFname
$('#idMname_0').remove(); //Middle Initial : //class-> idMname
$('#idbireturnperiod_0').remove(); //Return Period : //class-> idbireturnperiod
$('#idDueDate_0').remove(); //Due Date/ Bill Month : //class-> idDueDate
$('#idBillNo_0').remove(); //ATM Ref No./ Bill No. : //class-> idBillNo
$('#dueDate').remove(); //Due Date/ Bill Month : //class-> idDueDate_1
$('#billNo').remove(); //ATM Ref No./ Bill No. : //class-> idBillNo_1
$('#idPayorName_0').remove(); //Pay or Name : //class-> idPayorName
$('#idMeterNumber_0').remove(); //Meter Number : //class-> meter
//$('#mobilenumb').remove(); //Mobile No. ://class-> idMobNo
$('#idDueDate_01').remove(); //Due Date / Bill Month ://class-> idDueDate
//$('#idAmount').remove(); //Amount//class-> idAmount

      $('#mainAcctName').show();
      $('#AName').show();
      $('#Due_1').show();
      $('#idAmount').show();
      $('#mobilenumb').show();

      $('#myModal25 .idAcctNo').html(acctNo);
      $('#myModal25 .idAcctName').html(acctName);
      $('#myModal25 .inputDueDate_1').html(duedate1);
      $('#myModal25 .idAmount').html(amount);
      $('#myModal25 .idMobNo').html(mobNo);  
}

      

      if(billerNo == '536'){
      var mobNo = $("#inputMobile").val();


      $('#myModal25 .idAcctNo').html(acctNo);
      $('#myModal25 .idAcctName').html(acctName);
      $('#myModal25 .idAmount').html(amount);
      $('#myModal25 .idMobNo').html(mobNo);  
      }
      else if(billerNo == '515'){var mobNo = $(".inputMobile").val();}
      else if(billerNo == '662'){var mobNo = $(".inputMobile11").val();}
      else{var mobNo = $(".inputMobile").val();}


      



      if(billerNo == "669"){
        $('.dueDate').show();
        $('.billNo').show();

      var selSem = $('#selSemz_1').val();
      var inputBiller = $('#inputBillerz_1').val();

      $('#myModal25 .idAcctNo').html(acctNo);
      $('#myModal25 .idAcctName').html(acctName);
      $('#myModal25 .idAmount').html(amount);
      $('#myModal25 #idDueDate_1').html(selSem);
      $('#myModal25 #idBillNo_1').html(inputBiller);
      $('#myModal25 .idMobNo').html(mobNo); 

      }else{        
        $('.dueDate').hide();
        $('.billNo').hide();
      }

      if(billerNo == "664" || billerNo == "668" || billerNo == "671"){
                        var selSem = $('#selSemzz').val();
      }
      else{
              var selSem = $('#selSemz').val();
      var inputBiller = $('#inputBillerz').val();
      }


      // alert(selSem);
      // alert(inputBiller);

      var selSem1 = $('#selSemzz').val();

      var inputAccount = $("#inputAccount").val();

      var inputFName = $("#inputFName").val();
      var inputLName = $("#inputLName").val();

      var inputMName = $("#inputMName").val();
      var inputBillingMonth = $("#inputBillingMonth").val();

      var payorname = $("#inputPayorName").val();
      var meter = $('.idMeterNumber').val();



      // var idAcctName = $("#idAcctName").val(); 


      $('.idBillNo').hide();
      $('.idPayorName').hide();
      $('.idBillInvoice').hide();
      $('.idLname').hide();
      $('.idFname').hide();
      $('.idMname').hide();
      $('.mainAcctName').show();
      $('.idMeterNumber').hide();
      $('.grace').hide();

      
      if(billerNo == '370') {
        var acctName = $("#DynamicBillerNumber25 .inputSubscriberName").val();
      }
      else if(billerNo == '579'){
        var acctName = $("#DynamicSubsName25 #inputSubscriberName1").val();
      }
      else if(billerNo == '671'){
        $('#dueDate').show();
        var acctName = $("#DynamicCustName25 #inputSubscriberName2").val();

      $('#myModal25 .idBiller').html(biller);
      $('#myModal25 .idAcctNo').html(acctNo);
      $('#myModal25 .idAcctName').html(acctName);
      $('#myModal25 #idDueDate_1').html(selSem);
      $('#myModal25 .idAmount').html(amount);
      $('#myModal25 .idMobNo').html(mobNo);  
      }
      else if(billerNo == '662'){
        var acctName = $(".inputLNameID").val()+", "+$(".inputFNameID").val()+" "+$(".inputMNameID").val();
      }
       else {
        var acctName = $(".inputSubscriberName").val();
      }


 // if(billerNo == '669'){
 //  $('#myModal25 .idAcctNo').html(acctNo);
 //      $('#myModal25 .idAcctName').html(acctName);
 //      $('#myModal25 .idAmount').html(amount);
 //      $('#myModal25 #inputDueDate_1').html(selSem);
 //      $('#myModal25 #idBillNo').html(inputBiller);
 //      $('#myModal25 .idMobNo').html(mobNo); 
 //    }

      if(billerNo == '662'){
      $('#myModal25 .idMeterNumber').show();
      var selSem = $('.selSemzzz').val();
      $('#myModal25 .idAcctNo').html(acctNo);
      $('#myModal25 .idAcctName').html(acctName);
      $('#myModal25 .idAmount').html(amount);
      $('#myModal25 .meter').html(selSem);
      $('#myModal25 .idMobNo').html(mobNo);  
      }

      if(billerNo == '664' || billerNo == '668'){

      $('#myModal25 .idAcctNo').html(acctNo);
      $('#myModal25 .idAcctName').html(acctName);
      $('#myModal25 .idAmount').html(amount);
      $('#myModal25 #inputDueDate_1').html(selSem);
      $('#myModal25 .idMobNo').html(mobNo);  
      }

      if(billerNo == '653' || billerNo == '564' || billerNo == '520'){

      $('#myModal25 .idAcctNo').html(acctNo);
      $('#myModal25 .idAcctName').html(acctName);
      $('#myModal25 .idAmount').html(amount);
      $('#myModal25 .idMobNo').html(mobNo);  
      }



      // alert(acctName);

      // if(billerNo == '518'){

      // $('.inputReturnPeriod').css('display','none');
      // $(".inputReturnPeriod").prop('required',false);
      // }

      // alert(refno);




           if(billerNo == '659')
      {
        // alert(selSem);
            $('#myModal25 #Due').show();  

          $('.dueDate').show(); 

        acctName = inputLName.toUpperCase()+', '+inputFName.toUpperCase();
        $("#inputSubscriberName").val(acctName.toUpperCase());
        $('#myModal25 .idDueDate_1').html(selSem+' - '+inputBiller);
      $('#myModal25 .idAcctName').html(acctName);
      $('#myModal25 #inputDueDate').html(selSem + " - " + inputBiller);


      }
      else{$('#myModal25 .idDueDate').hide();  }

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

      if((billerNo == 494))
      {
        acctName = inputLName.toUpperCase()+', '+inputFName.toUpperCase();
        $("#inputSubscriberName").val(acctName.toUpperCase());
      }



      
      $('#myModal25 .idBiller').html(biller);
      $('#myModal25 .idAcctNo').html(acctNo);
      $('#myModal25 .idAcctName').html(acctName);
      $('#myModal25 .idAmount').html(amount);
      $('#myModal25 .idMobNo').html(mobNo);      



      if(billerNo == '337' || billerNo == '393')
      {

      $('.dueDates').hide();
        $('#myModal25 #idMobNo').html(mobNo); 
      }
      if(billerNo == '667')
      {
      var inputGracePeriod = $('#inputGracePeriods_1').val();
        $('.dueDate').show(); 
        $('.billNo').show();
        $('.idBillNo_1').html(selSem+' - '+inputBiller); 
        $('.idDueDate_1').html(inputGracePeriod); 

      }

            if(billerNo == '650')
      {
      
        $('#myModal25 .inputDueDate').show(); 
        $('#myModal25 #inputDueDate').html(selSem + " - " + inputBiller);

      }else{$('#myModal25 .inputDueDate').hide(); }

      if(billerNo == '336'){
        $('#myModal25 .idAcctNo').html(acctNo);


      }

      if(billerNo == '486' || billerNo == '487' || billerNo == '337' || billerNo == '423' || billerNo == '358' || billerNo == '304' || billerNo == '489' || billerNo == '336' || billerNo == '369' || billerNo == '498' || billerNo == '175' || billerNo == '357' || billerNo == '340' || billerNo == '338' || billerNo == '352' || billerNo == '499' || billerNo == '501' || billerNo == '506')
      {
        $('.idBillNo').show();
        $('#myModal25 .idBillNoDynamic').html('Account:'); 
        $(".idBillNoDynamic").attr('style','padding-right:110px;');
        $('#myModal25 #idBillNo').html(inputAccount); 
      }

      if(billerNo == '157')
      {
        $('.idPayorName').show();
        $('#myModal25 #idPayorName').html(payorname); 
      }

      if(billerNo == '299' || billerNo == '493')
      {

        $('.dueDates').hide();
        var acctNamed = inputLName.toUpperCase()+', '+inputFName.toUpperCase();
    $(".idAcctName").html(acctNamed);

      }

      if(billerNo == '636')
      {


        var inputBillingMonth = $(".inputBillingMonthID").val();

        var inputFName = $("#inputFName").val();
        var inputLName = $("#inputLName").val();

        var inputMName = $("#inputMName").val();
        $('#idDueDate_0').hide();
        $('.dueDates').hide();
        $('#AName').hide();
        $('.mainAcctName').show();
        $('.idBillInvoice').show();
        $('.idLname').show();
        $('.idFname').show();
        $('.idMname').show();
        $('#myModal25 #idBillInvoice').html(inputBillingMonth); 
        $('#myModal25 #idLname').html(inputLName); 
        $('#myModal25 #idFname').html(inputFName); 
        $('#myModal25 #idMname').html(inputMName);  


      }

      if(billerNo == '632' || billerNo == '616')
      {
        $('.AName').hide();
        $('.idLname').show();
        $('.idFname').show();
        $('#myModal25 #idLname').html(inputLName); 
        $('#myModal25 #idFname').html(inputFName); 
      }

      if(billerNo == '657')
      {
        $('.inputDueDate_1').html(selSem1);
    
      }
      if(billerNo == '664' || billerNo == '668' || billerNo == '657' || billerNo == '509')
      {
        $('#myModal25 #Due_1').show();
      }else{$('#myModal25 #Due_1').hide();}

    });

    
    $('#selBiller').on('change', function() {   
        var billerNo = $('#selBiller option:selected').val();
        // alert(billerNo);
        if(billerNo == '370') {
            $("#DynamicAcctName25").hide();
            $("#DynamicAcctName25 .inputSubscriberName").attr("disabled", true);
            $("#DynamicBillerNumber25 .inputSubscriberName").attr("disabled", false);

        } else {
            $("#DynamicAcctName25").show();
            $("#DynamicAcctName25 .inputSubscriberName").attr("disabled", false);
            $("#DynamicBillerNumber25 .inputSubscriberName").attr("disabled", true);
            $("#DynamicBillerNumber25 .inputSubscriberName").remove();
        }
    });


    // $('.frmUtilitiesLoading').on('submit', function(){

    //    waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
       
    // });

    $('.incrt').on('submit', function(){

       waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
       
    });

    $('#cagelcoid').on('submit', function(){

       waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
       
    });


    $('#datatype25 .inputAmountmyModal25').on('change', function(){

    var amount = $("#datatype25 .inputAmountmyModal25").val();

    if(amount <= 0 || amount == "")
    {
        alert('Invalid Amount');
        
        $('#datatype25 .inputAmountmyModal25').val('');
    }
    else
    {
        $(this).val(parseFloat($(this).val()).toFixed(2));
      
    }

    });


    $('.btn_Modal30Submit').click(function() {
        
        var biller    = $('#selBiller option:selected').data('name');
        var billerNo  = $('#selBiller option:selected').val();
        var acctNo    = $("#datatype30 .inputAccountNumber").val();
        var acctName  = $("#datatype30 .inputSubscriberName").val();
        var refno     = $("#datatype30 .inputSem").val();
        var duedate   = $("#datatype30 .inputDueDate").val();
        // var mobNo     = $(".inputMobile").val();
        var amount    = $("#datatype30 .inputAmount").val();
        
        // alert(duedate);

        if(acctNo != '' && acctNo != undefined && acctName != '' && acctName != undefined && refno != '' 
          && refno != undefined && duedate != '' && duedate != undefined && amount != '' && amount != undefined){
          $('#myModal30').modal('show');
        } else {
          alert('Please fill up all fields.');
          $('#myModal30').modal('hide');
        }

        $('#myModal30 .idBiller').html(biller);
        $('#myModal30 .idAcctNo').html(acctNo);
        $('#myModal30 .idAcctName').html(acctName);
        $('#myModal30 .idBillNo').html(refno);
        $('#myModal30 .idDueDate').html(duedate);
        $('#myModal30 .idAmount').html(amount);

    });


    // $('#frmUtilitiesLoading').on('submit',function(){
    //   waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
    // });


  });


</script>

<script type="text/javascript">
  $(document).ready(function(){
      //btnSubmitcagelco
      // function ValidateAccntNo() {

  $('#btnRefresh').click(function(){
    waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});

    $('#divcheckStatus').hide();
    $('#btnCheckStatus').show();
    $('#inputGracePeriodsxx').val('');
    
    waitingDialog.hide();
  });
});


</script>

<script type="text/javascript">
  $(document).ready(function(){
    var trno = "";
      //btnSubmitcagelco
      // function ValidateAccntNo() {

  $('#btnCheckStatus').click(function(){
    if($('#inputGracePeriodsxx').val() === '' ){
      alert('Biller month is empty')
    }else if($('#inputAccountNumberxx').val().length !== 10){
      alert('Account Number should have 10 characters')
    }else if($('#inputAccountNumberxx').val() === ''){
      alert('Account Number is empty')
    }else{
    $('#divimgcagelco').show()
    $('#linkimgcagelco').hide()
    $('#errorcagelco').hide()
    $('#cagelcovalsuccess').hide()
    waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
    CheckStatus();

    }
  })


      function CheckStatus(){

        
        $('#pendingmessage').hide();
        $('#errormessage').hide();

        $modal = $('#myModal23');
        var biller = $('#selBiller option:selected').data('name');
        var billerNo = $('#selBiller option:selected').val();  
        var accountno = $("#inputAccountNumberxx").val();
        var billmonth  = $('#inputGracePeriodsxx option:selected').val();
        var accountname = $("#inputSubscriberNamexx").val();
        var mobile = $("#inputMobilexx").val();
        var amount = $("#inputAmountxx").val();
        var discondate = $("#inputDisconnectionxx").val();
        var attachment = $("#inputimagecagelco").val();
        var type = $("#inputAccountType").val();

        var form_data = new FormData();
        form_data.append('accountno',$('#inputAccountNumberxx').val())
        form_data.append('billmonth',$('#inputGracePeriodsxx').val())

        $.ajax({
        type: 'POST',
        url: "/Bills_payment/cagelco_checkStatus",
        data:form_data,
        processData: false,
        contentType: false,
        success: function (data) {
          res = JSON.parse(data)
          console.log('STATUS',res.S)
          console.log('res',res)
          waitingDialog.hide();
          if(res.S == 1){
            $("#inputAccountNumberxx").prop('readonly', true);
            $('#inputGracePeriodsxx').prop('readonly', true);
            $('#divcheckStatus').show()
            $('#btnCheckStatus').hide()
            $('#cagelcovalinfo').hide();
            $('#inputimagecagelco2').hide();
            $('#approvedmessage').hide();


          }else if(res.S == 4){
            $("#inputAccountType").val(res.S);
            $("#inputAccountNumberxx").prop('readonly', true);
            $('#inputGracePeriodsxx').prop('readonly', true);
            $('#inputSubscriberNamexx').val(res.ACCTNAME)
            $('#inputMobilexx').val(res.MOBILE)
            $('#inputAmountxx').val(res.AMOUNT)
            $('#inputDisconnectionxx').val(res.DISCONDATE)
            $('#inputimagecagelco2').prop('href',res.ATTACHMENT);
            $('#inputimagecagelco2').val(res.ATTACHMENT);
            $('#errorcagelco').text(res.M)
            $('#errorcagelco').show()
            $('#divcheckStatus').show()
            $('#btnCheckStatus').hide()
            $('#cagelcovalinfo').hide();
            $('#noteCagelco').show();
            $('#approvedmessage').hide();

          }else if(res.S == 3){
            
            $('#inputimagecagelco').remove();
            $('#cagelcovalsuccess').show();
            $('#cagelcovalsuccess').text(res.M);
            $('#cagelcovalinfo').show();
            $('#cagelcovalinfo').text(res.M);
            $('#approvedmessage').show();
            
            $('#a').prop('href',`https://mobilereports.globalpinoyremittance.com/portal/billspayment_receipt${res.TRACKNO}`);
            $('#b').text(res.TRACKNO);
            $('#c').prop('href',`https://mobilereports.globalpinoyremittance.com/portal/billspayment_receipt${res.TRACKNO}`);


            // $("#approvedmessage").show();



            // $("#inputAccountNumberxx").prop('readonly', true);
            // $('#inputGracePeriodsxx').prop('readonly', true);
            // // $('#inputAccountNumberxx').val(res.ACCTNO);
            // // $('#inputGracePeriodsxx').val(res.BILLMONTH);
            // $('#inputSubscriberNamexx').val(res.ACCTNAME);
            // $('#inputMobilexx').val(res.MOBILE);
            // $('#inputAmountxx').val(res.AMOUNT);
            // $('#inputDisconnectionxx').val(res.DISCONDATE);
            
            // // $('#divcheckStatus').show();
            // // $('#btnCheckStatus').hide();

            // $('#myModal23 #idBiller').html(biller);
            // $('#myModal23 #idAcctNo').html(accountno);
            // $('#myModal23 #idMonth').html(billmonth);
            // $('#myModal23 #idName').html(res.ACCTNAME);
            // $('#myModal23 #idMobno').html(res.MOBILE);
            // $('#myModal23 #idAmount').html(res.AMOUNT);
            // $('#myModal23 #idDisconnection').html(res.DISCONDATE);
            // $('#imglink').prop('href',res.ATTACHMENT)
            // $('#attachment').val(res.ATTACHMENT)
            // $("#cagelcovalsuccess").html(res.M);
            // $("#cagelcovalsuccess").show();
            // $("#errorcagelco").hide();
            // $('#cagelcovalinfo').hide();
            // $("#cagelcovalwarning").hide();
            // $modal.modal('show');

          }else if(res.S == 2){
            if(res.TRACKNO){
              $("#cagelcovalwarning").hide();
              $("#inputAccountType").val(res.S);
              $('#cagelcovalinfo').show();
              $('#cagelcovalinfo').text(res.M);
              $('#errorcagelco').hide();
            }else{
              $("#inputAccountType").val(1);
              $("#inputAccountNumberxx").prop('readonly', true);
              $('#inputGracePeriodsxx').prop('readonly', true);
              $('#inputSubscriberNamexx').val(res.ACCTNAME)
              $('#inputMobilexx').val(res.MOBILE)
              $('#inputAmountxx').val(res.AMOUNT)
              $('#inputDisconnectionxx').val(res.DISCONDATE)
              $('#inputimagecagelco2').prop('href',res.ATTACHMENT);
              $('#inputimagecagelco2').val(res.ATTACHMENT);
              $('#errorcagelco').text(res.M)
              $('#errorcagelco').show()
              $('#divcheckStatus').hide()
              $('#btnCheckStatus').hide()
              $('#cagelcovalinfo').hide();
              $('#noteCagelco').show();
              $('#approvedmessage').hide();
              $('#divimgcagelco').hide()
              $('#linkimgcagelco').show()
              $('#linkcagelcoimg').prop('href',res.ATTACHMENT)

              //$modal.modal('show');
            }
            trno = res.TRACKNO
            

          }
          
        },
        error: function (data) {
          console.log(data)
        }
  });
}
      $('#btnSubmitcagelco').click(function() {

        // var formData = $("#cagelcoid")[0];
        // var form_data = new FormData(formData);

        // console.log(form_data)
         
        // alert('testss');
        waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
        // $('#myModal23').modal('show');

        var biller = $('#selBiller option:selected').data('name');
        var billerNo = $('#selBiller option:selected').val();  
        var accountno = $("#inputAccountNumberxx").val();
        var billmonth = $("#inputGracePeriodsxx").val();
        var accountname = $("#inputSubscriberNamexx").val();
        var mobile = $("#inputMobilexx").val();
        var amount = $("#inputAmountxx").val();
        var discondate = $("#inputDisconnectionxx").val();
        var attachment = $("#inputimagecagelco").val();
        var type = $("#inputAccountType").val();
        var prevattach = $('#inputimagecagelco2').prop('href');
        console.log(prevattach);


        // alert(biller);alert(billerNo);alert(accountno);alert(billmonth);alert(accountname);alert(mobile);alert(amount);alert(discondate);alert(attachment);alert(type);


        // alert(biller);alert(billerNo);alert(accountno);alert(billmonth);alert(accountname);alert(mobile);alert(amount);alert(discondate);alert(attachment);alert(type);

        if(attachment == ''){
          var attachment = $("#inputimagecagelco2").val();
        }

        // console.log(type);
        if(accountno != '' && grace != '' && accountname != '' && mobile != '' && amount != '' && discondate != ''&& attachment != ''&& type != '')
        {

          var form = $('#cagelcoid')[0]
          var form_data = new FormData(form);
          form_data.append('prevattach',prevattach);
          form_data.append('trno',trno);
          // form_data.append('billmonth',billmonth)
          // form_data.append('accountno',accountno)

          $.ajax({
            url: "/Bills_payment/cagelco_validate",
            type: 'POST',
            data:form_data,
            // datatype:'json',
            // cache: false,
            processData: false,
            contentType: false,
            
            success: function (data) {
                
                waitingDialog.hide();
                $modal = $('#myModal23');

                var jsondata = JSON.parse(data);
                console.log(jsondata);

                // if(jsondata.S != 3){

                //     if(jsondata.S == 1){
                //       $("#inputAccountType").val(jsondata.S);
                //       $("#cagelcovalsuccess").html(jsondata.M);
                //       $("#cagelcovalsuccess").show();
                //       $("#errorcagelco").hide();

                //     } else {
                //       $("#inputAccountType").val(jsondata.S);
                //       $("#errorcagelco").html(jsondata.M);
                //       $("#errorcagelco").show();
                      
                //     }
                    
                // }
                // else
                // {
                //   $('#myModal23 #idBiller').html(biller);
                //   $('#myModal23 #idAcctNo').html(accountno);
                //   $('#myModal23 #idMonth').html(billmonth);
                //   $('#myModal23 #idName').html(accountname);
                //   $('#myModal23 #idMobno').html(mobile);
                //   $('#myModal23 #idAmount').html(amount);
                //   $('#myModal23 #idDisconnection').html(discondate);

                //   $("#cagelcovalsuccess").html(jsondata.M);
                //   $("#cagelcovalsuccess").show();
                //   $("#errorcagelco").hide();
                //   $modal.modal('show');
                // }


                if(jsondata.S == 1){
                  $("#cagelcovalwarning").html(jsondata.M);
                  $("#cagelcovalwarning").show();
                  $("#errorcagelco").hide();
                  $("#cagelcovalinfo").hide();
                  // $('#divcheckStatus').hide();
                  // $("#btnCheckStatus").show();
                  $("#cagelcovalinfo").hide();



                  $('#myModal23 #idBiller').html(biller);
                  $('#myModal23 #idAcctNo').html(accountno);
                  $('#myModal23 #idMonth').html(billmonth);
                  $('#myModal23 #idName').html(accountname);
                  $('#myModal23 #idMobno').html(mobile);
                  $('#myModal23 #idAmount').html(amount);
                  $('#myModal23 #idDisconnection').html(discondate);
                  $("#myModal23 #imglink").attr("href", jsondata.AT)

                  $("#cagelcovalsuccess").html(jsondata.M);
                  $("#cagelcovalsuccess").show();
                  $("#errorcagelco").hide();
                  $("#cagelcovalwarning").hide();
                  // $("#cagelcovalinfo").show();
                  $modal.modal('show');
                  

                }else if(jsondata.S == 4){
                  $("#inputAccountType").val(jsondata.S);
                  $("#errorcagelco").html(jsondata.M);
                  $("#errorcagelco").show();
                  $("#cagelcovalwarning").hide();
                  $("#cagelcovalinfo").hide();


                }else if(jsondata.S == 3){
                  // $('#myModal23 #idBiller').html(biller);
                  // $('#myModal23 #idAcctNo').html(accountno);
                  // $('#myModal23 #idMonth').html(billmonth);
                  // $('#myModal23 #idName').html(accountname);
                  // $('#myModal23 #idMobno').html(mobile);
                  // $('#myModal23 #idAmount').html(amount);
                  // $('#myModal23 #idDisconnection').html(discondate);

                  $("#cagelcovalsuccess").html(jsondata.M);
                  $("#cagelcovalsuccess").show();
                  $("#errorcagelco").hide();
                  $("#cagelcovalwarning").hide();
                  $("#cagelcovalinfo").hide();
                  // $modal.modal('show');

                }else if(jsondata.S == 2){

                  $("#inputAccountType").val(jsondata.S);
                  $("#cagelcovalinfo").html(jsondata.M);
                  $("#cagelcovalinfo").show();
                  $("#errorcagelco").hide();
                  $("#cagelcovalwarning").hide();

                } else if(jsondata.S == 5){

                  // $("#inputAccountType").val(jsondata.S);
                  $("#cagelcovalinfo").html(jsondata.M);
                  $("#cagelcovalinfo").show();
                  $("#errorcagelco").hide();
                  $("#cagelcovalwarning").hide();

                }else {
                  $("#inputAccountType").val(jsondata.S);
                  $("#errorcagelco").html(jsondata.M);
                  $("#errorcagelco").show();
                  $("#cagelcovalwarning").hide();
                  $("#cagelcovalinfo").hide();
                }
            }

          });
        }
      else
      {     
            waitingDialog.hide();
            $("#errorcagelco").html('Insufficient Data');
            $("#errorcagelco").show();
      }

    });
  // }
  });

</script>


<script type="text/javascript">
// CAGELCO JAVASCRIPT
  $(document).ready(function(){
      //btnSubmitcagelco
      // function ValidateAccntNo() {
      $('#btnBatelecVal').click(function() {
        // alert('testss');
        waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
        // $('.btnBatelecVal').html('<span><i class="fa fa-spin fa-spinner"></i> Please wait ...</span>');
          
        var accountno = $("#batelecaccntno").val();
        var amount = $("#inputAmountbatelec").val();

        if(accountno != '' && amount != '')
        {
          
          // var formData = new FormData($('#data')[0]);

          // formData.append('accountno', accountno);
          // formData.append('amount', amount);

          $.ajax({
            url: "/Bills_payment/batelec_validate",
            type: 'POST',
            data : {accountno:accountno, amount:amount},
            datatype:'json',
            // data: formData,
            // async: false,
            cache: false,
            // contentType: false,
            // processData: false,
            
            success: function (data) {
                
                waitingDialog.hide();
                $modal = $('#myModal24');



                var jsondata = JSON.parse(data);
                // console.log(jsondata);
                if(jsondata.S != 1){

                    $("#errorbatelec").html(jsondata.M);
                    $("#errorbatelec").show();
                    
                }
                else
                {
                  $("#inputAccountNumber").val(jsondata.ACCTNO);
                  $("#inputSubscriberName").val(jsondata.ACCNTNAME);
                  $("#inputBillingMonth").val(jsondata.BILLPERIOD);
                  $("#inputDueDateBatelec").val(jsondata.DUEDATE);
                  $(".inputAmountBatelec").val(jsondata.AMT);

                  $("#batelecvalsuccess").html(jsondata.M);
                  $("#batelecvalsuccess").show();
                  $("#errorbatelec").hide();
                  $modal.modal('show');
                }
            }

          });
        }
      else
      {     
            waitingDialog.hide();
            $("#errorbatelec").html('Insufficient Data');
            $("#errorbatelec").show();
      }

    });
  // }
  });

</script>