  <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-trophy"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                                   <li>MLM PRODUCT INVENTORY</li>
                                </ul>
                                <h4>REPORT</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    

                    <div class="contentpanel">
                      <div class="row">
                          <?php if (empty($mlm_report)): ?>
                            <div class="col-lg-12">
                              <?php if ($result['S'] == 1): ?>
                                <div class="alert alert-success"><?php echo $result['M'] ?></div>
                              <?php elseif ($result['S'] == 2): ?>
                                <div class="alert alert-danger"><?php echo $result['M'] ?></div>
                              <?php endif ?>
                                <form method="post" class="form-inline" action="<?php echo BASE_URL() ?>Mlm/mlm_report" id="frmMlm">
                                  <div class="form-group" style="width: 30%;">
                                     <select class="form-control" name="selMLMReport" style="width: 100%;">
                                      <option value="" disabled selected>SELECT REPORT</option>
                                      <?php 
                                      foreach ($r_title as $row): ?>
                                            <option value="<?php echo $row['id'].'|'. $row['desc'] ?>"><?php echo $row['desc'] ?></option>
                                      <?php endforeach ?>
                                      </select> 
                                  </div>
                                  <div class="form-group">
                                    <button type="submit" name="btnSearch" class="btn btn-primary" style="height: 34px;"><i class="glyphicon glyphicon-search"></i>&nbsp;SEARCH</button>
                                  </div>
                                </form>
                                <br>
                              </div>
                              <?php endif ?>

                                <?php if (!empty($mlm_report)): ?>
                                <div class="col-lg-12">  
                                <div class="row">
                                  <form method="post" class="form-inline" action="<?php echo BASE_URL() ?>Mlm/mlm_report" id="frmMlm">
                                  <div class="col-lg-12">
                                      <div class="form-group">
                                        <b>START</b>
                                        <input type="text" class="form-control" name="inputStart" id="datetimepicker" value="" readonly  required/>
                                      </div>
                                      <div class="form-group">
                                        <b>END</b>
                                          <input type="text" class="form-control" name="inputEnd" id="datetimepicker"  value="" readonly required/>
                                      </div>
                                      <div class="form-group" style="width: 300px;">
                                        <b>CATEGORY</b>
                                         <select class="form-control" name="selCategory" style="width: 200px;">
                                          <option value="" disabled selected>--SELECT--</option>
                                                <option value="1">PACKAGE</option>
                                                <option value="2">PRODUCT</option>
                                          </select> 
                                      </div>
                                      <div class="form-group">
                                        <button type="submit" name="btnSearchReport" class="btn btn-primary" style="height: 34px;"><i class="glyphicon glyphicon-search"></i>&nbsp;SEARCH</button>
                                      </div>
                                      <div class="form-group pull-right">
                                        <a href="<?php echo BASE_URL() ?>Mlm/csv_report_gen" class="btn btn-warning pull-right" name="btn_csv_report" style="height: 34px;"><i class="fa fa-download" aria-hidden="true"> Download CSV</i></a>
                                      </div>
                                  </div>
                                  </form>
                                </div>
                                <br>

                               <?php  if($mlm_report['S'] == 0):?>
                                <div class="table-responsive"> 
                                  <h5><?php echo $mlm_report['M'] ?></h5>
                                </div>
                               <?php else: ?>   

                                  <div class="table-responsive">
                                      <h4 style="text-align: center; font-family: Times New Roman, Georgia, Serif;"><strong><?php echo $title ?></strong></h4>
                                      <table class="table table-bordered table-hover productTable">
                                        <thead>
                                          <tr>
                                          <th>Regcode</th>
                                          <?php if($mlm_user['user_type'] != 1){ ?>
                                          <th>Sold to</th>
                                          <?php }else{ ?>
                                          <th>Distributed to</th>
                                          <?php } ?>
                                          <th>Product Code</th>
                                          <th>Product Name</th>
                                          <th>Total Quantity</th>
                                          <th>Price (SRP)</th>
                                          <th>Total PV</th>
                                          <?php if($mlm_user['user_type'] != 1){ ?>
                                          <th>Total Discount</th>
                                          <?php } ?>
                                          <th>Total Amount</th>
                                          <th>Product Category</th>
                                          <?php if($mlm_user['user_type'] != 1){ ?>
                                          <th>Mode of Payment</th>
                                          <?php } ?>
                                          <th>Transaction Date</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php foreach ($mlm_report['T_DATA'] as $mlm): ?>
                                          <tr>
                                          <td><?php echo $mlm['regcode'] ?></td>
                                          <td><?php echo $mlm['purchasing_regcode'] ?></td>
                                          <td><?php echo $mlm['prod_code'] ?></td>
                                          <td><?php echo $mlm['prod_name'] ?></td>
                                          <td><?php echo $mlm['quantity'] ?></td> 
                                          <td><?php echo number_format($mlm['SRP']) ?></td>
                                          <td><?php echo $mlm['pv'] ?></td>
                                          <?php if($mlm_user['user_type']!= 1){ ?>
                                          <td><?php echo number_format($mlm['discount']) ?></td>
                                          <?php } ?>
                                          <td><?php echo number_format($mlm['price']) ?></td>
                                          <td><?php echo $mlm['type']==1?'Package':'Product' ?></td>
                                          <?php if($mlm_user['user_type'] != 1){ ?>
                                          <td><?php echo $mlm['payment_type'] ?></td>
                                          <?php } ?>
                                          <td><?php echo $mlm['date_purchased'] ?></td>
                                          </tr>
                                          <?php endforeach ?>
                                        </tbody>
                                      </table>
                                  </div>

                                <?php endif ?>                                                               
                            <?php endif ?>
                        </div>
                        </div>
                     </div> 
                  </div>
</div><!-- mainpanel -->     