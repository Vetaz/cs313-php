<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Registering</title>
</head>

<body>
  <?php
  if (
    isset($_POST['username']) && isset($_POST['password']) &&
    isset($_POST['firstName']) && isset($_POST['lastName'])
  ) {
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

    if (empty($usernameInSystem)) { # If the username is not in the system already
      # the account can be created and turned to sign in page.
      echo "That username is not in the system :)";
      $password = htmlspecialchars($_POST['password']);
      $firstName = htmlspecialchars($_POST['firstName']);
      $lastName = htmlspecialchars($_POST['lastName']);

      $query = "INSERT INTO usr (username, firstName, lastName, pass) VALUES (:desiredUsername, :firstName, :lastName, :password)";
      $insertUsr = $db->prepare($query);
      $insertUsr->bindValue(':desiredUsername', $desiredUsername);
      $insertUsr->bindValue(':firstName', $firstName);
      $insertUsr->bindValue(':lastName', $lastName);
      $insertUsr->bindValue(':password', $password);
      $insertUsr->execute();

      header("Location: index.html");
    } else {
      # else redirect to register screen.
      echo "That username is already in the system!!";
      header("Location: register.html");
    }
  }
  ?>
</body>

</html>