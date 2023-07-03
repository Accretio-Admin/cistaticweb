<div class="mainpanel">
      <div class="pageheader">
          <div class="media">
              <div class="pageicon pull-left">
                  <i class="fa fa-money"></i>
              </div>
              <div class="media-body">
                  <ul class="breadcrumb">
                      <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                      <li>ACCOUNT SETTLEMENT</li>
                  </ul>
                  <h4>VOUCHER LIST</h4>
              </div>
          </div><!-- media -->
      </div><!-- pageheader -->

      <div class="contentpanel">
        <div class="table-responsive">
            <ul class="nav nav-tabs">
                <li><a href="<?php echo BASE_URL()?>Account_Settlement">Account Settlement</a></li>
                <li class="active"><a href="<?php echo BASE_URL()?>Account_Settlement/voucherlist">Voucher List</a></li>
            </ul>
        </div>
        <div class="tab-content">
          <div id="etoetab" class="tab-pane fade in active padding-five">
            <div class="row">
              <div class="col-xs-12 col-md-12">
                  <?php if ($results['S'] === 0): ?>
                    <div class="alert alert-danger"><?php echo $results['M']; ?></div> 
                  <?php endif ?>
                  <div class="col-md-12 col-xs-12" style="overflow-y:scroll;height:350px" >
                   <table  class="table table-bordered">
                    <thead>
                        <tr>
                          <th>Voucher Id</th>
                          <th>Voucher Code</th>
                          <th>Regcode</th>
                          <th>Status</th>
                          <th>Payment Reference</th>
                          <th>Issue Date</th> 
                        </tr>
                    </thead>
                    <tbody>
                     <?php foreach ($results['T_DATA'] as $A ): ?>
                        <tr>
                          <td><?php echo $A['voucher_id'];?></td>
                          <td><?php echo $A['voucher_code'];?></td>
                          <td><?php echo $A['regcode'];?></td>
                          <td><?php echo $A['is_used'];?></td>
                          <td><?php echo $A['paymentref'];?></td>
                          <td><?php echo $A['issue_date'];?></td>
                        </tr>
                      <?php endforeach ?>
                      </tbody>
                      </table>
                  </div>           
              </div>
            </div>
          </div>
        </div>
      </div><!-- contentpanel -->
</div><!-- mainpanel --> 
        