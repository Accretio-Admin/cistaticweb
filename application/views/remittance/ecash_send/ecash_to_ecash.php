<div class="mainpanel">
  <div class="pageheader">
    <div class="media">
      <div class="pageicon pull-left">
        <i class="fa fa-money"></i>
      </div>
      <div class="media-body">
        <ul class="breadcrumb">
          <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
          <li>ECASH</li>
        </ul>
        <h4>E-Cash to E-Cash</h4>
      </div>
    </div><!-- media -->
  </div><!-- pageheader -->
    
  <div class="contentpanel" style="padding-top: 10px; padding-bottom: 0px;">
    <div class='divAlert' id="divAlerts"></div>
    <div class="row row-stat">
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-body" style="border: 1px solid #d3d3d3; border-radius:10px; padding: none;"><!--style="background-color: #FF9933;"-->
            <!-- <p>Collect from the client an additional <span style="color: #FF9933;">&#x20b1 25.00 </span> for the charge.</p> -->
            <p>e-Cash Loadwallet is use for the Remittance(Smartmoney). Visa Card and Universal Loadwallet. </p>
            <p>Use the form below to transfer Dealer's e-Cash to Member's e-Cash. </p>
          </div>
        </div>   
      </div><!-- col-md-9 -->
    </div><!-- row -->
  </div><!-- contentpanel -->    

  <div class="contentpanel" style="padding-top: 0px;"> 
    <div class="panel panel-default" style="border: 0px solid;">
      <div class="col-xs-6  col-md-6">
        <div class="row">
          <div class='col-xs-12 col-md-8'>
              <form name="frmecashtoecash" id="frmecashtoecash">
                <h5 style="font-weight: bold; color: #4169E1;">TRANSFER DETAILS</h5>
                <div class="form-group">
                  <input type="text" class="form-control" id="inputDealersRegcode" name="inputDealersRegcode" placeholder="DEALER'S REGCODE" required/>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" id="inputAmountTransaction" name="inputAmountTransaction" placeholder="AMOUNT TRANSFER" required/>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" id="inputTpass" name="inputTpass" placeholder="TRANSACTION PASSWORD" required/>
                </div>
                  
                <div class="form-group text-right">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
              <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="processModal" aria-hidden="true">
                <form name="frmecashtoecash2" id="frmecashtoecash2">
                  <div class="modal-dialog" role="document">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-body">
                        <h4>Are you sure you want to proceed ?</h4>
                        <label hidden id="dreg" class="dreg"></label>
                        <label hidden id="atrans" class="atrans"></label>
                        <label hidden id="tpass" class="tpass"></label>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Proceed</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div> <!-- col-xs-8 col-md-8-->
          </div> <!-- row -->
        </div> <!--col-xs-6 col-md-6-->
      </div>
    </div>           
</div><!-- mainpanel -->            


<script type="text/javascript">

  $('#frmecashtoecash').submit((e) => {
    e.preventDefault();
    $('#myModal #dreg').html($('#inputDealersRegcode').val());
    $('#myModal #atrans').html($('#inputAmountTransaction').val());
    $('#myModal #tpass').html($('#inputTpass').val());

    $('#myModal').modal('show'); 
  });

  $('#frmecashtoecash2').submit((e) => {
    e.preventDefault();

    waitingDialog.show('Data Validation. Please Wait.', {dialogSize: 'sm', progressType: 'primary'});

    var formdata = new FormData();
    formdata.append('dealerRegcode',$('#dreg').text());
    formdata.append('amountTransaction',$('#atrans').text());
    formdata.append('inputTpass',$('#tpass').text());

    $.ajax({
      url: "/Ecash_send/ecash_to_ecash_transaction",
      type: 'POST',
      data : formdata,
      processData: false,
      contentType: false,
      success: function (data) {
        var ecash = JSON.parse(data);
        if(ecash['S'] == '1'){
          validationSuccess(ecash['M']);
          waitingDialog.hide();
          $('#myModal').modal('hide'); 
        }else{
          validationFail(ecash['M']);
          waitingDialog.hide();
          $('#myModal').modal('hide'); 
        }
      }
    });
  });

  function validationFail (data) {
    $('.divAlert').html('<div class="alert alert-danger alert-dismissible" role="alert">'+                
    '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+data+'</div>');
  }

  function validationSuccess (data) {
    $('.divAlert').html('<div class="alert alert-success alert-dismissible" role="alert">'+                
    '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+data+'</div>');
  }

</script>