<style type="text/css" media="screen">


table th,
table td {
  padding: .625em;
  text-align: center;
}
table th {
  font-size: .85em;
  letter-spacing: .1em;
  text-transform: uppercase;
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
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>FUND TRANSFER</li>
                </ul>
                <h4>Forex Ecash transfer</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
    <!-- <div class="contentpanel" style="padding-top: 10px; padding-bottom: 0px;">
        <div class="row row-stat">
            <div class="col-md-7">
                <div class="panel panel-default">
                  <div class="panel-body" style="border: 1px solid #d3d3d3; border-radius:10px; padding: none;">
                      <h5 style="font-weight: bold;">FREE OF CHARGE</h5>
                      <p>Using your availability e-Cash Balance you can convert this to the type of currency using the form below. </p>
                      <p>Procedure on how to transfer e-Cash Balance to your type of currency load wallet. </p>
                      <p> 1. Select the currency you want to exchange </p>
                      <p> 2. Enter the amount you wish to transfer</p>
                      <p> 3. Click the Verify Rate button to verify your balance</p>
                      <p> 4. Enter your transaction password </p>
                      <p> 5. Click the submit button. </p>

                      <h4><b><span class="text-danger">Note:</span> Please Double check Amount, Load Wallet is non-convertible to Ecash.</b></h4>

                  </div>
                </div>   
            </div>
        </div>
    </div> -->

    <div class="contentpanel" style="padding-top: 10px;"> 
        <div class="panel1 panel-default1" style="border: 0px solid;">
            <div class="col-xs-12 col-md-6">
              <div class="row">
                  <div class='col-xs-12 col-md-12'>

                    <div class="row">
                      <div class="col-xs-12 col-md-12">
                        <?php if ($API['S'] == '0'): ?>
                          <div class="alert alert-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo $API['M']; ?></div>
                        <!-- <?php //elseif ($API['S'] == 1): ?> -->
                          <!-- <div class="alert alert-success"><i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo $API['M']; ?>. Transaction #:<b><?php echo $API['TN']; ?></b></div> -->
                        <?php endif ?>

                        <?php 
                          $msg = $this->session->flashdata('msg');
                          if ($msg['S']==1): ?>
                            <div class="alert alert-success">
                                <i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo $msg['M']; ?>! <b>TRACKING NUMBER : <?php echo $msg['TN']; ?></b>
                            </div>
                        <?php endif ?>
                        
                      </div>
                    </div>

                      <div class="panel panel-default">
                        <div class="panel-body">                                                                              
                            <form name="frmForextoEcash" action="<?php echo BASE_URL() ?>fundtransfer/forextoecash_new" method="post" id="frmForextoEcash">
                              <h5 style="font-weight: bold; color: #4169E1;">TRANSFER DETAILS</h5>
                              <div class="form-group">
                                <label for="input" class="col-sm-4 control-label" id="labelDregcode">Dealer's Regcode:</label>
                                <div class="col-xs-8 col-md-8">
                                 <input type="text" class="form-control" name="inputDealersRegcode" id="inputDealersRegcode" value="<?php echo $_POST['inputDealersRegcode'];?>" placeholder="DEALER'S REGCODE" required/>
                                 </div>
                              </div>

                              <div class="form-group" id="idSourceType" style="display: none;">
                                  <label for="input" class="col-sm-4 control-label" id="labelSourceType">Source Type:</label>
                                  <div class="col-xs-8 col-md-8">
                                   <select name="sourceType" class="form-control" id='sourceType' required>
                                    <option value="" disabled selected>-- Select Source Type --</option>
                                    <option value="CASH" <?php if($_POST['sourceType'] == "CASH") echo "selected"; ?>>CASH</option>
                                    <option value="DEPOSIT" <?php if($_POST['sourceType'] == "DEPOSIT") echo "selected"; ?>>DEPOSIT</option>
                                  </select>
                                </div>
                              </div>

                              <div class="form-group">
                                  <label for="input" class="col-sm-4 control-label" id="labelSourceCurr">Source Currency:</label>
                                  <div class="col-xs-8 col-md-8">
                                   <select name="forexcurrtype" class="form-control" id='forexcurrtype' required>
                                    <!-- <option value="" disabled selected>-- Select Source Currency --</option> -->
                                    <!-- <option value="AED" <?php if($_POST['forexcurrtype'] == "AED") echo "selected"; ?>>AED</option>
                                    <option value="HKD" <?php if($_POST['forexcurrtype'] == "HKD") echo "selected"; ?>>HKD</option> -->
                                    <!-- <option value="SGD" <?php if($_POST['forexcurrtype'] == "SGD") echo "selected"; ?>>SGD</option> -->
                                    <!-- <option value="QAR" <?php if($_POST['forexcurrtype'] == "QAR") echo "selected"; ?>>QAR</option> -->
                                  </select>
                                  <small class="forexRates text-danger"></small>
                                  <input type="hidden" class="form-control" name="inputForexCurType" id='inputForexCurType' value="<?php echo $_POST['forexcurrtype'];?>"/>
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="input" class="col-sm-4 control-label" id="transferAMT">Transfer Amount:</label>
                                <div class="col-xs-8 col-md-8">
                                  <div class="input-group">
                                    <span class="transferAMT input-group-addon"><i class="fa fa fa-money"></i></span>
                                    <input type="text" class="form-control" name="inputAmountTransaction" id='inputAmountTransaction' value="<?php echo $_POST['inputAmountTransaction'];?>" placeholder="AMOUNT TRANSFER" required/>
                                  </div>
                                  <small class="validAmount text-danger"></small>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="input" class="col-sm-4 control-label" id="xRate">Exchange Rate:</label>
                                <div class="col-xs-8 col-md-8">
                                   <div class="input-group">
                                    <span class="xRate input-group-addon"><i class="fa fa fa-money"></i></span>
                                    <input type="text" class="form-control" name="xchangerate" id='xchangerate' value="<?php echo $_POST['xchangerate'];?>" placeholder="EXCHANGE RATE" readonly/>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="input" class="col-sm-4 control-label text-primary" id="convertedAMT">CONVERTED AMOUNT:</label>
                                <div class="col-xs-8 col-md-8">
                                   <div class="input-group">
                                    <span class="convertedAMT input-group-addon" style="font-weight: bold;"><i class="fa fa fa-money"></i></span>
                                    <input type="text" class="form-control" name="currate" id='currate' value="<?php echo $_POST['currate'];?>" placeholder="CONVERTED AMOUNT" readonly/>
                                  </div>
                                </div>
                              </div>
                              <!-- <div class="form-group">
                                  <div class="col-xs-10 col-md-10">
                                     <button type="button" class="btn btn-success btn-md" id="verifybalance" style="float:right;">Verify Rate</button> 
                                  </div>
                              </div> -->

                              <br/>

                              <div class="alert alert-success" style="display:none; text-align: center;" id="checkbalancesuccess"><b></b></div>
                              <div class="alert alert-danger" style="display:none; text-align: center;" id="checkbalancefailed"><b></b></div>

                              <h5 style="font-weight: bold; color: #4169E1;">ADDITIONAL CHARGES</h5>
                              <div class="form-group">
                                <label for="input" class="col-sm-4 control-label" id="sysFee">System Fee:</label>
                                <div class="col-sm-8">
                                  <div class="input-group">
                                    <span class="sysFee input-group-addon"><i class="fa fa fa-money"></i></span>
                                    <input type="text" class="form-control" name="systemfee" id='systemfee' value="<?php echo $_POST['systemfee'];?>" placeholder="SYSTEM FEE" readonly/>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="input" class="col-sm-4 control-label" id="labelrate">Remittance Fee:</label>
                                <div class="col-sm-8">
                                  <div class="input-group">
                                    <span class="remitFee input-group-addon"><i class="fa fa fa-money"></i></span>
                                    <input type="text" class="form-control" name="charge" id='charge' value="<?php echo $_POST['charge'];?>" placeholder="REMITTANCE FEE" readonly/>
                                  </div>
                                </div>
                              </div>

                              <hr>

                              <div class="form-group">
                                <label for="input" class="col-sm-4 control-label text-primary" id="labelrate">TOTAL AMOUNT DUE:</label>
                                <div class="col-sm-8">
                                  <div class="input-group">
                                    <span class="totalcvtAMT input-group-addon" style="font-weight: bold;"><i class="fa fa fa-money"></i></span>
                                    <input type="text" class="form-control" name="totalAmount" id='totalAmount' value="<?php echo $_POST['totalAmount'];?>" placeholder="TOTAL AMOUNT DUE" readonly/>
                                    <input type="hidden" class="form-control" name="totalCharge" id='totalCharge' value="<?php echo $_POST['totalCharge'];?>" readonly/>
                                  </div>
                                </div>
                              </div>
                              
                              <div class="form-group text-right">
                                <div class="col-xs-12 col-md-12">
                                  <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" id='submitc' data-target="#" disabled>Submit</button>  -->
                                  <button type="button" class="btn btn-info btn-lg submitc" data-toggle="modal" id="submitc" data-target="#" href="#myModal" <?php echo $_POST['currate']?"":'disabled';?> >Submit</button>
                                </div>
                              </div>

                              <div id="myModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title"><b>Transaction Summary</b></h4>
                                    </div>
                                   
                                    <div class="modal-body">
                                      <div class="alert alert-info"><b>Please check your details and click "Confirm button" to proceed with the transaction.</b></div>

                                      <h5 style="font-weight: bold; color: #4169E1;">TRANSFER DETAILS</h5>

                                      <div class="form-group">
                                        <label for="input" class="col-sm-4 control-label">Dealer's Regcode:</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control idReg" id='idReg' readonly/>
                                        </div>
                                      </div>

                                      <div class="form-group" id="idMainSrcType" style="display: none;">
                                        <label for="input" class="col-sm-4 control-label">Source Type:</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control idSrcType" id='idSrcType' readonly/>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label for="input" class="col-sm-4 control-label">Source Currency:</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control idSrcCur" id='idSrcCur' readonly/>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label for="input" class="col-sm-4 control-label">Transfer Amount:</label>
                                        <div class="col-sm-6">
                                          <!-- <input type="text" class="form-control idAmt" id='idAmt' readonly/> -->
                                          <div class="input-group">
                                            <span class="transferAMT input-group-addon"></span>
                                            <input type="text" class="form-control idAmt" id='idAmt' readonly/>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label for="input" class="col-sm-4 control-label">Exchange Rate:</label>
                                        <div class="col-sm-6">
                                          <!-- <input type="text" class="form-control idXrate" id='idXrate' readonly/> -->
                                          <div class="input-group">
                                            <span class="xRate input-group-addon"></span>
                                            <input type="text" class="form-control idXrate" id='idXrate' readonly/>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label for="input" class="col-sm-4 control-label text-primary">CONVERTED AMOUNT:</label>
                                        <div class="col-sm-6">
                                          <!-- <input type="text" class="form-control idConvertedAmt" id='idConvertedAmt' readonly/> -->
                                          <div class="input-group">
                                            <span class="convertedAMT input-group-addon" style="font-weight: bold;"></span>
                                            <input type="text" class="form-control idConvertedAmt" id='idConvertedAmt' readonly/>
                                          </div>
                                        </div>
                                      </div>

                                      <h5 style="font-weight: bold; color: #4169E1;">ADDITIONAL CHARGES</h5>

                                      <div class="form-group">
                                        <label for="input" class="col-sm-4 control-label">System Fee:</label>
                                        <div class="col-sm-6">
                                          <!-- <input type="text" class="form-control idSysfee" id='idSysfee' readonly/> -->
                                          <div class="input-group">
                                            <span class="sysFee input-group-addon"></span>
                                            <input type="text" class="form-control idSysfee" id='idSysfee' readonly/>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label for="input" class="col-sm-4 control-label">Remittance Fee:</label>
                                        <div class="col-sm-6">
                                          <!-- <input type="text" class="form-control idRemitfee" id='idRemitfee' readonly/> -->
                                          <div class="input-group">
                                            <span class="remitFee input-group-addon"></span>
                                            <input type="text" class="form-control idRemitfee" id='idRemitfee' readonly/>
                                          </div>
                                        </div>
                                      </div>

                                      <hr/>

                                      <div class="form-group">
                                        <label for="input" class="col-sm-4 control-label text-primary">TOTAL AMOUNT DUE:</label>
                                        <div class="col-sm-6">
                                          <!-- <input type="text" class="form-control idTotalAmtDue" id='idTotalAmtDue' readonly/> -->
                                          <div class="input-group">
                                            <span class="totalcvtAMT input-group-addon" style="font-weight: bold;"></span>
                                            <input type="text" class="form-control idTotalAmtDue" id='idTotalAmtDue' readonly/>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label for="input" class="col-sm-4 control-label">Transaction password:</label>
                                          <div class="col-sm-6">
                                             <input type="password" class="form-control" name="inputTpass" id='inputTpass' placeholder="TRANSACTION PASSWORD" required />
                                          </div>
                                      </div>

                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-primary"  name="btnSubmit" id='btnSubmit'>Confirm</button>
                                    </div>
                                  </div>

                                </div>
                              </div>
                          </form>
                        </div>
                      </div>

                      
                  </div> <!-- col-xs-8 col-md-8-->
              </div> <!-- row -->
            </div> <!--col-xs-6 col-md-6-->

            <div class="col-xs-12 col-md-6">
                <div class="panel panel-default">
                  <div class="panel-body" style="border: 1px solid #d3d3d3;">
                      <h5 style="font-weight: bold;">Important Reminder:</h5>

                      <!-- <p>A fixed System Fee of <b class="text-danger">15 AED</b> and applicable Remittance Fee will be charged to the Client on top of the Transfer Amount.</p> -->
                      <p class="reminders"></p>

                      <table class="table table-bordered">
                        <thead class="theadcurrencyrates">
                          <!-- <tr>
                            <th>Amount</th>
                            <th>Remittance Fee</th>
                          </tr> -->
                        </thead>
                        <tbody class="tbodycurrencyrates">
                          <!-- <tr>
                            <td>PHP 1.00 - PHP 50,000</td>
                            <td>AED 9.00</td>
                          </tr>
                          <tr>
                            <td>PHP 50,0001 - PHP 75,000</td>
                            <td>AED 11.00</td>
                          </tr>
                          <tr>
                            <td>PHP 75,0001 - PHP 100,000</td>
                            <td>AED 13.00</td>
                          </tr>
                          <tr>
                            <td>PHP 100,0001 - PHP 200,000</td>
                            <td>AED 15.00</td>
                          </tr> -->
                        </tbody>
                      </table>

                  </div>
                </div>   
            </div>

          </div>
        </div>      

   </div><!-- mainpanel -->            


<script src="<?php echo BASE_URL()?>assets/js/jquery-2.1.4.min.js"></script>
<script>
  $(window).load(function() {

      var inputForexCurType = $("#inputForexCurType").val();

      $(".forexRates").html('<i class="text-danger fa fa-spinner fa-spin" style="font-size: 20px;"></i> ');
      $(".reminders").html('<i class="text-danger fa fa-spinner fa-spin" style="font-size: 20px;"></i> ');

      $('.tbodycurrencyrates').empty();
      $('.theadcurrencyrates').empty();

      var currtype = $("#forexcurrtype").val();

      if(inputForexCurType){
        currtype = inputForexCurType;
      } else {
        currtype = currtype ? currtype : ''; 
      }

      // currtype = currtype ? currtype : 'AED';
      // console.log(parameters);

      var parameters = {currtype:currtype,inputAmountTransaction:1};
      // console.log(parameters);

          $.ajax({
          url: "/Fundtransfer/check_balanceafter",
          type: "POST",
          data: parameters,
          // data: formData,

              success: function(data)
              {
                  var jsondata = JSON.parse(data);
                 
                  console.log(jsondata);

                  // console.log(jsondata.T_DATA);
                  
                  if(jsondata.S == 1){

                    waitingDialog.hide();
                    // 14.4500

                    rateForex = '1 ' + currtype + ' = PHP ' + jsondata.R ;
                    $(".forexRates").html(rateForex); 
                    $("#xchangerate").val(jsondata.R); 
                    // $(".transferAMT").html(currtype ? currtype : jsondata.C);
                    $(".transferAMT").html(currtype ? currtype : jsondata.INFO[0]['currency']);
                    $(".xRate").html('PHP');

                    $("#inputAmountTransaction").prop("disabled", false); 
                    $('#forexcurrtype').css('border','1px solid #ccc');

                    $(".convertedAMT").html('PHP');
                    $(".sysFee").html(currtype ? currtype : jsondata.C);
                    $(".remitFee").html(currtype ? currtype : jsondata.C);
                    $(".totalcvtAMT").html(currtype ? currtype : jsondata.C);

                    $.each(jsondata.curtype, function(key, val) {
                      // console.log(val);
                      // console.log(addCommas(val['start_amount']));

                      $('#forexcurrtype').append('<option value="'+val['currency']+'">'+val['currency']+'</option>');  

                    });

                    // var getCurtype = currtype ? currtype : jsondata.C;
                    var getCurtype = currtype ? currtype : jsondata.INFO[0]['currency'];
                    $(".reminders").html('<p>A fixed System Fee of <b class="text-danger">'+getCurtype+' '+Number(jsondata.INFO[0]['company_income'])+'</b> and applicable Remittance Fee will be charged to the Client on top of the Transfer Amount.</p>');

                    $('.theadcurrencyrates').append('<tr> <th>Amount</th><th>Remittance Fee</th> </tr>');  
                    $.each(jsondata.INFO, function(key, val) {
                      // console.log(val);
                      // console.log(addCommas(val['start_amount']));
                      var sCharge = parseFloat(val['service_charge']).toFixed(2);
                      var start_amount = parseFloat(val['start_amount']).toFixed(2);
                      var end_amount = parseFloat(val['end_amount']).toFixed(2);
                      // console.log(sCharge);
                      
                      $('.tbodycurrencyrates').append('<tr> <td>PHP '+addCommas(start_amount)+' - PHP '+addCommas(end_amount)+'</td> <td>'+val['currency']+' '+sCharge+'</td> </tr>');  

                    });

                    $('[name=forexcurrtype] option').filter(function() { 
                        return ($(this).text() == currtype); //To select Blue
                    }).prop('selected', true);

                    if(jsondata.C == 'AED' || jsondata.INFO[0]['currency'] == 'AED' || jsondata.INFO[0]['currency'] == 'MYR') {
                      $('#idSourceType').show();
                    } else {
                      $('#idSourceType').hide();
                    }

                  }
                  else
                  {
                    waitingDialog.hide();

                    $('#idSourceType').hide();

                    $('.tbodycurrencyrates').empty();
                    $('.theadcurrencyrates').empty();
                    $(".forexRates").html(jsondata.M);
                    $("#xchangerate").val(''); 
                    $(".transferAMT").html('<i class="text-danger fa fa-money"></i>');
                    $(".xRate").html('<i class="text-danger fa fa-money"></i>');

                    $("#inputAmountTransaction").prop("disabled", true); 
                    $('#forexcurrtype').css('border','1px solid red');
                }
              }
      });

  });

  // ## FOREX TO ECASH SCRIPT -- START
  $(document).ready(function(){

    $('#submitc').click(function() {
      var dealer      = $("#inputDealersRegcode").val();
      var currtype    = $("#forexcurrtype").val();
      var amount      = $("#inputAmountTransaction").val();
      var xchangerate = $("#xchangerate").val();
      var currate     = $("#currate").val();
      var systemfee   = $("#systemfee").val();
      var charge      = $("#charge").val();
      var totalAmount = $("#totalAmount").val();
      var sourcetype    = $("#sourceType").val();
      
      // alert(sourcetype);

      if(currtype == 'AED' || currtype == 'MYR') {
        sourcetype = sourcetype;
      } else {
        sourcetype = 'CASH';
      }

      if(dealer && currtype && amount && xchangerate && currate && systemfee && charge && totalAmount && sourcetype){
        $('#myModal').modal('show');

        $('#myModal .idReg').val(dealer);
        $('#myModal .idSrcCur').val(currtype);
        $('#myModal .idAmt').val(amount);
        $('#myModal .idXrate').val(xchangerate);  
        $('#myModal .idConvertedAmt').val(currate);  
        $('#myModal .idSysfee').val(systemfee);  
        $('#myModal .idRemitfee').val(charge);  
        $('#myModal .idTotalAmtDue').val(totalAmount);  

        if(currtype == 'AED' || currtype == 'MYR') {
          $('#idMainSrcType').show();
        } else {
          $('#idMainSrcType').hide();

          $('#sourceType option[value='+sourcetype+']').attr('selected','selected');
        }

        $('#myModal .idSrcType').val(sourcetype); 
      
      } else {
        alert('Please fill up all fields.');
        $('#myModal').modal('hide');
      }
      
    });


    // $("#inputAmountTransaction").change(function () {
    $("#inputAmountTransaction").on("input", function() {
    // $("#verifybalance").click(function () {
     
      // waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});

      $(".convertedAMT").html('<i class="text-danger fa fa-spinner fa-spin" style="font-size: 20px;"></i> ');
      $(".totalcvtAMT").html('<i class="text-danger fa fa-spinner fa-spin" style="font-size: 20px;"></i> ');
      $(".sysFee").html('<i class="text-danger fa fa-spinner fa-spin" style="font-size: 20px;"></i> ');
      $(".remitFee").html('<i class="text-danger fa fa-spinner fa-spin" style="font-size: 20px;"></i> ');

      var currtype = $("#forexcurrtype").val();
      var inputAmountTransaction = $("#inputAmountTransaction").val();
      var xchangerate = $("#xchangerate").val();

      var currate = inputAmountTransaction * xchangerate;
      var convertedamount = currate.toFixed(4);
      
      // alert(currate);
      $("#currate").val(convertedamount);

      if(inputAmountTransaction == ' ' || inputAmountTransaction == 0 || convertedamount == ' ' || convertedamount == 0) {
        $('#inputAmountTransaction').css('border','1px solid red');
        $(".validAmount").html('<i class="text-danger fa fa-exclamation-circle"> Please input a valid amount.</i> ');
        $("#currate").val("");
        $("#systemfee").val("");
        $("#charge").val("");
        $("#totalCharge").val("");
        $("#totalAmount").val("");

      } else {  
          // var formData = new FormData($('#frmecashtoforex')[0]);
          var parameters = {currtype:currtype,inputAmountTransaction:convertedamount};
          // console.log(parameters);

              $.ajax({
              url: "/Fundtransfer/check_forexecash_rates",
              type: "POST",
              data: parameters,
              // data: formData,

                  success: function(data)
                  {
                      var jsondata = JSON.parse(data);
                     
                      // console.log(jsondata);

                      // console.log(jsondata.T_DATA);
                      
                      if(jsondata.S == 1){

                      waitingDialog.hide();
                      // 14.4500

                      var totalconvertedAMT = Number(inputAmountTransaction) + Number(jsondata.charge) + Number(jsondata.sysfee);
                      var totalCharge = Number(jsondata.charge) + Number(jsondata.sysfee);
                      $("#systemfee").val(jsondata.sysfee);
                      $("#charge").val(jsondata.charge);
                      $("#totalAmount").val(totalconvertedAMT.toFixed(4));
                      $("#totalCharge").val(totalCharge.toFixed(4));
                      
                      // document.getElementById("currate").value = numb.toFixed(4);
                     
                      // cur = inputAmountTransaction + ' ' + document.getElementById("forexcurrtype").value + ' = PHP :';
                      // $("#labelrate").html(cur); 
                      $("#currate").css("font-weight", "bold");
                      $("#totalAmount").css("font-weight", "bold");

                      $(".convertedAMT").html('PHP');
                      $(".sysFee").html(currtype);
                      $(".remitFee").html(currtype);
                      $(".totalcvtAMT").html(currtype);

                      $(".validAmount").html('');

                      // hide message
                      // $("#checkbalancesuccess").html(jsondata.M);
                      // $("#checkbalancesuccess").show();
                      $("#checkbalancefailed").hide();
                      $("#inputTpass").prop("disabled", false); 
                      $("#submitc").prop("disabled", false); 
                      // $("#checkbalancesuccess").fadeTo(2000, 500).slideUp(500, function(){
                      //   $("#checkbalancesuccess").slideUp(500);
                      // });

                      $('#inputAmountTransaction').css('border','1px solid #ccc');

                      }
                      else
                      {
                        waitingDialog.hide();

                      document.getElementById("currate").value = "";
                      document.getElementById("systemfee").value = "";
                      document.getElementById("charge").value = "";
                      document.getElementById("totalCharge").value = "";
                      document.getElementById("totalAmount").value = "";
                      // $("#labelrate").html('Currency Rate:'); 
                      $(".convertedAMT").html('<i class="text-danger fa fa-money"></i>');
                      $(".sysFee").html('<i class="text-danger fa fa-spinner fa-spin" style="font-size: 20px;"></i> ');
                      $(".remitFee").html('<i class="text-danger fa fa-spinner fa-spin" style="font-size: 20px;"></i> ');
                      $(".totalcvtAMT").html('<i class="text-danger fa fa-spinner fa-spin" style="font-size: 20px;"></i> ');

                      $("#currate").css("font-weight", "normal");
                      $("#totalAmount").css("font-weight", "normal");

                      // hide message
                      $("#checkbalancefailed").html(jsondata.M);
                      $("#checkbalancefailed").show();
                      $("#checkbalancesuccess").hide();
                      $("#inputTpass").prop("disabled", true); 
                      $("#submitc").prop("disabled", true); 
                      // $("#checkbalancefailed").fadeTo(2000, 500).slideUp(500, function(){
                      //   $("#checkbalancefailed").slideUp(500);
                      // });

                      $('#inputAmountTransaction').css('border','1px solid red');
                    }
                  }
          });
      }

    });


    // $("#btnSubmitex").click(function () {
    //   waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
    // });

    $('#frmForextoEcash').on('submit',function(){
      waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
    });

    $("#forexcurrtype").change(function () {
      $("#inputAmountTransaction").prop("disabled", true); 
      $("#inputAmountTransaction").val("");
      $("#currate").val("");
      
      $("#systemfee").val("");
      $("#charge").val("");
      $("#totalCharge").val("");
      $("#totalAmount").val("");

      $("#currate").css("font-weight", "normal");
      $("#totalAmount").css("font-weight", "normal");
      
      $(".forexRates").html('<i class="text-danger fa fa-spinner fa-spin" style="font-size: 20px;"></i> ');
      $(".reminders").html('<i class="text-danger fa fa-spinner fa-spin" style="font-size: 20px;"></i> ');
      $('.tbodycurrencyrates').empty();
      $('.theadcurrencyrates').empty();

      var currtype = $("#forexcurrtype").val();

      var parameters = {currtype:currtype,inputAmountTransaction:1};
      // console.log(parameters);

          $.ajax({
          url: "/Fundtransfer/check_balanceafter",
          type: "POST",
          data: parameters,
          // data: formData,

              success: function(data)
              {
                  var jsondata = JSON.parse(data);
                 
                  console.log(jsondata);

                  // console.log(jsondata.T_DATA);
                  
                  if(jsondata.S == 1){

                    waitingDialog.hide();
                    // 14.4500

                    rateForex = '1 ' + currtype + ' = PHP ' + jsondata.R ;
                    $(".forexRates").html(rateForex); 
                    $("#xchangerate").val(jsondata.R); 
                    $(".transferAMT").html(currtype);
                    $(".xRate").html('PHP');

                    $(".sysFee").html(currtype);
                    $(".remitFee").html(currtype);
                    $(".totalcvtAMT").html(currtype);

                    $("#inputAmountTransaction").prop("disabled", false); 
                    $('#forexcurrtype').css('border','1px solid #ccc');

                    $(".reminders").html('<p>A fixed System Fee of <b class="text-danger">'+currtype+' '+Number(jsondata.INFO[0]['company_income'])+'</b> and applicable Remittance Fee will be charged to the Client on top of the Transfer Amount.</p>');
                    
                    $('.theadcurrencyrates').append('<tr> <th>Amount</th><th>Remittance Fee</th> </tr>');  
                    $.each(jsondata.INFO, function(key, val) {
                      // console.log(val);
                      // console.log(addCommas(val['start_amount']));
                      var sCharge = parseFloat(val['service_charge']).toFixed(2);
                      var start_amount = parseFloat(val['start_amount']).toFixed(2);
                      var end_amount = parseFloat(val['end_amount']).toFixed(2);
                      // console.log(sCharge);

                      $('.tbodycurrencyrates').append('<tr> <td>PHP '+addCommas(start_amount)+' - PHP '+addCommas(end_amount)+'</td> <td>'+val['currency']+' '+sCharge+'</td> </tr>');  

                    });

                  }
                  else
                  {
                    waitingDialog.hide();

                    $("#currate").css("font-weight", "normal");
                    $("#totalAmount").css("font-weight", "normal");

                    $('.tbodycurrencyrates').empty();
                    $('.theadcurrencyrates').empty();
                    $(".forexRates").html(jsondata.M);
                    $("#xchangerate").val(''); 
                    $(".transferAMT").html('<i class="text-danger fa fa-money"></i>');
                    $(".xRate").html('<i class="text-danger fa fa-money"></i>');

                    $("#inputAmountTransaction").prop("disabled", true); 
                    $('#forexcurrtype').css('border','1px solid red');
                }
              }
      });


    });

  });
  // ## FOREX TO ECASH SCRIPT -- END


  function addCommas(nStr) {
      nStr += '';
      x = nStr.split('.');
      x1 = x[0];
      x2 = x.length > 1 ? '.' + x[1] : '';
      var rgx = /(\d+)(\d{3})/;
      while (rgx.test(x1)) {
              x1 = x1.replace(rgx, '$1' + ',' + '$2');
      }
      return x1 + x2;
  }

</script>