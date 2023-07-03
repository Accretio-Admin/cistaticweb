<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-money"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                   <li>BILLSPAYMENT</li>
                </ul>
                <h4>MMTCI TOP-UP</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
    <div class="contentpanel">
        <!-- <div class="row">
            <div class="col-md-12 hidden-xs " align="center" style="margin-bottom:10px">
               <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

                    <ins class="adsbygoogle"
                         style="display:inline-block;width:728px;height:90px"
                         data-ad-client="ca-pub-1517010537439957"
                         data-ad-slot="4829683428"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
            </div>
        </div> -->
        
        <div class="row">
            <div class="col-xs-12 col-md-12">

            <?php if ($API['S'] === 0): ?>
            <div class="alert alert-danger"><b><?php echo $API['M'] ?></b></div>
            <?php endif ?>
            <?php if ($API['S'] == 1): ?>
            <div class="alert alert-success">&nbsp;&nbsp;<b><?php echo $API['M'] ?>.</b> Tracking Number: <a href="https://mobilereports.globalpinoyremittance.com/portal/billspayment_receipt/<?php echo $API['TN'];  ?>" target="_blank"><?php echo $API['TN'];  ?></a><br>
               &nbsp;&nbsp;<small>Click <a href="https://mobilereports.globalpinoyremittance.com/portal/billspayment_receipt/<?php echo $API['TN']; ?>" target="_blank">here</a> to download copy of the Acknowledgement Receipt.</small>
            </div>
            <?php endif ?>

                <div class="col-xs-12 col-md-5">
                    <form id="frmBuycodes" name="frmMetroturf" action="<?php echo BASE_URL() ?>Bills_payment/metroturf" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control"  id="accountno"  name="accountno" required maxlength="8" pattern="[2][0-9]{7}" title="8 digit number in start of number two (2)" placeholder="ACCOUNT NUMBER" value="<?php echo $infos['accountno']; ?>" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control inputNameValidator2" name="inputFName" id="inputFName" placeholder="FIRST NAME" value="<?php echo $infos['inputFName']; ?>" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control inputNameValidator2" name="inputLName" id="inputLName" placeholder="LAST NAME" value="<?php echo $infos['inputLName']; ?>" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control inputAmount" name="inputAmount" id="inputAmount" placeholder="AMOUNT" value="<?php echo $infos['inputAmount']; ?>" required/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="inputTpass" id="inputTpass" placeholder="TRANSACTION PASSWORD" required/>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary" name="btnSubmit">SUBMIT</button>
                        </div>
                     </form>
                </div>
                <div class="col-xs-12 col-md-7">
                    <div class="row">
                        <div class="col-xs-12 col-md-8">
                            <div class="form-group">
                                <div class="alert alert-info" style="word-wrap:break-word;">
                                    <span style="color:#FF0000">Note:</span> Account Number should be 8 digit number in start of number two (2)
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>          
</div>
