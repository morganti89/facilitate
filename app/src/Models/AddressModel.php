<?php

namespace App\Facilitate\Models;

use App\Facilitate\Repositories\AddressRepository;

class AddressModel extends Model
{
    const TABLE = 'address';

    private ?int $id = 0;
    private string $publicPlace;
    private int $number;
    private string $neighborhood;
    private string $city;
    private string $state;
    private string $country;
    private string $zipCode;

    private static array $dataRequest;
    public function __construct()
    {
        self::getInstance();
    }

    public static function getInstance(): Model
    {
        parent::getInstance()->setTable(self::TABLE);
        self::$model = AddressModel::class;
        return parent::getInstance();
    }

    public function setDataRequest($data): Model
    {
        self::$dataRequest = $data;
        return self::getInstance();
    }
}
