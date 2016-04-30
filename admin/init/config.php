<?php

//checking session is open or not
if(!isset($_SESSION)){
    session_start();
}


// Directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);

// Root Path
defined("ROOT_PATH") || define("ROOT_PATH", realpath(dirname(__FILE__).DS."..".DS));

// Classes Folder
defined("CLASSES_DIR") || define("CLASSES_DIR", ROOT_PATH.DS."classes");

// Pages Folder
defined("PAGES_DIR") || define("PAGES_DIR", ROOT_PATH.DS."pages");

//------------------------------------------------------------------------------------//

// Pages Array
// register your site pages here
$site_pages = ['main', 'comments', 'photos', 'upload', 'users'];
