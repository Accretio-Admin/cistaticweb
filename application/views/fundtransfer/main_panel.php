
<div class="mainpanel">

                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-mobile-phone"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>FUND TRANSFER</li>
                                </ul>
                                <h4>FUND TRANSFER</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    <div class="contentpanel">

                        <div class="row row-stat">
                            <div class="col-sm-9 col-md-9">
                                <div class="tab-content nopadding noborder">
                                    <div class="tab-pane active" id="activities">
                                        <div class="follower-list">  
                                            <div class="col-sm-12">
                                                <div class="row media-manager">
                                                    <?php if (($user['A_CTRL']['fundrequest'] == 1 || $user['A_CTRL']['fund_request'] == 1) && $user['A_CTRL']['fund_request_universal'] == 1): ?>
                                                    <div class="col-xs-6 col-sm-4 col-md-4 document">
                                                        <div class="thmb" >
                                                          <div class="thmb-prev  text-center">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Fundtransfer/load_wallet/" class="" id="aloading">
                                                                <img  src="<?php echo BASE_URL() ?>assets/images/loading/loadwallet_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Fundtransfer/load_wallet/" id="aloading">UNIVERSAL LOAD WALLET</a></h5>
                                                        </div><!-- thmb -->
                                                     </div>   
                                                     <?php endif ?>
                                                     <?php if ($user['A_CTRL']['fundrequest'] == 1 || $user['A_CTRL']['fund_request'] == 1 && $user['A_CTRL']['fundrequest'] == 1): ?>
                                                     <div class="col-xs-6 col-sm-4 col-md-4 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Fundtransfer/fund_transfer/" id="aloading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/loading/fund_request_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>fundtransfer/fund_transfer/" id="aloading">FUND REQUEST</a></h5>
                                                        </div><!-- thmb -->
                                                     </div>  
                                                     <?php endif ?>
                                                        
                                                     <?php if ($user['A_CTRL']['fund_request_AED'] == 1): ?>
                                                        <div class="col-xs-6 col-sm-4 col-md-4 document">
                                                          <div class="thmb">
                                                            <div class="thmb-prev">
                                                              <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>fundtransfer/aed_fund/" id="aloading">
                                                                  <img src="<?php echo BASE_URL() ?>assets/images/loading/special_load_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                              </a>
                                                            </div>
                                                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>fundtransfer/aed_fund/" id="aloading">AED FUND</a></h5>
                                                          </div>
                                                        </div>
                                                        <?php endif ?> 
                                                        
                                                        <?php if ($user['A_CTRL']['fund_request_QAR'] == 1): ?>  
                                                        <div class="col-xs-6 col-sm-4 col-md-4 document">
                                                          <div class="thmb">
                                                            <div class="thmb-prev">
                                                              <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>fundtransfer/qatar_fund/" id="aloading">
                                                                  <img src="<?php echo BASE_URL() ?>assets/images/loading/special_load_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                              </a>
                                                            </div>
                                                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>fundtransfer/qatar_fund/" id="aloading">QATAR FUND</a></h5>
                                                          </div>
                                                        </div> 
                                                    <?php endif ?> 

                                                    <?php if (($user['A_CTRL']['fundrequest'] == 1 || $user['A_CTRL']['fund_request'] == 1) && $user['A_CTRL']['purchase_ewallet'] == 1): ?>
                                                      <div class="col-xs-6 col-sm-4 col-md-4 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>fundtransfer/creditcard_topup/" id="aloading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/loading/prepaid_load_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>fundtransfer/creditcard_topup/" id="aloading">PURCHASE UNIFIED E-WALLET</a></h5>
                                                        </div><!-- thmb -->
                                                     </div>  
                                                    <?php endif ?> 
                                                    
                                                    
                                                    <?php if (($user['A_CTRL']['fundrequest'] == 1 || $user['A_CTRL']['fund_request'] == 1) && $user['A_CTRL']['fundrequest_DP'] == 1): ?>
                                                      <div class="col-xs-6 col-sm-4 col-md-4 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>fundtransfer/dragonpay_topup/" id="aloading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/loading/fundtransfer-dragonpay2.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>fundtransfer/dragonpay_topup/" id="aloading">ECASH RELOAD THRU DRAGONPAY</a></h5>
                                                        </div><!-- thmb -->
                                                     </div>  
                                                    <?php endif ?>
                                                    

                                                     <?php if ($user['A_CTRL']['fund_request_HKD'] == 1): ?>
                                                        <div class="col-xs-6 col-sm-4 col-md-4 document">
                                                          <div class="thmb">
                                                            <div class="thmb-prev">
                                                              <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>fundtransfer/hkd_fund/" id="aloading">
                                                                  <img src="<?php echo BASE_URL() ?>assets/images/loading/special_load_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                              </a>
                                                            </div>
                                                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>fundtransfer/hkd_fund/" id="aloading">HKD FUND</a></h5>
                                                          </div>
                                                        </div>
                                                    <?php endif ?> 

                                                    <?php if ($user['A_CTRL']['fund_request_ForexEcash'] == 1): ?>
                                                        <!-- <div class="col-xs-6 col-sm-4 col-md-4 document">
                                                          <div class="thmb">
                                                            <div class="thmb-prev">
                                                              <a style="background-color: #fff;" href="<?php //echo BASE_URL() ?>fundtransfer/forextoecash" id="aloading">
                                                                  <img src="<?php //echo BASE_URL() ?>assets/images/ecash_send/ecash_to_sgd_load_fund_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                              </a>
                                                            </div>
                                                            <h5 class="fm-title text-center"><a href="<?php //echo BASE_URL() ?>fundtransfer/forextoecash" id="aloading">FOREX CURRENCY TO ECASH</a></h5>
                                                          </div> 
                                                        </div> -->

                                                        <div class="col-xs-6 col-sm-4 col-md-4 document">
                                                          <div class="thmb">
                                                            <div class="thmb-prev">
                                                              <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>fundtransfer/forextoecash_new" id="aloading">
                                                                  <img src="<?php echo BASE_URL() ?>assets/images/ecash_send/ecash_to_sgd_load_fund_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                              </a>
                                                            </div> 
                                                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>fundtransfer/forextoecash_new" id="aloading">FOREX ECASH TRANSFER</a></h5>
                                                          </div>
                                                        </div>
                                                    <?php endif ?> 


                                                    <?php if ($user['A_CTRL']['fund_request_SGD'] == 1): ?>
                                                        <div class="col-xs-6 col-sm-4 col-md-4 document">
                                                          <div class="thmb">
                                                            <div class="thmb-prev">
                                                              <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>fundtransfer/sgd_fund/" id="aloading">
                                                                  <img src="<?php echo BASE_URL() ?>assets/images/loading/special_load_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                              </a>
                                                            </div>
                                                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>fundtransfer/sgd_fund/" id="aloading">SGD FUND</a></h5>
                                                          </div>
                                                        </div>
                                                    <?php endif ?> 

                                                   <!-- <?php if ($user['A_CTRL']['fundrequest'] == 1 || $user['A_CTRL']['fund_request'] == 1 && $user['A_CTRL']['ecash_fundtransfer_v1v3'] == 1): ?>
                                                      <div class="col-xs-6 col-sm-4 col-md-4 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>fundtransfer/ecashv1_fundtransfer_v3" id="aloading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/ecash_send/ecash_to_load_fund_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div> 
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>fundtransfer/ecashv1_fundtransfer_v3" id="aloading">ECASH V1 FUND TRANSFER TO V3</a></h5>
                                                        </div><!-- thmb -->
                                                      <!-- </div>
                                                    <?php endif ?> -->

                                                    <?php if ($user['A_CTRL']['fund_request_MYR'] == 1): ?>
                                                        <div class="col-xs-6 col-sm-4 col-md-4 document">
                                                          <div class="thmb">
                                                            <div class="thmb-prev">
                                                              <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>fundtransfer/myr_fund/" id="aloading">
                                                                  <img src="<?php echo BASE_URL() ?>assets/images/loading/special_load_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                              </a>
                                                            </div>
                                                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>fundtransfer/myr_fund/" id="aloading">MYR FUND</a></h5>
                                                          </div>
                                                        </div>
                                                    <?php endif ?> 

                                                 </div>
                                             </div>      
                                        </div><!-- activity-list -->

                                    </div><!-- tab-pane -->

                                </div>
                            </div><!-- col-md-8 -->
                        </div><!-- row -->

                    </div><!-- contentpanel -->
                    
                </div><!-- mainpanel -->            