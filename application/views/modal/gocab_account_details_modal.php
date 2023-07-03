<div id="gocab_account_details_modal" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                <h4 class="modal-title">Account’s Details</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                <?php if($DATA):?>
                    <small><b>First Name</b></small><div class="row" style="padding-bottom:5px;"><div class="col-md-12"><input type="text" class="form-control" id="inputFname" placeholder="FIRST NAME" value="<?php echo strtoupper($DATA['fname']);?>" required readonly/></div></div>
                    <small><b>Middle Name</b></small><div class="row" style="padding-bottom:5px;"><div class="col-md-12"><input type="text" class="form-control" id="inputMname" placeholder="MIDDLE NAME" value="<?php echo strtoupper($DATA['mname']);?>" readonly/></div></div>
                    <small><b>Last Name</b></small><div class="row" style="padding-bottom:5px;"><div class="col-md-12"><input type="text" class="form-control" id="inputLname"  placeholder="LAST NAME" value="<?php echo strtoupper($DATA['lname']);?>" required readonly/></div></div>
                    <div class='row' style="padding-bottom:5px;">
                        <div class="col-md-8">
                            <small><b>Birth Date</b></small>
                            <input type="date" class="form-control" id="inputBdate" value="<?php echo date('Y-m-d',strtotime($DATA["bdate"])) ?>" required readonly/>
                        </div>
                        <div class="col-md-4">
                            <small><b>Gender</b></small>
                            <select id="selectGender" class="form-control" required disabled>
                                <?php if($DATA['gender'] == 'M' || $DATA['gender'] == 'm'):?>
                                    <option value="M" selected>MALE</option>
                                <?php elseif($DATA['gender'] == 'F' || $DATA['gender'] == 'f'):?>
                                    <option value="F" selected>FEMALE</option>
                                <?php endif;?>
                            </select>
                        </div>
                    </div>
                    <div class='row' style="padding-bottom:5px;">
                        <div class="col-md-8"><small><b>Mobile Number</b></small><input type="number" class="form-control" id="inputMobile" placeholder="MOBILE NUMBER" value="<?php echo $DATA['mobileno'];?>" required readonly/></div>
                        <div class="col-md-4">
                            <small><b>Country</b></small>
                            <select id="selectCountry" class="form-control" required disabled>
                                <option value="" selected><?php echo strtoupper($DATA['country']);?></option>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="padding-bottom:5px;">
                        <div class="col-md-12">
                            <small><b>Address</b></small><textarea id="inputAddress" class="form-control" placeholder="ADDRESS" required readonly><?php echo strtoupper($DATA['address']);?></textarea>
                        </div>
                    </div>
                    <div class="row" style="padding-bottom:15px;">
                        <div class="col-md-12">
                            <small><b>Email</b></small><input type="email" class="form-control" id="inputEmail"  placeholder="EMAIL" value="<?php echo $DATA['email'];?>" required readonly/>
                        </div>
                    </div>
                    <label>Additional Information</label>
                    <div class="row" style="padding-bottom:5px;">
                        <div class="col-md-12">
                            <small><b>Country Of Birth</b></small>
                            <select id="selectCountryOfBirth" class="form-control" required disabled>
                                <option value="" selected><?php echo strtoupper($DATA['country_of_birth']);?></option>
                            </select>
                        </div>
                    </div>
                    <small><b>Nationality</b></small><div class="row" style="padding-bottom:5px;"><div class="col-md-12"><input type="text" class="form-control" id="inputNationality" placeholder="NATIONALITY" value="<?php echo strtoupper($DATA['nationality']);?>" required readonly/></div></div>
                    <small><b>Relationship To Sender</b></small><div class="row" style="padding-bottom:5px;"><div class="col-md-12"><input type="text" class="form-control" id="inputRelationship" placeholder="RELATIONSHIP WITH THE SENDER" value="<?php echo strtoupper($DATA['relation_to_sender']);?>" required readonly/></div></div>
                    <div class="row" style="padding-bottom:5px;">
                        <div class="col-md-12">
                            <small><b>Source Of Fund</b></small>
                            <select id="selectSourceOfFund" class="form-control" required disabled>
                                <?php if($DATA['source_of_fund'] == 'employed'):?>
                                    <option value="" selected>EMPLOYED</option>
                                <?php elseif($DATA['source_of_fund'] == 'self employed'):?>
                                    <option value="" selected>SELF-EMPLOYED</option>
                                <?php else:?>
                                    <option value="" selected>UNEMPLOYED</option>
                                <?php endif;?>
                            </select>
                        </div>
                    </div>
                    <div id="employed" style="padding-bottom:15px;" <?php echo ($DATA['source_of_fund'] == 'employed')? '' : 'hidden';?>>
                        <small><b>Occupation</b></small><div class="row" style="padding-bottom:5px;"><div class="col-md-12"><input type="text" class="form-control" id="inputOccupation" placeholder="OCCUPATION" value="<?php echo strtoupper($DATA['e_occupation']);?>" readonly/></div></div>
                        <small><b>Company Name</b></small><div class="row" style="padding-bottom:5px;"><div class="col-md-12"><input type="text" class="form-control" id="inputCompanyName" placeholder="COMPANY NAME" value="<?php echo strtoupper($DATA['e_company_name']);?>" readonly/></div></div>
                        <small><b>Job Title</b></small><div class="row" style="padding-bottom:5px;"><div class="col-md-12"><input type="text" class="form-control" id="inputJobTitle" placeholder="JOB TITLE/POSITION" value="<?php echo strtoupper($DATA['e_jobtitle']);?>" readonly/></div></div>
                    </div>
                    <div id="selfEmployed" style="padding-bottom:15px;" <?php echo ($DATA['source_of_fund'] == 'self employed')? '' : 'hidden';?>>
                        <small><b>Business Name</b></small><div class="row" style="padding-bottom:5px;"><div class="col-md-12"><input type="text" class="form-control" id="inputBusinessName" placeholder="BUSINESS NAME" value="<?php echo strtoupper($DATA['s_business_name']);?>" readonly/></div></div>
                        <div class="row" style="padding-bottom:5px;">
                            <div class="col-md-12">
                                <small><b>Registration Date</b></small>
                                <input type="date" class="form-control" id="inputRegistrationDate" value="<?php echo date('Y-m-d',strtotime($DATA["s_registration_date"])) ?>" required readonly/>
                            </div>
                        </div>
                        <small><b>Nature Of Business</b></small><div class="row" style="padding-bottom:5px;"><div class="col-md-12"><input type="text" class="form-control" id="inputNatureBusiness" placeholder="NATURE OF BUSINESS" value="<?php echo strtoupper($DATA['s_nature_of_business']);?>" readonly/></div></div>
                        <small><b>Years In Operation</b></small><div class="row" style="padding-bottom:5px;"><div class="col-md-12"><input type="text" class="form-control" id="inputYearsOperation" placeholder="YEARS IN OPERATION" value="<?php echo strtoupper($DATA['s_years_in_operation']);?>" readonly/></div></div>
                    </div>
                    <div id="unEmployed" style="padding-bottom:15px;" <?php echo ($DATA['source_of_fund'] == 'unemployed')? '' : 'hidden';?>>
                        <small><b>Unemployed</b></small>
                        <select id="selectUnemployed" class="form-control" disabled>
                            <option value="" selected><?php echo strtoupper($DATA['u_unemployed']);?></option>
                        </select>
                    </div>
                <?php endif;?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnProceed" class="btn btn-success">PROCEED <i class="fa fa-arrow-right"></i></button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#gocab_account_details_modal').on('click', '#btnProceed', function(){
        $('#gocab_shipper_modal').modal('show');
        $('#gocab_account_details_modal').modal('hide');
    });
</script>