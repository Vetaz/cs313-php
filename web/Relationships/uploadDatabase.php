<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="relationship.css">
  <title>Uploading to Database</title>
</head>

<body>
  <h1>Please wait while we upload your file!</h1>
  <?php
  $okToDepart = false;
  error_reporting(E_ALL);
  set_time_limit(0);
  require 'userRequired.php';
  require 'lib/Gedcom/bootstrap.php';
  require "dbConnect.php";
  $db = get_db();

  $file = $_SESSION['filename'];

  $parser = new \Gedcom\Parser();

  try {
    $gedcom = $parser->parse($file);
  } catch (Exception $e) {
    echo $e->getMessage();
    exit;
  }

  $errors = $parser->getErrors();

  if (!empty($errors))
    echo 'The following parser errors occurred: <pre>' . print_r($parser->getErrors(), true) . '</pre>';

  $query = "INSERT INTO gedcom (username) VALUES ('$username')";

  $insertGedcom = $db->prepare($query);
  $insertGedcom->execute();
  $gedcom_id = $db->lastInsertId('gedcom_id_seq');
  foreach ($gedcom->getIndi() as $indi) {
    $id = null;
    $sex = null;
    $givenNames = null;
    $surname = null;
    $fullname = null;

    $id = substr($indi->id, 1); //only get the number out of the ID.
    $sex = $indi->sex;
    if ($indi->name[0]->givn) {
      $givenNames = $indi->name[0]->givn;
    }
    if ($indi->name[0]->surn) {
      $surname =  $indi->name[0]->surn;
    }
    if (($indi->name[0]->givn == NULL) && ($indi->name[0]->surn == NULL)) {
      $fullname = $indi->name[0]->name;
    }
    $birthDate = "";
    $birthPlace = "";
    $deathDate = "";
    $deathPlace = "";
    foreach ($indi->even as $event) {
      if ($event->type == 'BIRT') {
        if ($event->date != NULL) {
          $birthDate = htmlspecialchars($event->date, ENT_QUOTES);
        }
        if ($event->plac != NULL) {
          $birthPlace = htmlspecialchars($event->plac->plac, ENT_QUOTES);
        }
      }
      if ($event->type == 'DEAT') {
        if ($event->date != NULL) {
          $deathDate = htmlspecialchars($event->date, ENT_QUOTES);
        }
        if ($event->plac != NULL) {
          $deathPlace = htmlspecialchars($event->plac->plac, ENT_QUOTES);
        }
      }
    }
    if (empty($fullname)) {
      $name = htmlspecialchars(($givenNames . " " . $surname), ENT_QUOTES);
    } else {
      $name = htmlspecialchars($fullname, ENT_QUOTES);
    }

    $query = "INSERT INTO person (gedcom_id, id, name, sex, birthdate, birthplace, deathdate, deathplace) VALUES ('$gedcom_id', '$id', '$name', '$sex', '$birthDate', '$birthPlace', '$deathDate','$deathPlace')";
/*
    echo "<p>Individual $id ";
    if ($name) {
      echo "Name: $name ";
    }
    echo "Sex: $sex ";
    if ($birthDate != "") {
      echo "Birth date: $birthDate ";
    }
    if ($birthPlace != "") {
      echo "Birth place: $birthPlace ";
    }
    if ($deathDate != "") {
      echo "Death date: $deathDate ";
    }
    if ($deathPlace != "") {
      echo "Death place: $deathPlace ";
    }
    echo "</p>";
*/
    $insertPerson = $db->prepare($query);
    $insertPerson->execute();
    foreach ($indi->famc as $family) {
      $parentId[] = $gedcom->getFam()[$family->famc]->wife;
      $parentId[] = $gedcom->getFam()[$family->famc]->husb;
    }
    foreach ($indi->fams as $family) {
      if ($indi->sex == 'M') {
        $spouse = $gedcom->getFam()[$family->fams]->wife;
      } else if ($indi->sex == 'F') {
        $spouse = $gedcom->getFam()[$family->fams]->husb;
      }
      foreach ($gedcom->getFam()[$family->fams]->chil as $child) {
        $child;
      }
    }
  } 
  header("Location: get-relationship.php");
  ?>

</body>

</html>