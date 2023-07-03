  <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                                   <li>MLM</li>
                                </ul>
                                <h4>PRODUCTS</h4>
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
                                  <div class="row" style="margin-bottom: 15px;">
                                      <form method="post" class="form-inline" action="<?php echo BASE_URL() ?>Mlm/products" id="frmMlm">
                                        <div class="col-lg-6">
                                                <div class="form-group input-group" style="width: 100%;">
                                                    <span class="input-group-addon">Search</span>
                                                    <input type="text" name="product_name" class="form-control inputLetterValidator" placeholder="Product Name">
                                                    <span class="input-group-btn"><button type="submit" class="btn btn-primary" name="btn_search_prod" style="height: 34px;"><i class="fa fa-search fa-5px"></i></button></span>
                                                </div>
                                        </div>
                                        <div class="col-lg-6">
                                              <?php if($mlm['add_tangible_product'] == 1): ?>
                                                <button id="btn_add" name="btn_add" type="submit" class="btn btn-block btn-primary pull-right" style="width: 30%; height: 34px;"><i class="fa fa-plus" aria-hidden="true"> Add</i></button>
                                              <?php endif ?>
                                        </div>
                                      </form>
                                  </div>
                                  <div class="table-responsive">
                                      <table class="table table-bordered table-hover">
                                          <thead>
                                              <tr>
                                                <th>Product Code</th>
                                                <th>Product Name</th>
                                                <th>Price</th>
                                                <th>Hub Price</th>
                                                <th>Distributor Price</th>
                                                <th>Point Value</th>
                                                <th>Inventory</th>
                                                <th>Product Category</th>
                                                <th>Action</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <?php foreach ($products as $p): ?>
                                                <tr class="prod_row">
                                                  <td><?php echo $p['product_code'] ?></td>
                                                  <td><?php echo $p['product_name'] ?></td>
                                                  <td><?php echo $p['price'] ?></td>
                                                  <td><?php echo $p['hub_price'] ?></td>
                                                  <td><?php echo $p['distributor_price'] ?></td>
                                                  <td><?php echo $p['pv'] ?></td>
                                                  <td><?php echo $p['inventory'] ?></td>
                                                  <?php if ($p['type'] == 1): ?>
                                                    <td>Package</td>
                                                  <?php else: ?>
                                                    <td>Product</td>
                                                  <?php endif ?>
                                                  <td hidden><?php echo $p['rowid'] ?></td>
                                                  <?php if($mlm['edit_tangible_product'] == 1): ?>
                                                  <td><a class="btn_edit_prod" data-toggle="modal"><i class="fa fa-fw fa-edit"></i> Edit</a></td>
                                                  <?php else: ?>
                                                  <td>&nbsp;</td>
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


                    <div class="modal fade" id="myModal_add_prod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm" style="margin-top: 100px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">New Product</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="text-right" method="post" action="<?php echo BASE_URL() ?>Mlm/products" id="frmMlm">
                                      <div class="form-group text-left">
                                        <label>Product Code</label>
                                        <input type="text" class="form-control inputLetterValidator" name="prod_code" maxlength="3" required>
                                      </div>
                                      <div class="form-group text-left">
                                        <label>Product Name</label>
                                        <input type="text" class="form-control inputNameValidator" name="prod_name" maxlength="20"  required>
                                      </div>
                                      <div class="form-group text-left">
                                        <label>Price</label>
                                        <input type="number" class="form-control inputNumberValidator" min="1" maxlength="10" name="prod_price" required>
                                      </div>
                                      <div class="form-group text-left">
                                        <label>Hub Price</label>
                                        <input type="number" class="form-control inputNumberValidator" min="1" name="prod_hprice" required>
                                      </div>
                                      <div class="form-group text-left">
                                        <label>Distributor Price</label>
                                        <input type="number" class="form-controlinputNumberValidator" min="1" name="prod_dprice" required>
                                      </div>
                                      <div class="form-group text-left">
                                        <label>Point Value</label>
                                        <input type="number" class="form-control inputNumberValidator" step="any" name="prod_pv" required>
                                      </div>
                                      <div class="form-group text-left">
                                        <label>Inventory</label>
                                        <input type="number" class="form-control" min="1" name="prod_stock" required>
                                      </div>
                                       <div class="form-group text-left">
                                        <label>Category</label>
                                        <select class="form-control" name="prod_type" required>
                                            <option value="1">Package</option>
                                            <option value="2">Product</option>
                                        </select>
                                      </div>
                                      <br>
                                      <button data-dismiss="modal" class="btn btn-danger">Cancel</button>
                                      <button type="submit" class="btn btn-primary" name="btn_add_prod">Ok</button>
                                    </form>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->


                    <div class="modal fade" id="myModal_edit_prod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm" style="margin-top: 100px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Edit Product</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="text-right" method="post" action="<?php echo BASE_URL() ?>Mlm/products" id="frmMlm">
                                      <div class="form-group text-left">
                                        <label>Product Code</label>
                                        <input type="text" class="form-control inputLetterValidator" name="prod_code" id="prod_code" required>
                                      </div>
                                      <div class="form-group text-left">
                                        <label>Product Name</label>
                                        <input type="text" class="form-control inputNameValidator" name="prod_name" id="prod_name" required>
                                      </div>
                                      <div class="form-group text-left">
                                        <label>Price</label>
                                        <input type="number" class="form-control inputNumberValidator" min="1" step="any"  name="prod_price" id="prod_price" required>
                                      </div>
                                      <div class="form-group text-left">
                                        <label>Hub Price</label>
                                        <input type="number" class="form-control inputNumberValidator" min="1" step="any" name="prod_hprice" id="prod_hprice" required>
                                      </div>
                                      <div class="form-group text-left">
                                        <label>Distributor Price</label>
                                        <input type="number" class="form-control inputNumberValidator" min="1" step="any" name="prod_dprice" id="prod_dprice" required>
                                      </div>
                                      <div class="form-group text-left">
                                        <label>Point Value</label>
                                        <input type="number" class="form-control inputNumberValidator" step="any" name="prod_pv" id="prod_pv" required>
                                      </div>
                                      <div class="form-group text-left">
                                        <label>Inventory</label>
                                        <input type="number" class="form-control" min="1" name="prod_stock" id="prod_stock" required>
                                      </div>
                                       <div class="form-group text-left">
                                        <label>Category</label>
                                        <select class="form-control" name="prod_type" id="prod_type" required>
                                            <option value="1">Package</option>
                                            <option value="2">Product</option>
                                        </select>
                                      </div>
                                      <br>
                                      <button data-dismiss="modal" class="btn btn-danger">Cancel</button>
                                      <button type="submit" class="btn btn-primary" name="btn_edit_prod" id="prod_id">Ok</button>
                                    </form>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                    
    </div><!-- mainpanel -->            