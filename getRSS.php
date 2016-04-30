<?php
  $q = $_GET["q"];
  $feeds = array();
  $feeds = explode(',',$q);




  $entries = array();
  foreach($feeds as $feed) {

    $xml = simplexml_load_file($feed);
    $entries = array_merge($entries, $xml->xpath('/rss/channel/item'));
  }


  echo '<ul class="bullet-none">';
    foreach ($entries as $entry):
      echo '<li>';
      echo '<div class="row">';

      echo '<div class="col-2"><button type="submit" formmethod="post" style="font-size:200%;" onclick="javascript:addFavorite(event)" value="' . $entry->link . '">&#9734</button></div>';
        echo '<ul class="bullet-none col-10">';
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
