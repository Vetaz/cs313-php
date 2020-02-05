<?php
session_start()
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Scripture Details</title>
</head>
<body>
  <h1>
    <?php
    if (isset($_SESSION['book'])) {
      $book = $_SESSION['book'];
      if (is_array($book)) {
        echo $book[0]; // only show first book name since they are all the same.
      } else {
        echo $book; // not array, so show what book is.
      }
    }
    ?>
  </h1>

  
    <?php
    if (is_array($book)) {
    for ($x = 0; $x < sizeof($book); $x++) {
      $chap = $_SESSION['chapter'][$x];
      $vers = $_SESSION['verse'][$x];
      $cont = $_SESSION['content'][$x];
      echo "<p> $chap:$vers - $cont</p>";
    }
    ?>
  
  <?php
    
  ?>
</body>
</html>