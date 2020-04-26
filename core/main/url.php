<?php

namespace core\main;

class URL {

   public static function redirect($url = null, $status) {
      header('Location: ' . DIR . $url, true, $status);
      exit;
   }
   
      public static function Refdirect($url = null, $status) {
      header('Location: ' . $url, true, $status);
      exit;
   }

   public static function halt($status = 404, $message = 'Da ist etwas schief gelaufen.') {
      if (ob_get_level() !== 0) {
          ob_clean();
      }

      http_response_code($status);
      $data['status'] = $status;
      $data['message'] = $message;

      if (!file_exists("views/error/$status.php")) {
         $status = 'default';
      }
      require "views/error/$status.php";

      exit;
   }
   
     public static function JScript($filename = false, $path = 'static/') {
      if ($filename) {
         $path .= "$filename.js";
      }
      return  '/'.$path;
   }

   public static function STYLES($filename = false, $path = 'static/') {
      if ($filename) {
         $path .= "$filename.css";
      }
      return '/'.$path;
   }
   
   public static function IMAGES($filename = false, $path = 'static/'){
       if ($filename){
           $path .= "$filename.jpg";
       }
       return '/'.$path;
   }
   
   public static function ICON($filename = false, $path = 'static/icon/')
   {
          if ($filename){
           $path .= "$filename.png";
       }
       return DIR . $path;    
   }
   
   public static function LINK ($path)
   {
    return DIR . $path;    
       
   }
}
