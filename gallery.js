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
			else {
				document.getElementById('comment-content').disabled = false;
				document.getElementById('comment-button').disabled = false;
			}
			console.log(this.response);
		}
	};
	xhr.open("POST", "./likes/likes_handler.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("filename=" + src);
}

function isLiked(src) {
	var xhr = getXMLHttpRequest();
	var heart = document.getElementById("like-button");
	xhr.onreadystatechange = function(event) {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			console.log(this.response);
			if (this.response.match(/error/)) {
				heart.classList.remove("far");
				heart.classList.add("fas");
				heart.classList.remove("has-text-danger");
				heart.classList.add("has-text-grey-light");
			}
			else {
				if (this.response == 1) {
					heart.classList.remove("far");
					heart.classList.add("fas");
				}
				else {
					heart.classList.remove("fas");
					heart.classList.add("far");
				}
			}
		}
	};
	xhr.open("POST", "./likes/likes_handler.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("isLiked=" + src);
}

function comment(src, content) {
	var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function(event) {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {

		}
	};
	xhr.open("POST", "./comments/comments_handler.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("src=" + src + "&content=" + content);
}
var content = "";
var src = "";

function getComment() {
	content = document.getElementById("comment-content").value;
	comment(src, content);
	// location.reload();
}

function displayComments(src) {
	var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function(event) {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			console.log(this.response);
			var allComments = this.response;
			var tab = JSON.parse(allComments, null, 4);
			var list = document.createElement('ul');
			document.getElementById('comm-list').appendChild(list);
			tab.forEach(function(comment) {
				var li = document.createElement('li');
				li.className = "li-comm";
				list.appendChild(li);
				li.innerHTML = comment.content;
			});
		}
	};
	xhr.open("POST", "./comments/comments_handler.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("file=" + src);
}

function isLogged() {
	var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function(event) {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			console.log(this.response);
			if (this.response.match(/logged/)) {
				document.getElementById('comment-content').disabled = false;
				document.getElementById('comment-button').disabled = false;
			}
		}
	};
	xhr.open("POST", "./comments/comments_handler.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("logged=" + 1);
}

document.querySelectorAll('.modal-button').forEach(function(el) {
	el.addEventListener('click', function() {
		var target = document.querySelector(el.getAttribute('data-target'));
		target.classList.add('is-active');
		src = this.querySelector('img').src;
		var likes = parseInt(this.querySelector("#nb_likes").textContent);
		document.getElementById("nb_likes_modal").innerHTML = likes;
		var imageModal = document.getElementById("image-modal");
		imageModal.setAttribute("src", src);
		src = unescape(encodeURIComponent(src));
		src = src.substring(src.indexOf("/uploads"));
		src = ".." + src;
		isLiked(src);
		displayComments(src);
		isLogged();
		var likeButton = document.getElementById("like-button");
		likeButton.addEventListener('click', function() {
			request(src);
			var heart = document.getElementById("like-button");
			if (heart.classList.contains("far")) {
				heart.classList.remove("far");
				heart.classList.add("fas");
				var nbLikes = parseInt(document.getElementById("nb_likes_modal").textContent) + 1;
				document.getElementById("nb_likes_modal").innerHTML = nbLikes;
			}
			else {
				heart.classList.remove("fas");
				heart.classList.add("far");
				var nbLikes = parseInt(document.getElementById("nb_likes_modal").textContent) - 1;
				document.getElementById("nb_likes_modal").innerHTML = nbLikes;
			}
		});
		target.querySelector('#detailClose').addEventListener('click',   function() {
			target.classList.remove('is-active');
			location.reload();
	   });
	});
  });


