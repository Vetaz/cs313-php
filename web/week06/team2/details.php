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
    if (isset($_GET['scripture_id'])) {
      try {
        $id = $_GET['scripture_id'];
        $chap = $_SESSION['chapter'][$id];
        $vers = $_SESSION['verse'][$id];
        $cont = $_SESSION['content'][$id];
        echo "<p> $chap:$vers - $cont</p>";
      } catch (Exception $e) {
        echo "<p> Scripture ID is invalid!</p>";
      }
    } else {
      echo "<p>No Scripture ID given!</p>";
    }
  ?>
</body>
</html>