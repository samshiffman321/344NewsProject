<?php

$q = $_GET["q"];
$arr = array();
$arr = explode(',', $q);
$username = $arr[0];
$password = $arr[1];
$serv = '/home/spring2014/sas5057/public_html/344NewsProject';
$url =  $serv . '/users.json';
if (!is_writable($url)) { // Test if the file is writable
    echo "Cannot write to " . $url;
    echo false;
} else {
  $current = file_get_contents($url);

  if ($current == "null"){
    $write = array(array("username"=>$username, "password"=>$password));
    $final = json_encode($write, true);
    $res = file_put_contents($url, $final);
    echo true;
    exit();
  }


  $json = json_decode($current, true);
  $write = array();
  if ($json != "null"){
    $i = 0;
    foreach($json as $item) {
      if (in_array( $username,array_values($item))){
        echo false;
        die();
      }
      $write[$i] = $item;
      $i++;
    }
    $vals = array_values($json);
    $vals = array_values($vals);
    if (!in_array($username, $vals)) $write[$i] = array("username"=>$username, "password"=>$password);
    $final = json_encode($write, true);
    $res = file_put_contents($url, $final);
    echo true;

  } else {
    $write = array(array("username"=>$username, "password"=>$password));
    $final = json_encode($write, true);
    $res =  file_put_contents($url, $final);
    echo true;
  }
}
 ?>
