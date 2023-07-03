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
                                                                    <?php echo $output['M']; ?> <br />
                                                                    <p><strong>TRANSACTION NUMBER:</strong>&nbsp;<a href="<?php echo $output['URL'].$output['TN']; ?>"><?php echo $output['TN']; ?></a></p><p><i><small>Click transaction number to download reciept.</small></i></p>
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
                                                                    <form action="<?php echo BASE_URL()?>International_flights/book_international_flights" method="post" id="frmInternationalFlights">
                                                                    <div class="form-group">
                                                                     <big>
                                                                         <label class="radio-inline">
                                                                            <input type="radio" name="flighttype" value="1" required checked onclick="makeChoice(1)"/>Roundtrip
                                                                          </label>
                                                                          <label class="radio-inline">
                                                                            <input type="radio" name="flighttype" value="2" required  onclick="makeChoice(2)"/>Oneway
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
                                                                                    <input type="text" class="form-control datetimepicker" name="dateleave" required placeholder="yyyy-mm-dd">
                                                                                  </div>
                                                                                  <div class="col-xs-6 col-md-6">
                                                                                  <label> Return </label>
                                                                                       <input type="text" class="form-control datetimepicker" name="datereturn" id="date_return" required placeholder="yyyy-mm-dd">
                                                                                  </div>
                                                                          </div>
                                                                     </div> 
                                                                      <div class="form-group">
                                                                          <div class="row">
                                                                                  <div class="col-xs-6 col-md-6">
                                                                                      <label>Adult</label>
                                                                                      <select class="form-control"  name="adult" id="adult">
                                                                                              <?php for ($i=1; $i <= 9; $i++){
                                                                                                echo "<option value=".$i.">".$i."</option>";
                                                                                              }?>
                                                                                      </select>   
                                                                                  </div>
                                                                                  <div class="col-xs-6 col-md-6">
                                                                                      <label>Children</label>
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
                                                                                  <label>Infant</label>
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
                                                                                      <option value="E">Economy</option>
                                                                                      <option value="F">Full-Fare Economy</option>
                                                                                      <option value="B">Business</option>
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

                                                                    <p>Please ensure to submit the required document immediately upon ticket issuance (within one (1) hour of booking) to ticketingsupport@mygprs.ph. Bookings will auto-abort in case of failure to submit required travel documents.</p>

                                                                    <p>For inquiries and concerns, please feel free to contact our Customer Support at the following numbers:</p>
                                                                    <ul>
                                                                      <li>Landline: 998-0991</li>
                                                                      <li>Smart: 0908-444-2728</li>
                                                                      <li>Globe: 0917-783-1922</li>
                                                                      <li>Sun: 0933-995-2860</li>
                                                                    </ul>

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
                                                                    <form action="<?php echo BASE_URL()?>International_flights/book_international_flights" method="post" class="transaction_form" id="frmInternationalFlights">
                                                                            <div class="panel panel-info">
                                                                                  <div class="panel-heading"><b>FLIGHT <span class="glyphicon glyphicon-plane" aria-hidden="true"></span></b></div>
                                                                                  <div class="panel-body table-responsive" style="padding: 0px;">
                                                                                  <input name="collection" type="hidden" value='<?php echo json_encode($collection,true); ?>'>
                                                                                         <table class="table table-stripped">
                                                                                          <thead>
                                                                                              <!-- <th></th> -->
                                                                                              <th style="width:120px;" nowrap>Choose Flight</th>
                                                                                              <th style="border-right: 1px solid #d9edf7; text-align: center" nowrap colspan="3">Outbound</th>
                                                                                              <th style="border-right: 1px solid #d9edf7; text-align: center" nowrap colspan="3">Return</th>
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
                                                                                                             $return['return'][1]['CarrierID'],$return['return'][1]['CarrierID'].'-'.$return['return'][1]["FlightNumber"],$return['return'][1]["Source"],$return['return'][1]["Destination"],$return['return'][1]["Class"],$return['return'][1]["WarningText"]);
                                                                                                $data['onward'] = $onward['onward'][0];
                                                                                                $data['connecting_onward'] = $onward['onward'][1];
                                                                                                $data['return'] = $return['return'][0];
                                                                                                $data['connecting_return'] = $return['return'][1];
                                                                                                $data['pricing'] = $pricing['pricing'];

                                                                                                $count_connFlightReturnset = count($onward['onward']);
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
                                                                                                <td style="width:120px; text-align: center; vertical-align: middle;"><input type="radio" name="choose_flights" value='<?php echo json_encode(array($data)) ?>' data-toggle="modal" data-target="#myModal" onclick="get_data2(this,div_flight_details)"></td>  
                                                                                                <!-- <td style="border-right: 1px solid #d9edf7;"><img src="<?php echo base_url('/assets/images/online_booking').'/'.$onward['onward'][0]['CarrierID'].'.png' ?>"></td> -->
                                                                                                <td nowrap><center><span style="font-size: 11px;"><?php echo '<span style="font-size: 11px;color: #04547C;">Departure Time</span><br>'.date("d M", strtotime(explode('T', $onward['onward'][0]['DepartureTimeStamp'])[0])).' '.date( 'g:i A', strtotime(explode('T', $onward['onward'][0]['DepartureTimeStamp'])[1])).'</span><br><b>'.$onward['onward'][0]['Source']; ?></b></center></td>   
                                                                                                <td nowrap style=" vertical-align: middle;"><center>
                                                                                                <img src="<?php echo base_url('/assets/images/online_booking').'/'.$onward['onward'][0]['CarrierID'].'.png' ?>"><br><br>
                                                                                                <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
<span rel="tooltip" data-toggle="tooltip" data-trigger="hover" data-placement="bottom" data-html="true" data-title="
<center>
<table>
<tr style='text-align: center;'><b>Connecting Flights</b></tr>
<?php 
for ($i=0; $i < count($onward['onward']); $i++) { 
echo "<tr style='text-align: center;'><td nowrap><span style='font-size: 11px;color: #04547C;'>Departure Time</span><br>".date("d M", strtotime(explode('T', $onward['onward'][$i]['DepartureTimeStamp'])[0]))." ".date( 'g:i A', strtotime(explode('T', $onward['onward'][$i]['DepartureTimeStamp'])[1]))."<br>".$onward['onward'][$i]['Source']."</td>
<td style='vertical-align:bottom; style='text-align: center;' nowrap><span class='glyphicon glyphicon-unchecked' aria-hidden='true' style='color: #FFFF48'></span>&nbsp;<span class='glyphicon glyphicon-unchecked' aria-hidden='true' style='color: #FFFF48'></span>&nbsp;<span class='glyphicon glyphicon-unchecked' aria-hidden='true' style='color: #FFFF48'></span></td>
<td style='text-align: center;' nowrap><span style='font-size: 11px;color: #04547C;'>Arrival Time</span><br>".date("d M", strtotime(explode('T', $onward['onward'][$i]['ArrivalTimeStamp'])[0]))." ".date( 'g:i A', strtotime(explode('T', $onward['onward'][$i]['ArrivalTimeStamp'])[1]))."<br>".$onward['onward'][$i]['Destination']."</td></tr>";
}
?>
</tr>
</table>
</center>
" style="color:#04547C; cursor: pointer; max-width: none;">
                                                                                                <u><?php if($count_connFlightOnwardset >= 1){ echo $count_connFlightOnwardset.' Stops'; } else{ echo 'Direct'; } ?></u>
                                                                                                </span>
                                                                                                <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"> </span></center>
                                                                                                </td>
                                                                                                <td style="border-right: 1px solid #d9edf7;" nowrap><center><span style="font-size: 11px;"><?php echo '<span style="font-size: 11px;color: #04547C;">Arrival Time</span><br>'.date("d M", strtotime(explode('T', $onward['onward'][$omax]['ArrivalTimeStamp'])[0])).' '.date( 'g:i A', strtotime(explode('T', $onward['onward'][$omax]['ArrivalTimeStamp'])[1])).'</span><br><b>'.$onward['onward'][$omax]['Destination'] ?></b></center></td>                                                                                                   
                                                                                                <td nowrap style=""><center><span style="font-size: 11px;"><?php echo '<span style="font-size: 11px;color: #04547C;">Departure Time</span><br>'.date("d M", strtotime(explode('T', $return['return'][0]['DepartureTimeStamp'])[0])).' '.date( 'g:i A', strtotime(explode('T', $return['return'][0]['DepartureTimeStamp'])[1])).'</span><br><b>'.$return['return'][0]['Source']; ?></b></center></td>   
                                                                                                <td nowrap style=" vertical-align: middle;"><center>
                                                                                                <img src="<?php echo base_url('/assets/images/online_booking').'/'.$return['return'][0]['CarrierID'].'.png' ?>"><br><br>
                                                                                                <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
<span rel="tooltip" data-toggle="tooltip" data-trigger="hover" data-placement="bottom" data-html="true" data-title="
<center>
<table>
<tr style='text-align: center;'><b>Connecting Flights</b></tr>
<?php 
for ($i=0; $i < count($return['return']); $i++) { 
echo "<tr style='text-align: center;'><td nowrap><span style='font-size: 11px;color: #04547C;'>Departure Time</span><br>".date("d M", strtotime(explode('T', $return['return'][$i]['DepartureTimeStamp'])[0]))." ".date( 'g:i A', strtotime(explode('T', $return['return'][$i]['DepartureTimeStamp'])[1]))."<br>".$return['return'][$i]['Source']."</td>
<td style='vertical-align:bottom; style='text-align: center;' nowrap><span class='glyphicon glyphicon-unchecked' aria-hidden='true' style='color: #FFFF48'></span>&nbsp;<span class='glyphicon glyphicon-unchecked' aria-hidden='true' style='color: #FFFF48'></span>&nbsp;<span class='glyphicon glyphicon-unchecked' aria-hidden='true' style='color: #FFFF48'></span></td>
<td style='text-align: center;' nowrap><span style='font-size: 11px;color: #04547C;'>Arrival Time</span><br>".date("d M", strtotime(explode('T', $return['return'][$i]['ArrivalTimeStamp'])[0]))." ".date( 'g:i A', strtotime(explode('T', $return['return'][$i]['ArrivalTimeStamp'])[1]))."<br>".$return['return'][$i]['Destination']."</td></tr>";
}
?>
</tr>
</table>
</center>
" style="color:#04547C; cursor: pointer;">
                                                                                                <u><?php if($count_connFlightReturnset >= 1){ echo $count_connFlightReturnset.' Stops'; } else{ echo 'Direct'; } ?></u>
                                                                                                </span>
                                                                                                <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"> </span></center>
                                                                                                </td>   
                                                                                                <td style="border-right: 1px solid #d9edf7;" nowrap><center><span style="font-size: 11px;"><?php echo '<span style="font-size: 11px;color: #04547C;">Arrival Time</span><br>'.date("d M", strtotime(explode('T', $return['return'][$rmax]['ArrivalTimeStamp'])[0])).' '.date( 'g:i A', strtotime(explode('T', $return['return'][$rmax]['ArrivalTimeStamp'])[1])).'</span><br><b>'.$return['return'][$rmax]['Destination'] ?></b></center></td>   
                                                                                                <td nowrap style="vertical-align: middle; font-size: medium;"><strong><?php echo $pricing['pricing']['currency'].' '?></strong><?php echo number_format($pricing['pricing']['TotalFee'], 2, '.', ',') ?></td>                                                                                                                                                                                                                               
                                                                                              </tr>
                                                                                              <?php endforeach ?>
                                                                                          </tbody>
                                                                                      </table>
                                                                                  </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-xs-12 col-md-12">
                                                                                <a href="<?php echo BASE_URL(); ?>International_flights/book_flights">
                                                                                    <button id="booking_search" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-search">&nbsp;</span>Search New</button>
                                                                                </a>
                                                                                </div>
                                                                                <div class="col-xs-12 col-md-12 text-right">
                                                                                    <textarea name="flight_details" readonly hidden><?php echo $flight_details ?></textarea>
                                                                                    <button  class="btn btn-primary" type="submit" name="btnSelectFlight"><span class="glyphicon glyphicon-plane">&nbsp;</span>Choose Flight(s)</button>
                                                                                </div>
                                                                            </div>
                                                                    </form>
                                                                </div> <!-- col-md-9 -->

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Flight Details</h4>
      </div>
      <div class="modal-body alert alert-info gradient">
            <div class="margin-top-small margin-bottom-small well" id="div_flight_details" style="display: none;"></div>                          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!--                                                                 <div class="col-md-3  alert alert-info gradient">
                                                                    <div class="margin-top-small margin-bottom-small well" id="div_flight_details" style="display: none;"></div>                          
                                                                </div> -->

                                                            <?php elseif ($process === 2): ?>
                                                                    <form action="<?php echo BASE_URL()?>International_flights/book_international_flights" method="post" class="transaction_form" id="frmInternationalFlights">
                                                                        <div class="col-xs-12 col-md-5 well">
                                                                        <div class="row col-md-5" style="width: auto; height: 300px; overflow-y: auto;">
                                                                          <?php $no = 0; foreach ($passengers as $passenger): ?>
                                                                            <hr>
                                                                            <?php $no + 1; ?>
                                                                            <?php if($passenger['Type'] == 'A'): ?>
                                                                                <h5 style="font-weight: bold; color: #4169E1; text-align: right;"><span class="badge">(<?php echo $no + 1; ?>) ADULT PASSENGER</span></h5>
                                                                                <div class="form-group">
                                                                                <b>Title</b>
                                                                                  <select class="form-control" name="<?php echo 'a_title'.$no ?>" id="title">
                                                                                          <option value="1">Mr</option>
                                                                                          <!-- <option value="2">Mrs</option> -->
                                                                                          <option value="3">Miss</option>
                                                                                          <!-- <option value="4">Mstr</option> -->
                                                                                  </select>   
                                                                                </div> 

                                                                                <div class="form-group">
                                                                                  <div class="row">
                                                                                    <div class="col-xs-6 col-md-6">
                                                                                      <b>FirstName</b>
                                                                                      <input type="text" class="form-control" name="<?php echo 'a_fname'.$no ?>" pattern="[a-zA-Z\s]+" required>
                                                                                    </div>
                                                                                    <div class="col-xs-6 col-md-6">
                                                                                      <b>LastName</b>
                                                                                      <input type="text" class="form-control" name="<?php echo 'a_lname'.$no ?>" pattern="[a-zA-Z\s]+" required>
                                                                                    </div>
                                                                                  </div>
                                                                                </div>

                                                                                <div class="form-group">
                                                                                  <div class="row">
                                                                                    <div class="col-xs-6 col-md-6">
                                                                                      <b>Birthday</b>
                                                                                        <input type="text" class="form-control bdatetimepicker" name="<?php echo 'a_bdate'.$no ?>" id="birthdate" placeholder="mm/dd/yyyy" required readonly>
                                                                                    </div>
                                                                                  </div>
                                                                                </div>

                                                                                <div class="form-group">
                                                                                 <b>Baggage Onward</b>
                                                                                   <select class="form-control" name="<?php echo 'a_baggage_onward'.$no ?>" id="baggage_onward">
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
                                                                                </div>  
                                                                                <?php if ($returnbaggages): ?>
                                                                                    <div class="form-group">
                                                                                        <b>Baggage Return</b>
                                                                                         <select class="form-control" name="<?php echo 'a_baggage_return'.$no ?>" id="baggage_return">
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
                                                                                    </div> 
                                                                                <?php endif ?>
                                                                            <?php elseif($passenger['Type'] == 'C'): ?>
                                                                                <h5 style="font-weight: bold; color: #4169E1; text-align: right;"><span class="badge">CHILD PASSENGER</span></h5>
                                                                                <div class="form-group">
                                                                                <b>Title</b>
                                                                                  <select class="form-control" name="<?php echo 'c_title'.$no ?>" id="title">
                                                                                          <!-- <option value="1">Mr</option>
                                                                                          <option value="2">Mrs</option> -->
                                                                                          <option value="3">Miss</option>
                                                                                          <option value="4">Mstr</option>
                                                                                  </select>   
                                                                                </div> 

                                                                                <div class="form-group">
                                                                                  <div class="row">
                                                                                    <div class="col-xs-6 col-md-6">
                                                                                      <b>FirstName</b>
                                                                                      <input type="text" class="form-control" name="<?php echo 'c_fname'.$no ?>" pattern="[a-zA-Z\s]+" required>
                                                                                    </div>
                                                                                    <div class="col-xs-6 col-md-6">
                                                                                      <b>LastName</b>
                                                                                      <input type="text" class="form-control" name="<?php echo 'c_lname'.$no ?>" pattern="[a-zA-Z\s]+" required>
                                                                                    </div>
                                                                                  </div>
                                                                                </div>

                                                                                <div class="form-group">
                                                                                  <div class="row">
                                                                                    <div class="col-xs-6 col-md-6">
                                                                                      <b>Birthday</b>
                                                                                        <input type="text" class="form-control bdatetimepicker" name="<?php echo 'c_bdate'.$no ?>" id="birthdate" placeholder="mm/dd/yyyy" required readonly>
                                                                                    </div>
                                                                                  </div>
                                                                                </div>

                                                                                <div class="form-group">
                                                                                 <b>Baggage Onward</b>
                                                                                   <select class="form-control" name="<?php echo 'c_baggage_onward'.$no ?>" id="baggage_onward">
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
                                                                                </div>  
                                                                                <?php if ($returnbaggages): ?>
                                                                                    <div class="form-group">
                                                                                        <b>Baggage Return</b>
                                                                                         <select class="form-control" name="<?php echo 'c_baggage_return'.$no ?>" id="baggage_return">
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
                                                                                    </div> 
                                                                                <?php endif ?>
                                                                            <?php elseif($passenger['Type'] == 'I'): ?> 

                                                                                <h5 style="font-weight: bold; color: #4169E1; text-align: right;"><span class="badge">INFANT PASSENGER</span></h5>
                                                                                <div class="form-group">
                                                                                <b>Title</b>
                                                                                  <select class="form-control" name="<?php echo 'i_title'.$no ?>" id="title">
                                                                                          <!-- <option value="1">Mr</option>
                                                                                          <option value="2">Mrs</option> -->
                                                                                          <option value="3">Miss</option>
                                                                                          <option value="4">Mstr</option>
                                                                                  </select>   
                                                                                </div> 

                                                                                <div class="form-group">
                                                                                  <div class="row">
                                                                                    <div class="col-xs-6 col-md-6">
                                                                                      <b>FirstName</b>
                                                                                      <input type="text" class="form-control" name="<?php echo 'i_fname'.$no ?>" pattern="[a-zA-Z\s]+" required>
                                                                                    </div>
                                                                                    <div class="col-xs-6 col-md-6">
                                                                                      <b>LastName</b>
                                                                                      <input type="text" class="form-control" name="<?php echo 'i_lname'.$no ?>" pattern="[a-zA-Z\s]+" required>
                                                                                    </div>
                                                                                  </div>
                                                                                </div>

                                                                                <div class="form-group">
                                                                                  <div class="row">
                                                                                    <div class="col-xs-6 col-md-6">
                                                                                      <b>Birthday</b>
                                                                                        <input type="text" class="form-control bdatetimepicker" name="<?php echo 'i_bdate'.$no ?>" id="birthdate" placeholder="mm/dd/yyyy" required readonly>
                                                                                    </div>
                                                                                  </div>
                                                                                </div>
                                                                            <?php endif ?>
                                                                            <?php $no++; ?>
                                                                        <?php endforeach ?>
                                                                      </div>
                                                                      <hr>
                                                                      <div class="row col-md-5" style="width: 100%;">
                                                                      <div class="form-group">
                                                                      <h5 style="font-weight: bold; color: #4169E1;">CONTACT DETAILS</h5>
                                                                        <div class="row">
                                                                          <div class="col-xs-6 col-md-12" >
                                                                            <b>Contact No</b>
                                                                            <input type="text" class="form-control required" name="contactno" required>
                                                                          </div>
                                                                        </div>
                                                                      </div>

                                                                      <h5 style="font-weight: bold; color: #4169E1;">DELIVERY DETAILS</h5>
                                                                      <div class="form-group">
                                                                        <b>Street</b>
                                                                        <input type="text" class="form-control required" name="street" required>
                                                                      </div> 

                                                                      <div class="form-group">
                                                                        <div class="row">
                                                                          <div class="col-xs-6 col-md-8" >
                                                                            <b>City</b>
                                                                            <input type="text" class="form-control required" name="city" required>
                                                                          </div>
                                                                          <div class="col-xs-6 col-md-4">
                                                                            <b>Zipcode</b>
                                                                            <input type="text" class="form-control required" name="zipcode" required>
                                                                          </div>
                                                                        </div>
                                                                      </div>

                                                                      <div class="form-group">
                                                                          <div class="row">
                                                                              <div class="col-md-12 text-right">
                                                                                  <textarea name="flight_details" hidden><?php echo $flight_details; ?></textarea>
                                                                                  <a href="#" class="btn btn-warning"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Cancel</a>
                                                                                  <button name="btnBookFlights" id="btnBookFlights" class="btn btn-primary" disabled="">Next&nbsp;<span class="glyphicon glyphicon-arrow-right"></span></button>
                                                                              </div>
                                                                          </div>
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
                      <div class="row" style="margin-left: 1%">
                        <div class="col-sm-12 col-md-12">
                          <?php if ($output['S'] === 0): ?>
                            <div class="alert alert-danger">
                              <?php echo $output['M']; ?>
                            </div>
                          <?php endif ?>
                         <div class="col-xs-12 col-md-5 well" >
                          <h5 style="font-weight: bold; color: #4169E1;"><span class="badge">PASSENGER DETAILS</span></h5>
                          <div class="row col-md-5" style="width: auto; height: 240px; overflow-y: auto;">
                         <?php
                           $total = 0;
                           $count = 0;
                         ?>
                        <?php foreach ($ui_passengers_details as $u ): ?>
                            <?php
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
                                    <div class="col-xs-12 col-md-12">
                                      <h5 style="font-weight: bold; color: #4169E1; text-align: right;"><?php echo '('.($count+1).') '.$p; ?> PASSENGER</h5>
                                      <div class="form-group">
                                        <div class="row">
                                          <div class="col-xs-12 col-md-4">
                                              <b>Name</b>
                                          </div>
                                          <div class="col-xs-12 col-md-8">
                                                <input type="text" class="form-control" value="<?php echo $u['name']; ?>" readonly>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <div class="row">
                                          <div class="col-xs-12 col-md-4">
                                              <b>Birth Date</b>
                                          </div>
                                          <div class="col-xs-12 col-md-8">
                                                <input type="text" class="form-control" value="<?php echo $u['bdate']; ?>" readonly>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <div class="row">
                                          <div class="col-xs-12 col-md-4">
                                              <b>Senior ID</b>
                                          </div>
                                          <div class="col-xs-12 col-md-8">
                                                <input type="text" class="form-control" value="<?php echo $u['SID']; ?>" readonly>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <div class="row">
                                        <div class="col-xs-12 col-md-4">
                                            <b>Baggage Onward</b>
                                        </div>
                                        <div class="col-xs-12 col-md-8">
                                              <input type="text" class="form-control" value="<?php echo $OB[1]; ?>" readonly>
                                        </div>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <div class="row">
                                        <div class="col-xs-12 col-md-4">
                                            <b>Baggage Return</b>
                                        </div>
                                        <div class="col-xs-12 col-md-8">
                                              <input type="text" class="form-control" value="<?php echo $RB[1]; ?>" readonly>
                                        </div>
                                        </div>
                                      </div>
                                 </div> 
                              <?php else: ?>
                               <div class="col-xs-12 col-md-12">
                                      <h5 style="font-weight: bold; color: #4169E1; text-align: right;"><?php echo '('.($count+1).') '.$p; ?> PASSENGER</h5>
                                      <div class="form-group">
                                        <div class="row">
                                          <div class="col-xs-12 col-md-4">
                                              <b>Name</b>
                                          </div>
                                          <div class="col-xs-12 col-md-8">
                                                <input type="text" class="form-control" value="<?php echo $u['name']; ?>" readonly>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <div class="row">
                                          <div class="col-xs-12 col-md-4">
                                              <b>Birth Date</b>
                                          </div>
                                          <div class="col-xs-12 col-md-8">
                                                <input type="text" class="form-control" value="<?php echo $u['bdate']; ?>" readonly>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                      <h6 style="font-weight: bold;"><u>BAGGAGE</u></h6>
                                        <div class="row">
                                          <div class="col-xs-12 col-md-4">
                                              <b>Onward</b>
                                          </div>
                                          <div class="col-xs-12 col-md-8">
                                                <input type="text" class="form-control" value="<?php echo $OB[1]; ?>" readonly>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <div class="row">
                                        <div class="col-xs-12 col-md-4">
                                            <b>Return</b>
                                        </div>
                                        <div class="col-xs-12 col-md-8">
                                              <input type="text" class="form-control" value="<?php echo $RB[1]; ?>" readonly>
                                        </div>
                                        </div>
                                      </div>

                                 </div> 
                                 <?php endif; ?>
                                <?php
                                    $total = $OB[1] + $RB[1] + $total;
                                ?>
                              <?php endforeach ?>
                           </div>
                            <hr>
                            <div class="row col-md-5" style="width: 100%;">
                              <h5 style="font-weight: bold; color: #4169E1;"><span class="badge">DELIVERY DETAILS</span></h5>
                                <form class="form-inline">
                                <div class="form-group">
                                  <div class="row">
                                    <div class="col-xs-12 col-md-4">
                                      <b>Contact No</b>
                                    </div>
                                    <div class="col-xs-12 col-md-8">
                                      <input type="text" class="form-control"  style="width: 260px;" value="<?php echo $contact_info['phone']; ?>" readonly="">  
                                    </div>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <div class="row">
                                    <div class="col-xs-12 col-md-4">
                                      <b>Street</b>
                                    </div>
                                    <div class="col-xs-12 col-md-8" style="padding-right: 45px;">
                                      <input type="text" class="form-control" style="width: 260px;" value="<?php echo $contact_info['street']; ?>" readonly="">
                                    </div>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <div class="row">
                                    <div class="col-xs-6 col-md-6">
                                      <b>City</b>
                                      <input type="text" class="form-control" value="<?php echo $contact_info['city']; ?>" readonly="">
                                    </div>
                                    <div class="col-xs-6 col-md-6">
                                      <b>Zipcode</b>
                                      <input type="text" class="form-control" value="<?php echo $contact_info['zipcode']; ?>" readonly="">
                                    </div>
                                  </div>
                                </div>

                                </form>
                            </div>
                          </div>                                                

                          <div class="col-xs-12 col-md-5 col-md-offset-1 well" style="margin-left: 2%;">
                          <form method="post" action="<?php echo BASE_URL()?>International_flights/book_international_flights" class="transaction_form" id="frmInternationalFlights">
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                  <h5 style="font-weight: bold; color: #4169E1;"><span class="badge">PAYMENT DETAILS</span></h5>
                                  <div class="row">
                                    <div class="col-xs-6 col-md-12" >
                                      <b>Base Fare Fee</b>
                                      <input type="text" class="form-control pull-right" value="<?php echo number_format($payment_details['P']['BaseFareFee'], 2, '.', ','); ?>" readonly="">
                                    </div>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <b>Taxes & Fees</b>
                                  <?php 
                                  $total_tax = $payment_details['P']['TaxFee'] + $payment_details['P']['SystemFee'] + $payment_details['P']['MarkupFee'];
                                  ?>
                                  <input type="text" class="form-control pull-right" value="<?php echo number_format($total_tax, 2, '.', ','); ?>" readonly="">
                                </div> 

                                <div class="form-group">
                                  <b>Baggage Fee</b>
                                  <input type="text" class="form-control pull-right" value="<?php if($total != '') { echo number_format($total,2, '.', ','); } else{echo '0.00'; }?>" readonly="">
                                </div> 

                                <div class="form-group">
                                  <b>Total Fee</b>
                                  <input type="text" class="form-control pull-right" value="<?php echo number_format($payment_details['P']['TotalFee'] +  $total, 2, '.', ','); ?>" readonly="">
                                </div> 

                                <div class="form-group">
                                  <h5 style="font-weight: bold; color: #4169E1;"><span class="badge">TERMS AND CONDITIONS</span></h5>
                                  <p>Fares are subject to availability. In case there is any fare change we will notify you at the earliest.</p>
                                  <input type="checkbox" value="" required> <span>I have read and accept the <b>TERMS AND CONDITIONS</b> and <b>FARE RULES</b>.</span>
                                </div>

                                <div class="form-group">
                                  <b>Transaction Password</b>
                                  <input type="password" class="form-control" name="transpass" required>
                                </div> 

                              </div>
                              
                                    
                               <div class="col-xs-12 col-md-12 text-right" style="margin-top:10px">
                                   <input name="collection" type="hidden" value='<?php echo json_encode($collection,true); ?>'>
                                                <button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Cancel</button>
                                                <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Book Now</button>
                                 
                                    <div id="myModal" class="modal fade" role="dialog">
                                      <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                          <div class="modal-body">
                                            <h4 class="text-left">Are you sure you want to proceed ?</h4>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                             <button type="submit" class="btn btn-primary"  name="btnConfirm">Proceed</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>  
                                </div>        
                                </form> 
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

            <script type="text/javascript">
                $(document).ready(function(){
                   $('span[rel="tooltip"]').tooltip();
                });
            </script>