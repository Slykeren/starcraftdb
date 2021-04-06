<?php

#require 'authenticate.php';

   session_start();

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

  var_dump($_SESSION['user']);

?>

<!DOCTYPE html>

<!-- takes an input and sends it to process_post.php -->

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
      <legend>Unit Creation</legend>
      <p>
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
      </p>

      <p>
        <label for="race">Race</label>
        <select name="race" id="race">
          <option value="protoss">Protoss</option>
          <option value="terran">Terran</option>
          <option value="zerg">Zerg</option>
        </select>
      </p>
      
      <p>
        <label for="type">Type</label>
        <select name="type" id="type">
          <option value="Ground">Ground</option>
          <option value="Air">Air</option>
          <option value="Ground & Air">Ground & Air</option>
        </select>
      </p>
      
      <p>
        <label for="requirements">Tech Requirements</label>
        <input type="text" name="requirements" id="requirements">
      </p>

      <p>
        <label for="built_from">Built From</label>
        <input type="text" name="built_from" id="built_from">
      </p>

      <p>
        <label for="minerals">Minerals</label>
        <input type="text" name="minerals" id="minerals">
        <label for="gas">Gas</label> 
        <input type="text" name="gas" id="gas"> 
        <label for="supply">Supply</label>
        <input type="text" name="supply" id="supply">
      </p>

      <p>
        <label for="attributes">Attributes</label>
        <input type="text" name="attributes" id="attributes">
      </p>

      <p>
        <label for="damage">Damage</label>
        <input type="text" name="damage" id="damage">
      </p>

      <p>
        <label for="health">Health</label>
        <input type="text" name="health" id="health">
      </p>

      <p>
        <label for="shields">Shields</label>
        <input type="text" name="sheilds" id="shields">
      </p>

      <p>
        <label for="armor">Armor</label>
        <input type="text" name="armor" id="armor">
      </p>

      <p>
        <label for="sight">Sight</label>
        <input type="text" name="sight" id="sight">
      </p>

      <p>
        <label for="speed">Speed</label>
        <input type="text" name="speed" id="speed">
      </p>

      <p>
        <label for="targets">Targets</label>
        <input type="text" name="targets" id="targets">
      </p>

      <p>
        <label for="dps">DPS</label>
        <input type="text" name="dps" id="dps">
      </p>

      <p>
        <label for="attack_cooldown">Attack Cooldown</label>
        <input type="text" name="attack_cooldown" id="attack_cooldown">
      </p>

      <p>
        <label for="range">Range</label>
        <input type="text" name="range" id="range">
      </p>

      <p>
        <label for="transport_capacity">Transport Capacity</label>
        <input type="text" name="transport_capacity" id="transport_capacity">
      </p>

      <p>
        <label for="strong_against">Strong Against</label>
        <input type="text" name="strong_against" id="strong_against">
      </p>

      <p>
        <label for="weak_against">Weak Against</label>
        <input type="text" name="weak_against" id="weak_against">
      </p>

      <p>
        <label for="description">Description</label>
        <textarea name="description" id="description" cols="30" rows="10"></textarea>
      </p>

      <p>
        <label for="other">Other</label>
        <input type="text" name="other" id="other">
      </p>

      <p>
        <label for="img">Image</label>
        <input type="file" name="image" id="image" accept="image/*">
      </p>
      


      <p>
        <input type="submit" name="create" value="Create" />
        
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
