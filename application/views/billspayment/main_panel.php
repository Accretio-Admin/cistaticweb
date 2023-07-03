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
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    <div class="contentpanel">

                        <div class="row row-stat">
                            <div class="col-sm-9 col-md-9">
                                <div class="tab-content nopadding noborder">
                                    <div class="tab-pane active" id="activities">
                                        <div class="follower-list">  
                                            <div class="col-sm-12">
                                                <div class="row media-manager">
                                                <?php if ($user['R'] != 'GPTTM001'): ?>
                                                  
                                                    <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                      <div class="thmb" >
                                                        <div class="thmb-prev  text-center">
                                                          <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/biller_main/electric" class="" id="billsPaymentLoading">
                                                              <img  src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                          </a>
                                                        </div>
                                                        <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/biller_main/electric" id="billsPaymentLoading">ELECTRIC</a></h5>
                                                      </div><!-- thmb -->
                                                    </div>
                                                    <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                        <div class="thmb" >
                                                          <div class="thmb-prev  text-center">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/biller_main/water" class="" id="billsPaymentLoading">
                                                                <img  src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/biller_main/water" id="billsPaymentLoading">WATER</a></h5>
                                                        </div><!-- thmb -->
                                                     </div> 
                                                      <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                        <div class="thmb" >
                                                          <div class="thmb-prev  text-center">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/biller_main/cabletv_internet" class="" id="billsPaymentLoading">
                                                                <img  src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/biller_main/cabletv_internet" id="billsPaymentLoading">CABLE TV / INTERNET</a></h5>
                                                        </div><!-- thmb -->
                                                     </div>  
                                                     <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/biller_main/telecomm" id="billsPaymentLoading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/billspayment/telecom_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/biller_main/telecomm" id="billsPaymentLoading">TELECOM</a></h5>
                                                        </div><!-- thmb -->
                                                     </div> 
                                                     

                                                     <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/biller_main/bank" id="billsPaymentLoading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/billspayment/creditcards_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/biller_main/bank" id="billsPaymentLoading">BANK</a></h5>
                                                        </div><!-- thmb -->
                                                     </div>

                                                     <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/biller_main/credit_card" id="billsPaymentLoading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/biller_main/credit_card" id="billsPaymentLoading">CREDIT CARDS</a></h5>
                                                        </div><!-- thmb -->
                                                     </div>  

                                                      <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/biller_main/payment_gateway" id="billsPaymentLoading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/biller_main/payment_gateway" id="billsPaymentLoading">PAYMENT GATEWAY</a></h5>
                                                        </div><!-- thmb -->
                                                      </div> 

                                                      <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/biller_main/top_up" id="billsPaymentLoading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/biller_main/top_up" id="billsPaymentLoading">TOP UP</a></h5>
                                                        </div><!-- thmb -->
                                                      </div> 

                                                      <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/biller_main/airlines" id="billsPaymentLoading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/billspayment/airlines_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/biller_main/airlines" id="billsPaymentLoading">AIRLINES</a></h5>
                                                        </div><!-- thmb -->
                                                      </div>
                                                      
                                                    <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/biller_main/government" id="billsPaymentLoading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/billspayment/government_new.png" class="img-responsive" alt=""  style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/biller_main/government" id="billsPaymentLoading">GOVERNMENT</a></h5>
                                                        </div><!-- thmb -->
                                                     </div> 
                                                     

                                                    <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/biller_main/schools" id="billsPaymentLoading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/billspayment/school_new.png" class="img-responsive" alt="">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/biller_main/schools" id="billsPaymentLoading">SCHOOLS</a></h5>
                                                        </div><!-- thmb -->
                                                     </div> 
                                                      
                                                      <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                          <div class="thmb">
                                                            <div class="thmb-prev">
                                                              <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/biller_main/real_estate" id="billsPaymentLoading">
                                                                  <img src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt=""  style= "margin:0 auto">
                                                              </a>
                                                            </div>
                                                            <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/biller_main/real_estate" id="billsPaymentLoading">REAL ESTATE</a></h5>
                                                          </div><!-- thmb -->
                                                       </div> 
                                                     
                                                     <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/biller_main/financial_services" id="billsPaymentLoading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/biller_main/financial_services" id="billsPaymentLoading">FINANCIAL SERVICES</a></h5>
                                                        </div><!-- thmb -->
                                                     </div> 
                                                     <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/biller_main/insurance" id="billsPaymentLoading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/billspayment/insurance_new.png" class="img-responsive" alt="">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/biller_main/insurance" id="billsPaymentLoading">INSURANCE</a></h5>
                                                        </div><!-- thmb -->
                                                     </div> 
                                                     
                                                     <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/biller_main/charity" id="billsPaymentLoading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/biller_main/charity" id="billsPaymentLoading">CHARITY</a></h5>
                                                        </div><!-- thmb -->
                                                     </div> 
                                                     
                                                     <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/biller_main/memorial" id="billsPaymentLoading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/biller_main/memorial" id="billsPaymentLoading">MEMORIAL</a></h5>
                                                        </div><!-- thmb -->
                                                     </div> 
                                                <?php endif; ?>
                                                <?php if ($user['R'] != 'GPTTM001'): ?>
                                                      <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/biller_main/others" id="billsPaymentLoading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/billspayment/others_new.png" class="img-responsive" alt="">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/biller_main/others" id="billsPaymentLoading">OTHERS</a></h5>
                                                        </div><!-- thmb -->
                                                     </div> 
                                                      <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                        <div class="thmb">
                                                          <div class="thmb-prev">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/ecashtopup" id="billsPaymentLoading">
                                                                <img src="<?php echo BASE_URL() ?>assets/images/ecash_send/ecash_to_load_fund_new.png" class="img-responsive" alt="">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/ecashtopup" id="billsPaymentLoading">ECASH TOP-UP</a></h5>
                                                        </div><!-- thmb -->
                                                     </div> 
                                                <?php endif; ?>
                                                
                                                  <!-- <div class="col-xs-6 col-sm-6 col-md-3 document mcwdfortemporary">
                                                      <div class="thmb" >
                                                        <div class="thmb-prev  text-center">
                                                          <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/mcwd" class="" id="billsPaymentLoading">
                                                              <img  src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                          </a>
                                                        </div>
                                                        <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/mcwd" id="metroturf">MCWD</a></h5>
                                                      </div>
                                                   </div> -->


                                                   <div class="col-xs-6 col-sm-6 col-md-3 document mcwdfortemporary">
                                                      <div class="thmb" >
                                                        <div class="thmb-prev  text-center">
                                                          <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/unified" class="" id="billsPaymentLoading">
                                                              <img  src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                          </a>
                                                        </div>
                                                        <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/unified" id="metroturf">UNIFIED V1 to V3 TOP-UP</a></h5>
                                                      </div>
                                                   </div>

                                                   <!-- <div class="col-xs-6 col-sm-6 col-md-3 document mcwdfortemporary">
                                                      <div class="thmb" >
                                                        <div class="thmb-prev  text-center">
                                                          <a style="background-color: #fff;" href="<?php// echo BASE_URL() ?>Bills_payment/gocabv1" class="" id="billsPaymentLoading">
                                                              <img  src="<?php// echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                          </a>
                                                        </div>
                                                        <h5 class="fm-title text-center"><a href="<?php// echo BASE_URL() ?>Bills_payment/gocabv1" id="metroturf">GO CAB</a></h5>
                                                      </div>
                                                   </div> -->

                                                   <?php //if ($user['R'] == 'F2895141' || $user['R'] == 'F5597768' || $user['R'] == 'F2297646'|| $user['R'] == 'F4445336'|| $user['R'] == 'F2301753'): ?>
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
                                                   <?php //endif; ?>

                                                   <?php if ($user['R'] !== ''): //|| $user['R'] == 'F6708104' || $user['R'] == 'F6819290' || $user['R'] == 'F6829187' || $user['R'] == 'F6857702' || $user['R'] == 'F7107276' || $user['R'] == 'F7412421' || $user['R'] == 'F7496442' || $user['R'] == 'F7617021'): ?>
                                                    <div class="col-xs-6 col-sm-6 col-md-3 document mcwdfortemporary">
                                                        <div class="thmb" >
                                                          <div class="thmb-prev  text-center">
                                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/mcwd" class="" id="billsPaymentLoading">
                                                                <img  src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                            </a>
                                                          </div>
                                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/mcwd" id="metroturf">MCWD</a></h5>
                                                        </div>
                                                    </div>
                                                   <?php endif; ?>

                                                   <!-- <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                      <div class="thmb" >
                                                        <div class="thmb-prev  text-center">
                                                          <a style="background-color: #fff;" href="#" class="" id="">
                                                              <img data-toggle="modal" data-target="#temporary" src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                          </a>
                                                        </div>
                                                        <h5 class="fm-title text-center"><a data-toggle="modal" data-target="#temporary">MCWD</a></h5>
                                                      </div>
                                                   </div>

                                                   <div class="modal fade" id="temporary" role="dialog">
      <div class="modal-dialog">
      
        <div class="modal-content">
          <div class="modal-header">
            
          </div>
          <div class="modal-body">
            <div class="alert alert-danger">
  <strong>This Service is temporarily unavailable.</strong>
</div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        
      </div>
    </div> -->
                                                   
                                                <?php if ($user['R'] == '1234567' || $user['R'] == 'F1359252' || $user['R'] == 'F8901916' || $user['R'] == 'F1526245'): ?>
                                                   <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                      <div class="thmb" >
                                                        <div class="thmb-prev  text-center">
                                                          <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/metroturf" class="" id="billsPaymentLoading">
                                                              <img  src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                          </a>
                                                        </div>
                                                        <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/metroturf" id="metroturf">METROTURF TOP-UP</a></h5>
                                                      </div>
                                                   </div>   
                                                <?php endif; ?>

                                                  <!-- added by son -->
                                                    <!-- <div class="col-xs-6 col-sm-6 col-md-3 document">
                                                      <div class="thmb" >
                                                        <div class="thmb-prev  text-center">
                                                          <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Bills_payment/beepcard" class="" id="billsPaymentLoading">
                                                              <img  src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                                          </a>
                                                        </div>
                                                        <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Bills_payment/beepcard" id="metroturf">Beep Reload</a></h5>
                                                      </div>
                                                    </div> -->
                                                  <!-- added by son -->

                                                 </div>
                                             </div>      
                                        </div><!-- activity-list -->

                                    </div><!-- tab-pane -->

                                </div>
                            </div><!-- col-md-8 -->
                        </div><!-- row -->

                    </div><!-- contentpanel -->
                    
                </div><!-- mainpanel -->            