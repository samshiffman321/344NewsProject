<html lang="en">
<head>
<!--Sam Shiffman-->
	<meta charset="UTF-8">
	<title>RSS Newsfeed</title>
	<link rel="stylesheet" type="text/css" href="./shiffman_framework.css">

</head>
<body>

	<div class="col-3">
		<form id="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<input type="checkbox" class="checkbox" name="check_list[]" value="http://sports.espn.go.com/espn/rss/news"><label>ESPN</label><br/>
			<input type="checkbox" class="checkbox" name="check_list[]" value="http://www.nytimes.com/services/xml/rss/nyt/HomePage.xml"><label>NYT</label><br/>
			<input type="checkbox" class="checkbox" name="check_list[]" value="http://rss.cnn.com/rss/cnn_topstories.rss"><label>CNN</label><br/>
			<input type="checkbox" class="checkbox" name="check_list[]" value="http://www.wired.co.uk/news/rss"><label>WIRED</label><br/>
		</form>
	</div>

	<div id="rssOutput" class="col-9">


  </div>

<script>
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
			console.log("something should happen");
			document.getElementById("rssOutput").innerHTML=xmlhttp.responseText;
			console.log(xmlhttp.responseText);
		}
	};
	var url = "http://www.se.rit.edu/~sas5057/344NewsProject/getRSS.php?q=" + str;
	console.log(url);
	console.log(document.getElementById("rssOutput").innerHTML);
	xmlhttp.open("GET",url,true);
	xmlhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
	console.log(xmlhttp);
	xmlhttp.send();
}

</script>
</body>
</html>
