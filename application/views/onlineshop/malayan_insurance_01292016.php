        <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-home"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>ONLINE SHOP</li>
                                </ul>
                                <h4>E-INSURANCE</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    

                    
                    <div class="contentpanel">
                        <div class="row row-stat">
                            <div class="col-sm-12 col-md-12">
                                <div class="tab-content nopadding noborder">
                                    <div class="tab-pane active" id="activities">
                                        <div class="follower-list">  
                                            <div class="col-sm-12">
                                                <div class="row">

                                                    <div class="col-xs-8 col-md-8">
                                                    <?php if ($result['S'] === 0 || $result['S'] === '0' ): ?>
                                                        <div class="alert alert-danger"><?php echo $result['M'] ?></div>
                                                    <?php elseif ($result['S'] === 1 || $result['S'] === '1' ): ?>
                                                        <div class="alert alert-success"><b><?php echo $result['M'].' TRANSACTION NO: <a href="'.$result['RL'].'" target="_blank"/></a>'.$result['TN'] ?></b></div>
                                                    <?php endif ?>
                                                        <div class="row">
                                                                <?php if (is_null($process)): ?>
                                                                    <div class="col-xs-6 col-md-5">
                                                                      <form method="post" action="<?php echo base_url('/Online_shop/malayan_insurance') ?>" class="transaction_form" id="frmMalayan">
                                                                        <div class="form-group">
                                                                          <select class="form-control" id="selInsurance" name="policynum" required>
                                                                                <option value="" disabled selected>Please Choose your Policy</option>
                                                                                <option value="1" data-desc = "1">Policy 1</option>
                                                                                <option value="2" data-desc = "2">Policy 2</option>
                                                                                <option value="3" data-desc = "3">Policy 3</option>
                                                                                <option value="4" data-desc = "4">Policy 4</option>
                                                                          </select> 
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" name="inputFname" placeholder="FirstName" required />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" name="inputMname" placeholder="M.I" required  />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" name="inputLname" placeholder="LastName" required  />
                                                                        </div>
                                                                        <hr />
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" name="inputbFname" placeholder="Benificiary FirstName" required />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" name="inputbMname" placeholder="Benificiary M.I" required  />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" name="inputbLname" placeholder="Benificiary LastName" required  />
                                                                        </div>
                                                                        <hr />
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="datetimepicker" name="inputBdate" placeholder="Birthdate" required readonly />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" name="inputOccup" placeholder="Occupation" required  />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="email" class="form-control" name="inputEmail" placeholder="Email Address" required  />
                                                                        </div>
                                                                        <div class="form-group text-right">
                                                                            <button type="submit" class="btn btn-primary" name="btn_submit_malayan">Continue <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span></button>
                                                                        </div>
                                                                      </form>
                                                                    </div>

                                                                <?php elseif ($process == 1): ?>
                                                                    <div class="col-xs-6 col-md-7">
                                                                    <form method="post" action="<?php echo base_url('/Online_shop/malayan_insurance') ?>" id="frmMalayan">
                                                                        <div class="form-group">
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" id="basic-addon1" style="padding-right: 89px;">FirstName: &nbsp;</span>
                                                                                <input type="text" class="form-control" name="inputFname" value="<?php echo $info['fname'] ?>" readonly />
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" id="basic-addon1" style="padding-right: 76px;">Middle Initial: &nbsp;</span>
                                                                                <input type="text" class="form-control" name="inputMname" value="<?php echo $info['mname'] ?>" readonly  />
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" id="basic-addon1" style="padding-right: 90px;">LastName: &nbsp;</span>
                                                                                <input type="text" class="form-control" name="inputLname" value="<?php echo $info['lname'] ?>" readonly  />
                                                                            </div>
                                                                        </div>
                                                                        <hr />
                                                                        <div class="form-group">
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" id="basic-addon1" style="padding-right: 19px;">Benificiary FirstName: &nbsp;</span>
                                                                                <input type="text" class="form-control" name="inputbFname" value="<?php echo $info['bfname'] ?>" readonly />
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" id="basic-addon1" style="padding-right: 65px;">Benificiary M.I: &nbsp;</span>
                                                                                <input type="text" class="form-control" name="inputbMname" value="<?php echo $info['bmname'] ?>" readonly  />
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" id="basic-addon1" style="padding-right: 20px;">Benificiary LastName: &nbsp;</span>
                                                                                <input type="text" class="form-control" name="inputbLname" value="<?php echo $info['blname'] ?>" readonly  />
                                                                            </div>
                                                                        </div>
                                                                        <hr />
                                                                        <div class="form-group">
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" id="basic-addon1" style="padding-right: 95px;">Birthdate: &nbsp;</span>
                                                                                <input type="text" class="form-control" value="<?php echo $info['birthdate'] ?>" readonly />
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" id="basic-addon1" style="padding-right: 80px;">Occupation: &nbsp;</span>
                                                                                <input type="text" class="form-control" name="inputOccup" value="<?php echo $info['occupation'] ?>" readonly  />
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" id="basic-addon1" style="padding-right: 62px;">Email Address: &nbsp;</span>
                                                                                <input type="email" class="form-control" name="inputEmail" value="<?php echo $info['email'] ?>" readonly />
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" id="basic-addon1">Transaction Password: &nbsp;</span>
                                                                                <input type="password" class="form-control" name="inputTpass" placeholder="Transaction Password" required  />
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group text-right">
                                                                            <button type="submit" class="btn btn-primary" name="btn_confirm_malayan">Submit</button>
                                                                        </div>
                                                                    </form>
                                                                    </div>
                                                                <?php endif ?>

                                                                <?php if (is_null($process)): ?>
                                                                <div class="col-xs-6 col-md-7">
                                                                <?php elseif ($process == 1): ?>
                                                                <div class="col-xs-6 col-md-5">
                                                                <?php endif ?>
                                                                    <div class="form-group">
                                                                        <p style="margin: 0px; font-weight: bold;">NOTE:</p>
                                                                        <p style="margin: 0px;">Please check the details before you confirm.</p>
                                                                        <p>Once confirmed it will not be amended.</p>
                                                                        <table class='table table-stripped'>
                                                                            <thead>
                                                                                <th>Coverage</th>
                                                                                <th>Limits</th>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                <td>Accident Death, Dismemberment &/or Disablment</td>
                                                                                <td id="note1"><?php if($policy['ADD'] != ''){echo $policy['ADD'];} else {echo '100,000';}?></td>
                                                                                </tr>

                                                                                <tr>
                                                                                <td>Burial Assistance (Due to Accident Death)</td>
                                                                                <td id="note2"><?php if($policy['BA'] !=''){echo $policy['BA'];} else {echo '10,000';}?></td>
                                                                                </tr>

                                                                                <tr>
                                                                                <td>Premium</td>
                                                                                <td id="note3"><?php if($policy['PRE'] !=''){echo $policy['PRE'];} else {echo '75.00';}?></td>
                                                                                </tr>

                                                                                <tr>
                                                                                <td>Period of Cover</td>
                                                                                <td id="note4" nowrap><?php if($policy['PC'] !=''){echo $policy['PC'];} else {echo '1 (Year)';}?>&nbsp;</td>
                                                                                </tr>

                                                                            </tbody>
                                                                        </table> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-4 col-md-4 text-right">
                                                            <img class="company-logo" src="<?php echo BASE_URL()?>assets/images/malayan_logo.png" alt="">
                                                        </div>
                                                    </div><!--ROW-->

                                                </div>  
                                             </div>      
                                        </div><!-- activity-list -->

                                    </div><!-- tab-pane -->

                                </div>
                            </div><!-- col-md-8 -->
                        </div><!-- row -->

                    </div><!-- contentpanel -->
                    
    </div><!-- mainpanel -->            