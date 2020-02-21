<?php
require 'userRequired.php';
require "dbConnect.php";
$db = get_db();
function findId($gedcomId, $startingId, $endingId) {
  return array($startingId => 'Self', $endingId => 'Other');
}

function findRelationship($gedcomId, $id1, $id2)
{
  $db = $GLOBALS['db'];
  
  # Results is the result of the path to get from one id to another.
  # the value is the relationship from the previous id.
  $results = findId($gedcomId, $id1, $id2);

  $relationship = [];
  foreach ($results as $id => $rel) {
    $person = $db->prepare("SELECT person.name, person.id, person.birthdate, person.deathdate FROM person INNER JOIN gedcom on gedcom.id = person.gedcom_id WHERE person.id = '$id' and gedcom.id = '$gedcomId'");
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
?>

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
    <?php require 'nav.php'; ?>
  </header>
  <main>
    <p> Currently only shows the two people selected. I am working on an algorithm
      that will be working by the end of this week</p>
    <?php

    $id1 = null;
    $id2 = null;
    $relationship = null;
    if (isset($_GET['id1']) && isset($_GET['id2'])) {
      $gedcomId = $_SESSION['gedcom_id'];
      
      $id1 = $_GET['id1'];
      $id2 = $_GET['id2'];
      $relationship = findRelationship($gedcomId, $id1, $id2);

      if (sizeof($relationship) > 1) {
        echo "<div class='relationshipCC'>";
        foreach ($relationship as $prop) {
          echo "<div class='person'>";
          $name = $prop['name'];
          $id = $prop['id'];
          $birthdate = $prop['birthdate'];
          $deathdate = $prop['deathdate'];
          $rel = $prop['rel'];
          echo "<p class='relationship'>$name</p>";
          echo "<p class='relationship'>$birthdate - $deathdate | $id</p>";
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
    } else {
      echo "IDs are not setup correctly. Go back and check them!";
    }
    ?>
  </main>
</body>

</html>