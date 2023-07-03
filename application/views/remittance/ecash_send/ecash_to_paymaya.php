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
                  <h4>Ecash to Paymaya</h4>
              </div>
          </div><!-- media -->
      </div><!-- pageheader -->

      <div class="contentpanel" style="padding-top: 0px;"> 
      <?php if ($API['S'] === 0): ?>
       <div class="alert alert-danger"><?php echo $API['M']; ?></div>
      <?php elseif ($API['S'] == 1): ?>
       <div class="alert alert-success">
          <?php echo $API['M']; ?> 
           <br />
             <b>TRACKING NUMBER : <?php echo $API['TN']; ?></b>
       </div>
      <?php endif ?>
          <div class="panel panel-default" style="border: 0px solid;">
              <div class="col-xs-6  col-md-6">
                <div class="row">
                    <div class='col-xs-12 col-md-8'>
                        <form name="frmecashtoloadfund" action="<?php echo BASE_URL() ?>ecash_send/paymaya" method="post" id="frmecashsend">
                            <h5 style="font-weight: bold; color: #4169E1;">TRANSFER DETAILS</h5>
                            <div class="form-group">
                               <input type="text" class="form-control inputAmount" name="inputAccountNumber" placeholder="ACCOUNT NUMBER" required/>
                            </div>
                            <div class="form-group">
                               <input type="text" class="form-control" name="inputAmountTransaction" placeholder="AMOUNT TRANSFER" required/>
                            </div>
                            <div class="form-group">
                               <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required/>
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
          </div>
      </div>           
   </div><!-- mainpanel -->            