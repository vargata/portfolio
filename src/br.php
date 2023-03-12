<?php

class br{
    private $level = 0;
    
    function setLevel($level){
        $this->level = $level;
    }
    
    function __construct(){
        
    }
    
    function getHtml(){
        $space = "";
        for($i = 0;  $i < $this->level; $i++)
            $space .= "\t";
        
        $br = $space . "<br/>";
        
        return $br;
    }
}

?>