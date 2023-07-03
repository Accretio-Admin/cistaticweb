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
                                <h4>MYR FUND REQUEST</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    
                    <div class="contentpanel">
                          <?php if ($result['S'] === 0): ?>
                                  <div class="alert alert-danger"><?php echo $result['M']; ?></div>
                          <?php endif ?>

                          <?php if ($result['S'] == 1): ?>
                                  <div class="alert alert-success">
                                  <i class="fa fa-check-circle" aria-hidden="true"></i> <b><?php echo $result['M']; ?></b><br />
                                  <?php if ($result['TN'] != ""): ?>
                                       <b>TRACKING NUMBER : <?php echo $result['TN']; ?></b>  
                                  <?php endif ?>
                                  </div>
                          <?php endif ?>
                          <div class="row">
                              <div class="col-xs-12  col-md-5">
                                <div class="row">
                                    <div class='col-xs-12 col-md-12'>
                                             <form name="frmmyrfund" action="<?php echo BASE_URL()?>fundtransfer/myr_fund" method="post" id="frmmyrfund">
                                                 <div class="form-group" >
                                                    <input type="text" class="form-control" name="inputRegcode" placeholder="REGCODE" id="inputRegcode" required/>
                                                 </div>

                                                <div class="form-group">
                                                   <input type="text" class="form-control" name="inputAmount" placeholder="AMOUNT" required/>
                                                </div>
                                             
                                                <div class="form-group">
                                                   <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required/>
                                                </div>
                                                 <div class="form-group text-right">
                                                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Submit</button>
                                                </div>

                                              <div id="myModal" class="modal fade" role="dialog">
                                                  <div class="modal-dialog modal-md">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <h5 class="modal-title">MYR FUND REQUEST</h5>
                                                      </div>
                                                      <div class="modal-body">
                                                        <div class="alert alert-info">
                                                          <strong>Are you sure you want to proceed ?</strong>
                                                        </div>
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