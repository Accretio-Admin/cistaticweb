<?php
// print_r($user['A_CTRL']);
// $avail = ($user['QLS']['S']==1) ? 'href="'.BASE_URL().'ecashloan/avail"  id="aloading"' : 'href="#" onClick="ecashloanApp.statusAlert()"'; enable to deploy
$avail = 'href="'.BASE_URL().'ecashloan/avail"  id="aloading"'; //enable for testing
?>
<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-mobile-phone"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>PORTFOLIO</li>
                </ul>
                <h4>U-CREDIT</h4>
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
                                    <div class="col-xs-6 col-sm-4 col-md-4 document">
                                        <div class="thmb" id="availecl">
                                            <div class="thmb-prev  text-center">
                                                <a style="background-color: #fff;" <?php echo $avail;?> class="">
                                                    <img  src="<?php echo BASE_URL() ?>assets/images/loading/loadwallet_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                </a>
                                            </div>
                                            <h5 class="fm-title text-center"><a  <?php echo $avail;?> >AVAIL UCREDIT</a></h5>
                                        </div><!-- thmb -->
                                    </div>  
                                    <div class="col-xs-6 col-sm-4 col-md-4 document">
                                        <div class="thmb" >
                                            <div class="thmb-prev  text-center">
                                                <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecashloan/report" class="" id="aloading">
                                                    <img  src="<?php echo BASE_URL() ?>assets/images/loading/loadwallet_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                </a>
                                            </div>
                                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>ecashloan/report" id="aloading">UCREDIT REPORT</a></h5>
                                        </div><!-- thmb -->
                                    </div>   
                                    <div class="col-xs-6 col-sm-4 col-md-4 document">
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