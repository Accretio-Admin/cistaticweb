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
                                <h4>E-CASH PAYOUT REPORT</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    <div class="contentpanel">
                     <form method="post" method="<?php echo BASE_URL()?>Report/ecash" id="frmreport">
                          <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                     <select class="form-control" name="selEcashPayout">
                                            <option value="" disabled selected>SELECT E-CASH PAYOUT</option>
                                            <option value="1" <?php if($_POST['selEcashPayout'] == '1') { echo 'selected'; } ?>>TRANSFAST</option>
                                            <option value="2" <?php if($_POST['selEcashPayout'] == '2') { echo 'selected'; } ?>>ABS-CBN REMIT</option>
                                            <option value="3" <?php if($_POST['selEcashPayout'] == '3') { echo 'selected'; } ?>>NEW YORK BAY</option>
                                            <option value="4" <?php if($_POST['selEcashPayout'] == '4') { echo 'selected'; } ?>>MONEYGRAM</option>
                                            <option value="5" <?php if($_POST['selEcashPayout'] == '5') { echo 'selected'; } ?>>SMARTMONEY PAYOUT</option>
                                            <option value="6" <?php if($_POST['selEcashPayout'] == '6') { echo 'selected'; } ?>>IREMIT PAYOUT</option>
                                            <option value="0" <?php if($_POST['selEcashPayout'] == '0') { echo 'selected'; } ?>>ECASH PADALA</option>
                                            <option value="7" <?php if($_POST['selEcashPayout'] == '7') { echo 'selected'; } ?>>PLACID EXPRESS</option>
                                            <option value="8" <?php if($_POST['selEcashPayout'] == '8') { echo 'selected'; } ?>>E-CASH TO CEBUANA (PAYOUT)</option>
                                      </select>  
                                </div>
                                       
                                </div>

                         
                                <div class="col-xs-12 col-sm-12 col-md-4 text-right">
                                   <div class="form-group">
                                      <button type="submit" name="btnSearch" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>&nbsp;SEARCH</button>
                                       <a href="<?php echo BASE_URL(); ?>Report/export/<?php echo md5('payout') ?>" target="_blank">
                                       <button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i>&nbsp;&nbsp;GENERATE</button>
                                      </a>
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
                                        <span class="badge badge-danger"><?php echo $process['M']; ?></span>
                                    </div>
                                      <div  class="col-md-12 col-xs-12" style="overflow-y:scroll;height:350px;overflow-x:auto" >
                                           <table class="table table-bordered" style="width:auto;">
                                                  <thead align="center">
                                                      <tr>
                                                          <?php foreach ($field as $f ): ?>
                                                                 <th nowrap><?php echo $f;?></th>
                                                          <?php endforeach ?>
                                                         
                                                      </tr>
                                                  </thead> 
                                                  <tbody>
                                                       <?php if ($TBODY == 0): ?>
                                                        
                                                         <?php foreach ($API['TDATA'] as $r): ?>
                                                          <tr>
                                                              <td><?php echo $r['trackingno'];?></td>
                                                              <td><?php echo $r['regcode'];?></td>
                                                              <td><?php echo $r['payoutregcode'];?></td>
                                                              <td><?php echo $r['sender_name'];?></td>
                                                              <td><?php echo $r['sender_id'];?></td>
                                                              <td><?php echo $r['sender_address'];?></td>
                                                              <td><?php echo $r['sender_email'];?></td>
                                                              <td><?php echo $r['sender_mobile'];?></td>
                                                              <td><?php echo $r['bene_name'];?></td>
                                                              <td><?php echo $r['bene_id'];?></td>
                                                              <td><?php echo $r['bene_address'];?></td>
                                                              <td><?php echo $r['bene_email'];?></td>
                                                              <td><?php echo $r['bene_mobile'];?></td>
                                                              <td><?php echo $r['amount'];?></td>
                                                              <td><?php echo $r['datecreated'];?></td>
                                                         </tr>   
                                                         <?php endforeach ?>
                                                       <?php endif ?>

                                                    <?php if ($TBODY == 1): ?>
      
                                                      <?php foreach ($API['TDATA'] as $r): ?>
                                                         <tr>
                                                              <td><?php echo $r['refno'];?></td>
                                                              <td><?php echo $r['trackingno'];?></td>
                                                              <td><?php echo $r['receiptNo'];?></td>
                                                              <td><?php echo $r['currency'];?></td>
                                                              <td><?php echo $r['amount'];?></td>
                                                              <td><?php echo $r['charge'];?></td>
                                                              <td><?php echo $r['benefName'];?></td>
                                                              <td><?php echo $r['benefTelno'];?></td>
                                                              <td><?php echo $r['valid_id'];?></td>
                                                              <td><?php echo $r['id_no'];?></td>
                                                              <td><?php echo $r['payoutAmount'];?></td>
                                                              <td><?php echo $r['postingdate'];?></td>
                                                           
                                                         </tr>
                                                      <?php endforeach ?>
                                                       <?php endif ?>

                                                       <?php if ($TBODY == 2): ?>
                                                 
                                                         <?php foreach ($API['TDATA'] as $r): ?>
                                                          <tr>
                                                              <td><a href="<?php echo $r['URL']; ?>" target="_blank"><?php echo $r['trackingno'];?></td>
                                                              <td><?php echo $r['regcode'];?></td>
                                                              <td><?php echo $r['accountname'];?></td>
                                                              <td><?php echo $r['transtype'];?></td>
                                                              <td><?php echo $r['amount'];?></td>
                                                              <td><?php echo $r['charge'];?></td>
                                                              <td><?php echo $r['totalamount'];?></td>
                                                              <td><?php echo $r['postingdate'];?></td>
                                                         </tr>   
                                                         <?php endforeach ?>
                                                       <?php endif ?>
                                                       
                                                      <?php if ($TBODY == 3): ?>
                                                              <?php foreach ($API['TDATA'] as $r): ?>
                                                              <tr>
                                                                  <td><?php echo $r['trackingno'];?></td>
                                                                  <td><?php echo $r['regcode'];?></td>
                                                                  <td><?php echo $r['refno'];?></td>
                                                                  <td><?php echo $r['benefName'];?></td>
                                                                  <td><?php echo $r['benefTelno'];?></td>
                                                                  <td><?php echo $r['valid_id'];?></td>
                                                                  <td><?php echo $r['amount'];?></td>
                                                                  <td><?php echo $r['postingdate'];?></td>
                                                             </tr>   
                                                             <?php endforeach ?>
                                                       <?php endif ?>

                                                       <?php if ($TBODY == 7): ?>
                                                          <?php foreach ($API['TDATA'] as $r): ?>
                                                            <tr>
                                                              <td><a href="<?php echo $r['URL']; ?>" target="_blank"><?php echo $r['trackingno'];?></td>
                                                              <td><?php echo $r['regcode'];?></td>
                                                              <td><?php echo $r['senderName'];?></td>
                                                              <td><?php echo $r['senderMobile'];?></td>
                                                              <td><?php echo $r['receiverName'];?></td>
                                                              <td><?php echo $r['receiverMobile'];?></td>
                                                              <td><?php echo $r['amount'];?></td>
                                                              <td><?php echo $r['postingdate'];?></td>
                                                           </tr>   
                                                         <?php endforeach ?>
                                                       <?php endif ?>

                                                       <?php if ($TBODY == 8): ?>
                                                          <?php foreach ($API['TDATA'] as $r): ?>
                                                            <tr>
                                                              <td><a href="<?php echo $r['URL']?>" target="_blank"><?php echo $r['TN'];?></a></td>
                                                              <td><?php echo $r['R'];?></td>
                                                              <td><?php echo $r['RF'];?></td>
                                                              <td><?php echo $r['SN'];?></td>
                                                              <td><?php echo $r['BN'];?></td>
                                                              <td><?php echo $r['A'];?></td>
                                                              <td><?php echo $r['C'];?></td>
                                                              <td><?php echo $r['D'];?></td>
                                                           </tr>   
                                                         <?php endforeach ?>
                                                       <?php endif ?>
                                                  </tbody>  
                                            </table>
                                      </div>
                                </div>   
                              </div>
                          <?php endif ?>
                      </form>

                    </div><!-- contentpanel -->
                    
                </div><!-- mainpanel -->            