<?php

namespace App\Model;

use PDO;

class AccessoryManager extends AbstractManager
{
    public const TABLE1 = 'cupcake';
    public const TABLE2 = 'accessory';

    public function insert(array $accessory): void
    {
        $query = "INSERT INTO " . self::TABLE2 . " (name, url) VALUES
                 (:name, :url)";

        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':name', $accessory['name'], PDO::PARAM_STR);
        $statement->bindValue(':url', $accessory['url'], PDO::PARAM_STR);
        $statement->execute();
    }
}