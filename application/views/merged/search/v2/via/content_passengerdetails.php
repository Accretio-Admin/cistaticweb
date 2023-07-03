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
            <?php $onward = $data['results_onward'][$chosen_onward['provider']][$chosen_onward['index']];?>
            <?php $pricing = $onward['Pricing']; ?>

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

                        <th class="text-center">Onward Baggage</th>
                        <?php if($chosen_return['index']>=0): ?>
                        <th class="text-center">Return Baggage</th>
                        <?php endif;?>
                        </thead>

                        <tbody>
                        <?php foreach($data['Passengers'] as $ptype => $pcount):?>

                            <?php if($ptype=='Adult'){
                                $pid = 'adt';
                            }else if($ptype=='Senior'){
                                $pid = 'src';
                            }else if($ptype=='Children'){
                                $pid = 'cnn';
                            }else if($ptype=='Infant'){
                                $pid = 'inf';
                            }?>

                            <?php for($i=0;$i<$pcount;$i++):?>
                                <tr>
                                    <td style="font-size:11px;vertical-align: middle;"><?php echo strtoupper($ptype); ?></td>
                                    <td class="text-center">
                                        <input type="name"  ng-model="p.<?php echo $pid.'['.$i.']';?>.FN" class="input form-control" placeholder="First Name" required></td>
                                    <td class="text-center"><input type="name" ng-model="p.<?php echo $pid.'['.$i.']';?>.LN" class="input form-control" placeholder="Last Name" required></td>
                                    <?php if($pid=='Infant'): ?>
                                        <td class="text-center" style="vertical-align: middle">{{getAgeInfant(p.inf[<?php echo $i;?>].DOB)}}<span style="font-size:10px;">MONTH(S)</span></td>
                                    <?php else: ?>
                                        <td class="text-center" style="vertical-align: middle">{{getAge(p.<?php echo $pid.'['.$i;?>].DOB)}}<span style="font-size:10px;">YEAR(S)</span></td>
                                    <?php endif; ?>
                                    <td class="text-center">
                                        <input type="text" class="form-control datepicker<?php echo $pid;?>" ng-init="p.<?php echo $pid.'['.$i;?>].DOB = p.<?php echo $pid.'['.$i;?>].DOB? p.<?php echo $pid.'['.$i;?>].DOB : startDate.<?php echo $pid; ?>" ng-model="p.<?php echo $pid.'['.$i;?>].DOB" style="max-width: 150px" placeholder="MM/DD/YYYY" required></td>
                                    <td class="text-center"><select ng-model="p.<?php echo $pid.'['.$i;?>].gender" class="form-control" required>
                                            <option value="">Select</option>
                                            <option value="M">Male</option>
                                            <option value="F">Female</option>
                                        </select></td>
                                    <td><input type="text" ng-model="p.<?php echo $pid.'['.$i;?>].R" class="form-control" placeholder="Remarks" style="max-width: 150px;"></td>
                                    <td class="text-center" style="font-size:12px;vertical-align: middle;" nowrap>
                                        <select ng-model="p.<?php echo $pid.'['.$i.']';?>.OB" class="form-control" required>
                                            <?php foreach($onwardbaggages as $i_b => $bag): ?>
                                                <?php $label = $i_b>1?'PHP '.explode(';',$bag)[1].' - '.explode(';',$bag)[0].'KG':$bag;?>
                                                <option value="<?php echo $i_b==0?'':$i_b;?>"><?php echo $label?></option>
                                            <?php endforeach;?>
                                        </select>
                                        <input type="hidden" ng-init="p.<?php echo $pid.'['.$i;?>].Fare.Amount = ('<?php echo strlen($val = $b['PassengerFare']['TotalFare']['Amount'])>0 ? $val:0; ?>')" value="{{p.<?php echo $pid.'['.$i;?>].Fare.Amount}}">
                                        <input type="hidden" ng-init="p.<?php echo $pid.'['.$i;?>].Fare.Code = ('<?php echo $b['PassengerFare']['TotalFare']['CurrencyCode'];?>')" value="{{p.<?php echo $pid.'['.$i;?>].Fare.Code}}">
                                    </td>
                                    <?php if($chosen_return['index']>=0): ?>
                                    <td class="text-center" style="font-size:12px;vertical-align: middle;" nowrap>
                                        <select ng-model="p.<?php echo $pid.'['.$i.']';?>.RB" class="form-control" required>
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
                                    <textarea name="data" hidden><?php echo json_encode($data, true); ?></textarea>
                                    <textarea name="chosen_onward" hidden><?php echo json_encode($chosen_onward); ?></textarea>
                                    <textarea name="chosen_return" hidden><?php echo json_encode($chosen_return); ?></textarea>
                                    <textarea name="onward_baggage" hidden><?php echo json_encode($onwardbaggages); ?></textarea>
                                    <textarea name="return_baggage" hidden><?php echo json_encode($returnbaggages); ?></textarea>
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

