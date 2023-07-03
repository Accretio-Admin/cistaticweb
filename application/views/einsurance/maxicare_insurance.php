<div class="mainpanel">
  <div class="pageheader">
    <div class="media">
      <div class="pageicon pull-left">
        <i class="fa fa-money"></i>
      </div>

      <div class="media-body">
        <ul class="breadcrumb">
          <li>
            <a href="<?php echo BASE_URL('/Main')?>">
              <i class="glyphicon glyphicon-home"></i>
            </a>
          </li>
          <li>E-INSURANCE</li>
        </ul>

        <h4>MAXICARE</h4>
      </div>
    </div>
  </div>

  <div class="contentpanel" style="padding-bottom: 0px;">
    <div class='divAlert'></div>
    
    <div class="row"> 
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <div class="form-group">
          <form id="form" name="form">
            <div style="padding-bottom: 10px;">
              <select class="form-control" name="inputProduct" id="inputProduct" required>
                <option value="" disabled selected>--CHOOSE PRODUCT--</option> 

                <?php foreach ($products as $row): ?>
                  <option id="<?php echo $row['value'] ?>">
                    <?php echo $row['label'] ?>
                  </option> 
                <?php endforeach ?>
              </select>
            </div>

            <div id="inputFields" style="display: none;">
              <input 
                type="hidden"
                class="form-control" 
                id="inputProductName"
              />

              <input 
                type="hidden"
                class="form-control" 
                id="inputProductCode"
              />

              <input 
                type="hidden"
                class="form-control" 
                id="inputAmount" 
              />

              <input 
                type="hidden"
                class="form-control" 
                id="inputService"
              />

              <div style="padding-bottom: 10px;">
                <input 
                  class="form-control" 
                  id="inputFname" 
                  placeholder="FIRST NAME" 
                  autocomplete="off" 
                  required 
                />
              </div>

              <div style="padding-bottom: 10px;">
                <input 
                  class="form-control" 
                  id="inputLname" 
                  placeholder="LAST NAME" 
                  autocomplete="off" 
                  required 
                />
              </div>

              <div style="padding-bottom: 10px;">
                <input 
                  class="form-control" 
                  id="inputBday"
                  placeholder="BIRTH DATE" 
                  autocomplete="off" 
                  required 
                />
              </div>

              <div style="padding-bottom: 10px;">
                <input 
                  class="form-control" 
                  id="inputOccupation" 
                  placeholder="OCCUPATION" 
                  autocomplete="off" 
                  required 
                />
              </div>

              <div style="padding-bottom: 10px;">
                <input 
                  class="form-control" 
                  id="inputNumber" 
                  placeholder="CONTACT NUMBER" 
                  pattern="[0-9]{11}" 
                  title="Input must be a number and equal to 11 digits."
                  autocomplete="off" 
                  required 
                />
              </div>

              <div style="padding-bottom: 10px;">
                <input 
                  class="form-control" 
                  id="inputEmail" 
                  type="email"
                  placeholder="EMAIL ADDRESS" 
                  autocomplete="off" 
                  required 
                />
              </div>

              <div style="padding-bottom: 10px;">
                <textarea  
                  class="form-control" 
                  id="inputAddress" 
                  placeholder="CURRENT ADDRESS" 
                  autocomplete="off" 
                  required 
                ></textarea>
              </div>

              <div style="padding-bottom: 10px;" align="right">
                <button type="submit" class="btn btn-primary">
                  Proceed
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="transacSummModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="form-group">
        <form name="fromTransSumm" id="fromTransSumm">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalLabel">
                Transaction Summary
              </h5>
            </div>
            
            <div class="modal-body">
              <div class="row gy-5">
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  <div style="margin-bottom: 10px;">
                    <div>
                      <span style="font-weight: bold; font-size: 15px;">
                        Product:
                      </span>
                    </div>

                    <div>
                      <span style="font-size: 15px;" id="summProduct">
                    </div>
                  </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  <div style="margin-bottom: 10px;">
                    <div>
                      <span style="font-weight: bold; font-size: 15px;">
                        Price:
                      </span>
                    </div>

                    <div>
                      <span style="font-size: 15px;" id="summPrice">
                    </div>
                  </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  <div style="margin-bottom: 10px;">
                    <div>
                      <span style="font-weight: bold; font-size: 15px;">
                        Firstname:
                      </span>
                    </div>

                    <div>
                      <span style="font-size: 15px;" id="summFname">
                    </div>
                  </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  <div style="margin-bottom: 10px;">
                    <div>
                      <span style="font-weight: bold; font-size: 15px;">
                        Lastname:
                      </span>
                    </div>

                    <div>
                      <span style="font-size: 15px;" id="summLname">
                    </div>
                  </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  <div style="margin-bottom: 10px;">
                    <div>
                      <span style="font-weight: bold; font-size: 15px;">
                        Birthday:
                      </span>
                    </div>

                    <div>
                      <span style="font-size: 15px;" id="summBday">
                    </div>
                  </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  <div style="margin-bottom: 10px;">
                    <div >
                      <span style="font-weight: bold; font-size: 15px;">
                        Occupation:
                      </span>
                    </div>

                    <div>
                      <span style="font-size: 15px;" id="summOccupation">
                    </div>
                  </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  <div style="margin-bottom: 10px;">
                    <div>
                      <span style="font-weight: bold; font-size: 15px;">
                        Contact:
                      </span>
                    </div>

                    <div>
                      <span style="font-size: 15px;" id="summContact">
                    </div>
                  </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  <div style="margin-bottom: 10px;">
                    <div>
                      <span style="font-weight: bold; font-size: 15px;">
                        Email Address:
                      </span>
                    </div>

                    <div>
                      <span style="font-size: 15px;" id="summEmail">
                    </div>
                  </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  <div style="margin-bottom: 10px;">
                    <div>
                      <span style="font-weight: bold; font-size: 15px;">
                        Current Address:
                      </span>
                    </div>

                    <div>
                      <span style="font-size: 15px;" id="summAddress">
                    </div>
                  </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  <div>
                    <span style="font-weight: bold; font-size: 15px;">
                      Transaction Password:
                    </span>
                  </div>

                  <div>
                    <input class="form-control" type="password" id="transPass" required />
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Cancel
              </button>

              <button type="submit" class="btn btn-primary">
                Confirm
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="prodDescModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="form-group">
        <form name="formProdDesc" id="formProdDesc">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalLabel">
                Product Details
              </h5>
            </div>
            
            <div class="modal-body" style="padding: 20px;">
              <div style="padding-bottom: 20px;">
                <img id="prodDescImg" style="width: 100%; height: 250px;"/>
              </div>

              <div style="height: 200px; overflow: auto;" >
                <span id="prodDescLbl"></span>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" id="prodDescModalCancelBtn">
                Cancel
              </button>

              <button type="submit" class="btn btn-primary">
                Proceed
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(() => {
    $('#transacSummModal').on('shown.bs.modal', function () {
      $('#transPass').trigger('focus')
    })
  })

  $('#inputBday').focus(() => {
    $('#inputBday').attr('type', 'date')
    $('#inputBday').attr('pattern', '(?:19|20)\[0-9\]{2}-(?:(?:0\[1-9\]|1\[0-2\])/(?:0\[1-9\]|1\[0-9\]|2\[0-9\])|(?:(?!02)(?:0\[1-9\]|1\[0-2\])/(?:30))|(?:(?:0\[13578\]|1\[02\])-31))')
  })

  $('#inputBday').blur(() => {
    $('#inputBday').removeAttr('type')
    $('#inputBday').removeAttr('pattern')
  })

  function clearFields () {
    $('#inputProductName').val('')
    $('#inputAmount').val('')
    $('#inputService').val('')
    $('#inputFname').val('')
    $('#inputLname').val('')
    $('#inputBday').val('')
    $('#inputOccupation').val('')
    $('#inputNumber').val('')
    $('#inputEmail').val('')
    $('#inputAddress').val('')
  }

  $('#inputProduct').change((e) => {
    e.preventDefault()

    waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});

    var params = {
      id: $('#inputProduct option:selected').attr('id')
    }

    $.ajax({
      type: 'POST',
      data: params,
      url: '/Einsurance/maxicare_prod_details',
      success: ((data) => {
        var jsonData = JSON.parse(data)
      
        if (jsonData.S == 1) {
          var details = jsonData.D[0]

          clearFields()
          $('#inputProductName').val(details.name)
          $('#inputProductCode').val(details.product_code)
          $('#inputAmount').val(details.price)
          $('#inputService').val(details.service)
          $('#prodDescModal').modal('show')
          $('#prodDescImg').attr('src', details.image)
          $('#inputProduct option:selected').val(details.plan_code);

          var desc = JSON.parse(details.description).data
          desc = desc.replaceAll('\\n', '<br/>')
          desc = desc.replaceAll('\\t', '&nbsp;')

          $('#prodDescLbl').html(desc)
        } else {
          $('.divAlert').html('<div class="alert alert-danger alert-dismissible" role="alert">' +                
            '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + jsonData.M + '</div>')
        }

        waitingDialog.hide()
      })
    })
  })

  $('#form').submit((e) => {
    e.preventDefault()

    $("#transacSummModal").modal('show');
    $('#summProduct').html($('#inputProduct :selected').text())
    $('#summPrice').html($('#inputAmount').val())
    $('#summFname').html($('#inputFname').val())
    $('#summLname').html($('#inputLname').val())
    $('#summBday').html($('#inputBday').val())
    $('#summOccupation').html($('#inputOccupation').val())
    $('#summContact').html($('#inputNumber').val())
    $('#summEmail').html($('#inputEmail').val())
    $('#summAddress').html($('#inputAddress').val())
  })

  $('#fromTransSumm').submit((e) => {
    e.preventDefault()

    $("#transacSummModal").modal('hide');
    waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
    
    var params = {
      product_name: $('#inputProductName').val(),
      product_code: $('#inputProductCode').val(),
      plan_code: $('#inputProduct').val(),
      service: $('#inputService').val(),
      first_name: $('#inputFname').val(),
      last_name: $('#inputLname').val(),
      birth_date: $('#inputBday').val(),
      occupation: $('#inputOccupation').val(),
      contact_number: $('#inputNumber').val(),
      email: $('#inputEmail').val(),
      address: $('#inputAddress').val(),
      amount: parseFloat($('#inputAmount').val()).toFixed(2),
      trans_pass: $('#transPass').val()
    }

    $.ajax({
      type: 'POST',
      data: params,
      url: '/Einsurance/maxicare_transac',
      success: ((data) => {
        var jsondata = JSON.parse(data)

        if (jsondata.S == 1) {
          // $('.divAlert').html('<div class="alert alert-success alert-dismissible" role="alert">'+                
          //     '<a href="#" class="close" data-dismiss="alert" aria-label="close" target="_blank">&times;</a>Transaction complete. Tracking No: <a href="https://mobilereports.globalpinoyremittance.com/portal/maxicare_receipt/' + jsondata.TN + '">' + jsondata.TN + '<a/></div>')

          $('.divAlert').html('<div class="alert alert-success alert-dismissible" role="alert">'+                
            '<a href="#" class="close" data-dismiss="alert" aria-label="close" target="_blank">&times;</a>Transaction complete. Tracking No: ' + jsondata.TN + ', Receipt has been sent to your email.<a/></div>')

          $('#inputProduct').val('')
          $('#inputFields').hide()
          clearFields()
        } else {
          $('.divAlert').html('<div class="alert alert-danger alert-dismissible" role="alert">' +                
            '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + jsondata.M + '</div>')
        }

        $('#transPass').val('')
        waitingDialog.hide()
      })
    })
  })

  $('#formProdDesc').submit((e) => {
    e.preventDefault()

    $('#inputFields').show()
    $('#prodDescModal').modal('hide')
  })

  $('#prodDescModalCancelBtn').click(() => {
    $('#inputProduct').val('')
    $('#inputFields').hide()
    clearFields()
  })
</script>

