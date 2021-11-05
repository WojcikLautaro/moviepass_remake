<?php

namespace common;

//FRAMEWORK---------------------------------------------------------------

//DEFAULT
define("DEFAULT_CONTROLLER", "Home");
define("DEFAULT_METHOD", "index");

//ERROR DEFAULT DISPLAY
define("ERROR_DISPLAY", "display");
define("ERROR_HIDE", "hide");
define("ERROR_DEFAULT", ERROR_DISPLAY);

//INTERNAL RESOURCES (Case sensitive)
define("ROOT", dirname(__DIR__) . "/");
define("TEMPLATES_PATH", ROOT . "view/templates/");

//EXTERNAL RESOURCES
define("FRONT_ROOT", strtolower(implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/'));
define("RESOURCES_PATH", FRONT_ROOT . "view/resources/");
define("CSS_PATH", RESOURCES_PATH . "css/");
define("JS_PATH", RESOURCES_PATH . "js/");
define("IMG_PATH", RESOURCES_PATH . "img/");
define("ICON_PATH", RESOURCES_PATH . "icon/");

//API---------------------------------------------------------------------

//Facebook login
define('APP_ID', '383668786136123');
define('APP_SECRET', '07cde429233190afc3f433c626dbfc0e');

//themoviedb
define('API_KEY', 'daaea3a3b1e2571ed4a7d51041531d32');

//php ini file changes, for mailing purposes
define('APP_MAIL', "dev.groupthree@gmail.com");
define('APP_MAIL_PASSWORD', "carolina.3");


//DATABASE----------------------------------------------------------------

define('DB_HOST', "localhost");
define('DB_USER', "university");
define('DB_PASS', "");
define('DB_NAME', "moviepass");


//OTHER-------------------------------------------------------------------

//Page title
define('PAGE_TITLE', "Moviepass");

//Facebook login & mailing
define('HOST_NAME', $_SERVER['HTTP_HOST']);

//Default timezone
date_default_timezone_set('America/Argentina/Buenos_Aires');

//Role names
define('ADMIN_ROLE_NAME', "admin");
define('CLIENT_ROLE_NAME', "client");
define('GUEST_ROLE_NAME', "guest");
