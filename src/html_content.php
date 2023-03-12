<?php

class html_content{
    private $contents = array();
    private $level = 0;
    
    function setLevel($level){
        $this->level = $level;
    }
    
    function __construct(){
        
    }
    
    function add($content){
        $this->contents[] = $content;
    }
    
    function length(){
        return sizeof($this->contents);
    }
    
    function getHtml(){
        $html = null;
        if($this->contents){
            $flag = 0;
            foreach ($this->contents as $object){
                if($flag>0) $html .= "\n";
                $flag = 1;
                
                $object->setLevel($this->level + 1);
                $html .= $object->getHtml();
            }
        }
        return $html;
    }
}

?>