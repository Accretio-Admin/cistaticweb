
var images_url = "https://upsexpress.com.ph";

$(document).ready(function(){
	$('#inputAmount').keyup(function() {
	                var value=$(this).val().replace(/[^0-9.,]*/g, '');
	                value=value.replace(/\.{2,}/g, '.');
	                value=value.replace(/\.,/g, ',');
	                value=value.replace(/\,\./g, ',');
	                value=value.replace(/\,{2,}/g, ',');
	                value=value.replace(/\.[0-9]+\./g, '.');
	                $(this).val(value)
	        
	});
});

//MALAYAN


$(document).ready(function(){
	$('#selInsurance').change(function(){
		$("#malayanNote").css('display','block');
		var mnote = $(this).children('option:selected').data('desc'); // select attribute (data-desc)
		//alert(mnote);

		if(mnote == 1){
			document.getElementById("note1").innerHTML = "100,000";
			document.getElementById("note2").innerHTML = "10,000";
			document.getElementById("note3").innerHTML = "75.00";
			document.getElementById("note4").innerHTML = "1 (Year)";	
		 }
		else if(mnote == 2){
			document.getElementById("note1").innerHTML = "60,000";
			document.getElementById("note2").innerHTML = "6,000";
			document.getElementById("note3").innerHTML = "55.00";
			document.getElementById("note4").innerHTML = "1 (Year)";
		 }
		 else if(mnote == 3){
			document.getElementById("note1").innerHTML = "40,000";
			document.getElementById("note2").innerHTML = "4,000";
			document.getElementById("note3").innerHTML = "45.00";
			document.getElementById("note4").innerHTML = "1 (Year)";
		 }
		 else if(mnote == 4){
			document.getElementById("note1").innerHTML = "100,000";
			document.getElementById("note2").innerHTML = "10,000";
			document.getElementById("note3").innerHTML = "50.00";
			document.getElementById("note4").innerHTML = "6 (Months)";

		 }

		});		
	});

//MALAYAN

//NETWORK INCOME

	$("#inputTransferAmount1").change(function(){
		$("#btnSubmitEcash").css('display','none');
	    if(this.value < 100){
	       alert('You have entered less than 100');
	       //return false;
	      $("#btnSubmitEcash").css('display','none'); 
	    }else{
	      $("#btnSubmitEcash").css('display','inline'); 
	    }
	});

	$('#btnSubmitEcash').on('click',function(){
		$("#ecashP1").css('display','none'); 
		$("#ecashP2").css('display','block'); 
		$("#inputConvertedAmountecash").val(($("#inputTransferAmount1").val() * 0.9) - 25);
	});

	$('#btnBackEcash').on('click',function(){
		$("#ecashP1").css('display','block'); 
		$("#ecashP2").css('display','none'); 
	});

	$("#inputTransferAmount1").change(function(){
	    $("#inputTransferAmountecash").val($("#inputTransferAmount1").val());
	});

	$("#inputTransferAmount11").change(function(){
		$("#btnSubmitCheque").css('display','none');
	    if(this.value < 100){
	       alert('You have entered less than 100');
	       //return false;
	      $("#btnSubmitCheque").css('display','none'); 
	    }else{
	      $("#btnSubmitCheque").css('display','inline'); 
	    }
	});


	$("#inputGcToClaim1").change(function(){
		$("#btnSubmitGC").css('display','none');
	    if(this.value % 1500 == 0){
	       //return false;
	       	$("#btnSubmitGC").css('display','inline'); 
	    }else{
	       alert('GC to claim must be divisible by 1500');
	      	$("#btnSubmitGC").css('display','none'); 
	    }
	});

	
	$('#btnSubmitCheque').on('click',function(){
		$("#chequeP1").css('display','none'); 
		$("#chequeP2").css('display','block'); 
		$("#inputConvertedAmountcheque").val(($("#inputTransferAmount11").val() * 0.9));
	});

	$('#btnBackCheque').on('click',function(){
		$("#chequeP1").css('display','block'); 
		$("#chequeP2").css('display','none'); 
	});

	$("#inputTransferAmount11").change(function(){
	    $("#inputTransferAmountcheque").val($("#inputTransferAmount11").val());
	});

	$('#btnSubmitGC').on('click',function(){
		$("#gcP1").css('display','none'); 
		$("#gcP2").css('display','block'); 
		$("#inputGcToClaim").val($("#inputGcToClaim1").val());
		$("#inputName").val($("#inputName1").val());
	});

	$('#btnBackGC').on('click',function(){
		$("#gcP1").css('display','block'); 
		$("#gcP2").css('display','none'); 
	});


//HOMEPAGE FOR ANNOUNCEMENT
	$(document).ready(function(){
		$('a[id=aUPS]').click(function(){
			var index = $(this).index('a[id=aUPS]');
			$(".body-modal div").remove();
			$( ".news" ).eq(index).clone().prependTo( ".body-modal" );

			$("#announcementModal").modal('show');
		});		
	});
		
//END HOMEPAGE FOR ANNOUNCEMENT
//Modal loading - ayi// for markup .. testing only
	
	$('#BtnUpdateMarkup').on('click',function(){
		$('#updateMarkup').modal({
			backdrop: 'static'
		});
	});

	$('.btnModalSubmit').on('click',function(){
		$(this).html('<i class="fa fa-spinner fa-spin"></i> Loading..');
		$('.btnModalCancel').attr('disabled','disabled');
	});

//end modal loading
//SHOW PASSWORD//
	
	$(document).ready(function(){
		$('#show-pass').change(function(){
			if($(this).is(':checked')){
				 $(".sign_password").prop('type', 'text');
			}else {
				 $(".sign_password").prop('type', 'password');
			}
		});
	})
//SHOW PASSWORD//
//ACCOUNT SETTING DROPDOWN 
	$(document).ready(function(){
		$('.btn-user').click(function(){
			$('.dropdown-menu').toggle();
		});
	});
//ACCOUNT SETTING DROPDOWN

//fadeout alert 
 $(document).ready(function(){
	  	$(".alert-danger").fadeOut(100000, "linear");

  });
 $(document).ready(function(){
	  	$(".alert-success").fadeOut(100000, "linear");

  });
//fadeout alert
//datatable

			$(document).ready(function() {
				$('#example').DataTable();
			} );
	
//datatable



//registration
//select country

	$(document).ready(function(){
		$("#country").on('change',function(){
			
			var vals = $(this).val();

			if (vals == "PH") {
				$(".ph").css('display','block');
				$("#regMobiles").attr('disabled','disabled');
				$("#inputEmail").attr('disabled','disabled');
				$("#regMobile").removeAttr('disabled');
				$(".othercountry").css('display','none');
			}else {
				$(".ph").css('display','none');
				$("#regMobile").attr('disabled','disabled');
				$("#regMobiles").removeAttr('disabled');
				$(".othercountry").css('display','block');
				$("#inputEmail").removeAttr('disabled');
			}
		});
	
	});
//select country
	$('#btnStep2').on('click',function(){
		$("#RegProcess1").css('display','none'); 
		$("#RegProcess2").css('display','block'); 
		$("#RegProcess3").css('display','none'); 
		$("#RegProcess4").css('display','none'); 
		$("#RegProcess5").css('display','none');
	});

	$('#btnStep3').on('click',function(){
		$("#RegProcess1").css('display','none'); 
		$("#RegProcess2").css('display','none'); 
		$("#RegProcess3").css('display','block'); 
		$("#RegProcess4").css('display','none'); 
		$("#RegProcess5").css('display','none');
	});
	
	$('#btnStep4').on('click',function(){
		$("#RegProcess1").css('display','none'); 
		$("#RegProcess2").css('display','none'); 
		$("#RegProcess3").css('display','none'); 
		$("#RegProcess4").css('display','block'); 
		$("#RegProcess5").css('display','none');
	});

	$('#btnStep5').on('click',function(){
		$("#RegProcess1").css('display','none'); 
		$("#RegProcess2").css('display','none'); 
		$("#RegProcess3").css('display','none'); 
		$("#RegProcess4").css('display','none'); 
		$("#RegProcess5").css('display','block');
	});

	$('#btnStep2Back').on('click',function(){
		$("#RegProcess1").css('display','block');
		$("#RegProcess2").css('display','none');
		$("#RegProcess3").css('display','none');
		$("#RegProcess4").css('display','none');
		$("#RegProcess5").css('display','none');
	});

	$('#btnStep3Back').on('click',function(){
		$("#RegProcess1").css('display','none');
		$("#RegProcess2").css('display','block');
		$("#RegProcess3").css('display','none');
		$("#RegProcess4").css('display','none');
		$("#RegProcess5").css('display','none');
	});

	$('#btnStep4Back').on('click',function(){
		$("#RegProcess1").css('display','none');
		$("#RegProcess2").css('display','none');
		$("#RegProcess3").css('display','block');
		$("#RegProcess4").css('display','none');
		$("#RegProcess5").css('display','none');
	});

	$('#btnStep5Back').on('click',function(){
		$("#RegProcess1").css('display','none');
		$("#RegProcess2").css('display','none');
		$("#RegProcess3").css('display','none');
		$("#RegProcess4").css('display','block');
		$("#RegProcess5").css('display','none');
	});
//confirm password
	
function checkPass()
{
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
        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Match!"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Password Do Not Match!"
    }
}  

function checkTPass()
{
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('tpass1');
    var pass2 = document.getElementById('tpass2');
    //Store the Confimation Message Object ...
    var message = document.getElementById('confirmTMessage');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
    if(tpass1.value == tpass2.value){
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        tpass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Match!"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        tpass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Transaction Password Do Not Match!"
    }
}

function checkMatch()
{  
	var message1 = document.getElementById('confirmMessage');
	var message2 = document.getElementById('confirmTMessage');
	var btn = document.getElementById('btnStep2');

	if(message1.innerHTML == message2.innerHTML){

		btn.style.display = 'block';

	}else{

		btn.style.display = 'none';
	}

}
//confirmpassword

// Ticketing

function makeChoice(flighttype) {
	var date_return = document.getElementById("date_return");
	if (flighttype == 1) {
		date_return.placeholder = 'yyyy-mm-dd';
		date_return.disabled = false;
		date_return.value = '';
	}else{
		date_return.disabled = true;
		date_return.placeholder = '-------';
		date_return.value = '-------';
	}
}

function seniorChoice() {
	var activate_senior = document.getElementById("activate_senior");
	if (activate_senior.checked == true) {
		document.getElementById("seniornotes").style.display = 'block';
		document.getElementById("infant").value = 0;
		document.getElementById("child").value = 0;
		document.getElementById("child").disabled = true;
		document.getElementById("infant").disabled = true;
	}else{
		document.getElementById("seniornotes").style.display = 'none';
		// document.getElementById("child").value = 0;
		document.getElementById("child").disabled = false;
		document.getElementById("infant").disabled = false;
	}
}


function get_data2(checkbox,div) {
	var jsonObject = JSON.parse(checkbox.value);
	console.log(jsonObject[0]['return']);
	console.log(jsonObject[0]['choosen'][0]);
	div.style.display = 'block';
	$(div).empty();
	$(div).append('<p style="font-size: 13px; color: red;"><strong>Onwards Flight</strong></p>');
	$(div).append('<p><strong>Carrier : </strong><img src="'+images_url+'/assets/images/online_booking/'+jsonObject[0]['choosen'][0]+'.png"></p>');
	$(div).append('<p><strong>Flight No : </strong>'+jsonObject[0]['choosen'][1]+'</p>');
	$(div).append('<p><strong>Source : </strong>'+jsonObject[0]['choosen'][2]+'</p>');
	$(div).append('<p><strong>Destination : </strong>'+jsonObject[0]['choosen'][3]+'</p>');
	$(div).append('<p><strong>Class : </strong>'+jsonObject[0]['choosen'][4]+'</p>');
		if (jsonObject[0]['choosen'][5]) {
			$(div).append('<p><strong>Fare Status : </strong>'+jsonObject[0]['choosen'][5]+'</p>');
		}

	if (jsonObject[0]['connecting_onward'] == null) {

		} else{
	$(div).append('<p style="font-size: 13px; color: red;"><strong>Connecting Flight</strong></p>');
	$(div).append('<p><strong>Carrier : </strong><img src="'+images_url+'/assets/images/online_booking/'+jsonObject[0]['choosen'][17]+'.png"></p>');
	$(div).append('<p><strong>Flight No : </strong>'+jsonObject[0]['choosen'][18]+'</p>');
	$(div).append('<p><strong>Source : </strong>'+jsonObject[0]['choosen'][19]+'</p>');
	$(div).append('<p><strong>Destination : </strong>'+jsonObject[0]['choosen'][20]+'</p>');
	$(div).append('<p><strong>Class : </strong>'+jsonObject[0]['choosen'][21]+'</p>');
		if (jsonObject[0]['choosen'][22]) {
			$(div).append('<p><strong>Fare Status : </strong>'+jsonObject[0]['choosen'][22]+'</p>');
		}
	}

	if (jsonObject[0]['return'] == null) {
		$(div).append('<p><strong>-No Return Flight-</strong></p>');
		} else{
	$(div).append('<p style="font-size: 13px; color: red;"><strong>Return Flight</strong></p>');
	$(div).append('<p><strong>Carrier : </strong><img src="'+images_url+'/assets/images/online_booking/'+jsonObject[0]['choosen'][11]+'.png"></p>');
	$(div).append('<p><strong>Flight No : </strong>'+jsonObject[0]['choosen'][12]+'</p>');
	$(div).append('<p><strong>Source : </strong>'+jsonObject[0]['choosen'][13]+'</p>');
	$(div).append('<p><strong>Destination : </strong>'+jsonObject[0]['choosen'][14]+'</p>');
	$(div).append('<p><strong>Class : </strong>'+jsonObject[0]['choosen'][15]+'</p>');
		if (jsonObject[0]['choosen'][16]) {
			$(div).append('<p><strong>Fare Status : </strong>'+jsonObject[0]['choosen'][16]+'</p>');
		}
	}	

	if (jsonObject[0]['connecting_return'] == null) {

		} else{
	$(div).append('<p style="font-size: 13px; color: red;"><strong>Connecting Flight</strong></p>');
	$(div).append('<p><strong>Carrier : </strong><img src="'+images_url+'/assets/images/online_booking/'+jsonObject[0]['choosen'][23]+'.png"></p>');
	$(div).append('<p><strong>Flight No : </strong>'+jsonObject[0]['choosen'][24]+'</p>');
	$(div).append('<p><strong>Source : </strong>'+jsonObject[0]['choosen'][25]+'</p>');
	$(div).append('<p><strong>Destination : </strong>'+jsonObject[0]['choosen'][26]+'</p>');
	$(div).append('<p><strong>Class : </strong>'+jsonObject[0]['choosen'][27]+'</p>');
		if (jsonObject[0]['choosen'][28]) {
			$(div).append('<p><strong>Fare Status : </strong>'+jsonObject[0]['choosen'][28]+'</p>');
		}
	}

	$(div).append('<p style="font-size: 13px; color: red;"><strong>Payment Details</strong></p>');
	$(div).append('<strong>Passenger : </strong><br>');
			if(jsonObject[0]['choosen'][6]['Adult']){
				$(div).append('<span style="margin-left: 10px; display: block;">'+jsonObject[0]['choosen'][6]['Adult']+' (Adult)</span>');
			}
			if(jsonObject[0]['choosen'][6]['Children']){
				$(div).append('<span style="margin-left: 10px; display: block;">'+jsonObject[0]['choosen'][6]['Children']+' (Children)</span>');
			}
			if(jsonObject[0]['choosen'][6]['Infant']){
				$(div).append('<span style="margin-left: 10px; display: block;">'+jsonObject[0]['choosen'][6]['Infant']+' (Infant)</span>');
			}

	$(div).append('<p><strong>Base Fare : </strong><span style="color: red">'+jsonObject[0]['choosen'][7]+'</span></p>');
	$(div).append('<p><strong>Taxes & Fees : </strong><span style="color: red">'+jsonObject[0]['choosen'][8]+'</span></p>');
	if (jsonObject[0]['choosen'][10]) {
		$(div).append('<p><strong>Total Amount : </strong><span style="color: red">'+jsonObject[0]['choosen'][9]+'</span></p>');
	}else{
		$(div).append('<p><strong>Total Amount : </strong><span style="color: red">'+jsonObject[0]['choosen'][9] +' </span></p>') //(Insufficient Fund)</span></p> ');
	}
}


function get_data(checkbox,div) {
	var jsonObject = JSON.parse(checkbox.value);
	console.log(jsonObject);
	div.style.display = 'block';
	$(div).empty();
	$(div).append('<p style="font-size: 13px; color: red;"><strong>Onwards Flight</strong></p>');
	$(div).append('<p><strong>Carrier : </strong><img src="'+images_url+'/assets/images/online_booking/'+jsonObject[0]+'.png"></p>');
	$(div).append('<p><strong>Flight No : </strong>'+jsonObject[1]+'</p>');
	$(div).append('<p><strong>Source : </strong>'+jsonObject[2]+'</p>');
	$(div).append('<p><strong>Destination : </strong>'+jsonObject[3]+'</p>');
	$(div).append('<p><strong>Class : </strong>'+jsonObject[4]+'</p>');
		if (jsonObject[5]) {
			$(div).append('<p><strong>Fare Status : </strong>'+jsonObject[5]+'</p>');
		}
	$(div).append('<p style="font-size: 13px; color: red;"><strong>Payment Details</strong></p>');
	$(div).append('<strong>Passenger : </strong><br>');
		if (jsonObject[6]['senior'] == 1) {
			console.log(jsonObject[6]['Senior']);
			$(div).append('<span style="margin-left: 10px; display: block;">'+jsonObject[6]['Adult']+' (Senior)</span>');
		}else{
			console.log(jsonObject[6]['Senior']);
			if(jsonObject[6]['Adult']){
				$(div).append('<span style="margin-left: 10px; display: block;">'+jsonObject[6]['Adult']+' (Adult)</span>');
			}
			if(jsonObject[6]['Children']){
				$(div).append('<span style="margin-left: 10px; display: block;">'+jsonObject[6]['Children']+' (Children)</span>');
			}
			if(jsonObject[6]['Infant']){
				$(div).append('<span style="margin-left: 10px; display: block;">'+jsonObject[6]['Infant']+' (Infant)</span>');
			}
		}

	
	$(div).append('<p><strong>Base Fare : </strong><span style="color: red">'+jsonObject[7]+'</span></p>');
	$(div).append('<p><strong>Taxes & Fees : </strong><span style="color: red">'+jsonObject[8]+'</span></p>');
	if (jsonObject[10]) {
		$(div).append('<p><strong>Total Amount : </strong><span style="color: red">'+jsonObject[9]+'</span></p>');
	}else{
		$(div).append('<p><strong>Total Amount : </strong><span style="color: red">'+jsonObject[9]+' </span></p>') //(Insufficient Fund)</span></p> ');
	}
}



//LOADING MODULE
	//SPECIAL LOAD

		$(document).ready(function(){
			$('#selDenomination').change(function(){
				var inclusion = $(this).children('option:selected').data('desc');
				$('.alert-inclusion').css('display','block');
				$('.alert-inclusion').html(inclusion);
				

			});

		});
		$(document).ready(function(){
			$("#selNetwork").change(function(){
				var telco  = $(this).val();
				$('#selDenomination option').eq(0).prop('selected',true);
				
				$("option[id=optGlobe]").prop('hidden','hidden');
				$("option[id=optSmart]").prop('hidden','hidden');
				$("option[id=optSun]").prop('hidden','hidden');	
				if (telco == 1) {
					$("option[id=optSmart]").removeAttr('hidden');
			
				}else if (telco == 2)
				{
					$("option[id=optGlobe]").removeAttr('hidden');	
				
				}else if(telco == 3)
				{
					$("option[id=optSun]").removeAttr('hidden');
					
				}
			});
		});
	//SPECIAL LOAD
	//PREPAID CARD 
				//PREPAID CARD
		$(document).ready(function(){
			$("#selPrepaidcard").change(function(){
				var telco  = $(this).val();
				$('#selDenomination option').eq(0).prop('selected',true);
				
				$("option[id=optgamecard]").prop('hidden','hidden');
				$("option[id=optcallcard]").prop('hidden','hidden');
				$("option[id=optother]").prop('hidden','hidden');	
				if (telco == 3) {
					$("option[id=optgamecard]").removeAttr('hidden');
			
				}else if (telco == 4)
				{
					$("option[id=optcallcard]").removeAttr('hidden');	
				
				}else if(telco == 5)
				{
					$("option[id=optother]").removeAttr('hidden');
					
				}
			});
		});

		$(document).ready(function(){
			$('#selDenominationCard').change(function(){
				var inclusion = $(this).children('option:selected').data('desc');
				alert(inclusion);
				$('.alert-inclusion').css('display','block');
				$('.alert-inclusion').html(inclusion);
				

			});

		});
	//PREPAID CARD

	//PREPAID CARD
//LOADING MODULE

//BILLSPAYMENT

$('#stamariaidno').keyup(function() {
        var val = this.value.replace(/\D/g, '');
        var newVal = '';
        while (val.length > 6) {
          newVal += val.substr(0, 6) + '-';
          val = val.substr(6);
        }
        newVal += val;
        this.value = newVal;
        
    });
    
				//UTILITIES
		$(document).ready(function(){
			$('#selBiller').change(function(){
				
				//var billernote = $(this).children('option:selected').data('desc'); // select attribute billspayment (data-desc)
				var utilities_type = $(this).children('option:selected').data('type'); //select attribute billspayment (data-type)
				var billerval = $(this).children('option:selected').val();  //value of select 

				var utilities1 = $('.utilities1'); // div  with form
				var utilities2 = $('.utilities2'); //div with  form
				var utilities3 = $('.utilities3'); //div with  form
				var utilities4 = $('.utilities4'); //div with  form
				var utilities5 = $('.utilities5'); //div with  form
				var utilities6 = $('.utilities6'); //div with  form
				var utilities9 = $('.utilities9'); //div with  form
				var utilities11 = $('.utilities11'); //div with  form
				var utilities13 = $('.utilities13'); //div with  form
				var utilities15 = $('.utilities15'); //div with  form
				var utilities18 = $('.utilities18'); //div with  form
				var utilities20 = $('.utilities20'); //div with  form

					//display form//
				if (utilities_type == 1 || utilities_type == 8 || utilities_type == 7)
				{
					utilities1.show();
					utilities2.css('display','none');
					utilities3.css('display','none');
					utilities4.css('display','none');
					utilities5.css('display','none');
					utilities6.css('display','none');
					utilities9.css('display','none');
					utilities11.css('display','none');
					utilities13.css('display','none');
					utilities15.css('display','none');
					utilities18.css('display','none');
					utilities20.css('display','none');
					$("#inputBiller").remove();
					$("#divBiller1").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller"  />');
					$("#inputBiller").val(billerval);

				}else if (utilities_type == 2) {
					utilities2.show();
					utilities1.css('display','none');
					utilities3.css('display','none');
					utilities4.css('display','none');
					utilities5.css('display','none');
					utilities6.css('display','none');
					utilities9.css('display','none');
					utilities11.css('display','none');
					utilities13.css('display','none');
					utilities15.css('display','none');
					utilities18.css('display','none');
					utilities20.css('display','none');
					$("#inputBiller").remove();
					$("#divBiller2").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller"  />');
					$("#inputBiller").val(billerval);

				}else if (utilities_type == 3) {
					utilities3.show();
					utilities1.css('display','none');
					utilities2.css('display','none');
					utilities4.css('display','none');
					utilities5.css('display','none');
					utilities6.css('display','none');
					utilities9.css('display','none');
					utilities11.css('display','none');
					utilities13.css('display','none');
					utilities15.css('display','none');
					utilities18.css('display','none');
					utilities20.css('display','none');
					$("#inputBiller").remove();
					$("#divBiller3").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller"  />');
					$("#inputBiller").val(billerval);

				}else if (utilities_type == 4) {
					utilities4.show();
					utilities1.css('display','none');
					utilities2.css('display','none');
					utilities3.css('display','none');
					utilities5.css('display','none');
					utilities6.css('display','none');
					utilities9.css('display','none');
					utilities11.css('display','none');
					utilities13.css('display','none');
					utilities15.css('display','none');
					utilities18.css('display','none');
					utilities20.css('display','none');
					$("#inputBiller").remove();
					$("#divBiller4").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller"  />');
					$("#inputBiller").val(billerval);

				}else if (utilities_type == 5) {
					utilities5.show();
					utilities1.css('display','none');
					utilities2.css('display','none');
					utilities3.css('display','none');
					utilities4.css('display','none');
					utilities6.css('display','none');
					utilities9.css('display','none');
					utilities11.css('display','none');
					utilities13.css('display','none');
					utilities15.css('display','none');
					utilities18.css('display','none');
					utilities20.css('display','none');
					$("#inputBiller").remove();
					$("#divBiller5").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller"  />');
					$("#inputBiller").val(billerval);

				}else if (utilities_type == 6) {
					utilities6.show();
					utilities1.css('display','none');
					utilities2.css('display','none');
					utilities3.css('display','none');
					utilities4.css('display','none');
					utilities5.css('display','none');
					utilities9.css('display','none');
					utilities11.css('display','none');
					utilities13.css('display','none');
					utilities15.css('display','none');
					utilities18.css('display','none');
					utilities20.css('display','none');
					$("#inputBiller").remove();
					$("#divBiller6").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller"  />');
					$("#inputBiller").val(billerval);

				}else if (utilities_type == 9) {
					utilities9.show();
					utilities1.css('display','none');
					utilities3.css('display','none');
					utilities4.css('display','none');
					utilities2.css('display','none');
					utilities5.css('display','none');
					utilities6.css('display','none');
					utilities11.css('display','none');
					utilities13.css('display','none');
					utilities15.css('display','none');
					utilities18.css('display','none');
					utilities20.css('display','none');
					$("#inputBiller").remove();
					$("#divBiller9").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller"  />');
					$("#inputBiller").val(billerval);

				}else if (utilities_type == 11) {
					utilities11.show();
					utilities1.css('display','none');
					utilities3.css('display','none');
					utilities4.css('display','none');
					utilities2.css('display','none');
					utilities5.css('display','none');
					utilities6.css('display','none');
					utilities9.css('display','none');
					utilities13.css('display','none');
					utilities15.css('display','none');
					utilities18.css('display','none');
					utilities20.css('display','none');
					$("#inputBiller").remove();
					$("#divBiller11").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller"  />');
					$("#inputBiller").val(billerval);

				}else if (utilities_type == 13) {
					utilities13.show();
					utilities1.css('display','none');
					utilities3.css('display','none');
					utilities4.css('display','none');
					utilities2.css('display','none');
					utilities5.css('display','none');
					utilities6.css('display','none');
					utilities9.css('display','none');
					utilities11.css('display','none');
					utilities15.css('display','none');
					utilities18.css('display','none');
					utilities20.css('display','none');
					$("#inputBiller").remove();
					$("#divBiller13").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller"  />');
					$("#inputBiller").val(billerval);

				}else if (utilities_type == 15) {
					utilities15.show();
					utilities1.css('display','none');
					utilities3.css('display','none');
					utilities4.css('display','none');
					utilities2.css('display','none');
					utilities5.css('display','none');
					utilities6.css('display','none');
					utilities9.css('display','none');
					utilities11.css('display','none');
					utilities13.css('display','none');
					utilities18.css('display','none');
					utilities20.css('display','none');
					$("#inputBiller").remove();
					$("#divBiller15").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller"  />');
					$("#inputBiller").val(billerval);

				}else if (utilities_type == 18) {
					utilities18.show();
					utilities1.css('display','none');
					utilities3.css('display','none');
					utilities4.css('display','none');
					utilities2.css('display','none');
					utilities5.css('display','none');
					utilities6.css('display','none');
					utilities9.css('display','none');
					utilities11.css('display','none');
					utilities13.css('display','none');
					utilities15.css('display','none');
					utilities20.css('display','none');
					$("#inputBiller").remove();
					$("#divBiller18").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller"  />');
					$("#inputBiller").val(billerval);

				}else if (utilities_type == 20) {
					utilities20.show();
					utilities1.css('display','none');
					utilities3.css('display','none');
					utilities4.css('display','none');
					utilities2.css('display','none');
					utilities5.css('display','none');
					utilities6.css('display','none');
					utilities9.css('display','none');
					utilities11.css('display','none');
					utilities13.css('display','none');
					utilities15.css('display','none');
					utilities18.css('display','none');
					$("#inputBiller").remove();
					$("#divBiller20").append('<input type="hidden" class="form-control" name="inputBiller" id="inputBiller"  />');
					$("#inputBiller").val(billerval);
				}

					//display form//

					//display messgae//
				//if (billernote != "1") {
					
					// $('.alert-biller').show();
					// if (billernote == 8){
						
					// 	$('.alert-biller').html("<i><font color='red'>Notes:</font></i><br />" +
					// 							"&#9632 Account Number <br />" +
					// 							"For Manual Inputting of Account No. <br />" +
					// 							"&#9632 Use the ATM /Phone Reference No. -16 Digits code Besides S.I.N <br />" +
					// 							"Using BarCode Scanner <br />" +
					// 							"&#9632 From left-to-right, scan the first and second bar codes only. <br />" +
					// 							'<img src="'+images_url+'/assets/images/billspayment/meralco_atm.png" style="margin:0 auto; width: 100%;">'
					// 							);	 
					// }
					// else if (billernote == 15) {
					// 	$('.alert-biller').html("10 digit SSS number + 6 digit containing month (mm)"
					// 												+ " and year (yyyy) for the applicable payment period. i.e. XXXXXXXXXXmmyyyy");
					// }
					// else if (billernote == 3) {
					// 	$('.alert-biller').html("Please collect an additional <font color='red'>&#x20b1 10.00 </font>for the charge."
					// 												+ " However,please input the actual amount");
					// }
					// else if (billernote == 5) {
					// 	$('.alert-biller').html("Please include two decimal places [e.g. 19600.00]");
					// } 
					// else if (billernote == 7) {
					// 	$('.alert-biller').html("Please enter 555 and the last 6 digits of your E-Pass Account number in the Account No. field.");
					// }
					// else if (billernote == 13){
						
					// 	$('.alert-biller').html("<i><font color='red'>Notes:</font></i><br />" +
					// 							"The staff must validate the amount from the Statement of Account (SoA) presented by the client. Advice the client that the AR from GPRS and their SoA should be presented to the school's accounting department to get the permit." +
					// 							'<img src="'+images_url+'/assets/images/billspayment/rmmcr.png" style="margin:0 auto; width: 100%;">'
					// 							);	
					// }
					// else if (billernote == 20){
						
					// 	$('.alert-biller').html("Please collect an additional &#x20b1 9.00 for the change." +
					// 							"However, please input the actual amount." +
					// 							"The &#x20b1 9.00 charge will be automatically deducted to your account." +
					// 							"Example: Bill = &#x20b1 2000, collect &#x20b1 2009 but input 2000"
					// 							);								 
					// }else {
					// $('.alert-biller').hide();
					// $('.alert-biller').html("");
					// }
					//display messgae//
			});

		});
				//UTILITIES
//BILLSPAYMENT

//DATETIMEPICKER

$.datetimepicker.setLocale('en');

$('#datetimepicker_format').datetimepicker({value:'2015/04/15 05:03', format: $("#datetimepicker_format_value").val()});
$("#datetimepicker_format_change").on("click", function(e){
	$("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});
});
$("#datetimepicker_format_locale").on("change", function(e){
	$.datetimepicker.setLocale($(e.currentTarget).val());
});

$('.datetimepicker').datetimepicker({
	//minDate: 0,
	dayOfWeekStart : 1,
	lang:'en',
	timepicker:false,
	format:'Y-m-d',
	// formatDate:'Y/m/d',
	// startDate:new Date()
	});

$('.bdatetimepicker').datetimepicker({

	
	lang:'en',
	timepicker:false,
	format:'d/m/Y',
	 formatDate:'d/m/Y',
	// startDate:new Date()
	});

$('input[id="datetimepicker"]').datetimepicker({

	dayOfWeekStart : 1,
	lang:'en',
	timepicker:false,
	format:'Y-m-d',
	formatDate:'Y-m-d',
	startDate:new Date()
	});

//$('input[id="datetimepicker"]').datetimepicker({value:	new Date() ,step:10});
$('input[id="datetimepickers"]').datetimepicker({

	dayOfWeekStart : 1,
	lang:'en',
	timepicker:false,
	format:'Y-m-d',
	formatDate:'Y-m-d',
	startDate:new Date()
	});

//$('input[id="datetimepickers"]').datetimepicker({value:	new Date() ,step:10});

// $('.datetimepicker').datetimepicker({value:	new Date() ,step:10});
$('.some_class').datetimepicker();

$('#default_datetimepicker').datetimepicker({
	formatTime:'h:i',
	formatDate:'d.m.Y',
	//defaultDate:'8.12.1986', // it's my birthday
	defaultDate:'+03.01.1970', // it's my birthday
	defaultTime:'10:00',
	timepickerScrollbar:false
});

$('#datetimepicker10').datetimepicker({
	step:5,
	inline:true
});
$('#datetimepicker_mask').datetimepicker({
	mask:'9999/19/39 29:59'
});

$('#datetimepicker1').datetimepicker({
	datepicker:false,
	format:'H:i',
	step:5
});
$('#datetimepicker2').datetimepicker({
	yearOffset:222,
	lang:'ch',
	timepicker:false,
	format:'d/m/Y',
	formatDate:'Y/m/d',
	minDate:'1970/01/02', // yesterday is minimum date
	maxDate:'2015/01/02' // and tommorow is maximum date calendar
});
$('#datetimepicker3').datetimepicker({
	inline:true
});
$('#datetimepicker4').datetimepicker();
$('#open').click(function(){
	$('#datetimepicker4').datetimepicker('show');
});
$('#close').click(function(){
	$('#datetimepicker4').datetimepicker('hide');
});
$('#reset').click(function(){
	$('#datetimepicker4').datetimepicker('reset');
});
$('#datetimepicker5').datetimepicker({
	datepicker:false,
	allowTimes:['12:00','13:00','15:00','17:00','17:05','17:20','19:00','20:00'],
	step:5
});
$('#datetimepicker6').datetimepicker();
$('#destroy').click(function(){
	if( $('#datetimepicker6').data('xdsoft_datetimepicker') ){
		$('#datetimepicker6').datetimepicker('destroy');
		this.value = 'create';
	}else{
		$('#datetimepicker6').datetimepicker();
		this.value = 'destroy';
	}
});
var logic = function( currentDateTime ){
	if (currentDateTime && currentDateTime.getDay() == 6){
		this.setOptions({
			minTime:'11:00'
		});
	}else
		this.setOptions({
			minTime:'8:00'
		});
};
$('#datetimepicker7').datetimepicker({
	onChangeDateTime:logic,
	onShow:logic
});
$('#datetimepicker8').datetimepicker({
	onGenerate:function( ct ){
		$(this).find('.xdsoft_date')
			.toggleClass('xdsoft_disabled');
	},
	minDate:'-1970/01/2',
	maxDate:'+1970/01/2',
	timepicker:false
});
$('#datetimepicker9').datetimepicker({
	onGenerate:function( ct ){
		$(this).find('.xdsoft_date.xdsoft_weekend')
			.addClass('xdsoft_disabled');
	},
	weekends:['01.01.2014','02.01.2014','03.01.2014','04.01.2014','05.01.2014','06.01.2014'],
	timepicker:false
});
var dateToDisable = new Date();
	dateToDisable.setDate(dateToDisable.getDate() + 2);
$('#datetimepicker11').datetimepicker({
	beforeShowDay: function(date) {
		if (date.getMonth() == dateToDisable.getMonth() && date.getDate() == dateToDisable.getDate()) {
			return [false, ""]
		}

		return [true, ""];
	}
});
$('#datetimepicker12').datetimepicker({
	beforeShowDay: function(date) {
		if (date.getMonth() == dateToDisable.getMonth() && date.getDate() == dateToDisable.getDate()) {
			return [true, "custom-date-style"];
		}

		return [true, ""];
	}
});
$('#datetimepicker_dark').datetimepicker({theme:'dark'})


//DATETIMEPICKER

//REMITTANCE
//ecash send
$(document).ready(function(){
	$(".btnproceed").click(function(){
		$("#proceedModal").modal('show');
	});
});

$(document).ready(function(){
	$(".btnview").click(function(){
		$("#senderconfirmation").modal('show');
	});
});

//ecash payout
$(document).ready(function(){
	$('.frmclass').on('submit',function(){
		
		waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});		
	});
});
$('#memberModal').modal('show');


//ecash payout center
$('#exquisiteImg').click(function(){
    $('#exquisiteModal').modal({show:true})
});

$('#davaoenaImg').click(function(){
    $('#davaoenaModal').modal({show:true})
});

$('#gemcraftImg').click(function(){
    $('#gemcraftModal').modal({show:true})
});

$('#kwartagramImg').click(function(){
    $('#kwartagramModal').modal({show:true})
});

$('#gprsImg').click(function(){
    $('#gprsModal').modal({show:true})
});

$('#gpttImg').click(function(){
    $('#gpttModal').modal({show:true})
});

$('#srtImg').click(function(){
    $('#srtModal').modal({show:true})
});

$('#dominionImg').click(function(){
    $('#dominionModal').modal({show:true})
});

$('#gppImg').click(function(){
    $('#gppModal').modal({show:true})
});

$('#merlinImg').click(function(){
    $('#merlinModal').modal({show:true})
});

$('#sppImg').click(function(){
    $('#sppModal').modal({show:true})
});

$('#smpImg').click(function(){
    $('#smpModal').modal({show:true})
});

$('#upsImg').click(function(){
    $('#upsModal').modal({show:true})
});

//ecash payout center
//REMITTANCE


//NETWORK
$(document).ready(function(){
	$(".btneCash").click(function(){
		$("#eCashModal").modal('show');
	});
});

$(document).ready(function(){
	$(".btnCheque").click(function(){
		$("#chequeModal").modal('show');
	});
});

$(document).ready(function(){
	$(".btnClaim").click(function(){
		$("#claimModal").modal('show');
	});
});
//NETWORK

//domestic flights

//domestic flights booking_inter_search

//international flights
	$(document).ready(function(){
		$("#booking_inter_search").click(function(){
			window.location.replace('<?php echo BASE_URL(); ?>/International_flights/book_international_flights')
		});
	});
//international flights 
//ONLINE BOOKING

//ONLINE SHOP
	$(document).ready(function(){
		$("a[id=buycodelink1]").click(function(){
			var desc = $("a[id=buycodelink1]").data('desc');
			$('.modal-title').html(desc);
			var myModal = $("#buycodemodal");
			myModal.modal('show');
			$("#inputPackageType").val('1');

		});
	});

	$(document).ready(function(){
		$("a[id=buycodelink2]").click(function(){
			var desc = $("a[id=buycodelink2]").data('desc');
			$('.modal-title').html(desc);
			var myModal = $("#buycodemodal");
			myModal.modal('show');
			$("#inputPackageType").val('2');

		});
	});
//ONLINE SHOP



//MY ACCOUNT //

	$(document).ready(function(){
		$("#aPass").click(function(){
			$('#divtpass').show();
			$('#divlpass').hide();
		});

		$("#bPass").click(function(){
			$('#divlpass').show();
			$('#divtpass').hide();
		});
	});

//MY ACCOUNT

//Login
$(document).ready(function(){

	$('#signin').on('submit',function(){
		waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
		// $('#btnsignin').prop('disabled',true);
	});
});

//forgot password
$(document).ready(function(){

	$('#frmforgotpassword').on('submit',function(){
		waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
		// $('#btnsignin').prop('disabled',true);
	});
});


//ECASH SEND 
		$(document).ready(function(){
			$("#frmecashsend").on("submit",function(){
					$('#myModal').modal("hide");
				waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
			});
		});
	//ecash_send/ecashtosmartmoney

	//sender search
		$(document).ready(function(){
			$("#frmSSeachRemit").on("submit",function(){
				
				waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
			});
		});
		
		$(document).ready(function(){
			$("#frmBSeachRemit").on("submit",function(){
			
				waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
			});
		});

		$(document).ready(function(){
			$("#frmAddecashcredittobank").on("submit",function(){
			
				waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
			});
		});
	//sender search
	//add sender and beneficiary		
		$(document).ready(function(){
			$("#frmAddSmartmoney").on("submit",function(){
				waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
			});
		});
	//add sender and beneficiary
	//ECASH  - PADALA
		$(document).ready(function(){
			$("#frmProceedEcashPadala").on("submit",function(){
				waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
			});
		});

		$(document).ready(function(){
			$("#frmAddEcashPadala").on("submit",function(){
				waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
			});
		});
	//ECASH  - PADALA

	//ECASH CASH CARD
		 $(document).ready(function(){
			$('a[id=cashcard]').on('click',function(){
				var index = $(this).index('a[id=cashcard]');
				var benificiary = $('#inputBenificiary');
				var inputData = $('#inputData');
				var str = new Array();
				var i = 0;

				$(".tr").eq(index).find(".td").each(function() {   //GET information from table (HTML)
					 str[i] = $(this).text();
					 i++;
				});	
				benificiary.val(str[0]);
				inputData.val(str);
				$('#inputAmount').removeAttr('readonly');
				$('#inputTpass').removeAttr('readonly');
				$('#inputAmount').focus();
			});
		});

		$(document).ready(function(){
			$("#frmecashtocashcard").on("submit",function(){
				waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
			});
		});
			$(document).ready(function(){
			$("#frmecashtocashcardconfirm").on("submit",function(){
				waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
			});
		});
	//ECASH CASHCARD
		$(document).ready(function(){
			if ($('#inputsmartmoneySenderName').val() == ""){
				$('#inputsmartmoneyBeneficiaryName').attr('readonly',true);
				$("#inputSenderHide").val()

			}else {
				$('#inputsmartmoneySenderName').attr('readonly',true);
				$('#inputsmartmoneyBeneficiaryName').focus();
		
			}
			
			$('a[id=aFind]').on('click',function(){

				var index = $(this).index('a[id=aFind]');
				var data = $(this).data('id');
				var sender = $('#inputsmartmoneySenderName');
				var beneficiary = $('#inputsmartmoneyBeneficiaryName');
				var	inputSenderHide = $("#inputSenderHide");
				var inputBeneficiaryHide = $("#inputBeneficiaryHide");
				var str =[];
				var i = 0;

				$(".tr").eq(index).find(".td").each(function() {   //GET information from table (HTML)
				   str[i] = $(this).text();
				
					i++;
				});	

				if (data == 1 ) 
				{
					sender.val(str[1]);
					if (sender.val() != "") {
						beneficiary.removeAttr('readonly');
						sender.attr('readonly',true);	
						beneficiary.focus();
						inputSenderHide.val(str[0] + "|" + str[1]);
					}
				}
				else if (data == 2)
				{
					$('.btnProceed').show();
					beneficiary.val(str[1]);
					inputBeneficiaryHide.val(str[0] + "|" + str[1]);
				}
				

			});
		});
	//sender search
	//open modal

		$(document).ready(function(){
			$('.btnProceed').click(function(){
				var beneficiary = $('#inputsmartmoneyBeneficiaryName').val();
				var processName=$('#inputBeneficiary');
				var	inputSenderHide = $("#inputSenderHide").val();
				var inputBeneficiaryHide = $("#inputBeneficiaryHide").val();
				var inputId =$('#inputId');
				var arrSender 	   =  inputSenderHide.split('|');
				var arrBeneficiary = inputBeneficiaryHide.split('|');
				//var arrId =arrSender[0] + "||" + arrBenificiary[0];
				var arrId =$("#inputSenderHide").val() + "|" + $("#inputBeneficiaryHide").val();
				processName.val(beneficiary);
				inputId.val(arrId);
				$('#myModal').modal('show');

			});
		});
		
		$(document).ready(function(){
			$("#frmProceedSmartmoney").on("submit",function(){
				waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
			});
		});
	//open modal

	//ecash_send/ecashtosmartmoney
	//CASH CARD

//REGISTRATION
			$(document).ready(function(){
				$("#frmRegistration").on("submit",function(){
					waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
				});
			});
//REGISTRATION

//REMITTANCE
			$(document).ready(function(){ 
				$("#frmEcashPadala").on("submit",function(){
					waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
				
				});
			});	

			$(document).ready(function(){ 
				$("#frmIremit").on("submit",function(){
					waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
				
				});
			});	

			$(document).ready(function(){ 
				$("#frmNYBY").on("submit",function(){
					waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
				
				});
			});	

			$(document).ready(function(){ 
				$("#frmSmartmoneyEcash").on("submit",function(){
					waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
				
				});
			});

			$(document).ready(function(){ 
				$("#frmTransfast").on("submit",function(){
					waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
				
				});
			});

				
//REMITTANCE

//FUND TRANSFER
$(document).ready(function(){

	$('#frmaedfund').on('submit',function(){
		waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
		// $('#btnsignin').prop('disabled',true);
	});
});

//ONLINE BOOKING
			$(document).ready(function(){ 
				$("#frmDomesticFlights").on("submit",function(){
					waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
				
				});
			});

			$(document).ready(function(){
				$("#frmDomesticMarkup").on("submit",function(){
					waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
				
				});
			});

			$(document).ready(function(){ 
				$("#frmInternationalFlights").on("submit",function(){
					waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
				
				});
			});

			$(document).ready(function(){ 
				$("#frmInternationalMarkup").on("submit",function(){
					waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
				
				});
			});

//ONLINE BOOKING

//ONLINE SHOP
			$(document).ready(function(){ 
				$("#frmMalayan").on("submit",function(){
					waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
				
				});
			});			
//ONLINE SHOP

	//CASH CARD
//ECASH SEND

//BILLS PAYMENT
			$(document).ready(function(){
				$('a[id=billsPaymentLoading]').click(function(){
					waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});		
				});
			});

			$(document).ready(function(){
				$('a[id=billsPaymentLoading]').click(function(){
					waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});		
				});
			});
			//utilities
			$(document).ready(function(){ //regular load
				$("#frmUtilitiesLoading").on("submit",function(){
					waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
				
				});
			});
			//telecom
			$(document).ready(function(){ //regular load
				$("#frmTelecomLoading").on("submit",function(){
					waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
				
				});
			});
			//airlines
			$(document).ready(function(){ //regular load
				$("#frmAirlinesLoading").on("submit",function(){
					waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
				
				});
			});
			//credit cards
			$(document).ready(function(){ //regular load
				$("#frmAirlinesLoading").on("submit",function(){
					waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
				
				});
			});
			//government
			$(document).ready(function(){ //regular load
				$("#frmGovernmentLoading").on("submit",function(){
					waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
				
				});
			});
			//insurance
			$(document).ready(function(){ //regular load
				$("#frmInsuranceLoading").on("submit",function(){
					waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
				
				});
			});
			//schools
			$(document).ready(function(){ //regular load
				$("#frmSchoolsLoading").on("submit",function(){
					waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
				
				});
			});
			//others
			$(document).ready(function(){ //regular load
				$("#frmOthersLoading").on("submit",function(){
					waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
				
				});
			});
//BILLS PAYMENT



//LOADING

		//E-loading
			$(document).ready(function(){ //regular load
				$("#frmregloading").on("submit",function(){
					$('#myModal').modal("hide");
					waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
				
				});
			});

			$(document).ready(function(){
				$('a[id=aloading]').click(function(){

					waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});		
				});
			});

			$(document).ready(function(){ //special load
				$("#frmspecialloading").on("submit",function(){
					$('#myModal').modal("hide");
					waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
				
			});
		});
			$(document).ready(function(){ //prepaid load
				$("#frmprepaidcard").on("submit",function(){
					$('#myModal').modal("hide");
					waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
				
			});
		});
			$(document).ready(function(){ //sgd load
				$("#frmsgdloading").on("submit",function(){
					$('#myModal').modal("hide");
					waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
				
			});
		});
			
			$(document).ready(function(){ //etisalat load
				$("#frmetisalatloading").on("submit",function(){
					$('#myModal').modal("hide");
					waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
				
			});
		});
		//E-loading
		//FUND TRANSFER
				
			$(document).ready(function(){ //load wallet
				$("#frmloadwallet").on("submit",function(){
					$('#myModal').modal("hide");
					waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
				
				});
			});
		//FUND TRANSFER
		//FUND REQUEST 
			$(document).ready(function(){ //load wallet
				$("#frmfundtransfer").on("submit",function(){
					waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
				
				});
			});
		//FUND REQUEST
		// For General Purposes.. I turn id to class 
			$(document).ready(function(){ //load wallet
				$(".transaction_form").on("submit",function(){
					waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
				});
			});
//LOADING

//REPORT

		$(document).ready(function(){
			$("#frmreport").on("submit",function(){
				waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
			});
		});
//REPORT

//PLEASE WAIT LOADING

/**
 * Module for displaying "Waiting for..." dialog using Bootstrap
 *
 * @author Eugene Maslovich <ehpc@em42.ru>
 */

var waitingDialog = waitingDialog || (function ($) {
    'use strict';

	// Creating modal dialog's DOM
	var $dialog = $(
		'<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:15%; overflow-y:visible;">' +
		'<div class="modal-dialog modal-m">' +
		'<div class="modal-content">' +
			'<div class="modal-header"><h3 style="margin:0;"></h3></div>' +
			'<div class="modal-body">' +
				'<div class="progress progress-striped active" style="margin-bottom:0;"><div class="progress-bar" style="width: 100%"></div></div>' +
			'</div>' +
		'</div></div></div>');

	return {
		/**
		 * Opens our dialog
		 * @param message Custom message
		 * @param options Custom options:
		 * 				  options.dialogSize - bootstrap postfix for dialog size, e.g. "sm", "m";
		 * 				  options.progressType - bootstrap postfix for progress bar type, e.g. "success", "warning".
		 */
		show: function (message, options) {
			// Assigning defaults
			if (typeof options === 'undefined') {
				options = {};
			}
			if (typeof message === 'undefined') {
				message = 'Loading';
			}
			var settings = $.extend({
				dialogSize: 'm',
				progressType: '',
				onHide: null // This callback runs after the dialog was hidden
			}, options);

			// Configuring dialog
			$dialog.find('.modal-dialog').attr('class', 'modal-dialog').addClass('modal-' + settings.dialogSize);
			$dialog.find('.progress-bar').attr('class', 'progress-bar');
			if (settings.progressType) {
				$dialog.find('.progress-bar').addClass('progress-bar-' + settings.progressType);
			}
			$dialog.find('h3').text(message);
			// Adding callbacks
			if (typeof settings.onHide === 'function') {
				$dialog.off('hidden.bs.modal').on('hidden.bs.modal', function (e) {
					settings.onHide.call($dialog);
				});
			}
			// Opening dialog
			$dialog.modal();
		},
		/**
		 * Closes dialog
		 */
		hide: function () {
			$dialog.modal('hide');
		}
	};

})(jQuery);


//PLEASE WAIT LOADING



$("#network_thumb1").tooltip({
		placement: 'bottom', 
		title: $('#network_thumb1').data('id'), 
		html: true});
	$("#network_thumb2").tooltip({
		placement: 'bottom', 
		title: $('#network_thumb2').data('id'), 
		html: true});
	$("#network_thumb3").tooltip({
			placement: 'bottom', 
			title: $('#network_thumb3').data('id'), 
			html: true});
	$("#network_thumb4").tooltip({
			placement: 'bottom', 
			title: $('#network_thumb4').data('id'), 
			html: true});
	$("#network_thumb5").tooltip({
			placement: 'bottom', 
			title: $('#network_thumb5').data('id'), 
			html: true});
	$("#network_thumb6").tooltip({
			placement: 'bottom', 
			title: $('#network_thumb6').data('id'), 
			html: true});
	$("#network_thumb7").tooltip({
			placement: 'bottom', 
			title: $('#network_thumb7').data('id'), 
			html: true});
	$("#network_thumb8").tooltip({
			placement: 'top', 
			title: $('#network_thumb8').data('id'), 
			html: true});
	$("#network_thumb9").tooltip({
			placement: 'top', 
			title: $('#network_thumb9').data('id'), 
			html: true});
	$("#network_thumb10").tooltip({
			placement: 'top', 
			title: $('#network_thumb10').data('id'), 
			html: true});
	$("#network_thumb11").tooltip({
			placement: 'top', 
			title: $('#network_thumb11').data('id'), 
			html: true});
	$("#network_thumb12").tooltip({
				placement: 'top', 
				title: $('#network_thumb12').data('id'), 
				html: true});

	$("#network_thumb13").tooltip({
				placement: 'top', 
				title: $('#network_thumb13').data('id'), 
				html: true});
	$("#network_thumb14").tooltip({
				placement: 'top', 
				title: $('#network_thumb14').data('id'), 
				html: true});

	$("#network_thumb15").tooltip({
				placement: 'top', 
				title: $('#network_thumb15').data('id'), 
				html: true});
//COUNTS AIRLINES PASSENGER
	$(document).ready(function(){
		var adult = $("#adult");
		var child =	$("#child");
		var infant =$("#infant");
		$("#adult").change(function(){
			var total = parseInt(adult.val()) + parseInt(child.val()) + parseInt(infant.val());
				if (total>=10) {
				$("#myModal").modal("show");
				$("#adult option:first").attr('selected','selected');
			}
		});
		$("#child").change(function(){
			var total = parseInt(adult.val()) + parseInt(child.val()) + parseInt(infant.val());
			if (total>=10) {
				$("#myModal").modal("show");
				$("#child option:first").attr('selected','selected');
			}
		});
		$("#infant").change(function(){
			var total = parseInt(adult.val()) + parseInt(child.val()) + parseInt(infant.val());
			if (total>=10) {
				$("#myModal").modal("show");
				$("#infant option:first").attr('selected','selected');
			}
		});
	});

//COUNTS AIRLINES PASSENGER


//validate birthday flights

$(document).ready(function(){
	$(".infantbdate").blur(function(){
			var dob = $(this).val();
			if(dob != ''){
			    var str=dob.split('/');    
			    var firstdate=new Date(str[2],str[0],str[1]);
			    var today = new Date();        
			    var dayDiff = Math.ceil(today.getTime() - firstdate.getTime()) / (1000 * 60 * 60 * 24 * 365);
			    var age = parseInt(dayDiff);
			    if (age>2) {
			    	alert("Invalid Age for Infant");
			    	$(this).val("");

			    }
			    console.log(age);
			}
	});
});

$(document).ready(function(){
	$(".childbdate").blur(function(){
			var dob = $(this).val();
			if(dob != ''){
			    var str=dob.split('/');    
			    var firstdate=new Date(str[2],str[0],str[1]);
			    var today = new Date();        
			    var dayDiff = Math.ceil(today.getTime() - firstdate.getTime()) / (1000 * 60 * 60 * 24 * 365);
			    var age = parseInt(dayDiff);
			    if (age<=2 || age>=13) {
			    	alert("Invalid Age for Child");
			    	$(this).val("");

			    }
			    console.log(age);
			}
	});
});

$(document).ready(function(){
	$(".adultbdate").blur(function(){
			var dob = $(this).val();
			if(dob != ''){
			    var str=dob.split('/');    
			    var firstdate=new Date(str[2],str[0],str[1]);
			    var today = new Date();        
			    var dayDiff = Math.ceil(today.getTime() - firstdate.getTime()) / (1000 * 60 * 60 * 24 * 365);
			    var age = parseInt(dayDiff);
			    if (age<=12 || age>=60) {
			    	alert("Invalid Age for Adult");
			    	$(this).val("");

			    }
			    console.log(age);
			}
	});
});
$(document).ready(function(){
	$(".seniorbdate").blur(function(){
			var dob = $(this).val();
			if(dob != ''){
			    var str=dob.split('/');    
			    var firstdate=new Date(str[2],str[0],str[1]);
			    var today = new Date();        
			    var dayDiff = Math.ceil(today.getTime() - firstdate.getTime()) / (1000 * 60 * 60 * 24 * 365);
			    var age = parseInt(dayDiff);
			    if (age<60) {
			    	alert("Invalid Age for Senior");
			    	$(this).val("");

			    }
			    console.log(age);
			}
	});
});

//validate birthday flights