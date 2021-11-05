<?php

namespace common;

class Route
{
    public static function getCallbacks($methods, $pattern, $fn) {
          $callbacks = array();
          foreach (explode('|', $methods) as $method) {
              $callbacks[$method][] = array(
                  'pattern' => false ? rtrim($pattern, '/') : '/' . trim($pattern, '/'),
                  'function' => $fn,
              );
          }

          return $callbacks;
    }

    public static function routeRequest($method, $uri, $callbacks = array()) {
        $handled = false;
              if (isset($callbacks[$method])) {
                  foreach ($callbacks[$method] as $callback) {
                      $is_match = (function ($pattern, $uri, &$matches) {
                          $pattern = preg_replace('/\/{(.*?)}/', '/(.*?)', $pattern);
                          return boolval(preg_match_all('#^' . $pattern . '$#', $uri, $matches, PREG_OFFSET_CAPTURE));
                      })($callback['pattern'], $uri, $matches);

                      if ($is_match) {
                          $matches = array_slice($matches, 1);

                          if (is_callable($callback['function'])) {
                              $handled = true;
                              call_user_func($callback['function'], $uri, array_merge($_REQUEST, $_FILES));
                          }
                      }
                  }
              }
          return $handled;
    }
}
