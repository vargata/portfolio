<?php

require_once 'global_attr.php';
require_once 'html_content.php';

class div extends global_attr{
    private $content = null;
    private $level = 0;
    
    function setLevel($level){
        $this->level = $level;
    }
    
    function __construct(){
        $this->content = new html_content();
    }
    
    function addContent($content){
        $this->content->add($content);
    }
    
    function getHtml(){
        if($this->content)
            $this->content->setLevel($this->level);
        
        $space = "";
        for($i = 0;  $i < $this->level; $i++)
            $space .= "\t";
        
        $div = $space . "<div"
            .$this->getAttributes()
            .">\n"
                
            .(($this->content->length() > 0) ? $this->content->getHtml() . "\n" : "")
            
            .$space . "</div>";
        
        return $div;
    }
}

?>