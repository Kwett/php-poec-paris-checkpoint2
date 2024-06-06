<?php

namespace App\Model;

use PDO;

class CupcakeManager extends AbstractManager
{
    public const TABLE = 'cupcake';
    public function insert(array $data)
    {
        $statement = $this->pdo->prepare(
            "INSERT INTO " . self::TABLE .
            " (name, color1, color2, color3, accessory_id) VALUES (:name, :color1, :color2, :color3, :accessory_id);"
        );
        $statement->bindValue('name', $data['name']);
        $statement->bindValue('color1', $data['color1']);
        $statement->bindValue('color2', $data['color2']);
        $statement->bindValue('color3', $data['color3']);
        $statement->bindValue('accessory_id', $data['accessory']);

        $statement->execute();
    }
}
