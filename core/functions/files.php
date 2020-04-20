<?php


namespace core\functions;


class Files
{
  public  function rmr($dir) {
        if (is_dir($dir)) {
            $dircontent=scandir($dir);
            foreach ($dircontent as $c) {
                if ($c!='.' and $c!='..' and is_dir($dir.'/'.$c)) {
                    rmr($dir.'/'.$c);
                } else if ($c!='.' and $c!='..') {
                    unlink($dir.'/'.$c);
                }
            }
            rmdir($dir);
        } else {
            unlink($dir);
        }
    }


  public function MyUnZip($file)
    {
        $return = false;
        $dir = dirname(__FILE__);
        $zip = new ZipArchive;
        $res = $zip->open($file);
        if ($res === TRUE) {
            $zip->extractTo($dir . '/');
            $zip->close();
            $return = true;
        }
        return $return;
    }
}