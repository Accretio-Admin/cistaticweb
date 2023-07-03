<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
    #fields {
        width: 50%;
        margin-left:25%;
        margin-right:25%;
    }

    .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus{
        border-left: 0;
        color: #000 !important;
        background-color: #fff !important;
        border-top: solid 10px #fca600 !important;
    }

    .typeahead__field, #productItem, #amount{
        max-height: 250px;
        font-size: 1.5rem;
    }

    .flag img {
        height: 26px;
        width: 26px;
    }

    #form-french_v1 .typeahead__list {
        max-height: 300px;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .col-sm {
        padding-bottom: 5px;
    }

    #formCardProducts,
    #formPhoneNumber,
    #formPlanCodes,
    #formProductDetails,
    #formProductSubmit {
        display: none;
    }

    #description,
    #t-desc {
        resize: none;
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
    <div class="contentpanel">
      <div class="row row-stat">
        <div id="fields">
            <div class='divAlert'></div>
            <form id="formId" class="form-horizontal">
                <div class="form-group" style="" name="formLoadCategory"  id="formLoadCategory">
                    <div class="col-sm">
                        <div>
                            <select class="form-control" name="loadCategory" id="loadCategory" required >
                                <option value="" disabled selected>--CHOOSE LOAD CATEGORY--</option> 
                                <option value="e-loads">E-LOAD</option>
                                <option value="card-products">CARD PRODUCTS</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group" name="formCardProducts"  id="formCardProducts">
                    <div class="col-sm">
                        <select class="form-control" name="inputCardProduct" id="inputCardProduct" required>
                            <option value="" disabled selected>--CHOOSE CARD PRODUCTS--</option>
                            <option value="PIN">PIN</option>
                            <option value="APIPIN">APIPIN</option>
                            <option value="E-VOUCHER">E-VOUCHER</option>
                        </select>
                    </div>
                </div>
                <div class="form-group" name="formPhoneNumber" id="formPhoneNumber">
                    <div class="col-sm">
                        <input class="form-control" id="phoneNumber" type="text" placeholder="MOBILE NUMBER" autocomplete="off" required>
                    </div>
                </div>
                <div class="form-group" name="formPlanCodes" id="formPlanCodes">
                    <div class="col-sm">
                        <select class="form-control" name="inputPlanCode" id="inputPlanCode" required>
                            <option value="" disabled selected>--CHOOSE PLAN CODE--</option> 
                        </select>
                    </div>
                </div>
                <div id="formProductDetails">
                    <div class="form-group">
                            <input class="form-control" id="amount" type="text" readonly>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="description" cols="30" rows="10" readonly></textarea>
                    </div>
                </div>
                <div class="form-group" align="right" id="formProductSubmit">
                    <input class="btn btn-primary" type="submit" value="Load Now" id="confirmBtn" style="width: 150px;" data-toggle="modal" data-target="#npn-transaction-summary" disabled>
                </div>
            </form>
        </div>
      </div>
    </div> <!-- contentpanel -->
</div> <!-- mainpanel -->

<div class="modal" id="npn-transaction-summary" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">  
                <div class="modal-header">
                    <button type="button" id="closeModal" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="text-center"><strong>TRANSACTION SUMMARY</strong> </h3>
                    <h5 class="text-center">Please review the details and click 'PAY NOW' to complete the transaction.</h5>
                </div>
                <form>      
                    <div class="modal-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label style="text-align: left; padding: 5px 5px;" class="col-xs-6 col-md-5 col-md-offset-1 control-label">Phone Number</label>
                                <div class="col-xs-6 col-md-6">
                                    <input class="form-control" id="t-phoneNumber" type="text" style="width: 250px;" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label style="text-align: left; padding: 5px 5px;" class="col-xs-6 col-md-5 col-md-offset-1 control-label">Operator</label>
                                <div class="col-xs-6 col-md-6">
                                    <input class="form-control" id="t-operator" type="text" style="width: 250px; text-align:left;"  disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label style="text-align: left; padding: 5px 5px;" class="col-xs-6 col-md-5 col-md-offset-1 control-label">Plan Code</label>
                                <div class="col-xs-6 col-md-6">
                                    <input class="form-control" id="t-plancode" type="text" style="width: 250px; text-align:left;"  disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label style="text-align: left; padding: 5px 5px;" class="col-xs-6 col-md-5 col-md-offset-1 control-label">Amount</label>
                                <div class="col-xs-6 col-md-6">
                                    <input class="form-control" id="t-amount" type="text" style="width: 250px;" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label style="text-align: left; padding: 5px 5px;" class="col-xs-6 col-md-5 col-md-offset-1 control-label">Description</label>
                                <div class="col-xs-6 col-md-6">
                                    <textarea class="form-control" id="t-desc" style="width: 250px; height: 120px; font-size: 1.2rem;" disabled></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label style="text-align: left; padding: 5px 5px;" class="col-xs-6 col-md-5 col-md-offset-1 control-label">Transaction Password</label>
                                <div class="col-xs-6 col-md-6">
                                    <input class="form-control" id="transpass" type="password" style="width: 250px;" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            <div class="modal-footer">
                <button id="btnNpnPayNow" class="btn btn-primary">PAY NOW</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var items, action_id, productCategory, operator, plancode, productCode, amount, cost, desc, phoneNumber

    $('#loadCategory').change((e) => {
        e.preventDefault()
        if ($('#loadCategory').val() == 'e-loads') {
            getPlanCodes('E-LOAD FIX DENO')
            $('#formCardProducts').hide()
            $('#inputCardProduct').val('')
        } else {
            $('#formProductDetails').hide()
            $('#formPlanCodes').hide()
            $('#formCardProducts').show()
            $('#formPhoneNumber').hide()
            $('#formProductSubmit').hide() 
        }

        $('#inputCardProduct').change(() => {
            getPlanCodes( $('#inputCardProduct').val());
        })

        $('#phoneNumber').on('keyup', function (event) { 
            $(this).val().length < 5 ? $('#confirmBtn').prop('disabled', true) : $('#confirmBtn').prop('disabled', false)
        })
        
        $('#phoneNumber').on('keypress', function (event) { 
            var regex = new RegExp("^[0-9]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) { // Input number only
                return false;
            }
        })

        $('#phoneNumber').on('paste', function (event) { // Pasting only numbers, cannot paste combined number and character
            if (event.originalEvent.clipboardData.getData('Text').match(/[^\d]/)) {
                event.preventDefault();
            }
        });
    })
    function displayForm() {
        $('#formPhoneNumber').show()
        $('#formPlanCodes').show()
        $('#formProductDetails').show()
        $('#formProductSubmit').show()
        $('#amount').val('')
        $('#description').val('')
        $('#phoneNumber').show().val('').focus()
        $('#confirmBtn').prop('disabled', true)
    }
    function getPlanCodes(category){
        var params = {
            category: category,
        }

        waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'})
        $.ajax({
            type    : 'POST',
            data    : params,
            url     : '/buy_load/fetch_npn_plan_codes',
            success : ((data) => {
                var jsonData = JSON.parse(data)

                if (jsonData.S == 1) {
                    products = jsonData.D

                    // console.log('Fetch Product', jsonData) // Fetch Product Details
                    $('#inputPlanCode').empty().append($("<option>", {
                        value: '',
                        text : '--CHOOSE PLAN CODE--',
                    }).prop({ 'disabled': true, 'selected': true }))

                    $.each(products, (i, item) => {
                        $('#inputPlanCode').append($('<option>', { 
                        value: item.code,
                        text : item.operator + " " + item.product_name
                        }))
                    })
                    $('#alertResponse').fadeOut(500)
                    displayForm()
                } else {
                    $('.divAlert').html('<div class="alert alert-danger alert-dismissible" id="alertResponse" role="alert">' +                
                    '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + jsonData.M + '</div>')
                    $('#formPlanCodes').hide()
                    $('#formProductDetails').hide()
                    $('#formProductSubmit').hide()
                    $('#phoneNumber').hide()
                }

                waitingDialog.hide()
                
            })
        })
    }

    $(document).ready(function() {
        $('#inputPlanCode').on('change', function(){
            var selVal = $('#inputPlanCode option:selected').text()
            $.ajax({
                url     : "/Buy_load/fetch_npn_data",
                type    : "post",
                data    : {'selVal':selVal},
                datatype: 'json',
                success : function(data){
                    items           = JSON.parse(data)
                    action_id       = items[0]['action_id']
                    productCategory = items[0]['category']
                    operator        = items[0]['operator']
                    plancode        = items[0]['product_name']
                    productCode     = items[0]['product_code']
                    amount          = items[0]['amount']
                    cost            = items[0]['cost']
                    desc            = items[0]['product_description']
                    
                    $('#amount').val(amount)
                    if(desc.length === 0) {
                        $('#description').val(operator + ' ' + plancode)
                    } else {
                        $('#description').val(desc)
                    }
                }
            })
        })

        $('#confirmBtn').on('click', function(e){
            e.preventDefault()
            phoneNumber = $('#phoneNumber').val().trim()
            var selVal = $('#inputPlanCode option:selected').text()

            if(!phoneNumber || selVal == '--CHOOSE PLAN CODE--')
            {
                $.alert("Please complete necessary fields")
                return false
            }

            $('#npn-transaction-summary #t-phoneNumber').val(phoneNumber)
            $('#npn-transaction-summary #t-operator').val(operator)
            $('#npn-transaction-summary #t-plancode').val(plancode)
            $('#npn-transaction-summary #t-amount').val(amount)
            if(desc.length === 0) {
                $('#npn-transaction-summary #t-desc').val(operator + ' ' + plancode)
            } else {
                $('#npn-transaction-summary #t-desc').val(desc)
            }
            
        })

        $('#btnNpnPayNow').on('click', function(){
            var transpass = $('#npn-transaction-summary #transpass').val()
            
            if(!transpass)
            {
                $.alert("Please input transaction password!")
                return false
            }

            var params = {
                'action_id'         : action_id,
                'productCategory'   : productCategory,
                'phoneNumber'       : phoneNumber,
                'operator'          : operator,
                'plancode'          : plancode,
                'productCode'       : productCode,
                'amount'            : amount,
                'cost'              : cost,        
                'transpass'         : transpass
            }

            // console.log('PayNow Data', params)  // Transaction Data
            $.ajax({
                url     : "/Buy_load/transac_npn",
                type    : "post",
                data    : params,
                datatype: 'json',
                success : function(data){
                    var response = JSON.parse(data)
                    $.alert(response.M)
                }
            })
        })

        $('#npn-transaction-summary').on('hidden.bs.modal', function (e) {
            $('#t-operator').val('')
            $('#t-plancode').val('')
            $('#amount').val('')
            $('#description').val('')
            $('#transpass').val('')
            $('#inputPlanCode').val('').focus()
        })
    })
</script>