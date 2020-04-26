<?php


echo "Hier ist der Installer";
$configfile = DOCROOT.'config.php';
$installpath = DOCROOT.'install';


if(!file_exists($configfile))
{
 $handle = fopen($configfile, 'w');

 if(file_exists($configfile))
 {
$myfiles = new functions\Files();
$myfiles->rmr($installpath);
 }
}

