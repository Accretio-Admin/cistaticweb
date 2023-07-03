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
                                <h4>HONGKONG LOADING</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    

                    
                    <div class="contentpanel">
<!--                     <?php if ($API['S'] === "0"): ?>
                        <div class="alert alert-danger"><?php echo $API['M']; ?></div>
                    <?php endif ?>
                    <?php if ($API['S'] == 1): ?>
                        <div class="alert alert-info"><?php echo $API['M']; ?></div>
                    <?php endif ?>
                   <?php if ($result['S'] === 0 || $result['S'] === "0"): ?>
                        <div class="alert alert-danger"><?php echo $result['M']; ?></div>
                    <?php endif ?>
                    <?php if ($result['S'] == 1 && $result['TN'] != NULL): ?>
                        <div class="alert alert-success"><b><?php echo $result['M'] ?></b>
                        <p>For the receipt click this <b>Transaction No. : <a href="<?php echo $result['RL'] ?>" target="_blank"><?php echo $result['TN'] ?></b></a></p> -->
<!--                         <p>For the receipt click this <b>Transaction No. :</b> <?php echo $result['TN'] ?> </p>
                        </div>
                    <?php endif ?> -->

                          <div style="display:none; text-align: center;" id="alertDynammic"></div>
                          <div class="row">
                              <div class="col-xs-12  col-md-5">
                               <?php if ($API['S'] == "" || $API['S'] === "0"): ?>
                                <div class="row">
                                    <div class='col-xs-12 col-md-12'>
                                          <form class="frmHKDLoading">
                                                <div class="form-group" >
                                                  <select class="form-control" name="selProd" id="selProd" required>
                                                      <option value="" disabled selected>SELECT PRODUCT</option>
                                                      <?php 
                                                      foreach($denom as $row) {
                                                      echo "<option value=".$row['productcode'].">".$row['productname']."</option>";
                                                      }
                                                      ?>
                                                  </select>
                                                </div>

                                              <div class="form-group">
                                                 <input type="text" class="form-control" name="inputRMobile" id="inputRMobile" maxlength='11' placeholder="MOBILE NO (OPTIONAL)"/>
                                              </div>

                                              <div class="form-group">
                                                 <input type="email" class="form-control" name="inputEmail" id="inputEmail" placeholder="EMAIL ADDRESS" required="" />
                                              </div>
                                              <div class="form-group" id="formTranspass" style="display: none;">
                                                 <input type="password" class="form-control" name="transpass" id="transpass" placeholder="TRANSACTION PASSWORD" />
                                              </div>
                                              <div class="form-group text-center" id="formWhatsCaptcha">
                                                  <h4>What is <?php echo $captcha['code1']  ?> + <?php echo $captcha['code2']  ?> ?</h4>
                                              </div>
                                              <div class="form-group" id="formCaptcha">
                                                 <input type="number" class="form-control" name="inputCaptcha" id="inputCaptcha" placeholder="CAPTCHA CODE" required/>
                                              </div>
                                               <div class="form-group text-right" id="formValidate">
                                                  <button type="submit" class="btn btn-primary"  name="btnValidate" id="btnValidate" value="1">Validate</button>
                                              </div>
                                          </form>
                                           <form id="frmHKD" name="frmHKD" action="<?php echo BASE_URL()?>international_loading/hkd_loading" method="post"> 
                                                <div class="form-group text-right" id="formSubmit" style="display: none;">
                                                  <button type="submit" class="btn btn-primary"  name="btnConfirm" id="btnConfirm">Confirm</button>
                                                </div>
                                           </form>

                                    </div> <!-- col-xs-12 col-md-8-->
                                </div> <!-- row -->
                               <?php endif ?>
                               <?php if ($API['S'] == 1): ?>
                                  <form name="frmetisalatloading" action="<?php echo BASE_URL()?>international_loading/hkd_loading" method="post" id="frmetisalatloading">
                                              <div class="form-group">
                                                 <input type="text" class="form-control" name="selProd" placeholder="PLANCODE" value="<?php echo $input['plancode']; ?>" readonly />
                                              </div>
                                              <div class="form-group" >
                                                 <input type="text" class="form-control" name="inputRMobile" maxlength='11' placeholder="MOBILE NO (OPTIONAL)" value="<?php echo $input['mobile']; ?>" />
                                              </div>
                                              <div class="form-group" >
                                                 <input type="email" class="form-control" name="inputEmail" placeholder="EMAIL ADDRESS" value="<?php echo $input['email']; ?>" required/>
                                              </div>
                                              <div class="form-group">
                                                 <input type="password" class="form-control" name="transpass" placeholder="TRANSACTION PASSWORD" required/>
                                              </div>
                                               <div class="form-group text-right">
                                                  <button type="submit" class="btn btn-primary"  name="btnConfirm">Confirm</button>
                                              </div>
                                          </form>
                               <?php endif ?>
                              </div> <!--col-xs-6 col-md-6-->

                  
                        </div><!-- row -->
                    </div><!-- contentpanel -->
                    
    </div><!-- mainpanel -->            
    <script src="<?php echo BASE_URL()?>assets/js/hkdloading.js"></script>