<style>
    .hover {
        background-color: #ADD8E6;
    }

    tr td:last-child {
        width: 1%;
        white-space: nowrap;
    }
    tr td {
        vertical-align: middle !important;
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
    .tab-content {
        padding:10px;
        border-left:1px solid #DDD;
        border-bottom:1px solid #DDD;
        border-right:1px solid #DDD;
    }
    
    .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus {
        background: #F5F5F5 !important;
        color: #000000 !important;
        box-shadow: inset 0 0 0 0 rgb(0 0 0 / 40%), -2px -3px 5px -2px rgb(0 0 0 / 40%) !important;
        font-weight: bold !important;
        font-size: unset !important;
        text-transform: uppercase !important;
    }
    .nav-tabs>li.active>a:hover {
        color: #000000 !important;
        background-color: #F5F5F5 !important;
        border: 0;
        border-bottom-color: 0;
        font-size: unset !important;
        font-weight: bold !important;
    }
    .nav-tabs>li>a:hover {
        color: #0275d8 !important;
        background-color: #F5F5F5 !important;
        border: 0;
        border-bottom-color: 0;
        font-size: unset !important;
        font-weight: bold !important;
    }
    .nav-tabs>li>a {
        color: #0275d8 !important;
        background-color: #F5F5F5 !important;
        border: 0;
        border-bottom-color: 0;
        font-size: unset !important;
        font-weight: unset !important;
    }
    .row-stat{
        margin-right: unset !important;
        margin-left: unset !important;
    }
</style>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
                <h4>E-Cash Transactions</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
    <div class="contentpanel">
        <input id="selTraceno" hidden />
        <?php if($DEALER['M'] == "DEALER"): ?>
            <input id="isDealer" hidden value=<?php echo $DEALER['M'];?> />
        <?php endif ?>
        <div id="divHeader">
            <h4><span id="headerResult">PENDING</span> Transactions : </h4>
            <ul class="nav nav-tabs">
                <li id="tabPending" class="active"><a id="aPENDING" data-id="PENDING" data-toggle="tab" href="#pending">PENDING</a></li>
                <li id="tabApproved"><a id="aAPPROVED" data-id="APPROVED" data-toggle="tab" href="#approved">APPROVED</a></li>
                <li id="tabRevoked"><a id="aDENIED" data-id="DENIED" data-toggle="tab" href="#denied">DENIED</a></li>
            </ul>
        </div>
        <!-- PENDING TRANSACTION TABLE -->
        <div class="row row-stat" id="divPendingList">
            <div class="form-group">
                <table id="tblPENDING" class="table table-bordered" cellspacing="0" style="width:100%;">
                    <tbody>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Trace Number</th>
                            <th>Sender</th>
                            <th>Beneficary</th>
                            <th>Relation</th>
                            <th>Purpose</th>
                            <th>Amount</th>
                            <th>Risk</th>
                            <th>Service</th>
                            <?php if($DEALER['M'] != "DEALER"): ?>
                                <th style="text-align: center;">Action</th>
                            <?php endif ?>
                        </tr>
                        </thead>
                    </tbody>
                </table>
            </div>
        </div><!-- PENDING TRANSACTION TABLE -->

        <!-- APPROVED TRANSACTION TABLE -->
        <div class="row row-stat" id="divApprovedList" hidden>
            <div class="form-group">
                <table id="tblAPPROVED" class="table table-bordered" cellspacing="0" style="width:100%;">
                    <tbody>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Reference Number</th>
                            <th>Trace Number</th>
                            <th>Sender</th>
                            <th>Beneficary</th>
                            <th>Relation</th>
                            <th>Purpose</th>
                            <th>Amount</th>
                            <th>Risk</th>
                            <th>Service</th>
                        </tr>
                        </thead>
                    </tbody>
                </table>
            </div>
        </div><!-- APPROVED TRANSACTION TABLE -->

        <!-- APPROVED TRANSACTION TABLE -->
        <div class="row row-stat" id="divDeniedList" hidden>
            <div class="form-group">
                <table id="tblDENIED" class="table table-bordered" cellspacing="0" style="width:100%;">
                    <tbody>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Trace Number</th>
                            <th>Sender</th>
                            <th>Beneficary</th>
                            <th>Relation</th>
                            <th>Purpose</th>
                            <th>Amount</th>
                            <th>Risk</th>
                            <th>Service</th>
                        </tr>
                        </thead>
                    </tbody>
                </table>
            </div>
        </div><!-- APPROVED TRANSACTION TABLE -->

        <!-- OTP FORM -->
        <div hidden id="divOTP">
            <input hidden name="traceno" id="traceno" value="<?php echo $transactStatus['TN'] ?>"/>
            <button id="returnToPending" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Pending Transactions</button>
            
            <form method="post" id="frmOTP" enctype="multipart/form-data">
                <div class="row" style="padding-top: 25px;">
                    <div class="col-md-12">
                    <div class="col-md-2"></div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <div id="otpSent"></div>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="col-md-12"style="padding-top: 15px;">
                        <div class="col-md-2"></div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <div><b>Trace No: <span id="traceNo"></span> | Risk: <span id="riskLevel"></span> | Hits: <span id="hits"></span></b></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-2"></div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <div><b>SENDER: <span id="senderName"></span></b></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-2"></div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <div><b>RECEIVER: <span id="receiverName"></span></b></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="padding-top: 20px;">
                        <div class="col-md-2"></div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <div><b>RISK REASON: </b></div>
                                <div id="divRiskreason">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-2"></div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <div><b><span id="otpMessage"></span></b></div>
                            </div>
                        </div>
                    </div>

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

                    <div hidden id="divFileHigh">
                        <div class="col-md-12">
                            <div class="col-md-3"></div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"  style="">ID PICTURE:</span>
                                        <input type="file" class="form-control" id="file1" name="file1" title="No File Found"  accept="image/*" onchange="ValidateSingleInput(this);" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                    </div>
                    

                    <div class="col-md-12" style="padding-top: 30px;">
                        <div class="col-md-3"></div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="denyCommentOTP" id="denyCommentOTP" class="form-control" placeholder="COMMENT"/>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                    </div>

                    <div class="col-md-12" style="padding-top: 30px;">
                        <div class="col-md-3"></div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" name="submitOTP" id="submitOTP" data-info="APPROVED">SUBMIT</button>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <button type="button" class="btn btn-danger" name="rejectOTP" id="rejectOTP" data-info="DENIED" data-toggle="modal" data-target="#transactionRejectModal2">REJECT</button>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                            <a href="<?php echo BASE_URL() ?>Ecash_transactions/" class="btn btn-default" id="returnOTP">APPROVE LATER</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- OTP FORM -->
        
        <!-- RECEIPT FORM -->
        <div class="row" id="divShowReceipt" hidden>
            
            <div class="col-md-2" style="margin-top: 25px;">
                <div class="form-group">
                <a href="<?php echo BASE_URL() ?>ecash_transactions/" class="btn btn-primary" id="returnSearchStep1"><span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Pending Transactions</a>
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

                    <div id="divSFS">
                        <div class="col-md-4" style="padding-top: 20px;">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">SERVICE TYPE</span>
                                    <input type="text" class="form-control" name="receiptServiceType" id="receiptServiceType" value="" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding-top: 20px;">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">FIRST DETAIL</span>
                                    <input type="text" class="form-control" name="receiptFirstField" id="receiptFirstField" value="" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding-top: 20px;">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">SECOND DETAIL</span>
                                    <input type="text" class="form-control" name="receiptSecondField" id="receiptSecondField" value="" disabled />
                                </div>
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
        <div><!-- RECEIPT FORM -->

    </div><!-- CONTENT PANEL -->
</div>

<!-- MODAL APPROVE TRANSACTION -->
<div class="modal mt-5" id="transactionApproveModal" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">  
            <div class="modal-header">
                <button type="button" id="closeModal" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <div class="col flex-center mt-3" style="margin-left: 25px;">
                <h1>ARE YOU <span style="color:#FFB800">SURE?</span></h1>
                <h4 class="txt-center mt-2">You want to <span style="color:green;">APPROVE</span> transaction <span style="text-decoration: underline;" id="approveTrackno"></span> ?</h4>
                </div>
            </div>

            <div class="col flex-center mb-3" id="confirmDiv" style="padding-top: 30px;">
                <button class="btnApprove" id="btnConfirm" style="height:56px; width:322px; background-color:#FFC914; font-size:20px; font-weight:600; color:white;" data-id="">CONFIRM</button>
            </div>
            
        </div>
    </div>
</div>
<!-- END OF MODAL APPROVE TRANSACTION -->

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
                    <h4 class="txt-center mt-2">You want to <span style="color:red;">REJECT</span> transaction <span style="text-decoration: underline;" id="denyTrackno"></span> ?</h4>
                </div>
                <div class="col flex-center" style="padding-top: 30px;">
                    <input class="field-view row" style="height: 52px; width: 365px; " placeholder="COMMENT" id="denyComment"/>
                </div>
            </div>

            <div id="divConfirmDeny">
                <div class="col flex-center mb-3" id="confirmDiv" style="padding-top: 30px;">
                    <button class="btnApprove" id="btnConfirm" style="height:56px; width:322px; background-color:#FFC914; font-size:20px; font-weight:600; color:white;" data-id="">CONFIRM</button>
                </div>
            </div>
            
        </div>
    </div>
</div>
<!-- END OF MODAL DENY TRANSACTION -->

<!-- MODAL DENY 2 TRANSACTION -->
<div class="modal mt-5" id="transactionRejectModal2" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">  
            <div class="modal-header">
                <button type="button" id="closeModal" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <div class="col flex-center mt-3" style="margin-left: 25px;">
                    <h1>ARE YOU <span style="color:#FFB800">SURE?</span></h1>
                    <h4 class="txt-center mt-2">You want to <span style="color:red;">REJECT</span> transaction <span style="text-decoration: underline;" id="denyTrackno"></span> ?</h4>
                </div>
                <div class="col flex-center" style="padding-top: 30px;">
                    <input class="field-view row" style="height: 52px; width: 365px; " placeholder="COMMENT" id="denyComment"/>
                </div>
            </div>

            <div id="divConfirmDeny2">
                <div class="col flex-center mb-3" id="confirmDiv" style="padding-top: 30px;">
                    <button class="btnApprove" id="btnConfirm" data-info="DENIED" style="height:56px; width:322px; background-color:#FFC914; font-size:20px; font-weight:600; color:white;" data-id="">CONFIRM</button>
                </div>
            </div>
            
        </div>
    </div>
</div>
<!-- END OF MODAL DENY 2 TRANSACTION -->

<script>
    var id, riskLevel, inputTpass, traceno, 
        action, item_type, photolink, otpCode, service,
        refno, comment, commentOTP,
        selTab,
        dealer;

    $(document).ready(function () {
        if($('#tblPENDING tr').length == 1){
            var status = 'PENDING'
            selTab = 'PENDING'
            dealer = $('#isDealer').val();
            $('#aPENDING').attr('style', 'color:#5bc0de !important')

            waitingDialog.show('Please Wait.', {dialogSize: 'sm', progressType: 'primary'});
            fetchTransaction(status)
        }

        function fetchTransaction(status){
            var actionID = 'fetch'+status
            $.ajax({
                url         : '/Ecash_transactions/'+actionID,
                type        : 'POST',
                processData : false,
                contentType : false,
                success     : function (data) { 
                    var jsonData = JSON.parse(data);
                    // console.log(jsonData)

                    if(jsonData.S == 1){
                        $('#headerResult').text(status)
                            if(status == "PENDING"){
                                if(dealer == "DEALER"){
                                    $(`#tbl${status}`).DataTable({
                                        data: jsonData.M,
                                        order: [[0, 'desc']],
                                        columns: [
                                            // jsonData.M.forEach(function(i){
                                            { data: 'rowid' },
                                            { data: 'traceno' },
                                            { data: null,
                                                render: function ( data, type, row ) {
                                                    fullSender = data.sLname
                                                    fullSender += ", "
                                                    fullSender += data.sFname
                                                    if(data.sSuffix){
                                                        fullSender += " "
                                                        fullSender +=  data.sSuffix
                                                    }
                                                    if(data.sMname){
                                                        fullSender += " "
                                                        fullSender += data.sMname
                                                    }

                                                    return fullSender
                                                }
                                            },
                                            { data: null,
                                                render: function ( data, type, row ) {
                                                    fullReceiver = data.rLname;
                                                    fullReceiver += ", "
                                                    fullReceiver += data.rFname;
                                                    if(data.rSuffix){
                                                            fullReceiver += " "
                                                        fullReceiver += data.rSuffix;
                                                    }
                                                    if(data.rMname){
                                                            fullReceiver += " "
                                                        fullReceiver += data.rMname;
                                                    }

                                                    return fullReceiver
                                                } 
                                            },
                                            { data: 'relation' },
                                            { data: 'purpose' },
                                            { data: null,
                                                render: function ( data, type, row ) {
                                                    total = parseInt(data.principal) + parseInt(data.charge);
                                                    return total.toFixed(2);
                                                } 
                                            },
                                            { data: 'riskprofile' },
                                            { data: null,
                                                render: function ( data, type, row ) {
                                                    if(data.service == 'ECASHPADALA'){
                                                        service = 'E-CASH PADALA';
                                                    }else if(data.service == 'CREDITTOBANK'){
                                                        service = 'CREDIT TO BANK';
                                                    }else if(data.service == 'ECCASH'){
                                                        service = 'WALLET TOP-UP';
                                                    }else if(data.service == 'ECASHTOCEBUANA'){
                                                        service = 'E-CASH TO CEBUANA';
                                                    }
                                                    return service;
                                                }
                                            },
                                        ],
                                        "bDestroy": true
                                    });
                                }else{
                                    $(`#tbl${status}`).DataTable({
                                        data: jsonData.M,
                                        order: [[0, 'desc']],
                                        columns: [
                                            // jsonData.M.forEach(function(i){
                                            { data: 'rowid' },
                                            { data: 'traceno' },
                                            { data: null,
                                                render: function ( data, type, row ) {
                                                    fullSender = data.sLname
                                                    fullSender += ", "
                                                    fullSender += data.sFname
                                                    if(data.sSuffix){
                                                        fullSender += " "
                                                        fullSender +=  data.sSuffix
                                                    }
                                                    if(data.sMname){
                                                        fullSender += " "
                                                        fullSender += data.sMname
                                                    }

                                                    return fullSender
                                                }
                                            },
                                            { data: null,
                                                render: function ( data, type, row ) {
                                                    fullReceiver = data.rLname;
                                                    fullReceiver += ", "
                                                    fullReceiver += data.rFname;
                                                    if(data.rSuffix){
                                                            fullReceiver += " "
                                                        fullReceiver += data.rSuffix;
                                                    }
                                                    if(data.rMname){
                                                            fullReceiver += " "
                                                        fullReceiver += data.rMname;
                                                    }

                                                    return fullReceiver
                                                } 
                                            },
                                            { data: 'relation' },
                                            { data: 'purpose' },
                                            { data: null,
                                                render: function ( data, type, row ) {
                                                    total = parseInt(data.principal) + parseInt(data.charge);
                                                    return total.toFixed(2);
                                                } 
                                            },
                                            { data: 'riskprofile' },
                                            { data: null,
                                                render: function ( data, type, row ) {
                                                    if(data.service == 'ECASHPADALA'){
                                                        service = 'E-CASH PADALA';
                                                    }else if(data.service == 'CREDITTOBANK'){
                                                        service = 'CREDIT TO BANK';
                                                    }else if(data.service == 'ECCASH'){
                                                        service = 'WALLET TOP-UP';
                                                    }else if(data.service == 'ECASHTOCEBUANA'){
                                                        service = 'E-CASH TO CEBUANA';
                                                    }
                                                    return service;
                                                }
                                            },
                                            { data: null,
                                                render: function ( data, type, row ) {
                                                    return `<button type='button' class='btn btn-success' id='btnApprove' data-id='${data.traceno}' data-risk='${data.riskprofile}' data-service='${data.service}' data-toggle='modal' data-target='#transactionApproveModal'>APPROVE</button> <button type='button' class='btn btn-danger' id='btnReject' data-id='${data.traceno}' data-risk='${data.riskprofile}' data-service='${data.service}' data-toggle='modal' data-target='#transactionRejectModal'>REJECT</button>`
                                                } 
                                            },  
                                        ],
                                        "bDestroy": true
                                    });
                                }
                                $('#divPendingList').show()
                                $('#divApprovedList').hide()
                                $('#divDeniedList').hide()
                            }else if(status == "APPROVED"){
                                $(`#tbl${status}`).DataTable({
                                    data: jsonData.M,
                                    order: [[0, 'desc']],
                                    columns: [
                                        // jsonData.M.forEach(function(i){
                                        { data: 'rowid' },
                                        { data:  null,
                                            render: function ( data, type, row ) {
                                                if(data.trackno == null){
                                                    data.trackno = ""
                                                }
                                                if(data.service == "ECASHPADALA"){
                                                    receiptLink = `<a href="https://mobilereports.globalpinoyremittance.com/portal/amla_transaction/${data.trackno}" target="_blank">${data.trackno}</a>`
                                                }else if(data.service == "CREDITTOBANK"){
                                                    receiptLink = `<a href="https://mobilereports.globalpinoyremittance.com/portal/ecash_remittance/ecash_credit_bank_receipt/${data.trackno}" target="_blank">${data.trackno}</a>`
                                                }else if(data.service == "ECCASH"){
                                                    receiptLink = `<a href="https://mobilereports.globalpinoyremittance.com/portal/ecpay_fund_transfer/${data.trackno}" target="_blank">${data.trackno}</a>`
                                                }else if(data.service == "ECASHTOCEBUANA"){
                                                    receiptLink = `<a href="https://mobilereports.globalpinoyremittance.com/portal/cebuana_remittance/domestic_sending_receipt/${data.trackno}" target="_blank">${data.trackno}</a>`
                                                }
                                                return receiptLink
                                            } 
                                        },
                                        { data: 'traceno' },
                                        { data: null,
                                            render: function ( data, type, row ) {
                                                fullSender = data.sLname
                                                fullSender += ", "
                                                fullSender += data.sFname
                                                if(data.sSuffix){
                                                    fullSender += " "
                                                    fullSender +=  data.sSuffix
                                                }
                                                if(data.sMname){
                                                    fullSender += " "
                                                    fullSender += data.sMname
                                                }

                                                return fullSender
                                            }
                                        },
                                        { data: null,
                                            render: function ( data, type, row ) {
                                                fullReceiver = data.rLname;
                                                fullReceiver += ", "
                                                fullReceiver += data.rFname;
                                                if(data.rSuffix){
                                                        fullReceiver += " "
                                                    fullReceiver += data.rSuffix;
                                                }
                                                if(data.rMname){
                                                        fullReceiver += " "
                                                    fullReceiver += data.rMname;
                                                }

                                                return fullReceiver
                                            } 
                                        },
                                        { data: 'relation' },
                                        { data: 'purpose' },
                                        { data: null,
                                            render: function ( data, type, row ) {
                                                total = parseInt(data.principal) + parseInt(data.charge);
                                                return total.toFixed(2);
                                            } 
                                        },
                                        { data: 'riskprofile' },
                                        { data: null,
                                            render: function ( data, type, row ) {
                                                if(data.service == 'ECASHPADALA'){
                                                    service = 'E-CASH PADALA';
                                                }else if(data.service == 'CREDITTOBANK'){
                                                    service = 'CREDIT TO BANK';
                                                }else if(data.service == 'ECCASH'){
                                                    service = 'WALLET TOP-UP';
                                                }else if(data.service == 'ECASHTOCEBUANA'){
                                                    service = 'E-CASH TO CEBUANA';
                                                }
                                                return service;
                                            }
                                        },
                                    ],
                                    "bDestroy": true
                                });
                                $('#divPendingList').hide()
                                $('#divApprovedList').show()
                                $('#divDeniedList').hide()
                            }else if(status == "DENIED"){
                                $(`#tbl${status}`).DataTable({
                                    data: jsonData.M,
                                    order: [[0, 'desc']],
                                    columns: [
                                        // jsonData.M.forEach(function(i){
                                        { data: 'rowid' },
                                        { data: 'traceno' },
                                        { data: null,
                                            render: function ( data, type, row ) {
                                                fullSender = data.sLname
                                                fullSender += ", "
                                                fullSender += data.sFname
                                                if(data.sSuffix){
                                                    fullSender += " "
                                                    fullSender +=  data.sSuffix
                                                }
                                                if(data.sMname){
                                                    fullSender += " "
                                                    fullSender += data.sMname
                                                }

                                                return fullSender
                                            }
                                        },
                                        { data: null,
                                            render: function ( data, type, row ) {
                                                fullReceiver = data.rLname;
                                                fullReceiver += ", "
                                                fullReceiver += data.rFname;
                                                if(data.rSuffix){
                                                        fullReceiver += " "
                                                    fullReceiver += data.rSuffix;
                                                }
                                                if(data.rMname){
                                                        fullReceiver += " "
                                                    fullReceiver += data.rMname;
                                                }

                                                return fullReceiver
                                            } 
                                        },
                                        { data: 'relation' },
                                        { data: 'purpose' },
                                        { data: null,
                                            render: function ( data, type, row ) {
                                                total = parseInt(data.principal) + parseInt(data.charge);
                                                return total.toFixed(2);
                                            } 
                                        },
                                        { data: 'riskprofile' },
                                        { data: 'service' },
                                    ],
                                    "bDestroy": true
                                });
                                $('#divPendingList').hide()
                                $('#divApprovedList').hide()
                                $('#divDeniedList').show()
                            }
                            
                        hoverTD()
                        triggers()
                        waitingDialog.hide()
                    }else{
                        if(status == "PENDING"){
                            $('#divPendingList').show()
                            $('#divApprovedList').hide()
                            $('#divDeniedList').hide()
                        }else if(status == "APPROVED"){
                            $('#divPendingList').hide()
                            $('#divApprovedList').show()
                            $('#divDeniedList').hide()
                        }else if(status == "DENIED"){
                            $('#divPendingList').hide()
                            $('#divApprovedList').hide()
                            $('#divDeniedList').show()
                        }
                        $(`#tbl${status}`).DataTable({
                            "bDestroy": true
                        }).clear();
                        waitingDialog.hide()
                    }
                }
            })
            
        }
        
        $('a[data-toggle="tab"]').click(function(e) {
            var activeTab = $(this).data("id")
            if(activeTab == "PENDING"){
                $('#aPENDING').attr('style', 'color:#5bc0de !important')
                $('#aAPPROVED').attr('style', 'color:#0275d8 !important')
                $('#aDENIED').attr('style', 'color:#0275d8 !important')
            }
            if(activeTab == "APPROVED"){
                $('#aPENDING').attr('style', 'color:#0275d8 !important')
                $('#aAPPROVED').attr('style', 'color:green !important')
                $('#aDENIED').attr('style', 'color:#0275d8 !important')
            }
            if(activeTab == "DENIED"){
                $('#aPENDING').attr('style', 'color: #0275d8!important')
                $('#aAPPROVED').attr('style', 'color:#0275d8 !important')
                $('#aDENIED').attr('style', 'color:red !important')
            }

            if(activeTab != selTab) {
                waitingDialog.show('Please Wait.', {dialogSize: 'sm', progressType: 'primary'});
                fetchTransaction(activeTab)
            }
            selTab = $(this).data("id")
        });

        function hoverTD(){
            setTimeout( function(){
                $('#tblPENDING > tbody > tr').hover(function() {
                    $(this).addClass('hover');
                }, function() {
                    $(this).removeClass('hover');
                });
            }, 250 );
        }

        function triggers(){
            setTimeout( function(){
                $(document).on('click', '#tblPENDING #btnApprove', function(){
                    id = $(this).data('id');
                    service = $(this).data('service');
                    riskLevel = $(this).data('risk');
                    $('#selTraceno').val(id)

                    $('#approveTrackno').text(id)
                    action = "APPROVED"
                    $('#rejectOTP').attr('data-id',id)
                    $('#rejectOTP').attr('data-risk',riskLevel)
                })
                
                $(document).on('click', '#transactionApproveModal #btnConfirm', function(){
                    $('#transactionApproveModal').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    
                    waitingDialog.show('Please Wait.', {dialogSize: 'sm', progressType: 'primary'});
                    fetchTransacDetails()
                })
                
                $(document).on('click', '#tblPENDING #btnReject', function(){
                    id = $(this).data('id');
                    $('#selTraceno').val(id)

                    $('#transactionRejectModal #denyTrackno').text(id)
                    action = "DENIED"
                })

                $(document).on('click', '#rejectOTP', function(){
                    id = $(this).data('id');
                    $('#selTraceno').val(id)

                    $('#transactionRejectModal2 #denyTrackno').text(id)
                    action = "DENIED"
                    // alert(action)
                })
                
                $(document).on('click', '#transactionRejectModal #btnConfirm', function(){
                    comment = $('#transactionRejectModal #denyComment').val()
                    if(comment){
                        transac()
                        waitingDialog.show('Please Wait.', {dialogSize: 'sm', progressType: 'primary'});
                    }else{
                        swal({
                            title: 'Blank fields detected!',
                            text: "Please fill-in required fields.",
                            icon: 'warning',
                            buttons: false,
                        })
                    }
                })

                $(document).on('click', '#transactionRejectModal2 #btnConfirm', function(){
                    comment = $('#transactionRejectModal2 #denyComment').val()
                    if(comment){
                        transac()
                        waitingDialog.show('Please Wait.', {dialogSize: 'sm', progressType: 'primary'});
                    }else{
                        swal({
                            title: 'Blank fields detected!',
                            text: "Please fill-in required fields.",
                            icon: 'warning',
                            buttons: false,
                        })
                    }
                })

                $(document).on('click', '#resendOTP', function(){
                    traceno = $('#selTraceno').val()
                    // alert(traceno)
                    
                    var formData = new FormData();

                    formData.append('traceno', traceno);

                    waitingDialog.show('Please Wait.', {dialogSize: 'sm', progressType: 'primary'});
                    $.ajax({
                        url         : '/Ecash_transactions/sendOTP',
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
                                    text: jsonData.M,
                                    icon: 'warning',
                                    buttons: false,
                                })
                            }

                        }
                    })
                })

                $(document).on('click', '#submitOTP', function(){
                    var missingInputs = true;

                    action = $(this).data("info");
                    commentOTP = $("#frmOTP #denyCommentOTP").val()
                    // alert(action);
                    
                    photolink   = $("#frmOTP #file1").prop('files')[0]
                    otpCode     = $("#frmOTP #otpCode").val()
                    // inputTpass  = $("#frmOTP #inputTpass").val()
                    
                    traceno = $('#selTraceno').val()

                    if($("#frmOTP #file1").is(':visible') && riskLevel == "HIGH"){
                        if(action == "DENIED"){
                            // if(inputTpass){
                                missingInputs = false;
                            // }
                            // alert('else DENIED 1')
                        }else{
                            if(photolink && otpCode && commentOTP){
                                missingInputs = false;
                            }
                            // alert('else APPROVED 1')
                        }
                    }else{
                        if(action == "DENIED"){
                            // if(inputTpass){
                                missingInputs = false;
                            // }
                            // alert('else DENIED 2')
                        }else{
                            if(otpCode && commentOTP){
                                missingInputs = false;
                            }
                            // alert('else APPROVED 2')
                        }
                    }
                    
                    if(missingInputs == false){
                        var formData1 = new FormData();

                        formData1.append('traceno', traceno);
                        formData1.append('otp', otpCode);

                        waitingDialog.show('Please Wait.', {dialogSize: 'sm', progressType: 'primary'});
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
                                    transac()
                                }else{
                                    waitingDialog.hide()
                                    swal({
                                        title: 'Oopps..',
                                        text: jsonData.M,
                                        icon: 'warning',
                                        buttons: false,
                                    })
                                }
                            }
                        })
                        
                    }else{
                        swal({
                            title: 'Blank fields detected!',
                            text: "Please fill-in required fields.",
                            icon: 'warning',
                            buttons: false,
                        })
                    }
                })

                $(document).on('click', '#returnToPending', function(){
                    $('#divPendingList').show(200);
                    
                    $('#divHeader').show(200)
                    $('#divOTP').hide()
                    $('#resendOTP').text("RESEND").attr({class:"btn btn-default", disabled:"true"});
                    $('#divRiskreason').text('')
                })

                function fetchTransacDetails(){
                    traceno = $('#selTraceno').val()

                    var formData = new FormData();

                    formData.append('traceno', traceno);

                    $.ajax({
                        url         : '/Ecash_transactions/fetch_transactionDetails',
                        type        : 'POST',
                        data        : formData,
                        processData : false,
                        contentType : false,
                        success     : function (data) { 
                            var jsonData = JSON.parse(data);
                            // console.log("fetchTransacDetails", jsonData)
                            
                            if(jsonData.S == 1){
                                jsonData.M.forEach(function(i){
                                    $('#traceNo').text(traceno)
                                    $('#riskLevel').text(i.riskprofile)

                                    var  sFullname = i.sLname +', '+ i.sFname;

                                    if(i.sSuffix != null)
                                    {
                                        sFullname += ' '+i.sSuffix;
                                    }
                                    if(i.sMname != null)
                                    {
                                        sFullname += ' '+i.sMname;
                                    }
                                    $('#senderName').text(sFullname)

                                    var  rFullname = i.rLname +', '+ i.rFname;

                                    if(i.rSuffix != null)
                                    {
                                        rFullname += ' '+i.rSuffix;
                                    }
                                    if(i.rMname != null)
                                    {
                                        rFullname += ' '+i.rMname;
                                    }
                                    $('#receiverName').text(rFullname)
                                })
                                
                                $.ajax({
                                    url         : '/Ecash_transactions/riskProfiling',
                                    type        : 'POST',
                                    data        : formData,
                                    processData : false,
                                    contentType : false,
                                    success     : function (data) { 
                                        var jsonData = JSON.parse(data);
                                        // console.log("riskProfiling", jsonData)

                                        if(riskLevel == "HIGH"){
                                            $('#divFileHigh').show();
                                        }
                                        $('#divPendingList').hide();

                                        $('#hits').text(jsonData.M.length)
                                        $('#divRiskreason').append('')
                                        jsonData.M.forEach(function(i){
                                            if(i.description == i.details){
                                                $('#divRiskreason').append(`
                                                    <b>- <span>${i.description}</span></b><br/>
                                                `)
                                            }else{
                                                $('#divRiskreason').append(`
                                                    <b>- <span>${i.description} ${i.details}</span></b><br/>
                                                `)
                                            }
                                        
                                        })

                                        $.ajax({
                                            url         : '/Ecash_transactions/sendOTP',
                                            type        : 'POST',
                                            data        : formData,
                                            processData : false,
                                            contentType : false,
                                            success     : function (data) { 
                                                var jsonData = JSON.parse(data);
                                                // console.log("sendOTP", jsonData)

                                                if(jsonData.S == 1){
                                                    $('#otpSent').text(jsonData.M)
                                                    
                                                    $('#divOTP').show(200)
                                                    $('#divHeader').hide()

                                                    otpTimer();
                                                }else{
                                                    swal({
                                                        title: 'Oopps..',
                                                        text: jsonData.M,
                                                        icon: 'warning',
                                                        buttons: false,
                                                    })
                                                    $('#divPendingList').show();
                                                }
                                                waitingDialog.hide()
                                                
                                            }
                                        })
                                        
                                    }
                                })
                                
                            }else{
                                waitingDialog.hide()
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

                function transac(){
                    traceno = $('#selTraceno').val()
                    
                    var formData = new FormData();

                    // formData.append('transpass', inputTpass);
                    formData.append('traceno', traceno);
                    formData.append('action', action);
                    formData.append('risklevel', riskLevel);
                    formData.append('comment', commentOTP);
                    if(action == "DENIED"){
                        formData.append('comment', comment);
                    }
                    if(riskLevel == "HIGH"){
                        item_type = "PHOTO"
                        formData.append('item_type', item_type);
                        formData.append('file1', photolink);
                    }
                    // for (var pair of formData.entries()) {
                    //     console.log(pair[0]+ ', ' + pair[1]); 
                    // }

                    $.ajax({
                        url         : '/Ecash_transactions/confirmTransaction',
                        type        : 'POST',
                        data        : formData,
                        processData : false,
                        contentType : false,
                        method      : 'POST',
                        type        : 'POST', // For jQuery < 1.9
                        success     : function (data) { 
                            var jsonData = JSON.parse(data);
                            // console.log("ajax1", jsonData)

                            if(jsonData.S == 1){
                                if(action == "APPROVED"){
                                    var actionIDTransac;
                                    if(service == "ECASHPADALA")
                                    {
                                        actionIDTransac = "ecashpadalaTransacBSP";
                                    }else if(service == "CREDITTOBANK")
                                    {
                                        actionIDTransac = "credittobankTransacBSP";
                                    }else if(service == "ECCASH")
                                    {
                                        actionIDTransac = "ecashwallettopupTransacBSP";
                                    }else if(service == "ECASHTOCEBUANA")
                                    {
                                        actionIDTransac = "ecashtocebuanaTransacBSP";
                                    }
                                    var formData2 = new FormData();

                                    formData2.append('traceno', traceno);
                                    if(jsonData.S == 1){
                                        $.ajax({
                                            url         : `/Ecash_transactions/${actionIDTransac}`,
                                            type        : 'POST',
                                            data        : formData2,
                                            processData : false,
                                            contentType : false,
                                            success     : function (data) { 
                                                var jsonData = JSON.parse(data);
                                                // console.log("ajax2", jsonData)
                                                if(jsonData.S == 1){
                                                    $('#receiptReferenceno').text(jsonData.TN)
                                                    if(service == "ECASHPADALA")
                                                    {
                                                        $('#receiptLink').attr('href', 'https://mobilereports.globalpinoyremittance.com/portal/amla_transaction/'+jsonData.TN)
                                                    }else if(service == "CREDITTOBANK")
                                                    {
                                                        $('#receiptLink').attr('href', 'https://mobilereports.globalpinoyremittance.com/portal/ecash_remittance/ecash_credit_bank_receipt/'+jsonData.TN)
                                                    }else if(service == "ECCASH")
                                                    {
                                                        $('#receiptLink').attr('href', 'https://mobilereports.globalpinoyremittance.com/portal/ecpay_fund_transfer/'+jsonData.TN)
                                                    }else if(service == "ECASHTOCEBUANA")
                                                    {
                                                        $('#receiptLink').attr('href', 'https://mobilereports.globalpinoyremittance.com/portal/cebuana_remittance/domestic_sending_receipt/'+jsonData.TN)
                                                    }
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
                                
                                if(action == "DENIED"){
                                    showReceipt();
                                }
                                
                            }else{
                                waitingDialog.hide()
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

                function showReceipt(){
                    var formData = new FormData();

                    formData.append('traceno', traceno);

                    $.ajax({
                        url         : '/Ecash_transactions/fetch_transactionDetails',
                        type        : 'POST',
                        data        : formData,
                        processData : false,
                        contentType : false,
                        success     : function (data) { 
                            var jsonData = JSON.parse(data);
                            // console.log("showReceipt", jsonData)
                            if(jsonData.S == 1){
                                $('#divHeader').hide()
                                jsonData.M.forEach(function(i){
                                    // console.log('test', i)
                                    if(i.service == "ECASHPADALA"){
                                        $('#receiptService').text("E-CASH PADALA");
                                        $('#divSFS').hide();
                                        var formData = new FormData();

                                        formData.append('amount', i.principal);
                                        $.ajax({
                                            url         : '/Ecash_transactions/fetch_ecashpadala_rate',
                                            type        : 'POST',
                                            data        : formData,
                                            processData : false,
                                            contentType : false,
                                            success     : function (data) {
                                                var jsonData = JSON.parse(data);
                                                if(jsonData.S == 1){
                                                    $('#receiptCharge').val(jsonData.C);
                                                }
                                                waitingDialog.hide()
                                            }
                                            
                                        })
                                    }else if(i.service == "CREDITTOBANK"){
                                        $('#receiptService').text("CREDIT TO BANK");
                                        var formData = new FormData();

                                        formData.append('amount', i.principal);
                                        $.ajax({
                                            url         : '/Ecash_transactions/fetch_ecashcredittobank_rate',
                                            type        : 'POST',
                                            data        : formData,
                                            processData : false,
                                            contentType : false,
                                            success     : function (data) {
                                                var jsonData = JSON.parse(data);
                                                if(jsonData.S == 1){
                                                    $('#receiptCharge').val(jsonData.C);
                                                }
                                                waitingDialog.hide()
                                            }
                                            
                                        })
                                    }else if(i.service == "ECCASH"){
                                        $('#receiptService').text("WALLET TOP-UP");
                                        $('#receiptCharge').val((parseFloat(i.principal) * 0.01).toFixed(2));
                                        waitingDialog.hide()
                                    }else if(i.service == "ECASHTOCEBUANA"){
                                        $('#receiptService').text("E-CASH TO CEBUANA");
                                        $('#divSFS').hide()
                                        var formData = new FormData();

                                        formData.append('currency_id', 6);
                                        formData.append('amount', i.principal);
                                        $.ajax({
                                            url         : '/Ecash_transactions/fetch_ecashtocebuana_rate',
                                            type        : 'POST',
                                            data        : formData,
                                            processData : false,
                                            contentType : false,
                                            success     : function (data) {
                                                var jsonData = JSON.parse(data);
                                                if(jsonData.S == 1){
                                                    $('#receiptCharge').val(jsonData.SF);
                                                }
                                                waitingDialog.hide()
                                            }
                                            
                                        })
                                    }

                                    if(action == "APPROVED"){
                                        $('#receiptResult').text(action).attr('style', 'color:green');

                                        var type = 'APPROVE';

                                        var formData3 = new FormData();

                                        formData3.append('traceno', traceno);
                                        formData3.append('refno', refno);
                                        formData3.append('type', type);
                                        $.ajax({
                                            url         : '/Ecash_transactions/notify_sender_receiver',
                                            type        : 'POST',
                                            data        : formData3,
                                            processData : false,
                                            contentType : false,
                                            success     : function (data) {
                                                var jsonData = JSON.parse(data);
                                                // console.log("ajax3", jsonData)
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
                                    else if(action == "DENIED"){
                                        $('#receiptResult').text(action).attr('style', 'color:red');
                                        $('#divReceiptApproved').hide()

                                        var type = 'DENY';

                                        var formDataDny = new FormData();

                                        formDataDny.append('traceno', traceno);
                                        formDataDny.append('type', type);
                                        $.ajax({
                                            url         : '/Ecash_transactions/notify_sender_receiver',
                                            type        : 'POST',
                                            data        : formDataDny,
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

                                            }
                                            
                                        })
                                    
                                    }

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

                                    $('#receiptServiceType').val(i.servicetype)
                                    $('#receiptFirstField').val(i.firstfield)
                                    $('#receiptSecondField').val(i.secondfield)

                                    $('#receiptRelation').val(i.relation);
                                    $('#receiptPurpose').val(i.purpose);
                                    $('#receiptAmount').val(i.principal);

                                    $('#transactionRejectModal').modal('hide');
                                    $('#transactionRejectModal2').modal('hide');
                                    $('body').removeClass('modal-open');
                                    $('.modal-backdrop').remove();
                                    
                                    $('#receiptTraceno').text($('#selTraceno').val())
                                    $('#divShowReceipt').show(200)
                                    $('#divOTP').hide()
                                    $('#divPendingList').hide()
                                })
                            }else{
                                waitingDialog.hide()
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

                function otpTimer(){
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
                }
            
            }, 250 );
        }

    });
</script>