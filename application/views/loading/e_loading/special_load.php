  <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-mobile-phone"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                                   <li>LOADING</li>
                                </ul>
                                <h4>SPECIAL LOAD</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    

                    
                    <div class="contentpanel">
                    <?php if ($result['S'] === 0): ?>
                        <div class="alert alert-danger"><?php echo $result['M']; ?></div>
                    <?php endif ?>
                      <?php if ($result['S'] == 1): ?>
                        <div class="alert alert-success"><?php echo $result['M']; ?></div>
                    <?php endif ?>

                          <div class="row">
                            <div class="col-xs-4 col-md-2">
                            
                                  <?php foreach ($API as $i): ?>
                                    <?php if ($i['telco'] != 'SMARTMONEY_SEND'): ?>
                                      <div class="row">
                                      <div class="col-xs-6 col-md-4">
                                         <br />
                                          <big><?php echo $i['telco']?></big>
                                      </div>
                                      <div class="col-xs-6 col-md-8">
                                       <br />
                                        <?php if ($i['status'] == 0): ?>
                                           <span class="badge badge-success">Online</span>
                                        <?php endif ?>
                                         <?php if ($i['status'] == 1): ?>
                                           <span class="badge badge-error">Offline</span>
                                        <?php endif ?>
                                        <?php if ($i['status'] == 2): ?>
                                           <span class="badge badge-warning">Delayed</span>
                                        <?php endif ?>
                                      </div>
                                  </div>
                                  <?php endif ?>
                                  <?php endforeach ?>
                              </div>

                              <div class="col-xs-6  col-md-5">
                                <div class="row">
                                    <div class='col-xs-10 col-md-12'>

                                          <form name="frmregularload" action="<?php echo BASE_URL()?>E_loading/special_load" method="post" id="frmspecialloading" >
                                                <div class="form-group" >
                                                  <select class="form-control" name="selNetwork" id="selNetwork" required>
                                                      <option value="" disabled selected>SELECT NETWORK</option>
                                                      <option value="1">SMART</option>
                                                      <option value="2">GLOBE</option>
                                                      <option value="3">SUN</option>
                                                      <option value="4">DITO</option>
                                                      <option value="5">PLDT</option>
                                                  </select>
                                                </div>

                                           
                                              <div class="form-group" >
                                                <select class="form-control" name="selDenomination" id="selDenomination"  required>
                                                      <option value="" disabled selected>SELECT DENOMINATION</option>
                                                      <?php foreach ($smart as $s): ?>
                                                              <option value="<?php echo $s['plancode'] ?>" id="optSmart" data-id="<?php echo $s['form_type'].'|'.$s['plancode']?>" data-desc="<?php echo $s['inclusion']?>"  hidden><?php echo $s['description'] ?></option>
                                                      <?php endforeach ?>
                                                      <?php foreach ($globe as $s): ?>
                                                              <option value="<?php echo $s['plancode'] ?>" id="optGlobe" data-id="<?php echo $s['form_type'].'|'.$s['plancode']?>"  data-desc="<?php echo $s['inclusion']?>" hidden><?php echo $s['description'] ?></option>
                                                      <?php endforeach ?>
                                                      <?php foreach ($sun as $s): ?>
                                                              <option value="<?php echo $s['plancode'] ?>" id="optSun" data-id="<?php echo $s['form_type'].'|'.$s['plancode']?>"  data-desc="<?php echo $s['inclusion']?>" hidden><?php echo $s['description'] ?></option>
                                                      <?php endforeach ?>
                                                      <?php foreach ($dito as $s): ?>
                                                              <option value="<?php echo $s['plancode'] ?>" id="optDito" data-id="<?php echo $s['form_type'].'|'.$s['plancode']?>"  data-desc="<?php echo $s['inclusion']?>" hidden><?php echo $s['description'] ?></option>
                                                      <?php endforeach ?>
                                                      <?php foreach ($pldt as $s): ?>
                                                              <option value="<?php echo $s['plancode'] ?>" id="optPldt" data-id="<?php echo $s['form_type'].'|'.$s['plancode']?>"  data-desc="<?php echo $s['inclusion']?>" hidden><?php echo $s['description'] ?></option>
                                                      <?php endforeach ?>
                                                      
                                                </select>
                                                  <br />
                                                  <input type="text" class="form-control" name="inputRMobile" placeholder="MOBILE NO" required/>
                                              </div>
                                              <div class="form-group">
                                                 <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required/>
                                              </div>

                                              <div class="form-group text-center">
                                                  <h4>What is <?php echo $captcha['code1']  ?> + <?php echo $captcha['code2']  ?> ?</h4>
                                              </div>
                                              <div class="form-group">
                                                 <input type="number" class="form-control" name="inputCaptcha" placeholder="CAPTCHA CODE" required/>
                                              </div>
                                               <div class="form-group text-right">
                                                 
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
                                                         <button type="submit" class="btn btn-primary"  name="btnSubmit">Proceed</button>
                                                      </div>
                                                    </div>

                                                  </div>
                                                </div>
                                          </form>
                                    </div> <!-- col-xs-8 col-md-8-->
                                    
                                </div> <!-- row -->
                              </div> <!--col-xs-6 col-md-6-->
                              <div class="col-xs-5 col-md-5">
                                    <div class="alert alert-info alert-inclusion" style="display:none;word-wrap:break-word;"> </div>
                                    <div class="alert alert-info alert-biller" style="display:none;word-wrap:break-word;"> </div>
                            </div>
                        </div><!-- row -->
                    </div><!-- contentpanel -->
                    
    </div><!-- mainpanel -->            
     