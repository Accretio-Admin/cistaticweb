<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-home"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>ECASH</li>
                </ul>
                <h4>Gcash Cancellation</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel" style="padding-bottom: 0px;">
        <?php if ($result['S'] === 0): ?>
        <div class="alert alert-danger"><b><?php echo $result['M'] ?></b></div>
        <?php endif ?>
        <?php if ($result['S']== 1): ?>
        <div class="alert alert-success"><b><?php echo $result['M'] ?></b></div>
        <?php endif ?>
        <div class="row row-stat">
            <?php if ($process === 0): ?>
            <div class="col-md-5">
              <div class="contentpanel" style="padding-top: 0px;"> 
                  <div class="panel panel-default">
                    <div class="panel-heading" style="padding-top: 15px; padding-bottom: 0px;">
                    <h5 style="font-weight: bold; color: #4169E1;">CANCEL REFERENCE NUMBER</h5>
                    </div>
                    <div class="panel-body">
                      <form name="frmCebuana" action="<?php echo BASE_URL() ?>ecash_send/baremi_cancel" method="post" class="frmclass" id="frmEcashPadala">
                           <div class="form-group">
                              <input type="text" class="form-control" name="refno" id="refno" placeholder="ENTER REFERENCE NUMBER" required/>
                          </div>
                           <div class="form-group text-right">
                              <button type="submit" class="btn btn-primary"  name="btnSubmit"><span class="glyphicon glyphicon-ok"></span>&nbsp;Submit</button>
                          </div>
                      </form>
                    </div>
                   </div>
              </div>   
            </div>
            <?php endif ?>
            <?php if ($process === 1): ?>
            <div class="col-md-5">
              <div class="contentpanel" style="padding-top: 0px;"> 
                  <div class="panel panel-default">
                    <div class="panel-heading" style="padding-top: 15px; padding-bottom: 0px;">
                    <h5 style="font-weight: bold; color: #4169E1;">CANCEL REFERENCE NUMBER</h5>
                    </div>
                    <div class="panel-body">
                      <form name="frmCebuana" action="<?php echo BASE_URL() ?>ecash_send/baremi_cancel" method="post" class="frmclass" id="frmEcashPadala">
                          <div class="form-group">
                              <input type="text" class="form-control" name="inputTransactionNo" id="inputTransactionNo" value="<?php echo $result['TN']; ?>" readonly/>
                          </div>
                           <div class="form-group">
                              <input type="text" class="form-control" name="referenceno" id="referenceno" value="<?php echo $result['RF']; ?>" readonly/>
                          </div>
                           <div class="form-group">
                              <input type="password" class="form-control" name="inputTranspass" id="inputTranspass" placeholder="TRANSACTION PASSWORD" required/>
                          </div>
                           <div class="form-group text-right">
                              <a href="<?php echo BASE_URL() ?>ecash_send/baremi_cancel" class="btn btn-default">Not Now</a>
                              <button type="submit" class="btn btn-primary"  name="btnBaremiCancel">Proceed to Cancel</button>
                          </div>
                      </form>
                    </div>
                   </div>
              </div>   
            </div>
            <?php endif ?>
        </div>
    </div>
</div>