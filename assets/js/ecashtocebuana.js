
$(document).ready(function(){
	$('#frmAddCebuana,#frmCebuanaSearchSender').on('submit',function(){
	  waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
	});
});

$(document).ready(function() {
	var iframe = $('iframe#CebuanaAgreementiframe');
    $('#modalCebuanaAgreementframe').modal({show:true});
});


$(document).ready(function(){
    $('#SendersearchClientDiv *, #domesticRates *, #BenesearchNameDiv *').attr("disabled", true); 
	$('#frmCebuanaSearchSender input:radio').on('change', function() {
	var mySenderSearch = $('input[name=optradio]:checked', '#frmCebuanaSearchSender').val(); 
	// alert(mySenderSearch);
		if(mySenderSearch == 0){
			$('#SendersearchNameDiv *').removeAttr('disabled'); 
			$('#SendersearchClientDiv *').attr("disabled", true); 
		}else{
			$('#SendersearchClientDiv *').removeAttr('disabled'); 
			$('#SendersearchNameDiv *').attr("disabled", true); 
		}
	});

	$('#frmCebuanaSearchBene input:radio').on('change', function() {
	var myBeneSearch = $('input[name=optradio]:checked', '#frmCebuanaSearchBene').val(); 

		if(myBeneSearch == 0){
			$('#BenesearchNameDiv *').removeAttr('disabled'); 
			$('#BenesearchClientDiv *').attr("disabled", true); 
		}else{
			$('#BenesearchClientDiv *').removeAttr('disabled'); 
			$('#BenesearchNameDiv *').attr("disabled", true); 
		}
	});
	
	$('a[id=aFindCebuanaClient]').on('click',function(){
		var senderFname = $('#senderFname');
		var senderLname = $('#senderLname');
		var senderClientNo = $('#senderClientNo');
		var index = $(this).index('a[id=aFindCebuanaClient]');
		var data = $(this).data('id');
		var str =[];
		var i = 0;
		$(".tr").eq(index).find(".td").each(function() {   //GET information from table (HTML)
		   str[i] = $(this).text();
			i++;
		});	

		senderClientNo.val(str[1]);
		if (senderClientNo.val() != "") {
			$('#SenderRadioDiv *').attr('disabled',true);
			senderFname.attr('readonly',true);
			senderLname.attr('readonly',true);	
			senderFname.val(str[2]);
			senderLname.val(str[4]);
			$("h4#newClientModal").text('REGISTER NEW BENEFICIARY');
			$("a[id=btnNewClient]").html('<span class="glyphicon glyphicon-plus"></span> &nbsp;Register New Beneficiary');
			$("#newClientType").val('2');
			$('#divRefSenderID').css('display','block');
			$("#refSenderID").val(str[0]);
		}
	});


	$('a[id=btnAmendNewClient]').on('click',function(){
		var senderId= $('#inputSenderID').val();
		if (senderId != "") {
			$("h4#newClientModal").text('REGISTER NEW BENEFICIARY');
			$("#newClientType").val('2');
			$('#divRefSenderID').css('display','block');
			$("#addModalAmend").modal('show');
   			$("#frmAddCebuanaBene").find("input").val('').end();
   			$("#refSenderID").val(senderId);
		}
	});


	$("#frmAddCebuanaBene").on('submit',function(e){
		e.preventDefault();
		waitingDialog.show('Please wait..', {dialogSize: 'sm', progressType: 'primary'});

			var data_form = $('#frmAddCebuanaBene').serialize();

			$.ajax({
		        url: "/Ecash_send/add_beneficiary/",
		        type: "POST",
		        data:  data_form,
		        success: function(data){
		        	var jsondata = JSON.parse(data);
		        	console.log(data);
		            if(jsondata.S == 1){
		            	$('#addModalAmend').modal('hide');
						waitingDialog.hide();
						$(".alert").css('display','none');
		           		$("#alertDynammic").css('display','block');
		    			$("#alertDynammic").addClass("alert alert-success col-md-12 text-error alert-dismissable");
		    			$("#alertDynammic").html("<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + jsondata.M);
							$("#alertDynammic").fadeTo(6000, 1000).slideUp(1000, function(){
							  $("#alertDynammic").slideUp(1000);
							  $("#alertDynammic").removeClass();
							});

					}else{
						waitingDialog.hide();
		           		$("#alertDynammicModal").css('display','block');
		    			$("#alertDynammicModal").addClass("alert alert-danger col-md-12 text-error alert-dismissable");
		    			$("#alertDynammicModal").html("<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + jsondata.M);
							$("#alertDynammicModal").fadeTo(6000, 1000).slideUp(1000, function(){
							  $("#alertDynammicModal").slideUp(1000);
							  $("#alertDynammicModal").removeClass();
							});
					}
				
		        }
		    });
	});



	$("#example").on("click", ".aFindCebuanaClient", function() {
		var hiddenSenderInfo = $('#hiddenSenderInfo');
		waitingDialog.show('Searching for Beneficiary..', {dialogSize: 'md', progressType: 'primary'});
		var data = [];
	    $(this).closest('tr').find('td').each(function(){
	      data.push($(this).text());
	    });
	    console.log(data);
	    hiddenSenderInfo.val(data[0] + "|" + data[1] + "|" + data[2] + "|" + data[3] + "|" + data[4] + "|" + data[5]);

	    var senderid = data[0];
		var dt = $('#example').DataTable({
			"order": [[ 0, 'asc' ]],
			"bDestroy": true,
	        "columnDefs": [
	            {
	                "targets": [ 1 ],
	                "visible": false,
	                "searchable": false
	            }]
		});
		dt.clear().draw();
    console.log(this)

		$.ajax({
	        url: "/Ecash_send/get_beneficiary/"+senderid,
	        type: "POST",
	        // data:  new FormData(this),
	        contentType: false,
	        cache: false,
	        processData: false,
	        success: function(data){
	            var jsondata = JSON.parse(data);
	             console.log(jsondata);
	            if(jsondata.S == 1){
	        		waitingDialog.hide();
	           		$("#alertDynammic").css('display','block');
	    			$("#alertDynammic").addClass("alert alert-success col-md-12 text-error alert-dismissable");
	    			$("#alertDynammic").html("<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + jsondata.M);
						$("#alertDynammic").fadeTo(6000, 1000).slideUp(1000, function(){
						  $("#alertDynammic").slideUp(1000);
						  $("#alertDynammic").removeClass();
						});
					$("h4#tableHeader").text("Beneficiary Result/s :"+jsondata.M);
	            	$.each(jsondata.B_DATA, function (i, item) {
	            		dt.row.add( [
	            			item.B_ID,
	            			'',
	            			item.B_FN,
	            			item.B_MN,
	            			item.B_LN,
	            			item.B_BD.replace('T00:00:00',''),
	            			'<button class="btn btn-danger btnGetBene">Select</button>'			            
				        ] ).draw( false )
			        });	
	    		} else{
	        		waitingDialog.hide();
	        		$("h4#tableHeader").text("Beneficiary Result/s :"+jsondata.M);
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

	});


	$("#example").on("click", ".btnGetBene", function() {
		waitingDialog.show('Please wait..', {dialogSize: 'sm', progressType: 'primary'});
		var beneName = $('#beneName');
		var hiddenBeneInfo = $('#hiddenBeneInfo');
		var dropdown = $("#sel_currency");

		var str = [];
	    $(this).closest('tr').find('td').each(function(){
	      str.push($(this).text());
	    });
      console.log(str);
      
      console.log("this",this)

		$.ajax({
	        url: "/Ecash_send/get_currency",
	        type: "POST",
	        // data:  new FormData(this),
	        contentType: false,
	        cache: false,
	        processData: false,
	        success: function(data){
	            var jsondata = JSON.parse(data);
	            console.log(data);
	            if(jsondata.S == 1){
					waitingDialog.hide();
					$('.btnSender').hide();
					$('#BenesearchNameDiv').show();
					$('#domesticRates').show();
					$('#domesticRates *').removeAttr('disabled'); 
					beneName.val(str[1] + ' ' + str[2] + ' ' + str[3])
					hiddenBeneInfo.val(str[0] + "|" + str[1] + "|" + str[2] + "|" + str[3] + "|" + str[4]);
	            	$.each(jsondata.C_DATA, function (i, item) {
					dropdown.append('<option value="'+item.CUR_ID+'|'+item.CUR_DESC+'">'+ item.CUR_CODE +'</option>');
			        });
			        dropdown.focus();
					$('.btnCebuanaRates').show();
	            }
	        }
	    });

	});


	$("#frmDomesticRates").on('submit',function(e){
			e.preventDefault();
			waitingDialog.show('Please wait..', {dialogSize: 'sm', progressType: 'primary'});
			var currencydesc = $("#sel_currency option:selected").text();
			var currency = $("#sel_currency").val().split('|');
			var amount = $("#amount").val();

				$.ajax({
			        url: "/Ecash_send/get_domestic_rates/"+currency[0]+"/"+amount,
			        type: "POST",
			        data:  new FormData(this),
			        contentType: false,
			        cache: false,
			        processData: false,
			        success: function(data){
			        	var jsondata = JSON.parse(data);
			        	console.log(data);
			            if(jsondata.S == 1){
							waitingDialog.hide();
			            	$('#currency').val(currencydesc+' - '+currency[1]);
			            	$('#p_amount').val(amount);
			            	$('#charge').val(jsondata.SF);
			            	$('#total').val(jsondata.TA);
			            	$("#myModal").modal('show');
						}
					
			        }
			    });
	});


	$("#myModal").on("click", "#btnConfirm", function() {
		$("#myModal").toggle();
		var currencydesc = $("#sel_currency option:selected").text();
		var currency = $("#sel_currency").val().split('|');
		var hiddenBeneInfo = $('#hiddenBeneInfo').val().split('|');
		var hiddenSenderInfo = $('#hiddenSenderInfo').val().split('|');
		var amount = $('#p_amount').val();
		var charge = $('#charge').val();
		var total = $('#total').val();

		$('#senderid').val(hiddenSenderInfo[0]);
		$('#sender_name').val(hiddenSenderInfo[2] + ' ' + hiddenSenderInfo[3] + ' ' + hiddenSenderInfo[4]);
		$('#sender_bdate').val(hiddenSenderInfo[5]);	
		$('#beneid').val(hiddenBeneInfo[0]);	
		$('#bene_name').val(hiddenBeneInfo[1] + ' ' + hiddenBeneInfo[2] + ' ' + hiddenBeneInfo[3]);
		$('#bene_bdate').val(hiddenBeneInfo[4]);	
    	$('#icurrency').val(currencydesc+' - '+currency[1]);
    	$('#iamount').val(amount);
    	$('#icharge').val(charge);
    	$('#itotal').val(total);
    	$('#hiddenSenderDetails').val($('#hiddenSenderInfo').val());
    	$('#hiddenBeneDetails').val($('#hiddenBeneInfo').val());
    	$('#currency_id').val(currency[0]);
		$("#remittanceSummaryModal").modal('show');

	});


});


	$('.dropdown-menu li').on("click",".aChangeBeneficiary",function() {
		waitingDialog.show('Searching for Beneficiary..', {dialogSize: 'md', progressType: 'primary'});
	    var senderid = $('#inputSenderID').val();
		var dt = $('#changeBeneficiary').DataTable();
		dt.clear().draw();


		$.ajax({
	        url: "/Ecash_send/get_beneficiary/"+senderid,
	        type: "POST",
	        data:  new FormData(this),
	        contentType: false,
	        cache: false,
	        processData: false,
	        success: function(data){
	            var jsondata = JSON.parse(data);
	             //console.log(jsondata);
	            if(jsondata.S == 1){
	        		waitingDialog.hide();
					$("#myModal").modal('show');	
					$("h4#tableHeader").text("Beneficiary Result/s :"+jsondata.M);
	            	$.each(jsondata.B_DATA, function (i, item) {
	            		dt.row.add( [
	            			item.B_ID,
	            			item.B_FN,
	            			item.B_MN,
	            			item.B_LN,
	            			item.B_BD,
	            			'<button class="btn btn-danger btnGetNewBene">Select</button>'			            
				        ] ).draw( false )
			        });	
	    		}else{
	    			waitingDialog.hide();
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


	});


		$("#changeBeneficiary").on("click", ".btnGetNewBene", function() {
		waitingDialog.show('Please wait..', {dialogSize: 'sm', progressType: 'primary'});
		var beneID = $('#inputNewBeneficiaryID');
		var beneFname = $('#inputNewBeneficiaryFName');
		var beneMname = $('#inputNewBeneficiaryMName');
		var beneLname = $('#inputNewBeneficiaryLName');
		var beneBdate = $('#inputNewBeneficiaryBdate');
		var newBeneID = $('#newBeneID');

		var str = [];
	    $(this).closest('tr').find('td').each(function(){
	      str.push($(this).text());
	    });
	    //console.log(str);
	    waitingDialog.hide();
	    $('#myModal').modal('hide');
	    beneID.val(str[0]);
	    beneFname.val(str[1]);
	    beneMname.val(str[2]);
	    beneLname.val(str[3]);
		beneBdate.val(str[4]);	
		newBeneID.val(str[0]);	

		if(newBeneID){
			$('#btnCebuanaAmmend').removeAttr('disabled','disabled');
		}

	});


	$('#btnCebuanaAmmend').on('click',function(){
		waitingDialog.show('Please wait..', {dialogSize: 'sm', progressType: 'primary'});	
			var beneFname = $('#inputNewBeneficiaryFName').val();
			var beneMname = $('#inputNewBeneficiaryMName').val();
			var beneLname = $('#inputNewBeneficiaryLName').val();
			var controlnumber = $('#controlnumber').val();
			var newBeneID = $('#newBeneID').val();
			var curid  = $('#inputCurrencyID').val();
			var amount = $('#inputPAmount').val();
			var parameters = {curid:curid,amount:amount};
			//console.log(parameters);

			$.ajax({
		        url: "/Ecash_send/get_amendment_fee",
		        type: "POST",
		        data:  parameters,
		        success: function(data){
		            var jsondata = JSON.parse(data);
		            console.log(data);
		            if(jsondata.S == 1){
						waitingDialog.hide();
						$("p#ammendMessage").text(jsondata.M);
						$('#inputAmmendFee').val(jsondata.SF);
						$('#inputAmmendDetails').val(newBeneID+'|'+beneFname+'|'+beneMname+'|'+beneLname+'|'+controlnumber);
						$('#myAmmendmentModal').modal('show');
		            }else{
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

	});

	
	function closeIframe() {
	    var iframe = document.getElementById('modalCebuanaAgreementframe');
	    iframe.parentNode.removeChild(iframe);
  	}

	$("#frmAgreeTermsnCondition").on('submit',function(e){
		e.preventDefault();
		waitingDialog.show('Please wait..', {dialogSize: 'sm', progressType: 'primary'});

			$.ajax({
		        url: "/Ecash_payout/cebuanaconfirmAgreement/",
		        type: "POST",
		        data:  new FormData(this),
		        contentType: false,
		        cache: false,
		        processData: false,
		        success: function(data){
		        	var jsondata = JSON.parse(data);
		        	console.log(data);
		            if(jsondata.S == 1){
						waitingDialog.hide();
						$('#modalCebuanaAgreementframe').modal('hide');
		           		$("#alertDynammic").css('display','block');
		    			$("#alertDynammic").addClass("alert alert-success col-md-12 text-error alert-dismissable");
		    			$("#alertDynammic").html("<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + jsondata.M);
							$("#alertDynammic").fadeTo(6000, 1000).slideUp(1000, function(){
							  $("#alertDynammic").slideUp(1000);
							  $("#alertDynammic").removeClass();
							});
					}else{
						waitingDialog.hide();
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
	});