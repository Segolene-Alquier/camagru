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
	$(".modal").addClass("is-active"); // NEED TO REMOVE JFUCKINGQUERY
});
$("#modal-close").click(function() {
	$(".modal").removeClass("is-active");
});
$("#cancel-close").click(function() {
	$(".modal").removeClass("is-active");
});

// FILTERS //

// filtre 1
document.getElementById("filter-1").addEventListener("click", function() {
  var filter = document.getElementById("chosen-filter").value = "1";
  document.getElementById('showModal').disabled = false;
  document.getElementById('snap').disabled = false;
  var elements = document.getElementsByClassName('is-selected');
  while(elements.length > 0)
    elements[0].classList.remove('is-selected');
  for (var i = 0; i < filtersOn.length; i++)
    filtersOn[i].hidden = true;
  document.getElementById('live-filter-1').hidden = false;
  document.getElementById('filter-1').classList.add("is-selected");
  console.log(document.getElementById("chosen-filter").value);
});

// filtre 2
var filter = document.getElementById("filter-2");
document.getElementById("filter-2").addEventListener("click", function() {
  document.getElementById("chosen-filter").value = "2";
  document.getElementById('showModal').disabled = false;
  document.getElementById('snap').disabled = false;
  var elements = document.getElementsByClassName('is-selected');
  while(elements.length > 0)
    elements[0].classList.remove('is-selected');
  for (var i = 0; i < filtersOn.length; i++)
    filtersOn[i].hidden = true;
  document.getElementById('live-filter-2').hidden = false;
  document.getElementById('filter-2').classList.add("is-selected");
  console.log(document.getElementById("chosen-filter").value);
});

// filtre 3
var filter = document.getElementById("filter-3");
document.getElementById("filter-3").addEventListener("click", function() {
  document.getElementById("chosen-filter").value = "3";
  document.getElementById('showModal').disabled = false;
  document.getElementById('snap').disabled = false;
  var elements = document.getElementsByClassName('is-selected');
  while(elements.length > 0)
    elements[0].classList.remove('is-selected');
  for (var i = 0; i < filtersOn.length; i++)
    filtersOn[i].hidden = true;
  document.getElementById('live-filter-3').hidden = false;
  document.getElementById('filter-3').classList.add("is-selected");
  console.log(document.getElementById("chosen-filter").value);
});

// filtre 4
var filter = document.getElementById("filter-4");
document.getElementById("filter-4").addEventListener("click", function() {
  document.getElementById("chosen-filter").value = "4";
  document.getElementById('showModal').disabled = false;
  document.getElementById('snap').disabled = false;
  var elements = document.getElementsByClassName('is-selected');
  while(elements.length > 0)
    elements[0].classList.remove('is-selected');
  var filtersOn = document.getElementsByClassName('live-filter');
  for (var i = 0; i < filtersOn.length; i++)
    filtersOn[i].hidden = true;
  document.getElementById('live-filter-4').hidden = false;
  document.getElementById('filter-4').classList.add("is-selected");
  console.log(document.getElementById("chosen-filter").value);
});

// filtre 5
var filter = document.getElementById("filter-5");
document.getElementById("filter-5").addEventListener("click", function() {
  document.getElementById("chosen-filter").value = "5";
  document.getElementById('showModal').disabled = false;
  document.getElementById('snap').disabled = false;
  var elements = document.getElementsByClassName('is-selected');
  while(elements.length > 0){
    elements[0].classList.remove('is-selected');
  }
  var filtersOn = document.getElementsByClassName('live-filter');
  for (var i = 0; i < filtersOn.length; i++)
    filtersOn[i].hidden = true;
  document.getElementById('live-filter-5').hidden = false;
  document.getElementById('filter-5').classList.add("is-selected");
  console.log(document.getElementById("chosen-filter").value);
});
