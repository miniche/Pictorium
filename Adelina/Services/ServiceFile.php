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
                    if(is_file($file))
                    {
                        $tmpFile = new \Adelina\Entities\File();
                        $tmpFile->setName($file);
                        $tmpFile->setPath($directory . $file);
                        $tmpFile->setSize(filesize($file));
                        $tmpFile->setCreated_on(filemtime($file));
                        
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
