var express = require('express');
var app = express();
var serv = require('http').Server(app);

app.get('/',function(req,res){
  res.sendFile(__dirname+ '/client/hub.php');
});

app.use('/client',express.static(__dirname + '/client'));

serv.listen(2000);
console.log("Sever started!");

var io = require('socket.io')(serv,{});
io.sockets.on('connection', function(socket){
  console.log("socket conntection");

  socket.on('happy',function(data){
    console.log('happy'+data.reason);
  });
  socket.emit('servermsg',{
    msg: 'hello',
  });
});
