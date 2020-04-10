<?php

include_once LIBRARIES_PATH . "INI.class.php";

class Settings
{
    public static function SetSetting($key, $value, $module = "Global")
    {
        $ini = new INI(CONFIG_PATH . "Global.ini");
        $ini->data[$module][$key] = $value;
        $ini->write();
    }

    public static function GetSetting($key, $module = "Global")
    {
        $ini = new INI(CONFIG_PATH . "Global.ini");
        return $ini->data[$module][$key];
    }
    
    public static function GetAllSettings($module = "Global")
    {
        $ini = new INI(CONFIG_PATH . "Global.ini");
        if(isset($ini->data[$module]))
        {
            return $ini->data[$module];
        }
    }

    public static function GetCellSettings($cellnumber)
    {
        $ini = new INI(CONFIG_PATH . "Global.ini");
        if(isset($ini->data["Cell".$cellnumber]))
        {
            return $ini->data["Cell".$cellnumber];
        }
    }
}
?>