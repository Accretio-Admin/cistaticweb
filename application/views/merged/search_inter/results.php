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
                <h4>INTERNATIONAL FLIGHTS</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->


    <div class="contentpanel" ng-app="myApp" ng-controller="myCtrl" ng-cloak ng-init="details='a'">
        <p>
            <a href="search_flights" class="btn btn-default-alt"><span aria-hidden="true">&larr;</span> Back</a>
        </p>
        <?php if(isset($output)):?>

        <?php else: ?>

            <div class="list-group col-md-10 col-md-offset-1" ng-init="shown='0'">
            <?php $flights = $data1['flights']; ?>
            <?php foreach ($flights as $i => $f): ?>
                <div class="list-group-item hover" style="margin-bottom: 10px; {{shown=='<?php echo $i;?>'?'border:1px solid #2196F3;':''}}" ng-click="shown= shown=='<?php echo $i; ?>'? '-1':'<?php echo $i; ?>'">
                    <form method="post" action="#" class="myform">

                        <div class="row">
                        <div class="col-md-3">
                            <img src="<?php echo base_url('/assets/images/online_booking') . '/' . $f[0]['onward'][0]['CarrierID'] . '.png' ?>">
                        </div>
                        <div class="col-md-7">
                            <table width="100%" style="margin-bottom: 0;" class="table">
                                <tbody>
                                <tr style="border:none;">
                                    <td valign="top" style="border:none;" width="25%">
                                        <div>
                                            <?php echo $f[0]['onward'][0]['CarrierID'] . ' - ' . $f[0]['onward'][0]['FlightNumber']; ?>
                                        </div>
                                        <div style="font-size:12px;">
                                            {{dateDiff('<?php echo $f[0]['onward'][0]['DepartureTimeStamp']; ?>','<?php echo $f[0]['onward'][count($f[0]['onward']) - 1]['ArrivalTimeStamp']; ?>')}}
                                        </div>
                                    </td>
                                    <td valign="top" style="border:none;" width="25%">
                                        <div>
                                            {{formatTime('<?php echo $f[0]['onward'][0]['DepartureTimeStamp']; ?>')|date:'HH:mm'}}
                                        </div>
                                        <div style="font-size:12px;">
                                            <?php echo $f[0]['onward'][0]['SourceDesc']; ?>
                                        </div>
                                    </td>
                                    <td valign="top" style="border:none;" width="25%">
                                        <div>
                                            {{formatTime('<?php echo $f[0]['onward'][count($f[0]['onward']) - 1]['ArrivalTimeStamp']; ?>')|date :'HH:mm'}}
                                        </div>
                                        <div style="font-size:12px;">
                                            <?php echo $f[0]['onward'][count($f[0]['onward']) - 1]['DestinationDesc']; ?>
                                        </div>
                                    </td>

                                    <td valign="top" style="border:none;" width="25%">
                                        <div style="font-size:13px;">
                                            <?php $bk = $f[0]['onward'][0]['ResBookDesigCode'];

                                            switch($f[0]['onward'][0]['Class']){
                                                case 'Y':
                                                    switch($bk){
                                                        case'V':case'B':case'X':case'K':case'E':case'T':case'U':case'O':
                                                            echo 'Budget Economy';
                                                            break;
                                                        case'Y':case'S':case'L':case'M':case'H':case'Q':
                                                            echo 'Regular Economy';
                                                            break;
                                                        case'W':case'N':
                                                            echo 'Premium Economy';
                                                            break;
                                                        default:
                                                            echo 'Economy';
                                                            break;
                                                    }
                                                    break;
                                                case 'S':
                                                    echo 'Premium Economy';
                                                    break;
                                                case 'C':
                                                    echo 'Business Class';
                                                    break;
                                                case 'J':
                                                    echo 'Premium Business Class';
                                                    break;
                                                case 'F':
                                                    echo 'First Class';
                                                    break;
                                                case 'P':
                                                    echo 'Premium First Class';
                                                    break;
                                                default:
                                                    echo $f[0]['onward'][0]['Class'];
                                                    break;
                                            }

                                            ?>
                                        </div'
                                        <div style="font-size:12px;">
                                            <?php echo ($f[count($f)-1]['pricing'][0]['Breakdown'][0]['Endorsements']['NonRefundableIndicator']=='false')?'Refundable':'NonRefundable'; ?>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-2">
                            <div class="pull-right">
                                <div style="margin-bottom:5px;">
                                    {{<?php echo (count($f) == 2) ? $f[1]['pricing'][0]['TotalFee'] : $f[2]['pricing'][0]['TotalFee']; ?>|currency: "₱ "}}
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary" ng-click="$event.stopPropagation()" name="btn_chooseflight">Choose</button>
                                </div>
                            </div>
                        </div>
                    </div>

                        <ul ng-click="$event.stopPropagation()" class="nav nav-tabs"
                            style="padding-left:20px;background:none; border-left: none;border-right: none;border-top: none;"
                            ng-show="shown=='<?php echo $i; ?>'">
                            <li class="nav-item">
                                <a class="nav-link {{(details+shown)=='a'+shown?'active':''}}"
                                   style="{{(details+shown)=='a'+shown?'color:#EF6C00;':''}}" ng-click="details='a'">Flights</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{(details+shown)=='b'+shown?'active':''}}"
                                   style="{{(details+shown)=='b'+shown?';color:#EF6C00;':''}}" ng-click="details='b'">Pricing</a>
                            </li>
                        </ul>

                        <div ng-click="$event.stopPropagation()" ng-show="(details+shown)=='a<?php echo $i; ?>'">
                            <?php $onward_str = ''; ?>
                            <?php foreach ($f[0]['onward'] as $_i => $o): ?>
                                <?php $onward_str .= $o['CarrierID'] . '|^@^|' . $o['FlightNumber'] . '|^@^|' . $o['Source'] . '|^@^|' . $o['Destination'] . '|^@^|' . $o['DepartureTimeStamp'] . '|^@^|' . $o['ArrivalTimeStamp'] . '|^@^|' . $o['Class'] . '|^@^|' . ''/*resbookdesigcode*/ . '|^@^|' . $o['ResBookDesigCode'] . '|^@^|' . $o['MarketingAirline'] . '|^@^|' . $o['OperatingAirline'] . $_str=($_i < (count($f[0]['onward']) - 1) ? '|*|' : ''); ?>
                                <?php echo $_i == 0 ? '' : '<hr>'; ?>
                                <div class="row" style="margin-top:10px;">
                                    <div class="col-lg-2">
                                        <div class="text-center">
                                            <img
                                                src="<?php echo base_url('/assets/images/online_booking') . '/' . $o['CarrierID'] . '.png' ?>">
                                        </div>
                                        <div style="font-size:13px;" class="text-center">
                                            <?php echo $o['CarrierID'] . ' - ' . $o['FlightNumber']; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div style="font-size:12px;" class="text-center">
                                            {{dateDiff('<?php echo $o['DepartureTimeStamp']; ?>','<?php echo $o['ArrivalTimeStamp']; ?>')}}
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="row col-lg-8 col-xs-6">
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="col-xs-3">
                                                            <img
                                                                src="<?php echo base_url('/assets/icon/ic_flight_takeoff_black_36dp_1x'); ?>">
                                                        </div>
                                                        <div class="col-xs-9">
                                                            <div style="font-size:16px;">
                                                                {{formatTime('<?php echo $o['DepartureTimeStamp']; ?>')|date:'HH:mm'}}
                                                            </div>
                                                            <div style="font-size:12px;">
                                                                {{formatTime('<?php echo $o['DepartureTimeStamp']; ?>')|date:'d MMM yyyy'}}
                                                            </div>
                                                            <div>
                                                                <?php echo $o['Source']; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="col-xs-3">
                                                            <img
                                                                src="<?php echo base_url('/assets/icon/ic_flight_land_black_36dp_1x'); ?>">
                                                        </div>
                                                        <div class="col-xs-9">
                                                            <div style="font-size:16px;">
                                                                {{formatTime('<?php echo $o['ArrivalTimeStamp']; ?>')|date:'HH:mm'}}
                                                            </div>
                                                            <div style="font-size:12px;">
                                                                {{formatTime('<?php echo $o['ArrivalTimeStamp']; ?>')|date:'d MMM yyyy'}}
                                                            </div>
                                                            <div>
                                                                <?php echo $o['Destination']; ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-xs-6" style="font-size:12px">
                                                BaggageDisplay(Under Development)
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            <?php endforeach; ?>
                            <?php $f_return = count($f) == 3 ? $f[1]['return'] : array(); ?>
                            <?php $return_str = ''; ?>
                            <?php foreach ($f_return as $_i => $r): ?>
                                <?php $return_str .= $r['CarrierID'] . '|^@^|' . $r['FlightNumber'] . '|^@^|' . $r['Source'] . '|^@^|' . $r['Destination'] . '|^@^|' . $r['DepartureTimeStamp'] . '|^@^|' . $r['ArrivalTimeStamp'] . '|^@^|' . $r['Class'] . '|^@^|' . ''/*resbookdesigcode*/ . '|^@^|' . $r['ResBookDesigCode'] . '|^@^|' . $r['MarketingAirline'] . '|^@^|' . $r['OperatingAirline'] . $_str=($_i < (count($f_return) - 1) ? '|*|' : ''); ?>
                                <div class="row" style="margin-top:10px;">
                                    <div class="col-lg-2">
                                        <div class="text-center">
                                            <img
                                                src="<?php echo base_url('/assets/images/online_booking') . '/' . $r['CarrierID'] . '.png' ?>">
                                        </div>
                                        <div style="font-size:13px;" class="text-center">
                                            <?php echo $r['CarrierID'] . ' - ' . $r['FlightNumber']; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div style="font-size:12px;" class="text-center">
                                            {{dateDiff('<?php echo $r['DepartureTimeStamp']; ?>','<?php echo $r['ArrivalTimeStamp']; ?>')}}
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="row col-lg-8 col-xs-6">
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="col-xs-3">
                                                            <img
                                                                src="<?php echo base_url('/assets/icon/ic_flight_takeoff_black_36dp_1x'); ?>">
                                                        </div>
                                                        <div class="col-xs-9">
                                                            <div style="font-size:16px;">
                                                                {{formatTime('<?php echo $r['DepartureTimeStamp']; ?>')|date:'HH:mm'}}
                                                            </div>
                                                            <div style="font-size:12px;">
                                                                {{formatTime('<?php echo $r['DepartureTimeStamp']; ?>')|date:'d MMM yyyy'}}
                                                            </div>
                                                            <div>
                                                                <?php echo $r['Source']; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="col-xs-3">
                                                            <img
                                                                src="<?php echo base_url('/assets/icon/ic_flight_land_black_36dp_1x'); ?>">
                                                        </div>
                                                        <div class="col-xs-9">
                                                            <div style="font-size:16px;">
                                                                {{formatTime('<?php echo $r['ArrivalTimeStamp']; ?>')|date:'HH:mm'}}
                                                            </div>
                                                            <div style="font-size:12px;">
                                                                {{formatTime('<?php echo $r['ArrivalTimeStamp']; ?>')|date:'d MMM yyyy'}}
                                                            </div>
                                                            <div>
                                                                <?php echo $r['Destination']; ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-xs-6" style="font-size:12px">
                                                BaggageDisplay(Under Development)
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div ng-click="$event.stopPropagation()" ng-show="(details+shown)=='b<?php echo $i; ?>'">
                            <?php ?>
                            <table width="100%" style="margin-bottom: 0; margin-top:10px;" class="table">
                                <thead>
                                <th style="border:none;" class="text-left">Passenger</th>
                                <th style="border:none;" class="text-center">BaseFare</th>
                                <th style="border:none;" class="text-center">Taxes & Fees</th>
                                <th style="border:none;" class="text-right">TotalFare</th>
                                </thead>
                                <tbody>
                                <?php $pricing = $f[count($f) - 1]['pricing'][0]; ?>
                                <?php $adultcount = 0; ?>
                                <?php $childrencount = 0; ?>
                                <?php $infantcount = 0; ?>
                                <?php $seniorcount = 0; ?>
                                <?php $breakdowns = $pricing['Breakdown']; ?>
                                <?php foreach ($breakdowns as $breakdown): ?>
                                    <?php
                                    switch ($breakdown['PassengerTypeQuantity']['Code']) {
                                        case 'ADT':
                                            $adultcount = ($adultcount>0) ? $adultcount + $breakdown['PassengerTypeQuantity']['Quantity'] : $adultcount + $breakdown['PassengerTypeQuantity']['Quantity'];
                                            break;
                                        case 'CNN':
                                            $childrencount = ($childrencount>0) ? $childrencount + $breakdown['PassengerTypeQuantity']['Quantity'] : $breakdown['PassengerTypeQuantity']['Quantity'];
                                            break;
                                        case 'INF':
                                            $infantcount = ($infantcount>0) ? $infantcount + $breakdown['PassengerTypeQuantity']['Quantity'] : $breakdown['PassengerTypeQuantity']['Quantity'];
                                            break;
                                        case 'SRC':
                                            $seniorcount = ($seniorcount>0) ? $seniorcount + $breakdown['PassengerTypeQuantity']['Quantity'] : $breakdown['PassengerTypeQuantity']['Quantity'];
                                            break;
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $breakdown['PassengerTypeQuantity']['Quantity'] . ' - ' . str_replace('INF','Infant',str_replace('CNN','Child',str_replace('SRC','Senior',str_replace('ADT','Adult',$breakdown['PassengerTypeQuantity']['Code'])))); ?></td>
                                        <td class="text-center">
                                            <?php echo ($a = $breakdown['PassengerFare']['BaseFare']['CurrencyCode']) != 'PHP' ? $a : ''; ?>
                                            {{<?php echo $breakdown['PassengerFare']['BaseFare']['Amount']; ?>|currency:""}}
                                        </td>
                                        <td class="text-center">
                                            <?php echo ($a = $breakdown['PassengerFare']['TaxesnFees']['CurrencyCode']) != 'PHP' ? $a : ''; ?>
                                            {{<?php echo $breakdown['PassengerFare']['TaxesnFees']['Amount']; ?>|currency:""}}
                                        </td>
                                        <td class="text-right">
                                            <?php echo ($a = $breakdown['PassengerFare']['TotalFare']['CurrencyCode']) != 'PHP' ? $a : ''; ?>
                                            {{<?php echo $breakdown['PassengerFare']['TotalFare']['Amount']; ?>|currency:""}}
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td><b>TotalFee</b></td>
                                    <td colspan="3" class="text-right">
                                        {{<?php echo $f[count($f) - 1]['pricing'][0]['TotalFee']; ?>| currency:"₱ "}}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!--<input type="hidden" name="rqid"    value="<?php /*echo $data1['rqid']; */?>">
                        <input type="hidden" name="onward" value="<?php /*echo $onward_str; */?>">
                        <input type="hidden" name="return" value="<?php /*echo $return_str; */?>">
                        <input type="hidden" name="pricing" value="<?php /*echo $pricing_str; */?>">
                        <input type="hidden" name="adult" value="<?php /*echo $adultcount; */?>">
                        <input type="hidden" name="children" value="<?php /*echo $childrencount; */?>">
                        <input type="hidden" name="infant" value="<?php /*echo $infantcount; */?>">
                        <input type="hidden" name="senior" value="<?php /*echo $seniorcount; */?>">-->
                        <textarea name="data1" hidden><?php echo json_encode($data1,true);?></textarea>
                        <input type="hidden" name="chosen" value="<?php echo $i;?>">
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

        <?php endif; ?>
    </div><!-- contentpanel -->

</div><!-- mainpanel -->

