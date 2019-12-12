var URLL_ROOT = "";
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
  // $(".actionButtonModal button:first-child").attr("data-jobId", id);
  $(".actionButtonModal button:first-child").attr("id", "terminalCor");
  $(".actionButtonModal button:last-child").attr("id", "cancelJobHide");
});
$(document).on("click", "#cancelJobHide", function() {
  $(".confirmationModal").hide(10);
  $("body").css({
    overflow: "auto"
  });
});
var dataTerminalId;
$(document).on("click", "#terminalCor", function() {
  var itemType = $(this).attr("data-u");

  if (itemType == 1) {
    var terminalCoor = $("#latlong").attr("data-latlong");
    var terminalN = $("#nameTerm").val();
    $.ajax({
      url: URLL_ROOT + "/admin/addTerminal",
      type: "POST",
      data: {
        termN: terminalN,
        terminalCoor: terminalCoor
      },
      dataType: "json",
      success: function(data) {
        console.log(data);
      },
      error: function(err) {
        console.log(err);
      }
    });
  } else if (itemType == 2) {
    var fromR = $("#fromR").val();
    var routeNames = $("#routeNames").val();
    var toR = $("#toR").val();

    $.ajax({
      url: URLL_ROOT + "/admin/addRoute",
      type: "POST",
      dataType: "json",
      data: {
        from: fromR,
        routeNames: routeNames,
        to: toR
      },
      success: function(data) {
        console.log(data);
      },
      error: function(err) {
        console.log(err);
      }
    });
    console.log(placeCoor);
  } else if (itemType == 3) {
    var placeCoor = $("#latlong").attr("data-latlong");
    var placeTerminal = $("#placeTerminal")
      .find(":selected")
      .attr("data-id");
    var placeName = $("#placeName").val();
    var placeAdd = $("#placeAdd").val();
    var uType = $(this).attr("data-uType");

    var fd = new FormData();
    var photo_data = $("#placeImageData").prop("files")[0];
    fd.append("placeImage", photo_data);
    fd.append("placeCoor", placeCoor);
    fd.append("placeTerminal", placeTerminal);
    fd.append("placeName", placeName);
    fd.append("placeAdd", placeAdd);
    fd.append("uType", uType);
    $.ajax({
      url: URLL_ROOT + "/admin/addPlace",
      type: "POST",
      dataType: "json",
      cache: false,
      processData: false, // important
      contentType: false, // important
      data: fd,
      success: function(data) {
        console.log(data);
      },
      error: function(err) {
        console.log(err);
      }
    });
    console.log(placeCoor);
  } else if (itemType == 4) {
    var driverCon = $("#driverCon").val();
    var driverN = $("#driverN").val();
    var uType = $(this).attr("data-uType");
    $.ajax({
      url: URLL_ROOT + "/admin/addDriver",
      type: "POST",
      data: {
        driverCon: driverCon,
        driverN: driverN,
        uType: uType
      },
      dataType: "json",
      success: function(data) {
        console.log(data);
      },
      error: function(err) {
        console.log(err);
      }
    });
  } else if (itemType == 5) {
    var assignTerminal = dataTerminalId;
    var dispatcherName = $("#disPatch").val();
    var dispatcherContact = $("#disContact").val();
    var uType = $(this).attr("data-uType");
    $.ajax({
      url: URLL_ROOT + "/admin/assignDispatcher",
      type: "POST",
      data: {
        assignTerminal: assignTerminal,
        dispatcherContact: dispatcherContact,
        uType: uType,
        dispatcherName: dispatcherName
      },
      dataType: "json",
      success: function(data) {
        console.log(data);
      },
      error: function(err) {
        console.log(err);
      }
    });
    console.log(assignTerminal);
  } else if (itemType == 6) {
    var driveId = $("#driveId").val();
    var driverN = $("#driverN").val();
    $.ajax({
      url: URLL_ROOT + "/admin/addBus",
      type: "POST",
      data: {
        driveId: driveId,
        driverN: driverN
      },
      dataType: "json",
      success: function(data) {
        console.log(data);
      },
      error: function(err) {
        console.log(err);
      }
    });
  }
  window.location.href = window.location.origin+"/admin";
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
  iconUrl: URLL_ROOT + "/img/icons/bus.png",
  // shadowUrl: 'leaf-shadow.png',
  iconSize: [32, 37], // size of the icon
  iconAnchor: [15, 30], // point of the icon which will correspond to marker's location
  shadowAnchor: [4, 62], // the same for the shadow
  popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
});

L.marker([9.306541, 123.304177], { icon: greenIcon, draggable: false })
  .addTo(mymap)
  .bindPopup("<b>Hello world!</b><br />I am a popup.");

L.Routing.control({
  waypoints: [L.latLng(9.30357, 123.305317), L.latLng(9.312397, 123.266564)]
}).addTo(mymap);

// Whenever the item is CHOOSE this execute
$(document).on("change", "#addT", function() {
  var dropVal = $(this).val();
  if (dropVal == 2) {
    $(".termFC").hide(50);
    $("#routeForm").show(100);
    $(".actionButtonModal button:first-child").attr("data-u", 2); // essential in displaying correct form
  }
  if (dropVal == 3) {
    $(".actionButtonModal button:first-child").attr("data-u", 3); // essential in displaying correct form
    $(".termFC").hide(50);
    $("#placeForm").show(100);
  }
  if (dropVal == 4) {
    $(".actionButtonModal button:first-child").attr("data-uType", 3); // for setting user type
    $(".actionButtonModal button:first-child").attr("data-u", 4); // essential in displaying correct form
    $("#termAddForm").hide(50);
    $("#driverForm").show(100);
  }
  if (dropVal == 5) {
    $(".actionButtonModal button:first-child").attr("data-uType", 2); // for setting user type
    $(".actionButtonModal button:first-child").attr("data-u", 5); // essential in displaying correct form
    $(".termFC").hide(50);
    $("#dispatcherForm").show(100);
  }
  if (dropVal == 6) {
    $(".actionButtonModal button:first-child").attr("data-u", 6); // essential in displaying correct form
    $("#termAddForm").hide(50);
    $("#busForm").show(100);
  }
});

$(document).on('change','#assignTerminal',function(){
  // alert($("#assignTerminal").find(":selected").attr("data-id"));
  dataTerminalId = $(this).find(":selected").attr("data-id");
});
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
  $("#latlong").attr("data-latlong", e.latlng);
  var mark = new L.marker(e.latlng, { draggable: true }).addTo(modalMap);
  mark.on("dragend", function(e) {
    $("#latlong").attr("data-latlong", e.target._latlng);
    // get the result latlong to store in the DB

    console.log(e.target._latlng);
  });
}
modalMap.once("click", onModalMapClick);

// During the assigning of the dispatcher this will show where is the Location of the Terminal
$(document).on("change", "#assignTerminal", function(e) {
  var post = $(this).val();
  var latlngFrom = post.split(", ");
  new L.marker([latlngFrom[0], latlngFrom[1]]).addTo(modalMap);
});

// This is giving the coordinate of the routes of the bus
$(document).on("change", "#toR", function(e) {
  let to = $(this).val();
  var latlngTo = to.split(", ");

  var from = $("#fromR").val();
  var latlngFrom = from.split(", ");

  // var d = "[L.latLng(" + from + "), L.latLng(" + to + ")]";
  L.Routing.control({
    waypoints: [
      L.latLng([latlngTo[0], latlngTo[1]]),
      L.latLng([latlngFrom[0], latlngFrom[1]])
    ],
    routeWhileDragging: false
  }).addTo(modalMap);

  // var stuSplit = L.latLng( + to);
  // var myMarker = L.circleMarker(stuSplit, { title: "unselected" }).addTo(
  //   modalMap
  // );
  // new L.marker([latlngTo[0], latlngTo[1]]).addTo(modalMap);
  console.log(n);
});
