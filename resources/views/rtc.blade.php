
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <meta charset="utf-8">
</head>

<body>
<article>
    <div class="container-fluid col-md-2">
        <label for="roomID">Room ID:</label>
        <input type="text" class="form-control" id="roomID" size="15">
        <button class="btn btn-default" id="btnRandom" style="margin: 5%">Random Room ID</button>

        <button class="btn btn-default" id="open" style="margin: 5%">Create Room</button>
        <button class="btn btn-default" id="join" style="margin: 5%">Join Room</button>
        <input type="text" class="form-control" id="input-text-chat" placeholder="Enter Text Chat">
        <button class="btn btn-default" id="share-file" style="margin: 5%">Upload File</button>
    </div>

        <div id="chat-container">
            <div id="file-container"></div>
            <div class="chat-output"></div>
        </div>

        <div id="videos-container"></div>

    <script src="https://rtcmulticonnection.herokuapp.com/dist/RTCMultiConnection.min.js"></script>
    <!--<script src="/socket.io/socket.io.js"></script>-->
    <script src="https://cdn.webrtc-experiment.com/getMediaElement.js"></script>
    <script src="https://rtcmulticonnection.herokuapp.com/socket.io/socket.io.js"></script>
    <script src="https://cdn.webrtc-experiment.com:443/FileBufferReader.js"></script>

    <script>
        document.getElementById("btnRandom").addEventListener("click", getRandomRoomId);

        function getRandomRoomId(){
            var roomIdLength = 6;
            var roomID = "";
            for(var index=0; index<roomIdLength; index++){
                roomID += Math.ceil(Math.random() * 9) + "";
            }
            document.getElementById("roomID").value = roomID;
        }

        document.getElementById('open').onclick = function() {
            connection.open(document.getElementById('roomID').value);
        };
        document.getElementById('join').onclick = function() {
            connection.join(document.getElementById('roomID').value);
        };

        document.getElementById('share-file').onclick = function() {
            var fileSelector = new FileSelector();
            fileSelector.selectSingleFile(function(file) {
                connection.send(file);
            });
        };
        document.getElementById('input-text-chat').onkeyup = function(e) {
            if (e.keyCode != 13) return;
            // removing trailing/leading whitespace
            this.value = this.value.replace(/^\s+|\s+$/g, '');
            if (!this.value.length) return;
            connection.send(this.value);
            appendDIV(this.value);
            this.value = '';
        };
        var chatContainer = document.querySelector('.chat-output');
        function appendDIV(event) {
            var div = document.createElement('div');
            div.innerHTML = event.data || event;
            chatContainer.insertBefore(div, chatContainer.firstChild);
            div.tabIndex = 0;
            div.focus();
            document.getElementById('input-text-chat').focus();
        }
        var connection = new RTCMultiConnection();
        connection.socketURL = 'https://rtcmulticonnection.herokuapp.com:443/';
        connection.socketMessageEvent = 'lse rtc demo';
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
            var width = parseInt(connection.videosContainer.clientWidth / 2) - 20;
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
        connection.filesContainer = document.getElementById('file-container');

        connection.onUserIdAlreadyTaken = function(useridAlreadyTaken, yourNewUserId) {
            // seems room is already opened
            connection.join(useridAlreadyTaken);
        };

        var roomid = '';
        if (localStorage.getItem(connection.socketMessageEvent)) {
            roomid = localStorage.getItem(connection.socketMessageEvent);
        } else {
            roomid = connection.token();
        }
        document.getElementById('roomID').value = roomid;
        document.getElementById('roomID').onkeyup = function() {
            localStorage.setItem(connection.socketMessageEvent, this.value);
        };
        if(roomid && roomid.length) {
            document.getElementById('roomID').value = roomid;
            localStorage.setItem(connection.socketMessageEvent, roomid);
            // auto-join-room
            (function reCheckRoomPresence() {
                connection.checkPresence(roomid, function(isRoomExists) {
                    if(isRoomExists) {
                        connection.join(roomid);
                        return;
                    }
                    setTimeout(reCheckRoomPresence, 5000);
                });
            })();
        }
    </script>

</article>

</body>

</html>