<div class="navGrid">
  <nav>
    <a href="privatize.php" class="button">Privatize Your Gedcom</a>
    <a href="deleteGedcom.php" class="button">Delete Your Gedcom</a>
    <a href="uploadGedcom.php" class="button">Upload Your Gedcom</a>
    <a href="get-relationship.php" class="button">Get Relationships</a>

  </nav>
  <?php if (isset($username)) {
    echo "<div class='signedInAs'><p>Signed in as $username </p></div>";
  } ?>
</div>