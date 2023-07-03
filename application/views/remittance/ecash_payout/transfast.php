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
                <h4>TRANSFAST</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel" style="padding-bottom: 0px;">
        <?php if ($API['S'] === 0): ?>
        <div class="alert alert-danger"><b><?php echo $API['M'] ?></b></div>
        <?php endif ?>
        <?php if ($API['S']== 1): ?>
        <div class="alert alert-success"><b><?php echo $API['M'] ?></b></div>
        <?php endif ?>
        <?php if ($result['S'] === 0): ?>
        <div class="alert alert-danger"><b><?php echo $result['M'] ?></b></div>
        <?php endif ?>
        <?php if ($result['S']== 1): ?>
        <div class="alert alert-success"><b><?php echo $result['M'] ?>
          <?php if($result['URL'] != ''):?></br><a href="<?php echo $result['URL']; ?>" target="_blank">View Receipt</a><?php endif ?>
        </b></div>
        <?php endif ?>
        <div class="alert alert-danger" style="display:none; text-align: center;" id="agreementfailed"><b></b></div>
         <div class="alert alert-success" style="display:none; text-align: center;" id="agreementsuccess"><b></b></div>
        <div class="row row-stat">
        <?php if ($API['S'] != "1"): ?>
            <div class="col-md-6">
              <div class="contentpanel" style="padding-top: 0px;"> 
                <div class="panel panel-default">
                  <div class="panel-heading" style="padding-top: 15px; padding-bottom: 0px;">

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
                  
                  <h5 style="font-weight: bold; color: #4169E1;">TRANSFAST</h5>
                  </div>
                  <div class="panel-body">
                    <form name="frmtransfast" action="<?php echo BASE_URL() ?>ecash_payout/transfast" method="post" class="frmclass" id="frmTransfast">
                      <div class="form-group">
                          <input type="text" class="form-control" name="inputReferenceNo" placeholder="REFERENCE NO." required/>
                      </div>
                        <div class="form-group">
                         <input type="text" class="form-control" name="inputSenderName" placeholder="SENDER NAME" required/>
                         
                      </div>
                        <div class="form-group">
                         <input type="text" class="form-control" name="inputBeneName" placeholder="BENEFICIARY NAME" required/>
                      </div>
                         <div class="form-group">
                          <input type="text" class="form-control" name="inputAmount" placeholder="AMOUNT" required/>
                      </div>
                      <div class="form-group">
                          <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required/>
                      </div>
                       <div class="form-group text-right">
                          <button type="submit" class="btn btn-primary"  name="btnTransfastCheck">Submit</button>
                      </div>
                    </form>
                  </div>
                 </div>
              </div>   
            </div>
            <?php endif; ?>

<!-- End of Ifelse IP is not equal to PH -->

            <?php endif ?>
            <?php if ($API['S'] == "1"): ?>
            <div class="col-md-6">
              <div class="contentpanel" style="padding-top: 0px;"> 
                <div class="panel panel-default">
                  <div class="panel-heading" style="padding-top: 0px; padding-bottom: 0px;">
                  <h5 style="font-weight: bold; color: #4169E1;" id="titletf">TRANSFAST</h5>
                  </div>
                  <div class="panel-body" style="padding-top: 0px;">
                    <form name="frmtransfast" action="<?php echo BASE_URL() ?>ecash_payout/transfast" method="post" class="frmclass" id="frmTransfast">
                      <h4>TRANSACTION DETAILS</h4>
                    <div class="form-group">
                        <div class="input-group" id="tf_data">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 10px;">REFERENCE NUMBER:</span>
                          <input type="text" class="form-control" name="inputReferenceNo" id="trackno" value="<?php echo $row['inputReferenceNo']; ?>"  readonly="">
                          <input type="text" class="form-control" name="inputTranstype" id="inputTranstype" value="TRANSFAST PAYOUT"  readonly="">
                          <input type="hidden" class="form-control" name="inputTransType" value="1" /> 
                          <input type="hidden" class="form-control" name="inputCountryIsoCode" id="CountryIsoCode" value="<?php echo $API['DATA']['ReceiverCountryIsoCode']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 31px;">TRANSACTION NO.:</span>
                          <input type="text" class="form-control" name="inputTN" value="<?php echo $API['DATA']['Reference']; ?>"  readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 82px;">CURRENCY:</span>
                          <input type="text" class="form-control" name="inputCurrency" value="<?php echo $API['DATA']['ReceiveCurrencyIsoCode']; ?>"  readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 102px;">AMOUNT:</span>
                          <input type="text" class="form-control" name="inputAmount" id="principalamount" value="<?php echo $API['DATA']['ReceiveAmount']; ?>"  readonly="">
                        </div>
                    </div>
                    <h4>SENDER</h4>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 6px;">SENDER NAME:</span>
                          <input type="text" class="form-control" name="inputSenderFName" id="sendername" value="<?php echo $API['DATA']['SenderFullName']; ?>"  readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 10px;">CONTACT NO.:</span>
                          <input type="text" class="form-control" name="inputSendertelno" value="<?php echo $API['DATA']['SenderPhoneMobile']; ?>"  readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 38px;">ADDRESS:</span>
                          <input type="text" class="form-control" name="inputSenderaddress" value="<?php echo $API['DATA']['SenderAddress'] . ', ' . $API['DATA']['SenderCityName'] . ', ' .  $API['DATA']['SenderStateName'] .', '. $API['DATA']['SenderCountryName']; ?>"  readonly="">
                        </div>
                    </div>
                    <h4>BENEFICIARY</h4>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 21px;">FIRST NAME:</span>
                          <input type="text" class="form-control" name="inputBeneficiaryFName" id="benefname" value="<?php echo $API['DATA']['ReceiverFirstName']; ?>"  readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 8px;">MIDDLE NAME:</span>
                          <input type="text" class="form-control" name="inputBeneficiaryMName" id="benemname" value="<?php echo $API['DATA']['ReceiverMiddleName']; ?>"  readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 26px;">LAST NAME:</span>
                          <input type="text" class="form-control" name="inputBeneficiaryLName" id="benelname" value="<?php echo $API['DATA']['ReceiverLastName']; ?>"  readonly="">
                          <input type="hidden" class="form-control" name="beneFullName" id="beneFullName" value="<?php echo $API['DATA']['ReceiverFullName']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 10px;">CONTACT NO.:</span>
                          <input type="text" class="form-control" name="inputBenetelno" value="<?php echo $API['DATA']['ReceiverPhoneMobile']; ?>"  readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 38px;">ADDRESS:</span>
                          <input type="text" class="form-control" name="inputBeneaddress" value="<?php echo $API['DATA']['ReceiverAddress'] . ', ' . $API['DATA']['ReceiverCityName'] . ', ' .  $API['DATA']['ReceiverStateName'] .', '. $API['DATA']['ReceiverCountryName']; ?>"  readonly="">
                        </div>
                    </div>

                    <h4 id="titletfID" style="display:none;">ID DETAILS</h4>

                   <div class="alert alert-danger" style="display:none; text-align: center;" id="updateexpiredtfId"><b></b></div>
                   <div class="alert alert-success" style="display:none; text-align: center;" id="addnewsuccesstfId"><b></b></div>

                    <div class="form-group" id="tsId" style="display:none;">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 93px;">ID:</span>
                          <input type="text" class="form-control" id="inputIdTypeDesc" name="inputIdTypeDesc"  readonly="" required>
                          <input type="hidden" class="form-control" id="inputIdType" name="inputIdType" required>
                          <span class="input-group-btn" id = "refreshtfspan">
                             <button type="button" class="btn btn-success" id="refreshTf">Refresh ID Details</button>
                           </span>
                        </div>
                    </div>

                    <div class="form-group" id="tsIdno"  style="display:none;">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 68px;">ID NO:</span>
                          <input type="text" class="form-control" id ="inputIdno" name="inputIdno"  readonly="" required>
                        </div>
                    </div>

                    <div class="form-group" id="tsIdExp"  style="display:none;">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 17px;">EXPIRY DATE:</span>
                          <input type="text" class="form-control" id="inputExpDate" name="inputExpDate" readonly="" required>
                         
                        </div>
                    </div>

                     <div class="form-group" id="transpassid">
                      
                    </div>

                    
            
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12 text-right" id="buttonConfirmTf">
                                <a type="button" id="btnCanceltf" class="btn btn-warning"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Cancel</a>
                                <a type="button" id="btnProceedtf" data-toggle = "modal" data-target="#myModaltf" class="btn btn-primary showModalTf"><span class="glyphicon glyphicon-triangle-right"></span>&nbsp;Proceed</a>
                            </div>
                        </div>
                    </div>
                    </form>
                  </div>
                </div>
               </div> 
            </div>
            <?php endif ?>
            
            <?php if ($process == 2):?>
            <!-- <div class="col-md-6">
              <div class="contentpanel" style="padding-top: 0px;"> 
                <div class="panel panel-default">
                  <div class="panel-heading" style="padding-top: 0px; padding-bottom: 0px;">
                  <h5 style="font-weight: bold; color: #4169E1;">TRANSACTION SUMMARY</h5>
                  </div>
                  <div class="panel-body" style="padding-top: 0px;">
                    <form name="frmtransfast" action="<?php echo BASE_URL() ?>ecash_payout/transfast" method="post" class="frmclass" id="frmTransfastPayout">
                      <h4>TRANSACTION </h4>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 10px;">REFERENCE NUMBER:</span>
                          <input type="text" class="form-control" name="inputReferenceNo" id="trackno" value="<?php echo $row['inputReferenceNo']; ?>"  readonly="">
                          <input type="text" class="form-control" name="inputTranstype" id="transtype" value="TRANSFAST PAYOUT"  readonly="">
                          <input type="hidden" class="form-control" name="inputCountryIsoCode" id="CountryIsoCode" value="<?php echo $API['DATA']['ReceiverCountryIsoCode']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 31px;">TRANSACTION NO.:</span>
                          <input type="text" class="form-control" name="inputTN" value="<?php echo $API['DATA']['Reference']; ?>"  readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 82px;">CURRENCY:</span>
                          <input type="text" class="form-control" name="inputCurrency" value="<?php echo $API['DATA']['ReceiveCurrencyIsoCode']; ?>"  readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 102px;">AMOUNT:</span>
                          <input type="text" class="form-control" name="inputAmount" id="principalamount" value="<?php echo $API['DATA']['ReceiveAmount']; ?>"  readonly="">
                        </div>
                    </div>
                    <h4>SENDER</h4>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 6px;">SENDER NAME:</span>
                          <input type="text" class="form-control" name="inputSenderFName" id="sendername" value="<?php echo $API['DATA']['SenderFullName']; ?>"  readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 10px;">CONTACT NO.:</span>
                          <input type="text" class="form-control" name="inputSendertelno" value="<?php echo $API['DATA']['SenderPhoneMobile']; ?>"  readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 38px;">ADDRESS:</span>
                          <input type="text" class="form-control" name="inputSenderaddress" value="<?php echo $API['DATA']['SenderAddress'] . ', ' . $API['DATA']['SenderCityName'] . ', ' .  $API['DATA']['SenderStateName'] .', '. $API['DATA']['SenderCountryName']; ?>"  readonly="">
                        </div>
                    </div>
                    <h4>BENEFICIARY</h4>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 21px;">FIRST NAME:</span>
                          <input type="text" class="form-control" name="inputBeneficiaryFName" id="benefname" value="<?php echo $API['DATA']['ReceiverFirstName']; ?>"  readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 8px;">MIDDLE NAME:</span>
                          <input type="text" class="form-control" name="inputBeneficiaryMName" id="benemname" value="<?php echo $API['DATA']['ReceiverMiddleName']; ?>"  readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 26px;">LAST NAME:</span>
                          <input type="text" class="form-control" name="inputBeneficiaryLName" id="benelname" value="<?php echo $API['DATA']['ReceiverLastName']; ?>"  readonly="">
                          <input type="hidden" class="form-control" name="beneFullName" id="beneFullName" value="<?php echo $API['DATA']['ReceiverFullName']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 10px;">CONTACT NO.:</span>
                          <input type="text" class="form-control" name="inputBenetelno" value="<?php echo $API['DATA']['ReceiverPhoneMobile']; ?>"  readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1" style="padding-right: 38px;">ADDRESS:</span>
                          <input type="text" class="form-control" name="inputBeneaddress" value="<?php echo $API['DATA']['ReceiverAddress'] . ', ' . $API['DATA']['ReceiverCityName'] . ', ' .  $API['DATA']['ReceiverStateName'] .', '. $API['DATA']['ReceiverCountryName']; ?>"  readonly="">
                        </div>
                    </div>
            
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <a type="button" id="btnCancel" class="btn btn-warning"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Cancel</a>
                                <a type="button" id="btnProceedtf" data-toggle = "modal" data-target="#myModalmyModal" class="btn btn-primary"><span class="glyphicon glyphicon-triangle-right"></span>&nbsp;Proceed</a>
                            </div>
                        </div>
                    </div>

                    </form>
                  </div>
                </div>
               </div> 
            </div> -->
            <?php endif?>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModaltf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>

                </button>
                 <h4 class="modal-title" id="myModalLabel">Beneficiary Details</h4>

            </div>
          <form id="datatf" method="post" enctype="multipart/form-data">
          <fieldset>
            <div class="alert alert-danger" style="display:none; text-align: center;" id="updateexpiredtf"><b></b></div>
            <div class="alert alert-success" style="display:none; text-align: center;" id="addnewsuccesstf"><b></b></div>
            <div class="modal-body">
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs transfast_tab" role="tablist">
                        <!-- <li role="presentation" class="active"><a href="#SearchBeneTab" aria-controls="SearchBeneTab" role="tab" data-toggle="tab">Search Beneficiary</a>

                        </li> -->
                        <li role="presentation" class="active" style="pointer-events:none"><a href="#AddBeneTab" aria-controls="AddBeneTab" role="tab" data-toggle="tab">New Beneficiary</a>

                        </li>
                        <li role="presentation" style="pointer-events:none"><a href="#UploadBeneID" aria-controls="UploadBeneID" role="tab" data-toggle="tab">ID Details</a>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- <div role="tabpanel" name = "searchBeneTab" class="tab-pane active" id="SearchBeneTab">
                          <div class = "form-group">
                            <div class="col-lg-12">
                              <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search Name...">
                                <span class="input-group-btn">
                                  <button class="btn btn-primary" type="button"><span class = "glyphicon glyphicon-search"></span></button>
                                </span>
                              </div> 
                            </div> 
                         </div>
                        </div> -->
                        <div role="tabpanel" name = "addBeneTab" class="tab-pane active" id="AddBeneTab">
                         <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="newBeneName">Beneficiary Name</label>
                                  <input type="text" class="form-control" disabled name="newBeneName" id="newBeneName" value="<?php echo $API['DATA']['ReceiverFullName']; ?>">
                                  <input type="hidden" class="form-control" disabled name="trackno" id="refnotf" value="<?php echo $API['DATA']['TfPin']; ?>">
                                  <!-- <input type="hidden" class="form-control" name="inputTransType" value="1" /> -->
                                  <input type="hidden" class="form-control" disabled name="transtype" id="transtypetf" value="TRANSFAST PAYOUT"  readonly="">
                                  <input type="hidden" class="form-control" disabled name="benefname" id="newBeneFName" value="<?php echo $API['DATA']['ReceiverFirstName']; ?>">
                                  <input type="hidden" class="form-control" disabled name="benemname" id="newBeneMName" value="<?php echo $API['DATA']['ReceiverMiddleName']; ?>">
                                  <input type="hidden" class="form-control" disabled name="benelname" id="newBeneLName" value="<?php echo $API['DATA']['ReceiverLastName']; ?>">
                                  <input type="hidden" class="form-control" disabled name="newReceiveAmount" id="newReceiveAmount" value="<?php echo $API['DATA']['ReceiveAmount']; ?>">
                                  <input type="hidden" class="form-control" disabled name="newReceiveCurrency" id="newReceiveCurrency" value="<?php echo $API['DATA']['ReceiveCurrencyIsoCode']; ?>">
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="BeneBirthdate">Birthdate</label>
                                <input type="text" class="form-control datetimepicker" name="benebdate" id="benefbdatedd" placeholder = "YYYY-MM-DD" autocomplete="off" required>
                              </div>
                            </div>
                          </div>

                           <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="countryBirth">Country(Birth)</label>
                                  <select class="form-control preferenceSelect" name="selCountryB" id="selCountryB" required>
                                     <option  selected>--CHOOSE COUNTRY--</option>   
                                        <!-- <option value="add_id">ADD ID</option>  -->
                                  </select>
                                  <span class="form-control" id="spinAnimationtf1_countryB"><i class="fa fa-spinner fa-spin fa-lg" aria-hidden="true"></i> Please wait...</span>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="BeneGender">Gender</label>
                                 <select class="form-control preferenceSelect" name="selGender" id="selGender" required>
                                  <option value="0"  selected>--CHOOSE GENDER--</option>
                                  <option value="M">Male</option>   
                                  <option value="F">Female</option>   
                                 </select>
                              </div>
                            </div>
                          </div>

                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label for="BeneAddress">Address</label>
                                    <input type="text" class="form-control" name="inputBeneAddress" id="inputBeneAddress" value="<?php echo $API['DATA']['ReceiverAddress'] . ', ' . $API['DATA']['ReceiverCityName'] . ', ' .  $API['DATA']['ReceiverStateName'] .', '. $API['DATA']['ReceiverCountryName']; ?>"  readonly="" required>
                                </div>
                              </div>
                           </div>

                           <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="city">City</label>
                                    <select class="form-control preferenceSelect" name="selCities" id="selCities" required>
                                        <option value="0"  selected>--CHOOSE CITY--</option>   
                                          <!-- <option value="add_id">ADD ID</option>  -->
                                    </select>
                                     <span class="form-control" id="spinAnimationtf1_city"><i class="fa fa-spinner fa-spin fa-lg" aria-hidden="true"></i> Please wait...</span>
                                </div>
                            </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="province">Province/State</label>
                                    <select class="form-control preferenceSelect" name="selStates" id="selStates" required>
                                        <option value="0"  selected>--CHOOSE PROVINCE--</option>   
                                          <!-- <option value="add_id">ADD ID</option>  -->
                                    </select>
                                     <span class="form-control" id="spinAnimationtf1_province"><i class="fa fa-spinner fa-spin fa-lg" aria-hidden="true"></i> Please wait...</span>
                                </div>
                            </div>
                          </div>

                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="country">Country</label>
                                    <select class="form-control preferenceSelect" name="selCountry" id="selCountry" required>
                                        <option value="0"  selected>--CHOOSE COUNTRY--</option>   
                                          <!-- <option value="add_id">ADD ID</option>  -->
                                    </select>
                                     <span class="form-control" id="spinAnimationtf1_country"><i class="fa fa-spinner fa-spin fa-lg" aria-hidden="true"></i> Please wait...</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="country">Nationality</label>
                                    <select class="form-control preferenceSelect" name="selNational" id="selNational" required>
                                        <option value="0"  selected>--CHOOSE NATIONALITY--</option>   
                                          <!-- <option value="add_id">ADD ID</option>  -->
                                    </select>
                                     <span class="form-control" id="spinAnimationtf1_national"><i class="fa fa-spinner fa-spin fa-lg" aria-hidden="true"></i> Please wait...</span>
                                </div>
                            </div>
                          </div>

                          <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="mobNo">Mobile No.</label>
                                     <input type="text" class="form-control" name="inputMobno" id="inputMobno" value="<?php echo $API['DATA']['ReceiverPhoneMobile']; ?>"  readonly="" required>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="relSender">Relationship with Sender</label>
                                     <input type="text" class="form-control" name="inputRelSender" id="inputRelSender" placeholder="Ex. Father" required>
                                    </select>
                                </div>
                            </div>

                            <!-- <div class="col-md-6">
                              <div class="form-group">
                                <label for="emailadd">Email Add</label>
                                <input type="email" class="form-control" name="inputBeneEmail" id="inputBeneEmail" placeholder="Email Address" required>
                              </div>
                            </div> -->
                          </div>

                           <div class="row">
                             <div class="col-md-6">
                                <div class="form-group">
                                  <label for="country">Occupation</label>
                                    <select class="form-control preferenceSelect" name="selOccup" id="selOccup" required>
                                        <option value="0"  selected>--CHOOSE OCCUPATION--</option>   
                                          <!-- <option value="add_id">ADD ID</option>  -->
                                    </select>
                                     <span class="form-control" id="spinAnimationtf1_occup"><i class="fa fa-spinner fa-spin fa-lg" aria-hidden="true"></i> Please wait...</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="country">Remittance Reason</label>
                                    <select class="form-control preferenceSelect" name="selRemitPurpose" id="selRemitPurpose" required>
                                        <option value="0"  selected>--CHOOSE REASON--</option>   
                                          <!-- <option value="add_id">ADD ID</option>  -->
                                    </select>
                                     <span class="form-control" id="spinAnimationtf1_reason"><i class="fa fa-spinner fa-spin fa-lg" aria-hidden="true"></i> Please wait...</span>
                                </div>
                            </div>
                          </div>
                          

                          <!-- <div class="row">
                              

                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="sourceFund">Source of Fund</label>
                                <input type="email" class="form-control" name="inputSourceFund" id="inputSourceFund" placeholder="Source of Fund" required>
                              </div>
                            </div>
                          </div> -->
                    </div>
                    
                     <div role="tabpanel" name = "UploadBeneID" class="tab-pane" id="UploadBeneID">
                     <!-- <div>
                      <a class="btn btn-warning" id="back2newbene"><i class="glyphicon glyphicon-arrow-left"></i>&nbsp;Back</a>
                    </div> -->
                    
                      <div class="form-group">
                           <div id="idtfdiv1" class="input-group">
                             <span class="input-group-addon" id="basic-addon1" style="padding-right: 70px;">ID#1: </span>
                               <select class="form-control preferenceSelect" name="newidtype" id="selvalidID1_tf" style="display: none;width:100%" required>
                                  <option value="0" disabled selected>--CHOOSE VALID ID--</option>
                               </select>
                               <span class="form-control" id="spinAnimationtf1"><i class="fa fa-spinner fa-spin fa-lg" aria-hidden="true"></i> Please wait fetching details...</span>
                            </div>
                          </div>

                      <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon"  style="padding-right: 21px;">ID NUMBER:</span>
                             <input type="text" class="form-control" id="newidnumbertf" name="newidnumbertf" required='required'>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon"  style="padding-right: 10px;">EXPIRY DATE:</span>
                              <input type="text" class="form-control datetimepicker" name="newexpirydatetf" id="newexpirydatetf" required='required'>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon"  style="padding-right: 21px;">ID PICTURE:</span>
                              <input type="file" class="form-control" id="filetf" name="file" title="No File Found" onchange="ValidateSingleInputtf(this);" required='required' >
                              <a type="button" style="display:none;" id="btnViewfile" class="btn btn-success">View Image</a>
                          </div>
                        </div>


                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" id="CloseIdTf" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="BackIdTf" class="btn btn-warning">Back</button>
                <button type="button" id = "NextIdTf" class="btn btn-primary save">Next</button>
            </div>
            </fieldset>
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
          <iframe width="100%" height="400px" src="" name="Agreementiframe" id="Agreementiframe"></iframe>
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
      var myFrame = $("#Agreementiframe").contents().find('body');
        var textareaValue = $("textarea").val();
      myFrame.html(textareaValue);
    }
});
</script>