<?php

spl_autoload_register();

use Adelina\Services\ServiceFile;
use Adelina\Tools\Template;
use Adelina\Tools\Config;
use Classes\JSON;

// This file is designed for loading the left menu (albums list)
$config = new Config("config/config.ini");

// Where is the directory with all photos ?
$folder = $config->getValue("folders", "main");
$dir_small = $config->getValue("folders", "small");

// New : we use the full AJAX method.
$jsonPhoto = new JSON\JsonPhoto();

if(file_exists($folder ."/". $_POST['gallery'] ."/". $_POST['photo']))
{
    // Updated by miniche on 16th july 2012.
    // New :
    
    $photo = ServiceFile::getOnePicture($folder ."/". $_POST['gallery'],$_POST['photo']);
    
    // Common vars
    $jsonPhoto->setStatus("ok");
    $jsonPhoto->setName($_POST['photo']);
    $jsonPhoto->setDate($photo->getCreated_on());
    $jsonPhoto->setGallery($_POST['gallery']);
    
    if(file_exists($folder ."/". $_POST['gallery'] ."/". $dir_small ."/". $_POST['photo']))
    {
        $jsonPhoto->setUrl_compressed($folder ."/". $_POST['gallery'] ."/". $dir_small ."/". $_POST['photo']);
        $jsonPhoto->setUrl_full($folder ."/". $_POST['gallery'] ."/". $_POST['photo']);
        
        // Load information on the small image
        $smallPhoto = ServiceFile::getOnePicture($folder ."/". $_POST['gallery'] ."/". $dir_small, $_POST['photo']);
        $jsonPhoto->setWidth($smallPhoto->getWidth());
        $jsonPhoto->setHeight($smallPhoto->getHeight());
    }
    else
    {
        $jsonPhoto->setUrl_compressed($folder ."/". $_POST['gallery'] ."/". $_POST['photo']);
        $jsonPhoto->setUrl_full($folder ."/". $_POST['gallery'] ."/". $_POST['photo']);
        $jsonPhoto->setWidth($photo->getWidth());
        $jsonPhoto->setHeight($photo->getHeight());
    }
    
    // Before :
    /*
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
     */
}
else
{
    // Sorry, this photo doesn't exist... :(
    $jsonPhoto->setStatus("We can't load this picture!");
}


// Ok, we send the result !
echo $jsonPhoto->getJSONEncode();
