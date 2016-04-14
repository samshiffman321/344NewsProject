<html lang="en">
<head>
<!--Sam Shiffman-->
	<meta charset="UTF-8">
	<title>RSS Newsfeed</title>
	<script>
	function showRSS(str) {
	  if (str.length==0) {
	    document.getElementById("rssOutput").innerHTML="";
	    return;
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
	  }
	  xmlhttp.open("GET","getrss.php?q="+str,true);
	  xmlhttp.send();
	}
	</script>
</head>
<body>
	<?php

	  $feeds = array();


	  if(isset($_POST['submit'])){//to run PHP script on submit
	  if(!empty($_POST['check_list'])){
	  // Loop to store and display values of individual checked checkbox.
	  foreach($_POST['check_list'] as $selected){
	  array_push($feeds, $selected);
	  }
	  }
	  }


	  $entries = array();
	  foreach($feeds as $feed) {
	    $xml = simplexml_load_file($feed);
	    $entries = array_merge($entries, $xml->xpath('/rss/channel/item'));
	  }

	 ?>

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<input type="checkbox" name="check_list[]" value="http://sports.espn.go.com/espn/rss/news"><label>ESPN</label><br/>
		<input type="checkbox" name="check_list[]" value="http://www.nytimes.com/services/xml/rss/nyt/HomePage.xml"><label>NYT</label><br/>
		<input type="checkbox" name="check_list[]" value="http://rss.cnn.com/rss/cnn_topstories.rss"><label>CNN</label><br/>
		<input type="checkbox" name="check_list[]" value="http://www.wired.co.uk/news/rss"><label>WIRED</label><br/>
		<input type="submit" name="submit" value="Submit"/>
	</form>

	 <ul>
		 <?php foreach ($entries as $entry): ?>
			 <li>
				 <ul>
					 <li><?php echo $entry->title ?></li>
					 <li><?php echo $entry->pubDate ?></li>
					 <li><?php echo $entry->link ?></li>
					 <li><?php echo $entry->description ?></li>
				 </ul>
			 </li>
		 <?php endforeach; ?>
	</ul>
</body>
</html>
