<?php

require_once 'media.php';
require_once 'html_content.php';

class page{
    public $lang = "en";
    public $xmlns = "http://www.w3.org/1999/xhtml";
    private $head = null;
    public $body = null;
    
    function __construct($page_title){
        $this->head = new head($page_title);
        $this->body = new body();
    }
    
    function setBase($base){
        $this->head->base = $base;
    }
    
    function setBasetarget($target){
        $this->head->target = $target;
    }
    
    function addStylesheet($url, $media = null){
        $link = new link("stylesheet", $url, $media);
        $this->head->links[] = $link;
    }
    
    function addScript($type, $url){        
        $script = new script($url);
        if($type == script_type::HEADLINK)
            $this->head->scripts[] = $script;
        if($type == script_type::BODYLINK)
            $this->body->scripts[] = $script;            
        if($type == script_type::RUNCMD)
            $this->body->commands[] = $script;
    }
    
    function addContent($content){
        $this->body->addContent($content);
    }
    
    function setIcon($url){
        $link = new link("icon", $url);
        $this->head->links[] = $link;
    }
    
    function changeTitle($new_title){
        $this->head->title->text = $new_title;
    }
    
    function Show(){
        echo "<!DOCTYPE html>";
        echo "\n<html xmlns='" . $this->xmlns . "' lang='" . $this->lang . "'>";
        if($this->head)
            echo $this->head->getHead();
        if($this->body)
            echo $this->body->getBody();
        echo "\n</html>";
    }
}

//-------------------------------------------------------------------------------------------------------------------------------------------------------

class head{
    public $title = null;
    public $base = null;
    public $target = null;
    public $links = array();
    public $scripts = array();
    private $level = 0;
    
    function __construct($title_text){
        $this->title = new title($title_text);
    }

    function getHead(){
        $space = "";
        for($i = 0;  $i < $this->level; $i++)
            $space .= "\t";
        
        $head = "\n" . $space . "<head>"
        .$this->title->getTitle()
        .(($this->base || $this->target) ? "<base" : "")
        .(($this->base) ? " href='" . $this->base . "'" : "")
        .(($this->target) ? " target='" . $this->target . "'" : "")
        .(($this->base || $this->target) ? ">\n" : "");
        
        foreach($this->links as $link) $head .= $link->getLink();
        foreach($this->scripts as $script) $head .= $script->getScript();
        
        $head .= "\n" . $space . "</head>";
        
        return $head;
    }
}

//-------------------------------------------------------------------------------------------------------------------------------------------------------

class body{
    private $content = null;
    public $scripts = array();
    public $commands = array();
    private $level = 0;
    
    function __construct(){
        $this->content = new html_content();
    }
    
    function addContent($content){
        $this->content->add($content);
    }
    
    function getBody(){        
        $space = "";
        for($i = 0;  $i < $this->level; $i++)
            $space .= "\t";
            
        $body = "\n" . $space . "<body>\n"
        
        .(($this->content->length() > 0) ? $this->content->getHtml() . "\n" : "");
        
        foreach($this->scripts as $script) $body .= $script->getScript();
        foreach($this->commands as $script) $body .= $script->runScript();
        
        $body .= "\n" . $space . "</body>";
        
        return $body;
    }
}

//-------------------------------------------------------------------------------------------------------------------------------------------------------

class title{
    public $text = null;
    private $level = 1;
    
    function __construct($title_text){
        if($title_text)
            $this->text = $title_text;
        else
            $this->text = "";
    }

    function getTitle(){
        $space = "";
        for($i = 0;  $i < $this->level; $i++)
            $space .= "\t";
            
        if($this->text != "")
            $title = "\n" . $space . "<title>" . $this->text . "</title>";
        
        return $title;
    }
}

//-------------------------------------------------------------------------------------------------------------------------------------------------------

class link{
    private $id = null;
    private $rel = null;
    private $href = null;
    private $media = null;
    private $level = 1;
    
    function __construct($rel, $href, $media = null){
        $this->rel = $rel;
        $this->href = $href;
        $this->media = $media;
    }
    
    function setId($id){
        $this->id = $id;
    }
    
    function setMedia($media){
        $this->media = $media;
    }
    
    function getLink(){
        $space = "";
        for($i = 0;  $i < $this->level; $i++)
            $space .= "\t";
            
        $link = "\n" . $space . "<link rel='" . $this->rel
            ."' href='" . $this->href . "'"
            .(($this->rel == "icon") ? " type='image/gif'" : "")
            .(($this->media) ? " media='" . $this->media->get_media() . "'" : "")
            ."/>";
        
        return $link;
    }
}

//-------------------------------------------------------------------------------------------------------------------------------------------------------

class script{
    private $id = null;
    private $src = null;
    private $level = 1;
    
    function __construct($src){
        $this->src = $src;
    }
    
    function setId($id){        
        $this->id = $id;
    }
    
    function runScript(){
        $space = "";
        for($i = 0;  $i < $this->level; $i++)
            $space .= "\t";
            
        $script = "\n" . $space . "<script type='text/javascript'>" . $this->src ."</script>";
        
        return $script;
    }
    
    function getScript(){
        $space = "";
        for($i = 0;  $i < $this->level; $i++)
            $space .= "\t";
            
        $script = "\n" . $space . "<script type='text/javascript' src='" . $this->src ."'></script>";
            
        return $script;
    }
}

?>