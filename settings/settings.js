var yes = document.getElementById("notif-yes");
var no = document.getElementById("notif-no");

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

function modifyName() {
	var oldname = document.getElementById("old_name").value;
	var newname = document.getElementById("new_name").value;
	var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function(event) {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			console.log(this.response);
		}
	};
	xhr.open("POST", "./settings_handler.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("oldname=" + oldname + "&newname=" + newname);
}

function modifyPassword() {
	var oldpwd = document.getElementById("old_pwd").value;
	var newpwd = document.getElementById("new_pwd").value;
	console.log(oldpwd);
	console.log(newpwd);
	var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function(event) {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			console.log(this.response);
		}
	};
	xhr.open("POST", "./settings_handler.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("oldpwd=" + oldpwd + "&newpwd=" + newpwd);
}

function modifyMail() {
	var oldmail = document.getElementById("old_mail").value;
	var newmail = document.getElementById("new_mail").value;
	var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function(event) {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			console.log(this.response);
		}
	};
	xhr.open("POST", "./settings_handler.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("oldmail=" + oldmail + "&newmail=" + newmail);
}


function notifNo() {
	yes.classList.remove("is-success");
	no.classList.add("is-danger");

	var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function(event) {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			console.log(this.response);
		}
	};
	xhr.open("POST", "./notif_handler.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("clic=" + 0);
}

function notifYes() {
	yes.classList.add("is-success");
	no.classList.remove("is-danger");

	var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function(event) {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			console.log(this.response);
		}
	};
	xhr.open("POST", "./notif_handler.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("clic=" + 1);
}

function wantsNotification() {
	var xhr = getXMLHttpRequest();

	xhr.onreadystatechange = function(event) {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			console.log(this.response);
			if (this.response.match(/1/))
				no.classList.remove("is-danger");
			else
				yes.classList.remove("is-success");
		}
	};
	xhr.open("POST", "./notif_handler.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("notif=" + 1);
}

// window.onload = wantsNotification();
