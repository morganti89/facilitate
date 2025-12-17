<?php

namespace App\Facilitate\Facades;

use App\Facilitate\Controllers\Controller;

class Router
{
    public static ?Router $instance = null;
    private string $controller = '';
    private string $method = '';
    private string $route = '';
    private string $currentRoute = '';

    public function __destruct()
    {
        if (
            self::getInstance()->controller === null &&
            self::getInstance()->method === null
        ) {
        }

        self::getInstance()->instanciate([
            self::getInstance()->controller,
            self::getInstance()->method
        ]);
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public static function get(string $route, array $controller = []): Router|null
    {

        self::getInstance()->currentRoute = $route;

        if (UrlParser::isUrl($route) && empty($_POST)) {
            self::getInstance()->route = $route;
            self::getInstance()->controller = $controller[0];
            self::getInstance()->method = $controller[1];
        }

        return self::getInstance();
    }

    public static function post(string $route, array $controller = []): Router|null
    {

        if (UrlParser::isUrl($route) && !empty($_POST)) {
            self::getInstance()->route = $route;
            self::getInstance()->controller = $controller[0];
            self::getInstance()->method = $controller[1];
        }

        return self::getInstance();
    }

    public static function delete(string $route, $controller = []): Router|null
    {
        if (UrlParser::isUrl($route) && !empty($_POST)) {
            self::getInstance()->controller = $controller[0];
            self::getInstance()->method = $controller[1];
        }
        return self::getInstance();
    }

    public static function authRequired()
    {
        if (self::getInstance()->route != self::getInstance()->currentRoute) 
            return;



        if (Auth::isAuth() == false) {
            debug('Router::authRequired()');
            redirect('login');
        }
    }

    private function instanciate($controller = []): void
    {
        if ($controller[0] == "") return;
        
        $c = new $controller[0]();
        $f = $controller[1];
        $c->$f();
    }
}
