<?php

namespace App\Facilitate\Facades;

use App\Facilitate\Services\Redis;
use App\Facilitate\Services\Session;

class Auth {
    public static ?Auth $instance = null;

    public function __construct() {
    }
    
    public static function getInstance(): Auth {
        if (self::$instance === null) {
            self::$instance = new Auth();
        }
        return self::$instance;
    }

    public static function authenticate(): Auth|null{
        Session::insert('auth', 'true');
        return Auth::getInstance();
    }

    public static function insertSessionData($key, $data): Auth|null {
        Session::insert($key, $data);
        return Auth::getInstance();
    }
    public static function isAuth(): bool {
        return isset($_SESSION['auth']) && $_SESSION['auth'] === 'true';
    }

    public static function redirect(string $url=''){
        redirect($url);
    }

    public function destroy(): void {
        Redis::destroy();
        session_destroy();
        redirect('');
    }
}
