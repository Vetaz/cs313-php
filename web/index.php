<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assignments.css">
  <link id="dark" rel="" href="dark.css">
  <link rel="stylesheet" href="toggle-button.css">

  <title>Jordi's Homepage</title>
</head>

<body>
  <header>
    <h1 class="text-center">Welcome to Jordi's Homepage</h1>
  </header>
  <main>
    <nav>
      <a class="button" href="introduction.html">Introduction</a>
      <a class="button" href="assignments.html">Assignments</a>
    </nav>
  </main>
  <?php date_default_timezone_set("Europe/Amsterdam") ?>
  <footer class="text-center">
    <p>It is <?php echo date('h:i:s a') . " on " . date('l, F dS ') ?> in the Netherlands right now.</p>
    <br>
    <div class="toggle-btn-container">
      <div class="toggle-btn" onclick="toggleDarkMode();this.classList.toggle('active')">
        <div class="inner-circle"></div>
      </div>
    </div>
  </footer>
  <script src="toggle-button.js"></script>
</body>

</html>