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
	xmlhttp.send();
}

function login(username, password){
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else {  // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var xml = xmlhttp.responseXML;
			var users = xml.getElementsByTagName("user");
			console.log(users);
			var usernamepath = "";
			var passwordpath = "";
			for (var i = 0; i < users.length; i++){
				console.log(users[i]);
			}
		}
	};
	xmlhttp.open("GET","./users.xml",true);
	xmlhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
	xmlhttp.send();


}
login();

</script>
</body>
</html>
