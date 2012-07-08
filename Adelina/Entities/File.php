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

class File
{
    //
    // Attributes
    //
    
    /**
     * The file name
     * @var String 
     */
    protected $name;
    
    /**
     * Absolute or relative path
     * @var String 
     */
    protected $path;
    
    /**
     * File aize (in octets)
     * @var float 
     */
    protected $size;
    
    /**
     * This file was created on...
     * @var \DateTime 
     */
    protected $createdOn;
    
    
    /**
     * Mime Type of the file
     * @var String 
     */
    protected $mimeType;
    
    
    
    
    //
    // Getters and setters
    //
    
    public function getName() {
	return $this->name;
    }

    public function setName($name) {
	$this->name = $name;
    }

    public function getPath() {
	return $this->path;
    }

    public function setPath($path) {
	$this->path = $path;
    }

    public function getSize() {
	return $this->size;
    }

    public function setSize($size) {
	$this->size = $size;
    }

    public function getCreated_on() {
	return $this->createdOn;
    }

    public function setCreated_on($created_on) {
	$this->createdOn = $created_on;
    }

    public function getMimeType() {
        return $this->mimeType;
    }

    public function setMimeType($mimeType) {
        $this->mimeType = $mimeType;
    }



}
