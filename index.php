<?php
require "framework/core/Framework.class.php";

Framework::Start();

$debug = Settings::GetSetting("Debug");
if(isset($debug) && boolval($debug) === true)
{
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
}

?>