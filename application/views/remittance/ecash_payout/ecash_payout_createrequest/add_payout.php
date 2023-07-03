<div>
    <form id="frmWesternPayout"  <?php echo ($transac_det['sender_id'] == '')?'style="display: none;"':''; ?>>
        <div class="form-group"><h4>SENDER</h4></div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1" style="padding-right: 59px;">FIRST NAME:</span>
                <input type="text" class="form-control" name="inputSenderFirstName" id="inputSenderFirstName" readonly="" value="<?php echo $transac_det['sender_fname'] ?>" required>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1" style="padding-right: 46px;">MIDDLE NAME:</span>
                <input type="text" class="form-control" name="inputSenderMiddleName" id="inputSenderMiddleName" readonly="" value="<?php echo $transac_det['sender_mname'] ?>" required>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1" style="padding-right: 64px;">LAST NAME:</span>
                <input type="text" class="form-control" name="inputSenderLastName" id="inputSenderLastName" readonly="" value="<?php echo $transac_det['sender_lname'] ?>" required>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1" style="padding-right: 75px;">ADDRESS:</span>
                <input type="text" class="form-control" name="inputSenderAddress" id="inputSenderAddress" readonly="" value="<?php echo $transac_det['sender_address'] ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1" style="padding-right: 61px;">MOBILE NO.:</span>
                <input type="text" class="form-control" name="inputMobileNo" id="inputMobileNo" readonly="" value="<?php echo $transac_det['sender_mobileno'] ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1" style="padding-right: 30px;">EMAIL ADDRESS:</span>
                <input type="text" class="form-control" name="inputSenderEmail" id="inputSenderEmail" readonly="" value="<?php echo $transac_det['sender_email'] ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1" style="padding-right: 59px;">BIRTH DATE:</span>
                <input type="text" class="form-control" name="inputSenderBdate" id="inputSenderBdate" readonly="" value="<?php echo $transac_det['sender_bdate'] ?>">
            </div>
        </div>
        
        <div class="form-group"><h4>BENEFICIARY</h4></div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1" style="padding-right: 59px;">FIRST NAME:</span>
                <input type="text" class="form-control" name="inputBeneficiaryFirstName" id="inputBeneficiaryFirstName" readonly="" value="<?php echo $transac_det['bene_fname'] ?>" required>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1" style="padding-right: 46px;">MIDDLE NAME:</span>
                <input type="text" class="form-control" name="inputBeneficiaryMiddleName" id="inputBeneficiaryMiddleName" readonly="" value="<?php echo $transac_det['bene_mname'] ?>" required>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1" style="padding-right: 64px;">LAST NAME:</span>
                <input type="text" class="form-control" name="inputBeneficiaryLastName" id="inputBeneficiaryLastName" readonly="" value="<?php echo $transac_det['bene_lname'] ?>" required>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1" style="padding-right: 75px;">ADDRESS:</span>
                <input type="text" class="form-control" name="inputBeneficiaryAddress" id="inputBeneficiaryAddress" readonly="" value="<?php echo $transac_det['bene_address'] ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1" style="padding-right: 62px;">MOBILE NO.:</span>
                <input type="text" class="form-control" name="inputBeneficiaryMobile" id="inputBeneficiaryMobile" readonly="" value="<?php echo $transac_det['bene_mobileno'] ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1" style="padding-right: 30px;">EMAIL ADDRESS:</span>
                <input type="text" class="form-control" name="inputBeneficiaryEmail" id="inputBeneficiaryEmail" readonly="" value="<?php echo $transac_det['bene_email'] ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1" style="padding-right: 66px;">BIRTHDATE:</span>
                <input type="text" class="form-control" name="inputBeneficiaryBdate" id="inputBeneficiaryBdate" readonly="" value="<?php echo $transac_det['bene_bdate'] ?> ">
            </div> 
        </div>

        <h4>TRANSACTION DETAILS</h4>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon" style="padding-right: 31px;">REFERENCE NO.:</span>
                <input type="text" class="form-control" name="inputReferenceNo" id="inputReferenceNo" placeholder="REFERENCE NUMBER" readonly="" value="<?php echo $transac_det['mtcn'] ?> " required>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon" style="padding-right: 55px;">OCCUPATION:</span>
                <input type="text" class="form-control" name="inputOccupation" id="inputOccupation" placeholder="OCCUPATION" required >
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
            <span class="input-group-addon" style="padding-right: 45px;">RELATIONSHIP:</span>
            <select class="form-control" name="inputRelationshiptoBene" id="inputRelationshiptoBene" required>
                <option value="" disabled selected>--CHOOSE--</option>
                <option value="Family">Family</option>
                <option value="Friend">Friend</option>
                <option value="Trade-Business Partner">Trade/Business Partner</option>
                <option value="Employee-Employer">Employee/Employer</option>
                <option value="Donor-Receiver of Charitable Funds">Donor-Receiver of Charitable Funds</option>
        </select>
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
            <select class="form-control" name="inputSourceofFund" id="inputSourceofFund" required>
            <option value="" disabled selected>--CHOOSE--</option>
            <option value="Salary">Salary</option>
            <option value="Savings">Savings</option>
            <option value="Borrowed Funds">Borrowed Funds/Loan</option>
            <option value="Gift">Gift</option>
            <option value="Pension/Government/Welfare">Pension/Government/Welfare</option>
            <option value="Inheritance">Inheritance</option>
            <option value="Charitable Donations">Charitable Donations</option>
            </select>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
            <span class="input-group-addon" style="padding-right: 23px;">COUNTRY (BIRTH):</span>
            <select class="form-control" name="inputCountryBirth" id="inputCountryBirth" required>
            <option value="" disabled selected>--CHOOSE--</option> 
            <?php  foreach ($country as $row): ?>
                <option value="<?php echo $row['cname'] ?>"><?php echo $row['cname'] ?></option> 
            <?php endforeach ?>
            </select>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
            <span class="input-group-addon" style="padding-right: 58px;">NATIONALITY:</span>
            <select class="form-control" name="inputNationality" id="inputNationality" required>
            <option value="" disabled selected>--CHOOSE--</option>
            <?php  foreach ($country as $row): ?>
                <option value="<?php echo $row['cname'] ?>"><?php echo $row['cname'] ?></option> 
            <?php endforeach ?>
            </select>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
            <span class="input-group-addon" style="padding-right: 79px;">COUNTRY:</span>
                <select class="form-control" name="country_iso_payout" id="country_iso_payout" required>
                    <option value="" disabled selected>--CHOOSE--</option>   
                    <?php foreach ($country as $row): ?>
                    <option value="<?php echo $row['iso_code'] ?>"><?php echo $row['cname'] ?></option> 
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon" style="padding-right: 79px;">TRANSACTION REASON:</span>
                
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
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 89px;">PRINCIPAL AMOUNT:</span>
                    <input type="text" class="form-control inputAmount" name="inputPRINAmount" id="inputPRINAmount" placeholder="0.00" value="<?php echo number_format($transac_det['amount'],2) ?>" disabled required>
                </div>
            </div>
            <div class="col-md-3" style="padding-left: 0px;">
            <?php if ($transac_det['currency'] == ""): ?>
                <select class="form-control" name="currency" id="currency" required>
                <option value="PHP" selected>PHP</option>   
                </select>
            <?php endif ?>
            <?php if ($transac_det['currency'] != ""): ?>
                <select class="form-control" name="currency" id="currency" disabled required>
                <option value="PHP" selected>PHP</option>   
                <option value="<?php echo $currency['currency'].'|'.$currency['rate'] ?>"><?php echo $currency['currency'] ?></option> 
                </select>
            <?php endif ?> 
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
            <h4>
            PRIMARY ID DETAILS
            </h4>

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
            <h4>
            SECONDARY ID DETAILS
            </h4>

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
            <h4>
            TERTIARY ID DETAILS
            </h4>

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

        <div class="form-group">
            <div class="input-group">
            <span class="input-group-addon" style="padding-right: 2px;">ID COUNTRY ISSUED:</span>
            
            <select class="form-control" name="inputIdCountryIssued" id="inputIdCountryIssued" required>
                <option value="" disabled selected>--CHOOSE COUNTRY--</option> 

                <?php  foreach ($country as $row): ?>
                <option value="<?php echo $row['cname'] ?>"><?php echo $row['cname'] ?></option> 
                <?php endforeach ?>
            </select>
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
            <input type="hidden" class="form-control" name="inputSenderID" id="inputSenderID" value="<?php echo $transac_det['sender_id'] ?>"/>
            <input type="hidden" class="form-control" name="inputBeneficiaryID" id="inputBeneficiaryID" value="<?php echo $transac_det['beneficiary_id'] ?>"/>
            <input type="hidden" class="form-control" name="aFindWestern" id="aFindWestern" value="0|PAYOUT"/>
        </div>
    </form> 
</div>