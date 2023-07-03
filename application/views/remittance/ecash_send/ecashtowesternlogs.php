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
                        <li><a href="<?php echo BASE_URL()?>ecash_send/ecashtowestern">SENDING</a></li> 
                        <li class="active"><a href="<?php echo BASE_URL()?>ecash_send/logs_ecashtowestern" style="color: #428bca;"><b>PENDING</b></a></li>  
                        <li><a href="<?php echo BASE_URL()?>ecash_send/done_ecashtowestern">DONE</a></li>   
                      </ul>
                    </div>
                  </div>
                  <div class="row">
                  <div class="col-lg-12"> 
			             <?php if ($API['S'] ===0): ?>
			             <div class="alert alert-danger"><?php echo $API['M']; ?></div>
			             <?php endif ?>
			             <?php if ($API['S'] == 1): ?>
			              <div class="alert alert-success"><?php echo $API['M']; ?> : Check Status Successful Please Click Again</div>
			             <?php endif ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="example">
                          <thead>
                            <tr>
                              <th>Tracking Number</th>
                              <th>Sender Name</th>
                              <th>Beneficiary Name</th>
                              <th>Currency</th>
                              <th>Amount</th>
                              <th>Status</th>
                              <th>Transaction Date</th>
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
                              <td><a onclick="return confirm('Check Status?','Ecash to Western Union')" href="<?php echo BASE_URL() ?>Ecash_send/logs_ecashtowestern/<?php echo $row['trackingNumber'] ?>"class="btn btn-primary" data-toggle="tooltip" title="Click here to check status"><?php echo 'Check Status' ?></a></td>
                              <td><?php echo $row['createdDate'] ?></td>
                            </tr>
                          <?php endforeach ?>
                      </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> 
      
</div>


<script src="<?php echo BASE_URL()?>assets/script/ecash_western.js"></script>