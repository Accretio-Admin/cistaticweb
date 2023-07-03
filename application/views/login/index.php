<!--   <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> -->
<!--===============================================================================================-->  
<link rel="icon" type="image/png" href="assets/login_new/images/icons/favicon.ico"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL()?>assets/login_new/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL()?>assets/login_new/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL()?>assets/login_new/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL()?>assets/login_new/vendor/animate/animate.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL()?>assets/login_new/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL()?>assets/login_new/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL()?>assets/login_new/vendor/select2/select2.min.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL()?>assets/login_new/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL()?>assets/login_new/css/util.css">
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL()?>assets/login_new/css/main.css">
<!--===============================================================================================-->
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>
<!--===============================================================================================-->
<!--==================================| Process is Null |==========================================-->
<?php if (is_null($process)): ?>
    <div class="login_container">
      <div class="col-2 side_div">
        <div>
        <img class="side_img" src="<?php echo BASE_URL()?>assets/login_new/images/Capture.JPG"
          onclick="window.open('http://www.globalpinoytravel.com','Travel');"></br></br></br>
        <img class="side_img" src="<?php echo BASE_URL()?>assets/login_new/images/PL_FB Poster_Artboard 5 copy 2.jpg"
          onclick="window.open('https://www.phillands.com/','Land');">
        </div>
      </div>
      <div class="col-sm-12 col-md-4 login_divform w3-card-2" align="center" >
        <form class="validate-form" action="<?php echo base_url() ?>Login/" method="post" id="signin">
          <?php 
          if($_SERVER['SERVER_NAME'] == 'portal.globalpinoyremittance.com/' || $_SERVER['SERVER_NAME'] == 'portal.globalpinoyremittance.com' || $_SERVER['SERVER_NAME'] == 'https://portal.globalpinoyremittance.com/' || $_SERVER['SERVER_NAME'] == 'https://portal.globalpinoyremittance.com') 
            echo'<img src="'.BASE_URL().'assets/login_new/images/GPRS_LOGO.png" class="login_logo">';
          else 
            echo'<img src="'.BASE_URL().'assets/login_new/images/Unified_Logo-01.png" class="login_logo">';
          ?>
          <?php if ($result['S'] === 0 || $result['S'] === '0'): ?>
            <p  class="ErrorP alert-danger">
            <span class="ErrorMsg xalert alert-danger" style="color:red;"><?php echo $result['M']; ?></span>
            <?php elseif ($result['S'] === 1 || $result['S'] === '1'): ?>
            <span class="ErrorMsg xalert alert-success" ><?php echo $result['M']?><?php echo '<br> Please Log-In to continue.'?></span>
            <?php endif ?>
            <?php if ($API['S'] === 0 || $API['S'] === '0'): ?>
            <span class="ErrorMsg xalert alert-danger" style="color:red;"><?php echo $API['M']; ?></span>
            <?php elseif ($API['S'] === 1 || $API['S'] === '1'): ?>
            <span class="ErrorMsg xalert alert-success" ><?php echo $API['M']; ?></span></p>
          <?php endif ?>
          <div class="div_input">
            <img class="img img_user" src="<?php echo BASE_URL()?>assets/login_new/images/icons/Username-01.png"/>
            <input class="input" type="text" name="sign_username" id="inputUsername" placeholder="Username" autocomplete="new-password" required/>
            <label style="width:15px"></label>
            <hr class="line"/>
            <img class="img img_pass" src="<?php echo BASE_URL()?>assets/login_new/images/icons/Password-01.png"/>
            <input class="input" type="password" name="sign_password" id="inputPassword" placeholder="Password" autocomplete="new-password" required />
            <label class="btn-show-pass" id="showpass" onClick="if (inputPassword.type == 'text') {inputPassword.type = 'password'; passIcon.className='fa fa fa-eye'}
                else {inputPassword.type = 'text';passIcon.className='fa fa fa-eye-slash'}"><i class="fa fa fa-eye" id="passIcon" ></i></label>
            <hr  class="line"/>
            <div align="left">
              <label class="form_label">
              <input  type="checkbox"><span class="form_span">Remember me</span>
              </label>
            </div>
            <div class="form_button w3-hover-gray w3-hover-border-black w3-border" onclick="btnsignin.click();">
              Login
              <button class="hide" name="btnsignin" id="btnsignin"></button>
            </div>
            <div class="form_button trans w3-hover-gray" onclick="window.open('<?php echo BASE_URL() ?>Registration/','_self');">
              Sign Up
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div align="left">
                  <label class="form_label">
                   <?php 
                        if($_SERVER['SERVER_NAME'] == 'portal.globalpinoyremittance.com/' || $_SERVER['SERVER_NAME'] == 'portal.globalpinoyremittance.com' || $_SERVER['SERVER_NAME'] == 'https://portal.globalpinoyremittance.com/' || $_SERVER['SERVER_NAME'] == 'https://portal.globalpinoyremittance.com') 
                          echo'<a href="https://support.globalpinoyremittance.com" target="GPRS Support"><label class="forgot_label text-danger">Online Support?</label></a>';
                          
                        else 
                          echo'<a href="https://support.unified.ph" target="UPS Support"><label class="forgot_label text-danger">Online Support?</label></a>';
                        ?>
                  </label>
                </div>
              </div>
              <div class="col-sm-6">
                <div align="right">
                  <label class="form_label">
                    <label class="forgot_label" href="#" data-toggle="modal" data-target="#myModal">Forgot Password?</label>
                  </label>
                </div>
              </div>
            </div>

            <div class=" w-full text-center p-t-10 p-b-0">
                  <div class="fb-login-button" data-width="25" data-max-rows="1" data-size="medium" data-button-type="login_with" 
                    scope="public_profile,email" onlogin="checkLoginState();" name="btnsigninFB" data-show-faces="false" 
                    data-auto-logout-link="false" autologoutlink="false" data-use-continue-as="true"></div>
            </div>

          </div>
        </form>
        <div class="div_term">
          <a href="https://secure.unified.ph/unified/Privacy_policy" target="Policy">Privacy Policy</a>|
          <a href="https://secure.unified.ph/unified/terms" target="Terms">Terms of Service</a>
        </div>
      </div>
      <div class="col-2 side_div">
        <div>
          <img class="side_img" src="<?php echo BASE_URL()?>assets/login_new/images/GocabLogo.jpeg"
              onclick="window.open('http://gocab.ph/','GoCab');"></br></br></br>
          <img class="side_img" src="<?php echo BASE_URL()?>assets/login_new/images/RicemartLogo.jpeg">
        </div>
      </div>
    </div>
    <div id="myModal" class="modal fade in" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="background: rgba( 255, 255, 255, .8 ) 50% 50% no-repeat;">
      <div class="modal-dialog" role="dialog" style="top: 40%;">
      <!-- Modal content-->
        <div class="modal-content">
          <form action="<?php echo BASE_URL(); ?>Login/forgot_password" method="post" id="frmforgotpassword">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Forgot Password</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12"><input type="text" name="username" class="form-control input100" placeholder="USERNAME" required /></div>
              </div>
              <br />
              <div class="row">
                <div class="col-md-12"><input type="text" name="regcode" class="form-control input100" placeholder="REGCODE"  required /></div>
              </div>
              <br />
              <div class="row">
                <div class="col-md-12"><input type="text" name="email" class="form-control input100" placeholder="EMAIL ADDRESS" required /></div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default login100-form-btn" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary login100-form-btn"  name="btnForgot">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div id="dropDownSelect1"></div>
<!--===============================================================================================-->
<!--==================================| Process is 1 |=============================================-->
<?php elseif ($process == 1): ?>
  <div class="col-md-11 ">
    <div class="col-md-5 col-md-offset-3" style="margin-top: 10%;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
                        <span class="label-input100  w-full text-center p-t-10 p-b-20"><?php echo $result['M'] ?></span>
                         <form class="form-horizontal" method="post" action="<?php echo base_url() ?>Login/" id="signin">
                              <div class="row p-t-10 p-b-20">
                                <div class="col-md-12" class="text-right">
                                <input type="hidden" class="form-control" name="regcode" id="inputRegcode" placeholder="Regcode" value="<?php echo $result['R'] ?>" readonly>
                                <button type="submit" name="btnResendCode" class="btn btn-primary col-md-5" style="line-height: 4; font-size: 12px; margin-right: 50px;"><i><u><span class="glyphicon glyphicon-phone " aria-hidden="true"></span> Resend</u></i></button> 
                                    <a href="<?php echo BASE_URL(); ?>" class="btn btn-danger col-md-5" style="line-height: 4; font-size: 12px;"><i><u><span class="glyphicon glyphicon-cancel" aria-hidden="true"></span> Dismiss</u></i></a>
                              </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>
<!--===============================================================================================-->
  <script src="<?php echo BASE_URL()?>assets/login_new/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo BASE_URL()?>assets/login_new/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo BASE_URL()?>assets/login_new/vendor/bootstrap/js/popper.js"></script>
  <script src="<?php echo BASE_URL()?>assets/login_new/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo BASE_URL()?>assets/login_new/vendor/select2/select2.min.js"></script>
  <script>
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
  </script>
<!--===============================================================================================-->
  <script src="<?php echo BASE_URL()?>assets/login_new/vendor/daterangepicker/moment.min.js"></script>
  <script src="<?php echo BASE_URL()?>assets/login_new/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo BASE_URL()?>assets/login_new/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo BASE_URL()?>assets/login_new/js/main.js"></script>
</body>