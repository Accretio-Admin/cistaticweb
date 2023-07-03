<div class="mainpanel" ng-app="myApp" ng-controller="myCtrl" ng-cloak>
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
                <h4>DOMESTIC FLIGHTS</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->


    <div class="contentpanel" >
        <div style="padding-bottom: 10px;">
            <form method="post" action="#" class="myform">
                <button type="submit" name="btn_chooseflight" class="btn btn-default-alt" style="background-color: transparent;"><span aria-hidden="true">&larr;</span> Back</button>
                <textarea name="data" hidden><?php echo json_encode($data, true); ?></textarea>
                <textarea name="chosen_onward" hidden><?php echo json_encode($chosen_onward,true);?></textarea>
                <textarea name="chosen_return" hidden><?php echo json_encode($chosen_return,true);?></textarea>
                <textarea name="passengers" hidden><?php echo json_encode($passengers,true); ?></textarea>
                <textarea name="contacts" hidden><?php echo json_encode($contacts,true); ?></textarea>
                <textarea name="onward_baggage" hidden><?php echo json_encode($onward_baggage,true);?></textarea>
                <textarea name="return_baggage" hidden><?php echo json_encode($return_baggage,true);?></textarea>

                <?php if(isset($output) && $output['S']==0):?>
                    <?php
                        if(isset($_POST['btn_search_another'])) {
                            session_destroy();
                        }
                    ?>
                    <button type="submit" name="btn_search_another" class="pull-right btn btn-default-alt" style="background-color: ;">Search Another <span aria-hidden="true">&rarr;</span></button>
                <?php endif;?>
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
                    <th>Journey</th>
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
                    <?php $onwards = $data['results_onward'][$chosen_onward['provider']][$chosen_onward['index']]; ?>
                    <?php $returns = $data['results_return'][$chosen_return['provider']][$chosen_return['index']]; ?>
                    <?php foreach($onwards['Flights'] as $o): ?>
                        <tr>
                            <td>Onward

                            </td>
                            <td><?php echo $o['Carrier']; ?></td>
                            <td><?php echo $o['CarrierID'].'-'.$o['FlightNumber']; ?></td>
                            <td class="text-center"><?php echo $chosen_onward['provider']=='abacus'?$o['SourceDesc']:$o['Source']; ?></td>
                            <td class="text-center"><?php echo $chosen_onward['provider']=='abacus'?$o['DestinationDesc']:$o['Destination']; ?></td>
                            <td class="text-center">{{formatTime('<?php echo $o['DepartureTimeStamp']; ?>')|date:'d MMM yyyy'}}</td>
                            <td class="text-center">{{formatTime('<?php echo $o['ArrivalTimeStamp']; ?>')|date:'d MMM yyyy'}}</td>
                            <td class="text-center">
                                <?php $bk = $o['ResBookDesigCode'];
                                    if($bk=='V' || $bk=='B' || $bk=='X' || $bk=='K' || $bk=='E' || $bk=='T' || $bk=='U' || $bk=='O'){
                                        echo 'Budget Economy';
                                    }else if($bk=='Y' || $bk=='S' || $bk=='L' || $bk=='M' || $bk=='H' || $bk=='Q'){
                                        echo 'Regular Economy';
                                    }else if($bk=='W' || $bk=='N'){
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
                            <td class="text-center"><?php echo ($o['TicketType']=='true'||$o['TicketType']=='E')? 'E-Ticket':$o['TicketType']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php foreach($returns['Flights'] as $r): ?>
                        <tr>
                            <td>Return</td>
                            <td><?php echo $r['Carrier']; ?></td>
                            <td><?php echo $r['CarrierID'].'-'.$r['FlightNumber']; ?></td>
                            <td class="text-center"><?php echo $chosen_return['provider']=='abacus'?$r['SourceDesc']:$r['Source']; ?></td>
                            <td class="text-center"><?php echo $chosen_return['provider']=='abacus'?$r['DestinationDesc']:$r['Destination']; ?></td>
                            <td class="text-center">{{formatTime('<?php echo $r['DepartureTimeStamp']; ?>')|date:'d MMM yyyy'}}</td>
                            <td class="text-center">{{formatTime('<?php echo $r['ArrivalTimeStamp']; ?>')|date:'d MMM yyyy'}}</td>
                            <td class="text-center">
                                <?php $bk = $r['ResBookDesigCode'];
                                    if($bk=='V' || $bk=='B' || $bk=='X' || $bk=='K' || $bk=='E' || $bk=='T' || $bk=='U' || $bk=='O'){
                                            echo 'Budget Economy';
                                    }else if($bk=='Y' || $bk=='S' || $bk=='L' || $bk=='M' || $bk=='H' || $bk=='Q'){
                                        echo 'Regular Economy';
                                    }else if($bk=='W' || $bk=='N'){
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
                            <td class="text-center"><?php echo ($r['TicketType']=='true'||$r['TicketType']=='E')? 'E-Ticket':$r['TicketType']; ?></td>
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
                    <th>Title</th>
                    <th class="text-center">First Name</th>
                    <th class="text-center">Last Name</th>
                    <th class="text-center">Age</th>
                    <th class="text-center">Date of Birth</th>
                    <th class="text-center">Gender</th>
                    <?php if($data['Passengers']['Senior'] >= '1'): ?>
                        <th class="text-center">Senior ID</th>
                    <?php endif; ?>
                    <?php if($onward_baggage):?>
                    <th class="text-center">Onward Baggage</th>
                    <?php endif;?>
                    <?php if($chosen_return['index']>=0 && $return_baggage):?>
                    <th class="text-center">Return Baggage</th>
                    <?php endif;?>
<!--                    <th class="text-center" colspan="2">Fare</th>-->
                    </thead>
                    <tbody>
                    <?php foreach($passengers as $k => $t): ?>
                        <?php /*$ptype = $k=='adt'?'ADULT':($k=='src'?'SENIOR CITIZEN':($k=='cnn'?'CHILD':($k=='inf'?'INFANT':'')));*/?>

                        <?php foreach($t as $p):?>
                            <tr>
                                <td style="font-size:10px;"><?php echo strtoupper($k); ?></td>
                                <td class="text-left">
                                    <?php  
                                        if($p['TL'] == 1) {
                                            echo "Mr";
                                        } elseif ($p['TL'] == 2) {
                                            echo "Mrs";
                                        } elseif ($p['TL'] == 3) {
                                            echo "Miss";
                                        } elseif ($p['TL'] == 4) {
                                            echo "Mstr";
                                        }
                                    ?>
                                </td>
                                <td class="text-center"><?php echo $p['FN']; ?></td>
                                <td class="text-center"><?php echo $p['LN']; ?></td>
                                <?php if($k=='inf' || $k=='Infant'): ?>
                                    <td class="text-center">{{getAgeInfant('<?php echo $p['DOB']; ?>')}}<span style="font-size:10px;">MONTH(S)</span></td>
                                <?php else: ?>
                                    <td class="text-center">{{getAge('<?php echo $p['DOB']; ?>')}}<span style="font-size:10px;">YEAR(S)</span></td>
                                <?php endif; ?>
                                <td class="text-center"><?php echo $p['DOB']; ?></td>
                                <td class="text-center"><?php echo $p['gender']; ?></td>
<!--                                <td class="text-center">--><?php //echo strlen($p['S'])>0?$p['S']:'Not Specified'; ?><!--</td>-->
                                <?php if($data['Passengers']['Senior'] >= '1'): ?>
                                    <td class="text-center"><?php echo strlen($p['S'])>0?$p['S']:'Not Specified'; ?></td>
                                <?php endif; ?>
                                <td class="text-center">
                                    <?php if($onward_baggage):?>
                                    <?php echo strpos($onward_baggage[$p['OB']],';')<=1?$onward_baggage[$p['OB']]:'PHP '.explode(';',$onward_baggage[$p['OB']])[1].' - '.explode(';',$onward_baggage[$p['OB']])[0].'KG';?>
                                    <?php endif;?>
                                </td>
                                <?php if($chosen_return['index']>=0 && $return_baggage):?>
                                <td class="text-center"><?php echo strpos($return_baggage[$p['RB']],';')<=1?$return_baggage[$p['RB']]:'PHP '.explode(';',$return_baggage[$p['RB']])[1].' - '.explode(';',$return_baggage[$p['RB']])[0].'KG';?></td>
                                <?php endif; ?>
<!--                                <td><?php /*echo ($val = $p['Fare']['Code']=='PHP')? '₱ ': $val; */?></td>
                                <td class="text-right">
                                    {{<?php /*echo $p['Fare']['Amount']; */?>|currency:''}}
                                </td>-->
                                <?php $label = $i_b>1?:$bag;?>
                            </tr>
                        <?php endforeach;?>
                    <?php endforeach; ?>

                    <?php if($chosen_onward['provider']=='abacus' || $chosen_return['provider']=='abacus'): ?>
                        <tr>
                            <th colspan="8">Additional Services <small>( Free Baggage of Philippine Airlines )</small></th>
                        </tr>
                        <tr>
                            <td colspan="4" style="border-top: none;">
                                <label><span class="text-danger">*</span>Free Onward Baggage : </label>
                                <span class="text-danger">
                                    <?php //foreach($onwards['Flights'] as $o): ?>
                                        <?php $bk = $o['ResBookDesigCode'];
                                            if($bk=='V' || $bk=='B' || $bk=='X' || $bk=='K' || $bk=='E' || $bk=='T' || $bk=='U' || $bk=='O'){
                                                // echo 'Budget Economy';
                                                echo 'Free baggage allowance 10KG and 7kg hand carry';
                                            }else if($bk=='Y' || $bk=='S' || $bk=='L' || $bk=='M' || $bk=='H' || $bk=='Q'){
                                                // echo 'Regular Economy';
                                                echo 'Free baggage allowance 20KG and 7kg hand carry';
                                            }else if($bk=='W' || $bk=='N'){
                                                // echo 'Premium Economy';
                                                echo 'Free baggage allowance 25KG and 7kg hand carry';
                                            }else {
                                                echo 'No Free baggage available. Please Add baggage';
                                            }
                                        ?>
                                    <?php //endforeach; ?>
                                </span>
                            </td>
                            <?php if($chosen_return['index']>=0): ?>
                                <td colspan="4" style="border-top: none;">
                                    <label><span class="text-danger">*</span>Free Return Baggage : </label>
                                    <span class="text-danger">
                                        <?php //foreach($returns['Flights'] as $r): ?>
                                            <?php $bk = $r['ResBookDesigCode'];
                                                if($bk=='V' || $bk=='B' || $bk=='X' || $bk=='K' || $bk=='E' || $bk=='T' || $bk=='U' || $bk=='O'){
                                                    // echo 'Budget Economy';
                                                    echo 'Free baggage allowance 10KG and 7kg hand carry';
                                                }else if($bk=='Y' || $bk=='S' || $bk=='L' || $bk=='M' || $bk=='H' || $bk=='Q'){
                                                    // echo 'Regular Economy';
                                                    echo 'Free baggage allowance 20KG and 7kg hand carry';
                                                }else if($bk=='W' || $bk=='N'){
                                                    // echo 'Premium Economy';
                                                    echo 'Free baggage allowance 25KG and 7kg hand carry';
                                                }else {
                                                    echo 'No Free baggage available. Please Add baggage';
                                                }
                                            ?>
                                        <?php //endforeach; ?>
                                    </span>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endif;?>
                        
                    <tr>
                        <td colspan="<?php echo $chosen_onward['index']>=0?'9':'8'?>">
                            <div class="pull-right" style="font-size:20px;font-weight: bold;">
                                <?php $o = $data['results_onward'][$chosen_onward['provider']][$chosen_onward['index']];
                                    $r = $data['results_return'][$chosen_return['provider']][$chosen_return['index']];
                                    $totalfee = $o['Pricing']['TotalFee'] + $r['Pricing']['TotalFee'];

                                foreach($passengers as $k => $t) {
                                    foreach ($t as $p) {
                                        if ($onward_baggage && $p['OB'] > 1 && strpos($onward_baggage[$p['OB']], ';')) {
                                            $totalfee += explode(';', $onward_baggage[$p['OB']])[1];
                                        }
                                        if ($return_baggage && $chosen_return['index'] >= 0) {
                                            $totalfee += explode(';', $return_baggage[$p['RB']])[1];
                                        }
                                    }
                                }
                                ?>
                                Total Fee : {{<?php echo $totalfee;?>|currency:'<?php echo ($val = $o['Pricing']['currency'])=='PHP'?'₱ ':$val?>'}}
                            </div>
                        </td>
                    </tr>
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
        <div class="modal-dialog modal-md">

            <!-- Modal content-->
            <form method="post" class="myform" action="<?php echo BASE_URL()?>Ticketing_Domestic_Flights/search_flights">
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
                    <textarea name="passengersSTR" hidden>{{getPassengerSTR()}}</textarea>
                    <input type="hidden" name="street" value="{{c.street}}">
                    <input type="hidden" name="city" value="{{c.city}}">
                    <input type="hidden" name="zipcode" value="{{c.zipcode}}">
                    <input type="hidden" name="phone" value="{{c.contactno}}">
                    <textarea name="data" hidden><?php echo json_encode($data, true); ?></textarea>
                    <textarea name="chosen_onward" hidden><?php echo json_encode($chosen_onward, true); ?></textarea>
                    <textarea name="chosen_return" hidden><?php echo json_encode($chosen_return, true); ?></textarea>
                    <textarea name="passengers" hidden><?php echo json_encode($passengers,true); ?></textarea>
                    <textarea name="contacts" hidden><?php echo json_encode($contacts,true); ?></textarea>
                    <textarea name="onward_baggage" hidden><?php echo json_encode($onward_baggage,true);?></textarea>
                    <textarea name="return_baggage" hidden><?php echo json_encode($return_baggage,true);?></textarea>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <!-- <button type="submit" class="btn btn-primary" name="btn_proceed" data-toggle="modal" data-target="#modal_proceed">Proceed</button> -->
                        <button type="submit" class="btn btn-primary" name="btn_proceed">Proceed</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div><!-- mainpanel -->



