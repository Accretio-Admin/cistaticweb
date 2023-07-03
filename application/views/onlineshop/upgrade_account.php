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
                                <h4>UPGRADE ACCOUNT </h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    

                    
                    <div class="contentpanel">
                    <?php if ($process['S']===0): ?>
                    		<div class="alert alert-danger"><?php echo $process["M"]?></div>
                    <?php endif ?>
                    <?php if ($process['S']==1): ?>
                    		<div class="alert alert-success"><?php echo $process["M"]?></div>
                    <?php endif ?>
                    <?php if ($result['S']===0): ?>
                        <div class="alert alert-danger"><?php echo $result["M"]?></div>
                    <?php endif ?>
                        <div class="row row-stat">
                            <div class="col-sm-12 col-md-12">
                                <div class="tab-content nopadding noborder">
                                    <div class="tab-pane active" id="activities">
                                        <div class="follower-list">  
                                            <div class="col-sm-12">
                                                <div class="row">
                                                  <div class="col-xs-8 col-md-12">

                                                  <?php if($checkaccounttype['M'] == "GLOBAL"){ ?>
                                                  <b>No package available.</b>
                                                  <?php }else{ ?>
                                                  <b>Please choose a package:</b>
                                                  <?php } ?>
                                                  <hr />
                                                      <!--THUMBNAIL--> 
                                                      <?php if(!isset($type)){ ?>
                                                     <!--THUMBNAIL--> 
                                                     <!-- VISARETAILER -> SUBDEALER -> PINOYDEALER -> GLOBALDEALER --> 
                                                            <div class="row">

                                                            <?php if($checkaccounttype['M'] == "VISARETAILER" || $process['A'] == "VISARETAILER"): ?>

                                                              <div class="col-sm-6 col-md-4">
                                                              <a href="<?php echo BASE_URL()?>Online_shop/upgrade_account/subdealer" data-desc="SubDealer Package" >
                                                                <div class="thumbnail">
                                                                  <img class="logo-package" src="<?php echo BASE_URL()?>assets/images/dealer_package.png" alt="UPS">
                                                                  <div class="caption">
                                                                    <h5 class="text-center" style="color:#FF9900"><b>SubDealer Package (P 3,500.00)</b></h5>
                                                                      <p> 
                                                                          - Loading(Local)<br />
                                                                          • Airtime Loading(Local)<br />
                                                                          • Prepaid Cards(Local)<br />
                                                                          <br />
                                                                          - Billspayment<br />
                                                                          - Insurance<br />
                                                                          • PA<br />
                                                                          • CTPL<br />
                                                                          <br />
                                                                          - Remittance<br />
                                                                          • Ecash To PowerCard<br />
                                                                          • Ecash To Ecash<br />
                                                                          • Ecash Padala(Send and Payout)<br />
                                                                          <br />
                                                                          - Fund Request<br />
                                                                          • Ecash/Loadwallet<br />
                                                                      </p>
                                                                  </div>
                                                                </div>
                                                               </a>
                                                              </div>

                                                            <?php endif; ?>

                                                            <?php if($checkaccounttype['M'] == "VISARETAILER" || $checkaccounttype['M'] == "SUBDEALER"
                                                              || $process['A'] == "VISARETAILER" || $process['A'] == "SUBDEALER"
                                                            ): ?>

                                                              <div class="col-sm-6 col-md-4">
                                                              <a href="<?php echo BASE_URL()?>Online_shop/upgrade_account/dealer" data-desc="Pinoy Dealer Package" >
                                                                <div class="thumbnail">
                                                                  <img class="logo-package" src="<?php echo BASE_URL()?>assets/images/dealer_package.png" alt="UPS">
                                                                  <div class="caption">
                                                                    <h5 class="text-center" style="color:#FF9900"><b>Pinoy Dealer Package (P 4,500.00)</b></h5>
                                                                        <p>  - Loading
                                                                             <br />- Bills Payment (Maximum of 10 Transactions per day)
                                                                             <br/> - Ecash (Local and International)
                                                                             <br/> - Ticketing (Local)
                                                                             <br/> - Hotel Accommodation (Included but to follow)
                                                                             <br/> - Insurance
                                                                             <br/>&nbsp * One year coverage
                                                                             <br/>&nbsp * Accidental Death, Dismemberment &/or Disablement for Php 60k"
                                                                             <br/>&nbsp * Burial Assistance (following accidental death) Php 6k
                                                                             <br/> - 5 pcs. Three-fold Leaflets ( UPS Brochure)
                                                                             <br/>- Tarpaulin
                                                                        </p>
                                                                  </div>
                                                                </div>
                                                               </a>
                                                              </div>

                                                              <?php endif; ?>

                                                              <?php if($checkaccounttype['M'] == "VISARETAILER" || $checkaccounttype['M'] == "SUBDEALER" || $checkaccounttype['M'] == "DEALER" || $process['A'] == "VISARETAILER" || $process['A'] == "SUBDEALER" || $process['A'] == "DEALER"): ?>

                                                              <div class="col-sm-6 col-md-4">
                                                              <a href="<?php echo BASE_URL()?>Online_shop/upgrade_account/global" data-desc="Global Dealer Package" >
                                                                <div class="thumbnail">
                                                                  <img class="logo-package" src="<?php echo BASE_URL()?>assets/images/global_package.png" alt="UPS">
                                                                  <div class="caption">
                                                                    <h5 class="text-center" style="color:#FF9900"><b>Global Dealer Package (P 7,500.00)</b></h5>
                                                                    <p> - Webtool account (for Internet loading and inventory system) <br />
                                                                        - Local and International Remittance <br />
                                                                        - Bills Payment Facility <br />
                                                                        - Domestic and International Online Ticketing <br />
                                                                        - Online Shopping (Included but to follow) <br />
                                                                        - Hotel And Resorts Booking (Included but to follow) <br />
                                                                        - Tarpaulin <br />
                                                                        - Brochures</p>
                                                                  </div>
                                                                </div>
                                                               </a>
                                                              </div>

                                                              <?php endif; ?>

                                                      </div>
                                                      <!--THUMBNAIL-->
                                                
                                                   <?php }else{ ?> <!-- ELSEELSEELSEELSEELSEELSEELSEELSEELSEELSEELSEELSEELSEELSEELSEELSEELSEELSEELSEELSE -->

                                                   <div class="row">

                                                            <?php if($result['K'] == "VISARETAILER" || $process['A'] == "VISARETAILER"): ?>

                                                              <div class="col-sm-6 col-md-4">
                                                              <a href="<?php echo BASE_URL()?>Online_shop/upgrade_account/subdealer" data-desc="SubDealer Package" >
                                                                <div class="thumbnail">
                                                                  <img class="logo-package" src="<?php echo BASE_URL()?>assets/images/dealer_package.png" alt="UPS">
                                                                  <div class="caption">
                                                                    <h5 class="text-center" style="color:#FF9900"><b>SubDealer Package (P 3,500.00)</b></h5>
                                                                        <p> 
                                                                    - Loading(Local)<br />
                                                                          • Airtime Loading(Local)<br />
                                                                          • Prepaid Cards(Local)<br />
                                                                          <br />
                                                                          - Billspayment<br />
                                                                          - Insurance<br />
                                                                          • PA<br />
                                                                          • CTPL<br />
                                                                          <br />
                                                                          - Remittance<br />
                                                                          • Ecash To PowerCard<br />
                                                                          • Ecash To Ecash<br />
                                                                          • Ecash Padala(Send and Payout)<br />
                                                                          <br />
                                                                          - Fund Request<br />
                                                                          • Ecash/Loadwallet<br />
                                                                        </p>
                                                                  </div>
                                                                </div>
                                                               </a>
                                                              </div>

                                                            <?php endif; ?>

                                                            <?php if($result['K'] == "VISARETAILER" || $result['K'] == "SUBDEALER" || $process['A'] == "VISARETAILER" || $process['A'] == "SUBDEALER"): ?>

                                                              <div class="col-sm-6 col-md-4">
                                                              <a href="<?php echo BASE_URL()?>Online_shop/upgrade_account/dealer" data-desc="Pinoy Dealer Package" >
                                                                <div class="thumbnail">
                                                                  <img class="logo-package" src="<?php echo BASE_URL()?>assets/images/dealer_package.png" alt="UPS">
                                                                  <div class="caption">
                                                                    <h5 class="text-center" style="color:#FF9900"><b>Pinoy Dealer Package (P 4,500.00)</b></h5>
                                                                        <p>  - Loading
                                                                             <br />- Bills Payment (Maximum of 10 Transactions per day)
                                                                             <br/> - Ecash (Local and International)
                                                                             <br/> - Ticketing (Local)
                                                                             <br/> - Hotel Accommodation (Included but to follow)
                                                                             <br/> - Insurance
                                                                             <br/>&nbsp * One year coverage
                                                                             <br/>&nbsp * Accidental Death, Dismemberment &/or Disablement for Php 60k"
                                                                             <br/>&nbsp * Burial Assistance (following accidental death) Php 6k
                                                                             <br/> - 5 pcs. Three-fold Leaflets ( UPS Brochure)
                                                                             <br/>- Tarpaulin
                                                                        </p>
                                                                  </div>
                                                                </div>
                                                               </a>
                                                              </div>

                                                              <?php endif; ?>

                                                              <?php if($result['K'] == "VISARETAILER" || $result['K'] == "SUBDEALER" || $result['K'] == "DEALER"
                                                              || $process['A'] == "VISARETAILER" || $process['A'] == "SUBDEALER" || $process['A'] == "DEALER"): ?>

                                                              <div class="col-sm-6 col-md-4">
                                                              <a href="<?php echo BASE_URL()?>Online_shop/upgrade_account/global" data-desc="Global Dealer Package" >
                                                                <div class="thumbnail">
                                                                  <img class="logo-package" src="<?php echo BASE_URL()?>assets/images/global_package.png" alt="UPS">
                                                                  <div class="caption">
                                                                    <h5 class="text-center" style="color:#FF9900"><b>Global Dealer Package (P 7,500.00)</b></h5>
                                                                    <p> - Webtool account (for Internet loading and inventory system) <br />
                                                                        - Local and International Remittance <br />
                                                                        - Bills Payment Facility <br />
                                                                        - Domestic and International Online Ticketing <br />
                                                                        - Online Shopping (Included but to follow) <br />
                                                                        - Hotel And Resorts Booking (Included but to follow) <br />
                                                                        - Tarpaulin <br />
                                                                        - Brochures</p>
                                                                  </div>
                                                                </div>
                                                               </a>
                                                              </div>

                                                              <?php endif; ?>

                                                      </div>

                                                   <?php } ?>
                                                </div>  
                                             </div>      
                                        </div><!-- activity-list -->

                                    </div><!-- tab-pane -->

                                </div>
                            </div><!-- col-md-8 -->
                        </div><!-- row -->

                    </div><!-- contentpanel -->
                   

             
                    
    </div><!-- mainpanel --> 
    <?php if ($result['S'] == 1): ?>
    	<form action= "<?php echo BASE_URL() ?>Online_shop/upgrade_account/<?php echo $type; ?>" method="post">
		<div id="upgrade_accountModal" class="modal fade">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                <h4 class="modal-title">Account Upgrade From  <?php echo $result['F']; ?> to <?php echo $result['T']; ?> </h4>
		            </div>
		            <div class="modal-body">
		                <p>Total Price: <b>P<?php echo $result['P']; ?></b></p>
		                <input type="hidden" name="dtype" value="<?php echo $type; ?>" />
		                 Transaction Password<input type="password"  class="form-control" name="tpass"  />
		            </div>
		            <div class="modal-footer">
		             
		                <button type="submit" name="btnSubmit" class="btn btn-primary">SUBMIT</button>
		            </div>
		        </div>
		    </div>
		</div>
	</form>
	<?php endif ?>
  


		         