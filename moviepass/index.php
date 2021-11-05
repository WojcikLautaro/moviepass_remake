<?php
require_once "common/Config.php";

//Error handling
{
    if (strcasecmp(ERROR_DEFAULT, ERROR_DISPLAY) == 0) {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    } else {
        ini_set('display_errors', 0);
        ini_set('display_startup_errors', 0);
        error_reporting(0);
    }
}

//Autoload
{
    spl_autoload_register(function ($className) {
        require_once(str_replace("\\", "/", ROOT . $className . ".php"));
    });
}

use common\Request;
use common\Route;

//Routing
{
    $method = Request::getMethod();
    $uri = Request::getUri();

    $callbacks = Route::getCallbacks('GET|POST|PUT|DELETE', '/.*', function (string $uri, array $parameters) {
      try {
        $uri = array_filter(explode('/', $uri), function ($value) {
          return  $value === "" ? null : $value;
        });

        array_splice($uri, 0, 0);
        $method = "controller\\" . (isset($uri[0]) ? $uri[0] : DEFAULT_CONTROLLER) .
          "::" . (isset($uri[1]) ? $uri[1] : DEFAULT_METHOD);
        echo call_user_func_array($method, $parameters);
      } catch (\Throwable $th) {
        echo $th;
      }
    });

    try {
      if ($_SERVER['REQUEST_METHOD'] == 'HEAD') ob_start();
      $handled = Route::routeRequest($method, $uri, $callbacks);
      if (!$handled) header('HTTP/1.1 404 Not Found');
    } catch (Exception $th) {
      header('HTTP/1.1 500 Internal Server Error');
      throw $th;
    } finally {
      if ($_SERVER['REQUEST_METHOD'] == 'HEAD') ob_end_clean();
    }
}
