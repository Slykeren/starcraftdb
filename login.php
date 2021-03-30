<?php

    require('connect.php');
    session_start();
    $error = "";
    $password_is_valid = FALSE;

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE username = :username";
        $statement = $db -> prepare($query);
        $statement -> bindValue(':username', $username);
        $statement -> execute();
        $user = $statement -> fetch();

$password_check = password_verify($password, $user['password']);

        if(password_verify($password, $user['password']))
        {
            $_SESSION['user'] = $username;
            $password_is_valid = TRUE;
            header('Location: index.php');
            $error = "";
        }
        else
        {
            $error = "Some or all of your information is incorrect";
        }


        var_dump($_SESSION);
        var_dump($password);
        var_dump($username);
        var_dump($password_is_valid);
        var_dump($error);
        var_dump($password_check);
        var_dump($user['password']);



    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

    <body>
    <h1>Enter your information to login</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <legend>Login</legend>
        <fieldset>
            <?php if(empty($user)){echo $error;} ?>
            <?php if($password_is_valid == FALSE){echo $error;} ?>

            <p>
                <label for="username">Username</label>
                <input type="text" name="username" id="username">
            </p>

            <p>
                <label for="password">Password</label>
                <input type="text" name="password" id="password">
            </p>

            <p>
                <input type="submit" name="login" value="Login">
            </p>
        </fieldset>




        </form>
    </body>

</html>