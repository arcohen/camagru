
// Webcam button control etc

var video = document.getElementById('video');

if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
        video.srcObject = stream;
        video.play();
    });
}

var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
var video = document.getElementById('video');
var image = new Image();
var canSubmit = false;
var drop = document.getElementById('options');
var selected;
var uploadBut = document.getElementById('upload-button');

document.getElementById('submit').disabled = true;
uploadBut.disabled = true;


function put_on_canvas(paste) {
    console.log(paste);

    context.drawImage(paste, 0, 0, 320, 240);
    canvas.toDataURL();
    document.getElementById("img_tag").value = canvas.toDataURL();
}

document.getElementById('snap').addEventListener('click', function() {
        put_on_canvas(video);
        canSubmit = true;
});

document.getElementById('upload-button').addEventListener('click', function() {
        put_on_canvas(image);
        canSubmit = true;
});

setInterval(function() {
    selected = drop.options[drop.selectedIndex].text;
    if (canSubmit && selected != "None")
        document.getElementById('submit').disabled = false;
}, 10);

function checkURL(url) {
    return(url.match(/image\/(jpg|gif|png|jpeg)/) != null);
}


document.querySelector('#img_upload').addEventListener('change', function() {

       if (this.files.length === 0)
           return;

       var file = this.files[0];
       var reader = new FileReader();
       reader.onload = function(e) {
            if (checkURL(e.target.result)) {
                image.src = e.target.result;
                uploadBut.disabled = false;
            }

            else {
                alert("wrong file type");
                uploadBut.disabled = true;
            }
       };
       reader.readAsDataURL(file);
   }, false);


