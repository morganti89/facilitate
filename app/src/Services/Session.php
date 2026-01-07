<?php

namespace App\Facilitate\Services;

class Session {

    public static function new(array $data = []): void {
        $_SESSION = $data;
    }

    public static function get($key): mixed {
        return $_SESSION[$key];
    }

    public static function getAll(): array {
        return $_SESSION;
    }

    public static function insert($key, $data): void {
        $_SESSION[$key] = $data;
    }

    public static function destroy(): void {
        $_SESSION = [];
    }

    public static function delete($key): void {
        unset($_SESSION[$key]);
    }
}
