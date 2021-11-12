<!-- /* ここからskyway--------------------------------------------- */ -->
<style>
    .sky {
      position: relative;
      /* top:-62px;
      left:200px; */
      color:brown;
      margin: 16px auto;
      /* display: flex;
      justify-content: center; */
      /* border: solid 1px white; */
      width: 280px;
      height: 50px;
      /* background: #fff; */
    }

    .sky input {
      height: 18px;
      width: 150px;
      position:absolute;
      bottom:0;
      background-color: #fff;
      border: 1px solid black;
      color:black;
      text-indent: 3px;
      font-size:12px;
      margin-left:16px;
      /* pointer-events: none; */
    }
    .sky span {
      position:absolute;
      bottom:22px;
      left:0px;
    }
    .sky button{
      height: 22px;
      position:absolute;
      color:black;
      bottom:20px;
      width:55px;
      right:0;
      pointer-events: auto;
    }

    .sky #js-join-trigger {
      right:35px;
      top:16px;
      pointer-events: auto;
      font-size:14px;
      color:brown;
      border:brown solid 1px;
    }
    .sky #js-leave-trigger {
      right:-30px;
      top:16px;
      pointer-events: auto;
      font-size:14px;
      color:brown;
      border:brown solid 1px;
    }
    
    .sky .messages {
      position:absolute;
      left: 112%;
      bottom:0;
      height: 50px;
      overflow   : auto;
      color: lightgray;
    }

    .sky video{
      width: 0;
      height: 0;
    }
</style>
<!-- /* -- ここまでskyway--------------------------------------------- - */ -->






<p style="color:brown;border-bottom:solid 1px brown">Voice Chat</p>
<p style="color:brown;border-bottom:solid 1px brown;font-size:80px">Under ConstructioN</p>

<!-- ここからskyway--------------------------------------------- -->
<div class="sky">
        <video id="js-local-stream"></video>
        <span id="js-room-mode"><p>VOICE_CHAT(by skyway)</p></span>
        <input type="text" placeholder="Room Name" id="js-room-id">
        <button id="js-join-trigger"><p>Join</p></button>
        <button id="js-leave-trigger"><p>Leave</p></button>
        <div class="remote-streams" id="js-remote-streams"></div>
        <pre class="messages" id="js-messages"></pre>
</div>
<!-- ここまでskyway--------------------------------------------- -->

<!-- skyway -------------------------------------------------------- -->
<script src="//cdn.webrtc.ecl.ntt.com/skyway-4.4.1.js"></script>
<!-- skyway -------------------------------------------------------- -->
     <script>

const Peer = window.Peer;
(async function main() {
    const localVideo = document.getElementById('js-local-stream');
    const joinTrigger = document.getElementById('js-join-trigger');
    const leaveTrigger = document.getElementById('js-leave-trigger');
    const remoteVideos = document.getElementById('js-remote-streams');
    const roomId = document.getElementById('js-room-id');
    const roomMode = document.getElementById('js-room-mode');
    const messages = document.getElementById('js-messages');
    
    const getRoomModeByHash = () => (location.hash === '#sfu' ? 'sfu' : 'sfu');

    // roomMode.textContent = getRoomModeByHash();
    window.addEventListener(
        'hashchange',
        () => (roomMode.textContent = getRoomModeByHash())
    );

    const localStream = await navigator.mediaDevices
        .getUserMedia({
            audio: true,
            video: false,
        }).catch(console.error);

    localVideo.muted = true;
    localVideo.srcObject = localStream;
    localVideo.playsInline = false;
    await localVideo.play().catch(console.error);

    const peer = (window.peer = new Peer({
        key: '7fb74053-4689-485c-900e-6ceb33be1b56',
        debug: 3,
    }));


    joinTrigger.addEventListener('click', () => {
        // firebase.database().ref(SVR + '/sky').set(roomId.value);
        if (!peer.open) {
            return;
        }
        const room = peer.joinRoom(roomId.value, {
            mode: getRoomModeByHash(),
            stream: localStream,
        });
        const audioTrack = localStream.getAudioTracks()[0];
            audioTrack.enabled = true;
        
        room.once('open', () => {
            messages.textContent = '=== You joined ===\n' + messages.textContent;
        });
        room.on('peerJoin', peerId => {
            messages.textContent = `=== ${peerId} joined ===\n` + messages.textContent;
        });
        room.on('stream', async stream => {
            const newVideo = document.createElement('video');
            newVideo.srcObject = stream;
            newVideo.playsInline = true;
            // mark peerId to find it later at peerLeave event
            newVideo.setAttribute('data-peer-id', stream.peerId);
            remoteVideos.append(newVideo);
            await newVideo.play().catch(console.error);
        });
        room.on('data', ({ data, src }) => {
            // Show a message sent to the room and who sent
            messages.textContent += `${src}: ${data}\n`;
        });
        room.on('peerLeave', peerId => {
            const remoteVideo = remoteVideos.querySelector(
                `[data-peer-id="${peerId}"]`
            );
            remoteVideo.srcObject.getTracks().forEach(track => track.stop());
            remoteVideo.srcObject = null;
            remoteVideo.remove();

            messages.textContent = `=== ${peerId} left ===\n` + messages.textContent;
        });
        room.once('close', () => {
            messages.textContent = '== You left ===\n' + messages.textContent;
            Array.from(remoteVideos.children).forEach(remoteVideo => {
                remoteVideo.srcObject.getTracks().forEach(track => track.stop());
                remoteVideo.srcObject = null;
                remoteVideo.remove();
            });
        });
        leaveTrigger.addEventListener('click', () => room.close(), { once: true });
    });

    peer.on('error', console.error);
})();    
    </script>