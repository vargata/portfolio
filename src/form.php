<?php

require_once 'global_attr.php';
require_once 'html_content.php';

class form extends global_attr{
    private $content = null;
    private $level = 0;
    private $url = null;
    private $rel = null;
    private $method = null;
    private $target = null;
    private $charsets = array();
    private $enctype = null;
    public $autocomplete = true;
    public $novalidate = false;
    
    function setLevel($level){
        $this->level = $level;
    }
    
    function __construct($url = null, $method = null){
        $this->content = new html_content();
        
        if($url)
            $this->url = $url;
        
        if($method)
            $this->method = $method;
    }
    
    function setAction($url){
        $this->url = $url;
    }
    
    function setMethod($method){
        $this->method = $method;
    }
    
    function setTarget($target){
        $this->target = $target;
    }
    
    function setEncType($enctype){
        $this->enctype = $enctype;
    }
    
    function setRelation($rel){
        $this->rel = $rel;
    }
    
    function addCharset($charset){
        array_push($this->charsets, $charset);
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
        
        $form = $space . "<form"
            .(($this->url) ? " action='./" . $this->url . "'": "")
            .(($this->method) ? " method='" . $this->method . "'": "")
            .(($this->enctype) ? " enctype='" . $this->enctype . "'": "")
            .(($this->target) ? " target='" . $this->target . "'": "")            
            .(($this->rel) ? " rel='" . $this->rel . "'": "")
            .(($this->novalidate) ? " novalidate='novalidate'": "")
            .((isset($this->autocomplete)) ? (($this->autocomplete) ? " autocomplete='on'" : " autocomplete='off'") : "")
            
            .$this->getAttributes();
        
            if($this->charsets){
                $form .= " accept-charset='";
                $flag = 0;
                foreach ($this->charsets as $charset){
                    if($flag > 0) $form .= " ";
                    $form .=  $charset;                    
                    $flag = 1;
                }
                $form .= "'";
            }
            
            $form .=">\n"
                
            .(($this->content->length() > 0) ? $this->content->getHtml() . "\n" : "")
            
            .$space . "</form>";
        
        return $form;
    }
}

?>