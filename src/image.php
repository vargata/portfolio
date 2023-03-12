<?php

require_once 'global_attr.php';

class image extends global_attr{
    private $url = null;
    private $alt = null;
    private $level = 0;
    
    function setLevel($level){
        $this->level = $level;
    }
        
    function __construct($url, $alt){
        $this->setUrl($url);
        $this->setAlt($alt);
    }
    
    function setUrl($url){
        $this->url = $url;        
    }
    
    function setAlt($alt){
        $this->alt = $alt;
    }
    
    function getHtml(){
        $space = "";
        for($i = 0;  $i < $this->level; $i++)
            $space .= "\t";
        
        $image = $space . "<img src='" . $this->url . "'"
            .$this->getAttributes()
            .(($this->alt) ? " alt='" . $this->alt . "'" : "")
            ." />";
        
        return $image;
    }
}

?>