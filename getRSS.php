<?php
  $q = $_GET["q"];
  if ($q == "") {
    echo "";
    exit();
  }
  $feeds = array();
  $feeds = explode(',',$q);

  $serv = '/home/spring2014/sas5057/public_html/344NewsProject';
  // $serv = 'localhost:8888/344NewsProject';
  $url =  $serv . '/favorites.json';
  $current = json_decode($url, true);

  $entries = array();
  foreach($feeds as $feed) {

    $xml = simplexml_load_file($feed);
    $entries = array_merge($entries, $xml->xpath('/rss/channel/item'));
  }


  echo '<ul class="bullet-none">';
    foreach ($entries as $entry):
      // echo var_dump($entry);
      // $test = json_encode($entry);
      // echo $test;
      $desc = $entry->description;
      $desc = htmlspecialchars($desc);
      $str = "title={$entry->title};pubdate={$entry->pubDate};link={$entry->link};description=$desc";

      echo '<li>';

      echo '<div class="row rssEntry" name="' . $entry->link . '">';

        echo '<ul class="bullet-none">';
          echo '<div><button class="favorite" type="submit" formmethod="post" onclick="javascript:addFavorite(event)" value="' . $str . '">&#9734</button></div>';

          echo '<li><h2>' . $entry->title . '</h2></li>';
          echo '<li>' . $entry->pubDate . '</li>';
          echo '<li><a href="' . $entry->link . '">' . $entry->link . '</a></li></br>';
          echo '<li>' . $entry->description . '</li>';
        echo '</ul>';
      echo '</div>';

      echo '</li></br>';
    endforeach;
  echo '</ul>';


 ?>
