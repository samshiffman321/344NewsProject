<html lang="en">
<head>
<!--Sam Shiffman-->
	<meta charset="UTF-8">
	<title>RSS Newsfeed</title>
</head>
<body>
  <?php
    $feeds = array("http://sports.espn.go.com/espn/rss/news");

    $entries = array();
    foreach($feeds as $feed) {
      $xml = simplexml_load_file($feed);
      $entries = array_merge($entries, $xml->xpath('/rss/channel/item'));
			echo $feed;
    }
   ?>
	 <p><?php echo count($entries)?></p>
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
