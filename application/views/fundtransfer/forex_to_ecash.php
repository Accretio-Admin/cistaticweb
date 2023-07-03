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
                <h4>Forex Currency transfer to E-Cash</h4>
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
                  <div class='col-xs-10 col-md-10'>

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
                                <i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo $msg['M']; ?>. <b>TRACKING NUMBER : <?php echo $msg['TN']; ?></b>
                            </div>
                        <?php endif ?>
                        
                      </div>
                    </div>

                      <div class="panel panel-default">
                        <div class="panel-body">                                                                              
                            <form name="frmForextoEcash" action="<?php echo BASE_URL() ?>fundtransfer/forextoecash" method="post" id="frmForextoEcash">
                              <h5 style="font-weight: bold; color: #4169E1;">TRANSFER DETAILS</h5>
                              <div class="form-group">
                                <label for="input" class="col-sm-4 control-label" id="labelDregcode">Dealer's Regcode:</label>
                                <div class="col-xs-8 col-md-8">
                                 <input type="text" class="form-control" name="inputDealersRegcode" id="inputDealersRegcode" value="<?php echo $_POST['inputDealersRegcode'];?>" placeholder="DEALER'S REGCODE" required/>
                                 </div>
                              </div>
                              <div class="form-group">
                                  <label for="input" class="col-sm-4 control-label" id="labelSourceCurr">Source Currency:</label>
                                  <div class="col-xs-8 col-md-8">
                                   <select name="forexcurrtype" class="form-control" id='forexcurrtype' required>
                                    <option value="" disabled selected>-- Select Source Currency --</option>
                                    <option value="SGD" <?php if($_POST['forexcurrtype'] == "SGD") echo "selected"; ?>>SGD</option>
                                    <option value="AED" <?php if($_POST['forexcurrtype'] == "AED") echo "selected"; ?>>AED</option>
                                    <option value="QAR" <?php if($_POST['forexcurrtype'] == "QAR") echo "selected"; ?>>QAR</option>
                                    <option value="HKD" <?php if($_POST['forexcurrtype'] == "HKD") echo "selected"; ?>>HKD</option>
                                  </select>
                                  <small class="forexRates text-danger"></small>
                                </div>
                              </div>
                              
                              <div class="form-group">
                                <label for="input" class="col-sm-4 control-label" id="labelAmount">Amount Transfer:</label>
                                <div class="col-xs-8 col-md-8">
                                   <input type="text" class="form-control" name="inputAmountTransaction" id='inputAmountTransaction' value="<?php echo $_POST['inputAmountTransaction'];?>" placeholder="AMOUNT TRANSFER" required/>
                                   <small class="validAmount text-danger"></small>
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

                              <h5 style="font-weight: bold; color: #4169E1;">EXCHANGE DETAILS</h5>
                              <div class="form-group">
                                <label for="input" class="col-sm-4 control-label" id="labelrate">Total Converted Amount:</label>
                                <div class="col-sm-8">
                                  <div class="input-group">
                                    <span class="xchangerate input-group-addon"><i class="fa fa fa-money" style="font-size: 20px;"></i></span>
                                    <input type="text" class="form-control" name="currate" id='currate' value="<?php echo $_POST['currate'];?>" placeholder="CONVERTED AMOUNT" readonly/>
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
                                      <!-- <div class="alert alert-info"><b>Please check your details and click "confirm button" to proceed transaction.</b></div> -->

                                      <div class="form-group">
                                        <label for="input" class="col-sm-4 control-label">Dealer's Regcode:</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control idReg" id='idReg' readonly/>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label for="input" class="col-sm-4 control-label">Source Currency:</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control idSrcCur" id='idSrcCur' readonly/>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label for="input" class="col-sm-4 control-label">Amount:</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control idAmt" id='idAmt' readonly/>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label for="input" class="col-sm-4 control-label">Total Converted Amount:</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control idRate" id='idRate' readonly/>
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
                                      <button type="submit" class="btn btn-primary"  name="btnSubmit" id='btnSubmit'>Proceed</button>
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
          </div>
        </div>      

   </div><!-- mainpanel -->            


<script src="<?php echo BASE_URL()?>assets/js/jquery-2.1.4.min.js"></script>
<script>
  // ## FOREX TO ECASH SCRIPT -- START
  $(document).ready(function(){

    $('#submitc').click(function() {
      var dealer      = $("#inputDealersRegcode").val();
      var currtype    = $("#forexcurrtype").val();
      var amount      = $("#inputAmountTransaction").val();
      var currate     = $("#currate").val();

      // alert(dealer);
      // alert(currtype);
      // alert(amount);
      // alert(currate);

      if(dealer && currtype && amount && currate){
        $('#myModal').modal('show');

        $('#myModal .idReg').val(dealer);
        $('#myModal .idSrcCur').val(currtype);
        $('#myModal .idAmt').val(amount);
        $('#myModal .idRate').val(currate);  
      
      } else {
        alert('Please fill up all fields.');
        $('#myModal').modal('hide');
      }
      
    });


    // $("#inputAmountTransaction").change(function () {
    $("#inputAmountTransaction").on("input", function() {
    // $("#verifybalance").click(function () {
     
      // waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});

      $(".xchangerate").html('<i class="text-danger fa fa-spinner fa-spin" style="font-size: 20px;"></i> ');

      var currtype = $("#forexcurrtype").val();
      var inputAmountTransaction = $("#inputAmountTransaction").val();

      // alert(inputAmountTransaction);
      if(inputAmountTransaction == ' ' || inputAmountTransaction == 0) {
        $('#inputAmountTransaction').css('border','1px solid red');
        $(".validAmount").html('<i class="text-danger fa fa-exclamation-circle"> Please input a valid amount.</i> ');
        $("#currate").val("");

      } else {  
          // var formData = new FormData($('#frmecashtoforex')[0]);
          var parameters = {currtype:currtype,inputAmountTransaction:inputAmountTransaction};
          // console.log(parameters);

              $.ajax({
              url: "/Fundtransfer/check_balanceafter",
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

                      var numb = jsondata.R * inputAmountTransaction;
                      document.getElementById("currate").value = numb.toFixed(2);
                     
                      // cur = inputAmountTransaction + ' ' + document.getElementById("forexcurrtype").value + ' = PHP :';
                      // $("#labelrate").html(cur); 

                      $(".xchangerate").html('<i class="text-success fa fa-money" style="font-size: 20px;"></i> ');

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
                      $("#labelrate").html('Currency Rate:'); 

                      $(".xchangerate").html('<i class="text-danger fa fa-spinner fa-spin" style="font-size: 20px;"></i> ');

                      // hide message
                      $("#checkbalancefailed").html(jsondata.M);
                      $("#checkbalancefailed").show();
                      $("#checkbalancesuccess").hide();
                      $("#inputTpass").prop("disabled", true); 
                      $("#submitc").prop("disabled", true); 
                      $("#checkbalancefailed").fadeTo(2000, 500).slideUp(500, function(){
                        $("#checkbalancefailed").slideUp(500);
                      });

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
      $("#inputAmountTransaction").val("");
      $("#currate").val("");

      // var cur = '';
      // // var curba = '';
      // var inputAmountTransaction = $("#inputAmountTransaction").val();

      // cur = inputAmountTransaction + ' ' + document.getElementById("forexcurrtype").value + ' = PHP :';
      // // curba = document.getElementById("forexcurrtype").value + ' Balance After:';

      // $("#labelrate").html(cur); 
      // // $("#labelcurrba").html(curba); 

      $(".forexRates").html('<i class="text-danger fa fa-spinner fa-spin" style="font-size: 20px;"></i> ');

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
                 
                  // console.log(jsondata);

                  // console.log(jsondata.T_DATA);
                  
                  if(jsondata.S == 1){

                    waitingDialog.hide();
                    // 14.4500

                    rateForex = '1 ' + currtype + ' = PHP ' + jsondata.R ;
                    $(".forexRates").html(rateForex); 

                    $("#inputAmountTransaction").prop("disabled", false); 
                    $('#forexcurrtype').css('border','1px solid #ccc');

                  }
                  else
                  {
                    waitingDialog.hide();

                    $(".forexRates").html(jsondata.M);

                    $("#inputAmountTransaction").prop("disabled", true); 
                    $('#forexcurrtype').css('border','1px solid red');
                }
              }
      });


    });

  });
  // ## FOREX TO ECASH SCRIPT -- END

</script>