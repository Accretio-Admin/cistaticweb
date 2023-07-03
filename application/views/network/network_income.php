<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-users"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>NETWORK</li>
                </ul>
                <h4>NETWORK INCOME</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->


    <div class="contentpanel">
    <?php if ($results['S'] === 0): ?>
        <div class="alert alert-danger"><?php echo $results['M']; ?></div>
    <?php endif ?>
      <?php if ($results['S'] == 1): ?>
        <div class="alert alert-success"><?php echo $results['M']; ?></div>
    <?php endif ?>
        <div class="row row-stat">
            <div class="col-md-5">
                <h3>Network Income</h3>
                <table border="2" class="table table-striped">
                    <tbody>
                        <tr>
                            <td>Network Income</td>
                            <td>&#x20b1 <?php echo $network_income['cPoints']?></td>
                            <td>&#x20b1 <?php echo $network_income['availablebalance']?></td>
                            <td>
                                <div class="form-group text-right">
                                   <a href="#" class="btnCheque btn btn-warning btn-sm pull-right">cheque</a>
                                    <a href="#" class="btneCash btn btn-primary btn-sm pull-right" style="margin-right:5px;">eCash</a> 
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>GC Income</td>
                            <td><?php echo $network_income['gcPoints']?></td>
                            <td>&#x20b1 <?php echo $network_income['availablegc']?></td>
                            <td>
                                <div class="col-md-12">

                                <div class="row">
                                    <div class="form-group">
                                        <!-- <div class="btnClaim"> --><a href="#" class="btnClaim btn btn-success btn-sm pull-right">claim</a><!-- </div> --> 
                                    </div>
                                </div>

                                <div class="row">

                                <div class="col-md-6">

                                </div>

                                <div class="col-md-6">
                                <div class="form-group text-right pull-right" style="color: red;font-size: 13px">
                                    (Note: For Bento Pares only)
                                </div>
                                </div>

                                </div>

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>MLM Income</td>
                            <td><?php echo $mlm_income['avalaible_MLM_fund']?></td>
                            <td><?php echo $mlm_income['current_MLM_fund']?></td>
                            <td>
                                <div class="form-group text-right">
                                    <div class="btnMLMCheque"><a href="#" class="btn btn-warning btn-sm pull-right">cheque</a></div> 
                                </div>
                            </td>
                        </tr>

                        <!-- <tr>
                            <td>Current Balance</td><td>:</td><td>&#x20b1 <?php echo $network_income['cPoints']?></td>
                        </tr>
                        <tr>
                            <td>Current GC</td><td>:</td><td><?php echo $network_income['gcPoints']?></td>
                        </tr>
                        <tr>
                            <td>Available Balance</td><td>:</td><td>&#x20b1 <?php echo $network_income['availablebalance']?></td>
                        </tr>
                        <tr>
                            <td>Available GC</td><td>:</td><td>&#x20b1 <?php echo $network_income['availablegc']?></td>
                        </tr>
                        <tr>
                            <td>Total Income</td><td>:</td><td>&#x20b1 <?php echo $network_income['totalincome']?></td>
                        </tr> -->
                </table>
               <!--  <div class="form-group text-right">
                    <div class="btnClaim"><a href="#" class="btn btn-success btn-sm pull-right">claim</a></div> 
                    <div class="btnCheque"><a href="#" class="btn btn-warning btn-sm pull-right">cheque</a></div>  
                    <div class="btneCash"><a href="#" class="btn btn-primary btn-sm pull-right">eCash</a></div> 
                </div> -->

<!--            <h3>Sales</h3>
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>Personal Sales</td>
                        </tr>
                        <tr>
                            <td>Group Sales</td>
                        </tr>
                        <tr>
                            <td>Sales to maintain</td>
                        </tr>
                        <tr>
                            <td>Sales to rank up</td>
                        </tr>
                    </tbody>
                </table> 
-->
            </div>
        </div>
    </div>





  <!--Modal-->
    <div id="eCashModal" class="modal fade">
        <div class="modal-dialog" style="align: center; padding-top: 10%;">
            <div class="modal-content" style="width: 70%;">
                <div class="modal-header">
                  <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                  <h4 class="modal-title"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Convert Available Balance to eCash</h4>
                </div>

                <div class="modal-body" style="padding-top: 0px; display: block;">
                    <form name="frmeCash" action="<?php echo BASE_URL() ?>Network/networkincome" method="post" >
                        <div class="contentpanel" style="padding-top: 0px;" id="ecashP1"> 
                            <div class="panel panel-default">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="inputTransferAmount1" id="inputTransferAmount1" placeholder="AMOUNT TO TRANSFER" required/>
                                    </div>
                                    <div class="form-group text-right">
                                        <button name="btnSubmitEcash" id="btnSubmitEcash" class="btn btn-primary" style="display: none;">Submit</button>
                                    </div>
                            </div>
                        </div> 

                        <div class="contentpanel" style="padding-top: 0px; display: none;" id="ecashP2"> 
                            <div class="panel panel-default">
                                <div class="form-group">
                                    <div class="input-group">
                                        <p style="color: blue;">PLEASE REVIEW THE CORRECTNESS OF THE FOLLOWING DETAILS BEFORE CLICKING THE [CONFIRM] BUTTON</p>
                                        <p>Available Balance : <?php echo number_format($network_income['availablebalance'],2) ?></p>
                                        <p>eCash Balance : <?php echo number_format($user['EC'],2) ?></p>
                                        <p>Amount to Convert : <input style="border: none;" type="text" name="inputTransferAmountecash" id="inputTransferAmountecash" readonly></p>
                                        <p>Converted Amount : <input  style="border: none;" type="text" name="inputConvertedAmountecash" id="inputConvertedAmountecash" readonly></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required/>
                                </div>
                                <div class="form-group text-right">
                                    <button name="btnBackEcash" id="btnBackEcash" class="btn btn-warning"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back</button>
                                    <button type="submit" class="btn btn-primary" name="btnConfrimEcash">Confirm</button>
                                </div>
                            </div>
                        </div> 
                    </form>  
                </div>

            </div>
        </div>
    </div>

    <div id="chequeModal" class="modal fade">
        <div class="modal-dialog" style="align: center; padding-top: 10%;">
            <div class="modal-content" style="width: 70%;">
                <div class="modal-header">
                  <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                  <h4 class="modal-title"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Convert Available Balance to Cheque</h4>
                </div>

                <div class="modal-body" style="padding-top: 0px; display: block;">
                    <form name="frmeCash" action="<?php echo BASE_URL() ?>Network/networkincome" method="post" >
                        <div class="contentpanel" style="padding-top: 0px;" id="chequeP1"> 
                            <div class="panel panel-default">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="inputTransferAmount11" id="inputTransferAmount11" placeholder="AMOUNT TO TRANSFER" required/>
                                    </div>
                                    <div class="form-group text-right">
                                        <button name="btnSubmitCheque" id="btnSubmitCheque" class="btn btn-primary" style="display: none;">Submit</button>
                                    </div>
                            </div>
                        </div> 

                        <div class="contentpanel" style="padding-top: 0px; display: none;" id="chequeP2"> 
                            <div class="panel panel-default">
                                <div class="form-group">
                                    <div class="input-group">
                                        <p style="color: blue;">PLEASE REVIEW THE CORRECTNESS OF THE FOLLOWING DETAILS BEFORE CLICKING THE [CONFIRM] BUTTON</p>
                                        <p>Available Balance : <?php echo number_format($network_income['availablebalance'],2) ?></p>
                                        <p>eCash Balance : <?php echo number_format($user['EC'],2) ?></p>
                                        <p>Amount to Convert : <input style="border: none;" type="text" name="inputTransferAmountcheque" id="inputTransferAmountcheque" readonly></p>
                                        <p>Converted Amount : <input  style="border: none;" type="text" name="inputConvertedAmountcheque" id="inputConvertedAmountcheque" readonly></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required/>
                                </div>
                                <div class="form-group text-right">
                                    <button name="btnBackCheque" id="btnBackCheque" class="btn btn-warning"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back</button>
                                    <button type="submit" class="btn btn-primary" name="btnConfrimCheque">Confirm</button>
                                </div>
                            </div>
                        </div> 
                    </form>  
                </div>

            </div>
        </div>
    </div>

    <div id="claimModal" class="modal fade">
        <div class="modal-dialog" style="align: center; padding-top: 10%;">
            <div class="modal-content" style="width: 70%;">
                <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                  <h4 class="modal-title"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Claim Gift Cheque</h4>
                </div>
                <div class="modal-body" style="padding-top: 0px;">
                    <form name="frmeCash" action="<?php echo BASE_URL() ?>Network/networkincome" method="post" >
                        <div class="contentpanel" style="padding-top: 0px;" id="gcP1"> 
                            <div class="panel panel-default">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="inputName1" id="inputName1" placeholder="NAME" required/>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="inputGcToClaim1" id="inputGcToClaim1" placeholder="GC TO CLAIM" required/>
                                    </div>
                                    <div class="form-group text-right">
                                        <button name="btnSubmitGC" id="btnSubmitGC" class="btn btn-primary" style="display: none;">Submit</button>
                                    </div>
                            </div>
                        </div>
                        <div class="contentpanel" style="padding-top: 0px; display: none;" id="gcP2"> 
                            <div class="panel panel-default">
                                <div class="form-group">
                                    <div class="input-group">
                                        <p style="color: blue;">PLEASE REVIEW THE CORRECTNESS OF THE FOLLOWING DETAILS BEFORE CLICKING THE [CONFIRM] BUTTON</p>
                                        <p>Available Gift Cheque : <?php echo number_format($network_income['availablegc'],2) ?></p>
                                        <p>Gift Cheque to Claim : <input style="border: none;" type="text" name="inputGcToClaim" id="inputGcToClaim" readonly></p>
                                        <p>Name of Claimant : <input  style="border: none;" type="text" name="inputName" id="inputName" readonly></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required/>
                                </div>
                                <div class="form-group text-right">
                                    <button name="btnBackGC" id="btnBackGC" class="btn btn-warning"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back</button>
                                    <button type="submit" class="btn btn-primary" name="btnConfrimGC">Confirm</button>
                                </div>
                            </div>
                        </div> 
                    </form>   
                </div>
            </div>
        </div>
    </div>


    <div id="MLMchequeModal" class="modal fade">
        <div class="modal-dialog" style="align: center; padding-top: 10%;">
            <div class="modal-content" style="width: 70%;">
                <div class="modal-header">
                  <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                  <h4 class="modal-title"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Convert Available Balance to Cheque(MLM)</h4>
                </div>

                <div class="modal-body" style="padding-top: 0px; display: block;">
                    <form name="frmeCash" action="<?php echo BASE_URL() ?>Network/networkincome" method="post" >
                        <div class="contentpanel" style="padding-top: 0px;" id="MLMchequeP1"> 
                            <div class="panel panel-default">
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="inputTransferAmountMLM" id="inputTransferAmountMLM" placeholder="AMOUNT TO TRANSFER" required/>
                                    </div>
                                    <div class="form-group text-right">
                                        <button name="btnSubmitMLMCheque" id="btnSubmitMLMCheque" class="btn btn-primary" style="display: ;">Submit</button>
                                    </div>
                            </div>
                        </div> 

                        <div class="contentpanel" style="padding-top: 0px; display: none;" id="MLMchequeP2"> 
                            <div class="panel panel-default">
                                <div class="form-group">
                                    <div class="input-group">
                                        <p style="color: blue;">PLEASE REVIEW THE CORRECTNESS OF THE FOLLOWING DETAILS BEFORE CLICKING THE [CONFIRM] BUTTON</p>
                                        <p>Available MLM Balance : <?php echo number_format($mlm_income['avalaible_MLM_fund'],2) ?></p>
                                        <p>Current MLM Balance : <?php echo number_format($mlm_income['current_MLM_fund'],2) ?></p>
                                        <p>Amount to Convert : <input style="border: none;" type="text" name="inputTransferAmountMLMcheque" id="inputTransferAmountMLMcheque" readonly></p>
                                        <p>Converted Amount : <input  style="border: none;" type="text" name="inputConvertedAmountMLMcheque" id="inputConvertedAmountMLMcheque" readonly></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required/>
                                </div>
                                <div class="form-group text-right">
                                    <button name="btnBackMLMCheque" id="btnBackMLMCheque" class="btn btn-warning"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back</button>
                                    <button type="submit" class="btn btn-primary" name="btnMLMConfrimCheque">Confirm</button>
                                </div>
                            </div>
                        </div> 
                    </form>  
                </div>

            </div>
        </div>
    </div>
    

</div>