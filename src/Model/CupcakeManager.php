<?php

namespace App\Model;

use PDO;

class CupcakeManager extends AbstractManager
{
    public const TABLE = 'cupcake';

    public function insert(array $cupcake): void
    {
        // Insert the cupcake data into the 'cupcake' table
        $query = "INSERT INTO " . self::TABLE . "
                 (name, color1, color2, color3, created_at, accessory_id)
                 VALUES
                 (:name, :color1, :color2, :color3, NOW(), :accessory_id)";

        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':name', $cupcake['name'], PDO::PARAM_STR);
        $statement->bindValue(':color1', $cupcake['color1'], PDO::PARAM_STR);
        $statement->bindValue(':color2', $cupcake['color2'], PDO::PARAM_STR);
        $statement->bindValue(':color3', $cupcake['color3'], PDO::PARAM_STR);
        $statement->bindValue(':accessory_id', $cupcake['accessory'], PDO::PARAM_INT);
        $statement->execute();
    }

    public function getMyCupcakes(): array
    {
        // Insert the cupcake data into the 'cupcake' table
        $query = "SELECT cupcake.*, accessory.id, accessory.name AS accessory_name
              FROM cupcake
              JOIN accessory ON accessory.id = cupcake.accessory_id ORDER BY cupcake.id DESC";

        return $this->pdo->query($query)->fetchAll();
    }

    public function selectOneCupcakeById(int $id): array
    {
        $query = "SELECT cupcake.*, accessory.id, accessory.name AS accessory_name
          FROM cupcake
          JOIN accessory ON accessory.id = cupcake.accessory_id
          WHERE cupcake.id=$id";

        return $this->pdo->query($query)->fetch();
    }
}
