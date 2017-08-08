
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">

    <style>
        video {
            object-fit: fill;
            width: 30%;
        }
    </style>
</head>

<body>
<article>

    <section class="experiment">
        <div>
            <input type="text" id="room-id" value="abcdef">
            <button id="open-room">Open Room</button>
            <button id="join-room">Join Room</button>
            <input type="text" id="input-text-chat" placeholder="Enter Text Chat" disabled>
            <button id="share-file" disabled>Share File</button>
            <br><br>
            <button id="btn-leave-room" disabled>Leave /or close the room</button>

        </div>

        <div id="chat-container">
            <div id="file-container"></div>
            <div class="chat-output"></div>
        </div>

        <div id="videos-container"></div>
    </section>

    <script src="tempjs/RTCMultiConnection.js"></script>
    <!--<script src="/socket.io/socket.io.js"></script>-->
    <script src="https://cdn.webrtc-experiment.com/getMediaElement.js"></script>
    <script src="tempjs/FileBufferReader.js"></script>

    <script>
        document.getElementById('open-room').onclick = function() {
            connection.open(document.getElementById('room-id').value, function() {
            });
        };
        document.getElementById('join-room').onclick = function() {
            connection.join(document.getElementById('room-id').value);
        };
        document.getElementById('btn-leave-room').onclick = function() {
            this.disabled = true;
            if(connection.isInitiator) {
                connection.closeEntireSession(function() {
                    document.querySelector('h1').innerHTML = 'Entire session has been closed.';
                });
            }
            else {
                connection.leave();
            }
        };
        document.getElementById('share-file').onclick = function() {
            var fileSelector = new FileSelector();
            fileSelector.selectSingleFile(function(file) {
                connection.send(file);
            });
        };
        document.getElementById('input-text-chat').onkeyup = function(e) {
            if (e.keyCode != 13) return;
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
        connection.socketMessageEvent = 'audio-video-file-chat-demo';
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
        connection.onopen = function() {
            document.getElementById('share-file').disabled = false;
            document.getElementById('input-text-chat').disabled = false;
            document.getElementById('btn-leave-room').disabled = false;
            document.querySelector('h1').innerHTML = 'You are connected with: ' + connection.getAllParticipants().join(', ');
        };
        connection.onclose = function() {
            if(connection.getAllParticipants().length) {
                document.querySelector('h1').innerHTML = 'You are still connected with: ' + connection.getAllParticipants().join(', ');
            }
            else {
                document.querySelector('h1').innerHTML = 'Seems session has been closed or all participants left.';
            }
        };
        connection.onEntireSessionClosed = function(event) {
            document.getElementById('share-file').disabled = true;
            document.getElementById('input-text-chat').disabled = true;
            document.getElementById('btn-leave-room').disabled = true;
            document.getElementById('open-or-join-room').disabled = false;
            document.getElementById('open-room').disabled = false;
            document.getElementById('join-room').disabled = false;
            document.getElementById('room-id').disabled = false;
            connection.attachStreams.forEach(function(stream) {
                stream.stop();
            });
        };
        connection.onUserIdAlreadyTaken = function(useridAlreadyTaken, yourNewUserId) {
            connection.join(useridAlreadyTaken);
        };
        function showRoomURL(roomid) {
            var roomHashURL = '#' + roomid;
            var roomQueryStringURL = '?roomid=' + roomid;
            var html = '<h2>Unique URL for your room:</h2><br>';
            html += 'Hash URL: <a href="' + roomHashURL + '" target="_blank">' + roomHashURL + '</a>';
            html += '<br>';
            html += 'QueryString URL: <a href="' + roomQueryStringURL + '" target="_blank">' + roomQueryStringURL + '</a>';
        }
        (function() {
            var params = {},
                r = /([^&=]+)=?([^&]*)/g;
            function d(s) {
                return decodeURIComponent(s.replace(/\+/g, ' '));
            }
            var match, search = window.location.search;
            while (match = r.exec(search.substring(1)))
                params[d(match[1])] = d(match[2]);
            window.params = params;
        })();
        var roomid = '';
        if (localStorage.getItem(connection.socketMessageEvent)) {
            roomid = localStorage.getItem(connection.socketMessageEvent);
        } else {
            roomid = connection.token();
        }
        document.getElementById('room-id').value = roomid;
        document.getElementById('room-id').onkeyup = function() {
            localStorage.setItem(connection.socketMessageEvent, this.value);
        };
        var hashString = location.hash.replace('#', '');
        if(hashString.length && hashString.indexOf('comment-') == 0) {
            hashString = '';
        }
        var roomid = params.roomid;
        if(!roomid && hashString.length) {
            roomid = hashString;
        }
        if(roomid && roomid.length) {
            document.getElementById('room-id').value = roomid;
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