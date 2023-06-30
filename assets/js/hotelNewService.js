function availHotelReservation() {
  checkKYC();
  $.ajax({
    url: `${location.protocol}//${window.location.host}/hotels/getUserHotelServiceDetails`,
    dataType: 'JSON',
    type: "POST",
    success: function (data) {
      if (data.results == 0) {
        createModal(0);
      } else if (data.results == 1) {
        log("handle this bleech");
      }
    },
    error: function (data) {
      console.log(data)
    }
  });
}

function createModal() {
  $('.contentpanel').append(
    `<div class="modal fade" id="hotelServiceModal" role="dialog" data-keyboard="false" data-backdrop="static" style="top:45px;">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header" style="background-color:#fca600">
            <h4 class="modal-title">Hotel Reservation Services</h4>
          </div>
          
          <div class="modal-body">
            <div id="dvMsg" class="alert " style="display:none"></div>
            <div class="">
              <div class="form-group" > ACTIVATE THIS SERVICE FOR ONLY P100 </div>
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
                <button id="btnCloseModal" type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <a href="javaScript:void(0)" type="button" id="btnActivateHotel" class="btn btn-success">Activate</a>
              </div>
              
              <div class="dvSubmitActiviation" style="display:none">
                <button id="btnCloseModal" type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <a href="javaScript:void(0)" class="btn btn-success"  id="btnProceedService">Proceed</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>`
  );
  $('#hotelServiceModal').modal('show');
}

$("#availHotelReservation").click(function () {
  availHotelReservation();
});

$("#downHotel").click(function () {
  downHotel();
});


function downHotel() {
  $('.contentpanel').append(
    `<div class="modal fade" id="hotelServiceModal" role="dialog" data-keyboard="false" data-backdrop="static" style="top:45px;">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header" style="background-color:#fca600">
            <h4 class="modal-title">Hotel Reservation Services</h4>
          </div>
          
          <div class="modal-body">
            <div id="dvMsg" class="alert " style="display:none"></div>
            <div class="">
              <div class="form-group" > This service is being updated.  Please transact again after 3 to 4 hours. </div>
            </div>
          </div>

          <div class="modal-footer">
            <div class="dvActivateMsg">
                <button id="btnCloseModal" type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              </div>
            </div>
        </div>
      </div>
    </div>`
  );
  $('#hotelServiceModal').modal('show');
}

$(document).ready(function () {
  $('.contentpanel').delegate("#btnActivateHotel", "click", function (e) {
    $(".dvSubmitActiviation").show();
    $(".dvActivateMsg").hide();
  });

  $('.contentpanel').delegate("#btnProceedService", "click", function (e) {
    e.preventDefault();
    if ($.trim($("#transactionPassword").val()) == "") {
      $("#spnError").text("Please input transaction password");
      return;
    } else {
      waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'warning' });
      $("#spnError").text("");
      $("#dvMsg").hide();
      $("#dvMsg").empty();
      $('#dvMsg').removeClass("alert-danger");
      $.ajax({
        url: `${location.protocol}//${window.location.host}/hotels/activate_hotel_service`,
        dataType: 'JSON',
        type: "POST",
        data: {
          transactionPassword: $("#transactionPassword").val(),
        },
        success: function (data) {
          if (data.S == 1) {
            $('#dvMsg').addClass("alert-success");
            $(".dvSubmitActiviation").hide();
            $("#dvMsg").attr('disabled', 'disabled');
          } else {
            $('#dvMsg').addClass("alert-danger");
          }

          $("#dvMsg").show();
          $('#dvMsg').append(data.M)

          if (data.S == 1) {
            setInterval(function () {
              location.reload();
            }, 5000);
          }

          waitingDialog.hide();
        },
        error: function (data) {
          console.log(data)
        }

      });
    }
  });

  $('.contentpanel').delegate('#hotelServiceModal', 'hidden.bs.modal', function () {
    resetModel();
  });

  $(".contentpanel").delegate("#btnCloseModal", "click", function () {
    resetModel();
  });

  function resetModel() {
    $(".dvSubmitActiviation").hide();
    $(".dvActivateMsg").show();
    $("#spnError").text("");
    $("#dvMsg").hide();
    $("#dvMsg").empty();
    $('#dvMsg').removeClass("alert-danger");
  }
});
