<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-plane"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>ABACUS</li>
                </ul>
                <h4><?php echo $menu == 'int' ? 'INTERNATIONAL' : 'DOMESTIC' ?> FLIGHTS</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->


    <div class="contentpanel" ng-app="MyApp" ng-controller="myCtrl">
        <div class="row">
            <?php if($S==0):?>

                <div class="col-md-offset-2 col-lg-offset-2 col-md-8 col-lg-8">
                    <center>
                        <img src="<?php echo base_url('/assets/icon').'/'?>cancel.png">
                        <h4><?php echo $M; ?></h4>
                        <h5>Please try again later.</h5>
                    </center>
                </div>

            <?php else:?>
            <div class="col-md-9">
                {{errormsg}}
                <form
                    action="<?php echo BASE_URL() ?>Abacus_International_flights/book_flights"
                    method="post" class="transaction_form" id="frmDomesticFlights">
                    <div class="panel panel-info">

                        <div class="panel-heading"><b>FLIGHT</b></div>
                        <div class="panel-body">
                            <table class="table table-stripped">
                                <thead>
                                <th></th>
                                <th>Choose Flight</th>
                                <th nowrap>Flight #</th>
                                <th>Destination</th>
                                <th>Departure</th>
                                <th>Arrival</th>
                                <th nowrap>Total Fee</th>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="i in flights">
                                        <td><input type="radio" name="rad" ng-click="showOnPanel(i)"></td>
                                        <td><img src="<?php echo base_url('/assets/images/online_booking').'/'?>{{i[0].onward[0].CarrierID}}.png"></td>
                                        <td>{{i[0].onward[0].CarrierID}} - {{i[0].onward[0].FlightNumber}}</td>
                                        <td>{{i[0].onward[0].Source}}<?php echo $journey=='RT' ? '&#8596' : '&#8594'; ?>{{i[0].onward[i[0].onward.length-1].Destination}}</td>
                                        <td>{{i[0].onward[0].DepartureTimeStamp | date:'dd MMM hh:mma' }}</td>
                                        <td>{{i[0].onward[i[0].onward.length-1].ArrivalTimeStamp | date:'dd MMM hh:mma' }}</td>
                                        <td><b>PHP</b> {{i[<?php echo $journey=='RT' ? '2' : '1'; ?>].pricing[0].TotalFee|currency:''}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div>
                        <a href="<?php echo BASE_URL();?>Abacus_International_flights/book_flights" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-search">&nbsp;</span>Search New</a>

                        <button class="btn btn-primary" type="submit" name="btnSelectFlight">
                            <span class="glyphicon glyphicon-plane">&nbsp;</span>
                            Choose Flight(s)
                        </button>
                    </div>

                    <div hidden>
                        <input name="pageto" value="passengerdetails">
                        <input name="rqid" value="{{rqid}}">
                        <input name="passengers" value="{{passengers}}">
                        <input name="onward" value="{{c_onward}}">
                        <input name="return" value="{{c_return}}">
                        <input name="pricing" value="{{c_pricing}}">
                    </div>

                </form>
            </div> <!-- col-md-9 -->

            <div class="col-md-3  alert alert-info gradient" ng-show="data!=null">
                <div class="margin-top-small margin-bottom-small well" id="div_flight_details" style="display: block;">
                    <div>
                        <p style="font-size: 13px; color: red;" class="text-center"><strong>Onward Flights</strong></p>
                        <div ng-repeat="i in data.onward">

                            <table class="table">
                                <tbody>
                                <tr>
                                    <td><p style="font-size: 13px; color: red;"><strong>Flight {{$index+1}}</strong></p></td>
                                    <td class="text-right"><img src="<?php echo base_url('/assets/images/online_booking'); ?>/{{i.carrier}}.png"></td>
                                </tr>
                                <tr>
                                    <td><strong>Carrier : </strong>{{i.carriername}}</td>
                                    <td><strong>Flight No : </strong>{{i.flightno}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Source : </strong>{{i.source}}</td>
                                    <td><strong>Destination : </strong>{{i.destination}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Departure : </strong>{{i.dateleave | date:'dd MMM hh:mma'}}</td>
                                    <td><strong>Arrival : </strong>{{i.datearrive | date:'dd MMM hh:mma'}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><strong>Class : </strong>{{i.class}}</td>
                                </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div>
                        <p style="font-size: 13px; color: red;" class="text-center"><strong>Return Flights</strong></p>
                        <div ng-repeat="i in data.return">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td><p style="font-size: 13px; color: red;"><strong>Flight {{$index+1}}</strong></p></td>
                                    <td class="text-right"><img src="<?php echo base_url('/assets/images/online_booking'); ?>/{{i.carrier}}.png"></td>
                                </tr>
                                <tr>
                                    <td><strong>Carrier : </strong>{{i.carriername}}</td>
                                    <td><strong>Flight No : </strong>{{i.flightno}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Source : </strong>{{i.source}}</td>
                                    <td><strong>Destination : </strong>{{i.destination}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Departure : </strong>{{i.dateleave | date:'dd MMM hh:mma'}}</td>
                                    <td><strong>Arrival : </strong>{{i.datearrive | date:'dd MMM hh:mma'}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><strong>Class : </strong>{{i.class}}</td>
                                </tr>
                                </tbody>
                            </table>
                            <!--<p style="font-size: 13px; color: red;"><strong>Flight {{$index+1}}</strong></p>
                            <p><strong>Carrier : </strong><img src="<?php /*echo base_url('/assets/images/online_booking'); */?>/{{i.carrier}}.png"></p>
                            <p><strong>Flight No : </strong>{{i.flightno}}</p>
                            <p><strong>Source : </strong>{{i.source}}</p>
                            <p><strong>Destination : </strong>{{i.destination}}</p>
                            <p><strong>Class : </strong>{{i.class}}</p>-->
                        </div>
                    </div>

                    <div>
                        <p style="font-size: 13px; color: red;" class="text-center"><strong>Payment Details</strong></p>
                        <table class="table">
                            <tbody>
                            <tr>
                                <td><strong>Passenger : </strong></td>
                                <td>
                                    {{data.adultcount}} (Adult)<br/>
                                    {{data.childcount}} (Children)<br/>
                                    {{data.infantcount}} (Infant)
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Base Fare</strong></td>
                                <td><span style="color: red">{{data.pricing[0].basefare|currency:'PHP '}}</span></td>
                            </tr>
                            <tr>
                                <td><strong>Taxes & Fees</strong></td>
                                <td><span style="color: red">{{data.pricing[0].taxnfee|currency:'PHP '}}</span></td>
                            </tr>
                            <tr>
                                <td><strong>Total Amount</strong></td>
                                <td><span style="color: red">{{data.pricing[0].totalfee|currency:'PHP '}}</span></td>
                            </tr>
                            </tbody>
                        </table>

                    </div>

                </div>

                <!--<div class="margin-top-small margin-bottom-small well" id="div_return_details" style="display: none;">
                </div>-->
            </div>
            <?php endif;?>
        </div>
    </div>
</div>
