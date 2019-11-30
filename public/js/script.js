var URL_ROOT = "/easy_ride_hub";
// Delete Blog
$(document).on("click", "#add_record", function() {
  // mapping();
  setTimeout(function() {
    // we need this to center or render the map in the modal correctly
    modalMap.invalidateSize();
  }, 10);

  var id = $(this).attr("data-jId");
  $(".confirmationModal").show(10);
  $(".confirmationMessage h2").text("Choose what to add?");
  $("body").css({
    overflow: "hidden",
    position: "relative"
  });
  $(".actionButtonModal button:first-child").attr("data-jobId", id);
  $(".actionButtonModal button:first-child").attr("id", "jobHiddingId");
  $(".actionButtonModal button:last-child").attr("id", "cancelJobHide");
});
$(document).on("click", "#cancelJobHide", function() {
  // window.location.href = URL_ROOT + "/admin/posted";
  $(".confirmationModal").hide(10);
  $("body").css({
    overflow: "auto"
  });
});

// Mapping the terminal
var mymap = L.map("erdActivity").setView([9.30357, 123.305317], 17);
L.tileLayer(
  "https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoicmphbWVzMTExMjEzIiwiYSI6ImNrM2t2eHBzaDBpa2YzY2s1aWV4dTkzOGcifQ.Gd_Y17yco90SmeOz4PKIZQ",
  {
    maxZoom: 17,
    attribution:
      'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
      '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
      'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    id: "mapbox/streets-v11"
  }
).addTo(mymap);
var greenIcon = L.icon({
  iconUrl: URL_ROOT + "/img/icons/bus.png",
  // shadowUrl: 'leaf-shadow.png',
  iconSize: [32, 37], // size of the icon
  iconAnchor: [15, 30], // point of the icon which will correspond to marker's location
  shadowAnchor: [4, 62], // the same for the shadow
  popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
});
// var myMovingMarker = L.Marker.movingMarker(
//   [
//     [9.30357, 123.305317],
//     [9.312397, 123.266564]
//   ],
//   [20000]
// ).addTo(mymap);

// myMovingMarker.start();

L.marker([9.306541, 123.304177], { icon: greenIcon, draggable: false })
  .addTo(mymap)
  .bindPopup("<b>Hello world!</b><br />I am a popup.");

L.Routing.control({
  waypoints: [L.latLng(9.30357, 123.305317), L.latLng(9.312397, 123.266564)]
}).addTo(mymap);

// Modal Map
var modalMap = L.map("mapid").setView([9.30357, 123.305317], 17);
L.tileLayer(
  "https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoicmphbWVzMTExMjEzIiwiYSI6ImNrM2t2eHBzaDBpa2YzY2s1aWV4dTkzOGcifQ.Gd_Y17yco90SmeOz4PKIZQ",
  {
    maxZoom: 22,
    attribution:
      'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
      '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
      'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    id: "mapbox/streets-v11"
  }
).addTo(modalMap);

function onModalMapClick(e) {
  var mark = new L.marker(e.latlng, { draggable: true }).addTo(modalMap);
  mark.on("dragend", function(e) {
    // get the result latlong to store in the DB
  });
}

modalMap.once("click", onModalMapClick);
