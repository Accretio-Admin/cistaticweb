fetchCebuanaActivation()

function fetchCebuanaActivation() {
  $.ajax({
    url: `${location.protocol}//${window.location.host}/ecash_payout/fetch_cebuana_activation`,
    dataType: 'JSON',
    type: "POST",
    success: function (data) {
      if (data.S == 2) {
        createCebuanaModal();
      }else if(data.S == 0){
        // alert(data.M)
      }else{
        // log("handle this bleech");
      }
    },
    error: function (data) {
      console.log(data)
    }
  });
}

function createCebuanaModal() {
  $('.contentpanel').append(
    `<div class="modal fade" id="cebuanaActivationModal" role="dialog" data-keyboard="false" data-backdrop="static" style="top:45px;">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header" style="background-color:#fca600">
            <h4 class="modal-title">Cebuna Payout Services</h4>
          </div>
          
          <div class="modal-body">
            <div id="dvCebunaMsg" class="alert " style="display:none"></div>
            <div class="">
              <div class="form-group" ><b> ACTIVATE THIS SERVICE FOR ONLY P100 </b></div>
            </div>
          
            <div class="dvSubmitActiviation" style="display:none">
              <div class="form-group" >
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 27px; font-weight: bold;">Transaction Password</span>
                  <input type="password" class="form-control" required name="transactionPassword" id="transactionPassword">
                </div>
              </div>
              
              <div class="form-group" >
                <span id="spnError" style="color:red"></span>
              </div>
            </div>
            
            <div class="modal-footer">
              <div class="dvActivateMsg">
                <button id="btnCloseCebuanaModal" type="button" class="btn btn-default pull-left" >Close</button>
                <a href="javaScript:void(0)" type="button" id="btnActivateCebuana" class="btn btn-success">Activate</a>
              </div>
              
              <div class="dvSubmitActiviation" style="display:none">
                <button id="btnCloseCebuanaModal" type="button" class="btn btn-default pull-left">Close</button>
                <a href="javaScript:void(0)" class="btn btn-success"  id="btnProceedCebuanaService">Proceed</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>`
  );
  $('#cebuanaActivationModal').modal('show');
}

$("#availCebuanaReservation").click(function () {
  availCebuanaReservation();
});

$(document).ready(function () {
  $('.contentpanel').delegate("#btnActivateCebuana", "click", function (e) {
    $(".dvSubmitActiviation").show();
    $(".dvActivateMsg").hide();
  });

  $('.contentpanel').delegate("#btnProceedCebuanaService", "click", function (e) {
    e.preventDefault();
    if ($.trim($("#transactionPassword").val()) == "") {
      $("#spnError").text("Please input transaction password");
      return;
    } else {
      waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'warning' });
      $("#spnError").text("");
      $("#dvCebunaMsg").hide();
      $("#dvCebunaMsg").empty();
      $('#dvCebunaMsg').removeClass("alert-danger");
      $.ajax({
        url: `${location.protocol}//${window.location.host}/ecash_payout/activate_cebuana_service`,
        dataType: 'JSON',
        type: "POST",
        data: {
          transactionPassword: $("#transactionPassword").val(),
        },
        success: function (data) {
          console.log("ACTIVATION ",data);
          if (data.S == 1) {
            $('#dvCebunaMsg').addClass("alert-success");
            $(".dvSubmitActiviation").hide();
            $("#dvCebunaMsg").attr('disabled', 'disabled');
          } else {
            $('#dvCebunaMsg').addClass("alert-danger");
          }

          $("#dvCebunaMsg").show();
          $('#dvCebunaMsg').text(data.M)

          if (data.S == 1) {
            setInterval(function () {
              location.reload();
            }, 2000);
          }

          waitingDialog.hide();
        },
        error: function (data) {
          console.log(data)
        }

      });
    }
  });

  $('.contentpanel').delegate('#cebuanaActivationModal', 'hidden.bs.modal', function () {
    resetModel();
  });

  $(".contentpanel").delegate("#btnCloseCebuanaModal", "click", function () {
    window.location.href = `${location.protocol}//${window.location.host}/ecash_payout`
  });

  function resetModel() {
    $(".dvSubmitActiviation").hide();
    $(".dvActivateMsg").show();
    $("#spnError").text("");
    $("#dvCebunaMsg").hide();
    $("#dvCebunaMsg").empty();
    $('#dvCebunaMsg').removeClass("alert-danger");
  }
});
