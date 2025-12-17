<?php

namespace App\Facilitate\Models;

use App\Facilitate\Models\Model;
use App\Facilitate\Repositories\UserRepository;

class UserModel extends Model
{
    const TABLE = 'users';
    private ?int $id = 0;
    private string $userName;
    private string $email;
    private string $password;
    private int $companyId;
    private int $admin;

    public function __construct()
    {
        self::getInstance();
    }

    public static function getInstance(): Model
    {
        $repository = new UserRepository();
        parent::getInstance()
            ->setRepository($repository)
            ->setTable(self::TABLE);
        self::$model = UserModel::class;
        return parent::getInstance();
    }

    public function getUser(string $by): object|null
    {
        return self::getBy($by)[0];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->userName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getCompanyId(): int
    {
        return $this->companyId;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name)
    {
        $this->userName = $name;
    }

    public function setCompanyId(int $id) {
        $this->companyId = $id;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setAdmin(int $admin): void
    {
        $this->admin = $admin;
    }
}
