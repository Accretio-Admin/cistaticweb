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
                                <h4>E-LOADING</h4>
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
                                                
                                                    <div class="col-xs-6 col-sm-4 col-md-3 document">
                                                        <div class="thmb" >
                                                          <div class="thmb-prev  text-center">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>e_loading/regular_load" class="" id="aloading">
                                                                <img  src="<?php echo BASE_URL() ?>assets/images/loading/regular_load_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>e_loading/regular_load" id="aloading">REGULAR LOAD</a></h5>
                                                        </div><!-- thmb -->
                                                     </div>
                                                       
                                                    <?php if($this->user['R'] == '1234567'): ?>
                                                     <div class="col-xs-6 col-sm-4 col-md-3 document">
                                                        <div class="thmb" >
                                                          <div class="thmb-prev  text-center">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>e_loading/smart_load" class="" id="aloading">
                                                                <img  src="<?php echo BASE_URL() ?>assets/images/loading/regular_load_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>e_loading/smart_load" id="aloading">LOAD</a></h5>
                                                        </div><!-- thmb -->
                                                     </div>   
                                                     <?php endif; ?>
                                                
                                                
                                                     <div class="col-xs-6 col-sm-4 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>e_loading/special_load" id="aloading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/loading/special_load_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>e_loading/special_load" id="aloading">SPECIAL LOAD</a></h5>
                                                        </div><!-- thmb -->
                                                     </div>   
                                               
                                                
                                                     <div class="col-xs-6 col-sm-4 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>e_loading/prepaid_card" id="aloading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/loading/prepaid_load_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>e_loading/prepaid_card" id="aloading">PREPAID CARD</a></h5>
                                                        </div><!-- thmb -->
                                                     </div>
                                               
                                                 </div>
                                             </div>      
                                        </div><!-- activity-list -->

                                    </div><!-- tab-pane -->

                                </div>
                            </div><!-- col-md-8 -->
                        </div><!-- row -->

                    </div><!-- contentpanel -->
                    
                </div><!-- mainpanel -->            