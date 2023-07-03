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
                <h4><?php echo $menu == 'int' ? 'INTERNATIONAL' : 'DOMESTIC' ?> FLIGHTS</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel" style="padding-bottom: 0px;">

        <?php if (isset($output) && $output['S'] == 0): ?>
            <div><?php echo $output['M']; ?></div>
        <?php else:
            $customerinfo = $result['CustomerInfo'];
            $flightinfo = $result['FlightInfo'];
            $priceinfo = $result['PriceInfo'];
            $baggages = $result['baggages']; ?>
            <p>
                <a href="<?php echo BASE_URL() ?>Abacus_<?php echo $menu == 'int' ? 'International' : 'Domestic' ?>_Flights/issue_ticket" class="btn btn-default-alt"><span aria-hidden="true">&larr;</span> Back</a>
            </p>



            <div class="row">

                <div class="col-md-12">
                    <div class="panel panel-info">
                        <!-- Default panel contents -->
                        <div class="panel-heading">
                            <h3 class="panel-title">Flight Info</h3>
                        </div>
                        <div class="panel-body">
                            <?php if(count($flightinfo)>0):?>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>FlightNumber</th>
                                        <th>Origin</th>
                                        <th>Destination</th>
                                        <th>Departure</th>
                                        <th>Arrival</th>
                                        <th>MealCode</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($flightinfo as $row): ?>
                                        <tr>
                                            <td><?php echo $row['MarketingAirline']['Code'] . '-' . $row['FlightNumber']; ?></td>
                                            <td><?php echo $row['OriginLocation']; ?></td>
                                            <td><?php echo $row['DestinationLocation']; ?></td>
                                            <td><?php echo $row['Departure']; ?></td>
                                            <td><?php echo $row['Arrival']; ?></td>
                                            <td><?php echo $row['MealCode']; ?></td>
                                            <td><?php echo $row['Status']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else:?>
                                No assigned with this PNR.
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="panel panel-info">
                        <!-- Default panel contents -->
                        <div class="panel-heading">
                            <h3 class="panel-title">Customer Info</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>PassengerType</th>
                                    <th>GivenName</th>
                                    <th>Surname</th>
                                    <th class="text-center">WithInfant</th>
                                    <th class="text-center">AddBaggage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($customerinfo as $row): ?>
                                    <tr>
                                        <td><?php echo $row['PassengerType']; ?></td>
                                        <td><?php echo $row['GivenName']; ?></td>
                                        <td><?php echo $row['Surname']; ?></td>
                                        <td class="text-center"><?php echo $row['WithInfant'] == 'true' ? 'YES' : 'NO'; ?></td>
                                        <td class="text-center" style="font-size:11px;">
                                            <?php foreach($flightinfo as $in => $f): ?>
                                            <div>
                                                Flight-<?php echo ($in+1); ?>
                                                <select>
                                                    <option>No Adtl. Bagg.</option>
                                                    <?php foreach($baggages[$in+1] as $bag): ?>
                                                        <option><?php echo $bag['TTLPrice']['Currency'].$bag['TTLPrice']['Price'].' - '.$bag['CommercialName'];?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>

                                            <?php endforeach; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <!-- Default panel contents -->
                        <div class="panel-heading">
                            <h3 class="panel-title">Pricing Info</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Quantity</th>
                                    <th>BaseFare</th>
                                    <th>Taxes</th>
                                    <th>Markup</th>
                                    <th>SystemFee</th>
                                    <th>TotalFare</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($priceinfo['PriceQuotes'] as $row): ?>
                                    <tr>
                                        <td><?php echo $row['PassengerTypeQuantity']['Code']; ?></td>
                                        <td><?php echo $row['PassengerTypeQuantity']['Quantity']; ?></td>
                                        <td><?php echo number_format((float)$row['Totals']['BaseFare'], 2); ?></td>
                                        <td><?php echo number_format((float)$row['Totals']['Taxes'], 2); ?></td>
                                        <td><?php echo number_format((float)$row['TotalFare']['Markup'], 2); ?></td>
                                        <td><?php echo number_format((float)$row['TotalFare']['SysFee'], 2); ?></td>
                                        <td><?php echo number_format((float)$row['TotalFare']['Amount'], 2); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td>Total</td>
                                    <td></td>
                                    <td><?php echo number_format($priceinfo['PriceQuoteTotals']['BaseFare'], 2); ?></td>
                                    <td><?php echo number_format($priceinfo['PriceQuoteTotals']['Tax'], 2); ?></td>
                                    <td><?php echo number_format($priceinfo['PriceQuoteTotals']['Markup'], 2); ?></td>
                                    <td><?php echo number_format($priceinfo['PriceQuoteTotals']['SysFee'], 2); ?></td>
                                    <td><?php echo number_format($priceinfo['PriceQuoteTotals']['TotalFare'], 2); ?></td>
                                </tr>
                                </tbody>
                            </table>
                            <div >
                                <form class="pull-left">
                                    <button type="button" class="btn btn-danger">Cancel Reservation</button>
                                </form>

                                <form class="pull-right" action="<?php echo BASE_URL() ?>Abacus_<?php echo $menu == 'int' ? 'International' : 'Domestic' ?>_Flights/issue_ticket" method="post">
                                    <input type="hidden" name="pnr" value="<?php echo $pnr; ?>">
                                    <input type="hidden" name="bookingrqid" value="<?php echo $bookingrqid; ?>">
                                    <button type="submit" class="btn btn-primary" name="btnIssue">Issue Ticket</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        <?php endif; ?>
    </div>

</div>
