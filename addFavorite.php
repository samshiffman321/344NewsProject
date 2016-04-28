<?php
  $q = $_GET["q"];
  $arr = array();
  $arr = explode('&', $q);
  $args = array();
  $args = explode('=', $arr[0]) + explode('=', $arr[1]);
  $favoritesRaw = fopen("./favorites.json", "w+");
  $favoritesJson = json_decode($favoritesRaw);

  if ($favoritesJson.count > 0){
    echo $favoritesJson;
  } else {
    echo $args;
  }
 ?>
