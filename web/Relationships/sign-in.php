<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Signing In</title>
</head>
<body>
  <?php
  if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    require "dbConnect.php";
    $db = get_db();

    $query = "SELECT username, pass FROM usr WHERE username = :username";
    $usr = $db->prepare($query);
    $usr->bindValue(':username', $username);
    $usr->execute();
    while ($row = $usr->fetch(PDO::FETCH_ASSOC)) {
      $usernameInSystem = $row['username'];
      $passwordInSystem = $row['pass'];
    }
   
    if (($usernameInSystem == $username) && ($passwordInSystem == $password)) { 
      echo "Sign in verified";
      $_SESSION['username'] = $username;
      header("Location: get-relationship.php");
    } else {
      echo "Either username or password incorrect or no account made.";
      header("Location: index.html");
    }
  } else {
    echo "Username or password not given.";

  }

  ?>
</body>
</html>