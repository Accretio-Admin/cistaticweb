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
                <h4>WESTERN UNION</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel" style="padding-bottom: 0px;">
        <div class="col-lg-12"> 

<!-- Start of IF ip is equal to PH then proceed -->

<?php 

$ch=curl_init();
curl_setopt($ch,CURLOPT_URL, "http://ip-api.com/json");
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

$result=curl_exec($ch);
$result=json_decode($result);

// If Outside PH and regcode is Test account blocked Service
if ($result->country !== 'Philippines' && $user['R'] == 'F7897947'): ?> 

<h3>This service is only available in the Philippines</h3>

<!-- else if not equal to Test account, Can access Service  -->
<?php elseif ($user['R'] !== 'F7897947'): ?>

          <!-- Paste ContentPanel Here -->

          <div class="row" style="margin-bottom: 30px;">
            <ul class="nav nav-tabs">
              <li class="active"><a href="<?php echo BASE_URL()?>ecash_payout/ecashtowestern_createrequest" style="color: #428bca;"><b>CREATE REQUEST</b></a></li> 
              <li><a href="<?php echo BASE_URL()?>ecash_payout/ecashtowestern_payoutlist">PENDING</a></li>   
              <li><a href="<?php echo BASE_URL()?>ecash_payout/ecashtowestern_payoutdone">DONE/CANCELLED</a></li>
            </ul>
          </div>
        </div>
        <?php endif; ?>

<!-- End of Ifelse IP is not equal to PH -->

        

        <div class="col-lg-12"> 
          <div style="display:none; text-align: center;" id="alertDynammic"></div>
          <?php if ($API['S']===0): ?>
                <div class="alert alert-danger"><b><?php echo $API['M']?></b></div>
          <?php endif ?>
          <?php if ($API['S']==1): ?>
                <div class="alert alert-success"><b><?php echo $API['M']?> <br /> Transaction no.:<?php echo $API['TN']?></b></div>
          <?php endif ?>
        <div class="alert alert-danger" style="display:none; text-align: center;" id="agreementfailed"><b></b></div>
         <div class="alert alert-success" style="display:none; text-align: center;" id="agreementsuccess"><b></b></div>

          <?php if ($details['process'] == 0): ?>
             <div class="row row-stat" id="stepOne">

<!-- Start of IF ip is equal to PH then proceed -->

<?php 

                            $ch=curl_init();
                            curl_setopt($ch,CURLOPT_URL, "http://ip-api.com/json");
                            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                            
                            $result=curl_exec($ch);
                            $result=json_decode($result);

                            // If Outside PH and regcode is Test account blocked Service
                            if ($result->country !== 'Philippines' && $user['R'] == 'F7897947'): ?> 

                            <h3>This service is only available in the Philippines</h3>
    
                            <!-- else if not equal to Test account, Can access Service  -->
                            <?php elseif ($user['R'] !== 'F7897947'): ?>

    <!-- Paste ContentPanel Here -->

                <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-6">
                          <?php include 'ecash_payout_createrequest/search_sender_beneficiary.php'; ?> 
                      </div>
                      <br />
                      <div class="row">
                          <div class="col-md-10 text-right">
                              <a href="#" class="btn btn-warning btnProceedWestern" style="display:none">Proceed Transaction &nbsp;<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></a>
                          </div>
                      </div>
                    </div>

                   <div class="col-md-12">
                      <?php if ($row['S']===0): ?>
                        <div class="alert alert-danger"><b><?php echo $row['M']; ?></b></div>
                      <?php elseif ($row['S']==1): ?>
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
                                  <td class="td" hidden><?php echo $i['fname'].'|'.$i['mname'].'|'.$i['lname']; ?></td>
                                  <td class="td" hidden><?php echo $i['bdate']; ?></td>
                                  <td><a id="aFindWestern" class="btn btn-danger" data-id="<?php echo $type['typeid'].'|PAYOUT'?>" href="#">Select</a></td>

                              </tr>
                              <?php endforeach ?>
                          
                            </tbody>
                          </table>
                      <?php endif ?>
                    </div>
                  </div>
                </div>
                <?php endif; ?>

<!-- End of Ifelse IP is not equal to PH -->

          </div>
        </div>

        <div class="row" id="stepTwo" style="display: none;">
          <div class="col-md-6">
            <form id="frmWesternPayout">
              <div class="form-group"><h4>SENDER</h4></div>
                <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1" style="padding-right: 64px;">FULL NAME:</span>
                      <input type="text" class="form-control" name="inputSenderName" id="inputSenderName" readonly="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1" style="padding-right: 75px;">ADDRESS:</span>
                      <input type="text" class="form-control" name="inputSenderAddress" id="inputSenderAddress"  readonly="">
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
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 30px;">EMAIL ADDRESS:</span>
                    <input type="text" class="form-control" name="inputSenderEmail" id="inputSenderEmail" readonly="">
                  </div>
                </div>
                <div class="form-group"><h4>BENEFICIARY</h4></div>
                <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1" style="padding-right: 65px;">FULL NAME:</span>
                      <input type="text" class="form-control" name="inputBeneficiaryName" id="inputBeneficiaryName" readonly="">
                    </div>
                </div>
                <div class="form-group">
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
                </div>
                <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1" style="padding-right: 66px;">BIRTHDATE:</span>
                      <input type="text" class="form-control" name="inputBeneficiaryBdate" id="benefbdate" readonly="" >
                    </div> 
                </div>

                <h4>TRANSACTION DETAILS</h4>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" style="padding-right: 31px;">REFERENCE NO.:</span>
                    <input type="text" class="form-control" name="inputReferenceNo" id="inputReferenceNo" placeholder="REFERENCE NUMBER" required>
                  </div>
                </div>
                <div class="form-group">
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
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" style="padding-right: 79px;">COUNTRY:</span>
                      <select class="form-control" name="country_iso" id="country_iso" required>
                          <option value="" disabled selected>--CHOOSE COUNTRY--</option>   
                          <?php 
                              foreach ($country as $row): 
                          ?>
                          <option value="<?php echo $row['iso_code'] ?>"><?php echo $row['cname'] ?></option> 
                          <?php endforeach ?>
                      </select>
                  </div>
                </div>
                  <div class="form-group">
                  <div class="row">
                    <div class="col-md-9" style="padding-right: 0px;">
                      <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1" style="padding-right: 89px;">AMOUNT:</span>
                        <input type="text" class="form-control inputAmount" name="inputPRINAmount" id="inputPRINAmount" placeholder="0.00" disabled required>
                      </div>
                    </div>
                    <div class="col-md-3" style="padding-left: 0px;">
                        <select class="form-control" name="currency" id="currency" disabled required>
                          <option value="PHP" selected>PHP</option>   
                          <option value="<?php echo $currency['currency'].'|'.$currency['rate'] ?>"><?php echo $currency['currency'] ?></option> 
                        </select>
                    </div>
                  </div>
                </div>

                <!-- <h4>IDENTIFICATION</h4> -->
                <div class="form-group">
                    <div class="input-groupxx">
                      <div class="row">
                        <div class="col-md-6">
                          <span style="font-size:18px;">IDENTIFICATION</span>
                        </div>
                        <div class="col-md-6">
                          <button type="button" class="btn btn-success" id="refresh" onclick="RefreshListwestern();">Refresh ID List</button>
                          <small class="text-danger text-right"> *Click button refresh ID list to show valid ID </small>
                        </div>
                      </div>
                    </div>
                </div>
<!--                   <div class="form-group">
                    <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 63px;">PRIMARY ID: </span>
                    <select class="form-control preferenceSelectwestern" name="selvalidID1_western" id="selvalidID1_western" disabled required>
                        <option value="" disabled selected>--CHOOSE VALID ID--</option>   
                    </select>
                    </div>
                </div> -->
                <div class="form-group">
                    <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 63px;">PRIMARY ID: </span>
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
<!--                   <div class="form-group">
                    <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 38px;">SECONDARY ID: </span>
                    <select class="form-control preferenceSelectwestern" name="selvalidID2_western" id="selvalidID2_western" disabled>
                        <option value="" disabled selected>--CHOOSE VALID ID--</option>  
                    </select>
                    </div>
                </div> -->
                <div class="form-group">
                    <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 39px;">SECONDARY ID: </span>
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
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 59px;">TERTIARY ID:</span>
                    <select class="form-control preferenceSelectWestern" name="selvalidID3_western" id="selvalidID3_western" disabled>
                        <option value="" disabled selected>--CHOOSE VALID ID--</option>  
                        <!-- <option value="add_id"  >ADD ID</option>   -->
                    </select>
                    </div>
                </div>
                <div class="form-group" id="id_details3" style="border-top: 2px solid gray; border-bottom: 3px solid gray; background: #cccccc; text-align: center; display:none;"> 
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
                
                <h4>TRANSACTION PASSWORD</h4>
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
                              <div class="input-group">
                              <span class="input-group-addon" style="padding-right: 70px;">ID TYPE:</span>
                              <select class="form-control" name="newidtype" id="newidtype" style="display: none;" required>
                                 <option value="" disabled selected>--CHOOSE ID TYPE--</option>   
                              </select>
                              <span class="form-control" id="spinAnimationWestern3"><i class="fa fa-spinner fa-spin fa-lg" aria-hidden="true"></i> Please wait fetching details...</span>
                              <input type="hidden" class="form-control" id="newidtype2" name="newidtype2">
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

  <!---ADD NEW SENDER AND BENIFICIARY-->
  <div class="modal fade" id="addModal" role="dialog" >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">ADD NEW SENDER AND BENEFICIARY</h4>
          </div>
          <form action="<?php echo BASE_URL() ?>ecash_payout/ecashtowestern_createrequest" method="post"  id="frmAddEcashPadala">
            <div class="modal-body">
              <div class="row">
                  <div class="col-md-12">
               
                          <div class="form-group">
                              <input type="text" class="form-control" name="inputFname" placeholder="FIRSTNAME"/>
                          </div>  
                           <div class="form-group">
                              <input type="text" class="form-control" name="inputMname" placeholder="MIDDLENAME"/>
                          </div> 
                           <div class="form-group">
                              <input type="text" class="form-control" name="inputLname"  placeholder="LASTNAME" />
                          </div> 
                           <div class="form-group">
                              <input type="email" class="form-control" name="inputEmail"  placeholder="EMAIL" />
                          </div>
                          <div class='col-md-8' style="padding-left:0px!important">
                             <div class="form-group" >
                                <input type="text" class="form-control" name="inputMobile" placeholder="MOBILE NUMBER"/>
                            </div> 
                          </div>
                           <div class='col-md-4'>
                             <div class="form-group">
                                <select name="selGender" class="form-control">
                                    <option value="" selected disabled>GENDER</option>
                                    <option value="Male">MALE</option>
                                    <option value="Femal">FEMALE</option>
                                </select>
                            </div> 
                          </div>
                           <div class="form-group"> 
                              <textarea name="inputAddr" class="form-control" placeholder="ADDRESS"></textarea>
                          </div> 
                          <div class='col-md-8' style="padding-left:0px!important">

                             <div class="form-group" >
                                 <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">BIRTHDATE</span>
                                  <input type="text" class="form-control" name="inputBdate" id="datetimepicker" placeholder="BIRTHDATE" readonly />
                                </div>

                            </div> 
                          </div>
                           <div class='col-md-4'>
                             <div class="form-group">
                                <select name="selCountry" class="form-control">
                                    <option value="" selected disabled>COUNTRY</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Singapore">Singapore</option>
                                    <option value="Qatar">Qatar</option>
                                </select>
                            </div> 
                          </div>
                          <div class="form-group">
                              <input type="password" class="form-control" placeholder="TRANSACTION PASSWORD" name="inputTpass">
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
            </div>
          </form>
          </div>
        </div>
        
  </div>

    <?php if($process == 999):?>
  <div class="modal fade" id="modalTermsandConditions" data-backdrop="static" role="dialog" style="margin-top: 3%;">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="frmAgreeTermsnCondition">
        <div class="modal-header">
          <p><strong><h4 style="font-family: Times New Roman, times-roman, georgia, serif">TERMS AND CONDITION</h4></strong></p>
        </div>
        <div class="modal-body" style="font-family: Times  New Roman; overflow-y: scroll; width: 100%; height: 450px; padding: 0px 5px 5px 5px;">
          <iframe width="100%" height="400px" src="" name="Agreementiframepayout" id="Agreementiframepayout"></iframe>
          <textarea rows="5" cols="50" id="inputAgreeURL" style="display:none;"><?php echo $content; ?></textarea>
          <br>
          <center><button type="submit" class="btn btn-warning btn-lg" name="btnAgree" id="btnAgree" style="width: 150px;">I Agree</button></center>
        </div>
        <input type="hidden" class="form-control" name="regcode" value="<?php echo $regcode; ?>" />
        </form>
      </div>
    </div>
  </div>
<?php endif ?>

<script type="text/javascript">
$(window).load(function(){
    if ($("#modalTermsandConditions").data('bs.modal') && $("#modalTermsandConditions").data('bs.modal').isShown){
      var myFrame = $("#Agreementiframepayout").contents().find('body');
        var textareaValue = $("#inputAgreeURL").val();
      myFrame.html(textareaValue);
    }
});
</script>

<script src="<?php echo BASE_URL()?>assets/script/ecash_western.js"></script>
