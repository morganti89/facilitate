<?php

namespace App\Facilitate\Facades;

class Request
{
    private static ?Request $instance = null;
    private array $postValues;
    private array $getValues;


    public function __construct() {}

    public static function getRequest(): Request|array
    {
        if (self::$instance == null) {
            self::$instance = new Request();
        }
        self::$instance->insertValues();
        return self::$instance;
    }

    private function insertValues(): void
    {
        if (array_values($_POST) > 0) {
            $this->postValues = array_map(function ($post) {
                return $post;
            }, $_POST);
        }

        if (array_values($_GET) > 0) {
            $this->getValues = array_map(function ($get) {
                return $get;
            }, $_GET);
        }
    }

    public function insert_post(array $array, bool $nullable = false) {
        
        if ($nullable) {
            $_POST = [];
        }
        
        foreach ($array as $key => $value) {
            $_POST[$key] = $value;
        }
        
        foreach ($array as $key => $value) {
            $_POST[$key] = $value;
        }
    }
   

    public function get(mixed $by = ''): array
    {
        if ($by == '') {
            return $this->getValues;
        }

        if (isset($_POST[$by]) && $_POST[$by] != '') {
            return [$by => $_POST[$by]];
        }

        if (isset($_SESSION[$by]) && $_SESSION[$by] != '') {
            return [$by => $_SESSION[$by]];
        }


        return [$by => $_GET[$by]];
    }

    public function post(): array
    {
        return $this->postValues;
    }
}
