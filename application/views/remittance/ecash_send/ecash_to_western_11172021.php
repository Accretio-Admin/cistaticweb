<div class="mainpanel">
  <div class="pageheader">
    <div class="media">
      <div class="pageicon pull-left">
        <i class="fa fa-money"></i>
      </div>

      <div class="media-body">
        <ul class="breadcrumb">
          <li>
            <a href="<?php echo BASE_URL('/Main')?>">
              <i class="glyphicon glyphicon-home"></i>
            </a>
          </li>

          <li>  
            ECASH 
          </li>
        </ul>

        <h4>
          WESTERN UNION
        </h4>
      </div>
    </div>
  </div>

  <div class="contentpanel" style="padding-bottom: 0px;">
    <div class="col-lg-12"> 
      <div class="row" style="margin-bottom: 30px;">
        <ul class="nav nav-tabs">
          <li class="active">
            <a href="<?php echo BASE_URL()?>ecash_send/ecashtowestern?nocached=0678b8983cb26f2d3293a404337d6174" style="color: #428bca;">
              <b>SENDING</b>
            </a>
          </li> 

          <li>
            <a href="<?php echo BASE_URL()?>ecash_send/logs_ecashtowestern">
              PENDING
            </a>
          </li>  
          
          <li>
            <a href="<?php echo BASE_URL()?>ecash_send/done_ecashtowestern">
              DONE
            </a>
          </li> 
        </ul>
      </div>
    </div>
      
      <div class="col-lg-12"> 
        <div class="row">
          <div style="display:none; text-align: center;" id="alertDynammic"></div>
            <?php if ($API['S']===0): ?>
              <div class="alert alert-danger">
                <b><?php echo $API['M']?></b>
              </div>
            <?php endif ?>

            <?php if ($API['S']==1): ?>
              <div class="alert alert-success">
                <b><?php echo $API['M']?></b>
              </div>
            <?php endif ?>
        </div>
      </div>

      <?php if ($details['process'] == 0): ?>
        <div class="row row-stat" id="stepOne">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <a href="#" id="addSenderBeneWU" class="btn btn-primary" data-toggle="modal" data-target="#addModal"><span class="glyphicon glyphicon-plus"></span> &nbsp;New Sender / Beneficiary</a> 
                    </div>

                    <div class="form-group">
                      <form name="frmecashpadalasender" action="<?php echo BASE_URL() ?>ecash_send/ecashtowestern?nocached=0678b8983cb26f2d3293a404337d6174" method="post" id="frmSSeachRemit" >
                        <div class="row">
                          <div class='col-xs-12 col-md-12'>
                            <div class="row">
                              <div class="col-md-10">
                                <input type="text" class="form-control" id="inputWesternSenderName" name="inputSearch" placeholder="SEARCH SENDER NAME" value="<?php echo $type['inputSenderName']; ?>" required/>
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
                      <form name="frmecashpadalabeneficiary" action="<?php echo BASE_URL() ?>ecash_send/ecashtowestern?nocached=0678b8983cb26f2d3293a404337d6174" method="post" id="frmBSeachRemit"  >
                        <div class="row">
                          <div class='col-xs-12 col-md-12'>
                            <div class="row">
                              <div class="col-md-10">
                                <input type="text" class="form-control" id="inputWesternBeneficiaryName" name="inputSearch" placeholder="SEARCH BENEFICIARY NAME" required />

                                <input type="hidden" name="inputSenderHide" id="inputSenderHide" value="<?php echo $type['inputSender']?>"/>

                                <input type="hidden" name="inputBenificiaryHide" id="inputBeneficiaryHide" />
                              </div>

                              <div class="col-md-2">
                                <button type="submit" name= "btnBsearch" id="btnBene" class="btn btn-primary">
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
                    <a href="#" class="btn btn-warning btnProceedWestern" style="display:none">Proceed Transaction &nbsp;<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></a>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <?php if ($row['S']===0): ?>
                  <div class="alert alert-danger"><b><?php echo $row['M']; ?>!!</b></div>
                <?php endif ?>

                <?php if ($row['S']==1): ?>
                  <hr />

                  <h4><?php echo $type['typedesc']; ?> Result :</h4>

                  <table id="resultTable"  class="table table-bordered" cellspacing="0" style="width:100%;">
                    <thead>
                      <tr>
                        <th>Loyalty Cardno</th>
                        <th>Fullname</th>
                        <th>Address</th>
                        <th>Mobile No</th>
                        <th>E-Mail</th>
                        <th>Coverage</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php foreach ($row['result'] as $i): ?>
                        <tr class="tr">
                          <td class="td" style="<?php echo ($i['country'] == 'PHILIPPINES' || $i['country'] == 'Philippines') ? '' : 'color: red;' ?>"><?php echo $i['loyaltycardno']; ?></td>
                          <td class="td" style="<?php echo ($i['country'] == 'PHILIPPINES' || $i['country'] == 'Philippines') ? '' : 'color: red;' ?>"><?php echo $i['fullname']; ?></td>
                          <td class="td" style="<?php echo ($i['country'] == 'PHILIPPINES' || $i['country'] == 'Philippines') ? '' : 'color: red;' ?>"><?php echo $i['address']; ?></td>
                          <td class="td" style="<?php echo ($i['country'] == 'PHILIPPINES' || $i['country'] == 'Philippines') ? '' : 'color: red;' ?>"><?php echo $i['mobileno']; ?></td>
                          <td class="td" style="<?php echo ($i['country'] == 'PHILIPPINES' || $i['country'] == 'Philippines') ? '' : 'color: red;' ?>"><?php echo $i['email']; ?></td>
                          <td class="td" hidden><?php echo $i['fname'].'|'.$i['mname'].'|'.$i['lname']; ?></td>
                          <td class="td" hidden><?php echo $i['bdate']; ?></td>
                          <td class="td" style="<?php echo ($i['country'] == 'PHILIPPINES' || $i['country'] == 'Philippines') ? '' : 'color: red;' ?>"><?php echo ($i['country'] == 'PHILIPPINES' || $i['country'] == 'Philippines') ? 'DOMESTIC' : 'INTERNATIONAL'; ?></td>
                          <td class="td" hidden><?php echo $i['country']; ?></td>
                          <td class="td" hidden><?php echo $i['city']; ?></td>
                          <td class="td" hidden><?php echo $i['province']; ?></td>
                          <td class="td" hidden><?php echo $i['postal']; ?></td>
                          <td class="td" hidden><?php echo $i['address1']; ?></td>
                          <td class="td" hidden><?php echo $i['address2']; ?></td>
                          <td class="td" hidden><?php echo $i['gender'] == 'M' ? 'Male' : 'Female'; ?></td>

                          <td>
                            <?php if ($i['update_tag'] == "1") { ?>
                              <a 
                                class="btn btn-danger" 
                                id="aFindWestern" 
                                data-id="<?php echo $type['typeid'] . '|' . 'SEND'?>"
                                href="#"
                              >
                                Select
                              </a>
                            <?php } else { ?>
                              <a 
                                class="btn btn-primary" 
                                id="aFindWestern"
                                data-id="<?php echo $type['typeid'] . '|' . 'SEND'?>"
                                data-toggle="modal" 
                                data-target="#updateModal"
                                href="#"
                              >
                                Update
                              </a>
                            <?php } ?>
                          </td>
                        </tr>
                      <?php endforeach ?>
                    </tbody>
                  </table>      
                <?php endif ?>
              </div>
            </div>
          </div>
        </div>

        <div class="row" id="stepTwo" style="display: none;">
          <div class="col-md-6">
            <div>
              <span style="font-weight: bold; font-size: 20px; font-style: italic; color: red;">
                **NOTE**
              </span>

              <br/>

              <span style="font-weight: bold; font-size: 20px; font-style: italic;" id="spanCoverage"></span>
            </div>

            <form id="frmWesternSender">
              <div class="form-group">
                <h4>SENDER</h4>
              </div>

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
                <h4>BENEFICIARY</h4>
              </div>

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
                <h4>IDENTIFICATION</h4>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 150px;">PRIMARY ID: </span>

                  <select class="form-control preferenceSelectwestern" name="selvalidID1_western" id="selvalidID1_western" style="display: none;" required>
                      <option value="" disabled selected>--CHOOSE VALID ID--</option>   
                      <!-- <option value="add_id">ADD ID</option> CHOOSE VALID ID-->
                  </select>

                  <span class="form-control" id="spinAnimationWestern1"><i class="fa fa-spinner fa-spin fa-lg" aria-hidden="true"></i> Please wait fetching details...</span>
                </div>
              </div>

              <div class="form-group" id="id_details1_western" style="border-top: 2px solid gray; border-bottom: 3px solid gray; background: #cccccc; text-align: center; display:none;"> 
                <h4>
                  PRIMARY ID DETAILS
                </h4>

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

              <div class="form-group" style="display: none;">
                  <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 150px; display: none;">SECONDARY ID: </span>
                  <select class="form-control preferenceSelectwestern" name="selvalidID2_western" id="selvalidID2_western" style="display: none;">
                      <option value="" disabled selected>--CHOOSE VALID ID--</option>  
                  </select>
                  <span class="form-control" id="spinAnimationWestern2"><i class="fa fa-spinner fa-spin fa-lg" aria-hidden="true"></i> Please wait fetching details...</span>
                  </div>
              </div>

              <div class="form-group" id="id_details2_western" style="border-top: 2px solid gray; border-bottom: 3px solid gray; background: #cccccc; text-align: center; display:none;"> 
                <h4>
                  SECONDARY ID DETAILS
                </h4>

                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 176px;">ID TYPE:</span>
                  <input type="text" class="form-control" name="id_detailtype2" id="id_detailtype2" readonly="">
                </div>

                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 152px;">ID NUMBER:</span>
                  <input type="text" class="form-control" name="id_detailnumber2" id="id_detailnumber2" readonly="">
                </div>

                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 139px;">EXPIRY DATE:</span>
                  <input type="text" class="form-control" name="id_detailexpiry2" id="id_detailexpiry2" readonly="">
                </div>

                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 124px;">CREATED DATE:</span>
                  <input type="text" class="form-control" name="id_detailcreated2" id="id_detailcreated2" readonly="">
                </div>

                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 167px;">ID IMAGE:</span>
                  <a class="form-control btn btn-info" id="id_attachment2" href="" target="_blank">View</a>
                </div>
              </div>

              <div class="form-group" style="display: none;">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 150px; display: none;">TERTIARY ID: </span>

                  <select class="form-control preferenceSelectwestern" name="selvalidID3_western" id="selvalidID3_western" style="display: none;">
                      <option value="" disabled selected>--CHOOSE VALID ID--</option>  
                  </select>

                  <span class="form-control" id="spinAnimationWestern2"><i class="fa fa-spinner fa-spin fa-lg" aria-hidden="true"></i> Please wait fetching details...</span>
                </div>
              </div>

              <div class="form-group" id="id_details3_western" style="border-top: 2px solid gray; border-bottom: 3px solid gray; background: #cccccc; text-align: center; display:none;"> 
                <h4>
                  TERTIARY ID DETAILS
                </h4>

                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 176px;">ID TYPE:</span>
                  <input type="text" class="form-control" name="id_detailtype3" id="id_detailtype3" readonly="">
                </div>

                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 152px;">ID NUMBER:</span>
                  <input type="text" class="form-control" name="id_detailnumber3" id="id_detailnumber3" readonly="">
                </div>

                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 139px;">EXPIRY DATE:</span>
                  <input type="text" class="form-control" name="id_detailexpiry3" id="id_detailexpiry3" readonly="">
                </div>

                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 124px;">CREATED DATE:</span>
                  <input type="text" class="form-control" name="id_detailcreated3" id="id_detailcreated3" readonly="">
                </div>

                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 167px;">ID IMAGE:</span>
                  <a class="form-control btn btn-info" id="id_attachment3" href="" target="_blank">View</a>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="padding-right: 87px;">ID COUNTRY ISSUED:</span>
                  
                  <select class="form-control" name="inputIdCountryIssued" id="inputIdCountryIssued" required>
                    <option value="" disabled selected>--CHOOSE COUNTRY--</option> 

                    <?php  foreach ($country as $row): ?>
                      <option value="<?php echo $row['cname'] ?>"><?php echo $row['cname'] ?></option> 
                    <?php endforeach ?>
                  </select>
                </div>
              </div>

              <h4>
                TRANSACTION DETAILS
              </h4>

              <!-- <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="padding-right: 79px;">BRANCH LOCATION:</span>
                  
                  <select class="form-control" name="inputBranchLocation" id="inputBranchLocation" required>
                    <option value="" disabled selected>
                      --CHOOSE BRANCH LOCATION--
                    </option>
                    <?php  foreach ($branch_locations as $branch_location): ?>
                      <option value="<?php echo $branch_location; ?>"><?php echo $branch_location; ?></option> 
                    <?php endforeach ?>
                  </select>
                </div>
              </div> -->

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="padding-right: 198px;">CITY:</span>
                  <input type="text" class="form-control" name="inputCity" id="inputCity" placeholder="CITY" required>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="padding-right: 147px;">PROVINCES:</span>
                  
                  <select class="form-control" name="inputProvince" id="inputProvince" required>
                    <option value="" disabled selected>
                      --CHOOSE PROVINCE--
                    </option>

                    <?php foreach ($provinces as $row): ?>
                      <option value="<?php echo $row['name'] ?>"><?php echo $row['name'] ?></option> 
                    <?php endforeach ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="padding-right: 131px;">POSTAL CODE:</span>
                  <input type="text" pattern="[0-9]+" class="form-control" name="inputPostalCode" id="inputPostalCode" placeholder="POSTAL CODE" required>
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
                  <span class="input-group-addon" style="padding-right: 120px;">POSITON LEVEL:</span>
                  
                  <select class="form-control" name="inputPositionLevel" id="inputPositionLevel" required>
                    <option value="" disabled selected>
                      --CHOOSE POSITION LEVEL--
                    </option>

                    <option value="Entry Level">
                      Entry Level
                    </option>

                    <option value="Mid-Level/Supervisory/Management">
                      Mid-Level/Supervisory/Management
                    </option>

                    <option value="">
                      Senior Level/Executive
                    </option>

                    <option value="">
                      Owner
                    </option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="padding-right: 30px;">RELATIONSHIP TO RECEIVER:</span>
                  
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
                  <span class="input-group-addon" style="padding-right: 100px;">SENDER COUNTRY:</span>
                  
                  <select class="form-control" name="country_iso" id="country_iso" required>
                    <option value="" disabled selected>--CHOOSE COUNTRY--</option> 

                    <?php  foreach ($country as $row): ?>
                      <option value="<?php echo $row['iso_code'] ?>"><?php echo $row['cname'] ?></option> 
                    <?php endforeach ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="padding-right: 65px;">DESTINATION COUNTRY:</span>
                  <input type="text" class="form-control" name="inputDestinationCountry" id="inputDestinationCountry" placeholder="DESTINATION COUNTRY" readonly required>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="padding-right: 55px;">DESTINATION CURRENCY:</span>
                  
                  <select class="form-control" name="inputDestinationCurrency" id="inputDestinationCurrency" required>
                    <option value="" disabled selected>--CHOOSE CURRENCY--</option> 

                    <?php  foreach ($currency_codes as $row): ?>
                      <option value="<?php echo $row['currency'] ?>"><?php echo $row['country'] . " (".$row['currency'].")" ?></option> 
                    <?php endforeach ?>
                  </select>
                </div>
              </div>

              <div class="form-group" id="stateCodeContainer" style="display: none;">
                <div class="input-group">
                  <span class="input-group-addon" style="padding-right: 143px;">STATE CODE:</span>
                  
                  <select class="form-control" name="inputStateCode" id="inputStateCode">
                    <option value="" disabled selected>--CHOOSE STATE CODE--</option>
                  </select>
                </div>
              </div>

              <!-- <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="padding-right: 79px;">SENDER CURRENCY CODE:</span>
                  
                  <select class="form-control" name="inputSenderCurrencyCode" id="inputSenderCurrencyCode" required>
                    <option value="" disabled selected>
                      --CHOOSE CURRENCY--
                    </option> 
                  </select>
                </div>
              </div> -->

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="padding-right: 67px;">TRANSACTION REASON:</span>
                  
                  <select class="form-control" name="inputTransactionReason" id="inputTransactionReason" required>
                    <option value="" disabled selected>--CHOOSE REASON--</option> 

                    <option value="Family Support/Living Expenses ">
                      Family Support/Living Expenses
                    </option> 

                    <option value="Saving/Investments">
                      Saving/Investments
                    </option>

                    <option value="Gift">
                      Gift
                    </option> 

                    <option value="Goods & Services payment">
                      Goods & Services payment
                    </option> 

                    <option value="Travel expenses">
                      Travel expenses
                    </option> 

                    <option value="Education/School Fee">
                      Education/School Fee
                    </option> 

                    <option value="Rent/Mortgage">
                      Rent/Mortgage
                    </option> 

                    <option value="Emergency/Medical Aid">
                      Emergency/Medical Aid
                    </option> 

                    <option value="Charity/Aid Payment">
                      Charity/Aid Payment
                    </option> 

                    <option value="Employee Payroll/Employee Expense">
                      Employee Payroll/Employee Expense
                    </option> 

                    <option value="Prize or Lottery Fees/Taxes">
                      Prize or Lottery Fees/Taxes
                    </option> 
                  </select>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-9" style="padding-right: 0px;">
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1" style="padding-right: 96px;">PRINCIPAL AMOUNT:</span>
                      <input type="text" class="form-control inputAmount" name="inputPRINAmount" id="inputPRINAmount" placeholder="0.00" disabled required>
                    </div>
                  </div>

                  <div class="col-md-3" style="padding-left: 0px;">
                    <select class="form-control" name="currency" id="currency" disabled required>
                      <option value="PHP" selected>PHP</option>   
                    
                      <?php  foreach ($currency_codes as $row): ?>
                        <option value="<?php echo $row['currency'] ?>"><?php echo $row['currency'] ?></option> 
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 106px;">SERVICE CHARGE:</span>
                  <input type="text" class="form-control" name="inputSCAmount" id="inputSCAmount" placeholder="0.00" readonly>
                  <span class="form-control spinAnimationWesternCharge" style="display: none;" readonly><i class="fa fa-spinner fa-spin fa-lg" aria-hidden="true"></i> Computing charges...</span>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 125px;">TOTAL AMOUNT:</span>
                  <input type="text" class="form-control " name="inputTotalAmount" id="inputTotalAmount" placeholder="0.00" readonly>
                  <span class="form-control spinAnimationWesternCharge" style="display: none;" readonly>0.00</span>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 150px;">PASSWORD:</span>
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
                <input type="hidden" class="form-control" name="inputBeneCountry" id="inputBeneCountry"/>
              </div>
            </form>
          </div>
        </div>
      <?php endif ?>

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

          <h4 class="modal-title">
            ADD NEW SENDER AND BENEFICIARY
          </h4>
        </div>

        <form action="<?php echo BASE_URL() ?>ecash_send/ecashtowestern?nocached=0678b8983cb26f2d3293a404337d6174" method="post"  id="frmAddEcashPadala">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <input type="text" class="form-control" name="inputFname" pattern="[^'\x22]+" title="Reason doesn't accept &#39; or &#34;. e.g. Example&#39;s Name" placeholder="FIRSTNAME" required/>
                </div> 

                <div class="form-group">
                  <input type="text" class="form-control" name="inputMname" pattern="[^'\x22]+" title="Reason doesn't accept &#39; or &#34;. e.g. Example&#39;s Name" placeholder="MIDDLENAME" required/>
                </div> 

                <div class="form-group">
                  <input type="text" class="form-control" name="inputLname" pattern="[^'\x22]+" title="Reason doesn't accept &#39; or &#34;. e.g. Example&#39;s Name" placeholder="LASTNAME" required/>
                </div> 

                <div class="form-group">
                  <input type="email" class="form-control" name="inputEmail" pattern="[^'\x22]+" title="Reason doesn't accept &#39; or &#34;. e.g. Example&#39;s Name" placeholder="EMAIL" required/>
                </div>
              </div>

              <div class='col-md-8'>
                <div class="form-group" >
                  <input type="text" class="form-control" name="inputMobile" pattern="[^'\x22]+" title="Reason doesn't accept &#39; or &#34;. e.g. Example&#39;s Name" placeholder="MOBILE NUMBER" required/>
                </div> 
              </div>

              <div class='col-md-4'>
                <div class="form-group">
                  <select name="selGender" class="form-control" required>
                    <option value="" selected disabled>GENDER</option>
                    <option value="Male">MALE</option>
                    <option value="Female">FEMALE</option>
                  </select>
                </div> 
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <input class="form-control" name="modInputCity" id="modInputCity" pattern="[^'\x22]+" title="Reason doesn't accept &#39; or &#34;. e.g. Example&#39;s Name" placeholder="CITY" required/>
                </div>

                <div class="form-group">
                  <input style="display:none;" class="form-control" name="modInputProvince" id="modInputProvince" placeholder="PROVINCE" />

                  <select style="display: none;" class="form-control" name="modSelectProvince" id="modSelectProvince" placeholder="PROVINCE">
                    <option value="" disabled selected>
                      PROVINCE
                    </option>

                    <?php foreach ($provinces as $row): ?>
                      <option value="<?php echo $row['name'] ?>"><?php echo $row['name'] ?></option> 
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <input class="form-control" name="modInputPostal" id="modInputPostal" pattern="[^'\x22]+" title="Reason doesn't accept &#39; or &#34;. e.g. Example&#39;s Name"  placeholder="POSTAL/ZIP CODE" required/>
                </div>

                <div class="form-group"> 
                  <textarea name="modInputAddr1" id="modInputAddr1" class="form-control" minlength="10" maxlength="40" pattern="[^'\x22]+" title="Reason doesn't accept &#39; or &#34;. e.g. Example&#39;s Name" placeholder="ADDRESS LINE 1" required></textarea>
                </div> 

                <div class="form-group"> 
                  <textarea name="modInputAddr2" id="modInputAddr2" class="form-control" minlength="10" maxlength="40" pattern="[^'\x22]+" title="Reason doesn't accept &#39; or &#34;. e.g. Example&#39;s Name" placeholder="ADDRESS LINE 2"></textarea>
                </div>

                <div class="form-group"> 
                  <input type="hidden" name="inputAddr" id="inputAddr" class="form-control" pattern="[^'\x22]+" title="Reason doesn't accept &#39; or &#34;. e.g. Example&#39;s Name" placeholder="ADDRESS"></input>
                </div> 
              </div>

              <div class='col-md-8'>
                <div class="form-group" >
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">BIRTHDATE</span>
                    <!-- <input type="text" class="form-control" name="inputBdate" id="datetimepicker" placeholder="BIRTHDATE" readonly required/> -->
                    <input type="date" max="<?= date('Y-m-d'); ?>" class="form-control" name="inputBdate" id="inputBdate" placeholder="BIRTHDATE" required/>
                  </div>
                </div> 
              </div>
              
              <div class='col-md-4'>
                <div class="form-group">
                  <select id="selCountry" name="selCountry" class="form-control" required>

                    <?php  foreach ($country as $row): ?>
                      <option value="<?php echo $row['cname'] ?>">
                        <?php echo $row['cname'] ?>
                      </option> 
                    <?php endforeach ?>
                  </select>
                </div> 
              </div>

              <div class="col-md-12">
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
          </div>
        </form>
      </div>
    </div>  
  </div>


  <!--UPDATE SENDER AND BENEFICIARY-->
  <div class="modal fade" id="updateModal" role="dialog" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">
            UPDATE SENDER AND BENEFICIARY
          </h4>
        </div>

        <form action="<?php echo BASE_URL() ?>ecash_send/ecashtowestern?nocached=0678b8983cb26f2d3293a404337d6174" method="post" id="frmUpdateSenderBene">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <input type="hidden" class="form-control" id="updateInputClientId" name="updateInputClientId" placeholder="CLIENT ID" readonly required/>
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" id="updateInputFname" name="updateInputFname" placeholder="FIRSTNAME" readonly required/>
                </div> 

                <div class="form-group">
                  <input type="text" class="form-control" id="updateInputMname" name="updateInputMname" placeholder="MIDDLENAME" readonly required/>
                </div> 

                <div class="form-group">
                  <input type="text" class="form-control" id="updateInputLname" name="updateInputLname"  placeholder="LASTNAME" readonly required/>
                </div> 

                <div class="form-group">
                  <input type="email" class="form-control" id="updateInputEmail" name="updateInputEmail"  placeholder="EMAIL" readonly required/>
                </div>
              </div>

              <div class='col-md-8'>
                <div class="form-group" >
                  <input type="text" class="form-control" id="updateInputMobile" name="updateInputMobile" placeholder="MOBILE NUMBER" readonly required/>
                </div> 
              </div>

              <div class='col-md-4'>
                <div class="form-group">
                  <input id="updateInputGender" name="updateInputGender" class="form-control" placeholder="GENDER" readonly required/>
                </div> 
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <input class="form-control" id="updateInputCity" name="updateInputCity" placeholder="CITY" required/>
                </div>

                <div class="form-group">
                  <input style="display: none;" class="form-control" id="updateInputProvince" name="updateInputProvince" placeholder="PROVINCE"/>

                  <select style="display: none;" class="form-control" id="updateSelectProvince" name="updateSelectProvince"  placeholder="PROVINCE">
                    <option value="METRO MANILA" selected>
                      METRO MANILA
                    </option>

                    <?php foreach ($provinces as $row): ?>
                      <option value="<?php echo $row['name'] ?>"><?php echo $row['name'] ?></option> 
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <input class="form-control" id="updateInputPostal" name="updateInputPostal" placeholder="POSTAL/ZIP CODE" required/>
                </div>

                <div class="form-group"> 
                  <textarea id="updateInputAddr1" name="updateInputAddr1" class="form-control" placeholder="ADDRESS LINE 1" required></textarea>
                </div> 

                <div class="form-group"> 
                  <textarea id="updateInputAddr2" name="updateInputAddr2" class="form-control" placeholder="ADDRESS LINE 2"></textarea>
                </div>

                <div class="form-group"> 
                  <input type="hidden" id="updateInputAddr" name="updateInputAddr" class="form-control" placeholder="ADDRESS"></input>
                </div> 
              </div>

              <div class='col-md-8'>
                <div class="form-group" >
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">BIRTHDATE</span>
                    <input type="date" max="<?= date('Y-m-d'); ?>" class="form-control" id="updateInputBdate" name="updateInputBdate" placeholder="BIRTHDATE" readonly required/>
                  </div>
                </div> 
              </div>
              
              <div class='col-md-4'>
                <div class="form-group">
                  <input id="updateInputCountry" name="updateInputCountry" class="form-control" placeholder="COUNTRY" readonly required></input>
                </div> 
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <input type="password" class="form-control" placeholder="TRANSACTION PASSWORD" name="updateInputTransPass" required autocomplete="off">
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
                <button type="submit" class="btn btn-default" id="btnUpdate" name="btnUpdateDetails">Submit &nbsp;<img id="imgloader" src="<?php echo BASE_URL()?>assets/images/loaders/loader1.gif" style="display:none" /></button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>  
  </div>
</div>

<script src="<?php echo BASE_URL()?>assets/script/ecash_western_11172021.js"></script>

<script>
  $("#resultTable").on("click", "tbody tr", function () {
    var rowData = []

    $(this).find("td").each(function () {
      rowData.push($(this).text())
    });

    const client_id = rowData[0]
    const [firstName, middleName, lastName] = rowData[1].split(' ');
    const mobile = rowData[3]
    const email = rowData[4]
    const birthDay = rowData[6]
    const country = rowData[8].toLowerCase().replace(/^.{1}/g, rowData[8][0].toUpperCase())
    const city = rowData[9]
    const province = rowData[10]
    const postal = rowData[11]
    const address1 = rowData[12]
    const address2 = rowData[13]
    const gender = rowData[14]

    $('#updateInputClientId').val(client_id)
    $('#updateInputFname').val(firstName)
    $('#updateInputMname').val(middleName)
    $('#updateInputLname').val(lastName)
    $('#updateInputEmail').val(email)
    $('#updateInputMobile').val(mobile)
    $('#updateInputBdate').val(birthDay)
    $('#updateInputCountry').val(country)
    $('#updateInputCity').val(city)
    $('#updateInputPostal').val(postal)
    $('#updateInputAddr1').val(address1)
    $('#updateInputAddr2').val(address2)
    $('#updateInputGender').val(gender)

    if (country == 'Philippines') { 
      $('#updateSelectProvince').show()
      $('#updateSelectProvince').attr('required', 'true');

      $('#updateInputProvince').hide()
      $('#updateInputProvince').removeAttr('required')
    } else { 
      $('#updateSelectProvince').hide()
      $('#updateSelectProvince').removeAttr('required')

      $('#updateInputProvince').show()
      $('#updateInputProvince').attr('required', 'true');
    }
  });

  $('#addSenderBeneWU').click(() => { 
    $('#selCountry').val('Philippines')

    if ($('#selCountry').val() === 'Philippines') { 
      $('#modSelectProvince').show()
      $('#modSelectProvince').attr('required', 'true');

      $('#modInputProvince').hide()
      $('#modInputProvince').removeAttr('required')
    } else {
      $('#modSelectProvince').hide()
      $('#modSelectProvince').removeAttr('required')

      $('#modInputProvince').show()
      $('#modInputProvince').attr('required', 'true');
    }
  })

  $('#selCountry').on('change', () => {
    if ($('#selCountry').val() === 'Philippines') { 
      $('#modSelectProvince').show()
      $('#modSelectProvince').attr('required', 'true')

      $('#modInputProvince').hide()
      $('#modInputProvince').removeAttr('required')
    } else {
      $('#modSelectProvince').hide()
      $('#modSelectProvince').removeAttr('required')

      $('#modInputProvince').show()
      $('#modInputProvince').attr('required', 'true')
    }
  })
  
  $('#modInputAddr1').bind('keydown', function(e){
    if((e.keyCode == 222 || e.keyCode == 13)){
      e.preventDefault();
    }
  });
  $('#modInputAddr2').bind('keydown', function(e){
    if((e.keyCode == 13 || e.keyCode == 222)){
      e.preventDefault();
    }
  });
</script>
