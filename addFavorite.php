<?php
  $q = $_GET["link"];
  $r = $_GET["user"];
  $arr = array();
  $arr = explode('&', $q);
  $args = array();
  $args = array_merge(xplode('=', $arr[0]), explode('=', $arr[1]));
  $favoritesRaw = fopen("./favorites.json", "w+");
  $favoritesJson = json_decode($favoritesRaw);

  if ($favoritesJson.count > 0){
    echo $favoritesJson;
  } else {
    foreach($args as $arg){
      echo "$q $r";
    }
  }
 ?>
