
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
                                  <td style="padding-left:5px;"><span><?php echo $location; ?><br> Your IP Address: <?php echo $this->ip; ?></span></td>
                                </tr>
                              </table>
                            </div>  
                            <div class="row">                      
                              <div class="col-sm-12 col-md-12">
                                  <div class="tab-content nopadding noborder">
                                      <div class="tab-pane active" id="activities">
                                          <div class="follower-list">  
                                              <div class="col-sm-12">
                                                  <div class="row media-manager">
                                                  <?php if($retailer != 1): ?>
                                                  
                                                    <div class="col-6 col-sm-5 col-md-4 col-lg-2 document buycodepack">
                                                      <div class="thmb">
                                                          <div style="background-color:white; width:auto; height:auto; float:left; position:absolute; top:35px; left:-20px; padding:5px; border:1px solid;">
                                                          <span style="font-size:14px; color:#C7080B;">PHP <?php echo number_format($package_value->NetPrice,2); ?></span>
                                                          <?php
                                                            if($package_value->Discount > 0){
                                                          ?>
                                                              <br><span style="font-size:10px; text-decoration: line-through;">PHP <?php echo $package_value->Price; ?></span>
                                                              <span style="font-size:10px;">-<?php echo $package_value->Discount; ?></span>
                                                          <?php
                                                            } else if($package_value->Package_ID == 6 && $package_value->Discount >= 0) { 
                                                          ?>
                                                              <br><span hidden class="disc" style="font-size:10px; text-decoration: line-through;">PHP <?php echo '18,598.00'; ?></span>
                                                              <span hidden class="disc" style="font-size:10px;">-<?php echo '400.00'; ?></span>
                                                          <?php } ?>
                                                          </div>
                                                        <div class="thmb-prev  text-center">
                                                          <?php if($package_value->Package_ID == 6) {?>
                                                            <img src="<?php echo BASE_URL() ?>assets/images/rmkit.png" alt="" style="margin:0 auto; width:100px; height:150px;">
                                                          <?php }else { ?>
                                                            <img src="<?php echo BASE_URL() ?>assets/images/pkit.png" alt="" style="margin:0 auto; width:100px; height:150px;">
                                                          <?php } ?>
                                                          
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

                                                    <div class="col-6 col-sm-7 col-md-8 col-lg-6">
                                                      <form name="formbuycodes" action="<?php echo BASE_URL()?>Onlineshop/buycodes" method="POST" id="frmBuycodes">
                                                      <div class="form-group">
                                                        <input type="text" class="form-control inputNameValidator" name="inputClient" value="<?php echo $package_info['inputClient']?>" maxlength="30" placeholder="Client Name" required/>
                                                      </div>

                                                      <div class="form-group">
                                                        <input type="email" class="form-control" name="inputClientemail" value="<?php echo $package_info['inputClientemail']?>" placeholder="Client Email Address" required/>
                                                      </div>

                                                      <div class="form-group">
                                                        <input type="text" class="form-control inputNumberValidator" name="inputMobno" value="<?php echo $package_info['inputMobno']?>" maxlength="11" placeholder="Client Mobile Number" required/>
                                                        <input type="hidden" class="form-control" name="inputNetPrice" id="inputNetPrice" value="<?php echo $package_value->NetPrice; ?>"/>
                                                      </div>
                                                      <div class="form-group">
                                                        <?php if($package_value->Package_ID == 6):?>
                                                          <hr>Depot Discount: <input type="checkbox" id="discounts" name="discounts" value="1" onclick="rmdiscount()">
                                                        <?php endif ?>
                                                      </div>
                                                      <hr>How would you like to pay?<br>
                                                      <div class="form-group">
                                                            <select class="form-control" name="selpaymenttype" id="selpaymenttype" required>
                                                                  <option value="" disabled selected>--PAYMENT OPTION--</option>
                                                                  <option value="1">ECASH</option>
                                                                <!-- remove package if done testing -->
                                                                <?php if(($user['L'] == '1' || $user['L'] == '6' || $user['L'] == '14' || $user['L'] == '15' || $user['R'] == '1234567' || $user['R'] == 'F756342' || $user['R'] == '13979797' || $user['R'] == 'FH000016' || $user['R'] == 'F5880126' || $user['R'] == 'FH4762228' || $user['R'] == '1234504') && $package_value->Package_ID <= '5'): ?>
                                                                 <option hidden value="2">CREDIT CARD</option>
                                                                <?php endif?>
                                                            </select>  
                                                      </div>

                                                      <div class="form-group">
                                                        <input type="password" style="display: none;" class="form-control" name="inputTpass" id="inputTpass" maxlength="15" placeholder="Transaction Password" required/>
                                                        <div class="alert alert-info alert-creditcard1" style="display:none; word-wrap:break-word; margin-bottom: auto;"></div>
                                                      </div>
                                                      
                                                      <!-- PAYLITE -->
                                                      <?php if($package_value->Package_ID == 7):?>
                                                        <div class="form-group">
                                                          <p style='text-align:center'> Choose ONE of the following Packages </p>
                                                          <input type="hidden" class="form-control" name="paylitePackage" id="paylitePackage" value="<?php echo $package_value->Package_ID; ?>"/>
                                                          <div class="col-4 col-sm-4 col-md-4 col-lg-4" style='text-align: center'>
                                                            <a href="#imagemodal" class="openImage" data-toggle="modal" data-id="<?php echo BASE_URL() ?>assets/images/PayliteA.jpg" style='cursor: pointer'>
                                                              <img src="<?php echo BASE_URL() ?>assets/images/PayliteA.jpg" alt="" style="width:100%; height:auto;"><br/>
                                                            </a>
                                                            <input type="radio" id="payliteA" name="packaged" value="Package A" style="height:20px; width:25px" required>
                                                          </div>
                                                          <div class="col-4 col-sm-4 col-md-4 col-lg-4" style='text-align: center'>
                                                            <a href="#imagemodal" class="openImage" data-toggle="modal" data-id="<?php echo BASE_URL() ?>assets/images/PayliteB.jpg" style='cursor: pointer'>
                                                              <img src="<?php echo BASE_URL() ?>assets/images/PayliteB.jpg" alt="" style="width:100%; height:auto;"><br/>
                                                            </a>
                                                            <input type="radio" id="payliteB" name="packaged" value="Package B" style="height:20px; width:25px">
                                                          </div>
                                                          <div class="col-4 col-sm-4 col-md-4 col-lg-4" style='text-align: center'>
                                                            <a href="#imagemodal" class="openImage" data-toggle="modal" data-id="<?php echo BASE_URL() ?>assets/images/PayliteC.jpg" style='cursor: pointer'>
                                                              <img src="<?php echo BASE_URL() ?>assets/images/PayliteC.jpg" alt="" style="width:100%; height:auto;"><br/>
                                                            </a>
                                                            <input type="radio" id="payliteC" name="packaged" value="Package C" style="height:20px; width:25px">
                                                          </div>
                                                        </div>
                                                      <?php endif ?>
                                                      
                                                      <!-- PINOY PACKAGE-->
                                                      <?php if($package_value->Package_ID == 8):?>
                                                        <div class="form-group">
                                                          <p style='text-align:center'> Choose ONE of the following Packages </p>
                                                          <input type="hidden" class="form-control" name="pinoyPackage" id="pinoyPackage" value="<?php echo $package_value->Package_ID; ?>"/>
                                                          <div class="col-4 col-sm-4 col-md-4 col-lg-4" style='text-align: center'>
                                                            <a href="#imagemodal" class="openImage" data-toggle="modal" data-id="<?php echo BASE_URL() ?>assets/images/PinoyA.jpg" style='cursor: pointer'>
                                                              <img src="<?php echo BASE_URL() ?>assets/images/PinoyA.jpg" alt="" style="width:100%; height:auto;"><br/>
                                                            </a>
                                                            <input type="radio" id="pinoyA" name="packaged" value="Package A" style="height:20px; width:25px" required>
                                                          </div>
                                                          <div class="col-4 col-sm-4 col-md-4 col-lg-4" style='text-align: center'>
                                                            <a href="#imagemodal" class="openImage" data-toggle="modal" data-id="<?php echo BASE_URL() ?>assets/images/PinoyB.jpg" style='cursor: pointer'>
                                                              <img src="<?php echo BASE_URL() ?>assets/images/PinoyB.jpg" alt="" style="width:100%; height:auto;"><br/>
                                                            </a>
                                                            <input type="radio" id="pinoyB" name="packaged" value="Package B" style="height:20px; width:25px">
                                                          </div>
                                                          <div class="col-4 col-sm-4 col-md-4 col-lg-4" style='text-align: center'>
                                                            <a href="#imagemodal" class="openImage" data-toggle="modal" data-id="<?php echo BASE_URL() ?>assets/images/PinoyC.jpg" style='cursor: pointer'>
                                                              <img src="<?php echo BASE_URL() ?>assets/images/PinoyC.jpg" alt="" style="width:100%; height:auto;"><br/>
                                                            </a>
                                                            <input type="radio" id="pinoyC" name="packaged" value="Package C" style="height:20px; width:25px">
                                                          </div>
                                                        </div>
                                                        <div class="form-group">
                                                          <div class="col-4 col-sm-4 col-md-4 col-lg-4" style='text-align: center'>
                                                            <a href="#imagemodal" class="openImage" data-toggle="modal" data-id="<?php echo BASE_URL() ?>assets/images/PinoyD.jpg" style='cursor: pointer'>
                                                              <img src="<?php echo BASE_URL() ?>assets/images/PinoyD.jpg" alt="" style="width:100%; height:auto;"><br/>
                                                            </a>
                                                            <input type="radio" id="pinoyD" name="packaged" value="Package D" style="height:20px; width:25px">
                                                          </div>
                                                          <div class="col-4 col-sm-4 col-md-4 col-lg-4" style='text-align: center'>
                                                            <a href="#imagemodal" class="openImage" data-toggle="modal" data-id="<?php echo BASE_URL() ?>assets/images/PinoyE.jpg" style='cursor: pointer'>
                                                              <img src="<?php echo BASE_URL() ?>assets/images/PinoyE.jpg" alt="" style="width:100%; height:auto;"><br/>
                                                            </a>
                                                            <input type="radio" id="pinoyE" name="packaged" value="Package E" style="height:20px; width:25px">
                                                          </div>
                                                          <div class="col-4 col-sm-4 col-md-4 col-lg-4" style='text-align: center'>
                                                            <a href="#imagemodal" class="openImage" data-toggle="modal" data-id="<?php echo BASE_URL() ?>assets/images/PinoyF.jpg" style='cursor: pointer'>
                                                              <img src="<?php echo BASE_URL() ?>assets/images/PinoyF.jpg" alt="" style="width:100%; height:auto;"><br/>
                                                            </a>
                                                            <input type="radio" id="pinoyF" name="packaged" value="Package F" style="height:20px; width:25px">
                                                          </div>
                                                        </div>
                                                      <?php endif ?>

                                                      <!-- WEALTHY PACKAGE -->
                                                      <!-- <?php if($package_value->Package_ID == 9):?>
                                                        <div class="form-group">
                                                          <p style='text-align:center'> Choose ONE of the following Packages </p>
                                                          <p style='text-align:center'> Freebies Inclusion: ( Four (4) Choices ) </p>
                                                          <input type="hidden" class="form-control" name="wealthyPackage" id="wealthyPackage" value="<?php echo $package_value->Package_ID; ?>"/>
                                                          <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                                                            <p><strong><center>SET A</center></strong></p>
                                                            <p style="font-size:15px">• (2) L-Gluthathione Capsule 60's</br>
                                                            • (4) Assorted Soap </br><span style="font-size:10px">(KOJIC,TEA TREE&GLUTA SOAP)</span></p>
                                                            <center><input type="radio" id="wealthyA" name="packaged" value="Package A" style="height:20px; width:25px" required></center>
                                                          </div>
                                                          <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                                                            <p><strong><center>SET B</center></strong></p>
                                                            <p style="font-size:15px">• (1) L-Gluthathione Capsule 60's</br>
                                                            • (1) Obagi Set</br>
                                                            • (11) Assorted Soap<br/><span style="font-size:10px">(KOJIC, TEA TREE & GLUTA SOAP)</span></p>
                                                            <center><input type="radio" id="wealthyB" name="packaged" value="Package B" style="height:20px; width:25px"></center>
                                                          </div>
                                                        </div>
                                                        <div class="form-group">
                                                          <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                                                            <p><strong><center>SET C</center></strong></p>
                                                            <p style="font-size:15px">• (8) Barley Grass Juice</p>
                                                            <center><input type="radio" id="wealthyC" name="packaged" value="Package C" style="height:20px; width:25px"></center>
                                                          </div>
                                                          <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                                                            <p><strong><center>SET D</center></strong></p>
                                                            <p style="font-size:15px">• (13) Garcinia Cambogia Juice</p>
                                                            <center><input type="radio" id="wealthyD" name="packaged" value="Package D" style="height:20px; width:25px;"></center>
                                                          </div>
                                                        </div>
                                                      <?php endif ?> -->

                                                      <div class="form-group text-right" style="margin-top: -20px;">
                                                        <button type="submit" class="btn btn-primary" name="btnsubmit">SUBMIT</button>
                                                        <input type="hidden" class="form-control" name="inputCountry" id="inputCountry" value="<?php echo $location; ?>"/>
                                                        <input type="hidden" class="form-control" name="inputPackageType" id="inputPackageType" value="<?php echo $package_value->Package_ID; ?>"/>
                                                        <textarea name="inputPackageInfo" id="inputPackageInfo" style="display:none;"><?php echo $hid_package_info; ?></textarea>
                                                      </div>
                                                    </form>
                                                    </div>
                                                      <div id="imagemodal" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                          <div class="modal-content">
                                                            <div class="modal-body">
                                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                              <img id="packageImageModal" src="" alt="" style="width:100%; height:auto;">
                                                            </div>
                                <!--                        <div class="modal-footer">
                                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div> -->
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <div class="col-4 col-sm-12 col-md-12 col-lg-4">
                                                        <div class="caption"><?php echo $items['P_DATA'][$package_value->Package_ID]['pdesc'] ?></div>
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
                                                                <?php if($package_value->Package_ID == 7):?>
                                                                  <th>Paylite Package</th>
                                                                <?php endif ?>
                                                                <?php if($package_value->Package_ID == 8):?>
                                                                  <th>Pinoy Package</th>
                                                                <?php endif ?>
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

                                                                if($package_value->Package_ID == 7){
                                                                  echo "<td>";
                                                                  echo $transdata[$i]['packages'];
                                                                  echo "</td>";
                                                                }
                                                                
                                                                if($package_value->Package_ID == 8){
                                                                  echo "<td>";
                                                                  echo $transdata[$i]['packages'];
                                                                  echo "</td>";
                                                                }

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
                            <textarea name="inputPackageInfo999" id="inputPackageInfo999" style="display:none;"><?php echo json_encode($package_info); ?></textarea>
                            <textarea name="inputHidPackageInfo999" id="inputHidPackageInfo999" style="display:none;"><?php echo $hid_package_info; ?></textarea>
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

              $(document).ready(function(){  
                var packageID = $('#paylitePackage').val();
                if(packageID != 7){
                  $('#payliteA').removeAttr('required');
                }
                var packageID2 = $('#pinoyPackage').val();
                if(packageID2 != 8){
                  $('#pinoyA').removeAttr('required');
                }
                var packageID3 = $('#wealthyPackage').val();
                if(packageID3 != 9){
                  $('#wealthyA').removeAttr('required');
                }
                
              });

              $(document).on("click",".openImage", function (){
                var modalimage = $(this).data('id');
                $(".modal-body #packageImageModal").attr("src",modalimage);
              });

              function rmdiscount(){
                var checkBox = document.getElementById("discounts");
                if (checkBox.checked == true){
                  $('.disc').attr("hidden",false);
                }else{
                  $('.disc').attr("hidden",true);
                }
              }
            </script>
              </div>     