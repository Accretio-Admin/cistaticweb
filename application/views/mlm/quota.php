  <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-trophy"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li><a href="/Mlm">MLM PRODUCT INVENTORY</a></li>
                                </ul>
                                <h4>MONTHLY QUOTA</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    
                    <div class="contentpanel">
                        <div class="row">
                                <div class="col-lg-12">
                              <?php if ($result['S'] == 1): ?>
                                <div class="alert alert-success"><?php echo $result['M'] ?></div>
                              <?php elseif ($result['S'] == 2): ?>
                                <div class="alert alert-danger"><?php echo $result['M'] ?></div>
                              <?php endif ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                      <thead>
                                        <tr>
                                          <th>Rank Title</th>
                                          <th>Rates (%)</th>
                                          <th>Group Sales</th>
                                          <th>Maintain Point Value</th>
                                          <th>Qualifying Point Value</th>
                                          <?php if($mlm_user['edit_quota'] == 1): ?>
                                            <th>Action</th>
                                          <?php endif ?>
                                        </tr>
                                      </thead>
                                      <tbody>
                                          <?php foreach ($quota as $q): ?>
                                            <tr class="quota_row"> 
                                              <td style="text-transform: capitalize;"><?php echo $q['dealer_rank'] ?></td>
                                              <td><?php echo $q['rates'] * 100 . '%'; ?></td>
                                              <td><?php echo $q['group_sales'] ?></td>
                                              <td><?php echo $q['maintain_PV'] ?></td>
                                              <td hidden><?php echo $q['rank_code'] ?></td>
                                              <td><?php echo $q['qualify_PV'] ?></td>
                                              <?php if($mlm_user['edit_quota'] == 1): ?>
                                              <td><a class="btn_edit_quota" data-toggle="modal"><i class="fa fa-fw fa-edit"></i> Edit</a></td>
                                              <?php else: ?>
                                              <!-- <td>&nbsp;</td> -->
                                              <?php endif ?>
                                            </tr>
                                          <?php endforeach ?>
                                      </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div><!-- contentpanel -->

                    <div class="modal fade" id="myModal_edit_quota" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-sm" style="margin-top: 100px;">
                          <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Update Dealer Rates</h4>
                              </div>
                              <div class="modal-body">
                                  <form class="text-right" method="post" action="<?php echo BASE_URL() ?>Mlm/quota" id="frmMlm">
                                    <div class="form-group text-left">
                                      <label>Rank Code</label>
                                      <input type="text" class="form-control" name="rank_code" id="rank_code" required>
                                    </div>
                                    <div class="form-group text-left">
                                      <label>Rates (%)</label>
                                      <input type="number" class="form-control" step="any" name="rates" id="rates" required>
                                    </div>
                                    <div class="form-group text-left">
                                      <label>Group Sales</label>
                                      <input type="number" class="form-control" step="any" name="group_sales" id="group_sales" required>
                                    </div>
                                    <div class="form-group text-left">
                                      <label>Maintain PV</label>
                                      <input type="number" class="form-control" step="any"  name="maintain_pv" id="maintain_pv" required>
                                    </div>
                                    <div class="form-group text-left">
                                      <label>Qualify PV</label>
                                      <input type="number" class="form-control" step="any"  name="qualify_pv" id="qualify_pv" required>
                                    </div>
                                    <br>
                                    <button data-dismiss="modal" class="btn btn-danger">Cancel</button>
                                    <button type="submit" class="btn btn-primary" name="btn_edit_quota" id="rank_id">Ok</button>
                                  </form>
                              </div>
                          </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

</div><!-- mainpanel -->     