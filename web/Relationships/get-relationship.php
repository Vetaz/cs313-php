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
  <title>Get Relationship</title>
  <link rel="stylesheet" href="relationship.css">
</head>

<body>
  <header>
    <h1>Get the Relationship between Two People in Your Gedcom</h1>
    <nav>
      <a href="uploadGedcom.php" class="button">Upload Your Gedcom</a>
      <a href="get-relationship.php" class="button">Get Relationships</a>
      <?php if (isset($username)) {
      echo "<div><p>Signed in as $username </p></div>";
      } ?>
    </nav>
  </header>
  <main>
    <div>
      <p>Type the ID number of each person for who you would like to see the relationship for.</p>
      <form method="get" action="get-relationship-2.php">
        <p>Select the gedcom</p>
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