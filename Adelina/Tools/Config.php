<?php

namespace Adelina\Tools;

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

/**
 * You can manage a config file (*.ini) with this class.
 * @package Adelina Framework
 * @author Charles-Emmanuel CAMUS <che.camus@gmail.com>
 * @copyright Charles-Emmanuel CAMUS
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php )
 * @version 1.3
 * @since 2011
 */
class Config {
    
    /**
     * Array of config keys/values loaded
     * @var array 
     */
    protected $datas = array();
    
    
    /**
     * The current config file
     * @var String 
     */
    protected $filename = null;
    
    /**
     * True = the config file is the same as the $datas array. False = $datas array has been uptaded and the config file isn't saved with the new values.
     * @var bool 
     */
    protected $isSaved = true;
    
    
    
    /**
     * Load a new configuration file (*.ini)
     * @param String $filename URI of the config file to load
     */
    public function __construct($filename)
    {
	// First, we are looking if the file really exist
	if(file_exists($filename))
	{
	    // Ok, this file exist. We can parse it!
	    $this->filename = $filename;
	    
	    $this->datas = parse_ini_file($filename,true);
	}
	else
	{
	    // This file doesn't exist !
	    // Maybe the user want create a new config file ?
	    $this->datas = array();
	    $this->filename = $filename;
	}
    }
    
    /**
     * A simple destructor for purging memory
     */
    public function __destruct()
    {
	$this->datas = array();
	$this->filename = null;
    }
    
    
    //
    // Getters and setters
    //
    public function getDatas() {
	return $this->datas;
    }

    public function getFilename() {
	return $this->filename;
    }

    public function getIsSaved() {
	return $this->isSaved;
    }

    
    //
    // Functions
    //
    
    /**
     * Getting the value of one key in one section
     * @param String $section Name of the section where the key is stored
     * @param String $key The key
     * @return String The value
     * @throws Exception If the section or the key doesn't exist in this config file.
     */
    public function getValue($section,$key)
    {
	if(array_key_exists($section, $this->datas))
	{
	    // OK, the section exist, we can search the key now
	    if(array_key_exists($key, $this->datas[$section]))
	    {
		// Ok, the key has been found.
		return $this->datas[$section][$key];
	    }
	}
	
	// Sorry, the section or the key doesn't exist !
	throw new \Exception('Sorry, the section or the key doesn\'t exist in this config file!');
    }
    
    
    
    /**
     * Getting all values in one section (in an array)
     * @param String $section The name of the section
     * @return array All the values in this section 
     * @throws Exception If the section doesn't exist in this config file.
     */
    public function getSection($section)
    {
	if(array_key_exists($section, $this->datas))
	{
	    // OK, the section exist. We can return this array.
	    return $this->datas[$section];
	}
	else
	{
	    // Oh, sorry! This section doesn't exist !
	    throw new \Exception("Sorry, the section doesn't exist in this config file!");
	}
    }
    
    
    /**
     * Add a new section in this configuration
     * @param String $section Name of the new section
     */
    public function addNewSection($section)
    {
	if(!array_key_exists($section, $this->datas))
	{
	    // The section doesn't exist, we can create this!
	    $this->datas[$section] = array();
	    
	    $this->isSaved = false;
	}
    }
    
    
    /**
     * Set (add or update) a value for one key in one section
     * @param String $section
     * @param String $key
     * @param String $value 
     * @return String $value
     */
    public function setValue($section,$key,$value)
    {
	// The section exist ?
	if(!array_key_exists($section, $this->datas))
	{
	    // No, we can create this!
	    $this->addNewSection($section);
	}
	
	// Ok. We are adding the config (or update this if already exist !)
	$this->datas[$section][$key] = $value;
	
	// Ok, done !
	$this->isSaved = false;
	
	return $value;
    }
    
    
    /**
     * Save this configuration in a file.
     * @param String $filename The file where the config must be written. If null, this object will use the filename in the constructor.
     * @return boolean True if the file is saved, False if isn't saved.
     */
    public function saveConfigFile($filename = null)
    {
	if($filename === null)
	{
	    // Ok, we use the same file
	    $filename = $this->filename;
	}
	
	// Go go go ! We want to write this file !
	if(is_writable($filename))
	{
	    $file_object = fopen($filename, "w");
	    
	    // Writing top..
	    $date = new \DateTime();
	    
	    fwrite($file_object, "; This config file was written by Adelina Framework\n");
	    fwrite($file_object, "; Date : ". $date->format("j/m/y") ."\n\n");
	    
	    // Writing all section
	    foreach ($this->datas as $section => $keyArray) {
		
		fwrite($file_object, "[". $section ."]\n");
		
		// Writing all keys and values
		foreach ($keyArray as $key => $value) {
		    fwrite($file_object, $key ." = ". $value ."\n");
		}
		
		// We can generate the next section
		fwrite($file_object, "\n");
		
	    }
	    
	    // We close the file
	    fclose($file_object);
	    
	    $this->isSaved = true;
	    
	    
	    return true;
	}
	else
	{
	    // Sorry, I can't write in this file :-(
	    return false;
	}
    }
    
}

