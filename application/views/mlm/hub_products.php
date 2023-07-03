  
  <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                                   <li>MLM PRODUCT INVENTORY</li>
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
                                      <form method="post" class="form-inline" action="<?php echo BASE_URL() ?>Mlm/hub_products" id="frmMlm">
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
                                      <?php  if($products['S'] == 0){ ?> 

                                      <table class="table table-bordered table-hover">
                                          <thead>
                                              <tr>
                                                <th style="text-align: center;">Product Code</th>
                                                <th style="text-align: center;">Product Name</th>
                                                <th style="text-align: center;">Price (SRP)</th>
                                                <th style="text-align: center;">Discounted Price</th>
                                                <th style="text-align: center;">Point Value</th>
                                                <th style="text-align: center;">Qty</th>
                                                <th class="hidden"></th>
                                                <th style="text-align: center;">Product Category</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                          <tr><td colspan="8" style="text-align: center; color: #2978c1;"><?php echo $products['M'] ?></td></tr>
                                          </tbody>
                                        </table>   

                                    <?php  } else { ?>   

                                      <table class="table table-bordered table-hover productTable">
                                          <thead>
                                              <tr>
                                                <th style="text-align: center;">Product Code</th>
                                                <th style="text-align: center;">Product Name</th>
                                                <th style="text-align: center;">Price (SRP)</th>
                                                <th style="text-align: center;">Discounted Price</th>
                                                <th style="text-align: center;">Point Value</th>
                                                <th style="text-align: center;">Qty</th>
                                                <th class="hidden"></th>
                                                <th style="text-align: center;">Product Category</th>
                                              </tr>
                                          </thead>                                        
                                          
                                          <tbody>  
                                              <?php
                                                 foreach ($products['DATA_LIST'] as $p): ?>
                                                  <?php if($p['type'] == 1){ $type =  'Package'; } else { $type =  'Product';} ?>
                                                  <tr class="prod_row">
                                                    <td><?php echo $p['product_code'] ?></td>
                                                    <td><?php echo $p['product_name'] ?></td>
                                                    <td><?php echo $p['price'] ?></td>
                                                    <td><?php echo $p['hub_price'] ?></td>
                                                    <td><?php echo $p['pv'] ?></td>
                                                    <td><?php echo $p['inventory'] ?></td>
                                                    <td class="hidden"><?php echo $p['type'].'|'.$p['rowid'] ?></td>
                                                    <td><?php echo $type ?></td>
                                                  </tr>
                                                <?php endforeach ?>
                                          </tbody>
                                      </table>
                                      <?php }?>
                                  </div>
                              </div>
                          </div>
                          <!-- /.row -->
                    </div><!-- contentpanel -->
    </div><!-- mainpanel -->            