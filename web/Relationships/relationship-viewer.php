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
    
    $id1 = null;
    $id2 = null;
    $relationship = null;
    if (isset($_GET['id1']) && isset($_GET['id2'])) {
      $id1 = $_GET['id1'];
      $id2 = $_GET['id2'];
      $relationship = findRelationship($id1, $id2);
    } else {
      echo "IDs are not setup correctly. Go back and check them!";
    }

    function findRelationship($id1, $id2) {
      require "dbConnect.php";
      $db = get_db();
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
      return $relationship;
    }

    if (sizeof($relationship) > 1) {
      echo "<div class='relationshipCC'>";
      foreach ($relationship as $prop) {
        echo "<div class='person'>";
        $name = $prop['name'];
        $id = $prop['id'];
        $birthdate = $prop['birthdate'];
        $deathdate = $prop['deathdate'];
        $rel = $prop['rel'];
        $idNumber = substr($id, strpos($id, "i") + 1);
        echo "<p class='relationship'>$name</p>";
        echo "<p class='relationship'>$birthdate - $deathdate | $idNumber</p>";
        echo "<p class='relationship'>$rel</p>";
        echo "</div>";
        if ($id2 != $id) {
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