<?php
  $q = $_GET["q"];
  $feeds = array();
  $feeds = explode(',',$q);


  // if(isset($_POST['submit'])){//to run PHP script on submit
  // if(!empty($_POST['check_list'])){
  // // Loop to store and display values of individual checked checkbox.
  // foreach($_POST['check_list'] as $selected){
  // array_push($feeds, $selected);
  // }
  // }
  // }



  $entries = array();
  foreach($feeds as $feed) {

    $xml = simplexml_load_file($feed);
    $entries = array_merge($entries, $xml->xpath('/rss/channel/item'));
  }


  echo '<ul class="bullet-none">';
    foreach ($entries as $entry):
      echo '<li>';
        echo '<ul>';
          echo '<li>' . $entry->title . '</li>';
          echo '<li>' . $entry->pubDate . '</li>';
          echo '<li><a href="' . $entry->link . '">' . $entry->link . '</a></li>';
          echo '<li>' . $entry->description . '</li>';
        echo '</ul>';
      echo '</li>';
    endforeach;
  echo '</ul>';


 ?>
