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
                <h4>MLM POINTS</h4>
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

					<li><a href="<?php echo BASE_URL()?>Network/mlmincome" class="" id="aloading"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Summary</a></li>
                    <li><a href="<?php echo BASE_URL()?>Network/mlmincome_personal_sales" class="" id="aloading"><span class="glyphicon glyphicon-circle-arrow-left" aria-hidden="true"></span>  Sales</a></li> 
                    <li class="active"><a href="<?php echo BASE_URL()?>Network/mlmincome_points" class="" id="aloading"><span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span> MLM Points</a></li>   
                    <li><a href="<?php echo BASE_URL()?>Network/mlmincome_rebates" class="" id="aloading"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span> Rebates</a></li>
                    <li><a href="<?php echo BASE_URL()?>Network/mlmincome_Leadership" class="" id="aloading"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Leadership Bonus</a></li>
                    
                        

                </ul>
            </div>
        </div>

        <div class="tab-content" style="padding: 0px;">
            <div id="mlmpoints" class="tab-pane fade in active">
                <!-- <h3>Right Downlines</h3> -->
                <div class="contentpanel">
                    <div class="row row-stat">
                        <div class="col-md-9">
	                        <h3 style="margin-top:0px;">MLM Points</h3>
	                        
	                        <form method="post" method="<?php echo BASE_URL()?>Network/mlmincome_points" id="frmreport">
		                        <div class="row">
		                            <div class="col-xs-12 col-md-12">
		                                <div class="col-xs-12 col-md-3">
		                                    <div class="form-group">
		                                        <div class="row">
		                                            <div class="col-xs-12 col-md-3">
		                                                <b>START &nbsp;&nbsp;&nbsp;&nbsp;</b>
		                                            </div>
		                                            <div class="col-xs-12 col-md-9">
		                                                <input type="text" class="form-control" name="inputStart" id="datetimepicker" value="<?php echo $_POST['inputStart'];?>" autocomplete="off" required/>
		                                            </div>
		                                        </div>
		                                         
		                                    </div>
		                                </div>
		                                <div class="col-xs-12 col-md-3">
		                                      <div class="form-group">
		                                       <div class="row">
		                                            <div class="col-xs-12 col-md-2">
		                                                <b>END</b>
		                                            </div>
		                                            <div class="col-xs-12 col-md-10">
		                                                <input type="text" class="form-control" name="inputEnd" id="datetimepicker"  value="<?php echo $_POST['inputEnd'];?>" autocomplete="off" required/>
		                                            </div>
		                                        </div>
		                                      </div>
		                                </div>

		                                <div class="col-xs-12 col-md-3">
		                                    <div class="form-group">
		                                        <div class="row">
		                                            <div class="col-xs-12 col-md-3">
		                                                <b>Type &nbsp;&nbsp;&nbsp;&nbsp;</b>
		                                            </div>
		                                            <div class="col-xs-12 col-md-9">
		                                                <select class="form-control" name="type" required="">
				                                            <option value="" disabled="" selected="">Select</option>
				                                            <option value="1" <?php if($_POST['type'] == "1") echo "selected"; ?>>Personal</option>
				                                            <option value="2" <?php if($_POST['type'] == "2") echo "selected"; ?>>Group</option>
					                                    </select>  
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>

		                                <div class="col-xs-12 col-md-3">
		                                   <div class="form-group">
		                                      <button type="submit" name="btnSearch" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>&nbsp;SEARCH</button>
		                                      <!-- <a href="<?php echo BASE_URL(); ?>Report/export/<?php echo md5('general_report') ?>" target="_blank">
		                                      <button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i>&nbsp;&nbsp;GENERATE</button>
		                                      </a> -->

		                                    </div>
		                                </div>
		                            </div>    
		                        </div>
		                    </form>
		                       		
		                    <div class="" style="width:100%;height:450px;overflow:auto">
	                          	<table class="table table-striped">
									<thead>
										<tr>
											<th>Regcode</th>
											<th>Trackno</th>		
											<th>Points</th>
											<th>Date</th>
										</tr>
										</thead>
										<tbody>
											<?php if(isset($API['TDATA'])): ?>
												<?php foreach ($API['TDATA'] as $w): ?>
													<tr>
														<td><?php echo $w['reg_code'] ?></td>	
														<td><?php echo $w['trackno'] ?></td>		
														<td><?php echo $w['points'] ?></td>
														<td><?php echo $w['entry_date'] ?></td>
													</tr>
												<?php endforeach ?>
											<?php else: ?>
												<?php if(isset($_POST['btnSearch'])): ?>	
													<tr>
														<td colspan="4" class="text-center text-danger">No Results Found!</td>		
													</tr>
												<?php else: ?>	
													<tr>
														<td colspan="4" class="text-center text-danger">Please search to display data.</td>		
													</tr>
												<?php endif ?>
											<?php endif ?>
										</tbody>
									
								</table>
                        	</div>
										
                        </div>
                    </div>
                </div>
            </div>
        </div>





    </div>




</div>