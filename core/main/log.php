<?php
namespace core\main;

class Log {
    
    
    
   public function __construct()
    {
          parent::__construct();  
    }  
    



 public function write($message,$status,$ip='',$user='')
 {
     
 }
 
 

 public function read($tabellenfeld,$filter,$substring='')
 {
     
 }
 
 
    public function getIP() {
        return $_SERVER['REMOTE_ADDR'];
    }

    public function useragent() {
        return $_SERVER['HTTP_USER_AGENT'];
    }

    
}