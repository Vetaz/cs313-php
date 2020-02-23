<?php
require "userRequired.php";
require "dbConnect.php";
$db = get_db();

if (isset($_GET['gedcom_id'])) {
  $gedcom_id = htmlspecialchars($_GET['gedcom_id']);
  $_SESSION['gedcom_id'] = $gedcom_id;
} else {
  header('Location: get-relationship.php');
}

function personSelector()
{
  $gedcom_id = $GLOBALS['gedcom_id'];
  $personSelect = $GLOBALS['db']->prepare("SELECT id, name, birthdate FROM person WHERE gedcom_id = '$gedcom_id' ORDER BY id");
  $personSelect->execute();
  while ($row = $personSelect->fetch(PDO::FETCH_ASSOC)) {
    $personId = $row['id'];
    $personName = $row['name'];
    $personBirthdate = $row['birthdate'];
    echo "<option value='$personId'>Individual $personId ($personName b. $personBirthdate)</option>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Get Relationship</title>
  <link rel="stylesheet" href="relationship.css">
</head>

<body>
  <header>
    <h1>Get the Relationship between Two People in Your Gedcom</h1>
    <?php require 'nav.php'; ?>
  </header>
  <main>
    <p>Note: It may take a few minutes to find the realtionship</p>
    <div>
      <form method="get" action="relationship-viewer.php">
        <p>Select ID of person 1:</p>
        <select name="id1">
          <?php
          personSelector();
          ?>
        </select>
        <p>Select ID of person 2:</p>
        <select name="id2">
          <?php
          personSelector();
          ?>
        </select>
        <br>
        <input class="button" type="submit">
      </form>
    </div>
  </main>
</body>

</html>