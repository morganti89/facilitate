<?php

namespace App\Facilitate\Services;

use Predis\Client as PredisClient;

class Redis {

    private static ?Redis $instance = null;
    private static ?PredisClient $client = null;

    public static function getInstance(): Redis {

        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function connect(): Redis {
         self::$client = new PredisClient([
            'host' => 'redis-18588.c308.sa-east-1-1.ec2.cloud.redislabs.com',
            'port' => 18588,
            'database' => 0,
            'username' => 'default',
            'password'=> 'gbyvQJ2piv3rtvlMvWKz9DQ6J4spNtvw',
        ]);
        return self::$instance;
    }

    public static function getClient(): PredisClient {
        return self::$client;
    }


}
