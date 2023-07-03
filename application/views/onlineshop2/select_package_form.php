  <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-money"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>Online Shop</li>
                                </ul>
                                <h4>Buycodes</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    <div class="contentpanel">

                        <div class="row row-stat">
                        <?php if ($result['S'] === 0 || $result['S'] === '0' ): ?>
                            <div class="alert alert-danger"><?php echo $result['M'] ?></div>
                        <?php elseif ($result['S'] === 1 || $result['S'] === '1' ): ?>
                            <div class="alert alert-success"><?php echo $result['M'] ?></div>
                        <?php endif ?>
                            <div class="col-sm-10 document">
                              <table>
                                <tr>
                                  <td><img  src="<?php echo BASE_URL() ?>assets/images/flags2/<?php echo $location; ?>.png" alt="" style="width:40px; height:40px;"></td>
                                  <td style="padding-left:5px;"><span><?php echo $location; ?><br>Your IP: <?php echo $this->ip; ?></span></td>
                                </tr>
                              </table>
                            </div>  
                            <div class="row">                      
                              <div class="col-sm-11 col-md-11">
                                  <div class="tab-content nopadding noborder">
                                      <div class="tab-pane active" id="activities">
                                          <div class="follower-list">  
                                              <div class="col-sm-12">
                                                  <div class="row media-manager">
                                                  <?php if($retailer != 1): ?>
                                                  
                                                    <div class="col-xs-2 col-sm-2 col-md-2 document buycodepack">
                                                      <div class="thmb">
                                                          <div style="background-color:white; width:auto; height:auto; float:left; position:absolute; top:35px; left:-20px; padding:5px; border:1px solid;">
                                                          <span style="font-size:14px; color:#C7080B;">PHP <?php echo number_format($package_value->NetPrice,2); ?></span>
                                                          <?php
                                                            if($package_value->Discount > 0){
                                                              ?>
                                                              <br><span style="font-size:10px; text-decoration: line-through;">PHP <?php echo $package_value->Price; ?></span>
                                                              <span style="font-size:10px;">-<?php echo $package_value->Discount; ?></span>
                                                              <?php
                                                            }
                                                          ?>

                                                          </div>
                                                        <div class="thmb-prev  text-center">
                                                          <img src="<?php echo BASE_URL() ?>assets/images/pkit.png" alt="" style="margin:0 auto; width:100px; height:150px;">
                                                        </div>
                                                        <h5 class="fm-title text-center"><?php 
                                                          $name_arr = explode(' ', $package_value->Name);
                                                          for($j=0;$j<count($name_arr);$j++){
                                                            $name_val .= ucfirst(strtolower($name_arr[$j])).' ';
                                                          }
                                                          $name_val = trim($name_val);
                                                          echo $name_val.' Package';
                                                          unset($name_val);
                                                        ?></h5>
                                                      </div>
                                                    </div>

                                                    <div class="col-xs-6 col-sm-5 col-md-5">
                                                      <form name="formbuycodes" action="<?php echo BASE_URL()?>Online_shop2" method="POST" id="frmBuycodes">
                                                      <div class="form-group">
                                                        <input type="text" class="form-control inputNameValidator" name="inputClient" value="<?php echo $package_info['client_name']?>" maxlength="30" placeholder="Client Name" required/>
                                                      </div>

                                                      <div class="form-group">
                                                        <input type="email" class="form-control" name="inputClientemail" value="<?php echo $package_info['client_email']?>" maxlength="30" placeholder="Client Email Address" required/>
                                                      </div>

                                                      <div class="form-group">
                                                        <input type="text" class="form-control inputNumberValidator" name="inputMobno" value="<?php echo $package_info['client_mobile']?>" maxlength="11" placeholder="Client Mobile Number" required/>
                                                        <input type="hidden" class="form-control" name="inputNetPrice" id="inputNetPrice" value="<?php echo $package_value->NetPrice; ?>"/>
                                                      </div>

                                                      <hr>How would you like to pay?<br>
                                                      <div class="form-group">
                                                            <select class="form-control" name="selpaymenttype" id="selpaymenttype" required>
                                                                  <option value="" disabled selected>--PAYMENT OPTION--</option>
                                                                  <option value="1">ECASH</option>
                                                                <?php if($user['R'] == '1234567' || $user['R'] == 'F756342' || $user['R'] == '13979797' || $user['R'] == 'FH000016' || $user['R'] == 'F5880126' || $user['R'] == 'FH4762228' || $user['R'] == '1234504'): ?>
                                                                 <option value="2">CREDIT CARD</option>
                                                                <?php endif?>
                                                            </select>  
                                                      </div>

                                                      <div class="form-group">
                                                        <input type="text" style="display: none;" class="form-control" name="inputTpass" id="inputTpass" maxlength="15" placeholder="Transaction Password" required/>
                                                        <div class="alert alert-info alert-creditcard1" style="display:none; word-wrap:break-word; margin-bottom: auto;"></div>
                                                      </div>

                                                      <div class="form-group text-right" style="margin-top: -20px;">
                                                        <button type="submit" class="btn btn-primary" name="btnsubmit">SUBMIT</button>
                                                        <input type="hidden" class="form-control" name="inputCountry" id="inputCountry" value="<?php echo $location; ?>"/>
                                                        <input type="hidden" class="form-control" name="inputPackageType" id="inputPackageType" value="<?php echo $package_value->Package_ID; ?>"/>
                                                      </div>
                                                    </form>
                                                    </div>

                                                    <div class="col-xs-2 col-sm-5 col-md-5">
                                                      <div class="alert alert-info alert-creditcard2" style="display:none; word-wrap:break-word;"></div>
                                                    </div>
                                                    <?php endif ?>
                                                   </div>
                                                   <div class='col-xs-12 col-md-12'>
                                                    <hr>
                                                  </div>
                                                  <div class='col-xs-12 col-md-12'>
                                                      <table id="buykitsdtbl" class="table table-bordered" cellspacing="0" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Tracking number</th>
                                                                <th>Payment Type</th>
                                                                <th>Package Type</th>
                                                                <th>Datetime</th>
                                                                <th>Status</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                           <?php
                                                            if($binfo_set){
                                                              for($i=0;$i<count($transdata);$i++){
                                                                echo "<tr>";

                                                                echo "<td>";
                                                                echo $transdata[$i]['trackno'];
                                                                echo "</td>";

                                                                echo "<td>";
                                                                echo $transdata[$i]['payment_type'];
                                                                echo "</td>";

                                                                echo "<td>";
                                                                echo $transdata[$i]['packagetype'];
                                                                echo "</td>";

                                                                echo "<td>";
                                                                echo $transdata[$i]['datetime'];
                                                                echo "</td>";

                                                                echo "<td>";
                                                                echo $transdata[$i]['status'];
                                                                echo "</td>";

                                                                echo "<td>";
                                                                if($transdata[$i]['status'] == 'POSTED'){
                                                                  ?>
                                                                    <p style="color:black;">Pending for Confirmation</p>
                                                                  <?php
                                                                }else if($transdata[$i]['status'] == 'CANCELLED'){
                                                                  ?>
                                                                    <p style="font-weight:bold;color:red;">Cancelled</p>
                                                                  <?php
                                                                }else{
                                                                  ?>
                                                                    <a class="btn btn-primary" target="_blank" href="<?php echo "https://mobilereports.globalpinoyremittance.com/portal/buy_codes_receipt/".$transdata[$i]['trackno']; ?>">Get Receipt</a>
                                                                  <?php
                                                                }
                                                                echo "</td>";

                                                                echo "</tr>";
                                                              }
                                                            }
                                                           ?>
                                                        </tbody>
                                                    </table>
                                                  </div>
                                              </div> <!-- row -->

                                            </div> <!--col-xs-6 col-md-6-->
                                               </div>      
                                          </div><!-- activity-list -->
                                      </div><!-- tab-pane -->
                                  </div>
                              </div><!-- col-md-8 -->
                            </div>
                        </div><!-- row -->
                    </div><!-- contentpanel -->
                    <?php if($process == 1):?>
                      <div class="modal fade" tabindex="-1" role="dialog" id="modalBDOframe">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close closeBDOmodal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                            <iframe width="100%" height="550px" src="" name="BDOiframe" id="BDOiframe"></iframe>
                            <input type="hidden" class="form-control" name="inputbdoURL" id="inputbdoURL" value="<?php echo $bdoURL; ?>"/>
                            </div>
<!--                        <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary">Save changes</button>
                            </div> -->
                          </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                      </div><!-- /.modal -->
                  <?php endif ?>

                  <?php if($process == 999):?>
                    <div class="modal fade" id="modalBuycodesAgreementframe" data-backdrop="static" role="dialog" style="margin-top: 3%;">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <p><strong><h4 style="font-family: Times New Roman, times-roman, georgia, serif">TERMS AND CONDITION</h4></strong></p>
                          </div>
                          <div class="modal-body" style="font-family: Times  New Roman; overflow-y: scroll; width: 100%; height: 450px; padding: 0px 5px 5px 5px;">
                            <iframe width="100%" height="700px" src="" name="buycodesAgreementiframe" id="buycodesAgreementiframe"></iframe>
                            <input type="hidden" class="form-control" name="inputAgreeURL" id="inputAgreeURL" value="<?php echo urlencode($content); ?>"/>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endif ?>


                </div><!-- mainpanel -->        
                      

            <script type="text/javascript">
              function submit(valpass){
                document.getElementById("package_select").value = valpass;
                document.getElementById("selectPackage").submit();
              }
            </script>
              </div>     