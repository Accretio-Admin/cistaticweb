<style>
    .datepicker_calendar {
        display: none;
    }
    .ui-datepicker-calendar {
        display: none;
    }
    #showContinue{
        z-index: 1100; 
        display: none;
    }
    .btnOKAY{
        font-size: 22px;
        height: 60px;
        width: 170px;
        border: none;
        color: #FFC500;
        background-color: #FFF9E1;
        margin: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        border-radius: 15px;
        transform: translate(-50%, 70%);
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
                    <li>BILLS PAYMENT</li>
                </ul>
                <h4><?php echo strtoupper($biller_header);?></h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

<!--  style="display: block; position: fixed; z-index: 1100;" -->
    <div class="modal fade" id="showContinue" role="dialog" data-keyboard="false" data-backdrop="static">
          <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content" style="position: fixed; left: 50%; top: 139px; height: 262px; width: 670px; border-radius: 25px; transform: translateX(-50%); box-shadow: 5px 5px 5px 2.5px;">
                  
                      <div style="display:flex; height: 121px; margin-top:25px; flex-direction: row;">
                        <img src="/assets/images/greencheck2" syle="height: 130px; margin-top: -4px; width: 130px;"/><p style="font-size: 45px; margin: auto;">Transaction is Successful!</p>
                      </div>
                      <div>
                        <button class="btnOKAY" id="okay" name="okay">OKAY</button>
                      </div>
              </div>
          </div>
    </div>

    <script>
        $(document).ready(function () {
            $("#btnReprocess").on("click", function () {
                var trackingNo = $('#trackingNo').val();

                $.ajax({
                    url     : "/Bills_payment/trackingNo_fetch",
                    type    : 'POST',
                    data    : {trackingNo},
                    datatype: 'json',
                    cache   : false,
                    success : function (data) {
                        var jsonData = JSON.stringify(data);
                        // alert();
                        if (jsonData.S == 1) {
                            alert(jsonData.M);
                        } 
                        // else {
                        //     alert("ERROR!!");
                        // }
                    }
                })
                $("#transactionConfirmation").remove(); 
            });

            $("#okay").click(function (){
                $("#showContinue").hide();
                    setTimeout(() => {
                        $(".modal-backdrop").hide();
                        $("body").removeClass("modal-open");
                    }, 600, clearTimeout());
                    if ( window.history.replaceState ) {
                        window.history.replaceState( null, null, window.location.href );
                    }
                    window.location = window.location.href;
            });
                
        });

 
    </script>


    <div class="contentpanel">
        <div class="row">
            <div class="col-xs-12 col-md-5">
                <?php if ($API['S'] == 0 && $API['EM'] != 30): ?>
                    <div class="alert alert-danger">
                        <b><?php echo $API['M'] ?></b>                        
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif ?>

                <input type="hidden" id="errormessage" value=<?php echo $API['EM'] ?>>
                <input type="hidden" id="trackingNoReprocess" value <?php echo $API['TN'] ?>>
                <button hidden id="btnerror" data-toggle="modal" data-target="#transactionConfirmation"></button>
                <div class="modal mt-5" id="transactionConfirmation" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">  
                            <div class="modal-header">
                                <button type="button" id="closeModal" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="col flex-center mt-3" style="margin-left: 25px;">
                                    <h3>Oh no!</h3>
                                </div>
                                <div class="col flex-center mt-3" style="padding-top: 10px;">
                                    <input type="hidden" id="trackingNo" name="trackingNo" value = "<?php echo $API['TN'] ?>">
                                    <p><?php echo $API['M'] ?></p>
                                </div>
                            </div>

                            <div id="divConfirmDeny">
                                <div class="col flex-center mb-3" id="confirmDiv" style="padding-top: 30px;">
                                    <button type="button" class="btnApprove" style="height:56px; width:322px; background-color:#FFC914; font-size:20px; font-weight:600; color:white;" name="btnReprocess" id="btnReprocess" data-target="#showContinue" data-toggle="modal" data-info="DENIED">CONTINUE?</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
                <?php if ($API['S']== 1 && $submitBtn == 1): ?>
                    <?php if ($API['BCT']== 1): ?>
                        <div class="alert alert-warning">
                            <b><?php echo "Transaction on process. Please see status and receipt on the BAYAD CENTER table for update." ?></b>                        
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-success">&nbsp;&nbsp;<b><?php echo $API['M'] ?> </b><br />
                            <a href="https://mobilereports.globalpinoyremittance.com/portal/billspayment_receipt/<?php echo $API['TN'];  ?>" target="_blank"><?php echo $API['TN'];  ?></a>
                            &nbsp;&nbsp;<small>Click transaction number to download reciept.</small>
                        </div>
                    <?php endif ?>
                <?php endif ?>
                <div class='divAlert'></div>
                <div class="form-group">
                    <select class="form-control" name="selBillerMain" id="selBillerMain" disabled>
                        <option value="" disabled selected>CHOOSE BILLER</option>  
                        <?php 
                        foreach ($biller as $key): 
                            $pieces = explode("|", $key);
                            $BD = strtoupper($pieces[0]);
                            $BC = strtoupper($pieces[1]);
                            $FT = strtoupper($pieces[2]);
                            $TF = strtoupper($pieces[3]);
                            
                        ?>
                            <option value="<?php echo $BC ?>" data-name ="<?php echo $BD ?>" data-type ="<?php echo $FT ?>" data-desc = "<?php echo $user['CG'].'|'.$user['L'].'|'.$TF ?>" ><?php echo $BD ?></option>  
                        <?php endforeach ?>
                   </select>
                </div>

                <div id="formMain" style="display: none;"> 
                    <form name="formBillerMainLoading" action="<?php echo BASE_URL() ?>Bills_payment/biller_main/<?php echo $biller_group;?>" method="post" id="formBillerMainLoading"  enctype="multipart/form-data">
                        <div id="divBillerrDynamicField"></div>
                        <div class="form-group text-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" name="btnSubmitModal" id="btnSubmitModal">Submit</button>
                        </div>
                        <div id="myModalBiller" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class='divAlert'></div>
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">TRANSACTION SUMMARY</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div id="divConfirmAddfield"></div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required/>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">Confirm</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                  </form>
                </div>               
            </div>
            <div class="col-xs-12 col-md-7">
                <div class="col-xs-12 col-md-12">
                    <div class="col-xs-12 col-md-12">
                        <div class="form-group">
                            <div class="alert alert-info alert-biller-default" style="word-wrap:break-word;">
                                <h4 class="text-info" style="font-weight: bold;"><i class="fa fa-bell" aria-hidden="true"></i> IMPORTANT REMINDERS</h4>
                                <p> <b><span class="text-info1">1.</span></b> Customer needs to present their <b>Statement of Account (SOA)</b> over-the-counter. </p>
                                <p> <b><span class="text-info1">2.</span></b> Inform the customers of the <b>Three (3) days</b> posting of bills payment transaction.  </p>
                                <p> <b><span class="text-info1">3.</span></b> Accept Cash payments from customers or subscribers if a Statement of Account/Billing from specific biller institution is presented provided such payment is in <b>Full (No partial), Exact amount (No rounding off), Not overdue and Without any arrears such as with Disconnection notice and/or Unpaid previous bill</b>. </p>
                                <p> <b><span class="text-info1">4.</span></b> After every transaction, <b>download and print Acknowledgement Receipt</b>. Original copy of the acknowledgement receipt will be issued to the customer as proof of payment. </p>
                            </div>
                            <div class="alert alert-info alert-biller-reciept" style="display:none;"></div>
                            <div class="alert alert-info alert-biller" style="display:none;word-wrap:break-word;"></div>
                        </div>
                    </div>   
                </div><!-- col-md-9 -->
            </div>
            <div class="modal fade" id="modalImportantReminder" data-backdrop="static" data-keyboard="false" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Important Reminder!</h4>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <div class="col-md-12" style="text-align: center;">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Agree</button>  
                            </div>
                        </div>
                    </div>                
                </div>
            </div>
            <!-- end modalImportantReminder -->
        </div><!-- row -->
        <div class="row">
            <div class="col-xs-12 col-md-12" >
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr >
                            <th>Service</th>
                            <th>Tracking No</th>
                            <th>Account No</th>
                            <th>Account Name</th>
                            <th>Amount</th>
                            <th>Date Posted</th>
                            <th>Status</th>
                        </tr>
                    </thead> 
                    <tbody>
                        <?php foreach($BCT_LISTS as $bct):?>
                            <tr>
                                <td><?php echo $bct['billerdesc'] ?></td>
                                <?php if($bct['bct_status'] == "SUCCESS"): ?>
                                    <td><a href="https://mobilereports.globalpinoyremittance.com/billspayment/receipt.php?tn=<?php echo $bct['trackno'];?>" target="_blank"><?php echo $bct['trackno'] ?></td>
                                <?php else: ?>
                                    <td><?php echo $bct['trackno'] ?></td>
                                <?php endif; ?>
                                <td><?php echo $bct['acctNo']; ?></td>
                                <td><?php echo $bct['acctName']; ?></td>
                                <td><?php echo $bct['amount']; ?></td>
                                <td><?php echo $bct['date'] .' '. $bct['time']; ?></td>
                                <td><?php echo $bct['bct_status']; ?></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- contentpanel -->                    
</div><!-- mainpanel -->            

<script src="<?php echo BASE_URL()?>assets/js/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function(){
    $('#example').dataTable( {
        "ordering": false
    } );
    if($('#errormessage').val() == 30){
        $('#btnerror').click()
    }
    $('#btnSubmitModal').on("click", function(){
        $('.divAlert').html('');
        let valid = true;
        let accountValidation = false;

        var errorMessage = '';       
        var accountno = $('#inputAccountNumber').val();
        var amount = $("#inputAmount").val();
        var payment_date = $("#inputPaymentDate").val();
        var urlValidation = '';
        var dataValidation = [];
       
        $('[required]').each(function() {
            if ($(this).is(':invalid') || !$(this).val()) {

                if ($(this).attr('name') != 'street' && $(this).attr('name') != 'zipcode' && $(this).attr('name') != 'inputTpass' && $(this).attr('name') != "inputPaymentDate"){
   
                    valid = false;
                    errorMessage = errorMessage + $(this).attr('placeholder') +" is invalid.<br/>"; 
                }
            }
            if ($(this).attr('name') == "inputPaymentDate") {
              
                        var d = new Date();
                        var month = d.getMonth()+1;
                        var day = d.getDate();
                        var output = d.getFullYear() + '-' +
                            (month<10 ? '0' : '') + month + '-' +
                            (day<10 ? '0' : '') + day;

                        dateNow = output.split("-");
                    
                        dateInput = $('#inputPaymentDate').val().split("-");

                        if(parseInt(dateNow[0]) > parseInt(dateInput[0])){
                            valid = false;
                            errorMessage = errorMessage  + "Oops...! Payment already due. Kindly pay your bills to your nearest ILECO3 branch..<br/>";
                        }else if(parseInt(dateNow[0]) == parseInt(dateInput[0])){
                            if(parseInt(dateNow[1]) > parseInt(dateInput[1])){
                                valid = false;
                                errorMessage = errorMessage  + "Oops...! Payment already due. Kindly pay your bills to your nearest ILECO3 branch..<br/>";
                            }else if(parseInt(dateNow[1]) == parseInt(dateInput[1])){
                                    if(parseInt(dateNow[2]) > parseInt(dateInput[2]))  {
                                    valid = false;           
                                    errorMessage = errorMessage  + "Oops...! Payment already due. Kindly pay your bills to your nearest ILECO3 branch..<br/>";     
                                    }
                            } else {
                                    valid = true;           
                                    errorMessage = errorMessage  + "Oops...! Payment already due. Kindly pay your bills to your nearest ILECO3 branch..<br/>";     
                         
                                } 
                            
                        }
                    
                }
        });

        var billerCode = $('#inputBillerCode').val();
        switch (billerCode) {
            case '206': accountValidation = true;//cagelco
                urlValidation = "/Bills_payment/cagelco_checkStatus";
                var billmonth = $("#inputDate1").val();
                dataValidation = {
                    'accountno':accountno, 
                    'billmonth':billmonth
                };
                break;
            case '241': accountValidation = true;
                urlValidation = "/Bills_payment/batelec_validate";
                dataValidation = {
                    'accountno':accountno, 
                    'amount':amount
                };
                break;
            case '260': accountValidation = true;
                urlValidation = "/Bills_payment/INEC_validate";
                dataValidation = {
                    'accountno':accountno
                };                        
                break;
            case '1033':
                if (amount < 150) {
                    valid = false;
                    errorMessage = errorMessage + "Amount must be minimum 150.00.<br/>";
                }
                break;
            case '844': //gmawd direct
                accountValidation = true;
                urlValidation = "/Bills_payment/gmawd_validate";
                dataValidation = {
                    'accountno':accountno,
                    'amount':amount,
                };
                break;

        }

        if (!valid) {
            $.fn.validationFail(errorMessage);
        } else if (accountValidation) {
            waitingDialog.show('Data Validation. Please Wait.', {dialogSize: 'sm', progressType: 'primary'});

            $.ajax({
                url     : urlValidation,
                type    : 'POST',
                data    : dataValidation,
                datatype: 'json',
                cache   : false,
                success : function (data) {
                    var jsonData = JSON.parse(data);

                    if (billerCode == 206) {//cagelco
                        $.fn.validationCagelco(jsonData);
                    } else if (jsonData.S != 1) {
                        $.fn.validationFail(jsonData.M);                        
                    } else {
                        $.fn.validationSuccess();
                        
                        $.fn.validationResetField(billerCode,jsonData);
                    } 
                    
                    waitingDialog.hide();
                }

            });
        } else {
            $.fn.validationSuccess();
        }

    });// end submit validation

    $("#selBillerMain").change(function(){
        waitingDialog.show('Loading. Please Wait.', {dialogSize: 'sm', progressType: 'primary'});

        var billerCode = $(this).val();

        $('.divAlert').html('');

        $('#formMain').show();
        $('#divBillerrDynamicField').empty();
        $('#divConfirmAddfield').empty();

        var billerName = document.getElementById("selBillerMain");                
        $("#divConfirmAddfield").append('<div class="form-group">'+
                '<div class="input-group">'+
                    '<span class="input-group-addon" style="min-width:100px;text-align:left">BILLER NAME :</span>'+
                    '<span class="form-control"><label>'+billerName.options[billerName.selectedIndex].text+'</label></span>'+
                '</div>'+
            '</div>');

        $('.alert-biller-reciept').hide();

        $.ajax({
            url     : "/Bills_payment/get_biller_fields",
            type    : 'POST',
            data    : {'biller_id':billerCode},
            datatype: 'json',
            cache   : false,
            success : function (data) {
                var jsonData = JSON.parse(data);
                
                if (jsonData.S == 1) {
                    $.fn.processBillerFields(jsonData.P_DATA[0]);
                } else {
                    $('#formMain').hide();
                }

                waitingDialog.hide();
            }

        });

    });//end select biller
    $(document).on("keyup", "input" , function() {    
        var invalid = false;
        var billerCode = $('#inputBillerCode').val();

        //  additional pattern for account number
        switch (billerCode) {
            case '749': // account number 1,2 Digits == 3,4 Digits
                if (($(this).attr('name') == 'inputAccountNumber') && ($(this).val().substring(0,2) != $(this).val().substring(3,5))){
                    invalid = true;
                }
                break;
        }

        if (invalid || $(this).is(':invalid')) {
            $('.divAlert').html('<div class="alert alert-warning alert-dismissible" role="alert">'+                
                '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+$(this).attr('placeholder') + ' is invalid'+'</div>');
        } else {
            $('.divAlert').html('');
        }
        
    });

    $('.formBillerMainLoading').on('submit', function(){
        waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
    });

    $.fn.validationSuccess = function() {
        $('#account_no').text($('#inputAccountNumber').val());
        $('#account_name').text($('#inputAccountName').val());
        $('#first_name').text($('#inputFirstName').val());
        $('#middle_name').text($('#inputMiddleName').val());
        $('#last_name').text($('#inputLastName').val());
        $('#contact_no').text($('#inputContactNo').val());
        $('#email').text($('#inputEmail').val());
        $('#address').text($('#inputAddress').val());
        $('#reference1').text($('#inputReference1').val());
        $('#reference2').text($('#inputReference2').val());
        $('#reference3').text($('#inputReference3').val());
        $('#date1').text($('#inputDate1').val());
        $('#date2').text($('#inputDate2').val());
        $('#date3').text($('#inputDate3').val());
        $('#payment_date').text($('#inputPaymentDate').val());   
        $('#schoolyear').text($('#inputSchoolYear').val());
        $('#bill_no').text($('#inputBillNumber').val());
        if (typeof($('#inputFile').val()) != 'undefined' && $('#inputFile').val() != '') {
            $('#file').text($('#inputFile').val().split('\\').pop());
        }
        if (typeof($('#selData1').val()) != 'undefined' && $('#selData1').val() != '') {
            var selData1 = document.getElementById("selData1");
            $('#select1').text(selData1.options[selData1.selectedIndex].text);            
        }
        
        if (typeof($('#selData2').val()) != 'undefined' && $('#selData2').val() != '') {
            var selData2 = document.getElementById("selData2");
            $('#select2').text(selData2.options[selData2.selectedIndex].text);
        }

        if (typeof($('#selData3').val()) != 'undefined' && $('#selData3').val() != '') {
            var selData3 = document.getElementById("selData3");
            $('#select3').text(selData3.options[selData3.selectedIndex].text);
        }
        var amount = parseFloat($('#inputAmount').val());
        if (amount) {
            // $('#amount').text((amount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
            $('#amount').text(amount);
        }
        
        $("#myModalBiller").modal();
    }

    $.fn.validationFail = function(e) {
        $('.divAlert').html('<div class="alert alert-danger alert-dismissible" role="alert">'+                
            '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+e+'</div>');
    }

    $.fn.validationResetField = function(billerCode,jsonData) {
        var dataFieldLabel = [];
        var dataFieldHidden = [];

        switch (billerCode) {
            case '206': //cagelco
                /*dataFieldLabel = {
                    'ACCOUNT NUMBER :':jsonData.ACCTNO,
                    'ACCOUNT NAME :':jsonData.ACCNTNAME,
                    'BILLING PERIOD :':jsonData.BILLPERIOD,
                    'DUE DATE :':jsonData.DUEDATE,
                    'AMOUNT :':jsonData.AMT,
                };

                dataFieldHidden = {
                    'inputAccountName':jsonData.ACCNTNAME,
                    'inputDate1':jsonData.BILLPERIOD,
                    'inputDate2':jsonData.DUEDATE,
                };*/
                break;
            case '241': 
                dataFieldLabel = {
                    'ACCOUNT NUMBER :':$('#inputAccountNumber').val(),
                    'ACCOUNT NAME :':jsonData.R.name,
                    'BILLING PERIOD :':jsonData.R.due_month_year,
                    'DUE DATE :':jsonData.R.duedate,
                    'AMOUNT :':$("#inputAmount").val(),
                };

                dataFieldHidden = {
                    'inputAccountName':jsonData.R.name,
                    'inputDate1':jsonData.R.due_month_year,
                    'inputDate2':jsonData.R.duedate,
                };
                break;
            case '260': 
                dataFieldLabel = {
                    'ACCOUNT NUMBER :':$('#inputAccountNumber').val(),
                    'ACCOUNT NAME :':jsonData.R.name,
                    'CONTACT NO :':$('#inputContactNo').val(),
                    'BILLING PERIOD :':jsonData.R.due_month_year,
                    'DUE DATE :':jsonData.R.duedate,
                    'AMOUNT :' :$("#inputAmount").val(),
                };

                dataFieldHidden = {
                    'inputAccountName':jsonData.R.name,
                    'inputDate1':jsonData.R.due_month_year,
                    'inputDate2':jsonData.R.duedate,
                    'inputAmount':$("#inputAmount").val(),
                };
                break;

        }

        $('#divConfirmAddfield').empty();

        $.each(dataFieldLabel, function (keyValue, keyText) {
            $("#divConfirmAddfield").append('<div class="form-group">'+
                '<div class="input-group">'+
                    '<span class="input-group-addon" style="min-width:200px;text-align:left">'+keyValue+' :</span>'+
                    '<span class="form-control"><label>'+keyText+'</label></span>'+
                '</div>'+
            '</div>');
        });

        $.each(dataFieldHidden, function (keyValue, keyText) {
            $("#divConfirmAddfield").append('<input type="hidden" class="form-control" name="'+keyValue+'" id="'+keyValue+'" value="'+keyText+'"/>');
        });
    }

    $.fn.validationCagelco = function(res) {
        if (res.S == 1) { //Please proceed with your transaction.
            $.fn.validationSuccess();
            /*$("#inputAccountNumberxx").prop('readonly', true);
            $('#inputGracePeriodsxx').prop('readonly', true);
            $('#divcheckStatus').show()
            $('#inputimagecagelco').show()
            $('#btnCheckStatus').hide()
            $('#cagelcovalinfo').hide();
            $('#inputimagecagelco2').hide();
            $('#approvedmessage').hide();
            $('#btnSubmitcagelco').show()*/
        } else if(res.S == 4) { //REVOKED
            $.fn.validationFail(res.M);
        } else if(res.S == 3) { //APPROVED
            /*$('#inputimagecagelco').remove();
            $('#cagelcovalsuccess').show();
            $('#cagelcovalsuccess').text(res.M);
            $('#cagelcovalinfo').show();
            $('#cagelcovalinfo').text(res.M);
            $('#approvedmessage').show();
            
            $('#a').prop('href',`https://mobilereports.globalpinoyremittance.com/portal/billspayment_receipt${res.TRACKNO}`);
            $('#b').text(res.TRACKNO);
            $('#c').prop('href',`https://mobilereports.globalpinoyremittance.com/portal/billspayment_receipt${res.TRACKNO}`);
            */
            $.fn.validationFail(res.M);

        } else if(res.S == 2) { // ONPROCESS OR PENDING
            if (res.TRACKNO) {
                /*$("#cagelcovalwarning").hide();
                $("#inputAccountType").val(res.S);
                $('#cagelcovalinfo').show();
                $('#cagelcovalinfo').text(res.M);
                $('#errorcagelco').hide();*/

                $.fn.validationFail(res.M);
            } else {
                $.fn.validationFail(res.M);
            }
            var trno = res.TRACKNO
        } else {
            $.fn.validationFail(res.M);
        }

        console.log(res);
    }


    $.fn.processBillerFields = function(dataBiller) {
        
        var billerCode = dataBiller['billerId'];
        $("#divBillerrDynamicField").append('<input type="hidden" class="form-control" name="inputBillerCode" id="inputBillerCode" />');
        $("#inputBillerCode").val(billerCode);

        var billerField = JSON.parse(dataBiller['billerField']);

        var billerFieldName = [];
        billerFieldName['account_no'] = 'inputAccountNumber';
        billerFieldName['account_name'] = 'inputAccountName';
        billerFieldName['first_name'] = 'inputFirstName';
        billerFieldName['middle_name'] = 'inputMiddleName';
        billerFieldName['last_name'] = 'inputLastName';
        billerFieldName['contact_no'] = 'inputContactNo';
        billerFieldName['email'] = 'inputEmail';
        billerFieldName['address'] = 'inputAddress';
        billerFieldName['reference1'] = 'inputReference1';
        billerFieldName['reference2'] = 'inputReference2';
        billerFieldName['reference3'] = 'inputReference3';
        billerFieldName['date1'] = 'inputDate1';
        billerFieldName['date2'] = 'inputDate2';
        billerFieldName['date3'] = 'inputDate3';
        billerFieldName['select1'] = 'selData1';
        billerFieldName['select2'] = 'selData2';
        billerFieldName['select3'] = 'selData3';
        billerFieldName['amount'] = 'inputAmount';
        billerFieldName['file'] = 'inputFile';
        billerFieldName['payment_date'] = 'inputPaymentDate';
        billerFieldName['schoolyear'] = 'inputSchoolYear';
        billerFieldName['bill_no'] = 'inputBillNumber';
        
        
        var billerFieldNameSelect = [];
        billerFieldNameSelect[0] = 'select1';
        billerFieldNameSelect[1] = 'select2';
        billerFieldNameSelect[2] = 'select3';

        var billerFieldType = [];
        var billerReceipt = '';

        //type
        var billerFieldType = dataBiller['billerType'];
        if (billerFieldType !== null) {
            billerFieldType = JSON.parse(billerFieldType);
        }
        
        var billerInputType = null;

        //fields
        $.each(billerField, function (keyValue, keyText) {
            if (keyValue == 'select1' || keyValue == 'select2' || keyValue == 'select3') {
                $("#divBillerrDynamicField").append('<div class="form-group">'+
                    '<select class="form-control" '+
                        'name="'+billerFieldName[keyValue]+'" '+
                        'id="'+billerFieldName[keyValue]+'" '+
                        'placeholder="'+keyText+'" '+
                        'required >'+
                    '</select></div>');
            } else if (keyValue == 'file') {
                $("#divBillerrDynamicField").append('<div class="form-group">'+
                    '<small>'+keyText+'</small>'+
                    '<input type="'+keyValue+'" class="form-control" '+
                        'name="'+billerFieldName[keyValue]+'" '+
                        'id="'+billerFieldName[keyValue]+'" '+
                        'placeholder="'+keyText+'" '+
                        'required /></div>');
            } else {
                if (billerFieldType !== null && billerFieldType[keyValue] == 'date') {

                    billerInputType = billerFieldType[keyValue];
                    $("#divBillerrDynamicField").append('<div class="form-group">'+
                    '<small>'+keyText+'</small>'+
                    '<input type="'+billerInputType+'" class="form-control" '+
                        'name="'+billerFieldName[keyValue]+'" '+
                        'id="'+billerFieldName[keyValue]+'" '+
                        'placeholder="'+keyText+'" '+
                        'required /></div>');
                } else {
                    $("#divBillerrDynamicField").append('<div class="form-group">'+
                    '<input type="text" class="form-control" '+
                        'name="'+billerFieldName[keyValue]+'" '+
                        'id="'+billerFieldName[keyValue]+'" '+
                        'placeholder="'+keyText+'" '+
                        'required /></div>');
                }
            }

            $("#divConfirmAddfield").append('<div class="form-group">'+
                '<div class="input-group">'+
                    '<span class="input-group-addon" style="min-width:200px;text-align:left">'+keyText+' :</span>'+
                    '<span class="form-control"><label id="'+keyValue+'"></label></span>'+
                '</div>'+
            '</div>');
        });

        //options
        var billerOption = dataBiller['billerOption'];
        if (billerOption !== null) {
            var strTemp = billerOption.split('||');
            for (let a = 0, len = strTemp.length; a < len; a++) {
                keyValue = billerFieldNameSelect[a];
    
                selName = billerFieldName[keyValue];
                selName = '#'+selName;
                
                var test = JSON.parse(strTemp[a]);

                $.each(test, function(index, item) {
                    $(selName).append($('<option>', { 
                        value: index,
                        text : item 
                    }));
                });
            }
        }
        
        //pattern
        var billerPattern = dataBiller['billerPattern'];
        if (billerPattern !== null) {
            billerPattern = JSON.parse(billerPattern);
            $.each(billerPattern, function (keyValue, keyText) {
                $('input[name='+billerFieldName[keyValue]+']').attr('pattern',keyText);
            });
        }

        // accountNoNote
        var accountNoNote = 'must be numeric only.';
        if (dataBiller['accountNoNote']) {
            accountNoNote = dataBiller['accountNoNote'];
        }
        
        // additionalNote
        var additionalNote = '';
        if (dataBiller['additionalNote']) {
            additionalNote = dataBiller['additionalNote'];
        }
        
        $('.alert-biller-default').show();
        $('.alert-biller-default').html('<h4 class="text-info" style="font-weight: bold;"><i class="fa fa-bell" aria-hidden="true"></i> IMPORTANT REMINDERS</h4>'+
            '<span class="glyphicon glyphicon-chevron-right"></span>'+
            '<b> '+billerField['account_no']+'</b> '+accountNoNote+'<br>'+additionalNote);

        // billerReceipt
        var billerReceipt = dataBiller['billerReceipt'];
        if (billerReceipt !== null) {
            $('.alert-biller-reciept').show();
            $('.alert-biller-reciept').html(billerReceipt);
        }

        //not required
        var billerNotRequired = dataBiller['billerNotRequired'];
        if (billerNotRequired !== null) {
            billerNotRequired = billerNotRequired.split(',');
            for (let a = 0, len = billerNotRequired.length; a < len; a++) {
                keyValue = billerNotRequired[a];
                $('input[name='+billerFieldName[keyValue]+']').attr("required", false);
            }
        }

        var billerData = dataBiller['provider'];

        //provider
        if (billerData == 'ECPAY ECCASH' || billerData == 'ECPAY ECBILLS') {
            $("#divBillerrDynamicField").append('<div class="form-group">'+
                    '<input type="hidden" class="form-control" '+
                        'name="inputProvider" '+
                        'id="inputProvider" '+
                        'value="'+billerData+'" '+
                        ' /></div>');

            $('input[name=inputReference1]').attr('value',dataBiller['billername']);
            $('input[name=inputReference1]').prop('readonly', true);

            //START -- VALIDATION FOR SPECIAL CHARACTERS

            $('input[name=inputAmount]').on('keypress', function (event) {
                var regex = new RegExp("^[0-9.]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                    $('.divAlert').html('<div class="alert alert-warning alert-dismissible" role="alert">'+                
                        '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please refrain from using Special Characters.</div>');
                    return false;
                }
            });
            $('input[name=inputAccountName]').on('keypress', function (event) {
                var regex = new RegExp("^[a-zA-Z0-9 ]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                    $('.divAlert').html('<div class="alert alert-warning alert-dismissible" role="alert">'+                
                        '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please refrain from using Special Characters.</div>');
                    return false;
                }
            });

          //END -- VALIDATION FOR SPECIAL CHARACTERS
        }

        $('input[name=inputAmount]').attr('min','5');
    }

  });

    $(window).on('load', function () {
        $("#selBillerMain").attr("disabled", false);
    })

</script>


