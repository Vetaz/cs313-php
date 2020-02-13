<?php
require("dbConnect.php");
$db = get_db();
?>

<body>
  <div class="container">
    <?php
    $statement = $db->prepare("SELECT s.id, s.book, s.chapter, s.verse, string_agg(t.name, ', ') AS topics FROM Scriptures s INNER JOIN scripture_topic st ON s.id = st.scripture_id INNER JOIN topic t ON st.topic_id = t.id GROUP BY s.id;");
    $statement->execute();
    while ($sRow = $statement->fetch(PDO::FETCH_ASSOC)) {
      $id = $sRow['id'];
      $book = $sRow['book'];
      $chapter = $sRow['chapter'];
      $verse = $sRow['verse'];
      $topics = $sRow['topics'];

      echo "<h1>$book $chapter:$verse</h1>";
      echo "<p>Topics: $topics</p>";
    }
    ?>

  </div>
</body>

</html>