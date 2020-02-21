<?php
require 'dbConnect.php';
$db = get_db();
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = htmlspecialchars($_POST['username']);
    echo "$username<br/>";
    $password = htmlspecialchars($_POST['password']);
    echo "$password<br/>";
} else {
    header('Location: signIn.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>| Welcome</title>
</head>

<body>
    <?php
    $query = "SELECT * FROM w7_usr WHERE username = :username";
    $usr = $db->prepare($query);
    $usr->bindValue(':username', $username);
    $usr->execute();
    while ($row = $usr->fetch(PDO::FETCH_ASSOC)) {
        $usernameInSystem = $row['username'];
        $passwordInSystem = $row['hashPass'];
        echo "ppppppoooo: $usernameInSystem, $passwordInSystem";
    }




    $statement = $db->prepare("SELECT * FROM w7_usr WHERE username = :username");
    $statement->bindValue(':username', $username);
    $statement->execute();
    echo "You were before the while loop<br>";
    // Go through each result

    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        echo "You are in the while loop fool.<br>";
        $hash_password = htmlspecialchars($row['hashpass']);
        echo "hash pass: $hash_password";
        var_dump($row);

        if (isset($hash_password)) {
            echo "the hash password is set fool<br>";
            if (password_verify($password, $hash_password)) {
                echo "<h1>WELCOME $username!!!!!! fool. You killing me SMALLS!!</h1>";
            } else {
                echo "Bad password";
                // header('Location: signIn.php');
                // die();
            }
        }
    }
    echo "You are after the while loop fool.<br>";

    ?>
</body>

</html>