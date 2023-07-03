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
                <h4>DOMESTIC FLIGHTS</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->


    <div class="contentpanel" >
        <p>
            <a href="issue_ticket" class="btn btn-default-alt"><span aria-hidden="true">&larr;</span> Back</a>
        </p>
        <?php if($output['S']==0){ ?>
            <div class="col-md-8 col-md-offset-2">
                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    <?php echo $output['M'];?>
                </div>
            </div>
        <?php }else if($output['S']==1){ ?>
            <div class="text-center">
                <h3><?php echo $output['M']; ?></h3>
                <img src="<?php echo base_url('/assets/icon').'/'?>checked.png" >
                <h3>Thank You!</h3>
                <?php if(count($output['TKT'])): ?>
                <h4>eTicket No : <?php echo $output['TKT'][0]; ?></h4>
                <?php endif; ?>
                <form method="post" action="issue_ticket" class="myform">
                    <!--<input type="hidden" name="transno" value="<?php /*echo $output['TN']; */?>">-->
                    <button type="submit" class="btn btn-default" name="btnPrint">Print Ticket</button>
                </form>
            </div>

        <?php }?>
    </div><!-- contentpanel -->

</div><!-- mainpanel -->

