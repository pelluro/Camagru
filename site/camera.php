<?php
$titlePage = "Camera";
$requireLogin = TRUE;
include('./views/header.php');
?>
<div class="col-xs-12">
    <div class="col-xs-8">
    <div class="panel panel-info">
        <div class="panel-heading">Caméra</div>
        <div class="panel-body" align="center">
		<div class="col-xs-12">
        <device type="media" onchange="update(this.data)"></device>
        <video autoplay ></video>
        <img id="capture" src="" style="display:none;">
        <img id="final" src="">
        <canvas style="display:none;"></canvas>
        <input type="hidden" id="selectedImage" value="0"/>
        </div>
        <div class="col-xs-12" id="filtres" style="display: none;">
            <?php
            $imagesSupp = $dbConnector->getPictures(1);
            foreach($imagesSupp as $image)
            {
                $imageID = $image->getID();
                ?>
                <img class="imgSupp" onclick="SelectImage(<?=$image->getID()?>)" src="img/<?=$image->filename?>" width="80" height="80" id="img_<?=$imageID?>"/>
                <?php
            }
            ?>
        </div>
        <div class="col-xs-12" id="divbtnCamera">
            <button type="button" id="btnCamera" onclick="Camera()" class="btn btn-default btn-sm">Start</button>
        </div>
        <div class="col-xs-12" id="divbtnCapture" style="display: none;">
            <button type="button" id="btnCapture" onclick="Capture()" class="btn btn-default btn-sm">Capture</button>
        </div>
        <div class="col-xs-12" id="divbtnSave" style="display: none;">
            <button type="button" id="btnSave" onclick="Save()" class="btn btn-default btn-sm">Save</button>
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
<div id="imgAddedHere">

</div>
    <script type="text/javascript">
	function SelectImage(id)
    {
        document.getElementById('selectedImage').setAttribute('value', id);
        var imgs = document.getElementsByClassName('selectedimg');
        for(var i = 0; i < imgs.length; i++)
        {
            imgs[i].classList.remove('selectedimg');
        }
        var image = document.getElementById('img_' + id);
        if(!image.classList.contains('selectedimg')) {
            image.classList.add('selectedimg');
        }
        var canvas = document.querySelector('canvas');
        var imgCapture = document.getElementById('capture');
        canvas.getContext('2d').drawImage(imgCapture, 0, 0);
        canvas.getContext('2d').drawImage(image, 0, 0);
        var img = document.getElementById('final');
        img.src = canvas.toDataURL('image/webp');
    }

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
            video.onloadedmetadata = function() {
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

    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    canvas.getContext('2d').drawImage(video, 0, 0);
    // Other browsers will fall back to image/png
    var img = document.getElementById('capture');
    img.src = canvas.toDataURL('image/webp');
    img = document.getElementById('final');
    img.src = canvas.toDataURL('image/webp');
    document.getElementById("divbtnSave").style.display="block";
    document.getElementById('filtres').style.display='block';
}

function Save() {
    var canvas = document.querySelector('canvas');
    var imgSelectedID = document.getElementById('selectedImage').value;
    var formData = new FormData();
    formData.append('imgSelected',imgSelectedID);
    formData.append('image',canvas.toDataURL());

    var xhr = new XMLHttpRequest();
    xhr.open('POST','business/merge.php', true);
    xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');

    xhr.onload = function(data) {
        if (xhr.status === 200) {
            alert(data.toString());
        }
        else
        {
            alert(xhr.status + " : Error");
        }
    };

    xhr.send(formData);
}
    </script>
<?php
include('./views/footer.php');
?>