<?php

namespace App\Facilitate\Repositories;

use App\Facilitate\Facades\DB;

class UserRepository extends Repository {
    public function save(array $data): int {
        $data['password'] = password_hash(trim($data['password']), PASSWORD_ARGON2ID);
        return DB::getInstance()
            ->table(parent::$table)
            ->create($data)
            ->getLastInsertId();
    }
}