<?php session_start();
/* My little database */
$inventory = array(
  0 => "Cadbury Mini Eggs, Milk Chocolate, 10 oz",
  1 => "Ferrero Rocher Fine Hazelnut Milk Chocolates, 42 Count",
  2 => "Dove Milk Chocolate, 8.46 oz",
  3 => "Dove Dark Chocolate, 8.46 oz",
  4 => "Snickers, 1.86 oz, 6 Count",
  5 => "Giant Reese's Peanut Butter Bars, 6.8 oz"
);

$prices = array(
  0 => 5.00,
  1 => 7.00,
  2 => 3.99,
  3 => 3.99,
  4 => 4.98,
  5 => 4.98
);

$firstName = sanitize_input('first_name');
$lastName = sanitize_input('last_name');
$streetAddress = sanitize_input('street_address');
$cityAddress = sanitize_input('city_address');
$stateAddress = sanitize_input('state_address');
$zipAddress = sanitize_input('zip_address');

$_SESSION['firstName'] = $firstName;
$_SESSION['lastName'] = $lastName;
$_SESSION['streetAddress'] = $streetAddress;
$_SESSION['cityAddress'] = $cityAddress;
$_SESSION['stateAddress'] = $stateAddress;
$_SESSION['zipAddress'] = $zipAddress;


function sanitize_input($input) {
  if (isset($_POST[$input])) {
    $input = $_POST[$input];
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
  } else 
    return '';
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="stylesheet.css">
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-sm navbar-dark">

      <a class="navbar-brand" href="#">ChocoLovers</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="collapsedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="browse.php">Browse</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cart.php">Cart</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <main>
    <?php
    if (isset($_SESSION['item-quantity'])) {
    ?>
      <div class="container">
        <table class="justify-content-center">
          <tr>
            <td>Item</td>
            <td>Quantity</td>
            <td>Price</td>
            <td>Total Price</td>
            <td></td>
          </tr>

          <?php
          $total_price = 0;
          foreach ($_SESSION['item-quantity'] as $item => $quantity) {
          ?><tr>
              <td><?= $inventory[$item]; ?></td>
              <td><?= $quantity; ?></td>
              <td><?= "$" . number_format($prices[$item], 2); ?></td>
              <?php
              $item_total_price = $quantity * $prices[$item];
              $total_price += $item_total_price;
              ?>
              <td><?= "$" . number_format($item_total_price, 2); ?></td>
            </tr>
          <?php
          }
          ?>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>
              <?php
              echo "$" . number_format($total_price, 2);
              $_SESSION['total_price'] = $total_price;
              ?>
            </td>
          </tr>
        </table>
        <br>
        <div>
          <p>
            <?php
            if ($_SESSION['firstName'] != '') {
              echo "Thank you " . $_SESSION['firstName'] . " " . $_SESSION['lastName'] . "<br>";
            }
            if ($_SESSION['streetAddress'] != '' ) {
              echo "Your package will be sent to<br>" . $streetAddress . "<br>" . $cityAddress . "<br>" . $stateAddress . ", " . $zipAddress;
            } 
            ?>
          </p>
          <p>Your order has been confirmed!</p>
        </div>
      </div>
    <?php
    } session_destroy();
    ?>
  </main>
  <footer></footer>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>