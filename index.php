<?php session_start();
define('ROOT', dirname(__FILE__));//"/Users/kneth/http/MyWebSite/camagrugit"
define('DS', DIRECTORY_SEPARATOR);
define('CORE', ROOT.DS.'core');//"/Users/kneth/http/MyWebSite/camagrugit/core"
define('PORT', $_SERVER['SERVER_PORT']);
require CORE.DS.'include.php';
$disp = new Dispatcher($DB_DSN, $DB_USR, $DB_PSW);
?>