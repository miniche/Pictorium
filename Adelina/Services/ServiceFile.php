<?php

namespace Adelina\Services;

/*************************************************
*	    ADELINA FRAMEWORK
*	    Version 2.1 for PHP 5.3 or newer
*
* This framework was created and developed
* by Charles-Emmanuel CAMUS (www.charles-emmanuel.me)
*
* Licence : MIT
* Please read : http://www.opensource.org/licenses/mit-license.php 
* 
***************************************************/


class ServiceFile {
    
    /**
     * Getting all files in one directory
     * @param string $directory 
     * @return \Adelina\Entities\File
     */
    public static function getAllFilesInOneDirectory($directory)
    {
        // Array with all files in this directory
        $array = array();
        
        // $directory is a real directory ?
        if(is_dir($directory))
        {
            // yeah ! We can open the directory.
            if($dirObject = opendir($directory))
            {
                // Getting all files (and directories)
                while(($file = readdir($dirObject)) !== false)
                {    
                    if(is_file($directory ."/". $file))
                    {
                        $tmpFile = new \Adelina\Entities\File();
                        $tmpFile->setName($file);
                        $tmpFile->setPath($directory ."/". $file);
                        $tmpFile->setSize(filesize($directory ."/". $file));
                        $tmpFile->setCreated_on(filemtime($directory ."/". $file));
                        
                        // We want to obtain more information on this file
                        $finfo = finfo_open(FILEINFO_MIME_TYPE);
                        
                        $tmpFile->setMimeType(finfo_file($finfo, $directory ."/". $file));
                        
                        $array[count($array)] = $tmpFile;
                    }
                }
                
                // Ok, we have all directory content.
                // Closing dir
                closedir($dirObject);
                
                return $array;
            }
            else
            {
                throw new Exception("Sorry, we can't open the directory : ". $directory);
            }
        }
        else
        {
            throw new Exception('Directory '. $directory ." doesn't exist!");
        }
    }
    
    
    /**
     * Getting all pictures in one directory
     * @param type $directory
     * @return \Adelina\Entities\File
     * @throws Exception 
     */
    public static function getAllPicturesInOneDirectory($directory)
    {
        // Array with all files in this directory
        $array = array();
        
        // $directory is a real directory ?
        if(is_dir($directory))
        {
            // yeah ! We can open the directory.
            if($dirObject = opendir($directory))
            {
                // Getting all files (and directories)
                while(($file = readdir($dirObject)) !== false)
                {    
                    if(is_file($directory ."/". $file))
                    {
                        // Ok, it's a file!
                        // But, is it a picture too?
                        $finfo = finfo_open(FILEINFO_MIME_TYPE);
                        $mimeType = finfo_file($finfo, $directory ."/". $file);
                        if($mimeType === "image/jpeg" || $mimeType === "image/gif" || $mimeType === "image/png")
                        {
                            // Yes, it's a picture !
                            
                            $tmpFile = new \Adelina\Entities\Photo;
                            
                            $tmpFile->setName($file);
                            $tmpFile->setPath($directory ."/". $file);
                            $tmpFile->setSize(filesize($directory ."/". $file));
                            $tmpFile->setCreated_on(filemtime($directory ."/". $file));
                            
                            $tmpFile->setMimeType(finfo_file($finfo, $directory ."/". $file));
                            
                            
                            // Getting more informations on this picture
                            // We start with width and height
                            $imageInfos = getimagesize($directory ."/". $file);
                            $tmpFile->setWidth($imageInfos[0]);
                            $tmpFile->setHeight($imageInfos[1]);
                            
                            // We read exif informations, if they are available.
                            $exifTab = array();
                            if($exif = exif_read_data($directory ."/". $file, 'EXIF', true))
                            {
                                foreach ($exif as $key => $section)
                                {       
                                    foreach ($section as $name => $value)
                                    {
                                        $exifTab[$name] .= $value;
                                    }
                                }
                            }
                            
                            $tmpFile->setExifTab($exifTab);
                            
                            $array[count($array)] = $tmpFile;
                        }
                    }
                }
                
                // Ok, we have all directory content.
                // Closing dir
                closedir($dirObject);
                
                return $array;
            }
            else
            {
                throw new Exception("Sorry, we can't open the directory : ". $directory);
            }
        }
        else
        {
            throw new Exception('Directory '. $directory ." doesn't exist!");
        }
    }
    
    /**
     * Getting all directories in one directory (one dimension)
     * @param string $directory 
     * @return \Adelina\Entities\File
     */
    public static function getAllDirectoriesInOneDirectory($directory)
    {
        // Array with all directories in this directory
        $array = array();
        
        // $directory is a real directory ?
        if(is_dir($directory))
        {
            // yeah ! We can open the directory.
            if($dirObject = opendir($directory))
            {
                // Getting all files (and directories)
                while(($file = readdir($dirObject)) !== false)
                {
                    if(is_dir($directory ."/". $file) && ($file != ".") && ($file != ".."))
                    {
                        $array[count($array)] = $file;
                    }
                }
                
                // Ok, we have all directory content.
                // Closing dir
                closedir($dirObject);
                
                return $array;
            }
            else
            {
                throw new Exception("Sorry, we can't open the directory : ". $directory);
            }
        }
        else
        {
            throw new Exception('Directory '. $directory ." doesn't exist!");
        }
    }
    
}

?>
