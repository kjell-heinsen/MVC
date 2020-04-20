<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set('log_errors', 'On');
ini_set('error_log', 'php-errors.log');
ob_start();


$root = dirname(__FILE__);
$root = $root . '/';
DEFINE('DOCROOT', $root);

function autoloadsystem($class)
{

    $filename = str_replace('\\', '/', $class . '.php');
    $filename = DOCROOT . strtolower($filename);
    if (file_exists($filename)) {
        require_once $filename;
    }

}

spl_autoload_register("autoloadsystem");

?>