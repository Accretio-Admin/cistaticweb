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
                                                                  <form action="<?php echo BASE_URL()?>Domestic_flights/book_flights" method="post" class="transaction_form" id="frmDomesticFlights">
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
                                                                     
                                                                     <div class="form-group">
                                                                          <label>Origin</label>
                                                                          <select class="form-control" name="origin" id="origin">
                                                                                  <?php foreach ($airports['T_DATA'] as $row): ?>
                                                                                    <option value="<?php echo $row['code'] ?>"><?php echo $row['name'] ?></option>
                                                                                  <?php endforeach ?>
                                                                          </select>   
                                                                     </div>  

                                                                     <div class="form-group">
                                                                          <label>Destination</label>
                                                                          <select class="form-control" name="destination" id="destination">
                                                                                  <?php foreach ($airports['T_DATA'] as $row):  ?>
                                                                                    <option value="<?php echo $row['code'] ?>"><?php echo $row['name'] ?></option>
                                                                                  <?php endforeach ?>
                                                                          </select>   
                                                                     </div> 
                                                                     
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
                                                                                      <label>Adult(12 above)   </label>
                                                                                      <select class="form-control"  name="adult" id="adult">
                                                                                              <?php for ($i=1; $i <= 9; $i++){
                                                                                                echo "<option value=".$i.">".$i."</option>";
                                                                                              }?>
                                                                                      </select>   
                                                                                  </div>
                                                                                  <div class="col-xs-6 col-md-6">
                                                                                      <label>Children(2-11 yrs old)</label>
                                                                                      <select class="form-control"  name="children" id="child">
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
                                                                                      <label>Infant(1months to 23 months)</label>
                                                                                      <select class="form-control"  name="infant" id="infant">
                                                                                              <?php for ($i=0; $i <= 9; $i++){
                                                                                                echo "<option value=".$i.">".$i."</option>";
                                                                                              }?>
                                                                                      </select>  
                                                                                  </div>
                                                                                  <div class="col-xs-6 col-md-12">
                                                                                      <br>
                                                                                      <big>
                                                                                          <label class="check-inline">
                                                                                              <input type="checkbox" name="senior_mode" value="1" id="activate_senior" onclick="seniorChoice()">&nbsp;Senior Citizen
                                                                                          </label>
                                                                                      </big>
                                                                                  </div>
                                                                                  <div class="col-md-12 text-justify" id="seniornotes" style="display: none;">
                                                                                      <br>
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

                                                                     <div class="form-group">
                                                                          <div class="row">
                                                                              <div class="col-xs-6 col-md-6">
                                                                                  <label>Airlines</label>
                                                                                  <select class="form-control"  name="airlines">
                                                                                    <?php foreach ($airlines['T_DATA'] as $row): ?>
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
                                                            <?php elseif ($process === 1): ?>
                                                                <?php if ($output['S'] === 0): ?>
                                                                  <div class="alert alert-danger">
                                                                    <?php echo $output['M'] ?>
                                                                  </div>
                                                                <?php endif ?>
                                                                <div class="col-xs-12 col-md-9">
                                                                    <form action="<?php echo BASE_URL()?>Domestic_flights/book_flights" method="post" class="transaction_form" id="frmDomesticFlights">
                                                                            <div class="panel panel-info">
                                                                                  <div class="panel-heading"><b>ONWARDS FLIGHT</b></div>
                                                                                  <div class="panel-body">
                                                                                      <input name="collection" type="hidden" value='<?php echo json_encode($collection,true); ?>'>
                                                                                      <table class="table table-stripped">
                                                                                          <thead>
                                                                                              <th></th>
                                                                                              <th>Choose Flight</th>
                                                                                              <th nowrap >Flight #</th>
                                                                                              <th>Destination</th>
                                                                                              <th>Departure</th> 
                                                                                              <th>Arrival</th>
                                                                                              <th nowrap>Total Fee</th>
                                                                                          </thead>
                                                                                          <tbody>
                                                                                          <?php foreach ($results_onward as $onward): ?>
                                                                                              <tr>
                                                                                                  <td><input type="radio" name="choose_onward_flight" value='<?php echo json_encode(array($onward['Flights'][0]['CarrierID'],$onward['Flights'][0]['CarrierID'].'-'.$onward['Flights'][0]["FlightNumber"],$onward['Flights'][0]["Source"],$onward['Flights'][0]["Destination"],$onward['Flights'][0]["Class"],$onward['Flights'][0]["WarningText"],$Passengers,$onward['Pricing']['currency'].' '.number_format($onward['Pricing']['BaseFareFee'], 2, '.', ','),number_format($onward['Pricing']['TaxFee'] + $onward['Pricing']['SystemFee'] + $onward['Pricing']['MarkupFee'], 2, '.', ','),$onward['Pricing']['currency'].' '.number_format($onward['Pricing']['TotalFee'], 2, '.', ','),$onward['Pricing']['is_available'])) ?>' onclick="get_data(this,div_onward_details)"></td>
                                                                                                  <td>
                                                                                                      <img src="<?php echo base_url('/assets/images/online_booking').'/'.$onward['Flights'][0]['CarrierID'].'.png' ?>">
                                                                                                  </td>
                                                                                                  <td><?php echo $onward['Flights'][0]['CarrierID'].'-'.$onward['Flights'][0]["FlightNumber"] ?></td>
                                                                                                  <td><center><?php echo $onward['Flights'][0]['Destination'] ?></center></td>    
                                                                                                  <td><?php echo date("d M", strtotime(explode('T', $onward['Flights'][0]['DepartureTimeStamp'])[0])).' '.date( 'g:i A', strtotime(explode('T', $onward['Flights'][0]['DepartureTimeStamp'])[1]))?></td>
                                                                                                  <td><?php echo date("d M", strtotime(explode('T', $onward['Flights'][0]['ArrivalTimeStamp'])[0])).' '.date( 'g:i A', strtotime(explode('T', $onward['Flights'][0]['ArrivalTimeStamp'])[1]))?></td>
                                                                                                  <td><strong><?php echo $onward['Pricing']['currency'].' '?></strong><?php echo number_format($onward['Pricing']['TotalFee'], 2, '.', ',') ?></td>
                                                                                              </tr>
                                                                                          <?php endforeach ?>
                                                                                      </tbody>
                                                                                      </table>
                                                                                  </div>
                                                                            </div>
                                                                            <?php if ($results_return): ?>
                                                                                <div class="panel panel-info">
                                                                                      <div class="panel-heading"><b>RETURN FLIGHT</b></div>
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
                                                                                                  <?php foreach ($results_return as $return): ?>  
                                                                                                      <tr>
                                                                                                          <td><input type="radio" name="choose_return_flight" value='<?php echo json_encode(array($return['Flights'][0]['CarrierID'],$return['Flights'][0]['CarrierID'].'-'.$return['Flights'][0]["FlightNumber"],$return['Flights'][0]["Source"],$return['Flights'][0]["Destination"],$return['Flights'][0]["Class"],$return['Flights'][0]["WarningText"],$Passengers,$return['Pricing']['currency'].' '.number_format($return['Pricing']['BaseFareFee'], 2, '.', ','),number_format($return['Pricing']['TaxFee'] + $return['Pricing']['SystemFee'] + $return['Pricing']['MarkupFee'], 2, '.', ','),$return['Pricing']['currency'].' '.number_format($return['Pricing']['TotalFee'], 2, '.', ','))) ?>' onclick="get_data(this,div_return_details)"></td>
                                                                                                          <td>
                                                                                                              <img src="<?php echo base_url('/assets/images/online_booking').'/'.$return['Flights'][0]['CarrierID'].'.png' ?>">
                                                                                                          </td>
                                                                                                          <td><?php echo $return['Flights'][0]['CarrierID'].'-'.$return['Flights'][0]["FlightNumber"] ?></td>
                                                                                                          <td><center><?php echo $return['Flights'][0]['Destination'] ?></center></td> 
                                                                                                          <td><?php echo date("d M", strtotime(explode('T', $return['Flights'][0]['DepartureTimeStamp'])[0])).' '.date( 'g:i A', strtotime(explode('T', $return['Flights'][0]['DepartureTimeStamp'])[1]))?></td>
                                                                                                          <td><?php echo date("d M", strtotime(explode('T', $return['Flights'][0]['ArrivalTimeStamp'])[0])).' '.date( 'g:i A', strtotime(explode('T', $return['Flights'][0]['ArrivalTimeStamp'])[1]))?></td>
                                                                                                          <td><strong><?php echo $return['Pricing']['currency'].' '?></strong><?php echo number_format($return['Pricing']['TotalFee'], 2, '.', ',') ?></td>
                                                                                                      </tr>
                                                                                                  <?php endforeach ?>
                                                                                          </tbody>
                                                                                          </table>
                                                                                      </div>
                                                                                  </div>  
                                                                            <?php endif ?>
                                                                            <div class="row">
                                                                                <div class="col-xs-3 col-md-3">
                                                                                <a href="<?php echo BASE_URL(); ?>Domestic_flights/book_flights">
                                                                                    <button id="booking_search" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-search">&nbsp;</span>Search New</button>
                                                                                </a>
                                                                                </div>
                                                                                <div class="col-xs-3 col-md-3 text-right">
                                                                                    <textarea name="flight_details" readonly hidden><?php echo $flight_details ?></textarea>
                                                                                    <button  class="btn btn-primary" type="submit" name="btnSelectFlight"><span class="glyphicon glyphicon-plane">&nbsp;</span>Choose Flight(s)</button>
                                                                                </div>
                                                                            </div>
                                                                    </form>
                                                                </div> <!-- col-md-9 -->

                                                                <div class="col-md-3  alert alert-info gradient">
                                                                    <div class="margin-top-small margin-bottom-small well" id="div_onward_details" style="display: none;">
                                                                    </div>              
                                                                   
                                                                    <div class="margin-top-small margin-bottom-small well" id="div_return_details" style="display: none;">
                                                                    </div>              
                                                                </div>
                                                            <?php elseif ($process === 2): ?>
                                                              <form action="<?php echo BASE_URL()?>Domestic_flights/book_flights" method="post" class="transaction_form" id="frmDomesticFlights">
                                                                <div class="col-xs-12 col-md-5 well">
                                                                    <div class="row col-md-5" style="width: auto; height: 300px; overflow-y: auto;">
                                                                          <?php $no = 0; foreach ($passengers as $passenger): ?>
                                                                              <hr>
                                                                              <?php $no + 1; ?>
                                                                              <?php if ($passenger['Type'] == 'S'): ?>
                                                                                  <h5 style="font-weight: bold; color: #4169E1; text-align: right;"><span class="badge">SENIOR PASSENGER</span></h5>
                                                                                  <div class="form-group">
                                                                                  <b>Title</b>
                                                                                    <select class="form-control" name="<?php echo 's_title'.$no?>" id="title" >
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
                                                                                        <input type="text" class="form-control" name="<?php echo 's_fname'.$no?>" pattern="[a-zA-Z\s]+" required>
                                                                                      </div>
                                                                                      <div class="col-xs-6 col-md-6">
                                                                                        <b>LastName</b>
                                                                                        <input type="text" class="form-control" name="<?php echo 's_lname'.$no?>" pattern="[a-zA-Z\s]+" required>
                                                                                      </div>
                                                                                    </div>
                                                                                  </div>

                                                                                  <div class="form-group">
                                                                                    <div class="row">
                                                                                      <div class="col-xs-6 col-md-6">
                                                                                        <b>Birthday</b>
                                                                                          <input type="text" class="form-control bdatetimepicker seniorbdate" name="<?php echo 's_bdate'.$no?>" id="birthdate" placeholder="mm/dd/yyyy" required readonly>
                                                                                      </div>
                                                                                      <div class="col-xs-6 col-md-6">
                                                                                        <b>Senior ID</b>
                                                                                        <input type="text" class="form-control" name="<?php echo 's_senior_id'.$no?>" required>
                                                                                      </div>
                                                                                    </div>
                                                                                  </div>

                                                                                  <div class="form-group">
                                                                                   <b>Baggage Onward</b>
                                                                                     <select class="form-control" name="<?php echo 's_baggage_onward'.$no?>" id="baggage_onward">
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
                                                                                           <select class="form-control" name="<?php echo 's_baggage_return'.$no?>" id="baggage_return">
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
                                                                              <?php elseif($passenger['Type'] == 'A'): ?>
                                                                                  <h5 style="font-weight: bold; color: #4169E1; text-align: right;"><span class="badge">(<?php echo $no + 1; ?>) ADULT PASSENGER</span></h5>
                                                                                  <div class="form-group">
                                                                                  <b>Title</b>
                                                                                    <select class="form-control" name="<?php echo 'a_title'.$no ?>" id="title">
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
                                                                                        <input type="text" class="form-control required" name="<?php echo 'a_fname'.$no ?>" pattern="[a-zA-Z\s]+" required>
                                                                                      </div>
                                                                                      <div class="col-xs-6 col-md-6">
                                                                                        <b>LastName</b>
                                                                                        <input type="text" class="form-control required" name="<?php echo 'a_lname'.$no ?>" pattern="[a-zA-Z\s]+" required>
                                                                                      </div>
                                                                                    </div>
                                                                                  </div>

                                                                                  <div class="form-group">
                                                                                    <div class="row">
                                                                                      <div class="col-xs-6 col-md-6">
                                                                                        <b>Birthday</b>
                                                                                          <input type="text" class="form-control bdatetimepicker adultbdate required" name="<?php echo 'a_bdate'.$no ?>" id="birthdate" placeholder="mm/dd/yyyy" required readonly>
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
                                                                                          <input type="text" class="form-control bdatetimepicker childbdate" name="<?php echo 'c_bdate'.$no ?>" id="birthdate" placeholder="mm/dd/yyyy" required readonly>
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
                                                                                          <input type="text" class="form-control bdatetimepicker infantbdate" name="<?php echo 'i_bdate'.$no ?>" id="birthdate" placeholder="mm/dd/yyyy" required readonly>
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
                                         <div class="col-xs-12 col-md-5 well">
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
                                                      $count++;
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
                                          <form method="post" action="<?php echo BASE_URL()?>Domestic_flights/book_flights" class="transaction_form" id="frmDomesticFlights">
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
<!--                               <?php if ($process === 4): ?>
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
