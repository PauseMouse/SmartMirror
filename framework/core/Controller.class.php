<?php

include_once CORE_PATH . "Settings.class.php";

// Base Controller
class Controller 
{
    protected $loader;
    protected $isModule;

    public function __construct($isModule = true){
        $this->isModule = $isModule;
        $this->loader = new Loader($isModule);
    }

    public function redirect($url,$message,$wait = 0)
    {
        if ($wait == 0){
            header("Location:$url");
        } else {
            include CURR_VIEW_PATH . "message.html";
        }
        exit;
    }
}
?>