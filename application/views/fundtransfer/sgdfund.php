  <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-mobile-phone"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                                   <li>FUND TRANSFER</li>
                                </ul>
                                <h4>SGD FUND REQUEST</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    

                    
                    <div class="contentpanel">

                          <?php if ($result['S'] === 0): ?>
                                  <div class="alert alert-danger"><?php echo $result['M']; ?></div>
                          <?php endif ?>

                          <?php if ($result['S'] == 1): ?>
                                  <div class="alert alert-success"><?php echo $result['M']; ?><br />
                                  <?php if ($result['TN'] != ""): ?>
                                       <b>TRACKING NUMBER : <?php echo $result['TN']; ?></b>  
                                  <?php endif ?>
                                  </div>
                          <?php endif ?>
                          
                          <div class="row">
                              <div class="col-xs-12  col-md-5">
                                <div class="row">
                                    <div class='col-xs-12 col-md-12'>
                                             <form name="frmaedfund" action="<?php echo BASE_URL()?>fundtransfer/sgd_fund" method="post">

                <!-- ======================================================================================================================================================== -->
                <!-- ======================================================================================================================================================== -->
                <!-- ======================================================================================================================================================== -->
                <!-- ======================================================================================================================================================== -->
                <!-- ======================================================================================================================================================== -->
                                                 <div class="form-group">
                                                    <input type="text" class="form-control inputRegcode" name="inputRegcode" placeholder="REGCODE" id="inputRegcode" required/>
                                                 </div>

                                                <div class="form-group">
                                                   <input type="text" class="form-control inputNumberValidator inputAmount" name="inputAmount" id="inputAmount" placeholder="AMOUNT" required/>
                                                </div>
                                             
                                                <div class="form-group">
                                                   <input type="password" class="form-control inputTpass" name="inputTpass" id="inputTpass" placeholder="TRANSACTION PASSWORD" required/>
                                                </div>


                                                 <div class="form-group text-right">
                                                    <button type="button" class="btn_ModalSubmit btn btn-info btn-lg btn-s" data-toggle="modal" data-target="#" href="#myModal">Submit</button>
                                                </div>

                <!-- ======================================================================================================================================================== -->
                <!-- ======================================================================================================================================================== -->
                <!-- ======================================================================================================================================================== -->
                <!-- ======================================================================================================================================================== -->
                <!-- ======================================================================================================================================================== -->
                                              <div id="myModal" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                  <div class="modal-dialog modal-dialog-centered modal-sm">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                     
                                                      <div class="modal-body">
                                                        <h4>SGD FUND REQUEST</h4>

                                                        <div>
                                                          Are you sure you want to proceed ?
                                                        </div>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                         <button type="submit" class="btn btn-primary" name="btnSubmit">Proceed</button>
                                                      </div>
                                                    </div>
                                                  </div>
                                              </div>


                <!-- ======================================================================================================================================================== -->
                <!-- ======================================================================================================================================================== -->
                <!-- ======================================================================================================================================================== -->
                <!-- ======================================================================================================================================================== -->
                <!-- ======================================================================================================================================================== -->


                                          </form>   
                                    </div> <!-- col-xs-12 col-md-8-->
                                </div> <!-- row -->

                              </div> <!--col-xs-6 col-md-6-->
                        </div><!-- row -->
                    </div><!-- contentpanel -->
                    
    </div><!-- mainpanel -->            

    <script src="<?php echo BASE_URL()?>assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo BASE_URL()?>assets/js/billspayment.js"></script>
<script type="text/javascript">

  $(document).ready(function(){





     
    $('.btn_ModalSubmit').click(function() {

    
      var regcode = $("#inputRegcode").val();
      var amount = $("#inputAmount").val();
      var pass = $("#inputTpass").val();

      // alert(cardno);

      if(regcode == '' || regcode == undefined){
        // alert('Please input correct card number.');
        $('#myModal').modal('hide');
        $('.inputRegcode').css('border','1px solid red');

      } else if(amount == '' || amount == undefined || amount=='.' || amount==','){
        // alert('Please input valid Amount.');
        $('#myModal').modal('hide');
        $('.inputAmount').css('border','1px solid red');
      }
      else if(amount == 0){
        alert('Amount should not be equal to 0.');
        $('#myModal').modal('hide');
        $('.inputAmount').css('border','1px solid red');
      } 
      else if(pass == '' || pass == undefined){
        //alert('Beep card can reload for as low as PHP 1 (one) and a maximum of PHP 10,000. Please input amount range 1 to 10,000 only.');
        $('#myModal').modal('hide');
        $('.inputTpass').css('border','1px solid red');
      } 

      $(".inputRegcode").on("input", function() {
            var regcode = this.value;
            if(regcode) {
                $('.inputRegcode').css('border','1px solid #ccc');
            } else {
                $('.inputRegcode').css('border','1px solid red');
            }
      });

      $(".inputAmount").on("input", function() {
            var amount = this.value;
            if(amount) {
                $('.inputAmount').css('border','1px solid #ccc');
            } else {
                $('.inputAmount').css('border','1px solid red');
            }
      });

      $(".inputTpass").on("input", function() {
            var pass = this.value;
            if(pass) {
                $('.inputTpass').css('border','1px solid #ccc');
            } else {
                $('.inputTpass').css('border','1px solid red');
            }
      });

            if(regcode && amount != 0 && pass) {
        $('#myModal').modal('show');

      }



    });






    /**$('#frmaedfund').on('submit',function(){
      waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
    });**/
    
  });

</script>