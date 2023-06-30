$(document).ready(function(){
	 window.onload = function () {
	        document.onkeydown = function (e) {
	            return (e.which || e.keyCode) != 116;
	        };
	    }
    

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
                     //console.log(data);
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
                     //console.log(data);
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
    // Start Network Income Convertion

    // Convert Ecash  Start
    $('.btnconverttoecash').click(function(){

        var btn         = $('.btnconverttoecash').val();
        var amount      = $('#converttoecash').val();
        var available   = $('#converttoecashAvailablebalance').val();
        var ecash       = $('#converttoecashEcashbalance').val();
        var converted   = (amount * .9) - 25;

        if(amount == null || amount == "")
        {
            $('.mensahe').html('Enter amount to transfer');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }else if(amount < 100)
        {
            $('.mensahe').html('Amount must be greater than or equal to 100 pesos');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else 
        {

            $('#converttoecashConvertedamount').val(converted);

            $('#spanconverttoecashAvailablebalance').html(available);
            $('#spanconverttoecashEcashbalance').html(ecash);
            $('#spanconverttoecash').html(amount);
            $('#spanconverttoecashConvertedamount').html(converted);

            $('.converttoecashFirstview').hide();
            $('.converttoecashSecondview').show();
        }

    });

    $('.btnconverttoecashback').click(function(){
        $('.converttoecashFirstview').show();
        $('.converttoecashSecondview').hide();
    });

    $('.btnconverttoecashconfirm').click(function(){

        var btn         = $('.btnconverttoecashconfirm').val();
        var amount      = $('#converttoecash').val();
        var available   = $('#converttoecashAvailablebalance').val();
        var ecash       = $('#converttoecashEcashbalance').val();
        var converted   = (amount * .9) - 25;
        var pass        = $('#converttoecashpass').val();

         if(pass == null || pass == "")
        {
            $('.mensahe').html('Enter transaction password');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else 
        {
            $('.mensahe').html('Processing..');
            $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();

            $('.btnconverttoecashconfirm').attr('disabled',true);

            $.ajax({
                url:"networkIncome_convert",
                type:"post",
                data:{btn:btn,amount:amount,pass:pass},
                dataType:"json",
                success: function(data) {
                    // console.log(data['TN']);
                    if(data["S"] == 1) {
                       
                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                        $('.converttoecashThirdview').show();
                        $('.converttoecashSecondview').hide();
                       // $('#visa_package').val(data['TN']);
                      ///  $('#retaileremailwithcodes').html(clientEmail);
                        $('.emailsentsuccess').show();
                        $('input[name="convertedecashTN"]').val(data['TN']);
                        $('.btnconverttoecashconfirm').removeAttr('disabled');
                    }
                    else {

                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                        $('.btnconverttoecashconfirm').removeAttr('disabled');
                    }

                }

            }); 
        }


    });
    // Convert Ecash End

    // Convert Cheque  Start
    $('.btnconverttocheque').click(function(){

        var btn         = $('.btnconverttocheque').val();
        var amount      = $('#converttocheque').val();
        var available   = $('#converttochequeAvailablebalance').val();
        var ecash       = $('#converttochequeEcashbalance').val();
        var converted   = (amount * .9);

        if(amount == null || amount == "")
        {
            $('.mensahe').html('Enter amount to transfer');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }else if(amount < 100)
        {
            $('.mensahe').html('Amount must be greater than or equal to 100 pesos');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else 
        {

            $('#converttochequeConvertedamount').val(converted);

            $('#spanconverttochequeAvailablebalance').html(available);
            $('#spanconverttochequeEcashbalance').html(ecash);
            $('#spanconverttocheque').html(amount);
            $('#spanconverttochequeConvertedamount').html(converted);

            $('.converttochequeFirstview').hide();
            $('.converttochequeSecondview').show();
        }

    });

    $('.btnconverttochequeback').click(function(){
        $('.converttochequeFirstview').show();
        $('.converttochequeSecondview').hide();
    });

    $('.btnconverttochequeconfirm').click(function(){

        var btn         = $('.btnconverttochequeconfirm').val();
        var amount      = $('#converttocheque').val();
        var available   = $('#converttochequeAvailablebalance').val();
        var ecash       = $('#converttochequeEcashbalance').val();
        var converted   = (amount * .9);
        var pass        = $('#converttochequepass').val();

         if(pass == null || pass == "")
        {
            $('.mensahe').html('Enter transaction password');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else 
        {
            $('.mensahe').html('Processing..');
            $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();

            $('.btnconverttochequeconfirm').attr('disabled',true);

            $.ajax({
                url:"networkIncome_convert",
                type:"post",
                data:{btn:btn,amount:amount,pass:pass},
                dataType:"json",
                success: function(data) {
                    // console.log(data['TN']);
                    if(data["S"] == 1) {
                       
                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                        $('.converttochequeThirdview').show();
                        $('.converttochequeSecondview').hide();
                       // $('#visa_package').val(data['TN']);
                      ///  $('#retaileremailwithcodes').html(clientEmail);
                        $('.emailsentsuccess').show();
                        $('input[name="convertedchequeTN"]').val(data['TN']);
                        $('.btnconverttochequeconfirm').removeAttr('disabled');
                    }
                    else {

                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                        $('.btnconverttochequeconfirm').removeAttr('disabled');
                    }

                }

            }); 
        }


    });
    // Convert Cheque End

       // Convert Cheque  Start
    $('.btnconverttoclaim').click(function(){

        var btn         = $('.btnconverttoclaim').val();
        var amount      = $('#converttoclaim').val();
        var available   = $('#converttoclaimAvailablebalance').val();
        var availablegc = $('#converttoclaimAvailablegc').val();
        var ecash       = $('#converttoclaimEcashbalance').val();
        //var converted   = (amount * .9);
        var name        = $('#converttoclaimant').val();

        if(amount == null || amount == "")
        {
            $('.mensahe').html('Enter amount to transfer');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }else if(amount % 1500)
        {
            $('.mensahe').html('GC to claim must be divisible by 1500');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(name == null || name == "")
        {
            $('.mensahe').html('Enter claimant name');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else 
        {

           //$('#converttoclaimConvertedamount').val(converted);

            $('#spanconverttoclaimAvailablebalance').html(availablegc);
            $('#spanconverttoclaim').html(amount);
            $('#spanconverttoclaimant').html(name);
          // $('#spanconverttoclaimConvertedamount').html(converted);

            $('.converttoclaimFirstview').hide();
            $('.converttoclaimSecondview').show();
        }

    });

    $('.btnconverttoclaimback').click(function(){
        $('.converttoclaimFirstview').show();
        $('.converttoclaimSecondview').hide();
    });

    $('.btnconverttoclaimconfirm').click(function(){

        var btn         = $('.btnconverttoclaimconfirm').val();
        var amount      = $('#converttoclaim').val();
        var available   = $('#converttoclaimAvailablebalance').val();
        var ecash       = $('#converttoclaimEcashbalance').val();
        //var converted   = (amount * .9);
        var pass        = $('#converttoclaimpass').val();
        var name        = $('#converttoclaimant').val();

         if(pass == null || pass == "")
        {
            $('.mensahe').html('Enter transaction password');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else 
        {
           
            $('.mensahe').html('Processing..');
            $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();

            $('.btnconverttoclaimconfirm').attr('disabled',true);

            $.ajax({
                url:"networkIncome_convert",
                type:"post",
                data:{btn:btn,amount:amount,pass:pass,name:name},
                dataType:"json",
                success: function(data) {
                    // console.log(data['TN']);
                    if(data["S"] == 1) {
                       
                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                        $('.converttoclaimThirdview').show();
                        $('.converttoclaimSecondview').hide();
                       // $('#visa_package').val(data['TN']);
                      ///  $('#retaileremailwithcodes').html(clientEmail);
                        $('.emailsentsuccess').show();
                        //$('input[name="convertedclaimTN"]').val(data['TN']);
                        $('input[name="convertedclaimTN"]').val(data["TN"]);
                        $('.btnconverttoclaimconfirm').removeAttr('disabled');
                    }
                    else {

                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                        $('.btnconverttoclaimconfirm').removeAttr('disabled');
                    }

                }

            }); 
        }


    });
    // Convert Cheque End

    // End Network Income Convertion

	
//$(document).on("click", ".btnSellCodes", function(){
	$('.btnSellCodes').click(function(){
	
			$('.btnSellCodes').attr('disabled',true);
				
			var serial = $('.textboxserial').val();
            var btn    = $('.btnSellCodes').val();

            $('.mensahe').html('Processing..');
            $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();      
       
           
                $.ajax({
                    url:"send_sell",
                    type:"post",
                    data:{btn:btn,serial:serial},
                    dataType:"json",
                    success: function(data) {
                    //console.log(data);
                        
                        if(data["S"] == 1) {
                           
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                            $('.tab-content').find("div.active").find('input[name="domestic_markup"]').val('');
                            
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

     
//$(document).on("click", ".btnTransCodes", function(){
	$('.btnTransCodes').click(function(){
	
            var btn      = $('.btnTransCodes').val();
	    //var serial   = $('.textboxserial').val();
	    //var serial   = $('#tranfercodepreview').val();
	    //var serial   =$('.textboxtransfercodes').val(serial);
	    var serial   =$('.textboxtransfercodes').val();
 	    var regcode  = $('.Rregcode').val();

            $('.mensahe').html('Processing..');
            $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();      
            
            $('.btnTransCodes').attr('disabled',true);

                $.ajax({
                    url:"send_sellhub",
                    type:"post",
                    data:{btn:btn,serial:serial, regcode:regcode},
                    dataType:"json",
                    success: function(data) {
                    //console.log(data);
                        
                        if(data["S"] == 1) {
                           
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                            $('.tab-content').find("div.active").find('input[name="domestic_markup"]').val('');
                            
                            $('.firsView').hide();
                            $('.secondView').show();
                            $('.textboxtrackno').val(data['TN']);
    
                        }
                        else {
    
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                    
                        }
                        $('.btnTransCodes').removeAttr('disabled');
    
                    }
    
                });
     	 });


	  $('.select_sender').autocomplete({
    	  source: function(request, response) {
	          $.getJSON('getremittanceusers', { term: request.term }, function(result) {
	        	  if(result.length == 0){
	        		  $('.select_sender').focus();
	        		  $('.tab-content').find("div.active").find( ".sender_id" ).val('');
	        		  $('.sender_info').hide();
	        		  $('#createRemitUser').modal('show');
	        	  	  return false;
	        	  }else{
	        		  response($.map(result, function(item) {
	        			  return item;
	        		  }));
	        	  }
	          });
	      },
	      select: function( event, ui ) {
	    	    $('.tab-content').find("div.active").find('.sender_info').show();
	    	  	$('.tab-content').find("div.active").find('.sender_mobile').val( ui.item.mobile);
	    	  	$('.tab-content').find("div.active").find( ".sender_id" ).val( ui.item.client_id);
	    	  	$('.tab-content').find("div.active").find( ".sender_name" ).val( ui.item.label);
				$('.tab-content').find("div.active").find( ".sender_fname" ).val( ui.item.fname);
				$('.tab-content').find("div.active").find( ".sender_mname" ).val( ui.item.mname);
				$('.tab-content').find("div.active").find( ".sender_lname" ).val( ui.item.lname);
	    	  	$('.tab-content').find("div.active").find( ".sender_address" ).val( ui.item.address);
	    	  	$('.tab-content').find("div.active").find( ".sender_email" ).val( ui.item.email);
	    	  	$('.tab-content').find("div.active").find(".select_beneficiary").removeAttr('disabled');
	    	  	$('.tab-content').find("div.active").find(".select_beneficiary").focus();
	    	 
		        return false;
	      	}
        });
      $(".select_beneficiary").autocomplete({
    	  source: function(request, response) {
	          $.getJSON('getremittanceusers', { term: request.term }, function(result) {
	        	  if(result.length == 0){
	        		  $(".select_beneficiary").focus();
	        		  $('.tab-content').find("div.active").find( ".bene_id" ).val('');
	        		  $('.beneficiary_info').hide();
	        		  $('#createRemitUser').modal('show');
	        	  	  return false;
	        	  }else{
	        		  response($.map(result, function(item) {
	        			  return item;
	        		  }));
	        	  }
	          });
	      },
	      select: function( event, ui ) {
	    	  $('.tab-content').find("div.active").find('.beneficiary_info').show();
	    	  $('.tab-content').find("div.active").find( ".bene_mobile" ).val( ui.item.mobile);
	    	  $('.tab-content').find("div.active").find( ".bene_id" ).val( ui.item.client_id);
	    	  $('.tab-content').find("div.active").find( ".bene_name" ).val( ui.item.label);
			  
			  $('.tab-content').find("div.active").find( ".bene_fname" ).val( ui.item.fname);
			  $('.tab-content').find("div.active").find( ".bene_mname" ).val( ui.item.mname);
			  $('.tab-content').find("div.active").find( ".bene_lname" ).val( ui.item.lname);
	    	  $('.tab-content').find("div.active").find( ".bene_address" ).val( ui.item.address);
	    	  $('.tab-content').find("div.active").find( ".bene_email" ).val( ui.item.email);
	    	  $('.tab-content').find("div.active").find(".visacardno").focus();
		        return false;
	      	}
        });
      $(".select_bene").autocomplete({
    	  source: function(request, response) {
	          $.getJSON('getremittanceusers', { term: request.term }, function(result) {
	        	  if(result.length == 0){
	        		  $(".select_beneficiary").focus();
	        		  $('.tab-content').find("div.active").find( ".bene_id" ).val('');
	        		  $('.beneficiary_info').hide();
	        		  $('#createRemitUser').modal('show');
	        	  	  return false;
	        	  }else{
	        		  response($.map(result, function(item) {
	        			  return item;
	        		  }));
	        	  }
	          });
	      },
	      select: function( event, ui ) {
	    	  $('.tab-content').find("div.active").find('.beneficiary_info').show();
	    	  $('.tab-content').find("div.active").find( ".bene_mobile" ).val( ui.item.mobile);
	    	  $('.tab-content').find("div.active").find( ".bene_id" ).val( ui.item.client_id);
	    	  $('.tab-content').find("div.active").find( ".bene_name" ).val( ui.item.label);
			  
			  $('.tab-content').find("div.active").find( ".bene_fname" ).val( ui.item.fname);
			  $('.tab-content').find("div.active").find( ".bene_mname" ).val( ui.item.mname);
			  $('.tab-content').find("div.active").find( ".bene_lname" ).val( ui.item.lname);
	    	  $('.tab-content').find("div.active").find( ".bene_address" ).val( ui.item.address);
	    	  $('.tab-content').find("div.active").find( ".bene_email" ).val( ui.item.email);
	    	  $('.tab-content').find("div.active").find(".smartmoney").focus();
		        return false;
	      	}
        });
    //Ticketing International Airport Source     
	  $('.airport_source').autocomplete({
    	  source: function(request, response) {
	          $.getJSON('international_airports', { term: request.term }, function(result) {
	        
	        		  response($.map(result, function(item) {
	        			  return item;
	        		  }));
	        	  
	          });
	      },
	      select: function( event, ui ) {
	    	  	$('.tab-content').find("div.active").find('.airport_source').val( ui.item.code);
	    	  	$('.tab-content').find("div.active").find( ".airport_origin_code" ).val( ui.item.code);
	    	  	$('.tab-content').find("div.active").find( ".airport_source" ).val( ui.item.label);
		        return false;
	      	}
        });
   //Ticketing International Airport Destination     
	  $('.airport_dest').autocomplete({
    	  source: function(request, response) {
	          $.getJSON('international_airports', { term: request.term }, function(result) {
	        
	        		  response($.map(result, function(item) {
	        			  return item;
	        		  }));
	        	  
	          });
	      },
	      select: function( event, ui ) {
	    	  	$('.tab-content').find("div.active").find('.airport_dest').val( ui.item.code);
	    	  	$('.tab-content').find("div.active").find( ".airport_dest_code" ).val( ui.item.code);
	    	  	$('.tab-content').find("div.active").find( ".airport_dest" ).val( ui.item.label);
		        return false;
	      	}
        });
    //Ticketing Domestic Airport Source     
	  $('.dom_airport_source').autocomplete({
    	  source: function(request, response) {
	          $.getJSON('domestic_airports', { term: request.term }, function(result) {
	        
	        		  response($.map(result, function(item) {
	        			  return item;
	        		  }));
	        	  
	          });
	      },
	      select: function( event, ui ) {
	    	  	$('.tab-content').find("div.active").find('.dom_airport_source').val( ui.item.code);
	    	  	$('.tab-content').find("div.active").find( ".dom_airport_origin_code" ).val( ui.item.code);
	    	  	$('.tab-content').find("div.active").find( ".dom_airport_source" ).val( ui.item.label);
		        return false;
	      	}
        });
   //Ticketing Domestic Airport Destination     
	  $('.dom_airport_dest').autocomplete({
    	  source: function(request, response) {
	          $.getJSON('domestic_airports', { term: request.term }, function(result) {
	        
	        		  response($.map(result, function(item) {
	        			  return item;
	        		  }));
	        	  
	          });
	      },
	      select: function( event, ui ) {
	    	  	$('.tab-content').find("div.active").find('.dom_airport_dest').val( ui.item.code);
	    	  	$('.tab-content').find("div.active").find( ".dom_airport_dest_code" ).val( ui.item.code);
	    	  	$('.tab-content').find("div.active").find( ".dom_airport_dest" ).val( ui.item.label);
		        return false;
	      	}
        });
	//Ticketing Domestic Markup
    $('.domesticmarkup').click(function(){

        var btn       = $(".domesticmarkup").val();        
        var amount    = $('.tab-content').find("div.active").find('input[name="domestic_markup"]').val();
        var byahe     = $('.tab-content').find("div.active").find('input[name="byahe"]').val();
        
         //alert(amount);   

        if(amount == null || amount == "")
        {
            $('.mensahe').html('Amount must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        
        else{
            $('.mensahe').html('Processing..');
            $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();      
        
                $.ajax({
                    url:"ticketing_markup",
                    type:"post",
                    data:{amount:amount,byahe:byahe},
                    dataType:"json",
                    success: function(data) {
                    //console.log(data);
                        
                        if(data["S"] == 1) {
                           
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                            $('.tab-content').find("div.active").find('input[name="domestic_markup"]').val('');
                            
                            $('.markupold').hide();
                            $('#markup').html(data["AMT"]);
                
    
                        }
                        else {
    
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                    
                        }
    
                    }
    
                });
            
        }
    });
    //Ticketing Domestic searching
    $('.btnTicketingSearch').click(function(){
        alert("Please be advised that you only have four minutes booking time allowance. Exceeding the booking time will revert you to the first step.");
		
		
        var btn     = $(".btnTicketingSearch").val();        
        var from    = $('.tab-content').find("div.active").find('input[name="from"]').val();
        var dest    = $('.tab-content').find("div.active").find('input[name="dest"]').val();

        if(from == null || from == "")
        {
            $('.mensahe').html('Origin must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(dest == null || dest == "")
        {
            $('.mensahe').html('Destination must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        
        else{
            
            
    		$(document).ready(function() {
    			if(!Modernizr.meter){
    				alert('Sorry your brower does not support HTML5 progress bar');
    			} else {
    			     $(".progress-wrapper").show();
    				var progressbar = $('#progressbar'),
    					max = progressbar.attr('max'),
    					time = (1000/max)*10,	
    			        value = progressbar.val();
    
    			    var loading = function() {
    			        value += 1;
    			        addValue = progressbar.val(value);
    			        
    			        $('.progress-value').html(value + '%');
    
    			        if (value == max) {
    			            clearInterval(animate);		
                                $(".progress-wrapper").remove();   
                                $("#details").show("slow");     
                                $("#motion1").html(" ");    	
                                $("#acuhtzi").remove();   
    			        }
                            if (value == 1) {
                                $("#acuhtzi").html("Starting the searching.");   
    			        }
                            if (value == 16) {
                                $("#acuhtzi").html("Searching origin.");   
    			        }
                            if (value == 38) {
    			                $("#acuhtzi").html("Searching destination.");    
    			        }
                            if (value == 55) {
    			                $("#acuhtzi").html("Checking airlines.");   
    			        }
                            if (value == 72) {
    			                $("#acuhtzi").html("Adding airlines.");   
    			        }
                            if (value == 86) {
    			                $("#acuhtzi").html("Finishing up.");   
    			        }
    			    };
    
    			    var animate = setInterval(function() {
    			        loading();
    			    }, time);
    			};
    	
    		
    		});
            
        }
    });
    //Ticketing International Markup
    $('.internationalmarkup').click(function(){

        var btn       = $(".internationalmarkup").val();        
        var amount    = $('.tab-content').find("div.active").find('input[name="international_markup"]').val();
        var byahe     = $('.tab-content').find("div.active").find('input[name="byahe"]').val();
        
         //alert(amount);   

        if(amount == null || amount == "")
        {
            $('.mensahe').html('Amount must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        
        else{
            
            
            $('.mensahe').html('Processing..');
            $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();      
        
                $.ajax({
                    url:"ticketing_markup",
                    type:"post",
                    data:{amount:amount,byahe:byahe},
                    dataType:"json",
                    success: function(data) {
                    //console.log(data);
                        
                        if(data["S"] == 1) {
                           
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                            $('.tab-content').find("div.active").find('input[name="international_markup"]').val('');
                            
                            $('.internatioalmarkupold').hide();
                            $('#internatioalmarkup').html(data["AMT"]);
    
                        }
                        else {
    
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                    
                        }
    
                    }
    
                });
            
        }
    });
    // Start E-CASH add sender / beneficiary
    $('.btnremituseradd').click(function(){

        var btn       = $('.btnremituseradd').val();
        var fname     = $('#remituserfname').val();
        var mname     = $('#remitusermname').val();
        var lname     = $('#remituserlname').val();
        var email     = $('#remituseremail').val();
        var mobile    = $('#remitusermobile').val();
        var address   = $('#remituseraddress').val();
        var gender    = $('#remitusergender').val();
        var country   = $('#remitusercountry').val();

        if(fname == null || fname == "")
        {
            $('.mensahe').html('First name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(mname == null || mname == "")
        {
            $('.mensahe').html('Middle name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(lname == null || lname == "")
        {
            $('.mensahe').html('Last name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(mobile == null || mobile == "")
        {
            $('.mensahe').html('Mobile number must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(address == null || address == "")
        {
            $('.mensahe').html('Address must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(gender == null || gender == "")
        {
            $('.mensahe').html('Gender must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(country == null || country == "")
        {
            $('.mensahe').html('Country must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else 
        {
           
          
            $('#spanremituserfullname').html(fname+" "+mname+" "+lname);
            $('#spanremituseremail').html(email);
            $('#spanremitusermobile').html(mobile);
            $('#spanremituseraddress').html(address);
            $('#spanremitusergender').html(gender);
            $('#spanremitusercountry').html(country);

            $('.remituserFirstview').hide();
            $('.remituserSecondview').show();
        }
    });

    $('.btnremituseraddback').click(function(){
        $('.remituserFirstview').show();
        $('.remituserSecondview').hide();
    });
    
    $('.btnremitusercancel').click(function(){
    	var sender      = $('.tab-content').find("div.active").find( ".sender_id" ).val();
    	var beneficiary = $('.tab-content').find("div.active").find( ".bene_id" ).val();
    	
    	if(sender == ''){
    		$('.sender_info').hide();
    		$('.select_sender').val('');
    		$('.select_sender').focus;
    	}else if(beneficiary == ''){
    		$('.beneficiary_info').hide();
    		$('.select_beneficiary').val('');
    		$('.select_beneficiary').focus;
    	}
    	$('.createRemitUser').hide();
    });
    
    $('.nav a').click(function(){
    	$('.createRemitUser').hide();
    	$('.sender_info').hide();
    	if($('.tab-content').find("div.active").attr('id') == 'myvisa'){
    		
    		$('.beneficiary_info').hide();
    	}else{
    		
    	}
    	$('.flasher').hide();
    	$('.select_sender').val('');
    	$('.select_sender').focus;
    	$('.select_beneficiary').val('');
    	$(".select_beneficiary").attr('disabled', true);
    });

    $('.btnremituseraddconfirm').click(function(){

        var btn       = $('.btnremituseraddconfirm').val();
        var fname     = $('#remituserfname').val();
        var mname     = $('#remitusermname').val();
        var lname     = $('#remituserlname').val();
        var email     = $('#remituseremail').val();
        var mobile    = $('#remitusermobile').val();
        var address   = $('#remituseraddress').val();
        var gender    = $('#remitusergender').val();
        var country   = $('#remitusercountry').val();

        $('.mensahe').html('Processing..');
        $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();

            $.ajax({
                url:"ecash_saveRemitUser",
                type:"post",
                data:{btn:btn,fname:fname,mname:mname,lname:lname,email:email,mobile:mobile,address:address,gender:gender,country:country},
                dataType:"json",
                success: function(data) {
                    //console.log(data);
                    if(data["S"] == 1) {
                       
                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                        $('.remituserThirdview').show();
                        $('.remituserSecondview').hide();
                        $('#remitusersuccessfullname').html(fname+" "+mname+" "+lname);
                        $('.saveusersuccess').show();
                    }
                    else {

                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                    }

                }

            });
    });
    // End E-CASH add sender / beneficiary
    // Start Buy Codes

    // Retailer Start
    $('.btnbuycodeRetailer').click(function(){

        var btn         = $('.btnbuycodeRetailer').val();
        var country     = $('#retailerCountry').val();
        var email       = $('#retaileryourEmail').val();
        var name        = $('#retailerclientName').val();
        var clientEmail = $('#retailerclientEmail').val();
        var contact     = $('#retailercontact').val();
        var payment     = $('#retailerPayment').val();

        if(payment == 1) {
           var previewpayment = 'ECASH';
        }

        if(email == null || email == "")
        {
            $('.mensahe').html('Your email must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(name == null || name == "")
        {
            $('.mensahe').html('Client name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(clientEmail == null || clientEmail == "")
        {
            $('.mensahe').html('Client email must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(contact == null || contact == "")
        {
            $('.mensahe').html('Contact number must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else 
        {
            
            if(validateEmail(clientEmail)){ } else {
                $('.mensahe').html('Client email is invalid');
                $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                exit();
            }

            if(validateEmail(email)){ } else {
                $('.mensahe').html('Your email is invalid');
                $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                exit();
            }
                
            $('#spanretaileremailadd').html(email);
            $('#spanretailerclientname').html(name);
            $('#spanretailerclientemailadd').html(clientEmail);
            $('#spanretailerclientcontact').html(contact);
            $('#spanretailerclientpayment').html(previewpayment);

            $('.retailerFirstview').hide();
            $('.retailerSecondview').show();
        }

    });

    $('.btnbuycodeRetailerback').click(function(){
        $('.retailerFirstview').show();
        $('.retailerSecondview').hide();
    });

    $('.btnbuycodeRetailerconfirm').click(function(){

        var btn         = $('.btnbuycodeRetailerconfirm').val();
        var country     = $('#retailerCountry').val();
        var email       = $('#retaileryourEmail').val();
        var name        = $('#retailerclientName').val();
        var clientEmail = $('#retailerclientEmail').val();
        var contact     = $('#retailercontact').val();
        var payment     = $('#retailerPayment').val();

        $('.mensahe').html('Processing..');
        $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();

        $('.btnbuycodeRetailerconfirm').attr('disabled',true);

            $.ajax({
                url:"buycodes_transact",
                type:"post",
                data:{btn:btn,country:country,email:email,name:name,clientEmail:clientEmail,contact:contact,payment:payment},
                dataType:"json",
                success: function(data) {
                    // console.log(data['TN']);
                    if(data["S"] == 1) {
                       
                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                        $('.retailerThirdview').show();
                        $('.retailerSecondview').hide();
                        $('#visa_package').val(data['TN']);
                        $('#retaileremailwithcodes').html(clientEmail);
                        $('.emailsentsuccess').show();
                        $('input[name="visa_package"]').val(data['TN']);
                        $('input[name="generatedRegcode"]').val(data['R']);
                    }
                    else {

                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                    }
                    $('.btnbuycodeRetailerconfirm').removeAttr('disabled');

                }

            });

    });
    // Retailer End

    // Retailer Plus Start
    $('.btnbuycodeRetailerplus').click(function(){

        var btn         = $('.btnbuycodeRetailerplus').val();
        var country     = $('#retailerplusCountry').val();
        var email       = $('#retailerplusyourEmail').val();
        var name        = $('#retailerplusclientName').val();
        var clientEmail = $('#retailerplusclientEmail').val();
        var contact     = $('#retailerpluscontact').val();
        var payment     = $('#retailerplusPayment').val();

        if(payment == 1) {
           var previewpayment = 'ECASH';
        }

        if(email == null || email == "")
        {
            $('.mensahe').html('Your email must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(name == null || name == "")
        {
            $('.mensahe').html('Client name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(clientEmail == null || clientEmail == "")
        {
            $('.mensahe').html('Client email must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(contact == null || contact == "")
        {
            $('.mensahe').html('Contact number must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else 
        {
            
            if(validateEmail(clientEmail)){ } else {
                $('.mensahe').html('Client email is invalid');
                $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                exit();
            }

            if(validateEmail(email)){ } else {
                $('.mensahe').html('Your email is invalid');
                $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                exit();
            }
                
            $('#spanretailerplusemailadd').html(email);
            $('#spanretailerplusclientname').html(name);
            $('#spanretailerplusclientemailadd').html(clientEmail);
            $('#spanretailerplusclientcontact').html(contact);
            $('#spanretailerplusclientpayment').html(previewpayment);

            $('.retailerplusFirstview').hide();
            $('.retailerplusSecondview').show();
        }

    });

    $('.btnbuycodeRetailerplusback').click(function(){
        $('.retailerplusFirstview').show();
        $('.retailerplusSecondview').hide();
    });

    $('.btnbuycodeRetailerplusconfirm').click(function(){

        var btn         = $('.btnbuycodeRetailerplusconfirm').val();
        var country     = $('#retailerplusCountry').val();
        var email       = $('#retailerplusyourEmail').val();
        var name        = $('#retailerplusclientName').val();
        var clientEmail = $('#retailerplusclientEmail').val();
        var contact     = $('#retailerpluscontact').val();
        var payment     = $('#retailerplusPayment').val();

        $('.mensahe').html('Processing..');
        $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();

        $('.btnbuycodeRetailerplusconfirm').attr('disabled',true);

            $.ajax({
                url:"buycodes_transact",
                type:"post",
                data:{btn:btn,country:country,email:email,name:name,clientEmail:clientEmail,contact:contact,payment:payment},
                dataType:"json",
                success: function(data) {
                    // console.log(data);
                    if(data["S"] == 1) {
                       
                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                        $('.retailerplusThirdview').show();
                        $('.retailerplusSecondview').hide();
                        $('#retailerplusemailwithcodes').html(clientEmail);
                        $('.emailsentsuccess').show();
                        $('input[name="visaretailer_package"]').val(data['TN']);
                        $('input[name="generatedRegcode"]').val(data['R']);
                    }
                    else {

                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                    }
                    $('.btnbuycodeRetailerplusconfirm').removeAttr('disabled');

                }

            });

    });
    // Retailer Plus End

    // Sub Dealer Start
    $('.btnbuycodeSubdealer').click(function(){

        var btn         = $('.btnbuycodeSubdealer').val();
        var country     = $('#subdealerCountry').val();
        var email       = $('#subdealeryourEmail').val();
        var name        = $('#subdealerclientName').val();
        var clientEmail = $('#subdealerclientEmail').val();
        var contact     = $('#subdealercontact').val();
        var payment     = $('#subdealerPayment').val();

        if(payment == 1) {
           var previewpayment = 'ECASH';
        }

        if(email == null || email == "")
        {
            $('.mensahe').html('Your email must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(name == null || name == "")
        {
            $('.mensahe').html('Client name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(clientEmail == null || clientEmail == "")
        {
            $('.mensahe').html('Client email must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(contact == null || contact == "")
        {
            $('.mensahe').html('Contact number must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else 
        {
            
            if(validateEmail(clientEmail)){ } else {
                $('.mensahe').html('Client email is invalid');
                $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                exit();
            }

            if(validateEmail(email)){ } else {
                $('.mensahe').html('Your email is invalid');
                $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                exit();
            }
                
            $('#spansubdealeremailadd').html(email);
            $('#spansubdealerclientname').html(name);
            $('#spansubdealerclientemailadd').html(clientEmail);
            $('#spansubdealerclientcontact').html(contact);
            $('#spansubdealerclientpayment').html(previewpayment);

            $('.subdealerFirstview').hide();
            $('.subdealerSecondview').show();
        }

    });

    $('.btnbuycodeSubdealerback').click(function(){
        $('.subdealerFirstview').show();
        $('.subdealerSecondview').hide();
    });

    $('.btnbuycodeSubdealerconfirm').click(function(){

        var btn         = $('.btnbuycodeSubdealerconfirm').val();
        var country     = $('#subdealerCountry').val();
        var email       = $('#subdealeryourEmail').val();
        var name        = $('#subdealerclientName').val();
        var clientEmail = $('#subdealerclientEmail').val();
        var contact     = $('#subdealercontact').val();
        var payment     = $('#subdealerPayment').val();

        $('.mensahe').html('Processing..');
        $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();

        $('.btnbuycodeSubdealerconfirm').attr('disabled',true);

            $.ajax({
                url:"buycodes_transact",
                type:"post",
                data:{btn:btn,country:country,email:email,name:name,clientEmail:clientEmail,contact:contact,payment:payment},
                dataType:"json",
                success: function(data) {
                    // console.log(data);
                    if(data["S"] == 1) {
                       
                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                        $('.subdealerThirdview').show();
                        $('.subdealerSecondview').hide();
                        $('#subdealeremailwithcodes').html(clientEmail);
                        $('.emailsentsuccess').show();
                        $('input[name="subdealer_package"]').val(data['TN']);
                        $('input[name="generatedRegcode"]').val(data['R']);
                    }
                    else {

                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                    }
                    $('.btnbuycodeSubdealerconfirm').removeAttr('disabled');

                }

            });

    });
    // Sub dealer End

    // Pinoy Dealer Start
    $('.btnbuycodePinoy').click(function(){

        var btn         = $('.btnbuycodePinoy').val();
        var country     = $('#pinoyCountry').val();
        var email       = $('#pinoyyourEmail').val();
        var name        = $('#pinoyclientName').val();
        var clientEmail = $('#pinoyclientEmail').val();
        var contact     = $('#pinoycontact').val();
        var payment     = $('#pinoyPayment').val();

        console.log(btn+'|'+country+'|'+email+'|'+name+'|'+clientEmail+'|'+contact+'|'+payment);

        if(payment == 1) {
           var previewpayment = 'ECASH';
        }

        if(email == null || email == "")
        {
            $('.mensahe').html('Your email must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(name == null || name == "")
        {
            $('.mensahe').html('Client name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(clientEmail == null || clientEmail == "")
        {
            $('.mensahe').html('Client email must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(contact == null || contact == "")
        {
            $('.mensahe').html('Contact number must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else 
        {
            
            if(validateEmail(clientEmail)){ } else {
                $('.mensahe').html('Client email is invalid');
                $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                exit();
            }

            if(validateEmail(email)){ } else {
                $('.mensahe').html('Your email is invalid');
                $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                exit();
           }
                
            $('#spanpinoyemailadd2').html(email);
            $('#spanpinoyclientname2').html(name);
            $('#spanpinoyclientemailadd2').html(clientEmail);
            $('#spanpinoyclientcontact2').html(contact);
            $('#spanpinoyclientpayment2').html(previewpayment);

            $('.pinoyFirstview').hide();
            $('.pinoySecondview').show();
        }

    });

    $('.btnbuycodePinoyback').click(function(){
        $('.pinoyFirstview').show();
        $('.pinoySecondview').hide();
    });

    $('.btnbuycodePinoyconfirm').click(function(){

        var btn         = $('.btnbuycodePinoyconfirm').val();
        var country     = $('#pinoyCountry').val();
        var email       = $('#pinoyyourEmail').val();
        var name        = $('#pinoyclientName').val();
        var clientEmail = $('#pinoyclientEmail').val();
        var contact     = $('#pinoycontact').val();
        var payment     = $('#pinoyPayment').val();

        $('.mensahe').html('Processing..');
        $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();

        $('.btnbuycodePinoyconfirm').attr('disabled',true);

            $.ajax({
                url:"buycodes_transact",
                type:"post",
                data:{btn:btn,country:country,email:email,name:name,clientEmail:clientEmail,contact:contact,payment:payment},
                dataType:"json",
                success: function(data) {
                    //console.log(data);
                    if(data["S"] == 1) {
                       
                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                        $('.pinoyThirdview').show();
                        $('.pinoySecondview').hide();
                        $('#pinoyemailwithcodes').html(clientEmail);
                        $('.emailsentsuccess').show();
                        $('input[name="pinoydealer_package"]').val(data['TN']);
                        $('input[name="generatedRegcode"]').val(data['R']);
                    }
                    else {

                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                    }
                    $('.btnbuycodePinoyconfirm').removeAttr('disabled');

                }

            });

    });
    // Pinoy dealer End

    // Global Dealer Start
    $('.btnbuycodeGlobal').click(function(){

        var btn         = $('.btnbuycodeGlobal').val();
        var country     = $('#globalCountry').val();
        var email       = $('#globalyourEmail').val();
        var name        = $('#globalclientName').val();
        var clientEmail = $('#globalclientEmail').val();
        var contact     = $('#globalcontact').val();
        var payment     = $('#globalPayment').val();

        if(payment == 1) {
           var previewpayment = 'ECASH';
        }

        if(email == null || email == "")
        {
            $('.mensahe').html('Your email must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(name == null || name == "")
        {
            $('.mensahe').html('Client name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(clientEmail == null || clientEmail == "")
        {
            $('.mensahe').html('Client email must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(contact == null || contact == "")
        {
            $('.mensahe').html('Contact number must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else 
        {
            
            if(validateEmail(clientEmail)){ } else {
                $('.mensahe').html('Client email is invalid');
                $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                exit();
            }

            if(validateEmail(email)){ } else {
                $('.mensahe').html('Your email is invalid');
                $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                exit();
            }
                
            $('#spanglobalemailadd').html(email);
            $('#spanglobalclientname').html(name);
            $('#spanglobalclientemailadd').html(clientEmail);
            $('#spanglobalclientcontact').html(contact);
            $('#spanglobalclientpayment').html(previewpayment);

            $('.globalFirstview').hide();
            $('.globalSecondview').show();
        }

    });

    $('.btnbuycodeGlobalback').click(function(){
        $('.globalFirstview').show();
        $('.globalSecondview').hide();
    });

    $('.btnbuycodeGlobalconfirm').click(function(){

        var btn         = $('.btnbuycodeGlobalconfirm').val();
        var country     = $('#globalCountry').val();
        var email       = $('#globalyourEmail').val();
        var name        = $('#globalclientName').val();
        var clientEmail = $('#globalclientEmail').val();
        var contact     = $('#globalcontact').val();
        var payment     = $('#globalPayment').val();

        $('.mensahe').html('Processing..');
        $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();

        $('.btnbuycodeGlobalconfirm').attr('disabled',true);

            $.ajax({
                url:"buycodes_transact",
                type:"post",
                data:{btn:btn,country:country,email:email,name:name,clientEmail:clientEmail,contact:contact,payment:payment},
                dataType:"json",
                success: function(data) {
                    //console.log(data);
                    if(data["S"] == 1) {
                       
                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                        $('.globalThirdview').show();
                        $('.globalSecondview').hide();
                        $('#globalemailwithcodes').html(clientEmail);
                        $('.emailsentsuccess').show();
                        $('input[name="globaldealer_package"]').val(data['TN']);
                        $('input[name="generatedRegcode"]').val(data['R']);
                    }
                    else {

                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                    }
                    $('.btnbuycodeGlobalconfirm').removeAttr('disabled');
                }

            });

    });
    // Global dealer End

	
	// Tangible Global Start

    $('.btnTangibleGlobal').click(function(){

        var btn         = $('.btnTangibleGlobal').val();
        var country     = $('#TangibleCountry').val();
        var email       = $('#TangibleyourEmail').val();
        var name        = $('#TangibleclientName').val();
        var clientEmail = $('#TangibleclientEmail').val();
        var contact     = $('#Tangiblecontact').val();
        var payment     = $('#TangiblePayment').val();
        var outlet      = $("select[name='pickup_outlet']").val();
        var tangibleglobal = $("input[name='tangibleglobal']:checked").val();
            
            // alert(outlet);
        if(payment == 1) {
           var previewpayment = 'ECASH';
        }

        if(email == null || email == "")
        {
            $('.mensahe').html('Your email must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(name == null || name == "")
        {
            $('.mensahe').html('Client name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(clientEmail == null || clientEmail == "")
        {
            $('.mensahe').html('Client email must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(contact == null || contact == "")
        {
            $('.mensahe').html('Contact number must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(outlet == null || outlet == "")
        {
            $('.mensahe').html('Pickup Outlet must be selected');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(tangibleglobal == null || tangibleglobal == "")
        {
            $('.mensahe').html('Tangible Global must be selected');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else 
        {
            
            if(validateEmail(clientEmail)){ } else {
                $('.mensahe').html('Client email is invalid');
                $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                exit();
            }

            if(validateEmail(email)){ } else {
                $('.mensahe').html('Your email is invalid');
                $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                exit();
            }
                
            $('#spanpinoyemailadd').html(email);
            $('#spanpinoyclientname').html(name);
            $('#spanpinoyclientemailadd').html(clientEmail);
            $('#spanpinoyclientcontact').html(contact);
            $('#spanpinoytangible').html(tangibleglobal);
            $('#spanpinoyclientpayment').html(previewpayment);
            $('#spanpinoyoutlet').html(outlet);

            $('.pinoyFirstview').hide();
            $('.pinoySecondview').show();
        }

    });

    $('.btnTangibleGlobalback').click(function(){
        $('.pinoyFirstview').show();
        $('.pinoySecondview').hide();
    });

    $('.btnTangibleGlobalconfirm').click(function(){

        var btn         = $('.btnTangibleGlobalconfirm').val();
        var country     = $('#TangibleCountry').val();
        var email       = $('#TangibleyourEmail').val();
        var name        = $('#TangibleclientName').val();
        var clientEmail = $('#TangibleclientEmail').val();
        var contact     = $('#Tangiblecontact').val();
        var payment     = $('#TangiblePayment').val();
        var outlet      = $("select[name='pickup_outlet']").val();
        var tangible    = $("input[name='tangibleglobal']:checked").val();

            // alert(outlet);
        $('.mensahe').html('Processing..');
        $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();

        $('.btnTangibleGlobalconfirm').attr('disabled',true);

            $.ajax({
                url:"buycodes_transact",
                type:"post",
                data:{outlet:outlet,tangible:tangible,btn:btn,country:country,email:email,name:name,clientEmail:clientEmail,contact:contact,payment:payment},
                dataType:"json",
                success: function(data) {
                    //console.log(data);
                    if(data["EM"] == 1) {
                       
                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                        $('.pinoyThirdview').show();
                        $('.pinoySecondview').hide();
                        $('#pinoyemailwithcodes').html(clientEmail);
                        $('.emailsentsuccess').show();
                        $('input[name="pinoydealer_package"]').val(data['TN']);
                        $('input[name="generatedRegcode"]').val(data['R']);
                    }
                    else {

                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                    }
                    $('.btnbuycodePinoyconfirm').removeAttr('disabled');

                }

            });

    });
    // Tangible Global End



    // Tangible Dealer Start

    $('.btnTangibleDealer').click(function(){

        var btn         = $('.btnTangibleDealer').val();
        var country     = $('#DealerTangibleCountry').val();
        var email       = $('#DealerTangibleyourEmail').val();
        var name        = $('#DealerTangibleclientName').val();
        var clientEmail = $('#DealerTangibleclientEmail').val();
        var contact     = $('#DealerTangiblecontact').val();
        var payment     = $('#DealerTangiblePayment').val();
        var outlet      = $("select[name='Dpickup_outlet']").val();
        var tangibleDealer = $("input[name='tangibleDealer']:checked").val();
            // alert(outlet);
        if(payment == 1) {
           var previewpayment = 'ECASH';
        }

        if(email == null || email == "")
        {
            $('.mensahe').html('Your email must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(name == null || name == "")
        {
            $('.mensahe').html('Client name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(clientEmail == null || clientEmail == "")
        {
            $('.mensahe').html('Client email must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(contact == null || contact == "")
        {
            $('.mensahe').html('Contact number must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(outlet == null || outlet == "")
        {
            $('.mensahe').html('Pickup Outlet must be selected');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(tangibleDealer == null || tangibleDealer == "")
        {
            $('.mensahe').html('Tangible Global must be selected');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else 
        {
            
            if(validateEmail(clientEmail)){ } else {
                $('.mensahe').html('Client email is invalid');
                $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                exit();
            }

            if(validateEmail(email)){ } else {
                $('.mensahe').html('Your email is invalid');
                $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                exit();
            }
                
            $('#spanDealeremailadd').html(email);
            $('#spanDealerclientname').html(name);
            $('#spanDealerclientemailadd').html(clientEmail);
            $('#spanDealerclientcontact').html(contact);
            $('#spanDealertangible').html(tangibleDealer);
            $('#spanDealerclientpayment').html(previewpayment);
            $('#spanDealeroutlet').html(outlet);

            $('.pinoyFirstview').hide();
            $('.pinoySecondview').show();
        }

    });

    $('.btnTangibleGlobalback').click(function(){
        $('.pinoyFirstview').show();
        $('.pinoySecondview').hide();
    });

    $('.btnTangibleDealerconfirm').click(function(){

        var btn         = $('.btnTangibleDealerconfirm').val();
        var country     = $('#DealerTangibleCountry').val();
        var email       = $('#DealerTangibleyourEmail').val();
        var name        = $('#DealerTangibleclientName').val();
        var clientEmail = $('#DealerTangibleclientEmail').val();
        var contact     = $('#DealerTangiblecontact').val();
        var payment     = $('#DealerTangiblePayment').val();
        var outlet      = $("select[name='Dpickup_outlet']").val();
        var tangible    = $("input[name='tangibleDealer']:checked").val();
            // alert(outlet);
        $('.mensahe').html('Processing..');
        $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();

        $('.btnTangibleGlobalconfirm').attr('disabled',true);

            $.ajax({
                url:"buycodes_transact",
                type:"post",
                data:{outlet:outlet,tangible:tangible,btn:btn,country:country,email:email,name:name,clientEmail:clientEmail,contact:contact,payment:payment},
                dataType:"json",
                success: function(data) {
                    //console.log(data);
                    if(data["EM"] == 1) {
                       
                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                        $('.pinoyThirdview').show();
                        $('.pinoySecondview').hide();
                        $('#pinoyemailwithcodes').html(clientEmail);
                        $('.emailsentsuccess').show();
                        $('input[name="pinoydealer_package"]').val(data['TN']);
                        $('input[name="generatedRegcode"]').val(data['R']);
                    }
                    else {

                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                    }
                    $('.btnTangibleGlobalconfirm').removeAttr('disabled');

                }

            });

    });
    // Tangible Dealer End

	
    function validateEmail(email){
        var emailReg = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        var valid = emailReg.test(email);

        if(!valid) {
            return false;
        } else {
            return true;
        }
    }

    // End Buy Codes

	// Start e-Cash
	$('#sendloadfund').on('click','.btnloadfund',function(){
	
        $('html, body').animate({scrollTop:0}, 'slow');
		var btn       = $(".btnloadfund").val();        
		var amount    = $('.tab-content').find("div.active").find('input[name="amount1"]').val();
		// var pass      = $('.tab-content').find("div.active").find('input[name="pass1"]').val();

        if(amount == null || amount == "")
        {
            $('.mensahe').html('Amount must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
            
            $('.btnloadfund').removeAttr("disabled");
            $('#sendloadfund').empty();
            $('.mensahe').html('Kindly review the correctness of data shown below: ');
            $('.flasher').addClass('alert-info animated fadeInLeft').removeClass('alert-danger alert-success').fadeIn();
            
            var charge = 0;
            var total  = parseFloat(amount) + parseFloat(charge);
            
            $('#sendloadfund').append(
                    '<div class="form-group">'+
                        '<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Amount : <span class="text-warning">*</span></label>'+
                        '<div class="col-md-12 col-lg-7">'+
                            '<input readonly="readonly" name="amount" type="text" placeholder="Amount" style="font-weight: bold" value="'+amount+'" class="form-control amount" id="amount" required="">'+
                            // '<input readonly="readonly" name="pass" type="hidden" placeholder="Tracking Number" style="font-weight: bold" value="'+pass+'" class="form-control pass" id="pass" required="">'+
                        '</div>'+                                   
                    '</div>'+
                    '<div class="form-group">'+
                        '<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Charge : <span class="text-warning">*</span></label>'+
                        '<div class="col-md-12 col-lg-7">'+
                            '<input readonly="readonly" name="charge" type="text" placeholder="Charge" value="'+charge+'" class="form-control charge" id="charge" required="">'+
                        '</div>'+                                   
                    '</div>'+
                    '<div class="form-group">'+
                        '<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Total Amount :</label>'+
                        '<div class="col-md-12 col-lg-7">'+
                            '<input readonly="readonly" name="total" type="text" placeholder="Total Amount" style="font-weight: bold" value="'+total+'" class="form-control total" id="total" required="">'+
                        '</div>'+                                   
                    '</div>'+
                    '<div class="form-group">'+
                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">Transaction Password : </label>'+
                        '<div class="col-md-12 col-lg-7">'+
                            '<input name="pass" type="password" placeholder="Transaction Password" class="form-control animated flipInY delay125s" id="pass" required="">'+
                        '</div>'+
                    '</div>'+
                    '<div class="form-group">'+
                        '<div class="col-md-12 col-lg-12">'+
                          '<button value="btnpayoutConfirmloadfund" id="btnpayoutConfirmloadfund" class="btn btn-primary btnpayoutConfirmloadfund pull-right">Confirm</button>'+
                          '<button value="btnpayoutCancelloadfund" id="btnpayoutCancelloadfund" class="btn btn-danger btnpayoutCancelloadfund pull-right">Cancel</button>'+
                        '</div>'+
                    '</div>'//+
                    /*'<div class="form-group">'+
                        '<div class="col-md-12 col-lg-12 text-center">'+
                            '<em><strong class="text-warning">Note: This process is IRREVERSIBLE. Double-Check the data before you proceed.</strong></em>'+
                        '</div>'+                                   
                    '</div>'*/
                );
        }
	});

    
    $('#sendloadfund').on('click','.btnpayoutConfirmloadfund',function(){

        // $('html, body').block({ 
        //         message: '<img src="../assets/images/gif/loading81.gif">',
        //          // css: { border: '3px solid #a00' }
        //     });   
        $('html, body').animate({scrollTop:0}, 'slow');   
          
        var btn                 = $(".btnpayoutConfirmloadfund").val();        
        var amount              = $('.tab-content').find("div.active").find('input[name="amount"]').val();
        var charge              = $('.tab-content').find("div.active").find('input[name="charge"]').val();
        var total               = $('.tab-content').find("div.active").find('input[name="total"]').val();
        var pass                = $('.tab-content').find("div.active").find('input[name="pass"]').val();
        
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });

        if(pass == null || pass == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
            // $('html, body').unblock(); 
        }
        else{
            $('.btnpayoutConfirmloadfund').attr('disabled',true);
            
            $.ajax({
                url:"ecash_receiveData",
                type:"post",
                data:{btn:btn, amount:amount, charge:charge, total:total, pass:pass},
                dataType:"json",
                success: function(data) {
                    // console.log(data);
                   
                    if(data["S"] == 1) {
                         // $('html, body').unblock(); 
                        $('.mensahe').html(data['M']);
                        $('.flasher').addClass('alert-success').removeClass('alert-danger alert-info').fadeIn().delay(8000);
                        $('#sendloadfund').empty();
                        $('#sendloadfund').append(
                            '<div class="form-group">'+
                                '<label class="col-md-12 col-lg-5 control-label animated bounceInUp delay025s" for="">Reference Number : </label>'+
                                '<div class="col-md-12 col-lg-7">'+
                                    '<input type="text" readonly="readonly" id="interRef" class="form-control loadfundsend animated bounceInDown delay025s" value="'+data['TN']+'" placeholder="Reference No" name="loadfundsend">'+
                                '</div>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<div class="col-md-12 col-lg-12">'+
                                    '<form action="../file_generator/loadfundsend_pdf" target="_blank" id="smart_form" method="POST">'+
                                        '<input type="hidden" readonly="readonly" id="interRef" class="form-control loadfundsend animated bounceInDown delay025s" value="'+data['TN']+'" placeholder="Reference No" name="loadfundsend">'+
                                        '<button value="btnsendPrintLoadFund" id="btnsendPrintLoadFund" target="_blank" class="btn btn-primary btnsendPrintLoadFund pull-right">Print Receipt</button>'+
                                    '</form>'+
                                    '<button value="btnsendNewLoadFund" id="btnsendNewLoadFund" target="_blank" class="btn btn-info btnsendNewLoadFund pull-right">New Transaction</button>'+
                                '</div>'+
                            '</div>'
                            
                        );
                    }
                    else {
                        //$('html, body').unblock();         
                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
                        $('.btnpayoutConfirmloadfund').removeAttr("disabled");  
                    }   
                    $('.btnpayoutConfirmloadfund').removeAttr('disabled'); 
                    $('#myModal').modal('hide');
                }
            });
        }
    });


    $('#sendloadfund').on('click','.btnpayoutCancelloadfund',function(){
        location.reload(true);
        $('html, body').animate({scrollTop:0}, 'slow');
    });
		$('html, body').animate({scrollTop:0}, 'slow');
    $('#sendloadfund').on('click','.btnsendNewLoadFund',function(){
        location.reload(true);
        $('html, body').animate({scrollTop:0}, 'slow');
    });


	
    $('#sgdloadfund').on('click','.btnsgdloadfund',function(){
        $('html, body').animate({scrollTop:0}, 'slow');

		var btn       = $(".btnsgdloadfund").val();        
		var amount    = $('.tab-content').find("div.active").find('input[name="amount2"]').val();
		// var pass      = $('.tab-content').find("div.active").find('input[name="pass2"]').val();
        
        if(amount == null || amount == "")
        {
            $('.mensahe').html('Amount must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        // else if(pass == null || pass == "")
        // {
        //     $('.mensahe').html('Transaction password must be filled out');
        //     $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(3000).fadeOut();
        // }
        else{
             
    		$('.btnsgdloadfund').removeAttr("disabled");
            $('#sgdloadfund').empty();
            $('.mensahe').html('Kindly review the correctness of data shown below: ');
            $('.flasher').addClass('alert-info animated fadeInLeft').removeClass('alert-danger alert-success').fadeIn();
            
            $.ajax({
                    url:"ecash_receiveData",
                    type:"post",
                    data:{btn:btn, amount:amount},
                    dataType:"json",
                    success: function(data) {
  
                            var charge = 0;
                            var rate   = data['rate'];
                            var total  = parseFloat(amount) * parseFloat(rate);
                            $('#sgdloadfund').append(
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Amount : <span class="text-warning">*</span></label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input readonly="readonly" name="amount" type="text" placeholder="Amount" style="font-weight: bold" value="'+amount+'" class="form-control amount" id="amount" required="">'+
                                            // '<input readonly="readonly" name="pass" type="hidden" placeholder="Tracking Number" style="font-weight: bold" value="'+pass+'" class="form-control pass" id="pass" required="">'+
                                        '</div>'+                                   
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Charge : <span class="text-warning">*</span></label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input readonly="readonly" name="charge" type="text" placeholder="Charge" value="'+charge+'" class="form-control charge" id="charge" required="">'+
                                        '</div>'+                                   
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Total Ecash Amount :</label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input readonly="readonly" name="total" type="text" placeholder="Total Amount" style="font-weight: bold" value="'+total+'" class="form-control total" id="total" required="">'+
                                        '</div>'+                                   
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">Transaction Password : </label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input name="pass" type="password" placeholder="Transaction Password" class="form-control animated flipInY delay125s" id="pass" required="">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<div class="col-md-12 col-lg-12">'+
                                          '<button value="btnpayoutSGDloadfundConfirm" id="btnpayoutSGDloadfundConfirm" class="btn btn-primary btnpayoutSGDloadfundConfirm pull-right">Confirm</button>'+
                                          '<button value="btnpayoutSGDloadfundCancel" id="btnpayoutSGDloadfundCancel" class="btn btn-danger btnpayoutSGDloadfundCancel pull-right">Cancel</button>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<div class="col-md-12 col-lg-12 text-center">'+
                                            '<em><strong class="text-warning">Note: This process is IRREVERSIBLE. Double-Check the data before you proceed.</strong></em>'+
                                        '</div>'+                                   
                                    '</div>'
                                );
							}
                    });
            }
	});

    
    $('#sgdloadfund').on('click','.btnpayoutSGDloadfundConfirm',function(){
        $('html, body').animate({scrollTop:0}, 'slow');       
        var btn                 = $(".btnpayoutSGDloadfundConfirm").val();        
        var amount              = $('.tab-content').find("div.active").find('input[name="amount"]').val();
        var charge              = $('.tab-content').find("div.active").find('input[name="charge"]').val();
        var total               = $('.tab-content').find("div.active").find('input[name="total"]').val();
        var pass                = $('.tab-content').find("div.active").find('input[name="pass"]').val();
        
        if(pass == null || pass == "")
        {
            $('.mensahe').html('Password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
            $('.mensahe').html('Processing..');
            $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();
            
            $.ajax({
                url:"ecash_receiveData",
                type:"post",
                data:{btn:btn, amount:amount, charge:charge, total:total, pass:pass},
                dataType:"json",
                success: function(data) {
                    // console.log(data);
                    if(data["S"] == 1) {
                        $('.mensahe').html(data['M']);
                        $('.flasher').addClass('alert-success').removeClass('alert-danger alert-info').fadeIn().delay(8000);
                        $('#sgdloadfund').empty();
                        $('#sgdloadfund').append(
                            '<div class="form-group">'+
                                '<label class="col-md-12 col-lg-5 control-label animated bounceInUp delay025s" for="">Reference Number : </label>'+
                                '<div class="col-md-12 col-lg-7">'+
                                    '<input type="text" readonly="readonly" id="interRef" class="form-control SGDloadfund animated bounceInDown delay025s" value="'+data['TN']+'" placeholder="Reference No" name="SGDloadfund">'+
                                '</div>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<div class="col-md-12 col-lg-12">'+
                                    '<form action="../file_generator/SGDloadfundsend_pdf" target="_blank" id="smart_form" method="POST">'+
                                        '<input type="hidden" readonly="readonly" id="interRef" class="form-control SGDloadfund animated bounceInDown delay025s" value="'+data['TN']+'" placeholder="Reference No" name="SGDloadfund">'+
                                        '<button value="btnsendPrintSGDloadfund" id="btnsendPrintSGDloadfund" target="_blank" class="btn btn-primary btnsendPrintSGDloadfund pull-right">Print Receipt</button>'+
                                    '</form>'+
                                    '<button value="btnsendNewSGDloadfund" id="btnsendNewSGDloadfund" target="_blank" class="btn btn-info btnsendNewSGDloadfund pull-right">New Transaction</button>'+
                                '</div>'+
                            '</div>'
                            
                        );
                    }
                    else {

                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
                        $('.btnpayoutSGDloadfundConfirm').removeAttr("disabled");  
                    }    
                }
            });
        }
    });

    
    $('#sgdloadfund').on('click','.btnpayoutSGDloadfundCancel',function(){
        location.reload(true);
        $('html, body').animate({scrollTop:0}, 'slow');
    });
        $('html, body').animate({scrollTop:0}, 'slow');
    $('#sgdloadfund').on('click','.btnsendNewSGDloadfund',function(){
        location.reload(true);
        $('html, body').animate({scrollTop:0}, 'slow');
    });
    
		// $('html, body').animate({scrollTop:0}, 'slow');


	
//Added by Merson
    //AED FUND
        $('#aedfund').on('click','.btnaedfund',function(){
		
            $('html, body').animate({scrollTop:0}, 'slow');
        //alert('safddsf');
            var btn       = $(".btnaedfund").val();        
            var amount    = $('.tab-content').find("div.active").find('input[name="AED_amount"]').val();
            // var pass      = $('.tab-content').find("div.active").find('input[name="pass2"]').val();
            
            if(amount == null || amount == "")
            {
                $('.mensahe').html('Amount must be filled out');
                $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
            }
            // else if(pass == null || pass == "")
            // {
            //     $('.mensahe').html('Transaction password must be filled out');
            //     $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(3000).fadeOut();
            // }
            else{
                 
                $('.btnaedfund').removeAttr("disabled");
                $('#aedfund').empty();
                $('.mensahe').html('Kindly review the correctness of data shown below: ');
                $('.flasher').addClass('alert-info animated fadeInLeft').removeClass('alert-danger alert-success').fadeIn();
                
                $.ajax({
                        url:"ecash_receiveData",
                        type:"post",
                        data:{btn:btn, amount:amount},
                        dataType:"json",
                        success: function(data) {
			
                                var charge = 0;
                                var rate   = data['rate'];
                                var total  = parseFloat(amount) * parseFloat(rate);
                                var formattedAmount = total.toFixed(2);
                                
                                $('#aedfund').append(
                                        '<div class="form-group">'+
                                            '<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Amount : <span class="text-warning">*</span></label>'+
                                            '<div class="col-md-12 col-lg-7">'+
												'<label>AED</label>'+
                                                '<input readonly="readonly" name="AED_amount" type="text" placeholder="Amount" style="font-weight: bold; display:inline-block; width:93%; margin-left:10px;" value="'+amount+'" class="form-control AED_amount" id="AED_amount" required="">'+
                                                // '<input readonly="readonly" name="pass" type="hidden" placeholder="Tracking Number" style="font-weight: bold" value="'+pass+'" class="form-control pass" id="pass" required="">'+
                                            '</div>'+                                   
                                        '</div>'+
                                        '<div class="form-group">'+
                                            '<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Charge : <span class="text-warning">*</span></label>'+
                                            '<div class="col-md-12 col-lg-7">'+
                                                '<input readonly="readonly" name="AED_charge" type="text" placeholder="Charge" style="width:93%; margin-left:34px;" value="'+charge+'" class="form-control AED_charge" id="AED_charge" required="">'+
                                            '</div>'+                                   
                                        '</div>'+
                                        '<div class="form-group">'+
                                            '<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Total Ecash Amount :</label>'+
                                            '<div class="col-md-12 col-lg-7">'+
												'<label>PHP</label>'+
                                                '<input readonly="readonly" name="AED_total" type="text" placeholder="Total Amount" style="font-weight: bold; display:inline-block; width:93%; margin-left:10px;" value="'+formattedAmount+'" class="form-control AED_total" id="AED_total" required="">'+
                                            '</div>'+                                   
                                        '</div>'+
                                        '<div class="form-group">'+
                                            '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">Transaction Password : </label>'+
                                            '<div class="col-md-12 col-lg-7">'+
                                                '<input name="AED_pass" type="password" placeholder="Transaction Password" style="width:93%; margin-left:34px;" class="form-control animated flipInY delay125s" id="AED_pass" required="">'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="form-group">'+
                                            '<div class="col-md-12 col-lg-12">'+
											  '<label style="color:red; margin-left:230px;"><i>Note : Please put the currency AED</i></label>'+
                                              '<button value="btnpayoutaedfundConfirm" id="btnpayoutaedfundConfirm" class="btn btn-primary btnpayoutaedfundConfirm pull-right">Confirm</button>'+
                                              '<button value="btnpayoutaedfundCancel" id="btnpayoutaedfundCancel" class="btn btn-danger btnpayoutaedfundCancel pull-right">Cancel</button>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="form-group">'+
                                            '<div class="col-md-12 col-lg-12 text-center">'+
                                                '<em><strong class="text-warning">Note: This process is IRREVERSIBLE. Double-Check the data before you proceed.</strong></em>'+
                                            '</div>'+                                   
                                        '</div>'
                                    );
                                }
                        });
                }
        });
        

        $('#aedfund').on('click','.btnpayoutaedfundConfirm',function(){
        $('html, body').animate({scrollTop:0}, 'slow');   
          
        var btn                 = $(".btnpayoutaedfundConfirm").val();        
        var amount              = $('.tab-content').find("div.active").find('input[name="AED_amount"]').val();
        var charge              = $('.tab-content').find("div.active").find('input[name="AED_charge"]').val();
        var total               = $('.tab-content').find("div.active").find('input[name="AED_total"]').val();
        var pass                = $('.tab-content').find("div.active").find('input[name="AED_pass"]').val();
        
        // if(pass == null || pass == "")
        // {
        //     $('.mensahe').html('Amount must be filled out');
        //     $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
            
        // }
        // else{
        //     $('.btnpayoutaedfundConfirm').attr('disabled',true);
        //     $('.mensahe').html('Processing..');
        //     $('.flasher').addClass('alert-info animated fadeInLeft').removeClass('alert-danger alert-success').fadeIn();
      
        $('.mensahe').html('Processing..');
        $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();

        $('.btnpayoutaedfundConfirm').attr('disabled',true);


            $.ajax({
                url:"ecash_receiveData",
                type:"post",
                data:{btn:btn, amount:amount, charge:charge, total:total, pass:pass},
                dataType:"json",
                success: function(data) {
                    // console.log(data);
                   console.log(data);
                    if(data["success"] == 1 || data["S"] == 1) {
                         // $('html, body').unblock(); 
                        $('.mensahe').html(data['message']);
                        $('.flasher').addClass('alert-success').removeClass('alert-danger alert-info').fadeIn().delay(8000);
                        $('#aedfund').empty();
                        $('#aedfund').append(
                            '<div class="form-group">'+
                                '<label class="col-md-12 col-lg-5 control-label animated bounceInUp delay025s" for="">Reference Number : </label>'+
                                '<div class="col-md-12 col-lg-7">'+
                                    '<input type="text" readonly="readonly" id="interRef" class="form-control loadfundsend animated bounceInDown delay025s" value="'+data['id']+'" placeholder="Reference No" name="AEDfundsend">'+
                                '</div>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<div class="col-md-12 col-lg-12">'+
                                    '<form action="../file_generator/AEDfundsend_pdf" target="_blank" id="smart_form" method="POST">'+
                                        '<input type="hidden" readonly="readonly" id="interRef" class="form-control AEDfundsend animated bounceInDown delay025s" value="'+data['id']+'" placeholder="Reference No" name="AEDfundsend">'+
                                        '<button value="btnsendeadFund" id="btnsendeadFund" target="_blank" class="btn btn-primary btnsendeadFund pull-right">Print Receipt</button>'+
                                    '</form>'+
                                    '<button value="btnsendNewaedFund" id="btnsendNewaedFund" target="_blank" class="btn btn-info btnsendNewaedFund pull-right">New Transaction</button>'+
                                '</div>'+
                            '</div>'
                            
                        );
                    }
                    else {
                        //$('html, body').unblock(); 
                            
                        $('.flasher').show();
                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
                        $('.btnpayoutaedfundConfirm').removeAttr("disabled");  
                    }   
                    $('.btnpayoutaedfundConfirm').removeAttr('disabled'); 
                }
            });
        // }
    });

    $('#aedfund').on('click','.btnpayoutaedfundCancel',function(){
        location.reload(true);
        $('html, body').animate({scrollTop:0}, 'slow');
    });
        $('html, body').animate({scrollTop:0}, 'slow');
    $('#aedfund').on('click','.btnsendNewaedFund',function(){
        location.reload(true);
        $('html, body').animate({scrollTop:0}, 'slow');
    });
        
    //AED FUND
	
	
	//Etisalat
    $('#etisalatprod').on('click','.btnEtisalatprod',function(){
        $('html, body').animate({scrollTop:0}, 'slow');
            //alert('asdfdasd');
        var btn       = $(".btnEtisalatprod").val();        
        var mobile    = $('.tab-content').find("div.active").find('input[name="eti_mobileno"]').val();
        var product   = $('.tab-content').find("div.active").find('select[name="etisalat_product"]').val();
        var amount    = $('.tab-content').find("div.active").find('input[name="eti_amount"]').val();
        // var pass      = $('.tab-content').find("div.active").find('input[name="pass2"]').val();
        
        if(product == null || product == "")
        {
            $('.mensahe').html('Etisalat Product must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(3000).fadeOut();
        }
        else if(amount == null || amount == "")
        {
            $('.mensahe').html('Amount must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
             
            // $('.mensahe').html('Processing..');
            // $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();

            $('#etisalatprod').attr('btnEtisalatprod',true);
            
            $.ajax({
                        url:"etisalat_receiveData",
                        type:"post",
                        data:{btn:btn, mobile:mobile, product:product, amount:amount},
                        dataType:"json",
                        success: function(data) {
                            console.log(data);

                        if(data["message"] == 'SUCCESSFUL') {
                           $('.mensahe').html('STEP 2...ENTER TRANSACTION PASSWORD!');
                           $('.flasher').addClass('alert-success').removeClass('alert-danger alert-info').fadeIn().delay(8000);
                           $('#etisalatprod').empty();
                           $('#etisalatprod').append(
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Mobile Number : </label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input readonly="readonly" name="mobile" type="text" placeholder="mobile" style="font-weight: bold" value="'+mobile+'" class="form-control mobile" id="mobile" required="">'+
                                            // '<input readonly="readonly" name="pass" type="hidden" placeholder="Tracking Number" style="font-weight: bold" value="'+pass+'" class="form-control pass" id="pass" required="">'+
                                        '</div>'+                                   
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Product : <span class="text-warning">*</span></label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input readonly="readonly" name="product" type="text" placeholder="product" style="font-weight: bold" value="'+product+'" class="form-control product" id="product" required="">'+
                                            // '<input readonly="readonly" name="pass" type="hidden" placeholder="Tracking Number" style="font-weight: bold" value="'+pass+'" class="form-control pass" id="pass" required="">'+
                                        '</div>'+                                   
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Amount : <span class="text-warning">*</span></label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input readonly="readonly" name="amount" type="text" placeholder="Amount" style="font-weight: bold" value="'+amount+'" class="form-control amount" id="amount" required="">'+
                                            // '<input readonly="readonly" name="pass" type="hidden" placeholder="Tracking Number" style="font-weight: bold" value="'+pass+'" class="form-control pass" id="pass" required="">'+
                                        '</div>'+                                   
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">Transaction Password : </label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input name="pass" type="password" placeholder="Transaction Password" class="form-control animated flipInY delay125s" id="pass" required="">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<div class="col-md-12 col-lg-12">'+
                                          '<button value="btnpayoutEtisalatConfirm" id="btnpayoutEtisalatConfirm" class="btn btn-primary btnpayoutEtisalatConfirm pull-right">Confirm</button>'+
                                          '<button value="btnpayoutEtisalatCancel" id="btnpayoutEtisalatCancel" class="btn btn-danger btnpayoutEtisalatCancel pull-right">Cancel</button>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<div class="col-md-12 col-lg-12 text-center">'+
                                            '<em><strong class="text-warning">Note: This process is IRREVERSIBLE. Double-Check the data before you proceed.</strong></em>'+
                                        '</div>'+                                   
                                    '</div>'
                                );
                            }
                             else {
                                //$('html, body').unblock(); 
                                    
                                $('.flasher').show();
                                $('.mensahe').html(data["message"]);
                                $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
                                $('.btnEtisalatprod').removeAttr("disabled");  
                            }   
                            $('.btnEtisalatprod').removeAttr('disabled'); 
                        }
                 });
        }
                
    });



    $('#etisalatprod').on('click','.btnpayoutEtisalatConfirm',function(){
        $('html, body').animate({scrollTop:0}, 'slow');       
        var btn                 = $(".btnpayoutEtisalatConfirm").val();        
        var mobile              = $('.tab-content').find("div.active").find('input[name="mobile"]').val();
        var product             = $('.tab-content').find("div.active").find('input[name="product"]').val();
        var amount              = $('.tab-content').find("div.active").find('input[name="amount"]').val();
        var pass                = $('.tab-content').find("div.active").find('input[name="pass"]').val();
        
        if(pass == null || pass == "")
        {
            $('.mensahe').html('Password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
            // $('.mensahe').html('Processing..');
            // $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();
            $('.btnpayoutEtisalatConfirm').attr('disabled',true);
            
            $.ajax({
                url:"etisalat_receiveData",
                type:"post",
                data:{btn:btn, mobile:mobile, product:product, amount:amount, pass:pass},
                dataType:"json",
                success: function(data) {
                    console.log(data);
                    if(data["message"] == 'SUCCESSFUL') {
                        $('.mensahe').html('SUCCESSFULLY LOADED!');
                        $('.flasher').addClass('alert-success').removeClass('alert-danger alert-info').fadeIn().delay(8000);
                        $('#etisalatprod').empty();
                        $('#etisalatprod').append(
                            '<div class="form-group">'+
                                '<label class="col-md-12 col-lg-5 control-label animated bounceInUp delay025s" for="">Reference Number : </label>'+
                                '<div class="col-md-12 col-lg-7">'+
                                    '<input type="text" readonly="readonly" id="interRef" class="form-control etisalat animated bounceInDown delay025s" value="'+data['trackno']+'" placeholder="Reference No" name="etisalat">'+
                                '</div>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<div class="col-md-12 col-lg-12">'+
                                    '<form action="../file_generator/Etisalat_pdf" target="_blank" id="smart_form" method="POST">'+
                                        '<input type="hidden" readonly="readonly" id="interRef" class="form-control etisalat animated bounceInDown delay025s" value="'+data['trackno']+'" placeholder="Reference No" name="etisalat">'+
                                        '<button value="btnsendPrintEtisalat" id="btnsendPrintEtisalat" target="_blank" class="btn btn-primary btnsendPrintEtisalat pull-right">Print Receipt</button>'+
                                    '</form>'+
                                    '<button value="btnsendNewEtisalat" id="btnsendNewEtisalat" target="_blank" class="btn btn-info btnsendNewEtisalat pull-right">New Transaction</button>'+
                                '</div>'+
                            '</div>'
                            
                        );
                    }else if(data["message"] == 'Successfully posted'){
                        $('.mensahe').html('TRANSACTION POSTED');
                        $('.flasher').addClass('alert-success').removeClass('alert-danger alert-info').fadeIn().delay(8000);
                        $('#etisalatprod').empty();
                        $('#etisalatprod').append(
                            '<div class="form-group">'+
                                '<label class="col-md-12 col-lg-5 control-label animated bounceInUp delay025s" for="">Reference Number : </label>'+
                                '<div class="col-md-12 col-lg-7">'+
                                    '<input type="text" readonly="readonly" id="interRef" class="form-control etisalat animated bounceInDown delay025s" value="'+data['trackno']+'" placeholder="Reference No" name="etisalat">'+
                                '</div>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<div class="col-md-12 col-lg-12">'+
                                    '<button value="btnsendNewEtisalat" id="btnsendNewEtisalat" target="_blank" class="btn btn-info btnsendNewEtisalat pull-right">New Transaction</button>'+
                                '</div>'+
                            '</div>'
                            
                        );
                    }else {

                        $('.mensahe').html(data["message"]);
                        $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
                        $('.btnpayoutEtisalatConfirm').removeAttr("disabled");  
                    }    
                }
            });
        }
    });

    $('#etisalatprod').on('click','.btnpayoutEtisalatCancel',function(){
        location.reload(true);
        $('html, body').animate({scrollTop:0}, 'slow');
    });
        $('html, body').animate({scrollTop:0}, 'slow');
    $('#etisalatprod').on('click','.btnsendNewEtisalat',function(){
        location.reload(true);
        $('html, body').animate({scrollTop:0}, 'slow');
    });

    //Etisalat
//Added by Merson	
		
		
		

    $('#ecash2ecashSend').on('click','.btnecash2ecash',function(){
	    $('html, body').animate({scrollTop:0}, 'slow');
		var btn       = $(".btnecash2ecash").val();        
		var regcode   = $('.tab-content').find("div.active").find('input[name="dealer_code"]').val();
		var amount    = $('.tab-content').find("div.active").find('input[name="amount3"]').val();

        if(regcode == null || regcode == "")
        {
            $('.mensahe').html('Regcode must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(amount == null || amount == "")
        {
            $('.mensahe').html('Amount must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{

    		$('.mensahe').html('Processing..');
            $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();      
        
    			$.ajax({
    				url:"ecash_receiveData",
    				type:"post",
    				data:{btn:btn,regcode:regcode,amount:amount},
    				dataType:"json",
    				success: function(data) {
    
    					if(data["S"] == 1) {
    						var total= parseFloat(amount) + 25;
    					    $('#ecash2ecashSend').empty();
    					    $('.mensahe').html('Kindly review the correctness of data shown below: ');
                            $('.flasher').addClass('alert-info animated fadeInLeft').removeClass('alert-danger alert-success').fadeIn();
                            $('.tab-content').find("div.active").find('input[name="dealer_code"]').val('');
                            $('.tab-content').find("div.active").find('input[name="amount3"]').val('');
                            $('.tab-content').find("div.active").find('input[name="pass3"]').val('');
    					    $('#ecash2ecashSend').append(
			                 	'<h5 class="hr2"><span>Sender</span></h5>'+                     
				                    '<div class="form-group">'+
				                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Name : <span class="text-warning">*</span></label>'+
				                        '<div class="col-md-12 col-lg-7">'+
				                            '<input readonly="readonly" value="'+data['sender']+'" name="sender_name" type="text" placeholder="Sender Full Name" class="form-control  animated flipInX delay050s" id="sender_name" required="">'+
				                        '</div>'+
				                    '</div>'+  
				                    '<div class="form-group">'+
				                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Address : <span class="text-warning">*</span></label>'+
				                        '<div class="col-md-12 col-lg-7">'+
				                            '<input readonly="readonly" value="'+data['sender_address']+'" name="sender_address" type="text" placeholder="Sender Address" class="form-control animated flipInX delay050s" id="sender_address" required="">'+
				                        '</div>'+
				                    '</div>'+                    
				                    '<div class="form-group">'+
				                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay075s">Mobile Number : <span class="text-warning">*</span></label>'+
				                        '<div class="col-md-12 col-lg-7">'+
				                            '<input readonly="readonly" value="'+data['sender_mobile']+'" name="sender_mobile" type="text" placeholder="Sender Mobile Number" class="form-control animated bounceInRight delay075s" id="sender_mobile" required="">'+
				                        '</div>'+
				                    '</div>'+
				                    '<div class="form-group">'+
				                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">Email : <span class="text-warning">*</span></label>'+
				                        '<div class="col-md-12 col-lg-7">'+
				                            '<input readonly="readonly" value="'+data['sender_email']+'" name="sender_email" type="text" placeholder="Sender Email" class="form-control animated flipInY delay125s" id="sender_email" required="">'+
				                        '</div>'+
				                    '</div>'+
				                    '<div class="clearfix"></div>'+
			                	 '<h5 class="hr2"><span>Beneficiary</span></h5>'+
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Dealer Regcode : <span class="text-warning">*</span></label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input readonly="readonly" value="'+data['regcode']+'" name="regcode" type="text" placeholder="Regcode" class="form-control animated flipInX delay050s" id="regcode" required="">'+
                                        '</div>'+
                                    '</div>'+
				                    '<div class="form-group">'+
				                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Name : <span class="text-warning">*</span></label>'+
				                        '<div class="col-md-12 col-lg-7">'+
				                            '<input readonly="readonly" value="'+data['beneficiary']+'" name="bene_name" type="text" placeholder="Beneficiary Full Name" class="form-control animated flipInX delay050s" id="bene_name" required="">'+
				                        '</div>'+
				                    '</div>'+  
				                    '<div class="form-group">'+
				                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Address : <span class="text-warning">*</span></label>'+
				                        '<div class="col-md-12 col-lg-7">'+
				                            '<input readonly="readonly" value="'+data['beneficiary_address']+'" name="bene_address" type="text" placeholder="Beneficiary Address" class="form-control animated flipInX delay050s" id="bene_address" required="">'+
				                        '</div>'+
				                    '</div>'+                    
				                    '<div class="form-group">'+
				                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay075s">Mobile Number : <span class="text-warning">*</span></label>'+
				                        '<div class="col-md-12 col-lg-7">'+
				                            '<input readonly="readonly" value="'+data['beneficiary_mobile']+'" name="bene_mobile" type="text" placeholder="Beneficiary Mobile Number" class="form-control animated bounceInRight delay075s" id="bene_mobile" required="">'+
				                        '</div>'+
				                    '</div>'+
				                    '<div class="form-group">'+
				                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">Email : <span class="text-warning">*</span></label>'+
				                        '<div class="col-md-12 col-lg-7">'+
				                            '<input readonly="readonly" value="'+data['beneficiary_email']+'" name="bene_email" type="text" placeholder="Beneficiary Email" class="form-control animated flipInY delay125s" id="bene_email" required="">'+
				                        '</div>'+
				                    '</div>'+
				                    '<div class="form-group">'+
				                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">Amount : <span class="text-warning">*</span></label>'+
				                        '<div class="col-md-12 col-lg-7">'+
				                            '<input readonly="readonly" value="'+amount+'" name="amount" type="text" placeholder="Amount" class="form-control numOnly animated flipInY delay125s" id="amount" required="">'+
				                        '</div>'+
				                    '</div>'+
				                    '<div class="form-group">'+
				                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">Charge : <span class="text-warning">*</span></label>'+
				                        '<div class="col-md-12 col-lg-7">'+
				                            '<input readonly="readonly" value="25" name="amount" type="text" placeholder="Amount" class="form-control numOnly animated flipInY delay125s" id="amount" required="">'+
				                        '</div>'+
				                    '</div>'+
				                    '<div class="form-group">'+
				                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">Total : <span class="text-warning">*</span></label>'+
				                        '<div class="col-md-12 col-lg-7">'+
				                            '<input readonly="readonly" value="'+total+'" name="amount" type="text" placeholder="Amount" class="form-control numOnly animated flipInY delay125s" id="amount" required="">'+
				                        '</div>'+
				                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">Transaction Password : <span class="text-warning">*</span></label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input value="" name="pass" type="password" placeholder="Transaction Password" class="form-control animated flipInY delay125s" id="password" required="">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<div class="col-md-12 col-lg-12">'+
                                          '<button value="btnsendecash2ecashConfirm" id="btnsendecash2ecashConfirm" class="btn btn-primary btnsendecash2ecashConfirm pull-right">Confirm</button>'+
                                          '<button value="btnsendCancelecash2ecash" id="btnsendCancelecash2ecash" class="btn btn-danger btnsendCancelecash2ecash pull-right">Cancel</button>'+
                                        '</div>'+
                                    '</div>'
    					    );
    
    					}
    					else {
    
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
    				
    					}
    
    				}
    
    			});
    		
        }
	});


    $('#ecash2ecashSend').on('click','.btnsendecash2ecashConfirm',function(){
        $('html, body').animate({scrollTop:0}, 'slow');
        var btn                 = $(".btnsendecash2ecashConfirm").val();        
        var regcode             = $('.tab-content').find("div.active").find('input[name="regcode"]').val();
        var amount              = $('.tab-content').find("div.active").find('input[name="amount"]').val();
        var pass                = $('.tab-content').find("div.active").find('input[name="pass"]').val();
        
        $('.mensahe').html('Processing..');
        $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();

        $('.btnsendecash2ecashConfirm').attr('disabled',true);
        
        $.ajax({
            url:"ecash_receiveData",
            type:"post",
            data:{btn:btn, regcode:regcode, amount:amount, pass:pass},
            dataType:"json",
            success: function(data) {
                //console.log(data);
                if(data["S"] == 1) {
                    $('.mensahe').html(data['M']);
                    $('.flasher').addClass('alert-success').removeClass('alert-danger alert-info').fadeIn().delay(8000);
                    $('#ecash2ecashSend').empty();
                    $('#ecash2ecashSend').append(
                        '<div class="form-group">'+
                            '<label class="col-md-12 col-lg-5 control-label animated bounceInUp delay025s" for="">Reference Number : </label>'+
                            '<div class="col-md-12 col-lg-7">'+
                                '<input type="text" readonly="readonly" id="interRef" class="form-control ecash2ecash animated bounceInDown delay025s" value="'+data['TN']+'" placeholder="Reference No" name="ecash2ecash">'+
                            '</div>'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<div class="col-md-12 col-lg-12">'+
                                '<form action="../file_generator/ecash2ecash_pdf" target="_blank" id="smart_form" method="POST">'+
                                    '<input type="hidden" readonly="readonly" id="interRef" class="form-control ecash2ecash animated bounceInDown delay025s" value="'+data['TN']+'" placeholder="Reference No" name="ecash2ecash">'+
                                    '<button value="btnsendPrintecash2ecash" id="btnsendPrintecash2ecash" target="_blank" class="btn btn-primary btnsendPrintecash2ecash pull-right">Print Receipt</button>'+
                                '</form>'+
                                '<button value="btnsendNewecash2ecash" id="btnsendNewecash2ecash" target="_blank" class="btn btn-info btnsendNewecash2ecash pull-right">New Transaction</button>'+
                            '</div>'+
                        '</div>'
                        
                    );
                }
                else {

                    $('.mensahe').html(data["M"]);
                    $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
                    $('.btnsendecash2ecashConfirm').removeAttr("disabled");  
                }
                $('.btnsendecash2ecashConfirm').removeAttr('disabled');
            }
        });
    });

    
    $('#ecash2ecashSend').on('click','.btnsendCancelecash2ecash',function(){
        location.reload(true);
        $('html, body').animate({scrollTop:0}, 'slow');
        // $(window).scrollTop(0);
    });

    $('#ecash2ecashSend').on('click','.btnsendNewecash2ecash',function(){
        location.reload(true);
        $('html, body').animate({scrollTop:0}, 'slow');
        // $(window).scrollTop(0);
    });
    


	$('#sendSmartmoney').on('click','.btnSmartMoney',function(){
		$('html, body').animate({scrollTop:0}, 'slow');
		var btn           = $(".btnSmartMoney").val();        
		var number        = $('.tab-content').find("div.active").find('input[name="smartmoney"]').val();
		var beneficiary   = $('.tab-content').find("div.active").find('input[name="bene_name"]').val();
		var bene_id       = $('.tab-content').find("div.active").find('input[name="bene_id"]').val();
		var bene_mobile   = $('.tab-content').find("div.active").find('input[name="bene_mobile"]').val();
		var bene_address  = $('.tab-content').find("div.active").find('input[name="bene_address"]').val();
		var bene_email    = $('.tab-content').find("div.active").find('input[name="bene_email"]').val();
		var bene_idtype   = $('.tab-content').find("div.active").find('input[name="idtype"]').val();
		var bene_idno     = $('.tab-content').find("div.active").find('input[name="idnumber"]').val();
		var sender_id	  = $('.tab-content').find("div.active").find('input[name="sender_id"]').val();
		var sender		  = $('.tab-content').find("div.active").find('input[name="sender_name"]').val();
		var sender_mobile   = $('.tab-content').find("div.active").find('input[name="sender_mobile"]').val();
		var sender_address   = $('.tab-content').find("div.active").find('input[name="sender_address"]').val();
		var sender_email    = $('.tab-content').find("div.active").find('input[name="sender_email"]').val();
		var amount        = $('.tab-content').find("div.active").find('input[name="amount"]').val();
		var pass          = $('.tab-content').find("div.active").find('input[name="pass"]').val();
		
		if(sender_id == bene_id)
        {
            $('.mensahe').html('Sender and Beneficiary should not be the same!');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(10000).fadeOut();
            $(".select_beneficiary").attr('disabled',true);
            $('.sender_info').hide();
        	$('.beneficiary_info').hide();
        	$('.select_sender').val('');
        	$('.select_sender').focus;
        	$('.select_beneficiary').val('');
        }
		else if(number == null || number == "")
        {
        	$('.tab-content').find("div.active").find('input[name="smartmoney"]').focus();
            $('.mensahe').html('Smart Money Number must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(number.length > 16)
        {
        	$('.tab-content').find("div.active").find('input[name="smartmoney"]').focus();
            $('.mensahe').html('Smart Money Number is too long');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(number.length < 16)
        {
        	$('.tab-content').find("div.active").find('input[name="smartmoney"]').focus();
            $('.mensahe').html('Smart Money Number is too short');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(beneficiary == null || beneficiary == "")
        {
        	$('.tab-content').find("div.active").find('input[name="bene_name"]').focus();
            $('.mensahe').html('Beneficiary must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(bene_address == null || bene_address == "")
        {
        	$('.tab-content').find("div.active").find('input[name="bene_address"]').focus();
            $('.mensahe').html('Beneficiary address must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(bene_mobile == null || bene_mobile == "")
        {
        	$('.tab-content').find("div.active").find('input[name="bene_mobile"]').focus();
            $('.mensahe').html('Beneficiary mobile number must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(bene_idtype == null || bene_idtype == "")
        {
        	$('.tab-content').find("div.active").find('input[name="idtype"]').focus();
            $('.mensahe').html('ID Type must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(bene_idno == null || bene_idno == "")
        {
        	$('.tab-content').find("div.active").find('input[name="idnumber"]').focus();
            $('.mensahe').html('ID number must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(amount == null || amount == "")
        {
        	$('.tab-content').find("div.active").find('input[name="amount"]').focus();
            $('.mensahe').html('Amount must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(pass == null || pass == "")
        {
        	$('.tab-content').find("div.active").find('input[name="pass"]').focus();
            $('.mensahe').html('Transaction password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(!validateEmail(bene_email)){
    		$('.tab-content').find("div.active").find('input[name="bene_email"]').focus();
            $('.mensahe').html('Your email is invalid');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
            
            
    		$('.mensahe').html('Processing..');
            $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();      
        
    			$.ajax({
    				url:"ecash_receiveData",
    				type:"post",
    				data:{btn:btn,number:number,beneficiary:beneficiary,amount:amount,pass:pass},
    				dataType:"json",
    				success: function(data) {
    					if(data["S"] == 1) {
    						var total = parseFloat(amount) + parseFloat(data['C']);
    						$('.mensahe').html('Kindly review the correctness of data shown below: ');
                            $('.flasher').addClass('alert-info animated fadeInLeft').removeClass('alert-danger alert-success').fadeIn().delay(8000);
                            $('#sendSmartmoney').empty();
                            $('#sendSmartmoney').append(
                             	'<h5 class="hr2"><span>Sender</span></h5>'+                   
            	                    '<div class="form-group">'+
            	                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Name : </label>'+
            	                        '<div class="col-md-12 col-lg-7">'+
            	                            '<input readonly="readonly" value="'+sender+'" name="sender_name" type="text" placeholder="Sender Full Name" class="form-control  animated flipInX delay050s" id="sender_name" required="">'+
            	                            '<input readonly="readonly" value="'+sender_id+'" name="sender_id" type="hidden" placeholder="Sender Full Name" class="form-control  animated flipInX delay050s" id="sender_name" required="">'+
            	                        '</div>'+
            	                    '</div>'+  
            	                    '<div class="form-group">'+
            	                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Address : </label>'+
            	                        '<div class="col-md-12 col-lg-7">'+
            	                            '<input readonly="readonly" value="'+sender_address+'" name="sender_address" type="text" placeholder="Sender Address" class="form-control animated flipInX delay050s" id="sender_address" required="">'+
            	                        '</div>'+
            	                    '</div>'+                    
            	                    '<div class="form-group">'+
            	                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay075s">Mobile Number : </label>'+
            	                        '<div class="col-md-12 col-lg-7">'+
            	                            '<input readonly="readonly" value="'+sender_mobile+'" name="sender_mobile" type="text" placeholder="Sender Mobile Number" class="form-control animated bounceInRight delay075s" id="sender_mobile" required="">'+
            	                        '</div>'+
            	                    '</div>'+
            	                    '<div class="form-group">'+
            	                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">Email : </label>'+
            	                        '<div class="col-md-12 col-lg-7">'+
            	                            '<input readonly="readonly" value="'+sender_email+'" name="sender_email" type="text" placeholder="Sender Email" class="form-control animated flipInY delay125s" id="sender_email" required="">'+
            	                        '</div>'+
            	                    '</div>'+
            	                    '<div class="clearfix"></div>'+
                            	 '<h5 class="hr2"><span>Beneficiary</span></h5>'+
            	                	 '<div class="form-group">'+
            	                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay025s">Smart Money Number : </label>'+
            	                        '<div class="col-md-12 col-lg-7">'+
            	                            '<input readonly="readonly" name="smartmoney" type="text" placeholder="Smart Money Number" class="form-control animated bounceInLeft delay025s" id="smartmoney" required="" value="'+number+'">'+
            	                        '</div>'+
            	                    '</div>'+
            	                    '<div class="form-group">'+
            	                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Name : </label>'+
            	                        '<div class="col-md-12 col-lg-7">'+
            	                            '<input readonly="readonly" name="bene_name" type="text" placeholder="Sender Full Name" class="form-control animated flipInX delay050s" id="bene_name" required="" value="'+beneficiary+'">'+
            	                            '<input readonly="readonly" value="'+bene_id+'" name="bene_id" type="hidden" placeholder="Sender Full Name" class="form-control  animated flipInX delay050s" id="sender_name" required="">'+
            	                        '</div>'+
            	                    '</div>'+  
            	                    '<div class="form-group">'+
            	                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Address : </label>'+
            	                        '<div class="col-md-12 col-lg-7">'+
            	                            '<input readonly="readonly" name="bene_address" type="text" placeholder="Sender Address" class="form-control animated flipInX delay050s" id="bene_address" required="" value="'+bene_address+'">'+
            	                        '</div>'+
            	                    '</div>'+                    
            	                    '<div class="form-group">'+
            	                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay075s">Mobile Number : </label>'+
            	                        '<div class="col-md-12 col-lg-7">'+
            	                            '<input readonly="readonly" name="bene_mobile" type="text" placeholder="Sender Mobile Number" class="form-control animated bounceInRight delay075s" id="bene_mobile" required="" value="'+bene_mobile+'">'+
            	                        '</div>'+
            	                    '</div>'+
            	                    '<div class="form-group">'+
            	                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">Email :</label>'+
            	                        '<div class="col-md-12 col-lg-7">'+
            	                            '<input readonly="readonly" name="bene_email" type="text" placeholder="Sender Email" class="form-control animated flipInY delay125s" id="bene_email" required=""  value="'+bene_email+'">'+
            	                        '</div>'+
            	                    '</div>'+
            	                     '<div class="form-group">'+
            	                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">ID Type : </label>'+
            	                        '<div class="col-md-12 col-lg-7">'+
            	                            '<input readonly="readonly" name="idtype" type="text" placeholder="ID Type" class="form-control animated flipInY delay125s" id="idtype" required="" value="'+bene_idtype+'">'+
            	                        '</div>'+
            	                    '</div>'+
            	                    '<div class="form-group">'+
            	                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">ID Number : </label>'+
            	                        '<div class="col-md-12 col-lg-7">'+
            	                            '<input readonly="readonly" name="idnumber" type="text" placeholder="ID Number" class="form-control animated flipInY delay125s" id="idnumber" required="" value="'+bene_idno+'">'+
            	                        '</div>'+
            	                    '</div>'+
            	                    '<div class="form-group">'+
            	                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">Amount : </label>'+
            	                        '<div class="col-md-12 col-lg-7">'+
            	                          '<input readonly="readonly" name="amount" type="text" placeholder="Amount" class="form-control animated flipInY delay125s" id="amount" required="" value="'+amount+'">'+
            	                        '</div>'+
            	                    '</div>'+
            	                    '<div class="form-group">'+
            	                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">Charge : </label>'+
            	                        '<div class="col-md-12 col-lg-7">'+
            	                            '<input readonly="readonly" name="charge" type="text" placeholder="Transaction Password" class="form-control animated flipInY delay125s" id="pass" required="" value="'+data['C']+'">'+
            	                        '</div>'+
            	                    '</div>'+
            	                    '<div class="form-group">'+
	        	                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">Total : </label>'+
	        	                        '<div class="col-md-12 col-lg-7">'+
	        	                            '<input readonly="readonly" name="total" type="text" placeholder="Total" class="form-control animated flipInY delay125s" id="pass" required="" value="'+total+'">'+
	        	                        '</div>'+
	        	                    '</div>'+
	        	                    '<div class="form-group">'+
	        	                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">Transaction Password : </label>'+
	        	                        '<div class="col-md-12 col-lg-7">'+
	        	                            '<input name="pass" type="password" placeholder="Transaction Password" class="form-control animated flipInY delay125s" id="pass" required="">'+
	        	                        '</div>'+
	        	                    '</div>'+
	        	                    '<div class="form-group">'+
	    								'<div class="col-md-12 col-lg-12">'+
	    								  '<button value="btnConfirmSmartmoneySend" id="btnConfirmSmartmoneySend" class="btn btn-primary btnConfirmSmartmoneySend pull-right">Confirm</button>'+
	    								  '<button value="btnpayoutCancelSmartmoneyCancel" id="btnpayoutCancelSmartmoneyCancel" class="btn btn-danger btnpayoutCancelSmartmoneyCancel pull-right">Cancel</button>'+
	    								'</div>'+
	    							'</div>'
	    							
	    							
	    							
	    							
	    							
                            );
    
    					}
    					else {
    
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
    				
    					}
    
    				}
    
    			});
    		
        }
	});
	
	$('#sendSmartmoney').on('click','.btnConfirmSmartmoneySend',function(){
		$('html, body').animate({scrollTop:0}, 'slow');
		$('.btnConfirmSmartmoneySend').attr("disabled", true);	
		
		var btn                 = $(".btnConfirmSmartmoneySend").val();        
		var sender_id              = $('.tab-content').find("div.active").find('input[name="sender_id"]').val();
		var smartmoney          = $('.tab-content').find("div.active").find('input[name="smartmoney"]').val();
		var bene_id         = $('.tab-content').find("div.active").find('input[name="bene_id"]').val();
		var idtype              = $('.tab-content').find("div.active").find('input[name="idtype"]').val();
		var idnumber            = $('.tab-content').find("div.active").find('input[name="idnumber"]').val();
		var amount              = $('.tab-content').find("div.active").find('input[name="amount"]').val();
		var pass                = $('.tab-content').find("div.active").find('input[name="pass"]').val();
		
    	$('.mensahe').html('Processing..');
        $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();
		
        $('.btnConfirmSmartmoneySend').attr('disabled',true);

        $.ajax({
			url:"ecash_receiveData",
			type:"post",
			data:{btn:btn, smartmoney:smartmoney, bene_id:bene_id, sender_id:sender_id, idtype:idtype, idnumber:idnumber, amount:amount, pass:pass},
			dataType:"json",
			success: function(data) {
				// console.log(data);
				if(data["S"] == 1) {
			        $('.mensahe').html(data['M']);
                    $('.flasher').addClass('alert-success').removeClass('alert-danger alert-info').fadeIn().delay(8000);
                    $('#sendSmartmoney').empty();
            		$('#sendSmartmoney').append(
                        '<div class="form-group">'+
                            '<label class="col-md-12 col-lg-5 control-label animated bounceInUp delay025s" for="">Reference Number : </label>'+
                            '<div class="col-md-12 col-lg-7">'+
                                '<input type="text" readonly="readonly" id="interRef" class="form-control smartmoneyView animated bounceInDown delay025s" value="'+data['TN']+'" placeholder="Reference No" name="smartmoneyView">'+
                            '</div>'+
                        '</div>'+
                        '<div class="form-group">'+
	                        '<div class="col-md-12 col-lg-12">'+
								'<form style="display:none;" action="../file_generator/smartmoneysend_pdf" target="_blank" id="smart_form" method="POST">'+
									'<input type="hidden" readonly="readonly" id="interRef" class="form-control smartmoneyView animated bounceInDown delay025s" value="'+data['TN']+'" placeholder="Reference No" name="smartmoneyView">'+
								    '<button value="btnsendPrintSmartmoney" id="btnpasendPrintSmartmoney" target="_blank" class="btn btn-primary btnsendPrintSmartmoney pull-right">Print Receipt</button>'+
								'</form>'+
                                '<button style="display:none;" value="btnsendNewSmartmoney" id="btnsendNewSmartmoney" target="_blank" class="btn btn-info btnsendNewSmartmoney pull-right">New Transaction</button>'+
							    '<button value="btnsendCheckStatusSmartmoney" id="btnsendCheckStatusSmartmoney" target="_blank" class="btn btn-primary btnsendCheckStatusSmartmoney pull-right">Check Status</button>'+
                            '</div>'+
						'</div>'
						
            		);
				}
				else {

                    $('.mensahe').html(data["M"]);
                    $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
                	$('.btnConfirmSmartmoneySend').removeAttr("disabled");	
				}
                $('.btnConfirmSmartmoneySend').removeAttr('disabled');
			}
		});
	});
    
    $('#sendSmartmoney').on('click','.btnpayoutCancelSmartmoneyCancel',function(){
        location.reload(true);
        $('html, body').animate({scrollTop:0}, 'slow');
    });

     $('#sendSmartmoney').on('click','.btnsendNewSmartmoney',function(){
        location.reload(true);
        $('html, body').animate({scrollTop:0}, 'slow');
    });

    $('#sendSmartmoney').on('click','.btnsendCheckStatusSmartmoney',function(){
        $('html, body').animate({scrollTop:0}, 'slow');
        // $('.btnsendCheckStatusSmartmoney').attr("disabled", true);  
        
        var btn              = $(".btnsendCheckStatusSmartmoney").val();        
        var TN               = $('.tab-content').find("div.active").find('input[name="smartmoneyView"]').val();
        
         $('.mensahe').html('Processing..');
         $('.flasher').addClass('alert-info').removeClass('alert-danger alert-success').fadeIn().delay(8000);
        // // 
        $.ajax({
            url:"ecash_receiveData",
            type:"post",
            data:{btn:btn,TN:TN},
            dataType:"json",
            success: function(data) {
               // console.log(data);
                if(data["status"] == 1) {
                    $('.mensahe').html('Reference number is now available!');
                    $('.flasher').addClass('alert-success').removeClass('alert-danger alert-info').fadeIn().delay(8000);
                        $('#smart_form').show();
                        $('#btnsendNewSmartmoney').show();
                        $('#btnsendCheckStatusSmartmoney').hide();
                }
                else {

                    $('.mensahe').html('Not yet Available..');
                    $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
                    $('.btnConfirmSmartmoneySend').removeAttr("disabled");  
                }
            }
        });
    });
    
    
	$('#sendEpadala').on('click','.btnEpadala',function(){
		$('html, body').animate({scrollTop:0}, 'slow');
		
		var btn           = $(".btnEpadala").val();        
		var beneficiary   = $('.tab-content').find("div.active").find('input[name="bene_name"]').val();
		var bene_id       = $('.tab-content').find("div.active").find('input[name="bene_id"]').val();
		var bene_mobile   = $('.tab-content').find("div.active").find('input[name="bene_mobile"]').val();
		var bene_address  = $('.tab-content').find("div.active").find('input[name="bene_address"]').val();
		var bene_email    = $('.tab-content').find("div.active").find('input[name="bene_email"]').val();
		var bene_idtype   = $('.tab-content').find("div.active").find('input[name="idtype"]').val();
		var bene_idno     = $('.tab-content').find("div.active").find('input[name="idnumber"]').val();
		var sender_id	  = $('.tab-content').find("div.active").find('input[name="sender_id"]').val();
		var sender		  = $('.tab-content').find("div.active").find('input[name="sender_name"]').val();
		var sender_mobile = $('.tab-content').find("div.active").find('input[name="sender_mobile"]').val();
		var sender_address= $('.tab-content').find("div.active").find('input[name="sender_address"]').val();
		var sender_email  = $('.tab-content').find("div.active").find('input[name="sender_email"]').val();
		var amount        = $('.tab-content').find("div.active").find('input[name="principal"]').val();
		var charge        = $('.tab-content').find("div.active").find('input[name="charge"]').val();
		var total         = $('.tab-content').find("div.active").find('input[name="total"]').val();
		var commission    = $('.tab-content').find("div.active").find('input[name="commission"]').val();
		var trans_type    = $('.tab-content').find("div.active").find('input[name="trans_type"]').val();
		

		if(sender_id == bene_id)
        {
            $('.mensahe').html('Sender and Beneficiary should not be the same!');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(10000).fadeOut();
            $(".select_beneficiary").attr('disabled',true);
            $('.sender_info').hide();
        	$('.beneficiary_info').hide();
        	$('.select_sender').val('');
        	$('.select_sender').focus;
        	$('.select_beneficiary').val('');
        }
        else if(amount == null || amount == "")
        {
            $('.mensahe').html('Principal must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
			$('.mensahe').html('Kindly review the correctness of data shown below: ');
            $('.flasher').addClass('alert-info animated fadeInLeft').removeClass('alert-danger alert-success').fadeIn().delay(8000);
            $('#sendEpadala').empty();
            $('#sendEpadala').append(
             	'<h5 class="hr2"><span>Sender</span></h5>'+                   
                    '<div class="form-group">'+
                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Name : </label>'+
                        '<div class="col-md-12 col-lg-7">'+
                            '<input readonly="readonly" value="'+sender+'" name="sender_name" type="text" placeholder="Sender Full Name" class="form-control  animated flipInX delay050s" id="sender_name" required="">'+
                            '<input readonly="readonly" value="'+sender_id+'" name="sender_id" type="hidden" placeholder="Sender Full Name" class="form-control  animated flipInX delay050s" id="sender_name" required="">'+
                            '<input readonly="readonly" value="'+trans_type+'" name="trans_type" type="hidden" placeholder="Sender Full Name" class="form-control  animated flipInX delay050s" id="trans_type" required="">'+
                        '</div>'+
                    '</div>'+  
                    '<div class="form-group">'+
                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Address : </label>'+
                        '<div class="col-md-12 col-lg-7">'+
                            '<input readonly="readonly" value="'+sender_address+'" name="sender_address" type="text" placeholder="Sender Address" class="form-control animated flipInX delay050s" id="sender_address" required="">'+
                        '</div>'+
                    '</div>'+                    
                    '<div class="form-group">'+
                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay075s">Mobile Number : </label>'+
                        '<div class="col-md-12 col-lg-7">'+
                            '<input readonly="readonly" value="'+sender_mobile+'" name="sender_mobile" type="text" placeholder="Sender Mobile Number" class="form-control animated bounceInRight delay075s" id="sender_mobile" required="">'+
                        '</div>'+
                    '</div>'+
                    '<div class="clearfix"></div>'+
            	 '<h5 class="hr2"><span>Beneficiary</span></h5>'+                
                    '<div class="form-group">'+
                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Name : </label>'+
                        '<div class="col-md-12 col-lg-7">'+
                            '<input readonly="readonly" name="bene_name" type="text" placeholder="Sender Full Name" class="form-control animated flipInX delay050s" id="bene_name" required="" value="'+beneficiary+'">'+
                            '<input readonly="readonly" value="'+bene_id+'" name="bene_id" type="hidden" placeholder="Sender Full Name" class="form-control  animated flipInX delay050s" id="sender_name" required="">'+
                        '</div>'+
                    '</div>'+  
                    '<div class="form-group">'+
                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Address : </label>'+
                        '<div class="col-md-12 col-lg-7">'+
                            '<input readonly="readonly" name="bene_address" type="text" placeholder="Sender Address" class="form-control animated flipInX delay050s" id="bene_address" required="" value="'+bene_address+'">'+
                        '</div>'+
                    '</div>'+                    
                    '<div class="form-group">'+
                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay075s">Mobile Number : </label>'+
                        '<div class="col-md-12 col-lg-7">'+
                            '<input readonly="readonly" name="bene_mobile" type="text" placeholder="Sender Mobile Number" class="form-control animated bounceInRight delay075s" id="bene_mobile" required="" value="'+bene_mobile+'">'+
                        '</div>'+
                    '</div>'+
                     '<div class="form-group">'+
                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">ID Type : </label>'+
                        '<div class="col-md-12 col-lg-7">'+
                            '<input readonly="readonly" name="idtype" type="text" placeholder="ID Type" class="form-control animated flipInY delay125s" id="idtype" required="" value="'+bene_idtype+'">'+
                        '</div>'+
                    '</div>'+
                    '<div class="form-group">'+
                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">ID Number : </label>'+
                        '<div class="col-md-12 col-lg-7">'+
                            '<input readonly="readonly" name="idnumber" type="text" placeholder="ID Number" class="form-control animated flipInY delay125s" id="idnumber" required="" value="'+bene_idno+'">'+
                        '</div>'+
                    '</div>'+
                    '<div class="form-group">'+
                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">Amount : </label>'+
                        '<div class="col-md-12 col-lg-7">'+
                          '<input readonly="readonly" name="amount" type="text" placeholder="Amount" class="form-control animated flipInY delay125s" id="amount" required="" value="'+amount+'">'+
                        '</div>'+
                    '</div>'+
                    '<div class="form-group">'+
                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">Commission : </label>'+
                        '<div class="col-md-12 col-lg-7">'+
                            '<input readonly="readonly" name="commission" type="text" placeholder="Transaction Password" class="form-control commission animated flipInY delay125s" id="commission" required="" value="'+commission+'">'+
                        '</div>'+
                    '</div>'+
                    '<div class="form-group">'+
	                    '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">Charge : </label>'+
	                    '<div class="col-md-12 col-lg-7">'+
	                        '<input readonly="readonly" name="charge" type="text" placeholder="Transaction Password" class="form-control animated flipInY delay125s" id="pass" required="" value="'+charge+'">'+
	                    '</div>'+
	                '</div>'+
                    '<div class="form-group">'+
                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">Total : </label>'+
                        '<div class="col-md-12 col-lg-7">'+
                            '<input readonly="readonly" name="total" type="text" placeholder="Total" class="form-control animated flipInY delay125s" id="pass" required="" value="'+total+'">'+
                        '</div>'+
                    '</div>'+
                    '<div class="form-group">'+
	                    '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">Trasaction Password : </label>'+
	                    '<div class="col-md-12 col-lg-7">'+
	                    	'<input name="password" type="password" placeholder="Transaction Password" class="form-control pass animated flipInY delay100s" id="pass" required />'+
	                    '</div>'+
	                '</div>'+
                    '<div class="form-group">'+
						'<div class="col-md-12 col-lg-12">'+
						  '<button value="btnConfirmEpadalaSend" id="btnConfirmEpadalaSend" class="btn btn-primary btnConfirmEpadalaSend pull-right">Confirm</button>'+
						  '<button value="btnpayoutCancelEpadalaCancel" id="btnpayoutCancelEpadalaCancel" class="btn btn-danger btnpayoutCancelEpadalaCancel pull-right">Cancel</button>'+
						'</div>'+
					'</div>'
                    //+
					//'<div class="form-group">'+
					//	'<div class="col-md-12 col-lg-12 text-center">'+
					//		'<em><strong class="text-warning">Note: This process is IRREVERSIBLE. Double-Check the data before you proceed.</strong></em>'+
					//	'</div>'+									
					//'</div>'
            );
		}
	});
	
	$('#sendEpadala').on('click','.btnConfirmEpadalaSend',function(){
		$('html, body').animate({scrollTop:0}, 'slow');
		var btn           = $(".btnConfirmEpadalaSend").val();  
		var bene_id       = $('.tab-content').find("div.active").find('input[name="bene_id"]').val();
		var bene_name     = $('.tab-content').find("div.active").find('input[name="bene_name"]').val();
		var sender_id	  = $('.tab-content').find("div.active").find('input[name="sender_id"]').val();
		var amount        = $('.tab-content').find("div.active").find('input[name="amount"]').val();
		var charge        = $('.tab-content').find("div.active").find('input[name="charge"]').val();
		var total         = $('.tab-content').find("div.active").find('input[name="total"]').val();
		var commission    = $('.tab-content').find("div.active").find('input[name="commission"]').val();
		var pass          = $('.tab-content').find("div.active").find('input[name="password"]').val();
		var sender_mobile = $('.tab-content').find("div.active").find('input[name="sender_mobile"]').val();
		var trans_type    = $('.tab-content').find("div.active").find('input[name="trans_type"]').val();
		
		if(pass == null || pass == "")
        {
            $('.mensahe').html('Transaction password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(10000).fadeOut();
        }
        else{

            $('.btnConfirmEpadalaSend').attr('disabled',true);

			$.ajax({
				url:"ecash_receiveData",
				type:"post",
				data:{btn:btn, sender_id:sender_id, trans_type:trans_type, bene_id:bene_id, amount:amount, charge:charge, commission:commission, pass:pass, bene_name:bene_name, sender_mobile:sender_mobile},
				dataType:"json",
				success: function(data) {
					if(data["S"] == 1) {
				        $('.mensahe').html(data['M']);
	                    $('.flasher').addClass('alert-success').removeClass('alert-danger alert-info').fadeIn().delay(8000);
	                    $('#sendEpadala').empty();
	            		$('#sendEpadala').append(
	                        '<div class="form-group">'+
	                            '<label class="col-md-12 col-lg-5 control-label animated bounceInUp delay025s" for="">Tracking Number : </label>'+
	                            '<div class="col-md-12 col-lg-7">'+
	                                '<input type="text" readonly="readonly" id="interRef" class="form-control interRef animated bounceInDown delay025s" value="'+data['TN']+'" placeholder="Tracking No" name="EpadalaTN">'+
	                            '</div>'+
	                        '</div>'+
	                        '<div class="form-group">'+
		                        '<div class="col-md-12 col-lg-12">'+
									'<form action="../file_generator/epadalasend_pdf" target="_blank" id="smart_form" method="POST">'+
										'<input type="hidden" readonly="readonly" id="interRef" class="form-control interRef EpadalaTN animated bounceInDown delay025s" value="'+data['TN']+'" placeholder="Tracking No" name="EpadalaTN">'+
									    '<button value="btnSendPrintePadala" id="btnSendPrintePadala" target="_blank" class="btn btn-primary btnSendPrintePadala pull-right">Print Receipt</button>'+
									'</form>'+
									'<button value="btnSendNewePadala" id="btnSendNewePadala" target="_blank" class="btn btn-info btnSendNewePadala pull-right">New Transaction</button>'+
								'</div>'+
							'</div>'
							
	            		);
					}
					else {
	
	                    $('.mensahe').html(data["M"]);
	                    $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(10000).fadeOut();
				
					}
                     $('.btnConfirmEpadalaSend').removeAttr('disabled');
				}
			});
        }
	});
	
    $('#sendEpadala').on('click','.btnSendNewePadala',function(){
        location.reload(true);
        $('html, body').animate({scrollTop:0}, 'slow');
    });
    
    $('#sendEpadala').on('click','.btnpayoutCancelEpadalaCancel',function(){
        location.reload(true);
        $('html, body').animate({scrollTop:0}, 'slow');
         // $('.flasher').hide();
         // $('#sendEpadala').empty();
         //    $('#sendEpadala').append(
         //        '<h5 class="hr2"><span>Sender</span></h5>'+                   
         //            '<div class="form-group">'+
         //                '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Name : </label>'+
         //                '<div class="col-md-12 col-lg-7">'+
         //                    '<input readonly="readonly" value="" name="sender_name" type="text" placeholder="Sender Full Name" class="form-control  animated flipInX delay050s" id="sender_name" required="">'+
         //                    '<input readonly="readonly" value="" name="sender_id" type="hidden" placeholder="Sender Full Name" class="form-control  animated flipInX delay050s" id="sender_name" required="">'+
         //                    '<input readonly="readonly" value="" name="trans_type" type="hidden" placeholder="Sender Full Name" class="form-control  animated flipInX delay050s" id="trans_type" required="">'+
         //                '</div>'+
         //            '</div>'+  
         //            '<div class="form-group">'+
         //                '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Address : </label>'+
         //                '<div class="col-md-12 col-lg-7">'+
         //                    '<input readonly="readonly" value="" name="sender_address" type="text" placeholder="Sender Address" class="form-control animated flipInX delay050s" id="sender_address" required="">'+
         //                '</div>'+
         //            '</div>'+                    
         //            '<div class="form-group">'+
         //                '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay075s">Mobile Number : </label>'+
         //                '<div class="col-md-12 col-lg-7">'+
         //                    '<input readonly="readonly" value="" name="sender_mobile" type="text" placeholder="Sender Mobile Number" class="form-control animated bounceInRight delay075s" id="sender_mobile" required="">'+
         //                '</div>'+
         //            '</div>'+
         //            '<div class="clearfix"></div>'+
         //         '<h5 class="hr2"><span>Beneficiary</span></h5>'+                
         //            '<div class="form-group">'+
         //                '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Name : </label>'+
         //                '<div class="col-md-12 col-lg-7">'+
         //                    '<input readonly="readonly" name="bene_name" type="text" placeholder="Sender Full Name" class="form-control animated flipInX delay050s" id="bene_name" required="" value="">'+
         //                    '<input readonly="readonly" value="" name="bene_id" type="hidden" placeholder="Sender Full Name" class="form-control  animated flipInX delay050s" id="sender_name" required="">'+
         //                '</div>'+
         //            '</div>'+  
         //            '<div class="form-group">'+
         //                '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Address : </label>'+
         //                '<div class="col-md-12 col-lg-7">'+
         //                    '<input readonly="readonly" name="bene_address" type="text" placeholder="Sender Address" class="form-control animated flipInX delay050s" id="bene_address" required="" value="">'+
         //                '</div>'+
         //            '</div>'+                    
         //            '<div class="form-group">'+
         //                '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay075s">Mobile Number : </label>'+
         //                '<div class="col-md-12 col-lg-7">'+
         //                    '<input readonly="readonly" name="bene_mobile" type="text" placeholder="Sender Mobile Number" class="form-control animated bounceInRight delay075s" id="bene_mobile" required="" value="">'+
         //                '</div>'+
         //            '</div>'+
         //             '<div class="form-group">'+
         //                '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">ID Type : </label>'+
         //                '<div class="col-md-12 col-lg-7">'+
         //                    '<input readonly="readonly" name="idtype" type="text" placeholder="ID Type" class="form-control animated flipInY delay125s" id="idtype" required="" value="">'+
         //                '</div>'+
         //            '</div>'+
         //            '<div class="form-group">'+
         //                '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">ID Number : </label>'+
         //                '<div class="col-md-12 col-lg-7">'+
         //                    '<input readonly="readonly" name="idnumber" type="text" placeholder="ID Number" class="form-control animated flipInY delay125s" id="idnumber" required="" value="">'+
         //                '</div>'+
         //            '</div>'+
         //            '<div class="form-group">'+
         //                '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">Amount : </label>'+
         //                '<div class="col-md-12 col-lg-7">'+
         //                  '<input readonly="readonly" name="amount" type="text" placeholder="Amount" class="form-control animated flipInY delay125s" id="amount" required="" value="">'+
         //                '</div>'+
         //            '</div>'+
         //            '<div class="form-group">'+
         //                '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">Commission : </label>'+
         //                '<div class="col-md-12 col-lg-7">'+
         //                    '<input readonly="readonly" name="commission" type="text" placeholder="Transaction Password" class="form-control commission animated flipInY delay125s" id="commission" required="" value="">'+
         //                '</div>'+
         //            '</div>'+
         //            '<div class="form-group">'+
         //                '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">Charge : </label>'+
         //                '<div class="col-md-12 col-lg-7">'+
         //                    '<input readonly="readonly" name="charge" type="text" placeholder="Transaction Password" class="form-control animated flipInY delay125s" id="pass" required="" value="">'+
         //                '</div>'+
         //            '</div>'+
         //            '<div class="form-group">'+
         //                '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">Total : </label>'+
         //                '<div class="col-md-12 col-lg-7">'+
         //                    '<input readonly="readonly" name="total" type="text" placeholder="Total" class="form-control animated flipInY delay125s" id="pass" required="" value="">'+
         //                    '<input readonly="readonly" name="pass" type="hidden" placeholder="Total" class="form-control pass animated flipInY delay125s" id="pass" required="" value="">'+
         //                '</div>'+
         //            '</div>'+
         //            '<div class="form-group">'+
         //                '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">Trasaction Password : </label>'+
         //                '<div class="col-md-12 col-lg-7">'+
         //                    '<input name="password" type="password" placeholder="Transaction Password" class="form-control pass animated flipInY delay100s" id="pass" required />'+
         //                '</div>'+
         //            '</div>'+
         //            '<div class="form-group">'+
         //                '<div class="col-md-12 col-lg-12">'+
         //                  '<button value="btnConfirmEpadalaSend" id="btnConfirmEpadalaSend" class="btn btn-primary btnConfirmEpadalaSend pull-right">Confirm</button>'+
         //                  '<button value="btnpayoutCancelEpadalaCancel" id="btnpayoutCancelEpadalaCancel" class="btn btn-danger btnpayoutCancelEpadalaCancel pull-right">Cancel</button>'+
         //                '</div>'+
         //            '</div>'+
         //            '<div class="form-group">'+
         //                '<div class="col-md-12 col-lg-12 text-center">'+
         //                    '<em><strong class="text-warning">Note: This process is IRREVERSIBLE. Double-Check the data before you proceed.</strong></em>'+
         //                '</div>'+                                   
         //            '</div>'
         //    );
    });    



    $('#sendMyVisaCard').on('click', '.myvisa', function(){
//		$('html, body').animate({scrollTop:0}, 'slow');
		$('html, body').animate({scrollTop:0}, 'slow');
		var btn           = $(".myvisa").val();        
		var sender_id     = $('.tab-content').find("div.active").find('input[name="sender_id"]').val();
		var sender_name   = $('.tab-content').find("div.active").find('input[name="sender_name"]').val();
		var sender_address= $('.tab-content').find("div.active").find('input[name="sender_address"]').val();
		var sender_mobile = $('.tab-content').find("div.active").find('input[name="sender_mobile"]').val();
		var sender_email  = $('.tab-content').find("div.active").find('input[name="sender_email"]').val();
		var refno  		  = $('.tab-content').find("div.active").find('input[name="sender_visacard"]').val();
		var amount        = $('.tab-content').find("div.active").find('input[name="amount"]').val();

        if(amount == null || amount == "")
        {
            $('.mensahe').html('Amount must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(refno == null || refno == "")
        {
            $('.mensahe').html('Invalid Visa Card Number!');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
            
            
//    		$('.mensahe').html('Processing..');
//            $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();      
        
//    			$.ajax({
//    				url:"ecash_receiveData",
//    				type:"post",
//    				data:{btn:btn,accname:accname,refno:refno, bene_id:bene_id,amount:amount},
//    				dataType:"json",
//    				success: function(data) {
//    
//    					if(data["S"] == 1) {
//    				        $('.mensahe').html(data["M"]);
//                            $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
//                            $('.tab-content').find("div.active").find('input[name="select_bene"]').val('');
//                            $('.tab-content').find("div.active").find('.beneficiary_info').hide();
				            $('.mensahe').html('Kindly review the correctness of data shown below: ');
				            $('.flasher').addClass('alert-info animated fadeInLeft').removeClass('alert-danger alert-success').fadeIn().delay(8000);
                            $('#sendMyVisaCard').empty();
                            $('#sendMyVisaCard').append(
                                 	'<h5 class="hr2"><span>Dealer Info</span></h5> '+
                	                    '<div id="sender_info" class="sender_info" style="">'+
                		                    '<div class="form-group">'+
                		                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Registration Code : <span class="text-warning">*</span></label>'+
                		                        '<div class="col-md-12 col-lg-7">'+
                		                            '<input readonly="readonly" value="'+sender_id+'" name="sender_id" type="text" placeholder="Sender Full Name" class="form-control typeahead sender_id animated flipInX delay050s" id="sender_id" required="">'+
                		                            '<input readonly="readonly" value="" name="refno" type="hidden" placeholder="Sender Full Name" class="form-control typeahead sender_id animated flipInX delay050s" id="sender_id" required="">'+
                		                        '</div>'+
                		                    '</div>'+ 
                		                    '<div class="form-group">'+
                		                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Name : <span class="text-warning">*</span></label>'+
                		                        '<div class="col-md-12 col-lg-7">'+
                		                            '<input readonly="readonly" value="'+sender_name+'" name="sender_name" type="text" placeholder="Sender Full Name" class="form-control typeahead sender_name animated flipInX delay050s" id="sender_name" required="">'+
                		                        '</div>'+
                		                    '</div>'+  
                		                    '<div class="form-group">'+
                		                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Address : <span class="text-warning">*</span></label>'+
                		                        '<div class="col-md-12 col-lg-7">'+
                		                            '<input readonly="readonly" value="'+sender_address+'" name="sender_address" type="text" placeholder="Sender Address" class="form-control animated sender_address flipInX delay050s" id="sender_address" required="">'+
                		                        '</div>'+
                		                    '</div>'+                    
                		                    '<div class="form-group">'+
                		                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay075s">Mobile Number : <span class="text-warning">*</span></label>'+
                		                        '<div class="col-md-12 col-lg-7">'+
                		                            '<input readonly="readonly" value="'+sender_mobile+'" name="sender_mobile" type="text" placeholder="Sender Mobile Number" class="form-control sender_mobile animated bounceInRight delay075s" id="" required="">'+
                		                        '</div>'+
                		                    '</div>'+
                		                    '<div class="form-group">'+
                		                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay100s">Email : <span class="text-warning">*</span></label>'+
                		                        '<div class="col-md-12 col-lg-7">'+
                		                            '<input readonly="readonly" value="'+sender_email+'" name="sender_email" type="text" placeholder="Sender Email" class="form-control sender_email animated flipInY delay100s" id="sender_email" required="">'+
                		                        '</div>'+
                		                    '</div>'+
                		                    '<div class="form-group">'+
	            		                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay100s">Visa Card Number : <span class="text-warning">*</span></label>'+
	            		                        '<div class="col-md-12 col-lg-7">'+
	            		                            '<input readonly="readonly" value="'+refno+'" name="sender_visacard" type="text" placeholder="Sender Email" class="form-control sender_visacard animated flipInY delay100s" id="sender_visacard" required="">'+
	            		                        '</div>'+
	            		                    '</div>'+
	            		                    '<div class="form-group">'+
	            		                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay100s">Amount : <span class="text-warning">*</span></label>'+
	            		                        '<div class="col-md-12 col-lg-7">'+
	            		                            '<input readonly="readonly" value="'+amount+'" name="amount" type="text" placeholder="Amount" class="form-control amount animated flipInY delay100s" id="amount" required="">'+
	            		                        '</div>'+
	            		                    '</div>'+
                		                '</div>'+
                	                    '<div class="clearfix"></div>'+
            		                    '<div class="form-group">'+
            		                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay100s">Password : <span class="text-warning">*</span></label>'+
            		                        '<div class="col-md-12 col-lg-7">'+
            		                            '<input name="pass" type="password" placeholder="Transaction Password" class="form-control pass animated flipInY delay100s" id="pass" required="">'+
            		                        '</div>'+
            		                    '</div>'+
            		                    '<div class="form-group">'+
            		                       '<div class="col-md-12 col-lg-12">'+
            		                       		'<button value="btnmyvisaconfirm" id="btnmyvisaconfirm" class="btn btn-primary btnmyvisaconfirm pull-right">Confirm</button>'+
            		                       		'<button value="btnmyvisaCancel" id="btnmyvisaCancel" class="btn btn-danger btnmyvisaCancel pull-right">Cancel</button>'+
            		                        '</div>'+
            		                    '</div>'
        						);
//    					}
//    					else {
//    
//                            $('.mensahe').html(data["M"]);
//                            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
//    				
//    					}
    
//    				}
    
//    			});
    		
        }
	});
	
    $('#sendMyVisaCard').on('click', '.btnmyvisaconfirm', function(){
		$('html, body').animate({scrollTop:0}, 'slow');
		var btn           = $(".btnmyvisaconfirm").val();        
		var sender_name       = $('.tab-content').find("div.active").find('input[name="sender_name"]').val();
		var pass       = $('.tab-content').find("div.active").find('input[name="pass"]').val();
		var refno        = $('.tab-content').find("div.active").find('input[name="sender_visacard"]').val();
		var amount        = $('.tab-content').find("div.active").find('input[name="amount"]').val();
		
		if(pass == null || pass == "")
        {
            $('.mensahe').html('Transaction password must be filled up');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
		else if(refno == null || refno == "")
        {
            $('.mensahe').html('Invalid Visa Card Number!');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
		
			$('.mensahe').html('Processing..');
	        $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();      
	   
             $('.btnmyvisaconfirm').attr('disabled',true);

			$.ajax({
				url:"ecash_receiveData",
				type:"post",
				data:{btn:btn, sender_name:sender_name, refno:refno, amount:amount, pass:pass},
				dataType:"json",
				success: function(data) {
					if(data["S"] == 1) {
                        $('.mensahe').html(data['M']);
                        $('.flasher').addClass('alert-success').removeClass('alert-danger alert-info').fadeIn().delay(8000);
                        $('#sendMyVisaCard').empty();
                        $('#sendMyVisaCard').append(
                            '<div class="form-group">'+
                                '<label class="col-md-12 col-lg-5 control-label animated bounceInUp delay025s" for="">Tracking Number : </label>'+
                                '<div class="col-md-12 col-lg-7">'+
                                    '<input type="text" readonly="readonly" id="interRef" class="form-control interRef animated bounceInDown delay025s" value="'+data['TN']+'" placeholder="Reference No" name="IremitRef">'+
                                '</div>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<div class="col-md-12 col-lg-12">'+
                                    '<form action="../file_generator/myvisacard_pdf" target="_blank" id="smart_form" method="POST">'+
                                        '<input type="hidden" readonly="readonly" id="interRef" class="form-control interRef smartref animated bounceInDown delay025s" value="'+data['TN']+'" placeholder="Reference No" name="smartref">'+
                                        '<button value="btnpayoutPrintSmartmoney" id="btnpayoutPrintSmartmoney" target="_blank" class="btn btn-primary btnpayoutPrintSmartmoney pull-right">Print Receipt</button>'+
                                    '</form>'+
                                    '<button value="btnpayoutNewSmartmoney" id="btnpayoutNewSmartmoney" target="_blank" class="btn btn-info btnpayoutNewSmartmoney pull-right">New Transaction</button>'+
                                '</div>'+
                            '</div>'
                            
                        );
                    }
                    else {
    
                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(10000).fadeOut();
                
                    }
                    $('.btnmyvisaconfirm').removeAttr('disabled');
				}
			});
        }
	});
		
	$('#sendVisaCard').on('click', '.btnvisa', function(){
//		$('html, body').animate({scrollTop:0}, 'slow');
		$('html, body').animate({scrollTop:0}, 'slow');
		var btn           = $(".btnvisa").val();        
		var bene_id       = $('.tab-content').find("div.active").find('input[name="bene_id"]').val();
		var bene_name     = $('.tab-content').find("div.active").find('input[name="bene_name"]').val();
		var bene_address  = $('.tab-content').find("div.active").find('input[name="bene_address"]').val();
		var bene_mobile   = $('.tab-content').find("div.active").find('input[name="bene_mobile"]').val();
		var bene_email    = $('.tab-content').find("div.active").find('input[name="bene_email"]').val();
		var sender_id     = $('.tab-content').find("div.active").find('input[name="sender_id"]').val();
		var sender_visacard     = $('.tab-content').find("div.active").find('input[name="sender_visacard"]').val();
		var sender_name   = $('.tab-content').find("div.active").find('input[name="sender_name"]').val();
		var sender_address= $('.tab-content').find("div.active").find('input[name="sender_address"]').val();
		var sender_mobile = $('.tab-content').find("div.active").find('input[name="sender_mobile"]').val();
		var sender_email  = $('.tab-content').find("div.active").find('input[name="sender_email"]').val();
		var refno         = $('.tab-content').find("div.active").find('input[name="visacardno"]').val();
		var amount        = $('.tab-content').find("div.active").find('input[name="amount"]').val();

        if(bene_name == null || bene_name == "")
        {
            $('.mensahe').html('Account name no must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(refno == null || refno == "")
        {
            $('.mensahe').html('Visa card no must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(refno.length < 16)
        {
            $('.mensahe').html('Visa card no is too short!');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(refno.length > 16)
        {
            $('.mensahe').html('Visa card no is too long!');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(amount == null || amount == "")
        {
            $('.mensahe').html('Amount must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
            
            
//    		$('.mensahe').html('Processing..');
//            $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();      
        
//    			$.ajax({
//    				url:"ecash_receiveData",
//    				type:"post",
//    				data:{btn:btn,accname:accname,refno:refno, bene_id:bene_id,amount:amount},
//    				dataType:"json",
//    				success: function(data) {
//    
//    					if(data["S"] == 1) {
//    				        $('.mensahe').html(data["M"]);
//                            $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
//                            $('.tab-content').find("div.active").find('input[name="select_bene"]').val('');
//                            $('.tab-content').find("div.active").find('.beneficiary_info').hide();
				            $('.mensahe').html('Kindly review the correctness of data shown below: ');
				            $('.flasher').addClass('alert-info animated fadeInLeft').removeClass('alert-danger alert-success').fadeIn().delay(8000);
                            $('#sendVisaCard').empty();
                            $('#sendVisaCard').append(
                                 	'<h5 class="hr2"><span>Sender</span></h5> '+
                	                    '<div id="sender_info" class="sender_info" style="">'+
                		                    '<div class="form-group">'+
                		                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Registration Code : <span class="text-warning">*</span></label>'+
                		                        '<div class="col-md-12 col-lg-7">'+
                		                            '<input readonly="readonly" value="'+sender_id+'" name="sender_id" type="text" placeholder="Sender Full Name" class="form-control typeahead sender_id animated flipInX delay050s" id="sender_id" required="">'+
                		                            '<input readonly="readonly" value="" name="refno" type="hidden" placeholder="Sender Full Name" class="form-control typeahead sender_id animated flipInX delay050s" id="sender_id" required="">'+
                		                        '</div>'+
                		                    '</div>'+ 
                		                    '<div class="form-group">'+
                		                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Name : <span class="text-warning">*</span></label>'+
                		                        '<div class="col-md-12 col-lg-7">'+
                		                            '<input readonly="readonly" value="'+sender_name+'" name="sender_name" type="text" placeholder="Sender Full Name" class="form-control typeahead sender_name animated flipInX delay050s" id="sender_name" required="">'+
                		                        '</div>'+
                		                    '</div>'+  
                		                    '<div class="form-group">'+
                		                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Address : <span class="text-warning">*</span></label>'+
                		                        '<div class="col-md-12 col-lg-7">'+
                		                            '<input readonly="readonly" value="'+sender_address+'" name="sender_address" type="text" placeholder="Sender Address" class="form-control animated sender_address flipInX delay050s" id="sender_address" required="">'+
                		                        '</div>'+
                		                    '</div>'+                    
                		                    '<div class="form-group">'+
                		                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay075s">Mobile Number : <span class="text-warning">*</span></label>'+
                		                        '<div class="col-md-12 col-lg-7">'+
                		                            '<input readonly="readonly" value="'+sender_mobile+'" name="sender_mobile" type="text" placeholder="Sender Mobile Number" class="form-control sender_mobile animated bounceInRight delay075s" id="" required="">'+
                		                        '</div>'+
                		                    '</div>'+
                		                    '<div class="form-group">'+
                		                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay100s">Email : <span class="text-warning">*</span></label>'+
                		                        '<div class="col-md-12 col-lg-7">'+
                		                            '<input readonly="readonly" value="'+sender_email+'" name="sender_email" type="text" placeholder="Sender Email" class="form-control sender_email animated flipInY delay100s" id="sender_email" required="">'+
                		                        '</div>'+
                		                    '</div>'+
                		                '</div>'+
                	                    '<div class="clearfix"></div>'+
                                	 '<h5 class="hr2"><span>Beneficiary</span></h5>'+
                                	 	'<div id="beneficiary_info" class="beneficiary_info" style="">'+
                                	 		'<div class="form-group">'+
                		                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Loyalty Card No : <span class="text-warning">*</span></label>'+
                		                        '<div class="col-md-12 col-lg-7">'+
                		                            '<input readonly="readonly" value="'+bene_id+'" name="bene_id" type="text" placeholder="Sender Full Name" class="form-control bene_id animated flipInX delay050s" id="" required="">'+
                		                        '</div>'+
                		                    '</div> '+
                		                    '<div class="form-group">'+
                		                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Name : <span class="text-warning">*</span></label>'+
                		                        '<div class="col-md-12 col-lg-7">'+
                		                            '<input readonly="readonly" value="'+bene_name+'" name="bene_name" type="text" placeholder="Beneficiary Full Name" class="form-control bene_name animated flipInX delay050s" id="bene_name" required="">'+
                		                        '</div>'+
                		                    '</div>'+  
                		                    '<div class="form-group">'+
                		                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Address : <span class="text-warning">*</span></label>'+
                		                        '<div class="col-md-12 col-lg-7">'+
                		                            '<input readonly="readonly" value="'+bene_address+'" name="bene_address" type="text" placeholder="Beneficiary Address" class="form-control bene_address animated flipInX delay050s" id="bene_address" required="">'+
                		                        '</div>'+
                		                    '</div>'+                    
                		                    '<div class="form-group">'+
                		                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay075s">Mobile Number : <span class="text-warning">*</span></label>'+
                		                        '<div class="col-md-12 col-lg-7">'+
                		                            '<input readonly="readonly" name="bene_mobile" value="'+bene_mobile+'" type="text" placeholder="Beneficiary Mobile Number" class="form-control bene_mobile animated bounceInRight delay075s" id="bene_mobile" required="">'+
                		                        '</div>'+
                		                    '</div>'+
                		                    '<div class="form-group">'+
                		                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay100s">Email : <span class="text-warning">*</span></label>'+
                		                        '<div class="col-md-12 col-lg-7">'+
                		                            '<input readonly="readonly" value="'+bene_email+'" name="bene_email" type="text" placeholder="Beneficiary Email" class="form-control bene_email animated flipInY delay100s" id="bene_email" required="">'+
                		                        '</div>'+
                		                    '</div>'+
                		                 '<div class="clearfix"></div>'+   
                		                 '<h5 class="hr2"><span>Input Fields</span></h5>'+     
                		                    '<div class="form-group">'+
                		                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay025s">Visa Card Number : <span class="text-warning">*</span></label>'+
                		                        '<div class="col-md-12 col-lg-7">'+
                		                            '<input readonly="readonly" name="visacardno" value="'+refno+'" type="text" placeholder="Visa Card Number" class="form-control numOnly visacardno animated bounceInLeft delay025s" id="visacardno" required="">'+
                		                        '</div>'+
                		                    '</div>'+
                		                    '<div class="form-group">'+
	            		                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay100s">Amount : <span class="text-warning">*</span></label>'+
	            		                        '<div class="col-md-12 col-lg-7">'+
	            		                            '<input name="amount" readonly="readonly" type="text" value="'+amount+'" placeholder="Amount" class="form-control numOnly amount animated flipInY delay100s" id="amount" required="">'+
	            		                        '</div>'+
	            		                    '</div>'+
//                		                    '<div class="form-group">'+
//                		                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay100s">ID Type : <span class="text-warning">*</span></label>'+
//                		                        '<div class="col-md-12 col-lg-7">'+
//                		                            '<input name="idtype" type="text" placeholder="ID Type" class="form-control animated flipInY delay100s idtype" id="idtype" required="">'+
//                		                        '</div>'+
//                		                    '</div>'+
//                		                    '<div class="form-group">'+
//                		                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay100s">ID Number : <span class="text-warning">*</span></label>'+
//                		                        '<div class="col-md-12 col-lg-7">'+
//                		                            '<input name="idnumber" type="text" placeholder="ID Number" class="form-control animated flipInY delay100s idnumber" id="idnumber" required="">'+
//                		                        '</div>'+
//                		                    '</div>'+
                		                    '<div class="form-group">'+
                		                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay100s">Password : <span class="text-warning">*</span></label>'+
                		                        '<div class="col-md-12 col-lg-7">'+
                		                            '<input name="pass" type="password" placeholder="Transaction Password" class="form-control pass animated flipInY delay100s" id="pass" required="">'+
                		                        '</div>'+
                		                    '</div>'+
                		                    '<div class="form-group">'+
                		                       '<div class="col-md-12 col-lg-12">'+
                		                       		'<button value="btnvisaconfirm" id="btnvisaconfirm" class="btn btn-primary btnvisaconfirm pull-right">Confirm</button>'+
                		                       		'<button value="btnvisaCancel" id="btnvisaCancel" class="btn btn-danger btnvisaCancel pull-right">Cancel</button>'+
                		                        '</div>'+
                		                    '</div>'+
                		                '</div>'
        						);
//    					}
//    					else {
//    
//                            $('.mensahe').html(data["M"]);
//                            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
//    				
//    					}
    
//    				}
    
//    			});
    		
        }
	});
	
	$('#sendVisaCard').on('click', '.btnvisaconfirm', function(){
		$('html, body').animate({scrollTop:0}, 'slow');
		var btn           = $(".btnvisaconfirm").val();        
		var bene_id       = $('.tab-content').find("div.active").find('input[name="bene_id"]').val();
		var bene_name       = $('.tab-content').find("div.active").find('input[name="bene_name"]').val();
		var pass       = $('.tab-content').find("div.active").find('input[name="pass"]').val();
		var refno        = $('.tab-content').find("div.active").find('input[name="visacardno"]').val();
		var amount        = $('.tab-content').find("div.active").find('input[name="amount"]').val();
		
		if(pass == null || pass == "")
        {
            $('.mensahe').html('Transaction password must be filled up');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
		
			$('.mensahe').html('Processing..');
	        $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();      
	       
            $('.btnvisaconfirm').attr('disabled',true);

			$.ajax({
				url:"ecash_receiveData",
				type:"post",
				data:{btn:btn,bene_name:bene_name,refno:refno, bene_id:bene_id,amount:amount, pass:pass},
				dataType:"json",
				success: function(data) {
					if(data["S"] == 1) {
                        $('.mensahe').html(data['M']);
                        $('.flasher').addClass('alert-success').removeClass('alert-danger alert-info').fadeIn().delay(8000);
                        $('#sendVisaCard').empty();
                        $('#sendVisaCard').append(
                            '<div class="form-group">'+
                                '<label class="col-md-12 col-lg-5 control-label animated bounceInUp delay025s" for="">Tracking Number : </label>'+
                                '<div class="col-md-12 col-lg-7">'+
                                    '<input type="text" readonly="readonly" id="interRef" class="form-control interRef animated bounceInDown delay025s" value="'+data['TN']+'" placeholder="Reference No" name="IremitRef">'+
                                '</div>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<div class="col-md-12 col-lg-12">'+
                                    '<form action="../file_generator/visacard_pdf" target="_blank" id="smart_form" method="POST">'+
                                        '<input type="hidden" readonly="readonly" id="interRef" class="form-control interRef smartref animated bounceInDown delay025s" value="'+data['TN']+'" placeholder="Reference No" name="smartref">'+
                                        '<button value="btnpayoutPrintSmartmoney" id="btnpayoutPrintSmartmoney" target="_blank" class="btn btn-primary btnpayoutPrintSmartmoney pull-right">Print Receipt</button>'+
                                    '</form>'+
                                    '<button value="btnpayoutNewSmartmoney" id="btnpayoutNewSmartmoney" target="_blank" class="btn btn-info btnpayoutNewSmartmoney pull-right">New Transaction</button>'+
                                '</div>'+
                            '</div>'
                            
                        );
                    }
                    else {
    
                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(10000).fadeOut();
                
                    }
                    $('.btnvisaconfirm').removeAttr('disabled');
				}
			});
        }
	});
		
	$('#sendCreditBank').on('click','.btncredit2bank',function(){
    // $('.btncredit2bank').click(function(){
        $('html, body').animate({scrollTop:0}, 'slow');

		var btn           = $(".btncredit2bank").val();
        var beneficiary   = $('.tab-content').find("div.active").find('input[name="bene_name"]').val();
        var bene_id       = $('.tab-content').find("div.active").find('input[name="bene_id"]').val();
        var bene_mobile   = $('.tab-content').find("div.active").find('input[name="bene_mobile"]').val();
        var bene_address  = $('.tab-content').find("div.active").find('input[name="bene_address"]').val();
        var bene_email    = $('.tab-content').find("div.active").find('input[name="bene_email"]').val();
        var bene_idtype   = $('.tab-content').find("div.active").find('input[name="idtype"]').val();
        var bene_idno     = $('.tab-content').find("div.active").find('input[name="idnumber"]').val();
        var sender_id     = $('.tab-content').find("div.active").find('input[name="sender_id"]').val();
        var sender        = $('.tab-content').find("div.active").find('input[name="sender_name"]').val();
        var sender_mobile = $('.tab-content').find("div.active").find('input[name="sender_mobile"]').val();
        var sender_address= $('.tab-content').find("div.active").find('input[name="sender_address"]').val();
        var sender_email  = $('.tab-content').find("div.active").find('input[name="sender_email"]').val();     
		var accountno     = $('.tab-content').find("div.active").find('input[name="accountno"]').val();
        var bank          = $('.tab-content').find("div.active").find(".c2bBank option:selected").val();
        var bankname      = $('.tab-content').find("div.active").find(".c2bBank option:selected").attr('bankname');
		var amount        = $('.tab-content').find("div.active").find('input[name="amount"]').val();
		var pass          = $('.tab-content').find("div.active").find('input[name="pass"]').val();
		var TN            = $('.tab-content').find("div.active").find('input[name="TN"]').val();
       
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
        if(accountno == null || accountno == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Bank Account No must be filled up');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
       /* else if(accountno.length > 16)
        {
            $('.mensahe').html('Bank Account No is too long');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(accountno.length < 16)
        {
            $('.mensahe').html('Bank Account No is too short');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        } */
        else if(bank == null || bank == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Select a Bank');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(bene_idtype == null || bene_idtype == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('ID Type must be filled up');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(bene_idno == null || bene_idno == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('ID Number must be filled up');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(amount == null || amount == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Amount must be filled up');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(pass == null || pass == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Transaction password must be filled up');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
            
    		$('.mensahe').html('Processing..');
            $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();      
        
    		$('.btncredit2bank').attr('disabled',true);	

                $.ajax({
    				url:"ecash_receiveData",
    				type:"post",
    				data:{btn:btn,beneficiary:beneficiary,accountno:accountno,bank:bank,amount:amount,pass:pass},
    				dataType:"json",
    				success: function(data) {
    
    					if(data["S"] == 1) {
    					   
    				        $('.mensahe').html(data["M"]);
                            $('.mensahe').html('Kindly review the correctness of data shown below: ');
                            $('.flasher').addClass('alert-info animated fadeInLeft').removeClass('alert-danger alert-success').fadeIn().delay(8000);
                            $('#sendCreditBank').empty();
                            $('#sendCreditBank').append(
                                '<h5 class="hr2"><span>Sender</span></h5>'+
	                                '<div class="form-group">'+
		                                '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Loyalty Card No. : </label>'+
		                                '<div class="col-md-12 col-lg-7">'+
		                                    '<input readonly="readonly" value="'+sender_id+'" name="sender_id" type="text" placeholder="Loyalty Card No." class="form-control sender_id animated flipInX delay050s" id="sender_id" required="">'+
		                                '</div>'+
		                            '</div>'+  
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Name : </label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input readonly="readonly" value="'+sender+'" name="sender_name" type="text" placeholder="Sender Full Name" class="form-control  animated flipInX delay050s" id="sender_name" required="">'+
                                        '</div>'+
                                    '</div>'+  
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Address : </label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input readonly="readonly" value="'+sender_address+'" name="sender_address" type="text" placeholder="Sender Address" class="form-control animated flipInX delay050s" id="sender_address" required="">'+
                                        '</div>'+
                                    '</div>'+                    
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay075s">Mobile Number : </label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input readonly="readonly" value="'+sender_mobile+'" name="sender_mobile" type="text" placeholder="Sender Mobile Number" class="form-control animated bounceInRight delay075s" id="sender_mobile" required="">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">'+
	                                    '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay075s">Email Address : </label>'+
	                                    '<div class="col-md-12 col-lg-7">'+
	                                        '<input readonly="readonly" value="'+sender_email+'" name="sender_email" type="text" placeholder="Sender Email Address" class="form-control animated bounceInRight delay075s" id="sender_email" required="">'+
	                                    '</div>'+
	                                '</div>'+
                                    '<div class="clearfix"></div>'+
                                 '<h5 class="hr2"><span>Beneficiary</span></h5>'+                
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Loyalty Card No. : </label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input readonly="readonly" value="'+bene_id+'" name="bene_id" type="text" placeholder="Loyalty Card No." class="form-control bene_id animated flipInX delay050s" id="bene_id" required="">'+
                                        '</div>'+
                                    '</div>'+ 
                                    '<div class="form-group">'+
	                                    '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Name : </label>'+
	                                    '<div class="col-md-12 col-lg-7">'+
	                                        '<input readonly="readonly" name="bene_name" type="text" placeholder="Sender Full Name" class="form-control animated flipInX delay050s" id="bene_name" required="" value="'+beneficiary+'">'+
	                                    '</div>'+
	                                '</div>'+ 
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Address : </label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input readonly="readonly" name="bene_address" type="text" placeholder="Sender Address" class="form-control animated flipInX delay050s" id="bene_address" required="" value="'+bene_address+'">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay075s">Mobile Number : </label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input readonly="readonly" name="bene_mobile" type="text" placeholder="Sender Mobile Number" class="form-control animated bounceInRight delay075s" id="bene_mobile" required="" value="'+bene_mobile+'">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">'+
	                                    '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay075s">Email Address : </label>'+
	                                    '<div class="col-md-12 col-lg-7">'+
	                                    	'<input readonly="readonly" value="'+bene_email+'" name="bene_email" type="text" placeholder="Beneficiary Email Address" class="form-control animated bounceInRight delay075s bene_email" id="bene_email" required="">'+
	                                    '</div>'+
                                    '</div>'+
                                    '<div class="clearfix"></div>'+
                                '<h5 class="hr2"><span>Input fields</span></h5>'+
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">Account Number : </label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input readonly="readonly" name="accountno" type="text" placeholder="Account Number" class="form-control acctno animated flipInY delay125s" id="idtype" required="" value="'+accountno+'">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">'+
	                                    '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">Bank Name : </label>'+
	                                    '<div class="col-md-12 col-lg-7">'+
	                                        '<input readonly="readonly" name="bankname" type="text" placeholder="Bank Name" class="form-control bank animated flipInY delay125s" id="bank" required="" value="'+bankname+'">'+
	                                        '<input readonly="readonly" name="bank" type="hidden" placeholder="Bank Name" class="form-control bank animated flipInY delay125s" id="bank" required="" value="'+bank+'">'+
	                                    '</div>'+
	                                '</div>'+
	                                '<div class="form-group">'+
	                                    '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">ID Type : </label>'+
	                                    '<div class="col-md-12 col-lg-7">'+
	                                        '<input readonly="readonly" name="idtype" type="text" placeholder="ID Type" class="form-control animated flipInY delay125s" id="idtype" required="" value="'+bene_idtype+'">'+
	                                    '</div>'+
	                                '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">ID Number : </label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input readonly="readonly" name="idnumber" type="text" placeholder="ID Number" class="form-control animated flipInY delay125s" id="idnumber" required="" value="'+bene_idno+'">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">Amount : </label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                          '<input readonly="readonly" name="amount" type="text" placeholder="Amount" class="form-control animated flipInY delay125s" id="amount" required="" value="'+amount+'">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">'+
	                                    '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">Charge : </label>'+
	                                    '<div class="col-md-12 col-lg-7">'+
	                                      '<input readonly="readonly" name="charge" type="text" placeholder="Charge" class="form-control animated charge flipInY delay125s" id="charge" required="" value="'+data['C']+'">'+
	                                    '</div>'+
	                                '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay125s">Trasaction Password : </label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input name="TN" type="hidden" placeholder="Tracking Number" class="form-control TN animated flipInY delay100s" id="TN" required  value="'+data['TN']+'"/>'+
                                            '<input name="pass" type="password" placeholder="Transaction Password" class="form-control pass animated flipInY delay100s" id="password" required  value=""/>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<div class="col-md-12 col-lg-12">'+
                                          '<button value="btnConfirmCredit2BankSend" id="btnConfirmCredit2BankSend" class="btn btn-primary btnConfirmCredit2BankSend pull-right">Confirm</button>'+
                                          '<button value="btnpayoutCredit2BankCancel" id="btnpayoutCredit2BankCancel" class="btn btn-danger btnpayoutCredit2BankCancel pull-right">Cancel</button>'+
                                        '</div>'+
                                    '</div>' /*+
                                    '<div class="form-group">'+
                                        '<div class="col-md-12 col-lg-12 text-center">'+
                                            '<em><strong class="text-warning">Note: This process is IRREVERSIBLE. Double-Check the data before you proceed.</strong></em>'+
                                        '</div>'+                                   
                                    '</div>'*/
                            );
    					}
    					else {
    
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
    				
    					}
                        $('.btncredit2bank').removeAttr('disabled');
                        $('#myModal').modal('hide');
    
    				}
    
    			});
    		
        }
	});



    $('#sendCreditBank').on('click','.btnConfirmCredit2BankSend',function(){
        var btn           = $(".btnConfirmCredit2BankSend").val();  
        var accountno     = $('.tab-content').find("div.active").find('input[name="accountno"]').val();
        var TN            = $('.tab-content').find("div.active").find('input[name="TN"]').val();
        var bene_name     = $('.tab-content').find("div.active").find('input[name="bene_name"]').val();
        var sender_id     = $('.tab-content').find("div.active").find('input[name="sender_id"]').val();
        var bene_id       = $('.tab-content').find("div.active").find('input[name="bene_id"]').val();
        var bank          = $('.tab-content').find("div.active").find('input[name="bank"]').val();
        var amount        = $('.tab-content').find("div.active").find('input[name="amount"]').val();
        var pass          = $('.tab-content').find("div.active").find('input[name="pass"]').val();
      
        if(pass == null || pass == "")
        {
            $('.mensahe').html('Transaction password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(10000).fadeOut();
        }
        else{
            
            $('.btnConfirmCredit2BankSend').attr('disabled',true);
            $.ajax({
                url:"ecash_receiveData",
                type:"post",
                data:{btn:btn, accountno:accountno, bene_name:bene_name, TN:TN, sender_id:sender_id, bene_id:bene_id, bank:bank, amount:amount, pass:pass},
                dataType:"json",
                success: function(data) {
                    if(data["S"] == 1) {
                    	$(".btnConfirmCredit2BankSend").removeAttr('disabled');
                        $('.mensahe').html(data['M']);
                        $('.flasher').addClass('alert-success').removeClass('alert-danger alert-info').fadeIn().delay(8000);
                        $('#sendCreditBank').empty();
                        $('#sendCreditBank').append(
                            '<div class="form-group">'+
                                '<label class="col-md-12 col-lg-5 control-label animated bounceInUp delay025s" for="">Reference Number : </label>'+
                                '<div class="col-md-12 col-lg-7">'+
                                    '<input type="text" readonly="readonly" id="interRef" class="form-control interRef c2bsend animated bounceInDown delay025s" value="'+TN+'" placeholder="Reference No" name="c2bsend">'+
                                '</div>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<div class="col-md-12 col-lg-12">'+
                                    '<form action="../file_generator/c2bsend_pdf" target="_blank" id="smart_form" method="POST">'+
                                        '<input type="hidden" readonly="readonly" id="interRef" class="form-control interRef c2bsend animated bounceInDown delay025s" value="'+TN+'" placeholder="Reference No" name="c2bsend">'+
                                        '<button value="btnpayoutPrintc2bsend" id="btnpayoutPrintc2bsend" target="_blank" class="btn btn-primary btnpayoutPrintc2bsend pull-right">Print Receipt</button>'+
                                    '</form>'+
                                    '<button value="btnpayoutNewc2bsend" id="btnpayoutNewc2bsend" target="_blank" class="btn btn-info btnpayoutNewc2bsend pull-right">New Transaction</button>'+
                                '</div>'+
                            '</div>'
                            
                        );
                    }
                    else {
                    	$(".btnConfirmCredit2BankSend").removeAttr('disabled');
                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(10000).fadeOut();
                
                    }
                    $('.btnConfirmCredit2BankSend').removeAttr('disabled');
                }
            });
        }
    });
    

    $('#sendCreditBank').on('click','.btnpayoutCredit2BankCancel',function(){
        location.reload(true);
        $('html, body').animate({scrollTop:0}, 'slow');
    });
    
    $('#sendCreditBank').on('click','.btnpayoutNewc2bsend',function(){
        location.reload(true);
        $('html, body').animate({scrollTop:0}, 'slow');
    });


// Start Payout
	
//SMART PAYOUT EDITED BY MERSON 
	$('#payoutSmartMoney').on('click','.btnpayoutSmart',function(){
		$(".btnpayoutSmart").attr('disable', true);
		var btn           = $(".btnpayoutSmart").val();        
		var refno         = $('.tab-content').find("div.active").find('input[name="smartpayoutRef"]').val();
		var amount        = $('.tab-content').find("div.active").find('input[name="smartpayoutAmount"]').val();
        var smartmoneyno  = $('.tab-content').find("div.active").find('input[name="smartpayoutSmartNo"]').val();
        var pass          = $('.tab-content').find("div.active").find('input[name="smartpayoutPass"]').val();
        
        //alert(refno);
        if(refno == null || refno == "")
        {
            $('.mensahe').html('Reference no must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(amount == null || amount == "")
        {
            $('.mensahe').html('Amount must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(smartmoneyno == null || smartmoneyno == "")
        {
            $('.mensahe').html('SmartmoneyNo must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(pass == null || pass == "")
        {
            $('.mensahe').html('Transaction password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
            
           
    		$('.mensahe').html('Processing..');
            $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();      
            

            // $('.btnpayoutSmart').attr('disabled',true);
    			$.ajax({
    				url:"ecash_sendData",
    				type:"post",
    				data:{btn:btn,refno:refno,amount:amount,smartmoneyno:smartmoneyno,pass:pass},
    				dataType:"json",
    				success: function(data) {
    					
    					if(data["S"] == 1) {
    						var total = parseInt(data["AMT"]) - parseInt(data["C"]);   
    						$('.btnpayoutSmart').removeAttr("disabled");
    						$('#payoutSmartMoney').empty();
    						$('.mensahe').html('Kindly review the correctness of data shown below: ');
                            $('.flasher').addClass('alert-info animated fadeInLeft').removeClass('alert-danger alert-success').fadeIn();
                            $('.tab-content').find("div.active").find('input[name="smartpayoutRef"]').val('');
                            $('.tab-content').find("div.active").find('input[name="smartpayoutPass"]').val('');
                            $('#payoutSmartMoney').append(
            		                    '<div class="form-group">'+
            		                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay100s">Amount : <span class="text-warning">*</span></label>'+
            		                        '<div class="col-md-12 col-lg-7">'+
            		                            '<input name="amount" readonly="readonly" type="text" value="'+data["amount"]+'" placeholder="Amount" class="form-control numOnly amount animated flipInY delay100s" id="amount" required="">'+
            		                            '<input name="refno" readonly="readonly" type="hidden" value="'+refno+'" placeholder="Amount" class="form-control numOnly amount animated flipInY delay100s" id="amount" required="">'+
            		                        '</div>'+
            		                    '</div>'+
            		                    '<div class="form-group">'+
	        		                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay100s">Charge : <span class="text-warning">*</span></label>'+
	        		                        '<div class="col-md-12 col-lg-7">'+
	        		                            '<input name="charge" readonly="readonly" type="text" value="'+data["charge"]+'" placeholder="Charge" class="form-control numOnly amount animated flipInY delay100s" id="amount" required="">'+
	        		                        '</div>'+
	        		                    '</div>'+
            		                    '<div class="form-group">'+
            		                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay100s">ID Type : <span class="text-warning">*</span></label>'+
            		                        '<div class="col-md-12 col-lg-7">'+
            		                            '<input name="idtype" type="text" placeholder="ID Type" class="form-control animated flipInY delay100s idtype" id="idtype" required="">'+
            		                        '</div>'+
            		                    '</div>'+
            		                    '<div class="form-group">'+
            		                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay100s">ID Number : <span class="text-warning">*</span></label>'+
            		                        '<div class="col-md-12 col-lg-7">'+
            		                            '<input name="idnumber" type="text" placeholder="ID Number" class="form-control animated flipInY delay100s idnumber" id="idnumber" required="">'+
            		                        '</div>'+
            		                    '</div>'+
            		                    '<div class="form-group">'+
            		                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay100s">Password : <span class="text-warning">*</span></label>'+
            		                        '<div class="col-md-12 col-lg-7">'+
            		                            '<input name="pass" type="password" placeholder="Transaction Password" class="form-control pass animated flipInY delay100s" id="pass" required="">'+
            		                        '</div>'+
            		                    '</div>'+
            		                    '<div class="form-group">'+
            		                       '<div class="col-md-12 col-lg-12">'+
            		                       		'<button value="btnpayoutConfirmSmartmoney" id="btnpayoutConfirmSmartmoney" class="btn btn-primary btnpayoutConfirmSmartmoney pull-right">Confirm</button>'+
            		                       		'<button value="btnpayoutCancelSmartmoney" id="btnpayoutCancelSmartmoney" class="btn btn-danger btnpayoutCancelSmartmoney pull-right">Cancel</button>'+
            		                        '</div>'+
            		                    '</div>'+
            		                '</div>'
        						);
    					}
    					else {
    						$('.btnpayoutSmart').removeAttr("disabled");
                            $('.mensahe').html(data["M"]);
                            //$('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
							$('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn();
    				
    					}
                        $('.btnpayoutSmart').removeAttr('disabled');
    
    				}
    
    			});
    		
        }
	});

   
	$('#payoutSmartMoney').on('click','.btnpayoutConfirmSmartmoney',function(){
		
		$('.btnpayoutConfirmSmartmoney').attr("disabled", true);	
		
		var btn                 = $(".btnpayoutConfirmSmartmoney").val();        
		var refno               = $('.tab-content').find("div.active").find('input[name="refno"]').val();
		var idtype          	= $('.tab-content').find("div.active").find('input[name="idtype"]').val();
		var idnumber            = $('.tab-content').find("div.active").find('input[name="idnumber"]').val();
		var amount              = $('.tab-content').find("div.active").find('input[name="amount"]').val();
		var charge              = $('.tab-content').find("div.active").find('input[name="charge"]').val();
		var pass                = $('.tab-content').find("div.active").find('input[name="pass"]').val();
		
		if(refno == null || refno == "")
        {
			$('.btnpayoutConfirmSmartmoney').removeAttr("disabled");
            $('.mensahe').html('Reference no must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(idtype == null || idtype == "")
        {
        	$('.btnpayoutConfirmSmartmoney').removeAttr("disabled");
            $('.mensahe').html('ID type must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(idnumber == null || idnumber == "")
        {
        	$('.btnpayoutConfirmSmartmoney').removeAttr("disabled");
            $('.mensahe').html('ID number must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut(); 
        }
        else{
			
        	$('.mensahe').html('Processing..');
	        $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();
			
            $('.btnpayoutConfirmSmartmoney').attr('disabled',true);

	        $.ajax({
				url:"ecash_sendData",
				type:"post",
				data:{btn:btn, refno:refno, idtype:idtype, idnumber:idnumber, amount:amount,charge:charge, pass:pass},
				dataType:"json",
				success: function(data) {
					if(data["S"] == 1) {
						$('.btnpayoutConfirmSmartmoney').removeAttr("disabled");
				        $('.mensahe').html(data['M']);
	                    $('.flasher').addClass('alert-success').removeClass('alert-danger alert-info').fadeIn().delay(8000);
	                    $('#payoutSmartMoney').empty();
	            		$('#payoutSmartMoney').append(
	                        '<div class="form-group">'+
	                            '<label class="col-md-12 col-lg-5 control-label animated bounceInUp delay025s" for="">Reference Number : </label>'+
	                            '<div class="col-md-12 col-lg-7">'+
	                                '<input type="text" readonly="readonly" id="interRef" class="form-control interRef animated bounceInDown delay025s" value="'+refno+'" placeholder="Reference No" name="IremitRef">'+
	                            '</div>'+
	                        '</div>'+
	                        '<div class="form-group">'+
		                        '<div class="col-md-12 col-lg-12">'+
									'<form action="../file_generator/smartmoney_pdf" target="_blank" id="smart_form" method="POST">'+
										'<input type="hidden" readonly="readonly" id="interRef" class="form-control interRef smartref animated bounceInDown delay025s" value="'+refno+'" placeholder="Reference No" name="smartref">'+
									    '<button value="btnpayoutPrintSmartmoney" id="btnpayoutPrintSmartmoney" target="_blank" class="btn btn-primary btnpayoutPrintSmartmoney pull-right">Print Receipt</button>'+
									'</form>'+
									'<button value="btnpayoutNewSmartmoney" id="btnpayoutNewSmartmoney" target="_blank" class="btn btn-info btnpayoutNewSmartmoney pull-right">New Transaction</button>'+
								'</div>'+
							'</div>'
							
	            		);
					}
					else {
						$('.btnpayoutConfirmSmartmoney').removeAttr("disabled");	
	                    $('.mensahe').html(data["M"]);
	                    $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
				
					}
                    $('.btnpayoutConfirmSmartmoney').removeAttr('disabled');
				}
			});
        }
	});
	
    
    $('#payoutSmartmoney').on('click','.btnpayoutPrintSmartmoney',function(ev){
         ev.preventDefault();
        $("#smart_form").attr('action').attr('target', '_blank').submit();
        $('.smartref').val('');
        
    });
    
    $('#payoutSmartMoney').on('click','.btnpayoutCancelSmartmoney',function(){
        // alert('assda');
        $('.flasher').hide();
         $('#payoutSmartMoney').empty();
         $('#payoutSmartMoney').append(                                
             '<div class="form-group">'+
                 '<label class="col-md-12 col-lg-5 control-label animated bounceIn delay025s" for="">Input Reference No : <span class="text-warning">*</span></label>'+
                 '<div class="col-md-12 col-lg-7">'+
                     '<input type="text" id="smartpayoutRef" class="form-control smartpayoutRef animated bounceInLeft delay025s" placeholder="Reference No" name="smartpayoutRef">'+
                 '</div>'+
             '</div>'+
             '<div class="form-group">'+
                 '<label class="col-md-12 col-lg-5 control-label animated bounceIn delay025s" for="">Input Amount : <span class="text-warning">*</span></label>'+
                 '<div class="col-md-12 col-lg-7">'+
                     '<input type="text" id="smartpayoutAmount" class="form-control smartpayoutAmount animated bounceInLeft delay025s" placeholder="Amount" name="smartpayoutAmount">'+
                 '</div>'+
             '</div>'+
             '<div class="form-group">'+
                 '<label class="col-md-12 col-lg-5 control-label animated bounceIn delay025s" for="">Input Smartmoney No : <span class="text-warning">*</span></label>'+
                 '<div class="col-md-12 col-lg-7">'+
                     '<input type="text" id="smartpayoutSmartNo" class="form-control smartpayoutSmartNo animated bounceInLeft delay025s" placeholder="Smartmoney No" name="smartpayoutSmartNo" maxlength="16">'+
                 '</div>'+
             '</div>'+
             '<div class="form-group">'+
                 '<label class="col-md-12 col-lg-5 control-label animated bounceIn delay050s" for="">Password : <span class="text-warning">*</span></label>'+
                 '<div class="col-md-12 col-lg-7">'+
                     '<input type="password" id="smartpayoutPass" class="form-control smartpayoutPass animated bounceInRight delay075s" placeholder="Transaction password" name="smartpayoutPass">'+
                 '</div>'+
             '</div>'+
             '<div class="form-group">'+
                 '<div class="col-md-12 col-lg-12">'+
                     '<button name="btnpayoutSmart" value="btnpayoutSmart" id="btnpayoutSmart" class="btn btn-primary btnpayoutSmart animated bounceIn delay025s pull-right">Submit</button>'+
                 '</div>'+
             '</div>'
         );
    });
    
	

	$('#payoutSmartmoney').on('click','.btnpayoutNewSmartmoney',function(){
		alert('New');
		$('.flasher').hide();
		$('#payoutSmartMoney').empty();
		$('#payoutSmartMoney').append(                                
		    '<div class="form-group">'+
		        '<label class="col-md-12 col-lg-5 control-label animated bounceIn delay025s" for="">Input Reference No : <span class="text-warning">*</span></label>'+
		        '<div class="col-md-12 col-lg-7">'+
		            '<input type="text" id="smartpayoutRef" class="form-control smartpayoutRef animated bounceInLeft delay025s" placeholder="Reference No" name="smartpayoutRef">'+
		        '</div>'+
		    '</div>'+
		    '<div class="form-group">'+
                 '<label class="col-md-12 col-lg-5 control-label animated bounceIn delay025s" for="">Input Amount : <span class="text-warning">*</span></label>'+
                 '<div class="col-md-12 col-lg-7">'+
                     '<input type="text" id="smartpayoutAmount" class="form-control smartpayoutAmount animated bounceInLeft delay025s" placeholder="Amount" name="smartpayoutAmount">'+
                 '</div>'+
             '</div>'+
             '<div class="form-group">'+
                 '<label class="col-md-12 col-lg-5 control-label animated bounceIn delay025s" for="">Input Smartmoney No : <span class="text-warning">*</span></label>'+
                 '<div class="col-md-12 col-lg-7">'+
                     '<input type="text" id="smartpayoutSmartNo" class="form-control smartpayoutSmartNo animated bounceInLeft delay025s" placeholder="Smartmoney No" name="smartpayoutSmartNo" maxlength="16">'+
                 '</div>'+
             '</div>'+
             '<div class="form-group">'+
		        '<label class="col-md-12 col-lg-5 control-label animated bounceIn delay050s" for="">Password : <span class="text-warning">*</span></label>'+
		        '<div class="col-md-12 col-lg-7">'+
		            '<input type="password" id="smartpayoutPass" class="form-control smartpayoutPass animated bounceInRight delay075s" placeholder="Transaction password" name="smartpayoutPass">'+
		        '</div>'+
		    '</div>'+
		    '<div class="form-group">'+
		        '<div class="col-md-12 col-lg-12">'+
		            '<button name="btnpayoutSmart" value="btnpayoutSmart" id="btnpayoutSmart" class="btn btn-primary btnpayoutSmart animated bounceIn delay025s pull-right">Submit</button>'+
		        '</div>'+
		    '</div>'
		);
	});
	
//SMART PAYOUT EDITED BY MERSON 
    

	
//EPADALA
	$('#payoutEpadala').on('click','.btnpayoutEpadala',function(){
		$('html, body').animate({scrollTop:0}, 'slow');
		var btn           = $(".btnpayoutEpadala").val();        
		var refno         = $('.tab-content').find("div.active").find('input[name="epadalapayoutRef"]').val();
		var pass          = $('.tab-content').find("div.active").find('input[name="epadalapayoutPass"]').val();
        
        
        if(refno == null || refno == "")
        {
            $('.mensahe').html('Reference no must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(pass == null || pass == "")
        {
            $('.mensahe').html('Transaction password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
            
           
    		$('.mensahe').html('Processing..');
            $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();      
            $('.btnpayoutEpadala').attr('disabled',true);

    			$.ajax({
    				url:"ecash_sendData",
    				type:"post",
    				data:{btn:btn,refno:refno,pass:pass},
    				dataType:"json",
    				success: function(data) {
    
    					if(data["S"] == 1) {
    						// var obj = jQuery.parseJSON(data['sender']);
    						// var object = jQuery.parseJSON(data['beneficiary']);
    						// var beneficiary = object.firstname+' '+object.middlename+' '+object.lastname;
    						// var address = object.address;
    						// var sendermobile = obj.mobilenumber;
    						$('#payoutEpadala').empty();
    				        $('.mensahe').html('Kindly review the correctness of data shown below: ');
                            $('.flasher').addClass('alert-info animated fadeInLeft').removeClass('alert-danger alert-success').fadeIn();
                            $('.tab-content').find("div.active").find('input[name="epadalapayoutRef"]').val('');
                            $('.tab-content').find("div.active").find('input[name="epadalapayoutPass"]').val('');
                            $('#payoutEpadala').append(
                                '<h5 class="hr2"><span>Sender</span></h5>'+
                                '<div id="sender_info" class="sender_info" style="">'+
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Loyalty Card No : <span class="text-warning">*</span></label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input readonly="readonly" value="'+data["sender_id"]+'" name="sender_id" type="text" placeholder="Sender Full Name" class="form-control typeahead sender_id animated flipInX delay050s" id="sender_id" required="">'+
                                            '<input readonly="readonly" value="'+refno+'" name="refno" type="hidden" placeholder="Sender Full Name" class="form-control typeahead sender_id animated flipInX delay050s" id="sender_id" required="">'+
                                        '</div>'+
                                    '</div>'+ 
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Name : <span class="text-warning">*</span></label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input readonly="readonly" value="'+data["sender"]+'" name="sender_name" type="text" placeholder="Sender Full Name" class="form-control typeahead sender_name animated flipInX delay050s" id="sender_name" required="">'+
                                        '</div>'+
                                    '</div>'+  
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Address : <span class="text-warning">*</span></label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input readonly="readonly" value="'+data["address"]+'" name="sender_address" type="text" placeholder="Sender Address" class="form-control animated sender_address flipInX delay050s" id="sender_address" required="">'+
                                        '</div>'+
                                    '</div>'+                    
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay075s">Mobile Number : <span class="text-warning">*</span></label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input readonly="readonly" value="'+data["SMOB"]+'" name="sender_mobile" type="text" placeholder="Sender Mobile Number" class="form-control sender_mobile animated bounceInRight delay075s" id="" required="">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay100s">Email : <span class="text-warning">*</span></label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input readonly="readonly" value="'+data["email"]+'" name="sender_email" type="text" placeholder="Sender Email" class="form-control sender_email animated flipInY delay100s" id="sender_email" required="">'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="clearfix"></div>'+
                             '<h5 class="hr2"><span>Beneficiary</span></h5>'+
                                '<div id="beneficiary_info" class="beneficiary_info" style="">'+
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Loyalty Card No : <span class="text-warning">*</span></label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input readonly="readonly" value="'+data["bene_id"]+'" name="bene_id" type="text" placeholder="Sender Full Name" class="form-control bene_id animated flipInX delay050s" id="" required="">'+
                                        '</div>'+
                                    '</div> '+
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Name : <span class="text-warning">*</span></label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input readonly="readonly" value="'+data["bene_name"]+'" name="bene_name" type="text" placeholder="Beneficiary Full Name" class="form-control bene_name animated flipInX delay050s" id="bene_name" required="">'+
                                        '</div>'+
                                    '</div>'+  
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay050s">Address : <span class="text-warning">*</span></label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input readonly="readonly" value="'+data["bene_address"]+'" name="bene_address" type="text" placeholder="Beneficiary Address" class="form-control bene_address animated flipInX delay050s" id="bene_address" required="">'+
                                        '</div>'+
                                    '</div>'+                    
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay075s">Mobile Number : <span class="text-warning">*</span></label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input readonly="readonly" name="bene_mobile" value="'+data["mobile"]+'" type="text" placeholder="Beneficiary Mobile Number" class="form-control bene_mobile animated bounceInRight delay075s" id="bene_mobile" required="">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay100s">Email : <span class="text-warning">*</span></label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input readonly="readonly" value="'+data["bene_email"]+'" name="bene_email" type="text" placeholder="Beneficiary Email" class="form-control bene_email animated flipInY delay100s" id="bene_email" required="">'+
                                        '</div>'+
                                    '</div>'+
                                 '<div class="clearfix"></div>'+   
                                 '<h5 class="hr2"><span>Input Fields</span></h5>'+     
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay025s">Tracking Number : <span class="text-warning">*</span></label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input readonly="readonly" name="trackno" value="'+data["TN"]+'" type="text" placeholder="Tracking Number" class="form-control numOnly trackno animated bounceInLeft delay025s" id="trackno" required="">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay100s">Amount : <span class="text-warning">*</span></label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input name="amount" readonly="readonly" type="text" value="'+data["Amount"]+'" placeholder="Amount" class="form-control numOnly amount animated flipInY delay100s" id="amount" required="">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay100s">ID Type : <span class="text-warning">*</span></label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input name="idtype" type="text" placeholder="ID Type" class="form-control animated flipInY delay100s idtype" id="idtype" required="">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay100s">ID Number : <span class="text-warning">*</span></label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input name="idnumber" type="text" placeholder="ID Number" class="form-control animated flipInY delay100s idnumber" id="idnumber" required="">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated bounceInDown delay100s">Password : <span class="text-warning">*</span></label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input name="pass" type="password" placeholder="Transaction Password" class="form-control pass animated flipInY delay100s" id="pass" required="">'+
                                        '</div>'+
                                    '</div>'+
        				
        							'<div class="form-group">'+
        								'<div class="col-md-12 col-lg-12">'+
        								  '<button value="btnpayoutConfirmEpadala" id="btnpayoutConfirmEpadala" class="btn btn-primary btnpayoutConfirmEpadala pull-right">Confirm</button>'+
        								  '<button value="btnpayoutCancelEpadala" id="btnpayoutCancelEpadala" class="btn btn-danger btnpayoutCancelEpadala  pull-right">Cancel</button>'+
        								'</div>'+
        							'</div>'+
    								'<div class="form-group">'+
	    								'<div class="col-md-12 col-lg-12 text-center">'+
	    									'<em><strong class="text-warning">Note: This process is IRREVERSIBLE. Double-Check the data before you proceed.</strong></em>'+
	    								'</div>'+									
    								'</div>'
        						);
    					}
    					else {
    
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
    				
    					}

                        $('.btnpayoutEpadala').removeAttr('disabled');
    
    				}
    
    			});
    		
        }
	});
	
	$('#payoutEpadala').on('click','.btnpayoutConfirmEpadala',function(){
		$('.btnpayoutConfirmEpadala').attr("disabled", true);	
		var btn                  = $(".btnpayoutConfirmEpadala").val();        
		var refno                = $('.tab-content').find("div.active").find('input[name="trackno"]').val();
		var bene_id              = $('.tab-content').find("div.active").find('input[name="bene_id"]').val();
		var sender_id			 = $('.tab-content').find("div.active").find('input[name="sender_id"]').val();
		var idtype			     = $('.tab-content').find("div.active").find('input[name="idtype"]').val();
		var idnumber      		 = $('.tab-content').find("div.active").find('input[name="idnumber"]').val();
		var pass                 = $('.tab-content').find("div.active").find('input[name="pass"]').val();
		
		$('.mensahe').html('Processing..');
        $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();
		
        $('.btnpayoutConfirmEpadala').attr('disabled',true);

        $.ajax({
			url:"ecash_sendData",
			type:"post",
			data:{btn:btn, refno:refno, bene_id:bene_id, sender_id:sender_id, idtype:idtype, idnumber:idnumber, pass:pass},
			dataType:"json",
			success: function(data) {
				$('.btnpayoutConfirmEpadala').removeAttr('disabled');
				if(data["S"] == 1) {
			        $('.mensahe').html(data['M']);
                    $('.flasher').addClass('alert-success').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                    $('.tab-content').find("div.active").find('input[name="epadalaRef"]').val('');
                    $('.tab-content').find("div.active").find('input[name="epadalapayoutPass"]').val('');
                    $('#payoutEpadala').empty();
            		$('#payoutEpadala').append(
                        '<div class="form-group">'+
                            '<label class="col-md-12 col-lg-5 control-label animated bounceInUp delay025s" for="">Reference Number : </label>'+
                            '<div class="col-md-12 col-lg-7">'+
                                '<input type="text" readonly="readonly" id="interRef" class="form-control interRef animated bounceInDown delay025s" value="'+refno+'" placeholder="Reference No" name="IremitRef">'+
                            '</div>'+
                        '</div>'+
                        '<div class="form-group">'+
	                        '<div class="col-md-12 col-lg-12">'+
								'<form action="../file_generator/epadala_pdf" id="epadala_form" method="POST">'+
									'<input type="hidden" readonly="readonly" id="interRef" class="form-control interRef animated bounceInDown delay025s" value="'+refno+'" placeholder="Reference No" name="epadalaref">'+
								    '<button value="btnpayoutPrintEpadala" id="btnpayoutPrintEpadala" class="btn btn-primary btnpayoutPrintEpadala pull-right">Print Receipt</button>'+
								'</form>'+
								'<button value="btnpayoutNewEpadala" id="btnpayoutNewEpadala" target="_blank" class="btn btn-info btnpayoutNewEpadala pull-right">New Transaction</button>'+
							'</div>'+
						'</div>'
						
            		);
				}
				else {

                    $('.mensahe').html(data["M"]);
                    $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
			
				}
                $('.btnpayoutConfirmEpadala').removeAttr('disabled');
			}
		});
	});
	
	
	$('#payoutEpadala').on('click','.btnpayoutPrintEpadala',function(ev){
		 ev.preventDefault();
	    $("#epadala_form").attr('target', '_blank').submit();
		$('.epadalaref').val('');
		
	});
	
	$('#payoutEpadala').on('click','.btnpayoutCancelEpadala',function(){
		$('.flasher').hide();
		$('#payoutEpadala').empty();
		$('#payoutEpadala').append(                
            '<div class="form-group">'+
                '<label class="col-md-12 col-lg-5 control-label animated bounceIn delay025s" for="">Input Reference No : <span class="text-warning">*</span></label>'+
                '<div class="col-md-12 col-lg-7">'+
                    '<input type="text" id="epadalapayoutRef" name="epadalapayoutRef" class="form-control animated bounceInLeft delay025s" placeholder="Reference No">'+
                '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<label class="col-md-12 col-lg-5 control-label animated bounceIn delay050s" for="">Password : <span class="text-warning">*</span></label>'+
                '<div class="col-md-12 col-lg-7">'+
                    '<input type="password" id="epadalapayoutPass" name="epadalapayoutPass" class="form-control  animated bounceInRight delay075s" placeholder="Transaction password" title="" data-placement="top" data-toggle="tooltip" data-original-title="Transaction password">'+
                '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<div class="col-md-12 col-lg-12">'+
                    '<button name="btnpayoutEpadala" value="btnpayoutEpadala" id="btnpayoutEpadala" class="btn btnpayoutEpadala btn-primary animated bounceIn delay025s pull-right">Submit</button>'+
                '</div>'+
            '</div>'
		);
	});
	
	$('#payoutEpadala').on('click','.btnpayoutNewEpadala',function(){
		$('.flasher').hide();
		$('#payoutEpadala').empty();
		$('#payoutEpadala').append(                
            '<div class="form-group">'+
                '<label class="col-md-12 col-lg-5 control-label animated bounceIn delay025s" for="">Input Reference No : <span class="text-warning">*</span></label>'+
                '<div class="col-md-12 col-lg-7">'+
                    '<input type="text" id="epadalapayoutRef" name="epadalapayoutRef" class="form-control animated bounceInLeft delay025s" placeholder="Reference No">'+
                '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<label class="col-md-12 col-lg-5 control-label animated bounceIn delay050s" for="">Password : <span class="text-warning">*</span></label>'+
                '<div class="col-md-12 col-lg-7">'+
                    '<input type="password" id="epadalapayoutPass" name="epadalapayoutPass" class="form-control  animated bounceInRight delay075s" placeholder="Transaction password" title="" data-placement="top" data-toggle="tooltip" data-original-title="Transaction password">'+
                '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<div class="col-md-12 col-lg-12">'+
                    '<button name="btnpayoutEpadala" value="btnpayoutEpadala" id="btnpayoutEpadala" class="btn btnpayoutEpadala btn-primary animated bounceIn delay025s pull-right">Submit</button>'+
                '</div>'+
            '</div>'
		);
	});
	
//I-REMIT    
	$('#payoutiremit').on('click','.btnpayoutIremit',function(){
		$('html, body').animate({scrollTop:0}, 'slow');
		var btn           = $(".btnpayoutIremit").val();        
		var refno         = $('.tab-content').find("div.active").find('input[name="IremitRef"]').val();
		var pass          = $('.tab-content').find("div.active").find('input[name="IremitPass"]').val();
        
        
        if(refno == null || refno == "")
        {
            $('.mensahe').html('Reference no must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(pass == null || pass == "")
        {
            $('.mensahe').html('Transaction password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
            
           
    		$('.mensahe').html('Processing..');
            $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();      
            
            $('.btnpayoutIremit').attr('disabled',true);

    			$.ajax({
    				url:"ecash_sendData",
    				type:"post",
    				data:{btn:btn,refno:refno,pass:pass},
    				dataType:"json",
    				success: function(data) {
    
    					if(data["S"] == 1) {
    						$('#payoutiremit').empty();
    				        $('.mensahe').html('Kindly review the correctness of data shown below: ');
                            $('.flasher').addClass('alert-info animated fadeInLeft').removeClass('alert-danger alert-success').fadeIn();
                            $('.tab-content').find("div.active").find('input[name="IremitRef"]').val('');
                            $('.tab-content').find("div.active").find('input[name="IremitPass"]').val('');
                            $('.btnpayoutIremit').removeAttr('disabled');
        						
        						$('#payoutiremit').append(
                                    '<div class="form-group">'+
                                        '<h5 class="hr2">'+
                                            '<span>Sender</span>'+
                                        '</h5>'+
                                    '</div>'+
        							'<div class="form-group">'+
        								'<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Tracking number :</label>'+
        								'<div class="col-md-12 col-lg-7">'+
        									'<input readonly="readonly" name="iremitRef" type="text" placeholder="Tracking number" value="'+data["TN"]+'" class="form-control iremitRef" id="iremitRef" required="">'+
        									'<input readonly="readonly" name="regcode" type="hidden" placeholder="Tracking number" value="'+data["regcode"]+'" class="form-control regcode" id="regcode" required="">'+
        								'</div>'+
        							'</div>'+
        							'<div class="form-group">'+
	    								'<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Sender Name :</label>'+
	    								'<div class="col-md-12 col-lg-7">'+
	    									'<input readonly="readonly" name="sendername" type="text" placeholder="Sender Name"  value="'+data["sender"]+'" class="form-control sendername" id="sendername" required="">'+
	    								'</div>'+
	    							'</div>'+
        							'<div class="form-group">'+
        								'<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Amount :</label>'+
        								'<div class="col-md-12 col-lg-7">'+
        									'<input readonly="readonly" name="amount" type="text" placeholder="Amount" value="'+data["amount"]+'" class="form-control amount" id="amount" required="">'+
        								'</div>'+									
        							'</div>'+
                                    '<div class="clearfix">'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<h5 class="hr2">'+
                                            '<span>Beneficiary</span>'+
                                        '</h5>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Beneficiary Name :</label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input readonly="readonly" name="accountname" type="text" placeholder="Beneficiary Name"  value="'+data["beneficiary"]+'" class="form-control accountname" id="accountname" required="">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Beneficiary Mobile Number :</label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input readonly="readonly" name="benemobile" type="text" placeholder="Beneficiary Mobile Number"  value="'+data["bene_mobile"]+'" class="form-control benemobile" id="benemobile" required="">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Address :</label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input name="address" type="text" placeholder="Address" value="" class="form-control address" id="address" required="">'+
                                        '</div>'+                                   
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Email :</label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input name="email" type="email" placeholder="email@example.com" value="" class="form-control email" id="email" required="">'+
                                        '</div>'+                                   
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">ID Type :</label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input name="idtype" type="text" placeholder="ID Type" value="" class="form-control idtype" id="idtype" required="">'+
                                        '</div>'+                                   
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">ID Number :</label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input name="idnumber" type="text" placeholder="ID Number" value="" class="form-control idnumber" id="idnumber" required="">'+
                                        '</div>'+                                   
                                    '</div>'+
        							'<div class="form-group">'+
        								'<div class="col-md-12 col-lg-12">'+
        								  '<button value="btnpayoutConfirmIremit" id="btnpayoutConfirmIremit" class="btn btn-primary btnpayoutConfirmIremit pull-right">Confirm</button>'+
        								  '<button value="btnpayoutCancelIremit" id="btnpayoutCancelIremit" class="btn btn-danger btnpayoutCancelIremit  pull-right">Cancel</button>'+
        								'</div>'+
        							'</div>'/*+
    								'<div class="form-group">'+
	    								'<div class="col-md-12 col-lg-12 text-center">'+
	    									'<em><strong class="text-warning">Note: This process is IRREVERSIBLE. Double-Check the data before you proceed.</strong></em>'+
	    								'</div>'+									
    								'</div>'*/
        						);
    					}
    					else {
    
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
    				
    					}

                        $('.btnpayoutIremit').removeAttr('disabled');
    
    				}
    
    			});
    		
        }
	});
	

	$('#payoutiremit').on('click','.btnpayoutConfirmIremit',function(){
		// $('.btnpayoutConfirmIremit').attr("disabled", true);	
		var btn           = $(".btnpayoutConfirmIremit").val();        
		var refno         = $('.tab-content').find("div.active").find('input[name="iremitRef"]').val();
		var regcode       = $('.tab-content').find("div.active").find('input[name="regcode"]').val();
		var accountname   = $('.tab-content').find("div.active").find('input[name="accountname"]').val();
		var amount        = $('.tab-content').find("div.active").find('input[name="amount"]').val();
        var benemobile    = $('.tab-content').find("div.active").find('input[name="benemobile"]').val();
        var address       = $('.tab-content').find("div.active").find('input[name="address"]').val();
        var email         = $('.tab-content').find("div.active").find('input[name="email"]').val();
        var idtype        = $('.tab-content').find("div.active").find('input[name="idtype"]').val();
        var idnumber      = $('.tab-content').find("div.active").find('input[name="idnumber"]').val();

        if(address == null || address == "")
        {
            $('.mensahe').html('Address must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(email == null || email == "")
        {
            $('.mensahe').html('Email must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(idtype == null || idtype == "")
        {
            $('.mensahe').html('ID Type must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(idnumber == null || idnumber == "")
        {
            $('.mensahe').html('ID Number must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{

        $('.mensahe').html('Processing..');
        $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();
		  
        $('.btnpayoutConfirmIremit').attr('disabled',true);
        $.ajax({
			url:"ecash_sendData",
			type:"post",
			data:{btn:btn,refno:refno,regcode:regcode,accountname:accountname,amount:amount,benemobile:benemobile,address:address,email:email,idtype:idtype,idnumber:idnumber},
			dataType:"json",
			success: function(data) {
                //console.log(data);
				$('.btnpayoutConfirmIremit').removeAttr('disabled');
				if(data["S"] == 1) {
					$('#payoutiremit').empty();
			        $('.mensahe').html(data['M']);
                    $('.flasher').addClass('alert-success').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                    $('.tab-content').find("div.active").find('input[name="transfastRef"]').val('');
                    $('.tab-content').find("div.active").find('input[name="transfastPass"]').val('');
            		$('#payoutiremit').append(
                        '<div class="form-group">'+
                            '<label class="col-md-12 col-lg-5 control-label animated bounceInUp delay025s" for="">Tracking Number : </label>'+
                            '<div class="col-md-12 col-lg-7">'+
                                '<input type="text" readonly="readonly" id="interRef" class="form-control interRef animated bounceInDown delay025s" value="'+refno+'" placeholder="Tracking No" name="IremitRef">'+
                            '</div>'+
                        '</div>'+
                        '<div class="form-group">'+
							'<div class="col-md-12 col-lg-12">'+
                               '<form action="../file_generator/iremit_pdf" target="_blank" id="iremit_form" method="POST">'+
                                    '<input type="hidden" readonly="readonly" id="interRef" class="form-control interRef IremitRef animated bounceInDown delay025s" value="'+refno+'" placeholder="Tracking No" name="IremitRef">'+
                                    '<button value="btnpayoutPrintIremit1" id="btnpayoutPrintIremit1" class="btn btn-primary btnpayoutPrintIremit1 pull-right">Print Receipt</button>'+
                                '</form>'+
                                    '<button value="btnpayoutNewIremit" id="btnpayoutNewIremit" class="btn btn-info btnpayoutNewIremit pull-right">New Transaction</button>'+
							'</div>'+
						'</div>'
            		);
				}
				else {

                    $('.mensahe').html(data["M"]);
                    $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
			
    				}
                    $('.btnpayoutConfirmIremit').removeAttr('disabled');
    			}
    		});
        }
	});

    // $('#payoutiremit').on('click','.btnpayoutPrintIremit1',function(ev){
    //      ev.preventDefault();
    //     $("#iremit_form").attr('action').attr('target', '_blank').submit();
    //     $('.IremitRef').val('');
    // });
	
	$('#payoutiremit').on('click','.btnpayoutNewIremit',function(){
		$('.flasher').hide();
		$('#payoutiremit').empty();
		$('#payoutiremit').append(
			'<div class="form-group">'+
                '<label class="col-md-12 col-lg-5 control-label animated bounceInUp delay025s" for="">Input Tracking No : <span class="text-warning">*</span></label>'+
                '<div class="col-md-12 col-lg-7">'+
                    '<input type="text" required="" id="interRef" class="form-control interRef animated bounceInDown delay025s" placeholder="Tracking No" name="IremitRef">'+
                '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<label class="col-md-12 col-lg-5 control-label animated bounceIn delay050s" for="">Password : <span class="text-warning">*</span></label>'+
                '<div class="col-md-12 col-lg-7">'+
                    '<input type="password" id="interPass" class="form-control interPass animated bounceInRight delay075s" placeholder="Transaction password" title="" data-placement="top" data-toggle="tooltip" name="IremitPass" data-original-title="Transaction password">'+
                '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<div class="col-md-12 col-lg-12">'+
                    '<button name="btnpayoutIremit" value="btnpayoutIremit" id="btnpayoutIremit" class="btn btn-primary btnpayoutIremit  animated bounceIn delay025s pull-right">Submit</button>'+
                '</div>'+
            '</div>'  
		);
	});
	
	$('#payoutiremit').on('click','.btnpayoutCancelIremit',function(){
		$('.flasher').hide();
		$('#payoutiremit').empty();
		$('#payoutiremit').append(
			'<div class="form-group">'+
                '<label class="col-md-12 col-lg-5 control-label animated bounceInUp delay025s" for="">Input Tracking No : <span class="text-warning">*</span></label>'+
                '<div class="col-md-12 col-lg-7">'+
                    '<input type="text" required="" id="interRef" class="form-control interRef animated bounceInDown delay025s" placeholder="Tracking No" name="IremitRef">'+
                '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<label class="col-md-12 col-lg-5 control-label animated bounceIn delay050s" for="">Password : <span class="text-warning">*</span></label>'+
                '<div class="col-md-12 col-lg-7">'+
                    '<input type="password" id="interPass" class="form-control interPass animated bounceInRight delay075s" placeholder="Transaction password" title="" data-placement="top" data-toggle="tooltip" name="IremitPass" data-original-title="Transaction password">'+
                '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<div class="col-md-12 col-lg-12">'+
                    '<button name="btnpayoutIremit" value="btnpayoutIremit" id="btnpayoutIremit" class="btn btn-primary btnpayoutIremit  animated bounceIn delay025s pull-right">Submit</button>'+
                '</div>'+
            '</div>'  
		);
	});
	
//TRANSFAST	
	$('#payoutTransfast').on('click','.btnpayoutTransfast',function(){
		$('.btnpayoutTransfast').attr("disabled", true);
	
		var btn           = $(".btnpayoutTransfast").val();        
		var refno         = $('.tab-content').find("div.active").find('input[name="transfastRef"]').val();
        // var vID           = $('.tab-content').find("div.active").find(".transfastID option:selected").attr('transfast_ID');
		var pass          = $('.tab-content').find("div.active").find('input[name="transfastPass"]').val();
        
        
        if(refno == null || refno == "")
        {
            $('.mensahe').html('Reference no must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        // else if(vID == null || vID == "")
        // {
        //     $('.mensahe').html('ID is required');
        //     $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        // }
        else if(pass == null || pass == "")
        {
            $('.mensahe').html('Transaction password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{

    		$('.mensahe').html('Processing..');
            $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();      
            $('.btnpayoutTransfast').attr('disabled',true);
			$.ajax({
				url:"ecash_sendData",
				type:"post",
				data:{btn:btn,refno:refno,pass:pass},
				dataType:"json",
				success: function(data) {
					$('.btnpayoutTransfast').removeAttr('disabled');
					if(data["S"] == 1) {
						$('#payoutTransfast').empty();
						 $('.mensahe').html('Kindly review the correctness of data shown below: ');
						$('#payoutTransfast').append(
							'<div class="form-group">'+
								'<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Tracking number :</label>'+
								'<div class="col-md-12 col-lg-7">'+
									'<input readonly="readonly" name="transfastTrackNo" type="text" placeholder="Tracking number" value="'+data["TN"]+'" class="form-control transfastRef" id="transfastRef" required="">'+
									'<input name="sessionId" type="hidden" placeholder="Tracking number" value="'+data["sessionId"]+'" class="form-control transfastRef" id="transfastRef" required="">'+
								'</div>'+
							'</div>'+
							'<div class="form-group">'+
								'<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Reference No :</label>'+
								'<div class="col-md-12 col-lg-7">'+
									'<input readonly="readonly" name="transfastRefNo" type="text" placeholder="Reference Number" value="'+data["RN"]+'" class="form-control transfastRef" id="transfastRef" required="">'+
								'</div>'+
							'</div>'+
							'<div class="form-group">'+
								'<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Beneficiary Name :</label>'+
								'<div class="col-md-12 col-lg-7">'+
									'<input readonly="readonly" name="transfastBenName" type="text" placeholder="Beneficiary Name"  value="'+data["Benefirstname"]+' '+data["Benemiddlename"]+' '+data["Benelastname"]+'" class="form-control transfastRef" id="transfastRef" required="">'+
								'</div>'+
							'</div>'+
							'<div class="form-group">'+
								'<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Beneficiary Address :</label>'+
								'<div class="col-md-12 col-lg-7">'+
									'<input readonly="readonly" name="transfastBenAdd" type="text" placeholder="Beneficiary Address" value="'+data["Beneaddress"]+'" class="form-control transfastRef" id="transfastRef" required="">'+
								'</div>'+
							'</div>'+
							'<div class="form-group">'+
								'<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Beneficiary Tel No :</label>'+
								'<div class="col-md-12 col-lg-7">'+
									'<input readonly="readonly" name="transfastTelNo" type="text" placeholder="Beneficiary telephone number"  value="'+data["Benetelno"]+'" class="form-control transfastRef" id="transfastRef" required="">'+
								'</div>'+
							'</div>'+
							'<div class="form-group">'+
								'<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Amount :</label>'+
								'<div class="col-md-12 col-lg-7">'+
									'<input readonly="readonly" name="transfastAmount" type="text" placeholder="Amount" value="'+data["Amount"]+'" class="form-control transfastRef" id="transfastRef" required="">'+
									'<input readonly="readonly" name="Currency" type="text" placeholder="Amount" value="'+data["Currency"]+'" class="form-control transfastRef" id="transfastRef" required="">'+
								'</div>'+									
							'</div>'+
                            '<div class="form-group">'+
                                '<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Valid ID :</label>'+
                                '<div class="col-md-12 col-lg-7">'+
                                    '<input name="transfastClientID" type="text" placeholder="Valid ID" value="" class="form-control transfastClientID" id="transfastClientID" required="">'+
                                '</div>'+                                   
                            '</div>'+
                            '<div class="form-group">'+
                                '<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">ID Number :</label>'+
                                '<div class="col-md-12 col-lg-7">'+
                                    '<input name="transfastClientIDNo" type="text" placeholder="ID Number" value="" class="form-control transfastClientIDNo" id="transfastClientIDNo" required="">'+
                                '</div>'+                                   
                            '</div>'+
							'<div class="form-group">'+
								'<div class="col-md-12 col-lg-12">'+
								  '<button value="btnpayoutConfirmTransfast" id="btnpayoutConfirmTransfast" class="btn btn-primary btnpayoutConfirmTransfast pull-right">Confirm</button>'+
								  '<button value="btnpayoutCancelTransfast" id="btnpayoutCancelTransfast" class="btn btn-danger btnpayoutCancelTransfast  pull-right">Cancel</button>'+
								'</div>'+
							'</div>'+
							'<div class="form-group">'+
								'<div class="col-md-12 col-lg-12 text-center">'+
									'<em><strong class="text-warning">Note: This process is IRREVERSIBLE. Double-Check the data before you proceed.</strong></em>'+
								'</div>'+									
							'</div>'
						);
					}
					else {

                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
				
					}
                    $('.btnpayoutTransfast').removeAttr('disabled');

				}

			});
			
		
        }
	});

	$('#payoutTransfast').on('click','.btnpayoutConfirmTransfast',function(){
		$('.btnpayoutConfirmTransfast').attr("disabled", true);	
		var btn           = $(".btnpayoutConfirmTransfast").val();        
		var refno         = $('.tab-content').find("div.active").find('input[name="transfastRefNo"]').val();
		var sessionId     = $('.tab-content').find("div.active").find('input[name="sessionId"]').val();
        var TN            = $('.tab-content').find("div.active").find('input[name="transfastTrackNo"]').val();
        var Name          = $('.tab-content').find("div.active").find('input[name="transfastBenName"]').val();
		var Beneaddress   = $('.tab-content').find("div.active").find('input[name="transfastBenAdd"]').val();
		var Benetelno     = $('.tab-content').find("div.active").find('input[name="transfastTelNo"]').val();
		var Amount        = $('.tab-content').find("div.active").find('input[name="transfastAmount"]').val();
		var idtype        = $('.tab-content').find("div.active").find('input[name="transfastClientID"]').val();
		var idnumber      = $('.tab-content').find("div.active").find('input[name="transfastClientIDNo"]').val();
		var Currency      = $('.tab-content').find("div.active").find('input[name="Currency"]').val();
        
		if(idtype == null || idtype == "")
        {
            $('.mensahe').html('VALID ID is required');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(idnumber == null || idnumber == "")
        {
            $('.mensahe').html('ID Number is required');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{

		$('.mensahe').html('Processing..');
        $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();
		$('.btnpayoutConfirmTransfast').attr('disabled',true);
        $.ajax({
			url:"ecash_sendData",
			type:"post",
			data:{btn:btn,refno:refno,sessionId:sessionId, idtype:idtype, idnumber:idnumber,TN:TN,Name:Name,Beneaddress:Beneaddress,Benetelno:Benetelno,Amount:Amount,Currency:Currency},
			dataType:"json",
			success: function(data) {
				$('.btnpayoutConfirmTransfast').removeAttr('disabled');
				if(data["S"] == 1) {
					$('#payoutTransfast').empty();
			        $('.mensahe').html(data['M']);
                    $('.flasher').addClass('alert-success').removeClass('alert-danger alert-info').fadeIn().delay(8000);
                    $('.tab-content').find("div.active").find('input[name="transfastRefNo"]').val('');
                    $('.tab-content').find("div.active").find('input[name="transfastPass"]').val('');
            		$('#payoutTransfast').append(
            			'<div class="form-group">'+
                             '<label class="col-md-12 col-lg-5 control-label animated bounceInUp delay025s" for="">Reference Number : </label>'+
                             '<div class="col-md-12 col-lg-7">'+
                                 '<input type="text" readonly="readonly" id="transfastRefNo" class="form-control transfastRefNo animated bounceInDown delay025s" value="'+refno+'" placeholder="Reference No" name="transfastRefNo">'+
                             '</div>'+
                         '</div>'+
                         '<div class="form-group">'+
 							'<div class="col-md-12 col-lg-12">'+
 							  '<form action="../file_generator/transfast_pdf" target="_blank" id="smart_form" method="POST">'+
                                        '<input type="hidden" readonly="readonly" id="transfastRefNo" class="form-control transfastRefNo animated bounceInDown delay025s" value="'+refno+'" placeholder="Reference No" name="transfastRefNo">'+
                                        '<button value="btnpayoutPrintTransfast" id="btnpayoutPrintTransfast" class="btn btn-primary btnpayoutPrintTransfast pull-right">Print Receipt</button>'+
 							  '</form>'+
                              '<button value="btnpayoutNewTransfast" id="btnpayoutNewTransfast" class="btn btn-info btnpayoutNewTransfast pull-right">New Transaction</button>'+
 							'</div>'+
 						'</div>' 
            		);
				}
				else {

                    $('.mensahe').html(data["M"]);
                    $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
			
				}
                $('.btnpayoutConfirmTransfast').removeAttr('disabled');
			}
		});
        }
	});
	
	$('#payoutTransfast').on('click','.btnpayoutCancelTransfast',function(){
		$('.flasher').hide();
		$('#payoutTransfast').empty();
		$('#payoutTransfast').append(
            '<div class="form-group">'+
               '<label class="col-md-12 col-lg-5 control-label animated flipInX delay025s" for="">Input Reference No : <span class="text-warning">*</span></label>'+
               '<div class="col-md-12 col-lg-7">'+
                    '<input type="text" required="" id="transfastRef" class="form-control transfastRef animated flip delay025s" placeholder="Reference No" name="transfastRef">'+
                '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<label class="col-md-12 col-lg-5 control-label animated bounceIn delay050s" for="">Password : <span class="text-warning">*</span></label>'+
                '<div class="col-md-12 col-lg-7">'+
                    '<input type="password" id="transfastPass" class="form-control transfastPass animated bounceInRight delay075s" placeholder="Transaction password" title="" data-placement="top" data-toggle="tooltip" name="transfastPass" data-original-title="Transaction password">'+
                '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<div class="col-md-12 col-lg-12">'+
                    '<button name="btnpayoutTransfast" value="btnpayoutTransfast" id="btnpayoutTransfast" class="btn btn-primary btnpayoutTransfast  animated bounceIn delay025s pull-right">Submit</button>'+
                '</div>'+
            '</div>'   
		);
	});
	
	$('#payoutTransfast').on('click','.btnpayoutNewTransfast',function(){
		$('.flasher').hide();
		$('#payoutTransfast').empty();
		$('#payoutTransfast').append(
            '<div class="form-group">'+
               '<label class="col-md-12 col-lg-5 control-label animated flipInX delay025s" for="">Input Reference No : <span class="text-warning">*</span></label>'+
               '<div class="col-md-12 col-lg-7">'+
                    '<input type="text" required="" id="transfastRef" class="form-control transfastRef animated flip delay025s" placeholder="Reference No" name="transfastRef">'+
                '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<label class="col-md-12 col-lg-5 control-label animated bounceIn delay050s" for="">Password : <span class="text-warning">*</span></label>'+
                '<div class="col-md-12 col-lg-7">'+
                    '<input type="password" id="transfastPass" class="form-control transfastPass animated bounceInRight delay075s" placeholder="Transaction password" title="" data-placement="top" data-toggle="tooltip" name="transfastPass" data-original-title="Transaction password">'+
                '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<div class="col-md-12 col-lg-12">'+
                    '<button name="btnpayoutTransfast" value="btnpayoutTransfast" id="btnpayoutTransfast" class="btn btn-primary btnpayoutTransfast  animated bounceIn delay025s pull-right">Submit</button>'+
                '</div>'+
            '</div>'   
		);
	});
//END TRANSFAST
	
//NEW YORK BAY
	$('#payoutNewyorkbay').on('click','.btnpayoutNewyork',function(){
		$('.btnpayoutNewyork').attr("disabled", true);
	
		var btn           = $(".btnpayoutNewyork").val();        
		var refno         = $('.tab-content').find("div.active").find('input[name="newyorkRef"]').val();
        // var vID           = $('.tab-content').find("div.active").find(".newyorkID option:selected").attr('newyork_ID');
		var pass          = $('.tab-content').find("div.active").find('input[name="newyorkPass"]').val();
        
        
        if(refno == null || refno == "")
        {
            $('.mensahe').html('Reference no must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
        }
        // else if(vID == null || vID == "")
        // {
        //     $('.mensahe').html('ID is required');
        //     $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
        // }
        else if(pass == null || pass == "")
        {
            $('.mensahe').html('Transaction password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
        }
        else{
            
        	
    		$('.mensahe').html('Processing..');
            $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();      
            
            $('.btnpayoutNewyork').attr('disabled',true);

			$.ajax({
				url:"ecash_sendData",
				type:"post",
				data:{btn:btn,refno:refno,pass:pass},
				dataType:"json",
				success: function(data) {
					
					$('.btnpayoutNewyork').removeAttr('disabled');
					if(data["S"] == 1) {
						$('#payoutNewyorkbay').empty();
				        $('.mensahe').html('Kindly review the correctness of data shown below: ');
                        $('.flasher').addClass('alert-info').removeClass('alert-danger alert-success').fadeIn().delay(8000);
                        $('.tab-content').find("div.active").find('input[name="transfastRef"]').val('');
                        $('.tab-content').find("div.active").find('input[name="transfastPass"]').val('');
						$('#payoutNewyorkbay').append(
							'<div class="form-group">'+
								'<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Tracking number :</label>'+
								'<div class="col-md-12 col-lg-7">'+
									'<input readonly="readonly" name="newyorkTrackNo" type="text" placeholder="Tracking number" value="'+data["TN"]+'" class="form-control transfastRef" id="newyorkRef" required="">'+
									'<input name="sessionId" type="hidden" placeholder="Tracking number" value="'+data["sessionId"]+'" class="form-control newyorkRef" id="newyorkRef" required="">'+
								'</div>'+
							'</div>'+
							'<div class="form-group">'+
								'<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Reference No :</label>'+
								'<div class="col-md-12 col-lg-7">'+
									'<input readonly="readonly" name="newyorkRefNo" type="text" placeholder="Reference Number" value="'+data["RN"]+'" class="form-control newyorkRef" id="newyorkRef" required="">'+
								'</div>'+
							'</div>'+
							'<div class="form-group">'+
								'<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Beneficiary Name :</label>'+
								'<div class="col-md-12 col-lg-7">'+
									'<input readonly="readonly" name="newyorkBenName" type="text" placeholder="Beneficiary Name"  value="'+data["Benefirstname"]+' '+data["Benemiddlename"]+' '+data["Benelastname"]+'" class="form-control newyorkRef" id="newyorkRef" required="">'+
								'</div>'+
							'</div>'+
							'<div class="form-group">'+
								'<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Beneficiary Address :</label>'+
								'<div class="col-md-12 col-lg-7">'+
									'<input readonly="readonly" name="newyorkBenAdd" type="text" placeholder="Beneficiary Address" value="'+data["Beneaddress"]+'" class="form-control transfastRef" id="transfastRef" required="">'+
								'</div>'+
							'</div>'+
							'<div class="form-group">'+
								'<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Beneficiary Tel No :</label>'+
								'<div class="col-md-12 col-lg-7">'+
									'<input readonly="readonly" name="newyorkTelNo" type="text" placeholder="Beneficiary telephone number"  value="'+data["Benetelno"]+'" class="form-control transfastRef" id="transfastRef" required="">'+
								'</div>'+
							'</div>'+
							'<div class="form-group">'+
								'<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Amount :</label>'+
								'<div class="col-md-12 col-lg-7">'+
									'<input readonly="readonly" name="newyorkAmount" type="text" placeholder="Amount" value="'+data["Amount"]+'" class="form-control transfastRef" id="transfastRef" required="">'+
									'<input readonly="readonly" name="Currency" type="text" placeholder="Amount" value="'+data["Currency"]+'" class="form-control transfastRef" id="transfastRef" required="">'+									
								'</div>'+									
							'</div>'+
                            '<div class="form-group">'+
                                '<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Valid ID :</label>'+
                                '<div class="col-md-12 col-lg-7">'+
                                    '<input name="newyorkValidID" type="text" placeholder="Valid ID" value="" class="form-control newyorkValidID" id="newyorkValidID" required="">'+
                                '</div>'+                                   
                            '</div>'+
                            '<div class="form-group">'+
                                '<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">ID Number :</label>'+
                                '<div class="col-md-12 col-lg-7">'+
                                    '<input name="newyorkIDno" type="text" placeholder="ID Number" value="" class="form-control newyorkIDno" id="newyorkIDno" required="">'+
                                '</div>'+                                   
                            '</div>'+
							'<div class="form-group">'+
								'<div class="col-md-12 col-lg-12">'+
								  '<button value="btnpayoutConfirmNewyorkbay" id="btnpayoutConfirmNewyorkbay" class="btn btn-primary btnpayoutConfirmNewyorkbay pull-right">Confirm</button>'+
								  '<button value="btnpayoutCancelNewyorkbay" id="btnpayoutCancelNewyorkbay" class="btn btn-danger btnpayoutCancelNewyorkbay  pull-right">Cancel</button>'+
								'</div>'+
							'</div>'+
							'<div class="form-group">'+
								'<div class="col-md-12 col-lg-12 text-center">'+
									'<em><strong class="text-warning">Note: This process is IRREVERSIBLE. Double-Check the data before you proceed.</strong></em>'+
								'</div>'+									
							'</div>'
						);
					}
					else {

                        $('.mensahe').html(data["M"]);
                        $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
				
					}
                    $('.btnpayoutNewyork').removeAttr('disabled');

				}

			});
			
		
        }
	});
	
	$('#payoutNewyorkbay').on('click','.btnpayoutConfirmNewyorkbay',function(){
		$('.btnpayoutConfirmNewyorkbay').attr("disabled", true);	
		var btn           = $(".btnpayoutConfirmNewyorkbay").val();        
		var refno         = $('.tab-content').find("div.active").find('input[name="newyorkRefNo"]').val();
		var sessionId     = $('.tab-content').find("div.active").find('input[name="sessionId"]').val();
        var TN            = $('.tab-content').find("div.active").find('input[name="newyorkTrackNo"]').val();
        var Name          = $('.tab-content').find("div.active").find('input[name="newyorkBenName"]').val();
		var Beneaddress   = $('.tab-content').find("div.active").find('input[name="newyorkBenAdd"]').val();
		var Benetelno     = $('.tab-content').find("div.active").find('input[name="newyorkTelNo"]').val();
		var Amount        = $('.tab-content').find("div.active").find('input[name="newyorkAmount"]').val();
		var idtype        = $('.tab-content').find("div.active").find('input[name="newyorkValidID"]').val();
		var idnumber      = $('.tab-content').find("div.active").find('input[name="newyorkIDno"]').val();
		var Currency      = $('.tab-content').find("div.active").find('input[name="Currency"]').val();
        
		if(idtype == null || idtype == "")
        {
            $('.mensahe').html('VALID ID is required');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(idnumber == null || idnumber == "")
        {
            $('.mensahe').html('ID Number is required');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{

		$('.mensahe').html('Processing..');
        $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();
		$('.btnpayoutConfirmNewyorkbay').attr('disabled',true);
        $.ajax({
			url:"ecash_sendData",
			type:"post",
			data:{btn:btn,refno:refno,sessionId:sessionId, idtype:idtype, idnumber:idnumber,TN:TN,Name:Name,Beneaddress:Beneaddress,Benetelno:Benetelno,Amount:Amount,Currency:Currency},
			dataType:"json",
			success: function(data) {
				$('.btnpayoutConfirmNewyorkbay').removeAttr('disabled');
				if(data["S"] == 1) {
					$('#payoutNewyorkbay').empty();
			        $('.mensahe').html(data['M']);
                    $('.flasher').addClass('alert-success').removeClass('alert-danger alert-info').fadeIn().delay(8000);
                    $('.tab-content').find("div.active").find('input[name="transfastRefNo"]').val('');
                    $('.tab-content').find("div.active").find('input[name="transfastPass"]').val('');
            		$('#payoutTransfast').append(
            			'<div class="form-group">'+
                             '<label class="col-md-12 col-lg-5 control-label animated bounceInUp delay025s" for="">Reference Number : </label>'+
                             '<div class="col-md-12 col-lg-7">'+
                                 '<input type="text" readonly="readonly" id="transfastRefNo" class="form-control transfastRefNo animated bounceInDown delay025s" value="'+refno+'" placeholder="Reference No" name="transfastRefNo">'+
                             '</div>'+
                         '</div>'+
                         '<div class="form-group">'+
 							'<div class="col-md-12 col-lg-12">'+
 							  '<form action="../file_generator/newyorkbay_pdf" target="_blank" id="smart_form" method="POST">'+
                                        '<input type="hidden" readonly="readonly" id="newyorkRef" class="form-control newyorkRef animated bounceInDown delay025s" value="'+refno+'" placeholder="Reference No" name="transfastRefNo">'+
                                        '<button value="btnpayoutPrintNewyorkbay" id="btnpayoutPrintNewyorkbay" class="btn btn-primary btnpayoutPrintNewyorkbay pull-right">Print Receipt</button>'+
 							  '</form>'+
                              '<button value="btnpayoutNewNewyorkbay" id="btnpayoutNewTransfast" class="btn btn-info btnpayoutNewTransfast pull-right">New Transaction</button>'+
 							'</div>'+
 						'</div>' 
            		);
				}
				else {

                    $('.mensahe').html(data["M"]);
                    $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
			
				}
                $('.btnpayoutConfirmNewyorkbay').removeAttr('disabled');
			}
		});
        }
	});
	
	$('#payoutNewyorkbay').on('click','.btnpayoutCancelNewyorkbay',function(){
		$('.flasher').hide();
		$('#payoutNewyorkbay').empty();
		$('#payoutNewyorkbay').append(                
            '<div class="form-group">'+
                '<label class="col-md-12 col-lg-5 control-label animated flipInX delay025s" for="">Reference No : <span class="text-warning">*</span></label>'+
                '<div class="col-md-12 col-lg-7">'+
                    '<input type="text" required="" id="newyorkRef" class="form-control newyorkRef animated bounceInLeft delay025s" placeholder="Reference No" name="newyorkRef">'+
                '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<label class="col-md-12 col-lg-5 control-label animated bounceIn delay050s" for="">Password : <span class="text-warning">*</span></label>'+
                '<div class="col-md-12 col-lg-7">'+
                    '<input type="password" id="newyorkPass" class="form-control newyorkPass animated bounceInDown delay075s" placeholder="Transaction password" title="" data-placement="top" data-toggle="tooltip" name="newyorkPass" data-original-title="Transaction password">'+
                '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<div class="col-md-12 col-lg-12">'+
                    '<button name="btnpayoutNewyork" value="btnpayoutNewyork" id="btnpayoutNewyork" class="btn btn-primary btnpayoutNewyork  animated bounceIn delay025s pull-right">Submit</button>'+
                '</div>'+
            '</div>'
		);
	});
	
	$('#payoutNewyorkbay').on('click','.btnpayoutNewNewyorkbay',function(){
		$('.flasher').hide();
		$('#payoutNewyorkbay').empty();
		$('#payoutNewyorkbay').append(                
            '<div class="form-group">'+
                '<label class="col-md-12 col-lg-5 control-label animated flipInX delay025s" for="">Reference No : <span class="text-warning">*</span></label>'+
                '<div class="col-md-12 col-lg-7">'+
                    '<input type="text" required="" id="newyorkRef" class="form-control newyorkRef animated bounceInLeft delay025s" placeholder="Reference No" name="newyorkRef">'+
                '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<label class="col-md-12 col-lg-5 control-label animated bounceIn delay050s" for="">Password : <span class="text-warning">*</span></label>'+
                '<div class="col-md-12 col-lg-7">'+
                    '<input type="password" id="newyorkPass" class="form-control newyorkPass animated bounceInDown delay075s" placeholder="Transaction password" title="" data-placement="top" data-toggle="tooltip" name="newyorkPass" data-original-title="Transaction password">'+
                '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<div class="col-md-12 col-lg-12">'+
                    '<button name="btnpayoutNewyork" value="btnpayoutNewyork" id="btnpayoutNewyork" class="btn btn-primary btnpayoutNewyork  animated bounceIn delay025s pull-right">Submit</button>'+
                '</div>'+
            '</div>'
		);
	});
//END NEW YORK BAY
	
//ABS-CBN 
	$('#payoutAbscbn').on('click','.btnpayoutAbscbn',function(){
		
		$('.btnpayoutAbscbn').attr("disabled", true);
		var btn           = $(".btnpayoutAbscbn").val();        
		var refno         = $('.tab-content').find("div.active").find('input[name="abscbnRef"]').val();
        // var vID           = $('.tab-content').find("div.active").find(".abscbnID option:selected").attr('abscbn_ID');
		var pass          = $('.tab-content').find("div.active").find('input[name="abscbnPass"]').val();
        
        
        if(refno == null || refno == "")
        {
            $('.mensahe').html('Reference no must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        // else if(vID == null || vID == "")
        // {
        //     $('.mensahe').html('ID is required');
        //     $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        // }
        else if(pass == null || pass == "")
        {
            $('.mensahe').html('Transaction password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
            
           
    		$('.mensahe').html('Processing..');
            $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();      
            $('.btnpayoutAbscbn').attr('disabled',true);
    			$.ajax({
    				url:"ecash_sendData",
    				type:"post",
    				data:{btn:btn,refno:refno,pass:pass},
    				dataType:"json",
    				success: function(data) {
    					//console.log(data);
    					if(data["S"] == 1) {
    						$('#payoutAbscbn').empty();
    						 $('.mensahe').html('Kindly review the correctness of data shown below: ');
                            $('.flasher').addClass('alert-info animated fadeInLeft').removeClass('alert-danger alert-success').fadeIn();
                            $('.tab-content').find("div.active").find('input[name="abscbnRef"]').val('');
                            // $('.tab-content').find("div.active").find('select[name="abscbnID"]').val('');
                            $('.tab-content').find("div.active").find('input[name="abscbnPass"]').val('');
                            $('#payoutAbscbn').append(
        							'<div class="form-group">'+
        								'<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Tracking number :</label>'+
        								'<div class="col-md-12 col-lg-7">'+
        									'<input readonly="readonly" name="abscbnTrackNo" type="text" placeholder="Tracking number" value="'+data["TN"]+'" class="form-control transfastRef" id="newyorkRef" required="">'+
        									'<input name="sessionId" type="hidden" placeholder="Tracking number" value="'+data["sessionId"]+'" class="form-control newyorkRef" id="newyorkRef" required="">'+
        								'</div>'+
        							'</div>'+
        							'<div class="form-group">'+
        								'<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Reference No :</label>'+
        								'<div class="col-md-12 col-lg-7">'+
        									'<input readonly="readonly" name="abscbnRefNo" type="text" placeholder="Reference Number" value="'+data["RN"]+'" class="form-control newyorkRef" id="newyorkRef" required="">'+
        								'</div>'+
        							'</div>'+
        							'<div class="form-group">'+
        								'<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Beneficiary Name :</label>'+
        								'<div class="col-md-12 col-lg-7">'+
        									'<input readonly="readonly" name="abscbnBenName" type="text" placeholder="Beneficiary Name"  value="'+data["Benefirstname"]+' '+data["Benemiddlename"]+' '+data["Benelastname"]+'" class="form-control newyorkRef" id="newyorkRef" required="">'+
        								'</div>'+
        							'</div>'+
        							'<div class="form-group">'+
        								'<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Beneficiary Address :</label>'+
        								'<div class="col-md-12 col-lg-7">'+
        									'<input readonly="readonly" name="abscbnBenAdd" type="text" placeholder="Beneficiary Address" value="'+data["Beneaddress"]+'" class="form-control transfastRef" id="transfastRef" required="">'+
        								'</div>'+
        							'</div>'+
        							'<div class="form-group">'+
        								'<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Beneficiary Tel No :</label>'+
        								'<div class="col-md-12 col-lg-7">'+
        									'<input readonly="readonly" name="abscbnTelNo" type="text" placeholder="Beneficiary telephone number"  value="'+data["Benetelno"]+'" class="form-control transfastRef" id="transfastRef" required="">'+
        								'</div>'+
        							'</div>'+
        							'<div class="form-group">'+
        								'<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Amount :</label>'+
        								'<div class="col-md-12 col-lg-7">'+
        									'<input readonly="readonly" name="abscbnAmount" type="text" placeholder="Amount" value="'+data["Amount"]+'" class="form-control transfastRef" id="transfastRef" required="">'+
        								'</div>'+									
        							'</div>'+
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">Valid ID :</label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input name="abscbnValidID" type="text" placeholder="Valid ID" value="" class="form-control abscbnValidID" id="abscbnValidID" required="">'+
                                        '</div>'+                                   
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="" class="col-md-12 col-lg-5 control-label animated flipInX delay025s">ID Number :</label>'+
                                        '<div class="col-md-12 col-lg-7">'+
                                            '<input name="abscbnIDno" type="text" placeholder="ID Number" value="" class="form-control abscbnIDno" id="abscbnIDno" required="">'+
                                        '</div>'+                                   
                                    '</div>'+
        							'<div class="form-group">'+
        								'<div class="col-md-12 col-lg-12">'+
        								  '<button value="btnpayoutConfirmAbscbn" id="btnpayoutConfirmAbscbn" class="btn btn-primary btnpayoutConfirmAbscbn pull-right">Confirm</button>'+
        								  '<button value="btnpayoutCancelAbscbn" id="btnpayoutCancelAbscbn" class="btn btn-danger btnpayoutCancelAbscbn  pull-right">Cancel</button>'+
        								'</div>'+
        							'</div>'+
        							'<div class="form-group">'+
        								'<div class="col-md-12 col-lg-12 text-center">'+
        									'<em><strong class="text-warning">Note: This process is IRREVERSIBLE. Double-Check the data before you proceed.</strong></em>'+
        								'</div>'+									
        							'</div>'
        						);
    					}
    					else {
    
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
    				
    					}
                        $('.btnpayoutAbscbn').removeAttr('disabled');
    
    				}
    
    			});
    		
        }
	});
	
	$('#payoutAbscbn').on('click', '.btnpayoutConfirmAbscbn', function(){
		// $('.btnpayoutConfirmAbscbn').attr("disabled", true);	
		
		var btn           = $(".btnpayoutConfirmAbscbn").val();        
		var refno         = $('.tab-content').find("div.active").find('input[name="abscbnRefNo"]').val();
		var sessionId     = $('.tab-content').find("div.active").find('input[name="sessionId"]').val();
		var id            = $('.tab-content').find("div.active").find('input[name="abscbnValidID"]').val();
        var idno          = $('.tab-content').find("div.active").find('input[name="abscbnIDno"]').val();
        
        if(id == null || id == "")
        {
            $('.mensahe').html('VALID ID is required');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(idno == null || idno == "")
        {
            $('.mensahe').html('ID Number is required');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{ 

            $('.mensahe').html('Processing..');
            $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();      
            $('.btnpayoutConfirmAbscbn').attr('disabled',true);
		$.ajax({
			url:"ecash_sendData",
			type:"post",
			data:{btn:btn,refno:refno,sessionId:sessionId,id:id,idno:idno},
			dataType:"json",
			success: function(data) {
				// $('.btnpayoutConfirmNewyorkbay').removeAttr('disabled');
				if(data["S"] == 1) {
					$('#payoutAbscbn').empty();
			        $('.mensahe').html(data['M']);
                    $('.flasher').addClass('alert-success').removeClass('alert-danger alert-info').fadeIn().delay(12000);
                    $('.tab-content').find("div.active").find('input[name="transfastPass"]').val('');
                    $('#payoutAbscbn').append(                
                    	'<div class="form-group">'+
                            '<label class="col-md-12 col-lg-5 control-label animated bounceInUp delay025s" for="">Reference Number : </label>'+
                            '<div class="col-md-12 col-lg-7">'+
                                '<input type="text" readonly="readonly" id="abscbnRef" class="form-control abscbnRef animated bounceInDown delay025s" value="'+refno+'" placeholder="Reference No" name="abscbnRef">'+
                            '</div>'+
                        '</div>'+
                        '<div class="form-group">'+
							'<div class="col-md-12 col-lg-12">'+
							  '<form action="../file_generator/abscbn_remit_pdf" target="_blank" id="smart_form" method="POST">'+
                                        '<input type="hidden" readonly="readonly" id="abscbnRef" class="form-control abscbnRef animated bounceInDown delay025s" value="'+refno+'" placeholder="Reference No" name="abscbnRef">'+
                                        '<button value="btnpayoutPrintAbscbn" id="btnpayoutPrintAbscbn" class="btn btn-primary btnpayoutPrintAbscbn pull-right">Print Receipt</button>'+
							  '</form>'+  
                              '<button value="btnpayoutNewAbscbn" id="btnpayoutNewAbscbn" class="btn btn-info btnpayoutNewAbscbn pull-right">New Transaction</button>'+
							'</div>'+
						'</div>' 
            		);
				}
				else {

                    $('.mensahe').html(data["M"]);
                    $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
			
				}
                $('.btnpayoutConfirmAbscbn').removeAttr('disabled');
			}
		});
        }
	});
	
	$('#payoutAbscbn').on('click','.btnpayoutCancelAbscbn',function(){
		$('.flasher').hide();
		$('#payoutAbscbn').empty();
		$('#payoutAbscbn').append(
            '<div class="form-group">'+
                '<label class="col-md-12 col-lg-5 control-label animated flipInX delay025s" for="">Input Tracking No : <span class="text-warning">*</span></label>'+
                '<div class="col-md-12 col-lg-7">'+
                    '<input type="text" required="" id="abscbnRef" class="form-control abscbnRef animated pulse delay025s" placeholder="Reference No" name="abscbnRef">'+
                '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<label class="col-md-12 col-lg-5 control-label animated bounceIn delay050s" for="">Password : <span class="text-warning">*</span></label>'+
                '<div class="col-md-12 col-lg-7">'+
                    '<input type="password" id="abscbnPass" class="form-control abscbnPass animated bounceInDown delay075s" placeholder="Transaction password" title="" data-placement="top" data-toggle="tooltip" name="abscbnPass" data-original-title="Transaction password">'+
                '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<div class="col-md-12 col-lg-12">'+
                    '<button name="btnpayoutAbscbn" value="btnpayoutAbscbn" id="btnpayoutAbscbn" class="btn btn-primary btnpayoutAbscbn  animated bounceIn delay025s pull-right">Submit</button>'+
                '</div>'+
            '</div>'
		);
	});
	
	$('#payoutAbscbn').on('click','.btnpayoutNewAbscbn',function(){
		$('.flasher').hide();
		$('#payoutAbscbn').empty();
		$('#payoutAbscbn').append(
            '<div class="form-group">'+
                '<label class="col-md-12 col-lg-5 control-label animated flipInX delay025s" for="">Input Tracking No : <span class="text-warning">*</span></label>'+
                '<div class="col-md-12 col-lg-7">'+
                    '<input type="text" required="" id="abscbnRef" class="form-control abscbnRef animated pulse delay025s" placeholder="Reference No" name="abscbnRef">'+
                '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<label class="col-md-12 col-lg-5 control-label animated bounceIn delay050s" for="">Password : <span class="text-warning">*</span></label>'+
                '<div class="col-md-12 col-lg-7">'+
                    '<input type="password" id="abscbnPass" class="form-control abscbnPass animated bounceInDown delay075s" placeholder="Transaction password" title="" data-placement="top" data-toggle="tooltip" name="abscbnPass" data-original-title="Transaction password">'+
                '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<div class="col-md-12 col-lg-12">'+
                    '<button name="btnpayoutAbscbn" value="btnpayoutAbscbn" id="btnpayoutAbscbn" class="btn btn-primary btnpayoutAbscbn  animated bounceIn delay025s pull-right">Submit</button>'+
                '</div>'+
            '</div>'
		);
	});
//END ABSCBN
	
//MONEYGRAM
	$('.btnpayoutMoneygram').click(function(){

		var btn           = $(".btnpayoutMoneygram").val();        
		var refno         = $('.tab-content').find("div.active").find('input[name="moneygramRef"]').val();
        var vID           = $('.tab-content').find("div.active").find(".moneygramID option:selected").attr('moneygram_ID');
		var pass          = $('.tab-content').find("div.active").find('input[name="moneygramPass"]').val();
        
        if(refno == null || refno == "")
        {
            $('.mensahe').html('Reference no must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(vID == null || vID == "")
        {
            $('.mensahe').html('ID is required');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(pass == null || pass == "")
        {
            $('.mensahe').html('Transaction password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
            
           
    		$('.mensahe').html('Processing..');
            $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();      
            $('.btnpayoutMoneygram').attr('disabled',true);
    			$.ajax({
    				url:"ecash_sendData",
    				type:"post",
    				data:{btn:btn,refno:refno,vID:vID,pass:pass},
    				dataType:"json",
    				success: function(data) {
    
    					if(data["S"] == 1) {
    					   
    				        $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                            $('.tab-content').find("div.active").find('input[name="moneygramRef"]').val('');
                            $('.tab-content').find("div.active").find('input[name="moneygramPass"]').val('');
    
    					}
    					else {
    
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
    				
    					}
                        $('.btnpayoutMoneygram').removeAttr('disabled');
    
    				}
    
    			});
    		
        }
	});
	// End Payout

	// End e-Cash 
	
	// Start Bills Payment

	// Start Clear temporary values in selecting biller
	$('.tab_billspay').click(function(){
		//alert('clear utilies');
		 /*$('.select_biller option').prop('selected', function() {
        	return this.defaultSelected;
   		 }); */

   		$('.type_1').hide();
		$('.type_2').hide();
		$('.type_3').hide();
		$('.type_4').hide();
		$('.type_5').hide();
		$('.type_6').hide();
		$('.type_7').hide();
		$('.type_8').hide();
		$('.type_9').hide();
		$('.type_10').hide();
		$('.type_11').hide();
		$('.type_12').hide();
		$('.type_13').hide();
		$('.type_14').hide();
		$('.type_15').hide();
		$('.type_16').hide();
		$('.type_17').hide();
		$('.type_18').hide();
		$('.type_19').hide();
        $('.type_20').hide();

	});
	// End Clear temporary values

	// Start Trigger to get Selected Biller ID
	$('.utilities').click(function(){
		$('.appender').val('1');
	});
	$('.telecom').click(function(){
		$('.appender').val('2');
	});
	$('.airlines').click(function(){
		$('.appender').val('3');
	});
	$('.creditcard').click(function(){
		$('.appender').val('4');
	});
	$('.government').click(function(){
		$('.appender').val('5');
	});
	$('.insurance').click(function(){
		$('.appender').val('6');
	});
	$('.schools').click(function(){
		$('.appender').val('7');
	});
	$('.others').click(function(){
		$('.appender').val('8');
	});
	// End Trigger to get Selected Biller ID
	


	// Start Data submission
	$('.btnType1').click(function(){
		
        var btnType     = $(".btnType1").val();
        var appender    = $('.appender').val();
        var distinctID  = '#select_biller'+appender;
        var biller      = $(distinctID).val();
        var acc         = $('.tab-content').find("div.active").find('input[name="acc_no1"]').val();
        var subscriber  = $('.tab-content').find("div.active").find('input[name="subscriber_name1"]').val();
        var amount      = $('.tab-content').find("div.active").find('input[name="amount1"]').val();
        var pass        = $('.tab-content').find("div.active").find('input[name="pass1"]').val();
        
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });

        if(acc == null || acc == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Account no must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(subscriber == null || subscriber == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Account name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(amount == null || amount == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Amount must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(pass == null || pass == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Transaction password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{

            $('.btnType1').attr('disabled',true);

                $.ajax({
                    url:'bills_payment_send',
                    type:"post",
                    data:{btnType:btnType,biller:biller,acc:acc,subscriber:subscriber,amount:amount,pass:pass},
                    dataType:"json",
                    success: function(data) {
						
                        //console.log(data);
                        if(data["S"] == 1) {
                            
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                            $('.tab-content').find("div.active").find('input[name="acc_no1"]').val('');
                            $('.tab-content').find("div.active").find('input[name="subscriber_name1"]').val('');
                            $('.tab-content').find("div.active").find('input[name="amount1"]').val('');
                            $('.tab-content').find("div.active").find('input[name="pass1"]').val('');

                            $('.btnType1').removeAttr('disabled');
                            $('.secondView').show();
                            $('.firstView').hide();
                            //$('#billspayment').val(data['TN']);
							$('input[name="billspayment"]').val(data["TN"]);
        				}
//        				else {
//
//                            // alert('merson');
//                            $('.firstView').hide();
//                            $('.secondView').show();
//                            $('#billspayment').val(data['TN']);
//                        }
                        else {

                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                            $('.btnType1').removeAttr('disabled');
                        }
                         $('#myModal').modal('hide');
                    }
                
                
                });
            
        }
    });


	$('.btnType2').click(function(){

		var btnType   	= $(".btnType2").val();
		var appender	= $('.appender').val();
		var distinctID 	= '#select_biller'+appender;
		var biller 		= $(distinctID).val();
		var acc	        = $('.tab-content').find("div.active").find('input[name="acc_no2"]').val();
		var subscriber	= $('.tab-content').find("div.active").find('input[name="donator2"]').val();
		var amount	    = $('.tab-content').find("div.active").find('input[name="amount2"]').val();
		var pass	    = $('.tab-content').find("div.active").find('input[name="pass2"]').val();
        
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });

        if(subscriber == null || subscriber == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Donator name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(amount == null || amount == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Amount must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(pass == null || pass == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Transaction password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
            
            
    		      
        
            $('.btnType2').attr('disabled',true);
    			
                $.ajax({
    				url:'bills_payment_send',
    				type:"post",
    				data:{btnType:btnType,biller:biller,acc:acc,subscriber:subscriber,amount:amount,pass:pass},
    				dataType:"json",
     			    success: function(data) {
    
        				//console.log(data);
        				if(data["S"] == 1) {
        				    
        				    $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                            $('.tab-content').find("div.active").find('input[name="acc_no2"]').val('');
                            $('.tab-content').find("div.active").find('input[name="donator2"]').val('');
                            $('.tab-content').find("div.active").find('input[name="amount2"]').val('');
                            $('.tab-content').find("div.active").find('input[name="pass2"]').val('');

                            $('.btnType2').removeAttr('disabled');


                            $('.secondView').show();
                            $('.firstView').hide();
                            //$('#billspayment').val(data['TN']);
							$('input[name="billspayment"]').val(data["TN"]);
        				}
        				else {
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                            $('.btnType2').removeAttr('disabled');
                        }
                        $('#myModal').modal('hide');
                    }
                
    			
    			});
    		
        }
	});

	$('.btnType3').click(function(){

		var btnType   		= $(".btnType3").val();
		var appender		= $('.appender').val();
		var distinctID 		= '#select_biller'+appender;
		var biller 			= $(distinctID).val();
		var acc	            = $('.tab-content').find("div.active").find('input[name="acc_no3"]').val();
		var subscriber	    = $('.tab-content').find("div.active").find('input[name="subscriber_name3"]').val();
		var book_id   	    = $('.tab-content').find("div.active").find('input[name="book_id3"]').val();
		var month   	    = $('.tab-content').find("div.active").find('input[name="billing_month3"]').val();
		var mobile   	    = $('.tab-content').find("div.active").find('input[name="mobile"]').val();
		var amount   	    = $('.tab-content').find("div.active").find('input[name="amount3"]').val();
		var pass   	        = $('.tab-content').find("div.active").find('input[name="pass3"]').val();
        
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });

        if (acc == null || acc == "" ){
            $('#myModal').modal('hide');
            $('.mensahe').html('Passport no must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(subscriber == null || subscriber == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Account name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(book_id == null || book_id == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Book id must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(amount == null || amount == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Amount must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(pass == null || pass == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Transaction password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
            
            
    		      
        
            $('.btnType3').attr('disabled',true);
    			
                $.ajax({
    				url:'bills_payment_send',
    				type:"post",
    				data:{btnType:btnType,biller:biller,acc:acc,subscriber:subscriber,amount:amount,pass:pass},
    				dataType:"json",
     			    success: function(data) {
    
        				//console.log(data);
        				if(data["S"] == 1) {
        				    
        				    $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                            $('.tab-content').find("div.active").find('input[name="acc_no3"]').val('');
                            $('.tab-content').find("div.active").find('input[name="subscriber_name3"]').val('');
                            $('.tab-content').find("div.active").find('input[name="book_id3"]').val('');
                            $('.tab-content').find("div.active").find('input[name="billing_month3"]').val('');
                            $('.tab-content').find("div.active").find('input[name="mobile"]').val('');
                            $('.tab-content').find("div.active").find('input[name="amount3"]').val('');
                            $('.tab-content').find("div.active").find('input[name="pass3"]').val('');

                            $('.btnType3').removeAttr('disabled');


                            $('.secondView').show();
                            $('.firstView').hide();
                            //$('#billspayment').val(data['TN']);
							$('input[name="billspayment"]').val(data["TN"]);
        				}
        				else {
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
                            $('.btnType3').removeAttr('disabled');
        				}
                        $('#myModal').modal('hide');
                    }
                
    			
    			});
    		
        }
	});    

	$('.btnType4').click(function(){

		var btnType   		= $(".btnType4").val();
		var appender		= $('.appender').val();
		var distinctID 		= '#select_biller'+appender;
		var biller 			= $(distinctID).val();
		var acc	            = $('.tab-content').find("div.active").find('input[name="pass_port4"]').val();
		var subscriber	    = $('.tab-content').find("div.active").find('input[name="subscriber_name4"]').val();
		var amount   	    = $('.tab-content').find("div.active").find('input[name="amount4"]').val();
		var pass   	        = $('.tab-content').find("div.active").find('input[name="pass4"]').val();

        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });        

        if (acc == null || acc == "" ){
            $('#myModal').modal('hide');
            $('.mensahe').html('Passport no must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(subscriber == null || subscriber == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Account name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(amount == null || amount == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Amount must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(pass == null || pass == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Transaction password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
            
            
    		      
        
            $('.btnType4').attr('disabled',true);

    			$.ajax({
    				url:'bills_payment_send',
    				type:"post",
    				data:{btnType:btnType,biller:biller,acc:acc,subscriber:subscriber,amount:amount,pass:pass},
    				dataType:"json",
     			    success: function(data) {
    
        				//console.log(data);
        				if(data["S"] == 1) {
        				    
        				    $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                            $('.tab-content').find("div.active").find('input[name="pass_port4"]').val('');
                            $('.tab-content').find("div.active").find('input[name="subscriber_name4"]').val('');
                            $('.tab-content').find("div.active").find('input[name="amount4"]').val('');
                            $('.tab-content').find("div.active").find('input[name="pass4"]').val('');

                            $('.secondView').show();
                            $('.firstView').hide();
                            //$('#billspayment').val(data['TN']);
							$('input[name="billspayment"]').val(data["TN"]);
        				}
        				else {
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
    
        				}
                        $('.btnType4').removeAttr('disabled');
                        $('#myModal').modal('hide');
        
                    }
                
    			
    			});
    		
        }
	});
        
	$('.btnType5').click(function(){

		var btnType   		= $(".btnType5").val();
		var appender		= $('.appender').val();
		var distinctID 		= '#select_biller'+appender;
		var biller 			= $(distinctID).val();
		var acc	            = $('.tab-content').find("div.active").find('input[name="acc_no5"]').val();
		var subscriber	    = $('.tab-content').find("div.active").find('input[name="subscriber_name5"]').val();
		var amount   	    = $('.tab-content').find("div.active").find('input[name="amount5"]').val();
		var pass   	        = $('.tab-content').find("div.active").find('input[name="pass5"]').val();
        
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });

        if (acc == null || acc == "" ){
            $('#myModal').modal('hide');
            $('.mensahe').html('Booking no must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(subscriber == null || subscriber == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Account name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(amount == null || amount == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Amount must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(pass == null || pass == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Transaction password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
            
            
    		      
        
            $('.btnType5').attr('disabled',true);
    			$.ajax({
    				url:'bills_payment_send',
    				type:"post",
    				data:{btnType:btnType,biller:biller,acc:acc,subscriber:subscriber,amount:amount,pass:pass},
    				dataType:"json",
     			    success: function(data) {
    
        				//console.log(data);
        				if(data["S"] == 1) {
        				    
        				    $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                            $('.tab-content').find("div.active").find('input[name="acc_no5"]').val('');
                            $('.tab-content').find("div.active").find('input[name="subscriber_name5"]').val('');
                            $('.tab-content').find("div.active").find('input[name="amount5"]').val('');
                            $('.tab-content').find("div.active").find('input[name="pass5"]').val('');

                            $('.secondView').show();
                            $('.firstView').hide();
                            //$('#billspayment').val(data['TN']);
							$('input[name="billspayment"]').val(data["TN"]);
        				}
        				else {
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
    
        				}
                        $('.btnType5').removeAttr('disabled');
                        $('#myModal').modal('hide');
                    }
                
    			
    			});
    		
        }
	});
    
	$('.btnType6').click(function(){

		var btnType   		= $(".btnType6").val();
		var appender		= $('.appender').val();
		var distinctID 		= '#select_biller'+appender;
		var biller 			= $(distinctID).val();
		var acc	            = $('.tab-content').find("div.active").find('input[name="student_no6"]').val();
		var subscriber	    = $('.tab-content').find("div.active").find('input[name="subscriber_name6"]').val();
		var amount   	    = $('.tab-content').find("div.active").find('input[name="amount6"]').val();
		var pass   	        = $('.tab-content').find("div.active").find('input[name="pass6"]').val();
        
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });


        if (acc == null || acc == "" ){
            $('#myModal').modal('hide');
            $('.mensahe').html('Student no must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(subscriber == null || subscriber == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Student name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(amount == null || amount == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Amount must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(pass == null || pass == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Transaction password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
            
            
    		      
        
            $('.btnType6').attr('disabled',true);
    			$.ajax({
    				url:'bills_payment_send',
    				type:"post",
    				data:{btnType:btnType,biller:biller,acc:acc,subscriber:subscriber,amount:amount,pass:pass},
    				dataType:"json",
     			    success: function(data) {
    
        				//console.log(data);
        				if(data["S"] == 1) {
        				    
        				    $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                            $('.tab-content').find("div.active").find('input[name="student_no6"]').val('');
                            $('.tab-content').find("div.active").find('input[name="subscriber_name6"]').val('');
                            $('.tab-content').find("div.active").find('input[name="amount6"]').val('');
                            $('.tab-content').find("div.active").find('input[name="pass6"]').val('');

                            $('.secondView').show();
                            $('.firstView').hide();
                            //$('#billspayment').val(data['TN']);
							$('input[name="billspayment"]').val(data["TN"]);
        				}
        				else {
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
    
        				}
                        $('.btnType6').removeAttr('disabled');
                        $('#myModal').modal('hide');
                    }
                
    			
    			});
    		
        }
	});
    
    
	$('.btnType7').click(function(){

		var btnType   		= $(".btnType7").val();
		var appender		= $('.appender').val();
		var distinctID 		= '#select_biller'+appender;
		var biller 			= $(distinctID).val();
		var acc	            = $('.tab-content').find("div.active").find('input[name="acc_no7"]').val();
		var subscriber	    = $('.tab-content').find("div.active").find('input[name="subscriber_name7"]').val();
		var amount   	    = $('.tab-content').find("div.active").find('input[name="amount7"]').val();
		var pass   	        = $('.tab-content').find("div.active").find('input[name="pass7"]').val();
        
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });

        if (acc == null || acc == "" ){
            $('#myModal').modal('hide');
            $('.mensahe').html('Account no must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(subscriber == null || subscriber == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Account name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(amount == null || amount == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Amount must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(pass == null || pass == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Transaction password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
            
            
    		      
            
            $('.btnType7').attr('disabled',true);

    			$.ajax({
    				url:'bills_payment_send',
    				type:"post",
    				data:{btnType:btnType,biller:biller,acc:acc,subscriber:subscriber,amount:amount,pass:pass},
    				dataType:"json",
     			    success: function(data) {
    
        				//console.log(data);
        				if(data["S"] == 1) {
        				    
        				    $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                            $('.tab-content').find("div.active").find('input[name="acc_no7"]').val('');
                            $('.tab-content').find("div.active").find('input[name="subscriber_name7"]').val('');
                            $('.tab-content').find("div.active").find('input[name="amount7"]').val('');
                            $('.tab-content').find("div.active").find('input[name="pass7"]').val('');

                            $('.secondView').show();
                            $('.firstView').hide();
                            //$('#billspayment').val(data['TN']);
							$('input[name="billspayment"]').val(data["TN"]);
        				}
        				else {
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
    
        				}
                        $('.btnType7').removeAttr('disabled');
                        $('#myModal').modal('hide');
        
                    }
                
    			
    			});
    		
        }
	});
    
	$('.btnType8').click(function(){

		var btnType   		= $(".btnType8").val();
		var appender		= $('.appender').val();
		var distinctID 		= '#select_biller'+appender;
		var biller 			= $(distinctID).val();
		var acc	            = $('.tab-content').find("div.active").find('input[name="acc_no8"]').val();
		var subscriber	    = $('.tab-content').find("div.active").find('input[name="subscriber_name8"]').val();
		var amount   	    = $('.tab-content').find("div.active").find('input[name="amount8"]').val();
		var pass   	        = $('.tab-content').find("div.active").find('input[name="pass8"]').val();
        
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });


        if (acc == null || acc == "" ){
            $('#myModal').modal('hide');
            $('.mensahe').html('Account no must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUpBig').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(subscriber == null || subscriber == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Account name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUpBig').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(amount == null || amount == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Amount must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUpBig').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(pass == null || pass == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Transaction password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUpBig').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
            
            
    		$('.mensahe').html('Processing..');
            $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUpBig fadeInLeft').show();      
            
            $('.btnType7').attr('disabled',true);

    			$.ajax({
    				url:'bills_payment_send',
    				type:"post",
    				data:{btnType:btnType,biller:biller,acc:acc,subscriber:subscriber,amount:amount,pass:pass},
    				dataType:"json",
     			    success: function(data) {
    
        				//console.log(data);
        				if(data["S"] == 1) {
        				    
        				    $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                            $('.tab-content').find("div.active").find('input[name="acc_no8"]').val('');
                            $('.tab-content').find("div.active").find('input[name="subscriber_name8"]').val('');
                            $('.tab-content').find("div.active").find('input[name="amount8"]').val('');
                            $('.tab-content').find("div.active").find('input[name="pass8"]').val('');

                            $('.secondView').show();
                            $('.firstView').hide();
                            //$('#billspayment').val(data['TN']);
							$('input[name="billspayment"]').val(data["TN"]);
        				}
        				else {
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-danger animated fadeInUpBig').removeClass('alert-info alert-success').fadeIn().delay(9000).fadeOut();
    
        				}
                        $('.btnType7').removeAttr('disabled');
                        $('#myModal').modal('hide');
                    }
                
    			
    			});
    		
        }
	});
    
	$('.btnType9').click(function(){

		var btnType   		= $(".btnType9").val();
		var appender		= $('.appender').val();
		var distinctID 		= '#select_biller'+appender;
		var biller 			= $(distinctID).val();
		var acc	            = $('.tab-content').find("div.active").find('input[name="acc_no9"]').val();
		var subscriber	    = $('.tab-content').find("div.active").find('input[name="subscriber_name9"]').val();
		var amount   	    = $('.tab-content').find("div.active").find('input[name="amount9"]').val();
		var pass   	        = $('.tab-content').find("div.active").find('input[name="pass9"]').val();
        
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });

        if (acc == null || acc == "" ){
            $('#myModal').modal('hide');
            $('.mensahe').html('Student no must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(subscriber == null || subscriber == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Student name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(amount == null || amount == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Amount must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(pass == null || pass == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Transaction password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
            
            
    		      
        
            $('.btnType9').attr('disabled',true);
    			$.ajax({
    				url:'bills_payment_send',
    				type:"post",
    				data:{btnType:btnType,biller:biller,acc:acc,subscriber:subscriber,amount:amount,pass:pass},
    				dataType:"json",
     			    success: function(data) {
    
        				//console.log(data);
        				if(data["S"] == 1) {
        				    
        				    $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                            $('.tab-content').find("div.active").find('input[name="acc_no9"]').val('');
                            $('.tab-content').find("div.active").find('input[name="subscriber_name9"]').val('');
                            $('.tab-content').find("div.active").find('input[name="amount9"]').val('');
                            $('.tab-content').find("div.active").find('input[name="pass9"]').val('');

                            $('.secondView').show();
                            $('.firstView').hide();
                            //$('#billspayment').val(data['TN']);
							$('input[name="billspayment"]').val(data["TN"]);
        				}
        				else {
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
    
        				}
                        $('.btnType9').removeAttr('disabled');
                        $('#myModal').modal('hide');
                    }
                
    			
    			});
    		
        }
	});
    
	$('.btnType10').click(function(){

		var btnType   		= $(".btnType10").val();
		var appender		= $('.appender').val();
		var distinctID 		= '#select_biller'+appender;
		var biller 			= $(distinctID).val();
		var acc	            = $('.tab-content').find("div.active").find('input[name="acc_no10"]').val();
		var subscriber	    = $('.tab-content').find("div.active").find('input[name="subscriber_name10"]').val();
		var amount   	    = $('.tab-content').find("div.active").find('input[name="amount10"]').val();
		var pass   	        = $('.tab-content').find("div.active").find('input[name="pass10"]').val();
        
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });

        if (acc == null || acc == "" ){
            $('#myModal').modal('hide');
            $('.mensahe').html('Account no must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(subscriber == null || subscriber == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Account name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(amount == null || amount == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Amount must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(pass == null || pass == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Transaction password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
            
            
    		      
            
            $('.btnType10').attr('disabled',true);

    			$.ajax({
    				url:'bills_payment_send',
    				type:"post",
    				data:{btnType:btnType,biller:biller,acc:acc,subscriber:subscriber,amount:amount,pass:pass},
    				dataType:"json",
     			    success: function(data) {
    
        				//console.log(data);
        				if(data["S"] == 1) {
        				    
        				    $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                            $('.tab-content').find("div.active").find('input[name="acc_no10"]').val('');
                            $('.tab-content').find("div.active").find('input[name="subscriber_name10"]').val('');
                            $('.tab-content').find("div.active").find('input[name="amount10"]').val('');
                            $('.tab-content').find("div.active").find('input[name="pass10"]').val('');

                            $('.secondView').show();
                            $('.firstView').hide();
                            //$('#billspayment').val(data['TN']);
							$('input[name="billspayment"]').val(data["TN"]);
        				}
        				else {
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
    
        				}
                        $('.btnType10').removeAttr('disabled');
                        $('#myModal').modal('hide');
                    }
                
    			
    			});
    		
        }
	});

	$('.btnType11').click(function(){

		var btnType   		= $(".btnType11").val();
		var appender		= $('.appender').val();
		var distinctID 		= '#select_biller'+appender;
		var biller 			= $(distinctID).val();
		var acc	            = $('.tab-content').find("div.active").find('input[name="acc_no11"]').val();
		var subscriber	    = $('.tab-content').find("div.active").find('input[name="subscriber_name11"]').val();
		var amount   	    = $('.tab-content').find("div.active").find('input[name="amount11"]').val();
		var pass   	        = $('.tab-content').find("div.active").find('input[name="pass11"]').val();
        
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });

        if (acc == null || acc == "" ){
            $('#myModal').modal('hide');
            $('.mensahe').html('Account no must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(subscriber == null || subscriber == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Account name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(amount == null || amount == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Amount must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(pass == null || pass == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Transaction password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
            
            
    		      
            
            $('.btnType11').attr('disabled',true);

    			$.ajax({
    				url:'bills_payment_send',
    				type:"post",
    				data:{btnType:btnType,biller:biller,acc:acc,subscriber:subscriber,amount:amount,pass:pass},
    				dataType:"json",
     			    success: function(data) {
    
        				//console.log(data);
        				if(data["S"] == 1) {
        				    
        				    $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                            $('.tab-content').find("div.active").find('input[name="acc_no11"]').val('');
                            $('.tab-content').find("div.active").find('input[name="subscriber_name11"]').val('');
                            $('.tab-content').find("div.active").find('input[name="amount11"]').val('');
                            $('.tab-content').find("div.active").find('input[name="pass11"]').val('');

                            $('.secondView').show();
                            $('.firstView').hide();
                            //$('#billspayment').val(data['TN']);
							$('input[name="billspayment"]').val(data["TN"]);
        				}
        				else {
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
    
        				}
                        $('.btnType11').removeAttr('disabled');
                        $('#myModal').modal('hide');
                    }
                
    			
    			});
    		
        }
	});
    
	$('.btnType12').click(function(){

		var btnType   		= $(".btnType12").val();
		var appender		= $('.appender').val();
		var distinctID 		= '#select_biller'+appender;
		var biller 			= $(distinctID).val();
		var acc	            = $('.tab-content').find("div.active").find('input[name="acc_no12"]').val();
		var subscriber	    = $('.tab-content').find("div.active").find('input[name="subscriber_name12"]').val();
		var amount   	    = $('.tab-content').find("div.active").find('input[name="amount12"]').val();
		var pass   	        = $('.tab-content').find("div.active").find('input[name="pass12"]').val();
        
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });

        if (acc == null || acc == "" ){
            $('#myModal').modal('hide');
            $('.mensahe').html('Account no must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(subscriber == null || subscriber == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Account name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(amount == null || amount == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Amount must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(pass == null || pass == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Transaction password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
            
            
    		      
        
            $('.btnType12').attr('disabled',true);
    			$.ajax({
    				url:'bills_payment_send',
    				type:"post",
    				data:{btnType:btnType,biller:biller,acc:acc,subscriber:subscriber,amount:amount,pass:pass},
    				dataType:"json",
     			    success: function(data) {
    
        				//console.log(data);
        				if(data["S"] == 1) {
        				    
        				    $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                            $('.tab-content').find("div.active").find('input[name="acc_no12"]').val('');
                            $('.tab-content').find("div.active").find('input[name="subscriber_name12"]').val('');
                            $('.tab-content').find("div.active").find('input[name="amount12"]').val('');
                            $('.tab-content').find("div.active").find('input[name="pass12"]').val('');

                            $('.secondView').show();
                            $('.firstView').hide();
                            //$('#billspayment').val(data['TN']);
							$('input[name="billspayment"]').val(data["TN"]);
        				}
        				else {
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
    
        				}
                        $('.btnType12').removeAttr('disabled');
                        $('#myModal').modal('hide');
                    }
                
    			
    			});
    		
        }
	});
    
	$('.btnType13').click(function(){

		var btnType   		= $(".btnType13").val();
		var appender		= $('.appender').val();
		var distinctID 		= '#select_biller'+appender;
		var biller 			= $(distinctID).val();
		var acc	            = $('.tab-content').find("div.active").find('input[name="acc_no13"]').val();
        var sy              = $('.tab-content').find("div.active").find(".school_year13 option:selected").attr('schoolyear13');
        var sem             = $('.tab-content').find("div.active").find(".semester_13 option:selected").attr('semester13');
		var lname	        = $('.tab-content').find("div.active").find('input[name="last_name13"]').val();
		var fname	        = $('.tab-content').find("div.active").find('input[name="first_name13"]').val();
		var mname     	    = $('.tab-content').find("div.active").find('input[name="middle_name13"]').val();
		var subscriber	    = fname +' '+ mname +' '+ lname; 
		var course	        = $('.tab-content').find("div.active").find('.course_13 option:selected').attr('course13');
		var yearlevel	    = $('.tab-content').find("div.active").find('.year_level_13 option:selected').attr('year_level13');
		var campus	        = $('.tab-content').find("div.active").find('.campus_13 option:selected').attr('campus13');
		var amount   	    = $('.tab-content').find("div.active").find('input[name="amount13"]').val();
		var pass   	        = $('.tab-content').find("div.active").find('input[name="pass13"]').val();
        
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
        
        if (acc == null || acc == "" ){
            $('#myModal').modal('hide');
            $('.mensahe').html('Student no must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(lname == null || lname == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Last name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(fname == null || fname == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('First name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(mname == null || mname == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Middle name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(amount == null || amount == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Amount must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(pass == null || pass == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Transaction password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
            
            
    		      
        
            $('.btnType13').attr('disabled',true);
    			$.ajax({
    				url:'bills_payment_send',
    				type:"post",
    				data:{btnType:btnType,biller:biller,acc:acc,subscriber:subscriber,amount:amount,pass:pass,sy:sy,sem:sem,lname:lname,fname:fname,mname:mname,course:course,yearlevel:yearlevel,campus:campus},
    				dataType:"json",
     			    success: function(data) {
    
        				//console.log(data);
        				if(data["S"] == 1) {
        				    
        				    $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                            $('.tab-content').find("div.active").find('input[name="acc_no13"]').val('');
                            $('.tab-content').find("div.active").find('input[name="last_name13"]').val('');
                            $('.tab-content').find("div.active").find('input[name="first_name13"]').val('');
                            $('.tab-content').find("div.active").find('input[name="middle_name13"]').val('');
                            $('.tab-content').find("div.active").find('input[name="amount13"]').val('');
                            $('.tab-content').find("div.active").find('input[name="pass13"]').val('');

                            $('.secondView').show();
                            $('.firstView').hide();
                            //$('#billspayment').val(data['TN']);
							$('input[name="billspayment"]').val(data["TN"]);
        				}
        				else {
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
    
        				}
                        $('.btnType13').removeAttr('disabled');
                        $('#myModal').modal('hide');
                    }
                
    			
    			});
    		
        }
	});
    
	$('.btnType14').click(function(){

		var btnType   		= $(".btnType14").val();
		var appender		= $('.appender').val();
		var distinctID 		= '#select_biller'+appender;
		var biller 			= $(distinctID).val();
		var acc	            = $('.tab-content').find("div.active").find('input[name="acc_no14"]').val();
		var idno            = $('.tab-content').find("div.active").find('input[name="id_no14"]').val();
		var billmonth       = $('.tab-content').find("div.active").find('input[name="billing_month14"]').val();
		var subscriber	    = $('.tab-content').find("div.active").find('input[name="subscriber_name14"]').val();
		var mobile   	    = $('.tab-content').find("div.active").find('input[name="mobile_no14"]').val();
		var amount   	    = $('.tab-content').find("div.active").find('input[name="amount14"]').val();
		var pass   	        = $('.tab-content').find("div.active").find('input[name="pass14"]').val();
        
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });

        if (acc == null || acc == "" ){
            $('#myModal').modal('hide');
            $('.mensahe').html('Account no must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(idno == null || idno == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('ID no must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(billmonth == null || billmonth == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Billing month no must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(subscriber == null || subscriber == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Account name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(mobile == null || mobile == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Mobile number must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(amount == null || amount == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Amount must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(pass == null || pass == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Transaction password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
            
            
    		      
            $('.btnType14').attr('disabled',true);

    			$.ajax({
    				url:'bills_payment_send',
    				type:"post",
    				data:{btnType:btnType,biller:biller,acc:acc,subscriber:subscriber,mobile:mobile,amount:amount,pass:pass,billmonth:billmonth,idno:idno},
    				dataType:"json",
     			    success: function(data) {
    
        				//console.log(data);
        				if(data["S"] == 1) {
        				    
        				    $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                            $('.tab-content').find("div.active").find('input[name="acc_no14"]').val('');
                            $('.tab-content').find("div.active").find('input[name="id_no14"]').val('');
                            $('.tab-content').find("div.active").find('input[name="billing_month14"]').val('');
                            $('.tab-content').find("div.active").find('input[name="subscriber_name14"]').val('');
                            $('.tab-content').find("div.active").find('input[name="mobile_no14"]').val('');
                            $('.tab-content').find("div.active").find('input[name="amount14"]').val('');
                            $('.tab-content').find("div.active").find('input[name="pass14"]').val('');

                            $('.secondView').show();
                            $('.firstView').hide();
                            //$('#billspayment').val(data['TN']);
							$('input[name="billspayment"]').val(data["TN"]);
        				}
        				else {
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
    
        				}
                        $('.btnType14').removeAttr('disabled');
                        $('#myModal').modal('hide');
                    }
                
    			
    			});
    		
        }
	});

	$('.btnType15').click(function(){

		var btnType   		= $(".btnType15").val();
		var appender		= $('.appender').val();
		var distinctID 		= '#select_biller'+appender;
		var biller 			= $(distinctID).val();
		var acc	            = $('.tab-content').find("div.active").find('input[name="acc_no15"]').val();
		var subscriber	    = $('.tab-content').find("div.active").find('input[name="subscriber_name15"]').val();
		var amount   	    = $('.tab-content').find("div.active").find('input[name="amount15"]').val();
		var pass   	        = $('.tab-content').find("div.active").find('input[name="pass15"]').val();
        
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });

        if (acc == null || acc == "" ){
            $('#myModal').modal('hide');
            $('.mensahe').html('Account no must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(subscriber == null || subscriber == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Account name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(amount == null || amount == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Amount must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(pass == null || pass == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Transaction password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
            
            
    		      
            $('.btnType15').attr('disabled',true);

    			$.ajax({
    				url:'bills_payment_send',
    				type:"post",
    				data:{btnType:btnType,biller:biller,acc:acc,subscriber:subscriber,amount:amount,pass:pass},
    				dataType:"json",
     			    success: function(data) {
    
        				//console.log(data);
        				if(data["S"] == 1) {
        				    
        				    $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                            $('.tab-content').find("div.active").find('input[name="acc_no15"]').val('');
                            $('.tab-content').find("div.active").find('input[name="subscriber_name15"]').val('');
                            $('.tab-content').find("div.active").find('input[name="amount15"]').val('');
                            $('.tab-content').find("div.active").find('input[name="pass15"]').val('');

                            $('.secondView').show();
                            $('.firstView').hide();
                            //$('#billspayment').val(data['TN']);
							$('input[name="billspayment"]').val(data["TN"]);
        				}
        				else {
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
    
        				}
                        $('.btnType15').removeAttr('disabled');
                        $('#myModal').modal('hide');
                    }
                
    			
    			});
    		
        }
	});
    
	$('.btnType16').click(function(){

		var btnType   		= $(".btnType16").val();
		var appender		= $('.appender').val();
		var distinctID 		= '#select_biller'+appender;
		var biller 			= $(distinctID).val();
		var acc	            = $('.tab-content').find("div.active").find('input[name="acc_no16"]').val();
		var month	        = $('.tab-content').find("div.active").find('input[name="grace_period16"]').val();
		var fname     	    = $('.tab-content').find("div.active").find('input[name="first_name16"]').val();
		var mname     	    = $('.tab-content').find("div.active").find('input[name="middle_name16"]').val();
		var lname     	    = $('.tab-content').find("div.active").find('input[name="last_name16"]').val();
        var subscriber	    = fname +' '+ mname +' '+ lname; 
		var amount   	    = $('.tab-content').find("div.active").find('input[name="amount16"]').val();
		var pass   	        = $('.tab-content').find("div.active").find('input[name="pass16"]').val();
        
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });

        if (acc == null || acc == "" ){
            $('#myModal').modal('hide');
            $('.mensahe').html('Account no must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(month == null || month == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Billing month must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(fname == null || fname == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('First name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(mname == null || mname == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Middle name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(lname == null || lname == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Last name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(amount == null || amount == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Amount must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(pass == null || pass == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Transaction password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
            
            
    		      
            $('.btnType16').attr('disabled',true);

    			$.ajax({
    				url:'bills_payment_send',
    				type:"post",
    				data:{btnType:btnType,biller:biller,acc:acc,subscriber:subscriber,amount:amount,pass:pass,month:month},
    				dataType:"json",
     			    success: function(data) {
    
        				//console.log(data);
        				if(data["S"] == 1) {
        				    
        				    $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                            $('.tab-content').find("div.active").find('input[name="acc_no16"]').val('');
                            $('.tab-content').find("div.active").find('input[name="grace_period16"]').val('');
                            $('.tab-content').find("div.active").find('input[name="first_name16"]').val('');
                            $('.tab-content').find("div.active").find('input[name="middle_name16"]').val('');
                            $('.tab-content').find("div.active").find('input[name="last_name16"]').val('');
                            $('.tab-content').find("div.active").find('input[name="amount16"]').val('');
                            $('.tab-content').find("div.active").find('input[name="pass16"]').val('');

                            $('.secondView').show();
                            $('.firstView').hide();
                            //$('#billspayment').val(data['TN']);
							$('input[name="billspayment"]').val(data["TN"]);
        				}
        				else {
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
    
        				}
                        $('.btnType16').removeAttr('disabled');
                        $('#myModal').modal('hide');
                    }
                
    			
    			});
    		
        }
	});
    
	$('.btnType17').click(function(){

		var btnType   		= $(".btnType17").val();
		var appender		= $('.appender').val();
		var distinctID 		= '#select_biller'+appender;
		var biller 			= $(distinctID).val();
		var acc	            = $('.tab-content').find("div.active").find('input[name="acc_no17"]').val();
		var subscriber	    = $('.tab-content').find("div.active").find('input[name="subscriber_name17"]').val();
        var email           = $('.tab-content').find("div.active").find('input[name="email17"]').val();
        var mobile          = $('.tab-content').find("div.active").find('input[name="mobile_no17"]').val();
		var amount       	= $('.tab-content').find("div.active").find('input[name="amount17"]').val();
		var pass   	        = $('.tab-content').find("div.active").find('input[name="pass17"]').val();
        
        var leavedate       = $('.tab-content').find("div.active").find('input[name="onward_date17"]').val();
        var route1          = $('.tab-content').find("div.active").find('input[name="onward_route17"]').val();
        var flight1         = $('.tab-content').find("div.active").find('input[name="onward_flight_number17"]').val();
        var etd1            = $('.tab-content').find("div.active").find('input[name="onward_ETD_ETA17"]').val();
        
        var returndate      = $('.tab-content').find("div.active").find('input[name="return_date17"]').val();
        var route2          = $('.tab-content').find("div.active").find('input[name="return_route17"]').val();
        var flight2         = $('.tab-content').find("div.active").find('input[name="return_flight_number17"]').val();
        var etd2            = $('.tab-content').find("div.active").find('input[name="return_ETD_ETA17"]').val();

        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });

        if (acc == null || acc == "" ){
            $('#myModal').modal('hide');
            $('.mensahe').html('Account no must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(subscriber == null || subscriber == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Lead name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(email == null || email == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Email must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(mobile == null || mobile == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Mobile number must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(amount == null || amount == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Amount must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(pass == null || pass == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Transaction password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(leavedate == null || leavedate == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Leave Date must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(route1 == null || route1 == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Route must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(flight1 == null || flight1 == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Flight number must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(etd1 == null || etd1 == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('ETD-ETA number must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
            
            
    		      
            $('.btnType17').attr('disabled',true)

    			$.ajax({
    				url:'bills_payment_send',
    				type:"post",
    				data:{btnType:btnType,biller:biller,acc:acc,subscriber:subscriber,mobile:mobile,amount:amount,pass:pass,email:email,leavedate:leavedate,route1:route1,flight1:flight1,etd1:etd1,returndate:returndate,route2:route2,flight2:flight2,etd2:etd2},
    				dataType:"json",
     			    success: function(data) {
    
        				//console.log(data);
        				if(data["S"] == 1) {
        				    
        				    $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                            $('.tab-content').find("div.active").find('input[name="acc_no17"]').val('');
                            $('.tab-content').find("div.active").find('input[name="subscriber_name17"]').val('');
                            $('.tab-content').find("div.active").find('input[name="email17"]').val('');
                            $('.tab-content').find("div.active").find('input[name="mobile_no17"]').val('');
                            $('.tab-content').find("div.active").find('input[name="amount17"]').val('');
                            $('.tab-content').find("div.active").find('input[name="pass17"]').val('');
                            $('.tab-content').find("div.active").find('input[name="onward_date17"]').val('');
                            $('.tab-content').find("div.active").find('input[name="onward_route17"]').val('');
                            $('.tab-content').find("div.active").find('input[name="onward_flight_number17"]').val('');
                            $('.tab-content').find("div.active").find('input[name="onward_ETD_ETA17"]').val('');
                            
                            $('.tab-content').find("div.active").find('input[name="return_date17"]').val('');
                            $('.tab-content').find("div.active").find('input[name="return_route17"]').val('');
                            $('.tab-content').find("div.active").find('input[name="return_flight_number17"]').val('');
                            $('.tab-content').find("div.active").find('input[name="return_ETD_ETA17"]').val('');

                            $('.secondView').show();
                            $('.firstView').hide();
                            //$('#billspayment').val(data['TN']);
							$('input[name="billspayment"]').val(data["TN"]);
        				}
        				else {
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
    
        				}
                        $('.btnType17').removeAttr('disabled');
                        $('#myModal').modal('hide');
                    }
                
    			
    			});
    		
        }
	});
    
	$('.btnType18').click(function(){

		var btnType   		= $(".btnType18").val();
		var appender		= $('.appender').val();
		var distinctID 		= '#select_biller'+appender;
		var biller 			= $(distinctID).val();
		var acc	            = $('.tab-content').find("div.active").find('input[name="acc_no18"]').val();
		var subscriber	    = $('.tab-content').find("div.active").find('input[name="subscriber_name18"]').val();
		var amount   	    = $('.tab-content').find("div.active").find('input[name="amount18"]').val();
		var pass   	        = $('.tab-content').find("div.active").find('input[name="pass18"]').val();
        
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });

        if (acc == null || acc == "" ){
            $('#myModal').modal('hide');
            $('.mensahe').html('Account no must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(subscriber == null || subscriber == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Account name must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(amount == null || amount == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Amount must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(pass == null || pass == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Transaction password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
            
            
    		      
            $('.btnType18').attr('disabled',true);

    			$.ajax({
    				url:'bills_payment_send',
    				type:"post",
    				data:{btnType:btnType,biller:biller,acc:acc,subscriber:subscriber,amount:amount,pass:pass},
    				dataType:"json",
     			    success: function(data) {
    
        				//console.log(data);
        				if(data["S"] == 1) {
        				    
        				    $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                            $('.tab-content').find("div.active").find('input[name="acc_no18"]').val('');
                            $('.tab-content').find("div.active").find('input[name="subscriber_name18"]').val('');
                            $('.tab-content').find("div.active").find('input[name="amount18"]').val('');
                            $('.tab-content').find("div.active").find('input[name="pass18"]').val('');

                            $('.secondView').show();
                            $('.firstView').hide();
                            //$('#billspayment').val(data['TN']);
							$('input[name="billspayment"]').val(data["TN"]);
        				}
        				else {
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
    
        				}
                        $('.btnType18').removeAttr('disabled');
                        $('#myModal').modal('hide');
                    }
                
    			
    			});
    		
        }
	});
    
	$('.btnType19').click(function(){

		var btnType   	= $(".btnType19").val();
		var appender	= $('.appender').val();
		var distinctID 	= '#select_biller'+appender;
		var biller 		= $(distinctID).val();
		var acc	        = $('.tab-content').find("div.active").find('input[name="acc_no19"]').val();
		var subscriber	= $('.tab-content').find("div.active").find('input[name="number19"]').val();
		var amount	    = $('.tab-content').find("div.active").find('input[name="amount19"]').val();
		var pass	    = $('.tab-content').find("div.active").find('input[name="pass19"]').val();
       
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        }); 

        if(acc == null || acc == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Account no must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(subscriber == null || subscriber == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Number must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(amount == null || amount == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Amount must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else if(pass == null || pass == "")
        {
            $('#myModal').modal('hide');
            $('.mensahe').html('Transaction password must be filled out');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
        }
        else{
            
            
    		      
            $('.btnType19').attr('disabled',true);

    			$.ajax({
    				url:'bills_payment_send',
    				type:"post",
    				data:{btnType:btnType,biller:biller,acc:acc,subscriber:subscriber,amount:amount,pass:pass},
    				dataType:"json",
     			    success: function(data) {
    
        				//console.log(data);
        				if(data["S"] == 1) {
        				    
        				    $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-success animated fadeInLeft').removeClass('alert-danger alert-info').fadeIn().delay(8000).fadeOut();
                            $('.tab-content').find("div.active").find('input[name="acc_no19"]').val('');
                            $('.tab-content').find("div.active").find('input[name="number19"]').val('');
                            $('.tab-content').find("div.active").find('input[name="amount19"]').val('');
                            $('.tab-content').find("div.active").find('input[name="pass19"]').val('');

                            $('.secondView').show();
                            $('.firstView').hide();
                            //$('#billspayment').val(data['TN']);
							$('input[name="billspayment"]').val(data["TN"]);
        				}
        				else {
                            $('.mensahe').html(data["M"]);
                            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
    
        				}
                        $('.btnType19').removeAttr('disabled');
                        $('#myModal').modal('hide');
                    }
                
    			
    			});
    		
        }
	});
	// End Data Submission


	$('.select_biller').change(function(){
		$value = $('.select_biller').val();
		$id = $(this).find('option:selected').attr('id');
		$biller = $(this).find('option:selected').attr('biller');
		$('.lblbiller_name').html($biller);
        
        //alert($biller);
		var acclength = $('.tab-content').find("div.active").find('option:selected').attr('acclength');
		$('.acc_no1').attr('maxlength', acclength);
		$('.acc_no1').val('');
        
        $('.acc_no2').attr('maxlength', acclength);
		$('.acc_no2').val('');
        
        $('.acc_no3').attr('maxlength', acclength);
		$('.acc_no3').val('');
        
        $('.acc_no4').attr('maxlength', acclength);
		$('.acc_no4').val('');
        
        $('.acc_no5').attr('maxlength', acclength);
		$('.acc_no5').val('');
        
        $('.acc_no6').attr('maxlength', acclength);
		$('.acc_no6').val('');
        
        $('.acc_no7').attr('maxlength', acclength);
		$('.acc_no7').val('');
        
        $('.acc_no8').attr('maxlength', acclength);
		$('.acc_no8').val('');
        
        $('.acc_no9').attr('maxlength', acclength);
		$('.acc_no9').val('');    
        
        $('.acc_no10').attr('maxlength', acclength);
		$('.acc_no10').val('');
        
        $('.acc_no11').attr('maxlength', acclength);
		$('.acc_no11').val('');
        
        $('.acc_no12').attr('maxlength', acclength);
		$('.acc_no12').val('');
        
        $('.acc_no13').attr('maxlength', acclength);
		$('.acc_no13').val('');
        
        $('.acc_no14').attr('maxlength', acclength);
		$('.acc_no14').val('');   
        
        $('.acc_no15').attr('maxlength', acclength);
		$('.acc_no15').val('');
        
        $('.acc_no16').attr('maxlength', acclength);
		$('.acc_no16').val('');
        
        $('.acc_no17').attr('maxlength', acclength);
		$('.acc_no17').val('');
        
        $('.acc_no18').attr('maxlength', acclength);
		$('.acc_no18').val('');
        
        $('.acc_no19').attr('maxlength', acclength);
		$('.acc_no19').val('');
        
        
		if($id == 1) {
			$('.type_1').show();
			$('.type_2').hide();
			$('.type_3').hide();
			$('.type_4').hide();
			$('.type_5').hide();
			$('.type_6').hide();
			$('.type_7').hide();
			$('.type_8').hide();
			$('.type_9').hide();
			$('.type_10').hide();
			$('.type_11').hide();
			$('.type_12').hide();
			$('.type_13').hide();
			$('.type_14').hide();
			$('.type_15').hide();
			$('.type_16').hide();
			$('.type_17').hide();
			$('.type_18').hide();
			$('.type_19').hide();
            $('.type_20').hide();
		}
		else if($id == 2)
		{
			$('.type_1').hide();
			$('.type_2').show();
			$('.type_3').hide();
			$('.type_4').hide();
			$('.type_5').hide();
			$('.type_6').hide();
			$('.type_7').hide();
			$('.type_8').hide();
			$('.type_9').hide();
			$('.type_10').hide();
			$('.type_11').hide();
			$('.type_12').hide();
			$('.type_13').hide();
			$('.type_14').hide();
			$('.type_15').hide();
			$('.type_16').hide();
			$('.type_17').hide();
			$('.type_18').hide();
			$('.type_19').hide();
            $('.type_20').hide();
		}
		else if($id == 3)
		{
			$('.type_1').hide();
			$('.type_2').hide();
			$('.type_3').show();
			$('.type_4').hide();
			$('.type_5').hide();
			$('.type_6').hide();
			$('.type_7').hide();
			$('.type_8').hide();
			$('.type_9').hide();
			$('.type_10').hide();
			$('.type_11').hide();
			$('.type_12').hide();
			$('.type_13').hide();
			$('.type_14').hide();
			$('.type_15').hide();
			$('.type_16').hide();
			$('.type_17').hide();
			$('.type_18').hide();
			$('.type_19').hide();
            $('.type_20').hide();
		}
		else if($id == 4)
		{
			$('.type_1').hide();
			$('.type_2').hide();
			$('.type_3').hide();
			$('.type_4').show();
			$('.type_5').hide();
			$('.type_6').hide();
			$('.type_7').hide();
			$('.type_8').hide();
			$('.type_9').hide();
			$('.type_10').hide();
			$('.type_11').hide();
			$('.type_12').hide();
			$('.type_13').hide();
			$('.type_14').hide();
			$('.type_15').hide();
			$('.type_16').hide();
			$('.type_17').hide();
			$('.type_18').hide();
			$('.type_19').hide();
            $('.type_20').hide();
		}
		else if($id == 5)
		{
			$('.type_1').hide();
			$('.type_2').hide();
			$('.type_3').hide();
			$('.type_4').hide();
			$('.type_5').show();
			$('.type_6').hide();
			$('.type_7').hide();
			$('.type_8').hide();
			$('.type_9').hide();
			$('.type_10').hide();
			$('.type_11').hide();
			$('.type_12').hide();
			$('.type_13').hide();
			$('.type_14').hide();
			$('.type_15').hide();
			$('.type_16').hide();
			$('.type_17').hide();
			$('.type_18').hide();
			$('.type_19').hide();
            $('.type_20').hide();
		}
		else if($id == 6)
		{
			$('.type_1').hide();
			$('.type_2').hide();
			$('.type_3').hide();
			$('.type_4').hide();
			$('.type_5').hide();
			$('.type_6').show();
			$('.type_7').hide();
			$('.type_8').hide();
			$('.type_9').hide();
			$('.type_10').hide();
			$('.type_11').hide();
			$('.type_12').hide();
			$('.type_13').hide();
			$('.type_14').hide();
			$('.type_15').hide();
			$('.type_16').hide();
			$('.type_17').hide();
			$('.type_18').hide();
			$('.type_19').hide();
            $('.type_20').hide();
		}
		else if($id == 7)
		{
			$('.type_1').hide();
			$('.type_2').hide();
			$('.type_3').hide();
			$('.type_4').hide();
			$('.type_5').hide();
			$('.type_6').hide();
			$('.type_7').show();
			$('.type_8').hide();
			$('.type_9').hide();
			$('.type_10').hide();
			$('.type_11').hide();
			$('.type_12').hide();
			$('.type_13').hide();
			$('.type_14').hide();
			$('.type_15').hide();
			$('.type_16').hide();
			$('.type_17').hide();
			$('.type_18').hide();
			$('.type_19').hide();
            $('.type_20').hide();
		}
		else if($id == 8)
		{
			$('.type_1').hide();
			$('.type_2').hide();
			$('.type_3').hide();
			$('.type_4').hide();
			$('.type_5').hide();
			$('.type_6').hide();
			$('.type_7').hide();
			$('.type_8').show();
			$('.type_9').hide();
			$('.type_10').hide();
			$('.type_11').hide();
			$('.type_12').hide();
			$('.type_13').hide();
			$('.type_14').hide();
			$('.type_15').hide();
			$('.type_16').hide();
			$('.type_17').hide();
			$('.type_18').hide();
			$('.type_19').hide();
            $('.type_20').hide();
		}
		else if($id == 9)
		{
			$('.type_1').hide();
			$('.type_2').hide();
			$('.type_3').hide();
			$('.type_4').hide();
			$('.type_5').hide();
			$('.type_6').hide();
			$('.type_7').hide();
			$('.type_8').hide();
			$('.type_9').show();
			$('.type_10').hide();
			$('.type_11').hide();
			$('.type_12').hide();
			$('.type_13').hide();
			$('.type_14').hide();
			$('.type_15').hide();
			$('.type_16').hide();
			$('.type_17').hide();
			$('.type_18').hide();
			$('.type_19').hide();
            $('.type_20').hide();
		}
		else if($id == 10)
		{
			$('.type_1').hide();
			$('.type_2').hide();
			$('.type_3').hide();
			$('.type_4').hide();
			$('.type_5').hide();
			$('.type_6').hide();
			$('.type_7').hide();
			$('.type_8').hide();
			$('.type_9').hide();
			$('.type_10').show();
			$('.type_11').hide();
			$('.type_12').hide();
			$('.type_13').hide();
			$('.type_14').hide();
			$('.type_15').hide();
			$('.type_16').hide();
			$('.type_17').hide();
			$('.type_18').hide();
			$('.type_19').hide();
            $('.type_20').hide();
		}
		else if($id == 11)
		{
			$('.type_1').hide();
			$('.type_2').hide();
			$('.type_3').hide();
			$('.type_4').hide();
			$('.type_5').hide();
			$('.type_6').hide();
			$('.type_7').hide();
			$('.type_8').hide();
			$('.type_9').hide();
			$('.type_10').hide();
			$('.type_11').show();
			$('.type_12').hide();
			$('.type_13').hide();
			$('.type_14').hide();
			$('.type_15').hide();
			$('.type_16').hide();
			$('.type_17').hide();
			$('.type_18').hide();
			$('.type_19').hide();
            $('.type_20').hide();
		}
		else if($id == 12)
		{
			$('.type_1').hide();
			$('.type_2').hide();
			$('.type_3').hide();
			$('.type_4').hide();
			$('.type_5').hide();
			$('.type_6').hide();
			$('.type_7').hide();
			$('.type_8').hide();
			$('.type_9').hide();
			$('.type_10').hide();
			$('.type_11').hide();
			$('.type_12').show();
			$('.type_13').hide();
			$('.type_14').hide();
			$('.type_15').hide();
			$('.type_16').hide();
			$('.type_17').hide();
			$('.type_18').hide();
			$('.type_19').hide();
            $('.type_20').hide();
		}
		else if($id == 13)
		{
			$('.type_1').hide();
			$('.type_2').hide();
			$('.type_3').hide();
			$('.type_4').hide();
			$('.type_5').hide();
			$('.type_6').hide();
			$('.type_7').hide();
			$('.type_8').hide();
			$('.type_9').hide();
			$('.type_10').hide();
			$('.type_11').hide();
			$('.type_12').hide();
			$('.type_13').show();
			$('.type_14').hide();
			$('.type_15').hide();
			$('.type_16').hide();
			$('.type_17').hide();
			$('.type_18').hide();
			$('.type_19').hide();
            $('.type_20').hide();
		}
		else if($id == 14)
		{
			$('.type_1').hide();
			$('.type_2').hide();
			$('.type_3').hide();
			$('.type_4').hide();
			$('.type_5').hide();
			$('.type_6').hide();
			$('.type_7').hide();
			$('.type_8').hide();
			$('.type_9').hide();
			$('.type_10').hide();
			$('.type_11').hide();
			$('.type_12').hide();
			$('.type_13').hide();
			$('.type_14').show();
			$('.type_15').hide();
			$('.type_16').hide();
			$('.type_17').hide();
			$('.type_18').hide();
			$('.type_19').hide();
            $('.type_20').hide();
		}
		else if($id == 15)
		{
			$('.type_1').hide();
			$('.type_2').hide();
			$('.type_3').hide();
			$('.type_4').hide();
			$('.type_5').hide();
			$('.type_6').hide();
			$('.type_7').hide();
			$('.type_8').hide();
			$('.type_9').hide();
			$('.type_10').hide();
			$('.type_11').hide();
			$('.type_12').hide();
			$('.type_13').hide();
			$('.type_14').hide();
			$('.type_15').show();
			$('.type_16').hide();
			$('.type_17').hide();
			$('.type_18').hide();
			$('.type_19').hide();
            $('.type_20').hide();
		}
		else if($id == 16)
		{
			$('.type_1').hide();
			$('.type_2').hide();
			$('.type_3').hide();
			$('.type_4').hide();
			$('.type_5').hide();
			$('.type_6').hide();
			$('.type_7').hide();
			$('.type_8').hide();
			$('.type_9').hide();
			$('.type_10').hide();
			$('.type_11').hide();
			$('.type_12').hide();
			$('.type_13').hide();
			$('.type_14').hide();
			$('.type_15').hide();
			$('.type_16').show();
			$('.type_17').hide();
			$('.type_18').hide();
			$('.type_19').hide();
            $('.type_20').hide();
		}
		else if($id == 17)
		{
			$('.type_1').hide();
			$('.type_2').hide();
			$('.type_3').hide();
			$('.type_4').hide();
			$('.type_5').hide();
			$('.type_6').hide();
			$('.type_7').hide();
			$('.type_8').hide();
			$('.type_9').hide();
			$('.type_10').hide();
			$('.type_11').hide();
			$('.type_12').hide();
			$('.type_13').hide();
			$('.type_14').hide();
			$('.type_15').hide();
			$('.type_16').hide();
			$('.type_17').show();
			$('.type_18').hide();
			$('.type_19').hide();
            $('.type_20').hide();
		}
		else if($id == 18)
		{
			$('.type_1').hide();
			$('.type_2').hide();
			$('.type_3').hide();
			$('.type_4').hide();
			$('.type_5').hide();
			$('.type_6').hide();
			$('.type_7').hide();
			$('.type_8').hide();
			$('.type_9').hide();
			$('.type_10').hide();
			$('.type_11').hide();
			$('.type_12').hide();
			$('.type_13').hide();
			$('.type_14').hide();
			$('.type_15').hide();
			$('.type_16').hide();
			$('.type_17').hide();
			$('.type_18').show();
			$('.type_19').hide();
            $('.type_20').hide();
		}
		else if($id == 19)
		{
			$('.type_1').hide();
			$('.type_2').hide();
			$('.type_3').hide();
			$('.type_4').hide();
			$('.type_5').hide();
			$('.type_6').hide();
			$('.type_7').hide();
			$('.type_8').hide();
			$('.type_9').hide();
			$('.type_10').hide();
			$('.type_11').hide();
			$('.type_12').hide();
			$('.type_13').hide();
			$('.type_14').hide();
			$('.type_15').hide();
			$('.type_16').hide();
			$('.type_17').hide();
			$('.type_18').hide();
			$('.type_19').show();
            $('.type_20').hide();
		}
		else
		{
			$('.type_1').hide();
			$('.type_2').hide();
			$('.type_3').hide();
			$('.type_4').hide();
			$('.type_5').hide();
			$('.type_6').hide();
			$('.type_7').hide();
			$('.type_8').hide();
			$('.type_9').hide();
			$('.type_10').hide();
			$('.type_11').hide();
			$('.type_12').hide();
			$('.type_13').hide();
			$('.type_14').hide();
			$('.type_15').hide();
			$('.type_16').hide();
			$('.type_17').hide();
			$('.type_18').hide();
			$('.type_19').hide();
            $('.type_20').hide();
		}
		
	});

	// End Bills Payment


	// Start Change Pass 
	
// ayi-01
	// $('.btnchangelogin').click(function(){

	// 	var btn 	   = $('.btnchangelogin').val();
	// 	var curr_pass  = $('#curr_passL').val();
	// 	var new_pass   = $('#new_passL').val();
	// 	var con_pass   = $('#con_passL').val();

 //        if(curr_pass == null || curr_pass == "")
 //        {
 //            $('.mensahe').html('Enter current password');
 //            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
 //        }
 //        else if(new_pass == null || new_pass == "")
 //        {
 //            $('.mensahe').html('Enter new password password');
 //            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
 //        }
 //        else if(con_pass == null || con_pass == "")
 //        {
 //            $('.mensahe').html('Enter confirm new password');
 //            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
 //        }
 //        else
 //        {

 //            $('.mensahe').html('Processing..');
 //            $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();

 //            $('.btnchangelogin').attr('disabled',true);
 //            $.ajax({
 //                url:'change_password_ajax',
 //                type:"post",
 //                data:{btn:btn,curr_pass:curr_pass,new_pass:new_pass,con_pass:con_pass},
 //                dataType:"json",
 //                success: function(data)
 //                {

 //                    if(data["S"] == 1) {

 //                        $('.mensahe').html(data['M']);
 //                        $('.flasher').addClass('alert-success').removeClass('alert-danger alert-info').fadeIn().delay(8000);
 //                        $('.jumbotron').empty();

 //                        $('.jumbotron').append(
 //                            '<div class="form-group">'+
 //                                '<p class="animated flipInX delay025s text-center text-muted">Thank you for changing your password...</p>'+
 //                                '<p class="animated flipInX delay025s text-center text-muted">You may now login your account with new created password...</p>'+                                
 //                            '</div>'
 //                        );
 //                        $('.jumbotron').fadeIn().delay(6000).fadeOut();                           
 //                        setTimeout(function() { window.location.href = "../power"; }, 6000 );

 //                    }
 //                    else {

 //                        $('.mensahe').html(data["M"]);
 //                        $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
 //                    }

 //                    $('.alert-info').hide();
 //                    $('.btnchangelogin').removeAttr('disabled');

 //                }
 //            });
 //        }

	// });

	// $('.btnchangetransact').click(function(){

	// 	var btn 	   = $('.btnchangetransact').val();
	// 	var curr_pass  = $('#curr_passT').val();
	// 	var new_pass   = $('#new_passT').val();
	// 	var con_pass   = $('#con_passT').val();

	// 	if(curr_pass == null || curr_pass == "")
 //        {
 //            $('.mensahe').html('Enter current password');
 //            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
 //        }
 //        else if(new_pass == null || new_pass == "")
 //        {
 //            $('.mensahe').html('Enter new password password');
 //            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
 //        }
 //        else if(con_pass == null || con_pass == "")
 //        {
 //            $('.mensahe').html('Enter confirm new password');
 //            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(6000).fadeOut();
 //        }
 //        else
 //        {
 //            $('.mensahe').html('Processing..');
 //            $('.flasher').addClass('alert-info').removeClass('alert-success alert-danger animated fadeInUp fadeInLeft').show();

 //            $('.btnchangetransact').attr('disabled',true);
 //            $.ajax({
 //                url:'change_password_ajax',
 //                type:"post",
 //                data:{btn:btn,curr_pass:curr_pass,new_pass:new_pass,con_pass:con_pass},
 //                dataType:"json",
 //                success: function(data)
 //                {

 //                    if(data["S"] == 1) {

 //                        $('.mensahe').html(data['M']);
 //                        $('.flasher').addClass('alert-success').removeClass('alert-danger alert-info').fadeIn().delay(8000);
 //                        $('.jumbotron').empty();

 //                        $('.jumbotron').append(
 //                            '<div class="form-group">'+
 //                                '<p class="animated flipInX delay025s text-center text-muted">Thank you for changing your transaction password...</p>'+
 //                            '</div>'
 //                        );
 //                        $('.jumbotron').fadeIn().delay(6000).fadeOut();                           
 //                        setTimeout(function() { window.location.href = "../power"; }, 6000 );

 //                    }
 //                    else {

 //                        $('.mensahe').html(data["M"]);
 //                        $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(5000).fadeOut();
 //                    }

 //                    $('.alert-info').hide();
 //                    $('.btnchangetransact').removeAttr('disabled');

 //                }
 //            });
 //        }

		
	// });
     
  
   $('#elogsticket').click(function(){  /*DOMESTIC ETICKET*/
        $('#detailseticket').empty();
         var con = 'Passed';
        
         $.ajax({
           url:"elogsdometis",
           type:"post",
           data:{con:con},
           dataType:"json",
           success:function(data){

                if(data.length!=0){

                 $.each(data,function(field,val){
                     
                     if(val['onwardconnecting']==0){
                        var dest = val['destination'];
                     }else{
                        var dest = val['destinationConn'];
                     }

                     if(val['status']!='To Deliver'){
                        var conditionname='Re-check';
                        var values=0;
                     }else{
                        var conditionname='Get-ETicket';
                        var values=1;
                     }

                     if(val['flightNoRet']!=0){
                       var typeflight='Roundtrip';
                            if(val['airlinePNR']=='NA' || val['airlinePNRret']=='NA'){
                               var pnr = '';
                             }else{
                               var pnr = 'O - ['+val['airlinePNR']+'] /R - ['+val['airlinePNRret']+']';
                           }

                        
                        if(val['returnconnecting']==1){
                           var destreturn = ' / '+dest+'-'+val['destinationRetConn'];
                        }else{
                           var destreturn = ' / '+dest+'-'+val['destinationRet'];
                        }
                        

                     }else{
                       var typeflight='Oneway';
                           if(val['airlinePNR'] === 'NA'){
                            var pnr = '';
                           }else{
                           var pnr = '['+val['airlinePNR']+']';
                           }

                        var destreturn='';   
                     
                     }

                     if(val['status'] == 'Passed'){
                        var statflight = 'Waiting to Confirm';
                        var vbutton = '<input type="radio" name="radios" value='+val['bookingRequestID']+' class="myradio"><label for="r1">'+conditionname+'</label>';
                     }else{
                        var statflight = val['status'];
						if(statflight == 'Aborted'){
						   statflight = 'We regret to inform you that your requested booking  is auto aborted due to rate change';
						}
                        if(val['status'] == 'Cancelled' || val['status'] == 'Aborted'){
                          var vbutton='';
                        }else{
                          var vbutton = '<input type="radio" name="radios" value='+val['bookingRequestID']+' class="myradio"><label for="r1">'+conditionname+'</label>';
                        }
                     }



                      
                     $('#detailseticket').append('<tr><td>'+val['bookingRequestID']+
                        '</td><td>'+typeflight+'</td><td>'+statflight+'</td><td>'+pnr+'</td><td>'+val['source']+'-'+dest+destreturn+
                        '</td><td>'+val['dateSearch']+'</td><td><input type="hidden" class="requestvalue" value='+values+'><input type="hidden" class="bookidss" name="bookidss" value='+val['bookingRequestID']+'>'+vbutton+'</td></tr>');              
                  
                   });

                     
                    $( ".myradio" ).click( showValues );
                    $( "select" ).change( showValues );
                     showValues();
                    

                    }else{
                      alert('No Transaction');
                    }
           } 

         });   
    });
 
            function showValues() {
                    var fields = $( ".myradio" ).serializeArray();
                    $( "#resultskos" ).empty();
                    jQuery.each( fields, function( i, field ) {
                      $( "#resultskos" ).append( field.value + " " );
                    var bookingvalue = field.value;
                    var clanswer = confirm('Do you want to proceed this process?');
                    if(clanswer){ /*YES*/
                      $.ajax({
                        url:"confirmclick",
                        type:"post",
                        data:{bookingvalue:bookingvalue},
                        dataType:"json",
                        success:function(data){
                           if(data['bookingen']=='To Deliver'){
                             //$('.myrespone').append(bookingvalue);
                             window.open ('domestic_flights_eticket/'+bookingvalue+'');
                           }else{
                              alert('Status: '+data['bookingen']);
                              $('#detailseticket').empty();
                              var con = 'Passed'; 
                               
                               $.ajax({
                               url:"elogsdometis",
                               type:"post",
                               data:{con:con},
                               dataType:"json",
                               success:function(data){
                                   
                                   if(data.length!=0){

                                     $.each(data,function(field,val){
                                         
                                         if(val['onwardconnecting']==0){
                                            var dest = val['destination'];
                                         }else{
                                            var dest = val['destinationConn'];
                                         }

                                         if(val['status']!='To Deliver'){
                                            var conditionname='Re-check';
                                            var values=0;
                                         }else{
                                            var conditionname='Get-ETicket';
                                            var values=1;
                                         }

                                         if(val['flightNoRet']!=0){
                                           var typeflight='Roundtrip';
                                                if(val['airlinePNR']=='NA' || val['airlinePNRret']=='NA'){
                                                   var pnr = '';
                                                 }else{
                                                   var pnr = 'O - ['+val['airlinePNR']+'] /R - ['+val['airlinePNRret']+']';
                                               }

                                            
                                            if(val['returnconnecting']==1){
                                               var destreturn = ' / '+dest+'-'+val['destinationRetConn'];
                                            }else{
                                               var destreturn = ' / '+dest+'-'+val['destinationRet'];
                                            }
                                            

                                         }else{
                                           var typeflight='Oneway';
                                               if(val['airlinePNR'] === 'NA'){
                                                var pnr = '';
                                               }else{
                                               var pnr = '['+val['airlinePNR']+']';
                                               }

                                            var destreturn='';   
                                         
                                         }

                                         if(val['status'] == 'Passed'){
                                            var statflight = 'Waiting to Confirm';
                                            var vbutton = '<input type="radio" name="radios" value='+val['bookingRequestID']+' class="myradio"><label for="r1">'+conditionname+'</label>';
                                         }else{
                                            var statflight = val['status'];
											
											if(statflight == 'Aborted'){
											   statflight = 'We regret to inform you that your requested booking  is auto aborted due to rate change';
											}
											
                                            if(val['status'] == 'Cancelled' || val['status'] == 'Aborted'){
                                              var vbutton='';
                                            }else{
                                              var vbutton = '<input type="radio" name="radios" value='+val['bookingRequestID']+' class="myradio"><label for="r1">'+conditionname+'</label>';
                                            }
                                         }
                                          
                                         $('#detailseticket').append('<tr><td>'+val['bookingRequestID']+
                                            '</td><td>'+typeflight+'</td><td>'+statflight+'</td><td>'+pnr+'</td><td>'+val['source']+'-'+dest+dest+destreturn+
                                            '</td><td>'+val['dateSearch']+'</td><td><input type="hidden" class="requestvalue" value='+values+'><input type="hidden" class="bookidss" name="bookidss" value='+val['bookingRequestID']+'>'+vbutton+'</td></tr>');              
                                      
                                       });

                                         
                                        $( ".myradio" ).click( showValues );
                                        $( "select" ).change( showValues );
                                         showValues();
                                        

                                        }else{
                                          alert('No Transaction');
                                        }


                               }

                             });





                           }
                       }

                      });

                    }else{/*NO*/
                      //window.location.assign = (data);
                      // $('.mydesplay').hide();
                      // SomPluginCalledHavingAjaxRequest()
                      // var timer = SetInterval(function(){
                      //     if($.active==0){
                      //        clearInterval(timer);
                      //        window.location.href= 'http://localhost/NEW_SYSTEMUPDATE3/trunk/upsxpress_new/ecash/domestic_flights';
                      // }
                      // },1000);

                    

                    }


                    });
                  }

  

  $('#elogsticketint').click(function(){ /*INTERNATIONAL*/
        $('#detailseticketint').empty();
         var con = 'Passed';
         $.ajax({
           url:"elogsdometisint",
           type:"post",
           data:{con:con},
           dataType:"json",
           success:function(data){

                if(data.length!=0){

                 $.each(data,function(field,val){
                     
                     if(val['onwardconnecting']==0){
                        var dest = val['destination'];
                     }else{
                        var dest = val['destinationConn'];
                     }

                     if(val['status']!='To Deliver'){
                        var conditionname='Re-check';
                        var values=0;
                     }else{
                        var conditionname='Get-ETicket';
                        var values=1;
                     }
                   

                      if(val['status'] == '0' || val['status'] == 'Passed'){
                        var statmsgsd ='Waiting To Confirm'
                      }else if(val['status'] == 'Aborted' || val['status'] == 'ABORTED'){
                        var statmsgsd ='Aborted';
                      }else if(val['status'] == 'Cancel' || val['status'] == 'CANCEL'){
                        var statmsgsd ='Cancel';
                      }else{
                        var statmsgsd ='To Deliver';
                      } 

 
                     
                      
                     $('#detailseticketint').append('<tr><td>'+val['bookingRequestID']+
                        '</td><td>'+statmsgsd+'</td><td>'+val['source']+'-'+dest+
                        '</td><td>'+val['dateSearch']+'</td><td><input type="hidden" class="requestvalue" value='+values+'><input type="hidden" class="bookidss" name="bookidss" value='+val['bookingRequestID']+'><input type="radio" name="radiosint" value='+val['bookingRequestID']+' class="myradioint"><label for="r1">'+conditionname+'</label></td></tr>');              
                    });
           
           $( ".myradioint" ).click( showValuesint );
                    $( "select" ).change( showValuesint );
                     showValuesint();
                    

                    }else{
                      alert('No Transaction');
                    }
           } 

         });   
    });


function showValuesint(){
                    var fields = $( ".myradioint" ).serializeArray();
                    $( "#resultskos" ).empty();
                    jQuery.each( fields, function( i, field ) {
                      $( "#resultskos" ).append( field.value + " " );
                    var bookingvalue = field.value;
                    var clanswer = confirm('Do you want to proceed this process?');
                    if(clanswer){ /*YES*/
                      $.ajax({
                        url:"confirmclickint",
                        type:"post",
                        data:{bookingvalue:bookingvalue},
                        dataType:"json",
                        success:function(data){

                           if(data['bookingen']=='To Deliver'){
                               // Send via email address
                               
                               $.ajax({
                                url:"emailintticket",
                                type:"post",
                                data:{bookingvalue:bookingvalue},
                                dataType:"json",
                                success:function(data){
                                    if(data['msgsentosd']==1){
                                        alert('Your itinerary ticket has been confirm and send, Please visit your email account \"'+data['emailaddress']+'\"');
                                    }else{
                                        alert('Failed to send email, due to detect a slow internet connection');
                                    }
                                }
                               });
                             


                             //window.open('international_flights_eticket/'+bookingvalue+'');
                           }else{
                              if(data['bookingen'] == '0' || data['bookingen'] == 'Passed'){
                                var statmsg ='Waiting To Confirm'
                              }else if(data['bookingen'] == 'Aborted' || data['bookingen'] == 'ABORTED'){
                                var statmsg ='Aborted';
                              }else if(data['bookingen'] == 'Cancel' || data['bookingen'] == 'CANCEL'){
                                var statmsg ='Cancel';
                              }else{
                                var statmsg ='To Deliver';
                              } 

                              alert('Status: '+statmsg);
                              $('#detailseticketint').empty();
                              
                              var con = 'Passed';
                              $.ajax({
                               url:"elogsdometisint",
                               type:"post",
                               data:{con:con},
                               dataType:"json",
                               success:function(data){
                                if(data.length!=0){
                                  $.each(data,function(field,val){
                     
                                     if(val['onwardconnecting']==0){
                                        var dest = val['destination'];
                                     }else{
                                        var dest = val['destinationConn'];
                                     }

                                     if(val['status']!='To Deliver'){
                                        var conditionname='Re-check';
                                        var values=0;
                                     }else{
                                        var conditionname='Get-ETicket';
                                        var values=1;
                                     }

                                     if(val['status'] == '0' || val['status'] == 'Passed'){
                                        var statmsgsd ='Waiting To Confirm'
                                      }else if(val['status'] == 'Aborted' || val['status'] == 'ABORTED'){
                                        var statmsgsd ='Aborted';
                                      }else if(val['status'] == 'Cancel' || val['status'] == 'CANCEL'){
                                        var statmsgsd ='Cancel';
                                      }else{
                                        var statmsgsd ='To Deliver';
                                      } 
                                      
                                     $('#detailseticketint').append('<tr><td>'+val['bookingRequestID']+
                                        '</td><td>'+statmsgsd+'</td><td>'+val['source']+'-'+dest+
                                        '</td><td>'+val['dateSearch']+'</td><td><input type="hidden" class="requestvalue" value='+values+'><input type="hidden" class="bookidss" name="bookidss" value='+val['bookingRequestID']+'><input type="radio" name="radiosint" value='+val['bookingRequestID']+' class="myradioint"><label for="r1">'+conditionname+'</label></td></tr>');              
                                    });
                           
                                    $( ".myradioint" ).click( showValuesint );
                                    $( "select" ).change( showValuesint );
                                     showValuesint();

                                      }else{
                                          alert('No Transaction');
                                  }

                               }

                            });

                              
                           }
                       }

                      });

                    }else{/*NO*/
                     
                    }


                    });
                  }      

  

    /*MONEYGRAM AJAX*/

   $('.btnpayoutMoneygram_click').click(function(){ /*MONEYGRAM UPON CHECKING REFERENCE NUMBER*/  
        var refrence = $('#moneygramRef').val();
        if(refrence==''){
            // alert('Please Input Reference Number');
            $('.mensahe').html('Enter Reference Number');
            $('.flasher').addClass('alert-danger animated fadeInUp').removeClass('alert-info alert-success').fadeIn().delay(2000).fadeOut();

        }else{

        $.ajax({
          url:"ecash_moneygram",
          type:"post",
          data:{refrence:refrence},
          dataType:"json",
          success:function(data){
             // alert(data['remark']);

              if(data['status'] == 0){
                alert('Status: "'+data['remark']+'" \n Please try to check later');
                $('.check_referencediv').hide();
                $('.check_logo').hide();
                $('.confirm_ticketAA').show();
              }else if(data['status'] == 1){
                  $('.confirm_ticketAA').hide();
                  var answer = confirm('Do you want to proceed?');
                  if(answer){  //yes anwer
                    
                    $('.check_referencediv').hide();
                    $('.check_logo').hide();
                    $('.insert_infodiv').show();
                    
                  if(data['amount'] <= 4999){
                       var charges=20;
                       var payout_amount = (data['amount']-20); 
                  }else if(data['amount'] >= 5000 && data['amount'] <= 9999){
                       var charges=50;
                       var payout_amount = (data['amount']-50);
                   }else if(data['amount'] >= 10000 && data['amount'] <= 39999){
                       var charges=100;
                       var payout_amount = (data['amount']-100);
                   }else{
                      var charges=150;
                      var payout_amount = (data['amount']-150);
                   }
                  

                    $('.mg_information').append('<tr><td>Reference Number:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td> '+data['reference']+
                      '</td></tr><tr><td>Remarks:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td> '+data['remark']+
                      '</td></tr><tr><td>Currency:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td> '+data['curreny']+
                      '</td></tr><tr><td>Amount:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td> '+data['amount']+
                      '</td></tr><tr><td>Charge:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td> '+charges+
                      '</td></tr><tr><td>Payout Amount:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td> '+payout_amount+
                      '</td></tr><tr><td>Remittance:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td> '+data['remit_partner']+
                      '</td></tr><tr><td>Sender Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td> '+data['sender_name']+
                      '</td></tr><tr><td>Beneficiary Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td> '+data['benef_name']+
                      '</td></tr><tr><td>Origin Address:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td> '+data['origin_name']+
                      '</td></tr><tr><td>Transaction Date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td> '+data['transaction_date']+'<input type="hidden" name="prefno" class="prefno" value='+data['reference']+
                      '><input type="hidden" name="pbenefName" class="pbenefName" value='+data['bbenef_name']+'><input type="hidden" name="pbenefMname" class="pbenefMname" value='+data['bbenem_name']+
                      '><input type="hidden" name="pbenefLname" class="pbenefLname" value='+data['bbenel_name']+'><input type="hidden" name="pamount" class="pamount" value='+data['amount']+
                      '><input type="hidden" name="pcharge" class="pcharge" value='+charges+'><input type="hidden" name="pcurrency" class="pcurrency" value='+data['curreny']+'></td></tr>');
                  }else{  //no answer
                        
                  }

                  
               }else if(data['status'] == 2){
                   $('.check_referencediv').hide();
                   $('.check_logo').hide();
                   $('.confirm_ticketAA').hide();
                   alert('Status: "'+data['remark']+'"');
               }else if(data['status'] == 3){
                   $('.check_referencediv').hide();
                   $('.check_logo').hide();
                   $('.confirm_ticketAA').hide();
                   alert('Status: "'+data['remark']+'"');
               }else if(data['status'] == 4){
                   $('.check_referencediv').hide();
                   $('.check_logo').hide();
                   $('.confirm_ticketAA').hide();
                   alert('Status: "'+data['remark']+'"');
               }

          }


        });


     }


   });


  
  $('.payoutmgbutton').click(function(){
     
     var typeid = $('.pidtype').val();
     var idnumber = $('.pidnumber').val();
     var mobilenumber = $('.pmobilenumber').val();
     var address = $('.paddress').val();

     var vrefno = $('.prefno').val();
     var vbenefName = $('.pbenefName').val();
     var vbenefMname = $('.pbenefMname').val();
     var vbenefLname = $('.pbenefLname').val();
     var vamount = $('.pamount').val();
     var vcharge = $('.pcharge').val();
     var vcurrency = $('.pcurrency').val();
     


     if(typeid == 'none'){
        alert('Please choice your type of ID');
     }else{
        if(idnumber == '' || mobilenumber == '' || address == ''){
              alert('Please complete the input form'); 
        }else{ 
 
               $.ajax({
                
               url:"ecash_moneygram_topayout",
               type:"post",
               data:{typeid:typeid,idnumber:idnumber,mobilenumber:mobilenumber,address:address,vrefno:vrefno,vbenefName:vbenefName,vbenefMname:vbenefMname,vbenefLname:vbenefLname,vamount:vamount,vcharge:vcharge,vcurrency:vcurrency},
               dataType:"json",
               success:function(data){
                 
                  if(data['status']==0){
                    alert('Status: "'+data['remarks']+'"'); //OTHER FACILITIES
                    $('.insert_infodiv').hide();
                    $('.confirm_ticket').show();
                  }else if(data['status']==1){
                    $('.confirm_ticket').hide();
                     window.open ('moneygram_eticket/'+vrefno+'');
                  }else if(data['status']==2){
                     $('.confirm_ticket').hide();
                    alert('Status: "'+data['remarks']+'"');
                  }else if(data['status']==3){
                     $('.confirm_ticket').hide();
                    alert('Status: "'+data['remarks']+'"');
                  }else if(data['status']==4){
                     $('.confirm_ticket').hide();
                    alert('Status: "'+data['remarks']+'"');
                  }
               }


              });

        }
     

     }

  });
  
  
  //MALAYAN INSURANCE

 $('.pick_policy').change(function(){
    var policy = $('.pick_policy').val();
    $('.policy_details_u').empty();
    $('.input_emform').hide();
    $('.input_confirm').hide();
    $('.malayan_message').empty();
    
    if(policy == 0){
      alert('Please Choose Your Desired Policy');
    }else if(policy == 1){
      $('.input_emform').show();
      $('.policy_details_u').append('<tr><td style="font-weight:bold;color:black;">Coverage</td><td style="font-weight:bold;color:black;padding-left:30px;">Limits</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>Accident Death, Dismemberment &/or Disablment</td><td style="padding-left:30px;">?100,000</td></tr><tr><td>Burial Assistance (Due to Accident Death)</td><td style="padding-left:30px;">?10,000</td></tr><tr><td>Premium</td><td style="padding-left:30px;">?75.00</td></tr><tr><td>Period of Cover</td><td style="padding-left:30px;">1 (Year)</td></tr>'); 
    }else if(policy == 2){
      $('.input_emform').show();
      $('.policy_details_u').append('<tr><td style="font-weight:bold;color:black;">Coverage</td><td style="font-weight:bold;color:black;padding-left:30px;">Limits</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>Accident Death, Dismemberment &/or Disablment</td><td style="padding-left:30px;">?60,000</td></tr><tr><td>Burial Assistance (Due to Accident Death)</td><td style="padding-left:30px;">?6,000</td></tr><tr><td>Premium</td><td style="padding-left:30px;">?55.00</td></tr><tr><td>Period of Cover</td><td style="padding-left:30px;">1 (Year)</td></tr>'); 
    }else if(policy == 3){
      $('.input_emform').show();
      $('.policy_details_u').append('<tr><td style="font-weight:bold;color:black;">Coverage</td><td style="font-weight:bold;color:black;padding-left:30px;">Limits</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>Accident Death, Dismemberment &/or Disablment</td><td style="padding-left:30px;">?40,000</td></tr><tr><td>Burial Assistance (Due to Accident Death)</td><td style="padding-left:30px;">?4,000</td></tr><tr><td>Premium</td><td style="padding-left:30px;">?45.00</td></tr><tr><td>Period of Cover</td><td style="padding-left:30px;">1 (Year)</td></tr>'); 
    }else{
      $('.input_emform').show();
      $('.policy_details_u').append('<tr><td style="font-weight:bold;color:black;">Coverage</td><td style="font-weight:bold;color:black;padding-left:30px;">Limits</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>Accident Death, Dismemberment &/or Disablment</td><td style="padding-left:30px;">?100,000</td></tr><tr><td>Burial Assistance (Due to Accident Death)</td><td style="padding-left:30px;">?10,000</td></tr><tr><td>Premium</td><td style="padding-left:30px;">?50.00</td></tr><tr><td>Period of Cover</td><td style="padding-left:30px;">6 (Month)</td></tr>'); 
    }

 });

 

 $('.btnmalayan').click(function(){
  
  $('.malayan_message').empty();

  var policy = $('.pick_policy').val();
  
  var afname = $('#mi_fname').val();
  var ami = $('#mi_mname').val();
  var alname = $('#mi_lname').val();

  var bfname = $('#mi_bfname').val();
  var bmi = $('#mi_bmname').val();
  var blname = $('#mi_blname').val();

  var adob = $('#mi_dob').val();
  var aaccu = $('#mi_occup').val();
  var memail = $('#mi_email').val();

  if(afname == '' || ami =='' || alname == '' || bfname =='' || bmi =='' || blname == '' || adob == '' || aaccu =='' || memail == ''){
    alert('Please complete the information details below...');
  }else{ //passing all requirement
    
   $('.btnmalayan').hide();
   $('.loading_icon').show();
    $.ajax({
      url:"malayan_submitpro",
      type:"post",
      data:{policy:policy,afname:afname,ami:ami,alname:alname,bfname:bfname,bmi:bmi,blname:blname,adob:adob,aaccu:aaccu,memail:memail},
      dataType:"json",
      success:function(data){ //value='+data['errmsg']+'
        
          if(data['error'] == 0){
             $('.inpthide').append('<input type="hidden" name="coc" class="cocget" value="'+data['coc']+'" >');
             $('.input_emform').hide();
             $('.policy_details_u').empty();
             $('.input_confirm_success').show();
             $('.ploicydrop').hide();
             $('.malayan_message').hide();
             $('.loading_icon').hide();
             $('.btnmalayan').hide();

          }else{
             $('.input_emform').hide();
             $('.policy_details_u').empty();
             $('.input_confirm').show();
             $('.malayan_message').append(data['errmsg']);
             $('.loading_icon').hide();
             $('.ploicydrop').hide();
             $('.btnmalayan').hide(); 
          }

     

      }
    
    });
  

  }

}); 


$('.filbtnmalayan').click(function(){
   
     window.location.href = "malayan_insurance"; //function name in controller..
}); 


$('.getbtnmalayan').click(function(){
   var coc = $('.cocget').val();
   $.ajax({
    url:'malayan_cocertificate',
    type:'post',
    data:{coc:coc},
    dataType:'json',
    success:function(data){
        
        if(data['mlycodesend']==1){
             
             alert('Malayan Insurance Successfully Send, Please Check Email Address'); 
             var urlmalayan = $('.urlmly').val();
             window.location.assign(urlmalayan+'ecash/malayan_insurance');
             
        }else{

             alert('Unsuccess Send Malayan Insurance. Please Contact our CSR Agent');
             var urlmalayan = $('.urlmly').val();
             window.location.assign(urlmalayan+'ecash/malayan_insurance');

        }

    }

   }); 
   //window.open ('malayan_cocertificate/'+coc+'');

}); 

  

	// End Change Pass    
  
 
    
    
});




function TIMEOUTAIR0(){
 var myVar;
 clearTimeout(myVar);
 myVar = setTimeout(function(){
 alert("Your Booking Session has been expired");
 location.href = "domestic_flights";
 
 },240000);

}