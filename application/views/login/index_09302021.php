<html>
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL()?>assets/login_new/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL()?>assets/login_new/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL()?>assets/login_new/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL()?>assets/login_new/vendor/animate/animate.css">
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL()?>assets/login_new/vendor/css-hamburgers/hamburgers.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL()?>assets/login_new/vendor/animsition/css/animsition.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL()?>assets/login_new/vendor/select2/select2.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL()?>assets/login_new/vendor/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL()?>assets/login_new/css/util.css">
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL()?>assets/login_new/css/main_09302021.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <div id="fb-root"></div>
  <title>Login</title>

  <style>
    .btnCode-c {
        display: block;
        text-align: center;
        margin-bottom: 10px;
    }
    .btnCode-c_a {
        display: block;
        float: initial;
        margin: 0 auto !important;
    }
    .buttonVerify{
      cursor: pointer;
      margin: 0;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -20%);
      background-color: #FFF9E1;
      color: #FFC500;
      height: 60px;
      width: 250px;
      border-radius: 10px;
      font-weight: 500;
      font-size: 20px;
      border: none;
    }
    .btnOKAY{
        font-size: 22px;
        height: 60px;
        width: 170px;
        border: none;
        color: #FFC500;
        background-color: #FFF9E1;
        margin: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        border-radius: 15px;
        transform: translate(-50%, 70%);
    }
    .imgCheck{
      height: 110px;
      margin-top: 5px;
      width: 110px;
      margin-left: 10px;
    }
</style>

  <body>
    <?php if (is_null($process)): ?>
      <div class="login-container" id="login-div">
        <div class="col-sm-12 col-md-8 col-lg-6 col-xl-3 login-form" align="center">
          <form class="validate-form" action="<?php echo base_url() ?>Login/" method="post" id="signin">
            <?php 
              if ($_SERVER['SERVER_NAME'] == 'portal.globalpinoyremittance.com/' || $_SERVER['SERVER_NAME'] == 'portal.globalpinoyremittance.com' || $_SERVER['SERVER_NAME'] == 'https://portal.globalpinoyremittance.com/' || $_SERVER['SERVER_NAME'] == 'https://portal.globalpinoyremittance.com') 
                echo'<img src="'.BASE_URL().'assets/login_new/images/GPRS_LOGO.png" class="login-logo">';
              else 
                echo'<img src="'.BASE_URL().'assets/login_new/images/Unified_Logo-01.png" class="login-logo">';
            ?>
            
            <div class="align-items">
              <div style="margin-bottom: 20px">
                <input class="login-input" type="text" name="sign_username" id="inputUsername" placeholder="Email Address/Username" onkeypress="return validateKeypress(alphanumeric)"  maxlength="255" required/>
              </div>
              
              <div class="pass-input-container" style="margin-bottom: 20px">
                <input class="login-input" type="password" name="sign_password" id="inputPassword" placeholder="Password" maxlength="255" required/>

                <img id="passIcon" class="pass-icon" src="<?php echo BASE_URL()?>assets/login_new/images/icons/hidepasswordicon.png" onclick="showHidePass()"/>
              </div>

              <div>
                <?php if ($result['S'] === 0 || $result['S'] === '0'): ?>
                  <div style="margin-bottom: 15px">
                    <span class="ErrorMsg" style="color:red;">
                      <?php echo $result['M']; ?>
                    </span>
                  </div>

                <?php elseif ($result['S'] === 1 || $result['S'] === '1'): ?>
                  <div style="margin-bottom: 15px">
                    <span class="ErrorMsg" >
                      <?php echo $result['M']?><?php echo '<br> Please Log-In to continue.'?>
                    </span>
                  </div>

                <?php endif ?>

                <?php if ($API['S'] === 0 || $API['S'] === '0'): ?>
                  <div style="margin-bottom: 15px">
                    <span class="ErrorMsg" style="color:red;">
                      <?php echo $API['M']; ?>
                    </span>
                  </div>


                <?php elseif ($API['S'] === 1 || $API['S'] === '1'): ?>
                  <div style="margin-bottom: 15px">
                    <span class="ErrorMsg" >
                      <?php echo $API['M']; ?>
                    </span>
                  </div>
      
                <?php endif ?>
              </div>
            
              <div style="margin-bottom: 20px">
                <button class="login-button" name="btnsignin" id="btnsignin" onclick="btnsignin.click();">
                  Log In
                </button>
              </div>

              <div align="left" style="margin-bottom: 20px">
                <input type="checkbox" style="cursor: pointer" id="rememberCbx">

                <label for="rememberCbx" class="remember-me" style="margin-left: 5px; cursor: pointer;">
                  Remember me
                </label>
              </div>

              <div style="margin-bottom: 10px">
                <span class="new-user">New User? </span> <span class="y-link" onclick="window.open('<?php echo BASE_URL() ?>Registration/select_account_type','_self');">Create an account</span>
              </div>

              <div style="margin-bottom: 15px">
                <span class="y-link" href="#" onclick="window.location.replace('<?php echo BASE_URL() ?>Login/forgot_password')">Forgot your password?</span>
              </div>

              <div style="margin-bottom: 15px">
                <span class="custom-separator">
                  <span class="custom-separator-span">
                    or
                  </span>
                </span>
              </div>
<!-- 
              <div class="row">
                <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1" style="width: 100%; height: 100%">
                  <div class="fb-login-button" data-width="" data-size="large" data-button-type="continue_with" data-layout="rounded" scope="public_profile,email" onlogin="checkLoginState();" data-auto-logout-link="false" data-use-continue-as="true"></div>
                </div>
              </div> -->
              <div class="row">

                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                  <img src="<?php echo BASE_URL()?>assets/login_new/images/googlebutton.png" class="login-as-button" onclick="alert('Coming Soon.')">
                </div>

                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                  <img src="<?php echo BASE_URL()?>assets/login_new/images/applebutton.png" class="login-as-button" onclick="alert('Coming Soon.')">
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="footer-container">
        <div class="row">
          <div class="col">
            <img class="footer-unified-logo" src="<?php echo BASE_URL() ?>assets/login_new/images/Unified_Logo-01.png" class="login-logo">
          </div>

          <div class="col-11" style="margin-right: 50px; margin-top: 10px">
            <span class="footer-unified-label">
              Unified Products <br/>
              and Services, Inc.
            </span>
          </div>
        </div>

        <hr style="border: 1px solid rgba(0, 0, 0, 0.2);" />

        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-4">
            <div style="margin-bottom: 20px">
              <span class="footer-title">
                CONTACT INFO
              </span>
            </div>
            
            <div style="margin-bottom: 10px">
              <span class="footer-subtitle">
                <strong>Address:</strong> #1520 JR Building, Quezon Ave., South Triangle, Quezon City
              </span>
            </div>

            <div style="margin-bottom: 10px">
              <span class="footer-subtitle">
                <strong>Contact Number:</strong> (02) 998-0991, (0919) 081-5158, (0917) 783-1922, (0933) 995-2860
              </span>
            </div>

            <div>
              <span class="footer-subtitle">
                <strong>Email:</strong> contactus@unified.ph
              </span>
            </div>
          </div>

          <div class="col-sm-12 col-md-12 col-lg-3">
            <div style="margin-bottom: 20px">
              <span class="footer-title">
                OTHER LINKS
              </span>
            </div>

            <div style="margin-bottom: 10px">
              <span class="footer-subtitle footer-link" onclick="window.open('https://support.unified.ph')">
                Help
              </span>
            </div>
            
            <div style="margin-bottom: 10px">
              <span class="footer-subtitle footer-link" onclick="window.open('https://corporate.unifiedproducts.com/')">
                About Us
              </span>
            </div>

            <div style="margin-bottom: 10px">
              <span class="footer-subtitle footer-link" onclick="window.open('https://secure.unified.ph/unified/Privacy_policy')">
                Privacy Policy
              </span>
            </div>

            <div style="margin-bottom: 10px">
              <span class="footer-subtitle footer-link" onclick="window.open('https://secure.unified.ph/unified/terms')">
                Terms and Conditions
              </span>
            </div>
          </div>

          <div class="col-sm-12 col-md-12 col-lg-5">
            <div div style="margin-bottom: 20px">
              <span class="footer-title">
                ADS
              </span>
            </div>

            <div class="row mt-2">
              <div class="col-sm-3 col-md-6 col-lg-6 col-xl-3">
                <img class="footer-ads-img" src="<?php echo BASE_URL()?>assets/login_new/images/Capture.JPG" onclick="window.open('http://www.globalpinoytravel.com','Travel')"/>
              </div>
              
              <div class="col-sm-3 col-md-6 col-lg-6 col-xl-3">
                <img class="footer-ads-img" src="<?php echo BASE_URL()?>assets/login_new/images/PL_FB Poster_Artboard 5 copy 2.jpg" onclick="window.open('https://www.phillands.com/','Land')">
              </div>

              <div class="col-sm-3 col-md-6 col-lg-6 col-xl-3">
                <img class="footer-ads-img" src="<?php echo BASE_URL()?>assets/login_new/images/GocabLogo.jpeg" onclick="window.open('http://gocab.ph/','GoCab')">
              </div>

              <div class="col-sm-3 col-md-6 col-lg-6 col-xl-3">
                <img class="footer-ads-img" src="<?php echo BASE_URL()?>assets/login_new/images/RicemartLogo.jpeg" onclick="window.open('https://ricemart.ph/')">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="powered-by">
        <span>
          Copyright © 2020. All Rights Reserved. Powered by

          <img class="ecash-logo" src="<?php echo BASE_URL()?>assets/login_new/images/ecashlogo.png" />
        </span>
      </div>

<div id="fb-customer-chat" class="fb-customerchat">
</div>


      <div id="dropDownSelect1"></div>

    <?php elseif ($process == 1): ?>
      <div class="col-md-11 ">
        <div class="col-md-5 col-md-offset-3" style="margin-top: 10%;">
          <div class="panel panel-default" style="border:none !important; font-size: 20px;">
            <div class="panel-heading" style="margin-left: 181px;margin-right: -140px;">
              <div class="row">
                <div class="col-md-12">
                  <span class="label-input100  w-full text-center p-t-10 p-b-20" style="display: flex; color: red; text-align:center !important;"><?php echo "*NOTE:". $result['M'] ?></span>
                  <form class="form-horizontal" method="post" action="<?php echo base_url() ?>Login/" id="signin">
                    <div class="row p-t-10 p-b-20">
                      <div class="col-md-12" class="text-right">
                      <input type="hidden" name = "username" id="inputUsername" value="<?php echo $username?>" readonly/>
                      <input type="hidden" class="form-control" name="regcode" id="inputRegcode" placeholder="Regcode" value="<?php echo $result['R'] ?>" readonly> 
                      <div class="btnCode-c">
                          <button type="submit" name="btnResendCode" class="btnCode-c_a" style="font-size: 20px; margin-right: 50px; color:#00a090; border:none; background-color:#f5f5f5;">RESEND EMAIL ACTIVATION CODE</button>
                        </form>
                            <p style="margin-top: 20px; font-size: large; color: black;">or</p>
                            <a href="#" class="btnCode-c_a" data-toggle="modal" data-target="#addModalCode" style="font-size: 20px;margin-right: 50px; color:#00a090; border:none; background-color:#f5f5f5; text-decoration:none;" id="sendOTP">SEND VIA SMS</a>
                            <a href="<?php echo BASE_URL(); ?>" class="col-md-10" style="line-height: 3; margin-top: 30px; background-color: #ffd300; border: none; font-size: inherit; margin-left: 45px;"><span class="glyphicon glyphicon-cancel" aria-hidden="true"></span> Dismiss</a>
                      </div>
                      
                      </div>
                    </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    <?php endif ?>
    
    <div class="modal fade" id="addModalCode" role="dialog" data-keyboard="false" data-backdrop="static">
          <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content" style="position: absolute; left: 30%;top: 50%;margin-left: -150px; margin-top: 170px;width: 100%; height: 350px; border-radius:25px;">
                      <div style="margin-top: 20px; margin-left: 12px;">
                        <h4 style="text-align: center; margin-left: 50px; font-weight: 810;">SMS Verification</h4>
                      </div>
                      <div style="height:65px">
                        <p style="padding-top: 7px; text-align: center; font-family: Arial, Helvetica, sans-serif; color: #555450; font-size: 16px;">Please enter the OTP (One Time Password) Code that we sent to your mobile number.</p>
                      </div>
                      <div style="height:125px">
                        <div>
                          <p style="margin-bottom: 5px !important; font-size: larger; text-align: center;" >Enter OTP (One Time Password) code</p>
                          <input type="hidden" name = "username" id="inputUsername1" value="<?php echo $username?>" readonly/>
                        </div>
                        <div style="position: relative;">
                          <input type="text" id="vcode" name="vcode"  maxlength="6" name="otpCode" id="otpCode" placeholder="Code"  onkeypress="return validateKeypress(number)" style="text-align: center; border:none; background-color:#f4f4f4; height:65px; border-radius:10px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, 0%);"/>
                        </div>
                        <div>
                          <a style="text-decoration: none; color:#007df9; position: absolute; top: 50%; left: 50%; transform: translate(-50%, 230%);"  href="#" id= "resendOTP">Resend</a>
                        </div>
                      </div>
                      <div style="height:60px; margin: 0; position: relative;">
                      <input type="hidden" class="form-control" name="regcode" id="inputRegcode1" placeholder="Regcode" value="<?php echo $result['R'] ?>" readonly> 
                        <input type="hidden" id="vId" name="vId" readonly>
                        <button class="buttonVerify" id="verify_OTP">Verify</button>
                      </div>
              </div>
          </div>
    </div>

    <script src="<?php echo BASE_URL()?>assets/login_new/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="<?php echo BASE_URL()?>assets/login_new/vendor/animsition/js/animsition.min.js"></script>
    <script src="<?php echo BASE_URL()?>assets/login_new/vendor/bootstrap/js/popper.js"></script>
    <script src="<?php echo BASE_URL()?>assets/login_new/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo BASE_URL()?>assets/login_new/vendor/select2/select2.min.js"></script>
    <script src="<?php echo BASE_URL()?>assets/login_new/vendor/daterangepicker/moment.min.js"></script>
    <script src="<?php echo BASE_URL()?>assets/login_new/vendor/daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo BASE_URL()?>assets/login_new/js/main.js"></script>

<script>
// ##########################################################################
$('#resendOTP').click(function(){
  console.log("resendOTP")
  if($(this).data('timer') != 'START'){
    delayTimer();
    var inputUsername = $('#inputUsername').val();
    var inputRegcode = $('#inputRegcode').val();
    

    var formData = new FormData();


    formData.append('username', inputUsername);
    formData.append('regcode', inputRegcode);

    $.ajax({
        url         : '/Login/Resend_code',
        type        : 'POST',
        data        : formData,
        processData : false,
        contentType : false,
        success     : function (data) { 
            var jsonData = JSON.parse(data);
            if(jsonData.S == 1){
              $("#vId").val(jsonData.D)
              alert(jsonData.M)
            }else{
              alert("Error!")
            }
        }
    })
  }
        

        
    })

    function delayTimer(){
      $('#resendOTP').attr("data-timer","START");

        var timeleft = 120;
        var interval = setInterval(function(){
          if(timeleft <= 0){
            clearInterval(interval);
            $('#resendOTP').text("RESEND").text("RESEND").removeAttr("data-timer");
          } else {
            $('#resendOTP').text(timeleft);
          }
          timeleft -= 1;
        }, 1000);
    }

// ##########################################################################


var alphanumeric = /^[a-zA-Z0-9!@#$%^&()_+\-=\[\]{};':"\\|,.<>\/?]$/;
var number = /[0-9]/;

function validateKeypress(validChars) {
    var keyChar = String.fromCharCode(event.which || event.keyCode);
    return validChars.test(keyChar) ? keyChar : false;
}

      $(document).ready(function () {
        var x=window.scrollX;
        var y=window.scrollY;

        window.onscroll=function () {
          window.scrollTo(x, y);
        };
        
        setTimeout(() => {
          window.onscroll= function () {
          };
        }, 800);
      });

      $(".selection-2").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
      });

      $('#inputUsername').bind('keydown', function(e){
        if(e.shiftKey && e.keyCode == 13) { 
          e.preventDefault();
        }
      });

      $('#inputPassword').bind('keydown', function(e){
        if(e.shiftKey && e.keyCode == 13) { 
          e.preventDefault();
        }
      });
      
      function showHidePass () {
        if (document.getElementById('inputPassword').type === "password") {
          document.getElementById('inputPassword').type = "text"
          document.getElementById('passIcon').src = "<?php echo BASE_URL()?>assets/login_new/images/icons/showpasswordicon.png"
        } else {
          document.getElementById('inputPassword').type = "password"
          document.getElementById('passIcon').src = "<?php echo BASE_URL()?>assets/login_new/images/icons/hidepasswordicon.png"
        }
      }

    $('#sendOTP').click(function(){
      if($('#resendOTP').data('timer') != 'START'){
        var inputUsername = $('#inputUsername').val();
        var inputRegcode = $('#inputRegcode').val();

        var formData = new FormData();

        formData.append('username', inputUsername);
        formData.append('regcode', inputRegcode);

   


        $.ajax({
            url         : '/Login/Resend_code',
            type        : 'POST',
            data        : formData,
            processData : false,
            contentType : false,
            success     : function (data) { 
                var jsonData = JSON.parse(data);
                if(jsonData.S == 1){
                  delayTimer();
                  $("#vId").val(JSON.stringify(jsonData.D))
                  alert(jsonData.M)
                }else{
                  alert("Error!")
                }
            }
        })
      }
        
    });


    $("#verify_OTP").on('click', function(){
      waitingDialog.show('Please Wait.', {dialogSize: 'sm', progressType: 'primary'});
      
      var inputUsername = $('#inputUsername1').val();
      var inputRegcode = $('#inputRegcode1').val();
      var vcode = $('#vcode').val();
      var vId = $('#vId').val();
      

      var formData = new FormData();


      formData.append('username', inputUsername);
      formData.append('regcode', inputRegcode);
      formData.append('vcode', vcode);
      formData.append('vId', vId);
      
                    
      $.ajax({
          url         : '/Login/verifyCode',
          type        : 'POST',
          data        : formData,
          processData : false,
          contentType : false,
          success     : function (data) { 
            var jsonData = JSON.parse(data);
            if(jsonData.S == 1){
              // showModal(jsonData.M);
              alert(jsonData.M);
              window.location.replace("https://secure.unified.ph/login");
            }else if (jsonData.S == 0){
              // showModal(jsonData.M);
              alert(jsonData.M);
            }else{
              alert("Error!")
            }
            waitingDialog.hide()
          }
      })
    });


    function showModal(res){
      $('#addModalCode').modal('hide');
      $('#showContinue12').modal('show');
      $('#pConfirm').text(res);

    }
    </script>
  </body>
</html>