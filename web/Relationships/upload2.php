<?php
//require "userRequired.php";
date_default_timezone_set('MST');
function alert($msg)
{
  echo "<script>alert('$msg');</script>";
}

if (isset($_FILES["filename"])) {
  $errors = array();
  $target_dir = "/app/web/Relationships/tempUploads/";
  $target_file = $target_dir . "USERNAME" . basename(date('YmdHis') . ".ged");
  $fileType = strtolower(pathinfo($_FILES["filename"]["name"], PATHINFO_EXTENSION));

  // File can only be a .ged file.
  if ($fileType != "ged") {
    $errors[] = "Only GEDCOM files allowed.<br>";
  }

  // File has to be less than 10 MiB in size.
  if ($_FILES["filename"]["size"] > 10485760) {
    $errors[] = "Your file is too large. Choose a file that is less than 10 MiB in size.<br>";
  }

  if (empty($errors) == false) {
    $errors[] = "Your file was not uploaded.<br>Page will redirect to the upload page.<br>";
    alert($errors[0]);
    //header("Location: index.html");
  } else {
    if (move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file)) {
      echo "The file " . basename($_FILES["filename"]["name"]) . " has been uploaded.<br>";
      $_SESSION['filename'] = $target_file;
      uploadToDatabase();
      //header("Location: get-relationship.php");
    } else {
      $errors[] = "Sorry, there was an error uploading your file.<br>Page will redirect to the upload page.";
      alert($errors[0]);
      //header("Location: index.html");
    }
  }
} else {
  echo "<p>Something went wrong. Redirecting to upload page.</p>";
  alert($errors);
  //header("Location: index.html");
}


function uploadToDatabase()
{
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
}
