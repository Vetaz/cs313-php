<h3>Display all cookies</h3>
<?php // code to display all cookies 
?>
<h1>Welcome 
  <?php // use the single cookie 
  echo $_COOKIE['user'];
  ?>
</h1>
<?php // print all cookies 
print_r($_COOKIE);
?>