<?php
$HasConfig = 0;
$myurl = '';

error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set('log_errors', 'On');
ini_set('error_log', 'php-errors.log');

// Definierung wichtiger Software-Parameter
$softwareURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://".$_SERVER['HTTP_HOST']."/";
define("DIR",$softwareURL);
ob_start();



$root = dirname(__FILE__);
$root = $root . '/';
DEFINE('DOCROOT', $root);
DEFINE('CONFIGFILE', 'config.php');

function autoloadsystem($class)
{

    $filename = str_replace('\\', '/', $class . '.php');
    $filename = DOCROOT . strtolower($filename);
    if (file_exists($filename)) {
        require_once $filename;
    }

}
spl_autoload_register("autoloadsystem");
use  core\main;
$session = new main\Session();
$session->init();
$app = new main\App();
$app->init();
/*
$redirect = new main\URL();
$myurl = $app->_url;
if (file_exists(CONFIGFILE)) {
    require_once CONFIGFILE;
    $HasConfig = 1;
} else {

 define("INSTALLER",'installer/');
   $redirect->redirect(INSTALLER,303);
    echo $this->_url[0];
    if($this->_url[0]===INSTALLER) {
        $app->GetInstaller();
    }
}

if($HasConfig === 1)
{
$app->init();
} */




?>