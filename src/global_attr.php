<?php

require_once 'global_event.php';

class global_attr extends global_event{
    private $id = null;
    private $title = null;
    private $classes = array();
    private $hidden = null;
    private $tabindex = null;
    private $accesskey = null;
    private $draggable = null;
    private $contenteditable = null;
    private $lang = null;
    private $translate = null;
    private $spellcheck = null;
    private $dir = null;
    
    private $name = null;
    
    function setId($id){
        $this->id = $id;
    }
    
    function getId(){
        return $this->id;
    }
    
    function setTitle($title){
        $this->title = $title;
    }
    
    function hide(){
        $this->hidden = true;
    }
    
    function isHidden(){
        return $this->hidden;
    }
    
    function setTabindex($tabindex){
        $this->tabindex = $tabindex;
    }
    
    function setName($name){
        $this->name = $name;
    }
    
    function setAccesskey($accesskey){
        $this->accesskey = $accesskey;
    }
    
    function setDraggable(){
        $this->draggable = true;
    }
    
    function setEditable($editable = true){
        $this->contenteditable = $editable;
    }
    
    function setLanguage($language){
        $this->lang = $language;
    }
    
    function toTranslate($translate = "yes"){
        $this->translate  = $$translate;
    }
    
    function toSpellcheck($spellcheck = true){
        $this->spellcheck = $spellcheck;
    }
    
    function addClass($class){
        array_push($this->classes, $class);
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
    
    function getAttributes(){
        $attributes = 
        (($this->id) ? " id='" . $this->id . "'" : "")
        .(($this->title) ? " title='" . $this->title . "'" : "")
        .(($this->hidden) ? " hidden='hidden'" : "")
        .(($this->tabindex) ? " tabindex='" . $this->tabindex . "'" : "")
        .(($this->name) ? " name='" . $this->name . "'" : "")
        .(($this->accesskey) ? " accesskey='" . $this->accesskey . "'" : "")
        .(($this->draggable) ? " draggable='" . $this->draggable . "'" : "")
        .(($this->contenteditable) ? " contenteditable='" . $this->contenteditable . "'" : "")
        .(($this->lang) ? " lang='" . $this->lang . "'" : "")
        .(($this->translate) ? " translate='" . $this->translate . "'" : "")
        .(($this->spellcheck) ? " spellcheck='" . $this->spellcheck . "'" : "")
        .(($this->dir) ? "dir='" . $this->dir . "'" : "");
        
        if($this->classes){
            $attributes .= " class='";
            $flag = 0;
            foreach($this->classes as $class){
                if($flag>0) $attributes .= " ";
                $flag = 1;
                $attributes .= $class;
            }
            $attributes .= "'";
        }
        
        $attributes .= $this->getEvents();
        
        return $attributes;
    }
}

//--------------------------------------------------------------------------------------------------------------------------------

class link_target{
    public const NEWPAGE = "_blank";
    public const SAMEPAGE = "_self";
    public const PARENTPAGE = "_parent";
    public const TOP = "_top";
}

//--------------------------------------------------------------------------------------------------------------------------------

class charset{
    public const UTF8 = "UTF-8";
    public const UTF16 = "UTF-16";
    public const WIN1252 = "Windows-1252";
    public const ISO8859 ="ISO-8859";
}

//--------------------------------------------------------------------------------------------------------------------------------

class form_method{
    public const GET = "get";
    public const POST = "post";
}

//--------------------------------------------------------------------------------------------------------------------------------

class form_rel{
    public const EXT = "external";
    public const HELP = "help";
    public const LICENSE = "license";
    public const NEXT = "next";
    public const NOFOLLOW = "nofollow";
    public const NOOPENER = "noopener";
    public const NOREF = "noreferrer";
    public const PREV = "prev";
    public const SEARCH = "search";
}

//--------------------------------------------------------------------------------------------------------------------------------

class form_enctype{
    public const URL = "application/x-www-form-urlencoded";
    public const FILE = "multipart/form-data";
    public const TEXT = "text/plain";
}

//--------------------------------------------------------------------------------------------------------------------------------

class form_input_type{
    public const BTN = "button";
    public const CHKBOX = "checkbox";
    public const COLORPICKER = "color";
    public const DATE = "date";
    public const LCLDATE = "datetime-local";
    public const EMAIL = "email";
    public const FILE = "file";
    public const HIDDEN = "hidden";
    public const IMG = "image";
    public const MONTH = "month";
    public const NUM = "number";
    public const PWD = "password";
    public const RADIOBTN = "radio";
    public const RANGE = "range";
    public const RESET = "reset";
    public const SEARCH = "search";
    public const SUBMIT = "submit";
    public const TEL = "tel";
    public const TEXT = "text";
    public const TIME = "time";
    public const URL = "url";
    public const WEEK = "week";
}

//--------------------------------------------------------------------------------------------------------------------------------

class form_file_format{
    public const ANY = ".*";
    public const AUDIO = "audio/*";
    public const VIDEO = "video/*";
    public const IMAGE = "image/*";
    public const PDF = ".pdf, application/pdf";
    public const MSDOC = ".doc, .docx, application/msword";
    public const XML = ".xml, text/xml, application/xml";
    public const HTML = ".htm, .html, text/html";
    public const SQL = ".sql";
    public const ZIP = ".zip, application/zip";
    public const JSON = ".json, text/json, application/json";
    public const JSCRIPT = ".js, text/javascript, text/jscript";
}

//--------------------------------------------------------------------------------------------------------------------------------

class script_type{    
    public const HEADLINK = 0;
    public const BODYLINK = 1;
    public const RUNCMD = 2;
}

class textarea_wrapmode{
    public const SOFT = "soft";
    public const HARD = "hard";
}

?>