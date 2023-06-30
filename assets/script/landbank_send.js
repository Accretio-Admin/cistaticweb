$('#addSenderBeneWU').click(() => { 
    $('#selCountry').val('Philippines')

    if ($('#selCountry').val() === 'Philippines') { 
    $('#modSelectProvince').show()
    $('#modSelectProvince').attr('required', 'true');

    $('#modInputProvince').hide()
    $('#modInputProvince').removeAttr('required')
    } else {
    $('#modSelectProvince').hide()
    $('#modSelectProvince').removeAttr('required')

    $('#modInputProvince').show()
    $('#modInputProvince').attr('required', 'true');
    }
})

$('#selCountry').on('change', () => {
    if ($('#selCountry').val() === 'Philippines') { 
    $('#modSelectProvince').show()
    $('#modSelectProvince').attr('required', 'true')

    $('#modInputProvince').hide()
    $('#modInputProvince').removeAttr('required')
    } else {
    $('#modSelectProvince').hide()
    $('#modSelectProvince').removeAttr('required')

    $('#modInputProvince').show()
    $('#modInputProvince').attr('required', 'true')
    }
})

$('#frmLandbankSender').submit((e) => {
  e.preventDefault()

  waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'})

  var params = {
      first_name: $('#inputFname').val(),
      middle_name: $('#inputMname').val(),
      last_name: $('#inputLname').val(),
      house_st: $('#modInputStreet').val(),
      brgy: $('#modInputBrgy').val(),
      city: $('#modInputCity').val(),
      province: $('#selCountry').val() == 'Philippines' ||  $('#selCountry').val() == 'PHILIPPINES' ? $('#modSelectProvince').val() : $('#modInputProvince').val(),
      country: $('#selCountry').val(),
      zip_code: $('#modInputZipCode').val(),
      area_code: $('#modInputAreaCode').val(),
      nationality: $('#modInputNationality').val(),
      gender: $('#selGender').val(),
      profession: $('#inputProfession').val(),
      mobile_no: $('#inputMobileNo').val(),
      phone_no: $('#inputPhoneNo').val(),
      office_no: $('#inputOfficeNo').val(),
      birth_date: $('#inputBdate').val(),
      civil_status: $('#selCivilStatus').val(),
      email_add: $('#inputEmail').val(),
      transpass: $('#inputTpass').val()
  }

  $.ajax({
      url: '/ecash_send/landbank_sender_add',
      type: 'POST',
      data: params,
      success: (data) => {
          console.log('here1',data,params)
          var jsonData = JSON.parse(data)

          if (jsonData.S == 1) {

              $("#alertDynammic").css('display','block');
              $("#alertDynammic").addClass("alert alert-success col-md-12 text-error alert-dismissable");
              $("#alertDynammic").html("<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + jsondata.M);
              $("#alertDynammic").fadeTo(8000, 6000).slideUp(6000, function(){
                $("#alertDynammic").slideUp(6000);
                $("#alertDynammic").removeClass();
              });
              setTimeout(function(){
                gotoEnd();
              }, 8000);
              console.log(jsondata.M)

          } else {

              $("#alertDynammic").css('display','block');
              $("#alertDynammic").addClass("alert alert-danger col-md-12 text-error alert-dismissable");
              $("#alertDynammic").html("<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + jsondata.M);
              $("#alertDynammic").fadeTo(6000, 4000).slideUp(4000, function(){
                $("#alertDynammic").slideUp(4000);
                $("#alertDynammic").removeClass();
              });

          }

          waitingDialog.hide()
      }
  })

  waitingDialog.hide()
})



if ($('#inputLandbankSenderName').val() == ""){
    $('#inputLandbankBeneficiaryName').attr('readonly',true);
    $("#inputSenderHide").val();
} else {
    $('#inputLandbankSenderName').attr('readonly',true);
    $('#inputLandbankBeneficiaryName').focus();
}


//find button
$('a[id=aFind]').on('click',function() {

    var index = $(this).index('a[id=aFind]');
    var data = $(this).data('id').split('|');
    var sender = $('#inputLandbankSenderName');
    var beneficiary = $('#inputLandbankBeneficiaryName');
    var inputSenderHide = $("#inputSenderHide");
    var inputBeneficiaryHide = $("#inputBeneficiaryHide");
    var str =[];
    var i = 0;
    //console.log(inputBeneficiaryHide);

    $(".tr").eq(index).find(".td").each(function() {   //GET information from table (HTML)
       str[i] = $(this).text();
      i++;
    }); 

    if (data[0] == 1 ) 
    {
      sender.val(str[1]);
      if (sender.val() != "") {
        beneficiary.removeAttr('readonly');
        sender.attr('readonly',true); 
        beneficiary.focus();
        inputSenderHide.val(str[0] + "|" + str[1] + "|" + str[2] + "|" + str[3] + "|" + str[4] + "|" + str[5] + "|" + str[6] + "|" + str[7]);
      }
    }
    else if (data[0] == 2)
    {
      $('.btnProceed').show();
      beneficiary.val(str[1]);
      inputBeneficiaryHide.val(str[0] + "|" + str[1] + "|" + str[2] + "|" + str[3] + "|" + str[4] + "|" + str[5] + "|" + str[6] + "|" + str[7]);
    }    
});

$('.btnProceed').click(function() {
    
    var inputSenderHide = $("#inputSenderHide").val().split('|');
    var inputBeneficiaryHide = $("#inputBeneficiaryHide").val().split('|');
    var transtype = $('a[id=aFind]').data('id').split('|');

    $("#stepOne").css('display','none');
    
    // sender
    $('#inputSenderID').val(inputSenderHide[0]);
    $('#inputSenderName').val(inputSenderHide[1]);
    $('#inputSenderAddress').val(inputSenderHide[2]);
    $('#inputMobileNo').val(inputSenderHide[3]);
    $('#inputSenderEmail').val(inputSenderHide[4]);
    // beneficiary
    $('#inputBeneficiaryID').val(inputBeneficiaryHide[0]);
    $('#inputBeneficiaryName').val(inputBeneficiaryHide[1]);
    $('#inputBeneficiaryAddress').val(inputBeneficiaryHide[2]);
    $('#inputBeneficiaryMobile').val(inputBeneficiaryHide[3]);
    $('#inputBeneficiaryEmail').val(inputBeneficiaryHide[4]);
    $('#benefbdate').val(inputBeneficiaryHide[8]);
    $('#spanCoverage').html(`This transaction is for ${inputBeneficiaryHide[9]}.`);

    $("#stepTwo").css('display','block');
    $("#id_details2_western").hide();
    $("#id_details3_western").hide();

    // if(transtype[1] != 'PAYOUT'){
    westernfetchpayoutIDs();
    // }
});
    
    

$("#frmLandBankPayout").on("submit",function(event){
    event.preventDefault();
    //waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});

    // var refno = $("#frmLandBankPayout #inputReferenceNo").val();
    var transpass = $("#frmLandBankPayout #inputTpass").val();
    var sender_id = $("#frmLandBankPayout #inputSenderID").val();
    var s_country_birth = $("#frmLandBankPayout #inputCountryBirth").val();
    var s_nationality = $("#frmLandBankPayout #inputNationality").val();
    var s_relationship_to_beneficiary = $("#frmLandBankPayout #inputRelationshiptoBene").val();
    var s_occupation = $("#frmLandBankPayout #inputOccupation").val();
    var s_employer = $("#frmLandBankPayout #inputEmployer").val();
    var s_source_of_fund = $("#frmLandBankPayout #inputSourceofFund").val();

    var beneficiary_id = $("#frmLandBankPayout #inputBeneficiaryID").val();
    var b_country_birth = $("#frmLandBankPayout #inputBeneficiaryCountryBirth").val();
    var b_nationality = $("#frmLandBankPayout #inputBeneficiaryNationality").val();
    var b_relationship_to_sender = $("#frmLandBankPayout #inputBeneficiaryRelationshiptoSender").val();
    var b_occupation = $("#frmLandBankPayout #inputBeneficiaryOccupation").val();
    var b_employer = $("#frmLandBankPayout #inputBeneficiaryEmployer").val();
    var b_source_of_fund = $("#frmLandBankPayout #inputBeneficiarySourceofFund").val();

    var amount = $("#frmLandBankPayout #inputPRINAmount").val();
    var account_no = $("#frmLandBankPayout #inputAccountNo").val();
    var primary_id = $("#frmLandBankPayout #selvalidID1_western").val();

  
    var parameters = {
      // refno:refno, 
      transpass:transpass, 
      sender_id:sender_id, 
      s_country_birth:s_country_birth,
      s_nationality:s_nationality,
      s_relationship_to_beneficiary:s_relationship_to_beneficiary,
      s_occupation:s_occupation,
      s_employer:s_employer,
      s_source_of_fund:s_source_of_fund,
      beneficiary_id:beneficiary_id, 
      b_country_birth:b_country_birth,
      b_nationality:b_nationality,
      b_relationship_to_sender:b_relationship_to_sender,
      b_occupation:b_occupation,
      b_employer:b_employer,
      b_source_of_fund:b_source_of_fund,
      amount:amount, 
      account_no:account_no,
      primary_id:primary_id
    };
    
    console.log('params',parameters);

    $.ajax({
      url: "/ecash_send/landbank_sender_add_transaction",
      type: "POST",
      data: parameters,
      success: function(data)
      {
        var jsondata = JSON.parse(data);
        console.log(jsondata);
        waitingDialog.hide();

        if(jsondata.S == 1) {
            $("#alertDynammic").css('display','block');
            $("#alertDynammic").addClass("alert alert-success col-md-12 text-error alert-dismissable");
            $("#alertDynammic").html("<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + jsondata.M + "<br><b><u>Tracking Number: " + jsondata.TN + "</u></b>");
            $("#alertDynammic").fadeTo(8000, 6000).slideUp(6000, function(){
              $("#alertDynammic").slideUp(6000);
              $("#alertDynammic").removeClass();
            });
            setTimeout(function(){
              gotoEnd();
            }, 8000);
            console.log(jsondata.M)
        } else {
          $("#alertDynammic").css('display','block');
          $("#alertDynammic").addClass("alert alert-danger col-md-12 text-error alert-dismissable");
          $("#alertDynammic").html("<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + jsondata.M);
          $("#alertDynammic").fadeTo(6000, 4000).slideUp(4000, function(){
            $("#alertDynammic").slideUp(4000);
            $("#alertDynammic").removeClass();
          });
        }
      }
    });
});


function gotoEnd() {
    var base_url = window.location.origin;
    var pathArray = window.location.pathname;

    window.location = base_url+pathArray;
}

$('#inputPRINAmount').bind('keyup', function() {
  var input2  = parseInt($('#inputPRINAmount').val());
  console.log (input2)
  var totalAmount = parseInt(input2+150);
  $('#inputTotalAmount').val(totalAmount);
  console.log (totalAmount)
});


/* GET ID DETAILS ON CHANGE OF ID#1*/
var create_new = 0;
$("#selvalidID1_western").change(function () {
 
   // Get the selected value
   var selected = $("option:selected", $(this)).val();
   // Get the ID of this element
   var thisID = $(this).prop("id");

   // Reset so all values are showing:
   $(".preferenceSelectwestern option").each(function() {
    if ($(this).prop("value") != '' || $(this).prop("value") != 'add_id') {
        $(this).prop("disabled", false);
      }
    });

    $(".preferenceSelectwestern").each(function() {
        if ($(this).prop("id") != thisID) {

            $("option[value='" + selected + "']", $(this)).prop("disabled", true);
        }
    });

      $modal = $('#myModalWestern');
      $("#spinAnimationWestern3").css("display","none");
      $("#newidtype").css("display","block");
      
      var id1_val = $("#selvalidID1_western").val();

      if(id1_val == 'add_id' )
      {
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
        setTimeout(function () {
          $modal.modal('show');
        }, 500);
        
        //RefreshListWestern();

      }
      else if(id1_val != 'add_id' && id1_val != '')
      {

          var selvalidID1_western = $("#selvalidID1_western").val();

          var transtype = $('a[id=aFindWestern]').data('id').split('|');
        //console.log(transtype);

          if(transtype[1] != 'PAYOUT'){
            var senderDetails = $("#inputSenderHide").val().split('|');
          } else{
            var senderDetails = $("#inputBeneficiaryHide").val().split('|');
          }

        //console.log(senderDetails);


          var benefname = senderDetails[5];
          var benemname = senderDetails[6];
          var benelname = senderDetails[7];
          var benebdate = senderDetails[8];

          var parameters = {benefname:benefname,benemname:benemname,benelname:benelname,benebdate:benebdate};

    $.ajax({
          url: "/Ecash_payout/fetch_payout_id",
          type: "POST",
          data: parameters,
          
          success: function(data)
          {
              var jsondata = JSON.parse(data);
              
              // console.log(jsondata);

              if(jsondata.S == 1){

                for(var index in jsondata.T_DATA) {

                  var id = jsondata.T_DATA[index].id;

                  if(selvalidID1_western == id)
                  {
                    var is_expired = jsondata.T_DATA[index].is_expired;
                    if(is_expired == 'VALID')
                    {
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
                    else
                    {
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

        waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
        setTimeout(function () {
          waitingDialog.hide();
        }, 1000);
      }
      else if(id1_val == '')
      {
        $("#id_details1_western").hide();
      }
      else
      {
        $("#id_details1_western").hide();
      }

});