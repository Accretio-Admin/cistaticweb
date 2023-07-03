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

        <h4>Top-Up Gcash ECPAY</h4>
      </div>
    </div>
  </div>

  <div class="contentpanel" style="padding-bottom: 0px;">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <div class="form-group">
          <form name="formSubmitDetails" id="formSubmitDetails">
            <div style="padding-bottom: 10px;">
              <div style="padding-bottom: 10px;">
                <input 
                  class="form-control" 
                  id="pmMoneyCode" 
                  placeholder="MONEY CODE" 
                  pattern="[0-9]+" 
                  title="User numbers only."
                  autocomplete="off" 
                  required 
                />
              </div>

              <div style="padding-bottom: 10px;">
                <input 
                  class="form-control" 
                  id="pmMobileNumber" 
                  placeholder="MOBILE NUMBER" 
                  pattern="[0-9]+" 
                  title="User numbers only." 
                  autocomplete="off" 
                  required 
                />
              </div>

              <input 
                class="form-control" 
                id="pmCustomerName" 
                placeholder="CUSTOMER NAME" 
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
                title="Use numbers or decimals only." 
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
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="transactionSummModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="form-group">
        <form name="formConfirmDetails" id="formConfirmDetails" action="<?php echo BASE_URL() ?>ecash_send/ecash_to_gcash" method="post">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalLabel">
                Transaction Summary
              </h5>
            </div>
            
            <div class="modal-body">
              <div style="margin-bottom: 10px;">
                <span style="font-weight: bold; font-size: 15px;">
                  Customer Name:
                </span>
              </div>

              <div style="margin-bottom: 10px;">
                <span style="font-size: 15px;" id="customerName">
              </div>

              <div style="margin-bottom: 10px;">
                <span style="font-weight: bold; font-size: 15px;">
                  Mobile Number:
                </span>
              </div>

              <div style="margin-bottom: 10px;">
                <span style="font-size: 15px;" id="mobileNo">
              </div>

              <div style="margin-bottom: 10px;">
                <span style="font-weight: bold; font-size: 15px;">
                  Amount:
                </span>
              </div>

              <div style="margin-bottom: 10px;">
                <span style="font-size: 15px;" id="amount">
              </div>

              <div style="margin-bottom: 10px;">
                <span style="font-weight: bold; font-size: 15px;">
                  Service Fee:
                </span>
              </div>

              <div style="margin-bottom: 10px;">
                <span style="font-size: 15px;" id="serviceFee">
              </div>

              <div style="margin-bottom: 10px;">
                <span style="font-weight: bold; font-size: 15px;">
                  Amount Due:
                </span>
              </div>

              <div style="margin-bottom: 10px;">
                <span style="font-size: 15px;" id="amountDue">
              </div>

              <div style="margin-bottom: 10px;">
                <span style="font-weight: bold; font-size: 15px;">
                  Transaction Password:
                </span>
              </div>

              <div>
                <input class="form-control" type="password" id="transacPass" required />
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
    $('#transactionSummModal').on('shown.bs.modal', function () {
      $('#transacPass').trigger('focus')
    })
  })

  $('#formSubmitDetails').submit((e) => {
    e.preventDefault()

    $("#transactionSummModal").modal('show')

    $("#customerName").html($("#pmCustomerName").val())

    $("#mobileNo").html($("#pmMobileNumber").val())

    $("#amount").html($("#pmAmount").val())

    $("#serviceFee").html(0)

    $("#amountDue").html(0)
  })

  $('#formConfirmDetails').submit((e) => {
    e.preventDefault()
    alert('CONFIRMED')
  })
</script>