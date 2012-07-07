<?php

/* * ****
 * 
 * TODO : Top of each php file
 * 
 */
spl_autoload_register();

use Adelina\Tools\Template;
use Adelina\Services\ServiceFile;
use Adelina\Tools\Config;

// Cron : Auto-resize all photos !
$config = new Config("config/config.ini");
$configCron = new Config("config/cron.ini");

// Where is the directory with all photos ?
if ($config->getValue("folder", "main_folder") === "true") {
    $folder = "Photos";
} else {
    $folder = $config->getValue("folder", "directory");
}


// Var for statistics
$nbTumbDir = 0;
$nbSmallDir = 0;
$nbNewTumbs = 0;
$nbNewSmall = 0;

// Getting all directories (albums) in your folder
$arrayDirectories = ServiceFile::getAllDirectoriesInOneDirectory($folder);

foreach ($arrayDirectories as $directory) {
    
    // We are looking for all sub directories (tumb, etc...)
    if(!file_exists($folder ."/". $directory ."/picto_tumbs") && !is_dir($folder ."/". $directory ."/picto_tumbs"))
    {
        // Ok, we're creating the folder for thumbnails
        mkdir($folder ."/". $directory ."/picto_tumbs");
        $nbTumbDir++;
    }
    
    if(!file_exists($folder ."/". $directory ."/picto_small") && !is_dir($folder ."/". $directory ."/picto_small"))
    {
        // Ok, we're creating the folder for compressed photos
        mkdir($folder ."/". $directory ."/picto_small");
        $nbTumbDir++;
    }
    
    
    // TODO : Scan directory and compress photos with Imagine Library
    
    
}

// Ok, we write some statistics
$configCron->setValue("last_cron","date",  time());
$configCron->setValue("last_cron", "new_directories", $nbTumbDir+$nbSmallDir);
$configCron->setValue("last_cron", "new_tumbs", $nbNewTumbs);
$configCron->setValue("last_cron", "new_small", $nbNewSmall);


?>
