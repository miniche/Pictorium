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
$arrayFiles = ServiceFile::getAllFilesInOneDirectory($folder ."/". $_POST['gallery'] ."/". $dir_thumbs ."/");

// Ok, we'r displaying all directories !

$template = new Template("templates");
$template->setFilenames(array("MENU" => "album.tpl"));

foreach ($arrayFiles as $file) {
    $template->assignBlockVars("PHOTOS", array("NAME" => $file->getName(), "FILE" => $folder ."/". $_POST['gallery'] ."/". $dir_thumbs ."/". $file->getName()));
}

$template->pparse("MENU");


?>
