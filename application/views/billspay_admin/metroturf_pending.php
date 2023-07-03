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
                            <li class="active"><a href="<?php echo BASE_URL()?>billspay_admin/mmtci_approval" style="color: #428bca;"><b>PENDING</b></a></li> 
                            <li><a href="<?php echo BASE_URL()?>billspay_admin/mmtci_processed">PROCESSED</a></li>   
                          </ul>
                        </div>
                      </div>
                      <div class="row">
                      <div class="alert alert-success" id="alertSuccess" style="display: none;"></div>
                      <div class="alert alert-danger" id="alertDanger" style="display: none;"></div>
                      <div class="col-lg-12"> 
                        <div class="row" style="margin-bottom: 15px;">
                            <form method="post" class="form-inline" action="<?php echo BASE_URL() ?>billspay_admin/mmtci_approval" id="frmBuycodes">
                              <div class="col-lg-6">
                                  <div class="form-group input-group" style="width: 100%;">
                                      <span class="input-group-addon">Search</span>
                                      <input type="text" name="acct_regcode" value="<?php echo $_POST['acct_regcode'];?>" class="form-control inputLetterValidator" placeholder="Tracking Number / Regcode">
                                      <span class="input-group-btn"><button type="submit" class="btn btn-primary" name="btn_search" style="height: 34px;"><i class="fa fa-search fa-5px"></i></button></span>
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
                                  <th>Option</th>
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
                                      <td nowrap>
                                      <a class="btn_approve_mmtci btn btn-primary"><i class="fa fa-check-circle-o"></i> <font style="color:#FFFFFF; cursor: pointer;">Approve</font></a>
                                      </td>
                                    </tr>
                                  <?php endforeach ?>
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> 

            <div class="approve modal fade" id="btn_approve_modal_mmtci" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
            </div>
      
</div>


<script src="<?php echo BASE_URL()?>assets/js/billspay_admin.js"></script>  