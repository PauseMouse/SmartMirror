<?php
    class Framework {

        public static function Start() 
        {
            self::init();

            self::dispatch("Index", "Index");
        }

        private static function init() {
            // Define path constants
            define("ROOT", getcwd() . DIRECTORY_SEPARATOR);
            define("APP_PATH", ROOT . 'application' . DIRECTORY_SEPARATOR);
            define("FRAMEWORK_PATH", ROOT . "framework" . DIRECTORY_SEPARATOR);
            define("PUBLIC_PATH", ROOT . "public" . DIRECTORY_SEPARATOR);
            define("CONFIG_PATH", APP_PATH . "config" . DIRECTORY_SEPARATOR);
            define("CORE_PATH", FRAMEWORK_PATH . "core" . DIRECTORY_SEPARATOR);
            define("LIBRARIES_PATH", FRAMEWORK_PATH . "libraries" . DIRECTORY_SEPARATOR);

            define("CONTROLLER_PATH", APP_PATH . "controllers" . DIRECTORY_SEPARATOR);
            define("MODEL_PATH", APP_PATH . "models" . DIRECTORY_SEPARATOR);
            define("VIEW_PATH", APP_PATH . "views" . DIRECTORY_SEPARATOR);
            
            //Modules
            define("MODULES_PATH", ROOT . "modules" . DIRECTORY_SEPARATOR);

            // Load core classes
            require CORE_PATH . "Controller.class.php";
            require CORE_PATH . "Loader.class.php";
            require CORE_PATH . "Model.class.php";

            spl_autoload_register(array(__CLASS__,'load'));
        }
        
        private static function parseUri(string &$controller, string &$method)
        {
            //URI
            $uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : "";
            $uriparts = explode("/", $uri);
            foreach($uriparts as $part)
            {
                if($part !== 'SmartMirror' && $part !== "")
                {
                    if($controller === "Index")
                    {
                        $controller = $part;
                    }
                    else if($method === "Index")
                    {
                        $method = $part;
                    }
                }
            }
        }

        private static function load($classname)
        {

            if (substr($classname, -10) == "Controller")
            {
                $controller = str_replace("Controller", "", $classname);
                $controller_name = $controller . "Controller";
                if(file_exists(MODULES_PATH . $controller . DIRECTORY_SEPARATOR . "Controller" . DIRECTORY_SEPARATOR .  "$controller_name.class.php") === true)
                {
                    require_once MODULES_PATH . $controller . DIRECTORY_SEPARATOR . "Controller" . DIRECTORY_SEPARATOR .  "$controller_name.class.php";
                }
                else
                {
                    require_once CONTROLLER_PATH . "$classname.class.php";
                }
            }
            else if (substr($classname, -5) == "Model") 
            {
                require_once MODEL_PATH . "$classname.class.php";
            }
        }

        private static function dispatch(string $controller, string $method_name) 
        {
            self::parseUri($controller, $method_name);
            $controller_name = $controller . "Controller";
            if(file_exists(MODULES_PATH . $controller . DIRECTORY_SEPARATOR . "Controller" . DIRECTORY_SEPARATOR .  "$controller_name.class.php") === true)
            {

            }
            else if(file_exists(CONTROLLER_PATH . "$controller_name.class.php") === false)
            {
                $controller_name = "NotFoundController";
                $method_name = "Index";
            }
            $controller = new $controller_name;
            if(method_exists($controller, $method_name))
            {
                $controller->$method_name();
            }
            else
            {
                $controller->Index();
            }
        }
    }
?>