<?php

require_once 'global_attr.php';
require_once 'html_content.php';

class heading extends global_attr{
    private $content = null;
    private $headingLevel = null;
    private $level = 0;
    
    function setLevel($level){
        $this->level = $level;
    }
    
    function __construct($headingLevel){
        $this->setHeadingLevel($headingLevel);
        $this->content = new html_content();
    }
    
    function addContent($content){
        $this->content->add($content);
    }
    
    function setHeadingLevel($headingLevel){
        $this->headingLevel = $headingLevel;
    }
    
    function getHtml(){
        if($this->content)
            $this->content->setLevel($this->level);
        
        $space = "";
        for($i = 0;  $i < $this->level; $i++)
            $space .= "\t";
        
        $head = $space . "<h" . $this->headingLevel
            .$this->getAttributes()
            .">\n"
                
            .(($this->content->length() > 0) ? $this->content->getHtml() . "\n" : "")
            
            . $space . "</h" . $this->headingLevel . ">";
        
        return $head;
    }
}

?>