<?php
require 'userRequired.php';

unset($_SESSION['username']);
if (empty($_SESSION['username'])) {
  header('Location: index.html');
}
?>