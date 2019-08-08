function getXMLHttpRequest() {
	var xhr = null;

	if (window.XMLHttpRequest || window.ActiveXObject) {
		if (window.ActiveXObject) {
			try {
				xhr = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
		} else {
			xhr = new XMLHttpRequest();
		}
	} else {
		alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
		return null;
	}

	return xhr;
}

function request(src) {
	var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			alert(src); // C'est bon \o/
		}
	};
	xhr.open("POST", "./likes_handler.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("filename=src");
}

// function readData(sData) {
// 	// On peut maintenant traiter les données sans encombrer l'objet XHR.
// 	if (sData == "OK") {
// 		alert("C'est bon");
// 	} else {
// 		alert("Y'a eu un problème");
// 	}
// }

document.querySelectorAll('.modal-button').forEach(function(el) {
	el.addEventListener('click', function() {
// debugger;
		var target = document.querySelector(el.getAttribute('data-target'));
		target.classList.add('is-active');
		var src = this.querySelector('img').src;
		var imageModal = document.getElementById("image-modal");
		imageModal.setAttribute("src", src);
		src = unescape(encodeURIComponent(src));
		src = src.substring(src.indexOf("/uploads"));
		src = ".." + src;
		var likeButton = document.getElementById("like-button");
		likeButton.addEventListener('click', function() {
			// alert(src);
		  	request(src);

		});

		target.querySelector('#detailClose').addEventListener('click',   function() {
			target.classList.remove('is-active');
	   });
	});
  });


