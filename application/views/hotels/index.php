<style>
.form-group.form-group-lg .input-icon {
  width: 45px;
  height: 45px;
  line-height: 45px;
  font-size: 22px;
}
.form-group.form-group-lg.form-group-icon-left .form-control {
  padding-left: 45px;
}
.form-group.form-group-lg.form-group-icon-right .form-control {
  padding-right: 45px;
}
.form-group.form-group-lg label {
  font-size: 16px;
  margin-bottom: 7px;
}
.form-group.form-group-lg .form-control {
  height: 45px;
  padding: 10px 18px;
  font-size: 13px;
}
.form-group.form-group-sm {
  margin-bottom: 10px;
}
.form-group.form-group-sm label {
  margin-bottom: 3px;
  font-size: 13px;
}
.form-group.form-group-sm .form-control {
  height: 25px;
  padding: 3px 7px;
  font-size: 12px;
  line-height: 1.4em;
}
.form-group.form-group-icon-left .form-control {
  padding-left: 32px;
}
.form-group.form-group-icon-right .form-control {
  padding-right: 32px;
}
.form-group .input-icon {
  position: absolute;
  width: 32px;
  height: 32px;
  line-height: 32px;
  display: block;
  top: 35px;
  left: 5px;
  text-align: center;
  color: #b3b3b3;
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
  z-index: 1;
}
.form-group .input-icon.input-icon-show {
  -webkit-transform: translate3d(0, -10px, 0);
  -moz-transform: translate3d(0, -10px, 0);
  -o-transform: translate3d(0, -10px, 0);
  -ms-transform: translate3d(0, -10px, 0);
  transform: translate3d(0, -10px, 0);
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
}
.form-group .input-icon.input-icon-show + label + .form-control {
  padding: 6px 12px;
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
}
.form-group.form-group-icon-right .input-icon {
  right: 1px;
  left: auto;
}
.form-group.form-group-focus .input-icon {
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -o-transition: 0.3s;
  -ms-transition: 0.3s;
  transition: 0.3s;
}

.calen .form-group.form-group-icon-right .input-icon {
    right: 21px !important;
    left: auto;
}

.ui-state-disabled, .ui-widget-content .ui-state-disabled, .ui-widget-header .ui-state-disabled {
    opacity: .35;
    filter: Alpha(Opacity=35);
    background-image: none;
}

.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active {
    border: 1px solid #ed8323;
    background-color: #fc9d48;
    font-weight: normal;
    color: white;
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
                  <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                  <li>Hotels</li>
              </ul>
              <h4>Hotel Booking</h4>
          </div>
      </div><!-- media -->
  </div><!-- pageheader -->
  
  <div class="contentpanel">
    <?php if (isset($error)): ?>
      <div class="alert alert-danger"><?php echo $error; ?></div> 
    <?php endif ?>


    <form method="post" method="<?php echo BASE_URL()?>Hotels/search_hotels" id="frmSearchHotelEngine" autocomplete="off" >
      <div class="row">

        <div class="col-md-6">
            <div class="panel panel-default well">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <h3 class="panel-title">Search Hotel Booking</h3>
                </div>
                <div class="panel-body">

                    <div class="col-md-12">
                      <div class="row">
                        <div class="form-group form-group-icon-right destination-location">
                          <label for="destination">Destination</label>
                          <i class="fa fa-map-marker input-icon map"></i>
                          <!-- <input type="text" class="form-control" name="destination" id="destination" required="" placeholder=""> -->

                          <input data-original-title="Top" data-container="body" data-placement="top" style="" name="hotel_location" class="hotel_typeahead form-control tooltipss" placeholder="Enter City, Destination, Zone or Hotel Name" type="text" style="height:auto;" important/>

                          <input name="location" type="hidden"/>
                          <input name="zone" type="hidden"/>
                          <input name="category" type="hidden"/>
                        </div>
                      </div>
                    </div>
                    <hr style="margin: 10px 0;">
                    <div class="row calen">
                      <div class="col-xs-12 col-md-4">
                        <div class="form-group form-group-icon-right">
                          <label>Check-in</label>
                          <i class="fa fa-calendar input-icon "></i>
                          <input type="text" class="form-control checkin" name="checkin" id="checkin" required="" placeholder="yyyy-mm-dd">
                        </div>
                      </div>
                      <div class="col-xs-12 col-md-4">
                        <div class="form-group form-group-icon-right">
                          <label>Check-out</label>
                          <i class="fa fa-calendar input-icon "></i>
                          <input type="text" class="form-control checkout" name="checkout" id="checkout" required="" placeholder="yyyy-mm-dd">
                        </div>
                      </div>
                      <div class="col-xs-12 col-md-4">
                        <label>Rooms</label>
                        <div class="form-group">
                          <select class="form-control rooms" name="rooms" id="rooms">
                            <option selected="selected" value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                          </select>
                        </div> 
                      </div> 
                    </div>

                    <hr style="margin: 10px 0;">

                    <div class="row">
                      <div class="col-xs-12 col-md-12">
                          <table class="table table-hover">
                            <thead>
                              <th>Room #</th>
                              <th>Adults</th>
                              <th>Children</th>
                              <th ><span id="childage_label"></span></th>
                            </thead>
                              <tbody>
                                <tr>
                                  <td width="5%;">
                                      1
                                  </td>
                                  <td width="15%;">
                                      <select class="form-control adults" name="occupancies[0][adults]" id="adults" style="width: 65px;">
                                        <option value="1">1</option>
                                        <option value="2" selected="">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                      </select>
                                      <input type="hidden" value='1'>
                                  </td>
                                  <td width="15%;">
                                      <select class="form-control optChildren" name="occupancies[0][children][count]" id="children_1" data-value='1' style="width: 65px;" >
                                        <option value="0" selected="selected">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                      </select>
                                      <input type='hidden' value='0' id='hdnChildCount1'>
                                  </td>
                                  <td width="75%;">
                                      <div class="row">
                                        <div class="form-group">
                                        <div id="idChildAge_1_1" class="pull-left"></div>
                                        <div id="idChildAge_1_2" class="pull-left"></div>
                                      </div>
                                        <div class="form-group">
                                        <div id="idChildAge_1_3" class="pull-left"></div>
                                        <div id="idChildAge_1_4" class="pull-left"></div>
                                        </div>
                                      </div>
                                  </td>
                                </tr>

                                <tr id="idRooms_2"></tr>
                                <tr id="idRooms_3"></tr>
                                <tr id="idRooms_4"></tr>
                                <tr id="idRooms_5"></tr>
                                <tr id="idRooms_6"></tr>
                                <tr id="idRooms_7"></tr>
                                <tr id="idRooms_8"></tr>
                                <tr id="idRooms_9"></tr>
                                <tr id="idRooms_10"></tr>
                              </tbody>
                          </table>
                        
                      </div>
                    </div>

                    <hr style="margin: 0 0 20px;">
                    <button type="submit" class="btn btn-primary btn-blockxx" id="aloading" name="btn_search">Search</button>
                </div>

              </div>

                <!--<div class="panel-footer">

                </div>-->
            </div>
          </div>
   
      </div>
                       
    </form>
    <input type="hidden" name="" id="hdnRoomVal" value="1">
    <input type="hidden" name="" id="hdnChildRoom1" value="0">
    <input type="hidden" name="" id="hdnChildRoom2" value="0">
    <input type="hidden" name="" id="hdnChildRoom3" value="0">
    <input type="hidden" name="" id="hdnChildRoom4" value="0">
  </div><!-- contentpanel -->
</div><!-- mainpanel -->            


<script src="<?php echo BASE_URL()?>assets/js/jquery.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    var totalRooms = 4;
    $('#rooms').change(function(){
        var roomCount = $(this).val();
        var originalRoomCount = parseInt($("#hdnRoomVal").val());
        
        // check if the room is added or minus
        if (roomCount > originalRoomCount) {
          //var roomId = 
          for(var i = originalRoomCount; i < roomCount; i++) {
            
              $("#idRooms_" + (i+1) ).append("<td width='15%;'> " + (i+1) + " </td>"+
                                  "<td width='15%;'>"+
                                      "<select class='form-control adults' name='occupancies["+i+"][adults]' id='adults' style='width: 65px;'>"+
                                        "<option value='1'>1</option>"+
                                        "<option value='2' selected=''>2</option>"+
                                        "<option value='3'>3</option>"+
                                        "<option value='4'>4</option>"+
                                        "<option value='5'>5</option>"+
                                        "<option value='6'>6</option>"+
                                        "<option value='7'>7</option>"+
                                        "<option value='8'>8</option>"+
                                      "</select>"+
                                      "<input type='hidden' value='" + (i+1) + "'>" +
                                  "</td>"+
                                  "<td width='15%;'>"+
                                      "<select class='form-control optChildren' name='occupancies["+i+"][children][count]' id='children_"+ (i+1) +"' data-value="+ (i+1) +" style='width: 65px;'>"+
                                        "<option value='0' selected='selected'>0</option>"+
                                        "<option value='1'>1</option>"+
                                        "<option value='2'>2</option>"+
                                        "<option value='3'>3</option>"+
                                        "<option value='4'>4</option>"+
                                      "</select>"+
                                      "<input type='hidden' value='0' id='hdnChildCount"+ (i+1) +"'>"+
                                  "</td>"+
                                  "<td width='65%;'>"+
                                      '<div class="row">'+
                                        '<div class="form-group">'+
                                      "<span id='idChildAge_"+ (i+1) +"_1' class='pull-left'></span>"+
                                      "<span id='idChildAge_"+ (i+1) +"_2' class='pull-left'></span>"+
                                      "<span id='idChildAge_"+ (i+1) +"_3' class='pull-left'></span>"+
                                      "<span id='idChildAge_"+ (i+1) +"_4' class='pull-left'></span>"+
                                      "</div></div>"+
                                  "</td>");
          }
        } else if (roomCount < originalRoomCount) {
          if (originalRoomCount == totalRooms) {
            for(var total = totalRooms; total != roomCount; total--) {
              $("#idRooms_" + total).empty();
              $("#hdnChildRoom" + (total)).val(0);
            }
          } else {
            for(var total = originalRoomCount; total != roomCount; total--) {
              $("#idRooms_" + total).empty();
              $("#hdnChildRoom" + (total)).val(0);
            }
          }
        }

        // SET NEW ROOM COUNT
        $("#hdnRoomVal").val(roomCount);
        checkChildAgeLabel();
    });


    // $(".optChildren").change(function(){
    $(".contentpanel").delegate(".optChildren", "change", function(){
      var childCount = parseInt($(this).val());
      var index = parseInt($(this).attr('data-value'));
      var originalChildCount = parseInt($('#hdnChildCount' + (index)).val());
      if (childCount > originalChildCount) {
        if ($("#hdnChildRoom" + (index)).val() == 0) {
          $("#hdnChildRoom" + (index)).val(1);
        }

        for(var ic = originalChildCount; ic < childCount; ic++) {
          $("#idChildAge_" + (index) +"_" + (ic+1)).append(
            '<div class="form-group">'+
            '<label class="pull-left" style="font-size: 12px;">Child '+ (ic+1) +': </label>' +
            '<select class="form-control" name="occupancies['+(index-1)+'][children]['+(ic)+']" style="width: 65px; margin-left: 52px; margin-top: -7px;" important>'+
              '<option value="0" >0</option>'+
              '<option value="1" selected="selected" >1</option>'+
              '<option value="2">2</option>'+
              '<option value="3">3</option>'+
              '<option value="4">4</option>'+
              '<option value="5">5</option>'+
              '<option value="6">6</option>'+
              '<option value="7">7</option>'+
              '<option value="8">8</option>'+
              '<option value="9">9</option>'+
              '<option value="10">10</option>'+
              '<option value="11">11</option>'+
            '</select></div>');
        }
      } else {
          if (childCount == 0) {
            for(var i = 4; i>0; i--) {
              $("#idChildAge_" + index + "_" + i).empty();
            }  
            $("#hdnChildRoom" + (index)).val(0);
          } else {
            for(var i = originalChildCount; i>childCount; i--) {
              $("#idChildAge_" + (index) + "_" + i).empty();
            }  
          }   
      }
      
      checkChildAgeLabel();
      $('#hdnChildCount' + (index)).val(childCount);

    });

  function checkChildAgeLabel() {
    var isChld = parseInt($("#hdnChildRoom1").val()) + parseInt($("#hdnChildRoom2").val()) + 
    parseInt($("#hdnChildRoom3").val()) + parseInt($("#hdnChildRoom4").val());
    if (isChld > 0) {
      $("#childage_label").text('Child Age');
    } else {
      $("#childage_label").text('');
    }
  }

  $('input[name="checkin"]').datepicker({
    todayHighlight: false,
    startDate: new Date(),
    numberOfMonths: 1,
    minDate: new Date((new Date()).valueOf() + 1000*3600*24),
    dateFormat: "yy-mm-dd",
    onClose: function( dateText, inst ) {
      var checkin = jQuery(this).datepicker('getDate');
      var checkout = new Date(checkin.getTime());
      checkout.setDate(checkout.getDate() + 1);
      
      jQuery('input[name="checkout"]').datepicker("option", "minDate", checkout);
    }
  }).datepicker("setDate", "+1day");
  
  $('input[name="checkout"]').datepicker({
    todayHighlight: true,
    startDate: new Date(),
    numberOfMonths: 1,
    minDate: new Date((new Date()).valueOf() + 1000*3600*48),
    dateFormat: "yy-mm-dd",
    
  }).datepicker("setDate", "+2day");

  $('.hotel_typeahead').typeahead({
      autoselect: true,
      hint: true,
      highlight: true,
      minLength: 3,
      limit: 8,
  },
  {
    source: function(q, cb) {
    $('input[name="location"]').val('');
    $('input[name="category"]').val('');
    $('input[name="zone"]').val('');

    $('.map').removeClass('fa-map-marker');
    $('.map').addClass('fa-spinner fa-spin');
    $('input[name="hotel_location"]').css({'cursor':'progress'});

    return $.ajax({
      dataType: 'JSON',
      type: 'get',
      url: '/hotels/search_api?args=' + q,
      cache: false,
      success: function(data) {
        $('.map').addClass('fa-map-marker');
        $('.map').removeClass('fa-spinner fa-spin');
        $('input[name="hotel_location"]').css({'cursor':'auto'});
  
        var category = {1:'All', 2:'City', 3:'Hotel'};
        var result = [];
                        
        let destinationDetails = [];
        const zoneDetails = [];
        const hotelDetails = [];
        const { destinations, zones, hotels } = data.data;

        destinations.rows.forEach( (a) => {
          destinationDetails.push({
            id: a.id,
            name: `${a.name}, ${a.country.name}`,
            category: 1,
          });
        });

        zones.rows.forEach( (a) => {
          zoneDetails.push({
            id: a.destination.id,
            name: `${a.name}, 
            ${a.destination.name}`,
            category: 2,
            zoneCode:a.zoneCode
          });
        });

        hotels.rows.forEach( (a) => {
          hotelDetails.push({
            id: a.id,
            name: a.name,
            category: 3,
          });
        });

        destinationDetails = destinationDetails.concat(zoneDetails, hotelDetails);

        $.each(destinationDetails, function(index, valCon) {
          var zoneCode = "";
          if (valCon.zoneCode != undefined || valCon.zoneCode) {
            zoneCode = valCon.zoneCode;
          }
          result.push({
            label: valCon.name,
            id: valCon.id,
            category: category[valCon.category],
            categoryCode: valCon.category,
            zoneCode:zoneCode
          });
        });

        cb(result);
      }
    });
  }, templates: {
    empty: '<div class="empty-message" style="padding: 8px; color: red;display:block">No matches.</div>',
    suggestion: function (data) {
      
      var fontAwesome = '';
      if(data.category == "All"){
        fontAwesome = 'fa-map-marker';
      }else if(data.category == "City"){
        fontAwesome = 'fa-building';
      }else{
        fontAwesome = 'fa-hotel';
      }
      return '<i class="fa ' + fontAwesome + '"></i> &nbsp;&nbsp;&nbsp; ' + data.label +' <span class="pull-right cat" style="font-weight: bold;color: #ed8323;">'+data.category+'</span>';
    }
  }}).on('typeahead:selected', function (obj, datum) {
    $(".hotel_typeahead").typeahead('val', datum.label);
    $('input[name="location"]').val(datum.id);
    $('input[name="category"]').val(datum.categoryCode);
    $('input[name="zone"]').val(datum.zoneCode);
    $('input[name="hotel_location"]').css({'border':'1px solid #cccccc'});
});

function sortData(data, field) {
  data.sort(function (a, b) {
    var fieldA = a[field].toUpperCase(); // ignore upper and lowercase
    var fieldB = b[field].toUpperCase(); // ignore upper and lowercase
    if (fieldA < fieldB) return -1;
    if (fieldA > fieldB)return 1;
    return 0; 
  });
}

$("#frmSearchHotelEngine").on('submit',function(){
  if ($('input[name="location"]').val() == "" || $('input[name="hotel_location"]').val() == "") {
    $('input[name="hotel_location"]').css('border','1px solid #dc3545');
    return false;
  }
  $('input[name="hotel_location"]').css('border','');
  waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});		
	
  return true;
});




});
</script>