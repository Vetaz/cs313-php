<?php
session_start();
if(isset($_POST['submit'])) {
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    header('Location: insertUser.php');
    die();
}

  else {?>
<!DOCTYPE html>
        <title>
            <meta charset='utf-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <title>Sign up</title>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
        </title>
        <body>
            <form action='' method='POST'>
                <label for='username'>New username</label>
                <input type='text' id='username' name='username'/>
                <br/>
                <label for='password'>New password</label>
                <input type='password' id='password' name='password'/>
                <br/>
                <input type='submit' id='submit' name='submit' value='Create account'/>
            </form>
        </body>
    </html>
<?php }

?>