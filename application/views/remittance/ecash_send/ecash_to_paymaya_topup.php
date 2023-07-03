<script src="https://cdn.rawgit.com/RobinHerbots/Inputmask/4.x/dist/min/jquery.inputmask.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

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
          <h4>E-CASH TO SMART PADALA</h4>
        </div>

      </div>
    </div>

    <div class="contentpanel" style="padding-bottom: 0px;">
      
      
      <?php if (isset($details) && $details['process'] == 0):?>

<div class="col-lg-12"> 
                          <div class="row">
                            <div style="display:none; text-align: center;" id="alertDynammic"></div>
                            <?php if(isset($API)):
                              $alert = "";
                              $class = "";
                              if ($API['S'] === 0): 
                              $alert = "danger";
                              $class = "exclamation-circle";
                              elseif ($API['S'] == 1): 
                              $alert = "success";
                              $class = "check-circle";
                              elseif ($API['S'] == 3): 
                              $alert = "warning";
                              $class = "check";
                              endif;?>
                              <div class="alert alert-<?php echo $alert;?>">
                              <b> <i class="fa fa-<?php echo $class;?>" aria-hidden="true"></i> <?php echo $API['M']?></b>
                              </div>
                            <?php endif; ?>

                            <?php 
                              $msgAdd = $this->session->flashdata('msgAdd');
                              if ($msgAdd['S']==1):
                            ?>
                            <div class="alert alert-success">
                              <i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo $msgAdd['M']; ?></b>
                            </div>
                            <?php endif; ?>

                            <?php 
                              $msgAdd = $this->session->flashdata('msgAdd');
                              if ($msgAdd['M']=='Beneficiary Already Registered'):
                            ?>
                            <div class="alert alert-warning">
                              <i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo $msgAdd['M']; ?></b>
                            </div>
                            <?php endif; ?>

                            <?php 
                              $msgAdd = $this->session->flashdata('msgAdd');
                              if ($msgAdd['M']=='Sender Already Registered'):
                            ?>
                            <div class="alert alert-warning">
                              <i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo $msgAdd['M']; ?></b>
                            </div>
                            <?php endif; ?>
                            
                            <?php 
                              $msg = $this->session->flashdata('msg');
                              if ($msg['S'] == "APPROVED"):
                            ?>
                            <div class="alert alert-success">
                              &nbsp;&nbsp;<b><i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo $msg['M'] ?>.</b> Tracking Number: <a href="<?php echo $msg['URL']; ?>" target="_blank"><?php echo $msg['TN'];  ?></a><br>
                              &nbsp;&nbsp;<small>Click <a href="<?php echo $msg['URL']; ?>" target="_blank">here</a> to download copy of the Acknowledgement Receipt.</small>
                            </div>
                            <?php
                            elseif ($msg['S']==2 || $msg['S']==3 || $msg['S'] == "REMITAGAIN "): ?>
                              <div class="alert alert-warning">
                                <i class="fa fa-check" aria-hidden="true"></i> <?php echo $msg['M']; ?></b>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
        <div class="row row-stat" id="stepOne" style="display: <?php echo isset($transactionNumber) ? "none":"block" ?>;">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <a href="<?php echo BASE_URL() ?>ecash_send/paymaya_checkrefno" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-list"></span> &nbsp;Check Status</a> 
                    </div>
                    
                    <div class="form-group">
                      <form name="frmecashpadalasender" action="<?php echo BASE_URL() ?>Ecash_send/ecash_to_paymaya" method="post" id="frmSSeachRemit" >
                        <div class="row">
                          <div class='col-xs-12 col-md-12'>
                            <div class="row">
                              <div class="col-md-8">
                              
                                <input type="text" class="form-control OnlyChar" pattern="^[A-Za-z ]+$" id="inputPaymayaSenderName" name="inputSearch" placeholder="SEARCH SENDER NAME"   value="<?php echo (isset($type['inputSenderName']) ? $type['inputSenderName']:""); ?>" />
                                <!-- <input type="text" class="form-control OnlyChar" pattern="^[A-Za-z ]+$" id="inputPaymayaSenderName" name="inputSearch" placeholder="SEARCH MIDDLE NAME"   value="<?php echo (isset($type['inputSenderName']) ? $type['inputSenderName']:""); ?>" />
                                <input type="text" class="form-control OnlyChar" pattern="^[A-Za-z ]+$" id="inputPaymayaSenderName" name="inputSearch" placeholder="SEARCH LAST NAME"  value="<?php echo (isset($type['inputSenderName']) ? $type['inputSenderName']:""); ?>" /> -->
                            
                              </div>
                              <div class="col-md-4 sender-search">
                                <button type="submit" onkeyup="allLetter(this)" name="btnSsearch" id="btnSender" class="btn btn-primary">
                                  <span id="spanSIcon" class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                </button>
                                &nbsp;
                                <a href="#" class="btn btn-info" data-backdrop="false" data-toggle="modal" data-target="#addModal"><span class="glyphicon glyphicon-plus"></span></a>
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
                      <form name="frmecashpadalabeneficiary" action="<?php echo BASE_URL() ?>Ecash_send/ecash_to_paymaya" method="post" id="frmBSeachRemit" >
                        <div class="row">
                          <div class='col-xs-12 col-md-12'>
                            <div class="row"> 
                              <div class="col-md-8">
                                <input type="text" class="form-control OnlyChar" pattern="^[A-Za-z ]+$" id="inputPaymayaBeneficiaryName" name="inputSearch" placeholder="SEARCH BENEFICIARY NAME" required />
                                <input type="hidden" name="inputSenderHide" id="inputSenderHide" value="<?php echo (isset($type['inputSender']) ? $type['inputSender']:"")?>"/>
                                <input type="hidden" name="inputBenificiaryHide" id="inputBeneficiaryHide" />
                              </div>
                            <div class="col-md-4">
                                            <button type="submit" name="btnBsearch" id="btnBene" class="btn btn-primary">
                                              <span id="spanBIcon" class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                            </button>
                                            &nbsp;
                                            <a href="#" data-backdrop="false" class="btn btn-info" data-toggle="modal" data-target="#addBenefModal"><span class="glyphicon glyphicon-plus"></span></a> 
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
                          <a href="javascript:void(0)" class="btn btn-warning btnProceedWestern" style="display:none">Proceed Transaction &nbsp;<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></a>
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
                    <h4> <span id="spnResults"></span> Result :</h4>
                      <table <?php echo Count($row) > 0 ? 'id="example"':"";?>  class="table table-bordered" cellspacing="0" style="width:100%;">
                          <thead>
                            <tr>
                            <?php if($type['typedesc'] == "Sender"): ?>
                              <th>Full Name</th>
                              <th>Birthdate</th>
                              <th>Mobile No</th>
                              <th>Occupation</th>
                              <th>Action</th>
                            <?php endif;?>
                            <?php if($type['typedesc'] == "Benificiary"): ?>
                              <th>Full Name</th>   
                              <th style="width: 200px">Action</th>
                            <?php endif;?>
                            </tr>
                          </thead>
                          <tbody id="tblSearchSndrBnf">
                            <?php
                            if (count($row)>0):
                              foreach ($row as $i): ?>
                               <?php if($type['typedesc'] == "Sender"): ?>
                                  <tr class="tr">
                                      <td class="td" hidden><?php echo $type['typedesc'] == 'Sender' ? $i['customerId'] : $i['beneficiaryId']; ?></td>
                                      <td class="td"><?php echo $i['firstName'].' '.$i['middleName'].' '.$i['lastName']; ?></td>
                                      <td class="td"><?php echo $type['typedesc'] == 'Sender' ? date('Y-m-d', strtotime($i['birthDate'])):"-"; ?></td>
                                      <td class="td"><?php echo $type['typedesc'] == 'Sender' ? "+63".$i['mobileNumber']:"-"; ?></td>
                                      <td class="td"><?php echo $type['typedesc'] == 'Sender' ? $i['occupation'] :"-"; ?></td>
                                      <td class="td" hidden><?php echo $i['firstName'].'|'.$i['middleName'].'|'.$i['lastName']; ?></td>
                                      <td class="td" hidden><?php echo $i['birthDate']; ?></td>
                                      <td><a id="aFindPaymaya" class="btn btn-danger" data-id="<?php echo $type['typeid'].'|'.'SEND'?>" href="#">Select</a></td>
                                  </tr>
                              <?php endif;?>
                              <?php if($type['typedesc'] == "Benificiary"): ?>
                                  <tr class="tr">
                                      <td class="td" hidden><?php echo $type['typedesc'] == 'Sender' ? $i['customerId'] : $i['beneficiaryId']; ?></td>
                                      <td class="td"><?php echo $i['firstName'].' '.$i['middleName'].' '.$i['lastName']; ?></td>
                                      <!-- <td class="td"><?php echo $type['typedesc'] == 'Sender' ? date('Y-m-d', strtotime($i['birthDate'])):"-"; ?></td> -->
                                      <!-- <td class="td"><?php echo $type['typedesc'] == 'Sender' ? "+63".$i['mobileNumber']:"-"; ?></td>
                                      <td class="td"><?php echo $type['typedesc'] == 'Sender' ? $i['occupation'] :"-"; ?></td> -->
                                      <td class="td" hidden><?php echo $i['firstName'].'|'.$i['middleName'].'|'.$i['lastName']; ?></td>
                                      <!-- <td class="td" hidden><?php echo $i['birthDate']; ?></td> -->
                                      <td ><a style="width: 200px" id="aFindPaymaya" class="btn btn-danger" data-id="<?php echo $type['typeid'].'|'.'SEND'?>" href="#">Select</a></td>
                                  </tr>
                              <?php endif;?>
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
              
              <div class="form-group">
                <h4>SENDER</h4>
              </div>

              <div class="form-group">
                <div class="input-group">
                  
                        <span class="input-group-addon" id="basic-addon1" style="padding-right: 64px;">FULL NAME:</span>
                  <input type="text" class="form-control OnlyChar" name="inputSenderName" id="inputSenderName" readonly="">
                </div>
              </div>
              
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 74px;">BIRTHDATE:</span>
                  <input type="text" class="form-control" name="inputSenderBday" id="inputSenderBday"  readonly="">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 61px;">MOBILE NO.:</span>
                  <input type="text"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" name="inputMobileNo" id="inputMobileNo" readonly="">
                </div>
              </div>
              
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 72px;">OCCUPATION:</span>
                  <input type="text" class="form-control OnlyChar" name="inputSenderOccupation" id="inputSenderOccupation" readonly="">
                </div>
              </div>
              
              <div class="form-group">
                <h4>BENEFICIARY</h4>
              </div>
              
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 65px;">FULL NAME:</span>
                  <input type="text" class="form-control" name="inputBeneficiaryName" id="inputBeneficiaryName" readonly="">
                </div>
              </div>

              <div class="form-group">
                <h4>IDENTIFICATION (SENDER)</h4>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <div class="col-10 col-sm-10 col-md-10">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 64px;">PRIMARY ID: </span>
                    <select class="form-control preferenceSelectwestern" name="selvalidID1_western"  id="selvalidID1_western" style="display: none;" required>
                      <option value="" disabled selected>CHOOSE VALID ID</option>
                    </select>
                    <span class="form-control" id="spinAnimationWestern1"><i class="fa fa-spinner fa-spin fa-lg" aria-hidden="true"></i> Please wait fetching details...</span>
                  </div>
                  <div class="col-2 col-sm-2 col-md-2">
                    <a href="Javascript:void()" class="fa fa-refresh input-group-addon btn btn-success" id="basic-addon1 " onClick="westernfetchpayoutIDs()"></a>
                  </div>
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
                  <span class="input-group-addon" id="id1_expirydate" style="padding-right: 54px;">Expiration Date:</span>
                  <input type="text" class="form-control" name="id_detailexpiry1" id="id_detailexpiry1" readonly="">
                </div>
                <div class="input-group">
                  <span class="input-group-addon" id="id1_createddate" style="padding-right: 40px;">DATE CREATED:</span>
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
                    <option value="" disabled selected>CHOOSE VALID ID</option>  
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
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 24px;">Expiration Date:</span>
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
                      <option value="" disabled selected>CHOOSE VALID ID</option>  
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
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 24px;">Expiration Date:</span>
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
                <!-- choose id form -->
              <h4>TRANSACTION DETAILS</h4>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="padding-right: 43px;">Account Number:</span>
                  <input type="text" class="form-control" onkeypress="return /[0-9]/i.test(event.key)" name="inputAccountno" id="inputAccountno" placeholder="ACCOUNT NUMBER" required>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="padding-right: 99px;">Amount:</span>
                  <input type="text" class="form-control inputAmount" name="inputPRINAmount"  maxlength="5" id="inputPRINAmount" placeholder="0.00" required>
                </div>
              </div>
              
              <div class="form-group">
                <div class="input-group">
                  <!-- <span class="input-group-addon" style="padding-right: 95px;">Channel:</span> -->
                  <input type="label" value="smny" hidden id="channel"/>
                    <!-- <select class="form-control" name="channel" id="channel" required>
                        <option value="" disabled selected>-- CHOOSE CHANNEL --</option>    -->
                        <!-- <option value="pymy">Paymaya</option>  -->
                        <!-- <option value="smny">SmartMoney</option>  -->
                        <!-- <option value="pickup">Pickup</option>  -->
                    <!-- <select> -->
                </div>
              </div>
              
              <div class="form-group">
                  <div class="row">
                      <div class="col-md-12 text-right">
                        <a id="btnCancelWestern" class="btn btn-warning"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Cancel</a>
                        <button type="button" class="btn btn-primary  btn-lg btn_ModalSubmit" data-backdrop="false" data-toggle="modal" id="btnSubmit" >Next</button>
                        <!-- <a href="#" class="btn btnSummary" id="btnSummary" data-toggle="modal" data-target="#detailsModal"><span>&nbsp;Next</span></a> -->
                      </div>
                  </div>
              </div>
              <!-- Modal for summary -->
              <div class="modal fade" id="detailsModal" role="dialog" >
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">TRANSACTION SUMMARY</h4>
                    </div>
                    <div class="modal-body">
                     

                      <div class="row">
                        <div class="col-md-12">
                            <label>SENDER</label>
                            <div class="form-group">
                              <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right:120px;">Full Name :</span>
                                <span class="form-control" id="basic-addon2" style=""><label id="idSFullname" class="idSFullname"></label></span>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right:85px;">Sender Birthdate :</span>
                                <span class="form-control" id="basic-addon2" style=""><label id="sBirth" class="sBirth"></label></span>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right:107px;">MOBILE NO.:</span>
                                <span class="form-control" id="basic-addon2" style=""><label id="sMobileNo" class="sMobileNo"></label></span>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right:114px;">OCCUPATION :</span>
                                <span class="form-control" id="basic-addon2" style=""><label id="sOccupation" class="sOccupation"></label></span>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right:109px;">PRIMARY ID:</span>
                                <span class="form-control" id="basic-addon2" style=""><label id="primaryId" class="primaryId"></label></span>
                              </div>
                            </div>
                            <div class="form-group">
                            <h4>BENEFICIARY</h4>
                            </div>
                            <div class="form-group">
                              <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right:85px;">Beneficiary Full Name:</span>
                                <span class="form-control" id="basic-addon2" style=""><label id="bfullname" class="bfullname"></label></span>
                              </div>
                            </div> 
                            <div class="form-group">
                              <h4>TRANSACTION DETAILS</h4>
                            </div> 
                            <div class="form-group">
                              <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right:85px;">Account Number:</span>
                                <span class="form-control" id="basic-addon2" style=""><label id="accountNo" class="accountNo"></label></span>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right:85px;">Amount:</span>
                                <span class="form-control" id="basic-addon2" style=""><label id="amount" class="amount"></label></span>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right:85px;">Service Charge:</span>
                                <span class="form-control" id="basic-addon2" style=""><label id="rates" class="rates"></label></span>
                              </div>
                            </div>
                            <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 67px;">PASSWORD:</span>
                    <input type="password" class="form-control " name="inputTpass" id="inputTpass" placeholder="TRANSACTION PASSWORD" required>
                    
                  </div>
              </div>
                            <button style="margin-left: 5px" type="submit" id="btnWesternSubmit"  class="btn btn-primary  pull-right"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Submit</button>
                            <a data-dismiss="modal" class="btn btn-warning   pull-right"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Cancel</a>
                        </div>
                      </div>
                    </div>  
                  </div>
                </div>
              </div>
              <!-- end modal for summary -->

              
<div class="form-group">
<input type="hidden" class="form-control" name="inputSenderID" id="inputSenderID"/>
<input type="hidden" class="form-control" name="inputBeneficiaryID" id="inputBeneficiaryID"/>
</div>
</form>

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
        
        <form action="<?php echo BASE_URL() ?>ecash_send/ecash_to_paymaya" method="post"  id="frmAddEcashPadala">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <label>Personal Information</label>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="text"  class="form-control OnlyChar" onpaste="return false;" name="sender[firstName]" placeholder="FIRST NAME" value="<?php echo isset($_POST['sender']) ? $_POST['sender']['firstName']:'';?>" required="required"/>
                    </div>  
                  </div>
                  <div class="col-md-4" style="padding-left:0px!important">
                    <div class="form-group">
                      <input type="text"   class="form-control OnlyChar" onpaste="return false;" name="sender[middleName]" placeholder="MIDDLE NAME" value="<?php echo isset($_POST['sender']) ? $_POST['sender']['middleName']:'';?>" />
                    </div> 
                  </div>
                  <div class="col-md-4" style="padding-left:0px!important">
                    <div class="form-group">
                      <input type="text"   class="form-control allowCharAphHyp" onpaste="return false;" name="sender[lastName]"  placeholder="LAST NAME" value="<?php echo isset($_POST['sender']) ? $_POST['sender']['lastName']:'';?>" required="required"/>
                    </div>
                  </div> 
                </div>
                
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group" >
                      <div class="input-group">
                        <span class="input-group-addon">(+63)</span>
                        <input type="text" class="form-control" onpaste="return false;" name="sender[mobileNumber]" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="MOBILE NUMBER" value="<?php echo isset($_POST['sender']) ? $_POST['sender']['mobileNumber']:'';?>" minlength="10" maxlength="10"   required="required"/>
                      </div>
                    </div>
                  </div> 
                  <div class="col-md-4" style="padding-left:0px!important">
                      <div class="form-group" >
                        <input type="text" class="form-control OnlyChar" onpaste="return false;"  name="sender[nationality]" placeholder="NATIONALITY" value="<?php echo isset($_POST['sender']) ? $_POST['sender']['nationality']:'';?>" required="required"/>
                    </div> 
                  </div>
                  <div class='col-md-4' style="padding-left:0px!important">
                      <div class="form-group" >
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">BIRTHDATE</span>
                          <input type="date" class="form-control" onpaste="return false;" name="sender[birthDate]" id="sBdate" placeholder="BIRTHDAY" value="" required="required"/>
                        </div>
                      </div> 
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group" >
                        <input type="text"   class="form-control OnlyChar" onpaste="return false;" name="sender[placeOfBirth]" placeholder="PLACE OF BIRTH" value="<?php echo isset($_POST['sender']) ? $_POST['sender']['placeOfBirth']:'';?>" required="required"/>
                    </div> 
                  </div> 
                  <div class="col-md-4" style="padding-left:0px!important">
                      <div class="form-group" >
                        <input type="text"   class="form-control OnlyChar" onpaste="return false;" name="sender[sourceOfIncome]" placeholder="SOURCE OF INCOME" value="<?php echo isset($_POST['sender']) ? $_POST['sender']['sourceOfIncome']:'';?>" required="required"/>
                    </div> 
                  </div>
                  <div class="col-md-4" style="padding-left:0px!important">
                      <div class="form-group" >
                        <input type="text"   class="form-control OnlyChar" onpaste="return false;" name="sender[occupation]" placeholder="OCCUPATION" value="<?php echo isset($_POST['sender']) ? $_POST['sender']['occupation']:'';?>" required="required"/>
                    </div> 
                  </div>
                </div>
                
                <br>
                
                <label>Present Address <span class="text-danger">(If not applicable, please input <i>N/A</i>)</span></label>
                
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="text" class="form-control" onpaste="return false;" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="senderAddress[permanentAddress][houseNumber]" placeholder="HOUSE NUMBER" value="<?php echo (isset($_POST['senderAddress']) ? $_POST['senderAddress']['permanentAddress']['houseNumber']:"");?>" required="required"/>
                    </div>  
                  </div>
                  <div class="col-md-4" style="padding-left:0px!important">
                    <div class="form-group">
                      <input type="text" class="form-control" onpaste="return false;" name="senderAddress[permanentAddress][street]" placeholder="STREET" value="<?php echo isset($_POST['senderAddress']) ? $_POST['senderAddress']['permanentAddress']['street']:'';?>" required="required"/>
                    </div> 
                  </div>
                  <div class="col-md-4" style="padding-left:0px!important">
                    <div class="form-group">
                      <input type="text" class="form-control" onpaste="return false;" name="senderAddress[permanentAddress][barangay]"  placeholder="BARANGAY" value="<?php echo isset($_POST['senderAddress']) ? $_POST['senderAddress']['permanentAddress']['barangay']:'';?>" required="required"/>
                    </div>
                  </div> 
                </div>
                
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                        <input type="text"   class="form-control OnlyChar" onpaste="return false;" name="senderAddress[permanentAddress][city]" placeholder="CITY" value="<?php echo isset($_POST['senderAddress']) ? $_POST['senderAddress']['permanentAddress']['city']:'';?>" required="required"/>
                    </div>  
                  </div>
                  <div class="col-md-4" style="padding-left:0px!important">
                    <div class="form-group">
                      <input type="text"   class="form-control OnlyChar" onpaste="return false;" name="senderAddress[permanentAddress][province]" placeholder="PROVINCE" value="<?php echo isset($_POST['senderAddress']) ? $_POST['senderAddress']['permanentAddress']['']:'';?>" required="required"/>
                    </div> 
                  </div>
                  <div class="col-md-4" style="padding-left:0px!important">
                    <div class="form-group">
                      <input type="text" class="form-control"  onpaste="return false;" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="senderAddress[permanentAddress][zipcode]"  placeholder="ZIPCODE" value="<?php echo isset($_POST['senderAddress']) ? $_POST['senderAddress']['permanentAddress']['zipcode']:'';?>" required="required"/>
                    </div>
                  </div> 
                </div>
                
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <select class="form-control"  name="senderAddress[permanentAddress][country]" id="inputprcountry" required >
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
                <label for="checkPA" class="checkPA">Click here if same with present address</label>
                </label>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                        <input type="text"  class="form-control checkread" onpaste="return false;" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="senderAddress[presentAddress][houseNumber]" placeholder="HOUSE NUMBER" value="<?php echo isset($_POST['senderAddress']) ? $_POST['senderAddress']['presentAddress']['houseNumber']:'';?>" required="required"/>
                    </div>  
                  </div>
                  <div class="col-md-4" style="padding-left:0px!important">
                    <div class="form-group">
                      <input type="text" class="form-control checkread" onpaste="return false;" name="senderAddress[presentAddress][street]" placeholder="STREET" value="<?php echo isset($_POST['senderAddress']) ? $_POST['senderAddress']['presentAddress']['street']:'';?>" required="required"/>
                    </div> 
                  </div>
                  <div class="col-md-4" style="padding-left:0px!important">
                    <div class="form-group">
                      <input type="text" class="form-control checkread" onpaste="return false;" name="senderAddress[presentAddress][barangay]" placeholder="BARANGAY" value="<?php echo isset($_POST['senderAddress']) ? $_POST['senderAddress']['presentAddress']['barangay']:'';?>" required="required"/>
                    </div>
                  </div> 
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" onpaste="return false;"  class="form-control checkread OnlyChar" name="senderAddress[presentAddress][city]" placeholder="CITY" value="<?php echo isset($_POST['senderAddress']) ? $_POST['senderAddress']['presentAddress']['city']:'';?>" required="required"/>
                    </div>  
                  </div>
                  <div class="col-md-4" style="padding-left:0px!important">
                    <div class="form-group">
                      <input type="text" onpaste="return false;"  class="form-control checkread OnlyChar" name="senderAddress[presentAddress][province]" placeholder="PROVINCE" value="<?php echo isset($_POST['senderAddress']) ? $_POST['senderAddress']['presentAddress']['province']:'';?>" required="required"/>
                    </div> 
                  </div>
                  <div class="col-md-4" style="padding-left:0px!important">
                    <div class="form-group">
                      <input type="text" onpaste="return false;" class="form-control checkread" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="senderAddress[presentAddress][zipcode]"  placeholder="ZIPCODE" value="<?php echo isset($_POST['senderAddress']) ? $_POST['senderAddress']['presentAddress']['zipcode']:'';?>" required="required"/>
                    </div>
                  </div> 
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
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
              </div>
              </div>
            </div>

            <div class="modal-footer">
              <div class="row">
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
  <div class="modal fade in" id="addBenefModal" role="dialog" >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">ADD NEW BENEFICIARY</h4>
          </div>
          <form action="<?php echo BASE_URL() ?>Ecash_send/ecash_to_paymaya" method="post"  id="frmAddEcashPadala">
            <div class="modal-body">
              <div class="row">
                  <div class="col-md-12">
                      
                      <label>Personal Information</label>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" onpaste="return false;" class="form-control  OnlyChar" name="beneficiary[firstName]" placeholder="FIRST NAME" value="<?php echo isset($_POST['beneficiary']) ? $_POST['beneficiary']['firstName']:'';?>" required="required"/>
                            </div>  
                          </div>
                          <div class="col-md-4" style="padding-left:0px!important">
                           <div class="form-group">
                              <input type="text" onpaste="return false;" class="form-control  OnlyChar" name="beneficiary[middleName]" placeholder="MIDDLE NAME" value="<?php echo isset($_POST['beneficiary']) ? $_POST['beneficiary']['middleName']:'';?>"/>
                            </div> 
                          </div>
                          <div class="col-md-4" style="padding-left:0px!important">
                           <div class="form-group">
                              <input type="text" onpaste="return false;" class="form-control  allowCharAphHyp" name="beneficiary[lastName]"  placeholder="LAST NAME" value="<?php echo isset($_POST['beneficiary']) ? $_POST['beneficiary']['lastName']:'';?>" required="required"/>
                            </div>
                          </div>  
                        </div>

                        <div class="row"> 
                          <!-- <div class="col-md-4" style="padding-left:0px!important">
                           <div class="form-group">
                              <input type="text" onpaste="return false;" class="form-control " name="beneficiary[mobileNo]"  placeholder="MOBILE NUMBER" value="<?php echo isset($_POST['beneficiary']) ? $_POST['beneficiary']['mobileNo']:'';?>" minlength="10" maxlength="10"  required="required"/>
                            </div>
                          </div>  -->
                          <div class="col-md-4">
                          <div class="form-group" >
                            <div class="input-group">
                              <span class="input-group-addon">(+63)</span>
                              <!-- <input type="text" class="form-control" onpaste="return false;" name="beneficiary[mobileNumber]" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="MOBILE NUMBER" value="<?php echo isset($_POST['sender']) ? $_POST['sender']['mobileNumber']:'';?>" minlength="10" maxlength="10"   required="required"/> -->
                              <input type="text" onpaste="return false;" class="form-control " name="beneficiary[mobileNo]" onkeypress="return event.charCode >= 48 && event.charCode <= 57"  placeholder="MOBILE NUMBER" value="<?php echo isset($_POST['beneficiary']) ? $_POST['beneficiary']['mobileNo']:'';?>" minlength="10" maxlength="10"  required="required"/>
                        
                            </div>
                          </div>
                        </div> 
                        </div>
                        
                      
                        <br>

                        <label>Address <span class="text-danger">(If not applicable, please input <i>N/A</i>)</span></label>

                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" onpaste="return false;" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="beneficiaryAddress[houseNumber]" placeholder="HOUSE NUMBER" value="<?php echo isset($_POST['beneficiaryAddress']) ? $_POST['beneficiaryAddress']['houseNumber']:'';?>" required="required"/>
                            </div>  
                          </div>
                          <div class="col-md-4" style="padding-left:0px!important">
                           <div class="form-group">
                              <input type="text"  onpaste="return false;" class="form-control" name="beneficiaryAddress[street]" placeholder="STREET" value="<?php echo isset($_POST['beneficiaryAddress']) ? $_POST['beneficiaryAddress']['street']:'';?>" required="required"/>
                            </div> 
                          </div>
                          <div class="col-md-4" style="padding-left:0px!important">
                           <div class="form-group">
                              <input type="text" onpaste="return false;" class="form-control" name="beneficiaryAddress[barangay]"  placeholder="BARANGAY" value="<?php echo isset($_POST['beneficiaryAddress']) ? $_POST['beneficiaryAddress']['barangay']:'';?>" required="required"/>
                            </div>
                          </div> 
                        </div>

                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" onpaste="return false;" class="form-control OnlyChar" name="beneficiaryAddress[city]" placeholder="CITY" value="<?php echo isset($_POST['beneficiaryAddress']) ? $_POST['beneficiaryAddress']['city']:'';?>" required="required"/>
                            </div>  
                          </div>
                          <div class="col-md-4" style="padding-left:0px!important">
                           <div class="form-group">
                              <input type="text" onpaste="return false;" class="form-control OnlyChar" name="beneficiaryAddress[province]" placeholder="PROVINCE" value="<?php echo isset($_POST['beneficiaryAddress']) ? $_POST['beneficiaryAddress']['province']:'';?>" required="required"/>
                            </div> 
                          </div>
                          <div class="col-md-4" style="padding-left:0px!important">
                           <div class="form-group">
                              <input type="text" onpaste="return false;" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="beneficiaryAddress[zipcode]"  placeholder="ZIPCODE" value="<?php echo isset($_POST['beneficiaryAddress']) ?$_POST['beneficiaryAddress']['zipcode']:'';?>" required="required"/>
                            </div>
                          </div> 
                        </div>

                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
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
        </form>
      </div>
    </div>
  </div>

              <div class="row" id="stepThree" style="display: <?php echo isset($transactionNumber) ? "block":"none" ?>;">
                <div class="col-md-6">
                  <form name="frmpaymaya" action="<?php echo BASE_URL() ?>Ecash_send/ecash_to_paymaya" method="post" class="frmclass" id="frmPaymaya">
                    <p id="otpMessage" style="display: none;"></p>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label" style="padding-right:3px;">Tracking Number:</label>
                      <div class="col-sm-9">
                        <input type="text" value="<?php echo isset($transactionNumber) ? $transactionNumber:"" ?>" class="form-control inputReferenceNo unholdRefno" name="inputReferenceNo" id="inputReferenceNo" placeholder="Enter Tracking Number" required="" readonly="">
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
      <?php endif; ?>
      
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
                          <p class="input-group-addon" id="valID" style="background-color: white;color: red; border:0;padding-right: 70px;padding-bottom: 15px"  hidden ></p>
                            <div class="input-group">
                              <span class="input-group-addon" style="padding-right: 70px;">ID TYPE:</span>
                              <select class="form-control" name="newidtype" id="newidtype" style="display: none;" required>
                              <option value="" disabled selected>CHOOSE ID TYPE</option>   
                              </select>
                              
                              <span class="form-control" id="spinAnimationWestern3"><i class="fa fa-spinner fa-spin fa-lg" aria-hidden="true"></i> Please wait fetching details...</span>
                              <input type="hidden" class="form-control" id="newidtype2" name="newidtype2">
                              <input type="hidden" class="form-control" id="transtype" name="transtype" value="PAYMAYA"> 
                            </div>
                            
                          </div> 
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon"  style="padding-right: 46px;">ID NUMBER:</span>
                              <input type="text" class="form-control" maxlength="30" id="newidnumber" name="newidnumber" required='required'>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon"  style="padding-right: 33px;">Expiration Date:</span>
                              <input type="text" autocomplete="off" class="form-control" name="newexpirydate" id="newexpirydate" required='required'>
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
        </div>
</div>     
  </div>
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo BASE_URL()?>assets/script/ecash_paymaya.js"></script>
<script src="<?php echo BASE_URL()?>assets/assets/js/jquery-2.1.4.min.js"></script>

<script> 
$('.btn_ModalSubmit').attr("disabled", true);
$("#selvalidID1_western").change(function () {
  var text = $("option:selected", $(this)).text();
  if (text == '' || text == "CHOOSE VALID ID" || $("option:selected", $(this)).val() == '' ){
    $('.btn_ModalSubmit').attr("disabled", true)
  }else {
    $('.btn_ModalSubmit').attr("disabled", false)
  }
  console.log(text);
});

 
 
$("#inputAccountno").keypress(function(e) {
       if (e.which === 32 && !this.value.length) {
           e.preventDefault();
       }
               
   });

   $(".OnlyChar").keypress(function(e) {
       if (e.which === 32 && !this.value.length) {
           e.preventDefault();
       }
               
   });



$("#inputPRINAmount").change(function(){
  if ($("#inputPRINAmount").val() > 50000) { 
    $("#alertDynammic").removeClass('alert-warning'); 
            $("#alertDynammic").empty();
            $("#alertDynammic").fadeTo(6000, 6000).slideUp(6000, function () {
              $("#alertDynammic").slideUp(6000);
              $("#alertDynammic").removeClass();
            });
            $("#alertDynammic").addClass("alert-warning"); 
            $("#alertDynammic").append("Smartmoney transfer allow maximum of 50000");
            $("#stepOne").css('display', 'none');
            $("#stepTwo").css('display', 'block');
            $("#stepThree").css('display', 'none');
    $('.btn_ModalSubmit').attr("disabled", true);
  } else {
    $('.btn_ModalSubmit').attr("disabled", false);
  }
});


$('.btn_ModalSubmit').click(function(){
 
  var rates = [ 
    { 
    "start_amount":1,
    "end_amount":1000,
    "service_charge":30.00,
    },{ 
    "start_amount":1001,
    "end_amount":1500,
    "service_charge":45.00,
    },
    { 
    "start_amount":1501,
    "end_amount":2000,
    "service_charge":60.00,
    },
    { 
    "start_amount":2001,
    "end_amount":2500,
    "service_charge":75.00,
    },
    { 
    "start_amount":2501,
    "end_amount":3000,
    "service_charge":90.00,
    },
    { 
    "start_amount":3001,
    "end_amount":3500,
    "service_charge":105.00,
    },
    { 
    "start_amount":3501,
    "end_amount":4000,
    "service_charge":120.00,
    },
    { 
    "start_amount":4001,
    "end_amount":4500,
    "service_charge":135.00,
    },
    { 
    "start_amount":4501,
    "end_amount":5000,
    "service_charge":150.00,
    },
    { 
    "start_amount":5001,
    "end_amount":5500,
    "service_charge":165.00,
    },
    { 
    "start_amount":5501,
    "end_amount":6000,
    "service_charge":180.00,
    },
    { 
    "start_amount":6001,
    "end_amount":6500,
    "service_charge":195.00,
    },
    { 
    "start_amount":6501,
    "end_amount":7000,
    "service_charge":210.00,
    },
    { 
    "start_amount":7001,
    "end_amount":7500,
    "service_charge":225.00,
    },
    { 
    "start_amount":7501,
    "end_amount":8000,
    "service_charge":240.00,
    },
    { 
    "start_amount":8001,
    "end_amount":8500,
    "service_charge":255.00,
    },
    { 
    "start_amount":8501,
    "end_amount":9000,
    "service_charge":270.00,
    },
    { 
    "start_amount":9001,
    "end_amount":9500,
    "service_charge":285.00,
    },
    { 
    "start_amount":9501,
    "end_amount":10000,
    "service_charge":300.00,
    },
    { 
    "start_amount":10001,
    "end_amount":10500,
    "service_charge":315.00,
    },
    { 
    "start_amount":10501,
    "end_amount":11000,
    "service_charge":330.00,
    },
    { 
    "start_amount":11001,
    "end_amount":11500,
    "service_charge":345.00,
    },
    { 
    "start_amount":11501,
    "end_amount":12000,
    "service_charge":360.00,
    },
    { 
    "start_amount":12001,
    "end_amount":12500,
    "service_charge":375.00,
    },
    { 
    "start_amount":12501,
    "end_amount":13000,
    "service_charge":390.00,
    },
    { 
    "start_amount":13001,
    "end_amount":13500,
    "service_charge":405.00,
    },
    { 
    "start_amount":13501,
    "end_amount":14000,
    "service_charge":420.00,
    },
    { 
    "start_amount":14001,
    "end_amount":14500,
    "service_charge":435.00,
    },
    { 
    "start_amount":14501,
    "end_amount":15000,
    "service_charge":450.00,
    },
    { 
    "start_amount":15001,
    "end_amount":15500,
    "service_charge":465.00,
    },
    { 
    "start_amount":15501,
    "end_amount":16000,
    "service_charge":480.00,
    },
    { 
    "start_amount":16001,
    "end_amount":16500,
    "service_charge":495.00,
    },
    { 
    "start_amount":16501,
    "end_amount":17000,
    "service_charge":510.00,
    },
    { 
    "start_amount":17001,
    "end_amount":17500,
    "service_charge":525.00,
    },
    { 
    "start_amount":17501,
    "end_amount":18000,
    "service_charge":540.00,
    },
    { 
    "start_amount":18001,
    "end_amount":18500,
    "service_charge":555.00,
    },
    { 
    "start_amount":18501,
    "end_amount":19000,
    "service_charge":570.00,
    },
    { 
    "start_amount":19001,
    "end_amount":19500,
    "service_charge":585.00,
    },
    { 
    "start_amount":19501,
    "end_amount":20000,
    "service_charge":600.00,
    },
    { 
    "start_amount":20001,
    "end_amount":20500,
    "service_charge":615.00,
    },
    { 
    "start_amount":20501,
    "end_amount":21000,
    "service_charge":630.00,
    },
    { 
    "start_amount":21001,
    "end_amount":21500,
    "service_charge":645.00,
    },
    { 
    "start_amount":21501,
    "end_amount":22000,
    "service_charge":660.00,
    },
    { 
    "start_amount":22001,
    "end_amount":22500,
    "service_charge":675.00,
    },
    { 
    "start_amount":22501,
    "end_amount":23000,
    "service_charge":690.00,
    },
    { 
    "start_amount":23001,
    "end_amount":23500,
    "service_charge":705.00,
    },
    { 
    "start_amount":23501,
    "end_amount":24000,
    "service_charge":720.00,
    },
    { 
    "start_amount":24001,
    "end_amount":24500,
    "service_charge":735.00,
    },
    { 
    "start_amount":24501,
    "end_amount":25000,
    "service_charge":750.00,
    },
    { 
    "start_amount":25001,
    "end_amount":25500,
    "service_charge":765.00,
    },
    { 
    "start_amount":25501,
    "end_amount":26000,
    "service_charge":780.00,
    },
    { 
    "start_amount":26001,
    "end_amount":26500,
    "service_charge":795.00,
    },
    { 
    "start_amount":26501,
    "end_amount":27000,
    "service_charge":810.00,
    },
    { 
    "start_amount":27001,
    "end_amount":27500,
    "service_charge":825.00,
    },
    { 
    "start_amount":27501,
    "end_amount":28000,
    "service_charge":840.00,
    },
    { 
    "start_amount":28001,
    "end_amount":28500,
    "service_charge":855.00,
    },
    {
    "start_amount":28501,
    "end_amount":29000,
    "service_charge":870.00,
    },
    { 
    "start_amount":29001,
    "end_amount":29500,
    "service_charge":885.00,
    },
    { 
    "start_amount":29501,
    "end_amount":30000,
    "service_charge":900.00,
    },
    { 
    "start_amount":30001,
    "end_amount":30500,
    "service_charge":915.00,
    },
    { 
    "start_amount":30501,
    "end_amount":31000,
    "service_charge":930.00,
    },
    { 
    "start_amount":31001,
    "end_amount":31500,
    "service_charge":945.00,
    },
    { 
    "start_amount":31501,
    "end_amount":32000,
    "service_charge":960.00,
    },
    { 
    "start_amount":32001,
    "end_amount":32500,
    "service_charge":975.00,
    },
    { 
    "start_amount":32501,
    "end_amount":33000,
    "service_charge":990.00,
    },
    { 
    "start_amount":33001,
    "end_amount":33500,
    "service_charge":1005.00,
    },
    { 
    "start_amount":33501,
    "end_amount":34000,
    "service_charge":1020.00,
    },
    { 
    "start_amount":34001,
    "end_amount":34500,
    "service_charge":1035.00,
    },
    { 
    "start_amount":34501,
    "end_amount":35000,
    "service_charge":1050.00,
    },
    { 
    "start_amount":35001,
    "end_amount":35500,
    "service_charge":1065.00,
    },
    { 
    "start_amount":35501,
    "end_amount":36000,
    "service_charge":1080.00,
    },
    { 
    "start_amount":36001,
    "end_amount":36500,
    "service_charge":1095.00,
    },
    { 
    "start_amount":36501,
    "end_amount":37000,
    "service_charge":1110.00,
    },
    { 
    "start_amount":37001,
    "end_amount":37500,
    "service_charge":1125.00,
    },
    { 
    "start_amount":37501,
    "end_amount":38000,
    "service_charge":1140.00,
    },
    { 
    "start_amount":38001,
    "end_amount":38500,
    "service_charge":1155.00,
    },
    { 
    "start_amount":38501,
    "end_amount":39000,
    "service_charge":1170.00,
    },
    { 
    "start_amount":39001,
    "end_amount":39500,
    "service_charge":1185.00,
    },
    { 
    "start_amount":39501,
    "end_amount":40000,
    "service_charge":1200.00,
    },
    { 
    "start_amount":40001,
    "end_amount":40500,
    "service_charge":1215.00,
    },
    { 
    "start_amount":40501,
    "end_amount":41000,
    "service_charge":1230.00,
    },
    { 
    "start_amount":41001,
    "end_amount":41500,
    "service_charge":1245.00,
    },
    { 
    "start_amount":41501,
    "end_amount":42000,
    "service_charge":1260.00,
    },
    { 
    "start_amount":42001,
    "end_amount":42500,
    "service_charge":1275.00,
    },
    { 
    "start_amount":42501,
    "end_amount":43000,
    "service_charge":1290.00,
    },
    { 
    "start_amount":43001,
    "end_amount":43500,
    "service_charge":1305.00,
    },
    { 
    "start_amount":43501,
    "end_amount":44000,
    "service_charge":1320.00,
    },
    { 
    "start_amount":44001,
    "end_amount":44500,
    "service_charge":1335.00,
    },
    { 
    "start_amount":44501,
    "end_amount":45000,
    "service_charge":1350.00,
    },
    { 
    "start_amount":45001,
    "end_amount":45500,
    "service_charge":1365.00,
    },
    { 
    "start_amount":45501,
    "end_amount":46000,
    "service_charge":1380.00,
    },
    { 
    "start_amount":46001,
    "end_amount":46500,
    "service_charge":1395.00,
    },
    { 
    "start_amount":46501,
    "end_amount":47000,
    "service_charge":1410.00,
    },
    { 
    "start_amount":47001,
    "end_amount":47500,
    "service_charge":1425.00,
    },
    { 
    "start_amount":47501,
    "end_amount":48000,
    "service_charge":1440.00,
    },
    { 
    "start_amount":48001,
    "end_amount":48500,
    "service_charge":1455.00,
    },
    { 
    "start_amount":48501,
    "end_amount":49000,
    "service_charge":1470.00,
    },
    { 
    "start_amount":49001,
    "end_amount":49500,
    "service_charge":1485.00,
    },
    { 
    "start_amount":49501,
    "end_amount":50000,
    "service_charge":1500.00,
    }];
    var amount = $('#inputPRINAmount').val();
    var charge = "";
    // rates.foreach(element => {
     
    // });
    $('#detailsModal .rates').html("");
    rates.map(element => {
      if (parseInt(amount) >= element.start_amount && parseInt(amount) <= element.end_amount) {
        $('#detailsModal .rates').html(element.service_charge);
      } 
    });
    // alert(cha);
    
    
});

  $(document).ready(function(){ 
    var todaysDate = new Date(); 
      var year = todaysDate.getFullYear()-18;                       
      var month = ("0" + (todaysDate.getMonth() + 1)).slice(-2);  
      var day = ("0" + todaysDate.getDate()).slice(-2);           
      var maxDate = (year +"-"+ month +"-"+ day);
    $('#sBdate').attr('max',maxDate); 
    $('#btnWesternSubmit').click(function() {
      if ($("#inputTpass").val() == "") { 
        alert("Transaction Password Required");
        $('#detailsModal').modal('show');
      } else { 
      $('#detailsModal').modal('hide');
      }
    });
    $('.btn_ModalSubmit').click(function() {
      if ($("#inputAccountno").val() == '') {
        alert('Account number required'); 
      } else if($("#inputPRINAmount").val() == "") {
        alert('Amount required'); 
      }else { 
        $('#detailsModal').modal('show');
      }
     
        var bPrimaryId = $('#id_detailtype1').val();
        var sFullname = $('#inputSenderName').val();
        var sbday = $('#inputSenderBday').val();
        var sMobileNo = $('#inputMobileNo').val();
        var sOccupation = $('#inputSenderOccupation').val();
        var bfullname =$('#inputBeneficiaryName').val();
        var accountNumber = $('#inputAccountno').val();
        var amount = $('#inputPRINAmount').val();

        $('#detailsModal .idSFullname').html(sFullname);
        $('#detailsModal .sBirth').html(sbday);
        $('#detailsModal .sMobileNo').html(sMobileNo);
        $('#detailsModal .sOccupation').html(sOccupation);
        $('#detailsModal .bfullname').html(bfullname);
        $('#detailsModal .primaryId').html(bPrimaryId);
        $('#detailsModal .accountNo').html(accountNumber);
        $('#detailsModal .amount').html(amount);
      
    });
  }); 
</script>

<script> 
$(function() { 
  $('.allowCharAphHyp').keydown((e) => { 
    
    if (e.key == "_" || e.key == '"'){
      e.preventDefault(); 
      return;
    } 
    if (e.altKey) {
      e.preventDefault();  
    } else {
      var key = e.keyCode;
      if (!((key == 8) || (key == 222) || (key == 164) || (key == 189) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
        e.preventDefault(); 
      }
    }
  }); 
  $('#newexpirydate').keydown((e) => {
      console.log(e);
      e.preventDefault();

    });
  $('.OnlyChar').keydown((e) => {
    check(e);
  });   
  function check(e) {
   
    if ( e.altKey) {
      e.preventDefault();  
    } else {
      var key = e.keyCode;
      if (!((key == 8) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
        e.preventDefault(); 
      } 
    } 
  } 
});
</script>
 