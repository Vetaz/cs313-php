<?php
session_start();
require 'lib/Gedcom/bootstrap.php';

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


foreach ($gedcom->getIndi() as $indi) {
  echo "<br>ID: " . $indi->id;
  echo "<br>Sex: " . $indi->sex;
  if ($indi->name[0]->givn) {
    echo "<br>Given Names: " . $indi->name[0]->givn;
  }
  if ($indi->name[0]->surn) {
    echo "<br>Surname: " . $indi->name[0]->surn;
  }
  if (($indi->name[0]->givn == NULL) && ($indi->name[0]->surn == NULL)) {
    echo "<br>Full Name: " . $indi->name[0]->name;
  }
  echo '<br><br>';
  foreach ($indi->even as $event) {
    if ($event->type == 'BIRT') {
      if ($event->date != NULL) {
        echo "Birthdate: " . $event->date . "<br>";
      }
      if ($event->plac != NULL) {
        echo "Birthplace " . $event->plac->plac . "<br>";
      }
    }
    if ($event->type == 'DEAT') {
      if ($event->date != NULL) {
        echo "Deathdate: " . $event->date . "<br>";
      }
      if ($event->plac != NULL) {
        echo "Deathplace: " . $event->plac->plac . "<br>";
      }
    }
  }
  foreach ($indi->famc as $family) {
    echo "Family Child ID: " . $family->famc . "<br>";
    echo "Parent ID: " . $gedcom->getFam()[$family->famc]->wife . "<br>";
    echo "Parent ID " . $gedcom->getFam()[$family->famc]->husb . "<br>";
  }
  foreach ($indi->fams as $family) {
    echo "Family Spouse ID: " . $family->fams . "<br>";
    if ($indi->sex == 'M') {
      echo "Spouse ID: " . $gedcom->getFam()[$family->fams]->wife . "<br>";
    } else if ($indi->sex == 'F') {
      echo "Spouse ID: " . $gedcom->getFam()[$family->fams]->husb . "<br>";
    }
    foreach ($gedcom->getFam()[$family->fams]->chil as $child) {
      echo "Child ID: " . $child . "<br>";
    }
  }
  echo '<br><br>';
}
?>