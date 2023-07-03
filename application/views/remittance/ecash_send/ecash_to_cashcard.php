<div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-money"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>ECASH</li>
                                </ul>
                                <h4>E-Cash To Cashcard</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    <div class="contentpanel" style="padding-bottom: 0px;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-xs-12 col-md-5">     
                                <?php if ($result['S'] === 0): ?>
                                    <div class="alert alert-danger"><?php echo $result['M']; ?></div>
                                <?php endif ?>
                                <?php if ($result['S'] == 1): ?>
                                 <div class="alert alert-success">&nbsp;&nbsp;<b><?php echo $result['M'] ?> </b><br /><a href="<?php echo $result['URL']; ?>" target="_blank"><?php echo $result['TN'];  ?></a>
                                 &nbsp;&nbsp;<small>Click transaction number to download reciept.</small>
                                 </div>
                                <?php endif ?>                            
                                        <h5 style="font-weight: bold; color: #4169E1;">SENDER</h5> 
                                        <div class="form-group">
                                           <input type="text" class="form-control" name="inputFullname" placeholder="FULLNAME" value="<?php echo $user['U']?>" readonly/>
                                        </div>
                                        <div class="form-group">
                                           <input type="text" class="form-control" name="inputAddressLine1" placeholder="ADDRESS LINE 1"  value="<?php echo $user['AD']?>" readonly/>
                                        </div>
                                        <div class="form-group">
                                           <input type="text" class="form-control" name="inputAddressLine2" placeholder="ADDRESS LINE 2" readonly/>
                                        </div>
                                        <h5 style="font-weight: bold; color: #4169E1;">BENEFICARY</h5> 
                                        <div class="form-group">
                                           <form name="frmecashtocashcard" action="<?php echo BASE_URL() ?>ecash_send/ecashtocashcard" method="post" id="frmecashtocashcard"  >
                                              <div class="row">
                                                  <div class='col-xs-12 col-md-12'>
                                                  <div id="cashcardBeneName" style="padding: 2px 2px 6px 0px; display:none;">
                                                     <input type="text" class="form-control" id="inputBeneFullname" name="inputBeneFullname" placeholder="FULLNAME" value="<?php echo $receipientName; ?>" readonly/>
                                                  </div>
                                                      <div class="row">
                                                         <div class="col-md-10">
                                                              <input type="text" class="form-control inputAmount" id="inputBenificiary" name="inputSearch" value="<?php echo $receipientAccno; ?>" maxlength="13" placeholder="SEARCH BENEFICIARY ACCOUNT NO." required />
                                                              <p style="color: #FF0000; font-size: 12px;"><i>(Required exact 13-digit account no.)</i></p>
                                                         </div>
                                                         <div class="col-md-2">
                                                               <button type="submit" name= "btnBsearch" id="btnBsearch" class="btn btn-primary">
                                                               <span id="spanBIcon" class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                                              </button>
                                                         </div> 
                                                      </div> 
                                                  </div>
                                               </div> 
                                         </form>  
                                        </div> 
                                        
                                        <h5 style="font-weight: bold;">TRANSACTION DETAILS</h5>
                                            <form name="frmecashtocashcard" action="<?php echo BASE_URL() ?>ecash_send/ecashtocashcard" method="post" id="frmecashtocashcardconfirm"  >
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" id="inputData" name="inputData" readonly/>
                                            <textarea id="inputRData" name="inputRData" hidden><?php echo json_encode($row); ?></textarea>
                                           <input type="text" class="form-control" name="inputAmount" id="inputAmount" value="<?php echo $topupAmount; ?>" placeholder="AMOUNT" readonly required />
                                        </div>
                                        <div class="form-group">
                                              <input type="password" class="form-control" id="inputTpass" name="inputTpass" value="<?php echo $receipientName; ?>" placeholder="TRANSACTION PASSWORD" readonly required />
                                        </div>
                                        <div class="form-group text-right">
                                          <button type="submit" class="btn btn-primary" id="btnSubmitCashcard" name="btnSubmit">Submit</button>
                                        </div>
                                        </form>
                                   

                                </div>
                            </div>
                            <div class="row">
                              <?php if ($row['S']===0): ?>
                                <div class="col-xs-12 col-md-5">
                                  <div class="alert alert-danger"><b><?php echo $row['M']; ?>!!</b></div>
                                </div>
                              <?php endif ?>
                            <div class="col-md-12">
                              <?php if ($row['S']==1): ?>
                        
                              <hr />
                              <h4>Result(s) :</h4>
                              <table id="example"  class="table table-bordered" cellspacing="0" style="width:100%;">
                                        <thead>
                                          <tr>
                                            <th>Fullname</th>
                                            <th>Account No</th>
                                            <th>Action</th>
                                            <th style="display:none"></th>
                                            <th style="display:none"></th>
                                            <th style="display:none"></th>
                                          </tr>
                                        </thead>

                                        <tbody>
                                          <?php  foreach ($row['R_DATA'] as $i): ?>
                                          <tr class="tr">
                                              <td class="td"><?php echo $i['DN']; ?></td>
                                              <td class="td"><?php echo $i['AN']; ?></td>
                                              <td class="td" style="display:none"><?php echo $i['FN']; ?></td>
                                              <td class="td" style="display:none"><?php echo $i['MN']; ?></td>
                                              <td class="td" style="display:none"><?php echo $i['LN']; ?></td>
                                              <td><a id="cashcard" class="btn btn-danger" href="#">Select</a></td>
                                          </tr>
                                          <?php endforeach ?>
                                      
                                        </tbody>
                                    </table>
                                     
                                <?php endif ?>
                            </div>
                          </div>
                        </div>  
                    </div>  
           </div>          
  </div>

  <?php if ($process_otp == 1): ?>
  <div class="modal fade" tabindex="-1" data-backdrop="static" role="dialog" id="modalOTP">
    <div class="modal-dialog" style="padding-top: 4%;">
      <div class="modal-content" style="width: 500px; margin: auto;">
        <div class="modal-header" id="modalhead">
          <button type="button" id="otpVerifymodal" class="close closeOTPverifymodal">&times;</button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-info-sign" aria-hidden="true" style="font-size: large;"></span> Transaction Validation</h4>
        </div>
        <form id="frmOTPverification" method="post">
        <div class="modal-body" id="modalbody">
          <p id="otpMessage" style="color: #a94442; background-color: #f2dede; border-color: #ebccd1; padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px;"><?php echo $OTPdata['M']; ?></p>
          <div class="row">
              <div class="col-md-12">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1" style="padding-right: 39px;">Tracking No.:</span>
                  <input type="text" class="form-control" name="otptrackno" id="otptrackno" placeholder="Transaction No." aria-describedby="basic-addon1" value="<?php echo $OTPdata['TN']; ?>" readonly>
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Verification Code:</span>
                  <input type="text" class="form-control" name="vcode" id="vcode" placeholder="Verification Code" aria-describedby="basic-addon1" required>
                  <span class="input-group-btn">
                  <button id="btnOTPResend" name="btnOTPResend" class="btn btn-danger" type="button" tabindex="-1" style="height:34px;!important;">Resend</button>
                  </span>
                </div>
            </div>
            <small class="resendingOTPcode" style="float:right;display:none;">Verification code sending..</small>
          </div>
          <div class="form-group text-center">
            <button type="submit" class="btn btn-primary"  name="btnOTPSubmit">Verify</button>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
<?php endif ?>

<script type="text/javascript">
       $(document).ready(function(){
        var receipientName = $("#inputBeneFullname").val();
          if(receipientName != ''){ 
            $("#cashcardBeneName").css('display','block'); 
          } else{ 
            $("#cashcardBeneName").css('display','none');
          }
       });
</script>
