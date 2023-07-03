<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-users"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>NETWORK</li>
                </ul>
                <h4>MLM INCOME</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel" style="padding-bottom: 0px;">
        <div class="row row-stat">
            <div class="col-md-9">
                <ul class="nav nav-tabs">
                    <!-- <li class="active"><a data-toggle="tab" href="#summary"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Summary</a></li>
                    <li><a data-toggle="tab" href="/Network/mlmincome_rebates"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span> Rebates</a></li>
                    <li><a data-toggle="tab" href="#payouthistory"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Leadership Bonus</a></li>
                    <li><a data-toggle="tab" href="#rightdl"><span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span> MLM Points</a></li>
                    <li><a data-toggle="tab" href="#leftdl"><span class="glyphicon glyphicon-circle-arrow-left" aria-hidden="true"></span> Personal Sales</a></li> -->

					<li class="active"><a href="<?php echo BASE_URL()?>Network/mlmincome" class="" id="aloading"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Summary</a></li>
                    <li><a href="<?php echo BASE_URL()?>Network/mlmincome_personal_sales" class="" id="aloading"><span class="glyphicon glyphicon-circle-arrow-left" aria-hidden="true"></span>  Sales</a></li> 
                    <li><a href="<?php echo BASE_URL()?>Network/mlmincome_points" class="" id="aloading"><span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span> MLM Points</a></li>  
                    <li><a href="<?php echo BASE_URL()?>Network/mlmincome_rebates" class="" id="aloading"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span> Rebates</a></li>
                    <li><a href="<?php echo BASE_URL()?>Network/mlmincome_Leadership" class="" id="aloading"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Leadership Bonus</a></li>
                    
                                     
                </ul>
            </div>
        </div>

        <div class="tab-content" style="padding: 0px;">
            <div id="summary" class="tab-pane fade in active">
                <!-- <h3>MLM Income Summary</h3> -->
                <div class="contentpanel">
                    <div class="row row-stat">
                        <div class="col-md-9">
                        	<h3 style="margin-top:0px;">MLM Income Summary</h3>
	                        <table class="table table-striped table-bordered">
	                        	<thead>
                                    <tr>
                                    	<th></th>
                                        <th colspan="2" style="text-align: center;">SALES</th>
                                        <th colspan="2" style="text-align: center;" nowrap>POINTS</th>
                                        <th colspan="2" style="text-align: center;" nowrap>REBATES</th>
	                                </tr>
	                        	</thead>
	                        	<tbody>
                                    <tr>
                                        <td></td>
                                        <td>Current</td>
                                        <td>Accumulated</td>
                                        <td>Current</td>
                                        <td>Accumulated</td>
                                        <td>Current</td>
                                        <td>Accumulated</td>
                                    </tr>
	                        		<?php foreach ($API['TDATA'] as $w): ?>
										<tr>
											<td><?php echo $w['TYPE'] ?></td>		
											<td><?php echo $w['sales_current'] ?></td>
											<td><?php echo $w['sales_accumulated'] ?></td>
                                            <td><?php echo $w['points_current'] ?></td>
                                            <td><?php echo $w['point_accumulated'] ?></td>
                                            <td><?php echo $w['rebates_current'] ?></td>
                                            <td><?php echo $w['rebates_accumulated'] ?></td>
										</tr>

                                         <!-- [TYPE] => TOTAL [sales_current] => 0.00 [sales_accumulated] => 0.00 [points_current] => 0.00000000 [point_accumulated] => 0.00000000 [rebates_current] => N/A [rebates_accumulated] => N/A )  -->
									<?php endforeach ?>
	
	                        	</tbody>
	                        	<!-- <tfooter>
	                        		<tr>
	                        			<td>PAYOUT</td><td>:</td><td><?php //echo $summary[0]['payout'] ?></td>
	                        		</tr>
	                        	</tfooter> -->
	                        </table>

                            <hr/>
                            <br>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th colspan="" style="text-align: center;">ACCUMULATED</th>
                                        <th colspan="" style="text-align: center;" nowrap>TARGET</th>
                                        <th colspan="" style="text-align: center;" nowrap>PEROID</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>TRAVEL INCENTIVE</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>CAR INCENTIVE</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>PROFIT INCENTIVE</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
    
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            
           
        </div>





    </div>




</div>