  <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-money"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>REPORT</li>
                                </ul>
                                <h4>MLM REPORT</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    <div class="contentpanel">
                      <?php if ($API['S'] === 0): ?>
                        <div class="alert alert-danger"><?php echo $API['M']; ?></div> 
                      <?php endif ?>
                     <form method="post" action="<?php echo BASE_URL()?>Products/mlm_ups_reports" id="frmreport">
                          <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <div class="col-xs-12 col-md-3">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12 col-md-3">
                                                <b>START &nbsp;&nbsp;&nbsp;&nbsp;</b>
                                            </div>
                                            <div class="col-xs-12 col-md-9">
                                                <input type="text" class="form-control readonly" name="inputStart" id="datetimepicker" value="<?php echo $_POST['inputStart'];?>" placeholder="YYYY-MM-DD" autocomplete="off" required/>
                                            </div>
                                        </div>
                                         
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-3">
                                      <div class="form-group">
                                       <div class="row">
                                            <div class="col-xs-12 col-md-2">
                                                <b>END</b>
                                            </div>
                                            <div class="col-xs-12 col-md-10">
                                                <input type="text" class="form-control readonly" name="inputEnd" id="datetimepicker"  value="<?php echo $_POST['inputEnd'];?>" placeholder="YYYY-MM-DD" autocomplete="off" required/>
                                            </div>
                                        </div>
                                      </div>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                   <div class="form-group">
                                      <button type="submit" name="btnSearch" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>&nbsp;SEARCH</button>
                                      <a href="<?php echo BASE_URL(); ?>Products/export/<?php echo md5('mlm_ups_reports') ?>" target="_blank">
                                      <button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i>&nbsp;&nbsp;GENERATE</button>
                                      </a>

                                    </div>
                                </div>
                            </div>    
                          </div>
                       

                           <?php //if ($process['P'] == 1 && $process['S'] ==1): ?>
                              <div class="row">
                                <div class="col-xs-12 col-md-12">
                                    <div class="text-right" style="margin-bottom:5px">
                                        <span class="badge badge-primary"><?php echo $API['M']; ?></span>
                                    </div>
                                        <div class="col-md-12 col-xs-12" style="overflow-y:auto;height:430px" >
                                        <!-- <div  class="col-md-12 col-xs-12" > -->
                                             <table  class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Regcode</th>
                                                            <th>Tracking #</th>
                                                            <th>Purchasing Regcode</th>
                                                            <th>Total Product Quantity</th>
                                                            <th>Total Price</th>
                                                            <th>Date Purchased</th>
                                                        </tr>
                                                    </thead>
                                                        <tbody>
                                                   
                                                               <?php foreach ($API['TDATA'] as $A ): ?>
                                                                    <tr>
                                                                        <td><?php echo $A['regcode'];?></td>
                                                                        <td><a href="<?php echo $A['URL']; ?>" target="_blank"><?php echo $A['trackingno'];?></td>
                                                                        <td><?php echo $A['purchasing_regcode'];?></td>
                                                                        <td><?php echo $A['total_product_qty'];?></td>
                                                                        <td><?php echo $A['total_price'];?></td>
                                                                        <td><?php echo $A['date_purchased'];?></td>
                                                                      </tr>
                                                                <?php endforeach ?>
                                                            </tbody>
                                                            </table>
                                                        </div>
                                                
                                            
                                     
                                 
                              </div>


                            </div>
                          <?php //endif ?>
                      </form>

                    </div><!-- contentpanel -->
                    
                </div><!-- mainpanel -->            