<?php if ($user['R'] == "FAC0026"): ?>
  <div id="fac" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Message</h4>
        </div>

        <div class="modal-body">
          <p>This service is temporarily unavailable in your account.</p>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" id="buttonfac" data-dismiss="modal">Close</button>
        </div>
     </div>
    </div>
  </div>
<?php endif ?>

<div class="mainpanel">
  <div class="pageheader">
    <div class="media">
      <div class="pageicon pull-left">
        <i class="fa fa-money"></i>
      </div>

      <div class="media-body">
        <ul class="breadcrumb">
          <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
          <li>REMITTANCE</li>
        </ul>

        <h4>E-CASH SEND</h4>
      </div>

      <div class="contentpanel" id="send">
        <div class="row row-stat">
          <div class="col-sm-9 col-md-9">
            <div class="tab-content nopadding noborder">
              <div class="tab-pane active" id="activities">
                <div class="follower-list">  
                  <div class="col-sm-12">
                    <div class="row media-manager">
                      <?php if ($user['A_CTRL']['remittance_eclf_send'] == 1): ?>
                        <div class="col-xs-6 col-sm-6 col-md-3 document">
                          <div class="thmb" >
                            <div class="thmb-prev  text-center">
                              <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_send/loadfund" class="" id="aloading">
                                <img  src="<?php echo BASE_URL() ?>assets/images/ecash_send/ecash_to_load_fund_new.png" class="img-responsive" alt="">
                              </a>
                            </div>

                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>ecash_send/loadfund">Convert to Load Fund</a></h5>
                          </div>
                        </div> 
                      <?php endif ?>

                      <?php if ($user['A_CTRL']['remittance_ecsg_send'] == 1 && $user['L']!=5): ?>
                        <div class="col-xs-6 col-sm-6 col-md-3 document">
                          <div class="thmb">
                            <div class="thmb-prev">
                              <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_send/sgdfund" id="aloading">
                                <img src="<?php echo BASE_URL() ?>assets/images/ecash_send/ecash_to_sgd_load_fund_new.png" class="img-responsive" alt="">
                              </a>
                            </div>

                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>ecash_send/sgdfund">SGD Load Fund</a></h5>
                          </div>
                        </div> 
                      <?php endif ?>

                      <?php if ($user['R'] != 'FAC0070' || $user['R'] != 'FAC0073' || $user['R'] != 'FAC0075' ||  $user['R'] != 'FAC0074'): ?>
                        <div class="col-xs-6 col-sm-6 col-md-3 document">
                          <div class="thmb">
                            <div class="thmb-prev">
                              <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_send/forexrate" id="aloading">
                                <img src="<?php echo BASE_URL() ?>assets/images/ecash_send/ecash_to_sgd_load_fund_new.png" class="img-responsive" alt="">
                              </a>
                            </div>

                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>ecash_send/forexrate">Forex Rate</a></h5>
                          </div>
                        </div> 
                      <?php endif ?>
                                                     
                      <?php if ($user['A_CTRL']['remittance_ecash_forexconversion'] == 1 && $user['L'] != 5): ?>
                        <div class="col-xs-6 col-sm-6 col-md-3 document">
                          <div class="thmb">
                            <div class="thmb-prev">
                              <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_send/ecashtoforex" id="aloading">
                                <img src="<?php echo BASE_URL() ?>assets/images/ecash_send/ecash_to_sgd_load_fund_new.png" class="img-responsive" alt="">
                              </a>
                            </div>

                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>ecash_send/ecashtoforex">Ecash Conversion</a></h5>
                          </div>
                        </div> 
                      <?php endif ?>

                      <?php if ($user['A_CTRL']['remittance_ecash_send'] == 1): ?>
                        <div class="col-xs-6 col-sm-6 col-md-3 document">
                          <div class="thmb">
                            <?php if ($exceed_ec_to_ec == 1): ?>
                              <div class="thmb-prev">
                                <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_send/ecashtoecash" id="aloading">
                                  <img src="<?php echo BASE_URL() ?>assets/images/ecash_send/ecash_to_ecash_new.png" class="img-responsive" alt="">
                                </a>
                              </div>
                              
                              <h5 class="fm-title text-center" nowrap><a href="<?php echo BASE_URL() ?>ecash_send/ecashtoecash">E-Cash to E-Cash</a></h5>
                            <?php else: ?>
                              <div class="thmb-prev">
                                <a style="background-color: #fff;" onclick="alert('You have exceeded the transaction limit for this day.')">
                                  <img src="<?php echo BASE_URL() ?>assets/images/ecash_send/ecash_to_ecash_new.png" class="img-responsive" alt="">
                                </a>
                              </div>
                              
                              <h5 class="fm-title text-center" nowrap><a onclick="alert('You have exceeded the transaction limit for this day.')">E-Cash to E-Cash</a></h5>
                            <?php endif ?>
                          </div>
                        </div>
                      <?php endif ?>

                      <?php if ($user['A_CTRL']['remittance_smartmoney_send'] == '1xx' && $user['L'] != 5): ?>
                        <div class="col-xs-6 col-sm-6 col-md-3 document">
                          <div class="thmb">
                            <div class="thmb-prev">
                              <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_send/ecashtosmartmoney" id="aloading">
                                <img src="<?php echo BASE_URL() ?>assets/images/ecash_send/ecash_to_smartmoney_new.png" class="img-responsive" alt="" style= "margin:0 auto;">
                              </a>
                            </div>
                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>ecash_send/ecashtosmartmoney">Smartmoney</a></h5>
                          </div>
                        </div> 
                      <?php endif ?>
                                                  
                      <?php if ($user['A_CTRL']['remittance_gprs_send'] == 1 && $user['L'] != 5): ?>
                        <div class="col-xs-6 col-sm-6 col-md-3 document">
                          <div class="thmb">
                            <?php if ($exceed_ec_padala == 1): ?>
                              <div class="thmb-prev">
                                <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_send/ecashpadala" id="aloading">
                                  <img src="<?php echo BASE_URL() ?>assets/images/ecash_send/ecash_padala_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                </a>
                              </div>
                              
                              <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>ecash_send/ecashpadala">E-cash Padala</a></h5>
                            <?php else: ?>
                              <div class="thmb-prev">
                                <a style="background-color: #fff;" onclick="alert('You have exceeded the transaction limit for this day.')">
                                  <img src="<?php echo BASE_URL() ?>assets/images/ecash_send/ecash_padala_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                </a>
                              </div>
                              
                              <h5 class="fm-title text-center"><a onclick="alert('You have exceeded the transaction limit for this day.')">E-cash Padala</a></h5>
                            <?php endif ?>
                          </div>
                        </div> 
                      <?php endif ?>
                                                                                  
                      <?php if ($user['A_CTRL']['remittance_creditbank_send'] == 1 && $user['L'] != 5): ?>
                        <div class="col-xs-6 col-sm-6 col-md-3 document">
                          <div class="thmb">
                            <?php if ($exceed_cd_to_bank == 1): ?>
                              <div class="thmb-prev">
                                <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_send/ecashcredittobank" id="aloading">
                                  <img src="<?php echo BASE_URL() ?>assets/images/ecash_send/ecash_to_bank_new.png" class="img-responsive" alt="">
                                </a>
                              </div>
                              
                              <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>ecash_send/ecashcredittobank">Credit to Bank</a></h5>
                            <?php else: ?>
                              <div class="thmb-prev">
                                <a style="background-color: #fff;" onclick="alert('You have exceeded the transaction limit for this day.')">
                                  <img src="<?php echo BASE_URL() ?>assets/images/ecash_send/ecash_to_bank_new.png" class="img-responsive" alt="">
                                </a>
                              </div>
                              
                              <h5 class="fm-title text-center"><a onclick="alert('You have exceeded the transaction limit for this day.')">Credit to Bank</a></h5>
                            <?php endif ?>
                          </div>
                        </div> 
                      <?php endif ?>

                      <?php if ($user['A_CTRL']['remittance_ecad_send'] == 1 && $user['L'] != 5): ?>
                        <div class="col-xs-6 col-sm-6 col-md-3 document">
                          <div class="thmb">
                            <?php if ($exceed_ec_to_cashcard == 1): ?>
                              <div class="thmb-prev">
                                <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_send/ecashtocashcard_new" id="aloading">
                                  <img src="<?php echo BASE_URL() ?>assets/images/ecash_send/ecash_to_cashcard_new.png" class="img-responsive" alt="">
                                </a>
                              </div>
                              
                              <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>ecash_send/ecashtocashcard_new">E-cash Cashcard</a></h5>
                            <?php else: ?>
                              <div class="thmb-prev">
                                <a style="background-color: #fff;" onclick="alert('You have exceeded the transaction limit for this day.')">
                                  <img src="<?php echo BASE_URL() ?>assets/images/ecash_send/ecash_to_cashcard_new.png" class="img-responsive" alt="">
                                </a>
                              </div>
                              
                              <h5 class="fm-title text-center"><a onclick="alert('You have exceeded the transaction limit for this day.')">E-cash Cashcard</a></h5>
                            <?php endif ?>
                          </div>
                        </div> 
                      <?php endif ?>

                      <?php if ($user['A_CTRL']['remittance_baremi_send'] == 1 && $user['L'] != 5): ?>
                        <div class="col-xs-6 col-sm-6 col-md-3 document">
                          <div class="thmb">
                            <div class="thmb-prev">
                              <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_send/baremi_index" id="aloading">
                                  <img src="<?php echo BASE_URL() ?>assets/images/ecash_payout/gcash.png" class="img-responsive" alt="" style= "margin:0 auto;">
                              </a>
                            </div>
                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>ecash_send/baremi_index">Ecash to GCash</a></h5>
                          </div>
                        </div> 
                      <?php endif ?>

                      <?php if ($user['A_CTRL']['remittance_cebuana'] == 1 && $user['L'] != 5): ?>
                        <div class="col-xs-6 col-sm-6 col-md-3 document">
                          <div class="thmb">
                            <?php if ($exceed_ec_to_cebuana == 1): ?>
                              <div class="thmb-prev">
                                <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_send/cebuana_index" id="aloading">
                                  <img src="<?php echo BASE_URL() ?>assets/images/ecash_send/cebuana.png" class="img-responsive" alt="" style= "margin:0 auto;">
                                </a>
                              </div>

                              <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>ecash_send/cebuana_index">E-Cash to Cebuana</a></h5>
                            <?php else: ?>
                              <div class="thmb-prev">
                                <a style="background-color: #fff;" onclick="alert('You have exceeded the transaction limit for this day.')">
                                  <img src="<?php echo BASE_URL() ?>assets/images/ecash_send/cebuana.png" class="img-responsive" alt="" style= "margin:0 auto;">
                                </a>
                              </div>

                              <h5 class="fm-title text-center"><a onclick="alert('You have exceeded the transaction limit for this day.')">E-Cash to Cebuana</a></h5>
                            <?php endif ?>
                          </div>
                        </div>
                      <?php endif ?> 
                      
                      <?php if ($user['A_CTRL']['remittance_westernunion_send'] == 1 || $user['R'] == '1234567' && $user['L'] != 5): ?>
                        <div class="col-xs-6 col-sm-6 col-md-3 document">
                          <div class="thmb">
                            <?php if ($exceed_wu): ?>
                              <div class="thmb-prev">
                                <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_send/ecashtowestern?nocached=0678b8983cb26f2d3293a404337d6174" id="aloading">
                                  <img src="<?php echo BASE_URL() ?>assets/images/ecash_send/Western_Union.png" class="img-responsive" alt="">
                                </a>
                              </div>
                              
                              <h5 class="fm-title text-center" nowrap><a href="<?php echo BASE_URL() ?>ecash_send/ecashtowestern?nocached=0678b8983cb26f2d3293a404337d6174" refresh="0" >Western Union</a></h5>
                            <?php else: ?>
                              <div class="thmb-prev">
                                <a style="background-color: #fff;" onclick="alert('You have exceeded the transaction limit for this day.')">
                                  <img src="<?php echo BASE_URL() ?>assets/images/ecash_send/Western_Union.png" class="img-responsive" alt="">
                                </a>
                              </div>
                              
                              <h5 class="fm-title text-center" nowrap><a onclick="alert('You have exceeded the transaction limit for this day.')">Western Union</a></h5>
                            <?php endif ?>
                          </div>
                        </div>
                      <?php endif ?>

                      <?php if ($user['A_CTRL']['remittance_smartmoney_send'] == 2 && $user['L']!=5): ?>   
                        <div class="col-xs-6 col-sm-6 col-md-3 document">
                          <div class="thmb">
                            <?php if ($exceed_sm == 1): ?>
                              <div class="thmb-prev">
                                <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_send/ecash_to_paymaya" id="aloading">
                                  <img src="<?php echo BASE_URL() ?>assets/images/ecash_send/ecash_to_smartmoney_new.png" class="img-responsive" alt="" style= "margin:0 auto;">
                                </a>
                              </div>

                              <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>ecash_send/ecash_to_paymaya">E-Cash to Smartmoney</a></h5>
                            <?php else: ?>
                              <div class="thmb-prev">
                                <a style="background-color: #fff;" onclick="alert('You have exceeded the transaction limit for this day.')">
                                  <img src="<?php echo BASE_URL() ?>assets/images/ecash_send/ecash_to_smartmoney_new.png" class="img-responsive" alt="" style= "margin:0 auto;">
                                </a>
                              </div>

                              <h5 class="fm-title text-center"><a onclick="alert('You have exceeded the transaction limit for this day.')">E-Cash to Smartmoney</a></h5>
                            <?php endif ?>
                          </div>
                        </div> 
                      <?php endif ?>
                                                     
                      <?php if ($this->user['R'] == '1234567'): ?>
                        <div class="col-xs-6 col-sm-6 col-md-3 document">
                          <div class="thmb">
                            <div class="thmb-prev">
                              <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_send/ecash_to_gcash_topup_ecpay" id="aloading">
                                <img src="<?php echo BASE_URL() ?>assets/images/ecash_send/ecash_to_smartmoney_new.png" class="img-responsive" alt="" style= "margin:0 auto;">
                              </a>
                            </div>

                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>ecash_send/ecash_to_gcash_topup_ecpay">Top-Up Gcash ECPAY</a></h5>
                          </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-3 document">
                          <div class="thmb">
                            <div class="thmb-prev">
                              <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_send/ecash_to_paymaya_topup_ecpay" id="aloading">
                                <img src="<?php echo BASE_URL() ?>assets/images/ecash_send/ecash_to_smartmoney_new.png" class="img-responsive" alt="" style= "margin:0 auto;">
                              </a>
                            </div>

                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>ecash_send/ecash_to_paymaya_topup_ecpay">Top-Up Paymaya ECPAY</a></h5>
                          </div>
                        </div>
                      <?php endif?> 
                    </div>
                  </div>      
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>            
</div>

<script>
  $(document).ready(() => {
    $("#fac").modal("show")
  });

  $("#buttonfac").click(() => {
    $("#send").hide()
    setTimeout(() => {
      window.location.href = "/Main"
    }, 100)
  });

  $("#fac").click(() => {
    $("#send").hide();
    setTimeout(() => {
      window.location.href = "/Main"
    }, 100)
  })
</script>