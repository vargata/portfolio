<?php

require_once 'global_attr.php';

class meta extends global_attr{
    private $level = 0;
    private $charset = null;
    private $http_equiv = null;
    private $contents = array();
    
    function setLevel($level){
        $this->level = $level;
    }
    
    function __construct(){
        
    }
    
    function setCharset($charset){
        $this->charset = $charset;
    }
    
    function setHttp_equiv($equiv){
        $this->http_equiv = $equiv;
    }
    
    function addContent($content){
        if(gettype($content) == "array")            
            array_push($this->contents, ...$content);
        else
            array_push($this->contents, $content);
    }
    
    function getContents(){
        $cont = " content='";
        
        $flag = 0;
        foreach ($this->contents as $content){
            if($flag > 0) $cont .= ", ";
            $flag = 1;
            $cont .= $content;
        }
        
        $cont .= "'";
        
        return $cont;
    }
    
    function getHtml(){
        $space = "";
        for($i = 0;  $i < $this->level; $i++)
            $space .= "\t";
        
        $meta = $space . "<meta"            
            .(($this->charset) ? " charset='" . $this->charset . "'" : "")
            .(($this->http_equiv) ? " http_equiv='" . $this->http_equiv . "'" : "")            
            .(($this->contents) ? $this->getContents() : "")
            
            .$this->getAttributes()
            
            ."/>\n";
        
        return $meta;
    }
}

?>