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
                                <h4>LOAD WALLET</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    

                    
                    <div class="contentpanel">
        
                          <?php if ($result['S'] === 0): ?>
                                  <div class="alert alert-danger"><?php echo $result['M']; ?></div>
                          <?php endif ?>
                          <?php if ($result['S'] == 1): ?>
                                  <div class="alert alert-success"><?php echo $result['M']; ?><br />
                                  <?php if ($result['TI'] != ""): ?>
                                       <b>TRACKING NUMBER : <?php echo $result['TI']; ?></b>  
                                  <?php endif ?>
                                  </div>
                          <?php endif ?>
                          <div class="row">
                              <div class="col-xs-12  col-md-5">
                                <div class="row">
                                    <div class='col-xs-12 col-md-12'>
                                          <?php if ($process['P'] === 0): ?>
                                             <form name="frmloadwallet" action="<?php echo BASE_URL()?>fundtransfer_loading/load_wallet" method="post" id="frmloadwallet">
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
                                                    <button type="submit" class="btn btn-primary"  name="btnSubmit">Submit</button>
                                                </div>
                                            </form>   
                                          <?php endif ?>
                                          <?php if ($process['P'] == 1): ?>
                                            
                                                <form name="frmloadwallet" action="<?php echo BASE_URL()?>fundtransfer_loading/load_wallet" method="post" id="frmloadwallet">
                                                <div class="form-group">
                                                     <div class="input-group" >
                                                        <span class="input-group-addon" id="basic-addon1">REGCODE&nbsp;&nbsp;&nbsp;</span>
                                                        <input type="text" class="form-control" name="inputRegcode" placeholder="REGCODE" id="inputRegcode" value="<?php echo $input['regcode']; ?>" required readonly />
                                                     </div>
                                                 </div>
                                                 <div class="form-group">
                                                     <div class="input-group" >
                                                        <span class="input-group-addon" id="basic-addon1">NAME&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                        <input type="text" class="form-control" name="inputName" placeholder="REGCODE" id="inputRegcode" value="<?php echo $result['FN']; ?>" required readonly />
                                                     </div>
                                                 </div>
                                                 <div class="form-group">
                                                     <div class="input-group" >
                                                        <span class="input-group-addon" id="basic-addon1">ADDRESS&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                        <input type="text" class="form-control" name="inputAddress" placeholder="REGCODE" id="inputRegcode" value="<?php echo $result['AD']; ?>" required readonly />
                                                     </div>
                                                 </div>
                                                 <div class="form-group">
                                                    <div class="input-group">
                                                       <span class="input-group-addon" id="basic-addon1">AMOUNT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                       <input type="text" class="form-control" name="inputAmount" placeholder="AMOUNT" value="<?php echo $input['amount']; ?>" required readonly/>
                                                    </div>
                                                 </div>
                                                <div class="form-group"> 
                                                    <div class="input-group">
                                                        <span class="input-group-addon" id="basic-addon1">PASSWORD</span>
                                                        <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" value="" required />
                                                    </div>
                                                 </div>
                                                 <div class="form-group text-right">
                                                    Are you sure you want to confirm? &nbsp;<button type="submit" class="btn btn-primary"  name="btnConfirm">Confirm</button>
                                                </div>
                                            </form>    

                                          <?php endif ?>
                                    </div> <!-- col-xs-12 col-md-8-->
                                </div> <!-- row -->

                              </div> <!--col-xs-6 col-md-6-->
                        </div><!-- row -->
                    </div><!-- contentpanel -->
                    
    </div><!-- mainpanel -->            