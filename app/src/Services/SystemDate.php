<?php

namespace App\Facilitate\Services;

use DateTime;
use DateTimeZone;

class SystemDate {

    private static $dateTime;

    private static function new() {
        self::$dateTime = new DateTime();
        self::$dateTime->setTimezone(new DateTimeZone('America/Sao_Paulo'));
    }


    public static function date():string {
        self::new();
        return self::$dateTime->format('Y/m/d:H:i:s');
    }
}
