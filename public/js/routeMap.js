// Modal Map
var rousteMap = L.map("routeChecking").setView([9.30357, 123.305317], 17);
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
).addTo(rousteMap);

var routingControl;
$(document).on("click", "#routeCheckingRow", function(e) {
  $(".removeR").prop("disabled", false);
  // var state = $("#data-container").attr("data-stat");

  var from = $(this).attr("data-from");
  var latlngF = from.split(", ");

  var to = $(this).attr("data-to");
  var latlngT = to.split(", ");

  // spliceWaypoints(0, 2);

  routingControl = L.Routing.control({
    waypoints: [
      L.latLng([latlngF[0], latlngF[1]]),
      L.latLng([latlngT[0], latlngT[1]])
    ]
  }).addTo(rousteMap);

  // L.marker([latlngF[0], latlngF[1]])
  //   .addTo(rousteMap)
  //   .bindPopup("A pretty CSS3 popup.<br> Easily customizable.");

  // rousteMap.on("mouseover", function(e) {
  //   this.openPopup();
  // });
  // var s = new Array();
  // s = routing.getWaypoints();
  // JSON.stringify(s)
});
$(document).on("click", ".removeR", function(e) {
  rousteMap.removeControl(routingControl);
  routingControl = null;
});

$(document).on("change", "#schedule_routeMap", function(e) {
  $(".removeR").prop("disabled", false);
  var assignTerminal = $("#assignTerminal")
    .find(":selected")
    .attr("data-id");
  // var state = $("#data-container").attr("data-stat");

  var from = $(this)
    .find(":selected")
    .attr("data-from");
  var latlngF = from.split(", ");

  var to = $(this)
    .find(":selected")
    .attr("data-to");
  var latlngT = to.split(", ");

  // spliceWaypoints(0, 2);

  routingControl = L.Routing.control({
    waypoints: [
      L.latLng([latlngF[0], latlngF[1]]),
      L.latLng([latlngT[0], latlngT[1]])
    ]
  }).addTo(rousteMap);
});
