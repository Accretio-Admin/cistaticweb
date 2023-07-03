<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false&amp;key=AIzaSyAjHe8ibJPWOsXBqGStWws_Ale4QwmVpBY"></script>
<div class="mainpanel">
  <div class="pageheader">
      <div class="media">
          <div class="pageicon pull-left">
              <i class="fa fa-book"></i>
          </div>
          <div class="media-body">
              <ul class="breadcrumb">
                  <li><a href="<?php echo BASE_URL()."hotels" ?>"><i class="glyphicon glyphicon-home"></i></a></li>
                  <li>Hotels</li>
              </ul>
              <h4>Hotel Booking</h4>
          </div>
      </div><!-- media -->
  </div><!-- pageheader -->
  
  <div class="contentpanel">
    <div class="row">
      <div class="col-md-12">
        <?php 
          $back = "hotels";
          if ($isSearch == 1):
            $back.="/search?sessionName=".$sessionName;
          endif;
        ?>
        <a href="<?php echo BASE_URL().$back; ?>" class="btn btn-default-alt" style="background-color: transparent;"> <span aria-hidden="true">←</span> BACK </a>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="row"> 
          <h2 class="lh1em"><?php echo $hotel['name'];?></h2>
          <p class="lh1em text-small"><i class="fa fa-building"></i> &nbsp; <?php echo $hotel['star'] > 1 ? $hotel['star']." Star":"" ?> <?php echo " " . $hotel['accommodationType']; ?></p>
          <p class="lh1em text-small"><i class="fa fa-map-marker"></i> &nbsp; <?php echo " " . $hotel['address']. '' . $hotel['city'] . ' ' . $hotel['postalCode']; ?></p>
          <ul class="list list-inline text-small">
            <li>
              <a href="mailto:<?php echo $hotel['emailAddress']; ?>"><i class="fa fa-envelope"></i> &nbsp; <?php echo $hotel['emailAddress']; ?> </a>
            </li>
            <?php if(isset($hotel['website'])){
              $urlStr = '';
              $parsed = parse_url($hotel['website']);
              if (empty($parsed['scheme'])) {
                $urlStr = 'http://' . ltrim($hotel['website'], '/');
              }
              ?>
              <li><a href="<?php echo $urlStr?>" target="_blank"><i class="fa fa-home"></i> &nbsp; <?php echo $urlStr?></a><?php }?></li>
              <?php if(isset($hotel['phoneNumber'])){ ?>
                <li><i class="fa fa-phone"></i> <?php echo $hotel['phoneNumber']?></li>
              <?php }?>
            </ul>
        </div>

        <div class="row"> 
          <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a href="#tab-1" data-toggle="tab"><i class="fa fa-camera"></i>Photos</a></li>
            <li><a href="#google-map-tab" data-toggle="tab"><i class="fa fa-map-marker"></i>On the Map</a></li>
            <!-- {{--<li><a href="#tab-3" data-toggle="tab"><i class="fa fa-signal"></i>Rating</a></li>--}} -->
            <li><a href="#tab-4" data-toggle="tab"><i class="fa fa-asterisk"></i>Facilities</a></li>
            <?php if(isset($hotel['interestPoints']) && count($hotel['interestPoints'])):?>
              <li><a href="#tab-5" data-toggle="tab"><i class="fa fa-asterisk"></i>Interesting Point</a></li>
            <?php endif;?>
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade in active" id="tab-1">
              <div class="row">
                <div class="col-md-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="fotorama" data-allowfullscreen="true" data-nav="thumbs">
                    <?php foreach($hotel['images'] as $keys=>$images): 
                        if($keys < 15) {
                          echo '<img src="http://photos.hotelbeds.com/giata/bigger/'.$images['path'].'" alt="'.$hotel['name'].'" title="'.$hotel['name'].'" />';
                        } else {
                          break;
                        }
                    endforeach;?>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="tab-pane fade" id="google-map-tab">
              <div id="map-canvas" long="<?php echo $hotel['longitude']?>" lat="<?php echo $hotel['latitude']?>" style="width:100%; height:500px;"></div>
            </div>
            
            <div class="tab-pane fade" id="tab-4">
              <div class="row mt20">
                <?php if(isset($hotel['facilities'])):?>
                  <?php if(COUNT($hotel['facilities']["arrFacility"])):?>
                    <table class="table">
                      <thead>
                        <tr>
                          <th colspan="6" style="text-align: center"><h3>Hotel Facility</h3></th>
                        </tr>
                        <tr>
                          <th>Description</th>
                          <th>Exist in Hotel</th>
                          <th>Available</th>
                          <th>Include in Payment</th>
                          <th>From Time</th>
                          <th>To Time</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach($hotel['facilities']["arrFacility"] as $value):?>
                      <tr>
                        <td><?php echo $value["name"]?></td>
                        <td>
                          <?php  $fa = ' - ';
                            if($value["indYesOrNo"] != null){
                              $fa = 'times';
                              if(json_encode($value["indYesOrNo"]) == 'true'){
                                $fa = 'check';
                              }
                              $fa = "<i class='fa fa-".$fa."'></i>";
                            }
                            echo $fa;
                          ?>
                        </td>
                        <td>
                            <?php 
                              $fa = ' - ';
                              if($value["indLogic"] != null):  
                                if(json_encode($value["indLogic"]) == 'true'):
                                  $fa = 'check';
                                else:
                                  $fa = 'times';
                                endif;
                                $fa = "<i class='fa fa-".$fa."'></i>";
                              endif;
                                echo $fa;
                            ?>
                        </td>
                        <td>
                            <?php 
                              $fa = ' - ';
                              if($value["endFree"] != null):  
                                if(json_encode($value["endFree"]) == 'true'):
                                  $fa = 'check';
                                else:
                                  $fa = 'times';
                                endif;
                                $fa = "<i class='fa fa-".$fa."'></i>";
                              endif;
                                echo $fa;
                            ?>
                        </td>
                        <td><?php $value["timeFrom"] != null ? $value["timeFrom"]:' - '?></td>
                        <td><?php $value["timeTo"] != null ? $value["timeTo"]:' - '?></td>
                      </tr>
                      <?php endforeach;?>
                    </tbody>
                    </table>
                  <?php endif;?>
                  <?php if(COUNT($hotel['facilities']["roomFacilties"])):?>
                    <table class="table">
                      <thead>
                        <tr>
                          <th colspan="4" style="text-align: center"><h3>Room Facility</h3></th>
                        </tr>
                        <tr>
                          <th>Description</th>
                          <th>Exist in Hotel</th>
                          <th>Available</th>
                          <th>Include in Payment</th>
                        </tr>
                      </thead>
                      <?php foreach($hotel['facilities']["roomFacilties"] as $value):?>
                      <tr>
                        <td><?php echo $value["name"]?></td>
                        <td>
                          <?php 
                              $fa = ' - ';
                              if($value["indLogic"] != null):  
                                if(json_encode($value["indLogic"]) == 'true'):
                                  $fa = 'check';
                                else:
                                  $fa = 'times';
                                endif;
                                $fa = "<i class='fa fa-".$fa."'></i>";
                              endif;
                              echo $fa;
                            ?>
                        </td>
                          <td>
                            <?php 
                              $fa = ' - ';
                              if($value["indYesOrNo"] != null):  
                                if(json_encode($value["indYesOrNo"]) == 'true'):
                                  $fa = 'check';
                                else:
                                  $fa = 'times';
                                endif;
                                $fa = "<i class='fa fa-".$fa."'></i>";
                              endif;
                              echo $fa;
                            ?>
                          </td>
                          <td>
                            <?php 
                              $fa = ' - ';
                              if($value["indFee"] != null):  
                                if(json_encode($value["indFee"]) == 'true'):
                                  $fa = 'check';
                                else:
                                  $fa = 'times';
                                endif;
                                $fa = "<i class='fa fa-".$fa."'></i>";
                              endif;
                              echo $fa;
                            ?>
                          </td>
                        </tr>
                        <?php endforeach;?>
                      </table>
                  <?php endif;?>
                  <?php if(COUNT($hotel['facilities']["roomDistribution"])):?>
                    <table class="table">
                      <thead>
                        <tr>
                          <th colspan="4" style="text-align: center"><h3>Room Distribution</h3></th>
                        </tr>
                        <tr>
                          <th>Description</th>
                          <th>Exist in Hotel</th>
                          <th>Available</th>
                          <th>Include in Payment</th>
                        </tr>
                      </thead>
                      <?php foreach($hotel['facilities']["roomDistribution"] as $value):?>
                        <tr>
                          <td><?php $value["name"]?></td>
                          <td>
                            <?php $fa = ' - ';
                            if($value["indLogic"] != null){
                              $fa = 'check';
                              if(json_encode($value["indLogic"]) != 'true'){

                                $fa = 'times';
                              }
                              $fa = "<i class='fa fa-".$fa."'></i>";
                            }
                            echo $fa; ?>
                          </td>
                          <td>
                            <?php $fa = ' - ';
                              if($value["indYesOrNo"] != null){
                                $fa = 'check';
                                if(json_encode($value["indYesOrNo"]) != 'true'){

                                  $fa = 'times';
                                }
                                $fa = "<i class='fa fa-".$fa."'></i>";
                              }
                              echo $fa; ?>
                        </td>
                        <td>
                          <?php $fa = ' - ';
                            if($value["indFee"] != null){
                              $fa = 'check';
                              if(json_encode($value["indFee"]) != 'true'){

                                $fa = 'times';
                              }
                              $fa = "<i class='fa fa-".$fa."'></i>";
                            }
                            echo $fa; ?>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                    </table>
                  <?php endif; ?>
                  <?php if(COUNT($hotel['facilities']["roomDistributionAlternative"])):?>
                    <table class="table">
                      <thead>
                        <tr>
                          <th colspan="4" style="text-align: center"><h3>Room Distribution Alternatives</h3></th>
                        </tr>
                        <tr>
                          <th>Description</th>
                          <th>Exist in Hotel</th>
                          <th>Available</th>
                          <th>Include in Payment</th>
                        </tr>
                      </thead>
                      <?php foreach($hotel['facilities']["roomDistributionAlternative"] as $value):?>
                        <tr>
                          <td><?php echo $value["name"]?></td>
                          <td>
                            <?php 
                              $fa = ' - ';
                              if(json_encode($value["indLogic"]) == 'true' or json_encode($value["indLogic"]) == 'false'):  
                                if(json_encode($value["indYesOrNo"]) == 'true'):
                                  $fa = 'check';
                                else:
                                  $fa = 'times';
                                endif;
                                $fa = "<i class='fa fa-".$fa."'></i>";
                              endif;
                              echo $fa;
                            ?>
                          </td>
                          <td>
                            <?php 
                              $fa = ' - ';
                              if(json_encode($value["indYesOrNo"]) == 'true' or json_encode($value["indYesOrNo"]) == 'false'):  
                                if(json_encode($value["indYesOrNo"]) == 'true'):
                                  $fa = 'check';
                                else:
                                  $fa = 'times';
                                endif;
                                $fa = "<i class='fa fa-".$fa."'></i>";
                              endif;
                              echo $fa;
                            ?>
                          </td>
                          <td>
                            <?php 
                              $fa = ' - ';
                              if(json_encode($value["indFee"]) != "null"):  
                                if(json_encode($value["indYesOrNo"]) == 'true'):
                                  $fa = 'check';
                                else:
                                  $fa = 'times';
                                endif;
                                $fa = "<i class='fa fa-".$fa."'></i>";
                              endif;
                              echo $fa;
                            ?>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </table>
                  <?php endif; ?>
                  <?php if(COUNT($hotel['facilities']["business"])): ?>
                    <table class="table">
                      <thead>
                        <tr>
                          <th colspan="3" style="text-align: center"><h3>Business Facility</h3></th>
                        </tr>
                        <tr>
                          <th>Description</th>
                          <th>Exist in Hotel</th>
                          <th>Include in Payment</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($hotel['facilities']["business"] as $value):?>
                        <tr>
                          <th><?php echo $value["name"]?></th>
                          <th>
                            <?php
                            $fa = ' - '; 
                            if($value["indLogic"] != null){
                              $fa = 'times';
                              if(json_encode($value["indYesOrNo"]) == 'true'):
                                  $fa = 'check';
                              endif;
                              $fa = "<i class='fa fa-".$fa."'></i>";
                            } 
                            echo $fa;
                            ?>
                          </th></th>
                          <th>
                            <?php
                            $fa = ' - '; 
                            if($value["indFee"] != null){
                              $fa = 'times';
                              if(json_encode($value["indFee"]) == 'true'):
                                  $fa = 'check';
                              endif;
                              $fa = "<i class='fa fa-".$fa."'></i>";
                            } 
                            echo $fa;
                            ?>
                          </th>
                        </tr>
                        <?php endforeach?>
                      </tbody>
                    </table>
                  <?php endif; ?>
                  <?php if(COUNT($hotel['facilities']["catering"]))?>
                    <table class="table">
                      <thead>
                        <tr>
                          <th colspan="2" style="text-align: center"><h3>Catering Facility</h3></th>
                        </tr>
                        <tr>
                          <th>Description</th>
                          <th>Exist in Hotel</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($hotel['facilities']["catering"] as $value): ?>
                          <tr>
                            <th><?php echo $value["name"]?></th>
                            <th>
                              <?php
                              $fa = ' - '; 
                              if($value["indLogic"] != null){
                                $fa = 'times';
                                if(json_encode($value["indLogic"]) == 'true'):
                                  $fa = 'check';
                                endif;
                                $fa = "<i class='fa fa-".$fa."'></i>";
                              } 
                              echo $fa;
                              ?>
                            </th>
                          </tr>
                        <?php endforeach;?>
                      </tbody>
                    </table>
                  <?php endif?>
                  <?php if(COUNT($hotel['facilities']["entertainment"])): ?>
                    <table class="table">
                      <thead>
                        <tr>
                          <th colspan="4" style="text-align: center"><h3>Entertainment Facility</h3></th>
                        </tr>
                        <tr>
                          <th>Description</th>
                          <th>Exist in Hotel</th>
                          <th>Include in Payment</th>
                          <th>Number</th>
                        </tr>
                      </thead>
                      <?php foreach($hotel['facilities']["entertainment"] as $value): ?>
                        <tr>
                          <td><?php echo $value["name"]?></td>
                          <td>
                            <?php
                            $fa = ' - '; 
                            if($value["indLogic"] != null){
                              $fa = 'times';
                              if(json_encode($value["indLogic"]) == 'true'):
                                $fa = 'check';
                              endif;
                              $fa = "<i class='fa fa-".$fa."'></i>";
                            } 
                            echo $fa;
                            ?>
                          </td>
                          <td>
                            <?php
                            $fa = ' - '; 
                            if($value["indFee"] != null){
                              $fa = 'times';
                              if(json_encode($value["indLogic"]) == 'true'):
                                $fa = 'check';
                              endif;
                              $fa = "<i class='fa fa-".$fa."'></i>";
                            } 
                            echo $fa;
                            ?>
                          </td>
                          <td><?php isset($value["number"]) ? $value["number"]: ' - '?></td>
                        </tr>
                      <?php endforeach?>
                    </table>
                  <?php endif;?>
                  <?php if(COUNT($hotel['facilities']["health"])): ?>
                    <table class="table">
                      <thead>
                        <tr>
                          <th colspan="4" style="text-align: center"><h3>Health Facility</h3></th>
                        </tr>
                        <tr>
                          <th>Description</th>
                          <th>Exist in Hotel</th>
                          <th>Include in Payment</th>
                        </tr>
                      </thead>
                      <?php foreach($hotel['facilities']["health"] as $value):?>
                        <tr>
                          <td><?php $value["name"]?></td>
                          <td>
                            <?php
                            $fa = ' - '; 
                            if($value["indLogic"] != null){
                              $fa = 'times';
                              if(json_encode($value["indLogic"]) == 'true'):
                                $fa = 'check';
                              endif;
                              $fa = "<i class='fa fa-".$fa."'></i>";
                            } 
                            echo $fa;
                            ?>
                          </td>
                          <td>
                            <?php
                            $fa = ' - '; 
                            if($value["indFee"] != null){
                              $fa = 'times';
                              if(json_encode($value["indLogic"]) == 'true'):
                                $fa = 'check';
                              endif;
                              $fa = "<i class='fa fa-".$fa."'></i>";
                            } 
                            echo $fa;
                            ?>
                          </td>
                        </tr>
                      <?php endforeach ?>
                    </table>
                  <?php endif; ?>
                  <?php  if(COUNT($hotel['facilities']["sports"])): ?>
                    <table class="table">
                      <thead>
                        <tr>
                          <th colspan="4" style="text-align: center"><h3>Sport Facility</h3></th>
                        </tr>
                        <tr>
                          <th>Description</th>
                          <th>Exist in Hotel</th>
                          <th>Include in Payment</th>
                        </tr>
                      </thead>
                      <?php foreach($hotel['facilities']["sports"] as $value):?>
                        <tr>
                          <td><?php echo$value["name"]?></td>
                          <td>
                            <?php
                            $fa = ' - '; 
                            if($value["indLogic"] != null){
                              $fa = 'times';
                              if(json_encode($value["indLogic"]) == 'true'):
                                $fa = 'check';
                              endif;
                              $fa = "<i class='fa fa-".$fa."'></i>";
                            } 
                            echo $fa;
                            ?>
                          </td>
                          <td>
                            <?php
                            $fa = ' - '; 
                            if($value["indFee"] != null){
                              $fa = 'times';
                              if(json_encode($value["indFee"]) == 'true'):
                                $fa = 'check';
                              endif;
                              $fa = "<i class='fa fa-".$fa."'></i>";
                            } 
                            echo $fa;
                            ?>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </table>
                  <?php endif;?>
                  <!-- < ?php if(COUNT($hotel['facilities']["distances"])):?> -->
                  <?php if(COUNT($hotel['facilities']["distances"] < 0)):?>
                    <table class="table">
                      <thead>
                        <tr>
                          <th colspan="2" style="text-align: center"><h3>Others</h3></th>
                        </tr>
                        <tr>
                          <th>Description</th>
                          <th>Distance</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($hotel['facilities']["distances"] as $value):?>
                          <tr>
                            <td><?php echo $value["name"]?></td>
                            <td>
                              <?php echo $value["distance"] . " KMS"?>
                            </td>
                          </tr>
                        <?php endforeach;?>
                      </tbody>
                    </table>
                  <?php endif?>
                  <?php if(COUNT($hotel['facilities']["roomDistribution"])):?>  
                    <table class="table">
                      <thead>
                        <tr>
                          <th colspan="2" style="text-align: center"><h3>Others</h3></th>
                        </tr>
                        <tr>
                          <th>Description</th>
                          <th>Exist in Hotel</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($hotel['facilities']["roomDistribution"] as $value):?>
                          <tr>
                            <td><?php echo $value["name"]?></td>
                            <td>
                              <?php
                              $fa = ' - '; 
                              if($value["indYesOrNo"] != null){
                                $fa = 'times';
                                if(json_encode($value["indYesOrNo"]) == 'true'):
                                  $fa = 'check';
                                endif;
                                $fa = "<i class='fa fa-".$fa."'></i>";
                              } 
                              echo $fa;
                              ?>
                            </td>
                          </tr>
                        <?php endforeach?>
                      </tbody>
                    </table>
                  <?php endif;?>
              </div>
            </div>
            
            <?php if(isset($hotel['interestPoints'])):?>
            <div class="tab-pane fade" id="tab-5" style="overflow: hidden;">

              <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="row mt20">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h4 class="lhem"><i class="fa fa-map-marker"></i> Tourist Attraction</h4>
                    <div class="row">
                      <div class="col-xs-6 booking-item-feature-title"><h5>Interest Point</h5></div>
                      <div class="col-xs-6 booking-item-raiting-list-number"><h5> Distance</h5></div>
                    </div>
                    <?php foreach($hotel['interestPoints'] as $interestPoint):?>
                      <div class="row">
                        <div class="col-xs-6 booking-item-feature-title"><?php echo $interestPoint['poiName']?></div>
                        <div class="col-xs-6 booking-item-raiting-list-number"><?php echo $interestPoint['distance']/1000 . " KMS"?></div>
                      </div>
                    <?php endforeach?>
                  </div>
                </div>
              </div>
                                                        
            </div>
            <?php endif;?>
          </div>
        </div>

        <div class="row">
          <br/>
          <hr />

          <h3>About The <?php echo $hotel['name'];?></h3>
          <div class="booking-item-rating">
            <ul class="icon-group booking-item-rating-stars" style="font-size: 28px; text-decoration: none;">
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
            <span style="display: none" id="hotelStar"><?php echo $hotel['star'] ?></span>
          </div>
          <br/>
          <?php print_r($hotel['description']); ?>

          <hr/>
        </div>

        <div class="row">
          <br />
          <ul class="booking-item-features booking-item-features-expand clearfix">
            <?php if(isset($hotel['segments'])): ?>
              <li>
                <i class="fa fa-2x fa-hashtag"></i><span class="booking-item-feature-title">Others</span>
                <span style='color:#ed8323;font-size: 12px'>
                  <?php $segTags = "";
                  foreach($hotel['segments'] as $segment):
                    if($segTags == ""):
                      echo $segment['description']['content'];
                    $segTags = $segment['description']['content'];
                    else:
                      echo " / ".$segment['description']['content'];
                    endif;
                  endforeach;
                  ?>
                </span>
              <?php endif; ?>
              <?php if(isset($hotels->boards)):?>
              <li>
                <i class="fa fa-2x fa-plus-square-o"></i><span class="booking-item-feature-title">Rooms</span>
                <span style='color:#ed8323;font-size: 12px'>
                  <?php $segTags = "";
                  foreach($hotels->boards as $boards):
                    if($segTags == ""):
                      echo $boards->description->content;
                      $segTags = $boards->description->content;
                    else:
                      echo " / ".$boards->description->content;
                    endif;
                  endforeach?>
                </span>
              </li>
              <?php endif;?>
              <!-- <li>
                <i class="fa fa-2x fa-credit-card"></i><span class="booking-item-feature-title">Payment</span>
                <span style='color:#ed8323;font-size: 12px'>
                  < ?php $segTags = "";
                  foreach($hotel['facilities']["methodOfPayment"] as $payment):
                    if($segTags == ""):
                      echo $payment["name"];
                      $segTags = $payment["name"];
                    else:
                      echo " / ".$payment["name"];
                    endif;
                  endforeach?>
                </span>
              </li> -->
              <?php if(isset($hotel['facilities']["meals"]) and COUNT($facilities["meals"])):?>
              <li>
                <i class="fa fa-2x fa-cutlery"></i><span class="booking-item-feature-title">Meals</span>
                <span style='color:#ed8323;font-size: 12px'>
                  <?php $segTags = "";
                    foreach($hotel['facilities']["meals"] as $meals):
                      if($segTags == ""):
                        echo $meals["name"];
                        $segTags = $meals["name"];
                      else:
                        echo " / ".$meals["name"];
                      endif;
                  endforeach; ?>
                </span>
              </li>
              <?php endif; ?>
              <?php if(COUNT($hotel['facilities']["TKM"])):?>
              <li>
                <i class="fa fa-2x fa-exclamation-circle"></i><span class="booking-item-feature-title">Things To keep in mind</span>
                <span style='color:#ed8323;font-size: 12px'>
                  <?php $segTags = "";
                    foreach($hotel['facilities']["TKM"] as $TKM):
                      if($segTags == ""):
                        echo $TKM["name"]; echo (isset($TKM["number"]) ? $TKM["number"]:'');
                        $segTags = $TKM["name"];
                      else:
                        echo " / "; echo $TKM["name"]; echo (isset($TKM["number"]) ? $TKM["number"]:'');
                      endif;
                  endforeach?>
                </span>
              </li>
              <?php endif?>
              <?php if(COUNT($hotel['facilities']["greenProgramWorldWide"])):?>
              <li>
                <i class="fa fa-2x fa-bookmark"></i><span class="booking-item-feature-title">Program</span>
                <span style='color:#ed8323;font-size: 12px'>
                  <?php $segTags = "";
                    foreach($hotel['facilities']["greenProgramWorldWide"] as $greenProgramWorldWide):
                      if($segTags == ""):
                        echo $greenProgramWorldWide["name"]; echo (isset($greenProgramWorldWide["number"]) ? $greenProgramWorldWide["number"]:'');
                        $segTags = $greenProgramWorldWide["name"];
                      else:
                        echo " / "; echo $greenProgramWorldWide["name"]; echo (isset($greenProgramWorldWide["number"]) ? $greenProgramWorldWide["number"]:'');
                      endif;
                  endforeach?>
                </span>
              </li>
              <?php endif?>
            </ul>
          <hr/>
        </div>

        <div class="row">
          <br />
          <!-- width="100%" height="100%" style="width: 100%; min-height: 100%; overflow: hidden;border: none" -->
          <iframe class="frame" src="https://www.tripadvisor.com/WidgetEmbed-cdspropertydetail?display=true&partnerId=6CA95E2409844D6183003CEFCDDC2BDE&lang=en&locationId=<?php echo $hotel['id']?>" scrolling="no"></iframe>
        </div>
      </div>

      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <ul class="booking-list" id="bookingListHotel">
          <?php 
          foreach($hotel['rooms'] as $rKey=>$rooms):?>
            <li>
              <div class="booking-item-container">
                <div class="booking-item" style="border-radius: 5px">
                  <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12">
                      <h4 style="text-align: center;vertical-align:middle"><?php echo $rooms['name'];?></h4>
                    </div>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <?php foreach ($rooms['rates'] as $key => $rates):?>
                        <form action="<?php echo BASE_URL()."hotels/book_now/".$sessionName ?>" method="POST" class="frmclass">
                          <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12" style="text-align: center;">
                              <p><b><?php echo number_format($rates['totalAmount'], 2)?></b></p>
                              <?php echo $rates['boardName']?>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12" style="text-align: center;">

                              <input type="hidden" value="<?php echo $hotel['name']?>" name="hotel[name]">
                              <input type="hidden" value="<?php echo $hotel['id']?>" name="hotel[id]">
                              <input type="hidden" value="<?php echo $hotel['accommodationType']?>" name="hotel[accommodationType]">
                              <input type="hidden" value="<?php echo $hotel['star']?>" name="hotel[star]">
                              <input type="hidden" value="<?php echo $hotel['address']. '' . $hotel['city'] .' '.$hotel['']?>" name="hotel[address]">
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
                              <input type="hidden" value='<?php echo $rates['rateClass']?>' name="hotel[rateClass]">
                              
                              <button class="btn btn-xs btn-primary" type="submit">Book Now</button>
                              <p>
                                <?php echo $rates['allotment'] . " room".strtolower($rates['allotmentSingular'])." available"?>
                              </p>
                            </div>
                          </div>
                        </form>
                      <?php endforeach ?>
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
            <!-- <button class="btn btn-primary btn-block" id="btnAgreePayPal">Agree</button>
              <button class="btn btn-danger btn-block" id="btnDisagree" data-dismiss="modal">Back</button> -->
        </div>
      </div>
      </div>
  </div>

  <script type="text/javascript">
    if ($('#map-canvas').length) {
    var map, service;

    var long = $('#map-canvas').attr('long');
    var lat = $('#map-canvas').attr('lat');

    jQuery(function($) {
        $(document).ready(function() {
            var latlng = new google.maps.LatLng(lat,long);
            var myOptions = {
                zoom: 16,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                scrollwheel: false
            };
            // var minLeft = < ?php echo ?>

            map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);

            var marker = new google.maps.Marker({
                position: latlng,
                map: map
            });
            marker.setMap(map);

            $('a[href="#google-map-tab"]').on('shown.bs.tab', function(e) {
                google.maps.event.trigger(map, 'resize');
                map.setCenter(latlng);
            });

            setInterval(function() {
              $('#myModal').modal({
                show:true,
                backdrop: 'static',
                keyboard: false
               });
              window.location.replace("<?php echo BASE_URL()."hotels"?>");
            }, 600000);

        });
    });
}
  </script>
  <style>
  .frame {
  display: block;
  width: 100vw;
  height: 100vh;
  max-width: 100%;
  margin: 0;
  padding: 0;
  border: 0 none;
  box-sizing: border-box;
}

.fotorama__stage{
  margin-bottom: -90px;
}
</style>
</div>