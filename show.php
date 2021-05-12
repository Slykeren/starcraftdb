<?php
require('connect.php');
session_start();

$unit_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$query = "SELECT * FROM units WHERE unit_id = :unit_id";
$statement = $db -> prepare($query);
$statement -> bindValue(':unit_id', $unit_id);
$statement -> execute();
$unit = $statement -> fetch();

$commentQuery = "SELECT * FROM comments WHERE unit_id = $unit_id ORDER BY timestamp DESC";
$commentStatement = $db -> prepare($commentQuery);
$commentStatement -> execute();
$comments = $commentStatement -> fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>StarcraftDB</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">StarcraftDB</a> <?php if($_SESSION['user'] == "") :?> <a style="font-size:medium; display:flex; justify-content:right;" href="login.php">Login</a> <?php else : ?> <a style="font-size:medium; display:flex; justify-content:right;" href="logout.php">Logout</a> <?php endif ?> </h1>
        </div> <!-- END div id="header" -->

        <div id="unit_info">
            <div>
                <h1 style="color: #7d9734;"><?=$unit['name']?></h1>
                <img src="img/<?=$unit['image']?>" alt="" width="100" height="100">
                <h2 style="color: #7d9734;">Unit Information</h2>
                <p>Race: <?=$unit['race']?></p>
                <p>Type: <?=$unit['type']?></p>
                <p>Description: <?=$unit['description']?></p>
                <p>Built From: <?=$unit['built_from']?></p>
                <p>Requirements: <?=$unit['requirements']?></p>
                <p>Cost: <img src="img/Minerals.gif" alt=""> <?= $unit['cost_minerals']?>  <?php if($unit['cost_gas'] != NULL) :?> <img src="img/gas.gif" alt=""><?= $unit['cost_gas'] ?> <?php endif?> <?php if($unit['cost_supply'] != NULL) :?> <img src="img/supply.gif" alt=""> <?= $unit['cost_supply']?> <?php endif ?></p>
                <p>Attributes: <?=$unit['attributes']?></p>
                <p>Targets: <?=$unit['targets']?></p>
                <p>Attack: <?=$unit['damage']?> DPS <?=$unit['dps']?></p>
                <p>Attack Cooldown: <?=$unit['attack_cooldown']?></p>
                <p>Attack Range: <?=$unit['attack_range']?></p>
                <p>Defense: <img src="img/health.png" alt=""><?= $unit['health']?> <?php if($unit['shields'] != "0" ) : ?> <img src="img/shields.png" alt=""> <?=$unit['shields']?> <?php endif ?><img src="img/armor.png" alt=""> <?= $unit['armor'] ?></p>
                <p>Sight: <?=$unit['sight']?></p>
                <p>Speed: <?=$unit['speed']?></p>
                <p>Transport Capacity: <?=$unit['transport_capacity']?></p>
                <p>Strong Against: <?=$unit['strong_against']?></p>
                <p>Weak Against: <?=$unit['weak_against']?></p>
            </div>
        </div>


        <div style="margin-top: 900px;">
            <div> <!-- New comment box -->
                <form action="process_comment.php" method="post" >
                    <fieldset>

                        <input type="hidden" name="unit_id" id="unit_id" value="<?=$unit_id?>">
                        <input type="hidden" name="username" id="username" value="<?=$_SESSION['user']?>">
                        <textarea name="comment" id="comment" cols="40" rows="5"></textarea>
                        <input type="submit" name="submitComment" value="Submit">

                    </fieldset>
                </form>
            </div>
        
            <div> <!-- display of all comments -->
                
                <?php foreach($comments as $comment) :?>
                    <h4><?=$comment['username']?>     <?=$comment['timestamp']?>   <?php if($_SESSION['user'] == 'admin') :?>   <form action="delete_comment.php" method="POST"><input type="submit" name="delete_comment" value="Delete"><input type="hidden" name="comment_id" id="comment_id" value="<?=$comment['comment_id']?>"></form> <?php endif ?></h4>
                    <p> <?=$comment['comment']?></p>
                <?php endforeach ?>

            </div>

        </div>







        <div id="footer">
            Copywrong 2021 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>