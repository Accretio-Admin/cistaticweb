<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-credit-card"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                   <li>ECASH


                   </li>
                </ul>
                <h4>GOCAB CASH-OUT</h4>
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
            url: "/Ecash_payout/check_gocab_ref_cashout",
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


                $('body > section > div > div.mainpanel > div.contentpanel').html(response['KYC'])
                // $('.account_details').html(response['TABLE'])

                let search = $('#inputSearch').val();
                $.ajax({
                    method: "POST",
                    url: "/Ecash_payout/get_id_details",
                    dataType: "JSON",
                    data: {
                        search: search,
                    },
                    success: function (response) {
                        // console.log(response['TABLE']);
                        $('.account_details').html(response['TABLE'])
                    }
                });


                // console.log(res['result'].amount);
                
                $('.show_shipper_modal').html(response['MODAL'])
                // $('#gocab_shipper_modal').modal('show');

                $('#gocab_process_cashout').on('click', function(){
                    let accname = res['result']['user'].firstName + ' ' + res['result']['user'].lastName;
                    let mobile = '';
                    let transpass = $('#i_gocab_cashout_transpass').val()
                    let refno = referenceNo;
                    let amount = res['result'].amount;
                    let charge = res['result'].transactionFee;
                    let channelfee = res['result'].channelFee;
                    let transno = res['result'].transactionNumber;
                    let client_mobile = $('#inputMobile').val();
                    let client_email = $('#inputEmail').val();
                    let client_fname = $('#inputFname').val();
                    let client_mname = $('#inputMname').val();
                    let client_lname = $('#inputLname').val();

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
                        title: 'Information',
                        content: 'Are you sure you want to proceed?',
                        buttons: {
                            CANCEL: function () {
                                
                            },
                            PROCEED: function () {
                                $.ajax({
                                    method: "POST",
                                    url: "/Ecash_payout/process_gocab_ref_cashout",
                                    dataType: "JSON",
                                    data: {
                                        client_mobile:   client_mobile,
                                        client_email:    client_email,
                                        client_fname:    client_fname,
                                        client_mname:    client_mname,
                                        client_lname:    client_lname,
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
                                        if(response['STATUS'] === '1')
                                        {
                                            $('#gocab_shipper_modal').modal('hide');
                                            $('#referenceNo').val('');
                                            
                                            $.dialog({
                                                title: 'Transaction Successful!',
                                                closeIcon: function(){
                                                    location.reload();
                                                },
                                                content: 'Reference No: '+'<a href="https://secure.unified.ph/Report/gocabv1">'+refno+'</a>', 
                                            });

                                            // $('#gocab_process_cashout').prop('disabled', true)
                                            // $('.gocab_confirmbutton_cashout').html('<button style="margin-top: 10px;" class="btn btn-primary" id="gocab_confirm_cashout">CONFIRM</button>');
                                        
                                            // $('#gocab_confirm_cashout').on('click', function(){
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
            url: "/Ecash_payout/confirm_gocab_ref_cashout",
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