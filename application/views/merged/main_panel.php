<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-plane"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>ONLINE BOOKING</li>
                </ul>
                <h4><?php echo ($menu=='int')?'INTERNATIONAL' : 'DOMESTIC'; ?> FLIGHTS</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->



    <div class="contentpanel">

        <?php $JRNY = ($menu=='int')?'International' : 'Domestic'; ?>
        <div class="row row-stat">
            <div class="col-sm-9 col-md-9">
                <div class="tab-content nopadding noborder">
                    <div class="tab-pane active" id="activities">
                        <div class="follower-list">
                            <div class="col-sm-12">
                                <div class="row media-manager">
                                    <div class="col-xs-6 col-sm-4 col-md-3 document">
                                        <div class="thmb" >
                                            <div class="thmb-prev  text-center">
                                                <a style="background-color: #fff;" href="<?php echo BASE_URL();?>Merged_ticketing/search_flights" class="" id="aloading">
                                                    <img  src="<?php echo BASE_URL() ?>assets/images/online_booking/book_flights.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                </a>
                                            </div>
                                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL();?>Merged_ticketing/search_flights">SEARCH FLIGHTS</a></h5>
                                        </div><!-- thmb -->
                                    </div>

                                <?php if ($this->user['R'] != 'AIRLINE001' && $this->user['R'] != 'F1359252xx'): ?>    
                                    <div class="col-xs-6 col-sm-4 col-md-3 document">
                                        <div class="thmb" >
                                            <div class="thmb-prev  text-center">
                                                <a style="background-color: #fff;" href="<?php echo BASE_URL();?>Merged_ticketing/markup" class="" id="aloading">
                                                    <img  src="<?php echo BASE_URL() ?>assets/images/online_booking/markup.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                </a>
                                            </div>
                                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL();?>Merged_ticketing/markup">MARKUP</a></h5>
                                        </div><!-- thmb -->
                                    </div>
                                <?php endif ?>

                                    <div class="col-xs-6 col-sm-4 col-md-3 document">
                                        <div class="thmb" >
                                            <div class="thmb-prev  text-center">
                                                <a style="background-color: #fff;" href="<?php echo BASE_URL();?>Merged_ticketing/eticketing" class="" id="aloading">
                                                    <img  src="<?php echo BASE_URL() ?>assets/images/online_booking/etickets.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                </a>
                                            </div>
                                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL();?>Merged_ticketing/eticketing" id="aloading">ISSUE TICKET</a></h5>
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