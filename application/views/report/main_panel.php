<div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-money"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>REPORT</li>
                                </ul>
                                <h4>REPORT</h4>
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
                                                <?php if($retailer != 1): ?>
                                                    <div class="col-xs-6 col-sm-4 col-md-3 document">
                                                        <div class="thmb" >
                                                          <div class="thmb-prev  text-center">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL()?>Report/general_report" class="" id="aloading">
                                                                <img  src="<?php echo BASE_URL() ?>assets/images/reports/general_reports.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL()?>Report/general_report">GENERAL REPORT</a></h5>
                                                        </div><!-- thmb -->
                                                     </div>   
                                                     <div class="col-xs-6 col-sm-4 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL()?>Report/ecash" id="aloading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/reports/remittance_send.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL()?>Report/ecash">REMITTANCE SEND</a></h5>
                                                        </div><!-- thmb -->
                                                     </div>   
                                                     <div class="col-xs-6 col-sm-4 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL()?>Report/ecash_payout" id="aloading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/reports/remittance_send.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL()?>Report/ecash_payout">REMITTANCE PAYOUT</a></h5>
                                                        </div><!-- thmb -->
                                                     </div>   
                                                     <div class="col-xs-6 col-sm-4 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL()?>Report/bills_payment" id="aloading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/reports/bills_payment.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL()?>Report/bills_payment">BILLS PAYMENT</a></h5>
                                                        </div><!-- thmb -->
                                                     </div>
                                                  <?php endif ?>
                                                       <div class="col-xs-6 col-sm-4 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL()?>Report/loading" id="aloading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/reports/online_purchase.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL()?>Report/loading">LOADING</a></h5>
                                                        </div><!-- thmb -->
                                                     </div> 
                                                  <?php if($retailer != 1): ?>
                                                       <div class="col-xs-6 col-sm-4 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL()?>Report/einsurance_report" id="aloading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/billspayment/insurance_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL()?>Report/einsurance_report">PERSONAL ACCIDENT INSURANCE</a></h5>
                                                        </div><!-- thmb -->
                                                     </div> 

                                                       <div class="col-xs-6 col-sm-4 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL()?>Report/ctpl_report" id="aloading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/billspayment/insurance_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL()?>Report/ctpl_report">COMPULSORY THIRD PARTY LIABILITY INSURANCE</a></h5>
                                                        </div><!-- thmb -->
                                                     </div> 
                                                  <?php endif ?>

                                                    <div class="col-xs-6 col-sm-4 col-md-3 document">
                                                        <div class="thmb">
                                                            <div class="thmb-prev">
                                                                <a style="background-color: #fff;" href="<?php echo BASE_URL()?>Report/aed_fund" id="aloading">
                                                                    <img src="<?php echo BASE_URL() ?>assets/images/loading/special_load_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                                </a>
                                                            </div>
                                                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL()?>Report/aed_fund">AED FUND</a></h5>
                                                        </div><!-- thmb -->
                                                    </div>

                                                    <div class="col-xs-6 col-sm-4 col-md-3 document">
                                                        <div class="thmb">
                                                            <div class="thmb-prev">
                                                                <a style="background-color: #fff;" href="<?php echo BASE_URL()?>Report/qatar_fund" id="aloading">
                                                                    <img src="<?php echo BASE_URL() ?>assets/images/loading/special_load_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                                </a>
                                                            </div>
                                                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL()?>Report/qatar_fund">QATAR FUND</a></h5>
                                                        </div><!-- thmb -->
                                                    </div>

                                                    <div class="col-xs-6 col-sm-4 col-md-3 document">
                                                        <div class="thmb">
                                                            <div class="thmb-prev">
                                                                <a style="background-color: #fff;" href="<?php echo BASE_URL()?>Report/hkd_fund" id="aloading">
                                                                    <img src="<?php echo BASE_URL() ?>assets/images/loading/special_load_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                                </a>
                                                            </div>
                                                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL()?>Report/hkd_fund">HKD FUND</a></h5>
                                                        </div><!-- thmb -->
                                                    </div>

                                                    <div class="col-xs-6 col-sm-4 col-md-3 document">
                                                        <div class="thmb">
                                                            <div class="thmb-prev">
                                                                <a style="background-color: #fff;" href="<?php echo BASE_URL()?>Report/sgd_fund" id="aloading">
                                                                    <img src="<?php echo BASE_URL() ?>assets/images/loading/special_load_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                                </a>
                                                            </div>
                                                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL()?>Report/sgd_fund">SGD FUND</a></h5>
                                                        </div><!-- thmb -->
                                                    </div>

                                                    <div class="col-xs-6 col-sm-4 col-md-3 document">
                                                        <div class="thmb">
                                                            <div class="thmb-prev">
                                                                <a style="background-color: #fff;" href="<?php echo BASE_URL()?>Report/mcwd" id="aloading">
                                                                    <img src="<?php echo BASE_URL() ?>assets/images/loading/special_load_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                                </a>
                                                            </div>
                                                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL()?>Report/mcwd">MCWD</a></h5>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-6 col-sm-4 col-md-3 document">
                                                        <div class="thmb">
                                                            <div class="thmb-prev">
                                                                <a style="background-color: #fff;" href="<?php echo BASE_URL()?>Report/forexecash_transfer" id="aloading">
                                                                    <img src="<?php echo BASE_URL() ?>assets/images/loading/special_load_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                                </a>
                                                            </div>
                                                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL()?>Report/forexecash_transfer">FOREX ECASH TRANSFER</a></h5>
                                                        </div><!-- thmb -->
                                                    </div>

                                                    <div class="col-xs-6 col-sm-4 col-md-3 document">
                                                        <div class="thmb">
                                                            <div class="thmb-prev">
                                                                <a style="background-color: #fff;" href="<?php echo BASE_URL()?>Report/hotel_booking" id="aloading">
                                                                    <img src="<?php echo BASE_URL() ?>assets/images/loading/special_load_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                                </a>
                                                            </div>
                                                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL()?>Report/hotel_booking">HOTEL BOOKING</a></h5>
                                                        </div><!-- thmb -->
                                                    </div>

                                                    <div class="col-xs-6 col-sm-4 col-md-3 document">
                                                        <div class="thmb">
                                                            <div class="thmb-prev">
                                                                <a style="background-color: #fff;" href="<?php echo BASE_URL()?>Report/hotel_reports" id="aloading">
                                                                    <img src="<?php echo BASE_URL() ?>assets/images/loading/special_load_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                                </a>
                                                            </div>
                                                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL()?>Report/hotel_reports">HOTEL GENERAL REPORTS</a></h5>
                                                        </div><!-- thmb -->
                                                    </div>

                                                    <div class="col-xs-6 col-sm-4 col-md-3 document">
                                                        <div class="thmb">
                                                            <div class="thmb-prev">
                                                                <a style="background-color: #fff;" href="<?php echo BASE_URL()?>Report/metroturf" id="aloading">
                                                                    <img src="<?php echo BASE_URL() ?>assets/images/loading/special_load_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                                </a>
                                                            </div>
                                                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL()?>Report/metroturf">METRO TURF</a></h5>
                                                        </div>
                                                    </div>
                                                    <!-- added by rene -->
                                                    <div class="col-xs-6 col-sm-4 col-md-3 document">
                                                        <div class="thmb">
                                                            <div class="thmb-prev">
                                                                <a style="background-color: #fff;" href="<?php echo BASE_URL()?>Report/unified" id="aloading">
                                                                    <img src="<?php echo BASE_URL() ?>assets/images/loading/special_load_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                                </a>
                                                            </div>
                                                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL()?>Report/unified">UNIFIED V1 to V3</a></h5>
                                                        </div>
                                                    </div>
                                                    <!-- added by rene -->
                                                    <div class="col-xs-6 col-sm-4 col-md-3 document">
                                                        <div class="thmb">
                                                            <div class="thmb-prev">
                                                                <a style="background-color: #fff;" href="<?php echo BASE_URL()?>Report/gocabv1" id="aloading">
                                                                    <img src="<?php echo BASE_URL() ?>assets/images/loading/special_load_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                                </a>
                                                            </div>
                                                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL()?>Report/gocabv1">GO CAB CASH-IN AND CASH-OUT</a></h5>
                                                        </div>
                                                    </div>

                                                    <?php if ($user['A_CTRL']['fund_request'] == 1 && $user['A_CTRL']['fund_request_MYR'] == 1): ?>
                                                      <div class="col-xs-6 col-sm-4 col-md-3 document">
                                                          <div class="thmb">
                                                              <div class="thmb-prev">
                                                                  <a style="background-color: #fff;" href="<?php echo BASE_URL()?>Report/myr_fund" id="aloading">
                                                                      <img src="<?php echo BASE_URL() ?>assets/images/loading/special_load_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                                  </a>
                                                              </div>
                                                              <h5 class="fm-title text-center"><a href="<?php echo BASE_URL()?>Report/myr_fund">MYR FUND</a></h5>
                                                          </div><!-- thmb -->
                                                      </div>
                                                    <?php endif ?> 

                                                    <!-- Report/ticketing -->
<!--                                                      <div class="col-xs-6 col-sm-4 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="#"> 
                                                                <img src="<?php echo BASE_URL() ?>assets/images/reports/ticketing.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="#">TICKETING</a></h5>
                                                        </div>
                                                     </div>  
-->

                                                    <!-- Report/online_purchase -->
<!--                                                      <div class="col-xs-6 col-sm-4 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="#">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/reports/online_purchase.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="#">ONLINE PURCHASED</a></h5>
                                                        </div>
                                                     </div>

-->
                                                 </div>
                                             </div>      
                                        </div><!-- activity-list -->

                                    </div><!-- tab-pane -->

                                </div>
                            </div><!-- col-md-8 -->
                        </div><!-- row -->
                    </div><!-- contentpanel -->
                </div><!-- mainpanel -->         