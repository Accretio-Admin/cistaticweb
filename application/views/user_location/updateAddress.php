<!DOCTYPE html>
<html>
  <head>
      <style>
          /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
#map {
  height: 70%;
  width: 70%%;
}

/* Optional: Makes the sample page fill the window. */
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}

#description {
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
}

#infowindow-content .title {
  font-weight: bold;
}

#infowindow-content {
  display: none;
}

#map #infowindow-content {
  display: inline;
}
.pac-card {
  background-color: #fff;
  border: 0;
  border-radius: 2px;
  box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
  margin: 10px;
  padding: 0 0.5em;
  font: 400 18px Roboto, Arial, sans-serif;
  overflow: hidden;
  font-family: Roboto;
  padding: 0;
}

#pac-container {
  padding-bottom: 12px;
  margin-right: 12px;
}

.pac-controls {
  display: inline-block;
  padding: 5px 11px;
}

.pac-controls label {
  font-family: Roboto;
  font-size: 13px;
  font-weight: 300;
}

#pac-input {
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  margin-left: 12px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 400px;
  border-width: 1px;
  border: 1;
}
 

#title {
  color: #fff;
  background-color: #4d90fe;
  font-size: 25px;
  font-weight: 500;
  padding: 6px 12px;
}

#target {
  width: 345px;
}
      </style>
    <title>Places Search Box</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link rel="stylesheet" type="text/css" href="./style.css" />
    <script src="./index.js"></script>
  </head>
  <body> 
    <div class="contentpanel">
        <div class="row">
            <div class="col-xs-6 col-md-8">
                <label for="pac-input">Search Address</label>
            <input
            id="pac-input"
            class="form-control"
            type="text"
            placeholder="Search Box"
            autocomplete="off"
            />
                <div id="map"></div>
            </div>
            <div class="col-md-4">            
                              <b>UPDATE MY LOCATION INFORMATION</b>
                              <br /> 
                              <br />
                            <table class="table"> 
                                <tr hidden>
                                    <td>
                                        <b>LatLong</b>
                                    </td>
                                    <td>
                                        <input class="form-control input-sm"  required type="text" id="alatLong" value="<?php echo $locationService['latlong'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Country</b>
                                    </td>
                                    <td>
                                        <input class="form-control input-sm"  required type="text" id="aCountry" value="<?php echo $locationService['country'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Region</b>
                                    </td>
                                    <td>
                                    <input class="form-control input-sm"  required type="text" id="aRegion" value="<?php echo $locationService['region'] ?>">
                                    </td>
                                </tr> 
                                <tr>
                                    <td>
                                        <b>Province</b>
                                    </td>
                                    <td>
                                    <input class="form-control input-sm" required type="text" id="aProvince" value="<?php echo $locationService['province'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>City</b>
                                    </td>
                                    <td>
                                    <input class="form-control input-sm" required type="text" id="aCity" value="<?php echo $locationService['city'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Barangay</b>
                                    </td>
                                    <td>
                                    <input class="form-control input-sm"  required type="text" id="aBrgy" value="<?php echo $locationService['brgy'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Detailed Address</b>
                                    </td>
                                    <td>
                                    <input class="form-control input-sm"  required type="text" id="aDetailedAdd" value="<?php echo $locationService['detailedAdd'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button data-toggle="modal" data-target="#saveAddressChangesModal" type="button" id="setNewAddress" class="btn">SET</button>
                                    </td>
                                    <td>
                                        <button type="button" data-toggle="modal" class="btn cancel" data-target="#cancelAddressChangesModal">Cancel</button>
                                    </td>
                                </tr>
                            </table>
                        </div> 
        </div>
    </div>
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdTk1n5aZscA7r6N2HlavP_H8bigD8bFo&callback=initAutocomplete&libraries=places&v=weekly"
      async
    ></script>
  </body>
</html>

<!-- Modal -->
<div class="modal fade" id="saveAddressChangesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5 class="modal-title" id="exampleModalLabel">Save Changes?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" id="saveChangesInAddress" class="btn btn-secondary" data-dismiss="modal">Yes</button>
        <button type="button" data-dismiss="modal" class="btn btn-primary">No</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="cancelAddressChangesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to cancel? Changes you made will not be saved.</h5>
      </div>
      <div class="modal-footer">
        <button style="margin-bottom: 0px;" type="button" id="saveChangesInAddress" class="btn btn-primary" onclick="closeForm()" data-dismiss="modal">Yes</button>
        <button type="button" data-dismiss="modal" class="btn btn-primary">No</button>
      </div>
    </div>
  </div>
</div>

<script>
    // This example adds a search box to a map, using the Google Place Autocomplete
// feature. People can enter geographical searches. The search box will return a
// pick list containing a mix of places and predicted search terms.
// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
let marker ;
let geocoder;
let loadedApi = false;
function initAutocomplete() {
  getLocation();
  loadedApi = true;
  const map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: -33.8688, lng: 151.2195 },
    zoom: 18,
    mapTypeId: "satellite",
  });

   geocoder = new google.maps.Geocoder();
  const infowindow = new google.maps.InfoWindow();
  // Create the search box and link it to the UI element.
  const input = document.getElementById("pac-input");
  const searchBox = new google.maps.places.SearchBox(input);

  const input2 = document.getElementById("currectLocationName");
  const searchBox2 = new google.maps.places.SearchBox(input2);

  // Bias the SearchBox results towards current map's viewport.
  map.addListener("bounds_changed", () => {
    searchBox.setBounds(map.getBounds());
    searchBox2.setBounds(map.getBounds());
    zoom = 18;
  });

  let markers = [];
  searchBox2.addListener("places_changed", () => {
    const places2 = searchBox2.getPlaces();

    places2.forEach((place) => {
      if (!place.geometry || !place.geometry.location) {
        console.log("Returned place contains no geometry");
        return;
      }
 
      $("#currectLocation").val(place.geometry.location.lat()+","+place.geometry.location.lng());
      });
  });
  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener("places_changed", () => {
    const places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }

    // Clear out the old markers.
    markers.forEach((marker) => {
      marker.setMap(null);
    });
    markers = [];

    // For each place, get the icon, name and location.
    const bounds = new google.maps.LatLngBounds();

    places.forEach((place) => {
      if (!place.geometry || !place.geometry.location) {
        console.log("Returned place contains no geometry");
        return;
      }

      const icon = {
        url: "https://lh4.ggpht.com/4PPfsRjeb28pPWveMA3al1f_TL43VZ-vo_o4WR86D6HLjX3RkXGLFsVW8h4XXXM8Fl0F=w300",
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(50, 50),
      };
      marker = new google.maps.Marker({
          map,
          icon,
          title: place.name,
          draggable:true,
          position: place.geometry.location,
          title:"Drag me!"
        })
      // Create a marker for each place.
      markers.push(
        marker
      );
      google.maps.event.addListener(marker, 'dragend', function (evt) { 
        $("#alatLong").val(evt.latLng.lat().toFixed(6)+","+evt.latLng.lng().toFixed(6)); 
        geocodeLatLng(geocoder, map, infowindow, evt.latLng.lat().toFixed(6)+","+evt.latLng.lng().toFixed(6));
      });

      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        clearText();
        $("#alatLong").val(place.geometry.location); 
        
        geocodeLatLng(geocoder, map, infowindow, place.geometry.location.lat().toFixed(6)+","+place.geometry.location.lng().toFixed(6));
        map.setCenter(place.geometry.location);
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    map.fitBounds(bounds);
  });
}

function geocodeLatLng(geocoder, map, infowindow, latlong) {
  
  const input = latlong;
  const latlngStr = input.split(",", 2);
  const latlng = {
    lat: parseFloat(latlngStr[0]),
    lng: parseFloat(latlngStr[1]),
  };

  geocoder
    .geocode({ location: latlng })
    .then((response) => {
      if (response.results[0]) {
        map.setZoom(18);
        // const marker = new google.maps.Marker({
        //   position: latlng,
        //   map: map,
        // });
        $("#alatLong").val(latlngStr[0]+","+latlngStr[1]);
         
        for (x=0;x<response.results.length;x++) {
            if (response.results[x].types[0] == 'locality') {
                $("#aCity").val(response.results[x].address_components[0].long_name);
            } else if (response.results[x].types[0] == 'country') {
                $("#aCountry").val(response.results[x].address_components[0].long_name);
            } else if (response.results[x].types[0] == 'administrative_area_level_1') {
                $("#aRegion").val(response.results[x].address_components[0].long_name);
            } else if (response.results[x].types[0] == 'administrative_area_level_2') {
                $("#aProvince").val(response.results[x].address_components[0].long_name);
            }  else if (response.results[x].types[0] == 'administrative_area_level_5' || response.results[x].types[0] == 'neighborhood') {
                $("#aBrgy").val(response.results[x].address_components[0].long_name);
            } else if (response.results[x].types[0] == 'street_address' || response.results[x].types[0] == 'premise') {
                $("#aDetailedAdd").val(response.results[x].formatted_address);
            }
        }
        infowindow.setContent(response.results[0].formatted_address);
        infowindow.open(map, marker);
      } else {
        window.alert("No results found");
      }
    })
    .catch((e) => window.alert("Geocoder failed due to: " + e));
}

function getLocation() {
  if (navigator.geolocation) { 
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    alert("Geolocation is not supported by this browser.");
  }
}

function showPosition(position) {   
  var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
  geocoder.geocode({'latLng': latlng}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {  
        $("#currectLocationName").val(results[0].formatted_address);  
        $("#currectLocation").val(position.coords.latitude+","+position.coords.longitude);
    } else {
      alert("Geocoder failed due to: " + status);
    }
  }); 
}

function clearText() {
    $("#aCity").val("");
    $("#aCountry").val("");
    $("#aRegion").val("");
    $("#aProvince").val("");
    $("#alatLong").val("");
    $("#aBrgy").val("");
    $("#aDetailedAdd").val("");
}
</script>


<script>
    $( "#setNewAddress" ).click(function() {
      $("#aRegion").val() == '' ? $("#aRegion").val("N/A") : "";
      $("#aProvince").val() == '' ? $("#aProvince").val("N/A") : "";
      $("#aCity").val() == '' ? $("#aCity").val("N/A") : "";
      $("#aBrgy").val() == '' ? $("#aBrgy").val("N/A") : "";
    });
    $( "#saveChangesInAddress" ).click(function() {
        let alatLong = $("#alatLong").val();
        let aCountry = $("#aCountry").val();
        let aRegion = $("#aRegion").val();
        let aProvince = $("#aProvince").val();
        let aCity = $("#aCity").val();
        let aBrgy = $("#aBrgy").val();
        let aDetailedAdd = $("#aDetailedAdd").val();

        if (!alatLong || !aCountry || !aRegion || !aProvince || !aCity || !aBrgy || !aDetailedAdd) {
            alert("Empty Field Not Allowed");
        } else { 
            var parameter = {
                'latlong': JSON.stringify(alatLong),
                'country':aCountry,
                'region':aRegion,
                'province':aProvince,
                'city':aCity,
                'brgy':aBrgy,
                'detailedAdd':aDetailedAdd
            };
            $.ajax({
                url: '<?php echo BASE_URL().'Users_location'?>'+"/setNewSession",
                type: "POST",
                data: parameter,
                dataType: "json",
                cache: false,
                success: function (response) { 
                    if (response.S==1) {
                        alert("Full Address has been successfully set.");
                        $("#showUpdateAddress").html(aDetailedAdd);

                        $('#sdLatLong').html(alatLong)
                        $('#sdCountry').html(aCountry)
                        $('#sdRegion').html(aRegion)
                        $('#sdProvince').html(aProvince)
                        $('#sdCity').html(aCity)
                        $('#sdBrgy').html(aBrgy)
                        $('#sdDetailedAdd').html(aDetailedAdd)

                        closeForm();
                    } else {
                        alert(response.M);
                    }
                }
            });
        }
    });
</script>