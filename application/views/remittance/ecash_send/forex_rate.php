<style type="text/css" media="screen">


table th,
table td {
  padding: .625em;
  text-align: center;
}
table th {
  font-size: .85em;
  letter-spacing: .1em;
  text-transform: uppercase;
}
    
  </style>

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
                <h4>Forex Rate</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
    <div class="contentpanel" style="padding-top: 10px; padding-bottom: 0px;">
      <?php if ($API['S_E'] === 0): ?>
       <div class="alert alert-danger"><?php echo $API['M']; ?></div>
      <?php elseif ($API['S_E'] == 1): ?>
       <div class="alert alert-success"><?php echo $API['M']; ?></div>
      <?php endif ?>
        <div class="row row-stat">
            <div class="col-md-7">
                <div class="panel panel-default">
                  <div class="panel-body" style="border: 1px solid #d3d3d3; border-radius:10px; padding: none;"><!--style="background-color: #FF9933;"-->
                      <h5 style="font-weight: bold;">FOREX RATE</h5>
                    <!--   <p>Using your availability e-Cash Balance you can convert this to the type of currency using the form below. </p>
                      <p>Procedure on how to transfer e-Cash Balance to your type of currency load wallet. </p>
                      <p> 1. Select the currency you want to exchange </p>
                      <p> 2. Enter the amount you wish to transfer</p>
                      <p> 3. Click the Check button to verify your balance</p>
                      <p> 4. Enter your transaction password </p>
                      <p> 5. Click the submit button. </p> -->

                      <h5><i><b><span class="text-danger">Note:</span> Currency amount is updated regularly, Click refresh button to update.</b></i></h5>

                             <?php if ($process['P'] == 1 && $process['S'] === 0): ?>
                              <div class="row">
                                <div class="col-xs-12 col-md-12">
                                    <div class="text-right" style="margin-bottom:5px">
                                        <span class="badge badge-danger"><?php echo $process['M']; ?></span>
                                    </div>

                                </div>   
                              </div>

                              <?php endif ?>

                              <?php if ($process['P'] == 1 && $process['S'] === 1): ?>
                              <div class="row">
                                <div class="col-xs-12 col-md-12">
<!--                                 <div class="text-right" style="margin-bottom:5px">
                                        <span class="badge badge-danger"><?php echo $process['M']; ?></span>
                                    </div> -->
                                    
                                  <div class="table-responsive">
                                      <div id="content_table"></div>
                                  </div>

                                  <button type="button" class="btn btn-success btn-lg fa fa-refresh" id="checkcurrency" style="float:right;"></button> 
                                </div>   
                              </div>
                          <?php endif ?>



                  </div>
                </div>   
            </div><!-- col-md-9 -->
        </div><!-- row -->
    </div><!-- contentpanel -->    



   </div><!-- mainpanel -->            