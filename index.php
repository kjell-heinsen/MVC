<?php
$HasConfig = 0;
$myurl = '';
error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set('log_errors', 'On');
ini_set('error_log', 'php-errors.log');
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
        echo $filename;
    }

}
spl_autoload_register("autoloadsystem");
use  core\main;

$app = new main\App();
$myurl = $app->_url;
if (file_exists(CONFIGFILE)) {
    require_once CONFIGFILE;
    $HasConfig = 1;
} else {
   $app->GetInstaller();
}

if($HasConfig === 1)
{
$app->init();
}


spl_autoload_register("autoloadsystem");

?>