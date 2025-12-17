<?php

namespace App\Facilitate\Models;

use App\Facilitate\Repositories\Repository;
use App\Facilitate\Facades\Request;

class Model
{
    protected static ?Repository $repository = null;

    private static $instance;
    protected static $model;
    protected static $hydrateData;

    public static function getInstance(): self
    {

        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function setRepository(Repository $repository) : self
    {
        if (!$repository) {
            self::getInstance()::$repository = new Repository();
            return self::$instance;
        }

        self::getInstance()::$repository = $repository;
        return self::$instance;
    }

    protected function setTable(string $tableName): Model
    {
        self::$repository->setTable($tableName);
        return self::$instance;
    }

    public static function save(): int
    {
        $dataRequest = Request::getRequest()->post();
        return self::getInstance()::$repository->save($dataRequest);
    }

    public static function getBy(string $by, bool $hydrateData = true): array|null
    {
        self::$hydrateData = $hydrateData;
        $getRequest = Request::getRequest()->get($by);
        return self::getInstance()->get($getRequest);
    }

    public function getAllBy(string $by, bool $hydrateData = true): array|null
    {
        $getRequest = Request::getRequest()->get($by);
        self::$hydrateData = $hydrateData;
        return self::getInstance()->getAllData($getRequest);
    }

    public static function getAll(bool $hydrateData = true): array|null
    {
        self::$hydrateData = $hydrateData;
        return self::getInstance()->getAllData();
    }

    protected function getAllData(array $by = []): array|null
    {
        $data = self::getInstance()::$repository->all($by);
        if ($data && self::$hydrateData) {
            return self::getInstance()->hydrateData(self::$model, $data);
        }
        return null;
    }

    protected function get(array $by): array|null
    {
        $data = self::getInstance()::$repository->getBy($by);
        if ($data && self::$hydrateData) {
            return self::getInstance()->hydrateData(self::$model, $data);
        }
        return null;
    }

    protected function hydrateData(string $model, array $data): array
    {
        $list = [];

        foreach ($data as $dbData) {
            $class = new $model();
            foreach ($dbData as $key => $value) {

                if (str_contains($key, '_')) {
                    $ex = explode('_', $key);
                    $key = '';
                    for ($i = 0; $i < count($ex); $i++) {
                        if ($i == 0) {
                            $key .= $ex[$i];
                            continue;
                        }
                        $key .= ucfirst($ex[$i]);
                    }
                }
                if (!method_exists($class, 'set' . ucfirst($key))) continue;
                $functionName = 'set' . ucfirst($key);
                $class->$functionName($value);
            }
            $list[] = $class;
        }

        return $list;
    }
}
