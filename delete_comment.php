<?php

    require('connect.php');

    $comment_id = $_POST['comment_id'];

    $query = "DELETE FROM comments WHERE comment_id = :comment_id";
    $statement = $db -> prepare($query);
    $statement -> bindValue(':comment_id', $comment_id);
    
    


    if(isset($_POST['delete_comment']))
    {
        $statement -> execute();
    }

    header('Location: index.php')

?>