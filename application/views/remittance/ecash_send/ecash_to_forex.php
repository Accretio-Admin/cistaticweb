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
                <h4>E-Cash Forex Conversion</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
    <div class="contentpanel" style="padding-top: 10px; padding-bottom: 0px;">
        <div class="row row-stat">
            <div class="col-md-7">
                <div class="panel panel-default">
                  <div class="panel-body" style="border: 1px solid #d3d3d3; border-radius:10px; padding: none;"><!--style="background-color: #FF9933;"-->
                      <h5 style="font-weight: bold;">FREE OF CHARGE</h5>
                      <p>Using your availability e-Cash Balance you can convert this to the type of currency using the form below. </p>
                      <p>Procedure on how to transfer e-Cash Balance to your type of currency load wallet. </p>
                      <p> 1. Select the currency you want to exchange </p>
                      <p> 2. Enter the amount you wish to transfer</p>
                      <p> 3. Click the Verify Rate button to verify your balance</p>
                      <p> 4. Enter your transaction password </p>
                      <p> 5. Click the submit button. </p>

                      <h4><b><span class="text-danger">Note:</span> Please Double check Amount, Load Wallet is non-convertible to Ecash.</b></h4>

                  </div>
                </div>   
            </div><!-- col-md-9 -->
        </div><!-- row -->
    </div><!-- contentpanel -->    

    <div class="contentpanel" style="padding-top: 0px;"> 
        <div class="panel1 panel-default1" style="border: 0px solid;">
            <div class="col-xs-6  col-md-6">
              <div class="row">
                  <div class='col-xs-12 col-md-10'>
                    <?php if ($API['S'] === 0): ?>
                   <div class="alert alert-danger"><?php echo $API['M']; ?></div>
                  <?php elseif ($API['S'] == 1): ?>
                   <div class="alert alert-success"><?php echo $API['M']; ?></br>Transaction #:<b><?php echo $API['TN']; ?></b></div>
                  <?php endif ?>
                  <div class="alert alert-success" style="display:none; text-align: center;" id="checkbalancesuccess"><b></b></div>
                  <div class="alert alert-danger" style="display:none; text-align: center;" id="checkbalancefailed"><b></b></div>

                      <form name="frmecashtoforex" action="<?php echo BASE_URL() ?>ecash_send/ecashtoforex" method="post" id="frmecashtoforex">
                          <h5 style="font-weight: bold; color: #4169E1;">EXCHANGE DETAILS</h5>
                          <div class="form-group">
                             <div class="col-xs-10 col-md-10">
                             <select name="currtype" class="form-control" id='currtype' required>
                              <option value="" disabled selected>-- Select Currency --</option>
                              <option value="SGD">SGD</option>
                              <option value="AED">AED</option>
                              <option value="QAR">QAR</option>
                              <option value="HKD">HKD</option>
                              <option value="MYR">MYR</option>
                            </select>
                            </div>
                          </div>
                          <!-- <div class="col-xs-3 col-md-3"></div> -->
                          <div class="form-group">
                              <div class="col-xs-10 col-md-10">
                                 <input type="text" class="form-control" name="inputAmountTransaction" id='inputAmountTransaction' placeholder="AMOUNT" required/>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="col-xs-10 col-md-10">
                                 <button type="button" class="btn btn-success btn-lg" id="checkbalance" style="float:right;">Verify Rate</button> 
                              </div>
                          </div>

                          <div class="form-group">
                          <label for="input" class="col-sm-4 control-label" id="labelrate">Currency Rate:</label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="currate" id='currate' readonly/>
                            </div>

                          </div>
                          <div class="form-group">
                          <label for="input" class="col-sm-4 control-label" >Ecash Balance After:</label>
                              <div class="col-sm-6">
                                 <input type="text" class="form-control" name="ecashbalafter" id='ecashbalafter' readonly/>
                              </div>
                          </div>
                          <div class="form-group">
                              
                                  <label for="input" class="col-sm-4 control-label" id="labelcurrba">Currency Balance After:</label>
                                <div class="col-sm-6">
                                 <input type="text" class="form-control" name="currencybalafter" id='currencybalafter' placeholder="" readonly/>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="col-xs-10 col-md-10">
                                 <input type="password" class="form-control" name="inputTpass" id='inputTpass' placeholder="TRANSACTION PASSWORD" required="" disabled />
                              </div>
                          </div>
                          

                              <div class="form-group text-right">
                              <div class="col-xs-10 col-md-10">
                                 <button type="button" class="btn btn-info btn-lg" data-toggle="modal" id='submitc' data-target="#myModal" disabled>Submit</button> 
                                 </div>
                              </div>


                            <div id="myModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                  <!-- Modal content-->
                                  <div class="modal-content">
                                   
                                    <div class="modal-body">
                                      <h4>Are you sure you want to proceed ?</h4>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-primary"  name="btnSubmit" id='btnSubmitex'>Proceed</button>
                                    </div>
                                  </div>

                                </div>
                              </div>
                      </form>
                  </div> <!-- col-xs-8 col-md-8-->
              </div> <!-- row -->
            </div> <!--col-xs-6 col-md-6-->
          </div>
        </div>      

   </div><!-- mainpanel -->            


