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
                <h4><?php echo $menu=='int'? 'INTERNATIONAL': 'DOMESTIC' ?> FLIGHTS</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->


    <div class="contentpanel" ng-app="MyApp" ng-controller="myCtrl" ng-cloak>


        <form action="<?php echo BASE_URL() ?>Abacus_International_Flights/book_flights" method="post" id="frmDomesticFlights" name="myForm">
            <div class="row">
                <div class="col-md-5 well col-md-offset-1">

                    <!--RADIO-->
                    <div class="radio-inline">
                        <label>
                            <input type="radio" ng-model="journey" value="RT" checked> Roundtrip
                        </label>
                    </div>
                    <div class="radio-inline">
                        <label>
                            <input type="radio" ng-model="journey" value="OW">
                            One-Way
                        </label>
                    </div>
                    <!--RADIO-->

                    <div class="form-group">
                        <label for="origin">Origin</label>
                        <select name="i_origin" ng-model="origin" class="form-control" required>
                            <option value="" label="--Select Origin--"></option>
                            <option value="{{item.countrycode+':'+item.airportcode}}" ng-repeat="item in airports" >{{item.countrycode+' - '+item.airportname}}</option>
                            <!--ng-options=" item.countrycode+':'+item.airportcode as item.countrycode+' - '+item.airportname for item in airports"-->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="destination">Destination</label>
                        <select name="i_destination" ng-model="destination" class="form-control" required>
                            <option value="" label="--Select Destination--"></option>
                            <option value="{{item.countrycode+':'+item.airportcode}}" ng-repeat="item in airports2(origin)">{{item.countrycode+' - '+item.airportname}}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="leave">Leave</label>
                                <div class="input-group input-append date" id="datePicker">
                                    <input type="text" ng-model="dateleave" class="form-control" name="i_leavedate" placeholder="MM/DD/YYYY" required/>
                                    <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                                <!--<input type="text" ng-model="huehue" class="form-control datetimepicker" id="dp_leave" placeholder="yyyy-mm-dd" required>-->
                            </div>
                            <div class="col-md-6" ng-show="journey=='RT'">
                                <label for="leave">Return</label>
                                <div class="input-group input-append date" id="datePicker2">
                                    <input type="text" ng-model="datereturn" class="form-control" name="i_returndate" placeholder="MM/DD/YYYY" ng-required="journey=='RT'"/>
                                    <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                                <!--<input type="text" class="form-control datetimepicker" id="dp_return" placeholder="yyyy-mm-dd">-->
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Adult(12-59 yrs old) </label>
                                <select name="i_adult" class="form-control" ng-model="adultcount" ng-init="adultcount = '0'" required>
                                    <option ng-repeat="item in col" value="{{item}}">{{item}}</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Senior(60 yrs and above)</label>
                                <select name="i_senior" class="form-control" ng-model="seniorcount" ng-init="seniorcount = '0'" required>
                                    <option ng-repeat="item in col" value="{{item}}" ng-hide="(9-adultcount)<item">{{item}}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Children(2-11 yrs old)</label>
                                <select name="i_child" class="form-control" ng-model="childcount" ng-init="childcount = '0'" required>
                                    <option ng-repeat="item in col" value="{{item}}" ng-hide="(9-addme([adultcount,seniorcount]))<item">{{item}}</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Infant(1-23 months)</label>
                                <select name="i_infant"  class="form-control" ng-model="infantcount" ng-init="infantcount = '0'" required>
                                    <option ng-repeat="item in col" value="{{item}}" ng-hide="(9-addme([adultcount,seniorcount,childcount]))<item">{{item}}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-6 col-md-6">
                                <label>Airlines</label>
                                <select class="form-control" ng-model="airline">
                                    <option value="AL" selected>Any</option>
                                    <option ng-value="i.airlinecode" ng-repeat="i in airlines | filter: airlinefilter" label="{{i.airlinename}}"  ></option>
                                </select>
                            </div>
                            <div class="col-xs-6 col-md-6">
                                <label>Seat Class</label>
                                <select class="form-control" ng-model="seatclass">
                                    <option value="A">Any</option>
                                    <option value="Y">Economy</option>
                                    <option value="S">Premium Economy</option>
                                    <option value="C">Business</option>
                                    <option value="J">Premium Business</option>
                                    <option value="F">First Class</option>
                                    <option value="P">Premium First Class</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-right">
                        <button class="btn btn-primary" type="submit" name="btnSearchBooking"
                            ng-disabled="!myForm.$valid">Search</button>

                    </div>


                    <div hidden>
                        <input name="journey" value="{{journey}}" required/>
                        <input name="origin" value="{{origin}}" required/>
                        <input name="destination" value="{{destination}}" required/>
                        <input type="text" value="{{dateleave}}" name="dateleave" required/>
                        <input type="text" value="{{datereturn}}" name="datereturn"/>

                        <input name="adult" value="{{adultcount}}" ng-model="adultcount" required/>
                        <input name="senior" value="{{seniorcount}}" ng-model="seniorcount" required/>

                        <input name="adultscount" ng-init="adultscount = 0" type="number" ng-model="adultscount" min="1" required/>

                        <input name="child" value="{{childcount}}" required/>
                        <input name="infant" value="{{infantcount}}" required/>

                        <input type="number" value="{{addme([adultcount,seniorcount,childcount,infantcount])}}" min="1" max="9" required/>
                        <input name="airlines" value="{{airline}}" required/>
                        <input name="class" value="{{seatclass}}" required/>
                        <input name="pageto" value="result"/>
                    </div>


                </div>

                <div class="col-md-5">

                    <div class="alert alert-warning" role="alert" ng-show="!myForm.$valid">
                        <span ng-show="myForm.i_origin.$error.required">origin invalid<br></span>
                        <span ng-show="myForm.i_destination.$error.required">destination invalid<br></span>
                        <span ng-show="myForm.i_leavedate.$error.required">leavedate invalid<br></span>
                        <span ng-show="myForm.i_returndate.$error.required">returndate invalid<br></span>
                        <span ng-show="myForm.adultscount.$error.min">atleast 1 adult or senior passenger<br></span>
                        <span ng-show="myForm.i_child.$error.required">child invalid<br></span>
                        <span ng-show="myForm.i_infant.$error.required">infant invalid<br></span>
                    </div>
                </div>

            </div>
        </form>


    </div>
</div>