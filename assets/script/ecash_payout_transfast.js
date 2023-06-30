var trig = 0;
var id_rule = [];
$('#BackIdTf').hide();

$(".showModalTf").click(function () {
    fetchTfCountry();
    // fetchTfCities();
    $('#spinAnimationtf1_city').show();
    $('#selCities').css('display', 'none');
    // fetchTfStates();
    $('#spinAnimationtf1_province').show();
    $('#selStates').css('display', 'none');
    // fetchTfOccupation();
    $('#spinAnimationtf1_occup').show();
    $('#selOccup').css('display', 'none');
    // fetchTfRemitPurpose();
    $('#spinAnimationtf1_reason').show();
    $('#selRemitPurpose').css('display', 'none'); 
    waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'primary' });
    setTimeout(function () {
        waitingDialog.hide();
    }, 1500);

});

$('#BackIdTf').click(function(){
    $('.nav-tabs > .active').prev('li').find('a').trigger('click');
    $('#BackIdTf').hide();
});

$('#NextIdTf').click(() => {
    var tab = $('.transfast_tab li.active').text().trim();

    switch (tab) {
        case "New Beneficiary":
            if ($('#benefbdatedd').val() == "") {
                alert('Please Input Birthdate');
            }
            else if ($('#selCountryB').val() == 0) {
                alert('Please Select Country(Birth)');
            }
            else if ($('#selGender').val() == 0) {
                alert('Please Select Gender');
            }
            else if ($('#selCountry').val() == 0) {
                alert('Please Select Country');
            }
            else if ($('#selCities').val() == 0) {
                alert('Please Select City');
            }
            else if ($('#selStates').val() == 0) {
                alert('Please Select State');
            }
            else if ($('#selNational').val() == 0) {
                alert('Please Select Nationality');
            }
            else if ($('#inputRelSender').val() == "") {
                alert('Please Input Your Relationship With Sender');
            }
            else if ($('#selOccup').val() == 0) {
                alert('Please Select Occupation');
            }
            else if ($('#selRemitPurpose').val() == 0) {
                alert('Please Select Remittance Reason');
            }
            else {

                waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'primary' });
                setTimeout(function () {
                    var result = getValidIdApproved();
                    $('#BackIdTf').show();
                    // console.log(result);
                    if (result[0].S == 0) {
                        $("#updateexpiredtf").html(result[0].M);
                        $("#updateexpiredtf").show();
                        $("#addnewsuccesstf").hide();

                    }

                    else if (result[0].T_DATA) {
                        $('.nav-tabs a[href="#UploadBeneID"]').tab('show');
                        fetchTfValidId();
                        $('#NextIdTf').text("Confirm");
                        trig += 1;
                    }
                    else {
                        
                        $('.nav-tabs a[href="#UploadBeneID"]').tab('show');
                        var iddetails = result[0];
                        // console.log(iddetails);
                        var iddesc = iddetails.desc;
                        var idtype = iddetails.type;
                        var idfile = iddetails.attch;
                        var idexp = iddetails.exp;
                        var idno = iddetails.idnumber;

                        selOpt = "<option value='" + idtype + "' selected>" + iddesc + "</option>";
                        $('#spinAnimationtf1').hide();
                        $('#selvalidID1_tf').css('display', 'block');
                        $('#selvalidID1_tf').attr("readonly", true);
                        $('#selvalidID1_tf').attr("disabled", true);
                        $('#selvalidID1_tf').append(selOpt);

                        $('#newidnumbertf').attr("readonly", true);
                        $('#newidnumbertf').val(idno);

                        $('#newexpirydatetf').attr("readonly", true);
                        $('#newexpirydatetf').prop('disabled', true);
                        $('#newexpirydatetf').val(idexp);
                        
                        

                        $("#btnViewfile").css('display', 'block');
                        $("#filetf").css('display', 'none');
                        // $("#filetf").val("0");
                        $("#btnViewfile").attr("href", idfile);



                        $('#NextIdTf').text("Confirm");
                        trig += 2;

                    }
                    waitingDialog.hide();
                }, 1500);
                
                
               
            }
            break;
        
        case "ID Details":
            if ($('#selvalidID1').val() == "") {
                alert('Please Select Type');
            }
            else if ($('#newidnumbertf').val() == "") {
                alert('Please Input ID#1 Number');
            }
            else if ($('#newexpirydatetf').val() == "") {
                alert('Please Input ID#1 Expiry Date');
            }
            else if ($('#filetf').val() == "" && $("#filetf").css('display') == 'block') {
                 alert('Please upload the image of your ID.');
            }
            else { 
                
                waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'primary' });
                setTimeout(function () {
                    // console.log(trig);
                    if (trig === 2) {
                        var idtype = $('#selvalidID1_tf').val();
                        var idtypedesc = $('#selvalidID1_tf option:selected').text();
                        var newidnumbertf = $('#newidnumbertf').val();
                        var newexpirydatetf = $('#newexpirydatetf').val();
                        var selCountryB = $('#selCountryB').val();
                        var selCountry = $('#selCountry').val();
                        var selCities = $('#selCities').val();
                        var selStates = $('#selStates').val();
                        var selGender = $('#selGender').val();
                        var selNational = $('#selNational').val();
                        var mobileno = $('#inputMobno').val();
                        var dob = $('#benefbdatedd').val();
                        var relSender = $('#inputRelSender').val();
                        var selOccup = $('#selOccup').val();
                        var selRemitPur = $('#selRemitPurpose').val();
                         
                        

                         setTimeout(function () {
                                $('#myModaltf').modal('hide');
                                $('.modal-backdrop').remove();

                            }, 2000);
                            
                            $("#titletf").text("TRANSFAST - TRANSACTION SUMMARY");
                            $('#titletfID').css("display", "block");
                            
                            $('#tsId').css("display", "block");
                            $('#tsIdno').css("display", "block");
                            $('#tsIdExp').css("display", "block");
                            $('#refreshtfspan').css("display", "none");
                            $('#refreshTf').css("display", "none");
                        
                            $('#inputIdTypeDesc').val(idtypedesc);
                            $('#inputIdType').val(idtype);
                            $('#inputIdno').val(newidnumbertf);
                            $('#inputExpDate').val(newexpirydatetf);
                        
                            // $("#tf_data").append('<input type="hidden" class="form-control" name="inputIdType" value="'+idtype+'"  readonly="">');
                            // $("#tf_data").append('<input type="hidden" class="form-control" name="inputIdno" value="'+newidnumbertf+'"  readonly="">');
                            // $("#tf_data").append('<input type="hidden" class="form-control" name="inputExpDate" value="'+newexpirydatetf+'"  readonly="">');
                            $("#tf_data").append('<input type="hidden" class="form-control" name="inputCountryB" value="' + selCountryB + '"  readonly="">');
                            $("#tf_data").append('<input type="hidden" class="form-control" name="inputCountry" value="'+selCountry+'"  readonly="">');
                            $("#tf_data").append('<input type="hidden" class="form-control" name="inputCities" value="'+selCities+'"  readonly="">');
                            $("#tf_data").append('<input type="hidden" class="form-control" name="inputStates" value="'+selStates+'"  readonly="">');
                            $("#tf_data").append('<input type="hidden" class="form-control" name="inputMobileNo" value="'+mobileno+'"  readonly="">');
                            $("#tf_data").append('<input type="hidden" class="form-control" name="inputDob" value="'+dob+'"  readonly="">');
                            $("#tf_data").append('<input type="hidden" class="form-control" name="inputGender" value="' + selGender + '"  readonly="">');
                            $("#tf_data").append('<input type="hidden" class="form-control" name="inputNational" value="' + selNational + '"  readonly="">');
                            $("#tf_data").append('<input type="hidden" class="form-control" name="inputRel2Sender" value="' + relSender + '"  readonly="">');
                            $("#tf_data").append('<input type="hidden" class="form-control" name="inputOccup" value="' + selOccup + '"  readonly="">');
                            $("#tf_data").append('<input type="hidden" class="form-control" name="inputRemitPur" value="' + selRemitPur + '"  readonly="">');
                            
                            $("#transpassid").append('<div class="input-group"><span class="input-group-addon" id="basic-addon1" style="padding-right: 5px;">TRANSACTION PASSWORD:</span><input type="password" class="form-control" name="inputTpassTf" required/></div>');
                        

                            $("#btnProceedtf").css("display", "none");
                            $("#buttonConfirmTf").append('<button type="submit" class="btn btn-primary"  name="btnConfirmTf">Submit</button>');
                        

                      
                    }
                    
                    else if (trig === 1) {
                        result = add_new_id_tf();
                        // console.log(result);
                        if (result[0].S != 1) {
                    
                            $("#updateexpiredtf").html(result[0].M);
                            $("#updateexpiredtf").show();
                            $("#addnewsuccesstf").hide();
                
                        }
                        else {
                            // var idtype = $('#selvalidID1_tf').val();
                            // var idtypedesc = $('#selvalidID1_tf option:selected').text();
                            // var newidnumbertf = $('#newidnumbertf').val();
                            // var newexpirydatetf = $('#newexpirydatetf').val();
                            var selCountryB = $('#selCountryB').val();
                            var selCountry = $('#selCountry').val();
                            var selCities = $('#selCities').val();
                            var selStates = $('#selStates').val();
                            var selGender = $('#selGender').val();
                            var selNational = $('#selNational').val();
                            var mobileno = $('#inputMobno').val();
                            var relSender = $('#inputRelSender').val();
                            var selOccup = $('#selOccup').val();
                            var selRemitPur = $('#selRemitPurpose').val();

                            $("#addnewsuccesstf").html(result[0].M);
                            $("#addnewsuccesstf").show();
                            $("#updateexpiredtf").hide();
                            setTimeout(function () {
                                $('#myModaltf').modal('hide');
                                $('.modal-backdrop').remove();

                            }, 2000);

                       
                            $('#titletfID').css("display", "block");
                            $("#titletf").text("TRANSFAST - TRANSACTION SUMMARY");
                            $('#tsId').css("display", "block");
                            $('#tsIdno').css("display", "block");
                            $('#tsIdExp').css("display", "block");
                            // $('#inputIdTypeDesc').val(idtypedesc);
                            // $('#inputIdType').val(idtype);
                            // $('#inputIdno').val(newidnumbertf);
                            // $('#inputExpDate').val(newexpirydatetf);
                            
                            $("#tf_data").append('<input type="hidden" class="form-control" name="inputCountryB" value="' + selCountryB + '"  readonly="">');
                            $("#tf_data").append('<input type="hidden" class="form-control" name="inputCountry" value="'+selCountry+'"  readonly="">');
                            $("#tf_data").append('<input type="hidden" class="form-control" name="inputCities" value="'+selCities+'"  readonly="">');
                            $("#tf_data").append('<input type="hidden" class="form-control" name="inputStates" value="'+selStates+'"  readonly="">');
                            $("#tf_data").append('<input type="hidden" class="form-control" name="inputMobileNo" value="'+mobileno+'"  readonly="">');
                            $("#tf_data").append('<input type="hidden" class="form-control" name="inputGender" value="' + selGender + '"  readonly="">');
                            $("#tf_data").append('<input type="hidden" class="form-control" name="inputNational" value="' + selNational + '"  readonly="">');
                            $("#tf_data").append('<input type="hidden" class="form-control" name="inputRel2Sender" value="' + relSender + '"  readonly="">');
                            $("#tf_data").append('<input type="hidden" class="form-control" name="inputOccup" value="' + selOccup + '"  readonly="">');
                            $("#tf_data").append('<input type="hidden" class="form-control" name="inputRemitPur" value="' + selRemitPur + '"  readonly="">');
                            
                            $("#transpassid").append('<div class="input-group"><span class="input-group-addon" id="basic-addon1" style="padding-right: 5px;">TRANSACTION PASSWORD:</span><input type="password" class="form-control" name="inputTpassTf" required/></div>');
                        

                            $("#btnProceedtf").css("display", "none");
                            $("#buttonConfirmTf").append('<button type="submit" class="btn btn-primary"  name="btnConfirmTf">Submit</button>');
                        

                        }
                    }
                   
                        waitingDialog.hide();
                        }, 1500);

                
                 
                            
            }
            
        break;
        default:

        break;
    }
});

 $("#newidnumbertf").change(function () {      

     var newidtype = $("#selvalidID1_tf").val();
     var newidnumber = $("#newidnumbertf").val();
    //  console.log(id_rule);

      id_rule.forEach( function (arrayItem)
      { 

          var id = arrayItem.id;
        //   console.log(id);
          var rule = arrayItem.rule;
        //   console.log(rule);

          var rule = rule.replace("/g", "");
          var rule = rule.replace("/", "");
          // var rule = rule.replace("^", "");

          var rules = new RegExp(rule, "g");

          if(newidtype == id)
          {

                if(rules.test(newidnumber))
                {
                $("#updateexpiredtf").hide();
                }
                else
                {
                $("#updateexpiredtf").html("Please match the format of the ID type chosen.");
                $("#updateexpiredtf").show();
                $("#newidnumbertf").val("");
                }

          }

          
      });
      


  });

$("#selvalidID1_tf").change(function () { 
    var newidtype = $("#selvalidID1_tf").val();
        
        id_rule.forEach( function (arrayItem)
      { 
        var id = arrayItem.id;
        var expirable = arrayItem.expirable;

          if(newidtype == id)
          {
            if(expirable == 'YES')
            {
              $("#newexpirydatetf").prop("disabled", false); 
              document.getElementById("newexpirydatetf").value = '';
            }
            else
            {
              $("#newexpirydatetf").prop("disabled", true);
              document.getElementById("newexpirydatetf").value = 'NO EXPIRY';
            }
          }
          


      });
   });

$("#refreshTf").click(function () { 
       waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'primary' });
    setTimeout(function () {
        var res = getValidIdApproved();
        if (res[0] == 0) {
            $("#updateexpiredtfId").html(result[0].M);
            $("#updateexpiredtfId").show();
            $("#addnewsuccesstfId").hide();
            
        }

        else if (res[0].T_DATA) {
            $("#updateexpiredtfId").html("Waiting for Approval.");
            $("#updateexpiredtfId").show();
            $("#addnewsuccesstfId").hide();
        }

        else {
            $("#updateexpiredtfId").hide();
            $("#addnewsuccesstfId").show();
            $("#addnewsuccesstfId").html("Your ID has been Approved!");
            var iddetails = res[0];
             // console.log(iddetails);
            var iddesc = iddetails.desc;
            var idtype = iddetails.type;
            var idexp = iddetails.exp;
            var idno = iddetails.idnumber;

            $('#inputIdTypeDesc').val(iddesc);
            $('#inputIdType').val(idtype);
            $('#inputIdno').val(idno);
            $('#inputExpDate').val(idexp);



    }

        waitingDialog.hide();
    }, 1500);
    
    
});

function fetchTfValidId() {
    $('#spinAnimationtf1').show();
    $('#selvalidID1_tf').css('display','none');
    
                $.ajax({
                url: "/Ecash_payout/fetch_transfast_valid_id",
                type: "POST",
                data: { },
                success: function (data) {
                    
                    var jsondata = JSON.parse(data);

                    // console.log(jsondata.T_DATA);
                    var tdata = jsondata.T_DATA;
                    // console.log(tdata);
                    var selOpts = "";
                    
                    for (i = 0; i < tdata.length; i++) {

                        var primary = tdata[i];
                        var primary_desc = primary.description;
                        var primary_id = primary.id;
                        var primary_rule = primary.rule;
                        var primary_expirable = primary.expirable
                        id_rule.push({"id":primary_id, "rule": primary_rule, "expirable":primary_expirable });
                        selOpts += "<option value='" + primary_id + "'>" + primary_desc + "</option>";
                    }
                    $('#spinAnimationtf1').hide();
                    $('#selvalidID1_tf').css('display','block');
                    $('#selvalidID1_tf').append(selOpts);
                    
            }
        });
}

function fetchTfCountry() {
    $('#spinAnimationtf1_countryB').show();
    $('#spinAnimationtf1_country').show();
    $('#spinAnimationtf1_national').show();
    $('#selCountryB').css('display', 'none');
    $('#selCountry').css('display', 'none');
    $('#selNational').css('display', 'none');
    
    var countrycode = $("#CountryIsoCode").val();

        $.ajax({
            url: "/Ecash_payout/fetch_transfast_countries",
            type: "POST",
            data: { countrycode },
            success: function (data) {

                var jsondata = JSON.parse(data);

                // console.log(jsondata.T_DATA);
                var tdata = jsondata.T_DATA;
                // console.log(tdata);
                var selOpts = "";
                
                for (i = 0; i < tdata.length; i++) {

                    var countries = tdata[i];
                    var countryname = countries.Name;
                    var ccode = countries.IsoCode;
                    selOpts += "<option value='" + ccode + "'>" + countryname + "</option>";
                }

                $('#spinAnimationtf1_countryB').hide();
                $('#spinAnimationtf1_country').hide();
                $('#spinAnimationtf1_national').hide();
                $('#selCountryB').css('display', 'block');
                $('#selCountry').css('display', 'block');
                $('#selNational').css('display', 'block');
                

                $('#selCountryB').append(selOpts);
                $('#selCountry').append(selOpts);
                $('#selNational').append(selOpts);
                fetchTfCities();
            }
        });
    
}

function fetchTfCities() {

    
    var countrycode = $("#CountryIsoCode").val();

        $.ajax({
            url: "/Ecash_payout/fetch_transfast_cities",
            type: "POST",
            data: { countrycode },
            success: function (data) {

                var jsondata = JSON.parse(data);

                // console.log(jsondata.T_DATA);
                var tdata = jsondata.T_DATA;
                // console.log(tdata);
                var selOpts = "";
                
                for (i = 0; i < tdata.length; i++) {

                    var city = tdata[i];
                    var cityname = city.Name;
                    var cityid = city.Id;
                    selOpts += "<option value='" + cityid + "'>" + cityname + "</option>";
                }

                $('#spinAnimationtf1_city').hide();
                $('#selCities').css('display', 'block');
                

                $('#selCities').append(selOpts);
                fetchTfStates();
            }
        });
    
}

function fetchTfStates() {
    
    var countrycode = $("#CountryIsoCode").val();

        $.ajax({
            url: "/Ecash_payout/fetch_transfast_states",
            type: "POST",
            data: { countrycode },
            success: function (data) {

                var jsondata = JSON.parse(data);

                // console.log(jsondata.T_DATA);
                var tdata = jsondata.T_DATA;
                // console.log(tdata);
                var selOpts = "";
                
                for (i = 0; i < tdata.length; i++) {

                    var states = tdata[i];
                    var statedesc = states.Name;
                    var stateid = states.Id;
                    selOpts += "<option value='" + stateid + "'>" + statedesc + "</option>";
                }

                $('#spinAnimationtf1_province').hide();
                $('#selStates').css('display', 'block');
                

                $('#selStates').append(selOpts);
                fetchTfOccupation();
                
            }
        });
    
}


function fetchTfOccupation() {
   
        
    var benename = $("#beneFullName").val();
        
        $.ajax({
            url: "/Ecash_payout/fetch_transfast_occupation",
            type: "POST",
            data: { benename },
            success: function (data) {

                var jsondata = JSON.parse(data);

                // console.log(jsondata.T_DATA);
                var tdata = jsondata.T_DATA;
                // console.log(tdata);
                var selOpts = "";
                
                for (i = 0; i < tdata.length; i++){

                var occupations = tdata[i];
                var occudesc = occupations.Name;
                var occuid = occupations.Id;
                selOpts += "<option value='"+occuid+"'>"+occudesc+"</option>";
                }

                $('#spinAnimationtf1_occup').hide();
                $('#selOccup').css('display', 'block');
                $('#selOccup').append(selOpts);
                // $('#selCountry').append(selOpts);
                fetchTfRemitPurpose();
                
            }
        });
}
    
function fetchTfRemitPurpose() {
 
    var countrycode = $("#CountryIsoCode").val();
        
        $.ajax({
            url: "/Ecash_payout/fetch_transfast_remitPurpose",
            type: "POST",
            data: { countrycode },
            success: function (data) {

                var jsondata = JSON.parse(data);

                // console.log(jsondata.T_DATA);
                var tdata = jsondata.T_DATA;
                // console.log(tdata);
                var selOpts = "";
                
                for (i = 0; i < tdata.length; i++){

                var purpose = tdata[i];
                var purposedesc = purpose.Name;
                var purposeid = purpose.Id;
                selOpts += "<option value='"+purposeid+"'>"+purposedesc+"</option>";
                }

                 $('#spinAnimationtf1_reason').hide();
                 $('#selRemitPurpose').css('display', 'block');  

                $('#selRemitPurpose').append(selOpts);
                // $('#selCountry').append(selOpts);
                
            }
        });
    
}

function add_new_id_tf(){

    var res = [];
    var benefname = $("#newBeneFName").val();
    var benemname = $("#newBeneMName").val();
    var benelname = $("#newBeneLName").val();
    var benebdate = $("#benefbdatedd").val();
    var create_new = 0;

    var newexpirydate = $("#newexpirydatetf").val();
    // var newexpirydate2 = $("#newexpirydatetf2").val();
    var newidtype = $("#selvalidID1_tf").val();
    var newidnumber = $("#newidnumbertf").val();

    var selvalidID1 = $("#selvalidID1_tf").val();
    var selvalidID2 = $("#selvalidID2");

    var trackno = $("#refnotf").val();
    var transtype = $("#transtypetf").val();

    var formData = new FormData($('#datatf')[0]);

    formData.append('benefname', benefname);
    formData.append('benemname', benemname);
    formData.append('benelname', benelname);
    formData.append('benebdate', benebdate);
    formData.append('selvalidID1', selvalidID1);
    formData.append('selvalidID2', selvalidID2);
    formData.append('newidnumber', newidnumber);
    formData.append('newexpirydate', newexpirydate);

    formData.append('newidtype', newidtype);


    formData.append('create_new', create_new);

    formData.append('trackno', trackno);
    formData.append('transtype', transtype);
    // console.log(formData);
     
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
            res.push(jsondata);
        }

    });
    return res;
    
}

function getValidIdApproved() {
    var respond = []
    var benefname = $("#newBeneFName").val();
    var benemname = $("#newBeneMName").val();
    var benelname = $("#newBeneLName").val();
    var benebdate = $("#benefbdatedd").val();

    var formData = new FormData($('#datatf')[0]);

    formData.append('benefname', benefname);
    formData.append('benemname', benemname);
    formData.append('benelname', benelname);
    formData.append('benebdate', benebdate);

    $.ajax({
        url: "/Ecash_payout/fetch_payout_id",
        type: 'POST',
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,

        success: function (data) {
            var jsondata = JSON.parse(data);
            // console.log(jsondata);
            
            
            if (jsondata.S == 1) {
                var tdata = jsondata.T_DATA;
                if (tdata.length != 0) {

                    // console.log(tdata);
                    var  idDetails = tdata[0];
                    // console.log(idDetails);
                    var iddesc = idDetails.description;
                    var idattach = idDetails.attachment;
                    var idexpiry = idDetails.expiry;
                    var idnumber = idDetails.number;
                    var  idTypeNumber = idDetails.id_type_number;

                    var iddetails = {};
                    iddetails.desc = iddesc;
                    iddetails.attch = idattach;
                    iddetails.exp = idexpiry;
                    iddetails.type = idTypeNumber;
                    iddetails.idnumber = idnumber;
                    
                    respond.push(iddetails);


                
                }
                else {
                    respond.push(jsondata);
                }
               
                
            }
            else {
                respond.push(jsondata);
            }
            
            
            }

    });

    return respond;

}


 $("#btnCanceltf").click(function () {

      var base_url = window.location.origin;
      var pathArray = window.location.pathname;

      window.location = base_url+pathArray;
 });








var _validFileExtensions = [".jpg", ".jpeg", ".png"];
function ValidateSingleInputtf(oInput) {
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


