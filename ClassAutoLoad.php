<?php
require 'conf.php';
// Autoload classes from specified directories  
$directory = ["Forms", "Global", "Layouts"];
spl_autoload_register(function($className) use ($directory) {
    foreach($directory as $dir) {
        $file = __DIR__. "/$dir/" . $className . ".php";
        if(file_exists($file)) {
            require_once $file;
            return;
        }
    }
}); 
// create instances of classes without manually including their files
$Layouts = new layouts($conf);
$Forms = new forms();