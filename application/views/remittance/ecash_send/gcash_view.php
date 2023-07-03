  <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-money"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>REMITTANCE</li>
                                </ul>
                                <h4>E-CASH SEND</h4>
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
                                                    <?php if($user['R'] == '1234567' || $user['R'] == '1234504'): ?>
                                                     <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_send/gcashcashin" id="aloading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/ecash_send/ecash_to_ecash_new.png" class="img-responsive" alt="">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center" nowrap><a href="<?php echo BASE_URL() ?>ecash_send/gcashcashin">G-Cash Cash In</a></h5>
                                                        </div><!-- thmb -->
                                                     </div>
                                                    <?php endif ?>

                                                    <?php if($user['R'] == '1234567' || $user['R'] == '1234504'): ?>
                                                     <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_send/gcashcashin_checkref" id="aloading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/ecash_send/ecash_to_ecash_new.png" class="img-responsive" alt="">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center" nowrap><a href="<?php echo BASE_URL() ?>ecash_send/gcashcashin_checkref">G-Cash Cash In Check Ref</a></h5>
                                                        </div><!-- thmb -->
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