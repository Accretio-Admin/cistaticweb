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
                                <h4>Emergency Fund Report</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    <div class="contentpanel">
                     <form method="post">
                          <div class="row">
                            <div class="col-xs-12 col-md-12">

                                <div class="col-xs-12 col-md-4">
                                  <div class="col-xs-12 col-md-9">
                                        <select name="loanid" class="form-control" placeholder="Loan Sequence #">
                                            <option disabled <?php echo $_POST['loanid'] ? '':'selected'; ?>>Emergency Fund Sequence #</option>
                                            <?php
                                                $length = count($loanids['TDATA']);
                                                foreach($loanids['TDATA'] as $key => $loanid) {
                                                    ?>
                                                        <option value="<?php echo $loanid['loanID'];?>" <?php echo $_POST['loanid'] == $loanid['loanID'] ? 'selected':''; ?>><?php echo $length-$key .'-'.$loanid['loanID'];?></option>
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                  </div>
                                  <div class="col-xs-12 col-md-6">
                                  </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4 text-left">

                                      <button type="submit" name="btnSearch" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>&nbsp;SEARCH</button>
                                       <!-- <button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i>&nbsp;&nbsp;GENERATE</button> -->

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
                                        <?php 
                                            if(isset($API['LOANINFO'])) {
                                                $badge = 'danger';
                                                $message = $API['LOANINFO']['M'].' '.$API['LOANINFO']['BAL'];;
                                                if($API['LOANINFO']['S']) {
                                                    $badge = 'success';
                                                    $message = $API['LOANINFO']['M'];
                                                }
                                                ?>
                                                    <span class="badge badge-<?php echo $badge;?>" <?php echo ($badge=='danger')? 'style="background: #D9534F !important;"':''?>><?php echo $message;?></span>
                                                <?php
                                            }
                                        ?>
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
                                                              <td><?php echo $row['loanID'];?></td>
                                                              <td><a href="<?php echo $row['URL'];?>" target="_blank"><?php echo $row['trackno'];?></a></td>
                                                              <td><?php echo $row['trans_name'];?></td>
                                                              <td><?php echo $row['trans_desc'];?></td>
                                                              <td><?php echo $row['DrCr'];?></td>
                                                              <td><?php echo $row['amount'];?></td>
                                                              <td><?php echo $row['remaining_balance_after'];?></td>
                                                              <td><?php echo $row['date'];?></td>
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