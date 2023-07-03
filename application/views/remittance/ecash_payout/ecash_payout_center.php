<style>
.img-responsivea:hover {
 -webkit-transform: rotate(350deg) scale(1.3);
  -moz-transform:    rotate(350deg) scale(1.3);
  -o-transform:      rotate(350deg) scale(1.3);
  -ms-transform:     rotate(350deg) scale(1.3);
}

.img-responsivea {
  margin: 0 auto; 
  width: 100px; 
  height: 100px;
}

.thmb-iconsa {
  margin-left: 30%;
  margin-top: 10px;
  width: 170px !important; 
  height: 70px !important;
}

.thmb-iconsb {
  margin-left: 38%;
  margin-top: 10px;
  width: 100px !important; 
  height: 80px !important;
}

.thmb-iconsc {
  margin-left: 25%;
  margin-top: 10px;
  width: 180px !important; 
  height: 70px !important;
}

.title_logo {
  margin-left: 15%;
}
</style>


<?php $live_url = "https://mobilereports.globalpinoyremittance.com/"; ?>

<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-home"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>ECASH</li>
                </ul>
                <h4>E-CASH PAYOUT CENTER</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel" style="padding-top: 0px;">
      <div class="row row-stat">
          <div class="col-xs-12 col-sm-12 col-md-12">

<!-- Start of IF ip is equal to PH then proceed -->

              <?php 

              $ch=curl_init();
              curl_setopt($ch,CURLOPT_URL, "http://ip-api.com/json");
              curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

              $result=curl_exec($ch);
              $result=json_decode($result);

              // If Outside PH and regcode is Test account blocked Service
              if ($result->country !== 'Philippines' && $user['R'] == 'F7897947'): ?> 

              <h3>This service is only available in the Philippines</h3>

              <!-- else if not equal to Test account, Can access Service  -->
              <?php elseif ($user['R'] !== 'F7897947'): ?>

              <!-- Paste ContentPanel Here -->

              <h3 style="text-align: center;">OUR ACCREDITED CORPORATE ACCOUNTS WITH REMITTANCE SERVICE</h3>
              <div class="contentpanel" style="padding: 0px;"> 
                <div class="panel panel-default" style="border: 0px;">
                  <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-3 document">
                      <img style="background-color: none !important;" id="CBE" src="<?php echo $live_url; ?>assets/images/ecashpaycenter/cbeestrada_logo.png" class="img-responsivea thmb-iconsa" alt="CBE ESTRADA">
                      <div class="thmb" align="center">
                        <h5><a href="#">CBE ESTRADA</a></h5>
                      </div><!-- thmb -->
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-3 document">
                      <img style="background-color: none !important;" id="ecashpaycenter" src="<?php echo $live_url; ?>assets/images/ecashpaycenter/EcashpayCenter_logo.png" class="img-responsivea thmb-iconsa" alt="ECASH PAY CENTER" >
                      <div class="thmb" align="center">
                        <h5><a href="#">ECASH PAY CENTER</a></h5>
                      </div><!-- thmb -->
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-3 document">
                      <img id="dalton" src="<?php echo $live_url; ?>assets/images/ecashpaycenter/daltonpawnshop_logo.jpg" class="img-responsivea thmb-iconsa" alt="DALTON PAWNSHOP">
                      <div class="thmb" align="center">
                        <h5><a href="#">DALTON PAWNSHOP</a></h5>
                      </div><!-- thmb -->
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-3 document">
                      <img id="davaoena" src="<?php echo $live_url; ?>assets/images/ecashpaycenter/davaoena_logo.png" class="img-responsivea thmb-iconsa" alt="DAVAOENA PAWNSHOP">
                      <div class="thmb" align="center">
                        <h5><a href="#">DAVAOENA PAWNSHOP</a></h5>
                      </div><!-- thmb -->
                    </div> 
                  </div>
                  <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-3 document">
                      <img id="dominion" src="<?php echo $live_url; ?>assets/images/ecashpaycenter/dominionpawnshop_logo.png" class="img-responsivea thmb-iconsa" alt="DOMINION PAWNSHOP">
                      <div class="thmb" align="center">
                        <h5><a href="#">DOMINION PAWNSHOP</a></h5>
                      </div><!-- thmb -->
                    </div> 
                    <div class="col-xs-6 col-sm-6 col-md-3 document">
                      <img id="exquisite" src="<?php echo $live_url; ?>assets/images/ecashpaycenter/EXQUISITE.png" class="img-responsivea thmb-iconsa" alt="EXQUISITE PAWNSHOP">
                      <div class="thmb" align="center">
                        <h5><a href="#">EXQUISITE PAWNSHOP</a></h5>
                      </div><!-- thmb -->
                    </div> 
                    <div class="col-xs-6 col-sm-6 col-md-3 document">
                      <img id="hub" src="<?php echo $live_url; ?>assets/images/ecashpaycenter/hub_logo.png" class="img-responsivea thmb-iconsb" alt="HUB">
                      <div class="thmb" align="center">
                        <h5><a href="#">HUB</a></h5>
                      </div><!-- thmb -->
                    </div> 
                    <div class="col-xs-6 col-sm-6 col-md-3 document">
                      <img id="mariagracia" src="<?php echo $live_url; ?>assets/images/ecashpaycenter/maria-gracia-pawnshop_logo.png" class="img-responsivea thmb-iconsa" alt="MARIA GRACIA PAWNSHOP">
                      <div class="thmb" align="center">
                        <h5><a href="#">MARIA GRACIA PAWNSHOP</a></h5>
                      </div><!-- thmb -->
                    </div> 
                  </div>
                  <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-3 document">
                    <img id="mcc" src="<?php echo $live_url; ?>assets/images/ecashpaycenter/MindanaoCreditCooperative_logo.png" class="img-responsivea thmb-iconsc" alt="MINDANAO CREDIT COOPERATIVE">
                      <div class="thmb" align="center">
                        <h5><a href="#">MINDANAO CREDIT COOPERATIVE</a></h5>
                      </div><!-- thmb -->
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-3 document">
                      <img id="quickloan" src="<?php echo $live_url; ?>assets/images/ecashpaycenter/Quickloan_logo.jpg" class="img-responsivea thmb-iconsa" alt="QUICKLOAN">
                      <div class="thmb" align="center">
                        <h5><a href="#">QUICKLOAN</a></h5>
                      </div><!-- thmb -->
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-3 document">
                      <img id="rdpawnshop" src="<?php echo $live_url; ?>assets/images/ecashpaycenter/rdpawnshop_logo.jpg" class="img-responsivea thmb-iconsa" alt="RD PAWNSHOP">
                      <div class="thmb" align="center">
                        <h5><a href="#">RD PAWNSHOP</a></h5>
                      </div><!-- thmb -->
                    </div> 
                    <div class="col-xs-6 col-sm-6 col-md-3 document">
                      <img id="stpatrick" src="<?php echo $live_url; ?>assets/images/ecashpaycenter/stpatrick_logo.png" class="img-responsivea thmb-iconsc" alt="ST. PATRICK PAWNSHOP">
                      <div class="thmb" align="center">
                        <h5><a href="#">ST. PATRICK PAWNSHOP</a></h5>
                      </div><!-- thmb -->
                    </div>
                    <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-3 document">
                      <img id="tambunting" src="<?php echo $live_url; ?>assets/images/ecashpaycenter/TambuntingUnifiedProductsandServices.png" class="img-responsivea thmb-iconsa" alt="TAMBUNTING PAWNSHOP">
                      <div class="thmb" align="center">
                        <h5><a href="#">TAMBUNTING PAWNSHOP <br/> UNIFIED PRODUCTS AND SERVICES</a></h5>
                      </div><!-- thmb -->
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-3 document">
                      <img id="tambunting" src="../assets/images/logos/jewel-pawnshop.jpg" class="img-responsivea thmb-iconsa" alt="TAMBUNTING PAWNSHOP">
                      <div class="thmb" align="center">
                        <h5 ><a href="#">JEWEL PAWNSHOP</a></h5>
                      </div><!-- thmb -->
                    </div>
                  </div>
                </div>
              </div> 
              <?php endif; ?>

<!-- End of Ifelse IP is not equal to PH -->

          </div>
      </div>
    </div> 

    <!--EXQUISITE Modal-->
    <div id="ecashpaycenterModal" data-backdrop="static"  class="modal fade">
      <div class="modal-dialog" style="align: center; padding-top: 5%; width: 50%;">
        <div class="modal-content">
          <div class="modal-header" style="padding-bottom: 0px;">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" style="color: #4169E1;">NO RECORD FOUND</h4>
              <h5 class="modal-sub-title"></h5>
          </div>
          <form name="frmExquisite" action="<?php echo BASE_URL() ?>ecash_payout/printdetails" method="post" class="frmclass">
          <div class="modal-body">
            <div class="contentpanel" style="padding: 0px;"> 
                <div class="panel panel-default" style="max-height: 400px; padding: 0px;">
                  <div>
                      <div class="form-group" style="max-height: 400px; overflow-y: scroll;">
                        <table class="table table-bordered datatable" id="ecashpaycenterTable" style="overflow: scroll; height: 50px;">
                        <thead>
                          <tr>
                          <!-- <th>#</th> -->
                          <th>BRANCH</th>
                          <th>ADDRESS</th>
                          <th>AREA</th>
                          </tr>
                        </thead>
                        </table>
                      </div>
                  </div>
                </div>
            </div>
          </div>
<!--           <div class="modal-footer">
            <div class="form-group text-right">
              <button type="button"  class="btn btn-default"  data-dismiss="modal" name="btnCancel">Cancel </button>
              <button type="button"  class="btn btn-warning"  name="btnPrint">Print Details <span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>
            </div>
          </div> -->
          </form>
        </div>
      </div>
    </div>

<script src="<?php echo BASE_URL()?>assets/js/ecashpaycenter.js"></script>