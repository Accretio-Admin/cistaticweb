  <div class="mainpanel">
    <div class="pageheader">
      <div class="media">
        <div class="pageicon pull-left">
          <i class="fa fa-mobile-phone"></i>
        </div>
        <div class="media-body">
          <ul class="breadcrumb">
            <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
            <li>UPGRADE</li>
          </ul>
          <h4>PACKAGES</h4>
        </div>
      </div><!-- media -->
    </div><!-- pageheader -->
    

    <div class="contentpanel">
      <!-- Transaction Response -->
      <?php if ($result_transact['S'] === 0): ?>
          <div class="alert alert-danger"><?php echo $result_transact['M']; ?></div>
      <?php endif ?>
      <?php if ($result['S'] === 0): ?>
          <div class="alert alert-danger"><?php echo $result['M']; ?></div>
      <?php endif ?>
      <?php if ($result_transact['S'] == 1): ?>
        <?php if ($result_transact['M']['success'] == "1"): ?>
          <div class="alert alert-success"><?php echo $result_transact['M']['message']; ?></div>
        <?php else: ?>
          <div class="alert alert-danger"><?php echo $result_transact['M']['message']; ?></div>
        <?php endif ?>
      <?php endif ?>

      <div class="row">
        <div class="col-xs-4 col-md-2">
            </div>

              <div class="col-xs-6  col-md-5">
                <div class="row">
                    <div class='col-xs-12 col-md-12'>
                      <form name="frmregularload" action="<?php echo BASE_URL()?>Upgrade" method="post" id="frmregloading">
                        <div class="form-group" >
                          <select class="form-control" name="selPackage" id="selPackage" required>
                            <?php if(is_null($ACCOUNT_PRODUCTS['D'])): ?>
                                <option DISABLED selected>NO PACKAGE AVAILABLE</option>
                            <?php else: ?>
                                <option value="" disabled selected>SELECT PACKAGE</option>
                              <?php foreach($ACCOUNT_PRODUCTS['D'] as $key): $key['package_name']; ?>
                                <option value=<?php echo $key['upgrade_to'] ?> ><?php echo $key['package_name'] ?></option>
                              <?php endforeach ?>
                            <?php endif ?>
                          </select>
                        </div>

                        <div class="form-group">
                          <input disabled type="text" class="form-control" name="upgradeFee" id="upgradeFee" placeholder="AMOUNT" required/>
                        </div>

                        <div class="form-group">
                          <input type="password" class="form-control" name="inputTpass" id="inputTpass" placeholder="TRANSACTION PASSWORD" required/> <br/>
                        </div>

                        <div class="form-group text-center">
                          <h4>What is <?php echo $captcha['code1']  ?> + <?php echo $captcha['code2']  ?> ?</h4>
                        </div>
                        <div class="form-group">
                          <input type="number" class="form-control" name="inputCaptcha" placeholder="CAPTCHA CODE" required/>
                        </div>

                        <div class="form-group text-right">
                          <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Submit</button>
                        </div>


                        <div id="myModal" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-body">
                                <h4>Are you sure you want to proceed ?</h4>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="btnSubmit" id="btnSubmit">Proceed</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div> <!-- col-xs-8 col-md-8-->
                </div> <!-- row -->
              </div> <!--col-xs-6 col-md-6-->
        </div><!-- row -->
      </div><!-- contentpanel -->
  </div><!-- mainpanel -->  

<script>
  var package_data, total_fee, selCode

  $('#selPackage').on('change', function(){
    selCode = $("#selPackage").val();
    var params = {
      package_code: selCode,
    }
    $.ajax({
      url     : "/Upgrade/get_packagePrice",
      type    : 'POST',
      data    : params,
      datatype: 'json',
      success : function(data){
        package_data = JSON.parse(data);
        total_fee = parseFloat(package_data[0]['upgrade_fee']) + parseFloat(package_data[0]['service_fee']);
        $('#upgradeFee').val(total_fee.toLocaleString(undefined, { minimumFractionDigits: 2 }));
      }
    });
  });
</script>

            