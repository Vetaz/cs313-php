<?php
require 'userRequired.php';
require "dbConnect.php";
$db = get_db();

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
    $sId = "i" . $startingId;
    $pId = "i" . $parentId;
    $arrayIds = array("$pId" => "Parent", "$sId" => "Self");

    if (array_key_exists($pId, $result)) {
      continue;
    }

    if ($parentId == $endingId) {
      return $arrayIds;
    } else {
      $result = array_merge($result, $arrayIds);
      if($r = getParent($gedcomId, $parentId, $endingId, $result)) {
        return array_merge($r, array("$pId" => "Parent", "$sId" => "Self"));
      }
      if($r = getChild($gedcomId, $parentId, $endingId, $result)) {
        return array_merge($r, array("$pId" => "Parent", "$sId" => "Self"));
      }
      if($r = getSpouse($gedcomId, $parentId, $endingId, $result)) {
        return array_merge($r, array("$pId" => "Parent", "$sId" => "Self"));
      }
    }
  }
  return array();
}

function getChild($gedcomId, $startingId, $endingId, $result) {
  $db = $GLOBALS['db'];
  $query = "SELECT pChild.id AS \"childId\"
  FROM person pChild
  INNER JOIN person_child on person_child.child_id = pchild.id
  INNER JOIN person pParent on person_child.person_id = pParent.id
  INNER JOIN gedcom ON gedcom.id = person_child.gedcom_id and gedcom.id = pChild.gedcom_id and gedcom.id = pParent.gedcom_id
  WHERE gedcom.id = '$gedcomId' and pParent.id = '$startingId'";
  $returnChild = $db->prepare($query);
  $returnChild->execute();
  $childId = null;
  while ($row = $returnChild->fetch(PDO::FETCH_ASSOC)) {
    $childId = $row['childId'];
    $sId = "i" . $startingId;
    $cId = "i" . $childId;
    $arrayIds = array("$cId" => "Child", "$sId" => "Self");

    if (array_key_exists($cId, $result)) {
      continue;
    }

    if ($childId == $endingId) {
      return $arrayIds;
    } else {
      $result = array_merge($result, $arrayIds);
      if($r = getChild($gedcomId, $childId, $endingId, $result)) {
        return array_merge($r, array("$cId" => "Child", "$sId" => "Self"));
      }/*
      if($r = getParent($gedcomId, $childId, $endingId, $result)) {
        return array_merge($r, array("$cId" => "Child", "$sId" => "Self"));
      }
      if($r = getSpouse($gedcomId, $childId, $endingId, $result)) {
        return array_merge($r, array("$cId" => "Child", "$sId" => "Self"));
      }*/
    }
  }
  return array();
}

function getSpouse($gedcomId, $startingId, $endingId, $result) {
  $db = $GLOBALS['db'];
  $query = "SELECT s.id AS \"spouseId\"
  FROM person p
  INNER JOIN person_spouse on person_spouse.person_id = p.id
  INNER JOIN person s on person_spouse.spouse_id = s.id
  INNER JOIN gedcom ON gedcom.id = person_spouse.gedcom_id and gedcom.id = p.gedcom_id and gedcom.id = s.gedcom_id
  WHERE gedcom.id = '$gedcomId' and p.id = '$startingId';";
  $returnSpouse = $db->prepare($query);
  $returnSpouse->execute();
  $spouseId = null;
  while ($row = $returnSpouse->fetch(PDO::FETCH_ASSOC)) {
    $spouseId = $row['spouseId'];
    $sId = "i" . $startingId;
    $spId = "i" . $spouseId;
    $arrayIds = array("$spId" => "Spouse", "$sId" => "Self");

    if (array_key_exists($spId, $result)) {
      continue;
    }

    if ($spouseId == $endingId) {
      return $arrayIds;
    } else {
      $result = array_merge($result, $arrayIds);
      if($r = getSpouse($gedcomId, $spouseId, $endingId, $result)) {
        return array_merge($r, array("$spId" => "Spouse", "$sId" => "Self"));
      }
      if($r = getParent($gedcomId, $spouseId, $endingId, $result)) {
        return array_merge($r, array("$spId" => "Spouse", "$sId" => "Self"));
      }/*
      if($r = getchild($gedcomId, $spouseId, $endingId, $result)) {
        return array_merge($r, array("$spId" => "Spouse", "$sId" => "Self"));
      } Takes too long*/
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
          if ($id1 != $id) {
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