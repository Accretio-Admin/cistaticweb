<style>
  input#ciAmount {
    border: none;
    box-shadow: none;
    border-bottom: 1px solid #afbbca;
    border-radius: 0 !important;
    text-align: center;
    font-size: 30px;
    width: 30%;
    margin: 0 auto;
  }

  .ciAmountLabel {
    color: #4c5564;
    font-size: 12px;
    font-weight: 600;
    line-height: 20px;
    margin-bottom: 0;
    margin-top: 0;
  }

  .payment_method {
    border: 1px solid #d4dae3;
    -webkit-align-items: center;
    -moz-box-align: center;
    align-items: center;
    cursor: pointer;
    border-radius: 4px;
    padding: 0px;
    margin-top: 10px;
    margin-bottom: 15px;
    display: -webkit-flex;
    display: -moz-box;
    display: flex;
  }

  .payment_method:hover {
    background-color: #edf6fd;
  }

  .payment_method_img {
    padding: 8px;
    border-radius: 15px;
  }

  .ciRadio {
    margin-left: 20px !important;
    margin-right: 3px !important;
  }

  .ciLabel {
    margin-left: 8px !important;
  }

  .ciLabelHeader{
    margin-left: -13px;
    font-size: 15px;
    font-weight: 600;
  }
</style>

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
        <h4>Cash-In Top-up</h4>
      </div>
    </div>
  </div>


  <div class="contentpanel" style="padding-bottom: 0px;">
    <div class='divAlert'></div>
    <div class="row"> 
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="form-group">
           
            <form name="cashinForm" id="cashinForm">
              
              <div style="padding-bottom: 30px; text-align: center;">
              <h4>CASH IN</h4><br>
              <label for="ciAmount" class="col-md-12 ciAmountLabel">Enter Amount: </label>
                <input class="form-control ciAmount" id="ciAmount" name="ciAmount" placeholder="AMOUNT" pattern="[0-9]+([\.,][0-9]+)?" title="Input must be number or decimal." autocomplete="off" required 
                />
              </div>

              <span class="col-md-12 ciLabelHeader">Payment Method </span><br>

              <div class="payment_method" style="padding-bottom: 5px;">
                <div>
                  <input type="radio" id="Visa" name="ciPaymentMethod" value="Credit/Debit Card" class="ciRadio"  checked="checked">
                </div>
                <div>
                  <img alt="Credit/Debit Card" class="payment_method_img" src="<?php echo BASE_URL() ?>assets/images/ecash_send/visa.jpg" 
                  decoding="async">
                </div>
                <label for="Visa" class="ciLabel">Credit/Debit Card</label>
              </div>

              <div class="payment_method" style="padding-bottom: 5px;">
                <div>
                  <input type="radio" id="GCash" name="ciPaymentMethod" value="GCash" class="ciRadio">
                </div>
                <div>
                  <img alt="GCash" class="payment_method_img" src="<?php echo BASE_URL() ?>assets/images/ecash_send/gcash.jpg?v2" 
                  decoding="async">
                </div>
                <label for="GCash" class="ciLabel">GCash</label>
              </div>

              <div class="payment_method" style="padding-bottom: 5px;">
                <div>
                  <input type="radio" id="GrabPay" name="ciPaymentMethod" value="GrabPay" class="ciRadio">
                </div>
                <div>
                  <img alt="GrabPay" class="payment_method_img" src="<?php echo BASE_URL() ?>assets/images/ecash_send/grabpay.jpg" 
                  decoding="async">
                </div>
                <label for="GrabPay" class="ciLabel">GrabPay</label>
              </div>

              <div class="payment_method" style="padding-bottom: 5px;">
                <div>
                  <input type="radio" id="PayMaya" name="ciPaymentMethod" value="PayMaya" class="ciRadio">
                </div>
                <div>
                  <img alt="PayMaya" class="payment_method_img" src="<?php echo BASE_URL() ?>assets/images/ecash_send/paymaya.jpg" 
                  decoding="async">
                </div>
                <label for="PayMaya" class="ciLabel">PayMaya</label>
              </div>

              <span class="col-md-12 ciLabelHeader">Customer Information </span><br>
                <div style="padding-bottom: 10px;">
                  <input 
                    class="form-control" id="ciCustomerName" name="ciCustomerName" placeholder="Name" pattern="\S(.*\S)?" title="Input field does not accept white space." autocomplete="off" required />
                </div>

                <div style="padding-bottom: 10px;">
                  <input class="form-control" id="ciEmailAddress" name="ciEmailAddress" placeholder="E-mail Address" pattern="\S(.*\S)?" title="Input field does not accept white space." autocomplete="off" required />
                </div>

                <div id="BillingInfo">
                  <div style="padding-bottom: 10px;">
                    <input class="form-control" id="ciMobileNumber" name="ciMobileNumber" placeholder="Mobile Number" pattern="[0-9]{11}" title="Input must be a number and equal to 11 digits." autocomplete="off" required />
                  </div>
                
                  <span class="col-md-12 ciLabelHeader">Billing Address Information</span><br>
                  <div style="padding-bottom: 10px;">
                    <input class="form-control" id="ciLine1" name="ciLine1" placeholder="Line 1" type="text" autocomplete="off" required />
                  </div>

                  <div style="padding-bottom: 10px;">
                    <input class="form-control" id="ciCity" name="ciCity" placeholder="City" type="text" autocomplete="off" required />
                  </div>

                  <div style="padding-bottom: 10px;">
                    <input class="form-control" id="ciState" name="ciState" placeholder="State" type="text" autocomplete="off" required />
                  </div>

                  <div style="padding-bottom: 10px;">
                    <input class="form-control" id="ciZipCode" name="ciZipCode" placeholder="Zip Code" type="text" autocomplete="off" required />
                  </div>

                  <div style="padding-bottom: 10px;">
                    <select class="form-control" id="ciCountry" name="ciCountry" autocomplete="off" required>
                        <option value="" selected>Select Country</option>   
                        <?php 
                            foreach ($country as $row): 
                        ?>
                        <option value="<?php echo $row['iso_code'] ?>"><?php echo $row['cname'] ?></option> 
                        <?php endforeach ?>
                    </select>
                  </div>
                </div>

                <div id="PaymentInfo">
                  <span class="col-md-12 ciLabelHeader">Payment Information</span><br>
                  <div style="padding-bottom: 10px;">
                    <input type="number" class="form-control" name="ciCardNumber" id="ciCardNumber" placeholder="Card Number" autocomplete="off" required>      
                  </div>
                  
                  <div style="display: flex; padding-bottom: 10px;">
                    <div style="flex: 1 1 0%;"> 
                      <input type="text" class="form-control" name="ciCardMonth" id="ciCardMonth" placeholder="Month" autocomplete="off" required>
                    </div>
                    <div style="flex: 1 1 0%;"> 
                      <input type="text" class="form-control" name="ciCardYear" id="ciCardYear" placeholder="Year" autocomplete="off" required>
                    </div>
                  </div>

                  <div style="padding-bottom: 10px;">
                    <input type="text" class="form-control" name="ciCardCVC" id="ciCardCVC" placeholder="CVC" autocomplete="off" required>
                  </div>
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
</div>

<script>
  $(document).ready(() => {
    $('input[name="ciPaymentMethod"]').click(function() {
        if (this.id == "Visa") {
            $('#BillingInfo').show();   
            $('#PaymentInfo').show();           
       } else {
            $('#BillingInfo').hide();   
            $('#PaymentInfo').hide();     
       }
   });
  })

  $('#ciCustomerName').on('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
  });


  $('#cashinForm').submit((e) => {
    e.preventDefault();

    if ( $("#paymentMethod").html($("#ciPaymentMethod").val()) == "Visa" ) {
      $("#amount").html($("#ciAmount").val());
      $("#paymentMethod").html($("#ciPaymentMethod").val());
      $("#customerName").html($("#ciCustomerName").val());
      $("#emailaddress").html($("#ciEmailAddress").val());
      $("#mobileNo").html($("#ciMobileNumber").val());
      $("#line1").html($("#ciLine1").val());
      $("#city").html($("#ciCity").val());
      $("#state").html($("#ciState").val());
      $("#zipcode").html($("#ciZipCode").val());
      $("#country").html($("#ciCountry").val());
      $("#cardnumber").html($("#ciCardNumber").val());
      $("#cardmonth").html($("#ciCardMonth").val());
      $("#cardyear").html($("#ciCardYear").val());
      $("#cardCVC").html($("#ciCardCVC").val());
    } else {
      $("#amount").html($("#ciAmount").val());
      $("#paymentMethod").html($("#ciPaymentMethod").val());
      $("#customerName").html($("#ciCustomerName").val());
      $("#emailaddress").html($("#ciEmailAddress").val());
    }

    let i_amount = $('#ciAmount').val();
    i_amount = i_amount.replace(',','');

    var params = {
    //  data needed for api
    }
    
    $('#amount').html((parseFloat(i_amount)).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

    $.ajax({
      type : 'POST',
      data: params,
      url  : "",
      success : ((data) => {
        var jsondata = JSON.parse(data)

        if (jsondata.S == 1) {
          // result
        } else {
          // result
        }

      })
    });
  })


  
</script>