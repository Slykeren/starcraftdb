<?php


    require("connect.php");
    session_start();

    $query = "SELECT * FROM units ORDER BY race_id DESC";
    $statement = $db -> prepare($query);
    $statement -> execute();


    $units = $statement -> fetchAll();

    if(!isset($_SESSION['user']))
    {
        $_SESSION['user'] = "";
    }

    var_dump($_SESSION['user']);


?>


<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">StarcraftDB</a> <?php if($_SESSION['user'] == "") :?> <a style="font-size:medium; display:flex; justify-content:right;" href="login.php">Login</a> <?php else : ?> <a style="font-size:medium; display:flex; justify-content:right;" href="logout.php">Logout</a> <?php endif ?> </h1>
        </div> <!-- END div id="header" -->
    <ul id="menu">
        <?php if($_SESSION['user'] == 'admin') : ?>
        <li><a href="create.php">New Unit</a></li>
        <?php endif ?>
    </ul> <!-- END div id="menu" -->

    <table>
        <tr>

            <?php if($_SESSION['user'] == 'admin') : ?>
                <th>Edit</th>
            <?php endif ?>
            <th> </th>
            <th>Name</th>
            <th>Race</th>
            <th>Type</th>
            <th>Requirements</th>
            <th>Built From</th>
            <th>Cost</th>
            <th>Attributes</th>
            <th>Damage</th>
            <th>DPS</th>
            <th>Range</th>
            <th>Health</th>
            <th>Armor</th>
            <th>Sight</th>
            <th>Speed</th>
        </tr>

        <?php foreach($units as $unit) : ?>

        <tr>
            <?php $unit_id = $unit['unit_id'] ?>
            
            <?php if($_SESSION['user'] == 'admin') : ?>
                <td><a href="edit.php?unit_id=<?=$unit_id?>">edit</a></td>
            <?php endif ?>
            <td><img src="img/<?=$unit['image']?>" alt="" width="40" height="40"></td>
            <td><?= $unit['name'] ?></td>
            <td><?= $unit['race'] ?></td>
            <td><?= $unit['type'] ?></td>
            <td><?= $unit['requirements'] ?></td>
            <td><?= $unit['built_from'] ?></td>
            <td><img src="img/Minerals.gif" alt=""> <?= $unit['cost_minerals']?>  <?php if($unit['cost_gas'] != NULL) :?> <img src="img/gas.gif" alt=""><?= $unit['cost_gas'] ?> <?php endif?> <?php if($unit['cost_supply'] != NULL) :?> <img src="img/supply.gif" alt=""> <?= $unit['cost_supply']?> <?php endif ?> </td>
            <td><?= $unit['attributes'] ?></td>
            <td><?= $unit['damage'] ?></td>
            <td><?= $unit['dps'] ?></td>
            <td><?= $unit['attack_range'] ?></td>
            <td><img src="img/health.png" alt=""><?= $unit['health']?> <?php if($unit['shields'] != "0" ) : ?> <img src="img/shields.png" alt=""> <?=$unit['shields']?> <?php endif ?> </td>
            <td> <img src="img/armor.png" alt=""> <?= $unit['armor'] ?></td>
            <td><?= $unit['sight'] ?></td>
            <td><?= $unit['speed'] ?></td>
            
        </tr>

        <?php endforeach ?>



    </table>









        <div id="footer">
            Copywrong 2021 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>
