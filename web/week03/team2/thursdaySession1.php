<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>

<body>
   <?php
   // remove previous session variable
   unset($_SESSION['picURL']);
   // Set session variables
   $_SESSION['favcolor'] = "green";
   $_SESSION['favanimal'] = 'dolphin';
   // echo that variables have been set
   if (isset($_SESSION['favcolor'])) {
      echo $_SESSION['favcolor'] . " is set<br>";
   }
   if (isset($_SESSION['favanimal'])) {
      echo $_SESSION['favanimal'] . " is set<br><br>";
   }
   ?>
   <a href="thursdaySession2.php">Check the variables on another page</a>


   <h2>Form time</h2>
   <form action="" method="post">
      <input type="text" name="picture">
      <input type="submit" name="submit" value="Submit!">
   </form>
   <?php
      if (isset($_POST['submit'])) {
         $_SESSION['picURL'] = $_POST['picture'];
      }
   ?>
</body>

</html>