<?php

namespace App\Model;

use PDO;

class AccessoryManager extends AbstractManager
{
    public const TABLE = 'accessory';
    public function insert(array $data)
    {
        $statement = $this->pdo->prepare(
            "INSERT INTO " . self::TABLE .
            " (name, url) VALUES (:name, :url);"
        );
        $statement->bindValue('name', $data['name']);
        $statement->bindValue('url', $data['url']);
        $statement->execute();
    }
}
