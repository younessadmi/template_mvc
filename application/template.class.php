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

    public function show($name, $error = null){

        $controller = debug_backtrace()[0]['object']->registry->vars['router']->controller;
        $action = debug_backtrace()[1]['function'];

        $header = __SITE_PATH.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'layout'.DIRECTORY_SEPARATOR.'header.php';
        $footer = __SITE_PATH.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'layout'.DIRECTORY_SEPARATOR.'footer.php';

        if($error == null){
            $pathView = __SITE_PATH.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.$controller.DIRECTORY_SEPARATOR.$name.'.php';
            $pathJS = __SITE_PATH.DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.$controller.DIRECTORY_SEPARATOR.$action.'.js';
            $pathCSS = __SITE_PATH.DIRECTORY_SEPARATOR.'css'.DIRECTORY_SEPARATOR.$controller.DIRECTORY_SEPARATOR.$action.'.css';
        }else{
            $pathView = __SITE_PATH.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'error'.DIRECTORY_SEPARATOR.$name.'.php';
            $pathJS = __SITE_PATH.DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'error'.DIRECTORY_SEPARATOR.$name.'.js';
            $pathCSS = __SITE_PATH.DIRECTORY_SEPARATOR.'css'.DIRECTORY_SEPARATOR.'error'.DIRECTORY_SEPARATOR.$name.'.css';
        }

        if(file_exists($pathView) == false){
            throw new Exception('View not found in '. $pathView);
            return false;
        }
        if(file_exists($pathCSS) == false){
            throw new Exception('CSS not found in '. $pathCSS);
            return false;
        }
        if(file_exists($pathJS) == false){
            throw new Exception('JS not found in '. $pathJS);
            return false;
        }

        // Load variables
        foreach($this->vars as $key => $value){
            $$key = $value;
        }

        include($header);
        include($pathCSS);
        include($pathView);
        include($pathJS);
        include($footer);
    }
}