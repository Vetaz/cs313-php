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
      <form method="get" action="relationship-viewer.php">
        <p>Select ID of person 1:</p>
        <select name="id1">
        <?php
          $personSelect = $db->prepare("SELECT id FROM person WHERE gedcom_id = '$gedcom_id' ORDER BY id");
          $personSelect->execute();
          while ($row = $personSelect->fetch(PDO::FETCH_ASSOC)) {
            $personId = $row['id'];
            echo "<option value='$personId'>Individual $personId</option>";
          }
        ?>
        </select>
        <p>Select ID of person 2:</p>
        <select name="id2">
        <?php
          $personSelect = $db->prepare("SELECT id FROM person WHERE gedcom_id = '$gedcom_id' ORDER BY id");
          $personSelect->execute();
          while ($row = $personSelect->fetch(PDO::FETCH_ASSOC)) {
            $personId = $row['id'];
            echo "<option value='$personId'>Individual $personId</option>";
          }
        ?>
        </select>
        <input class="button" type="submit">
      </form>
    </div>
  </main>
</body>

</html>