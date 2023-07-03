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

        <div class="row row-stat">
            <div class="col-sm-12 col-md-12">
                <div class="tab-content nopadding noborder">
                    <div class="tab-pane active" id="activities">
                        <div class="follower-list">
                            <div class="col-sm-12">
                                <div class="row media-manager">
                                    <div class="row">
                                        <?php if ($process === 0): ?>
                                            <div class="col-xs-12 col-md-5 well">
                                                <?php if ($output['S'] === 0): ?>
                                                    <div class="alert alert-danger">
                                                        <?php echo $output['M'] ?>
                                                    </div>
                                                <?php endif ?>
                                                <form
                                                    action="<?php echo BASE_URL() ?>Abacus_Domestic_flights/book_flights"
                                                    method="post" class="transaction_form" id="frmDomesticFlights">
                                                    <div class="form-group">
                                                        <big>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="flighttype" value="1" required
                                                                       checked onclick="makeChoice(1)"/>Roundtrip
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="flighttype" value="2" required
                                                                       onclick="makeChoice(2)"/>Oneway
                                                            </label>
                                                        </big>
                                                    </div>


                                                    <div class="form-group">
                                                        <label>Origin</label>
                                                        <select class="form-control" name="origin" id="origin">
                                                            <?php foreach ($airports as $airport): ?>
                                                                <option
                                                                    value="<?php echo $airport['airportcode'] ?>"><?php echo $airport['airportname'] ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Destination</label>
                                                        <select class="form-control" name="destination"
                                                                id="destination">
                                                            <?php foreach ($airports as $airport): ?>
                                                                <option
                                                                    value="<?php echo $airport['airportcode'] ?>"><?php echo $airport['airportname'] ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-xs-6 col-md-6">
                                                                <label> Leave </label>
                                                                <input type="text" class="form-control datetimepicker"
                                                                       name="dateleave" required
                                                                       placeholder="yyyy-mm-dd">
                                                            </div>
                                                            <div class="col-xs-6 col-md-6">
                                                                <label> Return </label>
                                                                <input type="text" class="form-control datetimepicker"
                                                                       name="datereturn" id="date_return" required
                                                                       placeholder="yyyy-mm-dd">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-xs-6 col-md-6">
                                                                <label>Adult(12-59 yrs old) </label>
                                                                <select class="form-control" name="adult" id="adult">
                                                                    <?php for ($i = 0; $i <= 9; $i++) {
                                                                        echo "<option value=" . $i . ">" . $i . "</option>";
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-xs-6 col-md-6">
                                                                <label>Senior Citizen(59 above)</label>
                                                                <select class="form-control" name="senior" id="senior">
                                                                    <?php for ($i = 0; $i <= 9; $i++) {
                                                                        echo "<option value=" . $i . ">" . $i . "</option>";
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-xs-6 col-md-6">
                                                                <label>Children(2-11 yrs old)</label>
                                                                <select class="form-control" name="children" id="child">
                                                                    <?php for ($i = 0; $i <= 9; $i++) {
                                                                        echo "<option value=" . $i . ">" . $i . "</option>";
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-xs-6 col-md-6">
                                                                <label>Infant(1months to 23 months)</label>
                                                                <select class="form-control" name="infant" id="infant">
                                                                    <?php for ($i = 0; $i <= 9; $i++) {
                                                                        echo "<option value=" . $i . ">" . $i . "</option>";
                                                                    } ?>
                                                                </select>
                                                            </div>

                                                            <!--<div class="col-xs-6 col-md-12">
                                                                <br>
                                                                <big>
                                                                    <label class="check-inline">
                                                                        <input type="checkbox" name="senior_mode" value="1" id="activate_senior" onclick="seniorChoice()">&nbsp;Senior Citizen
                                                                    </label>
                                                                </big>
                                                            </div>-->
                                                            <div class="col-md-12 text-justify" id="seniornotes"
                                                                 style="display: none;">
                                                                <br>

                                                                <p class="text-danger">For passenger's availing senior
                                                                    citizen discount, a copy of OSCA ID must be sent to
                                                                    the following email address. Noncompliance will
                                                                    result to non-issuance of ticket or auto
                                                                    cancellation of booking. Any fare difference has to
                                                                    be borne by the outlets, since rates are still
                                                                    subject to change.</p>
                                                                <code>
                                                                    <span>EMAIL : </span>
                                                                    <ul class="">
                                                                        <li><a href="mailto:ticketingsupport@mygprs.ph">ticketingsupport@mygprs.ph</a>
                                                                        </li>
                                                                    </ul>
                                                                </code>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-xs-6 col-md-6">
                                                                <label>Airlines</label>
                                                                <select class="form-control" name="airlines">
                                                                    <!--<option value="AL">ALL</option>
                                                                    <option value="5J">Cebu Pacific</option>
                                                                    <option value="Z2">Air Asia Zest</option>
                                                                    <option value="PR">Philippine Airline</option>
                                                                    <option value="DG">Cebgo</option>
                                                                    <option value="5M">SkyJet</option>-->
                                                                    <option value="AL">Any</option>
                                                                    <?php foreach ($airlines as $airline): ?>
                                                                        <option
                                                                            value="<?php echo $airline['airlinecode'] ?>"><?php echo $airline['airlinename'] ?></option>
                                                                    <?php endforeach ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-xs-6 col-md-6">
                                                                <label>Seat Class</label>
                                                                <select class="form-control" name="class">
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
                                                        <button class="btn btn-primary" type="submit"
                                                                name="btnSearchBooking">Search
                                                        </button>
                                                    </div>

                                                </form>

                                            </div>  <!-- col-xs-12 col-md-5" -->
                                        <?php elseif ($process === 1): ?>
                                            <div class="col-xs-12 col-md-9">
                                                <form
                                                    action="<?php echo BASE_URL() ?>Abacus_Domestic_flights/book_flights"
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
                                                                <?php foreach ($result as $key):

                                                                    if ($flighttype == 2) {
                                                                        $onward = $key[0];
                                                                        $pricing = $key[1];
                                                                    } else {
                                                                        $onward = $key[0];
                                                                        $return = $key[1];
                                                                        $pricing = $key[2];
                                                                    }


                                                                    $pricing['pricing'] = $pricing['pricing'][0];

                                                                    $data = array();
                                                                    /*$data['choosen'] = array($onward['onward'][0]['CarrierID'], $onward['onward'][0]['CarrierID'] . '-' . $onward['onward'][0]["FlightNumber"], $onward['onward'][0]["Source"], $onward['onward'][0]["Destination"], $onward['onward'][0]["Class"], $onward['onward'][0]["WarningText"], $Passengers, $pricing['pricing']['currency'] . ' ' . number_format($pricing['pricing']['BaseFareFee'], 2), number_format($pricing['pricing']['TaxFee'] + $pricing['pricing']['SystemFee'] + $pricing['pricing']['MarkupFee'], 2), $pricing['pricing']['currency'] . ' ' . number_format($pricing['pricing']['TotalFee'], 2), $pricing['pricing']['is_available'], $return['return'][0]['CarrierID'], $return['return'][0]['CarrierID'] . '-' . $return['return'][0]["FlightNumber"], $return['return'][0]["Source"], $return['return'][0]["Destination"], $return['return'][0]["Class"], $return['return'][0]["WarningText"],
                                                                        $onward['onward'][1]['CarrierID'], $onward['onward'][1]['CarrierID'] . '-' . $onward['onward'][1]["FlightNumber"], $onward['onward'][1]["Source"], $onward['onward'][1]["Destination"], $onward['onward'][1]["Class"], $onward['onward'][1]["WarningText"],
                                                                        $return['return'][1]['CarrierID'], $return['return'][1]['CarrierID'] . '-' . $return['return'][1]["FlightNumber"], $return['return'][1]["Source"], $return['return'][1]["Destination"], $return['return'][1]["Class"], $return['return'][1]["WarningText"]);*/

                                                                    foreach($onward['onward'] as $f){
                                                                        $data['onward'][] = $f;
                                                                    }

                                                                    foreach($return['return'] as $f){
                                                                        $data['return'][] = $f;
                                                                    }
                                                                    /*$data['return'] = $return['return'][0];
                                                                    $data['connecting_return'] = $return['return'][1];*/
                                                                    $data['pricing'] = $pricing['pricing'];
                                                                    $data['passengers'] = $Passengers;
                                                                    ?>
                                                                    <tr>
                                                                        <td>
                                                                            <input type="radio" name="choose_flights"
                                                                                   value='<?php echo json_encode(array($data)) ?>'
                                                                                   onclick="get_data2(this,div_flight_details)">
                                                                        </td>
                                                                        <td>
                                                                            <img
                                                                                src="<?php echo base_url('/assets/images/online_booking') . '/' . $onward['onward'][0]['CarrierID'] . '.png' ?>">
                                                                        </td>
                                                                        <td><?php echo $onward['onward'][0]['CarrierID'] . '-' . $onward['onward'][0]["FlightNumber"];
                                                                            if ($flighttype == 1) {
                                                                                echo '<br>' . $return['return'][0]['CarrierID'] . '-' . $return['return'][0]["FlightNumber"];
                                                                            } ?></td>

                                                                        <td>
                                                                            <center><?php echo $onward['onward'][0]['Destination'];
                                                                                if ($flighttype == 1) {
                                                                                    echo '<br>' . $return['return'][0]['Destination'];
                                                                                } ?></center>
                                                                        </td>

                                                                        <td><?php echo date("d M", strtotime(explode('T', $onward['onward'][0]['DepartureTimeStamp'])[0])) . ' ' . date('g:i A', strtotime(explode('T', $onward['onward'][0]['DepartureTimeStamp'])[1]));
                                                                            if ($flighttype == 1) {
                                                                                echo '<br>' . date("d M", strtotime(explode('T', $return['return'][0]['DepartureTimeStamp'])[0])) . ' ' . date('g:i A', strtotime(explode('T', $return['return'][0]['DepartureTimeStamp'])[1]));
                                                                            } ?>
                                                                        <td><?php echo date("d M", strtotime(explode('T', $onward['onward'][0]['ArrivalTimeStamp'])[0])) . ' ' . date('g:i A', strtotime(explode('T', $onward['onward'][0]['ArrivalTimeStamp'])[1]));
                                                                            if ($flighttype == 1) {
                                                                                echo '<br>' . date("d M", strtotime(explode('T', $return['return'][0]['ArrivalTimeStamp'])[0])) . ' ' . date('g:i A', strtotime(explode('T', $return['return'][0]['ArrivalTimeStamp'])[1]));
                                                                            } ?>
                                                                        <td nowrap>
                                                                            <strong><?php echo $pricing['pricing']['currency'] . ' ' ?></strong><?php echo number_format($pricing['pricing']['TotalFee'], 2, '.', ',') ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-xs-3 col-md-3">
                                                            <a href="<?php echo BASE_URL(); ?>Abacus_Domestic_flights/book_flights">
                                                                <button id="booking_search" type="button"
                                                                        class="btn btn-primary"><span
                                                                        class="glyphicon glyphicon-search">&nbsp;</span>Search
                                                                    New
                                                                </button>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-3 col-md-3 text-right">
                                                            <textarea name="flight_details" readonly
                                                                      hidden><?php echo $flight_details ?></textarea>
                                                            <button class="btn btn-primary" type="submit"
                                                                    name="btnSelectFlight"><span
                                                                    class="glyphicon glyphicon-plane">&nbsp;</span>Choose
                                                                Flight(s)
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div> <!-- col-md-9 -->

                                            <div class="col-md-3  alert alert-info gradient">
                                                <div class="margin-top-small margin-bottom-small well"
                                                     id="div_flight_details" style="display: none;">
                                                </div>

                                                <div class="margin-top-small margin-bottom-small well"
                                                     id="div_return_details" style="display: none;">
                                                </div>
                                            </div>
                                        <?php elseif ($process === 2): ?>
                                            <div class="col-xs-12 col-md-5 well">
                                                <form
                                                    action="<?php echo BASE_URL() ?>Abacus_Domestic_flights/book_flights"
                                                    method="post" class="transaction_form" id="frmDomesticFlights">
                                                    <?php $no = 0;
                                                    foreach ($passengers as $passenger): ?>
                                                        <hr>
                                                        <?php $no + 1; ?>
                                                        <?php if ($passenger['Type'] == 'S'): ?>
                                                            <h5 style="font-weight: bold; color: #4169E1; text-align: right;">
                                                                SENIOR PASSENGER</h5>
                                                            <div class="form-group">
                                                                <b>Title</b>
                                                                <select class="form-control"
                                                                        name="<?php echo 's_title' . $no ?>" id="title">
                                                                    <option value="1">Mr</option>
                                                                    <option value="2">Mrs</option>
                                                                    <option value="3">Miss</option>
                                                                    <option value="4">Mstr</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-xs-6 col-md-6">
                                                                        <b>FirstName</b>
                                                                        <input type="text" class="form-control"
                                                                               name="<?php echo 's_fname' . $no ?>"
                                                                               pattern="[a-zA-Z\s]+" required>
                                                                    </div>
                                                                    <div class="col-xs-6 col-md-6">
                                                                        <b>LastName</b>
                                                                        <input type="text" class="form-control"
                                                                               name="<?php echo 's_lname' . $no ?>"
                                                                               pattern="[a-zA-Z\s]+" required>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-xs-6 col-md-6">
                                                                        <b>Birthday</b>
                                                                        <input type="text"
                                                                               class="form-control bdatetimepicker seniorbdate"
                                                                               name="<?php echo 's_bdate' . $no ?>"
                                                                               id="birthdate" placeholder="mm/dd/yyyy"
                                                                               required readonly>
                                                                    </div>
                                                                    <div class="col-xs-6 col-md-6">
                                                                        <b>Senior ID</b>
                                                                        <input type="text" class="form-control"
                                                                               name="<?php echo 's_senior_id' . $no ?>"
                                                                               required>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <b>Baggage Onward</b>
                                                                <select class="form-control"
                                                                        name="<?php echo 's_baggage_onward' . $no ?>"
                                                                        id="baggage_onward">
                                                                    <?php $i = -1;
                                                                    foreach ($onwardbaggages as $OB): ?>
                                                                        <?php if ($OB == $onwardbaggages[0]): ?>
                                                                            <option disabled
                                                                                    value="<?php echo $i + 1 ?>"><?php echo $OB ?></option>
                                                                        <?php elseif ($OB == $onwardbaggages[1]): ?>
                                                                            <option
                                                                                value="<?php echo $i + 1 ?>"><?php echo $OB ?></option>
                                                                        <?php else: ?>
                                                                            <option
                                                                                value="<?php echo $i + 1 ?>"><?php echo 'Kg ' . explode(";", $OB)[0] . ' ' . 'PHP ' . explode(";", $OB)[1]; ?></option>
                                                                        <?php endif ?>
                                                                        <?php $i++; ?>
                                                                    <?php endforeach ?>
                                                                </select>
                                                            </div>
                                                            <?php if ($returnbaggages): ?>
                                                                <div class="form-group">
                                                                    <b>Baggage Return</b>
                                                                    <select class="form-control"
                                                                            name="<?php echo 's_baggage_return' . $no ?>"
                                                                            id="baggage_return">
                                                                        <?php $i = -1;
                                                                        foreach ($returnbaggages as $RB): ?>
                                                                            <?php if ($RB == $returnbaggages[0]): ?>
                                                                                <option disabled
                                                                                        value="<?php echo $i + 1 ?>"><?php echo $RB ?></option>
                                                                            <?php elseif ($RB == $returnbaggages[1]): ?>
                                                                                <option
                                                                                    value="<?php echo $i + 1 ?>"><?php echo $RB ?></option>
                                                                            <?php else: ?>
                                                                                <option
                                                                                    value="<?php echo $i + 1 ?>"><?php echo 'Kg ' . explode(";", $RB)[0] . ' ' . 'PHP ' . explode(";", $RB)[1]; ?></option>
                                                                            <?php endif ?>
                                                                            <?php $i++; ?>
                                                                        <?php endforeach ?>
                                                                    </select>
                                                                </div>
                                                            <?php endif ?>
                                                        <?php elseif ($passenger['Type'] == 'A'): ?>
                                                            <h5 style="font-weight: bold; color: #4169E1; text-align: right;">
                                                                ADULT PASSENGER</h5>
                                                            <div class="form-group">
                                                                <b>Title</b>
                                                                <select class="form-control"
                                                                        name="<?php echo 'a_title' . $no ?>" id="title">
                                                                    <option value="1">Mr</option>
                                                                    <option value="2">Mrs</option>
                                                                    <option value="3">Miss</option>
                                                                    <option value="4">Mstr</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-xs-6 col-md-6">
                                                                        <b>FirstName</b>
                                                                        <input type="text" class="form-control"
                                                                               name="<?php echo 'a_fname' . $no ?>"
                                                                               pattern="[a-zA-Z\s]+" required>
                                                                    </div>
                                                                    <div class="col-xs-6 col-md-6">
                                                                        <b>LastName</b>
                                                                        <input type="text" class="form-control"
                                                                               name="<?php echo 'a_lname' . $no ?>"
                                                                               pattern="[a-zA-Z\s]+" required>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-xs-6 col-md-6">
                                                                        <b>Birthday</b>
                                                                        <input type="text"
                                                                               class="form-control bdatetimepicker adultbdate"
                                                                               name="<?php echo 'a_bdate' . $no ?>"
                                                                               id="birthdate" placeholder="mm/dd/yyyy"
                                                                               required readonly>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <b>Baggage Onward</b>
                                                                <select class="form-control"
                                                                        name="<?php echo 'a_baggage_onward' . $no ?>"
                                                                        id="baggage_onward">
                                                                    <?php $i = -1;
                                                                    foreach ($onwardbaggages as $OB): ?>
                                                                        <?php if ($OB == $onwardbaggages[0]): ?>
                                                                            <option disabled
                                                                                    value="<?php echo $i + 1 ?>"><?php echo $OB ?></option>
                                                                        <?php elseif ($OB == $onwardbaggages[1]): ?>
                                                                            <option
                                                                                value="<?php echo $i + 1 ?>"><?php echo $OB ?></option>
                                                                        <?php else: ?>
                                                                            <option
                                                                                value="<?php echo $i + 1 ?>"><?php echo 'Kg ' . explode(";", $OB)[0] . ' ' . 'PHP ' . explode(";", $OB)[1]; ?></option>
                                                                        <?php endif ?>
                                                                        <?php $i++; ?>
                                                                    <?php endforeach ?>
                                                                </select>
                                                            </div>
                                                            <?php if ($returnbaggages): ?>
                                                                <div class="form-group">
                                                                    <b>Baggage Return</b>
                                                                    <select class="form-control"
                                                                            name="<?php echo 'a_baggage_return' . $no ?>"
                                                                            id="baggage_return">
                                                                        <?php $i = -1;
                                                                        foreach ($returnbaggages as $RB): ?>
                                                                            <?php if ($RB == $returnbaggages[0]): ?>
                                                                                <option disabled
                                                                                        value="<?php echo $i + 1 ?>"><?php echo $RB ?></option>
                                                                            <?php elseif ($RB == $returnbaggages[1]): ?>
                                                                                <option
                                                                                    value="<?php echo $i + 1 ?>"><?php echo $RB ?></option>
                                                                            <?php else: ?>
                                                                                <option
                                                                                    value="<?php echo $i + 1 ?>"><?php echo 'Kg ' . explode(";", $RB)[0] . ' ' . 'PHP ' . explode(";", $RB)[1]; ?></option>
                                                                            <?php endif ?>
                                                                            <?php $i++; ?>
                                                                        <?php endforeach ?>
                                                                    </select>
                                                                </div>
                                                            <?php endif ?>
                                                        <?php elseif ($passenger['Type'] == 'C'): ?>
                                                            <h5 style="font-weight: bold; color: #4169E1; text-align: right;">
                                                                CHILD PASSENGER</h5>
                                                            <div class="form-group">
                                                                <b>Title</b>
                                                                <select class="form-control"
                                                                        name="<?php echo 'c_title' . $no ?>" id="title">
                                                                    <option value="1">Mr</option>
                                                                    <option value="2">Mrs</option>
                                                                    <option value="3">Miss</option>
                                                                    <option value="4">Mstr</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-xs-6 col-md-6">
                                                                        <b>FirstName</b>
                                                                        <input type="text" class="form-control"
                                                                               name="<?php echo 'c_fname' . $no ?>"
                                                                               pattern="[a-zA-Z\s]+" required>
                                                                    </div>
                                                                    <div class="col-xs-6 col-md-6">
                                                                        <b>LastName</b>
                                                                        <input type="text" class="form-control"
                                                                               name="<?php echo 'c_lname' . $no ?>"
                                                                               pattern="[a-zA-Z\s]+" required>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-xs-6 col-md-6">
                                                                        <b>Birthday</b>
                                                                        <input type="text"
                                                                               class="form-control bdatetimepicker childbdate"
                                                                               name="<?php echo 'c_bdate' . $no ?>"
                                                                               id="birthdate" placeholder="mm/dd/yyyy"
                                                                               required readonly>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <b>Baggage Onward</b>
                                                                <select class="form-control"
                                                                        name="<?php echo 'c_baggage_onward' . $no ?>"
                                                                        id="baggage_onward">
                                                                    <?php $i = -1;
                                                                    foreach ($onwardbaggages as $OB): ?>
                                                                        <?php if ($OB == $onwardbaggages[0]): ?>
                                                                            <option disabled
                                                                                    value="<?php echo $i + 1 ?>"><?php echo $OB ?></option>
                                                                        <?php elseif ($OB == $onwardbaggages[1]): ?>
                                                                            <option
                                                                                value="<?php echo $i + 1 ?>"><?php echo $OB ?></option>
                                                                        <?php else: ?>
                                                                            <option
                                                                                value="<?php echo $i + 1 ?>"><?php echo 'Kg ' . explode(";", $OB)[0] . ' ' . 'PHP ' . explode(";", $OB)[1]; ?></option>
                                                                        <?php endif ?>
                                                                        <?php $i++; ?>
                                                                    <?php endforeach ?>
                                                                </select>
                                                            </div>
                                                            <?php if ($returnbaggages): ?>
                                                                <div class="form-group">
                                                                    <b>Baggage Return</b>
                                                                    <select class="form-control"
                                                                            name="<?php echo 'c_baggage_return' . $no ?>"
                                                                            id="baggage_return">
                                                                        <?php $i = -1;
                                                                        foreach ($returnbaggages as $RB): ?>
                                                                            <?php if ($RB == $returnbaggages[0]): ?>
                                                                                <option disabled
                                                                                        value="<?php echo $i + 1 ?>"><?php echo $RB ?></option>
                                                                            <?php elseif ($RB == $returnbaggages[1]): ?>
                                                                                <option
                                                                                    value="<?php echo $i + 1 ?>"><?php echo $RB ?></option>
                                                                            <?php else: ?>
                                                                                <option
                                                                                    value="<?php echo $i + 1 ?>"><?php echo 'Kg ' . explode(";", $RB)[0] . ' ' . 'PHP ' . explode(";", $RB)[1]; ?></option>
                                                                            <?php endif ?>
                                                                            <?php $i++; ?>
                                                                        <?php endforeach ?>
                                                                    </select>
                                                                </div>
                                                            <?php endif ?>
                                                        <?php elseif ($passenger['Type'] == 'I'): ?>

                                                            <h5 style="font-weight: bold; color: #4169E1; text-align: right;">
                                                                INFANT PASSENGER</h5>
                                                            <div class="form-group">
                                                                <b>Title</b>
                                                                <select class="form-control"
                                                                        name="<?php echo 'i_title' . $no ?>" id="title">
                                                                    <option value="1">Mr</option>
                                                                    <option value="2">Mrs</option>
                                                                    <option value="3">Miss</option>
                                                                    <option value="4">Mstr</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-xs-6 col-md-6">
                                                                        <b>FirstName</b>
                                                                        <input type="text" class="form-control"
                                                                               name="<?php echo 'i_fname' . $no ?>"
                                                                               pattern="[a-zA-Z\s]+" required>
                                                                    </div>
                                                                    <div class="col-xs-6 col-md-6">
                                                                        <b>LastName</b>
                                                                        <input type="text" class="form-control"
                                                                               name="<?php echo 'i_lname' . $no ?>"
                                                                               pattern="[a-zA-Z\s]+" required>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-xs-6 col-md-6">
                                                                        <b>Birthday</b>
                                                                        <input type="text"
                                                                               class="form-control bdatetimepicker infantbdate"
                                                                               name="<?php echo 'i_bdate' . $no ?>"
                                                                               id="birthdate" placeholder="mm/dd/yyyy"
                                                                               required readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endif ?>
                                                        <?php $no++; ?>
                                                    <?php endforeach ?>
                                                    <hr>
                                                    <div class="form-group">
                                                        <h5 style="font-weight: bold; color: #4169E1;">CONTACT
                                                            DETAILS</h5>

                                                        <div class="row">
                                                            <div class="col-xs-6 col-md-8">
                                                                <b>Contact No</b>
                                                                <input type="text" class="form-control" name="contactno"
                                                                       required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <h5 style="font-weight: bold; color: #4169E1;">DELIVERY
                                                            DETAILS</h5>

                                                        <div class="row">
                                                            <div class="col-xs-6 col-md-8">
                                                                <b>Street</b>
                                                                <input type="text" class="form-control" name="street"
                                                                       required>
                                                            </div>
                                                            <div class="col-xs-6 col-md-4">
                                                                <b>Zipcode</b>
                                                                <input type="text" class="form-control" name="zipcode"
                                                                       required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <b>City</b>
                                                        <input type="text" class="form-control" name="city" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <h5 style="font-weight: bold; color: #4169E1;">PAYMENT
                                                            DETAILS</h5>

                                                        <p>GPRS ensures that every transaction, including your credit
                                                            card information, you conduct is safe and secure. To achieve
                                                            this, the site is protected by leading Secured Socket Layer
                                                            (SSL) encryption technology.</p>
                                                        <b>Total Price</b>
                                                        <input type="text" class="form-control"
                                                               value="<?php echo $totalfee; ?>" readonly="">
                                                    </div>

                                                    <div class="form-group">
                                                        <b>Mode of Payment</b>
                                                        <input type="text" class="form-control" value="Deposit"
                                                               readonly="">
                                                    </div>

                                                    <div class="form-group">
                                                        <h5 style="font-weight: bold; color: #4169E1;">TERMS AND
                                                            CONDITIONS</h5>

                                                        <p>Fares are subject to availability. In case there is any fare
                                                            change we will notify you at the earliest.</p>
                                                        <input type="checkbox" value="" required> <span>I have read and accept the <b>TERMS AND CONDITIONS</b> and <b>FARE RULES</b>.</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <b>Transaction Password</b>
                                                        <input type="password" class="form-control" name="transpass"
                                                               required>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-12 text-right">
                                                                <textarea name="flight_details"
                                                                          hidden><?php echo $flight_details;?></textarea>
                                                                <a href="#" class="btn btn-warning"><span
                                                                        class="glyphicon glyphicon-remove-circle"></span>&nbsp;Cancel</a>
                                                                <button name="btnBookFlights" class="btn btn-primary">
                                                                    <span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Book
                                                                    Now
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php endif ?>

                                    </div> <!-- row -->

                                </div>
                            </div>
                        </div><!-- activity-list -->

                    </div><!-- tab-pane -->

                </div>
            </div><!-- col-md-8 -->
        </div><!-- row -->
        <?php if ($process === 3): ?>
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="col-xs-12 col-md-6">
                        <h5 style="font-weight: bold; color: #4169E1; text-align: center; background-color:#add8e6;"
                            class="well well-sm">PASSENGER DETAILS</h5>

                        <div style="height:350px;overflow-y: scroll;">
                            <?php
                            $total = 0;

                            ?>
                            <?php foreach ($ui_passengers_details as $u): ?>
                                <?php
                                $OB = explode(";", $u['OB']);
                                $RB = explode(";", $u['RB']);

                                ?>
                                <?php
                                if ($u['T'] == 'A') {
                                    $p = "ADULT";
                                } elseif ($u['T'] == 'C') {
                                    $p = "CHILDREN";
                                } elseif ($u['T'] == 'I') {
                                    $p = "INFANT";
                                } elseif ($u['T'] == 'S') {
                                    $p = "SENIOR";
                                }

                                ?>
                                <?php if ($u['T'] == 'S') { ?>
                                    <div class="col-xs-12 col-md-12">
                                        <div class="form-group" style="font-size: 15px;">
                                            <span class="label label-warning pull-right"><?php echo $p; ?>
                                                PASSENGER</span>
                                        </div>
                                        <div class="form-group">
                                            <label>NAME:</label>
                                                      <span class="pull-right">
                                                      		
                                                      <?php echo strlen($u['Name'])>0 ? $u['Name']:$u['name']; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label>BIRTH DATE:</label>
                                            <span class="pull-right"><?php echo strlen($u['Bdate'])>0? $u['Bdate'] : $u['bdate']; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label>SENIOR ID:</label>
                                            <span class="pull-right"><?php echo $u['SID'] ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label>BAGGAGE ONWARD:</label>
                                            <span class="pull-right"><?php echo $OB[1]; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label>BAGGAGE RETURN:</label>
                                            <span class="pull-right"><?php echo $RB[1]; ?></span>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-xs-12 col-md-12">
                                        <div class="form-group" style="font-size: 15px;">
                                            <span class="label label-warning pull-right"><?php echo $p; ?>
                                                PASSENGER</span>
                                        </div>
                                        <div class="form-group">
                                            <label>NAME:</label>
                                            <span class="pull-right"><?php echo $u['name'] ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label>BIRTH DATE:</label>
                                            <span class="pull-right"><?php echo $u['bdate'] ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label>BAGGAGE ONWARD:</label>
                                            <span class="pull-right"><?php echo $OB[1]; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label>BAGGAGE RETURN:</label>
                                            <span class="pull-right"><?php echo $RB[1]; ?></span>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php
                                $total = $OB[1] + $RB[1] + $total;

                                ?>
                            <?php endforeach ?>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-6">
                        <h5 style="font-weight: bold; color: #4169E1; text-align: center; background-color:#add8e6;"
                            class="well well-sm">OTHER DETAILS</h5>

                        <div class="col-xs-12 col-md-12">

                            <div class="form-group-sm">
                                <label>CONTACT NO.:</label>
                                <span class="pull-right"><?php echo $contact_info['phone']; ?></span>
                            </div>
                            <div class="form-group-sm">
                                <label>STREET:</label>
                                <span class="pull-right"><?php echo $contact_info['street']; ?></span>
                            </div>
                            <div class="form-group-sm">
                                <label>CITY:</label>
                                <span class="pull-right"><?php echo $contact_info['city']; ?></span>
                            </div>
                            <div class="form-group-sm">
                                <label>ZIPCODE:</label>
                                <span class="pull-right"><?php echo $contact_info['zipcode']; ?></span>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-12">
                            <h5 style="font-weight: bold; color: #4169E1; text-align: center; background-color:#add8e6;"
                                class="well well-sm">PAYMENT DETAILS</h5>

                            <div class="form-group-sm">
                                <label>BASE FARE FEE</label>
                                <span
                                    class="pull-right"><?php echo number_format($payment_details['P']['BaseFareFee'], 2, '.', ','); ?></span>
                            </div>
                            <div class="form-group-sm">
                                <label>TAXES & FEES</label>
                                                            <span class="pull-right">
                                                            <?php

                                                            $total_tax = $payment_details['P']['TaxFee'] + $payment_details['P']['SystemFee'] + $payment_details['P']['MarkupFee'];

                                                            echo number_format($total_tax, 2, '.', ',');
                                                            ?>
                                                            </span>
                            </div>
                            <!--                                                            <div class="form-group-sm">
                                                            <label>SYTEM FEE</label>
                                                            <span class="pull-right"><?php echo number_format($payment_details['P']['SystemFee'], 2, '.', ','); ?></span>
                                                          </div>
                                                          <div class="form-group-sm">
                                                            <label>MARKUP FEE</label>
                                                            <span class="pull-right"><?php echo number_format($payment_details['P']['MarkupFee'], 2, '.', ','); ?></span>
                                                          </div> -->
                            <div class="form-group-sm">
                                <label>TOTAL FEE</label>
                                <span class="label label-danger pull-right"
                                      style="font-size:18px"><?php echo number_format($payment_details['P']['TotalFee'] + $total, 2, '.', ','); ?></span>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-12 text-right" style="margin-top:10px">
                            <hr/>
                            <form method="post" action="<?php echo BASE_URL() ?>Abacus_Domestic_flights/book_flights"
                                  class="transaction_form" id="frmDomesticFlights">
                                <button type="button" class="btn btn-danger">Cancel</button>
                                <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                                        data-target="#myModal">Confirm
                                </button>

                                <div id="myModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <h4 class="text-left">Are you sure you want to proceed ?</h4>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="btn btn-primary" name="btnConfirm">
                                                    Proceed
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>
            </div>
        <?php endif ?>
        <?php if ($process === 4): ?>
            <div class="alert alert-success">
                <?php echo $output['M']; ?> <br/>
                <b>TN :</b><?php echo $output['TN']; ?>
            </div>
            <div class="form-group">
                <a href="<?php echo BASE_URL(); ?>Abacus_Domestic_flights/book_flights">
                    <button id="booking_search" type="button"
                            class="btn btn-primary"><span
                            class="glyphicon glyphicon-plane"></span>&nbsp;Book Flights
                    </button>
                </a>
                <!--<button class="btn btn-primary"><span class="glyphicon glyphicon-plane"></span>&nbsp;Book Flights
                </button>-->
            </div>
        <?php endif ?>
    </div><!-- contentpanel -->

</div><!-- mainpanel -->

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Domestic Flights</h4>
            </div>
            <div class="modal-body">
                <p>Maximum of 9 passengers only</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
