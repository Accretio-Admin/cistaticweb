<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-plane"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>ABACUS</li>
                </ul>
                <h4><?php echo $menu == 'int' ? 'INTERNATIONAL' : 'DOMESTIC' ?> FLIGHTS</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->


    <div class="contentpanel" ng-app="MyApp" ng-controller="myCtrl">
        <ul class="pager">
            <li class="previous">
                <a href="<?php echo BASE_URL() ?>Abacus_International_flights/book_flights"><span aria-hidden="true">&larr;</span> Search Another</a>
            </li>
        </ul>
        <center>
        <?php if($S==1): ?>
            <img src="<?php echo base_url('/assets/icon').'/'?>checked.png" >
            <h3>Thank You!</h3>
            <h5>Chosen flight has been reserved.</h5>
            <h5><p class="bg-warning text-center">Subject to cancellation without payment.</p></h5>
           <!-- <a href="http://172.16.16.13:8001/portal/ticketing_domestic_receipt/<?php /*echo $TN;*/ ?>" target="_blank">Click here to view transaction</a>-->
        <?php else: ?>
            <img src="<?php echo base_url('/assets/icon').'/'?>cancel.png">
            <h3><?php echo $M; ?></h3>
            <h5>Chosen flight cannot be booked, Please select another flight.</h5>
        <?php endif; ?>
        </center>

    </div>
</div>
