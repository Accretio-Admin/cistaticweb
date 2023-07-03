<!-- // Password Requirement Plugin -->
<link href="<?php echo BASE_URL()?>assets/css/jquery.passwordRequirements.css" rel="stylesheet" />
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="<?php echo BASE_URL()?>assets/js/jquery.passwordRequirements.min.js"></script>
<script>
    $(document).ready(function() {
        $("form").bind("keypress", function(e) {
            if (e.keyCode == 13) {
                return false;
            }
        });
    });
    </script>
<style>
        .tel-code{
        font-size: 20px;
        font-weight: 500;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 99px;
        height: 56px;
        background: #F4F4F4;
        border-radius: 10px;
    }
        .steps-nav{
            display: flex;
            justify-content: space-between;
            align-items: center;
            width:910px;
            height: 42px;
            margin: 5em 5em 2em 5em;
        }
        .step-status-bar{
            content: '';
            height: 10px;
            width: 140px;
            border-radius: 10px;
            background: #EAEAEA;
        }
        
        .step-prev{
            background-color: white;
            border: none;
            width: 50px;
            height: 42px;
        }
        .step-progress-num{
            font-weight: 600;
            font-size: 17px;
        }


        /* The container */
        .container1 {
        display: block;
        position: relative;
        padding-left: 20px;
        
        cursor: pointer;
        font-weight: 400;
        font-size: 12px;
        border-radius: 4.15385px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        }

        /* Hide the browser's default checkbox */
        .container1 input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
        }

        /* Create a custom checkbox */
        .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 18px;
        width: 18px;
        border-radius: 4.15385px;
        background-color: #eee;
        }

        /* On mouse-over, add a grey background color */
        .container1:hover input ~ .checkmark {
        background-color: #ccc;
        border-radius: 4.15385px;
        }

        /* When the checkbox is checked, add a yellow background */
        .container1 input:checked ~ .checkmark {
            background: #FFC914;
            border-radius: 4.15385px;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
        content: "";
        position: absolute;
        display: none;
        }

        /* Show the checkmark when checked */
        .container1 input:checked ~ .checkmark:after {
        display: block;
        }

        /* Style the checkmark/indicator */
        .container1 .checkmark:after {
        left: 7px;
        top: 3px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
        }

        /*loading screen css*/
        @keyframes rotate {
            from { transform: rotate(0deg);   }
            to   { transform: rotate(360deg); }
        }

        .spinner {
            animation: rotate 1s linear infinite;
            background: #FFB800;
            border-radius: 50%;
            height: 36px;
            width: 36px;
            position: relative;
        }

        .spinner::before,
        .spinner::after {
            content: '';
            position: absolute;
        }

        .spinner::before {
            border-radius: 50%;
            background:
                linear-gradient(0deg,   hsla(0, 0%, 100%, 1  ) 50%, hsla(0, 0%, 100%, 0.9) 100%)   0%   0%,
                linear-gradient(90deg,  hsla(0, 0%, 100%, 0.9)  0%, hsla(0, 0%, 100%, 0.6) 100%) 100%   0%,
                linear-gradient(180deg, hsla(0, 0%, 100%, 0.6)  0%, hsla(0, 0%, 100%, 0.3) 100%) 100% 100%,
                linear-gradient(360deg, hsla(0, 0%, 100%, 0.3)  0%, hsla(0, 0%, 100%, 0  ) 100%)   0% 100%
            ;
            background-repeat: no-repeat;
            background-size: 50% 50%;
            top: -1px;
            bottom: -1px;
            left: -1px;
            right: -1px;
        }

        .spinner::after {
            background: white;
            border-radius: 50%;
            top: 18%;
            bottom: 18%;
            left: 18%;
            right: 18%;
        }
        
        
        .loader-txt{
            margin-left: 10px;
            width: 270px;;
            height: 36px;
            display: flex;
            flex-direction: column;
            justify-content: left;
            align-items: center;
            overflow: hidden;
        }

        .loader-item{
        
            width: 100%;
            line-height: 36px;
            font-style: normal;
            font-weight: 600;
            font-size: 20px;
            text-align: left;
            animation: txt 3s linear infinite;
            
        }

        @keyframes txt {
            0% {
            transform: translateY(0);
            }
            10%{
                transform: translateY(0);
            }
            20%{
                transform: translateY(0);
            }
            30%{
                transform: translateY(0);
            }
            40%{
                transform: translateY(-35px);
            }
            50%{
                transform: translateY(-35px);
            }
            60%{
                transform: translateY(-35px);
            }
            70%{
                transform: translateY(-35px);
            }
            80%{
                transform: translateY(-73px);
            }
            90%{
                transform: translateY(-73px);
            }
            100% {
            transform: translateY(-73px);
            }
        }
        .img-success{
            width: 350.79px;
            height: 298.65px;
        }

        .ups-btn{
            height: 56px;
            width: 322px;
            border-radius: 12px !important;
            padding: 8px 40px 8px 40px !important;
            border:none !important;
        }

        .ups-input{
        
            letter-spacing: 0px;
           
        }
        
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        /* Select CSS */
        /*the container must be positioned relative:*/
        .ups-select {
            position: relative;
            width: 360px;
            height: 56px;
            border-radius:10px;
            background-color: #F4F4F4;
            color: black;
        }
        .ups-select select {
        display: none; /*hide original SELECT element:*/
        }

        .select-selected{
            width: 360px;
            height: 56px;
            border-radius:10px; 
            color: black !important;
            font-size: 13px;
            font-weight: 500;
            padding-top: 18px !important;
        }

        /*style the arrow inside the select element:*/
        .select-selected:after {
        position: absolute;
        content: "";
        top: 25px;
        right: 25px;
        width: 0;
        height: 0;
        border: 6px solid transparent;
        border-color: black transparent transparent transparent;
        }

        /*point the arrow upwards when the select box is open (active):*/
        .select-selected.select-arrow-active:after {
        border-color: transparent transparent black transparent;
        top: 23px;
        }

        /*style the items (options), including the selected item:*/
        .select-items div,.select-selected {
        color: black;
        padding: 8px 16px;
        border: 1px solid transparent;
        border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
        cursor: pointer;
        user-select: none;
        }

        /*style items (options):*/
        .select-items {
        position: absolute;
        background-color: #FFC914;
        top: 100%;
        left: 0;
        right: 0;
        z-index: 99;
        }

        /*hide the items when the select box is closed:*/
        .select-hide {
        display: none;
        }

        .select-items div:hover, .same-as-selected {
        background-color: rgba(0, 0, 0, 0.1);
        }

        
        .field-view::before{
     
            content: attr(data-content);
            position:absolute;
            display: flex;
            justify-content: center;
            align-items: center;
        
            
            font-size: 12px;
            color: white;
        
            padding: 5px 7px;
            background-color: #FFB800;
            border-radius: 4px;
            top: -11px;
            left: 15px;
        }

        .pass-match{
            width: 16px;
            height: 16px;
            transform: translate(150px, -58px) 
        }

        .not-match{
            width: 16px;
            height: 16px;
            transform: translate(150px, -58px) 
        }


        .Tpass-match{
            width: 16px;
            height: 16px;
            transform: translate(150px, -58px) 
        }

        .Tnot-match{
            width: 16px;
            height: 16px;
            transform: translate(150px, -58px) 
        }

        .error{
            color: red;
            font-size:16px;
            font-weight: 500px;
        }
        .btn-step[disabled]{
            background-color: #cccccc;
            color: #666666
        }
        .ups-input-text[disabled]{
            color: #666666
        }
        .btnCode[disabled]{
            color: #666666
        }
</style>
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

<div id="yellowbar">   
</div>

<div id="field-view-tag">
</div>

<body class="font-poppins">
<!-- SUCCESS <?php echo print_r($result['S'], true)?>
MALFUNC <?php echo print_r($result['M'], true)?> -->
<?php if ($result['S'] == 1) { ?>
    <!-- success screen -->
    <div class="container col flex-center" style="margin-top: 10em; animation: fadeIn 3s;" id="success-screen">
            <h1 class="ups-h1" style="margin-right: 10px; font-weight: 600;">Wow! Your <span class="ups-h1 ups-txt-yellow" style="margin-right: 10px;">UPS</span>account has </h1>
            <h1 class="ups-h1 mb-1" style="font-weight: 600;">been successfully created!</h1>
            <h2 class="ups-h2 mb-4" style="font-size: 16px;">Thanks for that, now you’re all set.</h2>
            <img src="<?php echo BASE_URL()?>assets/images/logos/success.png" alt="" srcset="" class='img-success'/>
            <button class="ups-btn btn-dark mt-5" style="font-size: 16px; font-weight: 500;" onclick="window.open('<?php echo BASE_URL() ?>Login','_self');">Proceed to account login</button>
     </div>
<?php } else if ($result['S'] === 0) { ?>
    <!-- failed screen -->
    <div class="container col flex-center" style="margin-top: 10em; animation: fadeIn 3s;" id="failed-screen">
            <h1 class="ups-h1" style="margin-right: 10px; font-weight: 600;">Sorry... Your <span class="ups-h1 ups-txt-yellow" style="margin-right: 10px;">UPS</span>account has </h1>
            <h1 class="ups-h1 mb-1" style="font-weight: 600;">not been created!</h1>
            <b>-<?php echo print_r($result['M'], true) ?></b>
            <button class="ups-btn btn-dark mt-5" style="font-size: 16px; font-weight: 500;" onclick="window.open('<?php echo BASE_URL() ?>Login','_self');">Proceed to account login</button>
    </div>
<?php } else if ($result['M'] == null && $result['S'] == null) { ?>
    <form action="<?php echo BASE_URL() ?>Registration/" method="post" id="frmRegistrationNew">
        <div class="container flex-center">
            <div class="steps-nav">
                <button class="step-prev"><img src="<?php echo BASE_URL()?>assets/icon/prev.png" alt="" srcset="" id="prev-btn"></button>
                <div class="step-status-bar">
                </div>
                <span class="step-progress-num"> <span id="step">1</span> | 7</span>
            </div>   
        </div>
        <div class="container form-div form-active" id="step1">
            <div class="container">
                <h1 class="ups-h1 txt-center ups-txt-dark">Authentication via</h1>
                <h1 class="ups-h1 txt-center ups-txt-yellow">One-Time-Password</h1>
            </div>

            <div class="container col flex-center mt-2">
                <label for="" class="ups-input-label">Enter your mobile number</label>
                <div class="ups-input-field flex-center row mt-1">
                    <div class="tel-code"><img src="<?php echo BASE_URL()?>assets/icon/philippines.png" alt="" srcset="">+63</div>
                    <input type="text" class="ups-input Mobile ms-1" name="country" value="639" hidden>
                    <input type="text" class="ups-input Mobile ms-1" name="inputPinemail" value="2441" hidden>
                    <input type="text" class="ups-input Mobile ms-1" placeholder="Enter mobile" name="inputMobileNo" minlength="10" maxlength="10" id="regMobile" onkeypress="return /[0-9]/i.test(event.key)" required>
                </div>
                <span id="message-regMobile" class="error"></span>
                <label for="" class="ups-input-label mt-3">Enter OTP (One Time Password) code</label>
                <div class="ups-input-field flex-center row mt-1">
                    <input type="text" class="ups-input" placeholder="------" style="width: 321px;" name="inputPinmobile" id="inputPinmobile" minlength="6" maxlength="6" onkeypress="return /[0-9]/i.test(event.key)" required>
                    <span id="MobPinloading" class="glyphicon glyphicon-refresh glyphicon-refresh-animate" aria-hidden="true" ></span>
                </div>
                <span id="message-inputPinmobile" class="error"></span>
            
                <button type="button" class="btn-link ups-txt-blue mt-1 btnCode" id="btnmobSend" disabled>Get Code</button>
                <small class="pleaseWait1" style="float:right;display:none;">Sending One-Time PIN...</small>
                <!-- <div class="container flex-center row">
                    <button class="btn-link mt-5">Use my email instead <img class="ms-1"src="./next.png" alt="" srcset=""></button>
                </div> -->
                <button type="button" class="ups-btn btn-yellow mt-1 btn-step" style="font-size: 20px; font-weight: 600;"  name="btnStep2" id="btnStep1" disabled>Proceed</button>
                <br></br>
                <div id="infos" class="alert alert-info" style="display:none"></div>
                <div id="errors" class="alert alert-danger" style="display:none"></div>
                <div id="back" class="alert alert-danger" style="display:none;text-align: center">
                    Oops! You have reached your maximum attempts, Please try again after 10 minutes. Thank you!
                    <a href="<?php echo BASE_URL() ?>Login/" class="btn btn-danger">OK</a>
                </div>
            </div>
        </div>
    

        <div class="container form-div" id="step2">
            <div class="container">
                <h1 class="ups-h1 txt-center ups-txt-dark">Registration Activation</h1>
            </div>

            <div class="container col flex-center">
            <label for="" class="ups-input-label  mt-2" style="text-align: left; width: 360px;">Registration Code</label>
            <input type="text" class="ups-input-text" placeholder="Enter Regcode" style="width: 360px; text-align: center;" onkeypress="return /[a-zA-Z0-9]/i.test(event.key)" name="inputRegcode" id="inputRegcode" required>
           
            <span class="me-1" id="regcodeLoading" style="display: none;"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate" aria-hidden="true" ></span> Loading...</span>
            
            <span id="message-inputRegcode" class="error"></span>
            <label for="" class="ups-input-label  mt-1" style="text-align: left; width: 360px;">PIN</label>
            <input type="password" class="ups-input-text2" placeholder="Enter PIN" style="width: 360px; text-align: center;" onkeypress="return /[a-zA-Z0-9]/i.test(event.key)" name="inputPIN" id="inputPIN" required>
            <span id="message-inputPIN" class="error"></span>
            <button type="button"class="continue ups-btn btn-yellow mt-5 mb-4 btn-step" style="font-size: 20px; font-weight: 600;" name="btnStep2" id="btnStep2" >Continue</button>
            </div>
        </div>

        <div class="container form-div" id="step3">
            <div class="container row">
                <h1 class="ups-h1 txt-center ups-txt-dark">Fill up your</h1>
                <h1 class="ups-h1 txt-center ups-txt-yellow">Information</h1>
            </div>

            <div class="container col flex-center mt-2">
                <label for="" class="ups-input-label" style="text-align: left; width: 360px;" >First Name</label>
                <input type="text" name="inputFN" class="ups-input-text mt-1" placeholder="Enter First Name" oninput="this.value = this.value.toUpperCase()" style="width: 360px; text-align: left;" id="fname" onkeypress="return isLetterKey(event)" required>
                <span id="message-fname" class="error"></span>

                <div class="container row flex-center  mt-2">
                    <label for="" class="ups-input-label me-4" style="text-align: left; width: px;" >Middle Name</label>
                    <label class="container1">I don’t have a middle name
                        <input type="checkbox" id="mnCheckbox">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <input type="text" name="inputMD" class="ups-input-text mt-1" placeholder="Enter Middle Name" oninput="this.value = this.value.toUpperCase()" style="width: 360px; text-align: left;" id="mname" onkeypress="return isLetterKey(event)">
                <span id="message-mname" class="error"></span>

                <label for="" class="ups-input-label  mt-2" style="text-align: left; width: 360px;">Last Name</label>
                <input type="text" name="inputLN" class="ups-input-text mt-1" placeholder="Enter Last Name" oninput="this.value = this.value.toUpperCase()" style="width: 360px; text-align: left;" id="lname" onkeypress="return isLetterKey(event)"required>
                <span id="message-lname" class="error"></span>

                <label for="" class="ups-input-label  mt-2" style="text-align: left; width: 360px;" >Username</label>
                <input type="text" name="inputUsername" class="ups-input-text  mt-1" placeholder="Enter Username" style="width: 360px; text-align: left;" onkeypress="return validateKeypress(alphanumeric)"  id="uname" required>
                <span id="message-uname" class="error"></span>

                <label for="" class="ups-input-label  mt-2" style="text-align: left; width: 360px;" >Birthdate</label>
                <input type="date" name="inputBirthday" class="ups-input-text  mt-1" onkeydown="return false" placeholder="" style="width: 360px; text-align: left; padding-right: 1em;" id="bday" required>
                <span id="message-bday" class="error"></span>

                <label for="" class="ups-input-label  mt-2" style="text-align: left; width: 360px;" >Address</label>
                <input type="text" name="inputAddress" id="inputAddress" class="ups-input-text  mt-1" placeholder="Enter Address" style="width: 360px; text-align: left; padding-right: 1em;"  required>
                <span id="message-inputAddress" class="error"></span>

                <label for="" class="ups-input-label  mt-2" style="text-align: left; width: 360px;" >ZIP Code</label>
                <input type="text" name="inputZipcode" id="inputZipcode" class="ups-input-text  mt-1" placeholder="Enter ZIP Code" style="width: 360px; text-align: left; padding-right: 1em;"  required>
                <span id="message-inputAddress" class="error"></span>
                <!-- <textarea name="" id="inputAddress" cols="30" rows="10" class="ups-textarea mt-1">Philippines</textarea> -->
                
                <label for="" class="ups-input-label  mt-2" style="text-align: left; width: 360px;" >Email</label>
                <input type="email" name="inputEmail" class="ups-input-text  mt-1" placeholder="Enter Email" style="width: 360px; text-align: left;" id="email" required>
                <span id="message-email" class="error"></span>

                <button type="button" class="continue ups-btn btn-yellow mt-5 mb-4 btn-step" style="font-size: 20px; font-weight: 600;" id="step3-con">Continue</button>
            </div>
        </div>

        <div class="container form-div" id="step4">
            <div class="container flex-center">
            <h1 class="ups-h1 txt-center ups-txt-dark" style="margin-right: 0.4em;">Set up your <h1 class="ups-h1 txt-center ups-txt-yellow"> Passwords</h1></h1>
            </div>

            <div class="container col flex-center mt-2">
                <label for="" class="ups-input-label" style="text-align: left; width: 360px;">Create Password</label>
                <input type="password" name="inputPassword" id="pass1" class="ups-input-text mt-1 pr-password" onkeypress="return validateKeypress(whitespace)" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*?[#?!@$%^&*-]).{8,}" maxlength="25" style="width: 360px; text-align: left; margin-top: 10px; padding: 0px 10px" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*?[#?!@$%^&*-]).{8,}" required>
                <span id="message-pass1" class="error"></span>

                <label for="" class="ups-input-label" style="text-align: left; width: 360px; margin-top: 10px">Confirm Password</label>
                <input type="password" name="inputCP" id="pass2" class="ups-input-text mt-1 pr-password" maxlength="25"  onkeypress="return validateKeypress(whitespace)" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*?[#?!@$%^&*-]).{8,}" style="width: 360px; text-align: left; margin-top: 10px; padding: 0px 10px" onkeyup="checkPass1(); checkMatch();" required>
                <span id="confirmMessage"></span>
                <span id="message-pass2" class="error"></span>
                
                <span class="pass-match"><img src="<?php echo BASE_URL()?>assets/icon/correct.png" alt="" srcset=""></span>
                <span class="not-match"><img src="<?php echo BASE_URL()?>assets/icon/error.png" alt="" srcset=""></span>
                <label for="" class="ups-input-label" style="text-align: left; width: 360px; margin-top: 10px">Transaction Password</label>
                <input type="password" name="inputTpass" id="tpass1" class="ups-input-text mt-1 pr-password" onkeypress="return validateKeypress(whitespace)" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*?[#?!@$%^&*-]).{8,}" maxlength="25" id="trans-pass" maxlength="25" style="width: 360px; text-align: left; margin-top: 10px; padding: 0px 10px" required>
                <span id="message-tpass1" class="error"></span>

                <label for="" class="ups-input-label" style="text-align: left; width: 360px; margin-top: 10px">Confirm Transaction Password</label>
                <input type="password" name="inputCTpass" id="tpass2" class="ups-input-text mt-1 pr-password" onkeypress="return validateKeypress(whitespace)" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*?[#?!@$%^&*-]).{8,}" maxlength="25" id="confirm-trans-pass" maxlength="25" style="width: 360px; text-align: left; margin-top: 10px; padding: 0px 10px" onkeyup="checkTPass1(); checkMatch();" required>
                <span id="confirmMessageT"></span>
                <span id="message-tpass2" class="error"></span>

                <span class="Tpass-match"><img src="<?php echo BASE_URL()?>assets/icon/correct.png" alt="" srcset=""></span>
                <span class="Tnot-match"><img src="<?php echo BASE_URL()?>assets/icon/error.png" alt="" srcset=""></span>

                <button type="button" class="continue ups-btn btn-yellow mt-5 mb-4 btn-step" style="font-size: 20px; font-weight: 600;" id="btnStep4">Continue</button>
            </div>
        </div>

        <div class="container form-div" id="step5">
            <div class="container col flex-center">
            <h1 class="ups-h1 txt-center ups-txt-dark" style="margin-right: 0.4em;">Input your <span class="ups-h1 txt-center ups-txt-yellow">network</span></h1>
            <h1 class="ups-h1 ups-txt-dark">details</h1>
            </div>
            
            <div class="container flex-center col">
                <label for="" class="ups-input-label mt-2" style="text-align: left; width: 360px;">Direct Referal RC</label>
                <input type="text" name="inputDirectReferralRC" class="ups-input-text" style="width: 360px; text-align: left; margin-top: 10px; padding: 0px 10px" onkeypress="return /[a-zA-Z0-9]/i.test(event.key)" id="inputDirectReferralRC" required>
                <span id="message-inputDirectReferralRC" class="error"></span>

                <label for="" class="ups-input-label mt-1" style="text-align: left; width: 360px;">Placement</label>
                <input type="text"  name="inputPlacement" id="placement" class="ups-input-text" style="width: 360px; text-align: left; margin-top: 10px; padding: 0px 10px" required>
                <span id="message-placement" class="error"></span>

                <label for="" class="ups-input-label mt-1" style="text-align: left; width: 360px;">Position</label>
                <div class="container row flex-center ">
                        <label class="ups-radio-container me-3">Left
                            <input type="radio" name="inputPosition" id="left" value="left" checked="checked" required>
                            <span class="radiomark"></span>
                        </label>
                        <label class="ups-radio-container">Right
                            <input type="radio" name="inputPosition" id="right" value="right" required>
                            <span class="radiomark"></span>
                        </label>
                </div>

                <button type="button" class="continue ups-btn btn-yellow mb-1 btn-step" style="font-size: 20px; font-weight: 600; margin-top: 11em" id="">Confirm</button>
            </div>
        
        </div>

        <div class="container form-div" id="step6">
            <div class="container col flex-center">
            <h1 class="ups-h1 txt-center ups-txt-dark">Additional Information</h1>
            </div>
            
            <div class="container flex-center col">
                <label for="" class="ups-input-label mt-2" style="text-align: left; width: 360px;">AR/OR Tracking Number</label>
                <input type="text" name="inputTN" class="ups-input-text" onkeypress="return /[0-9]/i.test(event.key)" style="width: 360px; text-align: left; margin-top: 10px; padding: 0px 10px" id="inputTN"required>
                <span id="message-inputTN" class="error"></span>
                <label for="" class="ups-input-label mt-1" style="text-align: left; width: 360px;">Security Question</label>

                <div class="ups-select">
                    <select  name="selSecurity" id="selSecurity"  required>
                        <!-- <option  value="" disabled selected><p style="margin:0px">-- Security Question --</p></option>   -->
                        <option  value="1" selected><p style="margin:0px">What is the name of your favorite pet?</p></option>
                        <option  value="2"><p style="margin:0px">What is your monther's maiden name</p></option>
                        <option  value="3"><p style="margin:0px">Who was your first teacher?</p></option>
                        <option  value="4"><p style="margin:0px">When is your wedding anniversary?</p></option>
                        <option  value="5"><p style="margin:0px">Who is your favorite uncle?</p></option>
                        <option  value="6"><p style="margin:0px">Who is your favorite auntie?</p></option>
                        <option  value="7"><p style="margin:0px">Who is your favorite author?</p></option>
                    </select>
                </div>
                
                <label for="" class="ups-input-label mt-1" style="text-align: left; width: 360px;">Answer</label>
                <input type="text" name="inputAnswer" class="ups-input-text" style="width: 360px; text-align: left; margin-top: 10px; padding: 0px 10px" onkeypress="return /[a-zA-Z0-9]/i.test(event.key)" id="inputAnswer" required>
                <span id="message-inputAnswer" class="error"></span>

                <button type="button" class="continue ups-btn btn-yellow mb-1 btn-step" style="font-size: 20px; font-weight: 600; margin-top: 11em" id="view-details-btn">Confirm</button>
            </div>
        </div>

        <div class="container form-div" id="step7">
            <div class="container flex-center">
                <h1 class="ups-h1 txt-center ups-txt-dark" style="margin-right: 0.4em;">Review your <h1 class="ups-h1 txt-center ups-txt-yellow"> details</h1></h1>
            </div>

            <div class="container flex-center col">
                <div class="field-view mt-3" id="f1"></div>
                <span  style="text-align: center; align-self: center; margin-bottom: 15px;"></span>
                <div class="field-view" id="f2"></div>
                <div class="field-view" id="f3"></div>
                <div class="field-view" id="f4"></div>
                <div class="field-view" id="f5"></div>
                <div class="field-view" id="f6"></div>
                <div class="field-view" id="f7"></div>
                <hr class="divider" />

                <label for="" class="ups-input-label mt-1" style="text-align: left; width: 360px;">Referral Code (Optional)</label>
                <input type="text" class="ups-input-text mb-2" maxlength="6" onkeypress="return /[0-9]/i.test(event.key)" style="width: 360px; text-align: left; margin-top: 10px;">

                <button type="submit" name="btnRegister" class="continue ups-btn btn-yellow mb-2 btn-step" style="font-size: 20px; font-weight: 600;" >Create Dealer Account</button>
            </div>
        </div>
    </form>
<?php } ?>
    
    <!-- loading -->
    <div class="container flex-center" style="margin-top: 20em;" id="loader">
        <div class="spinner"></div>
        <div class='loader-txt'>
            <span class="loader-item">Validating your details...</span>
            <span class="loader-item">Creating your account...</span>
            <span class="loader-item">Finishing up...</span>
        </div>
    </div>

    <div class="hidRegMobile" style="display:none" >
    		<form id="frmMobRegNew" method="post">
    				<input class="hiddenMob" type="text" name ="regMob" />
    				<button type="submit" id="btnMobReg" style="display:none"></button>
    		</form>
    </div>
    <div class="hidRegCode" style="display:none" >
    		<form id="frmRegCode" method="post">
                     <input id="hiddenRegcode" type="text" name ="regCode" />
    				<button type="submit" id="btnRegCode" style="display:none"></button>
    		</form>
    </div>
    <div class="hidRegMobile" style="display:none" >
    		<form id="frmMobpinRegNew" method="post">
    				<input class="hiddenMobpin" type="text" name ="regMobpin_new" />
    				<input class="hiddenMobs" type="text" name ="regMobforpin" />
    				<button type="submit" id="btnMobpinReg" style="display:none"></button>
    		</form>
    </div>
    <div style="display:none" >
    		<form id="frmEReg" method="post">
    				<input class="hiddenE" type="text" name ="regE" />
    				<button type="submit" id="btnEReg" style="display:none"></button>
    		</form>
    </div>
    <div style="display:none" >
    		<form id="frmEpinReg" method="post">
    				<input class="hiddenEpin" type="text" name ="regEpin" />
    				<input class="hiddenEpins" type="text" name ="regEforpin" />
    				<button type="submit" id="btnEpinReg" style="display:none"></button>
    		</form>
    </div>
</body>

<script>
    $('#inputRegcode').keyup(function(){
       $('#hiddenRegcode').val($(this).val())
       $('#btnRegCode').click()
    })
   
   
    function inputNum(){
        var numTest = /^[9]\d{9}$/gm;
        var numVal = $(this).val()
        if(numTest.test(numVal)){
            // console.log(numVal)
            $('#btnmobSend').prop('disabled', false)
            console.log('num matched')
        }
        else{
            // console.log(numVal)
            $('#btnmobSend').prop('disabled', true)
            console.log('not matched')
        }
     }
     
    
    function disableBtn2(){
       var pass = $(this).val();
        if(/\d/.test(pass) && /[a-z]/.test(pass) && /[A-Z]/.test(pass) && /[#?!@$%^&*-]/.test(pass) && /\S{8,}/.test(pass)){
            $('#btnStep4').prop('disabled', false)
        }
        else{
            $('#btnStep4').prop('disabled', true)
        }
    }
    function disableBtn(){
        if($('#pass1').val() != $('#pass2').val() || $('#tpass1').val() != $('#tpass2').val()){
         $('#btnStep4').prop('disabled', true)
        }
        else{
            $('#btnStep4').prop('disabled', false)
        }
    }
    $('#regMobile').keyup(inputNum)
    $('#pass1').keyup(disableBtn, disableBtn2)
    $('#pass2').keyup(disableBtn, disableBtn2)
    $('#tpass1').keyup(disableBtn, disableBtn2)
    $('#tpass2').keyup(disableBtn, disableBtn2)

    
    var main_div= $('.form-div')
    $('.pass-match').hide()
    $('.not-match').hide()
    $('.Tpass-match').hide()
    $('.Tnot-match').hide()
    let num = 1
    if(num == 1){
        console.log(num)
        $('#prev-btn').hide()
        $('#step').text('1')
        $('#step1').show()
        $('#step2').hide()
        $('#step3').hide()
        $('#step4').hide()
        $('#step5').hide()
        $('#step6').hide()
        $('#step7').hide()
        $('#loader').hide()
        $('#success-screen').hide()
        $('#yellowbar').append(`
        <style>
        .step-status-bar::before{
        display: block;
        content: '';
        position: relative;
        top: 0;
        left: 0;
        content: '';
        height: 10px;
        width: 20px;
        border-radius: 10px;
        background: #FFC914;
        }
        </style>`);
    }
    function steps(){
        if(num == 2){
            $('#prev-btn').show()
            $('#step').text('2')
            $('#step1').hide()
            $('#step2').show()
            $('#step2').addClass('form-active')
            $('#step3').hide()
            $('#step4').hide()
            $('#step5').hide()
            $('#step6').hide()
            $('#step7').hide()
            $('#loader').hide()
            $('#success-screen').hide()
            $('#yellowbar').append(`
            <style>
            .step-status-bar::before{
            display: block;
            content: '';
            position: relative;
            top: 0;
            left: 0;
            content: '';
            height: 10px;
            width: 40px;
            border-radius: 10px;
            background: #FFC914;
            }
            </style>`);
            
        }
        if(num == 3){
            $('#prev-btn').show()
            $('#step').text('3')
            $('#step1').hide()
            $('#step2').hide()
            $('#step3').show()
            $('#step3').addClass('form-active')
            $('#step4').hide()
            $('#step5').hide()
            $('#step6').hide()
            $('#step7').hide()
            $('#loader').hide()
            $('#success-screen').hide()
            $('#yellowbar').append(`
            <style>
            .step-status-bar::before{
            display: block;
            content: '';
            position: relative;
            top: 0;
            left: 0;
            content: '';
            height: 10px;
            width: 60px;
            border-radius: 10px;
            background: #FFC914;
            }
            </style>`);
        }
        if(num == 4){
            $('#prev-btn').show()
            $('#step').text('4')
            $('#step1').hide()
            $('#step2').hide()
            $('#step3').hide()
            $('#step4').show()
            $('#step4').addClass('form-active')
            $('#step5').hide()
            $('#step6').hide()
            $('#step7').hide()
            $('#loader').hide()
            $('#success-screen').hide()
            $('#yellowbar').append(`
            <style>
            .step-status-bar::before{
            display: block;
            content: '';
            position: relative;
            top: 0;
            left: 0;
            content: '';
            height: 10px;
            width: 80px;
            border-radius: 10px;
            background: #FFC914;
            }
            </style>`);
        }
        if(num == 5){
            $('#prev-btn').show()
            $('#step').text('5')
            $('#success-screen').hide()
            $('#step1').hide()
            $('#step2').hide()
            $('#step3').hide()
            $('#step4').hide()
            $('#step5').show()
            $('#step5').addClass('form-active')
            $('#step6').hide()
            $('#step7').hide()
            $('#loader').hide()
            $('#yellowbar').append(`
            <style>
            .step-status-bar::before{
            display: block;
            content: '';
            position: relative;
            top: 0;
            left: 0;
            content: '';
            height: 10px;
            width: 100px;
            border-radius: 10px;
            background: #FFC914;
            }
            </style>`);
            
        }
        if(num == 6){
            $('#prev-btn').show()
            $('#step').text('6')
            $('#success-screen').hide()
            $('#step1').hide()
            $('#step2').hide()
            $('#step3').hide()
            $('#step4').hide()
            $('#step5').hide()
            $('#step6').show()
            $('#step6').addClass('form-active')
            $('#step7').hide()
            $('#loader').hide()
            $('#yellowbar').append(`
            <style>
            .step-status-bar::before{
            display: block;
            content: '';
            position: relative;
            top: 0;
            left: 0;
            content: '';
            height: 10px;
            width: 120px;
            border-radius: 10px;
            background: #FFC914;
            }
            </style>`);
            $('#view-details-btn').click(handleView())
        }
        if(num == 7){
            $('#prev-btn').show()
            $('#step').text('7')
            $('#success-screen').hide()
            $('#step1').hide()
            $('#step2').hide()
            $('#step3').hide()
            $('#step4').hide()
            $('#step5').hide()
            $('#step6').hide()
            $('#step7').show()
            $('#step7').addClass('form-active')
            $('#loader').hide()
            $('#yellowbar').append(`
            <style>
            .step-status-bar::before{
            display: block;
            content: '';
            position: relative;
            top: 0;
            left: 0;
            content: '';
            height: 10px;
            width: 140px;
            border-radius: 10px;
            background: #FFC914;
            }
            </style>`);
        }
        if(num == 8){
            $('.steps-nav').hide()
            $('#success-screen').hide()
            $('#step1').hide()
            $('#step2').hide()
            $('#step3').hide()
            $('#step4').hide()
            $('#step5').hide()
            $('#step6').hide()
            $('#step7').hide()
            $('#loader').show()
            setTimeout(() => {
                $('#loader').hide()
                $('#success-screen').show()
            }, 3000)
        }
    }
    
    function isNumberKey(evt){ 
    //var e = evt || window.event;
	var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode != 46 && charCode > 31 
	&& (charCode < 48 || charCode > 57))
        return false;
        return true;
	}

    function isLetterKey(evt){
        var keyCode = (evt.which) ? evt.which : evt.keyCode
        if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)
         
        return false;
            return true;
    }

var alpha = /[ A-Za-z]/;
var whitespace = /[\S]$/; 
var alphanumeric = /^[A-Za-z0-9_~\-!@#\$%\^&*\(\)]+$/;


function validateKeypress(validChars) {
    var keyChar = String.fromCharCode(event.which || event.keyCode);
    return validChars.test(keyChar) ? keyChar : false;
}



    function validate_form(){
        var validate=true;
        $('.form-div.form-active input').each(function(inpt){ 
           if($(this).attr('required')){
                if($(this).val().length === 0){
                    validate=false;
                    $('#message-' + $(this).attr('id')).text("This field should not be empty!")
                    swal({
                        title: 'Blank fields detected!',
                        text: "Please fill-in required fields.",
                        icon: 'warning',
                        buttons: false,
                    })
                }
                 else {
                    $('#message-' + $(this).attr('id')).text("")
                }
           }
        })
        return validate;
    }

  
    $('#email').keyup(function(){
        var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        if(!testEmail.test($('#email').val())){
            $('#step3-con').prop('disabled', true)
        }
        else{
            $('#step3-con').prop('disabled', false)
        }
      })

    $('.btn-step').click(function(){
        if(!validate_form()){
            return false;
        }
        num = num + 1 ;
        main_div.each(function(forms){
        $(this).removeClass('form-active');
        });
        steps();
    })
    
    $('.step-prev').click(function(){
         num = num - 1  
        if(num == 1){
            $('#prev-btn').hide()
            $('#step').text('1')
            $('#step1').show()
            $('#step2').hide()
            $('#step3').hide()
            $('#step4').hide()
            $('#step5').hide()
            $('#step6').hide()
            $('#step7').hide()
            $('#yellowbar').append(`
            <style>
            .step-status-bar::before{
            display: block;
            content: '';
            position: relative;
            top: 0;
            left: 0;
            content: '';
            height: 10px;
            width: 20px;
            border-radius: 10px;
            background: #FFC914;
            }
            </style>`);
        }
        main_div.each(function(forms){
        $(this).removeClass('form-active');
        });
        steps()
    })

    const re = /^[0-9\b]+$/;
    const inputMobile =  $('#mobile-number')
    const inputPin = $('#pin')
    const inputConPin = $('#confirm-pin')
    const inputTransPass = $('#trans-pass')
    const inputConTransPass = $('#confirm-trans-pass')
    const inputRegCode = $('#reg-code')
    const inputRegPin = $('#reg-pin')

    inputMobile.keyup(function(){
          if(re.test(inputMobile.val())){

          }
          else{
            inputMobile.val('')
          }
    })

    inputPin.keyup(function(){
          if(re.test(inputPin.val())){

          }
          else{
            inputPin.val('')
          }
    })

    inputConPin.keyup(function(){
          if(re.test(inputConPin.val())){

          }
          else{
            inputConPin.val('')
          }
    })

    inputTransPass.keyup(function(){
          if(re.test(inputTransPass.val())){

          }
          else{
            inputTransPass.val('')
          }
    })

    inputConTransPass.keyup(function(){
          if(re.test(inputConTransPass.val())){

          }
          else{
            inputConTransPass.val('')
          }
    })

    inputRegCode.keyup(function(){
          if(re.test(inputRegCode.val())){

          }
          else{
            inputRegCode.val('')
          }
    })

    inputRegPin.keyup(function(){
          if(re.test(inputRegPin.val())){

          }
          else{
            inputRegPin.val('')
          }
    })

    $('#left').click(function(){
        $('#placement').val('Left')
    })
    $('#right').click(function(){
        $('#placement').val('Right')
    })

   function handleView(){
    //  e.preventDefault()
     $('#f1').text('Dealer Account')
     var fname = $('#fname').val().trim()
     var mname = $('#mname').val().trim()
     var lname = $('#lname').val().trim()
     var bday = $('#bday').val().trim()
     var address = $('#inputAddress').val()
     var uname = $('#uname').val().trim()
     var email = $('#email').val().trim()
     var mobilenum = $('#regMobile').val().trim()
     $('#f2').text(fname +" "+ mname +" "+ lname)
     $('#f3').text(bday)
     $('#f4').text(address)
     $('#f5').text(uname)
     $('#f6').text(email)
     $('#f7').text('+63' + mobilenum)
   }
   $('#f1').attr('data-content', 'Account Type')
   $('#f2').attr('data-content', 'Full Name')
   $('#f3').attr('data-content', 'Birthdate')
   $('#f4').attr('data-content', 'Address')
   $('#f5').attr('data-content', 'Username')
   $('#f6').attr('data-content', 'Email Address')
   $('#f7').attr('data-content', 'Mobile Number')

   
   $('#mnCheckbox').click(function() {
        if($(this).prop('checked')) {
            $('#mname').prop('disabled', true)
            $('#mname').val(' ')
        }
        else{
            $('#mname').prop('disabled', false)
        }
   })
   
   

</script>
<!-- select script -->
<script>
var x, i, j, l, ll, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("ups-select");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);
</script>
<script>
    function checkPass1(){ 
    
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('pass1');
    var pass2 = document.getElementById('pass2');
    //Store the Confimation Message Object ...
    var message = document.getElementById('confirmMessage');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
    if(pass1.value == pass2.value){
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        $('.pass-match').show()
        $('.not-match').hide()
        message.style.color = goodColor;
        message.innerHTML = "Match!"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        $('.pass-match').hide()
        $('.not-match').show()
        message.style.color = badColor;
        message.innerHTML = "Password Do Not Match!"
    }
   }

   function checkTPass1(){ 
    
    //Store the password field objects into variables ...
    var tpass1 = document.getElementById('tpass1');
    var tpass2 = document.getElementById('tpass2');
    //Store the Confimation Message Object ...
    var message = document.getElementById('confirmMessageT');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
    if(tpass1.value == tpass2.value){
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        $('.Tpass-match').show()
        $('.Tnot-match').hide()
        message.style.color = goodColor;
        message.innerHTML = "Match!"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        $('.Tpass-match').hide()
        $('.Tnot-match').show()
        message.style.color = badColor;
        message.innerHTML = "Password Do Not Match!"
    }
   }
</script>

<!-- DATEPICKER SCRIPT - DISABLE FUTURE DATES & 18YRS FROM PRESENT DATE -->
<script>
$(function(){
    console.log("")
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear() - 18;
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;
    // alert(maxDate);
    $('#bday').attr('max', maxDate);
});

// For ref: max="<?php echo date("Y-m-d"); ?> PHP version to disable future dates" 
</script>

<script>
    // pass requirements
    $(".pr-password").passwordRequirements({
        numCharacters: 8,
        useLowercase: true,
        useUppercase: true,
        useNumbers: true,
        useSpecial: true
    });
    
</script>

<script>
        //frmMobReg for Updated UI
        $("#frmMobRegNew").on('submit', function() {
            if($('#btnmobSend').data('timer') != 'START'){
                $("#Mobloading").css('display','block');
                $(".pleaseWait1").css('display','block');

                var data = $(this).serialize();
                $.ajax({   
                    type : 'POST',
                    url  : 'Registration/check_mobile',
                    data : {regMob : 0 + data.replace('regMob=','')},
                    success :  function(data)
                    {  
                        
                        $("#Mobloading").css('display','none');
                        $(".pleaseWait1").css('display','none');
                        $("#infos").html("");
                        $("#errors").html("");
                        $("#errors").css('display','none');
                        $("#infos").css('display','none');
                        
                        var res = data.split('|'); 
                        // if (res[0] == 1 && $("#country").val() !== null) {
                            if (res[0] == 1 && $("#country").val() !== null) {
                            //OTP SENT SUCCESS
                            $("#inputPinmobile").removeAttr('disabled');
                            // $("#inputPinmobile").focus();
                            // $("#infos").css('display','block');
                            // $("#infos").html(res[1]); //MESSAGE FROM RESPONSE OF SP 
                            swal({
                                title: 'OTP Sent!',
                                text: "Please wait for the OTP on your number to proceed.",
                                icon: 'success',
                                buttons: false,
                            })
                            delayTimer()
                        } else if (res[0] && $("#regMobile").val().length == 0){
                            //IF EMPTY NUMBER FIELD
                            $("#infos").css('display','none'); 
                            // $("#errors").css('display','block');
                            // $("#errors").html(res[1]);
                            swal({
                                title: 'Error!',
                                text: "Fill-in mobile number field.",
                                icon: 'error',
                                buttons: false,
                            })
                        } else {
                            //IF WRONG NUMBER
                            $("#infos").css('display','none'); 
                            // $("#errors").css('display','block');
                            // $("#errors").html(res[1]);
                            swal({
                                title: 'Error!',
                                text: "Please input correct number type.",
                                icon: 'error',
                                buttons: false,
                            })
                        }
                        if (res[0] == 3 ) {                 
                        $("#back").css('display','block');
                        $('#inputEmail').attr('disabled',true);
                        $("#inputPinmobile").attr('disabled', true);
                        } 
                    }
                });
            }
                return false;
          
        });

    function delayTimer(){
        $('#btnmobSend').attr("data-timer","START");
        var timeleft = 120;
        var interval = setInterval(function(){
            if(timeleft <= 0){
                clearInterval(interval);
                $('#btnmobSend').text("RESEND").text("RESEND").removeAttr("data-timer");
            } else {
                $('#btnmobSend').text(timeleft);
            }
            timeleft -= 1;
        }, 1000);
    }

          $('#frmRegCode').on('submit', function(){
            $('#regcodeLoading').css('display','block')
            
             var data = $(this).serialize();
             $.ajax({
                type : 'POST',
                url  : 'Registration/checkRegcode',
                data : data,
                success : function(data)
                { 
                    $('#regcodeLoading').css('display','block')
                    var res = data.split('|');
                    if(res[0] == 0 ){
                        $('#regcodeLoading').css('display','none')
                        $('#message-inputRegcode').text('Invalid Regcode')
                        $('#btnStep2').prop('disabled', true)
                    }
                    else{
                        $('#regcodeLoading').css('display','none')
                        $('#message-inputRegcode').text('')
                        $('#btnStep2').prop('disabled', false)
                    }
                }
             })
             return false;
          })
          //frmMobpinReg for Updated UI
          $("#frmMobpinRegNew").on('submit', function() {
            $("#MobPinloading").css('display','block');
            $(".pleaseWait2").css('display','block');
            var data = $(this).serialize();
            $.ajax({
                type : 'POST',
                url  : 'Registration/check_mobile',
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
                  // alert(res[0]);

                    if (res[0] == 0) {  
                        $('#btnStep1').prop('disabled', true)
                        swal({
                        title: 'Verification Failed!',
                        text: "OTP is incorrect or already expired. Please try again.",
                        icon: 'error',
                        buttons: false,
                    })              
                    //   $("#errors").css('display','block');
                    //   $("#errors").html(res[1]);
                      $('#inputEmail').attr('disabled',true);
                    } else if (res[0] == 1 ) {
                        $('#btnStep1').prop('disabled', false);
                        // $('#regMobile').attr('disabled',true);
                        swal({
                            title: 'Verification Success!',
                            text: "You may now proceed to the next step.",
                            icon: 'success',
                            buttons: false,
                        })
                    
                    //   $("#infos").css('display','block');
                    //   $("#infos").html(res[1]);
                      $("#inputEmail").removeAttr('disabled');
                      $("#inputEmail").focus(); 
                      $("#btnmobSend").html("Resend");
                      $("#btnmobSend").removeAttr('disabled');
                }
            }
            });

            return false;
          });

    </script>
    <script>
        
    </script>
