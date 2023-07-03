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
                                <h4>FUND REQUEST</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    

                    
                    <div class="contentpanel">
                        <?php if ($result['S']===0): ?>
                              <div class="alert alert-danger"><?php echo $result['M']; ?></div>
                        <?php endif ?>
                        <?php if ($result['S']==1): ?>
                              <div class="alert alert-success">
                                  <?php echo $result['M']; ?><br />
                                  <b>TRACKING NUMBER : <?php echo $result['TN']; ?></b>
                              </div>
                        <?php endif ?>
                          <div class="row">
                              <div class="col-xs-12  col-md-8">
                                <div class="row">
                                    <div class='col-xs-12 col-md-12'>

                                          <form name="frmfundtransfer" action="<?php echo BASE_URL()?>fundtransfer_loading/fund_transfer" method="post" id="frmfundtransfer">
                                              <div class="row">
                                                  <div class="col-xs-12 col-md-6">
                                                      <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                             <div class="form-group" >
                                                                <input type="text" class="form-control" name="inputRegcode" value="<?php echo $user['R']?>" readonly placeholder="REGCODE" required/>
                                                              </div>
                                                         </div>
                                                      </div>
                                                      <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                             <div class="form-group">
                                                               <input type="text" class="form-control" name="inputMobile" placeholder="MOBILE NO" required/>
                                                            </div>
                                                         </div>
                                                      </div>
                                                       <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                             <div class="form-group">
                                                              <select name="selFund" id="selFund" class="form-control" required>
                                                                    <option value="" disabled selected>FUND TYPE</option>
                                                                    <option value="ECASH">ECASH</option>
                                                                    <option value="LOADWALLET">LOADWALLET</option>
                                                              </select>
                                                            </div>
                                                         </div>
                                                      </div> 
                                                      <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                             <div class="form-group">
                                                                 <select  name="selDeposit" id ="selDeposit" class="form-control" required>
                                                                      <option value="" disabled selected>DEPOSIT TYPE</option>
                                                                       <option value="Bank Deposit">Bank Deposit</option>
                                                                      <option value="Online Deposit">Online Deposit</option>
                                                                      <option value="SmartMoney">SmartMoney</option>

                                                                 </select>
                                                            </div>
                                                         </div>
                                                      </div> 
                                                      <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                             <div class="form-group">
                                                                <input type="text" class="form-control" name="inputBank" id="inputBank" placeholder="INSTITUTION - BANK NAME" required />
                                                            </div>
                                                         </div>
                                                      </div> 

                                                  </div>

                                                  <div class="col-xs-12 col-md-6">
                                                      <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                             
                                                         </div>
                                                      </div> 
                                                      
                                                      <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                              <div class="form-group">
                                                                  <input type="text" class="form-control" name="inputBranchName" id="inputBranchName" placeholder="BRANCH NAME" required />
                                                              </div>
                                                         </div>
                                                      </div> 
                                                      <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                             <div class="form-group">
                                                                <input type="text" class="form-control" name="inputAmount" placeholder="AMOUNT" required />
                                                            </div>
                                                         </div>
                                                      </div> 
                                                      <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                              <div class="form-group">
                                                                <input type="text" class="form-control" name="inputRef" placeholder = "REFERENCE NUMBER" required />
                                                            </div>
                                                         </div>
                                                      </div> 
                                                      <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                          <div class="form-group">
                                                              <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1"><b>DATE/TIME</b></span>
                                                                <input type="text" class="form-control" name="inputDate" id="datetimepicker6"  readonly />
                                                              </div>
                                                          </div>      
                                                         </div>
                                                      </div> 
                                                     <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                              <div class="form-group">
                                                             <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required/>
                                                          </div>
                                                         </div>
                                                      </div> 
                                                       

                                                  </div>
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
                                              
                                          </form>
                                    </div> <!-- col-xs-12 col-md-8-->
                                </div> <!-- row -->
                              </div> <!--col-xs-6 col-md-6-->
                        </div><!-- row -->
                    </div><!-- contentpanel -->
                    
    </div><!-- mainpanel -->            