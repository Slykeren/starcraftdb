<?php

    require('connect.php');

    $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $unit_id = $_POST['unit_id'];
    $username = $_POST['username'];

    $query = "INSERT INTO comments(comment, unit_id, username) VALUES (:comment, :unit_id, :username)";
    $statement = $db -> prepare($query); 
    $statement -> bindValue(':comment', $comment);
    $statement -> bindValue(':unit_id', $unit_id);
    $statement -> bindValue(':username', $username);
    $statement -> execute();
    
     exit();
     header("Location: show.php?id=$unit_id");

?>
