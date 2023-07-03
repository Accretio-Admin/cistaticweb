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
                                <h4>E-CASH REPORT</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    <div class="contentpanel">
                     <form method="post" method="<?php echo BASE_URL()?>Report/ecash" id="frmreport">
                          <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                     <select class="form-control" name="selEcash">
                                            <option value="" disabled selected>SELECT E-CASH</option>
                                            <option value="1" <?php echo $_POST["selEcash"] == '1' ? 'selected':''?> >E-CASH TO E-CASH</option>
                                            <option value="2" <?php echo $_POST["selEcash"] == '2' ? 'selected':''?> >SMARTMONEY (SEND)</option>
                                            <option value="0" <?php echo $_POST["selEcash"] == '0' ? 'selected':''?> >E-CASH TO GPRS OUTLET</option>
                                            <option value="3" <?php echo $_POST["selEcash"] == '3' ? 'selected':''?> >E-CASH CREDIT TO BANK</option>
                                            <option value="4" <?php echo $_POST["selEcash"] == '4' ? 'selected':''?> >E-CASH TO CASHCARD</option>
                                            <option value="5" <?php echo $_POST["selEcash"] == '5' ? 'selected':''?> >E-CASH TO CEBUANA (SEND)</option>
                                            <option value="6" <?php echo $_POST["selEcash"] == '6' ? 'selected':''?> >E-CASH TO PAYMAYA</option>
                                            <!-- <option value="7" <?php echo $_POST["selEcash"] == '7' ? 'selected':''?> >E-CASH CARDLESS PADALA</option> -->
                                      </select>  
                                </div>
                                       
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-4 text-right">
                                   <div class="form-group">
                                      <button type="submit" name="btnSearch" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>&nbsp;SEARCH</button>


                                      <a href="<?php echo BASE_URL(); ?>Report/export/<?php echo md5('ecash') ?>" target="_blank">
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
                                                  <thead>
                                                      <tr>
                                                          <?php foreach ($field as $f ): ?>
                                                                 <th width="150"><?php echo $f;?></th>
                                                          <?php endforeach ?>
                                                         
                                                      </tr>
                                                  </thead> 
                                                  <tbody>
                                                    <?php if ($TBODY == 2): ?>
                                                      
                                                   
                                                      <?php foreach ($API['TDATA'] as $r): ?>
                                                         <tr>
                                                              <td><a href="<?php echo $r['URL']?>" target="_blank"><?php echo $r['trackingno'];?></a></td>
                                                              <td><?php echo $r['accountname'];?></td>
                                                              <td><?php echo $r['transtype'];?></td>
                                                              <td><?php echo $r['amount'];?></td>
                                                              <td><?php echo $r['charge'];?></td>
                                                              <td><?php echo $r['totalamount'];?></td>
                                                              <td><?php echo $r['postingdate'];?></td>
                                                           
                                                         </tr>
                                                      <?php endforeach ?>
                                                       <?php endif ?>
                                                       <?php if ($TBODY == 1): ?>
                                                        
                                                         <?php foreach ($API['TDATA'] as $r): ?>
                                                          <tr>
                                                              <td><a href="<?php echo $r['URL']?>" target="_blank"><?php echo $r['trackingno'];?></a></td>
                                                              <td><?php echo $r['regcode'];?></td>
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
                                                              <td><?php echo $r['total'];?></td>
                                                              <td><?php echo $r['datecreated'];?></td>
                                                         </tr>   
                                                         <?php endforeach ?>
                                                       <?php endif ?>

                                                       <?php if ($TBODY == 3): ?>
                                                        
                                                         <?php foreach ($API['TDATA'] as $r): ?>
                                                          <tr>
                                                              <?php if($r['referenceno'] != "") : ?> <td><a href="<?php echo $r['URL']?>" target="_blank"><?php echo $r['trackno'];?></a></td><?php endif ?>
                                                              <?php if($r['referenceno'] == "") : ?> <td><?php echo $r['trackno'];?></td><?php endif ?>
                                                              <td><?php echo $r['regcode'];?></td>
                                                              <td><?php echo $r['referenceno'];?></td>
                                                              <td><?php echo $r['sender'];?></td>
                                                              <td><?php echo $r['receipient'];?></td>
                                                              <td><?php echo $r['amount'];?></td>
                                                              <td><?php echo $r['charge'];?></td>
                                                              <td><?php echo $r['date'];?></td>
                                                         </tr>   
                                                         <?php endforeach ?>
                                                       <?php endif ?>

                                                        <?php if ($TBODY == 5): ?>
                                                         <?php foreach ($API['TDATA'] as $r): ?>
                                                          <tr>
                                                             <?php if($r['ST'] == "REMIT") : ?> <td><a href="<?php echo $r['URL']?>" target="_blank"><?php echo $r['TN'];?></a></td><?php endif ?>
                                                              <?php if($r['ST'] != "REMIT") : ?> <td><?php echo $r['TN'];?></td><?php endif ?>
                                                              <td><?php echo $r['R'];?></td>
                                                              <td><?php echo $r['RF'];?></td>
                                                              <td><?php echo $r['SN'];?></td>
                                                              <td><?php echo $r['BN'];?></td>
                                                              <td><?php echo $r['A'];?></td>
                                                              <td><?php echo $r['C'];?></td>
                                                              <td><?php echo $r['D'];?></td>
                                                              <td><?php echo $r['ST'];?></td>
                                                         </tr>   
                                                         <?php endforeach ?>
                                                       <?php endif ?>

                                                       <?php if ($TBODY == 6): ?>
                                                         <?php foreach ($API['T_DATA'] as $r): ?>
                                                          <tr>
                                                              <td><a href="<?php echo $r['URL']?>" target="_blank"><?php echo $r['trackno'];?></a></td>
                                                              <td><?php echo $r['regcode'];?></td>
                                                              <td><?php echo $r['refno'];?></td>
                                                              <td><?php echo $r['senderDetails']['firstName']." ".$r['senderDetails']['middleName']." ".$r['senderDetails']['lastName'];?></td>
                                                              <td><?php echo $r['beneficiaryDetails']['firstName']." ".$r['beneficiaryDetails']['middleName']." ".$r['beneficiaryDetails']['lastName'];?></td>
                                                              <td><?php echo $r['amount'];?></td>
                                                              <td><?php echo $r['charge'];?></td>
                                                              <td><?php echo $r['datetime'];?></td>
                                                         </tr>   
                                                         <?php endforeach ?>
                                                       <?php endif ?>

                                                       <?php if ($TBODY == 7): ?>
                                                      
                                                   <!-- Cardless Padala - Harry -->
                                                      <?php foreach ($API['TDATA'] as $r): ?>
                                                         <tr>
                                                          <td><a <?php echo $r['remarks'] == "SUCCESSFUL" ? "" : "disabled" ?> href="<?php echo $r['url']?>" target="_blank"><?php echo $r['trackno'];?></a></td>
                                                          <td><?php echo $r['regcode'];?></td>
                                                          <td><?php echo "{$r['details_sender']['purchaserFirstName']} {$r['details_sender']['purchaserMiddleName']} {$r['details_sender']['purchaserLastName']}";?></td>
                                                          <td><?php echo "{$r['details_bene']['recipientFirstName']} {$r['details_bene']['recipientMiddleName']} {$r['details_bene']['recipientLastName']}";?></td>
                                                          <td><?php echo $r['amount'];?></td>
                                                          <td><?php echo $r['charge'];?></td>
                                                          <td><?php echo $r['total'];?></td>
                                                          <td><?php echo $r['refno'];?></td>
                                                          <td><?php echo $r['balance_before'];?></td>
                                                          <td><?php echo $r['balance_after'];?></td>
                                                          <td><?php echo $r['date'];?></td>
                                                         </tr>
                                                      <?php endforeach ?>
                                                       <?php endif ?>
                                                       
                                                      <!-- end Cardless Padala - Harry -->

                                                        <?php if ($TBODY == 33): ?>
                                                          <?php foreach ($API['TDATA'] as $r): ?>
                                                            <tr>
                                                             <?php if($r['status'] == "1") : ?> <td><a href="<?php echo $r['URL']?>" target="_blank"><?php echo $r['trackingno'];?></a></td><?php endif ?>
                                                              <?php if($r['status'] != "1") : ?> <td><?php echo $r['trackingno'];?></td><?php endif ?>
                                                              <!-- <td><?php echo $r['status'];?></td> -->
                                                              <td><?php echo $r['accountname'];?></td>
                                                              <td><?php echo $r['transtype'];?></td>
                                                              <td><?php echo $r['amount'];?></td>
                                                              <td><?php echo $r['charge'];?></td>
                                                              <td><?php echo $r['totalamount'];?></td>
                                                              <td><?php echo $r['postingdate'];?></td>
                                                              <?php if($r['status'] == "1") : ?> <td>SUCCESSFUL</td><?php endif ?>
                                                              <?php if($r['status'] == "3") : ?> <td>PENDING</td><?php endif ?>
                                                              <?php if($r['status'] == "9") : ?> <td>CANCELLED</td><?php endif ?>
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