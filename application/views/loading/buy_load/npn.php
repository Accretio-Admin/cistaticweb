<div class="mainpanel">
  <div class="pageheader">
    <div class="media">
      <div class="pageicon pull-left">
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

            <div style="padding-bottom: 10px;">
              <select 
                class="form-control" 
                name="inputCountryCode" 
                id="inputCountryCode" 
                required
              >
                <option value="" disabled selected>--CHOOSE COUNTRY CODE--</option> 

                <?php foreach ($countries as $row): ?>
                  <option value="<?php echo $row['iso_code'] ?>">
                    <?php echo $row['cname'] ?>
                  </option> 
                <?php endforeach ?>
              </select>
            </div>

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
  </div>

  <div class="modal fade" id="transacSummModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="form-group">
        <form name="formPaymentSumm" id="formPaymentSumm">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalLabel">
                Transaction Summary
              </h5>
            </div>
            
            <div class="modal-body">
              <div class="row gy-5">
                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                  <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; font-size: 15px;">
                      Mobile Number:
                    </span>
                  </div>

                  <div style="margin-bottom: 10px;">
                    <span style="font-size: 15px;" id="summMobileNumber">
                  </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                  <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; font-size: 15px;">
                      Loading Type:
                    </span>
                  </div>

                  <div style="margin-bottom: 10px;">
                    <span style="font-size: 15px;" id="summType">
                  </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                  <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; font-size: 15px;">
                      Operator:
                    </span>
                  </div>

                  <div style="margin-bottom: 10px;">
                    <span style="font-size: 15px;" id="summOperator">
                  </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                  <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; font-size: 15px;">
                      Product Code:
                    </span>
                  </div>

                  <div style="margin-bottom: 10px;">
                    <span style="font-size: 15px;" id="summProductCode">
                  </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                  <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; font-size: 15px;">
                      Amount:
                    </span>
                  </div>

                  <div style="margin-bottom: 10px;">
                    <span style="font-size: 15px;" id="summAmount">
                  </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                  <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; font-size: 15px;">
                      Wallet Currency:
                    </span>
                  </div>

                  <div style="margin-bottom: 10px;">
                    <span style="font-size: 15px;" id="summCurrency">
                  </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                  <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; font-size: 15px;">
                      Converted Amount:
                    </span>
                  </div>

                  <div style="margin-bottom: 10px;">
                    <span style="font-size: 15px;" id="summConvertedAmount">
                  </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                  <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; font-size: 15px;">
                      Amount Due:
                    </span>
                  </div>

                  <div style="margin-bottom: 10px;">
                    <span style="font-size: 15px;" id="summAmountDue">
                  </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                  <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; font-size: 15px;">
                      Discounted Amount:
                    </span>
                  </div>

                  <div style="margin-bottom: 10px;">
                    <span style="font-size: 15px;" id="summDiscountAmount">
                  </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                  <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; font-size: 15px;">
                      Transaction Password:
                    </span>
                  </div>

                  <div style="margin-bottom: 10px;">
                    <input
                      type="password"
                      class="form-control" 
                      id="summTransacPass" 
                      autocomplete="off"
                      required 
                    />
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Cancel
              </button>

              <button type="submit" class="btn btn-primary">
                Confirm
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  var products = []
  var providers = []

  $('#inputLoadCategory').change(() => {
    $('#formChooseCountry').show()
    $('#searchLoad').show()

    $('#inputCountryCode').val('')
    $('#inputMobileNo').val('')

    $('#inputMobileNo').attr('type', 'hidden')
    $('#searchLoad').attr('disabled', 'disabled')

    $('#formPlanCodes').hide()
    $('#formCardProducts').hide()
  })

  $('#inputCountryCode').change(() => { 
    $('#formPlanCodes').hide()
    $('#inputMobileNo').val('')

    $('#inputMobileNo').removeAttr('type')
    $('#searchLoad').show()
    $('#searchLoad').removeAttr('disabled', 'disabled')
  })

  $('#inputMobileNo').change(() => {
    $('#searchLoad').show()
    $('#formPlanCodes').hide()
    $('#formCardProducts').hide()
    $('#inputMobileNo').val() !== '' ? $('#searchLoad').removeAttr('disabled') : $('#searchLoad').attr('disabled', 'disabled')
  })

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

    var Fproducts = products.find(el => el.product_code == $('#inputPlanCode').val())
    
    const { 
      product_name, 
      product_code,
      max_amount,
      min_amount,
      amount,
      operator,
      discounted_amount,
    } = Fproducts

    const mobileNumber = $('#inputMobileNo').val()
    const loadingType = $('#inputCountryCode').val() == 'PH' ? 'Local E-Loads' : 'International E-Loads'

    $('#summMobileNumber').html(mobileNumber)
    $('#summType').html(loadingType)
    $('#summOperator').html(operator)
    $('#summProductCode').html(product_code)
    $('#summCurrency').html('SGD')
    $('#summAmount').html(parseFloat(amount).toFixed(2))
    $('#summConvertedAmount').html(parseFloat(amount).toFixed(2))
    $('#summDiscountAmount').html(parseFloat(discounted_amount).toFixed(2))
    $('#summAmountDue').html(parseFloat(amount).toFixed(2))
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
      type: 'POST',
      data: params,
      url: '/buy_load/fetch_npn_plan_codes',
      success: ((data) => {
        var jsonData = JSON.parse(data)

        if (jsonData.S == 1) {
          products = jsonData.D

          $('#searchLoad').hide()
          $('#formPlanCodes').show()

          $('#inputPlanCode').empty().append($("<option>", {
            value: '',
            text: '--CHOOSE PLAN CODE--',
          }).prop({ 'disabled': true, 'selected': true }))

          $.each(products, (i, item) => {
            $('#inputPlanCode').append($('<option>', { 
              value: item.product_code,
              text : item.product_name 
            }))
          })
        } else {
          $('.divAlert').html('<div class="alert alert-danger alert-dismissible" role="alert">' +                
            '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + jsonData.M + '</div>')
        }

        waitingDialog.hide()
      })
    })
  }

  function anypayLoadNow () {
    waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'})

    var Fproducts = products.find(el => el.product_code == $('#inputPlanCode').val())
    
    const { 
      action_id, 
    } = Fproducts

    var params = {
      category: $('#inputLoadCategory').val() == 'e-loads' ? 'E-Loads' : 'Card Products',
      operator: $('#summOperator').html(),
      plancode: $('#summProductCode').html(),
      skucode: $('#inputPlanCode').val(),
      action_id: action_id,
      wallet_currency: $('#summCurrency').html(),
      load_amount: $('#summAmount').html(),
      converted_amount: $('#summConvertedAmount').html(),
      discounted_amount: $('#summDiscountAmount').html(),
      debited_amount: $('#summDiscountAmount').html(),
      mobile_number: $('#inputMobileNo').val(),
      transpass: $('#summTransacPass').val()
    }

    $.ajax({
      type: 'POST',
      data: params, 
      url: '/buy_load/transac_ding',
      success: ((data) => {
        var jsonData = JSON.parse(data)

        if (jsonData.S == 1) {
          $('.divAlert').html('<div class="alert alert-success alert-dismissible" role="alert">'+                
            '<a href="#" class="close" data-dismiss="alert" aria-label="close" target="_blank">&times;</a>Thank you for using Unified Loading service! ' + params.load_amount +  ' has been successfully loaded to ' + params.mobile_number + '. Tracking number: ' + jsonData.TN + '<a/></div>')

          clearFields()
        } else {
          $('.divAlert').html('<div class="alert alert-danger alert-dismissible" role="alert">' +                
            '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + jsonData.M + '</div>')
        } 

        $("#transacSummModal").modal('hide')
        waitingDialog.hide()
      })
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