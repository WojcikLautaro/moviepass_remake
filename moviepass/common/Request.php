<?php

namespace common;

class Request
{
    private static $method = null;
    private static $uri = null;

    private static function _getMethod() {
      $method = $_SERVER['REQUEST_METHOD'];
      if ($_SERVER['REQUEST_METHOD'] == 'HEAD') {
          $method =  'GET';
      } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $headers = (function () {
              $headers = array();
              if (function_exists('getallheaders')) {
                  $headers = getallheaders();
                  if ($headers !== false)
                      return $headers;
              }
              foreach ($_SERVER as $name => $value) {
                  if ((substr($name, 0, 5) == 'HTTP_') || ($name == 'CONTENT_TYPE') || ($name == 'CONTENT_LENGTH'))
                      $headers[str_replace(array(' ', 'Http'), array('-', 'HTTP'), ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
              }

              return $headers;
          })();

          if (isset($headers['X-HTTP-Method-Override']) && in_array($headers['X-HTTP-Method-Override'], array('PUT', 'DELETE', 'PATCH'))) {
              $method = $headers['X-HTTP-Method-Override'];
          }
      }

      return $method;
    }

    public static function getMethod() {
      if(self::$method == null)
        self::$method = Request::_getMethod();

        return self::$method;
    }

    private static function _getUri() {
      $uri = parse_url(rawurldecode($_SERVER['REQUEST_URI']));
      return '/' . trim($uri["path"], '/');
    }

    public static function getUri() {
      if(self::$uri == null)
        self::$uri = Request::_getUri();

        return self::$uri;
    }
}
