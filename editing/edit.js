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

// FILTERS //

var filter = document.getElementById("filter-1");
document.getElementById("filter-1").addEventListener("click", function() {
  document.getElementById("chosen-filter").value = "1";
  console.log(document.getElementById("chosen-filter").value);
});

var filter = document.getElementById("filter-2");
document.getElementById("filter-2").addEventListener("click", function() {
  document.getElementById("chosen-filter").value = "2";
  console.log(document.getElementById("chosen-filter").value);
});

var filter = document.getElementById("filter-3");
document.getElementById("filter-3").addEventListener("click", function() {
  document.getElementById("chosen-filter").value = "3";
  console.log(document.getElementById("chosen-filter").value);
});

var filter = document.getElementById("filter-4");
document.getElementById("filter-4").addEventListener("click", function() {
  document.getElementById("chosen-filter").value = "4";
  console.log(document.getElementById("chosen-filter").value);
});

var filter = document.getElementById("filter-5");
document.getElementById("filter-5").addEventListener("click", function() {
  document.getElementById("chosen-filter").value = "5";
  console.log(document.getElementById("chosen-filter").value);
});
