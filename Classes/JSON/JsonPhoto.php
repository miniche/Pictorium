<?php

namespace Classes\JSON;


/**
 * This class represent one photo to display.
 * It can be encoded in JSON for AJAX response.
 */
class JsonPhoto {
    
    public $status;
    public $name;
    public $url_compressed;
    public $url_full;
    public $date;
    public $gallery;
    public $height;
    public $width;
    
    public function getStatus() {
        return $this->status;
    }

    public function setStatus($statut) {
        $this->status = $statut;
    }
  
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getUrl_compressed() {
        return $this->url_compressed;
    }

    public function setUrl_compressed($url_compressed) {
        $this->url_compressed = $url_compressed;
    }

    public function getUrl_full() {
        return $this->url_full;
    }

    public function setUrl_full($url_full) {
        $this->url_full = $url_full;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getGallery() {
        return $this->gallery;
    }

    public function setGallery($gallery) {
        $this->gallery = $gallery;
    }
    
    public function getHeight() {
        return $this->height;
    }

    public function setHeight($heigth) {
        $this->height = $heigth;
    }

    public function getWidth() {
        return $this->width;
    }

    public function setWidth($width) {
        $this->width = $width;
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
