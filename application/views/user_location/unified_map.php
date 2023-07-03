
<!DOCTYPE html>
<html>
  <head>
      <style>
          /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
#map {
  height: 100%;
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
      <style>
    <style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none; 
  padding-top: 50px; 
  margin: 50px;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1; 
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 100%; 
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
} 
  .float-child-div {
    float: left;
    padding: 20px;
  }  

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100px;
  margin-bottom:10px;
  opacity: 0.8;
}
#first
{ 
    position:absolute;
    height:100%;
    width:100%;
    bottom:0;
    left:0;
    right:0;
    top:0;  
    opacity:0.5;
    background-color:#000;
    color:#fff;
    z-index:9999;
}

.load
{
    height:100%;
    width:100%;
}

img
{
    height:100%;
    width:100%;
    position:absolute; 
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}

.tdetails {
  padding: 5px,
  margin: 5px
}

#modalMapframe .modal-header button {
  background-color: transparent !important;
  border: 0 !important;
}

.tableUnifiedMap input {
  height: 44px!important;
  font-size: 16px !important;
  font-weight: 500 !important;
  border-radius: 8 px;
  border: 1 px solid #d9d9d9;
  margin-bottom: 10 px !important;
}

/* .tableUnifiedMap #btnDirection {
  background-color: #f0a30d !important;
  color: white !important;
} */

.tableUnifiedMap #btnReverse {
  font-size: 30px;
  color: #ffffff;
  /* background-color: #f0a30d; */
}
</style>
 
    <title>MAP</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script> 
  </head> 
  <body>  
    <div class="contentpanel"> 
    <nav class="navbar navbar-expand-lg">
        
        <div class="container">
        <div class="row"> 
            <div class="col-md-12">
            <!-- <div id="first">
              <img src="http://i.stack.imgur.com/XEupj.gif">
            </div> -->

              <table  class="table table-bordered tableUnifiedMap">  
                <tr>
                  <tr>
                    <td>Account Type:</td>
                    <td><input class="form-control col-xs-3" disabled id="idAccountType" type="search" placeholder="Search" aria-label="Search"></td>
                  </tr>
                  <tr>
                    <td>Outlet Name:</td>
                    <td><input class="form-control col-xs-3" disabled id="idOutletName" type="search" placeholder="Search" aria-label="Search"></td>
                  </tr>
                  <tr>
                    <td>Full Address:</td>
                    <td><input class="form-control col-xs-3" disabled id="idFulladdress" type="search" placeholder="Search" aria-label="Search"></td>
                  </tr>
                  <tr>
                    <td>Store Hours:</td>
                    <td><input class="form-control col-xs-3" disabled id="idStoreHours" type="search" placeholder="Search" aria-label="Search"></td>
                  </tr>
                  <tr>
                    <td>Store Email:</td>
                    <td><input class="form-control col-xs-3" disabled id="idStoreEmail" type="search" placeholder="Search" aria-label="Search"></td>
                  </tr><tr>
                    <td>Contact Number:</td>
                    <td><input class="form-control col-xs-3" disabled id="idContactNumber" type="search" placeholder="Search" aria-label="Search"></td>
                  </tr>
                </tr> 
                
                <tr hidden class="hid">  
                  <td>
                    <label for="idCurLocation">Starting Point</label>
                    <input class="form-control col-xs-3" id="idCurLocation" type="hidden" placeholder="Search" aria-label="Search"> 
                    <input class="form-control col-xs-3" id="idCurLocationName" type="search" placeholder="Search" aria-label="Search"> 
                  </td> 
                  <td style="text-align: center; padding-top: 15px;">
                      <i id="btnReverse" class="fa fa-exchange btn btn-outline-success btn btn-warning my-2 my-sm-0" aria-hidden="true"> 
                      </i>
                    </td> 
                  <td> 
                    <label for="idDestination">Destination Point</label>
                    <input class="form-control col-xs-3" disabled id="idDestination" type="hidden" placeholder="Search" aria-label="Search">
                    <input class="form-control col-xs-3" disabled id="idDestinationName" type="search" placeholder="Search" aria-label="Search">
                  </td> 
                </tr>
                <tr hidden class="hid">  
                  <td>
                  <strong>MODE:</strong>
                  <select class="btn btn-secondary" id="mode">
                    <option value="DRIVING">Driving</option>
                    <option value="WALKING">Walking</option>
                    <option value="BICYCLING">Bicycling</option>
                    <option value="TRANSIT">Transit</option>
                  </select>
                  </td>
                  <td style="text-align:center"> 
                    <input id="btnSearch" class="btn btn-outline-success btn btn-warning my-2 my-sm-0" value="SEARCH" type="button">
                  </td>
                  <td>
                    <input id="btnNearby" class="btn btn-outline-success btn btn-secondary my-2 my-sm-0" value="NEARBY OUTLET" type="hidden">
                  </td>
                </tr>
                <tr>   
                  <td> 
                    <input id="btnDirection" disabled class="btn btn-outline-success btn btn-warning my-2 my-sm-0" value="DIRECTION" type="button">
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </nav>
        <div hidden class="row hidMap"> 
              <div class="col-md-12"> 
                  <table class="table">    
                      <tr> 
                      <div id="container" style=" border: 3px solid #fff;padding: 20px;"> 
                            <div class="float-child-div" id="map" style="width: 70%;position: relative;overflow: hidden;"></div> 
                            <div class="float-child-div" id="sidebar" style="width: 30%;overflow: scroll; direction: ltr; position: relative; height: calc(100% - -222px);"></div> 
                      </div>
                      </tr>
                  </table> 
              </div>  
            </div>
        </div>
    </div>
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdTk1n5aZscA7r6N2HlavP_H8bigD8bFo&callback=initMap&libraries=places&v=weekly"
      async
    ></script>
  </body>
</html>
 
<script>
    // This example adds a search box to a map, using the Google Place Autocomplete
// feature. People can enter geographical searches. The search box will return a
// pick list containing a mix of places and predicted search terms.
// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
// let marker ;
// function initMap() {
//   getLocation();
//   const map = new google.maps.Map(document.getElementById("map"), {
//     center: { lat: -33.8688, lng: 151.2195 },
//     zoom: 18,
//     mapTypeId: "satellite",
//   });

//   const geocoder = new google.maps.Geocoder();
//   const infowindow = new google.maps.InfoWindow();
//   // Create the search box and link it to the UI element.
//   const input = document.getElementById("pac-input");
//   const searchBox = new google.maps.places.SearchBox(input);

//   // Bias the SearchBox results towards current map's viewport.
//   map.addListener("bounds_changed", () => {
//     searchBox.setBounds(map.getBounds());
//     zoom = 18;
//   });

//   let markers = [];
  
//   // Listen for the event fired when the user selects a prediction and retrieve
//   // more details for that place.
//   searchBox.addListener("places_changed", () => {
//     const places = searchBox.getPlaces();

//     if (places.length == 0) {
//       return;
//     }

//     // Clear out the old markers.
//     markers.forEach((marker) => {
//       marker.setMap(null);
//     });
//     markers = [];

//     // For each place, get the icon, name and location.
//     const bounds = new google.maps.LatLngBounds();

//     places.forEach((place) => {
//       if (!place.geometry || !place.geometry.location) {
//         console.log("Returned place contains no geometry");
//         return;
//       }

//       const icon = {
//         url: "https://cloud.gomigu.com/transform/$path/aeb90998-abe2-48d6-8b17-147fe124071d/posts/image/d9fbb43ac418_1634643460901.png",
//         size: new google.maps.Size(71, 71),
//         origin: new google.maps.Point(0, 0),
//         anchor: new google.maps.Point(17, 34),
//         scaledSize: new google.maps.Size(50, 50),
//       };
//       marker = new google.maps.Marker({
//           map,
//           icon,
//           title: place.name,
//           draggable:true,
//           position: place.geometry.location,
//           title:"Drag me!"
//         })
//       // Create a marker for each place.
//       markers.push(
//         marker
//       );
//       google.maps.event.addListener(marker, 'dragend', function (evt) { 
//         $("#alatLong").val(evt.latLng.lat().toFixed(6)+","+evt.latLng.lng().toFixed(6)); 
//         geocodeLatLng(geocoder, map, infowindow, evt.latLng.lat().toFixed(6)+","+evt.latLng.lng().toFixed(6));
//       });

//       if (place.geometry.viewport) {
//         // Only geocodes have viewport.
//         clearText();
//         $("#alatLong").val(place.geometry.location); 
        
//         geocodeLatLng(geocoder, map, infowindow, place.geometry.location.lat().toFixed(6)+","+place.geometry.location.lng().toFixed(6));
//         map.setCenter(place.geometry.location);
//         bounds.union(place.geometry.viewport);
//       } else {
//         bounds.extend(place.geometry.location);
//       }
//     });
//     map.fitBounds(bounds);
//   });
// }

// function geocodeLatLng(geocoder, map, infowindow, latlong) {
  
//   const input = latlong;
//   const latlngStr = input.split(",", 2);
//   const latlng = {
//     lat: parseFloat(latlngStr[0]),
//     lng: parseFloat(latlngStr[1]),
//   };

//   geocoder
//     .geocode({ location: latlng })
//     .then((response) => {
//       if (response.results[0]) {
//         map.setZoom(18);
//         // const marker = new google.maps.Marker({
//         //   position: latlng,
//         //   map: map,
//         // });
//         $("#alatLong").val(latlngStr[0]+","+latlngStr[1]);
         
//         for (x=0;x<response.results.length;x++) {
//             if (response.results[x].types[0] == 'locality') {
//                 $("#aCity").val(response.results[x].address_components[0].long_name);
//             } else if (response.results[x].types[0] == 'country') {
//                 $("#aCountry").val(response.results[x].address_components[0].long_name);
//             } else if (response.results[x].types[0] == 'administrative_area_level_1') {
//                 $("#aRegion").val(response.results[x].address_components[0].long_name);
//             } else if (response.results[x].types[0] == 'administrative_area_level_2') {
//                 $("#aProvince").val(response.results[x].address_components[0].long_name);
//             }  else if (response.results[x].types[0] == 'administrative_area_level_5' || response.results[x].types[0] == 'neighborhood') {
//                 $("#aBrgy").val(response.results[x].address_components[0].long_name);
//             } else if (response.results[x].types[0] == 'street_address' || response.results[x].types[0] == 'premise') {
//                 $("#aDetailedAdd").val(response.results[x].formatted_address);
//             }
//         }
//         infowindow.setContent(response.results[0].formatted_address);
//         infowindow.open(map, marker);
//       } else {
//         window.alert("No results found");
//       }
//     })
//     .catch((e) => window.alert("Geocoder failed due to: " + e));
// }
let geocoder;
let loadedApi = false;

function initMap() {
    loadedApi = true;
    const directionsRenderer = new google.maps.DirectionsRenderer({suppressMarkers : true});
    const directionsService = new google.maps.DirectionsService();
    const trafficLayer = new google.maps.TrafficLayer();
    const control = document.getElementById("floating-panel");

    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 14,
        center: { lat: 14.5995, lng: 120.9842 },
        mapTypeId: 'satellite'
    }); 
    geocoder = new google.maps.Geocoder();
    const input = document.getElementById("idCurLocationName");
    
    const searchBox = new google.maps.places.SearchBox(input); 
    const input2 = document.getElementById("idDestinationName"); 
    const searchBox2 = new google.maps.places.SearchBox(input2); 

    map.addListener("bounds_changed", () => {
      searchBox.setBounds(map.getBounds()); 
      searchBox2.setBounds(map.getBounds()); 
    });

    searchBox.addListener("places_changed", () => {
    const places2 = searchBox.getPlaces();

    places2.forEach((place) => {
      if (!place.geometry || !place.geometry.location) {
        console.log("Returned place contains no geometry");
        return;
      }
      $("#idCurLocation").val(place.geometry.location.lat()+","+place.geometry.location.lng());
      });
    });

    searchBox2.addListener("places_changed", () => {
    const places2 = searchBox2.getPlaces();

    places2.forEach((place) => {
      if (!place.geometry || !place.geometry.location) {
        console.log("Returned place contains no geometry");
        return;
      }
 
      $("#idDestination").val(place.geometry.location.lat()+","+place.geometry.location.lng());
      });
    });

    getLocation();

    directionsRenderer.setMap(map);
    trafficLayer.setMap(map);
    
    directionsRenderer.setPanel(document.getElementById("sidebar"));

    document.getElementById("mode").addEventListener("change", () => {
        calculateAndDisplayRoute(directionsService, directionsRenderer,map); 
    });

    
 
    // document.getElementById("btnNearby").addEventListener("click", () => {
    //   if ($("#idCurLocation").val() == "" ||  $("#idDestination").val() == "") {
    //       alert("Please Type Location");
    //   } else {
    //     if($('.hidMap').css('display') == 'none'){  
    //       $('.hidMap').show('slow'); 
    //     }
    //     let icon = {
    //     url: "https://cloud.gomigu.com/transform/$path/aeb90998-abe2-48d6-8b17-147fe124071d/posts/image/85bd3a006a75_1634870433881.png",
    //     size: new google.maps.Size(71, 71),
    //     origin: new google.maps.Point(0, 0),
    //     anchor: new google.maps.Point(17, 34),
    //     scaledSize: new google.maps.Size(30, 50),
    //     }; 

    //     var marker = new google.maps.Marker({
    //         position: {lat: 9.758004,lng:125.514223}, 
    //         icon: icon,
    //         map: map
    //     });
    //     marker.setMap(null);
    //     marker.setMap(map);
    //   }
    // });

    document.getElementById("btnReverse").addEventListener("click", () => {
      let idCurLocation = $("#idCurLocation").val();
      let idDestination = $("#idDestination").val();
      let idCurLocationName = $("#idCurLocationName").val();
      let idDestinationName = $("#idDestinationName").val();
      
      $("#idCurLocation").val(idDestination);
      $("#idDestination").val(idCurLocation);
      $("#idCurLocationName").val(idDestinationName);
      $("#idDestinationName").val(idCurLocationName);
      if($("#idDestination").prop('disabled')){
        $('#idDestinationName').removeAttr("disabled");
        $('#idCurLocationName').prop('disabled',true);
        $('#idDestination').removeAttr("disabled");
        $('#idCurLocation').prop('disabled',true); 
      } else {
        $('#idCurLocationName').removeAttr("disabled");
        $('#idCurLocation').removeAttr("disabled");
        $('#idDestinationName').prop('disabled',true);
        $('#idDestination').prop('disabled',true);
      }
    });

    document.getElementById("btnSearch").addEventListener("click", () => { 
        
      if ($("#idCurLocationName").val() == "") {
        $("#idCurLocationName").css('background-color', 'red'); 
      } else if ($("#idDestinationName").val() == "") {
        $("#idDestinationName").css('background-color', 'red'); 
      } else {
        if ($("#idCurLocation").val() == "" ||  $("#idDestination").val() == "") {
          alert("Please Type Location");
        } else {
          if($('.hidMap').css('display') == 'none'){  
            $('.hidMap').show('slow'); 
          }
          calculateAndDisplayRoute(directionsService, directionsRenderer,map); 
         
        }
      }
    });
}

$("#idCurLocationName").click(function() { 
   $("#idCurLocationName").css('background-color', 'white');
});
$("#idDestinationName").click(function() { 
   $("#idDestinationName").css('background-color', 'white');
});

document.getElementById("btnDirection").addEventListener("click", () => {
    if (loadedApi == false) {
        alert("Reloading this page..."); 
        return;
      }
    if($('.hid').css('display') == 'none'){ 
      $('.hid').show('slow'); 
      $("#btnDirection").val("COLLAPSE");
    } else {
      $('.hid').hide('slow');  
      $("#btnDirection").val("DIRECTION");
    }
});

function calculateAndDisplayRoute(directionsService, directionsRenderer,map) { 
        if (loadedApi == false) {
          alert("Reloading this page..."); 
          return;
        }
        const selectedMode = document.getElementById("mode").value; 
        const infowindow = new google.maps.InfoWindow();
        const service = new google.maps.places.PlacesService(map); 

        directionsService
            .route({
                origin:  $("#idCurLocation").val(),
                destination: $("#idDestination").val(),
                travelMode: google.maps.TravelMode[selectedMode],
                drivingOptions: {
                departureTime: new Date(),
                trafficModel: 'pessimistic',
                },
            })
            .then((response) => {
                var leg = response.routes[0].legs[0];
                clearMarkers();
                deleteMarkers();
                console.log(leg.start_location);
                makeMarker(leg.start_location,"https://cloud.gomigu.com/transform/$path/aeb90998-abe2-48d6-8b17-147fe124071d/posts/image/85bd3a006a75_1634870433881.png", "title", map);
                makeMarker(leg.end_location, "https://www.pngfind.com/pngs/m/279-2790915_pin-location-address-map-symbol-png-image-simbolos.png", 'title', map);
                directionsRenderer.setDirections(response);
                directionsRenderer.setOptions( { suppressMarkers: true } );
            })
        .catch((e) => window.alert("No route found between the origin and the destination"));

       
    }
var markers = [];
function makeMarker(position, icons, title, map) {
    // infoWindow = new google.maps.InfoWindow();
    
    let icon = {
        url: icons,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(30, 50),
    }; 
    addMarker(position,icon);
    showMarkers(map);
    // infoWindow.setPosition(pos);
    // infoWindow.setContent(contentString);
    // infoWindow.open(map);
}

function addMarker(location,icons) {
    var marker = new google.maps.Marker({
      position: location,
      map: map,
      icon: icons
    });
    markers.push(marker);
}

function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
      markers[i].setMap(map);
    }
}

function showMarkers(map) {
    setMapOnAll(map);
}

function deleteMarkers() {
    clearMarkers();
    markers = [];
}

function clearMarkers() {
  setMapOnAll(null);
}

let latlong;

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
        $("#idCurLocationName").val(results[0].formatted_address);  
        $("#idCurLocation").val(position.coords.latitude+","+position.coords.longitude);
        // $("#idCurLocation").attr('disabled', 'disabled');
        // $("#idCurLocationName").attr('disabled', 'disabled');
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
}
</script>

