// $(".btnOTPPaymayaResend").on("click", function () {
//   var trackno = $("input[name='inputReferenceNo']").val();

//   if (!trackno || trackno == ' ' || trackno == undefined) {
//     $('#inputReferenceNo').css('border', '1px solid red');
//     $(".resendingPaymayaOTPcode").css('display', 'none');
//   } else {
//     $(".resendingPaymayaOTPcode").css('display', 'block');
//     var parameters = { trackno: trackno };
//     $.ajax({
//       type: 'POST',
//       url: "/Ecash_send_jrlvaldez/ecash_to_paymaya_otp_resend",
//       data: parameters,
//       success: function (msg) {
//         $(".resendingPaymayaOTPcode").css('display', 'none');
//         $(".alert-warning").hide();
//         var msgDone = JSON.parse(msg);
//         console.log(msgDone);

//         var arrCSSOTP = {
//           'color': '#3c763d', 'background-color': '#dff0d8',
//           'border-color': '#d6e9c6', 'padding': '15px',
//           'margin-bottom': '20px', 'border': '1px solid transparent',
//           'border-radius': '4px'
//         };

//         if (msgDone.S != 1) {
//           arrCSSOTP['color'] = "#3c763d";
//           arrCSSOTP['background-color'] = "#dff0d8";
//           arrCSSOTP['border-color'] = "#d6e9c6";
//         }

//         $('#otpMessage').removeAttr('style');
//         $('#otpMessage').attr('style');
//         $('#otpMessage').css(arrCSSOTP);
//         $('#otpMessage').text(msgDone.M);

//         $('#otpMessage').delay(5000).fadeOut();
//       }
//     });
//   }
// });

// $(".checkPA").on("click", function () {
//   // alert($(this).val());
//   var $this = $(this);

//   // alert($this.is(':checked'));

//   if ($this.is(':checked')) {
//     var inputprhouseNumber = $("#frmAddEcashPadala input[name='inputprhouseNumber']").val();
//     var inputprstreet = $("#frmAddEcashPadala input[name='inputprstreet']").val();
//     var inputprbarangay = $("#frmAddEcashPadala input[name='inputprbarangay']").val();
//     var inputprcity = $("#frmAddEcashPadala input[name='inputprcity']").val();
//     var inputprprovince = $("#frmAddEcashPadala input[name='inputprprovince']").val();
//     var inputprzipCode = $("#frmAddEcashPadala input[name='inputprzipCode']").val();
//     var prhouseNumber = $("#frmAddEcashPadala select[name='inputprcountry']").val();

//     // alert(prhouseNumber);

//     $("#frmAddEcashPadala input[name='inputpmhouseNumber']").val(inputprhouseNumber);
//     $("#frmAddEcashPadala input[name='inputpmstreet']").val(inputprstreet);
//     $("#frmAddEcashPadala input[name='inputpmbarangay']").val(inputprbarangay);
//     $("#frmAddEcashPadala input[name='inputpmcity']").val(inputprcity);
//     $("#frmAddEcashPadala input[name='inputpmprovince']").val(inputprprovince);
//     $("#frmAddEcashPadala input[name='inputpmzipCode']").val(inputprzipCode);
//     $("#frmAddEcashPadala select[name='inputpmcountry']").val(prhouseNumber);

//     $('.checkread').attr('readonly', true);

//   } else {

//     $("#frmAddEcashPadala input[name='inputpmhouseNumber']").val('');
//     $("#frmAddEcashPadala input[name='inputpmstreet']").val('');
//     $("#frmAddEcashPadala input[name='inputpmbarangay']").val('');
//     $("#frmAddEcashPadala input[name='inputpmcity']").val('');
//     $("#frmAddEcashPadala input[name='inputpmprovince']").val('');
//     $("#frmAddEcashPadala input[name='inputpmzipCode']").val('');
//     $("#frmAddEcashPadala select[name='inputpmcountry']").val('');

//     $('.checkread').attr('readonly', false);
//   }

// });


// $("#frmAddEcashPadala input[name='inputprhouseNumber']").on("input", function () {
//   // alert($(this).val()); 
//   var getvalue = $(this).val();
//   var checksss = $("input[name='checkPA']").is(':checked');

//   if (checksss === true) {
//     $("#frmAddEcashPadala input[name='inputpmhouseNumber']").val(getvalue);
//   }
// });

// $("#frmAddEcashPadala input[name='inputprstreet']").on("input", function () {
//   // alert($(this).val()); 
//   var getvalue = $(this).val();
//   var checksss = $("input[name='checkPA']").is(':checked');

//   if (checksss === true) {
//     $("#frmAddEcashPadala input[name='inputpmstreet']").val(getvalue);
//   }
// });

// $("#frmAddEcashPadala input[name='inputprbarangay']").on("input", function () {
//   // alert($(this).val()); 
//   var getvalue = $(this).val();
//   var checksss = $("input[name='checkPA']").is(':checked');

//   if (checksss === true) {
//     $("#frmAddEcashPadala input[name='inputpmbarangay']").val(getvalue);
//   }
// });

// $("#frmAddEcashPadala input[name='inputprcity']").on("input", function () {
//   // alert($(this).val()); 
//   var getvalue = $(this).val();
//   var checksss = $("input[name='checkPA']").is(':checked');

//   if (checksss === true) {
//     $("#frmAddEcashPadala input[name='inputpmcity']").val(getvalue);
//   }
// });

// $("#frmAddEcashPadala input[name='inputprprovince']").on("input", function () {
//   // alert($(this).val()); 
//   var getvalue = $(this).val();
//   var checksss = $("input[name='checkPA']").is(':checked');

//   if (checksss === true) {
//     $("#frmAddEcashPadala input[name='inputpmprovince']").val(getvalue);
//   }
// });

// $("#frmAddEcashPadala input[name='inputprzipCode']").on("input", function () {
//   // alert($(this).val()); 
//   var getvalue = $(this).val();
//   var checksss = $("input[name='checkPA']").is(':checked');

//   if (checksss === true) {
//     $("#frmAddEcashPadala input[name='inputpmzipCode']").val(getvalue);
//   }
// });

// $("#frmAddEcashPadala select[name='inputprcountry']").change(function () {
//   // alert($(this).val()); 
//   var getvalue = $(this).val();
//   var checksss = $("input[name='checkPA']").is(':checked');

//   if (checksss === true) {
//     $("#frmAddEcashPadala select[name='inputpmcountry']").val(getvalue);
//   }
// });

// $(document).ready(function () {
//   $("#frmSSeachRemit, #frmBSeachRemit").on("submit", function () {

//     waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'primary' });
//   });
// });


// function RefreshListwestern() {
//   //console.log('putek');
//   waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'primary' });
//   $("#id_details1_western").hide();
//   $("#id_details2_western").hide();
//   $("#id_details3_western").hide();
//   waitingDialog.hide();
//   westernfetchpayoutIDs();
// }

// $("#frmWesternPayout").on("submit", function (event) {
//   event.preventDefault();
//   waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'primary' });

//   var refno = $("#frmWesternPayout #inputReferenceNo").val();
//   var transpass = $("#frmWesternPayout #inputTpass").val();
//   var sender_id = $("#frmWesternPayout #inputSenderID").val();
//   var beneficiary_id = $("#frmWesternPayout #inputBeneficiaryID").val();
//   var amount = $("#frmWesternPayout #inputPRINAmount").val();
//   var currency = $("#frmWesternPayout #currency").val().split('|');
//   var primaryId = $("#frmWesternPayout #selvalidID1_western").val();
//   var secondaryId = $("#frmWesternPayout #selvalidID2_western").val();
//   var tertiaryId = $("#frmWesternPayout #selvalidID3_western").val();
//   var country = $("#frmWesternPayout #country_iso").val();
//   var occupation = $("#frmWesternPayout #inputOccupation").val();
//   var relationbene = $("#frmWesternPayout #inputRelationshiptoBene").val();
//   var empname = $("#frmWesternPayout #inputEmployer").val();
//   var fundsrc = $("#frmWesternPayout #inputSourceofFund").val();
//   var countrybirth = $("#frmWesternPayout #inputCountryBirth").val();
//   var nationality = $("#frmWesternPayout #inputNationality").val();

//   var parameters = { refno: refno, transpass: transpass, sender_id: sender_id, beneficiary_id: beneficiary_id, amount: amount, currency: currency[0], primaryId: primaryId, secondaryId: secondaryId, tertiaryId: tertiaryId, country: country, occupation: occupation, relationbene: relationbene, empname: empname, fundsrc: fundsrc, countrybirth: countrybirth, nationality: nationality };
//   // console.log(parameters);

//   $.ajax({
//     url: "/Ecash_payout/ecash_to_western_payout_request",
//     type: "POST",
//     data: parameters,
//     success: function (data) {
//       var jsondata = JSON.parse(data);
//       // console.log(jsondata);

//       waitingDialog.hide();
//       if (jsondata.S == 1) {

//         $("#alertDynammic").css('display', 'block');
//         $("#alertDynammic").addClass("alert alert-success col-md-12 text-error alert-dismissable");
//         $("#alertDynammic").html("<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + jsondata.M + "<br><b><u>Tracking Number: " + jsondata.TN + "</u></b>");
//         $("#alertDynammic").fadeTo(8000, 6000).slideUp(6000, function () {
//           $("#alertDynammic").slideUp(6000);
//           $("#alertDynammic").removeClass();
//         });
//         setTimeout(function () {
//           gotoEnd();
//         }, 8000);
//       } else {
//         $("#alertDynammic").css('display', 'block');
//         $("#alertDynammic").addClass("alert alert-danger col-md-12 text-error alert-dismissable");
//         $("#alertDynammic").html("<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + jsondata.M);
//         $("#alertDynammic").fadeTo(6000, 4000).slideUp(4000, function () {
//           $("#alertDynammic").slideUp(4000);
//           $("#alertDynammic").removeClass();
//         });
//       }
//     }
//   });
// });


// $('a[id=aCancel]').on('click', function () {
//   var txnCancel = $(this).data('id');
//   $('#myModal').modal('show');
//   $('p[id=txnCanceltext]').text('Transaction Number: ' + txnCancel);
//   $('#inputTxnCancel').val(txnCancel);
// });


// $('a[id=btnBack]').on('click', function () {
//   var base_url = window.location.origin;
//   var pathArray = window.location.pathname;

//   var url = base_url + pathArray;
//   var to = url.lastIndexOf('/') + 1;
//   newURL = url.substring(0, to);
//   window.location = newURL;
// });

// $(document).ready(function () {
//   $('.westernTable').DataTable({
//     "searching": true
//   });
// });

// $("#frmPaymayaSender").on("submit", function (event) {
//   event.preventDefault();
//   // waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'primary' });
//   waitingDialog.hide();
//   var parameters = {
//     transpass: $("#frmPaymayaSender #inputTpass").val(),
//     accountNo: $("#frmPaymayaSender #inputAccountno").val(),
//     amount: $("#frmPaymayaSender #inputPRINAmount").val(),
//     charge: 1,
//     senderId: $("#frmPaymayaSender #selvalidID1_western").val(),
//     channel: $("#frmPaymayaSender #channel").val(),
//     sender: $("#frmPaymayaSender #inputSenderID").val(),
//     beneficiary: $("#frmPaymayaSender #inputBeneficiaryID").val()
//   };
//   waitingDialog.hide();
//   $.ajax({
//     type: 'POST',
//     url: "/Ecash_send_jrlvaldez/ecash_to_paymaya_send",
//     data: parameters,
//     success: function (data) {
//       waitingDialog.hide();
//       var jsondata = JSON.parse(data);
//       waitingDialog.hide();
//       var alertType = jsondata.S == 1 ? "success" : "";
//       var txtTrackingNumber = "";

//       if (jsondata.S == 1 || jsondata.S == 2 || jsondata.S == 3) {
//         txtTrackingNumber = "<br><b><u>Tracking Number: " + jsondata.TN + "</u></b>";
//       }

//       if (jsondata.S == 2 || jsondata.S == 3) {
//         alertType = "warning";
//       } else if (jsondata.S != 1) {
//         alertType = "danger";
//       }

//       $("#alertDynammic").css('display', 'block');
//       $("#alertDynammic").addClass("alert alert-" + alertType + " col-md-12 text-error alert-dismissable");
//       $("#alertDynammic").html("<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + jsondata.M + txtTrackingNumber);

//       if (jsondata.S != 3) {
//         $("#alertDynammic").fadeTo(8000, 6000).slideUp(6000, function () {
//           $("#alertDynammic").slideUp(6000);
//           $("#alertDynammic").removeClass();
//         });
//         if (jsondata.S == 1 || jsondata.S == 2) {
//           // setTimeout(function () {
//           //   gotoEnd();
//           // }, 10000);

//           alert("Redirect Happens");
//         } else {
//           $("#stepOne").css('display', 'none');
//           $("#stepTwo").css('display', 'block');
//           $("#stepThree").css('display', 'none');
//         }
//       } else {
//         $("#stepOne").css('display', 'none');
//         $('#stepThree .unholdRefno').val(jsondata.TN);
//         $("#stepTwo").css('display', 'none');
//         $("#stepThree").css('display', 'block');
//       }

//       $("#alertDynammic").focus();
//     }
//   });

//   waitingDialog.hide();
// });

// $('a[id=btnCancelWestern]').on('click', function () {
//   setTimeout(function () {
//     waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'primary' });
//   }, 2000);

//   gotoEnd();
// });

// function gotoEnd() {
//   var base_url = window.location.origin;
//   var pathArray = window.location.pathname;

//   window.location = base_url + pathArray;
// }

// $(document).ready(function () {
//   $("#frmPaymayaSender, #frmWesternCancel").on("submit", function () {

//     waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'primary' });
//   });
// });

// $("#country_iso").change(function () {
//   $('#inputPRINAmount').prop("disabled", false);
//   $('#inputPRINAmount, #inputSCAmount').val('');
//   $('#currency option:eq(0)').prop('selected', true);
// });

// $(document).ready(function () {

//   $('#inputPRINAmount').on('keyup', function () {
//     $('#currency').prop("disabled", false);
//     get_country_charge();
//   });


//   $("#currency").change(function () {
//     get_country_charge();
//   });

// });


// function get_country_charge() {
//   $('#inputSCAmount, #inputTotalAmount').css("display", "none");
//   $('.spinAnimationWesternCharge').css("display", "block");

//   var country = $('#country_iso').val();
//   var amount = $('#inputPRINAmount').val();
//   var currency = $('#currency').val().split('|');

//   var parameters = { country: country, amount: amount, currency: currency[0] };

//   $.ajax({
//     url: "/Ecash_send/get_country_charge",
//     type: "POST",
//     data: parameters,
//     success: function (data) {
//       var jsondata = JSON.parse(data);

//       $('#inputSCAmount, #inputTotalAmount').css("display", "block");
//       $('.spinAnimationWesternCharge').css("display", "none");

//       if (jsondata.S == 1) {
//         if (currency[0] == 'PHP') {
//           var totalamount = parseFloat(amount) + parseFloat(jsondata.C);
//           $('#inputSCAmount').val(jsondata.C);
//           $('#inputTotalAmount').val(totalamount.toFixed(2));
//         } else {
//           var sc = parseFloat(jsondata.C) / parseFloat(currency[1]);
//           var totalamount = parseFloat(amount) + parseFloat(sc);
//           $('#inputSCAmount').val(sc.toFixed(2));
//           $('#inputTotalAmount').val(totalamount.toFixed(2));
//         }
//       } else {
//         $('#inputSCAmount').css({ 'border-color': 'red', 'border-width': 'initial' });
//         $('#inputSCAmount').val("Invalid Amount");
//       }
//     }
//   });

// }

// if ($('#inputPaymayaSenderName').val() == "") {
//   $('#inputPaymayaBeneficiaryName').attr('readonly', true);
//   $("#inputSenderHide").val()

// } else {
//   $('#inputPaymayaSenderName').attr('readonly', true);
//   $('#inputPaymayaBeneficiaryName').focus();

// }

// $('a[id=aFindPaymaya]').on('click', function () {

//   var index = $(this).index('a[id=aFindPaymaya]');
//   var data = $(this).data('id').split('|');
//   var sender = $('#inputPaymayaSenderName');
//   var beneficiary = $('#inputPaymayaBeneficiaryName');
//   var inputSenderHide = $("#inputSenderHide");
//   var inputBeneficiaryHide = $("#inputBeneficiaryHide");
//   var str = [];
//   var i = 0;
//   //console.log(inputBeneficiaryHide);

//   $(".tr").eq(index).find(".td").each(function () {   //GET information from table (HTML)
//     str[i] = $(this).text();
//     i++;
//   });

//   if (data[0] == 1) {
//     sender.val(str[1]);
//     if (sender.val() != "") {
//       beneficiary.removeAttr('readonly');
//       sender.attr('readonly', true);
//       beneficiary.focus();
//       inputSenderHide.val(str[0] + "|" + str[1] + "|" + str[2] + "|" + str[3] + "|" + str[4] + "|" + str[5] + "|" + str[6]);
//     }
//   }
//   else if (data[0] == 2) {

//     $('.btnProceedWestern').show();
//     beneficiary.val(str[1]);
//     inputBeneficiaryHide.val(str[0] + "|" + str[1] + "|" + str[2] + "|" + str[3] + "|" + str[4] + "|" + str[5] + "|" + str[6]);
//   }

// });


// $('.btnProceedWestern').click(function () {
//   var inputSenderHide = $("#inputSenderHide").val().split('|');
//   var inputBeneficiaryHide = $("#inputBeneficiaryHide").val().split('|');
//   var transtype = $('a[id=aFindPaymaya]').data('id').split('|');

//   $("#stepOne").css('display', 'none');

//   // sender
//   $('#inputSenderID').val(inputSenderHide[0]);
//   $('#inputSenderName').val(inputSenderHide[1]);
//   $('#inputSenderBday').val(inputSenderHide[2]);
//   $('#inputMobileNo').val(inputSenderHide[3]);
//   $('#inputSenderOccupation').val(inputSenderHide[4]);
//   // beneficiary
//   $('#inputBeneficiaryID').val(inputBeneficiaryHide[0]);
//   $('#inputBeneficiaryName').val(inputBeneficiaryHide[1]);
//   $('#inputBeneficiaryAddress').val(inputBeneficiaryHide[2]);
//   $('#inputBeneficiaryMobile').val(inputBeneficiaryHide[3]);
//   $('#inputBeneficiaryEmail').val(inputBeneficiaryHide[4]);
//   $('#benefbdate').val(inputBeneficiaryHide[8]);

//   $("#stepTwo").css('display', 'block');
//   $("#id_details2_western").hide();
//   $("#id_details3_western").hide();

//   // if(transtype[1] != 'PAYOUT'){
//   westernfetchpayoutIDs();
//   // }

// });


// var getidcount = 0;
// var new_id_rule = [];


// function removeOptionsWestern(selectbox) {
//   var i;
//   for (i = selectbox.options.length - 1; i >= 0; i--) {
//     selectbox.remove(i);
//   }
// }

// function westernfetchpayoutIDs() {
//   var transtype = $('a[id=aFindPaymaya]').data('id').split('|');
//   //console.log(transtype);

//   getidcount = 0;

//   if (transtype[1] != 'PAYOUT') {
//     var senderDetails = $("#inputSenderHide").val().split('|');
//   } else {
//     var senderDetails = $("#inputBeneficiaryHide").val().split('|');
//   }

//   //console.log(senderDetails);
//   var benefname = senderDetails[5];
//   var benemname = senderDetails[6];
//   var benelname = senderDetails[7];
//   var benebdate = senderDetails[8];

//   var parameters = { benefname: benefname, benemname: benemname, benelname: benelname, benebdate: benebdate };

//   if (getidcount === 0) {
//     $.ajax({
//       url: "/Ecash_payout/fetch_payout_id",
//       type: "POST",
//       data: parameters,
//       success: function (data) {
//         var jsondata = JSON.parse(data);

//         if (jsondata.S == 1) {

//           $("#spinAnimationWestern1, #spinAnimationWestern2").css("display", "none");
//           $("#selvalidID1_western, #selvalidID2_western").css("display", "block");
//           $("#selvalidID1_western, #selvalidID2_western").prop("disabled", false);
//           $("#id_details1_western, #id_details2_western, #id_details3_western").hide();


//           removeOptionsWestern(document.getElementById("selvalidID1_western"));
//           removeOptionsWestern(document.getElementById("selvalidID2_western"));
//           removeOptionsWestern(document.getElementById("selvalidID3_western"));

//           var select1 = document.getElementById("selvalidID1_western");
//           var select2 = document.getElementById("selvalidID2_western");
//           var select3 = document.getElementById("selvalidID3_western");

//           var el1 = document.createElement("option");
//           el1.textContent = '--CHOOSE VALID ID--';
//           el1.value = '';
//           el1.disabled = true;
//           el1.selected = true;
//           select1.appendChild(el1);

//           var el2 = document.createElement("option");
//           el2.textContent = '--CHOOSE VALID ID--';
//           el2.value = '';
//           el2.disabled = true;
//           el2.selected = true;
//           select2.appendChild(el2);

//           var el3 = document.createElement("option");
//           el3.textContent = '--CHOOSE VALID ID--';
//           el3.value = '';
//           el3.disabled = true;
//           el3.selected = true;
//           select3.appendChild(el3);


//           for (var index in jsondata.T_DATA) {

//             var attachment = jsondata.T_DATA[index].attachment;
//             var created = jsondata.T_DATA[index].created;
//             var description = jsondata.T_DATA[index].description;
//             var expiry = jsondata.T_DATA[index].expiry;
//             var is_expired = jsondata.T_DATA[index].is_expired;
//             var number = jsondata.T_DATA[index].number;
//             var id = jsondata.T_DATA[index].id;


//             var el1 = document.createElement("option");
//             el1.textContent = description;
//             el1.value = id;
//             select1.appendChild(el1);

//             var el2 = document.createElement("option");
//             el2.textContent = description;
//             el2.value = id;
//             select2.appendChild(el2);

//             var el3 = document.createElement("option");
//             el3.textContent = description;
//             el3.value = id;
//             select3.appendChild(el3);
//           }


//           var el1 = document.createElement("option");
//           el1.textContent = '--ADD NEW ID--';
//           el1.value = 'add_id';
//           select1.appendChild(el1);

//           var el2 = document.createElement("option");
//           el2.textContent = '--ADD NEW ID--';
//           el2.value = 'add_id';
//           select2.appendChild(el2);

//           var el3 = document.createElement("option");
//           el3.textContent = '--ADD NEW ID--';
//           el3.value = 'add_id';
//           select3.appendChild(el3);
//         }
//       }
//     });
//     getidcount++;
//   }
// }

// var countnew = 0;

// function fetch_remitpayout_id_types_western(descselect) {

//   var transtype = $('a[id=aFindPaymaya]').data('id').split('|');
//   //console.log(transtype);

//   if (transtype[1] != 'PAYOUT') {
//     var senderDetails = $("#inputSenderHide").val().split('|');
//   } else {
//     var senderDetails = $("#inputBeneficiaryHide").val().split('|');
//   }

//   //console.log(senderDetails);

//   var benefname = senderDetails[5];
//   var benemname = senderDetails[6];
//   var benelname = senderDetails[7];
//   var benebdate = senderDetails[8];

//   var parameters = { benefname: benefname, benemname: benemname, benelname: benelname, benebdate: benebdate };
//   // console.log(parameters);
//   $.ajax({
//     url: "/Ecash_payout/fetch_remitpayout_id_types",
//     type: "POST",
//     data: parameters,

//     success: function (data) {
//       var jsondata = JSON.parse(data);

//       if (jsondata.S == 1) {

//         if (countnew == 0) {

//           for (var index in jsondata.T_DATA) {

//             var id = jsondata.T_DATA[index].id;
//             var desc = jsondata.T_DATA[index].description;
//             var rule = jsondata.T_DATA[index].rule;
//             var expirable = jsondata.T_DATA[index].expirable;

//             var select = document.getElementById("newidtype");

//             var el = document.createElement("option");
//             el.textContent = desc;
//             el.value = id;
//             select.appendChild(el);

//             new_id_rule.push({ id: id, "rule": rule, "expirable": expirable });

//             countnew++;
//           }

//         }

//         var dd = document.getElementById('newidtype');

//         for (var i = 0; i < dd.options.length; i++) {
//           if (dd.options[i].text === descselect) {
//             dd.selectedIndex = i;
//             break;
//           }
//         }
//       }


//     }
//   });
// }
// var create_new = 0;
// /* GET ID DETAILS ON CHANGE OF ID#1*/
// $("#selvalidID1_western").change(function () {
//   // Get the selected value
//   var selected = $("option:selected", $(this)).val();
//   // Get the ID of this element
//   var thisID = $(this).prop("id");
//   // Reset so all values are showing:
//   $(".preferenceSelectwestern option").each(function () {
//     if ($(this).prop("value") != '' || $(this).prop("value") != 'add_id') {
//       $(this).prop("disabled", false);
//     }
//   });

//   $(".preferenceSelectwestern").each(function () {
//     if ($(this).prop("id") != thisID) {

//       $("option[value='" + selected + "']", $(this)).prop("disabled", true);
//     }
//   });

//   $modal = $('#myModalWestern');
//   $("#spinAnimationWestern3").css("display", "none");
//   $("#newidtype").css("display", "block");

//   var id1_val = $("#selvalidID1_western").val();

//   if (id1_val == 'add_id') {
//     $("#id_details1_western").hide();
//     document.getElementById("dataWestern").reset();

//     fetch_remitpayout_id_types_western();

//     $("#newheading").html("ADD NEW ID");
//     $("#updateexpired").hide();
//     $("#addnewsuccess").hide();
//     document.getElementById('newidtype').selectedIndex = 0;
//     create_new = 0;
//     $("#newidtype").prop("disabled", false);
//     $("#westernidtype").val("prime_id");
//     setTimeout(function () {
//       $modal.modal('show');
//     }, 500);

//     //RefreshListWestern();

//   }
//   else if (id1_val != 'add_id' && id1_val != '') {

//     var selvalidID1_western = $("#selvalidID1_western").val();

//     var transtype = $('a[id=aFindPaymaya]').data('id').split('|');
//     //console.log(transtype);

//     if (transtype[1] != 'PAYOUT') {
//       var senderDetails = $("#inputSenderHide").val().split('|');
//     } else {
//       var senderDetails = $("#inputBeneficiaryHide").val().split('|');
//     }

//     // console.log(senderDetails);


//     var benefname = senderDetails[5];
//     var benemname = senderDetails[6];
//     var benelname = senderDetails[7];
//     var benebdate = senderDetails[8];

//     var parameters = { benefname: benefname, benemname: benemname, benelname: benelname, benebdate: benebdate };

//     $.ajax({
//       url: "/Ecash_payout/fetch_payout_id",
//       type: "POST",
//       data: parameters,

//       success: function (data) {
//         var jsondata = JSON.parse(data);

//         // console.log(jsondata);

//         if (jsondata.S == 1) {

//           for (var index in jsondata.T_DATA) {

//             var id = jsondata.T_DATA[index].id;

//             if (selvalidID1_western == id) {
//               var is_expired = jsondata.T_DATA[index].is_expired;
//               if (is_expired == 'VALID') {
//                 var attachment = jsondata.T_DATA[index].attachment;
//                 var created = jsondata.T_DATA[index].created;
//                 var description = jsondata.T_DATA[index].description;
//                 var expiry = jsondata.T_DATA[index].expiry;
//                 var number = jsondata.T_DATA[index].number;


//                 document.getElementById("id_detailtype1").value = description;
//                 document.getElementById("id_detailnumber1").value = number;
//                 document.getElementById("id_detailexpiry1").value = expiry;
//                 document.getElementById("id_detailcreated1").value = created;
//                 document.getElementById("id_attachment1").href = attachment;
//                 $("#id_details1_western").show();
//               }
//               else {
//                 var expiry = jsondata.T_DATA[index].expiry;
//                 var number = jsondata.T_DATA[index].number;
//                 var description = jsondata.T_DATA[index].description;
//                 $("#id_details1_western").hide();

//                 document.getElementById("id_detailtype1").value = '';
//                 document.getElementById("id_detailnumber1").value = '';
//                 document.getElementById("id_detailexpiry1").value = '';
//                 document.getElementById("id_detailcreated1").value = '';
//                 document.getElementById("id_attachment1").href = '';

//                 fetch_remitpayout_id_types_western(description);
//                 document.getElementById("newidnumber").value = number;
//                 document.getElementById("newexpirydate").value = expiry;
//                 document.getElementById("file").value = '';


//                 $("#newheading").html("UPDATE ID");
//                 $("#updateexpired").html("This type of ID is expired, Please update.");
//                 $("#updateexpired").show();
//                 create_new = 1;
//                 $("#addnewsuccess").hide();
//                 $("#newidtype").prop("disabled", true);
//                 setTimeout(function () {
//                   $modal.modal('show');
//                 }, 500);
//               }
//             }

//           }


//         }
//       }
//     });

//     waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'primary' });
//     setTimeout(function () {
//       waitingDialog.hide();
//     }, 1000);
//   }
//   else if (id1_val == '') {
//     $("#id_details1_western").hide();
//   }
//   else {
//     $("#id_details1_western").hide();
//   }

// });

// /* GET ID DETAILS ON CHANGE OF ID#2*/
// $("#selvalidID2_western").change(function () {
//   // Get the selected value
//   var selected = $("option:selected", $(this)).val();
//   // Get the ID of this element
//   var thisID = $(this).prop("id");
//   // Reset so all values are showing:
//   $(".preferenceSelectwestern option").each(function () {
//     if ($(this).prop("value") != '' || $(this).prop("value") != 'add_id') {
//       $(this).prop("disabled", false);
//     }
//   });

//   $(".preferenceSelectwestern").each(function () {
//     if ($(this).prop("id") != thisID) {

//       $("option[value='" + selected + "']", $(this)).prop("disabled", true);
//     }
//   });

//   $modal = $('#myModalWestern');
//   $("#spinAnimationWestern3").css("display", "none");
//   $("#newidtype").css("display", "block");

//   var id2_val = $("#selvalidID2_western").val();
//   if (id2_val == 'add_id') {
//     $("#id_details2_western").hide();

//     document.getElementById("dataWestern").reset();

//     fetch_remitpayout_id_types_western();

//     $("#newheading").html("ADD NEW ID");
//     $("#updateexpired").hide();
//     $("#addnewsuccess").hide();
//     document.getElementById('newidtype').selectedIndex = 0;
//     create_new = 0;

//     $("#newidtype").prop("disabled", false);
//     $("#westernidtype").val("sec_id");
//     setTimeout(function () {
//       $modal.modal('show');
//     }, 500);
//     //RefreshListWestern();

//   }
//   else if (id2_val != 'add_id' && id2_val != '') {
//     var selvalidID2_western = $("#selvalidID2_western").val();
//     var transtype = $('a[id=aFindPaymaya]').data('id').split('|');
//     //console.log(transtype);

//     if (transtype[1] != 'PAYOUT') {
//       var senderDetails = $("#inputSenderHide").val().split('|');
//     } else {
//       var senderDetails = $("#inputBeneficiaryHide").val().split('|');
//     }

//     //console.log(senderDetails);

//     var benefname = senderDetails[5];
//     var benemname = senderDetails[6];
//     var benelname = senderDetails[7];
//     var benebdate = senderDetails[8];

//     var parameters = { benefname: benefname, benemname: benemname, benelname: benelname, benebdate: benebdate };

//     $.ajax({
//       url: "/Ecash_payout/fetch_payout_id",
//       type: "POST",
//       data: parameters,

//       success: function (data) {
//         var jsondata = JSON.parse(data);

//         if (jsondata.S == 1) {

//           for (var index in jsondata.T_DATA) {

//             var id = jsondata.T_DATA[index].id;

//             if (selvalidID2_western == id) {
//               var is_expired = jsondata.T_DATA[index].is_expired;
//               if (is_expired == 'VALID') {
//                 var attachment = jsondata.T_DATA[index].attachment;
//                 var created = jsondata.T_DATA[index].created;
//                 var description = jsondata.T_DATA[index].description;
//                 var expiry = jsondata.T_DATA[index].expiry;
//                 var number = jsondata.T_DATA[index].number;


//                 document.getElementById("id_detailtype2").value = description;
//                 document.getElementById("id_detailnumber2").value = number;
//                 document.getElementById("id_detailexpiry2").value = expiry;
//                 document.getElementById("id_detailcreated2").value = created;
//                 document.getElementById("id_attachment2").href = attachment;
//                 $("#id_details2_western").show();
//               }
//               else {
//                 var expiry = jsondata.T_DATA[index].expiry;
//                 var number = jsondata.T_DATA[index].number;
//                 var description = jsondata.T_DATA[index].description;
//                 $("#id_details2_western").hide();

//                 document.getElementById("id_detailtype2").value = '';
//                 document.getElementById("id_detailnumber2").value = '';
//                 document.getElementById("id_detailexpiry2").value = '';
//                 document.getElementById("id_detailcreated2").value = '';
//                 document.getElementById("id_attachment2").href = '';

//                 fetch_remitpayout_id_types_western(description);
//                 document.getElementById("newidnumber").value = number;
//                 document.getElementById("newexpirydate").value = expiry;
//                 document.getElementById("file").value = '';

//                 $("#newheading").html("UPDATE ID");
//                 $("#updateexpired").html("This type of ID is expired, Please update.");
//                 $("#updateexpired").show();
//                 create_new = 2;
//                 $("#addnewsuccess").hide();
//                 $("#newidtype").prop("disabled", true);
//                 setTimeout(function () {
//                   $modal.modal('show');
//                 }, 500);
//               }
//             }

//           }


//         }
//       }
//     });

//     waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'primary' });
//     setTimeout(function () {
//       waitingDialog.hide();
//     }, 1000);
//   }
//   else {
//     $("#id_details2_western").hide();
//   }

// });


// /* GET ID DETAILS ON CHANGE OF ID#2*/
// $("#selvalidID3_western").change(function () {
//   // Get the selected value
//   var selected = $("option:selected", $(this)).val();
//   // Get the ID of this element
//   var thisID = $(this).prop("id");
//   // Reset so all values are showing:
//   $(".preferenceSelectwestern option").each(function () {
//     if ($(this).prop("value") != '' || $(this).prop("value") != 'add_id') {
//       $(this).prop("disabled", false);
//     }
//   });

//   $(".preferenceSelectwestern").each(function () {
//     if ($(this).prop("id") != thisID) {

//       $("option[value='" + selected + "']", $(this)).prop("disabled", true);
//     }
//   });

//   $modal = $('#myModalWestern');
//   $("#spinAnimationWestern3").css("display", "none");
//   $("#newidtype").css("display", "block");

//   var id3_val = $("#selvalidID3_western").val();
//   if (id3_val == 'add_id') {
//     $("#id_details3_western").hide();

//     document.getElementById("dataWestern").reset();

//     fetch_remitpayout_id_types_western();

//     $("#newheading").html("ADD NEW ID");
//     $("#updateexpired").hide();
//     $("#addnewsuccess").hide();
//     document.getElementById('newidtype').selectedIndex = 0;
//     create_new = 0;

//     $("#newidtype").prop("disabled", false);
//     $("#westernidtype").val("ter_id");
//     setTimeout(function () {
//       $modal.modal('show');
//     }, 500);
//     //RefreshListWestern();

//   }
//   else if (id3_val != 'add_id' && id3_val != '') {
//     var selvalidID3_western = $("#selvalidID3_western").val();
//     var transtype = $('a[id=aFindPaymaya]').data('id').split('|');
//     //console.log(transtype);

//     if (transtype[1] != 'PAYOUT') {
//       var senderDetails = $("#inputSenderHide").val().split('|');
//     } else {
//       var senderDetails = $("#inputBeneficiaryHide").val().split('|');
//     }

//     //console.log(senderDetails);

//     var benefname = senderDetails[5];
//     var benemname = senderDetails[6];
//     var benelname = senderDetails[7];
//     var benebdate = senderDetails[8];

//     var parameters = { benefname: benefname, benemname: benemname, benelname: benelname, benebdate: benebdate };

//     $.ajax({
//       url: "/Ecash_payout/fetch_payout_id",
//       type: "POST",
//       data: parameters,

//       success: function (data) {
//         var jsondata = JSON.parse(data);

//         if (jsondata.S == 1) {

//           for (var index in jsondata.T_DATA) {

//             var id = jsondata.T_DATA[index].id;

//             if (selvalidID3_western == id) {
//               var is_expired = jsondata.T_DATA[index].is_expired;
//               if (is_expired == 'VALID') {
//                 var attachment = jsondata.T_DATA[index].attachment;
//                 var created = jsondata.T_DATA[index].created;
//                 var description = jsondata.T_DATA[index].description;
//                 var expiry = jsondata.T_DATA[index].expiry;
//                 var number = jsondata.T_DATA[index].number;


//                 document.getElementById("id_detailtype3").value = description;
//                 document.getElementById("id_detailnumber3").value = number;
//                 document.getElementById("id_detailexpiry3").value = expiry;
//                 document.getElementById("id_detailcreated3").value = created;
//                 document.getElementById("id_attachment3").href = attachment;
//                 $("#id_details3_western").show();
//               }
//               else {
//                 var expiry = jsondata.T_DATA[index].expiry;
//                 var number = jsondata.T_DATA[index].number;
//                 var description = jsondata.T_DATA[index].description;
//                 $("#id_details3_western").hide();

//                 document.getElementById("id_detailtype3").value = '';
//                 document.getElementById("id_detailnumber3").value = '';
//                 document.getElementById("id_detailexpiry3").value = '';
//                 document.getElementById("id_detailcreated3").value = '';
//                 document.getElementById("id_attachment3").href = '';

//                 fetch_remitpayout_id_types_western(description);
//                 document.getElementById("newidnumber").value = number;
//                 document.getElementById("newexpirydate").value = expiry;
//                 document.getElementById("file").value = '';

//                 $("#newheading").html("UPDATE ID");
//                 $("#updateexpired").html("This type of ID is expired, Please update.");
//                 $("#updateexpired").show();
//                 create_new = 3;
//                 $("#addnewsuccess").hide();
//                 $("#newidtype").prop("disabled", true);
//                 setTimeout(function () {
//                   $modal.modal('show');
//                 }, 500);
//               }
//             }

//           }


//         }
//       }
//     });

//     waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'primary' });
//     setTimeout(function () {
//       waitingDialog.hide();
//     }, 1000);
//   }
//   else {
//     $("#id_details3_western").hide();
//   }

// });

// $("#newidnumber").change(function () {

//   var newidtype = $("#newidtype").val();
//   var newidnumber = $("#newidnumber").val();

//   new_id_rule.forEach(function (arrayItem) {

//     var id = arrayItem.id;
//     var rule = arrayItem.rule;

//     var rule = rule.replace("/g", "");
//     var rule = rule.replace("/", "");
//     // var rule = rule.replace("^", "");

//     var rules = new RegExp(rule, "g");

//     if (newidtype == id) {

//       if (rules.test(newidnumber)) {
//         $("#updateexpired").hide();
//       }
//       else {
//         $("#updateexpired").html("Please match the format of the ID type chosen.");
//         $("#updateexpired").show();

//       }

//     }


//   });



// });

// $("#newidtype").change(function () {
//   var newidtype = $("#newidtype").val();

//   new_id_rule.forEach(function (arrayItem) {
//     var id = arrayItem.id;
//     var expirable = arrayItem.expirable;

//     if (newidtype == id) {
//       if (expirable == 'YES') {
//         $("#newexpirydate").prop("disabled", false);
//         document.getElementById("newexpirydate").value = '';
//       }
//       else {
//         $("#newexpirydate").prop("disabled", true);
//         document.getElementById("newexpirydate").value = 'NO EXPIRY';
//       }
//     }



//   });
// });


// var _validFileExtensions = [".jpg", ".jpeg", ".png"];
// function ValidateSingleInputWestern(oInput) {
//   if (oInput.type == "file") {
//     var sFileName = oInput.value;
//     if (sFileName.length > 0) {
//       var blnValid = false;
//       for (var j = 0; j < _validFileExtensions.length; j++) {
//         var sCurExtension = _validFileExtensions[j];
//         if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
//           blnValid = true;
//           break;
//         }
//       }

//       if (!blnValid) {
//         alert("Your uploaded file type is not allowed \n\n Allowed extensions are: " + _validFileExtensions.join(", "));
//         oInput.value = "";
//         return false;
//       }
//     }
//   }
//   return true;
// }


// function RefreshListWestern() {

//   $("#id_details1_western").hide();
//   $("#id_details2_western").hide();
//   $("#id_details3_western").hide();
//   westernfetchpayoutIDs();

// }

// /*INSERT NEW ID */
// $("form#dataWestern").submit(function () {

//   waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'primary' });

//   var newidtype = $("#newidtype").val();
//   var newidnumber = $("#newidnumber").val();

//   document.getElementById("newidtype2").value = newidtype;

//   $("#updateexpired").hide();

//   new_id_rule.forEach(function (arrayItem) {

//     var id = arrayItem.id;
//     var rule = arrayItem.rule;

//     var rule = rule.replace("/g", "");
//     var rule = rule.replace("/", "");
//     // var rule = rule.replace("^", "");

//     var rules = new RegExp(rule, "g");

//     if (newidtype == id) {

//       if (rules.test(newidnumber)) {
//         waitingDialog.hide();
//         $("#updateexpired").hide();

//         setTimeout(function () {
//           add_western_new_id();
//         }, 1000);
//         $("#newexpirydate").prop("disabled", false);
//         //RefreshListWestern();

//       }
//       else {
//         waitingDialog.hide();
//         $("#updateexpired").html("Please match the format of the ID type chosen.");

//         setTimeout(function () {
//           $("#updateexpired").show();
//         }, 1000);

//       }

//     }


//   });

//   return false;

// });

// function add_western_new_id() {
//   var transtype = $('a[id=aFindPaymaya]').data('id').split('|');
//   //console.log(transtype);

//   if (transtype[1] != 'PAYOUT') {
//     var senderDetails = $("#inputSenderHide").val().split('|');
//   } else {
//     var senderDetails = $("#inputBeneficiaryHide").val().split('|');
//   }

//   //console.log(senderDetails);

//   var benefname = senderDetails[5];
//   var benemname = senderDetails[6];
//   var benelname = senderDetails[7];
//   var benebdate = senderDetails[8];

//   var newexpirydate = $("#newexpirydate").val();

//   var newidtype2 = $("#newidtype2").val();
//   var selvalidID1_western = $("#selvalidID1_western").val();
//   var selvalidID2_western = $("#selvalidID2_western").val();
//   var selvalidID3_western = $("#selvalidID3_western").val();
//   var id_type_western = $("#westernidtype").val();

//   var transtype = $("#transtype").val();

//   var formData = new FormData($('#dataWestern')[0]);

//   formData.append('benefname', benefname);
//   formData.append('benemname', benemname);
//   formData.append('benelname', benelname);
//   formData.append('benebdate', benebdate);
//   formData.append('selvalidID1', selvalidID1_western);
//   formData.append('selvalidID2', selvalidID2_western);
//   formData.append('selvalidID3', selvalidID3_western);
//   formData.append('newexpirydate', newexpirydate);

//   formData.append('newidtype', newidtype2);

//   formData.append('create_new', create_new);
//   formData.append('transtype', transtype);

//   $.ajax({
//     url: "/Ecash_send/add_newid_payout",
//     type: 'POST',
//     data: formData,
//     async: false,
//     cache: false,
//     contentType: false,
//     processData: false,

//     success: function (data) {

//       var jsondata = JSON.parse(data);

//       if (jsondata.S != 1) {
//         $("#updateexpired").html(jsondata.M);
//         $("#updateexpired").show();
//         $("#addnewsuccess").hide();
//       }
//       else {
//         $("#addnewsuccess").html(jsondata.M);
//         $("#addnewsuccess").show();
//         $("#updateexpired").hide();

//         var attachment = jsondata.T_DATA.attachment;
//         var created = jsondata.T_DATA.created;
//         var description = jsondata.T_DATA.description;
//         var expiry = jsondata.T_DATA.expiry;
//         var is_expired = jsondata.T_DATA.is_expired;
//         var number = jsondata.T_DATA.number;
//         var id = jsondata.T_DATA.id;

//         if (id_type_western == 'prime_id') {

//           removeOptionsWestern(document.getElementById("selvalidID1_western"));

//           var select1 = document.getElementById("selvalidID1_western");

//           var el1 = document.createElement("option");
//           el1.textContent = '--CHOOSE ID--';
//           el1.value = '';
//           el1.disabled = true;
//           select1.appendChild(el1);

//           var el1 = document.createElement("option");
//           el1.textContent = description;
//           el1.value = id;
//           el1.selected = true;
//           select1.appendChild(el1);

//           var el1 = document.createElement("option");
//           el1.textContent = '--ADD NEW ID--';
//           el1.value = 'add_id';
//           select1.appendChild(el1);

//           document.getElementById("id_detailtype1").value = description;
//           document.getElementById("id_detailnumber1").value = number;
//           document.getElementById("id_detailexpiry1").value = expiry;
//           document.getElementById("id_detailcreated1").value = created;
//           document.getElementById("id_attachment1").href = attachment;
//           $("#id_details1_western").show();

//         } else if (id_type_western == 'sec_id') {

//           removeOptionsWestern(document.getElementById("selvalidID2_western"));

//           var select2 = document.getElementById("selvalidID2_western");

//           var el2 = document.createElement("option");
//           el2.textContent = '--CHOOSE ID--';
//           el2.value = '';
//           el2.disabled = true;
//           select2.appendChild(el2);

//           var el2 = document.createElement("option");
//           el2.textContent = description;
//           el2.value = id;
//           el2.selected = true;
//           select2.appendChild(el2);

//           var el2 = document.createElement("option");
//           el2.textContent = '--ADD NEW ID--';
//           el2.value = 'add_id';
//           select2.appendChild(el2);

//           document.getElementById("id_detailtype2").value = description;
//           document.getElementById("id_detailnumber2").value = number;
//           document.getElementById("id_detailexpiry2").value = expiry;
//           document.getElementById("id_detailcreated2").value = created;
//           document.getElementById("id_attachment2").href = attachment;
//           $("#id_details2_western").show();

//         } else if (id_type_western == 'ter_id') {

//           removeOptionsWestern(document.getElementById("selvalidID3_western"));

//           var select3 = document.getElementById("selvalidID3_western");

//           var el3 = document.createElement("option");
//           el3.textContent = '--CHOOSE ID--';
//           el3.value = '';
//           el3.disabled = true;
//           select3.appendChild(el3);

//           var el3 = document.createElement("option");
//           el3.textContent = description;
//           el3.value = id;
//           el3.selected = true;
//           select3.appendChild(el3);

//           var el3 = document.createElement("option");
//           el3.textContent = '--ADD NEW ID--';
//           el3.value = 'add_id';
//           select3.appendChild(el3);

//           document.getElementById("id_detailtype3").value = description;
//           document.getElementById("id_detailnumber3").value = number;
//           document.getElementById("id_detailexpiry3").value = expiry;
//           document.getElementById("id_detailcreated3").value = created;
//           document.getElementById("id_attachment3").href = attachment;
//           $("#id_details3_western").show();

//         }

//         setTimeout(function () {
//           $('#myModalWestern').modal('hide');
//         }, 1500);
//       }
//     }

//   });
// }


// $('#newexpirydate').datetimepicker({
//   dateFormat: 'yy-mm-dd',
//   changeMonth: true,
//   changeYear: true,
//   timepicker: false,
//   altField: "#newexpirydate",
//   altFormat: "yy-mm-dd",
//   formatDate: 'Y-m-d',
//   format: 'Y-m-d'
// });

// $('#benefbdate').datetimepicker({
//   dateFormat: 'yy-mm-dd',
//   changeMonth: true,
//   changeYear: true,
//   changeTime: false,
//   timepicker: false,
//   altField: "#newexpirydate",
//   altFormat: "yy-mm-dd",
//   formatDate: 'Y-m-d',
//   format: 'Y-m-d'
// });

$(document).ready(function () {
  $('.westernTable').DataTable({
    "searching": true
  });

  $("#frmPaymayaSender, #frmWesternCancel").on("submit", function () {
    waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'primary' });
  });

  $("#frmSSeachRemit, #frmBSeachRemit").on("submit", function () {
    waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'primary' });
  });

  $("#btnPaymayaCheck").click(function () {

    if ($.trim($("#inputReferenceNo").val()) == "") {
      $("#spnErrorRefnum").text("Please provide tracking number");
      $("#inputReferenceNo").css('border-color', '#a94442');
      return;
    } else {
      $("#spnErrorRefnum").text("");
      $("#inputReferenceNo").css('border-color', '#ccc');
    }

    var message = "";
    waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'primary' });
    $("#iMessage").empty();
    $("#dvSessionMessaeg").hide();
    $("#dvSessionMessaeg").empty();
    $("#iMessage").hide();
    $("#iMessage").empty();
    $("#iMessage").removeClass('alert-warning');
    $("#iMessage").removeClass('alert-danger');
    $("#iMessage").removeClass('alert-success');
    $("#alertDynammic").empty();

    var parameters = { search: $("#inputReferenceNo").val(), option: 2 };
    
    var response = callSearchPaymaya(parameters);
    console.log(response);
    if (response.status == 2) {
      var message = '<b> <i class="fa fa-circle" aria-hidden="true"></i> Transaction on hold. Please enter verification code to proceed this transaction. This is valid for 30minutes</b>';
      $("#iMessage").addClass("alert-warning");
      // $("#iMessage").append(message);
      // $("#iMessage").append(message);
      $("#iMessage").show();
      $("#inputReferenceNoUnhold").val("" + parameters.search);
      $("#mainForn").hide();
      $("#confirmForm").show();
    } else if (response.status == 1) {
      $("#iMessage").addClass("alert-success");
      message = '&nbsp;&nbsp;<b><i class="fa fa-check-circle" aria-hidden="true">' +
        '</i> SUCCESSFUL.</b>' +
        ' Tracking Number: ' +
        '<a target="_blank" href="https://mobilereports.globalpinoyremittance.com/portal/ecash_to_paymaya_receipt/' + parameters.search + '">' + parameters.search + '</a><br>' +
        '&nbsp;&nbsp;<small>Click <a target="_blank" href="https://mobilereports.globalpinoyremittance.com/portal/ecash_to_paymaya_receipt/' + parameters.search + '"> here </a>' +
        ' to download copy of the Acknowledgement Receipt.</small>';
      $("#inputSenderName").focus();
    } else if (response.status == 0) {
      message = '<div class="alert alert-danger" style="opacity: 0.922955;"><b> <i class="fa fa-exclamation-circle" aria-hidden="true"></i> INVALID TRACKING NUMBER</b></div>';
      $("#inputSenderName").focus();
    } else if (response.status == 5) {
      if (response.message == "Target account is not found") {
        response.message = "Invalid account number";
      }
      message = '<div class="alert alert-danger" style="opacity: 0.922955;"><b> <i class="fa fa-exclamation-circle" aria-hidden="true"></i> ' + response.message + '</b></div>';
    } else if (response.status == 3) {
      var message = '<b> <i class="fa fa-alert" aria-hidden="true"></i> ' + response.message + '</b>';
      $("#iMessage").addClass("alert-warning");
    } else if (response.status == 9) {
      var message = '<b> <i class="fa fa-check-circle" aria-hidden="true"></i> ' + response.message + '</b>';
      $("#iMessage").addClass("alert-success");
    }
    $("#iMessage").append(message);
    $("#iMessage").show();
    waitingDialog.hide();
  });

  function callSearchPaymaya(parameters) {
    var retRes = "";

    $.ajax({
      url: "/Ecash_send/ajaxSearchPaymaya",
      type: "POST",
      data: parameters,
      dataType: "json",
      async: false,
      success: function (data) {
       
        retRes = data;  
      }
    }); 
    
      
    console.log(retRes.message);
    if (retRes.message == null) {
      message = '<div class="alert alert-danger" style="opacity: 0.922955;"><b> <i class="fa fa-exclamation-circle" aria-hidden="true"></i> INVALID TRACKING NUMBER</b></div>';
      $("#inputSenderName").focus();
    }  
    if (retRes.message.includes('Unicard') || retRes.message == null) {
      retRes.message = 'Transaction rolled back. Please Try again!';
    }
    return retRes;
  }

  $("#frmPaymaya").submit(function () {
    waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'primary' });
  });

});


$(".btnOTPPaymayaResend").on("click", function () {
  var trackno = $("input[name='inputReferenceNo']").val();

  if (!trackno || trackno == ' ' || trackno == undefined) {
    $('#inputReferenceNo').css('border', '1px solid red');
    $(".resendingPaymayaOTPcode").css('display', 'none');
  } else {
    $(".resendingPaymayaOTPcode").css('display', 'block');
    var parameters = { trackno: trackno };
    $.ajax({
      type: 'POST',
      url: "/Ecash_send/ecash_to_paymaya_otp_resend",
      data: parameters,
      success: function (msg) {
        $(".resendingPaymayaOTPcode").css('display', 'none');
        $(".alert-warning").hide();
        var msgDone = JSON.parse(msg);
        console.log(msgDone);

        var arrCSSOTP = {
          'color': '#3c763d', 'background-color': '#dff0d8',
          'border-color': '#d6e9c6', 'padding': '15px',
          'margin-bottom': '20px', 'border': '1px solid transparent',
          'border-radius': '4px'
        };

        if (msgDone.S != 1) {
          arrCSSOTP['color'] = "#3c763d";
          arrCSSOTP['background-color'] = "#dff0d8";
          arrCSSOTP['border-color'] = "#d6e9c6";
        }

        $('#otpMessage').removeAttr('style');
        $('#otpMessage').attr('style');
        $('#otpMessage').css(arrCSSOTP);
        $('#otpMessage').text(msgDone.M);

        $('#otpMessage').delay(5000).fadeOut();
      }
    });
  }
});

$(".checkPA").on("click", function () {
  // alert($(this).val());
  var $this = $(this);

  // alert($this.is(':checked'));

  if ($this.is(':checked')) {
    var inputprhouseNumber = $("#frmAddEcashPadala input[name='inputprhouseNumber']").val();
    var inputprstreet = $("#frmAddEcashPadala input[name='inputprstreet']").val();
    var inputprbarangay = $("#frmAddEcashPadala input[name='inputprbarangay']").val();
    var inputprcity = $("#frmAddEcashPadala input[name='inputprcity']").val();
    var inputprprovince = $("#frmAddEcashPadala input[name='inputprprovince']").val();
    var inputprzipCode = $("#frmAddEcashPadala input[name='inputprzipCode']").val();
    var prhouseNumber = $("#frmAddEcashPadala select[name='inputprcountry']").val();

    // alert(prhouseNumber);

    $("#frmAddEcashPadala input[name='inputpmhouseNumber']").val(inputprhouseNumber);
    $("#frmAddEcashPadala input[name='inputpmstreet']").val(inputprstreet);
    $("#frmAddEcashPadala input[name='inputpmbarangay']").val(inputprbarangay);
    $("#frmAddEcashPadala input[name='inputpmcity']").val(inputprcity);
    $("#frmAddEcashPadala input[name='inputpmprovince']").val(inputprprovince);
    $("#frmAddEcashPadala input[name='inputpmzipCode']").val(inputprzipCode);
    $("#frmAddEcashPadala select[name='inputpmcountry']").val(prhouseNumber);

    $('.checkread').attr('readonly', true);

  } else {

    $("#frmAddEcashPadala input[name='inputpmhouseNumber']").val('');
    $("#frmAddEcashPadala input[name='inputpmstreet']").val('');
    $("#frmAddEcashPadala input[name='inputpmbarangay']").val('');
    $("#frmAddEcashPadala input[name='inputpmcity']").val('');
    $("#frmAddEcashPadala input[name='inputpmprovince']").val('');
    $("#frmAddEcashPadala input[name='inputpmzipCode']").val('');
    $("#frmAddEcashPadala select[name='inputpmcountry']").val('');

    $('.checkread').attr('readonly', false);
  }

});


$("#frmAddEcashPadala input[name='inputprhouseNumber']").on("input", function () {
  // alert($(this).val()); 
  var getvalue = $(this).val();
  var checksss = $("input[name='checkPA']").is(':checked');

  if (checksss === true) {
    $("#frmAddEcashPadala input[name='inputpmhouseNumber']").val(getvalue);
  }
});

$("#frmAddEcashPadala input[name='inputprstreet']").on("input", function () {
  // alert($(this).val()); 
  var getvalue = $(this).val();
  var checksss = $("input[name='checkPA']").is(':checked');

  if (checksss === true) {
    $("#frmAddEcashPadala input[name='inputpmstreet']").val(getvalue);
  }
});

$("#frmAddEcashPadala input[name='inputprbarangay']").on("input", function () {
  // alert($(this).val()); 
  var getvalue = $(this).val();
  var checksss = $("input[name='checkPA']").is(':checked');

  if (checksss === true) {
    $("#frmAddEcashPadala input[name='inputpmbarangay']").val(getvalue);
  }
});

$("#frmAddEcashPadala input[name='inputprcity']").on("input", function () {
  // alert($(this).val()); 
  var getvalue = $(this).val();
  var checksss = $("input[name='checkPA']").is(':checked');

  if (checksss === true) {
    $("#frmAddEcashPadala input[name='inputpmcity']").val(getvalue);
  }
});

$("#frmAddEcashPadala input[name='inputprprovince']").on("input", function () {
  // alert($(this).val()); 
  var getvalue = $(this).val();
  var checksss = $("input[name='checkPA']").is(':checked');

  if (checksss === true) {
    $("#frmAddEcashPadala input[name='inputpmprovince']").val(getvalue);
  }
});

$("#frmAddEcashPadala input[name='inputprzipCode']").on("input", function () {
  // alert($(this).val()); 
  var getvalue = $(this).val();
  var checksss = $("input[name='checkPA']").is(':checked');

  if (checksss === true) {
    $("#frmAddEcashPadala input[name='inputpmzipCode']").val(getvalue);
  }
});

$("#frmAddEcashPadala select[name='inputprcountry']").change(function () {
  // alert($(this).val()); 
  var getvalue = $(this).val();
  var checksss = $("input[name='checkPA']").is(':checked');

  if (checksss === true) {
    $("#frmAddEcashPadala select[name='inputpmcountry']").val(getvalue);
  }
});

$(document).ready(function () {
  $("#frmSSeachRemit, #frmBSeachRemit").on("submit", function () {

    waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'primary' });
  });
});


function RefreshListwestern() {
  //console.log('putek');
  waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'primary' });
  $("#id_details1_western").hide();
  $("#id_details2_western").hide();
  $("#id_details3_western").hide();
  waitingDialog.hide();
  westernfetchpayoutIDs();
}

$("#frmWesternPayout").on("submit", function (event) {
  event.preventDefault();
  waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'primary' });

  var refno = $("#frmWesternPayout #inputReferenceNo").val();
  var transpass = $("#frmWesternPayout #inputTpass").val();
  var sender_id = $("#frmWesternPayout #inputSenderID").val();
  var beneficiary_id = $("#frmWesternPayout #inputBeneficiaryID").val();
  var amount = $("#frmWesternPayout #inputPRINAmount").val();
  var currency = $("#frmWesternPayout #currency").val().split('|');
  var primaryId = $("#frmWesternPayout #selvalidID1_western").val();
  var secondaryId = $("#frmWesternPayout #selvalidID2_western").val();
  var tertiaryId = $("#frmWesternPayout #selvalidID3_western").val();
  var country = $("#frmWesternPayout #country_iso").val();
  var occupation = $("#frmWesternPayout #inputOccupation").val();
  var relationbene = $("#frmWesternPayout #inputRelationshiptoBene").val();
  var empname = $("#frmWesternPayout #inputEmployer").val();
  var fundsrc = $("#frmWesternPayout #inputSourceofFund").val();
  var countrybirth = $("#frmWesternPayout #inputCountryBirth").val();
  var nationality = $("#frmWesternPayout #inputNationality").val();

  var parameters = { refno: refno, transpass: transpass, sender_id: sender_id, beneficiary_id: beneficiary_id, amount: amount, currency: currency[0], primaryId: primaryId, secondaryId: secondaryId, tertiaryId: tertiaryId, country: country, occupation: occupation, relationbene: relationbene, empname: empname, fundsrc: fundsrc, countrybirth: countrybirth, nationality: nationality };
  // console.log(parameters);

  $.ajax({
    url: "/Ecash_payout/ecash_to_western_payout_request",
    type: "POST",
    data: parameters,
    success: function (data) {
      var jsondata = JSON.parse(data);
      // console.log(jsondata);

      waitingDialog.hide();
      if (jsondata.S == 1) {

        $("#alertDynammic").css('display', 'block');
        $("#alertDynammic").addClass("alert alert-success col-md-12 text-error alert-dismissable");
        $("#alertDynammic").html("<a href='javaScript:void(0)' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + jsondata.M + "<br><b><u>Tracking Number: " + jsondata.TN + "</u></b>");
        $("#alertDynammic").fadeTo(10000, 10000).slideUp(10000, function () {
          $("#alertDynammic").slideUp(10000);
          $("#alertDynammic").removeClass();
        });
        setTimeout(function () {
          gotoEnd();
        }, 8000);
      } else {
        $("#alertDynammic").css('display', 'block');
        $("#alertDynammic").addClass("alert alert-danger col-md-12 text-error alert-dismissable");
        $("#alertDynammic").html("<a href='javaScript:void(0)' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + jsondata.M);
        $("#alertDynammic").fadeTo(10000, 10000).slideUp(10000, function () {
          $("#alertDynammic").slideUp(10000);
          $("#alertDynammic").removeClass();
        });
      }
    }
  });
});


$('a[id=aCancel]').on('click', function () {
  var txnCancel = $(this).data('id');
  $('#myModal').modal('show');
  $('p[id=txnCanceltext]').text('Transaction Number: ' + txnCancel);
  $('#inputTxnCancel').val(txnCancel);
});


$('a[id=btnBack]').on('click', function () {
  var base_url = window.location.origin;
  var pathArray = window.location.pathname;

  var url = base_url + pathArray;
  var to = url.lastIndexOf('/') + 1;
  newURL = url.substring(0, to);
  window.location = newURL;
});

$(document).ready(function () {
  $('.westernTable').DataTable({
    "searching": true
  });
});

// $("#frmPaymayaSender").on("submit", function (event) {
//   $("#alertDynammic").removeClass();
//   setTimeout(function () {
//               gotoEnd();
//             }, 8000);
//   event.preventDefault();
//   if ($("#selvalidID1_western").val() == "") {
//     $("#btnWesternSubmit").prop('disabled', true);
//   } else {
//     $("#btnWesternSubmit").prop('disabled', false);
//   }
//   waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'primary' });
//   // waitingDialog.hide();
//   var parameters = {
//     transpass: $("#frmPaymayaSender #inputTpass").val(),
//     accountNo: $("#frmPaymayaSender #inputAccountno").val(),
//     amount: $("#frmPaymayaSender #inputPRINAmount").val(),
//     charge: 1,
//     senderId: {
//       id: $("#frmPaymayaSender #selvalidID1_western").val(),
//       type: $("#frmPaymayaSender #id_detailtype1").val(),
//       number: $("#frmPaymayaSender #id_detailnumber1").val(),
//       expiry: $("#frmPaymayaSender #id_detailexpiry1").val(),
//     },
//     channel: $("#frmPaymayaSender #channel").val(),
//     sender: $("#frmPaymayaSender #inputSenderID").val(),
//     beneficiary: $("#frmPaymayaSender #inputBeneficiaryID").val()
//   };
  
//   $.ajax({
//     type: 'POST',
//     url: "/Ecash_send/ecash_to_paymaya_send",
//     data: parameters,
//     success: function (data) {
//       $("#alertDynammic").addClass("alert-danger"); 
//       $("#alertDynammic").empty();
//       waitingDialog.hide();
//       var jsondata = JSON.parse(data);
//       if (jsondata.M.includes('Unicard')) {
//         jsondata.M = 'System Error Please Try Again!';
//       } 
//       waitingDialog.hide();
//       if (jsondata.S == 1 || jsondata.S == 2 || jsondata.S == 3) {
//         txtTrackingNumber = "<br><b><u>Tracking Number: " + jsondata.TN + "</u></b>";
//       }
//       // $('#detailsModal').modal('hide');
//       // $('.in').hide(); 
//       $("#alertDynammic").html("<br>");
//       if (jsondata.S != 3) {
//         $("#alertDynammic").fadeTo(15000, 15000).slideUp(15000, function () {
//           $("#alertDynammic").slideUp(15000);
//           $("#alertDynammic").removeClass();
//         });

//         if (jsondata.S == 1 || jsondata.S == 2) {
//           $("#inputSenderName").focus();
//           if (jsondata.S == 1) {
//             $("#alertDynammic").removeClass("alert-danger"); 
//             $("#btnWesternSubmit").attr('disabled', 'disabled');
//             var message = '<i class="fa fa-check-circle" aria-hidden="true"></i> <b> SUCCESSFUL.</b>' +
//               '<br> Tracking Number: <a target="_blank" href="https://mobilereports.globalpinoyremittance.com/portal/ecash_to_paymaya_receipt/' + jsondata.TN + '">' +
//               jsondata.TN + '</a> <br> &nbsp;&nbsp;' +
//               '<small>Click <a href="https://mobilereports.globalpinoyremittance.com/portal/ecash_to_paymaya_receipt/' + jsondata.TN + '"' +
//               ' target="_blank">here</a> to download copy of the Acknowledgement Receipt.</small> <br> <br>';
//             $("#alertDynammic").addClass("alert-success");
//             $("#alertDynammic").append(message);
//             // var amount2 = $("#inputPRINAmount").val();
//             // alert(amount2);
//             // var s= $("#spanEC").text();
//             // s = s - amount2;
//             // $("#spanEC").text(s); 
//             setTimeout(function () {
//               gotoEnd();
//             }, 18000);
//           }
//         } else {
//           $("#alertDynammic").addClass("alert-danger"); 
//           $("#alertDynammic").append(jsondata.M);
//           $("#stepOne").css('display', 'none');
//           $("#stepTwo").css('display', 'block');
//           $("#stepThree").css('display', 'none');
//         }
//       } else {

//         if (jsondata.TN == "" || jsondata.TN == null) {
//           $("#alertDynammic").addClass("alert-danger");
//           $("#alertDynammic").append(jsondata.M);
//         } else if (jsondata.S == 3) {
//           $("#alertDynammic").fadeTo(300000, 300000).slideUp(15000, function () {
//             $("#alertDynammic").slideUp(15000);
//             $("#alertDynammic").removeClass();
//           });

//           var message = '<b> <i class="fa fa-check" aria-hidden="true"></i> ' + jsondata.M + '. ' +
//             '<br> Tracking Number ' + jsondata.TN + '<br> ' +
//             'This is valid for 30minutes';
//           $("#alertDynammic").addClass("alert-warning");
//           $("#stepThree").css('display', 'block');
//           $("#alertDynammic").append(message);
//           $("#stepOne").css('display', 'none');
//           $("#stepTwo").css('display', 'none');
//           $('#stepThree .unholdRefno').val(jsondata.TN);
//         }
//       }
//       $("#alertDynammic").focus();
//     }
//   });
 
//   // waitingDialog.hide();
// });
$("#frmPaymayaSender").on("submit", function (event) {
  $("#alertDynammic").removeClass();
  
  event.preventDefault();

 
  if ($("#selvalidID1_western").val() == "") {
    $("#btnWesternSubmit").prop('disabled', true);
  } else {
    $("#btnWesternSubmit").prop('disabled', false);
  }
  // waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'primary' });
  waitingDialog.hide();
  var parameters = {
    transpass: $("#frmPaymayaSender #inputTpass").val(),
    accountNo: $("#frmPaymayaSender #inputAccountno").val(),
    amount: $("#frmPaymayaSender #inputPRINAmount").val(),
    charge: 1,
    senderId: {
      id: $("#frmPaymayaSender #selvalidID1_western").val(),
      type: $("#frmPaymayaSender #id_detailtype1").val(),
      number: $("#frmPaymayaSender #id_detailnumber1").val(),
      expiry: $("#frmPaymayaSender #id_detailexpiry1").val(),
    },
    channel: $("#frmPaymayaSender #channel").val(),
    sender: $("#frmPaymayaSender #inputSenderID").val(),
    beneficiary: $("#frmPaymayaSender #inputBeneficiaryID").val()
  };
  waitingDialog.hide();
  $.ajax({
    
    type: 'POST',
    url: "/Ecash_send/ecash_to_paymaya_send",
    data: parameters,
    success: function (data) {
      $("#alertDynammic").removeClass("alert-danger");
      $("#alertDynammic").removeClass('alert-warning'); 
      $("#alertDynammic").removeClass("alert-success");
      $("#alertDynammic").empty();
      waitingDialog.hide();
      var jsondata = JSON.parse(data);
      // alert(jsondata);
      if (jsondata.M.includes('Unicard')) {
        jsondata.M = 'Transaction rolled back. Please Try again!';
      } 
      // console.log(jsondata);
      waitingDialog.hide();
      if (jsondata.S == 1 || jsondata.S == 2 || jsondata.S == 3) {
        txtTrackingNumber = "<br><b><u>Tracking Number: " + jsondata.TN + "</u></b>";
      }
      // $('#detailsModal').modal('hide');
      // $('.in').hide(); 
      $("#alertDynammic").html("<br>");
     
      if (jsondata.S != 3) { 
        if (jsondata.S == 1 || jsondata.S == 2) {
          $("#alertDynammic").removeClass('alert-warning'); 
        $("#alertDynammic").empty();
          $("#inputSenderName").focus();
          if (jsondata.S == 1) {
            $("#alertDynammic").fadeTo(1500000, 1500000).slideUp(1500000, function () {
              $("#alertDynammic").slideUp(1500000);
              $("#alertDynammic").removeClass();
         
            });
            $("#alertDynammic").removeClass("alert-danger"); 
            $("#btnWesternSubmit").attr('disabled', 'disabled');
            var message = '<i class="fa fa-check-circle" aria-hidden="true"></i> <b> '+ jsondata.M +'.</b>';
            $("#alertDynammic").addClass("alert-warning");
            $("#alertDynammic").append(message); 
            setTimeout(function () {
              gotoEnd();
            }, 18000);
          }
        }  else if(jsondata.S == 5) {
          $("#btnWesternSubmit").attr('disabled', 'disabled');
          $("#alertDynammic").fadeTo(5000, 5000).slideUp(5000, function () { 
            $("#alertDynammic").slideUp(9000);
            $("#alertDynammic").removeClass(); 
            gotoOTPVerify();
          });
          $("#alertDynammic").addClass("alert-warning"); 
          $("#alertDynammic").append(jsondata.M);
          $("#stepOne").css('display', 'none');
          $("#stepTwo").css('display', 'block');
          $("#stepThree").css('display', 'none');
        } else {
          if(jsondata.M == ""){
            $("#btnWesternSubmit").attr('disabled', 'disabled');
            $("#alertDynammic").fadeTo(9000, 9000).slideUp(9000, function () { 
              $("#alertDynammic").slideUp(9000);
              $("#alertDynammic").removeClass(); 
              goToReport();
            });
            $("#alertDynammic").addClass("alert-warning"); 
            $("#alertDynammic").append("Server Error Please Check Report If Transaction proceed");
            $("#stepOne").css('display', 'none');
            $("#stepTwo").css('display', 'block');
            $("#stepThree").css('display', 'none');
        }else {
            $("#alertDynammic").removeClass('alert-warning'); 
            $("#alertDynammic").empty();
            $("#alertDynammic").fadeTo(9000, 9000).slideUp(9000, function () {
              $("#alertDynammic").slideUp(9000);
              $("#alertDynammic").removeClass();
            });
            $("#alertDynammic").addClass("alert-danger"); 
            $("#alertDynammic").append(jsondata.M);
            $("#stepOne").css('display', 'none');
            $("#stepTwo").css('display', 'block');
            $("#stepThree").css('display', 'none');
        } 
        }
      } else {
        $("#alertDynammic").removeClass('alert-warning'); 
        $("#alertDynammic").empty();
        if (jsondata.TN == "" || jsondata.TN == null) {
          $("#alertDynammic").addClass("alert-danger");
          $("#alertDynammic").append("NO TRANSACTION NUMBER");
        } else if (jsondata.S == 3) { 
          $("#alertDynammic").removeClass('alert-warning'); 
          $("#alertDynammic").empty();
          $("#alertDynammic").fadeTo(1500000, 1500000).slideUp(1500000, function () {
            $("#alertDynammic").slideUp(1500000);
            $("#alertDynammic").removeClass();
          });

          var message = '<b> <i class="fa fa-check" aria-hidden="true"></i> ' + jsondata.M + '. ' +
            '<br> Tracking Number ' + jsondata.TN + '<br> ' +
            'This is valid for 30minutes';
          $("#alertDynammic").addClass("alert-warning");
          $("#stepThree").css('display', 'block');
          $("#alertDynammic").append(message);
          $("#stepOne").css('display', 'none');
          $("#stepTwo").css('display', 'none');
          $('#stepThree .unholdRefno').val(jsondata.TN);
        }
      }
      $("#alertDynammic").focus();
    }
  });
 
  waitingDialog.hide();
});
$('a[id=btnCancelWestern]').on('click', function () {
  setTimeout(function () {
    waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'primary' });
  }, 2000);

  gotoEnd();
});

function gotoEnd() {
  var base_url = window.location.origin;
  var pathArray = window.location.pathname;

  window.location = base_url + pathArray;
}

function gotoOTPVerify() {
  var base_url = window.location.origin;
  var path = "/ecash_send/paymaya_checkrefno";
  window.location = base_url + path;
}

function goToReport() {
  var base_url = window.location.origin;
  var path = "/Report/ecash";
  window.location = base_url + path;
}

$("#country_iso").change(function () {
  $('#inputPRINAmount').prop("disabled", false);
  $('#inputPRINAmount, #inputSCAmount').val('');
  $('#currency option:eq(0)').prop('selected', true);
});

function get_country_charge() {
  $('#inputSCAmount, #inputTotalAmount').css("display", "none");
  $('.spinAnimationWesternCharge').css("display", "block");

  var country = $('#country_iso').val();
  var amount = $('#inputPRINAmount').val();
  var currency = $('#currency').val().split('|');

  var parameters = { country: country, amount: amount, currency: currency[0] };

  $.ajax({
    url: "/Ecash_send/get_country_charge",
    type: "POST",
    data: parameters,
    success: function (data) {
      var jsondata = JSON.parse(data);

      $('#inputSCAmount, #inputTotalAmount').css("display", "block");
      $('.spinAnimationWesternCharge').css("display", "none");

      if (jsondata.S == 1) {
        if (currency[0] == 'PHP') {
          var totalamount = parseFloat(amount) + parseFloat(jsondata.C);
          $('#inputSCAmount').val(jsondata.C);
          $('#inputTotalAmount').val(totalamount.toFixed(2));
        } else {
          var sc = parseFloat(jsondata.C) / parseFloat(currency[1]);
          var totalamount = parseFloat(amount) + parseFloat(sc);
          $('#inputSCAmount').val(sc.toFixed(2));
          $('#inputTotalAmount').val(totalamount.toFixed(2));
        }
      } else {
        $('#inputSCAmount').css({ 'border-color': 'red', 'border-width': 'initial' });
        $('#inputSCAmount').val("Invalid Amount");
      }
    }
  });

}

if ($('#inputPaymayaSenderName').val() == "") {
  $('#inputPaymayaBeneficiaryName').attr('readonly', true);
  $("#inputSenderHide").val()

} else {
  $('#inputPaymayaSenderName').attr('readonly', true);
  $('#inputPaymayaBeneficiaryName').focus();

}

$('a[id=aFindPaymaya]').on('click', function () {

  var index = $(this).index('a[id=aFindPaymaya]');
  var data = $(this).data('id').split('|');
  var sender = $('#inputPaymayaSenderName');
  var beneficiary = $('#inputPaymayaBeneficiaryName');
  var inputSenderHide = $("#inputSenderHide");
  var inputBeneficiaryHide = $("#inputBeneficiaryHide");
  var str = [];
  var i = 0;
  //console.log(inputBeneficiaryHide);

  $(".tr").eq(index).find(".td").each(function () {   //GET information from table (HTML)
    str[i] = $(this).text();
    i++;
  });

  if (data[0] == 1) {
    sender.val(str[1]);
    if (sender.val() != "") {
      beneficiary.removeAttr('readonly');
      sender.attr('readonly', true);
      beneficiary.focus();
      inputSenderHide.val(str[0] + "|" + str[1] + "|" + str[2] + "|" + str[3] + "|" + str[4] + "|" + str[5] + "|" + str[6]);
    }
  }
  else if (data[0] == 2) {

    $('.btnProceedWestern').show();
    beneficiary.val(str[1]);
    inputBeneficiaryHide.val(str[0] + "|" + str[1] + "|" + str[2] + "|" + str[3] + "|" + str[4] + "|" + str[5] + "|" + str[6]);
  }

});


$('.btnProceedWestern').click(function () {
  var inputSenderHide = $("#inputSenderHide").val().split('|');
  var inputBeneficiaryHide = $("#inputBeneficiaryHide").val().split('|');
  var transtype = $('a[id=aFindPaymaya]').data('id').split('|');

  $("#stepOne").css('display', 'none');

  // sender
  $('#inputSenderID').val(inputSenderHide[0]);
  $('#inputSenderName').val(inputSenderHide[1]);
  $('#inputSenderBday').val(inputSenderHide[2]);
  $('#inputMobileNo').val(inputSenderHide[3]);
  $('#inputSenderOccupation').val(inputSenderHide[4]);
  // beneficiary
  $('#inputBeneficiaryID').val(inputBeneficiaryHide[0]);
  $('#inputBeneficiaryName').val(inputBeneficiaryHide[1]);
  $('#inputBeneficiaryAddress').val(inputBeneficiaryHide[2]);
  $('#inputBeneficiaryMobile').val(inputBeneficiaryHide[3]);
  $('#inputBeneficiaryEmail').val(inputBeneficiaryHide[4]);
  $('#benefbdate').val(inputBeneficiaryHide[8]);

  $("#stepTwo").css('display', 'block');
  $("#id_details2_western").hide();
  $("#id_details3_western").hide();

  // if(transtype[1] != 'PAYOUT'){
  westernfetchpayoutIDs();
  // }

});


var getidcount = 0;
var new_id_rule = [];


function removeOptionsWestern(selectbox) {
  var i;
  for (i = selectbox.options.length - 1; i >= 0; i--) {
    selectbox.remove(i);
  }
}

function westernfetchpayoutIDs() {
  var transtype = $('a[id=aFindPaymaya]').data('id').split('|');
  console.log(transtype);

  getidcount = 0;

  if (transtype[1] != 'PAYOUT') {
    var senderDetails = $("#inputSenderHide").val().split('|');
  } else {
    var senderDetails = $("#inputBeneficiaryHide").val().split('|');
  }

  //console.log(senderDetails);
  var benefname = senderDetails[5];
  var benemname = senderDetails[6];
  var benelname = senderDetails[7];
  var benebdate = senderDetails[8];

  var parameters = { benefname: benefname, benemname: benemname, benelname: benelname, benebdate: benebdate };

  if (getidcount === 0) {
    $.ajax({
      url: "/Ecash_payout/fetch_payout_id",
      type: "POST",
      data: parameters,
      success: function (data) {
        var jsondata = JSON.parse(data);
       
        if (jsondata.S == 1) {
          console.log(data);
          $("#spinAnimationWestern1, #spinAnimationWestern2").css("display", "none");
          $("#selvalidID1_western, #selvalidID2_western").css("display", "block");
          $("#selvalidID1_western, #selvalidID2_western").prop("disabled", false);
          $("#id_details1_western, #id_details2_western, #id_details3_western").hide();


          removeOptionsWestern(document.getElementById("selvalidID1_western"));
          removeOptionsWestern(document.getElementById("selvalidID2_western"));
          removeOptionsWestern(document.getElementById("selvalidID3_western"));

          var select1 = document.getElementById("selvalidID1_western");
          var select2 = document.getElementById("selvalidID2_western");
          var select3 = document.getElementById("selvalidID3_western");

          var el1 = document.createElement("option");

          el1.textContent = 'CHOOSE VALID ID';
          el1.value = '';
          el1.disabled = true;
          el1.selected = true;
          select1.appendChild(el1);

          var el2 = document.createElement("option");
          el2.textContent = 'CHOOSE VALID ID';
          el2.value = '';
          el2.disabled = true;
          el2.selected = true;
          select2.appendChild(el2);

          var el3 = document.createElement("option");
          el3.textContent = 'CHOOSE VALID ID';
          el3.value = '';
          el3.disabled = true;
          el3.selected = true;
          select3.appendChild(el3);

          var date1 = new Date();
          date1 = date1.getFullYear()+'-'+ (date1.getUTCMonth() + 1)+"-"+ (date1.getDate() - 1);
          // console.log(date1);
          // var data = [];
 
        var map = [];
          for (var index in jsondata.T_DATA) {
            
            var attachment = jsondata.T_DATA[index].attachment;
            var created = jsondata.T_DATA[index].created;
            var description = jsondata.T_DATA[index].description;
            var expiry = jsondata.T_DATA[index].expiry;
            var is_expired = jsondata.T_DATA[index].is_expired;
            var number = jsondata.T_DATA[index].number;
            var id = jsondata.T_DATA[index].id;
             
            if(!map.includes(description)){
              map.push(description);    // set any value to Map
               
              // if (expiry > date1) {
                var el1 = document.createElement("option");
                el1.textContent = description;
                el1.value = id;
                select1.appendChild(el1);
    
                var el2 = document.createElement("option");
                el2.textContent = description;
                el2.value = id;
                select2.appendChild(el2);
    
                var el3 = document.createElement("option");
                el3.textContent = description;
                el3.value = id;
                select3.appendChild(el3);
              // } 
          }
           
            // Object.keys(jsondata.T_DATA).forEach(function(key) { 
            //   for (var index2 in jsondata.T_DATA) {
            //     alert(jsondata.T_DATA[index2].description);
            //   if (obj.T_DATA[index2].key !=  description) {
            //     data.push(description);
            //     console.log(data);
            //   }
            // }
            // });
            
            
          }


          var el1 = document.createElement("option");
          el1.textContent = 'ADD NEW ID';
          el1.value = 'add_id';
          select1.appendChild(el1);

          var el2 = document.createElement("option");
          el2.textContent = 'ADD NEW ID';
          el2.value = 'add_id';
          select2.appendChild(el2);

          var el3 = document.createElement("option");
          el3.textContent = 'ADD NEW ID';
          el3.value = 'add_id';
          select3.appendChild(el3);
        }
      }
    });
    getidcount++;
  }
}

var countnew = 0;

function fetch_remitpayout_id_types_western(descselect) {

  var transtype = $('a[id=aFindPaymaya]').data('id').split('|');
  //console.log(transtype);

  if (transtype[1] != 'PAYOUT') {
    var senderDetails = $("#inputSenderHide").val().split('|');
  } else {
    var senderDetails = $("#inputBeneficiaryHide").val().split('|');
  }

  //console.log(senderDetails);

  var benefname = senderDetails[5];
  var benemname = senderDetails[6];
  var benelname = senderDetails[7];
  var benebdate = senderDetails[8];

  var parameters = { benefname: benefname, benemname: benemname, benelname: benelname, benebdate: benebdate };
  // console.log(parameters);
  $.ajax({
      url: "/Ecash_payout/fetch_payout_id",
      type: "POST",
      data: parameters,
      success: function (data) {

        var arrayId = [];
        JSON.parse(data).T_DATA.map(e => new Date(e.expiry).getTime() > Date.now() ? arrayId.push(e.description): "");
       
    $.ajax({
      url: "/Ecash_payout/fetch_remitpayout_id_types",
      type: "POST",
      data: parameters,

      success: function (data) {
        var jsondata = JSON.parse(data);

        if (jsondata.S == 1) {

          if (countnew == 0) {

            for (var index in jsondata.T_DATA) {
              var id = jsondata.T_DATA[index].id;
              var desc = jsondata.T_DATA[index].description;
              var rule = jsondata.T_DATA[index].rule;
              var expirable = jsondata.T_DATA[index].expirable; 
              var format = jsondata.T_DATA[index].placeholder;  
            
              
              if (!arrayId.includes(desc)) {
                var select = document.getElementById("newidtype"); 
                var el = document.createElement("option");
                el.textContent = desc;
                el.value = id;
                select.appendChild(el); 
                new_id_rule.push({ id: id, "rule": rule, "expirable": expirable, "format": format }); 
              } 
              countnew++; 
            } 
          } 
          var dd = document.getElementById('newidtype'); 
          for (var i = 0; i < dd.options.length; i++) {
            if (dd.options[i].text === descselect) {
              dd.selectedIndex = i;
              break;
            }
          }
        } 
      }
    });
  }
  });
}
var create_new = 0;
var validID;
$("#newidtype").change(function () {
  var selected = $("option:selected", $(this)).val();
  
  JSON.parse(validID).forEach(element => {
    
    if (selected == element.id){ 
      console.log(element);
      if(element.placeholder && element.placeholder != ' '){  
        $('#valID').show();
        $('#valID').text(element.description.toUpperCase()+" FORMAT: "+element.placeholder); 
        // console.log(document.getElementById('formatID').value); 
      }else {
        $('#valID').hide(); 
      } 
    }
   });  
  //  console.log(obj);
});
/* GET ID DETAILS ON CHANGE OF ID#1*/
$("#selvalidID1_western").change(function () {
  
  // Get the selected value
  var selected = $("option:selected", $(this)).val();
  // Get the ID of this element
  var thisID = $(this).prop("id");
  
  // Reset so all values are showing:
  $(".preferenceSelectwestern option").each(function () {
    if ($(this).prop("value") != '' || $(this).prop("value") != 'add_id') {
      $(this).prop("disabled", false);
    }
  });

  $(".preferenceSelectwestern").each(function () {
    if ($(this).prop("id") != thisID) {

      $("option[value='" + selected + "']", $(this)).prop("disabled", true);
    }
  });

  $modal = $('#myModalWestern');
  $("#spinAnimationWestern3").css("display", "none");
  $("#newidtype").css("display", "block");

  var id1_val = $("#selvalidID1_western").val();

  if (id1_val == 'add_id') {
    $("#id_details1_western").hide(); 
    document.getElementById("dataWestern").reset();

    fetch_remitpayout_id_types_western();

    $("#newheading").html("ADD NEW ID");
    $("#updateexpired").hide();
    $("#addnewsuccess").hide();
    document.getElementById('newidtype').selectedIndex = 0;
    create_new = 0;
    $("#newidtype").prop("disabled", false);
    $("#westernidtype").val("prime_id");
    document.getElementById('selvalidID1_western').selectedIndex = 0;
    $.ajax({
      url: "/Ecash_payout/validID",
      type: "POST", 
      success: function (data) {
        validID = data;
        console.log(data);
      }});

  
    setTimeout(function () {
      $modal.modal('show');
    }, 500);
  
    //RefreshListWestern();

  }
  else if (id1_val != 'add_id' && id1_val != '') {

    var selvalidID1_western = $("#selvalidID1_western").val();

    var transtype = $('a[id=aFindPaymaya]').data('id').split('|');
    //console.log(transtype);

    if (transtype[1] != 'PAYOUT') {
      var senderDetails = $("#inputSenderHide").val().split('|');
    } else {
      var senderDetails = $("#inputBeneficiaryHide").val().split('|');
    }

    // console.log(senderDetails);


    var benefname = senderDetails[5];
    var benemname = senderDetails[6];
    var benelname = senderDetails[7];
    var benebdate = senderDetails[8];

    var parameters = { benefname: benefname, benemname: benemname, benelname: benelname, benebdate: benebdate };
    $("#btnWesternSubmit").attr('disabled', 'disabled');
    $.ajax({
      url: "/Ecash_payout/fetch_payout_id",
      type: "POST",
      data: parameters,

      success: function (data) {
        $("#btnWesternSubmit").removeAttr('disabled');
        var jsondata = JSON.parse(data);
 

        if (jsondata.S == 1) {

          for (var index in jsondata.T_DATA) {

            var id = jsondata.T_DATA[index].id;

            if (selvalidID1_western == id) {
              var is_expired = jsondata.T_DATA[index].is_expired;
              if (is_expired == 'VALID') {
                var attachment = jsondata.T_DATA[index].attachment;
                var created = jsondata.T_DATA[index].created;
                var description = jsondata.T_DATA[index].description;
                var expiry = jsondata.T_DATA[index].expiry;
                var number = jsondata.T_DATA[index].number;


                document.getElementById("id_detailtype1").value = description;
                document.getElementById("id_detailnumber1").value = number;
                document.getElementById("id_detailexpiry1").value = expiry;
                document.getElementById("id_detailcreated1").value = created;
                document.getElementById("id_attachment1").href = attachment;
                $("#id_details1_western").show();
              }
              else {
                var expiry = jsondata.T_DATA[index].expiry;
                var number = jsondata.T_DATA[index].number;
                var description = jsondata.T_DATA[index].description;
                $("#id_details1_western").hide();

                document.getElementById("id_detailtype1").value = '';
                document.getElementById("id_detailnumber1").value = '';
                document.getElementById("id_detailexpiry1").value = '';
                document.getElementById("id_detailcreated1").value = '';
                document.getElementById("id_attachment1").href = '';

                fetch_remitpayout_id_types_western(description);
                document.getElementById("newidnumber").value = number;
                document.getElementById("newexpirydate").value = expiry;
                document.getElementById("file").value = '';


                $("#newheading").html("UPDATE ID");
                $("#updateexpired").html("This type of ID is expired, Please update.");
                $("#updateexpired").show();
                create_new = 1;
                $("#addnewsuccess").hide();
                $("#newidtype").prop("disabled", true);
                setTimeout(function () {
                  $modal.modal('show');
                }, 500);
              }
            }

          }


        }
      }
    });

    waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'primary' });
    setTimeout(function () {
      waitingDialog.hide();
    }, 1000);
  }
  else if (id1_val == '') {
    $("#id_details1_western").hide();
  }
  else {
    $("#id_details1_western").hide();
  }

});

/* GET ID DETAILS ON CHANGE OF ID#2*/
$("#selvalidID2_western").change(function () {
  // Get the selected value
  var selected = $("option:selected", $(this)).val();
  // Get the ID of this element
 
  var thisID = $(this).prop("id");
  // Reset so all values are showing:
  $(".preferenceSelectwestern option").each(function () {
    if ($(this).prop("value") != '' || $(this).prop("value") != 'add_id') {
      $(this).prop("disabled", false);
    }
  });

  $(".preferenceSelectwestern").each(function () {
    if ($(this).prop("id") != thisID) {

      $("option[value='" + selected + "']", $(this)).prop("disabled", true);
    }
  });

  $modal = $('#myModalWestern');
  $("#spinAnimationWestern3").css("display", "none");
  $("#newidtype").css("display", "block");

  var id2_val = $("#selvalidID2_western").val();
  if (id2_val == 'add_id') {
    $("#id_details2_western").hide();

    document.getElementById("dataWestern").reset();

    fetch_remitpayout_id_types_western();

    $("#newheading").html("ADD NEW ID");
    $("#updateexpired").hide();
    $("#addnewsuccess").hide();
    document.getElementById('newidtype').selectedIndex = 0;
    create_new = 0;

    $("#newidtype").prop("disabled", false);
    $("#westernidtype").val("sec_id");
    setTimeout(function () {
      $modal.modal('show');
    }, 500);
    //RefreshListWestern();

  }
  else if (id2_val != 'add_id' && id2_val != '') {
    var selvalidID2_western = $("#selvalidID2_western").val();
    var transtype = $('a[id=aFindPaymaya]').data('id').split('|');
    //console.log(transtype);

    if (transtype[1] != 'PAYOUT') {
      var senderDetails = $("#inputSenderHide").val().split('|');
    } else {
      var senderDetails = $("#inputBeneficiaryHide").val().split('|');
    }

    //console.log(senderDetails);

    var benefname = senderDetails[5];
    var benemname = senderDetails[6];
    var benelname = senderDetails[7];
    var benebdate = senderDetails[8];

    var parameters = { benefname: benefname, benemname: benemname, benelname: benelname, benebdate: benebdate };

    $.ajax({
      url: "/Ecash_payout/fetch_payout_id",
      type: "POST",
      data: parameters,

      success: function (data) {
        var jsondata = JSON.parse(data);

        if (jsondata.S == 1) {

          for (var index in jsondata.T_DATA) {

            var id = jsondata.T_DATA[index].id;

            if (selvalidID2_western == id) {
              var is_expired = jsondata.T_DATA[index].is_expired;
              if (is_expired == 'VALID') {
                var attachment = jsondata.T_DATA[index].attachment;
                var created = jsondata.T_DATA[index].created;
                var description = jsondata.T_DATA[index].description;
                var expiry = jsondata.T_DATA[index].expiry;
                var number = jsondata.T_DATA[index].number;


                document.getElementById("id_detailtype2").value = description;
                document.getElementById("id_detailnumber2").value = number;
                document.getElementById("id_detailexpiry2").value = expiry;
                document.getElementById("id_detailcreated2").value = created;
                document.getElementById("id_attachment2").href = attachment;
                $("#id_details2_western").show();
              }
              else {
                var expiry = jsondata.T_DATA[index].expiry;
                var number = jsondata.T_DATA[index].number;
                var description = jsondata.T_DATA[index].description;
                $("#id_details2_western").hide();

                document.getElementById("id_detailtype2").value = '';
                document.getElementById("id_detailnumber2").value = '';
                document.getElementById("id_detailexpiry2").value = '';
                document.getElementById("id_detailcreated2").value = '';
                document.getElementById("id_attachment2").href = '';

                fetch_remitpayout_id_types_western(description);
                document.getElementById("newidnumber").value = number;
                document.getElementById("newexpirydate").value = expiry;
                document.getElementById("file").value = '';

                $("#newheading").html("UPDATE ID");
                $("#updateexpired").html("This type of ID is expired, Please update.");
                $("#updateexpired").show();
                create_new = 2;
                $("#addnewsuccess").hide();
                $("#newidtype").prop("disabled", true);
                setTimeout(function () {
                  $modal.modal('show');
                }, 500);
              }
            }

          }


        }
      }
    });

    waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'primary' });
    setTimeout(function () {
      waitingDialog.hide();
    }, 1000);
  }
  else {
    $("#id_details2_western").hide();
  }

});


/* GET ID DETAILS ON CHANGE OF ID#2*/
$("#selvalidID3_western").change(function () {
  // Get the selected value
  var selected = $("option:selected", $(this)).val();
  // Get the ID of this element
  var thisID = $(this).prop("id");
  // Reset so all values are showing:
  $(".preferenceSelectwestern option").each(function () {
    if ($(this).prop("value") != '' || $(this).prop("value") != 'add_id') {
      $(this).prop("disabled", false);
    }
  });

  $(".preferenceSelectwestern").each(function () {
    if ($(this).prop("id") != thisID) {

      $("option[value='" + selected + "']", $(this)).prop("disabled", true);
    }
  });

  $modal = $('#myModalWestern');
  $("#spinAnimationWestern3").css("display", "none");
  $("#newidtype").css("display", "block");

  var id3_val = $("#selvalidID3_western").val();
  if (id3_val == 'add_id') {
    $("#id_details3_western").hide();

    document.getElementById("dataWestern").reset();

    fetch_remitpayout_id_types_western();

    $("#newheading").html("ADD NEW ID");
    $("#updateexpired").hide();
    $("#addnewsuccess").hide();
    document.getElementById('newidtype').selectedIndex = 0;
    create_new = 0;

    $("#newidtype").prop("disabled", false);
    $("#westernidtype").val("ter_id");
    setTimeout(function () {
      $modal.modal('show');
    }, 500);
    //RefreshListWestern();

  }
  else if (id3_val != 'add_id' && id3_val != '') {
    var selvalidID3_western = $("#selvalidID3_western").val();
    var transtype = $('a[id=aFindPaymaya]').data('id').split('|');
    //console.log(transtype);

    if (transtype[1] != 'PAYOUT') {
      var senderDetails = $("#inputSenderHide").val().split('|');
    } else {
      var senderDetails = $("#inputBeneficiaryHide").val().split('|');
    }

    //console.log(senderDetails);

    var benefname = senderDetails[5];
    var benemname = senderDetails[6];
    var benelname = senderDetails[7];
    var benebdate = senderDetails[8];

    var parameters = { benefname: benefname, benemname: benemname, benelname: benelname, benebdate: benebdate };

    $.ajax({
      url: "/Ecash_payout/fetch_payout_id",
      type: "POST",
      data: parameters,

      success: function (data) {
        var jsondata = JSON.parse(data);

        if (jsondata.S == 1) {

          for (var index in jsondata.T_DATA) {

            var id = jsondata.T_DATA[index].id;

            if (selvalidID3_western == id) {
              var is_expired = jsondata.T_DATA[index].is_expired;
              if (is_expired == 'VALID') {
                var attachment = jsondata.T_DATA[index].attachment;
                var created = jsondata.T_DATA[index].created;
                var description = jsondata.T_DATA[index].description;
                var expiry = jsondata.T_DATA[index].expiry;
                var number = jsondata.T_DATA[index].number;


                document.getElementById("id_detailtype3").value = description;
                document.getElementById("id_detailnumber3").value = number;
                document.getElementById("id_detailexpiry3").value = expiry;
                document.getElementById("id_detailcreated3").value = created;
                document.getElementById("id_attachment3").href = attachment;
                $("#id_details3_western").show();
              }
              else {
                var expiry = jsondata.T_DATA[index].expiry;
                var number = jsondata.T_DATA[index].number;
                var description = jsondata.T_DATA[index].description;
                $("#id_details3_western").hide();

                document.getElementById("id_detailtype3").value = '';
                document.getElementById("id_detailnumber3").value = '';
                document.getElementById("id_detailexpiry3").value = '';
                document.getElementById("id_detailcreated3").value = '';
                document.getElementById("id_attachment3").href = '';

                fetch_remitpayout_id_types_western(description);
                document.getElementById("newidnumber").value = number;
                document.getElementById("newexpirydate").value = expiry;
                document.getElementById("file").value = '';

                $("#newheading").html("UPDATE ID");
                $("#updateexpired").html("This type of ID is expired, Please update.");
                $("#updateexpired").show();
                create_new = 3;
                $("#addnewsuccess").hide();
                $("#newidtype").prop("disabled", true);
                setTimeout(function () {
                  $modal.modal('show');
                }, 500);
              }
            }

          }


        }
      }
    });

    waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'primary' });
    setTimeout(function () {
      waitingDialog.hide();
    }, 1000);
  }
  else {
    $("#id_details3_western").hide();
  }

});

$("#newidnumber").change(function () {

  var newidtype = $("#newidtype").val();
  var newidnumber = $("#newidnumber").val();
  
  ///////////////////adddddd  code here to generate valid id format








































  
  new_id_rule.forEach(function (arrayItem) {

    var id = arrayItem.id;
    var rule = arrayItem.rule;

    var rule = rule.replace("/g", "");
    var rule = rule.replace("/", "");
    // var rule = rule.replace("^", "");

    var rules = new RegExp(rule, "g");

    if (newidtype == id) {
      
      if (rules.test(newidnumber)) {
        $("#updateexpired").hide();
      }
      else {
         
        
        $("#updateexpired").html("Please match the format of the ID type chosen.");
        $("#updateexpired").show();

      }

    }
  });
});


$("#newidtype").change(function () {
  var newidtype = $("#newidtype").val();

  new_id_rule.forEach(function (arrayItem) {
    var id = arrayItem.id;
    var expirable = arrayItem.expirable;
    var format = arrayItem.format;
    
    if (newidtype == id) { 
      if (expirable == 'YES') {
        $("#newexpirydate").prop("disabled", false);
        document.getElementById("newexpirydate").value = '';
      }
      else {
        $("#newexpirydate").prop("disabled", true);
        document.getElementById("newexpirydate").value = 'N/A';
      }
    }



  });
});


var _validFileExtensions = [".jpg", ".jpeg", ".png"];
function ValidateSingleInputWestern(oInput) {
  if (oInput.type == "file") {
    var sFileName = oInput.value;
    if (sFileName.length > 0) {
      var blnValid = false;
      for (var j = 0; j < _validFileExtensions.length; j++) {
        var sCurExtension = _validFileExtensions[j];
        if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
          blnValid = true;
          break;
        }
      }

      if (!blnValid) {
        alert("Your uploaded file type is not allowed \n\n Allowed extensions are: " + _validFileExtensions.join(", "));
        oInput.value = "";
        return false;
      }
    }
  }
  return true;
}


function RefreshListWestern() {

  $("#id_details1_western").hide();
  $("#id_details2_western").hide();
  $("#id_details3_western").hide();
  westernfetchpayoutIDs();

}

/*INSERT NEW ID */
$("form#dataWestern").submit(function () {

  waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'primary' });

  var newidtype = $("#newidtype").val();
  var newidnumber = $("#newidnumber").val();

  document.getElementById("newidtype2").value = newidtype;

  $("#updateexpired").hide();

  new_id_rule.forEach(function (arrayItem) {

    var id = arrayItem.id;
    var rule = arrayItem.rule;

    var rule = rule.replace("/g", "");
    var rule = rule.replace("/", "");
    // var rule = rule.replace("^", "");

    var rules = new RegExp(rule, "g");

    if (newidtype == id) {

      if (rules.test(newidnumber)) {
        waitingDialog.hide();
        $("#updateexpired").hide();

        setTimeout(function () {
          add_western_new_id();
        }, 1000);
        $("#newexpirydate").prop("disabled", false);
        //RefreshListWestern();

      }
      else {
        waitingDialog.hide();
        $("#updateexpired").html("Please match the format of the ID type chosen asdasd.");

        setTimeout(function () {
          $("#updateexpired").show();
        }, 1000);

      }

    }


  });

  return false;

});

function add_western_new_id() {
  var transtype = $('a[id=aFindPaymaya]').data('id').split('|');
  //console.log(transtype);

  if (transtype[1] != 'PAYOUT') {
    var senderDetails = $("#inputSenderHide").val().split('|');
  } else {
    var senderDetails = $("#inputBeneficiaryHide").val().split('|');
  }

  //console.log(senderDetails);

  var benefname = senderDetails[5];
  var benemname = senderDetails[6];
  var benelname = senderDetails[7];
  var benebdate = senderDetails[8];

  var newexpirydate = $("#newexpirydate").val();

  var newidtype2 = $("#newidtype2").val();
  var selvalidID1_western = $("#selvalidID1_western").val();
  var selvalidID2_western = $("#selvalidID2_western").val();
  var selvalidID3_western = $("#selvalidID3_western").val();
  var id_type_western = $("#westernidtype").val();

  var transtype = $("#transtype").val();

  var formData = new FormData($('#dataWestern')[0]);

  formData.append('benefname', benefname);
  formData.append('benemname', benemname);
  formData.append('benelname', benelname);
  formData.append('benebdate', benebdate);
  formData.append('selvalidID1', selvalidID1_western);
  formData.append('selvalidID2', selvalidID2_western);
  formData.append('selvalidID3', selvalidID3_western);
  formData.append('newexpirydate', newexpirydate);

  formData.append('newidtype', newidtype2);

  formData.append('create_new', create_new);
  formData.append('transtype', transtype);

  $.ajax({
    url: "/Ecash_send/add_newid_payout",
    type: 'POST',
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    processData: false,

    success: function (data) {

      var jsondata = JSON.parse(data);
      // alert("asdasd");
      if (jsondata.S != 1) {
        $("#updateexpired").html(jsondata.M);
        $("#updateexpired").show();
        $("#addnewsuccess").hide();
      }
      else {
        $("#addnewsuccess").html(jsondata.M + ". Please wait for the approval from our technical support.");
        $("#addnewsuccess").show();
        $("#updateexpired").hide();

        var attachment = jsondata.T_DATA.attachment;
        var created = jsondata.T_DATA.created;
        var description = jsondata.T_DATA.description;
        var expiry = jsondata.T_DATA.expiry;
        var is_expired = jsondata.T_DATA.is_expired;
        var number = jsondata.T_DATA.number;
        var id = jsondata.T_DATA.id;

        if (id_type_western == 'prime_id') {

          removeOptionsWestern(document.getElementById("selvalidID1_western"));

          var select1 = document.getElementById("selvalidID1_western");

          var el1 = document.createElement("option");
          el1.textContent = '--CHOOSE ID--';
          el1.value = '';
          el1.disabled = true;
          select1.appendChild(el1);

          var el1 = document.createElement("option");
          el1.textContent = description;
          el1.value = id;
          el1.selected = true;
          select1.appendChild(el1);

          var el1 = document.createElement("option");
          el1.textContent = '--ADD NEW ID--';
          el1.value = 'add_id';
          select1.appendChild(el1);

          document.getElementById("id_detailtype1").value = description;
          document.getElementById("id_detailnumber1").value = number;
          document.getElementById("id_detailexpiry1").value = expiry;
          document.getElementById("id_detailcreated1").value = created;
          document.getElementById("id_attachment1").href = attachment;
          $("#id_details1_western").show();

        } else if (id_type_western == 'sec_id') {

          removeOptionsWestern(document.getElementById("selvalidID2_western"));

          var select2 = document.getElementById("selvalidID2_western");

          var el2 = document.createElement("option");
          el2.textContent = '--CHOOSE ID--';
          el2.value = '';
          el2.disabled = true;
          select2.appendChild(el2);

          var el2 = document.createElement("option");
          el2.textContent = description;
          el2.value = id;
          el2.selected = true;
          select2.appendChild(el2);

          var el2 = document.createElement("option");
          el2.textContent = '--ADD NEW ID--';
          el2.value = 'add_id';
          select2.appendChild(el2);

          document.getElementById("id_detailtype2").value = description;
          document.getElementById("id_detailnumber2").value = number;
          document.getElementById("id_detailexpiry2").value = expiry;
          document.getElementById("id_detailcreated2").value = created;
          document.getElementById("id_attachment2").href = attachment;
          $("#id_details2_western").show();

        } else if (id_type_western == 'ter_id') {

          removeOptionsWestern(document.getElementById("selvalidID3_western"));

          var select3 = document.getElementById("selvalidID3_western");

          var el3 = document.createElement("option");
          el3.textContent = '--CHOOSE ID--';
          el3.value = '';
          el3.disabled = true;
          select3.appendChild(el3);

          var el3 = document.createElement("option");
          el3.textContent = description;
          el3.value = id;
          el3.selected = true;
          select3.appendChild(el3);

          var el3 = document.createElement("option");
          el3.textContent = '--ADD NEW ID--';
          el3.value = 'add_id';
          select3.appendChild(el3);

          document.getElementById("id_detailtype3").value = description;
          document.getElementById("id_detailnumber3").value = number;
          document.getElementById("id_detailexpiry3").value = expiry;
          document.getElementById("id_detailcreated3").value = created;
          document.getElementById("id_attachment3").href = attachment;
          $("#id_details3_western").show();

        }

        setTimeout(function () {
          // $('#myModalWestern').modal('hide');
          RefreshListWestern()
        }, 1500);
      }
    }

  });
}


$('#newexpirydate').datetimepicker({
  dateFormat: 'yy-mm-dd',
  changeMonth: true,
  changeYear: true,
  timepicker: false,
  altField: "#newexpirydate",
  altFormat: "yy-mm-dd",
  formatDate: 'Y-m-d',
  format: 'Y-m-d'
});

$('#benefbdate').datetimepicker({
  dateFormat: 'yy-mm-dd',
  changeMonth: true,
  changeYear: true,
  changeTime: false,
  timepicker: false,
  altField: "#newexpirydate",
  altFormat: "yy-mm-dd",
  formatDate: 'Y-m-d',
  format: 'Y-m-d'
});
$("#btnRefreshIdList").on('click', function (e) {
  // $("#btnRefreshIdList").click(function (e) {
  e.preventDefault();
  alert("Push");
  westernfetchpayoutIDs();
});

