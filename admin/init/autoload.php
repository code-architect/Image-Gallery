<?php
include "config.php";

function autoload($className){

    $file = CLASSES_DIR.DS.$className.'.php';
    if(file_exists($file)){
        require_once($file);
    }
}
spl_autoload_register('autoload');