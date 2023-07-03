  <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-trophy"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>MLM PRODUCT SELLING</li>
                                </ul>
                                <h4>INVENTORY REPORT</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    

                    <div class="contentpanel">
                      <div class="row">

                              <div class="col-lg-12">  
                                <div class="row">
                                  <form method="post" class="form-inline" action="<?php echo BASE_URL() ?>Products/inventory_report" id="frmMlm">
                                  <div class="col-lg-12">
                                      <div class="form-group">
                                        <b>START</b>
                                        <input type="text" class="form-control" name="inputStart" id="datetimepicker" value="<?php echo $_POST['inputStart']? $_POST['inputStart']: date('Y-m-d'); ?>" required/>
                                      </div>
                                      <div class="form-group">
                                        <b>END</b>
                                          <input type="text" class="form-control" name="inputEnd" id="datetimepicker"  value="<?php echo $_POST['inputEnd']? $_POST['inputEnd']: date('Y-m-d'); ?>" required/>
                                      </div>
                                      <div class="form-group" style="width: 310px;">
                                        <b>Product Code</b>
                                         <select class="form-control" name="prodcode" style="width: 200px;">
                                          <option value="" disabled selected>--SELECT--</option>
                                              <?php foreach ($products as $mlm): ?>
                                                <option value="<?php echo $mlm['product_code'] ?>" <?php if ($mlm['product_code'] == $_POST['prodcode']) { echo ' selected="selected"'; } ?>><?php echo $mlm['product_code'] ?></option>
                                              <?php endforeach ?>
                                          </select> 
                                      </div>
                                      <div class="form-group">
                                        <button type="submit" name="btnSearchReport" class="btn btn-primary" style="height: 34px;"><i class="glyphicon glyphicon-search"></i>&nbsp;SEARCH</button>
                                      </div>
                                      <div class="form-group pull-right1">
                                        <a href="<?php echo BASE_URL() ?>Products/csv_inventory_report" class="btn btn-warning pull-right" name="btn_csv_report" style="height: 34px;"><i class="fa fa-download" aria-hidden="true"> Download CSV</i></a>
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
                                          <th>Transtype</th>
                                          <th>Inventory Count</th>
                                          <th>Inventory Before</th>
                                          <th>Inventory After</th>
                                          <th>DateTime</th>
                                          <th>Trackno</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php //print_r($mlm_inventory_report) ?>
                                        <?php if(isset($mlm_inventory_report) && count($mlm_inventory_report) && !isset($mlm_inventory_report['S'])){ ?>
                                          <?php foreach ($mlm_inventory_report as $mlm): ?>
                                            <tr>
                                              <td><?php echo $mlm['reference_regcode'] ?></td>
                                              <td><?php echo $mlm['product_code'] ?></td>
                                              <td><?php echo $mlm['transtype'] ?></td>
                                              <td><?php echo $mlm['inventory_amount'] ?></td>
                                              <td><?php echo $mlm['inventory_before'] ?></td>
                                              <td><?php echo $mlm['inventory_after'] ?></td>
                                              <td><?php echo $mlm['datetime'] ?></td> 
                                              <td><?php echo $mlm['trackno'] ?></td> 
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