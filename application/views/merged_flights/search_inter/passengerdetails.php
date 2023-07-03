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


    <div class="contentpanel" ng-app="myApp" ng-controller="myCtrl" ng-cloak>
        <div style="padding-bottom: 10px;">
            <form method="post" action="#" class="myform">
                <button type="submit" name="btn_backfrompassengerdetails" class="btn btn-default-alt" style="background-color: transparent;"><span aria-hidden="true">&larr;</span> Back</button>
                <input type="hidden" name="rqid" value="<?php echo $rqid; ?>">
                <textarea name="data1" hidden><?php echo json_encode($data1, true); ?></textarea>
            </form>
        </div>


        <?php if(isset($output)): ?>
            <div class="col-md-8 col-md-offset-2">
                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    <?php echo $output['M'];?>
                </div>
            </div>
        <?php elseif($data1): ?>
            <?php $f = $data1['flights'][$chosen];?>
            <?php $pricing = $f[count($f) - 1]['pricing'][0]; ?>
            <div class="list-group col-md-12">
                <div class="list-group-item">
                    <div class="text-left" style="font-size: 20px;">
                        <b>Breakdown</b>
                    </div>
                    <div class="text-right" style="font-size: 20px;"><b style="color:#03A9F4;">TOTAL FEE : {{<?php echo strlen($pricing['TotalFee'])>0?$pricing['TotalFee']:'0'; ?>|currency: "₱ "}}</b></div>
                    <div>
                        <table class="table">
                            <thead>

                            <tr>
                                <th class="text-center">Passenger</th>
                                <th class="text-center">Booking Class</th>
                                <th class="text-center">Meal</th>
                                <th class="text-center">Baggage</th>
                                <th class="text-center">NonRefundable</th>
                                <th class="text-center">Base Fare</th>
                                <th class="text-center">Tax & Fees</th>
                                <th class="text-center">Total Fare</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($pricing['Breakdown'] as $bd): ?>
                                <tr>
                                    <?php switch($bd['PassengerTypeQuantity']['Code']){
                                        case 'ADT':
                                            $ptype = 'ADULT';
                                            break;
                                        case 'SRC':
                                            $ptype = 'SENIOR';
                                            break;
                                        case 'CNN':
                                            $ptype = 'CHILD';
                                            break;
                                        case 'INF':
                                            $ptype = 'INFANT';
                                            break;
                                    }?>

                                    <td class="text-center" style="font-size:10px; vertical-align: middle;"><?php echo $bd['PassengerTypeQuantity']['Quantity'].' - '.$ptype; ?></td>
                                    <td class="text-center">
                                        <?php  foreach($bd['FareInfos'] as $finfo): ?>
                                            <div>
                                                <?php
                                                switch($finfo['FareReference']){
                                                    case 'Y':
                                                        switch($finfo['FareReference']){
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
                                                }?>
                                            </div>
                                        <?php endforeach; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php  foreach($bd['FareInfos'] as $finfo): ?>
                                            <div><?php echo $finfo['Meal'];?></div>
                                        <?php endforeach; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php  foreach($bd['PassengerFare']['BaggageInformation'] as $bgge): ?>
                                            <div><?php echo $bgge['Allowance']['Weight'].$bgge['Allowance']['Unit'];?></div>
                                        <?php endforeach; ?>
                                    </td>
                                    <td class="text-center" style="font-size:10px; vertical-align: middle;"><?php echo strtoupper($bd['Endorsements']['NonRefundableIndicator'])?></td>
                                    <td class="text-center"><?php echo $bd['PassengerFare']['BaseFare']['CurrencyCode']?> {{<?php echo $bd['PassengerFare']['BaseFare']['Amount']?>|currency: ""}}</td>
                                    <td class="text-center"><?php echo $bd['PassengerFare']['TaxesnFees']['CurrencyCode']?> {{<?php echo $bd['PassengerFare']['TaxesnFees']['Amount']?>|currency: ""}}</td>
                                    <td class="text-center"><?php echo $bd['PassengerFare']['TotalFare']['CurrencyCode']?> {{<?php echo $bd['PassengerFare']['TotalFare']['Amount']?>|currency: ""}}</td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="list-group col-md-12">
                <div class="list-group-item">
                    <div class="text-left" style="font-size: 20px;">
                        <b>Passenger Details</b>
                    </div>
                    <form method="post" action="#" class="myform">
                    <table class="table pad10">
                        <thead>
                        <th>Type</th>
                        <th class="text-center">First Name</th>
                        <th class="text-center">Last Name</th>
                        <th class="text-center">Age</th>
                        <th class="text-center">Date of Birth</th>
                        <th class="text-center">Gender</th>
                        <th class="text-center">Others/Remarks</th>
                        <th class="text-center">Meal</th>
                        <th class="text-center">Baggage</th>
                        </thead>
                        <tbody>
                        <?php $psngrs = array('ADT'=>0,'CNN'=>0,'INF'=>0,'SRC'=>0); ?>
                        <?php foreach($pricing['Breakdown'] as $b) : ?>
                            <?php for($c=0;$c<$b['PassengerTypeQuantity']['Quantity'];$c++): ?>
                                <?php $i = $psngrs[$b['PassengerTypeQuantity']['Code']];?>
                                <?php $ptype = str_replace('INF','INFANT',str_replace('CNN','CHILD',str_replace('SRC','SENIOR',str_replace('ADT','ADULT',$b['PassengerTypeQuantity']['Code'])))); ?>
                                <?php $pid = strtolower($b['PassengerTypeQuantity']['Code']);?>
                                <tr>
                                    <td style="font-size:11px;vertical-align: middle;"><?php echo $ptype; ?></td>
                                    <td class="text-center">
                                        <input type="name" ng-model="p.<?php echo $pid.'['.$i;?>].FN" class="input form-control" placeholder="First Name" required></td>
                                    <td class="text-center"><input type="name" ng-model="p.<?php echo $pid.'['.$i;?>].LN" class="input form-control" placeholder="Last Name" required></td>
                                    <?php if($pid=='inf'): ?>
                                        <td class="text-center" style="vertical-align: middle">{{getAgeInfant(p.inf[<?php echo $i;?>].DOB)}}<span style="font-size:10px;">MONTH(S)</span></td>
                                    <?php else: ?>
                                        <td class="text-center" style="vertical-align: middle">{{getAge(p.<?php echo $pid.'['.$i;?>].DOB)}}<span style="font-size:10px;">YEAR(S)</span></td>
                                    <?php endif; ?>
                                    <td class="text-center"><input type="text" class="form-control datepicker<?php echo $pid;?>" ng-init="p.<?php echo $pid.'['.$i;?>].DOB = p.<?php echo $pid.'['.$i;?>].DOB? p.<?php echo $pid.'['.$i;?>].DOB : startDate.<?php echo $pid; ?>" ng-model="p.<?php echo $pid.'['.$i;?>].DOB" style="max-width: 110px" placeholder="MM/DD/YYYY" required></td>
                                    <td class="text-center"><select ng-model="p.<?php echo $pid.'['.$i;?>].gender" class="form-control" required>
                                            <option value="">Select</option>
                                            <option value="M">Male</option>
                                            <option value="F">Female</option>
                                        </select></td>
                                    <td><input type="text" ng-model="p.<?php echo $pid.'['.$i;?>].R" class="form-control" placeholder="Remarks" style="max-width: 150px;"></td>
                                    <td class="text-center" style="font-size:12px;vertical-align: middle;" nowrap>
                                        <?php foreach($b['FareInfos'] as $_i => $finfo): ?>
                                            <div>
                                                <?php echo $finfo['Meal']; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </td>
                                    <td class="text-center" style="font-size:12px;vertical-align: middle;" nowrap>
                                        <input type="hidden" ng-init="p.<?php echo $pid.'['.$i;?>].Fare.Amount = ('<?php echo strlen($val = $b['PassengerFare']['TotalFare']['Amount'])>0 ? $val:0; ?>')" value="{{p.<?php echo $pid.'['.$i;?>].Fare.Amount}}">
                                        <input type="hidden" ng-init="p.<?php echo $pid.'['.$i;?>].Fare.Code = ('<?php echo $b['PassengerFare']['TotalFare']['CurrencyCode'];?>')" value="{{p.<?php echo $pid.'['.$i;?>].Fare.Code}}">
                                        <?php foreach($b['PassengerFare']['BaggageInformation'] as $_i => $bagg): ?>
                                            <div>
                                                <?php echo $bagg['Allowance']['Weight'].$bagg['Allowance']['Unit']; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </td>
                                </tr>
                                <?php $psngrs[$b['PassengerTypeQuantity']['Code']]++; ?>
                            <?php endfor;?>
                        <?php endforeach; ?>

                        </tbody>
                    </table>
                        <hr style="margin-top: 0px;">
                        <table class="table pad10" >
                            <tbody>
                            <tr>
                                <th colspan="4" style="border-top: none;">Contact Details</th>
                            </tr>
                            <tr class="pad10">
                                <td><input type="text" ng-model="c.contactno" class="form-control" placeholder="Contact No." required></td>
                                <td><input type="email" ng-model="c.emailadd" class="form-control" placeholder="Email Address" required></td>
                            </tr>
                            <tr>
                                <th colspan="4">Delivery Details</th>
                            </tr>
                            <tr class="pad10">
                                <td><input type="text" ng-model="c.street" class="form-control" placeholder="Street" required></td>
                                <td><input type="text" ng-model="c.city" class="form-control" placeholder="City" required></td>
                                <td><input type="text" ng-model="c.zipcode" class="form-control" placeholder="Zip Code" required></td>
                                <td><input type="text" ng-model="c.country" class="form-control" placeholder="Country" required></td>
                            </tr>
                            <tr>
                                <td colspan="7" style="">
                                    <textarea name="passengers" hidden>{{p|json}}</textarea>
                                    <textarea name="contacts" hidden>{{c|json}}</textarea>
                                    <textarea name="data1" hidden><?php echo json_encode($data1, true); ?></textarea>
                                    <input type="hidden" name="chosen" value="<?php echo $chosen; ?>">
                                    <!--<input type="hidden" name="passengerSTR" value="{{getPassengerSTR()}}">
                                    <input type="hidden" name="contactSTR" value="{{getotherdetailsSTR()}}">-->
                                    <button type="submit" class="btn btn-primary pull-right" name="btn_submitpassengerdetails">Submit</button>
                                </td>
                            </tr>

                            </tbody>
                        </table>

                    </form>
                </div>
            </div>

        <?php endif; ?>
    </div><!-- contentpanel -->

</div><!-- mainpanel -->

