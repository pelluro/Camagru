<?php
$titlePage = "Camera";
include('./views/header.php');
?>
<div class="col-xs-12">
    <div class="col-xs-8">
    <div class="panel panel-info">
        <div class="panel-heading">Caméra</div>
        <div class="panel-body" align="center">
            <div class="col-xs-12">
            <device type="media" onchange="update(this.data)"></device>
            <video autoplay></video>
            <img src="">
            <canvas style="display:none;"></canvas>
            </div>
            <div class="col-xs-12" id="divbtnCamera">
                <button type="button" id="btnCamera" onclick="Camera()" class="btn btn-default btn-sm">Start</button>
            </div>
            <div class="col-xs-12" id="divbtnCapture" style="display: none;">
                <button type="button" id="btnCapture" onclick="Capture()" class="btn btn-default btn-sm">Capture</button>
            </div>
        </div>
    </div>
    </div>
    <div class="col-xs-4">
    <div class="panel panel-info">
        <div class="panel-heading">Pictures</div>
        <div class="panel-body" align="center">
        </div>
    </div>
    </div>
</div>
    <br/><br/><br/>
    <script type="text/javascript">
    function Camera() {
    // Parfois ce champ est undefined car le navigateur est vieux, donc on le défini en objet vide
    if (navigator.mediaDevices === undefined) {
        navigator.mediaDevices = {};
    }
    // En cas de vieux navigateur, getUserMedia sera aussi non défini donc le défini à la main
    if (navigator.mediaDevices.getUserMedia === undefined) {
        navigator.mediaDevices.getUserMedia = function(constraints) {

            // On regarde si on peut atteindre la fonction existante du vieux navigateur
            var getUserMedia = navigator.webkitGetUserMedia || navigator.mozGetUserMedia;

            // Si on trouve pas, le navigateur est vraiment trop vieux et on dis que c'est pas possible.
            if (!getUserMedia) {
                return Promise.reject(new Error('Browser is too old'));
            }

            // Sinon, on encapsule l'appel dans une promesse
            return new Promise(function(resolve, reject) {
                getUserMedia.call(navigator, constraints, resolve, reject);
            });
        }
    }
    document.getElementById("btnCamera").setAttribute('disabled','disabled');
    document.getElementById("btnCamera").innerText = "Starting...";
    var constraints = { audio: false, video: true };
    navigator.mediaDevices.getUserMedia(constraints).then(function(mediaStream)
        {
            var video = document.querySelector('video');
            // Parfois les vieux navigateurs n'ont pas de "srcObject"
            if ("srcObject" in video) {
                video.srcObject = mediaStream;
            } else {
                // Cette méthode commence à être obsolète
                video.src = window.URL.createObjectURL(mediaStream);
            }
            video.onloadedmetadata = function(e) {
                video.play();
            };
            document.getElementById("divbtnCamera").style.display="none";
            document.getElementById("divbtnCapture").style.display="block";

        })
    .catch(function(err) {
            console.log(err.name + ": " + err.message);
        });
}
function Capture() {
    var video = document.querySelector('video');
    var canvas = document.querySelector('canvas');
    var img = document.querySelector('img');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    canvas.getContext('2d').drawImage(video, 0, 0);
    // Other browsers will fall back to image/png
    img.src = canvas.toDataURL('image/webp');
}
</script>
<?php
include('./views/footer.php');
?>