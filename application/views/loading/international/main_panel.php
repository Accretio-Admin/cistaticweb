<div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <center><i class="fa fa-mobile-phone"></i></center>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>Loading</li>
                                </ul>
                                <h4>INTERNATIONAL</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    <div class="contentpanel">

                        <div class="row row-stat">
                            <div class="col-sm-9 col-md-9">
                                <div class="tab-content nopadding noborder">
                                    <div class="tab-pane active" id="activities">
                                        <div class="follower-list">  
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="row media-manager">

                                                    <?php if ($user['A_CTRL']['intl_airtime_loading'] == 1 && $user['A_CTRL']['sgd_loading'] == 1): ?>
                                                    <!-- <div class="col-xs-6 col-sm-6 col-md-3 document"> -->
                                                        <!-- <div class="thmb" > -->
                                                          <!-- <div class="thmb-prev  text-center"> -->
                                                            <!-- <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>international_loading/Sgd_loading_new/" class="" id="aloading"> -->
                                                                <!-- <img  src="<?php echo BASE_URL() ?>assets/images/loading/singapore_load_new.png" class="img-responsive" alt="" style= "margin:0 auto"> -->
                                                            <!-- </a> -->
                                                          <!-- </div> -->
                                                          <!-- <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>international_loading/Sgd_loading_new/" id="aloading">SGD LOADING</a></h5> -->
                                                        <!-- </div> -->
                                                     <!-- </div> -->
                                                     <!-- <?php endif ?>  -->

                                                    <?php if ($user['A_CTRL']['intl_airtime_loading'] == 1 && $user['A_CTRL']['etisalat_loading'] == 1): ?>
                                                     <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>international_loading/etisalat/" id="aloading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/loading/etisalat_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>international_loading/etisalat/" id="aloading">ETISALAT</a></h5>
                                                        </div><!-- thmb -->
                                                     </div> 
                                                     <?php endif ?>

                                                     <?php if ($user['A_CTRL']['intl_airtime_loading'] == 1 && $user['A_CTRL']['uae_loading'] == 1): ?>
                                                     <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>international_loading_paythem?country=uae" id="aloading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/loading/special_load_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>international_loading_paythem?country=uae" id="aloading">UAE LOADING</a></h5>
                                                        </div>
                                                     </div> 
                                                     <?php endif ?>

                                                    <?php if ($user['A_CTRL']['intl_airtime_loading'] == 1 && $user['A_CTRL']['qar_loading'] == 1): ?>
                                                     <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>international_loading_paythem?country=qatar" id="aloading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/loading/special_load_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>international_loading_paythem?country=qatar" id="aloading">QAR LOADING</a></h5>
                                                        </div>
                                                     </div> 
                                                      <?php endif ?>

                                                    <?php if ($user['A_CTRL']['intl_airtime_loading'] == 1 && $user['A_CTRL']['hkd_loading'] == 1): ?>
                                                     <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>international_loading/hkd_loading/" id="aloading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/loading/special_load_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>international_loading/hkd_loading/" id="aloading">HKD LOADING</a></h5>
                                                        </div>
                                                     </div> 
                                                    <?php endif ?>

                                                    <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                      <div class="thmb" >
                                                        <div class="thmb-prev  text-center">
                                                          <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>buy_load/ding" class="" id="aloading">
                                                            <img  src="<?php echo BASE_URL() ?>assets/images/loading/regular_load_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                          </a>
                                                        </div>
                                                        <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>buy_load/ding" id="aloading">INTERNATIONAL LOADING</a></h5>
                                                      </div>
                                                    </div>
                                                    <!-- TEST USER F1526245 F1359252 F9687521 F8901916 -->
                                                    <?php if ($user['R'] == '1234567' || $user['R'] == 'F1526245' || $user['R'] == 'F1359252' || $user['R'] == 'F9687521' || $user['R'] == 'F8901916'): ?>
                                                      <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                        <div class="thmb" >
                                                          <div class="thmb-prev text-center">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>buy_load/anypay" class="" id="aloading">
                                                              <img  src="<?php echo BASE_URL() ?>assets/images/loading/regular_load_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>buy_load/anypay" id="aloading">MYR LOADING</a></h5>
                                                        </div>
                                                      </div>
                                                      <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                        <div class="thmb" >
                                                          <div class="thmb-prev text-center">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>buy_load/npn" class="" id="aloading">
                                                              <img  src="<?php echo BASE_URL() ?>assets/images/loading/regular_load_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>buy_load/npn" id="aloading">SGD LOADING</a></h5>
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