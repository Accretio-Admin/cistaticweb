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
          <li>ECASH</li>
        </ul>


        <h4><?php echo strtoupper($eccash_service); ?> Top-up</h4>
      </div>
    </div>
  </div>

  <div class="contentpanel" style="padding-bottom: 0px;">
    <div class='divAlert'></div>
    
    <div class="row"> 
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <div class="form-group">
          <?php if($eccash_service == 'gcash'): ?>
            <form name="gcashForm" id="gcashForm">
              <div style="padding-bottom: 10px;">
                <input 
                  type="hidden" 
                  id="inputServices" 
                  name="inputServices" 
                  value="<?php echo strtoupper($eccash_service); ?>" 
                />
              </div>

              <div style="padding-bottom: 10px;">
                <input 
                  class="form-control" 
                  id="gcMobileNumber" 
                  placeholder="MOBILE NUMBER" 
                  pattern="[0-9]{11}" 
                  title="Input must be a number and equal to 11 digits." 
                  autocomplete="off" 
                  required 
                />
              </div>

              <div style="padding-bottom: 10px;">
                <input 
                  class="form-control" 
                  id="gcCustomerName" 
                  placeholder="CUSTOMER NAME" 
                  pattern="\S(.*\S)?"
                  maxlength="24"
                  title="Input field does not accept white space."
                  autocomplete="off" 
                  required 
                />
              </div>

              <div style="padding-bottom: 10px;">
                <input 
                  class="form-control" 
                  id="gcAmount" 
                  placeholder="AMOUNT" 
                  pattern="[0-9]+([\.,][0-9]+)?"
                  title="Input must be number or decimal." 
                  autocomplete="off" 
                  required 
                />
              </div>

              <div style="padding-bottom: 10px;" align="right">
                <button type="submit" class="btn btn-primary">
                  Submit
                </button>
              </div>
            </form>
          <?php elseif($eccash_service != 'paymaya'): ?>
            <form name="paymayaForm" id="paymayaForm">
              <div style="padding-bottom: 10px;">
                <input 
                  type="hidden" 
                  id="inputServices" 
                  name="inputServices" 
                  value="<?php echo strtoupper($eccash_service); ?>" 
                />
              </div>

              <div style="padding-bottom: 10px;">
                <input 
                  class="form-control" 
                  id="pmMoneyCode" 
                  placeholder="MONEY CODE" 
                  pattern="[0-9]{7}" 
                  title="Input must be a number and equal to 7 digits." 
                  autocomplete="off" 
                  required 
                />
              </div>

              <div style="padding-bottom: 10px;">
                <input 
                  class="form-control" 
                  id="pmMobileNumber" 
                  placeholder="MOBILE NUMBER" 
                  pattern="[0-9]{11}" 
                  title="Input must be a number and equal to 11 digits."
                  autocomplete="off" 
                  required 
                />
              </div>

              <div style="padding-bottom: 10px;">
                <input 
                  class="form-control" 
                  id="pmAmount" 
                  placeholder="AMOUNT" 
                  pattern="[0-9]+([\.,][0-9]+)?"
                  title="Input must be a number or decimal." 
                  autocomplete="off" 
                  required 
                />
              </div>

              <div style="padding-bottom: 10px;" align="right">
                <button type="submit" class="btn btn-primary">
                  Submit
                </button>
              </div>
            </form>
          <?php else: ?>
            <div style="padding-bottom: 10px;">
              <select class="form-control" name="inputServices" id="inputServices" required>
                <option value="" disabled selected>--CHOOSE SERVICES--</option> 
                <option value="">NO SERVICE AVAILABLE</option>
              </select>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
        <div class="form-group">
                <div class="alert alert-info alert-biller-default" style="word-wrap:break-word;">
                    <h4 class="text-info" style="font-weight: bold;"><i class="fa fa-bell" aria-hidden="true"></i> IMPORTANT REMINDERS</h4>
                    <p> <b><span class="text-info1">Note:</span></b> Allowed transaction is <b>Minimum of PHP 100.00 to Maximum of PHP 40,000.00</b></p>
                     <?php if($eccash_service == 'gcash'): ?>
                      <!-- <p> <b><span class="text-info1">•</span></b> Gcash Top-up Transactions can only be made within 8AM to 8PM</b></p> -->
                    <?php elseif($eccash_service == 'paymaya'): ?>
                      <p> <b><span class="text-info1">•</span></b> Paymaya Top-up Transactions can only be made within 8AM to 8PM</b></p>
                    <?php endif; ?>
                    <p> <b><span class="text-info1">•</span></b> Service Charge <b>: 1%</b> of Total Amount</p>
                </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="transacSummModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="form-group">
        <form name="transSummForm" id="transSummForm">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalLabel">
                Transaction Summary
              </h5>
            </div>
            
            <div class="modal-body">
              <div style="margin-bottom: 20px;">
                <span style="font-weight:bold; font-size:15px; color:red;">
                  **Note** Please double check your transaction summary before submitting.
                </span>
              </div>

              <div id="moneyCodeSummCon" style="display: none;">
                <div style="margin-bottom: 10px;">
                  <span style="font-weight: bold; font-size: 15px;">
                    Money Code:
                  </span>
                </div>

                <div style="margin-bottom: 10px;">
                  <span style="font-size: 15px;" id="moneyCode">
                </div>
              </div>

              <div style="margin-bottom: 10px;">
                <span style="font-weight: bold; font-size: 15px;">
                  Mobile Number:
                </span>
              </div>

              <div style="margin-bottom: 10px;">
                <span style="font-size: 15px;" id="mobileNo">
              </div>

              <div id="customerSummCon" style="display: none;">
                <div style="margin-bottom: 10px;">
                  <span style="font-weight: bold; font-size: 15px;">
                    Customer Name:
                  </span>
                </div>

                <div style="margin-bottom: 10px;">
                  <span style="font-size: 15px;" id="customerName">
                </div>
              </div>

              <div style="margin-bottom: 10px;">
                <span style="font-weight: bold; font-size: 15px;">
                  Amount:
                </span>
              </div>

              <div style="margin-bottom: 10px;">
                <span style="display: inline-block;font-size: 15px; text-align:right; width:60px;" id="amount">
              </div>

              <div style="margin-bottom: 10px;">
                <span style="font-weight: bold; font-size: 15px;">
                  Charges:
                </span>
              </div>

              <div style="margin-bottom: 10px;">
                <span style="display: inline-block;font-size: 15px; text-align:right; width:60px;" id="charges">
              </div>

              <div style="margin-bottom: 10px;">
                <span style="font-weight: bold; font-size: 15px;">
                  Total:
                </span>
              </div>

              <div style="margin-bottom: 10px;">
                <span style="display: inline-block;font-size: 15px; text-align:right; width:60px;" id="total_amount">
              </div>

              <div style="margin-bottom: 10px;">
                <span style="font-weight: bold; font-size: 15px;">
                  Transaction Password:
                </span>
              </div>

              <div>
                <input class="form-control" type="password" id="transPass" required />
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
  $(document).ready(() => {
    $('#transacSummModal').on('shown.bs.modal', function () {
      $('#transPass').trigger('focus')
    })
  })

  $('#gcCustomerName').on('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
    });

  $('#inputServices').change(() => {
    if ($('#inputServices').val() == 'GCASH') {
      $('#gcashFields').show()
      $('#gcMobileNumber').val('')
      $('#gcCustomerName').val('')
      $('#gcAmount').val('')

      $('#paymayaFields').hide()
    } else {
      $('#paymayaFields').show()
      $('#pmMoneyCode').val('')
      $('#pmMobileNumber').val('')
      $('#pmAmount').val('')

      $('#gcashFields').hide()  
    }

    $('#transPass').val('')  
  })

  $('#gcashForm').submit((e) => {
    e.preventDefault();

    $("#mobileNo").html($("#gcMobileNumber").val());
    $("#customerName").html($("#gcCustomerName").val());
    $("#amount").html($("#gcAmount").val());

    $('#customerSummCon').show()
    $('#moneyCodeSummCon').hide()

    let i_amount = $('#inputServices').val() == 'GCASH' ? $('#gcAmount').val() : $('#pmAmount').val();
    i_amount = i_amount.replace(',','');

    var params = {
      service: $('#inputServices').val(),
      trans_pass: $('#transPass').val(),
      first_field: $('#inputServices').val() == 'GCASH' ? $('#gcMobileNumber').val() : $('#pmMoneyCode').val(),
      second_field: $('#inputServices').val() == 'GCASH' ? $('#gcCustomerName').val() : $('#pmMobileNumber').val(),
      amount: i_amount
    }
    
    $('#amount').html((parseFloat(i_amount)).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

    $.ajax({
      type : 'POST',
      data: params,
      url  : "/Ecash_send/ecpay_eccash_get_charges",
      success : ((data) => {
        var jsondata = JSON.parse(data)

        if (jsondata.S == 1) {
          $("#transacSummModal").modal('show');

          let charges = jsondata.R.charge;        
          let total_amount = parseFloat(charges) + parseFloat(i_amount);

          $("#charges").html(charges);
          $('#total_amount').html((total_amount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        } else {
          $("#transacSummModal").modal('hide');
          $('.divAlert').html('<div class="alert alert-danger alert-dismissible" role="alert">' +                
              '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + jsondata.M + '</div>')
        }
      })
    });
  })

  $('#paymayaForm').submit((e) => {
    e.preventDefault()

    $("#moneyCode").html($("#pmMoneyCode").val());
    $("#mobileNo").html($("#pmMobileNumber").val());
    $("#amount").html($("#pmAmount").val());

    $('#moneyCodeSummCon').show()
    $('#customerSummCon').hide()

    let i_amount = $('#inputServices').val() == 'GCASH' ? $('#gcAmount').val() : $('#pmAmount').val();
    i_amount = i_amount.replace(',','');

    var params = {
      service: $('#inputServices').val(),
      trans_pass: $('#transPass').val(),
      first_field: $('#inputServices').val() == 'GCASH' ? $('#gcMobileNumber').val() : $('#pmMoneyCode').val(),
      second_field: $('#inputServices').val() == 'GCASH' ? $('#gcCustomerName').val() : $('#pmMobileNumber').val(),
      amount: i_amount
    }

    $('#amount').html((parseFloat(i_amount)).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

    $.ajax({
      type : 'POST',
      data: params,
      url  : "/Ecash_send/ecpay_eccash_get_charges",
      success : ((data) => {
        var jsondata = JSON.parse(data)

        if (jsondata.S == 1) {
          $("#transacSummModal").modal('show');

          let charges = jsondata.R.charge;        
          let total_amount = parseFloat(charges) + parseFloat(i_amount);

          $("#charges").html(charges);
          $('#total_amount').html((total_amount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        } else {
          $("#transacSummModal").modal('hide');

          $('.divAlert').html('<div class="alert alert-danger alert-dismissible" role="alert">' +                
              '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + jsondata.M + '</div>')
        }

      })
    });
  })

  $('#transSummForm').submit((e) => {
    e.preventDefault()
    $('.divAlert').html('')

    let i_amount = $('#inputServices').val() == 'GCASH' ? $('#gcAmount').val() : $('#pmAmount').val();
    i_amount = i_amount.replace(',','');

    var params = {
      service: $('#inputServices').val(),
      trans_pass: $('#transPass').val(),
      first_field: $('#inputServices').val() == 'GCASH' ? $('#gcMobileNumber').val() : $('#pmMoneyCode').val(),
      second_field: $('#inputServices').val() == 'GCASH' ? $('#gcCustomerName').val() : $('#pmMobileNumber').val(),
      amount: i_amount
    }

    $.ajax({
      type : 'POST',
      data: params,
      url  : "/Ecash_send/ecpay_transac",
      success : ((data) => {
        var jsondata = JSON.parse(data)

        if (jsondata.S == 1) {
          $('.divAlert').html('<div class="alert alert-success alert-dismissible" role="alert">'+                
              '<a href="#" class="close" data-dismiss="alert" aria-label="close" target="_blank">&times;</a>Transaction complete. Tracking No: <a href="https://mobilereports.globalpinoyremittance.com/portal/ecpay_fund_transfer/' + jsondata.TN + '">' + jsondata.TN + '<a/></div>')
        } else {
          $('.divAlert').html('<div class="alert alert-danger alert-dismissible" role="alert">' +                
              '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + jsondata.M + '</div>')
        }

        $("#transacSummModal").modal('hide');

      })
    });
  })
</script>