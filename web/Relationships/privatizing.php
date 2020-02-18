<?php
require 'userRequired.php';
require 'dbConnect.php';

if (isset($_POST['gedcom_id'])) {
  $gedcom_id = htmlspecialchars($_POST['gedcom_id']);
}

$privatize = $db->prepare("UPDATE person SET name = 'Living', birthdate = '', birthplace = '' WHERE gedcom_id = 29 AND deathdate = '' AND deathplace = ''");
$privatize->execute();

header('Location: get-relationship.php');
?>