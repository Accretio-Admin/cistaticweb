<!DOCTYPE html>
<style>
    #map {
  height: 100%;
}

/* Optional: Makes the sample page fill the window. */
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}
 
</style>
<html>
  <head>
    <title>Removing Markers</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script> 
  </head>
  <body>
    <div id="floating-panel">
      <input id="lat" type="hidden"/>
      <input id="lng" type="hidden"/>
      <input id="radius" type="hidden"/>
    </div>
    <div id="map"></div> 
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdTk1n5aZscA7r6N2HlavP_H8bigD8bFo&callback=initMap2&v=weekly"
      async
    ></script>
  </body>
</html> 
<script>
let map;
let markers = [];
let infoWindow ;
let apiLoaded = false;
function initMap2() {
  apiLoaded = true;
  const haightAshbury = {  lat: 9.553621, lng: 125.662398 };
    
  map = new google.maps.Map(document.getElementById("map"), {
    zoom: 8,
    center: haightAshbury,
    mapTypeId: "terrain",
  }); 
  // Adds a marker at the center of the map.
  infoWindow = new google.maps.InfoWindow();
  
}

// Adds a marker to the map and push to the array.
// function addMarker(position) {
//   const marker = new google.maps.Marker({
//     position,
//     map,
//   }); 
//   markers.push(marker);
// }

// // Sets the map on all markers in the array.
// function setMapOnAll(map) {
//   for (let i = 0; i < markers.length; i++) {
//     markers[i].setMap(map);
//   }
// }

// // Removes the markers from the map, but keeps them in the array.
// function hideMarkers() {
//   setMapOnAll(null);
// }

// // Shows any markers currently in the array.
// function showMarkers() {
//   setMapOnAll(map);
// }

// // Deletes all markers in the array by removing references to them.
// function deleteMarkers() {
//   hideMarkers();
//   markers = [];
// }

 
$(window).bind("load", function() {
    setTimeout(() => {  
        if (apiLoaded == true) {
           
        waitingDialog.show('Please Wait..', {dialogSize: 'sm', progressType: 'primary'});
            $.ajax({
                url: '<?php echo BASE_URL().'Users_location'?>'+"/getOutletDetails",
                type: "POST",
                data: {
                order: 'asc',
                lat:$("#lat").val(),
                lng:$("#lng").val(),   
                radius: $("#radius").val()
                },
                dataType: "json",
                cache: false,
                success: function (response) { 
                    let res =  response;   
                    if (res == "null") {
                      alert("No Nearby Outlet Please Adjust Radius!");
                    } else if (res.S == 0 || res.s == 0) { 
                      alert(res.M);
                    } else { 
                        const infoWindow = new google.maps.InfoWindow();
                        let data = res.D;
                        for(x=0;x<data.length;x++){ 
                            let location = data[x].latlong.split(","); 
                            let markerLocation = { lat: parseFloat(location[0]), lng:parseFloat(location[1]) };
                            let address = data[x].city+", "+data[x].detailedAdd;
                            let userlevel = "";
                            if (data[x].userlevel == 1 || data[x].userlevel == 6 || data[x].userlevel == 14 || data[x].userlevel == 15 ) userlevel = "DEALER";
                            if (data[x].userlevel == 16) userlevel = "UNIFIED PAYMENT CENTERS";
                            if (data[x].userlevel == 7) userlevel = "UNIFIED HUBS/CORPORATE PARTNERS";  
                        // Create the markers.
                        // tourStops.forEach(([position, title], i) => {
                            let icon = {
                                url: "https://lh4.ggpht.com/4PPfsRjeb28pPWveMA3al1f_TL43VZ-vo_o4WR86D6HLjX3RkXGLFsVW8h4XXXM8Fl0F=w300",
                                size: new google.maps.Size(71, 71),
                                origin: new google.maps.Point(0, 0),
                                anchor: new google.maps.Point(17, 34),
                                scaledSize: new google.maps.Size(30, 50),
                            }; 
                            const marker = new google.maps.Marker({
                            position: markerLocation,
                            map,
                            title: `${address}`, 
                            optimized: false,
                            icon: icon
                            });
                            const contentString =
                            '<div id="content">' +
                            '<div id="siteNotice">' +
                            "</div>" +
                            '<h1 id="firstHeading" class="firstHeading">'+userlevel+'</h1><br><p><b>Outlet Name: <i>'+data[x].name+'</i></b></p>' +
                            '<div id="bodyContent">' +
                            "<p><b>Address: </b><b><i>"+data[x].detailedAdd+", "+data[x].city+", "+data[x].province+"</i></b> <br> <b>Opening Day:</b><i> "+data[x].storeOpeningDay+
                            "</i><br> <b>Closing Day:</b> <i>"+data[x].storeClosingDay+
                            "</i><br> <b>Opening Hours:</b>  <i>"+data[x].storeOpeningHours+
                            "</i><br> <b>Closing Hours:</b>  <i>"+data[x].storeClosingHours+
                            "</i></p></div>";
                            map.panTo(marker.getPosition());
                            map.setZoom(9);
                            marker.addListener("click", () => {
                                infoWindow.close();
                                infoWindow.setContent(contentString);
                                infoWindow.open(marker.getMap(), marker);
                                map.panTo(marker.getPosition());
                                map.setZoom(19);
                            });
                            
                        // });
                        } 
                  }
                    waitingDialog.hide(); 
                }
            });   
        } else {
            alert("Reloading this page..."); 
        }
    }, 2000);
});  
</script> 