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
                                <h4>HUB INVENTORY</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    

                    <div class="contentpanel">
                      <div class="row">

                              <div class="col-lg-12">  
                                <div class="row">
                                  <form method="post" class="form-inline" action="<?php echo BASE_URL() ?>Mlm/hub_inventory" id="frmMlm">
                                  <div class="col-lg-12">
                                      <div class="form-group">
                                        <b>Regcode</b>
                                        <input type="text" class="form-control" name="regcode" id="regcode" value="<?php echo $_POST['regcode']; ?>" required/>
                                      </div>
                                      <div class="form-group">
                                        <button type="submit" name="btnSearchReport" class="btn btn-primary" style="height: 34px;"><i class="glyphicon glyphicon-search"></i>&nbsp;SEARCH</button>
                                      </div>
                                      <div class="form-group pull-right1">
                                        <a href="<?php echo BASE_URL() ?>Mlm/csv_hub_inventory" class="btn btn-warning pull-right" name="btn_csv_report" style="height: 34px;"><i class="fa fa-download" aria-hidden="true"> Download CSV</i></a>
                                      </div>
                                  </div>
                                  </form>
                                </div>

                                <br>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover productTable">
                                      <thead>
                                        <tr>
                                          <th>Regcode</th>
                                          <th>Product Code</th>
                                          <th>Product Name</th>
                                          <th>Total Stocks</th>
                                          <th>Sold</th>
                                          <th>Available Stocks</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php //print_r($mlm_inventory_report) ?>
                                        <?php if(isset($mlm_inventory_report) && count($mlm_inventory_report) && !isset($mlm_inventory_report['S'])){ ?>
                                          <?php foreach ($mlm_inventory_report as $mlm): ?>
                                            <tr>
                                              <td><?php echo $mlm['regcode'] ?></td>
                                              <td><?php echo $mlm['product_code'] ?></td>
                                              <td><?php echo $mlm['product_name'] ?></td>
                                              <td><?php echo $mlm['stock_total_prod'] ?></td>
                                              <td><?php echo $mlm['total_sold'] ?></td>
                                              <td><?php echo $mlm['stock_avail_prod'] ?></td> 
                                            </tr>
                                          <?php endforeach ?>
                                        <?php }else{ ?>
                                          <!-- <tr class="text-center">
                                            <td colspan="7">
                                              <div class="alert alert-danger">
                                                <strong>No Data Available. Please Search Again.</strong>
                                              </div>
                                            </td>
                                          </tr> -->
                                        <?php } ?>
                                      </tbody>
                                    </table>
                                </div>

                        </div>
                      </div>
                   </div> 
                </div>
</div><!-- mainpanel -->     