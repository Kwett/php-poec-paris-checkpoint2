<?php

namespace App\Model;

use PDO;

class CupcakeManager extends AbstractManager
{
    public const TABLE = 'cupcake';

    public function insert(array $cupcake): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . "
        (`name`, `color1`, `color2`, `color3`, ``) VALUES (:name, :color1, :color2, :color3)");
        $statement->bindValue(':name', $cupcake['name'], PDO::PARAM_STR);
        $statement->bindValue(':color1', $cupcake['color1'], PDO::PARAM_STR);
        $statement->bindValue(':color2', $cupcake['color2'], PDO::PARAM_STR);
        $statement->bindValue(':color3', $cupcake['color3'], PDO::PARAM_STR);
        $statement->bindValue(':accessory_id', $cupcake['accessory_id'], PDO::PARAM_INT);
        $statement->execute();

        $cupcakeId = (int)$this->pdo->lastInsertId();

        return $cupcakeId;
    }


}