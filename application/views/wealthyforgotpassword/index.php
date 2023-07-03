<html>
  <meta content="width=device-width, initial-scale=1" name="viewport" />

  <link rel="icon" type="image/png" href="<?php echo BASE_URL()?>assets/login_new/images/Unified_Logo-01.png"/>
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL()?>assets/login_new/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL()?>assets/login_new/css/util.css">
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL()?>assets/login_new/css/main_09302021.css">
  
  <title>
    Forgot Password
  </title>

  <body>
    <div class="forgotpass-container">
      <div class="col-sm-12 col-md-8 col-lg-6 col-xl-3 forgotpass-form" align="center">
        <div style="margin-top: 20px;">
          <img src="<?php echo BASE_URL() ?>assets/login_new/images/forgotpasslogo.png" class="forgotpass-logo">
        </div>

        <div class="align-items">
          <div>
            <span class="forgotpass-lbl">
              FORGOT PASSWORD
            </span>
          </div>
          
          <?php if ($result['S'] === 0 || $result['S'] === '0'): ?>
            <div style="margin-bottom: 15px">
              <span class="ErrorMsg" style="color:red;">
                <?php echo $result['M']; ?>
              </span>
            </div>

          <?php endif ?>

          <div>
            <form action="<?php echo BASE_URL(); ?>Login/forgot_password" method="post" id="frmforgotpassword">
              <div class="row">
                <div class="col-md-12">
                  <input type="text" name="username" class="login-input" placeholder="Username" maxlength="255" required />
                </div>

                <div class="col-md-12">
                  <input type="text" name="regcode" class="login-input" placeholder="Regcode"  maxlength="255" required />
                </div>

                <div class="col-md-12">
                  <input  name="email"  class="login-input"  placeholder="Email" type="email" required />
                </div>

                <div class="col-md-12">
                  <button style = 'background-color: green; cursor:pointer' type="submit" class="login-button" style="cursor: pointer;" name="btnForgot">
                   Submit
                  </button>
                </div>

                <div class="col-md-12">
                  <button type="button" class="login-back-button" style="border-color:green; cursor: pointer; text-decoration:none;" name="btnBack" ><a href="https://wealthylifestyle.com.ph/Login">Back
                  </button></a>
                </div>
              </div>
            </form>
          </div>
        </div>
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
              <img class="footer-ads-img" src="<?php echo BASE_URL()?>assets/login_new/images/PL_FB Poster_Artboard 5 copy 2.jpg" onclick="window.open('https://www.phillands.com/','Land');">
            </div>

            <div class="col-sm-3 col-md-6 col-lg-6 col-xl-3">
              <img class="footer-ads-img" src="<?php echo BASE_URL()?>assets/login_new/images/GocabLogo.jpeg" onclick="window.open('http://gocab.ph/','GoCab');">
            </div>

            <div class="col-sm-3 col-md-6 col-lg-6 col-xl-3">
              <img class="footer-ads-img" src="<?php echo BASE_URL()?>assets/login_new/images/RicemartLogo.jpeg">
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

    <div class="message-bot-float">
      <img class="message-bot-img" src="<?php echo BASE_URL()?>assets/login_new/images/messagebot.png" />
    </div>
  </body>

  <script src="<?php echo BASE_URL()?>assets/login_new/vendor/jquery/jquery-3.2.1.min.js"></script>
  
  <script>
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
  </script>
</html>