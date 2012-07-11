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

require_once 'lib/imagine.phar';

// This script require more memory to resize photos and generate tumbnails.
ini_set('memory_limit','256M');
        
        

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
    
    
    
    
    // We are getting all files in this directory
    $arrayFiles = ServiceFile::getAllFilesInOneDirectory($folder ."/". $directory);
    
    foreach($arrayFiles as $file)
    {
        // It's a photo/picture ?
        if($file->getMimeType() == "image/jpeg" || $file->getMimeType() == "image/gif" || $file->getMimeType() == "image/png")
        {
            // Ok, a (nice) photo / picture!
            // We can open it to resize
            $imagine = new Imagine\Gd\Imagine();
            
            // Is there a tumbnail?
            if(!is_file($folder ."/". $directory ."/picto_tumbs/". $file->getName()))
            {
                // No, we create it now!
                // We want a squarred thumbnail.
                // First, we are resizing the picture (as "small image", see the next pass)
                $image = $imagine->open($folder ."/". $directory ."/". $file->getName());
                
                // The image is it higher or wider?
                // We want a larger image than 100px for croping it after.
                if($image->getSize()->getHeight() > $image->getSize()->getWidth())
                {
                    $newWidth = 100;
                    $newHeight = 100 * $image->getSize()->getHeight() / $image->getSize()->getWidth();
                }
                elseif($image->getSize()->getHeight() < $image->getSize()->getWidth())
                {
                    $newWidth =  100 * $image->getSize()->getWidth() / $image->getSize()->getHeight();
                    $newHeight = 100;
                }
                else
                {
                    // Same height and width
                    $newHeight = 100;
                    $newWidth = 100;
                }
                
                // And now, we are cropping the picture!
                // We only want the middle.
                $image->resize(new Imagine\Image\Box($newWidth, $newHeight));
                
                
                // Only if is not a squared picture!
                if($newHeight < $newWidth)
                {
                    $point = new Imagine\Image\Point(round(($image->getSize()->getWidth() - 100) / 2),0);
                }
                elseif($newHeight > $newWidth)
                {
                    $point = new Imagine\Image\Point(0,round(($image->getSize()->getHeight() - 100) / 2));
                }
                
                // Only if is not a squared picture!
                if($newHeight != $newWidth)
                {
                    $image->crop($point,new Imagine\Image\Box(100,100));
                }
                
                
                // And save our beautiful thumbnail!
                $image->thumbnail(new Imagine\Image\Box(100, 100))
                        ->save($folder ."/". $directory ."/picto_tumbs/". $file->getName(),array('quality' => 50));
                
                $nbNewTumbs++;
            }
            
            // Is there a small image for this photo ?
            if(!is_file($folder ."/". $directory ."/picto_small/". $file->getName()))
            {
                // No, we create it now !
                $image = $imagine->open($folder ."/". $directory ."/". $file->getName());
                
                // The image is it higher or wider?
                if($image->getSize()->getHeight() < $image->getSize()->getWidth())
                {
                    $newWidth = 1024;
                    $newHeight = 1024 * $image->getSize()->getHeight() / $image->getSize()->getWidth();
                }
                elseif($image->getSize()->getHeight() > $image->getSize()->getWidth())
                {
                    $newWidth =  1024 * $image->getSize()->getWidth() / $image->getSize()->getHeight();
                    $newHeight = 1024;
                }
                else
                {
                    // Same height and width
                    $newHeight = 1024;
                    $newWidth = 1024;
                }
                
                $image->resize(new Imagine\Image\Box($newWidth,$newHeight))
                        ->save($folder ."/". $directory ."/picto_small/". $file->getName(),array('quality' => 50));
                
                $nbNewSmall++;
            }
        }
    }
    
    
    // Next directory, please!
    
}


// Ok, we write some statistics
$nbNewDir = $nbTumbDir+$nbSmallDir;
$configCron->setValue("last_cron","date",  time());
$configCron->setValue("last_cron", "new_directories", $nbNewDir);
$configCron->setValue("last_cron", "new_tumbs", $nbNewTumbs);
$configCron->setValue("last_cron", "new_small", $nbNewSmall);
$configCron->saveConfigFile();

echo "CRON at ". time() ." - New folders : ". $nbNewDir ." - New Tumbnails : ". $nbNewTumbs ." - New small images : ". $nbNewSmall;


?>
