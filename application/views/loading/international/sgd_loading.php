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
                                <h4>SGD LOADING</h4>
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

                                          <form name="frmsgdloading" action="<?php echo BASE_URL()?>international_loading/sgd_loading" method="post" id="frmsgdloading" >
                                                <div class="form-group" >
                                                  <select class="form-control" name="selNetwork" id="selNetwork" required>
                                                      <option value="" disabled selected>SELECT NETWORK</option>
                                                      <option value="1">SINGTEL</option>
                                                      <option value="2">STARHUB</option>
                                                      <option value="3">M1</option>
                                                     
                                                  </select>
                                                 <br />
                                                  <input type="text" class="form-control" name="inputRMobile" placeholder="MOBILE NO" required/>
                                                </div>
                                                  
                                              <div class="form-group">
                                                 <input type="text" class="form-control" name="inputAmount" placeholder="AMOUNT" required/>
                                              </div>
                                              <div class="form-group">
                                                  <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" />
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
                        </div><!-- row -->
                    </div><!-- contentpanel -->
                    
    </div><!-- mainpanel -->            