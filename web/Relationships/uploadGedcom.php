<?php
require "userRequired.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php require 'bootstrap.php'; ?>
  <link rel="stylesheet" href="relationship.css" />
  <title>Upload Gedcom</title>
</head>

<body>
  <header>
    <h1>Upload Your Gedcom</h1>
    <?php require 'nav.php'; ?>
  </header>
  <h2>Find the gedcom to upload</h2>
  <p>Note: It may take a few minutes to upload your gedcom.</p>
  <form action="upload.php" method="POST" enctype="multipart/form-data">
    <div class="space-after">
      <input type="file" name="filename" />
    </div>
    <input type="submit" />
  </form>
</body>

</html>