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
              <h4>SGD LOADING</h4>
          </div>
      </div><!-- media -->
  </div><!-- pageheader -->
  <div class="contentpanel">
    <!--========================| Control Panel |===========================-->
      <div class="row">
        <div class="col-xs-12  col-md-5">
            <!--=================| Error Message |==========================-->
              <?php if ($Brand['S'] != "1"){ ?>
                  <div class="alert alert-danger"><b><?php echo $Brand['M'] ?></b></div>
              <?php } ?>
              <?php if ($result['S'] === 0): ?>
                <div class="alert alert-danger">
                  <i class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></i>
                  <b><?php echo $result['M']; ?></b>
                </div>
              <?php endif ?>
              <?php if ($result['S'] == 1): ?>
                  <div class="alert alert-success"><b><?php echo $result['M']; ?></b></div>
              <?php endif ?>
              <?php if ($result['S'] == 1 && $result['TN'] != NULL): ?>
                  <div class="alert alert-success" style="width:auto;">&nbsp;&nbsp;<b>Transaction Successful!</b> Reference Number: <a href="<?php echo $result['URL']; ?>" target="_blank"><?php echo $result['TN']; ?></a><br>
                        &nbsp;&nbsp;<small>Click <a href="<?php echo $result['URL']; ?>" target="_blank">here</a> to download copy of the Acknowledgement Receipt.</small><br><br>
                        &nbsp;&nbsp;<b>Note:</b> The copy of the e-Voucher has been sent to client email address <?php echo $result['EA'] ?>
                  </div>
              <?php endif ?>
            <!--=================| Row Content |============================-->          
              <div class="row">
                  <div class='col-xs-12 col-md-12'>
                    <form name="paythemForm" action="<?php echo BASE_URL()?>international_loading/sgd_loading_new" method="post" id="frmetisalatloading">
                      <div class="form-group" >
                        <select class="form-control" name="selTelcoSGD" id="selTelcoSGDId" required>
                          <option value="" disabled selected>SELECT NETWORK</option>
                          <?php 
                              foreach($BrandList as $rowBrand) {
                                  
                                  if( isset($_POST['selTelcoSGD']) && ($rowBrand['id'] == $_POST['selTelcoSGD']) ) {
                                    echo "<option data-id='".$rowBrand['telcoid']."' data-name='".$rowBrand['op']."' value='".$rowBrand['telcoid']."' selected>".$rowBrand['telconame']."</option>";
                                  } else {
                                    echo "<option data-id='".$rowBrand['telcoid']."' data-name='".$rowBrand['op']."' value='".$rowBrand['telcoid']."'>".$rowBrand['telconame']."</option>";
                                  }

                              }
                          ?>

                        </select>
                        <input type="hidden" class="form-control" id="telcoOP" name="inputTelcoOP" />
                        <br />
                      </div>
                      <div class="form-group" >
                        <select class="form-control" name="selPlancodeSGD" id="selPlancodeSGDId" required>
                            <option value="" disabled selected>SELECT PRODUCT</option>
                            <?php 
                            // print_r($ProductList);
                                if($ProductList!=null){
                                  foreach($ProductList as $rowProduct) {
                                    // print_r($rowProduct);
                                  
                                    if( isset($_POST['selPlancodeSGD']) && ($rowProduct['telcoid'] == $_POST['selPlancodeSGD']) ) {
                                        echo "<option data-prodcode='".$rowProduct['productcode']."' data-plancode='".$rowProduct['amount']."' id='".$rowProduct['telcoid']."' data-name='".$rowProduct['description']."' value='".$rowProduct['item_code']."' selected>".$rowProduct['description']."</option>";
                                    } else {
                                      echo "<option data-prodcode='".$rowProduct['productcode']."' data-plancode='".$rowProduct['amount']."' id='".$rowProduct['telcoid']."' data-name='".$rowProduct['description']."' value='".$rowProduct['item_code']."' hidden>".$rowProduct['description']."</option>";
                                    }

                                  }
                                }
                            ?>

                        </select>
                        <input type="hidden" class="form-control" id="ProductCode" name="inputProductCode" />
                        <br />
                        
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control amountClass"  id="amountId" name="inputAmount" placeholder="Amount" readonly/>
                      </div>
                      <br />
                      <div class="form-group">
                        <input type="email" class="form-control" name="inputEmail" value="<?php echo $_POST['inputEmail']; ?>" id="emailId" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" placeholder="Email Address" required /><div id="emailMsg"></div>
                        <!--<input type="text" class="form-control" id="mobileId" name="inputRMobile" value="<?php echo $_POST['inputRMobile']; ?>" placeholder="Mobile Number" />-->
                      </div>
                      <div class="form-group">
                        <h4>Security Question: <b>What is <?php echo $captcha['code1']  ?> + <?php echo $captcha['code2']  ?> ?</b></h4>
                      </div>
                      <div class="form-group">
                          <input type="number" class="form-control" id="capchaId" name="inputCaptcha" placeholder="Answer" required/>
                      </div>
                      <div class="form-group text-right">
                        <button type="button" class="btn btn-info btn-lg btn_ModalSubmit" data-toggle="modal" id="btnSubmit" data-target="#">Submit</button>
                      </div>

                      <?php //print_r($result) ?>
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

                              <div class="alert alert-info"><b>Please check your details and click "confirm button" to proceed transaction.</b></div>
                        
                              <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right:64px;">Network Name :</span>
                                  <span class="form-control" id="basic-addon2" style=""><label id="idBrand" class="idBrand"></label></span>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right:67px;">Product Name :</span>
                                  <span class="form-control" id="basic-addon2" style=""><label id="idProductName" class="idProductName"></label></span>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right:55px;">Product Amount :</span>
                                  <span class="form-control" id="basic-addon2" style=""><label id="idProductAmount" class="idProductAmount"></label></span>
                                </div>
                              </div>
                              <div class="form-group">
                                <!-- <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right:61px;">Mobile Number :</span>
                                  <span class="form-control" id="basic-addon2" style=""><label id="idMobileNo" class="idMobileNo"></label></span>
                                </div> -->
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right:61px;">Email :</span>
                                  <span class="form-control" id="basic-addon2" style=""><label id="idEmail" class="idEmail"></label></span>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right:17px;">Transaction Password :</span>
                                  <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                                </div>
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
                  </div>
              </div>
              
        </div> <!--col-xs-6 col-md-6-->
      </div>
    <!--====================================================================-->
  </div>
</div>
<script src="<?php echo BASE_URL()?>assets/js/jquery-2.1.4.min.js"></script>
<script>
  
  $(document).ready(function(){
     
    $('input[name="inputTpass"]').focus();
    $("#selTelcoSGDId").change(function(){
      var brand  = $(this).val();
      // var brand  = $(this).find(':selected').data('id');
      var getTelcoOp = $(this).find(':selected').data('name');
      $('#telcoOP').val(getTelcoOp);
      // alert(brand);
      $('#selPlancodeSGDId option').eq(0).prop('selected',true);
      $("option[id='"+brand+"']").removeAttr('hidden');

      $("#selPlancodeSGDId option[id!='"+brand+"']").prop('hidden','hidden');
    
    });

    var brand1 = $('#selTelcoSGDId option:selected').val();
    if(brand1 && brand1 !="") {
      // alert(brand1);
      $("#selPlancodeSGDId option[id='"+brand1+"']").removeAttr('hidden');
      $("#selPlancodeSGDId option[id!='"+brand1+"']").prop('hidden','hidden');
    }

    $('.btn_ModalSubmit').click(function() {
      var brand = $('#selTelcoSGDId option:selected').data('name');
      var prod = $('#selPlancodeSGDId option:selected').data('name');
      var email = $("input[name=inputEmail]").val();
      var amount = $("input[name=inputAmount]").val();
      //var mobNo = $("input[name=inputRMobile]").val();
      var captcha = $("input[name=inputCaptcha]").val();
      // alert(mobNo);
       if(brand == undefined || prod == undefined || (email == undefined || email == null || email == "") || (captcha == undefined || captcha == null || captcha == "")){
      //if(brand == undefined || prod == undefined || (mobNo == undefined || mobNo == null || mobNo == "") || (captcha == undefined || captcha == null || captcha == "")){
        alert('Please fill up all required fields.');
        $('#myModal').modal('hide');
        if(brand == undefined){
          $('#selTelcoSGDId').css('border','1px solid red');
        } else if (prod == undefined) {
          $('#selPlancodeSGDId').css('border','1px solid red');
        // } else if (email == undefined || email == null || email == "") {
        //   $('#emailId').css('border','1px solid red');
        } else if (mobNo == undefined || mobNo == null || mobNo == "") {
          $('#mobileId').css('border','1px solid red');
        } else if (captcha == undefined || captcha == null || captcha == "") {
          $('#capchaId').css('border','1px solid red');
        }
        
      } else {
        $('#myModal').modal('show');
        $('#selTelcoSGDId').css('border','1px solid #ccc');
        $('#selPlancodeSGDId').css('border','1px solid #ccc');
        $('#emailId').css('border','1px solid #ccc');
        //$('#mobileId').css('border','1px solid #ccc');
        $('#capchaId').css('border','1px solid #ccc');
      }

      $('#idBrand').html(brand);
      $('#idProductName').html(prod);
      $('#idProductAmount').html(amount);
      // $('#idProductQty').html(qty);
      $('#idEmail').html(email);
      //$('#idMobileNo').html(mobNo);

    });

    $( "#selTelcoSGDId" ).change(function() {
      var brand = $('#selTelcoSGDId option:selected').data('name');
      if(brand != undefined){
        $('#selTelcoSGDId').css('border','1px solid #ccc');
      }
    });
    $( "#selPlancodeSGDId" ).change(function() {
      var prod = $('#selPlancodeSGDId option:selected').data('name');
      var getProdCode = $(this).find(':selected').data('prodcode');
      var getPlancode = $(this).find(':selected').data('plancode');
      $('#ProductCode').val(getProdCode);
      $('.amountClass').val(getPlancode);
      
      if(prod != undefined){
        $('#selPlancodeSGDId').css('border','1px solid #ccc');
      }
    });
    // $("#emailId").on("input", function() {
    //   var email = $("input[name=inputEmail]").val();
    //   if(email != undefined || email != null || email != "") {
    //     $('#emailId').css('border','1px solid #ccc');
    //   }
    // });
    $("#mobileId").on("input", function() {
      var mobNo = $("input[name=inputRMobile]").val();
      if(mobNo != undefined || mobNo != null || mobNo != "") {
        $('#mobileId').css('border','1px solid #ccc');
      }
    });
    $("#capchaId").on("input", function() {
      var captcha = $("input[name=inputCaptcha]").val();
      if (captcha != undefined || captcha != null || captcha != "") {
        $('#capchaId').css('border','1px solid #ccc');
      }
    });

  });

</script>

