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
                  <h4>ACCOUNT SETTLEMENT</h4>
              </div>
          </div><!-- media -->
      </div><!-- pageheader -->

      <div class="contentpanel">
        <div class="table-responsive">
            <ul class="nav nav-tabs">
                <li class="active"><a href="<?php echo BASE_URL()?>Account_Settlement">Account Settlement</a></li>
                <li><a href="<?php echo BASE_URL()?>Account_Settlement/voucherlist">Voucher List</a></li>
            </ul>
        </div>
        <div class="tab-content">
          <div id="etoetab" class="tab-pane fade in active padding-five">
            <div class="row">
              <div class="col-xs-12 col-md-12">
                  <?php if ($API['S'] === 0): ?>
                    <div class="alert alert-danger"><?php echo $API['M']; ?></div> 
                  <?php endif ?>
                  <?php if ($API['S'] === 1): ?>
                    <div class="alert alert-success"><?php echo $API['M']; ?></div> 
                  <?php endif ?>
                  <?php if ($results['S'] === 0): ?>
                    <div class="alert alert-danger"><?php echo $results['M']; ?></div> 
                  <?php endif ?>
                  <div class="col-md-12 col-xs-12" style="overflow-y:scroll;height:350px" >
                   <table  class="table table-bordered unpaidtable">
                    <thead>
                        <tr>
                          <th>Year</th>
                          <th>Track Number</th>
                          <th>Status</th>
                          <th>Balance</th>
                          <th>Date</th>
                          <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody>
                     <?php foreach ($results['T_DATA'] as $A ): ?>
                        <tr class="prod_row">
                          <td><?php echo $A['year'];?></td>
                          <td><?php echo $A['trackno'];?></td>
                          <td><?php echo $A['status'];?></td>
                          <td><?php echo 'Php '.$A['balance'];?></td>
                          <td><?php echo $A['date_added'];?></td>
                          <?php if($A['status'] != 'PAID'): ?>
                          <td><center><button type="button" class="btn btn-success voucheritems confirmAccountSettlement "><i class="glyphicon glyphicon-hand-right"></i> Pay Now</button></center></td>
                          <?php else: ?>
                          <td><center><a class="voucheritems" href="<?php echo $URL_receipt.$A['trackno']; ?>" target="_blank"><i class="glyphicon glyphicon-tasks"></i> Get Voucher</center></a></td>
                          <?php endif; ?>
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

      <div class="modal fade" tabindex="-1" data-backdrop="static" role="dialog" id="myModal_confirmAccountSettlement">
        <div class="modal-dialog" style="padding-top: 4%;">
          <div class="modal-content" style="width: 500px; margin: auto;">
            <div class="modal-header" id="modalhead">
              <button type="button" class="close closeConfirmAccountSettlementmodal">&times;</button>
              <h4 class="modal-title"></h4>
            </div>
            <form id="frmAccountSettlement" action="<?php echo BASE_URL()?>Account_Settlement" method="post">
            <div class="modal-body" id="modalbody">
              <div class="row">
                  <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1" style="padding-right: 72px;">Tracking No.:</span>
                      <input type="text" class="form-control" name="as_trackno" id="as_trackno" placeholder="Tracking No." aria-describedby="basic-addon1" readonly>
                    </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1" style="padding-right: 104px;">Amount:</span>
                      <input type="text" class="form-control" name="as_amount" id="as_amount" placeholder="Amount" aria-describedby="basic-addon1" readonly>
                    </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">Transaction Password:</span>
                      <input type="password" class="form-control" name="as_transpass" id="as_transpass" placeholder="Transaction Password" aria-describedby="basic-addon1" required>
                    </div>
                </div>
              </div>
              <div class="form-group text-center">
                <button type="submit" class="btn btn-primary"  name="btnAccountSettlement">Submit</button>
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>

</div><!-- mainpanel --> 
        