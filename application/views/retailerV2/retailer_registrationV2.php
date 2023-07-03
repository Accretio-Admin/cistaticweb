
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
            width: 80px;
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
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
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
</style>


<div id="yellowbar">
    
    
</div>


<body class="font-poppins">
    <div class="container flex-center">
        <div class="steps-nav">
            <button class="step-prev"><img src="<?php echo BASE_URL()?>assets/icon/prev.png" alt="" srcset="" id="prev-btn"></button>
            <div class="step-status-bar">
            </div>
            <span class="step-progress-num"> <span id="step">1</span> | 4</span>
        </div>
    </div>
    <div class="container" id="step1">
        <div class="container">
            <h1 class="ups-h1 txt-center ups-txt-dark">Authentication via</h1>
            <h1 class="ups-h1 txt-center ups-txt-yellow">One-Time-Password</h1>
        </div>

        <div class="container col flex-center mt-2">
            <label for="" class="ups-input-label">Referral Code</label>
            <div class="ups-input-field flex-center row mt-1 mb-1">
                <input type="text" class="ups-input ms-1" maxlength="10" name="referral-code" id="referral-code" value="<?php echo $referralCode; ?>" disabled>
            </div>

            <label for="" class="ups-input-label">Enter your mobile number</label>
            <div class="ups-input-field flex-center row mt-1">
                <div class="tel-code"><img src="<?php echo BASE_URL()?>assets/icon/philippines.png" alt="" srcset="">+63</div>
                <input type="text" class="ups-input ms-1" maxlength="10" id="mobile-number">
            </div>

            <label for="" class="ups-input-label mt-3">Enter authentication code</label>
            <div class="ups-input-field flex-center row mt-1">
                <input type="text" class="ups-input" value="" style="width: 321px;" id="auth-code" maxlength="6">
            </div>
            <button class="btn-link ups-txt-blue mt-1" >Get Code</button>
            <div class="container flex-center row">
                <button class="btn-link mt-5">Use my email instead <img class="ms-1"src="./next.png" alt="" srcset=""></button>
            </div>
            <button class="ups-btn btn-yellow mt-1 btn-step" style="font-size: 20px; font-weight: 600;" id="verify">Verify</button>
        
        </div>
    </div>

    <div class="container " id="step2">
        <div class="container row">
            <h1 class="ups-h1 txt-center ups-txt-dark">Fill up your</h1>
            <h1 class="ups-h1 txt-center ups-txt-yellow">Information</h1>
        </div>

        <div class="container col flex-center mt-2">
            <label for="" class="ups-input-label" style="text-align: left; width: 360px;">First Name</label>
            
            <input type="text" class="ups-input-text mt-1" placeholder="Juan" style="width: 360px; text-align: left;" >

            <div class="container row flex-center  mt-2">
                <label for="" class="ups-input-label me-4" style="text-align: left; width: px;">Middle Name</label>
                <label class="container1">I don’t have middle name
                    <input type="checkbox" checked="checked">
                    <span class="checkmark"></span>
                </label>
            </div>
            
            
            <input type="text" class="ups-input-text mt-1" placeholder="Santos" style="width: 360px; text-align: left;" >

            <label for="" class="ups-input-label  mt-2" style="text-align: left; width: 360px;">Last Name</label>
            <input type="text" class="ups-input-text mt-1" placeholder="Dela Cruz" style="width: 360px; text-align: left;" >

            <label for="" class="ups-input-label  mt-2" style="text-align: left; width: 360px;">Username</label>
            <input type="text" class="ups-input-text  mt-1" placeholder="Dela Cruz" style="width: 360px; text-align: left;" >

            <label for="" class="ups-input-label  mt-2" style="text-align: left; width: 360px;">Birthdate</label>
            <input type="date" class="ups-input-text  mt-1" placeholder="Dela Cruz" style="width: 360px; text-align: left; padding-right: 1em;" >

            <label for="" class="ups-input-label  mt-2" style="text-align: left; width: 360px;">Address</label>
            <textarea name="" id="" cols="30" rows="10" class="ups-textarea mt-1">Pilipinas</textarea>
        
            <label for="" class="ups-input-label  mt-2" style="text-align: left; width: 360px;">Email</label>
            <input type="email" class="ups-input-text  mt-1" placeholder="jdc@gmail.com" style="width: 360px; text-align: left;" >

            <button class="continue ups-btn btn-yellow mt-5 mb-4 btn-step" style="font-size: 20px; font-weight: 600;" id="">Continue</button>
        </div>
    </div>
    
    <div class="container " id="step3">
        <div class="container flex-center">
          <h1 class="ups-h1 txt-center ups-txt-dark" style="margin-right: 0.4em;">Set up your <h1 class="ups-h1 txt-center ups-txt-yellow"> Passwords</h1></h1>
        </div>

        <div class="container col flex-center mt-2">
            <label for="" class="ups-input-label" style="text-align: left; width: 360px;">Create 6-digit PIN</label>
            <input type="password" class="ups-input-text non-numeric" id="pin" maxlength="6" style="width: 360px; text-align: left; margin-top: 10px; padding: 0px 10px" >

            <label for="" class="ups-input-label" style="text-align: left; width: 360px; margin-top: 10px">Confirm PIN</label>
            <input type="password" class="ups-input-text non-numeric" id="confirm-pin" maxlength="6" style="width: 360px; text-align: left; margin-top: 10px; padding: 0px 10px" >

            <label for="" class="ups-input-label" style="text-align: left; width: 360px; margin-top: 10px">Transaction Password</label>
            <input type="password" class="ups-input-text non-numeric" id="trans-pass" maxlength="6" style="width: 360px; text-align: left;" >

            <label for="" class="ups-input-label" style="text-align: left; width: 360px; margin-top: 10px">Confirm Transaction Password</label>
            <input type="password" class="ups-input-text non-numeric" id="confirm-trans-pass" maxlength="6" style="width: 360px; text-align: left; margin-top: 10px; padding: 0px 10px" >


            <button class="continue ups-btn btn-yellow mt-5 mb-4 btn-step" style="font-size: 20px; font-weight: 600;" id="">Continue</button>
        </div>
    </div>

    <div class="containerc " id="step4">
        <div class="container flex-center">
        <h1 class="ups-h1 txt-center ups-txt-dark" style="margin-right: 0.4em;">Review your <h1 class="ups-h1 txt-center ups-txt-yellow"> details</h1></h1>
        </div>


        <div class="container flex-center col">
            <div class="field-view mt-3">
            Free Account
            </div>
            <span  style="text-align: center; align-self: center; margin-bottom: 15px;"> 
            User Information
            </span>
            <div class="field-view">
                Juan Santos Dela Cruz
            </div>
            <div class="field-view">
                MM/DD/YYYY
            </div>
            <div class="field-view">
                Pilipinas
            </div>
            <div class="field-view">
                jdc123
            </div>
            <div class="field-view">
                jdc@gmail.com
            </div>
            <div class="field-view">
                +639123456789
            </div>
            <hr class="divider" />

            <label for="" class="ups-input-label mt-1" style="text-align: left; width: 360px;">Referal Code (optional)</label>
            <input type="text" class="ups-input-text mb-2" maxlength="6" style="width: 360px; text-align: left; margin-top: 10px;" >

            <button class="continue ups-btn btn-yellow mb-2 btn-step" style="font-size: 20px; font-weight: 600;" id="">Confirm</button>
        </div>
    </div>
    <!-- loading -->
    <div class="container flex-center" style="margin-top: 20em;" id="loader">
       <div class="spinner"></div>
       <div class='loader-txt'>
            <span class="loader-item">Validating your details...</span>
            <span class="loader-item">Creating your account..</span>
            <span class="loader-item">Finishing up...</span>
        </div>
    </div>
    <!-- success screen -->
     <div class="container col flex-center" style="margin-top: 10em; animation: fadeIn 3s;" id="success-screen">
            <h1 class="ups-h1" style="margin-right: 10px; font-weight: 600;">Wow! Your <span class="ups-h1 ups-txt-yellow" style="margin-right: 10px;">UPS</span>account has </h1>
            <h1 class="ups-h1 mb-1" style="font-weight: 600;">been successfully created!</h1>
            <h2 class="ups-h2 mb-4" style="font-size: 16px;">Thanks for that, now you’re all set.</h2>
            <img src="<?php echo BASE_URL()?>assets/images/logos/success.png" alt="" srcset="" class='img-success'/>
            <button class="ups-btn btn-dark mt-5" style="font-size: 16px; font-weight: 500;" onclick="window.open('<?php echo BASE_URL() ?>Login','_self');">Proceed to account login</button>
     </div>
</body>
    
<script>
    let num = 1
    if(num == 1){
        $('#prev-btn').hide()
        $('#step').text('1')
        $('#step1').show()
        $('#step2').hide()
        $('#step3').hide()
        $('#step4').hide()
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
                $('#step3').hide()
                $('#step4').hide()
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
                $('#step4').hide()
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
                $('.steps-nav').hide()
                $('#success-screen').hide()
                $('#step1').hide()
                $('#step2').hide()
                $('#step3').hide()
                $('#step4').hide()
                $('#loader').show()
                setTimeout(() => {
                    $('#loader').hide()
                    $('#success-screen').show()
                }, 3000)
            }
    }
    
    $('.btn-step').click(function(){
        num = num + 1 ;
        steps()
            
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
        steps()
    })
   
    
    const re = /^[0-9\b]+$/;
    const inputMobile =  $('#mobile-number')
    const inputPin = $('#pin')
    const inputConPin = $('#confirm-pin')
    const inputTransPass = $('#trans-pass')
    const inputConTransPass = $('#confirm-trans-pass')

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



   
</script>
    
    