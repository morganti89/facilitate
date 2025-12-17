<?php

namespace App\Facilitate\Models;

use App\Facilitate\Models\Model;
use App\Facilitate\Repositories\FinanceRepository;

class FinanceModel extends Model
{
    const TABLE = 'counts';

    private ?int $id;
    private string $provider;
    private string $nDocument;
    private string $value;
    private string $obs;
    private string $expirationDate;

    public function __construct()
    {
        self::getInstance();
    }

    public static function getInstance(): Model
    {
        parent::getInstance()->setTable(self::TABLE);
        parent::$model = FinanceModel::class;
        return parent::getInstance();
    }

    public function getProvider(): string
    {
        return $this->provider;
    }
    public function setProvider($provider): void
    {
        $this->provider = $provider;
    }
    public function getNDocument()
    {
        return $this->nDocument;
    }
    public function setNDocument($nDocument)
    {
        $this->nDocument = $nDocument;
    }
    public function getValue()
    {
        return $this->value;
    }
    public function setValue($value)
    {
        $this->value = $value;
    }
    public function getObs()
    {
        return $this->obs;
    }
    public function setObs($obs)
    {
        $this->obs = $obs;
    }
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }
    public function setExpirationDate($date)
    {
        $this->expirationDate = $date;
    }
}
