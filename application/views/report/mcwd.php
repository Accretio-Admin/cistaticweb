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
                                <h4>MCWD REPORT</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    <div class="contentpanel">
                     <form method="post" action="<?php echo BASE_URL()?>Report/mcwd" id="frmreport" >
                          <div class="row">
                            <div class="col-xs-12 col-md-12">

                                <div class="col-xs-12 col-md-4">
                                  <div class="col-xs-12 col-md-6">


                                                  <input type="text" class="form-control" name="inputStart" id="datetimepicker"  placeholder="Start Date" value="<?php echo $_POST['inputStart']; ?>" required />


                                  </div>
                                  <div class="col-xs-12 col-md-6">


                                                  <input type="text" class="form-control" name="inputEnds" id="datetimepickers" placeholder="End Date" value="<?php echo $_POST['inputEnds']; ?>" required />


                                  </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4 text-left">

                                      <button type="submit" name="btnSearch" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>&nbsp;SEARCH</button>
                                       <a href="<?php echo BASE_URL(); ?>Report/export/<?php echo md5('mcwd_report') ?>" target="_blank">
                                       <button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i>&nbsp;&nbsp;GENERATE</button>
                                      </a>

                                </div>
                            </div>    
                          </div>
                     </form>
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
                                        <span class="badge badge-danger"><?php echo $process['M']; ?></span>
                                    </div>
                                      <div  class="col-md-12 col-xs-12" style="overflow-y:scroll;height:350px;overflow-x:auto" >
                                           <table class="table table-bordered" style="width:auto;">
                                                  <thead>
                                                      <tr>
                                                          <?php foreach ($field as $f ): ?>
                                                                 <th width="150"><?php echo $f;?></th>
                                                          <?php endforeach ?>
                                                         
                                                      </tr>
                                                  </thead> 
                                                  <tbody>
                                                       <?php if ($TBODY == 1): ?>
                                                         <?php foreach ($API['TDATA'] as $row): ?>
                                                          <tr>
                                                              <td><?php echo $row['trackno'];?></td>
                                                              <td><?php echo $row['refNo'];?></td>
                                                              <td><?php echo $row['acctNo'];?></td>
                                                              <td><?php echo $row['acctName'];?></td>
                                                              <td><?php echo $row['amount'];?></td>
                                                              <td><?php echo $row['date'];?></td>
                                                              <td><?php echo $row['remarks'];?></td>
                                                              <td><?php echo $row['approved_by'];?></td>
                                                              <td><?php echo $row['approved_date'];?></td>
                                                           </tr>   
                                                         <?php endforeach ?>
                                                       <?php endif ?>

                                                  </tbody>  
                                            </table>
                                      </div>
                                </div>   
                              </div>
                          <?php endif ?>
                  

                    </div><!-- contentpanel -->
                    
                </div><!-- mainpanel -->            