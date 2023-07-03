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
                                <h4>COMPULSORY THIRD PARTY LIABILITY INSURANCE REPORT</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    <div class="contentpanel">
                      <?php if ($API['S'] === 0): ?>
                        <div class="alert alert-danger"><?php echo $API['M']; ?></div> 
                      <?php endif ?>
                     <form method="post" method="<?php echo BASE_URL()?>Report/ctpl_report" id="frmreport">
                          <div class="row">
                            <div class="col-xs-12 col-md-12">

                                <div class="col-xs-12 col-md-4">
                                  <div class="form-group">
                                       <select class="form-control" if="selInsurance" onchange="getVal();" name="selEinsurance">
                                              <option value="0" disabled selected>SELECT EINSURANCE</option>
                                              <option value="1" <?php if($selected==1){ echo "selected"; } ?> >FPG</option>
                                        </select>  
                                  </div>
                                       
                                </div>

                                <div class="col-xs-12 col-md-4">
                                   <div class="form-group">
                                      <button type="submit" name="btnSearch" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>&nbsp;SEARCH</button>
                                      <a href="<?php echo BASE_URL(); ?>Report/export/<?php echo md5('ctpl_report') ?>" target="_blank">
                                      <button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i>&nbsp;&nbsp;GENERATE</button>
                                      </a>

                                    </div>
                                </div>
                            </div>    
                          </div>
                       

                           <?php if ($process['P'] == 1 && $process['S'] ==1 && $selected!=""){ ?>
                              <div class="row">
                                <div class="col-xs-12 col-md-12">
                                    <div class="text-right" style="margin-bottom:5px">
                                        <span class="badge badge-primary"><?php echo $API['M']; ?></span>
                                    </div>
                                        <div  class="col-md-12 col-xs-12" style="overflow-y:scroll;height:350px" >
                                             <table  class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th  colspan="2" nowrap>Option/s</th>
                                                            <th  nowrap>Transaction #</th>
                                                            <th  nowrap>COC Number</th>
                                                            <th  nowrap>Authno</th>
                                                            <th  nowrap>Status</th>
                                                            <th  nowrap>Amount</th>
                                                            <th  nowrap>Charge</th> 
                                                            <th  nowrap>Date/Time</th> 
                                                        </tr>
                                                    </thead>

                                                    <?php if($selected==1){ ?>
                                                        <tbody>
                                                   
                                                               <?php foreach ($API['TDATA'] as $A ): ?>
                                                                    <tr>
                                                                        <?php if($A['status'] == 'SUCCESSFUL'): ?>
                                                                        <td nowrap=""><a class="btn btn-primary" href="<?php echo $A['AR_URL']?>" target="_blank">GET RECEIPT</a></td>
                                                                        <td nowrap=""><a class="btn btn-success" href="<?php echo $A['COC_URL']?>" target="_blank">GET COC</a></td>
                                                                        <?php else: ?>
                                                                        <td nowrap=""><a class="btn btn-primary" href="<?php echo $A['AR_URL']?>" target="_blank" disabled >GET RECEIPT</a></td>
                                                                        <td nowrap=""><a class="btn btn-success" href="<?php echo $A['COC_URL']?>" target="_blank" disabled>GET COC</a></td>
                                                                        <?php endif ?>
                                                                        <td nowrap=""><?php echo $A['trackno'];?></td>
                                                                        <td nowrap=""><?php echo $A['coc_number'];?></td>
                                                                        <td nowrap=""><?php echo $A['authno'];?></td>
                                                                        <td nowrap=""><?php echo $A['status'];?></td>
                                                                        <td nowrap=""><?php echo number_format($A['amount'],2);?></td>
                                                                        <td nowrap=""><?php echo $A['charge'];?></td>
                                                                        <td><?php echo date('m-d-Y',strtotime($A['transdate'])).' '.date('g:i A',strtotime($A['transdate']));?></td>                                                                   
                                                                      </tr>
                                                                <?php endforeach ?>
                                                            </tbody>

                                                     <?php } ?>     
                                                            </table>
                                                        </div>
                                                
                                            
                                     
                                 
                              </div>


                            </div>
                          





                          <?php } ?>


                      </form>

                    </div><!-- contentpanel -->
                    
                </div><!-- mainpanel --> 

                <script>
                  function getVal(){
                    var element = document.getElementById("selInsurance");

                    alert(element.options[element.selectedIndex].value);
                  }
                </script>           