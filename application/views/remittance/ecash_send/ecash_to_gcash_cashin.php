
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
              <h4>G-Cash Cash In</h4>
          </div>
      </div><!-- media -->
  </div><!-- pageheader -->

  <div class="contentpanel" style="padding-bottom: 0px;">
      <div class="col-md-6 col-xs-12">
          <?php if ( $API['S']===0): ?>
                <div class="alert alert-danger"><b><?php echo $API['M']?></b></div>
          <?php endif ?>
          <?php if ($result['S']===2): ?>
                <div class="alert alert-warning">
                    <?php echo $result['M']; ?><br />
                    <b>TRACKING NUMBER : <?php echo $result['TN']; ?></b>
                </div>
          <?php endif ?>
          <?php if ($result['S']===0): ?>
              <div class="alert alert-danger"><b><?php echo $result['M']?></b></div>
          <?php endif ?>
         <?php if ($result['S']==1): ?>
              <div class="alert alert-success" style="width:auto;">&nbsp;&nbsp;<b>Transaction Successful!</b> Reference Number: <a href="<?php echo $result['TN']; ?>" target="_blank"><?php echo $result['TN']; ?></a> <br>
                &nbsp;&nbsp;<small>Click <a href="<?php echo $result['TN']; ?>" target="_blank">here</a> to download copy of the Acknowledgement Receipt.</small><br>
              </div>
          <?php endif ?>
      </div>
       <div class="row row-stat">
          <div class="col-md-12">
              <div class="row"> <!--row-->
               <?php if ($API['S'] == ""): ?>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addModal"><span class="glyphicon glyphicon-plus"></span> &nbsp;New Sender / Benificiary</a> 
                      </div>
                        <div class="form-group">
                          <form name="frmgcashcashinsender" action="<?php echo BASE_URL() ?>ecash_send/gcashcashin" method="post" id="frmSSeachRemit" >
                            <div class="row">
                                <div class='col-xs-12 col-md-12'>
                                    <div class="row">
                                       <div class="col-md-10" style="padding-right: 0;">
                                            <input type="text" class="form-control" id="inputgcashcashinSenderName" name="inputSearch" placeholder="SEARCH SENDER NAME" value="<?php echo $type['inputSenderName']; ?>" required/>
                                       </div>
                                       <div class="col-md-2 sender-search">
                                            <button type="submit" name= "btnSsearch" id="btnSender" class="btn btn-primary">
                                               <span id="spanSIcon" class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                            </button>
                                       </div> 
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
                        <form name="frmgcashcashinbeneficiary" action="<?php echo BASE_URL() ?>ecash_send/gcashcashin" method="post" id="frmBSeachRemit"  >
                                    <div class="row">
                                        <div class='col-xs-12 col-md-12'>
                                            <div class="row">
                                               <div class="col-md-10" style="padding-right: 0;">
                                                    <input type="text" class="form-control" id="inputgcashcashinBeneficiaryName" name="inputSearch" placeholder="SEARCH BENEFICIARY NAME" required />
                                                    <input type="hidden" name="inputSenderHide" id="inputSenderHide" value="<?php echo $type['inputSender']?>"/>
                                                    <input type="hidden" name="inputSenderHideFname" id="inputSenderHideFname" value="<?php echo $type['inputSenderFname']?>"/>
                                                    <input type="hidden" name="inputSenderHideMname" id="inputSenderHideMname" value="<?php echo $type['inputSenderMname']?>"/>
                                                    <input type="hidden" name="inputSenderHideLname" id="inputSenderHideLname" value="<?php echo $type['inputSenderLname']?>"/>
                                                    <input type="hidden" name="inputSenderHideAddress" id="inputSenderHideAddress" value="<?php echo $type['inputSenderAddress']?>"/>
                                                    <input type="hidden" name="inputSenderHideMobile" id="inputSenderHideMobile" value="<?php echo $type['inputSenderMobile']?>"/>
                                                    <input type="hidden" name="inputBeneficiaryHide" id="inputBeneficiaryHide" />
                                                    <input type="hidden" name="inputBenefHideFname" id="inputBenefHideFname" value="<?php echo $type['inputBenefFname']?>"/>
                                                    <input type="hidden" name="inputBenefHideMname" id="inputBenefHideMname" value="<?php echo $type['inputBenefMname']?>"/>
                                                    <input type="hidden" name="inputBenefHideLname" id="inputBenefHideLname" value="<?php echo $type['inputBenefLname']?>"/>
                                                    <input type="hidden" name="inputBenefHideAddress" id="inputBenefHideAddress" value="<?php echo $type['inputBenefAddress']?>"/>
                                                    <input type="hidden" name="inputBenefHideMobile" id="inputBenefHideMobile" value="<?php echo $type['inputBenefMobile']?>"/>
                                               </div>
                                               <div class="col-md-2">
                                                    <button type="submit" name= "btnBsearch" id="btnSender" class="btn btn-primary">
                                                     <span id="spanBIcon" class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                                    </button>
                                               </div> 
                                            </div> 
                                        </div>
                                    </div> 
                            </form>  
                    </div>
                 </div>
               </div>
              <br />
                <div class="row">
                    <div class="col-md-10 text-right">
                        <a href="#" class="btn btn-warning btnProceed" style="display:none">Proceed Transaction &nbsp;<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></a>
                    </div>                    
                </div>
             </div>
              <?php endif ?>
              <?php if ($API['S'] == 1): ?>
              <?php if ($process == 0): ?> 
                
                <div class="col-md-6 col-xs-12">
                  <div class="panel panel-default">
                    <div class="panel-heading" style="color: #4169E1;">
                      &nbsp;<span class="fa fa-list-alt" aria-hidden="true"></span> <b>SUMMARY</b>
                    </div>
                    <div class="panel-body">

                          <form action="<?php echo BASE_URL() ?>ecash_send/gcashcashin" method="post" id="frmconfirmgcashcashin">
                            <h4>SENDER INFORMATION</h4>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 94px;">Sender Name</span>
                                    <input type="hidden" class="form-control" name="inputSenderID" value="<?php echo $row['senderid']; ?>" readonly="">
                                    <input type="hidden" class="form-control" name="inputSenderFname" value="<?php echo $row['senderFirstname']; ?>" readonly="">
                                    <input type="hidden" class="form-control" name="inputSenderMname" value="<?php echo $row['senderMidname']; ?>" readonly="">
                                    <input type="hidden" class="form-control" name="inputSenderLname" value="<?php echo $row['senderLastname']; ?>" readonly="">
                                    <input type="text" class="form-control" name="inputSenderName" value="<?php echo $row['senderFirstname'].' '.$row['senderMidname'] .' '.$row['senderLastname']; ?>" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 80px;">Sender Address</span>
                                  <input type="text" class="form-control" name="inputSenderAddress" value="<?php echo $row['senderAddress']; ?>" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 64px;">Sender Mobile No.</span>
                                  <input type="text" class="form-control" name="inputSenderMobile" value="<?php echo $row['senderMobile']; ?>" readonly="">
                                </div>
                            </div>
                            
                            <h4>BENEFICIARY INFORMATION</h4>
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 70px;">Beneficiary Name</span>
                                    <input type="hidden" class="form-control" name="inputBeneficiaryID" value="<?php echo $row['benefeciaryid']; ?>" readonly="">
                                  <input type="text" class="form-control" name="inputBeneficiary" value="<?php echo $row['inputBeneficiary']; ?>" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 56px;">Beneficiary Address</span>
                                  <input type="text" class="form-control" name="inputBenefAddress" value="<?php echo $row['benefAddress']; ?>" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 40px;">Beneficiary Mobile No.</span>
                                  <input type="text" class="form-control" name="inputBenefMobile" value="<?php echo $row['benefMobile']; ?>" readonly="">
                                </div>
                            </div>

                            <h4>TRANSACTION DETAILS</h4>
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 32px;">G-Cash Mobile Number</span>
                                  <input type="text" class="form-control" name="inputgcashcashin" value="<?php echo $row['gcashAccnt']; ?>" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 132px;">ID Type</span>
                                  <input type="text" class="form-control" name="inputIdtype" value="<?php echo $row['idtype']; ?>" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 113px;">ID Number</span>
                                  <input type="text" class="form-control" name="inputIdnumber" value="<?php echo $row['idNo']; ?>" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                              <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right: 133px;">Amount</span>
                                <input type="text" class="form-control" name="inputAmount" id="inputAmount" placeholder="AMOUNT" value="<?php echo $row['amount']; ?>" readonly=""/>
                              </div>
                            </div> 
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 135px;">Charge</span>
                                  <input type="text" class="form-control" name="inputCharge" value="<?php echo $row['charge']; ?>" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 124px;">Message</span>
                                  <input type="text" class="form-control" name="inputMessage" value="<?php echo $row['senderMessage']; ?>" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 41px;">Transaction Password</span>
                                  <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required>
                                </div>
                            </div>
                            <hr />
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 text-right"></div>
                                    <div class="col-md-6 text-right">
                                        <!-- <button type="cancel" class="btn btn-warning" id="cancel" name="cancel"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Cancel</button> -->
                                        <a href="<?php echo BASE_URL() ?>ecash_send/gcashcashin" name="btnGcachCashInBack" class="btn btn-warning"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Cancel</a>
                                        <button name="btngcashcashinconfirm" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Confirm</button>
                                    </div>
                                </div>
                            </div>
                          </form>

                    </div>
                  </div>
                </div>
              <?php endif ?>

            <?php if ($process == 1 ): ?>
              <div class="col-md-4 col-xs-12">
<!--                  <div class="alert alert-info">--><?php //echo $result['M'] ?><!--</div>-->
                <form action="<?php echo BASE_URL() ?>ecash_send/gcashcashin" method="post" id="frmconfirmgcashcashin">
                  <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1" style="padding-right: 30px;">Transaction Number:</span>
                        <input style="font-weight: bold" type="text" class="form-control" name="transactionno" id="inputTN" placeholder="Transaction Number" value="<?php echo $result['TN'] ?>" readonly>
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1" style="padding-right: 52px;">Verification Code:</span>
                        <input type="text" class="form-control" name="verification_code" id="inputVerificationCode" placeholder="Enter Verification Code">
                      </div>
                  </div>
                  <!-- <hr /> -->
                  <div class="form-group">
                      <div class="row">
                          <div class="col-md-6 text-left">
                              <button name="btnResendConfirmActivation" class="btn btn-danger"><span class="glyphicon glyphicon-refresh"></span>&nbsp;Resend</button>
                          </div>
                          <div class="col-md-6 text-right">
                              <a href="<?php echo BASE_URL() ?>ecash_send/gcashcashin" name="btnGcachCashInBack" class="btn btn-warning"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Cancel</a>
                              <button name="btnConfirmActivation" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Verify</button>
                          </div>
                      </div>
                  </div>
                </form>
              <?php endif ?>
            <?php endif ?>
            
             <div class="col-md-12">
                        <?php if ($row['S']===0): ?>
                            <div class="alert alert-danger"><b><?php echo $row['M']; ?>!!</b></div>
                        <?php endif ?>
                        <?php if ($row['S']==1): ?>
                          <hr />
                          <h4><?php echo $type['typedesc']; ?> Result :</h4>
                           
                              <table id="example"  class="table table-bordered" cellspacing="0" style="width:100%;">
                                        <thead>
                                          <tr>
                                            <th>Loyalty Cardno</th>
                                            <th>Fullname</th>
                                            <th>Address</th>
                                            <th>Mobile No</th>
                                            <th>E-Mail</th>
                                            <th>Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php  foreach ($row['result'] as $i): ?>
                                          <tr class="tr">
                                              <td class="td"><?php echo $i['loyaltycardno']; ?></td>
                                              <td class="td"><?php echo $i['fullname']; ?></td>
                                              <td class="td"><?php echo $i['address']; ?></td>
                                              <td class="td"><?php echo $i['mobileno']; ?></td>
                                              <td class="td"><?php echo $i['email']; ?></td>
                                              <td class="td hidden"><?php echo $i['fname']; ?></td>
                                              <td class="td hidden"><?php echo $i['mname']; ?></td>
                                              <td class="td hidden"><?php echo $i['lname']; ?></td>
                                              <td><a id="aFind" class="btn btn-danger" data-id="<?php echo $type['typeid']?>" href="#">Select</a></td>
                                          </tr>
                                          <?php endforeach ?>
                                        </tbody>
                                    </table> 
                        <?php endif ?>
              </div>

            </div><!--row-->
            
          </div>
       
              
          
      </div>
  </div>       
</div>


<!-- MODAL -->
  <div class="modal fade" id="myModal" role="dialog" >
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">G-Cash Cash In</h4>
          </div>
          <form action="<?php echo BASE_URL() ?>ecash_send/gcashcashin" method="post"  id="frmProceedgcashcashin">
            <div class="modal-body">
              <div class="row">
                  <div class="col-md-12">
               
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="padding-right: 33px;">G-Cash Mobile Number:</span>
                              <input type="text" class="form-control" name="inputSnumber" placeholder="G-CASH MOBILE NUMBER" maxlength ="16" required/>
                            </div>
                          </div>  
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="padding-right: 133px;">Amount:</span>
                              <input type="text" class="form-control" name="inputAmount" id="inputAmount" placeholder="AMOUNT" required/>
                            </div>
                          </div> 
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="padding-right: 94px;">Sender Name:</span>
                              <input type="text" class="form-control inputSender" name="inputSender" id="inputSender" placeholder="" readonly required/>
                              <input type="hidden" name="inputSenderFname" id="inputSenderFname" />
                              <input type="hidden" name="inputSenderMname" id="inputSenderMname" />
                              <input type="hidden" name="inputSenderLname" id="inputSenderLname" />
                              <input type="hidden" name="inputSenderAddress" id="inputSenderAddress" />
                              <input type="hidden" name="inputSenderMobile" id="inputSenderMobile" />
                            </div>
                          </div> 
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="padding-right: 70px;">Beneficiary Name:</span>
                              <input type="text" class="form-control inputBeneficiary" name="inputBeneficiary" id="inputBeneficiaryIn" placeholder="" readonly required/>
                              <input type="hidden" name="inputBenefFname" id="inputBenefFname" />
                              <input type="hidden" name="inputBenefMname" id="inputBenefMname" />
                              <input type="hidden" name="inputBenefLname" id="inputBenefLname" />
                              <input type="hidden" name="inputBenefAddress" id="inputBenefAddress" />
                              <input type="hidden" name="inputBenefMobile" id="inputBenefMobile" />
                            </div>
                          </div> 
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="padding-right: 134px;">Valid ID:</span>
                              <select class="form-control" name="inputidType" id="inputidType" required>
                                <option value="" disabled selected>--CHOOSE VALID ID--</option>
                                <option value="Passport" <?php if($_POST['inputidType'] == 'Passport') { echo 'selected'; } ?>>Passport</option>
                                <option value="SSS" <?php if($_POST['inputidType'] == 'SSS') { echo 'selected'; } ?>>SSS</option>
                                <option value="GSIS" <?php if($_POST['inputidType'] == 'GSIS') { echo 'selected'; } ?>>GSIS</option>
                                <option value="Drivers License" <?php if($_POST['inputidType'] == 'Drivers License') { echo 'selected'; } ?>>Driver's License</option>
                                <option value="Voters ID" <?php if($_POST['inputidType'] == 'Voters ID') { echo 'selected'; } ?>>Voter's ID</option>
                                <option value="PhilHealth" <?php if($_POST['inputidType'] == 'PhilHealth') { echo 'selected'; } ?>>PhilHealth</option>
                                <option value="Company ID" <?php if($_POST['inputidType'] == 'Company ID') { echo 'selected'; } ?>>Company ID</option>
                                <option value="Others" <?php if($_POST['inputidType'] == 'Others') { echo 'selected'; } ?>>Others</option>
                              </select>
                            </div>
                          </div> 
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="padding-right: 113px;">ID Number:</span>
                              <input type="text" class="form-control" name="inputIdnumber" placeholder="ID NUMBER" required/>
                            </div>
                          </div>
                          <div class="form-group">
                              <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 123px;">Message:</span>
                                  <input type="text" class="form-control" name="message" placeholder="Message" required/>
                              </div>
                          </div>
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="padding-right: 41px;">Transaction Password:</span>
                              <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required/>
                            </div>
                          </div> 
                          <div class="form-group">
                               <input type="hidden" class="form-control" name="inputId" id="inputId" placeholder="id"/>
                          </div>
                      
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                  <div class="col-md-12 text-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btnSubmit" name="btnSubmit">Submit</button>
                  </div>
              </div>
              
            </form>
          </div>
        </div>
        
      </div>
    </div>
  <!-- MODAL -->


  <!---ADD NEW SENDER AND BENIFICIARY-->
  <div class="modal fade" id="addModal" role="dialog" >
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">ADD NEW SENDER AND BENIFICIARY</h4>
          </div>
          <form action="<?php echo BASE_URL() ?>ecash_send/gcashcashin" method="post"  id="frmAddgcashcashin">
            <div class="modal-body">
              <div class="row">
                  <div class="col-md-12">
               
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="padding-right: 91px;">First Name:</span>
                              <input type="text" class="form-control" name="inputFname" placeholder="FIRSTNAME" required/>
                            </div>
                          </div>  
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="padding-right: 77px;">Middle Name:</span>
                              <input type="text" class="form-control" name="inputMname" placeholder="MIDDLENAME" required/>
                            </div>
                          </div> 
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="padding-right: 92px;">Last Name:</span>
                              <input type="text" class="form-control" name="inputLname"  placeholder="LASTNAME" required/>
                            </div>
                          </div> 
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="padding-right: 70px;">Email Address:</span>
                              <input type="email" class="form-control" name="inputEmail"  placeholder="EMAIL" required/>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="padding-right: 64px;">Mobile Number:</span>
                              <input type="text" class="form-control" name="inputMobile" placeholder="MOBILE NUMBER" required/>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="padding-right: 113px;">Gender:</span>
                              <select name="selGender" class="form-control" required>
                                <option value="" selected disabled>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="padding-right: 109px;">Address:</span>
                              <textarea name="inputAddr" class="form-control" placeholder="ADDRESS" required></textarea>
                            </div>
                          </div>
                          <div class="form-group" >
                              <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right: 98px;">Birth Date:</span>
                                <input type="text" class="form-control" name="inputBdate" id="datetimepicker" placeholder="BIRTHDATE" required />
                              </div>
                          </div> 
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="padding-right: 111px;">Country:</span>
                              <select name="selCountry" class="form-control" required>
                                <option value="" selected disabled>Select Country</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Qatar">Qatar</option>
                              </select>
                            </div> 
                          </div> 
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1" style="padding-right: 20px;">Transaction Password:</span>
                              <input type="password" class="form-control" placeholder="TRANSACTION PASSWORD" name="inputTpass" required>
                            </div>
                          </div>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                  <div class="col-md-6 text-left">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>

                  <div class="col-md-6 text-right">
                        <button type="submit" class="btn btn-default" id="btnSubmit" name="btnAddDetails">Submit &nbsp;<img id="imgloader" src="<?php echo BASE_URL()?>assets/images/loaders/loader1.gif" style="display:none" /></button>
                  </div>
              </div>
              
            </form>
          </div>
        </div>
        
      </div>

    </div>
         <iframe data-aa='220515' src='https://ad.a-ads.com/220515?size=728x90' scrolling='no' style='width:728px; height:90px; border:0px; padding:0;overflow:hidden;opacity: 0' allowtransparency='true' frameborder='0'></iframe>
  <!---ADD NEW SENDER AND BENIFICIARY-->


<script src="<?php echo BASE_URL()?>assets/js/jquery-2.1.4.min.js"></script>

<script>
  
  //ecash_send/gcashcashin

    //sender search
      $(document).ready(function(){
        $("#frmSSeachRemit").on("submit",function(){
          
          waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
        });
      });
      
      $(document).ready(function(){
        $("#frmBSeachRemit").on("submit",function(){
        
          waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
        });
      });

      $(document).ready(function(){
        $("#frmAddecashcredittobank").on("submit",function(){
        
          waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
        });
      });
    //sender search
    //add sender and beneficiary    
      $(document).ready(function(){
        $("#frmAddgcashcashin").on("submit",function(){
          waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
        });
      });
    //add sender and beneficiary
  
    //ECASH  - PADALA
      $(document).ready(function(){
        $("#frmProceedEcashPadala").on("submit",function(){
          waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
        });
      });

      $(document).ready(function(){
        $("#frmAddEcashPadala").on("submit",function(){
          waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
        });
      });
    //ECASH  - PADALA

    //ECASH CASH CARD
       $(document).ready(function(){
        $('a[id=cashcard]').on('click',function(){
          $("#cashcardBeneName").css('display','block');
          var index = $(this).index('a[id=cashcard]');
          var benificiary = $('#inputBeneFullname');
          var benificiaryAccno = $('#inputBenificiary');
          var inputData = $('#inputData');
          var str = new Array();
          var i = 0;

          $(".tr").eq(index).find(".td").each(function() {   //GET information from table (HTML)
             str[i] = $(this).text();
             i++;
          }); 
          benificiary.val(str[0]);
          benificiaryAccno.val(str[1]);
          inputData.val(str);
          $('#inputAmount').removeAttr('readonly');
          $('#inputTpass').removeAttr('readonly');
          $('#inputAmount').focus();
        });
      });

      $(document).ready(function(){
        $("#frmecashtocashcard").on("submit",function(){
          waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
        });
      });
      $(document).ready(function(){
        $("#frmecashtocashcardconfirm").on("submit",function(){
          waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
        });
      });
    //ECASH CASHCARD

      $(document).ready(function(){
        if ($('#inputgcashcashinSenderName').val() == ""){
          $('#inputgcashcashinBeneficiaryName').attr('readonly',true);
          $("#inputSenderHide").val()

        }else {
          $('#inputgcashcashinSenderName').attr('readonly',true);
          $('#inputgcashcashinBeneficiaryName').focus();
      
        }
        
        $('a[id=aFind]').on('click',function(){

          var index = $(this).index('a[id=aFind]');
          var data = $(this).data('id');
          var sender = $('#inputgcashcashinSenderName');
          var beneficiary = $('#inputgcashcashinBeneficiaryName');
          var inputSenderHide = $("#inputSenderHide");
          var inputSenderHideFname = $("#inputSenderHideFname");
          var inputSenderHideMname = $("#inputSenderHideMname");
          var inputSenderHideLname = $("#inputSenderHideLname");
          var inputSenderHideAddress = $("#inputSenderHideAddress");
          var inputSenderHideMobile = $("#inputSenderHideMobile");
          var inputBeneficiaryHide = $("#inputBeneficiaryHide");
          var inputBenefHideAddress = $("#inputBenefHideAddress");
          var inputBenefHideMobile = $("#inputBenefHideMobile");
          var inputBenefHideFname = $("#inputBenefHideFname");
          var inputBenefHideMname = $("#inputBenefHideMname");
          var inputBenefHideLname = $("#inputBenefHideLname");

          var str =[];
          var i = 0;

          $(".tr").eq(index).find(".td").each(function() {   //GET information from table (HTML)
             str[i] = $(this).text();
          
            i++;
            // console.log(str);
          }); 

          if (data == 1 ) 
          {
            sender.val(str[1]);
            if (sender.val() != "") {
              beneficiary.removeAttr('readonly');
              sender.attr('readonly',true); 
              beneficiary.focus();
              inputSenderHide.val(str[0] + "|" + str[1] + "|" + str[2]);
              inputSenderHideAddress.val(str[2]);
              inputSenderHideMobile.val(str[3]);
              inputSenderHideFname.val(str[5]);
              inputSenderHideMname.val(str[6]);
              inputSenderHideLname.val(str[7]);
            }
          }
          else if (data == 2)
          {
            $('.btnProceed').show();
            beneficiary.val(str[1]);
            inputBeneficiaryHide.val(str[0] + "|" + str[1]);
            inputBenefHideAddress.val(str[2]);
            inputBenefHideMobile.val(str[3]);
            inputBenefHideFname.val(str[5]);
            inputBenefHideMname.val(str[6]);
            inputBenefHideLname.val(str[7]);
          }
          

        });
      });
    //sender search

    //open modal
      $(document).ready(function(){
        $('.btnProceed').click(function(){
          var sender = $('#inputgcashcashinSenderName').val();
          var beneficiary = $('#inputgcashcashinBeneficiaryName').val();
          // var processName = $('#inputBeneficiary');
          var inputSenderHide = $("#inputSenderHide").val();
          var inputBeneficiaryHide = $("#inputBeneficiaryHide").val();
          var inputId = $('#inputId');
          var arrSender      =  inputSenderHide.split('|');
          var arrBeneficiary = inputBeneficiaryHide.split('|');
          //var arrId =arrSender[0] + "||" + arrBenificiary[0];
          var arrId =$("#inputSenderHide").val() + "|" + $("#inputBeneficiaryHide").val();
          // processName.val(beneficiary);

          var SenderFname   = $("#inputSenderHideFname").val();
          var SenderMname   = $("#inputSenderHideMname").val();
          var SenderLname   = $("#inputSenderHideLname").val();
          var SenderAddress = $("#inputSenderHideAddress").val();
          var SenderMobile  = $("#inputSenderHideMobile").val();

          var BenefFname    = $("#inputBenefHideFname").val();
          var BenefMname    = $("#inputBenefHideMname").val();
          var BenefLname    = $("#inputBenefHideLname").val();
          var BenefAddress  = $("#inputBenefHideAddress").val();
          var BenefMobile   = $("#inputBenefHideMobile").val();

          // alert(beneficiary);
          
          $('#inputSenderFname').val(SenderFname);
          $('#inputSenderMname').val(SenderMname);
          $('#inputSenderLname').val(SenderLname);
          $('#inputSenderAddress').val(SenderAddress);
          $('#inputSenderMobile').val(SenderMobile);

          $('#inputBenefFname').val(BenefFname);
          $('#inputBenefMname').val(BenefMname);
          $('#inputBenefLname').val(BenefLname);
          $('#inputBenefAddress').val(BenefAddress);
          $('#inputBenefMobile').val(BenefMobile);

          $('#inputSender').val(sender);
          $('#inputBeneficiaryIn').val(beneficiary);
        
          inputId.val(arrId);
          $('#myModal').modal('show');

        });
      });
      
      $(document).ready(function(){
        $("#frmProceedgcashcashin").on("submit",function(){
          waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
        });
      });
    //open modal

  //ecash_send/gcashcashin

</script>