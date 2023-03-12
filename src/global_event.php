<?php

class global_event{
    protected $onafterprint = null;
    protected $onbeforeprint = null;
    protected $onbeforeunload = null;
    protected $onerror = null;
    protected $onhashchange = null;
    protected $onload = null;
    protected $onmessage = null;
    protected $onoffline = null;
    protected $ononline = null;
    protected $onpagehide = null;
    protected $onpageshow = null;
    protected $onpopstate = null;
    protected $onresize = null;
    protected $onstorage = null;
    protected $onunload = null;
    protected $onblur = null;
    protected $onchange = null;
    protected $oncontextmenu = null;
    protected $onfocus = null;
    protected $oninput = null;
    protected $oninvalid = null;
    protected $onreset = null;
    protected $onsearch = null;
    protected $onselect = null;
    protected $onsubmit = null;
    protected $onkeydown = null;
    protected $onkeypress = null;
    protected $onkeyup = null;
    protected $onclick = null;
    protected $ondblclick = null;
    protected $onmousedown = null;
    protected $onmousemove = null;
    protected $onmouseout = null;
    protected $onmouseover = null;
    protected $onmouseup = null;
    protected $onmousewheel = null;
    protected $onwheel = null;
    protected $ondrag = null;
    protected $ondragend = null;
    protected $ondragenter = null;
    protected $ondragleave = null;
    protected $ondragover = null;
    protected $ondragstart = null;
    protected $ondrop = null;
    protected $onscroll = null;
    protected $oncopy = null;
    protected $oncut = null;
    protected $onpaste = null;
    protected $onabort = null;
    protected $oncanplay = null;
    protected $oncanplaythrough = null;
    protected $oncuechange = null;
    protected $ondurationchange = null;
    protected $onemptied = null;
    protected $onended = null;
    protected $onloadeddata = null;
    protected $onloadedmetadata = null;
    protected $onloadstart = null;
    protected $onpause = null;
    protected $onplay = null;
    protected $onplaying = null;
    protected $onprogress = null;
    protected $onratechange = null;
    protected $onseeked = null;
    protected $onseeking = null;
    protected $onstalled = null;
    protected $onsuspend = null;
    protected $ontimeupdate = null;
    protected $onvolumechange = null;
    protected $onwaiting = null;
    protected $ontoggle = null;
    
    function addEvent($event, $script){
        $this->$event = $script;
    }
    
    function getEvents(){
        $events ="";
        
        $properties = get_class_vars("global_event");
        foreach($properties as $property => $value){
            if($this->$property)
                $events .= " " . $property . "=\"" . $this->$property . "\"";
        }
        return $events;
    }
}

class window_events{
    public const AFTERPRINT = "onafterprint";
    public const BEFOREPRINT = "onbeforeprint";
    public const BEFOREUNLOAD = "onbeforeunload";
    public const ERROR = "onerror";
    public const HASHCHG = "onhashchange";
    public const LOAD = "onload";
    public const MSG = "onmessage";
    public const OFFLINE = "onoffline";
    public const ONLINE = "ononline";
    public const HIDE = "onpagehide";
    public const SHOW = "onpageshow";
    public const POPSTATE = "onpopstate";
    public const RESIZE = "onresize";
    public const STORAGE = "onstorage";
    public const UNLOAD = "onunload";
}

class form_events{
    public const BLUR = "onblur";
    public const CHANGE = "onchange";
    public const CONTEXT = "oncontextmenu";
    public const FOCUS = "onfocus";
    public const INPUT = "oninput";
    public const INVALID = "oninvalid";
    public const RESET = "onreset";
    public const SEARCH = "onsearch";
    public const SELECT = "onselect";
    public const SUBMIT = "onsubmit";
}

class kb_events{
    public const DOWN = "onkeydown";
    public const PRESS = "onkeypress";
    public const UP = "onkeyup";
}

class mouse_events{
    public const CLICK = "onclick";
    public const DBLCLICK = "ondblclick";
    public const BTNDOWN = "onmousedown";
    public const MOVE = "onmousemove";
    public const OUT = "onmouseout";
    public const OVER = "onmouseover";
    public const BTNUP = "onmouseup";
    public const WHEEL = "onwheel";
}

class drag_events{
    public const DRAG = "ondrag";
    public const END = "ondragend";
    public const ENTER= "ondragenter";
    public const LEAVE = "ondragleave";
    public const OVER = "ondragover";
    public const START = "ondragstart";
    public const DROP = "ondrop";
    public const SCROLL = "onscroll";
}

class clipbrd_events{
    public const COPY = "oncopy";
    public const CUT = "oncut";
    public const PASTE = "onpaste";
}

class media_events{
    public const ABORT = "onabort";
    public const CANPLAY = "oncanplay";
    public const CANPLYTHRG = "oncanplaythrough";
    public const CUECHNG = "oncuechange";
    public const DURCHNG = "ondurationchange";
    public const EMPTIED = "onemptied";
    public const ENDED = "onended";
    public const ERROR = "onerror";
    public const LOADED = "onloadeddata";
    public const META = "onloadedmetadata";
    public const LOADSTART = "onloadstart";
    public const PAUSE = "onpause";
    public const PLAY = "onplay";
    public const PLAYING = "onplaying";
    public const PROGRESS = "onprogress";
    public const RATECHNG = "onratechange";
    public const SEEKEND = "onseeked";
    public const SEEKING = "onseeking";
    public const STALLED = "onstalled";
    public const SUSPEND = "onsuspend";
    public const UPDATE = "ontimeupdate";
    public const VOLUME = "onvolumechange";
    public const WAITING = "onwaiting";
}

class misc_events{
    public const TOGGLE = "ontoggle";
}

?>