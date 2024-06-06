<?php

namespace App\Model;

use PDO;

class CupcakeManager extends AbstractManager
{
    public const TABLE = 'cupcake';

    /**
     * Insert new item in database
     */
    public function insert(array $cupcake): void
    {
        $query = "INSERT INTO " . self::TABLE . " (`name`, `color1`, `color2`, `color3`, `accessory_id`)";
        $query .= " VALUES (:name, :color1, :color2, :color3, :accessory_id)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('name', $cupcake['name'], PDO::PARAM_STR);
        $statement->bindValue('color1', $cupcake['color1'], PDO::PARAM_STR);
        $statement->bindValue('color2', $cupcake['color2'], PDO::PARAM_STR);
        $statement->bindValue('color3', $cupcake['color3'], PDO::PARAM_STR);
        $statement->bindValue('accessory_id', $cupcake['accessory'], PDO::PARAM_INT);

        $statement->execute();
    }
    /**
     * Get all row from cupcake joined accessory.
     */
    public function selectAllJoined(string $orderBy = '', string $direction = 'ASC'): array
    {
        $query = "SELECT cupcake.*, accessory.name, accessory.url FROM " . static::TABLE;
        $query .= " JOIN accessory ON accessory.id = cupcake.accessory_id";
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }

        return $this->pdo->query($query)->fetchAll();
    }

    /**
     * Get one row from database by ID.
     */
    public function selectOneByIdJoined(int $id): array|false
    {
        // prepared request
        $query = "SELECT * FROM " . static::TABLE;
        $query .= " JOIN accessory ON accessory.id = cupcake.accessory_id" . " WHERE cupcake.id=" . $id;
        $statement = $this->pdo->prepare($query);
        // $statement->bindValue('cupcake.id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
}
