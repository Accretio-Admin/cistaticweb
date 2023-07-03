<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-home"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>ONLINE BOOKING</li>
                </ul>
                <h4>INTERNATIONAL FLIGHTS</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel" style="padding-bottom: 0px;">
        <div class="row row-stat">
            <div class="col-md-5">
              <div class="contentpanel" style="padding-top: 0px;"> 
                  <div class="panel panel-default">
                    <div class="panel-heading" style="padding-top: 15px; padding-bottom: 0px; color: #4169E1; font-weight: bold;">MARKUP</div>
                      <div class="panel-body">
                        <?php if ($output['S'] === 0): ?>
                            <div class="alert alert-error"><?php  echo $output['M'] ?> </div>
                        <?php elseif ($output['S'] == 1): ?>
                            <div class="alert alert-success"><?php  echo $output['M'] ?> </div>
                        <?php endif ?>
                        <form name="frmiremit" action="<?php echo BASE_URL() ?>International_flights/markup_international" method="post" id="frmInternationalMarkup">
                            <div class="form-group">
                               <input type="text" class="form-control" name="inputAmount" placeholder="AMOUNT" required value="PHP <?php echo $mark_up ?>" readonly/>
                            </div>
                             <div class="form-group text-right">
                                <a type="submit" class="btn btn-primary"  id="BtnUpdateMarkup" name="btnSubmit">Update</a>
                            </div>
                        </form>
                      </div>
                   </div>
              </div>   
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="updateMarkup" role="dialog" >
  <div class="modal-dialog modal-sm">
  
    <!-- Modal content-->
    <div class="modal-content modal-content-xs">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
        <h4 class="modal-title">Update Markup</h4>
      </div>
      <form action="<?php echo BASE_URL() ?>International_flights/markup_international" method="post" id="frmInternationalMarkup">
        <div class="modal-body">
          <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                      <label>Markup</label>
                      <input type="text" class="form-control" name="markup" value="<?php echo $mark_up ?>" required/>
                  </div>  
                   <div class="form-group">
                      <input type="password" class="form-control" name="transpass" placeholder="Transaction Password" required/>
                  </div> 
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="row">
              <div class="col-md-6 text-left">
                    <button type="button" class="btn btn-default btnModalCancel"  data-dismiss="modal">Cancel</button>
              </div>
              <div class="col-md-6 text-right">
                    <button type="submit" class="btn btn-primary btnModalSubmit" name="btnUpdateMarkup">Submit</button>
              </div>
          </div>
          </div>
        </form>
    </div>
  </div>
</div>