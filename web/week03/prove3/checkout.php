<?php session_start(); ?>

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
    <form action="confirm.php" method="POST" >
      <fieldset class="container">
        <legend>Personal Information</legend>
        <label>First Name:
          <input type="text" name="first_name" placeholder="First Name"><br>
        </label><br>

        <label>Last Name:
          <input type="text" name="last_name" placeholder="Last Name"><br>
        </label><br>

        <label>Address:
          <input type="text" name="street_address" placeholder="123 Street Adress"><br>
        </label><br>

        <label>City:
          <input type="text" name="city_address" placeholder="City"><br>
        </label><br>

        <label>State:
          <input type="text" name="state_address" placeholder="State" size="2" maxlength="2"><br>
        </label><br>

        <label>ZIP Code:
          <input type="text" name="zip_address" placeholder="XXXXX" size="5" maxlength="5"><br>
        </label><br>

        <input type="submit" class="btn btn-sm btn-outline-secondary" value="Confirm">
        <a href="cart.php" class="btn btn-sm btn-outline-secondary">Return to Cart</a>
      </fieldset>
    </form>
  </main>
  <footer></footer>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>