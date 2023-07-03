<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-plane"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>ONLINE BOOKING</li>
                </ul>
                <h4><?php echo $menu=='int'? 'INTERNATIONAL': 'DOMESTIC' ?> FLIGHTS</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel" style="padding-bottom: 0px;" ng-app="myApp" ng-controller="myCtrl" ng-cloak>

        <?php if(isset($output) && $output['S']==0): ?>
            <div>session expired</div>
        <?php else: ?>
        <p>
            <a href="<?php echo BASE_URL() ?>Abacus_<?php echo $menu == 'int' ? 'International' : 'Domestic' ?>_Flights/" class="btn btn-default-alt"><span aria-hidden="true">&larr;</span> Back</a>
        </p>
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <!--<th>REGCODE</th>-->
                <th>PNR</th>
                <!--<th>MACHINE</th>-->
                <th>TICKET NUMBER<!--BOOKING REQUEST ID--></th>
                <th>PASSENGER</th>
                <th>MOBILE NO</th>
                <th>INCOME</th>
                <th>TOTAL FEE</th>
                <th>STATUS</th>
                <th>DATE RESERVED</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($result as $row):?>
            <tr>
                <!--<td><?php /*echo $row['regcode']; */?></td>-->
                <td><?php echo $row['pnr']; ?></td>
                <!--<td><?php /*echo $row['machine_id']; */?></td>-->
                <td><?php echo strlen($tkt = $row['booking_id'])>0? $tkt : 'N/A'; ?></td>
                <td>
                    <?php
                    foreach(explode('|*|',$row['passenger_str']) as $p):
                        $p = explode('|^@^|',$p);
                            $name = explode(':', $p[2])[1].' '.explode(':', $p[3])[1]; ?>
                        <div>
                            <?php echo $name ?>
                        </div>
                    <?php endforeach; ?>
                </td>
                <td><?php echo $row['mobileno']; ?></td>
                <td style="text-align:right;">{{<?php echo $row['markupFee']; ?>|currency:''}}</td>
                <td style="text-align:right;">{{<?php echo $row['totalFee']; ?>|currency:''}}</td>
                <td><?php echo $row['status']==0?'RESERVED':($row['status']==1?'ISSUED':'N/A'); ?></td>
                <td>{{formatTime('<?php echo $row['created_date']; ?>')|date:'medium'}}</td>
                <td>
                    <?php if ($row['status'] == 1): ?>
                        <a href="http://172.16.16.13:8001/portal/abacus_ticketing_domestic_receipt/<?php echo $row['bookingrequest_id']; ?>" class="btn btn-danger btn-sm" target="_blank">Print<span aria-hidden="true">&rarr;</span></a>

                    <?php else: ?>
                        <form action="<?php echo BASE_URL() ?>Abacus_<?php echo $menu == 'int' ? 'International' : 'Domestic' ?>_Flights/issue_ticket" method="post" name="myForm">
                            <input type="hidden" value="<?php echo $row['pnr']; ?>" name="pnr">
                            <input type="hidden" value="<?php echo $row['bookingrequest_id']; ?>" name="bookingrqid">
                            <button type="submit" name="btnViewDetails" class="btn btn-primary btn-sm">Issue<span aria-hidden="true">&rarr;</span></button>
                        </form>
                    <?php endif; ?>

                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <?php endif; ?>
    </div>

</div>
