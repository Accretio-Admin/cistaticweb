<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-credit-card"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                   <li>BILLS PAYMENT 


                   </li>
                </ul>
                <h4>GOCAB CASH-IN</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
    <div class="contentpanel">
        <div class="container-fluid">
            <div class="row">
                <div style="border: solid 1px black; border-radius: 5px;" class="col-md-3">
                    <h6 for=""><strong>CHECK REFERENCE NUMBER</strong></h6>
                    <input type="text" id="referenceNo" placeholder="INPUT REFERENCE NO." class="form-control" value="">
                    <button type="button" style="margin: 10px 0;" class="btn btn-primary pull-right" id="btnSearchRef"><i class="fa fa-search"></i> Search</button>
                </div>
                <div class="col-md-9"></div>
            </div>
        </div>
    </div><!-- contentpanel -->       
</div><!-- mainpanel -->

<!-- modal -->
<div class="show_shipper_modal">

</div>

<script>
    $('#btnSearchRef').on('click', function(){
        let referenceNo = $('#referenceNo').val();

        // console.log(referenceNo);

        // retrun false;

        $.ajax({
            method: "POST",
            url: "/Bills_payment/check_gocab_ref_cashin",
            dataType: "JSON",
            data: {
                referenceNo: referenceNo,
            },
            success: function (response) {
                let res = response['DATA'];

                if (res['code'] === 142)
                {
                    $.alert({
                        title: '<i class="fa fa-exclamation-circle"></i>' + ' ' + 'Info!',
                        content: res['error'],
                    })
                    return false;
                }

                // console.log(res['result'].amount);
                
                $('.show_shipper_modal').html(response['MODAL'])
                $('#gocab_shipper_modal').modal('show');

                $('#gocab_process_cashin').on('click', function(){
                    let accname = res['result']['user'].firstName + ' ' + res['result']['user'].lastName;
                    let mobile = '';
                    let transpass = $('#i_gocab_cashin_transpass').val()
                    let refno = referenceNo;
                    let amount = res['result'].amount;
                    let charge = res['result'].transactionFee;
                    let transno = res['result'].transactionNumber;
                    let channelfee = res['result'].channelFee;

                    if(res['result'].roleType === 'MERCHANT'){
                        accname = res['result']['user'].username;
                    }

                    if (transpass === '')
                    {
                        $.alert({
                            title: "Information!",
                            content: "Transaction Password is Required!",
                        });
                        return false;
                    }

                    $.confirm({
                        title: 'Information!',
                        content: 'Are you sure you want to proceed?',
                        buttons: {
                            Cancel: function () {
                                
                            },
                            Proceed: function () {
                                $.ajax({
                                    method: "POST",
                                    url: "/Bills_payment/process_gocab_ref_cashin",
                                    dataType: "JSON",
                                    data: {
                                        accname:    accname,
                                        mobile:     mobile,
                                        transpass:  transpass,
                                        refno:      refno,
                                        amount:     amount,
                                        charge:     charge,
                                        channelfee: channelfee,
                                        transno:    transno
                                    },
                                    success: function (response) {
                                        // console.log(response);
                                        
                                        if(response['STATUS'] === '1')
                                        {
                                            $('#gocab_shipper_modal').modal('hide');
                                            $('#referenceNo').val('');

                                            $.confirm({
                                                title: 'Transaction Successful!',
                                                content: 'Transaction Number: ' + response['TRACKINGNO'],
                                                buttons: {
                                                    printReceipt: {
                                                        text: 'Print Receipt',
                                                        btnClass: 'btn-blue',
                                                            action: function () {
                                                            window.open('https://mobilereports.globalpinoyremittance.com/portal/gocab_receipt/'+response['TRACKINGNO'], '_blank');
                                                        }
                                                    },
                                                    close: function () {
                                                    }
                                                }
                                            });


                                            // $('#gocab_process_cashin').prop('disabled', true)
                                            // $('.gocab_confirmbutton_cashin').html('<button style="margin-top: 10px;" class="btn btn-primary" id="gocab_confirm_cashin">CONFIRM</button>');
                                        
                                            // $('#gocab_confirm_cashin').on('click', function(){
                                            //     confirm_referenceNo(response['TRACKINGNO']);
                                            // });
                                        }
                                        else
                                        {
                                            $.alert({
                                                title: "Information!",
                                                content: response['MESSAGE'],
                                            });
                                            return false;
                                        }
                                    },
                                    error: function () {
                                        $.alert({
                                            title: "Error!",
                                            content: "Please contact developer about this problem.",
                                        });
                                    },
                                });
                            }
                        }
                    });
                });
            },
            error: function () {
                $.alert({
                    title: "Error!",
                    content: "Please contact developer about this problem.",
                });
            },
        });
    });

    function confirm_referenceNo(trackno){
        let referenceNo = $('#referenceNo').val();
        // console.log(trackno);

        $.ajax({
            method: "POST",
            url: "/Bills_payment/confirm_gocab_ref_cashin",
            dataType: "JSON",
            data: {
                referenceNo: referenceNo,
                trackno:     trackno,
            },
            success: function (response) {

                if(response['STATUS'] === '1')
                {
                    $('#gocab_shipper_modal').modal('hide');
                    $('#referenceNo').val('');
                    $.alert({
                        title: "SUCCESS!",
                        content: response['MESSAGE'],
                    });
                }
                else
                {
                    $.alert({
                        title: "ERROR!",
                        content: response['MESSAGE'],
                    });
                    return false;
                }
                
            },
            error: function () {
                $.alert({
                    title: "Error!",
                    content: "Please contact developer about this problem.",
                });
            },
        });
    }
        
    
</script>