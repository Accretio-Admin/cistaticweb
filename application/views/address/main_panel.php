<div class="mainpanel">
  <div class="pageheader">
    <div class="media">
        <div class="pageicon pull-left">
            <i class="fa fa-map-marker"></i>
        </div>
        <div class="media-body">
            <ul class="breadcrumb">
                <li><a href="#"><i class="fa fa-map-marker"></i></a></li>
                <li>USER INFORMATION</li>
            </ul>
            <h4>USER INFORMATION</h4>
        </div>
    </div><!-- media -->
  </div><!-- pageheader -->
              
  <div class="contentpanel"  style="background:white">
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="panel panel-default" style="padding:0px!important">
           
          <!-- <div class="panel-heading" style="background-color:#666666;color:#FFFFFF">Address Information</div> -->
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#address">Address Information</a></li>
            <li><a data-toggle="tab" href="#kycinfo">KYC Information</a></li>
          </ul>

            <div class="tab-content">
              <div id="address" class="tab-pane fade in active">

                        <div id="address" class="panel-body">
                        <div class="col-lg-12"> 
                          <div class="row">
                            <div style="display:none; text-align: center;" id="alertDynammic"></div>
                            <?php if ($API['S'] === 0): ?>
                              <div class="alert alert-danger"><b><?php echo $API['M'] ?></b></div>
                            <?php endif ?>

                            <?php //if ($API['S'] == 1): ?>
                              <!-- <div class="alert alert-success">
                                <i class="fa fa-check-circle-o"></i> <b><?php //echo $API['M'] ?>!</b>
                              </div> -->
                            <?php //endif ?>

                            <?php 
                              $msg = $this->session->flashdata('msg');
                              if ($msg['S']==1): ?>
                                <div class="alert alert-success">
                                    <i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo $msg['M']; ?>!
                                </div>
                            <?php endif ?>

                          </div>
                        </div>

                        <form  id="myFormAddress" name="myFormAddress" action="<?php echo BASE_URL() ?>User_information" method="post" class="frmclass">
                            <div class="row setup-content" id="step-1">
                              <div class="col-xs-12">
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <h4 class="text-primary"><b> Present Address </b> </h4>
                                          <div class="row">
                                              <div class="col-md-12">
                                                  <label class="control-label">House #/Lot #/ Street/Subdivision/District :</label>
                                                  <?php //var_dump($result);?>
                                                  <input id="paddress" oncopy = "return false" onpaste="return false" maxlength="100" type="text" required="required" name="street" class="form-control street" value="<?php echo $result->DATA->presentStreet;?>" placeholder="Enter House #/Lot #/ Street/Subdivision/District" />
                                              </div>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="row">
                                              <div class="col-md-12">
                                                  <label class="control-label"> Barangay :</label>
                                                  <input id="pbarangay" oncopy = "return false" onpaste="return false" maxlength="100" type="text" required="required" name="barangay" class="form-control barangay" value="<?php echo $result->DATA->presentBrgy;?>" placeholder="Enter Barangay" />
                                              </div>
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <div class="row">
                                            <div class="col-md-4 countryclass">
                                                  <label class="control-label">Country :</label>
                                                  <!-- <select class="selectpicker form-control country" data-live-search="true" name="country" required> -->
                                                  <select class="form-control country" name="country" required>
                                                      <option value="" disabled selected>---Select Country---</option>
                                                      <?php /**$CountryInfo = $this->session->userdata('getCountryInfo');**/ 
                                                      $CountryInfo = $this->user['Country']; ?>
                                                      <?php foreach ($CountryInfo as $row): ?>
                                                        <!-- <option value="<?php echo $row->country ?>" <?php echo $row->country == $_POST['country']?'selected':'';?>><?php echo $row->country ?></option> -->
                                                        <option value="<?php echo $row['country'] ?>" <?php echo $row['country'] == $result->DATA->presentCountry?'selected':'';?>><?php echo $row['country'] ?></option>
                                                      <?php endforeach ?>
                                                  </select>  
                                              </div>
                                              <div class="col-md-4 provclass">
                                                  <label class="control-label">Province :</label>
                                                  <!-- <select class="form-control province" name="province" required> -->
                                                      <!-- <option value="" disabled selected>---Select Province---</option> -->
                                                      <?php 
                                                        //$ProvinceInfo = $this->session->userdata('getProvinceInfo');
                                                        $ProvinceInfo = $this->user['ProvInfo'];
                                                      ?>
                                                      <?php foreach ($ProvinceInfo as $row): ?>
                                                        <!-- <option value="<?php echo $row['description'] ?>" <?php echo $row['description'] == $result->DATA->presentProvince?'selected':'';?>><?php echo $row['description'] ?></option> -->
                                                      <?php endforeach ?>
                                                  <!-- </select> -->
                                                  <input id="pprovince" oncopy = "return false" onpaste="return false" class="form-control province" value="<?php echo $result->DATA->presentProvince ?>" name="province" required/>
                                              </div>
                                              <div class="col-md-4 cityclass">
                                                  <label class="control-label">Municipality/City :</label>
                                                  <!-- <select class="form-control city" name="city" required> -->
                                                      <!-- <option value="" disabled selected>---Select Municipality/City---</option> -->
                                                      <?php 
                                                        // $CityInfo = $this->session->userdata('getCityInfo');
                                                        $CityInfo = $this->user['CityInfo'];
                                                      ?>
                                                      <?php foreach ($CityInfo as $row): ?>
                                                        <!-- <option value="<?php echo $row['description'] ?>" <?php echo $row['description'] == $result->DATA->presentCity?'selected':'';?>><?php echo $row['description'] ?></option> -->
                                                      <?php endforeach ?>
                                                  <!-- </select>   -->
                                                  <input id="pcity" oncopy = "return false" onpaste="return false" class="form-control city" value="<?php echo $result->DATA->presentCity ?>" name="city" required/>
                                              </div>
                                          </div>
                                      </div>

                                      <hr/>

                                      <div class="form-group">
                                          <h4 class="text-primary pull-left" style="margin-right: 10px;"><b> Permanent Address </b> </h4>
                                      </div>

                                      <div class="form-group">
                                          <div class="row">
                                              <div class="col-md-12">
                                                  <label class="control-label">House #/Lot #/ Street/Subdivision/District :</label>
                                                  <input oncopy = "return false" onpaste="return false" maxlength="100" type="text" required="required" name="prstreet" class="form-control prstreet" value="<?php echo $result->DATA->permanentStreet;?>" placeholder="Enter House #/Lot #/ Street/Subdivision/District"  />
                                              </div>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="row">
                                              <div class="col-md-12">
                                                  <label class="control-label"> Barangay :</label>
                                                  <input oncopy = "return false" onpaste="return false" maxlength="100" type="text" required="required" name="prbarangay" class="form-control prbarangay" value="<?php echo $result->DATA->permanentBrgy;?>" placeholder="Enter Barangay" />
                                              </div>
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <div class="row">
                                            <div class="col-md-4 prcountryclass">
                                                    <label class="control-label">Country :</label>
                                                    <select class="prcountry form-control" name="prcountry" required>
                                                        <option value="" disabled selected>---Select Country---</option>
                                                        <?php 
                                                          // $CountryInfo = $this->session->userdata('getCountryInfo');
                                                          $CountryInfo = $this->user['Country'];
                                                        ?>
                                                        <?php foreach ($CountryInfo as $row): ?>
                                                          <option value="<?php echo $row['country'] ?>" <?php echo $row['country'] == $result->DATA->permanentCountry?'selected':'';?>><?php echo $row['country'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>  
                                                </div>
                                              <div class="col-md-4 prprovclass">
                                                  <label class="control-label">Province :</label>
                                                  <!-- <select class="prprovince form-control" name="prprovince" id="prprovince" required> -->
                                                      <!-- <option value="" disabled selected>---Select Province---</option> -->
                                                      <?php 
                                                        //$ProvinceInfo = $this->session->userdata('getProvinceInfo');
                                                        $ProvinceInfo = $this->user['ProvInfo'];
                                                      ?>
                                                      <?php foreach ($ProvinceInfo as $row): ?>
                                                        <!-- <option value="<?php echo $row['description'] ?>" <?php echo $row['description'] == $result->DATA->permanentProvince?'selected':'';?>><?php echo $row['description'] ?></option> -->
                                                      <?php endforeach ?>
                                                  <!-- </select>   -->
                                                  <input oncopy = "return false" onpaste="return false" class="prprovince form-control" name="prprovince" value="<?php echo $result->DATA->permanentProvince ?>" id="prprovince" required/>
                                              </div>
                                              <div class="col-md-4 prcityclass">
                                                  <label class="control-label">Municipality/City :</label>
                                                  <!-- <select class="prcity form-control" name="prcity" required> -->
                                                      <!-- <option value="" disabled selected>---Select Municipality/City---</option> -->
                                                      <?php 
                                                        // $CityInfo = $this->session->userdata('getCityInfo');
                                                        $CityInfo = $this->user['CityInfo'];
                                                      ?>
                                                      <?php foreach ($CityInfo as $row): ?>
                                                        <!-- <option value="<?php echo $row['description'] ?>" <?php echo $row['description'] == $result->DATA->permanentCity?'selected':'';?>><?php echo $row['description'] ?></option> -->
                                                      <?php endforeach ?>
                                                  <!-- </select>   -->
                                                  <input oncopy = "return false" onpaste="return false" class="prcity form-control" value="<?php echo $result->DATA->permanentCity ?>" name="prcity" required>
                                              </div>
                                          </div>
                                      </div>

                                      <hr/>

                                    <div class="form-group">

                                      <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addressModal">
                                        Update
                                      </button>

                                      <!-- Modal -->
                                      <div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Update Address Information</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              Are you sure you want to update your Address Information?
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                              <button class="btn btn-primary btn-md" name="btnSubmit" type="submit"> Proceed </button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      
                                    </div>

                                  </div>
                              </div>
                            </div>
                                                
                        </form>

                    </div>

              </div>

              <div id="kycinfo" class="tab-pane fade">

                <div class="alert alert-info">
                  <strong>Please be reminded upon update of your Government Issued ID and "Selfie with Government Issued ID", your status will change to "PENDING". Please wait within an hour until approval is granted by our Technical Support Team.</strong>
                </div>


                <div class="form-group" >
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 22px; font-weight: bold;">REGCODE:</span>
                      <input type="text" class="form-control" value="<?php echo $kyc->S == 3 ? $kyc->DATA->regcode : '' ?>" readonly>
                    </div>
                </div>
                <div class="form-group" >
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 27px; font-weight: bold;">VALID ID:</span>
                      <a class="form-control" href="<?php echo $kyc->S == 3 ?  $kyc->DATA->id_attachment : '' ?>" target="_blank">APPROVED ID</a>
                    </div>
                </div>
                <div class="form-group" >
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1" style="padding-right: 10px; font-weight: bold;">ID w/ Selfie:</span>
                      <a class="form-control" href="<?php echo $kyc->S == 3 ?  $kyc->DATA->selfie_attachment : '' ?>" target="_blank">APPROVED SELFIE with ID</a>
                  </div>
                </div>
                <button class="btn btn-primary" onClick="modal(1)">Update</button>

                
                <div class="form-group" >
                  <div class="alert alert-info">
                    <strong>Kindly upload your selfie video <a href="https://unified.ph/kyc" style="border-bottom:3px solid red;">here.</a></strong>
                  </div>
                </div>
                
              </div>
            </div>

        </div>

      </div>

    </div><!-- row -->
  </div><!-- contentpanel -->
</div><!-- mainpanel -->

<script src="<?php echo BASE_URL()?>assets/js/kyc.js"></script> 
<script>
   $('#paddress').bind('keydown', function(e){
      if((e.shiftKey && e.keyCode == 190) || (e.shiftKey && e.keyCode == 188) || (e.shiftKey && e.keyCode == 222) || (e.shiftKey && e.keyCode == 53)) { 
        e.preventDefault();
      }
    });
    $('#pbarangay').bind('keydown', function(e){
      if((e.shiftKey && e.keyCode == 190) || (e.shiftKey && e.keyCode == 188) || (e.shiftKey && e.keyCode == 222) || (e.shiftKey && e.keyCode == 53)) { 
        e.preventDefault();
      }
    });
    $('#pprovince').bind('keydown', function(e){
      if((e.shiftKey && e.keyCode == 190) || (e.shiftKey && e.keyCode == 188) || (e.shiftKey && e.keyCode == 222) || (e.shiftKey && e.keyCode == 53)) { 
        e.preventDefault();
      }
    });
    $('#pcity').bind('keydown', function(e){
      if((e.shiftKey && e.keyCode == 190) || (e.shiftKey && e.keyCode == 188) || (e.shiftKey && e.keyCode == 222) || (e.shiftKey && e.keyCode == 53)) { 
        e.preventDefault();
      }
    });
    $('.prstreet').bind('keydown', function(e){
      if((e.shiftKey && e.keyCode == 190) || (e.shiftKey && e.keyCode == 188) || (e.shiftKey && e.keyCode == 222) || (e.shiftKey && e.keyCode == 53)) { 
        e.preventDefault();
      }
    });
    $('.prbarangay').bind('keydown', function(e){
      if((e.shiftKey && e.keyCode == 190) || (e.shiftKey && e.keyCode == 188) || (e.shiftKey && e.keyCode == 222) || (e.shiftKey && e.keyCode == 53)) { 
        e.preventDefault();
      }
    });
    $('.prprovince').bind('keydown', function(e){
      if((e.shiftKey && e.keyCode == 190) || (e.shiftKey && e.keyCode == 188) || (e.shiftKey && e.keyCode == 222) || (e.shiftKey && e.keyCode == 53)) { 
        e.preventDefault();
        console.log("E",e)
      }
    });
    $('.prcity').bind('keydown', function(e){
      if((e.shiftKey && e.keyCode == 190) || (e.shiftKey && e.keyCode == 188) || (e.shiftKey && e.keyCode == 222) || (e.shiftKey && e.keyCode == 53)) { 
        e.preventDefault();
      }
    });
</script>
                       


