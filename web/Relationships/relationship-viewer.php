<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Relationship Viewer</title>
  <link rel="stylesheet" href="relationship.css">
</head>

<body>
  <header>
    <h1>Relationship Viewer</h1>
    <nav>
      <a href="get-relationship.php" class="button">Get Relationships</a>
      <a href="index.html" class="button">Home</a>
    </nav>
  </header>
  <main>

    <?php
    require "dbConnect.php";
    $db = get_db();
    $id1 = null;
    $id2 = null;
    $relationship = null;
    if (isset($_GET['id1']) && isset($_GET['id2'])) {
      $relationship = findRelationship($_GET['id1'], $_GET['id2']);
      echo "id1 and id2 are set.";
    } else {
      echo "IDs are not setup correctly. Go back and check them!";
    }
    var_dump($relationship);
    var_dump(sizeof($relationship));

    function findRelationship($id1, $id2) {
      
      # Results is the result of the path to get from one id to another.
      $results = array(
        'g1i1' => 'Self',
        'g1i2' => 'Spouse',
        'g1i3' => 'Parent'
      );
      $relationship = [];
      foreach ($results as $id => $rel) {
        $person = $db->prepare("SELECT name, id, birthdate, deathdate FROM person WHERE id = '$id'");
        $person->execute();
        
        # Only one row for each person.
        while ($row = $person->fetch(PDO::FETCH_ASSOC)) {
          echo "inside while loop";
          var_dump($row);
          $name = $row['name'];
          $id = $row['id'];
          $birthdate = $row['birthdate'];
          $deathdate = $row['deathdate'];
        }

        $relationship[] = array(
          'name' => $name,
          'id' => $id,
          'birthdate' => $birthdate,
          'deathdate' => $deathdate,
          'rel' => $rel
        );
      }
      
      var_dump($relationship);
      echo "end of findRelationship.";
      return $relationship;
    }

    if (sizeof($relationship) > 1) {
      echo "<div class='relationshipCC'>";
      foreach ($relationship as $rel => $prop) {
        echo "<div class='person'>";
        $name = $prop['name'];
        $id = $prop['id'];
        $birthdate = $prop['birthdate'];
        $deathdate = $prop['deathdate'];
        echo "<p class='relationship'>$name</p>";
        echo "<p class='relationship'>$birthdate-$deathdate | $id</p>";
        echo "<p class='relationship'>$rel</p>";
        echo "</div>";
        if ($otherId != $id) {
          echo "<div class='line'></div>";
        }
      }
      echo "</div>";
    } else {
      echo "You are not related";
    }
    ?>
  </main>
</body>

</html>