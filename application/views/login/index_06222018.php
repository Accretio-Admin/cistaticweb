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

<style>
.mySlides {display:none}
.w3-left, .w3-right, .w3-badge {cursor:pointer}
.w3-badge {height:13px;width:13px;padding:0}
</style>


  <body class="login-body">

<!--       <section>
          <div class="row">
           
          <?php if (is_null($process)): ?>
           <div class="col-md-12">
            <div class="contentpanel" >

              <div class="col-md-7 col-md-offset-2" >
                  <?php if ($result['S'] === 0 || $result['S'] === '0'): ?>
                      <div class="alert alert-danger"><?php echo $result['M'] ?></div>
                  <?php elseif ($result['S'] === 1 || $result['S'] === '1'): ?>
                      <div class="alert alert-success"><?php echo $result['M']?><?php echo '<br> Please Log-In to continue.'?></div>
                  <?php endif ?>
                  <?php if ($API['S'] === 0 || $API['S'] === '0'): ?>
                      <div class="alert alert-danger"><?php echo $result['M'] ?></div>
                  <?php elseif ($API['S'] === 1 || $API['S'] === '1'): ?>
                      <div class="alert alert-success"><?php echo $API['M']?></div>
                  <?php endif ?>
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          <div class="row">
                              <div class="col-md-3  col-xs-12">
                                  <h4 class="text-center">Web Application</h4>
                              </div>
                              <div class="col-md-9  col-xs-12">
                                  <div class="row">
                                      <form action="<?php echo base_url() ?>Login/" method="post" id="signin">
                                          <div class="col-md-5 col-xs-12" style="padding-right:0px;">
                                              <div class="form-group">
                                                <label for="exampleInputEmail1">Username</label>
                                                <input type="text" class="form-control col-md-12" name="sign_username" id="inputUsername" placeholder="Username" required> 
                                                <p style="margin-top: 0px;"><a href="<?php echo BASE_URL() ?>Registration/"><u>Register Dealer</u></a></p>  
                                              </div>
                                          </div>
                                          <div class="col-md-5 col-xs-12" style="padding-left:0px;">
                                              <div class="form-group">
                                                <label for="exampleInputEmail1">Password</label>
                                                <input type="password" class="form-control col-md-12" name="sign_password" id="inputPassword"  placeholder="Password" required>
                                                <p><a href="#" data-toggle="modal" data-target="#myModal"><u>Forgot Password</u></a></p>
                                              </div>
                                          </div>
                                          <div class="col-md-2 col-xs-12 col-lg-2" style="padding-left:0px;">
                                              <div class="form-group">
                                                <button class="btn btn-default col-xs-12 col-md-12 col-lg-12" name="btnsignin" style="margin-top: 24px;">Login</button> 
                                                <fb:login-button scope="public_profile,email" onlogin="checkLoginState();" autologoutlink="true" name="btnsigninFB"></fb:login-button>
                                                <div id="status" style="display: none;"></div>
                                              </div>
                                          </div>
                                      </form>
                                  </div>
                              </div>

                          </div>

                    </div>
                    <div class="panel-body">
                      <iframe src="https://mobilereports.globalpinoyremittance.com/portal/bulletin/<?php echo $user['CG'] ?>" style="width:100%; height:450px;"></iframe>
                    </div>
                      
                  </div>

           
              </div>
          <?php elseif ($process == 1): ?>
           <div class="col-md-11 ">
              <div class="col-md-5 col-md-offset-3" style="margin-top: 10%;">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          <div class="row">
                              <div class="col-md-12">
                                 <p><?php echo $result['M'] ?></p>

                                  <form class="form-horizontal" method="post" action="<?php echo base_url() ?>Login/" id="signin">
                          
                                  
                                        <div class="row">
                                         
                                        <div class="col-md-12" class="text-right">
                                          <input type="hidden" class="form-control" name="regcode" id="inputRegcode" placeholder="Regcode" value="<?php echo $result['R'] ?>" readonly>
                                          <button type="submit" name="btnResendCode" class="btn btn-primary"><i><u><span class="glyphicon glyphicon-phone" aria-hidden="true"></span> Resend</u></i></button> 
                                       
                                            <a href="<?php echo BASE_URL(); ?>" class="btn btn-danger"><i><u><span class="glyphicon glyphicon-cancel" aria-hidden="true"></span> Dismiss</u></i></a>
                                        </div>
                                      </div>
                                  
                                  
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
      
          <?php endif ?>
          </div>
          


          </div>

      </section> -->
<?php if (is_null($process)): ?>
  <div class="limiter">

    <div class="container-login100">
      <div class="wrap-login100">
          <form action="<?php echo base_url() ?>Login/" method="post" id="signin" class="login100-form validate-form">
          <span class="login100-form-title p-b-114">
           <?php 
           if($_SERVER['SERVER_NAME'] == 'portal.globalpinoyremittance.com/' || $_SERVER['SERVER_NAME'] == 'portal.globalpinoyremittance.com' || $_SERVER['SERVER_NAME'] == 'https://portal.globalpinoyremittance.com/' || $_SERVER['SERVER_NAME'] == 'https://portal.globalpinoyremittance.com') {
          ?>
            <img src="<?php echo BASE_URL()?>assets/login_new/images/GPRS_LOGO.png" class="imglogo">
          <?php
           } else {
            ?>
            <img src="<?php echo BASE_URL()?>assets/login_new/images/Unified_Logo-01.png" class="imglogo">
          <?php
           }
           ?>
           <?php //echo $_SERVER['SERVER_NAME']?>
          </span>
                  <?php if ($result['S'] === 0 || $result['S'] === '0'): ?>
                  <span class="label-input100 alert alert-danger" style="color:red;"><?php echo $result['M']; ?></span>
                  <?php elseif ($result['S'] === 1 || $result['S'] === '1'): ?>
                  <span class="label-input100 alert alert-success" ><?php echo $result['M']?><?php echo '<br> Please Log-In to continue.'?></span>
                  <?php endif ?>
                  <?php if ($API['S'] === 0 || $API['S'] === '0'): ?>
                  <span class="label-input100 alert alert-danger" style="color:red;"><?php echo $API['M']; ?></span>
                  <?php elseif ($API['S'] === 1 || $API['S'] === '1'): ?>
                  <span class="label-input100 alert alert-success" ><?php echo $API['M']; ?></span>
                  <?php endif ?>
          
          <div class="wrap-input100 validate-input m-b-23 " data-validate = "Username is required">
            <span class="label-input100"></span>
            <input class="input100" type="text" name="sign_username" id="inputUsername" placeholder="Username" autocomplete="new-password" required>
            <span class="focus-input100" data-symbol="" style=""><img src="<?php echo BASE_URL()?>assets/login_new/images/icons/Username-01.png" class="img"></span>
          </div>

          <div class="wrap-input100 validate-input" data-validate="Password is required">
            <span class="label-input100"></span>
            <input class="input100" type="password" name="sign_password" id="inputPassword" placeholder="Password" autocomplete="new-password" required>

            <span class="focus-input100" data-symbol="" style=""><img src="<?php echo BASE_URL()?>assets/login_new/images/icons/Password-01.png" class="img"></span>

            <button class="btn-show-pass" style="padding-top: 15px;" id="showpass" type="button" onclick="if (inputPassword.type == 'text') inputPassword.type = 'password';
            else inputPassword.type = 'text';"><i class="fa fa fa-eye"></i></button>

          </div>

          <div class="text-right p-t-8 p-b-31">
            <a href="#">
              &nbsp;
            </a>
          </div>
          
          <div class="container-login100-form-btn">
            <button class="login100-form-btn" name="btnsignin">
              Login
            </button>
          </div>

          <div class="container-login100-form-btn w-full text-center">

            <a href="<?php echo BASE_URL() ?>Registration/" class="login100-form-btn">Register Dealer</a>
          </div>

            <div class=" w-full text-center p-t-10 p-b-0">
              <div class="fb-login-button" data-width="25" data-max-rows="1" data-size="medium" data-button-type="login_with" scope="public_profile,email" onlogin="checkLoginState();" name="btnsigninFB" data-show-faces="false" data-auto-logout-link="false" autologoutlink="true" data-use-continue-as="true"></div>
          &nbsp;
              <div class="form-group">
                <!-- <button class="btn btn-default col-xs-12 col-md-12 col-lg-12" name="btnsignin" style="margin-top: 24px;">Login</button>  -->
                <!-- <fb:login-button scope="public_profile,email" onlogin="checkLoginState();" autologoutlink="true" name="btnsigninFB"></fb:login-button> -->
                <div id="status" style="display: none;"></div>
              </div>

            </div>
            
            <div class=" w-full text-right p-t-20 p-b-10">
              <a href="#" data-toggle="modal" data-target="#myModal">
                Forgot Password ?
              </a>
            </div>



          <div class="w-full text-center p-t-15 p-b-20">
            <a href="https://upsexpress.com.ph/Unified/privacy_policy">
              Privacy Policy
            </a>
            <span>|</span>
            <a href="https://upsexpress.com.ph/Unified/terms">
              Terms of service
            </a>
          </div>



        </form>

        <!-- <div class="login100-more" style="background-image: url('<?php echo BASE_URL()?>assets/login_new/images/Landscape_GB_Ads-01.jpg');"></div> -->

      <div class="login100-more">
    <div class="w3-content w3-display-container" style="max-width:100%;">
      <!-- image size : width 1800 x height 1013 -->
      <a href="http://www.goodybox.com.ph/" target="_blank"><img class="mySlides" src="<?php echo BASE_URL()?>assets/login_new/images/Landscape_GB_Ads-01 - Copy.jpg" style="width:100%; height: 950px;"></a>
<!--       <img class="mySlides" src="<?php echo BASE_URL()?>assets/login_new/images/001.jpg" style="width:100%">
      <img class="mySlides" src="<?php echo BASE_URL()?>assets/login_new/images/002.jpg" style="width:100%"> -->
      <div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-middle" style="width:100%">
        <div class="w3-left w3-hover-text-khaki" onclick="plusDivs(-1)"><span class="fa fa-arrow-circle-o-left" style="font-size:34px"></span></div>
        <div class="w3-right w3-hover-text-khaki" onclick="plusDivs(1)"><span class="fa fa-arrow-circle-o-right" style="font-size:34px"></span></div></div>
      </div>
    </div>
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

  </div>

  <div id="dropDownSelect1"></div>

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
  </script>
<!--===============================================================================================-->
  <script src="<?php echo BASE_URL()?>assets/login_new/vendor/daterangepicker/moment.min.js"></script>
  <script src="<?php echo BASE_URL()?>assets/login_new/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo BASE_URL()?>assets/login_new/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo BASE_URL()?>assets/login_new/js/main.js"></script>


<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  if (n > x.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
     dots[i].className = dots[i].className.replace(" w3-white", "");
  }
  x[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " w3-white";
}
</script>

<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 5000); // Change image every 2 seconds
}
</script>
  
<script type="text/javascript">
      /*==================================================================
    [ Show pass ]*/
    var showPass = 0;
    $('.btn-show-pass').on('click', function(){
        if(showPass == 0) {
            $(this).find('i').removeClass('fa-eye');
            $(this).find('i').addClass('fa-eye-slash');
            showPass = 1;
        }
        else {
            $(this).find('i').removeClass('fa-eye-slash');
            $(this).find('i').addClass('fa-eye');
            showPass = 0;
        }
        
    });
</script>

</body>
