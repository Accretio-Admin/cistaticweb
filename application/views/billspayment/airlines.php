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
                                <h4>AIRLINES</h4>
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
                                <div class="alert alert-success">&nbsp;&nbsp;<b><?php echo $API['M'] ?> </b><br /><a href="https://mobilereports.globalpinoyremittance.com/portal/billspayment_receipt/<?php echo $API['TN'];  ?>" target="_blank"><?php echo $API['TN'];  ?></a>
                                   &nbsp;&nbsp;<small>Click transaction number to download receipt.</small>
                                </div>
                                <?php endif ?>
                                <div class="form-group">
                                    <select class="form-control" name="selBiller" id="selBiller">
                                        <option value="" disabled selected>CHOOSE AIRLINES BILLER</option>  
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
                                  <form name="frmAirlinesLoading" action="<?php echo BASE_URL() ?>Bills_payment/airlines" method="post" id="frmAirlinesLoading">
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

                                <div class="utilities1" style="display: none;"> 
                                  <form name="frmAirlinesLoading" action="<?php echo BASE_URL() ?>Bills_payment/airlines" method="post" id="frmAirlinesLoading">
                                    <div class="form-group" id="divBiller1"> </div>   
                                      <div class="form-group">
                                          <input type="text" class="form-control" name="inputAccountNumber" placeholder="ACCOUNT NO" required />
                                      </div>
                                      <div class="form-group">
                                          <input type="text" class="form-control"  name="inputAmount" id="" placeholder="AMOUNT" required/>
                                      </div>
                                      <div class="form-group">
                                          <input type="text" class="form-control" name="inputSubscriberName" placeholder="PAYOR NAME" required/>
                                      </div>
                                      <div class="form-group">
                                        <input type="text" class="form-control datetimepicker" name="inputBillingMonth" id="inputBillingMonth" placeholder="DEPARTURE DATE" required readonly/>
                                      </div>
                                      <div class="form-group">
                                          <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                                      </div>
                                      <div class="form-group text-right">
                                          <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">SUBMIT</button>
                                      </div>
                                  </form>
                                </div>

                                <!-- data type == 5 -->  
                                <div class="utilities5" style="display: none;"> 
                                    <form name="frmAirlinesLoading" action="<?php echo BASE_URL() ?>Bills_payment/airlines" method="post" id="frmAirlinesLoading">
                                       <div class="form-group" id="divBiller5"> </div>   
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="inputAccountNumber" placeholder="ACCOUNT NUMBER" required />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="inputSubscriberName" placeholder="SUBSCRIBER NAME" required/>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control"  name="inputAmount" placeholder="AMOUNT" required />
                                            <p style="color:#FF0000;"><i><b>Note:</b> Payment can be accepted 7 days prior to departure date</i></p>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                                        </div>
                                        <div class="form-group text-right">
                                            <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">SUBMIT</button>
                                        </div>
                                    </form>
                                </div><!-- data type == 5 --> 

                    <!-- data type == 25-->  
                <div class="utilities25" style="display: none;" id="datatype25"> 
                    <form name="frmAirlinesLoading" action="<?php echo BASE_URL() ?>Bills_payment/airlines" class="frmUtilitiesLoading" method="post" id="frmAirlinesLoading">
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
                                    <div class="form-group idEmail" style="display: none;">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1" style="padding-right:65px;">Email Address :</span>
                                          <span class="form-control" id="basic-addon2" style=""><label id="idEmail" class="idEmail"></label></span>
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
                                    <div class="col-xs-12 col-md-8">
                                        <div class="form-group">
                                            <div class="alert alert-info alert-biller-default" style="display:none;word-wrap:break-word;"></div>
                                            <div class="alert alert-info alert-biller" style="display:none;word-wrap:break-word;"></div>
                                        </div>
                                    </div>
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
      $(".email").val('');
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
      var email = $("#email").val();
      var duedate = $("#inputDueDate").val();

      // alert(refno);
      if(refno != '' && refno != undefined){
        // alert(refno);
        $('.idBillNo').show();
        $('#myModal25 #idBillNo').html(refno); 
      }

      if(email != '' && email != undefined){
        // alert(refno);
        $('.idEmail').show();
        $('#myModal25 #idEmail').html(email); 
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