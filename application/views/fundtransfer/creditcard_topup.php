  <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-mobile-phone"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                                   <li>FUND TRANSFER</li>
                                </ul>
                                <h4>CREDITCARD TOP-UP</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    

                    
                    <div class="contentpanel">
                          <div class="row">
                              <div class="col-xs-12  col-md-5">
                              <?php if ($result['S'] === 0): ?>
                                      <div class="alert alert-danger"><?php echo $result['M']; ?></div>
                              <?php endif ?>
                              <?php if ($result['S'] == 1): ?>
                                      <div class="alert alert-success"><?php echo $result['M']; ?><br />
                                      <?php if ($result['TI'] != ""): ?>
                                           <b>TRACKING NUMBER : <?php echo $result['TI']; ?></b>  
                                      <?php endif ?>
                                      </div>
                              <?php endif ?>
                                <div class="row">
                                    <div class='col-xs-12 col-md-12'>
                                             <form name="frmcreditcard_topup" action="<?php echo BASE_URL()?>fundtransfer/creditcard_topup" method="post" id="frmcreditcard_topup">
                                                  <div class="form-group">
                                                    <div class="alert alert-danger alert-creditcard-validation" style="display:none; word-wrap:break-word;"></div>
                                                     <input type="text" class="form-control inputAmount" name="inputCCTOAmount" id="inputCCTOAmount" value="<?php echo $amount; ?>" placeholder="Enter desired amount" required/>
                                                  </div>
                                                 <div class="form-group">
                                                   <select class="form-control" name="inputCTTOFundtype" id="inputCTTOFundtype" required>
                                                        <option value="" disabled selected>Select fund type</option>
                                                        <option value="ECASH">E-Cash Fund</option>
                                                    </select>
                                                    </div>
                                                  <div class="form-group">
                                                   <select class="form-control" name="inputCCTOpaymenttype" id="inputCCTOpaymenttype" required <?php if($amount == ""){ echo "disabled"; } ?>>
                                                        <option value="" disabled selected>Select payment type</option>
                                                        <option value="1">CREDITCARD</option>
                                                    </select>
                                                  </div>
                                                  
                                                  <div class="form-group">
                                                    <div class="alert alert-info alert-creditcard" style="display:none; word-wrap:break-word;"></div>
                                                  </div>
                                                  <div class="form-group pull-right">
                                                      <button type="button" class="btn btn-info" id="CCTOclear">Reset</button>
                                                      <button type="submit" class="btn btn-info" name="inputCCTOsubmit">Submit</button>
                                                </div>
                                          </form>   
                                    </div> <!-- col-xs-12 col-md-8-->
                                    <div class='col-xs-12 col-md-12'>
                                      <hr>
                                    </div>
                                    <div class='col-xs-12 col-md-12'>
                                        <table id="example" class="table table-bordered" cellspacing="0" width="100%">
                                          <thead>
                                              <tr>
                                                  <th>Tracking number</th>
                                                  <th>Reload Type</th>
                                                  <th>Amount</th>
                                                  <th>Status</th>
                                                  <th>Reference number</th>
                                                  <th>Card Number</th>
                                                  <th>Payment Date</th>
                                                  <th>Actions</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                             <?php
                                              if($cinfo_set){
                                                for($i=0;$i<count($transdata);$i++){
                                                  if($transdata[$i]['status'] == 'POSTED'):
                                                    echo "<tr style='background-color: #ffffe6';>";
                                                  else:
                                                    echo "<tr>";
                                                  endif;

                                                  echo "<td>";
                                                  echo $transdata[$i]['trackingno'];
                                                  echo "</td>";

                                                  echo "<td>";
                                                  echo $transdata[$i]['reload_type'];
                                                  echo "</td>";

                                                  echo "<td>";
                                                  echo $transdata[$i]['amount'];
                                                  echo "</td>";

                                                  echo "<td>";
                                                  echo $transdata[$i]['status'];
                                                  echo "</td>";

                                                  echo "<td>";
                                                  echo $transdata[$i]['referenceno'];
                                                  echo "</td>";

                                                  echo "<td>";
                                                  echo $transdata[$i]['cardno'];
                                                  echo "</td>";

                                                  echo "<td>";
                                                  echo $transdata[$i]['payment_date'];
                                                  echo "</td>";

                                                  echo "<td>";
                                                  if($transdata[$i]['status'] == 'POSTED'){
                                                    ?>
                                                      <p style="color:black;">Pending for Confirmation</p>
                                                    <?php
                                                  }else if($transdata[$i]['status'] == 'CANCELLED'){
                                                    ?>
                                                      <p style="font-weight:bold;color:red;">Cancelled</p>
                                                    <?php
                                                  }else{
                                                    ?>
                                                      <a class="btn btn-primary" target="_blank" href="<?php echo "https://mobilereports.globalpinoyremittance.com/portal/creditcard_reload_ecash_receipt/".$transdata[$i]['trackingno']; ?>">Get Receipt</a>
                                                    <?php
                                                  }
                                                  echo "</td>";

                                                  echo "</tr>";
                                                }
                                              }
                                             ?>
                                          </tbody>
                                      </table>
                                    </div>
                                </div> <!-- row -->

                              </div> <!--col-xs-6 col-md-6-->

                        </div><!-- row -->
                    </div><!-- contentpanel -->
    </div><!-- mainpanel -->  
                              
    <?php if($process == 1):?>
                      <div class="modal fade" tabindex="-1" role="dialog" id="modalBDOframe">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close closeCCTOmodal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                            <iframe width="100%" height="550px" src="" name="BDOiframe" id="BDOiframe"></iframe>
                            <input type="hidden" class="form-control" name="inputbdoURL" id="inputbdoURL" value="<?php echo $bdoURL; ?>"/>
                            </div>
<!--                        <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary">Save changes</button>
                            </div> -->
                          </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                      </div><!-- /.modal -->
                  <?php endif ?>

                  <?php if($process == 999):?>
                    <div class="modal fade" id="modalAgreementframe" data-backdrop="static" role="dialog" style="margin-top: 3%;">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <p><strong><h4 style="font-family: Times New Roman, times-roman, georgia, serif">TERMS AND CONDITION</h4></strong></p>
                          </div>
                          <div class="modal-body" style="font-family: Times  New Roman; overflow-y: scroll; width: 100%; height: 450px; padding: 0px 5px 5px 5px;">
                            <iframe width="100%" height="550px" src="" name="Agreementiframe" id="Agreementiframe"></iframe>
                            <input type="hidden" class="form-control" name="inputAgreeURL" id="inputAgreeURL" value="<?php echo urlencode($content); ?>"/>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endif ?>

                  <?php if($process == 998):?>
                    <div class="modal fade" id="modalAgreementframe" data-backdrop="static" role="dialog" style="margin-top: 3%;">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close closeAgreementmodal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>&nbsp;Back</span></button>
                          </br>
                          </div>
                          <div class="modal-body">
                            <div class="alert alert-info" id="receiptAlert" style="display: block;">
                              <p><strong><?php echo $message; ?></strong></p>
                            </div>
                            <?php if($reapply == 996){ ?>
                            <div class="form-group text-right">
                              <form action="/fundtransfer/creditcard_reapply" method="post" enctype="multipart/form-data">
                              <button type="submit" class="btn btn-primary" name="btnReapply"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;RE-APPLY</button>
                              </form>
                            </div>
                            <?php } ?>
                            </hr>
                            <?php if($show_upload == 997){ ?>
                            <form action="/fundtransfer/creditcard_upload" method="post" enctype="multipart/form-data">
                                <p><b>Upload Requirements</b></p>
                                <ul id="filelist">
                                  <li>
                                    <input type="file" name="file_1" id="file_1" accept="image/*" required>
                                  </li>
                                </ul>
                                <div style="margin-left:40px;">
                                  <span class="glyphicon glyphicon-plus-sign" aria-hidden="true" style="color:black;"></span>&nbsp;<a href="#" onclick="add_image_item();">Add file</a>
                                </div>
                                <div class="form-group pull-right">
                                  <input type="hidden" name="authorization" value="unifiedproductsandservices">
                                  <button type="submit" class="btn btn-primary" name="sbmccvalue"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;Submit file(s)</button>
                                </div>
                                <br>
                                <br>
                            </form>  
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <script type="text/javascript">
                      function add_image_item(){
                        var count = $('ul#filelist li').length
                        count++;

                        if(count > 3){
                          alert('You have exceeded the maximum number of file uploads.');
                        }else{
                          var list = document.getElementById('filelist');
                          var entry = document.createElement('li');
                          var input = document.createElement('input');

                          input.setAttribute("type","file");
                          input.setAttribute("name","file_"+count);
                          input.setAttribute("id","file_"+count);
                          input.setAttribute("accept","image/*");
                          input.required = true;

                          entry.appendChild(input);
                          list.appendChild(entry);
                        }
                      }
                    </script>
                  <?php endif ?>
