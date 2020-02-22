<?php
require 'userRequired.php';
require "dbConnect.php";
$db = get_db();
function findId($gedcomId, $startingId, $endingId, $result) {
  $db = $GLOBALS['db'];
  $query = "";
  $result = "";
  $a1 = array($startingId => 'Self');
  if ($startingId == $endingId)
  array_merge($a1, );
  return $result;
}

function getParent($gedcomId, $startingId, $endingId, $result) {
  $db = $GLOBALS['db'];
  $query = "SELECT pParent.id AS \"parentId\"
  FROM person pParent
  INNER JOIN person_parent on person_parent.parent_id = pParent.id
  INNER JOIN person pChild on person_parent.person_id = pChild.id
  INNER JOIN gedcom ON gedcom.id = person_parent.gedcom_id and gedcom.id = pChild.gedcom_id and gedcom.id = pParent.gedcom_id
  WHERE gedcom.id = '$gedcomId' and pChild.id = '$startingId'";
  $returnParent = $db->prepare($query);
  $returnParent->execute();
  $parentId = null;
  while ($row = $returnParent->fetch(PDO::FETCH_ASSOC)) {
    $parentId = $row['parentId'];

    if ($parentId == $endingId) {
      $id = "i" . $parentId;
      return array_merge($result, array("$id" => "Parent"));
    } else {
      $id = "i" . $parentId;
      $result = array_merge($result, array("$id" => "Parent"));
      return getParent($gedcomId, $parentId, $endingId, $result);
      echo "Other result:";
      var_dump($result);
      echo "<br>";
    }
  }
  return array();
}

function findRelationship($gedcomId, $id1, $id2)
{
  $db = $GLOBALS['db'];
  
  # Results is the result of the path to get from one id to another.
  # the value is the relationship from the previous id.
  $result = getParent($gedcomId, $id1, $id2, array("i" . $id1 => "self"));
  var_dump($result);
  $relationship = [];
  foreach ($result as $id => $rel) {
    $id = substr($id, 1);
    $person = $db->prepare("SELECT person.name, person.id, person.birthdate, person.deathdate FROM person INNER JOIN gedcom on gedcom.id = person.gedcom_id WHERE person.id = '$id' and gedcom.id = '$gedcomId'");
    $person->execute();
    $name = '';
    $id = '';
    $birthdate = '';
    $deathdate = '';

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