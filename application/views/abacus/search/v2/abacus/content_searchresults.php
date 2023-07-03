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
<!--        <p>-->
<!--            <a href="search_flights" class="btn btn-default-alt"><span aria-hidden="true">&larr;</span> Back</a>-->
<!--        </p>-->
        <div style="padding-bottom: 10px;">
            <form method="post" action="" class="myform">
                <?php
                    if(isset($_POST['btn_back'])) {
                        session_destroy();
                    }
                ?>
                <button type="submit" name="btn_back" class="btn btn-default-alt" style="background-color: transparent;"><span aria-hidden="true">&larr;</span> Back</button>
            </form>
        </div>


    <?php if(isset($output) || empty($data['results_onward']['via']) && empty($data['results_onward']['abacus'])):?>
        <div class="alert alert-danger">
            <strong>No available flights found. Please search again.</strong>
        </div>
    <?php else: ?>
            <!-- <?php // print_r($data['results_return']);?> -->

    <!-- if(Abacus and Via == True) -->
    <?php if( (isset($data['results_onward']['via']) && isset($data['results_onward']['abacus'])) || (isset($data['results_return']['via']) && isset($data['results_return']['abacus'])) ):?>
        <?php //print_r($data['Passengers']['Senior']);
            if(isset($data['results_return'])):?>
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
                                <?php //$data['Passengers'];?>
                            <div>
<!--                                {{data['Passengers']['Senior']}}-->
<!--                                {{passenger}}-->
                                <div ng-repeat="(_index,itinerary) in itineraries" class="list-group-item hover {{(data['Passengers']['Senior']>0&&_provider=='abacus')?'disabled11 displaynone11':'wlaPass'}} {{(itinerary['Flights'][0]['Carrier']=='Philippine Airlines'&&_provider=='via')?'disabled displaynone':''}} {{chosen_onward['index']=='-1'?'meron1':'wala1'}} {{chosen_onward['index']==_index?'ok':'di'}}" style="margin-top: 10px;}"
                                     ng-show="( (chosen_onward['provider']==_provider) && (chosen_onward['index']==_index?chosen_onward['index']==_index:chosen_onward['index']=='-1') ) || chosen_onward['provider']=='' ">
                                    <table class="antonio">
                                        <tbody>
                                        <tr>
                                            <td colspan="3"><img ng-src="<?php echo base_url('/assets/images/online_booking');?>/{{itinerary['Flights'][0]['CarrierID']}}.png"></td>
                                            <td class="text-right f_pricing">{{itinerary['Pricing']['TotalFee']|currency: "₱"}}</td>
                                        </tr>
                                        <tr class="middle">
                                            <td>
                                                <div>
                                                    {{formatTime(itinerary['Flights'][0]['DepartureTimeStamp'])|date:'hh:mm a'}}
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
                                                    {{formatTime(itinerary['Flights'][0]['ArrivalTimeStamp'])|date:'hh:mm a'}}
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
                                                <div>
                                                    {{itinerary['Flights'][0]['CarrierID']+' - '+itinerary['Flights'][0]['FlightNumber']}}
                                                </div>
                                                <div class="f_location">
                                                    Flight No.
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" >
                                                <div class="f_location">
                                                    {{formatTime(itinerary['Flights'][0]['DepartureTimeStamp'])|date:'MMM dd, yyyy'}}
                                                </div>
                                                <a href="#" class="btn btn-link disabled" style="font-size:14px; padding-left:0px;">Class: {{getBookingClass(itinerary['Flights'][0]['Class'],itinerary['Flights'][0]['ResBookDesigCode'])}}</a>
                                            </td>
                                            <td class="text-right">
                                                <div>
                                                    <button type="button" class="btn btn-primary btn-sm btn-block {{(data['Passengers']['Senior']>0&&_provider=='abacus')?'disabled11':''}} {{(itinerary['Flights'][0]['Carrier']=='Philippine Airlines'&&_provider=='via')?'disabled':''}} {{chosen_onward['index']==_index?_index:chosen_onward['index']}} {{chosen_onward['provider']==_provider?_provider:chosen_onward['provider']}} {{_index?_index:'wala_index2'}} {{_provider?_provider:'wala_prov2'}} {{((chosen_onward['provider']!='' && chosen_onward['index']==_index) || (chosen_onward['provider']==_provider && chosen_onward['index']==_index))?'disabled':''}}"
                                                            ng-click="selectOnward(_provider,_index);">Choose
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
<!--                                <div class="list-group-item hover" ng-show="chosen_onward['provider']==_provider && chosen_onward['index']!=-1">-->
<!--                                    <button type="button" class="btn btn-primary btn-sm btn-block"-->
<!--                                            ng-click="chosen_onward={provider:_provider,index:-1}">Choose2 Another</button>-->
<!--                                </div>-->

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
                                <div>
                                    <div ng-repeat="(_provider,itineraries) in data['results_return']">
                                        <div ng-repeat="(_index,itinerary) in itineraries" class="list-group-item {{(data['Passengers']['Senior']>0&&_provider=='abacus')?'disabled11 displaynone11':'wlaPass'}} {{(itinerary['Flights'][0]['Carrier']=='Philippine Airlines'&&_provider=='via')?'disabled displaynone':''}} {{(chosen_onward['provider']!=''&&chosen_onward['index']>=0)?'hover':''}} {{chosen_onward['provider']!=''&&chosen_onward['provider']!=_provider?'disabled displaynone':''}}" style="margin-top: 10px;}"
                                             ng-show="chosen_return['provider']==''|| ((chosen_return['provider']==_provider)&&(chosen_return['index']==_index))">

                                            <table class="antonio">
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
                                                            {{formatTime(itinerary['Flights'][0]['DepartureTimeStamp'])|date:'hh:mm a'}}
                                                        </div>
                                                        <div class="f_location">
                                                            {{(_provider=='abacus')?
                                                            itinerary['Flights'][0]['SourceDesc']:
                                                            itinerary['Flights'][0]['Source'];}}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            {{formatTime(itinerary['Flights'][0]['ArrivalTimeStamp'])|date:'hh:mm a'}}
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
                                                        <div>
                                                            {{itinerary['Flights'][0]['CarrierID']+' - '+itinerary['Flights'][0]['FlightNumber'];}}
                                                        </div>
                                                        <div class="f_location">
                                                            Flight No.
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" >
                                                        <div class="f_location">
                                                            {{formatTime(itinerary['Flights'][0]['DepartureTimeStamp'])|date:'MMM dd yyyy'}}
                                                        </div>
                                                        <a href="#" class="btn btn-link disabled" style="font-size:14px;padding-left: 0;">Class: {{getBookingClass(itinerary['Flights'][0]['Class'],itinerary['Flights'][0]['ResBookDesigCode'])}}</a>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <button type="button" class="btn btn-primary btn-sm btn-block {{(data['Passengers']['Senior']>0&&_provider=='abacus')?'disabled11':''}} {{(itinerary['Flights'][0]['Carrier']=='Philippine Airlines'&&_provider=='via')?'disabled':''}} {{chosen_onward['provider']==''?'disabled': (chosen_return['provider']==_provider&&chosen_return['index']==_index)?'disabled':'';}}"
                                                                    ng-click="selectReturn(_provider,_index)">Choose
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>



                                        </div>


<!--                                    <div class="list-group-item hover" ng-show="chosen_return['provider']==_provider && chosen_return['index']!=-1">-->
<!--                                        <button type="button" class="btn btn-primary btn-sm btn-block"-->
<!--                                                ng-click="chosen_return={provider:_provider,index:-1}">Choose Another</button>-->
<!--                                    </div>-->
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


        <!-- if(Abacus == False and Via == True) -->        
            <?php elseif( (isset($data['results_onward']['via']) && !isset($data['results_onward']['abacus'])) || (isset($data['results_return']['via']) && !isset($data['results_return']['abacus'])) ):?>
                <?php //echo "VIA";?>

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
                                        <div>
                                            <div ng-repeat="(_index,itinerary) in itineraries" class="list-group-item hover {{(data['Passengers']['Senior']>0&&_provider=='abacus')?'disabled11 displaynone11':'wlaPass'}} {{(itinerary['Flights'][0]['Carrier']=='Philippine Airlines'&&_provider=='via')?'disabled displaynone':''}} {{chosen_onward['index']=='-1'?'meron1':'wala1'}} {{chosen_onward['index']==_index?'ok':'di'}}" style="margin-top: 10px;}"
                                                     ng-show="( (chosen_onward['provider']==_provider) && (chosen_onward['index']==_index?chosen_onward['index']==_index:chosen_onward['index']=='-1') ) || chosen_onward['provider']=='' ">
                                                <table class="antonio">
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="3"><img ng-src="<?php echo base_url('/assets/images/online_booking');?>/{{itinerary['Flights'][0]['CarrierID']}}.png"></td>
                                                            <td class="text-right f_pricing">{{itinerary['Pricing']['TotalFee']|currency: "₱"}}</td>
                                                        </tr>
                                                        <tr class="middle">
                                                            <td>
                                                                <div>
                                                                    {{formatTime(itinerary['Flights'][0]['DepartureTimeStamp'])|date:'hh:mm a'}}
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
                                                                    {{formatTime(itinerary['Flights'][0]['ArrivalTimeStamp'])|date:'hh:mm a'}}
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
                                                                <div>
                                                                    {{itinerary['Flights'][0]['CarrierID']+' - '+itinerary['Flights'][0]['FlightNumber']}}
                                                                </div>
                                                                <div class="f_location">
                                                                    Flight No.
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3" >
                                                                <div class="f_location">
                                                                    {{formatTime(itinerary['Flights'][0]['DepartureTimeStamp'])|date:'MMM dd, yyyy'}}
                                                                </div>
                                                                <a href="#" class="btn btn-link disabled" style="font-size:14px; padding-left:0px;">Class: {{getBookingClass(itinerary['Flights'][0]['Class'],itinerary['Flights'][0]['ResBookDesigCode'])}}</a>
                                                            </td>
                                                            <td class="text-right">
                                                                <div>
                                                                    <button type="button" class="btn btn-primary btn-sm btn-block {{(data['Passengers']['Senior']>0&&_provider=='abacus')?'disabled11':''}} {{(itinerary['Flights'][0]['Carrier']=='Philippine Airlines'&&_provider=='via')?'disabled':''}} {{chosen_onward['index']==_index?_index:chosen_onward['index']}} {{chosen_onward['provider']==_provider?_provider:chosen_onward['provider']}} {{_index?_index:'wala_index2'}} {{_provider?_provider:'wala_prov2'}} {{((chosen_onward['provider']!='' && chosen_onward['index']==_index) || (chosen_onward['provider']==_provider && chosen_onward['index']==_index))?'disabled':''}}"
                                                                            ng-click="selectOnward(_provider,_index);">Choose
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
                                    <div>
                                        <div ng-repeat="(_provider,itineraries) in data['results_return']">
                                            <div ng-repeat="(_index,itinerary) in itineraries" class="list-group-item {{(data['Passengers']['Senior']>0&&_provider=='abacus')?'disabled11 displaynone11':'wlaPass'}} {{(itinerary['Flights'][0]['Carrier']=='Philippine Airlines'&&_provider=='via')?'disabled displaynone':''}} {{(chosen_onward['provider']!=''&&chosen_onward['index']>=0)?'hover':''}} {{chosen_onward['provider']!=''&&chosen_onward['provider']!=_provider?'disabled displaynone':''}}" style="margin-top: 10px;}"
                                                 ng-show="chosen_return['provider']==''|| ((chosen_return['provider']==_provider)&&(chosen_return['index']==_index))">

                                                <table class="antonio">
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
                                                                    {{formatTime(itinerary['Flights'][0]['DepartureTimeStamp'])|date:'hh:mm a'}}
                                                                </div>
                                                                <div class="f_location">
                                                                    {{(_provider=='abacus')?
                                                                    itinerary['Flights'][0]['SourceDesc']:
                                                                    itinerary['Flights'][0]['Source'];}}
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div>
                                                                    {{formatTime(itinerary['Flights'][0]['ArrivalTimeStamp'])|date:'hh:mm a'}}
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
                                                                <div>
                                                                    {{itinerary['Flights'][0]['CarrierID']+' - '+itinerary['Flights'][0]['FlightNumber'];}}
                                                                </div>
                                                                <div class="f_location">
                                                                    Flight No.
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3" >
                                                                <div class="f_location">
                                                                    {{formatTime(itinerary['Flights'][0]['DepartureTimeStamp'])|date:'MMM dd yyyy'}}
                                                                </div>
                                                                <a href="#" class="btn btn-link disabled" style="font-size:14px;padding-left: 0;">Class: {{getBookingClass(itinerary['Flights'][0]['Class'],itinerary['Flights'][0]['ResBookDesigCode'])}}</a>
                                                            </td>
                                                            <td>
                                                                <div>
                                                                    <button type="button" class="btn btn-primary btn-sm btn-block {{(data['Passengers']['Senior']>0&&_provider=='abacus')?'disabled11':''}} {{(itinerary['Flights'][0]['Carrier']=='Philippine Airlines'&&_provider=='via')?'disabled':''}} {{chosen_onward['provider']==''?'disabled': (chosen_return['provider']==_provider&&chosen_return['index']==_index)?'disabled':'';}}"
                                                                            ng-click="selectReturn(_provider,_index)">Choose
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
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

        <!-- if(Abacus == True and Via == False) -->  
            <?php elseif( (!isset($data['results_onward']['via']) && isset($data['results_onward']['abacus'])) || (!isset($data['results_return']['via']) && isset($data['results_return']['abacus'])) ):?>
                <?php //echo "Abacus";?>   

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
                                        <div>
                                            <div ng-repeat="(_index,itinerary) in itineraries" class="list-group-item hover {{(data['Passengers']['Senior']>0&&_provider=='abacus')?'disabled11 displaynone11':'wlaPass'}} {{(itinerary['Flights'][0]['Carrier']=='Philippine Airlines'&&_provider=='via')?'disabled displaynone':''}} {{chosen_onward['index']=='-1'?'meron1':'wala1'}} {{chosen_onward['index']==_index?'ok':'di'}}" style="margin-top: 10px;}"
                                                     ng-show="( (chosen_onward['provider']==_provider) && (chosen_onward['index']==_index?chosen_onward['index']==_index:chosen_onward['index']=='-1') ) || chosen_onward['provider']=='' ">
                                                <table class="antonio">
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="3"><img ng-src="<?php echo base_url('/assets/images/online_booking');?>/{{itinerary['Flights'][0]['CarrierID']}}.png"></td>
                                                            <td class="text-right f_pricing">{{itinerary['Pricing']['TotalFee']|currency: "₱"}}</td>
                                                        </tr>
                                                        <tr class="middle">
                                                            <td>
                                                                <div>
                                                                    {{formatTime(itinerary['Flights'][0]['DepartureTimeStamp'])|date:'hh:mm a'}}
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
                                                                    {{formatTime(itinerary['Flights'][0]['ArrivalTimeStamp'])|date:'hh:mm a'}}
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
                                                                <div>
                                                                    {{itinerary['Flights'][0]['CarrierID']+' - '+itinerary['Flights'][0]['FlightNumber']}}
                                                                </div>
                                                                <div class="f_location">
                                                                    Flight No.
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3" >
                                                                <div class="f_location">
                                                                    {{formatTime(itinerary['Flights'][0]['DepartureTimeStamp'])|date:'MMM dd, yyyy'}}
                                                                </div>
                                                                <a href="#" class="btn btn-link disabled" style="font-size:14px; padding-left:0px;">Class: {{getBookingClass(itinerary['Flights'][0]['Class'],itinerary['Flights'][0]['ResBookDesigCode'])}}</a>
                                                            </td>
                                                            <td class="text-right">
                                                                <div>
                                                                    <button type="button" class="btn btn-primary btn-sm btn-block {{(data['Passengers']['Senior']>0&&_provider=='abacus')?'disabled11':''}} {{(itinerary['Flights'][0]['Carrier']=='Philippine Airlines'&&_provider=='via')?'disabled':''}} {{chosen_onward['index']==_index?_index:chosen_onward['index']}} {{chosen_onward['provider']==_provider?_provider:chosen_onward['provider']}} {{_index?_index:'wala_index2'}} {{_provider?_provider:'wala_prov2'}} {{((chosen_onward['provider']!='' && chosen_onward['index']==_index) || (chosen_onward['provider']==_provider && chosen_onward['index']==_index))?'disabled':''}}"
                                                                            ng-click="selectOnward(_provider,_index);">Choose
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
                                    <div>
                                        <div ng-repeat="(_provider,itineraries) in data['results_return']">
                                            <div ng-repeat="(_index,itinerary) in itineraries" class="list-group-item {{(data['Passengers']['Senior']>0&&_provider=='abacus')?'disabled11 displaynone11':'wlaPass'}} {{(itinerary['Flights'][0]['Carrier']=='Philippine Airlines'&&_provider=='via')?'disabled displaynone':''}} {{(chosen_onward['provider']!=''&&chosen_onward['index']>=0)?'hover':''}} {{chosen_onward['provider']!=''&&chosen_onward['provider']!=_provider?'disabled displaynone':''}}" style="margin-top: 10px;}"
                                                 ng-show="chosen_return['provider']==''|| ((chosen_return['provider']==_provider)&&(chosen_return['index']==_index))">

                                                <table class="antonio">
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
                                                                    {{formatTime(itinerary['Flights'][0]['DepartureTimeStamp'])|date:'hh:mm a'}}
                                                                </div>
                                                                <div class="f_location">
                                                                    {{(_provider=='abacus')?
                                                                    itinerary['Flights'][0]['SourceDesc']:
                                                                    itinerary['Flights'][0]['Source'];}}
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div>
                                                                    {{formatTime(itinerary['Flights'][0]['ArrivalTimeStamp'])|date:'hh:mm a'}}
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
                                                                <div>
                                                                    {{itinerary['Flights'][0]['CarrierID']+' - '+itinerary['Flights'][0]['FlightNumber'];}}
                                                                </div>
                                                                <div class="f_location">
                                                                    Flight No.
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3" >
                                                                <div class="f_location">
                                                                    {{formatTime(itinerary['Flights'][0]['DepartureTimeStamp'])|date:'MMM dd yyyy'}}
                                                                </div>
                                                                <a href="#" class="btn btn-link disabled" style="font-size:14px;padding-left: 0;">Class: {{getBookingClass(itinerary['Flights'][0]['Class'],itinerary['Flights'][0]['ResBookDesigCode'])}}</a>
                                                            </td>
                                                            <td>
                                                                <div>
                                                                    <button type="button" class="btn btn-primary btn-sm btn-block {{(data['Passengers']['Senior']>0&&_provider=='abacus')?'disabled11':''}} {{(itinerary['Flights'][0]['Carrier']=='Philippine Airlines'&&_provider=='via')?'disabled':''}} {{chosen_onward['provider']==''?'disabled': (chosen_return['provider']==_provider&&chosen_return['index']==_index)?'disabled':'';}}"
                                                                            ng-click="selectReturn(_provider,_index)">Choose
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
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

            <?php else: ?>
                <div class="alert alert-danger">
                    <strong>No available flights found. Please search again.</strong>
                </div>
        <?php endif; ?>
    <?php endif; ?>
    </div><!-- contentpanel -->

</div><!-- mainpanel -->

