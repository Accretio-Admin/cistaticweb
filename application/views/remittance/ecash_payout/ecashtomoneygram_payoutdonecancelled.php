<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-money"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                   <li>ECASH</li>
                </ul>
                <h4>MONEYGRAM</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
        
                <div class="contentpanel">
                  <div class="col-lg-12"> 
                    <div class="row" style="margin-bottom: 30px;">
                      <ul class="nav nav-tabs">
                        <li><a href="<?php echo BASE_URL()?>ecash_payout/ecashtomoneygram_createrequest">CREATE REQUEST</a></li> 
                        <li><a href="<?php echo BASE_URL()?>ecash_payout/ecashtomoneygram_payoutlist">PENDING</a></li>   
                        <li class="active"><a href="<?php echo BASE_URL()?>ecash_payout/ecashtomoneygram_payoutdone" style="color: #428bca;"><b>DONE/CANCELLED</b></a></li>   
                      </ul>
                    </div>
                  </div>
                  <div class="row">
                  <div class="col-lg-12"> 
			             <?php if ($API['S'] ===0): ?>
			            <div class="alert alert-danger"><?php echo $API['M']; ?></div>
			             <?php endif ?>
			             <?php if ($API['S'] == 1): ?>
			              <div class="alert alert-success"><?php echo $API['M']; ?></div>
			             <?php endif ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="exampled">
                          <thead>
                            <tr>
                              <th>Tracking Number</th>
                              <th>Sender Name</th>
                              <th>Beneficiary Name</th>
                              <th>Currency</th>
                              <th>Amount</th>
                              <th>Status</th>
                              <th>Transaction Date</th>
                              <th>Processed Date</th>
                            </tr>
                          </thead>
                            <tbody>
                          <?php foreach ($results['T_DATA'] as $row): ?>
                            <tr class="prod_row">
                              <td><?php echo $row['trackingNumber'] ?></td>
                              <td><?php echo $row['sender_name'] ?></td>
                              <td><?php echo $row['beneficiary_name'] ?></td>
                              <td><?php echo $row['currency'] ?></td>
                              <td><?php echo number_format($row['amount'],2) ?></td>
                              <?php if($row['status'] != 'DONE'): ?>
                              <td style="text-align: center;"><?php echo $row['status'] ?></td>
                              <?php else: ?>
                              <td><a class="btn btn-warning" href="<?php echo $row['URL'] ?>" target="_blank" data-toggle="tooltip" title="Click here get receipt"><?php echo 'Get receipt' ?></a></td>
                              <?php endif; ?>
                              <td><?php echo $row['createdDate'] ?></td>
                              <td><?php echo $row['processedDate'] ?></td>
                            </tr>
                          <?php endforeach ?>
                      </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> 

  <!--             <div class="approve modal fade" id="btn_approve_modal_mmtci" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" style="margin-top: 100px;">
                <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Confirmation</h4>
                    </div>
                    <div class="modal-body">
                          <div class="form-group text-left">    
                              <div class="input-group">                       
                                  <span><label id="mmtci_label">Are you sure you want to approve this transaction?</label></span>
                                  <input type="hidden" id="approveno" name="approveno">
                              </div>
                          </div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-danger">Cancel</button>
                        <a class="btn_approve_confirm_mmtci btn btn-primary" data-toggle="modal">Confirm</a>
                    </div>
                </div>
            </div>
        </div> -->
      
</div>


<script src="<?php echo BASE_URL()?>assets/script/ecash_western.js"></script>