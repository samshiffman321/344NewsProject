<?php
  $q = $_GET["q"];
  $arr = array();
  $arr = explode(',', $q);
  $favoritesRaw = fopen("./favorites.json", "w+");
  $favoritesJson = json_decode($favoritesRaw);

  if ($favoritesJson.count > 0){
    echo $favoritesJson;
  } else {
    foreach ($arr as $item){
      echo $item;
    }
  }
 ?>
