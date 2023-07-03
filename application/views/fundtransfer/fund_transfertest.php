  <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-mobile-phone"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                                   <li>LOADING</li>
                                </ul>
                                <h4>FUND REQUEST</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    

                    
                    <div class="contentpanel">
                  

                   
                      <div class="row1">
                        <div class="col-md-8 alert alert-info" >
                         
                         <font color = "red">
                          <p><b>Note :</b></p>
                          <p>1. if you made a mistake in the details of your fund request,
                          simply submit another fund request with the correct details 
                          and put an X at the beginning of the deposit reference number</p>

                           <p><b>Example:</b></p>
                          <p>-BDO|4000.00|x338IRCD397|2017/01/04</p>
                          <p>-BDO|4500.00|338IRCD397|2017/01/04</p>

                          <p>2. Deposit slip must reflect the<span style = "text-decoration: underline; font-weight: bold;"> ACTUAL</span> amount 
                          deposited to our International bank accounts. Any fee/charge from the chosen bank/channel must be paid by the 
                          users. </p>

                          <p>3. If amount on the deposit slip is inclusive of fee/charge, please input<span style = "text-decoration: underline; font-weight: bold;"> ACTUAL</span>
                          amount, (reflected amount less fee/charge) and put a note on the deposit slip. </p>
                        </font>

                       </div>
                      </div>

                      <div class="row">
                        <div class="col-md-8" >

                          <?php if ($result['S']===0): ?>
                                <div class="alert alert-danger"><?php echo $result['M']; ?></div>
                          <?php endif ?>
                        
                          <?php 
                          $msg = $this->session->flashdata('msg');
                          if ($msg['S']==1): ?>
                            <div class="alert alert-success">
                                <?php echo $msg['M']; ?><br />
                                <b>TRACKING NUMBER : <?php echo $msg['TN']; ?></b>
                            </div>
                          <?php endif ?>

                          <?php 
                          $msgsuccess = $this->session->flashdata('msgsuccess');
                            if ($msgsuccess['success']==1): ?>
                            <div class="alert alert-success"><b><?php echo $msgsuccess['M']; ?></b></div>
                          <?php endif ?>

                          <?php 
                            $msgsuccess = $this->session->flashdata('msgsuccess');
                            if ($msgsuccess['success']==2): ?>
                            <div class="alert alert-danger"><b><?php echo $msgsuccess['M']; ?></b></div>
                          <?php endif ?>

                        </div>
                      </div>
                          <div class="row">
                              <div class="col-xs-12  col-md-8">
                                <div class="row">
                                    <div class='col-xs-12 col-md-12'>    
                                      <h2>Step 1: Upload Image</h2>
                                    </div>
                                    <div class='col-xs-12 col-md-12'>    
                                          <form name="frmfundtransfer" action="<?php echo BASE_URL()?>Fundtransfer/check_uploadtest" method="post" id="frmfundtransfer" enctype="multipart/form-data" >
                                              <div class="row">
                                                          <div class="col-xs-12 col-md-6">
                                                              <div class="form-group">
                                                        
                                                               <input type="file" class="form-control" name="file" title="No File Found"   tabindex="1"  <?php if($this->session->has_userdata('image_pubid')){echo "disabled";}else{echo "required='required'";}?>"/>
                                                               <small><font color="red">*Note : (JPEG,PNG,JPG File type only)</font></small>
                                                             
                                                              </div>
                                                               <div class="form-group text-right">
                                                                 <?php if($this->session->has_userdata('image_pubid')): ?>
                                                                  <button type="submit" class="btn btn-danger" tabindex="10"  name="btnReset" >Reset</button>
                                                                  <?php endif ?>
                                                                <button type="submit" class="btn btn-info" tabindex="10"  name="btnUpload" >Upload</button>
                                                              </div>
                                                          </div>

                                                          <?php if($this->session->has_userdata('image_pubid')): ?>
                                                                  
                                                            <span class="col-xs-12 col-md-6 alert alert-info"><b>Successfully Uploaded!</br>Please proceed to STEP 2 below.</b></br> <i><small><font color="red">*</font></small> If you want to replace the image, kindly upload again.</i></span>  
                                                         
                                                          <?php endif ?>
                                                </div>
                                                </form>
                                                <form name="frmfundtransfer" action="<?php echo BASE_URL()?>Fundtransfer/fund_transfer" method="post" id="frmfundtransfer" enctype="multipart/form-data">
                                              <div class="row">
                                                  <div class='col-xs-12 col-md-12'>    
                                                    <h2>Step 2: Input Required Fields</h2>
                                                  </div>
                                                  <div class="col-xs-12 col-md-6">
                                                      <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                             <div class="form-group" >
                                                                <input type="text" class="form-control" name="inputRegcode" value="<?php echo $user['R']?>" readonly placeholder="REGCODE" required/>
                                                              </div>
                                                         </div>
                                                      </div>
                                                      <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                             <div class="form-group">
                                                               <input type="text" class="form-control" id="inputMobile" name="inputMobile" onkeypress="return isNumberKey(event)" placeholder="MOBILE NO" tabindex="2" minlength="11" autocomplete="off" maxlength="11"  required <?php if(!$this->session->has_userdata('image_pubid')){echo "disabled";}?> value="<?php echo $_POST['inputMobile']?>"/>
                                                            <script>
                                                                     function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : evt.keyCode;

          
          if ((charCode >= 48 && charCode <= 57)) { 
               return true;
          }
          return false;
       }
       
       $('#inputMobile').on('paste', function (event) {
  if (event.originalEvent.clipboardData.getData('Text').match(/[^\d]/)) {
    event.preventDefault();
  }
});
                                                            </script>
                                                            </div>
                                                         </div>
                                                      </div>
                                                       <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                             <div class="form-group">
                                                              <select name="selFund" id="selFund" class="form-control" required <?php if(!$this->session->has_userdata('image_pubid')){echo "disabled";}?>>
                                                                    <option value="0" disabled selected>FUND TYPE</option>
                                                                    <option value="ECASH" <?php if($_POST['selFund'] == "ECASH") echo "selected"; ?>>ECASH</option>
                                                                    <?php 
                                                                    if($user['L'] == 5)
                                                                    {
                                                                      ?>

                                                                    <option value="LOADWALLET" <?php if($_POST['selFund'] == "LOADWALLET") echo "selected"; ?>>LOADWALLET <?php echo $user['UL']?></option>
                                                                    <?php
                                                                    }
                                                                    ?>

                                                                    ?>
                                                              </select>
                                                            </div>
                                                         </div>
                                                      </div> 
                                                      <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                             <div class="form-group">
                                                                 <select  name="selDeposit" id ="selDeposit" class="form-control" required tabindex="3" <?php if(!$this->session->has_userdata('image_pubid')){echo "disabled";}?>>
                                                                      <option value="0" disabled selected>DEPOSIT TYPE</option>
                                                                       <option value="Bank Deposit" <?php if($_POST['selDeposit'] == "Bank Deposit") echo "selected"; ?>>Bank Deposit</option>
                              <!--                                         <option value="Online Deposit" <?php if($_POST['selDeposit'] == "Online Deposit") echo "selected"; ?>>Online Deposit</option>
                                                                      <option value="SmartMoney" <?php if($_POST['selDeposit'] == "SmartMoney") echo "selected"; ?>>SmartMoney</option> -->

                                                                 </select>
                                                            </div>
                                                         </div>
                                                      </div> 
                                                      <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                             <div class="form-group">
                                                                <!-- <input type="text" class="form-control" name="inputBank" id="inputBank" placeholder="INSTITUTION - BANK NAME" required tabindex="4" <?php if(!$this->session->has_userdata('image_pubid')){echo "disabled";}?> value="<?php echo $_POST['inputBank']?>"/> -->
                                                                 <select  name="inputBank" id ="inputBank" class="form-control" required tabindex="3" <?php if(!$this->session->has_userdata('image_pubid')){echo "disabled";}?>>
                                                                      <option value="0" disabled selected>INSTITUTION - BANK NAME</option>
                                                                       <option value="BDO" <?php if($_POST['inputBank'] == "BDO") echo "selected"; ?>>BDO</option>
                                                                      <!-- <option value="UCPB" <?php if($_POST['inputBank'] == "UCPB") echo "selected"; ?>>UCPB</option> -->
                                                                      <option value="SECURITY BANK" <?php if($_POST['inputBank'] == "SECURITY BANK") echo "selected"; ?>>SECURITY BANK</option>
                                                                      <option value="OCBC" <?php if($_POST['inputBank'] == "OCBC") echo "selected"; ?>>OCBC Singapore</option>

                                                                 </select>
                                                            </div>
                                                         </div>
                                                      </div> 

                                                  </div>

                                                  <div class="col-xs-12 col-md-6">
                                                      <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                             
                                                         </div>
                                                      </div> 
                                                      
                                                      <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                              <div class="form-group">
                                                                  <input type="text" class="form-control" name="inputBranchName" id="inputBranchName" placeholder="BRANCH NAME" required tabindex="5" <?php if(!$this->session->has_userdata('image_pubid')){echo "disabled";}?> value="<?php echo $_POST['inputBranchName']?>"/>
                                                              </div>
                                                         </div>
                                                      </div>
                                                      <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                             <div class="form-group">
                                                              <select id="selFunded" name="currency" class="form-control" onchange="selFunds(this.value)" required <?php if(!$this->session->has_userdata('image_pubid')){echo "disabled";}?>>

                                                                    <option value="" disabled selected>CURRENCY</option>
                                                                    <option value="PHP" <?php if($_POST['selCurrency'] == "PHP") echo "selected"; ?>>PHP</option>
                                                                    <option value="USD" <?php if($_POST['selCurrency'] == "USD") echo "selected"; ?>>USD</option>
                                                                    <option value="SGD" <?php if($_POST['selCurrency'] == "SGD") echo "selected"; ?>>SGD</option>


                                                              </select>
                                                              <!-- <button type="button" onclick="GetSelectedValue()">Get Selected Value</button> -->
                                                              <script>
                                                              
                                                              

                                                              function selFunds(value){
                                                                console.log(value);
                                                                callCurrencyRate(value);
                                                                document.getElementById("currency").innerHTML = value;
                                                                document.getElementById("convertedAmount").value = "";
                                                                document.getElementById("totalAmount").value = "";
                                                                if(value == "USD"){
                                                                
                                                                $("#showMessage").show();

                                                                  document.getElementById("inputAmount").value = "";
                                                                  document.getElementById("convertedAmount").value = "";
                                                                  document.getElementById("totalAmount").value = "";
                                                                  document.getElementById("inputAmount").disabled = false;
                                                                  document.getElementById("convertedAmount").style.display = "block";
                                                                  document.getElementById("totalAmount").style.display = "block";

                                                                }
                                                                
                                                               else if(value == "SGD"){
                                                                
                                                                   $("#showMessage").show();

                                                                  document.getElementById("inputAmount").value = "";
                                                                  document.getElementById("convertedAmount").value = "";
                                                                  document.getElementById("totalAmount").value = "";
                                                                  document.getElementById("inputAmount").disabled = false;
                                                                  document.getElementById("convertedAmount").style.display = "block";
                                                                  document.getElementById("totalAmount").style.display = "block";
                                                               }
                                                                  
                                                                  else if(value == "PHP"){
                                                                
                                                                    $("#showMessage").hide();
                                                                
                                                                  document.getElementById("inputAmount").value = "";
                                                                  document.getElementById("convertedAmount").value = "";
                                                                  document.getElementById("totalAmount").value = "";
                                                                  document.getElementById("inputAmount").disabled = false;
                                                                  document.getElementById("convertedAmount").style.display = "none";
                                                                  document.getElementById("totalAmount").style.display = "none";
                                                                  
                                                                  
                                                                }else{
                                                                  document.getElementById("currency").innerHTML = value;
                                                                  document.getElementById("inputAmount").value = "";
                                                                  document.getElementById("convertedAmount").value = "";
                                                                  document.getElementById("totalAmount").value = "";
                                                                  document.getElementById("inputAmount").disabled = true;
                                                                }

                                                              }

                                                              // var timeout = null;

                                                              function callCurrencyRate(currency){

                                                                $.ajax({
                                                                  type: 'POST',
                                                                  url: `/Fundtransfer/getUSDConversion`,
                                                                  data: {currency},
                                                                    success: function (data) {
                                                                      waitingDialog.hide();
                                                                      var res = JSON.parse(data);
                                                                      console.log(res.amount.rate);
                                                                      document.getElementById("convertedUSD").value = parseFloat(res.amount.rate).toFixed(2);
                                                                      
                                                                      $(".usd").html(parseFloat(res.amount.rate).toFixed(2));
                                                                      // document.getElementById("selFunded").disabled = false;
                                                                      // if (timeout) {  
                                                                      //   clearTimeout(timeout);
                                                                      // }
                                                                      // timeout = setTimeout(function() {
                                                                      //   document.getElementById("convertedAmount").value = parseInt(res.amount).toFixed(2);
                                                                      //   document.getElementById("totalAmount").value = parseInt(res.total).toFixed(2);
                                                                      // }, 1000);
                                                                    },
                                                                    error: function (data) {
                                                                      console.log(data)
                                                                    }
                                                                  });
                                                              };

                                                              function inputAmounts(value){
                                                                if(value == "" || value == "0" || value == 0){
                                                                  document.getElementById("convertedAmount").placeholder = "CONVERTED AMOUNT";
                                                                  document.getElementById("convertedAmount").value = 0;
                                                                  
                                                                  document.getElementById("totalAmount").placeholder = "TOTAL AMOUNT";
                                                                  document.getElementById("totalAmount").value = 0;
                                                                }else{

                                                                  var e = document.getElementById("selFunded");
                                                                  var result = e.options[e.selectedIndex].value;
                                                                  var timeout = null;
                                                                      if (timeout) {  
                                                                        clearTimeout(timeout);
                                                                      }

                                                                     var currencies = ['USD','SGD'];
                                                                        if(currencies.includes($("#selFunded option:selected").val())){
                                                                        
                                                                        // document.getElementById("convertedAmount").value = parseInt(value).toFixed(2) * document.getElementById("convertedUSD").value.toFixed(2);
                                                                        // document.getElementById("totalAmount").value = parseInt(parseInt(value).toFixed(2) - parseInt(25).toFixed(2)).toFixed(2);
                                                                          let amounted = parseFloat(value) * parseFloat(document.getElementById("convertedUSD").value);
                                                                          var usertype = $('#usertype').val();
                                                                          if (usertype == "FRANCHISE ACCOUNT"){
                                                                            var deduction = parseFloat(amounted);
                                                                          }else{
                                                                            var deduction = parseFloat(amounted) - parseFloat(25);
                                                                          }
                                                                          var amounted1 = amounted.toString();
                                                                          var deduction1 = deduction.toString();
                                                                          amounted = (amounted1.indexOf(".") >= 0) ? (amounted1.substr(0, amounted1.indexOf(".")) + amounted1.substr(amounted1.indexOf("."), 3)) : amounted1;
                                                                          deduction = (deduction1.indexOf(".") >= 0) ? (deduction1.substr(0, deduction1.indexOf(".")) + deduction1.substr(deduction1.indexOf("."), 3)) : deduction1;
                                                                          
                                                                          document.getElementById("convertedAmount").value = amounted;
                                                                          document.getElementById("totalAmount").value = deduction;

                                                                    
                                                                        }else{
                                                                          var usertype = $('#usertype').val();
                                                                          if (usertype == "FRANCHISE ACCOUNT"){
                                                                            var totalAmount = parseFloat(value);
                                                                          }else {
                                                                            var totalAmount = parseFloat(value) - parseFloat(25);
                                                                          }
                                                                          var value1 = value.toString();
                                                                          var totalAmount1 = totalAmount.toString();
                                                                          value = (value1.indexOf(".") >= 0) ? (value1.substr(0, value1.indexOf(".")) + value1.substr(value1.indexOf("."), 3)) : value1;
                                                                          totalAmount = (totalAmount1.indexOf(".") >= 0) ? (totalAmount1.substr(0, totalAmount1.indexOf(".")) + totalAmount1.substr(totalAmount1.indexOf("."), 3)) : totalAmount1;
                                                                      
                                                                          document.getElementById("convertedAmount").value = parseFloat(value);
                                                                          document.getElementById("totalAmount").value = totalAmount;
                                                                        
                                                                     

                                                                        }
                                                                      
                                                                    


                                                                }
                                                              }
                                                              
  

                                                              </script>
                                                              
<script>



var validate = function(e) {
  var t = e.value;
  e.value = (t.indexOf(".") >= 0) ? (t.substr(0, t.indexOf(".")) + t.substr(t.indexOf("."), 3)) : t;
}
</script>
                                                            </div>
                                                         </div>
                                                      </div>   
                                                      <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                             <div class="form-group">
                                                                <input type="hidden" id="convertedUSD">
                                                                <input type="text" class="form-control" id="inputAmount" oninput="validate(this)" onkeyup="inputAmounts(this.value)" placeholder="AMOUNT" autocomplete="off" name="inputtedAmount" required tabindex="6" tabindex="1" disabled value="<?php echo $_POST['inputtedAmount']?>" />
                                                            	<!-- <small><font color="red">*Note : (00.00) Ex: 1000.00</font></small> -->
                                                              <div id="showMessage" style="display: none;">
                                                              <small><font color="red">** <i>Conversion Rate : 1 <span id = "currency"></span> - <span class="usd"></span> PHP</i></font></small>
                                                              <br>
                                                              <input type = "hidden" id = "usertype" value = "<?php echo $this->user['UT'];?>">
                                                              <?php if ($this->user['UT'] != "FRANCHISE ACCOUNT"): ?>
                                                                <small><font color="red">** <i>Total Amount is referring to the requested fund less P25.00 for top up fee.</i></font></small>
                                                              <?php endif ?>
                                                              </div>
                                                            </div>
                                                         </div>
                                                      </div> 
                                                      <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                             <div class="form-group">
                                                                <input type="text" class="form-control" id="convertedAmount" name="inputAmount" placeholder="CONVERTED AMOUNT" required tabindex="6" tabindex="1" value="<?php echo $_POST['convertedAmount']?>" readonly/>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                             <div class="form-group">
                                                                <input type="text" class="form-control" id="totalAmount" placeholder="TOTAL AMOUNT" required tabindex="6" tabindex="1"  value="<?php echo $_POST['inputAmount']?>" readonly/>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                              <div class="form-group">
                                                                <input type="text" class="form-control" id="inputRef" name="inputRef" placeholder = "REFERENCE NUMBER" required tabindex="7" <?php if(!$this->session->has_userdata('image_pubid')){echo "disabled";}?> value="<?php echo $_POST['inputRef']?>" />
                                                            </div>
                                                         </div>
                                                      </div> 
                                                      <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                          <div class="form-group">
                                                              <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1"><b>DATE/TIME</b></span>
                                                                  <input type="text" class="form-control"  autocomplete="off" name="inputDate" id="datetimepicker6" tabindex="8" placeholder = "YYYY/MM/DD HH:MM" onchange = "return validateDate()" <?php if(!$this->session->has_userdata('image_pubid')){echo "disabled";}?> required value="<?php echo $_POST['inputDate']?>"/>
                                                              </div>
                                                          </div>      
                                                         </div>
                                                      </div> 

                                                      <script>
                                                      function validateDate() {
                                                        var datetime = $('#datetimepicker6').val();
                                                        var month = datetime.slice(5, 7);
                                                        var day = datetime.slice(8, 10);
                                                        var hr = datetime.slice(11, 13);
                                                        var min = datetime.slice(14, 16);
                                                         if (month > 12){
                                                           alert('Invalid Month');
                                                           $('#datetimepicker6').val('');
                                                           return false;
                                                         }
                                                         if (day > 31){
                                                           alert('Invalid Day');
                                                           $('#datetimepicker6').val('');
                                                           return false;
                                                         }
                                                         
                                                          if (hr > 24){
                                                           alert('Invalid Hour');
                                                           $('#datetimepicker6').val('');
                                                           return false;
                                                         }

                                                          if (min> 59){
                                                           alert('Invalid Minute');
                                                           $('#datetimepicker6').val('');
                                                           return false;
                                                         }




                                                      }
                                                      </script>
                                                     <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                              <div class="form-group">
                                                             <input type="password" class="form-control" id = "inputTpass" name="inputTpass" placeholder="TRANSACTION PASSWORD" tabindex="9" required <?php if(!$this->session->has_userdata('image_pubid')){echo "disabled";}?>/>
                                                          </div>
                                                         </div>
                                                      </div> 
                                                       <div class="row">
                                                        <!-- store the public_id of the upload image -->
                                                        <div class="col-xs-12 col-md-12">
                                                              <div class="form-group">
                                                             <input type="hidden" class="form-control" name="image_public_id" placeholder="IMAGE PUBLIC ID" required tabindex="9" value="<?php echo $this->session->userdata('image_pubid'); ?>"/>
                                                          </div>
                                                         </div>
                                                          <div class="col-xs-12 col-md-12">
                                                              <div class="form-group">
                                                             <input type="hidden" class="form-control" name="image_URL" placeholder="IMAGE URL" required tabindex="9" value="<?php echo $this->session->userdata('image_url'); ?> "/>
                                                          </div>
                                                         </div>
                                                      </div> 
                                                       

                                                  </div>
                                              </div>   

                                              <div class="form-group text-right">
                                              <span style="color: red;" id="negative"></span>
                                              <br>
                                              <button type="button" id="finalSubmit" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal" tabindex="10" <?php if(!$this->session->has_userdata('image_pubid')){echo "disabled";}?>>Submit</button>
 
                                              </div>
        
                                              <script>
                                                $("#finalSubmit").click(function(){
                                                  if($("#inputMobile").val() == "" || $("#selFund option:selected").val() == "0" || $("#selDeposit option:selected").val() == "0" || $("#inputBank option:selected").val() == "0" || $("#inputBranchName").val() == "" || $("#inputAmount").val() == "" || $("#inputRef").val() == "" || $("#datetimepicker6").val() == "" || $("#inputTpass").val() == ""){
                                                  $("#negative").show();
                                                  $("#finalSubmit").removeAttr('data-toggle');
                                                  $("#finalSubmit").removeAttr('data-target');
                                                  $("#negative").html("Some fields are empty");
                                                  }else if($("#inputMobile").val().length != 11){
                                                  $("#negative").show();
                                                  $("#finalSubmit").removeAttr('data-toggle');
                                                  $("#finalSubmit").removeAttr('data-target');
                                                  $("#negative").html("Mobile no. should have 11 digits");
                                                  }else if($("#totalAmount").val() < 0){
                                                  $("#negative").show();
                                                  $("#finalSubmit").removeAttr('data-toggle');
                                                  $("#finalSubmit").removeAttr('data-target');
                                                  $("#negative").html("Insufficient amount. "+"("+$("#totalAmount").val()+")");
                                                  }else{
                                                  $("#finalSubmit").attr('data-toggle','modal');
                                                  $("#finalSubmit").attr('data-target','#myModal');
                                                  $("#negative").hide();
                                                  }
                                                  
                                                });
                                              </script>
                                              
                                              
                                              
                                              <div id="myModal" class="modal fade" role="dialog">
                                                  <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                     
                                                      <div class="modal-body">
                                                        <h4>Are you sure you want to proceed ?</h4>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                         <button type="submit" class="btn btn-primary"  name="btnSubmit" id="btnSubmitFR" >Proceed</button>
                                                      </div>
                                                    </div>

                                                  </div>
                                              
                                          </form>
                                    </div> <!-- col-xs-12 col-md-8-->
                                </div> <!-- row -->
                              </div> <!--col-xs-6 col-md-6-->
                        </div><!-- row -->
                    </div><!-- contentpanel -->
                    
    </div><!-- mainpanel -->            