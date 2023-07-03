<div class="mainpanel">
  <div class="pageheader">
    <div class="media">
      <div class="pageicon pull-left">
        <center><i class="fa fa-mobile-phone"></i></center>
      </div>

      <div class="media-body">
        <ul class="breadcrumb">
          <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
          <li>LOADING</li>
        </ul>

        <h4>BUY-LOADING</h4>
      </div>
    </div>
  </div>
                  
  <div class="contentpanel">
    <div class="row row-stat">
      <div class="col-sm-9 col-md-9">
        <div class="tab-content nopadding noborder">
          <div class="tab-pane active" id="activities">
            <div class="follower-list">  
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="row media-manager">

                  <div class="col-xs-6 col-sm-4 col-md-4 document">
                    <div class="thmb" >
                      <div class="thmb-prev  text-center">
                        <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>buy_load/anypay" class="" id="aloading">
                          <img  src="<?php echo BASE_URL() ?>assets/images/loading/regular_load_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                        </a>
                      </div>

                      <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>buy_load/anypay" id="aloading">ANY PAY</a></h5>
                    </div>
                  </div>
                  <?php if($this->user['R'] == '1234567'):?>
                  <div class="col-xs-6 col-sm-4 col-md-4 document">
                    <div class="thmb" >
                      <div class="thmb-prev  text-center">
                        <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>buy_load/ding" class="" id="aloading">
                          <img  src="<?php echo BASE_URL() ?>assets/images/loading/regular_load_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                        </a>
                      </div>

                      <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>buy_load/ding" id="aloading">INTERNATIONAL LOADING</a></h5>
                    </div>
                  </div>
                  <?php endif ?>
                  <div class="col-xs-6 col-sm-4 col-md-4 document">
                    <div class="thmb" >
                      <div class="thmb-prev  text-center">
                        <a style="background-color: #fff;" href="<?php echo BASE_URL() ?>buy_load/npn" class="" id="aloading">
                          <img  src="<?php echo BASE_URL() ?>assets/images/loading/regular_load_new.png" class="img-responsive" alt="" style= "margin:0 auto">
                        </a>
                      </div>

                      <h5 class="fm-title text-center"><a href="<?php echo BASE_URL() ?>buy_load/npn" id="aloading">NPN</a></h5>
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