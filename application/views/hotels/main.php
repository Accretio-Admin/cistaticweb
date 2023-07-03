<div class="mainpanel">
  <div class="pageheader">
      <div class="media">
          <div class="pageicon pull-left">
              <i class="fa fa-book"></i>
          </div>
          <div class="media-body">
              <ul class="breadcrumb">
                  <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                  <li>Hotels</li>
              </ul>
              <h4>Hotel Booking</h4>
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
                                    
                                    <div class="col-xs-6 col-sm-4 col-md-3 document">
                                        <div class="thmb">
                                            <div class="thmb-prev  text-center">
                                                <a style="background-color: #fff;" href="<?php echo BASE_URL()?>hotels/search_hotels" class="" id="aloading">
                                                    <img src="<?php echo BASE_URL()?>assets/images/online_booking/book_flights.png" class="img-responsive" alt="" style="margin:0 auto">
                                                </a>
                                            </div>
                                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL()?>hotels/search_hotels">SEARCH HOTELS</a></h5>
                                        </div><!-- thmb -->
                                    </div>

                                    <?php if($user['L'] == 1 || $user['L'] == 6) {?>
                                    <div class="col-xs-6 col-sm-4 col-md-3 document">
                                        <div class="thmb">
                                            <div class="thmb-prev  text-center">
                                                <a style="background-color: #fff;" href="<?php echo BASE_URL()?>hotels/markup" class="" id="aloading">
                                                    <img src="<?php echo BASE_URL()?>assets/images/online_booking/markup.png" class="img-responsive" alt="" style="margin:0 auto">
                                                </a>
                                            </div>
                                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL()?>hotels/markup">MARKUP</a></h5>
                                        </div><!-- thmb -->
                                    </div>  
                                    <?php } ?>
                                    
                                </div>
                            </div>
                        </div><!-- activity-list -->
                    </div><!-- tab-pane -->
                </div>
            </div><!-- col-md-8 -->
        </div><!-- row -->
  </div>
</div>