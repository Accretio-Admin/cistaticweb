<div class="mainpanel">
  <div class="pageheader">
    <div class="media">
      <div class="pageicon pull-left">
        <i class="fa fa-money"></i>
      </div>

      <div class="media-body">
        <ul class="breadcrumb">
          <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
          <li>REPORT</li>
        </ul>

        <h4>LOADING REPORT</h4>
      </div>
    </div>
  </div>

  <div class="contentpanel">
    <form method="post" method="<?php echo BASE_URL()?>Report/loading" id="frmreport" >
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <div class="col-xs-12 col-md-4">                
            <select class="form-control" name="selLoad" required>
              <option value="" disabled <?php echo $_POST['selLoad']? '':'selected'; ?>>LOADING REPORT</option>
              <option value="1" <?php if($_POST['selLoad'] == '1') { echo 'selected'; } ?>>SOLD CARDS</option>
              <option value="2" <?php if($_POST['selLoad'] == '2') { echo 'selected'; } ?>>UNIVERSAL LOAD</option>
              <option value="3" <?php if($_POST['selLoad'] == '3') { echo 'selected'; } ?>>CURRENT TRANSACTION</option>
              <option value="4" <?php if($_POST['selLoad'] == '4') { echo 'selected'; } ?>>OLD TRANSACTION</option>
              <option value="5" <?php if($_POST['selLoad'] == '5') { echo 'selected'; } ?>>CURRENT AIRTIME</option>
              <option value="6" <?php if($_POST['selLoad'] == '6') { echo 'selected'; } ?>>OLD AIRTIME</option>
              <option value="7" <?php if($_POST['selLoad'] == '7') { echo 'selected'; } ?>>ETISALAT</option>
              <option value="8" <?php if($_POST['selLoad'] == '8') { echo 'selected'; } ?>>UAE LOADING</option>
              <option value="9" <?php if($_POST['selLoad'] == '9') { echo 'selected'; } ?>>QATAR LOADING</option>
              <option value="10" <?php if($_POST['selLoad'] == '10') { echo 'selected'; } ?>>SGD LOADING</option>
              <option value="11" <?php if($_POST['selLoad'] == '11') { echo 'selected'; } ?>>HKD LOADING</option>
              <option value="12" <?php if($_POST['selLoad'] == '12') { echo 'selected'; } ?>>BUY LOAD</option>
            </select>                        
          </div>

          <div class="col-xs-12 col-md-4">
            <div class="col-xs-12 col-md-6">
              <input type="date" class="form-control" name="inputStart" id="datetimepicker"  placeholder="Start Date" value="<?php echo $_POST['inputStart']; ?>" required />
            </div>

            <div class="col-xs-12 col-md-6">
              <input type="date" class="form-control" name="inputEnds" id="datetimepickers" placeholder="End Date" value="<?php echo $_POST['inputEnds']; ?>" required />
            </div>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-4 text-right">            
            <button type="submit" name="btnSearch" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>&nbsp;SEARCH</button>
            
            <a href="<?php echo BASE_URL(); ?>Report/export/<?php echo md5('loading') ?>" target="_blank">
              <button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i>&nbsp;&nbsp;GENERATE</button>
            </a>              
          </div>
        </div>    
      </div>
    </form>

    <?php if ($process['P'] == 1 && $process['S'] ===0): ?>
      <div class="row">
        <div class="col-xs-10 col-md-10">
          <div class="alert alert-danger"><b><?php echo $process['M']; ?></b></div>
        </div>   
      </div>
    <?php endif ?>

    <?php if ($process['P'] == 1 && $process['S'] ==1): ?>
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <div class="text-right" style="margin-bottom:5px">
              <span class="badge badge-danger"><?php echo $process['M']; ?></span>
          </div>

          <div class="col-md-12 col-xs-12" style="overflow-y:scroll;height:350px;overflow-x:auto" >
            <table class="table table-bordered" style="width:auto;">
              <thead>
                <tr>
                  <?php foreach ($field as $f ): ?>
                    <th width="230"><?php echo $f;?></th>
                  <?php endforeach ?>
                </tr>
              </thead> 

              <tbody>
                <?php if ($TBODY == 1): ?>
                  <?php foreach ($API['TDATA'] as $l): ?>
                    <tr>
                      <td><?php echo $l['TN'];?></td>
                      <td><?php echo $l['MN'];?></td>
                      <td><?php echo $l['RG'];?></td>
                      <td><?php echo $l['PL'];?></td>
                      <td><?php echo $l['PD'];?></td>
                      <td><?php echo $l['TD'];?></td>
                    </tr>   
                  <?php endforeach ?>
                <?php endif ?>
                                                    
                <?php if ($TBODY == 2): ?>
                  <?php foreach ($API['TDATA'] as $l): ?>
                    <tr>
                      <td><?php echo $l['TR'];?></td>
                      <td><?php echo $l['RG'];?></td>
                      <td><?php echo $l['MN'];?></td>
                      <td><?php echo $l['TT'];?></td>
                      <td><?php echo $l['ST'];?></td>
                      <td><?php echo $l['TN'];?></td>
                      <td><?php echo $l['AM'];?></td>
                      <td><?php echo $l['DT'];?></td>
                      <td><?php echo $l['PT'];?></td>
                      <td><?php echo $l['CT'];?></td>
                      <td><?php echo $l['BL'];?></td>
                      <td><?php echo $l['PS'];?></td>
                    </tr>   
                  <?php endforeach ?>
                <?php endif ?>
                                      
                <?php if ($TBODY == 3 || $TBODY == 4): ?>
                  <?php foreach ($API['TDATA'] as $l): ?>
                    <tr>
                      <td><?php echo $l['TR'];?></td>
                      <td><?php echo $l['RG'];?></td>
                      <td><?php echo $l['MN'];?></td>
                      <td><?php echo $l['TT'];?></td>
                      <td><?php echo $l['ST'];?></td>
                      <td><?php echo $l['TN'];?></td>
                      <td><?php echo $l['RN'];?></td>
                      <td><?php echo $l['AM'];?></td>
                      <td><?php echo $l['PL'];?></td>
                      <td><?php echo $l['RE'];?></td>
                      <td><?php echo $l['DT'];?></td>
                      <td><?php echo $l['PT'];?></td>
                      <td><?php echo $l['CT'];?></td>
                      <td><?php echo $l['BL'];?></td>
                      <td><?php echo $l['PS'];?></td>
                    </tr>
                  <?php endforeach ?>
                <?php endif ?>

                <?php if ($TBODY == 5 || $TBODY == 6): ?>
                  <?php foreach ($API['TDATA'] as $l): ?>
                    <tr>
                      <td><?php echo $l['TN'];?></td>
                      <td><?php echo $l['R'];?></td>
                      <td><?php echo $l['PL'];?></td>
                      <td><?php echo $l['MN'];?></td>
                      <td><?php echo $l['TT'];?></td>
                      <td><?php echo $l['TL'];?></td>
                      <td><?php echo $l['RN'];?></td>
                      <td><?php echo $l['ST'];?></td>
                      <td><?php echo $l['PO'];?></td>
                      <td><?php echo $l['PR'];?></td>
                    </tr>
                  <?php endforeach ?>
                <?php endif ?>

                <?php if ($TBODY == 7 || $TBODY == 8 || $TBODY == 9 || $TBODY == 10 || $TBODY == 11): ?>  <!-- CURRENT ETISALAT & PAYTHEM REPORT -->
                  <?php foreach ($API['TDATA'] as $l): ?>
                    <tr>
                      <?php if ($TBODY == 8){ ?>
                        <td><a href="https://mobilereports.globalpinoyremittance.com/portal/uae_ar_receipt/<?php echo $l['TN'];?>" target="_blank">Download</td>
                        <td><a href="https://mobilereports.globalpinoyremittance.com/portal/uae_customer_receipt/<?php echo $l['TN'];?>" target="_blank">Download</td>
                        <td><b><?php echo $l['TN'];?></b></td>
                      <?php } elseif ($TBODY == 9) { ?>
                        <td><a href="https://mobilereports.globalpinoyremittance.com/portal/qatar_ar_receipt/<?php echo $l['TN'];?>" target="_blank">Download</td>
                        <td><a href="https://mobilereports.globalpinoyremittance.com/portal/qatar_customer_receipt/<?php echo $l['TN'];?>" target="_blank">Download</td>
                        <td><b><?php echo $l['TN'];?></b></td>
                      <?php } elseif ($TBODY == 11) { ?>
                        <td><a href="https://mobilereports.globalpinoyremittance.com/portal/hkd_ar_receipt/<?php echo $l['TN'];?>" target="_blank">Download</td>
                        <td><b><?php echo $l['TN'];?></b></td>
                      <?php } else{ ?>
                        <td><a href="<?php echo $l['URL']; ?>" target="_blank"><?php echo $l['TN'];?></td>
                      <?php } ?>

                      <td><?php echo $l['R'];?></td>
                      <td><?php echo $l['PL'];?></td>
                      <td><?php echo $l['MN'];?></td>
                      <td><?php echo $l['TT'];?></td>
                      <td><?php echo $l['TL'];?></td>
                      <td><?php echo $l['RN'];?></td>
                      <td><?php echo $l['ST'];?></td>
                      <td><?php echo $l['PO'];?></td>
                      <td><?php echo $l['PR'];?></td>
                    </tr>
                  <?php endforeach ?>
                <?php endif ?>
                
                <?php if ($TBODY == 12): ?>
                  <?php foreach ($API['TDATA'] as $l): ?>
                    <tr>
                      <td><?php echo $l['timestamp'];?></td>
                      <td><?php echo $l['type'];?></td>
                      <td><?php echo $l['transac_no'];?></td>
                      <td><?php echo $l['ref_no'];?></td>
                      <td><?php echo $l['regcode'];?></td>
                      <td><?php echo $l['operator'];?></td>
                      <td><?php echo $l['plancode'];?></td>
                      <td><?php echo $l['load_amount'];?></td>
                      <td><?php echo $l['converted_amount'];?></td>
                      <td><?php echo $l['wallet_currency'];?></td>
                      <td><?php echo $l['debited_amount'];?></td>
                      <td><?php echo $l['status'];?></td>
                      <td><?php echo $l['mobile_no'];?></td>
                    </tr>
                  <?php endforeach ?>
                <?php endif ?>
              </tbody>  
            </table>
          </div>
        </div>   
      </div>
    <?php endif ?>
  </div>
</div>       