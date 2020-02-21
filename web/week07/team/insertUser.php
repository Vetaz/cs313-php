<?php
session_start();
require 'dbConnect.php';
$db = get_db();

if (isset($_SESSION['username'])) {
  $username = $_SESSION["username"];
  $pw = $_SESSION["password"];
}

try {
    $insert = $db->prepare('INSERT INTO w7_usr (username, hashPass) VALUES (:username, :pw);');
    $insert->bindValue(':username', $username);
    $insert->bindValue(':pw', $pw);
    $insert->execute();
} catch (\Throwable $th) {
    echo "<h1>ERROR: User not created! You fail, fool." , $th->getMessage(), "</h1>";
}




header('Location: signIn.php');
die();


?>