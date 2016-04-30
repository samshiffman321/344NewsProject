<?php

  $q = $_GET['q'];
  $arr = array();
  $arr = explode(';', $q);
  $user = $arr[0];
  $vars = array_slice($arr, 1);
  $entry = json_encode($vars);
  $entry = json_decode($entry);
  // echo var_dump($entry);
  // $link = $arr[1];
  // $entry = json_decode($link);
  $serv = '/home/spring2014/sas5057/public_html/344NewsProject';
  // $serv = 'localhost:8888/344NewsProject';
  $url =  $serv . '/favorites.json';
  begin:
  if (!is_writable($url)) { // Test if the file is writable
      echo "Cannot write to {$url}";
  } else {
    $current = file_get_contents($url);

    if ($current == "null"){
      $write = array(array("user" => $user, "favorites" => array(0 => $entry)));
      $final = json_encode($write, true);
      $res = file_put_contents($url,$final);
      echo $res;
      exit();
    }

    $current = str_replace("\\","",$current);

    $json = json_decode($current, true);
    if ($json != "null"){
      foreach($json as $item) {
        if ($item['user'] == $user){
          $favorites = $item['favorites'];
          $count = count($favorites);
          $new = array();
          if ($count == 1){
            $new[0] = $favorites[0];
             if (!in_array($entry, array_values($favorites))) $new[1] = $entry;
          } else {
            for ($i = 0; $i < $count; $i++){
               $new[$i] = $favorites[$i];
            }

            if (!in_array($entry, array_values($favorites))) $new[$count] = $entry;
          }

          if (count($json) == 1) {
            $write = array(array("user" => $user, "favorites" => $new));
          }
        }
      }
      $final = json_encode($write, true);
      $res = file_put_contents($url, $final);
    } else {
      $write = array(array("user" => $user, "favorites" => array(0 => $entry)));
      $final = json_encode($write, true);
      $res = file_put_contents($url,$final);
    }
    if (filesize($url) == 4) {
      goto begin;
    }
    echo $res;
  }
 ?>
