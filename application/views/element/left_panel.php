<?php
//update by nhez 03/21/2017
  /*    $ACC_CONTROL = $this->Sp_model->userprivilege(); 
    $this->user['A_CTRL'] = $ACC_CONTROL['A_CTRL'];
    $this->session->set_userdata('user',$this->user);*/
?>            
                <style style type="text/css">
                    <?php if (substr($user['R'],0,3) == 'GRM' || $user['R'] == 'F9175006' || $user['R'] == 'G7979485' || $user['R'] == 'F1205575' || $user['R'] == 'F1145677' || $user['R'] == 'F1164754' || $user['R'] == 'F1198933' || $user['R'] == 'F3989172'): ?>
                        .leftpanel .nav > li.active > a {
                            background-color: green;
                        }
                        .leftpanel .nav > li > a i {
                            color: green;
                        }
                        .leftpanel .nav > li.active > a:hover {
                            background-color: #00ad0e;
                        } 
                    <?php elseif (substr($user['R'],0,3) == 'GWL' || substr($user['R'],0,3) == 'DWL'): ?>
                        .leftpanel .nav > li.active > a {
                            background-color: #4ca8de;
                        }
                        .leftpanel .nav > li.active > a:hover {
                            background-color: #277caf;
                        } 
                    <?php endif; ?>
                </style>
                <!-- < ?php echo "<pre>";print_r($this->user);echo "</pre>"; ?> -->
                <div class="leftpanel" >
                    <div class="media profile-left">
                        <a class="pull-left profile-thumb" href="#">
                            <img class="img-circle" src="<?php echo BASE_URL()?>assets/images/photos/default_photo.png" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo str_replace('%20',' ',$this->user['N']).$this->user['airtime_loading'];?></h4>
                            <?php if(isset($this->user['UT'])) { ?>
                                <small class="text-muted"><b><?php echo $user['UT'];?></b></small>
                            <?php } ?>                    
                        </div>
                        <div class="profile-details row" style="margin-top:10px;">
                            <?php if(isset($this->user['R'])) { ?>
                                <small class="text-muted col-md-12" style="line-height: unset; margin-bottom: 10px;">REGCODE <br/><span class="badge"><?php echo $this->user['R']; ?></span></small>
                            <?php } ?>
                            <?php if(isset($this->user['ATC'])) { ?>
                                <small class="text-muted col-md-12" style="line-height: unset;">TYPE <br/><span class="badge"><?php echo $this->user['ATC']; ?></span></small>
                            <?php } ?>
                                <small class="text-muted col-md-12" style="line-height: unset; margin-top: 5px; margin-bottom: 10px;"><a href="<?php echo BASE_URL() ?>Upgrade/">
                                    <span>UPGRADE NOW</span>
                                </a></small>
                            <?php if(isset($this->user['DR'])) { ?>
                                <small class="text-muted col-md-12" style="line-height: unset;">RANK <br/><span class="badge"><?php echo $this->user['DR']; ?></span></small>
                            <?php } ?>
                            
                                <small class="text-muted col-md-12" style="line-height: unset; margin-top: 5px; margin-bottom: 10px;"><span>HIGH5 PROGRESS:</span><a href="<?php echo BASE_URL() ?>Network/high5reports/">
                                    <span><?php echo $this->user['HI5']; ?>/5</span>
                                </a></small>
                           
                        </div>
                    </div><!-- media -->
                    
                    <?php if($this->user['L'] == 7) { ?>

                            <h5 class="leftpanel-title">
                                Navigation
                            </h5>

                    <?php } else { ?>

                        <?php if($this->user['C_FLAG']) { ?>
                            <h5 class="leftpanel-title" style="margin: 5px;">
                                <a href="<?php echo BASE_URL() ?>User_information" data-toggle="tooltip" title="Click Here!">
                                    <img class="img-circle" src="https://mobilereports.globalpinoyremittance.com/assets/images/flags/<?php echo $this->user['C_FLAG']; ?>.png" alt="<?php echo $this->user['C_FLAG']; ?>" width="30px">
                                    <?php echo $this->user['C_FLAG']; ?> (<?php echo $this->user['USER_KYC'] == 'APPROVED' ? '<span class="text-success">VERIFIED</span>' : '<span class="text-danger">UNVERIFIED</span>'; ?>)
                                </a>
                            </h5>
                        <?php } else { ?>
                            <h5 class="leftpanel-title">
                                Navigation (<a href="<?php echo BASE_URL() ?>User_information" data-toggle="tooltip" title="Click Here!"><?php echo $this->user['USER_KYC'] == 'APPROVED' ? '<span class="text-success">VERIFIED</span>' : '<span class="text-danger">UNVERIFIED</span>'; ?></a>)
                            </h5>
                        <?php } ?>

                    <?php } ?>
                        
                    
                    <ul class="nav nav-pills nav-stacked">

                        <!-- <li>
                            <a href="https://bentanayan.com/" target="_blank"><img src="<?php echo BASE_URL()?>assets/images/Bentanayan/Bentanayan_Logo.png" alt="Bentanayan" width="70%" height="auto"></a>
                        </li> -->

                        <li>
                            <a href="<?php echo BASE_URL() ?>Main/marketplace_session" target="_blank" style="font-weight: bolder; font-size:14px;font-family:arial black;padding:10px;"><i style="color: #555; font-size:25px;" class="fa fa-shopping-cart"></i>&nbsp;&nbsp;MarketPlace  <i style="color: #555; font-size:15px;" class="fa fa-share"></i></a>
                        </li>

                    <?php echo  ($menu==1)?'<li  class="active">':'<li  class="">' ?>
                            <a href="<?php echo BASE_URL() ?>Main/">
                                <i class="fa fa-home"></i> <span>Home</span>
                            </a>
                        </li>

                    
                    <?php if (substr($this->user['R'], 0, 3) != 'GWL' || substr($this->user['R'], 0, 3) != 'DWL'): ?>
                        <!-- REMITTANCE -->
                        <?php if ($retailer == 1 || ($this->user['A_CTRL']['remittance'] == 1  && $this->user['R'] != 'G5457340' && $this->user['R'] != 'AIRLINE001' && $this->user['R'] != 'F1359252xx' && $this->user['R'] != 'F7944049')): ?>
                            <?php echo  ($parent=='REMITTANCE')?'<li  class="parent active">':'<li  class="parent">' ?>
                            <a href="#"><i class="fa fa-money"></i> <span>Remittance</span></a>
                                <ul class="children">
                                     <?php echo  ($menu==2)?'<li  class="active">':'<li  class="">' ?>
                                        <?php if(($retailer != 1 && $this->user['RET'] != 1 && $testaccount != 1) && $this->user['R'] == 'AIRLINE001' || $this->user['R'] == 'F1359252xx'){?>
                                            <a href="#" onClick="btnUpdateAccount();">E-Cash Send</a>
                                            <?php } else {
                                                $script='onClick="ecashloanApp.statusAlert()"';
                                                if($retailer == 1)$script='';
                                            ?>
                                            <a href="<?php echo BASE_URL() ?>Ecash_send/" <?php echo $script?> >E-Cash Send</a>
                                        <?php } ?>
                                     </li>
                                     <?php echo  ($menu==3)?'<li  class="active">':'<li  class="">' ?>
                                        <?php if($retailer == 1 || $this->user['RET'] == 1 || $testaccount == 1 || $this->user['R'] == 'AIRLINE001' || $this->user['R'] == 'F1359252xx' || $this->user['R'] == 'FAC0070' || $this->user['R'] == 'FAC0074' || $this->user['R'] == 'FAC0073' || $this->user['R'] == 'FAC0075' || $this->user['R'] == 'FAC0058' ){?>
                                            <a href="#" onClick="btnUpdateAccount();">E-Cash Payout</a>
                                        <?php } else {?>
                                            <a href="<?php echo BASE_URL() ?>Ecash_payout/">E-Cash Payout</a>
                                        <?php } ?>
                                    </li>

                                    <?php echo  ($menu=='ecash_transactions')?'<li  class="active">':'<li  class="">' ?>
                                        <?php if($retailer == 1 || $this->user['RET'] == 1 || $testaccount == 1 || $this->user['R'] == 'AIRLINE001' || $this->user['R'] == 'F1359252xx' || $this->user['R'] == 'FAC0070' || $this->user['R'] == 'FAC0074' || $this->user['R'] == 'FAC0073' || $this->user['R'] == 'FAC0075' || $this->user['R'] == 'FAC0058'){?>
                                            <a href="#" onClick="btnUpdateAccount();">Remittance Transactions</a>
                                        <?php } else {?>
                                            <a href="<?php echo BASE_URL() ?>Ecash_transactions/">Remittance Transactions</a>
                                        <?php } ?>

                                    </li>

                                    <!-- <?php echo  ($menu=='kyc_form')?'<li  class="active">':'<li  class="">' ?> -->
                                        <!-- <?php if($this->user['R'] == '1234567'|| $this->user['R'] == 'F7997947' || $this->user['R'] == 'F3053198' || $this->user['R'] == 'F3038626' || $this->user['R'] == 'F3034264' || $this->user['R'] == 'F2705239' || $this->user['R'] == 'F2895141' || $this->user['R'] == 'F8506908'){ ?> -->
                                            <!-- <a href="<?php echo BASE_URL() ?>kyc_form/">KYC Verification</a> -->
                                        <!-- <?php } ?> -->
                                    <!-- </li> -->
                                    <!-- <?php echo  ($menu=='kyc_remittance')?'<li  class="active">':'<li  class="">' ?> -->
                                        <!-- <?php if($this->user['R'] == '1234567'|| $this->user['R'] == 'F7997947' || $this->user['R'] == 'F3053198' || $this->user['R'] == 'F3038626' || $this->user['R'] == 'F3034264' || $this->user['R'] == 'F2705239' || $this->user['R'] == 'F2895141' || $this->user['R'] == 'F8506908'){ ?> -->
                                            <!-- <a href="<?php echo BASE_URL() ?>kyc_remittance/">Remittance Form</a> -->
                                        <!-- <?php } ?> -->
                                    <!-- </li> -->
                                    <?php echo  ($menu=='remittance_transactions')?'<li  class="active">':'<li  class="">' ?>
                                        <!-- <?php if($this->user['R'] == '1234567' || $this->user['R'] == 'F3038626' || ($this->user['R'] == 'F2895141' && $this->user['L'] == 7) || ($this->user['R'] == 'F8506908' && $this->user['L'] == 7)){ ?> -->
                                            <!-- <a href="<?php echo BASE_URL() ?>remittance_transactions/">Remittance Hub</a> -->
                                        <!-- <?php } ?> -->
                                    <!-- </li> -->
                                    <!-- <?php echo  ($menu=='remittance_transactions')?'<li  class="active">':'<li  class="">' ?> -->
                                        <!-- <?php if($this->user['R'] == '1234567' || $this->user['R'] == 'F3038626' || ($this->user['R'] == 'F2895141' && $this->user['L'] == 6) || ($this->user['R'] == 'F8506908' && $this->user['L'] == 6)){ ?> INSERT TSR REGCODE HERE -->
                                            <!-- <a href="<?php echo BASE_URL() ?>remittance_transactions/">Remittance Dealer</a> -->
                                        <!-- <?php } ?> -->
                                    <!-- </li> -->

                                </ul>
                            </li>
                        <?php endif ?>

                        <!-- <?php if ($retailer == 1 || $this->user['RET'] == 1 || $testaccount == 1 || $this->user['R'] == 'AIRLINE001' || $this->user['R'] == 'F1359252xx'): ?>
                            <?php echo  ($parent=='REMITTANCE')?'<li  class="parent active">':'<li  class="parent">' ?>
                            <a href="#" onClick="btnUpdateAccount();"><i class="fa fa-money"></i> <span>Remittance</span></a>
                            </li>
                        <?php endif ?> -->
                        <!-- REMITTANCE -->


                        <!-- BILLSPAYMENT -->
                        <?php if ($this->user['A_CTRL']['billspayment'] == 1 && $this->user['R'] != 'F7944049'): ?>
                            <?php echo  ($menu==4)?'<li  class="active">':'<li  class="">' ?>
                                
                                    <a href="<?php echo BASE_URL() ?>Bills_payment/">
                                        <i class="fa fa-money"></i> <span>Bills Payment</span>
                                    </a>
                        </li>
                        <?php endif ?>
                        <!-- BILLSPAYMENT -->

                        <!-- GAMING -->
                        <?php if (($this->user['A_CTRL']['billspayment'] == 1 || $retailer == 1 || $this->user['RET'] == 1) && $this->user['A_CTRL']['billspay_admin'] == 1 && $this->user['R'] != 'F7944049'): ?>
                            <?php echo  ($menu==25)?'<li  class="active">':'<li  class="">' ?>
                                <?php if($retailer == 1 || $this->user['RET'] == 1 || $this->user['R'] == 'AIRLINE001' || $this->user['R'] == 'F1359252xx'){?>
                                    <a href="#" onClick="btnUpdateAccount();">
                                        <i class="fa fa-money"></i> <span>Billspay Confirmation</span>
                                    </a>
                                <?php } else {?>
                                    <a href="<?php echo BASE_URL() ?>Billspay_admin/">
                                        <i class="fa fa-thumbs-up"></i> <span>Billspay Confirmation</span>
                                    </a>
                                <?php } ?>
                            </li>
                        <?php endif ?>
                        <!-- GAMING -->

                        <!-- LOADING -->
                        <?php if ($this->user['A_CTRL']['airtime_loading'] == 1 || $retailer == 1 || $this->user['RET'] == 1 || $testaccount == 1 && $this->user['R'] != 'F7944049' && $this->user['R'] != 'F7944049'): ?>
                            <?php if ($testaccount == 1 || $this->user['R'] == 'AIRLINE001' || $this->user['R'] == 'F1359252xx'): ?>
                                <?php echo  ($parent=='LOADING')?'<li  class="parent active">':'<li  class="parent">' ?>
                                <a href="#" onClick="btnUpdateAccount();"><i class="fa fa-mobile-phone"></i> <span>Loading</span></a>
                                </li>

                            <?php elseif ($retailer == 1 || $this->user['RET'] == 1): ?>
                                <?php echo  ($parent=='LOADING')?'<li  class="parent active">':'<li  class="parent">' ?>
                                    <a href="#"><i class="fa fa-mobile-phone"></i> <span>Loading</span></a>
                                        <ul class="children">
                                        <?php if($this->user['A_CTRL']['dom_airtime_loading'] == 1): ?>
                                            <?php echo  ($menu==5)?'<li  class="active">':'<li  class="">' ?>
                                                    <a href="<?php echo BASE_URL() ?>E_loading/">E-Loading</a>
                                            </li>
                                        <?php endif ?>
                                        </ul>
                                    </li>

                            <?php else: ?>
                                <?php echo  ($parent=='LOADING')?'<li  class="parent active">':'<li  class="parent">' ?>
                                    <a href="#"><i class="fa fa-mobile-phone"></i> <span>Loading</span></a>
                                        <ul class="children">
                                        <?php if($this->user['A_CTRL']['dom_airtime_loading'] == 1): ?>
                                            <?php echo  ($menu==5)?'<li  class="active">':'<li  class="">' ?>
                                                    <a href="<?php echo BASE_URL() ?>E_loading/">E-Loading</a>
                                            </li>
                                        <?php endif ?>
                                        <?php if($this->user['A_CTRL']['intl_airtime_loading'] == 1): ?>
                                             <?php echo  ($menu==6)?'<li  class="active">':'<li  class="">' ?>
                                                    <a href="<?php echo BASE_URL() ?>International_loading/">International</a>
                                             </li>
                                        <?php endif ?>
                                        <!-- TEST USER F1526245 F1359252 F9687521 F8901916 -->
                                        <?php if($this->user['R'] == '1234567'): ?>
                                            <?php echo  ($menu=='buy_load')?'<li  class="active">':'<li  class="">' ?>
                                                <a href="<?php echo BASE_URL() ?>Buy_load/">Buy Load</a>
                                            </li>
                                        <?php endif ?>
                                        </ul>
                                    </li>
                            <?php endif ?>
                        <?php endif ?>
                        <!-- LOADING -->

                        <!-- PORTFOLIO -->
                        <?php if($this->user['R'] != 'F7944049'): ?>                    
                            <?php echo ($parent=='PORTFOLIO')?'<li class="parent active">':'<li class="parent">' ?>
                            <a href="#"><i class="fa fa-money"></i> <span>Portfolio</span></a>
                                <ul class="children">
                                    <?php echo ($menu==1)?'<li class="active">':'<li class="">' ?>
                                        <!-- U-Credit -->
                                        <?php if (($this->user['A_CTRL']['emergency_ecash_loan'] == 1 && $retailer != 1 && ($this->user['L']!='13' && $this->user['L']!='5'))): ?>
                                            <?php echo  ($parent=='ECASHLOAN')?'<li  class="active">':'<li>'; ?>
                                            <!-- <a id="ecl_lp" href="<?php echo ($user['QLS']['S']!=0)? BASE_URL()."Ecashloan":'#'; ?>"  <?php echo ($user['QLS']['S']==0)? 'onClick="ecashloanApp.notEligible()"':''; ?>><i class="fa fa-money"></i> <span>Emergency Fund</span></a> -->
                                            <a id="ecl_lp" href="<?php echo BASE_URL()."Ecashloan"; ?>"  <?php echo 'onClick="ecashloanApp.notEligible()"'; ?>><span>U-Credit</span></a>
                                            </li>
                                        <?php endif ?>
                                        <!-- U-Credit -->
                                    </li>
                                    <?php echo ($menu==2)?'<li class="active">':'<li class="">' ?>
                                        <!-- U-Save -->
                                        <?php echo ($menu == 22) ? '<li class="active">' : '<li class="">' ?>
                                            <a href="<?php echo BASE_URL() ?>Investment/">
                                                <span>U-Save</span>
                                            </a>
                                        </li>
                                        <!-- U-Save -->
                                    </li>
                                    <?php echo ($menu==3)?'<li class="active">':'<li class="">' ?>
                                        <!-- U-Loan -->
                                        <?php echo ($menu == 23) ? '<li class="active">' : '<li class="">' ?>
                                            <a href="#" style="pointer-events:none;">
                                                <span>U-Loan</span>
                                            </a>
                                        </li>
                                        <!-- U-Loan -->
                                    </li>
                                    <?php echo ($menu==4)?'<li class="active">':'<li class="">' ?>
                                        <!-- Phillands -->
                                        <?php echo ($menu == 24) ? '<li class="active">' : '<li class="">' ?>
                                        <a href="<?php echo BASE_URL() ?>Phillands/">
                                                <span>Phillands</span>
                                            </a>
                                        </li>
                                        <!-- Phillands -->
                                    </li>
                                </ul>
                            </li>
                        <?php endif ?>

                        <!-- PORTFOLIO -->
                        
                        <!-- FUND TRANSFER -->

                         
                        <!-- FUND TRANSFER -->
                        <?php if ($this->user['R'] != "1234567xx" && $this->user['R'] != 'BDO00001' && $this->user['R'] != 'HK0002' && $this->user['R'] != 'F7944049'): ?>  
                          <?php if ($this->user['A_CTRL']['fundrequest'] == 1 || $this->user['A_CTRL']['fund_request'] == 1): ?>
                            <?php echo  ($menu==7)?'<li  class="active">':'<li class="">' ?>
                                    <?php if($retailer == 11 || $this->user['RET'] == 11 || $testaccount == 11 || $this->user['R'] == 'AIRLINE001' || $this->user['R'] == 'F1359252xx'){?>
                                        <a href="#" onClick="btnUpdateAccount();">
                                            <i class="fa fa-credit-card"></i> <span>- Fund Transfer</span>
                                        </a>
                                    <?php } else {?>
                                        <a href="<?php echo BASE_URL() ?>Fundtransfer/">
                                           <i class="fa fa-credit-card"></i> <span>Fund-Transfer</span>
                                        </a>
                                    <?php } ?>
                             </li> 
                          <?php endif ?>
                        <?php endif ?>   
                        <!-- FUND TRANSFER -->
                        
                        <!-- FUND TRANSFER -->
                        <?php if ($this->user['R'] == "HK0002" || $this->user['R'] == "1234567s" || $this->user['R'] == "ITC0s001" && $this->user['R'] != 'F7944049'): ?>
                            <?php echo  ($menu==7)?'<li  class="active">':'<li class="">' ?>
                                    
                                        <a href="<?php echo BASE_URL() ?>Fundtransfer/hkd_fund">
                                           <i class="fa fa-credit-card"></i> <span>Fund_Transfer</span>
                                        </a>
                                    
                             </li> 
                        <?php endif ?>   
                        <!-- FUND TRANSFER -->
                

                         <!-- FUND TRANSFER -->
                        <?php if ($this->user['A_CTRL']['fundrequest'] != 1 && $this->user['R'] == 'BDO00001' && $this->user['R'] != 'F7944049'): ?>

                            <?php if ($this->user['R'] == 'BDO00001'): ?>
                                <?php echo  ($parent=='BILLSPAYMENT')?'<li  class="parent active">':'<li  class="parent">' ?>
                                    <a href="#" onClick="btnUpdateAccount();"><i class="fa fa-money"></i> <span>Billspayment</span></a>
                                </li>
                            <?php endif ?>  

                            <?php if ($this->user['R'] == 'BDO00001'): ?>
                                <?php echo  ($parent=='REMITTANCE')?'<li  class="parent active">':'<li  class="parent">' ?>
                                    <a href="#" onClick="btnUpdateAccount();"><i class="fa fa-money"></i> <span>Remittance</span></a>
                                </li>
                            <?php endif ?>  

                            <?php if ($this->user['R'] == 'BDO00001'): ?>
                                <?php echo  ($parent=='LOADING')?'<li  class="parent active">':'<li  class="parent">' ?>
                                    <a href="#" onClick="btnUpdateAccount();"><i class="fa fa-mobile-phone"></i> <span>Loading</span></a>
                                </li>
                            <?php endif ?>  

                            <?php echo  ($menu==7)?'<li  class="active">':'<li class="">' ?>
                                    <?php if($this->user['R'] == 'BDO00001'){?>
                                        <a href="#" onClick="btnUpdateAccount();">
                                            <i class="fa fa-credit-card"></i> <span>Fund Transfer</span>
                                        </a>
                                    <?php } ?>
                             </li> 
                        <?php endif ?>  
                         <!-- FUND TRANSFER -->


                        <!--ONLINE BOOKING -->
 
                         <?php if ($this->user['A_CTRL']['online_booking'] == 1 && $retailer != 1 && $this->user['RET'] != 1): ?>
                            <?php echo  ($parent=='DOMESTIC_FLIGHTS' || $parent=='ABACUS')?'<li  class="parent active">':'<li  class="parent">' ?>
                            <a href="#"><i class="fa fa-plane"></i> <span>Online Booking</span></a>
                                <ul class="children">
                                     

                                    <?php if($this->user['R'] == 'ITC0001'){?>
                                        <?php echo  ($menu==9)?'<li  class="active">':'<li  class="">' ?>
                                        
                                            <a href="<?php echo BASE_URL() ?>Merged_intl_flights_new/book_international_flights">Amadeus International Flights</a>
                                        
                                        </li>

                                    <?php } elseif($this->user['R'] == 'BDO00001'){?>
                                        <?php if($this->user['A_CTRL']['dom_booking'] == 1 && $retailer != 1 && $this->user['RET'] != 1){?>
                                            <?php echo  ($menu==8 || $menu=='dom')?'<li  class="active">':'<li  class="">' ?>
                                                
                                                    <a href="<?php echo BASE_URL() ?>Merged_ticketing_flights">Domestic Flights</a>
             
                                             </li>
                                        <?php }?>

                                    <?php } else { ?>

                                        <?php if($this->user['A_CTRL']['dom_booking'] == 1 && $retailer != 1 && $this->user['RET'] != 1){?>
                                        <?php echo  ($menu==8 || $menu=='dom')?'<li  class="active">':'<li  class="">' ?>
                                            
                                                <a href="<?php echo BASE_URL() ?>Merged_ticketing">Domestic Flights</a>
         
                                         </li>
                                         <?php }?>
                                         
                                        <?php if($this->user['A_CTRL']['intl_booking'] == 1 && $retailer != 1 && $this->user['RET'] != 1){?>
                                        <?php echo  ($menu==9)?'<li  class="active">':'<li  class="">' ?>
                    
                                                <a href="<?php echo BASE_URL() ?>Merged_intl_flights/">International Flights</a>
                                         </li>
                                         <?php }?>
                                    <?php } ?>

<!--                                       <?php echo  ($menu==10)?'<li  class="active">':'<li  class="">' ?>
                                      <a href="#">Hotel Reservation</a>
                                     </li> 
-->
                                </ul>
                            </li>
                        <?php endif ?>

                        <?php if ($retailer == 1 || $this->user['RET'] == 1): ?>
                            <?php echo  ($parent=='DOMESTIC_FLIGHTS')?'<li  class="parent active">':'<li  class="parent">' ?>
                            <a href="#" onClick="btnUpdateAccount();"><i class="fa fa-plane"></i> <span>Online Booking</span></a>
                            </li>
                        <?php endif ?>
                        <!--ONLINE BOOKING-->

                        <!-- HOTELS -->                       
                        <?php if ($retailer == 1 || $testaccount == 1 || $this->user['RET'] == 1 || $this->user['R'] == 'AIRLINE001' || $this->user['R'] == 'F1359252xx' && $this->user['R'] != 'F7944049') { 
                                    echo  ($parent=='HOTELS')?'<li  class="active">':'<li>';
                                    echo '<a href="#" onClick="btnUpdateAccount();"><i class="fa fa-building"></i> <span>Hotels</span></a>';
                                    echo "</li>";
                        } else {
                            if ($this->user['A_CTRL']['hotel_reservation'] == 1 && $this->user['R'] != 'F7944049') {
                                // comment after test9df'h/'g/''.bnfgn
                                $value = ($this->user['hotel_reservation'] == 0) ? "href='javaScript:void(0)' id='availHotelReservation'":"href='".BASE_URL()."Hotels'";
                                if ($this->user['L'] != 7 && $this->user['R'] != "F5597768"){
                                    echo  ($parent=='HOTELS')?'<li  class="active">':'<li>';
                                    echo '<a '.$value.'><i class="fa fa-building"></i> <span>Hotels</span></a>';
                                    echo "</li>";
                                } else {
                                    echo  ($parent=='HOTELS')?'<li  class="active">':'<li>';
                                    echo '<a href='.BASE_URL().'Hotels ><i class="fa fa-building"></i> <span>Hotels</span></a>';
                                    echo "</li>";
                                }                                      
                            }else if ($this->user['A_CTRL']['hotel_reservation'] == 3) {
                                    echo  ($parent=='HOTELS')?'<li  class="active">':'<li>';
                                    echo "<a href='#' onclick='alert(\"Hotel Booking is currently Unavailable.\")'><i class='fa fa-building'></i> <span>Hotels</span></a>";
                                    echo "</li>";                                
                            }
                        }
                            ?>
                        <!-- HOTELS -->

                        <!-- SHIPPING -->
                        <?php if($this->user['R'] != 'BDO00001' && $this->user['R'] != 'F7944049') { ?>
                             <?php 
                               
                                           //if(($this->user['A_CTRL']['online_shipping'] == 1 || $retailer == 1 || $this->user['RET'] == 1) && $this->user['CG'] == 'UPS' && $this->user['R'] != 'AIRLINE001' && $this->user['R'] != 'F1359252xx' || $this->user['CG'] == 'GPRS' || $this->user['CG'] == 'FAC' || $this->user['R'] != '1234567'){
                                            if($this->user['A_CTRL']['online_shipping'] == 1){
                                            echo  ($parent=='SHIPPING')?'<li  class="active">':'<li>';
                                            echo '<a href='.BASE_URL().'Shipping ><i class="fa fa-ship"></i> <span>Shipping</span></a>';
                                            echo "</li>";
                                           }
                                                
                                    
                                
                        ?>
                        <?php } ?>
                        <!-- SHIPPING -->

                         <!-- ONLINE SHOP -->
                        <?php if (($this->user['A_CTRL']['online_shop'] == 1 || $retailer == 1 || $this->user['RET'] == 1) && $this->user['CG'] == 'UPS' && $this->user['R'] != 'AIRLINE001' && $this->user['R'] != 'F1359252xx' && $this->user['R'] != 'F7944049'): ?>
                       <?php echo  ($menu==11)?'<li  class="active">':'<li class="">' ?>
                                
                                    <a href="<?php echo BASE_URL() ?>Onlineshop/">
                                       <i class="fa fa-shopping-cart"></i> <span>Online Shop</span>
                                    </a>
                               
                         </li> 
                         <?php endif ?>

                        <!--ONLINE SHOP-->

                        <!-- E-INSURANCE //added by nhez -->
                            <?php echo  ($parent=='E-INSURANCE')?'<li  class="parent active">':'<li class="parent">' ?>
                                    <a href="<?php echo BASE_URL() ?>Einsurance/">
                                       <i class="fa fa-user fa-fw"></i> <span>E-Insurance</span>
                                    </a>

                                    <ul class="children">
                                        <?php echo  ($instype=='PA')?'<li  class="active">':'<li  class="">' ?>
                                                <a href="<?php echo BASE_URL() ?>Einsurance?type=PA">Personal Accident Insurance</a>
                                         </li>
                                         <?php if ($this->user['R'] == '1234567'): ?>
                                        <?php echo  ($instype=='CTPL')?'<li  class="active">':'<li  class="">' ?>
                                                <a href="<?php echo BASE_URL() ?>Einsurance?type=CTPL">Compulsory Third Party Liability Insurance</a>
                                         </li>
                                         <?php endif ?>

                                         <?php if ($this->user['R'] == '1234567'): ?>
                                            <?php echo  ($instype=='PH')?'<li  class="active">':'<li  class="">' ?>
                                                <a href="<?php echo BASE_URL() ?>Einsurance?type=PH">Prepaid Health</a>
                                            </li> 
                                        <?php endif ?>
                                    </ul>
                             </li>
                         <!-- E-INSURANCE -->

                        <!-- NETWORKING -->
                          <?php if ($this->user['CG'] =="UPS" && $this->user['R'] != 'AIRLINE001' && $this->user['R'] != 'F1359252xx' || $this->user['R'] != 'F7944049'){ ?>
                             <?php if ($this->user['A_CTRL']['networking'] == 1 || $retailer == 1 || $this->user['RET'] == 1): ?>
                                <?php echo  ($menu==13)?'<li class="active">':'<li class="">' ?>
                                <?php if($retailer == 1 || $this->user['RET'] == 1){?>
                                    <a href="#" onClick="btnUpdateAccount();">
                                        <i class="fa fa-users"></i> <span>Network</span>
                                    </a>
                                <?php } else {?>
                                 <a href="<?php echo BASE_URL() ?>Network/">
                                    <i class="fa fa-users"></i> <span>Network</span>
                                 </a>
                                <?php } ?>
                                 </li>
                                <?php endif ?> 
                             <?php } ?> 
                        <!-- NETWORKING -->


                        <!-- REPORTS -->

                            <?php if($this->user['R'] != 'BDO00001') { ?>
                                <?php echo  ($menu==14)?'<li class="active">':'<li class="">' ?>
                                    <a href="<?php echo BASE_URL() ?>Report/">
                                        <i class="fa fa-file"></i> <span>Reports</span>
                                    </a>
                                </li>
                            <?php } ?>
                         <!-- REPORTS -->

                         <!-- MLM -->
                         <?php if (($this->user['A_CTRL']['mlm_inventory'] == 1 || $this->user['L'] == 7) && $retailer != 1 && $this->user['RET'] != 1): ?>
                          <?php echo  ($menu==18)?'<li class="active">':'<li class="">' ?>
                                 <a href="<?php echo BASE_URL() ?>Mlm/">
                                    <i class="fa fa-briefcase"></i> <span>MLM Admin</span>
                                 </a>
                          </li>
                         <?php endif ?>

                        <?php if ($this->user['A_CTRL']['mlm_inventory'] == 1 || $this->user['L'] == 7){ $selling_title =  'MLM Product Distribution';}else{ $selling_title =  'MLM Product Selling';} ?>
                         
                
                        <?php if ($this->user['A_CTRL']['mlm_selling'] != 0): ?>
                         <?php echo  ($menu==19)?'<li class="active">':'<li class="">' ?>
                         <a href="<?php echo BASE_URL() ?>Products/">
                            <i class="fa fa-shopping-cart"></i> <span><?php echo $selling_title; ?></span>
                         </a>
                         </li>  
                         <?php endif ?>
                         <!-- MLM -->    

                         <!-- Account Settlement -->
                        <?php if ($this->user['A_CTRL']['account_settlements'] == 1 && $retailer != 1 && $this->user['RET'] != 1 && $this->user['CG'] == 'UPS' && $this->user['R'] != 'AIRLINE001' && $this->user['R'] != 'F1359252xx'): ?>
                          <?php echo  ($menu==20)?'<li class="active">':'<li class="">' ?>
                                 <a href="<?php echo BASE_URL() ?>Account_Settlement/">
                                    <i class="fa fa-exclamation"></i> <span>Account Settlements</span>
                                 </a>
                          </li>
                         <?php endif ?>

                        <!-- Account Link -->
                        <?php if ($this->user['A_CTRL']['account_link'] == 1 && $retailer != 1 && $this->user['RET'] != 1 && $this->user['CG'] == 'UPS' && $this->user['R'] != 'AIRLINE001' && $this->user['R'] != 'F1359252xx'): ?>
                          <?php echo  ($menu==21)?'<li class="active">':'<li class="">' ?>
                                 <a href="<?php echo BASE_URL() ?>Link_Account/">
                                    <i class="fa fa-link"></i> <span>Link Account</span>
                                 </a>
                          </li>
                         <?php endif ?>

                    <?php else: ?>
                        <!-- FUND TRANSFER -->
                        <?php if ($this->user['R'] != "1234567xx" && $this->user['R'] != 'BDO00001' && $this->user['R'] != 'HK0002'): ?>  
                          <?php if ($this->user['A_CTRL']['fundrequest'] == 1 || $this->user['A_CTRL']['fund_request'] == 1): ?>
                            <?php echo  ($menu==7)?'<li  class="active">':'<li class="">' ?>
                                    <?php if($retailer == 11 || $this->user['RET'] == 11 || $testaccount == 11 || $this->user['R'] == 'AIRLINE001' || $this->user['R'] == 'F1359252xx'){?>
                                        <a href="#" onClick="btnUpdateAccount();">
                                            <i class="fa fa-credit-card"></i> <span>- Fund Transfer</span>
                                        </a>
                                    <?php } else {?>
                                        <a href="<?php echo BASE_URL() ?>Fundtransfer/">
                                           <i class="fa fa-credit-card"></i> <span>Fund-Transfer</span>
                                        </a>
                                    <?php } ?>
                             </li> 
                          <?php endif ?>
                        <?php endif ?>   
                        <!-- FUND TRANSFER -->
                        
                        <!-- FUND TRANSFER -->
                        <?php if ($this->user['R'] == "HK0002" || $this->user['R'] == "1234567s" || $this->user['R'] == "ITC0s001"): ?>
                            <?php echo  ($menu==7)?'<li  class="active">':'<li class="">' ?>
                                    
                                        <a href="<?php echo BASE_URL() ?>Fundtransfer/hkd_fund">
                                           <i class="fa fa-credit-card"></i> <span>Fund_Transfer</span>
                                        </a>
                                    
                             </li> 
                        <?php endif ?>   
                        <!-- FUND TRANSFER -->
                

                         <!-- FUND TRANSFER -->
                        <?php if ($this->user['A_CTRL']['fundrequest'] != 1 && $this->user['R'] == 'BDO00001'): ?>

                            <?php if ($this->user['R'] == 'BDO00001'): ?>
                                <?php echo  ($parent=='BILLSPAYMENT')?'<li  class="parent active">':'<li  class="parent">' ?>
                                    <a href="#" onClick="btnUpdateAccount();"><i class="fa fa-money"></i> <span>Billspayment</span></a>
                                </li>
                            <?php endif ?>  

                            <?php if ($this->user['R'] == 'BDO00001'): ?>
                                <?php echo  ($parent=='REMITTANCE')?'<li  class="parent active">':'<li  class="parent">' ?>
                                    <a href="#" onClick="btnUpdateAccount();"><i class="fa fa-money"></i> <span>Remittance</span></a>
                                </li>
                            <?php endif ?>  

                            <?php if ($this->user['R'] == 'BDO00001'): ?>
                                <?php echo  ($parent=='LOADING')?'<li  class="parent active">':'<li  class="parent">' ?>
                                    <a href="#" onClick="btnUpdateAccount();"><i class="fa fa-mobile-phone"></i> <span>Loading</span></a>
                                </li>
                            <?php endif ?>  

                            <?php echo  ($menu==7)?'<li  class="active">':'<li class="">' ?>
                                    <?php if($this->user['R'] == 'BDO00001'){?>
                                        <a href="#" onClick="btnUpdateAccount();">
                                            <i class="fa fa-credit-card"></i> <span>Fund Transfer</span>
                                        </a>
                                    <?php } ?>
                             </li> 
                        <?php endif ?>  
                         <!-- FUND TRANSFER -->
                         
                        <!-- LOADING -->
                        <?php if ($this->user['A_CTRL']['airtime_loading'] == 1 || $retailer == 1 || $this->user['RET'] == 1 || $testaccount == 1): ?>
                            <?php if ($testaccount == 1 || $this->user['R'] == 'AIRLINE001' || $this->user['R'] == 'F1359252xx'): ?>
                                <?php echo  ($parent=='LOADING')?'<li  class="parent active">':'<li  class="parent">' ?>
                                <a href="#" onClick="btnUpdateAccount();"><i class="fa fa-mobile-phone"></i> <span>Loading</span></a>
                                </li>

                            <?php elseif ($retailer == 1 || $this->user['RET'] == 1): ?>
                                <?php echo  ($parent=='LOADING')?'<li  class="parent active">':'<li  class="parent">' ?>
                                    <a href="#"><i class="fa fa-mobile-phone"></i> <span>Loading</span></a>
                                        <ul class="children">
                                        <?php if($this->user['A_CTRL']['dom_airtime_loading'] == 1): ?>
                                            <?php echo  ($menu==5)?'<li  class="active">':'<li  class="">' ?>
                                                    <a href="<?php echo BASE_URL() ?>E_loading/">E-Loading</a>
                                            </li>
                                        <?php endif ?>
                                        </ul>
                                    </li>

                            <?php else: ?>
                                <?php echo  ($parent=='LOADING')?'<li  class="parent active">':'<li  class="parent">' ?>
                                    <a href="#"><i class="fa fa-mobile-phone"></i> <span>Loading</span></a>
                                        <ul class="children">
                                        <?php if($this->user['A_CTRL']['dom_airtime_loading'] == 1): ?>
                                            <?php echo  ($menu==5)?'<li  class="active">':'<li  class="">' ?>
                                                    <a href="<?php echo BASE_URL() ?>E_loading/">E-Loading</a>
                                            </li>
                                        <?php endif ?>
                                        <?php if($this->user['A_CTRL']['intl_airtime_loading'] == 1): ?>
                                             <?php echo  ($menu==6)?'<li  class="active">':'<li  class="">' ?>
                                                    <a href="<?php echo BASE_URL() ?>International_loading/">International</a>
                                             </li>
                                        <?php endif ?>

                                        <?php if(in_array($this->user['R'], $filter)): ?>
                                            <?php echo  ($menu=='buy_load')?'<li  class="active">':'<li  class="">' ?>
                                                <a href="<?php echo BASE_URL() ?>Buy_load/">Buy Load</a>
                                            </li>
                                        <?php endif?>
                                        </ul>
                                    </li>
                            <?php endif ?>
                          <?php endif ?>
                        <!-- LOADING -->

                        <!-- REMITTANCE -->
                        <?php if ($retailer == 1 || ($this->user['A_CTRL']['remittance'] == 1  && $this->user['R'] != 'G5457340' && $this->user['R'] != 'AIRLINE001' && $this->user['R'] != 'F1359252xx')): ?>
                            <?php echo  ($parent=='REMITTANCE')?'<li  class="parent active">':'<li  class="parent">' ?>
                            <a href="#"><i class="fa fa-money"></i> <span>Remittance</span></a>
                                <ul class="children">
                                     <?php echo  ($menu==2)?'<li  class="active">':'<li  class="">' ?>
                                        <?php if(($retailer != 1 && $this->user['RET'] != 1 && $testaccount != 1) && $this->user['R'] == 'AIRLINE001' || $this->user['R'] == 'F1359252xx'){?>
                                            <a href="#" onClick="btnUpdateAccount();">E-Cash Send</a>
                                            <?php } else {
                                                $script='onClick="ecashloanApp.statusAlert()"';
                                                if($retailer == 1)$script='';
                                            ?>
                                            <a href="<?php echo BASE_URL() ?>Ecash_send/" <?php echo $script?> >E-Cash Send</a>
                                        <?php } ?>
                                     </li>
                                     <?php echo  ($menu==3)?'<li  class="active">':'<li  class="">' ?>
                                        <?php if($retailer == 1 || $this->user['RET'] == 1 || $testaccount == 1 || $this->user['R'] == 'AIRLINE001' || $this->user['R'] == 'F1359252xx' || $this->user['R'] == 'FAC0070' || $this->user['R'] == 'FAC0074' || $this->user['R'] == 'FAC0073' || $this->user['R'] == 'FAC0075' || $this->user['R'] == 'FAC0058' ){?>
                                            <a href="#" onClick="btnUpdateAccount();">E-Cash Payout</a>
                                        <?php } else {?>
                                            <a href="<?php echo BASE_URL() ?>Ecash_payout/">E-Cash Payout</a>
                                        <?php } ?>
                                    </li>
                                </ul>
                            </li>
                        <?php endif ?>

                        <!-- <?php if ($retailer == 1 || $this->user['RET'] == 1 || $testaccount == 1 || $this->user['R'] == 'AIRLINE001' || $this->user['R'] == 'F1359252xx'): ?>
                            <?php echo  ($parent=='REMITTANCE')?'<li  class="parent active">':'<li  class="parent">' ?>
                            <a href="#" onClick="btnUpdateAccount();"><i class="fa fa-money"></i> <span>Remittance</span></a>
                            </li>
                        <?php endif ?> -->
                        <!-- REMITTANCE -->

                        <!-- BILLSPAYMENT -->
                        <?php if ($this->user['A_CTRL']['billspayment'] == 1): ?>
                            <?php echo  ($menu==4)?'<li  class="active">':'<li  class="">' ?>
                                
                                    <a href="<?php echo BASE_URL() ?>Bills_payment/">
                                        <i class="fa fa-money"></i> <span>Bills Payment</span>
                                    </a>
                        </li>
                        <?php endif ?>
                        <!-- BILLSPAYMENT -->

                        <!-- E-INSURANCE //added by nhez -->
                        <?php if ($this->user['A_CTRL']['insurance'] == 1 || $retailer == 1 || $this->user['RET'] == 1 || $testaccount == 1): ?>
                            <?php echo  ($parent=='E-INSURANCE')?'<li  class="parent active">':'<li class="parent">' ?>
                                <?php if($retailer == 1 || $this->user['RET'] == 1 || $testaccount == 1 || $this->user['R'] == 'AIRLINE001' || $this->user['R'] == 'F1359252xx'){?>
                                    <!-- <a href="#" onClick="btnUpdateAccount();">
                                        <i class="fa fa-user fa-fw"></i> <span>E-Insurance</span>
                                    </a> -->
                                <?php } else {?>
                                    <a href="<?php echo BASE_URL() ?>Einsurance/">
                                       <i class="fa fa-user fa-fw"></i> <span>E-Insurance</span>
                                    </a>

                                    <ul class="children">
                                        <?php echo  ($instype=='PA')?'<li  class="active">':'<li  class="">' ?>
                                                <a href="<?php echo BASE_URL() ?>Einsurance?type=PA">Personal Accident Insurance</a>
                                         </li>
                                        <?php echo  ($instype=='CTPL')?'<li  class="active">':'<li  class="">' ?>
                                                <a href="<?php echo BASE_URL() ?>Einsurance?type=CTPL">Compulsory Third Party Liability Insurance</a>
                                         </li>

                                         <?php if ($this->user['R'] == '1234567'): ?>
                                            <?php echo  ($instype=='PH')?'<li  class="active">':'<li  class="">' ?>
                                                <a href="<?php echo BASE_URL() ?>Einsurance?type=PH">Prepaid Health</a>
                                            </li> 
                                        <?php endif ?>
                                    </ul>    
                                <?php } ?>
                             </li> 
                        <?php endif ?>   
                         <!-- E-INSURANCE -->

                         <!--ONLINE BOOKING -->
 
                         <?php if ($this->user['A_CTRL']['online_booking'] == 1 && $retailer != 1 && $this->user['RET'] != 1): ?>
                            <?php echo  ($parent=='DOMESTIC_FLIGHTS' || $parent=='ABACUS')?'<li  class="parent active">':'<li  class="parent">' ?>
                            <a href="#"><i class="fa fa-plane"></i> <span>Online Booking</span></a>
                                <ul class="children">
                                     

                                    <?php if($this->user['R'] == 'ITC0001'){?>
                                        <?php echo  ($menu==9)?'<li  class="active">':'<li  class="">' ?>
                                        
                                            <a href="<?php echo BASE_URL() ?>Merged_intl_flights_new/book_international_flights">Amadeus International Flights</a>
                                        
                                        </li>

                                    <?php } elseif($this->user['R'] == 'BDO00001'){?>
                                        <?php if($this->user['A_CTRL']['dom_booking'] == 1 && $retailer != 1 && $this->user['RET'] != 1){?>
                                            <?php echo  ($menu==8 || $menu=='dom')?'<li  class="active">':'<li  class="">' ?>
                                                
                                                    <a href="<?php echo BASE_URL() ?>Merged_ticketing_flights">Domestic Flights</a>
             
                                             </li>
                                        <?php }?>

                                    <?php } else { ?>

                                        <?php if($this->user['A_CTRL']['dom_booking'] == 1 && $retailer != 1 && $this->user['RET'] != 1){?>
                                        <?php echo  ($menu==8 || $menu=='dom')?'<li  class="active">':'<li  class="">' ?>
                                            
                                                <a href="<?php echo BASE_URL() ?>Merged_ticketing">Domestic Flights</a>
         
                                         </li>
                                         <?php }?>
                                         
                                        <?php if($this->user['A_CTRL']['intl_booking'] == 1 && $retailer != 1 && $this->user['RET'] != 1){?>
                                        <?php echo  ($menu==9)?'<li  class="active">':'<li  class="">' ?>
                    
                                                <a href="<?php echo BASE_URL() ?>Merged_intl_flights/">International Flights</a>
                                         </li>
                                         <?php }?>
                                    <?php } ?>

<!--                                       <?php echo  ($menu==10)?'<li  class="active">':'<li  class="">' ?>
                                      <a href="#">Hotel Reservation</a>
                                     </li> 
-->
                                </ul>
                            </li>
                        <?php endif ?>

                        <?php if ($retailer == 1 || $this->user['RET'] == 1): ?>
                            <?php echo  ($parent=='DOMESTIC_FLIGHTS')?'<li  class="parent active">':'<li  class="parent">' ?>
                            <a href="#" onClick="btnUpdateAccount();"><i class="fa fa-plane"></i> <span>Online Booking</span></a>
                            </li>
                        <?php endif ?>
                        <!--ONLINE BOOKING-->

                        <!-- NETWORKING -->
                        <?php if ($this->user['CG'] =="UPS" && $this->user['R'] != 'AIRLINE001' && $this->user['R'] != 'F1359252xx'){ ?>
                             <?php if ($this->user['A_CTRL']['networking'] == 1 || $retailer == 1 || $this->user['RET'] == 1): ?>
                                <?php echo  ($menu==13)?'<li class="active">':'<li class="">' ?>
                                <?php if($retailer == 1 || $this->user['RET'] == 1){?>
                                    <a href="#" onClick="btnUpdateAccount();">
                                        <i class="fa fa-users"></i> <span>Network</span>
                                    </a>
                                <?php } else {?>
                                 <a href="<?php echo BASE_URL() ?>Network/">
                                    <i class="fa fa-users"></i> <span>Network</span>
                                 </a>
                                <?php } ?>
                                 </li>
                                <?php endif ?> 
                             <?php } ?> 
                        <!-- NETWORKING -->


                        <!-- REPORTS -->

                            <?php if($this->user['R'] != 'BDO00001') { ?>
                                <?php echo  ($menu==14)?'<li class="active">':'<li class="">' ?>
                                    <a href="<?php echo BASE_URL() ?>Report/">
                                        <i class="fa fa-file"></i> <span>Reports</span>
                                    </a>
                                </li>
                            <?php } ?>
                         <!-- REPORTS -->
                    <?php endif ?>

                    </ul>
                        <br>
                        <?php if ($this->user['R'] != 'AIRLINE001' && $this->user['R'] != 'F1359252xx'): ?>
                        <center>
                            <?php 
                                if($this->user['CG'] =="UPS")
                                    echo'<a href="https://support.unified.ph" target="UPS Support"><b class="text-danger"><i class="fa fa-commenting-o" aria-hidden="true"></i>&nbsp;Online Support</b></a>';
                                else 
                                    echo'<a href="https://support.globalpinoyremittance.com" target="UPS Support"><b class="text-danger"><i class="fa fa-commenting-o" aria-hidden="true"></i>&nbsp;Online Support</b></a>';
                            ?> 
                        </center>
                        
                        <!-- <center><a href="https://mobilereports.globalpinoyremittance.com/assets/update/AppInstaller_v1.15.6.exe">
                            <span class="glyphicon glyphicon-circle-arrow-down"></span>&nbsp;<i>Download Desktop_Installer</i>
                        </a></center> -->

                        <!-- <center><a href="https://mobilereports.globalpinoyremittance.com/assets/mobile_apk/unified-offline-1.3.apk">
                            <span class="glyphicon glyphicon-circle-arrow-down"></span>&nbsp;<i>Download Unified Offline APK</i>
                        </a></center> -->
                        
                        <?php endif ?>
                        <br>
                    
                </div><!-- leftpanel -->