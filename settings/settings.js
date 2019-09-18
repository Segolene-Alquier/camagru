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

function checkFields(field1, field2) {
	if (field1 === "" ||  field2 === "") {
		alert("The fields cannot be empty! 🤓");
		return (0);
	}
	return (1);
}

function checkPassword() {
	var password = document.getElementById("new_pwd").value;;
	if (!password.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/)) {
		alert("Password must have at least 8 characters, one uppercase letter, one lowercase letter and one number. 🙏");
		return(0);
	}

	modifyPassword();
	return (1);
}

function modifyName() {
	var oldname = document.getElementById("old_name").value;
	var newname = document.getElementById("new_name").value;
	if (checkFields(oldname, newname)) {
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
}

function modifyPassword() {
	var oldpwd = document.getElementById("old_pwd").value;
	var newpwd = document.getElementById("new_pwd").value;
	if (checkFields(oldpwd, newpwd)) {
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
}

function modifyMail() {
	var oldmail = document.getElementById("old_mail").value;
	var newmail = document.getElementById("new_mail").value;
	if (checkFields(oldmail, newmail)) {
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
