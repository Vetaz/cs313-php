<?php
require 'userRequired.php';
require 'dbConnect.php';
$db = get_db();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require 'bootstrap.php'; ?>
  <link rel="stylesheet" href="relationship.css">
  <title>Delete Gedcom</title>
</head>

<body>
  <header>
    <h1>Delete Your Gedcom</h1>
    <?php require 'nav.php'; ?>
  </header>
  <main>
    <form method="POST" action="deletingGedcom.php">
      <h2>Select the gedcom to delete</h2>
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
  </main>
</body>

</html>