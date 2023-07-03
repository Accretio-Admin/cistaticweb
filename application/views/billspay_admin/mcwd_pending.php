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
                <h4>MCWD PENDING</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
    <div class="contentpanel">

                    <div class="contentpanel">
                      <div class="col-lg-12"> 
                        <div class="row" style="margin-bottom: 30px;">
                          <ul class="nav nav-tabs">
                            <li class="active"><a href="<?php echo BASE_URL()?>billspay_admin/mcwd_approval" style="color: #428bca;"><b>PENDING</b></a></li> 
                            <li><a href="<?php echo BASE_URL()?>billspay_admin/mcwd_processed">PROCESSED</a></li>   
                          </ul>
                        </div>
                      </div>
                      <div class="row">
                      <div class="col-lg-12"> 
                        <div class="row" style="margin-bottom: 15px;">
                          <div class="alert alert-success" id="alertSuccess" style="display: none;"></div>
                          <div class="alert alert-danger" id="alertDanger" style="display: none;"></div>
                            <form method="post" class="form-inline" action="<?php echo BASE_URL() ?>billspay_admin/mcwd_approval" id="frmBuycodes">
                              <div class="col-lg-6">
                                  <div class="form-group input-group" style="width: 100%;">
                                      <span class="input-group-addon" style="background-color: #428bca; border-color: #357ebd; color: #FFFFFF;">Search</span>
                                      <input type="text" name="acct_regcode" value="<?php echo $_POST['acct_regcode'];?>" class="form-control inputLetterValidator" placeholder="Tracking Number">
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
                                  <th>Mobile Number</th>
                                  <th>Amount</th>
                                  <th>Transaction Date</th>
                                  <th style="width: 100px;">Option</th>
                                </tr>
                              </thead>
                              <tbody>
                                  <?php foreach ($results['P_DATA'] as $row): ?>
                                    <tr class="prod_row">
                                      <td><?php echo $row['trackno'] ?></td>
                                      <td><?php echo $row['accntNo'] ?></td>
                                      <td><?php echo $row['accntName'] ?></td>
                                      <td><?php echo $row['mobileNo'] ?></td>
                                      <td><?php echo $row['amount'] ?></td>
                                      <td><?php echo $row['transaction_date'] ?></td>
                                      <!-- <td hidden=""><?php //echo $row['billing_sequence'].'|'.$row['book'].'|'.$row['zone']; ?></td> -->
                                      <td nowrap>
                                      <a class="btn_approve_mcwd btn btn-primary btn-xs"><i class="fa fa-check-circle-o"></i> <font style="color:#FFFFFF; cursor: pointer;">Confirm</font></a>
                                      <button type="button" class="btn_cancel_mcwd btn btn-danger btn-xs"><i class="fa fa-times"></i> <font style="color:#FFFFFF; cursor: pointer;">Reject</button>
                                      </td>
                                    </tr>


                                    <div class="approve modal fade" id="btn_approve_modal_mcwd" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-md" style="margin-top: 100px;">
                                        <form id="form_approve_mcwd">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title"><b>Process Payment</b></h4>
                                                </div>
                                              <div class="modal-body">
                                                <p>Please input Reference Number from MCWD.</p>
                                                <p id="showid"></p>
                                                <div class="row">
                                                  <div class="col-lg-6">
                                                    <div class="form-group">
                                                      <label for="usr">Track Number:</label>
                                                      <input type="text" class="form-control" name="trackno" id="trackno" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="usr">Account Name:</label>
                                                      <input type="text" class="form-control" name="accntname" id="accntname" placeholder="Account Name" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="usr">Amount:</label>
                                                      <input type="text" class="form-control" name="amnt" id="amnt" placeholder="Amount" readonly>
                                                    </div>
                                                  </div>
                                                  <div class="col-lg-6">
                                                    <div class="form-group">
                                                      <label for="usr">Customer Code:</label>
                                                      <input type="text" class="form-control" name="acctno" id="acctno" placeholder="Customer Code" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="usr">Mobile Number:</label>
                                                      <input type="text" class="form-control" name="mobno" id="mobno" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="usr">Transaction Date:</label>
                                                      <input type="text" class="form-control" name="transdate" id="transdate" readonly>
                                                    </div>
                                                    <!-- <div class="form-group">
                                                      <label for="usr">Book:</label>
                                                      <input type="text" class="form-control" name="bill_book" id="bill_book" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="usr">Zone:</label>
                                                      <input type="text" class="form-control" name="bill_zone" id="bill_zone" readonly>
                                                    </div> -->
                                                  </div>
                                              </div>
                                              <div class="row">
                                                  <div class="col-lg-12">
                                                    <div class="form-group">
                                                      <label for="usr">Reference Number:</label>
                                                      <input type="text" class="form-control" name="refno" id="refno" placeholder="Reference Number" required>
                                                    </div>
                                                  </div>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary btn_approve_confirm_mcwd">Process</button>
                                              </div>
                                            </div>
                                          </form>
                                        </div>
                                    </div>

                                  <?php endforeach ?>
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> 
</div>

                                  <div id="myModalCancel" class="modal fade" role="dialog" data-backdrop="static">
                                    <div class="modal-dialog modal-md" style="margin-top: 100px;">
                                      <form id="form_reject_mcwd">
                                      <div class="modal-content" style="width: max-content;">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          <h4 class="modal-title"><b>Cancellation</b></h4>
                                        </div>
                                        <div class="modal-body">
                                          <h4 id="mcwd_label">Are you sure you want to reject ?</h4>
                                          <div class="form-group">
                                            <label for="usr">Remarks:</label>
                                            <input type="text" class="form-control" name="remarks" id="remarks" placeholder="Remarks" required />
                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                        <input type="hidden" class="form-control" name="trackno" id="trackno">
                                          <button type="submit" class="btn btn-primary"  name="btnSubmit"><i class="fa fa-check-circle-o"></i> <font style="color:#FFFFFF; cursor: pointer;">Proceed</button>
                                        </div>
                                      </div>
                                      </form>
                                    </div>
                                  </div>


<script src="<?php echo BASE_URL()?>assets/js/billspay_admin.js"></script>  