<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<div class="mainpanel">
  <div class="pageheader">
    <div class="media">
      <div class="pageicon pull-left">
          <i class="fa fa-credit-card"></i>
      </div>
      <div class="media-body">
        <ul class="breadcrumb">
          <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
          <li>BILLS PAYMENT </li>
        </ul>
        <h4>UNIFIED</h4>
      </div>
    </div><!-- media -->
  </div><!-- pageheader -->
  <div class="contentpanel">
    <div class="row">
      <div class="col-xs-12">
        <!-- <td><a href="http://10.10.1.222:8095/portal/unified_receipt/<?php echo $API['R'][$x]['trackno'] ?>" target="_blank" class="btn btn-info" role="button">Print Receipt</a></td> -->
        <div class="panel panel-primary">
          <div id='alertId'></div>
          <div class="panel-heading">UNIFIED API</div>
          <div style="padding: 5px;padding-left: 10px">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="checkrefno">Check Reference Number:</label>
                  <input type="checkrefno" style="width: 210px" class="form-control" id="checkrefno" placeholder="Enter Reference Number" name="checkrefno">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <button type="button" style="padding: 12px 24px;" id="btnCheckRefno" class="btn btn-success">Check Reference Number</button>
                </div>
              </div>
            </div>
          </div>
          <div class="panel-body" style="height: 600px;overflow-y: scroll;"> 
            <div id="showForm" class="col-md-8">
              <div class="row">
                <div class="col-md-6">  
                  <div class="form-group">
                    <label for="refno">Reference Number:</label>
                    <input readonly type="text" class="form-control " id="refno" placeholder="Enter Reference Number" name="refno">
                  </div>
                </div>
                <div class="col-md-6">  
                  <div class="form-group">
                    <label for="status">STATUS:</label>
                    <input type="status" readonly class="form-control " id="status" placeholder="STATUS" name="status">
                    <span class="errorMessage" id="addressError"></span>
                  </div> 
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">  
                  <div class="form-group">
                    <label for="name">FULLNAME:</label>
                    <input type="name" readonly class="form-control" id="name" placeholder="Enter First Name" name="name">
                    <span class="errorMessage" id="nameError"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">  
                  <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" readonly class="form-control " id="email" placeholder="Enter Email Address" name="email">
                    <span class="errorMessage" id="emailError"></span>
                  </div>
                </div>
                <div class="col-md-6">  
                  <div class="form-group">
                    <label for="amount">Amount:</label>
                    <input readonly="" type="text" class="form-control " oninput="validate(this)" onkeypress="return isNumberKey(event,this.id)" id="amount" placeholder="Enter Amount" name="amount">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">  
                  <div class="form-group">
                    <label for="mobile">Mobile No:</label>
                    <input type="text" class="form-control " oninput="validate(this)" onkeypress="return isNumberKey(event,this.id)" id="mobile" placeholder="Enter Mobile No" name="mobile">
                  </div>
                </div>
                <div class="col-md-6">  
                  <div class="form-group">
                    <label for="pword">Transaction Password:</label>
                    <input type="password" class="form-control" id="pword" name="pword">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">  
                  <div class="form-group">
                    <button id="btnFirstSubmit" class="btn btn-info">Submit</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- row --> 
  </div><!-- contentpanel -->       
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
    $(".alert").alert("close");   

    $("#btnCheckRefno").html('Searching..');
    $("#btnCheckRefno").append('<i id="loadingcheckRef" style="color: yellow" class="fa fa-circle-o-notch fa-spin"></i>');
    let refno = $("#checkrefno").val();

    $.ajax({
      type: 'POST',
      url: '/Bills_payment/unifiedCheckReferenceNo',
      dataType: 'json',      
      data: {refno: refno},
      success: function(datas){
        let td = ``;
        let result = ``;
        
        if(datas.S == 1){
          result = datas.result;
          if (result.success == 1) {
            $("#name").val(result.accountname);
            $("#amount").val(result.totalamount);
            $("#refno").val(result.refno);
            $("#email").val(result.email);
            $("#status").val(result.STATUS); 
            $("#showForm").show();
          } else {
            document.getElementById('alertId').innerHTML = `
              <div class="alert alert-danger alert-dismissible" role="alert">`+result.STATUS+`
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              </div>`;
            $("#showForm").hide();
          }
        } else {
          $("#showForm").hide();
          document.getElementById('alertId').innerHTML = `
              <div class="alert alert-warning alert-dismissible" role="alert">`+datas.M+`
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              </div>`;
            $("#showForm").hide();
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
  $("#btnFirstSubmit").click(function(){
    $(".alert").alert("close");
    waitingDialog.show();
    $.ajax({ 
        type: 'POST',
        url: '/Bills_payment/unifiedDebitReferenceTransaction',
        dataType: 'json',
        data: {
            refno: $("#checkrefno").val(),
            pword: $("#pword").val(),
            mobile: $("#mobile").val(),
        },
        success: function(datas){
          if(datas.S == 1){
            if (dataResult.success == 1) {
              document.getElementById('alertId').innerHTML = `
                <div class="alert alert-success alert-dismissible" role="alert">`+
                  `Successful Transaction. TRACKING NO: <a href="https://mobilereports.globalpinoyremittance.com/portal/billspayment_receipt/`+dataResult.trackno+`" class="alert-link">`+
                    dataResult.trackno+`</a>. Click the tracking number to download your acknowledgement receipt.
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>`;
            } else {
              document.getElementById('alertId').innerHTML = `
                <div class="alert alert-danger alert-dismissible" role="alert">`+dataResult.message+`
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>`;
              
            }
          } else {
            $("#showForm").hide();
            document.getElementById('alertId').innerHTML = `
                <div class="alert alert-warning alert-dismissible" role="alert">`+datas.M+`
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>`;
            dataResult = datas.result;            
          }
          $("#showForm").hide();
          $("#checkrefno").val("");

          waitingDialog.hide();
        },
        error: function(datas){
          console.log(datas);
        }
    });
  })
</script>

<script>
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

  $("input").on("keypress", function(e) {
    if (e.which === 32 && !this.value.length)
      e.preventDefault();
  });
</script>