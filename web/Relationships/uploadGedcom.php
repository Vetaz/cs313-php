<?php
require "userRequired.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="relationship.css" />
  <title>Upload Gedcom</title>
</head>

<body>
  <header>
    <nav>
      <a href="uploadGedcom.php" class="button">Upload Your Gedcom</a>
      <a href="get-relationship.php" class="button">Get Relationships</a>
      <?php if (isset($username)) {
        echo "<div><p>Signed in as $username </p></div>";
      } ?>
    </nav>
  </header>
  <p>Click on the "Choose File" button to upload a file:</p>

  <form action="upload.php" method="POST" enctype="multipart/form-data">
    <div class="space-after">
      <input type="file" name="filename" />
    </div>
    <input type="submit" />
  </form>
</body>

</html>