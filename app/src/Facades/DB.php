<?php

namespace App\Facilitate\Facades;

use PDO;
use App\Facilitate\Controllers\Controller;
use PDOException;
use PDOStatement;

class DB
{
    private static ?DB $instance = null;
    private static $dbHost;
    private static $dbName;
    private static $dbUser;
    private static $dbPass;

    private PDO $connection;

    private static string $table;
    private static int $lastid;
    private static int $rowCount;

    private static ?PDOStatement $statement;

    private static string $sql;

    private static array $conditions;

    private static array $parameters;

    public function __construct()
    {

        self::$dbHost = getenv("DB_HOST");
        self::$dbName = getenv("DB_NAME");
        self::$dbUser = getenv("DB_USER");
        self::$dbPass = getenv("DB_PASSWORD");

        try{
            $this->connection = new PDO(
                "mysql:host=".self::$dbHost.";dbname=".self::$dbName,
                self::$dbUser,
                self::$dbPass
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }catch(PDOException $e) {
            error_log('**********************');
            error_log($e->getMessage());
            error_log('**********************');
        }
    }

    public static function getInstance(): DB|null
    {
        if (self::$instance == null) {
            self::$instance = new DB();
        }
        return self::$instance;
    }

    public function getConnetion(): PDO|null
    {
        return $this->connection;
    }

    /**
     * 
     * @param array $a
     * @return DB|null
     * 
     * Função que retorna a consulta sem a necessidade de realizar a 
     * preparação do sql
     */
    public static function query(...$a): DB|null
    {
        self::$statement = self::getInstance()
            ->getConnetion()
            ->query("SELECT * FROM " . self::$table);
        return self::$instance;
    }

    /**
     * Constrói o sql de seleção que pode ser adicionado
     * a cláusula de condição WHERE
     * @return DB|null
     */
    public  static function get(): DB|null
    {
        self::$sql = "SELECT * FROM " . self::$table;
        return self::$instance;
    }

    public  static function where($condititon): DB|null
    {
        if ($condititon != []) {
            self::$conditions = $condititon;
            $key = key(self::$conditions);
            self::$sql .=  " WHERE " . "$key=:$key";
        }
        return self::$instance;
    }

    public static function prepare(): DB|null
    {
        self::$statement = self::getInstance()
            ->getConnetion()
            ->prepare(self::$sql);

        if(!empty(self::$conditions)) {
            foreach (self::$conditions as $key => $value) {
                self::$statement->bindValue($key, $value);
            }
        }
        self::$statement->execute();

        return self::$instance;
    }

    public static function fetch(): mixed
    {
        $fetch = self::$statement->fetch(PDO::FETCH_ASSOC);
        self::getInstance()->clean();
        return $fetch;
    }

    public function all(): array
    {
        $all = self::$statement->fetchAll(PDO::FETCH_ASSOC);
        self::getInstance()->clean();
        return $all;
    }

    public function getLastInsertId(): int
    {
        $lastInsertId = self::getInstance()->getConnetion()->lastInsertId();
        self::getInstance()->clean();
        return $lastInsertId;
    }

    public static function table($tableName): DB
    {
        self::$table = $tableName;
        return self::$instance;
    }

    public function sql(string $sql): DB|null
    {
        self::$sql = $sql;
        return self::$instance;
    }

    public function parameters(array $data = []): DB|null
    {
        self::$parameters = $data;
        return self::$instance;
    }

    public function make(): DB|null
    {
        self::$statement = self::getInstance()->getConnetion()->prepare(self::$sql);
        foreach (self::$parameters as $key => $value) {
            self::$statement->bindValue(":$key", $value);
        }
        self::$statement->execute();
        return self::$instance;
    }

    public static function create(array $data): DB
    {
        $keys = self::getInstance()->parseKeys($data);
        $key = $keys['key'];
        $bindValues = $keys['bind'];

        $sql = "INSERT INTO " . self::$table . " ($key) VALUES ($bindValues)";

        $stmt = self::getInstance()->getConnetion()->prepare($sql);

        foreach ($data as $key => $value) {
            if ($key == 'id') continue;
            $stmt->bindValue(":$key", $value);
        }
        $stmt->execute();
        return self::$instance;
    }
    public static function update(array $data)
    {
        $keys = self::getInstance()->parseKeys($data);

        $sql = "UPDATE " . self::$table .
            " SET " . $keys['update'] . "  WHERE id=:id";
        $stmt = self::getInstance()->getConnetion()->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->execute();
        self::$rowCount = $stmt->rowCount();
        return self::getInstance();
    }

    public static function delete(array $data)
    {
        $sql = "DELETE FROM " . self::$table . " WHERE id = ?";
        $stmt = self::getInstance()->getConnetion()->prepare($sql);
        $stmt->bindValue(1, $data["id"]);
        $stmt->execute();
        self::$rowCount = $stmt->rowCount();
        return self::getInstance();
    }

    public function rowCount(): int
    {
        return self::$rowCount;
    }

    public function lastid()
    {
        return self::$lastid;
    }

    private function parseKeys(array $data): array
    {
        $keys['key'] = '';
        $keys['bind'] = '';
        $keys['update'] = '';
        foreach ($data as $key => $value) {
            if ($key == 'id') continue;
            $keys['key'] .= "$key,";
            $keys['bind'] .= ":$key,";
            $keys["update"] .= "$key=:$key,";
        }
        $keys['key'] = substr($keys['key'], 0, -1);
        $keys['bind'] = substr($keys['bind'], 0, -1);
        $keys['update'] = substr($keys['update'], 0, -1);
        return $keys;
    }

    public function count(): mixed
    {
        $sql = "SELECT count(id) FROM " . self::$table;
        $stmt = self::getInstance()->getConnetion()->prepare($sql);
        $stmt->execute();
        return $stmt->fetch()['count(id)'];
    }

    private function clean(){
        self::$conditions = [];
        self::$parameters = [];
        self::$statement = null;
        self::$sql = '';
    }


    
}
