<?php

namespace App\Model;

use App\Model\AbstractManager;

class AccessoryManager extends AbstractManager
{
    public const TABLE = 'accessory';

    public function save($name, $url)
    {

        $statement = $this->pdo->prepare("INSERT INTO " . static::TABLE . " (name, url) VALUES (:name, :url)");
        $statement->bindValue(':name', $name, \PDO::PARAM_STR);
        $statement->bindValue(':url', $url, \PDO::PARAM_STR);
        $statement->execute();
    }
}
