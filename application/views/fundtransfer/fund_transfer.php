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
                  

                   
                      <div class="row1">
                        <div class="col-md-8 alert alert-info" >
                         
                          <p><b>Note :</b></p>
                          <p>if you made a mistake in the details of your fund request,
                          simply submit another fund request with the correct details 
                          and put an X at the beginning of the deposit reference number</p>

                           <p><b>Example:</b></p>
                          <p>-BDO|4000.00|338IRCD397|2017/01/04</p>
                          <p>-BDO|4000.00|x338IRCD397|2017/01/04</p>
                     
                       </div>
                      </div>

                      <div class="row">
                        <div class="col-md-8" >

                          <?php if ($result['S']===0): ?>
                                <div class="alert alert-danger"><?php echo $result['M']; ?></div>
                          <?php endif ?>
                        
                          <?php 
                          $msg = $this->session->flashdata('msg');
                          if ($msg['S']==1): ?>
                            <div class="alert alert-success">
                                <?php echo $msg['M']; ?><br />
                                <b>TRACKING NUMBER : <?php echo $msg['TN']; ?></b>
                            </div>
                          <?php endif ?>

                          <?php 
                          $msgsuccess = $this->session->flashdata('msgsuccess');
                            if ($msgsuccess['success']==1): ?>
                            <div class="alert alert-success"><b><?php echo $msgsuccess['M']; ?></b></div>
                          <?php endif ?>

                          <?php 
                            $msgsuccess = $this->session->flashdata('msgsuccess');
                            if ($msgsuccess['success']==2): ?>
                            <div class="alert alert-danger"><b><?php echo $msgsuccess['M']; ?></b></div>
                          <?php endif ?>

                        </div>
                      </div>
                          <div class="row">
                              <div class="col-xs-12  col-md-8">
                                <div class="row">
                                    <div class='col-xs-12 col-md-12'>    
                                      <h2>Step 1: Upload Image</h2>
                                    </div>
                                    <div class='col-xs-12 col-md-12'>    
                                          <form name="frmfundtransfer" action="<?php echo BASE_URL()?>Fundtransfer/check_upload" method="post" id="frmfundtransfer" enctype="multipart/form-data" >
                                              <div class="row">
                                                          <div class="col-xs-12 col-md-6">
                                                              <div class="form-group">
                                                        
                                                               <input type="file" class="form-control" name="file" title="No File Found"   tabindex="1"  <?php if($this->session->has_userdata('image_pubid')){echo "disabled";}else{echo "required='required'";}?>"/>
                                                               <small><font color="red">*Note : (JPEG,PNG,JPG File type only)</font></small>
                                                             
                                                              </div>
                                                               <div class="form-group text-right">
                                                                 <?php if($this->session->has_userdata('image_pubid')): ?>
                                                                  <button type="submit" class="btn btn-danger" tabindex="10"  name="btnReset" >Reset</button>
                                                                  <?php endif ?>
                                                                <button type="submit" class="btn btn-info" tabindex="10"  name="btnUpload" >Upload</button>
                                                              </div>
                                                          </div>

                                                          <?php if($this->session->has_userdata('image_pubid')): ?>
                                                                  
                                                            <span class="col-xs-12 col-md-6 alert alert-info"><b>Successfully Uploaded!</br>Please proceed to STEP 2 below.</b></br> <i><small><font color="red">*</font></small> If you want to replace the image, kindly upload again.</i></span>  
                                                         
                                                          <?php endif ?>
                                                </div>
                                                </form>
                                                <form name="frmfundtransfer" action="<?php echo BASE_URL()?>Fundtransfer/fund_transfer" method="post" id="frmfundtransfer" enctype="multipart/form-data">
                                              <div class="row">
                                                  <div class='col-xs-12 col-md-12'>    
                                                    <h2>Step 2: Input Required Fields</h2>
                                                  </div>
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
                                                               <input type="text" class="form-control" name="inputMobile" placeholder="MOBILE NO" tabindex="2"  required <?php if(!$this->session->has_userdata('image_pubid')){echo "disabled";}?> value="<?php echo $_POST['inputMobile']?>"/>
                                                            </div>
                                                         </div>
                                                      </div>
                                                       <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                             <div class="form-group">
                                                              <select name="selFund" id="selFund" class="form-control" required <?php if(!$this->session->has_userdata('image_pubid')){echo "disabled";}?>>
                                                                    <option value="" disabled selected>FUND TYPE</option>
                                                                    <option value="ECASH" <?php if($_POST['selFund'] == "ECASH") echo "selected"; ?>>ECASH</option>
                                                                    <?php 
                                                                    if($user['L'] == 5)
                                                                    {
                                                                      ?>

                                                                    <option value="LOADWALLET" <?php if($_POST['selFund'] == "LOADWALLET") echo "selected"; ?>>LOADWALLET <?php echo $user['UL']?></option>
                                                                    <?php
                                                                    }
                                                                    ?>

                                                                    ?>
                                                              </select>
                                                            </div>
                                                         </div>
                                                      </div> 
                                                      <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                             <div class="form-group">
                                                                 <select  name="selDeposit" id ="selDeposit" class="form-control" required tabindex="3" <?php if(!$this->session->has_userdata('image_pubid')){echo "disabled";}?>>
                                                                      <option value="" disabled selected>DEPOSIT TYPE</option>
                                                                       <option value="Bank Deposit" <?php if($_POST['selDeposit'] == "Bank Deposit") echo "selected"; ?>>Bank Deposit</option>
                              <!--                                         <option value="Online Deposit" <?php if($_POST['selDeposit'] == "Online Deposit") echo "selected"; ?>>Online Deposit</option>
                                                                      <option value="SmartMoney" <?php if($_POST['selDeposit'] == "SmartMoney") echo "selected"; ?>>SmartMoney</option> -->

                                                                 </select>
                                                            </div>
                                                         </div>
                                                      </div> 
                                                      <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                             <div class="form-group">
                                                                <!-- <input type="text" class="form-control" name="inputBank" id="inputBank" placeholder="INSTITUTION - BANK NAME" required tabindex="4" <?php if(!$this->session->has_userdata('image_pubid')){echo "disabled";}?> value="<?php echo $_POST['inputBank']?>"/> -->
                                                                 <select  name="inputBank" id ="inputBank" class="form-control" required tabindex="3" <?php if(!$this->session->has_userdata('image_pubid')){echo "disabled";}?>>
                                                                      <option value="" disabled selected>INSTITUTION - BANK NAME</option>
                                                                       <option value="BDO" <?php if($_POST['inputBank'] == "BDO") echo "selected"; ?>>BDO</option>
                                                                      <option value="UCPB" <?php if($_POST['inputBank'] == "UCPB") echo "selected"; ?>>UCPB</option>
                                                                      <option value="SECURITY BANK" <?php if($_POST['inputBank'] == "SECURITY BANK") echo "selected"; ?>>SECURITY BANK</option>

                                                                 </select>
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
                                                                  <input type="text" class="form-control" name="inputBranchName" id="inputBranchName" placeholder="BRANCH NAME" required tabindex="5" <?php if(!$this->session->has_userdata('image_pubid')){echo "disabled";}?> value="<?php echo $_POST['inputBranchName']?>"/>
                                                              </div>
                                                         </div>
                                                      </div> 
                                                      <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                             <div class="form-group">
                                                                <input type="text" class="form-control" id="inputAmount" name="inputAmount" placeholder="AMOUNT" required tabindex="6tabindex="1" " <?php if(!$this->session->has_userdata('image_pubid')){echo "disabled";}?> value="<?php echo $_POST['inputAmount']?>" />
                                                            	<small><font color="red">*Note : (00.00) Ex: 1000.00</font></small>
                                                            </div>
                                                         </div>
                                                      </div> 
                                                      <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                              <div class="form-group">
                                                                <input type="text" class="form-control" name="inputRef" placeholder = "REFERENCE NUMBER" required tabindex="7" <?php if(!$this->session->has_userdata('image_pubid')){echo "disabled";}?> value="<?php echo $_POST['inputRef']?>" />
                                                            </div>
                                                         </div>
                                                      </div> 
                                                      <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                          <div class="form-group">
                                                              <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon1"><b>DATE/TIME</b></span>
                                                                <input type="text" autocomplete="off" class="form-control" name="inputDate" id="datetimepicker6" tabindex="8" <?php if(!$this->session->has_userdata('image_pubid')){echo "disabled";}?> required onkeydown="return false;" value="<?php echo $_POST['inputDate']?>"/>
                                                              </div>
                                                          </div>      
                                                         </div>
                                                      </div> 
                                                     <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                              <div class="form-group">
                                                             <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required tabindex="9" <?php if(!$this->session->has_userdata('image_pubid')){echo "disabled";}?>/>
                                                          </div>
                                                         </div>
                                                      </div> 
                                                       <div class="row">
                                                        <!-- store the public_id of the upload image -->
                                                        <div class="col-xs-12 col-md-12">
                                                              <div class="form-group">
                                                             <input type="hidden" class="form-control" name="image_public_id" placeholder="IMAGE PUBLIC ID" required tabindex="9" value="<?php echo $this->session->userdata('image_pubid'); ?>"/>
                                                          </div>
                                                         </div>
                                                          <div class="col-xs-12 col-md-12">
                                                              <div class="form-group">
                                                             <input type="hidden" class="form-control" name="image_URL" placeholder="IMAGE URL" required tabindex="9" value="<?php echo $this->session->userdata('image_url'); ?> "/>
                                                          </div>
                                                         </div>
                                                      </div> 
                                                       

                                                  </div>
                                              </div>   

                                              <div class="form-group text-right">
                                                <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal" tabindex="10" <?php if(!$this->session->has_userdata('image_pubid')){echo "disabled";}?>>Submit</button>
                                                  
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
                                                         <button type="submit" class="btn btn-primary"  name="btnSubmit" id="btnSubmitFR" >Proceed</button>
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