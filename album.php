<?php

spl_autoload_register();

use Adelina\Services\ServiceFile;
use Adelina\Tools\Template;
use Adelina\Tools\Config;

// This file is designed for loading the left menu (albums list)
$config = new Config("config/config.ini");

// Where is the directory with all photos ?
$folder = $config->getValue("folders", "main");
$dir_thumbs = $config->getValue("folders", "thumbnails");

// Getting all directories (albums) in your folder
//$arrayFiles = ServiceFile::getAllFilesInOneDirectory($folder ."/". $_POST['gallery'] ."/". $dir_thumbs ."/");
$arrayFiles = ServiceFile::getAllPicturesInOneDirectory($folder . "/" . $_POST['gallery']);

// Ok, we'r displaying all directories !

$template = new Template("templates");
$template->setFilenames(array("MENU" => "album.tpl"));

foreach ($arrayFiles as $file) {

    // This photo is compressed?
    if (file_exists($folder . "/" . $_POST['gallery'] . "/" . $dir_thumbs . "/" . $file->getName())) {
        // yeah ! We use the small image instead.
        $url_img = $folder . "/" . $_POST['gallery'] . "/" . $dir_thumbs . "/" . $file->getName();
    } else {
        // No :-( Where is the cron? On strike? Your server is too slow? I'm very sad, but I must use the full def version. Brandwidth will be happy..Or not...
    
        $url_img = $folder . "/" . $_POST['gallery'] . "/" . $file->getName();
    }

    $template->assignBlockVars("PHOTOS", array("NAME" => $file->getName(), "DIR" => $_POST['gallery'], "FILE" => $url_img));
}

$template->pparse("MENU");

