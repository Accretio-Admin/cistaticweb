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


    <div class="contentpanel">
        <?php if(isset($output)): ?>
            <div class="col-md-8 col-md-offset-2">
                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    <?php echo $output['M'];?>
                </div>
            </div>
        <?php endif; ?>
        <form method="post" class="myform">
            <div ng-app="myApp" ng-controller="myCtrl">

                <div class="alert alert-info col-md-8 col-md-offset-2" role="alert">
<!--                    <strong>Note!</strong> If you are traveling with a 'Senior Citizen' please have a separate search for them. Please do not combine 'Senior Citizen' with any other passenger type.-->        
                    <b class="text-danger">NOTE:</b> &nbsp; <br>
                        1. <strong>Please be advised that your booking session will expire within 10 minutes. Your Booking session will start after flight/s searching.</strong> <br>
                <?php if ($this->user['R'] != 'AIRLINE001' && $this->user['R'] != 'F1359252xx'): ?>    
                        2. <strong>A Service Fee of <i class="text-danger">250Php per pax/way</i> will be charged for every successful <i class="text-danger">REFUND</i> transaction.</strong> <br>
                        3. <strong>A Service Fee of <i class="text-danger">75Php per pax/way</i> will be charged for every successful <i class="text-danger">REBOOK</i> transaction.</strong> <br>
                    <br>
                <?php endif ?>
                    <!-- <marquee><b>Before booking a flight to</b> <b class="text-danger">CATICLAN, KALIBO and ROXAS CITY</b> (if going to BORACAY), <b>please ensure you have a confirmed booking with a</b> <b class="text-danger">Department of Tourism-accredited hotel</b>.</marquee> -->
                </div>
                <div class="col-md-4">
                    <div class="panel panel-primary">
                        <!-- Default panel contents -->
                        <div class="panel-heading">
                            <h3 class="panel-title">Search Flights</h3>
                        </div>
                        <div class="panel-body">

                            <div class="form-group text-center" ng-init="journey='RT'">
                                <label class="radio-inline">
                                    <input type="radio" name="journey" ng-model="journey" id="inlineRadio1" value="RT" required>Roundtrip
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="journey" ng-model="journey" id="inlineRadio2" value="OW" required>Oneway
                                </label>
                            </div>



                            <div class="form-group">
                                <label for="i_origin_{{origincountry.length>0?'city':'country'}}">Origin</label>
                                <?php if($menu=='dom'): ?>
                                    <select style="padding:6px 6px;" id="i_origin" ng-model="origin" name="origin" class="form-control" required>
                                        <option value="" readonly>---Select Origin---</option>
                                        <!-- <option ng-repeat="i in airportcollection" value="{{i.airportcode}}">{{i.airportname}}</option> -->
                                        <option ng-repeat="i in airportcollection" value="{{i.code}}">{{i.name}}</option>
                                    </select>
                                <?php else: ?>
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td width="40%">
                                                <select style="padding:6px 6px;" id="i_origin_country" ng-model="origincountry" class="form-control" required>
                                                    <option value="" hidden>---Country---</option>
                                                    <option ng-repeat="(i,v) in airportcollection" value="{{i}}">{{v.countryname}}</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select style="padding:6px 6px;" id="i_origin_city" name="origin" class="form-control" required>
                                                    <option value="" readonly>---City---</option>
                                                    <!-- <option ng-repeat="i in getcityfrom(origincountry)" value="{{i.airportcode}}">{{i.airportname}}</option> -->
                                                    <option ng-repeat="i in getcityfrom(origincountry)" value="{{i.code}}">{{i.name}}</option>
                                                </select>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="i_destination_{{destinationcountry.length>0?'city':'country'}}">Destination</label>
                                <?php if($menu=='dom'): ?>
                                    <select id="i_destination" name="destination" class="form-control" required>
                                        <option value="">---Select Destination---</option>
                                        <!-- <option ng-repeat="i in airports(origin)" value="{{i.airportcode}}">{{i.airportname}}</option> -->
                                        <option ng-repeat="i in airports(origin)" value="{{i.code}}">{{i.name}}</option>
                                    </select>
                                <?php else: ?>
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td width="40%">
                                                <select id="i_destination_country" ng-model="destinationcountry"  class="form-control" required>
                                                    <option value="">---Country---</option>
                                                    <option ng-repeat="(i,v) in airports(origincountry)" value="{{i}}">{{v.countryname}}</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select style="padding:6px 6px;" id="i_destination_city" name="destination" class="form-control" required>
                                                    <option value="" readonly>---City---</option>
                                                    <!-- <option ng-repeat="i in getcityfrom(destinationcountry)" value="{{i.airportcode}}">{{i.airportname}}</option> -->
                                                    <option ng-repeat="i in getcityfrom(destinationcountry)" value="{{i.code}}">{{i.name}}</option>
                                                </select>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                <?php endif; ?>

                            </div>

                            <div class="form-group">
                                <label for="i_leavedate">Departure</label>
                                <input type="text" name="leavedate" id="datepicker1" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="i_returndate">Return</label>
                                <input type="text" name="returndate" id="datepicker2" class="form-control" ng-disabled="journey!='RT'">
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary btn-block" id="aloading" name="btn_search">Search</button>
                        </div>

                        <!--<div class="panel-footer">

                        </div>-->
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel-primary">
                        <!-- Default panel contents -->
                        <div class="panel-heading">
                            <h3 class="panel-title">Passengers</h3>
                        </div>
                        <div class="panel-body">
                            <p class="bg-warning text-center">Maximum of 9 passengers</p>
                            <div class="form-group">
<!--                                <label for="i_adultcount">Adult [12 - 59 yrs old]</label>-->
                                <label for="i_adultcount">Adult [12 above]</label>
                                <select id="i_adultcount" name="adult" ng-model="adultcount" class="form-control" ng-init="adultcount = '1'" required>
                                    <option ng-repeat="item in col" value="{{item}}" >{{item}}</option>
                                </select>
                            </div>

<!--                            <div class="form-group">-->
<!--                                <label for="i_seniorcount">Senior [60 yrs and above]</label>-->
<!--                                <select id="i_seniorcount" name="senior" ng-model="seniorcount" class="form-control" ng-init="seniorcount = '0'" required>-->
<!--                                    <option ng-repeat="item in col" value="{{item}}">{{item}}</option>-->
<!--                                </select>-->
                                <!--<input id="i_seniorcount" name="senior" type="number" min="0" max="9" value="0" class="form-control" required>-->
<!--                            </div>-->

                            <div class="form-group">
                                <label for="i_child">Child [2 - 11 yrs old]</label>
                                <select id="i_child" name="child" ng-model="childcount" ng-disabled="ModelData.Seniors" class="form-control" ng-init="childcount = '0'" required>
                                    <option ng-repeat="item in col" value="{{item}}" ng-hide="(9-addme([adultcount]))<item">{{item}}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="i_infant">Infant [1 - 23 months]</label>
                                <select id="i_infant" name="infant" ng-model="infantcount" ng-disabled="ModelData.Seniors" class="form-control" ng-init="infantcount = '0'" required>
                                    <option ng-repeat="item in col" value="{{item}}" ng-hide="(9-addme([adultcount,childcount]))<item">{{item}}</option>
                                </select>
                            </div>

                            <br>
                            <div class="form-group" ng-app>
                                <big>
                                    <label class="check-inline">
                                        <input type="checkbox" name="senior" value="1" id="i_seniorcount" ng-model="ModelData.Seniors"/>&nbsp;Senior Citizen [60 yrs and above]
<!--                                        <input type="checkbox" name="senior" value="1" id="activate_senior" ng-model="ModelData.Seniors"/>&nbsp;Senior Citizen [60 yrs and above]-->
                                    </label>
                                </big>
                                <div class="form-group col-md-12 text-justify" id="seniornotes" ng-show="ModelData.Seniors">
                                    <p class="text-danger">For passenger's availing senior citizen discount, a copy of OSCA ID must be sent to the following email address. Noncompliance will result to non-issuance of ticket or auto cancellation of booking. Any fare difference has to be borne by the outlets, since rates are still subject to change.</p>
                                    <code>
                                        <span>EMAIL : </span>
                                        <ul class="">
                                            <li><a href="mailto:ticketingsupport@mygprs.ph">ticketingsupport@mygprs.ph</a></li>
                                        </ul>
                                    </code>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel-primary">
                        <!-- Default panel contents -->
                        <div class="panel-heading">
                            <h3 class="panel-title">Additional Options</h3>
                        </div>
                        <div class="panel-body">

                            <div class="form-group">
                                <label for="i_airline">Airline</label>
                                <select id="i_airline" name="airline" class="form-control">
                                    <option value="AL">Any</option>
                                    <?php foreach($airlines as $a): ?>
                                        <!-- <option value="<?php //echo $a['airlinecode']; ?>"><?php //echo $a['airlinename']; ?></option> -->
                                        <option value="<?php echo $a['code']; ?>"><?php echo $a['airline']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="i_seatclass">Booking Class</label>
                                <select id="i_seatclass" name="seatclass" class="form-control">
                                    <option value="A">Any</option>
                                    <!-- <option value="Y">Economy</option>
                                    <option value="S">Premium Economy</option>
                                    <option value="C">Business</option>
                                    <option value="J">Premium Business</option>
                                    <option value="F">First Class</option>
                                    <option value="P">Premium First Class</option> -->
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div><!-- contentpanel -->

</div><!-- mainpanel -->


<div id="myDomSearchModal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
        <h4 class="modal-title text-danger">Take Note!</h4>
      </div>
      <div class="modal-body">
        <p>Before booking a flight to <span class="airportClass"></span>, please ensure you have a confirmed booking with a Department of Tourism-accredited hotel.</p>
        <p>Do you want to proceed?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btnNoNo">No</button>
        <button type="button" class="btn btn-primary btnYesOk" data-dismiss="modal">Yes</button>
      </div>
    </div>

  </div>
</div>