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
                <h4>SCHOOLS</h4>
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
                        <option value="" disabled selected>CHOOSE SCHOOL BILLER</option>  
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
                  <form name="frmSchoolsLoading" action="<?php echo BASE_URL() ?>Bills_payment/schools" method="post" id="frmSchoolsLoading">
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


                <!-- data type == 1 && 8-->  
                <div class="utilities1" style="display: none;">  
                    <form name="frmSchoolsLoading" action="<?php echo BASE_URL() ?>Bills_payment/schools" method="post" id="frmSchoolsLoading">
                       <div class="form-group" id="divBiller1"> </div>  
                       <div class="form-group" id="divDynamicBiller"> </div>  
<!--                         <div class="form-group">
                            <input type="text" class="form-control" name="inputAccountNumber" placeholder="ACCOUNT NUMBER" required />
                        </div> -->
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
                            <button type="submit" class="btn btn-primary btnSubmit" name="btnSubmit" value="1">SUBMIT</button>
                        </div>
                    </form>
                </div><!-- data type == 1 --> 

                <!-- data type == 6-->  
                <div class="utilities6" style="display: none;"> 
                    <form name="frmSchoolsLoading" action="<?php echo BASE_URL() ?>Bills_payment/schools" method="post" id="frmSchoolsLoading">
                       <div class="form-group" id="divBiller6"> </div>   
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputAccountNumber" placeholder="STUDENT NUMBER" required />
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
                </div><!-- data type == 6 -->

                <!-- data type == 9-->  
                <div class="utilities9" style="display: none;"> 
                    <form name="frmSchoolsLoading" action="<?php echo BASE_URL() ?>Bills_payment/schools" method="post" id="frmSchoolsLoading">
                       <div class="form-group" id="divBiller9"> </div>   
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputAccountNumber" placeholder="STUDENT NUMBER" required />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputSubscriberName" placeholder="STUDENT NAME" required/>
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
                </div><!-- data type == 9 --> 

                <!-- data type == 13-->  
                <div class="utilities13" style="display: none;"> 
                    <form name="frmSchoolsLoading" action="<?php echo BASE_URL() ?>Bills_payment/schools" method="post" id="frmSchoolsLoading">
                       <div class="form-group" id="divBiller13"> </div>   
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputAccountNumber" placeholder="STUDENT NUMBER" required />
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                <select class="form-control" name="selSchoolYear" id="selSchoolYear">
                                    <option value="" disabled selected>SCHOOL YEAR</option>  
                                   <?php 
                                   $count = 0; 
                                   foreach ($sy as $row): 
                                   $count++;
                                    ?>
                                   <option value="<?php echo $count; ?>"><?php echo $row; ?></option>
                                   <?php endforeach ?>
                                </select>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                <select class="form-control" name="selSem" id="selSem">
                                   <option value="" disabled selected>SEMESTER</option>  
                                   <?php 
                                   $count = 0;
                                   foreach ($sem as $row): 
                                   $count++;
                                    ?>
                                   <option value="<?php echo $count; ?>"><?php echo $row; ?></option>
                                   <?php endforeach ?>
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputLastName" placeholder="LAST NAME" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputFirstName" placeholder="FIRST NAME" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputMiddleName" placeholder="MIDDLE NAME" required/>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="selCourse" id="selCourse">
                                <option value="" disabled selected>COURSE</option>  
                                <?php 
                                $count = 0; 
                                foreach ($course as $row): 
                                $count++;   
                                ?>
                                <option value="<?php echo $count; ?>"><?php echo $row; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="selYearLevel" id="selYearLevel">
                                <option value="" disabled selected>YEAR LEVEL</option> 
                                <?php 
                                $count = 0; 
                                foreach ($yrlevel as $row): 
                                $count++; 
                                ?>
                                <option value="<?php echo $count; ?>"><?php echo $row; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="selCampus" id="selCampus">
                                <option value="" disabled selected>CAMPUS</option> 
                                <?php 
                                $count = 0;
                                foreach ($campus as $row): 
                                $count++;
                                ?>
                                <option value="<?php echo $count; ?>"><?php echo $row; ?></option>
                                <?php endforeach ?>
                            </select>
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
                </div><!-- data type == 13 --> 


                <!-- data type == 25-->  
                <div class="utilities25" style="display: none;" id="datatype25"> 
                    <form name="frmUtilitiesLoading" action="<?php echo BASE_URL() ?>Bills_payment/schools" method="post" class="frmUtilitiesLoading" id="frmUtilitiesLoading">
                       <div class="form-group" id="divBiller25"> </div>   
                       <div class="form-group" id="divDynamicBiller25"> </div>
<!--                         <div class="form-group">
                            <input type="text" class="form-control" name="inputAccountNumber" placeholder="ACCOUNT NUMBER" required />
                        </div> -->
                        <div class="form-group">
                            <input type="text" class="form-control inputNameValidator inputSubscriberName" name="inputSubscriberName" id="inputSubscriberName" placeholder="ACCOUNT NAME" required/>
                        </div>

                        <div class="form-group" id="accountName2">
                            <input type="text" class="form-control inputNameValidator inputSubscriberName2" name="inputSubscriberName" id="inputSubscriberName2" placeholder="STUDENT NAME" required/>
                        </div>

                        <div class="form-group" id="campus">
                        <input type="text" class="form-control selCampus" name="selCampus" id="selCampuss" placeholder="BRANCH" required />
                        </div>

                        <div class="form-group" id="DynamicBillerNumber25" style="display: none;"> </div>

                        <div class="form-group" id="DynamicDueDate25" style="display: none;"> 
                          <input type="text" class="form-control inputDueDate datetimepicker" name="inputDueDate" id="inputDueDate" placeholder="DUE DATE (mmddyyyy)" required />
                        </div>

                        <div class="form-group" id="DynamicDueDate25mdy" style="display: none;"> 
                          <input type="text" class="form-control inputBday inputMDY" name="inputBday" id="inputBday" placeholder="STUDENT BIRTHDAY (mm/dd/yyyy)" required />
                        </div>

                        <div class="form-group" id="divDynamicADAMSONBiller25" style="display: none;">
                                            
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon3" style="padding-right:60px;">School Year (yyyy-yyyy):</span>
                              <input type="text" class="form-control inputYearYear selYearLevel inputNumberValidator" id="inputYearYear" name="selYearLevel" value="<?php echo date('Y');?>-<?php echo date('Y', strtotime('+1 years'));?>" pattern="[0-9]{4}-?[0-9]{4}" maxlength="9" required>
                            </div>

                            <select class="form-control selCampus" name="selCampus" id="selTerm">
                                <option value="" disabled selected>Select Term</option> 
                                <option value="1">First Sem</option>
                                <option value="2">Second Sem</option>
                                <option value="3">Summer</option>
                            </select>
                            <select class="form-control selSem" name="selSem" id="selPayType">
                                <option value="" disabled selected>Select Payment Type</option> 
                                <option value="B2">Old Accounts</option>
                                <option value="DP">Down Payment</option>
                                <option value="PT">Prelim Term</option>
                                <option value="MT">Mid Term</option>
                                <option value="FT">Final Term</option>
                                <option value="MI">Miscellaneous</option>
                                <option value="G1">First Grading</option>
                                <option value="G2">Second Grading</option>
                                <option value="G3">Third Grading</option>
                                <option value="G4">Fourth Grading</option>
                            </select>
                        </div>

                        <div class="form-group" id="divDynamicADAMSONBiller25_1">
                                            
      



                            <select class="form-control inputCampus" name="inputCampus" id="inputCampus_0" required>
                                <option value="" disabled selected>Campus</option> 
                                <option value="1">NORTH CAMPUS</option>
                                <option value="2">SOUTH CAMPUS</option>
                                <option value="3">MONTESSORI</option>
                                <option value="4">MAIN/DOWNTOWN</option>
                                <option value="5">TALAMBAN</option>
                            </select>
    
                        </div>

                        <div class="form-group" id="DynamicCampus25" style="display: none;"> </div>

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
                                        <span> Case No./ Bill No. : </span> <label id="idBillNo"></label>
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
                                    <div class="form-group" id="idAcctName1">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:65px;">Account Name :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idAcctName" class="idAcctName"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group idAcctName2" id="idAcctName2">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:65px;">Account Name :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idAcctName22" class="idAcctName22"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group" id="acctName">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:65px;">Account Name :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="acctName_0" class="acctName_0"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group" id="acctCampus">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:65px;">Campus :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="acctCampus_0" class="acctCampus_0"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group" id="branch">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:65px;">Branch :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="branchName" class="branchName"></label></span>
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
                                    <div class="form-group idCampus" style="display: none;">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:73px;">School Name :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idCampus" class="idCampus"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group idBranch" style="display: none;">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:74px;">Branch Code :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idBranch" class="idBranch"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group idLname" style="display: none;">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:88px;">Last Name :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idLname" class="idLname"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group idFname" style="display: none;">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:87px;">First Name :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idFname" class="idFname"></label></span>
                                        </div>
                                    </div>

                                    <div class="form-group idMname" style="display: none;">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:73px;">Middle Name :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idMname" class="idMname"></label></span>
                                        </div>
                                    </div>

                                    <div class="form-group idPaytype" style="display: none;">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:30px;">Payment Type Code :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idPaytype" class="idPaytype"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group idStudentBday" style="display: none;">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:53px;">Student Birthday :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idStudentBday" class="idStudentBday"></label></span>
                                        </div>
                                    </div>

                                    <div class="form-group idCourse" style="display: none;">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:111px;">Course :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idCourse" class="idCourse"></label></span>
                                        </div>
                                    </div>

                                    <div class="form-group idSchoolyear" style="display: none;">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:82px;">School Year :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idSchoolyear" class="idSchoolyear"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group idTerm" style="display: none;">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:88px;">Term Code :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idTerm" class="idTerm"></label></span>
                                        </div>
                                    </div>

                                    <div class="form-group idPaytype2" style="display: none;">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:30px;">Payment Type Code :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idPaytype2" class="idPaytype2"></label></span>
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
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:108px;">Amount :</span>
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

                 <!-- data type == 31 -->  

                 <div class="utilities31" style="display: none;" id="datatype31"> 
                    <form name="frmSchoolsLoading" action="<?php echo BASE_URL() ?>Bills_payment/schools" method="post" class="frmSchoolsLoading" id="frmSchoolsLoading">

                       <div class="form-group" id="divBiller31"> </div>   
                       <div class="form-group divDynamicBiller31" id="divDynamicBiller31" style="display: none;"> </div>
                        <div class="form-group" id="DynamicNumberInput31"> </div>

                        <div class="form-group" id="AcctNumber31">
                        <input type="text" class="form-control inputAccountNumber" name="inputAccountNumber" id="inputAccountNumber1" maxlength="10" placeholder="STUDENT ID" required />
                        </div>

                        <div class="form-group" id="divBiller311"> </div>

                        <!-- inputAccountNumber1
                        inputSubscriberName1
                        inputMobile1
                        selSem1
                        inputAmount -->

                        <div class="form-group" id="AcctName31">
                            <input type="text" class="form-control inputNameValidator inputSubscriberName secondname" name="inputSubscriberName" id="inputSubscriberName1" placeholder="ACCOUNT NAME" required/>
                        </div>

                        <div class="form-group" id="AcctMobile31"> 
                            <input type="tel" class="inputNumberValidator form-control inputMobile secondmobile" id="inputMobile1" name="inputMobile" placeholder="CONTACT NUMBER" minlength="11" maxlength="11" required />
                        </div>

                        <div class="form-group" id="AcctSender31"> 
                            <input type="tel" class="inputNumberValidator form-control selSem thirdmobile" id="selSem1" name="selSem" placeholder="SENDER MOBILE NUMBER" minlength="11" maxlength="11" required />
                        </div>

                        <div class="form-group" id="AcctAmount31">
                            <input type="text" class="form-control inputAmount" name="inputAmount" id="inputAmount" onkeypress="return isNumberKey(event,this.id)"  placeholder="AMOUNT" autocomplete="off" required />
                        </div>

                        <script>
                        function isNumberKey(evt,id)
                            {
                              try{
                                    var charCode = (evt.which) ? evt.which : event.keyCode;
                              
                                    if(charCode==46){
                                        var txt=document.getElementById(id).value;
                                        if(!(txt.indexOf(".") > -1)){
                              
                                            return true;
                                        }
                                    }
                                    if (charCode > 31 && (charCode < 48 || charCode > 57) )
                                        return false;

                                    return true;
                              }catch(w){
                                // alert(w);
                              }
                            }
                        </script>

                        <div class="form-group text-right">
                            <button type="button" class="btn btn-primary btn-lg btn_Modal31Submit" data-toggle="modal" id="btnSubmit" data-target="#myModal31">Submit</button>
                        </div>

                        <!-- Modal -->
                        <div id="myModal31" class="modal fade" role="dialog">
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
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:86px;">Biller Name :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idBiller" class="idBiller"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:94px;">Student ID :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="studID" class="studID"></label></span>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:70px;">Student Name :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="studName" class="studName"></label></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                    <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1" style="padding-right:12px;">Student Mobile Number :</span>
                                            <span class="form-control" id="basic-addon2" style=""><label id="studMobNo" class="studMobNo"></label></span>
                                    </div>
                                    </div>

                                    <div class="form-group" >
                                    <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1" style="padding-right:14px;">Sender Mobile Number :</span>
                                            <span class="form-control" id="basic-addon2" style=""><label id="studSenderMobNo" class="studSenderMobNo"></label></span>
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
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:19px;">Transaction Password :</span>
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
                </div>

                 <!-- data type == 31 --> 
                


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
                              <p> <b><span class="text-info1">4.</span></b> After every transaction, <b>download and print Acknowledgement reciept</b>. Original copy of the acknowledgement reciept will be issued to the customer as proof of payment. </p>

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

    $('.btn_Modal31Submit').click(function() {
      var biller = $('#selBiller option:selected').data('name');
      var billerNo = $('#selBiller option:selected').val();

      var acctNo = $("#datatype31 #inputAccountNumber1").val();
      var subsName = $("#datatype31 #inputSubscriberName1").val();
      var mobNo = $("#datatype31 #inputMobile1").val();
      var sender = $("#datatype31 #selSem1").val();
      var amount = $("#datatype31 #inputAmount").val();

      //if(billerNo == '678')
      //{
        //$('#myModal31 .idBiller').html(biller);
        //$('#myModal31 #studID').html(acctNo);
        //$('#myModal31 #studName').html(subsName);
        //$('#myModal31 #studMobNo').html(mobNo);
        //$('#myModal31 #studSenderMobNo').html(sender);
        //$('#myModal31 #idAmount').html(amount);  
      //}
      if(billerNo >= "678" || billerNo <="729")
      {
        $('#myModal31 .idBiller').html(biller);
        $('#myModal31 #studID').html($("#inputAccountNumber23").val());
        $('#myModal31 #studName').html($("#SinputSubscriberName").val());
        $('#myModal31 #studMobNo').html($("#inputMobile3").val());
        $('#myModal31 #studSenderMobNo').html(sender);
        $('#myModal31 #idAmount').html(amount);  
      }

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
      $("#selCampus").val('');
      $("#inputLastName").val('');
      $("#inputFirstName").val('');
      $("#selCourse").val('');
      $("#inputBday").val('');
    });

    


    $('.btn_Modal25Submit').click(function() {
      var biller = $('#selBiller option:selected').data('name');
      var billerNo = $('#selBiller option:selected').val();
      var acctNo = $("#inputAccountNumber").val();

 
      var acctName = $(".inputSubscriberName").val();
    

      var acctName2 = $("#accountName2 #inputSubscriberName2").val();



      var amount = $("#datatype25 .inputAmount").val();
      var mobNo = $(".inputMobile").val();
      var refno = $("#inputBillerNo").val();
      var duedate = $("#inputDueDate").val();


        var inputCampus1 = $("#inputCampus_0 option:selected").text();
 
      var inputCampus = $("#inputCampus").val();
  

      var selCampus = $('#frmUtilitiesLoading #selCampus option:selected').val();
      var selCampusField = $('#selCampuss').val();
      var inputLastName = $("#inputLastName").val();
      var inputFirstName = $("#inputFirstName").val();
      var inputMiddleName = $("#inputMiddleName").val();
      var selCourse = $('#frmUtilitiesLoading #selCourse option:selected').val();
      var inputBday = $("#inputBday").val();

      // var selCourse = $(".selCourse").val();
      var inputFirstName = $(".inputFirstName").val();
      var selYearLevel = $(".selYearLevel").val();
      var selSem = $('#frmUtilitiesLoading #selPayType option:selected').val();
      var selTerm = $('#frmUtilitiesLoading #selTerm option:selected').val();
      
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


      
        
      $('.idBranch').hide();
      $('.idLname').hide();
      $('.idFname').hide();
      $('.idPaytype').hide();
      $('.idStudentBday').hide();
      $('.mainAcctName').show();
      $('#acctCampus').hide();
      $('#myModal25 #acctName').css('display','none');


      $('.idMname').hide();
      $('.idTerm').hide();
      $('.idPaytype').hide();
      $('.idSchoolyear').hide();




      
      if(billerNo == '614')
      {
        $('.mainAcctName').hide();
        $('.idBranch').show();
        $('.idLname').show();
        $('.idFname').show();
        $('.idPaytype').show();
        $('.idStudentBday').show();
        $('#myModal25 #idBranch').html(selCampus); 
        $('#myModal25 #idLname').html(inputLastName); 
        $('#myModal25 #idFname').html(inputFirstName); 
        $('#myModal25 #idPaytype').html(selCourse); 
        $('#myModal25 #idStudentBday').html(inputBday); 
      }
        if(billerNo == '656')
      {
        $('#branch').show();
        $('#idAcctName1').hide();
        $('#idAcctName2').show();

      $('#myModal25 .idAcctNo').html(acctNo);
      $('#myModal25 #idAcctName22').html(acctName2);
      $('#myModal25 .branchName').html(selCampusField);
      $('#myModal25 .idMobNo').html(mobNo);
      $('#myModal25 .idAmount').html(amount);  
      }else{$('#idAcctName1').show();}

      if(billerNo == '611')
      {
        $('#idAcctName1').hide();
        $('.mainAcctName').hide();
        $('.idLname').show();
        $('.idFname').show();
        $('.idMname').show();
        $('.idCourse').show();
        
        $('.idTerm').show();
        $('.idPaytype2').show();
        $('.idSchoolyear').show();




        var selTerm = $("#selTerm option:selected").text();
        var selSem = $("#selPayType option:selected").text();

        var selCourse = $(".sC").val();

        $('#myModal25 #idLname').html(inputLastName); 
        $('#myModal25 #idFname').html(inputFirstName);
        $('#myModal25 #idMname').html(inputMiddleName);  
        $('#myModal25 #idTerm').html(selTerm); 
        $('#myModal25 #idPaytype2').html(selSem); 
        $('#myModal25 #idSchoolyear').html(selYearLevel); 
        $('#myModal25 #idCourse').html(selCourse); 


        
      }
      if(billerNo == '672'){
        var acctName = $(".inputSubscriberName2").val();


        $('#myModal25 #idAcctName2').hide();
        $('#acctCampus').show();
      $('#myModal25 .idBiller').html(biller);
      $('#myModal25 .idAcctNo').html(acctNo);
      $('#myModal25 .acctName_0').html(acctName2);

      $('#myModal25 .acctCampus_0').html(inputCampus1);

      $('#myModal25 .idAmount').html(amount);
      $('#myModal25 .idMobNo').html(mobNo);    
      }

      
      $('#myModal25 .idBiller').html(biller);
      $('#myModal25 .idAcctNo').html(acctNo);
      $('#myModal25 #idAcctName').html(acctName);
      $('#myModal25 .idAmount').html(amount);
      $('#myModal25 .idMobNo').html(mobNo);       
    });


    $('.frmSchoolsLoading').on('submit', function(){

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

    
  });
</script>     