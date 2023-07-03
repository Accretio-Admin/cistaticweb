<div class="mainpanel">
  <div class="pageheader">
    <div class="media">
      <div class="pageicon pull-left">
        <i class="fa fa-bank"></i>
      </div>

      <div class="media-body">
        <ul class="breadcrumb">
          <li>
            <a href="<?php echo BASE_URL('/Main')?>">
              <i class="glyphicon glyphicon-home"></i>
            </a>
          </li>
          <li>PORTFOLIO</li>
        </ul>

        <h4>Usave</h4>
      </div>
    </div>
  </div>

  <div class="contentpanel" style="padding-bottom: 0px;">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <div class='divAlert'></div>

        <div class="form-group">
          <form id="usaveForm">
            <div style="padding-bottom: 10px;">
              <input type="number" step="0.01" class="form-control" id="amount" placeholder="INPUT AMOUNT" required title="field must be a number or decimal.">
            </div>

            <div style="padding-bottom: 10px;">
              <select class="form-control" id="maturity" required>
                <option value="" selected disabled>
                  --CHOOSE MATURITY--
                </option>

                <option value="MONTHLY">
                  Monthly
                </option>

                <option value="YEARLY">
                  Yearly
                </option>
              </select>
            </div>

            <div style="padding-bottom: 10px;">
              <input class="form-control" id="autoComputedAmount" placeholder="EARNINGS" disabled>
            </div>

            <div style="padding-bottom: 10px;" align="right">
              <button type="submit" class="btn btn-success">
                Submit
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="form-group">
          <table id="example" class="table table-striped table-bordered" style="width:100%" data-ordering="false">
            <thead>
              <tr>
                <th hidden>ID</th>
                <th>Tracking No</th>
                <th>Amount</th>
                <th>Maturity Type</th>
                <th>Processed Date</th>
                <th>Maturity Date</th>
                <th>Total Earnings</th>
                <th>Action</th>
              </tr>
            </thead> 

            <body>
              <?php foreach($payin_cash_ledger_list as $transaction):?>
                <tr>
                  <td hidden><?php echo $transaction['id'] ?></td>
                  <td><?php echo $transaction['tracking_no'] ?></td>
                  <td nowrap style="text-align:right"><?php echo number_format($transaction['amount'],2); ?></td>
                  <td nowrap style="text-align:center"><?php echo $transaction['maturity_type']; ?></td>
                  <td nowrap style="text-align:center"><?php echo substr($transaction['posting_time'],0,10); ?></td>
                  <td nowrap style="text-align:center"><?php echo $transaction['maturity_date']; ?></td>
                  <td nowrap style="text-align:right"><?php echo number_format($transaction['earn_amount'],2) ?></td>

                  <td nowrap style="text-align:center">
                    <?php if($transaction['maturity_status'] == 'MATURE' and $transaction['status'] == 'ACTIVE'):?>
                      <button type="submit" id="btn_payout_id_<?php echo $transaction['id'] ?>" class="payoutBtn btn btn-success">Payout</button>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach;?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="transacSummModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="form-group">
        <form name="formConfirm" id="formConfirm">
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
                      Maturity Type:
                    </span>
                  </div>

                  <div style="margin-bottom: 10px;">
                    <span style="font-size: 15px;" id="summMaturityType">
                  </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                  <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; font-size: 15px;">
                      Earnings:
                    </span>
                  </div>

                  <div style="margin-bottom: 10px;">
                    <span style="font-size: 15px;" id="summAutoAmount">
                  </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
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

                  <div>
                    <input type="checkbox" id="summTermsCondition" required/>

                    <label for="summTermsCondition">I agree to the <a href="javascript:void(0);" onclick="window.open('<?php echo BASE_URL() ?>investment/usave_terms_condition')">Terms and conditions</a></label>
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

  <div class="modal fade" id="payoutSummModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="form-group">
        <form name="formPayout" id="formPayout">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalLabel">
                Payout Summary
              </h5>
            </div>
            
            <div class="modal-body">
              <div class="row gy-5">
                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                  <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; font-size: 15px;">
                      Tracking No:
                    </span>
                  </div>

                  <div style="margin-bottom: 10px;">
                    <span style="font-size: 15px;" id="payoutSummTrackNo">
                  </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                  <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; font-size: 15px;">
                      Amount:
                    </span>
                  </div>

                  <div style="margin-bottom: 10px;">
                    <span style="font-size: 15px;" id="payoutSummAmount">
                  </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                  <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; font-size: 15px;">
                      Maturity Type
                    </span>
                  </div>

                  <div style="margin-bottom: 10px;">
                    <span style="font-size: 15px;" id="payoutSummMaturityType">
                  </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                  <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; font-size: 15px;">
                      Processed Date
                    </span>
                  </div>

                  <div style="margin-bottom: 10px;">
                    <span style="font-size: 15px;" id="payoutSummProcessedDate">
                  </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                  <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; font-size: 15px;">
                      Maturity Date
                    </span>
                  </div>

                  <div style="margin-bottom: 10px;">
                    <span style="font-size: 15px;" id="payoutSummMaturityDate">
                  </div>
                </div>  

                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                  <div style="margin-bottom: 10px;">
                    <span style="font-weight: bold; font-size: 15px;">
                      Total Earnings
                    </span>
                  </div>

                  <div style="margin-bottom: 10px;">
                    <span style="font-size: 15px;" id="payoutSummTotalEarnings">
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
                      id="payoutSummTransacPass" 
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
  var payinId = '';
  $('#amount').change(() => {
    this.getAutoComputed()
  })

  $('#maturity').change(() => {
    this.getAutoComputed()
  })

  $('#usaveForm').submit((e) => {
    e.preventDefault()

    $('#transacSummModal').modal('show')

    var amount = $('#amount').val()
    var maturity = $('#maturity').val()
    var autoAmount = $('#autoComputedAmount').val()

    $('#summAmount').html(parseFloat(amount).toFixed(2))
    $('#summMaturityType').html(maturity)
    $('#summAutoAmount').html(autoAmount)
  })

  $('#formConfirm').submit((e) => {
    e.preventDefault()

    waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'})

    var params = {
      transpass: $('#summTransacPass').val(),
      amount: parseFloat($('#summAmount').html()).toFixed(2),
      maturity_type: $('#summMaturityType').html() 
    }

    $.ajax({
      url: '/investment/usave_transaction',
      type: 'POST',
      data: params,
      success: (data) => {
        var jsonData = JSON.parse(data)

        if (jsonData.S) {
          $('.divAlert').html('<div class="alert alert-success alert-dismissible" role="alert">' +                
            '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Transaction Susccess here is your transaction no. ' + jsonData.TN + '</div>')

          $('#amount').val('')
          $('#maturity').val('')
          $('#autoComputedAmount').val('')
          $('#summTransacPass').val('')
        } else {
          $('.divAlert').html('<div class="alert alert-danger alert-dismissible" role="alert">' +                
            '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + jsonData.M + '</div>')
        }

        $('#transacSummModal').modal('hide')
        waitingDialog.hide()
      }
    })
  })

  function getAutoComputed () {
    $('#autoComputedAmount').val('')

    if ($('#amount').val() && $('#maturity').val()) {
      waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'})

      var params = {
        amount: $('#amount').val(),
        maturity_type: $('#maturity').val()
      }

      $.ajax({
        url: '/investment/usave_auto_compute',
        type: 'POST',
        data: params,
        success: (data) => {
          var jsonData = JSON.parse(data)

          if (jsonData.S) {
            $('#autoComputedAmount').val(jsonData.D)
          } else {
            $('.divAlert').html('<div class="alert alert-danger alert-dismissible" role="alert">' +                
            '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + jsonData.M + '</div>')
          }

          waitingDialog.hide()
        }
      })
    }
  }

  $('.payoutBtn').click(function() {
    var currentRow = $(this).closest("tr")

    payinId = currentRow.find("td:eq(0)").html()
    const trackingNo = currentRow.find("td:eq(1)").html()
    const amount = currentRow.find("td:eq(2)").html()
    const maturityType = currentRow.find("td:eq(3)").html()
    const processedDate = currentRow.find("td:eq(4)").html()
    const maturityDate = currentRow.find("td:eq(5)").html()
    const totalEarnings = currentRow.find("td:eq(6)").html()

    $('#payoutSummTrackNo').html(trackingNo)
    $('#payoutSummAmount').html(amount)
    $('#payoutSummMaturityType').html(maturityType)
    $('#payoutSummProcessedDate').html(processedDate)
    $('#payoutSummMaturityDate').html(maturityDate)
    $('#payoutSummTotalEarnings').html(totalEarnings)


    $('#payoutSummModal').modal('show')
  })

  $('#formPayout').submit((e) => {
    e.preventDefault()

    var params = {
      payin_id: payinId,
      transpass: $('#payoutSummTransacPass').val()
    }

    $.ajax({
      url: '/investment/payout_transaction',
      type: 'POST',
      data: params,
      success: (data) => {
        console.log('here1',data,params)
        var jsonData = JSON.parse(data)

        if (jsonData.S) {
          $('.divAlert').html('<div class="alert alert-success alert-dismissible" role="alert">' +                
            '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + jsonData.M + '</div>')
          
            $("#btn_payout_id_"+payinId).css('display', 'none')
        } else {
          $('.divAlert').html('<div class="alert alert-danger alert-dismissible" role="alert">' +                
            '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + jsonData.M + '</div>')
        }

        waitingDialog.hide()
        $('#payoutSummModal').modal('hide')
      }
    })

    waitingDialog.hide()
        $('#payoutSummModal').modal('hide')
  })
</script>