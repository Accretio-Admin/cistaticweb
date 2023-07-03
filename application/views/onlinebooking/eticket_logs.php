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
                <h4>DOMESTIC FLIGHTS</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel" style="padding-bottom: 0px;">
      <?php if ($API['S'] ===0): ?>
            <div class="alert alert-danger"><?php echo $API['M']; ?></div>
      <?php endif ?>
        <?php if ($API['S'] == 1): ?>
              <div class="alert alert-success"><?php echo $API['M']; ?> : Check Status Successful Please Click Again</div>
      <?php endif ?>
        <div class="row row-stat">
            <div class="col-xs-12 col-md-12 text-right">
                  <h5 style="font-weight: bold; color: #4169E1; text-align: right;"><?php echo $result['M']; ?></h5>
            </div>
            <div class="col-xs-12 col-md-12">
              <div class="contentpanel" style="padding-top: 0px;"> 
                  <div class="panel panel-default">
                    <div class="panel-heading" style="padding-top: 15px; padding-bottom: 0px; color: #4169E1; font-weight: bold;">E-TICKETING LOGS</div>
                      <div class="panel-body" style="height: 600px;overflow: scroll;" >
                        <div class="row">
                          <table class="table table-bordered">
                            <thead>
                                <tr>
                                  <?php foreach ($field as $f): ?>
                                      <th><?php echo $f?></th>
                                  <?php endforeach ?>
                                </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($result['record'] as $t ): 
                              $passenger = explode('|^@^|',$t['passenger']);
                              $fname = explode(":", $passenger[2]);
                              $lname = explode(":", $passenger[3]);
                              $name  = $fname[1].' '.$lname[1];
                              $onward = explode("|^@^|", $t['onward']);
                              $flights = $onward[0]."-".$onward[1];                   
                              ?>
                                   <tr class="trPNR">
                                     <?php 
                                    if(preg_match("/\bcancel|abort\b/i",$t['BS'])) { ?>
                                      <td><a onclick="return confirm('This flight is <?php echo $t['BS'] ?> could not generate a report.','Domestic Ticketing Transactions')" class="btn btn-danger" id="aPNR" data-toggle="tooltip" title="This flight is <?php echo $t['BS'] ?> could not generate a report."><?php echo $t['BS'] ?></a></td>
                                    <?php 
                                    } else { 
                                       if ($t['BS'] == "To Deliver"): ?>
                                            <td><a id="aPNR" class="btn btn-warning" href="https://mobilereports.globalpinoyremittance.com/ticketing/domestic/receipt.php?tn=<?php echo $t['tn'] ?>" data-toggle="tooltip" title="Click here get receipt" target="_blank"><?php echo 'Get ticket' ?></a></td>         
                                        <?php else:?>
                                            <td><a onclick="return confirm('Check Status?','Domestic Ticketing Transactions')" href="<?php echo BASE_URL() ?>Domestic_flights/eticketing/<?php echo $t['tn'] ?>" class="btn btn-primary"  id="aPNR" data-toggle="tooltip" title="Click here to check status"><?php echo 'Check Status' ?></a></td>
                                       <?php endif; 
                                     }
                                     ?>
                                      <td><?php echo $t['tn']?></td>
                                      <td class="tdPNR"><?php echo $t['PNR'] ?></td>
                                      <td><?php echo $name; ?></td>
                                      <td><?php echo $flights; ?></td>
                                      <td><?php echo $onward[2]; ?></td>
                                      <td><?php echo $onward[3]; ?></td>
                                      <td><?php echo $onward[4]; ?></td>
                                      <td><?php echo $onward[5]; ?></td>
                                      <td><?php echo "-";  ?></td>
                                      <td><?php echo $t['markupFee'] ?></td>
                                      <td><?php echo $t['totalFee'] ?></td>
                                      <td><?php echo "-"; ?></td>

                                  </tr>
                              <?php endforeach ?>
                               
                            </tbody>
                          </table>
                        </div>
                   </div>
              </div>   
            </div>
        </div>
    </div>

</div>