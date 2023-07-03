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
                                <h4>FEDERAL INSURANCE REPORT</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    <div class="contentpanel">
                      <?php if ($API['S'] === 0): ?>
                        <div class="alert alert-danger"><?php echo $API['M']; ?></div> 
                      <?php endif ?>
                     <form method="post" method="<?php echo BASE_URL()?>Report/einsurance_report" id="frmreport">
                          <div class="row">
                            <div class="col-xs-12 col-md-12">

                              


                                <div class="col-xs-12 col-md-4">
                                   <div class="form-group">
                                      <a href="<?php echo BASE_URL(); ?>Report/export/<?php echo md5('einsurance_report') ?>" target="_blank">
                                      <button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i>&nbsp;&nbsp;GENERATE</button>
                                      </a>

                                    </div>
                                </div>
                            </div>    
                          </div>
                       

                           <?php if ($process['P'] == 1 && $process['S'] ==1): ?>
                              <div class="row">
                                <div class="col-xs-12 col-md-12">
                                    <div class="text-right" style="margin-bottom:5px">
                                        <span class="badge badge-primary"><?php echo $API['M']; ?></span>
                                    </div>
                                        <div  class="col-md-12 col-xs-12" style="overflow-y:scroll;height:350px" >
                                             <table  class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th  nowrap>Transaction #</th>
                                                            <th  nowrap>Policy</th>
                                                            <th  nowrap>Insured</th>
                                                            <th  nowrap>Beneficiary</th>
                                                            <th  nowrap>Occupation</th>
                                                            <th  nowrap>Birthday</th>
                                                            <th  nowrap>COC No.</th> 
                                                            <th  nowrap>Amount</th>
                                                            <th  nowrap>Charge</th> 
                                                            <th  nowrap>Date/Time</th> 
                                                           
                                                        </tr>
                                                    </thead>
                                                        <tbody>
                                                   
                                                               <?php foreach ($API['TDATA'] as $A ): ?>
                                                                    <tr>
                                                                        <td nowrap=""><a href="<?php echo $API['URL'].$A['trackingNo'];?>" target="_blank"><?php echo $A['trackingNo'];?></a></td>
                                                                        <td nowrap=""><?php echo $A['optionId'];?></td>
                                                                        <td><?php echo $A['assured'];?></td>
                                                                        <td><?php echo $A['Beneficiary'];?></td>
                                                                        <td><?php echo $A['customerOccupation'];?></td>
                                                                        <td><?php echo $A['customerDOB'];?></td>
                                                                        <td nowrap=""><?php echo $A['COCNumber'];?></td>
                                                                        <td nowrap=""><?php echo $A['amount'];?></td>
                                                                        <td nowrap=""><?php echo $A['markup'];?></td>
                                                                        <td nowrap=""><?php echo $A['RecDate'];?></td>                                                                      
                                                                      </tr>
                                                                <?php endforeach ?>
                                                            </tbody>
                                                            </table>
                                                        </div>
                                                
                                            
                                     
                                 
                              </div>


                            </div>
                          <?php endif ?>
                      </form>

                    </div><!-- contentpanel -->
                    
                </div><!-- mainpanel -->            