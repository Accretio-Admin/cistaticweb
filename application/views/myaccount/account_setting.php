
<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-user"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>HOME</li>
                </ul>
                <h4>ACCOUNT SETTING</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel">
        <div class="row">
            <div class="">
                <?php if ($API['S'] === 0): ?>
                    <div class="alert alert-danger"><b><?php echo $API['M'] ?></b></div>
                <?php endif ?>

                <?php if ($API['S'] != '' && $API['S'] == 0): ?>
                    <div class="alert alert-danger"><b><?php echo $API['M'] ?></b></div>
                <?php endif ?>

                <?php if ($API['S'] == 1): ?>
                    <div class="alert alert-success" >&nbsp;&nbsp;<b><span id='successform'><?php echo $API['M'] ?>.</span></b></div>
                <?php endif ?>

                    <a href="#" id="emailtablink"><i class="glyphicon glyphicon-play" style="color: #808080;"></i><i class="glyphicon glyphicon-envelope" style="color: #808080;"></i>&nbsp;Change Email Address</a>
                    <a href="#" id="mobiletablink"><i class="glyphicon glyphicon-play" style="color: #808080;"></i><i class="glyphicon glyphicon-phone" style="color: #808080;"></i>&nbsp;Change Mobile Number</a>
                    <a href="#" id="aPass"><i class="glyphicon glyphicon-play" style="color: #808080;"></i><i class="glyphicon glyphicon-barcode" style="color: #808080;"></i>&nbsp;Change Transaction Password</a>
                    <a href="#" id="ftPass"><i class="glyphicon glyphicon-play" style="color: #808080;"></i><i class="glyphicon glyphicon-barcode" style="color: #808080;"></i>&nbsp;Forgot Transaction Password</a>
                    <a href="#" id="bPass"><i class="glyphicon glyphicon-play" style="color: #808080;"></i><i class="glyphicon glyphicon-lock" style="color: #808080;"></i>&nbsp;Change Login Password</a>

            </div>
        </div>

        <div class="row">
            <div class="col-xs-6 col-md-5" style="margin-top:20px;">
                <div class="jumbotron" id="emailtab" >                                     
                <h3 class="hr2"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>&nbsp;<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>&nbsp;<span>Change Email Address</span></h3>
                <hr/>
                
                <form method="post" action="<?php echo base_url('/Main/account_setting') ?>">
                    <div class="form-group">
                        <input type="email" class="form-control col-md-6" name="curr_email" required="" autocomplete="off" placeholder="CURRENT EMAIL ADDRESS">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="new_email" required="" autocomplete="off" placeholder="NEW EMAIL ADDRESS">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="con_email" required="" autocomplete="off" placeholder="CONFIRM NEW EMAIL ADDRESS">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="inputTpass" required="" autocomplete="new-password" placeholder="TRANSACTION PASSWORD">
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-10">
                            <div class="form-group margin-top-small margin-bottom-large">
                                <a class="btn btn-default pull-right" href="<?php echo base_url()?>Main/account_setting" >Cancel</a>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-2">
                            <div class="form-group margin-top-small margin-bottom-large">
                                <button class="btn btn-primary pull-right" type="submit" name="btn_changeemail">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>                  
            </div>

            <div class="jumbotron" id="mobiletab" style="display:none;">                                     
                <h3 class="hr2"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>&nbsp;<span class="glyphicon glyphicon-phone" aria-hidden="true"></span>&nbsp;<span>Change Mobile Number</span></h3>
                <hr/>
                
                <form method="post" action="<?php echo base_url('/Main/account_setting') ?>">
                    <div class="form-group">
                        <input type="text" class="form-control col-md-6" name="curr_mobile" required="" autocomplete="off" placeholder="CURRENT MOBILE NUMBER">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="new_mobile" required="" autocomplete="off" placeholder="NEW MOBILE NUMBER">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="con_mobile" required="" autocomplete="off" placeholder="CONFIRM NEW MOBILE NUMBER">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="inputTpass" required="" autocomplete="new-password" placeholder="TRANSACTION PASSWORD">
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-10">
                            <div class="form-group margin-top-small margin-bottom-large">
                                <a class="btn btn-default pull-right" href="<?php echo base_url()?>Main/account_setting" >Cancel</a>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-2">
                            <div class="form-group margin-top-small margin-bottom-large">
                                <button class="btn btn-primary pull-right" type="submit" name="btn_changemobile">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>                  
            </div>

            
            <div class="jumbotron" id="divtpass" style="display:none;">                                     
                <h3 class="hr2"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>&nbsp;<span class="glyphicon glyphicon-barcode" aria-hidden="true"></span>&nbsp;<span>Change Transaction Password</span></h3>
                <hr/>
                
                <form method="post" action="<?php echo base_url('/Main/account_setting') ?>">
                    <div class="form-group">
                        <input type="password" class="form-control col-md-6" name="curr_pass" required="" autocomplete="off" placeholder="CURRENT TRANSACTION PASSWORD">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="new_pass" required="" autocomplete="off" placeholder="NEW TRANSACTION PASSWORD">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="con_pass" required="" autocomplete="off" placeholder="CONFIRM NEW TRANSACTION PASSWORD">
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-10">
                            <div class="form-group margin-top-small margin-bottom-large">
                                <a class="btn btn-default pull-right" href="<?php echo base_url()?>Main/account_setting" >Cancel</a>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-2">
                            <div class="form-group margin-top-small margin-bottom-large">
                                <button class="btn btn-primary pull-right" type="submit" name="btn_changetranspass">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>                  
            </div>

            <div class="jumbotron" id="divftpass" style="display:none;">                                     
                <h3 class="hr2"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>&nbsp;<span class="glyphicon glyphicon-barcode" aria-hidden="true"></span>&nbsp;<span>Forgot Transaction Password</span></h3>
                <hr/>
                
                <form method="post" action="<?php echo base_url('/Main/account_setting') ?>">
                    <div class="form-group">
                        Are you sure you want to reset your transaction password ?
                    </div>

                    <div class="row">
                        <div class="col-xs-6 col-md-10">
                            <div class="form-group margin-top-small margin-bottom-large">
                                <a class="btn btn-default pull-right" href="<?php echo base_url()?>Main/account_setting" >Cancel</a>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-2">
                            <div class="form-group margin-top-small margin-bottom-large">
                                <button class="btn btn-primary pull-right" type="submit" name="btn_forgottranspas">Continue</button>
                            </div>
                        </div>
                    </div>
                </form>                  
            </div>


            
            <div class="jumbotron" id="divlpass" style="display:none;">                                     
                <h3 class="hr2"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>&nbsp;<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;<span>Login Password</span></h3>
                <hr />
                
                <form method="post" action="<?php echo base_url('/Main/account_setting') ?>">
                    <div class="form-group">
                        <input type="password" class="form-control col-md-6" name="curr_pass" required="" autocomplete="off" placeholder="CURRENT PASSWORD">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="new_pass" required="" autocomplete="off" placeholder="NEW PASSWORD">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="con_pass" required="" autocomplete="off" placeholder="CONFIRM NEW PASSWORD">
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-9">
                            <div class="form-group margin-top-small margin-bottom-large">
                                <a class="btn btn-default pull-right" href="<?php echo base_url()?>Main/account_setting" >Cancel</a>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-2">
                            <div class="form-group margin-top-small margin-bottom-large">
                                <button class="btn btn-primary pull-right" type="submit" name="btn_changeloginpass">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>                  
            </div>

            <div class="jumbotron" id="divsvcreate" style="display:none;">                                       
                <h3 class="hr2"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>&nbsp;<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;<span>Create Suprvisor Password</span></h3>
                <hr />
                
                <form method="post" action="/Main/account_setting">
                    <div class="form-group">
                        <input type="password" class="form-control" name="new_pass" required="" autocomplete="off" placeholder="NEW PASSWORD">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="con_pass" required="" autocomplete="off" placeholder="CONFIRM NEW PASSWORD">
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-9">
                            <div class="form-group margin-top-small margin-bottom-large">
                                <a class="btn btn-default pull-right" href="<?php echo base_url()?>Main/account_setting" >Cancel</a>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-2">
                            <div class="form-group margin-top-small margin-bottom-large">
                                <button class="btn btn-primary pull-right" type="submit" name="btn_createsvPass">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>                  
            </div>
                        
            <div class="jumbotron" id="divsvforgot" style="display:none;">                                     
                <h3 class="hr2"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>&nbsp;<span class="glyphicon glyphicon-barcode" aria-hidden="true"></span>&nbsp;<span>Forgot Supervisor Password</span></h3>
                <hr/>
                
                <form method="post" action="<?php echo base_url('/Main/account_setting') ?>">
                    <div class="form-group">
                        Are you sure you want to reset your supervisor password ?
                    </div>

                    <div class="row">
                        <div class="col-xs-6 col-md-10">
                            <div class="form-group margin-top-small margin-bottom-large">
                                <a class="btn btn-default pull-right" href="<?php echo base_url()?>Main/account_setting" >Cancel</a>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-2">
                            <div class="form-group margin-top-small margin-bottom-large">
                                <button class="btn btn-primary pull-right" type="submit" name="btn_forgotsvpass">Continue</button>
                            </div>
                        </div>
                    </div>
                </form>                  
            </div>

            <?php if($API['S'] == 1 && $process['type']):?>
            <div class="modal fade" id="ModalVerify" data-backdrop="static" role="dialog" style="margin-top: 3%;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <b><?php echo $process['type']; ?> VERIFICATION</b>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" id="newheading"></h4>
                        </div>

                        <form id="verifycode" method="post" enctype="multipart/form-data">
                        <fieldset>
                            <div class="modal-body">
                                <div class="alert alert-info" id="message_div"><b><span id='message_info'><?php echo $API['M'] ?></span></br></br>Enter the code you received below.</b></div>
                                <div class="alert alert-danger" style="display:none; text-align: center;" id="errornotif"><b></b></div>
                                <div class="alert alert-success" style="display:none; text-align: center;" id="successnotif"><b></b></div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"  style="padding-right: 12px;">VERIFICATION CODE:</span>
                                        <input type="text" class="form-control" id="code" name="code" required='required' autocomplete="off">
                                        <input type="hidden" class="form-control" id="typeofchange" name="typeofchange" value="<?php echo $process['type']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <span style="float:left">
                                    <i id="resendtext">You can resend a new code in <span id="countdowntimer">30 </span> seconds.</i>
                                    <button type="button" class="btn btn-warning" id="resend" disabled>Resend New Code</button>
                                </span>
                                <button type="submit" class="btn btn-primary" id="submit" >Submit</button>

                                <!-- <button class="btn btn-primary" type="submit" id="btn_emailverifycode" name="btn_emailverifycode">Submit</button> -->

                                <!--<a href="#" class="btn btn-warning" data-dismiss="modal">Close</a> -->
                            </div>
                        </fieldset>
                        </form>
                        
                    </div>
                </div>
            </div>
            <?php endif ?>
        </div>

    </div><!-- contentpanel -->
</div><!-- mainpanel -->            

<script type="text/javascript">

    function resend_countdown(){
        $("#resend").prop("disabled", true); 
        $("#resendtext").html("You can resend a new code in <span id='countdowntimer'>30</span> seconds.");

        var timeleft = 30;
        var downloadTimer = setInterval(function(){
        timeleft--;
        document.getElementById("countdowntimer").textContent = timeleft;
            if(timeleft <= 0)
            {
                clearInterval(downloadTimer);
                $("#resend").prop("disabled", false); 
                $("#resendtext").html("You can now resend a new code.");
            }
        }, 1000);

    }

    var typeofchange = $("#typeofchange").val();

    if(typeofchange == 'EMAIL' || typeofchange == 'MOBILE')
    {
        resend_countdown();
    }
    
</script>