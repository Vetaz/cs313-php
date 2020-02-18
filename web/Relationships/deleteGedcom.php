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
  <title>Delete Gedcom</title>
</head>

<body>
  <header>
    <h1>Delete Your Gedcom</h1>
    <nav>
      <a href="deleteGedcom.php" class="button">Delete Your Gedcom</a>
      <a href="uploadGedcom.php" class="button">Upload Your Gedcom</a>
      <a href="get-relationship.php" class="button">Get Relationships</a>
      <?php if (isset($username)) {
        echo "<div><p>Signed in as $username </p></div>";
      } ?>
    </nav>
  </header>
  <main>
    <form method="POST" action="deletingGedcom.php">
      <p>Select the gedcom to delete</p>
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