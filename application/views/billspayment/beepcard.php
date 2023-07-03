<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-credit-card"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                   <li>BILLS PAYMENT</li>
                </ul>
                <h4>BEEP RELOAD</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
    <div class="contentpanel">
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <?php if ($API['S'] === 0): ?>
                <div class="alert alert-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <b><?php echo $API['M'] ?></b></div>
                <?php endif ?>
                <!-- <?php if ($API['S']== 1 && $submitBtn == 1): ?>
                <div class="alert alert-success">&nbsp;&nbsp;<i class="fa fa-check-circle" aria-hidden="true"></i> <b><?php echo $API['M'] ?>.</b> <br>&nbsp;&nbsp;Reference Number: <b><?php echo $API['RF']; ?></b> & Tracking Number: <a href="https://mobilereports.globalpinoyremittance.com/portal/beepreload_receipt/<?php echo $API['TN'];  ?>" target="_blank"><?php echo $API['TN'];  ?></a><br>
                   &nbsp;&nbsp;<small>Click <a href="https://mobilereports.globalpinoyremittance.com/portal/beepreload_receipt/<?php echo $API['TN']; ?>" target="_blank">here</a> to download copy of the Acknowledgement Receipt.</small>
                </div>
                <?php endif ?> -->

                <?php 
                    $msgsuccess = $this->session->flashdata('msgsuccess');
                    if ($msgsuccess['S']==1): ?>
                    <div class="alert alert-success">&nbsp;&nbsp;<i class="fa fa-check-circle" aria-hidden="true"></i> <b><?php echo $msgsuccess['M'] ?>.</b> <br>&nbsp;&nbsp;Reference Number: <b><?php echo $msgsuccess['RF']; ?></b> & Tracking Number: <a href="https://mobilereports.globalpinoyremittance.com/portal/beepreload_receipt/<?php echo $msgsuccess['TN'];  ?>" target="_blank"><?php echo $msgsuccess['TN'];  ?></a><br>
                   &nbsp;&nbsp;<small>Click <a href="https://mobilereports.globalpinoyremittance.com/portal/beepreload_receipt/<?php echo $msgsuccess['TN']; ?>" target="_blank">here</a> to download copy of the Acknowledgement Receipt.</small>
                </div>
                <?php endif ?>
              

                <div class="panel panel-default">
                    <div class="panel-heading"><div class="text-info">* Note: <span class="text-danger">Beep card can reload for as low as PHP 1 (one) and a maximum of PHP 10,000</span></div></div>
                    <div class="panel-body">                                                                              
                        <div class="beepreload"> 
                            <!-- <form name="frmloadwallet" action="<?php echo BASE_URL()?>Bills_payment/beepcard" method="post" id="frmBeepCardvalidation"> -->
                            
                            <div class="form-group">
                                 <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 48px;">Card Number:</span>
                                    <input type="text" class="form-control inputCardno" name="cardno" id="inputCardno" placeholder="CARD NUMBER" value="<?php echo $_POST['inputCardno'];?>" required />
                                 </div>
                             </div>

                             <div class="form-group">
                                 <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 55px;">Contact No. :</span>
                                    <input type="text" class="form-control inputContactno" name="contactno" id="inputContactno" placeholder="CONTACT NO." value="<?php echo $_POST['inputContactno'];?>" required />
                                 </div>
                             </div>

                             <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 83px;">Amount:</span>
                                    <input type="text" class="form-control inputAmount inputNumberValidator" name="amount" id="inputAmount" placeholder="AMOUNT" value="<?php echo $_POST['inputAmount'];?>" required />
                                </div>
                             </div>

                             <div class="form-group text-right">
                                <!-- <button type="submit" class="btn btn-primary btn-lg" value="<?php echo $results['btnSubmit']; ?>" id="btnSubmit" name="btnSubmit"><span class="glyphicon glyphicon-ok"></span>&nbsp;Validate</button> -->
                                <button type="button" class="btn btn-primary btn_ModalSubmit" data-toggle="modal" id="btnSubmit" data-target="#" href="#myModal1"><span class="fa fa-check"></span>&nbsp;Validate Card Number</button>
                            </div>
                        <!-- </form>  -->
                    </div>
                  </div>
                </div>
                
                
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div class="form-group">
                            <div class="alert alert-info alert-biller-default" style="display:block;word-wrap:break-word;">
                              Please collect an additional <b class="text-danger">P <?php echo $RESULT['DATA']['service_charge']; ?></b> for the top up convenience fee.
                             </div>
                            <!-- <div class="alert alert-info alert-biller" style="display:block;word-wrap:break-word;">sdfsdfsdfsdfds</div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- row -->
    </div><!-- contentpanel -->              
</div><!-- mainpanel -->            


<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <form action="<?php echo BASE_URL() ?>Bills_payment/beepcard" method="post" class="loading modal_loading" id="frmBeepCardvalidation">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">BEEP RELOAD SUMMARY</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1" style="padding-right:62px;">Card Number :</span>
                <input type="text" class="form-control" name="inputCardno" id="idCardNo" readonly />
              </div>
            </div>

          <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1" style="padding-right:75px;">Contact no. :</span>
                <input type="text" class="form-control" name="inputContactno" id="idContactno" readonly />
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1" style="padding-right:97px;">Amount :</span>
                <input type="text" class="form-control" name="inputAmount" id="idAmount" readonly />
              </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right:16px;">Trasaction Password :</span>
                    <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                  </div>
            </div>

          </div>
          
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" value="1" name="btnSubmit">Confirm</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
</div>


<script src="<?php echo BASE_URL()?>assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo BASE_URL()?>assets/js/billspayment.js"></script>
<script type="text/javascript">

  $(document).ready(function(){
     
    $('.btn_ModalSubmit').click(function() {
    
      var cardno = $("#inputCardno").val();
      var contactno = $("#inputContactno").val();
      var amount = $("#inputAmount").val();

      // alert(cardno);

      if(cardno == '' || cardno == undefined){
        // alert('Please input correct card number.');
        $('#myModal1').modal('hide');
        $('.inputCardno').css('border','1px solid red');

      } else if(amount == '' || amount == undefined || amount=='.' || amount==','){
        // alert('Please input valid Amount.');
        $('#myModal1').modal('hide');
        $('.inputAmount').css('border','1px solid red');

      } else if(amount>10000 || amount<1){
        // alert('Beep card can reload for as low as PHP 1 (one) and a maximum of PHP 10,000. Please input amount range 1 to 10,000 only.');
        $('#myModal1').modal('hide');
        $('.inputAmount').css('border','1px solid red');
      } 

      else if(contactno == '' || contactno == undefined){
        // alert('Please input correct card number.');
        $('#myModal1').modal('hide');
        $('.inputContactno').css('border','1px solid red');
      }

      $(".inputContactno").on("input", function() {
            var cardno = this.value;
            if(cardno) {
                $('.inputContactno').css('border','1px solid #ccc');
            } else {
                $('.inputContactno').css('border','1px solid red');
            }
      });

         $(".inputCardno").on("input", function() {
            var cardno = this.value;
            if(cardno) {
                $('.inputCardno').css('border','1px solid #ccc');
            } else {
                $('.inputCardno').css('border','1px solid red');
            }
      });

      $(".inputAmount").on("input", function() {
            var amount = this.value;
            if(amount && (amount>=1 && amount<=10000)){
                $('.inputAmount').css('border','1px solid #ccc');
            } else {
                $('.inputAmount').css('border','1px solid red');
            }
      });
      

      if(cardno && amount>=1 && amount<=10000) {
        $('#myModal1').modal('show');

        $('#myModal1 #idCardNo').val(cardno);
        $('#myModal1 #idContactno').val(contactno);
        $('#myModal1 #idAmount').val(amount);
      }

    });

    $('#frmBeepCardvalidation').on('submit',function(){
      waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
    });
    
  });

</script>