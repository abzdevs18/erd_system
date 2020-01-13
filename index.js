var express = require("express");
var socket = require("socket.io");
var app = express();

// Twilio Start inn Here
// var accountSid = "ACcd283404e7729a19efc121e24d139466"; // Your Account SID from www.twilio.com/console
// var authToken = "a571f0e822d96a75cbd38a28078c5d9c"; // Your Auth Token from www.twilio.com/console

// var twilio = require("twilio");
// var client = new twilio(accountSid, authToken);
// End of Twilio

var server = app.listen(3001, function() {
  console.log("listen");
});

// Page
app.use(express.static("public"));

// Socl
var io = socket(server);

io.on("connection", function(socket) {
  console.log("conndected");

  socket.on("message", function(data) {
    io.emit("message", data);
    console.log(data);
  });

  //   socket.on("driver", function(data) {
  //     client.messages
  //       .create({
  //         body:
  //           "Good day! Your application as a Driver to Terminal Hub is now confirm. Use the following account to login. \n Username: " +
  //           data["driverN"] +
  //           " \n Password: " +
  //           data["password"],
  //         to: "+639350976412", // Text this number
  //         from: "+13187035680" // From a valid Twilio number
  //       })
  //       .then(message => console.log(message.sid));
  //   });
});
