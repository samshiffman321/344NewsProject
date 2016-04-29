<?php
  $q = $_GET["q"];
  $arr = array();
  $arr = explode(',', $q);
  $file = './favorites.json';
  $favoritesRaw = file_get_contents($file);
  $favoritesJson = json_decode($favoritesRaw);
  $favs = array();

  if ($favoritesJson.count > 0){
    echo $favoritesJson;
  } else {
    $favs = array($arr[0]=>array($arr[1]));
  }
  $favoritesRaw = json_encode($favs);
  echo file_put_contents($file, $favoritesRaw);

 ?>
