<?php

    require("connect.php");
    session_start();

    $username = $password = $confirm_password = "";
    $username_error = $password_error = $confirm_password_error = "";

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = password_hash(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS), PASSWORD_DEFAULT);
    $password_confirm = filter_input(INPUT_POST, 'password_confirm', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $username_empty  = FALSE;
    $username_exists = FALSE;
    $passwords_match = FALSE;

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if(empty($_POST['username']))
        {
            $username_error = "Please enter a username";
            $username_empty = TRUE;
        }
        else
        {
            $username_query = "SELECT * FROM users";
            $statement = $db->prepare($username_query);
            $statement -> execute();
            $users = $statement -> fetchAll();

            foreach($users as $user)
            {
                if($user['username'] == $username)
                {
                    $username_exists = TRUE;
                    $username_error = "This username is already taken";
                }
            }
        }

        if(password_verify($password_confirm, $password))
        {
            $passwords_match = TRUE;
        }

        if($username_exists == FALSE && $passwords_match == TRUE && $username_empty == FALSE)
        {
            if(isset($_POST['create']))
            {

                // Build the parameterized SQL querys
                $user = "INSERT INTO users (username, password) values (:username, :password)";
                $statement = $db->prepare($user);
                $statement->bindValue(':username', $username);
                $statement->bindValue(':password', $password);
                $statement->execute();
            } 
        }



    }




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="styles.css" type="text/css">
<body>
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <fieldset>

            <legend>Create New Account</legend>
            <p>
                <label for="username">Username</label>
                <input type="text" name="username" id="username">
                <?php if($username_exists == TRUE) :?>
                    <p>That username is already taken</p>
                <?php endif ?>
                <?php if($username_empty == TRUE) :?>
                    <p>Please enter a username</p>
                <?php endif ?>
            </p>

            <p>
                <?php if(empty($_POST['password'])) :?>
                    <p>Please enter a password</p>
                <?php endif ?>
                <label for="password">Password</label>
                <input type="text" name="password" id="password">
            </p>

            <p>
                <label for="password_confirm">Confirm Password</label>
                <input type="text" name="password_confirm" id="password_confirm">
                <?php if($passwords_match == FALSE) : ?>
                    <p>Passwords do not match</p>
                <?php endif ?>
            </p>

            <p>
                <input type="submit" name="create" value="Create Account"/>
            </p>

        </fieldset>
    
    </form>









</body>

</html>