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

document.getElementById('snap').addEventListener('click', function() {
    //context.drawImage(video, 0, 0, 320, 240);
    //context.drawImage(img, 0, 0, 320, 240);
});

document.getElementById('snap').disabled = true;

document.getElementById('options').addEventListener('change', function() {
    drop = document.getElementById('options');
    selected = drop.options[drop.selectedIndex].text;
    if (selected == "None")
        document.getElementById('snap').disabled = true;
    else
        document.getElementById('snap').disabled = false;        
})