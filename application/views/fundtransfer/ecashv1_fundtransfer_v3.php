  <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-mobile-phone"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                                   <li>FUND TRANSFER</li>
                                </ul>
                                <h4>ECASH V1 FUND TRANSFER TO V3</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    
                    <div class="contentpanel">
                          <?php if ($result['S'] === 0): ?>
                                  <div class="alert alert-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo $result['M']; ?></div>
                          <?php endif ?>
                          <?php if ($result['S'] == 1): ?>
                                  <div class="alert alert-success"><i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo $result['M']; ?><br />
                                  <?php if ($result['TN'] != ""): ?>
                                       <b>TRACKING NUMBER : <?php echo $result['TN']; ?></b>  
                                  <?php endif ?>
                                  </div>
                          <?php endif ?>
                          <div class="row">
                              <div class="col-xs-12  col-md-5">
                                <div class="row">
                                    <div class='col-xs-12 col-md-12'>
                                             <form name="frmaedfund" action="<?php echo BASE_URL()?>fundtransfer/ecashv1_fundtransfer_v3" method="post" id="frmaedfund">
                                                 
                                                <div class="form-group">
                                                  <label for="input" class="col-sm-4 control-label" id="labelAmount">Amount :</label>
                                                  <div class="col-xs-8 col-md-8">
                                                   <input type="text" class="form-control" name="inputAmount" id="inputAmount" value="" placeholder="AMOUNT" required/>
                                                   </div>
                                                </div>

                                                <div class="form-group">
                                                  <label for="input" class="col-sm-4 control-label" id="labelTpass">Transaction password :</label>
                                                  <div class="col-xs-8 col-md-8">
                                                   <input type="password" class="form-control" name="inputTpass" id="inputTpass" value="" placeholder="TRANSACTION PASSWORD" required/>
                                                   </div>
                                                </div>
                                          
                                                <div class="form-group text-right">
                                                  <div class="col-xs-12 col-md-12">
                                                    <button type="button" class="btn btn-info btn-lg btn_ModalSubmit" data-toggle="modal" data-target="#myModal">Submit</button>
                                                  </div>
                                                </div>

                                              <div id="myModal" class="modal fade" role="dialog">
                                                  <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title"><b>Ecash V1 fund transfer to V3</b></h4>
                                                      </div>
                                                     
                                                      <div class="modal-body">
                                                        <h4>Are you sure you want to proceed ?</h4>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                         <button type="submit" class="btn btn-primary" name="btnSubmit">Proceed</button>
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
