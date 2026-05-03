<?php
// this file sets up the core API structure

//define named constants
//DS = / or \ depending on the server OS/Config
//SITE_ROOT = root directory of project
    //i.e. C:/xampp/htdocs/BeMine_wedding_website
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'xampp'.DS.'htdocs'.DS.'BeMine_wedding_website');

defined("CORE_PATH") ? null : define("CORE_PATH", SITE_ROOT.DS."core".DS); 

require_once("config.php");

require_once(CORE_PATH."category.php");
require_once(CORE_PATH."guest.php");
require_once(CORE_PATH."role.php");
require_once(CORE_PATH."task.php");
require_once(CORE_PATH."users.php");
require_once(CORE_PATH."wedding_plan.php");
require_once(CORE_PATH."vendor.php");
require_once(CORE_PATH."wedding_plan_task.php");
?>