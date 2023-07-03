<div class="row">
    <div class="col-md-12">

        <div class="form-group">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addModal"><span class="glyphicon glyphicon-plus"></span> &nbsp;New Sender / Beneficiary</a> 
        </div>

        <div class="form-group">
            <form name="frmecashpadalasender" action="<?php echo BASE_URL() ?>ecash_payout/ecashtowestern_createrequest" method="post" id="frmSSeachRemit" >
                <div class="row">
                    <div class='col-xs-12 col-md-12'>
                        <div class="row">
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="inputWesternSenderName" name="inputSearch" placeholder="SEARCH SENDER NAME" value="<?php echo $type['inputSenderName']; ?>" required/>
                            </div>
                            <div class="col-md-2 sender-search">
                                <button type="submit" name= "btnSsearch" id="btnSender" class="btn btn-primary">
                                    <span id="spanSIcon" class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                </button>
                            </div> 
                        </div> 
                    </div>
                </div> 
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <form name="frmecashpadalabeneficiary" action="<?php echo BASE_URL() ?>ecash_payout/ecashtowestern_createrequest" method="post" id="frmBSeachRemit"  >
                <div class="row">
                    <div class='col-xs-12 col-md-12'>
                        <div class="row">
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="inputWesternBeneficiaryName" name="inputSearch" placeholder="SEARCH BENEFICIARY NAME" required />
                                <input type="hidden" name="inputSenderHide" id="inputSenderHide" value="<?php echo $type['inputSender']?>"/>
                                <input type="hidden" name="inputBenificiaryHide" id="inputBeneficiaryHide" />
                            </div>
                            <div class="col-md-2">
                                <button type="submit" name= "btnBsearch" id="btnBene" class="btn btn-primary">
                                    <span id="spanBIcon" class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                </button>
                            </div> 
                        </div> 
                    </div>
                </div> 
            </form>  
        </div>
    </div>
</div>