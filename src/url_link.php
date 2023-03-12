<?php

require_once 'global_attr.php';
require_once 'html_content.php';

class url_link extends global_attr{
    private $url = null;
    private $target = null;
    private $rel = null;
    private $type = null;
    private $content = null;
    private $level = 0;
    
    function setLevel($level){
        $this->level = $level;
    }
    
    function __construct($url){
        $this->setUrl($url);
        $this->content = new html_content();
    }
    
    function setUrl($url){
        $this->url = $url;
    }
    
    function setTarget($target){
        $this->target = $target;
    }
    
    function setRelation($rel){
        $this->rel = $rel;
    }
    
    function setType($type){
        $this->type = $type;
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
        
        $url_link = $space . "<a"
            ." href=\"" . $this->url . "\""
            .(($this->target) ? " target='" . $this->target . "'" : "")
            .(($this->type) ? " type='" . $this->type . "'" : "")
            .(($this->rel) ? " rel='" . $this->rel . "'" : "")
            .$this->getAttributes()
            .">\n"
            
            .(($this->content->length() > 0) ? $this->content->getHtml() . "\n" : "")
            
            .$space . "</a>";
        
        return $url_link;
    }    
}

?>