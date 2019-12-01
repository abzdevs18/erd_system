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

// L.Routing.control({
//   waypoints: [L.latLng(9.30357, 123.305317), L.latLng(9.312397, 123.266564)]
// }).addTo(rousteMap);

// $(document).on("click", "#data-container", function(e) {
//   var from = $(this).attr("data-from");
//   var to = $(this).attr("data-to");

//   alert(from);
// });
