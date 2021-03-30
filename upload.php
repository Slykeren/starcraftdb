<?php

/* require "\xampp\htdocs\CC6\php-image-resize-master\lib\ImageResize.php";
require "\xampp\htdocs\CC6\php-image-resize-master\lib\ImageResizeException.php"; */


/* 
I could not get the library to work, I changed the php.ini, restarted xampp and messed with the path but to no avail

i wrote the code, but i don't know if it works but everything else works fine.

 */



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

/*         if(!mime_content_type('application/pdf'))
        {   

        $image400 = new ImageResize($image);
        $image50 = new ImageResize($image);

        $image400 -> resizeToWidth(400);
        $image400 -> save(basename($image)."_medium_".substr($image, -4));

        $image50 -> resizeToWidth(50);
        $image50 -> save(basename($image)."_thumbnail_".substr($image, -4));

        } */
    }

?>