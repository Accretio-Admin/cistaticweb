
// $('#benefbdate').on('click',function(){
//   westernfetchpayoutIDs();
// });

function RefreshListwestern() {
//console.log('putek');
      waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
    $("#id_details1_western").hide();
    $("#id_details2_western").hide();
    $("#id_details3_western").hide();
    waitingDialog.hide();
    westernfetchpayoutIDs();
}



  $("#frmmoneygramPayout").on("submit",function(event){
      event.preventDefault();
      waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});

      var refno = $("#frmmoneygramPayout #inputReferenceNo").val();
      var transpass = $("#frmmoneygramPayout #inputTpass").val();
      var sender_id = $("#frmmoneygramPayout #inputSenderID").val();
      var beneficiary_id = $("#frmmoneygramPayout #inputBeneficiaryID").val();
      var amount = $("#frmmoneygramPayout #inputPRINAmount").val();
      var currency = $("#frmmoneygramPayout #currency").val().split('|');
      var primaryId = $("#frmmoneygramPayout #selvalidID1_western").val();
      var secondaryId = $("#frmmoneygramPayout #selvalidID2_western").val();
      var tertiaryId = $("#frmmoneygramPayout #selvalidID3_western").val();
      var country = $("#frmmoneygramPayout #country_iso").val();
      var occupation = $("#frmmoneygramPayout #inputOccupation").val();
      var relationbene = $("#frmmoneygramPayout #inputRelationshiptoBene").val();
      var empname = $("#frmmoneygramPayout #inputEmployer").val();
      var fundsrc = $("#frmmoneygramPayout #inputSourceofFund").val();
      var countrybirth = $("#frmmoneygramPayout #inputCountryBirth").val();
      var nationality = $("#frmmoneygramPayout #inputNationality").val();

      var parameters = {refno:refno, transpass:transpass, sender_id:sender_id, beneficiary_id:beneficiary_id, amount:amount, currency:currency[0], primaryId:primaryId, secondaryId:secondaryId, tertiaryId:tertiaryId, country:country, occupation:occupation, relationbene:relationbene, empname:empname, fundsrc:fundsrc, countrybirth:countrybirth, nationality:nationality};
console.log(parameters);

        $.ajax({
          url: "/Ecash_payout/ecash_to_moneygram_payout_request",
          type: "POST",
          data: parameters,
              success: function(data)
              {
                  var jsondata = JSON.parse(data);
                  console.log(jsondata);

                  waitingDialog.hide();
                   if(jsondata.S == 1){
                    
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
                   }else{
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


  $('a[id=aCancel]').on('click',function(){
    var txnCancel = $(this).data('id');
    $('#myModal').modal('show');
    $('p[id=txnCanceltext]').text('Transaction Number: '+txnCancel);
    $('#inputTxnCancel').val(txnCancel);
  });


  $('a[id=btnBack]').on('click',function(){
      var base_url = window.location.origin;
      var pathArray = window.location.pathname;

      var url = base_url+pathArray;
      var to = url.lastIndexOf('/') +1;
      newURL =  url.substring(0,to);
      window.location = newURL;
  });

  $(document).ready(function() {
      $('.westernTable').DataTable( {
        "searching": true
      });
  } );

  $("#frmWesternSender").on("submit",function(event){
      event.preventDefault();
      waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});

      var transpass = $("#frmWesternSender #inputTpass").val();
      var sender_id = $("#frmWesternSender #inputSenderID").val();
      var beneficiary_id = $("#frmWesternSender #inputBeneficiaryID").val();
      var amount = $("#frmWesternSender #inputPRINAmount").val();
      var currency = $("#frmWesternSender #currency").val().split('|');
      var primaryId = $("#frmWesternSender #selvalidID1_western").val();
      var secondaryId = $("#frmWesternSender #selvalidID2_western").val();
      var tertiaryId = $("#frmWesternSender #selvalidID3_western").val();
      var country = $("#frmWesternSender #country_iso").val();
      var occupation = $("#frmWesternSender #inputOccupation").val();
      var relationbene = $("#frmWesternSender #inputRelationshiptoBene").val();
      var empname = $("#frmWesternSender #inputEmployer").val();
      var fundsrc = $("#frmWesternSender #inputSourceofFund").val();
      var countrybirth = $("#frmWesternSender #inputCountryBirth").val();
      var nationality = $("#frmWesternSender #inputNationality").val();

      var parameters = {transpass:transpass, sender_id:sender_id, beneficiary_id:beneficiary_id, amount:amount, currency:currency[0], primaryId:primaryId, secondaryId:secondaryId, tertiaryId:tertiaryId, country:country, occupation:occupation, relationbene:relationbene, empname:empname, fundsrc:fundsrc, countrybirth:countrybirth, nationality:nationality};
//console.log(parameters);

          $.ajax({
                type : 'POST',
                url  : "/Ecash_send/ecash_to_western_send",
                data : parameters,
                success :  function(data)
                { 

                  var jsondata = JSON.parse(data);

                   waitingDialog.hide();
                   if(jsondata.S == 1){
                    
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

                   }else{
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


  $('a[id=btnCancelWestern]').on('click',function(){
      setTimeout(function(){
        waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
      }, 2000);

      gotoEnd();
  });

  function gotoEnd(){
      var base_url = window.location.origin;
      var pathArray = window.location.pathname;

      window.location = base_url+pathArray;
  }

  $(document).ready(function(){
    $("#frmWesternSender, #frmWesternCancel").on("submit",function(){
      
      waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
    });
  });

 $("#country_iso").change(function () {
  $('#inputPRINAmount').prop("disabled", false);
  $('#inputPRINAmount, #inputSCAmount').val('');
  $('#currency option:eq(0)').prop('selected', true);
 });

  $(document).ready(function(){

    $('#inputPRINAmount').on('keyup', function(){
      $('#currency').prop("disabled", false);
        get_country_charge();
     });


   $("#currency").change(function () {
      get_country_charge();
   });

});


  function get_country_charge()
  {
    $('#inputSCAmount, #inputTotalAmount').css("display","none");
    $('.spinAnimationWesternCharge').css("display","block");

    var country = $('#country_iso').val();
    var amount = $('#inputPRINAmount').val();
    var currency = $('#currency').val().split('|');

    var parameters = {country:country,amount:amount,currency:currency[0]}; 

    $.ajax({
      url: "/Ecash_send/get_country_charge",
      type: "POST",
      data: parameters,
          success: function(data)
          {
              var jsondata = JSON.parse(data);

              $('#inputSCAmount, #inputTotalAmount').css("display","block");
              $('.spinAnimationWesternCharge').css("display","none");

              if(jsondata.S == 1){
                if(currency[0] == 'PHP'){
                    var totalamount = parseFloat(amount) + parseFloat(jsondata.C);
                    $('#inputSCAmount').val(jsondata.C);
                    $('#inputTotalAmount').val(totalamount.toFixed(2));
                } else{
                  var sc = parseFloat(jsondata.C) / parseFloat(currency[1]);
                  var totalamount = parseFloat(amount) + parseFloat(sc);
                  $('#inputSCAmount').val(sc.toFixed(2));
                  $('#inputTotalAmount').val(totalamount.toFixed(2));
                }
              } else{
                $('#inputSCAmount').css({'border-color': 'red', 'border-width': 'initial'});
                $('#inputSCAmount').val("Invalid Amount");
              }
          }
      });

  }

  $('#btnSender').hide();
  $('#btnBene').hide();





  // if ($('#inputWesternSenderName').val() == ""){
  //   $('#inputWesternBeneficiaryName').attr('readonly',true);
  //   $('#btnBene').hide();
  //   $("#inputSenderHide").val()

  // }else {
  //   $('#inputWesternSenderName').attr('readonly',true);
  //   $('#btnBene').show();
  //   $('#inputWesternBeneficiaryName').focus();

  // }

  $("#inputWesternSenderName").on('input', function (){
    if($('#inputWesternSenderName').val() == ""){
      $('#btnSender').hide();
    }else{
      $('#btnSender').show();
    }
  });

  $("#inputWesternBeneficiaryName").on('input', function (){
    if($('#inputWesternBeneficiaryName').val() == ""){
      $('#btnBene').hide();
    }else{
      $('#btnBene').show();
    }
  });
  
  $('a[id=aFindWestern]').on('click',function(){

    


    var index = $(this).index('a[id=aFindWestern]');
    var data = $(this).data('id').split('|');
    var uniq = $(this).data('uniq');
    var sender = $('#inputWesternSenderName');
    var beneficiary = $('#inputWesternBeneficiaryName');
    var inputSenderHide = $("#inputSenderHide");
    var inputBeneficiaryHide = $("#inputBeneficiaryHide");
    var str =[];



    // alert(uniq);




    var i = 0;
//console.log(inputBeneficiaryHide);

    $(".tr").eq(index).find(".td").each(function() {   //GET information from table (HTML)
       str[i] = $(this).text();
      i++;
    }); 
    console.log(str);
    if (data[0] == 1 ) 
    {
      sender.val(str[1]);
      if (sender.val() != "") {
        beneficiary.removeAttr('readonly');
        sender.attr('readonly',true); 
        beneficiary.focus();
        inputSenderHide.val(str[0] + "|" + str[1] + "|" + str[2] + "|" + str[3] + "|" + str[4] + "|" + str[5] + "|" + str[6]);
      }
    }
    else if (data[0] == 2)
    {
        if(str[1]==sender.val()) {
          alert('Sender cannot be same as Beneficiary');
      setTimeout(function(){
        $('.btnProceedWestern').hide();
        inputBeneficiaryHide.val('');
        beneficiary.val('');
      },7)
        } else {
          $('.btnProceedWestern').show();
          beneficiary.val(str[1]);
          inputBeneficiaryHide.val(str[0] + "|" + str[1] + "|" + str[2] + "|" + str[3] + "|" + str[4] + "|" + str[5] + "|" + str[6]);
        }
    }


    
  });
  // $("#inputBeneficiaryHide").change(function(){
  //   // if(inputSenderHide == inputBeneficiaryHide){
  //   //     alert("PAREHAS");
  //   //   }else{
  //   //     alert("HINDI");
  //   //   }
  //   alert($("#inputBeneficiaryHide").val());
  // })




  $('.btnProceedWestern').click(function(){
    var inputSenderHide = $("#inputSenderHide").val().split('|');
    var inputBeneficiaryHide = $("#inputBeneficiaryHide").val().split('|');
    var transtype = $('a[id=aFindWestern]').data('id').split('|');
    // if(inputSenderHide[0]==inputBeneficiaryHide[0]) {
    //   alert("Sender and Beneficiary cannot be the same");
    //   setTimeout(function(){
    //     $("#stepOne").css('display','block');
    //     $("#stepTwo").css('display','none');
    //   },500)
    // } else if(inputSenderHide[0]!=inputBeneficiaryHide[0]) {
      console.log('henlo');
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
  
      $("#stepTwo").css('display','block');
      $("#id_details2_western").hide();
      $("#id_details3_western").hide();
  
      // if(transtype[1] != 'PAYOUT'){
        westernfetchpayoutIDs();
      // }
    // }
  });


var getidcount = 0;
var new_id_rule = [];


function removeOptionsWestern(selectbox)
{
    var i;
    for(i = selectbox.options.length - 1 ; i >= 0 ; i--)
    {
        selectbox.remove(i);
    }
}

function westernfetchpayoutIDs(){
  var transtype = $('a[id=aFindWestern]').data('id').split('|');
//console.log(transtype);

  getidcount = 0;

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

  if(getidcount === 0)
  {
        $.ajax({
          url: "/Ecash_payout/fetch_payout_id",
          type: "POST",
          data: parameters,
              success: function(data)
              {
                  var jsondata = JSON.parse(data);
                if(jsondata.S == 1){

                  $("#spinAnimationWestern1, #spinAnimationWestern2").css("display","none");
                  $("#selvalidID1_western, #selvalidID2_western").css("display","block");
                  $("#selvalidID1_western, #selvalidID2_western").prop("disabled", false);  
                  $("#id_details1_western, #id_details2_western, #id_details3_western").hide();


                  removeOptionsWestern(document.getElementById("selvalidID1_western"));
                  removeOptionsWestern(document.getElementById("selvalidID2_western"));
                  removeOptionsWestern(document.getElementById("selvalidID3_western"));

                  var select1 = document.getElementById("selvalidID1_western");
                  var select2 = document.getElementById("selvalidID2_western");
                  var select3 = document.getElementById("selvalidID3_western");

                  var el1 = document.createElement("option");
                  el1.textContent = '--CHOOSE VALID ID--';
                  el1.value = '';
                  el1.disabled = true;
                  el1.selected = true;
                  select1.appendChild(el1);

                  var el2 = document.createElement("option");
                  el2.textContent = '--CHOOSE VALID ID--';
                  el2.value = '';
                  el2.disabled = true;
                  el2.selected = true;
                  select2.appendChild(el2);

                  var el3 = document.createElement("option");
                  el3.textContent = '--CHOOSE VALID ID--';
                  el3.value = '';
                  el3.disabled = true;
                  el3.selected = true;
                  select3.appendChild(el3);


                        for(var index in jsondata.T_DATA) {

                          var attachment = jsondata.T_DATA[index].attachment;
                          var created = jsondata.T_DATA[index].created;
                          var description = jsondata.T_DATA[index].description;
                          var expiry = jsondata.T_DATA[index].expiry;
                          var is_expired = jsondata.T_DATA[index].is_expired;
                          var number = jsondata.T_DATA[index].number;
                          var id = jsondata.T_DATA[index].id;


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
                        }


                          var el1 = document.createElement("option");
                          el1.textContent = '--ADD NEW ID--';
                          el1.value = 'add_id';
                          select1.appendChild(el1);

                          var el2 = document.createElement("option");
                          el2.textContent = '--ADD NEW ID--';
                          el2.value = 'add_id';
                          select2.appendChild(el2);

                          var el3 = document.createElement("option");
                          el3.textContent = '--ADD NEW ID--';
                          el3.value = 'add_id';
                          select3.appendChild(el3);
                  }
              }
      });
        getidcount++;
  }
}

  var countnew = 0;

  function fetch_remitpayout_id_types_western(descselect){

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
// console.log(parameters);
      $.ajax({
              url: "/Ecash_payout/fetch_remitpayout_id_types",
              type: "POST",
              data: parameters,
              
              success: function(data)
              {
                  var jsondata = JSON.parse(data);
                  
                  if(jsondata.S == 1)
                  {
                    
                    if(countnew == 0)
                    {

                      for(var index in jsondata.T_DATA) {

                        var id = jsondata.T_DATA[index].id;
                        var desc = jsondata.T_DATA[index].description;
                        var rule = jsondata.T_DATA[index].rule;     
                        var expirable = jsondata.T_DATA[index].expirable;     

                            var select = document.getElementById("newidtype");

                            var el = document.createElement("option");
                            el.textContent = desc;
                            el.value = id;
                            select.appendChild(el);

                            new_id_rule.push( { id:id, "rule":rule, "expirable":expirable } );

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
  var create_new = 0;
 /* GET ID DETAILS ON CHANGE OF ID#1*/
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

  /* GET ID DETAILS ON CHANGE OF ID#2*/
$("#selvalidID2_western").change(function () {
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

            var id2_val = $("#selvalidID2_western").val();
            if(id2_val == 'add_id')
            {
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
            else if(id2_val != 'add_id' && id2_val != '')
            {
                var selvalidID2_western = $("#selvalidID2_western").val();
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

                    if(jsondata.S == 1){

                      for(var index in jsondata.T_DATA) {

                        var id = jsondata.T_DATA[index].id;

                        if(selvalidID2_western == id)
                        {
                          var is_expired = jsondata.T_DATA[index].is_expired;
                          if(is_expired == 'VALID')
                          {
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
                          else
                          {
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

              waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
              setTimeout(function () {
                waitingDialog.hide();
              }, 1000);
            }
            else
            {
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

            var id3_val = $("#selvalidID3_western").val();
            if(id3_val == 'add_id')
            {
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
            else if(id3_val != 'add_id' && id3_val != '')
            {
                var selvalidID3_western = $("#selvalidID3_western").val();
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

                    if(jsondata.S == 1){

                      for(var index in jsondata.T_DATA) {

                        var id = jsondata.T_DATA[index].id;

                        if(selvalidID3_western == id)
                        {
                          var is_expired = jsondata.T_DATA[index].is_expired;
                          if(is_expired == 'VALID')
                          {
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
                          else
                          {
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

              waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
              setTimeout(function () {
                waitingDialog.hide();
              }, 1000);
            }
            else
            {
              $("#id_details3_western").hide();
            }

});

  $("#newidnumber").change(function () {      

      var newidtype = $("#newidtype").val();
      var newidnumber = $("#newidnumber").val();

      new_id_rule.forEach( function (arrayItem)
      { 

          var id = arrayItem.id;
          var rule = arrayItem.rule;
          
          var rule = rule.replace("/g", "");
          var rule = rule.replace("/", "");
          // var rule = rule.replace("^", "");

          var rules = new RegExp(rule, "g");

          if(newidtype == id)
          {

                if(rules.test(newidnumber))
                {
                $("#updateexpired").hide();
                }
                else
                {
                $("#updateexpired").html("Please match the format of the ID type chosen.");
                $("#updateexpired").show();

                }

          }

          
      });
      


  });

   $("#newidtype").change(function () { 
    var newidtype = $("#newidtype").val();
        
        new_id_rule.forEach( function (arrayItem)
      { 
        var id = arrayItem.id;
        var expirable = arrayItem.expirable;

          if(newidtype == id)
          {
            if(expirable == 'YES')
            {
              $("#newexpirydate").prop("disabled", false); 
              document.getElementById("newexpirydate").value = '';
            }
            else
            {
              $("#newexpirydate").prop("disabled", true);
              document.getElementById("newexpirydate").value = 'NO EXPIRY';
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
$("form#dataWestern").submit(function(){

      waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});

      var newidtype = $("#newidtype").val();
      var newidnumber = $("#newidnumber").val();

      document.getElementById("newidtype2").value = newidtype;

      $("#updateexpired").hide();

      new_id_rule.forEach( function (arrayItem)
      { 

          var id = arrayItem.id;
          var rule = arrayItem.rule;
          
          var rule = rule.replace("/g", "");
          var rule = rule.replace("/", "");
          // var rule = rule.replace("^", "");

          var rules = new RegExp(rule, "g");

          if(newidtype == id)
          {

                if(rules.test(newidnumber))
                {
                  waitingDialog.hide();
                  $("#updateexpired").hide();

                  setTimeout(function(){
                    add_western_new_id();
                  }, 1000);
                  $("#newexpirydate").prop("disabled", false); 
                 //RefreshListWestern();

                }
                else
                {
                  waitingDialog.hide();
                $("#updateexpired").html("Please match the format of the ID type chosen.");

                setTimeout(function(){
                $("#updateexpired").show();
                }, 1000);

                }

          }

          
      }); 

    return false;

});

function add_western_new_id(){
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

    var newexpirydate = $("#newexpirydate").val();

    var newidtype2 = $("#newidtype2").val();
    var selvalidID1_western = $("#selvalidID1_western").val();
    var selvalidID2_western = $("#selvalidID2_western").val();
    var selvalidID3_western = $("#selvalidID3_western").val();
    var id_type_western = $("#westernidtype").val();

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


    $.ajax({
        url: "/Ecash_payout/add_newid_payout_moneygram",
        type: 'POST',
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        
        success: function (data) {

            var jsondata = JSON.parse(data);

            if(jsondata.S != 1){
                $("#updateexpired").html(jsondata.M);
                $("#updateexpired").show();
                $("#addnewsuccess").hide();
            }
            else
            {
                $("#addnewsuccess").html(jsondata.M);
                $("#addnewsuccess").show();
                $("#updateexpired").hide();

                var attachment = jsondata.T_DATA.attachment;
                var created = jsondata.T_DATA.created;
                var description = jsondata.T_DATA.description;
                var expiry = jsondata.T_DATA.expiry;
                var is_expired = jsondata.T_DATA.is_expired;
                var number = jsondata.T_DATA.number;
                var id = jsondata.T_DATA.id;

                if(id_type_western == 'prime_id') {

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

                setTimeout(function(){
                  $('#myModalWestern').modal('hide');
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
     formatDate:  'Y-m-d',
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
