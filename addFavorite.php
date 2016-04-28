<?php
  $q = $_GET["q"];
  $favoritesRaw = fopen("./favorites.json", "w+");
  $favoritesJson = json_decode($favoritesRaw);

  if ($favoritesJson.count > 0){
    echo $favoritesJson;
  } else {
    echo "testing addFavorite.php";
  }
 ?>
