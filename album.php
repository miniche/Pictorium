<?php

spl_autoload_register();

use Adelina\Services\ServiceFile;
use Adelina\Tools\Template;
use Adelina\Tools\Config;

// This file is designed for loading the left menu (albums list)
$config = new Config("config/config.ini");

// Where is the directory with all photos ?
if ($config->getValue("folder", "main_folder") === "true") {
    $folder = "Photos";
} else {
    $folder = $config->getValue("folder", "directory");
}

// Getting all directories (albums) in your folder
$arrayDirectories = ServiceFile::getAllFilesInOneDirectory($folder ."/". $_POST['gallery'] ."/picto_tumbs/");

// Ok, we'r displaying all directories !

$template = new Template("templates");
$template->setFilenames(array("MENU" => "album.tpl"));

foreach ($arrayDirectories as $directory) {
    $template->assignBlockVars("PHOTOS", array("NAME" => $directory->getName(), "FILE" => $folder ."/". $_POST['gallery'] ."/picto_tumbs/". $directory->getName()));
}

$template->pparse("MENU");


?>
