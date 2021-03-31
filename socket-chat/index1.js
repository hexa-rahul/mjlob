(function () {
    'use strict';
    var express = require('express');
    var app = express();
    var request = require('request');
    var http = require('http'); 
    var serverUrl = 'http://3.128.114.38/rahalati/';

    app.use(express.static(__dirname + '/public'));
    app.get('/', function(req, res){
       res.sendFile(__dirname + '/index.html');
    });
    

    var server = app.listen(8005);
    var io = require('socket.io')(server);
    
    var connectedUsers = {};
    var clients = [];
    io.sockets.on('connection', function (socket) {
        socket.on('register', function (req) {    
            var userId = req.userId;
            //let clientIndex = getConnectionFromUserId(userId);
            clients.push({
                userId,
                socketId: socket.id
            });
            socket.join(socket.id);    

            // online user
            let data={};
            data['status']="online";
            data['id']=userId;
            io.emit('user_status', data);        
        });
            
            socket.on('send_message', function (data) {
                saveChatMessage(data);
            });
            
            socket.on('typing', function (data) { 
                console.log(data)
                var toUser = data.to;
                let userInfo = getUserById(toUser);
                if (userInfo.userId) {
                    socket.to(userInfo.socketId).emit('is_typing', data);
                };
             
            });  

        socket.on('disconnect', function () {
          let userInfo = getUserBySocketId(socket.id);
          let clientIndex = getIndexBySocketId(socket.id);
          if (clientIndex !== -1) {
            clients.splice(clientIndex, 1);
          }
          console.log('socket disconnected');
          socket.leave(socket.id);
          // offline user
          let data={};
          data['status']="away";
          data['id']=userInfo.userId;
          io.emit('user_status', data);
        });
            
        function saveChatMessage(data){
                    var message = data.message;
                    var fromUser = data.from;
                    var toUser = data.to;
                    // request.post(
                    //     serverUrl+'save-chat-message',
                    //     { json: {
                    //         to_id : toUser,
                    //         from_id : fromUser,
                    //         url : url,
                    //         created_at : getCurrentTime(),
                    //         message : message,
                    //         // "_token":_token,
                    //     } },
                    //     function (error, response, body) {
                    //         //console.log('body',body);
                    //         //console.log('body',body.success);
                    //         if (!error && response.statusCode == 200) {
                    //             if(body.success){
                                 let userInfo = getUserById(toUser);
                                 if (userInfo.userId) {
                                     socket.to(userInfo.socketId).emit('new_msg_recieved', data);
                                 }
                                 //} else {
                    //                 request.post(
                    //                     serverUrl+'save-notification',
                    //                     {
                    //                         json: {
                    //                             to_id : toUser,
                    //                             from_id : fromUser,
                    //                             is_offline : true,
                    //                             msg : "New message received",
                    //                             // "_token":_token,
                    //                         }
                    //                     },
                    //                     function (error, response, body) {
                    //                         if (!error && response.statusCode == 200) {
                    //                             // console.log(response);
                    //                         } else {
                    //                              console.log('something went wrong while saving notification');                                                       
                    //                         }
                    //                     }
                    //                 ); 
                    //             };
                    //         } else {
                    //             let fromUserInfo = getUserById(fromUser);
                    //              socket.to(fromUserInfo.socketId).emit('server_error');
                    //         }
                    //         }else{
                    //             console.log('something went wrong while saving message');   
                    //         }
                    //     }
                    //     );             
                    
                
        }

        socket.on('check_user_status', function (req) {
              
            var userId = req.userId;
            let data={};      
            data['id']=userId;
            data['status']="away";
            let userInfo = getUserById(userId);
            let fromUserInfo = getUserBySocketId(socket.id);
                
            if (userInfo.userId) {
                data['status']="away";
            };
            socket.to(fromUserInfo.socketId).emit('user_status', data);
        });    

        function getUserById(userId) {
            let userInfo = clients.find(user => {
              return user.userId == userId
            });
            if (userInfo) {
              return userInfo;
            }
            return false;
        }

        function getIndexBySocketId(socketId) {
        return clients.findIndex(user => {
            return user.socketId == socketId
            });
        }

      function getUserBySocketId(socketId) {
        let userInfo = clients.find(user => {
          return user.socketId == socketId
        });
        if (userInfo) {
          return userInfo;
        }
        return false;
      }
    }); 

})();


function getCurrentTime(){
var d = new Date();
 
 return   "'"+d.getFullYear() + "-" + 
    ("00" + (d.getMonth() + 1)).slice(-2) + "-" + 
    ("00" + d.getDate()).slice(-2) + " " + 
    ("00" + d.getHours()).slice(-2) + ":" + 
    ("00" + d.getMinutes()).slice(-2) + ":" + 
    ("00" + d.getSeconds()).slice(-2)+"'";
}
