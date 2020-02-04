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

    $scriptures = $db->prepare("SELECT * FROM Scriptures WHERE book = $book_name");
    $scriptures->execute();

    while ($row = $scriptures->fetch(PDO::FETCH_ASSOC)) {
      $book = $row['book'];
      $chapter = $row['chapter'];
      $verse = $row['verse'];
      $content = $row['content'];
      
      echo "<p><b>$book $chapter:$verse</b> - \"$content\"</p>";
    }
  }

  ?>

</body>

</html>