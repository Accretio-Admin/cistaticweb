<div class="mainpanel">
  <div class="pageheader">
    <div class="media">
      <div class="pageicon pull-left">
        <i class="fa fa-mobile-phone"></i>
      </div>
      
      <div class="media-body">
        <ul class="breadcrumb">
          <li>
            <a href="<?php echo BASE_URL('/Main')?>">
              <i class="glyphicon glyphicon-home"></i>
            </a>
          </li>

          <li>E-INSURANCE</li>
        </ul>

        <?php if ($instype == 'PA'): ?>
          <h4>
            PERSONAL ACCIDENT INSURANCE
          </h4>
        <?php elseif ($instype == 'CTPL'): ?>
          <h4>
            COMPULSORY THIRD PARTY INSURANCE
          </h4>
        <?php else:?>
          <h4>
            PREPAID HEALTH
          </h4>
        <?php endif ?>
      </div>
    </div>
  </div>

  <div class="contentpanel">
    <div class="row row-stat">
      <div class="col-sm-9 col-md-9">
        <div class="tab-content nopadding noborder">
          <div class="tab-pane active" id="activities">
            <div class="follower-list">  
              <div class="col-sm-12">
                <?php if($instype == 'PA'): ?>
                  <div class="row media-manager">
                    <div class="col-xs-6 col-sm-4 col-md-4 document">
                      <div class="thmb" >
                        <div class="thmb-prev  text-center">
                          <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Einsurance/malayan_insurance" class="" id="aloading">
                            <img  src="<?php echo BASE_URL() ?>assets/images/billspayment/insurance_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                          </a>
                        </div>
                        <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Einsurance/malayan_insurance" id="aloading">MALAYAN</a></h5>
                      </div>
                    </div> 

                    
                    <?php if($this->user['R'] == '12345678'):?>
                    <div class="col-xs-6 col-sm-4 col-md-4 document">
                      <div class="thmb" >
                        <div class="thmb-prev  text-center">
                          <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Einsurance/federal_insurance" class="" id="aloading">
                            <img  src="<?php echo BASE_URL() ?>assets/images/billspayment/insurance_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                          </a>
                        </div>
                        
                        <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Einsurance/federal_insurance" id="aloading">FPG</a></h5>
                      </div>
                    </div>
                    <?php endif ?>

                    
                      <div class="col-xs-6 col-sm-4 col-md-4 document">
                        <div class="thmb" >
                          <div class="thmb-prev  text-center">
                            <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Einsurance/federal_insurance_v2" class="" id="aloading">
                              <img  src="<?php echo BASE_URL() ?>assets/images/billspayment/insurance_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                            </a>
                          </div>

                          <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Einsurance/federal_insurance_v2" id="aloading">FPG</a></h5>
                        </div>
                      </div>
                  </div>
                <?php elseif ($instype == 'CTPL'): ?>
                  <div class="row media-manager">
                    <div class="col-xs-6 col-sm-4 col-md-4 document">
                      <div class="thmb" >
                        <div class="thmb-prev  text-center">
                          <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Einsurance/ctpl_insurance" class="" id="aloading">
                              <img  src="<?php echo BASE_URL() ?>assets/images/billspayment/insurance_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                          </a>
                        </div>
                        <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Einsurance/ctpl_insurance" id="aloading">Get a Free Quote Now</a></h5>
                      </div>
                    </div>   
                  </div>
                <?php else: ?>
                  <div class="row media-manager">
                    <div class="col-xs-6 col-sm-4 col-md-4 document">
                      <div class="thmb" >
                        <div class="thmb-prev  text-center">
                          <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>Einsurance/maxicare_insurance" class="" id="aloading">
                            <img src="<?php echo BASE_URL() ?>assets/images/billspayment/insurance_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                          </a>
                        </div>

                        <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>Einsurance/maxicare_insurance" id="aloading">Maxicare</a></h5>
                      </div>
                    </div>   
                  </div>
                <?php endif ?>
              </div>      
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>       