<?php 
  $email = htmlspecialchars($_POST["emailForPHP"]);
  $password = htmlspecialchars(($_POST["passwordForPHP"]));

  echo "email: $email\npassword: $password";

?>