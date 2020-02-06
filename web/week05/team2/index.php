<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Images</title>
</head>
<body>
<?php 
  require 'dbConnect.php';

  $db = get_db();

  $events = $db->prepare("SELECT name as Name, image as Image FROM w5_event");
  $events->execute();

  while ($row = $events->fetch(PDO::FETCH_ASSOC)) {
    $name = $row['name'];
    $imageURL = $row['image'];

    echo "<p>$name</p>";?>
    <img src="<?=$imageURL?>" style="width:100px; height:auto";
    <?php
  } ?>
</body>
</html>

