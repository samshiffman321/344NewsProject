<?php
  $username = $_GET["q"];
  $serv = '/home/spring2014/sas5057/public_html/344NewsProject';
  // $serv = 'localhost:8888/344NewsProject';
  $url =  $serv . '/favorites.json';
  $contents = file_get_contents($url);
  $current = json_decode($contents, true);

  foreach ($current as $favorites) {
    if ($favorites["user"] == $username) {
      $userFavorites = $favorites["favorites"];
      echo '<ul class="bullet-none">';
      foreach ($userFavorites as $entry) {
        $title = "";
        $pubdate = "";
        $link = "";
        $description = "";

        foreach ($entry as $item) {
          $piece = explode("=", $item);
          if ($piece[0] == "title") {
            $title = $piece[1];
          } else if ($piece[0] == "pubdate") {
            $pubdate = $piece[1];
          } else if ($piece[0] == "link") {
            $link = $piece[1];
          } else if ($piece[0] == "description") {
            $description = $piece[1];
          }
        } //end foreach item

        echo '<li>';

        echo '<div class="row rssEntry" name="' . $link . '">';

          echo '<ul class="bullet-none">';
            echo '<li><h2>' . $title . '</h2></li>';
            echo '<li>' . $pubdate . '</li>';
            echo '<li><a href="' . $link . '">' . $link . '</a></li></br>';
            echo '<li>' . $description . '</li>';
          echo '</ul>';
        echo '</div>';

        echo '</li></br>';
      } //end foreach item
      echo '</ul>';
    }
  }


 ?>
