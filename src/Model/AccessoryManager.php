<?php
namespace App\Model;

use PDO;

class AccessoryManager extends AbstractManager
{
    private const TABLE = "accessory";

    public function insert(array $accessory): bool
    {
        $statement = $this->pdo->prepare(
            "INSERT INTO " . self::TABLE . " ( `name`, `url`) VALUES (:name, :url);"
        );
        $statement->bindValue("name", $accessory['name'], PDO::PARAM_STR);
        $statement->bindValue("url", $accessory['url'], PDO::PARAM_STR);

        return $statement->execute();
    }
}
