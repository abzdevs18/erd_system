var express = require('express');
var socket = require('socket.io');

var app = express();

var server = app.listen(80,function(){
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


