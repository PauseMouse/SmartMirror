<?php
    class Loader {
        protected $isModule;

        public function __construct($isModule = true)
        {
            $this->isModule = $isModule;
        }

        public function view($view, $model = null, $moduleName = "")
        {
            //extract model to named variables
            if ( ! is_array($model))
            {
                $model = is_object($model)
                    ? get_object_vars($model)
                    : array();
            }
            extract($model);
            
            if($this->isModule === false)
            {
                include_once VIEW_PATH . "$view.php";
            }
            else
            {
                include_once MODULES_PATH . $moduleName . DIRECTORY_SEPARATOR . "view" . DIRECTORY_SEPARATOR . "$view.php";
            }
        }
    }
?>