var express = require('express');
var socket = require('socket.io');
const client = require('twilio')(
	'AC41a05b1c14d7656db36da1b69df879aa',
	'bc7fa43ea8564869d3b6f1bafdef4958'
  );
var app = express();

var server = app.listen(3000,function(){
	// console.log('listen');
});

// Page
app.use(express.static('public'));

// Socl
var io = socket(server);

io.on('connection', function(socket){
	console.log('conndected');

	socket.on('message', function(data){
		io.emit('message',data);
		console.log(data);
	});
});
client.messages.create({
  from: "+12564725511",
  to: '+639350976412',
  body: "You just sent an SMS from Node.js using Twilio!"
}).then((messsage) => console.log(message.sid));



