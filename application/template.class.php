<?php
Class template {
    private $registry;
    private $vars = array();
    function __construct($registry){
        $this->registry = $registry;

    }
    public function __set($index, $value){
        $this->vars[$index] = $value;
    }

    public function show($name, $js = null){
        $header = __SITE_PATH.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'layout'.DIRECTORY_SEPARATOR.'site_header.php';
        $footer = __SITE_PATH.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'layout'.DIRECTORY_SEPARATOR.'site_footer.php';
        $pathView = __SITE_PATH.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.$name.'.php';
        if(file_exists($pathView) == false){
            throw new Exception('Template not found in '. $pathView);
            return false;
        }
        // Load variables
        foreach($this->vars as $key => $value){
            $$key = $value;
        }
        include($header);
        include($pathView);
        if($js != null){
            if(file_exists($js) == false){
                throw new Exception('JS file not found in '.$js);
                return false;
            }
        }
        include($footer);
    }
}