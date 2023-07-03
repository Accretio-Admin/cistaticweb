<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-money"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                   <li>BILLS PAYMENT</li>
                </ul>
                <h4>CREDIT CARD</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    

    <div class="contentpanel">
        <div class="row">
            <div class="col-xs-12 col-md-5">
                <?php if ($API['S'] === 0): ?>
                <div class="alert alert-danger"><b><?php echo $API['M'] ?></b></div>
                <?php endif ?>
                <?php if ($API['S']== 1 && $submitBtn == 1): ?>
                <div class="alert alert-success">&nbsp;&nbsp;<b><?php echo $API['M'] ?>.</b> Tracking Number: <a href="https://mobilereports.globalpinoyremittance.com/portal/billspayment_receipt/<?php echo $API['TN']; ?>" target="_blank"><?php echo $API['TN']; ?></a><br>
                   &nbsp;&nbsp;<small>Click <a href="https://mobilereports.globalpinoyremittance.com/portal/billspayment_receipt/<?php echo $API['TN']; ?>" target="_blank">here</a> to download copy of the Acknowledgement Receipt.</small>
                </div>
                <?php endif ?>
                <div class="form-group">
                    <select class="form-control" name="selBiller" id="selBiller">
                        <option value="" disabled selected>CHOOSE CREDIT CARD BILLER</option>  
                        <?php 
                        foreach ($biller as $key): 
                         $pieces = explode("|", $key);
                         $BD = strtoupper($pieces[0]);
                         $BC = strtoupper($pieces[1]);
                         $FT = strtoupper($pieces[2]);
                         $TF = strtoupper($pieces[3]);
                         
                        ?>
                        <option value="<?php echo $BC ?>" data-name ="<?php echo $BD ?>" data-type ="<?php echo $FT ?>" data-desc = "<?php echo $user['CG'].'|'.$user['L'].'|'.$TF ?>" ><?php echo $BD ?></option>  
                    <?php endforeach ?>
                    </select>
                </div>

                <div class="utilities28" style="display: none;"> 
                  <form name="frmCreditCardLoading" action="<?php echo BASE_URL() ?>Bills_payment/credit_card" method="post" id="frmCreditCardLoading">
                    <div class="form-group" id="divBiller28"></div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="inputAccountNumber" placeholder="ACCOUNT NUMBER" required/>
                    </div>
                    <div id="divDyanamicAccountNo28"></div>
                    <div class="form-group">
                      <input type="text" class="form-control datetimepicker readonly" name="inputDueDate" id="inputDueDate" autocomplete="off" placeholder="DUE DATE" required/>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control datetimepicker readonly" name="inputDateFT28" id="inputDateFT28" autocomplete="off" required/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control"  name="inputAmount" placeholder="AMOUNT"  onkeypress="return isNumberKey(event)" required />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                    </div>                    
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">SUBMIT</button>
                    </div>
                  </form>
                </div>

                <!-- data type == 1 -->  
                <div class="utilities1" style="display: none;"> 
                    <form name="frmCreditCardLoading" action="<?php echo BASE_URL() ?>Bills_payment/credit_card" method="post" id="frmCreditCardLoading">
                       <div class="form-group" id="divBiller1"> </div> 
                       <div class="form-group" id="divDynamicBiller"> </div>  
<!--                         <div class="form-group">
                            <input type="text" class="form-control" name="inputAccountNumber" placeholder="ACCOUNT NUMBER" required />
                        </div> -->
                        <div class="form-group">
                            <input type="text" class="inputNameValidator form-control" name="inputSubscriberName" id="inputSubscriberName" placeholder="ACCOUNT NAME" required/>
                        </div>
                        <div class="form-group" id="DynamicBillerMobNo" style="display: none;"> 
                            <input type="tel" class="inputNumberValidator form-control" name="inputMobile" id="inputMobile" placeholder="MOBILE NUMBER (11-Digits)" maxlength="11" required />
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control inputAmount" name="inputAmount" id="inputAmount" placeholder="AMOUNT" required />
                        </div>
                        <!-- <div class="form-group">
                            <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                        </div> -->
                        <div class="form-group text-right">
                            <!-- <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">SUBMIT</button> -->
                            <button type="button" class="btn btn-primary btn-lg btn_ModalSubmit" data-toggle="modal" id="btnSubmit" data-target="#myModal">Submit</button>
                        </div>

                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Transaction Summary</h4>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <p>Please check your details and click "confirm button" to proceed transaction.</p>
                                      <p>
                                        <span> Biller Name : </span> <label id="idBiller"></label>
                                      </p>
                                      <p> 
                                        <span> Account Number : </span> <label id="idAcctNo"></label>
                                      </p>
                                      <p>
                                        <span> Account Name : </span> <label id="idAcctName"></label>
                                      </p>
                                      <p class="idMobileNo" style="display: none;"> 
                                        <span> Mobile No. : </span> <label id="idMobNo"></label>
                                      </p>
                                      <p>
                                        <span> Amount : </span> <label id="idAmount"></label>
                                      </p>
                                    </div>
                                    
                                    <div class="form-group">
                                      <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btnSubmitmodal" name="btnSubmit" value="1">Confirm</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                          </div>
                        </div>

                      </form>
                    <!-- </form> -->
                </div><!-- data type == 1 --> 

                <!-- data type == 25-->  
                <div class="utilities25" style="display: none;" id="datatype25"> 
                    <form name="frmUtilitiesLoading" action="<?php echo BASE_URL() ?>Bills_payment/credit_card" method="post" class="frmUtilitiesLoading" id="frmUtilitiesLoading">
                       <div class="form-group" id="divBiller25"> </div>   
                       <div class="form-group" id="divDynamicBiller25"> </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputAccountNumber" id="inputAccountNumber" placeholder="ACCOUNT NUMBER" required />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control inputNameValidator inputSubscriberName" name="inputSubscriberName" id="inputSubscriberName" placeholder="ACCOUNT NAME" required/>
                        </div>
                        <div class="form-group" id="DynamicBillerNumber25" style="display: none;"> </div>
                        <div class="form-group" id="DynamicDueDate25" style="display: none;"> 
                          <input type="text" class="form-control inputDueDate datetimepicker" name="inputDueDate" id="inputDueDate" placeholder="DUE DATE (mmddyyyy)" required />
                        </div>
                        <div class="form-group"> 
                            <input type="tel" class="inputNumberValidator form-control inputMobile" name="inputMobile" id="inputMobile" placeholder="MOBILE NUMBER (11-Digits)" minlength="11" maxlength="11" required />
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control inputAmount" name="inputAmount" id="inputAmount" step=".01" placeholder="AMOUNT" required />
                        </div>
                        <!-- <div class="form-group">
                            <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                        </div> -->
                        <div class="form-group text-right">
                            <!-- <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">SUBMIT</button> -->
                            <button type="button" class="btn btn-primary btn-lg btn_Modal25Submit" data-toggle="modal" id="btnSubmit" data-target="#myModal25">Submit</button>
                        </div>

                        <!-- Modal -->
                        <div id="myModal25" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Transaction Summary</h4>
                                  </div>
                                  <div class="modal-body">
                                    <!-- <div class="form-group">
                                      <p>Please check your details and click "confirm button" to proceed transaction.</p>
                                      <p>
                                        <span> Biller Name : </span> <label id="idBiller" class="idBiller"></label>
                                      </p>
                                      <p> 
                                        <span> Account/ Reference Number : </span> <label id="idAcctNo" class="idAcctNo"></label>
                                      </p>
                                      <p>
                                        <span> Account Name : </span> <label id="idAcctName" class="idAcctName"></label>
                                      </p>
                                      <p class="idDueDate" style="display: none;"> 
                                        <span> Due Date/ Bill Month : </span> <label id="idDueDate"></label>
                                      </p>
                                      <p class="idBillNo" style="display: none;"> 
                                        <span> ATM Reference No./ Bill No. : </span> <label id="idBillNo"></label>
                                      </p>
                                      <p> 
                                        <span> Mobile No. : </span> <label id="idMobNo" class="idMobNo"></label>
                                      </p>
                                      <p>
                                        <span> Amount : </span> <label id="idAmount" class="idAmount"></label>
                                      </p>
                                    </div>
                                    
                                    <div class="form-group">
                                      <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                                    </div> -->

                                    <div class="alert alert-info"><b>Please check your details and click "confirm button" to proceed transaction.</b></div>

                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:85px;">Biller Name :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idBiller" class="idBiller"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:7px;">Account/ Reference No. :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idAcctNo" class="idAcctNo"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:65px;">Account Name :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idAcctName" class="idAcctName"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group idDueDate" style="display: none;">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:28px;">Due Date/ Bill Month :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idDueDate" class="idDueDate"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group idBillNo" style="display: none;">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:25px;">ATM Ref No./ Bill No. :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idBillNo" class="idBillNo"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:90px;">Mobile No. :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idMobNo" class="idMobNo"></label></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:109px;">Amount :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idAmount" class="idAmount"></label></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:20px;">Transaction Password :</span>
                                          <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                                        </div>
                                    </div>


                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btnSubmitmodal" name="btnSubmit" value="1">Confirm</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                          </div>
                        </div>
                    </form>
                </div><!-- data type == 25 --> 


            </div>
            <div class="col-xs-12 col-md-7">
                <div class="row">

                    <div class="col-xs-12 col-md-11">
                        <div class="form-group">
                            <div class="alert alert-info alert-biller-default" style="display:none;word-wrap:break-word;"></div>
                            <div class="alert alert-info alert-biller" style="display:none;word-wrap:break-word;"></div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-11">
                        <div class="panel panel-default1 alert-biller-reminder">
                          <div class="panel-body" style="border: 1px solid #d3d3d3; border-radius:10px; padding: none;"><!--style="background-color: #FF9933;"-->
                              <h4 class="text-info" style="font-weight: bold;"><i class="fa fa-bell" aria-hidden="true"></i> IMPORTANT REMINDERS</h4>
                              <p> <b><span class="text-info1">1.</span></b> Customer needs to present their <b>Statement of Account (SOA)</b> over-the-counter. </p>
                              <p> <b><span class="text-info1">2.</span></b> Inform the customers of the <b>Three (3) days</b> posting of bills payment transaction.  </p>
                              <p> <b><span class="text-info1">3.</span></b> Accept Cash payments from customers or subscribers if a Statement of Account/Billing from specific biller institution is presented provided such payment is in <b>Full (No partial), Exact amount (No rounding off), Not overdue and Without any arrears such as with Disconnection notice and/or Unpaid previous bill</b>. </p>
                              <p> <b><span class="text-info1">4.</span></b> After every transaction, <b>download and print Acknowledgement Receipt</b>. Original copy of the acknowledgement receipt will be issued to the customer as proof of payment. </p>

                              <h4>
                                <b><span class="text-danger">Note:</span></b> <br> 
                                <div class="col-xs-12 col-md-12">
                                  <b> <span class="text-danger">*</span> Collections received after the clearing <i class="text-danger">Cut-off time of 3:45PM</i> shall be treated as transactions for the next banking day. </b>
                                </div>
                              </h4>
                          </div>
                        </div>   
                    </div><!-- col-md-9 -->

                </div>
            </div>
        </div><!-- row -->
    </div><!-- contentpanel -->
</div><!-- mainpanel -->            


<script src="<?php echo BASE_URL()?>assets/js/jquery-2.1.4.min.js"></script>

<script>
  $(document).ready(function(){

    $(".readonly").on('keydown paste focus mousedown', function(e){
        if(e.keyCode != 9) // ignore tab
            e.preventDefault();
    });
     
    $('.btn_ModalSubmit').click(function() {
        $('.idMobileNo').hide();
      var biller = $('#selBiller option:selected').data('name');
      var billerNo = $('#selBiller option:selected').val();
      var acctNo = $("#inputAccountNumber").val();
      var acctName = $("#inputSubscriberName").val();
      var amount = $("#inputAmount").val();
      var mobNo = $("#inputMobile").val();
      
      if(mobNo != ''){
        $('.idMobileNo').show();
      }

      $('#idBiller').html(biller);
      $('#idAcctNo').html(acctNo);
      $('#idAcctName').html(acctName);
      $('#idAmount').html(amount);
      $('#idMobNo').html(mobNo);       
     
    });

    $("#selBiller").change(function() {
      $("#inputAccountNumber").val('');
      $("#inputSubscriberName").val('');
      $("#inputAmount").val('');
      $("#inputMobile").val('');
      $(".inputAccountNumber").val('');
      $(".inputSubscriberName").val('');
      $(".inputAmount").val('');
      $(".inputMobile").val('');
      $(".inputDueDate").val('');
      $(".inputBillerNo").val('');
      $(".inputCampus").val('');
    });


    $('.btn_Modal25Submit').click(function() {

      var biller = $('#selBiller option:selected').data('name');
      var billerNo = $('#selBiller option:selected').val();
      var acctNo = $("#inputAccountNumber").val();
      var acctName = $(".inputSubscriberName").val();
      var amount = $("#datatype25 .inputAmount").val();
      var mobNo = $(".inputMobile").val();
      var refno = $("#inputBillerNo").val();
      var duedate = $("#inputDueDate").val();

      // alert(refno);
      if(refno != '' && refno != undefined){
        // alert(refno);
        $('.idBillNo').show();
        $('#myModal25 #idBillNo').html(refno); 
      }

      if(duedate != '' && duedate != undefined){
        // alert(duedate);
        $('.idDueDate').show();
        $('#myModal25 #idDueDate').html(duedate); 
      }
      
      $('#myModal25 .idBiller').html(biller);
      $('#myModal25 .idAcctNo').html(acctNo);
      $('#myModal25 .idAcctName').html(acctName);
      $('#myModal25 .idAmount').html(amount);
      $('#myModal25 .idMobNo').html(mobNo);       
    });


    $('.frmUtilitiesLoading').on('submit', function(){

       waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
       
    });


    $('#datatype25 .inputAmount').on('change', function(){

    var amount = $("#datatype25 .inputAmount").val();

    if(amount <= 0 || amount == "")
    {
        alert('Invalid Amount');
        
        $('#datatype25 .inputAmount').val('');
    }
    else
    {
        $(this).val(parseFloat($(this).val()).toFixed(2));
      
    }

    });


  });
</script>