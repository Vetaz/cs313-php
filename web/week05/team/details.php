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
      echo $book[0];
    }
    ?>
  </h1>

  <?php
  for ($x = 0; $x < sizeof($book); $x++) {
    $chap = $_SESSION['chapter'][$x];
    $vers = $_SESSION['verse'][$x];
    $cont = $_SESSION['content'][$x];
    echo "<p> $chap:$vers - $cont</p>";
  }
  ?>
</body>
</html>