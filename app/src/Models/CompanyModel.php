<?php

namespace App\Facilitate\Models;

use App\Facilitate\Repositories\CompanyRepository;

class CompanyModel extends Model{
    const TABLE = 'companies';

    private ?int $id = 0;
    private string $cpnj;
    private string $socialName;
    private string $companyName;
    private string $companyEmail;
    private string $fone;
    private string $modules;
    private string $zipCode;

    private static array $dataRequest;
    public function __construct()
    {
        self::getInstance();
    }

    public static function getInstance(): Model
    {
        parent::getInstance()->setTable(self::TABLE);
        self::$model = CompanyModel::class;
        return parent::getInstance();
    }
}