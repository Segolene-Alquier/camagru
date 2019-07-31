// DISPLAY VIDEO //

var video = document.querySelector("#video");

if (navigator.mediaDevices.getUserMedia) {
  navigator.mediaDevices.getUserMedia({ video: { width: 500, height: 500 } })
    .then(function (stream) {
      video.srcObject = stream;
    })
    .catch(function (err0r) {
      console.log("Something went wrong!");
    });
}

// Elements for taking the snapshot
var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
var video = document.getElementById('video');

// Trigger photo take
document.getElementById("snap").addEventListener("click", function() {
	context.drawImage(video, 0, 0, 500, 500);
	video.style.display = "none";
});

// UPLOAD MODAL APPEARS & DISAPPEARS
$("#showModal").click(function() {
	$(".modal").addClass("is-active");
});
$("#modal-close").click(function() {
	$(".modal").removeClass("is-active");
});

// (function() {

// 	var streaming = false,
// 		video        = document.querySelector('#video'),
// 		cover        = document.querySelector('#cover'),
// 		canvas       = document.querySelector('#canvas'),
// 		// photo        = document.querySelector('#photo'),
// 		startbutton  = document.querySelector('#startbutton'),
// 		width = 320,
// 		height = 0;

// 	navigator.getMedia = ( navigator.getUserMedia ||
// 						   navigator.webkitGetUserMedia ||
// 						   navigator.mozGetUserMedia ||
// 						   navigator.msGetUserMedia);

// 	navigator.getMedia(
// 	  {
// 		video: true,
// 		audio: false
// 	  },
// 	  function(stream) {
// 		if (navigator.mozGetUserMedia) {
// 		  video.mozSrcObject = stream;
// 		} else {
// 		  var vendorURL = window.URL || window.webkitURL;
// 		//   video.src = vendorURL.createObjectURL(stream);
// 		  video.mozSrcObject = stream;
// 		}
// 		video.play();
// 	  },
// 	  function(err) {
// 		console.log("An error occured! " + err);
// 	  }
// 	);

// 	video.addEventListener('canplay', function(ev){
// 	  if (!streaming) {
// 		height = video.videoHeight / (video.videoWidth/width);
// 		video.setAttribute('width', width);
// 		video.setAttribute('height', height);
// 		canvas.setAttribute('width', width);
// 		canvas.setAttribute('height', height);
// 		streaming = true;
// 	  }
// 	}, false);

// 	function takepicture() {
// 	  canvas.width = width;
// 	  canvas.height = height;
// 	  canvas.getContext('2d').drawImage(video, 0, 0, width, height);
// 	  var data = canvas.toDataURL('image/png');
// 	//   photo.setAttribute('src', data);
// 	}

// 	startbutton.addEventListener('click', function(ev){
// 		takepicture();
// 	  ev.preventDefault();
// 	}, false);

//   })();
