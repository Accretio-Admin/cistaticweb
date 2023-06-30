var getidcount = 0;
var new_id_rule = [];


$("#benefbdate").datetimepicker({

  onChangeDateTime:fetchpayoutIDs

});

function removeOptions(selectbox)
{
    var i;
    for(i = selectbox.options.length - 1 ; i >= 0 ; i--)
    {
        selectbox.remove(i);
    }
}

function fetchpayoutIDs(){

  getidcount = 0;

  var benefname = $("#benefname").val();
  var benemname = $("#benemname").val();
  var benelname = $("#benelname").val();
  var benebdate = $("#benefbdate").val();


  var principalamount = $("#principalamount").val();
  var inputAmount = $("#inputAmount").val();
  
  // console.log(principalamount);
  // console.log(inputAmount);

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
                 
                  // console.log(jsondata);
                  
                if(jsondata.S == 1){

                $("#selvalidID1").prop("disabled", false); 
                $("#selvalidID2").prop("disabled", false);  


                $("#id_details1").hide();
                $("#id_details2").hide();

                removeOptions(document.getElementById("selvalidID1"));
              
                var select1 = document.getElementById("selvalidID1");
               
                var el1 = document.createElement("option");
                el1.textContent = '--CHOOSE VALID ID--';
                el1.value = '';
                el1.disabled = true;
                el1.selected = true;
                select1.appendChild(el1);


                if(principalamount > 5000)
                {

                  removeOptions(document.getElementById("selvalidID2"));

                  var select2 = document.getElementById("selvalidID2");

                  var el2 = document.createElement("option");
                  el2.textContent = '--CHOOSE VALID ID--';
                  el2.value = '';
                  el2.disabled = true;
                  el2.selected = true;
                  select2.appendChild(el2);
                }

                
                if(inputAmount > 5000)
                {

                  removeOptions(document.getElementById("selvalidID2"));

                  var select2 = document.getElementById("selvalidID2");

                  var el2 = document.createElement("option");
                  el2.textContent = '--CHOOSE VALID ID--';
                  el2.value = '';
                  el2.disabled = true;
                  el2.selected = true;
                  select2.appendChild(el2);
                }


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

                          if(principalamount > 5000)
                          {
                            var el2 = document.createElement("option");
                            el2.textContent = description;
                            el2.value = id;
                            select2.appendChild(el2);
                          }

                          if(inputAmount > 5000)
                          {
                            var el2 = document.createElement("option");
                            el2.textContent = description;
                            el2.value = id;
                            select2.appendChild(el2);
                          }
                      }


                        var el1 = document.createElement("option");
                        el1.textContent = '--ADD NEW ID--';
                        el1.value = 'add_id';
                        select1.appendChild(el1);

                        if(principalamount > 5000)
                        {
                          var el2 = document.createElement("option");
                          el2.textContent = '--ADD NEW ID--';
                          el2.value = 'add_id';
                          select2.appendChild(el2);
                        }

                        if(inputAmount > 5000)
                        {
                          var el2 = document.createElement("option");
                          el2.textContent = '--ADD NEW ID--';
                          el2.value = 'add_id';
                          select2.appendChild(el2);
                        }

                  }
              }
      });
        getidcount++;
      }

  waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
  setTimeout(function () {
    waitingDialog.hide();
  }, 1500);
}
  var countnew = 0;
  function fetch_remitpayout_id_types(descselect){
  var benefname = $("#benefname").val();
  var benemname = $("#benemname").val();
  var benelname = $("#benelname").val();
  var benebdate = $("#benefbdate").val();

  var parameters = {benefname:benefname,benemname:benemname,benelname:benelname,benebdate:benebdate};

                      $.ajax({
              url: "/Ecash_payout/fetch_remitpayout_id_types",
              type: "POST",
              data: parameters,
              
              success: function(data)
              {
                  var jsondata = JSON.parse(data);
                 
                  // console.log(jsondata);
                  
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
 $("#selvalidID1").change(function () {
  // Get the selected value
  var selected = $("option:selected", $(this)).val();
  // Get the ID of this element
  var thisID = $(this).prop("id");
  // Reset so all values are showing:
  $(".preferenceSelect option").each(function() {
        if ($(this).prop("value") != '' || $(this).prop("value") != 'add_id') {
            $(this).prop("disabled", false);
          }
        });

        $(".preferenceSelect").each(function() {
            if ($(this).prop("id") != thisID) {

                $("option[value='" + selected + "']", $(this)).prop("disabled", true);
            }
        });


          $modal = $('#myModalpayout');
          
          var id1_val = $("#selvalidID1").val();
          if(id1_val == 'add_id' )
          {
            $("#id_details1").hide();
            document.getElementById("data").reset();

            fetch_remitpayout_id_types();

            $("#newheading").html("ADD NEW ID");
            $("#updateexpired").hide();
            $("#addnewsuccess").hide();
            document.getElementById('newidtype').selectedIndex = 0;
            create_new = 0;
            $("#newidtype").prop("disabled", false);  
            setTimeout(function () {
              $modal.modal('show');
            }, 500);
            
            RefreshList();

          }
          else if(id1_val != 'add_id' && id1_val != '')
          {

              var selvalidID1 = $("#selvalidID1").val();

              var benefname = $("#benefname").val();
              var benemname = $("#benemname").val();
              var benelname = $("#benelname").val();
              var benebdate = $("#benefbdate").val();

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

                      if(selvalidID1 == id)
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
                        $("#id_details1").show();
                        }
                        else
                        {
                        var expiry = jsondata.T_DATA[index].expiry;
                        var number = jsondata.T_DATA[index].number;
                        var description = jsondata.T_DATA[index].description;
                        $("#id_details1").hide();

                        document.getElementById("id_detailtype1").value = '';
                        document.getElementById("id_detailnumber1").value = '';
                        document.getElementById("id_detailexpiry1").value = '';
                        document.getElementById("id_detailcreated1").value = '';
                        document.getElementById("id_attachment1").href = '';

                        fetch_remitpayout_id_types(description);
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
            $("#id_details1").hide();
          }
          else
          {
            $("#id_details1").hide();
          }


});

  /* GET ID DETAILS ON CHANGE OF ID#2*/
  $("#selvalidID2").change(function () {
  // Get the selected value
  var selected = $("option:selected", $(this)).val();
  // Get the ID of this element
  var thisID = $(this).prop("id");
  // Reset so all values are showing:
  $(".preferenceSelect option").each(function() {
        if ($(this).prop("value") != '' || $(this).prop("value") != 'add_id') {
            $(this).prop("disabled", false);
          }
        });

        $(".preferenceSelect").each(function() {
            if ($(this).prop("id") != thisID) {

                $("option[value='" + selected + "']", $(this)).prop("disabled", true);
            }
        });

          $modal = $('#myModalpayout');
          var id2_val = $("#selvalidID2").val();
          if(id2_val == 'add_id')
          {
            $("#id_details2").hide();

            document.getElementById("data").reset();
          
            fetch_remitpayout_id_types();

           $("#newheading").html("ADD NEW ID");
           $("#updateexpired").hide();
           $("#addnewsuccess").hide();
           document.getElementById('newidtype').selectedIndex = 0;
           create_new = 0;
           
           $("#newidtype").prop("disabled", false);  
            setTimeout(function () {
              $modal.modal('show');
            }, 500);
            RefreshList();

          }
          else if(id2_val != 'add_id' && id2_val != '')
          {
             var selvalidID2 = $("#selvalidID2").val();

              var benefname = $("#benefname").val();
              var benemname = $("#benemname").val();
              var benelname = $("#benelname").val();
              var benebdate = $("#benefbdate").val();

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

                      if(selvalidID2 == id)
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
                        $("#id_details2").show();
                        }
                        else
                        {
                        var expiry = jsondata.T_DATA[index].expiry;
                        var number = jsondata.T_DATA[index].number;
                        var description = jsondata.T_DATA[index].description;
                        $("#id_details2").hide();

                        document.getElementById("id_detailtype2").value = '';
                        document.getElementById("id_detailnumber2").value = '';
                        document.getElementById("id_detailexpiry2").value = '';
                        document.getElementById("id_detailcreated2").value = '';
                        document.getElementById("id_attachment2").href = '';

                        fetch_remitpayout_id_types(description);
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
            $("#id_details2").hide();
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
function ValidateSingleInput(oInput) {
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

$('#myModalpayout').on('hidden.bs.modal', function () {
  RefreshList();
})

function RefreshList() {

    $("#id_details1").hide();
    $("#id_details2").hide();
    fetchpayoutIDs();

  }

/*INSERT NEW ID */
$("form#data").submit(function(){

      var newidtype = $("#newidtype").val();
      var newidnumber = $("#newidnumber").val();

     // document.getElementById("newidnumber").setCustomValidity("Please match the requested format of the ID type.");
      document.getElementById("newidtype2").value = newidtype;

      console.log(newidtype);
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
                  // console.log(id);

                  // document.getElementById("newidnumber").pattern = rule;
                  // var x = document.getElementById("newidnumber").pattern;
                  // console.log(x);

                if(rules.test(newidnumber))
                {
                // alert("match!");
                $("#updateexpired").hide();

                setTimeout(function(){
                  add_new_id();
                }, 1000);
                $("#newexpirydate").prop("disabled", false); 
                RefreshList();

                }
                else
                {

                $("#updateexpired").html("Please match the format of the ID type chosen.");

                setTimeout(function(){
                $("#updateexpired").show();
                }, 1000);

                }

          }

          
      }); 

    return false;

});

function add_new_id(){

    var benefname = $("#benefname").val();
    var benemname = $("#benemname").val();
    var benelname = $("#benelname").val();
    var benebdate = $("#benefbdate").val();

    var newexpirydate = $("#newexpirydate").val();
    // var newidtype = $("#newidtype").val();
    var newidtype2 = $("#newidtype2").val();

    var selvalidID1 = $("#selvalidID1").val();
    var selvalidID2 = $("#selvalidID2").val();

    var trackno = $("#trackno").val();
    var transtype = $("#transtype").val();

    var formData = new FormData($('#data')[0]);

    formData.append('benefname', benefname);
    formData.append('benemname', benemname);
    formData.append('benelname', benelname);
    formData.append('benebdate', benebdate);
    formData.append('selvalidID1', selvalidID1);
    formData.append('selvalidID2', selvalidID2);
    formData.append('newexpirydate', newexpirydate);

    formData.append('newidtype', newidtype2);


    formData.append('create_new', create_new);

    formData.append('trackno', trackno);
    formData.append('transtype', transtype);


    $.ajax({
        url: "/Ecash_payout/add_newid_payout",
        type: 'POST',
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        
        success: function (data) {

            var jsondata = JSON.parse(data);
            // console.log(jsondata);
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
                RefreshList();
                setTimeout(function(){
                  $('#myModalpayout').modal('hide');
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



 $("#btnCancel").click(function () {
      document.getElementById("benefbdate").value = '';
      RefreshList();

      var base_url = window.location.origin;
      var pathArray = window.location.pathname;

      window.location = base_url+pathArray;
 });

// ----- TERMS AND AGREEMENTS ----- //


 $(document).ready(function() {
    
    $modal2 = $('#modalTermsandConditions');
    $modal2.modal('show');
    $("#agreementfailed").hide();
    $("#agreementsuccess").hide();

    var principalamount = $("#principalamount").val();

    if(principalamount > 5000)
    {
      $("#selvalidID2DIV").show();
    }

});


  $("#frmAgreeTermsnCondition").on('submit',function(e){
    e.preventDefault();
    waitingDialog.show('Please wait..', {dialogSize: 'sm', progressType: 'primary'});
   

      $.ajax({
            url: "/Ecash_payout/agree_user_agreement_post",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
              var jsondata = JSON.parse(data);
              // console.log(data);
              // console.log(jsondata);
                if(jsondata.S == 1){
                  console.log('success');
            waitingDialog.hide();
            $modal2.modal('hide');

              $("#agreementsuccess").html(jsondata.M);
              $("#agreementsuccess").show();
          }else{
            waitingDialog.hide();
            $modal2.modal('hide');

              $("#agreementfailed").html(jsondata.M);
              $("#agreementfailed").show();
          }
        
            }

        });
  });