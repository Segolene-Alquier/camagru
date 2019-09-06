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


function isLiked(src) {
	var xhr = getXMLHttpRequest();
	var heart = document.getElementById("like-button");
	xhr.onreadystatechange = function(event) {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			console.log(this.response);
			if (this.response == 1) {
				heart.classList.remove("far");
				heart.classList.add("fas");
			}
			else {
				heart.classList.remove("fas");
				heart.classList.add("far");
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

			// var allComments = this.response;
			// document.getElementById("comm").innerHTML = JSON.stringify(allComments, null, 4);
			// console.log(allComments)
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

			var allComments = this.response;
			var tab = JSON.parse(allComments, null, 4);
			var list = document.createElement('ul');
			// var li = document.createElement('li');
			// var clone;
			document.getElementById('comm-list').appendChild(list);
			tab.forEach(function(comment) {
				var li = document.createElement('li');
				list.appendChild(li);

    			li.innerHTML = comment.content;
				// li.textContent = comment;
				// list.appendChild(li);
				// clone = li.cloneNode();
				// div.appendChild(document.createTextNode('top div'));
				// div.appendChild(element);
				// clone.innerHTML = comment.content;
				// var currentDiv = document.getElementById("comm-list");
				// document.body.insertBefore(list, currentDiv);

    			// tab.appendChild(clone);
				// var newDiv = document.createElement("div");
				// var newContent = document.createTextNode(comment.content);
				// newDiv.appendChild(newContent);

				// var currentDiv = document.getElementById('comm');
				// console.log(currentDiv);
				// document.body.insertBefore(newDiv, currentDiv);
				// document.getElementById("comm").innerHTML = JSON.stringify(comment.content);
				// console.log(comment.content);
			});
			// document.getElementById("comm").innerHTML = JSON.parse(allComments, null, 4);
			// console.log(JSON.parse(allComments, null, 4))
		}
	};
	xhr.open("POST", "./comments/comments_handler.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("file=" + src);
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


