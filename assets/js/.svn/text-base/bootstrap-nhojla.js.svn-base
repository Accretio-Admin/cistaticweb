$(document).ready(function(){
	  
    // Start Account Upgrading
    $('.btnsubdealer2dealer').click(function(){ // subdealer to dealer

        $('.mensahe').html('Processing..');
        $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();
        var btn = $('.btnsubdealer2dealer').val();
        $('.btnsubdealer2dealer').attr('disabled',true);

        $.ajax({
            url:"upgrade_account/upgrade_confirm",
            type:"post",
            data:{btn:btn},
            dataType:"json",
            success: function(data) {
                 console.log(data);
                if(data["success"] == 1) {
                    
                    $('.mensahe').html(data["message"]);
                    $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(40000).fadeOut();
                    $('.Firstview').hide();
                    $('.Secondview').show();
                    $('.upgradeddone').show();
                    $('.firstButton').hide();
                }
                else {
                    
                    $('.mensahe').html(data["message"]);
                    $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                }
                $('.btnsubdealer2dealer').removeAttr('disabled');
            }

        }); 

    });

     $('.btnsubdealer2global').click(function(){ // subdealer to global

        $('.mensahe').html('Processing..');
        $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();
        var btn = $('.btnsubdealer2global').val();
        $('.btnsubdealer2global').attr('disabled',true);

        $.ajax({
            url:"upgrade_account/upgrade_confirm",
            type:"post",
            data:{btn:btn},
            dataType:"json",
            success: function(data) {
                 console.log(data);
                if(data["success"] == 1) {
                    
                    $('.mensahe').html(data["message"]);
                    $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(40000).fadeOut();
                    $('.Firstview').hide();
                    $('.Secondview').show();
                    $('.upgradeddone').show();
                    $('.firstButton').hide();
                }
                else {
                    
                    $('.mensahe').html(data["message"]);
                    $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                }
                $('.btnsubdealer2global').removeAttr('disabled');
            }

        }); 

    });

    $('.btnvisaretailer2dealer').click(function(){ // visaretailer to dealer

        $('.mensahe').html('Processing..');
        $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();
        var btn = $('.btnvisaretailer2dealer').val();
        $('.btnvisaretailer2dealer').attr('disabled',true);

        $.ajax({
            url:"upgrade_account/upgrade_confirm",
            type:"post",
            data:{btn:btn},
            dataType:"json",
            success: function(data) {
                 console.log(data);
                if(data["success"] == 1) {
                    
                    $('.mensahe').html(data["message"]);
                    $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(40000).fadeOut();
                    $('.Firstview').hide();
                    $('.Secondview').show();
                    $('.upgradeddone').show();
                    $('.firstButton').hide();
                }
                else {
                    
                    $('.mensahe').html(data["message"]);
                    $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                }
                $('.btnvisaretailer2dealer').removeAttr('disabled');
            }

        }); 

    });

    $('.btnvisaretailer2global').click(function(){ // visaretailer to global

        $('.mensahe').html('Processing..');
        $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();
        var btn = $('.btnvisaretailer2global').val();
        $('.btnvisaretailer2global').attr('disabled',true);

        $.ajax({
            url:"upgrade_account/upgrade_confirm",
            type:"post",
            data:{btn:btn},
            dataType:"json",
            success: function(data) {
                 console.log(data);
                if(data["success"] == 1) {
                    
                    $('.mensahe').html(data["message"]);
                    $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(40000).fadeOut();
                    $('.Firstview').hide();
                    $('.Secondview').show();
                    $('.upgradeddone').show();
                    $('.firstButton').hide();
                }
                else {
                    
                    $('.mensahe').html(data["message"]);
                    $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                }
                $('.btnvisaretailer2global').removeAttr('disabled');
            }

        }); 

    });

    $('.btndealer2global').click(function(){ // dealer to global

        $('.mensahe').html('Processing..');
        $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();
        var btn = $('.btndealer2global').val();
        $('.btndealer2global').attr('disabled',true);

        $.ajax({
            url:"upgrade_account/upgrade_confirm",
            type:"post",
            data:{btn:btn},
            dataType:"json",
            success: function(data) {
                 console.log(data);
                if(data["success"] == 1) {
                    
                    $('.mensahe').html(data["message"]);
                    $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(40000).fadeOut();
                    $('.Firstview').hide();
                    $('.Secondview').show();
                    $('.upgradeddone').show();
                    $('.firstButton').hide();
                }
                else {
                    
                    $('.mensahe').html(data["message"]);
                    $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                }
                $('.btndealer2global').removeAttr('disabled');
            }

        }); 

    });
    // End Account Upgrading
    
    // Start Update Profile
    $('.btnUpdateprofile').click(function(){

        var btn         = $('.btnUpdateprofile').val();
        var pAdd        = $('.permanentAdd').val();
        var mailAdd     = $('.mailAdd').val();
        var emailAdd    = $('.emailAdd').val();
        var emailAddOld = $('.emailAddOld').val();
        var boolEmail   = '';
        var emailAdd2   = $('.emailAdd2').val();
        var emailAdd2Old = $('.emailAdd2Old').val();
        var mobileno    = $('.mobileno').val();
        var mobileno2   = $('.mobileno2').val();
        var mobileno3   = $('.mobileno3').val();
        var pass        = $('.tpass').val();

        if(pAdd == null || pAdd == "")
        {
           $('.mensahe').html('Enter permanent address');
           $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(10000).fadeOut();
        }
        else if(mailAdd == null || mailAdd == "")
        {
           $('.mensahe').html('Enter mailing address');
           $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(10000).fadeOut();
        }
        else if(emailAdd == null || emailAdd == "")
        {
           $('.mensahe').html('Enter email address');
           $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(10000).fadeOut();
        }
        else if(emailAdd2 == null || emailAdd2 == "")
        {
           $('.mensahe').html('Enter alternate email address');
           $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(10000).fadeOut();
        }
        else if(mobileno == null || mobileno == "")
        {
           $('.mensahe').html('Enter mobile number');
           $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(10000).fadeOut();
        }/*
        else if(mobileno2 == null || mobileno2 == "")
        {
           $('.mensahe').html('Enter secondary mobile number');
           $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(mobileno3 == null || mobileno3 == "")
        {
           $('.mensahe').html('Enter tertiary mobile number');
           $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }*/
        else if(pass == null || pass == "")
        {
           $('.mensahe').html('Enter transaction password');
           $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(10000).fadeOut();
        }
        else if(emailAdd == emailAdd2)
        {
           $('.mensahe').html('Alternate email address must be different from email address');
           $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(10000).fadeOut();
        }
        else 
        {
            
            if(validateEmail(emailAdd)){ } else {
                $('.mensahe').html('Invalid email address');
                $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(10000).fadeOut();
                exit();
            }

            if(validateEmail(emailAdd2)){ } else {
                $('.mensahe').html('Invalid alternate email address');
                $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(10000).fadeOut();
                exit();
            }

            if(emailAdd == emailAddOld) {
                boolEmail = '1';
            } 
            else {
                boolEmail = '0';
            }

            if(emailAdd2 == emailAdd2Old) {
                boolEmail2 = '1';
            }
            else {
                boolEmail2 = '0';
            }


            $('.mensahe').html('Processing..');
            $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();
            //$('.btnUpdateprofile').attr('disabled',true);


            $.ajax({
                url:"my_profile_update_call",
                type:"post",
                data:{pAdd:pAdd, mailAdd:mailAdd, emailAdd:emailAdd, emailAdd2:emailAdd2, mobileno:mobileno, mobileno2:mobileno2, mobileno3:mobileno3, pass:pass, boolEmail:boolEmail, boolEmail2:boolEmail2},
                dataType:"json",
                success: function(data) {
                     console.log(data);
                    if(data["S"] == 1) {
                        
                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(10000).fadeOut();

                    }
                    else {
                        
                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(10000).fadeOut();
                    }
                    $('.btnUpdateprofile').removeAttr('disabled');
                }

            }); 
        }
    });

    function validateEmail(email){

        var emailReg = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        var valid = emailReg.test(email);

        if(!valid) {
            return false;
        } else {
            return true;
        }
    }
    // End Update Profile

    // Start GC confirm
    $('.btnGCrelease').click(function(){

        //$('.btnGCrelease').attr('disabled',true);
            
        var trackno = $('.textboxtrackno').val();
        var btn    = $('.btnGCrelease').val();


        $('.mensahe').html('Processing..');
        $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();      
   
       
            $.ajax({
                url:"gc_release_ajax",
                type:"post",
                data:{btn:btn,trackno:trackno},
                dataType:"json",
                success: function(data) {
                console.log(data);
                    
                    if(data["S"] == 1) {
                       
                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                        
                        $('.firsView').hide();
                        $('.secondView').show();
                        $('.textboxtrackno').val(data['TN']);

                    }
                    else {

                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                
                    }
                    $('.btnSellCodes').removeAttr('disabled');

                }

            });
    });
    // End GC confirm
});