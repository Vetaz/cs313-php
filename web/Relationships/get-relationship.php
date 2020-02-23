<?php
require "userRequired.php";
require "dbConnect.php";
$db = get_db();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php require 'bootstrap.php'; ?>
  <title>Get Relationship</title>
  <link rel="stylesheet" href="relationship.css">
</head>

<body>
  <header>
    <h1>Get the Relationship between Two People in Your Gedcom</h1>
    <?php require 'nav.php'; ?>
  </header>
  <main>
    <div>
      <form method="get" action="get-relationship-2.php">
        <h2>Select the gedcom to find relationships between people</h2>
        <select name="gedcom_id">
          <?php
          $gedcomSelect = $db->prepare("SELECT id FROM gedcom WHERE username = '$username' ORDER BY id");
          $gedcomSelect->execute();
          while ($row = $gedcomSelect->fetch(PDO::FETCH_ASSOC)) {
            $gedcomId = $row['id'];
            echo "<option value='$gedcomId'>Gedcom $gedcomId</option>";
          }
          ?>
        </select>
        <br>
        <input class="button" type="submit">
      </form>
    </div>
  </main>
</body>

</html>