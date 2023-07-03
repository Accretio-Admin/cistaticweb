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
                <h4>WESTERN UNION</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
        
                <div class="contentpanel">
                  <div class="col-lg-12"> 
                    <div class="row" style="margin-bottom: 30px;">
                      <ul class="nav nav-tabs">
                        <li><a href="<?php echo BASE_URL()?>ecash_payout/ecashtowestern_createrequest">CREATE REQUEST</a></li> 
                        <li class="active"><a href="<?php echo BASE_URL()?>ecash_payout/ecashtowestern_payoutlist" style="color: #428bca;"><b>PENDING</b></a></li>   
                        <li><a href="<?php echo BASE_URL()?>ecash_payout/ecashtowestern_payoutdone">DONE/CANCELLED</a></li>
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
                   <?php if ($API['S'] == 2): ?>
                    <div class="alert alert-success"><?php echo $API['M']; ?><br><a href="<?php echo $API['URL']; ?>"><b>Click here to download receipt. </b></a></div>
                   <?php endif ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="example">
                          <thead>
                            <tr>
                              <th>Tracking Number</th>
                              <th>Reference Number</th>
                              <th style="width: 100px;">Status</th>
                            </tr>
                          </thead>
                            <tbody>
                          <?php foreach ($results['T_DATA'] as $row): ?>
                            <tr class="prod_row">
                              <td><?php echo $row['trackingNumber'] ?></td>
                              <td><?php echo $row['referenceNumber'] ?></td>
                              <td><a onclick="return confirm('Check Status?','Ecash to Western Union')" href="<?php echo BASE_URL() ?>Ecash_payout/ecashtowestern_payoutlist/<?php echo $row['trackingNumber'] ?>" class="btn btn-primary" data-toggle="tooltip" title="Click here to check status" style="font-size: 13px;"><?php echo 'Check Status' ?></a></td>
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