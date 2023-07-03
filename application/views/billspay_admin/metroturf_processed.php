<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-money"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                   <li>BILLSPAY CONFIRMATION</li>
                </ul>
                <h4>MMTCI PENDING</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
    <div class="contentpanel">
        
                    <div class="contentpanel">
                      <div class="col-lg-12"> 
                        <div class="row" style="margin-bottom: 30px;">
                          <ul class="nav nav-tabs">
                            <li><a href="<?php echo BASE_URL()?>billspay_admin/mmtci_approval">PENDING</a></li> 
                            <li class="active"><a href="<?php echo BASE_URL()?>billspay_admin/mmtci_processed" style="color: #428bca;"><b>PROCESSED</b></a></li>   
                          </ul>
                        </div>
                      </div>
                      <div class="row">
                      <div class="alert alert-success" id="alertSuccess" style="display: none;"></div>
                      <div class="alert alert-danger" id="alertDanger" style="display: none;"></div>
                      <div class="col-lg-12"> 
                        <div class="row" style="margin-bottom: 15px;">
                            <form method="post" class="form-inline" action="<?php echo BASE_URL() ?>billspay_admin/mmtci_processed" id="frmBuycodes">
                                <p class="col-lg-12" style="margin-bottom: 1px; padding-left: 20px;"><i>Please enter processed date.</i></p>
                                <div class="col-lg-12">
                                    <div class="form-group input-group">
                                        <!-- <span class="input-group-addon" style="background-color: #428bca; border-color: #357ebd; color: #FFFFFF;">START DATE</span> -->
                                        <input type="text" name="inputStart" id="datetimepicker"  value="<?php echo $_POST['inputStart'];?>" class="form-control" placeholder="START DATE">
                                    </div>
                                    <div class="form-group input-group">
                                        <!-- <span class="input-group-addon" style="background-color: #428bca; border-color: #357ebd; color: #FFFFFF;">END DATE</span> -->
                                        <input type="text" name="inputEnds" id="datetimepickers" value="<?php echo $_POST['inputEnds'];?>" class="form-control" placeholder="END DATE">
                                    </div>
                                    <div class="form-group text-left">
                                        <button type="submit" name="btn_search" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>&nbsp;SEARCH</button>
                                         <a href="<?php echo BASE_URL(); ?>billspay_admin/export/mmtci_processed_report" target="_blank">
                                         <button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i>&nbsp;&nbsp;GENERATE</button>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover productTable">
                              <thead>
                                <tr>
                                  <th>Tracking Number</th>
                                  <th>Account Number</th>
                                  <th>Account Name</th>
                                  <th>Amount</th>
                                  <th>Transaction Date</th>
                                  <th>Status</th>
                                  <th>Processed By</th>
                                  <th>Processed Date</th>
                                </tr>
                              </thead>
                              <tbody>
                                  <?php foreach ($results['P_DATA'] as $row): ?>
                                    <tr class="prod_row">
                                      <td><?php echo $row['referenceNo'] ?></td>
                                      <td><?php echo $row['accntNo'] ?></td>
                                      <td><?php echo $row['accntName'] ?></td>
                                      <td><?php echo $row['amount'] ?></td>
                                      <td><?php echo $row['transaction_date'] ?></td>
                                      <td><?php echo $row['status'] ?></td>
                                      <td><?php echo $row['approved_by'] ?></td>
                                      <td><?php echo $row['approved_date'] ?></td>
                                    </tr>
                                  <?php endforeach ?>
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> 

</div>


<script src="<?php echo BASE_URL()?>assets/js/billspay_admin.js"></script>  