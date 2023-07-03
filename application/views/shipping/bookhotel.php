<style type="text/css">
  .table-condensed
        {
            width: 100%;
        }
</style>
<div class="mainpanel">
  <div class="pageheader">
      <div class="media">
          <div class="pageicon pull-left">
              <i class="fa fa-book"></i>
          </div>
          <div class="media-body">
              <ul class="breadcrumb">
                  <li><a href="<?php echo BASE_URL()."hotels"; ?>"><i class="glyphicon glyphicon-home"></i></a></li>
                  <li>Hotels</li>
              </ul>
              <h4>Hotel Booking</h4>
          </div>
      </div><!-- media -->
  </div><!-- pageheader -->
  
  <div class="contentpanel">
    <form action="<?php echo BASE_URL(). "hotels/book_hotel/{$sessionName}"?>" method="POST" autocomplete="off" class="frmclass" accept-charset="UTF-8">
      <input type="hidden" name="hotel[rateKey]" value="<?php echo $hotelDetails['rateKey']?>">
      <input type="hidden" name="hotel[dailyRates]" value='<?php echo json_encode($hotelDetails['dailyRates'])?>'>
      <input type="hidden" name="hotel[ttlRooms]" value="<?php echo $parameter['ttlRooms']?>">
      <input type="hidden" name="hotel[ttlAdult]" value="<?php echo $parameter['ttlAdult']?>">
      <input type="hidden" name="hotel[ttlChild]" value="<?php echo $parameter['ttlChild']?>">
      <input type="hidden" name="hotel[id]" value="<?php echo $hotelDetails['id']?>">
      <input type="hidden" name="hotel[checkIn]" value="<?php echo $parameter['checkIn']?>">
      <input type="hidden" name="hotel[checkOut]" value="<?php echo $parameter['checkOut']?>">
      <input type="hidden" name="hotel[netAmount]" value="<?php echo $hotelDetails['netAmount']?>">

      <input type="hidden" name="parameter" value='<?php echo json_encode($parameter); ?>'>
      <input type="hidden" name="hotelDetails" value='<?php echo json_encode($hotelDetails); ?>'>
      
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
      <?php if(isset($error)):?>
        <div class="row">
          <div style="padding-bottom: 10px;">
            <div class="alert alert-danger" >
              <strong><?php echo $error?></strong>
            </div>
          </div>
        </div>
      <?php endif?>
      <div id="divFieldsToFillUps">
        
        <span style="font-size: 10px;"> Field with <i class="fa fa-asterisk" style="font-size: 9px; color: red;"></i> are mandatory to fillup</span>
        <h4>Customer Details</h4>
        <div class="panel-group">
          <div class="row">
            <div class="col-md-3 col-sm-12 col-xs-12">
              <div class="form-group">
                <label>First Name <i class="fa fa-asterisk" style="font-size: 9px; color: red;"></i></label>
                <input value="<?php echo isset($post) ? $post['customer']['firstname']:"" ?>" type="text" class="form-control fldCustomer" id="txtCustomeFirstName" name="customer[firstname]" required placeholder="ex. JOHN" autocomplete="anyrandomstring">
              </div>
            </div>

            <div class="col-md-3 col-sm-12 col-xs-12">
              <div class="form-group">
                <label>Last Name <i class="fa fa-asterisk" style="font-size: 9px; color: red;"></i></label>
                <input value="<?php echo isset($post) ? $post['customer']['lastname']:"" ?>" type="text" class="form-control fldCustomer" id="txtCustomeLastName" name="customer[lastname]" required placeholder="ex. DOE" autocomplete="anyrandomstring1">
              </div>
            </div>

            <div class="col-md-3 col-sm-12 col-xs-12">
              <div class="form-group">
                <label>Email Address <i class="fa fa-asterisk" style="font-size: 9px; color: red;"></i></label>
                <input value="<?php echo isset($post) ? $post['customer']['emailAddress']:"" ?>" type="email" class="form-control fldCustomer" id="txtCustomeEmailAddress" name="customer[emailAddress]" required placeholder="juandelacruz@gmail.com" autocomplete="anyrandomstring2">
              </div>
            </div>

            <div class="col-md-3 col-sm-12 col-xs-12">
              <div class="form-group">
                <label>Mobile No. <i class="fa fa-asterisk" style="font-size: 9px; color: red;"></i></label>
                <input value="<?php echo isset($post) ? $post['customer']['mobile']:"" ?>" type="text" class="form-control number fldCustomer" id="txtCustomeMobile" name="customer[mobile]" required placeholder="ex. 09099999999" maxlength="11" autocomplete="anyrandomstring3">
              </div>
            </div>
          </div>
        </div>

        <h4>Guest Details</h4>
        <div class="panel-group">
            <?php foreach ($parameter['occupancies'] as $key => $room) :?>
              <div class="panel panel-default " style="border:0">
                <div class="panel-heading">
                  <h4 style="font-weight: bold !important; color: #ea740f;" class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo $key; ?>" class="collapsed">Room <?php echo $key+1?></a></h4>
                </div>
                <div class="panel-body">
                    <b> ADULT</b>
                    <?php for($i=1; $room['adults']>= $i; $i++):?>
                      <div class="row">
                        
                        <div class="col-md-4 col-sm-12 col-xs-12">
                          <div class="form-group">
                            <label>First Name <i class="fa fa-asterisk" style="font-size: 9px; color: red;"></i></label>
                            <input value="<?php echo isset($post) ? $post['guest'][$key]['adult'][$i]['firstname']:"" ?>" type="text" class="form-control fldGuest" name="guest[<?php echo $key;?>][adult][<?php echo $i;?>][firstname]" required data-tag="<?php echo "r{$key}A{$i}"?>" data-type='<?php echo json_encode(["r"=>$key,"type"=>"adult","key"=>$i])?>' data-content="firstname" placeholder="ex. JOHN" autocomplete="anyrandomstring4">
                          </div>
                        </div>

                        <div class="col-md-4 col-sm-12 col-xs-12">
                          <div class="form-group">
                            <label>Last Name <i class="fa fa-asterisk" style="font-size: 9px; color: red;"></i></label>
                            <input value="<?php echo isset($post) ? $post['guest'][$key]['adult'][$i]['lastname']:"" ?>" type="text" class="form-control fldGuest" name="guest[<?php echo $key;?>][adult][<?php echo $i;?>][lastname]" required data-tag="<?php echo "r{$key}A{$i}"?>" data-type='<?php echo json_encode(["r"=>$key,"type"=>"adult","key"=>$i])?>' data-content="lastname" placeholder="ex. DOE" autocomplete="anyrandomstring5">
                          </div>
                        </div>

                        <div class="col-md-4 col-sm-12 col-xs-12">
                          <div class="form-group">
                            <label>Birth Date <i class="fa fa-asterisk" style="font-size: 9px; color: red;"></i></label>
                            <input value="<?php echo isset($post) ? $post['guest'][$key]['adult'][$i]['birthdate']:"" ?>" type="text" class="form-control  fldGuest adultBirthDate" name="guest[<?php echo $key;?>][adult][<?php echo $i;?>][birthdate]" id="adultBDay<?php echo $i;?>" placeholder="YYYY-MM-DD" required data-tag="<?php echo "r{$key}A{$i}"?>" data-type='<?php echo json_encode(["r"=>$key,"type"=>"adult","key"=>$i])?>' data-content="birthdate" readonly style="cursor:pointer" autocomplete="anyrandomstring6">
                          </div>
                        </div>

                      </div>

                    <?php endfor;?>

                    <?php 
                      if ($room['children'] > 0):
                        $index = $room['adults']-1;
                        echo "<b>CHILDREN</b>";
                        for($i=1; $room['children'] >= $i; $i++):
                          $age = $index+$i;


                          ?>
                          <div class="row">
                            
                            <div class="col-md-4 col-sm-12 col-xs-12">
                              <div class="form-group">
                                <label>First Name <i class="fa fa-asterisk" style="font-size: 9px; color: red;"></i></label>
                                <input value="<?php echo isset($post) ? $post['guest'][$key]['child'][$i]['firstname']:"" ?>" type="text" class="form-control fldGuest" name="guest[<?php echo $key;?>][child][<?php echo $i;?>][firstname]" required data-tag="<?php echo "r{$key}C{$i}"?>" data-type='<?php echo json_encode(["r"=>$key,"type"=>"child","key"=>$i])?>' data-content="firstname" placeholder="ex. JOHN" autocomplete="anyrandomstring7">
                              </div>
                            </div>

                            <div class="col-md-4 col-sm-12 col-xs-12">
                              <div class="form-group">
                                <label>Last Name <i class="fa fa-asterisk" style="font-size: 9px; color: red;"></i></label>
                                <input value="<?php echo isset($post) ? $post['guest'][$key]['child'][$i]['lastname']:"" ?>" type="text" class="form-control fldGuest" name="guest[<?php echo $key;?>][child][<?php echo $i;?>][lastname]" required data-tag="<?php echo "r{$key}C{$i}"?>" data-type='<?php echo json_encode(["r"=>$key,"type"=>"child","key"=>$i])?>' data-content="lastname" placeholder="ex. DOE" autocomplete="anyrandomstring8">
                              </div>
                            </div>

                            <div class="col-md-4 col-sm-12 col-xs-12">
                              <div class="form-group">
                                <label>Birth Date</label>
                                <input value="<?php echo isset($post) ? $post['guest'][$key]['child'][$i]['birthdate']:"" ?>" type="text" class="form-control fldGuest childBirthDate" name="guest[<?php echo $key;?>][child][<?php echo $i;?>][birthdate]"data-tag="<?php echo "r{$key}C{$i}"?>" data-type='<?php echo json_encode(["r"=>$key,"type"=>"child","key"=>$i])?>' data-content="birthdate" placeholder="YYYY-MM-DD" id="children<?php echo "r{$key}C{$i}"?>" readonly style="cursor:pointer" autocomplete="anyrandomstring9">
                              </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12">
                              <div class="form-group">
                              </div></div> 

                            <input type="hidden" name="guest[<?php echo $key;?>][child][<?php echo $i;?>][age]" value="<?php echo $room['paxes'][$age]['age'];?>" >

                          </div>
                    <?php endfor;
                      endif;
                    ?>
                  </div>
              </div>
            <?php endforeach;?>
        </div>

        <div class="col-md-12">
          <div class="pull-left">
            <a href="/hotels" class="btn btn-danger" id="\"><i class="fa fa-times"></i> Cancel</a>
          </div>
          <div class="pull-right">
            <a href="javascript:void()" class="btn btn-primary" id="btnConfirmGuestDetails"><i class="fa fa-credit-card"></i> SUBMIT</a>
          </div>
        </div>

      </div>

      <div id="divGuestList" style="display: none">
          <h4>Customer Details</h4>
          <table class="table table-responsive table-bordered">
            <tr>
              <th colspan="2">Customer Details</th>
            </tr>
            <tr>
              <td>Name</td>
              <td><span id="spnCustomerName"></span></td>
            </tr>
            <tr>
              <td>Email Address</td>
              <td><span id="spnCustomerEmail"></td>
            </tr>
            <tr>
              <td>Mobile No</td>
              <td><span id="spnCustomerMobile"></td>
            </tr>
            <?php foreach ($parameter['occupancies'] as $key => $room) :?>
              <tr>
                  <th colspan="2">ROOM <?php echo ($key + 1); ?></th>
              </tr>
              <?php for($i=1; $room['adults']>= $i; $i++):?>
                <tr>
                  <td><span id="<?php echo "r{$key}A{$i}name"?>"></span></td>
                  <td><span id="<?php echo "r{$key}A{$i}email"?>"></span></td>
                </tr>
              <?php endfor;?>

              <?php 
              if ($room['children'] > 0):
                for($i=1; $room['children'] >= $i; $i++):?>
                  <tr>
                    <td><span id="<?php echo "r{$key}C{$i}name"?>"></span></td>
                    <td><span id="<?php echo "r{$key}C{$i}email"?>"></span></td>
                  </tr>
                <?php endfor;
              endif; 
            endforeach ?>
          </table>

          <div class="col-md-12">
            <div class="pull-left">
              <a href="#" class="btn btn-danger" id="btnEditGuest"><i class="fa fa-pencil"></i> Edit</a>
            </div>
            <div class="pull-right">
              <button class="btn btn-primary" id="btnSubmit" type="button" data-toggle="modal" data-target="#myModal"><i class="fa fa-credit-card"></i> CONFIRM</button>
            </div>
          </div>
      </div>
    </div>
    
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div class="booking-item-payment">
        <header class="clearfix">
          <h2 class="booking-item-payment-title" style="font-size: 23px; font-weight: bold"><a href="#"><?php echo $hotelDetails['name']; ?></a></h2>
          <ul class="icon-group booking-item-rating-stars" style="color: #ed8323;">
            <?php 
            for ($i = 1; $i <= 5; $i++) {
              if($hotelDetails['star'] >= $i)
                echo "<li><i class='fa fa-star'></i></li>";
              else{
                if(($i - $star) == .5)
                  echo "<li><i class='fa fa-star-half-full'></i></li>";
                else
                  echo "<li><i class='fa fa-star-o'></i></li>";
              }
            }
            ?>
          </ul>
          <span style="font-size: 12px;"><?php echo $hotelDetails['accommodationType']; ?></span> <br>
          <span style="font-size: 12px;"><?php echo $hotelDetails['address']; ?></span>
        </header>
        <ul class="booking-item-payment-details">
          <li id="paymentSelectedHeader">
            <?php 
              // $date1 = new DateTime($data['checkIn']);
              // $date2 = new DateTime($data['checkOut']);
              // $diff = $date2->diff($date1)->format("%a");
            ?>
            <h5 style="font-weight: bold"><i class="fa fa-clock-o"></i> <?php echo $parameter['dateDiff']; ?> night(s)</h5>
            <div id="paymentSelectedHeader" class="paymentSelectedCheckinCheckOut">
              <div class="booking-item-payment-date">
                <p class="booking-item-payment-date-day"><?php echo date('F, d Y', strtotime($parameter['checkIn']));?></p>
                <p class="booking-item-payment-date-weekday"><?php echo date('l', strtotime($parameter['checkIn']))?></p>
              </div><i class="fa fa-arrow-right booking-item-payment-date-separator"></i>
              <div class="booking-item-payment-date">
                <p class="booking-item-payment-date-day"><?php echo date('F, d Y', strtotime($parameter['checkOut']));?></p>
                <p class="booking-item-payment-date-weekday"><?php echo date('l', strtotime($parameter['checkOut']))?></p>
              </div>
            </div>
          </li>
          <hr>

          <li>
            <h5 style="font-weight: bold;">SELECTED ROOM</h5>
            <h4 ><?php echo $hotelDetails['roomName'] . "(<small>{$hotelDetails['boardName']}</small>)"?></h4>
            <hr>
            <h5 style="font-weight: bold;">BOOKING DETAILS</h5>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-4 col-sm-4 col-xs-12">
                  Room(s): <b><?php echo $parameter['ttlRooms']; ?></b>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  Adult(s): <b><?php echo $parameter['ttlAdult']; ?></b>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  Children: <b><?php echo $parameter['ttlChild']; ?></b>
                </div>
              </div>  
            </div>
          </li>

          <!-- <li>
            <hr>
            <h5>CANCELLATION CHARGES</h5>
            <p> <?php //echo $hotelDetails['cancellationPolicy'];?></p>
          </li> -->

          <?php if($hotelDetails['rateClass'] == "NRF"):?>
          <!-- <li>
            <hr>            
            <p> Non-refundable</p>
          </li> -->
          <?php endif;?>
          
          <li>
            <hr>
            <h5 style="font-weight: bold;">Remarks</h5>
            <?php print_r($hotelDetails['rateComments'])?>
          </li>

          <!-- <li>
            <ul class="booking-item-payment-details">

              < ?php 
              $total = 0;
              // var_dump(json_decode($hotelDetails['dailyRates'], true));
              //foreach($hotelDetails['dailyRates'] as $key=>$dailyRate):
                //<li style="border-bottom: 1px dashed #d9d9d9;">
                  //Night < ?php echo $key + 1
                  //<span class="pull-right"> < ?php echo "PHP " . number_format($dailyRate['dailySellingRate'] *$parameter['ttlRooms'], 2)></span>
                  //$total += ($dailyRate['dailySellingRate'] * $parameter['ttlRooms']);
                //</li>
              //endforeach?>
            </ul>
          </li> -->
        </ul>

        <ul class="booking-item-payment-details">
          <li style="border-bottom: 1px dashed #d9d9d9;">
            Total
            <span class="pull-right"> <?php echo number_format($hotelDetails['totalAmount'], 2); ?></span>
            <input type="hidden" name="hotel[totalAmount]" value="<?php echo $hotelDetails['totalAmount']; ?>">
          </li>
        </ul>
    </div>

    <div id="myModal" class="modal fade" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h4 class="modal-title" style="font-weight: bold;color: #4169E1;">TERMS AND CONDITIONS</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <p>Fares are subject to availability. In case there is any fare change we will notify you at the earliest.</p>
            </div>

            <div class="form-group">
              <div class="checkbox">
                <label><input type="checkbox" value="" required=""><span>I have read and accept the <b>TERMS AND CONDITIONS</b> and <b>FARE RULES</b>.</span></label>
              </div>
              <!-- <input type="checkbox" value="" required> <span>I have read and accept the <b>TERMS AND CONDITIONS</b> and <b>FARE RULES</b>.</span> -->
            </div>

            <div class="form-group">
              <label><small>Transaction Password :</small></label>
              <input type="password" class="form-control" name="transpass" placeholder="Transaction Password" required="">
            </div> 

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="btnConfirm">Proceed</button>
          </div>

        </div>

      </div>
    </div>

    </form>
  </div>
</div>

<div id="myModalAlert" class="modal fade " tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
        <div class="modal-header">
          <h4><i style="color:#ed8323;" class="fa fa-exclamation-circle"></i> Important</h4>
        </div>
        <div class="modal-body">
          <h4 id="msg">Session Expires!</h4>
        </div>
    </div>
  </div>
</div>



<script type="text/javascript">
  $(document).ready(function(){
    var maxDateForAdult = "";
    var maxDateForAdult = <?php echo "formatDate('".$maxDateForAdult."')";?>;
    console.log(maxDateForAdult)

    <?php
    foreach($parameter['occupancies'] as $key => $value):?>
      // console.log(< ?php echo intVal($value['children']) ?>);
      <?php if(intVal($value['children']) > 0):
        $i = 1;
        foreach ($value['paxes'] as $pKey => $pax):?>
          // console.log(< ?php echo json_encode($pax) ?>);
          <?php if($pax['type'] == 'CH'):
            echo "var vMn{$key}C{$i} = formatDate('{$pax['min']}');"; 
            echo "var vMx{$key}C{$i} = formatDate('{$pax['max']}');"; 
            
            echo "$('#childrenr{$key}C{$i}').datetimepicker({
                minView: 2,
                startView: 2,
                viewSelect: 2,
                format: 'YYYY-MM-DD',
                fontAwesome: true,
                pickTime: false,
                disableTodayHighlight: true,
                autoclose: true,
                endDate: vMx{$key}C{$i},
                defaultDate: vMx{$key}C{$i},
                startDate: vMn{$key}C{$i}
            });";?>
            $('#children<?php echo "r{$key}C{$i}"; ?>').val(null);<?php
          $i++;
          endif;
        endforeach;
      endif;
    endforeach;
     ?>

    $("#btnConfirmGuestDetails").click(function(e){
      e.preventDefault();
      if (checkDetailsFields()) {
        $("#divFieldsToFillUps").hide();
        $("#divGuestList").show();  
      } else {
        alert("Please fill up all fields");
      }
    });

    $("#btnEditGuest").click(function(e){
      e.preventDefault();
      $("#divFieldsToFillUps").show();
      $("#divGuestList").hide();
    });

    $("#txtCustomeFirstName").keyup(function(){
      regCustomerName();
    });

    $("#txtCustomeFirstName").keydown(function(){
      regCustomerName();
    });

    $("#txtCustomeFirstName").keypress(function(){
      regCustomerName();
    });

    $("#txtCustomeFirstName").blur(function(){
      regCustomerName();
    });

    $("#txtCustomeLastName").keyup(function(){
      regCustomerName();
    });

    $("#txtCustomeLastName").keydown(function(){
      regCustomerName();
    });

    $("#txtCustomeLastName").keypress(function(){
      regCustomerName();
    });

    $("#txtCustomeLastName").blur(function(){
      regCustomerName();
    });
    
    function regCustomerName() {
      $("#spnCustomerName").text($("#txtCustomeFirstName").val() + " " + $("#txtCustomeLastName").val());
    }
    // --------------------- //

    $("#txtCustomeEmailAddress").keyup(function(){
      regCustomerEmail();
    });

    $("#txtCustomeEmailAddress").keydown(function(){
      regCustomerEmail();
    });

    $("#txtCustomeEmailAddress").keypress(function(){
      regCustomerEmail();
    });

    $("#txtCustomeEmailAddress").blur(function(){
      regCustomerEmail();
    });

    function regCustomerEmail() {
      $("#spnCustomerEmail").text($("#txtCustomeEmailAddress").val());
    }

    // --------------------- //

    $("#txtCustomeMobile").keyup(function(){
      regCustomerMobile();
    });

    $("#txtCustomeMobile").keydown(function(){
      regCustomerMobile();
    });

    $("#txtCustomeMobile").keypress(function(){
      regCustomerMobile();
    });

    $("#txtCustomeMobile").blur(function(){
      regCustomerMobile();
    });

    function regCustomerMobile() {
      $("#spnCustomerMobile").text($("#txtCustomeMobile").val());
    }

    // --------------------- //

    $(".fldGuest").keyup(function(){
      regGuest($(this));
    });

    $(".fldGuest").keydown(function(){
      regGuest($(this));
    });

    $(".fldGuest").keypress(function(){
      regGuest($(this));
    });

    $(".fldGuest").blur(function(){
      regGuest($(this));
    });

    function regGuest(objField) {
      var spanId = objField.attr('data-tag');
      var roomKeys = $.parseJSON(objField.attr('data-type'));
      var nameField = objField.attr('data-content');

      if ( nameField == "firstname" || nameField == "lastname") {
        var fName = "guest["+roomKeys.r+"]["+roomKeys.type+"]["+roomKeys.key+"]";
        var firstname = $('input[name="'+fName+'[firstname]"]').val()
        var lastname = $('input[name="guest['+roomKeys.r+']['+roomKeys.type+']['+roomKeys.key+'][lastname]"]').val()
        $("#" + spanId + "name").text(firstname + " " + lastname);
      } else {
        $("#" + spanId + "email").text(objField.val());
      }
    }

    $('.dtepckrBirthDate').change(function() {
        regGuest($(this));
    });

    $('.number').on('keyup',function () { // not allowing alphabet
      newval = $(this).val().replace(/[^0-9.]/g, "");
      $(this).val(newval);
    });

    function iliminateAlphabet() {

    }

    //----//

    function checkDetailsFields() {
      let guests= $('.fldGuest');
      let customer= $('.fldCustomer');

      var retResult = 1;
      var nameFields = [];

      for (var i = 0; i < guests.length; i++) {
        if (guests[i].value == "") {
          retResult = 0;
          $('input[name="'+guests[i].name+'"]').css('border','1px solid #dc3545');
        } else {
          $('input[name="'+guests[i].name+'"]').css('border','');
        }
      }

      for (var i = 0; i < customer.length; i++) {
        if (customer[i].value == "") {
          retResult = 0;
          $('input[name="'+customer[i].name+'"]').css('border','1px solid #dc3545');
        } else {
          $('input[name="'+customer[i].name+'"]').css('border','');
        }
      }

      if (checkEmailAddress() === 0) {
        retResult = 0;
      }

      return retResult;
    }

    setInterval(function() {
      $('#myModalAlert').modal({
          show:true,
          backdrop: 'static',
          keyboard: false
      });
      window.location.replace("<?php echo BASE_URL()."hotels"?>");
    }, 600000);

    function checkEmailAddress() {
      var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      var ret = 0;
      if(re.test($("#txtCustomeEmailAddress").val())){
        $("#txtCustomeEmailAddress").css('border','')
        ret = 1;
      } else {
        $("#txtCustomeEmailAddress").css('border','1px solid #dc3545')
      }

      return ret;
    }

    $('.adultBirthDate').datetimepicker({
        minView: 2,
        startView: 2,
        viewSelect: 2,
        format: 'YYYY-MM-DD',
        fontAwesome: true,
        pickTime: false,
        disableTodayHighlight: true,
        autoclose: true,
        endDate: maxDateForAdult,
        defaultDate: maxDateForAdult
    });

    $('.adultBirthDate').change(function(){
      $(this).blur();
    });

    $('.adultBirthDate').val(null);

    function formatDate(date){
      var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

          var convert_date = new Date(date);
          var month_value = convert_date.getMonth()+1;
          var day_value = convert_date.getDate();
          var year_value = convert_date.getFullYear();

          // return months[month_value] + " " +day_value +", "+ year_value;
          // return month_value + "/" +day_value +"/"+ year_value;

          if(month_value.toString().length==1){
            month_value = '0'+month_value.toString();
          }
          if(day_value.toString().length==1){
            day_value = '0'+day_value.toString();
          }
          return year_value + "-" +month_value +"-"+ day_value;
    }
  });
</script>
