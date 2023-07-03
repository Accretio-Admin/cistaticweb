<style type="text/css">
.rating {
  unicode-bidi: bidi-override;
  direction: rtl;
  text-align: center;
}
.rating > span {
  display: inline-block;
  position: relative;
}
.rating > span:hover,
.rating > span:hover ~ span {
  color: transparent;
}

.rating > span:hover:before,
.rating > span:hover ~ span:before {
   content: "\2605";
   position: absolute;
   left: 0; 
   color: gold;
} 

.top {
  unicode-bidi: bidi-override;
  direction: rtl;
  text-align: center;
}
.top > span {
  display: inline-block;
  position: relative;
  color: gold;
}
.top > span:hover,
.top > span:hover ~ span {
  color: transparent;
}
.top > span:hover:before,
.top > span:hover ~ span:before {
   content: "\2605";
   position: absolute;
   left: 0; 
   color: black;
}


.table > tbody > .prod_row > td{
      vertical-align: middle;
}

</style>
  <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li><a href="/Mlm">MLM PRODUCT INVENTORY</a></li>
                                </ul>
                                <h4>ADD PRODUCT INVENTORY</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    
                    <div class="contentpanel">
                          <div class="row">
                                  <div class="col-lg-12">
                                  <div class="alert alert-success" id="alertSuccess" style="display: none;"></div>
                                  <div class="alert alert-danger" id="alertDanger" style="display: none;"></div>
                                <?php if ($result['S'] == 1): ?>
                                  <div class="alert alert-success"><?php echo $result['M'] ?></div>
                                <?php elseif ($result['S'] == 2): ?>
                                  <div class="alert alert-danger"><?php echo $result['M'] ?></div>
                                <?php endif ?>
                                  <div class="row" style="margin-bottom: 15px;">
                                      <form method="post" class="form-inline" action="<?php echo BASE_URL() ?>Mlm/addProd_inventory" id="frmMlm">
                                        <div class="col-lg-6">
                                                <div class="form-group input-group" style="width: 100%;">
                                                    <span class="input-group-addon">Search</span>
                                                    <input type="text" name="product_code" class="form-control inputLetterValidator" placeholder="Product Code">
                                                    <span class="input-group-btn"><button type="submit" class="btn btn-primary" name="btn_search_prod" style="height: 34px;"><i class="fa fa-search fa-5px"></i></button></span>
                                                </div>
                                        </div>
                                        <!-- <div class="col-lg-6">
                                              <?php if($mlm_user['add_tangible_product'] == 1): ?>
                                                <button id="btn_add" name="btn_add" type="submit" class="btn btn-block btn-primary pull-right" style="width: 30%; height: 34px; margin-left: 5px;"><i class="fa fa-plus" aria-hidden="true"> Add New Product</i></button>
                                              <?php endif ?>
                                                <a href="<?php echo BASE_URL() ?>Mlm/csv_products" class="btn btn-warning pull-right" name="btn_csv_products" style="height: 34px;"><i class="fa fa-download" aria-hidden="true"> Download CSV</i></a>
                                        </div> -->
                                      </form>
                                  </div>
                                  <div class="table-responsive">
                                      <table class="table table-bordered table-hover productTable">
                                          <thead>
                                              <tr>
                                                <th style="text-align: center;">Product Code</th>
                                                <th style="text-align: center;">Product Name</th>
                                                <th style="text-align: center;">Sold</th>
                                                <th style="text-align: center;">Remaining Inventory</th>
                                                <th style="text-align: center;">Last Replenishment</th>
                                                <th style="text-align: center;">Last Replenishment Date</th>
                                                <?php if($mlm_user['edit_tangible_product'] == 1): ?>
                                                  <th colspan="2" style="text-align: center;">Action</th>
                                                <?php endif ?>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <?php foreach ($products as $p): ?>
                                                <?php if($p['type'] == 1){ $type =  'Package'; } else { $type =  'Product';} ?>
                                                <tr class="prod_row" data-toggle="tooltip" title="Description: <?php echo $p['product_desc'] ?>">
                                                  <td><?php echo $p['product_code'] ?></td>
                                                  <td><?php echo $p['product_name'] ?></td>
                                                  <td><?php echo $p['sold'] ?></td>
                                                  <td><?php echo $p['inventory'] ?></td>
                                                  <td><?php echo $p['lastreplenishment']; ?></td>
                                                  <td><?php echo $p['last_replenishdate']; ?></td>
                                                  
                                                  <?php if($mlm_user['edit_tangible_product'] == 1): ?>
                                                    <td nowrap><a class="btn_add_inv" data-toggle="modal"><i class="fa fa-fw fa-plus-square"></i> <font style="color:#636E7B; cursor: pointer;">Add Inventory</font></a></td>
                                                    <!-- <td nowrap><a class="btn_del_prod" data-toggle="modal"><i class="fa fa-trash-o" style="color:#FF0000;"></i> <font style="color:#636E7B; cursor: pointer;">Deactivate</font></a></td> -->
                                                  <?php else: ?>
                                                    <!-- <td>&nbsp;</td>
                                                    <td>&nbsp;</td> -->
                                                  <?php endif ?>
                                                  <td class="hidden"><?php echo $p['type'].'|'.$p['rowid'] ?></td>
                                                  <td class="hidden"><?php echo $p['product_desc'] ?></td>
                                                </tr>
                                              <?php endforeach ?>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                          </div>
                          <!-- /.row -->
                    </div><!-- contentpanel -->

                    <div class="modal fade" id="myModal_add_inv" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md" style="margin-top: 100px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Add Product Inventory</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="text-right" method="post" action="<?php echo BASE_URL() ?>Mlm/addProd_inventory">
                                      <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span class="input-group-addon" style="padding-right: 60px;"><label>Product Code</label></span>
                                              <input type="text" class="form-control" name="prod_code" id="prod_code" maxlength="10" required readonly="" />
                                          </div>
                                      </div>
                                      <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span class="input-group-addon" style="padding-right: 58px;"><label>Product Name</label></span>
                                              <input type="text" class="form-control inputNameValidator" name="prod_name" id="prod_name" maxlength="50" required readonly="" />
                                          </div>
                                      </div>
                                      <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span class="input-group-addon" style="padding-right: 123px;"><label>Sold</label></span>
                                              <input type="text" class="form-control inputAmount" name="prod_sold" id="prod_sold" maxlength="10" required readonly="" />
                                          </div>
                                      </div>
                                      <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span class="input-group-addon"><label>Remaining Inventory</label></span>
                                              <input type="text" class="form-control inputAmount" name="prod_remaining" id="prod_remaining" maxlength="10" required readonly="" />
                                          </div>
                                      </div>
                                      
                                      <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span class="input-group-addon" style="padding-right: 39px;"><label>Add to Inventory</label></span>
                                              <input type="number" class="form-control" name="prod_addToINV" id="prod_addToINV" maxlength="10" placeholder="amount" required />
                                          </div>
                                      </div>
                                      <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span class="input-group-addon" style="padding-right: 76px;"><label>Expiry Date</label></span>
                                              <input type="text" class="form-control" name="prod_expdate" id="datetimepicker"/>
                                          </div>
                                      </div>

                                      <br>
                                      <button data-dismiss="modal" class="btn btn-danger">Cancel</button>
                                      <button type="submit" class="btn btn-primary" name="btn_add_inv" id="prod_id">Ok</button>
                                    </form>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                    
    </div><!-- mainpanel -->            