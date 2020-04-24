<?php

namespace lib;


class MasterLoad {

    public function __construct() {
        
    }

    public function Searchfiles() {
        $data['dir'] = MasterLoad::MyDir();    
        $path = DOCROOT . '/views/errors/' . $data['dir'].'/';
       if($data['dir']== '404.php')
       {
           return false;
  
       }
       else
       {
         $files = scandir($path);
      
        if($files <> false)
        {
         if (($key = array_search('.', $files)) !== false) {
             unset($files[$key]);
        }
         if (($key = array_search('..', $files)) !== false) {
             unset($files[$key]);
        }
        }
         return $files;
       }
    }

    public function JSfiles() {
     $data['dir'] = MasterLoad::MyDir(); 
        $files = MasterLoad::Searchfiles();
        if($files <> false)
        {
        foreach ($files as $file) {
            preg_match('#\.([a-z0-9]+)$#i', $file, $tmp);
            $endung = $tmp[1];
            $filearray = explode(".", $file);
            $myend = "." . $filearray[count($filearray) - 1];
            $file = basename($file, $myend);
            if ($endung == 'js') {
                echo " <script src='" . URL::JScript('views/'.$data['dir'].'/'.$file,'') . "'></script>\n";
            }
        }
        }
    }

    public function CSSfiles() {
        $data['dir'] = MasterLoad::MyDir(); 
        $files = MasterLoad::Searchfiles();
         if($files <> false)
        {
        foreach ($files as $file) {
            preg_match('#\.([a-z0-9]+)$#i', $file, $tmp);
            $endung = $tmp[1];
            $filearray = explode(".", $file);
            $myend = "." . $filearray[count($filearray) - 1];
            $file = basename($file, $myend);
            if ($endung == 'css') {
                echo "     <link rel='stylesheet' href='" . URL::STYLES('views/'.$data['dir'].'/'.$file,'') . "'>\n";
            }
        }
        }
    }
    
    private function MyDir()
    {
        $url = new Main();
        $myurl = $url->_url;
        $data['dir'] = $myurl[0];
        if (empty($data['dir'])) {
            $data['dir'] = DefaultC;
        }
        return $data['dir'];
    }

}
