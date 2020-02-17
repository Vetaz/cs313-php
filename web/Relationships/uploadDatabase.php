<?php
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

echo $query;
$insertGedcom =$db->prepare($query);
$insertGedcom->execute();
$gedcom_id = $db->lastInsertId('gedcom_id_seq');
echo "Gedcom_id: $gedcom_id";
foreach ($gedcom->getIndi() as $indi) {
  $id = $indi->id;
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
  foreach ($indi->even as $event) {
    if ($event->type == 'BIRT') {
      if ($event->date != NULL) {
        $birthDate = $event->date;
      }
      if ($event->plac != NULL) {
        $birthPlace = $event->plac->plac;
      }
    }
    if ($event->type == 'DEAT') {
      if ($event->date != NULL) {
        $deathDate = $event->date;
      }
      if ($event->plac != NULL) {
        $deathPlace = $event->plac->plac;
      }
    }
  }
  if (empty($fullname)) {
    $name = htmlspecialchars(($givenNames . " " . $surname),ENT_QUOTES); 
  } else {
    $name = htmlspecialchars($fullname, ENT_QUOTES);
  }
  
  $query = "INSERT INTO person (gedcom_id, id, name, sex, birthdate, birthplace, deathdate, deathplace) VALUES ('$gedcom_id', '$id', '$name', '$sex', '$birthDate', '$birthPlace', '$deathDate','$deathPlace')";
  echo $query;
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
?>