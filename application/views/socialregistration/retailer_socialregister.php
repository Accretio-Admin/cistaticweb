<link href="<?php echo BASE_URL()?>assets/css/jquery.passwordRequirements.css" rel="stylesheet" />
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="<?php echo BASE_URL()?>assets/js/jquery.passwordRequirements.min.js"></script>
<style>
    .tel-code {
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
    .ups-input {
        letter-spacing: 0px;
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
    .ups-btn {
        height: 56px;
        width: 322px;
        border-radius: 12px !important;
        padding: 8px 40px 8px 40px !important;
        border: none !important;
    }
    .txt-left{
        text-align: left;
    }

    .response-msg{
        font-weight: 600;
        font-size: 17px;
    }

    .ups-input-text[type="password"]{
        font-family: 'Poppins';
        font-style: normal;
        font-weight: 500;
        font-size: 20px;
        text-align: center;
        width: 212px;
        height: 56px;
        background: #F4F4F4;
        border-radius: 10px;
        border: none;
    }

    .ups-btn[disabled]{
        background-color: #cccccc;
        color: #666666
    }

</style>


<div id="yellowbar">   
</div>

<div id="field-view-tag">
</div>

<body class="font-poppins">
    <div class="container flex-center">
        <div class="steps-nav">
            <button class="step-prev"><img src="<?php echo BASE_URL()?>assets/icon/prev.png" alt="" srcset="" id="prev-btn"></button>
            <div class="step-status-bar">
            </div>
            <span class="step-progress-num"> <span id="step">1</span> | 2</span>
        </div> 
    </div>
    <div class="container mt-2">
        <h1 class="ups-h1 txt-center ups-txt-dark">Retailer Social</h1>
        <h1 class="ups-h1 txt-center ups-txt-yellow">Registration</h1>
        <input type="hidden" id="response_message" value="<?php print_r($result['M']); ?>" >
     </div>

     <form action="<?php echo BASE_URL(); ?>Socialregistration" method="POST" id="fbForm">
        <div class="container mt-2 form-div form-active" id="step1">
            <div class="container col flex-center">
                <input type="hidden"   value='<?php echo $social['fbid']; ?>' name="fbid" />
                <input type="hidden"  value='<?php echo $fbcheck; ?>' name="fbcheck" />
                <label for="" class="ups-input-label">Please confirm your Login Credentials</label>
                
                <label for="" class="ups-input-label mt-1" style="width: 360px; text-align: left;">Enter Your Username</label>
                <span id="message-Username" class="error"></span>
                <input type="text" class="ups-input-text txt-left" placeholder="Username" style="width: 360px; text-align: left;" name="inputUsername" id="Username" required>
                
                <label for="" class="ups-input-label mt-1" style="width: 360px; text-align: left;">Enter Your Password</label>
                <span id="message-Password" class="error"></span>
                <input type="password" class="ups-input-text" placeholder="Password" style="width: 360px; text-align: left;" name="inputPassword" id="Password" required>
                
                <label for="" class="ups-input-label mt-1" style="width: 360px; text-align: left;">Confirm Your Password</label>
                <span id="message-Password" class="error"></span>
                <input type="password" class="ups-input-text" placeholder="Confirm Password" style="width: 360px; text-align: left;"  id="Password2" required>

                <label for="" class="ups-input-label mt-1" style="width: 360px; text-align: left;">Enter Your Transpass</label>
                <span id="message-Password" class="error"></span>
                <input type="password" class="ups-input-text" placeholder="Transaction Pass" style="width: 360px; text-align: left;" name="inputTranspass"  id="Transpass" required>

                <label for="" class="ups-input-label mt-1" style="width: 360px; text-align: left;">Confirm Your Transpass</label>
                <span id="message-Password" class="error"></span>
                <input type="password" class="ups-input-text" placeholder="Transaction Pass" style="width: 360px; text-align: left;" id="Transpass2" required>

                <button type="button" class="ups-btn btn-yellow mt-1 btn-step" style="font-size: 20px; font-weight: 600; width:360px" id="btnStep1" >Proceed</button>
            </div>
        </div>
    
        <div class="container mt-2  form-div" id="step2">
            <div class="container col flex-center">
                <label for="" class="ups-input-label">Please confirm your Login Credentials</label>
                <label for="" class="ups-input-label">Enter Your Mobile Number</label>
                <span id="message-MobileNo" class="error"></span>
                <div class="ups-input-field flex-center row mt-1">
                    <div class="tel-code" style="width:360px"><img src="<?php echo BASE_URL()?>assets/icon/philippines.png" alt="" srcset="">+63</div>
                    <input type="text" class="ups-input Mobile ms-1" placeholder="Enter mobile" name="inputMobileNo" minlength="10" maxlength="10" id="MobileNo" onkeypress="return /[0-9]/i.test(event.key)" style="width:261px" required>
                </div>

                <label for="" class="ups-input-label mt-1" style="width: 360px; text-align: left;">Enter Your Email</label>
                <span id="message-Email" class="error"></span>
                <input type="email" class="ups-input-text txt-left" placeholder="Email" style="width: 360px; text-align: left;" id="Email" name="inputEmail" required>

                <label for="" class="ups-input-label mt-1" style="width: 360px; text-align: left;">Enter Your First Name</label>
                <span id="message-Firstname" class="error"></span>
                <input type="text" class="ups-input-text txt-left" placeholder="First Name" style="width: 360px; text-align: left;" id="Firstname" name="inputFirstname" required>

                <label for="" class="ups-input-label mt-1" style="width: 360px; text-align: left;">Enter Your Middle Name</label>
                <span id="message-Middlename" class="error"></span>
                <input type="text" class="ups-input-text txt-left" placeholder="Middle Name" style="width: 360px; text-align: left;" id="Middlename" name="inputMiddlename" required>

                <label for="" class="ups-input-label mt-1" style="width: 360px; text-align: left;">Enter Your Last Name</label>
                <span id="message-Lastname" class="error"></span>
                <input type="text" class="ups-input-text txt-left" placeholder="Last Name" style="width: 360px; text-align: left;" id="Lastname" name="inputLastname" required>

                <button type="submit" class="ups-btn btn-yellow mt-1" style="font-size: 20px; font-weight: 600; width:360px"  name="btnFBReg" id="fbReg">Create Your Free Account</button>
            </div>
        </div>
    </form>
    

</body>


<script>
    function checksocialpass(){
        if($('#Password').val() !== $('#Password2').val() || $('#Transpass').val() !== $('#Transpass2').val()){   
            $('#btnStep1').prop('disabled', true)
        }
        else{
            $('#btnStep1').prop('disabled', false)
        }
    };

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
                } else {
                    $('#message-' + $(this).attr('id')).text("")
                }
           }
           
        })
        
        return validate;
    }
    var main_div= $('.form-div')
    let num = 1
    if(num == 1){
        console.log(num)
        $('#prev-btn').hide()
        $('#step').text('1')
        $('#step1').show()
        $('#step2').hide()
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
        width: 70px;
        border-radius: 10px;
        background: #FFC914;
        }
        </style>`);
    }

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
            width: 70px;
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

    $('.btn-step').click(function(){
        if(!validate_form()){
            return false;
        }
        num = num + 1 ;
        main_div.each(function(forms){
        $(this).removeClass('form-active');
        });
        if(num == 2){
            $('#prev-btn').show()
            $('#step').text('2')
            $('#step1').hide()
            $('#step2').show()
            $('#step2').addClass('form-active')
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
        
    })

    
    
    $('#Password').keyup(function(){
        checksocialpass()
    })

    $('#Password2').keyup(function(){
        checksocialpass()
    })

    $('#Transpass').keyup(function(){
        checksocialpass()
    })

    $('#Transpass2').keyup(function(){
        checksocialpass()
    })

    
    
 
</script>