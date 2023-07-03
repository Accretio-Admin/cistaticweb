<link href="<?php echo BASE_URL()."assets/css/search.css?" ?>">
<div class="mainpanel">
  <div class="pageheader">
      <div class="media">
          <div class="pageicon pull-left">
              <i class="fa fa-book"></i>
          </div>
          <div class="media-body">
              <ul class="breadcrumb">
                  <li><a href="<?php echo BASE_URL()."hotels/search_hotels" ?>"><i class="glyphicon glyphicon-home"></i></a></li>
                  <li>Hotels</li>
              </ul>
              <h4>Hotel Booking</h4>
          </div>
      </div><!-- media -->
  </div><!-- pageheader -->
  
  <div class="contentpanel">
    <?php if(count($hotels)):?>
        <div class="col-lg-9 col-md-8 col-sm-12" >
            <div class="row" style="padding-bottom: 10px;">
                <div class="col-md-12 col-xs-12">
                    <div class="col-md-6 col-xs-12">
                        <!-- <div class="nav-drop booking-sort" style="float: none">
                            <h5 class="booking-sort-title"><a href="#">Sort: Price <span class="sort-label">(low to high)</span></a></h5>
                            <ul class="nav-drop-menu">
                                <li><a href="#" class="low-to-high">Price (low to high)</a></li>
                                <li><a href="#" class="high-to-low">Price (high to low)</a></li>
                            </ul>
                        </div> -->
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="row">
                            <div class="col-md-8 col-xs-8">
                                <input type="text" name="toSearchHotelName" class="form-control" placeholder="Hotel Name" id="toSearchHotelName">
                                <input type="hidden" name=0 id="hdnIsSearch">
                            </div>
                            <div class="col-md-2 col-xs-2">
                                <button id="btnSearchHotelName" class="btn btn-primary" type="button">
                                    <span class="fa fa-search"></span>
                                </button>
                            </div>
                            <div class="col-md-2 col-xs-2">
                                <button id="btnCancelSearchHotelName" class="btn btn-danger" type="button">
                                    <span class="fa fa-times-circle-o"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xs-12" id="availableHotelDisplay">
                    <ul class="booking-list" id="bookingListHotel">
                        <?php foreach($hotels as $keys=>$hotel): 

                            if (trim($keys) == 'range' || trim($keys) == 'boardType' || trim($keys) == 'accommodations' || trim($keys) == 'numRooms') {
                                continue;
                            }
                            ?>
                            
                            <li id="<?php echo $hotel['id'] ?>" 
                                class="search-hotel <?php echo $hotel['minRate']?>" 
                                data-content="<?php echo $hotel['id'] ?>" 
                                data-rate="<?php echo $hotel['minRate'] ?>" 
                                data-star="<?php echo $hotel['star']?>" 
                                data-hotel_name = "<?php echo $hotel['name'] ?>" 
                                data-accommodationType = "<?php echo $hotel['accommodationType']?>" 
                            
                                <?php 
                                foreach($hotel['rooms'] as $rooms):
                                    $rooms = $rooms;
                                    foreach($rooms['rates'] as $rates):
                                        $rates = $rates;
                                        break 2;
                                    endforeach;
                                endforeach;
                            
                                ?>
                            >
                                <input type="hidden" name="hotelRate" id="hdnHotelRate" value="<?php echo $hotel['minRate'] ?>">
                                <div class="booking-item-container">
                                    <div class="booking-item" style="border-radius: 5px">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-4 col-xs-12" id="availableHotelImg">
                                                <div class="booking-item-img-wrap text-center">
                                                    <img src="<?php echo $hotel['images']?> "class="image-hotel searchHotelImage" alt="<?php echo $hotel['name'] ?>" title="<?php echo $hotel['name'] ?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-5 col-sm-5 col-xs-12" id="availableHotelDetails">
                                                <div class="booking-item-rating">
                                                    <ul class="icon-group booking-item-rating-stars">
                                                        <?php for ($i = 1; $i <= 5; $i++): 
                                                            if($hotel['star'] >= $i)
                                                                echo "<li><i class='fa fa-star'></i></li>";
                                                            else {
                                                                if(($i - $hotel['star']) == .5):
                                                                    echo "<li><i class='fa fa-star-half-full'></i></li>";
                                                                else:
                                                                    echo "<li><i class='fa fa-star-o'></i></li>";
                                                                endif;
                                                            }
                                                            endfor;?>
                                                        </ul><span class="booking-item-rating-number"></span>
                                                        <span style="display: none" id="hotelStar"></span>
                                                </div>
                                                <a href="<?php echo BASE_URL()."hotels/details/{$sessionName}/{$hotel['id']}"; ?>"><h4 class="booking-item-title" id="hotelName" style="font-weight: 500;"><?php echo $hotel['name']?></h4></a>
                                                <p class="booking-item-address"> <i class="fa fa-building"></i> <?php echo $hotel['star'] > 1 ? $hotel['star']." Star":"" ?> <?php echo $hotel['accommodationType'] ?>    </p>
                                                <p class="booking-item-address" id="hotelAddress"><i class="fa fa-map-marker"></i> 

                                                <?php echo $hotel['address']. '' . $hotel['city'].' '.$hotel['postalCode'];?>
                                                <small class="booking-item-last-booked"></small>
                                                <p class="booking-item-description">
                                                    <!-- <a href='< ?php echo BASE_URL()."hotels/details/{$sessionName}/{$hotel['id']}"; ?>' class='read-more-hotel'>More</a> -->
                                                </p>
                                                <p class="booking-item-address" style="padding-top: 0px; margin: 0px !important;" id="viewMore">
                                                    <a class="view-more-prices" style="text-decoration:underline;">VIEW MORE PRICES AND BOARD TYPES &nbsp;<span class="fa fa-angle-double-down"></span></a></p>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-12" id="availableHotelButton">
                                                <span class="booking-item-price-from">from </span>
                                                <span class="booking-item-price" style="font-size: 24px;">
                                                    PHP <span id="data-amount<?php echo $hotel['id'];?>"><?php echo number_format($rates['totalAmount'], 2);?></span> <br>
                                                    <!-- <span class="booking-item-price-from"> <i>Room / Night</i> </span> -->
                                                    <span class="booking-item-price-from" style="color: #d66f11" id="allotment<?php echo $hotel['id']?>">
                                                        <?php echo $rates['allotment']?> AVAILABLE ROOM<?php echo $rates['allotmentSingular']?>
                                                    </span>
                                                    <br>
                                                    <span id="listRoomType<?php echo $hotel['id']?>" style="font-weight: bold; font-size: 17px;">
                                                        <?php echo $rooms['name']?> <br>
                                                    </span>
                                                    <span id="listBoardType<?php echo $hotel['id']?>" class="booking-item-price-from" style="color: #d66f11">
                                                        <?php echo $rates['boardName']?> <br>
                                                    </span>

                                                    <br>
                                                    <form action="<?php echo BASE_URL()."hotels/book_now/{$sessionName}"?>" method="POST" enctype='multipart/form-data' class="frmclass">
                                                        <input type="hidden" value="<?php echo $hotel['name']?>" name="hotel[name]">
                                                        <input type="hidden" value="<?php echo $hotel['id']?>" name="hotel[id]">
                                                        <input type="hidden" value="<?php echo $hotel['accommodationType']?>" name="hotel[accommodationType]">
                                                        <input type="hidden" value="<?php echo $hotel['star']?>" name="hotel[star]">
                                                        <input type="hidden" value="<?php echo $hotel['address']. '' . $hotel['city'] . ' ' . $hotel['postalCode']?>" name="hotel[address]">
                                                        <!-- <input type="hidden" value="<?php //echo $rates['rateComment']?>" name="hotel[rateComment]"> -->
                                                        <input type="hidden" value="<?php echo $rates['rateType']?>" name="hotel[rateType]">
                                                        <input type="hidden" value="<?php echo $rates['rateKey']?>" name="hotel[rateKey]">
                                                        
                                                        <input type="hidden" value="<?php echo $rates['sellingAmount']?>" name="hotel[sellingAmount]">
                                                        <input type="hidden" value="<?php echo $rates['totalAmount']?>" name="hotel[totalAmount]" id="hdnDailySellingRate">
                                                        <input type="hidden" value="<?php echo $rates['cancellationPolicy']?>" name="hotel[cancellationPolicy]">
                                                        <input type="hidden" value="<?php echo $rates['boardCode']?>" name="hotel[boardCode]">
                                                        <input type="hidden" value="<?php echo $rates['boardName']?>" name="hotel[boardName]">
                                                        <input type="hidden" value="<?php echo $rooms['name']?>" name="hotel[roomName]">
                                                        <input type="hidden" value='<?php echo json_encode($rates['dailyRates'])?>' name="hotel[dailyRates]">
                                                        <input type="hidden" value='<?php echo $rates['netAmount']?>' name="hotel[netAmount]">
                                                        <input type="hidden" value='<?php echo $rates['rateClass']?>' name="hotel[rateClass]">

                                                        <button type='submit' class="btn btn-primary" data-content="">Book Now</button>
                                                        <br />
                                                        <span style="font-size: 11px;color: #e27513;font-weight: bold;" id="rateClass<?php echo $hotel['id'] ?>">
                                                            <?php //if(strtoupper($rates['rateClass']) == "NRF"): 
                                                                //echo "Non-Refundable";
                                                                //endif; 
                                                                ?>
                                                        </span>
                                                    </form>
                                                </span>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="booking-item-details">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12" id="tableOverflow">
                                                <table class="details" style="font-size: 14px; border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                    <thead> 
                                                        <th>ROOM TYPE</th>
                                                        <th>BOARD TYPE</th>
                                                        <th><!-- OFFERS --></th>
                                                        <th>FROM</th>
                                                        <th></th>
                                                    </thead>
                                                    <tbody class="price-details">
                                                        <?php 
                                                        foreach($hotel['rooms'] as $rooms):
                                                            foreach($rooms['rates'] as $rates):
                                                                ?>
                                                                <tr class="price-net" 
                                                                id="<?php echo $hotel['id'].''.$rooms['code'].''.$rates['boardCode']?>" 
                                                                data-rate="<?php echo $rates['net']?>"
                                                                data-boardCode="<?php echo $rates['boardCode']?>"
                                                                data-rateKey="<?php echo $rates['rateKey']?>"
                                                                data-rateType="<?php echo $rates['rateType']?>"
                                                                data-star="<?php echo $hotel['star']?>"
                                                                data-rateClass="<?php echo $rates['rateClass']?>"
                                                                data-dailySellingRateArr='<?php echo json_encode($rates['dailyRates'])?>'
                                                                data-amount="<?php echo $rates['totalAmount']?>"
                                                                data-allotment="<?php echo $rates['allotment']?> AVAILABLE ROOM<?php echo $rates['allotmentSingular']?>"
                                                                >
                                                                    <td>
                                                                        <?php echo $hotels['numRooms'] ." " .$rooms['name']?>
                                                                        <br>
                                                                        <small class="booking-item-last-booked" style="color: #d66f11">
                                                                            <?php echo $rates['allotment']?> AVAILABLE ROOM<?php echo $rates['allotmentSingular']?>
                                                                        </small>
                                                                    </td>
                                                                    <td style="font-size: 13px;">
                                                                        <?php echo $rates['boardName'] ?>
                                                                    </td>
                                                                    <td style="font-size: 11px;color: #e27513;font-weight: bold;">
                                                                        <span id="roomOffers">
                                                                        </span>
                                                                    </td>
                                                                    <td>
                                                                        <span style="font-weight: bolder;"><?php echo "{$rates['currency']}" . number_format($rates['totalAmount'], 2)?> </span>
                                                                        <br>
                                                                        <!-- <i><small> Room/Night</small></i> -->
                                                                        <br>
                                                                        <?php 
                                                                        // if(strtoupper($rates['rateClass']) == "NRF"):
                                                                        //     echo '<span style="font-size: 11px;color: #e27513;font-weight: bold;">Non-Refundable</span>';
                                                                        // endif;
                                                                        ?>
                                                                    </td>
                                                                <td>
                                                                    <form action="<?php echo BASE_URL()."hotels/book_now/{$sessionName}"?>" method="POST" enctype='multipart/form-data' class="frmclass">

                                                                        <input type="hidden" value="<?php echo $hotel['name']?>" name="hotel[name]">
                                                                        <input type="hidden" value="<?php echo $hotel['id']?>" name="hotel[id]">
                                                                        <input type="hidden" value="<?php echo $hotel['accommodationType']?>" name="hotel[accommodationType]">
                                                                        <input type="hidden" value="<?php echo $hotel['star']?>" name="hotel[star]">
                                                                        <input type="hidden" value="<?php echo $hotel['address']. '' . $hotel['city']?>" name="hotel[address]">
                                                                        <input type="hidden" value="<?php echo $rates['rateComment']?>" name="hotel[rateComment]">
                                                                        <input type="hidden" value="<?php echo $rates['rateType']?>" name="hotel[rateType]">
                                                                        <input type="hidden" value="<?php echo $rates['rateKey']?>" name="hotel[rateKey]">
                                                                        <input type="hidden" value="<?php echo $rates['sellingAmount']?>" name="hotel[sellingAmount]">
                                                                        <input type="hidden" value="<?php echo $rates['totalAmount']?>" name="hotel[totalAmount]">
                                                                        <input type="hidden" value="<?php echo $rates['cancellationPolicy']?>" name="hotel[cancellationPolicy]">
                                                                        <input type="hidden" value="<?php echo $rates['boardName']?>" name="hotel[boardName]">
                                                                        <input type="hidden" value="<?php echo $rooms['name']?>" name="hotel[roomName]">
                                                                        <input type="hidden" value='<?php echo json_encode($rates['dailyRates'])?>' name="hotel[dailyRates]">
                                                                        <input type="hidden" value='<?php echo $rates['netAmount']?>' name="hotel[netAmount]">

                                                                        <button type='submit' class="btn btn-primary" data-content="">Book Now</button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                    <?php endforeach;
                                                    endforeach;?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-12">
            <aside class="booking-filters text-white">
                <h3 style="font-size: 25px;">Filter By: </h3>
                <ul class="list booking-filters-list">

                    <?php if(COUNT($hotels['range'])):?>
                    <li id="fltrPrice" style="display: block">
                        <h5 style="font-size: 20px;" class="booking-filters-title">Price <input type="number" class="form-control" name="" id="numSearchFilter" value="<?php echo round($hotels['range'][1], 2) ?>" min="<?php echo round($hotels['range'][0], 2) ?>" max="<?php echo round($hotels['range'][1], 2) ?>" /></h5>
                        <span style="font-size: 15px; font-weight:bolder" id="spnFilterError" class="text-danger"></span>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6"><span class="pull-left" style="font-size: 17px;"><?php echo number_format($hotels['range'][0], 1) ?></span></div>
                                    <div class="col-md-6 pull-right"><span class="pull-right" style="font-size: 17px;"><?php echo number_format($hotels['range'][1], 2) ?></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="slider-range"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="font-size: 17px;">
                                Price Selected : <span id="spnPriceSliderSelected"></span>
                            </div>
                        </div>
                    </li>
                    <?php endif;?>

                    <li id="fltrStarRate">
                        <h5 style="font-size: 20px;" class="booking-filters-title">Ratings</h5>
                        <?php for($starsRating = 5; $starsRating >= 0; $starsRating--):?>
                        <div class="checkbox" >
                            <label>
                                <input class="i-check star-rate" type="checkbox" value="<?php echo $starsRating ?>" style="margin-left: 0px !important;"/>
                                <div class="booking-item-meta" style="overflow: hidden;">
                                    <div class="booking-item-rating" style="margin-bottom: 0px;">
                                        <ul class="icon-list icon-group booking-item-rating-stars" style="font-size: 17px;">
                                            <?php for($i=1; $i <=5; $i++ ):?>
                                                <?php if($i <= $starsRating):?>
                                                    <li><i class="fa fa-star"></i></li>
                                                <?php else: ?>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                        </ul>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <?php endfor; ?>
                    </li>

                    <?php if(COUNT($hotels['boardType'])):?>
                    <li id="fltrBoardType">
                        <h5 style="font-size: 20px;" class="booking-filters-title">Board Types</h5>
                        <?php foreach($hotels['boardType'] as $segmentBoard):?>
                        <div class="checkbox" style="margin-left: 0px !important;">
                            <label>
                                <input class="i-check boardType" type="checkbox" value="<?php echo $segmentBoard[0] ?>" style="margin-left: 0px;"/>
                                <div class="booking-item-meta" style="overflow: hidden;">
                                    <div class="booking-item-rating" style="margin-bottom: 0px;">
                                        <ul class="icon-list icon-group booking-item-rating-stars" style="font-size: 17px;">
                                            <?php //print_r($segmentBoard);
                                            $style = "";
                                            if(strlen($segmentBoard[0]) >= 18 and strlen($segmentBoard[1]) <= 20){
                                                $style = 'font-size: 14px;';
                                            }
                                            if(strlen($segmentBoard[1]) >= 21){
                                                $style = 'font-size: 12px;';
                                            }
                                            ?>
                                            <li style="<?php echo $style;?>"> <?php echo ucfirst(strtolower($segmentBoard[1]))?></li>
                                        </ul>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <?php endforeach;?>

                    </li>
                    <?php endif;?>

                    <?php if(COUNT($hotels['accommodations']) > 1):?>
                    <li id="fltrAccommodation">
                        <h5 style="font-size: 20px;" class="booking-filters-title">Accommodation Type</h5>
                        <?php foreach($hotels['accommodations'] as $key=>$accommodation):?>
                        <div class="checkbox">
                            <label>
                                <input class="i-check accommodation" type="checkbox" value="<?php echo $accommodation ?>" style="margin-left: 0px;"/>
                                <div class="booking-item-meta" style="overflow: hidden;">
                                    <div class="booking-item-rating" style="margin-bottom: 0px;">
                                        <ul class="icon-list icon-group booking-item-rating-stars" style="font-size: 17px;">
                                            <?php
                                            $style = "";
                                            if(strlen($accommodation) >= 18 and strlen($accommodation) <= 20){
                                                $style = 'font-size: 14px;';
                                            }
                                            if(strlen($accommodation) >= 21){
                                                $style = 'font-size: 12px;';
                                            }
                                            ?>
                                            <li style="<?php echo $style?>"><?php echo $accommodation ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <?php endforeach;?>
                    </li>
                    <?php endif?>
                </ul>
            </aside>
        </div>
    <?php 
    else:?>
        <div class="row">
            <h1> 
        </div>
    <?php endif;?>

    <div id="myModal" class="modal fade " tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h4><i style="color:#ed8323;" class="fa fa-exclamation-circle"></i> Important</h4>
                </div>
                <div class="modal-body">
                    <h4 id="msg">Session Expires!</h4>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div style="display: hidden"><a href="<?php echo BASE_URL()?>hotels/search_hotels" id="anchorHotel"></a></div>

<script>
    $(document).ready(function(){
        $('#availableHotelDisplay').on("click", ".view-more-prices", function(){
            if ($(this).closest('.booking-item-container').children('.booking-item').hasClass('active')) {
                $(this).closest('.booking-item-container').children('.booking-item').removeClass('active');
                $(this).closest('.booking-item-container').children('.booking-item').parent().removeClass('active');
            } else {
                $(this).closest('.booking-item-container').children('.booking-item').addClass('active');
                $(this).closest('.booking-item-container').children('.booking-item').parent().addClass('active');
                $(this).closest('.booking-item-container').children('.booking-item').delay(1500).queue(function() {
                    $(this).closest('.booking-item-container').children('.booking-item').addClass('viewed')
                });
            }
        });

        setInterval(function() {
            $('#myModal').modal({
                    show:true,
                    backdrop: 'static',
                    keyboard: false
                });
            setInterval(function() {
                window.location.replace("<?php echo BASE_URL()."hotels/search_hotels"?>");
            }, 10000);
        }, 600000);

        $("#slider-range").slider({
            min: <?php echo $hotels['range'][0];?>,
            max: <?php echo $hotels['range'][1];?>,
            value: <?php echo $hotels['range'][1];?>,
            change: function (event, ui) {
                commonFunctionhotelFilters();
            },
            slide: function (event, ui) {
                $("#numSearchFilter").val(ui.value);
                $('#spnPriceSliderSelected').text(ui.value);
            },
            create: function (event, ui) {
                $('#spnPriceSliderSelected').text(ui.value);
            }
        });

        $('#spnPriceSliderSelected').text(<?php echo $hotels['range'][1];?>);

        $('#fltrPrice').show();
        

        $(".booking-filters").delegate(".star-rate", "change", function(){
            commonFunctionhotelFilters();
        });

        $(".booking-filters").delegate(".boardType", "change", function(){
            commonFunctionhotelFilters();
        });

        $(".booking-filters").delegate(".accommodation", "change", function(){
            commonFunctionhotelFilters();
        });

        // $("#numSearchFilter").keydown(function(){
        //     setSearchFilterNumber($(this).val());
        // });

        // $("#numSearchFilter").keyup(function(){
        //     setSearchFilterNumber($(this).val());
        // });

        // $("#numSearchFilter").blur(function(){
        //     setSearchFilterNumber($(this).val());
        // });

        $("#numSearchFilter").change(function(){
            setSearchFilterNumber($(this).val());
        });

        function setSearchFilterNumber(searchAmountFilter)
        {
            searchAmountFilter = parseFloat(searchAmountFilter);
            var min = parseFloat(<?php echo $hotels['range'][0]; ?>).toFixed(2);
            var max = parseFloat(<?php echo $hotels['range'][1]; ?>).toFixed(2);

            if (searchAmountFilter >= min && searchAmountFilter <= max ) {
                $("#spnFilterError").text('');
                $('#spnPriceSliderSelected').text(searchAmountFilter);
                $("#slider-range").slider("value", searchAmountFilter);
                $("#slider-range").trigger('change');
            } else {
                var err = "";
                if(searchAmountFilter > max) {
                    err = "Filter amount is higher than the available prices";
                } else {
                    err = "Filter amount is lower than the available prices";
                }

                $("#spnFilterError").text(err);
            }

            commonFunctionhotelFilters();
        }

        function commonFunctionhotelFilters(){
            waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
            emptyBookingList(false);
            setTimeout(function () {
                filterHotels($('#hdnIsSearch').val() == 1 ? $('#toSearchHotelName').val():"");
                sortHotels();
            },2000);
        }

        function filterHotels(toSearchHotelName){
            var min = parseFloat(<?php echo $hotels['range'][0]; ?>).toFixed(2);
            var max = parseFloat(<?php echo $hotels['range'][1]; ?>).toFixed(2);
            var fltrStar    = getFilterStarRate('fltrStarRate');
            var fltrBoard   = getFilterStarRate('fltrBoardType');
            var fltrAccommodation = getFilterStarRate('fltrAccommodation');

            var fltrTotalCount = 0;
            var regExpStr = "";

            if(toSearchHotelName != ''){
                var arrSearch = toSearchHotelName.split(" ");
                var searchString ="";
                var res = [];
                for(i=0; i < arrSearch.length; i++){
                    searchString +=  (searchString != "" ? "|":"") + arrSearch[i];
                }
                regExpStr = new RegExp(searchString, 'igm');
            }

            // var sliderAmount = $( "#slider-range" ).slider("value");
            var sliderAmount = parseFloat($( "#numSearchFilter" ).val());
            $('.search-hotel').each(function(index, val){

                var isPassFltrStar  = false;
                var isPassFltrBoard = false;
                var isPassFltrHotelName = false;
                var isPassFltrAccommodation = false;
                var hasRoom = false;
                var i, x = 0;

                //  get hotel list id
                var roomTable = $(this).attr('id');
                if(roomTable == ''){
                    $(this).hide();
                    return true;
                }

                var action      = "";
                var selling     = 1000000;
                var allotment   = "";
                var sellingRate = "";
                var sellingRateArr = [];
                var offersPromotion = [];

                if($(this).attr('data-hotel_name') == '' || $(this).attr('id') == 'NoHotelAvailable'){
                    $(this).remove();
                    return true;
                }

                if (sliderAmount == "" || 
                   (sliderAmount < min || sliderAmount > max )
                ) {
                    $(this).hide();
                    return true;
                }

                if(fltrAccommodation.length > 0){
                    isPassFltrAccommodation = false;
                    for(i=0;i<fltrAccommodation.length;i++){
                        var accommodationType = $(this).attr('data-accommodationType').toString().toLowerCase();
                        var filterAccommodationType = fltrAccommodation[i].toLowerCase();
                        if( accommodationType == filterAccommodationType){
                            isPassFltrAccommodation = true;
                            break;
                        }
                    }
                }else{
                    isPassFltrAccommodation = true;
                }

                if(!isPassFltrAccommodation){
                    $(this).hide();
                    return true;
                }

                var hotelName = $(this).find('#hotelName').text();

                $(this).find('#hdnHotelRate').val(parseInt(selling));

                if(fltrStar.length > 0) {
                    var thisStar = $(this).attr('data-star');
                    for (x = 0; x < fltrStar.length; x++) {
                        if (fltrStar[x] == thisStar) {
                            isPassFltrStar = true;
                            break;
                        }
                    }
                }else {
                    isPassFltrStar = true;
                }

                if(!isPassFltrStar)
                {
                    $(this).hide();
                    return true;
                }

                if(fltrBoard.length > 0){
                    $('#'+roomTable + ' .booking-item-container .booking-item-details .details > tbody  > tr').each(function() {
                        var boardCode = $.trim($(this).attr('data-boardCode').toString().toLowerCase());
                        var isRoomPass = false;
                        var isPass,isPassDiscount = false;
                        for (i = 0; i < fltrBoard.length; i++) {
                            var dailyRoomSellingRate = parseFloat($(this).attr('data-amount'));
                            if ( boardCode == fltrBoard[i].toLowerCase() &&  (dailyRoomSellingRate <= parseFloat(sliderAmount))) {
                                isRoomPass = true;
                                isPass = true;
                                $(this).show();
                            } 
                        }

                        if( action == ''){
                            action = $(this).find('form').attr('action');
                            selling = $(this).attr('data-amount');
                            sellingRateArr = $(this).attr('data-dailySellingRateArr');
                            allotment = $(this).attr('data-allotment');
                        }else{
                            if(selling > parseInt($(this).attr('data-amount'))){
                                action = $(this).find('form').attr('action');
                                selling = parseInt($(this).attr('data-amount'));
                                sellingRateArr = $(this).attr('data-dailySellingRateArr');
                                allotment = $(this).attr('data-allotment');
                            }
                        }

                        if(!isRoomPass){
                            $(this).hide();
                        }else{
                            hasRoom = true;
                            $(this).show();
                        }
                    });

                    $('#frmBookNow' + roomTable).attr('action',action);
                    $('#dailySellingRate' + roomTable).text(Number(Math.ceil(sellingRate)).toLocaleString('en'));
                    $('#hdnDailySellingRate' + roomTable).val(sellingRateArr);
                    $('#allotment' + roomTable).text(allotment);
                    $('#offersPromotion' + roomTable).text(offersPromotion);
                }
                else{
                    $('#' + roomTable + ' .booking-item-container .booking-item-details .details > tbody  > tr').each(function() {
                        var dailyRoomSellingRate = parseFloat($(this).attr('data-amount'));
                        if( action == ''){
                            action = $(this).find('form').attr('action');
                            selling = $(this).attr('data-amount');
                            sellingRateArr = $(this).attr('data-dailySellingRateArr');
                            allotment = $(this).attr('data-allotment');
                        }else{
                            if(selling > parseInt($(this).attr('data-amount'))){
                                action = $(this).find('form').attr('action');
                                selling = parseInt($(this).attr('data-amount'));
                                sellingRateArr = $(this).attr('data-dailySellingRateArr');
                                allotment = $(this).attr('data-allotment');
                            }
                        }

                        if(dailyRoomSellingRate <= sliderAmount){
                            hasRoom = true;
                            $(this).show();
                        }else{
                            $(this).hide();
                        }
                    });

                    if (hasRoom) {
                        $('#frmBookNow' + roomTable).attr('action', action);
                        $('#dailySellingRate' + roomTable).text(selling);
                        $('#hdnDailySellingRate' + roomTable).text(sellingRateArr);
                        $('#allotment' + roomTable).text(allotment);
                        // $('#offersPromotion' + roomTable).text(offersPromotion);
                    }
                }

                if(!hasRoom){
                    $(this).hide();
                    return true;
                }

                $(this).find('#hdnHotelRate').val(parseInt(selling));

                if(toSearchHotelName != ""){
                    res = hotelName.match(regExpStr);
                    if(res != null && res != "" && res.length > 0){
                        isPassFltrHotelName = true;
                    }
                }else{
                    isPassFltrHotelName  = true;
                }

                if(!isPassFltrHotelName){
                    $(this).hide();
                    return true;
                }

                // if(isPassFltrStar &&  hasRoom && isPassFltrHotelName && isPassFltrZoneName && isPassFltrLandMark){
                if(isPassFltrStar &&  hasRoom && isPassFltrHotelName ){
                    $(this).show();
                    fltrTotalCount++;
                }

            });

        $('#spanHotelTotalCount').text(fltrTotalCount);
        if(fltrTotalCount == 0){
            $('.booking-list').append(
                "<li" +
                " id ='NoHotelAvailable' " +
                " class='search-hotel '"+
                " data-content=''" +
                " data-rate=''" +
                " data-star=''" +
                " data-hotel_name = ''" +
                " data-establishment = ''" +
                " data-accommodationType = ''" +
                " data-zonename = ''" +
                "> " +
                "<div class='booking-item-container'> " +
                "<div class='booking-item' style='border-radius: 5px'> " +
                "<div class='row'>" +
                "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>" +
                "<h3 class='text-center'> No Search Available </h3>" +
                "</div>" +
                "</div>" +
                "</div>" +
                "</div>" +
                "</li>"
            );
        }
    }

    function getFilterStarRate(filter){
        var selected = [];
        $('#' + filter + ' input:checked').each(function(){
            selected.push($(this).val());
        });

        return selected;
    }

    function emptyBookingList(isEmpty){
        //$('#toSearchHotelName').focus();
        if(isEmpty){
            $('.booking-list').html('');
        }
        $('#bookingListHotel').hide();
        $('#bookingListLoader').show();
    }

    function sortHotels(){
        var sortIs = $('.sort-label').text();
        if(sortIs == '(low to high)'){
            $("li.search-hotel").sort(sort_lowest).appendTo('.booking-list');
        }else{
            $("li.search-hotel").sort(sort_Highest).appendTo('.booking-list');
        }

        $('#bookingListHotel').show();
        $('#bookingListLoader').hide();
        // $('#toSearchHotelName').focusout();

        waitingDialog.hide();
    }

    function sort_lowest(a, b){
        return parseInt(($(b).find('#hdnHotelRate').val())) < parseInt(($(a).find('#hdnHotelRate').val())) ? 1 : -1;
    }

    function sort_Highest(a, b){
        return parseInt(($(b).find('#hdnHotelRate').val())) > parseInt(($(a).find('#hdnHotelRate').val())) ? 1 : -1;
    }
    $('#btnSearchHotelName').click(function(e){
        e.preventDefault();
        var toSearchHotelName = $('#toSearchHotelName').val();

        if($.trim(toSearchHotelName) != ""){
            $('#hdnIsSearch').val(1);
            commonFunctionhotelFilters()
        }else{
            $('#hdnIsSearch').val(0);
        }

    });

    $('#btnCancelSearchHotelName').click(function () {
        if($.trim(toSearchHotelName) != ""){
            $('#toSearchHotelName').val('');
            $('#hdnIsSearch').val(0);
            commonFunctionhotelFilters();
        }
    });
    });
</script>