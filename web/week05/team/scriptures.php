<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Scriptures</title>
</head>

<body>
  <h1>Scripture Resource</h1>
  <?php
  require "dbConnect.php";
  $db = get_db();

  $scriptures = $db->prepare("SELECT * FROM Scriptures");
  $scriptures->execute();

  while ($row = $scriptures->fetch(PDO::FETCH_ASSOC)) {
    $book = $row['book'];
    $chapter = $row['chapter'];
    $verse = $row['verse'];
    $content = $row['content'];

    echo "<p><b>$book $chapter:$verse</b> - \"$content\"</p>";
  }
  ?>

</body>

</html>