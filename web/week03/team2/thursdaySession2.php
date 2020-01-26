<?php
// start session
session_start();
// save session variables into local variables
$c = $_SESSION['favcolor'];
$a = $_SESSION['favanimal'];

?>

<h1>
   Your favorite color is <?= $c ?> and your favorite animal is <?= $a ?>
</h1>
<?php
echo "Picture:<br>";
?>

<img src="
<?php if (isset($_SESSION['picURL'])) {
   $p = $_SESSION['picURL'];
} ?>
" style='width:300px;height:auto'>