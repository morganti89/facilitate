<?php

namespace App\Facilitate\Facades;

class UrlParser
{
    public static function get(): array
    {
        return explode('/', rtrim($_GET['url']), FILTER_SANITIZE_URL);
    }

    public static function isUrl(string $route): bool
    {

        $url = self::get()[0] ?? '';
        $method = self::get()[1] ?? '';
        $parameters = self::get()[2] ?? '';

        if ($url == '') {
            return strcmp('/', $route) === 0;
        }

        $routeArray = explode('/', $route);


        if ($url != $routeArray[0]) return false;
        if ($method != $routeArray[1]) return false;

        
        $url = $method != '' ? "$url/$method" : $url;

        if ($parameters != '' && $route != '/') {
            if (str_contains($route, "{")) {
                $methodUrl = $routeArray[1];
                if (preg_match("/\|{([A-Za-z0-9_])\}/", $route, $mathes)) {
                    $key = $mathes[1] ?? null;
                    if (!$key) return false;
                    if ($method == $methodUrl) {
                        insert_GET($key, $parameters);
                    }
                    $route = preg_replace("/\|{([A-Za-z0-9_])\}/", "", $route);
                }
                return strcmp($url, $route) === 0;
            }
        }

        return strcmp($url, $route) === 0;
    }
}
