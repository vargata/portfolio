<?php

require_once 'global_attr.php';

class input extends global_attr{
    private $level = 0;
    private $parent = null;
    private $alt = null;
    private $src = null;
    private $width = null;
    private $height = null;
    public $value = null;
    public $readonly = false;
    public $required = false;
    private $type = null;
    private $disabled = false;
    private $size = null;
    private $minlen = null;
    private $maxlen = null;
    private $min = null;
    private $max = null;
    private $multiple = false;
    private $pattern = null;
    private $placeholder = null;
    private $step = null;
    private $focused = false;
    private $checked = false;
    private $fileformats = array();
    public $autocomplete = null;
    public $output = null;
    private $datalist = null;
    
    function setLevel($level){
        $this->level = $level;
    }
    
    function __construct($type){
        $this->type = $type;
    }
    
    function disable(){
        $this->disabled = true;
    }
    
    function focus(){
        $this->focused = true;
    }
    
    function check(){
        $this->checked = true;
    }
    
    function addElement($element){
        if(!$this->datalist){
            $this->datalist = new datalist($this->getId() . "_list");
        }
        
        $this->datalist->addElement($element);
    }
    
    function setLength($size){
        $this->size = $size;
    }
    
    function setParent($form_id){
        $this->parent = $form_id;
    }
    
    function setImgSize($width, $height){
        $this->width = $width;
        $this->width = $height;
    }
    
    function setStep($step){
        $this->step = $step;
    }
    
    function setAlt($alt){
        $this->alt = $alt;
    }
    
    function setSource($url){
        $this->src = $url;
    }
    
    function setMinMax($min = null, $max = null){
        if($min)
            $this->min = $min;
        if($max)
            $this->max = $max;
    }
    
    function setMinMaxLen($minlen = null, $maxlen = null){
        if($minlen)
            $this->minlen = $minlen;
        if($maxlen)
            $this->maxlen = $maxlen;
    }
    
    function enableMultiple(){
        $this->multiple = true;
    }
    
    function setPattern($pattern){
        $this->pattern = $pattern;
    }
    
    function setPlaceholder($placeholder){
        $this->placeholder = $placeholder;
    }
    
    function showValue(){
        $this->output = new output($this->getId() . "_output", $this->value);
        if($this->isHidden())
            $this->output->Hide();
    }
    
    function addFileformat($format){
        if(gettype($format) == "array")
            array_push($this->fileformats, ...$format);
        else
            array_push($this->fileformats, $format);
    }
    
    function hide(){
        parent::hide();
        if($this->output)
            $this->output->hide();
    }
    
    function getFormats(){
        $formats = "";
        
        $flag = 0;
        foreach ($this->fileformats as $format){
            if($flag>0) $formats .= ", ";
            $flag = 1;
            $formats .= $format; 
        }
        
        return $formats;
    }
    
    function getHtml(){        
        if($this->output)
            $this->output->setLevel($this->level);
        if($this->datalist)
            $this->datalist->setLevel($this->level);
        
        $space = "";
        for($i = 0;  $i < $this->level; $i++)
            $space .= "\t";
        
        $input = $space . "<input"
            .(($this->type) ? " type='" . $this->type . "'" : "")
            .(($this->alt) ? " alt='" . $this->alt . "'" : "")
            .(($this->src) ? " src='" . $this->src . "'" : "")
            .(($this->value) ? " value='" . $this->value . "'" : "")
            .(($this->parent) ? " form='" . $this->parent . "'" : "")
            .(($this->readonly) ? " readonly='readonly'" : "")
            .(($this->disabled) ? " disabled='disabled'" : "")
            .(($this->checked) ? " checked='checked'" : "")
            .(($this->size) ? " size='" . $this->size . "'" : "")
            .(($this->width) ? " width='" . $this->width . "'" : "")
            .(($this->height) ? " height='" . $this->height . "'" : "")
            .(($this->minlen) ? " minlength='" . $this->minlen . "'" : "")
            .(($this->maxlen) ? " maxlength='" . $this->maxlen . "'" : "")
            .(($this->min) ? " min='" . $this->min . "'" : "")
            .(($this->max) ? " max='" . $this->max . "'" : "")
            .(($this->step) ? " step='" . $this->step . "'" : "")
            .(($this->datalist) ? " list='" . $this->getId() . "_list'" : "")
            .(($this->multiple) ? " multiple='multiple'" : "")
            .(($this->required) ? " required='required'" : "")
            .(($this->focused) ? " autofocus='autofocus'" : "")
            .((isset($this->autocomplete)) ? (($this->autocomplete) ? " autocomplete='on'" : " autocomplete='off'") : "")
            .(($this->pattern) ? " pattern='" . $this->pattern . "'" : "")
            .(($this->placeholder) ? " placeholder='" . $this->placeholder . "'" : "")
            .(($this->output) ? " oninput='" . $this->getId() . "_output.value=value'" : "")
            
            .$this->getAttributes()
            
            .(($this->fileformats) ? " accept='" . $this->getFormats() ."'" : "")
            
            ."/>"
        
            .(($this->output) ? "\n" . $this->output->getHtml() : "")
        
            .(($this->datalist) ? "\n" . $this->datalist->getHtml() : "");
        
        return $input;
    }
}

//--------------------------------------------------------------------------------------------------------------------------------

class output extends global_attr{
    private $level = 0;
    private $input = null;
    private $parent = null;
    public $value = null;
    
    function setLevel($level){
        $this->level = $level;
    }
    
    function __construct($value){
        $this->value = $value;
    }
    
    function setInput($input_id){
        $this->input = $input_id;
    }
    
    function setparent($form_id){
        $this->parent = $form_id;
    }
    
    function getHtml(){
        $space = "";
        for($i = 0;  $i < $this->level; $i++)
            $space .= "\t";

            $output = $space . "<output"
                .(($this->parent) ? " form='" . $this->parent . "'" : "")
                .(($this->input) ? " for='" . $this->input . "'" : "")
                
                .$this->getAttributes()
                
                .">" . $this->value . "</output>";
        
        return $output;
    }
}

//--------------------------------------------------------------------------------------------------------------------------------

class datalist extends global_attr{
    
    private $level = 0;
    private $list = array();
    
    function setLevel($level){
        $this->level = $level;
    }
    
    function __construct(){
        
    }
    
    function addElement($element){
        if(gettype($element) == "array")
            array_push($this->list, ...$element);
        else
            array_push($this->list, $element);
    }
    
    function getHtml(){
        $space = "";
        for($i = 0;  $i < $this->level; $i++)
            $space .= "\t";
            
        $datalist =  $space . "<datalist>\n";
        foreach ($this->list as $data){
            $datalist .= $space . "\t<option value='" . $data . "'/>\n";
        }
        $datalist .= $space . "</datalist>";
        
        return $datalist;
    }
}

?>