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
                                <h4>ONLINE PURCHASED</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    <div class="contentpanel">
                     <form method="post" method="<?php echo BASE_URL()?>Report/online_purchase">
                          <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <div class="col-xs-3 col-md3">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2 col-md-2">
                                                <b>START &nbsp;</b>
                                            </div>
                                            <div class="col-xs-10 col-md-10">
                                                <input type="text" class="form-control" name="inputStart" id="datetimepicker" readonly  />
                                            </div>
                                        </div>
                                         
                                    </div>
                                </div>
                                <div class="col-xs-3 col-md-3">
                                      <div class="form-group">
                                       <div class="row">
                                            <div class="col-xs-2 col-md-2">
                                                <b>END</b>
                                            </div>
                                            <div class="col-xs-10 col-md-10">
                                                <input type="text" class="form-control" name="inputEnd" id="datetimepicker"   readonly />
                                            </div>
                                        </div>
                                      </div>
                                </div>
                                <div class="col-xs-4 col-md-4">
                                   <div class="form-group">
                                      <button type="submit" name="btnSearch" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>&nbsp;SEARCH</button>
                                      <button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i>&nbsp;&nbsp;GENERATE</button>
                                    </div>
                                </div>
                            </div>    
                          </div>
                          <?php if ($process['P'] == 1 && $process['S'] ===0): ?>
                              <div class="row">
                                <div class="col-xs-10 col-md-10">
                                  <div class="alert alert-danger"><b><?php echo $process['M']; ?></b></div>
                                </div>   
                              </div>
                          <?php endif ?>

                           <?php if ($process['P'] == 1 && $process['S'] ==1): ?>
                              <div class="row">
                                <div class="col-xs-12 col-md-12">
                                    <div class="text-right" style="margin-bottom:5px">
                                        <span class="badge badge-danger">Count : 1</span>
                                    </div>
                                      <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Transaction #</th>
                                                    <th>Reg Code</th>
                                                    <th>Tracking No.</th>
                                                    <th>Package Type</th>
                                                    <th>Country</th>
                                                    <th>Email Dealer</th>
                                                    <th>Email Client</th>
                                                    <th>Address</th>
                                                    <th>Amount</th> 
                                                    <th>Balance</th>
                                                    <th>Arrival</th> 
                                                    <th>Balance</th> 
                                                    <th>Baggage</th> 
                                                    <th>Date<th> 
                                                    <th>Time<th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                    <td>Transaction #</td>
                                                    <td>Reg Code</td>
                                                    <td>Tracking No.</td>
                                                    <td>Package Type</td>
                                                    <td>Country</td>
                                                    <td>Email Dealer</td>
                                                    <td>Email Client</td>
                                                    <td>Address</td>
                                                    <td>Amount</td> 
                                                    <td>Balance</td>
                                                    <td>Arrival</td> 
                                                    <td>Balance</td> 
                                                    <td>Baggage</td> 
                                                    <td>Date<td> 
                                                    <td>Time<td> 
                                              </tr>
                                            </tbody>
                                      </table>
                                </div>   
                              </div>
                          <?php endif ?>
                      </form>

                    </div><!-- contentpanel -->
                    
                </div><!-- mainpanel -->            