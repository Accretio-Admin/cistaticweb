<div class="mainpanel">
    <div class="pageheader"  id="top">
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
        <p>
            <a href="search_flights" class="btn btn-default-alt"><span aria-hidden="true">&larr;</span> Back</a>
        </p>
        <?php if(isset($output)):?>

        <?php else: ?>

        <?php if(isset($data['results_return'])):?>
            <div style="margin-left:auto; margin-right:auto; max-width:1400px;">
                <div class="col-lg-{{chosen_onward['provider']==''?'5':'4'}}" style="max-width: 600px;"  ng-init="shown_onward=-1;">
        <?php else: ?>
            <div style="margin-left:auto; margin-right:auto; max-width:1200px;">
                <div class="col-lg-5" style="max-width: 600px;"  ng-init="shown_onward=-1;">
        <?php endif;?>
                    <div style="background-color: #2196F3;color:#FFF;padding: 15px;">
                        Choose Onward Flight
                    </div>

                    <div class="list-group">
                        <div ng-repeat="(_provider,itineraries) in data['results_onward']">
                            <div class="list-group-item hover" style="margin-top: 10px;}" ng-repeat="(_index,itinerary) in itineraries"
                                 ng-show="(chosen_onward['provider']==_provider && chosen_onward['index']==_index)||chosen_onward['provider']==''">
                                <table class="alfonzo">
                                    <tbody>
                                    <tr>
                                        <td colspan="3"><img ng-src="<?php echo base_url('/assets/images/online_booking');?>/{{itinerary['Flights'][0]['CarrierID']}}.png"></td>
                                        <td class="text-right f_pricing">{{itinerary['Pricing']['TotalFee']|currency: "₱"}}</td>
                                    </tr>
                                    <tr class="middle">
                                        <td>
                                            <div>
                                                {{formatTime(itinerary['Flights'][0]['DepartureTimeStamp'])|date:'HH:mm'}}
                                            </div>
                                            <div class="f_location">
                                                {{(_provider=='abacus')?
                                                itinerary['Flights'][0]['SourceDesc']:
                                                itinerary['Flights'][0]['Source'];
                                                }}
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                {{formatTime(itinerary['Flights'][0]['ArrivalTimeStamp'])|date:'HH:mm'}}
                                            </div>
                                            <div class="f_location">
                                                {{(_provider=='abacus')?
                                                itinerary['Flights'][0]['DestinationDesc']:
                                                itinerary['Flights'][0]['Destination'];
                                                }}
                                            </div>
                                        </td>
                                        <td >
                                            <div>
                                                {{dateDiff(itinerary['Flights'][0]['DepartureTimeStamp'],itinerary['Flights'][0]['ArrivalTimeStamp'])}}
                                            </div>
                                            <div class="f_location">
                                                {{(itinerary['Flights'])>1? ((itinerary['Flights']).length-1)+' Connecting' : 'Direct';}}
                                            </div>

                                        </td>
                                        <td valign="top">
                                            {{itinerary['Flights'][0]['CarrierID']+' - '+itinerary['Flights'][0]['FlightNumber']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" >
                                            <div class="f_location">
                                                {{formatTime(itinerary['Flights'][0]['DepartureTimeStamp'])|date:'MMM dd, yyyy'}}
                                            </div>
                                            <a href="#" class="btn btn-link disabled" style="font-size:14px; padding-left:0px;">{{getBookingClass(itinerary['Flights'][0]['Class'],itinerary['Flights'][0]['ResBookDesigCode'])}}</a>
                                        </td>
                                        <td class="text-right">
                                            <div>
                                                <button type="button" class="btn btn-primary btn-sm btn-block {{(chosen_onward['provider']!='' && chosen_onward['index']==_index)?'disabled':''}}"
                                                        ng-click="selectOnward(_provider,_index);">Choose {{_provider}}
                                                </button>
                                            </div>
                                        </td>

                                    </tr>
                                    </tbody>
                                </table>

                                <ul ng-click="$event.stopPropagation()" class="nav nav-tabs"
                                    style="padding-left:20px;background:none; border-left: none;border-right: none;border-top: none;"
                                    ng-show="shown['<?php echo $k;?>']=='<?php echo $p.$i; ?>'">
                                    <li class="nav-item">
                                        <a class="nav-link {{(details+shown)=='a'+shown?'active':''}}"
                                           style="{{(details+shown)=='a'+shown?'color:#EF6C00;':''}}" ng-click="details='a'">Flights</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{(details+shown)=='b'+shown?'active':''}}"
                                           style="{{(details+shown)=='b'+shown?';color:#EF6C00;':''}}" ng-click="details='b'">Pricing</a>
                                    </li>
                                </ul>

                            </div>
                        </div>
                        <div class="list-group-item hover" ng-show="chosen_onward['provider']!='' && chosen_onward['index']!=-1">
                            <button type="button" class="btn btn-primary btn-sm btn-block"
                                    ng-click="chosen_onward={provider:'',index:-1}">Choose Another</button>
                        </div>
                    </div>
                </div>

                <?php if(isset($data['results_return'])): ?>
                <div class="col-lg-{{chosen_return['provider']==''?'5':'4'}}" style="max-width: 600px; opacity: {{(chosen_onward['provider']!=''&&chosen_onward['index']>=0)?'':'0.2'}}" >
                    <div style="background-color: #2196F3;color:#FFF;padding: 15px;">
                        Choose Return Flight
                    </div>
                    <div class="list-group">
                        <div ng-repeat="(_provider,itineraries) in data['results_return']">
                            <div class="list-group-item {{(chosen_onward['provider']!=''&&chosen_onward['index']>=0)?'hover':''}} {{chosen_onward['provider']==_provider?'':'disabled'}}" style="margin-top: 10px;}"
                                 ng-repeat="(_index,itinerary) in itineraries"
                                 ng-show="chosen_return['provider']==''||
                                 ((chosen_return['provider']==_provider)&&(chosen_return['index']==_index))">

                                <table class="alfonzo">
                                    <tbody>
                                    <tr>
                                        <td colspan="3"><img ng-src="<?php echo base_url('/assets/images/online_booking');?>/{{itinerary['Flights'][0]['CarrierID']}}.png"> <?php echo $provider; ?></td>
                                        <td class="text-right">
                                            <div class="f_pricing">
                                                {{itinerary['Pricing']['TotalFee']|currency: "₱"}}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="middle">
                                        <td>
                                            <div>
                                                {{formatTime(itinerary['Flights'][0]['DepartureTimeStamp'])|date:'HH:mm'}}
                                            </div>
                                            <div class="f_location">
                                                {{(_provider=='abacus')?
                                                itinerary['Flights'][0]['SourceDesc']:
                                                itinerary['Flights'][0]['Source'];}}
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                {{formatTime(itinerary['Flights'][0]['ArrivalTimeStamp'])|date:'HH:mm'}}
                                            </div>
                                            <div class="f_location">
                                                {{(_provider=='abacus')?
                                                itinerary['Flights'][0]['DestinationDesc']:
                                                itinerary['Flights'][0]['Destination'];
                                                }}
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                {{dateDiff(itinerary['Flights'][0]['DepartureTimeStamp'],itinerary['Flights'][0]['ArrivalTimeStamp'])}}
                                            </div>
                                            <div class="f_location">
                                                {{(itinerary['Flights'].length)>1? ((itinerary['Flights']).length-1)+' Connecting' : 'Direct';}}
                                            </div>

                                        </td>
                                        <td>
                                            {{itinerary['Flights'][0]['CarrierID']+' - '+itinerary['Flights'][0]['FlightNumber'];}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" >
                                            <div class="f_location">
                                                {{formatTime(itinerary['Flights'][0]['DepartureTimeStamp'])|date:'MMM dd yyyy'}}
                                            </div>
                                            <a href="#" class="btn btn-link disabled" style="font-size:14px;padding-left: 0;">{{getBookingClass(itinerary['Flights'][0]['Class'],itinerary['Flights'][0]['ResBookDesigCode'])}}</a>
                                        </td>
                                        <td>
                                            <div>
                                                <button type="button" class="btn btn-primary btn-sm btn-block {{chosen_onward['provider']==''?'disabled': (chosen_return['provider']==_provider&&chosen_return['index']==_index)?'disabled':'';}}"
                                                        ng-click="selectReturn(_provider,_index)">Choose {{_provider}}
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>



                            </div>
                        </div>
                        <div class="list-group-item hover" ng-show="chosen_return['provider']!='' && chosen_return['index']!=-1">
                            <button type="button" class="btn btn-primary btn-sm btn-block"
                                    ng-click="chosen_return={provider:'',index:-1}">Choose Another</button>
                        </div>

                    </div>

                </div>
                <?php endif;?>


                <?php if(isset($data['results_return'])): ?>
                <div class="col-lg-{{chosen_onward['provider']!=''?(chosen_return['provider']!=''?'4':'3'):(chosen_return['provider']!='')?'3':'2'}}">
                <?php else: ?>
                <div class="col-lg-5">
                <?php endif;?>

                    <div style="background-color: #2196F3;color:#FFF;padding: 15px;" class="text-center">
                        Summary
                    </div>
                    <div class="list-group">
                        <div class="list-group-item hover" style="margin-top: 10px;">

                            <div ng-show=" false && chosen_onward['index']==-1 && chosen_onward['provider']==''">Please select 'Onward Flight'.</div>
                            <?php if(isset($data['results_return'])): ?>
                            <div ng-show="false && chosen_return['index']==-1 && chosen_return['provider']==''">Please select 'Return Flight'.</div>
                            <?php endif;?>

                            <table width="100%">
                                <tbody>
                                <tr ng-repeat="(k,v) in details"  style="font-size:14px;">
                                    <td>{{k}}</td>
                                    <td style="font-weight:bold;" class="text-right">{{v}}</td>
                                </tr>
                                <tr ng-repeat="(k,v) in pricing"  style="font-size:14px;">
                                    <td>{{k}}</td>
                                    <td style="font-weight:bold;" class="text-right">{{v|currency: "₱ "}}</td>
                                </tr>
                                </tbody>
                            </table>

                        </div>

                        <div class="list-group-item hover">
                            <form method="post" action="#">
                                <textarea name="data" hidden><?php echo json_encode($data,true); ?></textarea>
                                <input type="hidden" name="chosen_onward" value="{{chosen_onward}}">
                                <input type="hidden" name="chosen_return" value="{{chosen_return}}">
                                <?php if(isset($data['results_return'])):?>
                                <button type="submit" class="btn btn-primary btn-block
                                {{chosen_onward['provider']!='' && chosen_onward['index']>=0 && chosen_return['provider']!='' && chosen_return['index']>=0?'':'disabled'}}"
                                        name="btn_chooseflight">Proceed
                                </button>
                                <?php else:?>
                                <button type="submit" class="btn btn-primary btn-block
                                {{chosen_onward['provider']!='' && chosen_onward['index']!=-1?'':'disabled'}}"
                                        name="btn_chooseflight">Proceed
                                </button>
                                <?php endif;?>
                            </form>
                        </div>
                    </div>
                </div>









            </div>
        <?php endif; ?>
    </div><!-- contentpanel -->

</div><!-- mainpanel -->

