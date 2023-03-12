<?php

class text{
    private $id = null;
    private $text = null;
    private $formatted = false;
    private $classes = array();
    private $level = 0;
    
    function setLevel($level){
        $this->level = $level;
    }
    
    function __construct($text){
        $this->setText($text);
    }
    
    function setId($id){
        $this->id = $id;
    }
    
    function getId(){
        return $this->id;
    }
    
    function addClass($class){
        array_push($this->classes, $class);
    }
    
    function preformat($formatted = true){
        $this->formatted = true;
    }
    
    function setText($text){
        $this->text = $text;
    }
    
    function getFromURL($url){
        $this->text = file_get_contents($url);
    }
    
    function getClasses(){
        $classes = "";
        $flag = 0;
        foreach ($this->classes as $class){
            if($flag > 0) $classes .=" ";
            $flag = 1;
            $classes .= $class;
        }
        
        return $classes;
    }
    
    function getHtml(){
        $space = "";
        for($i = 0;  $i < $this->level; $i++)
            $space .= "\t";
        
        $text = ""
            .(($this->formatted) ? $space . "<pre" . (($this->classes) ? " class='" . $this->getClasses() . "'" : "") . ">\n" : "")
            .(($this->formatted) ? "" : $space) . $this->text
            .(($this->formatted) ? "\n" . $space . "</pre>" : "");
        
        return $text;
    }
}

?>