<?php 
  Header('X-XSS-Protection: 0');
?>
<style type="text/css">
  .tooltip-inner {
    max-width: 250px !important;
    width: 250px !important;
}
</style>
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
                                <h4>INTERNATIONAL FLIGHTS</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    

                    
                    <div class="contentpanel">
                        <div class="row row-stat">
                            <div class="col-sm-12 col-md-12">
                                <div class="alert alert-info col-md-8 col-md-offset-2" role="alert">
                                    <!-- <span><strong>Before booking a flight to</strong> <b class="text-danger">CATICLAN, KALIBO and ROXAS CITY</b> (if going to BORACAY), <strong>please ensure you have a confirmed booking with a</strong> <b class="text-danger">Depatment of Tourism-accredited hotel</b>.</span> -->

                                    <!-- 1. <strong>Please be advised that your booking session will expire within 10 minutes. Your Booking session will start after flight/s searching.</strong> <br> -->
                                    
                                  <?php if ($this->user['R'] != 'AIRLINE001' && $this->user['R'] != 'F1359252xx'): ?>   
                                    <b class="text-danger">NOTE:</b> &nbsp; <br> 
                                      1. <strong>A Service Fee of <i class="text-danger">250Php per pax/way</i> will be charged for every successful <i class="text-danger">REFUND</i> transaction.</strong> <br>
                                      2. <strong>A Service Fee of <i class="text-danger">150Php per pax/way</i> will be charged for every successful <i class="text-danger">REBOOK</i> transaction.</strong> <br>
                                    <br>
                                  <?php endif ?>
                                    <!-- <marquee><b>Before booking a flight to</b> <b class="text-danger">CATICLAN, KALIBO and ROXAS CITY</b> (if going to BORACAY), <b>please ensure you have a confirmed booking with a</b> <b class="text-danger">Department of Tourism-accredited hotel</b>.</marquee> -->

                                </div>
                                <div class="tab-content nopadding noborder">
                                    <div class="tab-pane active" id="activities">
                                        <div class="follower-list">  
                                            <div class="col-sm-12">
                                                <div class="row media-manager">
                                                        
                                                      <div class="row">

                                                              <?php if ($process === 0): ?>
                                                                <div class="col-xs-12 col-md-5 well">
                                                                  <?php if ($output['S'] === 1): ?>
                                                                  <div class="alert alert-success">
                                                                    <?php echo $output['M']; ?>.
                                                                    <small>E-ticket was sent to your email <span class="text-info"><?php echo $output['EA']; ?></span></small> <br />
                                                                    <p><strong>TRANSACTION NUMBER:</strong>&nbsp;<a target="_blank" href="<?php echo $output['URL'].$output['TN']; ?>"><?php echo $output['TN']; ?></a></p><p><i><small>Click transaction number to download receipt.</small></i></p>
                                                                  </div>
                                                                  <?php endif ?>
                                                                  <?php if ($output['S'] === 0): ?>
                                                                    <div class="alert alert-danger">
                                                                      <?php echo $output['M'] ?>
                                                                    </div>
                                                                  <?php endif ?>
                                                                  <?php if ($output['S'] === 2): ?>
                                                                    <div class="alert alert-warning">
                                                                      <?php echo $output['M'] ?>
                                                                    </div>
                                                                  <?php endif ?>
                                                                    <form action="<?php echo BASE_URL()?>Merged_intl_flights/book_international_flights" method="post" id="frmInternationalFlights">
                                                                    <div class="form-group">
                                                                     <big>
                                                                         <label class="radio-inline">
                                                                            <input type="radio" name="flighttype" value="1" required checked onclick="makeChoice(1)"/>Roundtrip
                                                                            <!-- <input type="radio" name="flighttype" value="1" required checked >Roundtrip -->
                                                                          </label>
                                                                          <label class="radio-inline">
                                                                            <input type="radio" name="flighttype" value="2" required  onclick="makeChoice(2)"/>Oneway
                                                                            <!-- <input type="radio" name="flighttype" value="2" required >Oneway -->
                                                                          </label>
                                                                      </big>
                                                                     </div>

                                                                      <fieldset class="well" style="margin-bottom: 0px;">
                                                                      <legend style="margin-bottom: -10px; border-bottom: none; color: #4a535e; font-size: 15px; font-weight: bold;">Origin</legend>
                                                                       <div class="input-group">
                                                                       <span class="input-group-addon" id="basic-addon1"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                                                            <select class="form-control" name="origin1" id="origin1" required >
                                                                            <option value="" disabled selected>---Select Country---</option>
                                                                                    <?php foreach ($airports as $row): ?>
                                                                                      <option value="<?php echo $row ?>"><?php echo $row ?></option>
                                                                                    <?php endforeach ?>
                                                                            </select>   
                                                                       </div>
                                                                       <div class="input-group">
                                                                          <span class="input-group-addon" id="basic-addon1"><i id="spinAnimation" class="fa fa-location-arrow" aria-hidden="true"></i></span>
                                                                          <select class="form-control" name="origin" id="origin" disabled="" required>
                                                                          <option value="" disabled selected>---Select City---</option>
                                                                          </select>   
                                                                       </div>
                                                                       <div class="input-group">
                                                                          <span class="input-group-addon" id="basic-addon1"><i id="spinAnimation" class="fa fa-plane" aria-hidden="true"></i></span>
                                                                          <select class="form-control" name="origin2" id="origin2" disabled="" required>
                                                                          <option value="" disabled selected>---Select Airport---</option>
                                                                          </select>   
                                                                       </div>
                                                                      </fieldset>

                                                                      <fieldset class="well" style="margin-bottom: 0px;">
                                                                      <legend style="margin-bottom: -10px; border-bottom: none; color: #4a535e; font-size: 15px; font-weight: bold;">Destination</legend>
                                                                      <div class="input-group">
                                                                       <span class="input-group-addon" id="basic-addon1"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                                                            <select class="form-control" name="destination1" id="destination1" required>
                                                                            <option value="" disabled selected>---Select Country---</option>
                                                                                    <?php foreach ($airports as $row): ?>
                                                                                      <option value="<?php echo $row ?>"><?php echo $row ?></option>
                                                                                    <?php endforeach ?>
                                                                            </select>   
                                                                       </div>
                                                                       <div class="input-group">
                                                                          <span class="input-group-addon" id="basic-addon1"><i id="spinAnimation1" class="fa fa-location-arrow" aria-hidden="true"></i></span>
                                                                            <select class="form-control" name="destination" id="destination" disabled="" required>
                                                                            <option value="" disabled selected>---Select City---</option>
                                                                            </select>   
                                                                       </div> 
                                                                       <div class="input-group">
                                                                          <span class="input-group-addon" id="basic-addon1"><i id="spinAnimation" class="fa fa-plane" aria-hidden="true"></i></span>
                                                                          <select class="form-control" name="destination2" id="destination2" disabled="" required>
                                                                          <option value="" disabled selected>---Select Airport---</option>
                                                                          </select>   
                                                                       </div>
                                                                      </fieldset>            
                                                                       
                                                                      <div class="form-group">
                                                                          <div class="row">
                                                                                  <div class="col-xs-6 col-md-6">
                                                                                 <label> Leave </label>
                                                                                    <input type="text" class="form-control date_leave" name="dateleave" id="date_leave" required placeholder="yyyy-mm-dd">
                                                                                  </div>
                                                                                  <div class="col-xs-6 col-md-6">
                                                                                  <label> Return </label>
                                                                                       <input type="text" class="form-control date_return" name="datereturn" id="date_return" required placeholder="yyyy-mm-dd">
                                                                                  </div>
                                                                          </div>
                                                                     </div> 
                                                                      <div class="form-group">
                                                                          <div class="row">
                                                                                  <div class="col-xs-6 col-md-6">
                                                                                      <label>Adult <small class="text-danger">[12 above]</small></label>
                                                                                      <select class="form-control"  name="adult" id="adult">
                                                                                              <?php for ($i=1; $i <= 9; $i++){
                                                                                                echo "<option value=".$i.">".$i."</option>";
                                                                                              }?>
                                                                                      </select>   
                                                                                  </div>
                                                                                  <div class="col-xs-6 col-md-6">
                                                                                      <label>Children <small class="text-danger">[2 - 11 yrs old]</small></label>
                                                                                      <select class="form-control" name="children" id="child">
                                                                                              <?php for ($i=0; $i <= 9; $i++){
                                                                                                echo "<option value=".$i.">".$i."</option>";
                                                                                              }?>
                                                                                      </select>   
                                                                                  </div>
                                                                          </div>
                                                                     </div> 
                                                                     <div class="form-group">
                                                                          <div class="row">
                                                                              <div class="col-xs-6 col-md-6">
                                                                                  <label>Infant <small class="text-danger">[1 - 23 months]</small></label>
                                                                                  <select class="form-control"  name="infant" id="infant">
                                                                                          <?php for ($i=0; $i <= 9; $i++){
                                                                                            echo "<option value=".$i.">".$i."</option>";
                                                                                          }?>
                                                                                  </select>  
                                                                              </div>
                                                                          </div>
                                                                     </div>   

                                                                     <div class="form-group">
                                                                          <div class="row">
                                                                              <div class="col-xs-6 col-md-6">
                                                                                  <label>Airlines</label>
                                                                                  <select class="form-control"  name="airlines">
                                                                                      <?php foreach ($airlines['T_DATA'] as $row):  ?>
                                                                                        <option value="<?php echo $row['code'] ?>"><?php echo $row['airline'] ?></option>
                                                                                      <?php endforeach ?>
                                                                                  </select>
                                                                              </div> 
                                                                              <div class="col-xs-6 col-md-6">
                                                                                  <label>Seat Class</label>
                                                                                  <select class="form-control"  name="class">
                                                                                      <option value="A">ALL</option>
                                                                                      <!-- <option value="E">Economy</option>
                                                                                      <option value="F">Full-Fare Economy</option>
                                                                                      <option value="B">Business</option> -->
                                                                                  </select> 
                                                                              </div>
                                                                          </div>
                                                                     </div> 
                                                                     <div class="form-group text-right">
                                                                          <button  class="btn btn-primary" type="submit" name="btnSearchBooking">Search</button>
                                                                     </div>
                                                                  </form>

                                                              </div>  <!-- col-xs-12 col-md-5" -->

                                                              <div class="col-xs-12 col-md-7">
                                                                <div class="panel panel-default">
                                                                  <div class="panel-heading"><h4 class="text-info" style="font-weight: bold;"><i class="fa fa-bell" aria-hidden="true"></i> IMPORTANT REMINDERS</h4></div>
                                                                  <div class="panel-body">
                                                                    <h4>Dear Business Partner,</h4>

                                                                    <p>Please note that as per standard IATA protocol, non-citizen passengers are required to present required travel document to support their one-way journey.</p>

                                                                    <p>You may refer to below list of sample accepted documents for your reference.</p>
                                                                    <ul>
                                                                      <li>1. Proof of a return or onward journey upon entry</li>
                                                                      <li>2. Travel Document to support one-way journey 
                                                                        <ul>
                                                                          <li>a. OEC</li>
                                                                          <li>b. Immigrant Visa</li>
                                                                          <li>c. Permanent Resident Card</li>
                                                                        </ul>
                                                                      </li>
                                                                    </ul>

                                                                    <p>Passenger is responsible for obtaining all required travel documents, visas and permits, and for complying with the laws, regulations, orders, demands and travel requirements of countries of origin, destination or transit.  Unified Products and Services is not liable for any issues the passenger might encounter for non-compliance on the required travel documentations.</p>

                                                                    <p>For inquiries and concerns, please feel free to contact our 24/7  Customer Support at the following numbers:</p>
                                                                    <ul>
                                                                      <li>Landline: 998-0991</li>
                                                                      <li>Smart: 0908-444-2728</li>
                                                                      <li>Globe: 0917-783-1922</li>
                                                                      <li>Sun: 0933-995-2860</li>
                                                                    </ul>

                                                                    <p>For ticketing concerns, please feel free to contact our Ticketing Support at the following numbers (09:00 AM to 07:00 PM):</p>
                                                                    <ul>
                                                                      <li>Globe: +63 961-339-9282</li>
                                                                      <li>Smart: +63 945-593-0210</li>
                                                                    </ul>

                                                                    <br/>
                                                                    
                                                                    <p>Thank you.</p>
                                                                    <br/>
                                                                    <p>Your Travel Partner,</p>
                                                                    <?php if ($user['CG'] =="UPS"){ ?>
                                                                        <img src="<?php echo BASE_URL()?>assets/images/ups.png" width="50" height="auto" alt="UPS" /> 
                                                                    <?php }else { ?>
                                                                          <img src="<?php echo BASE_URL()?>assets/images/GPRS.png" width="50" height="auto" alt="GPRS" /> 
                                                                    <?php } ?>

                                                                  </div>
                                                                </div>
                                                              </div>
                                                              
                                                            <?php elseif ($process === 1): ?>
                                                                <div class="col-xs-12 col-md-12">
                                                                <?php if ($output['S'] === 0): ?>
                                                                  <div class="alert alert-danger">
                                                                    <?php echo $output['M'] ?>
                                                                  </div>
                                                                <?php endif ?>
                                                                    <form action="<?php echo BASE_URL()?>Merged_intl_flights/book_international_flights" method="post" class="transaction_form" id="frmInternationalFlights">
                                                                            <div class="panel panel-info">
                                                                                  <div class="panel-heading"><b><span class="glyphicon glyphicon-plane" aria-hidden="true"></span> FLIGHT</b> 
                                                                                  <?php if ($flighttype == 1) { ?> 
                                                                                    <?php echo '- Round Trip'; ?>
                                                                                  <?php } else { ?>
                                                                                    <?php echo '- Oneway'; ?>
                                                                                  <?php } ?>
                                                                                  </div>
                                                                                  <div class="panel-body table-responsive" style="padding: 0px;">
                                                                                  <input name="collection" type="hidden" value='<?php echo json_encode($collection,true); ?>'>
                                                                                         <table class="table table-stripped">
                                                                                          <thead>
                                                                                              <!-- <th></th> -->
                                                                                              <th style="width:120px;" nowrap>Choose Flight</th>
                                                                                              <th style="border-right: 1px solid #d9edf7; text-align: center" nowrap colspan="3">Outbound</th>
                                                                                              <th style="border-right: 1px solid #d9edf7; text-align: center" nowrap colspan="<?php echo ($flighttype == 1)? '3':'1'; ?>"><?php echo ($flighttype == 1)? 'Return':'Flight Details'; ?></th>
                                                                                              <th nowrap>Total Fee &nbsp; &nbsp; &nbsp;</th>
                                                                                          </thead>
                                                                                          <tbody> 
                                                                                              <?php foreach ($result as $key): 

                                                                                                if($flighttype == 2){
                                                                                                  $onward = $key[0];
                                                                                                  $pricing = $key[1];
                                                                                                } else{
                                                                                                  $onward = $key[0];
                                                                                                  $omax = max(array_keys($onward['onward']));
                                                                                                  $return = $key[1];
                                                                                                  $rmax = max(array_keys($return['return']));
                                                                                                  $pricing = $key[2];
                                                                                                }   

                                                                                                $data = array();
                                                                                                $data['choosen'] = array($onward['onward'][0]['CarrierID'],$onward['onward'][0]['CarrierID'].'-'.$onward['onward'][0]["FlightNumber"],$onward['onward'][0]["Source"],$onward['onward'][0]["Destination"],$onward['onward'][0]["Class"],$onward['onward'][0]["WarningText"],$Passengers,$pricing['pricing']['currency'].' '.number_format($pricing['pricing']['BaseFareFee'],2),number_format($pricing['pricing']['TaxFee'] + $pricing['pricing']['SystemFee'] + $pricing['pricing']['MarkupFee'],2),$pricing['pricing']['currency'].' '.number_format($pricing['pricing']['TotalFee'],2),$pricing['pricing']['is_available'],$return['return'][0]['CarrierID'],$return['return'][0]['CarrierID'].'-'.$return['return'][0]["FlightNumber"],$return['return'][0]["Source"],$return['return'][0]["Destination"],$return['return'][0]["Class"],$return['return'][0]["WarningText"],
                                                                                                             $onward['onward'][1]['CarrierID'],$onward['onward'][1]['CarrierID'].'-'.$onward['onward'][1]["FlightNumber"],$onward['onward'][1]["Source"],$onward['onward'][1]["Destination"],$onward['onward'][1]["Class"],$onward['onward'][1]["WarningText"],
                                                                                                             $return['return'][1]['CarrierID'],$return['return'][1]['CarrierID'].'-'.$return['return'][1]["FlightNumber"],$return['return'][1]["Source"],$return['return'][1]["Destination"],$return['return'][1]["Class"],$return['return'][1]["WarningText"],

                                                                                                             $onward['onward'][2]['CarrierID'],$onward['onward'][2]['CarrierID'].'-'.$onward['onward'][2]["FlightNumber"],$onward['onward'][2]["Source"],$onward['onward'][2]["Destination"],$onward['onward'][2]["Class"],$onward['onward'][2]["WarningText"],
                                                                                                             $return['return'][2]['CarrierID'],$return['return'][2]['CarrierID'].'-'.$return['return'][2]["FlightNumber"],$return['return'][2]["Source"],$return['return'][2]["Destination"],$return['return'][2]["Class"],$return['return'][2]["WarningText"]);

                                                                                                $data['onward'] = $onward['onward'][0];
                                                                                                $data['connecting_onward'] = $onward['onward'][1];
                                                                                                $data['connecting_onward2'] = $onward['onward'][2];
                                                                                                $data['return'] = $return['return'][0];
                                                                                                $data['connecting_return'] = $return['return'][1];
                                                                                                $data['connecting_return2'] = $return['return'][2];
                                                                                                $data['pricing'] = $pricing['pricing'];

                                                                                                $count_connFlightOnwardset = count($onward['onward']);
                                                                                                $count_connFlightReturnset = count($return['return']);
                                                                                                  // $connFlightOnward = array();
                                                                                                  // for ($i=0; $i < count($onward['onward']); $i++) { 
                                                                                                  //   array_push($connFlightOnward,$onward['onward'][$i]["Source"].'&bull;&bull;&bull;',$onward['onward'][$i]["Destination"].'&bull;&bull;&bull;');
                                                                                                  // }
                                                                                                  // $connFlightOnwardset = array_unique($connFlightOnward);
                                                                                                  // $count_connFlightOnwardset = count($connFlightOnward);
                                                                                                  // //$onwardConnectingFlight = str_replace('|', '&nbsp;&mdash;&nbsp;',substr(implode(" ",$etona), 0, -1));
                                                                                                  // $onwardConnectingFlight = str_replace('|', '&bull;&bull;&bull;',preg_replace('/&bull;&bull;&bull;$/', '',implode(" ",$connFlightOnwardset)));


                                                                                                  // $connFlightReturn = array();
                                                                                                  // for ($i=0; $i < count($return['return']); $i++) { 
                                                                                                  //   array_push($connFlightReturn,$return['return'][$i]["Source"].'&bull;&bull;&bull;',$return['return'][$i]["Destination"].'&bull;&bull;&bull;');
                                                                                                  // }
                                                                                                  // $connFlightReturnset = array_unique($connFlightReturn);
                                                                                                  // $count_connFlightReturnset = count($connFlightReturn);
                                                                                                  // $returnConnectingFlight = str_replace('|', '&bull;&bull;&bull;',preg_replace('/&bull;&bull;&bull;$/', '',implode(" ",$connFlightReturnset)));
                                                                                              ?>
                                                                                              <tr> 
                                                                                                <td style="width:120px; text-align: center; vertical-align: middle;"><input type="radio" name="choose_flights" value='<?php echo json_encode(array($data)) ?>' data-toggle="modal" data-target="#myModal" onclick="get_data_new(this,div_flight_details)">
                                                                                                <?php // echo $pricing['pricing']['provider'];?>
                                                                                                </td>  
                                                                                                <!-- <td style="border-right: 1px solid #d9edf7;"><img src="<?php echo base_url('/assets/images/online_booking').'/'.$onward['onward'][0]['CarrierID'].'.png' ?>"></td> -->
                                                                                                <td nowrap><center><span style="font-size: 11px;"><?php echo '<span style="font-size: 11px;color: #04547C;">Departure Time</span><br>'.date("d M", strtotime(explode('T', $onward['onward'][0]['DepartureTimeStamp'])[0])).' '.date( 'g:i A', strtotime(explode('T', $onward['onward'][0]['DepartureTimeStamp'])[1])).'</span><br><b>'.$onward['onward'][0]['Source']; ?></b></center></td>   
                                                                                                <td nowrap style=" vertical-align: middle;"><center>
                                                                                                <img src="<?php echo base_url('/assets/images/online_booking').'/'.$onward['onward'][0]['CarrierID'].'.png' ?>"><br><br>
                                                                                                <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
<span rel="tooltip" data-toggle="tooltip" data-trigger="hover" data-placement="bottom" data-html="true" data-title="
<center>
<table>
<tr style='text-align: center;'><b> <?php if($count_connFlightOnwardset > 1){ echo 'Connecting Flights'; } else{ echo 'Direct Flights'; } ?> </b></tr>
<?php 
for ($i=0; $i < count($onward['onward']); $i++) { 
echo "<tr style='text-align: center;'><td nowrap><span style='font-size: 11px;color: #04547C;'>Departure Time</span><br>".date("d M", strtotime(explode('T', $onward['onward'][$i]['DepartureTimeStamp'])[0]))." ".date( 'g:i A', strtotime(explode('T', $onward['onward'][$i]['DepartureTimeStamp'])[1]))."<br>".$onward['onward'][$i]['Source']."</td>
<td nowrap><span style='font-size: 11px;color: #04547C;'>Flight No</span><br>".$onward['onward'][$i]['FlightNumber']."<br><span class='glyphicon glyphicon-unchecked' aria-hidden='true' style='color: #FFFF48'></span></td>
<td style='text-align: center;' nowrap><span style='font-size: 11px;color: #04547C;'>Arrival Time</span><br>".date("d M", strtotime(explode('T', $onward['onward'][$i]['ArrivalTimeStamp'])[0]))." ".date( 'g:i A', strtotime(explode('T', $onward['onward'][$i]['ArrivalTimeStamp'])[1]))."<br>".$onward['onward'][$i]['Destination']."</td></tr>";
}
?>
</tr>
</table>
</center>
" style="color:#04547C; cursor: pointer; max-width: none;">
                                                                                                <u><?php if($count_connFlightOnwardset > 1){ echo $count_connFlightOnwardset.' Stops'; } else{ echo 'Direct'; } ?></u>
                                                                                                </span>
                                                                                                <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"> </span></center>
                                                                                                </td>
                                                                                              <?php if($flighttype == 1) { ?>  
                                                                                                <td style="border-right: 1px solid #d9edf7;" nowrap><center><span style="font-size: 11px;"><?php echo '<span style="font-size: 11px;color: #04547C;">Arrival Time</span><br>'.date("d M", strtotime(explode('T', $onward['onward'][$omax]['ArrivalTimeStamp'])[0])).' '.date( 'g:i A', strtotime(explode('T', $onward['onward'][$omax]['ArrivalTimeStamp'])[1])).'</span><br><b>'.$onward['onward'][$omax]['Destination'] ?></b></center></td>    
                                                                                              <?php } else { ?>
                                                                                                <td style="border-right: 1px solid #d9edf7;" nowrap><center><span style="font-size: 11px;"><?php echo '<span style="font-size: 11px;color: #04547C;">Arrival Time</span><br>'.date("d M", strtotime(explode('T', $onward['onward'][0]['ArrivalTimeStamp'])[0])).' '.date( 'g:i A', strtotime(explode('T', $onward['onward'][0]['ArrivalTimeStamp'])[1])).'</span><br><b>'.$onward['onward'][0]['Destination'] ?></b></center></td>
                                                                                              <?php } ?> 
                                                                                                <?php if($flighttype == 1) { ?>                                                                                               
                                                                                                  <td nowrap style=""><center><span style="font-size: 11px;"><?php echo '<span style="font-size: 11px;color: #04547C;">Departure Time</span><br>'.date("d M", strtotime(explode('T', $return['return'][0]['DepartureTimeStamp'])[0])).' '.date( 'g:i A', strtotime(explode('T', $return['return'][0]['DepartureTimeStamp'])[1])).'</span><br><b>'.$return['return'][0]['Source']; ?></b></center></td>   
                                                                                                <?php } ?>

                                                                                              <?php if($flighttype == 1) { ?>  
                                                                                                <td nowrap style=" vertical-align: middle;">
                                                                                              <?php } else { ?>
                                                                                                <td style="vertical-align: middle; border-right: 1px solid #d9edf7;" nowrap>
                                                                                              <?php } ?> 
                                                                                                <center>
                                                                                              <?php if($flighttype == 1) { ?> 
                                                                                                <img src="<?php echo base_url('/assets/images/online_booking').'/'.$return['return'][0]['CarrierID'].'.png' ?>"><br><br>
                                                                                              <?php } ?> 
                                                                                                <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
<span rel="tooltip" data-toggle="tooltip" data-trigger="hover" data-placement="bottom" data-html="true" data-title="
<center>
<table>
<tr style='text-align: center;'><b> <?php if($count_connFlightReturnset > 1){ echo 'Connecting Flights'; } else{ echo 'Direct Flights'; } ?> </b></tr>
<?php 
for ($i=0; $i < count($return['return']); $i++) { 
echo "<tr style='text-align: center;'><td nowrap><span style='font-size: 11px;color: #04547C;'>Departure Time</span><br>".date("d M", strtotime(explode('T', $return['return'][$i]['DepartureTimeStamp'])[0]))." ".date( 'g:i A', strtotime(explode('T', $return['return'][$i]['DepartureTimeStamp'])[1]))."<br>".$return['return'][$i]['Source']."</td>
<td nowrap><span style='font-size: 11px;color: #04547C;'>Flight No</span><br>".$return['return'][$i]['FlightNumber']."<br><span class='glyphicon glyphicon-unchecked' aria-hidden='true' style='color: #FFFF48'></span></td>
<td style='text-align: center;' nowrap><span style='font-size: 11px;color: #04547C;'>Arrival Time</span><br>".date("d M", strtotime(explode('T', $return['return'][$i]['ArrivalTimeStamp'])[0]))." ".date( 'g:i A', strtotime(explode('T', $return['return'][$i]['ArrivalTimeStamp'])[1]))."<br>".$return['return'][$i]['Destination']."</td></tr>";
}
?>
</tr>
</table>
</center>
" style="color:#04547C; cursor: pointer;">
                                                                                                <u><?php if($count_connFlightReturnset > 1){ echo $count_connFlightReturnset.' Stops'; } else{ echo 'Direct'; } ?></u>
                                                                                                </span>
                                                                                                <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"> </span></center>
                                                                                                </td>   
                                                                                                <?php if($flighttype == 1) { ?>  
                                                                                                  <td style="border-right: 1px solid #d9edf7;" nowrap><center><span style="font-size: 11px;"><?php echo '<span style="font-size: 11px;color: #04547C;">Arrival Time</span><br>'.date("d M", strtotime(explode('T', $return['return'][$rmax]['ArrivalTimeStamp'])[0])).' '.date( 'g:i A', strtotime(explode('T', $return['return'][$rmax]['ArrivalTimeStamp'])[1])).'</span><br><b>'.$return['return'][$rmax]['Destination'] ?></b></center></td>  
                                                                                                <?php } ?> 
                                                                                                <td nowrap style="vertical-align: middle; font-size: medium;">
                                                                                                  <?php if($pricing['pricing']['commission'] > 0 && ($pricing['pricing']['provider'] == 'abacus' || $pricing['pricing']['provider'] == 'amadeus')) { ?> 
                                                                                                    <small>
                                                                                                      <strike>
                                                                                                        <strong><?php echo $pricing['pricing']['currency'].' '?></strong>
                                                                                                        <?php echo number_format($pricing['pricing']['TotalFeeBefore'], 2, '.', ',') ?>
                                                                                                        <!-- <strong>DISCOUNTED!</strong> -->
                                                                                                      </strike>
                                                                                                    </small>
                                                                                                    <br/>
                                                                                                    <span class="text-danger">
                                                                                                      <strong><?php echo $pricing['pricing']['currency'].' '?></strong>
                                                                                                      <?php echo number_format($pricing['pricing']['TotalFee'], 2, '.', ',') ?>
                                                                                                    </span>
                                                                                                  <?php } else { ?> 

                                                                                                    <strong><?php echo $pricing['pricing']['currency'].' '?></strong>
                                                                                                    <?php echo number_format($pricing['pricing']['TotalFee'], 2, '.', ',') ?>

                                                                                                  <?php } ?> 
                                                                                                </td>                                                                                                                                                                                                                               
                                                                                              </tr>
                                                                                              <?php endforeach ?>
                                                                                          </tbody>
                                                                                      </table>
                                                                                  </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-xs-12 col-md-12">
                                                                                <a href="<?php echo BASE_URL(); ?>Merged_intl_flights/book_international_flights">
                                                                                    <button id="booking_search" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-search">&nbsp;</span>Search New</button>
                                                                                </a>
                                                                                </div>
                                                                                <div class="col-xs-12 col-md-12 text-right">
                                                                                    <textarea name="flight_details" readonly hidden><?php echo $flight_details ?></textarea>
                                                                                    <textarea name="visaStatus" readonly hidden><?php echo $visaStatus ?></textarea>
                                                                                    <textarea name="cookie" readonly hidden><?php echo $cookie ?></textarea>
                                                                                    <button  class="btn btn-primary" type="submit" name="btnSelectFlight"><span class="glyphicon glyphicon-plane">&nbsp;</span>Choose Flight(s)</button>
                                                                                </div>
                                                                            </div>
                                                                    </form>
                                                                </div> <!-- col-md-9 -->

<div id="myModal" class="btn-moveDown modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close btn-moveDown" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Flight Details</h4>
      </div>
      <div class="modal-body alert alert-info gradient">
            <div class="margin-top-small margin-bottom-small well" id="div_flight_details" style="display: none;"></div>                          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-moveDown" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!--                                                                 <div class="col-md-3  alert alert-info gradient">
                                                                    <div class="margin-top-small margin-bottom-small well" id="div_flight_details" style="display: none;"></div>                          
                                                                </div> -->

                                                            <?php elseif ($process === 2): ?>
                                                              <div style="padding-bottom: 10px;">
                                                                  <form method="post" action="#" class="myform">
                                                                      <button type="submit" name="btnSelectFlight" class="btn btn-default-alt" style="background-color: transparent;"><span aria-hidden="true">&larr;</span> Back</button>
                                                                      <textarea name="collection" hidden><?php echo json_encode($collection2, true); ?></textarea>
                                                                      <input type="hidden" class="form-control" name="back" value="2">
                                                                      <input type="hidden" class="form-control" name="provider" value="<?php echo $provider; ?>">
                                                                  </form>
                                                              </div>
                                                                    <form action="<?php echo BASE_URL()?>Merged_intl_flights/book_international_flights" method="post" class="transaction_form" id="frmInternationalFlights">
                                                                      <div class="list-group col-md-12">
                                                                        <div class="list-group-item">

                                                                          <h4 style="font-weight: bold; color: #4169E1;">Passenger Details</h4>

                                                                          <table class="table" style="margin-bottom: 0;">
                                                                            <thead>
                                                                              <th>Type</th>
                                                                              <th>Title</th>
                                                                              <th class="text-center">First Name</th>
                                                                              <th class="text-center">Last Name</th>
                                                                              <th class="text-center">Age</th>
                                                                              <th class="text-center">Date of Birth</th>
                                                                              
                                                                              <th class="text-center">Onward Baggage</th>
                                                                              
                                                                              <?php if ($returnbaggages): ?>
                                                                                  <th class="text-center">Return Baggage</th>
                                                                              <?php endif;?>

                                                                              <?php if($provider == 'scoot'): ?>
                                                                                 <th class="text-center">Gender</th>
                                                                              <?php endif;?> 
                                                                            </thead>
                                                                          </table>
                                                                              <?php $no = 0; foreach ($passengers as $passenger): ?>
                                                                                <?php $no + 1; ?>

                                                                                <!-- ADULT -->
                                                                                <?php if($passenger['Type'] == 'A'): ?>
                                                                                  <!-- <h5 style="font-weight: bold; color: #4169E1; text-align: right;"><span class="badge">(<?php echo $no + 1; ?>) ADULT PASSENGER</span></h5> -->
                                                                                  <table class="table">
                                                                                    <tbody>
                                                                                      <tr>
                                                                                        <td class="" style="font-weight: bold; font-size:11px;vertical-align: middle;"> <!-- <span class="badge"> <?php echo $no + 1; ?> </span> --> ADULT PASSENGER</td>
                                                                                        <td class="text-center">
                                                                                          <select class="form-control" name="<?php echo 'a_title'.$no ?>" id="title" style="max-width: 90px;margin:auto;" required>
                                                                                              <option value="">Select</option>
                                                                                              <option value="1">Mr</option>
                                                                                              <!-- <option value="2">Mrs</option> -->
                                                                                              <option value="2">Ms</option>
                                                                                              <!-- <option value="4">Mstr</option> -->
                                                                                          </select>   
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                          <input type="text" class="form-control Intlinput" name="<?php echo 'a_fname'.$no ?>" pattern="[a-zA-Z\s]+" placeholder="First Name" required>
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                          <input type="text" class="form-control Intlinput" name="<?php echo 'a_lname'.$no ?>" pattern="[a-zA-Z\s]+" placeholder="Last Name"  required>
                                                                                        </td>
                                                                                        <td class="text-center" style="vertical-align: middle"><div style="font-size:10px;"><span class="badge badge-warning <?php echo 'getAdultAge'.$no ?>"></span> YEAR(S)</div></td>
                                                                                        <td class="text-center">
                                                                                          <input type="text" class="form-control <?php echo 'datepickerAdult'.$no ?>" name="<?php echo 'a_bdate'.$no ?>" id="birthdate" style="max-width: 110px;margin:auto;" placeholder="mm/dd/yyyy" required>
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                          <select style="max-width: 250px;margin:auto;" class="form-control" name="<?php echo 'a_baggage_onward'.$no ?>" id="baggage_onward">
                                                                                            <?php $i = -1;foreach ($onwardbaggages as $OB): ?>
                                                                                                <?php if ($OB == $onwardbaggages[0]): ?>
                                                                                                    <option disabled value="<?php echo $i + 1 ?>"><?php echo $OB ?></option> 
                                                                                                <?php elseif($OB == $onwardbaggages[1]): ?>
                                                                                                    <option value="<?php echo $i + 1 ?>"><?php echo $OB ?></option>
                                                                                                <?php else: ?>
                                                                                                    <option value="<?php echo $i + 1 ?>"><?php echo 'Kg '.explode(";", $OB)[0].' '.'PHP '.explode(";", $OB)[1];  ?></option>  
                                                                                                <?php endif ?>
                                                                                                <?php $i++; ?>
                                                                                            <?php endforeach ?>
                                                                                         </select> 
                                                                                        </td>
                                                                                        <?php if ($returnbaggages): ?>
                                                                                          <td class="text-center">
                                                                                            <select style="max-width: 250px;margin:auto;" class="form-control" name="<?php echo 'a_baggage_return'.$no ?>" id="baggage_return">
                                                                                               <?php $i = -1; foreach ($returnbaggages as $RB): ?>
                                                                                                    <?php if ($RB == $returnbaggages[0]): ?>
                                                                                                        <option disabled value="<?php echo $i + 1 ?>"><?php echo $RB ?></option> 
                                                                                                    <?php elseif($RB == $returnbaggages[1]): ?>
                                                                                                        <option value="<?php echo $i + 1 ?>"><?php echo $RB ?></option>
                                                                                                    <?php else: ?>
                                                                                                        <option value="<?php echo $i + 1 ?>"><?php echo 'Kg '.explode(";", $RB)[0].' '.'PHP '.explode(";", $RB)[1];  ?></option>  
                                                                                                    <?php endif ?>
                                                                                                    <?php $i++; ?>
                                                                                                <?php endforeach ?>
                                                                                            </select> 
                                                                                          </td>
                                                                                        <?php endif ?>

                                                                                        <?php if($provider == 'scoot'): ?>
                                                                                          <td colspan="" class="text-left">
                                                                                            <select style="" class="form-control" name="<?php echo 'a_gender'.$no ?>" id="pgender" required>
                                                                                              <option value="" selected>Select Gender</option>  
                                                                                              <option value="Male">Male</option> 
                                                                                              <option value="Female">Female</option>  
                                                                                             </select> 
                                                                                          </td>
                                                                                        <?php endif ?>
                                                                                          
                                                                                      </tr>
                                                                                    </tbody>
                                                                                  </table>

                                                                                  <?php if($provider == 'byaheko'): ?>
                                                                                    <table class="table">
                                                                                      <tbody>  
                                                                                        <tr>
                                                                                          <td colspan="2" class="text-left">  
                                                                                            <small><b>Adult Documents</b></small>
                                                                                          </td>
                                                                                          <td class="text-left">
                                                                                            <small>Passport Number:</small>
                                                                                            <input type="text" class="form-control" name="<?php echo 'a_passportno'.$no ?>" placeholder="Passport Number" required>
                                                                                          </td>
                                                                                          <td class="text-left">
                                                                                            <small>Passport Expiry Date:</small>
                                                                                            <input type="text" class="form-control datepickerExpiry" name="<?php echo 'a_passportexpiry'.$no ?>" id="passportexpiry" placeholder="mm/dd/yyyy" required>
                                                                                          </td>
                                                                                          <td colspan="2" class="text-left">
                                                                                            <small>Passport Issuing Country:</small>
                                                                                            <!-- <input type="text" class="form-control" name="<?php echo 'a_ppissuingcountry'.$no ?>" placeholder="Passport Issuing Country" required> -->
                                                                                            <select class="form-control" name="<?php echo 'a_ppissuingcountry'.$no ?>" id="" required >
                                                                                              <option value="" disabled selected>---Select Passport Issuing Country---</option>
                                                                                              <?php foreach ($airports as $row): ?>
                                                                                                <option value="<?php echo $row ?>"><?php echo $row ?></option>
                                                                                              <?php endforeach ?>
                                                                                            </select>
                                                                                          </td>
                                                                                          <td colspan="2" class="text-left">
                                                                                            <small>Nationality:</small>
                                                                                            <input type="text" class="form-control" name="<?php echo 'a_nationality '.$no ?>" placeholder="Nationality" required>
                                                                                          </td>
                                                                                        </tr>
                                                                                      </tbody>
                                                                                    </table>
                                                                                  <?php endif ?>

                                                                                  <?php if($provider == 'amadeus' || $provider == 'abacus'): ?>
                                                                                    <table class="table">
                                                                                      <tbody>  
                                                                                        <tr>
                                                                                          <td colspan="2" class="text-left">  
                                                                                            <span><b>Adult Passport</b></span>
                                                                                          </td>
                                                                                          <td class="text-left">
                                                                                            <span>Passport Number:</span>
                                                                                            <input type="text" class="form-control" name="<?php echo 'a_passportno'.$no ?>" placeholder="Passport Number" required>
                                                                                          </td>
                                                                                          <td class="text-left">
                                                                                            <span>Passport Expiry Date:</span>
                                                                                            <input type="text" class="form-control datepickerExpiry" name="<?php echo 'a_passportexpiry'.$no ?>" id="passportexpiry" placeholder="mm/dd/yyyy" required>
                                                                                          </td>
                                                                                          <td colspan="" class="text-left">
                                                                                            <span>Passport Issuing Country:</span>
                                                                                            <select style="" class="form-control" name="<?php echo 'a_ppissuingcountry'.$no ?>" id="ppissuingcountry" required>
                                                                                              <option value="" selected>Select Passport Issuing Country</option>  
                                                                                                <?php $i = 0 ;foreach ($country as $val): ?>
                                                                                                     
                                                                                                        <option value="<?php echo $val['code']; ?>"><?php echo $val['country']; ?></option>  
                                                                                                    
                                                                                                    <?php $i++; ?>
                                                                                                <?php endforeach ?>
                                                                                             </select> 
                                                                                          </td>
                                                                                          <!-- <td colspan="" class="text-left">
                                                                                            <span>Passport Picture:</span>
                                                                                            <input type="file" class="form-control required btnUploadPassport" data-mynumber="<?php echo $no; ?>" id="<?php echo 'filepassport'.$no ?>" name="<?php echo 'filepassport'.$no ?>" title="No File Found" onchange="ValidateUploadFile(this);"  required='required' >
                                                                                            <input type="hidden" name="<?php echo 'passportImg'.$no ?>" id="<?php echo 'passportImg'.$no ?>" value='' readonly >
                                                                                            <div class="" style="display:none;margin-bottom: 0;padding: 5;" id='<?php echo 'uploadmessage'.$no ?>'></div>
                                                                                          </td>  -->
                                                                                        </tr>

                                                                                      <?php if($visaStatus == 0): ?>
                                                                                        <tr>
                                                                                          <td colspan="2" class="text-left">  
                                                                                            <span><b>Adult Visa</b></span>
                                                                                          </td>
                                                                                          <td class="text-left">
                                                                                            <span>Visa Number:</span>
                                                                                            <input type="text" class="form-control" name="<?php echo 'a_visano'.$no ?>" placeholder="Visa Number" required>
                                                                                          </td>
                                                                                          <td class="text-left">
                                                                                            <span>Visa Expiry Date:</span>
                                                                                            <input type="text" class="form-control datepickerExpiry" name="<?php echo 'a_visaexpiry'.$no ?>" id="visaexpiry" placeholder="mm/dd/yyyy" required>
                                                                                          </td>
                                                                                          <td colspan="" class="text-left">
                                                                                            <span>Visa Issuing Country:</span>
                                                                                            <select style="" class="form-control" name="<?php echo 'a_visaissuingcountry'.$no ?>" id="visaissuingcountry" required>
                                                                                              <option value="" selected>Select Visa Issuing Country</option>  
                                                                                                <?php $i = 0 ;foreach ($country as $val): ?>
                                                                                                     
                                                                                                        <option value="<?php echo $val['code']; ?>"><?php echo $val['country']; ?></option>  
                                                                                                    
                                                                                                    <?php $i++; ?>
                                                                                                <?php endforeach ?>
                                                                                             </select> 
                                                                                          </td>
                                                                                          <td colspan="" class="text-left">
                                                                                            <span>Visa Picture:</span>
                                                                                            <input type="file" class="form-control required btnUploadVisa" data-mynumbervisa="<?php echo $no; ?>" id="<?php echo 'filevisa'.$no ?>" name="<?php echo 'filevisa'.$no ?>" title="No File Found" onchange="ValidateUploadFile(this);" required='required' >
                                                                                            <input type="hidden" name="<?php echo 'visaImg'.$no ?>" id="<?php echo 'visaImg'.$no ?>" value='' readonly >
                                                                                            <div class="" style="display:none;margin-bottom: 0;padding: 5;" id='<?php echo 'uploadmessagevisa'.$no ?>'></div>
                                                                                          </td> 
                                                                                        </tr>
                                                                                      <?php endif;?>
                                                                                      </tbody>
                                                                                    </table>
                                                                                  <?php endif;?>

                                                                                  <?php if($provider == 'scoot'): ?>
                                                                                    <table class="table">
                                                                                      <tbody>  
                                                                                        <tr>
                                                                                          <td colspan="" class="text-left">  
                                                                                            <span><b>Adult Passport</b></span>
                                                                                          </td>
                                                                                          <td class="text-left">
                                                                                            <small>Passport Number:</small>
                                                                                            <input type="text" class="form-control" name="<?php echo 'a_passportno'.$no ?>" placeholder="Passport Number" required>
                                                                                          </td>
                                                                                          <td class="text-left">
                                                                                            <small>Passport Expiry Date:</small>
                                                                                            <input type="text" class="form-control datepickerExpiry" name="<?php echo 'a_passportexpiry'.$no ?>" id="passportexpiry" placeholder="mm/dd/yyyy" required>
                                                                                          </td>
                                                                                          <td colspan="" class="text-left">
                                                                                            <small>Passport Issuing Country:</small>
                                                                                            <select style="" class="form-control" name="<?php echo 'a_ppissuingcountry'.$no ?>" id="ppissuingcountry" required>
                                                                                              <option value="" selected>Select Passport Issuing Country</option>  
                                                                                                <?php $i = 0 ;foreach ($country as $val): ?>
                                                                                                     
                                                                                                        <option value="<?php echo $val['code']; ?>"><?php echo $val['country']; ?></option>  
                                                                                                    
                                                                                                    <?php $i++; ?>
                                                                                                <?php endforeach ?>
                                                                                             </select> 
                                                                                          </td>
                                                                                          <td colspan="" class="text-left">
                                                                                            <small>Resident Country:</small>
                                                                                            <select style="" class="form-control" name="<?php echo 'a_residentcountry'.$no ?>" id="pResidentCountry" required>
                                                                                              <option value="" selected>Select Resident Country</option>  
                                                                                                <?php $i = 0 ;foreach ($country as $val): ?>
                                                                                                     
                                                                                                        <option value="<?php echo $val['code']; ?>"><?php echo $val['country']; ?></option>  
                                                                                                    
                                                                                                    <?php $i++; ?>
                                                                                                <?php endforeach ?>
                                                                                             </select> 
                                                                                          </td>
                                                                                          <!-- <td colspan="" class="text-left">
                                                                                            <small>Passport Picture:</small>
                                                                                            <input type="file" class="form-control required btnUploadPassport" data-mynumber="<?php echo $no; ?>" id="<?php echo 'filepassport'.$no ?>" name="<?php echo 'filepassport'.$no ?>" title="No File Found" onchange="ValidateUploadFile(this);"  required='required' >
                                                                                            <input type="hidden" name="<?php echo 'passportImg'.$no ?>" id="<?php echo 'passportImg'.$no ?>" value='' readonly >
                                                                                            <div class="" style="display:none;margin-bottom: 0;padding: 5;" id='<?php echo 'uploadmessage'.$no ?>'></div>
                                                                                          </td>  -->
                                                                                        </tr>

                                                                                      <?php if($visaStatus == 0): ?>
                                                                                        <tr>
                                                                                          <td colspan="2" class="text-left">  
                                                                                            <span><b>Adult Visa</b></span>
                                                                                          </td>
                                                                                          <td class="text-left">
                                                                                            <small>Visa Number:</small>
                                                                                            <input type="text" class="form-control" name="<?php echo 'a_visano'.$no ?>" placeholder="Visa Number" required>
                                                                                          </td>
                                                                                          <td class="text-left">
                                                                                            <small>Visa Expiry Date:</small>
                                                                                            <input type="text" class="form-control datepickerExpiry" name="<?php echo 'a_visaexpiry'.$no ?>" id="visaexpiry" placeholder="mm/dd/yyyy" required>
                                                                                          </td>
                                                                                          <td colspan="" class="text-left">
                                                                                            <small>Visa Issuing Country:</small>
                                                                                            <select style="" class="form-control" name="<?php echo 'a_visaissuingcountry'.$no ?>" id="visaissuingcountry" required>
                                                                                              <option value="" selected>Select Visa Issuing Country</option>  
                                                                                                <?php $i = 0 ;foreach ($country as $val): ?>
                                                                                                     
                                                                                                        <option value="<?php echo $val['code']; ?>"><?php echo $val['country']; ?></option>  
                                                                                                    
                                                                                                    <?php $i++; ?>
                                                                                                <?php endforeach ?>
                                                                                             </select> 
                                                                                          </td>
                                                                                          <td colspan="" class="text-left">
                                                                                            <small>Visa Picture:</small>
                                                                                            <input type="file" class="form-control required btnUploadVisa" data-mynumbervisa="<?php echo $no; ?>" id="<?php echo 'filevisa'.$no ?>" name="<?php echo 'filevisa'.$no ?>" title="No File Found" onchange="ValidateUploadFile(this);" required='required' >
                                                                                            <input type="hidden" name="<?php echo 'visaImg'.$no ?>" id="<?php echo 'visaImg'.$no ?>" value='' readonly >
                                                                                            <div class="" style="display:none;margin-bottom: 0;padding: 5;" id='<?php echo 'uploadmessagevisa'.$no ?>'></div>
                                                                                          </td> 
                                                                                        </tr>
                                                                                      <?php endif;?>
                                                                                      </tbody>
                                                                                    </table>
                                                                                  <?php endif;?>
                                                                                <!-- ADULT -->

                                                                                <!-- CHILD -->
                                                                                <?php elseif($passenger['Type'] == 'C'): ?>
                                                                                  <!-- <h5 style="font-weight: bold; color: #4169E1; text-align: right;"><span class="badge">(<?php echo $no + 1; ?>) CHILD PASSENGER</span></h5> -->
                                                                                  <table class="table">
                                                                                    <tbody>
                                                                                      <tr>
                                                                                        <td class="text-success" style="font-weight: bold; font-size:11px;vertical-align: middle;"> <!-- <span class="badge"> <?php echo $no + 1; ?> </span> --> CHILD PASSENGER</td>
                                                                                        <td class="text-center">
                                                                                          <select class="form-control" name="<?php echo 'c_title'.$no ?>" id="title" style="max-width: 90px;margin:auto;" required>
                                                                                              <option value="">Select</option>
                                                                                              <!-- <option value="1">Mr</option>
                                                                                              <option value="2">Mrs</option> -->
                                                                                              <option value="3">Miss</option>
                                                                                              <option value="4">Mstr</option>
                                                                                          </select>   
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                          <input type="text" class="form-control Intlinput" name="<?php echo 'c_fname'.$no ?>" pattern="[a-zA-Z\s]+" placeholder="First Name" required>
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                          <input type="text" class="form-control Intlinput" name="<?php echo 'c_lname'.$no ?>" pattern="[a-zA-Z\s]+" placeholder="Last Name" required>
                                                                                        </td>
                                                                                        <td class="text-center" style="vertical-align: middle"><div style="font-size:10px;"><span class="badge badge-warning <?php echo 'getChildAge'.$no ?>"></span> YEAR(S)</div></td>
                                                                                        <td class="text-center">
                                                                                          <input type="text" class="form-control <?php echo 'datepickerChildren'.$no ?>" name="<?php echo 'c_bdate'.$no ?>" id="birthdate" style="max-width: 110px;margin:auto;" placeholder="mm/dd/yyyy" required>
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                          <select style="max-width: 250px;margin:auto;" class="form-control" name="<?php echo 'c_baggage_onward'.$no ?>" id="baggage_onward">
                                                                                            <?php $i = -1;foreach ($onwardbaggages as $OB): ?>
                                                                                                <?php if ($OB == $onwardbaggages[0]): ?>
                                                                                                    <option disabled value="<?php echo $i + 1 ?>"><?php echo $OB ?></option> 
                                                                                                <?php elseif($OB == $onwardbaggages[1]): ?>
                                                                                                    <option value="<?php echo $i + 1 ?>"><?php echo $OB ?></option>
                                                                                                <?php else: ?>
                                                                                                    <option value="<?php echo $i + 1 ?>"><?php echo 'Kg '.explode(";", $OB)[0].' '.'PHP '.explode(";", $OB)[1];  ?></option>  
                                                                                                <?php endif ?>
                                                                                                <?php $i++; ?>
                                                                                            <?php endforeach ?>
                                                                                          </select> 
                                                                                        </td>
                                                                                        <?php if ($returnbaggages): ?>
                                                                                          <td class="text-center">
                                                                                            <select style="max-width: 250px;margin:auto;" class="form-control" name="<?php echo 'c_baggage_return'.$no ?>" id="baggage_return">
                                                                                               <?php $i = -1; foreach ($returnbaggages as $RB): ?>
                                                                                                    <?php if ($RB == $returnbaggages[0]): ?>
                                                                                                        <option disabled value="<?php echo $i + 1 ?>"><?php echo $RB ?></option> 
                                                                                                    <?php elseif($RB == $returnbaggages[1]): ?>
                                                                                                        <option value="<?php echo $i + 1 ?>"><?php echo $RB ?></option>
                                                                                                    <?php else: ?>
                                                                                                        <option value="<?php echo $i + 1 ?>"><?php echo 'Kg '.explode(";", $RB)[0].' '.'PHP '.explode(";", $RB)[1];  ?></option>  
                                                                                                    <?php endif ?>
                                                                                                    <?php $i++; ?>
                                                                                                <?php endforeach ?>
                                                                                            </select> 
                                                                                          </td>
                                                                                        <?php endif ?>

                                                                                        <?php if($provider == 'scoot'): ?>
                                                                                          <td colspan="" class="text-left">
                                                                                            <select style="" class="form-control" name="<?php echo 'c_gender'.$no ?>" id="cgender" required>
                                                                                              <option value="" selected>Select Gender</option>  
                                                                                              <option value="Male">Male</option> 
                                                                                              <option value="Female">Female</option>  
                                                                                             </select> 
                                                                                          </td>
                                                                                        <?php endif ?>
                                                                                          
                                                                                      </tr>
                                                                                    </tbody>
                                                                                  </table>

                                                                                  <?php if($provider == 'byaheko'): ?>
                                                                                    <table class="table">
                                                                                      <tbody>
                                                                                        <tr>
                                                                                          <td colspan="2" class="text-left">  
                                                                                            <small><b>Child Documents</b></small>
                                                                                          </td>
                                                                                          <td class="text-left">
                                                                                            <small>Passport Number:</small>
                                                                                            <input type="text" class="form-control" name="<?php echo 'c_passportno'.$no ?>" placeholder="Passport Number" required>
                                                                                          </td>
                                                                                          <td class="text-left">
                                                                                            <small>Passport Expiry Date:</small>
                                                                                            <input type="text" class="form-control datepickerExpiry" name="<?php echo 'c_passportexpiry'.$no ?>" id="passportexpiry" placeholder="mm/dd/yyyy" required>
                                                                                          </td>
                                                                                          <td colspan="2" class="text-left">
                                                                                            <small>Passport Issuing Country:</small>
                                                                                            <!-- <input type="text" class="form-control" name="<?php echo 'c_ppissuingcountry'.$no ?>" placeholder="Passport Issuing Country" required> -->
                                                                                            <select class="form-control" name="<?php echo 'c_ppissuingcountry'.$no ?>" id="" required >
                                                                                              <option value="" disabled selected>---Select Passport Issuing Country---</option>
                                                                                              <?php foreach ($airports as $row): ?>
                                                                                                <option value="<?php echo $row ?>"><?php echo $row ?></option>
                                                                                              <?php endforeach ?>
                                                                                            </select>
                                                                                          </td>
                                                                                          <td colspan="2" class="text-left">
                                                                                            <small>Nationality:</small>
                                                                                            <input type="text" class="form-control" name="<?php echo 'c_nationality '.$no ?>" placeholder="Nationality" required>
                                                                                          </td>
                                                                                        </tr>
                                                                                      </tbody>
                                                                                    </table>
                                                                                  <?php endif ?>

                                                                                  <?php if($provider == 'amadeus' || $provider == 'abacus'): ?>
                                                                                    <table class="table">
                                                                                      <tbody>  
                                                                                        <tr>
                                                                                          <td colspan="2" class="text-left">  
                                                                                            <span><b>Child Passport</b></span>
                                                                                          </td>
                                                                                          <td class="text-left">
                                                                                            <span>Passport Number:</span>
                                                                                            <input type="text" class="form-control" name="<?php echo 'c_passportno'.$no ?>" placeholder="Passport Number" required>
                                                                                          </td>
                                                                                          <td class="text-left">
                                                                                            <span>Passport Expiry Date:</span>
                                                                                            <input type="text" class="form-control datepickerExpiry" name="<?php echo 'c_passportexpiry'.$no ?>" id="passportexpiry" placeholder="mm/dd/yyyy" required>
                                                                                          </td>
                                                                                          <td colspan="" class="text-left">
                                                                                            <span>Passport Issuing Country:</span>
                                                                                            <select style="" class="form-control" name="<?php echo 'c_ppissuingcountry'.$no ?>" id="c_ppissuingcountry" required>
                                                                                              <option value="" selected>Select Passport Issuing Country</option>  
                                                                                                <?php $i = 0 ;foreach ($country as $val): ?>
                                                                                                     
                                                                                                        <option value="<?php echo $val['code']; ?>"><?php echo $val['country']; ?></option>  
                                                                                                    
                                                                                                    <?php $i++; ?>
                                                                                                <?php endforeach ?>
                                                                                             </select> 
                                                                                          </td>
                                                                                          <!-- <td colspan="" class="text-left">
                                                                                            <span>Passport Picture:</span>
                                                                                            <input type="file" class="form-control required btnUploadPassport" data-mynumber="<?php echo $no; ?>" id="<?php echo 'filepassport'.$no ?>" name="<?php echo 'filepassport'.$no ?>" title="No File Found" onchange="ValidateUploadFile(this);"  required='required' >
                                                                                            <input type="hidden" name="<?php echo 'passportImg'.$no ?>" id="<?php echo 'passportImg'.$no ?>" value='' readonly >
                                                                                            <div class="" style="display:none;margin-bottom: 0;padding: 5;" id='<?php echo 'uploadmessage'.$no ?>'></div>
                                                                                          </td>  -->
                                                                                        </tr>

                                                                                      <?php if($visaStatus == 0): ?>
                                                                                        <tr>
                                                                                          <td colspan="2" class="text-left">  
                                                                                            <span><b>Child Visa</b></span>
                                                                                          </td>
                                                                                          <td class="text-left">
                                                                                            <span>Visa Number:</span>
                                                                                            <input type="text" class="form-control" name="<?php echo 'c_visano'.$no ?>" placeholder="Visa Number" required>
                                                                                          </td>
                                                                                          <td class="text-left">
                                                                                            <span>Visa Expiry Date:</span>
                                                                                            <input type="text" class="form-control datepickerExpiry" name="<?php echo 'c_visaexpiry'.$no ?>" id="visaexpiry" placeholder="mm/dd/yyyy" required>
                                                                                          </td>
                                                                                          <td colspan="" class="text-left">
                                                                                            <span>Visa Issuing Country:</span>
                                                                                            <select style="" class="form-control" name="<?php echo 'c_visaissuingcountry'.$no ?>" id="c_visaissuingcountry" required>
                                                                                              <option value="" selected>Select Visa Issuing Country</option>  
                                                                                                <?php $i = 0 ;foreach ($country as $val): ?>
                                                                                                     
                                                                                                        <option value="<?php echo $val['code']; ?>"><?php echo $val['country']; ?></option>  
                                                                                                    
                                                                                                    <?php $i++; ?>
                                                                                                <?php endforeach ?>
                                                                                             </select> 
                                                                                          </td>
                                                                                          <td colspan="" class="text-left">
                                                                                            <span>Visa Picture:</span>
                                                                                            <input type="file" class="form-control required btnUploadVisa" data-mynumbervisa="<?php echo $no; ?>" id="<?php echo 'filevisa'.$no ?>" name="<?php echo 'filevisa'.$no ?>" title="No File Found" onchange="ValidateUploadFile(this);" required='required' >
                                                                                            <input type="hidden" name="<?php echo 'visaImg'.$no ?>" id="<?php echo 'visaImg'.$no ?>" value='' readonly >
                                                                                            <div class="" style="display:none;margin-bottom: 0;padding: 5;" id='<?php echo 'uploadmessagevisa'.$no ?>'></div>
                                                                                          </td> 

                                                                                        </tr>
                                                                                      <?php endif;?>
                                                                                      </tbody>
                                                                                    </table>
                                                                                  <?php endif;?>

                                                                                  <?php if($provider == 'scoot'): ?>
                                                                                    <table class="table">
                                                                                      <tbody>  
                                                                                        <tr>
                                                                                          <td colspan="" class="text-left">  
                                                                                            <span><b>Child Passport</b></span>
                                                                                          </td>
                                                                                          <td class="text-left">
                                                                                            <span>Passport Number:</span>
                                                                                            <input type="text" class="form-control" name="<?php echo 'c_passportno'.$no ?>" placeholder="Passport Number" required>
                                                                                          </td>
                                                                                          <td class="text-left">
                                                                                            <span>Passport Expiry Date:</span>
                                                                                            <input type="text" class="form-control datepickerExpiry" name="<?php echo 'c_passportexpiry'.$no ?>" id="passportexpiry" placeholder="mm/dd/yyyy" required>
                                                                                          </td>
                                                                                          <td colspan="" class="text-left">
                                                                                            <span>Passport Issuing Country:</span>
                                                                                            <select style="" class="form-control" name="<?php echo 'c_ppissuingcountry'.$no ?>" id="c_ppissuingcountry" required>
                                                                                              <option value="" selected>Select Passport Issuing Country</option>  
                                                                                                <?php $i = 0 ;foreach ($country as $val): ?>
                                                                                                     
                                                                                                        <option value="<?php echo $val['code']; ?>"><?php echo $val['country']; ?></option>  
                                                                                                    
                                                                                                    <?php $i++; ?>
                                                                                                <?php endforeach ?>
                                                                                             </select> 
                                                                                          </td>
                                                                                          <td colspan="" class="text-left">
                                                                                            <small>Resident Country:</small>
                                                                                            <select style="" class="form-control" name="<?php echo 'c_residentcountry'.$no ?>" id="cResidentCountry" required>
                                                                                              <option value="" selected>Select Resident Country</option>  
                                                                                                <?php $i = 0 ;foreach ($country as $val): ?>
                                                                                                     
                                                                                                        <option value="<?php echo $val['code']; ?>"><?php echo $val['country']; ?></option>  
                                                                                                    
                                                                                                    <?php $i++; ?>
                                                                                                <?php endforeach ?>
                                                                                             </select> 
                                                                                          </td>
                                                                                          <!-- <td colspan="" class="text-left">
                                                                                            <span>Passport Picture:</span>
                                                                                            <input type="file" class="form-control required btnUploadPassport" data-mynumber="<?php echo $no; ?>" id="<?php echo 'filepassport'.$no ?>" name="<?php echo 'filepassport'.$no ?>" title="No File Found" onchange="ValidateUploadFile(this);"  required='required' >
                                                                                            <input type="hidden" name="<?php echo 'passportImg'.$no ?>" id="<?php echo 'passportImg'.$no ?>" value='' readonly >
                                                                                            <div class="" style="display:none;margin-bottom: 0;padding: 5;" id='<?php echo 'uploadmessage'.$no ?>'></div>
                                                                                          </td>  -->
                                                                                        </tr>

                                                                                      <?php if($visaStatus == 0): ?>
                                                                                        <tr>
                                                                                          <td colspan="2" class="text-left">  
                                                                                            <span><b>Child Visa</b></span>
                                                                                          </td>
                                                                                          <td class="text-left">
                                                                                            <span>Visa Number:</span>
                                                                                            <input type="text" class="form-control" name="<?php echo 'c_visano'.$no ?>" placeholder="Visa Number" required>
                                                                                          </td>
                                                                                          <td class="text-left">
                                                                                            <span>Visa Expiry Date:</span>
                                                                                            <input type="text" class="form-control datepickerExpiry" name="<?php echo 'c_visaexpiry'.$no ?>" id="visaexpiry" placeholder="mm/dd/yyyy" required>
                                                                                          </td>
                                                                                          <td colspan="" class="text-left">
                                                                                            <span>Visa Issuing Country:</span>
                                                                                            <select style="" class="form-control" name="<?php echo 'c_visaissuingcountry'.$no ?>" id="c_visaissuingcountry" required>
                                                                                              <option value="" selected>Select Visa Issuing Country</option>  
                                                                                                <?php $i = 0 ;foreach ($country as $val): ?>
                                                                                                     
                                                                                                        <option value="<?php echo $val['code']; ?>"><?php echo $val['country']; ?></option>  
                                                                                                    
                                                                                                    <?php $i++; ?>
                                                                                                <?php endforeach ?>
                                                                                             </select> 
                                                                                          </td>
                                                                                          <td colspan="" class="text-left">
                                                                                            <span>Visa Picture:</span>
                                                                                            <input type="file" class="form-control required btnUploadVisa" data-mynumbervisa="<?php echo $no; ?>" id="<?php echo 'filevisa'.$no ?>" name="<?php echo 'filevisa'.$no ?>" title="No File Found" onchange="ValidateUploadFile(this);" required='required' >
                                                                                            <input type="hidden" name="<?php echo 'visaImg'.$no ?>" id="<?php echo 'visaImg'.$no ?>" value='' readonly >
                                                                                            <div class="" style="display:none;margin-bottom: 0;padding: 5;" id='<?php echo 'uploadmessagevisa'.$no ?>'></div>
                                                                                          </td> 

                                                                                        </tr>
                                                                                      <?php endif;?>
                                                                                      </tbody>
                                                                                    </table>
                                                                                  <?php endif;?>
                                                                                <!-- CHILD -->

                                                                                <!-- INFANT -->
                                                                                <?php elseif($passenger['Type'] == 'I'): ?> 
                                                                                  <!-- <h5 style="font-weight: bold; color: #4169E1; text-align: right;"><span class="badge">(<?php echo $no + 1; ?>) INFANT PASSENGER</span></h5> -->
                                                                                  <table class="table">
                                                                                    <tbody>
                                                                                      <tr>
                                                                                        <td class="text-primary" style="font-weight: bold; font-size:11px;vertical-align: middle;"> <!-- <span class="badge"> <?php echo $no + 1; ?> </span> --> INFANT PASSENGER</td>
                                                                                        <td class="text-center">
                                                                                          <select class="form-control" name="<?php echo 'i_title'.$no ?>" id="title" style="max-width: 90px;margin:auto;" required>
                                                                                              <option value="">Select</option>
                                                                                              <!-- <option value="1">Mr</option>
                                                                                              <option value="2">Mrs</option> -->
                                                                                              <option value="3">Miss</option>
                                                                                              <option value="4">Mstr</option>
                                                                                          </select>   
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                          <input type="text" class="form-control Intlinput" name="<?php echo 'i_fname'.$no ?>" pattern="[a-zA-Z\s]+" placeholder="First Name" required>
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                          <input type="text" class="form-control Intlinput" name="<?php echo 'i_lname'.$no ?>" pattern="[a-zA-Z\s]+" placeholder="Last Name" required>
                                                                                        </td>
                                                                                        <td class="text-center" style="vertical-align: middle"><div style="font-size:10px;"><span class="badge badge-warning <?php echo 'getInfantAge'.$no ?>"></span> MONTH(S)</div></td>
                                                                                        <td class="text-center">
                                                                                          <input type="text" class="form-control <?php echo 'datepickerInfant'.$no ?>" name="<?php echo 'i_bdate'.$no ?>" id="birthdate" placeholder="mm/dd/yyyy" style="max-width: 110px;margin:auto;" required>
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                          
                                                                                        </td>
                                                                                        <?php if ($returnbaggages): ?>
                                                                                          <td class="text-center">
                                                                                            
                                                                                          </td>
                                                                                        <?php endif ?>
                                                                                        
                                                                                        <?php if($provider == 'scoot'): ?>
                                                                                          <td colspan="" class="text-left">
                                                                                            <select style="" class="form-control" name="<?php echo 'i_gender'.$no ?>" id="igender" required>
                                                                                              <option value="" selected>Select Gender</option>  
                                                                                              <option value="Male">Male</option> 
                                                                                              <option value="Female">Female</option>  
                                                                                             </select> 
                                                                                          </td>
                                                                                        <?php endif ?>

                                                                                      </tr>
                                                                                    </tbody>
                                                                                  </table>

                                                                                  <?php if($provider == 'byaheko'): ?>
                                                                                    <table class="table">
                                                                                      <tbody>
                                                                                        <tr>
                                                                                          <td colspan="2" class="text-left">  
                                                                                            <small><b>Infant Documents</b></small>
                                                                                          </td>
                                                                                          <td class="text-left">
                                                                                            <small>Passport Number:</small>
                                                                                            <input type="text" class="form-control" name="<?php echo 'i_passportno'.$no ?>" placeholder="Passport Number" required>
                                                                                          </td>
                                                                                          <td class="text-left">
                                                                                            <small>Passport Expiry Date:</small>
                                                                                            <input type="text" class="form-control datepickerExpiry" name="<?php echo 'i_passportexpiry'.$no ?>" id="passportexpiry" placeholder="mm/dd/yyyy" required>
                                                                                          </td>
                                                                                          <td colspan="2" class="text-left">
                                                                                            <small>Passport Issuing Country:</small>
                                                                                            <!-- <input type="text" class="form-control" name="<?php echo 'i_ppissuingcountry'.$no ?>" placeholder="Passport Issuing Country" required> -->
                                                                                            <select class="form-control" name="<?php echo 'i_ppissuingcountry'.$no ?>" id="" required >
                                                                                              <option value="" disabled selected>---Select Passport Issuing Country---</option>
                                                                                              <?php foreach ($airports as $row): ?>
                                                                                                <option value="<?php echo $row ?>"><?php echo $row ?></option>
                                                                                              <?php endforeach ?>
                                                                                            </select>
                                                                                          </td>
                                                                                          <td colspan="2" class="text-left">
                                                                                            <small>Nationality:</small>
                                                                                            <input type="text" class="form-control" name="<?php echo 'i_nationality '.$no ?>" placeholder="Nationality" required>
                                                                                          </td>
                                                                                        </tr>
                                                                                      </tbody>
                                                                                    </table>
                                                                                  <?php endif ?>

                                                                                  <?php if($provider == 'amadeus' || $provider == 'abacus'): ?>
                                                                                    <table class="table">
                                                                                      <tbody>  
                                                                                        <tr>
                                                                                          <td colspan="2" class="text-left">  
                                                                                            <span><b>Infant Passport</b></span>
                                                                                          </td>
                                                                                          <td class="text-left">
                                                                                            <span>Passport Number:</span>
                                                                                            <input type="text" class="form-control" name="<?php echo 'i_passportno'.$no ?>" placeholder="Passport Number" required>
                                                                                          </td>
                                                                                          <td class="text-left">
                                                                                            <span>Passport Expiry Date:</span>
                                                                                            <input type="text" class="form-control datepickerExpiry" name="<?php echo 'i_passportexpiry'.$no ?>" id="passportexpiry" placeholder="mm/dd/yyyy" required>
                                                                                          </td>
                                                                                          <td colspan="" class="text-left">
                                                                                            <span>Passport Issuing Country:</span>
                                                                                            <select style="" class="form-control" name="<?php echo 'i_ppissuingcountry'.$no ?>" id="i_ppissuingcountry" required>
                                                                                              <option value="" selected>Select Passport Issuing Country</option>  
                                                                                                <?php $i = 0 ;foreach ($country as $val): ?>
                                                                                                     
                                                                                                        <option value="<?php echo $val['code']; ?>"><?php echo $val['country']; ?></option>  
                                                                                                    
                                                                                                    <?php $i++; ?>
                                                                                                <?php endforeach ?>
                                                                                             </select> 
                                                                                          </td>
                                                                                          <!-- <td colspan="" class="text-left">
                                                                                            <span>Passport Picture:</span>
                                                                                            <input type="file" class="form-control required btnUploadPassport" data-mynumber="<?php echo $no; ?>" id="<?php echo 'filepassport'.$no ?>" name="<?php echo 'filepassport'.$no ?>" title="No File Found" onchange="ValidateUploadFile(this);"  required='required' >
                                                                                            <input type="hidden" name="<?php echo 'passportImg'.$no ?>" id="<?php echo 'passportImg'.$no ?>" value='' readonly >
                                                                                            <div class="" style="display:none;margin-bottom: 0;padding: 5;" id='<?php echo 'uploadmessage'.$no ?>'></div>
                                                                                          </td>  -->
                                                                                        </tr>

                                                                                      <?php if($visaStatus == 0): ?>
                                                                                        <tr>
                                                                                          <td colspan="2" class="text-left">  
                                                                                            <span><b>Infant Visa</b></span>
                                                                                          </td>
                                                                                          <td class="text-left">
                                                                                            <span>Visa Number:</span>
                                                                                            <input type="text" class="form-control" name="<?php echo 'i_visano'.$no ?>" placeholder="Visa Number" required>
                                                                                          </td>
                                                                                          <td class="text-left">
                                                                                            <span>Visa Expiry Date:</span>
                                                                                            <input type="text" class="form-control datepickerExpiry" name="<?php echo 'i_visaexpiry'.$no ?>" id="visaexpiry" placeholder="mm/dd/yyyy" required>
                                                                                          </td>
                                                                                          <td colspan="" class="text-left">
                                                                                            <span>Visa Issuing Country:</span>
                                                                                            <select style="" class="form-control" name="<?php echo 'i_visaissuingcountry'.$no ?>" id="i_visaissuingcountry" required>
                                                                                              <option value="" selected>Select Visa Issuing Country</option>  
                                                                                                <?php $i = 0 ;foreach ($country as $val): ?>
                                                                                                     
                                                                                                        <option value="<?php echo $val['code']; ?>"><?php echo $val['country']; ?></option>  
                                                                                                    
                                                                                                    <?php $i++; ?>
                                                                                                <?php endforeach ?>
                                                                                             </select> 
                                                                                          </td>
                                                                                          <td colspan="" class="text-left">
                                                                                            <span>Visa Picture:</span>
                                                                                            <input type="file" class="form-control required btnUploadVisa" data-mynumbervisa="<?php echo $no; ?>" id="<?php echo 'filevisa'.$no ?>" name="<?php echo 'filevisa'.$no ?>" title="No File Found" onchange="ValidateUploadFile(this);" required='required' >
                                                                                            <input type="hidden" name="<?php echo 'visaImg'.$no ?>" id="<?php echo 'visaImg'.$no ?>" value='' readonly >
                                                                                            <div class="" style="display:none;margin-bottom: 0;padding: 5;" id='<?php echo 'uploadmessagevisa'.$no ?>'></div>
                                                                                          </td> 

                                                                                        </tr>
                                                                                      <?php endif;?>
                                                                                      </tbody>
                                                                                    </table>
                                                                                  <?php endif;?>

                                                                                  <?php if($provider == 'scoot'): ?>
                                                                                    <table class="table">
                                                                                      <tbody>  
                                                                                        <tr>
                                                                                          <td colspan="" class="text-left">  
                                                                                            <span><b>Infant Passport</b></span>
                                                                                          </td>
                                                                                          <td class="text-left">
                                                                                            <span>Passport Number:</span>
                                                                                            <input type="text" class="form-control" name="<?php echo 'i_passportno'.$no ?>" placeholder="Passport Number" required>
                                                                                          </td>
                                                                                          <td class="text-left">
                                                                                            <span>Passport Expiry Date:</span>
                                                                                            <input type="text" class="form-control datepickerExpiry" name="<?php echo 'i_passportexpiry'.$no ?>" id="passportexpiry" placeholder="mm/dd/yyyy" required>
                                                                                          </td>
                                                                                          <td colspan="" class="text-left">
                                                                                            <span>Passport Issuing Country:</span>
                                                                                            <select style="" class="form-control" name="<?php echo 'i_ppissuingcountry'.$no ?>" id="i_ppissuingcountry" required>
                                                                                              <option value="" selected>Select Passport Issuing Country</option>  
                                                                                                <?php $i = 0 ;foreach ($country as $val): ?>
                                                                                                     
                                                                                                        <option value="<?php echo $val['code']; ?>"><?php echo $val['country']; ?></option>  
                                                                                                    
                                                                                                    <?php $i++; ?>
                                                                                                <?php endforeach ?>
                                                                                             </select> 
                                                                                          </td>
                                                                                          <td colspan="" class="text-left">
                                                                                            <small>Resident Country:</small>
                                                                                            <select style="" class="form-control" name="<?php echo 'i_residentcountry'.$no ?>" id="iResidentCountry" required>
                                                                                              <option value="" selected>Select Resident Country</option>  
                                                                                                <?php $i = 0 ;foreach ($country as $val): ?>
                                                                                                     
                                                                                                        <option value="<?php echo $val['code']; ?>"><?php echo $val['country']; ?></option>  
                                                                                                    
                                                                                                    <?php $i++; ?>
                                                                                                <?php endforeach ?>
                                                                                             </select> 
                                                                                          </td>
                                                                                          <!-- <td colspan="" class="text-left">
                                                                                            <span>Passport Picture:</span>
                                                                                            <input type="file" class="form-control required btnUploadPassport" data-mynumber="<?php echo $no; ?>" id="<?php echo 'filepassport'.$no ?>" name="<?php echo 'filepassport'.$no ?>" title="No File Found" onchange="ValidateUploadFile(this);"  required='required' >
                                                                                            <input type="hidden" name="<?php echo 'passportImg'.$no ?>" id="<?php echo 'passportImg'.$no ?>" value='' readonly >
                                                                                            <div class="" style="display:none;margin-bottom: 0;padding: 5;" id='<?php echo 'uploadmessage'.$no ?>'></div>
                                                                                          </td>  -->
                                                                                        </tr>

                                                                                      <?php if($visaStatus == 0): ?>
                                                                                        <tr>
                                                                                          <td colspan="2" class="text-left">  
                                                                                            <span><b>Infant Visa</b></span>
                                                                                          </td>
                                                                                          <td class="text-left">
                                                                                            <span>Visa Number:</span>
                                                                                            <input type="text" class="form-control" name="<?php echo 'i_visano'.$no ?>" placeholder="Visa Number" required>
                                                                                          </td>
                                                                                          <td class="text-left">
                                                                                            <span>Visa Expiry Date:</span>
                                                                                            <input type="text" class="form-control datepickerExpiry" name="<?php echo 'i_visaexpiry'.$no ?>" id="visaexpiry" placeholder="mm/dd/yyyy" required>
                                                                                          </td>
                                                                                          <td colspan="" class="text-left">
                                                                                            <span>Visa Issuing Country:</span>
                                                                                            <select style="" class="form-control" name="<?php echo 'i_visaissuingcountry'.$no ?>" id="i_visaissuingcountry" required>
                                                                                              <option value="" selected>Select Visa Issuing Country</option>  
                                                                                                <?php $i = 0 ;foreach ($country as $val): ?>
                                                                                                     
                                                                                                        <option value="<?php echo $val['code']; ?>"><?php echo $val['country']; ?></option>  
                                                                                                    
                                                                                                    <?php $i++; ?>
                                                                                                <?php endforeach ?>
                                                                                             </select> 
                                                                                          </td>
                                                                                          <td colspan="" class="text-left">
                                                                                            <span>Visa Picture:</span>
                                                                                            <input type="file" class="form-control required btnUploadVisa" data-mynumbervisa="<?php echo $no; ?>" id="<?php echo 'filevisa'.$no ?>" name="<?php echo 'filevisa'.$no ?>" title="No File Found" onchange="ValidateUploadFile(this);" required='required' >
                                                                                            <input type="hidden" name="<?php echo 'visaImg'.$no ?>" id="<?php echo 'visaImg'.$no ?>" value='' readonly >
                                                                                            <div class="" style="display:none;margin-bottom: 0;padding: 5;" id='<?php echo 'uploadmessagevisa'.$no ?>'></div>
                                                                                          </td> 

                                                                                        </tr>
                                                                                      <?php endif;?>
                                                                                      </tbody>
                                                                                    </table>
                                                                                  <?php endif;?>
                                                                                <!-- INFANT -->

                                                                                <?php endif ?>
                                                                                
                                                                              <?php $no++; ?>
                                                                            <?php endforeach ?>
                                                                            <input type="hidden" name="uploadcount" id="uploadcount" value='<?php echo $no ?>' readonly >
                                                                          <!-- </tbody>
                                                                        </table> -->

                                                                      <hr style="margin-top: 0px;">

                                                                      <?php if($provider == 'abacusxxx'): ?>
                                                                        <table class="table">
                                                                          <tbody>
                                                                            <tr>
                                                                                <th colspan="10">Additional Services <small>( Pre-Included baggage )</small></th>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="5">
                                                                                    <label><span class="text-danger">*</span>Pre-Included Onward Baggage : </label>
                                                                                    <span class="text-danger">
                                                                                        <?php 
                                                                                          // var_dump($flight_onward['ResBookDesigCode']);
                                                                                        ?>

                                                                                            <?php $bk =  $flight_onward['ResBookDesigCode'];
                                                                                                if($bk=='V' || $bk=='B' || $bk=='X' || $bk=='K' || $bk=='E' || $bk=='T' || $bk=='U' || $bk=='O'){
                                                                                                    // echo 'Budget Economy';
                                                                                                    echo 'Pre-Included baggage allowance 10KG and 7kg hand carry';
                                                                                                }else if($bk=='Y' || $bk=='S' || $bk=='L' || $bk=='M' || $bk=='H' || $bk=='Q'){
                                                                                                    // echo 'Regular Economy';
                                                                                                    echo 'Pre-Included baggage allowance 20KG and 7kg hand carry';
                                                                                                }else if($bk=='W' || $bk=='N'){
                                                                                                    // echo 'Premium Economy';
                                                                                                    echo 'Pre-Included baggage allowance 25KG and 7kg hand carry';
                                                                                                }else {
                                                                                                    echo 'No Pre-Included baggage available. Please Add baggage';
                                                                                                }
                                                                                            ?>
                                                                                        <?php //endforeach; ?>
                                                                                    </span>
                                                                                </td>
                                                                                 <?php if($flight_return): ?>
                                                                                    <td colspan="5" style="border-top: none;">
                                                                                        <label><span class="text-danger">*</span>Pre-Included Return Baggage : </label>
                                                                                        <span class="text-danger">
                                                                                            <?php 
                                                                                              // var_dump($flight_return['ResBookDesigCode']);
                                                                                             ?>
                                                                                                <?php $bk =  $flight_return['ResBookDesigCode'];
                                                                                                    if($bk=='V' || $bk=='B' || $bk=='X' || $bk=='K' || $bk=='E' || $bk=='T' || $bk=='U' || $bk=='O'){
                                                                                                        // echo 'Budget Economy';
                                                                                                        echo 'Pre-Included baggage allowance 10KG and 7kg hand carry';
                                                                                                    }else if($bk=='Y' || $bk=='S' || $bk=='L' || $bk=='M' || $bk=='H' || $bk=='Q'){
                                                                                                        // echo 'Regular Economy';
                                                                                                        echo 'Pre-Included baggage allowance 20KG and 7kg hand carry';
                                                                                                    }else if($bk=='W' || $bk=='N'){
                                                                                                        // echo 'Premium Economy';
                                                                                                        echo 'Pre-Included baggage allowance 25KG and 7kg hand carry';
                                                                                                    }else {
                                                                                                        echo 'No Pre-Included baggage available. Please Add baggage';
                                                                                                    }
                                                                                                ?>
                                                                                            <?php //endforeach; ?>
                                                                                        </span>
                                                                                    </td>
                                                                                <?php endif; ?>
                                                                            </tr>
                                                                          </tbody>
                                                                        </table>
                                                                      <?php endif;?>

                                                                      <hr style="margin-top: 0px;">

                                                                        <table class="table">
                                                                          <tbody>
                                                                            <tr>
                                                                                <th colspan="4" style="border-top: ; color: #4169E1;">Contact & Delivery Details <small class="text-danger">(FOR SCHEDULE CHANGE ADVISORY)</small></th>
                                                                            </tr>
                                                                            <tr class="pad10">
                                                                                <td colspan="1">
                                                                                  <input type="text" class="form-control required" name="contactno" placeholder="Contact No."  required>
                                                                                </td>
                                                                                <td>
                                                                                  <input type="email" class="form-control required" name="email" placeholder="Email Address" required>
                                                                                </td>
                                                                                <td>
                                                                                  <input type="text" class="form-control required" name="street" placeholder="Street" required>
                                                                                </td>
                                                                                <td>
                                                                                  <input type="text" class="form-control required" name="city" placeholder="City" required>
                                                                                </td>
                                                                                <td>
                                                                                  <input type="text" class="form-control required" name="zipcode" placeholder="Zipcode" required>
                                                                                </td>
                                                                            </tr>
                                                                            <!-- <tr>
                                                                                <th colspan="3" style="border-top: ; color: #4169E1;">Delivery Details</th>
                                                                            </tr>
                                                                            <tr class="pad10">
                                                                                <td>
                                                                                  <input type="text" class="form-control required" name="street" placeholder="Street" required>
                                                                                </td>
                                                                                <td>
                                                                                  <input type="text" class="form-control required" name="city" placeholder="City" required>
                                                                                </td>
                                                                                <td>
                                                                                  <input type="text" class="form-control required" name="zipcode" placeholder="Zipcode" required>
                                                                                </td>
                                                                            </tr> -->
                                                                            <tr>
                                                                              <td colspan="8" style="">
                                                                                  <textarea name="collection" hidden><?php echo json_encode($collection2,true); ?></textarea>
                                                                                  <textarea name="onwardbaggages" hidden><?php echo json_encode($onwardbaggages,true); ?></textarea>
                                                                                  <textarea name="returnbaggages" hidden><?php echo json_encode($returnbaggages,true); ?></textarea>
                                                                                  <textarea name="choose_flights" hidden><?php echo json_encode($choose_flights,true); ?></textarea>
                                                                                  <textarea name="passengers" hidden><?php echo json_encode($passengers,true); ?></textarea>
                                                                                  <textarea name="totalfee" hidden><?php echo $totalfee; ?></textarea>
                                                                                  <textarea name="provider" hidden><?php echo $provider; ?></textarea>
                                                                                  <textarea name="process" hidden><?php echo $process; ?></textarea>
                                                                                  <textarea name="flight_details" hidden><?php echo $flight_details; ?></textarea>
                                                                                  <textarea name="visaStatus" readonly hidden><?php echo $visaStatus ?></textarea>
                                                                                  <textarea name="cookie" readonly hidden><?php echo $cookie ?></textarea>
                                                                                  <textarea name="PHtravelTax" readonly hidden><?php echo $PHtravelTax ?></textarea>
                                                                                  <textarea name="commission" readonly hidden><?php echo $commission ?></textarea>
                                                                                  
                                                                                  <?php // if($provider == 'abacus'): ?>
                                                                                    </br>
                                                                                    <!-- <span style="color: red;" class=""><i>* please input required fields and upload verification pictures to proceed</i></span> -->
                                                                                    <span style="color: red;" class=""><i>* please input required fields to proceed</i></span>
                                                                                  <?php // endif; ?>


                                                                                  <div class="form-group">
                                                                                    <div class="checkbox">
                                                                                      <label>
                                                                                        <input class="" type="checkbox" value="" required>
                                                                                        <span>
                                                                                          <!-- Passenger is responsible for obtaining all required travel documents, visas and permits, and for complying with the laws, regulations, orders, demands and travel requirements of countries of origin, destination or transit. <?php echo $user['CG']=="UPS" ? "UPS":"GPRS" ?> is not liable for any issues the passenger might encounter for non-compliance on the required travel documentations. -->

                                                                                          <!-- Please make sure you provided the <b>CORRECT Passenger Details</b>. Failure to do so may result to applicable fees and some airlines DO NOT allow name correction and some tickets are NON-REFUNDABLE. -->

                                                                                          Please make sure that the <b>Passenger details you provided are ACCURATE</b>. Airlines may NOT ALLOW name correction or may CHARGE applicable fees for the correction. Note that some tickets are NON–REFUNDABLE.
                                                                                        </span>
                                                                                      </label>
                                                                                    </div>
                                                                                  </div>


                                                                                  <button type="submit" name="btnBookFlights" id="btnBookFlights" class="btn btn-primary pull-right" disabled="">Next&nbsp;<span class="glyphicon glyphicon-arrow-right"></span></button>
                                                                              </td>
                                                                            </tr>
                                                                          </tbody>
                                                                        </table>

                                                                      </div>
                                                                    </div>

                                                                </form>
                                                            <?php endif ?>

                                                    </div> <!-- row -->
                                             </div>
                                         </div>      
                                    </div><!-- activity-list -->

                                </div><!-- tab-pane -->

                            </div>
                        </div><!-- col-md-8 -->
                    </div><!-- row -->

                    <?php if ($process ===3 ): ?>
                      <div class="row">
                        <div class="col-sm-12 col-md-12">
                          <?php if ($output['S'] === 0): ?>
                            <div class="alert alert-danger">
                              <?php echo $output['M']; ?>
                            </div>
                          <?php endif ?>

                        <form method="post" action="#" class="myform">
                          <button type="submit" name="btnSelectFlight" class="btn btn-default-alt" style="background-color: transparent;"><span aria-hidden="true">&larr;</span> Back</button>
                          <textarea name="collection" hidden><?php echo json_encode($collection, true); ?></textarea>
                          <input type="hidden" class="form-control" name="back" value="2">
                          <input type="hidden" class="form-control" name="process" value="2">
                          <input type="hidden" class="form-control" name="provider" value="<?php echo $provider; ?>">
                          <!-- <textarea name="onwardbaggages" hidden><?php echo json_encode($onwardbaggages,true); ?></textarea>
                          <textarea name="returnbaggages" hidden><?php echo json_encode($returnbaggages,true); ?></textarea> -->
                          <textarea name="choose_flights" hidden><?php echo json_encode($choose_flights,true); ?></textarea>
                          <!-- <textarea name="passengers" hidden><?php echo json_encode($passengers,true); ?></textarea> -->
                          <textarea name="totalfee" hidden><?php echo $totalfee; ?></textarea>
                          <textarea name="flight_details" hidden><?php echo $flight_details; ?></textarea>
                          <textarea name="visaStatus" readonly hidden><?php echo $visaStatus ?></textarea>
                          <textarea name="cookie" readonly hidden><?php echo $cookie ?></textarea>
                        </form>

                        <div class="alert alert-info" role="alert">Please confirm the following details before you proceed.</div>

                        <div class="list-group">
                          <div class="list-group-item">
                              
                              <h4 style="font-weight: bold; color: #4169E1;">Flight Details</h4>
                                
                              <?php //var_dump($flight_onward['Carrier']);?>
                              <?php //var_dump($flight_onward->Carrier); ?>
                              <table class="table" style="margin-top:10px;margin-bottom: 0px;">
                                  <thead>
                                  <th><small>Journey</small></th>
                                  <th><small>Carrier</th>
                                  <th><small>Flight No</th>
                                  <th class="text-center"><small>Source</small></th>
                                  <th class="text-center"><small>Destination</small></th>
                                  <th class="text-center"><small>Departure</small></th>
                                  <th class="text-center"><small>Arrival</small></th>
                                  <th class="text-center"><small>Booking Class</small></th>
                                  <?php if($provider == 'amadeus'): ?>
                                      <th class="text-center"><small>Pre-Included Baggage</small></th>
                                  <?php else: ?>
                                     <th class="text-center"><small>Ticket Type</small></th>
                                  <?php endif; ?>
                                  </thead>
                                  <tbody>
                                      <tr>
                                          <td>
                                            Onward
                                          </td>
                                          <td><?php echo $flight_onward['Carrier']; ?></td>
                                          <td><?php echo $flight_onward['CarrierID'].'-'.$flight_onward['FlightNumber']; ?></td>
                                          <td class="text-center"><?php echo $flight_onward['Source']; ?></td>
                                          <td class="text-center"><?php echo $flight_onward['Destination']; ?></td>
                                          <td class="text-center"><?php echo date('d M y - h:i A', strtotime($flight_onward['DepartureTimeStamp'])); ?></td>
                                          <td class="text-center"><?php echo date("d M y - h:i A", strtotime($flight_onward['ArrivalTimeStamp'])); ?></td>
                                          <td class="text-center">
                                              <?php if($provider == 'abacus'): ?>
                                                <?php $bk =  $flight_onward['ResBookDesigCode'];
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
                                              <?php else: ?>
                                                <?php echo $flight_onward['Class']; ?>
                                              <?php endif; ?>
                                          </td>
                                          <!-- <td class="text-center"><?php // echo ($flight_onward['TicketType']=='true'||$flight_onward['TicketType']=='E')? 'E-Ticket':$flight_onward['TicketType']; ?></td> -->
                                          <?php if($provider == 'amadeus'): ?>
                                              <td class="text-center"><?php echo $flight_onward['FreeBaggage']; ?></td>
                                          <?php else: ?>
                                              <td class="text-center"><?php echo ($flight_onward['TicketType']=='true'||$flight_onward['TicketType']=='E')? 'E-Ticket':$flight_onward['TicketType']; ?></td>
                                          <?php endif; ?>
                                      </tr>
                                    <?php if($flight_onwardCon): ?>
                                      <tr>
                                          <td>
                                            Onward Connecting (1)
                                          </td>
                                          <td><?php echo $flight_onwardCon['Carrier']; ?></td>
                                          <td><?php echo $flight_onwardCon['CarrierID'].'-'.$flight_onwardCon['FlightNumber']; ?></td>
                                          <td class="text-center"><?php echo $flight_onwardCon['Source']; ?></td>
                                          <td class="text-center"><?php echo $flight_onwardCon['Destination']; ?></td>
                                          <td class="text-center"><?php echo date('d M y - h:i A', strtotime($flight_onwardCon['DepartureTimeStamp'])); ?></td>
                                          <td class="text-center"><?php echo date("d M y - h:i A", strtotime($flight_onwardCon['ArrivalTimeStamp'])); ?></td>
                                          <td class="text-center">
                                              <?php if($provider == 'abacus'): ?>
                                                <?php $bk =  $flight_onwardCon['ResBookDesigCode'];
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
                                              <?php else: ?>
                                                <?php echo $flight_onwardCon['Class']; ?>
                                              <?php endif; ?>
                                          </td>
                                          <!-- <td class="text-center"><?php // echo ($flight_onwardCon['TicketType']=='true'||$flight_onwardCon['TicketType']=='E')? 'E-Ticket':$flight_onwardCon['TicketType']; ?></td> -->
                                          <?php if($provider == 'amadeus'): ?>
                                              <td class="text-center"><?php echo $flight_onwardCon['FreeBaggage']; ?></td>
                                          <?php else: ?>
                                              <td class="text-center"><?php echo ($flight_onwardCon['TicketType']=='true'||$flight_onwardCon['TicketType']=='E')? 'E-Ticket':$flight_onwardCon['TicketType']; ?></td>
                                          <?php endif; ?>
                                      </tr>
                                   <?php endif; ?> 
                                   <?php if($flight_onwardCon2): ?>
                                      <tr>
                                          <td>
                                            Onward Connecting (2)
                                          </td>
                                          <td><?php echo $flight_onwardCon2['Carrier']; ?></td>
                                          <td><?php echo $flight_onwardCon2['CarrierID'].'-'.$flight_onwardCon2['FlightNumber']; ?></td>
                                          <td class="text-center"><?php echo $flight_onwardCon2['Source']; ?></td>
                                          <td class="text-center"><?php echo $flight_onwardCon2['Destination']; ?></td>
                                          <td class="text-center"><?php echo date('d M y - h:i A', strtotime($flight_onwardCon2['DepartureTimeStamp'])); ?></td>
                                          <td class="text-center"><?php echo date("d M y - h:i A", strtotime($flight_onwardCon2['ArrivalTimeStamp'])); ?></td>
                                          <td class="text-center">
                                              <?php if($provider == 'abacus'): ?>
                                                <?php $bk =  $flight_onwardCon2['ResBookDesigCode'];
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
                                              <?php else: ?>
                                                <?php echo $flight_onwardCon2['Class']; ?>
                                              <?php endif; ?>
                                          </td>
                                          <!-- <td class="text-center"><?php // echo ($flight_onwardCon2['TicketType']=='true'||$flight_onwardCon2['TicketType']=='E')? 'E-Ticket':$flight_onwardCon2['TicketType']; ?></td> -->
                                          <?php if($provider == 'amadeus'): ?>
                                              <td class="text-center"><?php echo $flight_onwardCon2['FreeBaggage']; ?></td>
                                          <?php else: ?>
                                              <td class="text-center"><?php echo ($flight_onwardCon2['TicketType']=='true'||$flight_onwardCon2['TicketType']=='E')? 'E-Ticket':$flight_onwardCon2['TicketType']; ?></td>
                                          <?php endif; ?>
                                      </tr>
                                   <?php endif; ?>  

                                    <?php if($flight_return): ?>
                                      <tr>
                                          <td>
                                            Return
                                          </td>
                                          <td><?php echo $flight_return['Carrier']; ?></td>
                                          <td><?php echo $flight_return['CarrierID'].'-'.$flight_return['FlightNumber']; ?></td>
                                          <td class="text-center"><?php echo $flight_return['Source']; ?></td>
                                          <td class="text-center"><?php echo $flight_return['Destination']; ?></td>
                                          <td class="text-center"><?php echo date('d M y - h:i A', strtotime($flight_return['DepartureTimeStamp'])); ?></td>
                                          <td class="text-center"><?php echo date("d M y - h:i A", strtotime($flight_return['ArrivalTimeStamp'])); ?></td>
                                          <td class="text-center">
                                              <?php if($provider == 'abacus'): ?>
                                                <?php $bk =  $flight_return['ResBookDesigCode'];
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
                                              <?php else: ?>
                                                <?php echo $flight_return['Class']; ?>
                                              <?php endif; ?>
                                          </td>
                                          <!-- <td class="text-center"><?php // echo ($flight_return['TicketType']=='true'||$flight_return['TicketType']=='E')? 'E-Ticket':$flight_return['TicketType']; ?></td> -->
                                          <?php if($provider == 'amadeus'): ?>
                                              <td class="text-center"><?php echo $flight_return['FreeBaggage']; ?></td>
                                          <?php else: ?>
                                              <td class="text-center"><?php echo ($flight_return['TicketType']=='true'||$flight_return['TicketType']=='E')? 'E-Ticket':$flight_return['TicketType']; ?></td>
                                          <?php endif; ?>
                                      </tr>
                                  <?php endif; ?>

                                  <?php if($flight_returnCon): ?>
                                      <tr>
                                          <td>
                                            Return Connecting (1)
                                          </td>
                                          <td><?php echo $flight_returnCon['Carrier']; ?></td>
                                          <td><?php echo $flight_returnCon['CarrierID'].'-'.$flight_returnCon['FlightNumber']; ?></td>
                                          <td class="text-center"><?php echo $flight_returnCon['Source']; ?></td>
                                          <td class="text-center"><?php echo $flight_returnCon['Destination']; ?></td>
                                          <td class="text-center"><?php echo date('d M y - h:i A', strtotime($flight_returnCon['DepartureTimeStamp'])); ?></td>
                                          <td class="text-center"><?php echo date("d M y - h:i A", strtotime($flight_returnCon['ArrivalTimeStamp'])); ?></td>
                                          <td class="text-center">
                                              <?php if($provider == 'abacus'): ?>
                                                <?php $bk =  $flight_returnCon['ResBookDesigCode'];
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
                                              <?php else: ?>
                                                <?php echo $flight_returnCon['Class']; ?>
                                              <?php endif; ?>
                                          </td>
                                          <!-- <td class="text-center"><?php // echo ($flight_returnCon['TicketType']=='true'||$flight_returnCon['TicketType']=='E')? 'E-Ticket':$flight_returnCon['TicketType']; ?></td> -->
                                          <?php if($provider == 'amadeus'): ?>
                                              <td class="text-center"><?php echo $flight_returnCon['FreeBaggage']; ?></td>
                                          <?php else: ?>
                                              <td class="text-center"><?php echo ($flight_returnCon['TicketType']=='true'||$flight_returnCon['TicketType']=='E')? 'E-Ticket':$flight_returnCon['TicketType']; ?></td>
                                          <?php endif; ?>
                                      </tr>
                                   <?php endif; ?>
                                   <?php if($flight_returnCon2): ?>
                                      <tr>
                                          <td>
                                            Return Connecting (2)
                                          </td>
                                          <td><?php echo $flight_returnCon2['Carrier']; ?></td>
                                          <td><?php echo $flight_returnCon2['CarrierID'].'-'.$flight_returnCon2['FlightNumber']; ?></td>
                                          <td class="text-center"><?php echo $flight_returnCon2['Source']; ?></td>
                                          <td class="text-center"><?php echo $flight_returnCon2['Destination']; ?></td>
                                          <td class="text-center"><?php echo date('d M y - h:i A', strtotime($flight_returnCon2['DepartureTimeStamp'])); ?></td>
                                          <td class="text-center"><?php echo date("d M y - h:i A", strtotime($flight_returnCon2['ArrivalTimeStamp'])); ?></td>
                                          <td class="text-center">
                                              <?php if($provider == 'abacus'): ?>
                                                <?php $bk =  $flight_returnCon2['ResBookDesigCode'];
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
                                              <?php else: ?>
                                                <?php echo $flight_returnCon2['Class']; ?>
                                              <?php endif; ?>
                                          </td>
                                          <!-- <td class="text-center"><?php // echo ($flight_returnCon2['TicketType']=='true'||$flight_returnCon2['TicketType']=='E')? 'E-Ticket':$flight_returnCon2['TicketType']; ?></td> -->
                                          <?php if($provider == 'amadeus'): ?>
                                              <td class="text-center"><?php echo $flight_returnCon2['FreeBaggage']; ?></td>
                                          <?php else: ?>
                                              <td class="text-center"><?php echo ($flight_returnCon2['TicketType']=='true'||$flight_returnCon2['TicketType']=='E')? 'E-Ticket':$flight_returnCon2['TicketType']; ?></td>
                                          <?php endif; ?>
                                      </tr>
                                   <?php endif; ?>

                                  </tbody>
                              </table>
                          </div>
                      </div>

                         <div class="list-group">
                            <div class="list-group-item">
                              <h4 style="font-weight: bold; color: #4169E1;">Passenger Details</h4>
                              <?php foreach ($flight_onward as $fo ): ?>
                                   <?php //var_dump($fo->Ca); ?>
                              <?php endforeach; ?>
                              <?php
                                 $total = 0;
                                 $count = 0;
                               ?>
                                     
                                <table class="table">
                                  <thead>
                                      <th><small>Type</small></th>
                                      <!-- <th>Title</th> -->
                                      <th class="text-left"><small>Full Name</small></th>
                                      <th class="text-left"><small>Date of Birth</small></th>
                                      
                                      <th class="text-left"><small>Onward Baggage</small></th>
                                      
                                      <?php //print_r($choose_flights[0]['return']);?>
                                      <?php if($choose_flights[0]['return'] != ""): ?>
                                          <th class="text-left"><small>Return Baggage</small></th>
                                      <?php endif;?>

                                      <?php if($provider == 'byaheko'): ?>
                                        <th class="text-left"><small>Passport Number</small></th>
                                        <th class="text-left"><small>Passport Expiry Date</small></th>
                                        <th class="text-left"><small>Passport Issuing Country</small></th>
                                        <th class="text-left"><small>Nationality</small></th>
                                      <?php endif;?>

                                      <?php if($provider == 'amadeus' || $provider == 'abacus'): ?>
                                        <th class="text-left"><small>Passport Number</small></th>
                                        <th class="text-left"><small>Passport Expiry Date</small></th>
                                        <th class="text-left"><small>Passport Issuing Country</small></th>

                                        <?php if($visaStatus == 0): ?>
                                          <th class="text-left"><small>Visa Number</small></th>
                                          <th class="text-left"><small>Visa Expiry Date</small></th>
                                          <th class="text-left"><small>Visa Issuing Country</small></th>
                                        <?php endif;?>
                                      <?php endif;?>

                                      <?php if($provider == 'scoot'): ?>
                                        <th class="text-left"><small>Passport <br/>Number</small></th>
                                        <th class="text-left"><small>Passport <br/>Expiry Date</small></th>
                                        <th class="text-left"><small>Passport <br/>Issuing Country</small></th>
                                        <th class="text-left"><small>Resident <br/>Country</small></th>

                                        <?php if($visaStatus == 0): ?>
                                          <th class="text-left"><small>Visa <br/>Number</small></th>
                                          <th class="text-left"><small>Visa <br/>Expiry Date</small></th>
                                          <th class="text-left"><small>Visa <br/>Issuing Country</small></th>
                                        <?php endif;?>
                                      <?php endif;?>

                                  </thead>
                                  <tbody>

                                  <?php foreach ($ui_passengers_details as $u ): ?>
                                      <?php
                                        //var_dump($u);
                                        $OB = explode(";", $u['OB']);
                                        $RB = explode(";", $u['RB']);
                                      ?>
                                      <?php 
                                          if ($u['T'] == 'A') {
                                              $p="ADULT";
                                          }elseif ($u['T'] == 'C'){
                                              $p="CHILDREN";
                                          }elseif ($u['T'] == 'I'){
                                              $p="INFANT";
                                          }elseif ($u['T'] == 'S'){
                                              $p="SENIOR";
                                          }

                                      ?>

                                    <?php if ($u['T'] == 'S'): ?>
                                      <tr>
                                        <td style="font-size:11px;vertical-align: middle;"><?php echo $p; ?> PASSENGER</td>
                                        <td class="text-left">
                                          <?php echo $u['name']; ?>
                                          <input type="hidden" class="form-control" value="<?php echo $u['name']; ?>" readonly>
                                        </td>
                                        <td class="text-left">
                                          <?php echo $u['bdate']; ?>
                                          <input type="hidden" class="form-control" value="<?php echo $u['bdate']; ?>" readonly>
                                        </td>
                                        <td class="text-left">
                                          <?php echo isset($OB[1])? $OB[1]:'No Baggage'; ?>
                                          <input type="hidden" class="form-control" value="<?php echo isset($OB[1])? $OB[1]:'No Baggage'; ?>" readonly>
                                        </td>
                                        <?php if(!empty($u['RB'])): ?>
                                          <td class="text-left">
                                            <?php echo isset($RB[1])? $RB[1]:'No Baggage'; ?>
                                            <input type="hidden" class="form-control" value="<?php echo isset($RB[1])? $RB[1]:'No Baggage'; ?>" readonly>
                                          </td>
                                        <?php endif;?>

                                        <?php if($provider == 'byaheko'): ?>
                                          <td class="text-left">
                                            <?php echo $u['PN']; ?>
                                            <input type="hidden" class="form-control" value="<?php echo $u['PN']; ?>" readonly>
                                          </td>
                                          <td class="text-left">
                                            <?php echo $u['PED']; ?>
                                            <input type="hidden" class="form-control" value="<?php echo $u['PED']; ?>" readonly>
                                          </td>
                                          <td class="text-left">
                                            <?php echo $u['PIC']; ?>
                                            <input type="hidden" class="form-control" value="<?php echo $u['PIC']; ?>" readonly>
                                          </td>
                                          <td class="text-left">
                                            <?php echo $u['NAT']; ?>
                                            <input type="hidden" class="form-control" value="<?php echo $u['NAT']; ?>" readonly>
                                          </td>
                                        <?php endif;?>

                                        <?php if($provider == 'amadeus' || $provider == 'abacus'): ?>
                                          <td class="text-left">
                                            <?php echo $u['PN']; ?>
                                            <input type="hidden" class="form-control" value="<?php echo $u['PN']; ?>" readonly>
                                          </td>
                                          <td class="text-left">
                                            <?php echo $u['PED']; ?>
                                            <input type="hidden" class="form-control" value="<?php echo $u['PED']; ?>" readonly>
                                          </td>
                                          <td class="text-left">
                                            <?php echo $u['PIC']; ?>
                                            <input type="hidden" class="form-control" value="<?php echo $u['PIC']; ?>" readonly>
                                          </td>

                                          <?php if($visaStatus == 0): ?>
                                            <td class="text-left">
                                              <?php echo $u['VN']; ?>
                                              <input type="hidden" class="form-control" value="<?php echo $u['VN']; ?>" readonly>
                                            </td>
                                            <td class="text-left">
                                              <?php echo $u['VED']; ?>
                                              <input type="hidden" class="form-control" value="<?php echo $u['VED']; ?>" readonly>
                                            </td>
                                            <td class="text-left">
                                              <?php echo $u['VIC']; ?>
                                              <input type="hidden" class="form-control" value="<?php echo $u['VIC']; ?>" readonly>
                                            </td>
                                          <?php endif;?>
                                        <?php endif;?>

                                        <?php if($provider == 'scoot'): ?>
                                          <td class="text-left">
                                            <?php echo $u['PN']; ?>
                                            <input type="hidden" class="form-control" value="<?php echo $u['PN']; ?>" readonly>
                                          </td>
                                          <td class="text-left">
                                            <?php echo $u['PED']; ?>
                                            <input type="hidden" class="form-control" value="<?php echo $u['PED']; ?>" readonly>
                                          </td>
                                          <td class="text-left">
                                            <?php echo $u['PIC']; ?>
                                            <input type="hidden" class="form-control" value="<?php echo $u['PIC']; ?>" readonly>
                                          </td>
                                          <td class="text-left">
                                            <?php echo $u['RC']; ?>
                                            <input type="hidden" class="form-control" value="<?php echo $u['RC']; ?>" readonly>
                                          </td>

                                          <?php if($visaStatus == 0): ?>
                                            <td class="text-left">
                                              <?php echo $u['VN']; ?>
                                              <input type="hidden" class="form-control" value="<?php echo $u['VN']; ?>" readonly>
                                            </td>
                                            <td class="text-left">
                                              <?php echo $u['VED']; ?>
                                              <input type="hidden" class="form-control" value="<?php echo $u['VED']; ?>" readonly>
                                            </td>
                                            <td class="text-left">
                                              <?php echo $u['VIC']; ?>
                                              <input type="hidden" class="form-control" value="<?php echo $u['VIC']; ?>" readonly>
                                            </td>
                                          <?php endif;?>
                                        <?php endif;?>

                                      </tr>
                                        
                                    <?php else: ?>
                                      <tr>
                                        <td style="font-size:11px;vertical-align: middle;"><?php echo $p; ?> PASSENGER</td>
                                        <td class="text-left">
                                          <?php echo $u['name']; ?>
                                          <input type="hidden" class="form-control" value="<?php echo $u['name']; ?>" readonly>
                                        </td>
                                        <td class="text-left">
                                          <?php echo $u['bdate']; ?>
                                          <input type="hidden" class="form-control" value="<?php echo $u['bdate']; ?>" readonly>
                                        </td>
                                        <td class="text-left">
                                          <?php echo isset($OB[1])? $OB[1]:'No Baggage'; ?>
                                          <input type="hidden" class="form-control" value="<?php echo isset($OB[1])? $OB[1]:'No Baggage'; ?>" readonly>
                                        </td>
                                        <?php //if(!empty($u['RB'])): ?>
                                        <?php if($choose_flights[0]['return'] != ""): ?>
                                          <td class="text-left">
                                            <?php echo isset($RB[1])? $RB[1]:'No Baggage'; ?>
                                            <input type="hidden" class="form-control" value="<?php echo isset($RB[1])? $RB[1]:'No Baggage'; ?>" readonly>
                                          </td>
                                        <?php endif;?>

                                        <?php if($provider == 'byaheko'): ?>
                                          <td class="text-left">
                                            <?php echo $u['PN']; ?>
                                            <input type="hidden" class="form-control" value="<?php echo $u['PN']; ?>" readonly>
                                          </td>
                                          <td class="text-left">
                                            <?php echo $u['PED']; ?>
                                            <input type="hidden" class="form-control" value="<?php echo $u['PED']; ?>" readonly>
                                          </td>
                                          <td class="text-left">
                                            <?php echo $u['PIC']; ?>
                                            <input type="hidden" class="form-control" value="<?php echo $u['PIC']; ?>" readonly>
                                          </td>
                                          <td class="text-left">
                                            <?php echo $u['NAT']; ?>
                                            <input type="hidden" class="form-control" value="<?php echo $u['NAT']; ?>" readonly>
                                          </td>
                                        <?php endif;?>
                                      
                                        <?php if($provider == 'amadeus' || $provider == 'abacus'): ?>
                                          <td class="text-left">
                                            <?php echo $u['PN']; ?>
                                            <input type="hidden" class="form-control" value="<?php echo $u['PN']; ?>" readonly>
                                          </td>
                                          <td class="text-left">
                                            <?php echo $u['PED']; ?>
                                            <input type="hidden" class="form-control" value="<?php echo $u['PED']; ?>" readonly>
                                          </td>
                                          <td class="text-left">
                                            <?php echo $u['PIC']; ?>
                                            <input type="hidden" class="form-control" value="<?php echo $u['PIC']; ?>" readonly>
                                          </td>

                                          <?php if($visaStatus == 0): ?>
                                            <td class="text-left">
                                              <?php echo $u['VN']; ?>
                                              <input type="hidden" class="form-control" value="<?php echo $u['VN']; ?>" readonly>
                                            </td>
                                            <td class="text-left">
                                              <?php echo $u['VED']; ?>
                                              <input type="hidden" class="form-control" value="<?php echo $u['VED']; ?>" readonly>
                                            </td>
                                            <td class="text-left">
                                              <?php echo $u['VIC']; ?>
                                              <input type="hidden" class="form-control" value="<?php echo $u['VIC']; ?>" readonly>
                                            </td>
                                          <?php endif;?>
                                        <?php endif;?>

                                        <?php if($provider == 'scoot'): ?>
                                          <td class="text-left">
                                            <?php echo $u['PN']; ?>
                                            <input type="hidden" class="form-control" value="<?php echo $u['PN']; ?>" readonly>
                                          </td>
                                          <td class="text-left">
                                            <?php echo $u['PED']; ?>
                                            <input type="hidden" class="form-control" value="<?php echo $u['PED']; ?>" readonly>
                                          </td>
                                          <td class="text-left">
                                            <?php echo $u['PIC']; ?>
                                            <input type="hidden" class="form-control" value="<?php echo $u['PIC']; ?>" readonly>
                                          </td>
                                          <td class="text-left">
                                            <?php echo $u['RC']; ?>
                                            <input type="hidden" class="form-control" value="<?php echo $u['RC']; ?>" readonly>
                                          </td>

                                          <?php if($visaStatus == 0): ?>
                                            <td class="text-left">
                                              <?php echo $u['VN']; ?>
                                              <input type="hidden" class="form-control" value="<?php echo $u['VN']; ?>" readonly>
                                            </td>
                                            <td class="text-left">
                                              <?php echo $u['VED']; ?>
                                              <input type="hidden" class="form-control" value="<?php echo $u['VED']; ?>" readonly>
                                            </td>
                                            <td class="text-left">
                                              <?php echo $u['VIC']; ?>
                                              <input type="hidden" class="form-control" value="<?php echo $u['VIC']; ?>" readonly>
                                            </td>
                                          <?php endif;?>
                                        <?php endif;?>
                                        
                                      </tr>
                                      
                                    <?php endif; ?>
                                   
                                  <?php
                                    $total = $OB[1] + $RB[1] + $total;
                                  ?>

                                <?php endforeach ?>

                              </tbody>
                            </table>


                            <?php if($provider == 'abacusxxx'): ?>
                              <table class="table">
                                <tbody>
                                  <tr>
                                      <th colspan="10">Additional Services <small>( Pre-Included baggage )</small></th>
                                  </tr>
                                  <tr>
                                      <td colspan="5">
                                          <label><span class="text-danger">*</span>Pre-Included Onward Baggage : </label>
                                          <span class="text-danger">
                                              <?php 
                                                // var_dump($flight_onward['ResBookDesigCode']);
                                              ?>

                                                  <?php $bk =  $flight_onward['ResBookDesigCode'];
                                                      if($bk=='V' || $bk=='B' || $bk=='X' || $bk=='K' || $bk=='E' || $bk=='T' || $bk=='U' || $bk=='O'){
                                                          // echo 'Budget Economy';
                                                          echo 'Pre-Included baggage allowance 10KG and 7kg hand carry';
                                                      }else if($bk=='Y' || $bk=='S' || $bk=='L' || $bk=='M' || $bk=='H' || $bk=='Q'){
                                                          // echo 'Regular Economy';
                                                          echo 'Pre-Included baggage allowance 20KG and 7kg hand carry';
                                                      }else if($bk=='W' || $bk=='N'){
                                                          // echo 'Premium Economy';
                                                          echo 'Pre-Included baggage allowance 25KG and 7kg hand carry';
                                                      }else {
                                                          echo 'No Pre-Included baggage available. Please Add baggage';
                                                      }
                                                  ?>
                                              <?php //endforeach; ?>
                                          </span>
                                      </td>
                                       <?php if($flight_return): ?>
                                          <td colspan="5" style="border-top: none;">
                                              <label><span class="text-danger">*</span>Pre-Included Return Baggage : </label>
                                              <span class="text-danger">
                                                  <?php 
                                                    // var_dump($flight_return['ResBookDesigCode']);
                                                   ?>
                                                      <?php $bk =  $flight_return['ResBookDesigCode'];
                                                          if($bk=='V' || $bk=='B' || $bk=='X' || $bk=='K' || $bk=='E' || $bk=='T' || $bk=='U' || $bk=='O'){
                                                              // echo 'Budget Economy';
                                                              echo 'Pre-Included baggage allowance 10KG and 7kg hand carry';
                                                          }else if($bk=='Y' || $bk=='S' || $bk=='L' || $bk=='M' || $bk=='H' || $bk=='Q'){
                                                              // echo 'Regular Economy';
                                                              echo 'Pre-Included baggage allowance 20KG and 7kg hand carry';
                                                          }else if($bk=='W' || $bk=='N'){
                                                              // echo 'Premium Economy';
                                                              echo 'Pre-Included baggage allowance 25KG and 7kg hand carry';
                                                          }else {
                                                              echo 'No Pre-Included baggage available. Please Add baggage';
                                                          }
                                                      ?>
                                                  <?php //endforeach; ?>
                                              </span>
                                          </td>
                                      <?php endif; ?>
                                  </tr>
                                </tbody>
                              </table>
                            <?php endif;?>
                                  
                          </div>
                        </div>

                        <div class="list-group">
                            <div class="list-group-item">
                                <h4 style="font-weight: bold; color: #4169E1;">Contact & Delivery Details <small class="text-danger">(FOR SCHEDULE CHANGE ADVISORY)</small></h4>
                                <table class="table">
                                  <thead>
                                      <th><small>Contact No.</small></th>
                                      <th><small>Email Address</small></th>
                                      <th class="text-left"><small>Street</small></th>
                                      <th class="text-left"><small>City</small></th>
                                      <th class="text-left"><small>Zipcode</small></th>
                                    </thead>
                                  <tbody>
                                    <tr>
                                        <td>
                                          <?php echo $contact_info['phone']; ?>
                                        </td>
                                        <td>
                                          <?php echo $contact_info['email']; ?>
                                        </td>
                                        <td>
                                          <?php echo $contact_info['street']; ?>
                                        </td>
                                        <td>
                                          <?php echo $contact_info['city']; ?>
                                        </td>
                                        <td>
                                          <?php echo $contact_info['zipcode']; ?>
                                        </td>
                                    </tr>
                                  </tbody>
                                </table>
                            </div>
                          </div>

                          <div class="list-group">
                            <div class="list-group-item">
                                <h4 style="font-weight: bold; color: #4169E1;">Payment Details</h4>
                                <table class="table">
                                  <thead>
                                      <th><small>Base Fare Fee</small></th>
                                      <th class="text-left"><small>Taxes & Fees</small></th>
                                      <th class="text-left"><small>Baggage Fee</small></th>
                                      <th class="text-left"><small>Total Fee</small></th>
                                    </thead>
                                  <tbody>
                                    <tr>
                                        <td>
                                          <?php echo number_format($payment_details['P']['BaseFareFee'], 2, '.', ','); ?>
                                        </td>
                                        <td>
                                          <?php 
                                            $total_tax = $payment_details['P']['TaxFee'] + $payment_details['P']['SystemFee'] + $payment_details['P']['MarkupFee'];
                                            echo number_format($total_tax, 2, '.', ',');
                                          ?>
                                        </td>
                                        <td>
                                          <?php if($total != '') { echo number_format($total,2, '.', ','); } else{echo '0.00'; }?>
                                        </td>
                                        <td>
                                          <?php echo number_format($payment_details['P']['TotalFee'] +  $total, 2, '.', ','); ?>
                                        </td>
                                    </tr>

                                    <tr>
                                      <td colspan="4">
                                          <form method="post" action="<?php echo BASE_URL()?>Merged_intl_flights/book_international_flights" class="transaction_form" id="frmInternationalFlights">
                                              
                                              <div class="form-group">
                                                <div class="checkbox">
                                                  <label>
                                                    
                                                    <input class="checkbox-primary check_agree" id="checkagree" type="checkbox" value="" required>
                                                    <strong>I AGREE</strong>

                                                    <span>
                                                      
                                                      <br/>
                                                      1. Passengers are responsible for obtaining all required travel documents, visa and permits, and for complying with the laws, regulations, orders, demands and travel requirements of countries of origin, destination or transit.

                                                      <br/>
                                                      2. Passengers alone are fully liable for, and <?php echo $user['CG']=="UPS" ? "UNIFIED":"GPRS" ?> disclaims any responsibility for, the consequences of the Passengers’ failure to obtain or present any required travel document, visa or permit, or to comply with applicable laws, regulations, orders and travel requirements, or any loss or damage which may result from encoding of INCORRECT passenger details. 

                                                      <!-- <br/>
                                                      3. Please make sure you provided the <b>CORRECT Passenger Details</b>. Failure to do so may result to applicable fees and some airlines DO NOT allow name correction and some tickets are NON-REFUNDABLE. -->
                                                    </span>
                                                  </label>
                                                </div>
                                              </div>

                                              <div class="col-xs-12 col-md-12 text-right" style="margin-top:10px">
                                                  <input name="collection" type="hidden" value='<?php echo json_encode($collection,true); ?>'>
                                                  <input type="hidden" class="form-control" name="provider" value="<?php echo $provider; ?>">
                                                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModalCancel"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Cancel</button>
                                                  <button type="button" class="btn btn-primary btn-md btn-booknow" data-toggle="modal" data-target="#myModal" disabled="disabled"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Book Now</button>
                                              </div>  

                                              <div id="myModal" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title" style="font-weight: bold;color: #4169E1;">TERMS AND CONDITIONS</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <p>Fares are subject to availability. In case there is any fare change we will notify you at the earliest.</p>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="checkbox">
                                                              <label><input type="checkbox" value="" required><span>I have read and accept the <b>TERMS AND CONDITIONS</b> and <b>FARE RULES</b>.</span></label>
                                                            </div>
                                                            <!-- <input type="checkbox" value="" required> <span>I have read and accept the <b>TERMS AND CONDITIONS</b> and <b>FARE RULES</b>.</span> -->
                                                        </div>

                                                        <div class="form-group">
                                                          <label><small>Transaction Password :</small></label>
                                                          <input type="password" class="form-control" name="transpass" placeholder="Transaction Password" required>
                                                        </div> 

                                                    </div>
                                                        
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary"  name="btnConfirm">Proceed</button>
                                                    </div>

                                                  </div>
                                                  
                                                </div>
                                              </div>  

                                              <div id="myModalCancel" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                  <!-- Modal content-->
                                                  <div class="modal-content">
                                                    <div class="modal-body">
                                                      <h4 class="text-left">Are you sure you want to CANCEL this transaction ?</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                      <a class="btn btn-primary" href="<?php echo BASE_URL()?>Merged_intl_flights/book_international_flights">Proceed&nbsp;<span class="glyphicon glyphicon-arrow-right"></span></a>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>  
      
                                            </form>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>

                            </div>
                          </div>


                        </div>                           
                     </div>   
                <?php endif ?>

<!--         <?php if ($process === 4): ?>
                    <div class="alert alert-success">
                      <?php echo $output['M']; ?> <br />
                      <b>TN :</b><?php echo $output['TN']; ?>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary"><span class="glyphicon glyphicon-plane"></span>&nbsp;Book Flights</button>
                    </div>
            <?php endif ?> -->

                </div><!-- contentpanel -->
                
            </div><!-- mainpanel -->  

            <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">International Flights</h4>
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


<div id="myIntlSearchModal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
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