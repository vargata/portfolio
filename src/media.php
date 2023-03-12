<?php

class media{
    private $id = null;
    private $media = null;
    private $min_width = null;
    private $max_width = null;
    private $min_height = null;
    private $max_height = null;
    
    function __construct($id, $media){
        $this->id = $id;
        $this->media = $media;
    }
    
    function get_Id(){
        return $this->id;
    }
    
    function set_minwidth($int){
        $this->min_width = $int;
    }
    
    function set_maxwidth($int){
        $this->max_width = $int;
    }
    
    function set_minheight($int){
        $this->min_height = $int;
    }
    
    function set_maxheight($int){
        $this->min_height = $int;
    }
    
    function get_media(){
        $media = $this->media
        .(($this->min_width) ? " and (min-width:" . $this->min_width . "px)" : "")
        .(($this->max_width) ? " and (max-width:" . $this->max_width . "px)" : "")
        .(($this->min_height) ? " and (min-height:" . $this->min_height . "px)" : "")
        .(($this->max_height) ? " and (max-height:" . $this->max_height . "px)" : "");
        return $media;
    }
}

?>