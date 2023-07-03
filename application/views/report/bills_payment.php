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
                                <h4>BILLS PAYMENT</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    <div class="contentpanel">
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
                                    <a href="<?php echo BASE_URL(); ?>Report/export/<?php echo md5('billspayment') ?>" target="_blank">
                                       <button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i>&nbsp;&nbsp;GENERATE</button>
                                      </a>
                                </div>
                                <div class="col-xs-12 col-md-12">
                                    <div class="text-right" style="margin-bottom:5px">
                                        <span class="badge badge-danger"><?php echo $process['M']; ?></span>
                                    </div>
                                      <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Tracking #</th>
                                                    <th>Regcode</th>
                                                    <th>Institution</th>
                                                    <th>Biller</th>
                                                    <th>Account #</th>
                                                    <th>Account Name</th>
                                                    <th>Amount</th>
                                                    <th>Date/Time</th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                              <?php foreach ($API['TDATA'] as $b): ?>

                                                  <tr>  
                                                      <?php if($b['S'] == 1) { ?>
                                                        <td><a href="<?php echo $b['URL']; ?>" target="_blank"><?php echo $b['TN']; ?></a></td>
                                                      <?php } else { ?>
                                                        <td><?php echo $b['TN']; ?></td>
                                                      <?php } ?>
                                                      <td><?php echo $b['R']; ?></td>
                                                      <td><?php echo $b['IC']; ?></td>
                                                      <td><?php echo $b['BN']; ?></td>
                                                      <td><?php echo $b['ACNO']; ?></td>
                                                      <td><?php echo $b['ACNM']; ?></td>
                                                      <td><?php echo $b['A']; ?></td>
                                                      <td><?php echo $b['D']; ?></td>
                                                      
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                      </table>
                                </div>   
                              </div>
                          <?php endif ?>
                     

                    </div><!-- contentpanel -->
                    
                </div><!-- mainpanel -->            