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
        <div class="row row-stat">
            <div class="col-md-5">
                <h3>Network Income</h3>
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>Current Balance</td><td>:</td><td>&#x20b1 0.0</td>
                        </tr>
                        <tr>
                            <td>Current GC</td><td>:</td><td>0.0</td>
                        </tr>
                        <tr>
                            <td>Available Balance</td><td>:</td><td>&#x20b1 0.0</td>
                        </tr>
                        <tr>
                            <td>Available GC</td><td>:</td><td>&#x20b1 0.0</td>
                        </tr>
                        <tr>
                            <td>Total Income</td><td>:</td><td>&#x20b1 0.0</td>
                        </tr>
                </table>
                <div class="form-group text-right">
                    <div class="btnClaim"><a href="#" class="btn btn-success btn-sm pull-right">claim</a></div> 
                    <div class="btnCheque"><a href="#" class="btn btn-warning btn-sm pull-right">cheque</a></div>  
                    <div class="btneCash"><a href="#" class="btn btn-primary btn-sm pull-right">eCash</a></div> 
                </div>

                <h3>Sales</h3>
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
            </div>
        </div>
    </div>

  <!--Modal-->
    <div id="eCashModal" class="modal fade">
        <div class="modal-dialog" style="align: center; padding-top: 10%;">
            <div class="modal-content" style="width: 70%;">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Convert Available Balance to eCash</h4>
                </div>
                <div class="modal-body" style="padding-top: 0px;">
                    <div class="contentpanel" style="padding-top: 0px;"> 
                        <div class="panel panel-default">
                            <form name="frmeCash" action="<?php echo BASE_URL() ?>ecash_send/eCash" method="post" >
                                <div class="form-group">
                                    <input type="text" class="form-control" name="inputSmartMoneyNo" placeholder="AMOUNT TO TRANSFER" required/>
                                </div>
                                <div class="form-group text-right">
                                    <button type="reset" class="btn btn-warning"  name="btnCancel">Cancel</button>
                                    <button type="submit" class="btn btn-primary"  name="btnSubmit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>   
                </div>
            </div>
        </div>
    </div>

    <div id="chequeModal" class="modal fade">
        <div class="modal-dialog" style="align: center; padding-top: 10%;">
            <div class="modal-content" style="width: 70%;">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title"><span class="glyphicon glyphicon-barcode" aria-hidden="true"></span> Convert Available Balance to Cheque</h4>
                </div>
                <div class="modal-body" style="padding-top: 0px;">
                    <div class="contentpanel" style="padding-top: 0px;"> 
                        <div class="panel panel-default">
                            <form name="frmeCash" action="<?php echo BASE_URL() ?>ecash_send/eCash" method="post" >
                                <div class="form-group">
                                    <input type="text" class="form-control" name="inputSmartMoneyNo" placeholder="AMOUNT TO TRANSFER" required/>
                                </div>
                                <div class="form-group text-right">
                                    <button type="reset" class="btn btn-warning"  name="btnCancel">Cancel</button>
                                    <button type="submit" class="btn btn-primary"  name="btnSubmit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>   
                </div>
            </div>
        </div>
    </div>

    <div id="claimModal" class="modal fade">
        <div class="modal-dialog" style="align: center; padding-top: 10%;">
            <div class="modal-content" style="width: 70%;">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Claim Gift Cheque</h4>
                </div>
                <div class="modal-body" style="padding-top: 0px;">
                    <div class="contentpanel" style="padding-top: 0px;"> 
                        <div class="panel panel-default">
                            <form name="frmeCash" action="<?php echo BASE_URL() ?>ecash_send/eCash" method="post" >
                                <div class="form-group">
                                    <input type="text" class="form-control" name="inputName" placeholder="NAME" required/>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="inputGcToClaim" placeholder="GC TO CLAIM" required/>
                                </div>
                                <div class="form-group text-right">
                                    <button type="reset" class="btn btn-warning"  name="btnCancel">Cancel</button>
                                    <button type="submit" class="btn btn-primary"  name="btnSubmit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>