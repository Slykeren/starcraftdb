<?php

  #require 'authenticate.php';
  require("connect.php");
  session_start();

  $unit_id = filter_input(INPUT_GET, 'unit_id', FILTER_SANITIZE_NUMBER_INT);
  $idType = is_numeric($_GET['unit_id']);
  $query = "SELECT * FROM units WHERE unit_id = :unit_id";
  $statement = $db -> prepare($query);
  $statement -> bindValue(':unit_id', $unit_id, PDO::PARAM_INT);
  $statement -> execute();
  $unit = $statement -> fetch();

  if($idType == false)
  {
    header('Location: index.php');
  }

  if(isset($_SESSION['user']))
  {
    if($_SESSION['user'] != 'admin')
    {
      header('Location: index.php');
    }
  }
  else
  {
    header('Location: index.php');
  }
  
  

?>

<!DOCTYPE html>

<!-- gets the id from the get paramater specified in index, and finds the rest of the content based off id through db queries and allows for edit and sends it to post_process to commit the update or delete to the db -->

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>StarcraftDB</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">StarcraftDB</a></h1>
        </div> <!-- END div id="header" -->

<div id="all_blogs">
  <form action="process_unit.php" method="post" enctype="multipart/form-data">
    <fieldset>
      <legend>Edit Blog Post</legend>

      <p>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="<?=$unit['name']?>">
      </p>

      <p>
        <label for="race">Race</label>
        <select name="race" id="race"  >
          <option value="Protoss" <?php if($unit['race'] == "Protoss") :?> selected <?php endif ?> >Protoss</option>
          <option value="Terran" <?php if($unit['race'] == "Terran") :?> selected <?php endif ?>>Terran</option>
          <option value="Zerg" <?php if($unit['race'] == "Zerg") :?> selected <?php endif ?>>Zerg</option>
        </select>
      </p>
      
      <p>
        <label for="type">Type</label>
          <select name="type" id="type">
            <option value="Ground" <?php if($unit['type'] == "Ground") :?> selected <?php endif ?>>Ground</option>
            <option value="Air"<?php if($unit['type'] == "Air") :?> selected <?php endif ?>>Air</option>
            <option value="Ground & Air" <?php if($unit['type'] == "Ground & Air") :?> selected <?php endif ?>>Ground & Air</option>
          </select>
      </p>
      
      <p>
        <label for="requirements">Tech Requirements</label>
        <input type="text" name="requirements" id="requirements" value="<?=$unit['requirements']?>">
      </p>

      <p>
        <label for="built_from">Built From</label>
        <input type="text" name="built_from" id="built_from" value="<?=$unit['built_from']?>">
      </p>

      <p>
        <label for="minerals">Minerals</label>
        <input type="text" name="minerals" id="minerals" value="<?=$unit['cost_minerals']?>">
        <label for="gas">Gas</label> 
        <input type="text" name="gas" id="gas" value="<?=$unit['cost_gas']?>"> 
        <label for="supply">Supply</label>
        <input type="text" name="supply" id="supply" value="<?=$unit['cost_supply']?>">
      </p>

      <p>
        <label for="attributes">Attributes</label>
        <input type="text" name="attributes" id="attributes" value="<?=$unit['attributes']?>">
      </p>

      <p>
        <label for="damage">Damage</label>
        <input type="text" name="damage" id="damage" value="<?=$unit['damage']?>">
      </p>

      <p>
        <label for="health">Health</label>
        <input type="text" name="health" id="health" value="<?=$unit['health']?>">
      </p>

      <p>
        <label for="shields">Shields</label>
        <input type="text" name="shields" id="shields" value="<?=$unit['shields']?>">
      </p>

      <p>
        <label for="armor">Armor</label>
        <input type="text" name="armor" id="armor" value="<?=$unit['armor']?>">
      </p>

      <p>
        <label for="sight">Sight</label>
        <input type="text" name="sight" id="sight" value="<?=$unit['sight']?>">
      </p>

      <p>
        <label for="speed">Speed</label>
        <input type="text" name="speed" id="speed" value="<?=$unit['speed']?>">
      </p>

      <p>
        <label for="targets">Targets</label>
        <input type="text" name="targets" id="targets" value="<?=$unit['targets']?>">
      </p>

      <p>
        <label for="dps">DPS</label>
        <input type="text" name="dps" id="dps" value="<?=$unit['dps']?>">
      </p>

      <p>
        <label for="attack_cooldown">Attack Cooldown</label>
        <input type="text" name="attack_cooldown" id="attack_cooldown" value="<?=$unit['attack_cooldown']?>">
      </p>

      <p>
        <label for="range">Range</label>
        <input type="text" name="range" id="range" value="<?=$unit['attack_range']?>">
      </p>

      <p>
        <label for="transport_capacity">Transport Capacity</label>
        <input type="text" name="transport_capacity" id="transport_capacity" value="<?=$unit['transport_capacity']?>">
      </p>

      <p>
        <label for="strong_against">Strong Against</label>
        <input type="text" name="strong_against" id="strong_against" value="<?=$unit['strong_against']?>">
      </p>

      <p>
        <label for="weak_against">Weak Against</label>
        <input type="text" name="weak_against" id="weak_against" value="<?=$unit['weak_against']?>">
      </p>

      <p>
        <label for="description">Description</label>
        <textarea name="description" id="description" cols="30" rows="4"><?=$unit['description']?></textarea>
      </p>

      <p>
        <label for="other">Other</label>
        <input type="text" name="other" id="other" value="<?=$unit['other']?>">
      </p>

      <p>
        <label for="img">Image</label>
        <input type="file" name="image" id="image" accept="image/*" >
      </p>

      <p>
        <input type="hidden" name="unit_id" value="<?=$unit_id?>" />
        <input type="submit" name="update" value="Update" />
        <input type="submit" name="delete" value="Delete" onclick="return confirm('Are you sure you wish to delete this post?')" />
      </p>
    </fieldset>
  </form>
</div>
        <div id="footer">
            Copywrong 2021 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>
