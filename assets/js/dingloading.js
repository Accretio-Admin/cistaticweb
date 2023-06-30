$('#loadingCategory').change(() => {
    if ($('#loadingCategory').val() == 'e-loads') {
      $('#dingEloadForm').show()
      $('#dingCardForm').hide()
    } else {
      $('#dingEloadForm').hide()
      $('#dingCardForm').show()
    }
  })

  $('#inputCountryCode').change(() => { 
    $('#inputCountryCode').val() !== '' && $('#inputMobileNumber').removeAttr('disabled')
  })

  $('#inputMobileNumber').change(() => {
    $('#searchEload').show()
    $('#formPlanCodes').hide()
    $('#inputMobileNumber').val() !== '' ? $('#searchEload').removeAttr('disabled') : $('#searchEload').attr('disabled', 'disabled')
  })

  $('#formEloadSearchAmount').submit((e) => {
    e.preventDefault()

    $('#formPlanCodes').show()
    $('#inputPlanCodeAmount').val('')
    $('#searchEload').hide()
  })

  $('#formPlanCodes').submit((e) => {
    e.preventDefault()

    $("#eLoadSummModal").modal('show')

    const mobileNumber = $('#inputMobileNumber').val()
    const loadType = $('#inputCountryCode').val() === 'PH' ? 'Local E-Load' : 'International E-Load'
    const [productCode, operator, amount] = $('#inputPlanCodeAmount').val().split('/')

    $('#eLoadSummMobileNumber').html(mobileNumber)
    $('#eLoadSummType').html(loadType)
    $('#eLoadSummOperator').html(operator)
    $('#eLoadSummProductCode').html(productCode)
    $('#eLoadSummAmount').html(amount)

    $('#eLoadSummConvertedAmount').html('0.00')
    $('#eLoadSummAmountDue').html('0.00')
    $('#eLoadSummDiscount').html('0.00')
  })

  $('#formEloadPaymentSumm').submit((e) => {
    e.preventDefault()
  })