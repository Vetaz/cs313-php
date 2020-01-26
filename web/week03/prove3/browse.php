<?php
session_start();

function sanitize_input($input)
{
  $input = trim($input);
  $input = stripslashes($input);
  $input = htmlspecialchars($input);
  return $input;
}

if (isset($_POST['action'])) {
  $action = sanitize_input($_POST['action']);
  $item_num = sanitize_input($_POST['item']);
  if ($action == "Add to Cart") {
    if (!isset($_SESSION['item-quantity'][$item_num])) {
      $_SESSION['item-quantity'][$item_num] = 1;
    } else {
    $_SESSION['item-quantity'][$item_num] += 1;
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Browse</title>

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
    <br>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="card mb-4">
            <div class="card-img-top text-center">
              <img src="images/cadbury.jpeg" class="col-10" style="width:100%;">
            </div>
            <div class="card-body">
              <p class="card-text">Cadbury Mini Eggs, Milk Chocolate, 10 oz</p>
              <div class="d-flex justify-content-between align-items-center">
                <form method="post" action="browse.php">
                  <input type="hidden" name="item" value="0">
                  <input type="submit" class="btn btn-sm btn-outline-secondary" name="action" value="Add to Cart"></input>
                </form>
                <span>$5.00</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <div class="card-img-top text-center">
              <img src="images/ferrero-rocher-42ct.jpeg" class="col-10" style="width:100%;">
            </div>
            <div class="card-body">
              <p class="card-text">Ferrero Rocher Fine Hazelnut Milk Chocolates, 42 Count</p>
              <div class="d-flex justify-content-between align-items-center">
                <form method="post" action="browse.php">
                  <input type="hidden" name="item" value="1">
                  <input type="submit" class="btn btn-sm btn-outline-secondary" name="action" value="Add to Cart"></input>
                </form>
                <span>$7.00</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <div class="card-img-top text-center">
              <img src="images/dove-8oz.jpeg" class="col-10" style="width:100%;">
            </div>
            <div class="card-body">
              <p class="card-text">Dove Milk Chocolate, 8.46 oz</p>
              <div class="d-flex justify-content-between align-items-center">
                <form method="post" action="browse.php">
                  <input type="hidden" name="item" value="2">
                  <input type="submit" class="btn btn-sm btn-outline-secondary" name="action" value="Add to Cart"></input>
                </form>
                <span>$3.99</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-3 shadow-sm">
            <div class="card-img-top text-center">
              <img src="images/dove-dark-8oz.jpeg" class="col-10" style="width:100%;">
            </div>
            <div class="card-body">
              <p class="card-text">Dove Dark Chocolate, 8.46 oz</p>
              <div class="d-flex justify-content-between align-items-center">
                <form method="post" action="browse.php">
                  <input type="hidden" name="item" value="3">
                  <input type="submit" class="btn btn-sm btn-outline-secondary" name="action" value="Add to Cart"></input>
                </form>
                <span>$3.99</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <div class="card-img-top text-center">
              <img src="images/snickers.jpeg" class="col-10" style="width:100%;">
            </div>
            <div class="card-body">
              <p class="card-text">Snickers, 1.86 oz, 6 Count</p>
              <div class="d-flex justify-content-between align-items-center">
                <form method="post" action="browse.php">
                  <input type="hidden" name="item" value="4">
                  <input type="submit" class="btn btn-sm btn-outline-secondary" name="action" value="Add to Cart"></input>
                </form>
                <span>$4.98</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <div class="card-img-top text-center">
              <img src="images/reese's.jpeg" class="col-10" style="width:100%;">
            </div>
            <div class="card-body">
              <p class="card-text">Giant Reese's Peanut Butter Bars,6.8 oz</p>
              <div class="d-flex justify-content-between align-items-center">
                <form method="post" action="browse.php">
                  <input type="hidden" name="item" value="5">
                  <input type="submit" class="btn btn-sm btn-outline-secondary" name="action" value="Add to Cart"></input>
                </form>
                <span>$4.98</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <footer></footer>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>