<?php

require("connect.php");

    $username = $_POST['username'];
    //$password = $_POST['password'];
    $password = password_hash(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS), PASSWORD_DEFAULT);



if(isset($_POST['edit_user']))
{

    // Build the parameterized SQL querys
    $user = "UPDATE users SET username = :username, password = :password WHERE id = :id";
    $statement = $db->prepare($user);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':password', $password);
    $statement->bindValue(':id', $_POST['id']);
    $statement->execute();
}

if(isset($_POST['delete_user']))
{

    // Build the parameterized SQL querys
    $user = "DELETE FROM users WHERE id = :id";
    $statement = $db->prepare($user);
    $statement->bindValue(':id', $_POST['id']);
    $statement->execute();
}

header('Location: index.php');

?>