<?php

/* * ****
 * 
 * TODO : Top of each php file
 * 
 */
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
$arrayDirectories = ServiceFile::getAllDirectoriesInOneDirectory($folder);

// Ok, we'r displaying all directories !

$template = new Template("templates");
$template->setFilenames(array("MENU" => "menu.tpl"));
foreach ($arrayDirectories as $directory) {
    $template->assignBlockVars("DIR", array("NAME" => $directory));
}

$template->pparse("MENU");


?>
