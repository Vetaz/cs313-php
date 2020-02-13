<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Scriptures</title>
</head>

<body>
  <h1>Scripture Resource</h1>

  <form action="stretch.php" method="post">
    <input type="text" name="scripture_book">
    <input type="submit" value="Submit">
  </form>
  <?php
  require "dbConnect.php";
  $db = get_db();

  $book_name = null;
  if (isset($_POST['scripture_book'])) {
    $book_name = $_POST['scripture_book'];

    $scriptures = $db->prepare("SELECT * FROM Scriptures WHERE book = '$book_name'");
    $scriptures->execute();
    unset($_SESSION['book']);
    unset($_SESSION['chapter']);
    unset($_SESSION['verse']);
    unset($_SESSION['content']);
    $id = 0;
    while ($row = $scriptures->fetch(PDO::FETCH_ASSOC)) {
      $book = $row['book'];
      $_SESSION['book'][] = $book;
      
      $chapter = $row['chapter'];
      $_SESSION['chapter'][] = $chapter;

      $verse = $row['verse'];
      $_SESSION['verse'][] = $verse;

      $content = $row['content'];
      $_SESSION['content'][] = $content;

      echo "<p><a href=\"details.php?scripture_id=$id\">$book $chapter:$verse</a></p>";
      $id++;
    }
  }

  ?>

</body>

</html>