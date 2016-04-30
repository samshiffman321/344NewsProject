<?php

$q = $_GET["q"];
$arr = array();
$arr = explode(',', $q);
$username = $arr[0];
$password = $arr[1];
$serv = '/home/spring2014/sas5057/public_html/344NewsProject';
$url =  $serv . '/users.json';
if (!is_writable($url)) { // Test if the file is writable
    echo "Cannot read from " . $url;
    echo false;
} else {
  $current = file_get_contents($url);

  if ($current == "null"){
    echo false;
  }


  $json = json_decode($current, true);
  if ($json != "null"){
    foreach($json as $item) {
      if ($item['username'] == $username && $item['password'] == $password){
        echo  true;
      }
    }
  } else {
    echo false;
  }
}
 ?>
