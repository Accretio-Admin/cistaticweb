<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-money"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                   <li>BILLS PAYMENT</li>
                </ul>
                <h4>MCWD</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
    <div class="contentpanel">
        <div class="row">
            <?php //echo $this->user['AD']; ?>
            <div class="col-xs-12 col-md-6">
                <?php if ($API['S'] === 0): ?>
                    <div class="alert alert-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <b><?php echo $API['M'] ?></b></div>
                <?php endif ?>
                <?php if ($API['S'] === 2): ?>
                    <div class="alert alert-warning"><i class="glyphicon glyphicon-list" aria-hidden="true"></i> <b><?php echo $API['M'] ?></b></div>
                <?php endif ?>
                <?php if ($API['S']== 1 && $process == 2): ?>
                    <div class="alert alert-success"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;&nbsp;<b><?php echo $API['M'] ?>.</b>
                </div>
                <?php endif ?>
                <?php if ($API['S']== 1 && $submitBtn == 1): ?>
                    <div class="alert alert-success"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;&nbsp;<b><?php echo $API['M'] ?>.</b> Tracking Number: <a href="https://mobilereports.globalpinoyremittance.com/portal/billspayment_receipt/<?php echo $API['TN'];  ?>" target="_blank"><?php echo $API['TN'];  ?></a><br>
                   &nbsp;&nbsp;<small>Click <a href="https://mobilereports.globalpinoyremittance.com/portal/billspayment_receipt/<?php echo $API['TN']; ?>" target="_blank">here</a> to download copy of the Acknowledgement Receipt.</small>
                </div>
                <?php endif ?>
                <?php 
                    $msgsuccess = $this->session->flashdata('msgsuccess');
                    if ($msgsuccess['S']==1): ?>
                    <div class="alert alert-success"><i class="fa fa-check-circle" aria-hidden="true"></i> <b>Tracking Number: <?php echo $msgsuccess['TN']; ?></b>. <?php echo $msgsuccess['M']; ?></div>
                <?php endif ?>

                <div class="mcwd"> 
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-info"><h4><b> <?php echo $process == 1 ? 'Transaction Details' : 'Transaction Summary' ?></b></h4></div>
                                </div>
                                <div class="col-md-6">
                                    <form name="frmloadwallet" action="<?php echo BASE_URL()?>Bills_payment/mcwd" method="post" class="frmclass pull-right" id="frmMCWDcheckx">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#exampleModal">
                                                <span class="glyphicon glyphicon-list"></span> &nbsp;Check Status
                                            </button>
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h5 class="modal-title" id="exampleModalLabel">MCWD Check Transaction Status</h5>
                                                  </div>
                                                  <div class="modal-body">
                                                        <div class="form-group">
                                                          <label for="inputPassword3" class="col-sm-4 control-label" style="padding-right:3px;">Tracking Number:</label>
                                                          <div class="col-sm-8">
                                                            <input type="text" class="form-control inputReferenceNo" name="inputReferenceNo" id="inputReferenceNo" placeholder="Enter Tracking Number" required />
                                                          </div>
                                                        </div>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" id="btnCheckStatus" name="btnCheckStatus">Submit</button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">                                                                              
                            <form name="frmloadwallet" action="<?php echo BASE_URL()?>Bills_payment/mcwd" method="post" id="frmMCWDvalidation">
                                <?php if($process == 1) { ?>
                                    <div class="form-group">
                                         <div class="input-group" >
                                            <span class="input-group-addon" id="basic-addon1" style="padding-right: 48px;">Consumer Code:</span>
                                            <input type="text" class="form-control" name="consumer_code" id="consumer_code" placeholder="CONSUMER CODE" id="consumer_code" value="<?php echo $_POST['consumer_code']; ?>" required />
                                         </div>
                                    </div>
                                    <div class="form-group">
                                         <div class="input-group" >
                                            <span class="input-group-addon" id="basic-addon1" style="padding-right: 41px;">Client First Name:</span>
                                            <input type="text" class="form-control" name="inputFName" placeholder="CLIENT FIRST NAME" id="inputFName" value="<?php echo $_POST['inputFName']; ?>" required />
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <div class="input-group" >
                                            <span class="input-group-addon" id="basic-addon1" style="padding-right: 42px;">Client Last Name:</span>
                                            <input type="text" class="form-control" name="inputLName" placeholder="CLIENT LAST NAME" id="inputLName" value="<?php echo $_POST['inputLName']; ?>" required />
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <div class="input-group" >
                                            <span class="input-group-addon" id="basic-addon1" style="padding-right: 59px;">Client Address:</span>
                                            <textarea rows="1" cols="6" name="ClientAddress" id="ClientAddress" style="padding-left: 10px; margin: 0px; width: 100%; height: 65px; resize: none; vertical-align: middle;" placeholder="CLIENT ADDRESS" required><?php echo $_POST['ClientAddress']; ?></textarea>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <div class="input-group" >
                                            <span class="input-group-addon" id="basic-addon1" style="padding-right: 55px;">Mobile Number:</span>
                                            <input type="text" class="inputNumberValidator form-control inputMobile" name="inputMobile" id="inputMobile" pattern="[0-9]{11}" placeholder="MOBILE NUMBER (11-Digits)" value="<?php echo $_POST['inputMobile']; ?>" minlength="11" maxlength="11" required />
                                         </div>
                                     </div>
                                     <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1" style="padding-right: 101px;">Amount:</span>
                                            <input type="number" class="form-control" name="selBalance" id="selBalance" placeholder="AMOUNT" value="<?php echo $_POST['selBalance']; ?>" step=".01" autocomplete="off" required />
                                        </div>
                                     </div>
                                    
                                     <div class="form-group text-right">
                                        <button type="submit" class="btn btn-primary btn-md" id="btnValidate" name="btnValidate">Validate</button>
                                    </div>
                                <?php } ?>

                                <?php if($process == 2) { ?>
                                    <div class="form-group">
                                         <div class="input-group" >
                                            <span class="input-group-addon" id="basic-addon1" style="padding-right: 48px;">Consumer Code:</span>
                                            <input type="text" class="form-control" name="consumer_code" id="consumer_code" placeholder="CONSUMER CODE" id="consumer_code" value="<?php echo $_POST['consumer_code']; ?>" readonly />
                                         </div>
                                    </div>
                                    <div class="form-group">
                                         <div class="input-group" >
                                            <span class="input-group-addon" id="basic-addon1" style="padding-right: 41px;">Client First Name:</span>
                                            <input type="text" class="form-control" name="inputFName" placeholder="CLIENT FIRST NAME" id="inputFName" value="<?php echo $_POST['inputFName']; ?>" readonly />
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <div class="input-group" >
                                            <span class="input-group-addon" id="basic-addon1" style="padding-right: 42px;">Client Last Name:</span>
                                            <input type="text" class="form-control" name="inputLName" placeholder="CLIENT LAST NAME" id="inputLName" value="<?php echo $_POST['inputLName']; ?>" readonly />
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <div class="input-group" >
                                            <span class="input-group-addon" id="basic-addon1" style="padding-right: 59px;">Client Address:</span>
                                            <textarea rows="1" cols="6" name="ClientAddress" id="ClientAddress" style="padding-left: 10px; margin: 0px; width: 100%; height: 65px; resize: none; vertical-align: middle; background-color: #eee;" placeholder="CLIENT ADDRESS" readonly><?php echo $_POST['ClientAddress']; ?></textarea>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <div class="input-group" >
                                            <span class="input-group-addon" id="basic-addon1" style="padding-right: 55px;">Mobile Number:</span>
                                            <input type="tel" class="inputNumberValidator form-control inputMobile" name="inputMobile" id="inputMobile" placeholder="MOBILE NUMBER (11-Digits)" value="<?php echo $_POST['inputMobile']; ?>" minlength="11" maxlength="11" readonly />
                                         </div>
                                     </div>
                                     <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1" style="padding-right: 101px;">Amount:</span>
                                            <input type="text" class="form-control" name="selBalance" id="selBalance" placeholder="AMOUNT" value="<?php echo $_POST['selBalance']; ?>" readonly />
                                        </div>
                                     </div>
                                    <div class="form-group" id="divTranspassxx"> 
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">Transaction Password:</span>
                                            <input type="password" class="form-control" name="inputTpass" id="inputTpass" placeholder="TRANSACTION PASSWORD" value="" required />
                                        </div>
                                     </div>

                                     <div class="form-group text-right">
                                        <a href="<?php echo BASE_URL()?>Bills_payment/mcwd" class="btn btn-default btn-md" ><span class="glyphicon glyphicon-remove"></span>&nbsp;Cancel</a>
                                        <button type="submit" class="btn btn-primary btn-md" value="1" id="btnSubmit" name="btnSubmit"><span class="glyphicon glyphicon-ok"></span>&nbsp;Confirm</button>
                                    </div>
                                <?php } ?>
                            </form> 
                      </div>
                    </div>

                </div>
                
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="row">
                    <div class="col-xs-12 col-md-8">
                        <div class="form-group">
                            <div class="alert alert-info" style="word-wrap:break-word;">
                                <span style="color:#FF0000">Note:</span> 
                                    <ul>
                                        <li><b>Cut-off time for MCWD bills payment is 4:00pm</b>. Any transaction made after the cut-off time will be processed on the next business day.</li>
                                        <li><b>Restricted to own and family members'</b> MCWD accounts. Maximum of <b>10 transactions per month</b>.</li>
                                    </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="col-xs-12 col-md-7">
                <div class="row">
                    <div class="col-xs-12 col-md-8">
                        <div class="form-group">
                            <div class="alert alert-info alert-biller-default" style="display:none;word-wrap:break-word;"></div>
                            <div class="alert alert-info alert-biller" style="display:none;word-wrap:break-word;"></div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div><!-- row -->
    </div><!-- contentpanel -->              
</div><!-- mainpanel -->            

<script src="<?php echo BASE_URL()?>assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo BASE_URL()?>assets/js/billspayment.js"></script>
<script type="text/javascript">
        
$( document ).ready(function() {
//     var showthis = $("#btnSubmit").val();
//     if(showthis == 1){
//         $("#consumer_code, #inputSubscriberName, #inputSequenceno, #inputZone, #inputBook, #selBalance").prop('readonly', true);
//         $('#ClientAddress').css({'pointer-events': 'none','background-color': '#eee','border-color': '#ccc'}); 
//         $("#divTranspass").css("display", "block");
//         $("#btnSubmit").html('<span class="glyphicon glyphicon-ok"></span>&nbsp;Submit');
//     }

    $("#selBalance").on("input", function() {
        var amount = this.value;
        // alert(amount);
        if(amount>=1){
            // alert(amount);
            $('#selBalance').css('border','1px solid #ccc');
            $('#btnValidate').attr('disabled',false);

        } else {
            $('#selBalance').css('border','1px solid red');
            $('#btnValidate').attr('disabled',true);
        }
    });

});

</script>