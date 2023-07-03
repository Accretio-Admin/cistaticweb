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
                      <h4>QATAR</h4>
                  </div>
              </div><!-- media -->
          </div><!-- pageheader -->
          

          
          <div class="contentpanel">
              <!-- SECURITY CODE ERROR MSG -->
              <?php if ($result['S'] === 0): ?>
              <div class="alert alert-danger"><?php echo $result['M']; ?></div>
              <?php endif ?>
              
                <div class="row">
                   
                    <div class="col-xs-12  col-md-5">
                    
                      <?php if ($API['S'] === "0" || $API['S'] == "0"): ?>
                          <div class="alert alert-danger"><?php echo $API['M']; ?></div>
                      <?php endif ?>
                      <?php if ($Brand['S'] != "1"){ ?>
                          <div class="alert alert-danger"><?php echo $Brand['M'] ?></div>
                      <?php } ?>
                     
                      <?php if ($API['S'] == 1 && $API['TN'] != NULL): ?>
                          <div class="alert alert-success">&nbsp;&nbsp;<b>Transaction Successful!</b> Reference Number: <a href="<?php echo $API['RL']; ?>" target="_blank"><?php echo $API['TN']; ?></a><br>
                               &nbsp;&nbsp;<small>Click <a href="<?php echo $API['RL']; ?>" target="_blank">here</a> to download copy of the Acknowledgement Receipt.</small><br><br>
                               &nbsp;&nbsp;<b>Note:</b> Transaction successful, a copy of the e-Voucher has been sent to client email address <?php echo $API['EA'] ?>
                          </div>
                      <?php endif ?>

                      <div class="row">
                          <div class='col-xs-12 col-md-12'>

                                <form name="paythemForm" action="<?php echo BASE_URL()?>international_loading_paythem?country=qatar" method="post" id="frmetisalatloading">
                                      <div class="form-group" >
                                        <select class="form-control" name="selBrandPaythem" id="selBrandPaythemId" required>
                                            <option value="" disabled selected>SELECT Brand</option>
                                            <?php 
                                                foreach($BrandList as $rowBrand) {
                                                  if($rowBrand['id']!=16 || $rowBrand['id']!=34 || $rowBrand['id']!=35){
                                                    // echo "<option data-name='".$rowBrand['OEM_BRAND_Name']."' value='".$rowBrand['OEM_BRAND_ID']."'>".$rowBrand['OEM_BRAND_Name']."</option>";
                                                    
                                                    if( isset($_POST['selBrandPaythem']) && ($rowBrand['id'] == $_POST['selBrandPaythem']) ) {
                                                      echo "<option data-name='".$rowBrand['name']."' value='".$rowBrand['id']."' selected>".$rowBrand['name']."</option>";
                                                    } else {
                                                      echo "<option data-name='".$rowBrand['name']."' value='".$rowBrand['id']."'>".$rowBrand['name']."</option>";
                                                    }

                                                  } 
                                                }
                                            ?>

                                        </select>
                                       <br />
                                       
                                      </div>
                                      
                                      <div class="form-group" >
                                        <select class="form-control" name="selProdPaythem" id="selProdPaythemId" required>
                                            <?php if( !isset($_POST['selProdPaythem'])) { ?>
                                              <option value="" disabled selected>SELECT Product</option>
                                            <?php }?>
                                            <?php 
                                                if($ProductList!=null){
                                                  foreach($ProductList as $rowProduct) {
                                                    // echo "<option id='".$rowProduct['OEM_BRAND_ID']."' data-name='".$rowProduct['OEM_PRODUCT_Name']."' value='".$rowProduct['OEM_PRODUCT_ID']."' hidden>".$rowProduct['OEM_PRODUCT_Name']."</option>";

                                                    if( isset($_POST['selProdPaythem']) && ($rowProduct['id'] == $_POST['selProdPaythem']) ) {
                                                        echo "<option data-plancode='".$rowProduct['plancode']."' id='".$rowProduct['brand_id']."' data-name='".$rowProduct['description']."' value='".$rowProduct['id']."' selected>".$rowProduct['description']."</option>";
                                                    } else {
                                                      echo "<option data-plancode='".$rowProduct['plancode']."' id='".$rowProduct['brand_id']."' data-name='".$rowProduct['description']."' value='".$rowProduct['id']."' hidden>".$rowProduct['description']."</option>";
                                                    }

                                                  }
                                                }
                                            ?>

                                        </select>
                                       <br />
                                        
                                      </div>
                                      <div class="form-group">
                                        <input type="email" class="form-control" name="inputEmail" value="<?php echo $_POST['inputEmail']; ?>" id="emailId"  placeholder="Email Address" required /><div id="emailMsg"></div>
                                        <span style="color: red;" id="amount_errEmailSender1">Incorrect email format. </span>
                                        <input type="hidden" class="form-control"  id="amountId" name="inputAmount" placeholder="Amount" />
                                      </div>
                                      <!-- <br />
                                      <div class="form-group">
                                       
                                         <input type="number" class="form-control" id="qtyId" name="inputQty" value="<?php echo $_POST['inputQty']; ?>" placeholder="Quantity" required/>
                                      </div> -->
                                      <br />
                                      <div class="form-group">
                                        <input type="text" class="form-control" id="mobileId" name="inputRMobile" value="<?php echo $_POST['inputRMobile']; ?>" placeholder="Mobile Number (Optional)" />
                                        
                                      </div>

                                    <div class="form-group">
                                        <h4>Security Question: <b>What is <?php echo $captcha['code1']  ?> + <?php echo $captcha['code2']  ?> ?</b></h4>
                                    </div>
                                    <div class="form-group">
                                       <input type="text" class="form-control" id="capchaId" name="inputCaptcha" onkeypress="return /[0-9]/i.test(event.key)" placeholder="Answer" required/>
                                    </div>
                                     <div class="form-group text-right">
                                        
                                        <button type="button" class="btn btn-info btn-lg btn_ModalSubmit" data-toggle="modal" id="btnSubmit" data-target="#">Submit</button>
                                    </div>
                                
                          </div> <!-- col-xs-12 col-md-8-->
                      </div> <!-- row -->
                     <?php //endif ?>
                    
                    </div> <!--col-xs-6 col-md-6-->

        
              </div><!-- row -->
          </div><!-- contentpanel -->
          
</div><!-- mainpanel --> 



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
          <p> <span> Brand : </span> <label id="idBrand"></label><p>
          <p> <span> Product Name : </span> <label id="idProductName"></label><p>
          <!-- <p> <span> Product Quantity : </span> <label id="idProductQty"></label><p> -->
          <p> <span> Email Address : </span> <label id="idEmail"></label><p>
          <p> <span> Mobile Number : </span> <label id="idMobNo"></label><p>
          
        </div>
        
        <div class="form-group">
          <input type="password" class="form-control" placeholder="Transaction Password"  name="transpass" required/>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary"  name="btnSubmit">Confirm</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

</form>
<script src="<?php echo BASE_URL()?>assets/js/jquery-2.1.4.min.js"></script>

<script>
  $('#amount_errEmailSender1').hide()
  
  $(document).ready(function(){
     
    $("#selBrandPaythemId").change(function(){
      var brand  = $(this).val();
      
      $('#selProdPaythemId option').eq(0).prop('selected',true);
      $("option[id='"+brand+"']").removeAttr('hidden');

      $("#selProdPaythemId option[id!='"+brand+"']").prop('hidden','hidden');
    
    });

    var brand1 = $('#selBrandPaythemId option:selected').val();
    if(brand1 && brand1 !="") {
      // alert(brand1);
      $("#selProdPaythemId option[id='"+brand1+"']").removeAttr('hidden');
      $("#selProdPaythemId option[id!='"+brand1+"']").prop('hidden','hidden');
    }
    
    $('.btn_ModalSubmit').click(function() {
      var brand = $('#selBrandPaythemId option:selected').data('name');
      var prod = $('#selProdPaythemId option:selected').data('name');
      // var qty = $("input[name=inputQty]").val();
      var email = $("input[name=inputEmail]").val();
      var mobNo = $("input[name=inputRMobile]").val();
      var captcha = $("input[name=inputCaptcha]").val();
      
      if(brand == undefined || prod == undefined || (email == undefined || email == null || email == "") || (captcha == undefined || captcha == null || captcha == "")){
        alert('Please fill up all required fields.');
        $('#myModal').modal('hide');
        if(brand == undefined){
          $('#selBrandPaythemId').css('border','1px solid red');
        } else if (prod == undefined) {
          $('#selProdPaythemId').css('border','1px solid red');
        } else if (email == undefined || email == null || email == "") {
          $('#emailId').css('border','1px solid red');
        } else if (captcha == undefined || captcha == null || captcha == "") {
          $('#capchaId').css('border','1px solid red');
        }
        
      } else {
        $('#myModal').modal('show');
        $('#selBrandPaythemId').css('border','1px solid #ccc');
        $('#selProdPaythemId').css('border','1px solid #ccc');
        $('#emailId').css('border','1px solid #ccc');
        $('#capchaId').css('border','1px solid #ccc');
      }

      $('#idBrand').html(brand);
      $('#idProductName').html(prod);
      // $('#idProductQty').html(qty);
      $('#idEmail').html(email);
      $('#idMobNo').html(mobNo);

    });

    $( "#selBrandPaythemId" ).change(function() {
      var brand = $('#selBrandPaythemId option:selected').data('name');
      if(brand != undefined){
        $('#selBrandPaythemId').css('border','1px solid #ccc');
      }
    });
    $( "#selProdPaythemId" ).change(function() {
      var prod = $('#selProdPaythemId option:selected').data('name');
      if(prod != undefined){
        $('#selProdPaythemId').css('border','1px solid #ccc');
      }
    });
    $("#emailId").on("input", function() {
      var email = $("input[name=inputEmail]").val();
      if(email != undefined || email != null || email != "") {
        $('#emailId').css('border','1px solid #ccc');
      }
    });
    $("#capchaId").on("input", function() {
      var captcha = $("input[name=inputCaptcha]").val();
      if (captcha != undefined || captcha != null || captcha != "") {
        $('#capchaId').css('border','1px solid #ccc');
      }
    });

  });

  $('#emailId').keyup(function(){
        var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        if(!testEmail.test($('#emailId').val())){
            $('#btnSubmit').prop('disabled', true)
            $('#amount_errEmailSender1').show()
        }
        else if($('#emailId').val() == ''){
            $('#btnSubmit').prop('disabled', true)
        }
        else{
            $('#btnSubmit').prop('disabled', false)
            $('#amount_errEmailSender1').hide()
        }
      })

</script>

