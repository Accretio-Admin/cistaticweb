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
                                <h4>DRAGONPAY TOP-UP</h4>
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
                                           <b>REFERENCE NUMBER : <?php echo $result['RN']; ?></b>  
                                      <?php endif ?>
                                      </div>
                              <?php endif ?>

                                <div class="row">
                                    <div class='col-xs-12 col-md-12'>
                                             <!-- <form name="frmcreditcard_topup" action="<?php echo BASE_URL()?>fundtransfer/dragonpay_topup" method="post" id="frmcreditcard_topup"> -->
                                                                    <div class="row1">
                        <div class="col-md-12 alert alert-info" >
                         
                          <p><b>Note :</b></p>
                         <p style="color:red;"><i>Service fee (<small>min.P60.00 - max.P70.00 based on transactions</small>) will be added automatically upon successful processing</i></p>
                     
                       </div>
                      </div>

                                             <form name="frmdragonpay_topup" action="<?php echo BASE_URL()?>fundtransfer/dragonpay_topup" method="post" id="frmdragonpay_topup">
                                                  <div class="form-group">
                                                    <div class="alert alert-danger alert-creditcard-validation" style="display:none; word-wrap:break-word;"></div>
                                                     <input type="text" class="form-control DPinputAmount" name="inputAmount" id="inputAmount" value="<?php echo $amount; ?>" placeholder="Enter desired amount" required/>
                                                  </div>
                                                 <div class="form-group">
                                                   <select class="form-control" name="inputdragonpayFundtype" id="inputdragonpayFundtype" required>
                                                        <option value="" disabled selected>Select fund type</option>
                                                        <option value="ECASH">E-Cash Fund</option>
                                                    </select>
                                                    </div>
                                                  <div class="form-group">
                                                    <div class="alert alert-danger alert-creditcard-validation" style="display:none; word-wrap:break-word;"></div>
                                                     <input type="password" class="form-control inputTranspass" name="inputTranspass" id="inputTranspass" value="" placeholder="TRANSACTION PASSWORD" required/>
                                                  </div>

                                                  <input type="hidden" name="txnid" value='<?php echo $txnid; ?>'/>
                                                  <input type="hidden" name="email" value='<?php echo $email; ?>' />
                                                  

                                                  <div class="form-group">
                                                    <div class="alert alert-info alert-creditcard" style="display:none; word-wrap:break-word;"></div>
                                                  </div>
                                                  <div class="form-group pull-right">
                                                      <button type="reset" class="btn btn-info">Reset</button>
                                                      <button type="submit" class="btn btn-info" id='inputdragonpaysubmit' name="inputdragonpaysubmit">Submit</button>

                                                </div>
                                          </form> 
                                    </div> <!-- col-xs-12 col-md-8-->
                                    <div class='col-xs-12 col-md-12'>
                                      <hr>
                                    </div>
                              
                                </div> <!-- row -->

                              </div> <!--col-xs-6 col-md-6-->

                        </div><!-- row -->
                    </div><!-- contentpanel -->
    </div><!-- mainpanel -->  
                              
                <?php if($process == 1):?>
                  <center>
                      <!-- <div class="modal fade" tabindex="-1" role="dialog" id="modalBDOframe"> -->
                      <div class="modal fade" tabindex="-1" role="dialog" id="modalDragonpayframe">
                        <div class="modal-dialog" style="width:45%;">
                          <div class="modal-content" >
                            <div class="modal-header">
                              <button type="button" class="close closeDragonPaymodal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                            <!-- <iframe width="100%" height="550px" src="" name="BDOiframe" id="BDOiframe"></iframe> -->
                            <iframe width="100%" height="550px" src="" name="Dragonpayiframe" id="Dragonpayiframe"></iframe>
                            <!-- <input type="hidden" class="form-control" name="inputbdoURL" id="inputbdoURL" value="<?php echo $bdoURL; ?>"/> -->
                            <input type="hidden" class="form-control" name="inputdragonpayURL" id="inputdragonpayURL" value="<?php echo $inputdragonpayURL; ?>"/>
                            
                            </div>
<!--                        <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary">Save changes</button>
                            </div> -->
                          </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                      </div><!-- /.modal -->
                    </center>
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

                  <!-- <?php if($process == 998):?>
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
                  <?php endif ?> -->
