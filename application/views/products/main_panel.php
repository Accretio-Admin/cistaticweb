  <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-briefcase"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                                    <?php if($mlm_user['user_type'] == 1): ?> 
                                      <li>MLM PRODUCT DISTRIBUTION</li>
                                    <?php else:?> 
                                      <li>MLM PRODUCT SELLING</li>
                                    <?php endif;?>
                                </ul>
                                  <?php if($mlm_user['user_type'] == 1): ?> 
                                    <h4>MLM PRODUCT DISTRIBUTION</h4>
                                  <?php else:?> 
                                    <h4>MLM PRODUCT SELLING</h4>
                                  <?php endif;?>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    <div class="contentpanel">
                        <div class="row row-stat">
                            <div class="col-sm-9 col-md-9">
                            <?php if ($result['S'] == 1): ?>
                                <div class="tab-content nopadding noborder">
                                    <div class="tab-pane active" id="activities">
                                        <div class="follower-list">  
                                            <div class="col-sm-12">
                                                <div class="row media-manager"> 
                                                    <?php if($mlm_user['user_type'] == 1): ?> 
                                                        <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                            <div class="thmb" >
                                                              <div class="thmb-prev  text-center">
                                                                <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Products/ups_tangible_products" class="" id="mlmLoading">
                                                                    <img  src="<?php echo BASE_URL() ?>assets/images/reports/online_purchase.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                                </a>
                                                              </div>
                                                              <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Products/ups_tangible_products" id="mlmLoading">PRODUCT DISTRIBUTION</a></h5>
                                                            </div><!-- thmb -->
                                                        </div>  
                                                        <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                            <div class="thmb" >
                                                              <div class="thmb-prev  text-center">
                                                                <a style="background-color: #fff;" href="<?php echo BASE_URL()?>Products/mlm_ups_reports" class="" id="aloading">
                                                                    <img  src="<?php echo BASE_URL() ?>assets/images/reports/general_reports.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                                </a>
                                                              </div>
                                                              <h5 class="fm-title text-center"><a href="<?php echo BASE_URL()?>Products/mlm_ups_reports">TRANSACTION REPORTS</a></h5>
                                                            </div><!-- thmb -->
                                                        </div> 
                                                    <?php else:?> 
                                                        <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                            <div class="thmb" >
                                                              <div class="thmb-prev  text-center">
                                                                <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Products/hub_products" class="" id="mlmLoading">
                                                                    <img  src="<?php echo BASE_URL() ?>assets/images/reports/online_purchase.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                                </a>
                                                              </div>
                                                              <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Products/hub_products" id="mlmLoading">PRODUCT SELLING</a></h5>
                                                            </div><!-- thmb -->
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                            <div class="thmb" >
                                                              <div class="thmb-prev  text-center">
                                                                <a style="background-color: #fff;" href="<?php echo BASE_URL()?>Products/mlm_hub_reports" class="" id="aloading">
                                                                    <img  src="<?php echo BASE_URL() ?>assets/images/reports/general_reports.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                                </a>
                                                              </div>
                                                              <h5 class="fm-title text-center"><a href="<?php echo BASE_URL()?>Products/mlm_hub_reports">TRANSACTION REPORTS</a></h5>
                                                            </div><!-- thmb -->
                                                        </div> 
                                                        
                                                        <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                            <div class="thmb" >
                                                              <div class="thmb-prev  text-center">
                                                                <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Products/inventory_report" class="" id="mlmLoading">
                                                                    <img  src="<?php echo BASE_URL() ?>assets/images/reports/online_purchase.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                                </a>
                                                              </div>
                                                              <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Products/inventory_report" id="mlmLoading">INVENTORY REPORTS</a></h5>
                                                            </div><!-- thmb -->
                                                        </div>
                                                    <?php endif?>      
                                                 </div>
                                             </div>      
                                        </div><!-- activity-list -->

                                    </div><!-- tab-pane -->
                                </div>
                            <?php elseif ($result['S'] == 0): ?>
                              <div class="alert alert-danger"><?php echo $result['M'] ?></div>
                            <?php endif ?>
                            </div><!-- col-md-8 -->
                        </div><!-- row -->

                    </div><!-- contentpanel -->
                    
                </div><!-- mainpanel -->            