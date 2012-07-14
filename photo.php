<?php

spl_autoload_register();

use Adelina\Services\ServiceFile;
use Adelina\Tools\Template;
use Adelina\Tools\Config;

// This file is designed for loading the left menu (albums list)
$config = new Config("config/config.ini");

// Where is the directory with all photos ?
$folder = $config->getValue("folders", "main");
$dir_small = $config->getValue("folders", "small");

if(file_exists($folder ."/". $_POST['gallery'] ."/". $_POST['photo']))
{
    $template = new Template("templates");
    $template->setFilenames(array("PHOTO" => "photo.tpl"));
    
    
    // The small image exist too ?
    if(file_exists($folder ."/". $_POST['gallery'] ."/". $dir_small ."/". $_POST['photo']))
    {
        // Yeah ! We use the small photo instead of the orignal, for brandwidth economy.
        $template->assignVar("PHOTO_PATH", $folder ."/". $_POST['gallery'] ."/". $dir_small ."/". $_POST['photo']);
        $template->assignVar("PHOTO_NAME", $_POST['photo']);
    }
    else
    {
        // No, we use the original
        $template->assignVar("PHOTO_PATH", $folder ."/". $_POST['gallery'] ."/". $_POST['photo']);
        $template->assignVar("PHOTO_NAME", $_POST['photo']);
    }
    
    $template->assignVar("PHOTO_GALLERY", $_POST['gallery']);
    
    $template->pparse("PHOTO");
}
else
{
    // Sorry, this photo doesn't exist... :(
    echo "Error : No photo for this path! Try again :-(";
}
