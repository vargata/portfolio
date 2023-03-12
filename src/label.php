<?php

require_once 'global_attr.php';
require_once 'html_content.php';

class label extends global_attr{
    private $content = null;
    private $level = 0;
    private $input = null;
    private $parent = null;
    
    function setLevel($level){
        $this->level = $level;
    }
    
    function __construct(){
        $this->content = new html_content();
    }
    
    function setInput($input_id){
        $this->input = $input_id;
    }
    
    function setparent($form_id){
        $this->parent = $form_id;
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
        
        $label = $space . "<label"
            .(($this->parent) ? " form='" . $this->parent . "'" : "")
            .(($this->input) ? " for='" . $this->input . "'" : "")
            .$this->getAttributes()
            .">\n"
                
            .(($this->content->length() > 0) ? $this->content->getHtml() . "\n" : "")
            
            .$space . "</label>";
        
        return $label;
    }
}

?>