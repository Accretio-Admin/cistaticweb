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
                <h4>E-CASH PAYOUT</h4>
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
                                    <?php if ($user['A_CTRL']['remittance_smartmoney_payout'] == 1): ?>
                                    <div class="col-xs-6 col-sm-6 col-md-3 document">
                                        <div class="thmb" >
                                          <div class="thmb-prev  text-center">
                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_payout/smartmoneytoecash" class="" id="aloading">
                                                <img src="<?php echo BASE_URL() ?>assets/images/ecash_payout/ecash_to_smartmoney_new.png" class="img-responsive" alt="">
                                            </a>
                                          </div>
                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>ecash_payout/smartmoneytoecash">Smartmoney to E-Cash</a></h5>
                                        </div><!-- thmb -->
                                     </div>  
                                    <?php endif ?>

                                      <?php if ($user['A_CTRL']['remittance_gprs_payout'] == 1): ?>
                                     <div class="col-xs-6 col-sm-6 col-md-3 document">
                                        <div class="thmb">
                                          <div class="thmb-prev">
                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_payout/ecashpadala" id="aloading">
                                                <img src="<?php echo BASE_URL() ?>assets/images/ecash_payout/ecash_padala_new.png" class="img-responsive" alt="">
                                            </a>
                                          </div>
                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>ecash_payout/ecashpadala">E-Cash Padala</a></h5>
                                        </div><!-- thmb -->
                                     </div>
                                      <?php endif ?>

                                     <?php if ($user['A_CTRL']['remittance_iremit_payout'] == 1): ?>
                                     <div class="col-xs-6 col-sm-6 col-md-3 document">
                                        <div class="thmb">
                                          <div class="thmb-prev">
                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_payout/iremit" id="aloading">
                                                <img src="<?php echo BASE_URL() ?>assets/images/ecash_payout/iremit_new.png" class="img-responsive" alt="">
                                            </a>
                                          </div>
                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>ecash_payout/iremit">IRemit</a></h5>
                                        </div><!-- thmb -->
                                     </div>
                                      <?php endif ?>

                                     <?php if ($user['A_CTRL']['remittance_transfast_payout'] == 1): ?>
                                     <div class="col-xs-6 col-sm-6 col-md-3 document">
                                        <div class="thmb">
                                          <div class="thmb-prev">
                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_payout/transfast" id="aloading">
                                                <img src="<?php echo BASE_URL() ?>assets/images/ecash_payout/transfast_new.png" class="img-responsive" alt="">
                                            </a>
                                          </div>
                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>ecash_payout/transfast">Transfast</a></h5>
                                        </div><!-- thmb -->
                                     </div> 
                                      <?php endif ?> 

                                    <?php if ($user['A_CTRL']['remittance_nyb_payout'] == 1): ?>
                                    <div class="col-xs-6 col-sm-6 col-md-3 document">
                                        <div class="thmb">
                                          <div class="thmb-prev">
                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_payout/newyorkbay" id="aloading">
                                                <img src="<?php echo BASE_URL() ?>assets/images/ecash_payout/newyork_bank_new.png" class="img-responsive" alt="">
                                            </a>
                                          </div>
                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>ecash_payout/newyorkbay">New York Bay</a></h5>
                                        </div><!-- thmb -->
                                     </div> 
                                      <?php endif ?>

                                      <?php if ($user['A_CTRL']['remittance_abscbn_payout'] == 1): ?>
                                      <div class="col-xs-6 col-sm-6 col-md-3 document">
                                        <div class="thmb">
                                          <div class="thmb-prev">
                                            <a style="background-color: #fff;" href="#" id="aloading">
                                                <img src="<?php echo BASE_URL() ?>assets/images/ecash_payout/abscbn_remit.png" class="img-responsive" alt="">
                                            </a>
                                          </div>
                                          <h5 class="fm-title text-center"><a href="#">ABS CBN Remit</a></h5>
                                        </div><!-- thmb -->
                                     </div> 
                                      <?php endif ?>

                                    <?php if ($user['A_CTRL']['remittance_moneygram_payout'] == 1): ?>
                                    <div class="col-xs-6 col-sm-6 col-md-3 document">
                                        <div class="thmb">
                                          <div class="thmb-prev">
                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_payout/moneygram" id="aloading">
                                                <img src="<?php echo BASE_URL() ?>assets/images/ecash_payout/moneygram_new.png" class="img-responsive" alt="">
                                            </a>
                                          </div>
                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>ecash_payout/moneygram">Moneygram</a></h5>
                                        </div><!-- thmb -->
                                     </div>  
                                      <?php endif ?>
                                     
                                      <div class="col-xs-6 col-sm-6 col-md-3 document">
                                        <div class="thmb">
                                          <div class="thmb-prev">
                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_payout/ecashpayoutcenter" id="aloading">
                                                <img src="<?php echo BASE_URL() ?>assets/images/ecash_payout/payout_center_new.png" class="img-responsive" alt="">
                                            </a>
                                          </div>
                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>ecash_payout/ecashpayoutcenter">E-Cash Payout Center</a></h5>
                                        </div><!-- thmb -->
                                     </div>  

                                     <?php if ($user['A_CTRL']['remittance_baremi_payout'] == 1): ?>
                                      <div class="col-xs-6 col-sm-6 col-md-3 document">
                                        <div class="thmb">
                                          <div class="thmb-prev">
                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_payout/baremi_payout" id="aloading">
                                                <img src="<?php echo BASE_URL() ?>assets/images/ecash_payout/gcash.png" class="img-responsive" alt="">
                                            </a>
                                          </div>
                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>ecash_payout/baremi_payout">GCash Payout</a></h5>
                                        </div><!-- thmb -->
                                     </div>
                                      <?php endif ?>

                                     <!-- <div class="col-xs-6 col-sm-6 col-md-3 document">
                                        <div class="thmb">
                                          <div class="thmb-prev">
                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_payout/placidexpress" id="aloading">
                                                <img src="<?php echo BASE_URL() ?>assets/images/ecash_payout/transfast_new.png" class="img-responsive" alt="">
                                            </a>
                                          </div>
                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>ecash_payout/placidexpress">Placid Express</a></h5>
                                        </div>
                                     </div> 
                                     
                                     <div class="col-xs-6 col-sm-6 col-md-3 document">
                                        <div class="thmb">
                                          <div class="thmb-prev">
                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_payout/gcashcashout" id="aloading">
                                                <img src="<?php echo BASE_URL() ?>assets/images/ecash_payout/transfast_new.png" class="img-responsive" alt="">
                                            </a>
                                          </div>
                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>ecash_payout/gcashcashout">Gcash Cashout</a></h5>
                                        </div>
                                     </div>  -->

                                     <div class="col-xs-6 col-sm-6 col-md-3 document">
                                        <div class="thmb" >
                                          <div class="thmb-prev  text-center">
                                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>ecash_payout/gocab_cashout" class="" id="billsPaymentLoading">
                                                <img  src="<?php echo BASE_URL() ?>assets/images/billspayment/utilities_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                                            </a>
                                          </div>
                                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>ecash_payout/gocab_cashout" id="metroturf">GoCab Cash-Out</a></h5>
                                        </div>
                                      </div>




                              <?php if ($process['P'] == 1 && $process['S']): ?>

                              <div class="row">
                                <div class="col-xs-12 col-md-12">
                                    <div class="text-right" style="margin-bottom:5px">
                                        <span class="badge badge-danger"><?php echo $process['M']; ?></span>
                                    </div>

                                </div>   
                              </div>

                              <?php endif ?>

                        <div class="row">
                          <div class="col-xs-12 col-md-12" >
                         <table class="table table-bordered" style="width:auto;">
                              <thead align="center">
                                  <tr >
                                        <ul class="nav nav-tabs">
                                          <li ><a href="<?php echo BASE_URL()?>ecash_payout"><u>Pending ID Verification</u></a></li>
                                          <li class="active"><a href="<?php echo BASE_URL()?>ecash_payout/approved_id"><u>Approved ID</u></a></li>
                                          <li><a href="<?php echo BASE_URL()?>ecash_payout/revoked_id"><u>Revoked ID</u></a></li>
                                      </ul>
                                  </tr>
                              </thead> 
                        </table>
                          </div>
                        </div>



                              <?php if ($process['P'] == 1 && $process['S'] === 1): ?>

                              <div class="row">
                                <div class="col-xs-12 col-md-12">

                                    <?php if (substr($process['M'], 1,1) != 0): ?>
                                      <div class="col-md-12 col-xs-12" style="overflow-y:scroll;height:350px;overflow-x:auto" >
                                          
                                           <table class="table table-bordered" style="width:auto;">
                                                  <thead align="center">
                                                      <tr >
                                                          <?php
                                                          foreach($API['T_DATA'] as $row)
                                                          {
                                                              foreach($row as $key => $value)
                                                              {
                                                                  echo '<th nowrap>'.ucwords($key).'</th>';
                                                              }
                                                              break;
                                                          }
                                                          ?>
                                                      </tr>
                                                  </thead> 
                                                  <tbody>
                                                          <?php
                                                          foreach($API['T_DATA'] as $row)
                                                          {   
                                                              echo '<tr>';
                                                              foreach($row as $key => $value)
                                                              {   
                                                                  

                                                                  if (strpos($value, 'ftp://') !== false) {
                                                                    echo '<td nowrap><a href='.$value.' target="_blank">View Image</td>';
                                                                  }
                                                                  else
                                                                  {
                                                                    echo '<td nowrap>'.$value.'</td>';
                                                                  }
                                                                  

                                                              }
                                                              echo '</tr>';
                                                          }
                                                          ?>
                                                  </tbody>  
                                            </table>
                                      </div>
                                <?php endif ?>
                                </div>   
                              </div>
                          <?php endif ?>




                          
                                 </div>
                             </div>      
                        </div><!-- activity-list -->
                    </div><!-- tab-pane -->
                </div>
            </div><!-- col-md-8 -->
        </div><!-- row -->
    </div><!-- contentpanel -->                   
</div><!-- mainpanel -->            