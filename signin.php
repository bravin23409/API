<?php
// include the autoloader (and config if you have it)
require 'ClassAutoLoad.php';
if (file_exists('conf.php')) {
    require 'conf.php';
}

// Prefer existing variables created by autoload, otherwise try to instantiate classes
// Map possible object names the project might be using
$layouts = $layouts ?? ($ObjLayouts ?? null);
$forms   = $forms   ?? ($ObjForms   ?? null);
$ObjSendMail = $ObjSendMail ?? null;

// If $layouts or $forms are still null, try to create them (if the classes exist)
if (!$layouts) {
    if (class_exists('Layouts')) {
        // pass $conf if your Layouts constructor expects it
        $layouts = new Layouts($conf ?? null);
    } else {
        die('Error: Layouts object not found and class Layouts does not exist. Check ClassAutoLoad.php');
    }
}
if (!$forms) {
    if (class_exists('Forms')) {
        $forms = new Forms($conf ?? null);
    } else {
        die('Error: Forms object not found and class Forms does not exist. Check ClassAutoLoad.php');
    }
}