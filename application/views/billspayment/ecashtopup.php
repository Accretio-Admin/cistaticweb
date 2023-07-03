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
                <h4>ECASH TOP-UP</h4>
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
                <div class="alert alert-success">&nbsp;&nbsp;<b><?php echo $API['M'] ?>.</b> Tracking Number: <a href="https://mobilereports.globalpinoyremittance.com/portal/billspayment_receipt/<?php echo $API['TN'];  ?>" target="_blank"><?php echo $API['TN'];  ?></a><br>
                   &nbsp;&nbsp;<small>Click <a href="https://mobilereports.globalpinoyremittance.com/portal/billspayment_receipt/<?php echo $API['TN']; ?>" target="_blank">here</a> to download copy of the Acknowledgement Receipt.</small>
                </div>
                <?php endif ?>
                <div class="form-group">
                    <select class="form-control" name="selBiller" id="selBiller">
                        <option value="" disabled selected>CHOOSE BILLER</option>  
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

                <!-- data type == 1 && 8 && 7-->  
                <div class="utilities1" style="display: none;"> 
                    <form name="frmOthersLoading" action="<?php echo BASE_URL() ?>Bills_payment/ecashtopup" method="post" id="frmOthersLoading">
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
                            <input type="text" class="form-control" name="inputAmount" id="inputAmount" placeholder="AMOUNT" required />
                        </div>
                        <!-- <div class="form-group">
                            <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                        </div> -->
                        <div class="form-group text-right">
                            <!-- <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">SUBMIT</button> -->
                            <button type="button" class="btn btn-primary btn-lg btn_ModalSubmit" data-toggle="modal" id="btnSubmit" data-target="#">Submit</button>
                        </div>

                        <!-- Modal -->
                        <div id="myModal1" class="modal fade" role="dialog">
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
                                        <span> Account/ Reference Number : </span> <label id="idAcctNo"></label>
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
                                    <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">Confirm</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                          </div>
                        </div>

                    </form>
                </div><!-- data type == 1 --> 

                <!-- data type == 2-->  
                <div class="utilities2" style="display: none;"> 
                    <form name="frmOthersLoading" action="<?php echo BASE_URL() ?>Bills_payment/ecashtopup" method="post" id="frmOthersLoading">
                       <div class="form-group" id="divBiller2"> </div>   
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputSubscriberName" placeholder="DONOR" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control"  name="inputAmount" placeholder="AMOUNT" required />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">SUBMIT</button>
                        </div>
                    </form>
                </div><!-- data type == 2 --> 

                <!-- data type == 4-->  
                <div class="utilities4" style="display: none;"> 
                    <form name="frmOthersLoading" action="<?php echo BASE_URL() ?>Bills_payment/ecashtopup" method="post" id="frmOthersLoading">
                       <div class="form-group" id="divBiller4"> </div>   
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputAccountNumber" placeholder="PASSPORT NUMBER" required />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputSubscriberName" placeholder="FULLNAME" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control"  name="inputAmount" placeholder="AMOUNT" required />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">SUBMIT</button>
                        </div>
                    </form>
                </div><!-- data type == 4 -->  

                <!-- data type == 18-->  
                <div class="utilities18" style="display: none;"> 
                    <form name="frmOthersLoading" action="<?php echo BASE_URL() ?>Bills_payment/ecashtopup" method="post" id="frmOthersLoading">
                       <div class="form-group" id="divBiller18"> </div>   
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputAccountNumber" placeholder="W PARTNER NUMBER" required />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputSubscriberName" placeholder="FULLNAME" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control"  name="inputAmount" placeholder="AMOUNT" required />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">SUBMIT</button>
                        </div>
                    </form>
                </div><!-- data type == 18 --> 

                <!-- data type == 21-->  
                <div class="utilities21" style="display: none;"> 
                    <form name="frmOthersLoading" action="<?php echo BASE_URL() ?>Bills_payment/ecashtopup" method="post" id="frmOthersLoading">
                       <div class="form-group" id="divBiller21"> </div>   
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputAccountNumber" placeholder="REGCODE" required />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputSubscriberName" placeholder="SUBSCRIBER NAME" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control"  name="inputAmount" placeholder="AMOUNT" required />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">SUBMIT</button>
                        </div>
                    </form>
                </div><!-- data type == 21 --> 
                
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
     
    $('.btn_ModalSubmit').click(function() {
        $('.idMobileNo').hide();
      var biller = $('#selBiller option:selected').data('name');
      var billerNo = $('#selBiller option:selected').val();
      var acctNo = $("#inputAccountNumber").val();
      var acctName = $("#inputSubscriberName").val();
      var amount = $("#inputAmount").val();
      var mobNo = $("#inputMobile").val();
    
      if(billerNo == 168 && amount<150){
        alert('Input Amount more than or equal to Php 150.00');
        $('#myModal1').modal('hide');
        $('#inputAmount').css('border','1px solid red');
      } else {
        $('#myModal1').modal('show');
        $('#inputAmount').css('border','1px solid #ccc');
      }

      if(mobNo != ''){
        $('.idMobileNo').show();
      }

      $('#myModal1 #idBiller').html(biller);
      $('#myModal1 #idAcctNo').html(acctNo);
      $('#myModal1 #idAcctName').html(acctName);
      $('#myModal1 #idAmount').html(amount);
      $('#myModal1 #idMobNo').html(mobNo);       
     
    });

    $("#selBiller").change(function() {
      $("#inputAccountNumber").val('');
      $("#inputSubscriberName").val('');
      $("#inputAmount").val('');
      $("#inputMobile").val('');
    });

  });
</script>