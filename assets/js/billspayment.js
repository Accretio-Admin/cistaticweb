

	//$("#modulus11").on('click',function(e){
	// function myFunction(){  
	// 	$("#validateCheckdigit #inputAccountxt").css('border', '1px solid #ccc');
	// 		var checkdigitvalue = $("#inputAccountxt").val();
			//console.log(checkdigitvalue.substring(9));

			// waitingDialog.show('Validating details. Please wait..', {dialogSize: 'md', progressType: 'primary'});

			//************NORKIS**********
			//var perdeigit = new_value.match(/.{1}/g);
			//var perdeigit = new_value.slice(0,-1);
			//console.log(perdeigit);
			//var text = [];
			// var startx = new_value.length -1,
			// starty = 1, 
			// endy = new_value.length -1; 
			// for(startx;startx <= perdeigit.length; startx++){
			//   for(starty; starty <= endy; starty++){ 
			// 	if(starty == 6){
			//         console.log("It reach five<br>"+perdeigit[starty-1]);
			//         continue;
			//     }
			//   	//if(startx >= 2){
			//    console.log(starty+'***'+perdeigit[starty-1]); 
			// 	//text.push(parseInt(startx)+'***'+parseInt(perdeigit[starty]));
			//    startx--;
			// 	// }
			//  }

			// }
			//*******************************************

			//************ASIALINK & FINASWIDE**********
			// var	new_value = checkdigitvalue.replace(/52|53|541|542|543|544/gi, '');
			// console.log(new_value);
			// var perdeigit = new_value.slice(0,-1);
			// var i;
			// var y = 2;
			// var sum = 0;
			// for (i = perdeigit.length-1; i > -1; i--) {
			//     //text.push(parseInt(perdeigit[i])*parseInt(y));
			//     sum += parseInt(perdeigit[i])*parseInt(y);
			//     y++;
			//     if(y == 8){
			//     var y = 2;
			//     }
			// }
			// console.log(sum);
		    //*******************************************

		// 	var sum = 0;
		// 	for(var i=0; i<text.length; i++)
		// 	    sum += text[i];
		// 		console.log(sum);

			// var modulo11 = sum%11;
			// console.log(modulo11);

		// 	if(modulo11 == 1){
		// 		waitingDialog.hide();
		// 		console.log('failed. try again');
  //          		$("#alertDynammic").css('display','block');
  //   			$("#alertDynammic").addClass("alert alert-danger col-md-12 text-error alert-dismissable");
  //   			$("#alertDynammic").html("<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + 'Invalid Account Number.');
		// 			$("#alertDynammic").fadeTo(6000, 1000).slideUp(1000, function(){
		// 			  $("#alertDynammic").slideUp(1000);
		// 			  $("#alertDynammic").removeClass();
		// 			});
		// 		$("#validateCheckdigit #inputAccountxt").focus();
		// 		$("#validateCheckdigit #inputAccountxt").css('border', '2px solid red');
		// 	}else if(modulo11 == 0){
		// 		waitingDialog.hide();
		// 		console.log('self check digit 0');
  //          		$("#alertDynammic").css('display','block');
  //   			$("#alertDynammic").addClass("alert alert-danger col-md-12 text-error alert-dismissable");
  //   			$("#alertDynammic").html("<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + 'Invalid Account Number.');
		// 			$("#alertDynammic").fadeTo(6000, 1000).slideUp(1000, function(){
		// 			  $("#alertDynammic").slideUp(1000);
		// 			  $("#alertDynammic").removeClass();
		// 			});
		// 		$("#validateCheckdigit #inputAccountxt").focus();
		// 		$("#validateCheckdigit #inputAccountxt").css('border', '2px solid red');
		// 	} else{
		// 		var otherwise = (11 - modulo11);
				
		// 		if(otherwise == checkdigitvalue.substring(9)){
		// 			setTimeout(function(){
		// 				waitingDialog.hide();
		// 				console.log(otherwise+'is valid');
					      
		// 			      var biller = $('#selBiller option:selected').data('name');
		// 			      var billerNo = $('#selBiller option:selected').val();
		// 			      var acctNo = $("#inputAccountxt").val();
		// 			      var acctName = $(".inputSubscriberName").val();
		// 			      var amount = $(".inputAmount").val();
		// 			      var payor = $("#inputSem").val();
		// 			      var payorAddress = $("#inputCourse").val();
		// 			      var mobile = $("#inputMobileNo").val();
					      
		// 			      $('#myModal25 .idBiller').html(biller);
		// 			      $('#myModal25 .inputBiller').val(billerNo);
		// 			      $('#myModal25 .idAcctNo').html(acctNo);
		// 			      $('#myModal25 .inputAccountNumber').val(acctNo);
		// 			      $('#myModal25 .idAcctName').html(acctName);
		// 			      $('#myModal25 .inputSubscriberName').val(acctName);
		// 			      $('#myModal25 .idAmount').html(amount);
		// 			      $('#myModal25 .inputAmount').val(amount);

		// 			      $('#myModal25 .idPayor').html(payor);  
		// 			      $('#myModal25 .inputSem').val(payor); 
		// 			      $('#myModal25 .idPayorAddress').html(payorAddress);  
		// 			      $('#myModal25 .inputCourse').val(payorAddress); 
		// 			      $('#myModal25 .idMobileNo').html(mobile);  
		// 			      $('#myModal25 .inputMobileNo').val(mobile);       
		// 				  $('#myModal25').modal('show'); 
		// 			}, 5000);

		// 		} else{
		// 			waitingDialog.hide();
		// 			console.log(otherwise+'is invalid');
	 //           		$("#alertDynammic").css('display','block');
	 //    			$("#alertDynammic").addClass("alert alert-danger col-md-12 text-error alert-dismissable");
	 //    			$("#alertDynammic").html("<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + 'Invalid Account Number.');
		// 				$("#alertDynammic").fadeTo(6000, 1000).slideUp(1000, function(){
		// 				  $("#alertDynammic").slideUp(1000);
		// 				  $("#alertDynammic").removeClass();
		// 				});
		// 			$("#validateCheckdigit #inputAccountNumber").focus();
		// 			$("#validateCheckdigit #inputAccountNumber").css('border', '2px solid red');
		// 		}
		// 	}

	//};

	$("#validateCheckdigit").on('submit',function(e){
		waitingDialog.show('Validating details. Please wait..', {dialogSize: 'md', progressType: 'primary'});
		e.preventDefault();
		var biller = $('#selBiller').children('option:selected').val();
		var accountno = $("#inputAccountxt").val();
		
		var parameters = {accountno:accountno,biller:biller};
//console.log(parameters);

			$.ajax({
		        url: 'checkdigit11',
		        type: "POST",
		        data: parameters,
		        success: function(data){
		        	var jsondata = JSON.parse(data);
		        	//console.log(data);
		        	if(jsondata.S == 1){
		        		waitingDialog.hide();
					      var biller = $('#selBiller option:selected').data('name');
					      var billerNo = $('#selBiller option:selected').val();
					      var acctNo = accountno;
					      var acctName = $("#divAcctName28 .inputSubscriberName").val();
					      var amount = $("#validateCheckdigit .inputAmount").val();
					      var payor = $("#selSem").val();
					      var payorAddress = $("#selCourse").val();
					      var mobile = $("#validateCheckdigit #inputMobile").val();
					      
					      $('#myModal28 .idBiller').html(biller);
					      $('#myModal28 .inputBiller').val(billerNo);
					      $('#myModal28 .idAcctNo').html(acctNo);
					      $('#myModal28 .inputAccountNumber').val(acctNo);
					      $('#myModal28 .idAcctName').html(acctName);
					      $('#myModal28 .inputSubscriberName').val(acctName);
					      $('#myModal28 .idAmount').html(amount);
					      $('#myModal28 .inputAmount').val(amount);

					      $('#myModal28 .idPayor').html(payor);  
					      $('#myModal28 .selSem').val(payor); 
					      $('#myModal28 .idPayorAddress').html(payorAddress);  
					      $('#myModal28 .selCourse').val(payorAddress); 
					      $('#myModal28 .idMobileNo').html(mobile);  
					      $('#myModal28 .inputMobile').val(mobile);       
						$('#myModal28').modal('show'); 
		        	} else{
						waitingDialog.hide();
		           		$("#alertDynammic").css('display','block');
		    			$("#alertDynammic").addClass("alert alert-danger col-md-12 text-error alert-dismissable");
		    			$("#alertDynammic").html("<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + jsondata.M);
							$("#alertDynammic").fadeTo(6000, 1000).slideUp(1000, function(){
							  $("#alertDynammic").slideUp(1000);
							  $("#alertDynammic").removeClass();
							});
						$("#validateCheckdigit #inputAccountNumber").focus();
						$("#validateCheckdigit #inputAccountNumber").css('border', '2px solid red');
		        	}
		        }

		   		});

	});



    $('#frmMCWDvalidation').on('submit', function(){
	    var showthis = $("#btnSubmit").val();
	    //alert(showthis);
	    if(showthis == 1){
	      	waitingDialog.show('Please wait..', {dialogSize: 'sm', progressType: 'primary'});
			// setTimeout(function(){
			// waitingDialog.hide();	
			// }, 5000);
		}else{
	      	waitingDialog.show('Validating details. Please wait..', {dialogSize: 'sm', progressType: 'primary'});
			// setTimeout(function(){
			// waitingDialog.hide();	
			// }, 2000);
		}
    });

    $('#frmMCWDcheck').on('submit', function(){
      	waitingDialog.show('Validating details. Please wait..', {dialogSize: 'sm', progressType: 'primary'});
		// setTimeout(function(){
		// waitingDialog.hide();	
		// }, 5000);
    });

    $('#inputMobileno').on('keyup keypress', function() {
    	var mobLength = $("#inputMobileno").val().length;
    	if(mobLength > 10){
	    	$("#btnRegMobile").prop("disabled",false);
    	} else{
    		$("#btnRegMobile").prop("disabled",true);
    	}
    });

  	$("#btnRegMobile").on('click',function(){
  		var mobileno = $('#inputMobileno').val();
  		$('#regMobileno').val(mobileno);
      $("#btnMobilenoReg").click();
    });

    $("#btnMobilenoReg").on('click', function() {
    	$(".pleaseWait11").css('display','block');
    	$("#btnRegMobile").prop("disabled",true);
    	var mob = $("#regMobileno").val();
    	//console.log(mob);

		var parameters = {mobileno:mob};

			$.ajax({
		        url: 'register_mobileno',
		        type: "POST",
		        data: parameters,
		        success: function(data){
		        	var jsondata = JSON.parse(data);
		        	//console.log(data);
		        	if(jsondata.S == 1){
		        		$(".pleaseWait11").css('display','none');
		           		$("#alertDynammic").css('display','block');
		    			$("#alertDynammic").addClass("alert alert-success col-md-12 text-error alert-dismissable");
		    			$("#alertDynammic").html("<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + jsondata.M);
							$("#alertDynammic").fadeTo(6000, 1000).slideUp(1000, function(){
							  $("#alertDynammic").slideUp(1000);
							  $("#alertDynammic").removeClass();
							});
		        		$("#VCodemobile").prop('disabled',false);
		        		$("#btnRegMobile").prop("disabled",false);
		        		$("#VCodemobile").val("");
		        		$("#VCodemobile").focus();
		        	}else{
		        		$(".pleaseWait11").css('display','none');
		           		$("#alertDynammic").css('display','block');
		    			$("#alertDynammic").addClass("alert alert-danger col-md-12 text-error alert-dismissable");
		    			$("#alertDynammic").html("<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + jsondata.M);
							$("#alertDynammic").fadeTo(6000, 1000).slideUp(1000, function(){
							  $("#alertDynammic").slideUp(1000);
							  $("#alertDynammic").removeClass();
							});
		        		$("#btnRegMobile").prop("disabled",false);
		        	}

		     	}
		    });
    });

    $('#VCodemobile').on('keyup keypress', function() {

    	var vcodeLength = $("#VCodemobile").val().length;
    	if(vcodeLength > 7){
    		//console.log(vcodeLength);
    		$(".pleaseWait22").css('display','block');
	    	$("#btnRegMobile").prop("disabled",true);
	    	var mob = $("#inputMobileno").val();
	    	var vcodemob = $("#VCodemobile").val();
	    	var parameters = {code:vcodemob,mobileno:mob};
	    	//console.log(parameters);
			$.ajax({
		        url: 'verify_register_mobileno',
		        type: "POST",
		        data: parameters,
		        success: function(data){
		        	var jsondata = JSON.parse(data);
		        	//console.log(data);
		        	if(jsondata.S == 1){
		        		$(".pleaseWait22").css('display','none');
		           		$("#alertDynammic").css('display','block');
		    			$("#alertDynammic").addClass("alert alert-success col-md-12 text-error alert-dismissable");
		    			$("#alertDynammic").html("<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + jsondata.M);
							$("#alertDynammic").fadeTo(6000, 1000).slideUp(1000, function(){
							  $("#alertDynammic").slideUp(1000);
							  $("#alertDynammic").removeClass();
							});
		        		$("#btnRegMobile").prop("disabled",false);
		        		$("#VCodemobile").prop('readonly',true);
		        		$("#selBalance").focus();
		        	}else{
		        		$(".pleaseWait22").css('display','none');
		           		$("#alertDynammic").css('display','block');
		    			$("#alertDynammic").addClass("alert alert-danger col-md-12 text-error alert-dismissable");
		    			$("#alertDynammic").html("<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + jsondata.M);
							$("#alertDynammic").fadeTo(6000, 1000).slideUp(1000, function(){
							  $("#alertDynammic").slideUp(1000);
							  $("#alertDynammic").removeClass();
							});
		        		$("#btnRegMobile").prop("disabled",false);
		        		$("#VCodemobile").val("");
		        		$("#inputMobileno").focus();
		        	}

		     	}
		    });

    	} else{
    		$(".pleaseWait22").css('display','none');
    	}

    });

    $(':text, textarea').on('keyup keypress', function() {
    	if($('#selBalance').val().length != 0 && $('#consumer_code').val().length != 0 && $('#inputSubscriberName').val().length != 0 && $('#ClientAddress').val().length != 0 && $('#inputMobileno').val().length != 0 && $('#VCodemobile').val().length != 0){
    		$("#btnSubmit").prop("disabled",false);
    	} else{
    		//console.log('Empty');
    		$("#btnSubmit").prop("disabled",true);
    	}
    });

    $(':password').on('keyup keypress', function() {
    	if($('#inputTpass').val().length != 0){
    		$("#btnSubmit").prop("disabled",false);
    	} else{
    		console.log('Empty');
			$("#btnSubmit").prop("disabled",true);
    	}
    });
