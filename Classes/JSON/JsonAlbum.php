<?php

namespace Classes\JSON;

/**
 * This class represent  
 */
class JsonAlbum {
    
    public $name;
    public $url;
    
    /**
     * Array with all photos in this album
     * @var JsonPhoto 
     */
    public $photos;
    
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function getPhotos() {
        return $this->photos;
    }

    public function setPhotos($photos) {
        $this->photos = $photos;
    }

    
    /**
     * Permet de convertir notre message sous forme d'objet webservice (format JSON)
     * @return String Notre objet, encodé sous forme de JSON
     */
    public function getJSONEncode() {
	return json_encode(get_object_vars($this));
    }

    
}

?>
