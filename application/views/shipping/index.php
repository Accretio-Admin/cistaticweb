<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="<?php echo BASE_URL()?>assets/js/jquery.min.js"></script>

<style>


#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}
.modal-body {
    max-height: calc(100vh - 173px);
    overflow-y: auto; 
}




</style>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="mainpanel">
  <div class="pageheader">
      <div class="media">
          <div class="pageicon pull-left">
              <i class="fa fa-anchor"></i>
          </div>
          <div class="media-body">
              <ul class="breadcrumb">
                  <li><a href="#"><i class="fa fa-anchor"></i></a></li>
                  <li>Shipping</li>
              </ul>
              <h4>Booking for Shipping <?php echo $a; ?></h4>
          </div>
      </div><!-- media -->
  </div><!-- pageheader -->
    <br>

<div class="modal fade" id="checkTrack" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Check Tracking Number</h5>
      </div>
      <div class="modal-body">
      <div class="row" style="display:none;" id="alerttrack">
        <div class="col-md-12" align="center">
        <div class="alert alert-info" role="alert" id="alerttrackmessage">
          
        </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group">
          <label for="exampleTrackno">Tracking Number</label>
          <input type="text" class="form-control" id="exampleTrackno" name="exampleTrackno" aria-describedby="exampleTrackno" placeholder="Enter Tracking Number">
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="validateTrackno">Validate</button>
      </div>
    </div>
  </div>
</div>

<script>

$("#validateTrackno").click(function(){
  var tr = $("#exampleTrackno").val();
  waitingDialog.show();
  $.ajax({
    type: 'POST',
    url: `/Shipping/Shipping_checkTrackno`,
    data: {tracknos : tr},
    success: function (data) {
      waitingDialog.hide();
      var res = JSON.parse(data);
      console.log(res);

      if(res.result.length == 0){
        $("#alerttrack").show();
        $("#alerttrackmessage").html("No results found.")
      }else{
        $("#alerttrack").show();
      if(res.result[0].status == "PENDING"){
        $("#alerttrack").show();
        $("#alerttrackmessage").html("Transaction is "+ res.result[0].status)
      }else if(res.result[0].status == "APPROVED"){
        $("#alerttrack").show();
        $("#alerttrackmessage").html("Transaction has been "+ "<span style='color: green;'>" +res.result[0].status + "</span>")
      }else{
        $("#alerttrack").show();
        $("#alerttrackmessage").html("Transaction has been "+ "<span style='color: red;'>" +res.result[0].status + "</span>")
      }

    }
      
      
      // // $("#messageTranspass").append(res.TN);
      // $("#messageTransno").text(res.TN);


    },
    error: function (data) {
      console.log(data)
    }
  });
});
</script>

<div class="col-md-12">
    <form method="post" id="frmSearchShippingEngine" autocomplete="off" >
      <div class="row">

        <div class="col-md-8">
            <div class="panel panel-primary">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <h3 class="panel-title">
                    <div class="row">
                      <div align="left" class="col-md-6" >Shipping 
                      </div></div> 
                    </h3>
                </div>
                <div class="panel-body">

                <div class="row">
                <div class="col-md-12">
                <div class="alert alert-danger" role="alert" id="wrong" style="text-align: center;display:none;">
                  
                </div>
                </div>
                </div>

                <div class="row">

                  <div class="col-md-4">
                    <div class="shipForm">

                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              

                                  

                                  <div class="panel panel-info">
                                    <div class="panel-body">
                                    <center>
                                      <label class="radio-inline">
                                        <input type="radio" name="selRadio" value="1" checked>One way
                                      </label>
                                      <label class="radio-inline">
                                        <input type="radio" name="selRadio" value="2">Round trip
                                      </label>
                                    </center>
                                    </div>
                                  </div>

                              
                            </div> 
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <a href="#">
                                </span> <i class="fa fa-ship"></i>
                              </a>
                                <label for="selShipping">Choose Shipping <!-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#checkTrack">Check Tracking number</button> --> </label>
                                <select class="form-control ship" id="selShipping" name="selShipping">
                                  <option value="0">Please choose shipping..</option>
                                  <?php 

                                  $count = $results["COUNTDATA"]["count"];
                                  

                                  for($x = 0; $x < $count; $x++){ ?>

                                  <option value="<?php echo $results['DATA'][$x]['shipid'] ?>"><?php echo $results['DATA'][$x]['shipname'] ?></option>
                                  
                                  <?php } ?>
                                </select>
                            </div> 
                          </div>
                        </div>
                        <!-- <?php echo $count; ?> -->

                        <div class="row">
                          <div class="col-md-12">
                            <div class="Departure" id="departure">
                              <div class="form-group">
                              <a href="#">
                                <span class="glyphicon glyphicon-list-alt"></span>
                              </a>
                                <label for="selDeparture">Select Schedule</label> <span style="color:red;" class="glyphicon glyphicon-arrow-right"></span>
                                <input type="date" id="selDeparture" name="selDeparture" class="form-control" placeholder="mm/dd/yyyy">
                                


                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row" id="scheduleforroundtrip" style="display: none;">
                          <div class="col-md-12">
                            <div class="DepartureRoundTrip" id="departureroundtrip">
                              <div class="form-group">
                              <a href="#">
                                <span class="glyphicon glyphicon-list-alt"></span>
                              </a>
                                <label for="selDepartureRoundTrip">Select Schedule</label> <span style="color:red;" class="glyphicon glyphicon-arrow-left"></span>
                                <input type="date" id="selDepartureRoundTrip" name="selDepartureRoundTrip" class="form-control" placeholder="mm/dd/yyyy">
                                


                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <div class="Location" id="location">
                              <div class="form-group">
                                <a href="#">
                                  <i class="fa fa-anchor"></i>
                                </a>
                                <label for="selRoute">Departure</label>
                                <select class="form-control ship" name="selLocation" id="selLocation">
                                  <option data-subtext="<i class='glyphicon glyphicon-flag'></i>" value="0">Please choose departure..</option>
                                </select>
                                <input type="hidden" id="myFund" value="<?php echo $results['FUND'][0]['virtualvisa_fund']; ?>">
                              </div>
                            </div>

                          </div>
                        <!-- </div>



                        <div class="row"> -->



                          <div class="col-md-6">
                            <div class="Location">
                              <div class="form-group">
                                <a href="#">
                                  <i class="fa fa-anchor"></i>
                                </a>
                                <label for="selLocationDestination">Destination</label>
                                <select class="form-control ship" name="selLocationDestination" id="selLocationDestination">
                                  <option data-subtext="<i class='glyphicon glyphicon-flag'></i>" value="0">Please choose destination..</option>
                                </select>
                                <!-- <input type="hidden" id="myFund" value="<?php echo $results['FUND'][0]['virtualvisa_fund']; ?>"> -->
                              </div>
                            </div>

                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <div class="Route" id="route">
                              <div class="form-group">
                                <a href="#">
                                  <i class="fa fa-road"></i>
                                </a>
                                <label for="selRoute">Time Departure <span style="color:red;" class="glyphicon glyphicon-arrow-right"></span>&nbsp;<b id="right"></b> <!-- <span style="color:red;size: 12px;">*One way only</span> --></label>
                                <select class="form-control ship" name="selRoute" id="selRoute">
                                  <option data-subtext="<i class='glyphicon glyphicon-eye-open'></i>" value="0">Please choose time..</option>
                                  
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row" id="forroundtrip" style="display: none;">
                          <div class="col-md-12">
                            <div class="RouteDeparture" id="routedeparture">
                              <div class="form-group">
                                <a href="#">
                                  <i class="fa fa-road"></i>
                                </a>
                                <label for="selRoute">Time Departure <span style="color:red;" class="glyphicon glyphicon-arrow-left"></span>&nbsp;<b id="left"></b> <!-- <span style="color:red;size: 12px;">*One way only</span> --></label>
                                <select class="form-control ship" name="selRouteDeparture" id="selRouteDeparture">
                                  <option data-subtext="<i class='glyphicon glyphicon-eye-open'></i>" value="0">Please choose time..</option>
                                  
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>

                        <script>
                        $('input[type=radio][name=selRadio]').change(function() {
                              if (this.value == '1') {
                                  $("#forroundtrip").fadeOut();
                                  $("#scheduleforroundtrip").fadeOut();
                                
                              }
                              else if (this.value == '2') {
                                  $("#forroundtrip").fadeIn();
                                  $("#scheduleforroundtrip").fadeIn();

                              }
                          });
                        </script>

                        <div class="row">
                          <div class="col-md-12">
                            <div class="Seat" id="seat">
                              <div class="form-group">
                                <a href="#">
                                  <span class="glyphicon glyphicon-lock"></span>
                                </a>
                                <label for="selSeat">Select Preferred Seat Class</label>
                                <select class="form-control ship" name="selSeat" id="selSeat">
                                  <option value="0">Please choose seat..</option>
                                 <!--  <?php 

                                  $count = $results["COUNTSEATS"]["count"];
                                  

                                  for($xx = 0; $xx < $count; $xx++){ ?>

                                  <option value="<?php echo $results['SEATS'][$xx]['seatsid'] ?>"><?php echo $results['SEATS'][$xx]['seats'] ?></option>
                                  
                                  <?php } ?> -->
                                  
                                </select>

                                <script>
                                $("#selSeat").change(function(){

                                  $("#adult").val("0");
                                  $("#infant").val("0");
                                  $("#student").val("0");
                                  $("#senior").val("0");
                                  $("#regular").val("0");
                                  $("#minor").val("0");

                                  // var radio = $('input[type=radio][name=selRadio]:checked').val();
                                  // var shipid = $("#selShipping option:selected").val();
                                  // var seat = $("#selSeat option:selected").val();
                                  // var location = $("#selLocation option:selected").val(); //shiplocationid
                                  // var destination = $("#selLocationDestination option:selected").val(); //shiplocationid
                                  // var route = $("#selRoute option:selected").val();
                                  // var amount = $("#totalamount").val();

                                  waitingDialog.show();
                                   var numberofpassengers = parseInt($("#adult").val()) + parseInt($("#infant").val()) + parseInt($("#student").val()) + parseInt($("#senior").val());

                                         var formData = $("#frmSearchShippingEngine")[0];
                                         var form_data = new FormData(formData);
                                         form_data.append("numberofpassengers", numberofpassengers);

                                         $.ajax({
                                                  type: 'POST',
                                                  url: `/Shipping/checkRemainingTickets`,
                                                  data: form_data,
                                                  processData: false,
                                                  contentType: false,
                                                  success: function (data) {
                                                    var res = JSON.parse(data);
                                                    console.log(res);

                                                    
                                                      $("#REMAININGTICKETS").val(res.PABLO);
                                                    
                                                    // alert("true");
                                                    // return true;

                                                    waitingDialog.hide();
                                                  },
                                                  error: function (data) {
                                                    console.log(data)
                                                  }
                                              });

                                });
                                </script>

                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <div class="Passengers" id="passengers">
                              <div class="form-group">
                                <a href="#">
                                  <span class="glyphicon glyphicon-certificate"></span>
                                </a>
                                <label for="selRoute">Number of Passengers <span style="color:red;size: 12px;">*Maximum of 10 passengers</span></label>

                                <div class="panel panel-default">
                                  <div class="panel-body">

                                  <div class="col-md-10">

                                    <div class="row">
                                      <div class="row">
                                        <div class="form-group">
                                          <!-- <label for="adult">Adult:</label>
                                          <select class="form-control ship" onchange="passengersSelect(this)" name="adult" id="adult">
                                          <?php for($x=0 ;$x <= 15; $x++){ ?>
                                            <option data-subtext="<i class='glyphicon glyphicon-eye-open'></i>" value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                          <?php } ?>
                                          </select> -->


   





  

                                        


                                          <!-- <label for="adult">Adult:</label> -->
                                          <!-- <select class="form-control ship" onchange="passengersSelect(this)" name="adult" id="adult">
                                          <?php for($x=0 ;$x <= 15; $x++){ ?>
                                            <option data-subtext="<i class='glyphicon glyphicon-eye-open'></i>" value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                          <?php } ?>
                                          </select> -->
                                          
                                          
                                          <!-- <button type="button" class="btn btn-info btn-xs" data-toggle="modal" id="adultDetails" data-target="#myModalAdult" data-backdrop="static" data-keyboard="false">Add Adult Details here</button> -->
                                        </div>
                                      </div>

                                      <div class="row" id="minorTrans">
                                        <div class="form-group">
                                          <div class='incrementdecrementminor'>
                                          <label for="adult">Minor:</label>
                                          <br>
                                          <div class="col-md-5">
                                          <input class="form-control ship" oninput="passengersMinor(this)" name="minorrange" onkeypress="return isNumber(event)" id="minor" value="0">
                                          </div>

                                          <div class="col-md-2"><div class="inc"><span id="buttonminorplus" style="cursor:pointer" class="glyphicon glyphicon-plus-sign"></span></div><div class="dec buttonminor" ><span id="buttonminorminus" style="cursor:pointer" class="glyphicon glyphicon-minus-sign"></span></div></div>
                                          </div>

                                          <!-- divdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdiv -->

                                          <script>
                                          var minormoney = 1500;
                                              function passengersMinor(e){

                                                if(e.value == 0){
                                                  $("#minoramount").fadeOut();
                                                  $("#inputminoramount").val(0);

                                                  var taMinor = parseInt($("#inputminoramount").val()) + parseInt($("#inputinfantamount").val()) + parseInt($("#inputstudentamount").val()) + parseInt($("#inputsenioramount").val());



                                                  $("#spanTotalAmount").text("P "+taMinor.toFixed(2));
                                                  $("#totalamount").val(taMinor.toFixed(2));

                                                }else{
                                                  if(e.value > 15){
                                                    $("#adult").val(15);
                                                  }
                                                  $("#minoramount").fadeIn();
                                                  var s = parseFloat(e.value * adultmoney);
                                                  $("#minoramount").text("P "+s.toFixed(2));
                                                  $("#inputminoramount").val(s.toFixed(2));

                                                  var taMinor = parseInt($("#inputminoramount").val()) + parseInt($("#inputinfantamount").val()) + parseInt($("#inputstudentamount").val()) + parseInt($("#inputsenioramount").val());



                                                  $("#spanTotalAmount").text("P "+taMinor.toFixed(2));
                                                  $("#totalamount").val(taMinor.toFixed(2));


                                                }
                                              }

                                              $("#buttonminorplus").click(function(){
                                                // alert("HAHA");
                                                var se = +$("#minor").val() + 1;
                                                

                                                if(se == 0){
                                                  $("#minoramount").fadeOut();
                                                  $("#inputminoramount").val(0);
                                                }else if($("#minor").val() == 15){
                                                  $("#minor").val(14);
                                                }
                                                else{
                                                  $("#minoramount").fadeIn();
                                                  var s = parseFloat(se * adultmoney);

                                                  $("#minoramount").text("P "+s.toFixed(2));
                                                  $("#inputminoramount").val(s.toFixed(2));

                                                  var taMinor = parseInt($("#inputminoramount").val()) + parseInt($("#inputinfantamount").val()) + parseInt($("#inputstudentamount").val()) + parseInt($("#inputsenioramount").val());



                                                  $("#spanTotalAmount").text("P "+taMinor.toFixed(2));
                                                  $("#totalamount").val(taMinor.toFixed(2));

                                              }
                                              });

                                              $("#buttonminorminus").click(function(){
                                                var se = +$("#adult").val() - 1;

                                                if(se == 0 || se == -1){
                                                  $("#minoramount").fadeOut();
                                                  $("#inputminoramount").val(0);

                                                  var taMinor = parseInt($("#inputminoramount").val()) + parseInt($("#inputinfantamount").val()) + parseInt($("#inputstudentamount").val()) + parseInt($("#inputsenioramount").val());

                                                  $("#spanTotalAmount").text("P "+taMinor.toFixed(2));
                                                  $("#totalamount").val(taMinor.toFixed(2));
                                                }else{
                                                  $("#minoramount").fadeIn();
                                                  var s = parseFloat(se * adultmoney);

                                                  $("#minoramount").text("P "+s.toFixed(2));
                                                  $("#inputminoramount").val(s.toFixed(2));

                                                  var taMinor = parseInt($("#inputminoramount").val()) + parseInt($("#inputinfantamount").val()) + parseInt($("#inputstudentamount").val()) + parseInt($("#inputsenioramount").val());



                                                  $("#spanTotalAmount").text("P "+taMinor.toFixed(2));
                                                  $("#totalamount").val(taMinor.toFixed(2));

                                              }
                                              });
                                          </script>

                                          <!-- <div class="col-md-5">
                                          <span id="adultamount" style="display:none;">
                                          
                                          </span>
                                          <input type="text" style="display:none;" id="inputadultamount" value="0">
                                          </div> -->

                                          <!-- divdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdiv -->

                                          <script>

                                          $("#buttonminorplus").mouseover(function(){
                                              $("#buttonminorplus").css("color", "blue");
                                            });
                                            $("#buttonminorplus").mouseout(function(){
                                              $("#buttonminorplus").css("color", "");
                                          });
                                          $("#buttonminorminus").mouseover(function(){
                                              $("#buttonminorminus").css("color", "red");
                                            });
                                            $("#buttonminorminus").mouseout(function(){
                                              $("#buttonminorminus").css("color", "");
                                          });

                                          $("#buttonminorplus").on("click", function() {
                                            
                                            var l = $("#minor").val();
                                              l++;
                                              $("#minor").val(l);
                                          });

                                          $("#buttonminorminus").on("click", function() {
                                            
                                            var l = $("#minor").val();
                                              

                                              if(l == 0){
                                              $("#minor").val("0");
                                              }else{
                                                l--;
                                              $("#minor").val(l); 
                                              }
                                          });

                                          </script>

                                         

                                          <br>
                                          <!-- <label for="infant">Infant:</label> -->
                                          <!-- <button type="button" class="btn btn-info btn-xs" data-toggle="modal" id="infantDetails" data-target="#myModalInfant" data-backdrop="static" data-keyboard="false">Add Infant Details here</button> -->
                                        </div>
                                      </div>

                                      <div class="row" id="regularTrans">
                                        <div class="form-group">
                                          <div class='incrementdecrementregular'>
                                          <label for="adult">Regular:</label>
                                          <br>
                                          <div class="col-md-5">
                                          <input class="form-control ship" oninput="passengersRegular(this)" name="regularrange" onkeypress="return isNumber(event)" id="regular" value="0">
                                          </div>

                                          <div class="col-md-2"><div class="inc"><span id="buttonregularplus" style="cursor:pointer" class="glyphicon glyphicon-plus-sign"></span></div><div class="dec buttonregular" ><span id="buttonregularminus" style="cursor:pointer" class="glyphicon glyphicon-minus-sign"></span></div></div>
                                          </div>

                                          <!-- divdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdiv -->

                                          <script>
                                          var adultmoney = 1500;
                                              function passengersRegular(e){

                                                if(e.value == 0){
                                                  $("#regularamount").fadeOut();
                                                  $("#inputregularamount").val(0);

                                                  var taAdult = parseInt($("#inputregularamount").val()) + parseInt($("#inputinfantamount").val()) + parseInt($("#inputstudentamount").val()) + parseInt($("#inputsenioramount").val());



                                                  $("#spanTotalAmount").text("P "+taAdult.toFixed(2));
                                                  $("#totalamount").val(taAdult.toFixed(2));

                                                }else{
                                                  if(e.value > 15){
                                                    $("#adult").val(15);
                                                  }
                                                  $("#regularamount").fadeIn();
                                                  var s = parseFloat(e.value * adultmoney);
                                                  $("#regularamount").text("P "+s.toFixed(2));
                                                  $("#inputregularamount").val(s.toFixed(2));

                                                  var taAdult = parseInt($("#inputregularamount").val()) + parseInt($("#inputinfantamount").val()) + parseInt($("#inputstudentamount").val()) + parseInt($("#inputsenioramount").val());



                                                  $("#spanTotalAmount").text("P "+taAdult.toFixed(2));
                                                  $("#totalamount").val(taAdult.toFixed(2));


                                                }
                                              }

                                              $("#buttonregularplus").click(function(){
                                                // alert("HAHA");
                                                var se = +$("#regular").val() + 1;
                                                

                                                if(se == 0){
                                                  $("#regularamount").fadeOut();
                                                  $("#inputregularamount").val(0);
                                                }else if($("#regular").val() == 15){
                                                  $("#regular").val(14);
                                                }
                                                else{
                                                  $("#regularamount").fadeIn();
                                                  var s = parseFloat(se * adultmoney);

                                                  $("#regularamount").text("P "+s.toFixed(2));
                                                  $("#inputregularamount").val(s.toFixed(2));

                                                  var taAdult = parseInt($("#inputregularamount").val()) + parseInt($("#inputinfantamount").val()) + parseInt($("#inputstudentamount").val()) + parseInt($("#inputsenioramount").val());



                                                  $("#spanTotalAmount").text("P "+taAdult.toFixed(2));
                                                  $("#totalamount").val(taAdult.toFixed(2));

                                              }
                                              });

                                              $("#buttonregularminus").click(function(){
                                                var se = +$("#adult").val() - 1;

                                                if(se == 0 || se == -1){
                                                  $("#regularamount").fadeOut();
                                                  $("#inputregularamount").val(0);

                                                  var taAdult = parseInt($("#inputregularamount").val()) + parseInt($("#inputinfantamount").val()) + parseInt($("#inputstudentamount").val()) + parseInt($("#inputsenioramount").val());

                                                  $("#spanTotalAmount").text("P "+taAdult.toFixed(2));
                                                  $("#totalamount").val(taAdult.toFixed(2));
                                                }else{
                                                  $("#regularamount").fadeIn();
                                                  var s = parseFloat(se * adultmoney);

                                                  $("#regularamount").text("P "+s.toFixed(2));
                                                  $("#inputregularamount").val(s.toFixed(2));

                                                  var taAdult = parseInt($("#inputregularamount").val()) + parseInt($("#inputinfantamount").val()) + parseInt($("#inputstudentamount").val()) + parseInt($("#inputsenioramount").val());



                                                  $("#spanTotalAmount").text("P "+taAdult.toFixed(2));
                                                  $("#totalamount").val(taAdult.toFixed(2));

                                              }
                                              });
                                          </script>

                                          <!-- <div class="col-md-5">
                                          <span id="adultamount" style="display:none;">
                                          
                                          </span>
                                          <input type="text" style="display:none;" id="inputadultamount" value="0">
                                          </div> -->

                                          <!-- divdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdiv -->

                                          <script>

                                          $("#buttonregularplus").mouseover(function(){
                                              $("#buttonregularplus").css("color", "blue");
                                            });
                                            $("#buttonregularplus").mouseout(function(){
                                              $("#buttonregularplus").css("color", "");
                                          });
                                          $("#buttonregularminus").mouseover(function(){
                                              $("#buttonregularminus").css("color", "red");
                                            });
                                            $("#buttonregularminus").mouseout(function(){
                                              $("#buttonregularminus").css("color", "");
                                          });

                                          $("#buttonregularplus").on("click", function() {
                                            
                                            var l = $("#regular").val();
                                              l++;
                                              $("#regular").val(l);
                                          });

                                          $("#buttonregularminus").on("click", function() {
                                            
                                            var l = $("#regular").val();
                                              

                                              if(l == 0){
                                              $("#regular").val("0");
                                              }else{
                                                l--;
                                              $("#regular").val(l); 
                                              }
                                          });

                                          </script>

                                         

                                          <br>
                                          <!-- <label for="infant">Infant:</label> -->
                                          <!-- <button type="button" class="btn btn-info btn-xs" data-toggle="modal" id="infantDetails" data-target="#myModalInfant" data-backdrop="static" data-keyboard="false">Add Infant Details here</button> -->
                                        </div>
                                      </div>

                                      <div class="row" id="adultFast">
                                        <div class="form-group">
                                          <div class='incrementdecrementadult'>
                                          <label for="adult">Adult:</label>
                                          <br>
                                          <div class="col-md-5">
                                          <input class="form-control ship" oninput="passengersAdult(this)" name="adultrange" onkeypress="return isNumber(event)" id="adult" value="0">
                                          </div>

                                          <div class="col-md-2"><div class="inc"><span id="buttonadultplus" style="cursor:pointer" class="glyphicon glyphicon-plus-sign"></span></div><div class="dec buttonadult" ><span id="buttonadultminus" style="cursor:pointer" class="glyphicon glyphicon-minus-sign"></span></div></div>
                                          </div>

                                          <!-- divdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdiv -->

                                          <script>
                                          var adultmoney = 1500;
                                              function passengersAdult(e){

                                                if(e.value == 0){
                                                  $("#adultamount").fadeOut();
                                                  $("#inputadultamount").val(0);

                                                  var taAdult = parseInt($("#inputadultamount").val()) + parseInt($("#inputinfantamount").val()) + parseInt($("#inputstudentamount").val()) + parseInt($("#inputsenioramount").val());



                                                  $("#spanTotalAmount").text("P "+taAdult.toFixed(2));
                                                  $("#totalamount").val(taAdult.toFixed(2));

                                                }else{
                                                  if(e.value > 15){
                                                    $("#adult").val(15);
                                                  }
                                                  $("#adultamount").fadeIn();
                                                  var s = parseFloat(e.value * adultmoney);
                                                  $("#adultamount").text("P "+s.toFixed(2));
                                                  $("#inputadultamount").val(s.toFixed(2));

                                                  var taAdult = parseInt($("#inputadultamount").val()) + parseInt($("#inputinfantamount").val()) + parseInt($("#inputstudentamount").val()) + parseInt($("#inputsenioramount").val());



                                                  $("#spanTotalAmount").text("P "+taAdult.toFixed(2));
                                                  $("#totalamount").val(taAdult.toFixed(2));


                                                }
                                              }

                                              $("#buttonadultplus").click(function(){
                                                var se = +$("#adult").val() + 1;
                                                

                                                if(se == 0){
                                                  $("#adultamount").fadeOut();
                                                  $("#inputadultamount").val(0);
                                                }else if($("#adult").val() == 15){
                                                  $("#adult").val(14);
                                                }
                                                else{
                                                  $("#adultamount").fadeIn();
                                                  var s = parseFloat(se * adultmoney);

                                                  $("#adultamount").text("P "+s.toFixed(2));
                                                  $("#inputadultamount").val(s.toFixed(2));

                                                  var taAdult = parseInt($("#inputadultamount").val()) + parseInt($("#inputinfantamount").val()) + parseInt($("#inputstudentamount").val()) + parseInt($("#inputsenioramount").val());



                                                  $("#spanTotalAmount").text("P "+taAdult.toFixed(2));
                                                  $("#totalamount").val(taAdult.toFixed(2));

                                              }
                                              });

                                              $("#buttonadultminus").click(function(){
                                                var se = +$("#adult").val() - 1;

                                                if(se == 0 || se == -1){
                                                  $("#adultamount").fadeOut();
                                                  $("#inputadultamount").val(0);

                                                  var taAdult = parseInt($("#inputadultamount").val()) + parseInt($("#inputinfantamount").val()) + parseInt($("#inputstudentamount").val()) + parseInt($("#inputsenioramount").val());

                                                  $("#spanTotalAmount").text("P "+taAdult.toFixed(2));
                                                  $("#totalamount").val(taAdult.toFixed(2));
                                                }else{
                                                  $("#adultamount").fadeIn();
                                                  var s = parseFloat(se * adultmoney);

                                                  $("#adultamount").text("P "+s.toFixed(2));
                                                  $("#inputadultamount").val(s.toFixed(2));

                                                  var taAdult = parseInt($("#inputadultamount").val()) + parseInt($("#inputinfantamount").val()) + parseInt($("#inputstudentamount").val()) + parseInt($("#inputsenioramount").val());



                                                  $("#spanTotalAmount").text("P "+taAdult.toFixed(2));
                                                  $("#totalamount").val(taAdult.toFixed(2));

                                              }
                                              });
                                          </script>

                                          <!-- <div class="col-md-5">
                                          <span id="adultamount" style="display:none;">
                                          
                                          </span>
                                          <input type="text" style="display:none;" id="inputadultamount" value="0">
                                          </div> -->

                                          <!-- divdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdiv -->

                                          <script>

                                          $("#buttonadultplus").mouseover(function(){
                                              $("#buttonadultplus").css("color", "blue");
                                            });
                                            $("#buttonadultplus").mouseout(function(){
                                              $("#buttonadultplus").css("color", "");
                                          });
                                          $("#buttonadultminus").mouseover(function(){
                                              $("#buttonadultminus").css("color", "red");
                                            });
                                            $("#buttonadultminus").mouseout(function(){
                                              $("#buttonadultminus").css("color", "");
                                          });

                                          $("#buttonadultplus").on("click", function() {
                                            
                                            var l = $("#adult").val();
                                              l++;
                                              $("#adult").val(l);
                                          });

                                          $("#buttonadultminus").on("click", function() {
                                            
                                            var l = $("#adult").val();
                                              

                                              if(l == 0){
                                              $("#adult").val("0");
                                              }else{
                                                l--;
                                              $("#adult").val(l); 
                                              }
                                          });

                                          </script>

                                         

                                          <br>
                                          <!-- <label for="infant">Infant:</label> -->
                                          <!-- <button type="button" class="btn btn-info btn-xs" data-toggle="modal" id="infantDetails" data-target="#myModalInfant" data-backdrop="static" data-keyboard="false">Add Infant Details here</button> -->
                                        </div>
                                      </div>




                                      <div class="row">
                                        <div class="form-group">

                                          <div class='incrementdecrementinfant'>
                                          <label for="infant">Children:</label>
                                          <br>
                                          <div class="col-md-5">
                                          <input class="form-control ship" oninput="passengersInfant(this)" name="infantrange" onkeypress="return isNumber(event)" id="infant" value="0">
                                          </div>

                                          <div class="col-md-2"><div class="inc"><span id="buttoninfantplus" style="cursor:pointer" class="glyphicon glyphicon-plus-sign"></span></div><div class="dec buttoninfant" ><span id="buttoninfantminus" style="cursor:pointer" class="glyphicon glyphicon-minus-sign"></span></div></div>
                                          </div>

                                          <!-- divdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdiv -->

                                          <script>
                                          var infantmoney = 1200;
                                              function passengersInfant(e){

                                                if(e.value == 0){
                                                  $("#infantamount").fadeOut();
                                                  $("#inputinfantamount").val(0);

                                                  var taInfant = parseInt($("#inputadultamount").val()) + parseInt($("#inputinfantamount").val()) + parseInt($("#inputstudentamount").val()) + parseInt($("#inputsenioramount").val());


                                                  
                                                  $("#spanTotalAmount").text("P "+taInfant.toFixed(2));
                                                  $("#totalamount").val(taInfant.toFixed(2));
                                                }else{
                                                  if(e.value > 15){
                                                    $("#infant").val(15);
                                                  }
                                                  $("#infantamount").fadeIn();

                                                  var s = parseFloat(e.value * infantmoney);
                                                  $("#infantamount").text("P "+s.toFixed(2));
                                                  $("#inputinfantamount").val(s.toFixed(2));

                                                  var taInfant = parseInt($("#inputadultamount").val()) + parseInt($("#inputinfantamount").val()) + parseInt($("#inputstudentamount").val()) + parseInt($("#inputsenioramount").val());


                                                  
                                                  $("#spanTotalAmount").text("P "+taInfant.toFixed(2));
                                                  $("#totalamount").val(taInfant.toFixed(2));
                                                }
                                              }

                                              $("#buttoninfantplus").click(function(){
                                                var se = +$("#infant").val() + 1;
                                                

                                                if(se == 0){
                                                  $("#infantamount").fadeOut();
                                                  $("#inputinfantamount").val(0);
                                                }else if($("#infant").val() == 15){
                                                  $("#infant").val(14);
                                                }
                                                else{
                                                  $("#infantamount").fadeIn();
                                                  var s = parseFloat(se * infantmoney);

                                                  $("#infantamount").text("P "+s.toFixed(2));
                                                  $("#inputinfantamount").val(s.toFixed(2));

                                                  var taInfant = parseInt($("#inputadultamount").val()) + parseInt($("#inputinfantamount").val()) + parseInt($("#inputstudentamount").val()) + parseInt($("#inputsenioramount").val());


                                                  
                                                  $("#spanTotalAmount").text("P "+taInfant.toFixed(2));
                                                  $("#totalamount").val(taInfant.toFixed(2));

                                              }
                                              });

                                              $("#buttoninfantminus").click(function(){
                                                var se = +$("#infant").val() - 1;

                                                if(se == 0 || se == -1){
                                                  $("#infantamount").fadeOut();
                                                  $("#inputinfantamount").val(0);

                                                  var taInfant = parseInt($("#inputadultamount").val()) + parseInt($("#inputinfantamount").val()) + parseInt($("#inputstudentamount").val()) + parseInt($("#inputsenioramount").val());


                                                  
                                                  $("#spanTotalAmount").text("P "+taInfant.toFixed(2));
                                                  $("#totalamount").val(taInfant.toFixed(2));
                                                }else{
                                                  $("#infantamount").fadeIn();
                                                  var s = parseFloat(se * infantmoney);

                                                  $("#infantamount").text("P "+s.toFixed(2));
                                                  $("#inputinfantamount").val(s.toFixed(2));

                                                  var taInfant = parseInt($("#inputadultamount").val()) + parseInt($("#inputinfantamount").val()) + parseInt($("#inputstudentamount").val()) + parseInt($("#inputsenioramount").val());


                                                  
                                                  $("#spanTotalAmount").text("P "+taInfant.toFixed(2));
                                                  $("#totalamount").val(taInfant.toFixed(2));

                                              }
                                              });
                                          </script>

                                          <!-- <div class="col-md-5">
                                          <span id="infantamount" style="display:none;">
                                          
                                          </span>
                                          <input type="text" style="display:none;" id="inputinfantamount" value="0">
                                          </div> -->

                                          <!-- divdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdiv -->

                                          <script>
                                         

                                          $("#buttoninfantplus").mouseover(function(){
                                              $("#buttoninfantplus").css("color", "blue");
                                            });
                                            $("#buttoninfantplus").mouseout(function(){
                                              $("#buttoninfantplus").css("color", "");
                                          });

                                          $("#buttoninfantminus").mouseover(function(){
                                              $("#buttoninfantminus").css("color", "red");
                                            });
                                            $("#buttoninfantminus").mouseout(function(){
                                              $("#buttoninfantminus").css("color", "");
                                          });

                                          $("#buttoninfantplus").click(function() {
                                            
                                            var m = $("#infant").val();
                                              m++;
                                              $("#infant").val(m);
                                          });

                                          $("#buttoninfantminus").on("click", function() {
                                            
                                            var m = $("#infant").val();
                                              

                                              if(m == 0){
                                              $("#infant").val("0");
                                              }else{
                                                m--;
                                              $("#infant").val(m); 
                                              }
                                          });

                                          </script>


                                          

                                          <br>
                                          <!-- <label for="senior">Student:</label> -->
                                          <!-- <button type="button" class="btn btn-info btn-xs" data-toggle="modal" id="studentDetails" data-target="#myModalStudent" data-backdrop="static" data-keyboard="false">Add Student Details here</button> -->
                                        </div>
                                      </div>



                                      <div class="row">
                                        <div class="form-group">
                                          

                                          <div class='incrementdecrementstudent'>
                                          <label for="student">Student:</label>
                                          <br>
                                          <div class="col-md-5">
                                          <input class="form-control ship" oninput="passengersStudent(this)" name="studentrange" onkeypress="return isNumber(event)" id="student" value="0">
                                          </div>

                                          <div class="col-md-2"><div class="inc"><span id="buttonstudentplus" style="cursor:pointer" class="glyphicon glyphicon-plus-sign"></span></div><div class="dec buttonstudent" ><span id="buttonstudentminus" style="cursor:pointer" class="glyphicon glyphicon-minus-sign"></span></div></div>

                                          <!-- divdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdiv -->

                                          <script>
                                          var studentmoney = 1000;
                                              function passengersStudent(e){

                                                if(e.value == 0){
                                                  $("#studentamount").fadeOut();
                                                  $("#inputstudentamount").val(0);

                                                  var taStudent = parseInt($("#inputadultamount").val()) + parseInt($("#inputinfantamount").val()) + parseInt($("#inputstudentamount").val()) + parseInt($("#inputsenioramount").val());


                                                  
                                                  $("#spanTotalAmount").text("P "+taStudent.toFixed(2));
                                                  $("#totalamount").val(taStudent.toFixed(2));
                                                }else{
                                                  if(e.value > 15){
                                                    $("#student").val(15);
                                                  }
                                                  $("#studentamount").fadeIn();

                                                  var s = parseFloat(e.value * studentmoney);
                                                  $("#studentamount").text("P "+s.toFixed(2));
                                                  $("#inputstudentamount").val(s.toFixed(2));

                                                  var taStudent = parseInt($("#inputadultamount").val()) + parseInt($("#inputinfantamount").val()) + parseInt($("#inputstudentamount").val()) + parseInt($("#inputsenioramount").val());


                                                  
                                                  $("#spanTotalAmount").text("P "+taStudent.toFixed(2));
                                                  $("#totalamount").val(taStudent.toFixed(2));
                                                }
                                              }

                                              $("#buttonstudentplus").click(function(){
                                                var se = +$("#student").val() + 1;
                                                

                                                if(se == 0){
                                                  $("#studentamount").fadeOut();
                                                  $("#inputstudentamount").val(0);
                                                }else if($("#student").val() == 15){
                                                  $("#student").val(14);
                                                }
                                                else{
                                                  $("#studentamount").fadeIn();
                                                  var s = parseFloat(se * studentmoney);

                                                  $("#studentamount").text("P "+s.toFixed(2));
                                                  $("#inputstudentamount").val(s.toFixed(2));

                                                  var taStudent = parseInt($("#inputadultamount").val()) + parseInt($("#inputinfantamount").val()) + parseInt($("#inputstudentamount").val()) + parseInt($("#inputsenioramount").val());


                                                  
                                                  $("#spanTotalAmount").text("P "+taStudent.toFixed(2));
                                                  $("#totalamount").val(taStudent.toFixed(2));

                                              }
                                              });

                                              $("#buttonstudentminus").click(function(){
                                                var se = +$("#student").val() - 1;

                                                if(se == 0 || se == -1){
                                                  $("#studentamount").fadeOut();
                                                  $("#inputstudentamount").val(0);

                                                  var taStudent = parseInt($("#inputadultamount").val()) + parseInt($("#inputinfantamount").val()) + parseInt($("#inputstudentamount").val()) + parseInt($("#inputsenioramount").val());


                                                  
                                                  $("#spanTotalAmount").text("P "+taStudent.toFixed(2));
                                                  $("#totalamount").val(taStudent.toFixed(2));
                                                }else{
                                                  $("#studentamount").fadeIn();
                                                  var s = parseFloat(se * studentmoney);

                                                  $("#studentamount").text("P "+s.toFixed(2));
                                                   $("#inputstudentamount").val(s.toFixed(2));

                                                   var taStudent = parseInt($("#inputadultamount").val()) + parseInt($("#inputinfantamount").val()) + parseInt($("#inputstudentamount").val()) + parseInt($("#inputsenioramount").val());


                                                  
                                                  $("#spanTotalAmount").text("P "+taStudent.toFixed(2));
                                                  $("#totalamount").val(taStudent.toFixed(2));
                                              }
                                              });
                                          </script>

                                          <!-- <div class="col-md-5">
                                          <span id="studentamount" style="display:none;">
                                          
                                          </span>
                                          <input type="text" style="display:none;" id="inputstudentamount" value="0">
                                          </div> -->

                                          <!-- divdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdiv -->

                                          </div>

                                          <script>
                                          

                                          $("#buttonstudentminus").mouseover(function(){
                                              $("#buttonstudentminus").css("color", "red");
                                            });
                                            $("#buttonstudentminus").mouseout(function(){
                                              $("#buttonstudentminus").css("color", "");
                                          });

                                          $("#buttonstudentplus").mouseover(function(){
                                              $("#buttonstudentplus").css("color", "blue");
                                            });
                                            $("#buttonstudentplus").mouseout(function(){
                                              $("#buttonstudentplus").css("color", "");
                                          });

                                          $("#buttonstudentplus").click(function() {
                                            
                                            var m = $("#student").val();
                                              m++;
                                              $("#student").val(m);
                                          });

                                          $("#buttonstudentminus").on("click", function() {
                                            
                                            var m = $("#student").val();
                                              

                                              if(m == 0){
                                              $("#student").val("0");
                                              }else{
                                                m--;
                                              $("#student").val(m); 
                                              }
                                          });

                                          </script>

                                          <!-- <button type="button" class="btn btn-info btn-xs" data-toggle="modal" id="seniorDetails" data-target="#myModalSenior" data-backdrop="static" data-keyboard="false">Add Senior Details here</button> -->
                                        </div>
                                      </div>


                                      <div class="row">
                                        <div class="form-group">
                                          

                                          <div class='incrementdecrementsenior'>
                                          <label for="senior">Senior:</label>
                                          <br>
                                          <div class="col-md-5">
                                          <input class="form-control ship" oninput="passengersSenior(this)" name="seniorrange" id="senior" onkeypress="return isNumber(event)" value="0">
                                          </div>

                                         
                                          <input type="text" id="REMAININGTICKETS">
                                          

                                          <div class="col-md-2"><div class="inc"><span id="buttonseniorplus" style="cursor:pointer" class="glyphicon glyphicon-plus-sign"></span></div><div class="dec buttonsenior" ><span id="buttonseniorminus" style="cursor:pointer" class="glyphicon glyphicon-minus-sign"></span></div></div>

                                          <!-- divdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdiv -->

                                          <script>
                                          var seniormoney = 800;
                                              function passengersSenior(e){


                                                if(e.value == 0){
                                                  $("#senioramount").fadeOut();
                                                  $("#inputsenioramount").val(0);

                                                  var taSenior = parseInt($("#inputadultamount").val()) + parseInt($("#inputinfantamount").val()) + parseInt($("#inputstudentamount").val()) + parseInt($("#inputsenioramount").val());


                                                  
                                                  $("#spanTotalAmount").text("P "+taSenior.toFixed(2));
                                                  $("#totalamount").val(taSenior.toFixed(2));
                                                }else{
                                                  $("#senioramount").fadeIn();

                                                  if(e.value > 15){
                                                    $("#senior").val(15);
                                                  }

                                                  var s = parseFloat(e.value * seniormoney);
                                                  $("#senioramount").text("P "+s.toFixed(2));
                                                  $("#inputsenioramount").val(s.toFixed(2));

                                                  var taSenior = parseInt($("#inputadultamount").val()) + parseInt($("#inputinfantamount").val()) + parseInt($("#inputstudentamount").val()) + parseInt($("#inputsenioramount").val());


                                                  
                                                  $("#spanTotalAmount").text("P "+taSenior.toFixed(2));
                                                  $("#totalamount").val(taSenior.toFixed(2));
                                                }
                                              }

                                              $("#buttonseniorplus").click(function(){
                                                var se = +$("#senior").val() + 1;
                                                

                                                if(se == 0){
                                                  $("#senioramount").fadeOut();
                                                  $("#inputsenioramount").val(0);
                                                }else if($("#senior").val() == 15){
                                                  $("#senior").val(14);
                                                }
                                                else{
                                                  
                                                  $("#senioramount").fadeIn();
                                                  var s = parseFloat(se * seniormoney);

                                                  $("#senioramount").text("P "+s.toFixed(2));
                                                  $("#inputsenioramount").val(s.toFixed(2));

                                                  var taSenior = parseInt($("#inputadultamount").val()) + parseInt($("#inputinfantamount").val()) + parseInt($("#inputstudentamount").val()) + parseInt($("#inputsenioramount").val());


                                                  
                                                  $("#spanTotalAmount").text("P "+taSenior.toFixed(2));
                                                  $("#totalamount").val(taSenior.toFixed(2));

                                              }
                                              });

                                              $("#buttonseniorminus").click(function(){
                                                var se = +$("#senior").val() - 1;

                                                if(se == 0 || se == -1){
                                                  $("#senioramount").fadeOut();
                                                  $("#inputsenioramount").val(0);

                                                  var taSenior = parseInt($("#inputadultamount").val()) + parseInt($("#inputinfantamount").val()) + parseInt($("#inputstudentamount").val()) + parseInt($("#inputsenioramount").val());


                                                  
                                                  $("#spanTotalAmount").text("P "+taSenior.toFixed(2));
                                                  $("#totalamount").val(taSenior.toFixed(2));
                                                }else{

                                                  $("#senioramount").fadeIn();
                                                  var s = parseFloat(se * seniormoney);

                                                  $("#senioramount").text("P "+s.toFixed(2));
                                                  $("#inputsenioramount").val(s.toFixed(2));

                                                  var taSenior = parseInt($("#inputadultamount").val()) + parseInt($("#inputinfantamount").val()) + parseInt($("#inputstudentamount").val()) + parseInt($("#inputsenioramount").val());


                                                  
                                                  $("#spanTotalAmount").text("P "+taSenior.toFixed(2));
                                                  $("#totalamount").val(taSenior.toFixed(2));

                                              }
                                              });
                                          </script>

                                          <!-- <div class="col-md-5">
                                          <span id="senioramount" style="display:none;">
                                          
                                          </span>
                                          <input type="text" style="display:none;" id="inputsenioramount" value="0">
                                          </div> -->

                                          <!-- divdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdivdiv -->


                                          </div>

                                          <script>
                                         

                                          $("#buttonseniorplus").mouseover(function(){
                                              $("#buttonseniorplus").css("color", "blue");
                                            });
                                            $("#buttonseniorplus").mouseout(function(){
                                              $("#buttonseniorplus").css("color", "");
                                          });

                                          $("#buttonseniorminus").mouseover(function(){
                                              $("#buttonseniorminus").css("color", "red");
                                            });
                                            $("#buttonseniorminus").mouseout(function(){
                                              $("#buttonseniorminus").css("color", "");
                                          });



                                          $("#buttonseniorplus").click(function() {

                                            
                                            var m = $("#senior").val();
                                              m++;
                                              $("#senior").val(m);
                                          });

                                          $("#buttonseniorminus").on("click", function() {
                                            
                                            var m = $("#senior").val();
                                              

                                              if(m == 0){
                                              $("#senior").val("0");
                                              }else{
                                                m--;
                                              $("#senior").val(m); 
                                              }
                                          });

                                          </script>

                                          <!-- <button type="button" class="btn btn-info btn-xs" data-toggle="modal" id="seniorDetails" data-target="#myModalSenior" data-backdrop="static" data-keyboard="false">Add Senior Details here</button> -->
                                        </div>
                                      </div>

                                      <div class="row">
                                      <div class="col-md-12">
                                        <div class="row" style="display:none;">

                                          <div id="totalAmountSeat"  class="col-md-12">
                                          Base Class Fee(Each passenger): <b><br><span id="spanTotalAmountSeat">P 0.00</span></b>
                                          <input type="text" name="totalamountseat" id="totalamountseat" value="0">
                                          </div>

                                        </div>

                                        <!-- <div class="row">
                                          

                                          <div id="totalAmount" class="col-md-12">
                                          Base Fee: <b><span id="spanTotalAmount">P 0.00</span></b>
                                          <input type="hidden" name="totalamount" id="totalamount" value="0">
                                          </div>

                                        </div> -->
                                      </div>
                                      </div>


                                        <script>
                                        $('#confirm1').attr('data-dismiss', 'modal');
                                        $('#confirm2').attr('data-dismiss', 'modal');
                                        $('#confirm3').attr('data-dismiss', 'modal');
                                        $('#confirm4').attr('data-dismiss', 'modal');
                                        // function passengersSelect(e){
                                        //   if(e.id == "adult"){
                                        //     if(e.value != 0){
                                        //       document.getElementById("adultDetails").style.display="block";
                                        //         document.getElementById("confirm1").value= "Confirm";
                                        //         $('#confirm1').attr('data-dismiss', 'modalsd');



                                                

                                        //     }else{
                                        //         document.getElementById("confirm1").value= "Close";
                                        //         $('#confirm1').attr('data-dismiss', 'modal');
                                        //     }
                                        //   }

                                        //   if(e.id == "infant"){
                                        //     if(e.value != 0){
                                        //       document.getElementById("infantDetails").style.display="block";

                                        //       document.getElementById("confirm2").value= "Confirm";
                                        //       $('#confirm2').attr('data-dismiss', 'modalsd');

                                              
                                        //     }else{
                                        //       document.getElementById("confirm2").value= "Close";
                                        //       $('#confirm2').attr('data-dismiss', 'modal');
                                        //     }
                                        //   }

                                        //   if(e.id == "student"){
                                        //     if(e.value != 0){
                                        //       document.getElementById("studentDetails").style.display="block";

                                        //       document.getElementById("confirm3").value= "Confirm";
                                        //       $('#confirm3').attr('data-dismiss', 'modalsd');

                                        //     }else{
                                        //       document.getElementById("confirm3").value= "Close";
                                        //       $('#confirm3').attr('data-dismiss', 'modal');
                                        //     }
                                        //   }

                                        //   if(e.id == "senior"){
                                        //     if(e.value != 0){
                                        //       document.getElementById("seniorDetails").style.display="block";

                                        //       document.getElementById("confirm4").value= "Confirm";
                                        //       $('#confirm4').attr('data-dismiss', 'modalsd');
                                        //     }else{
                                        //       document.getElementById("confirm4").value= "Close";
                                        //       $('#confirm4').attr('data-dismiss', 'modal');
                                        //     }
                                        //   }

                                          
                                        // }
                                        </script>
                                    </div>

                                    <div class="row">
                                      <hr>
                                    </div>

                                    <!-- <div class="row">

                                      <div id="totalAmountSeat" class="col-md-12">
                                      Seat Class Fee: <b><span id="spanTotalAmountSeat">P 0.00</span></b>
                                      <input type="hidden" name="totalamountseat" id="totalamountseat" value="0">
                                      </div>

                                    </div>

                                    <div class="row">
                                      

                                      <div id="totalAmount" class="col-md-12">
                                      Pass Total Fee: <b><span id="spanTotalAmount">P 0.00</span></b>
                                      <input type="hidden" name="totalamount" id="totalamount" value="0">
                                      </div>

                                    </div> -->

                                    <div class="row">

                                      <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="firstForm">
                                        Proceed
                                      </button>
                                      </div>
                                     <!--  <div class="col-md-12 col-sm-12 col-lg-6 col-xs-12">
                                      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#checkTrack">Check Tracking number</button>
                                      </div> -->

                                    </div>

                                  </div>

                                  </div>
                                </div>

                                
                                
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <div>
                              <div class="form-group">

                                

                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Shipping</h5>
                                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button> -->

                                        
                                      </div>
                                      <div class="modal-body">
                                        <b>Are you sure you want to continue?</b>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="finishForm" data-dismiss="modal" data-toggle="modal" data-target="#exampleModal1">Confirm</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>



                                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true" data-keyboard="false" data-backdrop="static">
                                  <div class="modal-dialog modal-lg" role="document" id="modalTo">
                                    <div class="modal-content">
                                      <div class="modal-header">

                                      <div class="row">
                                      <div class="col-md-8">

                                        <h5 class="modal-title" id="exampleModalLabel1message">Passenger Details (<span style="color:red;" class="required">*</span> Required field)</h5>
                                      
                                      </div> 

                                      
                                      </div>
                                        
                                      </div>
                                      <div class="modal-body">


                                        <div id="adultMod">


                                        
                                        
                                        </div>

                                        <div id="displayMessage" class="alert alert-info" style="display:none;">
                                          FastCat and Unified reserves the right to refuse boarding if passengers cannot present the boarding requirement upon request.
                                        </div>

                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" id="backButton" style="display:none;">Back</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeButton">Close</button>
                                        <button type="submit" class="btn btn-primary" id="secondForm" data-toggle="modal" data-target="#exampleModal2">Confirm</button>

                                        <button type="submit" class="btn btn-primary" id="finalForm" data-toggle="modal" data-target="#Terms" style="display:none;" data-target="#exampleModal3">Proceed</button>

                                        <script>
                                        $("#frmSearchShippingEngine").submit(function(e){
                                        e.preventDefault();

                                      


                                        $("#adultMod").fadeOut();
                                      

                                        $("#exampleModalLabel1message").fadeOut(function() {
                                            $("#modalTo").removeClass("modal-lg");
                                            $("#backButton").fadeIn();
                                            $("#closeButton").fadeOut();
                                            
                                            $("#finalForm").show();
                                            $("#secondForm").hide();
                                        });
                                        $("#displayMessage").fadeIn();





                                        // $("#finalForm").click(function(a){
                                        
                                        //   var formData = $("#frmSearchShippingEngine")[0];
                                        //   var form_data = new FormData(formData);

                                        //   $.ajax({
                                        //             type: 'POST',
                                        //             url: `/Shipping/Shipping_firststep`,
                                        //             data: form_data,
                                        //             processData: false,
                                        //             contentType: false,
                                        //             success: function (data) {
                                        //               var res = JSON.parse(data);
                                        //               console.log(res);
                                                      



                                        //             },
                                        //             error: function (data) {
                                        //               console.log(data)
                                        //             }
                                        //           });

 
                                        // });

                                      });


                                        $("#backButton").click(function(e){
                                        e.preventDefault();

                                        
                                        $("#adultMod").show();
                                        $("#modalTo").addClass("modal-lg");
                                        $("#displayMessage").hide();

                                        $("#exampleModalLabel1message").show(function() {
                                            
                                            $("#closeButton").show();
                                            $("#backButton").hide();
                                            $("#secondForm").show();
                                            $("#finalForm").hide();
                                        });
                                        

                                        });
                                        </script>

                                        
  
                                      </div>
                                    </div>
                                  </div>
                                </div>




                                <div class="modal fade" id="Terms" role="dialog" data-keyboard="false" data-backdrop="static">
                                  <div class="modal-dialog">
                                  
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                        <h4 class="modal-title">Terms and Conditions</h4>
                                      </div>
                                      <div class="modal-bodyTerms" style="height: 300px; overflow: auto">


                                      <div id="agreement" style="overflow-y: scroll;height: 300px;width: 100%;border: 1px solid #DDD;padding: 10px;">
                                      <div class="col-md-12">
                                        <div class="row">
                                        
                                          TEST
                                        
                                        </div>

                                        <div class="row">
                                        TEST
                                        </div>
                                      </div>
                                      </div>

                                      </div>

                                      <div class="modal-footer">

                                      <div class="col-md-12 text-center">
                                      <div class="row" id="rowTranspass">
                                        <div id="alertmessage" class="alert alert-danger">
                                          <strong id="messageTranspass"></strong><br>
                                          <span id="textTR">Transaction number:</span> <u><i><b><span id="messageTransno"></span></b></i></u>
                                          <br>
                                            <hr>
                                              

                                              <div class="panel panel-info">
                                                <div class="panel-body" id="showreceipt" style="height: 270px;overflow-y: scroll;">

                                                  

                                                </div>
                                              </div>
                                              <!-- efwefwqedr124534d5234d5234d5234d52345d234d53245d234 -->
                                            <hr>
                                          <!-- <b>• See Approved, Revoked, and Pending transactions <a target="_blank" href="<?php echo BASE_URL() ?>Shipping/shipping_ticket">here</a></b> -->
                                        </div>
                                      </div>
                                      </div>

                                      
                                      <div class="col-md-12 text-center">
                                      <div class="row">
                                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal" id="closeBtn" disabled>Back</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal" id="closeBtn" disabled>Back</button> -->

                                        <form class = "form-inline" role = "form">
                                           <div class = "form-group">
                                              <label class = "sr-only" for = "name">Transaction Password</label>
                                              <input type = "password" class = "form-control" name="transpassword" id = "transpassword" placeholder = "Enter Transaction Password">
                                           </div>
                                        </form>
                                      </div>

                                      </div>
                                      </div>

                                      <div class="modal-footer">
                                      <div class="col-md-6 text-left">
                                      <label class="checkbox-inline">
                                        <input type="checkbox" id="checkboxTerms" value="">I accept the <u>Terms and Conditions</u>
                                      </label>
                                      </div>
                                      <div class="col-md-6 text-right">
                                        <button type="button" class="btn btn-default" id="backTerms">Proceed</button>
                                        <button type="button" class="btn btn-default" id="proceedTerms" disabled>Proceed</button>
                                      </div>
                                      </div>
                                    </div>
                                    
                                  </div>
                                </div>

                                <script>

                                $("#rowTranspass").hide();
                                $("#backTerms").hide();


                                $("#alertmessage").stop();
                                $("#alertmessage").removeAttr("style"); 
                                

                                $('#checkboxTerms').change(function() {

                                if(this.checked) {
                                  $("#proceedTerms").prop('disabled', false);
                                }else{
                                  $("#proceedTerms").prop('disabled', true);
                                }

                                });

                                $('#proceedTerms').click(function() {

                                  if($("#transpassword").val() == ""){
                                    $("#rowTranspass").show();
                                    $("#messageTranspass").html("Transaction password is empty.");
                                  
                                    $("#textTR").hide();
                                    $("#messageTransno").hide();
                                    $("#alertmessage").stop();
                                    $("#alertmessage").removeAttr("style"); 
                                  }
                                  else{
                                    waitingDialog.show();
                                  $.ajax({
                                  url: `/Shipping/checkTransactionPassword`,
                                  type: "POST",
                                  data: {
                                    transactionPassword: $("#transpassword").val()
                                  },
                                  success: function (data) {
                                    waitingDialog.hide();
                                    var j = JSON.parse(data);
                                    console.log(j);

                                    if(j.pass.count == 0){
                                      $("#rowTranspass").show();
                                      $("#messageTranspass").html("Incorrect password, please try again.");
                                      $("#textTR").hide();
                                      $("#messageTransno").hide();
                                    }else{
                                      $("#rowTranspass").show();
                                      $('#alertmessage').removeClass('alert-danger');
                                      $('#alertmessage').addClass('alert-success');
                                      $("#messageTranspass").html(`Your account has been validated. Details will be sent to your email address. Wait for the approval of the Technical Team.`);
                                      $("#transpassword").hide();


                                      
                                      // $("#proceedTerms").fadeOut();
                                      // $("#backTerms").fadeIn();

                                      $('#Terms').modal({backdrop: 'static', keyboard: false});
                                      $("#transpassword").prop('disabled', true);

                                      $("#alertmessage").stop();
                                      $("#alertmessage").removeAttr("style"); 

                                      $("#backTerms").click(function(){ 
                                        waitingDialog.show();
                                        setTimeout(function() {
                                            location.reload();
                                        }, 2000);

                                      });
                                      waitingDialog.hide();
                                      // setTimeout(function() {
                                      //     location.reload();
                                      // }, 5000);



                                      
                                      

                                           var formData = $("#frmSearchShippingEngine")[0];
                                           var form_data = new FormData(formData);
                                           $.ajax({
                                                    type: 'POST',
                                                    url: `/Shipping/Shipping_firststep`,
                                                    data: form_data,
                                                    processData: false,
                                                    contentType: false,
                                                    success: function (data) {
                                                      var res = JSON.parse(data);
                                                      console.log(res);

                                                      var x = "<div class='col-md-12'><hr>";

                                                      for(var y = 0; y<res.summary.length; y++){
                                                        x = x + `
                                                <div class="row">
                                                  <div align="left" class="col-md-6">
                                                  • Name
                                                  </div>

                                                  <div class="col-md-6" id="name">
                                                  ${res.summary[y].fname}
                                                  </div>
                                                </div>

                                                <div class="row">
                                                  <div align="left" class="col-md-6">
                                                  Standard Passenger
                                                  </div>

                                                  <div class="col-md-6" id="standardpassenger">
                                                    P ${res.summary[y].basefeein}
                                                  </div>
                                                </div>

                                                <div class="row">
                                                  <div align="left" class="col-md-6">
                                                  System fee
                                                  </div>

                                                  <div class="col-md-6" id="systemfee">
                                                  P ${res.summary[y].additionalin}
                                                  </div>
                                                </div>

                                                <div class="row">
                                                  <div align="left" class="col-md-6">
                                                  Total Amount
                                                  </div>

                                                  <div class="col-md-6" id="totalamountdue">
                                                  P ${res.summary[y].totalamount}
                                                  </div>
                                                </div>

                                                <br><hr>`;
                                                      }

                                              //         x = x + `
                                              //   <div class="row">
                                              //       <div align="left" class="col-md-6">
                                                    
                                              //       </div>

                                              //       <div class="col-md-6" id="amountspace">
                                              //    -------------------
                                              //       </div>
                                              //   </div>

                                              //   <div class="row">
                                              //     <div align="left" class="col-md-6">
                                                  
                                              //     </div>

                                              //     <div class="col-md-6" id="amount">
                                              //       P ${res.totalamount}
                                              //     </div>
                                              //   </div>
                                              // </div>`;

                                                      $("#showreceipt").html(x);

                                                      $("#textTR").show();
                                                      
                                                      // $("#messageTranspass").append(res.TN);
                                                      $("#messageTransno").show();
                                                      $("#messageTransno").html(res.TN);

                                                      $("#rowTranspass").stop();
                                                      $("#messageTranspass").stop();
                                                      $('#alertmessage').stop();
                                                    },
                                                    error: function (data) {
                                                      console.log(data)
                                                    }
                                                });

                                    }

                                  },
                                  error: function (data) {
                                    console.log(data)
                                  }

                                });

                                }

                                });

                                </script>

                                <!-- <button type="button" class="btn btn-primary" id="finishForm">Confirm</button> -->
                              </div>
                            </div>
                          </div>
                        </div>

                    </div>
                  </div>

                  <div class="col-md-8" style="display: inline-block;
                    vertical-align: middle;
                    float: none;">
                    <div class="panel panel-default form-inline" style="height:700px;">
                      <div class="panel-body">
                      <div id="hides" style="display:none;">
                        <div class="row">

                        <center><span id="shipTitle"></span></center>

                        <hr>
                  
                          <div class="col-md-12">

                          <div class="panel panel-primary">

                            <div class="panel-body" style='overflow-y: scroll;height: 600px;max-height: 600px;min-height: 600px;'>
                            <div class="Rates" id="rates" >
                              <div class="form-group">
                        
                              </div>
                            </div>
                            </div>


                          </div>

                          </div>

                        <hr>

                          <div class="col-md-12">

                          <div style="display:none;" class="panel panel-primary">

                            <div class="panel-body" style='height: 350px;max-height: 350px;min-height: 350px;'>
                            <div >
                              <div class="form-group">
                              <b>Details</b>
                                <hr>

                              <div class="row">
                              <div class="col-md-12">

                              <div class="row">
                              <div class="col-md-6">
                              Shipping: </div> <div class="col-md-6"> <b><span id="shipxx"></span></b> </div>
                              </div>

                              <div class="row">
                              <div class="col-md-6">
                              Departure: </div> <div class="col-md-6"> <b><span id="departurexx"></span></b> </div>
                              </div>

                              <div class="row">
                              <div class="col-md-6">
                              Route: </div> <div class="col-md-6"> <b><span id="routexx"></span></b> </div>
                              </div>

                              <div class="row">
                              <div class="col-md-6">
                              Seat Class: </div> <div class="col-md-6"> <b><span id="seatxx"></span></b> </div>
                              </div>

                              <div class="row">
                              <div class="col-md-6">
                              Passengers: </div> <div class="col-md-6"></div>
                              </div>

                              <div class="row">
                              <div class="col-md-6">
                              &nbsp;Adults: </div> <b><div class="col-md-6" id="passAdults">0</div></b>
                              </div>
                              <div class="row">
                              <div class="col-md-6">
                              &nbsp;Infants: </div> <b><div class="col-md-6" id="passInfants">0</div></b>
                              </div>
                              <div class="row">
                              <div class="col-md-6">
                              &nbsp;Students: </div> <b><div class="col-md-6" id="passStudents">0</div></b>
                              </div>
                              <div class="row">
                              <div class="col-md-6">
                              &nbsp;Seniors: </div> <b><div class="col-md-6" id="passSeniors" style="text-decoration: underline;">0</div></b>
                              </div>

                              <div class="row">
                              <div class="col-md-6">
                              &nbsp;&nbsp;&nbsp;Total: </div> <b><div class="col-md-6" id="passTotal">0</div></b>
                              </div>


                              </div>
                              </div>

                              </div>
                            </div>
                            </div>


                          </div>

                          </div>

                      </div> 
                      </div>
                      </div>
                    </div>
                  </div>

                </div>

                </div> 
            </div>
          </div>
        </div> 





      </div>     


    <!-- </form>  -->
    </div>        
</div>





<script>

function isNumber(evt) {

    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

  document.getElementById("selRoute").disabled=true;
  document.getElementById("selRouteDeparture").disabled=true
  document.getElementById("selDeparture").disabled=true
  document.getElementById("selDepartureRoundTrip").disabled=true
  document.getElementById("selLocation").disabled=true;
  document.getElementById("selLocationDestination").disabled=true;
  document.getElementById("selSeat").disabled=true;
  document.getElementById("passengers").disabled=true;
  document.getElementById("minor").disabled=true;
  document.getElementById("regular").disabled=true;
  document.getElementById("adult").disabled=true;
  document.getElementById("infant").disabled=true;
  document.getElementById("student").disabled=true;
  document.getElementById("senior").disabled=true;

  document.getElementById("firstForm").disabled=true;

      $("#buttonminorplus").hide();
      $("#buttonminorminus").hide();

      $("#buttonregularplus").hide();
      $("#buttonregularminus").hide();

      $("#buttonadultplus").hide();
      $("#buttonadultminus").hide();

      $("#buttoninfantplus").hide();
      $("#buttoninfantminus").hide();

      $("#buttonstudentplus").hide();
      $("#buttonstudentminus").hide();

      $("#buttonseniorplus").hide();
      $("#buttonseniorminus").hide();

      $("#minorTrans").hide();
      $("#regularTrans").hide();
      $("#adultFast").hide();

  



$(document).ready(function(){

//UPDATE TABLE shippingratesTable SET DATE TO UPDATE
  $.ajax({
    url: "/Shipping/updateshippingratesTable",
    type: 'POST',
    success: function (data) {


        var jsondata = JSON.parse(data);
        console.log(jsondata);


    }
  });
//UPDATE TABLE shippingratesTable SET DATE TO UPDATE

  var shipping = $("#selShipping").val();
  var departure = $("#selDeparture").val();
  var route = $("#selRoute").val();

  $( `.ddd` ).datepicker({
                defaultDate: new Date(90,0,1), //set the default date to Jan 1st 1990
                changeMonth: true,
                changeYear: true,
                yearRange: '1930:2000', //set the range of years
                dateFormat: 'mm/dd/yy' //set the format of the date
              });
  

  // $.ajax({
  //           url: "/Shipping/shipping_home",
  //           type: 'POST',
  //           // data:form_data,
  //           processData: false,
  //           contentType: false,
            
  //           success: function (data) {
                

  //               var jsondata = JSON.parse(data);
  //               console.log(jsondata.shipData);
  //               console.log(jsondata.shipData[0].shipfrom);
  //               console.log(jsondata.shipData.length);
  //               var a = " ";
                
                  

  //               // $("#rates").html("<div>"+a+"</div>");
    
  //           }

  //         });



  // document.getElementById("selDeparture").disabled=true;
  // document.getElementById("selRoute").disabled=true;
  // document.getElementById("selSeat").disabled=true;
  // document.getElementById("adult").disabled=true;
  // document.getElementById("infant").disabled=true;
  // document.getElementById("student").disabled=true;
  // document.getElementById("senior").disabled=true;

  


  // $("#adult").change(function() {
  //   $("#passAdults").text($("#adult option:selected").val());

  //   var adultpaymentTotal = parseFloat($("#adult option:selected").val() * 1500);
  //   var infantpaymentTotal = parseFloat($("#infant option:selected").val() * 1800);
  //   var studentpaymentTotal = parseFloat($("#student option:selected").val() * 1000);
  //   var seniorpaymentTotal =  parseFloat($("#senior option:selected").val() * 500);

  //   var totalPayment = "₱ "+parseFloat(adultpaymentTotal + infantpaymentTotal + studentpaymentTotal + seniorpaymentTotal);

  //   $("#passTotal").text(totalPayment);


  // });
  // $("#infant").change(function() {
  //   $("#passInfants").text($("#infant option:selected").val());

  //   var adultpaymentTotal = parseFloat($("#adult option:selected").val() * 1500);
  //   var infantpaymentTotal = parseFloat($("#infant option:selected").val() * 1800);
  //   var studentpaymentTotal = parseFloat($("#student option:selected").val() * 1000);
  //   var seniorpaymentTotal =  parseFloat($("#senior option:selected").val() * 500);

  //   var totalPayment = "₱ "+parseFloat(adultpaymentTotal + infantpaymentTotal + studentpaymentTotal + seniorpaymentTotal);

  //   $("#passTotal").text(totalPayment);
  // });

  // $("#student").change(function() {
  //   $("#passStudents").text($("#student option:selected").val());

  //   var adultpaymentTotal = parseFloat($("#adult option:selected").val() * 1500);
  //   var infantpaymentTotal = parseFloat($("#infant option:selected").val() * 1800);
  //   var studentpaymentTotal = parseFloat($("#student option:selected").val() * 1000);
  //   var seniorpaymentTotal =  parseFloat($("#senior option:selected").val() * 500);

  //   var totalPayment = "₱ "+parseFloat(adultpaymentTotal + infantpaymentTotal + studentpaymentTotal + seniorpaymentTotal);

  //   $("#passTotal").text(totalPayment);
  // });

  // $("#senior").change(function() {
  //   $("#passSeniors").text($("#senior option:selected").val());

  //   var adultpaymentTotal = parseFloat($("#adult option:selected").val() * 1500);
  //   var infantpaymentTotal = parseFloat($("#infant option:selected").val() * 1800);
  //   var studentpaymentTotal = parseFloat($("#student option:selected").val() * 1000);
  //   var seniorpaymentTotal =  parseFloat($("#senior option:selected").val() * 500);

  //   var totalPayment = "₱ "+parseFloat(adultpaymentTotal + infantpaymentTotal + studentpaymentTotal + seniorpaymentTotal);

  //   $("#passTotal").text(totalPayment);
  // });

  

  // $("#selRoute").change(function() {
  //   var selRouteSelectedValue = $("#selRoute option:selected").val();
  //   var selRouteSelectedText = $("#selRoute option:selected").text();
  //   if(selRouteSelectedValue == 0){
  //   $('#routexx').text("");
  //   }else{
  //   $('#routexx').text(selRouteSelectedText);
  //   }
  // });

  // $("#selSeat").change(function() {
  //   var selSeatSelectedValue = $("#selSeat option:selected").val();
  //   var selSeatSelectedText = $("#selSeat option:selected").text();
  //   if(selSeatSelectedValue == 0){
  //   $('#seatxx').text("");
  //   }else{
  //   $('#seatxx').text(selSeatSelectedText);
  //   }
  // });



  



  $("#selShipping").change(function() {
    


    // $("#spanTotalAmountSeat").html("P 0.00");
    // $("#totalamountseat").val("0.00");

    $("#spanTotalAmount").html("P 0.00");
    $("#totalamount").val("0.00");

    $('#selSeat')
      .find('option')
      .remove()
      .end()
      .append('<option value="0">Please choose time..</option>')
      .val('0');

      $('#selLocationDestination')
      .find('option')
      .remove()
      .end()
      .append('<option value="0">Please choose location..</option>')
      .val('0');

      $('#selRoute')
      .find('option')
      .remove()
      .end()
      .append('<option value="0">Please choose time..</option>')
      .val('0');

      $('#selRouteDeparture')
      .find('option')
      .remove()
      .end()
      .append('<option value="0">Please choose time..</option>')
      .val('0');

      $('#selDeparture').val("");
      $('#selDepartureRoundTrip').val("");



    document.getElementById("firstForm").disabled=true;

    document.getElementById("selRoute").disabled=true;
    // $('#selRoute').prop('selectedIndex',0);
    $('#selSeat').prop('selectedIndex',0);

    
    var selShippingSelected = $("#selShipping option:selected").val();
    var selShippingSelectedText = $("#selShipping option:selected").text();

    $('#shipxx').text(selShippingSelectedText);

    

    // alert(selShippingSelected);

    $("#minor").val("0");
    $("#regular").val("0");
    $("#adult").val("0");
    $("#infant").val("0");
    $("#student").val("0");
    $("#senior").val("0");

    $("#adultamount").fadeOut();
    $("#infantamount").fadeOut();
    $("#studentamount").fadeOut();
    $("#senioramount").fadeOut();

    $("#passAdults").text("0");
    $("#passInfants").text("0");
    $("#passStudents").text("0");
    $("#passSeniors").text("0");

    // document.getElementById("selRoute").disabled=false;

    
    if(selShippingSelected == "0"){
      $("#hides").fadeOut();

      $("#adultamount").hide();
      $("#infantamount").hide();
      $("#studentamount").hide();
      $("#senioramount").hide();

      $("#selDeparture").css("pointer-events", "");
      
      $("#buttonminorplus").hide();
      $("#buttonminorminus").hide();

      $("#buttonregularplus").hide();
      $("#buttonregularminus").hide();

      $("#buttonadultplus").hide();
      $("#buttonadultminus").hide();

      $("#buttoninfantplus").hide();
      $("#buttoninfantminus").hide();

      $("#buttonstudentplus").hide();
      $("#buttonstudentminus").hide();

      $("#buttonseniorplus").hide();
      $("#buttonseniorminus").hide();

      $('#shipxx').text("");
      $('#routexx').text("");
      $('#seatxx').text("");
      $('#departurexx').text("");

      $("#selDeparture").datepicker( "option", "disabled", true );

      
      document.getElementById("selRoute").disabled=true;
      document.getElementById("selRouteDeparture").disabled=true;
      document.getElementById("selDeparture").disabled=true
      document.getElementById("selDepartureRoundTrip").disabled=true
      document.getElementById("selSeat").disabled=true;
      document.getElementById("selLocation").disabled=true;
      document.getElementById("selLocationDestination").disabled=true;
      document.getElementById("passengers").disabled=true;
      document.getElementById("regular").disabled=true;
      document.getElementById("adult").disabled=true;
      document.getElementById("infant").disabled=true;
      document.getElementById("student").disabled=true;
      document.getElementById("senior").disabled=true;

      document.getElementById("firstForm").disabled=true;


      

      
    }






    else{
      /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $.ajax({
    url: "/Shipping/shippingActivationFee",
    type: 'POST',
    data: {shipid : selShippingSelected},
    
    success: function (data) {


        var jsondata = JSON.parse(data);
        console.log(jsondata);

        if(jsondata.Activation == 0){
          deactivated();
        }else{
          
          activated();
        }
        

    }
    });

    function deactivated(){
      $('#ACTIVATION').modal('show');
    }

    function activated(){

      $("#hides").fadeIn();

      $("#selDeparture").datepicker( "option", "disabled", false );

      $("#selDeparture").datepicker({
        onSelect: function() { 
            var dateObject = $(this).datepicker('getDate'); 
        }
      });





      document.getElementById("firstForm").disabled=false;

     
      // $('#selRoute')
      // .find('option')
      // .remove()
      // .end()
      // .append('<option value="0">Please choose route..</option>')
      // .val('0');
      

      $('#selLocation')
      .find('option')
      .remove()
      .end()
      .append('<option value="0">Please choose location..</option>')
      .val('0');
      

      document.getElementById("selDeparture").disabled=false;
      document.getElementById("selRoute").disabled=false;
      document.getElementById("selRouteDeparture").disabled=false;
      document.getElementById("selDeparture").disabled=false
      document.getElementById("selDepartureRoundTrip").disabled=false
      document.getElementById("selLocation").disabled=false;
      document.getElementById("selLocationDestination").disabled=false;
      document.getElementById("selSeat").disabled=false;
      document.getElementById("passengers").disabled=false;
      document.getElementById("minor").disabled=false;
      document.getElementById("regular").disabled=false;
      document.getElementById("adult").disabled=false;
      document.getElementById("infant").disabled=false;
      document.getElementById("student").disabled=false;
      document.getElementById("senior").disabled=false;

      $("#buttonminorplus").show();
      $("#buttonminorminus").show();

      $("#buttonregularplus").show();
      $("#buttonregularminus").show();

      $("#buttonadultplus").show();
      $("#buttonadultminus").show();

      $("#buttoninfantplus").show();
      $("#buttoninfantminus").show();

      $("#buttonstudentplus").show();
      $("#buttonstudentminus").show();

      $("#buttonseniorplus").show();
      $("#buttonseniorminus").show();


      // document.getElementById("adultDetails").disabled=false;
      // document.getElementById("infantDetails").disabled=false;
      // document.getElementById("studentDetails").disabled=false;
      // document.getElementById("seniorDetails").disabled=false;

      var form = $('#frmSearchShippingEngine')[0];
      var form_data = new FormData(form);

      waitingDialog.show();
      $.ajax({
            url: "/Shipping/fetch_shipping_location",
            type: 'POST',
            data:form_data,
            processData: false,
            contentType: false,
            
            success: function (data) {
                

                var jsondata = JSON.parse(data);
                // console.log(jsondata);
                // console.log(jsondata.shipData[0].shipfrom);
                // console.log(jsondata.shipData.length);
                var a = " ";
                var s = " ";
                var available = " ";
                var unavailable = " ";
                var greenlegends = " ";
                var redlegends = " ";
                var hr = " ";

                $("#shipTitle").text(selShippingSelectedText+ " routes").css("color","red").css("font-size","20px");
                  a += "<div class='row'><b><div class='col-md-3'>FROM</div><div class='col-md-2'>TO</div><div class='col-md-4'><center>ETD - ETA</center></div><div class='col-md-3'>TICKETS REMAINING </div></b></div>";

             

              if(jsondata.seats.length == 0){
                $('#selSeat').prop('selectedIndex',0);
              }else{
                for(var s = 0; s < jsondata.seats.length; s++){

                  $("#selSeat").append('<option value=' + jsondata.seats[s].seatsid + '>' + jsondata.seats[s].seats +'</option>');
                  
                }
              }

              //DISPLAY AVAILABLE ROUTE OF FASTCAT
            if(jsondata.shipid == 1){
              // alert("THIS");

              $("#regularTrans").fadeOut();
              $("#minorTrans").fadeOut();
              $("#adultFast").fadeIn();

              //  for(var x = 0; x < jsondata.showfastcatinfo.length; x++){

              //   a += "<div class='row'><div class='col-md-3'><a href='#'><span class='glyphicon glyphicon-arrow-right'></span></a> "+jsondata.showfastcatinfo[x].shipfrom+"</div>"+"<div class='col-md-2'>"+jsondata.showfastcatinfo[x].shipto+"</div>"+"<div class='col-md-2'>"+jsondata.showfastcatinfo[x].shippingfromtime+"</div>"+"<div class='col-md-2'>"+jsondata.showfastcatinfo[x].shippingtotime+"</div>"+"<div class='col-md-3'>"+

              //  jsondata.showfastcatinfo[x].numbers


              //   +"</div></div>";
              // }

            // greenlegends = `
            // <div class="alert alert-success">
            //   <center><strong>Available routes today</strong> </center>
            // </div>`;

            // redlegends = `
            // <div class="alert alert-danger">
            //   <center><strong>Reserved booking time today</strong> </center>
            // </div>`;

            // hr = '<hr>';

              // if(jsondata.avail.length == 0){
              //   available += `<center><b>NO AVAILABLE ROUTES TODAY</center></b>`;
              // }else{
              // for(var availx = 0; availx < jsondata.avail.length; availx++){

              //   available += "<div class='row'><div style='color:green;'><div class='col-md-3'><a href='#'><span style='color:green' class='glyphicon glyphicon-ok'></span></a> "+jsondata.avail[availx].shipfrom+"</div>"+"<div class='col-md-2'>"+jsondata.avail[availx].shipto+"</div>"+"<div class='col-md-2'>"+jsondata.avail[availx].shippingfromtime+"</div>"+"<div class='col-md-2'>"+jsondata.avail[availx].shippingtotime+"</div>"+"<div class='col-md-3'>"+jsondata.avail[availx].traveltime+"</div></div></div>";
              // }
              // }

              // if(jsondata.unavail.length == 0){
              //   unavailable += `<center><b>NO RESERVED BOOKING TIME TODAY</center></b>`;
              // }else{
              // for(var unavailx = 0; unavailx < jsondata.unavail.length; unavailx++){

              //   unavailable += "<div class='row'><div style='color:red;'><div class='col-md-3'><a href='#'><span style='color:red' class='glyphicon glyphicon-remove'></span></a> "+jsondata.unavail[unavailx].shipfrom+"</div>"+"<div class='col-md-2'>"+jsondata.unavail[unavailx].shipto+"</div>"+"<div class='col-md-2'>"+jsondata.unavail[unavailx].shippingfromtime+"</div>"+"<div class='col-md-2'>"+jsondata.unavail[unavailx].shippingtotime+"</div>"+"<div class='col-md-3'>"+jsondata.unavail[unavailx].traveltime+"</div></div></div>";
              // }
              // }

            }else if(jsondata.shipid == 2){
              
              $("#regularTrans").fadeIn();
              $("#minorTrans").fadeIn();
              $("#adultFast").fadeOut();

              // for(var x = 0; x < jsondata.showtransasiainfo.length; x++){

              //   a += "<div class='row'><div class='col-md-3'><a href='#'><span class='glyphicon glyphicon-arrow-right'></span></a> "+jsondata.showtransasiainfo[x].shipfrom+"</div>"+"<div class='col-md-2'>"+jsondata.showtransasiainfo[x].shipto+"</div>"+"<div class='col-md-2'>"+jsondata.showtransasiainfo[x].shippingfromtime+"</div>"+"<div class='col-md-2'>"+jsondata.showtransasiainfo[x].shippingtotime+"</div>"+"<div class='col-md-3'>"+

              //  jsondata.showtransasiainfo[x].numbers


              //   +"</div></div>";
              // }
            }
            else{
              greenlegends = ``;

              redlegends = ``;

              hr = '';
            }
            //DISPLAY AVAILABLE ROUTE OF FASTCAT

            

              $("#rates").html("<div>"+a+hr+greenlegends+available+hr+redlegends+unavailable+"</div>");
                

              // if(jsondata.shipDataLocation.length == "0"){
              //   $("#rates").html("POWER");
              //   $("#shipTitle").text("ROUTE");
                
              // }else{

                  


                for(var w = 0; w < jsondata.shipData.length; w++){

                  $("#selLocation").append('<option value="' + jsondata.shipData[w].shipfrom + '">' + jsondata.shipData[w].shipfrom + '</option>');
                  
                }
     
              // }
                  

                waitingDialog.hide();
    
            }

          });


      }
      /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    }

      

    // else if(selShippingSelected == "1"){
    //   $("#hides").fadeIn();

    //   $("#rates").html("<div>fastCat</div>");
    //   document.getElementById("selDeparture").disabled=false;
    //   document.getElementById("selRoute").disabled=false;
    // }
    // else if(selShippingSelected == "2"){
    //   $("#hides").fadeIn();

    //   $("#rates").html("<div>TransAsia</div>");
    //   document.getElementById("selDeparture").disabled=false;
    //   document.getElementById("selRoute").disabled=false;
    // }
 
  })

});


</script>

<script>


$("#selLocation").change(function(){
  var loc = $("#selLocation option:selected").val();
  var form = $('#frmSearchShippingEngine')[0];
  var form_data = new FormData(form);

  // alert($("#selLocation option:selected").val());

  // $("#spanTotalAmountSeat").html("P 0.00");
  // $("#totalamountseat").val("0.00");

  $('#selSeat').prop('selectedIndex',0);

  waitingDialog.show();

  $('#selLocationDestination')
      .find('option')
      .remove()
      .end()
      .append('<option value="0">Please choose destination..</option>')
      .val('0');

  $('#selRoute')
      .find('option')
      .remove()
      .end()
      .append('<option value="0">Please choose time..</option>')
      .val('0');

  $.ajax({
    url: "/Shipping/fetch_shipping_destination",
    type: 'POST',
    data: form_data,
    processData: false,
    contentType: false,
    
    success: function (data) {
        // alert("HAHAHA");

        var jsondatat = JSON.parse(data);
        console.log(jsondatat);
        // console.log(jsondata.shipData[0].shipfrom);
        // console.log(jsondata.shipData.length);
        var y;

        for(y = 0; y < jsondatat.shipDataLocation.length; y++){

        $("#selLocationDestination").append('<option value="' + jsondatat.shipDataLocation[y].shipto + '">' + jsondatat.shipDataLocation[y].shipto +'</option>');
      
        }

        waitingDialog.hide();

    }
    });


});



$("#selLocationDestination").change(function(){
  var loc = $("#selLocation option:selected").val();
  var form = $('#frmSearchShippingEngine')[0];
  var form_data = new FormData(form);

  $("#right").html("("+$("#selLocation option:selected").val() + " - " + $("#selLocationDestination option:selected").val()+")");
  $("#left").html("("+$("#selLocationDestination option:selected").val() + " - " + $("#selLocation option:selected").val()+")");

  $('#selRoute')
      .find('option')
      .remove()
      .end()
      .append('<option value="0">Please choose time..</option>')
      .val('0');

  // alert($("#selLocationDestination option:selected").val());

  // $("#spanTotalAmountSeat").html("P 0.00");
  // $("#totalamountseat").val("0.00");

  $('#selSeat').prop('selectedIndex',0);

  waitingDialog.show();

  // $('#selLocationDestination')
  //     .find('option')
  //     .remove()
  //     .end()
  //     .append('<option value="0">Please choose route..</option>')
  //     .val('0');

  $.ajax({
    url: "/Shipping/fetch_shipping_traveltime",
    type: 'POST',
    data: form_data,
    processData: false,
    contentType: false,
    
    success: function (data) {
        // alert("HAHAHA");

        var jsondatat = JSON.parse(data);
        console.log(jsondatat);
        // console.log(jsondata.shipData[0].shipfrom);
        // console.log(jsondata.shipData.length);
        // var y;

        
        // alert(jsondatat.travelTime[0].traveltime);
        // $("#selRoute").val(jsondatat.travelTime[0].traveltime);

        var y;
        var yz;

        for(y = 0; y < jsondatat.getdeparturetime.length; y++){

        $("#selRoute").append('<option value="' + jsondatat.getdeparturetime[y].shipratesid + '">' + jsondatat.getdeparturetime[y].shippingfromtime +'</option>');
      
        }

        for(yz = 0; yz < jsondatat.getdestinationtime.length; yz++){

        $("#selRouteDeparture").append('<option value="' + jsondatat.getdestinationtime[yz].shipratesid + '">' + jsondatat.getdestinationtime[yz].shippingfromtime +'</option>');
      
        }
      
        

        waitingDialog.hide();

    }
    });


});
</script>

<script>

$("#firstForm").click(function(){


  //   if($("#selShipping option:selected").val() == 1){ //FASTCAT
  

  //  var numberofpassengers = parseInt($("#adult").val()) + parseInt($("#infant").val()) + parseInt($("#student").val()) + parseInt($("#senior").val());

  //         var formData = $("#frmSearchShippingEngine")[0];
  //        var form_data = new FormData(formData);
  //        form_data.append("numberofpassengers", numberofpassengers);

  //        $.ajax({
  //                 type: 'POST',
  //                 url: `/Shipping/checkRemainingTickets`,
  //                 data: form_data,
  //                 processData: false,
  //                 contentType: false,
  //                 success: function (data) {
  //                   var res = JSON.parse(data);
  //                   console.log(res.PABLO);

                    
  //                     $("#REMAININGTICKETS").val(res.PABLO);
                    
  //                   // alert("true");
  //                   // return true;


  //                 },
  //                 error: function (data) {
  //                   console.log(data)
  //                 }
  //             });
  // }

 

  $(".ddd").datepicker({
        onSelect: function() { 
            var dateObject = $(this).datepicker('getDate'); 
        }
  });

      $( ".ddd" ).datepicker();

  $("#firstForm").removeAttr("data-toggle");
  $("#firstForm").removeAttr("data-target");

  $("#adultMod").fadeIn();
  $("#displayMessage").fadeOut();


  var formLocation = $("#selLocation option:selected").val();
  var formLocationDestination = $("#selLocationDestination option:selected").val();
  var formShipping = $("#selShipping option:selected").val();
  var formDeparture = $("#selDeparture").val();
  var formDepartureRoundTrip = $("#selDepartureRoundTrip").val();

  
  var formRoute = $("#selRoute option:selected").val();
  var formRouteRoundTrip = $("#selRouteDeparture option:selected").val();


  var formSeat = $("#selSeat option:selected").val();

  var fund = parseFloat($("#myFund").val());
  var totalamount = parseFloat($("#totalamount").val());

  // alert(fund);

  // alert(fund);
  // alert(totalamount);

  var formRegular = $("#regular").val();
  var formMinor = $("#minor").val();
  var formAdult = $("#adult").val();
  var formInfant = $("#infant").val();
  var formStudent = $("#student").val();
  var formSenior = $("#senior").val();

  var l = loc();
  var ld = locdec();
  var d = dep();
  var r = rou();
  var s = sea();
  var p = pass();
  var np = numPass();
  var f = funds();

  var vI = validateInfant();

  var cd = checkDate();

  



  if($('input[type=radio][name=selRadio]:checked').val() == 2){ //RADIO BUTTON ROUND TRIP
  var drt = checkScheduleRoundTrip();
  var rt = checkTimeRoundTrip();
  }


  
  function loc(){
    if(formLocation == 0){
    return false;
    }
    return true;
  }

  function locdec(){
    if(formLocationDestination == 0){
    return false;
    }
    return true;
  }

  function dep(){
    if(formDeparture == ""){
    return false;
    }
    return true;
  }

  function checkScheduleRoundTrip(){
    if(formDepartureRoundTrip == ""){
    return false;
    }
    return true;
  }

  function checkTimeRoundTrip(){
    if(formRouteRoundTrip == 0){
    return false;
    }
    return true;
  }

  function rou(){
    if(formRoute == 0){
    return false;
    }
    return true;
  }

  function sea(){
    if(formSeat == 0){
    return false;
    }
    return true;
  }

  function pass(){
    if(formAdult == 0 && formInfant == 0 && formStudent == 0 && formSenior == 0 && formRegular == 0 && formMinor == 0){
    return false;
    }
    return true;
  }

  function validateInfant(){
    if(formAdult == 0 && formInfant != 0 && formStudent == 0 && formSenior == 0 && formRegular == 0 && formMinor == 0){
    return false;
    }
    return true;
  }

  function numPass(){
    var sum = parseInt(formAdult) + parseInt(formInfant) + parseInt(formStudent) + parseInt(formSenior);
    if(sum > 10){
    return false;
    }
    return true;
  }

  function funds(){
    if(totalamount > fund){
    return false;
    }
    return true;
  }

  function checkDate(){
    var d = new Date();

    var month = d.getMonth()+1;
    var day = d.getDate();

    var output = ((''+month).length<2 ? '0' : '') + month + '/' + ((''+day).length<2 ? '0' : '') + day + '/' + d.getFullYear();


    if(Date.parse(output) > Date.parse($("#selDeparture").val())){
    return false;
    }
    return true;
  }

  // function checkRemainingTickets(){

     
  // }




  if(rt == false){
    $("#wrong").fadeIn();
    $("#wrong").text("TICKET IS NOT ENOUGH.");
    $("#wrong").fadeOut(3000);
  }
  else if(d == false){
    $("#wrong").fadeIn();
    $("#wrong").text("Schedule field is empty.");
    $("#wrong").fadeOut(3000);
  }
  else if(l == false){
    $("#wrong").fadeIn();
    $("#wrong").text("Departure field is empty.");
    $("#wrong").fadeOut(3000);
  }
  else if(drt == false){
    $("#wrong").fadeIn();
    $("#wrong").text("Departure field (round trip) is empty.");
    $("#wrong").fadeOut(3000);
  }
  else if(ld == false){
    $("#wrong").fadeIn();
    $("#wrong").text("Destination field is empty.");
    $("#wrong").fadeOut(3000);
  }
  else if(r == false){
    $("#wrong").fadeIn();
    $("#wrong").text("Travel Time field is empty.");
    $("#wrong").fadeOut(3000);
  }
  else if(rt == false){
    $("#wrong").fadeIn();
    $("#wrong").text("Travel Time field (round trip) is empty.");
    $("#wrong").fadeOut(3000);
  }
  else if(cd == false){
    $("#wrong").fadeIn();
    $("#wrong").text("Date should not be past date.");
    $("#wrong").fadeOut(3000);
  }
  else if(s == false){
    $("#wrong").fadeIn();
    $("#wrong").text("Passenger Seat field is empty.");
    $("#wrong").fadeOut(3000);

  }
  else if(p == false){
    $("#wrong").fadeIn();
    $("#wrong").text("You should indicate a number of passengers.");
    $("#wrong").fadeOut(3000);


  }
  else if(vI == false){
    $("#wrong").fadeIn();
    $("#wrong").text("Children should with adult, student, or senior.");
    $("#wrong").fadeOut(3000);
  }
  else if(f == false){
    $("#wrong").fadeIn();
    $("#wrong").text("Insufficient fund.");
    $("#wrong").fadeOut(3000);
  }
  else if(np == false){
    $("#wrong").fadeIn();
    $("#wrong").text("Maximum of 10 Passengers");
    $("#wrong").fadeOut(3000);
  }
  else{


    //FOR CHECKING OF 10 PAX PER TIME

  // if($("#selShipping option:selected").val() == 1){ //FASTCAT

  //   var numberofpassengers = parseInt($("#adult").val()) + parseInt($("#infant").val()) + parseInt($("#student").val()) + parseInt($("#senior").val());


  //     var formData = $("#frmSearchShippingEngine")[0];
  //    var form_data = new FormData(formData);
  //    form_data.append("numberofpassengers", numberofpassengers);

  //    $.ajax({
  //             type: 'POST',
  //             url: `/Shipping/checkFastCatValidations`,
  //             data: form_data,
  //             processData: false,
  //             contentType: false,
  //             success: function (data) {
  //               var res = JSON.parse(data);
  //               console.log(res);
                


  //             },
  //             error: function (data) {
  //               console.log(data)
  //             }
  //         });

  //    // alert("haha");

  // }

  //FOR CHECKING OF 10 PAX PER TIME

    $("#firstForm").attr("data-toggle","modal");
    $("#firstForm").attr("data-target","#exampleModal");

    // alert(totalamount);
    // alert(fund);

    /////////////////////////////////////////////////////////////////////////////////////////////////

    // if($("#selShipping option:selected").val() == 1){
    //   var formData = $("#frmSearchShippingEngine")[0];
    //  var form_data = new FormData(formData);
    //  $.ajax({
    //           type: 'POST',
    //           url: `/Shipping/getFastCatComputation`,
    //           data: form_data,
    //           processData: false,
    //           contentType: false,
    //           success: function (data) {
    //             var res = JSON.parse(data);
    //             console.log(res);
                


    //           },
    //           error: function (data) {
    //             console.log(data)
    //           }
    //       });
    // }
    // else if($("#selShipping option:selected").val() == 2){
    //    var formData = $("#frmSearchShippingEngine")[0];
    //  var form_data = new FormData(formData);
    //  $.ajax({
    //           type: 'POST',
    //           url: `/Shipping/gettransAsiaComputation`,
    //           data: form_data,
    //           processData: false,
    //           contentType: false,
    //           success: function (data) {
    //             var res = JSON.parse(data);
    //             console.log(res);
                


    //           },
    //           error: function (data) {
    //             console.log(data)
    //           }
    //       });
    // }

    /////////////////////////////////////////////////////////////////////////////////////////////////
    

    
        
          var regular = $("#regular").val();
          var minor = $("#minor").val();
          var adult = $("#adult").val();
          var infant = $("#infant").val();
          var student = $("#student").val();
          var senior = $("#senior").val();
          // alert(adult);
          var a = `<div class="panel panel-info">
                                          <div class="panel-heading">Representative </div>
                                          <div class="panel-body">
                                          <div class="row">
                                              <div class="col-md-4">
                                              <div class="form-group">
                                              <label>First Name</label>
                                              <span style="color:red;" class="required">*</span> <input type="text" class="form-control" style="text-transform: capitalize;" id="customerfirstName" name="customerfirstName" placeholder="First Name" required>
                                              </div>
                                              </div>

                                              <div class="col-md-4">
                                              <div class="form-group">
                                              <label>Last Name</label>
                                              <span style="color:red;" class="required">*</span> <input type="text" class="form-control" style="text-transform: capitalize;" id="customerlastName" name="customerlastName" placeholder="Last Name" required>
                                              </div>
                                              </div>

                                              <div class="col-md-4">
                                              <div class="form-group">
                                              <label>Birthday</label>
                                              <span style="color:red;" class="required">*</span> <input type="date" id="customerbirthday" name="customerbirthday" class="form-control" placeholder="mm/dd/yyyy" required>
                                              </div>
                                              </div>
                                            </div>

                                            <div class="row">
                                              <div class="col-md-4">
                                              <div class="form-group">
                                              <label>Mobile Number</label>
                                              <span style="color:red;" class="required">*</span> <input type="text" class="form-control" id="customermobileNumber" name="customermobileNumber" placeholder="Mobile Number" required>
                                              </div>
                                              </div>

                                              <div class="col-md-4">
                                              <div class="form-group">
                                              <label>Email Address</label>
                                              <span style="color:red;" class="required">*</span> <input type="email" class="form-control" id="customeremailAddress" aria-describedby="emailHelp" name="customeremailAddress" placeholder="Email Address" required>
                                              </div>
                                              </div>

                                              
                                            </div>
                                          </div>
                                        </div>`;
          var x = "";

          var s = "";

          if($("#selShipping option:selected").val() == 1){
            for(x = 0; x < regular; x++){
            a = a + ` 

            <div class="alert alert-danger" id="dangerRegular0${x}" style="display:none;">
              <span id="dangerRegular${x}"></span>
            </div>


            <div class="panel panel-default">
              <div class="panel-heading">Regular ${x+1}</div>
              <div class="panel-body">
              <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>First Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control dd" style="text-transform: capitalize;" id="regularfirstName${x}" name="regular[${x}][firstname]" placeholder="First Name" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Last Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control dd" style="text-transform: capitalize;" id="regularlastName${x}" name="regular[${x}][lastname]" placeholder="Last Name" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Birthday</label>
                  <span style="color:red;" class="required">*</span> <input type="date" id="regularbirthday${x}" x="${x}" name="regular[${x}][birthday]" class="form-control bdd" placeholder="mm/dd/yyyy" required>
                  </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Mobile Number</label>
                  <input type="text" class="form-control dd" id="regularmobileNumber${x}" name="regular[${x}][mobile]" placeholder="Mobile Number" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Email Address</label>
                  <span style="color:red;" class="required">*</span> <input type="email" class="form-control dd" id="regularemailAddress${x}" aria-describedby="emailHelp" name="regular[${x}][email]" placeholder="Email Address" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Age</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control" id="regularAge${x}" name="regular[${x}][age]" placeholder="Age" readonly >
                  </div>
                  </div>
                </div>
              </div>
            </div>



              <br>`;

          }
          }
            else if($("#selShipping option:selected").val() == 2){
          if($("#selSeat option:selected").val() == 5){
            for(x = 0; x < regular; x++){
            a = a + ` 

            <div class="alert alert-danger" id="dangerRegular0${x}" style="display:none;">
              <span id="dangerRegular${x}"></span>
            </div>


            <div class="panel panel-default">
              <div class="panel-heading">Regular ${x+1}</div>
              <div class="panel-body">
              <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>First Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control dd" style="text-transform: capitalize;" id="regularfirstName${x}" name="regular[${x}][firstname]" placeholder="First Name" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Last Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control dd" style="text-transform: capitalize;" id="regularlastName${x}" name="regular[${x}][lastname]" placeholder="Last Name" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Birthday</label>
                  <span style="color:red;" class="required">*</span> <input type="date" id="regularbirthday${x}" x="${x}" name="regular[${x}][birthday]" class="form-control bdd" placeholder="mm/dd/yyyy" required>
                  </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Mobile Number</label>
                  <input type="text" class="form-control dd" id="regularmobileNumber${x}" name="regular[${x}][mobile]" placeholder="Mobile Number" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Email Address</label>
                  <span style="color:red;" class="required">*</span> <input type="email" class="form-control dd" id="regularemailAddress${x}" aria-describedby="emailHelp" name="regular[${x}][email]" placeholder="Email Address" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Age</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control" id="regularAge${x}" name="regular[${x}][age]" placeholder="Age" readonly>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Accommodation</label>
                  <select class="form-control ship" name="regular[${x}][accommodation]" id="regularAccommodation${x}">
                    <option value="Sitting">Sitting</option>
                    <option value="Lying">Lying</option>
                  </select>
                  </div>
                  </div>
                </div>
              </div>
            </div>



              <br>`;

          }

          }
          else{
          for(x = 0; x < regular; x++){
            a = a + ` 

            <div class="alert alert-danger" id="dangerRegular0${x}" style="display:none;">
              <span id="dangerRegular${x}"></span>
            </div>


            <div class="panel panel-default">
              <div class="panel-heading">Regular ${x+1}</div>
              <div class="panel-body">
              <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>First Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control dd" style="text-transform: capitalize;" id="regularfirstName${x}" name="regular[${x}][firstname]" placeholder="First Name" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Last Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control dd" style="text-transform: capitalize;" id="regularlastName${x}" name="regular[${x}][lastname]" placeholder="Last Name" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Birthday</label>
                  <span style="color:red;" class="required">*</span> <input type="date" id="regularbirthday${x}" x="${x}" name="regular[${x}][birthday]" class="form-control bdd" placeholder="mm/dd/yyyy" required>
                  </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Mobile Number</label>
                  <input type="text" class="form-control dd" id="regularmobileNumber${x}" name="regular[${x}][mobile]" placeholder="Mobile Number" >
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Email Address</label>
                  <span style="color:red;" class="required">*</span> <input type="email" class="form-control dd" id="regularemailAddress${x}" aria-describedby="emailHelp" name="regular[${x}][email]" placeholder="Email Address" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Age</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control" id="regularAge${x}" name="regular[${x}][age]" placeholder="Age" readonly>
                  </div>
                  </div>
                </div>
              </div>
            </div>



              <br>`;

          }

          }

        }

        

        $("#adultMod").html(`<div class="panel panel-default">
              <div class="panel-body">${a}<hr></div>
              </div>`);  
          
////////////////////////////////////////////////////////////////////////////////////////////
        if($("#selShipping option:selected").val() == 1){
          for(x = 0; x < minor; x++){
            a = a + ` 

            <div class="alert alert-danger" id="dangerMinor0${x}" style="display:none;">
              <span id="dangerMinor${x}"></span>
            </div>


            <div class="panel panel-default">
              <div class="panel-heading">Minor ${x+1}</div>
              <div class="panel-body">
              <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>First Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control dd" style="text-transform: capitalize;" id="minorfirstName${x}" name="minor[${x}][firstname]" placeholder="First Name" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Last Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control dd" style="text-transform: capitalize;" id="minorlastName${x}" name="minor[${x}][lastname]" placeholder="Last Name" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Birthday</label>
                  <span style="color:red;" class="required">*</span> <input type="date" id="minorbirthday${x}" x="${x}" name="minor[${x}][birthday]" class="form-control bdd" placeholder="mm/dd/yyyy" required>
                  </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Mobile Number</label>
                  <input type="text" class="form-control dd" id="minormobileNumber${x}" name="minor[${x}][mobile]" placeholder="Mobile Number" >
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Email Address</label>
                  <span style="color:red;" class="required">*</span> <input type="email" class="form-control dd" id="minoremailAddress${x}" aria-describedby="emailHelp" name="minor[${x}][email]" placeholder="Email Address" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Age</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control" id="minorAge${x}" name="minor[${x}][age]" placeholder="Age" readonly>
                  </div>
                  </div>
                </div>
              </div>
            </div>



              <br>`;

          }
        }
        else if($("#selShipping option:selected").val() == 2){
          if($("#selSeat option:selected").val() == 5){
            for(x = 0; x < minor; x++){
            a = a + ` 

            <div class="alert alert-danger" id="dangerMinor0${x}" style="display:none;">
              <span id="dangerMinor${x}"></span>
            </div>


            <div class="panel panel-default">
              <div class="panel-heading">Minor ${x+1}</div>
              <div class="panel-body">
              <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>First Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control dd" style="text-transform: capitalize;" id="minorfirstName${x}" name="minor[${x}][firstname]" placeholder="First Name" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Last Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control dd" style="text-transform: capitalize;" id="minorlastName${x}" name="minor[${x}][lastname]" placeholder="Last Name" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Birthday</label>
                  <span style="color:red;" class="required">*</span> <input type="date" id="minorbirthday${x}" x="${x}" name="minor[${x}][birthday]" class="form-control bdd" placeholder="mm/dd/yyyy" required>
                  </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Mobile Number</label>
                  <input type="text" class="form-control dd" id="minormobileNumber${x}" name="minor[${x}][mobile]" placeholder="Mobile Number" >
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Email Address</label>
                  <span style="color:red;" class="required">*</span> <input type="email" class="form-control dd" id="minoremailAddress${x}" aria-describedby="emailHelp" name="minor[${x}][email]" placeholder="Email Address" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Age</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control" id="minorAge${x}" name="minor[${x}][age]" placeholder="Age" readonly>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Accommodation</label>
                  <select class="form-control ship" name="regular[${x}][accommodation]" id="regularAccommodation${x}">
                    <option value="Sitting">Sitting</option>
                    <option value="Lying">Lying</option>
                  </select>
                  </div>
                  </div>
                </div>
              </div>
            </div>



              <br>`;
            }
            
          }else{
          for(x = 0; x < minor; x++){
            a = a + ` 

            <div class="alert alert-danger" id="dangerMinor0${x}" style="display:none;">
              <span id="dangerMinor${x}"></span>
            </div>


            <div class="panel panel-default">
              <div class="panel-heading">Minor ${x+1}</div>
              <div class="panel-body">
              <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>First Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control dd" style="text-transform: capitalize;" id="minorfirstName${x}" name="minor[${x}][firstname]" placeholder="First Name" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Last Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control dd" style="text-transform: capitalize;" id="minorlastName${x}" name="minor[${x}][lastname]" placeholder="Last Name" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Birthday</label>
                  <span style="color:red;" class="required">*</span> <input type="date" id="minorbirthday${x}" x="${x}" name="minor[${x}][birthday]" class="form-control bdd" placeholder="mm/dd/yyyy" required>
                  </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Mobile Number</label>
                  <input type="text" class="form-control dd" id="minormobileNumber${x}" name="minor[${x}][mobile]" placeholder="Mobile Number" >
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Email Address</label>
                  <span style="color:red;" class="required">*</span> <input type="email" class="form-control dd" id="minoremailAddress${x}" aria-describedby="emailHelp" name="minor[${x}][email]" placeholder="Email Address" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Age</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control" id="minorAge${x}" name="minor[${x}][age]" placeholder="Age" readonly>
                  </div>
                  </div>
                </div>
              </div>
            </div>



              <br>`;

          }
          
          }

        }

        $("#adultMod").html(`<div class="panel panel-default">
              <div class="panel-body">${a}<hr></div>
              </div>`);  
////////////////////////////////////////////////////////////////////////////////////////////

          for(x = 0; x < adult; x++){
            a = a + ` 

            <div class="alert alert-danger" id="dangerAdult0${x}" style="display:none;">
              <span id="dangerAdult${x}"></span>
            </div>


            <div class="panel panel-default">
              <div class="panel-heading">Adult ${x+1}</div>
              <div class="panel-body">
              <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>First Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control dd" style="text-transform: capitalize;" id="adultfirstName${x}" name="adult[${x}][firstname]" placeholder="First Name" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Last Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control dd" style="text-transform: capitalize;" id="adultlastName${x}" name="adult[${x}][lastname]" placeholder="Last Name" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Birthday</label>
                  <span style="color:red;" class="required">*</span> <input type="date" id="adultbirthday${x}" x="${x}" name="adult[${x}][birthday]" class="form-control bdd" placeholder="mm/dd/yyyy" required>
                  </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Mobile Number</label>
                  <input type="text" class="form-control" id="adultmobileNumber${x}" name="adult[${x}][mobile]" placeholder="Mobile Number" >
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Email Address</label>
                  <span style="color:red;" class="required">*</span> <input type="email" class="form-control dd" id="adultemailAddress${x}" aria-describedby="emailHelp" name="adult[${x}][email]" placeholder="Email Address" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Age</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control dob" id="adultAge${x}" name="adult[${x}][age]" placeholder="Age" readonly>
                  </div>
                  </div>
                </div>
              </div>
            </div>



              <br>`;

          }

          $("#adultMod").html(`<div class="panel panel-default">
              <div class="panel-body">${a}<hr></div>
              </div>`);

///////////////////////////////////////////////////////////////////////////////////////////
        if($("#selShipping option:selected").val() == 1){
          for(x = 0; x < infant; x++){
            a = a + ` 

            

            
            <div class="panel panel-default">
              <div class="panel-heading">Child ${x+1}</div>
              <div class="panel-body">
              <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>First Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control" style="text-transform: capitalize;" id="infantfirstName${x}" name="infant[${x}][firstname]" placeholder="First Name" >
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Last Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control" style="text-transform: capitalize;" id="infantlastName${x}" name="infant[${x}][lastname]" placeholder="Last Name" >
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Birthday</label>
                  <span style="color:red;" class="required">*</span> <input type="date" x="${x}" id="infantbirthday${x}" name="infant[${x}][birthday]" class="form-control bdd" placeholder="mm/dd/yyyy" >
                  </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Mobile Number</label>
                  <input type="text" class="form-control" id="infantmobileNumber${x}" name="infant[${x}][mobile]" placeholder="Mobile Number" >
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Email Address</label>
                  <span style="color:red;" class="required">*</span> <input type="email" class="form-control" id="infantemailAddress${x}" aria-describedby="emailHelp" name="infant[${x}][email]" placeholder="Email Address" >
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Age</label>
                  <span style="color:red;" class="required">*</span> <input type="number" class="form-control" id="infantAge${x}" aria-describedby="emailHelp" name="infant[${x}][age]" placeholder="Age" readonly>
                  </div>
                  </div>

                  
                </div>
              </div>
            </div>


               
      
              <br>`;

          }
        }
        else if($("#selShipping option:selected").val() == 2){
        if($("#selSeat option:selected").val() == 5){
          for(x = 0; x < infant; x++){
            a = a + ` 

            

            
            <div class="panel panel-default">
              <div class="panel-heading">Child ${x+1}</div>
              <div class="panel-body">
              <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>First Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control" style="text-transform: capitalize;" id="infantfirstName${x}" name="infant[${x}][firstname]" placeholder="First Name" >
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Last Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control" style="text-transform: capitalize;" id="infantlastName${x}" name="infant[${x}][lastname]" placeholder="Last Name" >
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Birthday</label>
                  <span style="color:red;" class="required">*</span> <input type="date" x="${x}" id="infantbirthday${x}" name="infant[${x}][birthday]" class="form-control bdd" placeholder="mm/dd/yyyy" >
                  </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Mobile Number</label>
                  <input type="text" class="form-control" id="infantmobileNumber${x}" name="infant[${x}][mobile]" placeholder="Mobile Number" >
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Email Address</label>
                  <span style="color:red;" class="required">*</span> <input type="email" class="form-control" id="infantemailAddress${x}" aria-describedby="emailHelp" name="infant[${x}][email]" placeholder="Email Address" >
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Age</label>
                  <span style="color:red;" class="required">*</span> <input type="number" class="form-control" id="infantAge${x}" aria-describedby="emailHelp" name="infant[${x}][age]" placeholder="Age" readonly>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Accommodation</label>
                  <select class="form-control ship" name="infant[${x}][accommodation]" id="infantAccommodation${x}">
                    <option value="Sitting">Sitting</option>
                    <option value="Lying">Lying</option>
                  </select>
                  </div>
                  </div>
                </div>
              </div>
            </div>


               
      
              <br>`;

          }
        }else{
          for(x = 0; x < infant; x++){
          a = a + ` 

            

            
            <div class="panel panel-default">
              <div class="panel-heading">Child ${x+1}</div>
              <div class="panel-body">
              <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>First Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control" style="text-transform: capitalize;" id="infantfirstName${x}" name="infant[${x}][firstname]" placeholder="First Name" >
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Last Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control" style="text-transform: capitalize;" id="infantlastName${x}" name="infant[${x}][lastname]" placeholder="Last Name" >
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Birthday</label>
                  <span style="color:red;" class="required">*</span> <input type="date" x="${x}" id="infantbirthday${x}" name="infant[${x}][birthday]" class="form-control bdd" placeholder="mm/dd/yyyy" >
                  </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Mobile Number</label>
                  <input type="text" class="form-control" id="infantmobileNumber${x}" name="infant[${x}][mobile]" placeholder="Mobile Number" >
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Email Address</label>
                  <span style="color:red;" class="required">*</span> <input type="email" class="form-control" id="infantemailAddress${x}" aria-describedby="emailHelp" name="infant[${x}][email]" placeholder="Email Address" >
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Age</label>
                  <span style="color:red;" class="required">*</span> <input type="number" class="form-control" id="infantAge${x}" aria-describedby="emailHelp" name="infant[${x}][age]" placeholder="Age" readonly>
                  </div>
                  </div>
                </div>
              </div>
            </div>


               
      
              <br>`;
            }
        }
      }




          
          $("#adultMod").html(`<div class="panel panel-default">
              <div class="panel-body">${a}<hr></div>
              </div>`);

///////////////////////////////////////////////////////////////////////////////////////////
        if($("#selShipping option:selected").val() == 1){
          for(x = 0; x < student; x++){



            a = a + ` 

            

            
            <div class="panel panel-default">
              <div class="panel-heading">Student ${x+1}</div>
              <div class="panel-body">
              <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>First Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control" style="text-transform: capitalize;" id="studentfirstName${x}" name="student[${x}][firstname]" placeholder="First Name" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Last Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control" style="text-transform: capitalize;" id="studentlastName${x}" name="student[${x}][lastname]" placeholder="Last Name" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Birthday</label>
                  <span style="color:red;" class="required">*</span> <input type="date" x="${x}" id="studentbirthday${x}" name="student[${x}][birthday]" class="form-control bdd" placeholder="mm/dd/yyyy" required>
                  </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Mobile Number</label>
                  <input type="text" class="form-control" id="studentmobileNumber${x}" name="student[${x}][mobile]" placeholder="Mobile Number">
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Email Address</label>
                  <span style="color:red;" class="required">*</span> <input type="email" class="form-control" id="studentemailAddress${x}" aria-describedby="emailHelp" name="student[${x}][email]" placeholder="Email Address" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Age</label>
                  <span style="color:red;" class="required">*</span> <input type="number" class="form-control" id="studentAge${x}" aria-describedby="emailHelp" name="student[${x}][age]" placeholder="Age" readonly>
                  </div>
                  </div>
                </div>
              </div>
            </div>


               
      
              <br>`;

          }
        }
        else if($("#selShipping option:selected").val() == 2){
          if($("#selSeat option:selected").val() == 5){
            for(x = 0; x < student; x++){



            a = a + ` 

            

            
            <div class="panel panel-default">
              <div class="panel-heading">Student ${x+1}</div>
              <div class="panel-body">
              <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>First Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control" style="text-transform: capitalize;" id="studentfirstName${x}" name="student[${x}][firstname]" placeholder="First Name" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Last Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control" style="text-transform: capitalize;" id="studentlastName${x}" name="student[${x}][lastname]" placeholder="Last Name" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Birthday</label>
                  <span style="color:red;" class="required">*</span> <input type="date" x="${x}" id="studentbirthday${x}" name="student[${x}][birthday]" class="form-control bdd" placeholder="mm/dd/yyyy" required>
                  </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Mobile Number</label>
                  <input type="text" class="form-control" id="studentmobileNumber${x}" name="student[${x}][mobile]" placeholder="Mobile Number">
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Email Address</label>
                  <span style="color:red;" class="required">*</span> <input type="email" class="form-control" id="studentemailAddress${x}" aria-describedby="emailHelp" name="student[${x}][email]" placeholder="Email Address" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Age</label>
                  <span style="color:red;" class="required">*</span> <input type="number" class="form-control" id="studentAge${x}" aria-describedby="emailHelp" name="student[${x}][age]" placeholder="Age" readonly>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Accommodation</label>
                  <select class="form-control ship" name="regular[${x}][accommodation]" id="regularAccommodation${x}">
                    <option value="Sitting">Sitting</option>
                    <option value="Lying">Lying</option>
                  </select>
                  </div>
                  </div>
                </div>
              </div>
            </div>


               
      
              <br>`;

          }
          }else{
            for(x = 0; x < student; x++){



            a = a + ` 

            

            
            <div class="panel panel-default">
              <div class="panel-heading">Student ${x+1}</div>
              <div class="panel-body">
              <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>First Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control" style="text-transform: capitalize;" id="studentfirstName${x}" name="student[${x}][firstname]" placeholder="First Name" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Last Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control" style="text-transform: capitalize;" id="studentlastName${x}" name="student[${x}][lastname]" placeholder="Last Name" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Birthday</label>
                  <span style="color:red;" class="required">*</span> <input type="date" x="${x}" id="studentbirthday${x}" name="student[${x}][birthday]" class="form-control bdd" placeholder="mm/dd/yyyy" required>
                  </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Mobile Number</label>
                  <input type="text" class="form-control" id="studentmobileNumber${x}" name="student[${x}][mobile]" placeholder="Mobile Number">
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Email Address</label>
                  <span style="color:red;" class="required">*</span> <input type="email" class="form-control" id="studentemailAddress${x}" aria-describedby="emailHelp" name="student[${x}][email]" placeholder="Email Address" required>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Age</label>
                  <span style="color:red;" class="required">*</span> <input type="number" class="form-control" id="studentAge${x}" aria-describedby="emailHelp" name="student[${x}][age]" placeholder="Age" readonly>
                  </div>
                  </div>
                </div>
              </div>
            </div>


               
      
              <br>`;

          }
          }
        }



          
          $("#adultMod").html(`<div class="panel panel-default">
              <div class="panel-body">${a}<hr></div>
              </div>`);

///////////////////////////////////////////////////////////////////////////////////////////
        if($("#selShipping option:selected").val() == 1){

          for(x = 0; x < senior; x++){

            
              
           
            a = a + ` 

            <div class="panel panel-default">
              <div class="panel-heading">Senior ${x+1}</div>
              <div class="panel-body">
              <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>First Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control" style="text-transform: capitalize;" id="seniorfirstName${x}" name="senior[${x}][firstname]" placeholder="First Name">
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Last Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control" style="text-transform: capitalize;" id="seniorlastName${x}" name="senior[${x}][lastname]" placeholder="Last Name">
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Birthday</label>
                  <span style="color:red;" class="required">*</span> <input type="date" x="${x}" id="seniorbirthday${x}" name="senior[${x}][birthday]" class="form-control bdd" placeholder="mm/dd/yyyy">
                  </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Mobile Number</label>
                  <input type="text" class="form-control" id="seniormobileNumber${x}" name="senior[${x}][mobile]" placeholder="Mobile Number" >
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Email Address</label>
                  <span style="color:red;" class="required">*</span> <input type="email" class="form-control" id="senioremailAddress${x}" aria-describedby="emailHelp" name="senior[${x}][email]" placeholder="Email Address">
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Age</label>
                  <span style="color:red;" class="required">*</span> <input type="number" class="form-control" id="seniorAge${x}" aria-describedby="emailHelp" name="senior[${x}][age]" placeholder="Age" readonly>
                  </div>
                  </div>

                  
                </div>
              </div>
            </div>

               
      
              <br>`;

          }

        }
        else if($("#selShipping option:selected").val() == 2){
          if($("#selSeat option:selected").val() == 5){
          for(x = 0; x < senior; x++){

            
              
           
            a = a + ` 

            <div class="panel panel-default">
              <div class="panel-heading">Senior ${x+1}</div>
              <div class="panel-body">
              <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>First Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control" style="text-transform: capitalize;" id="seniorfirstName${x}" name="senior[${x}][firstname]" placeholder="First Name">
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Last Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control" style="text-transform: capitalize;" id="seniorlastName${x}" name="senior[${x}][lastname]" placeholder="Last Name">
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Birthday</label>
                  <span style="color:red;" class="required">*</span> <input type="date" x="${x}" id="seniorbirthday${x}" name="senior[${x}][birthday]" class="form-control bdd" placeholder="mm/dd/yyyy">
                  </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Mobile Number</label>
                  <input type="text" class="form-control" id="seniormobileNumber${x}" name="senior[${x}][mobile]" placeholder="Mobile Number" >
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Email Address</label>
                  <span style="color:red;" class="required">*</span> <input type="email" class="form-control" id="senioremailAddress${x}" aria-describedby="emailHelp" name="senior[${x}][email]" placeholder="Email Address">
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Age</label>
                  <span style="color:red;" class="required">*</span> <input type="number" class="form-control" id="seniorAge${x}" aria-describedby="emailHelp" name="senior[${x}][age]" placeholder="Age" readonly>
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Accommodation</label>
                  <select class="form-control ship" name="senior[${x}][accommodation]" id="seniorAccommodation${x}">
                    <option value="Sitting">Sitting</option>
                    <option value="Lying">Lying</option>
                  </select>
                  </div>
                  </div>
                </div>
              </div>
            </div>

               
      
              <br>`;

          }
        }
        else{
          for(x = 0; x < senior; x++){

            
              
           
            a = a + ` 

            <div class="panel panel-default">
              <div class="panel-heading">Senior ${x+1}</div>
              <div class="panel-body">
              <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>First Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control" style="text-transform: capitalize;" id="seniorfirstName${x}" name="senior[${x}][firstname]" placeholder="First Name">
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Last Name</label>
                  <span style="color:red;" class="required">*</span> <input type="text" class="form-control" style="text-transform: capitalize;" id="seniorlastName${x}" name="senior[${x}][lastname]" placeholder="Last Name">
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Birthday</label>
                  <span style="color:red;" class="required">*</span> <input type="date" x="${x}" id="seniorbirthday${x}" name="senior[${x}][birthday]" class="form-control bdd" placeholder="mm/dd/yyyy">
                  </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Mobile Number</label>
                  <input type="text" class="form-control" id="seniormobileNumber${x}" name="senior[${x}][mobile]" placeholder="Mobile Number" >
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Email Address</label>
                  <span style="color:red;" class="required">*</span> <input type="email" class="form-control" id="senioremailAddress${x}" aria-describedby="emailHelp" name="senior[${x}][email]" placeholder="Email Address">
                  </div>
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                  <label>Age</label>
                  <span style="color:red;" class="required">*</span> <input type="number" class="form-control" id="seniorAge${x}" aria-describedby="emailHelp" name="senior[${x}][age]" placeholder="Age" readonly>
                  </div>
                  </div>

                  
                </div>
              </div>
            </div>

               
      
              <br>`;

          }
        }
      }



          
          $("#adultMod").html(`<div class="panel panel-default">
              <div class="panel-body">${a}<hr></div>
              </div>`);
          

              
  }


  

});

</script>

<script>

</script>
<!-- FOR MODALS -->

<div id="ACTIVATION" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id="actclose">&times;</button>
        <h4 class="modal-title">Shipping Activation</h4>
      </div>
      <div class="modal-body">

      <div class="row" id='actinfo' >
          <div class="col-md-12">
            <div class="form-group">
              
                <center><b>Activate this Service Fee for P100.00</b></center>
                <hr>
              
            </div>
          </div>
        </div>

        <div class="row" id='actsuccess' style="display:none;">
          <div class="col-md-12">
            <div class="form-group">
              <div class="alert alert-success" role="alert" id="as">
                <center>You have successfully availed the activation for <b><span id="actnameship"><span></span> shipping. Page will automatically refresh.</center>
              </div>
            </div>
          </div>
        </div>

        <div class="row" id='actdanger' style="display:none;">
          <div class="col-md-12">
            <div class="form-group">
              <div class="alert alert-warning" role="alert" id="aw">
                <center>Invalid Transaction Password.</center>
              </div>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label class="exampleInputPassword1" for="exampleInputPassword1">Transaction Password</label>
              <input type="password" class="form-control exampleInputPassword1" id="exampleInputPassword1" placeholder="Password">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btnActivation" >Activate</button>
      </div>
    </div>

  </div>
</div>



<script>
$("#btnActivation").click(function(){
    $("#as").stop();
            $("#aw").stop();
  waitingDialog.show();
    $.ajax({
      type: 'POST',
      url: `/Shipping/transactionpasswordforShipping`,
      data: { transpassword : $("#exampleInputPassword1").val(), shipid : $("#selShipping option:selected").val() },
      success: function (data) {
        waitingDialog.hide();
        var res = JSON.parse(data);
        console.log(res.S);
          $("#as").removeAttr("style");
            $("#aw").removeAttr("style");
        $("#actnameship").html($("#selShipping option:selected").text());

        if($("#exampleInputPassword1").val() == ""){
          alert("EMPTY TRANSACTION PASSWORD");
        }else if(res.S == 0){
          $("#actsuccess").hide();
          $("#actdanger").show();
        }else{
          $("#actdanger").hide();
          $("#actsuccess").show();
          $("#btnActivation").hide();
          $(".exampleInputPassword1").hide();
          
          


          // setTimeout(function() {
          //     location.reload();
          // }, 2000);
        }
        


      },
      error: function (data) {
        console.log(data)
      }
    });
});


$("#actclose").click(function(){
  location.reload();
});

$(document).on("change", ".bdd", function() {

    
        var numb = $(this).attr("x"); //its number in for loop
        var date = this.value; //get the value like 02/26/1994

        // var year = date.substring(date.lastIndexOf("/")+1);

        var arr = date.split('-');

        var year = arr[0];

        var dteNow = new Date();
        var yearTODAY = dteNow.getFullYear();

        if($(this).attr("id") == "adultbirthday"+$(this).attr("x")){
          var ageID = "#adultAge" + numb;
          // alert(ageID);
          var computedage = parseInt(yearTODAY) - parseInt(year);
          $(ageID).val(computedage);
        }
        if($(this).attr("id") == "infantbirthday"+$(this).attr("x")){
          var ageID = "#infantAge" + numb;
          // alert(ageID);
          var computedage = parseInt(yearTODAY) - parseInt(year);
          $(ageID).val(computedage);
        }
        if($(this).attr("id") == "studentbirthday"+$(this).attr("x")){
          var ageID = "#studentAge" + numb;
          // alert(ageID);
          var computedage = parseInt(yearTODAY) - parseInt(year);
          $(ageID).val(computedage);
        }
        if($(this).attr("id") == "seniorbirthday"+$(this).attr("x")){
          var ageID = "#seniorAge" + numb;
          // alert(ageID);
          var computedage = parseInt(yearTODAY) - parseInt(year);
          $(ageID).val(computedage);
        }
        if($(this).attr("id") == "regularbirthday"+$(this).attr("x")){
          var ageID = "#regularAge" + numb;
          // alert(ageID);
          var computedage = parseInt(yearTODAY) - parseInt(year);
          $(ageID).val(computedage);
        }
        if($(this).attr("id") == "minorbirthday"+$(this).attr("x")){
          var ageID = "#minorAge" + numb;
          // alert(ageID);
          var computedage = parseInt(yearTODAY) - parseInt(year);
          $(ageID).val(computedage);
        }

    
});
</script>



</form> 





    