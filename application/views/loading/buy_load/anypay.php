<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left" >
                <i class="fa fa-money"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li>
                        <a href="<?php echo BASE_URL('/Main')?>">
                        <i class="glyphicon glyphicon-home"></i>
                        </a>
                    </li>
                    <li>LOADING</li>
                </ul>
                <h4><?php echo $type ?></h4>
            </div>
        </div>
    </div>
    <div class="contentpanel" style="padding-bottom: 0px;">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div class='divAlert'></div>
                <div class="form-group">
                    <form>
                        <div style="padding-bottom: 10px;">
                            <select class="form-control" name="inputLoadCategory" id="inputLoadCategory" required>
                                <option value="" disabled selected>--CHOOSE LOAD CATEGORY--</option> 
                                <option value="e-loads">E-Loads</option>
                                <option value="card-products">Card Products</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="form-group" id="formChooseCountry" style="display: none;">
                    <form name="formSearch" id="formSearch">
                        <input id="buyloadType" name="buyloadType" type="hidden" value="<?php echo $type?>"/>
                        <!-- <div style="padding-bottom: 10px;">
                            <select class="form-control" name="inputCountryCode" id="inputCountryCode" required>
                                <option value="" disabled selected>--CHOOSE COUNTRY CODE--</option> 
                                <option value="MYR">Malaysia</option> 
                                <?php foreach ($countries as $row): ?>
                                <option value="<?php echo $row['iso_code'] ?>">
                                <?php echo $row['cname'] ?>
                                </option> 
                                <?php endforeach ?>
                            </select>
                        </div> -->
                        <div style="padding-bottom: 10px;">
                            <input 
                                class="form-control" 
                                id="inputMobileNo" 
                                type="hidden"
                                placeholder="MOBILE NUMBER"
                                title="Please input valid mobile number." 
                                autocomplete="off"
                                pattern="^[0-9]*$" 
                                required 
                            />
                        </div>
                        <div align="right">
                            <button type="submit" class="btn btn-success" id="searchLoad" disabled>
                                Search
                            </button>
                        </div>
                    </form>

                    <form name="formCardProducts" id="formCardProducts" style="display: none;">
                        <div style="padding-bottom: 10px;">
                            <select class="form-control" name="inputCardProduct" id="inputCardProduct" required>
                                <option value="" disabled selected>--CHOOSE CARD PRODUCTS--</option> 
                                <option value="GAMING PIN">Game Cards</option>
                                <option value="INTERNET DATA PLAN">Satellite</option>
                                <option value="MOBILE PIN">Call Cards</option>
                                <option value="OTHERS">Others</option>
                            </select>
                        </div>
                    </form>

                    <form name="formPlanCodes" id="formPlanCodes" style="display: none;">
                        <div style="padding-bottom: 10px;">
                            <select class="form-control" name="inputPlanCode" id="inputPlanCode" required>
                                <option value="" disabled selected>--CHOOSE PLAN CODE--</option> 
                            </select>
                        </div>
                        <div align="right">
                            <button type="submit" class="btn btn-primary">
                                Load Now
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
    </div> <!-- contentpanel -->
</div> <!-- mainpanel -->

<div class="modal in" id="transacSummModal" role="dialog">
    <div class="modal-dialog" role="document">
        <form name="formPaymentSumm" id="formPaymentSumm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" id="closeModal" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="text-center"><strong>TRANSACTION SUMMARY</strong> </h3>
                    <h5 class="text-center">Please review the details and click 'PAY NOW' to complete the transaction.</h5>
                </div> <!-- Modal Header -->
                <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label style="text-align: left; padding: 5px 5px;" class="col-xs-6 col-md-5 col-md-offset-1 control-label">Mobile Number</label>
                            <div class="col-xs-6 col-md-6">
                                <input class="form-control" id="summMobileNumber" style="width: 100%;" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label style="text-align: left; padding: 5px 5px;" class="col-xs-6 col-md-5 col-md-offset-1 control-label">Loading Type</label>
                            <div class="col-xs-6 col-md-6">
                                <input class="form-control" id="summType" style="width: 100%;" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label style="text-align: left; padding: 5px 5px;" class="col-xs-6 col-md-5 col-md-offset-1 control-label">Operator</label>
                            <div class="col-xs-6 col-md-6">
                                <input class="form-control" id="summOperator" style="width: 100%;" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label style="text-align: left; padding: 5px 5px;" class="col-xs-6 col-md-5 col-md-offset-1 control-label">Product Code</label>
                            <div class="col-xs-6 col-md-6">
                                <input class="form-control" id="summProductCode" style="width: 100%;" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label style="text-align: left; padding: 5px 5px;" class="col-xs-6 col-md-5 col-md-offset-1 control-label">Amount</label>
                            <div class="col-xs-6 col-md-6">
                                <input class="form-control" id="summAmount" style="width: 100%;" disabled>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label style="text-align: left; padding: 5px 5px;" class="col-xs-6 col-md-5 col-md-offset-1 control-label">Wallet Currency</label>
                            <div class="col-xs-6 col-md-6">
                                <input class="form-control" id="summCurrency" style="width: 100%;" disabled>
                            </div>
                        </div> -->
                        <!-- <div class="form-group">
                            <label style="text-align: left; padding: 5px 5px;" class="col-xs-6 col-md-5 col-md-offset-1 control-label">Converted Amount</label>
                            <div class="col-xs-6 col-md-6">
                                <input class="form-control" id="summConvertedAmount" style="width: 100%;" disabled>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label style="text-align: left; padding: 5px 5px;" class="col-xs-6 col-md-5 col-md-offset-1 control-label">Amount Due</label>
                            <div class="col-xs-6 col-md-6">
                                <input class="form-control" id="summAmountDue" style="width: 100%;" disabled>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label style="text-align: left; padding: 5px 5px;" class="col-xs-6 col-md-5 col-md-offset-1 control-label">Discounted Amount</label>
                            <div class="col-xs-6 col-md-6">
                                <input class="form-control" id="summDiscountAmount" style="width: 100%;" disabled>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label style="text-align: left; padding: 5px 5px;" class="col-xs-6 col-md-5 col-md-offset-1 control-label">Transaction Password</label>
                            <div class="col-xs-6 col-md-6">
                                <input class="form-control" type="password" id="summTransacPass" autocomplete="off" required  style="width: 100%;">
                            </div>
                        </div>
                    </div>
                </div> <!-- Modal Body -->
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="btnNpnPayNow">
                            PAY NOW
                        </button>
                    </div>
                </div> <!-- Modal Footer -->
            </div> <!-- Modal Content -->
        </form>
    </div>
</div> <!-- Modal -->

<script>
  var products = []
  var providers = []
  var operator_h, plancode_h, wallet_currency_h, load_amount_h, converted_amount_h, discounted_amount_h, debited_amount_h

    $('#inputLoadCategory').change((e) => {
        e.preventDefault()
        $('#formChooseCountry').show()
        $('#searchLoad').show()
        $('#searchLoad').prop('disabled', true)

        $('#inputCountryCode').val('')
        $('#inputMobileNo').val('')

        $('#inputMobileNo').removeAttr('type')
        $('#searchLoad').show()

        $('#formPlanCodes').hide()
        $('#formCardProducts').hide()

        $('#inputMobileNo').focus()
        $('#inputMobileNo').on('keyup',function(){
            $(this).val().length < 5 ? $('#searchLoad').prop('disabled', true) : $('#searchLoad').prop('disabled', false)
        })
        $('#alertResponse').fadeOut(500)
    })

    // $('#inputCountryCode').change(() => { 
    //   $('#formPlanCodes').hide()
    //   $('#inputMobileNo').val('')

    //   $('#inputMobileNo').removeAttr('type')
    //   $('#searchLoad').show()
    //   $('#searchLoad').removeAttr('disabled', 'disabled')
    // })

    $('#inputMobileNo').change(() => {
        $('#searchLoad').show()
        $('#formPlanCodes').hide()
        $('#formCardProducts').hide()
    })

    $('#inputMobileNo').on('keypress', function (event) {
        var regex = new RegExp("^[0-9]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) { // Input number only
        return false;
        }
    })

    $('#inputMobileNo').on('paste', function (event) { // Pasting only numbers, cannot paste combined number and character
        if (event.originalEvent.clipboardData.getData('Text').match(/[^\d]/)) {
            event.preventDefault();
        }
    });

    $('#formSearch').submit((e) => {
        e.preventDefault()

        $('#inputPlanCode').val('')
        
        if ($('#inputLoadCategory').val() == 'e-loads') {
            getPlanCodes('PREPAID MOBILE')
        } else {
            $('#searchLoad').hide()
            $('#inputCardProduct').val('')
            $('#formCardProducts').show()
        }
    })

    $('#inputCardProduct').change((e) => {
        getPlanCodes($('#inputCardProduct').val())
    })

    $('#formPlanCodes').submit((e) => {
        e.preventDefault()

        $("#transacSummModal").modal('show')

        var Fproducts = products.find(el => el.code == $('#inputPlanCode').val())
        // console.log('Fetch Products', Fproducts); // Fetch Product Details
        const { 
            product_name, 
            product_code,
            max_amount,
            min_amount,
            amount,
            operator,
        } = Fproducts

        const mobileNumber = $('#inputMobileNo').val()
        const loadingType = $('#inputCountryCode').val() == 'PH' ? 'Local E-Loads' : 'International E-Loads'

        // Modal Summary Transaction Values
        $('#summMobileNumber').val(mobileNumber)
        $('#summType').val(loadingType)
        $('#summOperator').val(operator)
        $('#summProductCode').val(product_code)
        // $('#summCurrency').val('MYR')
        $('#summAmount').val(parseFloat(amount).toFixed(2))
        // $('#summConvertedAmount').val(parseFloat(amount).toFixed(2))
        // $('#summDiscountAmount').val(parseFloat(amount).toFixed(2))
        $('#summAmountDue').val(parseFloat(amount).toFixed(2))

        // Transaction Details
        operator_h          = operator
        plancode_h          = product_code
        wallet_currency_h   = 'MYR'
        load_amount_h       = parseFloat(amount).toFixed(2)
        converted_amount_h  = parseFloat(amount).toFixed(2)
        discounted_amount_h = parseFloat(amount).toFixed(2)
        debited_amount_h    = parseFloat(amount).toFixed(2)

        $('#transacSummModal').on('hidden.bs.modal', function (e) {
            $('#inputPlanCode').val('').focus()
        })
    })

    $('#formPaymentSumm').submit((e) => {
        e.preventDefault()
        anypayLoadNow()
    })

    function getPlanCodes (category) {
        waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'})

        var params = {
        category: category,
        }

        $.ajax({
        type    : 'POST',
        data    : params,
        url     : '/buy_load/fetch_anypay_plan_codes',
        success : ((data) => {
                var jsonData = JSON.parse(data)

                if (jsonData.S == 1) {
                    products = jsonData.D
                    $('#searchLoad').hide()
                    $('#formPlanCodes').show()

                    $('#inputPlanCode').empty().append($("<option>", {
                        value: '',
                        text : '--CHOOSE PLAN CODE--',
                    }).prop({ 'disabled': true, 'selected': true }))

                    $.each(products, (i, item) => {
                        $('#inputPlanCode').append($('<option>', { 
                        value: item.code,
                        text : item.product_name 
                        }))
                    })
                    console.log('plancode', $('#inputPlanCode').val());
                    $('#alertResponse').fadeOut(500)
                } else {
                    $('.divAlert').html('<div class="alert alert-danger" id="alertResponse" alert-dismissible" role="alert">' +                
                    '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + jsonData.M + '</div>')
                    $('#formPlanCodes').hide()
                }
                waitingDialog.hide()
            })
        })
    }

    function anypayLoadNow () {
        var transpass = $('#summTransacPass').val()
        if(!transpass) {
            $.alert("Please input transaction password!")
            return false
        }

        var params = {
            category          : $('#inputLoadCategory').val() == 'e-loads' ? 'E-Loads' : 'Card Products',
            operator          : operator_h,
            plancode          : plancode_h,
            skucode           : $('#inputPlanCode').val(),
            wallet_currency   : wallet_currency_h,
            load_amount       : load_amount_h,
            converted_amount  : converted_amount_h,
            discounted_amount : discounted_amount_h,
            debited_amount    : debited_amount_h,
            mobile_number     : $('#inputMobileNo').val().trim(),
            transpass         : $('#summTransacPass').val()
        }
        
        // console.log('anypayLoadNow', params); // Transaction Data
        $.ajax({
            type    : 'POST',
            data    : params, 
            url     : "/buy_load/transac_anypay",
            datatype: 'json',
            success : function(data){
                var response = JSON.parse(data)
                if (response.S == 1) {
                    $.alert(response.M)
                    clearFields()
                } else {
                    $.alert(response.M)
                }
            }
        })
    }

    function clearFields () {
        $('#inputLoadCategory').val('')
        $('#inputCountryCode').val('')
        $('#inputMobileNo').val('')
        $('#inputPlanCode').val('')
        $('#summTransacPass').val('')
        $('#inputCardProduct').val('')
        $('#formChooseCountry').hide()
        $('#formPlanCodes').hide()
        $('#formCardProducts').hide()
        $('#inputMobileNo').attr('type', 'hidden')
    }
</script>