<?php 
  require "userRequired.php";
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
    </nav>
  </header>
  <main>
    <div>
      <p> Hello <?php echo $username ?>!</p>
      <?php echo "testing for " . $_SESSION['username'] ?>
      <p>Type the ID number of each person for who you would like to see the relationship for.</p>
      <form method="get" action="relationship-viewer.php">
        <p>Type ID of person 1:</p>
        <input type="text" name="id1">
        <p>Type ID of person 2:</p>
        <input type="text" name="id2">
        <br>
        <input class="button" type="submit">
      </form>
    </div>
  </main>
</body>

</html>