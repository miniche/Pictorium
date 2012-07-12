<?php

namespace Adelina\Entities;

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

class Photo extends File {
    
    //
    // Attributes
    //
    
    /**
     * Width of the picture
     * @var float 
     */
    protected $width;
    
    
    /**
     * Height of the picture
     * @var float 
     */
    protected $height;


    /**
     * All exif attributes of the photo (only if it's a .jpg or a .tiff)
     * @var array 
     */
    protected $exifTab;
    
    
    
    //
    // Getters and setters
    //
    
    public function getWidth() {
        return $this->width;
    }

    public function setWidth($width) {
        $this->width = $width;
    }

    public function getHeight() {
        return $this->height;
    }

    public function setHeight($height) {
        $this->height = $height;
    }
    
    public function getExifTab() {
        return $this->exifTab;
    }

    public function setExifTab($exifTab) {
        $this->exifTab = $exifTab;
    }


    
}

?>
