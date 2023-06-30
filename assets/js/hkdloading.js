	
	// $(document).ready(function(){
	// 	$('#frmHKD').on('submit',function(){
	// 	  waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
	// 	});
	// });


	$(".frmHKDLoading").on('submit',function(e){
		var btnValidate = $("#btnValidate").val();
		var transpass = $("#transpass").val();
		var sign_captcha = $("#inputCaptcha").val();
		var email = $("#inputEmail").val();
		var plancode = $("#selProd").val();

		if($("#inputRMobile").val().length != ''){ var mobile = $("#inputRMobile").val(); }else{ var mobile = '0'; }
		e.preventDefault();
		waitingDialog.show('Please wait..', {dialogSize: 'sm', progressType: 'primary'});

		if(btnValidate == 1) {

		var parameters = {sign_captcha:sign_captcha,mobile:mobile,email:email,plancode:plancode};

			$.ajax({
		        url: "/International_loading/hkd_loading_validation/",
		        type: "POST",
		        data: parameters,
		        success: function(data){
		        	var jsondata = JSON.parse(data);
		        	console.log(data);
		        	waitingDialog.hide();
		            if(jsondata.S == 1){
						$("#formTranspass").css('display','block');
						$("#transpass").attr('required',true);
						$("#formWhatsCaptcha,#formCaptcha").css('display','none');
						$("#inputCaptcha").removeAttr('required','required');
						$("#selProd").attr('readonly',true);
						$('#btnValidate').val('0');
						$("#btnValidate").html('Confirm');

		           		$("#alertDynammic").css('display','block');
		    			$("#alertDynammic").addClass("alert alert-success col-md-12 text-error alert-dismissable");
		    			$("#alertDynammic").html("<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + jsondata.M);
							$("#alertDynammic").fadeTo(6000, 1000).slideUp(1000, function(){
							  $("#alertDynammic").slideUp(1000);
							  $("#alertDynammic").removeClass();
							});
					}else{
						$('#modalCebuanaAgreementframe').modal('hide');
		           		$("#alertDynammic").css('display','block');
		    			$("#alertDynammic").addClass("alert alert-danger col-md-12 text-error alert-dismissable");
		    			$("#alertDynammic").html("<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + jsondata.M);
							$("#alertDynammic").fadeTo(6000, 1000).slideUp(1000, function(){
							  $("#alertDynammic").slideUp(1000);
							  $("#alertDynammic").removeClass();
							});
					}
				
		        }
		    });
		} else{

		var parameters = {btnConfirm:1,mobile:mobile,email:email,plancode:plancode,transpass:transpass};

			$.ajax({
		        url: "/International_loading/hkd_loading_confirmation/",
		        type: "POST",
		        data: parameters,
		        success: function(data){
		        	var jsondata = JSON.parse(data);
		        	console.log(data);
		        	waitingDialog.hide();
		        	if(jsondata.S == 1){
		        		$("#selProd").removeAttr('readonly','readonly');
		        		$(".frmHKDLoading").closest('form').find("input[type=text],input[type=email],input[type=password], select").val("");
		        		$("#frmHKD").closest('form').find("input[type=text],input[type=email],input[type=password], select").val("");
		           		$("#alertDynammic").css('display','block');
		    			$("#alertDynammic").addClass("alert alert-success col-md-12 text-error alert-dismissable");
		    			$("#alertDynammic").html("<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>"+ jsondata.M +"<p>Transaction No.: "+ jsondata.TN +"</p></b>"+"<p>For the receipt click this link <b><a href='"+ jsondata.URL +"' target='_blank'>"+jsondata.URL+"</a></b></p>");
							$("#alertDynammic").fadeTo(30000, 5000).slideUp(5000, function(){
							  $("#alertDynammic").slideUp(10000);
							  $("#alertDynammic").removeClass();
							});
		        	} else{
		           		$("#alertDynammic").css('display','block');
		    			$("#alertDynammic").addClass("alert alert-danger col-md-12 text-error alert-dismissable");
		    			$("#alertDynammic").html("<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + jsondata.M);
							$("#alertDynammic").fadeTo(6000, 1000).slideUp(1000, function(){
							  $("#alertDynammic").slideUp(1000);
							  $("#alertDynammic").removeClass();
							});
		        	}
		        }

		    });    	
		}


	});
