<?php

namespace App\Facilitate\Facades;
class Curl
{
    private static $curlResponse;
    private static $curlHandler;
    private $curlOptions = [];

    public static ?Curl $instance = null;

    public function __construct() {
    }

    public static function getInstance(): Curl {
        if (self::$instance === null) {
            self::$instance = new Curl();
        }
        return self::$instance;
    }

    public function getCurlResponse()
    {
        return $this->curlResponse;
    }

    public static function init(string $_url)
    {
        self::$curlHandler = curl_init($_url);
    }

    public static function setCurlOptions($key, $value)
    {
        self::$curlOptions[$key] = $value;
    }

    public static function exec()
    {

        if (count(self::$curlOptions) == 0) {
            return null;
        }

        if (self::$curlHandler == null) {
            return null;
        }

        foreach (self::$curlOptions as $key => $value) {
            curl_setopt(self::$curlHandler, $key, $value);
        }
        self::$curlResponse = curl_exec(self::$curlHandler);
    }
}
