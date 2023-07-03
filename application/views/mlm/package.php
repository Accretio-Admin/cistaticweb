  <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-suitcase"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                                   <li>MLM PRODUCT INVENTORY</li>
                                </ul>
                                <h4>PACKAGE</h4>
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
                                            <th>Currency</th>
                                            <th>Peso Rate</th>
                                            <th>Global Package Price</th>
                                            <th>Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php foreach ($countries as $c): ?>
                                            <tr class="row_currency">
                                              <td><?php echo $c['currency'] ?></td>
                                              <td><?php echo $c['currency_value'] ?></td>
                                              <td><?php echo $c['globalpackage'] ?></td>
                                              <td hidden><?php echo $c['rowid'] ?></td>
                                              <td><a class="btn_edit_package_currency" data-toggle="modal"><i class="fa fa-fw fa-edit"></i> Edit</a></td>
                                            </tr>
                                          <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div><!-- contentpanel -->

                    <div class="modal fade" id="myModal_edit_package" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-sm" style="margin-top: 100px;">
                          <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Edit Package</h4>
                              </div>
                              <div class="modal-body">
                                  <form class="text-right" method="post" action="<?php echo BASE_URL() ?>Mlm/package">
                                    <div class="form-group text-left">
                                      <label>Currency</label>
                                      <input type="text" class="form-control" name="i_currency" id="i_currency" readonly>
                                    </div>
                                    <div class="form-group text-left">
                                      <label>Peso Rate</label>
                                      <input type="text" class="form-control numberOnly" name="i_rate" id="i_rate" required>
                                    </div>
                                    <div class="form-group text-left">
                                      <label>Global Package Price</label>
                                      <input type="text" class="form-control numberOnly" name="i_gprice" id="i_gprice" required>
                                    </div>
                                    <br>
                                    <button data-dismiss="modal" class="btn btn-danger">Cancel</button>
                                    <button type="submit" class="btn btn-primary" name="btn_edit_package_currency" id="p_id">Ok</button>
                                  </form>
                              </div>
                          </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

</div><!-- mainpanel -->     