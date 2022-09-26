const express = require('express');
const app = express();
const server = require('http').createServer(app);

const io = require('socket.io')(server, {
  cors: { origin: '*' }
});

io.on('connection', (socket) => {
  console.log('connection');

  socket.on('setActiveQuizServer', (message) => {
    console.log(message);

    io.sockets.emit('setActiveQuizClient', message);
  });

  socket.on('setFinishQuizServer', (message) => {
    console.log(message);

    io.sockets.emit('setFinishQuizClient', (message) => {
      console.log(message);
    });
  })

  socket.on('disconnect', (socket) => {
    console.log('disconnect');
  })
});

server.listen(3000, () => {
  console.log('server is running')
});