<?php 
  require 'dbConnect.php';

  $db = get_db();

  $eventss = $db->prepare("SELECT name as Name, image as Image FROM w5_event");
  $events->execute();

  while ($row = $events->fetch(PDO::FETCH_ASSOC)) {
    $name = $row['Name'];
    $imageURL = $row['Image'];

    echo "<p>$name</p>";?>
    <img src="<?=$imageURL?>" style="width:100px; height:auto";
    <?php
  }
?>
