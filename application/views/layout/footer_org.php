
    


        <script src="<?php echo BASE_URL()?>assets/js/bootstrap-datepicker.js"></script>      
        <script src="<?php echo BASE_URL()?>assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo BASE_URL()?>assets/js/jquery-migrate-1.2.1.min.js"></script>
        <script src="<?php echo BASE_URL()?>assets/js/jquery.datetimepicker.full.js"></script>
        <script src="<?php echo BASE_URL()?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo BASE_URL()?>assets/script/script.js"></script>
        <script src="<?php echo BASE_URL()?>assets/js/modernizr.min.js"></script>
        <script src="<?php echo BASE_URL()?>assets/js/pace.min.js"></script>
        <script src="<?php echo BASE_URL()?>assets/js/retina.min.js"></script>
        <script src="<?php echo BASE_URL()?>assets/js/jquery.cookies.js"></script>
    
       <script src="<?php echo BASE_URL()?>assets/js/flot/jquery.flot.min.js"></script>
        <script src="<?php echo BASE_URL()?>assets/js/flot/jquery.flot.resize.min.js"></script>
        <script src="<?php echo BASE_URL()?>assets/js/flot/jquery.flot.spline.min.js"></script>
        <script src="<?php echo BASE_URL()?>assets/js/jquery.sparkline.min.js"></script>
        <script src="<?php echo BASE_URL()?>assets/js/morris.min.js"></script>
        <script src="<?php echo BASE_URL()?>assets/js/raphael-2.1.0.min.js"></script>
        <script src="<?php echo BASE_URL()?>assets/js/bootstrap-wizard.min.js"></script>
        <script src="<?php echo BASE_URL()?>assets/js/select2.min.js"></script>

        <script src="<?php echo BASE_URL()?>assets/js/custom.js"></script>
        <script src="<?php echo BASE_URL()?>assets/js/dashboard.js"></script>
          <script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>

      <!--SLIDER-->
           <script type="text/javascript" src="<?php echo BASE_URL()?>assets/js/jssor.slider.min.js"></script>
    <!-- use jssor.slider.debug.js instead for debug -->
    <script>
        jssor_1_slider_init = function() {
            
            var jssor_1_options = {
              $AutoPlay: true,
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $ThumbnailNavigatorOptions: {
                $Class: $JssorThumbnailNavigator$,
                $Cols: 4,
                $SpacingX: 4,
                $SpacingY: 4,
                $Orientation: 2,
                $Align: 0
              }
            };
            
            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);
            
            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 810);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 100);
                }
            }
            ScaleSlider();
            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", $Jssor$.$WindowResizeFilter(window, ScaleSlider));
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            //responsive code end
        };
    </script>

    <script>
        jssor_1_slider_init();
    </script>

    <script>
    $(document).ready(function(){
      $('#selBiller').change(function(){
        
        var com_group = $(this).children('option:selected').data('desc'); // select attribute billspayment (data-desc)
        var billernote = $(this).children('option:selected').data('type');

          $('.alert-biller').show();
          if (billernote == 8){
            
            $('.alert-biller').html("<i><font color='red'>Notes:</font></i><br />" +
                        "&#9632 Account Number <br />" +
                        "For Manual Inputting of Account No. <br />" +
                        "&#9632 Use the ATM /Phone Reference No. -16 Digits code Besides S.I.N <br />" +
                        "Using BarCode Scanner <br />" +
                        "&#9632 From left-to-right, scan the first and second bar codes only. <br />" +
                        '<img src="'+images_url+'/assets/images/billspayment/meralco_atm.png" style="margin:0 auto; width: 100%;">'
                        );   
          }
          else if (billernote == 3) {

            if (com_group != 'UPS'){

            $('.alert-biller').html("Please collect an additional <font color='red'>&#x20b1 10.00 </font>for the charge."
                                  + " However,please input the actual amount");

            }else{

            $('.alert-biller').html("Please collect an additional <font color='red'>&#x20b1 7.00 </font>for the charge."
                                  + " However,please input the actual amount");
            }
          
          }
          else if (billernote == 15) {
            $('.alert-biller').html("10 digit SSS number + 6 digit containing month (mm)"
                                  + " and year (yyyy) for the applicable payment period. i.e. XXXXXXXXXXmmyyyy");
          }
          else if (billernote == 5) {
            $('.alert-biller').html("Please include two decimal places [e.g. 19600.00]");
          } 
          else if (billernote == 7) {
            $('.alert-biller').html("Please enter 555 and the last 6 digits of your E-Pass Account number in the Account No. field.");
          }
          else if (billernote == 13){
            
            $('.alert-biller').html("<i><font color='red'>Notes:</font></i><br />" +
                        "The staff must validate the amount from the Statement of Account (SoA) presented by the client. Advice the client that the AR from GPRS and their SoA should be presented to the school's accounting department to get the permit." +
                        '<img src="'+images_url+'/assets/images/billspayment/rmmcr.png" style="margin:0 auto; width: 100%;">'
                        );  
          }
          else if (billernote == 20){
            
            $('.alert-biller').html("Please collect an additional &#x20b1 9.00 for the change." +
                        "However, please input the actual amount." +
                        "The &#x20b1 9.00 charge will be automatically deducted to your account." +
                        "Example: Bill = &#x20b1 2000, collect &#x20b1 2009 but input 2000"
                        );                 
          }else {
          $('.alert-biller').hide();
          $('.alert-biller').html("");
          }
          //display messgae//

       });
    });

    </script>

    <!-- MODAL -->
    <?php if ($API['S'] == 99 ): ?>
            <script>
                $(document).ready(function(){
                    $('#modverification').modal({
                            backdrop: 'static',
                            keyboard: false  // to prevent closing with Esc button (if you want this too)
                        })
                    $("#modverification").modal('show');
                });
            </script>
    		<!-- Modal -->
            <div id="modverification" class="modal fade">
                <div class="modal-dialog">
                
                  <!-- Modal content-->
                  <div class="modal-content">
                  
                    <div class="modal-body">
                        
                          <p><?php echo $result['M'] ?></p>

                                  <form class="form-horizontal" method="post" action="<?php echo base_url() ?>Login/" id="signin">
                          
<!--                                     
                                      <div class="form-group">                                   
                                        <div class="col-sm-9">
                                          
                                          <button type="submit" name="btnResendCode" style="border: 0px; background: none;"><i><u>Resend</u></i></button> 
                                        </div>
                                      </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Regcode:</label>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control" name="regcode" id="inputRegcode" placeholder="Regcode" value="<?php echo $result['R'] ?>" readonly>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-3 control-label" style="padding-right:3px;">Device ID:</label>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control" name="device_id" id="inputDeviceID" placeholder="Device ID" value="<?php echo $result['DI'] ?>" readonly>
                                          <button type="submit" name="btnResendCode" style="border: 0px; background: none;"><i><u>Resend Activation Code</u></i></button> 
                                        </div>
                                      </div> 
-->         
                                  
                                      <br />
                                       <!--  <label for="inputPassword3" class="col-sm-3 control-label" style="padding-right:3px;">Verification Code:</label> -->
                                        <div class="row">
                                         
                                        <div class="col-md-12" class="text-right">
                                          <input type="hidden" class="form-control" name="regcode" id="inputRegcode" placeholder="Regcode" value="<?php echo $result['R'] ?>" readonly>
                                         <!--  <input type="text" class="form-control" name="verification_code" id="inputVerificationCode" placeholder="Enter Verification Code" > -->
                                          <button type="submit" name="btnResendCode" class="btn btn-primary"><i><u><span class="glyphicon glyphicon-phone" aria-hidden="true"></span> Resend</u></i></button> 
                                       
                                            <a href="<?php echo BASE_URL(); ?>" class="btn btn-danger"><i><u><span class="glyphicon glyphicon-cancel" aria-hidden="true"></span> Dismiss</u></i></a>
                                        </div>
                                      </div>
                                  
                                  
                                  </form>
                      </div>
                  
                  
                  </div>
                  
                </div>
              </div>
              

           
    <?php endif ?>
<script>
$("document").ready(function(){
  $("#upgrade_accountModal").modal('show');
});
</script>
<script type="text/javascript">
//AJAX FOR REGISTRATION
$(document).ready(function() {
  hiddenMob = $(".hiddenMob");
   hiddenMobpin = $(".hiddenMobpin");
  
  // form submit event

  $("#btnmobSend").on('click',function(){
      hiddenMob.val($("#regMobile").val());
      $("#btnMobReg").click();
     });


   $("#inputPinmobile").on('focusout',function(){
   	if ($("#inputPinmobile").val() != "") {
      hiddenMobpin.val($(this).val());
     	$(".hiddenMobs").val($("#regMobile").val());
    	$("#btnMobpinReg").click();
     }
     });

        $("#frmMobReg").on('submit', function() {
            $("#Mobloading").css('display','block');
            $(".pleaseWait1").css('display','block');

                 var data = $(this).serialize();
                  $.ajax({
                      type : 'POST',
                      url  : 'check_mobile',
                      data : data,
                      success :  function(data)
                      { 
                        $("#Mobloading").css('display','none');
                        $(".pleaseWait1").css('display','none');
                          $("#infos").html("");
                         $("#errors").html("");
                          $("#errors").css('display','none');
                          $("#infos").css('display','none');
                          $("#btnmobSend").html("Resend");
                        var res = data.split('|');
                        if (res[0] == 1 ) {

                          $("#inputPinmobile").removeAttr('disabled');
                          $("#inputPinmobile").focus();
                          $("#infos").css('display','block');
                          $("#infos").html(res[1]);
                        }
                        if (res[0] == 0 ) {
                          $("#infos").css('display','none');
                         
                          $("#errors").css('display','block');
                          $("#errors").html(res[1]);
                        }
                      }
                  });
                  return false;
                });

        $("#frmMobpinReg").on('submit', function() {
            $("#MobPinloading").css('display','block');
            $(".pleaseWait2").css('display','block');

                 var data = $(this).serialize();
                  $.ajax({
                      type : 'POST',
                      url  : 'check_mobile',
                      data : data,
                     
                      success :  function(data)
                      { 
                        $("#MobPinloading").css('display','none');
                        $(".pleaseWait2").css('display','none');

                        var res = data.split('|');
                        $("#infos").html("");
                         $("#errors").html("");
                          $("#errors").css('display','none');
                          $("#infos").css('display','none');
                        if (res[0] == 1 ) {
                          $("#infos").css('display','block');
                        $("#infos").html(res[1]);
                         $("#inputEmail").removeAttr('disabled');
                         $("#inputEmail").focus();
                      
                        }
                        if (res[0] === 0 ) {                        
                          $("#errors").css('display','block');
                             $("#errors").html(res[1]);
                          $('#inputEmail').attr('disabled',true);
                        }
                      }
                  });
                  return false;
                      });

  });

//EMAIL CONFIRMATION
$(document).ready(function() {
  hiddenE = $(".hiddenE");
  hiddenEpin = $(".hiddenEpin");


  $("#btnemailSend").on('click',function(){
      hiddenE.val($("#inputEmail").val());
      $("#btnEReg").click();
    });


  $("#inputPinemail").on('focusout',function(){
  	if ($("#inputPinemail").val() != "") {
      hiddenEpin.val($(this).val());
     $(".hiddenEpins").val($("#inputEmail").val());
      $("#btnEpinReg").click();
  }
    });


        $("#frmEReg").on('submit', function() {
            $("#Eloading").css('display','block');
            $(".pleaseWait3").css('display','block');

                 var data = $(this).serialize();
                  $.ajax({
                      type : 'POST',
                      url  : 'check_email',
                      data : data,
                      success :  function(data)
                      { 
                        $("#Eloading").css('display','none');
                        $(".pleaseWait3").css('display','none');
                         $("#btnemailSend").html("Resend");
                          $("#errors").css('display','none');
                          $("#infos").css('display','none');
                        var res = data.split('|');
                        if (res[0] == 1 ) {
                          $("#inputPinemail").removeAttr('disabled');
                          $("#inputPinemail").focus();
                          $("#infos").css('display','block');
                            $("#infos").html(res[1]);
                        }

                        if (res[0] == 0 ) {
                          $("#infos").css('display','none');
                          $("#errors").css('display','block');
                            $("#errors").html(res[1]);
                        }
                      }
                  });
                  return false;
                });

        $("#frmEpinReg").on('submit', function() {
            $("#EPinloading").css('display','block');
            $(".pleaseWait4").css('display','block');

                 var data = $(this).serialize();
                  $.ajax({
                      type : 'POST',
                      url  : 'check_email',
                      data : data,
                     
                      success :  function(data)
                      { 
                        $("#EPinloading").css('display','none');
                        $(".pleaseWait4").css('display','none');

                        var res = data.split('|');
                        $("#infos").html("");
                         $("#errors").html("");
                          $("#errors").css('display','none');
                          $("#infos").css('display','none');

                        if (res[0] == 1 ) {
                         $("#infos").css('display','block');
                            $("#infos").html(res[1]);
                         $("#inputAddress").removeAttr('disabled');
                         $("#inputAddress").focus();
                         $("#inputZipcode").removeAttr('disabled');
                         $("#btnStep3").removeAttr('disabled');
                        }

                        if (res[0] == 0 ) {                        
                          $("#errors").css('display','block');
                             $("#errors").html(res[1]);
                          $('#inputAddress').attr('disabled',true);
                          $('#inputZipcode').attr('disabled',true);
                        }
                      }
                  });
                  return false;
                      });

  });
//AJAX FOR REGISTRATION
</script>
    </body>
</html>
