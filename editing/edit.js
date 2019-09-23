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

function uploadAppear() {
  var video = document.getElementById('video');
  var form = document.getElementById('upload-form');
  form.hidden = false;
  video.style.display = "none";
}

function displayPicture() {
  var canvas = document.getElementById('canvas');
  var context = canvas.getContext('2d');
  var video = document.getElementById('video');
  var webcam = document.getElementById('webcam');

  video.style.display = "none";
  var width = webcam.clientWidth;
  var height = webcam.clientHeight;
  canvas.setAttribute('width', width);
  canvas.setAttribute('height', height);
  document.getElementById('canvas').hidden = false;
  context.drawImage(video, 0, 0, width, height);
  const data = canvas.toDataURL('image/png');
  document.upload_image.picture.value = data;
  document.getElementById('save').style.display = 'block';
}

function saveUploadButton() {
  var button = document.getElementById('saveUP');
  button.style.display = 'block';
}

var loadFile = function(event) {
  var image = document.getElementById('output');
  image.hidden = false;
  let blob = new Blob([event.target.files[0]], {type: 'image/jpg'});
  var reader = new FileReader();
  reader.readAsDataURL(blob);
  reader.onload = function() {
    image.src = reader.result;
    document.upload_image.uploadedFile.value = reader.result;
    saveUploadButton();
  };
};


// function openModal() {
//   var element = document.getElementById("modal-upload");
//   element.classList.add("is-active");
// }

// function closeModal() {
//   var element = document.getElementById("modal-upload");
//   element.classList.remove("is-active");
// }

// FILTERS //

// filtre 1
document.getElementById("filter-1").addEventListener("click", function() {
  var filter = document.getElementById("chosen-filter").value = "1";
  document.getElementById('showModal').disabled = false;
  document.getElementById('snap').disabled = false;
  var elements = document.getElementsByClassName('is-selected');
  while(elements.length > 0)
    elements[0].classList.remove('is-selected');
  var filtersOn = document.getElementsByClassName('live-filter');
  for (var i = 0; i < filtersOn.length; i++)
    filtersOn[i].hidden = true;
  document.getElementById('live-filter-1').hidden = false;
  document.getElementById('filter-1').classList.add("is-selected");
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
  var filtersOn = document.getElementsByClassName('live-filter');
  for (var i = 0; i < filtersOn.length; i++)
    filtersOn[i].hidden = true;
  document.getElementById('live-filter-2').hidden = false;
  document.getElementById('filter-2').classList.add("is-selected");
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
  var filtersOn = document.getElementsByClassName('live-filter');
  for (var i = 0; i < filtersOn.length; i++)
    filtersOn[i].hidden = true;
  document.getElementById('live-filter-3').hidden = false;
  document.getElementById('filter-3').classList.add("is-selected");
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
});
