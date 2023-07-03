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
              </select>
            </div>
          </form>
        </div>

        <div class="form-group" id="eLoadForm" style="display: none;">
          <form name="formEloadSearchAmount" id="formEloadSearchAmount">
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
                id="inputEloadMobileNumber" 
                type="hidden"
                placeholder="MOBILE NUMBER"
                title="Please input valid mobile number." 
                autocomplete="off"
                pattern="^[0-9]*$" 
                required 
              />
            </div>

            <div align="right">
              <button type="submit" class="btn btn-success" id="searchEload" disabled>
                Search
              </button>
            </div>
          </form>

          <form name="formPlanCodes" id="formPlanCodes" style="display: none;">
            <div style="padding-bottom: 10px;">
              <select class="form-control" name="inputEloadOperator" id="inputEloadOperator" required>
                <option value="" disabled selected>--CHOOSE OPERATOR--</option> 
              </select>
            </div>

            <div style="padding-bottom: 10px;">
              <select class="form-control" name="inputEloadPlanCode" id="inputEloadPlanCode" required>
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

  <div class="modal fade" id="eLoadSummModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="form-group">
        <form name="formEloadPaymentSumm" id="formEloadPaymentSumm">
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
                    <span style="font-size: 15px;" id="eLoadSummMobileNumber">
                  </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                  <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; font-size: 15px;">
                      Loading Type:
                    </span>
                  </div>

                  <div style="margin-bottom: 10px;">
                    <span style="font-size: 15px;" id="eLoadSummType">
                  </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                  <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; font-size: 15px;">
                      Operator:
                    </span>
                  </div>

                  <div style="margin-bottom: 10px;">
                    <span style="font-size: 15px;" id="eLoadSummOperator">
                  </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                  <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; font-size: 15px;">
                      Product Code:
                    </span>
                  </div>

                  <div style="margin-bottom: 10px;">
                    <span style="font-size: 15px;" id="eLoadSummProductCode">
                  </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                  <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; font-size: 15px;">
                      Amount:
                    </span>
                  </div>

                  <div style="margin-bottom: 10px;">
                    <span style="font-size: 15px;" id="eLoadSummAmount">
                  </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                  <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; font-size: 15px;">
                      Wallet Currency:
                    </span>
                  </div>

                  <div style="margin-bottom: 10px;">
                    <span style="font-size: 15px;" id="eLoadSummCurrency">
                  </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                  <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; font-size: 15px;">
                      Converted Amount:
                    </span>
                  </div>

                  <div style="margin-bottom: 10px;">
                    <span style="font-size: 15px;" id="eLoadSummConvertedAmount">
                  </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                  <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; font-size: 15px;">
                      Amount Due:
                    </span>
                  </div>

                  <div style="margin-bottom: 10px;">
                    <span style="font-size: 15px;" id="eLoadSummAmountDue">
                  </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                  <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; font-size: 15px;">
                      Discounted Amount:
                    </span>
                  </div>

                  <div style="margin-bottom: 10px;">
                    <span style="font-size: 15px;" id="eLoadSummDiscountAmount">
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
                      id="eLoadSummTransacPass" 
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
    if ($('#inputLoadCategory').val() == 'e-loads') {
      $('#eLoadForm').show()
      $('#productCardForm').hide()
      $('#searchEload').show()

      $('#inputCountryCode').val('')
      $('#inputEloadMobileNumber').val('')
    }
  })

  $('#inputCountryCode').change(() => { 
    $('#formPlanCodes').hide()

    $('#inputEloadMobileNumber').val('')
    $('#inputEloadMobileNumber').removeAttr('type')

    $('#searchEload').show()
    $('#searchEload').removeAttr('disabled', 'disabled')
  })

  $('#inputEloadMobileNumber').change(() => {
    $('#searchEload').show()
    $('#formPlanCodes').hide()
    $('#inputEloadMobileNumber').val() !== '' ? $('#searchEload').removeAttr('disabled') : $('#searchEload').attr('disabled', 'disabled')
  })

  $('#formEloadSearchAmount').submit((e) => {
    e.preventDefault()

    $('#inputEloadOperator').val('')
    $('#inputEloadPlanCode').val('')
    getProviders()
  })

  $('#formPlanCodes').submit((e) => {
    e.preventDefault()

    $("#eLoadSummModal").modal('show')

    var Fproducts = products.find(el => el.SkuCode == $('#inputEloadPlanCode').val())
    var Fprodivders = providers.find(el => el.ProviderCode == $('#inputEloadOperator').val())

    const { 
      DefaultDisplayText, 
      SkuCode,
      Maximum,
      Minimum
    } = Fproducts

    const { 
      Name, 
      ProviderCode 
    } = Fprodivders

    const mobileNumber = $('#inputEloadMobileNumber').val()
    const loadingType = $('#inputCountryCode').val() == 'PH' ? 'Local E-Loads' : 'International E-Loads'

    const operator = Name
    const productCode = DefaultDisplayText
    const amount = Maximum.ReceiveValue
    const currency = Maximum.SendCurrencyIso
    const convertedAmount = Maximum.SendValue
    const amountDue = Maximum.SendValue

    $('#eLoadSummMobileNumber').html(mobileNumber)
    $('#eLoadSummType').html(loadingType)
    $('#eLoadSummOperator').html(operator)
    $('#eLoadSummProductCode').html(productCode)
    $('#eLoadSummCurrency').html(currency)
    $('#eLoadSummAmount').html(parseFloat(amount).toFixed(2))
    $('#eLoadSummConvertedAmount').html(parseFloat(convertedAmount).toFixed(2))
    $('#eLoadSummDiscountAmount').html(parseFloat(amountDue).toFixed(2))
    $('#eLoadSummAmountDue').html(parseFloat(amountDue).toFixed(2))
  })

  $('#formEloadPaymentSumm').submit((e) => {
    e.preventDefault()
    
    dingLoadNow()
  })

  $('#inputEloadOperator').change(() => {
    getPlanCodes()
  })

  function getProviders () {
    waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'})

    var params = {
      mobile_number: $('#inputEloadMobileNumber').val()
    }

    $.ajax({
      type: 'POST',
      data: params,
      url: '/buy_load/fetch_ding_providers',
      success: ((data) => {
        var jsonData = JSON.parse(data)

        if (jsonData.S == 1) {
          providers = jsonData.D.Items

          if (providers.length > 0) {
            $('#formPlanCodes').show()
            $('#searchEload').hide()

            $('#inputEloadOperator').empty().append($("<option>", {
              value: '',
              text: '--CHOOSE OPERATOR--',
            }).prop({ 'disabled': true, 'selected': true }))

            $.each(providers, (i, item) => {
              $('#inputEloadOperator').append($('<option>', { 
                value: item.ProviderCode,
                text : item.Name 
              }))
            })

            $('#inputEloadOperator').val(providers[0].ProviderCode)

            setTimeout(() => {
              getPlanCodes()
            }, 800);
          }
          else {
            $('.divAlert').html('<div class="alert alert-danger alert-dismissible" role="alert">' +                
            '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + 'No operator found' + '</div>')
          }
        } else {
          $('.divAlert').html('<div class="alert alert-danger alert-dismissible" role="alert">' +                
            '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + jsonData.M + '</div>')
        }

        waitingDialog.hide()
      })
    })
  }

  function getPlanCodes () {
    waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'})

    var params = {
      provider_code: $('#inputEloadOperator').val(),
    }

    $.ajax({
      type: 'POST',
      data: params,
      url: '/buy_load/fetch_ding_plan_codes',
      success: ((data) => {
        var jsonData = JSON.parse(data)

        if (jsonData.S == 1) {
          products = jsonData.D.Items

          $('#inputEloadPlanCode').empty().append($("<option>", {
            value: '',
            text: '--CHOOSE PLAN CODE--',
          }).prop({ 'disabled': true, 'selected': true }))

          $.each(products, (i, item) => {
            $('#inputEloadPlanCode').append($('<option>', { 
              value: item.SkuCode,
              text : item.DefaultDisplayText 
            }))
          })
        } else {
          $('.divAlert').html('<div class="alert alert-danger alert-dismissible" role="alert">' +                
            '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Plancode' + jsonData.M + '</div>')
        }

        waitingDialog.hide()
      })
    })
  }

  function dingLoadNow () {
    waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'})

    var params = {
      category: $('#inputLoadCategory').val() == 'e-loads' ? 'E-Loads' : 'Card Products',
      operator: $('#eLoadSummOperator').html(),
      plancode: $('#eLoadSummProductCode').html(),
      skucode: $('#inputEloadPlanCode').val(),
      wallet_currency: $('#eLoadSummCurrency').html(),
      load_amount: $('#eLoadSummAmount').html(),
      converted_amount: $('#eLoadSummConvertedAmount').html(),
      discounted_amount: $('#eLoadSummDiscountAmount').html(),
      debited_amount: $('#eLoadSummDiscountAmount').html(),
      mobile_number: $('#inputEloadMobileNumber').val(),
      transpass: $('#eLoadSummTransacPass').val()
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

            eloadClearFields()
          } else {
            $('.divAlert').html('<div class="alert alert-danger alert-dismissible" role="alert">' +                
              '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + jsonData.M + '</div>')
          } 

          $("#eLoadSummModal").modal('hide')
          waitingDialog.hide()
        })
      })
  }

  function eloadClearFields () {
    $('#inputLoadCategory').val('')
    $('#inputCountryCode').val('')
    $('#inputEloadMobileNumber').val('')
    $('#inputEloadOperator').val('')
    $('#inputEloadPlanCode').val('')
    $('#eLoadSummTransacPass').val('')

    $('#eLoadForm').hide()
    
    $('#formPlanCodes').hide()
    $('#inputEloadMobileNumber').attr('type', 'hidden')
  }
</script>