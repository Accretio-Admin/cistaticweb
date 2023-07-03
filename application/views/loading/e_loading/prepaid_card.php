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
                                <h4>PREPAID CARD</h4>
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
                             

                              <div class="col-xs-12  col-md-5">
                                <div class="row">
                                    <div class='col-xs-12 col-md-12'>

                                          <form name="frmprepaidcard" action="<?php echo BASE_URL()?>E_loading/prepaid_card" method="post" id="frmprepaidcard">
                                                <div class="form-group" >
                                                  <select class="form-control" name="selPrepaidcard" id="selPrepaidcard" required>
                                                      <option value="" disabled selected>SELECT PREPAID CARDS</option>
                                                      <option value="3">GAME CARDS</option>
                                                      <option value="4">CALL CARD</option>
                                                      <option value="5">OTHERS</option>
                                                  </select>
                                                
                                                </div>

                                              <div class="form-group">
                                                <select class="form-control" name="selDenomination" id="selDenomination"  required>
                                                      <option value="" disabled selected>SELECT DENOMINATION</option>
                                                      <?php foreach ($gamecard as $s): ?>
                                                              <option value="<?php echo $s['plancode'] ?>" id="optgamecard"   data-desc="<?php echo $s['description']?>" hidden><?php echo $s['productname'] ?></option>
                                                      <?php endforeach ?>
                                                      <?php foreach ($callcard as $s): ?>
                                                              <option value="<?php echo $s['plancode'] ?>" id="optcallcard"  data-desc="<?php echo $s['description']?>" hidden><?php echo $s['productname'] ?></option>
                                                      <?php endforeach ?>
                                                      <?php foreach ($other as $s): ?>
                                                              <option value="<?php echo $s['plancode'] ?>" id="optother"  data-desc="<?php echo $s['description']?>" hidden><?php echo $s['productname'] ?></option>
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
                                    </div> <!-- col-xs-12 col-md-8-->
                                   
                                </div> <!-- row -->
                              </div> <!--col-xs-6 col-md-6-->
                               <div class="col-xs-4 col-md-4">
                                    <div class="alert alert-info alert-inclusion" style="display:none;word-wrap:break-word;"> </div>
                                </div>
                        </div><!-- row -->
                    </div><!-- contentpanel -->
                    
    </div><!-- mainpanel -->            