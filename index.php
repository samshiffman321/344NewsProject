<html lang="en">
<head>
<!--Sam Shiffman-->
	<meta charset="UTF-8">
	<title>RSS Newsfeed</title>
	<link rel="stylesheet" type="text/css" href="./shiffman_framework.css">

</head>
<body>
	<div class="row header">
		<h1>RSS Feed</h1>
	</div>

<div class="row">
		<div class="col-3">
			<form id="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<input type="checkbox" class="checkbox" name="check_list[]" value="http://sports.espn.go.com/espn/rss/news"><label>ESPN</label><br/>
				<input type="checkbox" class="checkbox" name="check_list[]" value="http://www.nytimes.com/services/xml/rss/nyt/HomePage.xml"><label>NYT</label><br/>
				<input type="checkbox" class="checkbox" name="check_list[]" value="http://rss.cnn.com/rss/cnn_topstories.rss"><label>CNN</label><br/>
				<input type="checkbox" class="checkbox" name="check_list[]" value="http://www.wired.co.uk/news/rss"><label>WIRED</label><br/>
			</form>
			<form id="login" onsubmit="javascript:login(); return false;">
				<label>Username: </label><input type="text" id="username" name="username"></br>
				<label>Password: </label><input type="password" id="password" name="password"></br>
				<input type="submit" value="Login" name="Login">
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

function login(){
	console.log("attempting login");
	var username = document.getElementById("username").value;
	var password = document.getElementById("password").value;
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else {  // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var xml = xmlhttp.responseXML;
			var usernames = xml.getElementsByTagName("username");
			var passwords = xml.getElementsByTagName("password");
			for (var i = 0; i < usernames.length; i++){
				var uname = usernames[i].innerHTML;
				var pword = passwords[i].innerHTML;
				if (uname == username && pword == password){
					document.getElementById("username").value = "";
					document.getElementById("password").value = "";
					document.getElementById("password").blur();
					var d = new Date();
					console.log("initial cookie: ",document.cookie )
					if (document.cookie.length > 0 ){//&& !document.cookie.includes(username)){
						console.log("if");
						document.cookie = username + "=" + d.toUTCString();
					} else  {
						console.log("else");
						document.cookie = username + "=" + d.toUTCString();
					}
					console.log("final cookie: ",document.cookie);
					return true;
				}
			}
		}
	};
	xmlhttp.open("GET","./users.xml",true);
	xmlhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
	xmlhttp.send();
}


</script>
</body>
</html>
