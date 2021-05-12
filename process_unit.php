<?php
   
   

    $unit_id            = filter_input(INPUT_POST, 'unit_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $name               = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $race               = filter_input(INPUT_POST, 'race', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $type               = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $built_from         = filter_input(INPUT_POST, 'built_from', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $attributes         = filter_input(INPUT_POST, 'attributes', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $requirements       = filter_input(INPUT_POST, 'requirements', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cost_minerals      = filter_input(INPUT_POST, 'minerals', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cost_gas           = filter_input(INPUT_POST, 'gas', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cost_supply        = filter_input(INPUT_POST, 'supply', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $damage             = filter_input(INPUT_POST, 'damage', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $health             = filter_input(INPUT_POST, 'health', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $armor              = filter_input(INPUT_POST, 'armor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $sight              = filter_input(INPUT_POST, 'sight', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $speed              = filter_input(INPUT_POST, 'speed', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $targets            = filter_input(INPUT_POST, 'targets', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $dps                = filter_input(INPUT_POST, 'dps', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $attack_cooldown    = filter_input(INPUT_POST, 'attack_cooldown', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $attack_range       = filter_input(INPUT_POST, 'range', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $transport_capacity = filter_input(INPUT_POST, 'transport_capacity', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $strong_against     = filter_input(INPUT_POST, 'strong_against', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $weak_against       = filter_input(INPUT_POST, 'weak_against', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description        = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $other              = filter_input(INPUT_POST, 'other', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $shields            = "0";
    $race_id            = 0;
    
    if(isset($_POST['shields']))
    {
        $shields = $_POST['shields'];
    }


    else
    {
        $image = NULL;
    }
    
    if($race == 'Protoss')
    {
        $race_id = 1;
    }
    elseif($race == 'Terran')
    {
        $race_id = 2;
    }
    elseif($race = 'Zerg')
    {
        $race_id = 3;
    }

    
    $queryUpdate = "UPDATE units SET name = :name, type = :type, requirements = :requirements, built_from = :built_from, cost_minerals = :cost_minerals, 
    cost_gas = :cost_gas, cost_supply = :cost_supply, attributes = :attributes, targets = :targets, damage = :damage, dps = :dps, attack_cooldown = :attack_cooldown,
    attack_range = :attack_range, health = :health, shields = :shields, armor = :armor, sight = :sight, speed = :speed, transport_capacity = :transport_capacity,
    image = :image, race_id = :race_id, race = :race, strong_against = :strong_against, weak_against = :weak_against, description = :description, other = :other WHERE unit_id = :unit_id";

    $queryDelete = "DELETE FROM units WHERE unit_id = :unit_id";

    $queryInsert = "INSERT INTO units (name, type, requirements, built_from, cost_minerals, cost_gas, cost_supply, attributes, targets, damage, dps, attack_cooldown, 
    attack_range, health, shields, armor, sight, speed, transport_capacity, image, race_id, race, strong_against, weak_against, description, other) 
    VALUES (:name, :type, :requirements, :built_from, :cost_minerals, :cost_gas, :cost_supply, :attributes, :targets, :damage, :dps, :attack_cooldown, 
    :attack_range, :health, :shields, :armor, :sight, :speed, :transport_capacity, :image, :race_id, :race, :strong_against, :weak_against, :description, :other)";
    
    function isValidType()
{   
    $imagePath = $_FILES['image']['tmp_name'];
    $imageName = $_FILES['image']['name'];
    $mimeTypes = ['image/gif', 'image/jpeg', 'image/png', 'application/pdf'];
    $extensions = ['.gif', '.jpg', '.png', '.jpeg', '.pdf'];

    if(in_array(mime_content_type($imagePath), $mimeTypes) == true && in_array(substr($imageName, -4), $extensions ) == true )
    {
        return true;
    }
    else
    {
        return false;
    }
}


if(isset($_FILES['image']) && $_FILES['image']['error'] == 0 && isValidType() == true)
{
    $image = $_FILES['image']['name'];
    $tempPath = $_FILES['image']['tmp_name'];
    $uploadsSubfolder = 'img';
    $currentFolder = dirname(__FILE__);
    $path = [$currentFolder, $uploadsSubfolder, basename($image) ];
    $newPath = implode(DIRECTORY_SEPARATOR, $path);

    move_uploaded_file($tempPath, $newPath);
}



?>

<!doctype html>

<!-- takes information from create/edit and commits it to the data base after validations -->

<html lang="en">
<head>
	<title>Post Processor</title>
</head>
<body>


        <?php if($name == "" || $built_from == "" || $cost_minerals == "" || $health == "") : ?>

            <p>Name, built from, mineral cost, health, and race can't be empty</p>

        <?php else : ?>


            <?php require("connect.php") ?>

            <?php if(isset($_POST['delete'])) : ?>
                
                <?php $statement = $db -> prepare($queryDelete); ?>
                <?php $statement -> bindValue(':unit_id', $unit_id); ?>
                <?php $statement -> execute(); ?>
                <?php header("Location: index.php") ?>
                <?php exit(); ?>

            <?php elseif(isset($_POST['update'])) : ?>

                <?php $statement = $db -> prepare($queryUpdate); ?>
                <?php $statement -> bindValue(':name', $name); ?>
                <?php $statement -> bindValue(':type', $type); ?>
                <?php $statement -> bindValue(':requirements', $requirements ); ?>
                <?php $statement -> bindValue(':built_from', $built_from); ?>
                <?php $statement -> bindValue(':cost_minerals', $cost_minerals); ?>
                <?php $statement -> bindValue(':cost_gas', $cost_gas); ?>
                <?php $statement -> bindValue(':cost_supply', $cost_supply); ?>
                <?php $statement -> bindValue(':attributes', $attributes); ?>
                <?php $statement -> bindValue(':targets', $targets); ?>
                <?php $statement -> bindValue(':damage', $damage); ?>
                <?php $statement -> bindValue(':dps', $dps); ?>
                <?php $statement -> bindValue(':attack_cooldown', $attack_cooldown); ?>
                <?php $statement -> bindValue(':attack_range', $attack_range); ?>
                <?php $statement -> bindValue(':health', $health); ?>
                <?php $statement -> bindValue(':shields', $shields); ?>
                <?php $statement -> bindValue(':armor', $armor); ?>
                <?php $statement -> bindValue(':sight', $sight); ?>
                <?php $statement -> bindValue(':speed', $speed); ?>
                <?php $statement -> bindValue(':transport_capacity', $transport_capacity); ?>
                <?php $statement -> bindValue(':image', $image); ?>
                <?php $statement -> bindValue(':race_id', $race_id); ?>
                <?php $statement -> bindValue(':race', $race); ?>
                <?php $statement -> bindValue(':strong_against', $strong_against); ?>
                <?php $statement -> bindValue(':weak_against', $weak_against); ?>
                <?php $statement -> bindValue(':description', $description); ?>
                <?php $statement -> bindValue(':other', $other); ?>
                <?php $statement -> bindValue(':unit_id', $unit_id); ?>
                <?php $statement -> execute(); ?>
                <?php header("Location: index.php") ?>
                <?php exit(); ?>


            <?php elseif(isset($_POST['create'])) : ?>

                <?php $statement = $db -> prepare($queryInsert); ?>

                <?php $statement -> bindValue(':name', $name); ?>
                <?php $statement -> bindValue(':type', $type); ?>
                <?php $statement -> bindValue(':requirements', $requirements ); ?>
                <?php $statement -> bindValue(':built_from', $built_from); ?>
                <?php $statement -> bindValue(':cost_minerals', $cost_minerals); ?>
                <?php $statement -> bindValue(':cost_gas', $cost_gas); ?>
                <?php $statement -> bindValue(':cost_supply', $cost_supply); ?>
                <?php $statement -> bindValue(':attributes', $attributes); ?>
                <?php $statement -> bindValue(':targets', $targets); ?>
                <?php $statement -> bindValue(':damage', $damage); ?>
                <?php $statement -> bindValue(':dps', $dps); ?>
                <?php $statement -> bindValue(':attack_cooldown', $attack_cooldown); ?>
                <?php $statement -> bindValue(':attack_range', $attack_range); ?>
                <?php $statement -> bindValue(':health', $health); ?>
                <?php $statement -> bindValue(':shields', $shields); ?>
                <?php $statement -> bindValue(':armor', $armor); ?>
                <?php $statement -> bindValue(':sight', $sight); ?>
                <?php $statement -> bindValue(':speed', $speed); ?>
                <?php $statement -> bindValue(':transport_capacity', $transport_capacity); ?>
                <?php $statement -> bindValue(':image', $image); ?>
                <?php $statement -> bindValue(':race_id', $race_id); ?>
                <?php $statement -> bindValue(':race', $race); ?>
                <?php $statement -> bindValue(':strong_against', $strong_against); ?>
                <?php $statement -> bindValue(':weak_against', $weak_against); ?>
                <?php $statement -> bindValue(':description', $description); ?>
                <?php $statement -> bindValue(':other', $other); ?>
                <?php $statement -> execute(); ?>

                <?php header("Location: index.php") ?>
                <?php exit(); ?>


            <?php endif ?>
                
 
        
        <?php endif ?>


</body>
</html>
