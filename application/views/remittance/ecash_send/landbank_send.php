<style>
    .tight-gutter {
        padding: 0 0px !important;
    }
    .landbankForm{
        padding: 10px;
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
                    <li>ECASH</li>
                </ul>
                <h4>Land Bank Sender</h4>
            </div>
        </div>
    </div>


    <div class="contentpanel" style="padding-bottom: 0px;">
        <div id="stepOne">
          <div class="col-lg-12"> 
            <div class="row">
              <div style="display:none; text-align: center;" id="alertDynammic"></div>
              <?php if ($API['S']===0): ?>
                    <div class="alert alert-danger"><b><?php echo $API['M']?></b></div>
              <?php endif ?>
              <?php if ($API['S']==1): ?>
                    <div class="alert alert-success"><b><?php echo $API['M']?></b></div>
              <?php endif ?>
            </div>
          </div>
        
          
          <div class="form-group">
              <a href="#" id="addSenderBeneWU" class="btn btn-primary" data-toggle="modal" data-target="#addModal"><span class="glyphicon glyphicon-plus"></span> &nbsp;New Sender / Beneficiary</a> 
          </div>
          
          <!-- SEARCH SENDER NAME -->
          <div class="form-group">
            <form name="frmlandbanksender" action="<?php echo BASE_URL() ?>ecash_send/landbank_send" method="post" id="frmSSeachRemit">
                <div class="row">
                    <div class='col-xs-12 col-md-12'>
                        <div class="row">
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="inputLandbankSenderName" name="inputSearch" placeholder="SEARCH SENDER NAME" value="<?php echo $type['inputSenderName']; ?>" required/>
                            </div>
                            <div class="col-md-2 sender-search">
                                <button type="submit" name= "btnSsearch" id="btnSsearch" class="btn btn-primary">
                                    <span id="spanSIcon" class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                </button>
                            </div> 
                        </div> 
                    </div>
                </div> 
            </form>
          </div>
          
          <!-- SEARCH BENEFICIARY NAME -->
          <div class="form-group">
            <form name="frmlandbankbeneficiary" action="<?php echo BASE_URL() ?>ecash_send/landbank_send" method="post" id="frmBSeachRemit">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <div class='col-xs-12 col-md-12'>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" id="inputLandbankBeneficiaryName" name="inputSearch" placeholder="SEARCH BENEFICIARY NAME" required />
                                            <input type="hidden" name="inputSenderHide" id="inputSenderHide" value="<?php echo $type['inputSender']?>"/>
                                            <input type="hidden" name="inputBeneficiaryHide" id="inputBeneficiaryHide" />
                                        </div>
                                        <div class="col-md-2">
                                              <button type="submit" name= "btnBsearch" id="btnBsearch" class="btn btn-primary">
                                              <span id="spanBIcon" class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                            </button>
                                        </div> 
                                    </div> 
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-10 text-right">
                        <a href="#" class="btn btn-warning btnProceed" style="display:none">Proceed Transaction &nbsp;<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></a>
                    </div>
                </div>
            </form>
          </div>
          
          <!---DIV TABLE-->
          <div class="col-md-12">
            <?php if ($row['S']===0): ?>
                <div class="alert alert-danger"><b><?php echo $row['M']; ?>!!</b></div>
            <?php endif ?>
            <?php if ($row['S']==1): ?>
              <hr/>
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
                    <?php  foreach ($row['D'] as $i): ?>
                    <tr class="tr">
                        <td class="td"><?php echo $i['customer_no']; ?></td>
                        <td class="td"><?php echo $i['full_name']; ?></td>
                        <td class="td"><?php echo $i['address']; ?></td>
                        <td class="td"><?php echo $i['mobile_no']; ?></td>
                        <td class="td"><?php echo $i['email_add']; ?></td>
                        <td class="td" hidden><?php echo $i['first_name'].'|'.$i['middle_name'].'|'.$i['last_name']; ?></td>
                        <td class="td" hidden><?php echo $i['bdate']; ?></td>
                        <td><a id="aFind" class="btn btn-danger" data-id="<?php echo $type['typeid'].'|PAYOUT'?>" href="#">Select</a></td>
                    </tr>
                    <?php endforeach ?>
                  </tbody>
              </table>  
            <?php endif ?>
          </div>
        </div>

        <div class="row" id="stepTwo" style="display: none;">
          <div class="col-md-6">
            <form id="frmLandBankPayout">
              <div class="form-group"><h4>SENDER</h4></div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 150px;">FULL NAME:</span>
                    <input type="text" class="form-control" name="inputSenderName" id="inputSenderName" readonly="">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 161px;">ADDRESS:</span>
                    <input type="text" class="form-control" name="inputSenderAddress" id="inputSenderAddress"  readonly="">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 147px;">MOBILE NO.:</span>
                    <input type="text" class="form-control" name="inputMobileNo" id="inputMobileNo" readonly="">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 117px;">EMAIL ADDRESS:</span>
                    <input type="text" class="form-control" name="inputSenderEmail" id="inputSenderEmail" readonly="">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" style="padding-right: 107px;">COUNTRY (BIRTH):</span>
                    <select class="form-control" name="inputCountryBirth" id="inputCountryBirth" required>
                      <option value="" disabled selected>--CHOOSE COUNTRY BIRTH--</option> 

                      <?php  foreach ($country as $row): ?>
                        <option value="<?php echo $row['cname'] ?>"><?php echo $row['cname'] ?></option> 
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" style="padding-right: 141px;">NATIONALITY:</span>
                    
                    <select class="form-control" name="inputNationality" id="inputNationality" required>
                      <option value="" disabled selected>--CHOOSE NATIONALITY--</option> 

                      <?php  foreach ($country as $row): ?>
                        <option value="<?php echo $row['cname'] ?>"><?php echo $row['cname'] ?></option> 
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" style="padding-right: 30px;">RELATIONSHIP TO BENEFICIARY:</span>
                    
                    <select class="form-control" name="inputRelationshiptoBene" id="inputRelationshiptoBene" required>
                      <option value="" disabled selected>
                        --CHOOSE RELATIONSHIP--
                      </option>
                      <option value="Family">
                        Family
                      </option>
                      <option value="Friend">
                        Friend
                      </option>
                      <option value="Trade/BusinesPartner">
                        Trade/Business Partner 
                      </option>
                      <option value="Employee/Employer">
                        Employee/Employer
                      </option>
                      <option value="Donor/Receiver of Ch">
                        Donor/Receiver of Charitable Funds
                      </option>
                      <option value="Purchaser/Seller">
                        Purchaser/Seller
                      </option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" style="padding-right: 138px;">OCCUPATION:</span>
                    <select class="form-control" name="inputOccupation" id="inputOccupation" required>
                        <option value="" disabled selected>
                          --CHOOSE OCCUPATION--
                        </option>
                      <?php foreach ($occupations as $row): ?>
                        <option value="<?php echo $row['name'] ?>"><?php echo $row['name'] ?></option> 
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" style="padding-right: 152px;">EMPLOYER:</span>
                    <input type="text" class="form-control" name="inputEmployer" id="inputEmployer" placeholder="EMPLOYER" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" style="padding-right: 105px;">SOURCE OF FUND:</span>
                    
                    <select class="form-control" name="inputSourceofFund" id="inputSourceofFund" required>
                      <option value="" disabled selected>
                        --CHOOSE SOURCE--
                      </option>
                      <option value="Salary">
                        Salary
                      </option>
                      <option value="Savings">
                        Savings
                      </option>
                      <option value="Borrowed Funds">
                        Borrowed Funds/Loan
                      </option>
                      <option value="Gift">
                        Gift
                      </option>
                      <option value="Pension/Government/Welfare">
                      Pension/Government/Welfare
                      </option>
                      <option value="Inheritance">
                        Inheritance
                      </option>
                      <option value="Charitable Donations">
                        Charitable Donations
                      </option>
                    </select>
                  </div>
                </div>

                <div class="form-group"><h4>BENEFICIARY</h4></div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 150px;">FULL NAME:</span>
                    <input type="text" class="form-control" name="inputBeneficiaryName" id="inputBeneficiaryName" readonly="">
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 161px;">ADDRESS:</span>
                    <input type="text" class="form-control" name="inputBeneficiaryAddress" id="inputBeneficiaryAddress"  readonly="">
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 147px;">MOBILE NO.:</span>
                    <input type="text" class="form-control" name="inputBeneficiaryMobile" id="inputBeneficiaryMobile"  readonly="">
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 117px;">EMAIL ADDRESS:</span>
                    <input type="text" class="form-control" name="inputBeneficiaryEmail" id="inputBeneficiaryEmail"  readonly="">
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" style="padding-right: 107px;">COUNTRY (BIRTH):</span>
                    <select class="form-control" name="inputBeneficiaryCountryBirth" id="inputBeneficiaryCountryBirth" required>
                      <option value="" disabled selected>--CHOOSE COUNTRY BIRTH--</option> -
                      <?php  foreach ($country as $row): ?>
                        <option value="<?php echo $row['cname'] ?>"><?php echo $row['cname'] ?></option> 
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" style="padding-right: 141px;">NATIONALITY:</span>
                    <select class="form-control" name="inputBeneficiaryNationality" id="inputBeneficiaryNationality" required>
                      <option value="" disabled selected>--CHOOSE NATIONALITY--</option> 
                      <?php  foreach ($country as $row): ?>
                        <option value="<?php echo $row['cname'] ?>"><?php echo $row['cname'] ?></option> 
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" style="padding-right: 30px;">RELATIONSHIP TO SENDER:</span>
                    
                    <select class="form-control" name="inputBeneficiaryRelationshiptoSender" id="inputBeneficiaryRelationshiptoSender" required>
                      <option value="" disabled selected>
                        --CHOOSE RELATIONSHIP--
                      </option>
                      <option value="Family">
                        Family
                      </option>
                      <option value="Friend">
                        Friend
                      </option>
                      <option value="Trade/BusinesPartner">
                        Trade/Business Partner 
                      </option>
                      <option value="Employee/Employer">
                        Employee/Employer
                      </option>
                      <option value="Donor/Receiver of Ch">
                        Donor/Receiver of Charitable Funds
                      </option>
                      <option value="Purchaser/Seller">
                        Purchaser/Seller
                      </option>
                    </select>
                  </div>
                </div>
                
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" style="padding-right: 138px;">OCCUPATION:</span>
                    
                    <select class="form-control" name="inputBeneficiaryOccupation" id="inputBeneficiaryOccupation" required>
                      <option value="" disabled selected>
                        --CHOOSE OCCUPATION--
                      </option>
                      <?php foreach ($occupations as $row): ?>
                        <option value="<?php echo $row['name'] ?>"><?php echo $row['name'] ?></option> 
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" style="padding-right: 152px;">EMPLOYER:</span>
                    <input type="text" class="form-control" name="inputBeneficiaryEmployer" id="inputBeneficiaryEmployer" placeholder="EMPLOYER" required>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" style="padding-right: 105px;">SOURCE OF FUND:</span>
                    <select class="form-control" name="inputBeneficiarySourceofFund" id="inputBeneficiarySourceofFund" required>
                      <option value="" disabled selected>
                        --CHOOSE SOURCE--
                      </option>
                      <option value="Salary">
                        Salary
                      </option>
                      <option value="Savings">
                        Savings
                      </option>
                      <option value="Borrowed Funds">
                        Borrowed Funds/Loan
                      </option>
                      <option value="Gift">
                        Gift
                      </option>
                      <option value="Pension/Government/Welfare">
                      Pension/Government/Welfare
                      </option>
                      <option value="Inheritance">
                        Inheritance
                      </option>
                      <option value="Charitable Donations">
                        Charitable Donations
                      </option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <h4>TRANSACTION DETAILS</h4>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" style="padding-right: 152px;">ACCOUNT NO.:</span>
                    <input type="text" class="form-control" name="inputAccountNo" id="inputAccountNo" placeholder="ACCOUNT NO." required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6" style="padding-right: 0px;">
                      <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1" style="padding-right: 89px;">AMOUNT:</span>
                        <input type="number" class="form-control inputAmount" name="inputPRINAmount" id="inputPRINAmount" placeholder="0.00" required>
                      </div>
                    </div>
                    <div class="col-md-3" style="padding-right: 0px;">
                      <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1" style="padding-right: 89px;">SERVICE CHARGE:</span>
                        <input type="number" class="form-control inputServiceCharge" id="inputServiceCharge" value="150" readonly>
                      </div>
                    </div>
                    <div class="col-md-3" style="padding-right: 0px;">
                      <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1" style="padding-right: 89px;">TOTAL AMOUNT:</span>
                        <input type="number" class="form-control inputTotalAmount" id="inputTotalAmount" placeholder="0.00" readonly >
                      </div>
                    </div>
                  </div>
                 
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 150px;">PRIMARY ID: </span>
                    <input type="number" class="form-control selvalidID1_western" name="selvalidID1_western" id="selvalidID1_western" placeholder="0.00" required>
                    <!-- <select class="form-control preferenceSelectwestern" name="selvalidID1_western" id="selvalidID1_western" style="display: none;" required>
                        <option value="" disabled selected>--CHOOSE VALID ID--</option>   
                        
                    </select> -->
                    <!-- <span class="form-control" id="spinAnimationWestern1"><i class="fa fa-spinner fa-spin fa-lg" aria-hidden="true"></i> Please wait fetching details...</span> -->
                  </div>
                </div>

                <div class="form-group" id="id_details1_western" style="border-top: 2px solid gray; border-bottom: 3px solid gray; background: #cccccc; text-align: center; display:none;"> 
                  <h4>PRIMARY ID DETAILS</h4>
                  <div class="input-group">
                    <span class="input-group-addon" id="id1_type" style="padding-right: 176px;">ID TYPE:</span>
                    <input type="text" class="form-control" name="id_detailtype1" id="id_detailtype1" readonly="">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon" id="id1_number" style="padding-right: 152px;">ID NUMBER:</span>
                    <input type="text" class="form-control" name="id_detailnumber1" id="id_detailnumber1" readonly="">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon" id="id1_expirydate" style="padding-right: 139px;">EXPIRY DATE:</span>
                    <input type="text" class="form-control" name="id_detailexpiry1" id="id_detailexpiry1" readonly="">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon" id="id1_createddate" style="padding-right: 124px;">CREATED DATE:</span>
                    <input type="text" class="form-control" name="id_detailcreated1" id="id_detailcreated1" readonly="">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 167px;">ID IMAGE:</span>
                    <a class="form-control btn btn-info" id="id_attachment1" href="" target="_blank">View</a>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 67px;">PASSWORD:</span>
                    <input type="password" class="form-control" name="inputTpass" id="inputTpass" placeholder="TRANSACTION PASSWORD" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                      <div class="col-md-12 text-right">
                        <a id="btnCancel" class="btn btn-warning"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Cancel</a>
                        <button type="submit" id="btnSubmit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Submit</button>
                      </div>
                  </div>
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" name="inputSenderID" id="inputSenderID"/>
                    <input type="hidden" class="form-control" name="inputBeneficiaryID" id="inputBeneficiaryID"/>
                </div>
              </div>
            </form>
          </div>
        </div>
          
        <!-- PRIMARY ID MODAL -->
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

        <!---DIV ALERT-->
        <div class='divAlert'></div>
        
        <!---ADD NEW SENDER AND BENIFICIARY-->
        <div class="modal fade" id="addModal" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">ADD NEW SENDER AND BENIFICIARY</h4>
              </div>
              <form class="frmLandbankSender" id="">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <div class="col-md-4 tight-gutter"><input type="text" class="form-control" name="inputFname" id="inputFname" placeholder="FIRSTNAME"></div>
                          <div class="col-md-4 tight-gutter"><input type="text" class="form-control" name="inputMname" id="inputMname" placeholder="MIDDLENAME"></div>
                          <div class="col-md-4 tight-gutter"><input type="text" class="form-control" name="inputLname" id="inputLname" placeholder="LASTNAME"></div>
                      </div>    

                      <div class="form-group">
                          <input type="text" class="form-control" name="modInputStreet" id="modInputStreet" placeholder="HOUSE NO./STREET NO.">
                      </div>

                      <div class="form-group">
                          <input type="text" class="form-control" name="modInputBrgy" id="modInputBrgy" placeholder="BRGY NO.">
                      </div>
                      
                      <div class="form-group">
                          <div class="col-md-4 tight-gutter"><input type="text" class="form-control" name="modInputCity" id="modInputCity" placeholder="CITY"></div>
                          <div class="col-md-8 tight-gutter">
                              <input style="display:none;" class="form-control" name="modInputProvince" id="modInputProvince" placeholder="PROVINCE" />
                              <select class="form-control" name="modSelectProvince" id="modSelectProvince" placeholder="PROVINCE">
                                  <option value="" disabled selected>
                                  PROVINCE
                                  </option>

                                  <?php foreach ($provinces as $row): ?>
                                  <option value="<?php echo $row['name'] ?>"><?php echo $row['name'] ?></option> 
                                  <?php endforeach ?>
                              </select>
                          </div>
                      </div>  
                      
                      <div class="form-group">
                          <!-- <input type="text" class="form-control" name="inputCountry" id="inputCountry" placeholder="COUNTRY"> -->
                          <select id="selCountry" name="selCountry" class="form-control" required>
                              <?php  foreach ($country as $row): ?>
                              <option value="<?php echo $row['cname'] ?>">
                                  <?php echo $row['cname'] ?>
                              </option> 
                              <?php endforeach ?>
                          </select>
                      </div>

                      <div class="form-group">
                          <div class="col-md-6 tight-gutter"><input type="text" class="form-control" name="modInputZipCode" id="modInputZipCode" placeholder="ZIP CODE"></div>
                          <div class="col-md-6 tight-gutter"><input type="text" class="form-control" name="modInputAreaCode" id="modInputAreaCode" placeholder="AREA CODE"></div>
                      </div>  

                      <div class="col-md-8" style="padding-left:0px!important">
                          <div class="form-group" >
                              <input type="text" class="form-control" name="modInputNationality" id="modInputNationality" placeholder="NATIONALITY">
                          </div> 
                      </div>

                      <div class="col-md-4"  style="padding-right:0px!important">
                          <div class="form-group">
                              <select name="selGender" id="selGender" class="form-control">
                                  <option value="" selected disabled>GENDER</option>
                                  <option value="Male">MALE</option>
                                  <option value="Female">FEMALE</option>
                              </select>
                          </div> 
                      </div>

                      <div class="form-group">
                          <input type="text" class="form-control" name="inputProfession" id="inputProfession" placeholder="PROFESSION">
                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control" name="inputPhoneNo" id="inputPhoneNo" placeholder="PHONE NO">
                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control" name="inputMobileNo" id="inputMobileNo" placeholder="MOBILE NO">
                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control" name="inputOfficeNo" id="inputOfficeNo" placeholder="OFFICE NO">
                      </div>
                      <div class="col-md-8" style="padding-left:0px!important">
                          <div class="form-group">
                              <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1">BIRTHDATE</span>
                                  <input type="text"  max="<?= date('Y-m-d'); ?>" class="form-control" name="inputBdate" id="inputBdate" placeholder="BIRTHDATE" />
                              </div>
                          </div>
                      </div> 
                      <div class="col-md-4" style="padding-right:0px!important">
                          <div class="form-group">
                              <select name="selCivilStatus" id="selCivilStatus" class="form-control">
                                  <option value="" selected disabled>CIVIL STATUS</option>
                                  <option value="Single">SINGLE</option>
                                  <option value="Married">MARRIED</option>
                                  <option value="Widowed">WIDOWED</option>
                                  <option value="Divorced">DIVORCED</option>
                              </select>
                          </div> 
                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control" name="inputEmail" id="inputEmail" placeholder="EMAIL ADDRESS">
                      </div>
                      <div class="form-group">
                          <input type="password" class="form-control" name="inputTpass" id="currency" placeholder="TRANSPASS">
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
        <!---ADD NEW SENDER AND BENIFICIARY-->

    </div>
    <!-- content panel -->
</div>
<!-- main panel -->


<script src="<?php echo BASE_URL()?>assets/script/landbank_send.js?v10"></script>





    