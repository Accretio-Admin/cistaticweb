<style>
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus{
    border-left: 0;
    color: #000 !important;
    background-color: #fff !important;
    border-top: solid 10px #fca600 !important;
}

.typeahead__field{
    font-size: 1.8rem;
}

.flag img {
    height: 26px;
    width: 26px;
}

/* provider */
.provider-list{
    list-style: none;
    margin: 0;
    padding: 0;
}

.provider-list .provider{
    padding-left: 0;
    margin-bottom: 10px;
}

.imr-md-operator{
    width: 45px;
    height: 45px;
    display: block;
    background-repeat: no-repeat !important;
    background-position: center center !important;
}

.provider a{
    background-color: transparent;
    padding: 0;
    display: block;
    text-decoration: none;
}

.provider .logo{
    float: left;
    margin: 12px 12px;
}

.active.provider .panel{
    border: 1px solid #fca600;
}

.provider .title{
    color: #43434e;
    font-size: 16px;
    font-weight: 500;
    margin: auto 0;
}

.provider .panel{
    display: inline-flex;
    margin-bottom: 0;
    height: 74px;
    border-radius: 0;
    width: 100%;
}

/* product */
.product-list{
    list-style: none;
    margin: 0;
    padding: 0;
}

.product-list .product{
    padding-left: 0;
    margin-bottom: 10px;
}

.product a{
    background-color: transparent;
    padding: 0;
    display: block;
    text-decoration: none;
}

.product .logo{
    float: left;
    font-size: 35px;
    text-align: center;
    width: 45px;
    height: 45px;
    margin: 12px 12px;
}

.active.product .panel{
    border: 1px solid #fca600;
}

.product .title{
    color: #43434e;
    font-size: 16px;
    font-weight: 700;
    margin: auto 10px;
}

.product .panel{
    display: inline-flex;
    margin-bottom: 0;
    height: 74px;
    border-radius: 0;
    width: 100%;
}

/* Amount */

.amount-list{
    list-style: none;
    margin: 0;
    padding: 0;
}

.amount-list .amount{
    padding-left: 0;
    margin-bottom: 10px;
}

.amount a{
    background-color: transparent;
    padding: 0;
    display: block;
    text-decoration: none;
}

.active.amount .panel{
    border: 1px solid #fca600;
}

.amount .price{
    color: #43434e;
    font-size: 16px;
    font-weight: 500;
    margin: auto 0;
}

.amount .data{
    color: #303038;
    padding: 15px 12px;
    width: 100%;
    font-size: 13px;
    margin: auto;
    min-height: 75px;
}

.amount .panel{
    display: inline-flex;
    margin-bottom: 0;
    height: 110px;
    border-radius: 0;
    width: 100%;
}

.typeahead__list {
    max-height: 300px;
    overflow-y: auto;
    overflow-x: hidden;
}
</style>

<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-home"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>LOADING</li>
                </ul>
                <h4><?php echo $type ?></h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    <div class="container" style="margin-top: 20px; padding-bottom:50px;">
        <ul class="nav nav-tabs nav-justified">
            <li class="active"><a data-toggle="tab" href="#eloads">E-Loads</a></li>
            <li><a data-toggle="tab" href="#cardproducts">Card Products</a></li>
        </ul>

        <div class="tab-content" style="padding-bottom:50px;">
            <div id="eloads" class="tab-pane fade in active">
                <hr>
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="phoneNumber" style="text-align: left !important; font-weight: normal;" class="col-sm-3 control-label">Please enter a phone number</label>
                        <div class="col-sm-9">
                            <form id="form-french_v1" name="form-french_v1">
                                <div class="typeahead__container">
                                    <div class="typeahead__field">
                                        <div class="typeahead__query">
                                            <input class="js-typeahead-french_v1" id="phoneNumber" class="form-control" placeholder="Country Code | Phone Number" autocomplete="off">
                                        </div>
                                        <div class="typeahead__button">
                                            <button id="submit-pnumber" type="submit" disabled>
                                                <i class="fa fa-arrow-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group ding-providers" hidden>
                        <label for="providerList" style="text-align: left !important; font-weight: normal;" class="col-sm-3 control-label">Select Operator</label>
                        <div class="col-sm-9 ding-providers-content">
                            <!-- Load Providers -->
                        </div>
                    </div>
                    <div class="form-group ding-products" hidden>
                        <label for="productList" style="text-align: left !important; font-weight: normal;" class="col-sm-3 control-label">Select Product</label>
                        <div class="col-sm-9 ding-products-content">
                            <ul id="productList" class="product-list">
                                <li class="product col-lg-4 active">
                                    <a id="topupAmount" data-toggle="tab" role="tab" href="#">
                                        <div class="panel panel-default">
                                            <div class="logo"><i class="fa fa-mobile"></i></div>
                                            <div class="title">Top-Up</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="product col-lg-4 ">
                                    <a id="dataAmount" data-toggle="tab" role="tab" href="#">
                                        <div class="panel panel-default">
                                            <div class="logo"><i class="fa fa-wifi"></i></div>
                                            <div class="title">Data</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="product col-lg-4 ">
                                    <a id="bundleAmount" data-toggle="tab" role="tab" href="#">
                                        <div class="panel panel-default">
                                            <div class="logo"><i class="fa fa-gift"></i></div>
                                            <div class="title">Bundle</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group ding-amount" hidden>
                        <label for="amountList" style="text-align: left !important; font-weight: normal;" class="col-sm-3 control-label">Select Amount</label>
                        <div class="col-sm-9 ding-amount-content">
                            <!-- Load Amount -->
                        </div>
                    </div>
                    <div class="form-group ding-confirm" hidden>
                        <hr>
                        <center><button id="btnConfirm" style="width: 30%;zoom: 1.3;" class="btn btn-warning form-control" data-toggle="modal" data-target="#ding-modal-summary">LOAD NOW</button></center>
                    </div>
                    <div class="form-group ding-error" hidden>
                        <div class="col-sm-3"></div>
                        <div style="color: red;" class="col-sm-9 ding-error-content">
                            <!-- error message here -->
                        </div>
                    </div>
                </form>
            </div>
            <div id="cardproducts" class="tab-pane fade">
                <h3>Unavailable</h3>
                <p>This feature is still under development.</p>
            </div>
        </div>
    </div> <!-- container -->
</div> <!-- mainpanel -->

<div class="modal" id="ding-modal-summary" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">Edit</span>
                </button>
            </div> -->
        
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="text-center"><strong>TRANSACTION SUMMARY</strong> </h3>
                <h5 class="text-center">Please review the details and click 'PAY NOW' to complete the transaction.</h5>
                <hr>
                <div class="form-horizontal">
                    <div class="form-group">
                        <label style="text-align: left; padding: 5px 5px;" class="col-xs-6 col-md-5 col-md-offset-1 control-label">Phone Number</label>
                        <div class="col-xs-6 col-md-6">
                            <p id="s-phoneNumber" class="form-control-static"></p>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label style="text-align: left; padding: 5px 5px;" class="col-xs-6 col-md-5 col-md-offset-1 control-label">Country</label>
                        <div class="col-xs-6 col-md-6">
                            <p id="s-country" class="form-control-static"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="text-align: left; padding: 5px 5px;" class="col-xs-6 col-md-5 col-md-offset-1 control-label">Operator</label>
                        <div class="col-xs-6 col-md-6">
                            <p id="s-provider" class="form-control-static"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="text-align: left; padding: 5px 5px;" class="col-xs-6 col-md-5 col-md-offset-1 control-label">Product Type</label>
                        <div class="col-xs-6 col-md-6">
                            <p id="s-productType" class="form-control-static"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="text-align: left; padding: 5px 5px;" class="col-xs-6 col-md-5 col-md-offset-1 control-label">Top-Up Details</label>
                        <div class="col-xs-6 col-md-6">
                            <p id="s-topUpDetails" class="form-control-static"></p>
                        </div>
                    </div>
                    <div class="form-group s-validity" hidden>
                        <label style="text-align: left; padding: 5px 5px;" class="col-xs-6 col-md-5 col-md-offset-1 control-label">Validity</label>
                        <div class="col-xs-6 col-md-6">
                            <p id="s-validity" class="form-control-static"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="text-align: left; padding: 5px 5px;" class="col-xs-6 col-md-5 col-md-offset-1 control-label">Amount</label>
                        <div class="col-xs-6 col-md-6">
                            <p id="s-amount" class="form-control-static"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="text-align: left; padding: 5px 5px;" class="col-xs-6 col-md-5 col-md-offset-1 control-label">Phone will receive</label>
                        <div class="col-xs-6 col-md-6">
                            <p id="s-receiveAmount" class="form-control-static"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="text-align: left; padding: 5px 5px;" class="col-xs-6 col-md-5 col-md-offset-1 control-label">Total amount to be paid</label>
                        <div class="col-xs-6 col-md-6">
                            <p id="s-total" class="form-control-static"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <center><button id="btnPayNow" class="btn btn-primary">PAY NOW</button></center>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $.typeahead({
        input: '.js-typeahead-french_v1',
        minLength: 0,
        maxlength: '{{MaxLen}}',
        maxItem: 250,
        hint: true,
        // order: "asc",
        searchOnFocus: true,
        display: ['Prefix','CountryName'],
        template:
            '<span class="row">' +
                '<span class="flag">' +
                    '<img src="https://countryflagsapi.com/svg/{{CountryIso}}">' +
                "</span>" +
                '<span class="country-name" style="font-size: 15px; padding-left: 30px; font-weight: bold;">' +
                    '{{CountryName}}' +
                "</span>" +
                '<span class="pull-right">+{{Prefix}}</span>' +
            "</span>",
        source: {
            country: {
                ajax: {
                    type: "POST",
                    url: "/buy_load/fetch_ding_countries",
                    path: "D.Items",
                }
            }
        },
        callback: {
            onSearch: function(node, query){
                if(query === '')
                {
                    $('.ding-providers').prop('hidden', true);
                    $('.ding-products').prop('hidden', true);
                    $('.ding-amount').prop('hidden', true);
                    $('.ding-confirm').prop('hidden', true);
                    $('.ding-error').prop('hidden', true);
                }
            },
            onClickAfter: function(node, a, item, event){
                $('.js-typeahead-french_v1').val(item.Prefix);
                if(item.CountryIso === 'US' || item.CountryIso === 'CA')
                {
                    $('.js-typeahead-french_v1').val('1');
                }

                $('#submit-pnumber').prop('disabled', null);

            },
            onSubmit: function (node, a, item, event) {
                event.preventDefault();
                if($('.js-typeahead-french_v1').val() === ''){
                    alert('Please select Country');
                    return false;
                }
                else{
                    var phone_number = $('.js-typeahead-french_v1').val();

                    $.ajax({
                        url: "/buy_load/fetch_ding_providers",
                        method: "POST",
                        data: { 
                            countryiso : item.CountryIso,
                            phone_number: phone_number
                        },
                        beforeSend: function() {
                            $('.ding-providers').prop('hidden', null);
                            $('.ding-providers-content').html('<center>Detecting Operator...</center>');
                            // $('.ding-providers').prop('hidden', true);
                            $('.ding-products').prop('hidden', true);
                            $('.ding-amount').prop('hidden', true);  
                            $('.ding-confirm').prop('hidden', true);  
                            $('.ding-error').prop('hidden', true);  
                        },
                        success: function (response) { 
                            $('.ding-providers').prop('hidden', null);
                            $('.ding-products').prop('hidden', null);
                            $('.ding-amount').prop('hidden', null);
                            $('.ding-providers-content').html(response);

                            var providerCode = $('#providerList > li.provider.active').data('provider');

                            if(providerCode)
                            {
                                $.ajax({
                                    url: "/buy_load/fetch_ding_plan_codes",
                                    method: "POST",
                                    data: { 
                                        provider_code : providerCode
                                    },
                                    beforeSend: function() {
                                        $('.ding-amount-content').html('<center>Checking available amount...</center>');    
                                    },
                                    success: function (response) { 
                                        $('.ding-amount').prop('hidden', null);
                                        $('.ding-amount-content').html(response);
                                        $('.topup-amount').prop('hidden',null);

                                        $('#btnConfirm').on('click', function(){
                                            var provider = $('#providerList .active .title').text();
                                            var productType = $('#amountList .data').data('type');
                                            var skucode = $('#amountList .data').data('skucode');
                                            var topUpDetails = $('#amountList .active .receive-amount>strong').text();
                                            var validity = $('#amountList .active .validity-period>span').text();
                                            var sendAmount = $('#amountList .active .price').data('send');
                                            var receiveAmount = $('#amountList .active .price').data('receive');
                                            var receiveCurr = $('#amountList .active .price').data('receivecurr');
                                            var sendCurr = $('#amountList .active .price').data('sendcurr');

                                            if(validity)
                                            {
                                                $('.s-validity').prop('hidden',null);
                                            }
                                            else
                                            {
                                                $('.s-validity').prop('hidden',true);
                                            }

                                            $('#s-phoneNumber').text(phone_number);
                                            $('#s-country').text(item.CountryName);
                                            $('#s-provider').text(provider);
                                            $('#s-productType').text(productType);
                                            $('#s-topUpDetails').text(topUpDetails);
                                            $('#s-validity').text(validity);
                                            $('#s-amount').text(sendCurr+' '+sendAmount);
                                            $('#s-receiveAmount').text(receiveCurr+' '+Number(receiveAmount).toFixed(2));
                                            $('#s-total').text(sendCurr+' '+sendAmount);
                                        });
                                    },
                                    error: function () {
                                    },
                                });
                            }
                            else if(providerCode === undefined)
                            {
                                $('.ding-providers').prop('hidden', true);
                                $('.ding-products').prop('hidden', true);
                                $('.ding-amount').prop('hidden', true);
                                $('.ding-confirm').prop('hidden', true);
                                $('.ding-error').prop('hidden', null);
                                $('.ding-error-content').html('Please provide valid phone number.');   
                            }
                        },
                        error: function () {
                        },
                    });
                }
            }
        },
    }); 
});


$('#ding-modal-summary').on('click','#btnPayNow', function(){
    var provider = $('#providerList .active .title').text();
    var productType = $('#amountList .data').data('type');
    var skucode = $('#amountList .data').data('skucode');
    var topUpDetails = $('#amountList .active .receive-amount>strong').text();
    var validity = $('#amountList .active .validity-period>span').text();
    var sendAmount = $('#amountList .active .price').data('send');
    var receiveAmount = $('#amountList .active .price').data('receive');
    var receiveCurr = $('#amountList .active .price').data('receivecurr');
    var sendCurr = $('#amountList .active .price').data('sendcurr');
    var phone_number = $('.js-typeahead-french_v1').val();

    $.confirm({
        title: "<i class=''></i>",
        content: ''+
            '<form>' +
            '<div class="form-group">' +
            '<label>Transaction Password</label>' +
            '<input type="password" placeholder="Input Transaction Password" class="password form-control"/>' +
            '</div>' +
            '</form>',
        buttons: {
            formSubmit: {
                text: "Submit",
                btnClass: "btn-blue",
                keys: ["enter"],
                action: function () {
                    var pass = this.$content.find(".password").val();

                    if (!pass) {
                        $.alert("Please input transaction password!");
                        return false;
                    }

                    var params = {
                        category: 'E-Loads',
                        operator: provider,
                        plancode: topUpDetails,
                        skucode: skucode,
                        wallet_currency: sendCurr,
                        load_amount: receiveAmount,
                        converted_amount: sendAmount,
                        discounted_amount: sendAmount,
                        debited_amount: sendAmount,
                        mobile_number: phone_number,
                        transpass: pass
                    }

                    $.ajax({
                        url: "/buy_load/transac_ding",
                        method: "POST",
                        data: params,
                        success: function (response) { 
                            var res = JSON.parse(response)
                            
                            if(res.S === 1)
                            {
                                $.alert('Thank you for using Unified Loading service! <br>' + receiveCurr + ' ' + Number(params.load_amount).toFixed(2) + ' has been successfully loaded to ' + params.mobile_number + '. Tracking number: ' + res.TN);
                                $('.js-typeahead-french_v1').val('');
                                $('.ding-providers').prop('hidden', true);
                                $('.ding-products').prop('hidden', true);
                                $('.ding-amount').prop('hidden', true);
                                $('.ding-confirm').prop('hidden', true);
                                $('#ding-modal-summary').modal('hide');
                                $('.modal-backdrop').removeClass();
                            }
                            else
                            {
                                $.alert(res.M);
                                return false;
                            }
                        },
                        error: function () {
                        },
                    });
                },
            },
            cancel: function () {},
        },
    });
});
</script>