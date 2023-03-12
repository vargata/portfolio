<?php

require_once 'global_attr.php';

class select extends global_attr{
    private $level = 0;
    private $parent = null;
    private $size = null;
    public $value = null;
    public $required = false;
    private $multiple = false;
    private $disabled = false;
    private $focused = false;
    private $options = array();
    
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
    
    function setSize($size){
        $this->size = $size;
    }
    
    function enableMultiple(){
        $this->multiple = true;
    }
    
    function addElement($element){
        array_push($this->options, $element);
    }
    
    function getOptions(){        
        $options = "";        
        foreach ($this->options as $option){
            $option->setLevel($this->level);
            $options .= $option->getHtml();
        }
        
        return $options;
    }
    
    function getHtml(){        
        $space = "";
        for($i = 0;  $i < $this->level; $i++)
            $space .= "\t";
        
        $select = $space . "<select"
            .(($this->parent) ? " form='" . $this->parent . "'" : "")
            .(($this->disabled) ? " disabled='disabled'" : "")
            .(($this->required) ? " required='required'" : "")
            .(($this->focused) ? " autofocus='autofocus'" : "")
            .(($this->multiple) ? " multiple='multiple'" : "")
            .(($this->size) ? " size='" . $this->size . "'" : "")
            
            .$this->getAttributes()
            
            .">\n"
                
            .$this->getOptions()
            
            .$space . "</select>";
        
        return $select;
    }
}

//--------------------------------------------------------------------------------------------------------------------------------

class option extends global_attr{
    private $level = 0;
    public $value = null;
    public $text = null;
    private $disabled = false;
    private $selected = false;
    
    function setLevel($level){
        $this->level = $level;
    }
    
    function __construct($value, $text){
        $this->value = $value;
        $this->text = $text;
    }
    
    function disable(){
        $this->disabled = true;
    }
    
    function select(){
        $this->selected = true;
    }
    
    function getHtml(){        
        $space = "";
        for($i = 0;  $i < $this->level; $i++)
            $space .= "\t";
        
        $option = $space . "\t<option value='" . $this->value . "'"
            .(($this->disabled) ? " disabled='disabled'" : "")
            .(($this->selected) ? " selected='selected'" : "")
            .">" . $this->text . "</option>\n";
        
        return  $option;
    }
}

?>