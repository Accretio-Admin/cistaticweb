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
                                <h4>TANGIBLE PRODUCTS</h4>
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
                                      <form method="post" class="form-inline" action="<?php echo BASE_URL() ?>Mlm/products" id="frmMlm">
                                        <div class="col-lg-6">
                                                <div class="form-group input-group" style="width: 100%;">
                                                    <span class="input-group-addon">Search</span>
                                                    <input type="text" name="product_code" class="form-control inputLetterValidator" placeholder="Product Code">
                                                    <span class="input-group-btn"><button type="submit" class="btn btn-primary" name="btn_search_prod" style="height: 34px;"><i class="fa fa-search fa-5px"></i></button></span>
                                                </div>
                                        </div>
                                        <div class="col-lg-6">
                                              <?php if($mlm_user['add_tangible_product'] == 1): ?>
                                                <button id="btn_add" name="btn_add" type="submit" class="btn btn-block btn-primary pull-right" style="width: 30%; height: 34px; margin-left: 5px;"><i class="fa fa-plus" aria-hidden="true"> Add New Product</i></button>
                                              <?php endif ?>
                                                <a href="<?php echo BASE_URL() ?>Mlm/csv_products" class="btn btn-warning pull-right" name="btn_csv_products" style="height: 34px;"><i class="fa fa-download" aria-hidden="true"> Download CSV</i></a>
                                        </div>
                                      </form>
                                  </div>
                                  <div class="table-responsive">
                                      <table class="table table-bordered table-hover productTable">
                                          <thead>
                                              <tr>
                                                <th style="text-align: center;">Product Code</th>
                                                <th style="text-align: center;">Product Name</th>
                                                <th style="text-align: center;">Price (SRP)</th>
                                                <th style="text-align: center;">Dealer Price</th>
                                                <th style="text-align: center;">ECC Price</th>
                                                <th style="text-align: center;">Hub Price</th>
                                                <th style="text-align: center;">Point Value</th>
                                                <th style="text-align: center;">Qty</th>
                                                <th style="text-align: center;">Product Category</th>
                                                <th style="text-align: center;">Top</th>
                                                <?php if($mlm_user['edit_tangible_product'] == 1): ?>
                                                  <th colspan="2" style="text-align: center;">Action</th>
                                                  <th class="hidden"></th>
                                                <?php endif ?>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <?php foreach ($products as $p): ?>
                                                <?php if($p['type'] == 1){ $type =  'Package'; } else { $type =  'Product';} ?>
                                                <tr class="prod_row" data-toggle="tooltip" title="Description: <?php echo $p['product_desc'] ?>">
                                                  <td><?php echo $p['product_code'] ?></td>
                                                  <td><?php echo $p['product_name'] ?></td>
                                                  <td><?php echo $p['price'] ?></td>
                                                  <td><?php echo $p['dealer_price'] ?></td>
                                                  <td><?php echo $p['ecc_price'] ?></td>
                                                  <td><?php echo $p['hub_price'] ?></td>
                                                  <td><?php echo $p['pv'] ?></td>
                                                  <td><?php echo $p['inventory'] ?></td>
                                                  <td><?php echo $type ?></td>
                                                  <td nowrap>
                                                  <?php if($p['top_products'] == 1): ?>
                                                  <div class="top highlight" style="text-align: center;">
                                                  <?php else: ?>
                                                  <div class="rating highlight">
                                                  <?php endif ?>
                                                  <span style="text-align: bottom; font-size: 200%;">&#9733</span></div></td>
                                                  <?php if($mlm_user['edit_tangible_product'] == 1): ?>
                                                    <td nowrap><a class="btn_edit_prod" data-toggle="modal"><i class="fa fa-fw fa-edit"></i> <font style="color:#636E7B; cursor: pointer;">Edit</font></a></td>
                                                    <td nowrap>
                                                      <!-- <a class="btn_del_prod" data-toggle="modal"><i class="fa fa-trash-o" style="color:#FF0000;"></i> <font style="color:#636E7B; cursor: pointer;">Deactivate</font></a> -->
                                                      <a class="myModal_delete_prod" data-toggle="modal" data-target="#myModal_delete_prod"><i class="fa fa-trash-o" style="color:#FF0000;"></i> <font style="color:#636E7B; cursor: pointer;">Deactivate</font></a>
                                                    </td>
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

                    <div class="modal fade" id="myModal_add_prod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md" style="margin-top: 100px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">New Product</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="text-right" method="post" action="<?php echo BASE_URL() ?>Mlm/products">
                                      <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span class="input-group-addon" style="padding-right: 35px;"><label>Product Code</label></span>
                                              <input type="text" class="form-control" name="prod_code" maxlength="10" placeholder="Enter Product Code" required/>
                                          </div>
                                      </div>
                                      <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span class="input-group-addon" style="padding-right: 33px;"><label>Product Name</label></span>
                                              <input type="text" class="form-control inputNameValidator" name="prod_name" maxlength="50" placeholder="Enter Product Name" required/>
                                          </div>
                                      </div>
                                      <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span class="input-group-addon" style="padding-right: 50px;"><label>Description</label></span>
                                              <!-- <input type="text" class="form-control" name="prod_desc" maxlength="50" placeholder="Enter Product Description" required/> -->
                                              <textarea class="form-control" name="prod_desc" maxlength="500" placeholder="Enter Product Description" required></textarea>
                                          </div>
                                      </div>
                                      <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span class="input-group-addon" style="padding-right: 53px;"><label>Price (SRP)</label></span>
                                              <input type="number" step="any" class="form-control inputAmount" name="prod_price" maxlength="10" placeholder="Enter Product Price" required/>
                                          </div>
                                      </div>
                                      <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span class="input-group-addon" style="padding-right: 50px;"><label>Dealer Price</label></span>
                                              <input type="number" step="any" class="form-control inputAmount" name="prod_dealerprice" maxlength="10" placeholder="Enter Dealers Price" required/>
                                          </div>
                                      </div>
                                      <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span class="input-group-addon" style="padding-right: 63px;"><label>ECC Price</label></span>
                                              <input type="number" step="any" class="form-control inputAmount" name="prod_eccprice" maxlength="10" placeholder="Enter ECC Price" required/>
                                          </div>
                                      </div>
                                      <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span class="input-group-addon" style="padding-right: 65px;"><label>Hub Price</label></span>
                                              <input type="number" step="any" class="form-control inputAmount" name="prod_hubprice" maxlength="10" placeholder="Enter Hub Price" required/>
                                          </div>
                                      </div>
                                      <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span class="input-group-addon" style="padding-right: 52px;"><label>Point Value</label></span>
                                              <input type="number" step="any" class="form-control inputAmount" name="prod_pv" maxlength="10" placeholder="0.00000000" required/>
                                          </div>
                                      </div>
                                      <!-- <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span class="input-group-addon" style="padding-right: 70px;"><label>Quantity</label></span>
                                              <input type="hidden" class="form-control inputNumberValidator" value="0" name="prod_stock" maxlength="5" placeholder="Enter Qty" required/>
                                          </div>
                                      </div> -->
                                      <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span class="input-group-addon" style="padding-right: 67px;"><label>Category</label></span>
                                              <select class="form-control" name="prod_type" required>
                                                <option value="1" hidden>Package</option>
                                                <option value="2" selected>Product</option>
                                              </select>
                                          </div>
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
                        <div class="modal-dialog modal-md" style="margin-top: 100px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Update Product</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="text-right" method="post" action="<?php echo BASE_URL() ?>Mlm/products">
                                      <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span class="input-group-addon" style="padding-right: 35px;"><label>Product Code</label></span>
                                              <input type="text" class="form-control" name="prod_code" id="prod_code" maxlength="10" required/>
                                          </div>
                                      </div>
                                      <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span class="input-group-addon" style="padding-right: 33px;"><label>Product Name</label></span>
                                              <input type="text" class="form-control inputNameValidator" name="prod_name" id="prod_name" maxlength="50" required/>
                                          </div>
                                      </div>
                                      <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span class="input-group-addon" style="padding-right: 50px;"><label>Description</label></span>
                                              <!-- <input type="text" class="form-control" name="prod_desc" maxlength="50" placeholder="Enter Product Description" required/> -->
                                              <textarea class="form-control" name="prod_desc" id="prod_desc" maxlength="500" required></textarea>
                                          </div>
                                      </div>
                                      <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span class="input-group-addon" style="padding-right: 53px;"><label>Price (SRP)</label></span>
                                              <input type="number" step="any" class="form-control inputAmount" name="prod_price" id="prod_price" maxlength="10" required/>
                                          </div>
                                      </div>
                                      <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span class="input-group-addon" style="padding-right: 42px;"><label>Dealers Price</label></span>
                                              <input type="number" step="any" class="form-control inputAmount" name="prod_dealerprice" id="prod_dealerprice" maxlength="10" required/>
                                          </div>
                                      </div>
                                      <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span class="input-group-addon" style="padding-right: 63px;"><label>ECC Price</label></span>
                                              <input type="number" step="any" class="form-control inputAmount" name="prod_eccprice" id="prod_eccprice" maxlength="10" required/>
                                          </div>
                                      </div>
                                      <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span class="input-group-addon" style="padding-right: 64px;"><label>Hub Price</label></span>
                                              <input type="number" step="any" class="form-control inputAmount" name="prod_hubprice" id="prod_hubprice" maxlength="10" required/>
                                          </div>
                                      </div>
                                      <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span class="input-group-addon" style="padding-right: 52px;"><label>Point Value</label></span>
                                              <input type="number" step="any" class="form-control inputAmount" name="prod_pv" id="prod_pv" maxlength="10" required/>
                                          </div>
                                      </div>
                                      <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span class="input-group-addon" style="padding-right: 70px;"><label>Quantity</label></span>
                                              <input type="text" class="form-control inputNumberValidator" name="prod_stock" id="prod_stock" maxlength="5" required readonly=""/>
                                          </div>
                                      </div>
                                      <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span class="input-group-addon" style="padding-right: 67px;"><label>Category</label></span>
                                              <input class="form-control inputNumberValidator" name="prod_type2" id="prod_type2" readonly="">
                                              <input type="hidden" class="form-control inputNumberValidator" name="prod_type" id="prod_type" readonly="">
<!--                                          <select class="form-control" name="prod_type" required>
                                                <option value="1">Package</option>
                                                <option value="2">Product</option>
                                              </select> -->
                                          </div>
                                      </div>
                                      <br>
                                      <button data-dismiss="modal" class="btn btn-danger">Cancel</button>
                                      <button type="submit" class="btn btn-primary" name="btn_edit_prod" id="prod_id">Ok</button>
                                    </form>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                    <div class="deactivate modal fade" id="myModal_delete_prod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md" style="margin-top: 100px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Deactivate Product</h4>
                                </div>
                                <div class="modal-body">
                                      <div class="form-group text-left">    
                                          <div class="input-group">                       
                                              <span><label>Are you sure you want to deactivate this product?</label></span>
                                          </div>
                                      </div>
                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-danger">Cancel</button>
                                    <a class="btn_del_prod btn btn-primary" data-toggle="modal">Deactivate</a>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                    
    </div><!-- mainpanel -->            