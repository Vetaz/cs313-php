<?php
  require "dbConnect.php";
  $db = get_db();

  $family_members = $db->prepare("SELECT * FROM w5_family_members");
  $family_members->execute();

  while ($fRow = $family_members->getch(PDO::FETCH_ASSOC)) {
    $first_name = $fRow['first_name'];
    $last_name = $fRow['last_name'];
    $relationship_id = $fRow['relationship_id'];

    echo "<p>$first_name $last_name is my $relationship_id</p>";
  }

?>