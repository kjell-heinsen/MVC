<?php

namespace core\main;

class App
{

    public $_url;
    private $_controller = NULL;
    private $_DefController;
    private $_urlpath;

    public function __construct()
    {
        Session::init(); //Die spätere Session-Klasse
        $this->_getUrl();
    }


    public function init()
    {
          $this->_GetPage();
    }


    private function _getUrl()
    {
        $url = isset($_GET["url"]) ? rtrim($_GET["url"], "/") : NULL;
        $url = urldecode(filter_var(urlencode($url), FILTER_SANITIZE_URL));
        $this->_url = explode("/", $url);
    }



    private function _GetPage()
    {
        $this->InsertFile('header.php');
        $this->InsertFile('popup.php');
        $this->InsertFile('navigation.php');
       if(file_exists('install') AND is_dir('install')) {
           $this->GetInstaller();
       } else  $this->GetContent();
        $this->InsertFile('footer.php');




    }

    private function InsertFile($filename,$path='modul/')
    {
        $filename = DOCROOT.$path.strtolower($filename);
        if (file_exists($filename)) {
            require_once $filename;
        }
    }

    private function GetContent()
    {

    }

    public function GetInstaller()
    {
    $this->InsertFile('installer.php','install/');
    }




    private function _error($error)
    {
        if (file_exists('lib/error.php'))
        {
            require 'lib/error.php';
        }

        $this->_controller = new MyError($error);
        $this->_controller->index();
        die;
    }




}
