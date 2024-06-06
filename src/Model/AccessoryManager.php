<?php

namespace App\Model;

use App\Model\AbstractManager;

class AccessoryManager extends AbstractManager
{
    public const TABLE = 'accessory';

    public function save($name, $url): void
    {
        $statement = $this->pdo->prepare("INSERT INTO " . static::TABLE . " (name, url) VALUES (:name, :url)");
        $statement->bindValue(':name', $name, \PDO::PARAM_STR);
        $statement->bindValue(':url', $url, \PDO::PARAM_STR);
        $statement->execute();
    }

    public function selectOneByName($name): false|array
    {
        $statement = $this->pdo->prepare("SELECT id FROM " . static::TABLE . " WHERE name=:name");
        $statement->bindValue('name', $name, \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }
}
