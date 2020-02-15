<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registering</title>
</head>
<body>
  <?php
  if (isset($_POST['username'])) {
    $desiredUsername = htmlspecialchars($_POST['username']);
    require "dbConnect.php";
    $db = get_db();
    $query = "SELECT username FROM usr WHERE username = :desiredUsername";
    $desiredUsernameDB = $db->prepare($query);
    $desiredUsernameDB->bindValue(':desiredUsername', $desiredUsername);
    $desiredUsernameDB->execute();
    while ($row = $desiredUsernameDB->fetch(PDO::FETCH_ASSOC)) {
      $usernameInSystem = $row['username'];
    }
    var_dump($desiredUsernameDB);
    echo "<br> desired username: <bR>";
    var_dump($desiredUsername);
    echo "<br> username in system: <bR>";
    var_dump($usernameInSystem);
    if (empty($usernameInSystem)) {
      echo "That username is not in the system :)";
    } else {
      echo "That username is already in the system!!";
    }


  }

  ?>
</body>
</html>