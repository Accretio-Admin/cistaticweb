<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <form name="frmecashpadalasender" action="<?php echo BASE_URL() ?>ecash_payout/ecashtowestern_createrequest" method="post" id="frmSSeachRemit" >
                <div class="row">
                    <div class='col-xs-12 col-md-12'>
                        <div class="row">
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="inputWesternSenderName" name="inputSearchMtcnNo" placeholder="SEARCH MTCN NO" value="<?php echo $type['inputSenderName']; ?>" required/>
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