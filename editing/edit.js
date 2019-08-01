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

document.getElementById("save").addEventListener("click", function() {
  const data = canvas.toDataURL('image/png');
  console.log(data);
  // photo.setAttribute('src', data);
  // document.upload_image.picture.value = data;
  $.ajax({
    url:'save_webcam.php',
    type:'POST',
    data:{
        data:data
    }
  });
});


// UPLOAD MODAL APPEARS & DISAPPEARS
$("#showModal").click(function() {
	$(".modal").addClass("is-active");
});
$("#modal-close").click(function() {
	$(".modal").removeClass("is-active");
});
$("#cancel-close").click(function() {
	$(".modal").removeClass("is-active");
});
