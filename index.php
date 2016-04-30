<html lang="en">
<head>
<!--Sam Shiffman-->
	<meta charset="UTF-8">
	<title>RSS Newsfeed</title>
	<link rel="stylesheet" type="text/css" href="./shiffman_framework.css">
	<link rel="stylesheet" type="text/css" href="./rss.css">


</head>
<body>
	<div class="row header">
		<h1>RSS Feed</h1>
	</div>

<form id="hidden" hidden="true">
	<input type="text" id="loggedInHidden" hidden="true" value="">
	<input type="text" id="userHidden" hidden="true" value="">

</form>
<div class="row">
		<div class="col-3">
			<form id="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<input type="checkbox" class="checkbox" name="check_list[]" value="http://sports.espn.go.com/espn/rss/news"><label>ESPN</label><br/>
				<input type="checkbox" class="checkbox" name="check_list[]" value="http://www.nytimes.com/services/xml/rss/nyt/HomePage.xml"><label>NYT</label><br/>
				<input type="checkbox" class="checkbox" name="check_list[]" value="http://rss.cnn.com/rss/cnn_topstories.rss"><label>CNN</label><br/>
				<input type="checkbox" class="checkbox" name="check_list[]" value="http://www.wired.co.uk/news/rss"><label>WIRED</label><br/>
			</form>
			<form id="login" onsubmit="javascript:login(); return false;" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<h3>Login</h3></br>
				<label>Username: </label><input type="text" id="username" name="username"></br>
				<label>Password: </label><input type="password" id="password" name="password"></br>
				<input type="submit" value="Login" name="Login">
			</form>
			<form id="newUser" onsubmit="javascript:newUser(); return false;" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<h3>Create User</h3></br>
				<label>Username: </label><input type="text" id="newusername" name="username"></br>
				<label>Password: </label><input type="password" id="newpassword" name="password"></br>
				<input type="submit" value="Create" name="Create">
			</form>
			<div id="loginOutput">
			</div>
		</div>

		<div id="rssOutput" class="col-9">


	  </div>
	</div>

<script type="text/javascript">
var checkboxes = document.getElementsByClassName("checkbox");


for (var i = 0; i < checkboxes.length; i++){
	checkboxes[i].addEventListener('click', showRSS);
}


function showRSS() {
	console.log("in showRSS");
	str = "";
	var checkboxes = document.getElementsByClassName("checkbox");
	for (var i = 0; i < checkboxes.length; i++){
		var el = checkboxes[i];
		if (el.checked) {
			str += el.value ;
			if (i != checkboxes.length) str += ",";
		}
	}

	if (str.charAt(str.length -1) == ",") {
		str = str.slice(0, -1);
	}


	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else {  // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}

	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("rssOutput").innerHTML=xmlhttp.responseText;
		}
	};

	var url = "http://www.se.rit.edu/~sas5057/344NewsProject/getRSS.php?q=" + str;
	xmlhttp.open("GET",url,true);
	xmlhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
	xmlhttp.setRequestHeader('Access-Control-Allow-Origin', '*');
	xmlhttp.send();
}

function addFavorite(e) {


	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else {  // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}

	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			console.log(xmlhttp.responseText);
			e.target.style.color = "blue";
			e.target.innerHTML = "&#9733";

		}
	};
	if (document.getElementById("loggedInHidden").value == "true") {
		var clickedOn = document.getElementById(e.target);
		var str = document.getElementById("userHidden").value + "," + e.target.value;
		var url = "http://www.se.rit.edu/~sas5057/344NewsProject/addFavorite.php?q=" + str;
		xmlhttp.open("GET",url,true);
		xmlhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
		xmlhttp.setRequestHeader('Access-Control-Allow-Origin', '*');
		xmlhttp.send();
	} else {
		alert("You must be logged in to favorite an article");
	}
}

function login(){
	console.log("attempting login");
	var uname = document.getElementById("username").value;
	var pword = document.getElementById("password").value;
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else {  // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {

		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var username = document.getElementById("username").value;
			console.log(xmlhttp.responseText);
			if(xmlhttp.responseText == 1){

					document.getElementById("username").value = "";
					document.getElementById("password").value = "";
					document.getElementById("password").blur();
					var cookie = document.cookie.split(";");
					console.log(cookie);
					var lastLogin = "";
					var str = cookie.forEach(function(data){
						if (data.includes(username)) {
							lastLogin = data.split("=")[1];
						}
					});
					console.log(lastLogin);
					document.getElementById("loginOutput").innerHTML = "Last Login was: " + lastLogin;

					document.getElementById("loggedInHidden").value = "true";
					document.getElementById("userHidden").value = username;

					var d = new Date();
					if (document.cookie.length > 0 ){
						document.cookie = username + "=" + d.toUTCString() + "=";
					} else  {
						document.cookie = username + "=" + d.toUTCString();
					}

			} else {
				document.getElementById("loginOutput").innerHTML = "Login Failed";

			}
		}
	};

	var str = uname + "," + pword;
	var url = "http://www.se.rit.edu/~sas5057/344NewsProject/login.php?q=" + str;
	xmlhttp.open("GET",url,true);
	xmlhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
	xmlhttp.send();
}

function checkUsername(username, check) {
    return username.includes(check);
}

function newUser() {
	console.log("attempting new user");
	var username = document.getElementById("newusername").value;
	var password = document.getElementById("newpassword").value;
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else {  // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			console.log(xmlhttp.responseText);
			if(xmlhttp.responseText == 1){

					document.getElementById("newusername").value = "";
					document.getElementById("newpassword").value = "";
					document.getElementById("newpassword").blur();
					document.getElementById("loginOutput").innerHTML = "User Created, please log in above to favorite articles";

					var d = new Date();
					if (document.cookie.length > 0 ){
						document.cookie = username + "=" + d.toUTCString();
					} else  {
						document.cookie = username + "=" + d.toUTCString();
					}

			} else {
				document.getElementById("loginOutput").innerHTML = "Create user Failed";

			}
		}
	}


	var uname = document.getElementById("newusername").value;
	var pword = document.getElementById("newpassword").value;
	var str = uname + "," + pword;
	var url = "http://www.se.rit.edu/~sas5057/344NewsProject/addUser.php?q=" + str;
	xmlhttp.open("GET",url,true);
	xmlhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
	xmlhttp.send();
}



</script>
</body>
</html>
