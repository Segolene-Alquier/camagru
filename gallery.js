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
		return (null);
	}

	return (xhr);
}

function request(src) {
	var xhr = getXMLHttpRequest();

	xhr.onreadystatechange = function(event) {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			if (this.response.match(/error/))
				window.location.replace("./users/login.php");
			console.log(this.response);
		}
	};
	xhr.open("POST", "./likes/likes_handler.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("filename=" + src);
}

document.querySelectorAll('.modal-button').forEach(function(el) {
	el.addEventListener('click', function() {
		var target = document.querySelector(el.getAttribute('data-target'));
		target.classList.add('is-active');
		var src = this.querySelector('img').src;
		var comms = this.querySelector("#nb_comm").textContent;
		// var comms = document.getElementById("nb_comm").value;
		console.log(comms);
		var imageModal = document.getElementById("image-modal");
		imageModal.setAttribute("src", src);
		src = unescape(encodeURIComponent(src));
		src = src.substring(src.indexOf("/uploads"));
		src = ".." + src;
		var likeButton = document.getElementById("like-button");
		likeButton.addEventListener('click', function() {
		  	request(src);
		});

		target.querySelector('#detailClose').addEventListener('click',   function() {
			target.classList.remove('is-active');
	   });
	});
  });


