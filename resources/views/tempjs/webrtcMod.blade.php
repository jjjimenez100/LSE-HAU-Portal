
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>LSE-HAU Web RTC</title>

</head>

<body>
<div class="col">
    <h1 id="uniqRoomId"></h1>
</div>
<div class="container-fluid col-md-2">
            <label for="roomID">Room ID:</label>
            <input type="text" class="form-control" id="roomID" size="15">
        <button class="btn btn-default" id="btnRandom" style="margin: 5%">Random Room ID</button>
        <button class="btn btn-default" style="margin: 5%">Create or join Room</button>
        <button class="btn btn-default" style="margin: 5%">Upload File</button>
</div>

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
        disableInputButtons();
        connection.open(document.getElementById('room-id').value, function() {
            showRoomURL(connection.sessionid);
        });
    };
    document.getElementById('join').onclick = function() {
        disableInputButtons();
        connection.join(document.getElementById('room-id').value);
    };

    function currentRoomId(roomID){
        document.getElementById("uniqRoomId").innerHTML = roomID;
    }

    function uploadFiles(){
        var fileDialog = new FileSelector();
        fileDialog.selectSingleFile(function(file){
            connection.send(file);
        });
    }
</script>
<article>

    <section class="experiment">
        <div class="make-center">
            <input type="text" id="room-id" value="abcdef">
            <button id="open-room">Open Room</button>
            <button id="join-room">Join Room</button>
            <button id="open-or-join-room">Auto Open Or Join Room</button>

            <br><br>
            <input type="text" id="input-text-chat" placeholder="Enter Text Chat" disabled>
            <button id="share-file" disabled>Share File</button>
            <br><br>
            <button id="btn-leave-room" disabled>Leave /or close the room</button>

            <div id="room-urls" style="text-align: center;display: none;background: #F1EDED;margin: 15px -10px;border: 1px solid rgb(189, 189, 189);border-left: 0;border-right: 0;"></div>
        </div>

        <div id="chat-container">
            <div id="file-container"></div>
            <div class="chat-output"></div>
        </div>

        <div id="videos-container"></div>
    </section>

    <script src="/dist/RTCMultiConnection.min.js"></script>
    <script src="/socket.io/socket.io.js"></script>

    <!-- custom layout for HTML5 audio/video elements -->
    <script src="https://cdn.webrtc-experiment.com/getMediaElement.js"></script>
    <script src="https://cdn.webrtc-experiment.com:443/FileBufferReader.js"></script>

    <script>
        // ......................................................
        // .......................UI Code........................
        // ......................................................
        document.getElementById('open-room').onclick = function() {
            disableInputButtons();
            connection.open(document.getElementById('room-id').value, function() {
                showRoomURL(connection.sessionid);
            });
        };
        document.getElementById('join-room').onclick = function() {
            disableInputButtons();
            connection.join(document.getElementById('room-id').value);
        };
        document.getElementById('open-or-join-room').onclick = function() {
            disableInputButtons();
            connection.openOrJoin(document.getElementById('room-id').value, function(isRoomExists, roomid) {
                if(!isRoomExists) {
                    showRoomURL(roomid);
                }
            });
        };
        document.getElementById('btn-leave-room').onclick = function() {
            this.disabled = true;
            if(connection.isInitiator) {
                // use this method if you did NOT set "autoCloseEntireSession===true"
                // for more info: https://github.com/muaz-khan/RTCMultiConnection#closeentiresession
                connection.closeEntireSession(function() {
                    document.querySelector('h1').innerHTML = 'Entire session has been closed.';
                });
            }
            else {
                connection.leave();
            }
        };
        // ......................................................
        // ................FileSharing/TextChat Code.............
        // ......................................................
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
        // ......................................................
        // ..................RTCMultiConnection Code.............
        // ......................................................
        var connection = new RTCMultiConnection();
        // by default, socket.io server is assumed to be deployed on your own URL
        connection.socketURL = '/';
        // comment-out below line if you do not have your own socket.io server
        // connection.socketURL = 'https://rtcmulticonnection.herokuapp.com:443/';
        connection.socketMessageEvent = 'audio-video-file-chat-demo';
        connection.enableFileSharing = true; // by default, it is "false".
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
            // don't display alert for moderator
            if(connection.userid === event.userid) return;
            document.querySelector('h1').innerHTML = 'Entire session has been closed by the moderator: ' + event.userid;
        };
        connection.onUserIdAlreadyTaken = function(useridAlreadyTaken, yourNewUserId) {
            // seems room is already opened
            connection.join(useridAlreadyTaken);
        };
        function disableInputButtons() {
            document.getElementById('open-or-join-room').disabled = true;
            document.getElementById('open-room').disabled = true;
            document.getElementById('join-room').disabled = true;
            document.getElementById('room-id').disabled = true;
        }
        // ......................................................
        // ......................Handling Room-ID................
        // ......................................................
        function showRoomURL(roomid) {
            var roomHashURL = '#' + roomid;
            var roomQueryStringURL = '?roomid=' + roomid;
            var html = '<h2>Unique URL for your room:</h2><br>';
            html += 'Hash URL: <a href="' + roomHashURL + '" target="_blank">' + roomHashURL + '</a>';
            html += '<br>';
            html += 'QueryString URL: <a href="' + roomQueryStringURL + '" target="_blank">' + roomQueryStringURL + '</a>';
            var roomURLsDiv = document.getElementById('room-urls');
            roomURLsDiv.innerHTML = html;
            roomURLsDiv.style.display = 'block';
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
            disableInputButtons();
        }
    </script>


</article>
</body>

</html>