<?php

require_once 'global_attr.php';

class textarea extends global_attr{
    private $level = 0;
    private $parent = null;
    public $value = null;
    public $readonly = false;
    public $required = false;
    private $disabled = false;
    private $minlen = null;
    private $maxlen = null;
    private $rows = null;
    private $cols = null;
    private $placeholder = null;
    private $focused = false;
    
    function setLevel($level){
        $this->level = $level;
    }
    
    function __construct(){
        
    }
    
    function disable(){
        $this->disabled = true;
    }
    
    function focus(){
        $this->focused = true;
    }
    
    function setParent($form_id){
        $this->parent = $form_id;
    }
    
    function setSize($cols, $rows){
        $this->rows = $rows;
        $this->cols = $cols;
    }
    
    function setMinMaxLen($minlen = null, $maxlen = null){
        if($minlen)
            $this->minlen = $minlen;
        if($maxlen)
            $this->maxlen = $maxlen;
    }
    
    function setPlaceholder($placeholder){
        $this->placeholder = $placeholder;
    }
    
    function getHtml(){
        $space = "";
        for($i = 0;  $i < $this->level; $i++)
            $space .= "\t";
        
        $textarea = $space . "<textarea"
            .(($this->parent) ? " form='" . $this->parent . "'" : "")
            .(($this->readonly) ? " readonly='readonly'" : "")
            .(($this->disabled) ? " disabled='disabled'" : "")
            .(($this->minlen) ? " minlength='" . $this->minlen . "'" : "")
            .(($this->maxlen) ? " maxlength='" . $this->maxlen . "'" : "")
            .(($this->rows) ? " rows='" . $this->rows . "'" : "")
            .(($this->cols) ? " cols='" . $this->cols . "'" : "")
            .(($this->required) ? " required='required'" : "")
            .(($this->focused) ? " autofocus='autofocus'" : "")
            .(($this->placeholder) ? " placeholder='" . $this->placeholder . "'" : "")
            
            .$this->getAttributes()
            
            .">"
            
            .(($this->value) ? $this->value : "")
            
            ."</textarea>";
        
            return $textarea;
    }
}

?>