(function () {
    'use strict';
    var express = require('express');
    var app = express();
    var request = require('request');
    var http = require('http'); 
    var serverUrl = 'http://3.128.114.38/rahalati/api/';

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
            let clientIndex = getConnectionFromUserId(userId);
            if(clientIndex){
                clients.splice(clientIndex, 1);
            }
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
                var isFile = false;
                if(data.type != undefined && data.type == 'file' && data.url){
                    isFile = true;
                }
                saveChatMessage(data, isFile);
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
            
        function saveChatMessage(data, isFile){
			console.log("saveChatMessage new");
                    var url = null;
                    if(isFile){
                        url = data.url;    
                    }
                    var message = data.message;
                    var fromUser = data.from;
                    var toUser = data.to;
                    var messageGroupId = data.messageGroupId;
                    var unique_id = data.uniqueId;
                     request.post({
                         url: serverUrl+'save_chat_message',
                         form: {
                            receiverId : toUser,
                            from_id : fromUser,
                            url : url,
                            created_at : getCurrentTime(),
                            message : message,
                            unique_id : unique_id,
                            messageGroupId : messageGroupId 
                        },
                           headers: { 
                            Accept: 'application/json',
                            Authorization : 'Bearer '+data.token 
                           },
                        method: "POST"   
                       },
                        function (error, response, body) {
                            //console.log('body',body);
                            //console.log(response);
                            //console.log(error);
							
                            //console.log('body',body.success);
                            if (!error && response.statusCode == 200) {
                             //   if(body.status == 200){
                                 let userInfo = getUserById(toUser);
                                 if (userInfo.userId) {
                                     socket.to(userInfo.socketId).emit('new_msg_recieved', data);
                                 }else{
                                     request.post({
					 url: serverUrl+'sendNotification',
                         		form: {
                            			receiverId : toUser,
                            			from_id : fromUser,
                            			unique_id : unique_id,
                            			url : url,
                            			created_at : getCurrentTime(),
                            			message : message,
                            			messageGroupId : messageGroupId
                        		},
                           		headers: {
                            			Accept: 'application/json',
                            			Authorization : 'Bearer '+data.token
                           		},
                        		method: "POST"
					},
                                         function (error, response, body) {
                                             if (!error && response.statusCode == 200) {
                                                 // console.log(response);
                                             } else {
                                                  console.log('something went wrong while saving notification');                                                       
                                             }
                                         }
                                     ); 
                                };
                            //} else {
                             //   let fromUserInfo = getUserById(fromUser);
                              //   socket.to(fromUserInfo.socketId).emit('server_error');
                     //       }
                            }else{
                                console.log('something went wrong while saving message');   
                            }
                        }
                        );             
                    
                
        }

        socket.on('check_user_status', function (req) {
              
            var userId = req.userId;
            let data={};      
            data['id']=userId;
            data['status']="away";
            let userInfo = getUserById(userId);
            let fromUserInfo = getUserBySocketId(socket.id);
                
            if (userInfo.userId) {
                data['status']="online";
            };
	console.log(data)
            io.emit('user_status', data);
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

       function getConnectionFromUserId (id) {
        let connectionLength = clients.length

        for (let i = 0; i < connectionLength; i++) {
          let connection = clients[i]
          if (connection.userId == id) {
              clients.splice(i, 1);
            break
          }
        }
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
