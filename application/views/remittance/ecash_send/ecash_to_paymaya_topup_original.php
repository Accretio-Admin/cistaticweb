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
          <h4>ECASH TO PAYMAYA</h4>
      </div>
    </div>
  </div>

  <div class="contentpanel" style="padding-bottom: 0px;">
    <!-- <div class="col-lg-12"> 
      <div class="row" style="margin-bottom: 30px;">
        <ul class="nav nav-tabs">
          <li class="active"><a href="<?php echo BASE_URL()?>ecash_send/ecashtopaymaya" style="color: #428bca;"><b>SENDING</b></a></li> 
          <li><a href="<?php echo BASE_URL()?>ecash_send/logs_ecashtopaymaya">PENDING</a></li>  
          <li><a href="<?php echo BASE_URL()?>ecash_send/done_ecashtopaymaya">DONE</a></li> 
        </ul>
      </div>
    </div> -->
      
    <div class="col-lg-12"> 
      <div class="row">
        
          <div style="display:none; text-align: center;" id="alertDynammic"></div>
          <?php if(isset($API)):?>
          <?php if ($API['S']===0): ?>
                <div class="alert alert-danger"><b> <i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo $API['M']?></b></div>
          <?php endif; ?>
          <?php if ($API['S']==1): ?>
                <div class="alert alert-success"><b> <i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo $API['M']?></b></div>
          <?php endif; ?>

          <?php if ($API['S']==3): ?>
                <div class="alert alert-warning"><b> <i class="fa fa-check" aria-hidden="true"></i> <?php echo $API['M']?></b></div>
          <?php endif; ?>

        <?php endif; ?>

        <?php 
          $msgAdd = $this->session->flashdata('msgAdd');
          if ($msgAdd['S']==1): ?>
            <div class="alert alert-success">
                <i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo $msgAdd['M']; ?></b>
            </div>
        <?php endif ?>

        <?php 
          $msg = $this->session->flashdata('msg');
          if ($msg['S']==1): ?>
            <!-- <div class="alert alert-success">
                <i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo $msg['M']; ?></b>
            </div> -->

            <div class="alert alert-success">&nbsp;&nbsp;<b><i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo $msg['M'] ?>.</b> Tracking Number: <a href="<?php echo $msg['URL']; ?>" target="_blank"><?php echo $msg['TN'];  ?></a><br>
                  &nbsp;&nbsp;<small>Click <a href="<?php echo $msg['URL']; ?>" target="_blank">here</a> to download copy of the Acknowledgement Receipt.</small>
              </div>
        <?php endif ?>

        <?php 
          $msg = $this->session->flashdata('msg');
          if ($msg['S']==2 || $msg['S']==3): ?>
            <div class="alert alert-warning">
                <i class="fa fa-check" aria-hidden="true"></i> <?php echo $msg['M']; ?></b>
            </div>
        <?php endif ?>
      </div>
    </div>

    <?php //if (isset($details) && $details['process'] == 0) { ?>
      <div class="row row-stat" id="stepOne">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-12">
                  <!-- <div class="form-group">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addModal"><span class="glyphicon glyphicon-plus"></span> &nbsp;New Sender / Beneficiary</a> 
                  </div> -->
                  <div class="form-group">
                    <a href="<?php echo BASE_URL() ?>ecash_send/paymaya_checkrefno" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-list"></span> &nbsp;Check Status</a> 
                    <!-- <a href="<?php echo BASE_URL() ?>ecash_send/paymaya_unhold" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-plus"></span> &nbsp;Verify Unhold</a>  -->
                  </div>
                  
                  <div class="form-group">
                    <form name="frmecashpadalasender" action="<?php echo BASE_URL() ?>Ecash_send_jrlvaldez/ecashtopaymaya" method="post" id="frmSSeachRemit" >
                      <div class="row">
                        <div class='col-xs-12 col-md-12'>
                          <div class="row">
                            <div class="col-md-8">
                              <input type="text" class="form-control" id="inputPaymayaSenderName" name="inputSearch" placeholder="SEARCH SENDER NAME" value="<?php echo (isset($type['inputSenderName']) ? $type['inputSenderName']:""); ?>" required/>
                            </div>
                            <div class="col-md-4 sender-search">
                              <button type="submit" name="btnSsearch" id="btnSender" class="btn btn-primary">
                                <span id="spanSIcon" class="glyphicon glyphicon-search" aria-hidden="true"></span>
                              </button>
                              &nbsp;
                              <a href="#" class="btn btn-info" data-toggle="modal" data-target="#addModal"><span class="glyphicon glyphicon-plus"></span></a>
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
                    <form name="frmecashpadalabeneficiary" action="<?php echo BASE_URL() ?>Ecash_send_jrlvaldez/ecashtopaymaya" method="post" id="frmBSeachRemit" >
                      <div class="row">
                        <div class='col-xs-12 col-md-12'>
                          <div class="row"> 
                            <div class="col-md-8">
                              <input type="text" class="form-control" id="inputPaymayaBeneficiaryName" name="inputSearch" placeholder="SEARCH BENEFICIARY NAME" required />
                              <input type="hidden" name="inputSenderHide" id="inputSenderHide" value="<?php echo (isset($type['inputSender']) ? $type['inputSender']:"")?>"/>
                              <input type="hidden" name="inputBenificiaryHide" id="inputBeneficiaryHide" />
                            </div>
                          <div class="col-md-4">
                                          <button type="submit" name="btnBsearch" id="btnBene" class="btn btn-primary">
                                            <span id="spanBIcon" class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                          </button>
                                          &nbsp;
                                          <a href="#" class="btn btn-info" data-toggle="modal" data-target="#addBenefModal"><span class="glyphicon glyphicon-plus"></span></a> 
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
                    <div class="col-md-8 text-right">
                        <a href="#" class="btn btn-warning btnProceedWestern" style="display:none">Proceed Transaction &nbsp;<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></a>
                    </div>
                </div>
              </div>

              <div class="col-md-12">
                <?php  //var_dump($row); ?>
                <?php if ($result === 0): ?>
                    <div class="alert alert-danger"><b><?php echo $row['M']; ?>!!</b></div>
                <?php endif ?>
                <?php if ($result == 1): ?>
                  <hr />
                  <h4><?php echo (isset($type['typedesc']) ? $type['typedesc']:""); ?> Result :</h4>
                    
                    <table <?php echo Count($row) > 0 ? 'id="example"':"";?>  class="table table-bordered" cellspacing="0" style="width:100%;">
                        <thead>
                          <tr>
                            <!-- <th>Registered By</th> -->
                            <th>Fullname</th>
                            <th>BirthDate</th>
                            <th>Mobile No</th>
                            <th>Occupation</th>
                            <th>Action</th>
                          </tr>
                        </thead>

                        <tbody>

                          <?php
                          if (count($row)>0):
                            foreach ($row as $i): ?>
                          <tr class="tr">
                              <td class="td" hidden><?php echo $type['typedesc'] == 'Sender' ? $i['customerId'] : $i['beneficiaryId']; ?></td>
                              <td class="td"><?php echo $i['firstName'].' '.$i['middleName'].' '.$i['lastName']; ?></td>
                              <td class="td"><?php echo $type['typedesc'] == 'Sender' ? date('Y-m-d', strtotime($i['birthDate'])):"-"; ?></td>
                              <td class="td"><?php echo $type['typedesc'] == 'Sender' ? $i['mobileNumber']:"-"; ?></td>
                              <td class="td"><?php echo $type['typedesc'] == 'Sender' ? $i['occupation'] :"-"; ?></td>
                              <td class="td" hidden><?php echo $i['firstName'].'|'.$i['middleName'].'|'.$i['lastName']; ?></td>
                              <td class="td" hidden><?php echo $i['birthDate']; ?></td>
                              <td><a id="aFindPaymaya" class="btn btn-danger" data-id="<?php echo $type['typeid'].'|'.'SEND'?>" href="#">Select</a></td>
                          </tr>
                          <?php endforeach; 
                          else:?>
                            <tr>
                              <td colspan="8" style="text-align:center"> No Results Found</td>
                            </tr>
                          <?php endif;?>
                            
                        </tbody>
                    </table>
                              
                <?php endif ?>
              </div>
            </div>
          </div>
      </div>

      <div class="row" id="stepTwo" style="display: none;">
        <div class="col-md-6">
          <form id="frmPaymayaSender">
            <div class="form-group"><h4>SENDER</h4></div>
              <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 64px;">FULL NAME:</span>
                    <input type="text" class="form-control" name="inputSenderName" id="inputSenderName" readonly="">
                  </div>
              </div>
              <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 65px;">BIRTHDATE:</span>
                    <input type="text" class="form-control" name="inputSenderBday" id="inputSenderBday"  readonly="">
                  </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 61px;">MOBILE NO.:</span>
                  <input type="text" class="form-control" name="inputMobileNo" id="inputMobileNo" readonly="">
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 72px;">Occupation:</span>
                  <input type="text" class="form-control" name="inputSenderOccupation" id="inputSenderOccupation" readonly="">
                </div>
              </div>
              <div class="form-group"><h4>BENEFICIARY</h4></div>
              <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 65px;">FULL NAME:</span>
                    <input type="text" class="form-control" name="inputBeneficiaryName" id="inputBeneficiaryName" readonly="">
                  </div>
              </div>
              <!-- <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 76px;">ADDRESS:</span>
                    <input type="text" class="form-control" name="inputBeneficiaryAddress" id="inputBeneficiaryAddress"  readonly="">
                  </div>
              </div>
              <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 62px;">MOBILE NO.:</span>
                    <input type="text" class="form-control" name="inputBeneficiaryMobile" id="inputBeneficiaryMobile"  readonly="">
                  </div>
              </div>
              <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 30px;">EMAIL ADDRESS:</span>
                    <input type="text" class="form-control" name="inputBeneficiaryEmail" id="inputBeneficiaryEmail"  readonly="">
                  </div>
              </div> -->
              <div class="form-group"><h4>IDENTIFICATION</h4></div>
              <div class="form-group">
                  <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 64px;">PRIMARY ID: </span>
                  <select class="form-control preferenceSelectwestern" name="selvalidID1_western" id="selvalidID1_western" style="display: none;" required>
                      <option value="" disabled selected>--CHOOSE VALID ID--</option>   
                      <!-- <option value="add_id">ADD ID</option> CHOOSE VALID ID-->
                  </select>
                  <span class="form-control" id="spinAnimationWestern1"><i class="fa fa-spinner fa-spin fa-lg" aria-hidden="true"></i> Please wait fetching details...</span>
                  </div>
              </div>
              <div class="form-group" id="id_details1_western" style="border-top: 2px solid gray; border-bottom: 3px solid gray; background: #cccccc; text-align: center; display:none;"> 
                  <h4>PRIMARY ID DETAILS</h4>
                  <div class="input-group">
                    <span class="input-group-addon" id="id1_type" style="padding-right: 89px;">ID TYPE:</span>
                    <input type="text" class="form-control" name="id_detailtype1" id="id_detailtype1" readonly="">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon" id="id1_number" style="padding-right: 67px;">ID NUMBER:</span>
                    <input type="text" class="form-control" name="id_detailnumber1" id="id_detailnumber1" readonly="">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon" id="id1_expirydate" style="padding-right: 54px;">EXPIRY DATE:</span>
                    <input type="text" class="form-control" name="id_detailexpiry1" id="id_detailexpiry1" readonly="">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon" id="id1_createddate" style="padding-right: 40px;">CREATED DATE:</span>
                    <input type="text" class="form-control" name="id_detailcreated1" id="id_detailcreated1" readonly="">
                  </div>
                  <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 84px;">ID IMAGE:</span>
                  <a class="form-control btn btn-info" id="id_attachment1" href="" target="_blank">View</a>
                  </div>
              </div>
              <div class="form-group" style="display: none;">
                  <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 39px; display: none;">SECONDARY ID: </span>
                  <select class="form-control preferenceSelectwestern" name="selvalidID2_western" id="selvalidID2_western" style="display: none;">
                      <option value="" disabled selected>--CHOOSE VALID ID--</option>  
                  </select>
                  <span class="form-control" id="spinAnimationWestern2"><i class="fa fa-spinner fa-spin fa-lg" aria-hidden="true"></i> Please wait fetching details...</span>
                  </div>
              </div>
              <div class="form-group" id="id_details2_western" style="border-top: 2px solid gray; border-bottom: 3px solid gray; background: #cccccc; text-align: center; display:none;"> 
              <h4>SECONDARY ID DETAILS</h4>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 61px;">ID TYPE:</span>
                    <input type="text" class="form-control" name="id_detailtype2" id="id_detailtype2" readonly="">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 37px;">ID NUMBER:</span>
                    <input type="text" class="form-control" name="id_detailnumber2" id="id_detailnumber2" readonly="">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 24px;">EXPIRY DATE:</span>
                    <input type="text" class="form-control" name="id_detailexpiry2" id="id_detailexpiry2" readonly="">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 10px;">CREATED DATE:</span>
                    <input type="text" class="form-control" name="id_detailcreated2" id="id_detailcreated2" readonly="">
                  </div>
                  <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 54px;">ID IMAGE:</span>
                  <a class="form-control btn btn-info" id="id_attachment2" href="" target="_blank">View</a>
                  </div>
              </div>
              <div class="form-group" style="display: none;">
                  <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 59px; display: none;">TERTIARY ID: </span>
                  <select class="form-control preferenceSelectwestern" name="selvalidID3_western" id="selvalidID3_western" style="display: none;">
                      <option value="" disabled selected>--CHOOSE VALID ID--</option>  
                  </select>
                  <span class="form-control" id="spinAnimationWestern2"><i class="fa fa-spinner fa-spin fa-lg" aria-hidden="true"></i> Please wait fetching details...</span>
                  </div>
              </div>
              <div class="form-group" id="id_details3_western" style="border-top: 2px solid gray; border-bottom: 3px solid gray; background: #cccccc; text-align: center; display:none;"> 
              <h4>TERTIARY ID DETAILS</h4>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 61px;">ID TYPE:</span>
                    <input type="text" class="form-control" name="id_detailtype3" id="id_detailtype3" readonly="">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 37px;">ID NUMBER:</span>
                    <input type="text" class="form-control" name="id_detailnumber3" id="id_detailnumber3" readonly="">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 24px;">EXPIRY DATE:</span>
                    <input type="text" class="form-control" name="id_detailexpiry3" id="id_detailexpiry3" readonly="">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 10px;">CREATED DATE:</span>
                    <input type="text" class="form-control" name="id_detailcreated3" id="id_detailcreated3" readonly="">
                  </div>
                  <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 54px;">ID IMAGE:</span>
                  <a class="form-control btn btn-info" id="id_attachment3" href="" target="_blank">View</a>
                  </div>
              </div>
              <h4>TRANSACTION DETAILS</h4>
              <!-- <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="padding-right: 55px;">OCCUPATION:</span>
                  <input type="text" class="form-control" name="inputOccupation" id="inputOccupation" placeholder="OCCUPATION" required>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="padding-right: 45px;">RELATIONSHIP:</span>
                  <input type="text" class="form-control" name="inputRelationshiptoBene" id="inputRelationshiptoBene" placeholder="RELATIONSHIP TO BENEFICIARY" required>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="padding-right: 69px;">EMPLOYER:</span>
                  <input type="text" class="form-control" name="inputEmployer" id="inputEmployer" placeholder="EMPLOYER" required>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="padding-right: 21px;">SOURCE OF FUND:</span>
                  <input type="text" class="form-control" name="inputSourceofFund" id="inputSourceofFund" placeholder="SOURCE OF FUND" required>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="padding-right: 23px;">COUNTRY (BIRTH):</span>
                  <input type="text" class="form-control" name="inputCountryBirth" id="inputCountryBirth" placeholder="COUNTRY (BIRTH)" required>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="padding-right: 58px;">NATIONALITY:</span>
                  <input type="text" class="form-control" name="inputNationality" id="inputNationality" placeholder="NATIONALITY" required>
                </div>
              </div> -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="padding-right: 43px;">Account Number:</span>
                  <input type="text" class="form-control" name="inputAccountno" id="inputAccountno" placeholder="ACCOUNT NUMBER" required>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="padding-right: 99px;">Amount:</span>
                  <input type="text" class="form-control inputAmount" name="inputPRINAmount" id="inputPRINAmount" placeholder="0.00" required>
                </div>
              </div>
              
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="padding-right: 95px;">Channel:</span>
                    <select class="form-control" name="channel" id="channel" required>
                        <option value="" disabled selected>-- CHOOSE CHANNEL --</option>   
                        <option value="pymy">Paymaya</option> 
                        <option value="smny">SmartMoney</option> 
                        <option value="pickup">Pickup</option> 
                    <select>
                </div>
              </div>
              <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 67px;">PASSWORD:</span>
                    <input type="password" class="form-control " name="inputTpass" id="inputTpass" placeholder="TRANSACTION PASSWORD" required>
                  </div>
              </div>
              <div class="form-group">
                  <div class="row">
                      <div class="col-md-12 text-right">
                        <a id="btnCancelWestern" class="btn btn-warning"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Cancel</a>
                        <button type="submit" id="btnWesternSubmit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Submit</button>
                      </div>
                  </div>
              </div>
              <div class="form-group">
                  <input type="hidden" class="form-control" name="inputSenderID" id="inputSenderID"/>
                  <input type="hidden" class="form-control" name="inputBeneficiaryID" id="inputBeneficiaryID"/>
              </div>
          </form>
        </div>
      </div>

      <div class="row" id="stepThree" style="display: none;">
        <div class="col-md-6">

          <form name="frmpaymaya" action="<?php echo BASE_URL() ?>Ecash_send_jrlvaldez/ecashtopaymaya" method="post" class="frmclass" id="frmPaymaya">
            <p id="otpMessage" style="display: none;"></p>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label" style="padding-right:3px;">Tracking Number:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control inputReferenceNo unholdRefno" name="inputReferenceNo" id="inputReferenceNo" placeholder="Enter Tracking Number" required="" readonly="">
              </div>
            </div>

            <div class="form-group">
              <label for="inputVerification" class="col-sm-3 control-label" style="padding-right:3px;">Verification Code:</label>
              <div class="col-sm-9">
                <div class="input-group">
                <input type="text" class="form-control" name="inputVericode" id="inputVericode" placeholder="Enter Verification Code" required="">
                <span class="input-group-btn">
                  <button id="btnOTPPaymayaResend" class="btn btn-danger btnOTPPaymayaResend" type="button" tabindex="-1" style="height:34px;!important; width: 100px;">Resend</button>
                </span>
                </div>
              </div>
              <small class="resendingPaymayaOTPcode text-danger" style="float:right;display:none;">Verification code sending..</small>
            </div>

              <hr>

              <div class="form-group">
                <div class="col-md-12">
                <button type="submit" class="btn btn-primary pull-right" name="btnPaymayaUnhold" id="btnPaymayaUnhold" style="margin-left: 20px; width: 100px;">Verify</button>
                </div>
            </div>
          </form>

        </div>
      </div>

    <?php //} ?>

    <!-- Modal -->
    <div id="myModalWestern" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="newheading"></h4>
          </div>
            <form id="dataWestern" method="post" enctype="multipart/form-data">
          <fieldset>
                    <div class="modal-body">
                      <div class="alert alert-danger" style="display:none; text-align: center;" id="updateexpired"><b></b></div>
                      <div class="alert alert-success" style="display:none; text-align: center;" id="addnewsuccess"><b></b></div>
                        <div class="form-group">
                          <div class="input-group">
                          <span class="input-group-addon" style="padding-right: 70px;">ID TYPE:</span>
                          <select class="form-control" name="newidtype" id="newidtype" style="display: none;" required>
                              <option value="" disabled selected>--CHOOSE ID TYPE--</option>   
                          </select>
                          <span class="form-control" id="spinAnimationWestern3"><i class="fa fa-spinner fa-spin fa-lg" aria-hidden="true"></i> Please wait fetching details...</span>
                          <input type="hidden" class="form-control" id="newidtype2" name="newidtype2">
                          <input type="hidden" class="form-control" id="transtype" name="transtype" value="PAYMAYA">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                          <span class="input-group-addon"  style="padding-right: 46px;">ID NUMBER:</span>
                          <input type="text" class="form-control" id="newidnumber" name="newidnumber" required='required'>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                          <span class="input-group-addon"  style="padding-right: 33px;">EXPIRY DATE:</span>
                          <input type="text" class="form-control clsDatePicker" name="newexpirydate" id="newexpirydate" required='required'>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                          <span class="input-group-addon"  style="padding-right: 45px;">ID PICTURE:</span>
                          <input type="file" class="form-control" id="file" name="file" title="No File Found" onchange="ValidateSingleInputWestern(this);" required='required' >
                          <input type="hidden" class="form-control" name="westernidtype" id="westernidtype">
                          <input type="hidden" class="form-control" name="westernidtype" id="westernidtype">
                          </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" id="submit" >Submit</button>
                    <a href="#" class="btn btn-warning" data-dismiss="modal">Close</a>
                  </div>
          </fieldset>
          </form>
          </div>
        </div>
    </div>

  </div>

</div>

  <!---ADD NEW SENDER-->
  <div class="modal fade" id="addModal" role="dialog" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">ADD NEW SENDER</h4>
        </div>
        
        <form action="<?php echo BASE_URL() ?>ecash_send/ecashtopaymaya" method="post"  id="frmAddEcashPadala">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <label>Personal Information</label>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="text" class="form-control" name="sender[firstName]" placeholder="FIRSTNAME" value="<?php echo isset($_POST['sender']) ? $_POST['sender']['firstName']:'';?>" required="required"/>
                    </div>  
                  </div>
                  <div class="col-md-4" style="padding-left:0px!important">
                    <div class="form-group">
                      <input type="text" class="form-control" name="sender[middleName]" placeholder="MIDDLENAME" value="<?php echo isset($_POST['sender']) ? $_POST['sender']['middleName']:'';?>" required="required"/>
                    </div> 
                  </div>
                  <div class="col-md-4" style="padding-left:0px!important">
                    <div class="form-group">
                      <input type="text" class="form-control" name="sender[lastName]"  placeholder="LASTNAME" value="<?php echo isset($_POST['sender']) ? $_POST['sender']['lastName']:'';?>" required="required"/>
                    </div>
                  </div> 
                </div>
                
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group" >
                      <div class="input-group">
                        <span class="input-group-addon">(639)</span>
                        <input type="text" class="form-control" name="sender[mobileNumber]" placeholder="MOBILE NUMBER" value="<?php echo isset($_POST['sender']) ? $_POST['sender']['mobileNumber']:'';?>" minlength="9" maxlength="9" required="required"/>
                      </div>
                    </div>
                  </div> 
                  <div class="col-md-4" style="padding-left:0px!important">
                      <div class="form-group" >
                        <input type="text" class="form-control" name="sender[nationality]" placeholder="NATIONALITY" value="<?php echo isset($_POST['sender']) ? $_POST['sender']['nationality']:'';?>" required="required"/>
                    </div> 
                  </div>
                  <div class='col-md-4' style="padding-left:0px!important">
                      <div class="form-group" >
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">BIRTHDATE</span>
                          <input type="text" class="form-control" name="sender[birthDate]" id="datetimepicker" placeholder="BIRTHDATE" value="<?php echo isset($_POST['sender']) ? $_POST['sender']['birthDate']:'';?>" required="required"/>
                        </div>
                      </div> 
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group" >
                        <input type="text" class="form-control" name="sender[placeOfBirth]" placeholder="PLACE OF BIRTH" value="<?php echo isset($_POST['sender']) ? $_POST['sender']['placeOfBirth']:'';?>" required="required"/>
                    </div> 
                  </div> 
                  <div class="col-md-4" style="padding-left:0px!important">
                      <div class="form-group" >
                        <input type="text" class="form-control" name="sender[sourceOfIncome]" placeholder="SOURCE OF INCOME" value="<?php echo isset($_POST['sender']) ? $_POST['sender']['sourceOfIncome']:'';?>" required="required"/>
                    </div> 
                  </div>
                  <div class="col-md-4" style="padding-left:0px!important">
                      <div class="form-group" >
                        <input type="text" class="form-control" name="sender[occupation]" placeholder="OCCUPATION" value="<?php echo isset($_POST['sender']) ? $_POST['sender']['occupation']:'';?>" required="required"/>
                    </div> 
                  </div>
                </div>
                
                <br>
                
                <label>Present Address <span class="text-danger">(If not applicable, please input <i>N/A</i>)</span></label>
                
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="text" class="form-control" name="senderAddress[permanentAddress][houseNumber]" placeholder="HOUSE NUMBER" value="<?php echo (isset($_POST['senderAddress']) ? $_POST['senderAddress']['permanentAddress']['houseNumber']:"");?>" required="required"/>
                    </div>  
                  </div>
                  <div class="col-md-4" style="padding-left:0px!important">
                    <div class="form-group">
                      <input type="text" class="form-control" name="senderAddress[permanentAddress][street]" placeholder="STREET" value="<?php echo isset($_POST['senderAddress']) ? $_POST['senderAddress']['permanentAddress']['street']:'';?>" required="required"/>
                    </div> 
                  </div>
                  <div class="col-md-4" style="padding-left:0px!important">
                    <div class="form-group">
                      <input type="text" class="form-control" name="senderAddress[permanentAddress][barangay]"  placeholder="BARANGAY" value="<?php echo isset($_POST['senderAddress']) ? $_POST['senderAddress']['permanentAddress']['barangay']:'';?>" required="required"/>
                    </div>
                  </div> 
                </div>
                
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control" name="senderAddress[permanentAddress][city]" placeholder="CITY" value="<?php echo isset($_POST['senderAddress']) ? $_POST['senderAddress']['permanentAddress']['city']:'';?>" required="required"/>
                    </div>  
                  </div>
                  <div class="col-md-4" style="padding-left:0px!important">
                    <div class="form-group">
                      <input type="text" class="form-control" name="senderAddress[permanentAddress][province]" placeholder="PROVINCE" value="<?php echo isset($_POST['senderAddress']) ? $_POST['senderAddress']['permanentAddress']['']:'';?>" required="required"/>
                    </div> 
                  </div>
                  <div class="col-md-4" style="padding-left:0px!important">
                    <div class="form-group">
                      <input type="text" class="form-control" name="senderAddress[permanentAddress][zipcode]"  placeholder="ZIPCODE" value="<?php echo isset($_POST['senderAddress']) ? $_POST['senderAddress']['permanentAddress']['zipcode']:'';?>" required="required"/>
                    </div>
                  </div> 
                </div>
                
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <!-- <input type="text" class="form-control" name="inputprcountry" placeholder="COUNTRY" value="<?php echo $_POST['inputprcountry'];?>" required="required"/> -->
                      <select class="form-control" name="senderAddress[permanentAddress][country]" id="inputprcountry" required >
                        <option value="" disabled selected>--- SELECT COUNTRY ---</option>
                          <?php foreach ($airports as $row): ?>
                            <option value="<?php echo $row ?>"><?php echo $row ?></option>
                          <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                </div>
                
                <br>
                
                <label class="pull-leftxx">Permanent Address <span class="text-danger">(If not applicable, please input <i>N/A</i>)</span>
                  &nbsp;
                <input type="checkbox" id="checkPA" class="checkPA" name="checkPA">
                <label for="checkPA" class="checkPA">Click here if you want to same with present address</label>
                </label>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control checkread" name="senderAddress[presentAddress][houseNumber]" placeholder="HOUSE NUMBER" value="<?php echo isset($_POST['senderAddress']) ? $_POST['senderAddress']['presentAddress']['houseNumber']:'';?>" required="required"/>
                    </div>  
                  </div>
                  <div class="col-md-4" style="padding-left:0px!important">
                    <div class="form-group">
                      <input type="text" class="form-control checkread" name="senderAddress[presentAddress][street]" placeholder="STREET" value="<?php echo isset($_POST['senderAddress']) ? $_POST['senderAddress']['presentAddress']['street']:'';?>" required="required"/>
                    </div> 
                  </div>
                  <div class="col-md-4" style="padding-left:0px!important">
                    <div class="form-group">
                      <input type="text" class="form-control checkread" name="senderAddress[presentAddress][barangay]" placeholder="BARANGAY" value="<?php echo isset($_POST['senderAddress']) ? $_POST['senderAddress']['presentAddress']['barangay']:'';?>" required="required"/>
                    </div>
                  </div> 
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control checkread" name="senderAddress[presentAddress][city]" placeholder="CITY" value="<?php echo isset($_POST['senderAddress']) ? $_POST['senderAddress']['presentAddress']['city']:'';?>" required="required"/>
                    </div>  
                  </div>
                  <div class="col-md-4" style="padding-left:0px!important">
                    <div class="form-group">
                      <input type="text" class="form-control checkread" name="senderAddress[presentAddress][province]" placeholder="PROVINCE" value="<?php echo isset($_POST['senderAddress']) ? $_POST['senderAddress']['presentAddress']['province']:'';?>" required="required"/>
                    </div> 
                  </div>
                  <div class="col-md-4" style="padding-left:0px!important">
                    <div class="form-group">
                      <input type="text" class="form-control checkread" name="senderAddress[presentAddress][zipcode]"  placeholder="ZIPCODE" value="<?php echo isset($_POST['senderAddress']) ? $_POST['senderAddress']['presentAddress']['zipcode']:'';?>" required="required"/>
                    </div>
                  </div> 
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                        <!-- <input type="text" class="form-control" name="inputpmcountry" placeholder="COUNTRY" value="<?php echo $_POST['inputpmcountry'];?>"  required="required"/> -->
                        <select class="form-control checkread" name="senderAddress[presentAddress][country]" id="inputpmcountry" required >
                          <option value="" disabled selected>--- SELECT COUNTRY ---</option>
                          <?php foreach ($airports as $row): ?>
                            <option value="<?php echo $row ?>"><?php echo $row ?></option>
                          <?php endforeach ?>
                        </select>
                    </div>
                  </div>
                </div>

                <br>

                <!-- 
                <label>Transaction Password</label>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="password" class="form-control" placeholder="TRANSACTION PASSWORD" name="inputTpass" required="required">
                    </div>
                  </div>
                </div> -->
              </div>
              </div>
            </div>

            <div class="modal-footer">
              <div class="row">
                  <!-- <div class="col-md-6 text-left">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div> -->

                  <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary" id="btnSubmit" name="btnAddDetails">Submit &nbsp;<img id="imgloader" src="<?php echo BASE_URL()?>assets/images/loaders/loader1.gif" style="display:none" /></button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
              </div>
            </div>
          </form>
          </div>
        </div>
        
  </div>


  <!---ADD NEW BENIFICIARY-->
  <div class="modal fade" id="addBenefModal" role="dialog" >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">ADD NEW BENEFICIARY</h4>
          </div>
          <form action="<?php echo BASE_URL() ?>Ecash_send_jrlvaldez/ecashtopaymaya" method="post"  id="frmAddEcashPadala">
            <div class="modal-body">
              <div class="row">
                  <div class="col-md-12">
                      
                      <label>Personal Information</label>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" name="beneficiary[firstName]" placeholder="FIRSTNAME" value="<?php echo isset($_POST['beneficiary']) ? $_POST['beneficiary']['firstName']:'';?>" required="required"/>
                            </div>  
                          </div>
                          <div class="col-md-4" style="padding-left:0px!important">
                           <div class="form-group">
                              <input type="text" class="form-control" name="beneficiary[middleName]" placeholder="MIDDLENAME" value="<?php echo isset($_POST['beneficiary']) ? $_POST['beneficiary']['middleName']:'';?>" required="required"/>
                            </div> 
                          </div>
                          <div class="col-md-4" style="padding-left:0px!important">
                           <div class="form-group">
                              <input type="text" class="form-control" name="beneficiary[lastName]"  placeholder="LASTNAME" value="<?php echo isset($_POST['beneficiary']) ? $_POST['beneficiary']['lastName']:'';?>" required="required"/>
                            </div>
                          </div> 
                        </div>
                        
                        <br>

                        <label>Address <span class="text-danger">(If not applicable, please input <i>N/A</i>)</span></label>

                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" name="beneficiaryAddress[houseNumber]" placeholder="HOUSE NUMBER" value="<?php echo isset($_POST['beneficiaryAddress']) ? $_POST['beneficiaryAddress']['houseNumber']:'';?>" required="required"/>
                            </div>  
                          </div>
                          <div class="col-md-4" style="padding-left:0px!important">
                           <div class="form-group">
                              <input type="text" class="form-control" name="beneficiaryAddress[street]" placeholder="STREET" value="<?php echo isset($_POST['beneficiaryAddress']) ? $_POST['beneficiaryAddress']['street']:'';?>" required="required"/>
                            </div> 
                          </div>
                          <div class="col-md-4" style="padding-left:0px!important">
                           <div class="form-group">
                              <input type="text" class="form-control" name="beneficiaryAddress[barangay]"  placeholder="BARANGAY" value="<?php echo isset($_POST['beneficiaryAddress']) ? $_POST['beneficiaryAddress']['barangay']:'';?>" required="required"/>
                            </div>
                          </div> 
                        </div>

                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" name="beneficiaryAddress[city]" placeholder="CITY" value="<?php echo isset($_POST['beneficiaryAddress']) ? $_POST['beneficiaryAddress']['city']:'';?>" required="required"/>
                            </div>  
                          </div>
                          <div class="col-md-4" style="padding-left:0px!important">
                           <div class="form-group">
                              <input type="text" class="form-control" name="beneficiaryAddress[province]" placeholder="PROVINCE" value="<?php echo isset($_POST['beneficiaryAddress']) ? $_POST['beneficiaryAddress']['province']:'';?>" required="required"/>
                            </div> 
                          </div>
                          <div class="col-md-4" style="padding-left:0px!important">
                           <div class="form-group">
                              <input type="text" class="form-control" name="beneficiaryAddress[zipcode]"  placeholder="ZIPCODE" value="<?php echo isset($_POST['beneficiaryAddress']) ?$_POST['beneficiaryAddress']['zipcode']:'';?>" required="required"/>
                            </div>
                          </div> 
                        </div>

                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                                <!-- <input type="text" class="form-control" name="inputprcountry" placeholder="COUNTRY" value="<?php echo $_POST['inputprcountry'];?>" required="required"/> -->
                                <select class="form-control" name="beneficiaryAddress[country]" id="inputprcountry" required >
                                  <option value="" disabled selected>--- SELECT COUNTRY ---</option>
                                  <?php foreach ($airports as $row): ?>
                                    <option value="<?php echo $row ?>"><?php echo $row ?></option>
                                  <?php endforeach ?>
                                </select>
                            </div>
                          </div>
                        </div>
                       
                        <br>

                        <!-- 
                        <label>Transaction Password</label>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <input type="password" class="form-control" placeholder="TRANSACTION PASSWORD" name="inputTpass" required="required">
                            </div>
                          </div>
                        </div> -->

                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                  
                  <div class="col-md-12 text-right">
                      <button type="submit" class="btn btn-primary" id="btnSubmit" name="btnAddBenefDetails">Submit &nbsp;<img id="imgloader" src="<?php echo BASE_URL()?>assets/images/loaders/loader1.gif" style="display:none" /></button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>

              </div>
            </div>
          </form>
          </div>
        </div>
        
  </div>
  

<script src="<?php echo BASE_URL()?>assets/script/ecash_paymaya.js"></script>
