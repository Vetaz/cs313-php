<?php
session_start();
date_default_timezone_set('MST');
function alert($msg) {
  echo "<script>alert('$msg');</script>";
}

if (isset($_FILES["filename"])) {
  $errors = array();
  $target_dir = "tempUploads/";
  $target_file = $target_dir . "USERNAME" . basename(date('YmdHis') . ".ged");
  $fileType = strtolower(pathinfo($_FILES["filename"]["name"], PATHINFO_EXTENSION));

  // File can only be a .ged file.
  if ($fileType != "ged") {
    $errors[] = "Only GEDCOM files allowed.<br>";
  }

  // File has to be less than 10 MiB in size.
  if ($_FILES["filename"]["size"] > 10485760) {
    $errors[] = "Your file is too large. Choose a file that is less than 10 MiB in size.<br>";
  }

  if (empty($errors) == false) {
    $errors[] = "Your file was not uploaded.<br>Page will redirect to the upload page.<br>";
    alert($errors[0]);
    header("Location: index.html");
  } else {
    if (move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file)) {
      echo "The file " . basename($_FILES["filename"]["name"]) . " has been uploaded.<br>";
      $_SESSION['filename'] = $target_file;
      header("Location: basic.php");
    } else {
      $errors[] = "Sorry, there was an error uploading your file.<br>Page will redirect to the upload page.";
      foreach($errors as $error)
      alert($error);
      //header("Location: index.html");
    }
  }
} else {
  echo "<p>Something went wrong. Redirecting to upload page.</p>";
  alert($errors);
  //header("Location: index.html");
}
?>
