//$(document).ready(function(){
checkKYC()
function checkKYC() {
  $.ajax({
    type: 'POST',
    url: `${location.protocol}//${window.location.host}/main/checkKYC`,
    processData: false,
    contentType: false,
    success: function (data) {
      res = JSON.parse(data)
      if (res.S == 4) {
        modal(1)
        $('#kycmsg').show();
        $('#kycmsg').append(res.M)
        $('#kycmsg').addClass("alert-danger");
      } else if (res.S == 2) {
        pending(res.DATA.id_attachment, res.DATA.selfie_attachment)
      } 
    },
    error: function (data) {
      console.log(data)
    }
  });
}

function pending(penid, penselfie) {
   var selfie = `${location.protocol}//${window.location.host}/assets/images/kyc/selfie_with_id.png`
  var ids = `${location.protocol}//${window.location.host}/assets/images/kyc/id_sample.png`
  var rgc = $('small.text-muted.col-md-12:first-child').children('span.badge').text()
  var modal = `  <div class="modal fade" id="kycPendingModal" role="dialog" data-keyboard="false" data-backdrop="static">
                      <div class="modal-dialog modal-md">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#fca600">
                            <h4 class="modal-title">Know Your Customer</h4>
                          </div>
                          <div class="modal-body">
                            <form method="post" action="${location.protocol}//${window.location.host}" id="kycformpending">
                             
                            <div class="alert alert-warning">
                            <span style="color: #000">
                            <strong>
                              Your valid ID and ID with selfie are pending for approval. 
                              <hr>
                              Please wait until approval is granted within an hour by our Technical Team.
                            </strong>
                            </span>
                          </div> 
                              <div class="alert" style="display:none" id="kycmsg"> </div>
                              <div class="form-group" >
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 22px; font-weight: bold;">REGCODE:</span>
                                    <input type="text" class="form-control" required name="inputkycrgc" required value="${rgc}" readonly id="inputkycrgc">
                                  </div>
                              </div>
                              <div class="form-group" >
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 27px; font-weight: bold;">VALID ID:</span>
                                    <a class="form-control" href="${penid}" target="_blank">PENDING ID</a>
                                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 10px; font-weight: bold;"><a rel="popover" data-img="${ids}">Sample</a></span>
                                  </div>
                              </div>
                              <div class="form-group" >
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 10px; font-weight: bold;">ID w/ Selfie:</span>
                                    <a class="form-control" href="${penselfie}" target="_blank">PENDING SELFIE with ID</a>
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 10px; font-weight: bold;"><a rel="popover" data-img="${selfie}">Sample</a></span>
                                </div>
                              </div>
                          </div>
                          <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>`

  $('.contentpanel').append(modal)

  $('#kycPendingModal').modal('show');

  $('a[rel=popover]').popover({
    html: true,
    trigger: 'hover',
    placement: 'right',
    content: function () { return `<img style="height:auto;width:200px" src="${$(this).data('img')}" />`; }
  });
}

function modal(show) {
    


   var selfie = `${location.protocol}//${window.location.host}/assets/images/kyc/selfie_with_id.png`
  var ids = `${location.protocol}//${window.location.host}/assets/images/kyc/id_sample.png`
  var rgc = $('small.text-muted.col-md-12:first-child').children('span.badge').text()
  var close =''
  if(show == 1){
    close = `<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>`
    logout = ``
  }else{
    close = ``
    logout = `<button type="button" class="btn btn-default"><a href="${location.protocol}//${window.location.host}/Login/user_logout">Logout</a></button>`
  }
  var modal = `  <div class="modal fade" id="kycModal" role="dialog" data-keyboard="false" data-backdrop="static">
                    <div class="modal-dialog modal-md">
                      <div class="modal-content">
                        <div class="modal-header" style="background-color:#fca600">
                          <h4 class="modal-title">Know Your Customer</h4>
                        </div>
                        <div class="modal-body">
                          <form method="post" action="${location.protocol}//${window.location.host}" id="kycform">
                           
                            <div class="alert alert-warning">
                              <strong><span style="color: #000">
                              In compliance to (Circular 950 Anti-Money Laundering Act), kindly update your address and upload one (1) <a rel="popover" data-img="${ids}">government issued ID</a> and one “<a rel="popover" data-img="${selfie}">selfie with the same government issued ID</a>”. Validation of the account shall be completed within an hour upon update.
                              </span></strong>
                              <br/>
                              
                              <br />
                               <a href="https://www.wikihow.com/Resize-an-Image-in-Microsoft-Paint" target="_blank"><span class="glyphicon glyphicon-question-sign"></span> How to reduce image size</a>
                            </div> 

                            <div class="alert alert-warning">
                            <strong><span style="color: #000">
                            Please <a style="cursor: pointer;" data-toggle="modal" data-target="#myModal">click here</a> for the list of valid IDs
                            </span></strong>
                            </div> 

                            <div class="alert" style="display:none;text-transform:capitalize;" id="kycmsg"> </div>
                            <div class="form-group" >
                              <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right: 22px; font-weight: bold;">REGCODE:</span>
                                  <input type="text" class="form-control" required name="inputkycrgc" required value="${rgc}" readonly id="inputkycrgc">
                                </div>
                            </div>
                            <div class="form-group" >
                              <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right: 27px; font-weight: bold;">VALID ID:</span>
                                  <input type="file" class="form-control" required name="inputkycid" id="inputkycid">
                                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 10px; font-weight: bold;"><a style="cursor: pointer;" rel="popover" data-img="${ids}">Sample</a></span>
                                </div>
                            </div>
                            <div class="form-group" >
                              <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right: 10px; font-weight: bold;">ID w/ Selfie:</span>
                                  <input type="file" class="form-control" required name="inputkycselfie" id="inputkycselfie">
                                <span class="input-group-addon" id="basic-addon1" style="padding-right: 10px; font-weight: bold;"><a style="cursor: pointer;" rel="popover" data-img="${selfie}">Sample</a></span>
                              </div>
                            </div>

                            <div class="alert alert-warning">
                            <strong><span style="color: #000">
                              Please <a style="cursor: pointer;" data-toggle="modal" data-target="#myModal">click here</a> for uploading your selfie video.
                            </span></strong>
                            </div> 
                        </div>
                        <div class="modal-footer">
                          ${logout} ${close} 
                          <button type="submit" id="kycbutton" class="btn btn-success" >Submit</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>

                            <div class="modal fade" id="myModal" role="dialog">
                              <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Valid IDs</h4>
                                  </div>
                                  <div class="modal-body">
                                    <ul style="font-weight: bold;">
                                      <li>Passport</li>
                                      <li>Driver's License</li>
                                      <li>Professional Regulation Commission (PRC)</li>
                                      <li>Unified Multi-Purpose ID (UMID)</li>
                                      <li>Postal ID</li>
                                      <li>Voters ID</li>
                                      <li>Senior Citizen Card</li>
                                      <li>Social Security System (SSS)</li>
                                      <li>Integrated Bar of the Philippines</li>
                                      <li>NBI Clearance/ID</li>
                                    </ul>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                            </div>`

  $('.contentpanel').append(modal)

  $('#kycModal').modal('show');

  $('a[rel=popover]').popover({
    html: true,
    trigger: 'hover',
    placement: 'right',
    content: function () { return `<img style="height:auto;width:250px" src="${$(this).data('img')}" />`; }
  });

  $('#kycModal').on('hidden.bs.modal', function () {
    $('#kycModal').remove()
    $('#adrstab')
  })

$(document).on('click', '#kycbutton', function () {
    var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
    $('#kycmsg').hide();
    if ($('#inputkycrgc').val() == '') {
      $('#kycmsg').show();
      $('#kycmsg').text('Regcode is Required')
      $('#kycmsg').addClass("alert-danger");
    } else if ($('#inputkycid').val() == '') {
      $('#kycmsg').show();
      $('#kycmsg').text('ID Upload is Required')
      $('#kycmsg').addClass("alert-danger");
    }else if ($.inArray($('#inputkycid').val().split('.').pop().toLowerCase(), fileExtension) == -1) {
      $('#kycmsg').show();
      $('#kycmsg').text('ID Upload is Required')
      $('#kycmsg').addClass("alert-danger");
    } else if ($('#inputkycselfie').val() == '') {
      $('#kycmsg').show();
      $('#kycmsg').text('ID Only formats are allowed : jpeg, jpg, png, gif, bmp')
      $('#kycmsg').addClass("alert-danger");
    }else if ($.inArray($('#inputkycselfie').val().split('.').pop().toLowerCase(), fileExtension) == -1) {
      $('#kycmsg').show();
      $('#kycmsg').text('ID with selfie Only formats are allowed : jpeg, jpg, png, gif, bmp')
      $('#kycmsg').addClass("alert-danger");
    } else {
      waitingDialog.show('Please Wait..', { dialogSize: 'sm', progressType: 'warning' });
      kycsubmit()
    }
  })


  function kycsubmit() {
    var formData = $("#kycform")[0]
    var form_data = new FormData(formData);
    $.ajax({
      type: 'POST',
      url: `${location.protocol}//${window.location.host}/main/kyc`,
      data: form_data,
      processData: false,
      contentType: false,
      success: function (data) {
        res = JSON.parse(data)
        waitingDialog.hide()
        if (res.S == 1) {
          $('#kycmsg').show();
          $('#kycmsg').text(res.M)
          $("#kycmsg").removeClass("alert-danger");
          $('#kycmsg').addClass("alert-success");
          $('#kycbutton').remove();
          $('#kycmsg').fadeOut(10000, function () {
            location.reload();
          });
        } else {
          $('#kycmsg').show();
          $('#kycmsg').text(res.M)
          $('#kycmsg').addClass("alert-danger");
          $('#kycmsg').fadeOut(10000);
        }
      },
      error: function (data) {
        console.log(data)
      }
    });

    //############################# PENDING #######################################//

    $('#kycPendingModal').on('hidden.bs.modal', function () {
      $('#kycPendingModal').remove()
      $('#adrstab')
    })

  }
}

//})