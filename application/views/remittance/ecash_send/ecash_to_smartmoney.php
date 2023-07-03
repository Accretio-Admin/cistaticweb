
<div class="mainpanel">
  <div class="pageheader">
      <div class="media">
          <div class="pageicon pull-left">
              <i class="fa fa-money"></i>
          </div>
          <div class="media-body">
              <ul class="breadcrumb">
                  <li><a href="<?php echo BASE_URL('/Main')?>#"><i class="glyphicon glyphicon-home"></i></a></li>
                  <li>ECASH</li>
              </ul>
              <h4>E-Cash To SmartMoney</h4>
          </div>
      </div><!-- media -->
  </div><!-- pageheader -->

  <div class="contentpanel" style="padding-bottom: 0px;">
  <?php if ($API['S']===0): ?>
        <div class="alert alert-danger"><b><?php echo $API['M']?></b></div>
  <?php endif ?>
  <?php if ($result['S']===0): ?>
        <div class="alert alert-danger"><b><?php echo $result['M']?></b></div>
  <?php endif ?>
 <?php if ($result['S']==1): ?>
        <div class="alert alert-success">
            <?php echo $result['M']; ?><br />
            <b>TRACKING NUMBER : <?php echo $result['TN']; ?></b>
        </div>
  <?php endif ?>
       <div class="row row-stat">
          <div class="col-md-12">
              <div class="row"> <!--row-->
               <?php if ($API['S'] == ""): ?>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-12">
                      <!-- Check Smart Money Send Status -->
                      <?php foreach ($API as $i): ?>
                        <?php if ($i['status'] == 1): ?>
                        <div class="alert alert-warning" style="color:red;"><b>* This service is temporarily unavailable.</b></div>
                        <?php endif ?>
                      <?php endforeach ?>
                      <!-- Check Smart Money Send Status -->
                        <div class="form-group">
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addModal"><span class="glyphicon glyphicon-plus"></span> &nbsp;New Sender / Beneficiary</a> 
                      </div>
                        <div class="form-group">
                          <form name="frmecashtosmartmoneysender" action="<?php echo BASE_URL() ?>ecash_send/ecashtosmartmoney" method="post" id="frmSSeachRemit" >
                            <div class="row">
                                <div class='col-xs-12 col-md-12'>
                                    <div class="row">
                                       <div class="col-md-10">
                                            <input type="text" class="form-control" id="inputsmartmoneySenderName" name="inputSearch" placeholder="SEARCH SENDER NAME" value="<?php echo $type['inputSenderName']; ?>" required/>
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
                        <form name="frmecashtosmartmoneybeneficiary" action="<?php echo BASE_URL() ?>ecash_send/ecashtosmartmoney" method="post" id="frmBSeachRemit"  >
                                    <div class="row">
                                        <div class='col-xs-12 col-md-12'>
                                            <div class="row">
                                               <div class="col-md-10">
                                                    <input type="text" class="form-control" id="inputsmartmoneyBeneficiaryName" name="inputSearch" placeholder="SEARCH BENEFICIARY NAME" required />
                                                    <input type="hidden" name="inputSenderHide" id="inputSenderHide" value="<?php echo $type['inputSender']?>"/>
                                                    <input type="hidden" name="inputBeneficiaryHide" id="inputBeneficiaryHide" />
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
                <h4 style="padding-left: 1.5%;">SUMMARY</h4>
                <hr />
                <div class="col-md-6 col-xs-12">
                    <form action="<?php echo BASE_URL() ?>ecash_send/ecashtosmartmoney" method="post" id="frmconfirmsmartmoney">
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1">SMARTMONEY NO.</span>
                          <input type="text" class="form-control" name="inputSmartmoney" value="<?php echo $row['smartmoneyno']; ?>" readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 64px;">SENDER ID</span>
                          <input type="text" class="form-control" name="inputSenderid" value="<?php echo $row['senderid']; ?>" readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 60px;">MOBILE NO.</span>
                          <input type="text" class="form-control" name="inputSenderMobile" value="<?php echo $row['sender_mobileno']; ?>" readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 31.5px;">BENEFICIARY ID</span>
                          <input type="text" class="form-control" name="inputBeneficiaryId" value="<?php echo $row['beneficiaryid']; ?>" readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 48.5px;">BENEFICIARY</span>
                          <input type="text" class="form-control" name="inputBeneficiary" value="<?php echo $row['inputBeneficiary']; ?>" readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 60px;">MOBILE NO.</span>
                          <input type="text" class="form-control" name="inputBeneMobile" value="<?php echo $row['bene_mobileno']; ?>" readonly="">
                        </div>
                    </div> 
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 87px;">ID TYPE</span>
                          <input type="text" class="form-control" name="inputIdtype" value="<?php echo $row['idtype']; ?>" readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 63px;">ID NUMBER</span>
                          <input type="text" class="form-control" name="inputIdnumber" value="<?php echo $row['idNo']; ?>" readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 81.5px;">AMOUNT</span>
                          <input type="text" class="form-control" name="inputAmount" value="<?php echo $row['inputAmount']; ?>" readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 82.3px;">CHARGE</span>
                          <input type="text" class="form-control" name="inputCharge" value="<?php echo $row['charge']; ?>" readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 61px;">PASSWORD</span>
                          <input type="password" class="form-control" name="inputTpass">
                        </div>
                    </div>
                    <div class="form-group" id="spanbtnsmartmoneyconfirm" style="display: none;">
                        <div class="alert alert-info">
                          <strong>Please wait, this process takes a while.</strong> 
                        </div>
                    </div>

                    
                    <hr>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6 text-right"></div>
                            <div class="col-md-6 text-right">
                                <button type="cancel" class="btn btn-warning" id="cancel" name="cancel"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Cancel</button>
                                <button name="btnsmartmoneyconfirm" id="btnsmartmoneyconfirm" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Confirm</button><br>
                                

                                <script>
                                $("#btnsmartmoneyconfirm").click(function(){
                                  $("#spanbtnsmartmoneyconfirm").show();
                                });
                                </script>
                            </div>
                        </div>
                    </div>
                  </form>
                </div>
              <?php endif ?>

            <?php if ($process == 1 ): ?>
              <div class="col-md-6 col-xs-12">
                <p><?php echo $result['M'] ?></p>
                <form class="form-horizontal" method="post" action="<?php echo BASE_URL() ?>ecash_send/ecashtosmartmoney">
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label" style="padding-right:3px;">Transaction Number:</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="transactionno" id="inputTN" placeholder="Transaction Number" value="<?php echo $result['TN'] ?>" readonly>
                    </div>
                    </div>
                    <div class="form-group">
                      <label for="inputVerification" class="col-sm-3 control-label" style="padding-right:3px;">Verification Code:</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="verification_code" id="inputVerificationCode" placeholder="Enter Verification Code">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <div class="col-sm-8">
                            <!-- <a class="btn btn-default pull-right" style="width: 100px;" href="<?php echo base_url() ?>">Cancel</a> -->
                            <button type="cancel" class="btn btn-default pull-right" id="cancel" name="cancel">&nbsp;Cancel</button>
                          </div>
                          <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary pull-right" name="btnConfirmActivation" style="width: 100px;">Verify</button>
                          </div>
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
                                              <td><?php echo $i['address']; ?></td>
                                              <td class="td"><?php echo $i['mobileno']; ?></td>
                                              <td><?php echo $i['email']; ?></td>
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
            <h4 class="modal-title">SMARTMONEY</h4>
          </div>
          <form action="<?php echo BASE_URL() ?>ecash_send/ecashtosmartmoney" method="post"  id="frmProceedSmartmoney">
            <div class="modal-body">
              <div class="row">
                  <div class="col-md-12">
                          <div class="form-group">
                              <input type="text" class="form-control" name="inputSnumber" placeholder="SMARTMONEY NUMBER" pattern="\d*" maxlength ="16" required/>
                          </div>  
                           <div class="form-group">
                              <input type="text" class="form-control inputAmount" name="inputAmount" placeholder="AMOUNT" required/>
                          </div> 
                          <h5 style="padding-left: 1%;"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <strong>SENDER DETAILS</strong></h5>
                          <div class="form-group">
                              <input type="text" class="form-control" name="inputSender"  id="inputSender" placeholder="" readonly required/>
                          </div> 
                           <div class="form-group">
                              <input type="text" class="form-control" name="inputSenderMobile" id="inputSenderMobile" pattern="[0]{1}[9]{1}[0-9]{9}" maxlength ="11" placeholder="MOBILE NUMBER" required/>
                          </div> 
                          <h5 style="padding-left: 1%;"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <strong>BENEFICIARY DETAILS</strong></h5>
                          <div class="form-group">
                              <input type="text" class="form-control" name="inputBeneficiary"  id="inputBeneficiary" placeholder="" readonly required/>
                          </div> 
                           <div class="form-group">
                              <input type="text" class="form-control" name="inputBeneMobile" id="inputBeneMobile" pattern="[0]{1}[9]{1}[0-9]{9}" maxlength ="11" placeholder="MOBILE NUMBER" required/>
                          </div>
                           <div class="form-group">
                              <input type="text" class="form-control" name="inputidType" placeholder="ID TYPE" required/>
                          </div> 
                           <div class="form-group">
                              <input type="text" class="form-control" name="inputIdnumber" placeholder="ID NUMBER" required/>
                          </div> 
                           <div class="form-group">
                              <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required/>
                          </div> 
                          <div class="form-group">
                               <input type="hidden" class="form-control" name="inputId" id="inputId" placeholder="id"/>
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
                        <button type="submit" class="btn btn-default" id="btnSubmit" name="btnSubmit">Submit &nbsp;<img id="imgloader" src="<?php echo BASE_URL()?>assets/images/loaders/loader1.gif" style="display:none" /></button>
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
            <h4 class="modal-title">ADD NEW SENDER AND BENEFICIARY</h4>
          </div>
          <form action="<?php echo BASE_URL() ?>ecash_send/ecashtosmartmoney" method="post"  id="frmAddSmartmoney">
            <div class="modal-body">
              <div class="row">
                  <div class="col-md-12">
               
                          <div class="form-group">
                              <input type="text" class="form-control" name="inputFname" placeholder="FIRSTNAME" required/>
                          </div>  
                           <div class="form-group">
                              <input type="text" class="form-control" name="inputMname" placeholder="MIDDLENAME" required/>
                          </div> 
                           <div class="form-group">
                              <input type="text" class="form-control" name="inputLname"  placeholder="LASTNAME" required/>
                          </div> 
                           <div class="form-group">
                              <input type="email" class="form-control" name="inputEmail"  placeholder="EMAIL" required/>
                          </div>
                          <div class='col-md-8' style="padding-left:0px!important">
                             <div class="form-group" >
                                <input type="text" class="form-control" name="inputMobile" pattern="[0]{1}[9]{1}[0-9]{9}" maxlength ="11" placeholder="MOBILE NUMBER" required/>
                            </div> 
                          </div>
                           <div class='col-md-4'>
                             <div class="form-group">
                                <select name="selGender" class="form-control" required>
                                    <option value="" selected disabled>GENDER</option>
                                    <option value="Male">MALE</option>
                                    <option value="Femal">FEMALE</option>
                                </select>
                            </div> 
                          </div>
                           <div class="form-group"> 
                              <textarea name="inputAddr" class="form-control" placeholder="ADDRESS" required></textarea>
                          </div> 
                          <div class='col-md-8' style="padding-left:0px!important">

                             <div class="form-group" >
                                 <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1" required>BIRTHDATE</span>
                                  <input type="text" class="form-control" name="inputBdate" id="datetimepicker" placeholder="BIRTHDATE" readonly required />
                                </div>

                            </div> 
                          </div>
                           <div class='col-md-4'>
                             <div class="form-group">
                                <select name="selCountry" class="form-control" required>
                                    <option value="" selected disabled>COUNTRY</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Singapore">Singapore</option>
                                    <option value="Qatar">Qatar</option>
                                </select>
                            </div> 
                          </div>
                          <div class="form-group">
                              <input type="password" class="form-control" placeholder="TRANSACTION PASSWORD" name="inputTpass" required>
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

