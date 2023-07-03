<div class="mainpanel">
  <div class="pageheader">
    <div class="media">
      <div class="pageicon pull-left">
        <i class="fa fa-money"></i>
      </div>
      
      <div class="media-body">
        <ul class="breadcrumb">
          <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
          <li>BILLS PAYMENT</li>
        </ul>

        <h4>BILLS PAYMENT</h4>
      </div>

      <div class="contentpanel">
        <div class="row row-stat">
          <div class="col-sm-9 col-md-9">
            <div class="tab-content nopadding noborder">
              <div class="tab-pane active" id="activities">
                <div class="follower-list">  
                  <div class="col-sm-12">
                    <div class="row media-manager">
                      <?php if ($user['R'] != 'GPTTM001'): ?>

                        <!-- <div class="col-xs-6 col-sm-6 col-md-3 document">
                          <div class="thmb" >
                            <?php if ($billspayment_exceed == 1): ?>
                              <div class="thmb-prev  text-center">
                                <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/biller_main/utilities" class="" id="billsPaymentLoading">
                                  <img  src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="" style="margin:0 auto">
                                </a>
                              </div>
                              
                              <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/biller_main/utilities" id="billsPaymentLoading">UTILITIES</a></h5>
                            <?php else: ?>
                              <div class="thmb-prev  text-center">
                                <a style="background-color: #fff;" onclick="alert('You have exceeded the transaction limit for this day.')">
                                  <img src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="" style="margin:0 auto">
                                </a>
                              </div>
                              
                              <h5 class="fm-title text-center"><a onclick="alert('You have exceeded the transaction limit for this day.')">UTILITIES</a></h5>
                            <?php endif?>
                          </div>
                        </div>   -->

                        <div class="col-xs-6 col-sm-6 col-md-3 document">
                          <div class="thmb" >
                            <?php if ($billspayment_exceed == 1): ?>
                              <div class="thmb-prev  text-center">
                                <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/biller_main/electric" class="" id="billsPaymentLoading">
                                  <img  src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                </a>
                             </div>
                              
                             <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/biller_main/electric" id="billsPaymentLoading">ELECTRIC</a></h5>
                            <?php else: ?>
                              <div class="thmb-prev  text-center">
                                <a style="background-color: #fff;" onclick="alert('You have exceeded the transaction limit for this day.')">
                                  <img src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="" style="margin:0 auto">
                                </a>
                              </div>
                              
                              <h5 class="fm-title text-center"><a onclick="alert('You have exceeded the transaction limit for this day.')">ELECTRIC</a></h5>
                            <?php endif?>
                          </div>
                        </div>  

                        <div class="col-xs-6 col-sm-6 col-md-3 document">
                          <div class="thmb" >
                            <?php if ($billspayment_exceed == 1): ?>
                              <div class="thmb-prev  text-center">
                                <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/biller_main/water" class="" id="billsPaymentLoading">
                                     <img  src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                 </a>
                               </div>
                              
                               <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/biller_main/water" id="billsPaymentLoading">WATER</a></h5>
                            <?php else: ?>
                              <div class="thmb-prev  text-center">
                                <a style="background-color: #fff;" onclick="alert('You have exceeded the transaction limit for this day.')">
                                  <img src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="" style="margin:0 auto">
                                </a>
                              </div>
                              
                              <h5 class="fm-title text-center"><a onclick="alert('You have exceeded the transaction limit for this day.')">WATER</a></h5>
                            <?php endif?>
                          </div>
                        </div>  


                        <div class="col-xs-6 col-sm-6 col-md-3 document">
                          <div class="thmb">
                            <?php if ($billspayment_exceed == 1): ?>
                              <div class="thmb-prev">
                                <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/biller_main/telecomm" id="billsPaymentLoading">
                                  <img src="<?php echo BASE_URL() ?>assets/images/billspayment/telecom_new.png" class="img-responsive" alt="" style="margin:0 auto">
                                </a>
                              </div>
                              
                              <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/biller_main/telecomm" id="billsPaymentLoading">TELECOM</a></h5>
                            <?php else: ?>
                              <div class="thmb-prev">
                                <a style="background-color: #fff;" onclick="alert('You have exceeded the transaction limit for this day.')">
                                  <img src="<?php echo BASE_URL() ?>assets/images/billspayment/telecom_new.png" class="img-responsive" alt="" style="margin:0 auto">
                                </a>
                              </div>
                              
                              <h5 class="fm-title text-center"><a onclick="alert('You have exceeded the transaction limit for this day.')">TELECOM</a></h5>
                            <?php endif?>
                          </div>
                        </div>   

                        <div class="col-xs-6 col-sm-6 col-md-3 document">
                          <div class="thmb">
                            <?php if ($billspayment_exceed == 1): ?>
                              <div class="thmb-prev">
                                <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/biller_main/airlines" id="billsPaymentLoading">
                                  <img src="<?php echo BASE_URL() ?>assets/images/billspayment/airlines_new.png" class="img-responsive" alt="" style="margin:0 auto">
                                </a>
                              </div>

                              <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/biller_main/airlines" id="billsPaymentLoading">AIRLINES</a></h5>
                            <?php else: ?>
                              <div class="thmb-prev">
                                <a style="background-color: #fff;" onclick="alert('You have exceeded the transaction limit for this day.')">
                                  <img src="<?php echo BASE_URL() ?>assets/images/billspayment/airlines_new.png" class="img-responsive" alt="" style="margin:0 auto">
                                </a>
                              </div>

                              <h5 class="fm-title text-center"><a onclick="alert('You have exceeded the transaction limit for this day.')">AIRLINES</a></h5>
                            <?php endif?>
                          </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-3 document">
                          <div class="thmb">
                            <?php if ($billspayment_exceed == 1): ?>
                              <div class="thmb-prev">
                                <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/biller_main/credit_card" id="billsPaymentLoading">
                                  <img src="<?php echo BASE_URL() ?>assets/images/billspayment/creditcards_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                </a>
                              </div>

                              <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/biller_main/credit_card" id="billsPaymentLoading">CREDIT CARDS</a></h5>
                            <?php else: ?>
                              <div class="thmb-prev">
                                <a style="background-color: #fff;" onclick="alert('You have exceeded the transaction limit for this day.')">
                                  <img src="<?php echo BASE_URL() ?>assets/images/billspayment/creditcards_new.png" class="img-responsive" alt="" style="margin:0 auto">
                                </a>
                              </div>

                              <h5 class="fm-title text-center"><a onclick="alert('You have exceeded the transaction limit for this day.')">CREDIT CARDS</a></h5>
                            <?php endif ?>
                          </div>
                        </div> 
                      <?php endif; ?>

                      <div class="col-xs-6 col-sm-6 col-md-3 document">
                        <div class="thmb">
                          <?php if ($billspayment_exceed == 1): ?>
                            <div class="thmb-prev">
                              <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/biller_main/government" id="billsPaymentLoading">
                                <img src="<?php echo BASE_URL() ?>assets/images/billspayment/government_new.png" class="img-responsive" alt=""  style= "margin:0 auto">
                              </a>
                            </div>

                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/biller_main/government" id="billsPaymentLoading">GOVERNMENT</a></h5>
                          <?php else: ?>
                            <div class="thmb-prev">
                              <a style="background-color: #fff;" onclick="alert('You have exceeded the transaction limit for this day.')">
                                <img src="<?php echo BASE_URL() ?>assets/images/billspayment/government_new.png" class="img-responsive" alt=""  style= "margin:0 auto">
                              </a>
                            </div>

                            <h5 class="fm-title text-center"><a onclick="alert('You have exceeded the transaction limit for this day.')">GOVERNMENT</a></h5>
                          <?php endif ?>
                        </div>
                      </div> 

                      <?php if ($user['R'] != 'GPTTM001'): ?>
                        <div class="col-xs-6 col-sm-6 col-md-3 document">
                          <div class="thmb">
                            <?php if ($billspayment_exceed == 1): ?>
                              <div class="thmb-prev">
                                <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/biller_main/insurance" id="billsPaymentLoading">
                                  <img src="<?php echo BASE_URL() ?>assets/images/billspayment/insurance_new.png" class="img-responsive" alt="">
                                </a>
                              </div>
                              
                              <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/biller_main/insurance" id="billsPaymentLoading">INSURANCE</a></h5>
                            <?php else: ?>
                              <div class="thmb-prev">
                                <a style="background-color: #fff;" onclick="alert('You have exceeded the transaction limit for this day.')">
                                  <img src="<?php echo BASE_URL() ?>assets/images/billspayment/insurance_new.png" class="img-responsive" alt="">
                                </a>
                              </div>
                              
                              <h5 class="fm-title text-center"><a onclick="alert('You have exceeded the transaction limit for this day.')">INSURANCE</a></h5>
                            <?php endif ?>
                          </div>
                        </div> 

                        <div class="col-xs-6 col-sm-6 col-md-3 document">
                          <div class="thmb">
                            <?php if ($billspayment_exceed == 1): ?>
                              <div class="thmb-prev">
                                <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/schools" id="billsPaymentLoading">
                                  <img src="<?php echo BASE_URL() ?>assets/images/billspayment/school_new.png" class="img-responsive" alt="">
                                </a>
                              </div>

                              <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/schools" id="billsPaymentLoading">SCHOOLS</a></h5>
                            <?php else: ?>
                              <div class="thmb-prev">
                                <a style="background-color: #fff;" onclick="alert('You have exceeded the transaction limit for this day.')">
                                  <img src="<?php echo BASE_URL() ?>assets/images/billspayment/school_new.png" class="img-responsive" alt="">
                                </a>
                              </div>

                              <h5 class="fm-title text-center"><a onclick="alert('You have exceeded the transaction limit for this day.')">SCHOOLS</a></h5>
                            <?php endif ?>
                          </div>
                        </div> 

                        <div class="col-xs-6 col-sm-6 col-md-3 document">
                          <div class="thmb">
                            <?php if ($billspayment_exceed == 1): ?>
                              <div class="thmb-prev">
                                <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/biller_main/others" id="billsPaymentLoading">
                                  <img src="<?php echo BASE_URL() ?>assets/images/billspayment/others_new.png" class="img-responsive" alt="">
                                </a>
                              </div>

                              <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/biller_main/others" id="billsPaymentLoading">OTHERS</a></h5>
                            <?php else: ?>
                              <div class="thmb-prev">
                                <a style="background-color: #fff;" onclick="alert('You have exceeded the transaction limit for this day.')">
                                  <img src="<?php echo BASE_URL() ?>assets/images/billspayment/others_new.png" class="img-responsive" alt="">
                                </a>
                              </div>

                              <h5 class="fm-title text-center"><a onclick="alert('You have exceeded the transaction limit for this day.')">OTHERS</a></h5>
                            <?php endif ?>
                          </div>
                        </div> 

                        <div class="col-xs-6 col-sm-6 col-md-3 document">
                          <div class="thmb">
                            <?php if ($billspayment_exceed == 1): ?>
                              <div class="thmb-prev">
                                <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/ecashtopup" id="billsPaymentLoading">
                                  <img src="<?php echo BASE_URL() ?>assets/images/ecash_send/ecash_to_load_fund_new.png" class="img-responsive" alt="">
                                </a>
                              </div>

                              <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/ecashtopup" id="billsPaymentLoading">ECASH TOP-UP</a></h5>
                            <?php else: ?>
                              <div class="thmb-prev">
                                <a style="background-color: #fff;" onclick="alert('You have exceeded the transaction limit for this day.')">
                                  <img src="<?php echo BASE_URL() ?>assets/images/ecash_send/ecash_to_load_fund_new.png" class="img-responsive" alt="">
                                </a>
                              </div>

                              <h5 class="fm-title text-center"><a onclick="alert('You have exceeded the transaction limit for this day.')">ECASH TOP-UP</a></h5>
                            <?php endif ?>
                          </div>
                        </div> 
                      <?php endif; ?>
                                                
                      <div class="col-xs-6 col-sm-6 col-md-3 document mcwdfortemporary">
                        <div class="thmb" >
                          <?php if ($billspayment_exceed == 1): ?>
                            <div class="thmb-prev  text-center">
                              <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/mcwd" class="" id="billsPaymentLoading">
                                <img  src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                              </a>
                            </div>

                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/mcwd" id="metroturf">MCWD</a></h5>
                          <?php else: ?>
                            <div class="thmb-prev  text-center">
                              <a style="background-color: #fff;" onclick="alert('You have exceeded the transaction limit for this day.')">
                                <img  src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                              </a>
                            </div>

                            <h5 class="fm-title text-center"><a onclick="alert('You have exceeded the transaction limit for this day.')">MCWD</a></h5>
                          <?php endif ?>
                        </div>
                      </div>

                      <div class="col-xs-6 col-sm-6 col-md-3 document mcwdfortemporary">
                        <div class="thmb" >
                          <?php if ($v1_to_v3_exceed == 1): ?>
                            <div class="thmb-prev  text-center">
                              <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/unified" class="" id="billsPaymentLoading">
                                <img  src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                              </a>
                            </div>

                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/unified" id="metroturf">UNIFIED V1 to V3 TOP-UP</a></h5>
                          <?php else: ?>
                            <div class="thmb-prev  text-center">
                              <a style="background-color: #fff;" onclick="alert('You have exceeded the transaction limit for this day.')">
                                <img  src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                              </a>
                            </div>

                            <h5 class="fm-title text-center"><a onclick="alert('You have exceeded the transaction limit for this day.')">UNIFIED V1 to V3 TOP-UP</a></h5>
                          <?php endif ?>
                        </div>
                      </div>

                      <div class="col-xs-6 col-sm-6 col-md-3 document mcwdfortemporary">
                        <div class="thmb" >
                          <div class="thmb-prev  text-center">
                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/gocab_shipper_cashin" class="" id="billsPaymentLoading">
                              <img  src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                            </a>
                          </div>

                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/gocab_shipper_cashin" id="metroturf">GOCAB CASH-IN</a></h5>
                        </div>
                      </div>
                                                   
                      <?php if ($user['R'] == '1234567' || $user['R'] == 'F1359252' || $user['R'] == 'F8901916' || $user['R'] == 'F1526245'): ?>
                        <div class="col-xs-6 col-sm-6 col-md-3 document">
                          <div class="thmb" >
                            <?php if ($metro_turf_exceed == 1): ?>
                              <div class="thmb-prev  text-center">
                                <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/metroturf" class="" id="billsPaymentLoading">
                                  <img  src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                </a>
                              </div>

                              <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/metroturf" id="metroturf">METROTURF TOP-UP</a></h5>
                            <?php else: ?>
                              <div class="thmb-prev  text-center">
                                <a style="background-color: #fff;" onclick="alert('You have exceeded the transaction limit for this day.')">
                                  <img  src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                </a>
                              </div>

                              <h5 class="fm-title text-center"><a onclick="alert('You have exceeded the transaction limit for this day.')">METROTURF TOP-UP</a></h5>
                            <?php endif ?>
                          </div>
                        </div>   
                      <?php endif; ?>

                      <div class="col-xs-6 col-sm-6 col-md-3 document">
                        <div class="thmb" >
                          <?php if ($beep_reload_exceed == 1): ?>
                            <div class="thmb-prev  text-center">
                              <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/beepcard" class="" id="billsPaymentLoading">
                                  <img  src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                              </a>
                            </div>
                            
                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/beepcard" id="metroturf">Beep Reload</a></h5>
                          <?php else: ?>
                            <div class="thmb-prev  text-center">
                              <a style="background-color: #fff;" onclick="alert('You have exceeded the transaction limit for this day.')">
                                  <img  src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                              </a>
                            </div>
                            
                            <h5 class="fm-title text-center"><a onclick="alert('You have exceeded the transaction limit for this day.')">Beep Reload</a></h5>
                          <?php endif ?>
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
  </div>
</div>       