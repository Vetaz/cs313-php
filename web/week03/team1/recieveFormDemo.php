<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Team Acitivity</title>
</head>

<body>
  <?php
  $name = htmlspecialchars($_POST["name"]);
  $email = htmlspecialchars($_POST["email"]);
  $major = htmlspecialchars($_POST["major"]);
  $comments = htmlspecialchars($_POST["comments"]);
  $continents = $_POST["continents"];
  $continents_dict = array(
    "na" => "North America", 
    "sa" => "South America",
    "eu" => "Europe", 
    "as" => "Asia", 
    "au" => "Australia", 
    "af" => "Africa", 
    "an" => "Antarctica"
  );
  ?>

  <body>
    <div>
      <h1>Your username is <?php echo $name; ?></h1>
      <a href=<?= "mailto:$email" ?>><?= $email ?></a>
      <p>Your Major is: <?php echo $major; ?></p>
      <p>Comments: <?php echo $comments; ?></p>
      <p>You have visited the following continents:<P>
      <ul>
        <?php
        foreach ($continents as $continent) {
          echo "<li>$continents_dict[$continent]</li>";
        }
        ?>
      </ul>
    </div>
  </body>

</html>