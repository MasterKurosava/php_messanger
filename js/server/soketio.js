

const app = express();
const http = require('http');
const server = http.createServer(app);
const { Server } = require("socket.io");
const io = new Server(server);


const mainPageUrl=__dirname.slice(0, __dirname.indexOf('\\js'));

app.get('/', (req, res) => {
  res.sendFile(mainPageUrl + '/index.html');
});

io.on('connection', (socket) => {
  socket.on('disconnect', () =>{
      console.log('user disconnected');
  })
});
 
io.on('connection', (socket) =>{
    socket.on('chat message', (msg)=>{
        io.emit('chat message', msg)
    })
})

server.listen(3000, () => {
  console.log('listening on *:3000');
});