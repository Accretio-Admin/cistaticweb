  <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-money"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                                   <li>MLM PRODUCT INVENTORY</li>
                                </ul>
                                <h4>GC</h4>
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
                              <form method="post" class="form-inline" action="<?php echo BASE_URL() ?>Mlm/gc" id="frmMlm">
                              <div class="row" style="margin-bottom: 15px;">
                                    <div class="col-lg-10">
                                        <div class="form-group input-group" style="width: 100%;">
                                            <span class="input-group-addon">Start Date:</span>
                                            <input type="text" name="start_date" id="datetimepicker" class="form-control" placeholder="Start Date" style="width: 100px;">
                                            <span class="input-group-addon">End Date:</span>
                                            <input type="text" name="end_date" id="datetimepicker" class="form-control" placeholder="End Date" style="width: 100px;">
                                            <span class="input-group-addon">Tracking No.:</span>
                                            <input type="text" name="trackno" class="form-control inputAlphanumericValidator" placeholder="Tracking No." style="width: 175px;" maxlength="30">
                                            <span class="input-group-addon">Status:</span>
                                            <select class="form-control" name="gc_status" style="width: 130px;">
                                              <option selected value="3">Select Status</option>
                                              <option value="0">For Generation</option>
                                              <option value="1">For Release</option>
                                              <option value="2">Released</option>
                                              <option value="3">All</option>
                                            </select>
                                            <span class="input-group-btn"><button name="btn_search_by_status" type="submit" class="btn btn-primary" style="height: 34px;" id="btnMlmSearch"><i class="fa fa-search fa-5px"></i></button></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                      <?php if($csv_btn_on == 1): ?>
                                      <a href="<?php echo BASE_URL() ?>Mlm/csv_gc" class="btn btn-warning" name="btn_csv_gc" style="height: 35px; margin-top:4px;"><i class="fa fa-download" aria-hidden="true"> Download CSV</i></a>
                                      <?php endif ?>
                                      <?php if($generate_btn_on == 1): ?>
                                        <button type="button" class="btn btn-block btn-success" style="height: 35px; margin-top:4px;" data-toggle="modal" data-target="#myModal"><i class="fa fa-download" aria-hidden="true"> Generate GC</i></button>
                                      <?php endif ?>
                                    </div>
                              </div>

                              <div id="myModal" class="modal fade" role="dialog">
                                  <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-body">
                                        <h4>Are you sure you want to proceed ?</h4>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary"  name="btn_generate_gc">Proceed</button>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                              </form>
                              
                              <div class="table-responsive">
                            <?php if (empty($gc_details)): ?>
                              <br>
                              <h3 class="text-center">No result found</h3>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                      <thead>
                                        <tr>
                                          <th>Regcode</th>
                                          <th>Claimant</th>
                                          <th>Gift Cheque</th>
                                          <th>Tracking Number</th>
                                          <th>Date Generated</th>
                                          <th>Status</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php foreach ($gc_details as $gd): ?>
                                          <tr class="row_gc">
                                            <td><?php echo $gd['regcode'] ?></td>
                                            <td><?php echo $gd['claimant'] ?></td>
                                            <td><?php echo $gd['gc'] ?></td>
                                            <td><?php echo $gd['trackno'] ?></td>

                                            <?php if ($gd['dategenerated'] == "0000-00-00"): ?>
                                              <td>---</td>
                                            <?php else: ?>
                                              <td><?php echo $gd['dategenerated'] ?></td>
                                            <?php endif ?>
                                            <td><?php echo $gd['remarks'] ?></td>
                                          </tr>
                                        <?php endforeach ?>
                                      </tbody>
                                    </table>
                                  <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div><!-- contentpanel -->

</div><!-- mainpanel -->     