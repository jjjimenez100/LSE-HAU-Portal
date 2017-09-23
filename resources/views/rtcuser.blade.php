@extends('portal.portal-home-user')

@section('additionalcssfiles')
    <style>
        .panel-heading { background-color: #3d6da7 !important; color: white !important; }
        .panel-body { padding: 0px; }
        p{
            overflow-wrap:break-word;
        }

        video{
            padding-left: 10px;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">
                <i class="fa fa-video-camera" aria-hidden="true"></i> <strong>Conferencing Rooms</strong>
            </h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 hidden" id="videoroom">
            <form class="form-inline">
                <div class="form-group">
                    <label for="roomID">Room ID:</label>
                    <input type="text" class="form-control" id="roomID">
                </div>
                <div class="form-group">
                    <button class="btn" id="join" style="margin: 5%; background-color: #3d6da7; color: white;"><i class="fa fa-sign-in" aria-hidden="true"></i> Join Room</button>
                </div>

                <div class="form-group">
                    <button class="btn btn-danger" id="leave" style="margin: 5%;" disabled><i class="fa fa-sign-out" aria-hidden="true"></i> Leave Room</button>
                </div>
            </form>
            <br>
            <div id="videos-container">
                <div class="jumbotron" style="vertical-align: middle;" id="rules">
                    <h1><i class="fa fa-info-circle text-info" aria-hidden="true"></i> <span class="text-info">TAKE NOTE</span></h1>
                    <br>
                    <ul class="list-group" style="font-weight: bold; font-size: 110%;">
                        <li>In any case that you joined an empty room, please double check the room ID you have entered.</li>
                        <li>In any case that you would like to leave the room, just click the <span class="text-danger">red colored Leave Room button</span>.</li>
                        <li>Once the creator of the room (admins/officers) has left, <span class="text-danger">the room will be automatically deleted</span>.</li>
                        <li>All messages and file uploads <span class="text-danger">are automatically discarded</span> from the server when the room is deleted.</li>
                        <li>The conferencing rooms will not properly work without a webcam and microphone attatched to your device.</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4 hidden" id="chatroom">
            <h4 id="username" class="hidden">You are logged in as <strong>{{ Auth::user()->name }}</strong>.</h4>
            <br>
            <div class="panel panel-default">
                <div class="panel-heading text-center">Chat Room</div>
                <div class="panel-body">
                    <div style="overflow:auto; max-height: 420px; height: 420px;" id="chat-output">

                    </div>
                    <div class="panel-footer">
                        <div class="input-group">
                            <input type="text" class="form-control" id="textChat" disabled>
                            <span class="input-group-btn">
                    <button class="btn" style="background-color: #3d6da7; color: white;" type="button" id="sendMessage" disabled>Send</button>
                                <button class="btn btn-default" type="button" id="share-file" disabled>Upload</button>
                  </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12" id="rulesandguidelines">
            <div class="jumbotron" style="vertical-align: middle;" id="rules">
                <h1><i class="fa fa-exclamation-circle text-danger" aria-hidden="true"></i> <span class="text-danger">RULES AND REGULATIONS</span></h1>
                <br>
                <ul class="list-group" style="font-weight: bold; font-size: 110%;">
                    <li><span class="text-success">DO</span> Stay fully clothed on your webcam.</li>
                    <li><span class="text-danger">DO NOT</span> annoy anyone in the room</li>
                    <li><span class="text-danger">DO NOT</span> Use capital letters in the room, this is equivalent to shouting</li>
                    <li><span class="text-danger">DO NOT</span> Put your email on the main chat screen or put web site addresses or URL’s in the main room unless necessary.</li>
                    <li><span class="text-danger">DO NOT</span> Treat people any different to how you would treat someone in a real life situation</li>
                    <li><span class="text-danger">DO NOT</span> upload large files (above 1mb or so) in the conferencing room, as this would put too much stress on our servers. Use an alternative file hosting service instead.</li>
                </ul>
                <input type="checkbox" id="check"> <span>I have read and understand the above rules and guidelines.</span><br><br>
                <button class="btn btn-primary" id="permission" disabled><i class="fa fa-sign-in" aria-hidden="true"></i> Let me in!</button>
            </div>
        </div>
    </div>
@endsection

@section('additionalScriptFiles')
    <script src="https://rtcmulticonnection.herokuapp.com/dist/RTCMultiConnection.min.js"></script>
    <!--<script src="/socket.io/socket.io.js"></script>-->
    <script src="https://cdn.webrtc-experiment.com/getMediaElement.js"></script>
    <script src="https://rtcmulticonnection.herokuapp.com/socket.io/socket.io.js"></script>
    <script src="https://cdn.webrtc-experiment.com:443/FileBufferReader.js"></script>

    <script>
        $('#conferencingRooms').addClass('active');
        var permission = $('#permission');
        var check = $('#check');
        check.change(function() {
            if(this.checked) {
                permission.prop('disabled', false);
            }
            else{
                permission.prop('disabled', true);
            }
        });

        permission.on('click', function(){
               $('#rulesandguidelines').addClass("hidden");
               $('#chatroom').removeClass("hidden");
               $('#videoroom').removeClass("hidden");

        });
        var joinBtn = $('#join');
        var roomID = $('#roomID');
        var chatOutput = $('#chat-output');
        var messageSyntax = '<div style="padding-left: 10px;"><p><strong>{{ Auth::user()->name }}:</strong> ';
        var messageSyntax2 = '</p></div><hr>';
        var rules = $('#rules');
        var username = $('#username');

        var inputMsg = $('#textChat');
        var sendBtn = $('#sendMessage');
        var uploadBtn = $('#share-file');
        joinBtn.on('click', joinRoom);

        function joinRoom(e){
            e.preventDefault();
            connection.join(roomID.val());
            rules.addClass('hidden');
            username.removeClass('hidden');
            chatOutput.append('<div style="padding-left: 10px;"><p>You are now at Room ID: ' + roomID.val() + '<strong> Say hello!</strong></p></div><hr>').focus();
            chatOutput.animate({scrollTop: chatOutput.prop("scrollHeight")}, 500);
            $('#leave').prop('disabled', false);
            openBtn.prop('disabled', true);
            joinBtn.prop('disabled', true);
            inputMsg.prop('disabled', false);
            sendBtn.prop('disabled', false);
            uploadBtn.prop('disabled', false);
        }
        uploadBtn.on('click', function(){
            var fileSelector = new FileSelector();
            fileSelector.selectSingleFile(function(file){
                connection.send(file);
            });
        });

        inputMsg.on('keyup', function(e){
            if (e.keyCode != 13) return;
            // removing trailing/leading whitespace
            inputMsg.val(inputMsg.val().replace(/^\s+|\s+$/g, ''));
            if (!inputMsg.val().length) return;
            connection.send(inputMsg.val());
            appendDIV(inputMsg.val());
            inputMsg.val('');
        });

        sendBtn.on('click', function(e){
            inputMsg.val(inputMsg.val().replace(/^\s+|\s+$/g, ''));
            if (!inputMsg.val().length) return;
            connection.send(inputMsg.val());
            appendDIV(inputMsg.val());
            inputMsg.val('');
        });

        function appendDIV(event){
            var userMessage = "" + messageSyntax + (event.data || event) + messageSyntax2 + "";
            chatOutput.append(userMessage).focus();
            chatOutput.animate({scrollTop: chatOutput.prop("scrollHeight")}, 500);
        }

        var connection = new RTCMultiConnection();
        connection.socketURL = 'https://rtcmulticonnection.herokuapp.com:443/';
        connection.socketMessageEvent = 'LSE-HAU PORTAL';
        connection.enableFileSharing = true;
        connection.session = {
            audio: true,
            video: true,
            data: true
        };
        connection.sdpConstraints.mandatory = {
            OfferToReceiveAudio: true,
            OfferToReceiveVideo: true
        };
        connection.videosContainer = document.getElementById('videos-container');
        connection.onstream = function(event) {
            var width = parseInt(connection.videosContainer.clientWidth / 2)-20;
            var mediaElement = getMediaElement(event.mediaElement, {
                title: event.userid,
                buttons: ['full-screen'],
                width: width,
                showOnMouseEnter: false
            });
            connection.videosContainer.appendChild(mediaElement);
            setTimeout(function() {
                mediaElement.media.play();
            }, 5000);
            mediaElement.id = event.streamid;
        };
        connection.onstreamended = function(event) {
            var mediaElement = document.getElementById(event.streamid);
            if(mediaElement) {
                mediaElement.parentNode.removeChild(mediaElement);
            }
        };
        connection.onmessage = appendDIV;
        connection.filesContainer = document.getElementById('chat-output');
        connection.enableLogs = false; //uncomment to debug
        connection.onUserIdAlreadyTaken = function(useridAlreadyTaken, yourNewUserId) {
            connection.join(useridAlreadyTaken);
        };
    </script>
@endsection