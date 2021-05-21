<?php


    require("connect.php");
    session_start();

    $query = "SELECT * FROM users";
    $statement = $db -> prepare($query);
    $statement -> execute();


    $users = $statement -> fetchAll();

    if($_SESSION['user'] != "admin")
    {
        header("Location: index.php");
    }


?>


<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">StarcraftDB</a> <?php if($_SESSION['user'] == "") :?> <a style="font-size:medium; display:flex; justify-content:right;" href="login.php">Login</a> <?php else : ?> <a style="font-size:medium; display:flex; justify-content:right;" href="logout.php">Logout</a> <?php endif ?> </h1>
        </div> <!-- END div id="header" -->
    <ul id="menu">
        <?php if($_SESSION['user'] == 'admin') : ?>
        <li><a href="create.php">New User</a></li>
        <?php endif ?>
    </ul> <!-- END div id="menu" -->

    <table>
    <tr><th>Username</th></tr>
    
    <?php foreach($users as $user): ?>
        <tr>
            <td><?=$user['username']?> 
            <form action="edit_users.php" method="POST">
            <input type="submit" name="edit" value="Edit">
            <input type="submit" name="delete" value="delete">
            <input type="hidden" name="id" value="<?=$user['id']?>">
            </form></td>
        </tr>
    <?php endforeach ?>
    </table>





        <div id="footer">
            Copywrong 2021 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>

aklsjdalsd