<nav>
  <a href="deleteGedcom.php" class="button">Delete Your Gedcom</a>
  <a href="uploadGedcom.php" class="button">Upload Your Gedcom</a>
  <a href="get-relationship.php" class="button">Get Relationships</a>
  <?php if (isset($username)) {
    echo "<div><p>Signed in as $username </p></div>";
  } ?>
</nav>