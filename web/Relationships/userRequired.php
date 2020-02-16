<?php 
  session_start();
  $username = null;
  #Only signed in users can see this page
  if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
  } else {
    header('Location: index.html');
  }
?>