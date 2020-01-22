<?php $major = array("Computer Science", "Web Design and Development", "Computer Information Technology", "Computer Engineering"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Team Acitivity</title>
</head>

<body>
  <form method="POST" action="recieveFormDemo.php">
    Name:
    <input type="text" name="name"><br>
    Email:
    <input type="text" name="email"><br>
    Major:<br>
    <?php
    foreach ($major as $selected) {
      echo "<input type='radio' name='major' value='$selected'>$selected<br>";
    }
    ?>
    <br>
    Comments:
    <input type="text" name="comments"><br>

    <p>Which continents have you been to?</p>

    <input type="checkbox" name="continents[]" value="na">North America<br>
    <input type="checkbox" name="continents[]" value="sa">South America<br>
    <input type="checkbox" name="continents[]" value="eu">Europe<br>
    <input type="checkbox" name="continents[]" value="as">Asia<br>
    <input type="checkbox" name="continents[]" value="au">Australia<br>
    <input type="checkbox" name="continents[]" value="af">Africa<br>
    <input type="checkbox" name="continents[]" value="an">Antarctica<br>

    <input type="submit">
  </form>
</body>

</html>