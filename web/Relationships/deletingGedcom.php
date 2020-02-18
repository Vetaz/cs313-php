<?php
require 'dbConnect.php';
require 'userRequired.php';
$db = get_db();

if (isset($_POST['gedcom_id'])) {
  $gedcom_id = htmlspecialchars($_POST['gedcom_id']);
  $gedcomDelete = $db->prepare("DELETE FROM gedcom WHERE id = '$gedcom_id'");
  $gedcomDelete->execute();
} else {
  echo "Sad day, something went wrong!";
}
header('Location: deleteGedcom.php')
?>
