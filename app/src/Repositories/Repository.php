<?php
namespace App\Facilitate\Repositories;

use App\Facilitate\Facades\DB;
class Repository {

    protected static $table;

    public function save(array $data): int {
        return DB::getInstance()
            ->table(self::$table)
            ->create($data)
            ->getLastInsertId();
    } 

    public function setTable(string $table): void{
        self::$table = $table;
    }

    public function getBy(array $by = []): array|bool {
        return DB::getInstance()
            ->table(self::$table)
            ->get()
            ->where($by)
            ->prepare()
            ->all();
    }

    public function all($by = []): array {
        return DB::getInstance()
            ->table(self::$table)
            ->get()
            ->where($by)
            ->prepare()
            ->all();
    }

    public function customQuery(string $sql, array $where = []) {
        return DB::getInstance()
            ->sql($sql)
            ->conditions($where)
            ->prepare()
            ->all();
    }

}
