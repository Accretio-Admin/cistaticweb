
  <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-money"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>ECASH</li>
                                </ul>
                                <h4>E-CASH TO CEBUANA</h4>
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

                                                     <?php if ($user['A_CTRL']['remittance_cebuana'] == 1): ?>
                                                     <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_send/ecashtocebuana" id="aloading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/ecash_send/cebuana-sending.png" class="img-responsive" alt="" style= "margin:0 auto;">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>ecash_send/ecashtocebuana">Cebuana Send</a></h5>
                                                        </div><!-- thmb -->
                                                     </div> 

                                                     <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_send/cebuana_checkref" id="aloading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/ecash_send/cebuana-checkref.png" class="img-responsive" alt="" style= "margin:0 auto;">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>ecash_send/cebuana_checkref">Check Reference</a></h5>
                                                        </div>
                                                     </div> 

                                                     <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_send/cebuana_amend" id="aloading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/ecash_send/cebuana-amendment.png" class="img-responsive" alt="" style= "margin:0 auto;">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>ecash_send/cebuana_amend">Amendment</a></h5>
                                                        </div>
                                                     </div> 

                                                     <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_send/cebuana_cancel" id="aloading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/ecash_send/cebuana-cancellation.png" class="img-responsive" alt="" style= "margin:0 auto;">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>ecash_send/cebuana_cancel">Cancellation</a></h5>
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