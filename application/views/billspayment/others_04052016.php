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
                <h4>OTHERS</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
    <div class="contentpanel">
        <div class="row">
            <div class="col-xs-12 col-md-5">
                <?php if ($API['S'] === 0): ?>
                <div class="alert alert-danger"><b><?php echo $API['M'] ?></b></div>
                <?php endif ?>
                <?php if ($API['S']== 1 && $submitBtn == 1): ?>
                <div class="alert alert-success">&nbsp;&nbsp;<b><?php echo $API['M'] ?> </b><br /><a href="https://mobilereports.globalpinoyremittance.com/portal/billspayment_receipt/<?php echo $API['TN'];  ?>" target="_blank"><?php echo $API['TN'];  ?></a>
                   &nbsp;&nbsp;<small>Click transaction number to download reciept.</small>
                </div>
                <?php endif ?>
                <div class="form-group">
                    <select class="form-control" name="selBiller" id="selBiller">
                        <option value="" disabled selected>CHOOSE UTILITIES BILLER</option>  
                    <?php 
                    foreach ($biller as $key): 
                     $pieces = explode("|", $key);
                     $BD = strtoupper($pieces[0]);
                     $BC = strtoupper($pieces[1]);
                     $FT = strtoupper($pieces[2]);
                    ?>
                        <option value="<?php echo $BC ?>" data-type ="<?php echo $FT ?>" data-desc = "<?php echo $FT ?>" ><?php echo $BD ?></option>
                    <?php endforeach ?>
                    </select>
                </div>

                <!-- data type == 1 && 8 && 7-->  
                <div class="utilities1" > 
                    <form name="frmOthersLoading" action="<?php echo BASE_URL() ?>Bills_payment/others" method="post" id="frmOthersLoading">
                       <div class="form-group" id="divBiller1"> </div>   
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputAccountNumber" placeholder="ACCOUNT NUMBER" required />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputSubscriberName" placeholder="SUBSCRIBER NAME" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control"  name="inputAmount" placeholder="AMOUNT" required />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">SUBMIT</button>
                        </div>
                    </form>
                </div><!-- data type == 1 --> 

                <!-- data type == 2-->  
                <div class="utilities2" > 
                    <form name="frmOthersLoading" action="<?php echo BASE_URL() ?>Bills_payment/others" method="post" id="frmOthersLoading">
                       <div class="form-group" id="divBiller2"> </div>   
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputSubscriberName" placeholder="DONOR" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control"  name="inputAmount" placeholder="AMOUNT" required />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">SUBMIT</button>
                        </div>
                    </form>
                </div><!-- data type == 2 --> 

                <!-- data type == 4-->  
                <div class="utilities4" > 
                    <form name="frmOthersLoading" action="<?php echo BASE_URL() ?>Bills_payment/others" method="post" id="frmOthersLoading">
                       <div class="form-group" id="divBiller4"> </div>   
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputAccountNumber" placeholder="PASSPORT NUMBER" required />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputSubscriberName" placeholder="FULLNAME" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control"  name="inputAmount" placeholder="AMOUNT" required />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">SUBMIT</button>
                        </div>
                    </form>
                </div><!-- data type == 4 -->  

                <!-- data type == 18-->  
                <div class="utilities18" > 
                    <form name="frmOthersLoading" action="<?php echo BASE_URL() ?>Bills_payment/others" method="post" id="frmOthersLoading">
                       <div class="form-group" id="divBiller18"> </div>   
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputAccountNumber" placeholder="W PARTNER NUMBER" required />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="inputSubscriberName" placeholder="FULLNAME" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control"  name="inputAmount" placeholder="AMOUNT" required />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="inputTpass" placeholder="TRANSACTION PASSWORD" required />
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">SUBMIT</button>
                        </div>
                    </form>
                </div><!-- data type == 18 --> 
            </div>
            <div class="col-xs-12 col-md-7">
                <div class="row">
                    <div class="col-xs-12 col-md-8">
                        <div class="form-group">
                            <div class="alert alert-info alert-biller" style="display:none;word-wrap:break-word;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- row -->
    </div><!-- contentpanel -->              
</div><!-- mainpanel -->            