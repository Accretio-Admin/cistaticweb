$(document).ready(function(){

    // Start pass logs
     $('.mfpass').click(function(){

        var mregcode  = $('.mregcode').val();


        if(mregcode == null || mregcode == "")
        {
           $('.mensahe').html('Enter registration code');
           $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else 
        {
            $('.mensahe').html('Processing..');
            $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();
            $('.mfpass').attr('disabled',true);

            $.ajax({
                url:"forgot_getverification",
                type:"post",
                data:{mregcode:mregcode},
                dataType:"json",
                success: function(data) {
                     console.log(data);
                    if(data["S"] == 1) {
                        
                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(40000).fadeOut();
                        $('.sentVerification').show();
                        $('.b4verification').hide();
                    }
                    else {
                        
                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                    }
                    $('.mfpass').removeAttr('disabled');
                }

            }); 
        }
    });

    $('.confirmmfpass').click(function(){

        var vcode  = $('.vcode').val();
        var mregcode  = $('.mregcode').val();

        if(vcode == null || vcode == "")
        {
           $('.mensahe').html('Enter verification code');
           $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else 
        {
            $('.mensahe').html('Processing..');
            $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();
            $('.confirmmfpass').attr('disabled',true);

            $.ajax({
                url:"forgot_confirmverification",
                type:"post",
                data:{mregcode:mregcode,vcode:vcode},
                dataType:"json",
                success: function(data) {
                     console.log(data);
                    if(data["S"] == 1) {
                        
                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn()
                        $('.sentVerification').hide();
                    }
                    else {
                        
                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                    }
                    $('.confirmmfpass').removeAttr('disabled');
                }

            }); 
        }
    });
    // End pass logs
    
});