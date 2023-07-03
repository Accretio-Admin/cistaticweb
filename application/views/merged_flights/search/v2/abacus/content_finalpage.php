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
<!--        <ul class="pager">-->
<!--            <li class="previous">-->
<!--                <a href="search_flights"><span aria-hidden="true">&larr;</span> Search Another</a>-->
<!--            </li>-->
<!--        </ul>-->

            <form method="post" action="" class="myform">
                <?php
                if(isset($_POST['btn_search_another'])) {
                    session_destroy();
                }
                ?>
                <button type="submit" name="btn_search_another" class="btn btn-default-alt" style="background-color: transparent;"><span aria-hidden="true">&larr;</span> Search Another</button>
            </form>

        <center>

        <?php if($provider=='abacus'): ?>

            <?php if($output['S']==1): ?>
                <img src="<?php echo base_url('/assets/icon').'/'?>checked.png" >
                <h2>Thank You!</h2>
                <h4>You may now print your ticket.</h4>
<!--                <h4><a href="--><?php //echo 'http://mobilereports.globalpinoyremittance.com/portal/abacus_ticketing_domestic_receipt/'.rawurlencode($output['TN']); ?><!--" target="_blank">Print Ticket</a></h4>-->
                <h4><a href="<?php echo 'http://mobilereports.globalpinoyremittance.com/portal/ticketing_domestic_receipt/'.rawurlencode($output['TN']); ?>" target="_blank">Print Ticket</a></h4>

                <!--<a href="http://172.16.16.13:8001/portal/ticketing_domestic_receipt/<?php /*echo $TN;*/ ?>" target="_blank">Click here to view transaction</a>-->
            <?php else: ?>
                <img src="<?php echo base_url('/assets/icon').'/'?>cancel.png">
                <h3><?php echo $output['M']; ?></h3>
                <h5>Chosen flight cannot be booked, Please select another flight.</h5>
            <?php endif; ?>
            
        <?php elseif($provider=='via'):?>
            <?php if($output['S']==1): ?>
                <img src="<?php echo base_url('/assets/icon').'/'?>checked.png" >
                <h2>Thank You!</h2>
                <h4>You may now print your ticket.</h4>
                <h4><a href="<?php echo 'https://mobilereports.globalpinoyremittance.com/ticketing/domestic/receipt.php?tn='.rawurlencode($output['TN']); ?>" target="_blank">Print Ticket</a></h4>

               <!--<a href="http://172.16.16.13:8001/portal/ticketing_domestic_receipt/<?php /*echo $TN;*/ ?>" target="_blank">Click here to view transaction</a>-->
            <?php elseif($output['S']==2): ?>
                <img src="<?php echo base_url('/assets/icon').'/'?>checked.png">
                <h3><?php echo $output['M']; ?></h3>
            <?php else: ?>
                <img src="<?php echo base_url('/assets/icon').'/'?>cancel.png">
                <h3><?php echo $output['M']; ?></h3>
                <h5>Chosen flight cannot be booked, Please select another flight.</h5>
            <?php endif; ?>

        <?php elseif($provider=='byaheko'):?>
            <?php if($output['S']==1): ?>
                <img src="<?php echo base_url('/assets/icon').'/'?>checked.png" >
                <h2>Thank You!</h2>
                <h4>You may now print your ticket.</h4>
                <h4><a href="<?php echo 'https://mobilereports.globalpinoyremittance.com/ticketing/domestic/receipt.php?tn='.rawurlencode($output['TN']); ?>" target="_blank">Print Ticket</a></h4>

               <!--<a href="http://172.16.16.13:8001/portal/ticketing_domestic_receipt/<?php /*echo $TN;*/ ?>" target="_blank">Click here to view transaction</a>-->
            <?php elseif($output['S']==2): ?>
                <img src="<?php echo base_url('/assets/icon').'/'?>checked.png">
                <h3><?php echo $output['M']; ?></h3>
            <?php else: ?>
                <img src="<?php echo base_url('/assets/icon').'/'?>cancel.png">
                <h3><?php echo $output['M']; ?></h3>
                <h5>Chosen flight cannot be booked, Please select another flight.</h5>
            <?php endif; ?>
            
        <?php endif;?>
        </center>

    </div>
</div>
