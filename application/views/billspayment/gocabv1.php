<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">

<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>

<style>
#loadercheckrefNo {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 5px solid blue;
  border-right: 5px solid green;
  border-bottom: 5px solid red;
  border-left: 5px solid pink;
  width: 30px;
  height: 30px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
  display: inline-block;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.table-striped{
  width: 100%;
  background-color: #f3f3f3;
  tbody{
    height:10px;
    overflow-y:auto;
    width: 100%;
    }
  thead,tbody,tr,td,th{
    display:block;
  }
  tbody{
    td{
      float:left;
    }
  }
  thead {
    tr{
      th{
        float:left;
       background-color: #f39c12;
       border-color:#e67e22;
      }
    }
  }
}
</style>

<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-credit-card"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                   <li>BILLS PAYMENT 


                   </li>
                </ul>
                <h4>GOCAB DRIVER CASH-IN</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
      <div class="contentpanel">
        <div class="row">
          <div class="col-xs-12">
          <span class="errorMessage" id="transpassError"></span>
          <!-- <td><a href="http://10.10.1.222:8095/portal/gocab_receipt/<?php echo $API['R'][$x]['trackno'] ?>" target="_blank" class="btn btn-info" role="button">Print Receipt</a></td> -->
            <div class="panel panel-primary">
           
            <div class="panel-heading">GoCab API</div>
            <div style="padding: 5px;padding-left: 10px">
              <div class="form-group">
                  <label for="checkrefno">Check Reference Number:</label>
                  <input type="checkrefno" style="width: 210px" class="form-control" id="checkrefno" placeholder="Enter Reference Number" name="checkrefno">
                  <input type="hidden" class="form-control" id="saverefno" name="saverefno">
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-7">
                    <button type="button" style="padding: 12px 24px;" id="btnCheckRefno" class="btn btn-success">Check Reference Number</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="panel-body" style="height: 600px;overflow-y: scroll;"> 
              <div id="showResponseForCheckRef">

              </div>

              <div id="showForm">

              <div class="form-group">
                <div class="row">
                  <div class="col-md-7">
                    <hr>
                  </div>
                </div>
              </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="fname">First Name:</label>
                        <input type="fname" class="form-control alphaonly" id="fname" placeholder="Enter First Name" name="fname">
                        <span class="errorMessage" id="fnameError"></span>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="lname">Last Name:</label>
                        <input type="lname" class="form-control alphaonly" id="lname" placeholder="Enter Last Name" name="lname">
                        <span class="errorMessage" id="lnameError"></span>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="address" class="form-control " id="address" placeholder="Enter Address" name="address">
                        <span class="errorMessage" id="addressError"></span>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="email">Email Address:</label>
                        <input type="email" class="form-control " id="email" placeholder="Enter Email Address" name="email">
                        <span class="errorMessage" id="emailError"></span>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="mobile">Mobile Number:</label>
                        <input type="text" class="form-control" minlength="11" maxlength ="11" id="mobile" onkeypress="return isNumberKeyMob(event)" placeholder="Enter Mobile Number" name="mobile">
                        
                        <span class="errorMessage" id="mobileError"></span>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="refno">Reference Number:</label>
                        <input readonly type="text" class="form-control " id="refno" placeholder="Enter Reference Number" name="refno">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="amount">Amount:</label>
                        <input readonly="" type="text" class="form-control " oninput="validate(this)" onkeypress="return isNumberKey(event,this.id)" id="amount" placeholder="Enter Amount" name="amount">
                        <input readonly="" type="hidden" class="form-control " oninput="validate(this)" onkeypress="return isNumberKey(event,this.id)" id="originalamount" name="originalamount">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <button id="btnFirstSubmit" class="btn btn-info">Submit</button>
                        <span class="errorMessage" id="btnFirstSubmitError"></span>
                      </div>
                    </div>
                  </div>

              </div>
          </div>
       
        </div>
      </div><!-- row --> 
    </div><!-- contentpanel -->       


      <div class="modal fade" id="newModal" role="dialog">
       <div class="modal-dialog modal-lg">
           <div class="modal-content">
             <div class="modal-header">
               <button type="button" class="close" id="closemodal" data-dismiss="modal">×</button>
               <h4 class="modal-title">Transaction Summary</h4>
             </div>
             <div class="modal-body">

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="firstname">First Name:</label>
                      <input type="text" class="form-control" id="fnameDetails" name="firstname" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="lastname">Last Name:</label>
                      <input type="text" class="form-control" id="lnameDetails" name="lastname" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="address">Address:</label>
                      <input type="text" class="form-control" id="addressDetails" name="address" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="emailaddress">Email Address:</label>
                      <input type="text" class="form-control" id="emailDetails" name="emailaddress" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="mobilenumber">Mobile Number:</label>
                      <input type="text" class="form-control" id="mobileDetails" name="mobilenumber" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="referencenumber">Reference Number:</label>
                      <input type="text" class="form-control" id="refnoDetails" name="referencenumber" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="textamount">Amount:</label>
                      <input type="text" class="form-control" id="amountDetails" name="textamount" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="TransPass">Transaction Password:</label>
                      <input type="password" class="form-control" id="TransPass" name="TransPass">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <button id="btnSecondSubmit" class="btn btn-info">Submit</button>
                       <span class="errorMessage transpassError"  ></span>
                    </div>
                  </div>
                </div>

             </div>
           </div>
        </div>
      </div>


</div><!-- mainpanel -->            



<script src="<?php echo BASE_URL()?>assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo BASE_URL()?>assets/js/billspayment.js"></script>
<script type="text/javascript">

$("#showForm").hide();
$("#showResponseForCheckRef").hide();
$("#btnCheckRefno").prop('disabled', true);


  $('#checkrefno').on('input', function() {
    if($('#checkrefno').val() == ""){
      $("#btnCheckRefno").prop('disabled', true);
      return;
    }
    $("#btnCheckRefno").prop('disabled', false);
  });

  $("#btnCheckRefno").click(function(){
    $("#transpassError").hide();
    $("#TransPass").val("");

    $("#btnCheckRefno").html('Searching..');
    $("#btnCheckRefno").append('<i id="loadingcheckRef" style="color: yellow" class="fa fa-circle-o-notch fa-spin"></i>');

    let refno = $("#checkrefno").val();

    $.ajax({
      type: 'POST',
      url: '/Bills_payment/CheckRef',
      // url: '/Bills_payment/CheckRefTest', // FOR TESTING
      data: {refno: refno},

      success: function(data){
        let datum = JSON.parse(data);
        console.log(datum);

        let message = ``;
        let td = ``;

        if(datum.results.length == 0){
          message = `Invalid Reference Number`;

          $("#loadingcheckRef").hide();
          $("#btnCheckRefno").html('Check Reference Number');

          $("#showResponseForCheckRef").html("<span style='color: red;'>* <b>"+message+"</b></span>");
          $("#showResponseForCheckRef").show();
          $("#showForm").hide();
          return;
        }



        if(datum.results[0].status == "COMPLETED" || datum.results[0].status == "FAILED" || datum.results[0].status == "CANCELLED"){
          message = `
          <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>AMOUNT</th>
              <th>TO BE PAID</th>
              <th>STATUS</th>
              <th>REF NO.</th>
            </tr>
          </thead>
          <tbody>`;
          
        for(let x = 0; x < datum.results.length; x++){
        message += `  
            <tr class="info">
              <td>${datum.results[x].objectId}</td>
              <td>P ${datum.results[x].amount}</td>
              <td>P ${datum.results[x].amountToBePaid}</td>
              <td>${datum.results[x].status}</td>
              <td>${datum.results[x].user.objectId}</td>
            </tr>`;
        }
          
        message += `  
          </tbody>
        </table>
        `;

        

        $("#showResponseForCheckRef").html(message);
        $("#showResponseForCheckRef").show();
        $("#showForm").hide();

        }else{

        $("#fname").val("");
        $("#lname").val("");
        $("#address").val("");
        $("#email").val("");
        $("#mobile").val("");
        $("#refno").val("");
        $("#amount").val("");

        $("#saverefno").val($("#checkrefno").val());
        $("#originalamount").val(datum.results[0].amount.toFixed(2));
        $("#amount").val(datum.results[0].amountToBePaid.toFixed(2));
        $("#refno").val(datum.results[0].objectId);


        message = `
          <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>AMOUNT</th>
              <th>TO BE PAID</th>
              <th>STATUS</th>
              <th>REF NO.</th>
            </tr>
          </thead>
          <tbody>`;
          
        for(let x = 0; x < datum.results.length; x++){
        message += `  
            <tr class="info">
              <td>${datum.results[x].objectId}</td>
              <td>P ${datum.results[x].amount}</td>
              <td>P ${datum.results[x].amountToBePaid}</td>
              <td>${datum.results[x].status}</td>
              <td>${datum.results[x].user.objectId}</td>
            </tr>`;
        }
          
        message += `  
          </tbody>
        </table>
        `;

        

        $("#showResponseForCheckRef").html(message);
        $("#showResponseForCheckRef").show();
        $("#showForm").show();

        }

        $("#loadingcheckRef").hide();
        $("#btnCheckRefno").html('Check Reference Number');


      },
      error: function(data){
        console.log(data);
      }

    });
  });
</script>

<script>
$('.alphaonly').bind('keyup blur',function(){ 
    var node = $(this);
    node.val(node.val().replace(/[^a-zA-Z\s]/g,'') ); 
});

// $('#email').focusout(function(){
//     var sEmail = $('#email').val();

//     // let test = validateEmail(sEmail);
//     // alert(sEmail);

//     // alert($.trim(sEmail));
//     var valEm = function(sEmail){
//       var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
//       if(!regex.test(sEmail)) {
//         return false;
//       }else{
//         return true;
//       }
//     }

//         if ($.trim(sEmail).length == "") {
//           $("#emailError").css("color", "red");
//           $("#emailError").html("* Email Address is empty.");
//           $('#email').val("");
//           return;
//         }
//         if(valEm(sEmail)) {
//           $("#emailError").css("color", "green");
//           $("#emailError").html("Email Address is valid.");
//         }
//         else {
//           $("#emailError").css("color", "red");
//           $("#emailError").html("* Invalid Email Address");
//           $('#email').val("");
//         }

// });


function isNumberKey(evt,id)
{
  try{
        var charCode = (evt.which) ? evt.which : event.keyCode;
  
        if(charCode==46){
            var txt=document.getElementById(id).value;
            if(!(txt.indexOf(".") > -1)){
  
                return true;
            }
        }
        if (charCode > 31 && (charCode < 48 || charCode > 57) )
            return false;

        return true;
  }catch(w){
    alert(w);
  }
}

function isNumberKeyMob(evt)
{
  var charCode = (evt.which) ? evt.which : evt.keyCode;

  
  if ((charCode >= 48 && charCode <= 57)) { 
       return true;
  }
  return false;
}
       
// $('#mobile').focusout(function(){
//   // alert(this.value.length);
//   if(this.value.length != 11){
//     $('#mobileError').show();
//     $('#mobileError').css("color","red");
//     $('#mobileError').html("* Mobile Number should have 11 digits");
//     $('#mobile').val("");
//     return;
//   }
//   $('#mobileError').hide();

  
// });

var validate = function(e) {
  var t = e.value;
  e.value = (t.indexOf(".") >= 0) ? (t.substr(0, t.indexOf(".")) + t.substr(t.indexOf("."), 3)) : t;
}


$('#mobile').on('paste', function (event) {
  if (event.originalEvent.clipboardData.getData('Text').match(/[^\d]/)) {
    event.preventDefault();
  }
});

$('input').on('paste', function (event) {
  // e.preventDefault();
  // // prevent copying action
  // alert(e.originalEvent.clipboardData.getData('Text'));
  // var withoutSpaces = e.originalEvent.clipboardData.getData('Text');
  // withoutSpaces = withoutSpaces.replace(/\s+/g, '');
  // $(this).val(withoutSpaces);

  if (event.originalEvent.clipboardData.getData('Text').match(/\s+/g)) {
    event.preventDefault();
  }
});
</script>



<script>
$("#btnFirstSubmit").click(function(){

  $("#transpassError").html("");
  $("#btnSecondSubmit").attr("disabled",false);

  let fname = $("#fname").val().trim();
  let lname = $("#lname").val().trim();
  let address = $("#address").val().trim();
  let email = $("#email").val().trim();
  let mobile = $("#mobile").val().trim();
  let refno = $("#refno").val().trim();
  let amount = $("#amount").val().trim();

  if(fname == ""){

    $("#fnameError").show();
    $("#fnameError").css("color","red");
    $("#fnameError").html("* This field is required to filled in");
  }else{
    $("#fnameError").hide();
  }

  if(lname == ""){
    $("#lnameError").show();
    $("#lnameError").css("color","red");
    $("#lnameError").html("* This field is required to filled in");
  }else{
    $("#lnameError").hide();
  }

  if(address == ""){
    $("#addressError").show();
    $("#addressError").css("color","red");
    $("#addressError").html("* This field is required to filled in");
  }else{
    $("#addressError").hide();
  }

  var valEm = function(email){
      var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      if(!regex.test(email)) {
        return false;
      }else{
        return true;
      }
    }

  if(email == ""){
    $("#emailError").show();
    $("#emailError").css("color","red");
    $("#emailError").html("* This field is required to filled in");
  }
  else if(!valEm(email)){
    $("#emailError").show();
    $("#emailError").css("color", "red");
    $("#emailError").html("Email Address is invalid.");
  }
  else{
    $("#emailError").hide();
  }



        

  if(mobile == ""){
    $("#mobileError").show();
    $("#mobileError").css("color","red");
    $("#mobileError").html("* This field is required to filled in");
  }else if(mobile.length != 11){
    $("#mobileError").show();
    $("#mobileError").css("color","red");
    $("#mobileError").html("* Mobile Number should have 11 digits");
  }else{
    $("#mobileError").hide();
  }



  

  if(fname != "" && lname != "" && address != "" && email != "" && mobile != "" && mobile.length == 11 && valEm(email)){
  $("#btnFirstSubmitError").hide();
  $('#newModal').modal({backdrop: 'static', keyboard: false});

  $("#fnameDetails").val(fname.trim());
  $("#lnameDetails").val(lname.trim());
  $("#addressDetails").val(address.trim());
  $("#emailDetails").val(email.trim());
  $("#mobileDetails").val(mobile.trim());
  $("#refnoDetails").val(refno.trim());
  $("#amountDetails").val(amount.trim());
  }
  
});

$("#btnSecondSubmit").click(function(){
  waitingDialog.show();
  $.ajax({ //FOR CHECKING OF TRANSACTION PASSWORD ONLY
      type: 'POST',
      url: '/Bills_payment/transactionpasswordforGoCab',
      data: {transpassword: $("#TransPass").val()},

      success: function(data){
        let datum = JSON.parse(data);
        console.log(datum);

        if($("#TransPass").val() == ""){
           
          $(".transpassError").show();
          $(".transpassError").css("color","red");
          $(".transpassError").html("Password is empty.");
          waitingDialog.hide();
          return;
        }

        if(datum.S == 0){ 
          $(".transpassError").show();
          $(".transpassError").css("color","red");
          $(".transpassError").html("Incorrect transaction password.");
          waitingDialog.hide();
          return;
        }

        if(Number($("#amount").val()) > Number(datum.EC[0].fund)){
          $("#btnCheckRefno").html('Check Reference Number');
          $('#newModal').modal('hide');
          $("#transpassError").show();
          $("#transpassError").css("color","red");
          $("#transpassError").html("Insufficient balance.");
          waitingDialog.hide();
        }else{
          waitingDialog.hide();
          $.ajax({ // CALL GOCAB FUND REQUEST API
            type: 'POST',
            url: '/Bills_payment/gocabFundRequestAPI',
            // url: '/Bills_payment/gocabFundRequestAPITest', //FOR TESTING
            data: {amount: $("#amount").val(), referencenos: $("#refnoDetails").val()},

            success: function(data){
              
              $("#transpassError").hide();
              let datum = JSON.parse(data);  
              if(datum.result){
                $('#newModal').modal('hide');
                $("#btnCheckRefno").html('Check Reference Number');
                $("#transpassError").show();
                $("#transpassError").css("color","green");
                $("#transpassError").html(datum.result.message);
                $("#showResponseForCheckRef").hide();
                $("#showForm").hide(); 

                  $.ajax({ // DEBITWALLET AND INSERT TO DATABASE
                    type: 'POST',
                    url: '/Bills_payment/gocabDebitandInsert',
                    data: {
                      fname: $("#fname").val().trim(),
                      lname: $("#lname").val().trim(),
                      address: $("#address").val().trim(),
                      email: $("#email").val().trim(),
                      mobile: $("#mobile").val().trim(),
                      refno: $("#refno").val().trim(),
                      amount: $("#amount").val().trim(),
                      originalamount: $("#originalamount").val().trim()
                    },

                    success: function(data){  
                   
                      let datum = JSON.parse(data);
                       
                      console.log("INSERT DATABASE", datum);
                      $('#newModal').modal('hide');
                      $("#btnSecondSubmit").attr("disabled",true);
                      
                      $("#transpassError").show();
                      $("#transpassError").css("color","green");
                      if(!datum.result.M.includes('successfully')){
                        $("#transpassError").html("Successful Transaction. <label sytle='background-color: green'>Tracking Number: "+"<u><b><a href='https://mobilereports.globalpinoyremittance.com/portal/gocab_receipt/"+ datum.result.TN +"' target='_blank'  >"+datum.result.TN+"</a></b></u>"+" </label><br>Click the tracking number to download your acknowledgement receipt.");
                      }
                      $("#transpassError").html("<div  class='alert alert-success'>Successful Transaction. <span sytle='background-color: BLUE; '>TRACKING NUMBER: "+"<u><b><a href='https://mobilereports.globalpinoyremittance.com/portal/gocab_receipt/"+ datum.result.TN +"' target='_blank'  >"+datum.result.TN+"</a></b></u>"+" </span><br>Click the tracking number to download your acknowledgement receipt.</div>");
                      
                      $("#fname").val("");
                      $("#lname").val("");
                      $("#address").val("");
                      $("#email").val("");
                      $("#mobile").val("");  
                      $("#checkrefno").val(""); 
                    
                    },
                    error: function(data){
                      
                    }
                  }); 
                return;
              } 
              if(datum.code){
                $("#closemodal").hide();
                $("#transpassError").show();
                $("#transpassError").css("color","red");
                $("#transpassError").html(datum.error); 
                return;
              } 
            },
            error: function(data){
              console.log(data);
            }
          });
        } 
      },
      error: function(data){
        console.log(data);
      }
  });
})
</script>

<script>
  $("input").on("keypress", function(e) {
    if (e.which === 32 && !this.value.length)
      e.preventDefault();
  });
</script>