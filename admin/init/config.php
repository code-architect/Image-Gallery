<?php

//checking session is open or not
if(!isset($_SESSION)){
    session_start();
    ob_start();
}


//----------------------------| Database Constants |----------------------------------//

defined("DB_HOST") || define("DB_HOST", "localhost");
defined("DB_USER") || define("DB_USER", "root");
defined("DB_PASS") || define("DB_PASS", "");
defined("DB_NAME") || define("DB_NAME", "image_gallery");



//------------------------------------| Paths |---------------------------------------//

// Directory separator
defined("DS") || define("DS", DIRECTORY_SEPARATOR);

// Root Path
defined("ROOT_PATH") || define("ROOT_PATH", realpath(dirname(__FILE__).DS."..".DS));

// Classes Folder
defined("CLASSES_DIR") || define("CLASSES_DIR", ROOT_PATH.DS."classes");

// Pages Folder
defined("PAGES_DIR") || define("PAGES_DIR", ROOT_PATH.DS."pages");

// Images Folder
defined("IMAGES_DIR") || define("IMAGES_DIR", realpath(__DIR__ .DS. '..'.DS.'..'.DS.'images') );

//------------------------------------| Pages |---------------------------------------//

// Pages Array
// register your site pages here
$site_pages = ['main', 'comments', 'photos', 'upload', 'users'];
