
<style>
    #addModalSender .col-md-4, 
    #addModalSender .col-md-6, 
    #addModalSender .col-md-8, 
    #addModalSender .col-md-12 {
        padding-right: 5px;
        padding-left: 5px;
    } 
    .modal-body {
        max-height: calc(100vh - 210px);
        overflow-y: auto;
    }
    td{
        vertical-align: middle !important;
    }
    .selected {
        background-color: #ADD8E6;
    }
    .btnApprove{
        border: none;
        padding: 7px 10px;
        width: 84px;
        height: 34px;
        color: #FFFFFF;
        background: #27AE60;
        border-radius: 8px;
        margin-top: 8px;
        margin-bottom: 8px;
    }
    .ups-input-label{
        font-size: 16px;
        font-weight: 500;
        text-align: center;
    }
    .ups-btnRecords{
        height: 56px;
        width: 322px;
        border-radius: 12px !important;
        padding: 8px 40px 8px 40px !important;
        border:none !important;
        background-color: #FFC914;
        color: white;
    }
    .noRecord{
        border-radius: 25px;
        border: 2px solid #FFC914;
    }
</style>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations-v1.0.0.js"></script>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

    $(document).ready(function(){

        if($('#frmNewEcashPadalaSender').is(':visible')){
            // alert($('#newidTypeDealer').length == 1)
            setTimeout( function(){
                if($('#newidtypeDealer').length == 1){
                    waitingDialog.show('Please Wait.', {dialogSize: 'sm', progressType: 'primary'});
                    fetch_IDs_dealer()     
                }
            }, 250 );
            
        }
        
    })

    function fetch_IDs_dealer(){
        $.ajax({
            url         : '/Ecash_send/fetch_IDs',
            type        : 'POST',
            processData : false,
            contentType : false,
            success     : function (data) {
                var jsonData = JSON.parse(data);

                $('#newidtypeDealer').append($('<option>', {
                    text: "-- PRIMARY --",
                    disabled: true
                }))

                jsonData.T_DATA.forEach(function(i){
                    // console.log(i)
                    if(i.idtype == 'PRIMARY'){
                        $('#newidtypeDealer').append($('<option>', {
                            id: i.id,
                            value: i.id,
                            text: i.description
                        }));
                        $('#'+i.id).attr('data-expiry', i.expirable)
                        $('#'+i.id).attr('data-type', i.idtype)
                        $('#'+i.id).attr('data-regex', (i.rule).replace("/g", ""))
                    }
                })
                
                $('#newidtypeDealer').append($('<option>', {
                    text: "-- SECONDARY --",
                    disabled: true
                }))

                jsonData.T_DATA.forEach(function(i){
                    // console.log(i)
                    if(i.idtype == 'SECONDARY'){
                        $('#newidtypeDealer').append($('<option>', {
                            id: i.id,
                            value: i.id,
                            text: i.description
                        }));
                        $('#'+i.id).attr('data-expiry', i.expirable)
                        $('#'+i.id).attr('data-type', i.idtype)
                        $('#'+i.id).attr('data-regex', (i.rule).replace("/g", ""))
                    }
                })

                jsonData.T_DATA.forEach(function(i){
                    if(i.idtype == 'SECONDARY'){
                        $('#newidtype2Dealer').append($('<option>', {
                            id: i.id,
                            value: i.id,
                            text: i.description
                        }));
                        $('#newidtype2Dealer #'+i.id).attr('data-expiry', i.expirable)
                        $('#newidtype2Dealer #'+i.id).attr('data-type', i.idtype)
                        $('#newidtype2Dealer #'+i.id).attr('data-regex', (i.rule).replace("/g", ""))
                    }
                })
                waitingDialog.hide()
                $('#newidtypeDealer').removeAttr("disabled")
            }
        })
    }
        
    var my_handlers = {
        fill_provinces1: function(){
            var region_code1 = $(this).val();
            $('#selProvince').ph_locations('fetch_list', [{"region_code": region_code1}]);
            
        },
        fill_provinces2: function(){
            var region_code2 = $(this).val();
            $('#selProvince2').ph_locations('fetch_list', [{"region_code": region_code2}]);
            
        },
        fill_provincesBene: function(){
            var region_codeBene = $(this).val();
            $('#selProvinceBene').ph_locations('fetch_list', [{"region_code": region_codeBene}]);
        },

        fill_cities1: function(){
            var province_code1 = $(this).val();
            $('#selCity').ph_locations('fetch_list', [{"province_code": province_code1}]);
        },
        fill_cities2: function(){
            var province_code2 = $(this).val();
            $('#selCity2').ph_locations('fetch_list', [{"province_code": province_code2}]);
        },
        fill_citiesBene: function(){
            var province_codeBene = $(this).val();
            $('#selCityBene').ph_locations('fetch_list', [{"province_code": province_codeBene}]);
            
        },

        fill_barangays1: function(){
            var city_code1 = $(this).val();
            $('#selBarangay').ph_locations('fetch_list', [{"city_code": city_code1}]);
        },
        fill_barangays2: function(){
            var city_code2 = $(this).val();
            $('#selBarangay2').ph_locations('fetch_list', [{"city_code": city_code2}]);
        },
        fill_barangaysBene: function(){
            var city_codeBene = $(this).val();
            $('#selBarangayBene').ph_locations('fetch_list', [{"city_code": city_codeBene}]);
            
        }
        
    };

    $(function(){
            $('#selRegion').on('change', my_handlers.fill_provinces1);
            $('#selRegion2').on('change', my_handlers.fill_provinces2);
            $('#selRegionBene').on('change', my_handlers.fill_provincesBene);
            $('#selRegion, #selRegion2, #selRegionBene').on('change', function(){
                if($(this).val() != 'default'){
                    $('#selProvince, #selProvince2, #selProvinceBene').removeAttr('disabled');
                }
            });
            
            $('#selProvince').on('change', my_handlers.fill_cities1);
            $('#selProvince2').on('change', my_handlers.fill_cities2);
            $('#selProvinceBene').on('change', my_handlers.fill_citiesBene);
            $('#selProvince, #selProvince2, #selProvinceBene').on('change', function(){
                if($(this).val() != 'default'){
                    $('#selCity, #selCity2, #selCityBene').removeAttr('disabled');
                }
            });
            
            $('#selCity').on('change', my_handlers.fill_barangays1);
            $('#selCity2').on('change', my_handlers.fill_barangays2);
            $('#selCityBene').on('change', my_handlers.fill_barangaysBene);
            $('#selCity, #selCity2, #selCityBene').on('change', function(){
                if($(this).val() != 'default'){
                    $('#selBarangay, #selBarangay2, #selBarangayBene').removeAttr('disabled');
                }
            });
            

            $('#selRegion, #selRegion2, #selRegionBene').ph_locations({'location_type': 'regions'});
            $('#selProvince, #selProvince2, #selProvinceBene').ph_locations({'location_type': 'provinces'});
            $('#selCity, #selCity2, #selCityBene').ph_locations({'location_type': 'cities'});
            $('#selBarangay, #selBarangay2, #selBarangayBene').ph_locations({'location_type': 'barangays'});

            $('#selRegion, #selRegion2, #selRegionBene').ph_locations('fetch_list');
    });

</script>

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
                <h4>E-Cash Credit To Bank</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <?php if ($details['process'] == 0) { ?>
        <div class="contentpanel" style="padding-bottom: 0px;">
        <?php if($transactConfirmLow['S']===0): ?>
            <?php if($transactConfirmLow['S']===0): ?>
                <div class="alert alert-danger"><b><?php echo $transactStatus['M']?></b></div>
            <?php elseif($transactBSPLow['S']===0): ?>
                <div class="alert alert-danger"><b><?php echo $transactStatus['M']?></b></div>
            <?php endif ?>
        <?php endif ?>
        
        <?php if($transactStatus['S']==1 && $OTP['S']==1) : ?>
                <!-- <div class="alert alert-success"><?php echo $transactStatus['M']?></b></div> -->
            <?php if($OTP['S']==1 || $otpResult['S']===0) : ?>
                <?php if($otpResult['S']===0): ?>
                    <div class="alert alert-danger"><b><?php echo $otpResult['M']?></b></div>
                <?php endif ?>

            <div id="divOTP">
                <form action="<?php echo BASE_URL() ?>ecash_send/ecashcredittobank" method="post" id="frmOTP" enctype="multipart/form-data">
                    <input hidden name="traceno" id="traceno" value="<?php echo $transactStatus['TN'] ?>"/>
                    <input hidden name="inputCharge" id="charge" value="<?php echo $receiptCharge ?>" />
                    <input hidden name="inputServiceType" id="serviceType" value="<?php echo $receiptServiceType ?>" />
                    
                    <div class="row" style="padding-top: 25px;">
                        <div class="col-md-12">
                        <div class="col-md-2"></div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <div id="otpSent"><?php echo $OTP['M'];?></div>
                                </div>
                            </div>
                        </div>
                        <?php if($transactStatus['RISK']=="NORMAL" || $transactStatus['RISK']=="HIGH"): ?>
                        <br/>
                        <input id="riskLevel" value="<?php echo $transactStatus['RISK']?>"hidden />
                        <div class="col-md-12" style="padding-top: 15px;">
                            <div class="col-md-2"></div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <div><b>Trace No:<?php echo $transactStatus['TN']?> | Risk: <?php echo $transactStatus['RISK']?> | Hits: <?php echo $transactStatus['HITS']?></b></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-2"></div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <div><b>SENDER: <?php echo $tracenoDetails['M'][0]['sLname'].", ".$tracenoDetails['M'][0]['sFname']; if($tracenoDetails['M'][0]['sSuffix']){echo " ".$tracenoDetails['M'][0]['sSuffix'];} if($tracenoDetails['M'][0]['sMname']){echo " ".$tracenoDetails['M'][0]['sMname'];} ?></b></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-2"></div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <div><b>RECEIVER: <?php echo $tracenoDetails['M'][0]['rLname'].", ".$tracenoDetails['M'][0]['rFname']; if($tracenoDetails['M'][0]['rSuffix']){echo " ".$tracenoDetails['M'][0]['rSuffix'];} if($tracenoDetails['M'][0]['rMname']){echo " ".$tracenoDetails['M'][0]['rMname'];} ?></b></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="padding-top: 20px;">
                            <div class="col-md-2"></div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <div><b>RISK REASON: </b></div>
                                    <?php  foreach ($RISK_DESCRIPTION['M'] as $i): ?>
                                        <div><b> - <?php if($i['description'] == $i['details']){ echo $i['description']; } else {  echo $i['description'] ." ". $i['details'];}?></b></div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>

                        <?php endif ?>
                        <br/>
                        <div class="col-md-12" style="padding-top: 30px;">
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" style="padding-right: 45px;">OTP</span>
                                        <input type="text" name="otpCode" id="otpCode" class="form-control" placeholder="6 DIGITS" onkeypress="return isNumberKey(event)" maxlength="6"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1" style="padding-left:unset;">
                                <div class="form-group">
                                    <button type="button" class="btn btn-default" name="resendOTP" id="resendOTP" disabled>RESEND</button>
                                </div>
                            </div>
                        </div>
                        <?php if($transactStatus['RISK']=="HIGH"): ?>
                        <div class="col-md-12">
                            <div class="col-md-3"></div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"  style="">ID PICTURE:</span>
                                        <input type="file" class="form-control" id="fileHigh1" name="fileHigh1" title="No File Found"  accept="image/*" onchange="ValidateSingleInput(this);" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                        
                        <?php endif ?>

                        <div class="col-md-12" style="padding-top: 30px;">
                            <div class="col-md-3"></div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="denyCommentOTP" id="denyCommentOTP" class="form-control" placeholder="COMMENT"/>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                        </div>

                        <div class="col-md-12">
                            <div class="col-md-3"></div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary" name="submitOTP" id="submitOTP" data-info="APPROVED">SUBMIT</button>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <button type="button" class="btn btn-danger" name="rejectOTP" id="rejectOTP" data-id="<?php echo $transactStatus['TN']?>" data-info="DENIED" data-toggle="modal" data-target="#transactionRejectModal">REJECT</button>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                <a href="<?php echo BASE_URL() ?>ecash_send/ecashcredittobank" class="btn btn-default" id="returnOTP">APPROVE LATER</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="row" id="divShowReceipt" hidden>
                <div class="col-md-2" style="margin-top: 25px;">
                    <div class="form-group">
                        <a href="<?php echo BASE_URL() ?>ecash_send/ecashcredittobank" class="btn btn-primary" id="returnSearchStep1"><span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Return to Search</a> 
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <div class='col-md-12 text-center'>
                            <div class="form-group">
                                <h2><span id="receiptResult"></span> <span id="receiptService"></span></h2>
                            </div> 
                        </div>
                        <div class='col-md-12 text-center' style="padding-top: 20px;" id="divReceiptApproved">
                            <div class="form-group">
                                <div>Reference No. : <b><a href="#" id="receiptLink" target="_blank"><span id="receiptReferenceno"></span></a></b></div>
                            </div> 
                        </div>
                        <div class='col-md-12 text-center'>
                            <div class="form-group">
                                <div>Trace No. : <b><span id="receiptTraceno"></span></b></div>
                            </div> 
                        </div>

                        <div class='col-md-12 text-center' style="padding-top: 20px;">
                            <div class="form-group">
                                <h3>SENDER DETAILS</h3>
                            </div> 
                        </div>
                        <div class='col-md-12'>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">FULL NAME</span>
                                    <input type="text" class="form-control" name="receiptSenderFull" id="receiptSenderFull" value="" disabled />
                                </div>
                            </div>
                        </div>
                        <div class='col-md-12'>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">E-MAIL</span>
                                    <input type="text" class="form-control" name="receiptSenderEmail" id="receiptSenderEmail" value="" disabled />
                                </div>
                            </div>
                        </div>

                        <div class='col-md-12 text-center' style="padding-top: 20px;">
                            <div class="form-group">
                                <h3>BENEFICIARY DETAILS</h3>
                            </div> 
                        </div>
                        <div class='col-md-12'>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">FULL NAME</span>
                                    <input type="text" class="form-control" name="receiptBeneFull" id="receiptBeneFull" value="" disabled />
                                </div>
                            </div>
                        </div>
                        <div class='col-md-12'>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">E-MAIL</span>
                                    <input type="text" class="form-control" name="receiptBeneEmail" id="receiptBeneEmail" value="" disabled />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4" style="padding-top: 20px;">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">SERVICE</span>
                                    <input type="text" class="form-control" name="receiptServiceType" id="receiptServiceType" value="" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding-top: 20px;">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">ACCOUNT NO</span>
                                    <input type="text" class="form-control" name="receiptAccountno" id="receiptAccountno" value="" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding-top: 20px;">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">ACCOUNT NAME</span>
                                    <input type="text" class="form-control" name="receiptAccountname" id="receiptAccountname" value="" disabled />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3" style="padding-top: 20px;">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">RELATION</span>
                                    <input type="text" class="form-control" name="receiptRelation" id="receiptRelation" value="" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3" style="padding-top: 20px;">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">PURPOSE</span>
                                    <input type="text" class="form-control" name="receiptPurpose" id="receiptPurpose" value="" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3" style="padding-top: 20px;">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">AMOUNT</span>
                                    <input type="text" class="form-control" name="receiptAmount" id="receiptAmount" value="" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3" style="padding-top: 20px;">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">CHARGE</span>
                                    <input type="text" class="form-control" name="receiptCharge" id="receiptCharge" value="" disabled />
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            <div>

            <?php endif ?>
            
        <?php elseif($transactConfirmLow['S']==1 || $transactDealer['S']==1): ?>
            <?php if($transactConfirm['S']==1 || $transactConfirmLow['S']==1 || $transactDealer['S']==1): ?>
                <?php if($transactConfirm['S']==1) : ?>
                    <div class="alert alert-success"><b><?php echo $transactConfirm['M']?> | Trace No: <?php echo $transactConfirm['TN']?></b></div>
                <?php endif ?>
                <?php if($transactConfirmLow['S']==1 && $transactBSPLow['S']==1 || $transactDealer['S']==1): ?>
                    <!-- <div class="alert alert-success"><b><?php echo $transactConfirmLow['M']?> | Trace No: <?php echo $transactConfirmLow['TN']?></b></div> -->
                    <?php  foreach ($tracenoDetails['M'] as $low): ?>
                        <div class="form-group">
                            <a href="<?php echo BASE_URL() ?>ecash_send/ecashcredittobank" class="btn btn-primary" id="returnSearchStep1"><span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Return to Search</a> 
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <div class='col-md-12 text-center'>
                                    <div class="form-group">
                                        <?php if($transactDealer['S']==1): ?>
                                            <h2><span id="receiptResult" style="color:#5bc0de"><?php echo $receiptResult ?> </span><span id="receiptServiceLow"><?php echo $low['service']?></span></h2>
                                        <?php elseif($transactConfirmLow['S']==1): ?>
                                            <h2><span id="receiptResult" style="color:green"><?php echo $receiptResult ?> </span><span id="receiptServiceLow"><?php echo $low['service']?></span></h2>
                                        <?php endif ?>
                                    </div> 
                                </div>
                                
                                <?php if($transactConfirmLow['S']==1): ?>
                                    <div class='col-md-12 text-center' style="padding-top: 20px;" id="divReceiptApprovedLow">
                                        <div class="form-group">
                                            <div>Reference No.    : <b><a href="https://mobilereports.globalpinoyremittance.com/portal/ecash_remittance/ecash_credit_bank_receipt/<?php echo $transactBSPLow['TN'] ?>" id="receiptLink" target="_blank"><span id="receiptReferencenoLow"><?php echo $transactBSPLow['TN'] ?></span></a></b></div>
                                        </div> 
                                    </div>
                                <?php endif ?>

                                <div class='col-md-12 text-center'>
                                    <div class="form-group">
                                        <div>Trace No.    : <b><span id="receiptReferencenoLow"><?php echo $transactStatus['TN'] ?></span></b></div>
                                    </div> 
                                </div>
                                <div class='col-md-12 text-center' style="padding-top: 20px;">
                                    <div class="form-group">
                                        <h3>SENDER DETAILS</h3>
                                    </div> 
                                </div>
                                <div class='col-md-12'>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">FULL NAME</span>
                                            <input type="text" class="form-control" name="receiptSenderFull" id="receiptSenderFull" value="<?php echo $low['sLname'].", ".$low['sFname']; if($low['sSuffix']){echo " ".$low['sSuffix'];} if($low['sMname']){echo " ".$low['sMname'];} ?>" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class='col-md-12'>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">E-MAIL</span>
                                            <input type="text" class="form-control" name="receiptSenderEmail" id="receiptSenderEmail" value="<?php echo $low['sEmail'] ?>" disabled />
                                        </div>
                                    </div>
                                </div>

                                <div class='col-md-12 text-center' style="padding-top: 20px;">
                                    <div class="form-group">
                                        <h3>BENEFICIARY DETAILS</h3>
                                    </div> 
                                </div>
                                <div class='col-md-12'>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">FULL NAME</span>
                                            <input type="text" class="form-control" name="receiptBeneFull" id="receiptBeneFull" value="<?php echo $low['rLname'].", ".$low['rFname']; if($low['rSuffix']){echo " ".$low['rSuffix'];} if($low['rMname']){echo " ".$low['rMname'];} ?>" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class='col-md-12'>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">E-MAIL</span>
                                            <input type="text" class="form-control" name="receiptBeneEmail" id="receiptBeneEmail" value="<?php echo $low['rEmail'] ?>" disabled />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4" style="padding-top: 20px;">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">SERVICE</span>
                                            <input type="text" class="form-control" name="receiptServiceType" id="receiptServiceType" value="<?php echo $receiptCharge ?>" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" style="padding-top: 20px;">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">ACCOUNT NO</span>
                                            <input type="text" class="form-control" name="receiptAccountno" id="receiptAccountno" value="<?php echo $low['firstfield'] ?>" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" style="padding-top: 20px;">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">ACCOUNT NAME</span>
                                            <input type="text" class="form-control" name="receiptAccountname" id="receiptAccountname" value="<?php echo $low['secondfield'] ?>" disabled />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3" style="padding-top: 20px;">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">RELATION</span>
                                            <input type="text" class="form-control" name="receiptRelation" id="receiptRelation" value="<?php echo $low['relation'] ?>" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3" style="padding-top: 20px;">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">PURPOSE</span>
                                            <input type="text" class="form-control" name="receiptPurpose" id="receiptPurpose" value="<?php echo $low['purpose'] ?>" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3" style="padding-top: 20px;">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">AMOUNT</span>
                                            <input type="text" class="form-control" name="receiptAmount" id="receiptAmount" value="<?php echo $low['principal'] ?>" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3" style="padding-top: 20px;">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">CHARGE</span>
                                            <input type="text" class="form-control" name="receiptCharge" id="receiptCharge" value="<?php echo $receiptCharge ?>" disabled />
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php endforeach ?>

                <?php endif ?>
            <?php endif ?>

        <?php elseif($transactStatus['S']==1 && $OTP['S']===0): ?>                 
            <div class="col-md-3">
                <div class="form-group">
                    <a href="<?php echo BASE_URL() ?>ecash_transactions" class="btn btn-primary" id="returnSearchStep1"><span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Go to Remittance Transaction</a> 
                </div>
            </div>
            <div class="col-md-6">
                <h3 class="ups-h5 txt-center mt-1"><?php echo $OTP['M'] ?></h3>
                <h4 class="ups-h5 txt-center mt-1">Your Transaction has been successfully posted but OTP sending isn't available right now.</h4>
                <img src="<?php echo BASE_URL()?>assets/images/somethingWentWrong.png" alt="" srcset="" style="width:341px; height:293px;display: block; margin-left: auto; margin-right: auto;">
                <h4 class="ups-h5 txt-center mt-1">Trace No: <?php echo $transactStatus['TN'] ?></h4>
                <h4 class="ups-h5 txt-center mt-1">Recent transactions may be seen under Remittance Transactions.</h4>
            </div>
            <div class="col-md-3"></div>
        <?php elseif ($AddBene['S']==1 || $okTransac['S']==1 || $selectedID1 && $selectedID2 && $transactStatus['S']===0): ?>
            <?php if ($AddBene['S']==1): ?>
                <div class="alert alert-success"><b><?php echo $AddBene['M']?> Added Beneficiary</b></div>
            <?php endif ?>
            <?php if($transactStatus['S']===0): ?>
                <div class="alert alert-danger"><b><?php echo $transactStatus['M']?></b></div>
            <?php endif ?>

            <div class="form-group">
                <a href="<?php echo BASE_URL() ?>ecash_send/ecashcredittobank" class="btn btn-primary" id="returnSearchStep1"><span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Return to Search</a> 
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <h4 id="headerResult">Sender Details :</h4>
                    <table id="tblSelectedSender"  class="table" cellspacing="0" style="width:100%;">
                        <tbody>
                        <?php  foreach ($selectedID1['result'] as $i): ?>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fullname</th>
                                    <th>Address</th>
                                    <th>Birth Date</th>
                                    <th>Mobile No</th>
                                    <th>E-Mail</th>
                                    <th>Birth Place</th>
                                    <th>Occupation</th>
                                    <th>Source of Funds</th>
                                    <th>Nationality</th>
                                </tr>
                            </thead>
                            <tr class="tr">
                                <td hidden>
                                    <input id="tdTransacSenderID" value="<?php echo $i['id']?>" hidden/>
                                </td>
                                <td hidden>

                                </td>
                                <td id="tdIdS"><?php echo $i['customer_id']; ?></td>
                                <td id="tdFullS"><?php echo $i['lname'].", ".$i['fname']; if($i['suffix']){echo " ".$i['suffix'];} if($i['mname']){echo " ".$i['mname'];} ?></td>
                                <td><?php echo $i['address'].", ".$i['addressBrgy'].", ".$i['addressCity'].", ".$i['province'].", ".$i['country'].", ".$i['addressZip']; ?></td>
                                <td id="tdBirthDateS"><?php echo $i['birthDate']; ?></td>
                                <td><?php echo $i['mobile']; ?></td>
                                <td><?php echo $i['emailAdd']; ?></td>
                                <td><?php echo $i['placeOfBirth']; ?></td>
                                <td><?php echo $i['occupation']; ?></td>
                                <td><?php echo $i['sourceOfFund']; ?></td>
                                <td><?php echo $i['nationality']; ?></td>
                            </tr>
                        <?php endforeach ?>
                    
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <h4 id="headerResult">Beneficiary Details :</h4>
                    <table id="tblSelectedSender"  class="table" cellspacing="0" style="width:100%;">
                        <tbody>
                        <?php  foreach ($selectedID2['result'] as $i): ?>
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Fullname</th>
                                <th>Address</th>
                                <th>Birth Date</th>
                                <th>Mobile No</th>
                                <th>E-Mail</th>
                            </tr>
                            </thead>
                            <tr class="tr">
                                <td hidden>
                                    <input id="tdTransacBeneID" value="<?php echo $i['id']?>" hidden/>
                                </td>
                                <td id="tdIdR"><?php echo $i['customer_id']; ?></td>
                                <td id="tdFullR"><?php echo $i['lname'].", ".$i['fname']; if($i['suffix']){echo " ".$i['suffix'];} if($i['mname']){echo " ".$i['mname'];} ?></td>
                                <td><?php echo $i['address']; ?></td>
                                <td id="tdBirthDateR"><?php echo $i['birthdate']; ?></td>
                                <td><?php echo $i['mobileno']; ?></td>
                                <td><?php echo $i['emailadd']; ?></td>
                            </tr>
                        <?php endforeach ?>
                    
                        </tbody>
                    </table>
                </div>
            </div>
          
            <form action="<?php echo BASE_URL() ?>ecash_send/ecashcredittobank" method="post"  id="frmProceedEcashPadala">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input hidden name="service" id="service" value="CREDITTOBANK"/>
                            <div class="form-group">
                                <h3>ECASH CREDIT TO BANK</h3>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="inputRelation" id="inputRelation" placeholder="RELATION TO RECEIVER" onkeypress="return /[a-zA-Z ]/i.test(event.key)" value="<?php echo $inputRelation ?>" required/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="inputPurpose" id="inputPurpose" placeholder="PURPOSE OF TRANSACTION" onkeypress="return /[a-zA-Z ]/i.test(event.key)" value="<?php echo $inputPurpose ?>" required/>
                            </div>  
                            <div class="form-group">
                                <select class="form-control" name="selCurrency" id="selCurrency" disabled>
                                    <option value="PHP" selected>PHP</option>
                                    <option value="SGD" >SGD</option>
                                    <option value="QAR" >QAR</option>
                                </select>
                                <input type="hidden" class="form-control" name="inputCurrency" id="inputCurrency" placeholder="CURRENCY" value="PHP"/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="inputAmount" placeholder="Enter Amount" id="inputAmount" title="Input must be a number or decimal." autocomplete="off" oninput="validate(this)" onkeyup="amountValidate()" maxlength="8" required/>
                                <span style="color: red;" id="ammont_err">Minimum amount Is ₱200.00</span>
                                <span style="color: red;" id="ammont_err2">Credit To Bank Limit Is ₱40,000.00</span>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="selBankID" id="selBankID" required>
                                    <option value="" disabled selected>CHOOSE BANK</option>  
                                    <?php 
                                    date_default_timezone_set('Asia/Manila');
                                    foreach ($banks as $key => $value): 
                                    $arrayvalues = explode("*", $value);
                                    if($arrayvalues[2] == "DIGIBANKER" && date("H") >= 17){
                                    ?>
                                        <option value="<?php echo $value; ?>"><?php echo $arrayvalues[1]; ?></option>  
                                    <?php
                                    } else {
                                    ?>
                                        <option value="<?php echo $value; ?>"><?php echo $arrayvalues[1]; ?></option>  
                                    <?php } endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="inputAccountNo" id="inputAccountNo" placeholder="ACCOUNT NO." onkeypress="return /[a-zA-Z 0-9]/i.test(event.key)" required/>
                            </div> 
                            <div class="form-group">
                                <input type="text" class="form-control" name="inputAccountName" id="inputAccountName" placeholder="ACCOUNT NAME" onkeypress="return /[a-zA-Z 0-9]/i.test(event.key)" required/>
                            </div>  
                            <!-- <div class="form-group">
                                <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required/>
                            </div>  -->
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="inputId" id="inputId" placeholder="id"/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6" style="padding-bottom: 30px;">
                    <button type="button" class="btn btn-primary" id="btnModalTransaction" name="btnModalTransaction">SUBMIT</button>
                </div>
            </form>
        
        <?php else: ?>
        <?php if ($AddSender['S']===0): ?>
            <div class="alert alert-danger"><b><?php echo $AddSender['M']?>!!</b></div>
        <?php endif ?>
        <?php if ($AddSender['S']==1): ?>
            <div class="alert alert-success"><b><?php echo $AddSender['M']?> Added Sender</b></div>
        <?php endif ?>
        <?php if ($AddBene['S']===0): ?>
            <div class="alert alert-danger"><b> <?php echo $AddBene['M']?>!!!</b></div>
        <?php endif ?>
        <?php if($DEALER['M'] == "NEW"): ?>
            <div class="container flex-center col noRecord" id="err">
                <h1 class="mt-3" style="font-weight:bold">No Record Found</h1>
                <h3 class="mt-3">Please complete your KYC</h3>
                <h3 class="mb-2">in the V2 App</h3>
                <div class="mt-3 mb-1">
                    <a href="<?php echo BASE_URL() ?>"><button class="ups-btnRecords btn-yellow mb-2 mt-6" style="font-size: 20px; font-weight: 600;">RETURN TO HOME</button></a>
                </div>
            </div>
        <?php else: ?>

            <div class="row row-stat">
                <div class="col-md-12">
                    <div class="row" id="divSearchSender">
                        <div class="col-md-6">
                            <div class="row">
                                <?php if($row['S']==1 && $row['result'][0]['sender_id'] || $rowMessage): ?>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <?php if($DEALER['M'] != "DEALER"): ?>
                                            <div class="col-md-3" style="padding: unset;">
                                                <a href="<?php echo BASE_URL() ?>ecash_send/ecashcredittobank" class="btn btn-primary" id="returnSearchStep1"><span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Return to Search</a> 
                                            </div>
                                        <?php endif ?>
                                        <div class="col-md-3">
                                            <button class="btn btn-primary" id="createBene"><span class="glyphicon glyphicon-plus"></span> &nbsp;New Beneficiary</button> 
                                        </div>

                                    </div>
                                </div>
                                <?php else: ?>
                                

                                    <?php if($DEALER['M'] != "DEALER"): ?>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addModalSender" id="viewModalSender"><span class="glyphicon glyphicon-plus"></span> &nbsp;New Sender</a> 
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <form name="frmecashpadalasender" action="<?php echo BASE_URL() ?>ecash_send/ecashcredittobank" method="post" id="frmSSeachRemit" >
                                                <div class="row">
                                                    <div class='col-xs-12 col-md-12'>
                                                        <h4>SEARCH SENDER</h4>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <input type="text" class="form-control" id="inputSearchFname" name="inputSearchFname" placeholder="FIRST NAME" oninput="this.value = this.value.toUpperCase()" onkeyup="this.value = this.value.replace(/[^a-zA-Z\s\-]/g, '')" required/>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <input type="text" class="form-control" id="inputSearchLname" name="inputSearchLname" placeholder="LAST NAME" oninput="this.value = this.value.toUpperCase()" onkeyup="this.value = this.value.replace(/[^a-zA-Z\s\-]/g, '')" required/>
                                                            </div>
                                                            <div class="col-md-2 sender-search">
                                                                <button type="submit" name="btnSearchSenderBSP" id="btnSearchSenderBSP" class="btn btn-primary">
                                                                    <span id="spanSIcon" class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                                                </button>
                                                            </div> 
                                                        </div> 
                                                    </div>
                                                </div> 
                                            </form>
                                        </div> 
                                    </div> 
                                    <?php endif ?>

                                <?php endif ?>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <?php if ($row['S']==1): ?>
                                            <?php if ($rowMessage): ?>
                                                <div class="alert alert-danger"><b><?php echo $rowMessage?>!!</b></div>
                                            <?php endif ?>
                                            <form name="frmecashpadalabene" action="<?php echo BASE_URL() ?>ecash_send/ecashcredittobank" method="post" id="frmBSeachRemit" >
                                                <div class="row" hidden id="divFrmBSeachRemit">
                                                    <div class='col-xs-12 col-md-12'>
                                                        <h4>SEARCH BENEFICIARY</h4>
                                                        <div class="row">
                                                            <input hidden name="selectedSenderID" id="selectedSenderID" value="" required/>
                                                            <input hidden name="selectedSenderFname" id="selectedSenderFname" value="" required/>
                                                            <input hidden name="selectedSenderLname" id="selectedSenderLname" value="" required/>
                                                            <div class="col-md-2 sender-search">
                                                                <button type="submit" name="btnSearchBeneBSP" id="btnSearchBeneBSP" class="btn btn-primary">
                                                                    <span id="spanSIcon" class="glyphicon glyphicon-search" aria-hidden="true"></span> BENEFICIARY
                                                                </button>
                                                            </div> 
                                                        </div> 
                                                    </div>
                                                </div> 
                                            </form>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br />
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <form action="<?php echo BASE_URL() ?>ecash_send/ecashcredittobank" method="post"  id="frmTransacBSP">
                                    <input hidden id="transactSenderID" name="transactSenderID" value=""/>
                                    <input hidden id="transactBeneID" name="transactBeneID" value=""/>
                                    <input hidden id="transactBeneFname" name="transactBeneFname" value=""/>
                                    <input hidden id="transactBeneLname" name="transactBeneLname" value=""/>
                                    <input hidden id="transactBeneBirthdate" name="transactBeneBirthdate" value=""/>
                                    <button type="submit" class="btn btn-warning btnProceed" id="proceedTransac" name="proceedTransac" style="display:none">Proceed Transaction &nbsp;<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></button>
                                </form>
                            </div>
                        </div>
                        <?php if($selectedSender['S']==1): ?>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h4 id="headerResult">Selected Sender Details :</h4>
                                    <table id="tblSelectedSender"  class="table" cellspacing="0" style="width:100%;">
                                        <tbody>
                                        <?php  foreach ($selectedSender['result'] as $i): ?>
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Fullname</th>
                                                    <th>Address</th>
                                                    <th>Birth Date</th>
                                                    <th>Mobile No</th>
                                                    <th>E-Mail</th>
                                                    <th>Birth Place</th>
                                                    <th>Occupation</th>
                                                    <th>Source of Funds</th>
                                                    <th>Nationality</th>
                                                </tr>
                                            </thead>
                                            <tr class="tr">
                                                <td hidden>
                                                    <input id="selectedSenderDetailsID" value="<?php echo $i['id']?>" hidden/>
                                                </td>
                                                <td><?php echo $i['customer_id']; ?></td>
                                                <td><?php echo $i['lname'].", ".$i['fname']; if($i['suffix']){echo " ".$i['suffix'];} if($i['mname']){echo " ".$i['mname'];} ?></td>
                                                <td><?php echo $i['permanentAddress']; ?></td>
                                                <td><?php echo $i['birthDate']; ?></td>
                                                <td><?php echo $i['mobile']; ?></td>
                                                <td><?php echo $i['emailAdd']; ?></td>
                                                <td><?php echo $i['placeOfBirth']; ?></td>
                                                <td><?php echo $i['occupation']; ?></td>
                                                <td><?php echo $i['sourceOfFund']; ?></td>
                                                <td><?php echo $i['nationality']; ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif ?>
                        <div class="col-md-12">
                            <?php if ($row['S']==1): ?>
                                <hr />
                                <h4 id="headerResult"><?php echo $type['typedesc']; ?> Result :</h4>
                                <input hidden id="selectedSenderSearched" name="selectedSenderSearched" value="<?php echo $row['result'][0]['sender_id']; ?>"/>

                                <table id="example" class="table table-bordered" cellspacing="0" style="width:100%;">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Fullname</th>
                                        <th>Address</th>
                                        <th>Birth Date</th>
                                        <th>Mobile No</th>
                                        <th>E-Mail</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php  foreach ($row['result'] as $i): ?>

                                    <tr class="tr">
                                        <td><?php echo $i['customer_id']; ?></td>
                                        <td><?php echo $i['lname'].", ".$i['fname']; if($i['suffix']){echo " ".$i['suffix'];} if($i['mname']){echo " ".$i['mname'];} ?></td>
                                        <td><?php if($i['permanentAddress']){ echo $i['permanentAddress']; }elseif($i['address']){echo $i['address'];} ?></td>
                                        <td><?php if($i['birthDate']){ echo $i['birthDate']; } if($i['birthdate']){echo $i['birthdate'];} ?></td>
                                        <td><?php if($i['mobile']){ echo $i['mobile']; } if($i['mobileno']){echo $i['mobileno'];} ?></td>
                                        <td><?php if($i['emailAdd']){ echo $i['emailAdd']; } if($i['emailadd']){echo $i['emailadd'];} ?></td>
                                        <td style="text-align: center;"><a id="selectedSender" class="btn btn-danger" data-id="<?php echo $i['id']?>" data-fname="<?php echo $i['fname']?>" data-lname="<?php echo $i['lname']?>" data-dob="<?php if($i['birthDate']){ echo $i['birthDate']; } if($i['birthdate']){echo $i['birthdate'];}?>" href="#">Select</a></td>
                                    </tr>
                                    <?php endforeach ?>
                                
                                    </tbody>
                                </table>
                                        
                            <?php endif ?>
                        </div>
                    </div>
                    <!-- BENEFICIARY FORM -->

                    <div id="senderFormData" class="col-md-12" hidden >
                        <div class="form-group">
                            <button type="button" class="btn btn-primary" id="returnSearch"><span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Return to Select Beneficiary</button> 
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div id="step1">
                                <div class='col-md-12 text-center'>
                                    <div class="form-group">
                                        <h3>SENDER DETAILS</h3>
                                    </div> 
                                </div>
                                <div class='col-md-6'>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">FIRST NAME</span>
                                            <input type="text" class="form-control" name="fnameSender" id="fnameSender" value="<?php echo $row['result']['fname']?>" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class='col-md-6'>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">MIDDLE NAME</span>
                                            <input type="text" class="form-control" name="mnameSender" id="mnameSender" value="<?php echo $row['result']['mname']?>" disabled />
                                        </div>
                                    </div> 
                                </div>
                                <div class='col-md-8'>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1" style="padding-right:17.44px">LAST NAME</span>
                                            <input type="text" class="form-control" name="nameSender" id="lnameSender" value="<?php echo $row['result']['lname']?>" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class='col-md-4'>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">SUFFIX</span>
                                            <input type="text" class="form-control" name="suffixSender" id="suffixSender" value="<?php echo $row['result']['suffix']?>" disabled />
                                        </div>
                                    </div> 
                                </div>
                                
                                <div class='col-md-12' style="padding-top:10px">
                                    <div class="form-group">
                                        <span style="font-weight:bold;">Present Address</span>
                                    </div>
                                </div>
                                <div class='col-md-12'>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1" style="">ADDRESS</span>
                                            <input type="text" class="form-control" name="presentSender" id="presentSender" disabled/>
                                        </div>
                                    </div> 
                                </div>
                                <div class='col-md-12' style="padding-top:10px">
                                    <div class="form-group">
                                        <span style="font-weight:bold;">Permanent Address</span>
                                    </div>
                                </div>
                                <div class='col-md-12'>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1" style="">ADDRESS</span>
                                            <input type="text" class="form-control" name="permanentSender" id="permanentSender" disabled/>
                                        </div>
                                    </div> 
                                </div>
                                
                                <div class='col-md-8' style="padding-top:10px;">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1" style="">EMAIL</span>
                                            <input type="text" class="form-control" name="emailSender" id="emailSender" disabled/>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-md-4' style="padding-top:10px;">
                                    <div class="form-group" >
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1" style="">MOBILE</span>
                                            <input type="text" class="form-control" name="mobileSender" id="mobileSender" disabled/>
                                        </div>
                                    </div> 
                                </div>

                                <div class='col-md-6'>
                                    <div class="form-group" >
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">BIRTHDATE</span>
                                            <input type="date" class="form-control" name="bdateSender" id="bdateSender" placeholder="BIRTHDATE" disabled/>
                                        </div>
                                    </div> 
                                </div>
                                <div class='col-md-6'>
                                    <div class="form-group" >
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">BIRTH PLACE</span>
                                            <input type="text" class="form-control" name="birthplaceSender" id="birthplaceSender" disabled/>
                                        </div>
                                    </div> 
                                </div>
                                <div class='col-md-4'>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">OCCUPATION</span>
                                            <input type="text" class="form-control" name="occupationSender" id="occupationSender" disabled/>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-md-4'>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">SOURCE OF FUNDS</span>
                                            <input type="text" class="form-control" name="sourceoffundSender" id="sourceoffundSender" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-md-4'>
                                    <div class="form-group" >
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">NATIONALITY</span>
                                            <input type="text" class="form-control" name="nationalitySender" id="nationalitySender" disabled/>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="form-group"></div>
                        <form action="<?php echo BASE_URL() ?>ecash_send/ecashcredittobank" method="post"  id="frmAddEcashPadalaBeneficiary">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class='col-md-12 text-center'>
                                    <div class="form-group">
                                        <h3>BENEFICIARY DETAILS</h3>
                                    </div> 
                                </div>
                                <div id="step1">
                                    <input hidden name="senderID" id="senderID"/>
                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="inputFnameBene" id="inputFnameBene" placeholder="FIRSTNAME" required/>
                                        </div> 
                                    </div>
                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="inputMnameBene" id="inputMnameBene" placeholder="MIDDLENAME"/>
                                        </div> 
                                    </div>
                                    <div class='col-md-8'>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="inputLnameBene" id="inputLnameBene"  placeholder="LASTNAME" required/>
                                        </div> 
                                    </div>
                                    <div class='col-md-4'>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="inpuSuffixBene" id="inpuSuffixBene"  placeholder="SUFFIX" />
                                        </div> 
                                    </div>
                                    
                                    <div class='col-md-12' style="padding-top:10px">
                                        <div class="form-group">
                                            <span style="font-weight:bold;">Present Address</span>
                                        </div>
                                    </div>
                                    
                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <select type="text" class="form-control selOption" name="inputCountryBene" id="inputCountryBene" placeholder="COUNTRY" required>
                                                <option value="" selected disabled>SELECT COUNTRY</option>
                                                <option value="PHILIPPINES">PHILIPPINES</option>
                                                <option value="SINGAPORE">SINGAPORE</option>
                                                <option value="QATAR">QATAR</option>
                                            </select>
                                        </div> 
                                    </div>
                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="inputProvinceBene" id="inputProvinceBene" oninput="this.value = this.value.toUpperCase()" onkeypress="return isLetterKey(event)" placeholder="STATE/PROVINCE" disabled required/>
                                            <select class="form-control" id="selRegionBene" name="selRegionBene" style="display: none;">
                                                <option value="" selected disabled>REGION</option>
                                            </select>
                                        </div> 
                                    </div>

                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="inputCityBene" id="inputCityBene" oninput="this.value = this.value.toUpperCase()" onkeypress="return isLetterKey(event)" placeholder="CITY" disabled required/>
                                            <select class="form-control" id="selProvinceBene" name="selProvinceBene" style="display: none;" disabled>
                                                <option value="" selected disabled>STATE/PROVINCE</option>
                                            </select>
                                        </div> 
                                    </div>
                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="inputBarangayBene" id="inputBarangayBene" oninput="this.value = this.value.toUpperCase()" onkeypress="return isLetterNumberKey(event)" placeholder="BARANGAY" disabled required/>
                                            <select class="form-control" id="selCityBene" name="selCityBene" style="display: none;" disabled>
                                                <option value="" selected disabled>CITY</option>
                                            </select>
                                        </div> 
                                    </div>

                                    <div class='col-md-12'>
                                        <div class="form-group">
                                            <select class="form-control" id="selBarangayBene" name="selBarangayBene" style="display: none;" disabled>
                                                <option value="" selected disabled>BARANGAY</option>
                                            </select>
                                        </div> 
                                    </div>

                                    <div class='col-md-8'>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="inputStreetBene" id="inputStreetBene" placeholder="STREET" disabled required/>
                                        </div> 
                                    </div>
                                    <div class='col-md-4'>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="inputPostalBene" id="inputPostalBene" placeholder="POSTAL" disabled onkeypress="return isNumberKey(event)" maxlength="4" required/>
                                        </div> 
                                    </div>


                                    <div class='col-md-8' style="padding-top:10px;">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="inputEmailBene" id="inputEmailBene" placeholder="EMAIL" required/>
                                        </div>
                                    </div>
                                    <div class='col-md-4' style="padding-top:10px;">
                                        <div class="form-group" >
                                            <input type="text" class="form-control" name="inputMobileBene" id="inputMobileBene" placeholder="MOBILE NUMBER" onkeypress="return isNumberKey(event)" maxlength="11" required/>
                                        </div> 
                                    </div>

                                    <div class='col-md-6'>
                                        <div class="form-group" >
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1">BIRTHDATE</span>
                                                <input type="date" class="form-control" name="inputBdateBene" id="inputBdateBene" placeholder="BIRTHDATE" onkeydown="return false" required/>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class='col-md-6'>
                                        <div class="form-group" >
                                            
                                        </div> 
                                    </div>
                                    <!-- <div class='col-md-12' style="padding-top: 20px;">
                                        <div class="form-group" >
                                            <input type="password" class="form-control" name="inputTpass" id="inputTpass" placeholder="TRANSACTION PASSWORD" required/>
                                        </div> 
                                    </div> -->
                                    <div class='col-md-12'style="padding-bottom: 20px;">
                                        <div class="form-group" >
                                            <button type="submit" class="btn btn-primary" id="btnAddDetailsBene" name="btnAddDetailsBene">SUBMIT</button>
                                        </div> 
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-md-1"></div>
                        </form>
                    </div> <!-- END OF BENEFICIARY FORM -->
                </div><!--row-->
                
            
            </div>
        
                
        <?php endif ?>
            
            </div>
        <?php endif ?>

    </div>       
</div>

    <!-- ADD NEW SENDER -->
    <div class="modal fade" id="addModalSender" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
      
            <!-- Modal content-->
            <div class="modal-content">
                
                <form action="<?php echo BASE_URL() ?>ecash_send/ecashcredittobank" method="post"  id="frmAddEcashPadalaSender" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" id="addModalClose">&times;</button>
                        <h4 class="modal-title">ADD NEW SENDER</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="step1">
                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="inputFname" id="inputFname" placeholder="FIRSTNAME" oninput="this.value = this.value.toUpperCase()" required/>
                                        </div> 
                                    </div>
                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="inputMname" id="inputMname" placeholder="MIDDLENAME" oninput="this.value = this.value.toUpperCase()" />
                                        </div> 
                                    </div>
                                    <div class='col-md-8'>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="inputLname" id="inputLname"  placeholder="LASTNAME" oninput="this.value = this.value.toUpperCase()" required/>
                                        </div> 
                                    </div>
                                    <div class='col-md-4'>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="inpuSuffix" id="inpuSuffix"  placeholder="SUFFIX" oninput="this.value = this.value.toUpperCase()" />
                                        </div> 
                                    </div>
                                    
                                    <div class='col-md-12' style="padding-top:10px">
                                        <div class="form-group">
                                            <span style="font-weight:bold;">Present Address</span>
                                        </div>
                                    </div>
                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <select type="text" class="form-control selOption" name="inputCountry" id="inputCountry" placeholder="COUNTRY" required>
                                                <option value="" selected disabled>SELECT COUNTRY</option>
                                                <option value="PHILIPPINES">PHILIPPINES</option>
                                                <option value="SINGAPORE">SINGAPORE</option>
                                                <option value="QATAR">QATAR</option>
                                            </select>
                                        </div> 
                                    </div>
                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="inputProvince" id="inputProvince" placeholder="STATE/PROVINCE" oninput="this.value = this.value.toUpperCase()" onkeypress="return isLetterKey(event)" disabled required/>
                                            <select class="form-control" id="selRegion" style="display: none;">
                                                <option value="" selected disabled>REGION</option>
                                            </select>
                                        </div> 
                                    </div>

                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="inputCity" id="inputCity"  placeholder="CITY" oninput="this.value = this.value.toUpperCase()" onkeypress="return isLetterKey(event)" disabled required/>
                                            <select class="form-control" id="selProvince" style="display: none;" disabled>
                                                <option value="" selected disabled>STATE/PROVINCE</option>
                                            </select>
                                        </div> 
                                    </div>
                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="inputBarangay" id="inputBarangay"  placeholder="BARANGAY" oninput="this.value = this.value.toUpperCase()" onkeypress="return isLetterNumberKey(event)" disabled required/>
                                            <select class="form-control" id="selCity" style="display: none;" disabled>
                                                <option value="" selected disabled>CITY</option>
                                            </select>
                                        </div> 
                                    </div>
                                    <div class='col-md-12'>
                                        <div class="form-group">
                                            <select class="form-control" id="selBarangay" style="display: none;" disabled>
                                                <option value="" selected disabled>BARANGAY</option>
                                            </select>
                                        </div> 
                                    </div>

                                    <div class='col-md-8'>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="inputStreet" id="inputStreet"  placeholder="STREET" disabled required/>
                                        </div> 
                                    </div>
                                    <div class='col-md-4'>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="inputPostal" id="inputPostal"  placeholder="POSTAL" onkeypress="return isNumberKey(event)" maxlength="4" disabled required/>
                                        </div> 
                                    </div>

                                    <div class='col-md-12' style="padding-top:20px">
                                        <div class="form-group">
                                            <span style="font-weight:bold;">Permanent Address</span>
                                            
                                        </div>
                                    </div>
                                    <!-- <div class='col-md-6 text-right' style="padding-top:20px">
                                        <div class="form-group">
                                            <label class=""> Same as present address
                                                <input type="checkbox" id="sameAsPresent">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div> -->
                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <select type="text" class="form-control selOption" name="inputCountry2" id="inputCountry2" placeholder="COUNTRY" required>
                                                <option value="" selected disabled>SELECT COUNTRY</option>
                                                <option value="PHILIPPINES">PHILIPPINES</option>
                                                <option value="SINGAPORE">SINGAPORE</option>
                                                <option value="QATAR">QATAR</option>
                                            </select>
                                        </div> 
                                    </div>
                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="inputProvince2" id="inputProvince2"  placeholder="STATE/PROVINCE" oninput="this.value = this.value.toUpperCase()" onkeypress="return isLetterKey(event)" disabled required/>
                                            <select class="form-control" id="selRegion2" style="display: none;">
                                                <option value="" selected disabled>REGION</option>
                                            </select>
                                        </div> 
                                    </div>

                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="inputCity2" id="inputCity2"  placeholder="CITY" oninput="this.value = this.value.toUpperCase()" onkeypress="return isLetterKey(event)" disabled required/>
                                            <select class="form-control" id="selProvince2" style="display: none;" disabled>
                                                <option value="" selected disabled>STATE/PROVINCE</option>
                                            </select>
                                        </div> 
                                    </div>

                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="inputBarangay2" id="inputBarangay2"  placeholder="BARANGAY" oninput="this.value = this.value.toUpperCase()" onkeypress="return isLetterNumberKey(event)" disabled required/>
                                            <select class="form-control" id="selCity2" style="display: none;" disabled>
                                                <option value="" selected disabled>CITY</option>
                                            </select>
                                        </div> 
                                    </div>

                                    <div class='col-md-12'>
                                        <div class="form-group">
                                            <select class="form-control" id="selBarangay2" style="display: none;" disabled>
                                                <option value="" selected disabled>BARANGAY</option>
                                            </select>
                                        </div> 
                                    </div>

                                    <div class='col-md-8'>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="inputStreet2" id="inputStreet2"  placeholder="STREET" disabled required/>
                                        </div> 
                                    </div>
                                    <div class='col-md-4'>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="inputPostal2" id="inputPostal2"  placeholder="POSTAL" onkeypress="return isNumberKey(event)" maxlength="4" disabled required/>
                                        </div> 
                                    </div>
                                    
                                    
                                    <div class='col-md-8' style="padding-top:10px;">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="inputEmail" id="inputEmail"  placeholder="EMAIL" required/>
                                        </div>
                                    </div>
                                    <div class='col-md-4' style="padding-top:10px;">
                                        <div class="form-group" >
                                            <input type="text" class="form-control" name="inputMobile" id="inputMobile" placeholder="MOBILE NUMBER" onkeypress="return isNumberKey(event)" maxlength="11" required/>
                                        </div> 
                                    </div>

                                    <div class='col-md-6'>
                                        <div class="form-group" >
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1">BIRTHDATE</span>
                                                <input type="date" class="form-control" name="inputBdate" id="inputBdate" placeholder="BIRTHDATE" onkeydown="return false" required/>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class='col-md-6'>
                                        <div class="form-group" >
                                            <input type="text" class="form-control" name="inputBirthplace" id="inputBirthplace" placeholder="BIRTH PLACE" required/>
                                        </div> 
                                    </div>
                                    <div class='col-md-4'>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="inputOccupation" id="inputOccupation"  placeholder="OCCUPATION" required/>
                                        </div>
                                    </div>
                                    <div class='col-md-4'>
                                        <div class="form-group">
                                            <select class="form-control selOption" name="inputSourceoffund" id="inputSourceoffund" required>
                                                <option  value="" disabled selected>SOURCE OF FUND</option>  
                                                <option  value="Salary">Salary</option>
                                                <option  value="Savings">Savings</option>
                                                <option  value="Inheritance">Inheritance</option>
                                                <option  value="Company Profit">Company Profit</option>
                                                <option  value="Investments">Investments</option>
                                                <option  value="Others">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class='col-md-4'>
                                        <div class="form-group" >
                                            <input type="text" class="form-control" name="inputNationality" id="inputNationality" placeholder="NATIONALITY" required/>
                                        </div> 
                                    </div>
                                </div>
                                <div id="step2">
                                    <div class="alert alert-danger" style="display:none; text-align: center;" id="updateexpired"><b></b></div>
                                    <div class="alert alert-success" style="display:none; text-align: center;" id="addnewsuccess"><b></b></div>
                                    <div class='col-md-12' style="padding-top:20px">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span style="font-weight:bold;">ID # 1</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon" style="padding-right: 34px;">ID TYPE:</span>
                                            <select class="form-control selOption" name="newidtype" id="newidtype" required>
                                                <option value="" disabled selected>--CHOOSE ID TYPE--</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon" style="padding-right: 12px;">ID NUMBER:</span>
                                            <input type="text" class="form-control" name="newidnumber" id="newidnumber" required />
                                        </div>
                                    </div>
                                    <div class="form-group" hidden id="divNewexpirydate1">
                                        <div class="input-group">
                                            <span class="input-group-addon" style="padding-right: 34px;">EXPIRY DATE:</span>
                                            <input type="date" class="form-control" name="newexpirydate1" id="newexpirydate1" onkeydown="return false" required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon" style="padding-right: 45px;">ID PICTURE:</span>
                                            <input type="file" class="form-control" name="file1" id="file1" title="No File Found"  accept="image/*" onchange="ValidateSingleInput(this);" required />
                                        </div>
                                    </div>
                                    
                                    <div hidden id="divID2">
                                        <div class='col-md-12' style="padding-top:10px">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span style="font-weight:bold;">ID # 2</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon" style="padding-right: 34px;">ID TYPE:</span>
                                                <select class="form-control" name="newidtype2" id="newidtype2" >
                                                    <option value="" disabled selected>--CHOOSE ID TYPE--</option>   
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"  style="padding-right: 12px;">ID NUMBER:</span>
                                                <input type="text" class="form-control" name="newidnumber2" id="newidnumber2">
                                            </div>
                                        </div>
                                        <div class="form-group" hidden id="divNewexpirydate2">
                                            <div class="input-group">
                                                <span class="input-group-addon"  style="padding-right: 34px;">EXPIRY DATE:</span>
                                                <input type="date" class="form-control" name="newexpirydate2" id="newexpirydate2" onkeydown="return false">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"  style="padding-right: 45px;">ID PICTURE:</span>
                                                <input type="file" class="form-control" name="file2" id="file2" accept="image/*" title="No File Found" onchange="ValidateSingleInput(this);">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- <div class='col-md-12'>
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="TRANSACTION PASSWORD" name="inputTpass" required>
                                        </div>
                                    </div> -->
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-md-12 mt-2 text-right">
                                <button type="button" class="btn btn-primary" name="btnAddSenderBSP" id="btnAddSenderBSP">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
            
    </div> <!-- END OF ADD NEW SENDER-->

    <!-- MODAL DENY TRANSACTION -->
    <div class="modal mt-5" id="transactionRejectModal" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">  
                <div class="modal-header">
                    <button type="button" id="closeModal" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="col flex-center mt-3" style="margin-left: 25px;">
                        <h1>ARE YOU <span style="color:#FFB800">SURE?</span></h1>
                        <h4 class="txt-center mt-2">You want to <span style="color:red;">REJECT</span> transaction <span style="text-decoration: underline;" id="denyTrackno"><?php echo $transactStatus['TN']?></span> ?</h4>
                    </div>
                    <div class="col flex-center" style="padding-top: 30px;">
                        <input class="field-view row" style="height: 52px; width: 365px; " placeholder="COMMENT" id="denyComment"/>
                    </div>
                </div>

                <div id="divConfirmDeny">
                    <div class="col flex-center mb-3" id="confirmDiv" style="padding-top: 30px;">
                        <button type="button" class="btnApprove" style="height:56px; width:322px; background-color:#FFC914; font-size:20px; font-weight:600; color:white;" name="rejectOTP2" id="rejectOTP2" data-info="DENIED">REJECT</button>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- END OF MODAL DENY TRANSACTION -->

    <!-- MODAL CONFIRMATION OF TRANSACTION -->
    <div class="modal fade" id="remittanceSummaryModal" role="dialog" >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">SUMMARY TRANSACTION DETAILS</h4>
          </div>
          <form name="frmSummaryConfirmation" action="<?php echo BASE_URL() ?>ecash_send/ecashcredittobank" method="post" id="frmSummaryConfirmation" > 
            <input hidden name="transacSenderID" id="transacSenderID" value="<?php if($AddBene['S']==1){echo $beneDetails['result'][0]['sender_id'];} elseif($selectedID1){echo $selectedID1['result'][0]['id']; }?>"/>
            <input hidden name="transacBeneID" id="transacBeneID" value="<?php if($AddBene['S']==1){echo $beneDetails['result'][0]['id'];} elseif($selectedID2){echo $selectedID2['result'][0]['id']; }?>"/>
            <input hidden name="inputRelation" id="hiddenInputRelation"/>
            <input hidden name="inputPurpose" id="hiddenInputPurpose"/>
            <input hidden name="service" id="hiddenService" value="CREDITTOBANK"/>
            <input hidden name="inputCurrency" id="hiddenInputCurrency" value="PHP"/>
            <input hidden name="inputAmount" id="hiddenInputAmount"/>
            <input hidden name="selBankID" id="hiddenselBankID"/>
            <input hidden name="inputAccountNo" id="hiddenInputAccountNo"/>
            <input hidden name="inputAccountName" id="hiddenInputAccountName"/>
            <input hidden name="inputServiceType" id="hiddenInputServiceType"/>
            
            
            <div class="modal-body">
              <h5><strong>SENDER INFORMATION</strong></h5>
              <div class="row">
                <div class='col-xs-12 col-md-12'>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="text-align: left; padding-right: 120px;">SENDER ID:</span>
                    <input type="text" class="form-control" name="senderid" id="senderid" readonly="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class='col-xs-12 col-md-12'>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="text-align: left; padding-right: 94px;">SENDER NAME:</span>
                    <input type="text" class="form-control" name="sender_name" id="sender_name" readonly="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class='col-xs-12 col-md-12'>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="text-align: left; padding-right: 119px;">BIRTHDATE:</span>
                    <input type="text" class="form-control" name="sender_bdate" id="sender_bdate" readonly="">
                  </div>
                </div>
              </div>
              <h5><strong>BENEFICIARY INFORMATION</strong></h5>
              <div class="row">
                <div class='col-xs-12 col-md-12'>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="text-align: left; padding-right: 86px;">BENEFICIARY ID:</span>
                    <input type="text" class="form-control" name="beneid" id="beneid" readonly="">
                    <input type="hidden" name="hiddenBeneDetails" id="hiddenBeneDetails">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class='col-xs-12 col-md-12'>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="text-align: left; padding-right: 59px;">BENEFICIARY NAME:</span>
                    <input type="text" class="form-control" name="bene_name" id="bene_name" readonly="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class='col-xs-12 col-md-12'>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="text-align: left; padding-right: 119px;">BIRTHDATE:</span>
                    <input type="text" class="form-control" name="bene_bdate" id="bene_bdate" readonly="">
                  </div>
                </div>
              </div>
              <hr/>
              <h5><strong>REMITTANCE INFORMATION</strong></h5>
              <div class="row">
                <div class='col-xs-12 col-md-12'>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="text-align: left; padding-right: 29px;">RELATION TO RECEIVER:</span>
                    <input type="text" class="form-control" name="irelation" id="irelation" readonly="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class='col-xs-12 col-md-12'>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="text-align: left; padding-right: 128px;">PURPOSE:</span>
                    <input type="text" class="form-control" name="ipurpose" id="ipurpose" readonly="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class='col-xs-12 col-md-12'>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="text-align: left; padding-right: 118px;">CURRENCY:</span>
                    <input type="text" class="form-control" name="icurrency" id="icurrency" readonly="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class='col-xs-12 col-md-12'>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="text-align: left; padding-right: 62px;">PRINCIPAL AMOUNT:</span>
                    <input type="text" class="form-control" name="iamount" id="iamount" readonly="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class='col-xs-12 col-md-12'>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="text-align: left; padding-right: 103px;">ACCOUNT NO:</span>
                    <input type="text" class="form-control" name="iaccountno" id="iaccountno" readonly="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class='col-xs-12 col-md-12'>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="text-align: left; padding-right: 83px;">ACCOUNT NAME:</span>
                    <input type="text" class="form-control" name="iaccountname" id="iaccountname" readonly="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class='col-xs-12 col-md-12'>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="text-align: left; padding-right: 137px;">CHARGE:</span>
                    <input type="text" class="form-control" name="icharge" id="icharge" readonly="">
                    <input type="hidden" name="inputCharge" id="hiddenInputCharge" class="form-control"/>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class='col-xs-12 col-md-12'>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="text-align: left; padding-right: 153px;">TOTAL:</span>
                    <input type="text" class="form-control" name="itotal" id="itotal" readonly="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class='col-xs-12 col-md-12'>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="text-align: left;">TRANSACTION PASSWORD:</span>
                    <input type="password" class="form-control" name="inputTpass" id="tpass" required="">
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
              <div class="col-md-6"></div>
                <div class="col-md-6 text-right">
                  <button type="submit" class="btn btn-primary" name="btnSubmitBSP" id="btnSubmitBSP">Confirm</button>
                </div>
              </div>
            </div>
            </form>
          </div>
        </div>
    </div>
    <!-- END OF MODAL CONFIRMATION OF TRANSACTION -->


    <?php } ?>
    <?php if ($details['process'] == 1) {?>
          <div class="row">
              <div class="col-md-12"><h2>Are you sure you want to confirm?</h3></div>
                   <form name="frmecashpadalasender" action="<?php echo BASE_URL() ?>ecash_send/ecashcredittobank" method="post" id="frmSSeachRemit" >
                        <div class="form-group">
                            <h4 id="headerResult">Selected Sender Details :</h4>
                            <table id="tblSelectedSender"  class="table" cellspacing="0" style="width:100%;">
                                <tbody>
                                <?php  foreach ($selectedSender['result'] as $i): ?>
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Fullname</th>
                                        <th>Address</th>
                                        <th>Birth Date</th>
                                        <th>Mobile No</th>
                                        <th>E-Mail</th>
                                    </tr>
                                    </thead>
                                    <tr class="tr">
                                        <td hidden>
                                            <input id="selectedSenderDetailsID" value="<?php echo $i['id']?>" hidden/>
                                        </td>
                                        <td><?php echo $i['customer_id']; ?></td>
                                        <td><?php echo $i['lname'].", ".$i['fname']." ".$i['mname']; ?></td>
                                        <td><?php echo $i['permanentAddress']; ?></td>
                                        <td><?php echo $i['birthDate']; ?></td>
                                        <td><?php echo $i['mobile']; ?></td>
                                        <td><?php echo $i['emailAdd']; ?></td>
                                    </tr>
                                <?php endforeach ?>
                            
                                </tbody>
                            </table>
                        </div>

                    </form>
          </div>
        <?php }?>
    </div>

  

  <script type="text/javascript">
    var rowid, fetchedID;

    $('#sameAsPresent').on('change', function(){
        var isCheck = $('#sameAsPresent').prop('checked');
        if($('#inputCountry2').val()){
            if(isCheck) {
                if($('#inputCountry').val() == 'PHILIPPINES'){
                    alert($('#selRegion option:selected').text())
                    alert($('#selProvince option:selected').text())
                    alert($('#selCity option:selected').text())
                    alert($('#selBarangay option:selected').text())
                    $('#inputCountry2').val($('#inputCountry').val());

                    $('#selRegion2').append($('<option>', {
                        value: $('#selRegion option:selected').text(),
                        text: $('#selRegion option:selected').text()
                    }));
                    $('#selProvince2').append($('<option>', {
                        value: $('#selProvince option:selected').text(),
                        text: $('#selProvince option:selected').text()
                    }));
                    $('#selCity2').append($('<option>', {
                        value: $('#selCity option:selected').text(),
                        text: $('#selCity option:selected').text()
                    }));
                    $('#selBarangay2').append($('<option>', {
                        value: $('#selBarangay option:selected').text(),
                        text: $('#selBarangay option:selected').text()
                    }));

                    $('#inputStreet2').val($('#inputStreet').val());
                    $('#inputPostal2').val($('#inputPostal').val());
                }else{
                    $('#inputCountry2').val($('#inputCountry').val());
                    $('#inputProvince2').val($('#inputProvince').val());
                    $('#inputCity2').val($('#inputCity').val());
                    $('#inputBarangay2').val($('#inputBarangay').val());
                    $('#inputStreet2').val($('#inputStreet').val());
                    $('#inputPostal2').val($('#inputPostal').val());
                }
            } else {
                
                if($('#inputCountry').val() == 'PHILIPPINES'){
                    $('#inputCountry2').val('');
                    $('#selRegion2').val('');
                    $('#selProvince2').val('');
                    $('#selCity2').val('');
                    $('#selBarangay2').val('');
                    $('#inputStreet2').val('');
                    $('#inputPostal2').val('');
                }else{
                    $('#inputCountry2').val("");
                    $('#inputProvince2').val("");
                    $('#inputCity2').val("");
                    $('#inputBarangay2').val("");
                    $('#inputStreet2').val("");
                    $('#inputPostal2').val("");
                }
            }
        }else{
            $('#sameAsPresent').prop('checked', false);
            swal({
                title: 'Ooppss!',
                text: 'Please Select Country on Permanent Address First!',
                icon: 'warning',
                buttons: false,
            })
        }
    })

    $('#inputCountry').on('change', function(){
        $('#inputProvince, #inputCity, #inputBarangay, #inputStreet, #inputPostal').removeAttr('disabled');
        if($(this).val() == 'PHILIPPINES'){
            $('#inputProvince, #inputCity, #inputBarangay').hide().val("").removeAttr('required');
            $('#selRegion, #selProvince, #selCity, #selBarangay').css('display', '').attr('required', true);

            $('#selRegion').append($('<option>', {
                value: 'default',
                text: 'STATE/PROVINCE'
            }).attr('selected','selected'));
            $('#selProvince').append($('<option>', {
                value: 'default',
                text: 'REGION'
            }).attr('selected','selected'));
            $('#selCity').append($('<option>', {
                value: 'default',
                text: 'CITY'
            }).attr('selected','selected'));
            $('#selBarangay').append($('<option>', {
                value: 'default',
                text: 'BARANGAY'
            }).attr('selected','selected'));

            $('#selProvince, #selCity, #selBarangay').attr('disabled', true);
            $('#selProvince option[value=default], #selCity option[value=default], #selBarangay option[value=default]').attr('selected','selected');
        }else{
            $('#inputProvince, #inputCity, #inputBarangay').show().attr('required', true);
            $('#selRegion, #selProvince, #selCity, #selBarangay').css('display', 'none').val("").removeAttr('required');
        }
    })

    $('#inputCountry2').on('change', function(){
        $('#inputProvince2, #inputCity2, #inputBarangay2, #inputStreet2, #inputPostal2').removeAttr('disabled');
        if($(this).val() == 'PHILIPPINES'){
            $('#inputProvince2, #inputCity2, #inputBarangay2').hide().val("").removeAttr('required');
            $('#selRegion2, #selProvince2, #selCity2, #selBarangay2').css('display', '').attr('required', true);

            $('#selRegion2').append($('<option>', {
                value: 'default',
                text: 'STATE/PROVINCE'
            }));
            $('#selProvince2').append($('<option>', {
                value: 'default',
                text: 'REGION'
            }));
            $('#selCity2').append($('<option>', {
                value: 'default',
                text: 'CITY'
            }));
            $('#selBarangay2').append($('<option>', {
                value: 'default',
                text: 'BARANGAY'
            }));

            $('#selProvince2, #selCity2, #selBarangay2').attr('disabled', true);
            $('#selProvince2 option[value=default], #selCity2 option[value=default], #selBarangay2 option[value=default]').attr('selected','selected');
        }else{
            $('#inputProvince2, #inputCity2, #inputBarangay2').show().attr('required', true);
            $('#selRegion2, #selProvince2, #selCity2, #selBarangay2').css('display', 'none').val("").removeAttr('required');
        }
    })

    $('#inputCountryBene').on('change', function(){
        $('#inputProvinceBene, #inputCityBene, #inputBarangayBene, #inputStreetBene, #inputPostalBene').removeAttr('disabled');
        if($(this).val() == 'PHILIPPINES'){
            $('#inputProvinceBene, #inputCityBene, #inputBarangayBene').hide().val("").removeAttr('required');
            $('#selRegionBene, #selProvinceBene, #selCityBene, #selBarangayBene').css('display', '').attr('required', true);

            $('#selRegionBene').append($('<option>', {
                value: 'default',
                text: 'STATE/PROVINCE'
            }));
            $('#selProvinceBene').append($('<option>', {
                value: 'default',
                text: 'REGION'
            }));
            $('#selCityBene').append($('<option>', {
                value: 'default',
                text: 'CITY'
            }));
            $('#selBarangayBene').append($('<option>', {
                value: 'default',
                text: 'BARANGAY'
            }));

            $('#selProvinceBene, #selCityBene, #selBarangayBene').attr('disabled', true);
            $('#selProvinceBene option[value=default], #selCityBene option[value=default], #selBarangayBene option[value=default]').attr('selected','selected');
        }else{
            $('#inputProvinceBene, #inputCityBene, #inputBarangayBene').show().attr('required', true);
            $('#selRegionBene, #selProvinceBene, #selCityBene, #selBarangayBene').css('display', 'none').val("").removeAttr('required');
        }
    })

    $('#selProvinceBene').on('change', function(){
        $('#inputProvinceBene').val($('#selProvinceBene option:selected').text()+', ' +$('#selRegionBene option:selected').text());
    });
    $('#selCityBene').on('change', function(){
        $('#inputCityBene').val($('#selCityBene option:selected').text());
    });
    $('#selBarangayBene').on('change', function(){
        $('#inputBarangayBene').val($('#selBarangayBene option:selected').text());
    });

    $('#sameAsPresentDealer').on('change', function(){
        var isCheck = $('#sameAsPresentDealer').prop('checked');
        if(isCheck) {
            $('#inputCountry2Dealer').val($('#inputCountryDealer').val());
            $('#inputProvince2Dealer').val($('#inputProvinceDealer').val());
            $('#inputCity2Dealer').val($('#inputCityDealer').val());
            $('#inputBarangay2Dealer').val($('#inputBarangayDealer').val());
            $('#inputStreet2Dealer').val($('#inputStreetDealer').val());
            $('#inputPostal2Dealer').val($('#inputPostalDealer').val());
        } else {
            $('#inputCountry2Dealer').val("")
            $('#inputProvince2Dealer').val("")
            $('#inputCity2Dealer').val("")
            $('#inputBarangay2Dealer').val("")
            $('#inputStreet2Dealer').val("")
            $('#inputPostal2Dealer').val("")
        }
    })

    $('#viewModalSender').click(function(){
        $('#frmAddEcashPadalaSender').trigger("reset");
        $('#divID2').hide();
        $('#amount_errMobileNum1').hide()
        $('#amount_errEmailSender1').hide()

        $('#newidtype2').val("").removeAttr('required')
        $('#newidtype2').attr('class', 'form-control')
        $('#newidnumber2').val("").removeAttr('required')
        $('#file2').val("").removeAttr('required')
        $('#btnAddSenderBSP').prop('disabled', true)
        if (fetchedID != "meron") {
            waitingDialog.show('Please Wait.', {dialogSize: 'sm', progressType: 'primary'});
            $.ajax({
                url         : '/Ecash_send/fetch_IDs',
                type        : 'POST',
                processData : false,
                contentType : false,
                success     : function (data) {
                    var jsonData = JSON.parse(data);

                    if(jsonData.S == 1){
                        fetchedID = "meron";
                        $('#newidtype').append($('<option>', {
                            text: "-- PRIMARY --",
                            disabled: true
                        }))

                        jsonData.T_DATA.forEach(function(i){

                            // console.log(i)
                            if(i.idtype == 'PRIMARY'){
                                $('#newidtype').append($('<option>', {
                                    id: i.id,
                                    value: i.id,
                                    text: i.description
                                }));
                                $('#'+i.id).attr('data-expiry', i.expirable)
                                $('#'+i.id).attr('data-type', i.idtype)
                                $('#'+i.id).attr('data-regex', (i.rule).replace("/g", ""))
                            }
                        })
                        
                        $('#newidtype').append($('<option>', {
                            text: "-- SECONDARY --",
                            disabled: true
                        }))

                        jsonData.T_DATA.forEach(function(i){
                        
                            if(i.idtype == 'SECONDARY'){
                                $('#newidtype').append($('<option>', {
                                    id: i.id,
                                    value: i.id,
                                    text: i.description
                                }));
                                $('#'+i.id).attr('data-expiry', i.expirable)
                                $('#'+i.id).attr('data-type', i.idtype)
                                $('#'+i.id).attr('data-regex', (i.rule).replace("/g", ""))
                            }
                        })

                        jsonData.T_DATA.forEach(function(i){
                            if(i.idtype == 'SECONDARY'){
                                $('#newidtype2').append($('<option>', {
                                    id: i.id,
                                    value: i.id,
                                    text: i.description
                                }));
                                $('#newidtype2 #'+i.id).attr('data-expiry', i.expirable)
                                $('#newidtype2 #'+i.id).attr('data-type', i.idtype)
                                $('#newidtype2 #'+i.id).attr('data-regex', (i.rule).replace("/g", ""))
                            }
                        })
                        waitingDialog.hide()
                        $('#newidtype').removeAttr("disabled")

                        $('#addModalSender #btnAddSenderBSP').on('click', function(){
                            let empty1 = false;
                            let empty2 = false;
                            var idArray1 = [];
                            var idArray2 = [];

                            $('form#frmAddEcashPadalaSender').find('input').each(function(){
                                if($(this).prop('required')){
                                    $(this).each(function() {
                                        empty1 = $(this).val().length;
                                        idArray1.push(empty1);
                                    });

                                }
                            });
                            
                            $('form#frmAddEcashPadalaSender .selOption > option:selected').each(function() {
                                if($('form#frmAddEcashPadalaSender .selOption').is(':visible')){
                                    if($('form#frmAddEcashPadalaSender .selOption').prop('required')){
                                        empty2 = $(this).val().length;
                                        idArray2.push(empty2);
                                    }
                                }
                            });
                            
                            const someIsNotZero1 = idArray1.some(item => item == 0);
                            const someIsNotZero2 = idArray2.some(item => item == 0);
                            // alert(someIsNotZero1+" "+ idArray1+" | "+someIsNotZero2+" "+ idArray2)

                            if (!someIsNotZero1 && !someIsNotZero2){
                                waitingDialog.show('Please Wait.', {dialogSize: 'sm', progressType: 'primary'});
                                createSender()
                            }else{
                                swal({
                                    title: 'Blank fields detected!',
                                    text: "Please fill-in required fields.",
                                    icon: 'warning',
                                    buttons: false,
                                })
                            }
                        })
                    }
                }
            })
        }
        
    })
    

    $('#newidtypeDealer').on('change', function(){
        if($(this).children(":selected").data('expiry') == "YES"){
            $('#divNewexpirydate1Dealer').show(200)
            $('#newexpirydate1Dealer').prop('required',true);
        }
        if($(this).children(":selected").data('expiry') == "NO"){
            $('#divNewexpirydate1Dealer').hide()
            $('#newexpirydate1Dealer').val("").removeAttr('required')
        }
        if($(this).children(":selected").data('type') == "SECONDARY"){
            $('#divID2Dealer').show(200);
            
            $('#newidtype2').attr('class', 'form-control selOption')
            $('#newidtype2Dealer').prop('required',true)
            $('#newidnumber2Dealer').prop('required',true)
            $('#fileDealer2').prop('required',true)
        }
        if($(this).children(":selected").data('type') == "PRIMARY"){
            $('#divID2Dealer').hide();
            
            $('#newidtype2').attr('class', 'form-control')
            $('#newidtype2Dealer').val("").removeAttr('required')
            $('#newidnumber2Dealer').val("").removeAttr('required')
            $('#fileDealer2').val("").removeAttr('required')
        }
    })

    $('#newidtype2Dealer').on('change', function(){
        if($(this).children(":selected").data('expiry') == "YES"){
            $('#divNewexpirydate2Dealer').show(200)
            $('#newexpirydate2Dealer').prop('required',true)
        }
        if($(this).children(":selected").data('expiry') == "NO"){
            $('#divNewexpirydate2Dealer').hide()
            $('#newexpirydate2Dealer').val("").removeAttr('required')
        }

        $('#newidnumber2Dealer').attr('pattern', $(this).children(":selected").data('regex'));
    })

    $('#newidtype').on('change', function(){
        if($(this).children(":selected").data('expiry') == "YES"){
            $('#divNewexpirydate1').show(200)
            $('#newexpirydate1').prop('required',true);
        }
        if($(this).children(":selected").data('expiry') == "NO"){
            $('#divNewexpirydate1').hide()
            $('#newexpirydate1').val("").removeAttr('required')
        }
        if($(this).children(":selected").data('type') == "SECONDARY"){
            $('#divID2').show(200);
            
            $('#newidtype2').prop('required',true)
            $('#newidtype2').attr('class', 'form-control selOption')
            $('#newidnumber2').prop('required',true)
            $('#file2').prop('required',true)
        }
        if($(this).children(":selected").data('type') == "PRIMARY"){
            $('#divID2').hide();

            $('#newidtype2').val("").removeAttr('required')
            $('#newidtype2').attr('class', 'form-control')
            $('#newidnumber2').val("").removeAttr('required')
            $('#file2').val("").removeAttr('required')
        }
    })

    $('#newidtype2').on('change', function(){
        if($(this).children(":selected").data('expiry') == "YES"){
            $('#divNewexpirydate2').show(200)
            $('#newexpirydate2').prop('required',true)
        }
        if($(this).children(":selected").data('expiry') == "NO"){
            $('#divNewexpirydate2').hide()
            $('#newexpirydate2').val("").removeAttr('required')
        }

        $('#newidnumber2').attr('pattern', $(this).children(":selected").data('regex'));
    })

    // ############################################# BENEFICIARY ##########################################

    $('td #selectedSender').on('click', function(){
        rowid = $(this).data('id')
        var formData = new FormData();
        if($('#selectedSenderSearched').val()){
            // alert($('#selectedSenderSearched').val()+"zxc")
            $('#transactSenderID').val($('#selectedSenderSearched').val())
            $('#transactBeneID').val(rowid)
            $('#transactBeneFname').val($(this).data('fname'))
            $('#transactBeneLname').val($(this).data('lname'))
            $('#transactBeneBirthdate').val($(this).data('dob'))
            $('#proceedTransac').show(200);
        }else if($('#createBene').is(':visible')){
            $('#selectedSenderID').val(rowid)
            $('#senderID').val(rowid) // For Creating New Beneficiary
        }else{
            $('#selectedSenderID').val(rowid)
            $('#senderID').val(rowid)
            $('#divFrmBSeachRemit').show(200)
        }
        $('tr').removeClass('selected');

        $('#inputSearchFname').val($(this).data('fname'))
        $('#selectedSenderFname').val($(this).data('fname'))

        $('#inputSearchLname').val($(this).data('lname'))
        $('#selectedSenderLname').val($(this).data('lname'))

        $(this).closest('tr').addClass('selected');
    })

    $('#proceedTransac').click(function(){
        waitingDialog.show('Please Wait.', {dialogSize: 'sm', progressType: 'primary'});
    })

    $('#createBene').click(function(){
        var senderID;
        if($('#createBene').is(':visible')){
            senderID = rowid;
            $('#senderID').val(senderID)
            console.log(senderID)
        }
        if($('#tblSelectedSender').is(':visible')){
            senderID = $('#selectedSenderDetailsID').val()
            $('#senderID').val(senderID)
        }
        // alert(senderID)
        if(senderID){
            waitingDialog.show('Please Wait.', {dialogSize: 'sm', progressType: 'primary'});
            createBeneficiary(senderID)
        }else{
            swal({
                title: 'SELECT SENDER!',
                text: "Please select sender first.",
                icon: 'warning',
                buttons: false,
            })
        }

    })

    function createSender(){
        var i1, i2, i3, i4, i5, i6, i7, i8, i9, i10, 
            i11, i12, i13, i14, i15, i16, i17, i18, i19, i20, 
            i21, i22, i23, i24, i25, i26, i27, i28, i29, i30, 
            i31

        i1  = $('#addModalSender #inputFname').val()
        i2  = $('#addModalSender #inputMname').val()
        i3  = $('#addModalSender #inputLname').val()
        i4  = $('#addModalSender #inpuSuffix').val()
        i5  = $('#addModalSender #inputBdate').val()
        i6  = $('#addModalSender #inputBirthplace').val()
        i7  = $('#addModalSender #inputStreet').val()
        i11 = $('#addModalSender #inputPostal').val()
        i12 = $('#addModalSender #inputCountry').val()
        if(i12 == 'PHILIPPINES'){
            i8  = $('#addModalSender #selBarangay option:selected').text()
            i9  = $('#addModalSender #selCity option:selected').text()
            i10 = $('#addModalSender #selProvince option:selected').text() + ', ' + $('#addModalSender #selRegion option:selected').text()
        }else{
            i8  = $('#addModalSender #inputBarangay').val()
            i9  = $('#addModalSender #inputCity').val()
            i10 = $('#addModalSender #inputProvince').val()
        }

        i13 = $('#addModalSender #inputStreet2').val()
        i17 = $('#addModalSender #inputCountry2').val()
        if(i17 == 'PHILIPPINES'){
            i14 = $('#addModalSender #selBarangay2 option:selected').text()
            i15 = $('#addModalSender #selCity2 option:selected').text()
            i16 = $('#addModalSender #selProvince2 option:selected').text() + ', ' + $('#addModalSender #selRegion2 option:selected').text()
        }else{
            i14 = $('#addModalSender #inputBarangay2').val()
            i15 = $('#addModalSender #inputCity2').val()
            i16 = $('#addModalSender #inputProvince2').val()
        }
        i18 = $('#addModalSender #inputPostal2').val()
        i19 = $('#addModalSender #inputMobile').val()
        i20 = $('#addModalSender #inputEmail').val()
        i21 = $('#addModalSender #inputOccupation').val()
        i22 = $('#addModalSender #inputSourceoffund').val()
        i23 = $('#addModalSender #inputNationality').val()

        i24 = $('#addModalSender #newidtype').val()
        i25 = $('#addModalSender #newidnumber').val()
        i26 = $('#addModalSender #newexpirydate1').val()
        i27 = $('#addModalSender #file1').prop('files')[0]
        
        i28 = $('#addModalSender #newidtype2').val()
        i29 = $('#addModalSender #newidnumber2').val()
        i30 = $('#addModalSender #newexpirydate2').val()
        i31 = $('#addModalSender #file2').prop('files')[0]
        
        var formData = new FormData();
        
        formData.append('inputFname', i1)
        formData.append('inputMname', i2)
        formData.append('inputLname', i3)
        formData.append('inpuSuffix', i4)
        formData.append('inputBdate', i5)
        formData.append('inputBirthplace', i6)
        formData.append('inputStreet', i7)
        formData.append('inputBarangay', i8)
        formData.append('inputCity', i9)
        formData.append('inputProvince', i10)
        formData.append('inputPostal', i11)
        formData.append('inputCountry', i12)
        formData.append('inputStreet2', i13)
        formData.append('inputBarangay2', i14)
        formData.append('inputCity2', i15)
        formData.append('inputProvince2', i16)
        formData.append('inputCountry2', i17)
        formData.append('inputPostal2', i18)
        formData.append('inputMobile', i19)
        formData.append('inputEmail', i20)
        formData.append('inputOccupation', i21)
        formData.append('inputSourceoffund', i22)
        formData.append('inputNationality', i23)
        formData.append('newidtype', i24)
        formData.append('newidnumber', i25)
        formData.append('newexpirydate1', i26)
        formData.append('file1', i27)
        formData.append('newidtype2', i28)
        formData.append('newidnumber2', i29)
        formData.append('newexpirydate2', i30)
        formData.append('file2', i31)

        // for (var pair of formData.entries()) {
        //     console.log(pair[0]+ ', ' + pair[1]); 
        // }

        $.ajax({
            url         : '/Ecash_send/addSenderHub',
            type        : 'POST',
            data        : formData,
            processData : false,
            contentType : false,
            success     : function (data) {
                var jsonData = JSON.parse(data);
                // console.log(jsonData)
                if(jsonData.S == 1){
                    $('#addModalSender').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                                                
                    swal({
                        title: 'SUCCESS!',
                        text: 'Added new Sender',
                        icon: 'success',
                        buttons: false,
                    })
                }else{
                    swal({
                        title: 'Oopps..',
                        text: jsonData.M,
                        icon: 'warning',
                        buttons: false,
                    })
                }
                waitingDialog.hide()

            }
        })
    }

    function createBeneficiary(senderID){
        
        var formData = new FormData();

        formData.append('senderID', senderID);
        $.ajax({
            url         : '/Ecash_send/selected_sender',
            type        : 'POST',
            data        : formData,
            processData : false,
            contentType : false,
            success     : function (data) {
                var jsonData = JSON.parse(data);
                // console.log(jsonData.result[0])
                
                $('#senderFormData #fnameSender').val(jsonData.result[0].fname)
                $('#senderFormData #mnameSender').val(jsonData.result[0].mname)
                $('#senderFormData #lnameSender').val(jsonData.result[0].lname)
                $('#senderFormData #suffixSender').val(jsonData.result[0].suffix)
                $('#senderFormData #presentSender').val(jsonData.result[0].address+", "+jsonData.result[0].addressBrgy+", "+jsonData.result[0].addressCity+", "+jsonData.result[0].province+", "+jsonData.result[0].country+", "+jsonData.result[0].addressZip)
                $('#senderFormData #permanentSender').val(jsonData.result[0].permanentAddress)
                $('#senderFormData #emailSender').val(jsonData.result[0].emailAdd)
                $('#senderFormData #mobileSender').val(jsonData.result[0].mobile)
                $('#senderFormData #bdateSender').val(jsonData.result[0].birthDate)
                $('#senderFormData #birthplaceSender').val(jsonData.result[0].placeOfBirth)
                $('#senderFormData #occupationSender').val(jsonData.result[0].occupation)
                $('#senderFormData #sourceoffundSender').val(jsonData.result[0].sourceOfFund)
                $('#senderFormData #nationalitySender').val(jsonData.result[0].nationality)

                waitingDialog.hide()
                $('#senderFormData').show(200)
                $('#divSearchSender').hide()
            }
        })
    }

    $('#returnSearch').click(function(){
        $('#selectedSenderID').val("");
        $('#senderFormData').hide()
        $('#divSearchSender').show(200)
        $('#frmAddEcashPadalaBeneficiary').trigger("reset");

        $('#proceedTransac').hide();
        $('#inputSearchFname').val("")
        $('#inputSearchLname').val("")
        $('#transactBeneID').val("")
        $('#transactBeneFname').val("")
        $('#transactBeneLname').val("")
        $('#transactBeneBirthdate').val("")

        $('tr').removeClass('selected');
    })

    // ############################################# OTP ##########################################

    $('#resendOTP').click(function(){
        var traceNo = $('#traceno').val();
        // alert(traceNo)
        
        var formData = new FormData();

        formData.append('traceno', traceNo);

        waitingDialog.show('Please Wait.', {dialogSize: 'sm', progressType: 'primary'});
        $.ajax({
            url         : '/Ecash_send/sendOTP',
            type        : 'POST',
            data        : formData,
            processData : false,
            contentType : false,
            success     : function (data) { 
                var jsonData = JSON.parse(data);
                // console.log(jsonData)
                waitingDialog.hide()

                if(jsonData.S == 1){
                    swal({
                        title: 'SUCCESS',
                        text: "Resend OTP",
                        icon: 'success',
                        buttons: false,
                    })
                }else{
                    swal({
                        title: 'Oopps..',
                        text: "Something went wrong.",
                        icon: 'warning',
                        buttons: false,
                    })
                }

            }
        })
    })


    var timer2 = "5:01";
    var interval = setInterval(function() {
        var timer = timer2.split(':');
        var minutes = parseInt(timer[0], 10);
        var seconds = parseInt(timer[1], 10);

        --seconds;
        minutes = (seconds < 0) ? --minutes : minutes;
        seconds = (seconds < 0) ? 59 : seconds;
        seconds = (seconds < 10) ? '0' + seconds : seconds;

        //minutes = (minutes < 10) ?  minutes : minutes;
        $('#resendOTP').text("RESEND " + minutes + ':' + seconds);
        if ((seconds <= 0) && (minutes <= 0)){
            clearInterval(interval);
            $('#resendOTP').text("RESEND").removeAttr("disabled").attr({class:"btn btn-primary"});
        }
        timer2 = minutes + ':' + seconds;
    
    }, 1000);
    
    var action, file, otpCode, inputTpass,
        traceno, action, item_type, photolink, comment, commentOTP,
        refno;
    $('#submitOTP, #rejectOTP2').click(function(){
        var missingInputs = true;
        var riskLevel = $('#riskLevel').val()

        comment     = $('#denyComment').val()
        commentOTP  = $('#denyCommentOTP').val()
        action      = $(this).data("info");
        otpCode     = $("#frmOTP #otpCode").val()
        traceno     = $('#traceno').val()

        if(riskLevel == "HIGH"){
            file = $("#frmOTP #fileHigh1").prop('files')[0]
            if(action == "DENIED"){
                if(comment){
                    missingInputs = false;
                }
            }else{
                if(file && otpCode && commentOTP){
                    missingInputs = false;
                }
            }
        }else{
            if(action == "DENIED"){
                if(comment){
                    missingInputs = false;
                }
            }else{
                if(otpCode && commentOTP){
                    missingInputs = false;
                }
            }
        }
        
        if(missingInputs == false){
            
            waitingDialog.show('Please Wait.', {dialogSize: 'sm', progressType: 'primary'});

            if(action == "DENIED"){
                var formData = new FormData();

                formData.append('traceno', traceno);
                formData.append('action', action);
                formData.append('comment', comment);
                // formData.append('transpass', inputTpass);
                $.ajax({
                    url         : '/Ecash_send/rejectTransaction',
                    type        : 'POST',
                    data        : formData,
                    processData : false,
                    contentType : false,
                    success     : function (data) { 
                        var jsonData = JSON.parse(data);
                        if(jsonData.S == 1){
                            showReceipt();
                        }else{
                            waitingDialog.hide()

                            swal({
                                title: 'Oopps.',
                                text: jsonData.M,
                                icon: 'warning',
                                buttons: false,
                            })
                        }
                        
                    }
                })
            }

            if(action == "APPROVED"){
                var formData1 = new FormData();

                formData1.append('traceno', traceno);
                formData1.append('otp', otpCode);

                $.ajax({
                    url         : '/Ecash_send/validateOTP',
                    type        : 'POST',
                    data        : formData1,
                    processData : false,
                    contentType : false,
                    success     : function (data) { 
                        var jsonData = JSON.parse(data);
                        // console.log("ajax1", jsonData)

                        if(jsonData.S == 1){
                            photolink = file
                            var formData2 = new FormData();

                            formData2.append('traceno', traceno);
                            formData2.append('action', action);
                            formData2.append('comment', commentOTP);
                            formData2.append('risklevel', riskLevel);
                            if(riskLevel == "HIGH"){
                                item_type = "PHOTO"
                                formData2.append('item_type', item_type);
                                formData2.append('fileHigh1', photolink);
                            }
                            // for (var pair of formData2.entries()) {
                            //     console.log(pair[0]+ ', ' + pair[1]); 
                            // }
                            $.ajax({
                                url         : '/Ecash_send/confirmTransaction',
                                type        : 'POST',
                                data        : formData2,
                                processData : false,
                                contentType : false,
                                method      : 'POST',
                                type        : 'POST', // For jQuery < 1.9
                                success     : function (data) { 
                                    var jsonData = JSON.parse(data);
                                    // console.log("ajax2", jsonData)

                                    var formData3 = new FormData();

                                    formData3.append('traceno', traceno);
                                    // formData3.append('transpass', inputTpass);
                                    if(jsonData.S == 1){
                                        $.ajax({
                                            url         : '/ecash_send/credittobankTransacBSP',
                                            type        : 'POST',
                                            data        : formData3,
                                            processData : false,
                                            contentType : false,
                                            success     : function (data) { 
                                                var jsonData = JSON.parse(data);
                                                // console.log("ajax3", jsonData)
                                                if(jsonData.S == 1){
                                                    $('#receiptReferenceno').text(jsonData.TN)
                                                    $('#receiptLink').attr('href', 'https://mobilereports.globalpinoyremittance.com/portal/ecash_remittance/ecash_credit_bank_receipt/'+jsonData.TN)
                                                    $('#receiptBalance').text(jsonData.EC)
                                                    refno = jsonData.TN

                                                    showReceipt();
                                                    
                                                }else{
                                                    waitingDialog.hide()
                                                    swal({
                                                        title: 'Oopps...',
                                                        text: jsonData.M,
                                                        icon: 'warning',
                                                        buttons: false,
                                                    })
                                                }
                                            
                                            }
                                        })
                                    }else{
                                        waitingDialog.hide()
                                        swal({
                                            title: 'Oopps...',
                                            text: jsonData.M,
                                            icon: 'warning',
                                            buttons: false,
                                        })
                                    }

                                }

                            })
                        }else{
                            waitingDialog.hide()

                            swal({
                                title: 'Oopps.',
                                text: jsonData.M,
                                icon: 'warning',
                                buttons: false,
                            })
                        }
                        
                    }
                })
            }
        }else{
            swal({
                title: 'Blank fields detected!',
                text: "Please fill-in required fields.",
                icon: 'warning',
                buttons: false,
            })
        }
    })

    function showReceipt(){
        var formData = new FormData();

        formData.append('traceno', traceno);

        $.ajax({
            url         : '/Ecash_send/fetch_transactionDetails',
            type        : 'POST',
            data        : formData,
            processData : false,
            contentType : false,
            success     : function (data) { 
                var jsonData = JSON.parse(data);
                // console.log("showReceipt", jsonData)
                waitingDialog.hide()
                if(jsonData.S == 1){
                    jsonData.M.forEach(function(i){
                        if(action == "APPROVED"){
                            $('#receiptResult').text(action).attr('style', 'color:green');

                            var type = 'APPROVE';

                            var formData4 = new FormData();

                            formData4.append('traceno', traceno);
                            formData4.append('refno', refno);
                            formData4.append('type', type);
                            $.ajax({
                                url         : '/Ecash_send/notify_sender_receiver',
                                type        : 'POST',
                                data        : formData4,
                                processData : false,
                                contentType : false,
                                success     : function (data) {
                                    var jsonData = JSON.parse(data);
                                    // console.log("ajax4", jsonData)
                                    if(jsonData.S == 1){
                                        swal({
                                            title: 'TRANSACTION APPROVED',
                                            text: jsonData.M,
                                            icon: 'success',
                                            buttons: false,
                                        })
                                    }else{
                                        swal({
                                            title: 'Oopps.',
                                            text: jsonData.M +" Please Contact Support",
                                            icon: 'warning',
                                            buttons: false,
                                        })
                                    }
                                }
                                
                            })
                        }
                        if(action == "DENIED"){
                            $('#receiptResult').text(action).attr('style', 'color:red');
                            $('#divReceiptApproved').hide()
                                                    
                            $('#transactionRejectModal').modal('hide');
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();

                            
                            var type = 'DENY';
                            var formData = new FormData();

                            formData.append('traceno', traceno);
                            formData.append('type', type);
                            $.ajax({
                                url         : '/Ecash_send/notify_sender_receiver',
                                type        : 'POST',
                                data        : formData,
                                processData : false,
                                contentType : false,
                                success     : function (data) {
                                    var jsonData = JSON.parse(data);
                                    if(jsonData.S == 1){
                                        swal({
                                            title: 'TRANSACTION DENIED',
                                            text: jsonData.M,
                                            icon: 'success',
                                            buttons: false,
                                        })
                                    }else{
                                        swal({
                                            title: 'Oopps.',
                                            text: jsonData.M +" Please Contact Support",
                                            icon: 'warning',
                                            buttons: false,
                                        })
                                    }
                                    // console.log("ajax4", jsonData)
                                }
                            })
                        }
                        $('#receiptService').text('CREDIT TO BANK');

                        var  sFullname = i.sLname +', '+ i.sFname;

                        if(i.sSuffix != null)
                        {
                            sFullname += ' '+i.sSuffix;
                        }
                        if(i.sMname != null)
                        {
                            sFullname += ' '+i.sMname;
                        }
                        $('#receiptSenderFull').val(sFullname);
                        $('#receiptSenderEmail').val(i.sEmail);

                        var  rFullname = i.rLname +', '+ i.rFname;

                        if(i.rSuffix != null)
                        {
                            rFullname += ' '+i.rSuffix;
                        }
                        if(i.rMname != null)
                        {
                            rFullname += ' '+i.rMname;
                        }
                        $('#receiptBeneFull').val(rFullname);
                        $('#receiptBeneEmail').val(i.rEmail);

                        
                        $('#receiptRelation').val(i.relation);
                        $('#receiptPurpose').val(i.purpose);
                        $('#receiptAmount').val(i.principal);
                        $('#receiptAccountno').val(i.firstfield);
                        $('#receiptAccountname').val(i.secondfield);
                        $('#receiptCharge').val($('#charge').val());
                        $('#receiptServiceType').val($('#serviceType').val());

                        $('#receiptTraceno').text($('#traceno').val())
                        $('#divShowReceipt').show(200)
                        $('#divOTP').hide()
                    })
                }else{
                    swal({
                        title: 'Oopps..',
                        text: jsonData.M,
                        icon: 'warning',
                        buttons: false,
                    })
                }
                
            }
        })
    }
</script>

<script>

</script>
<script>
    $(function(){
        var dtToday = new Date();
        
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear() - 16;
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();
        
        var maxDate = year + '-' + month + '-' + day;

        $('#inputBdate').attr('max', maxDate);
        $('#inputBdateBene').attr('max', maxDate);
        $('#inputBdateDealer').attr('max', maxDate);
    });

    $(function(){
        var dtToday = new Date();
        
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();
        
        var minDate = year + '-' + month + '-' + day;
        $('#newexpirydate1').attr('min', minDate);
        $('#newexpirydate2').attr('min', minDate);
        $('#newexpirydate1Dealer').attr('min', minDate);
        $('#newexpirydate2Dealer').attr('min', minDate);
    });

    function isNumberKey(evt){ 
    //var e = evt || window.event;
	var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 32 && (charCode < 48 || charCode > 57))
      return false;
      return true;
	}

    function isLetterNumberKey(evt){
        var keyCode = (evt.which) ? evt.which : evt.keyCode
        if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 122) && keyCode > 32 && (keyCode < 48 || keyCode > 57))
         
        return false;
        return true;
    }

    var emailCheckerS, mobileCheckerS;
    $('#inputEmail').keyup(function(){
        var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        if(!testEmail.test($('#inputEmail').val())){
            $('#btnAddSenderBSP').prop('disabled', true)
            $('#amount_errEmailSender1').show()
            emailCheckerS = 0;
        }
        else{
            if(mobileCheckerS == 1){
                $('#btnAddSenderBSP').prop('disabled', false)
            }
            $('#amount_errEmailSender1').hide()
            emailCheckerS = 1;
        }
    })

    var emailCheckerB, mobileCheckerB;
    $('#inputEmailBene').keyup(function(){
        var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        if(!testEmail.test($('#inputEmailBene').val())){
            $('#btnAddDetailsBene').prop('disabled', true)
            $('#amount_errEmailSender').show()
            emailCheckerB = 0;
        }
        else{
            if(mobileCheckerB == 1){
                $('#btnAddDetailsBene').prop('disabled', false)
            }
            $('#amount_errEmailSender').hide()
            emailCheckerB = 1;
        }
    })

    function mobileNumValidateSender(){
        var numTest = /^[0][9]\d{9}$/gm;
        var numVal = $(this).val()
        if(numTest.test(numVal)){
            // console.log(numVal)
            if(emailCheckerS == 1){
                $('#btnAddSenderBSP').prop('disabled', false)
            }
            $('#amount_errMobileNum1').hide()
            //console.log('num matched')
            mobileCheckerS = 1;
        }
        else{
            // console.log(numVal)
            $('#btnAddSenderBSP').prop('disabled', true)
            $('#amount_errMobileNum1').show()
            // console.log('not matched')
            mobileCheckerS = 0;
        }
    }

    function mobileNumValidateBene(){
        var numTest = /^[0][9]\d{9}$/gm;
        var numVal = $(this).val()
        
        if(numTest.test(numVal)){
            // console.log(numVal)
            if(emailCheckerB == 1){
            $('#btnAddDetailsBene').prop('disabled', false)
            }
            $('#amount_errMobileNum').hide()
            //console.log('num matched')
            mobileCheckerB = 1;
        }
        else{
            // console.log(numVal)
            $('#btnAddDetailsBene').prop('disabled', true)
            $('#amount_errMobileNum').show()
            // console.log('not matched')
            mobileCheckerB = 0;
        }
    }

    $('#inputMobile').keyup(mobileNumValidateSender)
    $('#inputMobileBene').keyup(mobileNumValidateBene)

    $('#ammont_err').hide()
    $('#ammont_err2').hide()
    function amountValidate(){
        if($('#inputAmount').val() < 200 ){
            $('#btnModalTransaction').prop('disabled', true)
            $('#ammont_err').show()
            $('#ammont_err2').hide()
        }
        else if($('#inputAmount').val() > 40000){
            $('#btnModalTransaction').prop('disabled', true)
            $('#ammont_err').hide()
            $('#ammont_err2').show()
        }
        else{
            $('#btnModalTransaction').prop('disabled', false)
            $('#ammont_err').hide()
            $('#ammont_err2').hide()
        }
    }
</script>
<script>
     var tRelation, tPurpose, tCurrency, tAmount, tBank, tAccountNo, tAccountName, tCharge,
        idS, fullS, bdateS,
        idR, fullR, bdateR;

    $('#btnModalTransaction').click(function(){
        tRelation = $('#frmProceedEcashPadala #inputRelation').val();
        tPurpose  = $('#frmProceedEcashPadala #inputPurpose').val();
        tCurrency = $('#frmProceedEcashPadala #inputCurrency').val();
        tAmount   = $('#frmProceedEcashPadala #inputAmount').val();
        tBank     = $('#frmProceedEcashPadala #selBankID').val();
        tAccountNo= $('#frmProceedEcashPadala #inputAccountNo').val();
        tAccountName = $('#frmProceedEcashPadala #inputAccountName').val();

        idS     = $('#tdIdS').text();
        fullS   = $('#tdFullS').text();
        bdateS  = $('#tdBirthDateS').text();
        idR     = $('#tdIdR').text();
        fullR   = $('#tdFullR').text();
        bdateR  = $('#tdBirthDateR').text();

        if(tRelation && tPurpose && tCurrency && tAmount && tBank && tAccountNo && tAccountName){
            waitingDialog.show('Please Wait.', {dialogSize: 'sm', progressType: 'primary'});
            $('#tpass').val('');
            fetchRate();
        }else{
            swal({
                title: 'Blank fields detected!',
                text: "Please fill-in required fields.",
                icon: 'warning',
                buttons: false,
            });
        }
        
    })

    function fetchRate(){
        var formData = new FormData();
    
        formData.append('amount', tAmount)
        $.ajax({
            url         : '/Ecash_send/fetch_ecashcredittobank_rate',
            type        : 'POST',
            data        : formData,
            processData : false,
            contentType : false,
            success     : function (data) {
                var jsonData = JSON.parse(data);
                // console.log(jsonData)
                if(jsonData.S == 1){
                    tCharge = jsonData.C;
		            $("#remittanceSummaryModal").modal('show');
                    $('#senderid').val(idS);
                    $('#sender_name').val(fullS);
                    $('#sender_bdate').val(bdateS);

                    $('#beneid').val(idR);
                    $('#bene_name').val(fullR);
                    $('#bene_bdate').val(bdateR);

                    $('#irelation').val(tRelation);
                    $('#ipurpose').val(tPurpose);
                    $('#icurrency').val(tCurrency)
                    $('#iamount').val(parseFloat(tAmount).toFixed(2));
                    $('#iaccountno').val(tAccountNo)
                    $('#iaccountname').val(tAccountName)

                    
                    $('#hiddenInputAccountNo').val(tAccountNo)
                    $('#hiddenInputAccountName').val(tAccountName)
                    $('#hiddenInputServiceType').val(tAccountName)
                    $('#hiddenInputRelation').val(tRelation);
                    $('#hiddenInputPurpose').val(tPurpose);
                    $('#hiddenselBankID').val(tBank);
                    $('#hiddenInputAmount').val(tAmount);

                    $('#icharge').val(parseFloat(tCharge).toFixed(2));
                    $('#hiddenInputCharge').val(parseFloat(tCharge).toFixed(2));
                    $('#itotal').val((parseFloat(tAmount) + parseFloat(tCharge)).toFixed(2));
                }else{
                    swal({
                        title: 'Oopps..',
                        text: jsonData.M,
                        icon: 'warning',
                        buttons: false,
                    })
                }
                waitingDialog.hide()

            }
        })
    }

    $('#btnSubmitBSP').click(function(){
        var tpass = $('#tpass').val();
        if(tpass){
            waitingDialog.show('Please Wait.', {dialogSize: 'sm', progressType: 'primary'});
        }else{
            swal({
                title: 'Blank field detected!',
                text: "Please fill-in transactnion password.",
                icon: 'warning',
                buttons: false,
            });
        }

    })
</script>

<Script>
    $('#btnAddDetailsBene').click(function(){
        if($('#inputEmailBene').val() != " " && $('#inputMnameBene').val() != " " && $('#inputLnameBene').val() != " " 
        && $('#inpuSuffixBene').val() != " " && $('#inputCountryBene').val() != " " && $('#inputProvinceBene').val() != " " 
        && $('#inputCityBene').val()  != " " && $('#inputBarangayBene').val() != " " && $('#inputStreetBene').val() != " " 
        && $('#inputPostalBene').val()  != " " && $('#inputMobileBene').val()  != " "
        && $('#inputBdateBene').val()  != " "){
            waitingDialog.show('Please Wait.', {dialogSize: 'sm', progressType: 'primary'});
            
        }
    })
</Script>
<script>
    //limit decimal places by 2 (for input amount)
    var validate = function(e) {
        var t = e.value;
        e.value = (t.indexOf(".") >= 0) ? (t.substr(0, t.indexOf(".")) + t.substr(t.indexOf("."), 3)) : t;
    }
</script>