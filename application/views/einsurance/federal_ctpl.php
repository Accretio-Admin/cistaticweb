
<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-home"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>E-INSURANCE</li>
                </ul>
                <h4>FEDERAL CTPL INSURANCE</h4>
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

                                    <div class="col-xs-10 col-md-10">
                                    <?php if ($result['S'] === 0 || $result['S'] === '0' ): ?>
                                        <div class="alert alert-danger"><?php echo $result['M'] ?></div>
                                    <?php elseif ($result['S'] === 1 || $result['S'] === '1' ): ?>
                                        <div class="alert alert-success">
                                        <b>Transaction Successful! Reference No: <u><?php echo $result['TN'] ?></u></b><br/>
                                        <a target="_blank" href="<?php echo $result['AR_URL'] ?>"><u>Click here to download copy of Acknowledgement receipt.</u></a><br/>
                                        <a target="_blank" href="<?php echo $result['COC_URL'] ?>"><u>Click here to download copy of eCOC.</u></a><br/><br/>
                                        Note: <?php echo $result['M']?>
                                        </div>
                                    <?php endif ?>
                                        <div class="row">
                                                    <form method="post" action="<?php echo base_url('/Einsurance/ctpl_insurance') ?>" class="transaction_form" id="frmFederal">
                                                    <div class="col-xs-12 col-md-12" style="margin-left:5px;"> 
                                                    <h2 style="margin-top: 0px; margin-bottom: 10px;"><b>Kindly fill in all required fields. </b></h2>
                                                    <h5>Note: Please refer to your ORCR copy or Sales Invoice for accurate information.</h5>
                                                    <hr/>
                                                    <div class="radio-inline" id="radiodiv" style="padding-left: 0px;">
                                                    </div>
                                                    </div>
                                                    <div class="col-xs-5 col-md-5"> 
                                                        <input type="hidden" class="form-control" name="currentdate" id="currentdate" value="<?php echo $currentyear ?>"> 
                                                        <input type="hidden" class="form-control" name="yearspan" id="yearspan">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                              <span class="input-group-addon" id="basic-addon3">MV File No. (15 Digits)</span>
                                                              <input type="text" class="form-control" name="input_mvfileno" id="input_mvfileno" value="xxxx-xxxxxxxxxxx" pattern="[0-9]{4}-?[A-Z0-9]{11}" maxlength="15" disabled required  />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" onpaste="return false;" name="input_plateno" id="input_plateno" placeholder="Plate No. (4-8 Alphanumeric)" maxlength="8" disabled required />
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="input_engineno" id="input_engineno" placeholder="Engine No."  disabled required  />
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="input_chassisno" id="input_chassisno" placeholder="Chassis No."  disabled required  />
                                                        </div>
                                                        <div class="form-group">
                                                          <select class="form-control" id="selMVtypeCTPL" name="selMVtypeCTPL" required disabled>
                                                                <option value="" disabled selected>Premium Type</option>
                                                          </select> 
                                                          <div class="alert alert-info alert-CTPL" style="display:none; word-wrap:break-word; margin-bottom: auto; padding-top: inherit;"></div>
                                                        </div>
                                                        <div class="form-group">
                                                          <select class="form-control" id="selTenureCTPL" name="selTenureCTPL" required disabled>
                                                                <option value="" disabled selected>Vehicle Type</option>
                                                          </select> 
                                                        </div>
                                                        <div class="form-group" id="formInception1">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon3">Inception Date</span>
                                                                    <select class="form-control" id="input_month" name="input_month" disabled required>     
                                                                    <option value="" disabled selected>Month</option>
                                                                        <?php 
                                                                        $i = 1;
                                                                        foreach ($month as $monthdesc): ?>
                                                                        <option value="<?php echo $i?>"><?php echo $monthdesc?></option>    
                                                                        <?php 
                                                                        $i++;
                                                                        endforeach ?>
                                                                    </select>
                                                                    <select class="form-control" id="input_year" name="input_year" disabled required>  
                                                                    <option value="" disabled selected>Year</option>
                                                                        <?php
                                                                        $yrlimit = $currentyear - 5;
                                                                        //for ($x=$yrlimit; $x<=$currentyear; $x++)
                                                                        for ($x=$currentyear; $x>=$yrlimit; $x--)
                                                                          {
                                                                            echo'<option value="'.$x.'">'.$x.'</option>'; 
                                                                          } 
                                                                        ?> 
                                                                    </select>                                                        
                                                            </div>
                                                        </div>
                                                        <div class="form-group" id="formInception2"  style="display: none; margin-top: -5px; margin-bottom: 5px;">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon3">Inception Date</span>
                                                                <input type="text" class="form-control" name="input_inceptiondate" id="input_inceptiondate" placeholder="Inception Date" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon3" style="padding-right: 31px;">Expiry Date</span>
                                                                <input type="text" class="form-control" name="input_expirydate" id="input_expirydate" placeholder="Expiry Date" readonly />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-7 col-md-7" >  
                                                        <div class="row">
                                                            <div class="col-xs-6 col-md-6"> 
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputNumberValidator" name="input_yrmodel" id="input_yrmodel" maxlength="4" placeholder="Year Model (YYYY)" disabled required />
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-md-6">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputNameValidator" name="input_bodytype" id="input_bodytype" placeholder="Body Type" disabled required />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control inputNameValidator2" name="input_company" id="input_company" placeholder="Company" disabled required />
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control inputNameValidator2" name="input_bodymake" id="input_bodymake" placeholder="Make" disabled required />
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control inputNameValidator" name="input_bodycolor" id="input_bodycolor" placeholder="Color" disabled required />
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-6 col-md-6"> 
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputAmount" name="input_capacity" id="input_capacity" placeholder="Capacity" disabled required />
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-md-6">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control inputAmount" name="input_weight" id="input_weight" placeholder="Weight" disabled required />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control inputNameValidator2" name="input_assuredname" id="input_assuredname" placeholder="Assured Name (First, Middle, Last Name)" disabled required />
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="email" class="form-control" name="input_assuredemail" id="input_assuredemail" placeholder="Email Address" disabled required />
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" id="basic-addon3">TIN No. (12 Digits)</span>
                                                                <input type="text" class="form-control inputNumberValidator" name="input_assuredtin" id="input_assuredtin" value="000-000-000-000" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}-[0-9]{3}" disabled />                                                        
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="input_assuredaddress" id="input_assuredaddress" placeholder="Present/Permanent Home Address" disabled required />
                                                        </div>
                                                        <div class="form-group text-right">
                                                            <button name="btn_submit_federal" id="btn_submit_federal" type="submit" class="btn btn-primary" disabled >Continue <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span></button>
                                                        </div>
                                                    </div>
                                                </form>

                                    <?php if($process == 1): ?>
                                      <div class="modal fade" tabindex="-1" data-backdrop="static" role="dialog" id="modalFederal">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                            <h4><b>REGISTRATION SUMMARY</b><button type="button" class="close closeFederalmodal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></h4>
                                            <h5>Note: Kindly check correctness of data shown below.</h5>
                                            </div>
                                            <div class="modal-body" style="padding-top: initial;">
                                            <form method="post" action="<?php echo base_url('/Einsurance/ctpl_insurance') ?>" class="transaction_form" id="frmFederalConfirm">
                                            <div class="row"> 
                                            <div class="col-xs-12 col-sm-12"> 
                                                <?php if ($results['S'] === 0 || $results['S'] === '0' ): ?>
                                                <div class="alert alert-danger"><?php echo $results['M'] ?></div>
                                                <?php endif ?>
                                                <h4 style="border-bottom: 1px solid black;">VEHICLE INFORMATION</h4>
                                                <div class="row">
                                                    <div class="col-xs-6 col-sm-6"> 
                                                        <label for="regtype">Registration Type:</label>
                                                        <label for="regtype" class="pull-right" style="font-weight: normal;"><?php echo $result['regtype']=="N"?"New Registration":"Renewal"; ?></label>
                                                    </div>
                                                    <div class="col-xs-6 col-sm-6"> 
                                                        <label for="pwd">Chasis Number:</label>
                                                        <label for="pwd" class="pull-right" style="font-weight: normal;"><?php echo $result['chassisno']; ?></label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-6 col-sm-6"> 
                                                        <label for="pwd">Plate Number:</label>
                                                        <label for="pwd" class="pull-right" style="font-weight: normal;"><?php echo $result['plateno']; ?></label>
                                                    </div>
                                                    <div class="col-xs-6 col-sm-6"> 
                                                        <label for="pwd">Engine Number:</label>
                                                        <label for="pwd" class="pull-right" style="font-weight: normal;"><?php echo $result['engineno']; ?></label>
                                                  </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-6 col-sm-6"> 
                                                        <label for="pwd">MV Number:</label>
                                                        <label for="pwd" class="pull-right" style="font-weight: normal;"><?php echo $result['mvfileno']; ?></label>
                                                      </div>
                                                    <div class="col-xs-6 col-sm-6"> 
                                                        <label for="pwd">Premium Type:</label>
                                                        <label for="pwd" class="pull-right" style="font-weight: normal;"><?php echo strlen($desc['mvDesc']) > 20 ? substr($desc['mvDesc'],0,20).'...':$desc['mvDesc']; ?></label>
                                                  </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-6 col-sm-6"> 
                                                        <label for="pwd">Inception Date:</label>
                                                        <label for="pwd" class="pull-right" style="font-weight: normal;"><?php echo $result['inceptiondate']; ?></label>
                                                   </div>
                                                    <div class="col-xs-6 col-sm-6"> 
                                                        <label for="pwd">Vehicle:</label>
                                                        <label for="pwd" class="pull-right" style="font-weight: normal;"><?php echo strlen($desc['vehicleDesc']) > 30 ? substr($desc['vehicleDesc'],0,30).'...':$desc['vehicleDesc'];  ?></label>
                                                     </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-6 col-sm-6"> 
                                                        <label for="pwd">Expiry Date:</label>
                                                        <label for="pwd" class="pull-right" style="font-weight: normal;"><?php echo $result['expirydate']; ?></label>
                                                  </div>
                                                    <div class="col-xs-6 col-sm-6"> 
                                                    </div>
                                                </div>
                                                <h4 style="border-bottom: 1px solid black;">ORCR INFORMATION</h4>
                                                <div class="row">
                                                    <div class="col-xs-6 col-sm-6"> 
                                                        <label for="pwd">Year Model:</label>
                                                        <label for="pwd" class="pull-right" style="font-weight: normal;"><?php echo $result['yearmodel']; ?></label>
                                                    </div>
                                                    <div class="col-xs-6 col-sm-6"> 
                                                        <label for="pwd">Body Type:</label>
                                                        <label for="pwd" class="pull-right" style="font-weight: normal;"><?php echo $result['bodytype']; ?></label>
                                                  </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-6 col-sm-6"> 
                                                        <label for="pwd">Company:</label>
                                                        <label for="pwd" class="pull-right" style="font-weight: normal;"><?php echo $result['company']; ?></label>
                                                    </div>
                                                    <div class="col-xs-6 col-sm-6"> 
                                                        <label for="pwd">Body Make:</label>
                                                        <label for="pwd" class="pull-right" style="font-weight: normal;"><?php echo $result['bodymake']; ?></label>
                                                  </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-6 col-sm-6"> 
                                                        <label for="pwd">Capacity:</label>
                                                        <label for="pwd" class="pull-right" style="font-weight: normal;"><?php echo $result['authcap']; ?></label>
                                                    </div>
                                                    <div class="col-xs-6 col-sm-6"> 
                                                        <label for="pwd">Body Color:</label>
                                                        <label for="pwd" class="pull-right" style="font-weight: normal;"><?php echo $result['bodycolor']; ?></label>
                                                  </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-6 col-sm-6"> 
                                                        <label for="pwd">Weight:</label>
                                                        <label for="pwd" class="pull-right" style="font-weight: normal;"><?php echo $result['unladenweight']; ?></label>
                                                    </div>
                                                    <div class="col-xs-6 col-sm-6"> 
                                                  </div>
                                                </div>
                                                <h4 style="border-bottom: 1px solid black;">ASSURED INFORMATION</h4>
                                                <div class="row">
                                                    <div class="col-xs-6 col-sm-6"> 
                                                        <label for="pwd">Name:</label>
                                                        <label for="pwd" class="pull-right" style="font-weight: normal;"><?php echo $result['assuredname']; ?></label>
                                                    </div>
                                                    <div class="col-xs-6 col-sm-6"> 
                                                        <label for="pwd">TIN:</label>
                                                        <label for="pwd" class="pull-right" style="font-weight: normal;"><?php echo $result['assuredtin']; ?></label>
                                                  </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-6 col-sm-6"> 
                                                        <label for="pwd">Address:</label>
                                                        <label for="pwd" class="pull-right" style="font-weight: normal;"><?php echo strlen($result['assuredaddress']) > 20 ? substr($result['assuredaddress'],0,20).'...':$result['assuredaddress']; ?></label>
                                                    </div>
                                                    <div class="col-xs-6 col-sm-6"> 
                                                        <label for="pwd">Email:</label>
                                                        <label for="pwd" class="pull-right" style="font-weight: normal;"><?php echo $result['assuredemail']; ?></label>
                                                  </div>
                                                </div>
                                                <h4 style="border-bottom: 1px solid black;">TRANSACTION DETAILS:</h4>
                                                <div class="row">
                                                    <div class="col-xs-6 col-sm-6"> 
                                                        <label for="pwd">CTPL Premium:</label>
                                                    </div>
                                                    <div class="col-xs-6 col-sm-6"> 
                                                        <label for="pwd" class="pull-right"><?php echo number_format($pricing['FPG_PREMIUM'],2); ?></label>
                                                 </div>
                                                </div>
                                                <div class="row" >
                                                    <div class="col-xs-6 col-sm-6"> 
                                                        <label for="pwd"><?php echo $pricing['L'].':'; ?></label>
                                                    </div>
                                                    <div class="col-xs-6 col-sm-6"> 
                                                        <label for="pwd" class="pull-right" style="font-weight: normal;"><?php echo $pricing['D']; ?></label>
                                                 </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-6 col-sm-6"> 
                                                        <label for="pwd">Total Net Price:</label>
                                                    </div>
                                                    <div class="col-xs-6 col-sm-6"> 
                                                        <label for="pwd" class="pull-right" style="padding-left: 200px; border-top: 1px solid black;"><?php echo number_format($pricing['NET_PRICE'],2); ?></label>                                                    
                                                 </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-4" style="margin-top: 7px;"> 
                                                        <label for="pwd">Transaction Password:</label>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-8"> 
                                                        <input type="password" class="form-control" name="inputTpass" id="inputTpass" maxlength="15" placeholder="Transaction Password" required/>
                                                        <input type="hidden" class="form-control" name="tprice" id="tprice" value="<?php echo $tprice; ?>">
                                                        <textarea name="inputDetails" id="inputDetails" style="display: none;"><?php echo json_encode($result); ?></textarea>
                                                        <textarea name="inputpricing" id="inputpricing" style="display: none;"><?php echo json_encode($pricing); ?></textarea>
                                                        <textarea name="inputDetails2" id="inputDetails2" style="display:none;"><?php echo json_encode($desc); ?></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                                <center><h5><b><u>Important Reminder</u></b><br/>
                                                All successful CTPL Registration is non-cancellable/non-amendable/non-refundable.
                                                </h5></center>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 text-right" style="margin-top: 5px;">
                                                      <button type="submit" name="btn_confirm_federal" id="btn_confirm_federal" class="btn btn-primary">Submit <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
                                                    </div>
                                                </div>
                                              </div>
                                              </div>
                                            </form>                                   
                                          </div>
                                        </div>
                                      </div>
                                  <?php endif ?>
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

<script type="text/javascript">
      window.onload = function() {
     MaskedInput({
        elm: document.getElementById('input_mvfileno'), // select only by id
        format: 'xxxx-xxxxxxxxxxx',
        separator: '-'
     });

     MaskedInput({
        elm: document.getElementById('input_assuredtin'), // select only by id
        format: '000-000-000-000',
        separator: '-'
     });
  };
</script>
