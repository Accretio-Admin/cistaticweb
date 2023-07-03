<div class="mainpanel" ng-app="myApp" ng-controller="myCtrl">
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


    <div class="contentpanel" >
        <div style="padding-bottom: 10px;">
            <form method="post" action="#" class="myform">
                <button type="submit" name="btn_chooseflight" class="btn btn-default-alt" style="background-color: transparent;"><span aria-hidden="true">&larr;</span> Back</button>
                <textarea name="data1" hidden><?php echo json_encode($data1, true); ?></textarea>
                <input type="hidden" name="chosen" value="<?php echo $chosen; ?>">
                <textarea name="passengers" hidden><?php echo json_encode($passengers,true); ?></textarea>
                <textarea name="contacts" hidden><?php echo json_encode($contacts,true); ?></textarea>
            </form>
        </div>
        <?php if(isset($output) && $output['S']==0):?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                <?php echo $output['M'];?>
            </div>
        <?php endif;?>

        <div class="alert alert-info" role="alert">Please confirm the following details before you proceed.</div>

        <div class="list-group">
            <div class="list-group-item">
                <div class="text-left" style="font-size:20px;font-weight: bold;">
                    Flight Details
                </div>
                <table class="table" style="margin-top:10px;margin-bottom: 0px;">
                    <thead>
                    <th>Carrier</th>
                    <th>Flight No</th>
                    <th class="text-center">Source</th>
                    <th class="text-center">Destination</th>
                    <th class="text-center">Departure</th>
                    <th class="text-center">Arrival</th>
                    <th class="text-center">Booking Class</th>
                    <th class="text-center">Ticket Type</th>
                    </thead>
                    <tbody>
                    <?php $f =  $data1['flights'][$chosen]; ?>
                    <?php $onwards = $f[0]['onward']; ?>
                    <?php $returns = count($f)==3? $f[1]['return']:null;?>
                    <?php foreach($onwards as $o): ?>
                        <tr>
                            <td><?php echo $o['Carrier']; ?></td>
                            <td><?php echo $o['CarrierID'].'-'.$o['FlightNumber']; ?></td>
                            <td class="text-center"><?php echo $o['SourceDesc']; ?></td>
                            <td class="text-center"><?php echo $o['DestinationDesc']; ?></td>
                            <td class="text-center">{{formatTime('<?php echo $o['DepartureTimeStamp']; ?>')|date:'d MMM yyyy'}}</td>
                            <td class="text-center">{{formatTime('<?php echo $o['ArrivalTimeStamp']; ?>')|date:'d MMM yyyy'}}</td>
                            <td class="text-center">
                                <?php $bk = $o['ResBookDesigCode'];
                                if($bk=='V'||'B'||'X'||'K'||'E'||'T'||'U'||'O'){
                                    echo 'Budget Economy';
                                }else if('Y'||'S'||'L'||'M'||'H'||'Q'){
                                    echo 'Regular Economy';
                                }else if('W'||'N'){
                                    echo 'Premium Economy';
                                }else{
                                    switch($bk){
                                        case 'C': 'Business Class';
                                            break;
                                        case 'J': 'Premium Business Class';
                                            break;
                                        case 'F': 'First Class';
                                            break;
                                        case 'P': 'Premium First Class';
                                            break;
                                        default: echo $bk;
                                            break;
                                    }
                                }
                                ?>
                            </td>
                            <td class="text-center"><?php echo $o['TicketType']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php foreach($returns as $r): ?>
                        <tr>
                            <td><?php echo $r['Carrier']; ?></td>
                            <td><?php echo $r['CarrierID'].'-'.$r['FlightNumber']; ?></td>
                            <td class="text-center"><?php echo $r['SourceDesc']; ?></td>
                            <td class="text-center"><?php echo $r['DestinationDesc']; ?></td>
                            <td class="text-center">{{formatTime('<?php echo $r['DepartureTimeStamp']; ?>')|date:'d MMM yyyy'}}</td>
                            <td class="text-center">{{formatTime('<?php echo $r['ArrivalTimeStamp']; ?>')|date:'d MMM yyyy'}}</td>
                            <td class="text-center">
                                <?php $bk = $r['ResBookDesigCode'];
                                if($bk=='V'||'B'||'X'||'K'||'E'||'T'||'U'||'O'){
                                    echo 'Budget Economy';
                                }else if('Y'||'S'||'L'||'M'||'H'||'Q'){
                                    echo 'Regular Economy';
                                }else if('W'||'N'){
                                    echo 'Premium Economy';
                                }else{
                                    switch($bk){
                                        case 'C': 'Business Class';
                                            break;
                                        case 'J': 'Premium Business Class';
                                            break;
                                        case 'F': 'First Class';
                                            break;
                                        case 'P': 'Premium First Class';
                                            break;
                                        default: echo $bk;
                                            break;
                                    }
                                }
                                ?>
                            </td>
                            <td class="text-center"><?php echo $r['TicketType']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="list-group">
            <div class="list-group-item">
                <div class="text-left" style="font-size:20px;font-weight: bold;">
                    Passenger Details
                </div>
                <table class="table" style="margin-top:10px;margin-bottom: 0px;">
                    <thead>
                    <th>Type</th>
                    <th class="text-center">First Name</th>
                    <th class="text-center">Last Name</th>
                    <th class="text-center">Age</th>
                    <th class="text-center">Date of Birth</th>
                    <th class="text-center">Gender</th>
                    <th class="text-center">Others/Remarks</th>
                    <th class="text-center" colspan="2">Fare</th>
                    </thead>
                    <tbody>
                    <?php foreach($passengers as $k => $t): ?>
                        <?php $ptype = $k=='adt'?'ADULT':($k=='src'?'SENIOR CITIZEN':($k=='cnn'?'CHILD':($k=='inf'?'INFANT':'')));?>

                        <?php foreach($t as $p):?>
                            <tr>
                                <td style="font-size:10px;"><?php echo $ptype; ?></td>
                                <td class="text-center"><?php echo $p['FN']; ?></td>
                                <td class="text-center"><?php echo $p['LN']; ?></td>
                                <?php if($k=='inf'): ?>
                                    <td class="text-center">{{getAgeInfant('<?php echo $p['DOB']; ?>')}}<span style="font-size:10px;">MONTH(S)</span></td>
                                <?php else: ?>
                                    <td class="text-center">{{getAge('<?php echo $p['DOB']; ?>')}}<span style="font-size:10px;">YEAR(S)</span></td>
                                <?php endif; ?>
                                <td class="text-center"><?php echo $p['DOB']; ?></td>
                                <td class="text-center"><?php echo $p['gender']; ?></td>
                                <td class="text-center"><?php echo strlen($p['R'])>0?$p['R']:'Not Specified'; ?></td>
                                <td><?php echo ($val = $p['Fare']['Code']=='PHP')? '₱ ': $val; ?></td>
                                <td class="text-right">
                                    {{<?php echo $p['Fare']['Amount']; ?>|currency:''}}
                                </td>
                            </tr>
                        <?php endforeach;?>
                    <?php endforeach; ?>

                    </tbody>
                </table>

            </div>
        </div>
        <div class="list-group">
            <div class="list-group-item">
                <div class="text-left" style="font-size:20px;font-weight: bold;">
                    Delivery Details
                </div>
                <table class="table" style="margin-top:10px;margin-bottom: 0px;">
                    <thead>
                    <tr>
                        <th>Contact No</th>
                        <th>Email</th>
                        <th>Address</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $contacts['contactno']; ?></td>
                        <td><?php echo $contacts['emailadd']; ?></td>
                        <td><?php echo $contacts['street']; ?></td>
                        <td><?php echo $contacts['city']; ?></td>
                        <td><?php echo $contacts['zipcode']; ?></td>
                        <td><?php echo $contacts['country']; ?></td>

                    </tr>

                    <tr>
                        <td class="text-right" colspan="9"><button class="btn btn-primary" data-toggle="modal" data-target="#modal_proceed">Proceed</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div><!-- contentpanel -->


    <!-- Modal -->
    <div class="modal" id="modal_proceed" role="dialog">
        <div class="modal-dialog modal-md                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   ">

            <!-- Modal content-->
            <form method="post" class="myform" action="#">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" style="font-weight: bold;color: #4169E1;">TERMS AND CONDITIONS</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <p>All fares are subject to change until payment is made in full and all seats are subject to availability.</p>
                        </div>

                        <div class="form-group">
                            <p>By entering your transaction password, you agree that all of the <b>TERMS AND CONDITIONS</b> and <b>FARE RULES</b> contained herein apply to your use of the service.</p>
                        </div>

                        <input type="password" name="transpass" class="form-control" id="inputPassword" placeholder="Transaction Password" required>

                    </div>
                    <input type="hidden" name="rqid" value="<?php echo $data1['rqid']; ?>">
                    <textarea name="passengersSTR" hidden>{{getPassengerSTR()}}</textarea>
                    <input type="hidden" name="street" value="{{c.street}}">
                    <input type="hidden" name="city" value="{{c.city}}">
                    <input type="hidden" name="zipcode" value="{{c.zipcode}}">
                    <input type="hidden" name="phone" value="{{c.contactno}}">
                    <textarea name="data1" hidden><?php echo json_encode($data1, true); ?></textarea>
                    <input type="hidden" name="chosen" value="<?php echo $chosen; ?>">
                    <textarea name="passengers" hidden><?php echo json_encode($passengers,true); ?></textarea>
                    <textarea name="contacts" hidden><?php echo json_encode($contacts,true); ?></textarea>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="btn_proceed" data-toggle="modal" data-target="#modal_proceed">Proceed</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div><!-- mainpanel -->



