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
    <h1>Upload Your Gedcom</h1>
    <?php require 'nav.php'; ?>
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