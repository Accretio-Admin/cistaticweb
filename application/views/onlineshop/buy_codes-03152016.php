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
                                <h4>BUY CODES</h4>
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
                                                  <div class="col-xs-8 col-md-12">
                                                  <?php if ($API['S'] === 0 || $API['S'] === '0' ): ?>
                                                      <div class="alert alert-danger"><?php echo $API['M'] ?></div>
                                                  <?php elseif ($API['S'] === 1 || $API['S'] === '1' ): ?>
                                                      <div class="alert alert-success"><?php echo $API['M'] ?></div>
                                                  <?php endif ?>
                                                  <b>Please choose a package:</b>
                                                  <hr />
                                                      <!--THUMBNAIL--> 
<!--                                                       <div class="row">
                                                        <div class="col-sm-6 col-md-4">
                                                        <a href="#" id="buycodelink" data-desc="Global Dealer Package" >
                                                          <div class="thumbnail">
                                                            <img class="logo-package" src="<?php echo BASE_URL()?>assets/images/global_package.png" alt="UPS">
                                                            <div class="caption">
                                                              <h5 class="text-center" style="color:#FF9900"><b>Tangible Global Package</b></h5>
                                                              <p> - Set of Tangible Products(Package A, B, C, D)
                                                                    <br/> - 30% Lifetime Discount
                                                                    <br/> - 20 Bills payment per month
                                                                    <br/> - 100,000 Personal Accident Insurance
                                                                    <br/>- Personal ECASH SYSTEM
                                                                    <br/> - 50 tickets Local and International a month
                                                                    <br/>- E- Loading Business (all networks)
                                                                    <br/>- ECASH (Ecash2Ecash, E-cash to Load Fund, E-cash to myvisacard, E-cash to GPRS outlet)"
                                                                    <br/>- Marketing Materials (Brochures and Flyers)</p>
                                                            </div>
                                                          </div>
                                                         </a>
                                                        </div>
                                                         <div class="col-sm-6 col-md-4">
                                                        <a href="#" id="buycodelink" data-desc="Global Dealer Package" >
                                                          <div class="thumbnail">
                                                            <img class="logo-package" src="<?php echo BASE_URL()?>assets/images/dealer_package.png" alt="UPS">
                                                            <div class="caption">
                                                              <h5 class="text-center" style="color:#FF9900"><b>Tangible Dealer Package</b></h5>
                                                                 <p> Set of Tangible Products(Package A, B, C, D)
                                                                    <br/> - 30% Lifetime Discount
                                                                    <br/> - 100,000 Personal Accident Insurance
                                                                    <br/> - Personal ECASH SYSTEM
                                                                    <br/>- 20 Bills payment per month
                                                                    <br/> - 50 Local tickets a month
                                                                    <br/>- E- Loading Business (all networks)
                                                                    <br/>- ECASH (Ecash2Ecash, E-cash to Load Fund, E-cash to myvisacard, E-cash to GPRS outlet)
                                                                    <br/>- Marketing Materials (Brochures and Flyers)
                                                            </div>
                                                          </div>
                                                         </a>
                                                        </div>
                                                      </div> -->
                                                      <!--THUMBNAIL-->
                                                         <!--THUMBNAIL--> 
                                                      <div class="row">
                                                        <div class="col-sm-6 col-md-4">
                                                        <a href="#" id="buycodelink1" data-desc="Global Dealer Package" >
                                                          <div class="thumbnail">
                                                            <img class="logo-package" src="<?php echo BASE_URL()?>assets/images/global_package.png" alt="UPS">
                                                            <div class="caption">
                                                              <h5 class="text-center" style="color:#FF9900"><b>Global Dealer Package</b></h5>
                                                              <p style="text-align: center"><b>Price:</b> &#8369 14,998.00</p>
                                                              <p> 1. Webtool account (for internet loading and inventory system) <br />
                                                                  2. Loading <br />
                                                                  3. Local and International Remittance <br />
                                                                  4. E-Cash (loading and Interntional) <br />
                                                                  5. Bills Payment Facility <br />
                                                                  6. Domestic and International Online Ticketing <br />
                                                                  7. Insurance
                                                                     &nbsp * One year coverage <br />
                                                                     &nbsp * Accidental death, dismemberment &/or disablement for Php60k <br />
                                                                     &nbsp * Burial assistance (following accidental death) Php6k <br />
                                                                  8. Online Shopping (included but to follow) <br />
                                                                  9. Hotel And Resorts Booking (included but to follow) <br />
                                                                  10. Tarpaulin (1) <br />
                                                                  11. Flyers (10pcs)</p>
                                                            </div>
                                                          </div>
                                                         </a>
                                                        </div>
                                                         <div class="col-sm-6 col-md-4">
                                                        <a href="#" id="buycodelink2" data-desc="Pinoy Dealer Package" >
                                                          <div class="thumbnail">
                                                            <img class="logo-package" src="<?php echo BASE_URL()?>assets/images/dealer_package.png" alt="UPS">
                                                            <div class="caption">
                                                              <h5 class="text-center" style="color:#FF9900"><b>Pinoy Dealer Package</b></h5>
                                                              <p style="text-align: center"><b>Price:</b> &#8369 7,998.00</p>
                                                                  <p>  1. Loading <br />
                                                                       2. Bills Payment (Maximum of 10 Transactions per day) <br/>
                                                                       3. Ecash (Local and International) <br/>
                                                                       4. Hotel Accommodation (Included but to follow) <br/>
                                                                       5. Insurance <br/>
                                                                          &nbsp * One year coverage <br/>
                                                                          &nbsp * Accidental Death, Dismemberment &/or Disablement for Php 60k" <br/>
                                                                          &nbsp * Burial Assistance (following accidental death) Php 6k <br/>
                                                                       6. 5 pcs. Three-fold Leaflets ( UPS Brochure) <br/>
                                                                       7. Tarpaulin (1)
                                                                  </p>
                                                            </div>
                                                          </div>
                                                         </a>
                                                        </div>
                                                      </div>
                                                      <!--THUMBNAIL-->
                                                   </div> 
                                                </div>  
                                             </div>      
                                        </div><!-- activity-list -->

                                    </div><!-- tab-pane -->

                                </div>
                            </div><!-- col-md-8 -->
                        </div><!-- row -->

                    </div><!-- contentpanel -->
                   

                    <!-- Modal -->
                      <div class="modal fade" id="buycodemodal" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                          <form action ="<?php echo BASE_URL()?>Online_shop/buy_codes" method="post">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"></h4>
                            </div>
                            <div class="modal-body">
                                  <div class="form-group">
                                  <input type="text" class="form-control" name ="inputCountry" id="inputCountry" value="Philippines" readonly />
                                  </div>
                                  <div class="form-group">
                                    <input type="text" class="form-control" name ="inputClient" id ="inputClient" placeholder="Client's Name" />
                                  </div>
                                  <div class="form-group">
                                    <input type="email" class="form-control" name ="inputClientemail" id ="inputClientemail" placeholder="Client's Email Address" />
                                  </div>
                                  <div class="form-group">
                                    <input type="text" class="form-control" name ="inputMobno" name ="inputMobno" placeholder="Mobile Number" />
                                  </div>
                                  <div class="form-group">
                                    <input type="password" class="form-control" name ="inputTpass" id ="inputTpass" placeholder="Transaction Password" />
                                  </div>
                                  <div class="form-group">
                                    <input type="hidden" class="form-control" name ="inputPackageType" id ="inputPackageType" readonly="" />
                                  </div>
                            </div>
                            <div class="modal-footer">
                              <div class="row">
                                <div class="col-xs-6 col-md-6 text-left">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                </div>
                                <div class="col-xs-6 col-md-6">
                                  <button type="submit" class="btn btn-primary" name="btnsubmit" >SUBMIT</button>
                                </div>
                              </div>
                              
                            </div>
                           </form>
                          </div><!--CONTENT -->
                          
                        </div>
                      </div>
                   
                    
    </div><!-- mainpanel -->            