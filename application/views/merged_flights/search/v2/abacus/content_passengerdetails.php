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
                <h4>DOMESTIC FLIGHTS</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->


    <div class="contentpanel" ng-app="myApp" ng-controller="myCtrl" ng-cloak>
        <div style="padding-bottom: 10px;">
            <form method="post" action="#" class="myform">
                <button type="submit" name="btn_search" class="btn btn-default-alt" style="background-color: transparent;"><span aria-hidden="true">&larr;</span> Back</button>
                <textarea name="data" hidden><?php echo json_encode($data, true); ?></textarea>
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
        <?php elseif($data): ?>
            <?php
//            echo '<pre>';
//            print_r($chosen_onward['provider']);
//            print_r($chosen_return['provider']);
//            echo '</pre>';
            ?>
            <div class="list-group col-md-12">
                <div class="list-group-item">
                    <div class="text-left" style="font-size: 20px;">
                        <b>Passenger Details</b>
                    </div>

                    <?php if( ($chosen_onward['provider'] == 'abacus' && $chosen_return['provider'] == 'abacus') || ($chosen_onward['provider'] == 'abacus') ): ?>
<!--                        abacus!-->
                        <form method="post" action="#" class="myform">
                        <table class="table pad10">
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
                            <?php if($onwardbaggages): ?>
                            <th class="text-center">Onward Baggage</th>
                            <?php endif; ?>
                            <?php if($chosen_return['index']>=0 && $returnbaggages): ?>
                                <th class="text-center">Return Baggage</th>
                            <?php endif;?>
                            </thead>
                            <tbody>
                            <?php $passengers = $data['Passengers'];?>
                            <?php //print_r($passengers); ?>
                            <?php foreach($passengers as $ptype => $pcount):?>
                                <?php for($i=0;$i<$pcount;$i++): ?>
                                    <?php //echo $ptype; ?>
                                    <tr>
                                        <td style="font-size:11px;vertical-align: middle;"><?php echo strtoupper($ptype); ?></td>
                                        <?php if($ptype == 'Adult' || $ptype == 'Senior') { ?>
                                            <td class="text-center">
                                                <select ng-model="p.<?php echo $ptype.'['.$i;?>].TL" class="form-control" required>
                                                    <option value="">Select</option>
                                                    <option value="1">Mr</option>
                                                    <!-- <option value="2">Mrs</option> -->
                                                    <option value="2">Ms</option>

                                                    <!-- <option value="4">Mstr</option> -->
                                                </select>
                                            </td>
                                        <?php } else { ?>
                                            <td class="text-center">
                                                <select ng-model="p.<?php echo $ptype.'['.$i;?>].TL" class="form-control" required>
                                                    <option value="">Select</option>
                                                    <!-- <option value="1">Mr</option> -->
                                                    <!-- <option value="2">Mrs</option> -->
                                                    <option value="3">Miss</option>
                                                    <option value="4">Mstr</option>
                                                </select>
                                            </td>
                                        <?php } ?>
                                        <td class="text-center"><input type="name" ng-model="p.<?php echo $ptype.'['.$i;?>].FN" class="input form-control" placeholder="First Name" required></td>
                                        <td class="text-center"><input type="name" ng-model="p.<?php echo $ptype.'['.$i;?>].LN" class="input form-control" placeholder="Last Name" required></td>
                                    <?php if($ptype=='Infant'): ?>
                                        <td class="text-center" style="vertical-align: middle">{{getAgeInfant(p.Infant[<?php echo $i;?>].DOB)}}<span style="font-size:10px;">MONTH(S)</span></td>
                                    <?php else: ?>
                                        <td class="text-center" style="vertical-align: middle">{{getAge(p.<?php echo $ptype.'['.$i;?>].DOB)}}<span style="font-size:10px;">YEAR(S)</span></td>
                                    <?php endif; ?>
                                        <td class="text-center"><input type="text" class="form-control datepicker<?php echo $ptype;?>"
                                        ng-init="p.<?php echo $ptype.'['.$i;?>].DOB = p.<?php echo $ptype.'['.$i;?>].DOB? p.<?php echo $ptype.'['.$i;?>].DOB : startDate.<?php echo $ptype; ?>" ng-model="p.<?php echo $ptype.'['.$i;?>].DOB" style="max-width: 110px;margin:auto;" placeholder="MM/DD/YYYY" required></td>
                                        <td class="text-center"><select ng-model="p.<?php echo $ptype.'['.$i;?>].gender" class="form-control" required>
                                                <option value="">Select</option>
                                                <option value="M">Male</option>
                                                <option value="F">Female</option>
                                            </select></td>
                                        <?php if($ptype=='Senior'): ?>
                                            <td class="text-center"><input type="text" ng-model="p.<?php echo $ptype.'['.$i;?>].S" class="form-control" placeholder="Senior ID" required></td>
                                        <?php endif; ?>
                                        <?php if($onwardbaggages):?>
                                        <td class="text-center" style="font-size:12px;vertical-align: middle;" nowrap>
                                            <select ng-model="p.<?php echo $ptype.'['.$i.']';?>.OB" class="form-control" required>
                                                <?php foreach($onwardbaggages as $i_b => $bag): ?>
                                                    <?php $label = $i_b>1?'PHP '.explode(';',$bag)[1].' - '.explode(';',$bag)[0].'KG':$bag;?>
                                                    <option value="<?php echo $i_b==0?'':$i_b;?>"><?php echo $label?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </td>
                                        <?php endif;?>
                                        <?php if($chosen_return['index']>=0 && $returnbaggages): ?>
                                        <td class="text-center" style="font-size:12px;vertical-align: middle;" nowrap>
                                            <select ng-model="p.<?php echo $ptype.'['.$i.']';?>.RB" class="form-control" required>
                                                <?php foreach($returnbaggages as $i_b => $bag): ?>
                                                    <?php $label = $i_b>1?'PHP '.explode(';',$bag)[1].' - '.explode(';',$bag)[0].'KG':$bag;?>
                                                    <option value="<?php echo $i_b==0?'':$i_b;?>"><?php echo $label?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </td>
                                        <?php endif; ?>
                                    </tr>

                                <?php endfor;?>
                            <?php endforeach;?>

                            </tbody>
                        </table>
                            <!-- <hr style="margin-top: 0px;"> -->
                            <table class="table pad10">
                                <tbody>
                                    <!-- <tr>
                                        <th colspan="4" style="border-top: none;">Additional Services <small>( Free Baggage of Philippine Airlines )</small></th>
                                    </tr> -->
                                    <!-- <tr class="pad10">
                                        <td colspan="2">
                                            <?php //$onwards = $data['results_onward']['result'][$chosen_onward['index']]; ?>
                                            <label><span class="text-danger">*</span>Free Onward Baggage : </label>
                                            <span class="text-danger">

                                                <?php //foreach($onwards['Flights'] as $o): ?>
                                                    <?php //$bk = $o['ResBookDesigCode'];?>
                                                <?php //endforeach; ?>

                                                <?php //$bk = $o['ResBookDesigCode'];
                                                    // if($bk=='V' || $bk=='B' || $bk=='X' || $bk=='K' || $bk=='E' || $bk=='T'){
                                                    //     echo 'Free baggage allowance 10KG and 7kg hand carry';
                                                    // }else if($bk=='Y' || $bk=='S' || $bk=='L' || $bk=='M' || $bk=='H' || $bk=='Q'){
                                                    //     echo 'Free baggage allowance 20KG and 7kg hand carry';
                                                    // }else if($bk=='W' || $bk=='N'){
                                                    //     echo 'Free baggage allowance 25KG and 7kg hand carry';
                                                    // }else{
                                                    //     echo 'No Free baggage available. Please Add baggage';
                                                    // }
                                                ?>
                                                
                                            </span>
                                        </td>
                                        <?php// if($chosen_return['index']>=0): ?>
                                            <td colspan="2">
                                                <?php //$returns = $data['results_return']['result'][$chosen_return['index']]; ?>
                                                <label><span class="text-danger">*</span>Free Return Baggage : </label>
                                                <span class="text-danger">

                                                    <?php //foreach($returns['Flights'] as $r): ?>
                                                         <?php //$bk = $r['ResBookDesigCode'];?>
                                                    <?php //endforeach; ?>

                                                    <?php //$bk = $r['ResBookDesigCode'];
                                                        // if($bk=='V' || $bk=='B' || $bk=='X' || $bk=='K' || $bk=='E' || $bk=='T'){
                                                        //     echo 'Free baggage allowance 10KG and 7kg hand carry';
                                                        // }else if($bk=='Y' || $bk=='S' || $bk=='L' || $bk=='M' || $bk=='H' || $bk=='Q'){
                                                        //     echo 'Free baggage allowance 20KG and 7kg hand carry';
                                                        // }else if($bk=='W' || $bk=='N'){
                                                        //     echo 'Free baggage allowance 25KG and 7kg hand carry';
                                                        // }else{
                                                        //     echo 'No Free baggage available. Please Add baggage';
                                                        // }
                                                    ?>

                                                </span>
                                            </td>
                                        <?php //endif; ?>
                                    </tr>  -->
                                    <tr>
                                        <th colspan="4" style="border-top: ;">Contact Details <small class="text-danger">(FOR SCHEDULE CHANGE ADVISORY)</small></th>
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
                                            <textarea name="data" hidden><?php echo json_encode($data, true); ?></textarea>
                                            <textarea name="chosen_onward" hidden><?php echo json_encode($chosen_onward, true); ?></textarea>
                                            <textarea name="chosen_return" hidden><?php echo json_encode($chosen_return, true); ?></textarea>
                                            <textarea name="onward_baggage" hidden><?php echo json_encode($onwardbaggages,true); ?></textarea>
                                            <textarea name="return_baggage" hidden><?php echo json_encode($returnbaggages,true); ?></textarea>
                                            <textarea name="res_pricing" hidden><?php echo json_encode($res_pricing,true); ?></textarea>
                                            <!--<input type="hidden" name="passengerSTR" value="{{getPassengerSTR()}}">
                                            <input type="hidden" name="contactSTR" value="{{getotherdetailsSTR()}}">-->
                                            <button type="submit" class="btn btn-primary pull-right" name="btn_submitpassengerdetails">Submit</button>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                        </form>

                    <?php elseif( ($chosen_onward['provider'] == 'via' && $chosen_return['provider'] == 'via') || ($chosen_onward['provider'] == 'via') ): ?>
<!--                        via!-->
                        <form method="post" action="#" class="myform">
                            <table class="table pad10">
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
                                <?php if($onwardbaggages): ?>
                                    <th class="text-center">Onward Baggage</th>
                                <?php endif; ?>
                                <?php if($chosen_return['index']>=0 && $returnbaggages): ?>
                                    <th class="text-center">Return Baggage</th>
                                <?php endif;?>
                                </thead>
                                <tbody>
                                <?php $passengers = $data['Passengers'];?>
                                <?php foreach($passengers as $ptype => $pcount):?>
                                    <?php for($i=0;$i<$pcount;$i++): ?>
                                        <tr>
                                            <td style="font-size:11px;vertical-align: middle;"><?php echo strtoupper($ptype); ?></td>
                                            <?php if($ptype == 'Adult' || $ptype == 'Senior') { ?>
                                                <td class="text-center">
                                                    <select ng-model="p.<?php echo $ptype.'['.$i;?>].TL" class="form-control" required>
                                                        <option value="">Select</option>
                                                        <option value="1">Mr</option>
                                                        <!-- <option value="2">Mrs</option> -->
                                                        <option value="2">Ms</option>
                                                        <!-- <option value="4">Mstr</option> -->
                                                    </select>
                                                </td>
                                            <?php } else { ?>
                                                <td class="text-center">
                                                    <select ng-model="p.<?php echo $ptype.'['.$i;?>].TL" class="form-control" required>
                                                        <option value="">Select</option>
                                                        <!-- <option value="1">Mr</option> -->
                                                        <!-- <option value="2">Mrs</option> -->
                                                        <option value="3">Miss</option>
                                                        <option value="4">Mstr</option>
                                                    </select>
                                                </td>
                                            <?php } ?>
                                            <td class="text-center"><input type="name" ng-model="p.<?php echo $ptype.'['.$i;?>].FN" class="input form-control" placeholder="First Name" required></td>
                                            <td class="text-center"><input type="name" ng-model="p.<?php echo $ptype.'['.$i;?>].LN" class="input form-control" placeholder="Last Name" required></td>
                                            <?php if($ptype=='Infant'): ?>
                                                <td class="text-center" style="vertical-align: middle">{{getAgeInfant(p.Infant[<?php echo $i;?>].DOB)}}<span style="font-size:10px;">MONTH(S)</span></td>
                                            <?php else: ?>
                                                <td class="text-center" style="vertical-align: middle">{{getAge(p.<?php echo $ptype.'['.$i;?>].DOB)}}<span style="font-size:10px;">YEAR(S)</span></td>
                                            <?php endif; ?>
                                            <td class="text-center"><input type="text" class="form-control datepicker<?php echo $ptype;?>"
                                                                           ng-init="p.<?php echo $ptype.'['.$i;?>].DOB = p.<?php echo $ptype.'['.$i;?>].DOB? p.<?php echo $ptype.'['.$i;?>].DOB : startDate.<?php echo $ptype; ?>" ng-model="p.<?php echo $ptype.'['.$i;?>].DOB" style="max-width: 110px;margin:auto;" placeholder="MM/DD/YYYY" required></td>
                                            <td class="text-center"><select ng-model="p.<?php echo $ptype.'['.$i;?>].gender" class="form-control" required>
                                                    <option value="">Select</option>
                                                    <option value="M">Male</option>
                                                    <option value="F">Female</option>
                                                </select></td>
                                            <?php if($ptype=='Senior'): ?>
                                                <td class="text-center"><input type="text" ng-model="p.<?php echo $ptype.'['.$i;?>].S" class="form-control" placeholder="Senior ID" required></td>
                                            <?php endif; ?>
                                            <?php if($onwardbaggages):?>
                                                <td class="text-center" style="font-size:12px;vertical-align: middle;" nowrap>
                                                    <select ng-model="p.<?php echo $ptype.'['.$i.']';?>.OB" class="form-control" required>
                                                        <?php foreach($onwardbaggages as $i_b => $bag): ?>
                                                            <?php $label = $i_b>1?'PHP '.explode(';',$bag)[1].' - '.explode(';',$bag)[0].'KG':$bag;?>
                                                            <option value="<?php echo $i_b==0?'':$i_b;?>"><?php echo $label?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </td>
                                            <?php endif;?>
                                            <?php if($chosen_return['index']>=0 && $returnbaggages): ?>
                                                <td class="text-center" style="font-size:12px;vertical-align: middle;" nowrap>
                                                    <select ng-model="p.<?php echo $ptype.'['.$i.']';?>.RB" class="form-control" required>
                                                        <?php foreach($returnbaggages as $i_b => $bag): ?>
                                                            <?php $label = $i_b>1?'PHP '.explode(';',$bag)[1].' - '.explode(';',$bag)[0].'KG':$bag;?>
                                                            <option value="<?php echo $i_b==0?'':$i_b;?>"><?php echo $label?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </td>
                                            <?php endif; ?>
                                        </tr>

                                    <?php endfor;?>
                                <?php endforeach;?>

                                </tbody>
                            </table>
                            <hr style="margin-top: 0px;">
                            <table class="table pad10" >
                                <tbody>
                                <tr>
                                    <th colspan="4" style="border-top: none;">Contact Details <small class="text-danger">(FOR SCHEDULE CHANGE ADVISORY)</small></th>
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
                                        <textarea name="data" hidden><?php echo json_encode($data, true); ?></textarea>
                                        <textarea name="chosen_onward" hidden><?php echo json_encode($chosen_onward, true); ?></textarea>
                                        <textarea name="chosen_return" hidden><?php echo json_encode($chosen_return, true); ?></textarea>
                                        <textarea name="onward_baggage" hidden><?php echo json_encode($onwardbaggages,true); ?></textarea>
                                        <textarea name="return_baggage" hidden><?php echo json_encode($returnbaggages,true); ?></textarea>
                                        <textarea name="res_pricing" hidden><?php echo json_encode($res_pricing,true); ?></textarea>
                                        <!--<input type="hidden" name="passengerSTR" value="{{getPassengerSTR()}}">
                                        <input type="hidden" name="contactSTR" value="{{getotherdetailsSTR()}}">-->
                                        <button type="submit" class="btn btn-primary pull-right" name="btn_submitpassengerdetails">Submit</button>
                                    </td>
                                </tr>
 
                                </tbody>
                            </table>

                        </form>

                    <?php elseif( ($chosen_onward['provider'] == 'byaheko' && $chosen_return['provider'] == 'byaheko') || ($chosen_onward['provider'] == 'byaheko') ): ?>
<!--                        via!-->
                        <form method="post" action="#" class="myform">
                            <table class="table pad10">
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
                                <?php if($onwardbaggages): ?>
                                    <th class="text-center">Onward Baggage</th>
                                <?php endif; ?>
                                <?php if($chosen_return['index']>=0 && $returnbaggages): ?>
                                    <th class="text-center">Return Baggage</th>
                                <?php endif;?>
                                </thead>
                                <tbody>
                                <?php $passengers = $data['Passengers'];?>
                                <?php foreach($passengers as $ptype => $pcount):?>
                                    <?php for($i=0;$i<$pcount;$i++): ?>
                                        <tr>
                                            <td style="font-size:11px;vertical-align: middle;"><?php echo strtoupper($ptype); ?></td>
                                            <?php if($ptype == 'Adult' || $ptype == 'Senior') { ?>
                                                <td class="text-center">
                                                    <select ng-model="p.<?php echo $ptype.'['.$i;?>].TL" class="form-control" required>
                                                        <option value="">Select</option>
                                                        <option value="1">Mr</option>
                                                        <!-- <option value="2">Mrs</option> -->
                                                        <option value="2">Ms</option>
                                                        <!-- <option value="4">Mstr</option> -->
                                                    </select>
                                                </td>
                                            <?php } else { ?>
                                                <td class="text-center">
                                                    <select ng-model="p.<?php echo $ptype.'['.$i;?>].TL" class="form-control" required>
                                                        <option value="">Select</option>
                                                        <!-- <option value="1">Mr</option> -->
                                                        <!-- <option value="2">Mrs</option> -->
                                                        <option value="3">Miss</option>
                                                        <option value="4">Mstr</option>
                                                    </select>
                                                </td>
                                            <?php } ?>
                                            <td class="text-center"><input type="name" ng-model="p.<?php echo $ptype.'['.$i;?>].FN" class="input form-control" placeholder="First Name" required></td>
                                            <td class="text-center"><input type="name" ng-model="p.<?php echo $ptype.'['.$i;?>].LN" class="input form-control" placeholder="Last Name" required></td>
                                            <?php if($ptype=='Infant'): ?>
                                                <td class="text-center" style="vertical-align: middle">{{getAgeInfant(p.Infant[<?php echo $i;?>].DOB)}}<span style="font-size:10px;">MONTH(S)</span></td>
                                            <?php else: ?>
                                                <td class="text-center" style="vertical-align: middle">{{getAge(p.<?php echo $ptype.'['.$i;?>].DOB)}}<span style="font-size:10px;">YEAR(S)</span></td>
                                            <?php endif; ?>
                                            <td class="text-center"><input type="text" class="form-control datepicker<?php echo $ptype;?>"
                                                                           ng-init="p.<?php echo $ptype.'['.$i;?>].DOB = p.<?php echo $ptype.'['.$i;?>].DOB? p.<?php echo $ptype.'['.$i;?>].DOB : startDate.<?php echo $ptype; ?>" ng-model="p.<?php echo $ptype.'['.$i;?>].DOB" style="max-width: 110px;margin:auto;" placeholder="MM/DD/YYYY" required></td>
                                            <td class="text-center"><select ng-model="p.<?php echo $ptype.'['.$i;?>].gender" class="form-control" required>
                                                    <option value="">Select</option>
                                                    <option value="M">Male</option>
                                                    <option value="F">Female</option>
                                                </select></td>
                                            <?php if($ptype=='Senior'): ?>
                                                <td class="text-center"><input type="text" ng-model="p.<?php echo $ptype.'['.$i;?>].S" class="form-control" placeholder="Senior ID" required></td>
                                            <?php endif; ?>
                                            <?php if($onwardbaggages):?>
                                                <td class="text-center" style="font-size:12px;vertical-align: middle;" nowrap>
                                                    <select ng-model="p.<?php echo $ptype.'['.$i.']';?>.OB" class="form-control" required>
                                                        <?php foreach($onwardbaggages as $i_b => $bag): ?>
                                                            <?php 
                                                                $bagPrice = explode(';',$bag)[0];
                                                                $KG = explode('|',$bagPrice)[1];
                                                                $length = COUNT($onwardbaggages);
                                                                // // echo (COUNT($onwardbaggages));
                                                            ?>
                                                            <?php $label = $i_b>0 && $length>2?'PHP '.explode(';',$bag)[1].' - '.$KG:$bag;?>
                                                            <option value="<?php echo $i_b==0?'':$i_b;?>"><?php echo $label?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </td>
                                            <?php endif;?>
                                            <?php if($chosen_return['index']>=0 && $returnbaggages): ?>
                                                <td class="text-center" style="font-size:12px;vertical-align: middle;" nowrap>
                                                    <select ng-model="p.<?php echo $ptype.'['.$i.']';?>.RB" class="form-control" required>
                                                        <?php foreach($returnbaggages as $i_b => $bag): ?>
                                                            <?php 
                                                                $bagPrice = explode(';',$bag)[0];
                                                                $KG = explode('|',$bagPrice)[1];
                                                                $length = COUNT($returnbaggages);
                                                            ?>
                                                            <?php $label = $i_b>0 && $length>2?'PHP '.explode(';',$bag)[1].' - '.$KG:$bag;?>
                                                            <option value="<?php echo $i_b==0?'':$i_b;?>"><?php echo $label?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </td>
                                            <?php endif; ?>


                                        </tr>

                                    <?php endfor;?>
                                <?php endforeach;?>

                                </tbody>
                            </table>
                            <hr style="margin-top: 0px;">
                            <table class="table pad10" >
                                <tbody>
                                <tr>
                                    <th colspan="4" style="border-top: none;">Contact Details <small class="text-danger">(FOR SCHEDULE CHANGE ADVISORY)</small></th>
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
                                        <textarea name="data" hidden><?php echo json_encode($data, true); ?></textarea>
                                        <textarea name="chosen_onward" hidden><?php echo json_encode($chosen_onward, true); ?></textarea>
                                        <textarea name="chosen_return" hidden><?php echo json_encode($chosen_return, true); ?></textarea>
                                        <textarea name="onward_baggage" hidden><?php echo json_encode($onwardbaggages,true); ?></textarea>
                                        <textarea name="return_baggage" hidden><?php echo json_encode($returnbaggages,true); ?></textarea>
                                        <textarea name="res_pricing" hidden><?php echo json_encode($res_pricing,true); ?></textarea>
                                        <!--<input type="hidden" name="passengerSTR" value="{{getPassengerSTR()}}">
                                        <input type="hidden" name="contactSTR" value="{{getotherdetailsSTR()}}">-->
                                        <button type="submit" class="btn btn-primary pull-right" name="btn_submitpassengerdetails">Submit</button>
                                    </td>
                                </tr>

                                </tbody>
                            </table>

                        </form>

                    <?php endif; ?>
                </div>
            </div>

        <?php endif; ?>
    </div><!-- contentpanel -->

</div><!-- mainpanel -->

